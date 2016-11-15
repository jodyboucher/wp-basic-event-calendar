<?php

/**
 * WordPress Basic Event Calendar widget: Uninstall
 *
 * The WordPress Basic Event Calendar widget is a very basic lightweight
 * interface for displaying events on a monthly calendar view.
 *
 * Uninstall code is fired when the Basic Event Calendar widget is uninstalled.
 *
 * @since      1.0.0
 * @version    1.0.0
 */

namespace JodyBoucher\Wordpress\BasicEventCalendar;

// If uninstall is not called from WordPress, exit!
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$option_name = '_bec_event_data';
delete_option( $option_name );

// For site options in multi-site.
delete_site_option( $option_name );
