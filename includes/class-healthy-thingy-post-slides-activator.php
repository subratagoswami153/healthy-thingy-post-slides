<?php

/**
 * Fired during plugin activation
 *
 * @link       https://healthythingy.com/
 * @since      1.0.0
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/includes
 * @author     Ramen Das <ramend3@gmail.com>
 */
class Healthy_Thingy_Post_Slides_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
            if(empty(get_option('ht_post_slides_data'))){
                $str = file_get_contents(UTM_JSON);
                $default_data = json_decode($str, true);
                update_option('ht_post_slides_data', $default_data);
            }
        }

}
