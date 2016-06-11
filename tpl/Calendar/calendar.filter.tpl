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

{*Imports*}
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
{jsfile src="multiselect/jquery.multiselect.js"}
{jsfile src="multiselect/prettify.js"}
{jsfile src="multiselect/jquery.multiselect.filter.js"}

<table id="CalendarFilterTable">
	<tr>
		<td>
			<div id="filter">
				{if $GroupName}
					<span class="groupName">{$GroupName}</span>
				{else}
					<label for="calendarFilter"></label>
					<select id="calendarFilter"  multiple="multiple">
						{foreach from=$filters->GetFilters() item=filter}
							{foreach from=$filter->GetFilters() item=subfilter}
								<option value="{$subfilter->Id()}" class="resource" >{$subfilter->Name()}</option>
							{/foreach}
						{/foreach}
					</select>
				{/if}
			</div>
		</td>
		<td>
			{if $UserId neq "1"}
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" {if ($myCal != 1)}checked="checked"{/if}>
					<label class="onoffswitch-label" for="myonoffswitch">
						<span class="onoffswitch-inner" ></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			{else}
				<div class="onoffswitch" style="display:none;">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" {if ($myCal != 1)}checked="checked"{/if}>
					<label class="onoffswitch-label" for="myonoffswitch">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			{/if}
			<div id="resourceGroupsContainer">
				<div id="resourceGroups"></div>
			</div>
		</td>
	</tr>
</table>   