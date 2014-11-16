var ww = document.body.clientWidth;

jQuery(document).ready(function($) {  
 
 "use strict";  

  $(window).scroll(function() { 
		if (ww >= 768) {		
			 var additionHeight = 1;
			 var addClass = "fixed animated fadeInDown";
			 var classAddTo = "section#header";
			 
			 
			 var scroll = $(window).scrollTop();
			 var actionHeight = additionHeight;
			 
				if (scroll >= actionHeight) {
				   $(classAddTo).addClass(addClass);
				   $('.bredcrumbs-container').css({'padding-top' : $(classAddTo).outerHeight()});
				} else {
					$(classAddTo).removeClass(addClass);
					 $('.bredcrumbs-container').css({'padding-top' : 0});
				}
				adjustMegamenu();
			}
			
	});  
 
  jQuery(".nav li a").each(function() {
    if (jQuery(this).next().length > 0) {
    	jQuery(this).addClass("parent");
		};
	})
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".nav").toggle();
	});
	adjustMenu();	
	adjustMegamenu();
	$(window).trigger('resize');
});



jQuery(window).load(function() {
	adjustMenu();
	adjustMegamenu();
});

jQuery(window).resize(function() {
	adjustMenu();
	adjustMegamenu();
});

jQuery(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
	adjustMegamenu();
});

var adjustMenu = function() {
	if (ww < 769) {

	jQuery('.nav.crm-menu').css( 'width' , jQuery('.nav.crm-menu').closest('.row').innerWidth()-30);
    // if "more" link not in DOM, add it
    jQuery('.more').remove(); 
    jQuery('.nav > li > .parent').each(function(){
    	jQuery('<div class="more"><i class="fa fa-angle-down"></i></div>').insertBefore(jQuery(this)); 
    })
    
		jQuery(".toggleMenu").css("display", "inline-block");
		if (!jQuery(".toggleMenu").hasClass("active")) {
			jQuery(".nav").hide();
		} else {
			jQuery(".nav").show();
		}
		jQuery(".nav li").unbind('mouseenter mouseleave');
		jQuery(".nav li a.parent").unbind('click');
    	jQuery(".nav li .more").unbind('click').bind('click', function() {
			
			jQuery(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww > 768) {    	

    	// remove .more link in desktop view
    	jQuery('.more').remove(); 
		jQuery(".toggleMenu").css("display", "none");
		jQuery(".nav").show();
		jQuery(".nav li").removeClass("hover");
		jQuery(".nav li a").unbind('click');
		jQuery(".nav li").unbind('mouseenter mouseleave').bind('mouseenter', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	jQuery(this).addClass('hover');
		}).bind(' mouseleave', function(){
			jQuery(this).removeClass('hover');
		});
	}
}

function adjustMegamenu(){
	if (ww >= 768) {
	  jQuery('.megamenu').each(function(){
			var p = jQuery(this).position();

			var menuWidth = jQuery(this).closest('ul').parent().outerWidth();
			var extwidth = jQuery('.search-col').outerWidth();
			
			if(jQuery('body').hasClass('rtl')){
				var leftOffset = p.left-14+extwidth;
			}else{
				var leftOffset = p.left-14;
			}
			
			jQuery(this).children('ul').css({'left': -leftOffset, 'width': (menuWidth + extwidth-30 )});
		});

	  	// get the height of the tallest LI within each UL group
	    var max = Math.max.apply(Math, jQuery(".nav > li").map(
	        function(){
	          return jQuery(this).height();
	        }
	      ));

		// now render the height in each parent UL
		jQuery('.search > i, .form-search .search-query').height(max);
	    jQuery(".nav > li").each(function() {
	      jQuery(this).height(max);
	    });

  }else{
	  jQuery(this).children('ul').attr('style', '');
	  jQuery(".nav > li").attr('style', '');
	  jQuery('.search > i, .form-search .search-query').attr('style', '');
  }
}
