<?php
/**
 * Template Name: view profile
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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h2>Profile</h2>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


	<div class="entry-content">


	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'yoga' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
<?php

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .primary -->

		<?php get_sidebar(); ?>


<?php get_footer(); ?>
