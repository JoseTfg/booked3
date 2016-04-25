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

<link rel="stylesheet" href="scripts/Popup-master/assets/css/popup.css">
{jsfile src="Popup-master/assets/js/jquery.popup.js"}
<link rel="stylesheet" href="css/aa.css">


<div id="calendar"></div>

{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="reservationPopup.js"}
{jsfile src="calendar.js"}
{jsfile src="js/fullcalendar.min.js"}
{jsfile src="admin/edit.js"}
{jsfile src="js/tree.jquery.js"}

{jsfile src="js/moment.min.js"}
{*{jsfile src="js/jquery.min.js"}*}

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
	var calendar = new Calendar(options, reservations);
	calendar.init();
	calendar.bindResourceGroups({$ResourceGroupsAsJson}, {$SelectedGroupNode|default:0});	
});
</script>	

{jsfile src="jscolor-2.0.4/jscolor.js"}

<div id="legend" style="text-align: center;display:none;"></div>

{*<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">*}
 {* {jsfile src="//code.jquery.com/jquery-1.10.2.js"}*}
 {jsfile src="//code.jquery.com/ui/1.11.4/jquery-ui.js"}
{*  <link rel="stylesheet" href="/resources/demos/style.css">*}

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

<div id="hidden" style="visibility: hidden;">
<form id='myform' method="post">
<input id="a1" name="a1" type="text" value="">
<input id="a2" name="a2" type="text" value="">
<input id="a3" name="a3" type="text" value="">
<input id="a4" name="a4" type="text" value="">
</form>
</div>
	
	  <div id="dialog3" title="Basic dialog">
  <p>Subscribe to calendar?</p>
  </div>
	
{jsfile src="ics/ics.js"}	
{jsfile src="myScript.js"}


