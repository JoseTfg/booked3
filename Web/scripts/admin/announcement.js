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

	//MyCode
	var originalTitle = "";
	
	//Initialization
    AnnouncementManagement.prototype.init = function() {

		ConfigureAdminDialog(elements.editDialog);
		ConfigureAdminDialog(elements.deleteDialog);
		ConfigureAdminDialog(elements.newDialog);

		elements.announcementList.delegate('a.update', 'click', function(e) {
			setActiveId($(this));
			e.preventDefault();
		});

		elements.announcementList.delegate('.edit', 'click', function() {
			$(".warning").hide();
			editAnnouncement();
		});
		elements.announcementList.delegate('.delete', 'click', function() {
			deleteAnnouncement();
		});

		$(".save").click(function() {
			var canSubmit = submitCheck();
			if (canSubmit){
				$(this).closest('form').submit();
			}
			else{
			$(".warning").show();
			}
		});
		
		$('#newButton').click(function()  {
			$(".warning").hide();
			newAnnouncement();
		});
		
		$(".edit").click(function() {
			var canSubmit = submitCheck();
			if (canSubmit){
			$(this).closest('form').submit();
			}
			else{
			$(".warning").show();
			}
		});
		
		$(".delete").click(function() {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});
		
		elements.editDialog.on( "dialogclose", function( event, ui ) {
			elements.editDialog.dialog("option", "title", originalTitle);
		});
		
		elements.deleteDialog.on( "dialogclose", function( event, ui ) {
			elements.deleteDialog.dialog("option", "title", originalTitle);
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
		originalTitle = elements.editDialog.dialog("option", "title");
		if (announcement.text.length > 10){
			shortText = jQuery.trim(announcement.text).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = announcement.text;
		}
		elements.editDialog.dialog("option", "title", elements.editDialog.dialog("option", "title") + ": " + shortText);
	};

	//Opens delete announcement dialog
	var deleteAnnouncement = function() {
		elements.deleteDialog.dialog('open');
		elements.deleteDialog.dialog( "option", "resizable", false ); /*MyCode*/
		
		var announcement = getActiveAnnouncement();
		originalTitle = elements.deleteDialog.dialog("option", "title");
		if (announcement.text.length > 10){
			shortText = jQuery.trim(announcement.text).substring(0, 20).split(" ").slice(0, -1).join(" ") + "...";
		}
		else{
			shortText = announcement.text;
		}
		elements.deleteDialog.dialog("option", "title", elements.deleteDialog.dialog("option", "title") + ": " + shortText);
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
	};
	
	//MyCode
	var submitCheck = function(){
		if ((document.getElementById("BeginDate").value != "") && (document.getElementById("EndDate").value != "")){
			return true;
		}
		return false;
	}
}