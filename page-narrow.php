<?php
/**
 * Template Name: Narrow content
 *
 * This is the template that displays content pages like privacy, about, etc
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package restruxure
 */

get_header(); ?>

	<div class="primary content-area">
		<main id="main" class="site-main narrow-content" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<?php // get_sidebar(); ?>

		</main><!-- #main -->
	</div><!-- .primary -->

<?php get_footer(); ?>
