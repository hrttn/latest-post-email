<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.wpelk.com
 * @since             1.0.0
 * @package           Latest_Post_Email
 *
 * @wordpress-plugin
 * Plugin Name:       Latest Post in Email
 * Plugin URI:        https://github.com/hrttn/latest-post-email
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            WP Elk
 * Author URI:        https://www.wpelk.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       latest-post-email
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-latest-post-email-activator.php
 */
function activate_latest_post_email() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-latest-post-email-activator.php';
	Latest_Post_Email_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-latest-post-email-deactivator.php
 */
function deactivate_latest_post_email() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-latest-post-email-deactivator.php';
	Latest_Post_Email_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_latest_post_email' );
register_deactivation_hook( __FILE__, 'deactivate_latest_post_email' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-latest-post-email.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_latest_post_email() {

	$plugin = new Latest_Post_Email();
	$plugin->run();

}
run_latest_post_email();
