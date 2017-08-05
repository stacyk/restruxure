"use strict";

/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
(function (window) {

  'use strict';

  // class helper functions from bonzo https://github.com/ded/bonzo

  function classReg(className) {
    return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
  }

  // classList support for class management
  // altho to be fair, the api sucks because it won't accept multiple classes at once
  var hasClass, addClass, removeClass;

  if ('classList' in document.documentElement) {
    hasClass = function hasClass(elem, c) {
      return elem.classList.contains(c);
    };
    addClass = function addClass(elem, c) {
      elem.classList.add(c);
    };
    removeClass = function removeClass(elem, c) {
      elem.classList.remove(c);
    };
  } else {
    hasClass = function hasClass(elem, c) {
      return classReg(c).test(elem.className);
    };
    addClass = function addClass(elem, c) {
      if (!hasClass(elem, c)) {
        elem.className = elem.className + ' ' + c;
      }
    };
    removeClass = function removeClass(elem, c) {
      elem.className = elem.className.replace(classReg(c), ' ');
    };
  }

  function toggleClass(elem, c) {
    var fn = hasClass(elem, c) ? removeClass : addClass;
    fn(elem, c);
  }

  window.classie = {
    // full names
    hasClass: hasClass,
    addClass: addClass,
    removeClass: removeClass,
    toggleClass: toggleClass,
    // short names
    has: hasClass,
    add: addClass,
    remove: removeClass,
    toggle: toggleClass
  };
})(window);
'use strict';

/**
 * File js-enabled.js
 *
 * If Javascript is enabled, replace the <body> class "no-js".
 */
document.body.className = document.body.className.replace('no-js', 'js');
'use strict';

/**
 * File modal.js
 *
 * Deal with multiple modals and their media.
 */
window.wdsModal = {};

(function (window, $, app) {

	var $modalToggle;
	var $focusableChildren;

	// Constructor.
	app.init = function () {
		app.cache();

		if (app.meetsRequirements()) {
			app.bindEvents();
		}
	};

	// Cache all the things.
	app.cache = function () {
		app.$c = {
			'body': $('body')
		};
	};

	// Do we meet the requirements?
	app.meetsRequirements = function () {
		return $('.modal-trigger').length;
	};

	// Combine all events.
	app.bindEvents = function () {
		// Trigger a modal to open.
		app.$c.body.on('click touchstart', '.modal-trigger', app.openModal);

		// Trigger the close button to close the modal.
		app.$c.body.on('click touchstart', '.close', app.closeModal);

		// Allow the user to close the modal by hitting the esc key.
		app.$c.body.on('keydown', app.escKeyClose);

		// Allow the user to close the modal by clicking outside of the modal.
		app.$c.body.on('click touchstart', 'div.modal-open', app.closeModalByClick);

		// Listen to tabs, trap keyboard if we need to
		app.$c.body.on('keydown', app.trapKeyboardMaybe);
	};

	// Open the modal.
	app.openModal = function () {
		// Store the modal toggle element
		$modalToggle = $(this);

		// Figure out which modal we're opening and store the object.
		var $modal = $($(this).data('target'));

		// Display the modal.
		$modal.addClass('modal-open');

		// Add body class.
		app.$c.body.addClass('modal-open');

		// Find the focusable children of the modal.
		// This list may be incomplete, really wish jQuery had the :focusable pseudo like jQuery UI does.
		// For more about :input see: https://api.jquery.com/input-selector/
		$focusableChildren = $modal.find('a, :input, [tabindex]');

		// Ideally, there is always one (the close button), but you never know.
		if ($focusableChildren.length > 0) {
			// Shift focus to the first focusable element.
			$focusableChildren[0].focus();
		}
	};

	// Close the modal.
	app.closeModal = function () {
		// Figure the opened modal we're closing and store the object.
		var $modal = $($('div.modal-open .close').data('target'));

		// Find the iframe in the $modal object.
		var $iframe = $modal.find('iframe');

		// Only do this if there are any iframes.
		if ($iframe.length) {
			// Get the iframe src URL.
			var url = $iframe.attr('src');

			// Removing/Readding the URL will effectively break the YouTube API.
			// So let's not do that when the iframe URL contains the enablejsapi parameter.
			if (!url.includes('enablejsapi=1')) {
				// Remove the source URL, then add it back, so the video can be played again later.
				$iframe.attr('src', '').attr('src', url);
			} else {
				// Use the YouTube API to stop the video.
				player.stopVideo();
			}
		}

		// Finally, hide the modal.
		$modal.removeClass('modal-open');

		// Remove the body class.
		app.$c.body.removeClass('modal-open');

		// Revert focus back to toggle element
		$modalToggle.focus();
	};

	// Close if "esc" key is pressed.
	app.escKeyClose = function (event) {
		if (27 === event.keyCode) {
			app.closeModal();
		}
	};

	// Close if the user clicks outside of the modal
	app.closeModalByClick = function (event) {
		// If the parent container is NOT the modal dialog container, close the modal
		if (!$(event.target).parents('div').hasClass('modal-dialog')) {
			app.closeModal();
		}
	};

	// Trap the keyboard into a modal when one is active.
	app.trapKeyboardMaybe = function (event) {

		// We only need to do stuff when the modal is open and tab is pressed.
		if (9 === event.which && $('.modal-open').length > 0) {
			var $focused = $(':focus');
			var focusIndex = $focusableChildren.index($focused);

			if (0 === focusIndex && event.shiftKey) {
				// If this is the first focusable element, and shift is held when pressing tab, go back to last focusable element.
				$focusableChildren[$focusableChildren.length - 1].focus();
				event.preventDefault();
			} else if (!event.shiftKey && focusIndex === $focusableChildren.length - 1) {
				// If this is the last focusable element, and shift is not held, go back to the first focusable element.
				$focusableChildren[0].focus();
				event.preventDefault();
			}
		}
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.wdsModal);

// Load the yt iframe api js file from youtube.
// NOTE THE IFRAME URL MUST HAVE 'enablejsapi=1' appended to it.
// example: src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1"
// It also _must_ have an ID attribute.
var tag = document.createElement('script');
tag.id = 'iframe-yt';
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// This var and function have to be available globally due to yt js iframe api.
var player;
function onYouTubeIframeAPIReady() {
	var modal = jQuery('div.modal');
	var iframeid = modal.find('iframe').attr('id');

	player = new YT.Player(iframeid, {
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

function onPlayerReady(event) {}

function onPlayerStateChange(event) {
	// Set focus to the first focusable element inside of the modal the player is in.
	jQuery(event.target.a).parents('.modal').find('a, :input, [tabindex]').first().focus();
}
'use strict';

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
	    isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
	    isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

	if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
		window.addEventListener('hashchange', function () {
			var id = location.hash.substring(1),
			    element;

			if (!/^[A-z0-9_-]+$/.test(id)) {
				return;
			}

			element = document.getElementById(id);

			if (element) {
				if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false);
	}
})();
'use strict';

/**
 * File sidebar.js
 *
 * Toggle Sidebar
 */

var sidebarRight = document.getElementById('sidebar-sliding-panel'),
    showRightPush = document.getElementById('sidebar-toggle-button'),
    body = document.body;

jQuery(document).ready(function ($) {
	/* Check width on page load*/
	if ($(window).width() > 1280) {
		classie.remove(body, 'sidebar-push-toleft');

		//	classie.add( sidebarRight, 'open' );
		//		classie.add( showRightPush, 'open');

		showRightPush.onclick = function () {
			classie.toggle(body, 'sidebar-push-toleft');
			classie.toggle(sidebarRight, 'open');
			classie.toggle(showRightPush, 'open');
		};
	} else {
		classie.remove(body, 'sidebar-push-toleft');

		showRightPush.onclick = function () {
			classie.toggle(body, 'sidebar-push-toleft');
			classie.toggle(sidebarRight, 'open');
			classie.toggle(showRightPush, 'open');
		};
	}
});
'use strict';

/**
 * File window-ready.js
 *
 * Add a "ready" class to <body> when window is ready.
 */
window.wdsWindowReady = {};
(function (window, $, app) {
	// Constructor.
	app.init = function () {
		app.cache();
		app.bindEvents();
	};

	// Cache document elements.
	app.cache = function () {
		app.$c = {
			'window': $(window),
			'body': $(document.body)
		};
	};

	// Combine all events.
	app.bindEvents = function () {
		app.$c.window.load(app.addBodyClass);
	};

	// Add a class to <body>.
	app.addBodyClass = function () {
		app.$c.body.addClass('ready');
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.wdsWindowReady);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImNsYXNzaWUuanMiLCJqcy1lbmFibGVkLmpzIiwibW9kYWwuanMiLCJza2lwLWxpbmstZm9jdXMtZml4LmpzIiwidG9nZ2xlLmpzIiwid2luZG93LXJlYWR5LmpzIl0sIm5hbWVzIjpbIndpbmRvdyIsImNsYXNzUmVnIiwiY2xhc3NOYW1lIiwiUmVnRXhwIiwiaGFzQ2xhc3MiLCJhZGRDbGFzcyIsInJlbW92ZUNsYXNzIiwiZG9jdW1lbnQiLCJkb2N1bWVudEVsZW1lbnQiLCJlbGVtIiwiYyIsImNsYXNzTGlzdCIsImNvbnRhaW5zIiwiYWRkIiwicmVtb3ZlIiwidGVzdCIsInJlcGxhY2UiLCJ0b2dnbGVDbGFzcyIsImZuIiwiY2xhc3NpZSIsImhhcyIsInRvZ2dsZSIsImJvZHkiLCJ3ZHNNb2RhbCIsIiQiLCJhcHAiLCIkbW9kYWxUb2dnbGUiLCIkZm9jdXNhYmxlQ2hpbGRyZW4iLCJpbml0IiwiY2FjaGUiLCJtZWV0c1JlcXVpcmVtZW50cyIsImJpbmRFdmVudHMiLCIkYyIsImxlbmd0aCIsIm9uIiwib3Blbk1vZGFsIiwiY2xvc2VNb2RhbCIsImVzY0tleUNsb3NlIiwiY2xvc2VNb2RhbEJ5Q2xpY2siLCJ0cmFwS2V5Ym9hcmRNYXliZSIsIiRtb2RhbCIsImRhdGEiLCJmaW5kIiwiZm9jdXMiLCIkaWZyYW1lIiwidXJsIiwiYXR0ciIsImluY2x1ZGVzIiwicGxheWVyIiwic3RvcFZpZGVvIiwiZXZlbnQiLCJrZXlDb2RlIiwidGFyZ2V0IiwicGFyZW50cyIsIndoaWNoIiwiJGZvY3VzZWQiLCJmb2N1c0luZGV4IiwiaW5kZXgiLCJzaGlmdEtleSIsInByZXZlbnREZWZhdWx0IiwialF1ZXJ5IiwidGFnIiwiY3JlYXRlRWxlbWVudCIsImlkIiwic3JjIiwiZmlyc3RTY3JpcHRUYWciLCJnZXRFbGVtZW50c0J5VGFnTmFtZSIsInBhcmVudE5vZGUiLCJpbnNlcnRCZWZvcmUiLCJvbllvdVR1YmVJZnJhbWVBUElSZWFkeSIsIm1vZGFsIiwiaWZyYW1laWQiLCJZVCIsIlBsYXllciIsImV2ZW50cyIsIm9uUGxheWVyUmVhZHkiLCJvblBsYXllclN0YXRlQ2hhbmdlIiwiYSIsImZpcnN0IiwiaXNXZWJraXQiLCJuYXZpZ2F0b3IiLCJ1c2VyQWdlbnQiLCJ0b0xvd2VyQ2FzZSIsImluZGV4T2YiLCJpc09wZXJhIiwiaXNJZSIsImdldEVsZW1lbnRCeUlkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImxvY2F0aW9uIiwiaGFzaCIsInN1YnN0cmluZyIsImVsZW1lbnQiLCJ0YWdOYW1lIiwidGFiSW5kZXgiLCJzaWRlYmFyUmlnaHQiLCJzaG93UmlnaHRQdXNoIiwicmVhZHkiLCJ3aWR0aCIsIm9uY2xpY2siLCJ3ZHNXaW5kb3dSZWFkeSIsImxvYWQiLCJhZGRCb2R5Q2xhc3MiXSwibWFwcGluZ3MiOiI7O0FBQUE7Ozs7Ozs7OztBQVNBO0FBQ0EsQ0FBRSxVQUFVQSxNQUFWLEVBQW1COztBQUVyQjs7QUFFQTs7QUFFQSxXQUFTQyxRQUFULENBQW1CQyxTQUFuQixFQUErQjtBQUM3QixXQUFPLElBQUlDLE1BQUosQ0FBVyxhQUFhRCxTQUFiLEdBQXlCLFVBQXBDLENBQVA7QUFDRDs7QUFFRDtBQUNBO0FBQ0EsTUFBSUUsUUFBSixFQUFjQyxRQUFkLEVBQXdCQyxXQUF4Qjs7QUFFQSxNQUFLLGVBQWVDLFNBQVNDLGVBQTdCLEVBQStDO0FBQzdDSixlQUFXLGtCQUFVSyxJQUFWLEVBQWdCQyxDQUFoQixFQUFvQjtBQUM3QixhQUFPRCxLQUFLRSxTQUFMLENBQWVDLFFBQWYsQ0FBeUJGLENBQXpCLENBQVA7QUFDRCxLQUZEO0FBR0FMLGVBQVcsa0JBQVVJLElBQVYsRUFBZ0JDLENBQWhCLEVBQW9CO0FBQzdCRCxXQUFLRSxTQUFMLENBQWVFLEdBQWYsQ0FBb0JILENBQXBCO0FBQ0QsS0FGRDtBQUdBSixrQkFBYyxxQkFBVUcsSUFBVixFQUFnQkMsQ0FBaEIsRUFBb0I7QUFDaENELFdBQUtFLFNBQUwsQ0FBZUcsTUFBZixDQUF1QkosQ0FBdkI7QUFDRCxLQUZEO0FBR0QsR0FW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LENBQW9CM0UsSUFBSTRFLFlBQXhCO0FBQ0EsRUFGRDs7QUFJQTtBQUNBNUUsS0FBSTRFLFlBQUosR0FBbUIsWUFBWTtBQUM5QjVFLE1BQUlPLEVBQUosQ0FBT1YsSUFBUCxDQUFZakIsUUFBWixDQUFzQixPQUF0QjtBQUNBLEVBRkQ7O0FBSUE7QUFDQW1CLEdBQUdDLElBQUlHLElBQVA7QUFDQSxDQTNCRCxFQTJCSzVCLE1BM0JMLEVBMkJhNEQsTUEzQmIsRUEyQnFCNUQsT0FBT21HLGNBM0I1QiIsImZpbGUiOiJwcm9qZWN0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyohXG4gKiBjbGFzc2llIC0gY2xhc3MgaGVscGVyIGZ1bmN0aW9uc1xuICogZnJvbSBib256byBodHRwczovL2dpdGh1Yi5jb20vZGVkL2JvbnpvXG4gKiBjbGFzc2llLmhhcyggZWxlbSwgJ215LWNsYXNzJyApIC0+IHRydWUvZmFsc2VcbiAqIGNsYXNzaWUuYWRkKCBlbGVtLCAnbXktbmV3LWNsYXNzJyApXG4gKiBjbGFzc2llLnJlbW92ZSggZWxlbSwgJ215LXVud2FudGVkLWNsYXNzJyApXG4gKiBjbGFzc2llLnRvZ2dsZSggZWxlbSwgJ215LWNsYXNzJyApXG4gKi9cblxuLypqc2hpbnQgYnJvd3NlcjogdHJ1ZSwgc3RyaWN0OiB0cnVlLCB1bmRlZjogdHJ1ZSAqL1xuKCBmdW5jdGlvbiggd2luZG93ICkge1xuXG4ndXNlIHN0cmljdCc7XG5cbi8vIGNsYXNzIGhlbHBlciBmdW5jdGlvbnMgZnJvbSBib256byBodHRwczovL2dpdGh1Yi5jb20vZGVkL2JvbnpvXG5cbmZ1bmN0aW9uIGNsYXNzUmVnKCBjbGFzc05hbWUgKSB7XG4gIHJldHVybiBuZXcgUmVnRXhwKFwiKF58XFxcXHMrKVwiICsgY2xhc3NOYW1lICsgXCIoXFxcXHMrfCQpXCIpO1xufVxuXG4vLyBjbGFzc0xpc3Qgc3VwcG9ydCBmb3IgY2xhc3MgbWFuYWdlbWVudFxuLy8gYWx0aG8gdG8gYmUgZmFpciwgdGhlIGFwaSBzdWNrcyBiZWNhdXNlIGl0IHdvbid0IGFjY2VwdCBtdWx0aXBsZSBjbGFzc2VzIGF0IG9uY2VcbnZhciBoYXNDbGFzcywgYWRkQ2xhc3MsIHJlbW92ZUNsYXNzO1xuXG5pZiAoICdjbGFzc0xpc3QnIGluIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCApIHtcbiAgaGFzQ2xhc3MgPSBmdW5jdGlvbiggZWxlbSwgYyApIHtcbiAgICByZXR1cm4gZWxlbS5jbGFzc0xpc3QuY29udGFpbnMoIGMgKTtcbiAgfTtcbiAgYWRkQ2xhc3MgPSBmdW5jdGlvbiggZWxlbSwgYyApIHtcbiAgICBlbGVtLmNsYXNzTGlzdC5hZGQoIGMgKTtcbiAgfTtcbiAgcmVtb3ZlQ2xhc3MgPSBmdW5jdGlvbiggZWxlbSwgYyApIHtcbiAgICBlbGVtLmNsYXNzTGlzdC5yZW1vdmUoIGMgKTtcbiAgfTtcbn1cbmVsc2Uge1xuICBoYXNDbGFzcyA9IGZ1bmN0aW9uKCBlbGVtLCBjICkge1xuICAgIHJldHVybiBjbGFzc1JlZyggYyApLnRlc3QoIGVsZW0uY2xhc3NOYW1lICk7XG4gIH07XG4gIGFkZENsYXNzID0gZnVuY3Rpb24oIGVsZW0sIGMgKSB7XG4gICAgaWYgKCAhaGFzQ2xhc3MoIGVsZW0sIGMgKSApIHtcbiAgICAgIGVsZW0uY2xhc3NOYW1lID0gZWxlbS5jbGFzc05hbWUgKyAnICcgKyBjO1xuICAgIH1cbiAgfTtcbiAgcmVtb3ZlQ2xhc3MgPSBmdW5jdGlvbiggZWxlbSwgYyApIHtcbiAgICBlbGVtLmNsYXNzTmFtZSA9IGVsZW0uY2xhc3NOYW1lLnJlcGxhY2UoIGNsYXNzUmVnKCBjICksICcgJyApO1xuICB9O1xufVxuXG5mdW5jdGlvbiB0b2dnbGVDbGFzcyggZWxlbSwgYyApIHtcbiAgdmFyIGZuID0gaGFzQ2xhc3MoIGVsZW0sIGMgKSA/IHJlbW92ZUNsYXNzIDogYWRkQ2xhc3M7XG4gIGZuKCBlbGVtLCBjICk7XG59XG5cbndpbmRvdy5jbGFzc2llID0ge1xuICAvLyBmdWxsIG5hbWVzXG4gIGhhc0NsYXNzOiBoYXNDbGFzcyxcbiAgYWRkQ2xhc3M6IGFkZENsYXNzLFxuICByZW1vdmVDbGFzczogcmVtb3ZlQ2xhc3MsXG4gIHRvZ2dsZUNsYXNzOiB0b2dnbGVDbGFzcyxcbiAgLy8gc2hvcnQgbmFtZXNcbiAgaGFzOiBoYXNDbGFzcyxcbiAgYWRkOiBhZGRDbGFzcyxcbiAgcmVtb3ZlOiByZW1vdmVDbGFzcyxcbiAgdG9nZ2xlOiB0b2dnbGVDbGFzc1xufTtcblxufSkoIHdpbmRvdyApO1xuIiwiLyoqXG4gKiBGaWxlIGpzLWVuYWJsZWQuanNcbiAqXG4gKiBJZiBKYXZhc2NyaXB0IGlzIGVuYWJsZWQsIHJlcGxhY2UgdGhlIDxib2R5PiBjbGFzcyBcIm5vLWpzXCIuXG4gKi9cbmRvY3VtZW50LmJvZHkuY2xhc3NOYW1lID0gZG9jdW1lbnQuYm9keS5jbGFzc05hbWUucmVwbGFjZSggJ25vLWpzJywgJ2pzJyApO1xuIiwiLyoqXG4gKiBGaWxlIG1vZGFsLmpzXG4gKlxuICogRGVhbCB3aXRoIG11bHRpcGxlIG1vZGFscyBhbmQgdGhlaXIgbWVkaWEuXG4gKi9cbndpbmRvdy53ZHNNb2RhbCA9IHt9O1xuXG4oIGZ1bmN0aW9uICggd2luZG93LCAkLCBhcHAgKSB7XG5cblx0dmFyICRtb2RhbFRvZ2dsZTtcblx0dmFyICRmb2N1c2FibGVDaGlsZHJlbjtcblxuXHQvLyBDb25zdHJ1Y3Rvci5cblx0YXBwLmluaXQgPSBmdW5jdGlvbiAoKSB7XG5cdFx0YXBwLmNhY2hlKCk7XG5cblx0XHRpZiAoIGFwcC5tZWV0c1JlcXVpcmVtZW50cygpICkge1xuXHRcdFx0YXBwLmJpbmRFdmVudHMoKTtcblx0XHR9XG5cdH07XG5cblx0Ly8gQ2FjaGUgYWxsIHRoZSB0aGluZ3MuXG5cdGFwcC5jYWNoZSA9IGZ1bmN0aW9uICgpIHtcblx0XHRhcHAuJGMgPSB7XG5cdFx0XHQnYm9keSc6ICQoICdib2R5JyApXG5cdFx0fTtcblx0fTtcblxuXHQvLyBEbyB3ZSBtZWV0IHRoZSByZXF1aXJlbWVudHM/XG5cdGFwcC5tZWV0c1JlcXVpcmVtZW50cyA9IGZ1bmN0aW9uICgpIHtcblx0XHRyZXR1cm4gJCggJy5tb2RhbC10cmlnZ2VyJyApLmxlbmd0aDtcblx0fTtcblxuXHQvLyBDb21iaW5lIGFsbCBldmVudHMuXG5cdGFwcC5iaW5kRXZlbnRzID0gZnVuY3Rpb24gKCkge1xuXHRcdC8vIFRyaWdnZXIgYSBtb2RhbCB0byBvcGVuLlxuXHRcdGFwcC4kYy5ib2R5Lm9uKCAnY2xpY2sgdG91Y2hzdGFydCcsICcubW9kYWwtdHJpZ2dlcicsIGFwcC5vcGVuTW9kYWwgKTtcblxuXHRcdC8vIFRyaWdnZXIgdGhlIGNsb3NlIGJ1dHRvbiB0byBjbG9zZSB0aGUgbW9kYWwuXG5cdFx0YXBwLiRjLmJvZHkub24oICdjbGljayB0b3VjaHN0YXJ0JywgJy5jbG9zZScsIGFwcC5jbG9zZU1vZGFsICk7XG5cblx0XHQvLyBBbGxvdyB0aGUgdXNlciB0byBjbG9zZSB0aGUgbW9kYWwgYnkgaGl0dGluZyB0aGUgZXNjIGtleS5cblx0XHRhcHAuJGMuYm9keS5vbiggJ2tleWRvd24nLCBhcHAuZXNjS2V5Q2xvc2UgKTtcblxuXHRcdC8vIEFsbG93IHRoZSB1c2VyIHRvIGNsb3NlIHRoZSBtb2RhbCBieSBjbGlja2luZyBvdXRzaWRlIG9mIHRoZSBtb2RhbC5cblx0XHRhcHAuJGMuYm9keS5vbiggJ2NsaWNrIHRvdWNoc3RhcnQnLCAnZGl2Lm1vZGFsLW9wZW4nLCBhcHAuY2xvc2VNb2RhbEJ5Q2xpY2sgKTtcblxuXHRcdC8vIExpc3RlbiB0byB0YWJzLCB0cmFwIGtleWJvYXJkIGlmIHdlIG5lZWQgdG9cblx0XHRhcHAuJGMuYm9keS5vbiggJ2tleWRvd24nLCBhcHAudHJhcEtleWJvYXJkTWF5YmUgKTtcblxuXHR9O1xuXG5cdC8vIE9wZW4gdGhlIG1vZGFsLlxuXHRhcHAub3Blbk1vZGFsID0gZnVuY3Rpb24gKCkge1xuXHRcdC8vIFN0b3JlIHRoZSBtb2RhbCB0b2dnbGUgZWxlbWVudFxuXHRcdCRtb2RhbFRvZ2dsZSA9ICQoIHRoaXMgKTtcblxuXHRcdC8vIEZpZ3VyZSBvdXQgd2hpY2ggbW9kYWwgd2UncmUgb3BlbmluZyBhbmQgc3RvcmUgdGhlIG9iamVjdC5cblx0XHR2YXIgJG1vZGFsID0gJCggJCggdGhpcyApLmRhdGEoICd0YXJnZXQnICkgKTtcblxuXHRcdC8vIERpc3BsYXkgdGhlIG1vZGFsLlxuXHRcdCRtb2RhbC5hZGRDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBBZGQgYm9keSBjbGFzcy5cblx0XHRhcHAuJGMuYm9keS5hZGRDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBGaW5kIHRoZSBmb2N1c2FibGUgY2hpbGRyZW4gb2YgdGhlIG1vZGFsLlxuXHRcdC8vIFRoaXMgbGlzdCBtYXkgYmUgaW5jb21wbGV0ZSwgcmVhbGx5IHdpc2ggalF1ZXJ5IGhhZCB0aGUgOmZvY3VzYWJsZSBwc2V1ZG8gbGlrZSBqUXVlcnkgVUkgZG9lcy5cblx0XHQvLyBGb3IgbW9yZSBhYm91dCA6aW5wdXQgc2VlOiBodHRwczovL2FwaS5qcXVlcnkuY29tL2lucHV0LXNlbGVjdG9yL1xuXHRcdCRmb2N1c2FibGVDaGlsZHJlbiA9ICRtb2RhbC5maW5kKCdhLCA6aW5wdXQsIFt0YWJpbmRleF0nKTtcblxuXHRcdC8vIElkZWFsbHksIHRoZXJlIGlzIGFsd2F5cyBvbmUgKHRoZSBjbG9zZSBidXR0b24pLCBidXQgeW91IG5ldmVyIGtub3cuXG5cdFx0aWYgKCAkZm9jdXNhYmxlQ2hpbGRyZW4ubGVuZ3RoID4gMCApIHtcblx0XHRcdC8vIFNoaWZ0IGZvY3VzIHRvIHRoZSBmaXJzdCBmb2N1c2FibGUgZWxlbWVudC5cblx0XHRcdCRmb2N1c2FibGVDaGlsZHJlblswXS5mb2N1cygpO1xuXHRcdH1cblxuXHR9O1xuXG5cdC8vIENsb3NlIHRoZSBtb2RhbC5cblx0YXBwLmNsb3NlTW9kYWwgPSBmdW5jdGlvbiAoKSB7XG5cdFx0Ly8gRmlndXJlIHRoZSBvcGVuZWQgbW9kYWwgd2UncmUgY2xvc2luZyBhbmQgc3RvcmUgdGhlIG9iamVjdC5cblx0XHR2YXIgJG1vZGFsID0gJCggJCggJ2Rpdi5tb2RhbC1vcGVuIC5jbG9zZScgKS5kYXRhKCAndGFyZ2V0JyApICk7XG5cblx0XHQvLyBGaW5kIHRoZSBpZnJhbWUgaW4gdGhlICRtb2RhbCBvYmplY3QuXG5cdFx0dmFyICRpZnJhbWUgPSAkbW9kYWwuZmluZCggJ2lmcmFtZScgKTtcblxuXHRcdC8vIE9ubHkgZG8gdGhpcyBpZiB0aGVyZSBhcmUgYW55IGlmcmFtZXMuXG5cdFx0aWYgKCAkaWZyYW1lLmxlbmd0aCApIHtcblx0XHRcdC8vIEdldCB0aGUgaWZyYW1lIHNyYyBVUkwuXG5cdFx0XHR2YXIgdXJsID0gJGlmcmFtZS5hdHRyKCAnc3JjJyApO1xuXG5cdFx0XHQvLyBSZW1vdmluZy9SZWFkZGluZyB0aGUgVVJMIHdpbGwgZWZmZWN0aXZlbHkgYnJlYWsgdGhlIFlvdVR1YmUgQVBJLlxuXHRcdFx0Ly8gU28gbGV0J3Mgbm90IGRvIHRoYXQgd2hlbiB0aGUgaWZyYW1lIFVSTCBjb250YWlucyB0aGUgZW5hYmxlanNhcGkgcGFyYW1ldGVyLlxuXHRcdFx0aWYgKCAhIHVybC5pbmNsdWRlcyggJ2VuYWJsZWpzYXBpPTEnICkgKSB7XG5cdFx0XHRcdC8vIFJlbW92ZSB0aGUgc291cmNlIFVSTCwgdGhlbiBhZGQgaXQgYmFjaywgc28gdGhlIHZpZGVvIGNhbiBiZSBwbGF5ZWQgYWdhaW4gbGF0ZXIuXG5cdFx0XHRcdCRpZnJhbWUuYXR0ciggJ3NyYycsICcnICkuYXR0ciggJ3NyYycsIHVybCApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0Ly8gVXNlIHRoZSBZb3VUdWJlIEFQSSB0byBzdG9wIHRoZSB2aWRlby5cblx0XHRcdFx0cGxheWVyLnN0b3BWaWRlbygpO1xuXHRcdFx0fVxuXHRcdH1cblxuXHRcdC8vIEZpbmFsbHksIGhpZGUgdGhlIG1vZGFsLlxuXHRcdCRtb2RhbC5yZW1vdmVDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBSZW1vdmUgdGhlIGJvZHkgY2xhc3MuXG5cdFx0YXBwLiRjLmJvZHkucmVtb3ZlQ2xhc3MoICdtb2RhbC1vcGVuJyApO1xuXG5cdFx0Ly8gUmV2ZXJ0IGZvY3VzIGJhY2sgdG8gdG9nZ2xlIGVsZW1lbnRcblx0XHQkbW9kYWxUb2dnbGUuZm9jdXMoKTtcblxuXHR9O1xuXG5cdC8vIENsb3NlIGlmIFwiZXNjXCIga2V5IGlzIHByZXNzZWQuXG5cdGFwcC5lc2NLZXlDbG9zZSA9IGZ1bmN0aW9uICggZXZlbnQgKSB7XG5cdFx0aWYgKCAyNyA9PT0gZXZlbnQua2V5Q29kZSApIHtcblx0XHRcdGFwcC5jbG9zZU1vZGFsKCk7XG5cdFx0fVxuXHR9O1xuXG5cdC8vIENsb3NlIGlmIHRoZSB1c2VyIGNsaWNrcyBvdXRzaWRlIG9mIHRoZSBtb2RhbFxuXHRhcHAuY2xvc2VNb2RhbEJ5Q2xpY2sgPSBmdW5jdGlvbiAoIGV2ZW50ICkge1xuXHRcdC8vIElmIHRoZSBwYXJlbnQgY29udGFpbmVyIGlzIE5PVCB0aGUgbW9kYWwgZGlhbG9nIGNvbnRhaW5lciwgY2xvc2UgdGhlIG1vZGFsXG5cdFx0aWYgKCAhJCggZXZlbnQudGFyZ2V0ICkucGFyZW50cyggJ2RpdicgKS5oYXNDbGFzcyggJ21vZGFsLWRpYWxvZycgKSApIHtcblx0XHRcdGFwcC5jbG9zZU1vZGFsKCk7XG5cdFx0fVxuXHR9O1xuXG5cdC8vIFRyYXAgdGhlIGtleWJvYXJkIGludG8gYSBtb2RhbCB3aGVuIG9uZSBpcyBhY3RpdmUuXG5cdGFwcC50cmFwS2V5Ym9hcmRNYXliZSA9IGZ1bmN0aW9uICggZXZlbnQgKSB7XG5cblx0XHQvLyBXZSBvbmx5IG5lZWQgdG8gZG8gc3R1ZmYgd2hlbiB0aGUgbW9kYWwgaXMgb3BlbiBhbmQgdGFiIGlzIHByZXNzZWQuXG5cdFx0aWYgKCA5ID09PSBldmVudC53aGljaCAmJiAkKCAnLm1vZGFsLW9wZW4nICkubGVuZ3RoID4gMCApIHtcblx0XHRcdHZhciAkZm9jdXNlZCA9ICQoICc6Zm9jdXMnICk7XG5cdFx0XHR2YXIgZm9jdXNJbmRleCA9ICRmb2N1c2FibGVDaGlsZHJlbi5pbmRleCggJGZvY3VzZWQgKTtcblxuXHRcdFx0aWYgKCAwID09PSBmb2N1c0luZGV4ICYmIGV2ZW50LnNoaWZ0S2V5ICkge1xuXHRcdFx0XHQvLyBJZiB0aGlzIGlzIHRoZSBmaXJzdCBmb2N1c2FibGUgZWxlbWVudCwgYW5kIHNoaWZ0IGlzIGhlbGQgd2hlbiBwcmVzc2luZyB0YWIsIGdvIGJhY2sgdG8gbGFzdCBmb2N1c2FibGUgZWxlbWVudC5cblx0XHRcdFx0JGZvY3VzYWJsZUNoaWxkcmVuWyAkZm9jdXNhYmxlQ2hpbGRyZW4ubGVuZ3RoIC0gMSBdLmZvY3VzKCk7XG5cdFx0XHRcdGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cdFx0XHR9IGVsc2UgaWYgKCAhIGV2ZW50LnNoaWZ0S2V5ICYmIGZvY3VzSW5kZXggPT09ICRmb2N1c2FibGVDaGlsZHJlbi5sZW5ndGggLSAxICkge1xuXHRcdFx0XHQvLyBJZiB0aGlzIGlzIHRoZSBsYXN0IGZvY3VzYWJsZSBlbGVtZW50LCBhbmQgc2hpZnQgaXMgbm90IGhlbGQsIGdvIGJhY2sgdG8gdGhlIGZpcnN0IGZvY3VzYWJsZSBlbGVtZW50LlxuXHRcdFx0XHQkZm9jdXNhYmxlQ2hpbGRyZW5bMF0uZm9jdXMoKTtcblx0XHRcdFx0ZXZlbnQucHJldmVudERlZmF1bHQoKTtcblx0XHRcdH1cblx0XHR9XG5cdH1cblxuXHQvLyBFbmdhZ2UhXG5cdCQoIGFwcC5pbml0ICk7XG59ICkoIHdpbmRvdywgalF1ZXJ5LCB3aW5kb3cud2RzTW9kYWwgKTtcblxuLy8gTG9hZCB0aGUgeXQgaWZyYW1lIGFwaSBqcyBmaWxlIGZyb20geW91dHViZS5cbi8vIE5PVEUgVEhFIElGUkFNRSBVUkwgTVVTVCBIQVZFICdlbmFibGVqc2FwaT0xJyBhcHBlbmRlZCB0byBpdC5cbi8vIGV4YW1wbGU6IHNyYz1cImh0dHA6Ly93d3cueW91dHViZS5jb20vZW1iZWQvTTdsYzFVVmYtVkU/ZW5hYmxlanNhcGk9MVwiXG4vLyBJdCBhbHNvIF9tdXN0XyBoYXZlIGFuIElEIGF0dHJpYnV0ZS5cbnZhciB0YWcgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTtcbnRhZy5pZCA9ICdpZnJhbWUteXQnO1xudGFnLnNyYyA9ICdodHRwczovL3d3dy55b3V0dWJlLmNvbS9pZnJhbWVfYXBpJztcbnZhciBmaXJzdFNjcmlwdFRhZyA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCdzY3JpcHQnKVswXTtcbmZpcnN0U2NyaXB0VGFnLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKHRhZywgZmlyc3RTY3JpcHRUYWcpO1xuXG4vLyBUaGlzIHZhciBhbmQgZnVuY3Rpb24gaGF2ZSB0byBiZSBhdmFpbGFibGUgZ2xvYmFsbHkgZHVlIHRvIHl0IGpzIGlmcmFtZSBhcGkuXG52YXIgcGxheWVyO1xuZnVuY3Rpb24gb25Zb3VUdWJlSWZyYW1lQVBJUmVhZHkoKSB7XG4gIHZhciBtb2RhbCA9IGpRdWVyeSgnZGl2Lm1vZGFsJyk7XG5cdHZhciBpZnJhbWVpZCA9IG1vZGFsLmZpbmQoJ2lmcmFtZScpLmF0dHIoJ2lkJyk7XG5cblx0cGxheWVyID0gbmV3IFlULlBsYXllciggaWZyYW1laWQgLCB7XG5cdFx0ZXZlbnRzOiB7XG5cdFx0XHQnb25SZWFkeSc6IG9uUGxheWVyUmVhZHksXG5cdFx0XHQnb25TdGF0ZUNoYW5nZSc6IG9uUGxheWVyU3RhdGVDaGFuZ2Vcblx0XHR9XG5cdH0pO1xufVxuXG5mdW5jdGlvbiBvblBsYXllclJlYWR5KGV2ZW50KSB7XG5cbn1cblxuZnVuY3Rpb24gb25QbGF5ZXJTdGF0ZUNoYW5nZSggZXZlbnQgKSB7XG5cdC8vIFNldCBmb2N1cyB0byB0aGUgZmlyc3QgZm9jdXNhYmxlIGVsZW1lbnQgaW5zaWRlIG9mIHRoZSBtb2RhbCB0aGUgcGxheWVyIGlzIGluLlxuXHRqUXVlcnkoIGV2ZW50LnRhcmdldC5hICkucGFyZW50cyggJy5tb2RhbCcgKS5maW5kKCdhLCA6aW5wdXQsIFt0YWJpbmRleF0nKS5maXJzdCgpLmZvY3VzKCk7XG59XG4iLCIvKipcbiAqIEZpbGUgc2tpcC1saW5rLWZvY3VzLWZpeC5qcy5cbiAqXG4gKiBIZWxwcyB3aXRoIGFjY2Vzc2liaWxpdHkgZm9yIGtleWJvYXJkIG9ubHkgdXNlcnMuXG4gKlxuICogTGVhcm4gbW9yZTogaHR0cHM6Ly9naXQuaW8vdldkcjJcbiAqL1xuKCBmdW5jdGlvbiAoKSB7XG5cdHZhciBpc1dlYmtpdCA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnd2Via2l0JyApID4gLTEsXG5cdFx0aXNPcGVyYSA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnb3BlcmEnICkgPiAtMSxcblx0XHRpc0llID0gbmF2aWdhdG9yLnVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpLmluZGV4T2YoICdtc2llJyApID4gLTE7XG5cblx0aWYgKCAoIGlzV2Via2l0IHx8IGlzT3BlcmEgfHwgaXNJZSApICYmIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkICYmIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyICkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCAnaGFzaGNoYW5nZScsIGZ1bmN0aW9uICgpIHtcblx0XHRcdHZhciBpZCA9IGxvY2F0aW9uLmhhc2guc3Vic3RyaW5nKCAxICksXG5cdFx0XHRcdGVsZW1lbnQ7XG5cblx0XHRcdGlmICggISggL15bQS16MC05Xy1dKyQvICkudGVzdCggaWQgKSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRlbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIGlkICk7XG5cblx0XHRcdGlmICggZWxlbWVudCApIHtcblx0XHRcdFx0aWYgKCAhKCAvXig/OmF8c2VsZWN0fGlucHV0fGJ1dHRvbnx0ZXh0YXJlYSkkL2kgKS50ZXN0KCBlbGVtZW50LnRhZ05hbWUgKSApIHtcblx0XHRcdFx0XHRlbGVtZW50LnRhYkluZGV4ID0gLTE7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRlbGVtZW50LmZvY3VzKCk7XG5cdFx0XHR9XG5cdFx0fSwgZmFsc2UgKTtcblx0fVxufSApKCk7XG4iLCIvKipcbiAqIEZpbGUgc2lkZWJhci5qc1xuICpcbiAqIFRvZ2dsZSBTaWRlYmFyXG4gKi9cblxudmFyIHNpZGViYXJSaWdodCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnc2lkZWJhci1zbGlkaW5nLXBhbmVsJyApLFxuXHRzaG93UmlnaHRQdXNoID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoICdzaWRlYmFyLXRvZ2dsZS1idXR0b24nICksXG5cdGJvZHkgPSBkb2N1bWVudC5ib2R5O1xuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpIHtcbiAgLyogQ2hlY2sgd2lkdGggb24gcGFnZSBsb2FkKi9cbiAgaWYgKCAkKHdpbmRvdykud2lkdGgoKSA+IDEyODApIHtcblx0XHRjbGFzc2llLnJlbW92ZSggYm9keSwgJ3NpZGViYXItcHVzaC10b2xlZnQnICk7XG5cblx0Ly9cdGNsYXNzaWUuYWRkKCBzaWRlYmFyUmlnaHQsICdvcGVuJyApO1xuLy9cdFx0Y2xhc3NpZS5hZGQoIHNob3dSaWdodFB1c2gsICdvcGVuJyk7XG5cblx0XHRzaG93UmlnaHRQdXNoLm9uY2xpY2sgPSBmdW5jdGlvbigpIHtcblx0XHRcdGNsYXNzaWUudG9nZ2xlKCBib2R5LCAnc2lkZWJhci1wdXNoLXRvbGVmdCcgKTtcblx0XHRcdGNsYXNzaWUudG9nZ2xlKCBzaWRlYmFyUmlnaHQsICdvcGVuJyApO1xuXHRcdFx0Y2xhc3NpZS50b2dnbGUoIHNob3dSaWdodFB1c2gsICdvcGVuJyk7XHRcdH1cblx0fVxuXG5cdGVsc2Uge1xuXHRcdGNsYXNzaWUucmVtb3ZlKCBib2R5LCAnc2lkZWJhci1wdXNoLXRvbGVmdCcgKTtcblxuXHRcdHNob3dSaWdodFB1c2gub25jbGljayA9IGZ1bmN0aW9uKCkge1xuXHRcdFx0Y2xhc3NpZS50b2dnbGUoIGJvZHksICdzaWRlYmFyLXB1c2gtdG9sZWZ0JyApO1xuXHRcdFx0Y2xhc3NpZS50b2dnbGUoIHNpZGViYXJSaWdodCwgJ29wZW4nICk7XG5cdFx0XHRjbGFzc2llLnRvZ2dsZSggc2hvd1JpZ2h0UHVzaCwgJ29wZW4nKTtcblx0XHR9XG4gIH1cbn0pO1xuIiwiLyoqXG4gKiBGaWxlIHdpbmRvdy1yZWFkeS5qc1xuICpcbiAqIEFkZCBhIFwicmVhZHlcIiBjbGFzcyB0byA8Ym9keT4gd2hlbiB3aW5kb3cgaXMgcmVhZHkuXG4gKi9cbndpbmRvdy53ZHNXaW5kb3dSZWFkeSA9IHt9O1xuKCBmdW5jdGlvbiAoIHdpbmRvdywgJCwgYXBwICkge1xuXHQvLyBDb25zdHJ1Y3Rvci5cblx0YXBwLmluaXQgPSBmdW5jdGlvbiAoKSB7XG5cdFx0YXBwLmNhY2hlKCk7XG5cdFx0YXBwLmJpbmRFdmVudHMoKTtcblx0fTtcblxuXHQvLyBDYWNoZSBkb2N1bWVudCBlbGVtZW50cy5cblx0YXBwLmNhY2hlID0gZnVuY3Rpb24gKCkge1xuXHRcdGFwcC4kYyA9IHtcblx0XHRcdCd3aW5kb3cnOiAkKCB3aW5kb3cgKSxcblx0XHRcdCdib2R5JzogJCggZG9jdW1lbnQuYm9keSApXG5cdFx0fTtcblx0fTtcblxuXHQvLyBDb21iaW5lIGFsbCBldmVudHMuXG5cdGFwcC5iaW5kRXZlbnRzID0gZnVuY3Rpb24gKCkge1xuXHRcdGFwcC4kYy53aW5kb3cubG9hZCggYXBwLmFkZEJvZHlDbGFzcyApO1xuXHR9O1xuXG5cdC8vIEFkZCBhIGNsYXNzIHRvIDxib2R5Pi5cblx0YXBwLmFkZEJvZHlDbGFzcyA9IGZ1bmN0aW9uICgpIHtcblx0XHRhcHAuJGMuYm9keS5hZGRDbGFzcyggJ3JlYWR5JyApO1xuXHR9O1xuXG5cdC8vIEVuZ2FnZSFcblx0JCggYXBwLmluaXQgKTtcbn0gKSggd2luZG93LCBqUXVlcnksIHdpbmRvdy53ZHNXaW5kb3dSZWFkeSApO1xuIl19
