<?php

/**
 * Editorial Text and Image
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id       = isset( $block['id'] ) ? $block['id'] : '';
$heading        = get_field( 'heading' );
$copy           = get_field( 'copy' );
$cta_link       = get_field( 'cta_link' );
$image          = get_field( 'image' );
$image_position = get_field( 'image_position' );

$classes      = 'editorial-text-and-image';
$text_classes = 'col-lg-5 editorial-text-and-image__text';

if ( 'left' === $image_position ) {
	$classes      .= ' editorial-text-and-image--image-left';
	$text_classes .= ' col-lg-offset-1';
}

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="<?php echo esc_attr( $text_classes ); ?>">
				<?php if ( $heading ) : ?>
					<h2 class="editorial-text-and-image__heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $copy ) : ?>
					<div class="editorial-text-and-image__copy">
						<?php echo wpautop( esc_html( $copy ) ); ?>
					</div>
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
							'class'  => 'btn-primary editorial-text-and-image__cta',
						)
					);
				}
				?>
			</div>

			<div class="col-lg-6 editorial-text-and-image__media">
				<?php if ( $image ) : ?>
					<figure class="editorial-text-and-image__image">
						<?php echo wp_get_attachment_image( $image, 'full' ); ?>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
