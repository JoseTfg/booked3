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
<table id="myTable">
<tr>
<td>
<div id="filter">
	{if $GroupName}
		<span class="groupName">{$GroupName}</span>
	{else}
<label for="calendarFilter"></label>
<select id="calendarFilter" class="styled-select2">
{foreach from=$filters->GetFilters() item=filter}
	{foreach from=$filter->GetFilters() item=subfilter}
		<option value="{$subfilter->Id()}" class="resource" {if $subfilter->Selected()}selected="selected"{/if}>{$subfilter->Name()}</option>
	{/foreach}
{/foreach}
	{/if}
</select>
</div>

</td>
<td>

<link rel="stylesheet" type="text/css" href="css/propio.css">

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