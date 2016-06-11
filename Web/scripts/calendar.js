function Calendar(opts, reservations)
{
	//Variable Declaration
	_options = opts;					//Options
	_reservations = reservations;		//Events

	//Calendar init
	Calendar.prototype.init = function()
	{
		//Calendar definition
		$('#calendar').fullCalendar({
			
			//Header
			header: '',
			//center: 'today',
			//right: 'prevYear,prev,agendaDay,agendaWeek,month,next,nextYear' // buttons for switching between views
			//editable: false,
			
			//View Options
			defaultView: _options.view,
			year: _options.year,
			month: _options.month-1,
			date: _options.date,
			
			//Events
			events: _reservations,
			eventRender: function(event, element) {			
			element.attachReservationPopup(event.id);
			
			//RightClick enhance
			rightClick(element,event);		
			
			//Color assign enhance
			if (event.className != "blackout"){
					if (_options.myCal == 1){
						element.find('.fc-event-title').append("<br/>" + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +event.trueTitle);
					}
					else{
						element.find('.fc-event-title').append("<br/>" + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +event.owner + "<br/>" +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +event.trueTitle);
					}					
				colorAssign(element,event);	
			}
			
			},			
						
			//ClickEvents
			dayClick: dayClick,
			eventClick: function(event) {
				
				changeSelection($(this));
				
				//Single Click enhance
				if(event.className.indexOf("blackout") == 0){
					mouseInput("blackoutClick","blackout"+event.id);
				}
				else{					
					mouseInput("eventClick",event.id);
				}
				
				//Reacts to double click
				$(this).dblclick(function(){
					
					//Blackout Double Click enhance
					if(event.className.indexOf("blackout") == 0){
						mouseInput("blackoutDoubleClick",event);
					}
					
					//Event Double Click enhance
					else{					
						mouseInput("eventDoubleClick",event);					
					}
				});
			},
			
			//Names
			dayNames: _options.dayNames,
			dayNamesShort: _options.dayNamesShort,
			monthNames: _options.monthNames,
			monthNamesShort: _options.monthNamesShort,
			weekMode: 'variable',
			
			//Formats
			timeFormat: _options.timeFormat,
			columnFormat:  {
				month: 'dddd',
			    week: 'dddd ' + _options.dayMonth,
			    day: 'dddd ' + _options.dayMonth
			},
			axisFormat: _options.timeFormat,
			
			//Min and Max Time
			firstDay: _options.firstDay,
			minTime: _options.minTime,
			maxTime: _options.maxTime,
			
			//Size
			contentHeight: $(window).height() - 120,		//To make it smaller
			//Width: contentHeight,
			
			//Sensitivity
			editable: true,					// Is editable
			//eventDurationEditable: true,
            droppable: true, 				// Is droppable
			disableResizing:true,
			eventDurationEditable:true,
			//eventDurationEditable:false,
			selectable: true,				// Is selectable

			//Selection enhance
			select: function (start, end, jsEvent, view) {
				
				//Variables
				var sd = '';
				var ed = '';
				var url =  [location.protocol, '//', location.host, "/booked/Web/",_options.dayClickUrl].join('');
				sd = getUrlFormattedDate(start);
				ed = getUrlFormattedDate(end);
				addToUrl = "&sd=" + sd + "&ed=" + ed;
				url = url + addToUrl;

				//Checking the view.
				var view = $('#calendar').fullCalendar('getView');
				if (view.name.substr(0,6) == "agenda"){
					hourDifference = ed.slice(ed.lastIndexOf("%")+1,ed.lastIndexOf(":")) - sd.slice(sd.lastIndexOf("%")+1,sd.lastIndexOf(":"));
					minDifference = sd.substr(15).localeCompare(ed.substr(15));
					 
					 //Checking if it was a single click.
					 if (hourDifference == 0  || hourDifference == 1 && minDifference != 0){
					 }
					 
					 //If it was a true selection, executes this code.
					 else{
						dragSelection(url);
					}
				}
				
			},
			
			//Drag Event
			//eventDragStop: function(event, jsEvent, ui, view) {
			eventDrop: function(event, dayDelta, minuteDelta, jsEvent, ui, view ){
			
			//Variables
			var sd = '';
			var ed = '';
			var day = '';
			
			//Date generation
			var coeff = 1000 * 60 * 1;			
			sd = event.start.getTime() + minuteDelta*60;
			sd = new Date(Math.round(sd / coeff) * coeff);
			sd = getUrlFormattedDate(sd);
			ed = event.end.getTime() + minuteDelta*60;
			ed = new Date(Math.round(ed / coeff) * coeff);
			ed = getUrlFormattedDate(ed);

			if (dayDelta != 0){
				day = sd.substr(sd.lastIndexOf("-")+1,2);
				if (day.indexOf("%") != -1){ day = "0"+day.substr(0,1)}
			}
			
			//Execute
			dragStop(event,sd,ed,day);
			
			return;
			
			/*Unused Code*/
			//Variables
			var url = [location.protocol, '//', location.host, "/booked/Web/Services/Authentication/Authenticate"].join('');
			var header = null;
			var username = _options.username;
			var password = _options.password;			
			
			//API: Authentication
			$.post(url, JSON.stringify({username: username, password: password}), function(data, status){
					
					//Authentication Successful.
					if (data.isAuthenticated)
						{
							//Gets the data
							header = {"X-Booked-SessionToken": data.sessionToken, "X-Booked-UserId": data.userId}
							userId = data.userId;							
							reservationID = event.refNumber.substr(19);
							url = [location.protocol, '//', location.host, "/booked/Web/Services/Reservations/",reservationID].join('');
							
							//API: GetReservation
							$.ajax({
							 url: url,
							 type: "GET",
							 headers: header,
							 dataType: "json",
							 
							 //if Success
							 success: function(data) {
							 
							 //Gets the Data
							 existingReservation = data;
							 var request = {     
								accessories: $.map(existingReservation.accessories, function (n)
								{
									return {accessoryId: n.id, quantityRequested: n.quantityReserved };
								}),
								customAttributes: $.map(existingReservation.customAttributes, function (n)
								{
									return {attributeId: n.id, attributeValue: n.value};
								}),
								endDateTime: existingReservation.endDateTime,
								invitees: $.map(existingReservation.invitees, function (n)
								{
									return n.userId;
								}),
								participants: $.map(existingReservation.participants, function (n)
								{
									return n.userId;
								}),
								recurrenceRule: existingReservation.recurrenceRule,
								resourceId: existingReservation.resourceId,
								resources: $.map(existingReservation.resources, function (n)
								{
									return n.id;
								}),
						 
								startDateTime: existingReservation.startDateTime,
								title: existingReservation.title,
								userId: existingReservation.owner.userId,
								startReminder: existingReservation.startReminder,
								endReminder: existingReservation.endReminder
							};	//request
							 
							 //Modifies
							 var d = new Date(event.start);
							 //d.setHours(d.getHours()+4);
							 request.startDateTime = d.toISOString();
							 var e = new Date(event.end);
							 //e.setHours(e.getHours()+4);
							 request.endDateTime = e.toISOString();
							 

							 //request.startDateTime = event.start.toUTCString();
							 //alert(event.start);
							 //var a = event.start.toString().substr(0,21).toISOString();
							 
							//Check permissions
							if (userId == existingReservation.owner.userId){
							//if(false){
								//API: Update Rservation
								$.ajax({
							 url: url,
							 type: "POST",
							 headers: header,
							 data: JSON.stringify(request),
							 dataType: "json",
							 
							 //if Success
							 success: function(data) {
								var type = viewGetter();
								location.reload();
							 }	//	(function) 	Update success
						  });	//	(ajax) 		Update Reservation
							}	// 	(if) 		Check Permissions
							else{
							location.reload();}
							 }, //	(function) 	Get Reservation success
						  });	// 	(ajax)		Get Reservation							
						}		//	(if) 		Authentication
						else
						{
							alert(data.message);
						}
				}, "json" );	//	(ajax)		Authentication				
		
			}					//	(function)	EventDragStop	
			
		});

		//Fullcalendar Widget Content
		$('.fc-widget-content').hover(
			function() {
				$(this).addClass('hover');
			},
				
			function() {
				$(this).removeClass('hover');
			}
		);

		//Reservation Popup
		$(".reservation").each(function(index, value) {
			var refNum = $(this).attr('refNum');
			value.attachReservationPopup(refNum);
		});			
       
		//Resource Groups
		$('#showResourceGroups').click(function(e){
			e.preventDefault();

			var resourceGroupsContainer = $('#resourceGroupsContainer');

			if (resourceGroupsContainer.is(':visible'))
			{
				resourceGroupsContainer.hide();
			}
			else
			{
				if (!resourceGroupsContainer.data('positionSet'))
				{
					resourceGroupsContainer.position({my:'left top',at: 'right bottom',of:'#showResourceGroups'})
				}
				resourceGroupsContainer.data('positionSet', true);
				resourceGroupsContainer.show();
			}
		})
	};

	//BindResourceGroups
	Calendar.prototype.bindResourceGroups = function(resourceGroups, selectedNode)
	{
		if (!resourceGroups || resourceGroups.length == 0)
		{
			$('#showResourceGroups').hide();
			return;
		}
		// this is copied out of schedule.js, so this needs to be fixed

		function ChangeGroup(groupId)
		{
			RedirectToSelf('gid', /gid=\d+/i, "gid=" + groupId, RemoveResourceId);
		}

		function ChangeResource(resourceId)
		{
			RedirectToSelf('rid', /rid=\d+/i, "rid=" + resourceId, RemoveGroupId);
		}

		function RemoveResourceId(url)
		{
			if (!url)
			{
				url = window.location.href;
			}
			return url.replace(/&*rid=\d+/i, "");
		}

		function RemoveGroupId(url)
		{
			return url.replace(/&*gid=\d+/i, "");
		}

		function RedirectToSelf(queryStringParam, regexMatch, substitution, preProcess)
		{
			var url = window.location.href;
			var newUrl = window.location.href;

			if (preProcess)
			{
				newUrl = preProcess(url);
				newUrl = newUrl.replace(/&{2,}/i, "");
			}

			if (newUrl.indexOf(queryStringParam + "=") != -1)
			{
				newUrl = newUrl.replace(regexMatch, substitution);
			}
			else if (newUrl.indexOf("?") != -1)
			{
				newUrl = newUrl + "&" + substitution;
			}
			else
			{
				newUrl = newUrl + "?" + substitution;
			}

			newUrl = newUrl.replace("#", "");

			window.location = newUrl;
		}

		var groupDiv = $("#resourceGroups");
		groupDiv.tree({
					data: resourceGroups,
					saveState: 'resourceCalendar',

					onCreateLi: function (node, $li)
					{
						if (node.type == 'resource')
						{
							$li.addClass('group-resource')
						}
					}
				});

				groupDiv.bind(
						'tree.select',
						function (event)
						{
							if (event.node)
							{
								var node = event.node;
								if (node.type == 'resource')
								{
									ChangeResource(node.resource_id);
								}
								else
								{
									ChangeGroup(node.id);
								}
							}
						});

		if (selectedNode)
		{
			groupDiv.tree('openNode', groupDiv.tree('getNodeById', selectedNode));
		}
	};		//BindResourceGroups
}			//Calendar

	

