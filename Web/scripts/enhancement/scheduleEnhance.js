
//Schedule enhance
enhance = function(){
	
	//Create and append the options
	for (i = 0; i < 25; i++) {
			
		//Variables
		var option1 = document.createElement("option");
		var option2 = document.createElement("option");
		k = i;
			
		//Always 2 ciphers
		if (i < 10){
			k ="0"+i;
		}
			
		//Generates options
		option1.value = k+":00";
		option1.text = k+":00";
		option2.value = k+":00";
		option2.text = k+":00";
		document.getElementById("quickLayoutStart").appendChild(option1);
		document.getElementById("quickLayoutEnd").appendChild(option2);
	}
}