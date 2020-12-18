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
     //bot side action triggeres
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

    //left rail acction triggered
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
    //right rail action triggered
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
    //left rail custom default ad append
    function default_ads_load_left_append(){
        jQuery.ajax({
            url: healthyThingyObj.ajax_url,
            type: 'post',
            data: {action: "default_ads_sidebar" },
            dataType: 'json',
            success: function (response) {
                /*   Process ads ajax */
                if (response[0]) {
                    var default_ads_left = response[0]['left_ads'];
                    jQuery('.single-post #ternary').append(`<aside class=" widget popli-widget clearfix">`+default_ads_left+`</aside>`);
                }
                /*  End  Process ads ajax */
            }
        });
    }
    //right default ads append
    function default_ads_load_right_append(){
        jQuery.ajax({
            url: healthyThingyObj.ajax_url,
            type: 'post',
            data: {action: "default_ads_sidebar" },
            dataType: 'json',
            success: function (response) {
                /*   Process ads ajax */
                if (response[0]) {
                    var default_ads_right = response[0]['right_ads'];
                    jQuery('.single-post #secondary').append(`<aside class="widget popli-widget clearfix" style="">`+default_ads_right+`</aside>`);
                }
                /*  End  Process ads ajax */
            }
        });
    }

    //final function for ads
    function ads_load_all(){
        var l;
        var adsCount = healthyThingyObj.ads_unit_for_action_trigger;
        var device_width = jQuery(window).width();
        if(healthyThingyObj.is_mobile == ''){
            if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'action-triggered-ads'){
                action_triggered_ads_load();
            }else if(healthyThingyObj.left_ads_layout == 'action-triggered-ads' && healthyThingyObj.right_ads_layout == 'default-ads'){
                action_triggered_ads_load_left();
                for(l=0; l<adsCount;l++){
                    default_ads_load_right_append();
                }
            }else if(healthyThingyObj.right_ads_layout == 'action-triggered-ads' && healthyThingyObj.left_ads_layout == 'default-ads'){
                action_triggered_ads_load_right();
                // jQuery('.single-post #ternary div').html('');
                for(l=0; l<adsCount;l++){
                    default_ads_load_left_append();
                }
            }else if(healthyThingyObj.right_ads_layout == 'default-ads' && healthyThingyObj.left_ads_layout == 'default-ads'){
                // jQuery('.single-post #secondary div').html('');
                // jQuery('.single-post #ternary div').html('');
                for(l=0; l<adsCount;l++){
                    default_ads_load_right_append();
                    default_ads_load_left_append();
                } 
            }
        }
    }
    //
    jQuery(document).ready(function () {
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

    // var timeout;
    // var flag = true;
    // var total = 2;
    // jQuery(window).on('scroll', function ($) {
    //     if (!healthyThingyObj.utm_exists)
    //         return false
    //     if (healthyThingyObj.is_mobile == '1' && healthyThingyObj.post_style_mobile != 'long-form-scroll')
    //         return false
    //     if (healthyThingyObj.is_mobile == '' && healthyThingyObj.post_style != 'long-form-scroll')
    //         return false
    //     clearTimeout(timeout);
    //     timeout = setTimeout(function () {
    //         // do your stuff
    //         if (jQuery(window).scrollTop()+5000 >= jQuery('.theiaPostSlider_preloadedSlide').offset().top + jQuery('.theiaPostSlider_preloadedSlide').outerHeight() - window.innerHeight) {
    //             //alert('hjhb');
    //             if (flag == true)
    //                 var next = parseInt((typeof jQuery('.theiaPostSlider_preloadedSlide').attr('data-next') === "undefined") ? 1 : jQuery('.theiaPostSlider_preloadedSlide').attr('data-next'));
    //             if (next >= total)
    //                 return false;

    //             jQuery('.infinite-scroll-loader').show();
    //             jQuery.ajax({
    //                 url: healthyThingyObj.ajax_url,
    //                 type: 'post',
    //                 data: {action: "healthy_thingy_post_slides_infinite_scroll", desktop_qty: healthyThingyObj.desktop_qty, mobile_qty: healthyThingyObj.mobile_qty, post_id: healthyThingyObj.current_post, next_page: next, },
    //                 dataType: 'json',
    //                 success: function (response) {

    //                     jQuery('.infinite-scroll-loader').hide();
    //                     if (response.flag != false) {
    //                         jQuery('.theiaPostSlider_preloadedSlide').attr('data-next', response.next_page);
    //                         total = parseInt(response.total);
    //                     }

    //                     jQuery('.theiaPostSlider_preloadedSlide').append(response.html);
    //                     /*   Process ads ajax */
    //                     if (response.ads_response) {
    //                         var i;
    //                         for (i = 0; i < response.ads_response.length; i++) {
    //                             var ad = response.ads_response[i];
    //                             jQuery(ad.item).insertAfter('.healthy-thingy-' + response.container_class + ' '+ad.element);
    //                         }
    //                     }

    //                     if (response.ads_response_sidebar[0]) {
    //                         var j;
    //                         // for (i = 0; i < response.ads_response_sidebar[0]length; i++) {
    //                         var ads_sidebar = response.ads_response_sidebar[0];
    //                         if(ads_sidebar.enable_ads == 'left'){
    //                             for(j=0; j<healthyThingyObj.desktop_qty; j++){
    //                                 jQuery('#ternary').append(ads_sidebar.left_ads);
    //                             }  
    //                         }else if(ads_sidebar.enable_ads == 'right'){
    //                             for(j=0; j<healthyThingyObj.desktop_qty; j++){
    //                                 jQuery('#secondary').append(ads_sidebar.right_ads);
    //                             }
    //                         }else if(ads_sidebar.enable_ads == 'both'){
    //                             for(j=0; j<healthyThingyObj.desktop_qty; j++){
    //                                 jQuery('#ternary').append(ads_sidebar.left_ads);
    //                                 jQuery('#secondary').append(ads_sidebar.right_ads);
    //                             }
    //                         }
    //                     }
    //                     /*  End  Process ads ajax */
    //                     jQuery(".popli-left-rail-top").each(function() {  
    //                       var ads_height = jQuery(this).height();
    //                       if(ads_height <= 300){
    //                         jQuery(this).addClass('less_300');
    //                       }else if(ads_height >= 300){
    //                         jQuery(this).addClass('bigger_300');
    //                       }
    //                     });
    //                 }

    //             });
    //             flag = false;
    //             //on ajax complete
    //             jQuery(document).ajaxComplete(function (event, request, settings) {
    //                 flag = true;
    //                 // remove wp-has-aspect-ration from figure
    //                 if (jQuery('.wp-block-embed-youtube').hasClass("wp-has-aspect-ratio")) {
    //                     jQuery('.wp-block-embed-youtube').removeClass("wp-has-aspect-ratio");
    //                 }

    //             });

    //         }
    //     }, 50);

    // });

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
        ads_load_all();
    })
    setTimeout(function(){ 
        jQuery(window).resize(function() { 
            jQuery('.single-post #secondary div').html('');
            jQuery('.single-post #ternary div').html('');
            ads_load_all();
        }); 
    }, 5000);



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
    var leftCount = jQuery("#ternary > aside").length;
    var rightCount = jQuery("#secondary > aside").length;
    var device_width = jQuery(window).width();
    var bottom = jQuery(window).scrollBottom();
    var st = jQuery(this).scrollTop();
    //when scroll bottom
    if (st > lastScrollTop){
        //for br tag
        jQuery("br").each(function() {
            if (!firedEvents.includes(this) && jQuery(window).scrollTop() > jQuery(this).offset().top) {                
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
        //fixed last ad inside ternary
        // if(healthyThingyObj.is_mobile == '' && sideAds>1){
        //     if (jQuery(window).scrollTop() > jQuery('#ternary div:last').offset().top) {
        //         if(healthyThingyObj.left_ads_layout == 'default-ads'){
        //             jQuery('#ternary aside:last').css('position', 'fixed');
        //             jQuery('#ternary aside:last').css('top', '0px');
        //             jQuery('#ternary aside:last').css('width', '300px');
        //         }
        //     }
        // }

        if(healthyThingyObj.is_mobile == '' && healthyThingyObj.fixed_last_ad == 1){
            if(leftCount>1){
                if(healthyThingyObj.left_ads_layout == 'default-ads'){
                    if (jQuery(window).scrollTop() > jQuery('#ternary div:last').offset().top) {
                        jQuery('#ternary aside:last').css('position', 'fixed');
                        jQuery('#ternary aside:last').css('top', '0px');
                        // jQuery('#ternary aside:last').css('width', '300px');
                    }
                }
            }else if(leftCount == 1){
                jQuery('#ternary aside:first').css('position', 'fixed');
                jQuery('#ternary aside:first').css('top', '0px');
                // jQuery('#ternary aside:first').css('width', '300px');
            }
        }
        //fixed last ad inside secondary
        if(healthyThingyObj.is_mobile == '' && healthyThingyObj.fixed_last_ad == 1){
            if(rightCount>1){
                if(healthyThingyObj.right_ads_layout == 'default-ads'){
                    if (jQuery(window).scrollTop() > jQuery('#secondary div:last').offset().top) {
                        jQuery('#secondary aside:last').css('position', 'fixed');
                        jQuery('#secondary aside:last').css('top', '0px');
                        // jQuery('#secondary aside:last').css('width', '300px');
                    }
                }
            }else if(rightCount == 1){
                jQuery('#secondary aside:first').css('position', 'fixed');
                jQuery('#secondary aside:first').css('top', '0px');
                // jQuery('#secondary aside:first').css('width', '300px');
            }
        }

    firedEventsBack = [];
    //when scroll up
    }else {
        //check distance between last 2 ads for default ad 
                
        if(healthyThingyObj.is_mobile == '' && healthyThingyObj.fixed_last_ad == 1){
            if(leftCount>1){
                //left ads
                if(healthyThingyObj.left_ads_layout == 'default-ads'){
                    var distanceLeft = (jQuery('#ternary aside:last').offset().top) - (jQuery('#ternary aside:nth-last-child(2)').offset().top);
                    if (jQuery(window).scrollTop() < jQuery('#ternary div:last').offset().top) {
                        if(distanceLeft<500){
                            jQuery("#ternary aside").each(function() { 
                                jQuery('#ternary aside').css('position', '');
                            });
                        } 
                    }
                }
            }
                //right ads
            if(rightCount>1 && healthyThingyObj.fixed_last_ad == 1){
                if(healthyThingyObj.right_ads_layout == 'default-ads'){
                    var distanceRight = (jQuery('#secondary aside:last').offset().top) - (jQuery('#secondary aside:nth-last-child(2)').offset().top);
                    if (jQuery(window).scrollTop() < jQuery('#secondary div:last').offset().top) {
                        if(distanceRight<500){
                            jQuery("#secondary aside").each(function() { 
                                jQuery('#secondary aside').css('position', '');
                            });
                        }
                    }
                }
            }
        }
        //for reset each content when scroll up
        jQuery("figure").each(function() {
            if(!firedEventsBack.includes(this) && bottom > jQuery(this).offset().top){
                    firedEvents.pop();
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
