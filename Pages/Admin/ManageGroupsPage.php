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

require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');
require_once(ROOT_DIR . 'Pages/IPageable.php');
require_once(ROOT_DIR . 'Presenters/Admin/ManageGroupsPresenter.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');

interface IManageGroupsPage extends IActionPage
{
	/**
	 * @abstract
	 * @return int
	 */
	public function GetGroupId();

	/**
	 * @abstract
	 * @param $groups GroupItemView[]|array
	 * @return void
	 */
	public function BindGroups($groups);

	/**
	 * @abstract
	 * @param PageInfo $pageInfo
	 * @return void
	 */
	public function BindPageInfo(PageInfo $pageInfo);

	/**
	 * @abstract
	 * @return int
	 */
	public function GetPageNumber();

	/**
	 * @abstract
	 * @return int
	 */
	public function GetPageSize();

	/**
	 * @abstract
	 * @param $response string
	 * @return void
	 */
	public function SetJsonResponse($response);

	/**
	 * @abstract
	 * @return int
	 */
	public function GetUserId();

	/**
	 * @abstract
	 * @param $resources array|BookableResource[]
	 * @return void
	 */
	public function BindResources($resources);

	/**
	 * @abstract
	 * @param $roles array|RoleDto[]
	 * @return void
	 */
	public function BindRoles($roles);

	/**
	 * @abstract
	 * @return int[]|array
	 */
	public function GetAllowedResourceIds();

	/**
	 * @abstract
	 * @return string
	 */
	public function GetGroupName();

	/**
	 * @abstract
	 * @return int[]|array
	 */
	public function GetRoleIds();

	/**
	 * @abstract
	 * @param $adminGroups GroupItemView[]|array
	 * @return void
	 */
	public function BindAdminGroups($adminGroups);

	/**
	 * @abstract
	 * @return int
	 */
	public function GetAdminGroupId();
}

//Class: supports groups management controller
class ManageGroupsPage extends ActionPage implements IManageGroupsPage
{
	protected $CanChangeRoles = true;
	/**
	 * @var ManageGroupsPresenter
	 */
	protected $presenter;

	/**
	 * @var PageablePage
	 */
	private $pageable;

	//Construct
	public function __construct()
	{
		parent::__construct('ManageGroups', 1);
		$this->presenter = new ManageGroupsPresenter($this, new GroupRepository(), new ResourceRepository());

		$this->pageable = new PageablePage($this);
	}

	//Builds smarty page
	public function ProcessPageLoad()
	{
		$this->presenter->PageLoad();
		$this->Set('chooseText', Resources::GetInstance()->GetString('Choose') . '...');
		$this->Set('CanChangeRoles', $this->CanChangeRoles);
		$this->Display('Admin/manage_groups.tpl');
	}

	//Sends the page information to the smarty page
	public function BindPageInfo(PageInfo $pageInfo)
	{
		$this->pageable->BindPageInfo($pageInfo);
	}

	//Gets page number
	public function GetPageNumber()
	{
		return $this->pageable->GetPageNumber();
	}

	//Gets page size
	public function GetPageSize()
	{
		return $this->pageable->GetPageSize();
	}

	//Sends the groups information to the smarty page
	public function BindGroups($groups)
	{
		$this->Set('groups', $groups);
	}

	//Process the action
	public function ProcessAction()
	{
		$this->presenter->ProcessAction();
	}

	/**
	 * @return int
	 */
	 //Gets group identifier
	public function GetGroupId()
	{
		$groupId = $this->GetForm(FormKeys::GROUP_ID);
		if (!empty($groupId))
		{
			return $groupId;
		}
		return $this->GetQuerystring(QueryStringKeys::GROUP_ID);
	}

	//Sets response
	public function SetJsonResponse($response)
	{
		parent::SetJson($response);
	}

	//Gets user identifier
	public function GetUserId()
	{
		return $this->GetForm(FormKeys::USER_ID);
	}

	//Sends resources information to the smarty page
	public function BindResources($resources)
	{
		$this->Set('resources', $resources);
	}

	//Gets allowed resources
	public function GetAllowedResourceIds()
	{
		return $this->GetForm(FormKeys::RESOURCE_ID);
	}

	//Gets the group name
	public function GetGroupName()
	{
		return $this->GetForm(FormKeys::GROUP_NAME);
	}

	//Send the roles information to the smarty page
	public function BindRoles($roles)
	{
		$this->Set('Roles', $roles);
	}

	/**
	 * @return int[]|array
	 */
	 //Gets roles identifiers
	public function GetRoleIds()
	{
		return $this->GetForm(FormKeys::ROLE_ID);
	}

	/**
	 * @param $adminGroups GroupItemView[]|array
	 * @return void
	 */
	//Sends the admin group information to the smarty page
	public function BindAdminGroups($adminGroups)
	{
		$this->Set('AdminGroups', $adminGroups);
	}

	/**
	 * @return int
	 */
	//Gets the admin group identifier
	public function GetAdminGroupId()
	{
		return $this->GetForm(FormKeys::GROUP_ADMIN);
	}

	/**
	 * @param $dataRequest string
	 * @return void
	 */
	//Process data request
	public function ProcessDataRequest($dataRequest)
	{
		$this->presenter->ProcessDataRequest();
	}
}
?>