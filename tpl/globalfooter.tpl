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
	</div><!-- close content-->
	</div><!-- close doc-->
	<div class="push">&nbsp;</div>
	</div><!-- close wrapper-->

<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="dashboard.js"}

<script type="text/javascript">
$(document).ready(function() {
	var dashboardOpts = {};
	var dashboard = new Dashboard(dashboardOpts);
	dashboard.init();
});
</script>
{if $LoggedIn}
<div class="dashboard" id="announcementsDashboard">
	<div id="announcementsHeader" class="dashboardHeader">
		<a href="javascript:void(0);" title="{translate key='ShowHide'}">{translate key="Announcements"}</a>
	</div>
	<div class="dashboardContents" style="display:none">
		<ul>
			{foreach from=$Announcements item=each}
			    <li>{$each|html_entity_decode|url2link|nl2br}</li>
			{foreachelse}
				<div class="noresults">{translate key="NoAnnouncements"}</div>
			{/foreach}
		</ul>
	</div>
</div>
	</body>
	{else}
	<div class="page-footer">
			&copy; 2015 <a href="http://www.twinkletoessoftware.com">Twinkle Toes Software</a> <br/><a href="http://www.bookedscheduler.com">Booked Scheduler v{$Version}</a>
    	</div>
	{/if}
</html>