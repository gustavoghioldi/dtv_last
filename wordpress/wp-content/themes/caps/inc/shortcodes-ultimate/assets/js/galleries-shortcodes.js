jQuery(document).ready(function ($) {
	// Enable sliders
	$('.su-slider').each(function () {
		// Prepare data
		var $slider = $(this);
		// Apply Swiper
		var $swiper = $slider.swiper({
			wrapperClass: 'su-slider-slides',
			slideClass: 'su-slider-slide',
			slideActiveClass: 'su-slider-slide-active animation animated fadeIn',
			slideVisibleClass: 'su-slider-slide-visible',
			pagination: '#' + $slider.attr('id') + ' .su-slider-pagination',
			autoplay: $slider.data('autoplay'),
			paginationClickable: true,
			grabCursor: true,
			mode: 'horizontal',
			mousewheelControl: $slider.data('mousewheel'),
			speed: $slider.data('speed'),
			calculateHeight: $slider.hasClass('su-slider-responsive-yes'),
			loop: true,
			onSlideNext: function(swiper){  $( this ).animate({
					width: "toggle",
					height: "toggle"
					}, {
					duration: 5000,
					specialEasing: {
					width: "linear",
					height: "easeOutBounce"
					},
					complete: function() {
					$( this ).after( "<div>Animation complete.</div>" );
					}
					}); },
			onSlidePrev: function(swiper){}
		});
		// Prev button
		$slider.find('.su-slider-prev').click(function (e) {
			$swiper.swipeNext();
		});
		// Next button
		$slider.find('.su-slider-next').click(function (e) {
			$swiper.swipePrev();
		});
	});


	$('.thumbs-group a').click(function(){
		var i = $(this).data('count');
		$('.su-carousel-pagination > span:nth-child('+i+')').trigger('click');
		return false;
	})

	// Enable carousels
	$('.su-carousel').each(function () {
		// Prepare data
		var $carousel = $(this),
			$slides = $carousel.find('.su-carousel-slide');
		// Apply Swiper
		var $swiper = $carousel.swiper({
			wrapperClass: 'su-carousel-slides',
			slideClass: 'su-carousel-slide',
			slideActiveClass: 'su-carousel-slide-active',
			slideVisibleClass: 'su-carousel-slide-visible',
			pagination: '#' + $carousel.attr('id') + ' .su-carousel-pagination',
			autoplay: $carousel.data('autoplay'),
			paginationClickable: true,
			grabCursor: true,
			mode: 'horizontal',
			mousewheelControl: $carousel.data('mousewheel'),
			speed: $carousel.data('speed'),
			slidesPerView: ($carousel.data('items') > $slides.length) ? $slides.length : $carousel.data('items'),
			slidesPerGroup: $carousel.data('scroll'),
			calculateHeight: $carousel.hasClass('su-carousel-responsive-yes'),
			loop: true
		});
		// Prev button
		$carousel.find('.su-carousel-prev').click(function (e) {
			$swiper.swipeNext();
		});
		// Next button
		$carousel.find('.su-carousel-next').click(function (e) {
			$swiper.swipePrev();
		});
	});
	// Lightbox for galleries (slider, carousel, custom_gallery)
	$('.su-lightbox-gallery').each(function () {
		$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
				tPrev: su_magnific_popup.prev,
				tNext: su_magnific_popup.next,
				tCounter: su_magnific_popup.counter
			},
			image: {
				tError: su_magnific_popup.error,
				titleSrc: function (item) {
					return item.el.children('img').attr('alt');
				}
			},
			tClose: su_magnific_popup.close,
			tLoading: su_magnific_popup.loading
		});
	});
});