<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yoga
 */

?>

	</div><!-- #content -->


	<div id="sidebar-sliding-panel" class="sidebar sidebar-vertical sidebar-right" aria-expanded="false">
		<h3>Profile</h3>
		<a class="avatar-sidebar" href="<?php echo ap_user_link(); ?>">
			<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
		</a>
		<span class="name-sidebar">
			<?php echo ap_user_display_name( [ 'html' => true ] ); ?>
		</span>
		<?php dynamic_sidebar( 'sidebar-menu' ); ?>
	</div>


	<footer class="site-footer">
		<div class="site-info">
			<?php echo yoga_get_social_network_links(); ?>
			<?php echo wp_kses_post( yoga_get_copyright_text() ); ?>
		</div>
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php echo wp_kses_post( yoga_get_mobile_navigation_menu() ); ?>

<?php wp_footer(); ?>

</body>
</html>
