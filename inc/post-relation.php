<?php
/**
 * Custom ACF functions.
 *
 * A place to custom functionality related to Advanced Custom Fields.
 *
 * @package yoga
 */

p2p_register_connection_type( array(
    'name' => 'muscles_to_poses',
    'from' => 'poses',
    'to' => 'muscles',
    'reciprocal' => true,
    'title' => 'Muscles to Poses',
    'admin_box' => array(
        'show' => 'any',
        'context' => 'side'
    )
) );

p2p_register_connection_type( array(
    'name' => 'issues_to_poses',
    'from' => 'poses',
    'to' => 'issues',
    'reciprocal' => true,
    'title' => 'Issues to Poses',
    'admin_box' => array(
        'show' => 'any',
        'context' => 'side'
    )
) );

p2p_register_connection_type( array(
    'name' => 'muscles_to_issues',
    'from' => 'issues',
    'to' => 'muscles',
    'reciprocal' => true,
    'title' => 'Muscles to Issues',
    'admin_box' => array(
        'show' => 'any',
        'context' => 'side'
    )
) );

