<?php /* Smarty version Smarty-3.1.16, created on 2016-03-02 01:12:41
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Calendar\calendar.filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:184456d62ff96108c7-73972387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fb0b1aede3655243add1477ec2e9d671176659a' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Calendar\\calendar.filter.tpl',
      1 => 1456876389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184456d62ff96108c7-73972387',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GroupName' => 0,
    'filters' => 0,
    'filter' => 0,
    'subfilter' => 0,
    'myCal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_56d62ff9627fd4_28605469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d62ff9627fd4_28605469')) {function content_56d62ff9627fd4_28605469($_smarty_tpl) {?>
<table id="myTable">
<tr>
<td>
<div id="filter">
	<?php if ($_smarty_tpl->tpl_vars['GroupName']->value) {?>
		<span class="groupName"><?php echo $_smarty_tpl->tpl_vars['GroupName']->value;?>
</span>
	<?php } else { ?>
<label for="calendarFilter"></label>
<select id="calendarFilter" class="styled-select2">
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
" class="resource" <?php if ($_smarty_tpl->tpl_vars['subfilter']->value->Selected()) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['subfilter']->value->Name();?>
</option>
	<?php } ?>
<?php } ?>
	<?php }?>
</select>
</div>

</td>
<td>

<link rel="stylesheet" type="text/css" href="css/propio.css">

<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if (($_smarty_tpl->tpl_vars['myCal']->value!=1)) {?>checked="checked"<?php }?>>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner" ></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>

<div id="resourceGroupsContainer">
	<div id="resourceGroups"></div>
</div>

</td>
</tr>
</table>   <?php }} ?>
