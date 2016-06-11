//Declarations	
var colorArray = [];						//Related to colors
var info1 = "my-calendar.php?";				//Related to events
var info2 = "";								//Related to events
var dateVar = null;							//Date
var prevElement = "";						//Related to selection
var prevColor = "";							//Related to selection
var readOnly = "";							//ReadOnly mode
var baseURL = 'https://156.35.41.127/Web/';	//URL

//Enhance functions
var enhanceCalendar = function(opts, reservations) {
	
	//Initialization
	readOnly = opts.readOnly;
	if (document.URL.indexOf("?") != -1){
		info1 = document.URL;
	}
	sessionStorage.setItem("popup_status", "none");
	
	//Dialogs
	ConfigureAdminDialog($('#dialogBoundaries'));
	ConfigureAdminDialog($('#dialogSubscribe'));
	ConfigureAdminDialog($('#dialogColors'));
	ConfigureAdminDialog($('#dialogDeleteReservation'));
	ConfigureAdminDialog($('#dialogDeleteBlackout'));	
	
	//Delete reservation
	$('#deleteReservation').click(function (){
		url = baseURL + 'reservation.php?rn=' + info2;		
		createHiddenPopup(url,$('#dialogDeleteReservation'),"delete");		
	});
	
	//DeleteBlackout
	$('#deleteBlackout').click(function (){
		url = baseURL + 'admin/manage_blackouts.php';		
		createHiddenPopup(url,$('#dialogDeleteBlackout'),"blackDelete");
	});
	
	//DayMenu
	$(".dayMenu").contextmenu({
		menu: [
			{title: document.getElementById("createString").value, cmd: "create", uiIcon: "ui-icon-circle-plus"},
			{title: "----"},
			{title: document.getElementById("goDayString").value, cmd: "goDay", uiIcon: "ui-icon-arrowthick-1-e"}
			],
		select: function(event, ui) {
			switch (ui.cmd) {
				//Create
				case "create":
					var url =  opts.dayClickUrl;
					var month =  dateVar.getMonth()+1;
					var end = new Date(dateVar);
					end.setMinutes(dateVar.getMinutes()+30);
					data = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);
					popup = createPopup(data,document.getElementById("createString").value);
					interval = setInterval(function(){
						popup_status = sessionStorage.getItem("popup_status");
						popupCheck(popup,interval);
					},100);
					break;
				//GoDay
				case "goDay":
					goDay();
					break;
				default:
					break;
			}
		}
	});
	
	//ReservationMenu
	$(".reservationMenu").contextmenu({
		menu: [
			{title: document.getElementById("editString").value, cmd: "edit", uiIcon: "ui-icon-wrench"},
			{title: "----"},
			{title: document.getElementById("deleteString").value, cmd: "delete", uiIcon: "ui-icon-trash"}
			],
		select: function(event, ui) {
			switch (ui.cmd) {
				//View reservation
				case "edit":
					url = baseURL + 'reservation.php?rn='+info2; 
					popup = createPopup(url,document.getElementById("editString").value);					
					interval = setInterval(function(){
						popup_status = sessionStorage.getItem("popup_status");				
						popupCheck(popup,interval);
					},100);
					break;			
				//Delete Reservation
				case "delete":
					if (info2 != ""){
						$('#dialogDeleteReservation').dialog("open");	
					}
					break;
				default:
					break;
			}
		}
	});
	
	//BlackoutMenu
	$(".blackoutMenu").contextmenu({
		menu: [
			{title: document.getElementById("deleteString").value, cmd: "delete", uiIcon: "ui-icon-trash"}
			],
		select: function(event, ui) {
			switch (ui.cmd) {
				//Delete
				case "delete":
					if (info2 != ""){
						$('#dialogDeleteBlackout').dialog("open");		
					}					
					break;
				default:
					break;
			}
		}
	});
	
	//Time format submit
	$(".timeTable").click(function (){
		//Get Variables
		start = document.getElementById("BeginPeriod").value;
		end =  document.getElementById("EndPeriod").value;
			
		//Check
		if (end>start){
			document.getElementById("timeForm").submit();
		}
		else{
			$(".warning").text(document.getElementById("warningString").value);
		}
	});
	
	//ChangeColors submit
	$(".colors").click(function (){
		document.getElementById("colorForm").submit();
	});	
	
	//Export to file option
	$(".export").click(function (){
		window.open("uploads/calendars/"+opts.filename+".ics");
		$("#dialogSubscribe").dialog('close');
	});
	
	//GoogleCalendar option
	$(".gcalendar").click(function (){
		window.open("https://www.google.com/calendar/render?cid=webcal://156.35.41.127/booked/Web/uploads/calendars/"+opts.filename+".ics");
		$("#dialogSubscribe").dialog('close');
	});
	
	//DialogColors
	$("#colors").on('click', function() {		
		$('#dialogColors').dialog('open');
		var sizeCheck = $('#dialogColors').outerHeight(); /*MyCode*/
		if (sizeCheck>window.innerHeight-50){
			$('#dialogColors').dialog( "option", "height", window.innerHeight-50 );
			$('#dialogColors').dialog( "option", "width", $('#dialogColors').outerWidth()+50 );			
		}
	});
	
	//TimeTable dialog
	$("#timeTable").on('click', function() {
		
		//Create and append the options
		for (i = 0; i < 25; i++) {
			
			//Variables
			var option1 = document.createElement("option");
			var option2 = document.createElement("option");
			k = i;
			
			//Always 2 ciphers
			if (i < 10){
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
		
		//Checks
		document.getElementById("BeginPeriod").value = opts.minTime;
		document.getElementById("EndPeriod").value = opts.maxTime;
		document.getElementById("firstDay").value = opts.firstDay;
		if (opts.weekends == "1"){
			document.getElementById("weekends").checked = true;
		}
		
		//Open
		$('#dialogBoundaries').dialog("open");
		document.getElementById("selects").style.visibility = "visible";	
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
			
		//Options
		header: true,
		height: 'auto',
		checkAllText: document.getElementById("checkAllString").value,
		uncheckAllText:  document.getElementById("uncheckAllString").value,
		noneSelectedText:  document.getElementById("selectOptionsString").value,
		selectedText: '# '+document.getElementById("selectTextString").value,
			
		//Open	
	    open: function(){
			
			//Fix size
			if($('.ui-multiselect-checkboxes').height() > window.innerHeight - 200){
				$('.ui-multiselect-checkboxes').height(window.innerHeight - 200);
			}
			
			//Check if resources are selected.
			var url = document.URL;
			if (url.indexOf("rid") == -1){
				for (i=0;i<500;i++){
					$(this).multiselect("widget").find(":checkbox[value='"+i+"']").attr("checked","checked");
					$("#calendarFilter option[value='" + i + "']").attr("selected", 1);					
				}
				$(this).multiselect("refresh");
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
			var type = viewGetter();
			var scheduleId = '';
			var resourceId = '';

			//Builds URL
			resourceId = '&rid=' + $(this).val();
			
			var urlBefore = document.URL.substr(0,document.URL.indexOf('&rid'));
			if (urlBefore != ""){
				url = urlBefore + resourceId;
			}
			else{
				var url = [location.protocol, '//', location.host, location.pathname].join('');
				url = url + '?d=' + day + '&m=' + month + '&y=' + year + resourceId + '&ct=' + type; 
			}			
			
			//Submits
			if (document.URL.indexOf("mycal=0") != -1){
				url = url + '&mycal=0';
				window.location = url;
			}			
			else{
				window.location = url;		
			}			
			
		},
		selectedList: 1		
	}).multiselectfilter();		
}; //enhance

	//ChangeColor
	function changeColor(id,color){
		document.getElementById("color#"+id).value = id+"#"+color;
	}
	
	//KeyboardEvents
	$(document).keydown(function(e) {
		switch(e.which) {		
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
	
	//DayClick
	var dayClick = function(date){	
		
		//Checks
		if (readOnly == "1"){
			return;
		}
	
		//Variables
		dateVar = date;			
		var month =  dateVar.getMonth()+1;
		var info = "";
		var resourceId = '&rid=' + getQueryStringValue('rid');
		var url = [location.protocol, '//', location.host, location.pathname].join('');
		info = url + '?d=' + dateVar.getDate() + '&m=' + month + '&y=' + dateVar.getFullYear() + resourceId;

		//Sends to handler		
		mouseInput("dayClick", info);
		changeSelection($(this));	
		return;
	};
	
	//getUrlFormattedDate
	var getUrlFormattedDate = function(d){
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
			return "month";
		}
	};		

	//Mouse Input
	var mouseInput = function(event,data){
	
		//Checks
		var view = $('#calendar').fullCalendar('getView');		
		if (readOnly == "1"){
			return;
		}
		
		//Item clicked
		if (data != null){
			info2 = data;
		}
		
		//EventDoubleClick
		if (event == "eventDoubleClick"){
			sessionStorage.setItem("action","processing");
			url = baseURL + 'reservation.php?rn='+data.id; 
			var popup = createPopup(url,document.getElementById("editString").value)			
			interval = setInterval(function(){
				popup_status = sessionStorage.getItem("popup_status");				
				popupCheck(popup,interval);
			},100);
			sleep(1000);			
		}
		
		//Single Click event on a day
		else if (event == "dayClick"){			
				
				//Double click
				$(this).dblclick(function(){
					if (view.name == "month"){
						data = data + '&ct=' + "day";
						if (sessionStorage.getItem("action").indexOf("processing") == -1){
							window.location = data;
						}
					}
					else{
						var url =  opts.dayClickUrl;
						var month =  dateVar.getMonth()+1;
						var end = new Date(dateVar);
						end.setMinutes(dateVar.getMinutes()+30);
						data = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);
						
						var popup = createPopup(data,document.getElementById("createString").value);			
						interval = setInterval(function(){
							popup_status = sessionStorage.getItem("popup_status");
							popupCheck(popup,interval);
						},100);
					}				
				});
			info1 = data;
		}
		
		//Drag Event
		else if (event == "drag"){
			info1 = data;
		}
		sessionStorage.setItem("action","none");
	}
	
	//GoDay
	var goDay = function(){	
		type = "day";
		url = info1.substr(0,info1.indexOf("&ct"));
		if (url != ""){
			info1 = url;						
		}
		if (info1.indexOf("mycal=0") != -1){
			info1 = info1.substr(0,info1.indexOf("mycal=0"));
		}
		url = info1 + '&ct=' + type;		
		if (document.URL.indexOf("mycal=0") != -1){
			url = url + '&mycal=0';
		}		
		window.location = url;
	}	
	
	//GoWeek
	var goWeek = function(){
		type = "week";	
		url = info1.substr(0,info1.indexOf("&ct"));
		if (url != ""){
			info1 = url;
		}
		if (info1.indexOf("mycal=0") != -1){
			info1 = info1.substr(0,info1.indexOf("mycal=0"));
		}
		url = info1  + '&ct=' + type;		
		if (document.URL.indexOf("mycal=0") != -1){
			url = url + '&mycal=0';
		}		
		window.location = url;
	}	
	
	//GoMonth
	var goMonth = function(){
		type = "month";	
		url = info1.substr(0,info1.indexOf("&ct"));
		if (url != ""){
			info1 = url;
		}
		if (info1.indexOf("mycal=0") != -1){
			info1 = info1.substr(0,info1.indexOf("mycal=0"));
		}
		url = info1  + '&ct=' + type;
		if (document.URL.indexOf("mycal=0") != -1){
			url = url + '&mycal=0';
		}		
		window.location = url;
	}	
	
	//GoToday
	var goToday = function(){
		type = viewGetter();	
		var resourceId = getQueryStringValue('rid');
		url = 'my-calendar.php?&ct=' + type + resourceId;		
		if (document.URL.indexOf("mycal=0") != -1){
			url = url + '&mycal=0';
		}		
		window.location = url;
	}
	
	//Default selection
	document.getElementsByTagName('body').onclick = function (){
		info1 = "my-calendar.php?";
	}

	//Checks popup status
	var popupCheck = function(popup,interval){
		popup_status = sessionStorage.getItem("popup_status");
		if(popup_status == "close"){
			sessionStorage.setItem("popup_status", "none");
			popup.dialog("close");
			clearInterval(interval);
		}
		if(popup_status == "update"){
			sessionStorage.setItem("popup_status", "none");
			popup.dialog("close");
			clearInterval(interval);
			location.reload();
		}
		if(popup_status == "view"){
			sessionStorage.setItem("popup_status", "none");
			popup.dialog("option", "height", "350");
		}		
	}
	
	//Check for hidden events
	var popupCheck2 = function(){
		popup_status = sessionStorage.getItem("popup_status");
		if (popup_status == "update"){			
			sessionStorage.setItem("popup_status", "none");
			return true;
		}
		return false;		
	}
	
	//RightClick listener
	var rightClick = function (element,event,type){
		element.bind('mousedown', function (e) {
		if (e.which == 3) {
			if (type == "res"){
				mouseInput("rightClick",event.id);
			}
			else{
				mouseInput("rightClick","blackout"+event.id);
			}
			changeSelection($(this));
			}
		});
	}
	
	//Color assignation
	var colorAssign = function (element,event, type){
		if (colorArray.indexOf(event.colorID) == -1){
			colorArray.push(event.colorID);		
			if (sessionStorage.getItem(event.colorID) != null){
				if (type == "res"){
					$(element).css('background-color',"#"+sessionStorage.getItem(event.colorID));
					var fontColor = colorFont(sessionStorage.getItem(event.colorID));
					$(element).css('color',"#"+fontColor);
					document.getElementById(event.colorID).value = sessionStorage.getItem(event.colorID);
				}
				else{
					$(element).css('background',"repeating-linear-gradient(45deg,"+'#'+sessionStorage.getItem(event.colorID)+",#606dbc 10px,#465298 10px,#465298 20px)");
					$(element).css('color',"#FF0000");
				}
				var fontColor = colorFont(sessionStorage.getItem(event.colorID));								
			}					
		}
		else{
			if (sessionStorage.getItem(event.colorID) != null){
				if (type == "res"){
					$(element).css('background-color',"#"+sessionStorage.getItem(event.colorID));
					var fontColor = colorFont(sessionStorage.getItem(event.colorID));
					$(element).css('color',"#"+fontColor);
				}
				else{
					$(element).css('background',"repeating-linear-gradient(45deg,"+'#'+sessionStorage.getItem(event.colorID)+",#606dbc 10px,#465298 10px,#465298 20px)");
					$(element).css('color',"#FF0000");
				}					
			}
		}	
	}
	
	//New reservation by mouse drag on a day
	var dragSelection = function(url){
		
		//Checks
		if (readOnly == "1"){
			return;
		}
		
		//Do
		var popup = createPopup(url, document.getElementById("createString").value);		
		interval = setInterval(function(){
			popup_status = sessionStorage.getItem("popup_status");
			popupCheck(popup,interval);
		},100);
	}
	
	//Reservation update by event drag-stop
	var dragStop = function(event,sd,ed,day){
		
		//Checks
		if (readOnly == "1"){
			location.reload();
		}
		
		//Builds parameters
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
						
		url = baseURL + "reservation.php?rn="+event.id;
		
		//Do
		var popup1 = new $.Popup({
				modal:true,
				backOpacity: 0
			});
		popup1.open(url);
		$('.popup').hide();
		sessionStorage.setItem("popup_status", "drag");
		sessionStorage.setItem("start", sd);
		sessionStorage.setItem("end", ed);
		sessionStorage.setItem("day", day);
		interval = setInterval(function(){
			popup1.close();
			clearInterval(interval);
			success = popupCheck2();		
			if (success){
				location.reload();
			}	
			else{				
				var popup = $('#reservationColorbox')
					.html('<iframe style="border: 0px; " src="' + url + '" width="100%" height="100%"></iframe>')
					.dialog({
						autoOpen: false,
						modal: true,
						height: 500,
						width: 400,
						resizable: false,
						draggable: false,
						title: document.getElementById("editString").value
				});
				popup.dialog("open");
				document.body.style.overflow = "hidden"; /*MyCode*/
				sessionStorage.setItem("popup_status", "drag");
				sessionStorage.setItem("start", sd);
				sessionStorage.setItem("end", ed);
				sessionStorage.setItem("day", day);
				interval = setInterval(function(){
					popupCheck(popup,interval);	
				},1000);
			}			
		},1500);
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
	
	//Jscolor change
	$( ".jscolor" ).change(function() {
	  changeColor(this.id,this.value);
	});
	
	//Dialog close
	$('#reservationColorbox').on( "dialogclose", function( event, ui ) {
		document.body.style.overflow = "initial";
		location.reload();
	});
	
	//Text color font
	var colorFont = function(color){
		colorCheck = [];
		colorCheck[0] = parseInt(color.substr(0,2),16);
		colorCheck[1] = parseInt(color.substr(2,2),16);
		colorCheck[2] = parseInt(color.substr(4,2),16);
		newColor = colorCheck;
		for (i = 0; i < newColor.length; i++) {
			newColor[i] = (255 - parseInt(colorCheck[i])).toString(16);
			if (newColor[i] == "0"){
				newColor[i] = "00";
			}
		}
		return newColor[0] + newColor[1] + newColor[2];		
	}
	
	//Create Popup
	var createPopup = function(url,string){
		var popup = $('#reservationColorbox')
			.html('<iframe style="border: 0px; " src="' + url + '" width="100%" height="100%"></iframe>')
			.dialog({
				autoOpen: false,
				modal: true,
				height: 500,
				width: 400,
				resizable: false,
				draggable: false,
				title: string
			});
		popup.dialog("open");
		document.body.style.overflow = "hidden"; /*MyCode*/
		
		if (string == document.getElementById("createString").value){
			sessionStorage.setItem("popup_status","create");
		}
		
		return popup;
	}
	
	//Create Hidden Popup
	var createHiddenPopup = function(url,dialogElement,type){
		var popup1 = new $.Popup({
				modal:true,
				backOpacity: 0
			});
		popup1.open(url);
		$('.popup').hide();
		if (type == "delete"){
			sessionStorage.setItem("popup_status", "delete");
		}
		else{
			sessionStorage.setItem("popup_status", "blackDelete");
			sessionStorage.setItem("id", info2.substr(8));
		}
		dialogElement.dialog("close");
		interval = setInterval(function(){
			popup1.close();
			clearInterval(interval);
			success = popupCheck2();		
			if (success){
				location.reload();
			}	
			else{				
				popup = createPopup(url,document.getElementById("deleteString").value);				
				sessionStorage.setItem("popup_status","delete");
				interval = setInterval(function(){
					popupCheck(popup,interval);	
				},1000);
			}			
		},1500);
	}