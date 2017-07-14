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
