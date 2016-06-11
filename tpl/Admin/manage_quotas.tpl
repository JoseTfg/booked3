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
{include file='globalheader.tpl' cssFiles='css/admin.css'}

<h1>{translate key=ManageQuotas}</h1>

<div id="addDialog" class="dialog" title="{translate key=AddQuota}">
	<div class="warning">{translate key=FieldWarning}</div>
	<form id="addQuotaForm" method="post">
	{capture name="resources" assign="resources"}
		<select class='textbox' {formname key=RESOURCE_ID}>
			<option selected='selected' value=''>{translate key=AllResources}</option>
			{foreach from=$Resources item=resource}
				<option value='{$resource->GetResourceId()}'>{$resource->GetName()|replace:',':' '}</option>
			{/foreach}
		</select>
	{/capture}

	{capture name="groups" assign="groups"}
		<select class='textbox' {formname key=GROUP}>
			<option selected='selected' value=''>{translate key=AllGroups}</option>
			{foreach from=$Groups item=group}
				<option value='{$group->Id}'>{$group->Name|replace:',':' '}</option>
			{/foreach}
		</select>
	{/capture}

	{capture name="amount" assign="amount"}
		<input type='number' class='textbox' value='1' size='5' min='1' max='24' {formname key=LIMIT} />
	{/capture}

	{capture name="unit" assign="unit"}
		<select class='textbox' {formname key=UNIT}>
			<option value='{QuotaUnit::Hours}'>{translate key=hours}</option>
			<option value='{QuotaUnit::Reservations}'>{translate key=Reservations}</option>
		</select>
	{/capture}

	{capture name="duration" assign="duration"}
		<select class='textbox' {formname key=DURATION}>
			<option value='{QuotaDuration::Day}'>{translate key=day}</option>
			<option value='{QuotaDuration::Week}'>{translate key=week}</option>
			<option value='{QuotaDuration::Month}'>{translate key=month}</option>
			<option value='{QuotaDuration::Year}'>{translate key=year}</option>
		</select>
	{/capture}

	{translate key=QuotaConfiguration args="$schedules,$resources,$groups,$amount,$unit,$duration"}		
	</br></br></br>
	<button type="button" class="button save">{html_image src="plus-circle.png"} {translate key="Add"}</button>
		
	{html_image src="admin-ajax-indicator.gif" class="indicator"}
	</form>
</div>

<table id="quotaTable" class="list">
<thead>
	<th> {translate key="Resources"} </th>
	<th> {translate key="Groups"} </th>
	<th> {translate key="Amount"} </th>
	<th> {translate key="Unit"} </th>
	<th> {translate key="Duration"} </th>
	<th> {translate key="Delete"} </th>
</thead>
<tbody>
	{foreach from=$Quotas item=quota}		
	<tr>
		<td align="center">
			{if $quota->ResourceName ne ""}
				{$quota->ResourceName|replace:',':' '}
			{else}
				{translate key="AllResources"}
			{/if}
		</td>
		<td align="center">
			{if $quota->GroupName ne ""}
				{$quota->GroupName|replace:',':' '}
			{else}
				{translate key="AllGroups"}
			{/if}
		</td>

		<td align="center">{$quota->Limit}</td>
		<td align="center">{translate key=$quota->Unit}</td>
		<td align="center">{translate key=$quota->Duration}</td>
		<td align="center"><a href="#" quotaId="{$quota->Id}" class="delete">{html_image src="cross-button.png"}</a></td>
	</tr>
	{/foreach}
</tbody>
</table>

<button id="newButton" class="button save" type="button">{html_image src="plus-button.png"} {translate key=Add}</button>

<div id="deleteDialog" class="dialog" title="{translate key=Delete}">
	<form id="deleteQuotaForm" method="post">
		<div class="error" id="marginError">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>		
	</form>
</div>

{*Imports*}
{csrf_token}
{jsfile src="admin/edit.js"}
{jsfile src="admin/quota.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}

{*Code*}
<script type="text/javascript">

$(document).ready(function(){
	
	$("#quotaTable").tablesorter({
		widgets: ["zebra"],
		widgetOptions : {
			zebra : [ "normal-row", "alt-row" ]
		}
	});
	
	var actions = {
		addQuota: '{ManageQuotasActions::AddQuota}',
		deleteQuota: '{ManageQuotasActions::DeleteQuota}'
	};

	var quotaOptions = {
		submitUrl: '{$smarty.server.SCRIPT_NAME}',
		saveRedirect: '{$smarty.server.SCRIPT_NAME}',
		actions: actions
	};

	var quotaManagement = new QuotaManagement(quotaOptions);
	quotaManagement.init();
	
});
	
</script>
{include file='globalfooter.tpl'}