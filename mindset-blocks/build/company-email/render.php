<?php
/**
 * Render the company email block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

$company_email = sanitize_email( get_post_meta( 13, 'company_email', true ) );

if ( empty( $company_email ) ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( $attributes['svgIcon'] ?? false ) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="<?php esc_attr_e( 'Email icon', 'company-email' ); ?>">
			<path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
		</svg>
	<?php endif; ?>
	<a href="<?php echo esc_url( 'mailto:' . $company_email ); ?>"><?php echo esc_html( $company_email ); ?></a>
</div>
