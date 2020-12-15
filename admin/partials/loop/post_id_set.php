<?php
$is_display_first_image = '';
$layout_label = '';
if(isset($each_data['layout'])){
    switch ($each_data['layout']):
    case 'slides':
        $layout_label = 'Slides';
        break;
    case 'long-form-fixed':
        $layout_label = 'Long form fixed';
        break;
    case 'long-form-scroll':
        $layout_label = 'Infite Scroll';
        break;
    case 'none':
        $layout_label = 'None';
        break;
    endswitch;
    
    if($each_data['layout']=='long-form-fixed' && $each_data['first_slide']=='no'){
        $is_display_first_image = 'table-row';
    }
    if($each_data['layout']=='long-form-scroll'){
        $is_display_first_image = 'table-row';
    }
}

?>
<div class="set">
    <a href="javascript:void(0);">
        <?php echo (isset($post_id)) ? 'Post Id : '.$post_id.' [ Layout style : '.$layout_label.' ]' : 'Utm Box'; ?>
        <i class="fa fa-plus"></i>
    </a>
    <div class="content">
        <table>
            <tr>
                <th ><label for="traffic_match_by">Traffic Match By :</label></th>
                <td>
                    <select class="single_field traffic_match_by"   name="data[0][traffic_match_by][]">
                        <option value="match_by_id" selected >Match by Post Id</option>
                    </select>
                </td>
            </tr>

            <tr class="id-match-field common-field">
                <th><label for="id_match">Post Id :</label></th>
                <td><input class="single_field" type="number" min="0" value="<?php echo (isset($post_id)) ? $post_id : ''; ?>" name="data[0][id_match][]" placeholder="Enter Valid Post ID"/></td>
            </tr>

            <tr>
                <th ><label for="device">Device Type :</label></th>
                <td>
                    <select class="single_field"  name="data[0][device][]">
                        <option value="desktop" <?php echo (isset($desktop)) ? 'selected' : ''; ?>>Desktop</option>
                        <option value="mobile" <?php echo (isset($mobile)) ? 'selected' : ''; ?>>Mobile</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th ><label for="layout">Choose layout :</label></th>
                <td>
                    <select class="single_field layout_style"  name="data[0][layout][]">
                        <option value="slides" <?php echo (isset($each_data['layout']) && $each_data['layout'] == 'slides') ? 'selected' : ''; ?>>Slides</option>
                        <option value="long-form-scroll" <?php echo (isset($each_data['layout']) && $each_data['layout'] == 'long-form-scroll') ? 'selected' : ''; ?>>Long form with infinite scroll</option>
                        <option value="long-form-fixed" <?php echo (isset($each_data['layout']) && $each_data['layout'] == 'long-form-fixed') ? 'selected' : ''; ?>>Long form with fixed content</option>
                        <option value="none" <?php echo (isset($each_data['layout']) && $each_data['layout'] == 'none') ? 'selected' : ''; ?>>None</option>
                    </select>
                </td>
            </tr>

            <tr class="qty_field" style="display:<?php echo ((isset($each_data['layout']) && ($each_data['layout'] != 'slides' && $each_data['layout'] != 'none'))) ? 'table-row' : ''; ?>">
                <th ><label for="layout_qty">Quantity of layout :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo (isset($each_data['layout_qty'])) ? $each_data['layout_qty'] : '2'; ?>" name="data[0][layout_qty][]" placeholder="Qunatity of layout"/>
                </td>
            </tr>
            <tr class="first-slide" style="display:<?php echo ((isset($each_data['layout']) && ($each_data['layout'] == 'long-form-fixed'))) ? 'table-row' : ''; ?>">
                <th ><label for="first_slide">Show first slide :</label></th>
                <td>
                    <select class="single_field first_slide_field" name="data[0][first_slide][]">
                        <option value="yes" <?php echo (isset($each_data['first_slide']) && $each_data['first_slide'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo (isset($each_data['first_slide']) && $each_data['first_slide'] == 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr class="first-image" style="display:<?php echo $is_display_first_image;?>">
                <th ><label for="first_image">Show first image :</label></th>
                <td>
                    <select class="single_field" name="data[0][first_image][]">
                        <option value="yes" <?php echo (isset($each_data['first_image']) && $each_data['first_image'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo (isset($each_data['first_image']) && $each_data['first_image'] == 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr class="fixed-content-ajax" style="display:<?php echo ((isset($each_data['layout']) && ($each_data['layout'] == 'long-form-fixed'))) ? 'table-row' : ''; ?>">
                <th ><label for="fixed_content_ajax">Load content using ajax :</label></th>
                <td>
                    <select class="single_field" name="data[0][fixed_content_ajax][]">
                        <option value="yes" <?php echo (isset($each_data['fixed_content_ajax']) && $each_data['fixed_content_ajax'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo (isset($each_data['fixed_content_ajax']) && $each_data['fixed_content_ajax'] == 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr class="qty_field_ajax" style="display:<?php echo ((isset($each_data['layout']) && ($each_data['layout'] != 'slides' && $each_data['layout'] != 'none' && $each_data['fixed_content_ajax'] != 'no'))) ? 'table-row' : ''; ?>">
                <th ><label for="layout_qty">Quantity of layout for ajax :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo (isset($each_data['layout_qty_ajax'])) ? $each_data['layout_qty_ajax'] : '2'; ?>" name="data[0][layout_qty_ajax][]" placeholder="Qunatity of layout for ajax"/>
                </td>
            </tr>
            <tr class="left-ads-layout" style="">
                <th ><label for="left-ads-layout">Choose left ads lauout :</label></th>
                <td>
                    <select class="single_field" name="data[0][left_ads_layout][]">
                        <option value="default-ads" <?php echo (isset($each_data['left_ads_layout']) && $each_data['left_ads_layout'] == 'default-ads') ? 'selected' : ''; ?>>Default ads</option>
                        <option value="action-triggered-ads" <?php echo (isset($each_data['left_ads_layout']) && $each_data['left_ads_layout'] == 'action-triggered-ads') ? 'selected' : ''; ?>>Action triggered ads</option>
                        <option value="on-demand-ads" <?php echo (isset($each_data['left_ads_layout']) && $each_data['left_ads_layout'] == 'on-demand-ads') ? 'selected' : ''; ?>>On demand ads</option>
                    </select>
                </td>
            </tr>
            <tr class="right-ads-layout" style="">
                <th ><label for="right-ads-layout">Choose right ads lauout :</label></th>
                <td>
                    <select class="single_field" name="data[0][right_ads_layout][]">
                        <option value="default-ads" <?php echo (isset($each_data['right_ads_layout']) && $each_data['right_ads_layout'] == 'default-ads') ? 'selected' : ''; ?>>Default ads</option>
                        <option value="action-triggered-ads" <?php echo (isset($each_data['right_ads_layout']) && $each_data['right_ads_layout'] == 'action-triggered-ads') ? 'selected' : ''; ?>>Action triggered ads</option>
                        <option value="on-demand-ads" <?php echo (isset($each_data['right_ads_layout']) && $each_data['right_ads_layout'] == 'on-demand-ads') ? 'selected' : ''; ?>>On demand ads</option>
                    </select>
                </td>
            </tr>
             <tr class="ads-unit-for-action-trigger" >
                <th ><label for="ads-unit-for-action-trigger">Ads quantity :</label></th>
                <td>
                    <input class="single_field" type="text" value="<?php echo (isset($each_data['ads_unit_for_action_trigger'])) ? $each_data['ads_unit_for_action_trigger'] : '2'; ?>" name="data[0][ads_unit_for_action_trigger][]" placeholder="Ads quantity"/>
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
