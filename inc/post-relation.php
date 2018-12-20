<?php

/**
 * Post to Post relations
 *
 * Declare which post types are related, creates meta box in editor
 *
 * @package restruxure
 */

function restruxure_connection_types() {
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
    ));

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

    p2p_register_connection_type(
        array(
            'name' => 'question_to_muscles',
            'from' => 'question',
            'to' => 'muscles',
            'reciprocal' => true,
            'title' => 'Question to Muscles',
            'admin_box' => array(
                'show' => 'any',
                'context' => 'side'
            )
        )
    );

    p2p_register_connection_type(
        array(
            'name' => 'poses_to_poses_variations',
            'from' => 'poses',
            'to' => 'poses',
            'reciprocal' => true,
            'title' => 'Poses to Pose Variations',
            'admin_box' => array(
                'show' => 'any',
                'context' => 'side'
            )
        )
    );

    p2p_register_connection_type(
        array(
            'name' => 'poses_to_poses_after',
            'from' => 'poses',
            'to' => 'poses',
            'reciprocal' => true,
            'title' => 'After this Pose',
            'admin_box' => array(
                'show' => 'any',
                'context' => 'side'
            )
        )
    );

    p2p_register_connection_type(
        array(
            'name' => 'poses_to_poses_before',
            'from' => 'poses',
            'to' => 'poses',
            'reciprocal' => true,
            'title' => 'Before this Pose',
            'admin_box' => array(
                'show' => 'any',
                'context' => 'side'
            )
        )
    );
}
add_action( 'p2p_init', 'restruxure_connection_types' );
