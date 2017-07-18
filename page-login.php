<?php
/**
 * Template Name: login page
 *
 * @package yoga
 */

get_header(); ?>

	<div class="primary content-area">
		<main id="main" class="site-main" role="main">
			<div id="login-register-password">

			<?php
				if ( ! is_user_logged_in() ) { // Display WordPress login form:
				$args = array(
					'redirect' => home_url(),
					'form_id' => 'loginform-custom',
					'label_username' => __( 'Username' ),
					'label_password' => __( 'Password' ),
					'label_remember' => __( 'Remember Me' ),
					'label_log_in' => __( 'Log In' ),
					'remember' => true
				);
					wp_login_form( $args );
				} else { // If logged in:
				?>
					<div class="sidebox">
						<h3>Welcome, <?php echo $user_identity; ?></h3>
						<div class="usericon">
							<?php global $userdata; wp_get_current_user(); echo get_avatar($userdata->ID, 60); ?>
						</div>
						<div class="userinfo">
							<p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
							<p>
								<a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> |
								<?php if (current_user_can('manage_options')) {
									echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else {
									echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; } ?>
							</p>
						</div>
					</div>
				<?php	} ?>
			</div>
		</main><!-- #main -->
	</div><!-- .primary -->

<?php get_footer(); ?>
