//Enhance configuration view
var enhance = function(){
	
	//Gets url
	url = document.URL;
	
	//Hides private items
	
	//LDAP
	if(url.indexOf("cf=Authentication%2FLdap") != -1){
		document.getElementById("scope").style.display = "none";
		document.getElementById("required.group").style.display = "none";
		document.getElementById("database.auth.when.ldap.user.not.found").style.display = "none";
		document.getElementById("ldap.debug.enabled").style.display = "none";
	}
	//Config file
	else{
		document.getElementById("allow.self.registration").style.display = "none";
		document.getElementById("admin.email.name").style.display = "none";
		document.getElementById("image.upload.directory").style.display = "none";
		document.getElementById("image.upload.url").style.display = "none";
		document.getElementById("cache.templates").style.display = "none";
		document.getElementById("use.local.jquery").style.display = "none";
		document.getElementById("registration.captcha.enabled").style.display = "none";
		document.getElementById("registration.require.email.activation").style.display = "none";
		document.getElementById("registration.auto.subscribe.email").style.display = "none";
		document.getElementById("registration.notify.admin").style.display = "none";
		document.getElementById("css.extension.file").style.display = "none";
		document.getElementById("disable.password.reset").style.display = "none";
		document.getElementById("home.url").style.display = "none";

		//Hides user preferences
		var userPreferences = $("li[id*='Time']");
		for (i=0;i<userPreferences.length;i++){
			userPreferences[i].style.display = "none";
		}
		var userPreferences = $("li[id*='color']");
		for (i=0;i<userPreferences.length;i++){
			userPreferences[i].style.display = "none";
		}
	
		//Hides other options
		document.getElementById("schedule").style.display = "none";
		document.getElementById("ics").style.display = "none";
		document.getElementById("privacy").style.display = "none";
		document.getElementById("reservation").style.display = "none";
		document.getElementById("reservation.notify").style.display = "none";
		document.getElementById("plugins").style.display = "none";
		document.getElementById("recaptcha").style.display = "none";
		document.getElementById("email").style.display = "none";
		document.getElementById("reports").style.display = "none";
		document.getElementById("password").style.display = "none";
		document.getElementById("reservation.labels").style.display = "none";
		document.getElementById("security").style.display = "none";
		document.getElementById("google.analytics").style.display = "none";
		
		document.getElementById("phpmailer").style.display = "none";
		document.getElementById("uploads").style.display = "none";
		document.getElementById("default.homepage").style.display = "none";
	}
	
	//Translate options
	var a = document.getElementsByClassName("label");
	for (i=0;i<a.length;i++){
		switch(a[i].textContent) {
			case "app.title":
				a[i].textContent = document.getElementById("string1").value;
				break;
			case "default.timezone":
				a[i].textContent = document.getElementById("string2").value;
				break;
			case "default.page.size":
				a[i].textContent = document.getElementById("string3").value;
				break;
			case "enable.email":
				a[i].textContent = document.getElementById("string4").value;
				break;
			case "admin.email":
				a[i].textContent = document.getElementById("string5").value;
				break;
			case "default.language":
				a[i].textContent = document.getElementById("string6").value;
				break;
			case "script.url":
				a[i].textContent = document.getElementById("string7").value;
				break;
			case "inactivity.timeout":
				a[i].textContent = document.getElementById("string8").value;
				break;
			case "name.format":
				a[i].textContent = document.getElementById("string9").value;
				break;
			case "logout.url":
				a[i].textContent = document.getElementById("string10").value;
				break;
			case "host":
				a[i].textContent = document.getElementById("string11").value;
				break;
			case "port":
				a[i].textContent = document.getElementById("string12").value;
				break;
			case "version":
				a[i].textContent = document.getElementById("string13").value;
				break;
			case "starttls":
				a[i].textContent = document.getElementById("string14").value;
				break;	
			case "binddn":
				a[i].textContent = document.getElementById("string15").value;
				break;	
			case "bindpw":
				a[i].textContent = document.getElementById("string16").value;
				break;	
			case "basedn":
				a[i].textContent = document.getElementById("string17").value;
				break;
			case "filter":
				a[i].textContent = document.getElementById("string18").value;
				break;	
			case "attribute.mapping":
				a[i].textContent = document.getElementById("string19").value;
				break;	
			case "user.id.attribute":
				a[i].textContent = document.getElementById("string20").value;
				break;					
			default:
				break;
		}
	}
	
}