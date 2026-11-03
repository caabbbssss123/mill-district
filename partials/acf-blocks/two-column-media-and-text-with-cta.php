<?php

/**
 * Two Column Media and Text with CTA
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id    = isset( $block['id'] ) ? $block['id'] : '';
$large_image = get_field( 'large_image' );
$small_image = get_field( 'small_image' );
$copy        = get_field( 'copy' );
$large_copy  = get_field( 'large_copy' );
$cta_link    = get_field( 'cta_link' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="two-column-media-and-text-with-cta">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-5 col-left">
				<?php if ( $large_image ) : ?>
					<figure class="two-column-media-and-text-with-cta__large slideInLeft">
						<?php echo wp_get_attachment_image( $large_image, 'large' ); ?>
					</figure>
				<?php endif; ?>

				<?php if ( $small_image ) : ?>
					<figure class="two-column-media-and-text-with-cta__small fadeInUp delayShort">
						<?php echo wp_get_attachment_image( $small_image, 'medium' ); ?>
					</figure>
				<?php endif; ?>
			</div>

			<div class="col-lg-5 col-lg-offset-1 col-right">
				<?php if ( $copy ) : ?>
					<div class="two-column-media-and-text-with-cta__copy fadeInRight">
						<?php echo wp_kses_post( $copy ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $large_copy ) : ?>
					<p class="two-column-media-and-text-with-cta__large-copy fadeInUp"><?php echo nl2br( esc_html( $large_copy ) ); ?></p>
				<?php endif; ?>

				<?php
				if ( is_array( $cta_link ) && ! empty( $cta_link['url'] ) ) {
					get_template_part(
						'partials/components/button',
						null,
						array(
							'url'    => $cta_link['url'],
							'title'  => isset( $cta_link['title'] ) ? $cta_link['title'] : '',
							'target' => isset( $cta_link['target'] ) ? $cta_link['target'] : '',
							'class'  => 'btn-primary fadeInUp delayShort',
						)
					);
				}
				?>
			</div>
		</div>
	</div>
</section>
