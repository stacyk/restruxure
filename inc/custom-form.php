<?php
/**
 * Register a custom form by "sample_form" name in AnsPress.
 *
 * @return array
 */
function restruxure_custom_form_in_ap() {
  $form = array(
    'fields' => array(
      'input_field_1' => array( // This is a unique key for field.
        'label' => __('Simple input field'),
        'desc' => __('A simple description about this field.'),
        'type' => 'input', // Default type is input.
        'subtype' => 'text' // Default subtype is text.
      ),
      'email_field_2' => array(
        'label' => __('Sample email field'),
        'desc' => __('A simple description about this field.'),
        'subtype' => 'email', // Default subtype is text.
        'attr' => array(
          'placeholder' => __('Enter your email'),
          'class' => 'custom-css-class'
        )
      ),
      'pages' => array(
        'label' => __('Page field'),
        'desc' => __('A sample field for selecting a page.'),
        'type' => 'select',
        'options' => 'posts',
        'post_args' => array(
          'post_type' => 'page'
        )
      ),
      'editor' => array(
        'label' => __('Sample editor field'),
        'desc' => __('A TinyMce editor field.'),
        'type' => 'editor'
      )
    )
  );

  return $form;
}
// ap_form_ followed by form name.
add_filter('ap_form_sample_form', 'restruxure_custom_form_in_ap');
