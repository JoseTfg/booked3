/**
 Copyright 2012-2015 Nick Korbel

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

 //Resource popups
$.fn.bindResourceDetails = function (resourceId, options)
{
	var opts = $.extend({preventClick:false}, options);

	$(this).removeAttr('resource-details-bound');
	bindResourceDetails($(this));

	//Gets div
	function getDiv()
		{
			if ($('#resourceDetailsDiv').length <= 0)
			{
				return $('<div id="resourceDetailsDiv"/>').appendTo('body');
			}
			else
			{
				return $('#resourceDetailsDiv');
			}
		}

		//Hides div
		function hideDiv()
		{
			var tag = getDiv();
			var timeoutId = setTimeout(function ()
			{
				tag.hide();
			}, 500);
			tag.data('timeoutId', timeoutId);
		}

	//Binds details
	function bindResourceDetails(resourceNameElement)
	{
		if (resourceNameElement.attr('resource-details-bound') === '1')
		{
			return;
		}

		if (opts.preventClick)
		{
			resourceNameElement.click(function (e)
			{
				e.preventDefault();
			});
		}

		var tag = getDiv();

		tag.mouseenter(function ()
		{
			clearTimeout(tag.data('timeoutId'));
		}).mouseleave(function ()
		{
			hideDiv();
		});

		resourceNameElement.mouseenter(function ()
		{
			var tag = getDiv();
			clearTimeout(tag.data('timeoutId'));

			var data = tag.data('resourcePopup' + resourceId);
			if (data != null)
			{
				showData(data);
			}
			else
			{
				$.ajax({
					url:'ajax/resource_details.php?rid=' + resourceId,
					type:'GET',
					cache:true,
					beforeSend:function ()
					{
						tag.html('Loading...').show();
						tag.position({my:'left bottom', at:'right top', of:resourceNameElement});
					},
					error:tag.html('Error loading resource data!').show(),
					success:function (data, textStatus, jqXHR)
					{
						tag.data('resourcePopup' + resourceId, data);
						showData(data);
					}
				});
			}

			//Show data
			function showData(data)
			{
				tag.html(data).show();
				tag.position({my:'left bottom', at:'right top', of:resourceNameElement});
			}
		}).mouseleave(function ()
				{
					hideDiv();
				});

		resourceNameElement.attr('resource-details-bound', '1');
	}

};