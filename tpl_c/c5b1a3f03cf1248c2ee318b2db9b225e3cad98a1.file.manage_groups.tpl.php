<?php /* Smarty version Smarty-3.1.16, created on 2016-05-17 17:12:34
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Admin\manage_groups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8729573b34e207ee48-24447981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5b1a3f03cf1248c2ee318b2db9b225e3cad98a1' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Admin\\manage_groups.tpl',
      1 => 1463398024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8729573b34e207ee48-24447981',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CanChangeRoles' => 0,
    'groups' => 0,
    'rowCss' => 0,
    'group' => 0,
    'PageInfo' => 0,
    'resources' => 0,
    'resource' => 0,
    'Roles' => 0,
    'role' => 0,
    'AdminGroups' => 0,
    'adminGroup' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_573b34e218f065_16406106',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573b34e218f065_16406106')) {function content_573b34e218f065_16406106($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\Program Files (x86)\\Ampps\\www\\booked\\lib\\Common/../../lib/external/Smarty/plugins\\function.cycle.php';
?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageGroups'),$_smarty_tpl);?>
 </h1>


<div>
<table id="groupTable" class="list">
	<thead>
		<th class="id">&nbsp;</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupName'),$_smarty_tpl);?>
</th>
		
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupMembers'),$_smarty_tpl);?>
</th>		
		<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupRoles'),$_smarty_tpl);?>
</th>
		<?php }?>	
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Permissions'),$_smarty_tpl);?>
</th>
		<td class="action">Renombrar</th>
		<td class="action">Borrar</th>
	</thead>
<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
	<?php echo smarty_function_cycle(array('values'=>'row0,row1','assign'=>'rowCss'),$_smarty_tpl);?>

	<tr class="<?php echo $_smarty_tpl->tpl_vars['rowCss']->value;?>
">
		<td class="id"><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
"/></td>
		<td id="<?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
" ><?php echo $_smarty_tpl->tpl_vars['group']->value->Name;?>
</td>
		
		<td align="center"><a href="#" class="update members"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a></td>		
		<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
		<td align="center"><a href="#" class="update roles"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a></td>
		<?php }?>		
		<td align="center"><a href="#" class="update permissions"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a></td>
		<td align="center"><a href="#" class="update rename"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a></td>
		<td align="center"><a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
	</tr>
<?php } ?>
</table>

<div style="text-align:center;">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['pagination'][0][0]->CreatePagination(array('pageInfo'=>$_smarty_tpl->tpl_vars['PageInfo']->value),$_smarty_tpl);?>

</div>
</div>
<input type="hidden" id="activeId" />

<div id="membersDialog" class="dialog" style="display:none;background-color:#FFCC99;overflow:hidden;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupMembers'),$_smarty_tpl);?>
">
	 <input type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddUser'),$_smarty_tpl);?>
" id="userSearch" class="textbox" size="40" />
	<div style="visibility:hidden;">prueba</div>
	<div id="allUsers" style="display:none;" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllUsers'),$_smarty_tpl);?>
"></div>
	<h4><span id="totalUsers"></span> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UsersInGroup'),$_smarty_tpl);?>
</h4>
	<div id="groupUserList"></div>
</div>

<div id="permissionsDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Permissions'),$_smarty_tpl);?>
">
	<form id="permissionsForm" method="post">
		<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
			<label><input <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ID','multi'=>true),$_smarty_tpl);?>
 class="resourceId" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetResourceId();?>
"> <?php echo $_smarty_tpl->tpl_vars['resource']->value->GetName();?>
</label><br/>
		<?php } ?>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		<button type="button" class="button cancel" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
	</form>
</div>

<form id="removeUserForm" method="post">
	<input type="hidden" id="removeUserId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>
 />
</form>

<form id="addUserForm" method="post">
	<input type="hidden" id="addUserId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>
 />
</form>

<div id="deleteDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteGroupForm" method="post">
		<div class="error" style="margin-bottom: 25px;">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
			<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteGroupWarning'),$_smarty_tpl);?>
</div>
		</div>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
		
	</form>
</div>

<div id="renameDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
">
	<form id="renameGroupForm" method="post">
		<input type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
" class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_NAME'),$_smarty_tpl);?>
 /></label>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
</button>
		
	</form>
</div>

<div id="addDialog" class="dialog" style="display:none;background-color:#FFCC99;" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
">
	<form id="renameGroupForm" method="post">
		<form id="addGroupForm" method="post" style="margin-top:-30px">
			<input placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupName'),$_smarty_tpl);?>
" type="text" class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_NAME'),$_smarty_tpl);?>
 />
			<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
</button>
		</form>
	</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
<div id="rolesDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'WhatRolesApplyToThisGroup'),$_smarty_tpl);?>
" style="background-color:#FFCC99">
	<form id="rolesForm" method="post">
		<ul>
		<?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['role']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->_loop = true;
?>
			<li><label><input type="checkbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ROLE_ID','multi'=>true),$_smarty_tpl);?>
" value="<?php echo $_smarty_tpl->tpl_vars['role']->value->Id;?>
" /> <?php echo $_smarty_tpl->tpl_vars['role']->value->Name;?>
</label></li>
		<?php } ?>
		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		
		</ul>
	</form>
</div>
<?php }?>

<div id="groupAdminDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'WhoCanManageThisGroup'),$_smarty_tpl);?>
" style="background-color:#FFCC99">
	<form method="post" id="groupAdminForm">
		<select <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_ADMIN'),$_smarty_tpl);?>
 class="textbox">
			<option value="">-- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
 --</option>
			<?php  $_smarty_tpl->tpl_vars['adminGroup'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adminGroup']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AdminGroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['adminGroup']->key => $_smarty_tpl->tpl_vars['adminGroup']->value) {
$_smarty_tpl->tpl_vars['adminGroup']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['adminGroup']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['adminGroup']->value->Name;?>
</option>
			<?php } ?>
		</select>

		<button type="button" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		
	</form>
</div>
		<button type="button" id="addButton" class="button save" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
</button>
		

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator",'style'=>"display:none;"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/group.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/help.js"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"TableSorter/jquery.tablesorter.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/groupEnhance.js"),$_smarty_tpl);?>



<script type="text/javascript">
	$(document).ready(function() {

	var actions = {
		activate: '<?php echo ManageGroupsActions::Activate;?>
',
		deactivate: '<?php echo ManageGroupsActions::Deactivate;?>
',
		permissions: '<?php echo ManageGroupsActions::Permissions;?>
',
		password: '<?php echo ManageGroupsActions::Password;?>
',
		removeUser: '<?php echo ManageGroupsActions::RemoveUser;?>
',
		addUser: '<?php echo ManageGroupsActions::AddUser;?>
',
		addGroup: '<?php echo ManageGroupsActions::AddGroup;?>
',
		renameGroup: '<?php echo ManageGroupsActions::RenameGroup;?>
',
		deleteGroup: '<?php echo ManageGroupsActions::DeleteGroup;?>
',
		roles: '<?php echo ManageGroupsActions::Roles;?>
',
		groupAdmin: '<?php echo ManageGroupsActions::GroupAdmin;?>
'
	};

	var dataRequests = {
		permissions: 'permissions',
		roles: 'roles',
		groupMembers: 'groupMembers'
	};

	var groupOptions = {
		userAutocompleteUrl: "../ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
		groupAutocompleteUrl: "../ajax/autocomplete.php?type=<?php echo AutoCompleteType::Group;?>
",
		groupsUrl:  "<?php echo $_SERVER['SCRIPT_NAME'];?>
",
		permissionsUrl:  '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		rolesUrl:  '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		submitUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		saveRedirect: '<?php echo $_SERVER['SCRIPT_NAME'];?>
',
		selectGroupUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
?gid=',
		actions: actions,
		dataRequests: dataRequests
	};	
	
	sorting();

	var groupManagement = new GroupManagement(groupOptions);
	groupManagement.init();
	});
</script>
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
