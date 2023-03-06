"use strict";

(function ($) {
  $(document).ready(function () {
    $('body').on('click', '.stm-lms-course__sidebar_toggle', function () {
      $('body').toggleClass('lesson-sidebar-opened');
    });
    $('.stm-lesson_sidebar__close, .stm-lms-course__overlay').on('click', function () {
      $('body').removeClass('lesson-sidebar-opened');
    });
  });
})(jQuery);