//Group management
function GroupManagement(opts) {
	var options = opts;

	var elements = {
		activeId: $('#activeId'),
		groupList: $('table.list'),

		autocompleteSearch: $('#groupSearch'),
		userSearch: $('#userSearch'),

		groupUserList: $('#groupUserList'),
		membersDialog: $('#membersDialog'),
		permissionsDialog: $('#permissionsDialog'),
		deleteDialog: $('#deleteDialog'),
		renameDialog: $('#renameDialog'),
		browseUserDialog: $('#allUsers'),
		rolesDialog: $('#rolesDialog'),
		groupAdminDialog: $('#groupAdminDialog'),
		addDialog: $('#addDialog'),

		permissionsForm: $('#permissionsForm'),
		addUserForm: $('#addUserForm'),
		removeUserForm: $('#removeUserForm'),
		renameGroupForm: $('#renameGroupForm'),
		deleteGroupForm: $('#deleteGroupForm'),
		rolesForm: $('#rolesForm'),
		groupAdminForm: $('#groupAdminForm'),

		addForm: $('#addGroupForm'),
		
		//MyCode
		addedResources: $('#addedResources'),
		removedResources: $('#removedResources'),
		resourceList: $('#resourceList'),
		
		addedMembers: $('#addedMembers'),
		removedMembers: $('#removedMembers'),
		memberList: $('#memberList'),
		
		addedRoles: $('#addedRoles'),
		removedRoles: $('#removedRoles'),
		roleList: $('#roleList')
	};

	var allUserList = null;	
	
	//MyCode
	var originalTitle = "";

	//Initialization
	GroupManagement.prototype.init = function() {

		ConfigureAdminDialog(elements.membersDialog);/*MyCode*/
		ConfigureAdminDialog(elements.permissionsDialog); /*MyCode*/
		ConfigureAdminDialog(elements.deleteDialog,  400, 200); /*MyCode*/
		ConfigureAdminDialog(elements.renameDialog, 500, 100);
		ConfigureAdminDialog(elements.addDialog, 500, 100);
		ConfigureAdminDialog(elements.browseUserDialog, 500, 100);
		ConfigureAdminDialog(elements.rolesDialog); /*MyCode*/
		ConfigureAdminDialog(elements.groupAdminDialog, 500, 100);

		elements.groupList.delegate('a.update', 'click', function(e) {
			setActiveId($(this));
			e.preventDefault();
		});

		elements.groupList.delegate('.rename', 'click', function() {
			renameGroup();
		});

		elements.groupList.delegate('.permissions', 'click', function() {
			changePermissions();
		});

		elements.groupList.delegate('.members', 'click', function() {
			changeMembers();
		});

		elements.groupList.delegate('.delete', 'click', function() {
			deleteGroup();
		});

		elements.groupList.delegate('.roles', 'click', function() {
			changeRoles();
		});

		elements.browseUserDialog.delegate('.add', 'click', function() {
			var link = $(this);
			var userId = link.siblings('.id').val();

			addUserToGroup(userId);

			link.find('img').attr('src', '../img/tick-white.png');
		});

		elements.groupUserList.delegate('.delete', 'click', function() {
			var userId = $(this).siblings('.id').val();
			removeUserFromGroup($(this), userId);
		});
		
		//MyCode
		elements.removedMembers.delegate('.add', 'click', function() {
			var link = $(this);
			var userId = link.siblings('.id').val();
			addUserToGroup(userId);
			link.find('img').attr('src', '../img/plus-button.png');
		});

		elements.addedMembers.delegate('.delete', 'click', function() {
			var userId = $(this).siblings('.id').val();
			removeUserFromGroup($(this), userId);
			$(this).appendTo(elements.removedMembers);
		});

		elements.autocompleteSearch.groupAutoComplete(options.groupAutocompleteUrl, function(ui){
			window.location.href = options.selectGroupUrl + ui.item.value
		});

		elements.userSearch.userAutoComplete(options.userAutocompleteUrl, function(ui) {
			addUserToGroup(ui.item.value);
			elements.userSearch.val('');
		});

		elements.groupList.delegate('.groupAdmin', 'click', function() {
			changeGroupAdmin();
		});
		
		//MyCode
		elements.addedResources.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#removeResourceId').val($(this).attr('resourceId'));
			$('#removeResourceUserId').val(getActiveId());
			elements.permissionsForm.find(':checkbox[value="' + $(this).attr('resourceId') + '"]').attr('checked', false);
			$(this).appendTo(elements.removedResources);
		});

		elements.removedResources.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#addResourceId').val($(this).attr('resourceId'));
			$('#addResourceUserId').val(getActiveId());
			elements.permissionsForm.find(':checkbox[value="' + $(this).attr('resourceId') + '"]').attr('checked', true);
			$(this).appendTo(elements.addedResources);
		});		

		elements.permissionsDialog.on( "dialogclose", function( event, ui ) {
			elements.permissionsForm.submit();
		});
		
		//MyCode
		elements.addedRoles.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#removeRoleId').val($(this).attr('roleId'));
			$('#removeRoleUserId').val(getActiveId());
			elements.rolesForm.find(':checkbox[value="' + $(this).attr('roleId') + '"]').attr('checked', false);
			$(this).appendTo(elements.removedRoles);
		});

		elements.removedRoles.delegate('div', 'click', function (e) {
			e.preventDefault();
			$('#addRoleId').val($(this).attr('roleId'));
			$('#addRoleUserId').val(getActiveId());
			elements.rolesForm.find(':checkbox[value="' + $(this).attr('roleId') + '"]').attr('checked', true);
			$(this).appendTo(elements.addedRoles);
		});		

		$(".save").click(function() {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});

		var hidePermissionsDialog = function() {
			elements.permissionsDialog.dialog('close');
		};

		var error = function(errorText) {
			alert(errorText);
		};

		$("#browseUsers").click(function() {
			showAllUsersToAdd();
		});

		//MyCode
		$("#addButton").click(function() {
			addGroup();
		});
		
		elements.membersDialog.on( "dialogclose", function( event, ui ) {
			elements.membersDialog.dialog("option", "title", originalTitle);
		});
		
		elements.permissionsDialog.on( "dialogclose", function( event, ui ) {
			elements.permissionsDialog.dialog("option", "title", originalTitle);
		});
		
		elements.deleteDialog.on( "dialogclose", function( event, ui ) {
			elements.deleteDialog.dialog("option", "title", originalTitle);
		});
		
		elements.rolesDialog.on( "dialogclose", function( event, ui ) {
			elements.rolesDialog.dialog("option", "title", originalTitle);
			elements.rolesForm.submit();
		});
		
		ConfigureAdminForm(elements.addUserForm, getSubmitCallback(options.actions.addUser), changeMembers, error);
		ConfigureAdminForm(elements.removeUserForm, getSubmitCallback(options.actions.removeUser), changeMembers, error);
		ConfigureAdminForm(elements.permissionsForm, getSubmitCallback(options.actions.permissions), hidePermissionsDialog, error);
		ConfigureAdminForm(elements.renameGroupForm, getSubmitCallback(options.actions.renameGroup), null, error);
		ConfigureAdminForm(elements.deleteGroupForm, getSubmitCallback(options.actions.deleteGroup), null, error);
		ConfigureAdminForm(elements.addForm, getSubmitCallback(options.actions.addGroup), null, error);
		ConfigureAdminForm(elements.rolesForm, getSubmitCallback(options.actions.roles), null, error);
		ConfigureAdminForm(elements.groupAdminForm, getSubmitCallback(options.actions.groupAdmin), null, error);
	};

	//Show all users
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
		//elements.browseUserDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

	//Gets callback
	var getSubmitCallback = function(action) {
		return function() {
			return options.submitUrl + "?gid=" + getActiveId() + "&action=" + action;
		};
	};

	//Sets active identifier
	function setActiveId(activeElement) {
		var id = activeElement.parents('td').siblings('td.id').find(':hidden').val();
		elements.activeId.val(id);
	}

	//Gets active identifier
	function getActiveId() {
		return elements.activeId.val();
	}

	//Open rename dialog
	var renameGroup = function() {
		var groupId = getActiveId();
		elements.renameDialog.dialog('open');
		elements.renameDialog.dialog( "option", "resizable", false ); /*MyCode*/
		elements.renameDialog.css('overflow', 'hidden'); /*MyCode*/
		/*MyCode*/
		var a = document.getElementById(groupId).innerText;
		elements.renameDialog.dialog("option", "title", a);
	};
	
	//MyCode
	//Open add group dialog
	var addGroup = function() {
		elements.addDialog.dialog('open');
		elements.addDialog.dialog( "option", "resizable", false ); /*MyCode*/
		elements.addDialog.css('overflow', 'hidden'); /*MyCode*/
	};

	//Open change member dialog
	var changeMembers = function() {
		var groupId = getActiveId();
		$.getJSON(opts.groupsUrl + '?dr=groupMembers', {gid: groupId}, function(data) {
			var items = [];
			var userIds = [];

			$('#totalUsers').text(data.Total);
			if (data.Users != null)
			{
				$.map(data.Users, function(item) {
					items.push('<li id="item.Id" ><a href="#" class="delete"><img src="../img/minus-gray.png" /> &nbsp; </a> ' + item.DisplayName + '<input type="hidden" class="id" value="' + item.Id + '"/></li>');
					userIds[item.Id] = item.Id;
				});
			}

			elements.addedMembers.empty();
			elements.addedMembers.data('userIds', userIds);

			$('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.addedMembers);
			
			//MyCode			
			elements.membersDialog.dialog('open');
			showAllUsersToAdd();
			
			/*MyCode*/
			elements.membersDialog.dialog( "option", "resizable", false );
			
			var newTitle = document.getElementById(groupId).innerText;
			originalTitle = elements.membersDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
			elements.membersDialog.dialog("option", "title", elements.membersDialog.dialog("option", "title") + ": " + shortText);
			//elements.membersDialog.style.overflow = "hidden";
			

		// if (allUserList == null) {
			// $.ajax({
				// url: options.userAutocompleteUrl,
				// dataType: 'json',
				// async: false,
				// success: function(data) {
					// allUserList = data;
				// }
			// });
		// }

		// var items = [];
		// if (allUserList != null)
		// {
			// $.map(allUserList, function(item) {
				// if (elements.groupUserList.data('userIds')[item.Id] == undefined) {
					//items.push('<li><a href="#" class="add"><img src="../img/plus-button.png" alt="Add To Group" /></a> ' + item.DisplayName + '<input type="hidden" class="id" value="' + item.Id + '"/></li></li>');
				// }
				// else {
					// items.push('<li><img src="../img/tick-white.png" alt="Group Member" /> <span>' + item.DisplayName + '</span></li>');
				// }
			// });
		// }

		// $('<ul/>', {'class': '', html: items.join('')}).appendTo(elements.removedMembers);
			
		});
	};

	//Submits: add user to group
	var addUserToGroup = function(userId) {
		$('#addUserId').val(userId);
		elements.addUserForm.submit();
	};

	//Submits: remove user from group
	var removeUserFromGroup = function(element, userId) {
		$('#removeUserId').val(userId);
		elements.removeUserForm.submit();
	};

	//Opens change permission dialog
	var changePermissions = function () {
		// var groupId = getActiveId();

		// var data = {dr: opts.dataRequests.permissions, gid: groupId};
		// $.get(opts.permissionsUrl, data, function(resourceIds) {
			// elements.permissionsForm.find(':checkbox').attr('checked', false);
			// $.each(resourceIds, function(index, value) {
				// elements.permissionsForm.find(':checkbox[value="' + value + '"]').attr('checked', true);
			// });

			// elements.permissionsDialog.dialog('open');
			// elements.permissionsDialog.dialog( "option", "resizable", false ); /*MyCode*/
			// /*MyCode*/
			// var a = document.getElementById(groupId).innerText;
			// elements.permissionsDialog.dialog("option", "title", a);
		// });
		
		var groupId = getActiveId();
		elements.addedResources.find('.resource-item').remove();
		elements.removedResources.find('.resource-item').remove();
		elements.resourceList.find('.resource-item').clone().appendTo(elements.removedResources);
		var data = {dr: opts.dataRequests.permissions, gid: groupId};
		$.get(opts.permissionsUrl, data, function (resourceIds) {
			$.each(resourceIds, function (index, value) {
				elements.permissionsForm.find(':checkbox[value="' + value + '"]').attr('checked', true);
				var resourceLine = elements.removedResources.find('div[resourceId=' + value + ']');
				resourceLine.appendTo(elements.addedResources);
			});
		});

		elements.permissionsDialog.dialog('open');
		elements.permissionsDialog.dialog( "option", "resizable", false );
		
		var newTitle = document.getElementById(groupId).innerText;
			originalTitle = elements.permissionsDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.permissionsDialog.dialog("option", "title", elements.permissionsDialog.dialog("option", "title") + ": " + shortText);
	};

	//Open delete group dialog
	var deleteGroup = function() {
		var groupId = getActiveId();
		elements.deleteDialog.dialog('open');
		elements.deleteDialog.dialog( "option", "resizable", false ); /*MyCode*/
		var newTitle = document.getElementById(groupId).innerText;
		originalTitle = elements.deleteDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
		elements.deleteDialog.dialog("option", "title", elements.deleteDialog.dialog("option", "title") + ": " + shortText);
	};

	//Opens change roles dialog
	var changeRoles = function() {
		var groupId = getActiveId();

		// var data = {dr: opts.dataRequests.roles, gid: groupId};
		// $.get(opts.rolesUrl, data, function(roleIds) {
			// elements.rolesForm.find(':checkbox').attr('checked', false);
			// $.each(roleIds, function(index, value) {
				// elements.rolesForm.find(':checkbox[value="' + value + '"]').attr('checked', true);
			// });

		elements.addedRoles.find('.role-item').remove();
		elements.removedRoles.find('.role-item').remove();

		elements.roleList.find('.role-item').clone().appendTo(elements.removedRoles);
		var data = {dr: opts.dataRequests.roles, gid: groupId};
		$.get(opts.rolesUrl, data, function (roleIds) {
			$.each(roleIds, function (index, value) {
				elements.rolesForm.find(':checkbox[value="' + value + '"]').attr('checked', true);
				var roleLine = elements.removedRoles.find('div[roleId=' + value + ']');
				roleLine.appendTo(elements.addedRoles);
			});
			
			elements.rolesDialog.dialog('open');
			elements.rolesDialog.dialog( "option", "resizable", false ); /*MyCode*/
			
			/*MyCode*/
			var newTitle = document.getElementById(groupId).innerText;
			originalTitle = elements.rolesDialog.dialog("option", "title");
			if (newTitle.length > 10){
				shortText = jQuery.trim(newTitle).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
			}
			else{
				shortText = newTitle;
			}
			elements.rolesDialog.dialog("option", "title", elements.rolesDialog.dialog("option", "title") + ": " + shortText);
		});
	};

	//Unused
	var changeGroupAdmin = function() {
		var groupId = getActiveId();

		elements.groupAdminForm.find('select').val('');
		
		elements.groupAdminDialog.dialog('open');
		elements.groupAdminDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};
}