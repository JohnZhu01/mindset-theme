import { SwiperInit } from "./swiper-init";

/**
 * Initialize every testimonial slider on the page.
 */
function initializeTestimonialSliders() {
	const blocks = document.querySelectorAll(
		".wp-block-mindset-blocks-testimonial-slider",
	);

	blocks.forEach((block) => {
		const container = block.querySelector(".swiper");

		if (!container || container.swiper) {
			return;
		}

		let settings = {};

		try {
			settings = JSON.parse(block.dataset.swiperSettings || "{}");
		} catch (error) {
			settings = {};
		}

		SwiperInit(container, settings, block);
	});
}

if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", initializeTestimonialSliders);
} else {
	initializeTestimonialSliders();
}
