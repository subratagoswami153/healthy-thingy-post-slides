<div id="utm-campaign-default-settings">
    <?php
    
    $campaign_default_data = get_option('utm_campaign_default_data');
    if(!empty($campaign_default_data)){
        /* Retrive desktop default campaign data */
        $desktop_layout = $campaign_default_data['desktop']['layout'];
        $desktop_layout_qty = $campaign_default_data['desktop']['layout_qty'];
        $desktop_first_slide = $campaign_default_data['desktop']['first_slide'];
        $desktop_first_image = $campaign_default_data['desktop']['first_image'];
        /* Retrive mobile default campaign data */
        $mobile_layout = $campaign_default_data['mobile']['layout'];
        $mobile_layout_qty = $campaign_default_data['mobile']['layout_qty'];
        $mobile_first_slide = $campaign_default_data['mobile']['first_slide'];
        $mobile_first_image = $campaign_default_data['mobile']['first_image'];
    }
    ?>  
    <form action="" method="POST">
        <div class="table-wrapper" >
            <div class="accordion-container">
                <h2><?php _e('If utm_campaign does not match or contain.','healthy-thingy-post-slides'); ?></h2>
                <div class="set">
                        <a href="javascript:void(0);" class="active">
                            <?php _e('Default layout for desktop','healthy-thingy-post-slides'); ?>
                            <i class="fa fa-minus"></i>
                        </a>
                        <div class="content" style="display:block;">
                            <table>
                                <tr>
                                    <th ><label for="traffic_match_by">Traffic Match By :</label></th>
                                    <td>
                                        <select class="single_field traffic_match_by"   name="traffic_match_by[]">
                                            <option selected="selected" value="match_by_campaign" >Utm Campaign</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th ><label for="device">Device Type :</label></th>
                                    <td>
                                        <select class="single_field"  name="device[]">
                                            <option value="desktop" selected>Desktop</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th ><label for="layout">Choose layout :</label></th>
                                    <td>
                                        <select class="single_field layout_style"  name="layout[]">
                                            <option <?php echo (isset($desktop_layout) && $desktop_layout=='slides')?'selected':''; ?> value="slides" >Slides</option>
                                            <option <?php echo (isset($desktop_layout) && $desktop_layout=='long-form-scroll')?'selected':''; ?> value="long-form-scroll">Long form with infinite scroll</option>
                                            <option <?php echo (isset($desktop_layout) && $desktop_layout=='long-form-fixed')?'selected':''; ?> value="long-form-fixed">Long form with fixed content</option>
                                            <option <?php echo (isset($desktop_layout) && $desktop_layout=='none')?'selected':''; ?> value="none">None</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="qty_field">
                                    <th ><label for="layout_qty">Quantity of layout :</label></th>
                                    <td>
                                        <input class="single_field" type="text" value="<?php echo (isset($desktop_layout_qty))?$desktop_layout_qty:''; ?>" name="layout_qty[]" placeholder="Qunatity of layout"/>
                                    </td>
                                </tr>
                                <tr class="first-slide">
                                    <th ><label for="first_slide">Show first slide :</label></th>
                                    <td>
                                        <select class="single_field first_slide_field" name="first_slide[]">
                                            <option value="yes" <?php echo (isset($desktop_first_slide) && $desktop_first_slide=='yes')?'selected':''; ?>>Yes</option>
                                            <option value="no" <?php echo (isset($desktop_first_slide) && $desktop_first_slide=='no')?'selected':''; ?>>No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="first-image">
                                    <th ><label for="first_slide">Show first image :</label></th>
                                    <td>
                                        <select class="single_field" name="first_image[]">
                                            <option value="yes" <?php echo (isset($desktop_first_image) && $desktop_first_image=='yes')?'selected':''; ?>>Yes</option>
                                            <option value="no" <?php echo (isset($desktop_first_image) && $desktop_first_image=='no')?'selected':''; ?>>No</option>
                                        </select>
                                    </td>
                                </tr>
                             </table>
                        </div>
                    </div>
                <div class="set">
                        <a href="javascript:void(0);" class="active">
                            <?php _e('Default layout for mobile','healthy-thingy-post-slides'); ?>
                            <i class="fa fa-minus"></i>
                        </a>
                        <div class="content" style="display:block;">
                            <table>
                                <tr>
                                    <th ><label for="traffic_match_by">Traffic Match By :</label></th>
                                    <td>
                                        <select class="single_field traffic_match_by"   name="traffic_match_by[]">
                                            <option selected="selected" value="match_by_campaign" >Utm Campaign</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th ><label for="device">Device Type :</label></th>
                                    <td>
                                        <select class="single_field"  name="device[]">
                                            <option value="mobile" selected>Mobile</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th ><label for="layout">Choose layout :</label></th>
                                    <td>
                                        <select class="single_field layout_style"  name="layout[]">
                                            <option <?php echo (isset($mobile_layout) && $mobile_layout=='slides')?'selected':''; ?> value="slides" >Slides</option>
                                            <option <?php echo (isset($mobile_layout) && $mobile_layout=='long-form-scroll')?'selected':''; ?> value="long-form-scroll">Long form with infinite scroll</option>
                                            <option <?php echo (isset($mobile_layout) && $mobile_layout=='long-form-fixed')?'selected':''; ?> value="long-form-fixed">Long form with fixed content</option>
                                            <option <?php echo (isset($mobile_layout) && $mobile_layout=='none')?'selected':''; ?> value="none">None</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="qty_field">
                                    <th ><label for="layout_qty">Quantity of layout :</label></th>
                                    <td>
                                        <input class="single_field" type="text" value="<?php echo (isset($mobile_layout_qty))?$mobile_layout_qty:''; ?>" name="layout_qty[]" placeholder="Qunatity of layout"/>
                                    </td>
                                </tr>
                                <tr class="first-slide">
                                    <th ><label for="first_slide">Show first slide :</label></th>
                                    <td>
                                        <select class="single_field first_slide_field" name="first_slide[]">
                                            <option value="yes" <?php echo (isset($mobile_first_slide) && $mobile_first_slide=='yes')?'selected':''; ?>>Yes</option>
                                            <option value="no" <?php echo (isset($mobile_first_slide) && $mobile_first_slide=='no')?'selected':''; ?>>No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="first-image">
                                    <th ><label for="first_slide">Show first image :</label></th>
                                    <td>
                                        <select class="single_field" name="first_image[]">
                                            <option value="yes" <?php echo (isset($mobile_first_image) && $mobile_first_image=='yes')?'selected':''; ?>>Yes</option>
                                            <option value="no" <?php echo (isset($mobile_first_image) && $mobile_first_image=='no')?'selected':''; ?>>No</option>
                                        </select>
                                    </td>
                                </tr>
                             </table>
                        </div>
                    </div>

                    

            </div>
        </div>
        <div class="settings-save">
                        <table>
            <tr>
                <td><input class="button button-primary" type="submit" name="campaign_default_save" value="Save"></td>
            </tr>
        </table>
                    </div>

    </form>
</div>