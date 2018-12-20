<?php
/**
 * Display social sharing icons.
 *
 * @package restruxure
 */

?>

<div class="social-share">
	<h5 class="social-share-title"><?php esc_html_e( 'Share This', 'restruxure' ); ?></h5>
	<ul class="social-icons menu menu-horizontal">
		<li class="social-icon">
			<a href="<?php echo esc_url( restruxure_get_twitter_share_url() ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=600, height=300' ); return false;">
				<?php restruxure_display_svg( array(
					'icon'  => 'twitter-square',
					'title' => 'Twitter',
					'desc'  => esc_html__( 'Share on Twitter', 'restruxure' ),
				) ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Share on Twitter', 'restruxure' ); ?></span>
			</a>
		</li>
		<li class="social-icon">
			<a href="<?php echo esc_url( restruxure_get_facebook_share_url() ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=600, height=300' ); return false;">
				<?php restruxure_display_svg( array(
					'icon'  => 'facebook-square',
					'title' => 'Facebook',
					'desc'  => esc_html__( 'Share on Facebook', 'restruxure' ),
				) ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Share on Facebook', 'restruxure' ); ?></span>
			</a>
		</li>
		<li class="social-icon">
			<a href="<?php echo esc_url( restruxure_get_linkedin_share_url() ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=475, height=505' ); return false;">
				<?php restruxure_display_svg( array(
					'icon'  => 'linkedin-square',
					'title' => 'LinkedIn',
					'desc'  => esc_html__( 'Share on LinkedIn', 'restruxure' ),
				) ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Share on LinkedIn', 'restruxure' ); ?></span>
			</a>
		</li>
	</ul>
</div><!-- .social-share -->
