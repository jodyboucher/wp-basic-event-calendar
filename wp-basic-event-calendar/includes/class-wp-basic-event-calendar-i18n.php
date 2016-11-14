<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://jodyboucher.com
 * @since      1.0.0
 *
 * @package    Wp_Basic_Event_Calendar
 * @subpackage Wp_Basic_Event_Calendar/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Basic_Event_Calendar
 * @subpackage Wp_Basic_Event_Calendar/includes
 * @author     Jody Boucher <jody@jodyboucher.com>
 */
class Wp_Basic_Event_Calendar_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-basic-event-calendar',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
