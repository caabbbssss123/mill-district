<?php
/**
 * Modify editor
 *
 * @package The Mill District
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_theme_support( 'align-wide' );
add_theme_support('editor-styles');

add_action( 'admin_init', 'mill_district_theme_add_editor_styles' );
function mill_district_theme_add_editor_styles() {
	add_editor_style( [
		'https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
		'/assets/css/foundation.xy.css',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
		'/assets/css/app.css',
		'/assets/css/colour-variations.css',
		'/assets/css/theme.css',
		'/assets/css/gutenberg-reset.css',
	] );
}

add_filter( 'mce_css', 'mill_district_dequeue_theme_styles_on_wysiwyg_editor' );
function mill_district_dequeue_theme_styles_on_wysiwyg_editor( $css )
{
	$css_arr = explode(',', $css);

	foreach($css_arr as $key => $url) {
		if (strpos($url, 'foundation.xy.css') !== false) {
			unset($css_arr[$key]);
		}

		if (strpos($url, 'swiper-bundle.min.css') !== false) {
			unset($css_arr[$key]);
		}

		if (strpos($url, 'app.css') !== false) {
			unset($css_arr[$key]);
		}

		if (strpos($url, 'colour-variations.css') !== false) {
			unset($css_arr[$key]);
		}

		if (strpos($url, 'theme.css') !== false) {
			unset($css_arr[$key]);
		}

		if (strpos($url, 'fonts.googleapis.com') !== false) {
			unset($css_arr[$key]);
		}
	}

	return implode(',', $css_arr);
}