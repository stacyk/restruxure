<?php
/**
 * Custom Post Types
 *
 * Register custom post types
 *
 * @package yoga
 */

function yoga_register_my_cpts() {

	/**
	 * Post Type: Poses.
	 */

	$labels = array(
		"name" => __( 'Poses', 'yoga' ),
		"singular_name" => __( 'Pose', 'yoga' ),
	);

	$args = array(
		"label" => __( 'Poses', 'yoga' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "poses", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ),
		"taxonomies" => array( "category", "pose-category" ),
	);

	register_post_type( "poses", $args );


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

	/**
	 * Post Type: Issues.
	 */

	$labels = array(
		"name" => __( 'Issues', 'yoga' ),
		"singular_name" => __( 'Issue', 'yoga' ),
	);

	$args = array(
		"label" => __( 'Issues', 'yoga' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "issues", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "issues", $args );
}

add_action( 'init', 'yoga_register_my_cpts' );

