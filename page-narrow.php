<?php
/**
 * Template Name: Narrow content
 *
 * This is the template that displays content pages like privacy, about, etc
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
 */

get_header(); ?>

	<div class="wrap">
		<div class="primary content-area">
			<main id="main" class="site-main narrow-content" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;

				endwhile; // End of the loop.
				?>

				<?php // get_sidebar(); ?>

			</main><!-- #main -->
		</div><!-- .primary -->


	</div><!-- .wrap -->

<?php get_footer(); ?>
