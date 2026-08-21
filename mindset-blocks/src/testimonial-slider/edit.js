/**
 * Imports.
 */
import { __ } from "@wordpress/i18n";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, PanelRow, ToggleControl } from "@wordpress/components";

/**
 * Export.
 */
export default function Edit({ attributes, setAttributes }) {
	const { navigation, pagination } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Settings", "testimonial-slider")}>
					<PanelRow>
						<ToggleControl
							label={__("Navigation", "testimonial-slider")}
							checked={navigation}
							onChange={(value) => setAttributes({ navigation: value })}
							help={__(
								"Display arrows so users can navigate forward and backward.",
								"testimonial-slider",
							)}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label={__("Pagination", "testimonial-slider")}
							checked={pagination}
							onChange={(value) => setAttributes({ pagination: value })}
							help={__(
								"Display dots so users can navigate to any slide.",
								"testimonial-slider",
							)}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps()}>
				<div classNameName="swiper swiper-initialized swiper-horizontal swiper-autoheight swiper-backface-hidden">
					<div classNameName="swiper-wrapper">
						<div classNameName="swiper-slide">
							<figure className="wp-block-pullquote">
								<blockquote>
									<p>
										This is a placeholder that will be replaced with your actual
										Testimonial posts on the front-end.
									</p>
									<cite>Their Name</cite>
								</blockquote>
							</figure>
						</div>
					</div>
				</div>
				{pagination && (
					<>
						<div className="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
							<span className="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
							<span className="swiper-pagination-bullet"></span>
							<span className="swiper-pagination-bullet"></span>
							<span className="swiper-pagination-bullet"></span>
						</div>
					</>
				)}
				{navigation && (
					<>
						<div classNameName="swiper-button-prev">
							<svg
								classNameName="swiper-navigation-icon"
								width="11"
								height="20"
								viewBox="0 0 11 20"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z"
									fill="currentColor"
								></path>
							</svg>
						</div>
						<div classNameName="swiper-button-next">
							<svg
								classNameName="swiper-navigation-icon"
								width="11"
								height="20"
								viewBox="0 0 11 20"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z"
									fill="currentColor"
								></path>
							</svg>
						</div>
					</>
				)}
			</div>
		</>
	);
}
