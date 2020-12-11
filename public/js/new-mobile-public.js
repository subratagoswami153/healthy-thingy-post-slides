jQuery(document).ready(function ($) {
    if (healthyThingyObj.is_mobile == '1' && healthyThingyObj.post_style_mobile === 'long-form-fixed' && healthyThingyObj.utm_exists == '1') {
        if ($('.p-show').last().nextAll().hasClass('p-none')) {
            // add next and prev post url if exists  for upper
            jQuery('#tps_nav_upper_' + healthyThingyObj.current_post).find('a._next').addClass('load_next_content');

            // for lower
            jQuery('#tps_nav_lower_' + healthyThingyObj.current_post).find('a._next').addClass('load_next_content');
        }


    }
    $(document).on('click', '.load_next_content', function (e) {
        e.preventDefault();
        var last_elem = $('.p-show').last();
        last_elem.nextAll(':lt( '+healthyThingyObj.mobile_qty+' )').removeClass('p-none').addClass('p-show');
        $(this).removeClass('_disabled');
        $('div._loading').remove();
        if (!last_elem.nextAll().hasClass('p-none')) {
            $(this).removeClass('load_next_content');
        }
    });
});
