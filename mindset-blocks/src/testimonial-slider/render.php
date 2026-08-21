<?php
/**
 * Render the testimonial slider block on the front end.
 *
 * @package Mindset_Theme
 */

$swiper_settings = array(
	'pagination' => !empty($attributes['pagination']),
	'navigation' => !empty($attributes['navigation']),
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'data-swiper-settings' => wp_json_encode($swiper_settings),
	)
);
?>
<div <?php echo $wrapper_attributes; ?>>
	
	<?php
	$args  = array(
		'post_type'      => 'fwd-testimonial',
		'posts_per_page' => -1,
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		?>
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="swiper-slide">
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php if ( ! empty( $attributes['pagination'] ) ) : ?>
			<div class="swiper-pagination"></div>
		<?php endif; ?>

		<?php if ( ! empty( $attributes['navigation'] ) ) : ?>
	<button
	type="button"
	class="swiper-button-prev"
	aria-label="<?php esc_attr_e('Previous testimonial', 'testimonial-slider'); ?>"></button>
	<button type="button" class="swiper-button-next"
		aria-label="<?php esc_attr_e('Next testimonial', 'testimonial-slider'); ?>"></button>
		<?php endif; ?>
		<?php
		wp_reset_postdata();
	endif;
	?>
</div>
