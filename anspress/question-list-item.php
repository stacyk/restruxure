<?php
/**
 * Template for question list item.
 *
 * @link    https://anspress.io
 * @since   0.1
 * @license GPL 2+
 * @package AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

$clearfix_class = array( 'ap-questions-item clearfix' );

?>
<div id="question-<?php the_ID(); ?>" <?php post_class( $clearfix_class ); ?>>
	<div class="ap-questions-inner">
		<div class="ap-questions-summery">
			<div class="ap-questions-head">
				<div class="ap-avatar ap-pull-left">
					<a href="<?php echo ap_user_link(); ?>">
						<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
					</a>
				</div><!-- end ap-avatar -->

				<div class="questions-title-area">
					<a class="ap-questions-hyperlink ap-questions-title" itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<span itemprop="title">
							<?php ap_question_status(); ?>
							<?php the_title(); ?>
						</span>
					</a>

					<div class="ap-list-metas">
						<div class="ap-list-counts">
							<!-- Answer Count -->
							<div class="ap-questions-count ap-questions-acount">
								<span><?php ap_answers_count(); ?></span>
								<?php _e( 'Answers', 'anspress-question-answer' ); ?>
							</div>
						</div><!-- end ap-list-counts -->

						<!-- <span class="ap-asked-by">
							<?php echo '<span class="meta">Asked by</span> '; ?>
							<?php echo ap_user_display_name( [ 'html' => true ] ); ?>
						</span> -->
					</div><!-- end ap-q-metas -->
				</div><!-- end questions-title-area -->
			</div><!-- end ap-questions-head -->

			<div class="ap-questions-content">
				<?php if (has_post_thumbnail()) :
					the_post_thumbnail();
				endif; ?>

				<div class="questions-excerpt">
					<?php the_excerpt(); ?>
				</div><!-- end ap-questions-excerpt -->
			</div><!-- end ap-questions-content -->
		</div><!-- end ap-questions-summery -->
	</div><!-- end ap-questions-inner -->
</div><!-- list item -->
