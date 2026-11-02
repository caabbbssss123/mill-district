<?php

/**
 * Centered Content with CTA
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$heading  = get_field( 'heading' );
$copy     = get_field( 'copy' );
$ctas     = get_field( 'ctas' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="centered-content-with-cta">
	<div class="container-fluid">
		<?php if ( $heading ) : ?>
			<h2 class="centered-content-with-cta__heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $copy ) : ?>
			<div class="centered-content-with-cta__copy">
				<?php echo wpautop( esc_html( $copy ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $ctas ) : ?>
			<div class="centered-content-with-cta__ctas">
				<?php
				foreach ( $ctas as $cta ) {
					$link = isset( $cta['link'] ) ? $cta['link'] : null;

					if ( ! is_array( $link ) || empty( $link['url'] ) ) {
						continue;
					}

					get_template_part(
						'partials/components/button',
						null,
						array(
							'url'    => $link['url'],
							'title'  => isset( $link['title'] ) ? $link['title'] : '',
							'target' => isset( $link['target'] ) ? $link['target'] : '',
							'class'  => 'btn-primary',
						)
					);
				}
				?>
			</div>
		<?php endif; ?>
	</div>
</section>
