<?php
/**
 * Customizer panels.
 *
 * @package restruxure
 */

/**
 * Add a custom panels to attach sections too.
 */
function restruxure_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel( 'site-options', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Site Options', 'restruxure' ),
		'description'    => esc_html__( 'Other theme options.', 'restruxure' ),
	) );
}
add_action( 'customize_register', 'restruxure_customize_panels' );
