<?php /* Smarty version Smarty-3.1.16, created on 2016-06-11 17:49:21
         compiled from "/var/www/booked/tpl/Admin/Reservations/manage_reservations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:251931119575c3301f04974-58534717%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64d64295fd2c5fcb7f50002987d3545f67bc7804' => 
    array (
      0 => '/var/www/booked/tpl/Admin/Reservations/manage_reservations.tpl',
      1 => 1465647014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '251931119575c3301f04974-58534717',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PageId' => 0,
    'StartDate' => 0,
    'EndDate' => 0,
    'CanViewAdmin' => 0,
    'UserNameFilter' => 0,
    'UserIdFilter' => 0,
    'Schedules' => 0,
    'ScheduleId' => 0,
    'Resources' => 0,
    'ResourceId' => 0,
    'ReservationStatusId' => 0,
    'ReferenceNumber' => 0,
    'AttributeFilters' => 0,
    'attribute' => 0,
    'ReservationAttributes' => 0,
    'attr' => 0,
    'reservations' => 0,
    'rowCss' => 0,
    'reservation' => 0,
    'StatusReasons' => 0,
    'Timezone' => 0,
    'attrVal' => 0,
    'date' => 0,
    'PageInfo' => 0,
    'Path' => 0,
    'reason' => 0,
    'ResourceStatusFilterId' => 0,
    'ResourceStatusReasonFilterId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_575c33021d55f9_93925467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575c33021d55f9_93925467')) {function content_575c33021d55f9_93925467($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cssFiles'=>'scripts/css/colorbox.css,css/admin.css,css/jquery.qtip.min.css,css/calendar.css'), 0);?>


<div id="<?php echo $_smarty_tpl->tpl_vars['PageId']->value;?>
">
</br></br></br>
<div class="calendarHeading">
	<div class="listHeader">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'List'),$_smarty_tpl);?>

	</div>
	<div class="rightFloater">
		<a href="manage_reservations.php" id="goList" alt="List" title="List"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'List'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"list.png"),$_smarty_tpl);?>
</a>
		<a href="../my-calendar.php?&ct=day" id="goDay" alt="Today" title="Today">	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Day'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-day.png"),$_smarty_tpl);?>
</a>
		<a href="../my-calendar.php?&ct=week" id="goWeek" alt="Week" title="Week"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Week'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-select-week.png"),$_smarty_tpl);?>
</a>
		<a href="../my-calendar.php?&ct=month" id="goMonth" alt="View Month" title="View Month"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Month'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-select-month.png"),$_smarty_tpl);?>
</a>
	</div>
	<div class="clear">&nbsp;</div>	
</div>
</br>
<div class="filterTable horizontal-list label-top main-div-shadow" id="filterTable">
	<div id="adminFilterButtons">
		</br>
		<button id="filterButton" class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"search.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Filter'),$_smarty_tpl);?>
</button>
		<button id="clearFilter" class="button"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"reset.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reset'),$_smarty_tpl);?>
</button>
	</div>	
	<form id="filterForm">
		<div class="main-div-header"> <a href="#" id="myFilterLabel"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Filter'),$_smarty_tpl);?>
 </a></div>
		<ul id="ulFilter"  class="hiddenDiv">
			<li class="filter-dates">
				<label for="startDate"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Between'),$_smarty_tpl);?>
</label>
				<input id="startDate" type="text" class="textbox" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>
" size="10" style="width:65px;"/>
				<input id="formattedStartDate" type="hidden" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
				-
				<input id="endDate" type="text" class="textbox" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>
" size="10" style="width:65px;"/>
				<input id="formattedEndDate" type="hidden" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
			</li>
			<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
				<li class="filter-user">
					<label for="userFilter"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</label>
					<input id="userFilter" type="text" class="textbox" value="<?php echo $_smarty_tpl->tpl_vars['UserNameFilter']->value;?>
"/>
					<input id="userId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserIdFilter']->value;?>
"/>
				</li>
			<?php } else { ?>
				<li class="filter-user" style="display:none;">
					<label for="userFilter"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</label>
					<input id="userFilter" type="text" class="textbox" value="<?php echo $_smarty_tpl->tpl_vars['UserNameFilter']->value;?>
"/>
					<input id="userId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['UserIdFilter']->value;?>
"/>
				</li>
			<?php }?>
			<li class="filter-schedule" id="hiddenFilterSchedule">
				<label for="scheduleId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Schedule'),$_smarty_tpl);?>
</label>
				<select id="scheduleId" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllSchedules'),$_smarty_tpl);?>
</option>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Schedules']->value,'key'=>'GetId','label'=>"GetName",'selected'=>$_smarty_tpl->tpl_vars['ScheduleId']->value),$_smarty_tpl);?>

				</select>
			</li>
			<li class="filter-resource">
				<label for="resourceId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</label>
				<select id="resourceId" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllResources'),$_smarty_tpl);?>
</option>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['object_html_options'][0][0]->ObjectHtmlOptions(array('options'=>$_smarty_tpl->tpl_vars['Resources']->value,'key'=>'GetId','label'=>"GetName",'selected'=>$_smarty_tpl->tpl_vars['ResourceId']->value),$_smarty_tpl);?>

				</select>
			</li>
			<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
				<li class="filter-status">
					<label for="statusId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Status'),$_smarty_tpl);?>
</label>
					<select id="statusId" class="textbox">
						<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllReservations'),$_smarty_tpl);?>
</option>
						<option value="<?php echo ReservationStatus::Pending;?>
"
						<?php if ($_smarty_tpl->tpl_vars['ReservationStatusId']->value==ReservationStatus::Pending) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PendingReservations'),$_smarty_tpl);?>
</option>
					</select>
				</li>
			<?php } else { ?>
				<li class="filter-status" style="display:none;">
					<label for="statusId"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Status'),$_smarty_tpl);?>
</label>
					<select id="statusId" class="textbox">
						<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllReservations'),$_smarty_tpl);?>
</option>
						<option value="<?php echo ReservationStatus::Pending;?>
"
						<?php if ($_smarty_tpl->tpl_vars['ReservationStatusId']->value==ReservationStatus::Pending) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'PendingReservations'),$_smarty_tpl);?>
</option>
					</select>
				</li>
			<?php }?>			
			<li class="filter-referenceNumber" id="hiddenFilterRN">
				<label for="referenceNumber"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReferenceNumber'),$_smarty_tpl);?>
</label>
				<input id="referenceNumber" type="text" class="textbox" value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
"/>
			</li>
			<li class="filter-resourceStatus" id="hiddenFilterRS">
				<label for="resourceStatusIdFilter"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceStatus'),$_smarty_tpl);?>
</label>
				<select id="resourceStatusIdFilter" class="textbox">
					<option value=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'All'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::AVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Available'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::UNAVAILABLE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Unavailable'),$_smarty_tpl);?>
</option>
					<option value="<?php echo ResourceStatus::HIDDEN;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Hidden'),$_smarty_tpl);?>
</option>
				</select>
			</li>
			<li class="filter-resourceStatusReason" id="hiddenFilterRSR">
				<label for="resourceReasonIdFilter"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reason'),$_smarty_tpl);?>
</label>
				<select id="resourceReasonIdFilter" class="textbox"></select>
			</li>
			<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AttributeFilters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
				<li class="customAttribute filter-customAttribute<?php echo $_smarty_tpl->tpl_vars['attribute']->value->Id();?>
" style="display:none;">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value,'searchmode'=>true,'idPrefix'=>"search"),$_smarty_tpl);?>

				</li>
			<?php } ?>
		</ul>
	</form>
</div>

<div class="hiddenDiv">
	<input id="dialogString" type="text" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CheckReservation"),$_smarty_tpl);?>
">
</div>

<div id="reservationColorbox" class="dialog" title=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"CreateReservationHeading"),$_smarty_tpl);?>
></div>

<div>&nbsp;</div>

<table class="list" id="reservationTable">
<thead> 
	<tr>
		<th class="id">&nbsp;</th>		
		<th class="restrictedTh"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resource'),$_smarty_tpl);?>
</th>
		<th class="restrictedTh"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'User'),$_smarty_tpl);?>
</th>
		<th class="restrictedTh"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Title'),$_smarty_tpl);?>
</th>
		<th class="restrictedTh"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Description'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'BeginDate'),$_smarty_tpl);?>
</th>
		<th class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'EndDate'),$_smarty_tpl);?>
</th>
		<th class="hiddenTh"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReferenceNumber'),$_smarty_tpl);?>
</th>
		<?php  $_smarty_tpl->tpl_vars['attr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ReservationAttributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attr']->key => $_smarty_tpl->tpl_vars['attr']->value) {
$_smarty_tpl->tpl_vars['attr']->_loop = true;
?>
			<th class="hiddenTh"><?php echo $_smarty_tpl->tpl_vars['attr']->value->Label();?>
</th>
		<?php } ?>
		<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</td>
		<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
			<td class="action"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Approve'),$_smarty_tpl);?>
</td>
		<?php }?>
	</tr>
	</thead> 
	<tbody> 
	<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
		<tr class="<?php echo $_smarty_tpl->tpl_vars['rowCss']->value;?>
 editable" seriesId="<?php echo $_smarty_tpl->tpl_vars['reservation']->value->SeriesId;?>
">
			<td class="id"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReservationId;?>
</td>			
			<td align="center"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceName;?>

			<td align="center"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fullname'][0][0]->DisplayFullName(array('first'=>$_smarty_tpl->tpl_vars['reservation']->value->FirstName,'last'=>$_smarty_tpl->tpl_vars['reservation']->value->LastName,'ignorePrivacy'=>true),$_smarty_tpl);?>
</td>
				<div>
					<?php if (array_key_exists($_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId,$_smarty_tpl->tpl_vars['StatusReasons']->value)) {?>
						<span class="reservationResourceStatusReason"><?php echo $_smarty_tpl->tpl_vars['StatusReasons']->value[$_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId]->Description();?>
</span>
					<?php }?>
				</div>
			</td>
			<td align="center"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->Title;?>
</td>
			<td align="center"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->Description;?>
</td>
			<td align="center"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->StartDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
</td>
			<td align="center"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->EndDate,'timezone'=>$_smarty_tpl->tpl_vars['Timezone']->value,'key'=>'res_popup'),$_smarty_tpl);?>
</td>
			
			<td class="referenceNumber" style="display:none"><?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
</td>
			<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ReservationAttributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
				<td class="update inlineUpdate updateCustomAttribute" style="display:none;" attributeId="<?php echo $_smarty_tpl->tpl_vars['attribute']->value->Id();?>
" attributeType="<?php echo $_smarty_tpl->tpl_vars['attribute']->value->Type();?>
">
					<?php $_smarty_tpl->tpl_vars['attrVal'] = new Smarty_variable($_smarty_tpl->tpl_vars['reservation']->value->Attributes->Get($_smarty_tpl->tpl_vars['attribute']->value->Id()), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['attribute']->value->Type()==CustomAttributeTypes::CHECKBOX) {?>
						<?php if ($_smarty_tpl->tpl_vars['attrVal']->value==1) {?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Yes'),$_smarty_tpl);?>

						<?php } else { ?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'No'),$_smarty_tpl);?>

						<?php }?>
					<?php } elseif ($_smarty_tpl->tpl_vars['attribute']->value->Type()==CustomAttributeTypes::DATETIME) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['attrVal']->value,'key'=>'general_datetime'),$_smarty_tpl);?>

					<?php } else { ?>
						<?php echo $_smarty_tpl->tpl_vars['attrVal']->value;?>

					<?php }?>
				</td>
			<?php } ?>				
			<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>				
				<td class="center"><a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
				<?php if ($_smarty_tpl->tpl_vars['reservation']->value->RequiresApproval) {?>
					<td class="center">
						<a href="#" class="update approve"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'tick-button.png'),$_smarty_tpl);?>
</a>					
					</td>
				<?php } else { ?>
					<td class="center">-</td>
				<?php }?>			
			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['reservation']->value->StartDateNumber>$_smarty_tpl->tpl_vars['date']->value) {?>
					<td class="center"><a href="#" class="update delete"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>'cross-button.png'),$_smarty_tpl);?>
</a></td>
				<?php } else { ?>
					<td class="center">-</td>
				<?php }?>
			<?php }?>
		</tr>
	<?php } ?>
	</tbody>
</table>

<div class="pagination">
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['pagination'][0][0]->CreatePagination(array('pageInfo'=>$_smarty_tpl->tpl_vars['PageInfo']->value),$_smarty_tpl);?>

</div>

<div id="deleteInstanceDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteInstanceForm" method="post">
		<div class="delResResponse"></div>
		<div class="error">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		</br>
		<button type="button" class="button save"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-button.png"),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
</button>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 value="<?php echo SeriesUpdateScope::ThisInstance;?>
"/>
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 value="" class="referenceNumber"/>
	</form>
</div>

<div id="deleteSeriesDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Delete'),$_smarty_tpl);?>
">
	<form id="deleteSeriesForm" method="post">
		<div class="error">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'DeleteWarning'),$_smarty_tpl);?>
</h3>
		</div>
		<button type="button" id="btnUpdateThisInstance" class="button saveSeries btnUpdateThisInstance">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-black.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ThisInstance'),$_smarty_tpl);?>

		</button>
		<button type="button" id="btnUpdateAllInstances" class="button saveSeries btnUpdateAllInstances">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disks-black.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AllInstances'),$_smarty_tpl);?>

		</button>
		<button type="button" id="btnUpdateFutureInstances" class="button saveSeries btnUpdateFutureInstances">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"disk-arrow.png"),$_smarty_tpl);?>

			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'FutureInstances'),$_smarty_tpl);?>

		</button>
		<input type="hidden" id="hdnSeriesUpdateScope" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'SERIES_UPDATE_SCOPE'),$_smarty_tpl);?>
 />
		<input type="hidden" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 value="" class="referenceNumber"/>
	</form>
</div>

<div id="inlineUpdateErrorDialog" class="dialog" title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Error'),$_smarty_tpl);?>
">
	<div id="inlineUpdateErrors" class="hidden error">&nbsp;</div>
	<div id="reservationAccessError" class="hidden error"/>
</div>
	<button type="button" class="button cancel"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'OK'),$_smarty_tpl);?>
</button>
</div>

<div class="hidden">
	<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AttributeFilters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
		<div class="attributeTemplate" attributeId="<?php echo $_smarty_tpl->tpl_vars['attribute']->value->Id();?>
">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value),$_smarty_tpl);?>

		</div>
	<?php } ?>

	<form id="attributeUpdateForm" method="POST" ajaxAction="<?php echo ManageReservationsActions::UpdateAttribute;?>
">
		<input type="hidden" id="attributeUpdateReferenceNumber" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'REFERENCE_NUMBER'),$_smarty_tpl);?>
 />
		<input type="hidden" id="attributeUpdateId" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_ID'),$_smarty_tpl);?>
 />
		<input type="hidden" id="attributeUpdateValue" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'ATTRIBUTE_VALUE'),$_smarty_tpl);?>
 />
	</form>
</div>

<div id="inlineUpdateCancelButtons" class="hidden">
	<div>
		<a href="#" class="confirmCellUpdate"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"tick-white.png"),$_smarty_tpl);?>
</a>
		<a href="#" class="cancelCellUpdate"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"cross-white.png"),$_smarty_tpl);?>
</a>
	</div>
</div>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf_token'][0][0]->CSRFToken(array(),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"admin-ajax-indicator.gif",'class'=>"indicator"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.qtip.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.colorbox-min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/edit.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"admin/reservations.js"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservationPopup.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"approval.js"),$_smarty_tpl);?>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"TableSorter/jquery.tablesorter.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"enhancement/manageReservationsEnhance.js"),$_smarty_tpl);?>



<script type="text/javascript">

	$(document).ready(function ()
	{
		enhance();
		
		var updateScope = {
		};
		
		updateScope['btnUpdateThisInstance'] = '<?php echo SeriesUpdateScope::ThisInstance;?>
';
		updateScope['btnUpdateAllInstances'] = '<?php echo SeriesUpdateScope::FullSeries;?>
';
		updateScope['btnUpdateFutureInstances'] = '<?php echo SeriesUpdateScope::FutureInstances;?>
';

		var actions = {
		};

		var resOpts = {
			autocompleteUrl: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
			reservationUrlTemplate: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reservation.php?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=[refnum]",
			updateScope: updateScope,
			actions: actions,
			deleteUrl: '<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_delete.php?<?php echo QueryStringKeys::RESPONSE_TYPE;?>
=json',
			resourceStatusUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
?<?php echo QueryStringKeys::ACTION;?>
=changeStatus',
			submitUrl: '<?php echo $_SERVER['SCRIPT_NAME'];?>
'
		};

		var approvalOpts = {
			url: '<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_approve.php'
		};

		var approval = new Approval(approvalOpts);

		var reservationManagement = new ReservationManagement(resOpts, approval);
		reservationManagement.init();

		<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
			reservationManagement.addReservation(
					{
						id: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReservationId;?>
',
						referenceNumber: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
',
						isRecurring: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->IsRecurring;?>
',
						resourceStatusId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusId;?>
',
						resourceStatusReasonId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceStatusReasonId;?>
',
						resourceId: '<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ResourceId;?>
'
					}
			);
		<?php } ?>

		<?php  $_smarty_tpl->tpl_vars['reason'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reason']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StatusReasons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reason']->key => $_smarty_tpl->tpl_vars['reason']->value) {
$_smarty_tpl->tpl_vars['reason']->_loop = true;
?>
			reservationManagement.addStatusReason('<?php echo $_smarty_tpl->tpl_vars['reason']->value->Id();?>
', '<?php echo $_smarty_tpl->tpl_vars['reason']->value->StatusId();?>
', '<?php echo strtr($_smarty_tpl->tpl_vars['reason']->value->Description(), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
		<?php } ?>

		reservationManagement.initializeStatusFilter('<?php echo $_smarty_tpl->tpl_vars['ResourceStatusFilterId']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['ResourceStatusReasonFilterId']->value;?>
');
	});
</script>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"startDate",'AltId'=>"formattedStartDate"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"DatePickerSetupControl",'ControlId'=>"endDate",'AltId'=>"formattedEndDate"),$_smarty_tpl);?>


<div id="approveDiv" class="creating">
	<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Approving'),$_smarty_tpl);?>
...</h3>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"reservation_submitting.gif"),$_smarty_tpl);?>

</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('globalfooter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php }} ?>
