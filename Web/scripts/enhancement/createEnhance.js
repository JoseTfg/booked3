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
		document.getElementsByClassName("pulldown")[3].disabled = true;
		document.getElementById("description").disabled = true;
		//document.getElementById("promptForChangeUsers").style.display = "none";
		document.getElementById("repeatDiv").style.visibility = "hidden";
		document.getElementById("reserved").style.visibility = "hidden";
		document.getElementById("title").placeholder = document.getElementById("reasonString").value;
		document.getElementById("description").placeholder = document.getElementById("availableString").value;
	}
	else{
		document.getElementById("blackButton").style.display="none";
		document.getElementById("submitButton").style.display="initial";
		document.getElementsByClassName("pulldown")[3].disabled = false;
		document.getElementById("description").disabled=false;
		//document.getElementById("promptForChangeUsers").style.display="initial";
		document.getElementById("repeatDiv").style.visibility = "initial";
		document.getElementById("reserved").style.visibility = "initial";
		document.getElementById("title").placeholder = document.getElementById("titleString").value;
		document.getElementById("description").placeholder = document.getElementById("descriptionString").value;
	}
}

//Creates a hidden blackout popup	
var blackoutPopup = function(){
	
	url = 'https://156.35.41.127/Web/admin/manage_blackouts.php';
	
	var popup = new $.Popup({
		modal:true,
		backOpacity: 0
	});
	popup.open(url);
	$('.popup').hide();	
	sessionStorage.setItem("popup_status", "black");
	

	//Setters
	sessionStorage.setItem("start", document.getElementById("BeginPeriod").value);
	sessionStorage.setItem("end", document.getElementById("EndPeriod").value);
	sessionStorage.setItem("sday", document.getElementById("BeginDate").value);
	sessionStorage.setItem("eday", document.getElementById("EndDate").value);
	sessionStorage.setItem("resource", document.getElementById("resourceId").value);
	sessionStorage.setItem("description", document.getElementById("title").value);
					
	//Close
	interval = setInterval(function(){
		popup.close();
		clearInterval(interval);	
	},1000);
}

//Enhance functions
var enhanceCreate = function(){
	
	$('.save').click(function (e){
		$('.details').hide();
		$(this).hide();
		$('#submitButton4').hide();
	});			
	
	$('#filter').change(function(){;
		document.getElementById("resourceId").value = $(this).val();
	});
		
	//Hides interface	
	document.body.style.overflow = "hidden";
	$('#header').hide();
	$('#logo').hide();
	
	//Actions
	getSession();
	drag();
	deleteCommand();
} 

//Gets session
var getSession = function(){
	popup_status = sessionStorage.getItem("popup_status");
	if (popup_status == "create"){
		sessionStorage.setItem("popup_status","none");
		document.getElementById("blackDiv").style.display = "initial";
	}
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
			document.getElementById("formattedEndDate").value = document.getElementById("formattedEndDate").value.substr(0,document.getElementById("formattedEndDate").value.lastIndexOf("-")+1)+day;
		}
		document.getElementsByTagName('button')[1].click();
		document.getElementsByTagName('button')[2].click();
	}
}

//Executes delete command
var deleteCommand = function(){
	if (popup_status == "delete"){
		document.getElementsByClassName('delete')[0].click();
	}
}

