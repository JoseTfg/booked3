var reset = function(){
	//window.location = "http://localhost/booked/Web/admin/manage_users.php";
	url = document.URL;
	url = url.substr(0,url.indexOf("php")+3);
	window.location = url;
}

var sorting = function(){
	$("#userTable").tablesorter();	
}