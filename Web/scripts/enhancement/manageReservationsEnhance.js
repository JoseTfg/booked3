
//Enhance functions
var enhance = function(){

		//ClickInputs
		$("#myFilterLabel").on('click', function() {
		   if (document.getElementById("ulFilter").style.display == "none"){
				document.getElementById("ulFilter").style.display = "initial";
				document.getElementById("adminFilterButtons").style.display = "initial";
		   }
		   else{
				document.getElementById("ulFilter").style.display = "none";
				document.getElementById("adminFilterButtons").style.display = "none";				
			}
		});
		
		//TableSorter
		$("#reservationTable").tablesorter({
			widgets: ["zebra"],
			widgetOptions : {
				zebra : [ "normal-row", "alt-row" ]
				}
		});
} 
