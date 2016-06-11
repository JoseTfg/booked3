{*
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
*}
{include file='globalheader.tpl' cssFiles='css/calendar.css,css/jquery.qtip.min.css,scripts/css/fullcalendar.css,css/schedule.css,scripts/css/jqtree.css' printCssFiles='scripts/css/fullcalendar.print.css'}

{include file='Calendar/calendar.filter.tpl'}

<div class="calendarHeading">

	<div style="float:left;">
		<a href="{$PrevLink}"><img src="img/arrow_large_left.png" alt="Back" /></a>
		{$MonthName} {$DisplayDate->Year()}
		<a href="{$NextLink}"><img src="img/arrow_large_right.png" alt="Forward" /></a>
	</div>

	<div style="float:right;">
		<a href="#" id="goToday" alt="Today" title="Today">{translate key=Today} {html_image src="today.png"}</a>
		<a href="admin/manage_reservations.php" id="goList" alt="List" title="List">{translate key=List} {html_image src="list.png"}</a>
		<a href="#" id="goDay" alt="Today" title="Today">{translate key=Day} {html_image src="calendar-day.png"}</a>
		<a href="#" id="goWeek" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
		<a href="#" id="goMonth" alt="View Month" title="View Month">{translate key=Month} {html_image src="calendar-select-month.png"}</a>
	</div>

	<div class="clear">&nbsp;</div>

</div>

{include file='Calendar/mycalendar.common.tpl' view='month'}

{include file='globalfooter.tpl'}