<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 15:01:37
         compiled from "/var/www/booked/tpl/Calendar/mycalendar.month.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1875744132575c0bb1e5c1e3-80466782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f096e15fc36c428984b55cf890ebd49d4f338c7a' => 
    array (
      0 => '/var/www/booked/tpl/Calendar/mycalendar.month.tpl',
      1 => 1465490348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1875744132575c0bb1e5c1e3-80466782',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PrevLink' => 0,
    'MonthName' => 0,
    'DisplayDate' => 0,
    'NextLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c0bb1e9d367_17752415',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c0bb1e9d367_17752415')) {function content_575c0bb1e9d367_17752415($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/calendar.css,css/jquery.qtip.min.css,scripts/css/fullcalendar.css,css/schedule.css,scripts/css/jqtree.css','printCssFiles'=>'scripts/css/fullcalendar.print.css'), 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('Calendar/calendar.filter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="calendarHeading">

	<div class="leftFloater">
		<a href="<?php echo $_smarty_tpl->tpl_vars['PrevLink']->value;?>
"><img src="img/arrow_large_left.png" alt="Back" /></a>
		<?php echo $_smarty_tpl->tpl_vars['MonthName']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Year();?>

		<a href="<?php echo $_smarty_tpl->tpl_vars['NextLink']->value;?>
"><img src="img/arrow_large_right.png" alt="Forward" /></a>
	</div>

	<div class="rightFloater">
		<a href="#" onclick="goToday()" alt="Today" title="Today"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Today'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"today.png"),$_smarty_tpl);?>
</a>
		<a href="admin/manage_reservations.php" id="goList" alt="List" title="List"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'List'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"list.png"),$_smarty_tpl);?>
</a>
		<a href="#" onclick="goDay()" alt="Today" title="Today"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Day'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-day.png"),$_smarty_tpl);?>
</a>
		<a href="#" onclick="goWeek()" alt="Week" title="Week"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Week'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-select-week.png"),$_smarty_tpl);?>
</a>
		<a href="#" onclick="goMonth()" alt="View Month" title="View Month"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Month'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-select-month.png"),$_smarty_tpl);?>
</a>
	</div>

	<div class="clear">&nbsp;</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('Calendar/mycalendar.common.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('view'=>'month'), 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
