<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://healthythingy.com/
 * @since      1.0.0
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/admin
 * @author     Ramen Das <ramend3@gmail.com>
 */
class Healthy_Thingy_Post_Slides_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;
    public $default_data;
    public static $post_style;
    public static $post_style_mobile;
    public static $utm_fetch;
    public static $utm_exists = FALSE;
    public static $desktop_qty;
    public static $mobile_qty;
    public static $utm_arr;
    public static $total_pages;
    public static $desktop_first_slide;
    public static $mobile_first_image;
    public static $desktop_first_image;
    public static $mobile_first_slide;
    public static $first_slide;
    public static $first_image;
    public static $left_ads_layout;
    public static $right_ads_layout;
    public static $ads_unit_for_action_trigger;
    public static $hide_prev_button_mobile;
    public static $next_prev_button_style_desktop;
    public static $desktop_fixed_content_ajax;
    public static $mobile_fixed_content_ajax;
    public static $layout_qty_ajax;
    public static $periodical_yes;
    public static $periodical_interval;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_menu', array(&$this, 'ht_menu_page'));
        add_action('the_post', array(&$this, 'post_display_by_utm'), 10, 2);
        add_action('wp_ajax_tps_get_slides', array(&$this, 'test_overridr_ajax'), 8);
        add_action('wp_ajax_nopriv_tps_get_slides', array(&$this, 'test_overridr_ajax'), 8);
        // add_action('init', array(&$this, 'test_cookie'));
        self::$total_pages = 2;
        self::$hide_prev_button_mobile = get_option('hide_previous_button');
        self::$next_prev_button_style_desktop = get_option('next_prev_button_style_desktop');
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Healthy_Thingy_Post_Slides_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Healthy_Thingy_Post_Slides_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name . 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . 'select2-css', plugin_dir_url(__FILE__) . 'css/select2.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/healthy-thingy-post-slides-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Healthy_Thingy_Post_Slides_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Healthy_Thingy_Post_Slides_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name . 'select2-js', plugin_dir_url(__FILE__) . 'js/select2.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/healthy-thingy-post-slides-admin.js', array('jquery'), $this->version, false);
    }

    /**
     * Add custom menu page
     */
    public function ht_menu_page() {
        add_menu_page('Post slides settings', 'Post slides settings', 'manage_options', 'post-slides-settings', array($this, 'post_slides_settings_callback'), 'dashicons-admin-generic', 9);

        // add_menu_page('Conversion pixel settings', 'Conversion pixel settings', 'manage_options', 'conversion-pixel-settings', array($this, 'conversion_pixel_settings_callback'), 'dashicons-admin-generic', 9);
        //add_submenu_page('post-slides-settings', 'Utm Source Settings', 'Utm Source Settings', 'manage_options', 'utm-source-settings', array($this, 'utm_source_settings_callback'));

        add_submenu_page('post-slides-settings', 'Conversion pixel settings', 'Conversion pixel settings', 'manage_options', 'conversion-pixel-settings', array($this, 'conversion_pixel_settings_callback'));

        add_submenu_page('post-slides-settings', 'Ads settings', 'Ads Settings', 'manage_options', 'ads-settings-page', array($this, 'ads_settings_callback'));
    }

    /**
     * Settings page callback.
     */
    public function post_slides_settings_callback() {
        include ( plugin_dir_path(dirname(__FILE__)) . 'admin/partials/utm_source.php' );
    }

    /**
     * Settings page callback.
     */
    public function utm_source_settings_callback() {
        include ( plugin_dir_path(dirname(__FILE__)) . 'admin/partials/utm_source.php' );
    }

    /**
     * Ads Settings page callback.
     */
    public function ads_settings_callback() {
        // include ( plugin_dir_path(dirname(__FILE__)) . 'admin/partials/healthy-thingy-post-slides-settings.php' );
        include ( plugin_dir_path(dirname(__FILE__)) . 'admin/partials/ads-settings.php' );
    }

    /**
     * Conversion pixel Settings page callback.
     */
    public function conversion_pixel_settings_callback() {
        include ( plugin_dir_path(dirname(__FILE__)) . 'admin/partials/conversion-pixel-settings.php' );
    }

    /**
     * Register the settings fields
     */
    public function ht_register_settings() {
        //add option name with default value
        // add_option('ht_utm_source', 'default');
        add_option('ht_utm_source_list', '');
        add_option('cp_sctipts_list', '');
        add_option('ht_default_traffic_value', 'none');
        add_option('ht_default_traffic_value_mobile', 'none');
        add_option('ht_long_fixed_content_qty', '5');
        add_option('ht_long_fixed_content_qty_mobile', '5');
        add_option('ht_show_first_slide', 'yes');
        add_option('ht_ads_settings', '');
        add_option('sidebar_ads_settings', '');
        add_option('action_triggered_ads_settings', '');

        //register option name
        // register_setting('ht_options_group', 'ht_utm_source');
        register_setting('ht_options_group', 'ht_utm_source_list');
        register_setting('ht_options_group', 'cp_sctipts_list');
        register_setting('ht_options_group', 'ht_default_traffic_value');
        register_setting('ht_options_group', 'ht_default_traffic_value_mobile');
        register_setting('ht_options_group', 'ht_long_fixed_content_qty');
        register_setting('ht_options_group', 'ht_long_fixed_content_qty_mobile');
        register_setting('ht_options_group', 'ht_show_first_slide');
        register_setting('ht_options_group', 'ht_ads_settings');
        register_setting('ht_options_group', 'sidebar_ads_settings');
        register_setting('ht_options_group', 'action_triggered_ads_settings');
    }

    /**
     * Add utm value to post details page url
     */
    public function ht_append_query_string($url, $post) {
        $utm_source = get_option('ht_utm_source');
        return esc_url(add_query_arg('utm_source', $utm_source, $url));
        //$url.'?utm_source='.$utm_source;
    }

    /**
     * Page break pagination
     */
    public function page_break_pagination(array $data, $limit) {
        if (empty($data))
            return FALSE;
        //$limit = 2;
        $total_pages = ceil(count($data) / $limit);
        $new_arr = [];

        for ($i = 1; $i <= $total_pages; $i++) {

            $start_from = ($i - 1) * $limit;
            $end_from = ($i) * $limit;

            for ($start_from; $start_from < $end_from; $start_from++) {
                $new_arr[$i - 1] .= (array_key_exists($start_from, $data)) ? $data[$start_from] . '<br>' : '';
            }
        }
        return $new_arr;
    }

    /**
     * Parse blocks content and return combine block data for each content
     */
    public function get_blocks_data($blocks_data, $class) {
        $content = '';

        if (!empty($blocks_data)) {
            $total_blocks = parse_blocks($blocks_data);

            if (!empty($total_blocks)) {
                foreach ($total_blocks as $each_block) {
                    //$content .= $each_block['innerHTML'];
                    if (trim($each_block['innerHTML']) == '<br>') {
                        $content .= '<br>';
                    } else {
                        $content .= apply_filters('the_content', render_block($each_block));
                    }
                }
            }
        }
        $content = '<div class="healthy-thingy-' . $class . '">' . $content . '</div>';
        return $content;
    }

    /**
     * Set post display condition by utm value
     */
    public function post_display_by_utm($post, $query) {


        $qty = self::$desktop_qty;
        $mobile_qty = self::$mobile_qty;

        if (($post->post_type == 'post' and $query->is_singular('post')) && false !== strpos($post->post_content, '<!--nextpage-->')) {
            // check if utm_source not present
            if (!self::$utm_exists)
                return FALSE;
            if (wp_is_mobile()):

                // mobile version
                if (empty($mobile_qty) || $mobile_qty < 1)
                    return FALSE;
                $this->post_slides_traffic(self::$post_style_mobile, $mobile_qty, self::$mobile_first_slide, TRUE);

            else:
                // desktop version

                if (empty($qty) || $qty < 1)
                    return FALSE;
                $this->post_slides_traffic(self::$post_style, $qty, self::$desktop_first_slide);
            endif;
        }
    }

    /**
     * Pagination functionality
     */
    public function post_slides_traffic(string $style, $quantity, $first_slides, $mobile = FALSE) {
        global $pages, $page;

        if (empty($style)):
            return FALSE;
        endif;


        if ($style == 'long-form-fixed') {
            if ($mobile && self::$mobile_fixed_content_ajax != 'yes') {
                if ($first_slides == 'yes') {
                    for ($i = 0; $i < $quantity - 1; $i++) {
                        array_splice($pages, 1, 0, array(' '));
                    }
                } else {
                    // array_shift($pages);
                }
                $pages = $this->page_break_pagination($pages, $quantity);
            } elseif (!$mobile && self::$desktop_fixed_content_ajax != 'yes') {
                if ($first_slides == 'yes') {
                    for ($i = 0; $i < $quantity - 1; $i++) {
                        array_splice($pages, 1, 0, array(' '));
                    }
                } else {
                    // array_shift($pages);
                }
                $pages = $this->page_break_pagination($pages, $quantity);
            } else {
                $post_content_html = [];
                
                foreach ($pages as $key => $p_co) {
                    $class = ($_COOKIE['load_content']=='true')?'p-none':'p-show';
                    if ($key > $quantity)
                        $class = 'p-none';
                    $post_content_html[0] .= '<div class="' . $class . '">' . $p_co . '</div>';
                }

                $pages = $post_content_html;
            }
        }
        if ($style == 'long-form-scroll') {

            /* if(self::$first_slide == 'no')
              array_shift($pages); */

            //$pages = $this->page_break_pagination($pages, $quantity);
            $post_content_html = [];
                
                foreach ($pages as $key => $p_co) {
                       $class = 'p-show';
                    $post_content_html[0] .= '<div class="' . $class . '">' . $p_co . '</div>';
                }

                $pages = $post_content_html;
        }
    }

    /* modify tps options get value */

    public function tps_options_get_cb($value, $optionId, $optionGroups) {
        if ($optionId == 'button_behaviour') {
            $value = 'post';
        }
        return $value;
    }

    /**
     * Post slide ajax call functionality
     */
    public function test_overridr_ajax() {
        
        global $post, $pages;
        $qty = get_option('ht_long_fixed_content_qty');
        $mobile_qty = get_option('ht_long_fixed_content_qty_mobile');
        $post = get_post($_POST['postId']);
        if ($post === null) {
            exit();
        }
        setup_postdata($post);
        query_posts('p=' . $_POST['postId']);
        // if( $qty != '' && !wp_is_mobile() && $post_style != 'slides') {   
        $pages = $this->page_break_pagination($pages, $qty);
        // } elseif( $mobile_qty != '' && wp_is_mobile() && $post_style_mobile != 'slides' ) {   
        //  $pages = $this->page_break_pagination($pages, $mobile_qty);
        // }
    }

    /**
     * This function check utm source
     * return TRUE or False
     */
    public static function utm_exists() {
        if (empty(self::$utm_fetch) or empty(self::$utm_arr))
            return FALSE;
        $utm_filter = preg_replace('~[\\\\/:*?="<>|]~', ' ', self::$utm_fetch);
        $utm = str_replace(' ', '', $utm_filter);
        return in_array($utm, self::$utm_arr);
    }

    public static function initialize_attribute() {
        global $post, $pages;
        $campaign = $source = '';
        /* set utm fetch value */
        if (isset($_GET['utm_campaign']) && $_GET['utm_campaign'] != '') {
            $campaign = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_campaign']));
        } else {
            // if (empty($_GET['utm_campaign']) && isset($_COOKIE['campaign_utm'])) {
            $campaign = $_COOKIE['campaign_utm'];
        }

        if (isset($_GET['utm_source']) && $_GET['utm_source'] != '') {
            $source = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_source']));
        } else {
            // if (isset($_COOKIE['source_utm'])) {
            $source = $_COOKIE['source_utm'];
        }
        // else{
        //     $source = 'default';
        // }

        $box_data = get_option('ht_post_slides_data');

        if (!wp_is_mobile()) {

            // If post id match

            if (in_array($post->ID, array_keys($box_data['id_match']['desktop']))) {
                
                self::$utm_exists = TRUE;
                self::$post_style = $box_data['id_match']['desktop'][$post->ID]['layout'];
                self::$desktop_qty = $box_data['id_match']['desktop'][$post->ID]['layout_qty'];
                self::$desktop_first_slide = $box_data['id_match']['desktop'][$post->ID]['first_slide'];
                self::$desktop_first_image = $box_data['id_match']['desktop'][$post->ID]['first_image'];
                self::$desktop_fixed_content_ajax = $box_data['id_match']['desktop'][$post->ID]['fixed_content_ajax'];
                self::$layout_qty_ajax = $box_data['id_match']['desktop'][$post->ID]['layout_qty_ajax'];
                self::$periodical_yes = $box_data['id_match']['desktop'][$post->ID]['periodical_yes'];
                self::$periodical_interval = $box_data['id_match']['desktop'][$post->ID]['periodical_interval'];
                self::$left_ads_layout = $box_data['id_match']['desktop'][$post->ID]['left_ads_layout'];
                self::$right_ads_layout = $box_data['id_match']['desktop'][$post->ID]['right_ads_layout'];
                self::$ads_unit_for_action_trigger = $box_data['id_match']['desktop'][$post->ID]['ads_unit_for_action_trigger'];
            } else {
                if (!empty($source)) {

                    if (!empty($campaign)) {

                        foreach ($box_data['utm_campaign']['desktop']['contains'] as $u_key => $u_val) {
                            $campaign_exist = self::campaign_exist($campaign, $u_key);
                            $source_exist = self::source_exist($source, $u_val['source']);
                            if ($campaign_exist && $source_exist) {
                                self::$utm_exists = TRUE;
                                self::$post_style = $box_data['utm_campaign']['desktop']['contains'][$u_key]['layout'];
                                self::$desktop_qty = $box_data['utm_campaign']['desktop']['contains'][$u_key]['layout_qty'];
                                self::$desktop_first_slide = $box_data['utm_campaign']['desktop']['contains'][$u_key]['first_slide'];
                                self::$desktop_first_image = $box_data['utm_campaign']['desktop']['contains'][$u_key]['first_image'];
                                self::$desktop_fixed_content_ajax = $box_data['utm_campaign']['desktop']['contains'][$u_key]['fixed_content_ajax'];
                                self::$layout_qty_ajax = $box_data['utm_campaign']['desktop']['contains'][$u_key]['layout_qty_ajax'];
                                self::$periodical_yes = $box_data['utm_campaign']['desktop']['contains'][$u_key]['periodical_yes'];
                                self::$periodical_interval = $box_data['utm_campaign']['desktop']['contains'][$u_key]['periodical_interval'];
                                self::$left_ads_layout = $box_data['utm_campaign']['desktop']['contains'][$u_key]['left_ads_layout'];
                                self::$right_ads_layout = $box_data['utm_campaign']['desktop']['contains'][$u_key]['right_ads_layout'];
                                self::$ads_unit_for_action_trigger = $box_data['utm_campaign']['desktop']['contains'][$u_key]['ads_unit_for_action_trigger'];
                                break;
                            }
                        }

                        if (!self::$utm_exists) {
                            foreach ($box_data['utm_campaign']['desktop']['exclude'] as $u_key => $u_val) {
                                if (!$campaign_exist && $source_exist) {
                                    if (isset($box_data['utm_campaign']['desktop']['exclude'][$u_key])) {
                                        self::$utm_exists = TRUE;
                                        self::$post_style = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['layout'];
                                        self::$desktop_qty = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['layout_qty'];
                                        self::$desktop_first_slide = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['first_slide'];
                                        self::$desktop_first_image = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['first_image'];
                                        self::$desktop_fixed_content_ajax = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['fixed_content_ajax'];
                                        self::$layout_qty_ajax = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['layout_qty_ajax'];
                                        self::$periodical_yes = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['periodical_yes'];
                                        self::$periodical_interval = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['periodical_interval'];
                                        self::$left_ads_layout = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['left_ads_layout'];
                                        self::$right_ads_layout = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['right_ads_layout'];
                                        self::$ads_unit_for_action_trigger = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['ads_unit_for_action_trigger'];
                                        break;
                                    }
                                }
                            }
                        }

                        if (!self::$utm_exists && isset($box_data['utm_source']['desktop'][$source])) {
                            self::$utm_exists = TRUE;
                            self::$post_style = $box_data['utm_source']['desktop'][$source]['layout'];
                            self::$desktop_qty = $box_data['utm_source']['desktop'][$source]['layout_qty'];
                            self::$desktop_first_slide = $box_data['utm_source']['desktop'][$source]['first_slide'];
                            self::$desktop_first_image = $box_data['utm_source']['desktop'][$source]['first_image'];
                            self::$desktop_fixed_content_ajax = $box_data['utm_source']['desktop'][$source]['fixed_content_ajax'];
                            self::$layout_qty_ajax = $box_data['utm_source']['desktop'][$source]['layout_qty_ajax'];
                            self::$periodical_yes = $box_data['utm_source']['desktop'][$source]['periodical_yes'];
                            self::$periodical_interval = $box_data['utm_source']['desktop'][$source]['periodical_interval'];
                            self::$left_ads_layout = $box_data['utm_source']['desktop'][$source]['left_ads_layout'];
                            self::$right_ads_layout = $box_data['utm_source']['desktop'][$source]['right_ads_layout'];
                            self::$ads_unit_for_action_trigger = $box_data['utm_source']['desktop'][$source]['ads_unit_for_action_trigger'];
                        }
                    } else {
                        if (!self::$utm_exists && isset($box_data['utm_source']['desktop'][$source])) {
                            self::$utm_exists = TRUE;
                            self::$post_style = $box_data['utm_source']['desktop'][$source]['layout'];
                            self::$desktop_qty = $box_data['utm_source']['desktop'][$source]['layout_qty'];
                            self::$desktop_first_slide = $box_data['utm_source']['desktop'][$source]['first_slide'];
                            self::$desktop_first_image = $box_data['utm_source']['desktop'][$source]['first_image'];
                            self::$desktop_fixed_content_ajax = $box_data['utm_source']['desktop'][$source]['fixed_content_ajax'];
                            self::$layout_qty_ajax = $box_data['utm_source']['desktop'][$source]['layout_qty_ajax'];
                            self::$periodical_yes = $box_data['utm_source']['desktop'][$source]['periodical_yes'];
                            self::$periodical_interval = $box_data['utm_source']['desktop'][$source]['periodical_interval'];
                            self::$left_ads_layout = $box_data['utm_source']['desktop'][$source]['left_ads_layout'];
                            self::$right_ads_layout = $box_data['utm_source']['desktop'][$source]['right_ads_layout'];
                            self::$ads_unit_for_action_trigger = $box_data['utm_source']['desktop'][$source]['ads_unit_for_action_trigger'];
                        }
                    }
                }
                //exit();
            }
        } else {

            // If post id match 
            if (in_array($post->ID, array_keys($box_data['id_match']['mobile']))) {
                self::$post_style_mobile = $box_data['id_match']['mobile'][$post->ID]['layout'];
                self::$mobile_qty = $box_data['id_match']['mobile'][$post->ID]['layout_qty'];
                self::$mobile_first_slide = $box_data['id_match']['mobile'][$post->ID]['first_slide'];
                self::$mobile_first_image = $box_data['id_match']['mobile'][$post->ID]['first_image'];
                self::$mobile_fixed_content_ajax = $box_data['id_match']['mobile'][$post->ID]['fixed_content_ajax'];
                self::$layout_qty_ajax = $box_data['id_match']['mobile'][$post->ID]['layout_qty_ajax'];
                self::$periodical_yes = $box_data['id_match']['mobile'][$post->ID]['periodical_yes'];
                self::$periodical_interval = $box_data['id_match']['mobile'][$post->ID]['periodical_interval'];
                self::$left_ads_layout = $box_data['id_match']['mobile'][$post->ID]['left_ads_layout'];
                self::$right_ads_layout = $box_data['id_match']['mobile'][$post->ID]['right_ads_layout'];
                self::$ads_unit_for_action_trigger = $box_data['id_match']['mobile'][$post->ID]['ads_unit_for_action_trigger'];
                self::$utm_exists = TRUE;
            } else {
                if (!empty($source)) {

                    if (!empty($campaign)) {

                        foreach ($box_data['utm_campaign']['mobile']['contains'] as $u_key => $u_val) {

                            $campaign_exist = self::campaign_exist($campaign, $u_key);
                            $source_exist = self::source_exist($source, $u_val['source']);
                            if ($campaign_exist && $source_exist) {
                                self::$utm_exists = TRUE;
                                self::$post_style_mobile = $box_data['utm_campaign']['mobile']['contains'][$u_key]['layout'];
                                self::$mobile_qty = $box_data['utm_campaign']['mobile']['contains'][$u_key]['layout_qty'];
                                self::$mobile_first_slide = $box_data['utm_campaign']['mobile']['contains'][$u_key]['first_slide'];
                                self::$mobile_first_image = $box_data['utm_campaign']['mobile']['contains'][$u_key]['first_image'];
                                self::$mobile_fixed_content_ajax = $box_data['utm_campaign']['mobile']['contains'][$u_key]['fixed_content_ajax'];
                                self::$layout_qty_ajax = $box_data['utm_campaign']['mobile']['contains'][$u_key]['layout_qty_ajax'];
                                self::$periodical_yes = $box_data['utm_campaign']['mobile']['contains'][$u_key]['periodical_yes'];
                                self::$periodical_interval = $box_data['utm_campaign']['mobile'][$u_key]['contains']['periodical_interval'];
                                self::$left_ads_layout = $box_data['utm_campaign']['mobile']['contains'][$u_key]['left_ads_layout'];
                                self::$right_ads_layout = $box_data['utm_campaign']['mobile']['contains'][$u_key]['right_ads_layout'];
                                self::$ads_unit_for_action_trigger = $box_data['utm_campaign']['mobile']['contains'][$u_key]['ads_unit_for_action_trigger'];
                                break;
                            }/* elseif(!$campaign_exist && $source_exist){
                              if(isset($box_data['utm_campaign']['desktop']['exclude'][$u_key])){
                              self::$utm_exists = TRUE;
                              self::$post_style = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['layout'];
                              self::$desktop_qty = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['layout_qty'];
                              self::$desktop_first_slide = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['first_slide'];
                              self::$desktop_first_image = $box_data['utm_campaign']['desktop']['exclude'][$u_key]['first_image'];
                              break;
                              }
                              } */
                        }

                        if (!self::$utm_exists && isset($box_data['utm_source']['mobile'][$source])) {
                            self::$utm_exists = TRUE;
                            self::$post_style_mobile = $box_data['utm_source']['mobile'][$source]['layout'];
                            self::$mobile_qty = $box_data['utm_source']['mobile'][$source]['layout_qty'];
                            self::$mobile_first_slide = $box_data['utm_source']['mobile'][$source]['first_slide'];
                            self::$mobile_first_image = $box_data['utm_source']['mobile'][$source]['first_image'];
                            self::$mobile_fixed_content_ajax = $box_data['utm_source']['mobile'][$source]['fixed_content_ajax'];
                            self::$layout_qty_ajax = $box_data['utm_source']['mobile'][$source]['layout_qty_ajax'];
                            self::$periodical_yes = $box_data['utm_source']['mobile'][$source]['periodical_yes'];
                            self::$periodical_interval = $box_data['utm_source']['mobile'][$source]['periodical_interval'];
                            self::$left_ads_layout = $box_data['utm_source']['mobile'][$source]['left_ads_layout'];
                            self::$right_ads_layout = $box_data['utm_source']['mobile'][$source]['right_ads_layout'];
                            self::$ads_unit_for_action_trigger = $box_data['utm_source']['mobile'][$source]['ads_unit_for_action_trigger'];
                        }
                    } else {
                        if (!self::$utm_exists && isset($box_data['utm_source']['mobile'][$source])) {
                            self::$utm_exists = TRUE;
                            self::$post_style_mobile = $box_data['utm_source']['mobile'][$source]['layout'];
                            self::$mobile_qty = $box_data['utm_source']['mobile'][$source]['layout_qty'];
                            self::$mobile_first_slide = $box_data['utm_source']['mobile'][$source]['first_slide'];
                            self::$mobile_first_image = $box_data['utm_source']['mobile'][$source]['first_image'];
                            self::$mobile_fixed_content_ajax = $box_data['utm_source']['mobile'][$source]['fixed_content_ajax'];
                            self::$layout_qty_ajax = $box_data['utm_source']['mobile'][$source]['layout_qty_ajax'];
                            self::$periodical_yes = $box_data['utm_source']['mobile'][$source]['periodical_yes'];
                            self::$periodical_interval = $box_data['utm_source']['mobile'][$source]['periodical_interval'];
                            self::$left_ads_layout = $box_data['utm_source']['mobile'][$source]['left_ads_layout'];
                            self::$right_ads_layout = $box_data['utm_source']['mobile'][$source]['right_ads_layout'];
                            self::$ads_unit_for_action_trigger = $box_data['utm_source']['mobile'][$source]['ads_unit_for_action_trigger'];
                        }
                    }
                }
            }
        }
         /*echo '<pre>';
          print_r(self::$post_style);
          print_r(self::$periodical_yes);

          echo '<br>';
          print_r(self::$periodical_interval);
          echo '<br>';
          print_r(self::$desktop_first_slide);
          echo '<br>';
          print_r(self::$post_style_mobile);
          echo '<br>';
          print_r(self::$mobile_qty);
          echo '<br>';
          print_r(self::$mobile_first_slide);
          echo '<br>';
          print_r(self::$utm_exists);

          exit(); */
    }

    public function script_hook_func() {
        echo '<pre>';
        print_r('WP_HEAD');
        exit();
    }

    public function filter_raw_data($utm_sources, $name = '') {

        switch ($name):
            case 'id_match':
                foreach ($utm_sources['id_match'] as $key => $utm_source) {

                    if ($utm_sources['device'][$key] == 'desktop') {
                        $desktop['desktop'][$utm_source] = [
                            'layout' => $utm_sources['layout'][$key],
                            'layout_qty' => $utm_sources['layout_qty'][$key],
                            'first_slide' => $utm_sources['first_slide'][$key],
                            'first_image' => $utm_sources['first_image'][$key],
                            'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                            'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                            'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                            'periodical_interval' => $utm_sources['periodical_interval'][$key],
                            'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                            'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                            'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key]
                        ];
                    } else {
                        $desktop['mobile'][$utm_source] = [
                            'layout' => $utm_sources['layout'][$key],
                            'layout_qty' => $utm_sources['layout_qty'][$key],
                            'first_slide' => $utm_sources['first_slide'][$key],
                            'first_image' => $utm_sources['first_image'][$key],
                            'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                            'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                            'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                            'periodical_interval' => $utm_sources['periodical_interval'][$key],
                            'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                            'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                            'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key]
                        ];
                    }
                }
                return $desktop;
                break;
            case 'utm_campaign':
                foreach ($utm_sources['utm_campaign'] as $key => $utm_source) {

                    if ($utm_sources['device'][$key] == 'desktop') {
                        if ($utm_sources['contains'][$key] == 'yes') {
                            $desktop['desktop']['contains'][$utm_source] = [
                                'source' => $utm_sources['utm_source'][$key],
                                'layout' => $utm_sources['layout'][$key],
                                'layout_qty' => $utm_sources['layout_qty'][$key],
                                'contains' => $utm_sources['contains'][$key],
                                'first_slide' => $utm_sources['first_slide'][$key],
                                'first_image' => $utm_sources['first_image'][$key],
                                'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                                'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                                'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                                'periodical_interval' => $utm_sources['periodical_interval'][$key],
                                'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                                'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                                'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key],
                            ];
                        } else {
                            $desktop['desktop']['exclude'][$utm_source] = [
                                'source' => $utm_sources['utm_source'][$key],
                                'layout' => $utm_sources['layout'][$key],
                                'layout_qty' => $utm_sources['layout_qty'][$key],
                                'contains' => $utm_sources['contains'][$key],
                                'first_slide' => $utm_sources['first_slide'][$key],
                                'first_image' => $utm_sources['first_image'][$key],
                                'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                                'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                                'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                                'periodical_interval' => $utm_sources['periodical_interval'][$key],
                                'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                                'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                                'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key],
                            ];
                        }
                    } else {
                        if ($utm_sources['contains'][$key] == 'yes') {
                            $desktop['mobile']['contains'][$utm_source] = [
                                'source' => $utm_sources['utm_source'][$key],
                                'layout' => $utm_sources['layout'][$key],
                                'layout_qty' => $utm_sources['layout_qty'][$key],
                                'contains' => $utm_sources['contains'][$key],
                                'first_slide' => $utm_sources['first_slide'][$key],
                                'first_image' => $utm_sources['first_image'][$key],
                                'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                                'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                                'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                                'periodical_interval' => $utm_sources['periodical_interval'][$key],
                                'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                                'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                                'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key],
                            ];
                        } else {
                            $desktop['mobile']['exclude'][$utm_source] = [
                                'source' => $utm_sources['utm_source'][$key],
                                'layout' => $utm_sources['layout'][$key],
                                'layout_qty' => $utm_sources['layout_qty'][$key],
                                'contains' => $utm_sources['contains'][$key],
                                'first_slide' => $utm_sources['first_slide'][$key],
                                'first_image' => $utm_sources['first_image'][$key],
                                'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                                'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                                'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                                'periodical_interval' => $utm_sources['periodical_interval'][$key],
                                'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                                'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                                'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key],
                            ];
                        }
                    }
                }
                return $desktop;
                break;
            case 'utm_source':
                foreach ($utm_sources['utm_source'] as $key => $utm_source) {

                    if ($utm_sources['device'][$key] == 'desktop') {
                        $desktop['desktop'][$utm_source] = [
                            'layout' => $utm_sources['layout'][$key],
                            'layout_qty' => $utm_sources['layout_qty'][$key],
                            'first_slide' => $utm_sources['first_slide'][$key],
                            'first_image' => $utm_sources['first_image'][$key],
                            'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                            'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                            'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                            'periodical_interval' => $utm_sources['periodical_interval'][$key],
                            'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                            'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                            'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key],
                        ];
                    } else {
                        $desktop['mobile'][$utm_source] = [
                            'layout' => $utm_sources['layout'][$key],
                            'layout_qty' => $utm_sources['layout_qty'][$key],
                            'first_slide' => $utm_sources['first_slide'][$key],
                            'first_image' => $utm_sources['first_image'][$key],
                            'fixed_content_ajax' => $utm_sources['fixed_content_ajax'][$key],
                            'layout_qty_ajax' => $utm_sources['layout_qty_ajax'][$key],
                            'periodical_yes' => $utm_sources['periodical_yes_hidden'][$key],
                            'periodical_interval' => $utm_sources['periodical_interval'][$key],
                            'left_ads_layout' => $utm_sources['left_ads_layout'][$key],
                            'right_ads_layout' => $utm_sources['right_ads_layout'][$key],
                            'ads_unit_for_action_trigger' => $utm_sources['ads_unit_for_action_trigger'][$key]
                        ];
                    }
                }
                return $desktop;
                break;
        endswitch;
    }

    public function get_campaign_or_source($value) {
        $source = '';
        echo '<pre>';
        print_r($value);
        exit();
        switch ($value):
            case 'campaign':

                if (isset($_GET['utm_campaign']) && $_GET['utm_campaign'] != '') {
                    $source = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_campaign']));
                } elseif (isset($_SESSION['utm_campaign'])) {
                    $source = $_SESSION['utm_campaign'];
                }
                break;

            case 'source':
                if (isset($_GET['utm_source']) && $_GET['utm_source'] != '') {
                    $source = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_source']));
                } elseif (isset($_SESSION['utm_source'])) {
                    $source = $_SESSION['utm_source'];
                }
                break;
        endswitch;
    }

    public function campaign_exist($campaign_source, $utm_campaign) {
        $var = strpos($utm_campaign, $campaign_source);
        $varRev = strpos($campaign_source, $utm_campaign);
        if (is_numeric($var) || is_numeric($varRev)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function source_exist($val, $each_utm) {
        return $each_utm == $val;
    }

    public function test_cookie() {
        print_r($_COOKIE);
    }

}
