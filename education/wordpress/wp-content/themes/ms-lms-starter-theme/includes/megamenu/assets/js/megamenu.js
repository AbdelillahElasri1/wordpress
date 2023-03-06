(function ($) {
    "use strict";

    $(document).ready(function () {
        stretch_child();
    });

    $(window).on( "load", function() {
        stretch_child();
    });

    $(window).on( "resize", function() {
        stretch_child();
    });

    function stretch_child() {
        // Wide
        var $wide = $('.stm_megamenu__wide > ul.sub-menu');
        var windowW = $(document).width();

        if ($wide.length) {
            var $containerWide = $wide.closest('.header_top .container, .top_nav .container');
            var containerWideW = $containerWide.width();

            // -15 due to global style left 15px
            var xPos = ((windowW - containerWideW) / 2 ) - 15;

            $wide.each(function () {

                $(this).css({
                    width: windowW + 'px',
                    'margin-left': '-' + xPos + 'px'
                })
            })
        }

        // Boxed
        var $boxed = $('.stm_megamenu__boxed > ul.sub-menu');
        if ($boxed.length) {
            var $container = $boxed.closest('.header_top .container, .top_nav .container');
            var containerW = $container.width();


            $boxed.each(function () {
                $(this).css({
                    width: containerW + 'px'
                })
            })
        }


        /*GET BG*/
        var $mega_menu = $('.stm_megamenu');
        $mega_menu.each(function(){
            var bg = $(this).find('a[data-megabg]').attr('data-megabg');
            if(typeof bg !== 'undefined') {
                $(this).find(' > ul.sub-menu').css({
                    'background-image' : 'url("' + bg + '")'
                })
            }
        })
    }


})(jQuery);