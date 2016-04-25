<?php /* Smarty version Smarty-3.1.16, created on 2016-04-23 20:24:56
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\globalfooter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16125571bbdf8b9dd91-02838097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4206b4a8e48c3dca67ed638b3a1bbd4e2c71085c' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\globalfooter.tpl',
      1 => 1461070753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16125571bbdf8b9dd91-02838097',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LoggedIn' => 0,
    'Announcements' => 0,
    'each' => 0,
    'Version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_571bbdf8bb5496_96037819',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571bbdf8bb5496_96037819')) {function content_571bbdf8bb5496_96037819($_smarty_tpl) {?>
	</div><!-- close content-->
	</div><!-- close doc-->
	<div class="push">&nbsp;</div>
	</div><!-- close wrapper-->

<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"dashboard.js"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function() {
	var dashboardOpts = {};
	var dashboard = new Dashboard(dashboardOpts);
	dashboard.init();
});
</script>
<?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value) {?>
<div class="dashboard" id="announcementsDashboard">
	<div id="announcementsHeader" class="dashboardHeader">
		<a href="javascript:void(0);" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ShowHide'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Announcements"),$_smarty_tpl);?>
</a>
	</div>
	<div class="dashboardContents" style="display:none">
		<ul>
			<?php  $_smarty_tpl->tpl_vars['each'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['each']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['each']->key => $_smarty_tpl->tpl_vars['each']->value) {
$_smarty_tpl->tpl_vars['each']->_loop = true;
?>
			    <li><?php echo nl2br($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['url2link'][0][0]->CreateUrl(html_entity_decode($_smarty_tpl->tpl_vars['each']->value)));?>
</li>
			<?php }
if (!$_smarty_tpl->tpl_vars['each']->_loop) {
?>
				<div class="noresults"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NoAnnouncements"),$_smarty_tpl);?>
</div>
			<?php } ?>
		</ul>
	</div>
</div>
	</body>
	<?php } else { ?>
	<div class="page-footer">
			&copy; 2015 <a href="http://www.twinkletoessoftware.com">Twinkle Toes Software</a> <br/><a href="http://www.bookedscheduler.com">Booked Scheduler v<?php echo $_smarty_tpl->tpl_vars['Version']->value;?>
</a>
    	</div>
	<?php }?>
</html><?php }} ?>
