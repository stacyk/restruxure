<?php
/**
 * yoga functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yoga
 */

if ( ! function_exists( 'yoga_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yoga_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on yoga, use a find and replace
		 * to change 'yoga' to the name of your theme in all the template files.
		 * You will also need to update the Gulpfile with the new text domain
		 * and matching destination POT file.
		 */
		load_theme_textdomain( 'yoga', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary Menu', 'yoga' ),
			'mobile'  => esc_html__( 'Optional Mobile Menu', 'yoga' ),
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
		add_theme_support( 'custom-background', apply_filters( 'yoga_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // yoga_setup
add_action( 'after_setup_theme', 'yoga_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yoga_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yoga_content_width', 740 );
}
add_action( 'after_setup_theme', 'yoga_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yoga_widgets_init() {

	// Define sidebars.
	$sidebars = array(
		'sidebar-1'  => esc_html__( 'Sidebar 1', 'yoga' ),
		'sidebar-archive'  => esc_html__( 'Sidebar Archive', 'yoga' ),
		// 'sidebar-3'  => esc_html__( 'Sidebar 3', 'yoga' ),
	);

	// Loop through each sidebar and register.
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf( esc_html__( 'Widget area for %s', 'yoga' ), $sidebar_name ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'yoga_widgets_init' );


function yoga_featured_q_images() {
	add_post_type_support( 'question', 'thumbnail' );
}
add_action('init', 'yoga_featured_q_images');


// add_filter('ap_question_cpt_args', 'yoga_ap_cpt_args');
// add_filter('ap_answer_cpt_args', 'yoga_ap_cpt_args');
// function yoga_ap_cpt_args($args) {
// 	$args['exclude_from_search'] = false;

// 	return $args;
// }


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


