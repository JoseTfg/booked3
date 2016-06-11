//Configuration managements
function Configuration() {
	
	//Elements
	var elements = {
		form: $('#frmConfigSettings'),
		configFileSelection: $('#cf'),
		configFileForm: $('#frmConfigFile')
	};

	//Init
	Configuration.prototype.init = function () {

		//User events
		$(".save").click(function (e) {
			e.preventDefault();
			elements.form.submit();
		});


		elements.configFileSelection.change(function(e){
			elements.configFileForm.submit();
		});

		elements.form.bind('onValidationFailed', onValidationFailed);

		//Configure form
		ConfigureAdminForm(elements.form, defaultSubmitCallback, successHandler, null, {onBeforeSubmit: onBeforeAddSubmit});
	};

	//Default submit callback
	var defaultSubmitCallback = function (form) {
		return form.attr('action') + "?action=" + form.attr('ajaxAction') + "&cf=" + elements.configFileSelection.val();
	};

	//Validation failed
	function onValidationFailed(event, data)
	{
		hideModal();
	}

	//Validation success
	function successHandler(response)
	{
		hideModal();
		$('#updatedMessage').show().delay('3000').fadeOut('slow');
	}

	//Before submit
	function onBeforeAddSubmit(formData, jqForm, opts)
	{
		$('#updatedMessage').hide();

		$.colorbox({inline:true, href:"#modalDiv", transition:"none", width:"75%", height:"75%", overlayClose: false});
		$('#modalDiv').show();

		return true;
	}

	//Hides dialog
	function hideModal()
	{
		$('#modalDiv').hide();
		$.colorbox.close();

		var top = $("#updatedMessage").scrollTop();
		$('html, body').animate({scrollTop:top}, 'slow');
	}

}