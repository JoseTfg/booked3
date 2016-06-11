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
require_once(ROOT_DIR . 'lib/Config/Configurator.php');									//MyCode (29/3/2016)
require_once(ROOT_DIR . 'lib/Application/Reservation/namespace.php');					//MyCode (28/4/2016)
require_once(ROOT_DIR . 'Presenters/Calendar/PersonalCalendarPresenterEnhance.php'); 	//MyCode (7/5/2016)

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
	public $page; //MyCode

	/**
	 * @var \IReservationViewRepository
	 */
	public $reservationRepository; //MyCode

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
	public $configSettings;
	
		/**
	 * @var IManageBlackoutsService
	 */
	public $manageBlackoutsService;		//MyCode

	public function __construct(
			IPersonalCalendarPage $page,
			IReservationViewRepository $repository,
			ICalendarFactory $calendarFactory,
			ICalendarSubscriptionService $subscriptionService,
			IUserRepository $userRepository,
			IResourceService $resourceService,
			IScheduleRepository $scheduleRepository,
			IConfigurationSettings $settings,
			//new
			IManageBlackoutsService $manageBlackoutsService)
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
		
		//MyCode (28/4/2016)
		//Inits the blackout manage service.
		$this->manageBlackoutsService = $manageBlackoutsService;
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

		//MyCode
		$this->page->Set('resources', $resources);
		
		$selectedScheduleId = $this->page->GetScheduleId();
		
		//MyCode
		foreach ($schedules as $schedule){
			if ($schedule->GetIsDefault())
			{
				$selectedSchedule = $schedule;
				break;
			}
		}		 
		
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

		////////////////////////////////////////////////////////////////Enhance////////////////////////////////////////////////////////////////////////////////
		
		//MyCode 4/5/2016
		//Colors
		$newColor = colors($this, $userSession);
		
		//MyCode (14/3/2016)
		//Array of selected resources.		
		$selectedResourceArrayId = getResourceArrayId();
		
		//MyCode
		//Builds calendar
		$calendar = buildCalendar($this, $calendar, $selectedScheduleId, $selectedResourceId, $selectedResourceArrayId, $reservations, $resources, $userSession, $timezone);
		$this->page->BindCalendar($calendar);
		$this->page->SetDisplayDate($calendar->FirstDay());
		$this->page->BindFilters(new CalendarFilters($schedules, $resources, $selectedScheduleId, $selectedResourceId, $resourceGroups));
		$this->page->SetScheduleId($selectedScheduleId);
		$this->page->SetResourceId($selectedResourceId);
		$this->page->SetFirstDay($selectedSchedule->GetWeekdayStart());	

		//MyCode (29/3/2016)
		//This code sets the minTime and maxTime of the calendar.
		$newTime = calendarBoundaries($this, $userSession);	
		
		//MyCode
		//settings
		$settingType = "";
		if ($newColor != ""){
			$settingType = "color";
			$changedSetting = $newColor;
		}
		if ($newTime != ""){
			$settingType = "time";
			$changedSetting = $newTime;
		}
		sendSettings($this, $userSession, $settingType, $changedSetting);

		//MyCode
		//Blackouts
		blackoutsList($this);
		
		//MyCode
		//GoogleCalendar
		$calendar_export = $this->calendarFactory->Create($type, $year, $month, $day, $timezone, $selectedSchedule->GetWeekdayStart());
		$exports =  $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddMonths(12), $userSession->UserId,
		ReservationUserLevel::ALL, $selectedScheduleId, 0);
		$calendar_export->AddReservations(CalendarReservation::FromViewList($exports, $timezone, $userSession, true));
		$this->page->Set('calendar_export', $calendar_export); //A Borrar
		
		googleCalendar($this, $userSession,$calendar_export);
		
		APIconnection($this);

	}
}