

/* Mobile Devices Navigation Script */
(function ($) {
  $(document).ready(function(){
    $('a.resp_navigation').bind('click', function () { 
      if ($(this).hasClass('active')) {
        $('.sf-menu').slideUp('fast');
				
        $('.sf-menu ul').css( {
          display : 'none'
        } );
        $(this).removeClass('active');
      } else {
        $('.sf-menu').slideDown('fast');
				
        $(this).addClass('active');
      }
			
      return false;
    } );
		
    $('.sf-menu li a').bind('click', function () { 
      if ($('a.resp_navigation').is(':visible')) {
        if ($(this).next().is('ul')) {
          if ($(this).next().is(':visible')) {
            $(this).next().slideUp('fast');
						
            $(this).next().find('ul').css( {
              display : 'none'
            } );
          } else {
            $(this).parent().parent().find('ul').slideUp('fast');
            $(this).next().slideDown('fast');
          }
					
        //  return false;
        }
      }
    } );
        
  });
		
  $(window).bind('resize', function () { 
    if ($(this).width() > 540) {
      $('a.resp_navigation').removeClass('active');
				
      $('.sf-menu').removeAttr('style');
      $('.sf-menu ul').removeAttr('style');
    }
  } );
} )(jQuery);