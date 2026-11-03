<?php

/**
 * Content Carousel
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$heading  = get_field( 'heading' );
$items    = get_field( 'items' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="content-carousel">
	<div class="container-fluid">
		<?php if ( $heading ) : ?>
			<h2 class="content-carousel__heading fadeInLeft"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<div class="swiper content-carousel__slider js-content-carousel fadeIn delayShort">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : ?>
						<?php
						$image = isset( $item['image'] ) ? $item['image'] : 0;
						$title = isset( $item['heading'] ) ? $item['heading'] : '';
						$copy  = isset( $item['copy'] ) ? $item['copy'] : '';
						?>
						<div class="swiper-slide">
							<article class="content-carousel__item">
								<?php if ( $image ) : ?>
									<figure class="content-carousel__media">
										<?php echo wp_get_attachment_image( $image, 'large' ); ?>
									</figure>
								<?php endif; ?>

								<?php if ( $title ) : ?>
									<h3 class="content-carousel__title"><?php echo esc_html( $title ); ?></h3>
								<?php endif; ?>

								<?php if ( $copy ) : ?>
									<p class="content-carousel__copy"><?php echo nl2br( esc_html( $copy ) ); ?></p>
								<?php endif; ?>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="content-carousel__pagination swiper-pagination fadeIn delayShort"></div>
		<?php endif; ?>
	</div>
</section>
