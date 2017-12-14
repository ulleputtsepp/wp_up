
  (function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");
    });


    /* menu hover */
    var limit = 767;
    var window_width = window.innerWidth;
    if(window_width>limit){
        $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeIn("slow");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");                
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeOut("slow");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");                
        });
    }    


    $(document).ready(function () {

        /*-- First item as active --*/
        $('.testimonial-section').find('.item').first().addClass('active');

        $('ul.nav a').each(function() {
            $(this).attr('data-scroll', '');
        });

        $('.content-inner ul.nav a').each(function() {
            $(this).removeAttr('data-scroll', '');
        });

        /*-- making height 100% --*/
        var clientHeight = $( window ).height();
        $('.cover-home').css('height', clientHeight);

        var clientHeight = $( window ).height();
        $('.cover-testimonial').css('height', clientHeight);

        /*-- Smooth Scroll --*/
        smoothScroll.init({
            speed: 1500, // Integer. How fast to complete the scroll in milliseconds
            easing: 'easeInOutCubic', // Easing pattern to use
            updateURL: true, // Boolean. Whether or not to update the URL with the anchor hash on scroll
            offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
            callbackBefore: function (toggle, anchor) { }, // Function to run before scrolling
            callbackAfter: function (toggle, anchor) { } // Function to run after scrolling
        });

        /*-- Slider --*/
        $('.slider').flexslider({
            animation: "fade",
            slideshow: true,
            directionNav:false,
            controlNav: true,
            animationSpeed: 1500
        });
        $('.slider .slides li').css('height', $(window).height());         

        /*-- Portfolio --*/
        if (Modernizr.touch) {
            // show the close overlay button
            $(".close-overlay").removeClass("hidden");
            // handle the adding of hover class when clicked
            $(".pfolio-img").click(function (e) {
                if (!$(this).hasClass("hover")) {
                    $(this).addClass("hover");
                }
            });
            // handle the closing of the overlay
            $(".close-overlay").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                if ($(this).closest(".pfolio-img").hasClass("hover")) {
                    $(this).closest(".pfolio-img").removeClass("hover");
                }
            });
        } else {
            // handle the mouseenter functionality
            $(".pfolio-img").mouseenter(function () {
                $(this).addClass("hover");
            })
            // handle the mouseleave functionality
            .mouseleave(function () {
                $(this).removeClass("hover");
            });
        }
        
        /*-- isotope portfolio --*/
        if (jQuery.isFunction(jQuery.fn.isotope)) {
            jQuery('.portfolio-list').isotope({
                itemSelector: '.list_item',
                layoutMode: 'fitRows',
                animationEngine: 'jquery'
            });

            /* -- filtering -- */
            jQuery('#filter li').click(function () {
                var $this = jQuery(this);
                if ($this.hasClass('selected')) {
                    return false;
                } else {
                    jQuery('#filter .selected').removeClass('selected');
                    var selector = $this.attr('data-filter');
                    $this.parent().next().isotope({ filter: selector });
                    $this.addClass('selected');
                    return false;
                }
            });
        }

        /*-- Scroll Event --*/
        var goScrolling = function (elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
            var elemTop = elem.offset().top;
            var elemBottom = elemTop + elem.height();
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        };
        
        /*-- Button Up --*/
        var btnUp = $('<div/>', { 'class': 'btntoTop' });
        btnUp.appendTo('body');
        $(document)
        .on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });

        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');

            scroll = $(window).scrollTop();
            if (scroll >= 200) {            
                $('#logo-alt').css({'display': 'block'});
                $('#logo').css({'display': 'none'});
                $('.custom-logo-link').css({'display': 'none'});
            }
            else {            
                $('#logo-alt').css({'display': 'none'});
                $('#logo').css({'display': 'block'});
                $('.custom-logo-link').css({'display': 'block'});
            }
        });

        /*-- wow js initialize --*/
        new WOW().init();

        /*-- Progress Bars --*/
        $('.progress_skill .bar').data('width', $(this).width()).css({
            width : 0,
            height:0
        });
        $(window).scroll(function() {
            $('.progress_skill .bar').each(function() {
                if (goScrolling($(this))) {
                    $(this).css({
                        width : $(this).attr('data-value') + '%',
                        height : $(this).attr('data-height') + '%'
                    });
                }
            });
        });

        /*-- Owl Carousel --*/
        $('.owl-carousel').owlCarousel({
            autoplay:true,
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false,
                    loop:true
                },
                500:{
                    items:2,
                    nav:false,
                    loop:true
                },
                600:{
                    items:3,
                    nav:false,
                    loop:true
                },
                1000:{
                    items:6,
                    nav:false,
                    loop:true
                }
            }
        })

        /*-- Counters --*/
        var timer = $('.timer');  
        timer.appear(function () {
            timer.countTo();
        }) 

        /*-- Magnific Popup --*/
        $('.image-popup-link').magnificPopup({
            type: 'image',
            closeOnBgClick: true,
            fixedContentPos: false,              
        }); 

        $('.video-popup-link').magnificPopup({
            type: 'iframe',
            closeOnBgClick: true,
            fixedContentPos: false,              
        }); 


        $(window).scroll(function(e){ 
          var $el = $('.scroll-fix'); 
          var isPositionFixed = ($el.css('position') == 'fixed');
          if ($(this).scrollTop() > 200 && !isPositionFixed){ 
            $('#navigation').addClass('scroll-fix');
            $('.scroll-fix').css({'position': 'fixed', 'top': '0px','transition':'0.2s'}); 
           
          }
          if ($(this).scrollTop() < 200 && isPositionFixed)
          {
            $('#navigation').removeClass('scroll-fix');
            $('#navigation').css({'position': 'inherit','transition':'0.2s'}); 
            $('.home #navigation').css({'position': 'absolute','transition':'0.2s'}); 
            
          } 
        });      

    });    

})(this.jQuery);