//Blackouts managements
function BlackoutManagement(opts)
{
	var options = opts;

	//Elements
	var elements = {
		startDate: $("#formattedStartDate"),
		endDate: $("#formattedEndDate"),
		scheduleId: $("#scheduleId"),
		resourceId: $("#resourceId"),
        blackoutTable: $("#blackoutTable"),
        reservationTable: $("#reservationTable"),

		allResources: $('#allResources'),
		addResourceId: $('#addResourceId'),
		addScheduleId: $('#addScheduleId'),

		deleteDialog: $('#deleteDialog'),
		deleteRecurringDialog: $('#deleteRecurringDialog'),

        deleteForm: $('#deleteForm'),
		deleteRecurringForm: $('#deleteRecurringForm'),
		addBlackoutForm: $('#addBlackoutForm'),

		referenceNumberList: $(':hidden.reservationId')
	};

	var blackouts = new Object();
    var blackoutId;

	//Init
	BlackoutManagement.prototype.init = function()
	{
		//Dialogs
        ConfigureAdminDialog(elements.deleteDialog, 'auto', 'auto');
        ConfigureAdminDialog(elements.deleteRecurringDialog, 'auto', 'auto');

		//Wireup buttons
		wireUpUpdateButtons();

		//User events
		$(".save").click(function() {
			$(this).closest('form').submit();
		});

		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});

		$('#createDiv').delegate('.reload', 'click', function(e) {
			location.reload();
		});

		$('#createDiv').delegate('.close', 'click', function(e) {
			$('#createDiv').hide();
			$.colorbox.close();
		});

		elements.blackoutTable.find('.editable td:not(.update)').click(function (e)
		{
			var tr = $(this).parents('tr');
			var id = tr.find('.id').text();

			$.colorbox(
					{   inline: false,
						href: opts.editUrl + id,
						transition: "none",
						width: "30%",	/*MyCode*/
						height: "70%",	/*MyCode*/
						overlayClose: false,
						onComplete: function ()
						{
							ConfigureAdminForm($('#editBlackoutForm'), getUpdateUrl, onAddSuccess, null, {onBeforeSubmit: onBeforeAddSubmit, target: '#result'});

							wireUpUpdateButtons();

							$(".save").click(function() {
								$(this).closest('form').submit();
							});

							$('#cancelUpdate').click(function (e)
							{
								$.colorbox.close();
							});

							$('.blackoutResources').click(function (e)
							{
								if ($(".blackoutResources input:checked").length == 0)
								{
									e.preventDefault();
								}
							});

							$('#updateStartTime').timepicker({
								show24Hours: false
							});

							$('#updateEndTime').timepicker({
								show24Hours: false
							});

						}});
		});

		handleBlackoutApplicabilityChange();
		wireUpTimePickers();

		elements.blackoutTable.delegate('.update', 'click', function(e) {
            e.preventDefault();

            var tr = $(this).parents('tr');
            var id = tr.find('.id').text();
            setActiveBlackoutId(id);
		});

        elements.blackoutTable.delegate('.delete', 'click', function() {
            showDeleteBlackout();
		});

		elements.blackoutTable.delegate('.delete-recurring', 'click', function() {
            showDeleteRecurringBlackout();
		});

		$('#showAll').click(function(e)
		{
			e.preventDefault();
			elements.startDate.val('');
			elements.endDate.val('');
			elements.scheduleId.val('');
			elements.resourceId.val('');

			filterReservations();
		});
		$('#filter').click(filterReservations);

		//Configure forms
		ConfigureAdminForm(elements.addBlackoutForm, getAddUrl, onAddSuccess, null, {onBeforeSubmit: onBeforeAddSubmit, target: '#result'});
		ConfigureAdminForm(elements.deleteForm, getDeleteUrl, onDeleteSuccess, null, {onBeforeSubmit: onBeforeDeleteSubmit, target: '#result'});
		ConfigureAdminForm(elements.deleteRecurringForm, getDeleteUrl, onDeleteSuccess, null, {onBeforeSubmit: onBeforeDeleteSubmit, target: '#result'});
	};

	//Show delete blackouts
    function showDeleteBlackout() {
        elements.deleteDialog.dialog('open');
		//MyCode
		//Deletes without dialog
		document.getElementsByTagName("button")[3].click();
    }

	//Show delete recurrent blackouts
	function showDeleteRecurringBlackout() {
        elements.deleteRecurringDialog.dialog('open');
    }

	//Sets active blackout identifier
    function setActiveBlackoutId(id) {
        blackoutId = id;
    }

	//Gets active blackout identifier
    function getActiveBlackoutId() {
       return blackoutId;
    }

	//Before submit
	function onBeforeAddSubmit(formData, jqForm, opts)
	{
		var isValid = BeforeFormSubmit(formData, jqForm, opts);

		if (isValid)
		{
			$.colorbox({inline:true, href:"#createDiv", transition:"none", width:"75%", height:"75%", overlayClose: false});
			$('#result').hide();
			$('#creating, #createDiv').show();
		}
		return isValid;
	}

	//Before delete submit
    function onBeforeDeleteSubmit()
    {
        $.colorbox({inline:true, href:"#createDiv", transition:"none", width:"75%", height:"75%", overlayClose: false});
        $('#result').hide();
        $('#creating, #createDiv').show();
    }

	//Creation successful
	function onAddSuccess()
	{
		$('#creating').hide();
		$('#result').show();

        $("#reservationTable").find('.editable').each(function() {
           var refNum = $(this).find('.referenceNumber').text();
           $(this).attachReservationPopup(refNum, options.popupUrl);
       });

        $("#reservationTable").delegate('.editable', 'click', function() {
            $(this).addClass('clicked');
            var td = $(this).find('.referenceNumber');
            viewReservation(td.text());
        });
	}

	//Unused
    function onDeleteSuccess()
    {
        //MyCode
		//location.reload();
    }
	
	//Delete url
	function getDeleteUrl()
	{
		return opts.deleteUrl + getActiveBlackoutId();
	}

	//Creation url
	function getAddUrl()
	{
		return opts.addUrl;
	}

	//Update url
	function getUpdateUrl()
	{
		return opts.updateUrl;
	}

	//Sets active reference number
	function setActiveReferenceNumber(referenceNumber)
	{
		this.referenceNumber = referenceNumber;
	}

	//Gets active reference number
	function getActiveReferenceNumber()
	{
		return this.referenceNumber;
	}

	//Sets active reservation identifier
	function setActiveReservationId(reservationId)
	{
		this.reservationId = reservationId;
	}

	//Gets active reservation identifier
	function getActiveReservationId()
	{
		return this.reservationId;
	}

	//Deletes reservation
	function showDeleteReservation(referenceNumber)
	{
		if (reservations[referenceNumber].isRecurring == '1')
		{
			elements.deleteSeriesDialog.dialog('open');
		}
		else
		{
			elements.deleteInstanceDialog.dialog('open');
		}
	}
	
	//Filters reservations
	function filterReservations()
	{
		var filterQuery =
				'sd=' + elements.startDate.val() +
				'&ed=' + elements.endDate.val() +
				'&sid=' + elements.scheduleId.val() +
				'&rid=' + elements.resourceId.val();

		window.location = document.location.pathname + '?' + encodeURI(filterQuery);
	}

	//View reservations
	function viewReservation(referenceNumber)
	{
		window.location = options.reservationUrlTemplate.replace('[refnum]', referenceNumber);
	}

	//Handles applicability
	function handleBlackoutApplicabilityChange()
	{
		elements.allResources.change(function(){
			if ($(this).is(':checked'))
			{
				elements.addResourceId.attr('disabled', 'disabled');
				elements.addScheduleId.removeAttr('disabled');
			}
			else
			{
				elements.addScheduleId.attr('disabled', 'disabled');
				elements.addResourceId.removeAttr('disabled');
			}
		});
	}

	//Wire up time pick
	function wireUpTimePickers()
	{
		$('#addStartTime').timepicker({
			show24Hours: false
		});
		$('#addEndTime').timepicker({
			show24Hours: false
		});
	}

	//Change scope
	function ChangeUpdateScope(updateScopeValue)
	{
		$('.hdnSeriesUpdateScope').val(updateScopeValue);
	}

	//Wire up buttons
	function wireUpUpdateButtons()
	{
		$('.btnUpdateThisInstance').click(function ()
		{
			ChangeUpdateScope(options.scopeOpts.instance);
		});

		$('.btnUpdateAllInstances').click(function ()
		{
			ChangeUpdateScope(options.scopeOpts.full);
		});
	}
}