<?php
/**
 * Render the testimonial slider block on the front end.
 *
 * @package Mindset_Theme
 */

$swiper_settings = array(
	'pagination' => ! empty( $attributes['pagination'] ),
	'navigation' => ! empty( $attributes['navigation'] ),
);
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<script>
		const swiper_settings = <?php echo wp_json_encode( $swiper_settings ); ?>;
	</script>
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
			<button class="swiper-button-prev"></button>
			<button class="swiper-button-next"></button>
		<?php endif; ?>
		<?php
		wp_reset_postdata();
	endif;
	?>
</div>
