jQuery(document).ready(function($){

  $('input[id*="-showgoto"]').each(function(e, i){
    ytc_toggle_widget_option_checkbox($(this).attr('id'));
  });
  $('input[id*="-showgoto"]').on('change', function(e, i){
    ytc_toggle_widget_option_checkbox($(this).attr('id'));
  });

  $(document).ajaxSuccess(function(e, xhr, settings){
    $('input[id*="-showgoto"]').each(function(e, i){
      ytc_toggle_widget_option_checkbox($(this).attr('id'));
    });
    $('input[id*="-showgoto"]').on('change', function(e, i){
      ytc_toggle_widget_option_checkbox($(this).attr('id'));
    });
  });

  function ytc_toggle_widget_option_checkbox(id) {
    if ( $('#' + id).attr('checked') === 'checked' ) {
      $('p.' + id).addClass('visible').removeClass('hidden');
    } else {
      $('p.' + id).addClass('hidden').removeClass('visible');
    }
  }

});