(function($) { 
  $(document).ready(function() {
  	
  	main_nav_mobile_menu_click_event();
	top_nav_mobile_menu_click_event();
	mobile_sub_menu_click_event();
	
  	mobile_sub_menu();
  	search_box();
	
  	if (window_width >= 959) {
		accessible_menu();
	} 
	
  	$(window).resize(function() {

  		if (window_width >= 959) {
  			accessible_menu();
		}
	  	mobile_sub_menu();

		main_nav_visibility_toggle();
		top_nav_visibility_toggle();
		mobile_sub_menu_visibility_toggle();
		
  	});
                           
  });
  
  window_width = $(window).width();
  
  $(window).resize(function() {
  	window_width = $(window).width();
  });
   
  function accessible_menu() { 
  	    if (window_width >= 959 ) {
		  	$('#menu-main-menu li a').focus(function(){
		  		$(this).next('.sub-menu').css('display', 'block');	
		  		$(this).parents('.sub-menu').css('display', 'block');
		  	});
		  	
		  	$('#menu-main-menu li a').focusout(function(){
			  	$('.sub-menu').hide();
		  	});
		  	
		  	$('#menu-main-menu li a').hover(function(){
			  	$(this).next('.sub-menu').css('display', 'block');	
		  		$(this).parents('.sub-menu').css('display', 'block');
		  	}, function(){
			  	$('.sub-menu').hide();
		  	});
	  	}

  }
  
  function main_nav_visibility_toggle(){
		if ( (window_width <= 959 && window_width > 950) || (window_width <= 539 && window_width > 530) ) {
			if( $('.main-menu .wrap .menu-toggle').next('nav').hasClass('show') ) {
				$('.main-menu .wrap .menu-toggle').next('nav').toggleClass('show');
			}
		}
  }
  
  function top_nav_visibility_toggle(){
		if (window_width <= 540 && window_width > 530) {
			if( $('.top .wrap .menu-toggle').next('nav').hasClass('show') ) {
				$('.top .wrap .menu-toggle').next('nav').toggleClass('show');
			}
		}
  }
  
  function mobile_sub_menu_visibility_toggle(){
		if ( (window_width <= 959 && window_width > 950) || (window_width <= 539 && window_width > 530) ) {
			if( $('.menu-toggle-container .menu-toggle').next('aside').hasClass('show') ) {
				$('.menu-toggle-container .menu-toggle').next('aside').toggleClass('show');
			}
		}
  }
  
  function main_nav_mobile_menu_click_event() { 
	 	
		 $('.main-menu .menu-toggle').click(function(e){
		 	 e.preventDefault();
			 
			 if ($(this).next('nav').hasClass('show') === true) {
				$(this).next('nav').toggleClass('show');
			 } else {
				$(this).next('nav').toggleClass('show');
			 }
		 });
			 
  }
  
  function top_nav_mobile_menu_click_event() { 
  
		 $('.top .menu-toggle').click(function(e){
		 	 e.preventDefault();
			$(this).next('.mobile-wrap').toggleClass('show');
		 });
			 
  }
  
  function mobile_sub_menu() {
	  if ($('main').hasClass('left-sidebar')) {
	  	if (window_width <= 959) {
			  $('aside.left').appendTo('.menu-toggle-container')
			 // $('.menu-toggle-container aside.left').removeClass('show');
			 
		}
		else if ($('.menu-toggle-container aside.left').length) {
			$('.menu-toggle-container aside.left').appendTo('.left-sidebar .wrap')
			$('aside.left').addClass('show');
		}
	 }
  }
  
  function search_box() {
	  $('.search img').click(function() {
		 $(this).next('.input-container').toggle();	
	  });
	setTimeout(function() { $('.mobile-wrap td.gsc-search-button input').attr('src', '/wp-content/themes/uiuc-ssw/img/footer_arrow.png') }, 500 );
  }
  
  function mobile_sub_menu_click_event() {
	  $('.menu-toggle-container .menu-toggle').click(function(e){
	 	 e.preventDefault();
		 if ($(this).next('aside').hasClass('show') === true) {
			$(this).next('aside').toggleClass('show');
		 } else {
			$(this).next('aside').toggleClass('show');
		 }
	  });
  }
                                                                        
})(jQuery);

// iOS rotate zoom fix
(function(doc) {
 
	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
 
	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}
 
	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}
 
}(document));
