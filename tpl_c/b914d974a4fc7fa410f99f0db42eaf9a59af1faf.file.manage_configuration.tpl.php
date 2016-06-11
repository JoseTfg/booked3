<?php /* Smarty version Smarty-3.1.16, created on 2016-05-28 16:48:41
         compiled from "/var/www/booked/tpl/Admin/Configuration/manage_configuration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19164533075749afc90f6093-15277900%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b914d974a4fc7fa410f99f0db42eaf9a59af1faf' => 
    array (
      0 => '/var/www/booked/tpl/Admin/Configuration/manage_configuration.tpl',
      1 => 1464446906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19164533075749afc90f6093-15277900',
  'function' => 
  array (
    'list_settings' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'settings' => 0,
    'setting' => 0,
    'name' => 0,
    'TimezoneValues' => 0,
    'TimezoneOutput' => 0,
    'Languages' => 0,
    'HomepageValues' => 0,
    'HomepageOutput' => 0,
    'IsPageEnabled' => 0,
    'IsConfigFileWritable' => 0,
    'Settings' => 0,
    'SectionSettings' => 0,
    'section' => 0,
    'SettingNames' => 0,
    'SCRIPT_NAME' => 0,
    'ConfigFiles' => 0,
    'file' => 0,
    'SelectedFile' => 0,
    'selected' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5749afc91d9a63_33805465',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5749afc91d9a63_33805465')) {function content_5749afc91d9a63_33805465($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css,scripts/css/colorbox.css'), 0);?>


<?php if (!is_callable('smarty_function_cycle')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/function.cycle.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/function.html_options.php';
?><?php if (!function_exists('smarty_template_function_list_settings')) {
    function smarty_template_function_list_settings($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['list_settings']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
	<?php  $_smarty_tpl->tpl_vars['setting'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['setting']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['setting']->key => $_smarty_tpl->tpl_vars['setting']->value) {
$_smarty_tpl->tpl_vars['setting']->_loop = true;
?>
		<?php echo smarty_function_cycle(array('values'=>',row1','assign'=>'rowCss'),$_smarty_tpl);?>

		<?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable($_smarty_tpl->tpl_vars['setting']->value->Name, null, 0);?>
    <li id="<?php echo $_smarty_tpl->tpl_vars['setting']->value->Key;?>
"><span class="label"><?php echo $_smarty_tpl->tpl_vars['setting']->value->Key;?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['setting']->value->Key==ConfigKeys::DEFAULT_TIMEZONE) {?>
            <select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="textbox">
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['TimezoneValues']->value,'output'=>$_smarty_tpl->tpl_vars['TimezoneOutput']->value,'selected'=>$_smarty_tpl->tpl_vars['setting']->value->Value),$_smarty_tpl);?>

            </select>
		<?php } elseif ($_smarty_tpl->tpl_vars['setting']->value->Key==ConfigKeys::LANGUAGE) {?>
            <select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="textbox">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Languages']->value,'key'=>'GetLanguageCode','label'=>'GetDisplayName','selected'=>strtolower($_smarty_tpl->tpl_vars['setting']->value->Value)),$_smarty_tpl);?>

            </select>
		<?php } elseif ($_smarty_tpl->tpl_vars['setting']->value->Key==ConfigKeys::DEFAULT_HOMEPAGE) {?>
			<select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="textbox">
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['HomepageValues']->value,'output'=>$_smarty_tpl->tpl_vars['HomepageOutput']->value,'selected'=>strtolower($_smarty_tpl->tpl_vars['setting']->value->Value)),$_smarty_tpl);?>

			</select>
		<?php } elseif ($_smarty_tpl->tpl_vars['setting']->value->Type==ConfigSettingType::String) {?>
            <input type="text" size="50" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value->Value, ENT_QUOTES, 'UTF-8', true);?>
" class="textbox"/>
		<?php } else { ?>
            <label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"True"),$_smarty_tpl);?>
<input type="radio" value="true" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['setting']->value->Value=='true') {?>
                                                checked="checked"<?php }?> /></label>
            <label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"False"),$_smarty_tpl);?>
<input type="radio" value="false"
                                                 name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['setting']->value->Value=='false') {?> checked="checked"<?php }?> /></label>
		<?php }?>
    </li>
	<?php } ?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageConfiguration'),$_smarty_tpl);?>
 </h1>



<?php if (!$_smarty_tpl->tpl_vars['IsPageEnabled']->value) {?>
<div class="warning">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationUiNotEnabled'),$_smarty_tpl);?>

</div>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['IsConfigFileWritable']->value) {?>
<div class="warning">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationFileNotWritable'),$_smarty_tpl);?>

</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['IsPageEnabled']->value&&$_smarty_tpl->tpl_vars['IsConfigFileWritable']->value) {?>

	<?php $_smarty_tpl->tpl_vars['HelpUrl'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['ScriptUrl']->value)."/help.php?ht=admin", null, 0);?>


<div id="updatedMessage" class="success" style="display:none">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ConfigurationUpdated'),$_smarty_tpl);?>

</div>

<div id="configSettings" style="width: 50%;margin: 0 auto; ">

    

    <form id="frmConfigSettings" method="post" ajaxAction="<?php echo ConfigActions::Update;?>
" action="<?php echo $_SERVER['SCRIPT_NAME'];?>
">
		
		<fieldset style="background-color:#FFCC99;">
		<ul class="no-style config-settings">
			<?php smarty_template_function_list_settings($_smarty_tpl,array('settings'=>$_smarty_tpl->tpl_vars['Settings']->value));?>

        </ul>
		</fieldset>

		<?php  $_smarty_tpl->tpl_vars['settings'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['settings']->_loop = false;
 $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SectionSettings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['settings']->key => $_smarty_tpl->tpl_vars['settings']->value) {
$_smarty_tpl->tpl_vars['settings']->_loop = true;
 $_smarty_tpl->tpl_vars['section']->value = $_smarty_tpl->tpl_vars['settings']->key;
?>
			<div id="<?php echo $_smarty_tpl->tpl_vars['section']->value;?>
">
            <h3><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</h3>
            <fieldset>
                <ul class="no-style config-settings">
					<?php smarty_template_function_list_settings($_smarty_tpl,array('settings'=>$_smarty_tpl->tpl_vars['settings']->value));?>

                </ul>
            </fieldset>
			</div>
		<?php } ?>

        <input type="hidden" name="setting_names" value="<?php echo $_smarty_tpl->tpl_vars['SettingNames']->value;?>
"/>		
    </form>
	<input style="text-align: right;width:90px;float:right;background:url('../img/arrow-circle-135.png');background-position:left;
background-repeat:no-repeat;" type="button" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
" class='button save'/>
	<form id="frmConfigFile" method="GET" action="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'File'),$_smarty_tpl);?>
:
	<select name="cf" id="cf" class="textbox">
	<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ConfigFiles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
		<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable('', null, 0);?>
		<?php if ($_smarty_tpl->tpl_vars['file']->value->Location==$_smarty_tpl->tpl_vars['SelectedFile']->value) {?><?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable("selected='selected'", null, 0);?><?php }?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['file']->value->Location;?>
" <?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
><?php echo $_smarty_tpl->tpl_vars['file']->value->Name;?>
</option>
	<?php } ?>
	</select>
</form>
</div>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>


	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.colorbox-min.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/configuration.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/help.js"),$_smarty_tpl);?>


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
	//document.getElementById("enable.email").style.display = "none";
	document.getElementById("image.upload.directory").style.display = "none";
	document.getElementById("image.upload.url").style.display = "none";
	document.getElementById("cache.templates").style.display = "none";
	document.getElementById("use.local.jquery").style.display = "none";
	document.getElementById("registration.captcha.enabled").style.display = "none";
	document.getElementById("registration.require.email.activation").style.display = "none";
	document.getElementById("registration.auto.subscribe.email").style.display = "none";
	document.getElementById("registration.notify.admin").style.display = "none";
	document.getElementById("css.extension.file").style.display = "none";
	document.getElementById("disable.password.reset").style.display = "none";
	document.getElementById("home.url").style.display = "none";
	//document.getElementById("logout.url").style.display = "none";
	document.getElementById("default.homepage").style.display = "none";
	

	var userPreferences = $("li[id*='minTime']");
	for (i=0;i<userPreferences.length;i++){
		userPreferences[i].style.display = "none";
	}
	var userPreferences = $("li[id*='maxTime']");
	for (i=0;i<userPreferences.length;i++){
		userPreferences[i].style.display = "none";
	}
	var userPreferences = $("li[id*='color']");
	for (i=0;i<userPreferences.length;i++){
		userPreferences[i].style.display = "none";
	}
	
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
    <h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Working'),$_smarty_tpl);?>
</h3>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"reservation_submitting.gif"),$_smarty_tpl);?>

</div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
