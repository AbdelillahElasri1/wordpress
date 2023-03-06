Vue.component('curriculum', {
    props: ['curriculum_saved'],
    components: [
        'section_items',
        'curriculum_add_item'
    ],
    data() {
        return {
            loaded : true,
            sections: [],
            onDrag : false,
            loading: false,
            search : false,
            addedItems : [],
            searchItems : [],
        };
    },
    mounted: function () {
        this.getSavedCurriculum()
    },
    methods: {
        startDrag : function() {
            this.onDrag = true;
        },
        endDrag : function() {

            var _this = this;
            _this.onDrag = false;

            _this.sections.forEach(function (section) {
                _this.$set(section, 'hovered', false);
                section.items.forEach(function (item) {
                    _this.$set(item, 'class', '');
                });
            });
        },
        getSavedCurriculum: function () {

            var vm = this;

            var url = stm_wpcfto_ajaxurl + '?action=stm_lms_get_curriculum_v2&ids=' +
                encodeURIComponent(vm.curriculum_saved) +
            '&nonce=' + stm_lms_nonces['stm_lms_get_curriculum_v2'];

            if (typeof stm_lms_manage_course_id !== 'undefined') {
                url += '&course_id=' + stm_lms_manage_course_id;
            }

            vm.isLoading(true);
            this.$http.get(url).then(function (response) {
                vm.$set(vm, 'sections', response.body);
                this.sections.forEach( (section) => {
                    section.title = decodeURIComponent(section.title);
                });
                vm.isLoading(false);
            });

        },
        isLoading(isLoading) {
            this.loading = isLoading;
        },
        addSection() {
            var vm = this;
            vm.sections.push({
                title: '',
                items: [],
                opened: true,
                touched: false,
                editingSectionTitle: true,
                activeTab: 'stm-lessons'
            });

            Vue.nextTick(() => {
                vm.$refs['section_' + (vm.sections.length - 1)][0].focus();
            });
        },
        addSectionTitle(section, section_key) {

            var vm = this;
            this.$set(section, 'editingSectionTitle', false);
            this.$set(section, 'opened', true);
            this.$set(section, 'touched', true);

            Vue.nextTick(function() {
                vm.$refs['section_' + section_key][0].blur();
            });
        },
        openSection(section) {
            this.$set(section, 'opened', !section.opened);
        },
        deleteSection(section_key, message) {
            if (!confirm(message)) return false;
            this.sections.splice(section_key, 1);

            /*For deep watcher*/
            this.sections = this.sections;
        },
        itemChanged(item) {
            var _this = this;

            if(!item.title) return false;

            var url = stm_wpcfto_ajaxurl;
            url += '?action=stm_save_title&nonce=' + stm_lms_nonces['stm_save_title'] + '&title=' + item.title + '&id=' + item.id;

            this.$http.get(url);
        },
        emitMethod(item) {
            WPCFTO_EventBus.$emit('STM_LMS_Curriculum_item', item);
        },
    },
    watch: {
        sections: {
            deep: true,
            handler: function () {
                var value = [];
                this.sections.forEach(function (section) {
                    value.push(encodeURIComponent(section.title));
                    section.items.forEach(function (item) {
                        value.push(item.id);
                        item.title = decodeEntities(item.title);
                    });
                });

                this.$emit('curriculum_changed', value.join(','));
            }
        }
    },
});


Vue.component('section_items', {
    props: ['items'],
    methods : {
        deleteItem(item_key, message) {
            if (!confirm(message)) return false;
            this.items.splice(item_key, 1);
        },
    },
});

var decodeEntities = (function() {
    // this prevents any overhead from creating the object each time
    var element = document.createElement('div');

    function decodeHTMLEntities (str) {
        if(str && typeof str === 'string') {
            // strip script/html tags
            str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
            str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
            element.innerHTML = str;
            str = element.textContent;
            element.textContent = '';
        }

        return str;
    }

    return decodeHTMLEntities;
})();