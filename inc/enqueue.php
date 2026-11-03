<?php

/* ==========================================================================
   Enqueue CSS and JS
   ========================================================================== */

function mill_district_asset_version( $relative_path ) {
	$path = get_template_directory() . $relative_path;

	if ( file_exists( $path ) ) {
		return (string) filemtime( $path );
	}

	return '1';
}

// ENQUEUE STYLES  
function enqueue_styles() {  

	/** REGISTER foundation **/  
	wp_register_style( 'foundation', THEME_DIR . '/assets/css/foundation.xy.css', array(), mill_district_asset_version( '/assets/css/foundation.xy.css' ), 'all' );  
	wp_enqueue_style( 'foundation' );

	/** REGISTER Fonts **/  
	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap', array(), null, 'all' );  
	wp_enqueue_style( 'google-fonts' );
	
	/** REGISTER swiper **/  
	wp_register_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '1', 'all' );  
	wp_enqueue_style( 'swiper' );	

	/** REGISTER app **/  
	wp_register_style( 'app', THEME_DIR . '/assets/css/app.css', array(), mill_district_asset_version( '/assets/css/app.css' ), 'all' );  
	// wp_enqueue_style( 'app' );
	
	/** REGISTER colour-variations **/  
	wp_register_style( 'colour-variations', THEME_DIR . '/assets/css/colour-variations.css', array(), mill_district_asset_version( '/assets/css/colour-variations.css' ), 'all' );  
	wp_enqueue_style( 'colour-variations' );

	/** REGISTER theme **/  
	wp_register_style( 'theme', THEME_DIR . '/assets/css/theme.css', array( 'google-fonts' ), mill_district_asset_version( '/assets/css/theme.css' ), 'all' );  
	wp_enqueue_style( 'theme' );

}  
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

function mill_district_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'mill_district_resource_hints', 10, 2 );

// ENQUEUE SCRIPTS  
function enqueue_scripts() {  

	/*
	 * REGISTER Modernizr
	 * This is only neccessary if we need to account for older browsers
	 */  
	//wp_register_script( 'modernizr', THEME_DIR . '/assets/js/vendor/modernizr-3.6.0.min.js', array(), '3.6.0', false );  
	//wp_enqueue_script( 'modernizr' );

	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script( 'jquery', THEME_DIR . '/assets/js/vendor/jquery-3.6.1.min.js', array(), '3.6.1', false );
		wp_enqueue_script('jquery');
	}

	/** REGISTER Migrate **/  
	wp_register_script( 'migrate', THEME_DIR . '/assets/js/vendor/jquery-migrate-3.0.1.min.js', array('jquery'), '3.0.1', true );  
	wp_enqueue_script( 'migrate' );

	/*
	 * REGISTER Icon Font
	 * https://fontawesome.com/icons
	 */  
	wp_register_script( 'icons', 'https://kit.fontawesome.com/29b58b9908.js', array(), '1', true );  
	wp_enqueue_script( 'icons' );

	/** REGISTER what-input **/  
	//wp_register_script( 'what-input', THEME_DIR . '/assets/js/vendor/what-input.js', array('jquery'), '1', true );  
	//wp_enqueue_script( 'what-input' );
	
	/** REGISTER Google Maps API **/  	
	wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_MAPS_API_KEY.'&callback=googleMapsLoaded', array(), '1', false ); // change key on launch
	wp_enqueue_script( 'google-maps' );
	wp_add_inline_script( 'google-maps', 'function googleMapsLoaded() { console.log("Google Maps loaded successfully.") }', 'before' );
	
	/** REGISTER Polyfill.io **/  
	wp_register_script( 'polyfill', 'https://cdn.polyfill.io/v3/polyfill.min.js', array('jquery'), '1', true );  
	wp_enqueue_script( 'polyfill' );

	/** REGISTER swiper **/  
	wp_register_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), '1', true );  
	wp_enqueue_script( 'swiper' );
	
	/** REGISTER plugins **/  
	wp_register_script( 'plugins', THEME_DIR . '/assets/js/plugins.js', array('jquery'), mill_district_asset_version( '/assets/js/plugins.js' ), true );  
	wp_enqueue_script( 'plugins' );

	/** REGISTER app **/  
	wp_register_script( 'app', THEME_DIR . '/assets/js/app.js', array('jquery'), mill_district_asset_version( '/assets/js/app.js' ), true );  
	wp_enqueue_script( 'app' );

	/** REGISTER theme **/  
	wp_register_script( 'theme', THEME_DIR . '/assets/js/theme.js', array('jquery'), mill_district_asset_version( '/assets/js/theme.js' ), true );  
	wp_enqueue_script( 'theme' );
	
	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
	//after wp_enqueue_script
	wp_localize_script( 'app', 'themeurl', $translation_array );

}   
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

// function sc_admin_scripts() {  
// 	wp_register_script( 'icons', 'https://kit.fontawesome.com/29b58b9908.js', array(), '1', true );  
// 	wp_enqueue_script( 'icons' );

// 	wp_register_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), '1', true );  
// 	wp_enqueue_script( 'swiper' );

// 	wp_register_script( 'app', THEME_DIR . '/assets/js/app.js', array('jquery'), '1', true );  
// 	wp_enqueue_script( 'app' );
// }
add_action( 'enqueue_block_assets', 'enqueue_scripts' );