<?php /* Smarty version Smarty-3.1.16, created on 2016-03-02 01:12:41
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\globalfooter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2120256d62ff969d2e7-85812176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4206b4a8e48c3dca67ed638b3a1bbd4e2c71085c' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\globalfooter.tpl',
      1 => 1450328288,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2120256d62ff969d2e7-85812176',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Version' => 0,
    'GoogleAnalyticsTrackingId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_56d62ff96a4ff0_69743692',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d62ff96a4ff0_69743692')) {function content_56d62ff96a4ff0_69743692($_smarty_tpl) {?>
	</div><!-- close content-->
	</div><!-- close doc-->
	<div class="push">&nbsp;</div>
	</div><!-- close wrapper-->

    	<div class="page-footer">
			&copy; 2015 <a href="http://www.twinkletoessoftware.com">Twinkle Toes Software</a> <br/><a href="http://www.bookedscheduler.com">Booked Scheduler v<?php echo $_smarty_tpl->tpl_vars['Version']->value;?>
</a>
    	</div>

	<?php if (!empty($_smarty_tpl->tpl_vars['GoogleAnalyticsTrackingId']->value)) {?>
		
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  
			  ga('create', '<?php echo $_smarty_tpl->tpl_vars['GoogleAnalyticsTrackingId']->value;?>
', 'auto');
			  ga('send', 'pageview');
			</script>
	<?php }?>
	</body>
</html><?php }} ?>
