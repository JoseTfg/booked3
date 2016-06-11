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

<h1>{translate key=WorkSchedule}</h1>

{foreach from=$Schedules item=schedule}
	{assign var=id value=$schedule->GetId()}
	{assign var=daysVisible value=$schedule->GetDaysVisible()}
	{assign var=dayOfWeek value=$schedule->GetWeekdayStart()}
	{assign var=dayName value=$DayNames[$dayOfWeek]}
	{if $dayOfWeek == Schedule::Today}
		{assign var=dayName value=$Today}
	{/if}
	<table class="list">
		<thead>
			<th>{translate key='Timezone'}</th>
			<th>{translate key='BeginDate'}</th>
			<th>{translate key='EndDate'}</th>
			<th>{translate key='Available'}</th>
		</thead>
		<tbody>	
			{assign var=first value=true}
			{foreach from=$Layouts[$id]->GetSlots($day) item=period}
				{if $first}
					{cycle values='row0,row1' assign=rowCss}
					<tr class="{$rowCss}">
					<td align="center">
						{$schedule->GetTimezone()} 
					</td>
					<td align="center">
						{$period->Start->Format("H:i")} 
					</td>
					{assign var=first value=false}
					{if $period->IsReservable()}
						{assign var=display value=false}
					{else}
						{assign var=display value=true}
					{/if}
				{/if}
				{if $period->IsReservable() and  $display}
					<td align="center">
						{$period->Start->Format("H:i")} 
					</td>
					<td align="center">
						{html_image src="slash.png"}			
					</td>
					</tr>
					{cycle values='row0,row1' assign=rowCss}
					<tr class="{$rowCss}">
					<td align="center">
						{$schedule->GetTimezone()} 
					</td>
					<td align="center">
						{$period->Start->Format("H:i")} 
					</td>
					{assign var=display value=false}
				{/if}					
				{if $period->IsReservable() == false and $display == false}					
					<td align="center">
						{$period->Start->Format("H:i")}				
					</td>
					<td align="center">
						{html_image src="tick-button.png"}			
					</td>
					</tr>
					{cycle values='row0,row1' assign=rowCss}
					{assign var=display value=true}
					<tr class="{$rowCss}">
					<td align="center">
						{$schedule->GetTimezone()} 
					</td>
					<td align="center">
						{$period->Start->Format("H:i")} 
					</td>
				{/if}
			{/foreach}				
			{if $display}
				<td align="center">
					00:00
				</td>
				<td align="center">
					{html_image src="slash.png"}			
				</td>
				</tr>
			{else}
				<td align="center">
					00:00
				</td>
				<td align="center">
					{html_image src="tick-button.png"}			
				</td>
				</tr>
			{/if}				
		</tbody>
	</table>
    <div class="scheduleDetails">
		<button type="button" class="update changeLayoutButton button">{html_image src="my_edit.png"} {translate key=ChangeLayout}</button>
		<div class="layout hiddenDiv">
			{function name="display_periods"}
				{foreach from=$Layouts[$id]->GetSlots($day) item=period}
					{if $period->IsReservable() == $showReservable}
						{$period->Start->Format("H:i")} - {$period->End->Format("H:i")}
						{if $period->IsLabelled()}
							{$period->Label}
						{/if}
						,
					{/if}
				{foreachelse}
					{translate key=None}
				{/foreach}
			{/function}

			{translate key=ScheduleLayout args=$schedule->GetTimezone()}:<br/>
			<input type="hidden" class="timezone" value="{$schedule->GetTimezone()}"/>

			{if !$Layouts[$id]->UsesDailyLayouts()}
				<input type="hidden" class="usesDailyLayouts" value="false"/>
				{translate key=ReservableTimeSlots}
				<div class="reservableSlots" id="reservableSlots" ref="reservableEdit">
					{display_periods showReservable=true day=null}
				</div>
				{translate key=BlockedTimeSlots}
				<div class="blockedSlots" id="blockedSlots" ref="blockedEdit">
					{display_periods showReservable=false day=null}
				</div>
			{else}
				<input type="hidden" class="usesDailyLayouts" value="true"/>
				{translate key=LayoutVariesByDay} - <a href="#" class="showAllDailyLayouts">{translate key=ShowHide}</a>
				<div class="allDailyLayouts">
					{foreach from=DayOfWeek::Days() item=day}
						{$DayNames[$day]}
						<div class="reservableSlots" id="reservableSlots_{$day}" ref="reservableEdit_{$day}">
							{display_periods showReservable=true day=$day}
						</div>
						<div class="blockedSlots" id="blockedSlots_{$day}" ref="blockedEdit_{$day}">
							{display_periods showReservable=false day=$day}
						</div>
					{/foreach}
				</div>
			{/if}
		</div>        
    </div>
{/foreach}

<input type="hidden" id="activeId" value=""/>

<div id="changeLayoutDialog" class="dialog" title="{translate key=ChangeLayout}">
    <div class="warning hiddenDiv">{translate key=FieldWarning}</div>
	<form id="changeLayoutForm" method="post">
        <div class="clear;display:block; hiddenDiv">
            <label>{translate key=UseSameLayoutForAllDays} <input type="checkbox" id="usesSingleLayout" {formname key=USING_SINGLE_LAYOUT}></label>
        </div>
	{function name=display_slot_inputs}
        <div class="clear hiddenDiv" id="{$id}">
			{assign var=suffix value=""}
			{if $day!=null}
				{assign var=suffix value="_$day"}
			{/if}
            <div style="visibility:hidden;" class="leftFloater">
                <textarea style="resize:none;height:1px" class="reservableEdit" id="reservableEdit{$suffix}" name="{FormKeys::SLOTS_RESERVABLE}{$suffix}"></textarea>
            </div>
            <div style="visibility:hidden;" class="rightFloater">
                <textarea style="resize:none;height:1px" class="blockedEdit" id="blockedEdit{$suffix}" name="{FormKeys::SLOTS_BLOCKED}{$suffix}"></textarea>
            </div>
        </div>
	{/function}
        <div class="clear" id="dailySlots">
            <div class="clear" id="tabs">
                <ul>
                    <li><a href="#tabs-0">{$DayNames[0]}</a></li>
                    <li><a href="#tabs-1">{$DayNames[1]}</a></li>
                    <li><a href="#tabs-2">{$DayNames[2]}</a></li>
                    <li><a href="#tabs-3">{$DayNames[3]}</a></li>
                    <li><a href="#tabs-4">{$DayNames[4]}</a></li>
                    <li><a href="#tabs-5">{$DayNames[5]}</a></li>
                    <li><a href="#tabs-6">{$DayNames[6]}</a></li>
                </ul>
                <div id="tabs-0">
					{display_slot_inputs day='0'}
                </div>
                <div id="tabs-1">
					{display_slot_inputs day='1'}
                </div>
                <div id="tabs-2">
					{display_slot_inputs day='2'}
                </div>
                <div id="tabs-3">
					{display_slot_inputs day='3'}
                </div>
                <div id="tabs-4">
					{display_slot_inputs day='4'}
                </div>
                <div id="tabs-5">
					{display_slot_inputs day='5'}
                </div>
                <div id="tabs-6">
					{display_slot_inputs day='6'}
                </div>
            </div>
        </div>		
		{display_slot_inputs id="staticSlots" day=null}		
        <div style="clear:both;height:0;">&nbsp</div>
		</br>
		</br>
        <div style="margin-top:5px;">
			{translate key=Timezone}
            <select style="text-align-last:center" {formname key=TIMEZONE} id="layoutTimezone" class="input">
				{html_options values=$TimezoneValues output=$TimezoneOutput}
            </select>
        </div>
		</br>
        <div style="margin-top:2px;">
			{capture name="layoutConfig" assign="layoutConfig"}
                {*<input type='text' value='30' id='quickLayoutConfig' size='5' />*}
				 <select style="text-align-last:center" id='quickLayoutConfig' class="input">
					<option value='30'> 30 </option>
					<option value='60'> 60 </option>
				</select>				
			{/capture}
			{capture name="layoutStart" assign="layoutStart"}
                {*<input type='text' value='08:00' id='quickLayoutStart' size='10'/>*}
				<select style="text-align-last:center" id='quickLayoutStart' class="input"></select>
			{/capture}
			{capture name="layoutEnd" assign="layoutEnd"}
                {*<input type='text' value='18:00' id='quickLayoutEnd' size='10'/>*}
				<select style="text-align-last:center" id='quickLayoutEnd' class="input"></select>
			{/capture}
			{translate key=QuickSlotCreation args="$layoutConfig,$layoutStart,$layoutEnd"}
        </div>
		</br>
        <button type="button" class="button save-create">{html_image src="tick-circle.png"} {translate key=Update}</button>
    </form>
	<div class="hiddenDiv">
	<div class="hiddenDiv">{translate key=NoneSelected}</div>
	<div id="addedTimes"></div>
	<div id="removedTimes"></div>
	<div class="hiddenDiv">{translate key=AllSelected}</div>
	</div>
</div>

{csrf_token}
{html_image src="admin-ajax-indicator.gif" class="indicator"}

{*Imports*}
{jsfile src="admin/edit.js"}
{jsfile src="admin/schedule.js"}
{jsfile src="js/jquery.form-3.09.min.js"}

{*Enhance*}
{jsfile src="enhancement/scheduleEnhance.js"}

{*Code*}
<script type="text/javascript">

    $(document).ready(function ()
    {
        var opts = {
            submitUrl:'{$smarty.server.SCRIPT_NAME}',
            saveRedirect:'{$smarty.server.SCRIPT_NAME}',
            renameAction:'{ManageSchedules::ActionRename}',
            changeSettingsAction:'{ManageSchedules::ActionChangeSettings}',
            changeLayoutAction:'{ManageSchedules::ActionChangeLayout}',
            addAction:'{ManageSchedules::ActionAdd}',
            makeDefaultAction:'{ManageSchedules::ActionMakeDefault}',
            deleteAction:'{ManageSchedules::ActionDelete}',
            adminAction:'{ManageSchedules::ChangeAdminGroup}',
            enableSubscriptionAction:'{ManageSchedules::ActionEnableSubscription}',
            disableSubscriptionAction:'{ManageSchedules::ActionDisableSubscription}'
        };

        var scheduleManagement = new ScheduleManagement(opts);
        scheduleManagement.init();
		
		enhance();
    });

</script>

{include file='globalfooter.tpl'}