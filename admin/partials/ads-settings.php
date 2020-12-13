<?php

if (isset($_POST['save'])) {
    
    $data = [];
    $sidebar_data = [];
    $action_triggered_data = [];
    $default_data = [];
    $ads_settings = $_POST['ad_group_id'];
    
    foreach ($ads_settings as $key => $ads_setting) {
        $settings = [
            'ad_group_id' => trim(stripslashes($ads_setting)),
            'ad_placement' => $_POST['ad_group_placemenmt'][$key],
        ];
        array_push($data, $settings);
    }
    update_option('ht_ads_settings', $data);

    // $sidebar_ads_data = [
    //     'left_ads_id' => trim(stripslashes($_POST['left_ad_group_id'])),
    //     'right_ads_id' => trim(stripslashes($_POST['right_ad_group_id'])),
    //     'sidebar_enable_ads' => $_POST['enable_infinite_scroll'],
    // ];
    // array_push($sidebar_data, $sidebar_ads_data);
    // update_option('sidebar_ads_settings', $sidebar_data);

    //save action triggered ads settings
    $action_triggered_ads_data = [
        'left_ads_id' => trim(stripslashes($_POST['action_triggered_left_ad_group_id'])),
        'right_ads_id' => trim(stripslashes($_POST['action_triggered_right_ad_group_id'])),
    ];
    array_push($action_triggered_data, $action_triggered_ads_data);
    update_option('action_triggered_ads_settings', $action_triggered_ads_data);
    //save default ads settings
    $default_ads_data = [
        'left_ads_id' => trim(stripslashes($_POST['default_left_ad_group_id'])),
        'right_ads_id' => trim(stripslashes($_POST['default_right_ad_group_id'])),
    ];
    array_push($default_data, $default_ads_data);
    update_option('default_ads_settings', $default_ads_data);

    update_option('hide_previous_button', $_POST['hide_previous_button']);
    update_option('action_triggered_top_margin', $_POST['action_triggered_top_margin']);

    update_option('next_prev_button_style_desktop', $_POST['next_prev_button_style_desktop']);
    update_option('sidebar_default_fixed_ads', $_POST['sidebar_default_fixed_ads']);
}
?>
<div id="ht-ads-settings">
    <?php 
    $ads_data = get_option('ht_ads_settings'); 
    $sidebar_ads_data = get_option('sidebar_ads_settings');
    $default_ads_data = get_option('default_ads_settings');
    $action_triggered_ads_data = get_option('action_triggered_ads_settings');

    ?>
    <form action="" method="POST">
        <!-- on Additional settings -->
        <h2>Aditional settings</h2>
        <table>
            <tr class="ads_group_left">
                <th ><label for="hide-previous-button">Hide previous button for mobile :</label></th>
                <td>
                    <input class="single_field" type="checkbox" value="1" <?php if(!empty(get_option('hide_previous_button'))) echo "checked='checked'"; ?> name="hide_previous_button"/>
                </td>
            </tr>

            <tr class="ads_group_left">
                <th ><label for="next-previous-button-desktop">Enable next & prev button style for desktop:</label></th>
                <td>
                    <input class="single_field" type="checkbox" value="1" <?php if(!empty(get_option('next_prev_button_style_desktop'))) echo "checked='checked'"; ?> name="next_prev_button_style_desktop"/>
                </td>
            </tr>

            <tr class="ads_group_left">
                <th ><label for="hide-previous-button">Top margin for left and right ads:</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo (get_option('action_triggered_top_margin') != '')?get_option('action_triggered_top_margin'):'150px'; ?>" name="action_triggered_top_margin"/>
                </td>
            </tr>
        </table>    
        <!-- on demand ads settings -->
<!--         <h2>On demand ads settings</h2>
        <table>
            <tr class="ads_group_left">
                <th ><label for="left_ads_group_id">Ads group ID for Left rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php //echo ($sidebar_ads_data[0]['left_ads_id'] != '')?$sidebar_ads_data[0]['left_ads_id']:'' ;?>" name="left_ad_group_id" placeholder="Ads group ID for left rail"/>
                </td>
            </tr>

            <tr class="ads_group_right">
                <th ><label for="right_ads_group_id">Ads group ID for right rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php //echo ($sidebar_ads_data[0]['right_ads_id'] != '')?$sidebar_ads_data[0]['right_ads_id']:'' ;?>" name="right_ad_group_id" placeholder="Ads group ID for right rail"/>
                </td>
            </tr>


            <tr class="ads_group_right">
                <th ><label for="right_left_enable_infinite_scroll">Enable infinite scroll ads for:</label></th>
                <td>
                    <select class="single_field"  name="enable_infinite_scroll">
                        <option value="left" <?php //echo ($sidebar_ads_data[0]['sidebar_enable_ads'] == 'left') ? 'selected' : ''; ?>>Left rails</option>
                        <option value="right" <?php //echo ($sidebar_ads_data[0]['sidebar_enable_ads'] == 'right') ? 'selected' : ''; ?>>Right rails</option>
                        <option value="both" <?php //echo ($sidebar_ads_data[0]['sidebar_enable_ads'] == 'both') ? 'selected' : ''; ?>>Both side</option>
                        <option value="none" <?php// echo ($sidebar_ads_data[0]['sidebar_enable_ads'] == 'none') ? 'selected' : ''; ?>>None</option>
                    </select>
                </td>
            </tr>
        </table> -->
        <!-- action triggered ads settings -->
        <h2>Action triggered ads settings</h2>
        <table>
            <tr class="ads_group_left">
                <th ><label for="left_ads_group_id">Ads group ID for Left rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo ($action_triggered_ads_data['left_ads_id'] != '')?$action_triggered_ads_data['left_ads_id']:'' ;?>" name="action_triggered_left_ad_group_id" placeholder="Ads group ID for left rail"/>
                </td>
            </tr>

            <tr class="ads_group_right">
                <th ><label for="right_ads_group_id">Ads group ID for right rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo ($action_triggered_ads_data['right_ads_id'] != '')?$action_triggered_ads_data['right_ads_id']:'' ;?>" name="action_triggered_right_ad_group_id" placeholder="Ads group ID for right rail"/>
                </td>
            </tr>
        </table>
        <!-- on demand ads settings -->
        <h2>Default ads settings</h2>
        <table>
            <tr class="ads_group_left">
                <th ><label for="left_ads_group_id">Ads group ID for Left rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo ($default_ads_data['left_ads_id'] != '')?$default_ads_data['left_ads_id']:'' ;?>" name="default_left_ad_group_id" placeholder="Ads group ID for left rail"/>
                </td>
            </tr>

            <tr class="ads_group_right">
                <th ><label for="right_ads_group_id">Ads group ID for right rail :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo ($default_ads_data['right_ads_id'] != '')?$default_ads_data['right_ads_id']:'' ;?>" name="default_right_ad_group_id" placeholder="Ads group ID for right rail"/>
                </td>
            </tr>

            <tr class="ads_group_left">
                <th ><label for="hide-previous-button">Fixed last ad :</label></th>
                <td>
                    <input class="single_field" type="checkbox" value="1" <?php if(!empty(get_option('sidebar_default_fixed_ads'))) echo "checked='checked'"; ?> name="sidebar_default_fixed_ads"/>
                </td>
            </tr>
        </table>
        <div class="table-wrapper">
            <div class="accordion-container set-container">
                <h2>Ads Settings</h2>
                <?php if(!empty($ads_data)):?>
                <?php foreach ($ads_data as $each_data):?>
                <div class="set">
                    <a href="javascript:void(0);">
                        Ads settings
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <table>
                            <tr class="ads_group">
                                <th ><label for="ads_group_id">Ads group ID :</label></th>
                                <td>
                                    <input class="single_field" type="text" value="<?php echo $each_data['ad_group_id'];?>" name="ad_group_id[]" placeholder="Ads group ID"/>
                                </td>
                            </tr>
                            <tr>
                                <th ><label for="device">Ads placement:</label></th>
                                <td>
                                    <select class="single_field" name="ad_group_placemenmt[]">
                                        <option value="p" <?php echo ($each_data['ad_placement']=='p')?'selected':'' ;?>>After Paragraph</option>
                                        <option value="img" <?php echo ($each_data['ad_placement']=='img')?'selected':'' ;?>>After Image</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th ></th>
                                <td>
                                    <a class="btn button button-link-delete remove-box" href="javascript:void(0);">Remove</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="set">
                    <a href="javascript:void(0);">
                        Ads settings
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <table>
                           <tr class="ads_group">
                                <th ><label for="ads_group_id">Ads group ID :</label></th>
                                <td>
                                    <input class="single_field" type="text" value="" name="ad_group_id[]" placeholder="Ads group ID"/>
                                </td>
                            </tr>
                            <tr>
                                <th ><label for="device">Ads placement:</label></th>
                                <td>
                                    <select class="single_field" name="ad_group_placemenmt[]">
                                        <option value="p">After Paragraph</option>
                                        <option value="img">After Image</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th ></th>
                                <td>
                                    <a class="btn button button-link-delete remove-box" href="javascript:void(0);">Remove</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <table>
            <tr>
                <th><button class="button button-primary" type="button" id="add-fields-group">+ Add more</button></th>
                <td><input class="button button-primary" type="submit" name="save" value="Save settings"></td>
            </tr>
        </table>
    </form>

</div>


<script type="text/javascript">

    jQuery(document).ready(function ($) {
        
    });

    jQuery("#add-fields-group").click(function () {

        var accordion_html = 
                '<div class="set">'+
                '<a href="javascript:void(0);">Ads settings'+
                '<i class="fa fa-plus"></i></a>'+
                '<div class="content">'+
                '<table>'+
                '<tr class="ads_group">'+
                '<th ><label for="ads_group_id">Ads group ID :</label></th>'+
                '<td>'+
                '<input class="single_field" type="text" value="" name="ad_group_id[]" placeholder="Ads group ID"/>'+
                '</td>'+
                '</tr>'+
                '<tr>'+
                '<th ><label for="device">Ads placement:</label></th>'+
                '<td>'+
                '<select class="single_field" name="ad_group_placemenmt[]">'+
                '<option value="p">After Paragraph</option>'+
                '<option value="img">After Image</option>'+
                '</select>'+
                '</td>'+
                '</tr>'+
                '<tr>'+
                '<th ></th>'+
                '<td>'+
                '<a class="btn button button-link-delete remove-box" href="javascript:void(0);">Remove</a>'+
                '</td>'+
                '</tr>'+
                '</table>'+
                '</div>'+
                '</div>';
        jQuery('.accordion-container').append(accordion_html);
        //jQuery('.device-select-box').select2();
        
        
    });
    
</script>
