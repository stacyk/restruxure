<?php
/**
 * Custom Post Types
 *
 * Register custom post types
 *
 * @package restruxure
 */
add_action( 'init', 'restruxure_register_my_cpts', 0 );


/**
	* Post Type: Poses.
	*/

// Register Custom Post Type
function restruxure_register_my_cpts() {

	$labels = array(
		'name'                  => _x( 'Poses', 'Post Type General Name', 'restruxure' ),
		'singular_name'         => _x( 'Pose', 'Post Type Singular Name', 'restruxure' ),
		'menu_name'             => __( 'Poses', 'restruxure' ),
		'name_admin_bar'        => __( 'Pose', 'restruxure' ),
		'archives'              => __( 'Pose Archives', 'restruxure' ),
		'parent_item_colon'     => __( 'Parent Item:', 'restruxure' ),
		'all_items'             => __( 'All Poses', 'restruxure' ),
		'add_new_item'          => __( 'Add New Pose', 'restruxure' ),
		'add_new'               => __( 'Add New', 'restruxure' ),
		'new_item'              => __( 'New Pose', 'restruxure' ),
		'edit_item'             => __( 'Edit Pose', 'restruxure' ),
		'update_item'           => __( 'Update Pose', 'restruxure' ),
		'view_item'             => __( 'View Pose', 'restruxure' ),
		'view_items'            => __( 'View Poses', 'restruxure' ),
		'search_items'          => __( 'Search Poses', 'restruxure' ),
		'not_found'             => __( 'Not found', 'restruxure' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'restruxure' ),
		'featured_image'        => __( 'Featured Image', 'restruxure' ),
		'set_featured_image'    => __( 'Set featured image', 'restruxure' ),
		'remove_featured_image' => __( 'Remove featured image', 'restruxure' ),
		'use_featured_image'    => __( 'Use as featured image', 'restruxure' ),
		'insert_into_item'      => __( 'Insert into pose', 'restruxure' ),
		'uploaded_to_this_item' => __( 'Uploaded to this pose', 'restruxure' ),
		'items_list'            => __( 'Pose list', 'restruxure' ),
		'items_list_navigation' => __( 'Pose list navigation', 'restruxure' ),
		'filter_items_list'     => __( 'Filter pose list', 'restruxure' ),
	);
	$rewrite = array(
		'slug'                  => 'poses',
		'with_front'            => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Pose', 'restruxure' ),
		'description'           => __( 'Pose Library', 'restruxure' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'pose_categories', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'poses', $args );



	/**
	 * Post Type: Muscles.
	 */

	$labels = array(
		"name" => __( 'Muscles', 'restruxure' ),
		"singular_name" => __( 'Muscle', 'restruxure' ),
	);
	$rewrite = array(
		'slug'                  => 'muscles',
		'with_front'            => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Muscles', 'restruxure' ),
		'description'           => __( 'Muscle Library', 'restruxure' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'muscle_categories', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'muscles', $args );
}


// Register Custom Taxonomy
function restruxure_pose_category() {

	$labels = array(
		'name'                       => _x( 'Pose Categories', 'Taxonomy General Name', 'restruxure' ),
		'singular_name'              => _x( 'Pose Category', 'Taxonomy Singular Name', 'restruxure' ),
		'menu_name'                  => __( 'Pose Categories', 'restruxure' ),
		'all_items'                  => __( 'All Items', 'restruxure' ),
		'parent_item'                => __( 'Parent Item', 'restruxure' ),
		'parent_item_colon'          => __( 'Parent Item:', 'restruxure' ),
		'new_item_name'              => __( 'New Pose Category', 'restruxure' ),
		'add_new_item'               => __( 'Add New Pose Category', 'restruxure' ),
		'edit_item'                  => __( 'Edit Pose Category', 'restruxure' ),
		'update_item'                => __( 'Update Pose Category', 'restruxure' ),
		'view_item'                  => __( 'View Pose Category', 'restruxure' ),
		'separate_items_with_commas' => __( 'Separate Pose Categories with commas', 'restruxure' ),
		'add_or_remove_items'        => __( 'Add or remove Pose Category', 'restruxure' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'restruxure' ),
		'popular_items'              => __( 'Popular Pose Categories', 'restruxure' ),
		'search_items'               => __( 'Search Pose Categories', 'restruxure' ),
		'not_found'                  => __( 'Not Found', 'restruxure' ),
		'no_terms'                   => __( 'No Pose Categories', 'restruxure' ),
		'items_list'                 => __( 'Pose Category list', 'restruxure' ),
		'items_list_navigation'      => __( 'Pose Category list navigation', 'restruxure' ),
	);
	$rewrite = array(
		'slug'                       => 'pose-categories',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'pose_category', array( 'poses' ), $args );

}
add_action( 'init', 'restruxure_pose_category', 0 );
