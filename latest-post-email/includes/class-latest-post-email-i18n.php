<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.wpelk.com
 * @since      1.0.0
 *
 * @package    Latest_Post_Email
 * @subpackage Latest_Post_Email/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Latest_Post_Email
 * @subpackage Latest_Post_Email/includes
 * @author     WP Elk <admin@wpelk.com>
 */
class Latest_Post_Email_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'latest-post-email',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
