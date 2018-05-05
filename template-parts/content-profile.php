<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yoga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


	<div class="entry-content">
		<?php
			if ( !is_user_logged_in() ) {
				echo 'You are not logged in. <br />
				<a href="' . esc_url( get_permalink() ) . '">', '">Log In &rarr;</a>';

			} else {
				echo 'You are logged in, yay!';
				$uid = get_current_user_id();

				$options = array(
					'post_id' => 'user_'.$uid,
					'field_groups' => array(2, 8),
					'form' => true,
			    'return' => add_query_arg( 'updated', 'true', get_permalink() ),
					'html_before_fields' => '',
					'html_after_fields' => '',
					'submit_value' => 'Maybe Update Profile Button'
				); ?>

				<?php the_field( 'website_url' ); ?>
				<?php the_field( 'facebook_url' ); ?>
				<?php the_field( 'twitter_url' ); ?>
				<?php the_field( 'linkedin_url' ); ?>
				<?php the_field( 'instagram_url' ); ?>
				<?php the_field( 'snapchat_url' ); ?>
				<?php the_field( 'youtube_url' ); ?>
				<?php the_field( 'vimeo_url' ); ?>

			<?php	acf_form( $options );
			}

		?>

		<?php the_field( 'are_you_a_certified_yoga_instructor' ); ?>
		<?php the_field( 'where_do_you_teach' ); ?>

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
