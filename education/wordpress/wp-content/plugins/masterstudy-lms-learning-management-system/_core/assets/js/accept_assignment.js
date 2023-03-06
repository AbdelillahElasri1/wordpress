"use strict";

(function ($) {
  var content;
  $(window).on('load', function () {
    if (typeof tinyMCE !== 'undefined') {
      var editor = tinyMCE.get('assignment_' + stm_lms_user_assignment['assignment_id']);
      content = editor.getContent();
      editor.on('keyup', function (e) {
        content = editor.getContent();
      });
    }
  });
  $('.user_assingment_actions .btn').on('click', function (e) {
    e.preventDefault();
    var $draft = $('.user_assingment_actions');
    if ($draft.hasClass('loading')) return false;
    var status = $(this).hasClass('approve') ? 'approve' : 'reject';
    var formData = new FormData();
    formData.append('content', content);
    formData.append('status', status);
    formData.append('assignment_id', stm_lms_user_assignment['assignment_id']);
    var url = stm_lms_ajaxurl + '?action=stm_lms_edit_user_answer&nonce=' + stm_lms_nonces['stm_lms_edit_user_answer'];
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      context: this,
      processData: false,
      data: formData,
      contentType: false,
      beforeSend: function beforeSend() {
        $draft.addClass('loading');
      },
      complete: function complete() {
        location.reload();
        $draft.removeClass('loading');
      }
    });
  });
})(jQuery);