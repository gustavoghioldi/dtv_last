jQuery(document).ready(function() { 
	jQuery("img.lazy").each(function(){
		jQuery(this).lazy({
			effect: "fadeIn"
		}); 
	});

	jQuery("select").selectbox();
	
});  

function rtlSwapItems(el){
el.children().each(function(i,e){
jQuery(e).parent().prepend(jQuery(e));
})
}
 
function rtlCallback(el){
var pagination = el.find('.owl-pagination');
var numbers = pagination.find('.owl-numbers');
var pages = pagination.find('.owl-page');
var numbersLenght = numbers.length;
 
pages.each(function(i,e){
			var $e = jQuery(e);
			if($e.hasClass('active')){
				$e.siblings().andSelf().removeClass('hide-page')
				$e.prev().prevAll().addClass('hide-page');
				$e.next().nextAll().addClass('hide-page');
			}
		});
		 
		if( numbers.eq(0).data('owl-flipped') === true ){
			return false
		}
		numbers.each(function(i,e){
			var $en = jQuery(e);
			 $en.data('owl-flipped',true);
			var number = $en.text();
			var newNumber = Math.abs( (number - (numbersLenght + 1)) );
			$en.text(newNumber);
		});
}
 


jQuery(document).ready(function($) {  	

  var margT = $('body').outerHeight(true) - $('body').innerHeight();
  "use strict";
  $(window).scroll(function() { 
		if(top_fixed_menu == 1){		
			 var additionHeight = 50;
			 var addClass = "fixed animated fadeInDown";
			 var classAddTo = "section.header";
			 
			 
			  $('.main-menu-header').outerHeight();
			 var scroll = $(window).scrollTop();
			 var actionHeight = $("section.header").outerHeight(); + additionHeight + margT;
			 
				if (scroll >= actionHeight) {
				   $(classAddTo).addClass(addClass);
				   //$('body').css('margin-top', 0);
				} else {
					$(classAddTo).removeClass(addClass);
					//$('body').css('margin-top', margT)
				}
			}
	});
	
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		if(scroll > 100){
			$(".arrow-up").fadeIn();
		} else{
			$(".arrow-up").fadeOut();
		}
	});
	
	$(".arrow-up").click(function(){
		$("html, body").animate({scrollTop: 0}, 1000);
	});	
	

	
	$('.header .search').click(function(){
		$('.form-search').toggleClass('search-open');
		return false;
	});

	$('.main-slider').owlCarousel({
		transitionStyle: 'fade',
        singleItem:true,
        autoPlay : true,
        stopOnHover : true,
        addClassActive : true,
        lazyLoad : true,
        lazyFollow : true,
        lazyEffect : "fade",
        pagination : false,              
        navigation : true,
    	navigationText : ["",""]
	});
	 
 
	if($(".owl-post-slider").length > 0){
		var owl = $(".owl-post-slider");
		if(!jQuery('body').hasClass('rtl')){
			owl.owlCarousel({
				itemsCustom : [
				[0, 1],
				[450, 2],
				[600, 3],
				[700, 3],
				[1000, 3],
				[1200, 3],
				[1400, 4],
				[1600, 5]
				],
				navigation : true,
				transitionStyle: 'fade',
				lazyLoad : true,
				 
			});
		}

		
		 
	}

	$('.must-log-in a').click(function(){
		$('#open').trigger('click');
		$("html, body").animate({scrollTop: 0}, 1000);
		return false;
	})


	 $('.gallery').magnificPopup({
		  delegate: 'a', // child items selector, by clicking on it popup will open
		  type: 'image',
		  gallery:{
		    enabled:true
		  }
		  // other options
		});
		
	  
});

jQuery(window).load(function(){
	jQuery('.latest-title').ticker();
	jQuery('.slide-cat').show();
})



