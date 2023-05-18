<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Stock In | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Purchase Order">

     <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        text-align: right;
        }

        /* Firefox */
        input[type=number] {
            text-align: right;
            -moz-appearance: textfield;
        }

        .border-black-bottom{border-bottom: 1px dotted #000}
    </style>
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
            <h3 class="m-b-less">Edit Stock In</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Stock In </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-8">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-edit-stock-in')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                	<div class="col-lg-6">
                                    <label for="purchase_order_receive_bill_no" class="control-label text-danger">Stock Bill Number *</label>
                                    <input id="purchase_order_receive_bill_no" name="purchase_order_receive_bill_no" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>" type="text" placeholder="Purchase Receive Number" class="form-control round-input" />
                                    
                                    </div>
                                    <?php 
									//echo $receive_purchase_order_details[0]->purchase_order_receive_date;
									?>
                                    <div class="col-lg-6">
                                        <label for="purchase_order_receive_date" class="control-label text-danger">Stock Bill Date *</label>
                                        <input id="purchase_order_receive_date" name="purchase_order_receive_date" value="<?php echo date('Y-m-d', strtotime($receive_purchase_order_details[0]->purchase_order_receive_date)); ?>" type="date" placeholder="Purchase Receive Date" class="form-control round-input" />
                                    </div>                                    
                                    <div class="col-lg-6">
                                        <label for="am_id_add" class="control-label">Supplier Name</label>
                                        <input type="hidden" id="am_id_hidden" name="am_id_hidden" value="<?=$receive_purchase_order_details[0]->am_id?>"><br>

<label value="<?=$receive_purchase_order_details[0]->am_id?>"><strong><?=$receive_purchase_order_details[0]->acc_master_name?></strong></label>
                                        <!--<select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Supplier</option>
                                                <?php
                                                /*foreach($buyer_details as $bd){
                                                    $sn = ($bd->short_name == '' ? '-' : $bd->short_name);*/
                                                ?> 
                                                    <option value="<?php//echo $bd->am_id; ?>" <?php //if($receive_purchase_order_details[0]->am_id == $bd->am_id){ ?> selected <?php //} ?>><?php //echo $bd->name . ' ['. $sn .']' ?></option>
                                                    <?php
                                                //}
                                                ?>
                                        </select>-->
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="plating_id_edit" class="control-label">Select Plating</label>
                                        <select name="plating_id_edit" id="plating_id_edit" class="form-control select2">
                                            <option value="">Select Plating</option>
                                                <?php
                                                foreach($plating_details as $pd){
                                                ?> 
                                                    <option <?= ($pd->platting_issue_id == $receive_purchase_order_details[0]->plating_id) ? 'selected' : '' ?> value="<?= $pd->platting_issue_id ?>"><?= $pd->platting_issue_number ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" <?= ($receive_purchase_order_details[0]->status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" <?= ($receive_purchase_order_details[0]->status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Stock In</i></button>
                                    </div>
                                    <!--<div class="col-sm-4">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Total:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($purchase_order); ?> -->
                        <div class="panel-body">
                        <form id="form_edit_delivery_sgst_cgst_value" method="post" action="<?=base_url('admin/form-edit-delivery-sgst-cgst-value-stock')?>" class="cmxform form-horizontal tasi-form">
                        
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="total_amount" class="control-label">Total Value</label>
                                <input id="total_amount" name="total_amount" value="<?= $receive_purchase_order_details[0]->total_amount ?>" type="text" placeholder="Total Value" class="form-control" readonly />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="delivery_charge" class="control-label">Delivery Charge</label>
                                <input id="delivery_charge" name="delivery_charge" value="<?= $receive_purchase_order_details[0]->delivery_charge ?>" type="text" placeholder="Delivery Charge" class="form-control" />
                                </div>
                        	</div>
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="sgst_percent" class="control-label">SGST(in %)</label>
                                <input id="sgst_percent" name="sgst_percent" value="<?= $receive_purchase_order_details[0]->sgst_percent ?>" type="text" placeholder="SGST" class="form-control" />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="cgst_percent" class="control-label">CGST(in %)</label>
                                <input id="cgst_percent" name="cgst_percent" value="<?= $receive_purchase_order_details[0]->cgst_percent ?>" type="text" placeholder="CGST" class="form-control" />
                                </div>
                        	</div>
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="delivery_sgst_cgst_amount" class="control-label">Amount</label>
                                <input id="delivery_sgst_cgst_amount" name="delivery_sgst_cgst_amount" value="<?= $receive_purchase_order_details[0]->delivery_sgst_cgst_amount ?>" type="text" placeholder="Amount" class="form-control" readonly />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="net_amount" class="control-label">Net Amount</label>
                                <input id="net_amount" name="net_amount" value="<?= $receive_purchase_order_details[0]->net_amount ?>" type="text" placeholder="Net Amount" class="form-control" readonly />
                                </div>
                        	</div>
                            
                            <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-2">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update</i></button>
                                    </div>
                                    <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                </div> 
                            
                        </form>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Stock In details for <?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#supp_po_list" data-toggle="tab">List</a></li>
                                <li><a href="#supp_po_add" data-toggle="tab">Add</a></li>
                                <li id="supp_po_details_edit_tab" class="disabled"><a href="#po_details_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="supp_po_list" class="tab-pane fade in active">
                                    <table id="supp_po_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Color</th>
                                                <th>Qnty</th>
                                                <th>Rate</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="supp_po_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-add-stock-in-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                
                                            </div>
                                            <div class="form-group">
                                                
                                                <div class="col-lg-4">
                                                    <label for="id_id" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_add" name="id_id_add" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="color" class="control-label text-danger">Colour *</label>
                                                    <input type="text" id="color_add" name="color_add" required class="form-control" readonly />
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_add"></label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_quantity" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity_add" name="pod_quantity_add" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="pod_quantity_add_hidden" name="pod_quantity_add_hidden" required class="form-control" />
                                                </div>

                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                
                                                <div class="col-lg-3">
                                                    <label for="pod_rate" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate_add" name="pod_rate_add" required class="form-control" />
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="pod_total" class="control-label">Total</label>
                                                    <input type="number" step="0.01" id="pod_total_add" name="pod_total_add" required class="form-control" readonly />
                                                </div>
                                                
                                            <div class="col-lg-3">
                                                    <label for="pod_remarks" class="control-label">Remarks</label>
                                                    <input type="text" id="sup_pod_remarks" name="sup_pod_remarks" class="form-control" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="purchase_order_receive_id" id="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="po_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-edit-stock-in-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                            </div>
                                           <div class="form-group">
                                               
                                               <div class="col-lg-4">
                                                    <label for="id_id_edit" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_edit" name="id_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="color_edit" class="control-label text-danger">Colour *</label>
                                                    <input type="text" id="color_edit" name="color_edit" required class="form-control" readonly />
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit_edit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_edit"></label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_quantity_edit" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity_edit" name="pod_quantity_edit" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="pod_quantity_edit_hidden" name="pod_quantity_edit_hidden" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="remain_item_quantity" name="remain_item_quantity" required class="form-control" />
                                                </div>
                                            </div>
                                           <div class="form-group">
                                               <div class="col-lg-3">
                                                    <label for="pod_rate_edit" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate_edit" name="pod_rate_edit" required class="form-control" />
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="pod_total_edit" class="control-label">Total</label>
                                                    <input type="number" step="0.01" id="pod_total_edit" name="pod_total_edit" required class="form-control" readonly />
                                                    <input type="hidden" step="0.01" id="pod_total_old" name="pod_total_old" required class="form-control" readonly />
                                                </div>
                                            <div class="col-lg-3">
                                                    <label for="sup_pod_remarks_edit" class="control-label">Remarks</label>
                                                    <input type="text" id="sup_pod_remarks_edit" name="sup_pod_remarks_edit" class="form-control" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                    
                                                    <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                            		<input type="hidden" name="purchase_order_receive_detail_id" id="purchase_order_receive_detail_id" class="hidden" value="" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
<!--Data Table-->
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script>
<!--data table init-->
<script src="<?=base_url()?>assets/admin_panel/js/data-table-init.js"></script>
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
    
    $(document).ready(function() {
        $('#supp_po_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-stock-in-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    purchase_order_receive_id: function () {
                        return $("#purchase_order_receive_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "item_name" },
                { "data": "item_color" },
                { "data": "item_qty" },
                { "data": "item_rate" },
                { "data": "total_amount" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,5],
                "orderable": false,
            }]
        } );  
    });

    $("#po_id").change(function(){
        $po_id = $(this).val();
		$am_id_hidden = $('#am_id_hidden').val();
		
		console.log('po_id: '+$po_id);
		if($po_id != '' || $po_id > 0){
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-purchase-order-stock') ?>",
            method: "post",
            dataType: 'json',
            data: {po_id: $po_id, am_id_hidden: $am_id_hidden},
            success: function(result){
                console.log(JSON.stringify(result));
				
				var sup_po_orders = result.sup_po_orders;
				$("#sup_id").html("<option value=''>Select Supp.Purchase order</option>");
                $.each(sup_po_orders, function(index, item) {
                    $str = '<option value=' + item.sup_id +'> '+ item.supp_po_number + '</option>';
                    $("#sup_id").append($str);
                });
                // open the item tray 
                $('#sup_id').select2('open');
				
				var all_items = result.all_items;				
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' pod_quantity=' + item.pod_quantity + ' pod_rate=' + item.pod_rate + ' pod_total='+ item.pod_total + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
               // $('#id_id_add').select2('open');
				
				
				
            },
            error: function(e){console.log(e);}
        });
		}else{
			$("#id_id_add").val('');
			$("#id_id_add").html("<option value=''>Select Item</option>");
			$('#color_add').val('');
			$("#pod_unit_add").html('');
			$('#pod_quantity_add').val('');
			$('#pod_quantity_add_hidden').val('');
			$('#pod_rate_add').val('');
			$('#pod_total_add').val('');
		}
    });
	
	$(document).ready(function() {
	    
            $platting_id = $("#plating_id_edit").val();
            
            $stockin_id = <?= $this->uri->segment(3) ?>;
            
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-supp-purchase-order-stock') ?>",
            method: "post",
            dataType: 'json',
            data: {'platting_id': $platting_id, 'stockin_id': $stockin_id},
            success: function(all_items){
                console.log(JSON.stringify(all_items));
				
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
                // $('#id_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
        
    });
    
    $(document).on('change', '#plating_id_edit', function(){
        $platting_id = $("#plating_id_edit").val();
            
            $stockin_id = <?= $this->uri->segment(3) ?>;
          
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-supp-purchase-order-stock') ?>",
            method: "post",
            dataType: 'json',
            data: {'platting_id': $platting_id, 'stockin_id': $stockin_id},
            success: function(all_items){
                console.log(JSON.stringify(all_items));
				
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
                // $('#id_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
          });

	$(document).on('change', '#id_id_add', function(){
		$id_id_add = $(this).val();
// 		$po_id = $('#po_id').val();

        $issue_date_add = $('#purchase_order_receive_date').val();

		$unit = $('option:selected', this).attr('unit');
		$color = $('option:selected', this).attr('color');
		$am_id_value = $("#am_id_hidden").val();
		$plating_id_edit = $("#plating_id_edit").val();
		
		$.ajax({
            url: "<?= base_url('admin/ajax-get-remaining-item-quantity-stock') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id_add': $id_id_add, 'issue_date_add': $issue_date_add, 'am_id_value': $am_id_value, 'plating_id_edit': $plating_id_edit},
            success: function(response){
                console.log(JSON.stringify(response));
                
                $.each(response, function(index, item) {
                    
                    $received_quantity = parseFloat(item.item_quantity);
                    $received_rate = parseFloat(item.new_purchase_rate);
					$('#color_add').val(item.colour);
					$("#pod_unit_add").html("<b>" +$unit+ '</b>');
					$('#pod_quantity_add').val($received_quantity);
					$('#pod_quantity_add_hidden').val($received_quantity);
					$('#pod_rate_add').val($received_rate);
				    $received_rate_new = parseFloat($received_quantity * $received_rate).toFixed(2);
		            $('#pod_total_add').val($received_rate_new);
					
                });
                
            },
            error: function(e){console.log(e);}
        });
	});
		
    $(document).on('change', '#id_id', function(){
        $id_id = $(this).val();
        $.ajax({
            url: "<?= base_url('admin/all-colors-on-item-master') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_id': $id_id,},
            success: function(all_colors){
                // console.log(all_items);
                $("#color").html("");
                $.each(all_colors, function(index, item) {
                    $str = '<option value=' + item.item_dtl_id + '> '+ item.color + '</option>';
                    $("#color").append($str);
                });
                // open the item tray 
                $('#color').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });

	$("#pod_quantity_add").blur(function(){
        $pod_quantity_add = $('#pod_quantity_add').val();
		$pod_quantity_add_hidden = $('#pod_quantity_add_hidden').val();
		$pod_rate_add = $('#pod_rate_add').val();
			$rate_new = parseFloat($pod_quantity_add * $pod_rate_add).toFixed(2);
			$('#pod_total_add').val($rate_new);
	});
	
	//pod_rate_add
	$("#pod_rate_add").blur(function(){
        $pod_quantity_add = $('#pod_quantity_add').val();
		$pod_rate_add = $('#pod_rate_add').val();
		$rate_new = parseFloat($pod_quantity_add * $pod_rate_add).toFixed(2);
		$('#pod_total_add').val($rate_new);
	});
	
    // ADD - multiply for item_amount
    $("#pod_quantity_edit, #pod_rate_edit").on('change', function () {
		$pod_quantity_edit_hidden = $("#pod_quantity_edit_hidden").val();
		$remain_item_quantity = $("#remain_item_quantity").val();
		$pod_quantity_edit = $("#pod_quantity_edit").val();
        $pod_rate_edit = $("#pod_rate_edit").val();
		$max_limit = parseFloat($pod_quantity_edit_hidden) + parseFloat($remain_item_quantity);
		
        	$("#pod_total_edit").val(($pod_quantity_edit * $pod_rate_edit).toFixed(2));
		
    });
	
	// EDIT - multiply for item_amount
    $("#pod_quantity_edit, #pod_rate_edit").on('change', function () {
        $pod_quantity_edit = $("#pod_quantity_edit").val();
        $pod_rate_edit = $("#pod_rate_edit").val();
        $("#pod_total_edit").html("<b>" +parseFloat($pod_quantity_edit * $pod_rate_edit).toFixed(2)+ "</b>");
    });
	
	  
    $("#form_edit_receive_purchase_order").validate({
        rules: {
            po_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_receive_purchase_order').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_receive_purchase_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_receive_purchase_order_details").validate({
        rules: {
            id_id_add: {
                required: true,
            },
            pod_quantity_add: {
                required: true,
            },
            pod_rate_add: {    
                required: true,
            },
            pod_total_add: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_receive_purchase_order_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_receive_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			
			$line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);
            
            $platting_id = $("#plating_id_edit").val();
        
           if($platting_id != '') {
            
            $stockin_id = <?= $this->uri->segment(3) ?>;
            
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-supp-purchase-order-stock') ?>",
            method: "post",
            dataType: 'json',
            data: {'platting_id': $platting_id, 'stockin_id': $stockin_id},
            success: function(all_items){
                console.log(JSON.stringify(all_items));
				
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
                $('#id_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
            
           }
			
            $("#form_add_receive_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	//Stock In detail edit button
    $("#supp_po_details_table").on('click', '.purchase_order_receive_detail_id', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $purchase_order_receive_detail_id = $(this).attr('purchase_order_receive_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-stock-in-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'purchase_order_receive_detail_id': $purchase_order_receive_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
				
				$oreder_receive_details = result.oreder_receive_details;
				$remain_item_quantity = result.remain_item_quantity;
				
                /*data = pod_data[0];*/
                
                $("#po_id_edit").html("<option>"+$oreder_receive_details.po_number+"</option>").trigger('change');
                $("#sup_id_edit").html("<option>"+$oreder_receive_details.supp_po_number+"</option>").trigger('change');
                $("#id_id_edit").html("<option>"+$oreder_receive_details.item+"</option>").trigger('change');
                $("#pod_unit_edit").html('<b>'+$oreder_receive_details.unit+'</b>');
                $("#color_edit").val($oreder_receive_details.color);
                $("#pod_quantity_edit").val($oreder_receive_details.item_quantity);
				$("#pod_quantity_edit_hidden").val($oreder_receive_details.item_quantity);
				$("#remain_item_quantity").val($remain_item_quantity);
				$("#pod_rate_edit").val($oreder_receive_details.item_rate);
                $("#pod_total_edit").val(Number($oreder_receive_details.pod_total).toFixed(2));
				$("#pod_total_old").val(Number($oreder_receive_details.pod_total).toFixed(2));
                $("#sup_pod_remarks_edit").val($oreder_receive_details.remarks);
                $("#purchase_order_receive_detail_id").val($oreder_receive_details.purchase_order_receive_detail_id);

                $('#supp_po_details_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#po_details_edit"]').tab('show');
                $("#pod_edit_loader").addClass('hidden');
                
            }
        });
    });
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_receive_purchase_order_details").validate({
        rules: {
            pod_quantity_edit: {
                required: true,
            },
            pod_rate_edit: {
                required: true,
            }
        },
        messages: {
            
        }
    });
    $('#form_edit_receive_purchase_order_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_receive_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			$("#form_add_receive_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            $('#form_add_receive_purchase_order_details')[0].reset(); //reset form
			
			$line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	//form_edit_delivery_sgst_cgst_value
	$("#form_edit_delivery_sgst_cgst_value").validate({
        rules: {
            total_amount: {
                required: true,
            },
            delivery_charge: {
                required: true,
            },
            sgst_percent: {    
                required: true,
            },
            cgst_percent: {
                required: true,
            },
            delivery_sgst_cgst_amount: {
                required: true,
            },
            net_amount: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_edit_delivery_sgst_cgst_value').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_delivery_sgst_cgst_value").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            notification(obj);            
        }
    });
	
	//Calculation for CGST SGST
    $("#total_amount, #delivery_charge, #sgst_percent, #cgst_percent, #delivery_sgst_cgst_amount, #net_amount").on('blur', function () {
        $total_amount = $("#total_amount").val();
        $delivery_charge = $("#delivery_charge").val();
		$sgst_percent = $("#sgst_percent").val();
		$cgst_percent = $("#cgst_percent").val();
		
		$sgst_percent_amount = (($total_amount * $sgst_percent)/100);
		$cgst_percent_amount = (($total_amount * $cgst_percent)/100);
		$delivery_sgst_cgst_amount = parseFloat($delivery_charge) + parseFloat($sgst_percent_amount) + parseFloat($cgst_percent_amount);
		$net_amount = parseFloat($delivery_sgst_cgst_amount) + parseFloat($total_amount);
		
		$("#delivery_sgst_cgst_amount").val(($delivery_sgst_cgst_amount).toFixed(2));
        $("#net_amount").val(($net_amount).toFixed(2));
		
		console.log('total_amount: '+$total_amount+' delivery_charge: '+$delivery_charge+' sgst_percent: '+$sgst_percent+' cgst_percent: '+$cgst_percent+' sgst_percent_amount: '+$sgst_percent_amount+' cgst_percent_amount: '+$cgst_percent_amount+' delivery_sgst_cgst_amount: '+$delivery_sgst_cgst_amount+' net_amount: '+$net_amount);
    });
	
	// delete area 
	$(document).on('click', '.delete', function(){
        $this = $(this);
        if(confirm("Are You Sure?")){
			$tab = $(this).attr('tab');
			$tab_pk = $(this).attr('tab-pk');
			$data_pk = $(this).attr('data-pk');
			
			$reference_tab = $(this).attr('reference-tab');
			$reference_pk = $(this).attr('reference-pk');
			$reference_data_pk = $(this).attr('reference-data-pk');
			$pod_total_add = $(this).attr('pod-total-add');

            $.ajax({
                url: "<?= base_url('admin/del-stock-in-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, reference_tab: $reference_tab, reference_pk: $reference_pk, reference_data_pk: $reference_data_pk, pod_total_add: $pod_total_add},
                success: function (returnData) {
                    console.log(JSON.stringify(returnData));
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
					
					$line_items = returnData.line_items;
					$total_amount = parseFloat($line_items.total_amount).toFixed(2);
					$("#total_amount").val($total_amount);
					
					$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
					$("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
					
					$net_amount = parseFloat($line_items.net_amount).toFixed(2);
					$("#net_amount").val($net_amount);
                    //refresh table
                    $("#supp_po_details_table").DataTable().ajax.reload();

                },
                error: function (returnData) {
                    obj = JSON.parse(returnData);
                    notification(obj);
                }
            });
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
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "7000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });    

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    $("#print_all").click(function(){
        $poi = $("#supp_purchase_order_id").val();
        $.confirm({
            title: 'Choose!',
            content: 'Choose printing methods from the below options',
            buttons: {
                printwithcode: {
                    text: 'With code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        window.open("<?= base_url() ?>admin/purchase-order-print-with-code/"+ $poi, "_blank");
                    }
                },
                printwithoutcode: {
                    text: 'Without code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        window.open("<?= base_url() ?>admin/purchase-order-print-without-code/"+ $poi, "_blank");
                    }
                },
                cancel: function () {}
            }
        });
    });
    
</script>
</body>
</html>
