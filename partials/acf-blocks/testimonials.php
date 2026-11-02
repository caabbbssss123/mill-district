<?php

/**
 * Testimonials
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$items    = get_field( 'items' );

if ( ! is_array( $items ) ) {
	$items = array();
}

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="testimonials">
	<div class="container-fluid">
		<?php if ( $items ) : ?>
			<div class="testimonials__items">
				<?php foreach ( $items as $item ) : ?>
					<?php
					$testimonial = isset( $item['testimonial'] ) ? $item['testimonial'] : '';
					$name        = isset( $item['name'] ) ? $item['name'] : '';
					$company     = isset( $item['company'] ) ? $item['company'] : '';

					if ( $testimonial === '' && $name === '' && $company === '' ) {
						continue;
					}
					?>
					<div class="testimonials__item">
						<?php if ( $testimonial !== '' ) : ?>
							<p class="testimonials__quote"><?php echo nl2br( esc_html( $testimonial ) ); ?></p>
						<?php endif; ?>

						<?php if ( $name !== '' ) : ?>
							<p class="testimonials__name"><?php echo esc_html( $name ); ?></p>
						<?php endif; ?>

						<?php if ( $company !== '' ) : ?>
							<p class="testimonials__company"><?php echo esc_html( $company ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
