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

{include file='globalheader.tpl' cssFiles='css/admin.css,scripts/css/colorbox.css'}

<h1>{translate key='ManageResources'}</h1>

<div id="addDialog" class="dialog" title="{translate key=AddResource}">
	<div id="addResourceResults" class="error"></div>
	<form id="addResourceForm" method="post" ajaxAction="{ManageResourcesActions::ActionAdd}">
		<table class="hiddenDiv">
			<tr>
				<th>{translate key='Name'}</th>
				<th>{translate key='Schedule'}</th>
				<th>{translate key='ResourcePermissions'}</th>
				<th>{translate key='ResourceAdministrator'}</th>
				<th>&nbsp;</th>
			</tr>

			<input type="text" placeholder="{translate key=Name}" class="textbox required" maxlength="85" style="width:242px" {formname key=RESOURCE_NAME} />
			</br></br>
				
			<div class="hiddenDiv">
				<select class="textbox" {formname key=SCHEDULE_ID} style="width:100px">
					{foreach from=$Schedules item=scheduleName key=scheduleId}
						<option value="{$scheduleId}">{$scheduleName}</option>
					{/foreach}
				</select>
			</div>
			<div>
				<select class="textbox" {formname key=AUTO_ASSIGN} style="width:250px;text-align-last:center">
					<option value="0">{translate key="PermissionsNone"}</option>
					<option value="1">{translate key="PermissionsAll"}</option>
				</select>
			</div>
				
			<div class="hiddenDiv">
				{translate key='ResourceAdministrator'}<br/>
				<select class="textbox" {formname key=RESOURCE_ADMIN_GROUP_ID} style="width:170px">
					<option value="">N/A</option>
					{foreach from=$AdminGroups item=adminGroup}
						<option value="{$adminGroup->Id}">{$adminGroup->Name}</option>
					{/foreach}
				</select>
			</div>				
		</table>
		</br>
		<button type="button" class="button save">{html_image src="plus-button.png"} {translate key='AddResource'}</button>
	</form>
</div>

<div id="globalError" class="error"></div>

<table id="resourceTable" class="list">
	<thead>
		<th>{translate key='Name'}</th>
		{*<th>{translate key='Description'}</th>*}
		<th>{translate key='Location'}</th>
		<th>{translate key='RequiresApproval'}</th>
		<th>{translate key='WhoApproves'}</th>
		<td class="action">{translate key='UsageConfiguration'}</th>
		<td class="action">{translate key='Permissions'}</th>
		<td class="action">{translate key='Status'}</th>
		<td class="action">{translate key='Delete'}</th>
	</thead>
	<tbody>
		{foreach from=$Resources item=resource}
		{cycle values='row0,row1' assign=rowCss}
			<tr>
				<td>
				{assign var=id value=$resource->GetResourceId()}
					<div class="resourceDetails" resourceId="{$id}">
						<input type="hidden" class="id" value="{$id}"/>
						<a class="update renameButton" href="javascript:void(0);">{$resource->GetName()|truncate:30:"...":true}</a>
					</div>
				</td>
				{*<td>
					<div class="resourceDetails" resourceId="{$id}">
						<input type="hidden" class="id" value="{$id}"/>
						{if $resource->HasDescription()}
							<a class="update descriptionButton" href="javascript: void(0);">{$resource->GetDescription()|truncate:30:"...":true}</a>
						{else}
							<a class="update descriptionButton" href="javascript: void(0);">{html_image src='my_edit.png'}</a>
						{/if}					
					</div>
				</td>*}
				<td>
					<div class="resourceDetails" resourceId="{$id}">
					<input type="hidden" class="id" value="{$id}"/>
					{if $resource->HasLocation()}
						<a class="update changeLocationButton" href="javascript: void(0);">{$resource->GetLocation()|truncate:30:"...":true}</a>
					{else}
						<a class="update changeLocationButton" href="javascript: void(0);">{html_image src='my_edit.png'}</a>
					{/if}
					</div>
				</td>
				
				<td width="140px">
					<div class="resourceDetails" resourceId="{$id}">	
						<input type="hidden" class="id" value="{$id}"/>	
						{if $resource->GetRequiresApproval()}
							<a class="update approve" href="javascript: void(0);">{translate key='Yes'}</a>
						{else}
							<a class="update approve" href="javascript: void(0);">{translate key='No'}</a>
						{/if}
					</div>
				</td>
				
				<td>
					<div class="resourceDetails" resourceId="{$id}">
						<input type="hidden" class="id" value="{$id}"/>
						{if $resource->GetRequiresApproval()}
							{if $resource->HasAdminGroup()}
								{if $GroupLookup[$resource->GetAdminGroupId()] neq ''}
									<a class="update adminButton" href="javascript: void(0);">{$GroupLookup[$resource->GetAdminGroupId()]->Name}</a>
								{else}
									<a class="update adminButton" href="javascript: void(0);">{html_image src='my_edit.png'}</a>
								{/if}
							{else}
								{if $AdminGroups|count > 0}
									<a class="update adminButton" href="javascript: void(0);">{html_image src='my_edit.png'}</a>
								{else}
									{translate key='Superuser'}
								{/if}
							{/if}
						{else}
							N/A
						{/if}
					</div>
				</td>
				<td width="130px">
					<div class="resourceDetails" resourceId="{$id}">	
						<input type="hidden" class="id" value="{$id}"/>	
						<a class="update changeConfigurationButton" href="javascript: void(0);">{html_image src='my_edit.png'}</a>
					</div>
				</td>															 
				<td width="50px">
					<div class="resourceDetails" resourceId="{$id}">
						<input type="hidden" class="id" value="{$id}"/>		
						<a href="#" class="update changeUsers">{html_image src='user-small.png'}</a> | <a href="#" class="update changeGroups">{html_image src='users.png'}</a>
					</div>				
				</td>

				<td width="50px">
					<div class="resourceDetails" resourceId="{$id}">
						<input type="hidden" class="id" value="{$id}"/>
						{if $resource->IsAvailable()}
							<a class="update changeStatus" href="javascript: void(0);">{html_image src='status.png'}</a>
						{elseif $resource->IsUnavailable()}
							<a class="update changeStatus" href="javascript: void(0);">{html_image src='status-busy.png'}</a>
						{else}
							<a class="update changeStatus" href="javascript: void(0);">{html_image src='status-offline.png'}</a>
						{/if}
					</div>
				</td>
				
				<td width="50px">
					<div class="resourceDetails" resourceId="{$id}" >
						<a class="update deleteButton" href="javascript:void(0);">{html_image src="cross-button.png"}</a>
						<input type="hidden" class="id" value="{$id}"/>	
					</div>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>


<div class="pagination">
	{pagination pageInfo=$PageInfo}
</div>

<form id="filterForm">			
	<ul id="filterDiv" style="list-style-type: none;">
		<li class="leftFloater">
			<input type="text" placeholder="{translate key=Name}" id="filterResourceName" class="textbox" {formname key=RESOURCE_NAME} value="{$ResourceNameFilter}"/ />
		</li>
	</ul>		
	<button style="height:22px;padding: 0 10px 0 7px;float:left" id="filter" class="button">{translate key=Filter}</button>	
	<button style="height:22px;padding: 0 10px 0 7px;float:left" id="clearFilter" class="button">{translate key=Reset}</button>
</form>

<button id="addButton" type="button" class="button save">{html_image src="plus-button.png"} {translate key='AddResource'}</button>
<input type="hidden" id="activeId" value="" />

<div id="renameDialog" class="dialog" title="{translate key=Rename}">
	<form id="renameForm" method="post" ajaxAction="{ManageResourcesActions::ActionRename}">
		<input id="editName" placeholder="{translate key='Name'}" type="text" class="textbox required" maxlength="85" style="width:250px" {formname key=RESOURCE_NAME} />
		<div class="admin-update-buttons">
			</br>
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Rename'}</button>
		</div>
	</form>
</div>

<div id="locationDialog" class="dialog" title="{translate key=Location}">
	<form id="locationForm" method="post" ajaxAction="{ManageResourcesActions::ActionChangeLocation}">
		<input placeholder="{translate key=Location}" id="editLocation" type="text" class="textbox" maxlength="85" style="width:250px" {formname key=RESOURCE_LOCATION} /><br/>
		</br>
		</br>
		<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
	</form>
</div>

<div id="descriptionDialog" class="dialog" title="{translate key=Description}">
	<form id="descriptionForm" method="post" ajaxAction="{ManageResourcesActions::ActionChangeDescription}">
		<textarea id="editDescription" class="textbox" {formname key=RESOURCE_DESCRIPTION}></textarea>
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
		</div>
	</form>
</div>

<div id="configurationDialog" class="dialog" title="{translate key=UsageConfiguration}">
	<form id="configurationForm" method="post" ajaxAction="{ManageResourcesActions::ActionChangeConfiguration}">
		<div>
			<ul>
				<li>
					<label>
						<input type="checkbox" id="noMinimumDuration"/> {translate key=ResourceMinLengthNone}
					</label>
					<span class="noMinimumDuration">
						<br/>
						{capture name="txtMinDuration" assign="txtMinDuration"}
							<input type='text' id='minDurationDays' size='3' class='days textbox' maxlength='3'/>
							<input type='text' id='minDurationHours' size='2' class='hours textbox' maxlength='2'/>
							<input type='text' id='minDurationMinutes' size='2' class='minutes textbox' maxlength='2'/>
							<input type='hidden' id='minDuration' class='interval' {formname key=MIN_DURATION} />
						{/capture}
						{translate key='ResourceMinLength' args=$txtMinDuration}
					</span>
				</li>
				<li>
					<label>
						<input type="checkbox" id="noMaximumDuration"/> {translate key=ResourceMaxLengthNone}
					</label>
					<span class="noMaximumDuration">
						<br/>
						{capture name="txtMaxDuration" assign="txtMaxDuration"}
							<input type='text' id='maxDurationDays' size='3' class='days textbox' maxlength='3'/>
							<input type='text' id='maxDurationHours' size='2' class='hours textbox' maxlength='2'/>
							<input type='text' id='maxDurationMinutes' size='2' class='minutes textbox' maxlength='2'/>
							<input type='hidden' id='maxDuration' class='interval' {formname key=MAX_DURATION} />
						{/capture}
						{translate key=ResourceMaxLength args=$txtMaxDuration}
					</span>
				</li>
				<li>
					<label>
						<input type="checkbox" id="noBufferTime"/> {translate key=ResourceBufferTimeNone}
					</label>
					<span class="noBufferTime">
						<br/>
						{capture name="txtBufferTime" assign="txtBufferTime"}
							<input type='text' id='bufferTimeDays' size='3' class='days textbox' maxlength='3'/>
							<input type='text' id='bufferTimeHours' size='2' class='hours textbox' maxlength='2'/>
							<input type='text' id='bufferTimeMinutes' size='2' class='minutes textbox' maxlength='2'/>
							<input type='hidden' id='bufferTime' class='interval' {formname key=BUFFER_TIME} />
						{/capture}
						{translate key=ResourceBufferTime args=$txtBufferTime}
					</span>
				</li>
			</ul>
			<ul>
				<li>
					<label>
						<input type="checkbox" id="noStartNotice" /> {translate key='ResourceMinNoticeNone'}
					</label>
					<span class="noStartNotice">
						<br/>
						{capture name="txtStartNotice" assign="txtStartNotice"}
							<input type='text' id='startNoticeDays' size='3' class='days textbox' maxlength='3'/>
							<input type='text' id='startNoticeHours' size='2' class='hours textbox' maxlength='2'/>
							<input type='text' id='startNoticeMinutes' size='2' class='minutes textbox' maxlength='2'/>
							<input type='hidden' id='startNotice' class='interval' {formname key=MIN_NOTICE} />
						{/capture}
						{translate key='ResourceMinNotice' args=$txtStartNotice}
					</span>
				</li>
				<li>
					<label>
						<input type="checkbox" id="noEndNotice"/> {translate key='ResourceMaxNoticeNone'}
					</label>
					<span class="noEndNotice">
						<br/>
						{capture name="txtEndNotice" assign="txtEndNotice"}
							<input type='text' id='endNoticeDays' size='3' class='days textbox' maxlength='3'/>
							<input type='text' id='endNoticeHours' size='2' class='hours textbox' maxlength='2'/>
							<input type='text' id='endNoticeMinutes' size='2' class='minutes textbox' maxlength='2'/>
							<input type='hidden' id='endNotice' class='interval' {formname key=MAX_NOTICE} />
						{/capture}
						{translate key='ResourceMaxNotice' args=$txtEndNotice}
					</span>
				</li>
			</ul>			
		</div>
		</br>
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
		</div>
	</form>
</div>

<div id="approveDialog" class="dialog" title="{translate key=UsageConfiguration}">
	<form id="approveForm" method="post" ajaxAction="{ManageResourcesActions::ActionChangeConfiguration}">
		{translate key='ResourceRequiresApproval'}
		<select id="requiresApproval2" class="textbox" {formname key=REQUIRES_APPROVAL}>
			<option value="1">{translate key='Yes'}</option>
			<option value="0">{translate key='No'}</option>
		</select>		
	</form>
</div>

<div id="groupAdminDialog" class="dialog" title="{translate key=WhoApproves}">
	<form method="post" class="hiddenForm" id="groupAdminForm" ajaxAction="{ManageResourcesActions::ActionChangeAdmin}">
		<select id="adminGroupId" {formname key=RESOURCE_ADMIN_GROUP_ID} class="textbox">
			<option value="">-- {translate key=None} --</option>
			{foreach from=$AdminGroups item=adminGroup}
				<option value="{$adminGroup->Id}">{$adminGroup->Name}</option>
			{/foreach}
		</select>

		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="tick-circle.png"} {translate key='Update'}</button>
		</div>
	</form>
	<div id="roleList" class="hidden">
		{foreach from=$AdminGroups item=adminGroup}
			<div class="role-item" roleId="{$adminGroup->Id}"><a href="#">&nbsp;</a> <span>{$adminGroup->Name}</span></div>
		{/foreach}
	</div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedRoles"></div>
	<div id="removedRoles"></div>
</div>

<div id="deleteDialog" class="dialog" title="{translate key=Delete}">
	<form id="deleteForm" method="post" ajaxAction="{ManageResourcesActions::ActionDelete}">
		<div class="error" id="marginError">
			<h3>{translate key=DeleteWarning}</h3>
			<br/>{translate key=DeleteResourceWarning}:
			<ul>
				<li>{translate key=DeleteResourceWarningReservations}</li>
				<li>{translate key=DeleteResourceWarningPermissions}</li>
			</ul>
			<br/>
			{translate key=DeleteResourceWarningReassign}
		</div>

		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		</div>
	</form>
</div>

<div id="statusDialog" class="dialog" title="{translate key=Status}">
	<form id="statusForm" class="hiddenForm" method="post" ajaxAction="{ManageResourcesActions::ActionChangeStatus}">
		<select id="statusId" {formname key=RESOURCE_STATUS_ID} class="textbox">
			<option value="{ResourceStatus::AVAILABLE}">{translate key=Available}</option>
			<option value="{ResourceStatus::UNAVAILABLE}">{translate key=Unavailable}</option>
			<option value="{ResourceStatus::HIDDEN}">{translate key=Hidden}</option>
		</select>
		<br/>
		<br/>
		<div class="admin-update-buttons">
			<button type="button" class="button save">{html_image src="disk-black.png"} {translate key='Update'}</button>
			<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>
		</div>
	</form>
	<div id="statusList" class="hidden">
		<div class="status-item" statusId="{ResourceStatus::AVAILABLE}"><a href="#">&nbsp;</a> <span>{translate key=Available}</span></div>
		<div class="status-item" statusId="{ResourceStatus::UNAVAILABLE}"><a href="#">&nbsp;</a> <span>{translate key=Unavailable}</span></div>
		<div class="status-item" statusId="{ResourceStatus::HIDDEN}"><a href="#">&nbsp;</a> <span>{translate key=Hidden}</span></div>
	</div>

	<div id="addedStatus"></div>
	<div id="removedStatus"></div>
</div>

<div id="userDialog" class="dialog" title="{translate key=User}">
	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedMembers"></div>
	<div id="removedMembers"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>
</div>

<form id="removeUserForm" method="post" ajaxAction="{ManageResourcesActions::ActionRemoveUserPermission}">
	<input type="hidden" id="removeUserId" {formname key=USER_ID} />
</form>

<form id="addUserForm" method="post" ajaxAction="{ManageResourcesActions::ActionAddUserPermission}">
	<input type="hidden" id="addUserId" {formname key=USER_ID} />
</form>

<div id="groupDialog" class="dialog" title="{translate key=Groups}">
	<div class="hiddenDiv" style="text-align:center;">{translate key=NoneSelected}</div>
	<div id="addedGroups"></div>
	<div id="removedGroups"></div>
	<div class="hiddenDiv" style="text-align:center;">{translate key=AllSelected}</div>
</div>

<form id="removeGroupForm" method="post" ajaxAction="{ManageResourcesActions::ActionRemoveGroupPermission}">
	<input type="hidden" id="removeGroupId" {formname key=GROUP_ID} />
</form>

<form id="addGroupForm" method="post" ajaxAction="{ManageResourcesActions::ActionAddGroupPermission}">
	<input type="hidden" id="addGroupId" {formname key=GROUP_ID} />
</form>

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="js/jquery.watermark.min.js"}
{jsfile src="js/jquery.colorbox-min.js"}
{jsfile src="admin/edit.js"}
{jsfile src="admin/resource.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{jsfile src="admin/help.js"}
{jsfile src="autocomplete.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}

{*Code*}
<script type="text/javascript">

	$(document).ready(function ()
	{	
		var actions = {
			enableSubscription: '{ManageResourcesActions::ActionEnableSubscription}',
			disableSubscription: '{ManageResourcesActions::ActionDisableSubscription}',
			removeImage: '{ManageResourcesActions::ActionRemoveImage}'
		};

		var opts = {
			submitUrl: '{$smarty.server.SCRIPT_NAME}',
			saveRedirect: '{$smarty.server.SCRIPT_NAME}',
			actions: actions,
			userAutocompleteUrl: "../ajax/autocomplete.php?type={AutoCompleteType::User}",
			groupAutocompleteUrl: "../ajax/autocomplete.php?type={AutoCompleteType::Group}",
			permissionsUrl: '{$smarty.server.SCRIPT_NAME}'
		};

		var resourceManagement = new ResourceManagement(opts);
		resourceManagement.init();

		{foreach from=$Resources item=resource}
		var resource = {
			id: '{$resource->GetResourceId()}',
			name: "{$resource->GetName()|escape:'javascript'}",
			location: "{$resource->GetLocation()|escape:'javascript'}",
			contact: "{$resource->GetContact()|escape:'javascript'}",
			description: "{$resource->GetDescription()|escape:'javascript'}",
			notes: "{$resource->GetNotes()|escape:'javascript'}",
			autoAssign: '{$resource->GetAutoAssign()}',
			requiresApproval: '{$resource->GetRequiresApproval()}',
			allowMultiday: '{$resource->GetAllowMultiday()}',
			maxParticipants: '{$resource->GetMaxParticipants()}',
			scheduleId: '{$resource->GetScheduleId()}',
			minLength: {},
			maxLength: {},
			startNotice: {},
			endNotice: {},
			bufferTime: {},
			adminGroupId: '{$resource->GetAdminGroupId()}',
			sortOrder: '{$resource->GetSortOrder()}',
			resourceTypeId: '{$resource->GetResourceTypeId()}',
			statusId: '{$resource->GetStatusId()}',
			reasonId: '{$resource->GetStatusReasonId()}'
		};

		{if $resource->HasMinLength()}
		resource.minLength = {
			value: '{$resource->GetMinLength()}',
			days: '{$resource->GetMinLength()->Days()}',
			hours: '{$resource->GetMinLength()->Hours()}',
			minutes: '{$resource->GetMinLength()->Minutes()}'
		};
		{/if}

		{if $resource->HasMaxLength()}
		resource.maxLength = {
			value: '{$resource->GetMaxLength()}',
			days: '{$resource->GetMaxLength()->Days()}',
			hours: '{$resource->GetMaxLength()->Hours()}',
			minutes: '{$resource->GetMaxLength()->Minutes()}'
		};
		{/if}

		{if $resource->HasMinNotice()}
		resource.startNotice = {
			value: '{$resource->GetMinNotice()}',
			days: '{$resource->GetMinNotice()->Days()}',
			hours: '{$resource->GetMinNotice()->Hours()}',
			minutes: '{$resource->GetMinNotice()->Minutes()}'
		};
		{/if}

		{if $resource->HasMaxNotice()}
		resource.endNotice = {
			value: '{$resource->GetMaxNotice()}',
			days: '{$resource->GetMaxNotice()->Days()}',
			hours: '{$resource->GetMaxNotice()->Hours()}',
			minutes: '{$resource->GetMaxNotice()->Minutes()}'
		};
		{/if}

		{if $resource->HasBufferTime()}
		resource.bufferTime = {
			value: '{$resource->GetBufferTime()}',
			days: '{$resource->GetBufferTime()->Days()}',
			hours: '{$resource->GetBufferTime()->Hours()}',
			minutes: '{$resource->GetBufferTime()->Minutes()}'
		};
		{/if}

		resourceManagement.add(resource);
		{/foreach}

		{foreach from=$StatusReasons item=reason}
		resourceManagement.addStatusReason('{$reason->Id()}', '{$reason->StatusId()}', '{$reason->Description()|escape:javascript}');
		{/foreach}

		resourceManagement.initializeStatusFilter('{$ResourceStatusFilterId}', '{$ResourceStatusReasonFilterId}');
		
		$('#resourceTable').tablesorter({
			widgets: ["zebra"],
			widgetOptions : {
			zebra : [ "normal-row", "alt-row" ]}
		});
	});

</script>

{include file='globalfooter.tpl'}