"use strict";

(function ($) {
  /**
   * @var stm_lms_restore_password
   */
  $(document).ready(function () {
    $('.remembered_creds a').on('click', function (e) {
      e.preventDefault();
      $('[id^="stm-lms-login"]').slideToggle();
    });
  });
  /*Workaround for yoast SEO*/

  $(window).load(function () {
    new Vue({
      el: '#stm-lms-reset-password',
      data: {
        token: stm_lms_restore_password['token'],
        password: '',
        status: '',
        message: '',
        loading: false
      },
      created: function created() {
        console.log('created');
      },
      mounted: function mounted() {
        console.log('mounted');
      },
      methods: {
        changePassword: function changePassword() {
          var _this = this;

          if (!_this.token || !_this.password) return false;
          _this.loading = true;

          _this.$http.post(stm_lms_ajaxurl + '?action=stm_lms_restore_password&nonce=' + stm_lms_nonces['stm_lms_restore_password'], {
            token: _this.token,
            password: _this.password
          }).then(function (r) {
            r = r.body;

            _this.$set(_this, 'status', r.status);

            _this.$set(_this, 'message', r.message);

            _this.loading = false;

            if ('success' === r.status) {
              var url = new URL(window.location);
              url.searchParams["delete"]('restore_password');
              location.replace(url);
            }
          });
        }
      }
    });
  });
})(jQuery);