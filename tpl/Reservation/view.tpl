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
{include file='globalheader.tpl' TitleKey='ViewReservationHeading' TitleArgs=$ReferenceNumber cssFiles='css/reservation.css'}
<div id="reservationbox" class="readonly">
	<div id="reservationFormDiv">
		<div class="reservationHeader">
			<h3>{translate key="ViewReservationHeading"}</h3>
		</div>
		<div id="reservationDetails">
			<ul id="reservationDetailsLeft" class="no-style">				
				<li>
					<label>{translate key='Resources'}</label> <br/>{$ResourceName}					
					{foreach from=$AvailableResources item=resource}
						{if is_array($AdditionalResourceIds) && in_array($resource->Id, $AdditionalResourceIds)}
							,{$resource->Name}
						{/if}
					{/foreach}
				</li>
				<br/>
				<li>
					{if $ShowReservationDetails}
					<label>{translate key='Accessories'}</label><br/>
					{if $Accessories|count > 0}
					{foreach from=$Accessories item=accessory name=accessoryLoop}
						({$accessory->QuantityReserved})
						{if $smarty.foreach.accessoryLoop.last}
							{$accessory->Name}
						{else}
							{$accessory->Name},
						{/if}
					{/foreach}
					{else}
							Ninguno
					{/if}
					{/if}
				</li>
				<li class="section">
					{formatdate date=$StartDate}
					<input type="hidden" id="formattedBeginDate" value="{formatdate date=$StartDate key=system}"/>
					{foreach from=$StartPeriods item=period}
						{if $period eq $SelectedStart}
							{$period->Label()}
							<input type="hidden" id="BeginPeriod" value="{$period->Begin()}"/>
						{/if}
					{/foreach}

					<label> - </label> {formatdate date=$EndDate}
					<input type="hidden" id="formattedEndDate" value="{formatdate date=$EndDate key=system}" />
					{foreach from=$EndPeriods item=period}
						{if $period eq $SelectedEnd}
							{$period->LabelEnd()} <br/>
							<input type="hidden" id="EndPeriod" value="{$period->End()}"/>
						{/if}
					{/foreach}
				</li>
				<li>
					<div class="durationText">
						<span id="durationHours">0</span> {translate key='hours'}
					</div>
				</li>
				
				{if $ShowReservationDetails}
					<li class="section">
						<label>{translate key='ReservationTitle'}</label>
						{if $ReservationTitle neq ''}
							<br/>{$ReservationTitle}
						{else}
							<span class="no-data">{translate key='None'}</span>
						{/if}
					</li>
					<br/>
					<li>
						<label>{translate key='ReservationDescription'}</label>
						{if $Description neq ''}
							<br/>{$Description|nl2br}
						{else}
							<span class="no-data">{translate key='None'}</span>
						{/if}
					</li>
				{/if}
			</ul>
		</div>

		

		{if $ShowReservationDetails}
			{if $Attributes|count > 0}
			<div class="customAttributes">
				<ul>
				{foreach from=$Attributes item=attribute}				
					<li class="customAttribute">
						{control type="AttributeControl" attribute=$attribute readonly=true}						
					</li>
					<br/>
				{/foreach}
				</ul>
			</div>
			<div style="clear:both;">&nbsp;</div>
			{/if}
		{/if}

		{if $ShowReservationDetails}
			<div id="reservationDetailsLeft" style="float:left;">
				{block name="deleteButtons"}
					<a href="{$Path}export/{Pages::CALENDAR_EXPORT}?{QueryStringKeys::REFERENCE_NUMBER}={$ReferenceNumber}">
					{html_image src="calendar-plus.png"}
					{translate key=AddToOutlook}</a>
				{/block}
			</div>
		{/if}
		<div id="reservationDetailsRight" style="float:right;">
			{block name="submitButtons"}
				&nbsp
			{/block}
			<button type="button" class="button" onclick="window.location='{$ReturnUrl}'">
				<img src="img/slash.png"/>
				{translate key='Close'}			
		</div>

		{if $ShowReservationDetails}
			{if $Attachments|count > 0}
				<div style="clear:both">&nbsp;</div>
				<div class="res-attachments">
				<span class="heading">{translate key=Attachments}</span>
					{foreach from=$Attachments item=attachment}
						<a href="attachments/{Pages::RESERVATION_FILE}?{QueryStringKeys::ATTACHMENT_FILE_ID}={$attachment->FileId()}&{QueryStringKeys::REFERENCE_NUMBER}={$ReferenceNumber}" target="_blank">{$attachment->FileName()}</a>&nbsp;
					{/foreach}
				</div>
			{/if}
		{/if}
		<input type="hidden" id="referenceNumber" {formname key=reference_number} value="{$ReferenceNumber}"/>
	</div>
</div>

<div id="dialogSave" style="display:none;">
	<div id="creatingNotification" style="position:relative; top:170px;">
	{block name="ajaxMessage"}
		{translate key=UpdatingReservation}...<br/>
	{/block}
		<img src="{$Path}img/reservation_submitting.gif" alt="Creating reservation"/>
	</div>
	<div id="result" style="display:none;"></div>
</div>

<div style="display: none">
	<form id="reservationForm" method="post" enctype="application/x-www-form-urlencoded">
		<input type="hidden" {formname key=reservation_id} value="{$ReservationId}"/>
		<input type="hidden" {formname key=reference_number} value="{$ReferenceNumber}"/>
		<input type="hidden" {formname key=reservation_action} value="{$ReservationAction}"/>
		<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} id="hdnSeriesUpdateScope" value="{SeriesUpdateScope::FullSeries}"/>
	</form>
</div>
{jsfile src="participation.js"}
{jsfile src="approval.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/moment.min.js"}
{jsfile src="date-helper.js"}
{jsfile src="reservation.js"}
{jsfile src="autocomplete.js"}
{jsfile src="userPopup.js"}

	<script type="text/javascript">

	$(document).ready(function() {

		var participationOptions = {
			responseType: 'json'
		};

		var participation = new Participation(participationOptions);
		participation.initReservation();

		var approvalOptions = {
			responseType: 'json',
			url: "{$Path}ajax/reservation_approve.php"
		};

		var approval = new Approval(approvalOptions);
		approval.initReservation();

		var scopeOptions = {
				instance: '{SeriesUpdateScope::ThisInstance}',
				full: '{SeriesUpdateScope::FullSeries}',
				future: '{SeriesUpdateScope::FutureInstances}'
			};

		var reservationOpts = {
			returnUrl: '{$ReturnUrl}',
			scopeOpts: scopeOptions,
			deleteUrl: 'ajax/reservation_delete.php',
			userAutocompleteUrl: "ajax/autocomplete.php?type={AutoCompleteType::User}",
			changeUserAutocompleteUrl: "ajax/autocomplete.php?type={AutoCompleteType::MyUsers}"
		};
		var reservation = new Reservation(reservationOpts);
		reservation.init('{$UserId}');

		var options = {
			target: '#result',   // target element(s) to be updated with server response
			beforeSubmit: reservation.preSubmit,  // pre-submit callback
			success: reservation.showResponse  // post-submit callback
		};

		$('#reservationForm').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});

		$('.bindableUser').bindUserDetails();
	});

	</script>
{include file='globalfooter.tpl'}