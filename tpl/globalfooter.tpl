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

{*Imports*}	
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
{jsfile src="js/jquery.qtip.min.js"}
{jsfile src="dashboard.js"}
{jsfile src="enhancement/marquee.js"}

<script type="text/javascript">
$(document).ready(function() {
	var dashboardOpts = {};
	var dashboard = new Dashboard(dashboardOpts);
	dashboard.init();
});

</script>
{if $LoggedIn}
	<div id="announcementsHeader" class="dashboardHeader">
		<marquee id="marquee" behavior="scroll" scrollamount="5" direction="left" onmousedown="this.stop();" onmouseup="this.start();">
			{foreach from=$Announcements item=each}
				| {$each|html_entity_decode|url2link|nl2br}
			{foreachelse}
				| {translate key="NoAnnouncements"}
			{/foreach}
			|
		</marquee>
	</div>
{else}
	<div class="page-footer">
		&copy; 2011-2016 &nbsp;<a href="http://github.com/JoseTfg/booked3">Booked Scheduler Enhanced v0.9</a>
    </div>
{/if}
</html>