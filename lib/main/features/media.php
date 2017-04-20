<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Change the media manager default view to 'upload', instead of 'library'
// See: http://wordpress.stackexchange.com/questions/96513/how-to-make-upload-filesselected-by-default-in-insert-media
add_action( 'admin_footer-post-new.php', 'g_starter_media_manager_default_view' );
add_action( 'admin_footer-post.php', 'g_starter_media_manager_default_view' );
function g_starter_media_manager_default_view() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
		});
	</script>
	<?php
}

// ** Prevent authors and contributors from seeing media that isn't theirs
// See: http://wordpress.org/support/topic/restrict-editors-from-viewing-media-that-others-have-uploaded
add_filter( 'posts_where', function ( $where ) {
	global $current_user;
	if(
		is_admin() &&
		!current_user_can('edit_others_posts') &&
		isset($_POST['action']) &&
		$_POST['action'] === 'query-attachments'
	) {
		$where .= ' AND post_author=' . $current_user->data->ID;
	}
	return $where;
});

// ** Remove the injected styles for the [gallery] shortcode
add_filter( 'gallery_style', function ( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
});

// ** Change WP JPEG compression (WP default is 90%)
// See: http://wpmu.org/how-to-change-jpeg-compression-in-wordpress/
// Disabled by default (uncomment the line below to activate)
//add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );