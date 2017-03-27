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
    <?php
    if ( is_single() ) :
      the_title( '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    if ( 'post' === get_post_type() ) : ?>
    <div class="entry-meta">
      <?php yoga_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php
    endif; ?>
  </header><!-- .entry-header -->

  <?php
  $poses = get_posts(array(
    'post_type' => 'pose',
    'meta_query' => array(
        array(
            'key' => 'related_to_pose', // name of custom field
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        )
    )
)); ?>
						<?php if( $related_to_pose ): ?>
            <h1>related to post</h1>
							<ul>
							<?php foreach( $related_to_pose as $post ): ?>
								<li>
                For each li start
                    <?php get_the_title( $post->ID ); ?>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>

  <?php $issues_related_muscles = get_field( 'issues_related_muscles' ); ?>

  <?php if ( $issues_related_muscles ): ?>
    <h3>Related Muscles</h3>
    <ul class="muscle-relation">
	    <?php foreach ( $issues_related_muscles as $post ):  ?>
		  <?php setup_postdata ($post); ?>
		    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>


  <div class="entry-content">
    <?php
      the_content( sprintf(
        /* translators: %s: Name of current post. */
        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'yoga' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ) );

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'yoga' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php yoga_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
