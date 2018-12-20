<?php
/**
 * AnsPress Edits
 *
 * @package restruxure
 */

/**
 * Example showing how to remove default question display meta.
 *
 * @param array $meta Default display metas.
 * @return array
 */
function restruxure_remove_question_display_meta( $meta ) {
  unset( $meta['views'] );
  unset( $meta['active'] );

  return $meta;
}
add_filter( 'ap_display_question_metas', 'restruxure_remove_question_display_meta' );
