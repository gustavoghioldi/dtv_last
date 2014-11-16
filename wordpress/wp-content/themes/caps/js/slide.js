jQuery(document).ready(function() {
	if(jQuery("div#panel").length > 0){	
		var ext = 0;
		

		
		
		var top = jQuery('.top-nav-background').height(true) + ext;
		jQuery("div#panel").css({top : top});
		// Expand Panel
		jQuery("#open").click(function(){
			jQuery("div#panel").slideDown("slow");
			return false;
		});	
		
		// Collapse Panel
		jQuery("#close").click(function(){
			jQuery("div#panel").slideUp("slow");
			return false;
		});		
		
		// Switch buttons from "Log In | Register" to "Close Panel" on click
		jQuery("#toggle a").click(function () {
			jQuery("#toggle a").toggle();
			return false;
		});	
	}
		
});

window.onresize = function() {
	
	if(jQuery("div#panel").length > 0){
		var ext = jQuery('body').offset().top;
		
		var top = jQuery('.top-nav-background').outerHeight(true) + ext;
		jQuery("div#panel").css({top : top});
	}

	
		
}
