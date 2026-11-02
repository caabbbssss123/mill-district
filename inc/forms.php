<?php

/* ==========================================================================
   Gravity Forms Functions
   ========================================================================== */

update_option( 'rg_gforms_disable_css', '__return_true' );
update_option( 'rg_gforms_enable_html5', '__return_true' );

add_filter( 'gform_disable_css', '__return_true' );
add_filter( 'gform_disable_form_legacy_css', '__return_true' );
add_filter( 'gform_disable_form_theme_css', '__return_true' );

add_filter( 'gform_tabindex', '__return_false' );
add_filter( 'gform_confirmation_anchor', '__return_false' );

add_filter( 'gform_plugin_settings_fields', function ( $fields ) {
    
    unset( $fields['license_key'] );
    unset( $fields['license_key_details'] );
    unset( $fields['css'] );
    unset( $fields['default_theme'] );
    unset( $fields['no_conflict_mode'] );
    unset( $fields['html5'] );
  
    return $fields;
});

// add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
    return THEME_DIR . '/assets/img/svg/gf-spinner.svg';
}

/*
 * Clear Gravity Forms theme
 */
function coord_form_theme( $form ) {

    $form['theme'] = 'custom';

    return $form;
}
add_filter( 'gform_pre_render', 'coord_form_theme' );

/*
 * Change required field indicator to asterisk
 */
add_filter( 'gform_get_form_filter', function ( $form_string, $form ) {
    $form_string = str_replace( '<span class="gfield_required gfield_required_text">(Required)</span>', '<span class="gfield_required gfield_required_asterisk">*</span>', $form_string );
    return $form_string;
}, 10, 2 );

/**
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    @$dom->loadHTML( $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);

    // Newer Gravity Forms versions may already output <button> — nothing to convert.
    if ( ! $input ) {
        return $button;
    }

    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );
 
    return $dom->saveHtml( $new_button );
}
// Turn off autocomplete for date fields
add_filter( 'gform_field_content', 'gform_form_input_autocomplete', 11, 5 ); 
function gform_form_input_autocomplete( $input, $field, $value, $lead_id, $form_id ) {
	if ( is_admin() ) return $input;
	if ( $field->type == 'date' ) {
		$input = preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input ); 
	}
	return $input;
}

// Gravity Forms Custom Addresses (Australia)
add_filter('gform_address_types', 'australian_address', 10, 2);

function australian_address( $address_types, $form_id ) {
    $address_types['australia'] = array(
    'label'       =>   'Australia', //labels the dropdown
    'country'     =>   'Australia', //sets Australia as default country
    'zip_label'   =>   'Postcode', //what it says
    'state_label' =>   'State', //as above
    'states' => array( 
        '', 
        'Australian Capital Territory',
        'New South Wales',
        'Northern Territory',
        'Queensland',
        'South Australia',
        'Tasmania', 
		'Victoria',
        'Western Australia'
        )
    );
    return $address_types;
}

add_filter( 'gform_form_args', function ( $args ) {
    $args['submission_method'] = GFFormDisplay::SUBMISSION_METHOD_AJAX;

    $args['ajax'] = true;

    return $args;
} );