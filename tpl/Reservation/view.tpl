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
	{include file='globalheader.tpl' TitleKey='ViewReservationHeading' TitleArgs=$ReferenceNumber cssFiles='css/reservation.css'}
{/block}

<div id="reservationbox" class="readonly">
	<div id="result"></div>
	<div id="reservationFormDiv">
		</br>
		</br>
		<div id="reservationDetails">
			<ul class="no-style" style="text-align: center">				
				<li>
					<label>{translate key='Resource'}</label> <br/>
					{if $ResourceName == ""}
						<span class="no-data">{translate key='NotAvailable'}</span>
					{else}
						{$ResourceName}
					{/if}					
				</li>				
				
				<li class="section">
					<label>{translate key='Period'}</label><br/>
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
				
				{if $ShowReservationDetails}
					<li class="section">
						<label>{translate key='ReservationTitle'}</label>
						{if $ReservationTitle neq ''}
							<br/>{$ReservationTitle}
						{else}
							<span class="no-data"><br/>{translate key='None'}</span>
						{/if}
					</li>
					<br/>
					<li>
						<label>{translate key='ReservationDescription'}</label>
						{if $Description neq ''}
							<br/>{$Description|nl2br}
						{else}
							<span class="no-data"><br/>{translate key='None'}</span>
						{/if}
					</li>
				{/if}
			</ul>
		</div>
		</br></br>		
		<div id="reservationDetailsRight" style="text-align:center;">
			{block name="submitButtons"}
				<span class="no-data">{translate key='NoActions'}</span>
			{/block}
		</div>
		<input type="hidden" id="referenceNumber" {formname key=reference_number} value="{$ReferenceNumber}"/>
	</div>
</div>

<div style="display: none">
	<form id="reservationForm" method="post" enctype="application/x-www-form-urlencoded">
		<input type="hidden" {formname key=reservation_id} value="{$ReservationId}"/>
		<input type="hidden" {formname key=reference_number} value="{$ReferenceNumber}"/>
		<input type="hidden" {formname key=reservation_action} value="{$ReservationAction}"/>
		<input type="hidden" {formname key=SERIES_UPDATE_SCOPE} id="hdnSeriesUpdateScope" value="{SeriesUpdateScope::FullSeries}"/>
	</form>
</div>

{*Imports*}
{jsfile src="approval.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/moment.min.js"}
{jsfile src="date-helper.js"}
{jsfile src="reservation.js"}
{jsfile src="autocomplete.js"}

{*Code*}
<script type="text/javascript">
	
	sessionStorage.setItem("popup_status","view");
	
	$(document).ready(function() {	
	
	document.body.style.overflow = "hidden";
	$('#header').remove();
	$('#logo').remove();
	
		var participationOptions = {
			responseType: 'json'
		};
		
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
		
		$("#btnApprove").click(function(){
			approveInterval = setInterval(function(){
				sessionStorage.setItem("popup_status", "update");
				clearInterval(approveInterval);
			},3000);	
		});

		$('.bindableUser').bindUserDetails();	
	
	});
</script>
