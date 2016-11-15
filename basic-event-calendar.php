<?php

/**
 * Basic Event Calendar WordPress widget: bootstrap
 *
 * The Basic Event Calendar WordPress widget is a very basic lightweight
 * interface for displaying events on a monthly calendar view.
 *
 * Requires WordPress v4.5+ due to use of wp_add_inline_script.
 *
 * @since      1.0.0
 * @version    1.0.0
 *
 *
 * @wordpress-plugin
 * Plugin Name:  WordPress Basic Event Calendar
 * Plugin URI:   https://github.com/jodyboucher/wp-basic-event-calendar
 * Description:  A very basic lightweight interface for displaying events on a monthly calendar view.
 * Version:      1.0.0
 * Author:       Jody Boucher
 * Author URI:   https://jodyboucher.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:  /languages
 * Text Domain:  wp-basic-event-calendar
 *
 * --------------------------------------------------------------------------------
 * WordPress Basic Event Calendar Widget
 * Copyright (C) 2016  Jody Boucher
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 * --------------------------------------------------------------------------------
 */

namespace JodyBoucher\Wordpress\BasicEventCalendar;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-basic-event-calendar-activator.php
 */
function activate_basic_event_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-event-calendar-activator.php';
	Basic_Event_Calendar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-basic-event-calendar-deactivator.php
 */
function deactivate_basic_event_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-event-calendar-deactivator.php';
	Basic_Event_Calendar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_basic_event_calendar' );
register_deactivation_hook( __FILE__, 'deactivate_basic_event_calendar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-basic-event-calendar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_basic_event_calendar() {

	$plugin = new Basic_Event_Calendar();
	$plugin->run();

}

run_basic_event_calendar();
