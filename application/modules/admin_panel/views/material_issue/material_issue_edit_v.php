
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Material Issue | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Edit Material Issue</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Material Issue </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $material_issue_data[0]->material_issue_slip_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-edit-material-issue')?>" class="cmxform form-horizontal tasi-form">
                            <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="material_issue_slip_number" class="control-label text-danger">Issue Slip Number*</label>
                                    <input id="material_issue_slip_number" name="material_issue_slip_number" value="<?= $material_issue_data[0]->material_issue_slip_number ?>" type="text" placeholder="Purchase Receive Number" class="form-control round-input" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="material_issue_date" class="control-label text-danger">Issue Date*: </label>
                                    <br/>
                                    <input id="material_issue_date" name="material_issue_date" type="date" placeholder="Issue Date" value="<?= $material_issue_data[0]->material_issue_date ?>" class="form-control round-input" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="material_issue_to_form" class="control-label text-danger">Issue To / From*</label>
                                    <select id="material_issue_to_form" name="material_issue_to_form" class="form-control select2">
                                        <option value="">Issue To / From</option>
                                        <option value="1" <?php if($material_issue_data[0]->material_issue_to_form == '1'){?> selected <?php } ?>>Godown</option>
                                        <option value="2" <?php if($material_issue_data[0]->material_issue_to_form == '2'){?> selected <?php } ?>>Fabricator</option>
                                        <option value="3" <?php if($material_issue_data[0]->material_issue_to_form == '3'){?> selected <?php } ?>>Stock Out</option>
                                        <option value="3" <?php if($material_issue_data[0]->material_issue_to_form == '4'){?> selected <?php } ?>>Stock Return</option>
                                    </select>
                                </div>
                                <div class="col-lg-3" <?php if($material_issue_data[0]->jobber_challan_receipt_id == 0){?> style="display:none" <?php } ?> id="challan_div">
                                    <label for="jobber_challan_receipt_id" class="control-label text-danger">Challan No*</label>
                                    <select id="jobber_challan_receipt_id" name="jobber_challan_receipt_id" class="form-control select2">
                                        <option value="">Challan No</option>
                                        <?php
                                        foreach($jobber_challan_details as $jcd){
                                            foreach($jobber_challan_details1 as $jcd1) {
                                                if($material_issue_data[0]->jobber_challan_receipt_id != $jcd->jobber_issue_id && $jcd->jobber_issue_id == $jcd1->jobber_challan_receipt_id) {
                                                    continue 2;
                                                }
                                            }
                                        ?> 
                                        <option value="<?= $jcd->jobber_issue_id ?>" <?php if($material_issue_data[0]->jobber_challan_receipt_id == $jcd->jobber_issue_id){?> selected <?php } ?>><?= $jcd->jobber_challan_number ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>   
                            </div>
                            <div class="form-group ">                                        
                                <div class="col-lg-3" <?php if($material_issue_data[0]->am_id == 0){?> style="display:none" <?php } ?> id="supplier_div">
                                    <label for="am_id" class="control-label text-danger">Supplier*</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Supplier</option>
                                        <?php
                                        foreach($buyer_details as $bd){
                                            $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                        ?> 
                                            <option value="<?= $bd->am_id ?>" <?php if($material_issue_data[0]->am_id == $bd->am_id){?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                    
                                <div class="col-lg-3">
                                    <label for="terms_condition" class="control-label">Terms and Conditions</label>
                                    <textarea id="terms_condition" name="terms_condition" placeholder="Terms and Conditions" class="form-control round-input"><?= $material_issue_data[0]->terms_condition ?></textarea>
                                </div>
                                    
                                <div class="col-lg-3">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <textarea id="remarks" name="remarks" placeholder="Remarks" class="form-control round-input"><?= $material_issue_data[0]->remarks ?></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="total_value" class="control-label text-danger">Total value*</label>
                                    <input id="total_value" name="total_value" value="<?= $material_issue_data[0]->total_value ?>" type="text" placeholder="Total value" class="form-control round-input" />
                                </div>

                                <div class="col-lg-3">
                                    <label for="virtual_status" class="control-label text-danger">Virtual Status*</label>
                                    <select required class="form-control" name="virtual_status" id="virtual_status">
                                        <option <?= ($material_issue_data[0]->virtual_status == 1) ? 'selected': '' ?> value="1">True</option>
                                        <option <?= ($material_issue_data[0]->virtual_status == 0) ? 'selected' : '' ?> value="0">False</option>
                                    </select>
                                </div> 
                                    
                            </div>                               
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Material Issue</i></button>
                                </div>
                                <!--<div class="col-sm-4">
                                    <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                </div>-->
                            </div> 
                            <input type="hidden" id="material_issue_id_add" name="material_issue_id" class="hidden" value="<?= $material_issue_data[0]->material_issue_id ?>" />
                                
                            </form>
                        </div>
                    </section>
                </div>
                
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Material details for <?= $material_issue_data[0]->material_issue_slip_number ?>
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
                                                <th>   Cust. Ord.   </th>
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
                                        <form id="form_add_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-add-material-issue-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="id_id" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_add" name="id_id_add" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                        <?php foreach($item_details as $id) { ?>
                                        <option value="<?= $id->id_id ?>" data-c_id = "<?= $id->c_id ?>" data-remain_quantity_for_material_issue = "<?= $id->remain_quantity_for_material_issue ?>" data-pur_id = "<?= $id->purchase_order_receive_detail_id ?>" data-im_code = "<?= $id->im_code ?>" data-im_id = "<?= $id->im_id ?>" data-unit = "<?= $id->unit ?>" data-color = "<?= $id->color ?>" data-mat_issue = "<?= $id->material_issue_status ?>"><?= $id->item ?>[<?= $id->color ?>]</option>

                                                       <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="im_id" name="im_id" required class="form-control" />
                                                    <input type="hidden" id="id_id_hidden" name="id_id_hidden" required class="form-control" />
                                                    <input id="material_issue_date1" name="material_issue_date1" type="hidden" value="<?= $material_issue_data[0]->material_issue_date ?>" class="form-control round-input" />
                                                    <input id="mat_is_id" name="mat_is_id" type="hidden" value="<?= $this->uri->segment(3) ?>" class="form-control round-input" />
                                                </div>                                                

                                                <div class="col-lg-2">
                                                    <label for="color" class="control-label text-danger">Colour *</label>
                                                    <input type="text" id="color_add" name="color_add" required class="form-control" readonly />
                                                    <input type="hidden" id="c_id" name="c_id" required class="form-control" />
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_add"></label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="issue_quantity_preview" class="control-label text-danger">Actual Quantity *</label>
                                                    <input type="number" step="0.01" id="issue_quantity_preview" name="issue_quantity_preview" required class="form-control" readonly=""/>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="issue_quantity_preview" class="control-label text-danger">Enter Quantity *</label>
                                                    <input type="number" step="0.01" id="issue_quantity_enter" name="issue_quantity_enter" required class="form-control"/>
                                                </div>
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-4">
                                                    <label for="co_id" class="control-label">Customer Order No*</label>
                                                    <select id="co_id" name="co_id" class="form-control select2">
                                                        <option value="">Select Customer Order</option>
														<?php
														if(isset($customer_order)) {
                                                        foreach($customer_order as $co){
                                                        ?> 
                                                        <option value="<?= $co->co_id ?>"><?=$co->co_no?></option>
                                                        <?php
                                                        }
														}
                                                        ?>
                                                     </select>
                                                </div>
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-2">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="button" id="preview_btn"><i class="fa fa-search"></i> Preview</button>
                                                </div>                                                
                                            </div>
                                            
                                            
                                            
                                            <div class="form-group" id="preview_table">
                                            

                                            </div>
                                            
                                            
                                            <input type="hidden" name="material_issue_id" id="material_issue_id" class="hidden" value="<?= $material_issue_data[0]->material_issue_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="po_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-edit-material-issue-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="item_name_edit" class="control-label">Item Name </label>
                                                    <input type="text" id="item_name_edit" name="item_name_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="c_id_edit" class="control-label">Colour </label>
                                                    <input type="text" id="c_id_edit" name="c_id_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="issue_quantity_edit" class="control-label text-danger">Qnty* </label>
                                                    <input type="text" id="issue_quantity_edit" name="issue_quantity_edit" required class="form-control" />
                                                    <input type="hidden" id="issue_quantity_hidden_edit" name="issue_quantity_hidden_edit" required readonly />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="issue_rate_edit" class="control-label text-danger">Rate* </label>
                                                    <input type="text" id="issue_rate_edit" name="issue_rate_edit" required class="form-control" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="total_amount_edit" class="control-label text-danger">Total* </label>
                                                    <input type="text" id="total_amount_edit" name="total_amount_edit" required class="form-control" readonly />
                                                    <input type="hidden" id="total_amount_hidden_edit" name="total_amount_hidden_edit" required readonly />
                                                </div>
                                            </div>
                                           
                                           <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label for="co_id_edit" class="control-label">Customer Order No*</label>
                                                    <select id="co_id_edit" name="co_id_edit" class="form-control select2">
                                                        <option value="">Select Customer Order</option>
														<?php
														if(isset($customer_order)) {
                                                        foreach($customer_order as $co){
                                                        ?> 
                                                        <option value="<?= $co->co_id ?>"><?=$co->co_no?></option>
                                                        <?php
                                                        }
														}
                                                        ?>
                                                     </select>
                                                </div>
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                    
                                                    <input type="hidden" id="material_issue_id_edit" name="material_issue_id" class="hidden" value="<?= $material_issue_data[0]->material_issue_id ?>" />
                                            		<input type="hidden" name="material_issue_detail_id" id="material_issue_detail_id_edit" class="hidden" value="" />
                                                    <input type="hidden" name="purchase_order_receive_detail_id_edit" id="purchase_order_receive_detail_id_edit" class="hidden" value="" />
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
                "url": "<?=base_url('admin/ajax-material-issue-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    material_issue_id_add: function () {
                        return $("#material_issue_id_add").val();
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
                { "data": "customer_orders" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6],
                "orderable": false,
            }]
        } );  
    });
	
	$("#material_issue_to_form").change(function(){
        $material_issue_to_form = $(this).val();
		$('#challan_div').hide();
		$('#supplier_div').hide();
			
		console.log('material_issue_to_form: '+$material_issue_to_form);
		if(parseInt($material_issue_to_form) == 2){
			$('#challan_div').show();
		}else if(parseInt($material_issue_to_form) == 3 || parseInt($material_issue_to_form) == 4){
			$('#supplier_div').show();
		}
	});
	

    /*$("#po_id").change(function(){
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
    });*/
	
    // WRONG LOGIC - SHOULD COME FROM CONTROLLER
	function myFunction() {
        $issue_date_add = $('#material_issue_date').val();
		console.log('issue_date_add: '+$issue_date_add);
		
		$.ajax({
            url: "<?= base_url('admin/all-items-on-purchase-order-receive-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'issue_date_add': $issue_date_add},
            success: function(result){
                // console.log(JSON.stringify(result));
                // $("#id_id_add").select2("val", "");
				// var all_items = result;
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(result, function(index, item) {
                    $str = '<option value=' + item.purchase_order_receive_detail_id + ' c_id=' + item.c_id + ' remain_quantity_for_material_issue=' + item.remain_quantity_for_material_issue + ' id_id='+ item.id_id + ' im_code=' + item.im_code + ' im_id=' + item.im_id + ' unit=' + item.unit + ' color=' + item.color + ' mat_issue=' + item.material_issue_status + ' >  '+ item.item + ' [' + item.id_id + ']</option>';
                    $("#id_id_add").append($str);
                                });
                // open the item tray 
                $('#id_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
    }
	
	
	
	$(document).on('change', '#id_id_add', function(){
		// $id_id_add = $(this).find(":selected").prop('id_id');
        $id_id_add = $(this).val();
        // alert($id_id_add);
        $purc_rcv_detail_id = $(this).val();
        $mat_issue = $('option:selected', this).data('mat_issue');
        $issue_date_add = $('#material_issue_date').val();
		
		if(parseInt($id_id_add) > 0){
			$im_id = $('option:selected', this).data('im_id');
			$id_id = $('option:selected', this).data('id_id');
			$color = $('option:selected', this).data('color');
			$c_id = $('option:selected', this).data('c_id');
			$unit = $('option:selected', this).data('unit');
            $purc_rcv_detail_id = $('option:selected', this).data('pur_id');
			
			$('#im_id').val($im_id);
			$('#id_id_hidden').val($id_id);
			$('#color_add').val($color);
			$('#c_id').val($c_id);
			$("#pod_unit_add").html("<b>" +$unit+ '</b>');


        $.ajax({
            url: "<?= base_url('admin/fetch-remainng-stock-for-material-issue') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_dtl_id': $id_id_add, 'issue_date_add': $issue_date_add, 'purc_rcv_id' : $purc_rcv_detail_id},
            success: function(result){
                $('#issue_quantity_preview').val(result);
                $('#issue_quantity_enter').attr('max', result);
            },
            error: function(e){console.log(e);}
        });
     
     // } else {
     //    alert('material issued');
     // }
		}else{
			$('#im_id').val('');
			$('#id_id_hidden').val($id_id_add);
			$('#color_add').val('');
			$('#c_id').val('');
			$("#pod_unit_add").html('');
		}
		//pod_unit_add
		/**/
	});
	
	//preview_btn
	$(document).on('click', '#preview_btn', function(){
        $issue_quantity_prev = $('#issue_quantity_preview').val();
		$issue_quantity_preview = $('#issue_quantity_enter').val();
        // alert($issue_quantity_prev);
        // alert($issue_quantity_preview);

        if(parseInt($issue_quantity_prev) >= parseInt($issue_quantity_preview)) {
		$im_id = $('#im_id').val();
		$id_id = $('option:selected', "#id_id_add").val();
        $issue_date_add = $('#material_issue_date').val();
        $purc_rcv_id = $('option:selected', '#id_id_add').attr('data-pur_id');
			
		console.log('issue_quantity_preview: '+ $issue_quantity_preview);
		$.ajax({
            url: "<?= base_url('admin/ajax-get-consume-list-purchase-order-receive-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id': $id_id, 'im_id': $im_id, 'issue_quantity_preview': $issue_quantity_preview, 'issue_date_add': $issue_date_add, 'purc_rcv_id': $purc_rcv_id},
            success: function(response){
				$table = '';
				console.log(JSON.stringify(response.preview_data));
				$preview_data = response.preview_data;
				
				if(response.status == true){
				  $table += '<table class="table">';
				  $table += '<thead>';
					$table += '<tr>';
					  $table += '<th scope="col">Item Name</th>';
					  $table += '<th scope="col">Colour</th>';
					  $table += '<th scope="col">Qnty</th>';
					  $table += '<th scope="col">Rate</th>';
					  $table += '<th scope="col">Total</th>';
					$table += '</tr>';
				  $table += '</thead>';
				  $table += '<tbody>';

                  var sum_q = 0;
                  var sum_r = 0;
                  var sum_t = 0;
				  
				  for($i = 0; $i < $preview_data.length; $i++){

                    sum_q += parseFloat($preview_data[$i].consumed);
                    sum_r += parseFloat($preview_data[$i].item_rate);
                    sum_t += parseFloat($preview_data[$i].total_rate);

					$table += '<tr>';
					  $table += '<th scope="row">'+$preview_data[$i].item_name+'</th>';
					  $table += '<td>'+$preview_data[$i].color+'<input type="hidden" name="c_id[]" id="c_id_'+$preview_data[$i].purchase_order_receive_detail_id+'" value="'+$preview_data[$i].c_id+'"></td>';
					  $table += '<td><input type="text" id="issue_quantity_'+$preview_data[$i].purchase_order_receive_detail_id+'" name="issue_quantity[]" required class="form-control class_q" value="'+$preview_data[$i].consumed+'" readonly /></td>';
					  $table += '<td><input type="text" id="issue_rate_'+$preview_data[$i].purchase_order_receive_detail_id+'" name="issue_rate[]" required class="form-control class_r" value="'+$preview_data[$i].item_rate+'"/></td>';
					  $table += '<td><input type="text" id="total_amount_'+$preview_data[$i].purchase_order_receive_detail_id+'" name="total_amount[]" required class="form-control class_t" value="'+$preview_data[$i].total_rate+'" readonly /> <input type="hidden" name="id_id[]" id="id_id_'+$preview_data[$i].purchase_order_receive_detail_id+'" value="'+$preview_data[$i].id_id+'"> <input type="hidden" name="im_id[]" id="im_id_'+$preview_data[$i].purchase_order_receive_detail_id+'" value="'+$preview_data[$i].im_id+'"> <input type="hidden" name="purchase_order_receive_detail_id[]" id="purchase_order_receive_detail_id_'+$preview_data[$i].purchase_order_receive_detail_id+'" value="'+$preview_data[$i].purchase_order_receive_detail_id+'"></td>';
					$table += '</tr>';
				  }//end for
				$table += '</tbody>';
                $table += '<tfoot><tr><th colspan="2">Total</th><th id="tot_qn" style="text-align: right;">'+sum_q.toFixed(2)+'</th><th id="tot_ra" style="text-align: right;">'+sum_r.toFixed(2)+'</th><th id="tot_to" style="text-align: right;">'+sum_t.toFixed(2)+'</th></tr></tfoot>';
				$table += '</table>';
				$table += '<div class="form-group">';
					$table += '<div class="col-lg-4 col-lg-offset-4">';
						$table += '<label for="" class="control-label">&nbsp;</label><br>';
						$table += '<button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>';
					$table += '</div>';
				$table += '</div>';
				
				}else{
					$table = 'Sorry! No preview data available';
				}
				$('#preview_table').html($table);
				
				},
            error: function(e){console.log(e);}
        });
        // alert($pur_order_rcv_detail);
		} else {
            alert('Enter a value less  than total quantity'+ $issue_quantity_prev);
        }
	});//end function

    $(document).on('blur', '.class_r', function () {
        $class_r = parseFloat($(this).val());
        $class_q = parseFloat($(this).closest('tr').find(".class_q").val());
        
        $(this).closest('tr').find(".class_t").val(($class_r * $class_q).toFixed(2));

        var sum_q = 0;
        var sum_r = 0;
        var sum_t = 0;
        $(".class_t").each(function(){
            // alert($(this).val());
        sum_q += parseFloat($(this).closest('tr').find(".class_q").val());
        sum_r += parseFloat($(this).closest('tr').find(".class_r").val());
        sum_t += (parseFloat($class_r) * parseFloat($class_q));
      });
      $("#tot_qn").text((sum_q).toFixed(2));
      $("#tot_ra").text((sum_r).toFixed(2));
      $("#tot_to").text((sum_t).toFixed(2));  
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
		if(parseInt($pod_quantity_add) == 0){
			alert('Quantity can not zero');
		}else if(parseFloat($pod_quantity_add) > parseFloat($pod_quantity_add_hidden)){
			alert('Can not greater than recomended value');
			$('#pod_quantity_add').val($pod_quantity_add_hidden);
			$rate_new = parseFloat($pod_quantity_add_hidden * $pod_rate_add).toFixed(2);
			$('#pod_total_add').val($rate_new);
		}else{
			$rate_new = parseFloat($pod_quantity_add * $pod_rate_add).toFixed(2);
			$('#pod_total_add').val($rate_new);
		}
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
		console.log('max_limit: '+$max_limit);

		if($pod_quantity_edit > $max_limit){
			alert('Quantity Maximum: '+$max_limit);
		}else{
        	$("#pod_total_edit").val(($pod_quantity_edit * $pod_rate_edit).toFixed(2));
		}
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
            },
            material_issue_date: {
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
            issue_date_add: {
                required: true,
            },
			issue_quantity_enter: {
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
			$('#preview_table').html('');
			$line_items = obj.line_items;
            $('#total_value').val(obj.tot_amount);
            /*$total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);*/
            $("#form_add_receive_purchase_order_details").validate().resetForm(); //reset validation
            $("#co_id").select2("val", "");
            notification(obj);
            
            $("#id_id_add").select2('open');
            
            $("#id_id_add").focus();
            
			// myFunction();
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	//Stock In detail edit button
    $("#supp_po_details_table").on('click', '.material_issue_detail_id', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $material_issue_detail_id = $(this).attr('material_issue_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-material-issue-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'material_issue_detail_id': $material_issue_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
				$edit_data = result[0];
				
				
				
				
				
				$("#item_name_edit").val($edit_data.item);
				$("#c_id_edit").val($edit_data.color);
				$("#co_id_edit").val($edit_data.co_id).trigger('change.select2');
				$("#issue_quantity_edit").val($edit_data.issue_quantity);
				$("#issue_quantity_hidden_edit").val($edit_data.issue_quantity);
				$("#issue_rate_edit").val($edit_data.issue_rate);
				$("#total_amount_edit").val($edit_data.total_amount);
				$("#total_amount_hidden_edit").val($edit_data.total_amount);
				$("#material_issue_detail_id_edit").val($edit_data.material_issue_detail_id);
				$("#purchase_order_receive_detail_id_edit").val($edit_data.purchase_order_receive_detail_id);

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
            issue_quantity_edit: {
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
			
			/*$line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);*/
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	
	//Calculation for CGST SGST
    $("#issue_quantity_edit").on('blur', function () {
        $issue_quantity_edit = $("#issue_quantity_edit").val();
		$issue_quantity_hidden_edit = $("#issue_quantity_hidden_edit").val();
        $issue_rate_edit = $("#issue_rate_edit").val();
		
		//total_amount_edit
		if(parseFloat($issue_quantity_edit) > parseFloat($issue_quantity_hidden_edit)){
			alert('Maximum issue quantity limit: '+$issue_quantity_hidden_edit);
			$("#issue_quantity_edit").val($issue_quantity_hidden_edit);
		}else{
			$total_amount_edit = parseFloat($issue_quantity_edit) * parseFloat($issue_rate_edit);
		}
		
		$("#total_amount_edit").val(($total_amount_edit).toFixed(2));
		
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
			$issue_quantity = $(this).attr('issue_quantity');
            $total_amount = $(this).attr('total_amount');
			$purchase_order_receive_detail_id = $(this).attr('purchase_order_receive_detail_id');

            $.ajax({
                url: "<?= base_url('admin/del-material-issue-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, reference_tab: $reference_tab, reference_pk: $reference_pk, reference_data_pk: $reference_data_pk, issue_quantity: $issue_quantity, total_amount: $total_amount, purchase_order_receive_detail_id: $purchase_order_receive_detail_id},
                success: function (returnData) {
                    console.log(JSON.stringify(returnData));
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
					
					/*$line_items = returnData.line_items;
					$total_amount = parseFloat($line_items.total_amount).toFixed(2);
					$("#total_amount").val($total_amount);
					
					$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
					$("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
					
					$net_amount = parseFloat($line_items.net_amount).toFixed(2);
					$("#net_amount").val($net_amount);*/
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
