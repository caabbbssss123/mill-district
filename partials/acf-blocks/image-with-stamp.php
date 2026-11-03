<?php

/**
 * Image with Stamp
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$image    = get_field( 'image' );
$stamp    = get_field( 'stamp' );
$stamp_id = is_array( $stamp ) ? ( $stamp['ID'] ?? 0 ) : $stamp;

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="image-with-stamp">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4">
				<?php if ( $stamp_id ) : ?>
					<figure class="image-with-stamp__stamp fadeInDown delayShort">
						<?php echo wp_get_attachment_image( $stamp_id, 'medium' ); ?>
					</figure>
				<?php endif; ?>
			</div>

			<div class="col-lg-7">
				<?php if ( $image ) : ?>
					<figure class="image-with-stamp__image slideInRight">
						<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
