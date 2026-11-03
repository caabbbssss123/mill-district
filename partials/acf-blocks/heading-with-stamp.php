<?php

/**
 * Heading with Stamp
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$heading  = get_field( 'heading' );
$stamp    = get_field( 'stamp' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="heading-with-stamp">
	<div class="container-fluid">
		<div class="heading-with-stamp__inner">
			<?php if ( $heading ) : ?>
				<h2 class="heading-with-stamp__heading fadeInLeft"><?php echo $heading; ?></h2>
			<?php endif; ?>

			<?php if ( $stamp ) : ?>
				<figure class="heading-with-stamp__stamp scaleIn delayShort">
					<?php echo wp_get_attachment_image( $stamp, 'medium' ); ?>
				</figure>
			<?php endif; ?>
		</div>
	</div>
</section>
