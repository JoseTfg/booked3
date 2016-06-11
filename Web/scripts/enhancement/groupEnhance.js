//Sorts the table
var sorting = function(){	
	$("#groupTable").tablesorter({ 
	widgets: ["zebra"],
	widgetOptions : {
	zebra : [ "normal-row", "alt-row" ]},
	sortList: [[0,1]] });	
}