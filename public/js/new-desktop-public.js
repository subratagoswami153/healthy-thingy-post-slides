jQuery(document).ready(function ($) {
    //eraseCookie('load_content');
    
    if (healthyThingyObj.periodical_yes == 'yes') {
        var eq_pos = localStorage.getItem("eq_position_" + healthyThingyObj.current_post);
        if (eq_pos != null) {
            $('.p-show').removeClass('p-show').addClass('p-none');
            $('.p-none:eq(' + eq_pos + ')').nextAll(':lt( '+healthyThingyObj.layout_qty_ajax+' )').removeClass('p-none').addClass('p-show');
            // delete local storage if it reach last content
            var last_elem = $('.p-show').last();
            if (!last_elem.nextAll().hasClass('p-none')) {
            eraseCookie('load_content');    
            localStorage.removeItem("eq_position_" + healthyThingyObj.current_post);
            eraseCookie('load_content');
        }
        }
    }

    
    if (healthyThingyObj.post_style === 'long-form-fixed' && healthyThingyObj.utm_exists == '1') {
        if ($('.p-show').last().nextAll().hasClass('p-none')) {
            // add next and prev post url if exists  for upper
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._next').addClass('load_next_content');

            // for lower
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._next').addClass('load_next_content');
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._next').find('._1').text('Next');
        }


    }
    var _no_of_click = 0;
    $(document).on('click', '.load_next_content', function (e) {
        e.preventDefault();
        setCookie('load_content',true,1);
        if (healthyThingyObj.periodical_yes == 'yes') {
            _no_of_click = _no_of_click + 1;
            if (_no_of_click >= parseInt(healthyThingyObj.periodical_interval)) {
                window.location.href = '';
                return false;
            }
        }
        jQuery(document).triggerHandler('advanced-ads-resize-window');
        default_ads_load_left_append();
        default_ads_load_right_append();
        var last_elem = $('.p-show').last();

        last_elem.prevAll().fadeOut(500, function () {
            $(this).hide();
        });
        last_elem.fadeOut(500, function () {
            $(this).hide();
        });
        last_elem.nextAll(':lt( ' + healthyThingyObj.layout_qty_ajax + ' )').removeClass('p-none').addClass('p-show');

        if (healthyThingyObj.periodical_yes == 'yes') {
            // get the latest display element again to set index number in local storage
            var last_elem = $('.p-show').last();
            // Store
            localStorage.setItem("eq_position_" + healthyThingyObj.current_post, last_elem.index());
            // increase no of click

        }


        var body = $("html, body");
        body.stop().animate({scrollTop: 0}, 500, 'swing', function () {});
        $(this).removeClass('_disabled');
        $('div._loading').remove();
        if (!last_elem.nextAll().hasClass('p-none')) {
            localStorage.removeItem("eq_position_" + healthyThingyObj.current_post);
            $(this).removeClass('load_next_content');
            $(this).find('._1').text('Next Post');
        }
    });

    $(document).ready(function () {
        $(window).scrollTop(0);
    });
});



//left rail custom default ad append
function default_ads_load_left_append() {
    jQuery.ajax({
        url: healthyThingyObj.ajax_url,
        type: 'post',
        data: {action: "default_ads_sidebar"},
        dataType: 'json',
        success: function (response) {
            /*   Process ads ajax */
            if (response[0]) {
                var default_ads_left = response[0]['left_ads'];
                jQuery('.single-post #ternary').html(`<aside class=" widget popli-widget clearfix">` + default_ads_left + `</aside>`);
            }
            /*  End  Process ads ajax */
        }
    });
}
//right default ads append
function default_ads_load_right_append() {
    jQuery.ajax({
        url: healthyThingyObj.ajax_url,
        type: 'post',
        data: {action: "default_ads_sidebar"},
        dataType: 'json',
        success: function (response) {
            /*   Process ads ajax */
            if (response[0]) {
                var default_ads_right = response[0]['right_ads'];
                jQuery('.single-post #secondary').html(`<aside class="widget popli-widget clearfix" style="">` + default_ads_right + `</aside>`);
            }
            /*  End  Process ads ajax */
        }
    });
}


function setCookie(key, value, expiry) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }

    function getCookie(key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }

    function eraseCookie(key) {
        var keyValue = getCookie(key);
        setCookie(key, keyValue, '-1');
    }