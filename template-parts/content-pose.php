<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
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
        <?php yoga_posted_on(); ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>

    <h2 class="entry-subtitle"><?php the_field( 'sanskrit_name' ); ?></h2>
  </header><!-- .entry-header -->


  <div class="entry-content">
    <?php the_content( sprintf(
      /* translators: %s: Name of current post. */
      wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'yoga' ), array( 'span' => array( 'class' => array() ) ) ),
      the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ) );
    ?>

    <?php $common_issues = get_field( 'common_issues' ); ?>

    <?php if ( $common_issues ): ?>
      <h3>Common Issues</h3>
      <ul class="pose-relation">
      <?php foreach ( $common_issues as $post ):  ?>
        <?php setup_postdata ($post); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endforeach; ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>


    <?php $related_muscles = get_field( 'related_muscles' ); ?>

    <?php if ( $related_muscles ): ?>
      <h3>Related Muscles</h3>
      <ul class="muscle-relation">
        <?php foreach ( $related_muscles as $post ):  ?>
        <?php setup_postdata ($post); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php yoga_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
