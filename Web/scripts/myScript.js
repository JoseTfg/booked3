	//Declarations	
	var isOpenedFirstTime = true;			//Fix a bug in the calendar filter
	var userId = "";						//User Data for API
	var colorArray = [];					//Related to event colors.
	var info1 = "my-calendar.php?";			//Related to events
	var info2 = "";							//Related to events
	var dateVar = null;						//Date

var myScript = function(opts, reservations) {

	_options = opts;					//Options
	//_reservations = reservations;		//Events
	
	//Erase Reservation Dialog
	$( "#dialog-confirm" ).dialog({
		buttons: {
        "Aceptar": function() {
            $( this ).dialog( "close" );
			//Variables
			var url = [location.protocol, '//', location.host, "/booked/Web/Services/Authentication/Authenticate"].join('');
			var header = null;
			var username = opts.username;
			var password = _options.password;			
			
			//API: Authentication
			$.post(url, JSON.stringify({username: username, password: password}), function(data, status){

					//Authentication Successful
					if (data.isAuthenticated)
						{
							//Gets the data
							header = {"X-Booked-SessionToken": data.sessionToken, "X-Booked-UserId": data.userId};
							userId = data.userId;							
							reservationID = info2;
							url = [location.protocol, '//', location.host, "/booked/Web/Services/Reservations/",reservationID].join('');
							
							//Check permissions
							if (_options.myCal == 1){							 
								
								//API: Delete Reservation
								$.ajax({
								 url: url,
								 type: "DELETE",
								 headers: header,
								 dataType: "json",
							 
								 //if Success
								 success: function(data) {
										url = document.URL;
										window.location = url;
									}
								});
							}
						}
					});
        },
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
      }
	});
	
	//Change Boundaries Dialog
	$( "#dialog-form" ).dialog({
		buttons: {
        "Aceptar": function() {			
			//Get Variables
			start = document.getElementById("BeginPeriod").value;
			end =  document.getElementById("EndPeriod").value;
			
			//Check
			if (end>start){
				//Submits
				document.getElementById("a1").value = start;
				document.getElementById("a2").value = end;
				document.getElementById("myform").submit();  		
				$( this ).dialog( "close" );
			}
			else{
				alert("Error")
			}
			
			
        },
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
      }
	});	
	
	//Create and append the options
	for (var i = 0; i < 23; i++) {
		
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
	
	//Tests dialogs
	$( "#dialog1" ).dialog();
	$( "#dialog2" ).dialog();
	$( "#dialog3" ).dialog({
		buttons: {
        "Download": function() {		

		//alert("hola");
		var cal = ics();
		cal.addEvent('Demo Event', 'This is an all day event', 'Nome, AK', '8/7/2013', '8/7/2013');
		cal.addEvent('Demo Event', 'This is thirty minut event', 'Nome, AK', '8/7/2013 5:30 pm', '8/9/2013 6:00 pm');
		cal.download();	
			
        },
		
		"Upload": function() {
		var cal = ics();
		cal.addEvent('Demo Event', 'This is an all day event', 'Nome, AK', '8/7/2013', '8/7/2013');
		cal.addEvent('Demo Event', 'This is thirty minut event', 'Nome, AK', '8/7/2013 5:30 pm', '8/9/2013 6:00 pm');
		var toUpload = cal.upload();
		document.getElementById("a4").value = toUpload;
		//alert(document.getElementById("a4").value);
		document.getElementById("myform").submit();  
		},		
		
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
      }
	});		
	
		//OnOff Switch
		$('#myonoffswitch').change(function() {			
			//Variables
			//var day = getQueryStringValue('d');
			//var month = getQueryStringValue('m');
			//var year = getQueryStringValue('y');
			//var type = getQueryStringValue('ct');
			
			//Url
			//var url = [location.protocol, '//', location.host, '/booked/Web/my-calendar.php'].join('');
			//url = url + '?ct=' + type + '&d=' + day + '&m=' + month + '&y=' + year;			
			url = document.URL;
				
			//Redirect to correct url
			if (_options.myCal == 1){
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
			//url = url + '?ct=' + type + '&d=' + day + '&m=' + month + '&y=' + year;			
			window.location = url;
		});	
	
		//CalendarFilter
		$('#calendarFilter').multiselect({
			
			//Before Open: used to fix bugs.
			beforeopen: function(){
				$( "#dialog-confirm" ).dialog('close');
				$( "#dialog-form" ).dialog('close');
				$( "#dialog1" ).dialog('close');
				$( "#dialog2" ).dialog('close');
				$( "#dialog3" ).dialog('close');
			},
			
			//Options
			header: true,
			autoOpen: true,
			// selectedText: function () {
				// inputs = this.inputs;
				// checked = inputs.filter(':checked');
				// numChecked = checked.length;
				// return numChecked + ' selected';
                // },
			
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
		
		$('#calendarFilter2').multiselect({
		
		});
		
}; //myScript

	//ChangeColor
	function changeColor(id,color){
		sessionStorage.setItem(id, color);
		location.reload();
	}
	
	//KeyboardEvents
	$(document).keydown(function(e) {
    switch(e.which) {
	    case 37: // left
        $('#calendar').fullCalendar('prev');
        break;

        case 39: // right
        $('#calendar').fullCalendar('next');
                break;
	
        case 46: // delete
		if (info2 != ""){		
			$( '#dialog-confirm' ).dialog("open");	
		}
		
		//if (info2 == "day"){
		//$( "#dialog-confirm" ).dialog("open");
		//$(element).css('background-color','#C8C8C8');
		//}		
        break;		
		
		case 65: // a
		$( '#dialog-form' ).dialog("open");
		break;
		
		// case 66: // b
		//alert("Hola");
		// $('#calendar').fullCalendar('destroy');
		// $('#element_to_pop_up').bPopup({
			// content:'iframe',
			// loadData: true,
			// contentContainer:'.content',
			// modal: true,
			// modalClose: false,
			// loadUrl: 'http://localhost/booked/Web/reservation.php?sid=&rid=&rd=&sd=2016-4-8%2010:0&ed=2016-4-8%2014:30' 
		// });     
		// break;
		
		case 68: // d
		//alert("Hola");
		
		$( '#dialog3' ).dialog("open");	
		
		//var options = { content : $('#content_div') };
		//$('a.popup').popup(options);
		//var popup = new $.Popup({
		//modal:true
		//});
		//popup.open('http://localhost/booked/Web/reservation.php?sid=&rid=&rd=&sd=2016-4-7%2010:30&ed=2016-4-7%2014:0');
		//$('.popup_close').hide();
		//interval = setInterval(function(){
		//popup_status = sessionStorage.getItem("popup_status");
		//popupCheck();
		//},100);
		break;
		
        default: return; // exit this handler for other keys
    }
	});
	
	//DayClick
	var dayClick = function(date, allDay, jsEvent, view)
	{
		//Variables
		dateVar = date;			
		var month =  dateVar.getMonth()+1;
		var info = "";
		var url = [location.protocol, '//', location.host, location.pathname].join('');
		info = url + '?d=' + dateVar.getDate() + '&m=' + month + '&y=' + dateVar.getFullYear();

		//Sends to handler
		mouseInput(info, "click", "day");
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
	var mouseInput = function(info, event, item){
	var view = $('#calendar').fullCalendar('getView');
		
		//Single Click event
		if (event == "click"){
			//Double click
			$(this).dblclick(function(){
			if (view.name == "month"){
				info = info + '&ct=' + "day";
				window.location = info;
			}
			else{
				var url =  _options.dayClickUrl;
				var month =  dateVar.getMonth()+1;
				var end = new Date(dateVar);
				end.setMinutes(dateVar.getMinutes()+30);
				info = url + '&y=' + dateVar.getFullYear() + '&m=' + month + '&d=' + dateVar.getDate() + "&sd=" + getUrlFormattedDate(dateVar) + "&ed=" + getUrlFormattedDate(end);
				var popup = new $.Popup({
				modal:true
				});
				popup.open(info);
				$('.popup_close').hide();
				interval = setInterval(function(){
				popup_status = sessionStorage.getItem("popup_status");
				popupCheck();
				},100);
			}				
			});
			info1 = info;
		}
		
		//Drag Event
		else if(event == "drag"){
			info1 = info;
		}
		if (item != null){
			info2 = item;
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
	
	document.getElementById("goList").onclick = function (){
		type = "list";	
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
	
	
	document.getElementsByTagName('body').onclick = function (){
		info1 = "my-calendar.php?";
	}

	var popupCheck = function(){
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
	
	var menuClick = function(menuItem){
	switch(menuItem) {
	case 1:
		popup = new $.Popup({
		modal:true
		});
		popup.open('http://localhost/booked/Web/reservation.php');
		$('.popup_close').hide();
		interval = setInterval(function(){
		popup_status = sessionStorage.getItem("popup_status");
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
		},100);
		break;
	case 2:	
		$( '#dialog3' ).dialog("open");	
		break;
	}
	}