<?php
/**
 * Set up the theme customizer.
 *
 * @package restruxure
 */

/**
 * Include other customizer files.
 */
function restruxure_include_custom_controls() {
	require get_template_directory() . '/inc/customizer/panels.php';
	require get_template_directory() . '/inc/customizer/sections.php';
	require get_template_directory() . '/inc/customizer/settings.php';
	require get_template_directory() . '/inc/customizer/tinymce.php';
}
add_action( 'customize_register', 'restruxure_include_custom_controls', -999 );

/**
 * Enqueue customizer related scripts.
 */
function restruxure_customize_scripts() {
	wp_enqueue_script( 'restruxure-customize-livepreview', get_template_directory_uri() . '/inc/customizer/assets/scripts/livepreview.js', array( 'jquery', 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'restruxure_customize_scripts' );

/**
 * Add support for the fancy new edit icons.
 *
 * @link https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
 */
function restruxure_selective_refresh_support( $wp_customize ) {

	// The <div> classname to append edit icon too.
	$settings = array(
		'blogname'          => '.site-title a',
		'blogdescription'   => '.site-description',
		'restruxure_copyright_text' => '.site-info',
	);

	// Loop through, and add selector partials.
	foreach ( (array) $settings as $setting => $selector ) {
		$args = array( 'selector' => $selector );
		$wp_customize->selective_refresh->add_partial( $setting, $args );
	}
}
add_action( 'customize_register', 'restruxure_selective_refresh_support' );

/**
 * Add live preview support via postMessage.
 *
 * Note: You will need to hook this up via livepreview.js
 *
 * @link https://codex.wordpress.org/Theme_Customization_API#Part_3:_Configure_Live_Preview_.28Optional.29
 */
function restruxure_live_preview_support( $wp_customize ) {

	// Settings to apply live preview to.
	$settings = array(
		'blogname',
		'blogdescription',
		'header_textcolor',
		'background_image',
		'social_icons',
		'restruxure_copyright_text',
	);

	// Loop through and add the live preview to each setting.
	foreach ( (array) $settings as $setting_name ) {

		// Try to get the customizer setting.
		$setting = $wp_customize->get_setting( $setting_name );

		// Skip if it is not an object to avoid notices.
		if ( ! is_object( $setting ) ) {
			continue;
		}

		// Set the transport to avoid page refresh.
		$setting->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'restruxure_live_preview_support', 999 );
