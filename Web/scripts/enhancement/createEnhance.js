//Variable Declarations
var isOpenedFirstTime = true;
var popup_status = "";
var sd = "";
var ed = "";
var day = "";

//Turns on and off the blackout mode
var blackoutTick = function(){
    if (document.getElementById("blackoutCheckBox").checked){
		document.getElementById("blackButton").style.display="initial";
		document.getElementById("submitButton").style.display="none";
		document.getElementById("recurrence").style.display="none";
		document.getElementById("title").style.display="none";
		document.getElementById("promptForChangeUsers").style.display="none";	
		document.getElementById("allBlackDiv").style.display="initial";
		document.getElementById("optionDiv").style.display="initial";			
	}
	else{
		document.getElementById("blackButton").style.display="none";
		document.getElementById("submitButton").style.display="initial";
		document.getElementById("recurrence").style.display="initial";
		document.getElementById("title").style.display="initial";
		document.getElementById("promptForChangeUsers").style.display="initial";
		document.getElementById("allBlackDiv").style.display="none";
		document.getElementById("optionDiv").style.display="none";			
	}
}

//Turns on and off the option "allResources" for blackouts	
var allResources = function(){
	if (document.getElementById("allBlack").checked){
		//$("#filter").multiselect( "disable" );
	}
	else{
		//$("#filter").multiselect( "enable" );
	}
}

//Sets the option to notify or erase existing reservations	
var blackoutNotify = function(){
	if (document.getElementById("notifyExisting").checked){
		document.getElementById("myOption").value = "1";
	}
	else{
		document.getElementById("myOption").value = "0";
	}
}

//Closes popup
var closePopup1 = function(){
	sessionStorage.setItem("popup_status", "close");
}

//Creates a hidden blackout popup	
var blackoutPopup = function(){
	var popup = new $.Popup({
		modal:true,
		backOpacity: 0
	});
	popup.open('http://156.35.41.127/booked/Web/admin/manage_blackouts.php');
	$('.popup').hide();
	popup_status = sessionStorage.getItem("popup_status");
	if (popup_status.indexOf("blackoutWait") != 0){
		sessionStorage.setItem("popup_status", "black");
	}

	//Setters
	sessionStorage.setItem("start", document.getElementById("BeginPeriod").value);
	sessionStorage.setItem("end", document.getElementById("EndPeriod").value);
	sessionStorage.setItem("sday", document.getElementById("BeginDate").value);
	sessionStorage.setItem("eday", document.getElementById("EndDate").value);
	sessionStorage.setItem("eday", document.getElementById("EndDate").value);
	sessionStorage.setItem("description", document.getElementById("description").value);
	if (document.getElementById("allBlack").checked){
		sessionStorage.setItem("resource", "0");
	}
	else{
		sessionStorage.setItem("resource", document.getElementById("filter").value);
	}
	sessionStorage.setItem("myOption", document.getElementById("myOption").value);
					
	//Close
	interval = setInterval(function(){
		popup.close();
		clearInterval(interval);
		location.reload();	
	},1000);
}

//Enhance functions
var enhanceCreate = function(){
	
	$('.save').click(function (e){
		$('.details').hide();
		$(this).hide();
		$('#submitButton4').hide();
	});
		
	//Filter
	// $('#filter').multiselect({
		// header: false,
		// multiple: false,
		// selectedList: 1,
		// autoOpen: true,
		// height: "auto",
		// open: function(){		   
		  // if (isOpenedFirstTime){
			 // $('#filter').multiselect("close");
		  // }		
		// },
		 // close: function(event, ui){
			 // if (isOpenedFirstTime){
				// isOpenedFirstTime = false;
				// var url = document.URL;
				// rid = url.substr(url.indexOf("rid"));
				// if (rid.indexOf("&") != -1){
					// rid = rid.substr(0,rid.indexOf("&"));
				// }
				// rid = rid.substr(4);
				// $(this).val(rid);
				// $(this).multiselect("refresh");
			// }
			// else{
				// resourceId = $(this).val();
				// document.getElementById("resourceId").value = resourceId;
			// }
		// }
	// });
	
	var url = document.URL;
	rid = url.substr(url.indexOf("rid"));
	if (rid.indexOf("&") != -1){
		rid = rid.substr(0,rid.indexOf("&"));
	}
	rid = rid.substr(4);
	$('#filter').val(rid);
	document.getElementById("resourceId").value = $('#filter').val();
	
	if (sessionStorage.getItem("resource"))
	
	$('#filter').change(function (e){
		document.getElementById("resourceId").value = $(this).val();
	});
		
	//Hides interface	
	document.body.style.overflow = "hidden";
	$('#header').hide();
	$('#logo').hide();
	
	//Actions
	getSession();
	drag();
	blackUpdate();
	deleteCommand();
} 

//Gets session
var getSession = function(){
	popup_status = sessionStorage.getItem("popup_status");
	sd = sessionStorage.getItem("start");
	ed = sessionStorage.getItem("end");
	day = sessionStorage.getItem("day");
}

//Executes drag update
var drag = function(){
	if(popup_status == "drag"){	
		sessionStorage.setItem("popup_status", "none");
		document.getElementById("BeginPeriod").value = sd;
		document.getElementById("EndPeriod").value = ed;		
		if(day != ""){
		document.getElementById("BeginDate").value = day+document.getElementById("BeginDate").value.substr(2);//+document.getElementById("BeginDate").value.substr(0,3);
		document.getElementById("EndDate").value = day+document.getElementById("EndDate").value.substr(2);
		//document.getElementById("EndDate").value = document.getElementById("EndDate").value.substr(0,3)+day+document.getElementById("EndDate").value.substr(5);
		document.getElementById("formattedBeginDate").value = document.getElementById("formattedBeginDate").value.substr(0,document.getElementById("formattedBeginDate").value.lastIndexOf("-")+1)+day;
		//alert(document.getElementById("formattedBeginDate").value);
		//alert(document.getElementById("BeginDate").value);
		//alert(document.getElementById("BeginPeriod").value);
		document.getElementById("formattedEndDate").value = document.getElementById("formattedEndDate").value.substr(0,document.getElementById("formattedEndDate").value.lastIndexOf("-")+1)+day;
		}
		document.getElementsByTagName('button')[1].click();
	}
}

//If we are updating a blackout
var blackUpdate = function(){
	if(popup_status == "blackUpdate"){	
		sessionStorage.setItem("popup_status", "blackoutWait");		
		id = sessionStorage.getItem("id");
		description = sessionStorage.getItem("description");
		document.getElementById("BeginPeriod").value = sd;
		document.getElementById("EndPeriod").value = ed;		
		document.getElementById("description").value = description;
		
		document.getElementById("BeginDate").value = document.getElementById("BeginDate").value.substr(0,3)+day+document.getElementById("BeginDate").value.substr(5);
		document.getElementById("EndDate").value = document.getElementById("EndDate").value.substr(0,3)+day+document.getElementById("EndDate").value.substr(5);
		document.getElementById("formattedBeginDate").value = document.getElementById("formattedBeginDate").value.substr(0,document.getElementById("formattedBeginDate").value.lastIndexOf("-")+1)+day;
		document.getElementById("formattedEndDate").value = document.getElementById("formattedEndDate").value.substr(0,document.getElementById("formattedEndDate").value.lastIndexOf("-")+1)+day;
		
		document.getElementById("blackoutCheckBox").checked = true;
		blackoutTick();
		document.getElementById("blackDiv").style.display = "none";
	}	
}


//Executes drag update
var deleteCommand = function(){
	if(popup_status == "delete"){	
		sessionStorage.setItem("popup_status", "none");		
		document.getElementsByClassName('delete')[0].click();
	}
}

