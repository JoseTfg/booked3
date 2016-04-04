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

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Schedule/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');
require_once(ROOT_DIR . 'Presenters/Calendar/CalendarFilters.php');
require_once(ROOT_DIR . 'lib/Config/Configurator.php');		//MyCode (29/3/2016)

class PersonalCalendarActions
{
	const ActionEnableSubscription = 'enable';
	const ActionDisableSubscription = 'disable';
}

class PersonalCalendarPresenter extends ActionPresenter
{
	/**
	 * @var \IPersonalCalendarPage
	 */
	private $page;

	/**
	 * @var \IReservationViewRepository
	 */
	private $reservationRepository;

	/**
	 * @var \ICalendarFactory
	 */
	private $calendarFactory;

	/**
	 * @var ICalendarSubscriptionService
	 */
	private $subscriptionService;

	/**
	 * @var IUserRepository
	 */
	private $userRepository;

	/**
	 * @var IResourceService
	 */
	private $resourceService;

	/**
	 * @var IScheduleRepository
	 */
	private $scheduleRepository;

	/**
	 * @var IGroupViewRepository
	 */
	private $groupViewRepository;
	
	//MyCode
	private $configSettings;

	public function __construct(
			IPersonalCalendarPage $page,
			IReservationViewRepository $repository,
			ICalendarFactory $calendarFactory,
			ICalendarSubscriptionService $subscriptionService,
			IUserRepository $userRepository,
			IResourceService $resourceService,
			IScheduleRepository $scheduleRepository,
			IConfigurationSettings $settings)
	{
		parent::__construct($page);

		$this->page = $page;
		$this->reservationRepository = $repository;
		$this->calendarFactory = $calendarFactory;
		$this->subscriptionService = $subscriptionService;
		$this->userRepository = $userRepository;
		$this->resourceService = $resourceService;
		$this->scheduleRepository = $scheduleRepository;

		//MyCode (29/3/2016)
		//Obtains the config settings document.
		$this->configSettings = $settings;
		$this->configFilePath = ROOT_DIR . 'config/config.php';
	}

	/**
	 * @param UserSession $userSession
	 * @param string $timezone
	 */
	public function PageLoad($userSession, $timezone)
	{
		$type = $this->page->GetCalendarType();		
		$year = $this->page->GetYear();
		$month = $this->page->GetMonth();
		$day = $this->page->GetDay();

		$defaultDate = Date::Now()->ToTimezone($timezone);

		if (empty($year))
		{
			$year = $defaultDate->Year();
		}
		if (empty($month))
		{
			$month = $defaultDate->Month();
		}
		if (empty($day))
		{
			$day = $defaultDate->Day();
		}


		$schedules = $this->scheduleRepository->GetAll();
		$showInaccessible = Configuration::Instance()
										 ->GetSectionKey(ConfigSection::SCHEDULE, ConfigKeys::SCHEDULE_SHOW_INACCESSIBLE_RESOURCES, new BooleanConverter());
		$resources = $this->resourceService->GetAllResources($showInaccessible, $userSession);

		$selectedScheduleId = $this->page->GetScheduleId();
		$selectedSchedule = $this->GetDefaultSchedule($schedules);
		$selectedResourceId = $this->page->GetResourceId();	

		$resourceGroups = $this->resourceService->GetResourceGroups($selectedScheduleId, $userSession);

		if (!empty($selectedGroupId))
		{
			$tempResources = array();
			$resourceIds = $resourceGroups->GetResourceIds($selectedGroupId);
			$selectedGroup = $resourceGroups->GetGroup($selectedGroupId);
			$this->page->BindSelectedGroup($selectedGroup);

			foreach ($resources as $resource)
			{
				if (in_array($resource->GetId(), $resourceIds))
				{
					$tempResources[] = $resource;
				}
			}

			$resources = $tempResources;
		}

		$calendar = $this->calendarFactory->Create($type, $year, $month, $day, $timezone, $selectedSchedule->GetWeekdayStart());
		
		//MyCode (28/3/2016)
		//Declaration
		$reservations2 = array();		
		$isPersonal = $_GET["mycal"];		

		//MyCode (14/3/2016)
		//Array of selected resources.
		$selectedResourceIdA = null;
		if (isset($_GET['rid']))
			{
				$selectedResourceIdA = explode(",", $_GET['rid']);
				
		}
		
		//This code allows to build the calendar for either personal or global scope.
		if ($isPersonal != null){
			//Global Calendar
			$myCal = false;		
			
			//Building the calendar.
			if (is_array($selectedResourceIdA) || is_object($selectedResourceIdA)){
		foreach ($selectedResourceIdA as $selectedResourceId){
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), null, null,
		$selectedScheduleId, $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromScheduleReservationList(
									   $reservations,
									   $resources,
									   $userSession,
									   true));
									   
		//MyCode (28/3/2016)
		 //This allows multiple resource selection in the list view.
		 array_push($reservations2,$reservations);
		}
		}
		else{
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1),
		null, null,	$selectedScheduleId, 0);
		 $calendar->AddReservations(CalendarReservation::FromScheduleReservationList(
									   $reservations,
									   $resources,
									   $userSession,
									   true));
		}
		}
		else{
			//PersonalCalendar
			$myCal = true;
			
			//Building the calendar.
			if (is_array($selectedResourceIdA) || is_object($selectedResourceIdA)){
		foreach ($selectedResourceIdA as $selectedResourceId){
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), $userSession->UserId,
		ReservationUserLevel::ALL, $selectedScheduleId, $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromViewList($reservations, $timezone, $userSession, true));
		 
		 //MyCode (28/3/2016)
		 //This allows multiple resource selection in the list view.
		 array_push($reservations2,$reservations);
		}
		}
		else{
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), $userSession->UserId,
		 ReservationUserLevel::ALL, $selectedScheduleId, 0);
		 $calendar->AddReservations(CalendarReservation::FromViewList($reservations, $timezone, $userSession, true));
		}		
		}		

		$this->page->BindCalendar($calendar);

		$this->page->SetDisplayDate($calendar->FirstDay());

		$this->page->BindFilters(new CalendarFilters($schedules, $resources, $selectedScheduleId, $selectedResourceId, $resourceGroups));

		$this->page->SetScheduleId($selectedScheduleId);
		$this->page->SetResourceId($selectedResourceId);

		$this->page->SetFirstDay($selectedSchedule->GetWeekdayStart());

		$details = $this->subscriptionService->ForUser($userSession->UserId);
		$this->page->BindSubscription($details);		

		//MyCode (29/3/2016)
		//This code sets the minTime and maxTime of the calendar.
		$somevar2 = $_POST["a1"];
		$somevar3 = $_POST["a2"];
		$existingSettings = $this->configSettings->GetSettings($this->configFilePath);
		
		foreach ($existingSettings as $setting => $value){
		if ($setting == "minTime"){
			$minTime = $value;
			}
		if ($setting == "maxTime"){
			$maxTime = $value;
			}
		}		
		if (($somevar2 != $minTime || $somevar3 != $maxTime) && $somevar2 != ""){		
			$newSettings = array();
			$newSettings['minTime'] = $somevar2;
			$newSettings['maxTime'] = $somevar3;			
			$mergedSettings = array_merge($existingSettings, $newSettings);
			$this->configSettings->WriteSettings($this->configFilePath, $mergedSettings);
			$minTime = $somevar2;
			$maxTime = $somevar3;
			}
		
		//MyCode (14/3/2016)
		//This code allows connection with the API.
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$this->page->Set('username', $username);
		$this->page->Set('password', $password);			
		
		//MyCode (28/3/2016)
		//This code sends the values to the page.
		$this->page->Set('reservations', $reservations);
		$this->page->Set('reservations2', $reservations2);
		$this->page->Set('minTime', $minTime);
		$this->page->Set('maxTime', $maxTime);
		$this->page->Set('myCal', $myCal);
	}	

	/**
	 * @param array|Schedule[] $schedules
	 * @return Schedule
	 */
	private function GetDefaultSchedule($schedules)
	{
		$default = null;
		$scheduleId = $this->page->GetScheduleId();

		/** @var $schedule Schedule */
		foreach ($schedules as $schedule)
		{
			if (!empty($scheduleId) && $schedule->GetId() == $scheduleId)
			{
				return $schedule;
			}

			if ($schedule->GetIsDefault())
			{
				$default = $schedule;
			}
		}

		return $default;
	}
}