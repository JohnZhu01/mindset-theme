<?php
/**
 * Theme setup and front-end assets.
 *
 * @package Mindset_Theme
 */

/**
 * Enqueue the theme's front-end styles and scripts.
 */
function mindset_enqueue_styles() {
	$theme = function_exists( 'wp_get_theme' ) ? wp_get_theme() : null;
	$theme_version = $theme ? $theme->get( 'Version' ) : null;

	wp_enqueue_style( 'mindset-normalize', get_theme_file_uri( 'normalize.css' ), array(), $theme_version );
	wp_enqueue_style( 'mindset-style', get_stylesheet_uri(), array( 'mindset-normalize' ), $theme_version );
	wp_enqueue_script(
		'mindset-scroll-to-top',
		get_theme_file_uri( 'assets/js/scroll-to-top.js' ),
		array(),
		$theme_version,
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
	if ( is_page( 'contact' ) ) {
		wp_enqueue_script(
			'mindset-contact-scroll-color',
			get_theme_file_uri( 'assets/js/contact-scroll-color.js' ),
			array( 'mindset-scroll-to-top' ),
			$theme_version,
			array(
				'strategy' => 'defer',
				'in_footer' => true,
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'mindset_enqueue_styles' );

/**
 * Configure theme features and custom image sizes.
 */
function mindset_setup() {
	add_editor_style( array( 'normalize.css', 'style.css' ) );

	add_image_size( 'portrait-blog', 200, 9999 );
	add_image_size( 'portrait-blog-crop', 200, 250, true );
	add_image_size( '400x500', 400, 500, true );
	add_image_size( '200x250', 200, 250, true );
	add_image_size( '800x400', 800, 400, true );
	add_image_size( '400x200', 400, 200, true );
}
add_action( 'after_setup_theme', 'mindset_setup' );

/**
 * Add custom image sizes to the media library selector.
 *
 * @param array $size_names Registered image size labels.
 * @return array Updated image size labels.
 */
function mindset_add_custom_image_sizes( $size_names ) {
	$new_sizes = array(
		'portrait-blog'      => __( 'Portrait Blog', 'mindset-theme' ),
		'portrait-blog-crop' => __( 'Portrait Blog (Cropped)', 'mindset-theme' ),
		'400x500'            => __( '400 × 500', 'mindset-theme' ),
		'200x250'            => __( '200 × 250', 'mindset-theme' ),
		'800x400'            => __( '800 × 400 (Cropped)', 'mindset-theme' ),
		'400x200'            => __( '400 × 200 (Cropped)', 'mindset-theme' ),
	);

	return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'mindset_add_custom_image_sizes' );
