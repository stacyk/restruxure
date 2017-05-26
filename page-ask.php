<?php
/**
 * Template Name: ask
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

	<div class="wrap">
		<div class="primary content-area">
			<main id="main" class="site-main facetwp-template" role="main">

				<?php
				while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .primary -->

		<?php // get_sidebar(); ?>

	</div><!-- .wrap -->

<?php get_footer(); ?>