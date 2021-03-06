<?php
/**
 * restruxure functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package restruxure
 */

if ( ! function_exists( 'restruxure_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function restruxure_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on restruxure, use a find and replace
		 * to change 'restruxure' to the name of your theme in all the template files.
		 * You will also need to update the Gulpfile with the new text domain
		 * and matching destination POT file.
		 */
		load_theme_textdomain( 'restruxure', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'restruxure' ),
			'mobile'  => esc_html__( 'Optional Mobile Menu', 'restruxure' ),
			'usermeta'  => esc_html__( 'User Profile Menu', 'restruxure' ),
			'utility'  => esc_html__( 'Utility Menu', 'restruxure' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'restruxure_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // restruxure_setup
add_action( 'after_setup_theme', 'restruxure_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function restruxure_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'restruxure_content_width', 740 );
}
add_action( 'after_setup_theme', 'restruxure_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function restruxure_widgets_init() {

	// Define sidebars.
	$sidebars = array(
		'sidebar-1'  => esc_html__( 'Sidebar 1', 'restruxure' ),
		'sidebar-menu'  => esc_html__( 'Sidebar Menu', 'restruxure' ),
		'homepage-modules'  => esc_html__( 'Home Page Modules', 'restruxure' ),
	);

	// Loop through each sidebar and register.
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf( esc_html__( 'Widget area for %s', 'restruxure' ), $sidebar_name ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'restruxure_widgets_init' );


function restruxure_featured_q_images() {
	add_post_type_support( 'question', 'thumbnail' );
}
add_action('init', 'restruxure_featured_q_images');





/**
 * Add SVG definitions to footer.
 */
// function restruxure_include_svg_icons() {

// 	// Define SVG sprite file.
// 	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

// 	// If it exists, include it.
// 	if ( file_exists( $svg_icons ) ) {
// 		require_once( $svg_icons );
// 	}
// }
// add_action( 'wp_footer', 'restruxure_include_svg_icons', 9999 );




// add_filter('ap_question_cpt_args', 'restruxure_ap_cpt_args');
// add_filter('ap_answer_cpt_args', 'restruxure_ap_cpt_args');
// function restruxure_ap_cpt_args($args) {
// 	$args['exclude_from_search'] = false;

// 	return $args;
// }


/**
 * Custom Login Page.
 */
require get_template_directory() . '/inc/login.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load styles and scripts.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Load custom filters and hooks.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load custom queries.
 */
require get_template_directory() . '/inc/queries.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Posts to Posts relationship.
 */
require get_template_directory() . '/inc/post-relation.php';

/**
 * AnsPress Edits.
 */
require get_template_directory() . '/inc/anspress-related.php';


