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

require_once(ROOT_DIR . 'config/timezones.php');
require_once(ROOT_DIR . 'Pages/IPageable.php');
require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');
require_once(ROOT_DIR . 'Pages/Ajax/AutoCompletePage.php');
require_once(ROOT_DIR . 'Presenters/Admin/ManageUsersPresenter.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');

interface IManageUsersPage extends IPageable, IActionPage
{
	/**
	 * @param UserItemView[] $users
	 * @return void
	 */
	function BindUsers($users);

	/**
	 * @return int
	 */
	public function GetUserId();

	/**
	 * @param BookableResource[] $resources
	 * @return void
	 */
	public function BindResources($resources);

	/**
	 * @param mixed $objectToSerialize
	 * @return void
	 */
	public function SetJsonResponse($objectToSerialize);

	/**
	 * @return int[] resource ids the user has permission to
	 */
	public function GetAllowedResourceIds();

	/**
	 * @return string
	 */
	public function GetPassword();

	/**
	 * @return string
	 */
	public function GetEmail();

	/**
	 * @return string
	 */
	public function GetUserName();

	/**
	 * @return string
	 */
	public function GetFirstName();

	/**
	 * @return string
	 */
	public function GetLastName();

	/**
	 * @return string
	 */
	public function GetTimezone();

	/**
	 * @return string
	 */
	public function GetPhone();

	/**
	 * @return string
	 */
	public function GetPosition();

	/**
	 * @return string
	 */
	public function GetOrganization();

	/**
	 * @return string
	 */
	public function GetLanguage();

	/**
	 * @param $attributeList CustomAttribute[]
	 */
	public function BindAttributeList($attributeList);

	/**
	 * @return AttributeFormElement[]|array
	 */
	public function GetAttributes();

	/**
	 * @return AccountStatus|int
	 */
	public function GetFilterStatusId();

	/**
	 * @return int
	 */
	public function GetUserGroup();

	/**
	 * @param GroupItemView[] $groups
	 */
	public function BindGroups($groups);

	/**
	 * @return string
	 */
	public function GetReservationColor();

	public function ShowTemplateCSV();

	/**
	 * @return UploadedFile
	 */
	public function GetImportFile();

	/**
	 * @param CsvImportResult $importResult
	 */
	public function SetImportResult($importResult);
}

//Class: Supports the user management controller
class ManageUsersPage extends ActionPage implements IManageUsersPage
{
	/**
	 * @var \ManageUsersPresenter
	 */
	protected $_presenter;

	/**
	 * @var \PageablePage
	 */
	protected $pageable;

	//Construct
	public function __construct()
	{
		$serviceFactory = new ManageUsersServiceFactory();

		parent::__construct('ManageUsers', 1);
		$groupRepository = new GroupRepository();
		$this->_presenter = new ManageUsersPresenter(
			$this,
			new UserRepository(),
			new ResourceRepository(),
			new PasswordEncryption(),
			$serviceFactory->CreateAdmin(),
			new AttributeService(new AttributeRepository()),
			$groupRepository,
			$groupRepository);

		$this->pageable = new PageablePage($this);
	}

	//Process the page load
	public function ProcessPageLoad()
	{
		$this->_presenter->PageLoad();

		$config = Configuration::Instance();
		$resources = Resources::GetInstance();
		$this->Set('statusDescriptions', array(AccountStatus::ALL => $resources->GetString('All'), AccountStatus::ACTIVE => $resources->GetString('Active'), AccountStatus::AWAITING_ACTIVATION => $resources->GetString('Pending'), AccountStatus::INACTIVE => $resources->GetString('Inactive')));

		$this->Set('Timezone', $config->GetDefaultTimezone());
		$this->Set('Timezones', $GLOBALS['APP_TIMEZONES']);
		$this->Set('Languages', $GLOBALS['APP_TIMEZONES']);
		$this->Set('ManageGroupsUrl', Pages::MANAGE_GROUPS);
		$this->Set('ManageReservationsUrl', Pages::MANAGE_RESERVATIONS);
		$this->Set('FilterStatusId', $this->GetFilterStatusId());
		$this->Set('PerUserColors', $config->GetSectionKey(ConfigSection::SCHEDULE, ConfigKeys::SCHEDULE_PER_USER_COLORS, new BooleanConverter()));

		$this->RenderTemplate();
	}

	//Displays the smarty template
	protected function RenderTemplate()
	{
		$this->Display('Admin/manage_users.tpl');
	}

	//Sends page information to the Smarty page
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

	//Sends user information to the Smarty page
	public function BindUsers($users)
	{
		$this->Set('users', $users);
	}

	//Process action
	public function ProcessAction()
	{
		$this->_presenter->ProcessAction();
	}

	//Process request
	public function ProcessDataRequest($dataRequest)
	{
		$this->_presenter->ProcessDataRequest($dataRequest);
	}

	/**
	 * @return int
	 */
	//Gets user identifier
	public function GetUserId()
	{
		return $this->GetQuerystring(QueryStringKeys::USER_ID);
	}

	/**
	 * @param BookableResource[] $resources
	 * @return void
	 */
	//Sends the resources information to the Smarty page
	public function BindResources($resources)
	{
		$this->Set('resources', $resources);
	}

	/**
	 * @return int[] resource ids the user has permission to
	 */
	//Gets allowed resources identifiers
	public function GetAllowedResourceIds()
	{
		return $this->GetForm(FormKeys::RESOURCE_ID);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetPassword()
	{
		return $this->GetForm(FormKeys::PASSWORD);
	}

	/**
	 * @param mixed $objectToSerialize
	 * @return void
	 */
	//Sets JSON response
	public function SetJsonResponse($objectToSerialize)
	{
		parent::SetJson($objectToSerialize);
	}

	/**
	 * @return string
	 */
	//Gets email
	public function GetEmail()
	{
		return $this->GetForm(FormKeys::EMAIL);
	}

	/**
	 * @return string
	 */
	//Gets user name
	public function GetUserName()
	{
		return $this->GetForm(FormKeys::USERNAME);
	}

	//Gets user first name
	public function GetFirstName()
	{
		return $this->GetForm(FormKeys::FIRST_NAME);
	}

	//Gets user last name
	public function GetLastName()
	{
		return $this->GetForm(FormKeys::LAST_NAME);
	}

	//Unused
	public function GetTimezone()
	{
		return $this->GetForm(FormKeys::TIMEZONE);
	}

	//Unused
	public function GetPhone()
	{
		return $this->GetForm(FormKeys::PHONE);
	}

	//Unused
	public function GetPosition()
	{
		return $this->GetForm(FormKeys::POSITION);
	}

	//Unused
	public function GetOrganization()
	{
		return $this->GetForm(FormKeys::ORGANIZATION);
	}

	//Unused
	public function GetLanguage()
	{
		return $this->GetForm(FormKeys::LANGUAGE);
	}

	//Sends the attribute list information to the Smarty page
	public function BindAttributeList($attributeList)
	{
		$this->Set('AttributeList', $attributeList);
	}

	//Unused
	public function GetAttributes()
	{
		return AttributeFormParser::GetAttributes($this->GetForm(FormKeys::ATTRIBUTE_PREFIX));
	}

	/**
	 * @return AccountStatus|int
	 */
	//Gets filter status identifier
	public function GetFilterStatusId()
	{
		$statusId = $this->GetQuerystring(QueryStringKeys::ACCOUNT_STATUS);
		return empty($statusId) ? AccountStatus::ALL : $statusId;
	}

	/**
	 * @return int
	 */
	//Gets group identifier
	public function GetUserGroup()
	{
		return $this->GetForm(FormKeys::GROUP_ID);
	}

	/**
	 * @param GroupItemView[] $groups
	 */
	//Sends group information to the Smarty page
	public function BindGroups($groups)
	{
		$this->Set('Groups', $groups);
	}

	/**
	 * @return string
	 */
	//Unused
	public function GetReservationColor()
	{
		return $this->GetForm(FormKeys::RESERVATION_COLOR);
	}

	//Unused
	public function ShowTemplateCSV()
	{
		//No-op
	}

	/**
	 * @return UploadedFile
	 */
	//Unused
	public function GetImportFile()
	{
		return $this->server->GetFile(FormKeys::USER_IMPORT_FILE);
	}

	/**
	 * @param CsvImportResult $importResult
	 */
	//Unused
	public function SetImportResult($importResult)
	{
		$this->SetJsonResponse($importResult);
	}
}