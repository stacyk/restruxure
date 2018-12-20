<?php
/**
 * The sidebar containing thefilter widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package restruxure
 */

if ( ! is_active_sidebar( 'sidebar-archive' ) ) {
	return;
}
?>


<div class="secondary widget-area" role="complementary">
	<?php	dynamic_sidebar( 'sidebar-archive' ); ?>
</div><!-- .secondary -->

