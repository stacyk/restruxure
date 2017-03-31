<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package yoga
 */

get_header(); ?>

  <div class="wrap">
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

        elseif ( is_singular( 'issues' )) {
          get_template_part( 'template-parts/content-issues', get_post_format() );
        }

        else {
          get_template_part( 'template-parts/content', get_post_format() );
        }

        the_post_navigation();

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>

      </main><!-- #main -->
    </div><!-- .primary -->

    <?php get_sidebar(); ?>

  </div><!-- .wrap -->

<?php get_footer(); ?>
