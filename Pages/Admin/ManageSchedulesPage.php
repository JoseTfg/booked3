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
require_once(ROOT_DIR . 'Presenters/Admin/ManageSchedulesPresenter.php');
require_once(ROOT_DIR . 'Domain/Access/ScheduleRepository.php');

interface IUpdateSchedulePage
{
	/**
	 * @return int
	 */
	function GetScheduleId();

	/**
	 * @return string
	 */
	function GetScheduleName();

	/**
	 * @return string
	 */
	function GetStartDay();

	/**
	 * @return string
	 */
	function GetDaysVisible();

	/**
	 * @return string
	 */
	function GetReservableSlots();

	/**
	 * @return string
	 */
	function GetBlockedSlots();

	/**
	 * @return string[]
	 */
	function GetDailyReservableSlots();

	/**
	 * @return string[]
	 */
	function GetDailyBlockedSlots();

	/**
	 * @return string
	 */
	function GetLayoutTimezone();

	/**
	 * @return bool
	 */
	function GetUsingSingleLayout();

	/**
	 * @return int
	 */
	function GetSourceScheduleId();

	/**
	 * @return int
	 */
	function GetTargetScheduleId();
}

interface IManageSchedulesPage extends IUpdateSchedulePage, IActionPage, IPageable
{
	/**
	 * @param Schedule[] $schedules
	 * @param array|IScheduleLayout[] $layouts
	 * @param Schedule[] $sourceSchedules
	 */
	public function BindSchedules($schedules, $layouts, $sourceSchedules);

	/**
	 * @abstract
	 * @param GroupItemView[] $groups
	 */
	public function BindGroups($groups);

	public function SetTimezones($timezoneValues, $timezoneOutput);

	/**
	 * @abstract
	 * @return int
	 */
	public function GetAdminGroupId();
}

//Class: Supports schedule management controller
class ManageSchedulesPage extends ActionPage implements IManageSchedulesPage
{
	/**
	 * @var ManageSchedulesPresenter
	 */
	protected $_presenter;

	//Construct
	public function __construct()
	{
		parent::__construct('ManageSchedules', 1);

		$this->pageablePage = new PageablePage($this);
		$this->_presenter = new ManageSchedulesPresenter($this, new ManageScheduleService(new ScheduleRepository(), new ResourceRepository()),
														 new GroupRepository());
	}

	//Displays page
	public function ProcessPageLoad()
	{
		$this->_presenter->PageLoad();

		$daynames = Resources::GetInstance()->GetDays('full');
		$this->Set('DayNames', $daynames);
		$this->Set('Today', Resources::GetInstance()->GetString('Today'));
		$this->Display('Admin/manage_schedules.tpl');
	}

	//Process action
	public function ProcessAction()
	{
		$this->_presenter->ProcessAction();
	}

	//Sets timezones
	public function SetTimezones($timezoneValues, $timezoneOutput)
	{
		$this->Set('TimezoneValues', $timezoneValues);
		$this->Set('TimezoneOutput', $timezoneOutput);
	}

	//Sends schedule information to the Smarty page
	public function BindSchedules($schedules, $layouts, $sourceSchedules)
	{
		$this->Set('Schedules', $schedules);
		$this->Set('Layouts', $layouts);
		$this->Set('SourceSchedules', $sourceSchedules);
	}

	//Unused
	public function GetScheduleId()
	{
		return $this->server->GetQuerystring(QueryStringKeys::SCHEDULE_ID);
	}

	//Unused
	public function GetScheduleName()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_NAME);
	}

	//Unused
	function GetStartDay()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_WEEKDAY_START);
	}

	//Unused
	function GetDaysVisible()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_DAYS_VISIBLE);
	}

	//Gets reservable periods
	public function GetReservableSlots()
	{
		return $this->server->GetForm(FormKeys::SLOTS_RESERVABLE);
	}

	//Gets blocked periods
	public function GetBlockedSlots()
	{
		return $this->server->GetForm(FormKeys::SLOTS_BLOCKED);
	}

	//Unused
	public function GetDailyReservableSlots()
	{
		$slots = array();
		foreach (DayOfWeek::Days() as $day)
		{
			$slots[$day] = $this->server->GetForm(FormKeys::SLOTS_RESERVABLE . "_$day");
		}
		return $slots;
	}

	//Unused
	public function GetDailyBlockedSlots()
	{
		$slots = array();
		foreach (DayOfWeek::Days() as $day)
		{
			$slots[$day] = $this->server->GetForm(FormKeys::SLOTS_BLOCKED . "_$day");
		}
		return $slots;
	}

	//Unused
	public function GetUsingSingleLayout()
	{
		$singleLayout = $this->server->GetForm(FormKeys::USING_SINGLE_LAYOUT);

		return !empty($singleLayout);
	}

	//Gets the layout timezone
	public function GetLayoutTimezone()
	{
		return $this->server->GetForm(FormKeys::TIMEZONE);
	}

	//Unused
	public function GetSourceScheduleId()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_ID);
	}

	//Unused
	public function GetTargetScheduleId()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_ID);
	}

	public function ProcessDataRequest($dataRequest)
	{
		// no-op
	}

	/**
	 * @param GroupItemView[] $groups
	 */
	//Unused
	public function BindGroups($groups)
	{
		$this->Set('AdminGroups', $groups);
		$groupLookup = array();
		foreach ($groups as $group)
		{
			$groupLookup[$group->Id] = $group;
		}
		$this->Set('GroupLookup', $groupLookup);
	}

	/**
	 * @return int
	 */
	//Unused
	public function GetAdminGroupId()
	{
		return $this->server->GetForm(FormKeys::SCHEDULE_ADMIN_GROUP_ID);
	}

	/**
	 * @return int
	 */
	//Unused
	function GetPageNumber()
	{
		return $this->pageablePage->GetPageNumber();
	}

	/**
	 * @return int
	 */
	//Unused
	function GetPageSize()
	{
		$pageSize = $this->pageablePage->GetPageSize();

		if ($pageSize > 10)
		{
			return 10;
		}
		return $pageSize;
	}

	/**
	 * @param PageInfo $pageInfo
	 * @return void
	 */
	//Unused
	function BindPageInfo(PageInfo $pageInfo)
	{
		$this->pageablePage->BindPageInfo($pageInfo);
	}
}