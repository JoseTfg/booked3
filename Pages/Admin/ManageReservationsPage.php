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

require_once(ROOT_DIR . 'Pages/IPageable.php');
require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');
require_once(ROOT_DIR . 'Pages/Ajax/AutoCompletePage.php');
require_once(ROOT_DIR . 'Presenters/Admin/ManageReservationsPresenter.php');

interface IManageReservationsPage extends IPageable, IActionPage
{
	/**
	 * @param array|ReservationItemView[] $reservations
	 */
	public function BindReservations($reservations);

	/**
	 * @return bool
	 */
	public function FilterButtonPressed();

	/**
	 * @return string
	 */
	public function GetStartDate();

	/**
	 * @return string
	 */
	public function GetEndDate();

	/**
	 * @return int
	 */
	public function GetUserId();

	/**
	 * @return string
	 */
	public function GetUserName();

	/**
	 * @return int
	 */
	public function GetScheduleId();

	/**
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @return string
	 */
	public function GetReferenceNumber();

	/**
	 * @param Date $date|null
	 */
	public function SetStartDate($date);

	/**
	 * @param Date $date|null
	 * @return void
	 */
	public function SetEndDate($date);

	/**
	 * @param int $userId
	 */
	public function SetUserId($userId);

	/**
	 * @param string $userName
	 */
	public function SetUserName($userName);

	/**
	 * @param int $scheduleId
	 */
	public function SetScheduleId($scheduleId);

	/**
	 * @param int $resourceId
	 */
	public function SetResourceId($resourceId);

	/**
	 * @param string $referenceNumber
	 */
	public function SetReferenceNumber($referenceNumber);

	/**
	 * @param int $statusId
	 */
	public function SetResourceStatusFilterId($statusId);

	/**
	 * @param int $reasonId
	 */
	public function SetResourceStatusReasonFilterId($reasonId);

	/**
	 * @param array|Schedule[] $schedules
	 */
	public function BindSchedules($schedules);

	/**
	 * @param array|BookableResource[] $resources
	 */
	public function BindResources($resources);

	/**
	 * @return string
	 */
	public function GetDeleteReferenceNumber();

	/**
	 * @return string
	 */
	public function GetDeleteScope();

	/**
	 * @return int
	 */
	public function GetReservationStatusId();

	/**
	 * @return int
	 */
	public function GetResourceStatusFilterId();

	/**
	 * @return int
	 */
	public function GetResourceStatusReasonFilterId();

	/**
	 * @param $reservationStatusId int
	 */
	public function SetReservationStatusId($reservationStatusId);

	/**
	 * @return string
	 */
	public function GetApproveReferenceNumber();

	public function ShowPage();

	public function ShowCsv();

	/**
	 * @return string
	 */
	public function GetFormat();

	/**
	 * @param $attributeList IEntityAttributeList
	 */
	public function SetAttributes($attributeList);

	/**
	 * @param $statusReasons ResourceStatusReason[]
	 */
	public function BindResourceStatuses($statusReasons);

	/**
	 * @return int
	 */
	public function GetResourceStatus();

	/**
	 * @return int
	 */
	public function GetResourceStatusReason();

	/**
	 * @return string
	 */
	public function GetResourceStatusReferenceNumber();

	/**
	 * @return string
	 */
	public function GetUpdateScope();

	/**
	 * @return int
	 */
	public function GetUpdateResourceId();

	/**
	 * @return bool
	 */
	public function CanUpdateResourceStatuses();

	/**
	 * @return AttributeFormElement[]
	 */
	public function GetAttributeFilters();

	/**
	 * @param Attribute[] $filters
	 */
	public function SetAttributeFilters($filters);

	/**
	 * @param CustomAttribute[] $reservationAttributes
	 */
	public function SetReservationAttributes($reservationAttributes);

	/**
	 * @param ReservationView $reservation
	 */
	public function SetReservationJson($reservation);

	/**
	 * @return int
	 */
	public function GetAttributeId();

	/**
	 * @return string
	 */
	public function GetAttributeValue();

	/**
	 * @param string[] $errors
	 */
	public function BindAttributeUpdateErrors($errors);

	public function ShowAttribute(CustomAttribute $attribute, $attributeValue);
}

//Class: Supports the reservation management controller
class ManageReservationsPage extends ActionPage implements IManageReservationsPage
{
	/**
	 * @var ManageReservationsPresenter
	 */
	protected $presenter;

	/**
	 * @var PageablePage
	 */
	protected $pageablePage;

	//Construct
	public function __construct()
	{
	    parent::__construct('ManageReservations', 1);

		$this->presenter = new ManageReservationsPresenter($this,
			new ManageReservationsService(new ReservationViewRepository()),
			new ScheduleRepository(),
			new ResourceRepository(),
			new AttributeService(new AttributeRepository()),
			new UserPreferenceRepository());

		$this->pageablePage = new PageablePage($this);

		$this->SetCanUpdateResourceStatus(true);
		$this->SetPageId('manage-reservations');
	}

	//Process action
	public function ProcessAction()
	{
		$this->presenter->ProcessAction();
	}

	//Process page load
	public function ProcessPageLoad()
	{
		$userTimezone = $this->server->GetUserSession()->Timezone;

		$this->Set('Timezone', $userTimezone);
		$this->Set('CsvExportUrl', ServiceLocator::GetServer()->GetUrl() . '&' . QueryStringKeys::FORMAT . '=csv');
		$this->presenter->PageLoad($userTimezone);
	}

	//Process data request
	public function ProcessDataRequest($dataRequest)
	{
		$this->presenter->ProcessDataRequest($dataRequest);
	}

	//Display the smarty page
	public function ShowPage()
	{
		$this->Display('Admin/Reservations/manage_reservations.tpl');
	}

	public function ShowCsv()
	{
		//No-op
	}

	//Sends the reservations information to the smarty page
	public function BindReservations($reservations)
	{
		//MyCode
		//Allows to compare date times
		foreach ($reservations as $reservation){
			$date = $reservation->StartDate->ToString();
			$date = explode("-", $date);
			$date = implode($date);			
			$reservation->StartDateNumber = $date;
		}
		
		$this->Set('reservations', $reservations);
	}

	//Gets if filter button was pressed
	public function FilterButtonPressed()
	{
		return count($_GET)>0;
	}

	/**
	 * @return string
	 */
	//Gets start date of a reservation
	public function GetStartDate()
	{
		return $this->server->GetQuerystring(QueryStringKeys::START_DATE);
	}

	/**
	 * @return string
	 */
	//Gets end date of a reservation
	public function GetEndDate()
	{
		return $this->server->GetQuerystring(QueryStringKeys::END_DATE);
	}

	/**
	 * @param Date $date
	 * @return void
	 */
	//Sets start date of a reservation
	public function SetStartDate($date)
	{
		$this->Set('StartDate', $date);
	}

	/**
	 * @param Date $date
	 * @return void
	 */
	//Sets end date of a reservation
	public function SetEndDate($date)
	{
		$this->Set('EndDate', $date);
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
	 * @return string
	 */
	//Gets user name
	public function GetUserName()
	{
		return $this->GetQuerystring(QueryStringKeys::USER_NAME);
	}

	/**
	 * @return int
	 */
	//Gets schedule identifier
	public function GetScheduleId()
	{
		return $this->GetQuerystring(QueryStringKeys::SCHEDULE_ID);
	}

	/**
	 * @return int
	 */
	//Gets resource identifier
	public function GetResourceId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESOURCE_ID);
	}

	/**
	 * @param int $userId
	 * @return void
	 */
	//Sets user identifier
	public function SetUserId($userId)
	{
		$this->Set('UserIdFilter', $userId);
	}

	/**
	 * @param string $userName
	 * @return void
	 */
	//Sets user name
	public function SetUserName($userName)
	{
		$this->Set('UserNameFilter', $userName);
	}

	/**
	 * @param int $scheduleId
	 * @return void
	 */
	//Sets schedule identifier
	public function SetScheduleId($scheduleId)
	{
		$this->Set('ScheduleId', $scheduleId);
	}

	/**
	 * @param int $resourceId
	 * @return void
	 */
	//Sets resource identifier
	public function SetResourceId($resourceId)
	{
		$this->Set('ResourceId', $resourceId);
	}

	//Sends the schedules information to the smarty page
	public function BindSchedules($schedules)
	{
		$this->Set('Schedules', $schedules);
	}

	//Sends the resource information to the smarty page
	public function BindResources($resources)
	{
		$this->Set('Resources', $resources);
	}

	/**
	 * @return string
	 */
	//Gets a reservation by its reference number
	public function GetReferenceNumber()
	{
		return $this->GetQuerystring(QueryStringKeys::REFERENCE_NUMBER);
	}

	/**
	 * @param string $referenceNumber
	 * @return void
	 */
	//Sends the reference number to the smarty page
	public function SetReferenceNumber($referenceNumber)
	{
		$this->Set('ReferenceNumber', $referenceNumber);
	}

	/**
	 * @return int
	 */
	//Gets page number
	function GetPageNumber()
	{
		return $this->pageablePage->GetPageNumber();
	}

	/**
	 * @return int
	 */
	//Gets page size
	function GetPageSize()
	{
		return $this->pageablePage->GetPageSize();
	}

	/**
	 * @param PageInfo $pageInfo
	 * @return void
	 */
	//Sends page information to the smarty page
	function BindPageInfo(PageInfo $pageInfo)
	{
		$this->pageablePage->BindPageInfo($pageInfo);
	}

	/**
	 * @return string
	 */
	//¿?
	public function GetDeleteReferenceNumber()
	{
		return $this->GetQuerystring(QueryStringKeys::REFERENCE_NUMBER);
	}

	/**
	 * @return string
	 */
	//Gets scope of the reservation
	public function GetDeleteScope()
	{
		return $this->GetForm(FormKeys::SERIES_UPDATE_SCOPE);
	}

	/**
	 * @return int
	 */
	//Gets reservation status identifier
	public function GetReservationStatusId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESERVATION_STATUS_ID);
	}

	/**
	 * @param $reservationStatusId int
	 * @return void
	 */
	//Sends the reservation status identifier to the smarty page
	public function SetReservationStatusId($reservationStatusId)
	{
		$this->Set('ReservationStatusId', $reservationStatusId);
	}

	/**
	 * @return string
	 */
	//¿?
	public function GetApproveReferenceNumber()
	{
		return $this->GetQuerystring(QueryStringKeys::REFERENCE_NUMBER);
	}

	/**
	 * @return string
	 */
	//Gets the format
	public function GetFormat()
	{
		return $this->GetQuerystring(QueryStringKeys::FORMAT);
	}

	/**
	 * @param $attributeList IEntityAttributeList
	 */
	//Sends attribute to the smarty page
	public function SetAttributes($attributeList)
	{
		$this->Set('AttributeList', $attributeList);
	}

	/**
	 * @param $statusReasons ResourceStatusReason[]
	 */
	//Sends status reasons to the smarty page
	public function BindResourceStatuses($statusReasons)
	{
		$this->Set('StatusReasons', $statusReasons);
	}

	/**
	 * @return int
	 */
	//Gets resource status identifier
	public function GetResourceStatus()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_ID);
	}

	/**
	 * @return int
	 */
	//Gets resource status reason
	public function GetResourceStatusReason()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_REASON_ID);
	}

	/**
	 * @return string
	 */
	//¿?
	public function GetResourceStatusReferenceNumber()
	{
		return $this->GetForm(FormKeys::REFERENCE_NUMBER);
	}

	/**
	 * @return string
	 */
	//Gets the update scope
	public function GetUpdateScope()
	{
		return $this->GetForm(FormKeys::RESOURCE_STATUS_UPDATE_SCOPE);
	}

	/**
	 * @return int
	 */
	//Gets update resource identifier
	public function GetUpdateResourceId()
	{
		return $this->GetForm(FormKeys::RESOURCE_ID);
	}

	/**
	 * @param int $statusId
	 */
	//Sends the resource status filter identifier to the smarty page
	public function SetResourceStatusFilterId($statusId)
	{
		$this->Set('ResourceStatusFilterId', $statusId);
	}

	/**
	 * @param int $reasonId
	 */
	//Sends the resource status reason to the smarty page
	public function SetResourceStatusReasonFilterId($reasonId)
	{
		$this->Set('ResourceStatusReasonFilterId', $reasonId);
	}

	/**
	 * @return int
	 */
	//Gets resource status filter identifier
	public function GetResourceStatusFilterId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESERVATION_RESOURCE_STATUS_ID);
	}

	/**
	 * @return int
	 */
	//Gets resource status reason filter
	public function GetResourceStatusReasonFilterId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESERVATION_RESOURCE_REASON_ID);
	}

	//Sets permission to update
	public function SetCanUpdateResourceStatus($canUpdate)
	{
		$this->Set('CanUpdateResourceStatus', $canUpdate);

	}

	//Gets permission to update
	public function CanUpdateResourceStatuses()
	{
		return $this->GetVar('CanUpdateResourceStatus');
	}

	//Gets attribute filter
	public function GetAttributeFilters()
	{
		return AttributeFormParser::GetAttributes($this->GetQuerystring(FormKeys::ATTRIBUTE_PREFIX));
	}

	//Sends the attribute filter information to the smarty page
	public function SetAttributeFilters($filters)
	{
		$this->Set('AttributeFilters', $filters);
	}

	//Sets reservation attributes
	public function SetReservationAttributes($reservationAttributes)
	{
		$this->Set('ReservationAttributes', $reservationAttributes);
	}

	//Sets reservation json
	public function SetReservationJson($reservation)
	{
		$this->SetJson($reservation);
	}

	//Gets attrbiutes identifier
	public function GetAttributeId()
	{
		$queryStringValue = $this->GetQuerystring(QueryStringKeys::ATTRIBUTE_ID);
		if (!empty($queryStringValue))
		{
			return $queryStringValue;
		}
		return $this->GetForm(FormKeys::ATTRIBUTE_ID);
	}

	//Gets attrbiutes value
	public function GetAttributeValue()
	{
		return $this->GetForm(FormKeys::ATTRIBUTE_VALUE);
	}

	/**
	 * @param string[] $errors
	 */
	//Cals the setjson to bind errors
	public function BindAttributeUpdateErrors($errors)
	{
		$this->SetJson(null, $errors);
	}

	//Sets page identifier
	protected function SetPageId($pageId)
	{
		$this->Set('PageId', $pageId);
	}

	//Displays the attributes
	public function ShowAttribute(CustomAttribute $attribute, $attributeValue)
	{
		$this->smarty->DisplayControl(array('type'=>'AttributeControl', 'attribute' => new Attribute($attribute, $attributeValue)), $this->smarty);
	}
}