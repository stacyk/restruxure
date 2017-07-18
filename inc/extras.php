<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package yoga
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function yoga_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'yoga_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'yoga_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so yoga_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so yoga_categorized_blog should return false.
		return false;
	}
}

/**
 * Get an attachment ID from it's URL.
 *
 * @param string $attachment_url The URL of the attachment.
 * @return int The attachment ID.
 */
function yoga_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;

	$attachment_id = false;

	// If there is no url, return.
	if ( '' === $attachment_url ) {
		return false;
	}

	// Get the upload directory paths.
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image.
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image.
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL.
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Do something with $result.
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) ); // WPCS: db call ok , cache ok.
	}

	return $attachment_id;
}

/**
 * Returns an <img> that can be used anywhere a placeholder image is needed
 * in a theme. The image is a simple colored block with the image dimensions
 * displayed in the middle.
 *
 * @author Ben Lobaugh
 * @throws Exception Details of missing parameters.
 * @param array $args {.
 *		@type int $width
 *		@type int $height
 *		@type string $background_color
 *		@type string $text_color
 * }
 * @return string
 */
function yoga_get_placeholder_image( $args = array() ) {
	$default_args = array(
		'width'				=> '',
		'height'			=> '',
		'background_color'	=> 'dddddd',
		'text_color'		=> '000000',
	);

	$args = wp_parse_args( $args, $default_args );

	// Extract the vars we want to work with.
	$width 				= $args['width'];
	$height			 	= $args['height'];
	$background_color	= $args['background_color'];
	$text_color 		= $args['text_color'];

	// Perform some quick data validation.
	if ( ! is_numeric( $width ) ) {
		throw new Exception( __( 'Width must be an integer', 'yoga' ) );
	}

	if ( ! is_numeric( $height ) ) {
		throw new Exception( __( 'Height must be an integer', 'yoga' ) );
	}

	if ( ! ctype_xdigit( $background_color ) ) {
		throw new Exception( __( 'Please provide a valid hex color value for background_color', 'yoga' ) );
	}

	if ( ! ctype_xdigit( $text_color ) ) {
		throw new Exception( __( 'Please provide a valid hex color value for text_color', 'yoga' ) );
	}

	// Set up the url to the image.
	$url = "http://placeholder.wdslab.com/i/{$width}x$height/$background_color/$text_color";

	// Text that will be utilized by screen readers.
	$alt = apply_filters( 'yoga_placeholder_image_alt', __( 'WebDevStudios Placeholder Image', 'yoga' ) );

	return "<img src='$url' width='$width' height='$height' alt='$alt' />";
}
