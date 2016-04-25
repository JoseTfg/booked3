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
{include file='globalheader.tpl' cssFiles='scripts/css/colorbox.css,css/admin.css,css/jquery.qtip.min.css,scripts/css/timePicker.css'}

<h1>{translate key=ManageBlackouts} {*{html_image src="question-button.png" id="help-prompt" ref="help-blackouts"}*}</h1>

<div class="admin">
	<div class="title">
		<a href="#" id="myBlackoutLabel"> {translate key=AddBlackout}</a>
	</div>
	<div style="background-color:#FFCC99;">
		<form id="addBlackoutForm" method="post" style="display:none;">
			<ul>
				<li>
					{*<label for="addStartDate" class="wideLabel">{translate key=BeginDate}</label>*}
					<input type="text" id="addStartDate" class="textbox" size="10" value="{formatdate date=$AddStartDate}"/>
					<input {formname key=BEGIN_DATE} id="formattedAddStartDate" type="hidden" value="{formatdate date=$AddStartDate key=system}"/>
					<input {formname key=BEGIN_TIME} type="text" id="addStartTime" class="textbox" size="7" value="12:00 AM" />
					-
					{*<label for="addEndDate" class="wideLabel">{translate key=EndDate}</label>*}
					<input type="text" id="addEndDate" class="textbox" size="10" value="{formatdate date=$AddEndDate}"/>
					<input {formname key=END_DATE} type="hidden" id="formattedAddEndDate" value="{formatdate date=$AddEndDate key=system}"/>
					<input {formname key=END_TIME} type="text" id="addEndTime" class="textbox" size="7"  value="12:00 AM" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{*<label for="addResourceId" class="wideLabel">{translate key=Resource}</label>*}
					<select {formname key=RESOURCE_ID} class="textbox" id="addResourceId">
						{object_html_options options=$Resources key='GetId' label="GetName" selected=$ResourceId}
					</select>
					{if $Schedules|count > 0}
					|
					<label for="allResources" style="">{translate key=AllResourcesOn} </label> <input {formname key=BLACKOUT_APPLY_TO_SCHEDULE} type="checkbox" id="allResources" />
					<select {formname key=SCHEDULE_ID} id="addScheduleId" class="textbox" disabled="disabled" style="display:none">
						{object_html_options options=$Schedules key='GetId' label="GetName" selected=$ScheduleId}
					</select>
					{/if}
				</li>
				<li>
					<label for="blackoutReason" class="wideLabel">{translate key=Reason}</label>
					<input {formname key=SUMMARY} type="text" id="blackoutReason" class="textbox required" size="100" maxlength="85"/>
					<button type="button" class="button save create" style="float:right">
						{html_image src="tick-circle.png"} {translate key='Create'}
					</button>
				</li>
				<li>
					{control type="RecurrenceControl" RepeatTerminationDate=$RepeatTerminationDate}
				</li style="position: absolute; left: 100px;">
				<li style="float:right">
					<input {formname key=CONFLICT_ACTION} type="radio" id="notifyExisting" name="existingReservations" checked="checked" value="{ReservationConflictResolution::Notify}" />
					<label for="notifyExisting">{translate key=BlackoutShowMe}</label>

					<input {formname key=CONFLICT_ACTION} type="radio" id="deleteExisting" name="existingReservations" value="{ReservationConflictResolution::Delete}" />
					<label for="deleteExisting">{translate key=BlackoutDeleteConflicts}</label>

					{*<input type="reset" value="Cancel" style="border: 0;background: transparent;color: blue;cursor:pointer;" />*}
				</li>
				</br>
			</ul>
		</form>
	</div>
</div>
</br>
<fieldset style="background-color:#FFCC99;">
	<h3> <a href="#" id="myFilterLabel">{translate key=Filter} </a></h3>
	<div style="width: 50%;margin: 0 auto; ">
	<table id="myFilter" style="display:inline;display:none;">
		{*<tr>
			<td>{translate key=Between}</td>
			<td>{translate key=Schedule}</td>
			<td>{translate key=Resource}</td>
		</tr>*}
		<tr>
			<td>
				<input id="startDate" type="text" class="textbox" value="{formatdate date=$StartDate}"/>
				<input id="formattedStartDate" type="hidden" value="{formatdate date=$StartDate key=system}"/>
				-
				<input id="endDate" type="text" class="textbox" value="{formatdate date=$EndDate}"/>
				<input id="formattedEndDate" type="hidden" value="{formatdate date=$EndDate key=system}"/>
			</td>
			
			<td>
				<select id="scheduleId" class="textbox" style="display:none">
					<option value="">{translate key=AllSchedules}</option>
					{object_html_options options=$Schedules key='GetId' label="GetName" selected=$ScheduleId}
				</select>
			</td>
			<td>
			-
				<select id="resourceId" class="textbox">
					<option value="">{translate key=AllResources}</option>
					{object_html_options options=$Resources key='GetId' label="GetName" selected=$ResourceId}
				</select>
			</td>

				<button id="filter" class="button" style="float:right;display:none;">{html_image src="search.png"} {translate key=Filter}</button>
				<button id="showAll" class="button" style="float:right;display:none;"> {translate key=ViewAll}</button>
				{*<a href="#" id="showAll">{translate key=ViewAll}</a>*}

		</tr>
	</table>
	</div> 
</fieldset>

<div>&nbsp;</div>

<table class="list" id="blackoutTable">
	<thead>
	<tr>
		<th class="id">&nbsp;</th>
		<th>{translate key=Resource}</th>
		<th>{translate key=BeginDate}</th>
		<th>{translate key=EndDate}</th>
		<th>{translate key=Reason}</th>
		<th>{translate key=CreatedBy}</th>
		<th>{translate key=Delete}</th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$blackouts item=blackout}
	{cycle values='row0,row1' assign=rowCss}
	<tr class="{$rowCss} editable">
		<td class="id">{$blackout->InstanceId}</td>
		<td align="center">{$blackout->ResourceName}</td>
		<td align="center" style="width:150px;">{formatdate date=$blackout->StartDate timezone=$Timezone key=res_popup}</td>
		<td align="center" style="width:150px;">{formatdate date=$blackout->EndDate timezone=$Timezone key=res_popup}</td>
		<td align="center">{$blackout->Title}</td>
		<td align="center">{fullname first=$blackout->FirstName last=$blackout->LastName}</td>
		{if $blackout->IsRecurring}
			<td align="center" style="width: 65px;" class="update"><a href="#" class="update delete-recurring">{html_image src='cross-button.png'}</a></td>
		{else}
			<td align="center" style="width: 65px;" class="update"><a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
		{/if}
	</tr>
	{/foreach}
	</tbody>
</table>

{pagination pageInfo=$PageInfo}

<div id="deleteDialog" class="dialog" style="display:none;" title="{translate key=Delete}">
	<form id="deleteForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button save btnUpdateAllInstances">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
	</form>
</div>

<div id="deleteRecurringDialog" class="dialog" style="display:none;" title="{translate key=Delete}">
	<form id="deleteRecurringForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button save btnUpdateThisInstance">{html_image src="cross-button.png"} {translate key='ThisInstance'}</button>
		<button type="button" class="button save btnUpdateAllInstances">{html_image src="cross-button.png"} {translate key='AllInstances'}</button>
		<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} class="hdnSeriesUpdateScope" value="{SeriesUpdateScope::FullSeries}"/>
	</form>
</div>

{html_image src="admin-ajax-indicator.gif" class="indicator" style="display:none;"}
{csrf_token}

{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="js/jquery.colorbox-min.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/jquery.timePicker.min.js"}
{jsfile src="js/moment.min.js"}

{jsfile src="reservationPopup.js"}

{jsfile src="admin/edit.js"}
{jsfile src="admin/blackouts.js"}

{jsfile src="date-helper.js"}
{jsfile src="recurrence.js"}

{jsfile src="admin/help.js"}

<script type="text/javascript">

$(document).ready(function() {

		$("#myBlackoutLabel").on('click', function() {
		   if (document.getElementById("addBlackoutForm").style.display == "none"){
				document.getElementById("addBlackoutForm").style.display = "initial";
		   }
		   else{
				document.getElementById("addBlackoutForm").style.display = "none";
			}
		});
		
		$("#myFilterLabel").on('click', function() {
		   if (document.getElementById("myFilter").style.display == "none"){
				document.getElementById("myFilter").style.display = "initial";
				document.getElementById("filter").style.display = "initial";
				document.getElementById("showAll").style.display = "initial";
		   }
		   else{
				document.getElementById("myFilter").style.display = "none";
				document.getElementById("filter").style.display = "none";
				document.getElementById("showAll").style.display = "none";
			}
		});
		
		
		$("#blackoutTable").tablesorter(); 

	var updateScope = {};
	updateScope.instance = '{SeriesUpdateScope::ThisInstance}';
	updateScope.full = '{SeriesUpdateScope::FullSeries}';
	updateScope.future = '{SeriesUpdateScope::FutureInstances}';

	var actions = {};

	var blackoutOpts = {
		scopeOpts: updateScope,
		actions: actions,
		deleteUrl: '{$smarty.server.SCRIPT_NAME}?action={ManageBlackoutsActions::DELETE}&{QueryStringKeys::BLACKOUT_ID}=',
		addUrl: '{$smarty.server.SCRIPT_NAME}?action={ManageBlackoutsActions::ADD}',
		editUrl: '{$smarty.server.SCRIPT_NAME}?action={ManageBlackoutsActions::LOAD}&{QueryStringKeys::BLACKOUT_ID}=',
		updateUrl: '{$smarty.server.SCRIPT_NAME}?action={ManageBlackoutsActions::UPDATE}',
        reservationUrlTemplate: "{$Path}reservation.php?{QueryStringKeys::REFERENCE_NUMBER}=[refnum]",
		popupUrl: "{$Path}ajax/respopup.php"
	};

	var recurOpts = {
		repeatType:'{$RepeatType}',
		repeatInterval:'{$RepeatInterval}',
		repeatMonthlyType:'{$RepeatMonthlyType}',
		repeatWeekdays:[{foreach from=$RepeatWeekdays item=day}{$day},{/foreach}]
	};

	var recurElements = {
		beginDate: $('#formattedAddStartDate'),
		endDate: $('#formattedAddEndDate'),
		beginTime: $('#addStartTime'),
		endTime: $('#addEndTime')
	};

	var recurrence = new Recurrence(recurOpts, recurElements);
	recurrence.init();

	var blackoutManagement = new BlackoutManagement(blackoutOpts);
	blackoutManagement.init();

});
</script>

{control type="DatePickerSetupControl" ControlId="startDate" AltId="formattedStartDate"}
{control type="DatePickerSetupControl" ControlId="endDate" AltId="formattedEndDate"}
{control type="DatePickerSetupControl" ControlId="addStartDate" AltId="formattedAddStartDate"}
{control type="DatePickerSetupControl" ControlId="addEndDate" AltId="formattedAddEndDate"}
{control type="DatePickerSetupControl" ControlId="EndRepeat" AltId="formattedEndRepeat"}

<div id="createDiv" style="display:none;text-align:center; top:15%;position:relative;">
	<div id="creating">
		<h3>{translate key=Working}</h3>
		{html_image src="reservation_submitting.gif"}
	</div>
	<div id="result" style="display:none;"></div>
</div>

{include file='globalfooter.tpl'}

{jsfile src="TableSorter/jquery.tablesorter.js"}
<link rel="stylesheet" href="../css/table_sorter.css">