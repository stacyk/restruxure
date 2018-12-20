<?php
/**
 * Customizer sections.
 *
 * @package restruxure
 */

/**
 * Register the section sections.
 */
function restruxure_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'restruxure_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'restruxure' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register social network section.
	$wp_customize->add_section(
		'restruxure_social_links_section',
		array(
			'title'    => esc_html__( 'Social Networks', 'restruxure' ),
			'priority' => 50,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'restruxure_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'restruxure' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'restruxure_customize_sections' );
