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

	<?php if ( ! is_front_page() ) : ?>
		<header class="entry-header">
			<h2>Profile</h2>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>

	<?php endif; ?>

	<div class="entry-content">
		<?php
			if ( !is_user_logged_in() ) {
				echo 'You are not logged in. <br />
				<a href="' . esc_url( get_permalink() ) . '">', '">Log In &rarr;</a>';

			} else {

			$uid = get_current_user_id();

				$options = array(
					'post_id' => 'user_'.$uid,
					'field_groups' => array(8),
					'form' => true,
			    'return' => add_query_arg( 'updated', 'true', get_permalink() ),
					'html_before_fields' => '',
					'html_after_fields' => '',
					'submit_value' => 'Update Profile'
				);

				echo '<p>Your username is <b>' . wp_get_current_user()->user_login . '</b>. This cannot be changed.</p>';

				acf_form( $options );
			}

		?>

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
