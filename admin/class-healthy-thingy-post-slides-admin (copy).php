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

	public static $post_style; 
	public static $post_style_mobile;
	public static $utm_fetch; 
	public static $utm_arr; 
        
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
                self::$post_style = get_option('ht_default_traffic_value');
                self::$post_style_mobile = get_option('ht_default_traffic_value_mobile');
                self::$post_style = get_option('ht_default_traffic_value');
                self::$utm_fetch = strtolower(isset($_GET['utm_source']) && ( $_GET['utm_source'] != '' ) ? $_GET['utm_source'] : $_COOKIE['utm_source']);
                self::$utm_arr = json_decode(get_option('ht_utm_source_list'), true);
		add_action( 'admin_menu', array(&$this, 'ht_menu_page' ) );
		add_action( 'admin_init', array(&$this, 'ht_register_settings') );
		//add_filter( 'post_link',  array(&$this, 'ht_append_query_string'), 10, 2 );
		add_action( 'the_post',  array(&$this, 'post_display_by_utm'),  10, 2 );
                
		add_action( 'wp_ajax_tps_get_slides', array(&$this, 'test_overridr_ajax') ,8);
		add_action( 'wp_ajax_nopriv_tps_get_slides', array(&$this, 'test_overridr_ajax') ,8);
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/healthy-thingy-post-slides-admin.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/healthy-thingy-post-slides-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add custom menu page
	*/
	public function ht_menu_page() {
		add_menu_page( 'Post slides settings', 'Post slides settings', 'manage_options', 'post-slides-settings', array($this, 'post_slides_settings_callback'), 'dashicons-admin-generic', 9 );
	}

	/**
	 * Settings page callback.
	*/
	public function post_slides_settings_callback() {
		include ( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/healthy-thingy-post-slides-settings.php' );
	}

	/**
	 * Register the settings fields
	*/
	public function ht_register_settings() {
		//add option name with default value
		add_option( 'ht_utm_source', 'default');
		add_option( 'ht_utm_source_list', '');
		add_option( 'ht_default_traffic_value', 'none');
		add_option( 'ht_default_traffic_value_mobile', 'none');
		add_option( 'ht_long_fixed_content_qty', '5');
		add_option( 'ht_long_fixed_content_qty_mobile', '5');
		
		//register option name
		register_setting( 'ht_options_group', 'ht_utm_source' );
		register_setting( 'ht_options_group', 'ht_utm_source_list' );
		register_setting( 'ht_options_group', 'ht_default_traffic_value' );
		register_setting( 'ht_options_group', 'ht_default_traffic_value_mobile' );
		register_setting( 'ht_options_group', 'ht_long_fixed_content_qty' );
		register_setting( 'ht_options_group', 'ht_long_fixed_content_qty_mobile' );
		
	}

	/**
	 * Add utm value to post details page url
	*/
	public function ht_append_query_string( $url, $post ) {
		$utm_source = get_option('ht_utm_source');
	    return esc_url( add_query_arg( 'utm_source', $utm_source, $url) );
            //$url.'?utm_source='.$utm_source;
	}

	/**
	 * Page break pagination
	*/
	public function page_break_pagination(array $data, $limit){
	    if(empty($data))
	        return FALSE;
	    //$limit = 2;
		$total_pages = ceil(count($data)/$limit);
		$new_arr = [];

		for($i = 1; $i<=$total_pages; $i++){
			
		    $start_from = ($i-1) * $limit;
		    $end_from = ($i) * $limit;
		    
		    for($start_from; $start_from<$end_from; $start_from++){
		    	$new_arr[$i-1] .= (array_key_exists($start_from, $data)) ? $data[$start_from].'<br>':'';
		    }
		}
		return $new_arr;
	}

	/**
	 * Set post display condition by utm value
	*/
	public function post_display_by_utm( $post, $query ){
		global $pages, $page;;
		$qty = get_option('ht_long_fixed_content_qty');
		$mobile_qty = get_option('ht_long_fixed_content_qty_mobile');
                
		if($post->post_type=='post' and $query->is_singular( 'post' )){
        	if ( false !== strpos( $post->post_content, '<!--nextpage-->' ) ) {
        		//desktop interface
	        	if(self::$post_style == 'long-form-fixed' && $qty != '' && self::utm_exists() && !wp_is_mobile() ){
                                        for($i=0;$i<$qty-1; $i++){
                                            array_splice($pages,1,0,array(' '));
                                        }
					$pages = $this->page_break_pagination($pages, $qty);
				} elseif (self::$post_style == 'long-form-scroll' && $qty != '' && self::utm_exists() && !wp_is_mobile() ) {
					// Reset the global $pages:
                        $pages = $this->page_break_pagination($pages, $qty);
                                
			        // Reset the global $numpages:
			        //$GLOBALS['numpages']  = 0;
			       // Reset the global $multipage:
			        //$GLOBALS['multipage'] = false;
				} elseif  ( (self::$post_style == 'slides' || self::$post_style == 'none') && !wp_is_mobile()) {
                                       
				} 

				//mobile device interface
				if(self::$post_style_mobile == 'long-form-fixed' && $mobile_qty != '' && self::utm_exists() && wp_is_mobile() ){
                                        for($i=0;$i<$mobile_qty-1; $i++){
                                            array_splice($pages,1,0,array(' '));
                                        }
					$pages = $this->page_break_pagination($pages, $mobile_qty);
				} elseif (self::$post_style_mobile == 'long-form-scroll' && $mobile_qty != '' && self::utm_exists() && wp_is_mobile() ) {
					// Reset the global $pages:
                    $pages = $this->page_break_pagination($pages, $mobile_qty);
                                
			        // Reset the global $numpages:
			        //$GLOBALS['numpages']  = 0;
			       // Reset the global $multipage:
			        //$GLOBALS['multipage'] = false;
				} elseif  ( (self::$post_style_mobile == 'slides' || self::$post_style_mobile == 'none') && wp_is_mobile() ) {
                                    
				}
			}

		}
	}
	/**
	 * Post slide ajax call functionality
	*/
	public function test_overridr_ajax(){
	    
	    global $post, $pages;
	    $qty = get_option('ht_long_fixed_content_qty');
	    $mobile_qty = get_option('ht_long_fixed_content_qty_mobile');
	    $post = get_post( $_POST['postId'] );
	        if ( $post === null ) {
	            exit();
	        }
	        setup_postdata( $post );
	        query_posts( 'p=' . $_POST['postId'] );
	    // if( $qty != '' && !wp_is_mobile() && $post_style != 'slides') {   
	    	$pages = $this->page_break_pagination($pages, $qty);
	    // } elseif( $mobile_qty != '' && wp_is_mobile() && $post_style_mobile != 'slides' ) {   
	    // 	$pages = $this->page_break_pagination($pages, $mobile_qty);
	    // }
	}
        
        
    public static function utm_exists(){
        if(empty(self::$utm_fetch) or empty(self::$utm_arr))
            return FALSE;
        $utm_filter = preg_replace('~[\\\\/:*?="<>|]~', ' ', self::$utm_fetch);
        $utm = str_replace(' ', '', $utm_filter);
        return in_array($utm, self::$utm_arr);
    }


}
