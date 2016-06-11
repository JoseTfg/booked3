<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 16:22:32
         compiled from "/var/www/booked/tpl/support-and-credits.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1551469388575c1ea8523080-08826605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1c20fa73639b33ce6855872822ab026c8368606' => 
    array (
      0 => '/var/www/booked/tpl/support-and-credits.tpl',
      1 => 1465649525,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1551469388575c1ea8523080-08826605',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c1ea85e5326_71775622',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c1ea85e5326_71775622')) {function content_575c1ea85e5326_71775622($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AboutBookedScheduler'),$_smarty_tpl);?>
</h1>

<div id="help">
	<h2><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Support'),$_smarty_tpl);?>
</h2>
	<p>
		<a href="http://www.bookedscheduler.com/">Booked Scheduler Official Project Home</a> |
		<a href="http://php.brickhost.com/forums/">Community Support</a> |
		<a href="http://github.com/JoseTfg/booked3/">Booked Scheduler Project Repository</a>
	</p>
	<h2><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Credits'),$_smarty_tpl);?>
</h2>
	</br>
	<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'OriginalAuthors'),$_smarty_tpl);?>
</h3>
	<p>
		Nick Korbel
		</br>
		Dung Le
		</br>
		Jan Mattila
		</br>
		Paul Menchini
	</p>

	<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ExtendedBy'),$_smarty_tpl);?>
</h3>
	<p>
		José Szklarz de Quesada
	</p>

	<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ThankYou'),$_smarty_tpl);?>
</h3>
	<p>
		Smarty
		</br>
		PEAR
		</br>
		adLDAP
		</br>
		jQuery
		</br>
		FullCalendar
		</br>
		PHPMailer
		</br>
		jscolor
		</br>
		jqplot
		</br>
	</p>
	<h2><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'License'),$_smarty_tpl);?>
</h2>
	<p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'License2'),$_smarty_tpl);?>
</p>
</div>	
	
<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
