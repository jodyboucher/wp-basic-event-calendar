<?php

namespace JodyBoucher\Wordpress\BasicEventCalendar;

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 */
class Basic_Event_Calendar_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style(
			'basic-event-calendar',
			plugin_dir_url( __FILE__ ) . 'css/basic-event-calendar.min.css',
			array(),
			$this->version,
			'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			'basic-event-calendar',
			plugin_dir_url( __FILE__ ) . 'js/basic-event-calendar.min.js',
			array( 'jquery' ),
			$this->version,
			false );

	}

}
