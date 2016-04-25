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

<link rel="stylesheet" type="text/css" href="scripts/prueba3/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="scripts/prueba3/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="scripts/prueba3/demos/assets/style.css" />
<link rel="stylesheet" type="text/css" href="scripts/prueba3/demos/assets/prettify.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
{*{jsfile src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"}*}
{*{jsfile src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"}*}
{jsfile src="prueba3/src/jquery.multiselect.js"}
{jsfile src="scripts/prueba3/demos/assets/prettify.js"}
{jsfile src="prueba3/src/jquery.multiselect.filter.js"}

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
	{/if}
</select>
</div>

</td>
<td>
{if ($myCal != 1)}
<div id="filter2">
<label for="calendarFilter"></label>
<select id="calendarFilter2"  multiple="multiple">
{foreach from=$filters->GetFilters() item=filter}
	{foreach from=$filter->GetFilters() item=subfilter}
		<option value="{$subfilter->Id()}" class="resource" >{$subfilter->Name()}</option>
	{/foreach}
{/foreach}
</select>
</div>
{/if}
</td>
<td>

<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" {if ($myCal != 1)}checked="checked"{/if}>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner" ></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>

<div id="resourceGroupsContainer">
	<div id="resourceGroups"></div>
</div>

</td>
</tr>
</table>   