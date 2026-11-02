<?php

/**
 * Sub Hero Banner
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

if ( ! function_exists( 'mill_district_background_video_embed' ) ) {
	/**
	 * Add muted autoplay parameters to an oEmbed iframe.
	 *
	 * @param string $html oEmbed HTML.
	 * @return string
	 */
	function mill_district_background_video_embed( $html ) {
		if ( ! $html || ! preg_match( '/src="([^"]+)"/', $html, $matches ) ) {
			return $html;
		}

		$src  = html_entity_decode( $matches[1], ENT_QUOTES, 'UTF-8' );
		$host = (string) wp_parse_url( $src, PHP_URL_HOST );

		if ( false !== strpos( $host, 'youtube.com' ) || false !== strpos( $host, 'youtube-nocookie.com' ) ) {
			$path     = (string) wp_parse_url( $src, PHP_URL_PATH );
			$video_id = '';

			if ( preg_match( '#/embed/([^/?]+)#', $path, $id_match ) ) {
				$video_id = $id_match[1];
			}

			$args = array(
				'autoplay'       => '1',
				'mute'           => '1',
				'controls'       => '0',
				'loop'           => '1',
				'playsinline'    => '1',
				'rel'            => '0',
				'modestbranding' => '1',
			);

			if ( $video_id ) {
				$args['playlist'] = $video_id;
			}

			$src = add_query_arg( $args, $src );
		} elseif ( false !== strpos( $host, 'vimeo.com' ) ) {
			$src = add_query_arg(
				array(
					'autoplay'   => '1',
					'muted'      => '1',
					'background' => '1',
					'loop'       => '1',
					'autopause'  => '0',
				),
				$src
			);
		}

		$html = str_replace( $matches[1], esc_url( $src ), $html );
		$html = preg_replace( '/<iframe\b/', '<iframe aria-hidden="true" tabindex="-1"', $html, 1 );

		return $html;
	}
}

$block_id         = isset( $block['id'] ) ? $block['id'] : '';
$heading          = get_field( 'heading' );
$video            = get_field( 'video' );
$background_video = $video ? mill_district_background_video_embed( $video ) : '';

?>
<section id="row-<?php echo esc_attr( $block_id ); ?>" class="sub-hero-banner">
	<?php if ( $background_video ) : ?>
		<div class="sub-hero-banner__video">
			<?php echo $background_video; ?>
		</div>
	<?php endif; ?>

	<?php if ( $heading ) : ?>
		<div class="container-fluid">
			<h1 class="sub-hero-banner__heading"><?php echo wp_kses_post( $heading ); ?></h1>
		</div>
	<?php endif; ?>
</section>
