(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
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


    $(document).on('click', '.remove-box', function () {

        var len = $('.set-container .set').length;
        if (!(len > 1))
            return false;

        var target = $(this).parents('.set');
        //target.remove();
        target.find('.content').css('background-color', '#de8d8d');
        target.fadeOut(500, function () {
            $(this).remove();
        });
    });
})(jQuery);

jQuery(document).ready(function ($) {
    $(document).on('click', '.set > a', function () {
        // alert('bhvh');
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                    .siblings(".content")
                    .slideUp(200);
            $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
        } else {
            $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
            $(this)
                    .find("i")
                    .removeClass("fa-plus")
                    .addClass("fa-minus");
            //$(".set > a").removeClass("active");
            $(this).addClass("active");
            //$(".content").slideUp(200);
            $(this)
                    .siblings(".content")
                    .slideDown(200);
        }
    });



    jQuery(document).on('change', '.traffic_match_by', function () {

        $(this).parents('table').find('.common-field').hide();
        var matchBy = jQuery(this).children("option:selected").val();
        if (matchBy == 'match_by_utm')
            $(this).parents('table').find('.utm-match-field').show();
        if (matchBy == 'match_by_campaign')
            $(this).parents('table').find('.utm-campaign-field').show();
        if (matchBy == 'match_by_id')
            $(this).parents('table').find(".id-match-field").show();
        if (matchBy == 'match_by_string')
            $(this).parents('table').find(".string-match-field").show();

    });

    // On change layout 
    jQuery(document).on('change', '.layout_style', function () {
        var this_table = $(this).parents('table');
        var current_layout = jQuery(this).val();
        if (current_layout == 'long-form-fixed' || current_layout == 'long-form-scroll') {
            this_table.find('.qty_field').show();
            if (current_layout == 'long-form-fixed') {
                this_table.find('.first-slide').show();
                this_table.find('.fixed-content-ajax').show();
                this_table.find('.periodical-content').show();
            } else {
                this_table.find('.first-slide').hide();
                this_table.find('.fixed-content-ajax').hide();
                this_table.find('.first-image').show();
                this_table.find('.periodical-content').hide();
                this_table.find('.periodical-qty').hide();
            }

        } else {
            this_table.find('.qty_field').hide();
            this_table.find('.first-slide').hide();
            this_table.find('.first-image').hide();
            this_table.find('.fixed-content-ajax').hide();
            this_table.find('.periodical-content').hide();
            this_table.find('.periodical-qty').hide();
        }
    });

    //on change first image display hide
    jQuery(document).on('change', '.first_slide_field', function () {
        var this_table = $(this).parents('table');
        var first_sld = jQuery(this).children("option:selected").val();
        if (first_sld == 'no') {
            this_table.find('.first-image').show();
            this_table.find('.first-image select').val("no");
        } else {
            this_table.find('.first-image').hide();
        }
    });

    //on change divice display hide
    jQuery(document).on('change', '.device_match_by', function () {
        var matchBy = jQuery(this).children("option:selected").val();
        if (matchBy == 'mobile') {
            $(this).parents('table').find('.hide-mobile').hide();
        } else {
            $(this).parents('table').find('.hide-mobile').show();
        }
    });
    //on change load ajax yes or no
    jQuery(document).on('change', '.ajax_match_by', function () {
        var matchBy = jQuery(this).children("option:selected").val();
        if (matchBy == 'no') {
            $(this).parents('table').find('.qty_field_ajax').hide();
            $(this).parents('table').find('.qty_field label').text('Quantity of layout : ');
            $(this).parents('table').find('.periodical-content').hide();
            $(this).parents('table').find('.periodical-qty').hide();
        } else {
            $(this).parents('table').find('.qty_field_ajax').show();
            $(this).parents('table').find('.qty_field label').text('Initial quantity of layout : ');
            $(this).parents('table').find('.periodical-content').show();
        }
    });

    //on change load ajax yes or no
    /*jQuery(document).on('change', '.periodical-yes', function () {
        var matchBy = jQuery(this).val();
        alert(matchBy);
        if (matchBy == 'no') {

        } else {

        }
    });*/
    jQuery(document).on('change','.periodical-yes',function(e){
        e.preventDefault();
        if($(this).prop('checked')){
            $(this).siblings('input').val('yes');
            $(this).parents('table').find('.periodical-qty').show();
        }else{
            $(this).parents('table').find('.periodical-qty').hide();
            $(this).siblings('input').val('');
        }
    });

});

