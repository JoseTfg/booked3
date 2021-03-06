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
{include file='globalheader.tpl'}

{if $ShowLoginError}
	<div id="loginError">
		{translate key='LoginError'}
	</div>
{/if}

<div class="container">
    <div class="column-left">
		<script language="JavaScript" src="https://feed2js.org//feed2js.php?src=http%3A%2F%2Ffeeds.feedburner.com%2Fepigijon%2Fagenda&chan=y&num=1&utf=y&html=a"  charset="UTF-8" type="text/javascript"></script>
	</div>
	
    <div class="column-right">
		<script language="JavaScript" src="https://feed2js.org//feed2js.php?src=http%3A%2F%2Fwww.uniovi.es%2Fcomunicacion%2Fnoticias%2F-%2Fasset_publisher%2F33ICSSzZmx4V%2Frss%3Fp_p_cacheability%3DcacheLevelPage&chan=y&num=8&utf=y&html=a"  charset="UTF-8" type="text/javascript"></script>
    </div>   

	<div class="column-center">
		<div id="loginbox">
			<!--This "$smarty.server.SCRIPT_NAME" sets up the form to post back to the same page that it is on.-->
			<form name="login" id="login" class="login" method="post" action="{$smarty.server.SCRIPT_NAME}">
				<div>
					{if $ShowUsernamePrompt}
						<p>
							<label class="login">{translate key='UsernameOrEmail'}<br/>
							{textbox name="EMAIL" class="input" size="20" tabindex="10"}</label>
						</p>
					{/if}

					{if $ShowPasswordPrompt}
						<p>
							<label class="login">{translate key='Password'}<br/>
							{textbox type="password" name="PASSWORD" class="input" value="" size="20" tabindex="20"}</label>
						</p>
					{/if}

					<p>
						<label class="login">{translate key='Language'}<br/>
						<select {formname key='LANGUAGE'} class="input-small" id="languageDropDown">
							{object_html_options options=$Languages key='GetLanguageCode' label='GetDisplayName' selected=$SelectedLanguage}
						</select>
					</p>

					{if $ShowPersistLoginPrompt}
						<p class="stayloggedin">
							<label class="login"><input type="checkbox" name="{FormKeys::PERSIST_LOGIN}" value="true" tabindex="30"/> {translate key='RememberMe'}</label>
						</p>
					{/if}

					<p class="loginsubmit">					
						<button type="submit" id="loginButton" name="{Actions::LOGIN}" class="button" tabindex="100" value="submit"><img src="img/door-open-in.png"/> {translate key='LogIn'} </button>
						<button type="button" id="viewReservations" class="button" tabindex="100"><img src="img/search.png"/> {translate key='ViewReservations'} </button>
						<input type="hidden" name="{FormKeys::RESUME}" value="{$ResumeUrl}"/>
					</p>
				</div>
				<div style="clear:both;">&nbsp;</div>
				<input type="hidden" id="myLogin" value=""/>
			</form>
		</div>
	</div>
</div>


<div id="login-links">
	<p>
		{if $ShowScheduleLink}
			<a href="view-schedule.php">{translate key='ViewSchedule'}</a>
		{/if}	
	</p>
</div>

{setfocus key='EMAIL'}

<script type="text/javascript">
	var url = 'index.php?{QueryStringKeys::LANGUAGE}=';
	$(document).ready(function () {
		$('#languageDropDown').change(function()
		{
			window.location.href = url + $(this).val();
		});

		var langCode = readCookie('{CookieKeys::LANGUAGE}');

		$('#viewReservations').click(function()
		{
			document.getElementsByClassName("input")[0].value = "user";
			document.getElementsByClassName("input")[1].value = "password";
			document.getElementsByClassName("button")[0].click();
		});
	});
</script>

{include file='globalfooter.tpl'}