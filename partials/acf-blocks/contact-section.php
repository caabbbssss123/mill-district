<?php

/**
 * Contact Section
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id               = isset( $block['id'] ) ? $block['id'] : '';
$heading                = get_field( 'heading' );
$form_heading           = get_field( 'form_heading' );
$gravity_form_shortcode = get_field( 'gravity_form_shortcode' );
$form_description       = get_field( 'form_description' );
$image                  = get_field( 'image' );

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="contact-section">
	<div class="container-fluid">
		<div class="contact-section__inner">
			<div class="row">
				<div class="col-lg-4">
					<?php if ( $heading ) : ?>
						<h2 class="contact-section__heading fadeInLeft"><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>
				</div>

				<div class="col-lg-5">
					<?php if ( $form_heading ) : ?>
						<p class="contact-section__form-heading fadeInUp"><?php echo esc_html( $form_heading ); ?></p>
					<?php endif; ?>

					<?php if ( $gravity_form_shortcode ) : ?>
						<div class="contact-section__form fadeInUp delayShort" id="register">
							<?php echo do_shortcode( $gravity_form_shortcode ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $form_description ) : ?>
						<p class="contact-section__form-description fadeIn delayShort"><?php echo esc_html( $form_description ); ?></p>
					<?php endif; ?>
				</div>

				<div class="col-lg-3">
					<?php if ( $image ) : ?>
						<figure class="contact-section__image slideInRight">
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
						</figure>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
