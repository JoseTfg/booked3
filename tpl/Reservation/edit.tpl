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
{extends file="Reservation/create.tpl"}

{block name=header}
	{include file='globalheader.tpl' TitleKey='EditReservationHeading' TitleArgs='' cssFiles='css/reservation.css,css/jquery.qtip.min.css,scripts/css/jqtree.css'}
{/block}

{block name=reservationHeader}
	{translate key="EditReservationHeading" args=''}
{/block}

<div>
{block name=submitButtons}
	{if $IsRecurring}
		<button type="button" class="button update prompt" id="submitButton4">
			<img src="img/tick-circle.png" />
			{translate key='Update'}
		</button>
		<div class="updateButtons hiddenDiv" title="{translate key=ApplyUpdatesTo}">
			<div style="text-align: center;line-height:50px;">
				<button type="button" class="button save btnUpdateThisInstance" id="submitButton1">
					{html_image src="disk-black.png"}
					{translate key='ThisInstance'}
				</button>
				</br>
				<button type="button" class="button save btnUpdateAllInstances" id="submitButton2">
					{html_image src="disks-black.png"}
					{translate key='AllInstances'}
				</button>
				</br>
				<button type="button" class="button save btnUpdateFutureInstances" id="submitButton3">
					{html_image src="disk-arrow.png"}
					{translate key='FutureInstances'}
				</button>
				</br>
			</div>
		</div>
	{else}
		<button type="button" id="submitButton" class="button save update btnCreate" style="position: absolute;left: 22%;">
			<img src="img/disk-black.png" />
			{translate key='Update'}
		</button>
	{/if}
{/block}
</div>
{block name=deleteButtons}
	{if $IsRecurring}
		</br>
		</br>
		</br>
		<a href="#" class="delete prompt" style="float:right;" id="delete">
			{html_image src="cross-button.png"}
			{translate key='Delete'}
		</a>
	{else}
		</br>
		</br>
		</br>
		<a href="#" class="delete save" style="float:right; id="delete">
			{html_image src="cross-button.png"}
			{translate key='Delete'}
		</a>
	{/if}
{/block}

{block name="ajaxMessage"}
	{translate key=UpdatingReservation}...<br/>
{/block}

{block name='attachments'}
<div style="clear:both">&nbsp;</div>
	<div id="attachmentDiv" class="res-attachments">
		<span class="heading">{translate key=Attachments} ({$Attachments|count})</span>
	</div>
{/block}