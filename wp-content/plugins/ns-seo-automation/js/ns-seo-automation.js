jQuery(function($){
	var context = $('body.seo_page_ns_seo_automation');
	
	// collapsible ui boxes 
	$('.ns-ui-box h3').click(function(){
		$(this).next().slideToggle();
	})
	
	// repeater
	$('.ns-repeater').on( 'click', '.ns-repeater-remove', function(){
		var repeater = $(this).parents('.ns-repeater');
		if( repeater.find('li').length > 1 ){
			$(this).parent('li').remove();
		}
		else{
			$(this).parent('li').hide().find('textarea,input,select').removeAttr('checked selected').val('');
		}
	});
	$('.ns-repeater-add').click(function(){
		var repeater = $(this).prev('.ns-repeater');
		var field = repeater.find('li:last').clone();
		field.show().find('textarea,input,select').removeAttr('checked selected').val('');
		repeater.append(field);
	})
	
})