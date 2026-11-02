<?php

/**
 * Two Column Label and Text
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$label    = get_field( 'label' );
$copy     = get_field( 'copy' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="two-column-label-and-text">
	<div class="container-fluid">
		<div class="two-column-label-and-text__inner">
			<div class="row">
				<div class="col-md-4">
					<?php if ( $label ) : ?>
						<p class="two-column-label-and-text__label"><?php echo esc_html( $label ); ?></p>
					<?php endif; ?>
				</div>

				<div class="col-md-7">
					<?php if ( $copy ) : ?>
						<div class="two-column-label-and-text__copy">
							<?php echo wpautop( esc_html( $copy ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
