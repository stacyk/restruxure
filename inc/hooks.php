<?php
/**
 * Action hooks and filters.
 *
 * A place to put hooks and filters that aren't necessarily template tags.
 *
 * @package restruxure
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function restruxure_body_classes( $classes ) {

	// @codingStandardsIgnoreStart
	// Allows for incorrect snake case like is_IE to be used without throwing errors.
	global $is_IE;

	// If it's IE, add a class.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}
	// @codingStandardsIgnoreEnd

	// Give all pages a unique class.
	if ( is_page() ) {
		$classes[] = 'page-' . basename( get_permalink() );
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Are we on mobile?
	// PHP CS wants us to use jetpack_is_mobile instead, but what if we don't have Jetpack installed?
	// Allows for using wp_is_mobile without throwing an error.
	// @codingStandardsIgnoreStart
	if ( wp_is_mobile() ) {
		$classes[] = 'mobile';
	}


	// Test to see if user is logged out
  if (! ( is_user_logged_in() ) ) {
		$classes[] = 'logged-out';
  }

		// Test to see if user is logged in
  if ( is_user_logged_in() ) {
		$classes[] = 'logged-in';
  }

	// @codingStandardsIgnoreEnd

	$classes[] = 'sidebar-push-toleft';


	// Adds "no-js" class. If JS is enabled, this will be replaced (by javascript) to "js".
	$classes[] = 'no-js';

	return $classes;
}
add_filter( 'body_class', 'restruxure_body_classes' );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @package restruxure
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function restruxure_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'restruxure_content_image_sizes_attr', 10 , 2 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @package restruxure
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function restruxure_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'restruxure_post_thumbnail_sizes_attr', 10 , 3 );


/**
 * Flush out the transients used in restruxure_categorized_blog.
 */
function restruxure_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}
	// Like, beat it. Dig?
	delete_transient( 'restruxure_categories' );
}
add_action( 'delete_category', 'restruxure_category_transient_flusher' );
add_action( 'save_post',     'restruxure_category_transient_flusher' );


/**
 * Customize "Read More" string on <!-- more --> with the_content();
 */
function restruxure_content_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">&hellip;' . esc_html__( 'Read More', 'restruxure' ) . '</a>';
}
add_filter( 'the_content_more_link', 'restruxure_content_more_link' );


/**
 * Customize the [...] on the_excerpt();
 *
 * @param string $more The current $more string.
 * @return string Replace with "... Read More"
 */
function restruxure_excerpt_more( $more ) {

	return sprintf( '<a class="more-link" href="%1$s">%2$s</a>', get_permalink( get_the_ID() ), esc_html__( '&hellip; Read more', 'restruxure' ) );
}
add_filter( 'excerpt_more', 'restruxure_excerpt_more' );


/**
 * Customize the length of the_excerpt();
 *
 */
function restruxure_excerpt_length( $length ) {
	return 36;
}
add_filter( 'excerpt_length', 'restruxure_excerpt_length', 999 );


/**
 * Adds custom field in ask form.
 * @param  array 	$args    Ask form arguments.
 * @param  boolean 	$editing Is form is being edited.
 * @return array
 */
function restruxure_custom_ask_fields($args){
	$args['fields'][] =
		array(
			'name'  => 'restruxure_title_field_info',
			'type'  => 'custom', // this can be, text, textarea, checkbox, hidden or custom
			'html' => '<p class="form-help">The title is displayed in a prominent way and allows people to easily scan questions on any question list view.</p>', // If type is custom then html can be passed.
			'order' => 3, // Order of field
		);
	$args['fields'][] =
		array(
			'name'  => 'restruxure_description_field_info',
			'type'  => 'custom', // this can be, text, textarea, checkbox, hidden or custom
			'html' => '<p class="form-help">The description is optional and can be used to add additional information, images, links and videos.</p>', // If type is custom then html can be passed.
			'order' => 6, // Order of field
		);
	$args['fields'][] =
		array(
			'name'  => 'restruxure_category_field_info',
			'type'  => 'custom', // this can be, text, textarea, checkbox, hidden or custom
			'html' => '<p class="form-help">If your question does not fit well into our pre-defined categories, then choose "Other". A category is required.</p>', // If type is custom then html can be passed.
			'order' => 5, // Order of field
		);
	$args['fields'][] =
		array(
			'name'  => 'restruxure_tags_field_info',
			'type'  => 'custom', // this can be, text, textarea, checkbox, hidden or custom
			'html' => '<p class="form-help">Tags help find related content. When a question is tagged, people can select the tag name displayed on the question page in order to find similar questions. A tag can be the name of a yoga pose, or anything else relevant to your question. Tags are optional.</p>', // If type is custom then html can be passed.
			'order' => 10, // Order of field
		);
	return $args;
}
add_filter('ap_ask_form_fields', 'restruxure_custom_ask_fields');



