//Ajax submit
jQuery.fn.bindAjaxSubmit = function (updateButton, successElement, modalDiv)
{
	var self = this;
	
	//Update button
	updateButton.click(function (e)
	{
		e.preventDefault();
		self.submit();
	});

	//Default submit callback
	var defaultSubmitCallback = function (form)
	{
		return form.attr('action') + "?action=" + form.attr('ajaxAction');
	};

	//On validation failed
	function onValidationFailed(event, data)
	{
		hideModal();
	}

	//Sucess handler
	function successHandler(response)
	{
		hideModal();
		successElement.show().delay(5000).fadeOut();
	}

	//Before submit
	function onBeforeAddSubmit(formData, jqForm, opts)
	{
		successElement.hide();

		$.colorbox({inline:true, href:"#" + modalDiv.attr('id'), transition:"none", width:"75%", height:"75%", overlayClose:false});
		modalDiv.show();

		return true;
	}

	//Hides dialog
	function hideModal()
	{
		modalDiv.hide();
		$.colorbox.close();

		var top = self.scrollTop();
		$('html, body').animate({scrollTop:top}, 'slow');
	}

	self.bind('onValidationFailed', onValidationFailed);
	ConfigureAdminForm(self, defaultSubmitCallback, successHandler, null, {onBeforeSubmit:onBeforeAddSubmit});
};