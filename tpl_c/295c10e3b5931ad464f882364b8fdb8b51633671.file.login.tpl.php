<?php /* Smarty version Smarty-3.1.16, created on 2016-04-24 16:36:41
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14859571cd9f9b45680-00190926%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '295c10e3b5931ad464f882364b8fdb8b51633671' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\login.tpl',
      1 => 1459703946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14859571cd9f9b45680-00190926',
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
    'ShowForgotPasswordPrompt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_571cd9f9e6a231_09828442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571cd9f9e6a231_09828442')) {function content_571cd9f9e6a231_09828442($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['ShowLoginError']->value) {?>
<div id="loginError">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LoginError'),$_smarty_tpl);?>

</div>
<?php }?>

<div class="container">
   <div class="column-left">
	<script language="JavaScript" src="http://feed2js.org//feed2js.php?src=http%3A%2F%2Ffeeds.feedburner.com%2Fepigijon%2Fagenda&chan=y&num=1&utf=y&html=a"  charset="UTF-8" type="text/javascript"></script>
	</div>
	
   <div class="column-right">
   <script language="JavaScript" src="http://feed2js.org//feed2js.php?src=http%3A%2F%2Fwww.uniovi.es%2Fcomunicacion%2Fnoticias%2F-%2Fasset_publisher%2F33ICSSzZmx4V%2Frss%3Fp_p_cacheability%3DcacheLevelPage&chan=y&num=8&utf=y&html=a"  charset="UTF-8" type="text/javascript"></script>
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
" value="true"
												tabindex="30"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'RememberMe'),$_smarty_tpl);?>
</label>

				</p>
				<?php }?>

				<p class="loginsubmit">
					<button type="submit" name="<?php echo Actions::LOGIN;?>
" class="button" tabindex="100" value="submit"><img
							src="img/door-open-in.png"/> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'LogIn'),$_smarty_tpl);?>
 </button>
					<input type="hidden" name="<?php echo FormKeys::RESUME;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ResumeUrl']->value;?>
"/>
				</p>
			</div>
			<div style="clear:both;">&nbsp;</div>
		
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
		<?php if ($_smarty_tpl->tpl_vars['ShowScheduleLink']->value&&$_smarty_tpl->tpl_vars['ShowForgotPasswordPrompt']->value) {?>|<?php }?>
		
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

		if (!langCode) {
		}
	});
</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
