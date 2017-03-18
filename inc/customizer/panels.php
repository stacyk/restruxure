<?php
/**
 * Customizer panels.
 *
 * @package yoga
 */

/**
 * Add a custom panels to attach sections too.
 */
function yoga_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel( 'site-options', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Site Options', 'yoga' ),
		'description'    => esc_html__( 'Other theme options.', 'yoga' ),
	) );
}
add_action( 'customize_register', 'yoga_customize_panels' );
