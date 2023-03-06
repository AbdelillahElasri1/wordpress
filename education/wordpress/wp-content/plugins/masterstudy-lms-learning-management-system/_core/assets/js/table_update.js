"use strict";

(function ($) {
  $(document).ready(function () {
    var $wrapper = $('.notice-lms-update-db');
    $wrapper.find('a').on('click', function (e) {
      e.preventDefault();
      var $this = $(this);
      $wrapper.addClass('loading');
      var nonce = stm_lms_nonces['stm_lms_tables_update'];
      $.ajax({
        url: $wrapper.data('ajax') + '?action=stm_lms_tables_update&nonce=' + nonce,
        type: 'POST',
        processData: false,
        contentType: false,
        success: function success() {
          $wrapper.remove();
        }
      });
    });
  });
})(jQuery);