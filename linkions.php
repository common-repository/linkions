<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://linkions.com
 * @since             1.0.0
 * @package           Linkions
 *
 * @wordpress-plugin
 * Plugin Name:       Linkions
 * Plugin URI:        https://wordpress.org/plugins/linkions/
 * Description:       Linkions helps to create a bio short link page to link your social profiles.
 * Version:           1.0.1
 * Author:            Linkions
 * Author URI:        https://linkions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       linkions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LINKIONS_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-linkions-activator.php
 */
function activate_linkions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-linkions-activator.php';
	Linkions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-linkions-deactivator.php
 */
function deactivate_linkions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-linkions-deactivator.php';
	Linkions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_linkions' );
register_deactivation_hook( __FILE__, 'deactivate_linkions' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-linkions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_linkions() {

	$plugin = new Linkions();
	$plugin->run();

}
run_linkions();
