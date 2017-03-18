<?php
/**
 * Customizer settings.
 *
 * @package yoga
 */

/**
 * Register additional scripts.
 */
function yoga_customize_additional_scripts( $wp_customize ) {

	// Register a setting.
	$wp_customize->add_setting(
		'yoga_header_scripts',
		array(
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		'yoga_header_scripts',
		array(
			'label'       => esc_html__( 'Header Scripts', 'yoga' ),
			'description' => esc_html__( 'Additional scripts to add to the header. Basic HTML tags are allowed.', 'yoga' ),
			'section'     => 'yoga_additional_scripts_section',
			'type'        => 'textarea',
		)
	);

	// Register a setting.
	$wp_customize->add_setting(
		'yoga_footer_scripts',
		array(
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		'yoga_footer_scripts',
		array(
			'label'       => esc_html__( 'Footer Scripts', 'yoga' ),
			'description' => esc_html__( 'Additional scripts to add to the footer. Basic HTML tags are allowed.', 'yoga' ),
			'section'     => 'yoga_additional_scripts_section',
			'type'        => 'textarea',
		)
	);
}
add_action( 'customize_register', 'yoga_customize_additional_scripts' );

/**
 * Register a social icons setting.
 */
function yoga_customize_social_icons( $wp_customize ) {

	// Create an array of our social links for ease of setup.
	$social_networks = array( 'facebook', 'googleplus', 'instagram', 'linkedin', 'twitter' );

	// Loop through our networks to setup our fields.
	foreach ( $social_networks as $network ) {

		// Register a setting.
		$wp_customize->add_setting(
			'yoga_' . $network . '_link',
			array(
				'default' => '',
				'sanitize_callback' => 'esc_url',
	        )
	    );

	    // Create the setting field.
	    $wp_customize->add_control(
	        'yoga_' . $network . '_link',
	        array(
	            'label'   => sprintf( esc_html__( '%s Link', 'yoga' ), ucwords( $network ) ),
	            'section' => 'yoga_social_links_section',
	            'type'    => 'text',
	        )
	    );
	}
}
add_action( 'customize_register', 'yoga_customize_social_icons' );

/**
 * Register copyright text setting.
 */
function yoga_customize_copyright_text( $wp_customize ) {

	// Register a setting.
	$wp_customize->add_setting(
		'yoga_copyright_text',
		array(
			'default' => '',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		new yoga_Text_Editor_Custom_Control(
			$wp_customize,
			'yoga_copyright_text',
			array(
				'label'       => esc_html__( 'Copyright Text', 'yoga' ),
				'description' => esc_html__( 'The copyright text will be displayed in the footer. Basic HTML tags allowed.', 'yoga' ),
				'section'     => 'yoga_footer_section',
				'type'        => 'textarea',
			)
		)
	);
}
add_action( 'customize_register', 'yoga_customize_copyright_text' );
