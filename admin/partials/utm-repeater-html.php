<div id="post-slide-settings">
    <?php
    //echo '<pre>';print_r(get_option('ht_post_slides_data')); exit(); 
    $box_data = get_option('ht_post_slides_data');
    ?>  
    <form action="" method="POST">
        <div class="table-wrapper">
            <div class="accordion-container">
                <h2>Post Slide Settings</h2>
                <?php if (!empty($box_data)): ?>
                    <?php foreach ($box_data as $each_data): ?>
                        <div class="set">
                            <a href="javascript:void(0);">
                                Utm Box - <?php
                                if($each_data['traffic_match_by'] == 'match_by_utm'){
                                    echo $each_data['utm_source'] . ' (' . $each_data['device'] . ')';
                                }
                                if($each_data['traffic_match_by'] == 'match_by_campaign'){
                                    echo $each_data['utm_campaign'] . ' (' . $each_data['device'] . ')';
                                }
                                if($each_data['traffic_match_by'] == 'match_by_string'){
                                    echo $each_data['string_match'] . ' (' . $each_data['device'] . ')';
                                }
                                if($each_data['traffic_match_by'] == 'match_by_id'){
                                    echo 'Post Id : '.$each_data['id_match'] . ' (' . $each_data['device'] . ')';
                                }
                                
                                ?>
                                <i class="fa fa-plus"></i>
                            </a>
                            <div class="content">
                                <table>
                                    <tr>
                                        <th ><label for="traffic_match_by">Traffic Match By :</label></th>
                                        <td>
                                            <select class="single_field traffic_match_by" name="traffic_match_by[]">
                                                <option value="match_by_utm" <?php echo ($each_data['traffic_match_by'] == 'match_by_utm') ? 'selected' : ''; ?>>Utm Source</option>
                                                <option value="match_by_campaign" <?php echo ($each_data['traffic_match_by'] == 'match_by_campaign') ? 'selected' : ''; ?>>Utm Campaign</option>
                                                <option value="match_by_id" <?php echo ($each_data['traffic_match_by'] == 'match_by_id') ? 'selected' : ''; ?>>Match by Post Id</option>
                                                <option value="match_by_string" <?php echo ($each_data['traffic_match_by'] == 'match_by_string') ? 'selected' : ''; ?>>String Match</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="id-match-field common-field">
                                        <th><label for="id_match">Post Id :</label></th>
                                        <td><input class="single_field" type="number" min="0" value="<?php echo $each_data['id_match']; ?>" name="id_match[]" placeholder="Enter Valid Post ID"/></td>
                                    </tr>
                                    <tr class="string-match-field common-field">
                                        <th><label for="string_match">String Match :</label></th>
                                        <td><input class="single_field" type="text" value="<?php echo $each_data['string_match']; ?>" name="string_match[]" placeholder="String Match"/></td>
                                    </tr>
                                    <tr class="utm-match-field common-field">
                                        <th><label for="utm_value">Utm Source :</label></th>
                                        <td><input class="single_field" type="text" value="<?php echo $each_data['utm_source']; ?>" name="utm_source[]" placeholder="Utm source"/></td>
                                    </tr>
                                    <tr class="utm-campaign-field common-field">
                                        <th><label for="utm_value">Utm Campaign :</label></th>
                                        <td><input class="single_field" type="text" value="<?php echo $each_data['utm_campaign']; ?>" name="utm_campaign[]" placeholder="Utm campaign"/></td>
                                    </tr>
                                    <tr>
                                        <th ><label for="device">Device Type :</label></th>
                                        <td>
                                            <select class="single_field "   name="device[]">
                                                <option value="desktop" <?php echo ($each_data['device'] == 'desktop') ? 'selected' : ''; ?>>Desktop</option>
                                                <option value="mobile" <?php echo ($each_data['device'] == 'mobile') ? 'selected' : ''; ?>>Mobile</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th ><label for="layout">Choose layout :</label></th>
                                        <td>
                                            <select class="single_field layout_style"  name="layout[]">
                                                <option value="slides" <?php echo ($each_data['layout'] == 'slides') ? 'selected' : ''; ?>>Slides</option>
                                                <option value="long-form-scroll" <?php echo ($each_data['layout'] == 'long-form-scroll') ? 'selected' : ''; ?>>Long form with infinite scroll</option>
                                                <option value="long-form-fixed" <?php echo ($each_data['layout'] == 'long-form-fixed') ? 'selected' : ''; ?>>Long form with fixed content</option>
                                                <option value="none" <?php echo ($each_data['layout'] == 'none') ? 'selected' : ''; ?>>None</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="qty_field">
                                        <th ><label for="layout_qty">Quantity of layout :</label></th>
                                        <td>
                                            <input class="single_field" type="text" value="<?php echo $each_data['layout_qty']; ?>" name="layout_qty[]" placeholder="Qunatity of layout"/>
                                        </td>
                                    </tr>
                                    <tr class="first-slide">
                                        <th ><label for="first_slide">Show first slide :</label></th>
                                        <td>
                                            <select class="single_field first_slide_field" name="first_slide[]">
                                                <option value="yes" <?php echo ($each_data['first_slide'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="no" <?php echo ($each_data['first_slide'] == 'no') ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="first-image <?php echo ($each_data['first_slide'] == 'yes') ? 'first-image-hide' : ''; ?>">
                                        <th ><label for="first_image">Show first image :</label></th>
                                        <td>
                                            <select class="single_field" name="first_image[]">
                                                <option value="yes" <?php echo ($each_data['first_image'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="no" <?php echo ($each_data['first_image'] == 'no') ? 'selected' : ''; ?>>No</option>
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
                            Utm Box 
                            <i class="fa fa-plus"></i>
                        </a>
                        <div class="content">
                            <table>
                                <tr>
                                    <th ><label for="traffic_match_by">Traffic Match By :</label></th>
                                    <td>
                                        <select class="single_field traffic_match_by"   name="traffic_match_by[]">
                                            <option value="match_by_utm" >Utm Source</option>
                                            <option value="match_by_campaign" >Utm Campaign</option>
                                            <option value="match_by_id" >Match by Post Id</option>
                                            <option value="match_by_string" >String Match</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="id-match-field common-field">
                                    <th><label for="id_match">Post Id :</label></th>
                                    <td><input class="single_field" type="number" min="0" value="" name="id_match[]" placeholder="Enter Valid Post ID"/></td>
                                </tr>
                                <tr class="string-match-field common-field" style="display:none;">
                                    <th><label for="string_match">String Match :</label></th>
                                    <td><input class="single_field" type="text" value="" name="string_match[]" placeholder="String Match"/></td>
                                </tr>
                                <tr class="utm-match-field common-field">
                                    <th><label for="utm_value">Utm value :</label></th>
                                    <td><input class="single_field" type="text" value="default" name="utm_source[]" placeholder="Utm value"/></td>
                                </tr>
                                <tr class="utm-campaign-field common-field">
                                    <th><label for="utm_value">Utm Campaign :</label></th>
                                    <td><input class="single_field" type="text" value="default" name="utm_campaign[]" placeholder="Utm Campaign"/></td>
                                </tr>
                                <tr>
                                    <th ><label for="device">Device Type :</label></th>
                                    <td>
                                        <select class="single_field"  name="device[]">
                                            <option value="desktop" selected>Desktop</option>
                                            <option value="mobile">Mobile</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th ><label for="layout">Choose layout :</label></th>
                                    <td>
                                        <select class="single_field"  name="layout[]">
                                            <option value="slides" selected>Slides</option>
                                            <option value="long-form-scroll">Long form with infinite scroll</option>
                                            <option value="long-form-fixed">Long form with fixed content</option>
                                            <option value="none">None</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="qty_field">
                                    <th ><label for="layout_qty">Quantity of layout :</label></th>
                                    <td>
                                        <input class="single_field" type="text" value="2" name="layout_qty[]" placeholder="Qunatity of layout"/>
                                    </td>
                                </tr>
                                <tr class="first-slide">
                                    <th ><label for="first_slide">Show first slide :</label></th>
                                    <td>
                                        <select class="single_field first_slide_field" name="first_slide[]">
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="first-image">
                                    <th ><label for="first_slide">Show first image :</label></th>
                                    <td>
                                        <select class="single_field" name="first_image[]">
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
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