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

require_once(ROOT_DIR . 'Pages/IPageable.php');
require_once(ROOT_DIR . 'Pages/Admin/AdminPage.php');
require_once(ROOT_DIR . 'Pages/Ajax/AutoCompletePage.php');
require_once(ROOT_DIR . 'Presenters/Admin/ManageReservationsPresenter.php');

interface IManageBlackoutsPage extends IPageable, IActionPage, IRepeatOptionsComposite
{
	/**
	 * @param array|BlackoutItemView[] $blackouts
	 * @return void
	 */
	public function BindBlackouts($blackouts);

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
	public function GetScheduleId();

	/**
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @param Date $date |null
	 * @return void
	 */
	public function SetStartDate($date);

	/**
	 * @param Date $date |null
	 * @return void
	 */
	public function SetEndDate($date);

	/**
	 * @param int $scheduleId
	 * @return void
	 */
	public function SetScheduleId($scheduleId);

	/**
	 * @param int $resourceId
	 * @return void
	 */
	public function SetResourceId($resourceId);

	/**
	 * @param array|Schedule[] $schedules
	 * @return void
	 */
	public function BindSchedules($schedules);

	/**
	 * @param array|BookableResource[] $resources
	 * @return void
	 */
	public function BindResources($resources);

	/**
	 * @return int
	 */
	public function GetDeleteBlackoutId();

	/**
	 * @return string
	 */
	public function GetDeleteScope();

	/**
	 * @return void
	 */
	public function ShowPage();

	public function ShowBlackout();

	/**
	 * @return bool
	 */
	public function GetApplyBlackoutToAllResources();

	/**
	 * @return int
	 */
	public function GetBlackoutScheduleId();

	/**
	 * @return int
	 */
	public function GetBlackoutResourceId();

	/**
	 * @return int[]
	 */
	public function GetBlackoutResourceIds();

	/**
	 * @return string
	 */
	public function GetBlackoutStartDate();

	/**
	 * @return string
	 */
	public function GetBlackoutStartTime();

	/**
	 * @return string
	 */
	public function GetBlackoutEndDate();

	/**
	 * @return string
	 */
	public function GetBlackoutEndTime();

	/**
	 * @return string
	 */
	public function GetBlackoutTitle();

	/**
	 * @return string|ReservationConflictResolution
	 */
	public function GetBlackoutConflictAction();

	/**
	 * @return int
	 */
	public function GetBlackoutId();

	/**
	 * @return string
	 */
	public function GetSeriesUpdateScope();

	/**
	 * @return int
	 */
	public function GetUpdateBlackoutId();

	/**
	 * @param bool $wasAddedSuccessfully
	 * @param string $displayMessage
	 * @param array|ReservationItemView[] $conflictingReservations
	 * @param array|BlackoutItemView[] $conflictingBlackouts
	 * @param string $timezone
	 * @return void
	 */
	public function ShowAddResult($wasAddedSuccessfully, $displayMessage, $conflictingReservations,
								  $conflictingBlackouts, $timezone);

	/**
	 * @param bool $wasAddedSuccessfully
	 * @param string $displayMessage
	 * @param array|ReservationItemView[] $conflictingReservations
	 * @param array|BlackoutItemView[] $conflictingBlackouts
	 * @param string $timezone
	 * @return void
	 */
	public function ShowUpdateResult($wasAddedSuccessfully, $displayMessage, $conflictingReservations,
								  $conflictingBlackouts, $timezone);

	/**
	 * @param int[] $blackoutResourceIds
	 */
	public function SetBlackoutResources($blackoutResourceIds);

	/**
	 * @param string $title
	 */
	public function SetTitle($title);

	/**
	 * @param string $repeatType
	 */
	public function SetRepeatType($repeatType);

	/**
	 * @param int $repeatInterval
	 */
	public function SetRepeatInterval($repeatInterval);

	/**
	 * @param string $repeatMonthlyType
	 */
	public function SetRepeatMonthlyType($repeatMonthlyType);

	/**
	 * @param int[] $repeatWeekdays
	 */
	public function SetRepeatWeekdays($repeatWeekdays);

	/**
	 * @param Date $repeatTerminationDate
	 */
	public function SetRepeatTerminationDate($repeatTerminationDate);

	/**
	 * @param int $blackoutId
	 */
	public function SetBlackoutId($blackoutId);

	/**
	 * @param bool $isRecurring
	 */
	public function SetIsRecurring($isRecurring);

	public function SetBlackoutStartDate(Date $startDate);

	public function SetBlackoutEndDate(Date $endDate);

	/**
	 * @param bool $wasFound
	 */
	public function SetWasBlackoutFound($wasFound);
}

//Class: Supports the blackout controller
class ManageBlackoutsPage extends ActionPage implements IManageBlackoutsPage
{
	/**
	 * @var ManageBlackoutsPresenter
	 */
	private $presenter;

	/**
	 * @var PageablePage
	 */
	private $pageablePage;

	//Construct
	public function __construct()
	{
		parent::__construct('ManageBlackouts', 1);

		$userRepo = new UserRepository();
		$userSession = ServiceLocator::GetServer()->GetUserSession();

		$this->presenter = new ManageBlackoutsPresenter($this,
														new ManageBlackoutsService(new ReservationViewRepository(), new BlackoutRepository(), $userRepo),
														new ScheduleAdminScheduleRepository($userRepo, $userSession),
														new ResourceAdminResourceRepository($userRepo, $userSession));

		$this->pageablePage = new PageablePage($this);
	}

	//Process action
	public function ProcessAction()
	{
		$this->presenter->ProcessAction();
	}

	//Loads page
	public function ProcessPageLoad()
	{
		$userTimezone = $this->server->GetUserSession()->Timezone;

		$this->Set('Timezone', $userTimezone);
		$this->Set('AddStartDate', Date::Now()->ToTimezone($userTimezone));
		$this->Set('AddEndDate', Date::Now()->ToTimezone($userTimezone));
		$this->presenter->PageLoad($userTimezone);
	}

	//Displays page
	public function ShowPage()
	{
		$this->Display('Admin/Blackouts/manage_blackouts.tpl');
	}

	public function ShowBlackout()
	{
		$this->Display('Admin/Blackouts/manage_blackouts_edit.tpl');
	}

	//Result of adding a blackout
	public function ShowAddResult($wasAddedSuccessfully, $displayMessage, $conflictingReservations,
								  $conflictingBlackouts, $timezone)
	{
		$this->Set('Successful', $wasAddedSuccessfully);
		$this->Set('SuccessKey', 'BlackoutCreated');
		$this->Set('FailKey', 'BlackoutNotCreated');
		$this->Set('Message', $displayMessage);
		$this->Set('Reservations', $conflictingReservations);
		$this->Set('Blackouts', $conflictingBlackouts);
		$this->Set('Timezone', $timezone);
		$this->Display('Admin/Blackouts/manage_blackouts_response.tpl');
	}

	//Result of updating a blackout
	public function ShowUpdateResult($wasAddedSuccessfully, $displayMessage, $conflictingReservations,
								  $conflictingBlackouts, $timezone)
	{
		$this->Set('Successful', $wasAddedSuccessfully);
		$this->Set('SuccessKey', 'BlackoutUpdated');
		$this->Set('FailKey', 'BlackoutNotUpdated');
		$this->Set('Message', $displayMessage);
		$this->Set('Reservations', $conflictingReservations);
		$this->Set('Blackouts', $conflictingBlackouts);
		$this->Set('Timezone', $timezone);
		$this->Display('Admin/Blackouts/manage_blackouts_response.tpl');
	}

	//Sends blackout information to Smarty page
	public function BindBlackouts($blackouts)
	{
		$this->Set('blackouts', $blackouts);
	}

	/**
	 * @return string
	 */
	//Gets start date
	public function GetStartDate()
	{
		return $this->server->GetQuerystring(QueryStringKeys::START_DATE);
	}

	/**
	 * @return string
	 */
	//Gets end date
	public function GetEndDate()
	{
		return $this->server->GetQuerystring(QueryStringKeys::END_DATE);
	}

	/**
	 * @param Date $date
	 * @return void
	 */
	//Sets start date
	public function SetStartDate($date)
	{
		$this->Set('StartDate', $date);
	}

	/**
	 * @param Date $date
	 * @return void
	 */
	//Sets end date
	public function SetEndDate($date)
	{
		$this->Set('EndDate', $date);
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

	//Send schedule information to Smarty page
	public function BindSchedules($schedules)
	{
		$this->Set('Schedules', $schedules);
	}

	//Sends resource information to Smarty page
	public function BindResources($resources)
	{
		$this->Set('Resources', $resources);
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
	//Sets pages info
	function BindPageInfo(PageInfo $pageInfo)
	{
		$this->pageablePage->BindPageInfo($pageInfo);
	}

	/**
	 * @return string
	 */
	//Gets deleted blackout identifier
	public function GetDeleteBlackoutId()
	{
		return $this->GetQuerystring(QueryStringKeys::BLACKOUT_ID);
	}

	/**
	 * @return string
	 */
	//Gets serie
	public function GetDeleteScope()
	{
		return $this->GetForm(FormKeys::SERIES_UPDATE_SCOPE);
	}

	/**
	 * @return bool
	 */
	//Checks if it has to be applied to all scheduler
	public function GetApplyBlackoutToAllResources()
	{
		$applyToSchedule = $this->GetForm(FormKeys::BLACKOUT_APPLY_TO_SCHEDULE);
		return isset($applyToSchedule);
	}

	/**
	 * @return int
	 */
	//Gets blackout scheudle identifier
	public function GetBlackoutScheduleId()
	{
		return $this->GetForm(FormKeys::SCHEDULE_ID);
	}

	/**
	 * @return int
	 */
	//Gets blackout resource identifier
	public function GetBlackoutResourceId()
	{
		return $this->GetForm(FormKeys::RESOURCE_ID);
	}

	/**
	 * @return string
	 */
	//Gets start date
	public function GetBlackoutStartDate()
	{
		return $this->GetForm(FormKeys::BEGIN_DATE);
	}

	/**
	 * @return string
	 */
	//Gets start time
	public function GetBlackoutStartTime()
	{
		return $this->GetForm(FormKeys::BEGIN_TIME);
	}

	/**
	 * @return string
	 */
	//Gets end date
	public function GetBlackoutEndDate()
	{
		return $this->GetForm(FormKeys::END_DATE);
	}

	/**
	 * @return string
	 */
	//Gets end time
	public function GetBlackoutEndTime()
	{
		return $this->GetForm(FormKeys::END_TIME);
	}

	/**
	 * @return string
	 */
	//Gets title
	public function GetBlackoutTitle()
	{
		return $this->GetForm(FormKeys::SUMMARY);
	}

	/**
	 * @return string|ReservationConflictResolution
	 */
	public function GetBlackoutConflictAction()
	{
		return $this->GetForm(FormKeys::CONFLICT_ACTION);
	}


	/**
	 * @return int
	 */
	//Gets id
	public function GetBlackoutId()
	{
		return $this->GetQuerystring(QueryStringKeys::BLACKOUT_ID);
	}

	public function ProcessDataRequest($dataRequest)
	{
		// no-op
	}

	//Gets repetition type
	public function GetRepeatType()
	{
		return $this->GetForm(FormKeys::REPEAT_OPTIONS);
	}

	//Gets repetition interval
	public function GetRepeatInterval()
	{
		return $this->GetForm(FormKeys::REPEAT_EVERY);
	}

	//Get days of repetition
	public function GetRepeatWeekdays()
	{
		$days = array();

		$sun = $this->GetForm(FormKeys::REPEAT_SUNDAY);
		if (!empty($sun))
		{
			$days[] = 0;
		}

		$mon = $this->GetForm(FormKeys::REPEAT_MONDAY);
		if (!empty($mon))
		{
			$days[] = 1;
		}

		$tue = $this->GetForm(FormKeys::REPEAT_TUESDAY);
		if (!empty($tue))
		{
			$days[] = 2;
		}

		$wed = $this->GetForm(FormKeys::REPEAT_WEDNESDAY);
		if (!empty($wed))
		{
			$days[] = 3;
		}

		$thu = $this->GetForm(FormKeys::REPEAT_THURSDAY);
		if (!empty($thu))
		{
			$days[] = 4;
		}

		$fri = $this->GetForm(FormKeys::REPEAT_FRIDAY);
		if (!empty($fri))
		{
			$days[] = 5;
		}

		$sat = $this->GetForm(FormKeys::REPEAT_SATURDAY);
		if (!empty($sat))
		{
			$days[] = 6;
		}

		return $days;
	}

	//Gets monthly type repetition
	public function GetRepeatMonthlyType()
	{
		return $this->GetForm(FormKeys::REPEAT_MONTHLY_TYPE);
	}

	//Gets termination date of repetition
	public function GetRepeatTerminationDate()
	{
		return $this->GetForm(FormKeys::END_REPEAT_DATE);
	}

	//Gets serie
	public function GetSeriesUpdateScope()
	{
		$scope = $this->GetForm(FormKeys::SERIES_UPDATE_SCOPE);

		if (empty($scope))
		{
			$scope = SeriesUpdateScope::FullSeries;
		}

		return $scope;
	}

	//Sets blackout resources identifiers
	public function SetBlackoutResources($blackoutResourceIds)
	{
		$this->Set('BlackoutResourceIds', $blackoutResourceIds);
	}

	//Sets title
	public function SetTitle($title)
	{
		$this->Set('BlackoutTitle', $title);
	}

	//Sets recurrence type
	public function SetRepeatType($repeatType)
	{
		$this->Set('RepeatType', $repeatType);
	}

	//Sets recurrence interval
	public function SetRepeatInterval($repeatInterval)
	{
		$this->Set('RepeatInterval', $repeatInterval);
	}

	//Sets monthly type recurrence
	public function SetRepeatMonthlyType($repeatMonthlyType)
	{
		$this->Set('RepeatMonthlyType', $repeatMonthlyType);
	}

	//Sets week days of recurrence
	public function SetRepeatWeekdays($repeatWeekdays)
	{
		$this->Set('RepeatWeekdays', $repeatWeekdays);
	}

	//Sets termination date of recurrence
	public function SetRepeatTerminationDate($repeatTerminationDate)
	{
		$this->Set('RepeatTerminationDate', $repeatTerminationDate);
	}

	//Sets blackout identifier
	public function SetBlackoutId($blackoutId)
	{
		$this->Set('BlackoutId', $blackoutId);
	}

	//Marks as recurrent
	public function SetIsRecurring($isRecurring)
	{
		$this->Set('IsRecurring', $isRecurring);
	}

	//Sets start date
	public function SetBlackoutStartDate(Date $startDate)
	{
		$this->Set('BlackoutStartDate', $startDate);
	}

	//Sets end date
	public function SetBlackoutEndDate(Date $endDate)
	{
		$this->Set('BlackoutEndDate', $endDate);
	}

	//¿?
	public function SetWasBlackoutFound($wasFound)
	{
		$this->Set('WasBlackoutFound', $wasFound);
	}

	//Gets blackout resource identifiers
	public function GetBlackoutResourceIds()
	{
		$resources = $this->GetForm(FormKeys::RESOURCE_ID);

		if (is_null($resources))
		{
			return array();
		}

		if (!is_array($resources))
		{
			return array($resources);
		}


		return $resources;
	}

	//Gets blackout identifier
	public function GetUpdateBlackoutId()
	{
		return $this->GetForm(FormKeys::BLACKOUT_INSTANCE_ID);
	}
}

?>