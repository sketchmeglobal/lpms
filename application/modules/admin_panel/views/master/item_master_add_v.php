<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 25-02-2020
 * Time: 17:58
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Item | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add item">

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
</head>

<body class="sticky-header">

<section>
    <!-- sidebar left start (Menu)-->
    <?php $this->load->view('components/left_sidebar'); //left side menu ?>
    <!-- sidebar left end (Menu)-->

    <!-- body content start-->
    <div class="body-content" style="min-height: 1500px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Add Item</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Item </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form id="form_add_item" method="post" action="<?=base_url('admin/form_add_item')?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <label for="item_group" class="control-label col-lg-2 text-danger">Item Group *</label>
                                    <div class="col-lg-4">
                                        <select id="item_group" name="item_group" required class="select2 form-control round-input">
                                            <option value="" group_code="">Select Item Group</option>
                                                <?php foreach($item_groups as $val) { ?>
                                                    <option value="<?=$val['ig_id']?>" group_code="<?=$val['ig_code']?>"><?=$val['group_name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>

                                    <label for="item_code" class="control-label col-lg-2 text-danger">Item Code *</label>
                                    <div class="col-lg-4">
                                        <input id="item_code" name="item_code" type="text" placeholder="Item code" required class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="size" class="control-label col-lg-2 text-danger">Size *</label>
                                    <div class="col-lg-2">
                                        <select id="size" name="size" required class="select2 form-control round-input">
                                            <option value="" size="">Select size</option>
                                            <?php foreach($sizes as $val) { ?>
                                                <option <?= ($val['size'] == 'None') ? 'selected' : '' ?> value="<?=$val['sz_id']?>" size="<?=$val['size']?>"><?=$val['size']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="size" class="control-label col-lg-2 text-danger">Shape *</label>
                                    <div class="col-lg-2">
                                        <select id="shape" name="shape" required class="select2 form-control round-input">
                                            <option value="" shape="">Select shape</option>
                                            <?php foreach($shapes as $val) { ?>
                                                <option <?= ($val['shape'] == 'None') ? 'selected' : '' ?> value="<?=$val['sh_id']?>" shape="<?=$val['shape']?>"><?=$val['shape']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="unit" class="control-label col-lg-2 text-danger">Unit *</label>
                                    <div class="col-lg-2">
                                        <select id="unit" name="unit" required class="select2 form-control round-input">
                                            <option value="" unit="">Select unit</option>
                                            <?php foreach($units as $val) { ?>
                                                <option <?= ($val['unit'] == 'None') ? 'selected' : '' ?> value="<?=$val['u_id']?>" unit="<?=$val['unit']?>"><?=$val['unit'] . ' - ' . $val['info']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="desc1" class="control-label col-lg-2">Description I</label>
                                    <div class="col-lg-4">
                                        <input id="desc1" name="desc1" type="text" placeholder="First description" class="form-control round-input" />
                                    </div>

                                    <label for="desc2" class="control-label col-lg-2">Description II</label>
                                    <div class="col-lg-4">
                                        <input id="desc2" name="desc2" type="text" placeholder="Second description" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="item_name" class="control-label col-lg-2 text-danger">Item Name *</label>
                                    <div class="col-lg-4">
                                        <input id="item_name" name="item_name" type="text" placeholder="Name of the item" required class="form-control round-input" />
                                    </div>

                                    <label for="item_type" class="control-label col-lg-2 text-danger">Item Type *</label>
                                    <div class="col-lg-4">
                                        <select id="item_type" name="item_type" required class="select2 form-control round-input">
                                            <option value="">Select type</option>
                                            <option value="None">None</option>
                                            <option value="Local">Local</option>
                                            <option value="Import">Import</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="thick" class="control-label col-lg-1">Thickness</label>
                                    <div class="col-lg-3">
                                        <input id="thick" name="thick" type="text" placeholder="Thickness" class="form-control round-input" />
                                    </div>

                                    <label for="buy_code" class="control-label col-lg-1">Buying Code</label>
                                    <div class="col-lg-3">
                                        <input id="buy_code" name="buy_code" type="text" placeholder="Buying Code" class="form-control round-input" />
                                    </div>
                                    
                                    <label for="hsn_code" class="control-label col-lg-1">HSN Code</label>
                                    <div class="col-lg-3">
                                        <input id="hsn_code" name="hsn_code" type="text" placeholder="HSN Code" class="form-control round-input" />
                                    </div>

                                    <!-- <label for="sell_code" class="control-label col-lg-2">Sell Code</label>
                                    <div class="col-lg-2">
                                        <input id="sell_code" name="sell_code" type="text" placeholder="Sell code" class="form-control round-input" />
                                    </div> -->
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-lg-2 text-danger">Enlist in Jobber? *</label>
                                    <div class="col-lg-2">
                                        <input type="radio" name="jobber" id="yes" value="1" checked required class="iCheck-square-green">
                                        <label for="yes" class="control-label">Yes</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="jobber" id="no" value="0" required class="iCheck-square-red">
                                        <label for="no" class="control-label">No</label>
                                    </div>
                        
                                    <label class="control-label col-lg-2 text-danger">Enlist in Costing *</label>
                                    <div class="col-lg-2">
                                        <input type="radio" name="show_in_costing" id="enable1" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="show_in_costing" id="disable1" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    
                                    <label class="control-label col-lg-2 text-danger">Status *</label>
                                    <div class="col-lg-2">
                                        <input type="radio" name="status" id="enable" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="img" class="control-label col-lg-2">Image</label>
                                    <div class="col-lg-4">
                                        <input type="file" id="imgg" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                    </div>
                                    <br/>
                                    <br/>
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"> Add Item</i></button>
                                        <a id="edit_item_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Item</i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <?php $this->load->view('components/footer'); ?>
        <!--footer section end-->

    </div>
    <!-- body content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?=base_url()?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>
<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>
<!--Select2-->
<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>
<script>
    $('.select2').select2();
</script>
<!--Icheck-->
<script src="<?=base_url();?>assets/admin_panel/js/icheck/skins/icheck.min.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/icheck-init.js"></script>
<!--form validation-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js"></script>
<!--ajax form submit-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>
<script>
    $("#img").fileinput({
        // browseClass : "btn btn-danger",
        maxFileSize : 1000, //1 Mb
        allowedFileExtensions : ['jpg','jpeg','png'],
        showUpload: false,
    });
</script>
<script>
    //add-item-form validation and submit
    $("#form_add_item").validate({
        rules: {
            item_code: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_code')?>",
                    type: "post",
                    data: {
                        item_id: '',
                    },
                },
            },
            item_name: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_name')?>",
                    type: "post",
                    data: {
                        item_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_item').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_item").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_item')[0].reset(); //reset form
            $("#form_add_item select").select2("val", ""); //reset all select2 fields
            $('#form_add_item :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item").validate().resetForm(); //reset validation
            notification(obj);

            $('#edit_item_btn').attr('href', '<?=base_url()?>admin/edit_item/'+obj.insert_id);
            $('#edit_item_btn').removeClass('hidden');
        }
    });

    //when item group changed
    $("#item_group").on("change", function() {
        group_id = $('option:selected', this).val();
        item_code = '';
        group_code = $('option:selected', this).attr('group_code');
        if(group_code != '') {item_code = group_code+'-'};
        $("#item_code").val(item_code);

        // fetch master unit and append to unit
        $.ajax({
            url: "<?= base_url('admin/ajax-unit-on-item-group') ?>",
            method: 'post',
            dataType: 'json',
            data: {group_code : group_id},
            success: function(returnData){
                $("#unit").select2("val", returnData);
            },
            error: function(e, v){
                console.log(e+v);
            }
        });

    });

    //generating item name
    $("#size, #shape, #desc1, #desc2").on("change", function() {
        item_name = '';
        size = $('option:selected', $("#size")).attr('size');
        shape = $('option:selected', $("#shape")).attr('shape');
        desc1 = $("#desc1").val();
        desc2 = $("#desc2").val();

        if(size != '' && size != 'None') {item_name = size+'-'};
        if(shape != '' && shape != 'None') {item_name = item_name+shape+'-'};
        if(desc1 != '') {item_name = item_name+desc1+'-'};
        if(desc2 != '') {item_name = item_name+desc2};

        $("#item_name").val(item_name);
    });

    //toastr notification
    function notification(obj) {
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
</script>

</body>
</html>