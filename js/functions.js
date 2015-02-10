// Enable Fixed Menu Through jQuery
jQuery(function( jQuery ) {
	var starting_position = jQuery('.ult-fixed-menu').outerHeight( true );
	jQuery(window).scroll(function() {
		var yPos = ( jQuery(window).scrollTop() );
		if( yPos > starting_position && window.innerWidth > 768 ) { 
			jQuery(".ult-fixed-menu").addClass("ult-sticky-menu");
		} else {
			jQuery(".ult-fixed-menu").removeClass("ult-sticky-menu");
		}
	});
});

// Aissign Top Padding When Transparent Menu Is Set
jQuery(document).ready(function() {
	var header_height = jQuery('.ult-fixed-menu').outerHeight( true );
	if( window.innerWidth > 768 ) {
		jQuery("body #main").css('padding-top',header_height);
		jQuery(".ultimate-page-header").css('padding-top',header_height);
	}
	else {
		jQuery("body #main").css('padding-top',0);
		jQuery(".ultimate-page-header").css('padding-top',0);
	}
});
jQuery(window).on('resize',function() {
	var header_height = jQuery('.ult-fixed-menu').outerHeight( true );
	if( window.innerWidth > 768 ) {
		jQuery("body #main").css('padding-top',header_height);
		jQuery(".ultimate-page-header").css('padding-top',header_height);
	}
	else {
		jQuery("body #main").css('padding-top',0);
		jQuery(".ultimate-page-header").css('padding-top',0);
	}
});


// Assign Browser Width to Row - If Front Page Widget Area has Featured Image
jQuery(document).ready(function() {
	var browser_width = jQuery('#page').outerWidth( true );
	var front_widget_offset = jQuery("#content").offset();
	var front_widget_styles = {
      "width": browser_width,
      "left": - front_widget_offset.left,
    };
	jQuery(".widget-thumbnail").css( front_widget_styles );
});
jQuery(window).on('resize',function() {
	var browser_width = jQuery('#page').outerWidth( true );
	var front_widget_offset = jQuery("#content").offset();
	var front_widget_styles = {
      "width": browser_width,
      "left": - front_widget_offset.left,
    };
	jQuery(".widget-thumbnail").css( front_widget_styles );
});


// Menu Toggle
jQuery( function() {
    jQuery('.menu-toggle-wrap').click( function() {
    	jQuery('.nav-menu').toggle()});
});

jQuery(document).ready(function(jQuery) {
	jQuery("li.menu-item-has-children").click(function () {
  		jQuery(this).toggleClass("ulopen");
	});
	jQuery("li.page_item_has_children").click(function () {
  		jQuery(this).toggleClass("ulopen");
	});	  	
    jQuery(this).find("li.page_item_has_children > a").after( "<span class='ent entarrow-down7'></span>" );
    jQuery(this).find("li.menu-item-has-children > a").after( "<span class='ent entarrow-down7'></span>" );
});

// ColorBox
jQuery(document).ready(function() {
    jQuery('#page').find('a.ultimate-lightbox').colorbox({
        maxWidth : '80%',
        maxHeight : '90%',
        rel: 'ultimate-lightbox',
        opacity : 0.8,
        transition : 'elastic',
        current : ''
    });
});

