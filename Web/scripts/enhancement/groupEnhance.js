var sorting = function(){
	//$("#groupTable").tablesorter();	
	$("#groupTable").tablesorter({ 
	widgets: ["zebra"],
	widgetOptions : {
	zebra : [ "normal-row", "alt-row" ]},
	sortList: [[0,1]] });	
}