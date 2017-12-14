(function ($) {
  $(document).ready(function($) {
    var imageUrl;
    $("body").on("click", "a.pr-img-select-image-btn", function(e) {
      e.preventDefault();
      var this_btn = $(this);      
      var image = wp.media({
          title: 'Upload Image',
        }).open()
        .on('select', function(e) {
          var uploaded_image = image.state().get('selection').first();
          var imageUrl = uploaded_image.toJSON().url;
          this_btn.closest('div').find('.pr-img-field').val(imageUrl).trigger( 'change' );          
        });
    });
  });

 $(document).on( 'ready widget-updated widget-added', function() {
    $('.services-block-head').toggle(function() {
      $(this).next().slideDown(500);
      $(this).find('span.service-plus').css("display","none");
      $(this).find('span.service-minus').css("display","block");
      },function(){
      $(this).next().slideUp(500);
      $(this).find('span.service-plus').css("display","block");
      $(this).find('span.service-minus').css("display","none");
    });

    $('.widget-block-head').toggle(function() {
      $(this).next().slideDown(500);
      $(this).find('span.widget-plus').css("display","none");
      $(this).find('span.widget-minus').css("display","block");
      },function(){
      $(this).next().slideUp(500);
      $(this).find('span.widget-plus').css("display","block");
      $(this).find('span.widget-minus').css("display","none");
    });
});
})(this.jQuery);


