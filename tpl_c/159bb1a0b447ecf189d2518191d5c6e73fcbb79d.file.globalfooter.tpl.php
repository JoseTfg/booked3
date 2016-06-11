<?php /* Smarty version Smarty-3.1.16, created on 2016-06-01 21:57:10
         compiled from "/var/www/booked/tpl/globalfooter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:604241232574f3e169d6ae9-26807362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '159bb1a0b447ecf189d2518191d5c6e73fcbb79d' => 
    array (
      0 => '/var/www/booked/tpl/globalfooter.tpl',
      1 => 1464806444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '604241232574f3e169d6ae9-26807362',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LoggedIn' => 0,
    'Announcements' => 0,
    'each' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_574f3e169f23e6_32810385',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574f3e169f23e6_32810385')) {function content_574f3e169f23e6_32810385($_smarty_tpl) {?>
	</div><!-- close content-->
	</div><!-- close doc-->
	<div class="push">&nbsp;</div>
	</div><!-- close wrapper-->

	
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"dashboard.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/marquee.js"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function() {
	var dashboardOpts = {};
	var dashboard = new Dashboard(dashboardOpts);
	dashboard.init();
});

</script>
<?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value) {?>
	<div id="announcementsHeader" class="dashboardHeader">
		<marquee id="marquee" behavior="scroll" scrollamount="5" direction="left" onmousedown="this.stop();" onmouseup="this.start();">
			<?php  $_smarty_tpl->tpl_vars['each'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['each']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Announcements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['each']->key => $_smarty_tpl->tpl_vars['each']->value) {
$_smarty_tpl->tpl_vars['each']->_loop = true;
?>
				| <?php echo nl2br($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['url2link'][0][0]->CreateUrl(html_entity_decode($_smarty_tpl->tpl_vars['each']->value)));?>

			<?php }
if (!$_smarty_tpl->tpl_vars['each']->_loop) {
?>
				| <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NoAnnouncements"),$_smarty_tpl);?>

			<?php } ?>
			|
		</marquee>
	</div>
<?php } else { ?>
	<div class="page-footer">
		&copy; 2011-2016 &nbsp;<a href="http://github.com/JoseTfg/booked3">Booked Scheduler Enhanced v0.9</a>
    </div>
<?php }?>
</html><?php }} ?>
