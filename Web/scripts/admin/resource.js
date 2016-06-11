//Resource Management
function ResourceManagement(opts) {
	var options = opts;

	var elements = {
		activeId:$('#activeId'),

		renameDialog:$('#renameDialog'),
		imageDialog:$('#imageDialog'),
		scheduleDialog:$('#scheduleDialog'),
		locationDialog:$('#locationDialog'),
		descriptionDialog:$('#descriptionDialog'),
		notesDialog:$('#notesDialog'),
		deleteDialog:$('#deleteDialog'),
		configurationDialog:$('#configurationDialog'),
		groupAdminDialog:$('#groupAdminDialog'),
		sortOrderDialog:$('#sortOrderDialog'),
		resourceTypeDialog:$('#resourceTypeDialog'),
		statusDialog:$('#statusDialog'),

		renameForm:$('#renameForm'),
		imageForm:$('#imageForm'),
		scheduleForm:$('#scheduleForm'),
		locationForm:$('#locationForm'),
		descriptionForm:$('#descriptionForm'),
		notesForm:$('#notesForm'),
		deleteForm:$('#deleteForm'),
		configurationForm:$('#configurationForm'),
		groupAdminForm:$('#groupAdminForm'),
		attributeForm:$('.attributesForm'),
		sortOrderForm:$('#sortOrderForm'),
		statusForm:$('#statusForm'),
		resourceTypeForm:$('#resourceTypeForm'),

		statusReasons:$('#reasonId'),
		statusOptions:$('#statusId'),
		addStatusReason:$('#addStatusReason'),
		newStatusReason:$('#newStatusReason'),

		addForm:$('#addResourceForm'),
		statusOptionsFilter:$('#resourceStatusIdFilter'),
		statusReasonsFilter:$('#resourceReasonIdFilter'),
		filterTable:$('#filterTable'),
		filterButton:$('#filter'),
		clearFilterButton:$('#clearFilter'),

		bulkUpdatePromptButton:$('#bulkUpdatePromptButton'),
		bulkUpdateDialog:$('#bulkUpdateDialog'),
		bulkUpdateList:$('#bulkUpdateList'),
		bulkUpdateForm:$('#bulkUpdateForm'),
		bulkEditStatusOptions:$('#bulkEditStatusId'),
		bulkEditStatusReasons:$('#bulkEditStatusReasonId'),

		userSearch: $('#userSearch'),
		userDialog: $('#userDialog'),
		addUserForm: $('#addUserForm'),
		removeUserForm: $('#removeUserForm'),
		browseUserDialog: $('#allUsers'),
		browseUsersButton: $('#browseUsers'),
		resourceUserList:$('#resourceUserList'),

		groupSearch: $('#groupSearch'),
		groupDialog: $('#groupDialog'),
		addGroupForm: $('#addGroupForm'),
		removeGroupForm: $('#removeGroupForm'),
		browseGroupDialog: $('#allGroups'),
		browseGroupsButton: $('#browseGroups'),
		resourceGroupList:$('#resourceGroupList'),
		
		//MyCode
		addDialog:$('#addDialog'),
		viewImage: $('#viewImageDialog'),
		
		addedStatus: $('#addedStatus'),
		removedStatus: $('#removedStatus'),
		statusList: $('#statusList'),
		
		addedMembers: $('#addedMembers'),
		removedMembers: $('#removedMembers'),
		
		addedGroups: $('#addedGroups'),
		removedGroups: $('#removedGroups'),
		
		approveDialog:$('#approveDialog'),
		approveForm:$('#approveForm'),
		
		addedRoles: $('#addedRoles'),
		removedRoles: $('#removedRoles'),
		roleList: $('#roleList')
		
	};

	var resources = {};
	var reasons = [];

	//MyCode
	var originalTitle = "";
	
	//Initialization
	ResourceManagement.prototype.init = function () {
		$(".days").watermark('days');
		$(".hours").watermark('hrs');
		$(".minutes").watermark('mins');

		ConfigureAdminDialog(elements.renameDialog);
		ConfigureAdminDialog(elements.imageDialog);
		ConfigureAdminDialog(elements.scheduleDialog);
		ConfigureAdminDialog(elements.locationDialog);
		ConfigureAdminDialog(elements.descriptionDialog);
		ConfigureAdminDialog(elements.notesDialog);
		ConfigureAdminDialog(elements.deleteDialog);
		ConfigureAdminDialog(elements.configurationDialog);
		ConfigureAdminDialog(elements.groupAdminDialog, 380, 120);
		ConfigureAdminDialog(elements.sortOrderDialog);
		ConfigureAdminDialog(elements.resourceTypeDialog);
		ConfigureAdminDialog(elements.statusDialog);
		ConfigureAdminDialog(elements.userDialog);
		ConfigureAdminDialog(elements.browseUserDialog);
		ConfigureAdminDialog(elements.groupDialog);
		ConfigureAdminDialog(elements.browseGroupDialog);
		
		ConfigureAdminDialog(elements.viewImage);		//MyCode	
		ConfigureAdminDialog(elements.approveDialog); 	//MyCode
		ConfigureAdminDialog(elements.addDialog,380, 180);	//MyCode
		
		$('.resourceDetails').each(function () {
			var id = $(this).find(':hidden.id').val();
			var indicator = $('.indicator');

			$(this).find('a.update').click(function (e) {
				e.preventDefault();
				setActiveResourceId(id);
			});

			$(this).find('.imageButton').click(function (e) {
				showChangeImage(e);
			});

			$(this).find('.removeImageButton').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.removeImage), indicator);
			});
			
			//MyCode
			$(this).find('.view').click(function (e) {
				var id = $(this).find(':hidden.id').val();
				//alert(document.getElementsByTagName("img")[id+2].src);
				alert(document.getElementsByClassName(id).src);
				//document.getElementById("imageFile").append("<img src="+document.getElementById(id).src+" />");
				elements.viewImage.dialog("open");
				elements.viewImage.dialog( "option", "resizable", false ); /*MyCode*/
			});
			
			elements.statusDialog.on( "dialogclose", function( event, ui ) {
				elements.statusDialog.dialog("option", "title", originalTitle);
				elements.statusForm.submit();
				sleep(1000);
			});
			
			elements.groupAdminDialog.on( "dialogclose", function( event, ui ) {
				elements.groupAdminDialog.dialog("option", "title", originalTitle);
				elements.groupAdminForm.submit();
				sleep(1000);
			});

			$(this).find('.enableSubscription').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.enableSubscription), indicator);
			});

			$(this).find('.disableSubscription').click(function (e) {
				PerformAsyncAction($(this), getSubmitCallback(options.actions.disableSubscription), indicator);
			});

			$(this).find('.renameButton').click(function (e) {
				showRename(e);
			});

			$(this).find('.changeScheduleButton').click(function (e) {
				showScheduleMove(e);
			});

			$(this).find('.changeResourceType').click(function (e) {
				showResourceType(e);
			});

			$(this).find('.changeLocationButton').click(function (e) {
				showChangeLocation(e);
			});

			$(this).find('.descriptionButton').click(function (e) {
				showChangeDescription(e);
			});

			$(this).find('.notesButton').click(function (e) {
				showChangeNotes(e);
			});

			$(this).find('.adminButton').click(function (e) {
				showResourceAdmin(e);
			});

			$(this).find('.deleteButton').click(function (e) {
				showDeletePrompt(e);
			});

			$(this).find('.changeConfigurationButton').click(function (e) {
				showConfigurationPrompt(e);
			});

			$(this).find('.changeAttributes, .customAttributes .cancel').click(function (e) {
				var otherResources = $(".resourceDetails[resourceid!='" + id + "']");
				otherResources.find('.attribute-readwrite, .validationSummary').hide();
				otherResources.find('.attribute-readonly').show();
				var container = $(this).closest('.customAttributes');
				container.find('.attribute-readwrite').toggle();
				container.find('.attribute-readonly').toggle();
				container.find('.validationSummary').hide();
			});

			$(this).find('.changeSortOrder').click(function (e) {
				showSortPrompt(e);
			});

			$(this).find('.changeStatus').click(function (e) {
				showStatusPrompt(e);
			});

			$(this).find('.changeUsers').click(function(e) {
				changeUsers();
			});

			$(this).find('.changeGroups').click(function(e) {
				changeGroups();
			});
			
			//MyCode
			$(this).find('.approve').click(function(e) {
				approve();
			});	
		});
		
		$('#addButton').click(function(e) {
			addResource();
		});			

		$(".save").click(function () {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function () {
			$(this).closest('.dialog').dialog("close");
		});

		$(".cancelColorbox").click(function () {
			$('#bulkUpdateDialog').hide();
			$.colorbox.close();
		});
		
		elements.renameDialog.on( "dialogclose", function( event, ui ) {
			elements.renameDialog.dialog("option", "title", originalTitle);
		});
		
		elements.descriptionDialog.on( "dialogclose", function( event, ui ) {
			elements.descriptionDialog.dialog("option", "title", originalTitle);
		});
		
		elements.locationDialog.on( "dialogclose", function( event, ui ) {
			elements.locationDialog.dialog("option", "title", originalTitle);
		});
		
		elements.configurationDialog.on( "dialogclose", function( event, ui ) {
			elements.configurationDialog.dialog("option", "title", originalTitle);
		});
		
		elements.userDialog.on( "dialogclose", function( event, ui ) {
			elements.userDialog.dialog("option", "title", originalTitle);
		});
		
		elements.groupDialog.on( "dialogclose", function( event, ui ) {
			elements.groupDialog.dialog("option", "title", originalTitle);
		});
		
		elements.deleteDialog.on( "dialogclose", function( event, ui ) {
			elements.deleteDialog.dialog("option", "title", originalTitle);
		});

		elements.statusOptions.change(function(e){
			populateReasonOptions(elements.statusOptions.val(), elements.statusReasons);
		});

		elements.bulkEditStatusOptions.change(function(e){
			populateReasonOptions(elements.bulkEditStatusOptions.val(), elements.bulkEditStatusReasons);
		});

		elements.addStatusReason.click(function(e){
			e.preventDefault();
			elements.newStatusReason.toggle();

			if (elements.newStatusReason.is(':visible')){
				elements.statusReasons.data('prev', elements.statusReasons.val());
				elements.statusReasons.val('');
			}
			else{
				elements.statusReasons.val(elements.statusReasons.data('prev'));
			}
		});

		elements.statusOptionsFilter.change(function(e){
			populateReasonOptions(elements.statusOptionsFilter.val(), elements.statusReasonsFilter);
		});

		elements.filterButton.click(filterResources);

		elements.clearFilterButton.click(function (e) {
			e.preventDefault();
			elements.filterTable.find('input,select,textarea').val('')

			filterResources();
		});

		elements.bulkUpdatePromptButton.click(function(e){
			e.preventDefault();

			var items = [];
			elements.bulkUpdateList.empty();
			$.each(resources, function (i, r) {
				items.push('<li><label><input type="checkbox" name="resourceId[]" checked="checked" value="' + r.id + '" /> ' + r.name + '</li>');
			});
			$('<ul/>', {'class': 'no-style', html: items.join('')}).appendTo(elements.bulkUpdateList);

			wireUpIntervalToggle(elements.bulkUpdateDialog);

			$.colorbox({inline:true,
				href:"#bulkUpdateDialog",
				transition: "none",
				width: "100%",
				height: "100%"});
			elements.bulkUpdateDialog.show();
		});

		elements.userSearch.userAutoComplete(options.userAutocompleteUrl, function(ui) {
			addUserPermission(ui.item.value);
			elements.userSearch.val('');
		});

		elements.browseUserDialog.delegate('.add', 'click', function() {
			var link = $(this);
			var userId = link.siblings('.id').val();

			addUserPermission(userId);

			link.find('img').attr('src', '../img/tick-white.png');
		});

		elements.resourceUserList.delegate('.delete', 'click', function() {
			var userId = $(this).siblings('.id').val();
			removeUserPermission($(this), userId);
		});
		
		//MyCode
		elements.removedMembers.delegate('.add', 'click', function() {
			var link = $(this);
			var userId = link.siblings('.id').val();
			addUserPermission(userId);
			link.find('img').attr('src', '../img/plus-button.png');
		});

		elements.addedMembers.delegate('.delete', 'click', function() {
			var userId = $(this).siblings('.id').val();
			removeUserPermission($(this), userId);
			$(this).appendTo(elements.removedMembers);
		});

		elements.browseUsersButton.click(function() {
			showAllUsersToAdd();
		});

		elements.groupSearch.groupAutoComplete(options.groupAutocompleteUrl, function(ui) {
			addGroupPermission(ui.item.value);
			elements.groupSearch.val('');
		});

		elements.browseGroupDialog.delegate('.add', 'click', function() {
			var link = $(this);
			var groupId = link.siblings('.id').val();

			addGroupPermission(groupId);

			link.find('img').attr('src', '../img/tick-white.png');
		});

		elements.resourceGroupList.delegate('.delete', 'click', function() {
			var groupId = $(this).siblings('.id').val();
			removeGroupPermission($(this), groupId);
		});

		elements.browseGroupsButton.click(function() {
			showAllGroupsToAdd();
		});
		
		//MyCode
		elements.removedGroups.delegate('.add', 'click', function() {
			var link = $(this);
			var groupId = link.siblings('.id').val();
			addGroupPermission(groupId);
			link.find('img').attr('src', '../img/plus-button.png');
		});

		elements.addedGroups.delegate('.delete', 'click', function() {
			var groupId = $(this).siblings('.id').val();
			removeGroupPermission($(this), groupId);
			$(this).appendTo(elements.removedGroups);
		});

		//MyCode
		elements.removedStatus.delegate('div', 'click', function (e) {
			e.preventDefault();
			elements.statusOptions.val($(this).attr('statusId'));
			elements.addedStatus.find('.status-item').clone().appendTo(elements.removedStatus);
			elements.addedStatus.find('.status-item').remove();
			$(this).appendTo(elements.addedStatus);
		});	
		
		//MyCode
		elements.removedRoles.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#adminGroupId').val($(this).attr('roleId'));
			elements.addedRoles.find('.role-item').clone().appendTo(elements.removedRoles);
			elements.addedRoles.find('.role-item').remove();
			$(this).appendTo(elements.addedRoles);
		});	
		
		elements.addedRoles.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#adminGroupId').val('1');
			$(this).appendTo(elements.removedRoles);
		});	
		
		var imageSaveErrorHandler = function (result) {
			alert(result);
		};

		var combineIntervals = function (jqForm, opts) {
			$(jqForm).find('.interval').each(function (i, v) {
				var id = $(v).attr('id');
				var d = $('#' + id + 'Days').val();
				var h = $('#' + id + 'Hours').val();
				var m = $('#' + id + 'Minutes').val();
				$(v).val(d + 'd' + h + 'h' + m + 'm');
				//console.log($(v).val());
			});
		};

		var attributesHandler = function(responseText, form) {
			if (responseText.ErrorIds && responseText.Messages.attributeValidator)
			{
				var messages =  responseText.Messages.attributeValidator.join('</li><li>');
				messages = '<li>' + messages + '</li>';
				var validationSummary = $(form).find('.validationSummary');
				validationSummary.find('ul').empty().append(messages);
				validationSummary.show();
			}
		};

		var errorHandler = function (result) {
			$("#globalError").html(result).show();
		};

		var bulkUpdateErrorHandler = function (result) {
			$("#bulkUpdateErrors").html(result).show();
		};

		ConfigureAdminForm(elements.imageForm, defaultSubmitCallback(elements.imageForm), null, imageSaveErrorHandler);
		ConfigureAdminForm(elements.renameForm, defaultSubmitCallback(elements.renameForm), null, errorHandler);
		ConfigureAdminForm(elements.scheduleForm, defaultSubmitCallback(elements.scheduleForm));
		ConfigureAdminForm(elements.locationForm, defaultSubmitCallback(elements.locationForm));
		ConfigureAdminForm(elements.descriptionForm, defaultSubmitCallback(elements.descriptionForm));
		ConfigureAdminForm(elements.notesForm, defaultSubmitCallback(elements.notesForm));
		ConfigureAdminForm(elements.addForm, defaultSubmitCallback(elements.addForm), null, handleAddError);
		ConfigureAdminForm(elements.deleteForm, defaultSubmitCallback(elements.deleteForm));
		ConfigureAdminForm(elements.configurationForm, defaultSubmitCallback(elements.configurationForm), null, errorHandler, {onBeforeSerialize:combineIntervals});
		ConfigureAdminForm(elements.groupAdminForm, defaultSubmitCallback(elements.groupAdminForm));
		ConfigureAdminForm(elements.resourceTypeForm, defaultSubmitCallback(elements.resourceTypeForm));
		ConfigureAdminForm(elements.bulkUpdateForm, defaultSubmitCallback(elements.bulkUpdateForm), null, bulkUpdateErrorHandler, {onBeforeSerialize:combineIntervals});
		ConfigureAdminForm(elements.addUserForm, defaultSubmitCallback(elements.addUserForm), changeUsers, errorHandler);
		ConfigureAdminForm(elements.removeUserForm, defaultSubmitCallback(elements.removeUserForm), changeUsers, errorHandler);
		ConfigureAdminForm(elements.addGroupForm, defaultSubmitCallback(elements.addGroupForm), changeGroups, errorHandler);
		ConfigureAdminForm(elements.removeGroupForm, defaultSubmitCallback(elements.removeGroupForm), changeGroups, errorHandler);

		$.each(elements.attributeForm, function(i,form){
			ConfigureAdminForm($(form), defaultSubmitCallback($(form)), null, attributesHandler, {validationSummary:null});
		});

		ConfigureAdminForm(elements.sortOrderForm, defaultSubmitCallback(elements.sortOrderForm));
		ConfigureAdminForm(elements.statusForm, defaultSubmitCallback(elements.statusForm));
		
		//MyCode
		ConfigureAdminForm(elements.approveForm, defaultSubmitCallback(elements.approveForm), null, errorHandler, {onBeforeSerialize:combineIntervals});
	};

	//Add resource
	ResourceManagement.prototype.add = function (resource) {
		resources[resource.id] = resource;
	};

	//Unused
	ResourceManagement.prototype.addStatusReason = function (id, statusId, description) {
		if (!(statusId in reasons))
		{
			reasons[statusId] = [];
		}

		reasons[statusId].push({id:id,description:description});
	};

	//Initializes the filter
	ResourceManagement.prototype.initializeStatusFilter = function (statusId, reasonId)	{
		elements.statusOptionsFilter.val(statusId);
		elements.statusOptionsFilter.trigger('change');
		elements.statusReasonsFilter.val(reasonId);
	};

	//Gets callback
	var getSubmitCallback = function (action) {
		return function () {
			return options.submitUrl + "?rid=" + getActiveResourceId() + "&action=" + action;
		};
	};

	//Sets default callback
	var defaultSubmitCallback = function (form) {
		return function () {
			return options.submitUrl + "?action=" + form.attr('ajaxAction') + '&rid=' + getActiveResourceId();
		};
	};

	//Sets active resource identifier
	var setActiveResourceId = function (scheduleId) {
		elements.activeId.val(scheduleId);
	};

	//Gets active resource identifier
	var getActiveResourceId = function () {
		return elements.activeId.val();
	};

	var getActiveResource = function () {
		return resources[getActiveResourceId()];
	};

	//MyCode
	var addResource = function (e) {
		elements.addDialog.dialog("open");
		elements.addDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};
	
	//MyCode
	var approve = function (e) {
		var resource = getActiveResource();
		$('#requiresApproval2').val(resource.requiresApproval);
		if ($('#requiresApproval2').val() == 0){
		$('#requiresApproval2').val(1);
		}
		else{
		$('#requiresApproval2').val(0);
		}
		elements.approveForm.submit();
		//elements.approveDialog.dialog("open");
		//elements.approveDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

	//Open dialog for resource rename
	var showRename = function (e) {
		$('#editName').val(getActiveResource().name);
		elements.renameDialog.dialog("open");
		elements.renameDialog.dialog( "option", "resizable", false ); /*MyCode*/
					
		var newTitle = getActiveResource().name;
		originalTitle = elements.renameDialog.dialog("option", "title");
		if (newTitle.length > 10){
			shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = newTitle;
		}
		elements.renameDialog.dialog("option", "title", elements.renameDialog.dialog("option", "title") + ": " + shortText);
	};

	//Open dialog for image change
	var showChangeImage = function (e) {
		elements.imageDialog.dialog("open");
		elements.imageDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};
	
	//Unused
	var showScheduleMove = function (e) {
		$('#editSchedule').val(getActiveResource().scheduleId);
		elements.scheduleDialog.dialog("open");
	};

	//Unused
	var showResourceType = function (e) {
		$('#editResourceType').val(getActiveResource().resourceTypeId);
		elements.resourceTypeDialog.dialog("open");
	};

	//Open dialog to change location
	var showChangeLocation = function (e) {
		$('#editLocation').val(getActiveResource().location);
		$('#editContact').val(getActiveResource().contact);
		elements.locationDialog.dialog("open");
		elements.locationDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
		originalTitle = elements.locationDialog.dialog("option", "title");
		if (newTitle.length > 10){
			shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = newTitle;
		}
		elements.locationDialog.dialog("option", "title", elements.locationDialog.dialog("option", "title") + ": " + shortText);
	};

	//Open dialog to change description
	var showChangeDescription = function (e) {
		$('#editDescription').val(HtmlDecode(getActiveResource().description));
		elements.descriptionDialog.dialog("open");
		elements.descriptionDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
		originalTitle = elements.descriptionDialog.dialog("option", "title");
		if (newTitle.length > 10){
			shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = newTitle;
		}
		elements.descriptionDialog.dialog("option", "title", elements.descriptionDialog.dialog("option", "title") + ": " + shortText);
	};

	//Unused
	var showChangeNotes = function (e) {
		$('#editNotes').val(HtmlDecode(getActiveResource().notes));
		elements.notesDialog.dialog("open");
	};

	//Open dialog to change resource admin
	var showResourceAdmin = function (e) {
		$('#adminGroupId').val(getActiveResource().adminGroupId);
		
		//MyCode
		elements.addedRoles.find('.role-item').remove();
		elements.removedRoles.find('.role-item').remove();
		elements.roleList.find('.role-item').clone().appendTo(elements.removedRoles);
		var roleLine = elements.removedRoles.find('div[roleId=' + $('#adminGroupId').val() + ']');
		roleLine.appendTo(elements.addedRoles);
		
		elements.groupAdminDialog.dialog("open");
		elements.groupAdminDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
		originalTitle = elements.groupAdminDialog.dialog("option", "title");
		if (newTitle.length > 10){
			shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = newTitle;
		}
		elements.groupAdminDialog.dialog("option", "title", elements.groupAdminDialog.dialog("option", "title") + ": " + shortText);
	};

	//Open dialog for delete
	var showDeletePrompt = function (e) {
		elements.deleteDialog.dialog("open");
		elements.deleteDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
			originalTitle = elements.deleteDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.deleteDialog.dialog("option", "title", elements.deleteDialog.dialog("option", "title") + ": " + shortText);
	};

	//Open advanced configuration dialog
	var showConfigurationPrompt = function (e) {

		wireUpIntervalToggle(elements.configurationDialog);

		var resource = getActiveResource();

		setDaysHoursMinutes('#minDuration', resource.minLength, $('#noMinimumDuration'));
		setDaysHoursMinutes('#maxDuration', resource.maxLength, $('#noMaximumDuration'));
		setDaysHoursMinutes('#startNotice', resource.startNotice, $('#noStartNotice'));
		setDaysHoursMinutes('#endNotice', resource.endNotice, $('#noEndNotice'));
		setDaysHoursMinutes('#bufferTime', resource.bufferTime, $('#noBufferTime'));
		showHideConfiguration(resource.maxParticipants, $('#maxCapacity'), $('#unlimitedCapacity'));

		$('#allowMultiday').val(resource.allowMultiday);
		$('#requiresApproval').val(resource.requiresApproval);

		var autoAssign = $('#autoAssign');
		autoAssign.val(resource.autoAssign);
		autoAssign.change(function() {
			var removeAll = $('#autoAssignRemoveAllPermissions');
			removeAll.find('input').prop('checked', false);
			if (autoAssign.val() == "0")
			{
				removeAll.show();
			}
			else
			{
				removeAll.hide();
			}
		});

		elements.configurationDialog.dialog("open");
		elements.configurationDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
		originalTitle = elements.configurationDialog.dialog("option", "title");
		if (newTitle.length > 10){
			shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = newTitle;
		}
		elements.configurationDialog.dialog("option", "title", elements.configurationDialog.dialog("option", "title") + ": " + shortText);
		
	};

	//Unused
	var showSortPrompt = function (e) {
		$('#editSortOrder').val(getActiveResource().sortOrder);
		elements.sortOrderDialog.dialog("open");
	};

	//Unused
	var showStatusPrompt = function (e) {
		var resource = getActiveResource();
		elements.statusOptions.val(resource.statusId);

		populateReasonOptions(elements.statusOptions, elements.statusReasons);

		elements.statusReasons.val(resource.reasonId);
		
		//MyCode
		elements.addedStatus.find('.status-item').remove();
		elements.removedStatus.find('.status-item').remove();
		elements.statusList.find('.status-item').clone().appendTo(elements.removedStatus);
		var statusLine = elements.removedStatus.find('div[statusId=' + elements.statusOptions.val() + ']');
		statusLine.appendTo(elements.addedStatus);

		elements.statusDialog.dialog("open");
		elements.statusDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var newTitle = getActiveResource().name;
			originalTitle = elements.statusDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.statusDialog.dialog("option", "title", elements.statusDialog.dialog("option", "title") + ": " + shortText);
	};

	//Unused
	function populateReasonOptions(statusId, reasonsElement){
		reasonsElement.empty().append($('<option>', {value:'', text:'-'}));

		if (statusId in reasons)
		{
			$.each(reasons[statusId], function(i, v){
				reasonsElement.append($('<option>', {
						value: v.id,
						text : v.description
					}));
			});
		}
	}

	//Unused
	function setDaysHoursMinutes(elementPrefix, interval, attributeCheckbox) {
		$(elementPrefix + 'Days').val(interval.days);
		$(elementPrefix + 'Hours').val(interval.hours);
		$(elementPrefix + 'Minutes').val(interval.minutes);
		showHideConfiguration(interval.value, $(elementPrefix), attributeCheckbox);
	}

	//Unused
	function showHideConfiguration(attributeValue, attributeDisplayElement, attributeCheckbox) {
		attributeDisplayElement.val(attributeValue);
		var id = attributeCheckbox.attr('id');
		var span = elements.configurationDialog.find('.' + id);

		if (attributeValue == '' || attributeValue == undefined) {
			attributeCheckbox.prop('checked', true);
			span.hide();
		}
		else {
			attributeCheckbox.prop('checked', false);
			span.show();
		}
	}

	//Unused
	function wireUpIntervalToggle(container) {
		container.find(':checkbox').change(function ()
		{
			var id = $(this).attr('id');
			var span = container.find('.' + id);

			if ($(this).is(":checked"))
			{
				span.find(":text").val('');
				span.hide();
			}
			else
			{
				span.show();
			}
		});
	}

	//Filter resources
	function filterResources() {
		window.location = document.location.pathname + '?' + $('#filterForm').serialize();
	}

	//Handle error
	var handleAddError = function (result) {
		$('#addResourceResults').text(result).show();
	};

	//Change users permissions
	var changeUsers = function() {
		var resourceId = getActiveResourceId();
		$.getJSON(opts.permissionsUrl + '?dr=users', {rid: resourceId}, function(data) {
			var items = [];
			var userIds = [];

			$('#totalUsers').text(data.Total);
			if (data.Users != null)
			{
				$.map(data.Users, function(item) {
					items.push('<li><a href="#" class="delete"><img src="../img/minus-gray.png" /></a> ' + item.DisplayName + '<input type="hidden" class="id" value="' + item.Id + '"/></li>');
					userIds[item.Id] = item.Id;
				});
			}

			elements.addedMembers.empty();
			elements.addedMembers.data('userIds', userIds);

			$('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.addedMembers);
			elements.userDialog.dialog('open');
			showAllUsersToAdd();
			
			elements.userDialog.dialog( "option", "resizable", false ); /*MyCode*/
			
			var newTitle = getActiveResource().name;
			originalTitle = elements.userDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
			elements.userDialog.dialog("option", "title", elements.userDialog.dialog("option", "title") + ": " + shortText);
			
		});
	};

	//Adds user permision
	var addUserPermission = function(userId) {
		$('#addUserId').val(userId);
		elements.addUserForm.submit();
	};

	//Removes user permission
	var removeUserPermission = function(element, userId) {
		$('#removeUserId').val(userId);
		elements.removeUserForm.submit();
	};

	var allUserList;

	//Shows all users
	var showAllUsersToAdd = function() {
		elements.removedMembers.empty();

		if (allUserList == null) {
			$.ajax({
				url: options.userAutocompleteUrl,
				dataType: 'json',
				async: false,
				success: function(data) {
					allUserList = data;
				}
			});
		}

		var items = [];
		if (allUserList != null)
		{
			$.map(allUserList, function(item) {
				if (elements.addedMembers.data('userIds')[item.Id] == undefined) {
					items.push('<li><a href="#" class="add"><img src="../img/plus-button.png" alt="Add To Group" /> &nbsp; </a> ' + item.DisplayName + '<input type="hidden" class="id" value="' + item.Id + '"/></li></li>');
				}
				else {
					//items.push('<li><img src="../img/plus-button.png" alt="Group Member" /> &nbsp; <span>' + item.DisplayName + '</span></li>');
					//items.push('<div class="resource-item" resourceId="{$resource->GetResourceId()}"><a href="#">&nbsp;</a> <span>{$resource->GetName()}</span></div>');
				}
			});
		}

		$('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.removedMembers);

		//elements.browseUserDialog.dialog('open');
		//elements.browseDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

	//Change group permission
	var changeGroups = function() {
		var resourceId = getActiveResourceId();
		$.getJSON(opts.permissionsUrl + '?dr=groups', {rid: resourceId}, function(data) {
			var items = [];
			var groups = [];

			$('#totalGroups').text(data.Total);
			if (data.Groups != null)
			{
				$.map(data.Groups, function(item) {
					items.push('<li><a href="#" class="delete"><img src="../img/minus-gray.png" /></a> ' + item.Name + '<input type="hidden" class="id" value="' + item.Id + '"/></li>');
					groups[item.Id] = item.Id;
				});
			}

			elements.addedGroups.empty();
			elements.addedGroups.data('groupIds', groups);

			$('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.addedGroups);
			elements.groupDialog.dialog('open');
			showAllGroupsToAdd();
			elements.groupDialog.dialog( "option", "resizable", false ); /*MyCode*/
			
			var newTitle = getActiveResource().name;
			originalTitle = elements.groupDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
			elements.groupDialog.dialog("option", "title", elements.groupDialog.dialog("option", "title") + ": " + shortText);
		});
	};

	//Adds group permission
	var addGroupPermission = function(group) {
		$('#addGroupId').val(group);
		elements.addGroupForm.submit();
	};

	//Removes group permission
	var removeGroupPermission = function(element, groupId) {
		$('#removeGroupId').val(groupId);
		elements.removeGroupForm.submit();
	};

	var allGroupList;

	//Show all groups
	var showAllGroupsToAdd = function() {
		elements.removedGroups.empty();

		if (allGroupList == null) {
			$.ajax({
				url: options.groupAutocompleteUrl,
				dataType: 'json',
				async: false,
				success: function(data) {
					allGroupList = data;
				}
			});
		}

		var items = [];
		if (allGroupList != null)
		{
			$.map(allGroupList, function(item) {
				if (elements.addedGroups.data('groupIds')[item.Id] == undefined) {
					items.push('<li><a href="#" class="add"><img src="../img/plus-button.png" alt="Add To Group" /> &nbsp; </a> ' + item.Name + '<input type="hidden" class="id" value="' + item.Id + '"/></li></li>');
				}
				else {
					//items.push('<li><img src="../img/plus-button.png" alt="Group Member" /> &nbsp; <span>' + item.DisplayName + '</span></li>');
					//items.push('<div class="resource-item" resourceId="{$resource->GetResourceId()}"><a href="#">&nbsp;</a> <span>{$resource->GetName()}</span></div>');
				}
			});
		}

		$('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.removedGroups);

		//elements.browseGroupDialog.dialog('open');
		//elements.browseGroupDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

}