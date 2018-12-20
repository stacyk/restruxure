<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package restruxure
 */

?>

<article <?php post_class(); ?>>
  <header class="entry-header">
    <?php if ( is_single() ) :
      the_title( '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;

    if ( 'post' === get_post_type() ) : ?>
      <div class="entry-meta">
        <?php restruxure_posted_on(); ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>

    <h2 class="entry-subtitle"><?php the_field( 'sanskrit_name' ); ?></h2>
  </header><!-- .entry-header -->


  <div class="entry-content">
    <?php the_content( sprintf(
      /* translators: %s: Name of current post. */
      wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'restruxure' ), array( 'span' => array( 'class' => array() ) ) ),
      the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ) );
    ?>

    <?php
    // Find connected muscles
    $connected_muscles = new WP_Query( array(
      'connected_type' => 'muscles_to_poses',
      'connected_items' => get_queried_object(),
      'nopaging' => true,
    ) );

    // Display connected muscles
    if ( $connected_muscles->have_posts() ) :
    ?>
      <div class="connected-posts related-muscles">
        <h3>Muscles used in this pose:</h3>
        <ul>
          <?php while ( $connected_muscles->have_posts() ) : $connected_muscles->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

      <?php
      // Prevent weirdness
      wp_reset_postdata();

    endif; ?>

    <?php
    // Find connected questions
    $connected_questions = new WP_Query(
      array(
        'connected_type' => 'question_to_poses',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
      )
    );

    // Display connected questions
    if ( $connected_questions->have_posts() ) :
    ?>
      <div class="connected-posts related-questions">
        <h3>Questions related to this pose:</h3>
        <ul>
          <?php while ( $connected_questions->have_posts() ) : $connected_questions->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php
      // Prevent weirdness
      wp_reset_postdata();

    endif; ?>

    <?php
    // Find connected variation poses
    $connected_variations = new WP_Query(
      array(
        'connected_type' => 'poses_to_poses_variations',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
      )
    );

    // Display connected variation poses
    if ( $connected_variations->have_posts() ) :
    ?>
      <div class="connected-posts related-variations">
        <h3>Variations of this pose:</h3>
        <ul>
          <?php while ( $connected_variations->have_posts() ) : $connected_variations->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php
      // Prevent weirdness
      wp_reset_postdata();

    endif; ?>


    <?php
    // Find connected before poses
    $connected_before = new WP_Query(
      array(
        'connected_type' => 'poses_to_poses_before',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
      )
    );

    // Display connected before poses
    if ( $connected_before->have_posts() ) :
    ?>
      <div class="connected-posts related-before">
        <h3>Before this pose:</h3>
        <ul>
          <?php while ( $connected_before->have_posts() ) : $connected_before->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php
      // Prevent weirdness
      wp_reset_postdata();

    endif; ?>

    <?php
    // Find connected "after" poses
    $connected_after = new WP_Query(
      array(
        'connected_type' => 'poses_to_poses_after',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
      )
    );

    // Display connected "After" poses
    if ( $connected_after->have_posts() ) :
    ?>
      <div class="connected-posts related-after">
        <h3>After this pose:</h3>
        <ul>
          <?php while ( $connected_after->have_posts() ) : $connected_after->the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php
      // Prevent weirdness
      wp_reset_postdata();

    endif; ?>

  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php restruxure_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
