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
    <?php
    if ( is_single() ) :
      the_title( '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    if ( 'post' === get_post_type() ) : ?>
      <div class="entry-meta">
        <?php restruxure_posted_on(); ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->


  <div class="entry-content">
  <p>I am entry content in content-muscles.php</p>

    <?php
      the_content( sprintf(
        /* translators: %s: Name of current post. */
        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'restruxure' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ) );
    ?>


    <?php
    // Find connected pages
    $connected_poses = new WP_Query(
      array(
        'connected_type' => 'muscles_to_poses',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
      )
    );

    // Display connected pages
    if ( $connected_poses->have_posts() ) :
    ?>
    <h3>Poses that use this muscle:</h3>
    <ul>
    <?php while ( $connected_poses->have_posts() ) : $connected_poses->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </li>
    <?php endwhile; ?>
    </ul>

    <?php
    // Prevent weirdness
    wp_reset_postdata();

    endif; ?>

    <?php
    // Find connected pages
    $connected_question = new WP_Query( array(
      'connected_type' => 'question_to_muscles',
      'connected_items' => get_queried_object(),
      'nopaging' => true,
    ) );

    // Display connected pages
    if ( $connected_question->have_posts() ) :
    ?>
    <h3>Question related to this pose:</h3>
    <ul>
    <?php while ( $connected_question->have_posts() ) : $connected_question->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </li>
    <?php endwhile; ?>
    </ul>

    <?php
    // Prevent weirdness
    wp_reset_postdata();
    endif; ?>

  </div><!-- .entry-content -->


  <footer class="entry-footer">
    <?php restruxure_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
