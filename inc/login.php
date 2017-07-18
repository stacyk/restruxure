<?php
/**
 * Custom login functions
 *
 * @package yoga
 */

/**
 * Login Logo Link and Title
 *
 */
function yoga_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'yoga_login_logo_url' );

// function my_login_logo_url_title() {
//     return 'Your Site Name and Info';
// }
// add_filter( 'login_headertitle', 'my_login_logo_url_title' );
