<?php
/**
 * ACF Front End Form Save as New Post
 *
 * @package yoga
 */

/**
 * Register Google font.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
<?php

function yoga_pre_save_post( $post_id ) {

    // check if this is to be a new post
    if( $post_id != 'new' ) {
        return $post_id
    }

    // Create a new post
    $post = array(
        'post_status'  => 'published' ,
        'post_title'  => 'A title, maybe a $_POST variable' ,
        'post_type'  => 'post',
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // return the new ID
    return $post_id;

}

add_filter('acf/pre_save_post' , 'yoga_pre_save_post', 10, 1 );

?>
