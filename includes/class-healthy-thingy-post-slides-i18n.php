<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://healthythingy.com/
 * @since      1.0.0
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/includes
 * @author     Ramen Das <ramend3@gmail.com>
 */
class Healthy_Thingy_Post_Slides_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'healthy-thingy-post-slides',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
