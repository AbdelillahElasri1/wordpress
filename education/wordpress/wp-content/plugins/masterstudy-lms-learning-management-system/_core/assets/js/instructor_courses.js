"use strict";

(function ($) {
  $(document).ready(function () {
    new Vue({
      el: '#stm-lms-courses-grid',
      data: {
        vue_loaded: true,
        courses: [],
        loading: true,
        offset: 0,
        total: false,
        quota: {}
      },
      created: function created() {
        this.getCourses();
      },
      methods: {
        getCourses: function getCourses() {
          var vm = this;
          var url = stm_lms_ajaxurl + '?action=stm_lms_get_instructor_courses&nonce=' + stm_lms_nonces['stm_lms_get_instructor_courses'] + '&offset=' + vm.offset;
          vm.loading = true;
          this.$http.get(url).then(function (response) {
            response.body['posts'].forEach(function (course) {
              vm.courses.push(course);
            });
            vm.total = response.body['total'];
            vm.loading = false;
            vm.offset++;
            setTimeout(function () {
              stmLmsGoToHash();
            }, 500);
          });
        },
        loadCourses: function loadCourses() {
          this.getCourses();
        },
        changeFeatured: function changeFeatured(course) {
          var vm = this;
          var url = stm_lms_ajaxurl + '?action=stm_lms_change_featured&nonce=' + stm_lms_nonces['stm_lms_change_featured'] + '&post_id=' + course.id;
          this.$set(course, 'changingFeatured', true);
          this.$http.get(url).then(function (response) {
            vm.$set(vm, 'quota', response.body);
            vm.$set(course, 'changingFeatured', false);
            vm.$set(course, 'is_featured', response.body['featured']);
          });
        },
        changeStatus: function changeStatus(course, status) {
          var vm = this;
          var url = "".concat(stm_lms_ajaxurl, "?action=stm_lms_change_course_status&post_id=").concat(course.id, "&status=").concat(status) + '&nonce=' + stm_lms_nonces['stm_lms_change_course_status'];
          vm.$set(course, 'changingStatus', true);
          vm.$http.get(url).then(function (response) {
            vm.$set(course, 'changingStatus', false);
            vm.$set(course, 'status', response.body);
          });
        }
      }
    });
  });
})(jQuery);

function stmLmsGoToHash() {
  var $ = jQuery;
  var hash = window.location.hash;

  if (hash) {
    var $selector = $('.nav-tabs a[href="' + hash + '"]');
    if (!$selector.length) return false;
    $selector.click();
    $([document.documentElement, document.body]).animate({
      scrollTop: $selector.offset().top
    }, 500);
  }
}