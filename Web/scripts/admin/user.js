//User management
function UserManagement(opts) {
	var options = opts;

	//Elements
	var elements = {
		activeId: $('#activeId'),
		userList: $('table.list'),

		userAutocomplete: $('#userSearch'),
		filterStatusId: $('#filterStatusId'),

		permissionsDialog: $('#permissionsDialog'),
		passwordDialog: $('#passwordDialog'),

		attributeForm: $('.attributesForm'),

		permissionsForm: $('#permissionsForm'),
		passwordForm: $('#passwordForm'),

		userDialog: $('#userDialog'),
		userForm: $('#userForm'),

		groupsDialog: $('#groupsDialog'),
		addedGroups: $('#addedGroups'),
		removedGroups: $('#removedGroups'),
		groupList: $('#groupList'),
		addGroupForm: $('#addGroupForm'),
		removeGroupForm: $('#removeGroupForm'),

		colorDialog: $('#colorDialog'),
		colorValue: $('#reservationColor'),
		colorForm: $('#colorForm'),

		addUserForm: $('#addUserForm'),
		importUsersForm: $('#importUsersForm'),

		deleteDialog: $('#deleteDialog'),
		deleteUserForm: $('#deleteUserForm'),
		
		//MyCode
		addedResources: $('#addedResources'),
		removedResources: $('#removedResources'),
		resourceList: $('#resourceList')
	};

	var users = {};
	
	//MyCode
	var originalTitle = "";
	
	//Initialization
	UserManagement.prototype.init = function () {
		
		//Configure dialogs
		ConfigureAdminDialog(elements.permissionsDialog);
		ConfigureAdminDialog(elements.passwordDialog);
		ConfigureAdminDialog(elements.userDialog);
		ConfigureAdminDialog(elements.deleteDialog);
		ConfigureAdminDialog(elements.groupsDialog);
		ConfigureAdminDialog(elements.colorDialog);

		//User events
		elements.userList.delegate('.update', 'click', function (e) {
			setActiveUserElement($(this));
			e.preventDefault();
			e.stopPropagation();
		});

		elements.userList.delegate('.changeStatus', 'click', function (e) {
			changeStatus();
		});

		elements.userList.delegate('.changeGroups', 'click', function (e) {
			changeGroups();
		});

		elements.userList.delegate('.changePermissions', 'click', function (e) {
			changePermissions();
		});

		elements.userList.delegate('.resetPassword', 'click', function (e) {
			elements.passwordDialog.find(':password').val('');
			elements.passwordDialog.dialog('open');
		});

		elements.userList.delegate('.changeColor', 'click', function (e) {
			var user = getActiveUser();
			elements.colorValue.val(user.reservationColor);
			elements.colorDialog.dialog('open');
			elements.colorDialog.dialog( "option", "resizable", false ); /*MyCode*/
		});

		elements.userList.delegate('.editable', 'click', function () {
			var userId = $(this).find('input:hidden.id').val();
			setActiveUserId(userId);
			changeUserInfo();
		});

		elements.userList.delegate('.delete', 'click', function (e) {
			deleteUser();
		});

		elements.userList.delegate('.viewReservations', 'click', function (e) {
			var user = getActiveUser();
			var name = encodeURI(user.first + ' ' + user.last);
			var url = options.manageReservationsUrl + '?uid=' + user.id + '&un=' + name;
			window.location.href = url;
		});

		elements.userAutocomplete.userAutoComplete(options.userAutocompleteUrl, function (ui) {
			elements.userAutocomplete.val(ui.item.label);
			window.location.href = options.selectUserUrl + ui.item.value
		});

		elements.filterStatusId.change(function () {
			var statusid = $(this).val();
			window.location.href = options.filterUrl + statusid;
		});

		elements.addedGroups.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#removeGroupId').val($(this).attr('groupId'));
			$('#removeGroupUserId').val(getActiveUserId());
			elements.removeGroupForm.submit();
			$(this).appendTo(elements.removedGroups);
			emptyCheckAdded(addedGroups,1);
		});

		elements.removedGroups.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#addGroupId').val($(this).attr('groupId'));
			$('#addGroupUserId').val(getActiveUserId());
			elements.addGroupForm.submit();
			$(this).appendTo(elements.addedGroups);
			emptyCheckRemoved(removedGroups,1);
		});
		
		//MyCode
		elements.addedResources.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#removeResourceId').val($(this).attr('resourceId'));
			$('#removeResourceUserId').val(getActiveUserId());
			elements.permissionsForm.find(':checkbox[value="' + $(this).attr('resourceId') + '"]').attr('checked', false);
			$(this).appendTo(elements.removedResources);
			emptyCheckAdded(addedResources,2);
		});

		elements.removedResources.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#addResourceId').val($(this).attr('resourceId'));
			$('#addResourceUserId').val(getActiveUserId());
			elements.permissionsForm.find(':checkbox[value="' + $(this).attr('resourceId') + '"]').attr('checked', true);
			$(this).appendTo(elements.addedResources);
			emptyCheckRemoved(removedResources,2);
		});		

		elements.permissionsDialog.on( "dialogclose", function( event, ui ) {
			elements.permissionsDialog.dialog("option", "title", originalTitle);
			elements.permissionsForm.submit();
		});


		elements.userList.delegate('.changeAttributes, .customAttributes .cancel', 'click', function (e) {
			var user = getActiveUser();
			var otherUsers = $(".customAttributes[userId!='" + user.id + "']");
			otherUsers.find('.attribute-readwrite, .validationSummary').hide();
			otherUsers.find('.attribute-readonly').show();
			var container = $(this).closest('.customAttributes');
			container.find('.attribute-readwrite').toggle();
			container.find('.attribute-readonly').toggle();
			container.find('.validationSummary').hide();
		});

		$(".save").click(function () {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function () {
			$(this).closest('.dialog').dialog("close");
		});

		$('.clearform').click(function () {
			$(this).closest('form')[0].reset();
		});
		
		elements.groupsDialog.on( "dialogclose", function( event, ui ) {
			elements.groupsDialog.dialog("option", "title", originalTitle);
		});

		var hidePermissionsDialog = function () {
			elements.permissionsDialog.dialog('close');
		};

		var hidePasswordDialog = function () {
			hideDialog(elements.passwordDialog);
		};

		var hideDialog = function (dialogElement) {
			dialogElement.dialog('close');
		};

		var error = function (errorText) {
			alert(errorText);
		};

		var attributesHandler = function (responseText, form) {
			if (responseText.ErrorIds && responseText.Messages.attributeValidator)
			{
				var messages = responseText.Messages.attributeValidator.join('</li><li>');
				messages = '<li>' + messages + '</li>';
				var validationSummary = $(form).find('.validationSummary');
				validationSummary.find('ul').empty().append(messages);
				validationSummary.show();
			}
		};

		var importHandler = function (responseText, form) {
			if (!responseText)
			{
				return;
			}

			$('#importCount').text(responseText.importCount);
			$('#importSkipped').text(responseText.skippedRows.length > 0 ? responseText.skippedRows.join(',') : '-');
			$('#importResult').show();

			var errors = $('#importErrors');
			errors.empty();
			if (responseText.messages && responseText.messages.length > 0)
			{
				var messages = responseText.messages.join('</li><li>');
				errors.html('<div>' + messages + '</div>').show();
			}
		};

		//Configure form
		ConfigureAdminForm(elements.permissionsForm, defaultSubmitCallback(elements.permissionsForm), hidePermissionsDialog, error);
		ConfigureAdminForm(elements.passwordForm, defaultSubmitCallback(elements.passwordForm), hidePasswordDialog, error);
		ConfigureAdminForm(elements.userForm, defaultSubmitCallback(elements.userForm), hideDialog(elements.userDialog));
		ConfigureAdminForm(elements.deleteUserForm, defaultSubmitCallback(elements.deleteUserForm), hideDialog(elements.deleteDialog), error);
		ConfigureAdminForm(elements.addUserForm, defaultSubmitCallback(elements.addUserForm));
		$.each(elements.attributeForm, function (i, form) {
			ConfigureAdminForm($(form), defaultSubmitCallback($(form)), null, attributesHandler, {validationSummary: null});
		});
		ConfigureAdminForm(elements.colorForm, defaultSubmitCallback(elements.colorForm));
		ConfigureAdminForm(elements.importUsersForm, defaultSubmitCallback(elements.importUsersForm), importHandler);
		ConfigureAdminForm(elements.addGroupForm, changeGroupUrlCallback(elements.addGroupForm), function(){});
		ConfigureAdminForm(elements.removeGroupForm, changeGroupUrlCallback(elements.removeGroupForm), function(){});
	};

	//Unused
	UserManagement.prototype.addUser = function (user) {
		users[user.id] = user;
	};

	//Gets callback
	var getSubmitCallback = function (action) {
		return function () {
			return options.submitUrl + "?uid=" + getActiveUserId() + "&action=" + action;
		};
	};

	//Default call back
	var defaultSubmitCallback = function (form) {
		return function () {
			return options.submitUrl + "?action=" + form.attr('ajaxAction') + '&uid=' + getActiveUserId();
		};
	};

	//Change group callback
	var changeGroupUrlCallback = function (form) {
		return function () {
			return options.groupManagementUrl + "?action=" + form.attr('ajaxAction') + '&uid=' + getActiveUserId();
		};
	};

	//Sets active user identifier
	function setActiveUserElement(activeElement) {
		var id = activeElement.parents('td').siblings('td.id').find(':hidden').val();
		setActiveUserId(id);
	}

	function setActiveUserId(id) {
		elements.activeId.val(id);
	}

	//Gets active user identifier
	function getActiveUserId() {
		return elements.activeId.val();
	}

	//Gets active user
	function getActiveUser() {
		return users[getActiveUserId()];
	}

	//Change status
	var changeStatus = function () {
		var user = getActiveUser();

		if (user.isActive)
		{
			PerformAsyncAction($(this), getSubmitCallback(options.actions.deactivate))
		}
		else
		{
			PerformAsyncAction($(this), getSubmitCallback(options.actions.activate))
		}
	};

	//Open change group dialog
	var changeGroups = function () {
		var user = getActiveUser();
		elements.addedGroups.find('.group-item').remove();
		elements.removedGroups.find('.group-item').remove();

		elements.groupList.find('.group-item').clone().appendTo(elements.removedGroups);

		var user = getActiveUser();
		var data = {dr: 'groups', uid: user.id};
		$.get(opts.groupsUrl, data, function (groupIds) {
			$.each(groupIds, function (index, value) {
				var groupLine = elements.removedGroups.find('div[groupId=' + value + ']');
				groupLine.appendTo(elements.addedGroups);
			});
		});

		elements.groupsDialog.dialog('open');
		elements.groupsDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		/*MyCode*/
		var id = getActiveUserId();
		var newTitle = document.getElementById(id).innerText;
		originalTitle = elements.groupsDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.groupsDialog.dialog("option", "title", elements.groupsDialog.dialog("option", "title") + ": " + shortText);
		firstCheck(addedGroups,removedGroups,1);
	};

	//Change group
	var changeGroup = function (action, groupId) {
		var url = opts.groupManagementUrl + '?action=' + action + '&gid=' + groupId;

		var data = {userId: getActiveUserId()};
		$.post(url, data);
	};

	//Open change permission dialog
	var changePermissions = function () {
		var user = getActiveUser();
		elements.addedResources.find('.resource-item').remove();
		elements.removedResources.find('.resource-item').remove();

		elements.resourceList.find('.resource-item').clone().appendTo(elements.removedResources);
		var user = getActiveUser();
		var data = {dr: 'permissions', uid: user.id};
		$.get(opts.permissionsUrl, data, function (resourceIds) {
			$.each(resourceIds, function (index, value) {
				elements.permissionsForm.find(':checkbox[value="' + value + '"]').attr('checked', true);
				var resourceLine = elements.removedResources.find('div[resourceId=' + value + ']');
				resourceLine.appendTo(elements.addedResources);
			});
		});

		elements.permissionsDialog.dialog('open');
		elements.permissionsDialog.dialog( "option", "resizable", false );
		var id = getActiveUserId();
		var newTitle = document.getElementById(id).innerText;		
		originalTitle = elements.permissionsDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.permissionsDialog.dialog("option", "title", elements.permissionsDialog.dialog("option", "title") + ": " + shortText);
		firstCheck(addedResources,removedResources,2);		
	};

	//Unused
	var changeUserInfo = function () {
		var user = getActiveUser();

		ClearAsyncErrors(elements.userDialog);

		$('#username').val(user.username);
		$('#fname').val(user.first);
		$('#lname').val(user.last);
		$('#email').val(user.email);
		$('#timezone').val(user.timezone);

		$('#phone').val(user.phone);
		$('#organization').val(user.organization);
		$('#position').val(user.position);
	};

	//Unused
	var deleteUser = function () {
		elements.deleteDialog.dialog('open');
	};
	
	//Checks if added object is empty
	var emptyCheckAdded = function(element, offset){
		offset = parseInt(offset);
		var interval = setInterval(function(){
		if (element.innerHTML.indexOf("id") == "-1"){
			var message = element.parentNode.children[0+offset];
			message.style.display = 'block';
			var message = element.parentNode.children[3+offset];
			message.style.display = 'none';
		}
		else{
			var message = element.parentNode.children[0+offset];
			message.style.display = 'none';
			var message = element.parentNode.children[3+offset];
			message.style.display = 'none';
		}
		clearInterval(interval);
		},100);
	};
	
	//Checks if removed object is empty
	var emptyCheckRemoved = function(element, offset){
		offset = parseInt(offset);
		var interval = setInterval(function(){
		if (element.innerHTML.indexOf("id") == "-1"){
			var message = element.parentNode.children[3+offset];
			message.style.display = 'block';
			var message = element.parentNode.children[0+offset];
			message.style.display = 'none';
		}
		else{
			var message = element.parentNode.children[0+offset];
			message.style.display = 'none';
			var message = element.parentNode.children[3+offset];
			message.style.display = 'none';
		}
		clearInterval(interval);
		},100);
	};
	
	//Checks previous functions on dialog open
	var firstCheck = function(element1,element2,offset){
		var interval = setInterval(function(){
		if (element1.innerHTML.indexOf("id") == "-1"){
			var message = element1.parentNode.children[0+offset];
			message.style.display = 'block';
			var message = element1.parentNode.children[3+offset];
			message.style.display = 'none';
		}
		if (element2.innerHTML.indexOf("id") == "-1"){
			var message = element2.parentNode.children[3+offset];
			message.style.display = 'block';
			var message = element2.parentNode.children[0+offset];
			message.style.display = 'none';
		}
		clearInterval(interval);
		},100);
	};
}