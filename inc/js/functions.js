(function($) {
	"use strict";

	// Responsive iframe
	function resp_iframe() {
		$(".blog-oembed iframe, .king-iframe").each(function(index, element) {
			var w = $(this).parent().width();
			var h = (w*(9/16));
			$(this).css({"width":w+"px","height":h+"px"});
		});		
	}

	// Assign Browser Width to Row - If Front Page Widget Area has Featured Image
	function full_front_widget() {
		var browser_width = $('#page').outerWidth( true );
		var front_widget_offset = $("#content").offset();
		var front_widget_styles = {
	      "width": browser_width,
	      "left": - front_widget_offset.left,
	    };
		$(".widget-thumbnail").css( front_widget_styles );
	}

	// Assign Top Padding When Transparent Menu Is Set
	function transperent_top_padding() {
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

	$(document).ready(function() {
		// Meny Toggle
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

	    // Enable Fixed Menu Through jQuery
		var starting_position = $('.king-fixed-menu .site-header').outerHeight( true );
		$(window).scroll(function() {
			var yPos = ( $(window).scrollTop() );
			if( yPos > starting_position && window.innerWidth > 768 ) { 
				$(".king-fixed-menu .site-header").addClass("king-sticky-menu");
			} else {
				$(".king-fixed-menu .site-header").removeClass("king-sticky-menu");
			}
		});

		// ColorBox
	    $('#page').find('a.king-lightbox').colorbox({
	        maxWidth : '80%',
	        maxHeight : '90%',
	        rel: 'king-lightbox',
	        opacity : 0.8,
	        transition : 'elastic',
	        current : ''
	    });

	    // Responsive iframe 
	    resp_iframe();

	    // Assign Browser Width to Row - If Front Page Widget Area has Featured Image
	    full_front_widget();

	    // Assign Top Padding When Transparent Menu Is Set
		transperent_top_padding();

    });	

	$(window).on('resize',function() {
		// Responsive iframe
		resp_iframe();

		// Assign Browser Width to Row - If Front Page Widget Area has Featured Image
	    full_front_widget();

	    // Assign Top Padding When Transparent Menu Is Set
		transperent_top_padding();
	});

})(jQuery);