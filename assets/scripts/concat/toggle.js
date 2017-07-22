/**
 * File sidebar.js
 *
 * Toggle Sidebar
 */

var sidebarRight = document.getElementById( 'sidebar-sliding-panel' ),
	showRightPush = document.getElementById( 'sidebar-toggle-button' ),
	hideRightPush = document.getElementById( 'sidebar-toggle-button-close' ),
	body = document.body;


showRightPush.onclick = function() {
	classie.toggle( this, 'active' );
	classie.toggle( body, 'sidebar-push-toleft' );
	classie.toggle( sidebarRight, 'sidebar-open' );
};
