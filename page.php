<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package restruxure
 */

acf_form_head();
get_header(); ?>

	<div class="primary content-area">
		<main id="main" class="site-main facetwp-template" role="main">

		<?php while ( have_posts() ) : the_post();
					if ( is_page( 'Edit Your Profile' )) {
						get_template_part( 'template-parts/content-profile', 'page' );
				} else {
						get_template_part( 'template-parts/content', 'page' );
				} endwhile; // End of the loop.
			?>


			<?php if ( is_front_page() || is_home() ) {
				echo '<div class="multicol-features">';
					dynamic_sidebar( 'homepage-modules' );
				echo '</div>';
			} ?>

			<?php get_sidebar(); ?>

		</main><!-- #main -->
	</div><!-- .primary -->

<?php get_footer(); ?>
