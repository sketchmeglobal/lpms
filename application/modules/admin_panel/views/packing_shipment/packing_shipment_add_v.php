<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Packing/Shipment | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add Purchase order">

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
    <div class="body-content" style="min-height: 600px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Add Packing/Shipment</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Packing/Shipment</li>
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
                            <form id="form_packing_shipment_add" method="post" action="<?=base_url('admin/form-add-packing-shipment')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-3">
                                	<label for="package_name" class="control-label text-danger">Package Name *</label>
                                	<input id="package_name" name="package_name" type="text" placeholder="Package Name" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="package_date" class="control-label text-danger">Package Date *</label>
                                    <input id="package_date" name="package_date" type="date" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="package_note" class="control-label">Package Note</label>
                                    <input id="package_note" name="package_note" type="text" placeholder="Package Note" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <textarea id="remarks" name="remarks" placeholder="Remarks" class="form-control round-input"></textarea>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="terms_of_delivery" class="control-label">Terms of Delivery</label>
                                    <textarea id="terms_of_delivery" name="terms_of_delivery" placeholder="Terms of Delivery" class="form-control round-input"></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="mark_container" class="control-label">Mark & Container</label>
                                    <textarea id="mark_container" name="mark_container" placeholder="Mark & Container" class="form-control round-input"></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="pre_carriage_by" class="control-label">Pre-Carriage:</label>
                                    <select id="pre_carriage_by" name="pre_carriage_by" class="form-control select2">
                                        <option value="">Pre-Carriage</option>
                                        <option value="1">By Air</option>
                                        <option value="2">By Ship </option>
                                        <option value="3">By Road</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="port_of_discharge" class="control-label">Port of Discharge</label>
                                    <textarea id="port_of_discharge" name="port_of_discharge" placeholder="Port of Discharge" class="form-control round-input"></textarea>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="no_of_kind_of_package" class="control-label">No. & Kind of Package</label>
                                    <textarea rows="8" id="no_of_kind_of_package" name="no_of_kind_of_package" placeholder="No. & Kind of Package" class="form-control"></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="description_of_goods" class="control-label">Desc. of Goods</label>
                                    <textarea rows="8" id="description_of_goods" name="description_of_goods" placeholder="Desc. of Goods" class="form-control"></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="header_box_size" class="control-label">Dimension.</label>
                                    <textarea rows="8" id="header_box_size" name="header_box_size" placeholder="Box Size" class="form-control"></textarea>
                                </div>

                                <div class="col-lg-3">
                                    <label for="net_qnty" class="control-label">Buyer (if other than consignee)</label>
                                    <select id="am_id_other" name="am_id_other" class="form-control select2">
                                        <option value="">Select Buyer</option>
                                            <?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                    <label for="notify" class="control-label">Notify</label>
                                    <textarea rows="5" id="notify" name="notify" placeholder="Notify" class="form-control"></textarea>
                                </div>
                                
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add </i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit </i></a>
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
	
    //add-item-form validation and submit
    $("#form_packing_shipment_add").validate({
        
        rules: {
			package_name: {
                required: true
            },
            package_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_packing_shipment_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_packing_shipment_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				window.location.href = '<?=base_url()?>admin/edit-packing-shipment/'+obj.insert_id;
			}
        }
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