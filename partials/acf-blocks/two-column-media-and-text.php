<?php

/**
 * Two Column Media and Text
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id    = isset( $block['id'] ) ? $block['id'] : '';
$copy        = get_field( 'copy' );
$large_image = get_field( 'large_image' );
$small_image = get_field( 'small_image' );
$stamp_image = get_field( 'stamp_image' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="two-column-media-and-text">
	<div class="container-fluid">
		<div class="row">
			<div class="col col-left">
				<?php if ( $copy ) : ?>
					<div class="two-column-media__copy">
						<?php echo nl2br( esc_html( $copy ) ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $small_image || $stamp_image ) : ?>
					<div class="two-column-media__aside">
						<?php if ( $small_image ) : ?>
							<figure class="two-column-media__small">
								<?php echo wp_get_attachment_image( $small_image, 'large' ); ?>
							</figure>
						<?php endif; ?>

						<?php if ( $stamp_image ) : ?>
							<figure class="two-column-media__stamp">
								<?php echo wp_get_attachment_image( $stamp_image, 'medium' ); ?>
							</figure>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-6 col-right">
				<?php if ( $large_image ) : ?>
					<figure class="two-column-media__feature">
						<?php echo wp_get_attachment_image( $large_image, 'large' ); ?>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
