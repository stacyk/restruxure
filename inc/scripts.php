<?php
/**
 * Custom scripts and styles.
 *
 * @package yoga
 */

/**
 * Register Google font.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function yoga_font_url() {

	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by the following, translate this to 'off'. Do not translate
	 * into your own language.
	 */

	$nunito = _x( 'on', 'Nunito font: on or off', 'yoga' );
	$martel = _x( 'on', 'Martel font: on or off', 'yoga' );
	$rasa = _x( 'on', 'Rasa font: on or off', 'yoga' );

	if ( 'off' !== $nunito ||
			 'off' !== $martel ||
			 'off' !== $rasa ) {
		$font_families = array();


		if ( 'off' !== $nunito ) {
			$font_families[] = 'Nunito:300,400,900';
		}

		if ( 'off' !== $martel ) {
			$font_families[] = 'Martel:400,900';
		}

		if ( 'off' !== $rasa ) {
			$font_families[] = 'Rasa:400,700,400i,700i';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function yoga_scripts() {
	/**
	 * If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
	 */
	$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ) || ( isset( $_GET['script_debug'] ) ) ? true : false;

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = '0.0.3';

	/**
	 * Should we load minified files?
	 */
	$suffix = ( true === $debug ) ? '' : '.min';

	// Register styles.
	wp_register_style( 'yoga-google-font', yoga_font_url(), array(), null );

	// Enqueue styles.
	wp_enqueue_style( 'yoga-google-font' );
	wp_enqueue_style( 'yoga-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', array(), $version );


	// Dequeue anspress plugin styles.
	wp_dequeue_style( 'anspress-main' );
	wp_deregister_style( 'anspress-main' );

	// Enqueue scripts.
	wp_enqueue_script( 'yoga-scripts', get_template_directory_uri() . '/assets/scripts/project' . $suffix . '.js', array( 'jquery' ), $version, true );

	wp_enqueue_script( 'yoga-sidebar', get_template_directory_uri() . '/assets/scripts/classie.js', array( 'jquery' ), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue the mobile nav script
	// Since we're showing/hiding based on CSS and wp_is_mobile is wp_is_imperfect, enqueue this everywhere.
	wp_enqueue_script( 'yoga-mobile-nav', get_template_directory_uri() . '/assets/scripts/mobile-nav-menu' . $suffix . '.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'yoga_scripts' );



/**
 * Add SVG definitions to footer.
 */
function yoga_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_footer', 'yoga_include_svg_icons', 9999 );


// Custom login page styles
function my_login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style_login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
