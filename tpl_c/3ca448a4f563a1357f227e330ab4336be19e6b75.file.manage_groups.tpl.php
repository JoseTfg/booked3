<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 15:01:36
         compiled from "/var/www/booked/tpl/Admin/manage_groups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1980869190575c0bb084efe4-84473993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ca448a4f563a1357f227e330ab4336be19e6b75' => 
    array (
      0 => '/var/www/booked/tpl/Admin/manage_groups.tpl',
      1 => 1465648439,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1980869190575c0bb084efe4-84473993',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CanChangeRoles' => 0,
    'groups' => 0,
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
  'unifunc' => 'content_575c0bb0981fe6_81071896',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c0bb0981fe6_81071896')) {function content_575c0bb0981fe6_81071896($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/admin.css'), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ManageGroups'),$_smarty_tpl);?>
 </h1>

<table id="groupTable" class="list">
	<thead>
		<th class="id">&nbsp;</th>
		<th><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
</th>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Members'),$_smarty_tpl);?>
</th>		
		<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
			<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Roles'),$_smarty_tpl);?>
</th>
		<?php }?>	
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Permissions2'),$_smarty_tpl);?>
</th>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</th>
	</thead>
	<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
		<tr>
			<td class="id"><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
"/></td>
			<td align="center" id="<?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
" ><a href="#" class="update rename"><?php echo $_smarty_tpl->tpl_vars['group']->value->Name;?>
</a></td>
			<td width="100px" align="center">
				<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!="2") {?>
					<a href="#" class="update members"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					--
				<?php }?>
			</td>		
			<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
				<td width="100px" align="center">
					<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2!="2") {?>
						<a href="#" class="update roles"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a>
					<?php } else { ?>
						--
					<?php }?>
				</td>
			<?php }?>		
			<td width="100px" align="center">
				<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3!="2") {?>
					<a href="#" class="update permissions"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'my_edit.png'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					--
				<?php }?>
			</td>
			<td width="100px" align="center">
				<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['group']->value->Id;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4!="2") {?>
					<a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a>
				<?php } else { ?>
					--
				<?php }?>
			</td>
		</tr>
	<?php } ?>
</table>

<div class="pagination">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['pagination'][0][0]->CreatePagination(array('pageInfo'=>$_smarty_tpl->tpl_vars['PageInfo']->value),$_smarty_tpl);?>

</div>

<input type="hidden" id="activeId" />

<div id="membersDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupMembers'),$_smarty_tpl);?>
">
	<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoneSelected'),$_smarty_tpl);?>
</div>
	<div id="addedMembers"></div>
	<div id="removedMembers"></div>
	<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSelected'),$_smarty_tpl);?>
</div>
</div>

<div id="permissionsDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Permissions'),$_smarty_tpl);?>
">
	<form class="hiddenForm" id="permissionsForm" method="post">
		<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UserPermissionInfo'),$_smarty_tpl);?>
</div>
		<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
			<label>
				<input <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ID','multi'=>true),$_smarty_tpl);?>
 class="resourceId" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetResourceId();?>
"> <?php echo $_smarty_tpl->tpl_vars['resource']->value->GetName();?>

			</label>
			<br/>
		<?php } ?>
		<div class="admin-update-buttons">
			<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		</div>
	</form>

	<div id="resourceList" class="hidden">
		<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
			<div class="resource-item" resourceId="<?php echo $_smarty_tpl->tpl_vars['resource']->value->GetResourceId();?>
"><a href="#">&nbsp;</a> <span><?php echo $_smarty_tpl->tpl_vars['resource']->value->GetName();?>
</span></div>
		<?php } ?>
	</div>

	<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoneSelected'),$_smarty_tpl);?>
</div>
	<div id="addedResources"></div>
	<div id="removedResources"></div>
	<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSelected'),$_smarty_tpl);?>
</div>
</div>

<form id="removeUserForm" method="post">
	<input type="hidden" id="removeUserId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>
 />
</form>

<form id="addUserForm" method="post">
	<input type="hidden" id="addUserId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>
 />
</form>

<div id="deleteDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteGroupForm" method="post">
		<div class="error" id="marginError">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
			<div><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteGroupWarning'),$_smarty_tpl);?>
</div>
		</div>
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
	</form>
</div>

<div id="renameDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
">
	<form id="renameGroupForm" method="post">
		<input type="text" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Name'),$_smarty_tpl);?>
" class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_NAME'),$_smarty_tpl);?>
 /></label>
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Rename'),$_smarty_tpl);?>
</button>
	</form>
</div>

<div id="addDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
">
	<div id="addGroupResults" class="error"></div>
	<form id="addGroupForm" method="post">
		<input placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupName'),$_smarty_tpl);?>
" type="text" class="textbox required" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'GROUP_NAME'),$_smarty_tpl);?>
 />
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
</button>
	</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['CanChangeRoles']->value) {?>
	<div id="rolesDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Roles'),$_smarty_tpl);?>
">
		<form class="hiddenForm" id="rolesForm" method="post">
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
				<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
			</ul>
		</form>
		<div id="roleList" class="hidden">
			<?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['role']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['role']->value->Id=='2') {?> 
					<div class="role-item" roleId="<?php echo $_smarty_tpl->tpl_vars['role']->value->Id;?>
"><a href="#">&nbsp;</a> <span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AppAdmin'),$_smarty_tpl);?>
</span></div>
				<?php } else { ?>
					<div class="role-item" roleId="<?php echo $_smarty_tpl->tpl_vars['role']->value->Id;?>
"><a href="#">&nbsp;</a> <span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResAdmin'),$_smarty_tpl);?>
</span></div>
				<?php }?>
			<?php } ?>
		</div>
		<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'NoneSelected'),$_smarty_tpl);?>
</div>
		<div id="addedRoles"></div>
		<div id="removedRoles"></div>
		<div class="hiddenDiv" style="text-align:center;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSelected'),$_smarty_tpl);?>
</div>
	</div>
<?php }?>

<div id="groupAdminDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'WhoCanManageThisGroup'),$_smarty_tpl);?>
">
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
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
	</form>
</div>
<button type="button" id="addButton" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"plus-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddGroup'),$_smarty_tpl);?>
</button>

<div class="hiddenDiv">
	<input id="adminString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Superuser"),$_smarty_tpl);?>
">
	<input id="resourceString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ResourceAdministrator"),$_smarty_tpl);?>
">
</div>	
	
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/group.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>



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
