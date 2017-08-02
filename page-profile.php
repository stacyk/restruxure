<?php
/**
 * Template Name: edit profile
 *
 * This is the template that displays edit profile form
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
 */

get_header();
acf_form_head();
?>

		<div class="primary content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'profile' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .primary -->

		<?php get_sidebar(); ?>


<?php get_footer(); ?>
