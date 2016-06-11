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

<h1>{translate key=ManageUsers}{* {html_image src="question-button.png" id="help-prompt" ref="help-users"}*}</h1>
<div>
<table class="list userList" id="userTable">
	<thead>
	<tr>
		<th class="id">&nbsp;</th>		
		<th>{translate key='Username'}</th>
		<th>{translate key='Name'}</th>
		<th>{translate key='Email'}</th>
		<td class="action">{translate key='Permissions'}</th>
		<td class="action">{translate key='Groups'}</th>
		<td class="action">{translate key='Status'}</th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$users item=user}
		{cycle values='row0,row1' assign=rowCss}
		{assign var=id value=$user->Id}
		<tr {*class="{$rowCss} editable"*}>
			<td class="id" align="center"><input type="hidden" class="id" value="{$id}"/></td>
			<td id="{$id}" align="center">{$user->Username}</td>
			<td align="center">{fullname first=$user->First last=$user->Last ignorePrivacy="true"}</td>			
			<td align="center"><a href="mailto:{$user->Email}">{$user->Email}</a></td>
			<td align="center">
			{if {$id} != "2"}
			<a href="#" class="update changePermissions">{html_image src='my_edit.png'}</a>
			{else}
			--
			{/if}
			</td>
			<td align="center">
			{if {$id} != "2"}
			<a href="#" class="update changeGroups">{html_image src='my_edit.png'}</a>
			{else}
			--
			{/if}
			</td>
			{if {$id} != "2"}
			<td align="center"><a href="#" class="update changeStatus">
			{if {$statusDescriptions[$user->StatusId]} == {translate key='Active'}} {html_image src='tick-circle.png'}
			{else} {html_image src='slash.png'}
			{/if}
			</a></td>
			{else}
			<td align="center">--</td>
			{/if}
			{if $PerUserColors}
				<td align="center">
					<a href="#" class="update changeColor">{translate key='Edit'}</a>
					{if !empty($user->ReservationColor)}
						<div class="user-color update changeColor" style="background-color:#{$user->ReservationColor}">&nbsp;</div>
					{/if}
				</td>
			{/if}
		</tr>
		{assign var=attributes value=$AttributeList}
		{if $attributes|count > 0}
			<tr>
				<td class="id"><input type="hidden" class="id" value="{$id}"/></td>
				<td colspan="17" class="{$rowCss} customAttributes" userId="{$id}">
					<form method="post" class="attributesForm" ajaxAction="{ManageUsersActions::ChangeAttributes}">
						<h3>{translate key=AdditionalAttributes}
							<a href="#" class="update changeAttributes">{translate key=Edit}</a>
						</h3>

						<div class="validationSummary">
							<ul>
							</ul>
							<div class="clear">&nbsp;</div>
						</div>

						<div>
							<ul>
								{foreach from=$attributes item=attribute}
									{assign var="attributeValue" value=$user->GetAttributeValue($attribute->Id())}
									<li class="customAttribute" attributeId="{$attribute->Id()}">
										<div class="attribute-readonly">{control type="AttributeControl" attribute=$attribute value=$attributeValue readonly=true}</div>
										<div class="attribute-readwrite hidden">{control type="AttributeControl" attribute=$attribute value=$attributeValue}
									</li>
								{/foreach}
							</ul>
						</div>

						<div class="attribute-readwrite hidden" style="height:auto;">
							<button type="button"
									class="button save">{html_image src="tick-circle.png"} {translate key='Update'}</button>
							<button type="button"
									class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
						</div>
					</form>
				</td>
			</tr>
		{/if}
	{/foreach}
	</tbody>
</table>

{*
<div style="padding: 10px 40px; float:right;">
	<table>
		<tr>			
			<td><label for="userSearch">{translate key=FindUser}:</label></td>
			<td><input type="text" placeholder="{translate key=FindUser}" id="userSearch" class="textbox"
			<td><button type="button" class="button save" onclick="reset();">{html_image src="reset.png"} {translate key='Reset'}</button></td>
			{<td><label for="filterStatusId">{translate key=Status}:</label></td>
		</tr>
		<tr>
			
					   size="40"/> {html_link href=$smarty.server.SCRIPT_NAME key=AllUsers}</td>
			<td><select id="filterStatusId" class="textbox">
					{html_options selected=$FilterStatusId options=$statusDescriptions}
				</select></td>
		</tr>

	</table>
</div>
*}
<div style="text-align:center;">
{pagination pageInfo=$PageInfo}
</div>
</div>

<button type="button" style="float:right;" class="button save" onclick="reset();">{html_image src="reset.png"}{translate key='Reset'}</button>
<input type="text" style="float:right;" placeholder="{translate key=FindUser}" id="userSearch" class="textbox">

<div class="admin" style="margin-top:30px;display:none;">
	<div class="title">
		{translate key=AddUser}
	</div>
	<div>
		<div class="validationSummary">
			<ul>
				{async_validator id="addUserEmailformat" key="ValidEmailRequired"}
				{async_validator id="addUserUniqueemail" key="UniqueEmailRequired"}
				{async_validator id="addUserUsername" key="UniqueUsernameRequired"}
				{async_validator id="addAttributeValidator" key=""}
			</ul>
		</div>
		<form id="addUserForm" method="post" ajaxAction="{ManageUsersActions::AddUser}">
			<div style="display: table-row">
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="Username"}</li>
						<li>{textbox name="USERNAME" class="required textbox" size="40" id="addUsername"}</li>
					</ul>
				</div>
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="Email"}</li>
						<li>{textbox name="EMAIL" class="required textbox" size="40" id="addEmail"}</li>
					</ul>
				</div>
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="FirstName"}</li>
						<li>{textbox name="FIRST_NAME" class="required textbox" size="40" id="addFname"}</li>
					</ul>
				</div>
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="LastName"}</li>
						<li>{textbox name="LAST_NAME" class="required textbox" size="40" id="addLname"}</li>
					</ul>
				</div>
			</div>
			<div style="display: table-row">
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="Timezone"}</li>
						<li>
							<select {formname key='TIMEZONE'} class="textbox">
								{html_options values=$Timezones output=$Timezones selected=$Timezone}
							</select>
						</li>
					</ul>
				</div>
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="Password"}</li>
						<li>{textbox name="PASSWORD" class="required textbox" size="40" id="addPassword"}</li>
					</ul>
				</div>
				<div style="display: table-cell;">
					<ul>
						<li>{translate key="Group"}</li>
						<li>
							<select {formname key='GROUP_ID'} class="textbox">
								<option value="">{translate key=None}</option>
								{object_html_options options=$Groups label=Name key=Id}
							</select>
						</li>
					</ul>
				</div>
			</div>

			<div class="customAttributes">
				<ul>
					{assign var=attributes value=$AttributeList}
					{foreach from=$attributes item=attribute}
						<li class="customAttribute">
							{control type="AttributeControl" attribute=$attribute algin=vertical}
						</li>
					{/foreach}
				</ul>
				<div style="clear:both;"></div>
			</div>

			<div class="admin-update-buttons">
				<button type="button"
						class="button save">{html_image src="disk-black.png"} {translate key='AddUser'}</button>
				<button type="button" class="button clearform">{html_image src="slash.png"} {translate key='Cancel'}</button>
			</div>
		</form>
	</div>
</div>

<div class="admin" style="margin-top:30px;display:none;">
	<div class="title">
		{translate key=Import}
	</div>

	<div>
		<div class="validationSummary">
			<ul>
				{async_validator id="fileExtensionValidator" key=""}
				{async_validator id="importUsersValidator" key=""}
			</ul>
		</div>
		<div id="importErrors" class="error hidden"></div>
		<div id="importResult" class="hidden">
			<span>{translate key=RowsImported}</span>

			<div id="importCount" class="inline bold"></div>
			<span>{translate key=RowsSkipped}</span>

			<div id="importSkipped" class="inline bold"></div>
			<a href="{$smarty.server.SCRIPT_NAME}">{translate key=Done}</a>
		</div>
		<form id="importUsersForm" method="post" enctype="multipart/form-data" ajaxAction="{ManageUsersActions::ImportUsers}">
			<input type="file" {formname key=USER_IMPORT_FILE} />

			<div class="admin-update-buttons">
				<button type="button" class="button save">{html_image src="table-import.png"} {translate key=Import}</button>
			</div>
		</form>
	</div>
	<div>
		<span class="note">{translate key=UserImportInstructions}</span>
		<a href="{$smarty.server.SCRIPT_NAME}?dr=template" target="_blank">{translate key=GetTemplate}</a>
	</div>
</div>

<input type="hidden" id="activeId"/>

<div id="permissionsDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="{translate key=Permissions}">
	<form style="display:none" id="permissionsForm" method="post" ajaxAction="{ManageUsersActions::Permissions}">
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

<div id="passwordDialog" class="dialog" style="display:none;" title="{translate key=Password}">
	<form id="passwordForm" method="post" ajaxAction="{ManageUsersActions::Password}">
		{translate key=Password}<br/>
		{textbox type="password" name="PASSWORD" class="required textbox" value=""}
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
			<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		</div>
	</form>
</div>

<div id="userDialog" class="dialog" title="{translate key=Update}">
	<form id="userForm" method="post" ajaxAction="{ManageUsersActions::UpdateUser}">

		<div class="validationSummary">
			<ul>
				{async_validator id="emailformat" key="ValidEmailRequired"}
				{async_validator id="uniqueemail" key="UniqueEmailRequired"}
				{async_validator id="uniqueusername" key="UniqueUsernameRequired"}
			</ul>
		</div>

		<ul>
			<li>{translate key="Username"}</li>
			<li>{textbox name="USERNAME" class="required textbox" size="40" id="username"}</li>
			<li>{translate key="Email"}</li>
			<li>{textbox name="EMAIL" class="required textbox" size="40" id="email"}</li>

			<li>{translate key="FirstName"}</li>
			<li>{textbox name="FIRST_NAME" class="required textbox" size="40" id="fname"}</li>
			<li>{translate key="LastName"}</li>
			<li>{textbox name="LAST_NAME" class="required textbox" size="40" id="lname"}</li>

			<li>{translate key="Timezone"}</li>
			<li>
				<select {formname key='TIMEZONE'} id='timezone' class="textbox">
					{html_options values=$Timezones output=$Timezones}
				</select>
			</li>

			<li>{translate key="Phone"}</li>
			<li>{textbox name="PHONE" class="textbox" size="40" id="phone"}</li>
			<li>{translate key="Organization"}</li>
			<li>{textbox name="ORGANIZATION" class="textbox" size="40" id="organization"}</li>
			<li>{translate key="Position"}</li>
			<li>{textbox name="POSITION" class="textbox" size="40" id="position"}</li>
		</ul>
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
			<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		</div>
	</form>
</div>

<div id="deleteDialog" class="dialog" title="{translate key=Delete}">
	<form id="deleteUserForm" method="post" ajaxAction="{ManageUsersActions::DeleteUser}">
		<div class="error" style="margin-bottom: 25px;">
			<h3>{translate key=DeleteWarning}</h3>

			<div>{translate key=DeleteUserWarning}</div>
		</div>
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>
			{*<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
		</div>
	</form>
</div>

<div id="groupsDialog" class="dialog" style="background-color:#FFCC99;" title="{translate key=Groups}">
	<div id="allUsers" style="display:none;" class="dialog" title="{translate key=AllUsers}"></div>

	<div id="groupList" class="hidden">
		{foreach from=$Groups item=group}
			<div class="group-item" groupId="{$group->Id}"><a href="#">&nbsp;</a> <span>{$group->Name}</span></div>
		{/foreach}
	</div>

	<div id="addedGroups">
	</div>

	<div id="removedGroups">
	</div>

	<form id="addGroupForm" method="post" ajaxAction="addUser">
		<input type="hidden" id="addGroupId" {formname key=GROUP_ID} />
		<input type="hidden" id="addGroupUserId" {formname key=USER_ID} />
	</form>

	<form id="removeGroupForm" method="post" ajaxAction="removeUser">
		<input type="hidden" id="removeGroupId" {formname key=GROUP_ID} />
		<input type="hidden" id="removeGroupUserId" {formname key=USER_ID} />
	</form>
</div>

<div id="colorDialog" class="dialog" title="{translate key=Color}">
	<form id="colorForm" method="post" ajaxAction="{ManageUsersActions::ChangeColor}">
		#{textbox name="RESERVATION_COLOR" class="textbox" id="reservationColor" maxlength=6}
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
			<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		</div>
	</form>
</div>

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator" style="display:none;"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="autocomplete.js"}
{jsfile src="admin/user.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="js/colorpicker.js"}
{*{jsfile src="admin/help.js"}*}

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

		$('#reservationColor').ColorPicker({
			onSubmit: function (hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
		
		sorting();

	});
</script>
{include file='globalfooter.tpl'}
