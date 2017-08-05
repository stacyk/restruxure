/**
 * File sidebar.js
 *
 * Toggle Sidebar
 */

var sidebarRight = document.getElementById( 'sidebar-sliding-panel' ),
	showRightPush = document.getElementById( 'sidebar-toggle-button' ),
	body = document.body;

jQuery(document).ready(function($) {
  /* Check width on page load*/
  if ( $(window).width() > 1280) {
		classie.remove( body, 'sidebar-push-toleft' );

		showRightPush.onclick = function() {
			classie.toggle( body, 'sidebar-push-toleft' );
			classie.toggle( sidebarRight, 'open' );
			classie.toggle( showRightPush, 'open');		}
	}

	else {
		classie.remove( body, 'sidebar-push-toleft' );

		showRightPush.onclick = function() {
			classie.toggle( body, 'sidebar-push-toleft' );
			classie.toggle( sidebarRight, 'open' );
			classie.toggle( showRightPush, 'open');
		}
  }
});
