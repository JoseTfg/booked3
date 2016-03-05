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
require_once(ROOT_DIR . 'config/timezones.php');
require_once(ROOT_DIR . 'lib/Common/Validators/namespace.php');
require_once(ROOT_DIR . 'Domain/namespace.php');

//MyCode
class ManageSchedules
{
	const ActionAdd = 'add';
	const ActionChangeLayout = 'changeLayout';
	const ActionChangeSettings = 'settings';
	const ActionMakeDefault = 'makeDefault';
	const ActionRename = 'rename';
	const ActionDelete = 'delete';
	const ActionEnableSubscription = 'enableSubscription';
	const ActionDisableSubscription = 'disableSubscription';
	const ChangeAdminGroup = 'changeAdminGroup';
}

class ManageScheduleService
{
	/**
	 * @var IScheduleRepository
	 */
	private $scheduleRepository;

	/**
	 * @var IResourceRepository
	 */
	private $resourceRepository;

	/**
	 * @var array|Schedule[]
	 */
	private $_all;

	public function __construct(IScheduleRepository $scheduleRepository, IResourceRepository $resourceRepository)
	{
		$this->scheduleRepository = $scheduleRepository;
		$this->resourceRepository = $resourceRepository;
	}

	/**
	 * @return array|Schedule[]
	 */
	public function GetAll()
	{
		if (is_null($this->_all))
		{
			$this->_all = $this->scheduleRepository->GetAll();
		}
		return $this->_all;
	}

	/**
	 * @return array|Schedule[]
	 */
	public function GetSourceSchedules()
	{
		return $this->GetAll();
	}

	/**
	 * @param Schedule $schedule
	 * @return IScheduleLayout
	 */
	public function GetLayout($schedule)
	{
		return $this->scheduleRepository->GetLayout($schedule->GetId(),
													new ScheduleLayoutFactory($schedule->GetTimezone()));
	}

	/**
	 * @param string $name
	 * @param int $daysVisible
	 * @param int $startDay
	 * @param int $copyLayoutFromScheduleId
	 */
	public function Add($name, $daysVisible, $startDay, $copyLayoutFromScheduleId)
	{
		$schedule = new Schedule(null, $name, false, $startDay, $daysVisible);
		$this->scheduleRepository->Add($schedule, $copyLayoutFromScheduleId);
	}

	/**
	 * @param int $scheduleId
	 * @param string $name
	 */
	public function Rename($scheduleId, $name)
	{
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->SetName($name);
		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $scheduleId
	 * @param int $startDay
	 * @param int $daysVisible
	 */
	public function ChangeSettings($scheduleId, $startDay, $daysVisible)
	{
		Log::Debug('Changing scheduleId %s, WeekdayStart: %s, DaysVisible %s', $scheduleId, $startDay, $daysVisible);
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->SetWeekdayStart($startDay);
		$schedule->SetDaysVisible($daysVisible);

		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $scheduleId
	 * @param string $timezone
	 * @param string $reservableSlots
	 * @param string $blockedSlots
	 */
	public function ChangeLayout($scheduleId, $timezone, $reservableSlots, $blockedSlots)
	{
		$layout = ScheduleLayout::Parse($timezone, $reservableSlots, $blockedSlots);
		$this->scheduleRepository->AddScheduleLayout($scheduleId, $layout);
	}

	/**
	 * @param int $scheduleId
	 * @param string $timezone
	 * @param string[] $reservableSlots
	 * @param string[] $blockedSlots
	 */
	public function ChangeDailyLayout($scheduleId, $timezone, $reservableSlots, $blockedSlots)
	{
		$layout = ScheduleLayout::ParseDaily($timezone, $reservableSlots, $blockedSlots);
		$this->scheduleRepository->AddScheduleLayout($scheduleId, $layout);
	}

	/**
	 * @param int $scheduleId
	 */
	public function MakeDefault($scheduleId)
	{
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->SetIsDefault(true);

		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $scheduleId
	 * @param int $moveResourcesToThisScheduleId
	 */
	public function Delete($scheduleId, $moveResourcesToThisScheduleId)
	{
		$resources = $this->resourceRepository->GetScheduleResources($scheduleId);
		foreach ($resources as $resource)
		{
			$resource->SetScheduleId($moveResourcesToThisScheduleId);
			$this->resourceRepository->Update($resource);
		}

		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$this->scheduleRepository->Delete($schedule);
	}

	/**
	 * @param int $scheduleId
	 */
	public function EnableSubscription($scheduleId)
	{
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->EnableSubscription();
		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $scheduleId
	 */
	public function DisableSubscription($scheduleId)
	{
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->DisableSubscription();
		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $scheduleId
	 * @param int $adminGroupId
	 */
	public function ChangeAdminGroup($scheduleId, $adminGroupId)
	{
		$schedule = $this->scheduleRepository->LoadById($scheduleId);
		$schedule->SetAdminGroupId($adminGroupId);
		$this->scheduleRepository->Update($schedule);
	}

	/**
	 * @param int $pageNumber
	 * @param int $pageSize
	 * @return PageableData|BookableResource[]
	 */
	public function GetList($pageNumber, $pageSize)
	{
		return $this->scheduleRepository->GetList($pageNumber, $pageSize);
	}
}

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
	
	//MyCode
	private $manageSchedulesService;

	/**
	 * @var IGroupViewRepository
	 */
	private $groupViewRepository;

	public function __construct(
			IPersonalCalendarPage $page,
			IReservationViewRepository $repository,
			ICalendarFactory $calendarFactory,
			ICalendarSubscriptionService $subscriptionService,
			IUserRepository $userRepository,
			IResourceService $resourceService,
			IScheduleRepository $scheduleRepository,
			ManageScheduleService $manageSchedulesService)
	{
		parent::__construct($page);

		$this->page = $page;
		$this->reservationRepository = $repository;
		$this->calendarFactory = $calendarFactory;
		$this->subscriptionService = $subscriptionService;
		$this->userRepository = $userRepository;
		$this->resourceService = $resourceService;
		$this->scheduleRepository = $scheduleRepository;

		$this->AddAction(PersonalCalendarActions::ActionEnableSubscription, 'EnableSubscription');
		$this->AddAction(PersonalCalendarActions::ActionDisableSubscription, 'DisableSubscription');
		
		$this->manageSchedulesService = $manageSchedulesService;
		$this->groupViewRepository = $groupViewRepository;	
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
		$reservations = $this->reservationRepository->GetReservationList($calendar->FirstDay(), $calendar->LastDay()->AddDays(1), $userSession->UserId,
																		 ReservationUserLevel::ALL, $selectedScheduleId, $selectedResourceId);
		$calendar->AddReservations(CalendarReservation::FromViewList($reservations, $timezone, $userSession, true));
		$this->page->BindCalendar($calendar);

		$this->page->SetDisplayDate($calendar->FirstDay());

		$this->page->BindFilters(new CalendarFilters($schedules, $resources, $selectedScheduleId, $selectedResourceId, $resourceGroups));

		$this->page->SetScheduleId($selectedScheduleId);
		$this->page->SetResourceId($selectedResourceId);

		$this->page->SetFirstDay($selectedSchedule->GetWeekdayStart());

		$details = $this->subscriptionService->ForUser($userSession->UserId);
		$this->page->BindSubscription($details);
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////MyCode/////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		//Getting the schedules
		$results = $this->manageSchedulesService->GetList($this->page->GetPageNumber(), $this->page->GetPageSize());
		$schedules = $results->Results();
		$sourceSchedules = $this->manageSchedulesService->GetSourceSchedules();

		//Initializing arrays
		$layouts = array();
		$$periodStart = array();
		$periodEnd = array();
		
		//Period count
		$periodCount = 1;
		
		//Getting the periods
		foreach ($schedules as $schedule)
		{
			$layout = $this->manageSchedulesService->GetLayout($schedule);
			$layouts[$schedule->GetId()] = $layout;
			$periods = $layout->GetSlots(null);
			foreach ($periods as $period)
		{
			if ($period->IsReservable() && $schedule->GetId() == 1){
			$periodStart[$periodCount] = $period->Start;
			$periodEnd[$periodCount] = $period->End;
			$periodCount = $periodCount + 1;			
			}		
		}		
				
		//Setting minTime and maxTime	
		$minTime = $periodStart[1];
		$maxTime = end($periodEnd);
		
		}

		//Calendar is personal
		$myCal = true;
		
		//Setting values
		$this->page->BindSchedules($schedules, $layouts, $sourceSchedules, $minTime, $maxTime, $myCal);
		$this->page->BindPageInfo($results->PageInfo());
		$this->PopulateTimezones();
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	}	
	private function PopulateTimezones()
	{
		$timezoneValues = array();
		$timezoneOutput = array();

		foreach ($GLOBALS['APP_TIMEZONES'] as $timezone)
		{
			$timezoneValues[] = $timezone;
			$timezoneOutput[] = $timezone;
		}

		$this->page->SetTimezones($timezoneValues, $timezoneOutput);
	}

	public function EnableSubscription()
	{
		$userId = ServiceLocator::GetServer()->GetUserSession()->UserId;
		Log::Debug('Enabling calendar subscription for userId: %s', $userId);

		$user = $this->userRepository->LoadById($userId);
		$user->EnableSubscription();
		$this->userRepository->Update($user);
	}

	public function DisableSubscription()
	{
		$userId = ServiceLocator::GetServer()->GetUserSession()->UserId;
		Log::Debug('Disabling calendar subscription for userId: %s', $userId);

		$user = $this->userRepository->LoadById($userId);
		$user->DisableSubscription();
		$this->userRepository->Update($user);
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