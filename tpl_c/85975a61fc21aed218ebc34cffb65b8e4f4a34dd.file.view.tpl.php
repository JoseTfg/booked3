<?php /* Smarty version Smarty-3.1.16, created on 2016-04-24 16:38:54
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\Reservation\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10538571cda7e632ec9-14672215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85975a61fc21aed218ebc34cffb65b8e4f4a34dd' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\Reservation\\view.tpl',
      1 => 1460913808,
      2 => 'file',
    ),
    '72f54f414668abf7f364d4573aac5820d4720af2' => 
    array (
      0 => 'C:\\Program Files (x86)\\Ampps\\www\\booked\\tpl\\globalheader.tpl',
      1 => 1461263581,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10538571cda7e632ec9-14672215',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ReferenceNumber' => 0,
    'ResourceName' => 0,
    'AvailableResources' => 0,
    'AdditionalResourceIds' => 0,
    'resource' => 0,
    'StartDate' => 0,
    'StartPeriods' => 0,
    'period' => 0,
    'SelectedStart' => 0,
    'EndDate' => 0,
    'EndPeriods' => 0,
    'SelectedEnd' => 0,
    'ShowReservationDetails' => 0,
    'ReservationTitle' => 0,
    'Description' => 0,
    'Attributes' => 0,
    'attribute' => 0,
    'Path' => 0,
    'Attachments' => 0,
    'attachment' => 0,
    'ReservationId' => 0,
    'ReservationAction' => 0,
    'ReturnUrl' => 0,
    'UserId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_571cda7e919272_00294855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571cda7e919272_00294855')) {function content_571cda7e919272_00294855($_smarty_tpl) {?>

<?php /*  Call merged included template "globalheader.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('globalheader.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('TitleKey'=>'ViewReservationHeading','TitleArgs'=>$_smarty_tpl->tpl_vars['ReferenceNumber']->value,'cssFiles'=>'css/reservation.css'), 0, '10538571cda7e632ec9-14672215');
content_571cda7e729079_51317570($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "globalheader.tpl" */?>


<div id="reservationbox" class="readonly">
	<div id="reservationFormDiv">
		<div class="reservationHeader">
			<h3><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ViewReservationHeading"),$_smarty_tpl);?>
</h3>
		</div>
		<div id="reservationDetails">
			<ul id="reservationDetailsLeft" class="no-style">				
				<li>
					<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resources'),$_smarty_tpl);?>
</label> <br/><?php echo $_smarty_tpl->tpl_vars['ResourceName']->value;?>
					
					<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['AvailableResources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
?>
						<?php if (is_array($_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)&&in_array($_smarty_tpl->tpl_vars['resource']->value->Id,$_smarty_tpl->tpl_vars['AdditionalResourceIds']->value)) {?>
							,<?php echo $_smarty_tpl->tpl_vars['resource']->value->Name;?>

						<?php }?>
					<?php } ?>
				</li>
				
				
				<li class="section">
					<label>Periodo</label><br/>
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value),$_smarty_tpl);?>

					<input type="hidden" id="formattedBeginDate" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['StartDate']->value,'key'=>'system'),$_smarty_tpl);?>
"/>
					<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['StartPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedStart']->value) {?>
							<?php echo $_smarty_tpl->tpl_vars['period']->value->Label();?>

							<input type="hidden" id="BeginPeriod" value="<?php echo $_smarty_tpl->tpl_vars['period']->value->Begin();?>
"/>
						<?php }?>
					<?php } ?>

					<label> - </label> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value),$_smarty_tpl);?>

					<input type="hidden" id="formattedEndDate" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['EndDate']->value,'key'=>'system'),$_smarty_tpl);?>
" />
					<?php  $_smarty_tpl->tpl_vars['period'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['period']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EndPeriods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['period']->key => $_smarty_tpl->tpl_vars['period']->value) {
$_smarty_tpl->tpl_vars['period']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['period']->value==$_smarty_tpl->tpl_vars['SelectedEnd']->value) {?>
							<?php echo $_smarty_tpl->tpl_vars['period']->value->LabelEnd();?>
 <br/>
							<input type="hidden" id="EndPeriod" value="<?php echo $_smarty_tpl->tpl_vars['period']->value->End();?>
"/>
						<?php }?>
					<?php } ?>
				</li>
				
				
				<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
					<li class="section">
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationTitle'),$_smarty_tpl);?>
</label>
						<?php if ($_smarty_tpl->tpl_vars['ReservationTitle']->value!='') {?>
							<br/><?php echo $_smarty_tpl->tpl_vars['ReservationTitle']->value;?>

						<?php } else { ?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php }?>
					</li>
					<br/>
					<li>
						<label><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationDescription'),$_smarty_tpl);?>
</label>
						<?php if ($_smarty_tpl->tpl_vars['Description']->value!='') {?>
							<br/><?php echo nl2br($_smarty_tpl->tpl_vars['Description']->value);?>

						<?php } else { ?>
							<span class="no-data"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'None'),$_smarty_tpl);?>
</span>
						<?php }?>
					</li>
				<?php }?>
			</ul>
		</div>

		

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<?php if (count($_smarty_tpl->tpl_vars['Attributes']->value)>0) {?>
			<div class="customAttributes">
				<ul>
				<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Attributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>				
					<li class="customAttribute">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['control'][0][0]->DisplayControl(array('type'=>"AttributeControl",'attribute'=>$_smarty_tpl->tpl_vars['attribute']->value,'readonly'=>true),$_smarty_tpl);?>
						
					</li>
					<br/>
				<?php } ?>
				</ul>
			</div>
			<div style="clear:both;">&nbsp;</div>
			<?php }?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<div id="reservationDetailsLeft" style="float:left;">
				
					<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
export/<?php echo Pages::CALENDAR_EXPORT;?>
?<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
">
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"calendar-plus.png"),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'AddToOutlook'),$_smarty_tpl);?>
</a>
				
			</div>
		<?php }?>
		<div id="reservationDetailsRight" style="float:right;">
			
				&nbsp
			
			<button type="button" class="button" onclick="prueba()">
				<img src="img/slash.png"/>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Close'),$_smarty_tpl);?>
			
		</div>

		<?php if ($_smarty_tpl->tpl_vars['ShowReservationDetails']->value) {?>
			<?php if (count($_smarty_tpl->tpl_vars['Attachments']->value)>0) {?>
				<div style="clear:both">&nbsp;</div>
				<div class="res-attachments">
				<span class="heading"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Attachments'),$_smarty_tpl);?>
</span>
					<?php  $_smarty_tpl->tpl_vars['attachment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attachment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Attachments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attachment']->key => $_smarty_tpl->tpl_vars['attachment']->value) {
$_smarty_tpl->tpl_vars['attachment']->_loop = true;
?>
						<a href="attachments/<?php echo Pages::RESERVATION_FILE;?>
?<?php echo QueryStringKeys::ATTACHMENT_FILE_ID;?>
=<?php echo $_smarty_tpl->tpl_vars['attachment']->value->FileId();?>
&<?php echo QueryStringKeys::REFERENCE_NUMBER;?>
=<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['attachment']->value->FileName();?>
</a>&nbsp;
					<?php } ?>
				</div>
			<?php }?>
		<?php }?>
		<input type="hidden" id="referenceNumber" <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formname'][0][0]->GetFormName(array('key'=>'reference_number'),$_smarty_tpl);?>
 value="<?php echo $_smarty_tpl->tpl_vars['ReferenceNumber']->value;?>
"/>
	</div>
</div>

<div id="dialogSave" style="display:none;">
	<div id="creatingNotification" style="position:relative; top:170px;">
	
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'UpdatingReservation'),$_smarty_tpl);?>
...<br/>
	
		<img src="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
img/reservation_submitting.gif" alt="Creating reservation"/>
	</div>
	<div id="result" style="display:none;"></div>
</div>

<div style="display: none">
	<form id="reservationForm" method="post" enctype="application/x-www-form-urlencoded">
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
 id="hdnSeriesUpdateScope" value="<?php echo SeriesUpdateScope::FullSeries;?>
"/>
	</form>
</div>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"participation.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"approval.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/jquery.form-3.09.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"js/moment.min.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"date-helper.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"reservation.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"autocomplete.js"),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['jsfile'][0][0]->IncludeJavascriptFile(array('src'=>"userPopup.js"),$_smarty_tpl);?>


	<script type="text/javascript">
	
	var prueba = function(){
	sessionStorage.setItem("popup_status", "close");
	};
	
	$(document).ready(function() {	
	document.body.style.overflow = "hidden";
	//document.getElementById('header').style.visibility="hidden";
	$('#header').remove();
	$('#logo').remove();

		var participationOptions = {
			responseType: 'json'
		};

		var participation = new Participation(participationOptions);
		participation.initReservation();

		var approvalOptions = {
			responseType: 'json',
			url: "<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
ajax/reservation_approve.php"
		};

		var approval = new Approval(approvalOptions);
		approval.initReservation();

		var scopeOptions = {
				instance: '<?php echo SeriesUpdateScope::ThisInstance;?>
',
				full: '<?php echo SeriesUpdateScope::FullSeries;?>
',
				future: '<?php echo SeriesUpdateScope::FutureInstances;?>
'
			};

		var reservationOpts = {
			returnUrl: '<?php echo $_smarty_tpl->tpl_vars['ReturnUrl']->value;?>
',
			scopeOpts: scopeOptions,
			deleteUrl: 'ajax/reservation_delete.php',
			userAutocompleteUrl: "ajax/autocomplete.php?type=<?php echo AutoCompleteType::User;?>
",
			changeUserAutocompleteUrl: "ajax/autocomplete.php?type=<?php echo AutoCompleteType::MyUsers;?>
"
		};
		var reservation = new Reservation(reservationOpts);
		reservation.init('<?php echo $_smarty_tpl->tpl_vars['UserId']->value;?>
');

		var options = {
			target: '#result',   // target element(s) to be updated with server response
			beforeSubmit: reservation.preSubmit,  // pre-submit callback
			success: reservation.showResponse  // post-submit callback
		};

		$('#reservationForm').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});

		$('.bindableUser').bindUserDetails();	
	
	});

	</script>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2016-04-24 16:38:54
         compiled from "C:\Program Files (x86)\Ampps\www\booked\tpl\globalheader.tpl" */ ?>
<?php if ($_valid && !is_callable('content_571cda7e729079_51317570')) {function content_571cda7e729079_51317570($_smarty_tpl) {?><!DOCTYPE html>

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
	<link rel="stylesheet" type="text/css" href="../css/propio.css">
	<link rel="stylesheet" type="text/css" href="css/propio.css">
</head>
<body class="<?php echo $_smarty_tpl->tpl_vars['bodyClass']->value;?>
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
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"SignedInAs"),$_smarty_tpl);?>
 <div id="HeaderUserName"><?php echo $_smarty_tpl->tpl_vars['UserName']->value;?>
</div>		
						<br/>
						<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
logout.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"SignOut"),$_smarty_tpl);?>
</a>
					<?php } else { ?>
						<div id="HeaderNotSignedIn"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"NotSignedIn"),$_smarty_tpl);?>
</div>
						<br/>
						<a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
index.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"LogIn"),$_smarty_tpl);?>
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
					<li class="menubaritem"><a href="#"> Calendario</a>
						<ul>
							<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['HomeUrl']->value;?>
">Ir a Calendario</a></li>
							<li class="menuitem"><a onClick="menuClick(1);">Crear Reserva</a></li>
							<li class="menuitem"><a onClick="menuClick(2);">Exportar</a></li>	
							<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageBlackouts"),$_smarty_tpl);?>
</a></li>								
						</ul>
					</li>
					<li class="menubaritem"><a href="#"> Preferencias</a>
						<ul>
							<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php">Horarios</a></li>
							<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php">Leyenda</a></li>							
						</ul>
					</li>					
					<ul>
							<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php">Crear Reserva</a></li>										
						</ul>
									</li>
						<?php if ($_smarty_tpl->tpl_vars['CanViewAdmin']->value) {?>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageReservations"),$_smarty_tpl);?>
</a>
								<ul>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_reservations.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageReservations"),$_smarty_tpl);?>
</a>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageBlackouts"),$_smarty_tpl);?>
</a></li>										
								</ul>
									</li>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageResources"),$_smarty_tpl);?>
</a>
								<ul>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_resources.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageResources"),$_smarty_tpl);?>
</a>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_resource_groups.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageGroups"),$_smarty_tpl);?>
</a></li>
								</ul>
									</li>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageUsers"),$_smarty_tpl);?>
</a>
								<ul>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_users.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageUsers"),$_smarty_tpl);?>
</a>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_groups.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageGroups"),$_smarty_tpl);?>
</a></li>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_quotas.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageQuotas"),$_smarty_tpl);?>
</a></li>
								</ul>
								</li>
							<li class="menubaritem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_announcements.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageAnnouncements"),$_smarty_tpl);?>
</a></li>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Customization"),$_smarty_tpl);?>
</a>
								<ul>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_configuration.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Customization"),$_smarty_tpl);?>
</a>
									<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_attributes.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"Attributes"),$_smarty_tpl);?>
</a></li>
									
								</ul>
									</li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['CanViewResponsibilities']->value) {?>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Responsibilities'),$_smarty_tpl);?>
</a>
								<ul>
									<?php if ($_smarty_tpl->tpl_vars['CanViewGroupAdmin']->value) {?>
										<li class="menuitem"><a
													href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_group_users.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageUsers"),$_smarty_tpl);?>
</a></li>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_group_reservations.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GroupReservations'),$_smarty_tpl);?>
</a></li>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_admin_groups.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageGroups"),$_smarty_tpl);?>
</a></li>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['CanViewResourceAdmin']->value||$_smarty_tpl->tpl_vars['CanViewScheduleAdmin']->value) {?>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_admin_resources.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageResources"),$_smarty_tpl);?>
</a></li>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_blackouts.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageBlackouts"),$_smarty_tpl);?>
</a></li>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['CanViewResourceAdmin']->value) {?>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_resource_reservations.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ResourceReservations'),$_smarty_tpl);?>
</a></li>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['CanViewScheduleAdmin']->value) {?>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_admin_schedules.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>"ManageSchedules"),$_smarty_tpl);?>
</a></li>
										<li class="menuitem"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
admin/manage_schedule_reservations.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ScheduleReservations'),$_smarty_tpl);?>
</a></li>
									<?php }?>
								</ul>
							</li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['CanViewReports']->value) {?>
							<li class="menubaritem"><a href="#"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Reports'),$_smarty_tpl);?>
</a>
								<ul>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reports/<?php echo Pages::REPORTS_GENERATE;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'GenerateReport'),$_smarty_tpl);?>
</a></li>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reports/<?php echo Pages::REPORTS_SAVED;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'MySavedReports'),$_smarty_tpl);?>
</a></li>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
reports/<?php echo Pages::REPORTS_COMMON;?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'CommonReports'),$_smarty_tpl);?>
</a></li>
								</ul>
							</li>
						<?php }?>
					<?php }?>
					<li class="menubaritem help"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
help.php?ht=about"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'About'),$_smarty_tpl);?>
</a></li>
					<li class="menubaritem help"><a href="<?php echo $_smarty_tpl->tpl_vars['Path']->value;?>
help.php"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Help'),$_smarty_tpl);?>
</a>	</li>

				</ul>
			</div>
			<!-- end #nav -->
		</div>
		<!-- end #header -->
		<div id="content"><?php }} ?>
