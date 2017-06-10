(function($){
    
jQuery.fn.AjaxForm = function() {

  this.on('beforeSubmit',function(){
      var form = $(this);
   
      $.ajax({
          url: form.attr('action'),
          type: 'post',
          dataType: 'json',
          data: form.serialize(),
          success: function ($response) {
              if( $response.result )
              {
                    form.html( $response.html );   
              }
              else
              {
                  
              }
          }
     });
      
      return false;
  })

};
    
})(jQuery)