<?php
/**
 * Post to Post relations
 *
 * Declare which post types are related, creates meta box in editor
 *
 * @package yoga
 */

p2p_register_connection_type(
    array(
        'name' => 'muscles_to_poses',
        'from' => 'poses',
        'to' => 'muscles',
        'reciprocal' => true,
        'title' => 'Muscles to Poses',
        'admin_box' => array(
            'show' => 'any',
            'context' => 'side'
        )
    )
);

p2p_register_connection_type(
    array(
        'name' => 'question_to_poses',
        'from' => 'question',
        'to' => 'poses',
        'reciprocal' => true,
        'title' => 'Question to Poses',
        'admin_box' => array(
            'show' => 'any',
            'context' => 'side'
        )
    )
);

p2p_register_connection_type( array(
    'name' => 'question_to_muscles',
    'from' => 'question',
    'to' => 'muscles',
    'reciprocal' => true,
    'title' => 'Question to Muscles',
    'admin_box' => array(
        'show' => 'any',
        'context' => 'side'
    )
) );

