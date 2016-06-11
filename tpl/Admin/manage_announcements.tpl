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

<h1>{translate key=ManageAnnouncements}{* {html_image src="question-button.png" id="help-prompt" ref="help-announcements"}*}</h1>
{*
<div class="admin" style="margin-top:30px;background-color:#E0E0E0;">
	<div class="title" style="background-color:#e6EEEE;">
		<a href="#" id="myLabel">{translate key=AddAnnouncement}</a>
	</div>
	<div>
		<div id="addResults" class="error" style="display:none;"></div>
		<div>
		<form id="addForm" method="post">
			<table id="announcementsTable" style="display:none;">
				<tr>
					<th>{translate key='Announcement'}</th>
					<th>{translate key='BeginDate'}</th>
					<th>{translate key='EndDate'}</th>
					<th>{translate key='Priority'}</th>
					<th>&nbsp;</th>
				</tr>
				<tr>
					<td>
						<textarea class="textbox required" style="width:500px;resize: none;" {formname key=ANNOUNCEMENT_TEXT}></textarea>
					</td>
					<td>
						<input type="text" id="BeginDate" class="textbox" {formname key=ANNOUNCEMENT_START} />
						<input type="hidden" id="formattedBeginDate" {formname key=ANNOUNCEMENT_START} />
					</td>
                    <td>
						<input type="text" id="EndDate" class="textbox" {formname key=ANNOUNCEMENT_END} />
						<input type="hidden" id="formattedEndDate" {formname key=ANNOUNCEMENT_END} />
					</td>
                    <td>
                        <select class="textbox" {formname key=ANNOUNCEMENT_PRIORITY}>
                            <option value="">---</option>
                            {html_options values=$priorities output=$priorities}
                        </select>
					</td>
					<td>
						<button type="button" class="button save">{html_image src="plus-button.png"} {translate key=AddAnnouncement}</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div>
</div>
*}
<table id="announceTable" class="list" id="announcements" style="width: 50%;margin: 0 auto;">
	<thead>
	<tr>
		<th class="id">&nbsp;</th>
		<th>{translate key='Announcement'}</th>
		<th>{translate key='Priority'}</th>
		<th>{translate key='BeginDate'}</th>
		<th>{translate key='EndDate'}</th>
		<td class="action">Editar</th>
		<td class="action">Borrar</th>
	</tr>
	</thead>
	<tbody>
{foreach from=$announcements item=announcement}
	{cycle values='row0,row1' assign=rowCss}
	<tr class="{$rowCss}">
		<td class="id"><input type="hidden" class="id" value="{$announcement->Id()}"/></td>
		<td style="width:300px;">{$announcement->Text()|nl2br}</td>
		<td align="center"style="width: 100px;">{$announcement->Priority()}</td>
		<td align="center" style="width: 100px;">{formatdate date=$announcement->Start()}</td>
		<td align="center" style="width: 100px;">{formatdate date=$announcement->End()}</td>
		{*<td align="center" style="width: 100px;">{formatdate date=$announcement->Start()->ToTimezone($timezone)}</td>
		<td align="center" style="width: 100px;">{formatdate date=$announcement->End()->ToTimezone($timezone)}</td>*}
		<td align="center" style="width: 100px;"><a href="#" class="update edit">{html_image src='my_edit.png'}</a> </td>
		<td align="center" style="width: 100px;"> <a href="#" class="update delete">{html_image src='cross-button.png'}</a></td>
	</tr>
	</tbody>
{/foreach}
</table>

<input type="hidden" id="activeId" />

<div id="deleteDialog" class="dialog" style="display:none;background-color:#FFCC99" title="{translate key=Delete}">
	<form id="deleteForm" method="post">
		<div class="error" style="margin-bottom: 15px;">
			<h3>{translate key=DeleteWarning}</h3>
		</div>
		<button type="button" class="button delete" style="float:right;">{html_image src="cross-button.png"} {translate key='Delete'}</button>
		{*<button type="button" class="button cancel">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
	</form>
</div>

<div id="editDialog" class="dialog" style="display:none;background-color:#FFCC99" title="{translate key=Edit}">
	<div class="warning">{translate key=FieldWarning}</div>
	<form id="editForm" method="post">
		{*{translate key=Announcement}<br/>*}
        <textarea rows="4" id="editText" class="textbox required" placeholder="{translate key=Announcement}" style="width:500px;resize: none;" {formname key=ANNOUNCEMENT_TEXT}></textarea><br/>
		<br/>
		<div align="center">
        {*{translate key='BeginDate'}*}
        <input  style="text-align:center;width:100px;" type="text" id="editBegin" class="textbox" />
        <input type="hidden" id="formattedEditBegin" {formname key=ANNOUNCEMENT_START} />
		-
        {*{translate key='EndDate'}<br/>*}
        <input style="text-align:center;width:100px;" type="text" id="editEnd" class="textbox" />
        <input type="hidden" id="formattedEditEnd" {formname key=ANNOUNCEMENT_END} />
		<br/><br/>
        {translate key='Priority'} <br/>
        <select id="editPriority" class="textbox" {formname key=ANNOUNCEMENT_PRIORITY}>
            <option value="">---</option>
            {html_options values=$priorities output=$priorities}
        </select><br/>
				</div>
		<button type="button" class="button edit" style="float:right;">{html_image src="disk-black.png"} {translate key='Update'}</button>
		{*<button type="button" class="button cancel" style="float:right;">{html_image src="slash.png"} {translate key='Cancel'}</button>*}
	</form>
</div>

<div style="text-align:center;">
{pagination pageInfo=$PageInfo}
</div>

<div id="newDialog" class="dialog" style="display:none;background-color:#FFCC99" title="{translate key=AddAnnouncement}">
	<div class="warning">{translate key=FieldWarning}</div>
	<form id="addForm" method="post">
		{*{translate key=Announcement}<br/>*}
        <textarea rows="4" class="textbox required" placeholder="{translate key=Announcement}" style="width:500px;resize: none;" {formname key=ANNOUNCEMENT_TEXT}></textarea><br/>
		<br/>
		<div align="center">
        <input  style="text-align: center;width:100px;" type="text" placeholder="{translate key=BeginDate}" id="BeginDate" class="textbox" {formname key=ANNOUNCEMENT_START} />
		<input type="hidden" id="formattedBeginDate" {formname key=ANNOUNCEMENT_START} />
		-
        <input  style="text-align: center;width:100px;" type="text" placeholder="{translate key=EndDate}" id="EndDate" class="textbox" {formname key=ANNOUNCEMENT_END} />
		<input type="hidden" id="formattedEndDate" {formname key=ANNOUNCEMENT_END} />
		<br/><br/>
        {translate key='Priority'} <br/>
		<select class="textbox" {formname key=ANNOUNCEMENT_PRIORITY}>
                 <option value="">---</option>
                            {html_options values=$priorities output=$priorities}
                        </select>
		</div>
		<button type="button" class="button save" style="float:right;">{html_image src="plus-button.png"} {translate key=AddAnnouncement}</button>
	</form>
</div>

<button id="newButton" class="button save" style="float:right;" type="button">{html_image src="plus-button.png"} {translate key=AddAnnouncement}</button>

{control type="DatePickerSetupControl" ControlId="BeginDate" AltId="formattedBeginDate"}
{control type="DatePickerSetupControl" ControlId="EndDate" AltId="formattedEndDate"}
{control type="DatePickerSetupControl" ControlId="editBegin" AltId="formattedEditBegin"}
{control type="DatePickerSetupControl" ControlId="editEnd" AltId="formattedEditEnd"}

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator" style="display:none;"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="admin/announcement.js"}
{jsfile src="js/jquery.form-3.09.min.js"}
{*{jsfile src="admin/help.js"}*}

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
		'{formatdate date=$announcement->Start()}',
        '{formatdate date=$announcement->End()}',
        {*'{formatdate date=$announcement->Start()->ToTimezone($timezone)}',
        '{formatdate date=$announcement->End()->ToTimezone($timezone)}',*}
        '{$announcement->Priority()}'
    );
	{/foreach}	
	});
</script>
{include file='globalfooter.tpl'}
