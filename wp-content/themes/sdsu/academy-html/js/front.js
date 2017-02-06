(function($) { 
  $(document).ready(function() {                                              
  	carousel();
   	setTimeout(function() { carousel_height_adjust(); }, 50 );
	setTimeout(function() { carousel_height_adjust(); }, 500 );
	$(window).resize(function() {
		setTimeout(function() { carousel_height_adjust(); }, 500 );
	});                                              
  });
  
  function carousel() {    
   	$('.slider').anythingSlider({
	   	theme: 'custom',
	   	mode: 'fade',
	   	buildStartStop: false,
	    buildNavigation: false,
	    autoPlay: true,
	    delay: 6000,
	    hashTags: false,
	    expand: true,
	    resizeContents: true

	  });		
  }
  function carousel_height_adjust() {
	var img_height = $('.carousel img').height();
	
	if (img_height) {
		if (img_height < 390) {
			$('.carousel').css('height', img_height);
		}
	}
  }
                                                                        
})(jQuery);