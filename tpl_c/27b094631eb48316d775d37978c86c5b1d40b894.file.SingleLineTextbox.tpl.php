<?php /* Smarty version Smarty-3.1.16, created on 2016-05-16 20:57:20
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Controls\Attributes\SingleLineTextbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6930573a1810b992d8-17919715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27b094631eb48316d775d37978c86c5b1d40b894' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Controls\\Attributes\\SingleLineTextbox.tpl',
      1 => 1460888683,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6930573a1810b992d8-17919715',
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
  'unifunc' => 'content_573a1810bacb64_76105563',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573a1810bacb64_76105563')) {function content_573a1810bacb64_76105563($_smarty_tpl) {?>
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
