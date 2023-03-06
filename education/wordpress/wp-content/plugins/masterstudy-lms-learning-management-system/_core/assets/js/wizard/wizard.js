"use strict";

/**
 * @var VueRangeSlider
 */
new Vue({
  /**
   * @var stm_lms_splash_wizard
   */
  el: '#stm_lms_splash_wizard',
  data: {
    pro: stm_lms_splash_wizard['pro'],
    ajax_url: stm_lms_splash_wizard['ajax_url'],
    active_step: 'business',
    steps: stm_lms_splash_wizard['steps'],
    business_type_prev: stm_lms_splash_wizard['business_type'],
    business_type: stm_lms_splash_wizard['business_type'],
    system_pages: {
      user_url: false,
      user_url_profile: false,
      wishlist_url: false,
      checkout_url: false,
      courses_page: false
    },
    all_pages_generate: false,
    course_page_generate: false,
    default_wizard: stm_lms_splash_wizard['settings'],
    wizard: {
      /*General*/
      wocommerce_checkout: false,
      guest_checkout: false,
      author_fee: 10,

      /*Courses*/
      courses_view: 'grid',
      courses_per_page: 9,
      courses_per_row: 4,
      enable_courses_filter: false,

      /*Single course*/
      course_style: 'default',
      redirect_after_purchase: false,
      course_tab_description: true,
      course_tab_curriculum: true,
      course_tab_faq: true,
      course_tab_announcement: true,
      course_tab_reviews: true,

      /*curriculum*/
      lesson_style: 'default',
      quiz_style: 'default',
      allow_upload_video: false,
      course_allow_new_categories: false,

      /*Profiles*/
      register_as_instructor: true,
      disable_instructor_premoderation: true,
      profile_style: 'default'
    },
    loading_system_pages: false
  },
  components: {
    'range-slider': VueRangeSlider
  },
  methods: {
    nextStep: function nextStep() {
      if (!this.canChangeStep()) return false;
      var keys = Object.keys(this.steps);
      var nextIndex = keys.indexOf(this.active_step) + 1;

      if (Object.keys(this.steps).length !== nextIndex) {
        this.active_step = keys[nextIndex];
      }
    },
    prevStep: function prevStep() {
      if (!this.canChangeStep()) return false;
      var keys = Object.keys(this.steps);
      var nextIndex = keys.indexOf(this.active_step) - 1;
      if (nextIndex >= 0) this.active_step = keys[nextIndex];
    },
    changeStep: function changeStep(step) {
      if (!this.canChangeStep()) return false;
      this.active_step = step;
    },
    canChangeStep: function canChangeStep() {
      return this.business_type;
    },
    generatePages: function generatePages(pages) {
      this.loading_system_pages = true;
      this.$http.post("".concat(this.ajax_url, "?action=stm_generate_pages"), pages).then(function (data) {
        var _this = this;

        this.loading_system_pages = false;
        Object.keys(pages).forEach(function (key) {
          _this.$set(_this.system_pages, key, true);
        });
        this.all_pages_generate = true;

        if (this.system_pages.courses_page) {
          this.course_page_generate = true;
        }
      });
    },
    rangeStyles: function rangeStyles(value, min, max) {
      var procent = (max - min) / 100;
      return {
        left: (value - min) * 100 / (max - min) + '%'
      };
    },
    acceptSettings: function acceptSettings() {
      this.$http.post("".concat(this.ajax_url, "?action=stm_lms_wizard_save_settings&nonce=") + stm_lms_nonces['stm_lms_wizard_save_settings'], this.wizard, function () {});
    },
    setDefaultSettings: function setDefaultSettings() {
      for (var key in this.wizard) {
        if (!this.default_wizard.hasOwnProperty(key)) continue;
        this.$set(this.wizard, key, this.default_wizard[key]);
      }
    },
    saveBusinessType: function saveBusinessType() {
      if (this.business_type_prev === this.business_type) return false;
      /*Save to admin*/

      this.$http.post("".concat(this.ajax_url, "?action=stm_lms_wizard_save_business_type&nonce=") + stm_lms_nonces['stm_lms_wizard_save_business_type'], this.business_type, function () {});
      /*Save analytics*/

      this.$http.post("https://panel.stylemixthemes.com/api/quizanswer?quiz=wizard\n                &answer=".concat(this.business_type, "&item_slug=masterstudy"), function (data) {});
      this.business_type_prev = this.business_type;
    },
    setSystemPages: function setSystemPages() {
      for (var key in this.system_pages) {
        if (!this.default_wizard.hasOwnProperty(key)) continue;
        if (!this.default_wizard[key]) continue;
        this.$set(this.system_pages, key, true);
        this.all_pages_generate = true;

        if (this.system_pages.courses_page) {
          this.course_page_generate = true;
        }
      }
    },
    isMarketPlace: function isMarketPlace() {
      return this.business_type === 'marketplace';
    },
    isPro: function isPro() {
      return this.pro;
    },
    resetSettings: function resetSettings() {
      this.setDefaultSettings();
    }
  },
  mounted: function mounted() {
    this.setDefaultSettings();
    this.setSystemPages();
  },
  watch: {
    active_step: function active_step(step) {
      if (step === 'finish') this.acceptSettings();
      if (step !== 'business' && this.business_type) this.saveBusinessType();
    }
  }
});