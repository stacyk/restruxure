<?php
/**
 * Template Name: home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
 */

get_header();
?>

		<div class="primary content-area">
			<main id="main" class="site-main" role="main">


				<?php
				if ( have_posts()) :
						while ( have_posts() ) : the_post();

				 	ap_get_template_part( 'question-list-item' );

					endwhile; // End of the loop.
				?>

				<?php //ap_questions_the_pagination(); ?>

				<?php endif; ?>
				<?php wp_reset_postdata(); ?>

			</main><!-- #main -->
		</div><!-- .primary -->

		<?php get_sidebar(); ?>


<?php get_footer(); ?>
