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
	<link rel="stylesheet" type="text/css" href="../css/propio.css">
	<link rel="stylesheet" type="text/css" href="css/propio.css">
</head>
<body class="{$bodyClass}">
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
						{translate key="SignedInAs"} <div id="HeaderUserName">{$UserName}</div>		
						<br/>
						<a href="{$Path}logout.php">{translate key="SignOut"}</a>
					{else}
						<div id="HeaderNotSignedIn">{translate key="NotSignedIn"}</div>
						<br/>
						<a href="{$Path}index.php">{translate key="LogIn"}</a>
					{/if}
				</div>				
</td>
</tr>
</table>  
			</div>
			<div>
				<ul id="nav" class="menubar">
					{if $LoggedIn}
					<li class="menubaritem"><a href="#"> Calendario</a>
						<ul>
							<li class="menuitem"><a href="{$HomeUrl}">Ir a Calendario</a></li>
							<li class="menuitem"><a onClick="menuClick(1);">Crear Reserva</a></li>
							<li class="menuitem"><a onClick="menuClick(2);">Exportar</a></li>	
							<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">{translate key="ManageBlackouts"}</a></li>								
						</ul>
					</li>
					<li class="menubaritem"><a href="#"> Preferencias</a>
						<ul>
							<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">Horarios</a></li>
							<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">Leyenda</a></li>							
						</ul>
					</li>					
					<ul>
							<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">Crear Reserva</a></li>										
						</ul>
									</li>
						{if $CanViewAdmin}
							<li class="menubaritem"><a href="#">{translate key="ManageReservations"}</a>
								<ul>
									<li class="menuitem"><a href="{$Path}admin/manage_reservations.php">{translate key="ManageReservations"}</a>
									<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">{translate key="ManageBlackouts"}</a></li>										
								</ul>
									</li>
							<li class="menubaritem"><a href="#">{translate key="ManageResources"}</a>
								<ul>
									<li class="menuitem"><a href="{$Path}admin/manage_resources.php">{translate key="ManageResources"}</a>
									<li class="menuitem"><a href="{$Path}admin/manage_resource_groups.php">{translate key="ManageGroups"}</a></li>
								</ul>
									</li>
							<li class="menubaritem"><a href="#">{translate key="ManageUsers"}</a>
								<ul>
									<li class="menuitem"><a href="{$Path}admin/manage_users.php">{translate key="ManageUsers"}</a>
									<li class="menuitem"><a href="{$Path}admin/manage_groups.php">{translate key="ManageGroups"}</a></li>
									<li class="menuitem"><a href="{$Path}admin/manage_quotas.php">{translate key="ManageQuotas"}</a></li>
								</ul>
								</li>
							<li class="menubaritem"><a href="{$Path}admin/manage_announcements.php">{translate key="ManageAnnouncements"}</a></li>
							<li class="menubaritem"><a href="#">{translate key="Customization"}</a>
								<ul>
									<li class="menuitem"><a href="{$Path}admin/manage_configuration.php">{translate key="Customization"}</a>
									<li class="menuitem"><a href="{$Path}admin/manage_attributes.php">{translate key="Attributes"}</a></li>
									{*<li class="menuitem"><a href="{$Path}admin/manage_theme.php">{translate key="LookAndFeel"}</a></li>*}
								</ul>
									</li>
						{/if}
						{if $CanViewResponsibilities}
							<li class="menubaritem"><a href="#">{translate key=Responsibilities}</a>
								<ul>
									{if $CanViewGroupAdmin}
										<li class="menuitem"><a
													href="{$Path}admin/manage_group_users.php">{translate key="ManageUsers"}</a></li>
										<li class="menuitem"><a href="{$Path}admin/manage_group_reservations.php">{translate key=GroupReservations}</a></li>
										<li class="menuitem"><a href="{$Path}admin/manage_admin_groups.php">{translate key="ManageGroups"}</a></li>
									{/if}
									{if $CanViewResourceAdmin || $CanViewScheduleAdmin}
										<li class="menuitem"><a href="{$Path}admin/manage_admin_resources.php">{translate key="ManageResources"}</a></li>
										<li class="menuitem"><a href="{$Path}admin/manage_blackouts.php">{translate key="ManageBlackouts"}</a></li>
									{/if}
									{if $CanViewResourceAdmin}
										<li class="menuitem"><a href="{$Path}admin/manage_resource_reservations.php">{translate key=ResourceReservations}</a></li>
									{/if}
									{if $CanViewScheduleAdmin}
										<li class="menuitem"><a href="{$Path}admin/manage_admin_schedules.php">{translate key="ManageSchedules"}</a></li>
										<li class="menuitem"><a href="{$Path}admin/manage_schedule_reservations.php">{translate key=ScheduleReservations}</a></li>
									{/if}
								</ul>
							</li>
						{/if}
						{if $CanViewReports}
							<li class="menubaritem"><a href="#">{translate key=Reports}</a>
								<ul>
									<li><a href="{$Path}reports/{Pages::REPORTS_GENERATE}">{translate key=GenerateReport}</a></li>
									<li><a href="{$Path}reports/{Pages::REPORTS_SAVED}">{translate key=MySavedReports}</a></li>
									<li><a href="{$Path}reports/{Pages::REPORTS_COMMON}">{translate key=CommonReports}</a></li>
								</ul>
							</li>
						{/if}
					{/if}
					<li class="menubaritem help"><a href="{$Path}help.php?ht=about">{translate key=About}</a></li>
					<li class="menubaritem help"><a href="{$Path}help.php">{translate key=Help}</a>	</li>

				</ul>
			</div>
			<!-- end #nav -->
		</div>
		<!-- end #header -->
		<div id="content">