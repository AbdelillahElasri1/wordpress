"use strict";

(function ($) {
  $(document).ready(function () {
    stm_nav_toggle();
  });
  $(window).on('load', function () {
    $('.ms_lms_loader_bg_starter').delay(1200).fadeToggle();
  });

  var stm_nav_toggle = function stm_nav_toggle() {
    $('.mobile-switcher').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).toggleClass('active');
      $(this).parent().toggleClass('active').find('.navigation-menu').toggleClass('active');
    });
    $('.menu-overlay').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).parent().find('.mobile-switcher').removeClass('active');
      $(this).parent().toggleClass('active').find('.menu').toggleClass('active');
    });
    $('.mobile-switcher .menu>li.menu-item-has-children').on('click', function () {
      var $this = $(this);

      if ($this.hasClass('active_sub_menu')) {
        $this.removeClass('active_sub_menu');
      } else {
        $('.navigation-menu .menu>li.menu-item-has-children').removeClass('active_sub_menu');
        $this.toggleClass('active_sub_menu');
        $this.parent().find('li .inner').slideUp(350);
      }
    });
  };
})(jQuery);