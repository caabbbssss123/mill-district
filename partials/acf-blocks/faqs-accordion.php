<?php

/**
 * FAQs Accordion
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = isset( $block['id'] ) ? $block['id'] : '';
$heading  = get_field( 'heading' );
$items    = get_field( 'items' );

if ( ! is_array( $items ) ) {
	$items = array();
}

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="faqs-accordion">
	<div class="container-fluid">
		<div class="faqs-accordion__inner js-faqs-accordion">
			<div class="row">
				<div class="col-md-4">
					<?php if ( $heading ) : ?>
						<h2 class="faqs-accordion__heading"><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>
				</div>

				<div class="col-lg-7 col-md-8">
					<?php if ( $items ) : ?>
						<div class="faqs-accordion__items">
							<?php foreach ( $items as $index => $item ) : ?>
								<?php
								$question = isset( $item['question'] ) ? $item['question'] : '';
								$answer   = isset( $item['answer'] ) ? $item['answer'] : '';

								if ( $question === '' && $answer === '' ) {
									continue;
								}

								$answer_id = $block_id . '-faq-' . $index;
								?>
								<div class="faqs-accordion__item">
									<button
										type="button"
										class="faqs-accordion__question"
										aria-expanded="false"
										<?php if ( $answer !== '' ) : ?>
											aria-controls="<?php echo esc_attr( $answer_id ); ?>"
										<?php endif; ?>
									>
										<span class="faqs-accordion__question-text"><?php echo esc_html( $question ); ?></span>
										<span class="faqs-accordion__toggle" aria-hidden="true"></span>
									</button>

									<?php if ( $answer !== '' ) : ?>
										<div id="<?php echo esc_attr( $answer_id ); ?>" class="faqs-accordion__answer" role="region" aria-hidden="true">
											<div class="faqs-accordion__answer-inner">
												<?php echo wpautop( $answer ); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
