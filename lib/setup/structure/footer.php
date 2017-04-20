<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Custom footer 'creds' text
add_filter( 'genesis_footer_output', function () {
	 return '<p>[footer_childtheme_link before="" after=""] by <a href="#">ThematicPress</a></p>';
});

// ** Disable pointer events when scrolling. Be careful using this with CSS :hover-enabled menus
// Disabled by default (uncomment the line below to activate)
//add_action( 'wp_footer', 'g_starter_disable_pointer_events_on_scroll', 99 );
function g_starter_disable_pointer_events_on_scroll() {
	ob_start();
	?><script>
		if( window.addEventListener ) {
			var root = document.documentElement;
			var timer;

			window.addEventListener('scroll', function() {
				clearTimeout(timer);

				if (!root.style.pointerEvents) {
					root.style.pointerEvents = 'none';
				}

				timer = setTimeout(function() {
					root.style.pointerEvents = '';
				}, 250);
			}, false);
		}
	</script>
	<?php
	$output = ob_get_clean();
	echo preg_replace( '/\s+/', ' ', $output ) . "\n";
}