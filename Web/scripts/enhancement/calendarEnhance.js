//Declarations	
var isOpenedFirstTime = true;			//Fix a bug in the calendar filter
var colorArray = [];					//Related to colors.
var info1 = "my-calendar.php?";			//Related to events
var info2 = "";							//Related to events
var dateVar = null;						//Date
var prevElement = "";
var prevColor = "";
var numLegend  = 0;
var maxLegend = 6;
var readOnly = "";

var enhanceCalendar = function(opts, reservations) {
	
	readOnly = opts.readOnly;
	
	ConfigureAdminDialog($('#dialogBoundaries'));
	ConfigureAdminDialog($('#dialogSubscribe'));
	ConfigureAdminDialog($('#dialogColors'));
	ConfigureAdminDialog($('#dialogDeleteReservation'));
	ConfigureAdminDialog($('#dialogDeleteBlackout'));
	//ConfigureAdminDialog($('#reservationColorbox'));
	//$('#dialogColors').dialog("option","modal",false);
	
		
	$(".dayMenu").contextmenu({
		//delegate: ".dayMenu",
		menu: [
			{title: document.getElementById("createString").value, cmd: document.getElementById("createString").value, uiIcon: "ui-icon-circle-plus"},
			{title: "----"},
			{title: document.getElementById("goDayString").value, cmd: document.getElementById("goDayString").value, uiIcon: "ui-icon-arrowthick-1-e"}
			],
		select: function(event, ui) {
			alert("select " + ui.cmd + " on " + ui.target.text());
		}
	});
	
	$(".reservationMenu").contextmenu({
		//delegate: ".reservationMenu",
		menu: [
			{title: document.getElementById("editString").value, cmd: document.getElementById("editString").value, uiIcon: "ui-icon-wrench"},
			{title: "----"},
			{title: document.getElementById("deleteString").value, cmd: document.getElementById("deleteString").value, uiIcon: "ui-icon-trash"}
			],
		select: function(event, ui) {
			alert("select " + ui.cmd + " on " + ui.target.text());
		}
	});
	
	$(".timeTable").click(function (){
		//Get Variables
		start = document.getElementById("BeginPeriod").value;
		end =  document.getElementById("EndPeriod").value;
			
		//Check
		if (end>start){
			//Submits
			document.getElementById("minTime").value = start;
			document.getElementById("maxTime").value = end;
			document.getElementById("myform").submit();
		}
		else{
			alert("Error")
		}
	});
	
	$(".export").click(function (){
		window.open("uploads/calendars/"+opts.filename+".ics");
		$("#dialogSubscribe").dialog('close');
	});
	
	$(".gcalendar").click(function (){
		window.open("http://www.google.com/calendar/render?cid=webcal://156.35.41.127/booked/Web/uploads/calendars/"+opts.filename+".ics");
		$("#dialogSubscribe").dialog('close');
		alert("yo");
	});
	
	$(".deleteReservation").click(function (){
		//Variables
			var url = [location.protocol, '//', location.host, "/booked/Web/Services/Authentication/Authenticate"].join('');
			var header = null;
			var username = opts.username;
			var password = opts.password;		
			var isAdmin = sessionStorage.getItem('isAdmin');
			
			//alert(username);
			//alert(password);
			alert(url);
			url = "http://localhost/booked/Web/Services/Authentication/Authenticate";
			
			//API: Authentication
			$.post(url, JSON.stringify({username: username, password: password}), function(data, status){

				//Authentication Successful
				if (data.isAuthenticated){
					
					alert("1");
					////Gets the data
					header = {"X-Booked-SessionToken": data.sessionToken, "X-Booked-UserId": data.userId};						
					reservationID = info2;
					url = [location.protocol, '//', location.host, "/booked/Web/Services/Reservations/",reservationID].join('');
					
					////Check permissions
					if ((opts.myCal == 1) || (isAdmin == "1")){
						////API: Delete Reservation
						$.ajax({
							url: url,
							type: "DELETE",
							headers: header,
							dataType: "json",
							 
							////if Success
							success: function(data) {
								location.reload();
							}
						});
					}
					//$("#dialogDeleteReservation").dialog('close');
				}
				alert("yo");
			});
	});
	
	//TimeTable
	$("#timeTable").on('click', function() {
		//Create and append the options
		for (i = 0; i < 23; i++) {
			
			//Variables
			var option1 = document.createElement("option");
			var option2 = document.createElement("option");
			k = i;
			
			//Always 2 ciphers
			if (i<10){
				k ="0"+i;
			}
			
			//Generates options
			option1.value = k+":00";
			option1.text = k+":00";
			option2.value = k+":00";
			option2.text = k+":00";
			document.getElementById("BeginPeriod").appendChild(option1);
			document.getElementById("EndPeriod").appendChild(option2);
		}
		$('#dialogBoundaries').dialog("open");
		document.getElementById("selects").style.visibility = "visible";	
	});
	
	//Erase Reservation Dialog
	// $("#dialogDeleteReservation").dialog({
		// buttons: {
        // "Delete": function() {
            // $(this).dialog("close");
			
			// Variables
			// var url = [location.protocol, '//', location.host, "/booked/Web/Services/Authentication/Authenticate"].join('');
			// var header = null;
			// var username = opts.username;
			// var password = opts.password;		
			// var isAdmin = sessionStorage.getItem('isAdmin');
			
			// API: Authentication
			// $.post(url, JSON.stringify({username: username, password: password}), function(data, status){

				// Authentication Successful
				// if (data.isAuthenticated){
					// Gets the data
					// header = {"X-Booked-SessionToken": data.sessionToken, "X-Booked-UserId": data.userId};						
					// reservationID = info2;
					// url = [location.protocol, '//', location.host, "/booked/Web/Services/Reservations/",reservationID].join('');
					
					// Check permissions
					// if ((opts.myCal == 1) || (isAdmin == "1")){
						// API: Delete Reservation
						// $.ajax({
							// url: url,
							// type: "DELETE",
							// headers: header,
							// dataType: "json",
							 
							// if Success
							// success: function(data) {
								// location.reload();
							// }
						// });
					// }
				// }
			// });
        // }
      // }
	// });
	
	//Colors
	// $("#dialogColors").dialog({
		// buttons: {
         // "Actualizar": function() {
             // $(this).dialog("close");
			// }
		// }
	// });
	
	//Delete BlackoutDialog
	$("#dialogDeleteBlackout").dialog({
		buttons: {
		"Delete": function() {		
			var popup = new $.Popup({
				modal:true,
				backOpacity: 0
				});
			popup.open('http://localhost/booked/Web/admin/manage_blackouts.php');
			$('.popup').hide();
			sessionStorage.setItem("popup_status", "blackDelete");
			sessionStorage.setItem("id", info2.substr(8));
			$(this).dialog("close");
			interval = setInterval(function(){
				popup.close();
				clearInterval(interval);
				location.reload();	
			},1000);			
		}
      }
	});	
	
	//OnOff Switch
	$('#myonoffswitch').change(function() {			
		
		url = document.URL;
				
		//Redirect to correct url
		if (opts.myCal == 1){
			if (url.indexOf("#") != -1){
				url = url.substr(0,url.length-1);
			}
			if (url.indexOf("?") == -1){
				url = url + '?mycal=0';
			}
			else{
				url = url + '&mycal=0';
			}
		}
		else{
			url = url.substr(0,url.length-8);
		}
			
		//Send to url		
		window.location = url;
		
	});	
	
	//CalendarFilter
	$('#calendarFilter').multiselect({
			
		//Before Open: used to fix bugs.
		beforeopen: function(){
			//$("#dialogDeleteReservation").dialog('close');
			//$("#dialogDeleteBlackout").dialog('close');
			//$("#dialogSucessful").dialog('close');
			//$("#dialogFailed").dialog('close');
		},
			
		//Options
		header: true,
		autoOpen: true,
		height: 'auto',
		checkAllText: document.getElementById("checkAllString").value,
		uncheckAllText:  document.getElementById("uncheckAllString").value,
		noneSelectedText:  document.getElementById("selectOptionsString").value,
		selectedText: '# '+document.getElementById("selectTextString").value,
			
		//Open	
	    open: function(){		   
		    
			//Fixing bugs
		    if (isOpenedFirstTime){
			   $('#calendarFilter').multiselect("close");
		    }
			
			//Check if resources are selected.
			var url = document.URL;
			if (url.indexOf("rid") == -1){
				//no-op
			}
			
			//Refresh the multiselect with the values
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
		   
		//Close
		close: function(){
			
		//Get Variables
		var day = getQueryStringValue('d');
		var month = getQueryStringValue('m');
		var year = getQueryStringValue('y');
		var type = getQueryStringValue('ct');
		var scheduleId = '';
		var resourceId = '';

		//Builds URL
		resourceId = '&rid=' + $(this).val();
		var url = [location.protocol, '//', location.host, location.pathname].join('');
		url = url + '?ct=' + type + '&d=' + day + '&m=' + month + '&y=' + year + '&sid=' + resourceId;			
		
		if (document.URL.indexOf("mycal=0") != -1){
			url = url + '&mycal=0';
		}		
			
		//Fix Bug
		if (isOpenedFirstTime){
			isOpenedFirstTime = false;
		}
			
		//Submits
		else{
			window.location = url;		
		}			
			
		},
		selectedList: 1		
	}).multiselectfilter();		
}; //enhance

	//ChangeColor
	function changeColor(id,color){
		document.getElementById("colors").value = id+"#"+color;
		myform.submit();
	}
	
	//KeyboardEvents
	$(document).keydown(function(e) {
		switch(e.which) {		
			case 16: // shift
			//$('#calendar').fullCalendar('disableResizing','false');
			//sessionStorage.setItem('resize','true');
			//$('#calendar').fullCalendar('rerenderEvents');
			var url =  [location.protocol, '//', location.host, "/booked/Web/reservation.php"].join('');
			//$('#reservationColorbox').colorbox();
			//$('#reservationColorbox').colorbox({href:url});
			
			//var a = $('<div></div>')
			var a = $('#reservationColorbox')
			 .html('<iframe style="border: 0px; " src="' + url + '" width="100%" height="100%"></iframe>')
               .dialog({
                   autoOpen: false,
                   modal: true,
                   height: 500,
                   width: 400
                   //title: "Some title"
               });
			a.dialog("open");
			
			//$('#reservationColorbox').dialog("open");			
			break;
		
			case 46: // delete
			if (info2 != ""){
				$( '#dialogDeleteReservation' ).dialog("open");	
			}
			if(info2.indexOf("blackout") == 0){
				$( '#dialogDeleteReservation' ).dialog("close");
				$( '#dialogDeleteBlackout' ).dialog("open");				
			}	
			break;
			
			default: return; // exit this handler for other keys
		}
	});
	
	$(document).keyup(function(e) {
		switch(e.which) {
			case 16: // shift
			//$('#calendar').fullCalendar('disableResizing','false');
			//sessionStorage.removeItem('resize');
			//$('#calendar').fullCalendar('rerenderEvents');
			//alert("adios");
			//document.getElementById("fc-resizer").style.display = "none";
			//$( ".fc-resizer" ).resizable( "enable" );
			//$('#calendar').fullCalendar();
			break;
			default: return; // exit this handler for other keys
		}
	});	
	
	//DayClick
	var dayClick = function(date, allDay, jsEvent, view)
	{
		
		if (readOnly == "1"){
		return;
		}
	
		//Variables
		dateVar = date;			
		var month =  dateVar.getMonth()+1;
		var info = "";
		var url = [location.protocol, '//', location.host, location.pathname].join('');
		info = url + '?d=' + dateVar.getDate() + '&m=' + month + '&y=' + dateVar.getFullYear();

		//Sends to handler
		mouseInput("dayClick", info);
		changeSelection($(this));
		return;
	};
	
	//getUrlFormattedDate
	var getUrlFormattedDate = function(d)
	{
		var month =  d.getMonth()+1;
		return encodeURI(d.getFullYear() + "-" + month + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes());
	}
	
	//viewGetter
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

	//Mouse Input
	var mouseInput = function(event,data){
	var view = $('#calendar').fullCalendar('getView');
		
		if (readOnly == "1"){
		return;
		}
		
		//Item clicked
		if (data != null){
			info2 = data;
		}
		
		//Single Click event on a day
		if (event == "dayClick"){
		
			//Double click
			$(this).dblclick(function(){
			if (view.name == "month"){
				data = data + '&ct=' + "day";
				window.location = data;
			}
			else{
				var url =  opts.dayClickUrl;
				var month =  dateVar.getMonth()+1;
				var end = new Date(dateVar);
				end.setMinutes(dateVar.getMinutes()+30);
				data = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);
				var popup = new $.Popup({modal:true});
				popup.open(data);
				$('.popup_close').hide();
				interval = setInterval(function(){
					popup_status = sessionStorage.getItem("popup_status");
					popupCheck(popup,interval);
				},100);
			}				
			});
			info1 = data;
		}
		
		//Drag Event
		else if(event == "drag"){
			info1 = data;
		}
		
		//Right Click event
		else if (event == "rightClick"){
			if (data != ""){
				$('#dialogDeleteReservation').dialog("open");	
			}
			if(data.indexOf("blackout") == 0){
				$('#dialogDeleteReservation').dialog("close");
				$('#dialogDeleteBlackout').dialog("open");				
			}
		}
		
		//Blackout Double Click
		else if (event == "blackoutDoubleClick"){
			
			//Variables
			var url = 'reservation.php?';						
			var sd = '';
			var ed = '';
			var day = '';
			var id = data.id;
			var description = data.colorID;
			
			//Dates creation
			sd = data.start.getTime();
			sd = new Date(sd);
			sd = getUrlFormattedDate(sd);
			day = sd.substr(sd.lastIndexOf("-")+1,2);
			if (day.indexOf("%") != -1){ day = "0"+day.substr(0,1)}
			ed = data.end.getTime();
			ed = new Date(ed);
			ed = getUrlFormattedDate(ed);
							
			//Dates fix
			sd = sd.substr(sd.indexOf("%")+3);
			sd2 = sd.substr(sd.indexOf(":")+1);
			if(sd.substr(0,1) != 1){
				sd = "0"+sd;
			}
			if(sd2 == 0){
				sd = sd+"0";
			}
			ed = ed.substr(ed.indexOf("%")+3);
			ed2 = ed.substr(ed.indexOf(":")+1);
			if(ed.substr(0,1) != 1){
				ed = "0"+ed;
			}
			if(ed2 == 0){
				ed = ed+"0";
			}
			
			//More fix
			sd = sd+":00"
			ed = ed+":00"						
						
			//Sends Data			
			info = url;
			var popup = new $.Popup({modal:true});
			sessionStorage.setItem("popup_status", "blackUpdate");
			sessionStorage.setItem("start", sd);
			sessionStorage.setItem("end", ed);
			sessionStorage.setItem("day", day);
			sessionStorage.setItem("id", id);
			sessionStorage.setItem("description", description);
					
			//Loads Popup
			popup.open(info);
			$('.popup_close').hide();
			interval = setInterval(function(){
				popup_status = sessionStorage.getItem("popup_status");
				popupCheck(popup,interval);
			},100);
			sleep(1000);
		}
		
		//EventDoubleClick
		else if (event == "eventDoubleClick"){
			var popup = new $.Popup({modal:true});
			popup.open('http://156.35.41.127/booked/Web/reservation.php?rn='+data.id);
			$('.popup_close').hide();
			interval = setInterval(function(){
				popup_status = sessionStorage.getItem("popup_status");
				popupCheck(popup,interval);
			},100);
			sleep(1000);
		}
	}
	
	//External events handler
	document.getElementById("goDay").onclick = function (){
		type = "day";	
		info = info1  + '&ct=' + type;
		
		if (document.URL.indexOf("mycal=0") != -1){
			info = info + '&mycal=0';
		}		
		window.location = info;
	}	
	document.getElementById("goWeek").onclick = function (){
		type = "week";	
		info = info1  + '&ct=' + type;
		
		if (document.URL.indexOf("mycal=0") != -1){
			info = info + '&mycal=0';
		}		
		window.location = info;
	}	
	document.getElementById("goMonth").onclick = function (){
		type = "month";	
		info = info1  + '&ct=' + type;
		if (document.URL.indexOf("mycal=0") != -1){
			info = info + '&mycal=0';
		}		
		window.location = info;
	}		
	document.getElementById("goToday").onclick = function (){
		type = viewGetter();	
		info = info1  + '&ct=' + type;
		
		if (document.URL.indexOf("mycal=0") != -1){
			info = info + '&mycal=0';
		}		
		window.location = info;
	}
	
	//Defauult selection
	document.getElementsByTagName('body').onclick = function (){
		info1 = "my-calendar.php?";
	}

	//Checks if popup must be closed
	var popupCheck = function(popup,interval){
		if(popup_status == "close"){
			sessionStorage.setItem("popup_status", "none");
			popup.close();
			clearInterval(interval);
		}
		if(popup_status == "update"){
			sessionStorage.setItem("popup_status", "none");
			popup.close();
			clearInterval(interval);
			location.reload();
		}		
	}
	
	//RightClick listener
	var rightClick = function (element,event){
		element.bind('mousedown', function (e) {
		if (e.which == 3) {
			mouseInput("rightClick",event.id);
			changeSelection($(this));
			}
		});
	}
	
	//Color assignation
	var colorAssign = function (element,event){
		if (colorArray.indexOf(event.colorID) == -1){
			numLegend = numLegend + 1;
			colorArray.push(event.colorID);
			shortString = event.colorID.split(" ");
			shortStringToDisplay = "";
			for (i=0;i<shortString.length;i++){
				shortStringToDisplay = shortStringToDisplay + shortString[i].substr(0,2) + ". ";
			}
			
			// if (numLegend < maxLegend){
				// document.getElementById('legend').innerHTML += "<input type='button' onchange=\"changeColor(this.id,this.value)\" id='"+event.colorID+"' class=\"jscolor\">"+shortStringToDisplay+'</input> &nbsp &nbsp &nbsp';
			// }
			//document.getElementById('legend').innerHTML += "<input type='button' onchange=\"changeColor(this.id,this.value)\" id='"+event.colorID+"' class=\"jscolor\">"+"&nbsp"+event.colorID+'</input> </br> </br>';
			// else{
				// document.getElementById('legend').innerHTML += "<input type='button' onchange=\"changeColor(this.id,this.value)\" id='"+event.colorID+"' style=\"display:none;\" class=\"jscolor\">"+'</input> &nbsp &nbsp &nbsp';
			// }			
			if (sessionStorage.getItem(event.colorID) != null){
				$(element).css('background-color',"#"+sessionStorage.getItem(event.colorID));
				document.getElementById(event.colorID).value = sessionStorage.getItem(event.colorID);					
			}					
		}
		else{
			if (sessionStorage.getItem(event.colorID) != null){
				$(element).css('background-color',"#"+sessionStorage.getItem(event.colorID));	
			}
		}	
	}
	
	//New reservation by mouse drag on a day
	var dragSelection = function(url){
		if (readOnly == "1"){
		return;
		}
		popup = new $.Popup({modal:true});
		popup.open(url);
		$('.popup_close').hide();
		interval = setInterval(function(){
			popup_status = sessionStorage.getItem("popup_status");
			popupCheck(popup,interval);
		},100);
	}
	
	//Reservation update by event drag-stop
	var dragStop = function(event,sd,ed,day){
		
		if (readOnly == "1"){
		return;
		}
		
		sd = sd.substr(sd.indexOf("%")+3);
		sd2 = sd.substr(sd.indexOf(":")+1);
		if(sd.substr(0,1) != 1){
			sd = "0"+sd;
		}
		if(sd2 == 0){
			sd = sd+"0";
		}
		ed = ed.substr(ed.indexOf("%")+3);
		ed2 = ed.substr(ed.indexOf(":")+1);
		if(ed.substr(0,1) != 1){
			ed = "0"+ed;
		}
		if(ed2 == 0){
			ed = ed+"0";
		}
			
		sd = sd+":00"
		ed = ed+":00"
					
		var popup = new $.Popup({
			modal:true,
			backOpacity: 0
		});
		popup.open('reservation.php?rn='+event.id);
		$('.popup').hide();
		sessionStorage.setItem("popup_status", "drag");
		sessionStorage.setItem("start", sd);
		sessionStorage.setItem("end", ed);
		sessionStorage.setItem("day", day);
		interval = setInterval(function(){
			popup.close();
			clearInterval(interval);
			location.reload();	
		},1000);
	}
	
	//Highlights the current selection
	changeSelection = function(object, type){
		if (prevColor != ""){
			prevElement.css('background-color', prevColor);
		}
		prevElement = object;
		prevColor = object.css("background-color");
		object.css('background-color', '#CCFFFF');
	}
	
	$( ".jscolor" ).change(function() {
	  changeColor(this.id,this.value);
	});