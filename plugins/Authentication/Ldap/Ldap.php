<?php
/**
 * Copyright 2011-2015 Nick Korbel
 *
 * This file is part of Booked Scheduler.
 *
 * Booked Scheduler is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Booked Scheduler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'plugins/Authentication/Ldap/namespace.php');

/**
 * Provides LDAP authentication/synchronization for Booked Scheduler
 * @see IAuthorization
 */
class Ldap extends Authentication implements IAuthentication
{
	/**
	 * @var IAuthentication
	 */
	private $authToDecorate;

	/**
	 * @var Ldap2Wrapper
	 */
	private $ldap;

	/**
	 * @var LdapOptions
	 */
	private $options;

	/**
	 * @var IRegistration
	 */
	private $_registration;

	/**
	 * @var PasswordEncryption
	 */
	private $_encryption;

	/**
	 * @var LdapUser
	 */
	private $user;

	/**
	 * @var string
	 */
	private $password;

	//Sets the registration
	public function SetRegistration($registration)
	{
		$this->_registration = $registration;
	}

	//Gets the registration
	private function GetRegistration()
	{
		if ($this->_registration == null)
		{
			$this->_registration = new Registration();
		}

		return $this->_registration;
	}

	//Sets encryption
	public function SetEncryption($passwordEncryption)
	{
		$this->_encryption = $passwordEncryption;
	}

	//Gets encryption
	private function GetEncryption()
	{
		if ($this->_encryption == null)
		{
			$this->_encryption = new PasswordEncryption();
		}

		return $this->_encryption;
	}


	/**
	 * @param IAuthentication $authentication Authentication class to decorate
	 * @param Ldap2Wrapper $ldapImplementation The actual LDAP implementation to work against
	 * @param LdapOptions $ldapOptions Options to use for LDAP configuration
	 */
	public function __construct(IAuthentication $authentication, $ldapImplementation = null, $ldapOptions = null)
	{
		$this->authToDecorate = $authentication;

		$this->options = $ldapOptions;
		if ($ldapOptions == null)
		{
			$this->options = new LdapOptions();
		}

		if ($this->options->IsLdapDebugOn())
		{
			ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
		}

		$this->ldap = $ldapImplementation;
		if ($ldapImplementation == null)
		{
			$this->ldap = new Ldap2Wrapper($this->options);
		}
	}

	//Validates
	public function Validate($username, $password)
	{
		$this->password = $password;

		$username = $this->CleanUsername($username);
		$connected = $this->ldap->Connect();

		if (!$connected)
		{
			throw new Exception("Could not connect to LDAP server. Please check your LDAP configuration settings");
		}
		$filter = $this->options->Filter();
		$isValid = $this->ldap->Authenticate($username, $password, $filter);
		Log::Debug("Result of LDAP Authenticate for user %s: %d", $username, $isValid);

		if ($isValid)
		{
			$this->user = $this->ldap->GetLdapUser($username);
			$userLoaded = $this->LdapUserExists();

			if (!$userLoaded)
			{
				Log::Error("Could not load user details from LDAP. Check your ldap settings. User: %s", $username);
			}
			return $userLoaded;
		}
		else
		{
			if ($this->options->RetryAgainstDatabase())
			{
				return $this->authToDecorate->Validate($username, $password);
			}
		}

		return false;
	}

	//Performs log in
	public function Login($username, $loginContext)
	{
		$username = $this->CleanUsername($username);

		if ($this->LdapUserExists())
		{
			$this->Synchronize($username);
		}

		$repo = new UserRepository();
		$user = $repo->LoadByUsername($username);
		$user->Deactivate();
		$user->Activate();
		$repo->Update($user);

		return $this->authToDecorate->Login($username, $loginContext);
	}

	//Logout
	public function Logout(UserSession $user)
	{
		$this->authToDecorate->Logout($user);
	}

	//Unused
	public function AreCredentialsKnown()
	{
		return false;
	}

	//Checks if user exists
	private function LdapUserExists()
	{
		return $this->user != null;
	}

	//Synchronize with database
	private function Synchronize($username)
	{
		$registration = $this->GetRegistration();

		$registration->Synchronize(
				new AuthenticatedUser(
						$username,
						$this->user->GetEmail(),
						$this->user->GetFirstName(),
						$this->user->GetLastName(),
						$this->password,
						Configuration::Instance()->GetKey(ConfigKeys::LANGUAGE),
						Configuration::Instance()->GetDefaultTimezone(),
						$this->user->GetPhone(), $this->user->GetInstitution(),
						$this->user->GetTitle())
		);
	}

	//Cleans the name
	private function CleanUsername($username)
	{
		if (BookedStringHelper::Contains($username, '@'))
		{
			Log::Debug('LDAP - Username %s appears to be an email address. Cleaning...', $username);
			$parts = explode('@', $username);
			$username = $parts[0];
		}
		if (BookedStringHelper::Contains($username, '\\'))
		{
			Log::Debug('LDAP - Username %s appears contain a domain. Cleaning...', $username);
			$parts = explode('\\', $username);
			$username = $parts[1];
		}

		return $username;
	}
	
	//Unused
	public function AllowUsernameChange()
	{
		return false;
	}

	//Unused
	public function AllowEmailAddressChange()
	{
		return false;
	}

	//Unused
	public function AllowPasswordChange()
	{
		return false;
	}

	//Unused
	public function AllowNameChange()
	{
		return false;
	}

	//Unused
	public function AllowPhoneChange()
	{
		return true;
	}

	//Unused
	public function AllowOrganizationChange()
	{
		return true;
	}

	//Unused
	public function AllowPositionChange()
	{
		return true;
	}
}
