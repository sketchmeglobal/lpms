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
    <title>Add Courier Shipment | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Add Courier Shipment</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Courier Shipment</li>
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
                            <form id="form_courier_shipment_add" method="post" action="<?=base_url('admin/form-add-courier-shipment')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-3">
                                	<label for="invoice_no" class="control-label text-danger">Invoice No *</label>
                                	<input id="invoice_no" name="invoice_no" type="text" placeholder="Invoice No" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="invoice_date" class="control-label text-danger">Invoice Date *</label>
                                    <input id="invoice_date" name="invoice_date" type="date" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="shipment_through" class="control-label">Through:</label>
                                    <select id="shipment_through" name="shipment_through" class="form-control ">
                                        <option value="">Select Courier</option>
                                        <?php 
                                        foreach($courier_master as $cm){
                                            ?>
                                            <option value="<?= $cm->cm_id ?>"><?= $cm->courier_name ?></option>
                                            <?php
                                        }
                                         ?>
                                        }
                                    </select>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="am_id" class="control-label">Select Party:</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Party</option>
                                        <?php
											foreach($account_master_details as $amd){
												$sn = ($amd->short_name == '' ? '-' : $amd->short_name);
											?> 
												<option value="<?= $amd->am_id ?>" short_name="<?=$amd->short_name?>" am_code="<?=$amd->am_code?>"><?= $amd->name . ' ['. $sn .']' ?></option>
												<?php
											}
										?>
                                    </select>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="awb_number" class="control-label">AWB No.</label>
                                        <input id="awb_number" name="awb_number" type="text" placeholder="AWB No." class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="pickup_time" class="control-label">Pick up time</label>
                                        <input id="pickup_time" name="pickup_time" type="text" placeholder="Pick up time" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="weight" class="control-label">Weight</label>
                                        <input id="weight" name="weight" type="text" placeholder="Weight" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="booking_no" class="control-label">Booking No.</label>
                                        <input id="booking_no" name="booking_no" type="text" placeholder="Booking No." class="form-control round-input" />
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="leather_type" class="control-label">Leather Type</label>
                                        <input id="leather_type" name="leather_type" type="text" placeholder="Leather Type" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="box_dimention" class="control-label">Dimension</label>
                                        <input id="box_dimention" name="box_dimention" type="text" placeholder="Dimension" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="remarks" class="control-label">Remark</label>
                                        <textarea id="remarks" name="remarks" placeholder="Remark" class="form-control round-input"></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="pieces" class="control-label">Pieces</label>
                                        <input id="pieces" name="pieces" type="text" placeholder="Pieces" class="form-control round-input" />
                                    </div>                                
                                </div>
                                
                                <div class="form-group ">
                                	<div class="col-lg-3">
                                        <label for="total_foreign_amount" class="control-label">Total Foregin Amount</label>
                                        <input id="total_foreign_amount" name="total_foreign_amount" type="text" placeholder="Total Foregin Amount" class="form-control round-input" />
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
    $("#form_courier_shipment_add").validate({
        
        rules: {
			invoice_no: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-courier-shipment-number')?>",
                    type: "post",
                    data: {
                        invoice_no: function() {
                          return $("#invoice_no").val();
                        }
                    },
                },
            },
            invoice_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_courier_shipment_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_courier_shipment_add").valid(); // TRUE when form is valid, FALSE will cancel submit
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