//Variable Declarations
popup_status = "";
sd = "";
ed = "";
sday = "";
eday = "";
description = "";
resource = "";

//Enhance functions
var enhance = function(){
	getSession();
	createBlackout();
	deleteBlackout();
} 

//ClickInputs (Unused)
var clickInputs = function(){
	
	//Blackout Form
	$("#myBlackoutLabel").on('click', function() {
		   if (document.getElementById("addBlackoutForm").style.display == "none"){
				document.getElementById("addBlackoutForm").style.display = "initial";
		   }
		   else{
				document.getElementById("addBlackoutForm").style.display = "none";
			}
		});
	
	//Filter
	$("#myFilterLabel").on('click', function() {
	   if (document.getElementById("myFilter").style.display == "none"){
			document.getElementById("myFilter").style.display = "initial";
			document.getElementById("filter").style.display = "initial";
			document.getElementById("showAll").style.display = "initial";
	   }
	   else{
			document.getElementById("myFilter").style.display = "none";
			document.getElementById("filter").style.display = "none";
			document.getElementById("showAll").style.display = "none";
		}
	});
}

//GetSession
var getSession = function(){
	popup_status = sessionStorage.getItem("popup_status");
	sd = sessionStorage.getItem("start");
	ed = sessionStorage.getItem("end");
	sday = sessionStorage.getItem("sday");
	eday = sessionStorage.getItem("eday");
	description = sessionStorage.getItem("description");
	resource = sessionStorage.getItem("resource");
}

//CreateBlackout
var createBlackout = function(){
	if(popup_status == "black"){	
		sessionStorage.setItem("popup_status", "none");	
		
		//GetFormattedDates
		aux = sday.split("/");
		aux1 = aux[0];
		aux2 = aux[1];
		aux3 =  aux[2];
		document.getElementById("formattedAddStartDate").value = aux1+"-"+aux2+"-"+aux3;
		aux = eday.split("/");
		aux1= aux[0];
		aux2 = aux[1];
		aux3 =  aux[2];
		document.getElementById("formattedAddEndDate").value = aux1+"-"+aux2+"-"+aux3;
		
		//GetDates
		document.getElementById("addStartDate").value = sday;
		document.getElementById("addEndDate").value = eday;
		document.getElementById("addStartTime").value = sd;
		document.getElementById("addEndTime").value = ed;
		document.getElementById("blackoutReason").value = description;
		
		//GetResource
		if (resource == 0){
			document.getElementById("allResources").checked = true;				
		}else{
			document.getElementById("addResourceId").value = resource;				
		}
		
		document.getElementById("deleteExisting").checked = true;	
		
		//Do
		interval = setInterval(function(){
			document.getElementById('createButton').click();
			sessionStorage.setItem("popup_status", "update");	
			clearInterval(interval);
		},100);		
	}
}

//UpdateBlackout
var updateBlackout = function(){
	if(popup_status == "blackoutWait"){
		
		//Erase Previous One
		id = sessionStorage.getItem("id");
		document.getElementById(id).click();
		
		//GetFormattedDates
		aux = sday.split("/");
		aux1= aux[0];
		aux2 = aux[1];
		aux3 =  aux[2];
		document.getElementById("formattedAddStartDate").value = aux3+"-"+aux1+"-"+aux2;
		aux = eday.split("/");
		aux1= aux[0];
		aux2 = aux[1];
		aux3 =  aux[2];
		document.getElementById("formattedAddEndDate").value = aux3+"-"+aux1+"-"+aux2;
		
		//GetDates
		document.getElementById("addStartDate").value = sday;
		document.getElementById("addEndDate").value = eday;
		document.getElementById("addStartTime").value = sd;
		document.getElementById("addEndTime").value = ed;
		document.getElementById("blackoutReason").value = description;
		
		//GetResource
		if (resource == 0){
			document.getElementById("allResources").checked = true;				
		}else{
			document.getElementById("addResourceId").value = resource;				
		}
		
		//GetOption
		if(myOption == 1){
			document.getElementById("notifyExisting").checked = true;			
		}else{
			document.getElementById("deleteExisting").checked = true;	
		}

		//Do
		interval = setInterval(function(){
			document.getElementById('createButton').click();
			sessionStorage.setItem("popup_status", "update");	
			clearInterval(interval);
		},100);	
	}
}

//DeleteBlackout
var deleteBlackout = function(){
	if(popup_status == "blackDelete"){
		interval = setInterval(function(){
		sessionStorage.setItem("popup_status", "none");	
		id = sessionStorage.getItem("id");
		document.getElementById(id).click();
		clearInterval(interval);
		},10);	
	}
}

