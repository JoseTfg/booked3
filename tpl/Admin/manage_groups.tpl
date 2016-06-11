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

<h1>{translate key=ManageGroups} {*{html_image src="question-button.png" id="help-prompt" ref="help-groups"}*}</h1>

{*<div style="padding: 10px 0px;">
	{translate key='FindGroup'}:<br/>
	<input type="text" id="groupSearch" class="textbox" size="40"/> {html_link href=$smarty.server.SCRIPT_NAME key=AllGroups}
</div>*}
<div>
<table id="groupTable" class="list">
	<thead>
		<th class="id">&nbsp;</th>
		<th>{translate key='Name'}</th>
		{*<th>{translate key='GroupAdmin'}</th>*}
		<td class="action">{translate key='Members'}</th>		
		{if $CanChangeRoles}
		<td class="action">{translate key='Roles'}</th>
		{/if}	
		<td class="action">{translate key='Permissions'}</th>
		<td class="action">Borrar</th>
	</thead>
{foreach from=$groups item=group}
	{cycle values='row0,row1' assign=rowCss}
	<tr {*class="{$rowCss}"*}>
		<td class="id">{$group->Id}<input type="hidden" class="id" value="{$group->Id}"/></td>
		<td align="center" id="{$group->Id}" ><a href="#" class="update rename">{$group->Name}</a></td>
		{*<td align="center"><a href="#" class="update groupAdmin">{$group->AdminGroupName|default:"Ninguno"}</a></td>*}
		<td align="center">
		{if {$group->Id} != "2"}
		<a href="#" class="update members">{html_image src='my_edit.png'}{*{translate key='Manage'}*}</a>
		{else}
		--
		{/if}
		</td>		
		{if $CanChangeRoles}
		<td align="center">
		{if {$group->Id} != "2"}
		<a href="#" class="update roles">{html_image src='my_edit.png'}{*{translate key='Change'}*}</a>
		{else}
		--
		{/if}
		</td>
		{/if}		
		<td align="center">
		{if {$group->Id} != "2"}
		<a href="#" class="update permissions">{html_image src='my_edit.png'}{*{translate key='Change'}*}</a>
		{else}
		--
		{/if}
		</td>
		<td align="center">
		{if {$group->Id} != "2"}
		<a href="#" class="update delete">{html_image src='cross-button.png'}</a>
		{else}
		--
		{/if}
		</td>
	</tr>
{/foreach}
</table>

<div style="text-align:center;">
{pagination pageInfo=$PageInfo}
</div>
</div>
<input type="hidden" id="activeId" />
{*
<div id="membersDialog" class="dialog" style="display:none;background-color:#FFCC99;overflow:hidden;" title="{translate key=GroupMembers}">
	{translate key=AddUser}: <input type="text" placeholder="{translate key=AddUser}" id="userSearch" class="textbox" size="40" /> <a href="#" id="browseUsers">{translate key=Browse}</a>
	<div style="visibility:hidden;">prueba</div>
	<div id="allUsers" style="display:none;" class="dialog" title="{translate key=AllUsers}"></div>
	<h4><span id="totalUsers"></span> {translate key=UsersInGroup}</h4>
	<div id="groupUserList"></div>
</div>
*}

<div id="membersDialog" class="dialog" style="display:none;background-color:#FFCC99;overflow:hidden;" title="{translate key=GroupMembers}">
	{*{translate key=AddUser}: <input type="text" placeholder="{translate key=AddUser}" id="userSearch" class="textbox" size="40" /> <a href="#" id="browseUsers">{translate key=Browse}</a>
	<div style="visibility:hidden;">prueba</div>*}
	{*<div id="allUsers" style="display:none;" class="dialog" title="{translate key=AllUsers}"></div>*}
	{*<h4><span id="totalUsers"></span> {translate key=UsersInGroup}</h4>*}
	{*<div id="groupUserList"></div>*}<div id="addedMembers"></div>
	{*<div id="allUsers"></div>*}<div id="removedMembers"></div>
</div>

{*<div id="permissionsDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=Permissions}">
	<form id="permissionsForm" method="post">
		{foreach from=$resources item=resource}
			<label><input {formname key=RESOURCE_ID  multi=true} class="resourceId" type="checkbox" value="{$resource->GetResourceId()}"> {$resource->GetName()}</label><br/>
		{/foreach}
		<button type="button" class="button save" style="float:right;">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>
	</form>
</div>
*}

<div id="permissionsDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=Permissions}">
	<form style="display:none" id="permissionsForm" method="post">
		<div class="warning">{translate key=UserPermissionInfo}</div>
		{foreach from=$resources item=resource}
			<label><input {formname key=RESOURCE_ID  multi=true} class="resourceId" type="checkbox"
																 value="{$resource->GetResourceId()}"> {$resource->GetName()}
			</label>
			<br/>
		{/foreach}
		<div class="admin-update-buttons">
			<button type="button" class="button save" style="float:right;">{html_image src="tick-circle.png"} {translate key='Update'}</button>
			<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>
		</div>
	</form>
	
	{*<div id="allUsers" style="display:none;" class="dialog" title="{translate key=AllUsers}"></div>*}

	<div id="resourceList" class="hidden">
		{foreach from=$resources item=resource}
			<div class="resource-item" resourceId="{$resource->GetResourceId()}"><a href="#">&nbsp;</a> <span>{$resource->GetName()}</span></div>
		{/foreach}
	</div>

	<div id="addedResources">
	</div>

	<div id="removedResources">
	</div>
</div>

<form id="removeUserForm" method="post">
	<input type="hidden" id="removeUserId" {formname key=USER_ID} />
</form>

<form id="addUserForm" method="post">
	<input type="hidden" id="addUserId" {formname key=USER_ID} />
</form>

<div id="deleteDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=Delete}">
	<form id="deleteGroupForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>
			<div>{translate key=DeleteGroupWarning}</div>
		</div>
		<button type="button" class="button save" style="float:right;">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		{*<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
	</form>
</div>

<div id="renameDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=Rename}">
	<form id="renameGroupForm" method="post">
		{*<label>{translate key=Name}<br/> *}<input type="text" placeholder="{translate key=Name}" class="textbox required" {formname key=GROUP_NAME} /></label>
		<button type="button" class="button save" style="float:right;">{html_image src="disk-black.png"} {translate key=Rename}</button>
		{*<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key=Cancel}</button>*}
	</form>
</div>

<div id="addDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=AddGroup}">
		<div id="addGroupResults" class="error" style="display:none;"></div>
		<form id="addGroupForm" method="post">
			{*Name<br/> *}<input placeholder="{translate key=GroupName}" type="text" class="textbox required" {formname key=GROUP_NAME} />
			<button type="button" class="button save" style="float:right;">{html_image src="plus-button.png"} {translate key=AddGroup}</button>
		</form>
</div>

{if $CanChangeRoles}
<div id="rolesDialog" class="dialog" title="{translate key=GroupRoles}" style="background-color:#FFCC99">
	<form  style="display:none"  id="rolesForm" method="post">
		<ul>
		{foreach from=$Roles item=role}
			<li><label><input type="checkbox" {formname key=ROLE_ID multi=true}" value="{$role->Id}" /> {$role->Name}</label></li>
		{/foreach}
		<button type="button" class="button save" style="float:right;">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		{*<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
		</ul>
	</form>
	<div id="roleList" class="hidden">
		{foreach from=$Roles item=role}
			<div class="role-item" roleId="{$role->Id}"><a href="#">&nbsp;</a> <span>{$role->Name}</span></div>
		{/foreach}
	</div>
	{*<div id="groupUserList"></div>*}<div id="addedRoles"></div>
	{*<div id="allUsers"></div>*}<div id="removedRoles"></div>
</div>
{/if}

<div id="groupAdminDialog" class="dialog" title="{translate key=WhoCanManageThisGroup}" style="background-color:#FFCC99">
	<form method="post" id="groupAdminForm">
		<select {formname key=GROUP_ADMIN} class="textbox">
			<option value="">-- {translate key=None} --</option>
			{foreach from=$AdminGroups item=adminGroup}
				<option value="{$adminGroup->Id}">{$adminGroup->Name}</option>
			{/foreach}
		</select>

		<button type="button" class="button save" style="float:right;">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		{*<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
	</form>
</div>
		<button type="button" id="addButton" class="button save" style="float:right;">{html_image src="plus-button.png"} {translate key=AddGroup}</button>
		{*<form id="addGroupForm" method="post" style="margin-top:-30px">
			Name<br/> <input style="float:right;" type="text" class="textbox required" {formname key=GROUP_NAME} />
			<button type="button" class="button save" style="float:right;">{html_image src="plus-button.png"} {translate key=AddGroup}</button>
		</form>*}
{*
<div class="admin" style="margin-top:30px">
	<div class="title">
		{translate key=AddGroup}
	</div>
	<div>
		<div id="addGroupResults" class="error" style="display:none;"></div>

	</div>
</div>
*}
{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator" style="display:none;"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="autocomplete.js"}
{jsfile src="admin/group.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="admin/help.js"}

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
