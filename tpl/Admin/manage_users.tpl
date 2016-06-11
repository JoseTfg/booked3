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
{include file='globalheader.tpl' cssFiles='css/admin.css,scripts/css/colorpicker.css'}

<h1>{translate key=ManageUsers}</h1>

<table class="list userList" id="userTable">
<thead>
	<tr>
		<th class="id">&nbsp;</th>		
		<th>{translate key='Username'}</th>
		<th>{translate key='Fullname'}</th>
		<th>{translate key='Email'}</th>
		<td class="action">{translate key='Permissions2'}</th>
		<td class="action">{translate key='Groups'}</th>
		<td class="action">{translate key='Status'}</th>
	</tr>
</thead>
<tbody>
	{foreach from=$users item=user}
	{assign var=id value=$user->Id}
	<tr>
		<td class="id" align="center"><input type="hidden" class="id" value="{$id}"/></td>
		<td id="{$id}" align="center">{$user->Username}</td>
		<td align="center">{fullname first=$user->First last=$user->Last ignorePrivacy="true"}</td>			
		<td align="center"><a href="mailto:{$user->Email}">{$user->Email}</a></td>
		<td width="100px" align="center">
			{if {$id} != "2"}
				<a href="#" class="update changePermissions">{html_image src='my_edit.png'}</a>
			{else}
				--
			{/if}
		</td>
		<td width="100px" align="center">
			{if {$id} != "2"}
				<a href="#" class="update changeGroups">{html_image src='my_edit.png'}</a>
			{else}
				--
			{/if}
		</td>
		{if {$id} != "2"}
			<td width="100px" align="center">
				<a href="#" class="update changeStatus">
					{if {$statusDescriptions[$user->StatusId]} == {translate key='Active'}} {html_image src='tick-circle.png'}
					{else} {html_image src='slash.png'}
					{/if}
				</a>
			</td>
		{else}
			<td align="center">--</td>
		{/if}
	</tr>
	{/foreach}
</tbody>
</table>

<div class="pagination">
	{pagination pageInfo=$PageInfo}
</div>

<input style="float:left;" type="text" placeholder="{translate key=FindUser}" id="userSearch" class="textbox">
<button style="height:22px;padding: 0 10px 0 7px;float:left" type="button" class="button save" onclick="reset();">{translate key='Reset'}</button>
<input type="hidden" id="activeId"/>

<div id="permissionsDialog" class="dialog" title="{translate key=Permissions}">
	<form class="hiddenForm" id="permissionsForm" method="post" ajaxAction="{ManageUsersActions::Permissions}">
		<div class="warning">{translate key=UserPermissionInfo}</div>
		{foreach from=$resources item=resource}
			<label><input {formname key=RESOURCE_ID  multi=true} class="resourceId" type="checkbox" value="{$resource->GetResourceId()}"> {$resource->GetName()}</label>
			<br/>
		{/foreach}
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		</div>
	</form>

	<div id="resourceList" class="hidden">
		{foreach from=$resources item=resource}
			<div class="resource-item" resourceId="{$resource->GetResourceId()}"><a href="#">&nbsp;</a> <span>{$resource->GetName()}</span></div>
		{/foreach}
	</div>

	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedResources"></div>
	<div id="removedResources"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>
</div>

<div id="groupsDialog" class="dialog" title="{translate key=Groups}">
	<div id="groupList" class="hidden">
		{foreach from=$Groups item=group}
			<div class="group-item" groupId="{$group->Id}"><a href="#">&nbsp;</a> <span>{$group->Name}</span></div>
		{/foreach}
	</div>

	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedGroups"></div>
	<div id="removedGroups"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>

	<form id="addGroupForm" method="post" ajaxAction="addUser">
		<input type="hidden" id="addGroupId" {formname key=GROUP_ID} />
		<input type="hidden" id="addGroupUserId" {formname key=USER_ID} />
	</form>

	<form id="removeGroupForm" method="post" ajaxAction="removeUser">
		<input type="hidden" id="removeGroupId" {formname key=GROUP_ID} />
		<input type="hidden" id="removeGroupUserId" {formname key=USER_ID} />
	</form>
</div>

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="autocomplete.js"}
{jsfile src="admin/user.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/colorpicker.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}
{jsfile src="enhancement/userEnhance.js"}

{*Code*}
<script type="text/javascript">

	$(document).ready(function () {
		var actions = {
			activate: '{ManageUsersActions::Activate}',
			deactivate: '{ManageUsersActions::Deactivate}'
		};

		var userOptions = {
			userAutocompleteUrl: "../ajax/autocomplete.php?type={AutoCompleteType::MyUsers}",
			groupsUrl: '{$smarty.server.SCRIPT_NAME}',
			groupManagementUrl: '{$ManageGroupsUrl}',
			permissionsUrl: '{$smarty.server.SCRIPT_NAME}',
			submitUrl: '{$smarty.server.SCRIPT_NAME}',
			saveRedirect: '{$smarty.server.SCRIPT_NAME}',
			selectUserUrl: '{$smarty.server.SCRIPT_NAME}?uid=',
			filterUrl: '{$smarty.server.SCRIPT_NAME}?{QueryStringKeys::ACCOUNT_STATUS}=',
			actions: actions,
			manageReservationsUrl: '{$ManageReservationsUrl}'
		};

		var userManagement = new UserManagement(userOptions);
		userManagement.init();

		{foreach from=$users item=user}
			var user = {
				id: {$user->Id},
				first: '{$user->First|escape:"quotes"}',
				last: '{$user->Last|escape:"quotes"}',
				isActive: '{$user->IsActive()}',
				username: '{$user->Username|escape:"quotes"}',
				email: '{$user->Email|escape:"quotes"}',
				timezone: '{$user->Timezone}',
				phone: '{$user->Phone|escape:"quotes"}',
				organization: '{$user->Organization|escape:"quotes"}',
				position: '{$user->Position|escape:"quotes"}',
				reservationColor: '{$user->ReservationColor|escape:"quotes"}'
			};
			userManagement.addUser(user);
		{/foreach}
		
		sorting();
	});
</script>

{include file='globalfooter.tpl'}
