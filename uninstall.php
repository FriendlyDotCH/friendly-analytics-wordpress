<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

delete_option( 'fa_tracking_code' );
delete_option( 'track_logged_in' );
delete_option('fa_tag_manager_id');
delete_option('fa_server');

// For site options in Multisite
delete_site_option( 'fa_tracking_code' );
delete_site_option( 'track_logged_in' );
delete_site_option( 'fa_tag_manager_id' );
delete_site_option( 'fa_server' );

?>
