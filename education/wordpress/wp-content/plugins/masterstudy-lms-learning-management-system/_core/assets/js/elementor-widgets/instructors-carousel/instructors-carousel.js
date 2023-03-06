"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var MsLmsInstructorsCarousel = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(MsLmsInstructorsCarousel, _elementorModules$fro);

  var _super = _createSuper(MsLmsInstructorsCarousel);

  function MsLmsInstructorsCarousel() {
    _classCallCheck(this, MsLmsInstructorsCarousel);

    return _super.apply(this, arguments);
  }

  _createClass(MsLmsInstructorsCarousel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          container: '.ms_lms_instructors_carousel',
          carousel: '.ms_lms_instructors_carousel__content',
          slideContent: '.swiper-slide',
          prevButton: '.ms_lms_instructors_carousel__navigation_prev',
          nextButton: '.ms_lms_instructors_carousel__navigation_next'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings('selectors');
      var elements = {
        $WidgetContainer: this.$element.find(selectors.container),
        $swiperContainer: this.$element.find(selectors.carousel)
      };
      elements.$slides = elements.$swiperContainer.find(selectors.slideContent);
      return elements;
    }
  }, {
    key: "getSwiperSettings",
    value: function getSwiperSettings() {
      var selectors = this.getSettings('selectors');
      var elementSettings = this.getElementSettings();
      var settings = {
        slidesPerView: elementSettings['slides_per_view'],
        slidesPerGroup: elementSettings['slides_to_scroll'],
        breakpoints: {
          1025: {
            slidesPerView: elementSettings['slides_per_view'],
            slidesPerGroup: elementSettings['slides_to_scroll']
          },
          768: {
            slidesPerView: elementSettings['slides_per_view_tablet'],
            slidesPerGroup: elementSettings['slides_to_scroll_tablet']
          },
          360: {
            slidesPerView: elementSettings['slides_per_view_mobile'],
            slidesPerGroup: elementSettings['slides_to_scroll_mobile']
          }
        },
        loop: elementSettings['loop'],
        navigation: {
          nextEl: this.elements.$WidgetContainer.find(selectors.nextButton),
          prevEl: this.elements.$WidgetContainer.find(selectors.prevButton)
        }
      };

      if (elementSettings['autoplay'] && elementSettings['autoplay'].length > 0) {
        settings.autoplay = {
          delay: elementSettings['autoplay'],
          disableOnInteraction: true,
          pauseOnMouseEnter: true
        };
      } else {
        delete settings.autoplay;
      }

      return settings;
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _this = this;

      elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
      var asyncSwiper = elementorFrontend.utils.swiper;
      new asyncSwiper(this.elements.$swiperContainer, this.getSwiperSettings()).then(function (newSwiperInstance) {
        _this.swiper = newSwiperInstance;
      });
      this.elements.$swiperContainer.data('swiper', this.swiper);
    }
  }, {
    key: "onElementChange",
    value: function onElementChange(propertyName) {
      var elementSettings = this.getElementSettings(),
          newSettingValue = elementSettings[propertyName],
          params = this.swiper.params;

      switch (propertyName) {
        case 'slides_per_view':
          params.breakpoints[1025][slidesPerView] = newSettingValue;
          break;

        case 'slides_per_view_tablet':
          params.breakpoints[768][slidesPerView] = newSettingValue;
          break;

        case 'slides_per_view_mobile':
          params.breakpoints[360][slidesPerView] = newSettingValue;
          break;

        case 'autoplay':
          if (newSettingValue.length > 0) {
            params.autoplay.delay = newSettingValue;
          } else {
            delete params.autoplay;
          }

          break;

        case 'loop':
          params.loop = newSettingValue;
          break;
      }

      this.swiper.update();
    }
  }]);

  return MsLmsInstructorsCarousel;
}(elementorModules.frontend.handlers.Base);

jQuery(window).on('elementor/frontend/init', function () {
  var addHandler = function addHandler($element) {
    elementorFrontend.elementsHandler.addHandler(MsLmsInstructorsCarousel, {
      $element: $element
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/ms_lms_instructors_carousel.default', addHandler);
});