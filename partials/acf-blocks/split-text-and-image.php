<?php

/**
 * Split Text and Image
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$heading  = get_field( 'heading' );
$copy     = get_field( 'copy' );
$image    = get_field( 'image' );
$stamp    = get_field( 'stamp' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="split-text-and-image">
	<div class="container-fluid">
		<div class="row">
			<div class="col col-left">
				<?php if ( $heading ) : ?>
					<h2 class="split-text-and-image__heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $copy ) : ?>
					<div class="split-text-and-image__copy">
						<?php echo wpautop( esc_html( $copy ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-6 col-right">
				<div class="split-text-and-image__media">
					<div class="split-text-and-image__frame">
							<div class="split-text-and-image__image">
								<?php echo wp_get_attachment_image( $image, 'full' ); ?>
								<?php if ( $stamp ) : ?>
									<div class="split-text-and-image__stamp">
										<?php echo wp_get_attachment_image( $stamp, 'full' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</section>
