function toast(message) {
			
	if(typeof Android !== "undefined" && Android !== null) {

		Android.toast(message);
		
	}
	
	else {
	
		alert(message);
	
	}
          
}
	 