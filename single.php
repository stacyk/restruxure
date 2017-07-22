<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package yoga
 */

get_header(); ?>

  <div class="primary content-area">
    <main id="main" class="site-main" role="main">

    <?php
    while ( have_posts() ) : the_post();

      if ( is_singular( 'poses' )) {
        get_template_part( 'template-parts/content-poses', get_post_format() );
      }

      elseif ( is_singular( 'muscles' )) {
        get_template_part( 'template-parts/content-muscles', get_post_format() );
      }

      else {
        get_template_part( 'template-parts/content', get_post_format() );
      }

      the_post_navigation();

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
  </div><!-- .primary -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>
