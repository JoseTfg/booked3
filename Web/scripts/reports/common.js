/**
 Copyright 2015 Nick Korbel

 This file is part of Booked Scheduler.

 Booked Scheduler is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 Booked Scheduler is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

//Reports
function ReportsCommon() {
	return {
		//Initialization
		init: function () {

			//User events
			$(document).on('click', '#btnChart', function (e) {
				e.preventDefault();

				var chart = new Chart();
				chart.generate();
				$('#report-results').hide();
			});

			$('body').click(function(e){
				if (!$(e.target).closest('#customize-columns').length && !$(e.target).closest('#btnCustomizeColumns').length) {
					$('#customize-columns').hide();
				}
			});

			//Show column
			function showColumn(title, show) {
				var reportResults = $('#report-results');
				var th = reportResults.find('th[data-columnTitle="' + title + '"]');
				var allCells = th.closest('tr').children();
				var normalIndex = allCells.index(th) + 1;
				var colSelector = 'td:nth-child(' + normalIndex + ')';
				var col = reportResults.find(colSelector );

				if (show)
				{
					th.show();
					col.show();
				}
				else
				{
					th.hide();
					col.hide();
				}
			}

			//Inits columns
			function initColumns(savedColumns){
				$.each(getAllColumnTitles(), function(i, title){
					if ($.inArray(title, savedColumns) == -1 && savedColumns.length > 0) {
						showColumn(title, false);
					}
				});
			}

			//Gets columns titles
			function getAllColumnTitles() {
				return $.map($('#report-results').find('th'), function(v) {
					return $(v).attr('data-columnTitle');
				});
			}

			//Loads report results
			$(document).on('loaded', '#report-results', function (e) {
				var cookieName = 'report-columns';
				var separator = '!s!';
				var cookie = readCookie(cookieName);
				var savedCols = cookie ? cookie.split(separator) : [];
				initColumns(savedCols);

				var items = [];
				var allColumns = getAllColumnTitles();
				$.each(allColumns, function(i, title){
					var checked = savedCols.length == 0 || $.inArray(title, savedCols) != -1 ? ' checked="checked" ' : '';
					//MyCode
					if (title == "Participants" || title == "ReferenceNumber" || title.indexOf("Mod") != -1 || title.indexOf("Test") != -1){
						items.push('<div style="display:none" ><label><input type="checkbox"' + 'value="' + title + '"/> ' + title + '</label></div>');
						showColumn(title, false);
					}
					else if(title == "Resource" || title == "Title" || title == "Description" || title == "User" || title == "Group"){
						var newTitle = document.getElementById(title+"String");
						items.push('<div><label><input type="checkbox"' + checked + 'value="' + title + '"/> ' +  newTitle.value + '</label></div>');
					}
					else{
					items.push('<div><label><input type="checkbox"' + checked + 'value="' + title + '"/> ' + title + '</label></div>');
					}
				});

				var customizeColumns = $('#customize-columns');
				customizeColumns.empty();
				$('<div/>', {'class': '', html: items.join('')}).appendTo(customizeColumns);

				var btnCustomizeColumns = $('#btnCustomizeColumns');
				customizeColumns.position({my:'right top', at:'right bottom', of: btnCustomizeColumns});

				customizeColumns.find(':checkbox').unbind('click');

				customizeColumns.on('click', ':checkbox', function(e) {
					showColumn($(this).val(), $(this).is(':checked'));

					var columnsToSave = $.map(customizeColumns.find(':checked'), function(checkbox){
						return $(checkbox).val();
					});
					createCookie(cookieName, columnsToSave.join(separator), 30, opts.scriptUrl);
				});

				btnCustomizeColumns.unbind('click').on('click', function(e) {
					e.preventDefault();
					customizeColumns.show();
				});
			});

			//Cancel
			$('.dialog .cancel').click(function (e) {
				$(this).closest('.dialog').dialog("close");
			});
		}
	}
}