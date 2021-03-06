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

class Pages
{
	const DEFAULT_HOMEPAGE_ID = 1;
	const CALENDAR_EXPORT = 'ical.php';
	const CALENDAR_SUBSCRIBE = 'ical-subscribe.php';
	const FORGOT_PASSWORD = 'forgot.php';
	const LOGIN = 'index.php';
	const MANAGE_RESERVATIONS = 'manage_reservations.php';
	const MANAGE_GROUPS = 'manage_groups.php';
	const MANAGE_GROUPS_ADMIN = 'manage_admin_groups.php';
	const MANAGE_GROUP_RESERVATIONS = 'manage_group_reservations.php';
	const MY_CALENDAR = 'my-calendar.php';
	const OPENINGS = 'openings.php';
	const REPORTS_GENERATE = 'generate-report.php';
	const REPORTS_SAVED = 'saved-reports.php';
	const REPORTS_COMMON = 'common-reports.php';
	const RESERVATION = 'reservation.php';
	const RESERVATION_FILE = 'reservation-file.php';
	const REGISTRATION = 'register.php';
	const SCHEDULE = 'schedule.php';

	private static $_pages = array(
		1 => array('url' => Pages::MY_CALENDAR, 'name' => 'MyCalendar')
	);

	//Construct
	private function __construct()
	{
	}

	//Page URL
	public static function UrlFromId($pageIUrlFromIdd)
	{
		return self::$_pages[$pageId]['url'];
	}

	//Gets supported pages
	public static function GetAvailablePages()
	{
		return self::$_pages;
	}
}

?>