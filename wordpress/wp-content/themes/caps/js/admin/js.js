jQuery(document).ready(function($) {
	 	
	  "use strict";

	
		if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
	        jQuery( '.rox-color' ).wpColorPicker();
	    }else {
	        //We use farbtastic if the WordPress color picker widget doesn't exist
	        jQuery( '.rox-colorpicker' ).farbtastic( '.rox-color' );
	    }
		
		
		jQuery('.datepicker').datepicker({
		dateFormat : 'dd-mm-yy'
		});
	    
	
});
