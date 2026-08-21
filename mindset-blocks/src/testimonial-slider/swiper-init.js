import Swiper from "swiper/bundle";

/**
 * Initialize one testimonial slider.
 *
 * @param {Element} container Slider element.
 * @param {Object}  options   Slider settings.
 * @param {Element} block     Slider block wrapper.
 *
 * @return {Swiper} Swiper instance.
 */
export function SwiperInit(container, options = {}, block = container) {
	const nextButton = block.querySelector(".swiper-button-next");
	const previousButton = block.querySelector(".swiper-button-prev");
	const pagination = block.querySelector(".swiper-pagination");

	const parameters = {
		loop: true,
		autoHeight: true,
		slidesPerView: 1,
		spaceBetween: 10,
		breakpoints: {
			800: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
		},
		navigation:
			options.navigation && nextButton && previousButton
				? {
						nextEl: nextButton,
						prevEl: previousButton,
					}
				: false,
		pagination:
			options.pagination && pagination
				? {
						el: pagination,
						clickable: true,
					}
				: false,
	};

	return new Swiper(container, parameters);
}
