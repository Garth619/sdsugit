(function($) { 
  $(document).ready(function() {
  	
    randomizeTestimonialWidget();
   
    function randomizeTestimonialWidget() {
	  var widget = jQuery( ".testimonial-widget" );
	  var count = jQuery( widget ).length;
	  var currentTestimonial = 0;
	
	  currentTestimonial = selectTestimonial( count );

	  for( var i = 0; i <= count; i++ ) {
	    if( i == currentTestimonial ) {
	      jQuery( ".testimonial-widget" ).eq( i-1 ).css( "display", "block" );
		}
		else {
		  jQuery( ".testimonial-widget" ).eq( i-1 ).css( "display", "none" );
		}
	  }
    }
  });
  
    function selectTestimonial(count) {
	  var index = Math.floor((Math.random()*count)+1);
	  return index;
	}
  
})(jQuery);
