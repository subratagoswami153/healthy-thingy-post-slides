<?php
//print_r(plugin_dir_path(dirname(__FILE__)));exit();
/* save utm campaign default settings  */
$campaign_default_data = [];
if(isset($_POST['campaign_default_save'])){
   /* Data arrange for desktop */ 
   $campaign_default_data['desktop']['traffic_match_by'] = $_POST['traffic_match_by'][0] ;
   $campaign_default_data['desktop']['layout'] = $_POST['layout'][0] ;
   $campaign_default_data['desktop']['layout_qty'] = $_POST['layout_qty'][0] ;
   $campaign_default_data['desktop']['first_slide'] = $_POST['first_slide'][0] ;
   $campaign_default_data['desktop']['first_image'] = $_POST['first_image'][0] ;

   /* Data arrange for mobile */ 
   $campaign_default_data['mobile']['traffic_match_by'] = $_POST['traffic_match_by'][1] ;
   $campaign_default_data['mobile']['layout'] = $_POST['layout'][1] ;
   $campaign_default_data['mobile']['layout_qty'] = $_POST['layout_qty'][1] ;
   $campaign_default_data['mobile']['first_slide'] = $_POST['first_slide'][1] ;
   $campaign_default_data['mobile']['first_image'] = $_POST['first_image'][1] ;

   update_option('utm_campaign_default_data',$campaign_default_data);
}



/*  Save post slides settings */
if (isset($_POST['save'])) {
    $data = [];
    $utm_sources = $_POST['utm_source'];

    foreach ($utm_sources as $key => $utm_source) {
        $each_box = [
            'utm_source' => trim(stripslashes($utm_source)),
            'utm_campaign' => trim(stripslashes($_POST['utm_campaign'][$key])),
            'string_match' => trim(stripslashes($_POST['string_match'][$key])),
            'id_match' => trim(stripslashes($_POST['id_match'][$key])),
            'traffic_match_by' => $_POST['traffic_match_by'][$key],
            'device' => $_POST['device'][$key],
            'layout' => $_POST['layout'][$key],
            'layout_qty' => $_POST['layout_qty'][$key],
            'first_slide' => $_POST['first_slide'][$key],
            'first_image' => $_POST['first_image'][$key],
        ];
        array_push($data, $each_box);
    }
    update_option('ht_post_slides_data', $data);
}

// include ( plugin_dir_path(dirname(__FILE__)) . 'partials/utm-campaign-default.php' );
include ( plugin_dir_path(dirname(__FILE__)) . 'partials/utm-repeater-html.php' );
?>



<script type="text/javascript">

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
        


        jQuery('.set').each(function () {
            var selLayout = jQuery(this).find('.layout_style').children("option:selected").val();
            var selMatchBy = jQuery(this).find('.traffic_match_by').children("option:selected").val();
            var firstSlide = jQuery(this).find('.first_slide_field').children("option:selected").val();

            if (selLayout == 'slides' || selLayout == 'none') {
                $(this).find(".qty_field").hide();
                $(this).find('.first-image').hide();
            }


            if (selLayout == 'long-form-fixed' || selLayout == 'long-form-scroll') {
                $(this).find('.first-image').show();
            } else if (firstSlide == 'yes') {
                $(this).find('.first-image').hide();
            }
            


            if (selLayout == 'long-form-fixed') {
                $(this).find('.first-slide').show();
            } else {
                $(this).find('.first-slide').hide();
            }
            // string and utm field display
            $(this).find(".common-field").hide();

            if (selMatchBy == 'match_by_utm')
                $(this).find(".utm-match-field").show();
            if (selMatchBy == 'match_by_campaign')
                $(this).find(".utm-campaign-field").show();
            if (selMatchBy == 'match_by_id')
                $(this).find(".id-match-field").show();
            if (selMatchBy == 'match_by_string')
                $(this).find(".string-match-field").show();

            
        });
        //on change
        jQuery('.set').each(function () {
            $(this).on('change', '.layout_style', function () {
                var this_table = $(this).parents('table');
                var SelStyle = $(this).children("option:selected").val();
                if (SelStyle == 'long-form-scroll' || SelStyle == 'long-form-fixed') {
                    this_table.find('.qty_field').show();
                } else {
                    this_table.find('.qty_field').hide();
                }
                //first slide field show hide
                if (SelStyle == 'long-form-fixed') {
                    this_table.find('.first-slide').show();
                } else {
                    this_table.find('.first-slide').hide();
                }
            });
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

    });

    jQuery("#add-fields-group").click(function () {

        var accordion_html = '<div class="set"><a href="javascript:void(0);">Utm Box <i class="fa fa-plus"></i></a><div class="content">' +
                '<table>' +
                '<tr>' +
                '<th>' +
                '<label for="traffic_match_by">Traffic Match By :</label>' +
                '</th>' +
                '<td>' +
                '<select class="single_field traffic_match_by"   name="traffic_match_by[]">' +
                '<option value="match_by_utm">Utm Source</option>' +
                '<option value="match_by_campaign">Utm Campaign</option>' +
                '<option value="match_by_id" >Match by Post Id</option>'+
                '<option value="match_by_string">String Match</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr class="id-match-field common-field" style="display:none; ">' +
                '<th><label for="id_match">Post Id :</label></th>' +
                '<td><input class="single_field" type="number" min="0" value="" name="id_match[]" placeholder="Enter Valid Post ID"/></td>' +
                '</tr>' +
                '<tr class="string-match-field common-field" style="display:none; ">' +
                '<th><label for="string_match">String Match :</label></th>' +
                '<td><input class="single_field" type="text" value="" name="string_match[]" placeholder="String Match"/></td>' +
                '</tr>' +
                '<tr>' +
                '<tr class="utm-match-field common-field">' +
                '<th><label for="utm_value">Utm value :</label></th>' +
                '<td><input class="single_field" type="text" value="default" name="utm_source[]" placeholder="Utm value"/></td>' +
                '</tr>' +
                '<tr class="utm-campaign-field common-field">' +
                '<th><label for="utm_campaign">Utm Campaign :</label></th>' +
                '<td><input class="single_field" type="text" value="default" name="utm_campaign[]" placeholder="Utm Campaign"/></td>' +
                '</tr>' +
                '<tr>' +
                '<th>' +
                '<label for="device">Device Type :</label>' +
                '</th>' +
                '<td>' +
                '<select class="single_field "   name="device[]">' +
                '<option value="desktop" selected>Desktop</option>' +
                '<option value="mobile">Mobile</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<th ><label for="layout">Choose layout :</label></th>' +
                '<td>' +
                '<select class="single_field layout_style"  name="layout[]">' +
                '<option value="slides" selected>Slides</option>' +
                '<option value="long-form-scroll">Long form with infinite scroll</option>' +
                '<option value="long-form-fixed">Long form with fixed content</option>' +
                '<option value="none">None</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr class="qty_field">' +
                '<th ><label for="layout_qty">Quantity of layout :</label></th>' +
                '<td>' +
                '<input class="single_field" type="text" value="2" name="layout_qty[]" placeholder="Qunatity of layout"/>' +
                '</td>' +
                '</tr>' +
                '<tr class="first-slide">' +
                '<th ><label for="first_slide">Show first slide :</label></th>' +
                '<td>' +
                '<select class="single_field first_slide_field" name="first_slide[]">' +
                '<option value="yes" selected>Yes</option>' +
                '<option value="no">No</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr class="first-image">' +
                '<th><label for="first_image">Show first image :</label></th>' +
                '<td>' +
                '<select class="single_field" name="first_image[]">' +
                '<option value="yes">Yes</option>' +
                '<option value="no">No</option>' +
                '</select>' +
                '</td>' +
                '</tr>' +
                '<tr><th ></th><td><a class="btn button button-link-delete remove-box" href="javascript:void(0);">Remove</a></td></tr>' +
                '</table>'
                + '</div></div>';
        jQuery('.accordion-container').append(accordion_html);
        //jQuery('.device-select-box').select2();


    });

</script>
