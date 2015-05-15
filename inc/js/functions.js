(function($) {
	"use strict";

	// Responsive iframe
	function king_resp_iframe() {
		$(".blog-oembed iframe, .king-iframe").each(function(index, element) {
			var w = $(this).parent().width();
			var h = (w*(9/16));
			$(this).css({"width":w+"px","height":h+"px"});
		});		
	}

	// Assign Top Padding When Transparent Menu Is Set
	function king_transperent_top_padding() {
		var header_height = $('.king-fixed-menu .site-header').outerHeight( true );
		if( window.innerWidth > 768 ) {
			$("body #main").css('padding-top',header_height);
			$(".king-page-header").css('padding-top',header_height);
		}
		else {
			$("body #main").css('padding-top',0);
			$(".king-page-header").css('padding-top',0);
		}
	}

	// Menu Toggle
	function king_menu_toggle() {
	    $('.menu-toggle-wrap').click( function() {
	    $('.nav-menu').toggle()});
		$("li.menu-item-has-children").click(function () {
	  		$(this).toggleClass("ulopen");
		});
		$("li.page_item_has_children").click(function () {
	  		$(this).toggleClass("ulopen");
		});	  	
	    $(this).find("li.page_item_has_children > a").after( "<span class='fa fa-angle-down'></span>" );
	    $(this).find("li.menu-item-has-children > a").after( "<span class='fa fa-angle-down'></span>" );
	}

	// Enable Fixed Menu Through jQuery
	function king_fixed_menu() {
		var starting_position = $('.king-fixed-menu .site-header').outerHeight( true );
		$(window).scroll(function() {
			var yPos = ( $(window).scrollTop() );
			if( yPos > starting_position && window.innerWidth > 768 ) { 
				$(".king-fixed-menu .site-header").addClass("king-sticky-menu");
			} else {
				$(".king-fixed-menu .site-header").removeClass("king-sticky-menu");
			}
		});
	}

	// ColorBox
	function king_colorbox() {
		$('#page').find('a.king-lightbox').colorbox({
	        maxWidth : '80%',
	        maxHeight : '90%',
	        rel: 'king-lightbox',
	        opacity : 0.8,
	        transition : 'elastic',
	        current : ''
	    });
	}

	// Blog Masonry
	function king_blog_masonry() {
		if($( "body" ).hasClass( "blog-masonry" )) {
			if($( "body" ).hasClass( "blog" ) || $( "body" ).hasClass( "archive" ) || $( "body" ).hasClass( "search" )) {
				$('.blog-masonry #content').imagesLoaded(function () {
					$('.blog-masonry #content').masonry({
						columnWidth: '.post',
						itemSelector: '.post',
						transitionDuration: 0
					});
				});
			}
		}
	}

	// Scroll To Top
	function king_scroll_to_top() {
		if($( "body" ).hasClass( "scroll-to-top" )) {
			$( "body" ).append( '<a class="king-scroll-top" href="#page"><span class="fa fa-angle-up"></span></a>' );
			jQuery('.king-scroll-top').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				  var target = jQuery(this.hash);
				  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
				  if (target.length) {
					jQuery('html,body').animate({
					  scrollTop: target.offset().top
					}, 1000);
					return false;
				  }
				}
			});
			jQuery(document).scroll(function(){
				var wh = jQuery(window).height()/3;
				if (jQuery(this).scrollTop() > wh) {
					jQuery('.king-scroll-top').addClass('king-scroll-top-show');
				} else {
					jQuery('.king-scroll-top').removeClass('king-scroll-top-show');
				}
			});
		}
	}

	// Justified Grid Gallery
	function king_justified_gallery() {
		if($( "div" ).hasClass( "king-justified-grid-gallery" )) {
			if($( "body" ).hasClass( "single" ) || $( "body" ).hasClass( "page" )) {
				jQuery('.king-justified-grid').justifiedGallery({			    
			        rowHeight: 200,
			        maxRowHeight: 200,
			        margins: 3,
			        captions: true,
			        rel : 'metro',
				    randomize: true,
				    lastRow: 'justify'
			    });
			} else {
			    jQuery('.king-justified-grid').justifiedGallery({
			        rowHeight: 120,
			        maxRowHeight: 120,
			        margins: 3,
			        captions: false,
			        rel : 'metro',
				    randomize: true,
				    lastRow: 'justify'
			    });
			}         
		}
	}

	// Slideshow Gallery
	function slideshow_gallery() {
		$( ".king-slideshow-gallery" ).each( function() {
			var slidestoshow = parseInt($(this).data('slidestoshow'));
			var slidestoscroll = parseInt($(this).data('slidestoscroll'));
			var respnsive_init = '';
			if( slidestoshow != 1 ) {
				respnsive_init = '[\
						{\
							breakpoint: 768,\
							settings: {\
								slidesToShow: 2,\
								slidesToScroll: 2\
							}\
						},\
						{\
							breakpoint: 480,\
							settings: {\
								slidesToShow: 1,\
								slidesToScroll: 1\
							}\
						}\
					]';
			}
			$(this).slick({
				adaptiveHeight: true,
				slidesToShow: slidestoshow,
				slidesToScroll: slidestoscroll,
				responsive:eval(respnsive_init)
			});
		});
	}
						
					
	$(document).ready(function() {		

	    // Enable Fixed Menu Through jQuery
		king_fixed_menu();

		// ColorBox
	    king_colorbox();

	    // Menu Toggle
	    king_menu_toggle()

	    // Responsive iframe 
	    king_resp_iframe();

	    // Assign Top Padding When Transparent Menu Is Set
		king_transperent_top_padding();

		// Blog Masonry
		king_blog_masonry();

		// Scroll To Top
		king_scroll_to_top();

		// Justified Grid Gallery
		king_justified_gallery();

		// Slideshow Gallery
		slideshow_gallery();

    });	

	$(window).load(function() {
		// Enable Fixed Menu Through jQuery
		king_fixed_menu();

	    // Menu Toggle
	    king_menu_toggle()

	    // Responsive iframe 
	    king_resp_iframe();

	    // Assign Top Padding When Transparent Menu Is Set
		king_transperent_top_padding();

		// Blog Masonry
		king_blog_masonry();

		// Justified Grid Gallery
		king_justified_gallery();

	});

	$(window).on('resize',function() {
		// Enable Fixed Menu Through jQuery
		king_fixed_menu();

	    // Menu Toggle
	    king_menu_toggle()

	    // Responsive iframe 
	    king_resp_iframe();

	    // Assign Top Padding When Transparent Menu Is Set
		king_transperent_top_padding();

		// Blog Masonry
		king_blog_masonry();

		// Justified Grid Gallery
		king_justified_gallery();

	});

	$(document).ajaxComplete(function(e, xhr, settings){

		// Slideshow Gallery
		slideshow_gallery();

	});

})(jQuery);