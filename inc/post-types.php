<?php
/**
 * Custom Post Types
 *
 * Register custom post types
 *
 * @package yoga
 */
add_action( 'init', 'yoga_register_my_cpts', 0 );


/**
	* Post Type: Poses.
	*/

// Register Custom Post Type
function yoga_register_my_cpts() {

	$labels = array(
		'name'                  => _x( 'Poses', 'Post Type General Name', 'yoga' ),
		'singular_name'         => _x( 'Pose', 'Post Type Singular Name', 'yoga' ),
		'menu_name'             => __( 'Poses', 'yoga' ),
		'name_admin_bar'        => __( 'Pose', 'yoga' ),
		'archives'              => __( 'Pose Archives', 'yoga' ),
		'parent_item_colon'     => __( 'Parent Item:', 'yoga' ),
		'all_items'             => __( 'All Poses', 'yoga' ),
		'add_new_item'          => __( 'Add New Pose', 'yoga' ),
		'add_new'               => __( 'Add New', 'yoga' ),
		'new_item'              => __( 'New Pose', 'yoga' ),
		'edit_item'             => __( 'Edit Pose', 'yoga' ),
		'update_item'           => __( 'Update Pose', 'yoga' ),
		'view_item'             => __( 'View Pose', 'yoga' ),
		'view_items'            => __( 'View Poses', 'yoga' ),
		'search_items'          => __( 'Search Poses', 'yoga' ),
		'not_found'             => __( 'Not found', 'yoga' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'yoga' ),
		'featured_image'        => __( 'Featured Image', 'yoga' ),
		'set_featured_image'    => __( 'Set featured image', 'yoga' ),
		'remove_featured_image' => __( 'Remove featured image', 'yoga' ),
		'use_featured_image'    => __( 'Use as featured image', 'yoga' ),
		'insert_into_item'      => __( 'Insert into pose', 'yoga' ),
		'uploaded_to_this_item' => __( 'Uploaded to this pose', 'yoga' ),
		'items_list'            => __( 'Pose list', 'yoga' ),
		'items_list_navigation' => __( 'Pose list navigation', 'yoga' ),
		'filter_items_list'     => __( 'Filter pose list', 'yoga' ),
	);
	$rewrite = array(
		'slug'                  => 'poses',
		'with_front'            => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Pose', 'yoga' ),
		'description'           => __( 'Pose Library', 'yoga' ),
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
		"name" => __( 'Muscles', 'yoga' ),
		"singular_name" => __( 'Muscle', 'yoga' ),
	);

	$args = array(
		"label" => __( 'Muscles', 'yoga' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "muscles", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "muscles", $args );
}


// Register Custom Taxonomy
function yoga_pose_category() {

	$labels = array(
		'name'                       => _x( 'Pose Categories', 'Taxonomy General Name', 'yoga' ),
		'singular_name'              => _x( 'Pose Category', 'Taxonomy Singular Name', 'yoga' ),
		'menu_name'                  => __( 'Pose Categories', 'yoga' ),
		'all_items'                  => __( 'All Items', 'yoga' ),
		'parent_item'                => __( 'Parent Item', 'yoga' ),
		'parent_item_colon'          => __( 'Parent Item:', 'yoga' ),
		'new_item_name'              => __( 'New Pose Category', 'yoga' ),
		'add_new_item'               => __( 'Add New Pose Category', 'yoga' ),
		'edit_item'                  => __( 'Edit Pose Category', 'yoga' ),
		'update_item'                => __( 'Update Pose Category', 'yoga' ),
		'view_item'                  => __( 'View Pose Category', 'yoga' ),
		'separate_items_with_commas' => __( 'Separate Pose Categories with commas', 'yoga' ),
		'add_or_remove_items'        => __( 'Add or remove Pose Category', 'yoga' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'yoga' ),
		'popular_items'              => __( 'Popular Pose Categories', 'yoga' ),
		'search_items'               => __( 'Search Pose Categories', 'yoga' ),
		'not_found'                  => __( 'Not Found', 'yoga' ),
		'no_terms'                   => __( 'No Pose Categories', 'yoga' ),
		'items_list'                 => __( 'Pose Category list', 'yoga' ),
		'items_list_navigation'      => __( 'Pose Category list navigation', 'yoga' ),
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
add_action( 'init', 'yoga_pose_category', 0 );
