<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 15:01:37
         compiled from "/var/www/booked/tpl/Calendar/mycalendar.common.tpl" */ ?>
<?php /*%%SmartyHeaderCode:454448691575c0bb1eec021-16302980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bbd8b60451f466737b53980913764000e714036' => 
    array (
      0 => '/var/www/booked/tpl/Calendar/mycalendar.common.tpl',
      1 => 1465648903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '454448691575c0bb1eec021-16302980',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'resources' => 0,
    'resource' => 0,
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
    'weekends' => 0,
    'isAdmin' => 0,
    'format' => 0,
    'colorsToSend' => 0,
    'key' => 0,
    'colorToSend' => 0,
    'ResourceGroupsAsJson' => 0,
    'SelectedGroupNode' => 0,
    'CanViewAdmin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c0bb20db708_96332553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c0bb20db708_96332553')) {function content_575c0bb20db708_96332553($_smarty_tpl) {?>

<div id="calendar"></div>

<div id="dialogDeleteReservation" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Delete"),$_smarty_tpl);?>
>
	<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</div>
	</br>
	<button id="deleteReservation" type="button" class="button deleteReservation"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
</div>

<div id="dialogDeleteBlackout" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Delete"),$_smarty_tpl);?>
>
	<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</div>
	</br>
	<button id="deleteBlackout" type="button" class="button deleteBlackout"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
</div>

<div id="dialogColors" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Colors"),$_smarty_tpl);?>
>
	<form id='colorForm' method="post">
		<div id="legend">
			<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
				<input type='button' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resource']->value->GetName(), ENT_QUOTES, 'UTF-8', true);?>
' class="jscolor">&nbsp<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resource']->value->GetName(), ENT_QUOTES, 'UTF-8', true);?>
</input>
				<input id="color#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resource']->value->GetName(), ENT_QUOTES, 'UTF-8', true);?>
" name="color#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resource']->value->GetName(), ENT_QUOTES, 'UTF-8', true);?>
" type="hidden" value="">
				</br></br>
			<?php } ?>
		</div>	
		<button type="button" class="button colors"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
	</form>
</div>

<div id="dialogBoundaries" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"TimeTable"),$_smarty_tpl);?>
>
	<form id='timeForm' method="post">
		<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'TimeTableBoundaries'),$_smarty_tpl);?>
</div>
		</br>
		<div id="selects">
			<select name = "minTime" style="text-align-last:center;width:150px;" id="BeginPeriod" class="pulldown input"></select>
			-
			<select name = "maxTime" style="text-align-last:center;width:150px;" id="EndPeriod" class="pulldown input"></select>
			</br></br>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FirstDay'),$_smarty_tpl);?>
&nbsp;&nbsp;&nbsp;-
			<select name="firstDay" style="text-align-last:center;width:150px" id="firstDay" class="pulldown input" disabled>
				<option value="1"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Monday'),$_smarty_tpl);?>
</option>
				<option value="2"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Tuesday'),$_smarty_tpl);?>
</option>
				<option value="3"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Wednesday'),$_smarty_tpl);?>
</option>
				<option value="4"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Thursday'),$_smarty_tpl);?>
</option>
				<option value="5"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Friday'),$_smarty_tpl);?>
</option>
				<option value="6"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Saturday'),$_smarty_tpl);?>
</option>
				<option value="0"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Sunday'),$_smarty_tpl);?>
</option>
			</select>		
			</br></br>
			<span>
				<input id="format1" name="format" checked="checked" type="radio" value="1"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Format12'),$_smarty_tpl);?>
</input>
				<input id="format2" name="format" type="radio" value="2"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Format24'),$_smarty_tpl);?>
</input>
			</span>
			</br></br>
			<input id="weekends" name="weekends" type="checkbox" value="1"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Weekends'),$_smarty_tpl);?>
</input>
			</br></br>
			<button type="button" class="button timeTable"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Update'),$_smarty_tpl);?>
</button>
		</div>
	</form>
</div>
	
<div id="dialogSubscribe" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Subscription"),$_smarty_tpl);?>
>
	<div class="warning"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Subscribe'),$_smarty_tpl);?>
</div>
	</br>
	<button type="button" class="button export"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-arrow.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Export'),$_smarty_tpl);?>
</button>
	<button type="button" class="button gcalendar"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"google.png"),$_smarty_tpl);?>
 GCalendar</button>
</div>

<div id="reservationColorbox" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CreateReservationHeading"),$_smarty_tpl);?>
></div>

<div class="hiddenDiv" id="strings">
	<input id="createString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Create"),$_smarty_tpl);?>
">
	<input id="editString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CheckReservation"),$_smarty_tpl);?>
">
	<input id="deleteString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Delete"),$_smarty_tpl);?>
">
	<input id="goDayString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"GoDay"),$_smarty_tpl);?>
">
	<input id="goWeekString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"GoWeek"),$_smarty_tpl);?>
">
	<input id="checkAllString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"checkAll"),$_smarty_tpl);?>
">
	<input id="uncheckAllString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"uncheckAll"),$_smarty_tpl);?>
">
	<input id="selectOptionsString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"selectOptions"),$_smarty_tpl);?>
">
	<input id="selectTextString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"selectText"),$_smarty_tpl);?>
">
	<input id="warningString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"FieldWarning"),$_smarty_tpl);?>
">
	<input id="pendingString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Pending"),$_smarty_tpl);?>
">
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

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"admin.css"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/createEnhance.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/manageBlackoutsEnhance.js"),$_smarty_tpl);?>



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
			start: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['blackout']->value->StartDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			end: '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['blackout']->value->EndDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'fullcalendar'),$_smarty_tpl);?>
',
			allDay: false,
			color: '#202020',
			textColor: '#F0099CC',
			className: 'blackout',
			colorID:'<?php echo $_smarty_tpl->tpl_vars['blackout']->value->ResourceName;?>
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
',
					weekends: '<?php echo $_smarty_tpl->tpl_vars['weekends']->value;?>
',
					isAdmin: '<?php echo $_smarty_tpl->tpl_vars['isAdmin']->value;?>
',
					format: '<?php echo $_smarty_tpl->tpl_vars['format']->value;?>
'
				};
	
	if (options.isAdmin == ""){
		options.isAdmin = 0;
	}
	
	if (options.format == "2"){
		options.timeFormat = "HH:mm";
	}
	
	if (options.weekends == "1"){
		options.weekends = true;
	}
	else{
		options.weekends = false;
	}
	
	if (options.firstDay == ""){
		options.FirstDay = "0";
	}
	
	if (options.minTime == "" || options.maxTime == ""){
		options.minTime = "10:00";
		options.maxTime = "20:00";
	}
	
	if (options.password.indexOf('blank') != -1){
		options.username = sessionStorage.getItem('username');
		options.password = sessionStorage.getItem('password');
	}
	
	sessionStorage.setItem('username', options.username);
	sessionStorage.setItem('password', options.password);
	
	<?php  $_smarty_tpl->tpl_vars['colorToSend'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['colorToSend']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['colorsToSend']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['colorToSend']->key => $_smarty_tpl->tpl_vars['colorToSend']->value) {
$_smarty_tpl->tpl_vars['colorToSend']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['colorToSend']->key;
?>
		<?php if ($_smarty_tpl->tpl_vars['key']->value!='') {?>
			if (document.getElementById('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
') != null){
				sessionStorage.setItem('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['colorToSend']->value;?>
');
				document.getElementById('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').value = "'<?php echo $_smarty_tpl->tpl_vars['colorToSend']->value;?>
'";
			}
		<?php }?>
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
