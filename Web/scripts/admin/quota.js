//Quota management
function QuotaManagement(opts)
{
	var options = opts;
	
	//Elements
	var elements = {
		
		addForm: $('#addQuotaForm'),
		deleteForm: $('#deleteQuotaForm'),
		deleteDialog: $('#deleteDialog'),
		addDialog: $('#addDialog')
	};

	var activeQuotaId = null;
	
	//Init
	QuotaManagement.prototype.init = function()
	{
		//Configure dialogs
		ConfigureAdminDialog(elements.deleteDialog);
		ConfigureAdminDialog(elements.addDialog);
		   
		//User events
		$('.delete').click(function(e) {
			e.preventDefault();
			setActiveQuotaId($(this).attr('quotaId'));
			elements.deleteDialog.dialog('open');
			elements.deleteDialog.dialog( "option", "resizable", false ); /*MyCode*/
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
		
		$(".cancel").click(function() {
			$(this).closest('.dialog').dialog("close");
		});
		
		$("#newButton").click(function() {
			$(".warning").hide();
			elements.addDialog.dialog('open');
			elements.addDialog.dialog( "option", "resizable", false ); /*MyCode*/
		});

		//Configure forms
		ConfigureAdminForm(elements.addForm, getSubmitCallback(options.actions.addQuota), null, handleAddError);
		ConfigureAdminForm(elements.deleteForm, getSubmitCallback(options.actions.deleteQuota), null, handleAddError);
	};

	//Gets submit callback
	var getSubmitCallback = function(action)
	{
		return function() {
			return options.submitUrl + "?qid=" + getActiveQuotaId() + "&action=" + action;
		};
	};

	//Handle error
	var handleAddError = function(responseText)
	{
		alert(responseText);
	};

	//Sets active quota identifier
	var setActiveQuotaId = function (quotaId)
	{
		activeQuotaId = quotaId
	};
	
	//Gets active quota identifier
	var getActiveQuotaId = function()
	{
		return activeQuotaId;
	};
	
	//MyCode
	//Checks before submit
	var submitCheck = function(){
		var check = document.getElementsByClassName('textbox')[2].value;
		if ((check > 0) && (check < 25)){
			return true;
		}
		return false;
	};
}