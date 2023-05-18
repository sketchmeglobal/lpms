<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 */
?>
<?php
// print_r($buyer_details);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Customer Order | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add customer order">

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
            <h3 class="m-b-less">Add Customer Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Customer Order</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-10">
                    <section class="panel">
                        <div class="panel-body">
                            <form id="form_add_customer_order" method="post" action="<?=base_url('admin/form_add_customer_order')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                <!-- <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="am_id" class="control-label text-danger">Article *</label>
                                        <select id="am_id" name="am_id" required class="select2 form-control round-input">
                                            <option value="">Select Article</option>
                                            < ?php foreach($article_masters as $val) { ?>
                                                <option value="< ?=$val['am_id']?>">< ?=$val['art_no']?></option>
                                            < ?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="lc_id" class="control-label text-danger">Leather Colour *</label>
                                        <select id="lc_id" name="lc_id" required class="select2 form-control round-input">
                                            <option value="">Select Leather Colour</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="fc_id" class="control-label text-danger">Fittings Colour *</label>
                                        <select id="fc_id" name="fc_id" required class="select2 form-control round-input">
                                            <option value="">Select Fittings Colour</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="order_no" class="control-label text-danger">Order Number *</label>
                                        <input id="order_no" name="order_no" type="text" placeholder="Order Number" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="acc_master_id" class="control-label text-danger">Buyer / Customer *</label>
                                        <select name="acc_master_id" class="form-control select2">
                                                <?php
                                                foreach($buyer_details as $bd){
                                                    $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                                ?> 
                                                    <option value="<?= $bd->am_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="buyref" class="control-label">Buyer Ref. No.</label>
                                        <input id="buyref" name="buyref" type="text" placeholder="Buyer Ref. No." class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="ref_date" class="control-label">Ref. Date</label>
                                        <input id="ref_date" name="ref_date" type="date" placeholder="Ref. Date" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="order_date" class="control-label text-danger">Order Date *</label>
                                        <input id="order_date" name="order_date" type="date" placeholder="Order Date" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="delv_date" class="control-label text-danger">Delivery Date *</label>
                                        <input id="delv_date" name="delv_date" type="date" placeholder="Delivery Date" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="rate_type" class="control-label text-danger">Price Type *</label>
                                        <select class="select2 form-control" name="rate_type">
                                            <option value="Ex-works Price">Ex-works Price</option>
                                            <option value="C&F Price">C&F Price</option>
                                            <option value="CIF Price">CIF Price</option>
                                            <option value="FOB Price">FOB Price</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-5">
                                        <label for="remarks" class="control-label">Remarks</label>
                                        <input id="remarks" name="remarks" type="text" placeholder="Remarks" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="order_date" class="control-label">Shipment Date 1</label>
                                        <input value="" id="shipment_date" name="shipment_date" type="date" placeholder="Shipment Date 1" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="order_date" class="control-label">Shipment Date 2</label>
                                        <input value="" id="shipment_date2" name="shipment_date2" type="date" placeholder="Shipment Date 2" class="form-control round-input" />
                                    </div>

                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label for="img" class="control-label">Documents</label>
                                        <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png,.doc,.docx,.xls,.pdf" class="file" >
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="control-label text-danger">Show in outstanding report/not *</label><br />
                                        <input type="radio" name="show_in_outstanding_report" id="enable" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="show_in_outstanding_report" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Customer Order</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Customer Order</i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-lg-2">
                    <section class="panel">
                        <div class="panel-body">
                            <label><strong>Total Amount</strong></label><br />
                            <div class="bg-dark text-center" style="padding: 2%">00.00</div>
                            <hr />
                            <label><strong>Total Quantity</strong></label><br /> 
                            <div class="bg-dark text-center" style="padding: 2%">00.00</div>
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
    //add-item-form validation and submit
    $("#form_add_customer_order").validate({
        
        rules: {
            order_no: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_customer_order_number')?>",
                    type: "post",
                    data: {
                        order_no: function() {
                          return $("#order_no").val();
                        }
                    },
                },
            },
            delv_date: {
                required: true
            },
            order_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_customer_order').ajaxForm({
        beforeSubmit: function () {
            // alert($('#order_no').val());
            return $("#form_add_customer_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_customer_order')[0].reset(); //reset form
            $("#form_add_customer_order select").select2("val", ""); //reset all select2 fields
            $('#form_add_customer_order :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_customer_order").validate().resetForm(); //reset validation
            notification(obj);
            window.location.href = '<?=base_url()?>admin/edit-customer-order/'+obj.insert_id;
            // $('#edit_btn').attr('href', '<?=base_url()?>admin/edit-customer-order/'+obj.insert_id);
            // $('#edit_btn').removeClass('hidden');
        }
    });

    //fetch article colours
    // $("#am_id").on('change', function () {
    //    $am_id = $("#am_id").val();

    //    $.ajax({
    //        url: "< ?= base_url('ajax-fetch-article-colours') ?>",
    //        method: "post",
    //        dataType: 'json',
    //        data: {'am_id': $am_id,},
    //        success: function(data){
    //             console.log(data);
    //             $.each(data, function (index, itemData) {
    //                 $str1 = '<option value="'+itemData.leather_id +'">'+ itemData.leather_color +' ['+ itemData.leather_code +']' +'<option>';
    //                 $("#lc_id").append($str1);
    //                 $str2 = '<option value="'+itemData.fitting_id +'">'+ itemData.fitting_color +' ['+ itemData.fitting_code +']' +'<option>';
    //                 $("#fc_id").append($str2);
    //             });
    //         //    $('#article_img').attr('src', '< ?=base_url()?>assets/admin_panel/img/article_img/'+data.img);
    //        },
    //    });
    // });

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