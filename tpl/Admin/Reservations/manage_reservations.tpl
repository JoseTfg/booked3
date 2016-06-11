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

{include file='globalheader.tpl' cssFiles='scripts/css/colorbox.css,css/admin.css,css/jquery.qtip.min.css'}

<table id="CalendarFilterTable" style="visibility:hidden;">
<tr>
<td>

<div id="filter">

<label for="calendarFilter"></label>
<select id="calendarFilter"  multiple="multiple">
		<option value="">aa</option>
</select>
</div>

</td>

</tr>
</table>   

<div id="{$PageId}">

<div class="calendarHeading">

	<div style="float:left;">
		<h2>{translate key=List}</h2>
	</div>

	<div style="float:right;">
		<a href="admin/manage_reservations.php" id="goList" alt="List" title="List">{translate key=List} {html_image src="list.png"}</a>
		<a href="../my-calendar.php?&ct=day" id="goDay" alt="Today" title="Today">	{translate key=Day} {html_image src="calendar-day.png"}</a>
		<a href="../my-calendar.php?&ct=week" id="goWeek" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
		<a href="../my-calendar.php?&ct=month" id="goMonth" alt="View Month" title="View Month">{translate key=Month} {html_image src="calendar-select-month.png"}</a>
	</div>

	<div class="clear">&nbsp;</div>
	</br>
</div>

{*<div class="calendarHeading">

	<div style="display:inline-block;">
		<h1>{translate key=List}</h1>
	</div>
	
	<div style="display:inline-block;position:relative;right:-1000px;">	
		<a href="http://localhost/booked/Web/admin/manage_reservations.php" id="goList" alt="List" title="List">{translate key=List} {html_image src="list.png"}</a>
		<a href="http://localhost/booked/Web/my-calendar.php?&ct=day" id="goDay" alt="Today" title="Today">	{translate key=Day} {html_image src="calendar-day.png"}</a>
		<a href="http://localhost/booked/Web/my-calendar.php?&ct=week" id="goWeek" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
		<a href="http://localhost/booked/Web/my-calendar.php?&ct=month" id="goMonth" alt="View Month" title="View Month">{translate key=Month} {html_image src="calendar-select-month.png"}</a>
	</div>

	<div class="clear">&nbsp;</div>
	</br>

</div>*}


{*<h1>{translate key=ManageReservations} *}{*{html_image src="question-button.png" id="help-prompt" ref="help-reservations"}*}{*</h1>*}

<div class="filterTable horizontal-list label-top main-div-shadow" id="filterTable" style="background-color:##D0D0D0;">
		<div id="adminFilterButtons" style="display:none;float:right;">
	</br>
		{*<button class="button" style="visibility:hidden;position:relative;right:0;">{html_image src="search.png"} {translate key=Filter}</button>*}
		<button id="filter" class="button">{html_image src="search.png"}{translate key=Filter}</button>
		<button id="clearFilter" class="button">{html_image src="reset.png"} {translate key=Reset}</button>
		{*<a href="#" id="clearFilter">{translate key=Reset}</a>*}
	</div>	
	<form id="filterForm">
		<div class="main-div-header" style="background-color:#e6EEEE;"> <a href="#" id="myFilterLabel"> {translate key=Filter} </a></div>
		<ul id="ulFilter"  style="display:none;">
			<li class="filter-dates">
				<label for="startDate">{translate key=Between}</label>
				<input id="startDate" type="text" class="textbox" value="{formatdate date=$StartDate}" size="10"
					   style="width:65px;"/>
				<input id="formattedStartDate" type="hidden" value="{formatdate date=$StartDate key=system}"/>
				-
				<input id="endDate" type="text" class="textbox" value="{formatdate date=$EndDate}" size="10"
					   style="width:65px;"/>
				<input id="formattedEndDate" type="hidden" value="{formatdate date=$EndDate key=system}"/>
			</li>
			{if $CanViewAdmin}
			<li class="filter-user">
				<label for="userFilter">{translate key=User}</label>
				<input id="userFilter" type="text" class="textbox" value="{$UserNameFilter}"/>
				<input id="userId" type="hidden" value="{$UserIdFilter}"/>
			</li>
			{else}
			<li class="filter-user" style="display:none;">
				<label for="userFilter">{translate key=User}</label>
				<input id="userFilter" type="text" class="textbox" value="{$UserNameFilter}"/>
				<input id="userId" type="hidden" value="{$UserIdFilter}"/>
			</li>
			{/if}
			<li class="filter-schedule" style="display:none;">
				<label for="scheduleId">{translate key=Schedule}</label>
				<select id="scheduleId" class="textbox">
					<option value="">{translate key=AllSchedules}</option>
					{object_html_options options=$Schedules key='GetId' label="GetName" selected=$ScheduleId}
				</select>
			</li>
			<li class="filter-resource">
				<label for="resourceId">{translate key=Resource}</label>
				<select id="resourceId" class="textbox">
					<option value="">{translate key=AllResources}</option>
					{object_html_options options=$Resources key='GetId' label="GetName" selected=$ResourceId}
				</select>
			</li>
			{if $CanViewAdmin}
			<li class="filter-status">
				<label for="statusId">{translate key=Status}</label>
				<select id="statusId" class="textbox">
					<option value="">{translate key=AllReservations}</option>
					<option value="{ReservationStatus::Pending}"
							{if $ReservationStatusId eq ReservationStatus::Pending}selected="selected"{/if}>{translate key=PendingReservations}</option>
				</select>
			</li>
			{else}
			<li class="filter-status" style="display:none;">
				<label for="statusId">{translate key=Status}</label>
				<select id="statusId" class="textbox">
					<option value="">{translate key=AllReservations}</option>
					<option value="{ReservationStatus::Pending}"
							{if $ReservationStatusId eq ReservationStatus::Pending}selected="selected"{/if}>{translate key=PendingReservations}</option>
				</select>
			</li>
			{/if}			
			<li class="filter-referenceNumber" style="display:none;>
				<label for="referenceNumber">{translate key=ReferenceNumber}</label>
				<input id="referenceNumber" type="text" class="textbox" value="{$ReferenceNumber}"/>
			</li>
			<li class="filter-resourceStatus" style="display:none;>
				<label for="resourceStatusIdFilter">{translate key=ResourceStatus}</label>
				<select id="resourceStatusIdFilter" class="textbox">
					<option value="">{translate key=All}</option>
					<option value="{ResourceStatus::AVAILABLE}">{translate key=Available}</option>
					<option value="{ResourceStatus::UNAVAILABLE}">{translate key=Unavailable}</option>
					<option value="{ResourceStatus::HIDDEN}">{translate key=Hidden}</option>
				</select>
			</li>
			<li class="filter-resourceStatusReason" style="display:none;>
				<label for="resourceReasonIdFilter">{translate key=Reason}</label>
				<select id="resourceReasonIdFilter" class="textbox"></select>
			</li>
			{foreach from=$AttributeFilters item=attribute}
				<li class="customAttribute filter-customAttribute{$attribute->Id()}" style="display:none;">
					{control type="AttributeControl" attribute=$attribute searchmode=true idPrefix="search"}
				</li>
			{/foreach}
		</ul>
	</form>

</div>

<div>&nbsp;</div>

{*<p>
	<a href="{$CsvExportUrl}" style="float:right">{translate key=ExportToCSV} {html_image src="calendar-plus.png"}</a>
</p>*}
<table class="list" id="reservationTable">
<thead> 
	<tr>
		<th class="id">&nbsp;</th>		
		<th style="max-width: 120px;">{translate key='Resource'}</th>
		<th style="max-width: 120px;">{translate key='User'}</th>
		<th style="max-width: 120px;">{translate key='Title'}</th>
		<th style="max-width: 120px;">{translate key='Description'}</th>
		<th class="date">{translate key='BeginDate'}</th>
		{*<th class="date">{translate key='EndDate'}</th>*}
		<th>{translate key='Duration'}</th>
		{*<th class="date">{translate key='Created'}</th>*}
		{*<th class="date">{translate key='LastModified'}</th>*}
		<th style="display:none;">{translate key='ReferenceNumber'}</th>
		{foreach from=$ReservationAttributes item=attr}
			<th style="display:none;">{$attr->Label()}</th>
		{/foreach}
		<td class="action">{translate key='Delete'}</th>
		{if $CanViewAdmin}
		<td class="action">{translate key='Approve'}</th>
		{/if}
	</tr>
	</thead> 
	<tbody> 
	{foreach from=$reservations item=reservation}
		{*{cycle values='row0,row1' assign=rowCss}*}
		{*{if $reservation->RequiresApproval}
			{assign var=rowCss value='pending'}
		{/if}*}
		<tr class="{$rowCss} editable" seriesId="{$reservation->SeriesId}">
			<td class="id">{$reservation->ReservationId}</td>			
			<td align="center">{$reservation->ResourceName}
			<td align="center">{fullname first=$reservation->FirstName last=$reservation->LastName ignorePrivacy=true}</td>
				<div>{if $reservation->ResourceStatusId == ResourceStatus::AVAILABLE}
						{*{html_image src="status.png"}*}
						{*{if $CanUpdateResourceStatus}*}
						{*<a class="changeStatus" href="#"*}
						{*resourceId="{$reservation->ResourceId}">{translate key='Available'}</a>*}
						{*{else}*}
						{*{translate key='Available'}*}
						{*{/if}*}
					{elseif $reservation->ResourceStatusId == ResourceStatus::UNAVAILABLE}
						{*{html_image src="status-away.png"}*}
						{*{if $CanUpdateResourceStatus}*}
						{*<a class="changeStatus" href="#"*}
						{*resourceId="{$reservation->ResourceId}">{translate key='Unavailable'}</a>*}
						{*{else}*}
						{*{translate key='Unavailable'}*}
						{*{/if}*}
					{else}
						{*{html_image src="status-busy.png"}*}
						{*{if $CanUpdateResourceStatus}*}
						{*<a class="changeStatus" href="#"*}
						{*resourceId="{$reservation->ResourceId}">{translate key='Hidden'}</a>*}
						{*{else}*}
						{*{translate key='Hidden'}*}
						{*{/if}*}
					{/if}
					{if array_key_exists($reservation->ResourceStatusReasonId,$StatusReasons)}
						<span class="reservationResourceStatusReason">{$StatusReasons[$reservation->ResourceStatusReasonId]->Description()}</span>
					{/if}
				</div>
			</td>
			<td align="center">{$reservation->Title}</td>
			<td align="center">{$reservation->Description}</td>
			<td align="center">{formatdate date=$reservation->StartDate timezone=$Timezone key=res_popup}</td>
			{*<td align="center">{formatdate date=$reservation->EndDate timezone=$Timezone key=res_popup}</td>*}
			<td align="center">{$reservation->GetDuration()->__toString()}</td>
			{*<td align="center">{formatdate date=$reservation->CreatedDate timezone=$Timezone key=general_datetime}</td>*}
			{*<td align="center">{formatdate date=$reservation->ModifiedDate timezone=$Timezone key=general_datetime}</td*}
			<td class="referenceNumber" style="display:none">{$reservation->ReferenceNumber}</td>
			{foreach from=$ReservationAttributes item=attribute}
				<td class="update inlineUpdate updateCustomAttribute" style="display:none;" attributeId="{$attribute->Id()}" attributeType="{$attribute->Type()}">
					{assign var=attrVal value=$reservation->Attributes->Get($attribute->Id())}
					{if $attribute->Type() == CustomAttributeTypes::CHECKBOX}
						{if $attrVal == 1}
							{translate key=Yes}
						{else}
							{translate key=No}
						{/if}
					{elseif $attribute->Type() == CustomAttributeTypes::DATETIME}
						{formatdate date=$attrVal key=general_datetime}
					{else}
						{$attrVal}
					{/if}
				</td>
			{/foreach}
			<td class="center"><a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
			{if $CanViewAdmin}
			<td class="center">
				{if $reservation->RequiresApproval}
					<a href="#" class="update approve">{html_image src='tick-button.png'}</a>
				{else}
					-
				{/if}
			</td>
			{/if}
		</tr>
	{/foreach}
	</tbody>
</table>

<div style="text-align:center;">
{pagination pageInfo=$PageInfo}
</div>

<div id="deleteInstanceDialog" class="dialog" style="display:none;" title="{translate key='Delete'}">
	<form id="deleteInstanceForm" method="post">
		<div class="delResResponse"></div>
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} value="{SeriesUpdateScope::ThisInstance}"/>
		<input type="hidden" {formname key=REFERENCE_NUMBER} value="" class="referenceNumber"/>
	</form>
</div>

<div id="deleteSeriesDialog" class="dialog" style="display:none;" title="{translate key='Delete'}">
	<form id="deleteSeriesForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" id="btnUpdateThisInstance" class="button saveSeries btnUpdateThisInstance">
			{html_image src="disk-black.png"}
			{translate key='ThisInstance'}
		</button>
		<button type="button" id="btnUpdateAllInstances" class="button saveSeries btnUpdateAllInstances">
			{html_image src="disks-black.png"}
			{translate key='AllInstances'}
		</button>
		<button type="button" id="btnUpdateFutureInstances" class="button saveSeries btnUpdateFutureInstances">
			{html_image src="disk-arrow.png"}
			{translate key='FutureInstances'}
		</button>
		<button type="button" class="button cancel">
			{html_image src="slash.png"}
			{translate key='Cancel'}
		</button>
		<input type="hidden" id="hdnSeriesUpdateScope" {formname key=SERIES_UPDATE_SCOPE} />
		<input type="hidden" {formname key=REFERENCE_NUMBER} value="" class="referenceNumber"/>
	</form>
</div>

<div id="inlineUpdateErrorDialog" class="dialog" title="{translate key=Error}">
	<div id="inlineUpdateErrors" class="hidden error">&nbsp;</div>
	<div id="reservationAccessError" class="hidden error"/>
</div>
<button type="button" class="button cancel">{translate key='OK'}</button>
</div>

<div id="statusDialog" class="dialog" title="{translate key=CurrentStatus}">
	<form id="statusForm" method="post">
		<div>
			<select id="resourceStatusId" {formname key=RESOURCE_STATUS_ID} class="textbox">
				<option value="{ResourceStatus::AVAILABLE}">{translate key=Available}</option>
				<option value="{ResourceStatus::UNAVAILABLE}">{translate key=Unavailable}</option>
				<option value="{ResourceStatus::HIDDEN}">{translate key=Hidden}</option>
			</select>
		</div>
		<div>
			<label for="resourceReasonId">{translate key=Reason}</label><br/>
			<select id="resourceReasonId" {formname key=RESOURCE_STATUS_REASON_ID} class="textbox">
			</select>
		</div>
		<div class="admin-update-buttons">
			<button type="button"
					class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
			<button type="button"
					class="button saveAll">{html_image src="disks-black.png"} {translate key='AllReservationResources'}</button>
			<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
			<input type="hidden" {formname key=RESOURCE_STATUS_UPDATE_SCOPE} id="statusUpdateScope" value=""/>
			<input type="hidden" {formname key=REFERENCE_NUMBER} id="statusUpdateReferenceNumber" value=""/>
			<input type="hidden" {formname key=RESOURCE_ID} id="statusResourceId" value=""/>
		</div>
	</form>
</div>

<div class="hidden">
	{foreach from=$AttributeFilters item=attribute}
		<div class="attributeTemplate" attributeId="{$attribute->Id()}">
			{control type="AttributeControl" attribute=$attribute}
		</div>
	{/foreach}

	<form id="attributeUpdateForm" method="POST" ajaxAction="{ManageReservationsActions::UpdateAttribute}">
		<input type="hidden" id="attributeUpdateReferenceNumber" {formname key=REFERENCE_NUMBER} />
		<input type="hidden" id="attributeUpdateId" {formname key=ATTRIBUTE_ID} />
		<input type="hidden" id="attributeUpdateValue" {formname key=ATTRIBUTE_VALUE} />
	</form>
</div>

<div id="inlineUpdateCancelButtons" class="hidden">
	<div>
		<a href="#" class="confirmCellUpdate">{html_image src="tick-white.png"}</a>
		<a href="#" class="cancelCellUpdate">{html_image src="cross-white.png"}</a>
	</div>
</div>

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator" style="display:none;"}

{*Imports*}
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="js/jquery.colorbox-min.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{jsfile src="admin/edit.js"}
{jsfile src="admin/reservations.js"}

{jsfile src="autocomplete.js"}
{jsfile src="reservationPopup.js"}
{jsfile src="approval.js"}
{*{jsfile src="admin/help.js"}*}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}
{jsfile src="enhancement/manageReservationsEnhance.js"}
<link rel="stylesheet" href="../scripts/Popup-master/assets/css/popup.css">
{jsfile src="Popup-master/assets/js/jquery.popup.js"}

{*Code*}
<script type="text/javascript">

	$(document).ready(function ()
	{
		enhance();
		var updateScope = {

		};
		updateScope['btnUpdateThisInstance'] = '{SeriesUpdateScope::ThisInstance}';
		updateScope['btnUpdateAllInstances'] = '{SeriesUpdateScope::FullSeries}';
		updateScope['btnUpdateFutureInstances'] = '{SeriesUpdateScope::FutureInstances}';

		var actions = {

		};

		var resOpts = {
			autocompleteUrl: "{$Path}ajax/autocomplete.php?type={AutoCompleteType::User}",
			reservationUrlTemplate: "{$Path}reservation.php?{QueryStringKeys::REFERENCE_NUMBER}=[refnum]",
			{*popupUrl: "{$Path}ajax/respopup.php",*}
			updateScope: updateScope,
			actions: actions,
			deleteUrl: '{$Path}ajax/reservation_delete.php?{QueryStringKeys::RESPONSE_TYPE}=json',
			resourceStatusUrl: '{$smarty.server.SCRIPT_NAME}?{QueryStringKeys::ACTION}=changeStatus',
			submitUrl: '{$smarty.server.SCRIPT_NAME}'
		};

		var approvalOpts = {
			url: '{$Path}ajax/reservation_approve.php'
		};

		var approval = new Approval(approvalOpts);

		var reservationManagement = new ReservationManagement(resOpts, approval);
		reservationManagement.init();

		{foreach from=$reservations item=reservation}

		reservationManagement.addReservation(
				{
					id: '{$reservation->ReservationId}',
					referenceNumber: '{$reservation->ReferenceNumber}',
					isRecurring: '{$reservation->IsRecurring}',
					resourceStatusId: '{$reservation->ResourceStatusId}',
					resourceStatusReasonId: '{$reservation->ResourceStatusReasonId}',
					resourceId: '{$reservation->ResourceId}'
				}
		);
		{/foreach}

		{foreach from=$StatusReasons item=reason}
		reservationManagement.addStatusReason('{$reason->Id()}', '{$reason->StatusId()}', '{$reason->Description()|escape:javascript}');
		{/foreach}

		reservationManagement.initializeStatusFilter('{$ResourceStatusFilterId}', '{$ResourceStatusReasonFilterId}');
	});
</script>

{control type="DatePickerSetupControl" ControlId="startDate" AltId="formattedStartDate"}
{control type="DatePickerSetupControl" ControlId="endDate" AltId="formattedEndDate"}

<div id="approveDiv" style="display:none;text-align:center; top:15%;position:relative;">
	<h3>{translate key=Approving}...</h3>
	{html_image src="reservation_submitting.gif"}
</div>

</div>
{include file='globalfooter.tpl'}

