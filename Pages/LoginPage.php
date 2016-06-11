<?php
/**
Copyright 2011-2015 Nick Korbel
Copyright 2012-2014 Alois Schloegl

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

require_once(ROOT_DIR . 'Pages/Page.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');

interface ILoginPage extends IPage
{
	/**
	 * @return string
	 */
	public function GetEmailAddress();

	/**
	 * @return string
	 */
	public function GetPassword();

	/**
	 * @return bool
	 */
	public function GetPersistLogin();

	public function GetShowRegisterLink();

	public function SetShowRegisterLink($value);

	public function SetShowScheduleLink($value);

	/**
	 * @return string
	 */
	public function GetSelectedLanguage();

	/**
	 * @return string
	 */
	public function GetRequestedLanguage();

	public function SetUseLogonName($value);

	public function SetResumeUrl($value);

	/**
	 * @return string
	 */
	public function GetResumeUrl();

	public function SetShowLoginError();

	/**
	 * @param $languageCode string
	 */
	public function SetSelectedLanguage($languageCode);

	/**
	 * @param $shouldShow bool
	 */
	public function ShowUsernamePrompt($shouldShow);

	/**
	 * @param $shouldShow bool
	 */
	public function ShowPasswordPrompt($shouldShow);

	/**
	 * @param $shouldShow bool
	 */
	public function ShowPersistLoginPrompt($shouldShow);

	/**
	 * @param $shouldShow bool
	 */
	public function ShowForgotPasswordPrompt($shouldShow);

	/**
	 * @param $url string
	 */
	public function SetRegistrationUrl($url);

	/**
	 * @param $url string
	 */
	public function SetPasswordResetUrl($url);
}

//Class: Supports the login controller
class LoginPage extends Page implements ILoginPage
{
	protected $presenter = null;

	//Construct
	public function __construct()
	{
		parent::__construct('LogIn'); // parent Page class

		$this->presenter = new LoginPresenter($this); // $this pseudo variable of class object is Page object
		$resumeUrl = $this->server->GetQuerystring(QueryStringKeys::REDIRECT);
		$resumeUrl = str_replace('&amp;&amp;', '&amp;', $resumeUrl);
		$this->Set('ResumeUrl', $resumeUrl);
		$this->Set('ShowLoginError', false);
		$this->Set('Languages', Resources::GetInstance()->AvailableLanguages);
	}

	//Process page load
	public function PageLoad()
	{
		$this->presenter->PageLoad();
		$this->Display('login.tpl');
	}

	//Gets email
	public function GetEmailAddress()
	{
		return $this->GetForm(FormKeys::EMAIL);
	}

	//Gets password
	public function GetPassword()
	{
		return $this->GetRawForm(FormKeys::PASSWORD);
	}

	//Gets persistent login
	public function GetPersistLogin()
	{
		return $this->GetForm(FormKeys::PERSIST_LOGIN);
	}

	//Unused
	public function GetShowRegisterLink()
	{
		return $this->GetVar('ShowRegisterLink');
	}

	//Unused
	public function SetShowRegisterLink($value)
	{
		$this->Set('ShowRegisterLink', $value);
	}

	//Gets language
	public function GetSelectedLanguage()
	{
		return $this->GetForm(FormKeys::LANGUAGE);
	}

	//Sets the nickname
	public function SetUseLogonName($value)
	{
		$this->Set('UseLogonName', $value);
	}

	//Sets the URL to redirect
	public function SetResumeUrl($value)
	{
		$this->Set('ResumeUrl', $value);
	}

	//Gets the URL to redirect
	public function GetResumeUrl()
	{
		return $this->GetForm(FormKeys::RESUME);
	}

	//¿?
	public function DisplayWelcome()
	{
		return false;
	}

	/**
	 * @return bool
	 */
	//Returns if current action is login
	public function LoggingIn()
	{
		$loggingIn = $this->GetForm(Actions::LOGIN);
		return !empty($loggingIn);
	}

	/**
	 * @return bool
	 */
	//Returns if current action is change language
	public function ChangingLanguage()
	{
		$lang = $this->GetRequestedLanguage();
		return !empty($lang);
	}

	//Authenticates the user
	public function Login()
	{
		$this->presenter->Login();
	}

	//Change languages
	public function ChangeLanguage()
	{
		$this->presenter->ChangeLanguage();
	}

	//Displays login errors
	public function SetShowLoginError()
	{
		$this->Set('ShowLoginError', true);
	}

	//Gets selected language
	public function GetRequestedLanguage()
	{
		return $this->GetQuerystring(QueryStringKeys::LANGUAGE);
	}

	//Sets selected language
	public function SetSelectedLanguage($languageCode)
	{
		$this->Set('SelectedLanguage', $languageCode);
	}

	//Unused
	protected function GetShouldAutoLogout()
	{
		return false;
	}

	//Unused
	public function ShowUsernamePrompt($shouldShow)
	{
		$this->Set('ShowUsernamePrompt', $shouldShow);
	}

	//Unused
	public function ShowPasswordPrompt($shouldShow)
	{
		$this->Set('ShowPasswordPrompt', $shouldShow);
	}

	//Unused
	public function ShowPersistLoginPrompt($shouldShow)
	{
		$this->Set('ShowPersistLoginPrompt', $shouldShow);
	}

	//Unused
	public function ShowForgotPasswordPrompt($shouldShow)
	{
		$this->Set('ShowForgotPasswordPrompt', $shouldShow);
	}

	//Unused
	public function SetShowScheduleLink($shouldShow)
	{
		$this->Set('ShowScheduleLink', $shouldShow);
	}

	//Unused
	public function SetPasswordResetUrl($url)
	{
		$this->Set('ForgotPasswordUrl', empty($url) ? Pages::FORGOT_PASSWORD : $url);
		if (BookedStringHelper::StartsWith($url, 'http'))
		{
			$this->Set('ForgotPasswordUrlNew', "target='_new'");
		}
	}

	//Unused
	public function SetRegistrationUrl($url)
	{
		$this->Set('RegisterUrl', empty($url) ? Pages::REGISTRATION : $url);
		if (BookedStringHelper::StartsWith($url, 'http'))
		{
			$this->Set('RegisterUrlNew', "target='_new'");
		}
	}
}