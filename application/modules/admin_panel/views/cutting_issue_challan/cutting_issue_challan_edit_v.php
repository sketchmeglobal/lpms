<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last updated on 08-01-2021 at 10:00 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Cutting Issue Challan | <?=WEBSITE_NAME;?></title>
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
        .nowrap{white-space: nowrap;}

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff} 
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
            <h3 class="m-b-less">Edit Cutting Issue Challan</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Cutting Issue Challan </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-10">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $cutting_issue_challan_details[0]->cut_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_cutting_issue_challan" method="post" action="<?=base_url('admin/form-edit-cutting-issue-challan')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="am_id_add" class="control-label text-danger">Select Cutter *</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Cutter</option>
										<?php
                                        foreach($buyer_details as $bd){
                                            $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                        ?> 
                                            <option value="<?= $bd->am_id ?>" <?php if($cutting_issue_challan_details[0]->am_id == $bd->am_id){?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                    
                                	<div class="col-lg-3">
                                    <label for="cut_number" class="control-label text-danger">Cutting Number *</label>
                                    <input id="cut_number" name="cut_number" type="text" placeholder="Cutting Number" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_number?>" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="cut_date" class="control-label text-danger">Cutting Date *</label>
                                        <input id="cut_date" name="cut_date" type="date" placeholder="Cutting Date" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_date?>" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="cut_exp_del_dt" class="control-label text-danger">Expected Delivery Date *</label>
                                        <input id="cut_exp_del_dt" name="cut_exp_del_dt" type="date" placeholder="Expected Delivery Date" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_exp_del_dt?>" />
                                    </div>
                                </div>
                                                               
                            <div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="cut_leather" class="control-label">Cutter Leather</label>
                                    <input id="cut_leather" name="cut_leather" type="text" placeholder="Cutter Leather" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_leather?>" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                    <label for="cut_lining" class="control-label">Cutter Lining</label>
                                    <input id="cut_lining" name="cut_lining" type="text" placeholder="Cutter Lining" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_lining?>" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                    <label for="cut_fittings" class="control-label">Cutter Fittings</label>
                                    <input id="cut_fittings" name="cut_fittings" type="text" placeholder="Cutter Fittings" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_fittings?>" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                    <label for="cut_emboss" class="control-label">Cutter Emboss</label>
                                    <input id="cut_emboss" name="cut_emboss" type="text" placeholder="Cutter Emboss" class="form-control round-input" value="<?=$cutting_issue_challan_details[0]->cut_emboss?>" />
                                    </div>
                                    
                                	<div class="col-lg-3">
                                        <label for="cut_remarks" class="control-label">Remarks</label>
                                        <textarea id="cut_remarks" name="cut_remarks" placeholder="Remarks" class="form-control round-input"><?=$cutting_issue_challan_details[0]->cut_remarks?></textarea>
                                    </div> 
                                    
                                    <div class="col-lg-3">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" <?php if($cutting_issue_challan_details[0]->status == 1){?> checked<?php } ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" <?php if($cutting_issue_challan_details[0]->status == 0){?> checked<?php } ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Cutting Issue Challan</i></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?= base_url('admin/print-cutting-issue-challan/'.$cutting_issue_challan_details[0]->cut_id) ?>" target="_blank" ><button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></a>
                                    </div>
                                </div> 
                                <input type="hidden" id="cut_id" name="cut_id" class="hidden" value="<?= $cutting_issue_challan_details[0]->cut_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-2 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Total:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($purchase_order); ?> -->
                        <div class="panel-body">
                            <p class='text-center' id="challan_total_amount"><?= $cutting_issue_challan_details[0]->cut_total_amount ?></p>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Cutting Issue Challan details for: <?= $cutting_issue_challan_details[0]->cut_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_issue_challan_add" data-toggle="tab">Add</a></li>
                                <!--<li id="cut_issue_challan_edit" class="disabled"><a href="#po_details_edit" data-toggle="">Edit</a></li>-->
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="cutting_issue_challan_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>#Order Number</th>
                                                <th>Order Date</th>
                                                <th>Article#</th>
                                                <th>Leather Color</th>
                                                <th>Fitting Color</th>
                                                <th>Quantity</th>
                                                <th>Cut. Quantity</th>
                                                <th>Part</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="cut_issue_challan_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_cutting_issue_challan_details" method="post" action="<?=base_url('admin/form-add-cutting-issue-challan-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-6">
                                                    <label for="co_id" class="control-label text-danger">Customer Order No*</label>
                                                    <select id="co_id" name="co_id" class="form-control select2">
                                                        <option value="">Select Customer Order</option>
														<?php
														if(isset($customer_order)) {
                                                        foreach($customer_order as $co){
                                                        ?> 
                                                        <option value="<?= $co['co_id'] ?>"><?=$co['co_no']?></option>
                                                        <?php
                                                        }
														}
                                                        ?>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group " id="co_dtl_tbl">
                                            
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="cut_id" id="cut_id" class="hidden" value="<?= $cutting_issue_challan_details[0]->cut_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_challan_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_cutting_issue_challan_details" method="post" action="<?=base_url('admin/form-edit-supp-purchase-order-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="ig_id_edit" class="control-label text-danger">Item Group*</label>
                                                    <select id="ig_id_edit" name="ig_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Item Group</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="id_id_edit" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_edit" name="id_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="color_edit" class="control-label text-danger">Colour *</label>
                                                    <select id="color_edit" name="color_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Colour</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit_edit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_edit"></label>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="pod_quantity_edit" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity_edit" name="pod_quantity_edit" required class="form-control" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_rate_edit" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate_edit" name="pod_rate_edit" required class="form-control" />
                                                </div>

                                                <div class="col-lg-1 border-black-bottom">
                                                    <label for="pod_total_edit" class="control-label">Total</label><br />
                                                    <label id="pod_total_edit"></label>
                                                </div>

                                                <div class="col-lg-5">
                                                    <label for="pod_remarks_edit" class="control-label">Remarks</label>
                                                    <input type="text" id="pod_remarks_edit" name="pod_remarks_edit" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="cut_id" name="cut_id" class="hidden" value="<?= $cutting_issue_challan_details[0]->cut_id ?>" />
                                            <input type="hidden" name="supp_dtl_id" id="supp_dtl_id" class="hidden" value="" />
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
        <?php //$this->load->view('components/footer'); ?>
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
        $('#cutting_issue_challan_details_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Cutting Issued PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Cutting Issued Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }    
               }
            ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-cutting-issue-challan-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    cut_id: function () {
                        return $("#cut_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "co_no" },
                { "data": "co_date" },
                { "data": "art_no" },
                { "data": "leather_color" },
                { "data": "fitting_color" },
				{ "data": "co_quantity" },
				{ "data": "cut_co_quantity" },
				{ "data": "co_part" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,3,4,5,6,7,8],
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
            }]
        } );  
    });

// all items-on-item-group -> from Transaction controller 

    $("#ig_id").change(function(){
        $ig_id = $(this).val();
        $.ajax({
            url: "<?= base_url('admin/all-items-on-item-group') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_group': $ig_id,},
            success: function(all_items){
                // console.log(all_items);
                $("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id").html("");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' item_group_val=' + item.value + ' unit=' + item.unit + '> '+ item.item_name + '</option>';
                    $("#id_id").append($str);
                });
                // open the item tray 
                $('#id_id').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });
	
	//get customer order details
	/*$ordersArray = [];
	$prev_co_ids = [];*/
	 
	$("#co_id").change(function(){
		$co_id = $(this).val();
		
		var table = '';
		table += '<table id="co_dtl_tbl_view" class="table">';
			table += '<tr>';
				table += '<th>#Order Number</th>';
				table += '<th>Order Date</th>';
				table += '<th>Article#</th>';
				table += '<th>Leather Color</th>';
				table += '<th>Fitting Color</th>';
				table += '<th>Quantity</th>';
				table += '<th>Cut. Quantity (Rem.)</th>';
				table += '<th>Part</th>';
			table += '</tr>';
		table += '</table>';
		$.ajax({
			url: "<?= base_url('admin/get-customer-order-dtl') ?>",
			method: "post",
			dataType: 'json',
			data: {'co_id': $co_id},
			success: function(all_orders){
				$ordersArray = [];
				console.log('Length:'+all_orders.length);
				
				if(all_orders.length == 0){
					alert('Order Details not available');	
				}else{
					$ordersArray = all_orders;
					
					console.log('append new row form here'+$ordersArray.length);
					var new_rows = '';
					var iter = 0;
					for(var i = 0; i < $ordersArray.length; i++){
						console.log(' co_no:'+$ordersArray[i].co_no);
						if($ordersArray[i].remaining_cut_co_quantity != 0){
							iter++;
							new_rows += '<tr>';
								new_rows += '<td>'+$ordersArray[i].co_no+'</td>';
								new_rows += '<td>'+$ordersArray[i].co_date+'</td>';
								new_rows += '<td>'+$ordersArray[i].art_no+'<input type="hidden" name="am_id[]" id="am_id_'+$ordersArray[i].am_id+'" value="'+$ordersArray[i].am_id+'"></td>';
								new_rows += '<td>'+$ordersArray[i].leather_color+'<input type="hidden" name="lc_id[]" id="lc_id_'+$ordersArray[i].lc_id+'" value="'+$ordersArray[i].lc_id+'"></td></td>';
								new_rows += '<td>'+$ordersArray[i].fitting_color+'<input type="hidden" name="fc_id[]" id="fc_id_'+$ordersArray[i].fc_id+'" value="'+$ordersArray[i].fc_id+'"></td></td>';
								new_rows += '<td>'+$ordersArray[i].co_quantity+'</td>';
								new_rows += '<td><input type="number" min="0" max="'+$ordersArray[i].remaining_cut_co_quantity+'" class="form-control" name="cut_co_quantity[]" id="cut_co_quantity_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].remaining_cut_co_quantity+'"></td>';
								new_rows += '<td><input type="text" class="form-control" name="co_part[]" id="co_part_'+$ordersArray[i].cod_id+'" value=""><input type="hidden" name="cod_id[]" id="cod_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].cod_id+'"></td>';
							new_rows += '</tr>';
						} // end if
					}//end for
					
					if(iter == 0){
						new_rows += '<tr><td colspan="8" align="center">No remaining quantity found</td></tr>';
					}
					
					$('#co_dtl_tbl').html(table);
					
					$('#co_dtl_tbl_view').append(new_rows);
				}//end if
				console.log($ordersArray);
			},
			error: function(e){console.log(e);}
		});
		//append new row form here
		
			
			//console.log(new_rows);
		
				
		/*console.log('------------');
		console.log('prev co ids: '+$prev_co_ids);
		$prev_co_ids_length = $prev_co_ids.length;
		console.log('prev co id length: '+$prev_co_ids_length);
		console.log('------------');*/
		
        /*$co_id = $(this).val();
		if(!$co_id){
			console.log('Not available');
			$ordersArray = [];
			$prev_co_ids = [];	
			var table = '';
			$('#co_dtl_tbl').html(table);
		}else{
			console.log('co_id:'+$co_id);
			$co_id_length = $co_id.length;
			console.log('co_id length: '+$co_id_length);
			$current_co_id = $co_id[$co_id_length-1];
			console.log('Last co id: '+$current_co_id);
			
			if($co_id_length < $prev_co_ids_length){
				//filter & repush the array
				$temp_ordersArray = [];
				for(var i = 0; i < $co_id_length; i++){
					console.log('loop co id: '+$co_id[i]);
					for(var j = 0; j < $ordersArray.length; j++){
						console.log('next loop co id: '+$ordersArray[j].co_id);
						if($ordersArray[j].co_id == $co_id[i]){
							$temp_ordersArray.push($ordersArray[j]);
						}//end if
					}//end for j
				}//end for i
				console.log('temp orders Array: '+JSON.stringify($temp_ordersArray));
				$ordersArray = [];
				$ordersArray = $temp_ordersArray;
			}else{
				
			}
			$prev_co_ids = $co_id;			
		}*///end if
		
        
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


    // ADD - multiply for item_amount
    $("#pod_quantity, #pod_rate").on('change', function () {
        $pod_quantity = $("#pod_quantity").val();
        $pod_rate = $("#pod_rate").val();
        $("#pod_total").val(($pod_quantity * $pod_rate).toFixed(2));
    });
// EDIT - multiply for item_amount
    $("#pod_quantity_edit, #pod_rate_edit").on('change', function () {
        $pod_quantity_edit = $("#pod_quantity_edit").val();
        $pod_rate_edit = $("#pod_rate_edit").val();
        $("#pod_total_edit").html("<b>" +($pod_quantity_edit * $pod_rate_edit).toFixed(2)+ "</b>");
    });

    
    $("#form_edit_cutting_issue_challan").validate({
        rules: {
            am_id: {
                required: true
            },
            cut_number: {
                required: true
            },
            cut_date: {
                required: true
            },
            cut_exp_del_dt: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_cutting_issue_challan').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_cutting_issue_challan").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_cutting_issue_challan_details").validate({
        rules: {
            co_id: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_cutting_issue_challan_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_cutting_issue_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            $('#co_dtl_tbl').html("");
            $("#co_id").select2('destroy');
            $("#co_id").select2();
            // $("#co_id").select2('val', '');
            //$challan_total_amount = parseFloat(obj.pod_total).toFixed(2);
            //$("#pod_total").html("");
			$("#challan_total_amount").text(obj.cut_total_amount_new);
            $("#form_add_cutting_issue_challan_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#cutting_issue_challan_details_table').DataTable().ajax.reload();
            
        }
    });

	//saveData
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_cutting_issue_challan_details").validate({
        rules: {
            pod_quantity: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_cutting_issue_challan_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_cutting_issue_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            $challan_total_amount = parseFloat(obj.total_amount).toFixed(2);
            $purchase_order_total_quantity = parseFloat(obj.total_qnty).toFixed(2);
            $("#challan_total_amount").text($challan_total_amount);
            $("#purchase_order_total_quantity").text($purchase_order_total_quantity);

            $('#form_add_cutting_issue_challan_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_cutting_issue_challan_details").validate().resetForm(); //reset validation
            notification(obj);
            $po_total = parseFloat(obj.pod_total).toFixed(2);
            $("#challan_total_amount").text($po_total);
            //refresh table
            $('#cutting_issue_challan_details_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#cutting_issue_challan_details_table").on('click', '.purchase_details_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $supp_dtl_id = $(this).attr('supp_dtl_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-supp-purchase-order-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'supp_dtl_id': $supp_dtl_id,},
            success: function(pod_data){
                console.log(pod_data);
                data = pod_data[0];
                
                $("#ig_id_edit").html("<option>"+data.group_name+"</option>").trigger('change');
                $("#id_id_edit").html("<option>"+data.item+"</option>").trigger('change');
                $("#color_edit").html("<option>"+data.color+"</option>").trigger('change');
                $("#pod_unit_edit").html('<b>'+data.unit+'</b>');
                $("#pod_quantity_edit").val(data.item_qty);
                $("#pod_rate_edit").val(data.item_rate);
                $("#pod_total_edit").html('<b>'+(Number(data.total_amount)).toFixed(2)+'</b>');
                $("#pod_remarks_edit").val(data.sup_pod_remarks);
                $("#supp_dtl_id").val(data.supp_dtl_id);

                $('#supp_po_details_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#po_details_edit"]').tab('show');
                $("#pod_edit_loader").addClass('hidden');
                
            }
        });
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

// delete area 
    
    $(document).on('click', '.delete', function(){
        $this = $(this);
        if(confirm("Are You Sure?")){
			$tab = $(this).attr('tab');
			$tab_pk = $(this).attr('tab-pk');
			$data_pk = $(this).attr('data-pk');
			$quantity = $(this).attr('quantity');
            $ref_pk = $(this).attr('ref-pk');

            $.ajax({
                url: "<?= base_url('admin/del-cutting-issue-challan-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, quantity: $quantity, ref_pk: $ref_pk},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    
                    $("#challan_total_amount").html(returnData.new_quantity);
                    
                    //refresh table
                    $("#cutting_issue_challan_details_table").DataTable().ajax.reload();

                },
                error: function (returnData) {
                    obj = JSON.parse(returnData);
                    notification(obj);
                }
            });
        }
        
    });
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });    

</script>

</body>
</html>
