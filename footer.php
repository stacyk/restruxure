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


	<div id="sidebar-sliding-panel" class="sidebar sidebar-vertical sidebar-right sidebar-open" aria-expanded="false">

		<?php	if ( is_user_logged_in() ) : ?>
			<?php $current_user = wp_get_current_user(); ?>
			<div class="profile-preview widget">
				<img class="avatar" src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" />
				<p class="profile-text">You are logged in as <span class="profile-name"> <?php echo $current_user->user_login; ?> </span></p>
			</div>
		<?php endif; ?>

		<div class="secondary-menu widget">
			<?php
        wp_nav_menu( array(
          'theme_location' => 'utility',
          'menu_id'        => 'utility-menu',
        ) );
			?>
		</div>

		<div class="secondary-menu widget">
			<?php
        wp_nav_menu( array(
          'theme_location' => 'usermeta',
          'menu_id'        => 'usermeta-menu',
        ) );
			?>
		</div>


		<?php
			if ( ! is_active_sidebar( 'sidebar-menu' ) ) {
				return;
			}
		?>

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


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102807421-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
