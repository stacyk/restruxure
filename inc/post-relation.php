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
    'from' => 'related_to_pose',
    'to' => 'related_muscles',
    'reciprocal' => true,
    'title' => 'MusclestoPoses'
) );

p2p_register_connection_type( array(
    'name' => 'issues_to_poses',
    'from' => 'related_to_pose',
    'to' => 'common_issues',
    'reciprocal' => true,
    'title' => 'IssuestoPoses'
) );
