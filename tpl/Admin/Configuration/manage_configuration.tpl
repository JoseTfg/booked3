{*
Copyright 2013-2015 Nick Korbel

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

{include file='globalheader.tpl' cssFiles='css/admin.css,scripts/css/colorbox.css'}

{function name="list_settings"}
	{foreach from=$settings item=setting}
		{cycle values=',row1' assign=rowCss}
		{assign var="name" value=$setting->Name}
    <li id="{$setting->Key}"><span class="label">{$setting->Key}</span>
		{if $setting->Key == ConfigKeys::DEFAULT_TIMEZONE}
            <select name="{$name}" class="textbox">
				{html_options values=$TimezoneValues output=$TimezoneOutput selected=$setting->Value}
            </select>
		{elseif $setting->Key == ConfigKeys::LANGUAGE}
            <select name="{$name}" class="textbox">
				{object_html_options options=$Languages key='GetLanguageCode' label='GetDisplayName' selected=$setting->Value|strtolower}
            </select>
		{elseif $setting->Key == ConfigKeys::DEFAULT_HOMEPAGE}
			<select name="{$name}" class="textbox">
				{html_options values=$HomepageValues output=$HomepageOutput selected=$setting->Value|strtolower}
			</select>
		{elseif $setting->Type == ConfigSettingType::String}
            <input type="text" size="50" name="{$name}" value="{$setting->Value|escape}" class="textbox"/>
		{else}
            <label>{translate key="True"}<input type="radio" value="true" name="{$name}"{if $setting->Value == 'true'}
                                                checked="checked"{/if} /></label>
            <label>{translate key="False"}<input type="radio" value="false"
                                                 name="{$name}"{if $setting->Value == 'false'} checked="checked"{/if} /></label>
		{/if}
    </li>
	{/foreach}
{/function}

<h1>{translate key=ManageConfiguration} {*{html_image src="question-button.png" id="help-prompt" ref="help-configuration"}*}</h1>



{if !$IsPageEnabled}
<div class="warning">
	{translate key=ConfigurationUiNotEnabled}
</div>
{/if}

{if !$IsConfigFileWritable}
<div class="warning">
	{translate key=ConfigurationFileNotWritable}
</div>
{/if}

{if $IsPageEnabled && $IsConfigFileWritable}

	{assign var=HelpUrl value="$ScriptUrl/help.php?ht=admin"}
{*<h3>{translate key=ConfigurationUpdateHelp args=$HelpUrl}</h3>*}

<div id="updatedMessage" class="success" style="display:none">
	{translate key=ConfigurationUpdated}
</div>

<div id="configSettings" style="width: 50%;margin: 0 auto; ">

    {*<input type="button" value="{translate key=Update}" class='button save'/>*}

    <form id="frmConfigSettings" method="post" ajaxAction="{ConfigActions::Update}" action="{$smarty.server.SCRIPT_NAME}">
		<h3>{translate key=GeneralConfigSettings}</h3>
		<fieldset style="background-color:#FFCC99;">
		<ul class="no-style config-settings">
			{list_settings settings=$Settings}
        </ul>
		</fieldset>

		{foreach from=$SectionSettings key=section item=settings}
			<div id="{$section}">
            <h3>{$section}</h3>
            <fieldset>
                <ul class="no-style config-settings">
					{list_settings settings=$settings}
                </ul>
            </fieldset>
			</div>
		{/foreach}

        <input type="hidden" name="setting_names" value="{$SettingNames}"/>		
    </form>
	<input style="float:right;" type="button" value="{translate key=Update}" class='button save'/>
	<form id="frmConfigFile" method="GET" action="{$SCRIPT_NAME}">
	{translate key=File}:
	<select name="cf" id="cf" class="textbox">
	{foreach from=$ConfigFiles item=file}
		{assign var=selected value=""}
		{if $file->Location eq $SelectedFile}{assign var=selected value="selected='selected'"}{/if}
		<option value="{$file->Location}" {$selected}>{$file->Name}</option>
	{/foreach}
	</select>
</form>
</div>

	{csrf_token}

	{jsfile src="admin/edit.js"}
	{jsfile src="js/jquery.form-3.09.min.js"}
	{jsfile src="js/jquery.colorbox-min.js"}
	{jsfile src="admin/configuration.js"}
	{jsfile src="admin/help.js"}

<script type="text/javascript">

	url = document.URL;
		
	if(url.indexOf("cf=Authentication%2FLdap") != -1){
	document.getElementById("scope").style.display = "none";
	document.getElementById("required.group").style.display = "none";
	document.getElementById("database.auth.when.ldap.user.not.found").style.display = "none";
	document.getElementById("ldap.debug.enabled").style.display = "none";
	}
	else{
	document.getElementById("allow.self.registration").style.display = "none";
	document.getElementById("admin.email.name").style.display = "none";
	document.getElementById("enable.email").style.display = "none";
	document.getElementById("cache.templates").style.display = "none";
	document.getElementById("use.local.jquery").style.display = "none";
	document.getElementById("registration.captcha.enabled").style.display = "none";
	document.getElementById("registration.require.email.activation").style.display = "none";
	document.getElementById("registration.auto.subscribe.email").style.display = "none";
	document.getElementById("registration.notify.admin").style.display = "none";
	document.getElementById("css.extension.file").style.display = "none";
	document.getElementById("disable.password.reset").style.display = "none";
	document.getElementById("home.url").style.display = "none";
	document.getElementById("logout.url").style.display = "none";
	document.getElementById("default.homepage").style.display = "none";
	document.getElementById("prueba").style.display = "none";
	document.getElementById("minTime").style.display = "none";
	document.getElementById("maxTime").style.display = "none";
	
	document.getElementById("schedule").style.display = "none";
	document.getElementById("ics").style.display = "none";
	document.getElementById("privacy").style.display = "none";
	document.getElementById("reservation").style.display = "none";
	document.getElementById("reservation.notify").style.display = "none";
	document.getElementById("plugins").style.display = "none";
	document.getElementById("recaptcha").style.display = "none";
	document.getElementById("email").style.display = "none";
	document.getElementById("reports").style.display = "none";
	document.getElementById("password").style.display = "none";
	document.getElementById("reservation.labels").style.display = "none";
	document.getElementById("security").style.display = "none";
	document.getElementById("google.analytics").style.display = "none";
	
	document.getElementById("phpmailer").style.display = "none";
	document.getElementById("uploads").style.display = "none";
	}
	
    $(document).ready(function ()
    {
        var config = new Configuration();
        config.init();
    });

</script>

<div id="modalDiv" style="display:none;text-align:center; top:15%;position:relative;">
    <h3>{translate key=Working}</h3>
	{html_image src="reservation_submitting.gif"}
</div>

{/if}

{include file='globalfooter.tpl'}