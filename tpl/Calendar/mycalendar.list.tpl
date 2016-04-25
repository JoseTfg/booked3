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

{function name=displayReservation}
<tr id="{$reservation->ReferenceNumber}">
	<td style="min-width: 250px;">{$reservation->Title|default:$DefaultTitle}</td>
	<td style="min-width:150px;">{fullname first=$reservation->FirstName last=$reservation->LastName ignorePrivacy=$reservation->IsUserOwner($UserId)} {if !$reservation->IsUserOwner($UserId)}{html_image src="users.png" altKey=Participant}{/if}</td>
	<td width="200px">{formatdate date=$reservation->StartDate->ToTimezone($Timezone) key=dashboard}</td>
	<td width="200px">{formatdate date=$reservation->EndDate->ToTimezone($Timezone) key=dashboard}</td>
	<td style="min-width: 150px; max-width: 250px;">{$reservation->ResourceName}</td>
</tr>
{/function}

<div class="calendarHeading">
	<div style="float:left;">
		Lista
	</div>

	<div style="float:right;">
		<a href="#" id="goList" alt="List" title="List">Lista {html_image src="calendar-select-month.png"}</a>
		<a href="#" id="goDay" alt="Today" title="Today">Dia {html_image src="calendar-day.png"}</a>
		<a href="#" id="goWeek" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
		<a href="#" id="goMonth" alt="View Month" title="View Month">{translate key=Month} {html_image src="calendar-select-month.png"}</a>
	</div>

	<div class="clear">&nbsp;</div>
</div>

<div id="reservationList" class="dashboardContents">
<table id="myTable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr class="timespan">
				<th>Title</th>
				<th>User</th>
				<th>Start</th>
				<th>End</th>
				<th>Resource</th>
			</tr>
</thead> 
<tbody> 			
{foreach from=$reservations2 item=reservation2}
			{foreach from=$reservation2 item=reservation}
                {displayReservation reservation=$reservation}
			{/foreach}
			{/foreach}
			
			{*
{foreach from=$reservations item=reservation}
                {displayReservation reservation=$reservation}
			{/foreach}
			*}
	</tbody> 
	</table>		
</div>

<script type="text/javascript">
$(document).ready(function() {

	var reservations = [];
	{foreach from=$Calendar->Reservations() item=reservation}
		reservations.push({
			id: '{$reservation->ReferenceNumber}',
			title: '{$reservation->DisplayTitle|escape:javascript}',
			start: '{format_date date=$reservation->StartDate key=fullcalendar}',
			end: '{format_date date=$reservation->EndDate key=fullcalendar}',
			/*url: 'reservation.php?rn={$reservation->ReferenceNumber}',*/
			allDay: false,
			color: '{$reservation->Color}',
			textColor: '{$reservation->TextColor}',
			className: '{$reservation->Class}',
			colorID:'{$reservation->ResourceName}',
			refNumber: 'reservation.php?rn={$reservation->ReferenceNumber}'
		});
		
	{/foreach}

	var options = {
					view: '{$view}',
					year: {$DisplayDate->Year()},
					month: {$DisplayDate->Month()},
					date: {$DisplayDate->Day()},
					dayClickUrl: '{Pages::RESERVATION}?sid={$ScheduleId}&rid={$ResourceId}&rd={formatdate date=$date key=url}',
					dayNames: {js_array array=$DayNames},
					dayNamesShort: {js_array array=$DayNamesShort},
					monthNames: {js_array array=$MonthNames},
					monthNamesShort: {js_array array=$MonthNamesShort},
					timeFormat: '{$TimeFormat}',
					dayMonth: '{$DateFormat}',
					firstDay: {$FirstDay},
					subscriptionEnableUrl: '{Pages::MY_CALENDAR}?{QueryStringKeys::ACTION}={PersonalCalendarActions::ActionEnableSubscription}',
					subscriptionDisableUrl: '{Pages::MY_CALENDAR}?{QueryStringKeys::ACTION}={PersonalCalendarActions::ActionDisableSubscription}',
					minTime: '{$minTime}',
					maxTime: '{$maxTime}',
					myCal: '{$myCal}',
					username: '{$username}',
					password: '{$password}'
				};

				
	myScript(options, reservations);
	 $("#myTable").tablesorter(); 
		
});
</script>	

{jsfile src="jscolor-2.0.4/jscolor.js"}

<div id="legend" style="text-align: center"></div>

{*<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">*}
  {jsfile src="//code.jquery.com/jquery-1.10.2.js"}
 {jsfile src="//code.jquery.com/ui/1.11.4/jquery-ui.js"}
  <link rel="stylesheet" href="/resources/demos/style.css">

<div id="dialog-confirm" title="Basic dialog">
  <p>¿Estás seguro de que quieres borrar?</p>
</div>

<div id="dialog-form" title="Calendar Boundaries">
  <p>Select calendar boundaries.</p>
  
  <div id="selects" style="text-align: center">
  <select id="BeginPeriod" {formname key=BEGIN_PERIOD} class="pulldown input" style="width:150px">
  </select>
  
  <select id="EndPeriod" {formname key=BEGIN_PERIOD} class="pulldown input" style="width:150px">
  </select>
  </div>
  
  <div id="dialog1" title="Basic dialog">
  <p>Update Sucessful</p>
  </div>
  
  <div id="dialog2" title="Basic dialog">
  <p>Couldn't Update</p>
  </div>

</div>
  
</div>

<div id="hidden" style="visibility: hidden;">
<form id='myform' method="post">
<input id="a1" name="a1" type="text" value="">
<input id="a2" name="a2" type="text" value="">
<input id="a3" name="a2" type="text" value="">
</form>
</div>
{jsfile src="myScript.js"}
{*{jsfile src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.7/js/jquery.tablesorter.js"}*}
{*<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.7/js/jquery.tablesorter.js"></script>*}
{*{jsfile src="TableSorter/jquery-latest.js"}*}
{jsfile src="TableSorter/jquery.tablesorter.js"}
<link rel="stylesheet" href="css/table_sorter.css">


{include file='globalfooter.tpl'}

