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

require_once(ROOT_DIR . 'Pages/SecurePage.php');
require_once(ROOT_DIR . 'Presenters/SchedulePresenter.php');

interface ISchedulePage extends IActionPage
{
	/**
	 * Bind schedules to the page
	 *
	 * @param array|Schedule[] $schedules
	 */
	public function SetSchedules($schedules);

	/**
	 * Bind resources to the page
	 *
	 * @param array|ResourceDto[] $resources
	 */
	public function SetResources($resources);

	/**
	 * Bind layout to the page for daily time slot layouts
	 *
	 * @param IDailyLayout $dailyLayout
	 */
	public function SetDailyLayout($dailyLayout);

	/**
	 * Returns the currently selected scheduleId
	 * @return int
	 */
	public function GetScheduleId();

	/**
	 * @param int $scheduleId
	 */
	public function SetScheduleId($scheduleId);

	/**
	 * @param string $scheduleName
	 */
	public function SetScheduleName($scheduleName);

	/**
	 * @param int $firstWeekday
	 */
	public function SetFirstWeekday($firstWeekday);

	/**
	 * Sets the dates to be displayed for the schedule, adjusted for timezone if necessary
	 *
	 * @param DateRange $dates
	 */
	public function SetDisplayDates($dates);

	/**
	 * @param Date $previousDate
	 * @param Date $nextDate
	 */
	public function SetPreviousNextDates($previousDate, $nextDate);

	/**
	 * @return string
	 */
	public function GetSelectedDate();

	/**
	 * @abstract
	 */
	public function ShowInaccessibleResources();

	/**
	 * @abstract
	 * @param bool $showShowFullWeekToggle
	 */
	public function ShowFullWeekToggle($showShowFullWeekToggle);

	/**
	 * @abstract
	 * @return bool
	 */
	public function GetShowFullWeek();

	/**
	 * @param ScheduleLayoutSerializable $layoutResponse
	 */
	public function SetLayoutResponse($layoutResponse);

	/**
	 * @return string
	 */
	public function GetLayoutDate();

	/**
	 * @param int $scheduleId
	 * @return string|ScheduleStyle
	 */
	public function GetScheduleStyle($scheduleId);

	/**
	 * @param string|ScheduleStyle Direction
	 */
	public function SetScheduleStyle($direction);

	/**
	 * @return int
	 */
	public function GetGroupId();

	/**
	 * @return int
	 */
	public function GetResourceId();

	/**
	 * @param ResourceGroupTree $resourceGroupTree
	 */
	public function SetResourceGroupTree(ResourceGroupTree $resourceGroupTree);

	/**
	 * @param ResourceType[] $resourceTypes
	 */
	public function SetResourceTypes($resourceTypes);

	/**
	 * @param Attribute[] $attributes
	 */
	public function SetResourceCustomAttributes($attributes);

	/**
	 * @param Attribute[] $attributes
	 */
	public function SetResourceTypeCustomAttributes($attributes);

	/**
	 * @return bool
	 */
	public function FilterSubmitted();

	/**
	 * @return int
	 */
	public function GetResourceTypeId();

	/**
	 * @return int
	 */
	public function GetMaxParticipants();

	/**
	 * @return AttributeFormElement[]|array
	 */
	public function GetResourceAttributes();

	/**
	 * @return AttributeFormElement[]|array
	 */
	public function GetResourceTypeAttributes();

	/**
	 * @param ScheduleResourceFilter $resourceFilter
	 */
	public function SetFilter($resourceFilter);

	/**
	 * @param CalendarSubscriptionUrl $subscriptionUrl
	 */
	public function SetSubscriptionUrl(CalendarSubscriptionUrl $subscriptionUrl);

	/**
	 * @param bool $shouldShow
	 */
	public function ShowPermissionError($shouldShow);

	/**
	 * @param UserSession $user
	 * @param Schedule $schedule
	 * @return string
	 */
	public function GetDisplayTimezone(UserSession $user, Schedule $schedule);
}

//Unused
class ScheduleStyle
{
	const Wide = 'Wide';
	const Tall = 'Tall';
	const Standard = 'Standard';
	const CondensedWeek = 'CondensedWeek';
}

//Class: Supports the schedule controller
class SchedulePage extends ActionPage implements ISchedulePage
{
	protected $ScheduleStyle = ScheduleStyle::Standard;

	private $resourceCount = 0;

	/**
	 * @var SchedulePresenter
	 */
	protected $_presenter;

	private $_styles = array(
		ScheduleStyle::Wide => 'Schedule/schedule-days-horizontal.tpl',
		ScheduleStyle::Tall => 'Schedule/schedule-flipped.tpl',
		ScheduleStyle::CondensedWeek => 'Schedule/schedule-week-condensed.tpl',
	);

	/**
	 * @var bool
	 */
	private $_isFiltered = true;

	//Construct
	public function __construct()
	{
		parent::__construct('Schedule');

		$permissionServiceFactory = new PermissionServiceFactory();
		$scheduleRepository = new ScheduleRepository();
		$userRepository = new UserRepository();
		$resourceService = new ResourceService(new ResourceRepository(), $permissionServiceFactory->GetPermissionService(), new AttributeService(new AttributeRepository()), $userRepository);
		$pageBuilder = new SchedulePageBuilder();
		$reservationService = new ReservationService(new ReservationViewRepository(), new ReservationListingFactory());
		$dailyLayoutFactory = new DailyLayoutFactory();
		$scheduleService = new ScheduleService($scheduleRepository, $resourceService);
		$this->_presenter = new SchedulePresenter($this, $scheduleService, $resourceService, $pageBuilder, $reservationService, $dailyLayoutFactory);
	}

	//Page load
	public function ProcessPageLoad()
	{
		$start = microtime(true);

		$user = ServiceLocator::GetServer()->GetUserSession();

		$this->_presenter->PageLoad($user);

		$endLoad = microtime(true);

		if ($user->IsAdmin && $this->resourceCount == 0 && !$this->_isFiltered)
		{
			$this->Set('ShowResourceWarning', true);
		}

		$this->Set('SlotLabelFactory', $user->IsAdmin ? new AdminSlotLabelFactory() : new SlotLabelFactory($user));
		$this->Set('DisplaySlotFactory', new DisplaySlotFactory());

		if (array_key_exists($this->ScheduleStyle, $this->_styles))
		{
			$this->Display($this->_styles[$this->ScheduleStyle]);
		}
		else
		{
			$this->Display('Schedule/schedule.tpl');
		}

		$endDisplay = microtime(true);

		$load = $endLoad - $start;
		$display = $endDisplay - $endLoad;
		$total = $endDisplay - $start;

		Log::Debug('Schedule took %s sec to load, %s sec to render. Total %s sec', $load, $display, $total);
	}

	//Process request
	public function ProcessDataRequest($dataRequest)
	{
		$this->_presenter->GetLayout(ServiceLocator::GetServer()
									 ->GetUserSession());
	}

	//Unused
	public function GetScheduleId()
	{
		return $this->GetQuerystring(QueryStringKeys::SCHEDULE_ID);
	}

	//Unused
	public function SetScheduleId($scheduleId)
	{
		$this->Set('ScheduleId', $scheduleId);
	}

	//Unused
	public function SetScheduleName($scheduleName)
	{
		$this->Set('ScheduleName', $scheduleName);
	}

	//Unused
	public function SetSchedules($schedules)
	{
		$this->Set('Schedules', $schedules);
	}

	//Unused
	public function SetFirstWeekday($firstWeekday)
	{
		$this->Set('FirstWeekday', $firstWeekday);
	}

	//Unused
	public function SetResources($resources)
	{
		$this->resourceCount = count($resources);
		$this->Set('Resources', $resources);
	}

	//Unused
	public function SetDailyLayout($dailyLayout)
	{
		$this->Set('DailyLayout', $dailyLayout);
	}

	//Unused
	public function SetDisplayDates($dateRange)
	{
		$this->Set('DisplayDates', $dateRange);
		$this->Set('BoundDates', $dateRange->Dates());
	}

	//Unused
	public function SetPreviousNextDates($previousDate, $nextDate)
	{
		$this->Set('PreviousDate', $previousDate);
		$this->Set('NextDate', $nextDate);
	}

	//Unused
	public function GetSelectedDate()
	{
		// TODO: Clean date
		return $this->server->GetQuerystring(QueryStringKeys::START_DATE);
	}

	//Unused
	public function ShowInaccessibleResources()
	{
		return Configuration::Instance()
			   ->GetSectionKey(ConfigSection::SCHEDULE,
							   ConfigKeys::SCHEDULE_SHOW_INACCESSIBLE_RESOURCES,
							   new BooleanConverter());
	}

	//Unused
	public function ShowFullWeekToggle($showShowFullWeekToggle)
	{
		$this->Set('ShowFullWeekLink', $showShowFullWeekToggle);
	}

	//Unused
	public function GetShowFullWeek()
	{
		$showFullWeek = $this->GetQuerystring(QueryStringKeys::SHOW_FULL_WEEK);

		return !empty($showFullWeek);
	}

	//Unused
	public function ProcessAction()
	{
		// no-op
	}

	//Unused
	public function SetLayoutResponse($layoutResponse)
	{
		$this->SetJson($layoutResponse);
	}

	//Unused
	public function GetLayoutDate()
	{
		return $this->GetQuerystring(QueryStringKeys::LAYOUT_DATE);
	}

	//Unused
	public function GetScheduleStyle($scheduleId)
	{
		$cookie = $this->server->GetCookie("schedule-direction-$scheduleId");
		if ($cookie != null)
		{
			return $cookie;
		}

		return ScheduleStyle::Standard;
	}

	//Unused
	public function SetScheduleStyle($direction)
	{
		$this->ScheduleStyle = $direction;
		$this->Set('CookieName', 'schedule-direction-' . $this->GetVar('ScheduleId'));
		$this->Set('CookieValue', $direction);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetGroupId()
	{
		return $this->GetQuerystring(QueryStringKeys::GROUP_ID);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetResourceId()
	{
		return $this->GetQuerystring(QueryStringKeys::RESOURCE_ID);
	}

	//Unused
	public function SetResourceGroupTree(ResourceGroupTree $resourceGroupTree)
	{
		$this->Set('ResourceGroupsAsJson', json_encode($resourceGroupTree->GetGroups()));
	}

	//Unused
	public function SetResourceTypes($resourceTypes)
	{
		$this->Set('ResourceTypes', $resourceTypes);
	}

	//Unused
	public function SetResourceCustomAttributes($attributes)
	{
		$this->Set('ResourceAttributes', $attributes);
	}

	//Unused
	public function SetResourceTypeCustomAttributes($attributes)
	{
		$this->Set('ResourceTypeAttributes', $attributes);
	}

	//Unused
	public function FilterSubmitted()
	{
		$k = $this->GetForm(FormKeys::SUBMIT);

		return !empty($k);
	}

	//Unused
	public function GetResourceTypeId()
	{
		return $this->GetForm(FormKeys::RESOURCE_TYPE_ID);
	}

	//Unused
	public function GetMaxParticipants()
	{
		$max = $this->GetForm(FormKeys::MAX_PARTICIPANTS);
		return intval($max);
	}

	//Unused
	public function GetResourceAttributes()
	{
		return AttributeFormParser::GetAttributes($this->GetForm('r' . FormKeys::ATTRIBUTE_PREFIX));
	}

	//Unused
	public function GetResourceTypeAttributes()
	{
		return AttributeFormParser::GetAttributes($this->GetForm('rt' . FormKeys::ATTRIBUTE_PREFIX));
	}

	//Unused
	public function SetFilter($resourceFilter)
	{
		$this->Set('ResourceIdFilter', $this->GetResourceId());
		$this->Set('ResourceTypeIdFilter', $resourceFilter->ResourceTypeId);
		$this->Set('MaxParticipantsFilter', $resourceFilter->MinCapacity);
		$this->_isFiltered = $resourceFilter->HasFilter();
	}

	//Unused
	public function SetSubscriptionUrl(CalendarSubscriptionUrl $subscriptionUrl)
	{
		$this->Set('SubscriptionUrl', $subscriptionUrl);
	}

	//Unused
	public function ShowPermissionError($shouldShow)
	{
		$this->Set('IsAccessible', !$shouldShow);
	}

	//Unused
	public function GetDisplayTimezone(UserSession $user, Schedule $schedule)
	{
		return $user->Timezone;
	}
}

//Class: Supports the period slots
class DisplaySlotFactory
{
	//Gets function
	public function GetFunction(IReservationSlot $slot, $accessAllowed = false)
	{
		if ($slot->IsReserved())
		{
			if ($this->IsMyReservation($slot))
			{
				return 'displayMyReserved';
			}
			elseif ($this->AmIParticipating($slot))
			{
				return 'displayMyParticipating';
			}
			else
			{
				return 'displayReserved';
			}
		}
		else
		{
			if (!$accessAllowed)
			{
				return 'displayRestricted';
			}
			else
			{
				if ($slot->IsPastDate(Date::Now()) && !$this->UserHasAdminRights())
				{
					return 'displayPastTime';
				}
				else
				{
					if ($slot->IsReservable())
					{
						return 'displayReservable';
					}
					else
					{
						return 'displayUnreservable';
					}
				}
			}
		}

		return null;
	}

	//Is admin
	private function UserHasAdminRights()
	{
		return ServiceLocator::GetServer()
			   ->GetUserSession()->IsAdmin;
	}

	//Is personal reservation
	private function IsMyReservation(IReservationSlot $slot)
	{
		$mySession = ServiceLocator::GetServer()
					 ->GetUserSession();
		return $slot->IsOwnedBy($mySession);
	}

	//Is personal participation
	private function AmIParticipating(IReservationSlot $slot)
	{
		$mySession = ServiceLocator::GetServer()
					 ->GetUserSession();
		return $slot->IsParticipating($mySession);
	}
}