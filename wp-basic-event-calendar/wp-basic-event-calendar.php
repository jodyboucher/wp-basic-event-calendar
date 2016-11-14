<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jodyboucher.com
 * @since             1.0.0
 * @package           Wp_Basic_Event_Calendar
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Basic Event Calendar
 * Plugin URI:        https://github.com/jodyboucher/wp-basic-event-calendar
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jody Boucher
 * Author URI:        https://jodyboucher.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-basic-event-calendar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-basic-event-calendar-activator.php
 */
function activate_wp_basic_event_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-basic-event-calendar-activator.php';
	Wp_Basic_Event_Calendar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-basic-event-calendar-deactivator.php
 */
function deactivate_wp_basic_event_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-basic-event-calendar-deactivator.php';
	Wp_Basic_Event_Calendar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_basic_event_calendar' );
register_deactivation_hook( __FILE__, 'deactivate_wp_basic_event_calendar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-basic-event-calendar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_basic_event_calendar() {

	$plugin = new Wp_Basic_Event_Calendar();
	$plugin->run();

}
run_wp_basic_event_calendar();
