class StmLmsProTestimonials extends elementorModules.frontend.handlers.SwiperBase {

	getDefaultSettings() {
		return {
			selectors: {
				carousel: '.swiper-container',
				slideContent: '.swiper-slide'
			}
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings('selectors');
		const elements = {
			$swiperContainer: this.$element.find(selectors.carousel)
		};
		elements.$slides = elements.$swiperContainer.find(selectors.slideContent);
		return elements;
	}

	getSwiperSettings() {
		return {
			pagination: {
				el: '.ms-lms-elementor-testimonials-swiper-pagination',
				clickable: true,
				renderBullet: function (index, className) {

					var userThumbnail = '';
					var testimonialItem = jQuery('.elementor-testimonials-carousel').children().eq(index);
					if (testimonialItem.length > 0) {
						userThumbnail = testimonialItem.attr('data-thumbnail');
					}
					var span = jQuery('<span></span>');
					span.addClass(className);
					span.css("background-image", "url(" + userThumbnail + ")");
					return span.prop('outerHTML');

				},
			},
		};
	}

	async onInit(...args) {
		super.onInit(...args);
		const elementSettings = this.getElementSettings();

		if (!this.elements.$swiperContainer.length || 2 > this.elements.$slides.length) {
			return;
		}

		const Swiper = elementorFrontend.utils.swiper;
		this.swiper = await new Swiper(this.elements.$swiperContainer, this.getSwiperSettings()); // Expose the swiper instance in the frontend

		this.elements.$swiperContainer.data('swiper', this.swiper);

		if ('yes' === elementSettings.pause_on_hover) {
			this.togglePauseOnHover(true);
		}
	}

	updateSwiperOption(propertyName) {
		const elementSettings = this.getElementSettings(),
			newSettingValue = elementSettings[propertyName],
			params = this.swiper.params; // Handle special cases where the value to update is not the value that the Swiper library accepts.

		switch (propertyName) {
			case 'space_between':
				params.spaceBetween = newSettingValue.size || 0;
				break;

			case 'autoplay_speed':
				params.autoplay.delay = newSettingValue;
				break;

			case 'speed':
				params.speed = newSettingValue;
				break;
		}

		this.swiper.update();
	}  getChangeableProperties() {
		return {
			pause_on_hover: 'pauseOnHover',
			autoplay_speed: 'delay',
			speed: 'speed',
			space_between: 'spaceBetween'
		};
	}

	onElementChange(propertyName) {
		const changeableProperties = this.getChangeableProperties();

		if (changeableProperties[propertyName]) {
			// 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library.
			if ('pause_on_hover' === propertyName) {
				const newSettingValue = this.getElementSettings('pause_on_hover');
				this.togglePauseOnHover('yes' === newSettingValue);
			} else {
				this.updateSwiperOption(propertyName);
			}
		}
	}

	onEditSettingsChange(propertyName) {
		if ('activeItemIndex' === propertyName) {
			this.swiper.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
		}
	}
}

jQuery(window).on('elementor/frontend/init', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(StmLmsProTestimonials, {
			$element,
		});
	};
	elementorFrontend.hooks.addAction('frontend/element_ready/stm_lms_pro_testimonials.default', addHandler);
});