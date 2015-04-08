(function($) {

  var tpj = jQuery;
  tpj.noConflict();

  $(document).ready(function(){
    
    $('.form-submit').addClass('button green');
    $('.portfolio-grid .item-4').removeClass('col4').addClass('col2');
    $('#nav li a.active').parent('li').addClass('current');
        
  });

})(jQuery);
