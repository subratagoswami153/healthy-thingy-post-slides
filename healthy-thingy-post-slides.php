
<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://healthythingy.com/
 * @since             1.0.0
 * @package           Healthy_Thingy_Post_Slides
 *
 * @wordpress-plugin
 * Plugin Name:       Healthy thingy post slides
 * Plugin URI:        https://healthythingy.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.5.7
 * Author:            Elmi Media
 * Author URI:        https://healthythingy.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       healthy-thingy-post-slides
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
define( 'HEALTHY_THINGY_POST_SLIDES_VERSION', '1.5.7' );
define('UTM_JSON',plugin_dir_path(__FILE__) . 'admin/json/utm.json');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-healthy-thingy-post-slides-activator.php
 */
function activate_healthy_thingy_post_slides() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-healthy-thingy-post-slides-activator.php';
	Healthy_Thingy_Post_Slides_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-healthy-thingy-post-slides-deactivator.php
 */
function deactivate_healthy_thingy_post_slides() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-healthy-thingy-post-slides-deactivator.php';
	Healthy_Thingy_Post_Slides_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_healthy_thingy_post_slides' );
register_deactivation_hook( __FILE__, 'deactivate_healthy_thingy_post_slides' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-healthy-thingy-post-slides.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_healthy_thingy_post_slides() {

	$plugin = new Healthy_Thingy_Post_Slides();
	$plugin->run();

}
run_healthy_thingy_post_slides();

// require_once( plugin_dir_path( __FILE__ ) . 'class-plugin-updater.php' );

// if ( is_admin() ) {
//     new WPFDGitHubPluginUpdater( __FILE__, 'subratagoswami153', "healthy-thingy-post-slides" );
// }
if( ! class_exists( 'Smashing_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( 'subratagoswami153' );
$updater->set_repository( 'healthy-thingy-post-slides' );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();