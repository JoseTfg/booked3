<?php /* Smarty version Smarty-3.1.16, created on 2016-05-16 21:43:51
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Calendar\mycalendar.common.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22496573a22f7a4f9c3-31786577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30f56b7f135f879b8bd610633a929ed75a9e2dd3' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Calendar\\mycalendar.common.tpl',
      1 => 1463417590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22496573a22f7a4f9c3-31786577',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Calendar' => 0,
    'reservation' => 0,
    'blackouts' => 0,
    'blackout' => 0,
    'Timezone' => 0,
    'view' => 0,
    'DisplayDate' => 0,
    'ScheduleId' => 0,
    'ResourceId' => 0,
    'date' => 0,
    'DayNames' => 0,
    'DayNamesShort' => 0,
    'MonthNames' => 0,
    'MonthNamesShort' => 0,
    'TimeFormat' => 0,
    'DateFormat' => 0,
    'FirstDay' => 0,
    'minTime' => 0,
    'maxTime' => 0,
    'myCal' => 0,
    'username' => 0,
    'password' => 0,
    'filename' => 0,
    'UserId' => 0,
    'colorsToSend' => 0,
    'key' => 0,
    'colorToSend' => 0,
    'ResourceGroupsAsJson' => 0,
    'SelectedGroupNode' => 0,
    'CanViewAdmin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_573a22f8229c74_00848243',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573a22f8229c74_00848243')) {function content_573a22f8229c74_00848243($_smarty_tpl) {?>

<div id="calendar"></div>
<div style="display:none;">
<a id="legendHide" href="#" style="float:left;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"script.png"),$_smarty_tpl);?>
Leyenda</a>
<div style="float:left;"> &nbsp|&nbsp</div>
<a id="timeTable" href="#" style="float:left;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"horario.png"),$_smarty_tpl);?>
Horarios</a>
<a id="export" href="#" style="float:right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cloud.png"),$_smarty_tpl);?>
Exportar</a>
<div id="legend_old" style="text-align:center;"></div>
</div>
<div id="dialogDeleteReservation" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Delete"),$_smarty_tpl);?>
>
  <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DeleteReservation"),$_smarty_tpl);?>
</p>
</div>

<div id="dialogDeleteBlackout" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Delete"),$_smarty_tpl);?>
>
  <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"DeleteReservation"),$_smarty_tpl);?>
</p>
</div>

<div id="dialogColors" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Colors"),$_smarty_tpl);?>
>
	<div id="legend" style="text-align:center;"></div>
</div>

<div id="dialogBoundaries" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"TimeTable"),$_smarty_tpl);?>
>
  <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"TimeTableBoundaries"),$_smarty_tpl);?>
</p>
  
  <div id="selects" style="text-align: center;">
  <select id="BeginPeriod" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'BEGIN_PERIOD'),$_smarty_tpl);?>
 class="pulldown input" style="width:150px">
  </select>
  
  <select id="EndPeriod" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'BEGIN_PERIOD'),$_smarty_tpl);?>
 class="pulldown input" style="width:150px">
  </select>
</div>
  
<div id="dialogSucessful" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Update"),$_smarty_tpl);?>
>
  <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationUpdatedSubject"),$_smarty_tpl);?>
</p>
</div>
  
<div id="dialogFailed" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Update"),$_smarty_tpl);?>
>
  <p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationFailed"),$_smarty_tpl);?>
</p>
  </div>
</div>

<div id="hidden" style="visibility:hidden;">
	<form id='myform' method="post">
		<input id="minTime" name="minTime" type="text" value="">
		<input id="maxTime" name="maxTime" type="text" value="">
		<input id="colors" name="colors" type="text" value="">
	</form>
</div>
	
<div id="dialogSubscribe" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Subscription"),$_smarty_tpl);?>
>
	<p><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Subscribe"),$_smarty_tpl);?>
</p>
</div>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservationPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"calendar.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/fullcalendar.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/tree.jquery.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/moment.min.js"),$_smarty_tpl);?>



<link rel="stylesheet" href="scripts/Popup-master/assets/css/popup.css">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"Popup-master/assets/js/jquery.popup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"jscolor-2.0.4/jscolor.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/calendarEnhance.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/createEnhance.js"),$_smarty_tpl);?>



<script type="text/javascript">
$(document).ready(function() {
	
	var reservations = [];
	
	<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Calendar']->value->Reservations(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
		reservations.push({
			id: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',
			
			title: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceName;?>
',
			start: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['format_date'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->StartDate,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			end: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['format_date'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->EndDate,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			/*url: 'reservation.php?rn=<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',*/
			allDay: false,
			color: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Color;?>
',
			textColor: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->TextColor;?>
',
			className: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Class;?>
',
			colorID:'<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceName;?>
',
			trueTitle: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Title;?>
',
			owner: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->OwnerName;?>
'
		});		
	<?php } ?>
	
	<?php  $_smarty_tpl->tpl_vars['blackout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blackout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blackouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blackout']->key => $_smarty_tpl->tpl_vars['blackout']->value) {
$_smarty_tpl->tpl_vars['blackout']->_loop = true;
?>
		reservations.push({
			id: '<?php echo $_smarty_tpl->tpl_vars['blackout']->value->InstanceId;?>
',
			title: '<?php echo $_smarty_tpl->tpl_vars['blackout']->value->ResourceName;?>
',
			start: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['blackout']->value->StartDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
',
			end: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['blackout']->value->EndDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
',
			allDay: false,
			color: '#202020 ',
			textColor: '#F0099CC',
			className: 'blackout',
			colorID:'<?php echo $_smarty_tpl->tpl_vars['blackout']->value->Title;?>
'
		});
		
	<?php } ?>

	var options = {
					view: '<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
',
					year: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Year();?>
,
					month: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Month();?>
,
					date: <?php echo $_smarty_tpl->tpl_vars['DisplayDate']->value->Day();?>
,
					dayClickUrl: '<?php echo Pages::RESERVATION;?>
?sid=<?php echo $_smarty_tpl->tpl_vars['ScheduleId']->value;?>
&rid=<?php echo $_smarty_tpl->tpl_vars['ResourceId']->value;?>
&rd=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['date']->value,'key'=>'url'),$_smarty_tpl);?>
',
					dayNames: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['DayNames']->value),$_smarty_tpl);?>
,
					dayNamesShort: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['DayNamesShort']->value),$_smarty_tpl);?>
,
					monthNames: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['MonthNames']->value),$_smarty_tpl);?>
,
					monthNamesShort: <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js_array'][0][0]->CreateJavascriptArray(array('array'=>$_smarty_tpl->tpl_vars['MonthNamesShort']->value),$_smarty_tpl);?>
,
					timeFormat: '<?php echo $_smarty_tpl->tpl_vars['TimeFormat']->value;?>
',
					dayMonth: '<?php echo $_smarty_tpl->tpl_vars['DateFormat']->value;?>
',
					firstDay: <?php echo $_smarty_tpl->tpl_vars['FirstDay']->value;?>
,
					
					minTime: '<?php echo $_smarty_tpl->tpl_vars['minTime']->value;?>
',
					maxTime: '<?php echo $_smarty_tpl->tpl_vars['maxTime']->value;?>
',
					myCal: '<?php echo $_smarty_tpl->tpl_vars['myCal']->value;?>
',
					username: '<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
',
					password: '<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
',
					filename: '<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
',
					readOnly: '<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
'
				};
	
	<?php  $_smarty_tpl->tpl_vars['colorToSend'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['colorToSend']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['colorsToSend']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['colorToSend']->key => $_smarty_tpl->tpl_vars['colorToSend']->value) {
$_smarty_tpl->tpl_vars['colorToSend']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['colorToSend']->key;
?>
		sessionStorage.setItem('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['colorToSend']->value;?>
');
	<?php } ?>	
	
	var calendar = new Calendar(options, reservations);	
	calendar.init();
	calendar.bindResourceGroups(<?php echo $_smarty_tpl->tpl_vars['ResourceGroupsAsJson']->value;?>
, <?php echo (($tmp = @$_smarty_tpl->tpl_vars['SelectedGroupNode']->value)===null||$tmp==='' ? 0 : $tmp);?>
);	
	
	enhanceCalendar(options, reservations);
	<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
		sessionStorage.setItem('isAdmin', <?php echo $_smarty_tpl->tpl_vars['CanViewAdmin']->value;?>
);
	<?php } else { ?>
		sessionStorage.setItem('isAdmin', '0');
	<?php }?>
});
</script>	





	
	



<?php }} ?>
