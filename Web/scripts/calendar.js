function Calendar(opts, reservations)
{
	var _options = opts;
	var _reservations = reservations;

	var dayDialog = $('#dayDialog');
	
	//MyCode
	var isOpenedFirstTime = true;
	var userId = "";
	var idArray = [];
	var colorArray = [];

	Calendar.prototype.init = function()
	{
		$('#calendar').fullCalendar({
			header: '',
			//center: 'today',
        //right: 'prevYear,prev,agendaDay,agendaWeek,month,next,nextYear' // buttons for switching between views
   //},	
			//editable: false,
			defaultView: _options.view,
			year: _options.year,
			month: _options.month-1,
			date: _options.date,
			events: _reservations,
			eventRender: function(event, element) { 
			element.attachReservationPopup(event.id);
				if (idArray.indexOf(event.colorID) == -1){
					idArray.push(event.colorID)
					colorArray.push('#'+Math.floor(Math.random()*16777215).toString(16));	
					$(element).css('background-color',colorArray[colorArray.length-1]);					
				}
				else{
				colorPosition = idArray.indexOf(event.colorID);
				$(element).css('background-color',colorArray[colorPosition]);
				}
			element.bind('mousedown', function (e) {
			if (e.which == 3) {
				$('#calendar').fullCalendar( 'removeEvents', event.id )
			}
			});				
			},
			dayRender: function(date, element) {			
				element.bind('mousedown', function (e) {
					if (e.which == 3) {
						$(element).css('background-color','#C8C8C8');
					}
				});		
			},
			dayClick: dayClick,
			dayNames: _options.dayNames,
			dayNamesShort: _options.dayNamesShort,
			monthNames: _options.monthNames,
			monthNamesShort: _options.monthNamesShort,
			weekMode: 'variable',
			timeFormat: _options.timeFormat,
			columnFormat:  {
				month: 'dddd',
			    week: 'dddd ' + _options.dayMonth,
			    day: 'dddd ' + _options.dayMonth
			},
			axisFormat: _options.timeFormat,
			firstDay: _options.firstDay,
			minTime: _options.minTime,
			maxTime: _options.maxTime,
			
			contentHeight: $(window).height() - 100,		//To make it smaller
			//Width: contentHeight,
			editable: true,
			//eventDurationEditable: true,
            droppable: true, // this allows things to be dropped onto the calendar
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////MyCode/////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//Making it selectable
			selectable: true,
			select: function (start, end, jsEvent, view) {
				var sd = '';
				var ed = '';
				var url =  _options.dayClickUrl;
				sd = getUrlFormattedDate(start);
				ed = getUrlFormattedDate(end);
				addToUrl = "&sd=" + sd + "&ed=" + ed;
				//var url = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + addToUrl;
				var url = url + addToUrl;
				
				//Only in agendaDay
				var view = $('#calendar').fullCalendar('getView');
				if (view.name.substr(0,6) == "agenda"){
					//d = sd.substr(12,2).localeCompare(ed.substr(12,2));
					//d = ed.substr(12,2) - sd.substr(12,2);
					hourDifference = ed.slice(ed.lastIndexOf("%")+1,ed.lastIndexOf(":")) - sd.slice(sd.lastIndexOf("%")+1,sd.lastIndexOf(":"));
					minDifference = sd.substr(15).localeCompare(ed.substr(15));
					 if (hourDifference == 0  || hourDifference == 1 && minDifference != 0){
					 }
					 else{
						window.location = url;
					}
				}
			},
			
			eventDragStop: function(event, jsEvent, ui, view) {
			var url = [location.protocol, '//', location.host, "/booked/Web/Services/Authentication/Authenticate"].join('');
			var header = null;
			var username = _options.username;
			var password = _options.password;
			$.post(url, JSON.stringify({username: username, password: password}), function(data, status){
					if (data.isAuthenticated)
						{
							header = {"X-Booked-SessionToken": data.sessionToken, "X-Booked-UserId": data.userId}
							userId = data.userId;
							
							reservationID = event.url.substr(19);
							url = [location.protocol, '//', location.host, "/booked/Web/Services/Reservations/",reservationID].join('');
							
							$.ajax({
							 url: url,
							 type: "GET",
							 headers: header,
							 dataType: "json",
							 success: function(data) {
							 //c = data;
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
							};
							
							 //alert(userId);
							 //alert(existingReservation.owner.userId);
							 
							 request.startDateTime = event.start.toISOString().substr(0,25)+"-0600";
							 request.endDateTime = event.end.toISOString().substr(0,25)+"-0600";
							 
							 //if (userId == existingReservation.owner.userId){}							 
								$.ajax({
							 url: url,
							 type: "POST",
							 headers: header,
							 data: JSON.stringify(request),
							 dataType: "json",
							 success: function(data) {
								var type = viewGetter();
								url = document.URL;
								alert("Update Sucessful");
								window.location = url;
							 },
							 error: function (xhr, ajaxOptions, thrownError) {
								var type = viewGetter();
								url = document.URL;
								url = url.substr(0,url.lastIndexOf("&"))+"&ct="+type;
								alert("Cannot Update");
								window.location = url;
							  }
						  });						  
							 }
						  });

							
						}
						else
						{
							alert(data.message);
						}
				}, "json" );
				
		
			}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
		});

		$('.fc-widget-content').hover(
			function() {
				$(this).addClass('hover');
			},
				
			function() {
				$(this).removeClass('hover');
			}
		);

		$(".reservation").each(function(index, value) {
			var refNum = $(this).attr('refNum');
			value.attachReservationPopup(refNum);
		});

		
		//MyCode
		$('#calendarFilter').multiselect({
			beforeopen: function(){
			if (isOpenedFirstTime == false){
				$('#calendar').fullCalendar('destroy');
				document.body.style.background = "url('css/loading.gif') no-repeat center";
			}
				//$(".ui-multiselect-all").hide();
				//$(".ui-multiselect-none").hide();
			},
			header: true,
			autoOpen: true,
			selectedText: function () {
				inputs = this.inputs;
				checked = inputs.filter(':checked');
				numChecked = checked.length;
				return numChecked + ' selected';
                },
		   open: function(){		   
			  if (isOpenedFirstTime){
				 $('#calendarFilter').multiselect("close");
			  }			
				
			  var url = document.URL;
			  //Make an array
			  if (url.indexOf("rid") == -1){
				//no-op
			  }
			  else{
			  ridArray = url.substr(url.indexOf("rid"));
			  if (ridArray.indexOf("&") != -1){
				ridArray = ridArray.substr(0,ridArray.indexOf("&"));
			  }
			  ridArray = ridArray.substr(4);
			  var dataarray = ridArray.split(",");
			  $(this).val(dataarray);
			  $(this).multiselect("refresh");
			  }
		   },
		   
		   close: function(){
			var day = getQueryStringValue('d');
			var month = getQueryStringValue('m');
			var year = getQueryStringValue('y');
			var type = getQueryStringValue('ct');
			var scheduleId = '';
			var resourceId = '';

			resourceId = '&rid=' + $(this).val();


			var url = [location.protocol, '//', location.host, location.pathname].join('');
			url = url + '?ct=' + type + '&d=' + day + '&m=' + month + '&y=' + year + '&sid=' + resourceId;			
			
			if (isOpenedFirstTime){
				isOpenedFirstTime = false;
				}
				else{
			window.location = url;		
			}			
			
			},
			selectedList: 4		
		}).multiselectfilter();
		
		//$('#calendarFilter').multiselect().multiselectfilter();
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////MyCode/////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		//OnOff Switch
		$('#myonoffswitch').change(function() {
			var day = getQueryStringValue('d');
			var month = getQueryStringValue('m');
			var year = getQueryStringValue('y');
			var type = getQueryStringValue('ct');

			//Redirect to correct url
			if (_options.myCal == 1){
				var url = [location.protocol, '//', location.host, '/booked/Web/calendar.php'].join('');
			}
			else{
				var url = [location.protocol, '//', location.host, '/booked/Web/my-calendar.php'].join('');
			}
			
			//Send to url
			url = url + '?ct=' + type + '&d=' + day + '&m=' + month + '&y=' + year;			
			window.location = url;
		});
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $('#turnOffSubscription').click(function(e){
            e.preventDefault();
            PerformAsyncAction($(this), function(){return opts.subscriptionDisableUrl;});
        });

        $('#turnOnSubscription').click(function(e){
            e.preventDefault();
            PerformAsyncAction($(this), function(){return opts.subscriptionEnableUrl;});
        });

		dayDialog.find('a').click(function(e){
			e.preventDefault();
		});

		$('#dayDialogCancel').click(function(e){
			dayDialog.dialog('close');
		});

		$('#dayDialogView').click(function(e){
			drillDownClick();
		});

		$('#dayDialogCreate').click(function(e){
			openNewReservation();
		});

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
	};

	var dateVar = null;

	var dayClick = function(date, allDay, jsEvent, view)
	{
		dateVar = date;
		myDayClick();		
		return;

		//Unused
		if (!opts.reservable)
		{
			drillDownClick();
			return;
		}

		if (view.name.indexOf("Day") > 0)
		{
			handleTimeClick();
		}
		else
		{
			dayDialog.dialog({modal: false, height: 70, width: 'auto'});
			dayDialog.dialog("widget").position({
						       my: 'left top',
						       at: 'left bottom',
						       of: jsEvent
						    });
		}
	};

	var handleTimeClick = function()
	{
		openNewReservation();
	};

	var drillDownClick = function()
	{
		var month =  dateVar.getMonth()+1;
		var url =  _options.dayClickUrl;
		url = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate();

		window.location = url;
	};

	//Unused
	var openNewReservation = function(){
		var end = new Date(dateVar);
		end.setMinutes(dateVar.getMinutes()+30);

		var url = _options.reservationUrl + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);

		window.location = url;
	};

	var getUrlFormattedDate = function(d)
	{
		var month =  d.getMonth()+1;
		return encodeURI(d.getFullYear() + "-" + month + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes());
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////MyCode/////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var myDayClick = function(){
		var view = $('#calendar').fullCalendar('getView');
		var month =  dateVar.getMonth()+1;
		
		//Redirect to correct view
		if (view.name != "agendaDay"){
			var url = [location.protocol, '//', location.host, location.pathname].join('');
			if (view.name == "agendaWeek"){
				type = "day";
			}
			else{
				type = "week";
			}
			
			//Send to url
			url = url + '?d=' + dateVar.getDate() + '&m=' + month + '&y=' + dateVar.getFullYear() + '&ct=' + type;			
			window.location = url;
			}
			
		//Open reservation menu	
		else{		
			var url =  _options.dayClickUrl;
			var end = new Date(dateVar);
			end.setMinutes(dateVar.getMinutes()+30);

			//Send to url
			var url = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);
			window.location = url;
		}
	};
	
	var viewGetter = function(){
		var view = $('#calendar').fullCalendar('getView');
		if (view.name == "agendaDay"){
			return "day";
		} else if (view.name == "agendaWeek") {
			return "week";		
		}
		else{
		return "month"}
	};
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
