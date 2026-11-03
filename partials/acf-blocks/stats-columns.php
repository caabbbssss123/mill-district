<?php

/**
 * Stats Columns
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
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="stats-columns">
	<div class="container-fluid">
		<?php if ( $heading ) : ?>
			<h2 class="stats-columns__heading fadeIn"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php
		$stat_items = array();

		if ( $items ) {
			foreach ( $items as $item ) {
				$prefix = isset( $item['prefix'] ) ? $item['prefix'] : '';
				$suffix = isset( $item['suffix'] ) ? $item['suffix'] : '';
				$number = isset( $item['number'] ) ? $item['number'] : '';
				$copy   = isset( $item['copy'] ) ? $item['copy'] : '';

				if ( $prefix === '' && $suffix === '' && $number === '' && $copy === '' ) {
					continue;
				}

				$stat_items[] = $item;
			}
		}

		$stat_total = count( $stat_items );
		?>

		<?php if ( $stat_total ) : ?>
			<div class="stats-columns__items staggerUp">
				<?php foreach ( $stat_items as $index => $item ) : ?>
					<?php
					$prefix = isset( $item['prefix'] ) ? $item['prefix'] : '';
					$suffix = isset( $item['suffix'] ) ? $item['suffix'] : '';
					$number = isset( $item['number'] ) ? $item['number'] : '';
					$copy   = isset( $item['copy'] ) ? $item['copy'] : '';
					?>
					<div class="stats-columns__item">
						<?php if ( $prefix !== '' || $number !== '' || $suffix !== '' ) : ?>
							<p class="stats-columns__stat"><?php
							if ( $prefix !== '' ) {
								echo '<span class="stats-columns__prefix">' . $prefix . '</span>';
							}
							if ( $number !== '' ) {
								echo '<span class="stats-columns__number js-stat-number" data-value="' . esc_attr( $number ) . '">' . $number . '</span>';
							}
							if ( $suffix !== '' ) {
								echo '<span class="stats-columns__suffix">' . $suffix . '</span>';
							}
							?></p>
						<?php endif; ?>

						<?php if ( $copy !== '' ) : ?>
							<p class="stats-columns__copy"><?php echo $copy; ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
