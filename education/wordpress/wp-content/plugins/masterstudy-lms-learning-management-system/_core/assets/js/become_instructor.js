"use strict";

(function ($) {
  $(document).ready(function () {
    stm_lms_become_instructor(true);
  });
})(jQuery);

function stm_lms_become_instructor() {
  var $ = jQuery;
  $('.stm-lms-become-instructor:not(.loaded)').each(function () {
    $(this).addClass('loaded');
    new Vue({
      el: this,
      data: function data() {
        return {
          loading: false,
          degree: '',
          degree_filled: true,
          expertize: '',
          expertize_filled: true,
          message: '',
          status: '',
          additionalFields: []
        };
      },
      mounted: function mounted() {
        if (typeof window.becomeInstructorFormFields !== 'undefined') {
          this.additionalFields = window.becomeInstructorFormFields;
        }
      },
      methods: {
        isChecked: function isChecked(choice, index, id) {
          var value;

          if (typeof this.additionalFields[index] !== 'undefined') {
            value = typeof this.additionalFields[index].value !== 'undefined' ? this.additionalFields[index].value : '';
          }

          if (value) {
            splitValue = value.split(', ');

            if (splitValue.indexOf(choice) > -1) {
              return true;
            }
          }

          return value;
        },
        checkboxChange: function checkboxChange(event, index, choice) {
          var _this = this;

          var checked = event.target.checked;

          if (typeof _this.additionalFields[index] !== 'undefined') {
            var value = typeof _this.additionalFields[index].value !== 'undefined' ? _this.additionalFields[index].value : '';
            value = value.split(', ');
            var choiceIndex = value.indexOf(choice);

            if (!checked) {
              if (choiceIndex > -1) {
                value.splice(choiceIndex, 1);
              }
            } else {
              if (choiceIndex < 0) {
                value.push(choice);
              }
            }

            var filtered = value.filter(function (el) {
              return el != '';
            });
            value = filtered.join(', ');

            _this.$set(_this.additionalFields[index], 'value', value);
          }
        },
        send: function send() {
          var vm = this;
          vm.loading = true;
          vm.message = '';
          var data;
          var fields;

          if (vm.additionalFields.length > 0) {
            data = vm.additionalFields;
            fields = 'custom';
          } else {
            fields = 'default';
            data = {
              'degree': vm.degree,
              'expertize': vm.expertize
            };
          }

          vm.degree_filled = vm.degree !== '';
          vm.expertize_filled = vm.expertize !== '';
          this.$http.post(stm_lms_ajaxurl + '?action=stm_lms_become_instructor&fields=' + fields + '&nonce=' + stm_lms_nonces['stm_lms_become_instructor'], data).then(function (response) {
            vm.message = response.body['message'];
            vm.status = response.body['status'];
            vm.loading = false;
          });
        },
        loadImage: function loadImage(index) {
          var vm = this;

          if (typeof vm.additionalFields[index] !== 'undefined' && vm.$refs['file-' + index][0].files[0]) {
            var fileToUpload = vm.$refs['file-' + index][0].files[0];
            var extensions = typeof vm.additionalFields[index].extensions !== 'undefined' ? vm.additionalFields[index].extensions : '';
            vm.loading = true;

            if (fileToUpload) {
              var formData = new FormData();
              formData.append('file', fileToUpload);
              formData.append('extensions', extensions);
              formData.append('action', 'stm_lms_upload_form_file');
              formData.append('nonce', stm_lms_nonces['stm_lms_upload_form_file']);
              vm.$http.post(stm_lms_ajaxurl, formData).then(function (res) {
                if (typeof res['body'].url !== 'undefined') {
                  vm.$set(vm.additionalFields[index], 'value', res['body'].url);
                  vm.loading = false;
                }
              });
            }
          }
        }
      }
    });
  });
}