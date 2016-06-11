//Schedules managements
function ScheduleManagement(opts)
{
	var options = opts;

	//Elements
	var elements = {
		activeId:$('#activeId'),

		renameDialog:$('#renameDialog'),
		layoutDialog:$('#changeLayoutDialog'),
		changeSettingsDialog:$('#changeSettingsDialog'),
		deleteDialog:$('#deleteDialog'),
		groupAdminDialog:$('#groupAdminDialog'),

		renameForm:$('#renameForm'),
		settingsForm:$('#settingsForm'),
		changeLayoutForm:$('#changeLayoutForm'),
		placeholderForm:$('#placeholderForm'),
		deleteForm:$('#deleteForm'),
		groupAdminForm:$('#groupAdminForm'),

		addForm:$('#addScheduleForm'),

		reservableEdit:$('#reservableEdit'),
		blockedEdit:$('#blockedEdit'),
		layoutTimezone:$('#layoutTimezone'),
		quickLayoutConfig:$('#quickLayoutConfig'),
		quickLayoutStart:$('#quickLayoutStart'),
		quickLayoutEnd:$('#quickLayoutEnd'),
		createQuickLayout:$('#createQuickLayout'),

		daysVisible:$('#daysVisible'),
		dayOfWeek:$('#dayOfWeek'),
		deleteDestinationScheduleId:$('#targetScheduleId'),
		usesSingleLayout:$('#usesSingleLayout'),
		
		addedTimes: $('#addedTimes'),
		removedTimes: $('#removedTimes')
	};

	//Initialization
	ScheduleManagement.prototype.init = function ()
	{
		//Configure dialogs
		ConfigureAdminDialog(elements.renameDialog, 300, 125);
		ConfigureAdminDialog(elements.changeSettingsDialog); //MyCode
		ConfigureAdminDialog(elements.layoutDialog, 725, 'auto');
		ConfigureAdminDialog(elements.deleteDialog, 430, 200);
		ConfigureAdminDialog(elements.groupAdminDialog, 300, 125);

		$('#tabs').tabs();

		//User events
		$('.scheduleDetails').each(function ()
		{
			var id = $(this).find(':hidden.id').val();
			var reservable = $(this).find('.reservableSlots');
			var blocked = $(this).find('.blockedSlots');
			var timezone = $(this).find('.timezone');
			var daysVisible = $(this).find('.daysVisible');
			var dayOfWeek = $(this).find('.dayOfWeek');
			var usesDailyLayouts = $(this).find('.usesDailyLayouts');

			$(this).find('a.update').click(function ()
			{
				setActiveScheduleId(id);
			});

			$(this).find('.renameButton').click(function (e)
			{
				showRename(e);
				return false;
			});

			$(this).find('.changeButton').click(function (e)
			{
				showChangeSettings(e, daysVisible, dayOfWeek);
				return false;
			});

			$(this).find('.changeLayoutButton').click(function (e)
			{
				showChangeLayout(e, reservable, blocked, timezone, (usesDailyLayouts.val() == 'false'));
				return false;
			});

			$(this).find('.makeDefaultButton').click(function (e)
			{
				PerformAsyncAction($(this), getSubmitCallback(options.makeDefaultAction), $('.indicator'));
			});

			$(this).find('.enableSubscription').click(function (e)
			{
				PerformAsyncAction($(this), getSubmitCallback(options.enableSubscriptionAction), $('.indicator'));
			});

			$(this).find('.disableSubscription').click(function (e)
			{
				PerformAsyncAction($(this), getSubmitCallback(options.disableSubscriptionAction), $('.indicator'));
			});

			$(this).find('.deleteScheduleButton').click(function (e)
			{
				showDeleteDialog(e);
				return false;
			});

			$(this).find('.adminButton').click(function (e)
			{
				showScheduleAdmin(e, $(this).attr('adminId'));
				return false;
			});

			$(this).find('.showAllDailyLayouts').click(function(e)
			{
				e.preventDefault();
				$(this).next('.allDailyLayouts').toggle();
			});
		});

		$(".save").click(function ()
		{
			$(this).closest('form').submit();
		});
		
		$(".save-create").click(function ()
		{
			createQuickLayout();
			setActiveScheduleId("1");
			$(this).closest('form').submit();
		});

		$(".cancel").click(function ()
		{
			$(this).closest('.dialog').dialog("close");
		});

		elements.quickLayoutConfig.change(function ()
		{
			createQuickLayout();
		});

		elements.quickLayoutStart.change(function ()
		{
			createQuickLayout();
		});

		elements.quickLayoutEnd.change(function ()
		{
			createQuickLayout();
		});

		elements.createQuickLayout.click(function (e)
		{
			e.preventDefault();
			createQuickLayout();
		});

		elements.usesSingleLayout.change(function ()
		{
			toggleLayoutChange($(this).is(':checked'));
		});
		
		//MyCode
		elements.removedTimes.delegate('div', 'click', function() {
			$(this).appendTo(elements.addedTimes);
			var lines = $('#blockedEdit').val().split('\n');
			for(var i = 0;i < lines.length-1;i++){
				if ($(this).text().indexOf(lines[i]) != -1){
					lines.splice(i,1);
				}
			}
			var toSend = "";
			for(var i = 0;i < lines.length-1;i++){
				toSend = toSend + lines[i] + '\n';
			}
			$('.blockedEdit:visible', elements.layoutDialog).val(toSend);
			
			var toSend2 = $(this).text() + '\n';
			$('.reservableEdit:visible', elements.layoutDialog).val($('.reservableEdit:visible', elements.layoutDialog).val()+toSend2);
		});

		elements.addedTimes.delegate('div', 'click', function() {
			$(this).appendTo(elements.removedTimes);
		});

		//Configure forms
		ConfigureAdminForm(elements.renameForm, getSubmitCallback(options.renameAction));
		ConfigureAdminForm(elements.settingsForm, getSubmitCallback(options.changeSettingsAction));
		ConfigureAdminForm(elements.changeLayoutForm, getSubmitCallback(options.changeLayoutAction));
		ConfigureAdminForm(elements.addForm, getSubmitCallback(options.addAction), null, handleAddError);
		ConfigureAdminForm(elements.deleteForm, getSubmitCallback(options.deleteAction));
		ConfigureAdminForm(elements.groupAdminForm, getSubmitCallback(options.adminAction));
	};

	//Gets submit callback
	var getSubmitCallback = function (action)
	{
		return function ()
		{
			return options.submitUrl + "?sid=" + elements.activeId.val() + "&action=" + action;
		};
	};

	//Creates layout
	var createQuickLayout = function ()
	{
		var intervalMinutes = elements.quickLayoutConfig.val();
		var startTime = elements.quickLayoutStart.val();
		var endTime = elements.quickLayoutEnd.val();

		if (intervalMinutes != '' && startTime != '' && endTime != '')
		{
			var layout = '';
			var blocked = '';

			if (startTime != '00:00')
			{
				var startTimes = startTime.split(":");
				var endDateTime = new Date();
				endDateTime.setHours(startTimes[0]);
				endDateTime.setMinutes(startTimes[1]);
				var currentTime = new Date();
				currentTime.setHours(0);
				currentTime.setMinutes(0);
				var nextTime = new Date(currentTime);
				var intervalMilliseconds = 60 * 1000 * intervalMinutes;
				while (currentTime.getTime() < endDateTime.getTime())
				{					
					nextTime.setTime(nextTime.getTime() + intervalMilliseconds);
					blocked += getFormattedTime(currentTime) + ' - ';
					blocked += getFormattedTime(nextTime) + '\n';
					currentTime.setTime(currentTime.getTime() + intervalMilliseconds);
				}
			}

			if (endTime != '00:00')
			{
				var endTimes = endTime.split(":");
				var endDateTime = new Date();
				endDateTime.setHours(24);
				endDateTime.setMinutes(0);
				var currentTime = new Date();
				currentTime.setHours(endTimes[0]);
				currentTime.setMinutes(endTimes[1]);
				var nextTime = new Date(currentTime);
				var intervalMilliseconds = 60 * 1000 * intervalMinutes;
				while (currentTime.getTime() < endDateTime.getTime())
				{					
					nextTime.setTime(nextTime.getTime() + intervalMilliseconds);
					blocked += getFormattedTime(currentTime) + ' - ';
					blocked += getFormattedTime(nextTime) + '\n';
					currentTime.setTime(currentTime.getTime() + intervalMilliseconds);
				}
			}

			var startTimes = startTime.split(":");
			var endTimes = endTime.split(":");

			var currentTime = new Date();
			currentTime.setHours(startTimes[0]);
			currentTime.setMinutes(startTimes[1]);

			var endDateTime = new Date();
			endDateTime.setHours(endTimes[0]);
			endDateTime.setMinutes(endTimes[1]);

			var nextTime = new Date(currentTime);

			var intervalMilliseconds = 60 * 1000 * intervalMinutes;
			while (currentTime.getTime() < endDateTime.getTime())
			{
				nextTime.setTime(nextTime.getTime() + intervalMilliseconds);

				layout += getFormattedTime(currentTime) + ' - ';
				layout += getFormattedTime(nextTime) + '\n';

				currentTime.setTime(currentTime.getTime() + intervalMilliseconds);
			}

			$('.reservableEdit:visible', elements.layoutDialog).val(layout);
			$('.blockedEdit:visible', elements.layoutDialog).val(blocked);
		}
	};

	//Gets formatted time
	var getFormattedTime = function (date)
	{
		var hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
		var minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
		return hour + ":" + minute;
	};

	//Handle error
	var handleAddError = function (responseText)
	{
		$('#addScheduleResults').text(responseText);
		$('#addScheduleResults').show();
	};

	//Sets active schedule identifier
	var setActiveScheduleId = function (scheduleId)
	{
		elements.activeId.val(scheduleId);
	};

	//Gets active schedule identifier
	var getActiveScheduleId = function ()
	{
		alert(elements.activeId.val());
		return elements.activeId.val();
	};

	//Unused
	var showRename = function (e)
	{
		elements.renameDialog.dialog("option", "position", [e.pageX, e.pageY]);
		elements.renameDialog.dialog("open");
	};

	//Unused
	var showChangeSettings = function (e, daysVisible, dayOfWeek)
	{
		elements.daysVisible.val(daysVisible.val());
		elements.dayOfWeek.val(dayOfWeek.val());

		//MyCode
		elements.changeSettingsDialog.dialog("open");
		elements.changeSettingsDialog.dialog("option", "resizable", false);
	};

	//Show change layout dialog
	var showChangeLayout = function (e, reservableDiv, blockedDiv, timezone, usesSingleLayout)
	{
		$.each(reservableDiv, function(index, val){
			var slots = reformatTimeSlots($(val));
			$('#' + $(val).attr('ref')).val(slots);
		});

		$.each(blockedDiv, function(index, val){
			var slots = reformatTimeSlots($(val));
			$('#' + $(val).attr('ref')).val(slots);
		});

		elements.layoutTimezone.val(timezone.val());
		elements.usesSingleLayout.removeAttr('checked');

		if (usesSingleLayout)
		{
			elements.usesSingleLayout.attr('checked', 'checked');
		}
		elements.usesSingleLayout.trigger('change');

		elements.layoutDialog.dialog("open");
		elements.layoutDialog.dialog("option", "resizable", false);
		
		//MyCode
		var lines = $('#reservableEdit').val().split('\n');
		for(var i = 0;i < lines.length-1;i++){
			$("#addedTimes").append( "<div class='time-item' timeId='"+i+"'><a href='#'>&nbsp;</a>"+lines[i]+"</div>" );
		}
		var lines = $('#blockedEdit').val().split('\n');
		for(var i = 0;i < lines.length-1;i++){
			$("#removedTimes").append( "<div class='time-item' timeId='"+i+"'><a href='#'>&nbsp;</a>"+lines[i]+"</div>" );
		}
	};

	//Unused
	var toggleLayoutChange = function (useSingleLayout)
	{
		if (useSingleLayout)
		{
			$('#dailySlots').hide();
			$('#staticSlots').show();
		}
		else
		{
			$('#staticSlots').hide();
			$('#dailySlots').show();
		}
	};

	//Unused
	var showDeleteDialog = function (e)
	{
		var scheduleId = getActiveScheduleId();
		elements.deleteDestinationScheduleId.children().removeAttr('disabled');
		elements.deleteDestinationScheduleId.children('option[value="' + scheduleId + '"]').attr('disabled', 'disabled');
		elements.deleteDestinationScheduleId.val('');

		elements.deleteDialog.dialog('open');
	};

	//Unused
	var showScheduleAdmin = function (e, adminGroupId)
	{
		$('#adminGroupId').val(adminGroupId);
		elements.groupAdminDialog.dialog("open");
	};

	//Unused
	var reformatTimeSlots = function (div)
	{
		var text = $.trim(div.text());
		text = text.replace(/\s\s+/g, ' ');
		text = text.replace(/\s*,\s*/g, '\n');
		return text;
	};
}