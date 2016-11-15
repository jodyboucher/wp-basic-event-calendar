<?php
/**
 * Basic Event Calendar WordPress widget: Basic_Event_Calendar_Widget class
 *
 * The Basic Event Calendar WordPress widget is a very basic lightweight
 * interface for displaying events on a monthly calendar view.
 *
 * The Basic_Event_Calendar_Widget class extends WP_Widget to provide the main
 * functionality of the Basic Event Calendar widget.
 *
 * @since      1.0.0
 */

namespace JodyBoucher\Wordpress\BasicEventCalendar;

use WP_Widget;

// Exit if accessed directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Basic_Event_Calendar_Widget
 */
class Basic_Event_Calendar_Widget extends WP_Widget {
	/**
	 * Default title to display on the widget
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	const DEFAULT_TITLE = 'Event Calendar';

	/**
	 * Default number of seconds to cache events data
	 *
	 * @since 1.0.0
	 *
	 * @type int
	 */
	const DEFAULT_CACHE_SECONDS = 900;

	/**
	 * Name of the default file containing client-side javascript used by widget.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	const DEFAULT_CSS = 'basic-event-calendar.min.css';

	/**
	 * Name of the default file containing client-side CSS used by the widget.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	const DEFAULT_JS = 'basic-event-calendar.min.js';

	public $script_content = '';

	/**
	 * Sets up a new Basic_Event_Calendar_Widget instance.
	 */
	public function __construct() {
		$widget_options = array(
			'classname'   => 'widget_basic_event_calendar',
			'description' => __( 'Displays calendar of upcoming events', 'bec-domain' ),
		);

		$control_options = array();

		parent::__construct(
			'basic_event_calendar', // Widget base ID
			__( 'Basic Event Calendar', 'bec-domain' ), // Widget name.
			$widget_options,
			$control_options
		);
	}

	/**
	 * Front-end display of widget.
	 * Outputs the content for the current Text widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // WPCS: XSS ok.

		$in_title = Array_Helper::get_value_or_default( 'title', $instance, self::DEFAULT_TITLE );
		$title    = apply_filters( 'widget_title', $in_title );

		$in_cache_seconds = Array_Helper::get_value_or_default( 'cache_seconds', $instance, self::DEFAULT_CACHE_SECONDS );
		$cache_seconds    = empty( $in_cache_seconds ) ? self::DEFAULT_CACHE_SECONDS : (int) $in_cache_seconds;

		$in_events_url = Array_Helper::get_value_or_default( 'events_url', $instance, '' );

		$calendar_data  = $this->get_events_data( $in_events_url, $cache_seconds );
		$script_content = $this->get_inline_script( $in_events_url, $calendar_data );

		wp_add_inline_script( 'basicEventCalendar-script', $this->get_inline_script( $in_events_url, $script_content ), 'after' );

		echo '<div class="bec-widget">';
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // WPCS: XSS ok.
		}

		echo '<div class="bec-container"></div>';
		echo '</div>';

		/*
		<div class="bec-widget">
			<?php
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title']; // WPCS: XSS ok.
				?>
				<a href="<?php echo esc_url( $calendar_data->url ); ?>" target="_blank">
					<?php echo esc_html( $title ); ?>
				</a>
				<?php echo $args['after_title']; // WPCS: XSS ok.
			}
			?>

			<div class="bec-container"></div>
			<ul>
				<?php
				$count = 0;
				foreach ( $calendar_data->events as $event ) {
					$event_name = $event->description;
					$event_date = $event->date
					?>
					<li class="fs-event">
						<a href="<?php echo esc_url( $event->url ); ?>">
							<div class="fs-event-name"><?php echo esc_html( $event_name ); ?></div>
							<div class="fs-event-date"><?php echo esc_html( $event_date ); ?></div>
						</a>
					</li>
					<?php
					$count ++;
					if ( $count >= $max_events ) {
						break;
					}
				}
				?>
			</ul>
		</div>
		*/

		echo $args['after_widget']; // WPCS: XSS ok.
	}

	/**
	 * Back-end widget form.
	 * Outputs the widget settings form in the admin
	 *
	 * @param array $instance The current widget settings - previously saved values from database.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : __( self::DEFAULT_TITLE, 'bec-domain' );
		$title_id   = $this->get_field_id( 'title' );
		$title_name = $this->get_field_name( 'title' );

		$cache_seconds      = ! empty( $instance['cache_seconds'] ) ? $instance['cache_seconds'] : self::DEFAULT_CACHE_SECONDS;
		$cache_seconds_id   = $this->get_field_id( 'cache_seconds' );
		$cache_seconds_name = $this->get_field_name( 'cache_seconds' );

		$events_url      = ! empty( $instance['events_url'] ) ? $instance['events_url'] : '';
		$events_url_id   = $this->get_field_id( 'events_url' );
		$events_url_name = $this->get_field_name( 'events_url' );
		?>
		<p>
			<label for="<?php echo esc_attr( $title_id ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
			<input type="text" class="widefat"
			       id="<?php echo esc_attr( $title_id ); ?>"
			       name="<?php echo esc_attr( $title_name ); ?>"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $events_url_id ); ?>"><?php esc_html_e( 'Events URL:' ); ?></label>
			<input type="text" class="widefat"
			       id="<?php echo esc_attr( $events_url_id ); ?>"
			       name="<?php echo esc_attr( $events_url_name ); ?>"
			       value="<?php echo esc_attr( $events_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $cache_seconds_id ); ?>">
				<?php esc_html_e( 'Cache duration (seconds):' ); ?>
			</label>
			<input type="number" class="small-text"
			       id="<?php echo esc_attr( $cache_seconds_id ); ?>"
			       name="<?php echo esc_attr( $cache_seconds_name ); ?>"
			       value="<?php echo esc_attr( $cache_seconds ); ?>">
		</p>
		<?php
	}

	/**
	 * Handles updating settings for the current widget instance.
	 * Sanitizes widget form values to be saved.
	 *
	 * @param array $new_instance New settings for this instance as input by the user.
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$title             = $new_instance['title'];
		$instance['title'] = ( ! empty( $title ) ) ? sanitize_text_field( $title ) : self::DEFAULT_TITLE;

		$events_url             = $new_instance['events_url'];
		$instance['events_url'] = ( ! empty( $events_url ) ) ? esc_url_raw( $events_url ) : '';

		$cache_seconds             = (int) $new_instance['cache_seconds'];
		$cache_seconds             = ( $cache_seconds > 0 ) ? $cache_seconds : self::DEFAULT_CACHE_SECONDS;
		$instance['cache_seconds'] = $cache_seconds;

		return $instance;
	}

	/**
	 * Retrieve event data from source or cache as appropriate.
	 *
	 * @param string $url           The url the events data is retrieved from.
	 * @param int    $cache_seconds The number of seconds to cache the events data.
	 *
	 * @return array|mixed|object
	 */
	private function get_events_data( $url, $cache_seconds ) {
		$option_name = '_bec_event_data';
		$fs_options  = get_option( $option_name );

		$events    = array();
		$do_update = false;
		if ( isset( $fs_options['last_update'] ) ) {
			$time_of_last_fetch = intval( $fs_options['last_update'] );

			// Update the events if cache duration has expired.
			if ( ( time() - $time_of_last_fetch ) > $cache_seconds ) {
				$do_update = true;
			} else {
				if ( isset( $fs_options['events_data'] )
				     && is_array( $fs_options['events_data']->events )
				) {
					$events = $fs_options['events_data'];
				} else {
					echo 'invalid options';
					$do_update = true;
				}
			}
		} else {
			$do_update = true;
		}

		if ( $do_update ) {
			$response = wp_safe_remote_get( $url );

			if ( is_array( $response ) && ! is_wp_error( $response ) ) {
				$events = json_decode( $response['body'] );
			}

			$fs_options = array( 'last_update' => time(), 'events_data' => $events );
			update_option( $option_name, $fs_options );
		}

		return $events;
	}

	/**
	 * Gets the script that initializes the event calendar.
	 *
	 * @param string $events_url   The URL event data is retrieved from.
	 * @param string $initial_data The initial event data.
	 *
	 * @return string
	 */
	public function get_inline_script( $events_url, $initial_data ) {
		$content = 'BasicEventCalendar.show({ eventsUrl: \'' . $events_url . '\' });';

		return $content;
	}
}
