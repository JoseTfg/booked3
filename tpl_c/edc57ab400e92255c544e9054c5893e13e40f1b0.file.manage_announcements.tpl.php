<?php /* Smarty version Smarty-3.1.16, created on 2016-05-17 13:41:12
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Admin\manage_announcements.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27425573b0358077e48-40402252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edc57ab400e92255c544e9054c5893e13e40f1b0' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Admin\\manage_announcements.tpl',
      1 => 1463333571,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27425573b0358077e48-40402252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'announcements' => 0,
    'rowCss' => 0,
    'announcement' => 0,
    'timezone' => 0,
    'priorities' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_573b03583d7390_93828077',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573b03583d7390_93828077')) {function content_573b03583d7390_93828077($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\Program Files (x86)\\Ampps\\www\\booked\\lib\\Common/../../lib/external/Smarty/plugins\\function.cycle.php';
if (!is_callable('smarty_function_html_options')) include 'C:\\Program Files (x86)\\Ampps\\www\\booked\\lib\\Common/../../lib/external/Smarty/plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_regex_replace')) include 'C:\\Program Files (x86)\\Ampps\\www\\booked\\lib\\Common/../../lib/external/Smarty/plugins\\modifier.regex_replace.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageAnnouncements'),$_smarty_tpl);?>
</h1>

<table class="list" id="announcements" style="width: 50%;margin: 0 auto;">
	<thead>
	<tr>
		<th class="id">&nbsp;</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
</th>
		<td class="action">Editar</th>
		<td class="action">Borrar</th>
	</tr>
	</thead>
	<tbody>
<?php  $_smarty_tpl->tpl_vars['announcement'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['announcement']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->key => $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->_loop = true;
?>
	<?php echo smarty_function_cycle(array('values'=>'row0,row1','assign'=>'rowCss'),$_smarty_tpl);?>

	<tr class="<?php echo $_smarty_tpl->tpl_vars['rowCss']->value;?>
">
		<td class="id"><input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['announcement']->value->Id();?>
"/></td>
		<td style="width:300px;"><?php echo nl2br($_smarty_tpl->tpl_vars['announcement']->value->Text());?>
</td>
		<td align="center"style="width: 100px;"><?php echo $_smarty_tpl->tpl_vars['announcement']->value->Priority();?>
</td>
		<td align="center" style="width: 100px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->Start()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
</td>
		<td align="center" style="width: 100px;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->End()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
</td>
		<td align="center" style="width: 100px;"><a href="#" class="update edit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a> </td>
		<td align="center" style="width: 100px;"> <a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
	</tr>
	</tbody>
<?php } ?>
</table>

<input type="hidden" id="activeId" />

<div id="deleteDialog" class="dialog" style="display:none;background-color:#FFCC99" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteForm" method="post">
		<div class="error" style="margin-bottom: 15px;">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
		
	</form>
</div>

<div id="editDialog" class="dialog" style="display:none;background-color:#FFCC99" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
">
	<form id="editForm" method="post">
		
        <textarea id="editText" class="textbox required" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
" style="width:500px;resize: none;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_TEXT'),$_smarty_tpl);?>
></textarea><br/>
		<br/>
		<div align="center">
        
        <input type="text" id="editBegin" class="textbox" />
        <input type="hidden" id="formattedEditBegin" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
		-
        
        <input type="text" id="editEnd" class="textbox" />
        <input type="hidden" id="formattedEditEnd" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
		<br/><br/>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
 <br/>
        <select id="editPriority" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_PRIORITY'),$_smarty_tpl);?>
>
            <option value="">---</option>
            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['priorities']->value,'output'=>$_smarty_tpl->tpl_vars['priorities']->value),$_smarty_tpl);?>

        </select><br/>
				</div>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		
	</form>
</div>

<div id="newDialog" class="dialog" style="display:none;background-color:#FFCC99" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
">
	<form id="addForm" method="post">
		
        <textarea class="textbox required" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
" style="width:500px;resize: none;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_TEXT'),$_smarty_tpl);?>
></textarea><br/>
		<br/>
		<div align="center">
        <input type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
" id="BeginDate" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
		<input type="hidden" id="formattedBeginDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
		-
        <input type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
" id="EndDate" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
		<input type="hidden" id="formattedEndDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
		<br/><br/>
        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
 <br/>
		<select class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_PRIORITY'),$_smarty_tpl);?>
>
                 <option value="">---</option>
                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['priorities']->value,'output'=>$_smarty_tpl->tpl_vars['priorities']->value),$_smarty_tpl);?>

                        </select>
		</div>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
</button>
	</form>
</div>

<button id="newButton" class="button save" style="float:right;" type="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
</button>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"BeginDate",'AltId'=>"formattedBeginDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"EndDate",'AltId'=>"formattedEndDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"editBegin",'AltId'=>"formattedEditBegin"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"editEnd",'AltId'=>"formattedEditEnd"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/announcement.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>




<script type="text/javascript">
	$(document).ready(function() {

	$("#myLabel").on('click', function() {
		   if (document.getElementById("announcementsTable").style.display == "none"){
				document.getElementById("announcementsTable").style.display = "initial";
		   }
		   else{
				document.getElementById("announcementsTable").style.display = "none";
			}
		});
	
	var actions = {
		add: '<?php echo ManageAnnouncementsActions::Add;?>
',
		edit: '<?php echo ManageAnnouncementsActions::Change;?>
',
		deleteAnnouncement: '<?php echo ManageAnnouncementsActions::Delete;?>
'
	};

	var accessoryOptions = {
		submitUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		saveRedirect: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		actions: actions
	};

	var announcementManagement = new AnnouncementManagement(accessoryOptions);
    announcementManagement.init();

	<?php  $_smarty_tpl->tpl_vars['announcement'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['announcement']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->key => $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->_loop = true;
?>
    announcementManagement.addAnnouncement(
        '<?php echo $_smarty_tpl->tpl_vars['announcement']->value->Id();?>
',
        '<?php echo smarty_modifier_regex_replace(preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['announcement']->value->Text()),"/[\n]/","\\n");?>
',
        '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->Start()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
',
        '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->End()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
',
        '<?php echo $_smarty_tpl->tpl_vars['announcement']->value->Priority();?>
'
    );
	<?php } ?>	
	});
</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
