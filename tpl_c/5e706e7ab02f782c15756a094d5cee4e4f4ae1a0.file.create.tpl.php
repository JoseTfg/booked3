<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 15:01:39
         compiled from "/var/www/booked/tpl/Reservation/create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:502711185575c0bb3f2c248-86344687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e706e7ab02f782c15756a094d5cee4e4f4ae1a0' => 
    array (
      0 => '/var/www/booked/tpl/Reservation/create.tpl',
      1 => 1465650076,
      2 => 'file',
    ),
    '35613f58d3be9cb3acae54c0f030039509da77ef' => 
    array (
      0 => '/var/www/booked/tpl/globalheader.tpl',
      1 => 1465578392,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '502711185575c0bb3f2c248-86344687',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'false' => 0,
    'UserId' => 0,
    'ReservationUserName' => 0,
    'ResourceId' => 0,
    'ResourceName' => 0,
    'AvailableResources' => 0,
    'resource' => 0,
    'CanViewAdmin' => 0,
    'ScheduleId' => 0,
    'StartDate' => 0,
    'StartPeriods' => 0,
    'period' => 0,
    'SelectedStart' => 0,
    'selected' => 0,
    'EndDate' => 0,
    'EndPeriods' => 0,
    'SelectedEnd' => 0,
    'HideRecurrence' => 0,
    'RepeatTerminationDate' => 0,
    'Description' => 0,
    'ReservationId' => 0,
    'ReferenceNumber' => 0,
    'ReservationAction' => 0,
    'UploadsEnabled' => 0,
    'AdditionalResourceIds' => 0,
    'checked' => 0,
    'AvailableAccessories' => 0,
    'accessory' => 0,
    'ReturnUrl' => 0,
    'MaxUploadCount' => 0,
    'RepeatType' => 0,
    'RepeatInterval' => 0,
    'RepeatMonthlyType' => 0,
    'RepeatWeekdays' => 0,
    'day' => 0,
    'ReminderTimeStart' => 0,
    'ReminderTimeEnd' => 0,
    'ReminderIntervalStart' => 0,
    'ReminderIntervalEnd' => 0,
    'Participants' => 0,
    'user' => 0,
    'Invitees' => 0,
    'Accessories' => 0,
    'ResourceGroupsAsJson' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c0bb4306591_41902669',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c0bb4306591_41902669')) {function content_575c0bb4306591_41902669($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/booked/lib/Common/../../lib/external/Smarty/plugins/modifier.truncate.php';
?>

	<?php /*  Call merged included template "globalheader.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'css/reservation.css,css/jquery.qtip.min.css,scripts/css/jqtree.css'), 0, '502711185575c0bb3f2c248-86344687');
content_575c0bb40001e0_79476466($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "globalheader.tpl" */?>


<div id="reservationbox"> 
	<form id="reservationForm" method="post" enctype="multipart/form-data">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

		<div class="clear"></div>
		<div id="result"></div>
		<div id="reservationDetails" class="details">
			<ul style="text-align:center;" class="no-style">
				<?php if ($_smarty_tpl->tpl_vars['false']->value) {?>
					<button id="promptForChangeUsers" type="button" style="display:inline;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"users.png"),$_smarty_tpl);?>
</button>
					<div id="changeUserDialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ChangeUser'),$_smarty_tpl);?>
" class="dialog"></div>
				<?php }?>
				<a style="font-size:14px" id="userName" data-userid="<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['ReservationUserName']->value,25,"...",true);?>
</a> <input id="userId"
																		 type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'USER_ID'),$_smarty_tpl);?>

																		 value="<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
"/>
			</ul>
			<br/>
			<ul class="no-style" style="text-align: center">
				<li class="inline">		
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>

					</br>
					<select class="pulldown input" id="filter" style="width:230px;font-size: 12px;text-align-last:center;">
						<option value="<?php echo $_smarty_tpl->tpl_vars['ResourceId']->value;?>
" selected><?php echo $_smarty_tpl->tpl_vars['ResourceName']->value;?>
</option>
						<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AvailableResources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
							<?php if ($_smarty_tpl->tpl_vars['ResourceName']->value!=$_smarty_tpl->tpl_vars['resource']->value->Name) {?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['resource']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['resource']->value->Name;?>
</option>
							<?php }?>
						<?php } ?>
					</select>
					</br>
					<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
						<div id="blackDiv" style="display:none">
							<input id="blackoutCheckBox" type="checkbox" value="blackoutCheckBox" onclick="blackoutTick()"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Blackout'),$_smarty_tpl);?>

						</div>
					<?php } else { ?>
						<div id="blackDiv" style="display:none"></div>
					<?php }?>
				</li>
			</ul>
		<ul class="no-style" >
		<input id="resourceId" class="resourceId" type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'RESOURCE_ID'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ResourceId']->value;?>
"/>
		<input type="hidden" id="scheduleId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SCHEDULE_ID'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ScheduleId']->value;?>
"/>

        </li>
        <li style="text-align: center">
		</br>
            
            <input style="font-size: 12px;text-align: center;height: 16px;" type="text" id="BeginDate" class="dateinput" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>
"/>
            <input type="hidden" id="formattedBeginDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'BEGIN_DATE'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
			-
			<select id="BeginPeriod" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'BEGIN_PERIOD'),$_smarty_tpl);?>
 class="pulldown input" style="width:108px;font-size: 12px;text-align-last:center;">
			<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StartPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['period']->value->IsReservable()) {?>
					<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable('', null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedStart']->value) {?>
						<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable(' selected="selected"', null, 0);?>
					<?php }?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['period']->value->Begin();?>
"<?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
><?php echo $_smarty_tpl->tpl_vars['period']->value->Label();?>
</option>
				<?php }?>
			<?php } ?>
            </select>			          
        </li>		
        <li style="text-align: center">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Until'),$_smarty_tpl);?>

		<br/>
            
			<input style="font-size: 12px;text-align: center;height: 16px;" type="text" id="EndDate" class="dateinput" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>
"/>
            <input type="hidden" id="formattedEndDate" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'END_DATE'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>  
			-
            <select id="EndPeriod" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'END_PERIOD'),$_smarty_tpl);?>
 class="pulldown input" style="width:108px;font-size: 12px;text-align-last:center;">
			<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EndPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['period']->value->BeginDate()->IsMidnight()) {?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['period']->value->Begin();?>
"<?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
><?php echo $_smarty_tpl->tpl_vars['period']->value->Label();?>
</option>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['period']->value->IsReservable()) {?>
					<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable('', null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedEnd']->value) {?>
						<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable(' selected="selected"', null, 0);?>
					<?php }?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['period']->value->End();?>
"<?php echo $_smarty_tpl->tpl_vars['selected']->value;?>
><?php echo $_smarty_tpl->tpl_vars['period']->value->LabelEnd();?>
</option>
				<?php }?>
			<?php } ?>
            </select>
        </li>
        <li style="text-align: center">
            
        </li>
	<br/>
	
	<?php if ($_smarty_tpl->tpl_vars['HideRecurrence']->value) {?>
        <li style="display:none">
			<?php } else { ?>
    <li id="recurrence" style="text-align:center;">
	<?php }?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"RecurrenceControl",'RepeatTerminationDate'=>$_smarty_tpl->tpl_vars['RepeatTerminationDate']->value),$_smarty_tpl);?>

	</li>
	
	
        <li class="rsv-box-l" style="text-align: center">
			<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationTitle"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['textbox'][0][0]->Textbox(array('id'=>"title",'style'=>"width:230px;",'name'=>"RESERVATION_TITLE",'placeholder'=>$_tmp1,'class'=>"input",'tabindex'=>"100",'value'=>"ReservationTitle"),$_smarty_tpl);?>

            
        </li>

        <li class="rsv-box-l" style="text-align: center">
                <textarea style="resize: none;height:40px;width:230px;" id="description" placeholder="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationDescription"),$_smarty_tpl);?>
" name="<?php echo FormKeys::DESCRIPTION;?>
" class="input" rows="2" cols="52"
                          tabindex="110"><?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
</textarea>
            
        </li>
    </ul>
</div>

<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reservation_id'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReservationId']->value;?>
"/>
<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reference_number'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
"/>
<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reservation_action'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReservationAction']->value;?>
"/>
<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 id="hdnSeriesUpdateScope"
       value="<?php echo SeriesUpdateScope::FullSeries;?>
"/>

	   		<li id="optionDiv" style="display:none;">
					<input <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'CONFLICT_ACTION'),$_smarty_tpl);?>
 type="radio" id="notifyExisting" value="<?php echo ReservationConflictResolution::Notify;?>
" onclick="blackoutNotify()"/>
					<label for="notifyExisting"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BlackoutShowMe'),$_smarty_tpl);?>
</label>
					</br>
					<input <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'CONFLICT_ACTION'),$_smarty_tpl);?>
 type="radio" id="deleteExisting" value="<?php echo ReservationConflictResolution::Delete;?>
" onclick="blackoutNotify()" checked/>
					<label for="deleteExisting"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BlackoutDeleteConflicts'),$_smarty_tpl);?>
</label>

					<input id="myOption" type="hidden" value="0" />
				</li>
<div class="reservationButtons" style="position: absolute;
    left: 56%;">	
						<button id="blackButton" type="button" style="display:none;" class="button" onclick="blackoutPopup()">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Create'),$_smarty_tpl);?>

			</button>
		</div>		
<div class="reservationButtons" style="position: absolute;
    left: 56%;">	
	<div class="reservationSubmitButtons">
		
			<button id="submitButton" type="button" class="button save create">
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Create'),$_smarty_tpl);?>

			</button>
		
	</div>
</div>
	<div class="reservationDeleteButtons rightFloater">
	
		&nbsp;
	
	</div>
	
<?php if ($_smarty_tpl->tpl_vars['UploadsEnabled']->value) {?>
	
	
<?php }?>
</form>

<div class="hiddenDiv" id="strings">
	<input id="reasonString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Reason"),$_smarty_tpl);?>
">
	<input id="availableString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NotAvailable"),$_smarty_tpl);?>
">
	<input id="titleString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationTitle"),$_smarty_tpl);?>
">
	<input id="descriptionString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ReservationDescription"),$_smarty_tpl);?>
">
</div>

<div id="dialogResourceGroups" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddResources'),$_smarty_tpl);?>
">

	<div id="resourceGroups"></div>

	<button class="button btnConfirmAddResources"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Done'),$_smarty_tpl);?>
</button>
	<button class="button btnClearAddResources"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
</div>

<div id="dialogAddResources" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddResources'),$_smarty_tpl);?>
" style="display:none;">

<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AvailableResources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
	<?php if ($_smarty_tpl->tpl_vars['resource']->value->CanAccess) {?>
		<?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable('', null, 0);?>
		<?php if (is_array($_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)&&in_array($_smarty_tpl->tpl_vars['resource']->value->Id,$_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)) {?>
			<?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable('checked="checked"', null, 0);?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['resource']->value->Id==$_smarty_tpl->tpl_vars['ResourceId']->value) {?>
			<?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable('checked="checked"', null, 0);?>
		<?php }?>

        <p>
            <input type="checkbox" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ADDITIONAL_RESOURCES','multi'=>true),$_smarty_tpl);?>
 id="additionalResource<?php echo $_smarty_tpl->tpl_vars['resource']->value->Id;?>
"
                   value="<?php echo $_smarty_tpl->tpl_vars['resource']->value->Id;?>
" <?php echo $_smarty_tpl->tpl_vars['checked']->value;?>
 />
            <label for="additionalResource<?php echo $_smarty_tpl->tpl_vars['resource']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['resource']->value->Name;?>
</label>
        </p>
	<?php }?>
<?php } ?>
    <br/>
    <button class="button btnConfirmAddResources"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Done'),$_smarty_tpl);?>
</button>
    <button class="button btnClearAddResources"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
</div>

<div id="dialogAddAccessories" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddAccessories'),$_smarty_tpl);?>
" style="display:none;">
    <table style="width:100%">
        <tr>
            <td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Accessory'),$_smarty_tpl);?>
</td>
            <td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'QuantityRequested'),$_smarty_tpl);?>
</td>
            <td><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'QuantityAvailable'),$_smarty_tpl);?>
</td>
        </tr>
	<?php  $_smarty_tpl->tpl_vars['accessory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['accessory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AvailableAccessories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['accessory']->key => $_smarty_tpl->tpl_vars['accessory']->value) {
$_smarty_tpl->tpl_vars['accessory']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>
</td>
            <td>
                <input type="hidden" class="name" value="<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Name;?>
"/>
                <input type="hidden" class="id" value="<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Id;?>
"/>
				<?php if ($_smarty_tpl->tpl_vars['accessory']->value->QuantityAvailable==1) {?>
                    <input type="checkbox" name="accessory<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Id;?>
" value="1" size="3"/>
					<?php } else { ?>
                    <input type="text" name="accessory<?php echo $_smarty_tpl->tpl_vars['accessory']->value->Id;?>
" value="0" size="3"/>
				<?php }?>
            </td>
            <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['accessory']->value->QuantityAvailable)===null||$tmp==='' ? '&infin;' : $tmp);?>
</td>
        </tr>
	<?php } ?>
    </table>
    <br/>
    <button id="btnConfirmAddAccessories" class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-circle.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Done'),$_smarty_tpl);?>
</button>
    <button id="btnCancelAddAccessories" class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"slash.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Cancel'),$_smarty_tpl);?>
</button>
</div>


<div id="reservationColorbox" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CreateReservationHeading"),$_smarty_tpl);?>
></div>

<!-- reservationbox ends -->
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"BeginDate",'AltId'=>"formattedBeginDate",'DefaultDate'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"EndDate",'AltId'=>"formattedEndDate",'DefaultDate'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"EndRepeat",'AltId'=>"formattedEndRepeat",'DefaultDate'=>$_smarty_tpl->tpl_vars['RepeatTerminationDate']->value),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.textarea-expander.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/moment.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"resourcePopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"userPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"date-helper.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"recurrence.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservation.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"force-numeric.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservation-reminder.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/tree.jquery.js"),$_smarty_tpl);?>



<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="scripts/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css"/>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/jquery.multiselect.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/prettify.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"multiselect/jquery.multiselect.filter.js"),$_smarty_tpl);?>

<link rel="stylesheet" href="scripts/Popup-master/assets/css/popup.css">
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"Popup-master/assets/js/jquery.popup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/createEnhance.js"),$_smarty_tpl);?>


<script type="text/javascript">
    $(document).ready(function ()
    {
        var scopeOptions = {
            instance:'<?php echo SeriesUpdateScope::ThisInstance;?>
',
            full:'<?php echo SeriesUpdateScope::FullSeries;?>
',
            future:'<?php echo SeriesUpdateScope::FutureInstances;?>
'
        };

        var reservationOpts = {
            additionalResourceElementId:'<?php echo FormKeys::ADDITIONAL_RESOURCES;?>
',
            accessoryListInputId:'<?php echo FormKeys::ACCESSORY_LIST;?>
[]',
            returnUrl:'<?php echo $_smarty_tpl->tpl_vars['ReturnUrl']->value;?>
',
            scopeOpts:scopeOptions,
            createUrl:'ajax/reservation_save.php',
            updateUrl:'ajax/reservation_update.php',
            deleteUrl:'ajax/reservation_delete.php',
            userAutocompleteUrl:"ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
            groupAutocompleteUrl:"ajax/autocomplete.php?type=<?php echo AutoCompleteType::Group;?>
",
            changeUserAutocompleteUrl:"ajax/autocomplete.php?type=<?php echo AutoCompleteType::MyUsers;?>
",
			maxConcurrentUploads:'<?php echo $_smarty_tpl->tpl_vars['MaxUploadCount']->value;?>
'
        };

        var recurOpts = {
            repeatType:'<?php echo $_smarty_tpl->tpl_vars['RepeatType']->value;?>
',
            repeatInterval:'<?php echo $_smarty_tpl->tpl_vars['RepeatInterval']->value;?>
',
            repeatMonthlyType:'<?php echo $_smarty_tpl->tpl_vars['RepeatMonthlyType']->value;?>
',
            repeatWeekdays:[<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RepeatWeekdays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['day']->value;?>
,<?php } ?>]
        };

        var reminderOpts = {
            reminderTimeStart:'<?php echo $_smarty_tpl->tpl_vars['ReminderTimeStart']->value;?>
',
            reminderTimeEnd:'<?php echo $_smarty_tpl->tpl_vars['ReminderTimeEnd']->value;?>
',
            reminderIntervalStart:'<?php echo $_smarty_tpl->tpl_vars['ReminderIntervalStart']->value;?>
',
            reminderIntervalEnd:'<?php echo $_smarty_tpl->tpl_vars['ReminderIntervalEnd']->value;?>
'
        };

        var recurrence = new Recurrence(recurOpts);
        recurrence.init();

        var reservation = new Reservation(reservationOpts);
        reservation.init('<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
');

        var reminders = new Reminder(reminderOpts);
        reminders.init();

	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Participants']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
        reservation.addParticipant("<?php echo strtr($_smarty_tpl->tpl_vars['user']->value->FullName, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
", "<?php echo strtr($_smarty_tpl->tpl_vars['user']->value->UserId, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
");
	<?php } ?>

	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Invitees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
        reservation.addInvitee("<?php echo strtr($_smarty_tpl->tpl_vars['user']->value->FullName, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
", '<?php echo $_smarty_tpl->tpl_vars['user']->value->UserId;?>
');
	<?php } ?>

	<?php  $_smarty_tpl->tpl_vars['accessory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['accessory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Accessories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['accessory']->key => $_smarty_tpl->tpl_vars['accessory']->value) {
$_smarty_tpl->tpl_vars['accessory']->_loop = true;
?>
        reservation.addAccessory('<?php echo $_smarty_tpl->tpl_vars['accessory']->value->AccessoryId;?>
', '<?php echo $_smarty_tpl->tpl_vars['accessory']->value->QuantityReserved;?>
', "<?php echo strtr($_smarty_tpl->tpl_vars['accessory']->value->Name, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
");
	<?php } ?>

	reservation.addResourceGroups(<?php echo $_smarty_tpl->tpl_vars['ResourceGroupsAsJson']->value;?>
);

        var ajaxOptions = {
            target:'#result', // target element(s) to be updated with server response
            beforeSubmit:reservation.preSubmit, // pre-submit callback
            success:reservation.showResponse  // post-submit callback
        };

	$('#reservationForm').submit(function ()
	{
		$(this).ajaxSubmit(ajaxOptions);
		return false;
	});
	$('#description').TextAreaExpander();
	
	enhanceCreate();
		
});
</script><?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 15:01:39
         compiled from "/var/www/booked/tpl/globalheader.tpl" */ ?>
<?php if ($_valid && !is_callable('content_575c0bb40001e0_79476466')) {function content_575c0bb40001e0_79476466($_smarty_tpl) {?><!DOCTYPE html>

<html lang="<?php echo $_smarty_tpl->tpl_vars['HtmlLang']->value;?>
" dir="<?php echo $_smarty_tpl->tpl_vars['HtmlTextDirection']->value;?>
">
<head>
	<title><?php if ($_smarty_tpl->tpl_vars['TitleKey']->value!='') {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>$_smarty_tpl->tpl_vars['TitleKey']->value,'args'=>$_smarty_tpl->tpl_vars['TitleArgs']->value),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
<?php }?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['Charset']->value;?>
"/>
	<meta name="robots" content="noindex"/>
	<?php if ($_smarty_tpl->tpl_vars['ShouldLogout']->value) {?>
		<meta http-equiv="REFRESH" content="<?php echo $_smarty_tpl->tpl_vars['SessionTimeoutSeconds']->value;?>
;URL=<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
logout.php?<?php echo QueryStringKeys::REDIRECT;?>
=<?php echo urlencode($_SERVER['REQUEST_URI']);?>
">
	<?php }?>
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
favicon.png"/>
	<link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
favicon.png"/>
	<?php if ($_smarty_tpl->tpl_vars['UseLocalJquery']->value) {?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery-1.8.2.min.js"),$_smarty_tpl);?>

		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery-ui-1.9.0.custom.min.js"),$_smarty_tpl);?>

	<?php } else { ?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
	<?php }?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery-ui-timepicker-addon.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"scripts/css/jquery-ui-timepicker-addon.css"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"phpscheduleit.js"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"normalize.css"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"nav.css"),$_smarty_tpl);?>

	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"style.css"),$_smarty_tpl);?>

	<?php if ($_smarty_tpl->tpl_vars['UseLocalJquery']->value) {?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>"scripts/css/smoothness/jquery-ui-1.9.0.custom.min.css"),$_smarty_tpl);?>

	<?php } else { ?>
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/smoothness/jquery-ui.css" type="text/css"></link>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['cssFiles']->value!='') {?>
		<?php $_smarty_tpl->tpl_vars['CssFileList'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['cssFiles']->value), null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['cssFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cssFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CssFileList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cssFile']->key => $_smarty_tpl->tpl_vars['cssFile']->value) {
$_smarty_tpl->tpl_vars['cssFile']->_loop = true;
?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>$_smarty_tpl->tpl_vars['cssFile']->value),$_smarty_tpl);?>

		<?php } ?>
	<?php }?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>$_smarty_tpl->tpl_vars['CssUrl']->value),$_smarty_tpl);?>

	<?php if ($_smarty_tpl->tpl_vars['CssExtensionFile']->value!='') {?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['cssfile'][0][0]->IncludeCssFile(array('src'=>$_smarty_tpl->tpl_vars['CssExtensionFile']->value),$_smarty_tpl);?>

	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['printCssFiles']->value!='') {?>
		<?php $_smarty_tpl->tpl_vars['PrintCssFileList'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['printCssFiles']->value), null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['cssFile'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cssFile']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PrintCssFileList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cssFile']->key => $_smarty_tpl->tpl_vars['cssFile']->value) {
$_smarty_tpl->tpl_vars['cssFile']->_loop = true;
?>
			<link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>
' media='print'/>
		<?php } ?>
	<?php }?>

	<script type="text/javascript">
		$(document).ready(function () {
			initMenu();
		});
	</script>
	<link rel="stylesheet" type="text/css" href="../css/css_enhancement.css">
	<link rel="stylesheet" type="text/css" href="css/css_enhancement.css">
	<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"menu/jquery.ui-contextmenu.min.js"),$_smarty_tpl);?>

</head>
<body oncontextmenu="return false;"  class="<?php echo $_smarty_tpl->tpl_vars['bodyClass']->value;?>
">
<div id="wrapper">
	<div id="doc">
		<div id="logo"><a href="http://www.uniovi.es/"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>((string)$_smarty_tpl->tpl_vars['LogoUrl']->value)),$_smarty_tpl);?>
</a></div>
		<div id="header">
			<div id="header-top">
				<table id="HeaderTable">
				<tr>
				<td>		
				<td>
					<div><a href="<?php echo $_smarty_tpl->tpl_vars['HomeUrl']->value;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>((string)$_smarty_tpl->tpl_vars['Logo2']->value)),$_smarty_tpl);?>
</a></div>
				</td>	
					<div id="signout">
						<?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value) {?>
							<div id="HeaderUserName"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['UserName']->value;?>
</div>		
							<br/>
							<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
logout.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"exit.png"),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"SignOut"),$_smarty_tpl);?>
</a>
						<?php } else { ?>
							<div id="HeaderNotSignedIn"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NotSignedIn"),$_smarty_tpl);?>
</div>
							<br/>
							<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
index.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"LogIn"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"status-offline.png"),$_smarty_tpl);?>
</a>
						<?php }?>
					</div>				
				</td>
				</tr>
				</table>  
			</div>
			<div>
				<ul id="nav" class="menubar">
					<?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value) {?>
						<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
							<li class="menubaritem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
my-calendar.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"folder.png"),$_smarty_tpl);?>
</a>						
								<ul>						
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
my-calendar.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Calendar"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_resources.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"resource.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageResources"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_users.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"user-small.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageUsers"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_groups.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"users.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageGroups"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_quotas.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"quotas.png"),$_smarty_tpl);?>
  <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageQuotas"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_announcements.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"announce2.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageAnnouncements"),$_smarty_tpl);?>
</a></li>			
									<li class="menuitem"><a	href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_schedules.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"schedule.jpg"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"WorkSchedule"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reports/<?php echo Pages::REPORTS_GENERATE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"chart.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reports'),$_smarty_tpl);?>
</a></li>	
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_configuration.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tools-icon.jpg"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Configuration"),$_smarty_tpl);?>
</a></li>
									
								</ul>
							</li>
						<?php } else { ?>
							<li class="menubaritem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
my-calendar.php"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar.png"),$_smarty_tpl);?>
</a> </li>							
						<?php }?>
						<?php if (($_smarty_tpl->tpl_vars['pageTile']->value=="Mi Calendario"||$_smarty_tpl->tpl_vars['pageTile']->value=="My Calendar")) {?>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tools.png"),$_smarty_tpl);?>
</a>
								<ul>
									<li class="menuitem"><a href="#" id="timeTable"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"horario.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"TimeTable"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="#" id="colors"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"paint2.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Colors"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="#" onclick="$('#dialogSubscribe').dialog('open')"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cloud.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Subscription"),$_smarty_tpl);?>
</a></li>								
								</ul>
							</li>
						<?php }?>
					<?php }?>
					<li class="menubaritem help"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"ayuda.png"),$_smarty_tpl);?>
</a>
						<ul>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
help.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"question-balloon.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Help2'),$_smarty_tpl);?>
</a></li>
							<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
								<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
help.php?ht=admin"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"question-balloon.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Help3'),$_smarty_tpl);?>
</a></li>
							<?php }?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
help.php?ht=about"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"question-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'About'),$_smarty_tpl);?>
</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- end #nav -->
		</div>
		<!-- end #header -->
		<div id="content"><?php }} ?>
