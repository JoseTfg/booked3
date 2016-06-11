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

<h1>{translate key=ManageGroups} </h1>

<table id="groupTable" class="list">
	<thead>
		<th class="id">&nbsp;</th>
		<th>{translate key='Name'}</th>
		<td class="action">{translate key='Members'}</th>		
		{if $CanChangeRoles}
			<td class="action">{translate key='Roles'}</th>
		{/if}	
		<td class="action">{translate key='Permissions2'}</th>
		<td class="action">{translate key='Delete'}</th>
	</thead>
{foreach from=$groups item=group}
	<tr>
		<td class="id">{$group->Id}<input type="hidden" class="id" value="{$group->Id}"/></td>
		<td align="center" id="{$group->Id}" ><a href="#" class="update rename">{$group->Name}</a></td>
		<td width="100px" align="center">
			{if {$group->Id} != "2"}
				<a href="#" class="update members">{html_image src='my_edit.png'}</a>
			{else}
				--
			{/if}
		</td>		
		{if $CanChangeRoles}
			<td width="100px" align="center">
				{if {$group->Id} != "2"}
					<a href="#" class="update roles">{html_image src='my_edit.png'}</a>
				{else}
					--
				{/if}
			</td>
		{/if}		
		<td width="100px" align="center">
			{if {$group->Id} != "2"}
				<a href="#" class="update permissions">{html_image src='my_edit.png'}</a>
			{else}
				--
			{/if}
		</td>
		<td width="100px" align="center">
			{if {$group->Id} != "2"}
				<a href="#" class="update delete">{html_image src='cross-button.png'}</a>
			{else}
				--
			{/if}
		</td>
	</tr>
{/foreach}
</table>

<div class="pagination">
	{pagination pageInfo=$PageInfo}
</div>

<input type="hidden" id="activeId" />

<div id="membersDialog" class="dialog" title="{translate key=GroupMembers}">
	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedMembers"></div>
	<div id="removedMembers"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>
</div>

<div id="permissionsDialog" class="dialog" title="{translate key=Permissions}">
	<form class="hiddenForm" id="permissionsForm" method="post">
		<div class="warning">{translate key=UserPermissionInfo}</div>
		{foreach from=$resources item=resource}
			<label>
				<input {formname key=RESOURCE_ID  multi=true} class="resourceId" type="checkbox" value="{$resource->GetResourceId()}"> {$resource->GetName()}
			</label>
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

<form id="removeUserForm" method="post">
	<input type="hidden" id="removeUserId" {formname key=USER_ID} />
</form>

<form id="addUserForm" method="post">
	<input type="hidden" id="addUserId" {formname key=USER_ID} />
</form>

<div id="deleteDialog" class="dialog" title="{translate key=Delete}">
	<form id="deleteGroupForm" method="post">
		<div class="error" id="marginError">
			<h3>{translate key=DeleteWarning}</h3>
			<div>{translate key=DeleteGroupWarning}</div>
		</div>
		<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>
	</form>
</div>

<div id="renameDialog" class="dialog" title="{translate key=Rename}">
	<form id="renameGroupForm" method="post">
		<input type="text" placeholder="{translate key=Name}" class="textbox required" {formname key=GROUP_NAME} /></label>
		<button type="button" class="button save">{html_image src="disk-black.png"} {translate key=Rename}</button>
	</form>
</div>

<div id="addDialog" class="dialog" title="{translate key=AddGroup}">
	<div id="addGroupResults" class="error"></div>
	<form id="addGroupForm" method="post">
		<input placeholder="{translate key=GroupName}" type="text" class="textbox required" {formname key=GROUP_NAME} />
		<button type="button" class="button save">{html_image src="plus-button.png"} {translate key=AddGroup}</button>
	</form>
</div>

{if $CanChangeRoles}
<div id="rolesDialog" class="dialog" title="{translate key=Roles}">
	<form class="hiddenForm" id="rolesForm" method="post">
		<ul>
			{foreach from=$Roles item=role}
				<li><label><input type="checkbox" {formname key=ROLE_ID multi=true}" value="{$role->Id}" /> {$role->Name}</label></li>
			{/foreach}
			<button type="button" class="button save">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		</ul>
	</form>
	<div id="roleList" class="hidden">
		{foreach from=$Roles item=role}
			{if $role->Id == '2'} 
				<div class="role-item" roleId="{$role->Id}"><a href="#">&nbsp;</a> <span>{translate key='AppAdmin'}</span></div>
			{else}
				<div class="role-item" roleId="{$role->Id}"><a href="#">&nbsp;</a> <span>{translate key='ResAdmin'}</span></div>
			{/if}
		{/foreach}
	</div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedRoles"></div>
	<div id="removedRoles"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>
</div>
{/if}

<div id="groupAdminDialog" class="dialog" title="{translate key=WhoCanManageThisGroup}">
	<form method="post" id="groupAdminForm">
		<select {formname key=GROUP_ADMIN} class="textbox">
			<option value="">-- {translate key=None} --</option>
			{foreach from=$AdminGroups item=adminGroup}
				<option value="{$adminGroup->Id}">{$adminGroup->Name}</option>
			{/foreach}
		</select>
		<button type="button" class="button save">{html_image src="tick-circle.png"} {translate key='Update'}</button>
	</form>
</div>
<button type="button" id="addButton" class="button save">{html_image src="plus-button.png"} {translate key=AddGroup}</button>

<div class="hiddenDiv">
	<input id="adminString" type="text" value="{translate key="Superuser"}">
	<input id="resourceString" type="text" value="{translate key="ResourceAdministrator"}">
</div>	
	
{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="autocomplete.js"}
{jsfile src="admin/group.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}
{jsfile src="enhancement/groupEnhance.js"}

{*Code*}
<script type="text/javascript">

	$(document).ready(function() {
	var actions = {
		activate: '{ManageGroupsActions::Activate}',
		deactivate: '{ManageGroupsActions::Deactivate}',
		permissions: '{ManageGroupsActions::Permissions}',
		password: '{ManageGroupsActions::Password}',
		removeUser: '{ManageGroupsActions::RemoveUser}',
		addUser: '{ManageGroupsActions::AddUser}',
		addGroup: '{ManageGroupsActions::AddGroup}',
		renameGroup: '{ManageGroupsActions::RenameGroup}',
		deleteGroup: '{ManageGroupsActions::DeleteGroup}',
		roles: '{ManageGroupsActions::Roles}',
		groupAdmin: '{ManageGroupsActions::GroupAdmin}'
	};

	var dataRequests = {
		permissions: 'permissions',
		roles: 'roles',
		groupMembers: 'groupMembers'
	};

	var groupOptions = {
		userAutocompleteUrl: "../ajax/autocomplete.php?type={AutoCompleteType::User}",
		groupAutocompleteUrl: "../ajax/autocomplete.php?type={AutoCompleteType::Group}",
		groupsUrl:  "{$smarty.server.SCRIPT_NAME}",
		permissionsUrl:  '{$smarty.server.SCRIPT_NAME}',
		rolesUrl:  '{$smarty.server.SCRIPT_NAME}',
		submitUrl: '{$smarty.server.SCRIPT_NAME}',
		saveRedirect: '{$smarty.server.SCRIPT_NAME}',
		selectGroupUrl: '{$smarty.server.SCRIPT_NAME}?gid=',
		actions: actions,
		dataRequests: dataRequests
	};	
	
	sorting();

	var groupManagement = new GroupManagement(groupOptions);
	groupManagement.init();
	});
</script>

{include file='globalfooter.tpl'}
