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

{include file='globalheader.tpl' cssFiles='scripts/css/colorbox.css,css/admin.css,css/jquery.qtip.min.css,css/calendar.css'}

<div id="{$PageId}">
</br></br></br>
<div class="calendarHeading">
	<div class="listHeader">
		{translate key=List}
	</div>
	<div class="rightFloater">
		<a href="manage_reservations.php" id="goList" alt="List" title="List">{translate key=List} {html_image src="list.png"}</a>
		<a href="../my-calendar.php?&ct=day" id="goDay" alt="Today" title="Today">	{translate key=Day} {html_image src="calendar-day.png"}</a>
		<a href="../my-calendar.php?&ct=week" id="goWeek" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
		<a href="../my-calendar.php?&ct=month" id="goMonth" alt="View Month" title="View Month">{translate key=Month} {html_image src="calendar-select-month.png"}</a>
	</div>
	<div class="clear">&nbsp;</div>	
</div>
</br>
<div class="filterTable horizontal-list label-top main-div-shadow" id="filterTable">
	<div id="adminFilterButtons">
		</br>
		<button id="filterButton" class="button">{html_image src="search.png"} {translate key=Filter}</button>
		<button id="clearFilter" class="button">{html_image src="reset.png"} {translate key=Reset}</button>
	</div>	
	<form id="filterForm">
		<div class="main-div-header"> <a href="#" id="myFilterLabel"> {translate key=Filter} </a></div>
		<ul id="ulFilter"  class="hiddenDiv">
			<li class="filter-dates">
				<label for="startDate">{translate key=Between}</label>
				<input id="startDate" type="text" class="textbox" value="{formatdate date=$StartDate}" size="10" style="width:65px;"/>
				<input id="formattedStartDate" type="hidden" value="{formatdate date=$StartDate key=system}"/>
				-
				<input id="endDate" type="text" class="textbox" value="{formatdate date=$EndDate}" size="10" style="width:65px;"/>
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
			<li class="filter-schedule" id="hiddenFilterSchedule">
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
			<li class="filter-referenceNumber" id="hiddenFilterRN">
				<label for="referenceNumber">{translate key=ReferenceNumber}</label>
				<input id="referenceNumber" type="text" class="textbox" value="{$ReferenceNumber}"/>
			</li>
			<li class="filter-resourceStatus" id="hiddenFilterRS">
				<label for="resourceStatusIdFilter">{translate key=ResourceStatus}</label>
				<select id="resourceStatusIdFilter" class="textbox">
					<option value="">{translate key=All}</option>
					<option value="{ResourceStatus::AVAILABLE}">{translate key=Available}</option>
					<option value="{ResourceStatus::UNAVAILABLE}">{translate key=Unavailable}</option>
					<option value="{ResourceStatus::HIDDEN}">{translate key=Hidden}</option>
				</select>
			</li>
			<li class="filter-resourceStatusReason" id="hiddenFilterRSR">
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

<div class="hiddenDiv">
	<input id="dialogString" type="text" value="{translate key="CheckReservation"}">
</div>

<div id="reservationColorbox" class="dialog" title={translate key="CreateReservationHeading"}></div>

<div>&nbsp;</div>

<table class="list" id="reservationTable">
<thead> 
	<tr>
		<th class="id">&nbsp;</th>		
		<th class="restrictedTh">{translate key='Resource'}</th>
		<th class="restrictedTh">{translate key='User'}</th>
		<th class="restrictedTh">{translate key='Title'}</th>
		<th class="restrictedTh">{translate key='Description'}</th>
		<th class="date">{translate key='BeginDate'}</th>
		<th class="date">{translate key='EndDate'}</th>
		<th class="hiddenTh">{translate key='ReferenceNumber'}</th>
		{foreach from=$ReservationAttributes item=attr}
			<th class="hiddenTh">{$attr->Label()}</th>
		{/foreach}
		<td class="action">{translate key='Delete'}</td>
		{if $CanViewAdmin}
			<td class="action">{translate key='Approve'}</td>
		{/if}
	</tr>
	</thead> 
	<tbody> 
	{foreach from=$reservations item=reservation}
		<tr class="{$rowCss} editable" seriesId="{$reservation->SeriesId}">
			<td class="id">{$reservation->ReservationId}</td>			
			<td align="center">{$reservation->ResourceName}
			<td align="center">{fullname first=$reservation->FirstName last=$reservation->LastName ignorePrivacy=true}</td>
				<div>
					{if array_key_exists($reservation->ResourceStatusReasonId,$StatusReasons)}
						<span class="reservationResourceStatusReason">{$StatusReasons[$reservation->ResourceStatusReasonId]->Description()}</span>
					{/if}
				</div>
			</td>
			<td align="center">{$reservation->Title}</td>
			<td align="center">{$reservation->Description}</td>
			<td align="center">{formatdate date=$reservation->StartDate timezone=$Timezone key=res_popup}</td>
			<td align="center">{formatdate date=$reservation->EndDate timezone=$Timezone key=res_popup}</td>
			{*<td align="center">{$reservation->GetDuration()->__toString()}</td>*}
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
			{if $CanViewAdmin}				
				<td class="center"><a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
				{if $reservation->RequiresApproval}
					<td class="center">
						<a href="#" class="update approve">{html_image src='tick-button.png'}</a>					
					</td>
				{else}
					<td class="center">-</td>
				{/if}			
			{else}
				{if $reservation->StartDateNumber > $date}
					<td class="center"><a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
				{else}
					<td class="center">-</td>
				{/if}
			{/if}
		</tr>
	{/foreach}
	</tbody>
</table>

<div class="pagination">
	{pagination pageInfo=$PageInfo}
</div>

<div id="deleteInstanceDialog" class="dialog" title="{translate key='Delete'}">
	<form id="deleteInstanceForm" method="post">
		<div class="delResResponse"></div>
		<div class="error">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		</br>
		<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} value="{SeriesUpdateScope::ThisInstance}"/>
		<input type="hidden" {formname key=REFERENCE_NUMBER} value="" class="referenceNumber"/>
	</form>
</div>

<div id="deleteSeriesDialog" class="dialog" title="{translate key='Delete'}">
	<form id="deleteSeriesForm" method="post">
		<div class="error">
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
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="js/jquery.colorbox-min.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{jsfile src="admin/edit.js"}
{jsfile src="admin/reservations.js"}

{jsfile src="autocomplete.js"}
{jsfile src="reservationPopup.js"}
{jsfile src="approval.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}
{jsfile src="enhancement/manageReservationsEnhance.js"}

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

<div id="approveDiv" class="creating">
	<h3>{translate key=Approving}...</h3>
	{html_image src="reservation_submitting.gif"}
</div>

</div>

{include file='globalfooter.tpl'}

