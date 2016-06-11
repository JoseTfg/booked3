//Resets the search
var reset = function(){
	url = document.URL;
	url = url.substr(0,url.indexOf("php")+3);
	window.location = url;
}

//Sorts the table
var sorting = function(){
	$("#userTable").tablesorter({
	widgets: ["zebra"],
	widgetOptions : {
	zebra : [ "normal-row", "alt-row" ]}
	});	
}