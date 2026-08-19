<?php
/**
 * Register PHP-only blocks.
 *
 * @package Mindset_Theme
 */

/**
 * Register the Service Posts block.
 */
function mindset_register_php_blocks() {
	register_block_type(
		'mindset-blocks/service-posts',
		array(
			'title'           => __( 'Service Posts', 'mindset-theme' ),
			'icon'            => 'admin-tools',
			'category'        => 'widgets',
			'description'     => __( 'Displays all published Service posts.', 'mindset-theme' ),
			'keywords'        => array(
				__( 'services', 'mindset-theme' ),
				__( 'service posts', 'mindset-theme' ),
			),
			'render_callback' => 'mindset_render_service_posts',
			'supports'        => array(
				'autoRegister' => true,
			),
		)
	);
}
add_action( 'init', 'mindset_register_php_blocks' );

/**
 * Render all published Service posts.
 *
 * @return string Rendered block markup.
 */
function mindset_render_service_posts($attributes) {
	$service_query = new WP_Query(
		array(
			'post_type'              => 'fwd-service',
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'orderby'                => 'date',
			'order'                  => 'DESC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => 'service-posts',
		)
	);

	if ( ! $service_query->have_posts() ) {
		return sprintf(
			'<div %1$s><p>%2$s</p></div>',
			$wrapper_attributes,
			esc_html__( 'No services found.', 'mindset-theme' )
		);
	}

	ob_start();
	?>
	<div <?php echo $wrapper_attributes; ?>>
		<?php
		while ( $service_query->have_posts() ) {
			$service_query->the_post();
			?>
			<article class="service-post">
				<h2 class="service-post__title">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php echo esc_html( get_the_title() ); ?>
					</a>
				</h2>

				<div class="service-post__content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		}
		?>
	</div>
	<?php

	wp_reset_postdata();

	return ob_get_clean();
}
