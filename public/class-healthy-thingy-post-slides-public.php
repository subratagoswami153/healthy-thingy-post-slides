<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://healthythingy.com/
 * @since      1.0.0
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Healthy_Thingy_Post_Slides
 * @subpackage Healthy_Thingy_Post_Slides/public
 * @author     Ramen Das <ramend3@gmail.com>
 */
class Healthy_Thingy_Post_Slides_Public {

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

	
        private $class_intance;
        public function __construct( $plugin_name, $version ) {
                $this->bc = 5;
                $this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('wp_ajax_healthy_thingy_post_slides_infinite_scroll',array($this,'healthy_thingy_post_slides_infinite_scroll_func'));
                add_action('wp_ajax_nopriv_healthy_thingy_post_slides_infinite_scroll',array($this,'healthy_thingy_post_slides_infinite_scroll_func'));
                //add_action('the_post', array(&$this, 'enqueue_scripts'), 10, 1);
                
    add_action('wp_ajax_action_triggered_ads',array($this,'action_triggered_ads_sidebar'));
    add_action('wp_ajax_nopriv_action_triggered_ads',array($this,'action_triggered_ads_sidebar'));

    add_action('wp_ajax_on_demand_ads_sidebar',array($this,'on_demand_ads_sidebar'));
    add_action('wp_ajax_nopriv_on_demand_ads_sidebar',array($this,'on_demand_ads_sidebar'));

    add_action('init', array($this, 'set_cookie_session'));

    add_action('wp_head', array($this, 'cp_scripts_fire'));
    add_action('wp_footer', array($this, 'css_action_triggered'), 99);

    // add_action('init', array($this, 'test_function'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
                wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/healthy-thingy-post-slides-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
                //$this->class_intance = new Healthy_Thingy_Post_Slides_Admin($this->plugin_name, $this->version);
                
                
		global $post, $pages, $wp_query;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $current_page = $wp_query->query['page'];
                Healthy_Thingy_Post_Slides_Admin::initialize_attribute();
		wp_enqueue_script( $this->plugin_name.'public-js', plugin_dir_url( __FILE__ ) . 'js/healthy-thingy-post-slides-public.js', array( 'jquery' ), $this->version, false );

                wp_localize_script($this->plugin_name.'public-js', 'healthyThingyObj', array(
                   'ajax_url' => admin_url('admin-ajax.php'),
                    'current_post' => get_the_ID(),
                    'prev_post_link' => (esc_url(get_permalink(get_the_ID())) != esc_url(get_permalink( get_adjacent_post(false,'',true)->ID )))?esc_url(get_permalink( get_adjacent_post(false,'',true)->ID )):'javascript:void(0);',
                    'current_post_link' => esc_url(get_permalink(get_the_ID())),
                    'next_post_link' => (esc_url(get_permalink(get_the_ID()))!=esc_url(get_permalink( get_adjacent_post(false,'',false)->ID )))?esc_url(get_permalink( get_adjacent_post(false,'',false)->ID )):'javascript:void(0);',
                    'post_style' => Healthy_Thingy_Post_Slides_Admin::$post_style,
                    'post_style_mobile' => Healthy_Thingy_Post_Slides_Admin::$post_style_mobile,
                    'is_mobile' => wp_is_mobile(),
                    'utm_exists' => Healthy_Thingy_Post_Slides_Admin::$utm_exists,
                    'desktop_qty' => Healthy_Thingy_Post_Slides_Admin::$desktop_qty,
                    'mobile_qty' => Healthy_Thingy_Post_Slides_Admin::$mobile_qty,
                    'desktop_first_slide' =>  Healthy_Thingy_Post_Slides_Admin::$desktop_first_slide,
                    'mobile_first_slide' =>  Healthy_Thingy_Post_Slides_Admin::$mobile_first_slide,
                    'desktop_first_image' =>  Healthy_Thingy_Post_Slides_Admin::$desktop_first_image,
                    'mobile_first_image' =>  Healthy_Thingy_Post_Slides_Admin::$mobile_first_image,
                    'left_ads_layout' =>  Healthy_Thingy_Post_Slides_Admin::$left_ads_layout,
                    'right_ads_layout' =>  Healthy_Thingy_Post_Slides_Admin::$right_ads_layout,
                    // 'ads_unit_for_action_trigger' =>  Healthy_Thingy_Post_Slides_Admin::$ads_unit_for_action_trigger,
                    'hide_prev_button' =>  Healthy_Thingy_Post_Slides_Admin::$hide_prev_button_mobile,
                    'current_page' => ($current_page!='')?$current_page:1,
                ));  

                // print_r($post);($current_page!='')?$current_page:1; 
                
	}
        
       public function healthy_thingy_post_slides_infinite_scroll_func(){
           
           $resp_arr = ['html'=>'','next_page'=>'','flag'=>FALSE,'total'=>''];
           $next = absint(stripslashes(trim($_POST['next_page'])));
           $postId = absint(stripslashes(trim($_POST['post_id'])));
           
           if(empty($next) or empty($postId)){
           	   echo json_encode($resp_arr);
               exit();
           }
           
           global $post, $pages;
           
           $post = get_post( $postId );
           if ( $post === null ) {
           	   echo json_encode($resp_arr);
               exit();
           }
           
           setup_postdata( $post );
           
           //$admin_intance = new Healthy_Thingy_Post_Slides_Admin();
           if(!wp_is_mobile()){
               $qty = absint($_POST['desktop_qty']);
           }else{
               $qty = absint($_POST['mobile_qty']);
           }
           if($qty<1){
               echo json_encode($resp_arr);
               exit();
           }
           $pages = Healthy_Thingy_Post_Slides_Admin::page_break_pagination($pages, $qty);    
           if(count($pages)<$next){
           	   echo json_encode($resp_arr);
               exit();
           }
           if(!empty($pages[$next])):
               
                //$response = Advanced_Ads_Ajax::select_one( $_REQUEST );
                //echo '<pre>';
                //print_r(get_ad(35));
                //print_r(get_ad_group(4));
                //print_r(get_ad_placement('content'));
                //print_r(wp_generate_password(10,false,false));
                //exit();
               $conatiner_class = wp_generate_password(10,false,false);
                $resp_arr['html'] = Healthy_Thingy_Post_Slides_Admin::get_blocks_data($pages[$next],$conatiner_class);
                $resp_arr['container_class'] = $conatiner_class;
               $resp_arr['flag'] = TRUE;
           endif;    
           $resp_arr['next_page'] = $next+1 ;
           $resp_arr['total'] = count($pages) ;
           $resp_arr['ads_response'] = $this->get_ad_with_elements() ;
           $resp_arr['ads_response_sidebar'] = $this->get_ad_with_elements_sidebar(); 
           echo json_encode($resp_arr);
           exit();
           
       } 

       public function set_cookie_session(){
           // session_start();

           // if(isset($_GET['utm_campaign']) && $_GET['utm_campaign'] != ''){
           //    $campaign = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_campaign']));
           //    if(isset($_COOKIE['utm_campaign']) && empty($_GET['utm_campaign'])){
           //      $campaign = $_COOKIE['utm_campaign'];
           //    }
           //    setcookie('campaign_utm', $campaign, time() + (86400 * 30));
           // }
           if(isset($_GET['utm_source']) && $_GET['utm_source'] != ''){
              $source = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_source']));
           }elseif(isset($_COOKIE['utm_source']) && empty($_GET['utm_source'])){
                $source = $_COOKIE['utm_source'];
           }else{
              $source = 'default';
           }
           setcookie('source_utm', $source, time() + (86400 * 30), '/');

           if(isset($_GET['utm_campaign']) && $_GET['utm_campaign'] != ''){
              $campaign = trim(preg_replace('~[\\\\/:*?="<>|]~', ' ', $_GET['utm_campaign']));

           }elseif(isset($_COOKIE['utm_campaign']) && empty($_GET['utm_campaign'])){
                $campaign = $_COOKIE['utm_campaign'];
           }else{
              $campaign = 'default';
           }
           setcookie('campaign_utm', $campaign, time() + (86400 * 30), '/');    
       }


       public function cp_scripts_fire(){
          global $post, $pages, $wp_query;
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $get_page_count = $wp_query->query['page'];
          $current_page = ($get_page_count!='')?$get_page_count:1;

          $cp_lists = get_option('cp_sctipts_list');

          foreach ($cp_lists as $key => $cp_list) {
            if(!wp_is_mobile()){
              if($cp_list['cp_field_qty'] == $current_page && $cp_list['cp_device'] == 'desktop'){
                echo $cp_list['cp_field_script'];
              }
            }elseif(wp_is_mobile()){
              if($cp_list['cp_field_qty'] == $current_page && $cp_list['cp_device'] == 'mobile'){
                echo $cp_list['cp_field_script'];
              }
            }

          }
       }
       
       /**
	 * Provides Ads from group ID with specific elemets.
	 *
	 * @param no argument.
	 *
	 * @return array
	 */
       public function get_ad_with_elements(){
           $data = [];
           if(empty(get_option('ht_ads_settings')))
               return $data;
           $ads = get_option('ht_ads_settings');
           foreach($ads as $ad){
               $item['item'] = get_ad_group($ad['ad_group_id']);
               $item['element'] = $ad['ad_placement'];
               $data[] = $item;
           }
           return $data;
       }
       //on demand infinite scroll ads
       public function get_ad_with_elements_sidebar(){
           $data = [];
           $sidebar_ads = get_option('sidebar_ads_settings');

           $item['left_ads'] = get_ad_group($sidebar_ads[0]['left_ads_id']);
           $item['right_ads'] = get_ad_group($sidebar_ads[0]['right_ads_id']);
           $item['enable_ads'] = $sidebar_ads[0]['sidebar_enable_ads'];

           $data[] = $item;
           return $data;
       }
       //action triggered ads layout

       public function action_triggered_ads_sidebar(){
           $data = [];
           $action_triggered_ads = get_option('action_triggered_ads_settings');

           $item['left_ads'] = get_ad_group($action_triggered_ads['left_ads_id']);
           $item['right_ads'] = get_ad_group($action_triggered_ads['right_ads_id']);

           $data[] = $item;
           echo json_encode($data);
           exit();
           // return $data;
       }
       
      //on demand ads layout
       public function on_demand_ads_sidebar(){
           $data = [];
           $on_demand_ads = get_option('sidebar_ads_settings');

           $item['left_ads'] = get_ad_group($on_demand_ads[0]['left_ads_id']);
           $item['right_ads'] = get_ad_group($on_demand_ads[0]['right_ads_id']);

           $data[] = $item;
           echo json_encode($data);
           exit();
           // return $data;
       }
       /**
	 * Provides a single ad (ad, group, placement) given ID and selection method.
	 *
	 * @param array $request request.
	 *
	 * @return array
	 */
       
    public function select_one( $request ) {
            
		// Init handlers.
		$selector  = Advanced_Ads_Select::get_instance();
		$methods   = $selector->get_methods();
		$method    = isset( $request['ad_method'] ) ? (string) $request['ad_method'] : null;
		$id        = isset( $request['ad_id'] ) ? (string) $request['ad_id'] : null;
		$arguments = isset( $request['ad_args'] ) ? $request['ad_args'] : array();
		if ( is_string( $arguments ) ) {
			$arguments = stripslashes( $arguments );
			$arguments = json_decode( $arguments, true );https://healthythingy.com/how-to-make-your-hands-look-youthful-again/#google_vignette
		}
		if ( ! empty( $request['elementId'] ) ) {
			$arguments['cache_busting_elementid'] = $request['elementId'];
		}

		$response = array();
		if ( isset( $methods[ $method ] ) && isset( $id ) ) {
			$advads = Advanced_Ads::get_instance();
			$l      = count( $advads->current_ads );

			// Build content.
			$content = $selector->get_ad_by_method( $id, $method, $arguments );
			$ad_ids  = array_slice( $advads->current_ads, $l ); // Ads loaded by this request.

			$r = array(
				'status'  => 'success',
				'item'    => $content,
				'id'      => $id,
				'method'  => $method,
				'ads'     => $ad_ids,
				'blog_id' => get_current_blog_id(),
			);

			return apply_filters(
				'advanced-ads-cache-busting-item',
				$r,
				array(
					'id'     => $id,
					'method' => $method,
					'args'   => $arguments,
				)
			);
		} else {
			// Report error.
			return array(
				'status'  => 'error',
				'message' => 'No valid ID or METHOD found.',
			);
		}
	}

  public function test_function(){
    print_r(dynamic_sidebar('colormag_right_sidebar'));
  }

// || (Healthy_Thingy_Post_Slides_Admin::$left_ads_layout == 'default-ads' && Healthy_Thingy_Post_Slides_Admin::$right_ads_layout == 'action-triggered-ads')
// || (Healthy_Thingy_Post_Slides_Admin::$left_ads_layout == 'default-ads' && Healthy_Thingy_Post_Slides_Admin::$right_ads_layout == 'action-triggered-ads')

   public function css_action_triggered(){
      if(!(wp_is_mobile())){
        if(Healthy_Thingy_Post_Slides_Admin::$left_ads_layout == 'action-triggered-ads' && Healthy_Thingy_Post_Slides_Admin::$right_ads_layout == 'action-triggered-ads'){
          ?>
          <style type="text/css">
            .ads-padding-top-120{
              margin-top: <?php echo (get_option('action_triggered_top_margin') != '')?get_option('action_triggered_top_margin'):'150px'; ?>;
            }
            @media only screen and (min-width: 1665px) and (max-width: 2560px) {
              .single-post #primary{
                width: 100% !important;
              }
              
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
          }
          @media only screen and (min-width: 1525px) and (max-width: 1664px) {
              .single-post #ternary{
                width: 160px !important;
              }
              .single-post #secondary{
                width: 300px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
              } 
              .single-post #primary{
                  width: calc(100% - 135px);
              } 
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
            }

            @media only screen and (min-width: 1455px) and (max-width: 1524px){
              .single-post #ternary{
                width: 160px !important;
              }
              .single-post #secondary{
                width: 160px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 2%;
              } 
              .single-post #primary {
                  float: left;
                  width: calc(100% - 0px);
              }
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              } 
            }
            @media only screen and (min-width: 1385px) and (max-width: 1454px) {
              .single-post #ternary{
                width: 160px !important;
              }
              .single-post #secondary{
                display: block !important;
                width: 160px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
              }
              .single-post .article-content {
                  padding: 15px;
                  padding-left: 10px !important;
                  padding-right: 10px !important;
              }  
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
                  width: 99%;
              }
              .single-post #primary {
                  float: left;
                  width: calc(100% - 0px);
              }  
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
            }

            @media only screen and (min-width: 1355px) and (max-width: 1384px) {
              .single-post #ternary{
                display: none !important;
                width: 0px !important;
              }
              .single-post #secondary{
                display: block;
                width: 300px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
              }
              .single-post .article-content {
                  padding: 15px;
                  padding-left: 0px!important;
                  padding-right: 0px!important;
              }
              .single-post #primary {
                  float: left;
                  width: calc(100% - 624px);
              }  
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
            }
            @media only screen and (min-width: 1210px) and (max-width: 1354px) {
              .single-post #ternary{
                display: none !important;
                width: 0px !important;
              }
              .single-post #secondary{
                display: block;
                width: 160px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
              }
              .single-post .article-content {
                  padding: 15px;
                  padding-left: 0px!important;
                  padding-right: 0px!important;
              }
              .single-post #primary {
                  float: left;
                  width: calc(100% - 624px);
              }  
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
            }

            @media only screen and (min-width: 1175px) and (max-width: 1209px) {
              .single-post .article-content {
                  padding: 15px;
                  padding-left: 0px!important;
                  padding-right: 0px!important;
              }
              .single-post #primary {
                  float: left;
                  width: calc(100% - 190px);
              }
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
              .single #content {
                  width: 1000px;
                  margin: 0 auto;
              }

              .single-post #ternary{
                display: none !important;
                width: 0px !important;
              }
              .single-post #secondary{
                display: block;
                width: 160px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
                  width: 99%;
              }
            }
            @media only screen and (min-width: 992px) and (max-width: 1174px) {
              .single-post .article-content {
                  padding: 15px;
                  padding-left: 0px!important;
                  padding-right: 0px!important;
              }
              .single-post #primary {
                  float: left;
                  width: calc(100% - 190px);
              }
              .single #content {
                  width: 1000px;
                  margin: 0 auto;
              }
              .single-post #ternary{
                height: 0px;
              }
              .single-post #secondary{
                height: 0px;
              }
              .single-post #ternary{
                display: none !important;
                width: 0px !important;
              }
              .single-post #secondary{
                display: none;
                width: 0px !important;
              }
              .single-post .inner-wrap {
                  max-width: 2000px !important;
                  padding: 0px 0%;
                  width: 99%;
              }
            }
            
          </style>
          <?php
        }elseif(Healthy_Thingy_Post_Slides_Admin::$left_ads_layout == 'action-triggered-ads' && Healthy_Thingy_Post_Slides_Admin::$right_ads_layout == 'default-ads'){ ?>
          <style type="text/css">
            .ads-padding-top-120{
              margin-top: <?php echo (get_option('action_triggered_top_margin') != '')?get_option('action_triggered_top_margin'):'150px'; ?>;
            }
            .single-post #ternary{
                height: 0 !important;
                position: fixed;
            }
            .single-post #secondary{
                height: auto !important;
            }
            @media only screen and (max-width: 2560px) and (min-width: 1080px){
              .single-post #primary {
                  float: left;
                  width: calc(100% - 310px);
                  padding-left: 17%;
              }   
            }
/*            @media only screen and (max-width: 2560px) and (min-width: 1080px){
              .single-post #primary {
                  float: left;
                  width: calc(100% - 310px);
                  padding-left: 10%;
              }
            }*/
            @media only screen and (max-width:1550px) and (min-width:1455px){
              .single-post #primary {
                  float: left;
                  width: calc(100% - 310px);
                  padding-left: 13%;
              }
            }
            @media only screen and (max-width:1455px) and (min-width:1385px){
              .single-post #primary {
                  float: left;
                  width: calc(100% - 310px);
                  padding-left: 12%;
              }
            }
          </style>


        <?php }elseif(Healthy_Thingy_Post_Slides_Admin::$left_ads_layout == 'default-ads' && Healthy_Thingy_Post_Slides_Admin::$right_ads_layout == 'action-triggered-ads'){ ?>
          <style type="text/css">
            .ads-padding-top-120{
              margin-top: <?php echo (get_option('action_triggered_top_margin') != '')?get_option('action_triggered_top_margin'):'150px'; ?>;
            }
            .single-post #ternary{
                position: absolute;
            }
            /*  .single-post #secondary{
                height: 0px !important;
                position: fixed;
            }*/
            @media only screen and (max-width: 2560px) and (min-width: 1665px){
              .single-post #primary {
                  width: 1050px;
                  float: none;
                  margin: 0 auto;
              }   
              
            }
            @media only screen and (max-width: 1664px) and (min-width: 1580px){
              .single-post #primary {
                  width: 1050px;
        				  float: left;
        				  margin-left: 13%;
              }   
            }
            @media only screen and (max-width: 1579px) and (min-width: 1525px){
              .single-post #primary {
                  width: 1050px;
        				  float: left;
        				  margin-left: 11%;
              }   
            }
            @media only screen and (max-width: 1385px) and (min-width: 1525px){
              .single-post #primary {
                  width: 1050px;
                  float: none;
                  margin: 0 auto;
              }   
            }
            @media only screen and (max-width: 1385px) and (min-width: 1525px){
              .single-post #primary {
                  width: 1050px;
				          float: left;
              }   
            }

          </style>

          <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#ternary").height('auto');
            });
          </script>


        <?php }
      }

      if(wp_is_mobile() && Healthy_Thingy_Post_Slides_Admin::$hide_prev_button_mobile == '1'){ ?>
        <style type="text/css">
          @media screen and (max-width: 480px) {
              .theiaPostSlider_nav ._prev{
                display: none;
              }
              .theiaPostSlider_nav ._next{
                  font-size: 20px;
                  display: inline-box;
              }
              .theiaPostSlider_nav.fontTheme ._buttons ._button {
                  padding: 12px !important;
                  padding-left: 26% !important;
                  padding-right: 26% !important;
/*                  height: 110px !important;
*/              }
              .theiaPostSlider_nav._center_full ._next {
                  float: none !important; 
                  float: none !important;
                  outline: 5px solid #dd3c33;
                  outline-offset: 3px;
                }
                .single-post .theiaPostSlider_nav {
                    padding-top: 10px !important;
                    padding-bottom: 35px !important;
                    padding-right: 0px !important;
                    padding-left: 0px !important;
                }
          }
        }
        </style>
      <?php }
  }


}


