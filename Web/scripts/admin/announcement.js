//Announcement management
function AnnouncementManagement(opts) {
	var options = opts;

	var elements = {
		activeId: $('#activeId'),
		announcementList: $('table.list'),

		editDialog: $('#editDialog'),
		deleteDialog: $('#deleteDialog'),
		newDialog: $('#newDialog'),
		newButton: $('#newButton'),

		addForm: $('#addForm'),
		form: $('#editForm'),
		deleteForm: $('#deleteForm'),

        editText: $('#editText'),
        editBegin: $('#editBegin'),
        editEnd: $('#editEnd'),
        editPriority: $('#editPriority')
	};

	var announcements = new Object();

	//Initialization
    AnnouncementManagement.prototype.init = function() {

		ConfigureAdminDialog(elements.editDialog, 550, 230);
		ConfigureAdminDialog(elements.deleteDialog,  500, 140);
		ConfigureAdminDialog(elements.newDialog,  550, 230);

		elements.announcementList.delegate('a.update', 'click', function(e) {
			setActiveId($(this));
			e.preventDefault();
		});

		elements.announcementList.delegate('.edit', 'click', function() {
			editAnnouncement();
		});
		elements.announcementList.delegate('.delete', 'click', function() {
			deleteAnnouncement();
		});
		$('#newButton').click(function()  {
			newAnnouncement();
		});

		$(".save").click(function() {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});

		ConfigureAdminForm(elements.addForm, getSubmitCallback(options.actions.add));
		ConfigureAdminForm(elements.deleteForm, getSubmitCallback(options.actions.deleteAnnouncement));
		ConfigureAdminForm(elements.form, getSubmitCallback(options.actions.edit));
	};

	//Submit callback
	var getSubmitCallback = function(action) {
		return function() {
			return options.submitUrl + "?aid=" + getActiveId() + "&action=" + action;
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

	//Opens edit announcement dialog
	var editAnnouncement = function() {
		var announcement = getActiveAnnouncement();
		elements.editText.val(HtmlDecode(announcement.text));
		elements.editBegin.val(announcement.start);
        elements.editBegin.trigger('change');
		elements.editEnd.val(announcement.end);
		elements.editEnd.trigger('change');
		elements.editPriority.val(announcement.priority);

		elements.editDialog.dialog('open');
		elements.editDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

	//Opens delete announcement dialog
	var deleteAnnouncement = function() {
		elements.deleteDialog.dialog('open');
		elements.deleteDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};
	
	//Opens new announcement dialog
	var newAnnouncement = function() {
		elements.newDialog.dialog('open');
		elements.newDialog.dialog( "option", "resizable", false ); /*MyCode*/
	};

	//Gets active announcement
	var getActiveAnnouncement = function ()
	{
		return announcements[getActiveId()];
	};

	//Adds new announcement
	AnnouncementManagement.prototype.addAnnouncement = function(id, text, start, end, priority)
	{
		announcements[id] = {id: id, text: text, start: start, end: end, priority: priority};
	}
}