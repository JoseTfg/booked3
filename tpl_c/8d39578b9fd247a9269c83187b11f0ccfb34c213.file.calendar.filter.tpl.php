<?php /* Smarty version Smarty-3.1.16, created on 2016-06-01 21:57:19
         compiled from "/var/www/booked/tpl/Calendar/calendar.filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:314244508574f3e1fb6e0d4-99102577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d39578b9fd247a9269c83187b11f0ccfb34c213' => 
    array (
      0 => '/var/www/booked/tpl/Calendar/calendar.filter.tpl',
      1 => 1464802799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '314244508574f3e1fb6e0d4-99102577',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GroupName' => 0,
    'filters' => 0,
    'filter' => 0,
    'subfilter' => 0,
    'UserId' => 0,
    'myCal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_574f3e1fb9f7f9_23096408',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574f3e1fb9f7f9_23096408')) {function content_574f3e1fb9f7f9_23096408($_smarty_tpl) {?>


<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/jquery.multiselect.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/prettify.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/jquery.multiselect.filter.js"),$_smarty_tpl);?>


<table id="CalendarFilterTable">
	<tr>
		<td>
		<div id="filter">
			<?php if ($_smarty_tpl->tpl_vars['GroupName']->value) {?>
				<span class="groupName"><?php echo $_smarty_tpl->tpl_vars['GroupName']->value;?>
</span>
			<?php } else { ?>
				<label for="calendarFilter"></label>
				<select id="calendarFilter"  multiple="multiple">
					<?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['filter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filters']->value->GetFilters(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value) {
$_smarty_tpl->tpl_vars['filter']->_loop = true;
?>
						<?php  $_smarty_tpl->tpl_vars['subfilter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subfilter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filter']->value->GetFilters(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subfilter']->key => $_smarty_tpl->tpl_vars['subfilter']->value) {
$_smarty_tpl->tpl_vars['subfilter']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['subfilter']->value->Id();?>
" class="resource" ><?php echo $_smarty_tpl->tpl_vars['subfilter']->value->Name();?>
</option>
						<?php } ?>
					<?php } ?>
				</select>
			<?php }?>
		</div>
		</td>
		<td>
		<?php if ($_smarty_tpl->tpl_vars['UserId']->value!="1") {?>
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if (($_smarty_tpl->tpl_vars['myCal']->value!=1)) {?>checked="checked"<?php }?>>
				<label class="onoffswitch-label" for="myonoffswitch">
					<span class="onoffswitch-inner" ></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
		<?php } else { ?>
			<div class="onoffswitch" style="display:none;">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if (($_smarty_tpl->tpl_vars['myCal']->value!=1)) {?>checked="checked"<?php }?>>
				<label class="onoffswitch-label" for="myonoffswitch">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
		<?php }?>
		<div id="resourceGroupsContainer">
			<div id="resourceGroups"></div>
		</div>
		</td>
	</tr>
</table>   <?php }} ?>
