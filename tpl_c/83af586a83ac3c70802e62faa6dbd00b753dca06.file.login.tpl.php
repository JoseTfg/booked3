<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 17:49:12
         compiled from "/var/www/booked/tpl/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1812323583575c32f88024d9-92859239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83af586a83ac3c70802e62faa6dbd00b753dca06' => 
    array (
      0 => '/var/www/booked/tpl/login.tpl',
      1 => 1465474364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1812323583575c32f88024d9-92859239',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ShowLoginError' => 0,
    'ShowUsernamePrompt' => 0,
    'ShowPasswordPrompt' => 0,
    'Languages' => 0,
    'SelectedLanguage' => 0,
    'ShowPersistLoginPrompt' => 0,
    'ResumeUrl' => 0,
    'ShowScheduleLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c32f8865ea2_97276432',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c32f8865ea2_97276432')) {function content_575c32f8865ea2_97276432($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['ShowLoginError']->value) {?>
	<div id="loginError">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LoginError'),$_smarty_tpl);?>

	</div>
<?php }?>

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
			<form name="login" id="login" class="login" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
				<div>
					<?php if ($_smarty_tpl->tpl_vars['ShowUsernamePrompt']->value) {?>
						<p>
							<label class="login"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UsernameOrEmail'),$_smarty_tpl);?>
<br/>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('name'=>"EMAIL",'class'=>"input",'size'=>"20",'tabindex'=>"10"),$_smarty_tpl);?>
</label>
						</p>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['ShowPasswordPrompt']->value) {?>
						<p>
							<label class="login"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Password'),$_smarty_tpl);?>
<br/>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('type'=>"password",'name'=>"PASSWORD",'class'=>"input",'value'=>'','size'=>"20",'tabindex'=>"20"),$_smarty_tpl);?>
</label>
						</p>
					<?php }?>

					<p>
						<label class="login"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Language'),$_smarty_tpl);?>
<br/>
						<select <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'LANGUAGE'),$_smarty_tpl);?>
 class="input-small" id="languageDropDown">
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Languages']->value,'key'=>'GetLanguageCode','label'=>'GetDisplayName','selected'=>$_smarty_tpl->tpl_vars['SelectedLanguage']->value),$_smarty_tpl);?>

						</select>
					</p>

					<?php if ($_smarty_tpl->tpl_vars['ShowPersistLoginPrompt']->value) {?>
						<p class="stayloggedin">
							<label class="login"><input type="checkbox" name="<?php echo FormKeys::PERSIST_LOGIN;?>
" value="true" tabindex="30"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RememberMe'),$_smarty_tpl);?>
</label>
						</p>
					<?php }?>

					<p class="loginsubmit">					
						<button type="submit" id="loginButton" name="<?php echo Actions::LOGIN;?>
" class="button" tabindex="100" value="submit"><img src="img/door-open-in.png"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LogIn'),$_smarty_tpl);?>
 </button>
						<button type="button" id="viewReservations" class="button" tabindex="100"><img src="img/search.png"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ViewReservations'),$_smarty_tpl);?>
 </button>
						<input type="hidden" name="<?php echo FormKeys::RESUME;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ResumeUrl']->value;?>
"/>
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
		<?php if ($_smarty_tpl->tpl_vars['ShowScheduleLink']->value) {?>
			<a href="view-schedule.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ViewSchedule'),$_smarty_tpl);?>
</a>
		<?php }?>	
	</p>
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['setfocus'][0][0]->SetFocus(array('key'=>'EMAIL'),$_smarty_tpl);?>


<script type="text/javascript">
	var url = 'index.php?<?php echo QueryStringKeys::LANGUAGE;?>
=';
	$(document).ready(function () {
		$('#languageDropDown').change(function()
		{
			window.location.href = url + $(this).val();
		});

		var langCode = readCookie('<?php echo CookieKeys::LANGUAGE;?>
');

		$('#viewReservations').click(function()
		{
			document.getElementsByClassName("input")[0].value = "user";
			document.getElementsByClassName("input")[1].value = "password";
			document.getElementsByClassName("button")[0].click();
		});
	});
</script>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
