//Canned reports
function CannedReports(reportOptions) {
	var opts = reportOptions;

	//Elements
	var elements = {
		indicator:$('#indicator'),
		resultsDiv:$('#resultsDiv')
	};

	//Initialization
	this.init = function () {

		//Wire up report links
		wireUpReportLinks();

		//User events
		$(document).on('click', '#btnPrint',function (e) {
			e.preventDefault();

			var url = opts.printUrl + reportId;
			window.open(url);
		});

		$(document).on('click', '#btnCsv', function (e) {
			e.preventDefault();

			var url = opts.csvUrl + reportId;
			window.open(url);
		});

		$(document).on('click', '#btnChart', function(e) {
			e.preventDefault();

			var chart = new Chart();
			chart.generate();
			$('#report-results').hide();
		});

		$('.cancel').click(function (e) {
			e.preventDefault();
			$(this).closest('.dialog').dialog('close');
		});
	};

	//Wire up report links
	var wireUpReportLinks = function () {
		$('#report-list a.report').click(function (e) {
			e.preventDefault();
			reportId = $(this).attr('reportId');
		});

		$('.runNow').click(function (e) {
			var before = function () {
				elements.indicator.show().insertBefore(elements.resultsDiv);
				elements.resultsDiv.html('');
			};

			var after = function (data) {
				elements.indicator.hide();
				elements.resultsDiv.html(data)
			};

			ajaxGet(opts.generateUrl + reportId, before, after);
		});

		$('.emailNow').click(function (e) {
			$('#emailDiv').dialog({modal:true});
		});
	};
}