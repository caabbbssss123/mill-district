<?php

/**
 * Content List
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

$active_index = null;

foreach ( $items as $index => $item ) {
	if ( ! empty( $item['image'] ) ) {
		$active_index = $index;
		break;
	}
}

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="content-list">
	<div class="container-fluid">
		<div class="content-list__inner js-content-list">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php
				$heading = isset( $item['heading'] ) ? $item['heading'] : '';
				$copy    = isset( $item['copy'] ) ? $item['copy'] : '';
				$image   = isset( $item['image'] ) ? $item['image'] : 0;

				if ( $heading === '' && $copy === '' && ! $image ) {
					continue;
				}

				$item_class = 'content-list__item fadeInUp';

				if ( $active_index === $index ) {
					$item_class .= ' is-active';
				}
				?>
				<div class="<?php echo esc_attr( $item_class ); ?>">
					<div class="row">
						<div class="col-lg-3 col-xl-4">
							<?php if ( $heading ) : ?>
								<h3 class="content-list__heading"><?php echo esc_html( $heading ); ?></h3>
							<?php endif; ?>
						</div>

						<div class="col-lg-4 col-xl-5">
							<?php if ( $copy ) : ?>
								<div class="content-list__copy">
									<?php echo wpautop( esc_html( $copy ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<?php if ( $image ) : ?>
						<figure class="content-list__image">
							<?php echo wp_get_attachment_image( $image, 'portrait' ); ?>
						</figure>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
