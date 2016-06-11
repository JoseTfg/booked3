//Approval
function Approval(opts)
{
	var options = opts;

	//Elements
	var elements = {
		approveButton: $('#btnApprove'),
		referenceNumber: $("#referenceNumber"),
		indicator: $('#indicator')
	};

	//Initialization
	Approval.prototype.initReservation = function() {
		elements.approveButton.click(function() {
			elements.indicator.insertAfter(elements.approveButton).show();
			elements.approveButton.hide();
			$('#dialogSave').dialog('open');
            Approval.prototype.Approve(elements.referenceNumber.val());
		});
	};

	//Approve
	Approval.prototype.Approve = function(referenceNumber) {
		$.ajax({
			url: options.url,
			dataType: 'json',
			data: {rn: referenceNumber, rs: options.responseType},
			success: function(data) {
				//MyCode
				//window.location.reload();
				sessionStorage.setItem('popup_status', 'update');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			  }
		});
	};
}
