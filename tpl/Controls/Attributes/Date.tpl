{*
Copyright 2012-2015 Nick Korbel

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
{assign value="{$attribute->Value()|escape}" var="attributeValue"}
<label class="customAttribute" for="{$attributeId}">{$attribute->Label()|escape}:</label>
{if $align=='vertical'}
	<br/>
{/if}
{if $readonly}
	<span class="attributeValue {$class}">{formatdate date=$attributeValue key=general_datetime}</span>
{else}
	<input type="text" id="{$attributeId}" value="{formatdate date=$attributeValue key=general_datetime}" class="customAttribute textbox {$class}" />
	<input type="hidden" id="formatted{$attributeId}" name="{$attributeName}" value="{formatdate date=$attributeValue key=system_datetime}" />
	{control type="DatePickerSetupControl" ControlId="{$attributeId}" AltId="formatted{$attributeId}" HasTimepicker=true}
{/if}