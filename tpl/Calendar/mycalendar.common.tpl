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
<div style="display:none;">
<a id="legendHide" href="#" style="float:left;">{html_image src="script.png"}Leyenda</a>
<div style="float:left;"> &nbsp|&nbsp</div>
{*<a id="timeTable" href="#" style="float:left;">{html_image src="horario.png"}Horarios</a>*}
<a id="export" href="#" style="float:right;">{html_image src="cloud.png"}Exportar</a>
<div id="legend_old" style="text-align:center;"></div>
</div>

<div id="dialogDeleteReservation" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Delete"}>
  <div class="warning">{translate key=DeleteWarning}</div>
  <button type="button" class="button deleteReservation" style="float:right;">{html_image src="cross-button.png"} {translate key='Delete'}</button>
</div>

<div id="dialogDeleteBlackout" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Delete"}>
  <div class="warning">{translate key=DeleteWarning}</div>
  <button type="button" class="button deleteBlackout" style="float:right;">{html_image src="cross-button.png"} {translate key='Delete'}</button>
</div>

<div id="dialogColors" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Colors"}>
	<div id="legend">
	{foreach from=$resources item=resource}
	<input type='button' id='{$resource->GetName()|escape}' class="jscolor">&nbsp{$resource->GetName()|escape}</input> </br> </br>
	{/foreach}
	</div>
</div>

<div id="dialogBoundaries" class="dialog" style="display:none;background-color:#FFCC99" "title={translate key="TimeTable"}>
  <div class="warning">{translate key=TimeTableBoundaries}</div>
  </br>
  <div id="selects" style="text-align: center;">
  <select id="BeginPeriod" {formname key=BEGIN_PERIOD} class="pulldown input" style="width:150px">
  </select>
  -
  <select id="EndPeriod" {formname key=BEGIN_PERIOD} class="pulldown input" style="width:150px">
  </select>
  </br>
  </br>
  <button type="button" class="button timeTable" style="float:right;">{html_image src="tick-circle.png"} {translate key='Update'}</button>
  
</div>
  
<div id="dialogSucessful" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Update"}>
  <p>{translate key="ReservationUpdatedSubject"}</p>
</div>
  
<div id="dialogFailed" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Update"}>
  <p>{translate key="ReservationFailed"}</p>
  </div>
</div>

<div id="hidden" style="visibility:hidden;">
	<form id='myform' method="post">
		<input id="minTime" name="minTime" type="text" value="">
		<input id="maxTime" name="maxTime" type="text" value="">
		<input id="colors" name="colors" type="text" value="">
	</form>
</div>
	
<div id="dialogSubscribe" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="Subscription"}>
	 <div class="warning">{translate key=Subscribe}</div>
	 </br>
	<button type="button" class="button export" style="float:right;">{html_image src="disk-arrow.png"} {translate key='Export'}</button>
	<button type="button" class="button gcalendar" style="float:right;">{html_image src="google.png"} GCalendar</button>
</div>

<div id="reservationColorbox" class="dialog" style="display:none;background-color:#FFCC99" title={translate key="CreateReservationHeading"}>

</div>

<div style="display:none;" id="strings">
   <input id="createString" type="text" value="{translate key="Create"}">
   <input id="editString" type="text" value="{translate key="Edit"}">
   <input id="deleteString" type="text" value="{translate key="Delete"}">
   <input id="goDayString" type="text" value="{translate key="GoDay"}">
   <input id="goWeekString" type="text" value="{translate key="GoWeek"}">
   <input id="checkAllString" type="text" value="{translate key="checkAll"}">
   <input id="uncheckAllString" type="text" value="{translate key="uncheckAll"}">
   <input id="selectOptionsString" type="text" value="{translate key="selectOptions"}">
   <input id="selectTextString" type="text" value="{translate key="selectText"}">
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
{*{jsfile src="enhancement/createEnhance.js"}*}
{cssfile src="admin.css"}
{jsfile src="menu/jquery.ui-contextmenu.min.js"}

{*Code*}
<script type="text/javascript">
$(document).ready(function() {
	
	var reservations = [];
	
	{foreach from=$Calendar->Reservations() item=reservation}
		reservations.push({
			id: '{$reservation->ReferenceNumber}',
			{*title: '{$reservation->DisplayTitle|escape:javascript}',*}
			title: '{$reservation->ResourceName}',
			start: '{format_date date=$reservation->StartDate key=fullcalendar}',
			end: '{format_date date=$reservation->EndDate key=fullcalendar}',
			/*url: 'reservation.php?rn={$reservation->ReferenceNumber}',*/
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
			start: '{formatdate date=$blackout->StartDate timezone=$Timezone key=res_popup}',
			end: '{formatdate date=$blackout->EndDate timezone=$Timezone key=res_popup}',
			allDay: false,
			color: '#202020 ',
			textColor: '#F0099CC',
			className: 'blackout',
			colorID:'{$blackout->Title}'
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
					{*subscriptionEnableUrl: '{Pages::MY_CALENDAR}?{QueryStringKeys::ACTION}={PersonalCalendarActions::ActionEnableSubscription}',
					subscriptionDisableUrl: '{Pages::MY_CALENDAR}?{QueryStringKeys::ACTION}={PersonalCalendarActions::ActionDisableSubscription}',*}
					minTime: '{$minTime}',
					maxTime: '{$maxTime}',
					myCal: '{$myCal}',
					username: '{$username}',
					password: '{$password}',
					filename: '{$filename}',
					readOnly: '{$UserId}'
				};
	
	//alert(options.username);
	//alert(options.password);
	
	if (options.password.indexOf('blank') != -1){
		options.username = sessionStorage.getItem('username');
		options.password = sessionStorage.getItem('password');
	}
	
	sessionStorage.setItem('username', options.username);
	sessionStorage.setItem('password', options.password);
	
	{foreach from=$colorsToSend key=key item=colorToSend}
		sessionStorage.setItem('{$key}', '{$colorToSend}');
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





	
	



