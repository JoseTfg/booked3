<!DOCTYPE html>
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
<html lang="{$HtmlLang}" dir="{$HtmlTextDirection}">
<head>
	<title>{if $TitleKey neq ''}{translate key=$TitleKey args=$TitleArgs}{else}{$Title}{/if}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$Charset}"/>
	<meta name="robots" content="noindex"/>
	{if $ShouldLogout}
		<meta http-equiv="REFRESH" content="{$SessionTimeoutSeconds};URL={$Path}logout.php?{QueryStringKeys::REDIRECT}={$smarty.server.REQUEST_URI|urlencode}">
	{/if}
	<link rel="shortcut icon" href="{$Path}favicon.png"/>
	<link rel="icon" href="{$Path}favicon.png"/>
	{if $UseLocalJquery}
		{jsfile src="js/jquery-1.8.2.min.js"}
		{jsfile src="js/jquery-ui-1.9.0.custom.min.js"}
	{else}
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
	{/if}
	{jsfile src="js/jquery-ui-timepicker-addon.js"}
	{cssfile src="scripts/css/jquery-ui-timepicker-addon.css"}
	{jsfile src="phpscheduleit.js"}
	{cssfile src="normalize.css"}
	{cssfile src="nav.css"}
	{cssfile src="style.css"}
	{if $UseLocalJquery}
		{cssfile src="scripts/css/smoothness/jquery-ui-1.9.0.custom.min.css"}
	{else}
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/smoothness/jquery-ui.css" type="text/css"></link>
	{/if}
	{if $cssFiles neq ''}
		{assign var='CssFileList' value=','|explode:$cssFiles}
		{foreach from=$CssFileList item=cssFile}
			{cssfile src=$cssFile}
		{/foreach}
	{/if}
	{cssfile src=$CssUrl}
	{if $CssExtensionFile neq ''}
		{cssfile src=$CssExtensionFile}
	{/if}

	{if $printCssFiles neq ''}
		{assign var='PrintCssFileList' value=','|explode:$printCssFiles}
		{foreach from=$PrintCssFileList item=cssFile}
			<link rel='stylesheet' type='text/css' href='{$Path}{$cssFile}' media='print'/>
		{/foreach}
	{/if}

	<script type="text/javascript">
		$(document).ready(function () {
			initMenu();
		});
	</script>
	<link rel="stylesheet" type="text/css" href="../css/css_enhancement.css">
	<link rel="stylesheet" type="text/css" href="css/css_enhancement.css">
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
</head>
<body oncontextmenu="return false;"  class="{$bodyClass}">
<div id="wrapper">
	<div id="doc">
		<div id="logo"><a href="http://www.uniovi.es/">{html_image src="$LogoUrl"}</a></div>
		<div id="header">
			<div id="header-top">
				<table id="HeaderTable">
				<tr>
				<td>		
				<td>
					<div><a href="{$HomeUrl}">{html_image src="$Logo2"}</a></div>
				</td>	
					<div id="signout">
						{if $LoggedIn}
							<div id="HeaderUserName">{html_image src="status.png"} {$UserName}</div>		
							<br/>
							<a href="{$Path}logout.php">{html_image src="exit.png"}{translate key="SignOut"}</a>
						{else}
							<div id="HeaderNotSignedIn">{translate key="NotSignedIn"}</div>
							<br/>
							<a href="{$Path}index.php">{translate key="LogIn"} {html_image src="status-offline.png"}</a>
						{/if}
					</div>				
				</td>
				</tr>
				</table>  
			</div>
			<div>
				<ul id="nav" class="menubar">
					{if $LoggedIn}
						{if $CanViewAdmin}
							<li class="menubaritem"><a href="{$HomeUrl}">{html_image src="folder.png"}</a>						
								<ul>						
									<li class="menuitem"><a href="{$Path}my-calendar.php">{html_image src="calendar.png"} Calendario</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_resources.php">{html_image src="resource.png"} {translate key="ManageResources"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_users.php">{html_image src="user-small.png"} {translate key="ManageUsers"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_groups.php">{html_image src="users.png"} {translate key="ManageGroups"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_quotas.php">{html_image src="quotas.png"}  {translate key="ManageQuotas"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_announcements.php">{html_image src="announce2.png"} {translate key="ManageAnnouncements"}</a></li>			
									<li class="menuitem"><a	href="{$Path}admin/manage_schedules.php">{html_image src="schedule.jpg"} {translate key="ManageSchedules"}</a></li>
									<li class="menuitem"><a href="{$Path}reports/{Pages::REPORTS_GENERATE}">{html_image src="chart.png"} {translate key=Reports}</a></li>	
									<li class="menuitem"><a href="{$Path}admin/manage_configuration.php">{html_image src="tools-icon.jpg"} {translate key="Customization"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">{html_image src="calendar.png"} Probando</a></li>
								</ul>
							</li>
						{else}
							<li class="menubaritem"><a href="{$Path}">{html_image src="calendar.png"}</a> </li>							
						{/if}
						{if ( $pageTile eq "Mi Calendario" or $pageTile eq "My Calendar" ) && ( $UserId neq "1" )}
							<li class="menubaritem"><a href="#">{html_image src="tools.png"}</a>
								<ul>
									<li class="menuitem"><a href="#" id="timeTable"> {html_image src="horario.png"} {translate key="TimeTable"}</a></li>
									<li class="menuitem"><a href="#" onclick="$('#dialogColors').dialog('open')"> {html_image src="paint2.png"} {translate key="Colors"}</a></li>
									<li class="menuitem"><a href="#" onclick="$('#dialogSubscribe').dialog('open')"> {html_image src="cloud.png"} {translate key="Subscription"}</a></li>								
								</ul>
							</li>
						{/if}
					{/if}
					<li class="menubaritem help"><a href="{$Path}help.php?ht=about">{html_image src="ayuda.png"}</a></li>
				</ul>
			</div>
			<!-- end #nav -->
		</div>
		<!-- end #header -->
		<div id="content">