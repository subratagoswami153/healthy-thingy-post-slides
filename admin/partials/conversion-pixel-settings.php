<?php

if (isset($_POST['save'])) {
    $data = [];
    $cp_devices = $_POST['cp_field_device'];
    
    foreach ($cp_devices as $key => $cp_device) {
        $each_box = [
            'cp_device' => trim(stripslashes($cp_device)),
            'cp_field_qty' => trim(stripslashes($_POST['cp_field_qty'][$key])),
            'cp_field_script' => stripslashes($_POST['cp_field_script'][$key]),
        ];
        array_push($data, $each_box);
    }
    update_option('cp_sctipts_list', $data);
}
?>
<div id="post-slide-settings">
    <?php $cp_data = get_option('cp_sctipts_list'); ?>
    <form action="" method="POST">
        <div class="table-wrapper">
            <div class="accordion-container set-container">
                <h2>Conversion pixel Settings</h2>
                <?php if(!empty($cp_data)):?>
                <?php foreach ($cp_data as $each_data):?>
                <div class="set">
                    <a href="javascript:void(0);">
                        CP Box
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <table>
                            <tr>
                                <th ><label for="device">Device Type :</label></th>
                                <td>
                                    <select class="single_field" name="cp_field_device[]">
                                        <option value="desktop" <?php echo ($each_data['cp_device']=='desktop')?'selected':'' ;?>>Desktop</option>
                                        <option value="mobile" <?php echo ($each_data['cp_device']=='mobile')?'selected':'' ;?>>Mobile</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="cp_qty">
                                <th ><label for="layout_qty">Quantity of layout :</label></th>
                                <td>
                                    <input class="single_field" type="text" value="<?php echo $each_data['cp_field_qty'];?>" name="cp_field_qty[]" placeholder="Qunatity of layout"/>
                                </td>
                            </tr>
                            <tr class="cp-script">
                                <th ><label for="cp_script">Script :</label></th>
                                <td>
                                    <textarea name="cp_field_script[]" placeholder="Qunatity of layout"><?php echo $each_data['cp_field_script'];?> </textarea>
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
                        CP Box
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="content">
                        <table>
                            <tr>
                                <th ><label for="device">Device Type :</label></th>
                                <td>
                                    <select class="single_field "   name="cp_field_device[]">
                                        <option value="desktop">Desktop</option>
                                        <option value="mobile">Mobile</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="cp_qty">
                                <th ><label for="layout_qty">Quantity of layout :</label></th>
                                <td>
                                    <input class="single_field" type="text" value="" name="cp_field_qty['qty']" placeholder="Qunatity of layout"/>
                                </td>
                            </tr>
                            <tr class="cp-script">
                                <th ><label for="cp_script">Script :</label></th>
                                <td>
                                    <textarea name="cp_field_script[]" placeholder="Qunatity of layout"> </textarea>
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

        var accordion_html = '<div class="set">' +
                    '<a href="javascript:void(0);"> CP Box <i class="fa fa-plus"></i></a>'+
                    '<div class="content">'+
                    '<table>'+
                    '<tr>'+
                    '<th ><label for="device">Device Type :</label></th>'+
                    '<td>'+
                    '<select class="single_field " name="cp_field_device[]">'+
                    '<option value="desktop">Desktop</option>'+
                    '<option value="mobile">Mobile</option>'+
                    '</select>'+
                    '</td>'+
                    '</tr>'+
                    '<tr class="cp_qty">'+
                    '<th ><label for="layout_qty">Quantity of layout :</label></th>'+
                    '<td>'+
                    '<input class="single_field" type="text" value="" name="cp_field_qty[]" placeholder="Qunatity of layout"/>'+
                    '</td>'+
                    '</tr>'+
                    '<tr class="cp-script">'+
                    '<th ><label for="cp_script">Script :</label></th>'+
                    '<td>'+
                    '<textarea name="cp_field_script[]" placeholder="Qunatity of layout"> </textarea>'+
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
