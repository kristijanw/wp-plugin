<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              webpro.com
 * @since             1.0.0
 * @package           Webpro
 *
 * @wordpress-plugin
 * Plugin Name:       WebPro
 * Plugin URI:        webpro.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Kristijan
 * Author URI:        webpro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       webpro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WEBPRO_VERSION', '1.0.0' );

define( 'WEBPRO_ADMIN_PREFIX', 'webp_' );
define( 'WEBPRO_ADMIN_PAGE_PREFIX', 'webpro_page_webp_' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webpro-activator.php
 */
function activate_webpro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webpro-activator.php';
	Webpro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webpro-deactivator.php
 */
function deactivate_webpro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webpro-deactivator.php';
	Webpro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webpro' );
register_deactivation_hook( __FILE__, 'deactivate_webpro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webpro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webpro() {

	$plugin = new Webpro();
	$plugin->run();

}
run_webpro();
