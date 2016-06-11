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

<div id="calendar"></div>

<div id="dialogDeleteReservation" class="dialog" title={translate key="Delete"}>
	<div class="warning">{translate key=DeleteWarning}</div>
	</br>
	<button id="deleteReservation" type="button" class="button deleteReservation">{html_image src="cross-button.png"} {translate key='Delete'}</button>
</div>

<div id="dialogDeleteBlackout" class="dialog" title={translate key="Delete"}>
	<div class="warning">{translate key=DeleteWarning}</div>
	</br>
	<button id="deleteBlackout" type="button" class="button deleteBlackout">{html_image src="cross-button.png"} {translate key='Delete'}</button>
</div>

<div id="dialogColors" class="dialog" title={translate key="Colors"}>
	<form id='colorForm' method="post">
		<div id="legend">
			{foreach from=$resources item=resource}
				<input type='button' id='{$resource->GetName()|escape}' class="jscolor">&nbsp{$resource->GetName()|escape}</input>
				<input id="color#{$resource->GetName()|escape}" name="color#{$resource->GetName()|escape}" type="hidden" value="">
				</br></br>
			{/foreach}
		</div>	
		<button type="button" class="button colors">{html_image src="tick-circle.png"} {translate key='Update'}</button>
	</form>
</div>

<div id="dialogBoundaries" class="dialog" title={translate key="TimeTable"}>
	<form id='timeForm' method="post">
		<div class="warning">{translate key=TimeTableBoundaries}</div>
		</br>
		<div id="selects">
			<select name = "minTime" style="text-align-last:center;width:150px;" id="BeginPeriod" class="pulldown input"></select>
			-
			<select name = "maxTime" style="text-align-last:center;width:150px;" id="EndPeriod" class="pulldown input"></select>
			</br></br>
			{translate key='FirstDay'}&nbsp;&nbsp;&nbsp;-
			<select name="firstDay" style="text-align-last:center;width:150px" id="firstDay" class="pulldown input" disabled>
				<option value="1">{translate key='Monday'}</option>
				<option value="2">{translate key='Tuesday'}</option>
				<option value="3">{translate key='Wednesday'}</option>
				<option value="4">{translate key='Thursday'}</option>
				<option value="5">{translate key='Friday'}</option>
				<option value="6">{translate key='Saturday'}</option>
				<option value="0">{translate key='Sunday'}</option>
			</select>		
			</br></br>
			<span>
				<input id="format1" name="format" checked="checked" type="radio" value="1"> {translate key='Format12'}</input>
				<input id="format2" name="format" type="radio" value="2"> {translate key='Format24'}</input>
			</span>
			</br></br>
			<input id="weekends" name="weekends" type="checkbox" value="1"> {translate key='Weekends'}</input>
			</br></br>
			<button type="button" class="button timeTable">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		</div>
	</form>
</div>
	
<div id="dialogSubscribe" class="dialog" title={translate key="Subscription"}>
	<div class="warning">{translate key=Subscribe}</div>
	</br>
	<button type="button" class="button export">{html_image src="disk-arrow.png"} {translate key='Export'}</button>
	<button type="button" class="button gcalendar">{html_image src="google.png"} GCalendar</button>
</div>

<div id="reservationColorbox" class="dialog" title={translate key="CreateReservationHeading"}></div>

<div class="hiddenDiv" id="strings">
	<input id="createString" type="text" value="{translate key="Create"}">
	<input id="editString" type="text" value="{translate key="CheckReservation"}">
	<input id="deleteString" type="text" value="{translate key="Delete"}">
	<input id="goDayString" type="text" value="{translate key="GoDay"}">
	<input id="goWeekString" type="text" value="{translate key="GoWeek"}">
	<input id="checkAllString" type="text" value="{translate key="checkAll"}">
	<input id="uncheckAllString" type="text" value="{translate key="uncheckAll"}">
	<input id="selectOptionsString" type="text" value="{translate key="selectOptions"}">
	<input id="selectTextString" type="text" value="{translate key="selectText"}">
	<input id="warningString" type="text" value="{translate key="FieldWarning"}">
	<input id="pendingString" type="text" value="{translate key="Pending"}">
</div>

{*Imports*}
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="reservationPopup.js"}
{jsfile src="calendar.js"}
{jsfile src="js/fullcalendar.min.js"}
{jsfile src="admin/edit.js"}
{jsfile src="js/tree.jquery.js"}
{jsfile src="js/moment.min.js"}

{*Enhance*}
<link rel="stylesheet" href="scripts/Popup-master/assets/css/popup.css">
{jsfile src="Popup-master/assets/js/jquery.popup.js"}
{jsfile src="jscolor-2.0.4/jscolor.js"}
{jsfile src="enhancement/calendarEnhance.js"}
{cssfile src="admin.css"}
{jsfile src="enhancement/createEnhance.js"}
{jsfile src="enhancement/manageBlackoutsEnhance.js"}

{*Code*}
<script type="text/javascript">
$(document).ready(function() {
	
	var reservations = [];
	
	{foreach from=$Calendar->Reservations() item=reservation}
		reservations.push({
			id: '{$reservation->ReferenceNumber}',
			title: '{$reservation->ResourceName}',
			start: '{format_date date=$reservation->StartDate key=fullcalendar}',
			end: '{format_date date=$reservation->EndDate key=fullcalendar}',
			allDay: false,
			color: '{$reservation->Color}',
			textColor: '{$reservation->TextColor}',
			className: '{$reservation->Class}',
			colorID:'{$reservation->ResourceName}',
			trueTitle: '{$reservation->Title}',
			owner: '{$reservation->OwnerName}'
		});		
	{/foreach}
	
	{foreach from=$blackouts item=blackout}
		reservations.push({
			id: '{$blackout->InstanceId}',
			title: '{$blackout->ResourceName}',
			start: '{formatdate date=$blackout->StartDate timezone=$Timezone key=fullcalendar}',
			end: '{formatdate date=$blackout->EndDate timezone=$Timezone key=fullcalendar}',
			allDay: false,
			color: '#202020',
			textColor: '#F0099CC',
			className: 'blackout',
			colorID:'{$blackout->ResourceName}'
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
					minTime: '{$minTime}',
					maxTime: '{$maxTime}',
					myCal: '{$myCal}',
					username: '{$username}',
					password: '{$password}',
					filename: '{$filename}',
					readOnly: '{$UserId}',
					weekends: '{$weekends}',
					isAdmin: '{$isAdmin}',
					format: '{$format}'
				};
	
	if (options.isAdmin == ""){
		options.isAdmin = 0;
	}
	
	if (options.format == "2"){
		options.timeFormat = "HH:mm";
	}
	
	if (options.weekends == "1"){
		options.weekends = true;
	}
	else{
		options.weekends = false;
	}
	
	if (options.firstDay == ""){
		options.FirstDay = "0";
	}
	
	if (options.minTime == "" || options.maxTime == ""){
		options.minTime = "10:00";
		options.maxTime = "20:00";
	}
	
	if (options.password.indexOf('blank') != -1){
		options.username = sessionStorage.getItem('username');
		options.password = sessionStorage.getItem('password');
	}
	
	sessionStorage.setItem('username', options.username);
	sessionStorage.setItem('password', options.password);
	
	{foreach from=$colorsToSend key=key item=colorToSend}
		{if $key != ''}
			if (document.getElementById('{$key}') != null){
				sessionStorage.setItem('{$key}', '{$colorToSend}');
				document.getElementById('{$key}').value = "'{$colorToSend}'";
			}
		{/if}
	{/foreach}	
	
	var calendar = new Calendar(options, reservations);	
	calendar.init();
	calendar.bindResourceGroups({$ResourceGroupsAsJson}, {$SelectedGroupNode|default:0});	
	
	enhanceCalendar(options, reservations);
	
	{if $CanViewAdmin}
		sessionStorage.setItem('isAdmin', {$CanViewAdmin});
	{else}
		sessionStorage.setItem('isAdmin', '0');
	{/if}
});
</script>	
