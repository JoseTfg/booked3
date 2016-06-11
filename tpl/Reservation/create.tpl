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
{block name="header"}
{include file='globalheader.tpl' cssFiles='css/reservation.css,css/jquery.qtip.min.css,scripts/css/jqtree.css'}
{/block}

<div id="reservationbox"> 
<form id="reservationForm" method="post" enctype="multipart/form-data">
    {csrf_token}
<div class="clear"></div>
<div id="result"></div>

<div id="reservationDetails" class="details">
    <ul style="text-align:center;" class="no-style">
		
	{if $CanChangeUser}
            <button id="promptForChangeUsers" type="button" style="display:inline;">
                {html_image src="users.png"}
			{*{translate key='ChangeUser'}*}
            </button>

            <div id="changeUserDialog" title="{translate key=ChangeUser}" class="dialog"></div>
		{/if}

            <a id="userName" data-userid="{$UserId}">{$ReservationUserName|truncate:25:"...":true}</a> <input id="userId"
                                                                     type="hidden" {formname key=USER_ID}
                                                                     value="{$UserId}"/>
		

       {* <li style="display:none;" id="changeUsers">
            <input type="text" id="changeUserAutocomplete" class="input" style="width:250px;"/>
            <button id="promptForChangeUsers" type="button" class="button" style="display:inline">
                {html_image src="users.png"}
			{translate key='AllUsers'}
            </button>
        </li>*}
    </ul>
	<br/>
    <ul class="no-style" style="text-align: center">
        <li class="inline">
			
		{if $CanViewAdmin}
		<div id="blackDiv" style="display:inline">
		<input id="blackoutCheckBox" type="checkbox" value="blackoutCheckBox" onclick="blackoutTick()"> {translate key='Blackout'}
		</div>
		<div id="allBlackDiv" style="display:inline;display:none;">
		<input id="allBlack" type="checkbox" value="allBlack" onclick="allResources()"> All resources
		</div>
		{/if}
		</br>
		</br>
		<select class="pulldown input" id="filter" style="width:230px;font-size: 12px;text-align-last:center;">
		{foreach from=$AvailableResources item=resource}
			<option value="{$resource->Id}">{$resource->Name}</option>
		{/foreach}
		</select>
		</ul>
		<ul class="no-style" >
		<input id="resourceId" class="resourceId" type="hidden" {formname key=RESOURCE_ID} value="{$ResourceId}"/>
		<input type="hidden" id="scheduleId" {formname key=SCHEDULE_ID} value="{$ScheduleId}"/>

        </li>
        <li style="text-align: center">
		<br/>
            {*<label for="BeginDate" class="reservationDate">{translate key='BeginDate'}</label>*}
            <input style="font-size: 12px;text-align: center" type="text" id="BeginDate" class="dateinput" value="{formatdate date=$StartDate}"/>
            <input type="hidden" id="formattedBeginDate" {formname key=BEGIN_DATE} value="{formatdate date=$StartDate key=system}"/>
			-
			<input style="font-size: 12px;text-align: center" type="text" id="EndDate" class="dateinput" value="{formatdate date=$EndDate}"/>
            <input type="hidden" id="formattedEndDate" {formname key=END_DATE} value="{formatdate date=$EndDate key=system}"/>            
        </li>
        <li style="text-align: center">
            {*<label for="EndDate" class="reservationDate">{translate key='EndDate'}</label>*}
<select id="BeginPeriod" {formname key=BEGIN_PERIOD} class="pulldown input" style="width:108px;font-size: 12px;text-align-last:center;">
			{foreach from=$StartPeriods item=period}
				{if $period->IsReservable()}
					{assign var='selected' value=''}
					{if $period eq $SelectedStart}
						{assign var='selected' value=' selected="selected"'}
					{/if}
                    <option value="{$period->Begin()}"{$selected}>{$period->Label()}</option>
				{/if}
			{/foreach}
            </select>
			-
            <select id="EndPeriod" {formname key=END_PERIOD} class="pulldown input" style="width:108px;font-size: 12px;text-align-last:center;">
			{foreach from=$EndPeriods item=period name=endPeriods}
				{if $period->BeginDate()->IsMidnight()}
                    <option value="{$period->Begin()}"{$selected}>{$period->Label()}</option>
				{/if}
				{if $period->IsReservable()}
					{assign var='selected' value=''}
					{if $period eq $SelectedEnd}
						{assign var='selected' value=' selected="selected"'}
					{/if}
                    <option value="{$period->End()}"{$selected}>{$period->LabelEnd()}</option>
				{/if}
			{/foreach}
            </select>
        </li>
        <li style="text-align: center">
            <div class="durationText">
                {translate key=Duration}: <span id="durationHours">0</span> {translate key=hours}
            </div>
        </li>
	<br/>
	
	{if $HideRecurrence}
        <li style="display:none">
			{else}
    <li id="recurrence" style="text-align:center;">
	{/if}
	{control type="RecurrenceControl" RepeatTerminationDate=$RepeatTerminationDate }
	</li>
	
	
        <li class="rsv-box-l" style="text-align: center">
			{textbox id="title" style="width:230px;" name="RESERVATION_TITLE" placeholder="{translate key="ReservationTitle"}" class="input" tabindex="100" value="ReservationTitle"}
            {*</label>*}
        </li>

        <li class="rsv-box-l" style="text-align: center">
                <textarea id="description" placeholder="{translate key="ReservationDescription"}" name="{FormKeys::DESCRIPTION}" class="input" rows="2" cols="52" style="height:40px;width:230px;"
                          tabindex="110">{$Description}</textarea>
            {*</label>*}
        </li>
    </ul>
</div>

<input type="hidden" {formname key=reservation_id} value="{$ReservationId}"/>
<input type="hidden" {formname key=reference_number} value="{$ReferenceNumber}"/>
<input type="hidden" {formname key=reservation_action} value="{$ReservationAction}"/>
<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} id="hdnSeriesUpdateScope"
       value="{SeriesUpdateScope::FullSeries}"/>

	   		<li id="optionDiv" style="display:none;">
					<input {formname key=CONFLICT_ACTION} type="radio" id="notifyExisting" value="{ReservationConflictResolution::Notify}" onclick="blackoutNotify()"/>
					<label for="notifyExisting">{translate key=BlackoutShowMe}</label>
					</br>
					<input {formname key=CONFLICT_ACTION} type="radio" id="deleteExisting" value="{ReservationConflictResolution::Delete}" onclick="blackoutNotify()" checked/>
					<label for="deleteExisting">{translate key=BlackoutDeleteConflicts}</label>

					<input id="myOption" type="hidden" value="0" />
				</li>
	   
<div class="reservationButtons" style="position: absolute;
    left: 56%;">
	<div class="reservationDeleteButtons">
	{block name="deleteButtons"}
		&nbsp;
	{/block}
	</div>
	<div class="reservationSubmitButtons">
		{block name="submitButtons"}
			<button id="submitButton" type="button" class="button save create">
				{html_image src="tick-circle.png"}
					{translate key='Create'}
			</button>
		{/block}
		
		<button id="blackButton"type="button" style="display:none;" onclick="blackoutPopup()">
				{html_image src="tick-circle.png"}
					Blackout
			</button>
		
		{*<button type="button" class="button" onclick="closePopup1()">
		{html_image src="slash.png"}
			{translate key='Cancel'}
		</button>*}
	</div>
</div>

{if $UploadsEnabled}
	{block name='attachments'}
	{/block}
{/if}
</form>

<div id="dialogResourceGroups" class="dialog" title="{translate key=AddResources}">

	<div id="resourceGroups"></div>

	<button class="button btnConfirmAddResources">{html_image src="tick-circle.png"} {translate key='Done'}</button>
	<button class="button btnClearAddResources">{html_image src="slash.png"} {translate key='Cancel'}</button>
</div>

<div id="dialogAddResources" class="dialog" title="{translate key=AddResources}" style="display:none;">

{foreach from=$AvailableResources item=resource}
	{if $resource->CanAccess}
		{assign var='checked' value=''}
		{if is_array($AdditionalResourceIds) && in_array($resource->Id, $AdditionalResourceIds)}
			{assign var='checked' value='checked="checked"'}
		{/if}
		{if $resource->Id == $ResourceId}
			{assign var='checked' value='checked="checked"'}
		{/if}

        <p>
            <input type="checkbox" {formname key=ADDITIONAL_RESOURCES multi=true} id="additionalResource{$resource->Id}"
                   value="{$resource->Id}" {$checked} />
            <label for="additionalResource{$resource->Id}">{$resource->Name}</label>
        </p>
	{/if}
{/foreach}
    <br/>
    <button class="button btnConfirmAddResources">{html_image src="tick-circle.png"} {translate key='Done'}</button>
    <button class="button btnClearAddResources">{html_image src="slash.png"} {translate key='Cancel'}</button>
</div>

<div id="dialogAddAccessories" class="dialog" title="{translate key=AddAccessories}" style="display:none;">
    <table style="width:100%">
        <tr>
            <td>{translate key=Accessory}</td>
            <td>{translate key=QuantityRequested}</td>
            <td>{translate key=QuantityAvailable}</td>
        </tr>
	{foreach from=$AvailableAccessories item=accessory}
        <tr>
            <td>{$accessory->Name}</td>
            <td>
                <input type="hidden" class="name" value="{$accessory->Name}"/>
                <input type="hidden" class="id" value="{$accessory->Id}"/>
				{if $accessory->QuantityAvailable == 1}
                    <input type="checkbox" name="accessory{$accessory->Id}" value="1" size="3"/>
					{else}
                    <input type="text" name="accessory{$accessory->Id}" value="0" size="3"/>
				{/if}
            </td>
            <td>{$accessory->QuantityAvailable|default:'&infin;'}</td>
        </tr>
	{/foreach}
    </table>
    <br/>
    <button id="btnConfirmAddAccessories" class="button">{html_image src="tick-circle.png"} {translate key='Done'}</button>
    <button id="btnCancelAddAccessories" class="button">{html_image src="slash.png"} {translate key='Cancel'}</button>
</div>

{*<div id="dialogSave" style="display:none;">
    <div id="creatingNotification" style="position:relative; top:170px;">
	{block name="ajaxMessage"}
		{translate key=CreatingReservation}...<br/>
	{/block}
	{html_image src="reservation_submitting.gif" alt="Creating reservation"}
    </div>
    <div id="result" style="display:none;max-width: 100px;"></div>
</div>*}
<!-- reservationbox ends -->
</div>

{control type="DatePickerSetupControl" ControlId="BeginDate" AltId="formattedBeginDate" DefaultDate=$StartDate}
{control type="DatePickerSetupControl" ControlId="EndDate" AltId="formattedEndDate" DefaultDate=$EndDate}
{control type="DatePickerSetupControl" ControlId="EndRepeat" AltId="formattedEndRepeat" DefaultDate=$RepeatTerminationDate}

{*Imports*}
{jsfile src="js/jquery.textarea-expander.js"}
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/moment.min.js"}
{jsfile src="resourcePopup.js"}
{jsfile src="userPopup.js"}
{jsfile src="date-helper.js"}
{jsfile src="recurrence.js"}
{jsfile src="reservation.js"}
{jsfile src="autocomplete.js"}
{jsfile src="force-numeric.js"}
{jsfile src="reservation-reminder.js"}
{jsfile src="js/tree.jquery.js"}

{*Enhance*}
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css"/>
{jsfile src="multiselect/jquery.multiselect.js"}
{jsfile src="multiselect/prettify.js"}
{jsfile src="multiselect/jquery.multiselect.filter.js"}
<link rel="stylesheet" href="scripts/Popup-master/assets/css/popup.css">
{jsfile src="Popup-master/assets/js/jquery.popup.js"}
{jsfile src="enhancement/createEnhance.js"}

<script type="text/javascript">
    $(document).ready(function ()
    {
        var scopeOptions = {
            instance:'{SeriesUpdateScope::ThisInstance}',
            full:'{SeriesUpdateScope::FullSeries}',
            future:'{SeriesUpdateScope::FutureInstances}'
        };

        var reservationOpts = {
            additionalResourceElementId:'{FormKeys::ADDITIONAL_RESOURCES}',
            accessoryListInputId:'{FormKeys::ACCESSORY_LIST}[]',
            returnUrl:'{$ReturnUrl}',
            scopeOpts:scopeOptions,
            createUrl:'ajax/reservation_save.php',
            updateUrl:'ajax/reservation_update.php',
            deleteUrl:'ajax/reservation_delete.php',
            userAutocompleteUrl:"ajax/autocomplete.php?type={AutoCompleteType::User}",
            groupAutocompleteUrl:"ajax/autocomplete.php?type={AutoCompleteType::Group}",
            changeUserAutocompleteUrl:"ajax/autocomplete.php?type={AutoCompleteType::MyUsers}",
			maxConcurrentUploads:'{$MaxUploadCount}'
        };

        var recurOpts = {
            repeatType:'{$RepeatType}',
            repeatInterval:'{$RepeatInterval}',
            repeatMonthlyType:'{$RepeatMonthlyType}',
            repeatWeekdays:[{foreach from=$RepeatWeekdays item=day}{$day},{/foreach}]
        };

        var reminderOpts = {
            reminderTimeStart:'{$ReminderTimeStart}',
            reminderTimeEnd:'{$ReminderTimeEnd}',
            reminderIntervalStart:'{$ReminderIntervalStart}',
            reminderIntervalEnd:'{$ReminderIntervalEnd}'
        };

        var recurrence = new Recurrence(recurOpts);
        recurrence.init();

        var reservation = new Reservation(reservationOpts);
        reservation.init('{$UserId}');

        var reminders = new Reminder(reminderOpts);
        reminders.init();

	{foreach from=$Participants item=user}
        reservation.addParticipant("{$user->FullName|escape:'javascript'}", "{$user->UserId|escape:'javascript'}");
	{/foreach}

	{foreach from=$Invitees item=user}
        reservation.addInvitee("{$user->FullName|escape:'javascript'}", '{$user->UserId}');
	{/foreach}

	{foreach from=$Accessories item=accessory}
        reservation.addAccessory('{$accessory->AccessoryId}', '{$accessory->QuantityReserved}', "{$accessory->Name|escape:'javascript'}");
	{/foreach}

	reservation.addResourceGroups({$ResourceGroupsAsJson});

        var ajaxOptions = {
            target:'#result', // target element(s) to be updated with server response
            beforeSubmit:reservation.preSubmit, // pre-submit callback
            success:reservation.showResponse  // post-submit callback
        };

	$('#reservationForm').submit(function ()
	{
		$(this).ajaxSubmit(ajaxOptions);
		return false;
	});
	$('#description').TextAreaExpander();

	enhanceCreate();
		
});
</script>