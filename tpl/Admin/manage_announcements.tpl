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

<h1>{translate key=ManageAnnouncements}</h1>

<table id="announceTable" class="list">
<thead>
	<th class="id">&nbsp;</th>
	<th>{translate key='Announcement'}</th>
	<th>{translate key='Priority'}</th>
	<th>{translate key='BeginDate'}</th>
	<th>{translate key='EndDate'}</th>
	<td class="action">{translate key='Edit'}</th>
	<td class="action">{translate key='Delete'}</th>
</thead>
<tbody>
	{foreach from=$announcements item=announcement}
		<tr>
			<td class="id"><input type="hidden" class="id" value="{$announcement->Id()}"/></td>
			<td class="announceTableLongCell">{$announcement->Text()|nl2br}</td>
			<td align="center" class="announceTableCell">{$announcement->Priority()}</td>
			<td align="center" class="announceTableCell">{formatdate date=$announcement->Start()->ToTimezone($timezone)}</td>
			<td align="center" class="announceTableCell">{formatdate date=$announcement->End()->ToTimezone($timezone)}</td>		
			<td align="center" class="announceTableCell"><a href="#" class="update edit">{html_image src='my_edit.png'}</a></td>
			<td align="center" class="announceTableCell"><a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
		</tr>
	{/foreach}
</tbody>
</table>

<input type="hidden" id="activeId" />
<div id="deleteDialog" class="dialog" title="{translate key=Delete}">
	<form id="deleteForm" method="post">
		<div class="error" id="marginError">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button delete">{html_image src="slash.png"} {translate key='Delete'}</button>
	</form>
</div>

<div id="editDialog" class="dialog" title="{translate key=Edit}">
	<div class="warning">{translate key=FieldWarning}</div>
	<form id="editForm" method="post">
        <textarea rows="4" id="editText" class="textbox required" placeholder="{translate key=Announcement}" style="width:500px;resize: none;" {formname key=ANNOUNCEMENT_TEXT}></textarea><br/>
		<br/>
		<div align="center">
			<input  style="text-align:center;width:100px;" type="text" id="editBegin" class="textbox" />
			<input type="hidden" id="formattedEditBegin" {formname key=ANNOUNCEMENT_START} />
			-
			<input style="text-align:center;width:100px;" type="text" id="editEnd" class="textbox" />
			<input type="hidden" id="formattedEditEnd" {formname key=ANNOUNCEMENT_END} />
			<br/><br/>
			{translate key='Priority'} <br/>
			<select id="editPriority" class="textbox" {formname key=ANNOUNCEMENT_PRIORITY}>
				<option value="">---</option>
				{html_options values=$priorities output=$priorities}
			</select>
			<br/>
		</div>
		<button type="button" class="button edit">{html_image src="disk-black.png"} {translate key='Update'}</button>
	</form>
</div>

<div class="pagination">
	{pagination pageInfo=$PageInfo}
</div>

<div id="newDialog" class="dialog" title="{translate key=AddAnnouncement}">
	<div class="warning">{translate key=FieldWarning}</div>
	<form id="addForm" method="post">
        <textarea rows="4" class="textbox required" placeholder="{translate key=Announcement}" style="width:500px;resize: none;" {formname key=ANNOUNCEMENT_TEXT}></textarea><br/>
		<br/>
		<div align="center">
        <input style="text-align: center;width:100px;" type="text" placeholder="{translate key=BeginDate}" id="BeginDate" class="textbox" {formname key=ANNOUNCEMENT_START} />
		<input type="hidden" id="formattedBeginDate" {formname key=ANNOUNCEMENT_START} />
		-
        <input style="text-align: center;width:100px;" type="text" placeholder="{translate key=EndDate}" id="EndDate" class="textbox" {formname key=ANNOUNCEMENT_END} />
		<input type="hidden" id="formattedEndDate" {formname key=ANNOUNCEMENT_END} />
		<br/><br/>
        {translate key='Priority'} <br/>
		<select id="createPriority" class="textbox" {formname key=ANNOUNCEMENT_PRIORITY}>
                <option value="">---</option>
                {html_options values=$priorities output=$priorities}
        </select>
		</div>
		<button type="button" class="button save">{html_image src="plus-button.png"} {translate key=AddAnnouncement}</button>
	</form>
</div>

<button id="newButton" class="button save" type="button">{html_image src="plus-button.png"} {translate key=AddAnnouncement}</button>

{control type="DatePickerSetupControl" ControlId="BeginDate" AltId="formattedBeginDate"}
{control type="DatePickerSetupControl" ControlId="EndDate" AltId="formattedEndDate"}
{control type="DatePickerSetupControl" ControlId="editBegin" AltId="formattedEditBegin"}
{control type="DatePickerSetupControl" ControlId="editEnd" AltId="formattedEditEnd"}

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="admin/announcement.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{*Enhance*}
{jsfile src="TableSorter/jquery.tablesorter.js"}

{*Code*}
<script type="text/javascript">
	$(document).ready(function() {

	$("#announceTable").tablesorter({
		widgets: ["zebra"],
		widgetOptions : {
			zebra : [ "normal-row", "alt-row" ]
		}
	});
	
	var actions = {
		add: '{ManageAnnouncementsActions::Add}',
		edit: '{ManageAnnouncementsActions::Change}',
		deleteAnnouncement: '{ManageAnnouncementsActions::Delete}'
	};

	var accessoryOptions = {
		submitUrl: '{$smarty.server.SCRIPT_NAME}',
		saveRedirect: '{$smarty.server.SCRIPT_NAME}',
		actions: actions
	};

	var announcementManagement = new AnnouncementManagement(accessoryOptions);
    announcementManagement.init();

	{foreach from=$announcements item=announcement}
    announcementManagement.addAnnouncement(
        '{$announcement->Id()}',
        '{$announcement->Text()|escape:"quotes"|regex_replace:"/[\n]/":"\\n"}',
		'{formatdate date=$announcement->Start()->ToTimezone($timezone)}',
        '{formatdate date=$announcement->End()->ToTimezone($timezone)}',
        '{$announcement->Priority()}'
    );
	{/foreach}
	
	});
</script>

{include file='globalfooter.tpl'}
