<?php
/**
 * Customizer sections.
 *
 * @package yoga
 */

/**
 * Register the section sections.
 */
function yoga_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'yoga_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'yoga' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'yoga_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'yoga' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'yoga_customize_sections' );
