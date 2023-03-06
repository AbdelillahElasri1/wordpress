"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

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

var MsLmsCourses = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(MsLmsCourses, _elementorModules$fro);

  var _super = _createSuper(MsLmsCourses);

  function MsLmsCourses() {
    _classCallCheck(this, MsLmsCourses);

    return _super.apply(this, arguments);
  }

  _createClass(MsLmsCourses, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          container: '.ms_lms_courses_archive',
          containerGrid: '.ms_lms_courses_grid',
          sorting: '.ms_lms_courses_archive__sorting',
          sortingGrid: '.ms_lms_courses_grid__sorting',
          sortingSelect: '.ms_lms_courses_archive__sorting_select',
          sortingSelectGrid: '.ms_lms_courses_grid__sorting_select',
          dropdownSelect: '.ms_lms_courses_archive__sorting.style_3',
          dropdownSelectGrid: '.ms_lms_courses_grid__sorting.style_3',
          sortingButton: '.ms_lms_courses_archive__sorting_button',
          sortingButtonGrid: '.ms_lms_courses_grid__sorting_button',
          sortingButtonActive: '.ms_lms_courses_archive__sorting_button.active',
          sortingButtonActiveGrid: '.ms_lms_courses_grid__sorting_button.active',
          filter: '.ms_lms_courses_archive__filter',
          filterTitle: '.ms_lms_courses_archive__filter_options_item_title',
          filterToggle: '.ms_lms_courses_archive__filter_toggle',
          showMoreInstructors: '.ms_lms_courses_archive__filter_options_item_show-instructors',
          filterSubmit: '.ms_lms_courses_archive__filter_actions_button',
          filterReset: '.ms_lms_courses_archive__filter_actions_reset',
          filterForm: '.ms_lms_courses_archive__filter_form',
          paginationItem: '.ms_lms_courses_archive__pagination_list_item',
          paginationItemGrid: '.ms_lms_courses_grid__pagination_list_item',
          paginationContainer: '.ms_lms_courses_archive__pagination_wrapper',
          paginationContainerGrid: '.ms_lms_courses_grid__pagination_wrapper',
          coursesContainer: '.ms_lms_courses_card:not(.featured)'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings('selectors');
      var elementSettings = this.getElementSettings();
      return {
        $container: this.$element.find(selectors.container),
        $containerGrid: this.$element.find(selectors.containerGrid),
        $sorting: this.$element.find(selectors.sorting),
        $sortingGrid: this.$element.find(selectors.sortingGrid),
        $sortingSelect: this.$element.find(selectors.sortingSelect),
        $sortingSelectGrid: this.$element.find(selectors.sortingSelectGrid),
        $dropdownSelect: this.$element.find(selectors.dropdownSelect),
        $dropdownSelectGrid: this.$element.find(selectors.dropdownSelectGrid),
        $sortingButton: this.$element.find(selectors.sortingButton),
        $sortingButtonGrid: this.$element.find(selectors.sortingButtonGrid),
        $sortingButtonActive: this.$element.find(selectors.sortingButtonActive),
        $sortingButtonActiveGrid: this.$element.find(selectors.sortingButtonActiveGrid),
        $filterTitle: this.$element.find(selectors.filterTitle),
        $filterToggle: this.$element.find(selectors.filterToggle),
        $showMoreInstructors: this.$element.find(selectors.showMoreInstructors),
        $filter: this.$element.find(selectors.filter),
        $filterSubmit: this.$element.find(selectors.filterSubmit),
        $filterReset: this.$element.find(selectors.filterReset),
        $filterForm: this.$element.find(selectors.filterForm),
        $paginationItem: this.$element.find(selectors.paginationItem),
        $paginationItemGrid: this.$element.find(selectors.paginationItemGrid),
        $paginationContainer: this.$element.find(selectors.paginationContainer),
        $paginationContainerGrid: this.$element.find(selectors.paginationContainerGrid),
        $coursesContainer: this.$element.find(selectors.coursesContainer),
        $openedFilters: elementSettings['opened_filters'],
        $sortBy: elementSettings['sort_by'],
        $sortByCat: elementSettings['sort_by_cat'],
        $courseCardPresets: elementSettings['course_card_presets'],
        $paginationPresets: elementSettings['pagination_presets'],
        $cardsToShowChoice: elementSettings['cards_to_show_choice'],
        $cardsToShow: elementSettings['cards_to_show'],
        $metaSlots: {
          'card_slot_1': elementSettings['card_slot_1'],
          'card_slot_2': elementSettings['card_slot_2'],
          'card_slot_3': elementSettings['card_slot_3'],
          'popup_slot_1': elementSettings['popup_slot_1'],
          'popup_slot_2': elementSettings['popup_slot_2'],
          'popup_slot_3': elementSettings['popup_slot_3']
        },
        $cardData: {
          'show_popup': elementSettings['show_popup'],
          'show_category': elementSettings['show_category'],
          'show_excerpt': elementSettings['show_excerpt'],
          'show_progress': elementSettings['show_progress'],
          'show_divider': elementSettings['show_divider'],
          'show_rating': elementSettings['show_rating'],
          'show_price': elementSettings['show_price'],
          'show_slots': elementSettings['show_slots'],
          'show_wishlist': elementSettings['show_wishlist'],
          'status_presets': elementSettings['status_presets'],
          'status_position': elementSettings['status_position'],
          'featured_position': elementSettings['featured_position']
        },
        $popupData: {
          'popup_show_author_name': elementSettings['popup_show_author_name'],
          'popup_show_author_image': elementSettings['popup_show_author_image'],
          'popup_show_wishlist': elementSettings['popup_show_wishlist'],
          'popup_show_price': elementSettings['popup_show_price'],
          'popup_show_excerpt': elementSettings['popup_show_excerpt'],
          'popup_show_slots': elementSettings['popup_show_slots']
        }
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.elements.$sortingSelect.on('change', this.onSortingSelectChange.bind(this));
      this.elements.$sortingSelect.select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: this.elements.$dropdownSelect
      });
      this.elements.$sortingSelectGrid.on('change', this.onSortingSelectChangeGrid.bind(this));
      this.elements.$sortingSelectGrid.select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: this.elements.$dropdownSelectGrid
      });
      this.elements.$sortingButton.on('click', this.onSortingButtonClick.bind(this));
      this.elements.$sortingButtonGrid.on('click', this.onSortingButtonClickGrid.bind(this));
      this.elements.$filterTitle.on('click', this.onFilterTitleClick.bind(this));

      if (window.matchMedia('(min-width: 1025px)').matches) {
        if (this.elements.$openedFilters > 0) {
          for (var i = 0; i < this.elements.$openedFilters; i++) {
            this.elements.$filterTitle.eq(i).trigger('click');
          }
        }
      }

      this.elements.$filterToggle.on('click', this.onFilterToggleClick.bind(this));
      this.elements.$showMoreInstructors.on('click', this.onShowMoreInstructorsClick.bind(this));
      this.elements.$filterSubmit.on('click', this.onFilterSubmitClick.bind(this));
      this.elements.$filterReset.on('click', this.onFilterResetClick.bind(this));
      this.elements.$container.on('click', '.ms_lms_courses_archive__no-result_reset', this.onFilterResetClick.bind(this));
      this.elements.$container.on('click', '.ms_lms_courses_archive__pagination_list_item a', this.onPaginationButtonClick.bind(this));
      this.elements.$container.on('click', '.ms_lms_courses_archive__load-more-button', this.onLoadMoreButtonClick.bind(this));
      this.elements.$containerGrid.on('click', '.ms_lms_courses_grid__pagination_list_item a', this.onPaginationButtonClickGrid.bind(this));
      this.elements.$containerGrid.on('click', '.ms_lms_courses_grid__load-more-button', this.onLoadMoreButtonClickGrid.bind(this));
    }
  }, {
    key: "onSortingSelectChange",
    value: function onSortingSelectChange(event) {
      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = jQuery(event.currentTarget).val(),
          args = {};

      if (location.search) {
        args = this.getSearchArgs();
      }

      var current_page = 1;
      this.filtering(sort_by, args, current_page, false);
    }
  }, {
    key: "onSortingSelectChangeGrid",
    value: function onSortingSelectChangeGrid(event) {
      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = jQuery(event.currentTarget).val();
      var current_page = 1;
      this.filteringGrid(sort_by, current_page, false);
    }
  }, {
    key: "onSortingButtonClick",
    value: function onSortingButtonClick(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      jQuery(event.currentTarget).parent().siblings().find('.ms_lms_courses_archive__sorting_button').removeClass('active');
      jQuery(event.currentTarget).addClass('active');
      var sort_by = jQuery(event.currentTarget).data('id'),
          args = {};

      if (location.search) {
        args = this.getSearchArgs();
      }

      var current_page = 1;
      this.filtering(sort_by, args, current_page, false);
    }
  }, {
    key: "onSortingButtonClickGrid",
    value: function onSortingButtonClickGrid(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      jQuery(event.currentTarget).parent().siblings().find('.ms_lms_courses_grid__sorting_button').removeClass('active');
      jQuery(event.currentTarget).addClass('active');
      var sort_by = jQuery(event.currentTarget).data('id');
      var current_page = 1;
      this.filteringGrid(sort_by, current_page, false);
    }
  }, {
    key: "onFilterTitleClick",
    value: function onFilterTitleClick(event) {
      jQuery(event.currentTarget).toggleClass('active').next().slideToggle('medium', function () {
        if (jQuery(event.currentTarget).is(':visible')) {
          jQuery(event.currentTarget).css('display', 'flex');
        }
      });
    }
  }, {
    key: "onFilterToggleClick",
    value: function onFilterToggleClick(event) {
      event.preventDefault();
      this.elements.$filterForm.slideToggle('medium', function () {
        if (jQuery(event.currentTarget).is(':visible')) {
          jQuery(event.currentTarget).css('display', 'flex');
        }
      });
    }
  }, {
    key: "onShowMoreInstructorsClick",
    value: function onShowMoreInstructorsClick(event) {
      var categories = jQuery(event.currentTarget).closest('.ms_lms_courses_archive__filter_options_item_content').find('.ms_lms_courses_archive__filter_options_item_category');
      categories.slideDown('medium', function () {
        if (jQuery(event.currentTarget).is(':visible')) {
          jQuery(event.currentTarget).css('display', 'flex');
        }
      });
      jQuery(event.currentTarget).slideUp();
    }
  }, {
    key: "onFilterSubmitClick",
    value: function onFilterSubmitClick(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = this.getSortArgs();
      var args = this.getFormArgs();
      var current_page = 1;
      this.filtering(sort_by, args, current_page, false);
    }
  }, {
    key: "onFilterResetClick",
    value: function onFilterResetClick(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      history.replaceState({}, '', location.origin + location.pathname);
      location.reload();
    }
  }, {
    key: "onPaginationButtonClick",
    value: function onPaginationButtonClick(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = this.getSortArgs(),
          args = {},
          current_page = parseInt(this.elements.$paginationItem.find('.current').text());

      if (location.search) {
        args = this.getSearchArgs();
      }

      if (!jQuery(event.currentTarget).hasClass('next') && !jQuery(event.currentTarget).hasClass('prev')) {
        jQuery(event.currentTarget).parent().siblings().find('.current').removeClass('current');
        jQuery(event.currentTarget).addClass('current');
        current_page = parseInt(jQuery(event.currentTarget).text());
      } else if (jQuery(event.currentTarget).hasClass('next')) {
        current_page = parseInt(jQuery(event.currentTarget).parent().siblings().find('.current').text());
        current_page++;
      } else if (jQuery(event.currentTarget).hasClass('prev')) {
        current_page = parseInt(jQuery(event.currentTarget).parent().siblings().find('.current').text());
        current_page--;
      }

      this.filtering(sort_by, args, current_page, false);
    }
  }, {
    key: "onPaginationButtonClickGrid",
    value: function onPaginationButtonClickGrid(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = this.getSortArgsGrid(),
          current_page = parseInt(this.elements.$paginationItemGrid.find('.current').text());

      if (!jQuery(event.currentTarget).hasClass('next') && !jQuery(event.currentTarget).hasClass('prev')) {
        jQuery(event.currentTarget).parent().siblings().find('.current').removeClass('current');
        jQuery(event.currentTarget).addClass('current');
        current_page = parseInt(jQuery(event.currentTarget).text());
      } else if (jQuery(event.currentTarget).hasClass('next')) {
        current_page = parseInt(jQuery(event.currentTarget).parent().siblings().find('.current').text());
        current_page++;
      } else if (jQuery(event.currentTarget).hasClass('prev')) {
        current_page = parseInt(jQuery(event.currentTarget).parent().siblings().find('.current').text());
        current_page--;
      }

      this.filteringGrid(sort_by, current_page, false);
    }
  }, {
    key: "onLoadMoreButtonClick",
    value: function onLoadMoreButtonClick(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = this.getSortArgs(),
          args = {};

      if (location.search) {
        args = this.getSearchArgs();
      }

      var offset = parseInt(jQuery(event.currentTarget).data('offset'));
      this.filtering(sort_by, args, 1, offset);
    }
  }, {
    key: "onLoadMoreButtonClickGrid",
    value: function onLoadMoreButtonClickGrid(event) {
      event.preventDefault();

      if (typeof edit_mode !== 'undefined') {
        return;
      }

      var sort_by = this.getSortArgsGrid();
      var offset = parseInt(jQuery(event.currentTarget).data('offset'));
      this.filteringGrid(sort_by, 1, offset);
    }
  }, {
    key: "getSortArgs",
    value: function getSortArgs() {
      if (this.elements.$sortingSelect.length) {
        return this.elements.$sortingSelect.val();
      } else if (this.elements.$sortingButton.length) {
        return this.elements.$sorting.find('.active').data('id');
      }

      return this.elements.$sortBy;
    }
  }, {
    key: "getSortArgsGrid",
    value: function getSortArgsGrid() {
      if (this.elements.$sortingSelectGrid.length) {
        return this.elements.$sortingSelectGrid.val();
      } else if (this.elements.$sortingButtonGrid.length) {
        return this.elements.$sortingGrid.find('.active').data('id');
      }

      return this.elements.$sortBy;
    }
  }, {
    key: "getFormArgs",
    value: function getFormArgs() {
      if (this.elements.$filter.length) {
        var values = this.elements.$filterForm.serializeArray();
        var args = {
          'terms': [],
          'meta_query': {
            'status': [],
            'level': [],
            'instructor': [],
            'price': [],
            'rating': 0
          }
        };
        values.forEach(function (element) {
          if (element['name'] === 'rating') {
            args['meta_query']['rating'] = element['value'];
          } else if (element['name'] === 'category[]' || element['name'] === 'subcategory[]') {
            args['terms'].push(element['value']);
          } else {
            var index = element['name'].slice(0, -2);
            args['meta_query'][index].push(element['value']);
          }
        });
        return args;
      }

      return {};
    }
  }, {
    key: "getSearchArgs",
    value: function getSearchArgs() {
      if (location.search) {
        var args = {
          'terms': [],
          's': '',
          'meta_query': {
            'status': [],
            'level': [],
            'instructor': [],
            'price': [],
            'rating': 0
          }
        };
        var queryString = new URLSearchParams(location.search.split('?')[1]);

        var _iterator = _createForOfIteratorHelper(queryString.entries()),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var item = _step.value;

            // if elementor preview mode
            if (item[0] === 'preview' || item[0] === 'preview_nonce' || item[0] === 'preview_id') {
              continue;
            } else {
              if (item[0] === 'rating') {
                args['meta_query']['rating'] = item[1];
              } else if (item[0] === 'terms[]') {
                args['terms'].push(item[1]);
              } else if (item[0] === 'search') {
                args['s'] = item[1];
              } else if (item[0] !== 'sort' && item[0] !== 'current_page') {
                var index = item[0].slice(0, -2);
                args['meta_query'][index].push(item[1]);
              }
            }
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }

        return args;
      }

      return {};
    }
  }, {
    key: "filtering",
    value: function filtering(sort_by, args, page, offset) {
      var courses_container = this.elements.$coursesContainer,
          pagination_container = this.elements.$paginationContainer,
          scroll_container = this.elements.$container,
          filter_button = this.elements.$filterSubmit,
          filter_form = this.elements.$filterForm;
      this.urlAddParams(sort_by, args, page);
      jQuery.ajax({
        url: ms_lms_courses_archive_filter.ajax_url,
        type: 'post',
        dataType: 'json',
        data: {
          action: 'ms_lms_courses_archive_filter',
          card_template: this.elements.$courseCardPresets,
          pagination_template: this.elements.$paginationPresets,
          args: args,
          current_page: page,
          offset: offset,
          sort_by: sort_by,
          cards_to_show_choice: this.elements.$cardsToShowChoice,
          cards_to_show: this.elements.$cardsToShow,
          meta_slots: this.elements.$metaSlots,
          card_data: this.elements.$cardData,
          popup_data: this.elements.$popupData,
          nonce: ms_lms_courses_archive_filter.nonce
        },
        beforeSend: function beforeSend() {
          courses_container.addClass('loading');

          if (filter_button.length) {
            filter_button.addClass('loading').attr('disabled', true);
          }
        },
        success: function success(data) {
          if (!offset) {
            courses_container.empty();

            if (window.matchMedia('(max-width: 1024px)').matches && filter_form.is(':visible')) {
              scroll_container = courses_container;
            }

            jQuery('html, body').animate({
              scrollTop: scroll_container.offset().top
            }, 500);
          }

          pagination_container.empty();

          if (data.cards) {
            courses_container.append(data.cards);

            if (data.pagination) {
              pagination_container.append(data.pagination);
            }
          } else if (data.no_found) {
            courses_container.append(data.no_found);
          }

          courses_container.removeClass('loading');

          if (filter_button.length) {
            filter_button.removeClass('loading').attr('disabled', false);
          }
        }
      });
    }
  }, {
    key: "filteringGrid",
    value: function filteringGrid(sort_by, page, offset) {
      var courses_container = this.elements.$coursesContainer,
          pagination_container = this.elements.$paginationContainerGrid,
          scroll_container = this.elements.$containerGrid;
      jQuery.ajax({
        url: ms_lms_courses_archive_filter.ajax_url,
        type: 'post',
        dataType: 'json',
        data: {
          action: 'ms_lms_courses_grid_sorting',
          card_template: this.elements.$courseCardPresets,
          pagination_template: this.elements.$paginationPresets,
          current_page: page,
          offset: offset,
          sort_by: sort_by,
          sort_by_cat: this.elements.$sortByCat,
          sort_by_default: this.elements.$sortBy,
          cards_to_show_choice: this.elements.$cardsToShowChoice,
          cards_to_show: this.elements.$cardsToShow,
          meta_slots: this.elements.$metaSlots,
          card_data: this.elements.$cardData,
          popup_data: this.elements.$popupData,
          nonce: ms_lms_courses_archive_filter.nonce
        },
        beforeSend: function beforeSend() {
          courses_container.addClass('loading');
        },
        success: function success(data) {
          if (!offset) {
            courses_container.find('.ms_lms_courses_card_item:not(.featured)').remove();
            jQuery('html, body').animate({
              scrollTop: scroll_container.offset().top
            }, 500);
          }

          pagination_container.empty();

          if (data.cards) {
            courses_container.append(data.cards);

            if (data.pagination) {
              pagination_container.append(data.pagination);
            }
          }

          courses_container.removeClass('loading');
        }
      });
    }
  }, {
    key: "urlAddParams",
    value: function urlAddParams(sort_by, args, page) {
      var searchParams = new URLSearchParams();

      if (args['terms']) {
        args['terms'].forEach(function (value) {
          searchParams.append('terms[]', value);
        });
      }

      if (args['s']) {
        searchParams.append('search', args['s']);
      }

      if (args['meta_query']) {
        var _loop = function _loop() {
          var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
              key = _Object$entries$_i[0],
              value = _Object$entries$_i[1];

          if (value.length > 0) {
            if (key !== 'rating') {
              value.forEach(function (param) {
                searchParams.append(key + '[]', param);
                {}
              });
            } else {
              searchParams.append(key, value);
            }
          }
        };

        for (var _i = 0, _Object$entries = Object.entries(args['meta_query']); _i < _Object$entries.length; _i++) {
          _loop();
        }
      }

      searchParams.append('sort', sort_by);
      searchParams.append('current_page', page);
      history.pushState({}, null, location.origin + location.pathname + '?' + searchParams.toString());
    }
  }]);

  return MsLmsCourses;
}(elementorModules.frontend.handlers.Base);

jQuery(window).on('elementor/frontend/init', function () {
  var addHandler = function addHandler($element) {
    elementorFrontend.elementsHandler.addHandler(MsLmsCourses, {
      $element: $element
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/ms_lms_courses.default', addHandler);
});