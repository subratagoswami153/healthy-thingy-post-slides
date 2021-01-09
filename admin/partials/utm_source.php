<?php 
/*  Save post slides settings */

if (isset($_POST['save'])) {

    $data = [];
    $utm_campaign = $_POST['data'][1];
    $utm_sources = $_POST['data'][2];
    $post_ids = $_POST['data'][0];
    $data['id_match'] = $this->filter_raw_data($post_ids,'id_match');
    $data['utm_campaign'] = $this->filter_raw_data($utm_campaign,'utm_campaign');
    $data['utm_source'] = $this->filter_raw_data($utm_sources,'utm_source');
    
    update_option('ht_post_slides_data', $data);
}
/*  fetch data */
$utm_data = get_option('ht_post_slides_data');

?>

<div class="main-wrapper">
    <form action="" method="post">
        <h2><i class="fa fa-chevron-circle-right"></i> <?php _e('Post Id Settings', 'fdgdfg'); ?></h2>
        <div class="ht-row">
            <div class="ht-col-6">
                <div class="desktop common-divider">
                    <h3><i class="fa fa-desktop" style="font-size: 14px;"></i> &nbsp;<b><?php _e('Desktop'); ?></b></h3>
                    <div class="set-container">
                        <?php foreach($utm_data['id_match']['desktop'] as $post_id=>$each_data): $desktop = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/post_id_set.php' ); ?>
                        <?php endforeach;unset($post_id);unset($each_data);unset($desktop);?>
                    </div>
                    <button class="button button-primary margin-10 add-post-id-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                </div>
            </div>
            <div class="ht-col-6">
                
                    <div class="mobile common-divider">
                        <h3><i class="fa fa-mobile"></i> &nbsp;<b><?php _e('Mobile'); ?></b></h3>
                        <div class="set-container">
                        <?php foreach($utm_data['id_match']['mobile'] as $post_id=>$each_data): $mobile = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/post_id_set.php' ); ?>
                        <?php endforeach;unset($post_id);unset($each_data);unset($mobile);?>
                    </div>
                        <button class="button button-primary margin-10 add-post-id-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                    </div>
                
            </div>
        </div>
        <hr>
        <h2><i class="fa fa-chevron-circle-right"></i> <?php _e('Utm Campaign & Source', 'fdgdfg'); ?></h2>
        <div class="ht-row">
            <div class="ht-col-6">
                <div class="desktop common-divider">
                    <h3><i class="fa fa-desktop" style="font-size: 14px;"></i> &nbsp;<b><?php _e('Desktop'); ?></b></h3>
                    <div class="set-container">
                        <?php foreach($utm_data['utm_campaign']['desktop']['contains'] as $utm=>$each_data): $desktop = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_campaign_set.php' ); ?>
                        <?php endforeach;unset($utm);unset($each_data);unset($desktop);?>
                        <?php foreach($utm_data['utm_campaign']['desktop']['exclude'] as $utm=>$each_data): $desktop = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_campaign_set.php' ); ?>
                        <?php endforeach;unset($utm);unset($each_data);unset($desktop);?>
                    </div>
                    <button class="button button-primary margin-10 add-utm-campaign-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                </div>
            </div>
            <div class="ht-col-6">
                
                    <div class="mobile common-divider">
                        <h3><i class="fa fa-mobile"></i> &nbsp;<b><?php _e('Mobile'); ?></b></h3>
                        <div class="set-container">
                            <?php foreach($utm_data['utm_campaign']['mobile']['contains'] as $utm=>$each_data): $mobile = TRUE; ?>
                            <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_campaign_set.php' ); ?>
                            <?php endforeach;unset($utm);unset($each_data);unset($mobile);?>
                            <?php foreach($utm_data['utm_campaign']['mobile']['exclude'] as $utm=>$each_data): $mobile = TRUE; ?>
                            <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_campaign_set.php' ); ?>
                            <?php endforeach;unset($utm);unset($each_data);unset($mobile);?>
                    </div>
                        <button class="button button-primary margin-10 add-utm-campaign-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                    </div>
                
            </div>
             
        </div>
        <hr>
        <h2><i class="fa fa-chevron-circle-right"></i> <?php _e('Utm Source', 'fdgdfg'); ?></h2>
        <div class="ht-row">
            <div class="ht-col-6">
                <div class="desktop common-divider">
                    <h3><i class="fa fa-desktop" style="font-size: 14px;"></i> &nbsp;<b><?php _e('Desktop'); ?></b></h3>
                    <div class="set-container">
                        <?php foreach($utm_data['utm_source']['desktop'] as $utm=>$each_data): $desktop = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_source_set.php' ); ?>
                        <?php endforeach;unset($utm);unset($each_data);unset($desktop);?>
                    </div>
                    <button class="button button-primary margin-10 add-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                </div>
            </div>
            <div class="ht-col-6">
                
                    <div class="mobile common-divider">
                        <h3><i class="fa fa-mobile"></i> &nbsp;<b><?php _e('Mobile'); ?></b></h3>
                        <div class="set-container">
                        <?php foreach($utm_data['utm_source']['mobile'] as $utm=>$each_data): $mobile = TRUE; ?>
                        <?php include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_source_set.php' ); ?>
                        <?php endforeach;unset($utm);unset($each_data);unset($mobile);?>
                    </div>
                        <button class="button button-primary margin-10 add-fields-group" type="button" ><i class="fa fa-plus-circle"></i> <strong>Add more</strong></button>
                    </div>
                
            </div>
            <div class="ht-col-12"><input class="button button-primary" type="submit" name="save" value="Save settings"></div>
                
        </div>
    </form>

</div>

<?php
ob_start();
include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_source_set.php' );
$set_html = ob_get_contents();
ob_end_clean();
ob_start();
include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/post_id_set.php' );
$post_html = ob_get_contents();
ob_end_clean();
ob_start();
include ( plugin_dir_path(dirname(__FILE__)) . 'partials/loop/utm_campaign_set.php' );
$campaign_html = ob_get_contents();
ob_end_clean();
?>
<script type="text/javascript">



    jQuery(".add-fields-group").click(function () {

        var accordion_html = `<?php echo $set_html; ?>`;
        var elem = jQuery(this).parents('.common-divider').find('.set-container');
        jQuery(accordion_html).hide().appendTo(elem).fadeIn(500);
        //jQuery(this).parents('.common-divider').find('.set-container').append(accordion_html);


    });
    jQuery(".add-post-id-fields-group").click(function () {

        var accordion_html = `<?php echo $post_html; ?>`;
        var elem = jQuery(this).parents('.common-divider').find('.set-container');
        jQuery(accordion_html).hide().appendTo(elem).fadeIn(500);
    });
    
    jQuery(".add-utm-campaign-fields-group").click(function () {

        var accordion_html = `<?php echo $campaign_html; ?>`;
        var elem = jQuery(this).parents('.common-divider').find('.set-container');
        jQuery(accordion_html).hide().appendTo(elem).fadeIn(500);
    });

</script>