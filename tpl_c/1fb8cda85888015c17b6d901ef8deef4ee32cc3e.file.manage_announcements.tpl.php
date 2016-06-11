<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 17:54:23
         compiled from "/var/www/booked/tpl/Admin/manage_announcements.tpl" */ ?>
<?php /*%%SmartyHeaderCode:396933650575c342fddff89-01208662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fb8cda85888015c17b6d901ef8deef4ee32cc3e' => 
    array (
      0 => '/var/www/booked/tpl/Admin/manage_announcements.tpl',
      1 => 1465648357,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '396933650575c342fddff89-01208662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'announcements' => 0,
    'announcement' => 0,
    'timezone' => 0,
    'priorities' => 0,
    'PageInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c342fecf777_62295741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c342fecf777_62295741')) {function content_575c342fecf777_62295741($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/modifier.regex_replace.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageAnnouncements'),$_smarty_tpl);?>
</h1>

<table id="announceTable" class="list">
	<thead>
		<th class="id">&nbsp;</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
</th>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
</th>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</th>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['announcement'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['announcement']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->key => $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->_loop = true;
?>
			<tr>
				<td class="id"><input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['announcement']->value->Id();?>
"/></td>
				<td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['announcement']->value->Text(),300,"...",true);?>
</td>
				<td align="center" class="announceTableCell"><?php echo $_smarty_tpl->tpl_vars['announcement']->value->Priority();?>
</td>
				<td align="center" class="announceTableCell"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->Start()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
</td>
				<td align="center" class="announceTableCell"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['announcement']->value->End()->ToTimezone($_smarty_tpl->tpl_vars['timezone']->value)),$_smarty_tpl);?>
</td>		
				<td align="center" class="announceTableCell"><a href="#" class="update edit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a></td>
				<td align="center" class="announceTableCell"><a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<input type="hidden" id="activeId" />
<div id="deleteDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteForm" method="post">
		<div class="error" id="marginError">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		<button type="button" class="button delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
	</form>
</div>

<div id="editDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Edit'),$_smarty_tpl);?>
">
	<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FieldWarning'),$_smarty_tpl);?>
</div>
	<form id="editForm" method="post">
        <textarea rows="4" id="editText" class="textbox required" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
" style="width:500px;resize: none;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_TEXT'),$_smarty_tpl);?>
></textarea><br/>
		<br/>
		<div align="center">
			<input  style="text-align:center;width:100px;" type="text" id="editBegin" class="textbox" />
			<input type="hidden" id="formattedEditBegin" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
			-
			<input style="text-align:center;width:100px;" type="text" id="editEnd" class="textbox" />
			<input type="hidden" id="formattedEditEnd" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
			<br/><br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
 <br/>
			<select id="editPriority" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_PRIORITY'),$_smarty_tpl);?>
>
				<option value="">---</option>
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['priorities']->value,'output'=>$_smarty_tpl->tpl_vars['priorities']->value),$_smarty_tpl);?>

			</select>
			<br/>
		</div>
		<button type="button" class="button edit"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
	</form>
</div>

<div class="pagination">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['pagination'][0][0]->CreatePagination(array('pageInfo'=>$_smarty_tpl->tpl_vars['PageInfo']->value),$_smarty_tpl);?>

</div>

<div id="newDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
">
	<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FieldWarning'),$_smarty_tpl);?>
</div>
	<form id="addForm" method="post">
        <textarea rows="4" class="textbox required" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Announcement'),$_smarty_tpl);?>
" style="width:500px;resize: none;" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_TEXT'),$_smarty_tpl);?>
></textarea><br/>
		<br/>
		<div align="center">
			<input style="text-align: center;width:100px;" type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
" id="BeginDate" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
			<input type="hidden" id="formattedBeginDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_START'),$_smarty_tpl);?>
 />
			-
			<input style="text-align: center;width:100px;" type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
" id="EndDate" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
			<input type="hidden" id="formattedEndDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_END'),$_smarty_tpl);?>
 />
			<br/><br/>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Priority'),$_smarty_tpl);?>
 <br/>
			<select id="createPriority" class="textbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ANNOUNCEMENT_PRIORITY'),$_smarty_tpl);?>
>
				<option value="">---</option>
				<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['priorities']->value,'output'=>$_smarty_tpl->tpl_vars['priorities']->value),$_smarty_tpl);?>

			</select>
		</div>
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
</button>
	</form>
</div>

<button id="newButton" class="button save" type="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAnnouncement'),$_smarty_tpl);?>
</button>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"BeginDate",'AltId'=>"formattedBeginDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"EndDate",'AltId'=>"formattedEndDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"editBegin",'AltId'=>"formattedEditBegin"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"editEnd",'AltId'=>"formattedEditEnd"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/announcement.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"TableSorter/jquery.tablesorter.js"),$_smarty_tpl);?>



<script type="text/javascript">
	$(document).ready(function() {

	$("#announceTable").tablesorter({
		widgets: ["zebra"],
		widgetOptions : {
			zebra : [ "normal-row", "alt-row" ]
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
