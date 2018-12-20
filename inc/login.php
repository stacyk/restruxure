<?php
/**
 * Custom login functions
 *
 * @package restruxure
 */

/**
 * Login Logo Link and Title
 *
 */
function restruxure_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'restruxure_login_logo_url' );

// function my_login_logo_url_title() {
//     return 'Your Site Name and Info';
// }
// add_filter( 'login_headertitle', 'my_login_logo_url_title' );
