$(document).ready(function($) {
	var settings = {};
	
	Settings = {
			isVibrate : function(){
				var supportsVibrate = "vibrate" in navigator;
				return supportsVibrate;
			}
	}
});