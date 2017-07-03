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

			<div class="ap-avatar ap-pull-left">
				<a href="<?php echo ap_user_link(); ?>">
					<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
				</a>
			</div>

			<a class="ap-questions-hyperlink ap-questions-title" itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<span itemprop="title">
					<?php ap_question_status(); ?>
					<?php the_title(); ?>
				</span>
			</a>

			<div class="ap-display-question-meta">
				<?php //echo ap_question_metas(); ?>

				<div class="ap-list-counts">
					<!-- Votes count -->
					<?php if ( ! ap_opt( 'disable_voting_on_question' ) ) : ?>
						<!--<span class="ap-questions-count ap-questions-vcount">
							<span><?php ap_votes_net(); ?></span>
							<?php _e( 'Votes', 'anspress-question-answer' ); ?>
						</span>-->
					<?php endif; ?>

					<!-- Answer Count -->
					<div class="ap-questions-count ap-questions-acount">
						<span><?php ap_answers_count(); ?></span>
						<?php _e( 'Answers', 'anspress-question-answer' ); ?>
					</div>

				</div><!-- end ap-list-counts -->
			</div><!-- end ap-display-question-meta -->

			<div class="question-excerpt">
				<?php the_excerpt(); ?>
			</div>

			</div><!-- end ap-questions-summery -->
		</div><!-- end ap-questions-inner -->

	</a><!-- end ap-questions-hyperlink -->
</div><!-- list item -->
