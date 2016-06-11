//Marquee enhance
var footerEnhance = function(){	
	
	//Attach marquee menu
	$('#marquee').addClass("footerMenu");
	
	//Menu
	$(".footerMenu").contextmenu({
		menu: [
			{title: document.getElementById("runString").value, cmd: "stop", uiIcon: "ui-icon-pause"},
			{title: "----"},
			{title: document.getElementById("hideString").value, cmd: "hide", uiIcon: "ui-icon-circle-zoomout"}
			],
		select: function(event, ui) {
			switch (ui.cmd) {
				case "stop":
					if (document.getElementById('marquee').className != "stopped"){
						document.getElementById('marquee').stop();
					}				
					break;
				case "hide":
					if (document.getElementById('marquee').style.color.indexOf("204") == -1){
						document.getElementById('marquee').style.color = "#CCCC99";
					}
					else{
						document.getElementById('marquee').style.color = "black";
					}
					break;
				default:
					break;
			}
		}
	});	
}