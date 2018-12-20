<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package restruxure
 */

?>

	</div><!-- #content -->


	<div id="sidebar-sliding-panel" class="sidebar sidebar-vertical sidebar-right" aria-expanded="false">

		<?php	if ( is_user_logged_in() ) : ?>
			<?php $current_user = wp_get_current_user(); ?>
			<div class="profile-preview widget">
				<img class="avatar" src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" />
				<p class="profile-text">You are logged in as <span class="profile-name"> <?php echo $current_user->user_login; ?> </span></p>
			</div>

			<div class="secondary-menu widget">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'usermeta',
						'menu_id'        => 'usermeta-menu'
					) );
				?>
			</div>
			<?php endif; ?>

			<?php
				if ( ! is_active_sidebar( 'sidebar-menu' ) ) {
					return;
				}
			?>

			<?php dynamic_sidebar( 'sidebar-menu' ); ?>

			<div class="secondary-menu widget">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'utility',
						'menu_id'        => 'utility-menu'
					) );
				?>
			</div>
	</div>


	<!-- <footer class="site-footer">
		<div class="site-info"> -->
			<?php //echo restruxure_get_social_network_links(); ?>
			<?php //echo wp_kses_post( restruxure_get_copyright_text() ); ?>
		<!-- </div>
	</footer> -->
</div><!-- #page -->

<?php echo wp_kses_post( restruxure_get_mobile_navigation_menu() ); ?>

<?php wp_footer(); ?>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none"><symbol id="icon-arrow-left" viewBox="0 0 25 28"><title>arrow-left</title><path d="M24 14v2c0 1.062-.703 2-1.828 2h-11l4.578 4.594a1.96 1.96 0 0 1 0 2.812l-1.172 1.188c-.359.359-.875.578-1.406.578s-1.047-.219-1.422-.578L1.578 16.407C1.219 16.048 1 15.532 1 15.001s.219-1.047.578-1.422L11.75 3.423c.375-.375.891-.594 1.422-.594s1.031.219 1.406.594l1.172 1.156c.375.375.594.891.594 1.422s-.219 1.047-.594 1.422l-4.578 4.578h11c1.125 0 1.828.938 1.828 2z"></path></symbol><symbol id="icon-bars" viewBox="0 0 24 28"><path d="M24 21v2q0 .406-.297.703T23 24H1q-.406 0-.703-.297T0 23v-2q0-.406.297-.703T1 20h22q.406 0 .703.297T24 21zm0-8v2q0 .406-.297.703T23 16H1q-.406 0-.703-.297T0 15v-2q0-.406.297-.703T1 12h22q.406 0 .703.297T24 13zm0-8v2q0 .406-.297.703T23 8H1q-.406 0-.703-.297T0 7V5q0-.406.297-.703T1 4h22q.406 0 .703.297T24 5z"></path></symbol><symbol id="icon-chevron-left" viewBox="0 0 21 28"><path d="M18.297 4.703L10 13l8.297 8.297a.99.99 0 0 1 0 1.406l-2.594 2.594a.99.99 0 0 1-1.406 0L2.703 13.703a.99.99 0 0 1 0-1.406L14.297.703a.99.99 0 0 1 1.406 0l2.594 2.594a.99.99 0 0 1 0 1.406z"></path></symbol><symbol id="icon-chevron-right" viewBox="0 0 19 28"><path d="M17.297 13.703L5.703 25.297a.99.99 0 0 1-1.406 0l-2.594-2.594a.99.99 0 0 1 0-1.406L10 13 1.703 4.703a.99.99 0 0 1 0-1.406L4.297.703a.99.99 0 0 1 1.406 0l11.594 11.594a.99.99 0 0 1 0 1.406z"></path></symbol><symbol id="icon-close" viewBox="0 0 22 28"><path d="M20.281 20.656q0 .625-.438 1.062l-2.125 2.125q-.438.438-1.062.438t-1.062-.438L11 19.249l-4.594 4.594q-.438.438-1.062.438t-1.062-.438l-2.125-2.125q-.438-.438-.438-1.062t.438-1.062L6.751 15l-4.594-4.594q-.438-.438-.438-1.062t.438-1.062l2.125-2.125q.438-.438 1.062-.438t1.062.438L11 10.751l4.594-4.594q.438-.438 1.062-.438t1.062.438l2.125 2.125q.438.438.438 1.062t-.438 1.062L15.249 15l4.594 4.594q.438.438.438 1.062z"></path></symbol><symbol id="icon-facebook-square" viewBox="0 0 24 28"><path d="M19.5 2q1.859 0 3.18 1.32T24 6.5v15q0 1.859-1.32 3.18T19.5 26h-2.938v-9.297h3.109l.469-3.625h-3.578v-2.312q0-.875.367-1.313t1.43-.438l1.906-.016V5.765q-.984-.141-2.781-.141-2.125 0-3.398 1.25t-1.273 3.531v2.672H9.688v3.625h3.125v9.297H4.5q-1.859 0-3.18-1.32T0 21.499v-15q0-1.859 1.32-3.18t3.18-1.32h15z"></path></symbol><symbol id="icon-googleplus-square" viewBox="0 0 27 32"><path d="M16.375 16.161q0-.464-.107-1.143H9.804v2.357h3.875q-.054.429-.295.893t-.67.946-1.188.795-1.723.313q-1.768 0-3.018-1.268T5.535 16t1.25-3.054 3.018-1.268q1.643 0 2.732 1.054l1.857-1.804q-1.929-1.786-4.589-1.786-2.857 0-4.857 2.009t-2 4.848 2 4.848 4.857 2.009q2.946 0 4.759-1.875t1.812-4.821zm6.161.821h1.946v-1.964h-1.946v-1.964h-1.964v1.964h-1.964v1.964h1.964v1.964h1.964v-1.964zm4.893-9.553v17.143q0 2.125-1.509 3.634t-3.634 1.509H5.143q-2.125 0-3.634-1.509T0 24.572V7.429q0-2.125 1.509-3.634t3.634-1.509h17.143q2.125 0 3.634 1.509t1.509 3.634z"></path></symbol><symbol id="icon-instagram-square" viewBox="0 0 27 32"><path d="M18.286 16q0-1.893-1.339-3.232t-3.232-1.339-3.232 1.339T9.144 16t1.339 3.232 3.232 1.339 3.232-1.339T18.286 16zm2.464 0q0 2.929-2.054 4.982t-4.982 2.054-4.982-2.054T6.678 16t2.054-4.982 4.982-2.054 4.982 2.054T20.75 16zm1.929-7.321q0 .679-.482 1.161t-1.161.482-1.161-.482-.482-1.161.482-1.161 1.161-.482 1.161.482.482 1.161zM13.714 4.75l-1.366-.009q-1.241-.009-1.884 0t-1.723.054-1.839.179-1.277.33q-.893.357-1.571 1.036T3.018 7.911q-.196.518-.33 1.277t-.179 1.839-.054 1.723 0 1.884T2.464 16t-.009 1.366 0 1.884.054 1.723.179 1.839.33 1.277q.357.893 1.036 1.571t1.571 1.036q.518.196 1.277.33t1.839.179 1.723.054 1.884 0 1.366-.009 1.366.009 1.884 0 1.723-.054 1.839-.179 1.277-.33q.893-.357 1.571-1.036t1.036-1.571q.196-.518.33-1.277t.179-1.839.054-1.723 0-1.884T24.964 16t.009-1.366 0-1.884-.054-1.723-.179-1.839-.33-1.277q-.357-.893-1.036-1.571t-1.571-1.036q-.518-.196-1.277-.33t-1.839-.179-1.723-.054-1.884 0-1.366.009zM27.429 16q0 4.089-.089 5.661-.179 3.714-2.214 5.75t-5.75 2.214q-1.571.089-5.661.089t-5.661-.089q-3.714-.179-5.75-2.214T.09 21.661Q.001 20.09.001 16t.089-5.661q.179-3.714 2.214-5.75t5.75-2.214q1.571-.089 5.661-.089t5.661.089q3.714.179 5.75 2.214t2.214 5.75q.089 1.571.089 5.661z"></path></symbol><symbol id="icon-linkedin-square" viewBox="0 0 24 28"><path d="M3.703 22.094h3.609V11.25H3.703v10.844zM7.547 7.906q-.016-.812-.562-1.344t-1.453-.531-1.477.531-.57 1.344q0 .797.555 1.336t1.445.539h.016q.922 0 1.484-.539t.562-1.336zm9.141 14.188h3.609v-6.219q0-2.406-1.141-3.641T16.14 11q-2.125 0-3.266 1.828h.031V11.25H9.296q.047 1.031 0 10.844h3.609v-6.062q0-.594.109-.875.234-.547.703-.93t1.156-.383q1.813 0 1.813 2.453v5.797zM24 6.5v15q0 1.859-1.32 3.18T19.5 26h-15q-1.859 0-3.18-1.32T0 21.5v-15q0-1.859 1.32-3.18T4.5 2h15q1.859 0 3.18 1.32T24 6.5z"></path></symbol><symbol id="icon-logo" viewBox="0 0 139.13 18.89"><title>Re:Struxure Logo</title><path d="M1.76 18.32H0v-13L1.76 5v2.74C2.61 6.07 3.89 5 5.59 5a4.71 4.71 0 0 1 2.27.6L7.4 7.21a3.86 3.86 0 0 0-2-.57c-1.36 0-2.64 1-3.66 3.35zM11.46 12c.06 2.92 1.82 5 4.54 5a7 7 0 0 0 3.77-1l.34 1.62a8 8 0 0 1-4.17 1.11c-3.74 0-6.27-2.81-6.27-6.75s2.61-7 6.13-7a4.47 4.47 0 0 1 4.74 4.79 7.91 7.91 0 0 1-.28 2.07l-8.79.06zm7.32-1.56a3.81 3.81 0 0 0 0-.57c0-2-1.08-3.35-3.12-3.35a4.2 4.2 0 0 0-4.11 3.94zM25.23 10.63a1.08 1.08 0 0 1-1.06-1.11 1.06 1.06 0 0 1 2.13 0 1.08 1.08 0 0 1-1.07 1.11zm0 6.79a1.09 1.09 0 0 1-1.06-1.11 1.06 1.06 0 1 1 2.13 0 1.09 1.09 0 0 1-1.07 1.11zM35.23 15.71c1.45 0 2-.45 2-1.3 0-2.24-6.47-1.13-6.47-6.18 0-2.89 1.84-4.59 5.28-4.59a7.92 7.92 0 0 1 4 1 6.19 6.19 0 0 1 .68 3.49 8.48 8.48 0 0 0-4.25-1.3c-1.22 0-1.59.4-1.59 1.08 0 2.1 6.5 1 6.5 6.07 0 3.63-2.52 5-6 5a10.71 10.71 0 0 1-4.31-.79 6 6 0 0 1-.62-3.66 10.21 10.21 0 0 0 4.78 1.18zM52.82 4.2a4.7 4.7 0 0 1 .25 1.8 4.7 4.7 0 0 1-.26 1.76H49V13c0 1.36.4 2.07 1.93 2.07a4.38 4.38 0 0 0 2.58-.77 5.88 5.88 0 0 1-.88 3.6 5.22 5.22 0 0 1-3.23.94c-3.49 0-4.51-2.1-4.51-5.22v-6h-2.14a10.26 10.26 0 0 1 .57-3.52h1.62V1.13A7.39 7.39 0 0 1 49 0v4.2zM63.46 3.63a3 3 0 0 1 1.33.25 5 5 0 0 1 .6 2.58 4.91 4.91 0 0 1-.26 1.73 3.57 3.57 0 0 0-2-.48 3.32 3.32 0 0 0-3.06 2.47v7.92a4.64 4.64 0 0 1-2 .34A4.89 4.89 0 0 1 56 18.1V4.57a7.19 7.19 0 0 1 3.32-.65l.28 2.61h.23a3.4 3.4 0 0 1 3.63-2.9zM76.56 16.62c-.62 1.28-2 2.27-4.45 2.27-2.21 0-4.71-.77-4.71-5.47V4.77a8.47 8.47 0 0 1 4.11-.85v8.79c0 1.53.48 2.38 2.13 2.38a3.32 3.32 0 0 0 2.72-1.22V4.42a4.88 4.88 0 0 1 2.07-.34 4.64 4.64 0 0 1 2 .34V18a6.75 6.75 0 0 1-3.21.65l-.48-2zM83 4.59A4.71 4.71 0 0 1 85.58 4a5 5 0 0 1 1.79.26l1.53 2.33a5.69 5.69 0 0 1 .77 1.56h.23a5.18 5.18 0 0 1 .71-1.56L92 4.28A4.72 4.72 0 0 1 93.75 4a4.38 4.38 0 0 1 2.47.57L92 11l4.82 7.06a4.62 4.62 0 0 1-2.1.37 7.06 7.06 0 0 1-2.47-.34l-1.9-2.78a5.43 5.43 0 0 1-.79-1.56h-.23a5.33 5.33 0 0 1-.77 1.56l-1.84 2.78a6.92 6.92 0 0 1-2.41.34 4.26 4.26 0 0 1-2-.37l4.94-7.23zM107.64 16.62c-.62 1.28-2 2.27-4.45 2.27-2.21 0-4.71-.77-4.71-5.47V4.77a8.47 8.47 0 0 1 4.11-.85v8.79c0 1.53.48 2.38 2.13 2.38a3.32 3.32 0 0 0 2.72-1.22V4.42a4.88 4.88 0 0 1 2.07-.34 4.64 4.64 0 0 1 2 .34V18a6.75 6.75 0 0 1-3.21.65l-.48-2zM123 3.63a3 3 0 0 1 1.33.25 5 5 0 0 1 .6 2.58 4.91 4.91 0 0 1-.26 1.73 3.57 3.57 0 0 0-2-.48 3.32 3.32 0 0 0-3.06 2.47v7.92a4.64 4.64 0 0 1-2 .34 4.89 4.89 0 0 1-2.07-.34V4.57a7.19 7.19 0 0 1 3.32-.65l.28 2.61h.23a3.4 3.4 0 0 1 3.63-2.9zM130.08 12.59c.17 2 1.59 2.95 4.4 2.95a11.32 11.32 0 0 0 4.42-.85 4.82 4.82 0 0 1-1 3.21 9.35 9.35 0 0 1-4.48 1c-5 0-7.6-2.87-7.6-7.46s2.84-7.8 7.29-7.8c4.14 0 6 2.55 6 6.3a8.74 8.74 0 0 1-.43 2.67zm5.19-3c.23-1.48-.31-2.92-2.35-2.92a2.82 2.82 0 0 0-3 2.92z"></path></symbol><symbol id="icon-twitter-square" viewBox="0 0 24 28"><path d="M20 9.531q-.875.391-1.891.531 1.062-.625 1.453-1.828-1.016.594-2.094.797Q16.515 8 15.077 8q-1.359 0-2.32.961t-.961 2.32q0 .453.078.75-2.016-.109-3.781-1.016t-3-2.422q-.453.781-.453 1.656 0 1.781 1.422 2.734-.734-.016-1.563-.406v.031q0 1.172.781 2.086t1.922 1.133q-.453.125-.797.125-.203 0-.609-.063.328.984 1.164 1.625t1.898.656q-1.813 1.406-4.078 1.406-.406 0-.781-.047 2.312 1.469 5.031 1.469 1.75 0 3.281-.555t2.625-1.484 1.883-2.141 1.172-2.531.383-2.633q0-.281-.016-.422.984-.703 1.641-1.703zM24 6.5v15q0 1.859-1.32 3.18T19.5 26h-15q-1.859 0-3.18-1.32T0 21.5v-15q0-1.859 1.32-3.18T4.5 2h15q1.859 0 3.18 1.32T24 6.5z"></path></symbol></svg>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102807421-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
