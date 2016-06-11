<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 17:49:22
         compiled from "/var/www/booked/tpl/Controls/Attributes/SingleLineTextbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120258042575c33021f9d63-51489031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71253660e9f0daea754767426765fe16b1742133' => 
    array (
      0 => '/var/www/booked/tpl/Controls/Attributes/SingleLineTextbox.tpl',
      1 => 1464803142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120258042575c33021f9d63-51489031',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'readonly' => 0,
    'class' => 0,
    'attribute' => 0,
    'attributeId' => 0,
    'attributeName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c3302215046_23400050',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c3302215046_23400050')) {function content_575c3302215046_23400050($_smarty_tpl) {?>
<table style="align: center;">
	<tr style="align: center;">
		<td style="align: center;">
		<?php if ($_smarty_tpl->tpl_vars['readonly']->value) {?>
			<span class="attributeValue <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Value(), ENT_QUOTES, 'UTF-8', true);?>
</span>
		<?php } else { ?>
			<input type="text" placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Label(), ENT_QUOTES, 'UTF-8', true);?>
" id="<?php echo $_smarty_tpl->tpl_vars['attributeId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['attributeName']->value;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attribute']->value->Value(), ENT_QUOTES, 'UTF-8', true);?>
" class="customAttribute textbox <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" />
		<?php }?>
		</td>
	</tr>
</table><?php }} ?>
