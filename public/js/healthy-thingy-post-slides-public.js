(function (jQuery) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * jQuery function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * jQuery(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * jQuery( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    function action_triggered_ads_load(){
        var device_width = jQuery(window).width();

            jQuery.ajax({
                url: healthyThingyObj.ajax_url,
                type: 'post',
                data: {action: "action_triggered_ads" },
                dataType: 'json',
                success: function (response) {
                    /*   Process ads ajax */
                    if (response[0]) {
                        var action_triggeres_ads_left = response[0]['left_ads'];
                        var action_triggeres_ads_right = response[0]['right_ads'];

                        jQuery('.single-post #ternary div, #secondary div').html('');
                        // jQuery('#ternary').addClass('q2w3-fixed-widget-container');
                        jQuery('.single-post #ternary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_left+`</aside>`);
                        
                        jQuery('.single-post #secondary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_right+`</aside>`);

                    }
                    
                    /*  End  Process ads ajax */
                }

            });

    }
    function action_triggered_ads_load_left(){
        var device_width = jQuery(window).width();

        jQuery.ajax({
            url: healthyThingyObj.ajax_url,
            type: 'post',
            data: {action: "action_triggered_ads" },
            dataType: 'json',
            success: function (response) {
                /*   Process ads ajax */
                if (response[0]) {
                    var action_triggeres_ads_left = response[0]['left_ads'];
                    // var action_triggeres_ads_right = response[0]['right_ads'];

                    jQuery('.single-post #ternary div').html('');
                    // jQuery('#ternary').addClass('q2w3-fixed-widget-container');
                    jQuery('.single-post #ternary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_left+`</aside>`);
                    
                    // jQuery('.single-post #secondary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_right+`</aside>`);

                }
                /*  End  Process ads ajax */
            }
        });
    }


    function action_triggered_ads_load_right(){
        var device_width = jQuery(window).width();

        jQuery.ajax({
            url: healthyThingyObj.ajax_url,
            type: 'post',
            data: {action: "action_triggered_ads" },
            dataType: 'json',
            success: function (response) {
                /*   Process ads ajax */
                if (response[0]) {
                    // var action_triggeres_ads_left = response[0]['left_ads'];
                    var action_triggeres_ads_right = response[0]['right_ads'];

                    // jQuery('.single-post #ternary div, #secondary div').html('');
                    jQuery('.single-post #secondary div').html('');
                    // jQuery('#ternary').addClass('q2w3-fixed-widget-container');
                    // jQuery('.single-post #ternary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_left+`</aside>`);
                    
                    jQuery('.single-post #secondary').html(`<aside class="ads-padding-top-120 widget popli-widget clearfix" style="top: 10px; width: inherit; position: fixed;">`+action_triggeres_ads_right+`</aside>`);

                }
                /*  End  Process ads ajax */
            }
        });
    }

    jQuery(document).ready(function () {
        alert('version 1.5.9');

        if (healthyThingyObj.is_mobile == '1' && healthyThingyObj.utm_exists == '1') {
            if (healthyThingyObj.post_style_mobile == 'long-form-scroll') {
                jQuery('.theiaPostSlider_nav ._text').hide();
                if (healthyThingyObj.mobile_first_image == 'no') {
                    jQuery(".theiaPostSlider_slides").css("padding-top", "10px");
                    jQuery('.theiaPostSlider_preloadedSlide').find('.wp-block-image').first().remove();
                }
                if (healthyThingyObj.next_post_link == 'javascript:void(0);') {
                    jQuery('._buttons ._next').hide();
                }
            } else if (healthyThingyObj.post_style_mobile == 'long-form-fixed') {
                if (healthyThingyObj.mobile_first_slide == 'no' && healthyThingyObj.current_page == '1') {
                    jQuery('.theiaPostSlider_preloadedSlide').find('.wp-block-image').first().remove();
                }
            }
        }

        if (healthyThingyObj.is_mobile == '' && healthyThingyObj.utm_exists == '1') {
            // jQuery('.theiaPostSlider_nav').hide();
            if (healthyThingyObj.post_style == 'long-form-scroll') {
                jQuery('.theiaPostSlider_nav ._text').hide();
                if (healthyThingyObj.desktop_first_image == 'no') {
                    jQuery(".theiaPostSlider_slides").css("padding-top", "10px");
                    jQuery('.theiaPostSlider_preloadedSlide').find('.wp-block-image').first().remove();
                }
                if (healthyThingyObj.next_post_link == 'javascript:void(0);') {
                    jQuery('._buttons ._next').hide();
                }
            } else if (healthyThingyObj.post_style == 'long-form-fixed') {
                if (healthyThingyObj.desktop_first_slide == 'no' && healthyThingyObj.current_page == '1') {
                    jQuery(".theiaPostSlider_slides").css("padding-top", "10px");
                    jQuery('.theiaPostSlider_preloadedSlide').find('.wp-block-image').first().remove();
                }
            }
        }

        // setTimeout(function(){
            if (healthyThingyObj.is_mobile == '' && healthyThingyObj.post_style == 'long-form-scroll') {
                jQuery(".popli-left-rail-top").each(function() {  
                  var ads_height = jQuery(this).height();
                  if(ads_height <= 300){
                    jQuery(this).addClass('less_300');
                  }else if(ads_height >= 300){
                    jQuery(this).addClass('bigger_300');
                  }
                });
            }
        // }, 3000);
      
    });



    var timeout;
    var flag = true;
    var total = 2;
    jQuery(window).on('scroll', function ($) {
        console.log('plugin version 1.5.8 updated successfully');

        if (!healthyThingyObj.utm_exists)
            return false
        if (healthyThingyObj.is_mobile == '1' && healthyThingyObj.post_style_mobile != 'long-form-scroll')
            return false
        if (healthyThingyObj.is_mobile == '' && healthyThingyObj.post_style != 'long-form-scroll')
            return false
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            // do your stuff
            if (jQuery(window).scrollTop()+5000 >= jQuery('.theiaPostSlider_preloadedSlide').offset().top + jQuery('.theiaPostSlider_preloadedSlide').outerHeight() - window.innerHeight) {
                //alert('hjhb');
                if (flag == true)
                    var next = parseInt((typeof jQuery('.theiaPostSlider_preloadedSlide').attr('data-next') === "undefined") ? 1 : jQuery('.theiaPostSlider_preloadedSlide').attr('data-next'));
                if (next >= total)
                    return false;

                jQuery('.infinite-scroll-loader').show();
                jQuery.ajax({
                    url: healthyThingyObj.ajax_url,
                    type: 'post',
                    data: {action: "healthy_thingy_post_slides_infinite_scroll", desktop_qty: healthyThingyObj.desktop_qty, mobile_qty: healthyThingyObj.mobile_qty, post_id: healthyThingyObj.current_post, next_page: next, },
                    dataType: 'json',
                    success: function (response) {

                        jQuery('.infinite-scroll-loader').hide();
                        if (response.flag != false) {
                            jQuery('.theiaPostSlider_preloadedSlide').attr('data-next', response.next_page);
                            total = parseInt(response.total);
                        }


                        jQuery('.theiaPostSlider_preloadedSlide').append(response.html);
                        /*   Process ads ajax */
                        if (response.ads_response) {
                            var i;
                            for (i = 0; i < response.ads_response.length; i++) {
                                var ad = response.ads_response[i];
                                jQuery(ad.item).insertAfter('.healthy-thingy-' + response.container_class + ' '+ad.element);
                            }
                        }

                        if (response.ads_response_sidebar[0]) {
                            var j;
                            // for (i = 0; i < response.ads_response_sidebar[0]length; i++) {
                                var ads_sidebar = response.ads_response_sidebar[0];
                                if(ads_sidebar.enable_ads == 'left'){
                                    for(j=0; j<healthyThingyObj.desktop_qty; j++){
                                        jQuery('#ternary').append(ads_sidebar.left_ads);
                                    }  
                                }else if(ads_sidebar.enable_ads == 'right'){
                                    for(j=0; j<healthyThingyObj.desktop_qty; j++){
                                        jQuery('#secondary').append(ads_sidebar.right_ads);
                                    }
                                }else if(ads_sidebar.enable_ads == 'both'){
                                    for(j=0; j<healthyThingyObj.desktop_qty; j++){
                                        jQuery('#ternary').append(ads_sidebar.left_ads);
                                        jQuery('#secondary').append(ads_sidebar.right_ads);
                                    }
                                }
    
                        }
                        
                        /*  End  Process ads ajax */

                        jQuery(".popli-left-rail-top").each(function() {  
                          var ads_height = jQuery(this).height();
                          if(ads_height <= 300){
                            jQuery(this).addClass('less_300');
                          }else if(ads_height >= 300){
                            jQuery(this).addClass('bigger_300');
                          }
                        });
                    }

                });
                flag = false;
                jQuery(document).ajaxComplete(function (event, request, settings) {
                    flag = true;
                    // remove wp-has-aspect-ration from figure
                    if (jQuery('.wp-block-embed-youtube').hasClass("wp-has-aspect-ratio")) {
                        jQuery('.wp-block-embed-youtube').removeClass("wp-has-aspect-ratio");
                    }

                });

            }
        }, 50);

    });


    jQuery(document).ready(function ($) {
        // var device_width = jQuery(window).width();

        var loader = '<div class="infinite-scroll-loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>';

        if (healthyThingyObj.is_mobile == '1' && healthyThingyObj.post_style_mobile === 'long-form-scroll' && healthyThingyObj.utm_exists == '1') {
            jQuery('.theiaPostSlider_preloadedSlide').after(loader);
            // add next and prev post url if exists  for upper
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._prev').attr('href', healthyThingyObj.prev_post_link);
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._next').attr('href', healthyThingyObj.next_post_link);

            // for lower
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._prev').attr('href', healthyThingyObj.prev_post_link);
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._next').attr('href', healthyThingyObj.next_post_link);

        }
        if (healthyThingyObj.is_mobile != '1' && healthyThingyObj.post_style === 'long-form-scroll' && healthyThingyObj.utm_exists == '1') {
            jQuery('.theiaPostSlider_preloadedSlide').after(loader);
            // add next and prev post url if exists  for upper
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._prev').attr('href', healthyThingyObj.prev_post_link);
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._next').attr('href', healthyThingyObj.next_post_link);

            // for lower
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._prev').attr('href', healthyThingyObj.prev_post_link);
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._next').attr('href', healthyThingyObj.next_post_link);
        }

        // remove wp-has-aspect-ration from figure
        if (jQuery('.wp-block-embed-youtube').hasClass("wp-has-aspect-ratio")) {
            jQuery('.wp-block-embed-youtube').removeClass("wp-has-aspect-ratio");
        }

        // check next elements after br tag 
        jQuery('.theiaPostSlider_preloadedSlide h4').each(function () {
            var devSel = jQuery(this).prev('div');
            if (!devSel.find('div').length > 0) {
                jQuery(this).before(jQuery(document.createElement('hr')));
            }
        });
       
    });

    jQuery(document).ready(function(){
        var device_width = jQuery(window).width();
        if(healthyThingyObj.is_mobile == ''){
            if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load();
            }else if(healthyThingyObj.left_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load_left();
            }else if(healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load_right();
            }
        }
    })

    jQuery(window).resize(function() { 
         if(healthyThingyObj.is_mobile == ''){
            if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load();
            }else if(healthyThingyObj.left_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load_left();
            }else if(healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load_right();
            }
        }
    }); 

//custom function to detect scroll bottom
(function( $ ){
   $.fn.scrollBottom = function() {
      return $(document).height() - this.scrollTop() - this.height();  
   }; 
})( jQuery );

// //action triggeres ads refresh functionalty
var lastScrollTop = 0;
let firedEvents = [];
let firedEventsBack = [];
let firedEventsFooter = [];

jQuery(window).scroll(function(event){
    var device_width = jQuery(window).width();
    var bottom = jQuery(window).scrollBottom();
    var st = jQuery(this).scrollTop();
    //when scroll bottom
    if (st > lastScrollTop){
        //for br tag
        jQuery("br").each(function() {
            if (!firedEvents.includes(this) && jQuery(window).scrollTop() > jQuery(this).offset().top) {
                // console.log(jQuery(window).scrollTop() + '/' + jQuery(this).offset().top);
                
                firedEvents.push(this);
            
                if(healthyThingyObj.is_mobile == '' && firedEvents.length >= 1){
                    if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load();
                    }else if(healthyThingyObj.left_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load_left();
                    }else if(healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load_right();
                    }
                }
            }

        });
        //scroll native ads refresh
        jQuery(".theiaPostSlider_footer, .ctx-article-root").each(function() {
            if (!firedEventsFooter.includes(this) && jQuery(window).scrollTop() > jQuery(this).offset().top) {
                // console.log(jQuery(window).scrollTop() + '/' + jQuery(this).offset().top);
                firedEventsFooter.push(this);
            
                // var device_width = jQuery(window).width();
                // if ( && healthyThingyObj.left_ads_layout == 'action-triggered-ads' ){
                //     action_triggered_ads_load();
                // }else if(){

                // }

                if(healthyThingyObj.is_mobile == '' && firedEvents.length >= 1){
                    if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load();
                    }else if(healthyThingyObj.left_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load_left();
                    }else if(healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                        action_triggered_ads_load_right();
                    }
                }
            }
        });

    firedEventsBack = [];
    // firedEventsBack = [];

    //when scroll up
    }else {
        //for body section ads refresh
        // firedEventsBack = [];
        jQuery("figure").each(function() {
            // console.log(jQuery(window).scrollTop() + '/' +bottom);
            if(!firedEventsBack.includes(this) && bottom > jQuery(this).offset().top){
                // if(firedEvents.includes(this)){
                    firedEvents.pop();
                // }
                // console.log(firedEvents);
                firedEventsBack.push(this);
                console.log(firedEventsBack);
            }
        });
    }



  lastScrollTop = st;
  if (jQuery(this).scrollTop()  <= 50 ){
      firedEvents = [];
  }
});



})(jQuery);
