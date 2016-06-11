<?php
/**
Copyright 2011-2015 Nick Korbel

This file is part of Booked Scheduler.

Booked Scheduler is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Booked Scheduler is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(ROOT_DIR . 'Pages/ActionPage.php');
require_once(ROOT_DIR . 'Pages/SecurePage.php');

//Decorator for AdminPages
class AdminPageDecorator extends ActionPage implements IActionPage
{
	/**
	 * @var ActionPage
	 */
	private $page;

	//Construct
	public function __construct(ActionPage $page)
	{
		$this->page = $page;
	}

	//Loads the page
	public function PageLoad()
	{
		$user = ServiceLocator::GetServer()->GetUserSession();
	
		if (!$this->page->IsAuthenticated() || !$user->IsAdmin)
		{
			$this->RedirectResume(sprintf("%s%s?%s=%s", $this->page->path, Pages::LOGIN, QueryStringKeys::REDIRECT, urlencode($this->page->server->GetUrl())));
			die();
		}

		$this->page->PageLoad();
	}

	//Validates
	public function IsValid()
	{
		return $this->page->IsValid();
	}

	//Process actions
	public function ProcessAction()
	{
		$this->page->ProcessAction();
	}

	//Process Data Request
	public function ProcessDataRequest($dataRequest)
	{
		$this->page->ProcessDataRequest($dataRequest);
	}

	//Process PageLoad
	public function ProcessPageLoad()
	{
		$this->page->ProcessPageLoad();
	}
}

//AdminPage: supports all pages that are viewable by administrators only
abstract class AdminPage extends SecurePage implements IActionPage
{
	//Construct
	public function __construct($titleKey = '', $pageDepth = 1)
	{
		parent::__construct($titleKey, $pageDepth);

		$user = ServiceLocator::GetServer()->GetUserSession();

		if (!$user->IsAdmin)
		{
			$this->RedirectResume(sprintf("%s%s?%s=%s", $this->path, Pages::LOGIN, QueryStringKeys::REDIRECT, urlencode($this->server->GetUrl())));
			die();
		}
	}

	//Loads the template
	public function Display($adminTemplateName)
	{
		parent::Display('Admin/' . $adminTemplateName);
	}

	//Returns current action
	public function TakingAction()
	{
		$action = $this->GetAction();
		return !empty($action);
	}

	//Returns data request
	public function RequestingData()
	{
		$dataRequest = $this->GetDataRequest();
		return !empty($dataRequest);
	}

	//Gets Action
	public function GetAction()
	{
		return $this->GetQuerystring(QueryStringKeys::ACTION);
	}

	//Gets Data Request
	public function GetDataRequest()
	{
		return $this->GetQuerystring(QueryStringKeys::DATA_REQUEST);
	}

	//Validates the action
	public function IsValid()
	{
		if (parent::IsValid())
		{
			Log::Debug('Action passed all validations');
			return true;
		}

		$errors = new ActionErrors();

		foreach ($this->smarty->failedValidators as $validator)
		{
			Log::Debug('Failed validator %s', $validator);
			$errors->Add($validator);
		}

		$this->SetJson($errors);
		return false;
	}
}

?>