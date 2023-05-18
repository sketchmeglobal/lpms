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
    <title>Edit Jobber Bill | <?=WEBSITE_NAME;?></title>
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
    <div class="body-content" style="min-height: 1000px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Edit Jobber Bill</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Jobber Bill </li>
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
                            Edit: <?= $jobber_bill_detail[0]->jobber_bill_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_jobber_bill" method="post" action="<?=base_url('admin/form-edit-jobber-bill')?>" class="cmxform form-horizontal tasi-form">
                            <div class="form-group ">
                            	<div class="col-lg-4">
                                    <label for="am_id" class="control-label text-danger">Select Jobber*</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Jobber</option>
                                        <?php foreach($jobber_details as $jobber){?>
                                        <option value="<?=$jobber->am_id?>" <?php if($jobber_bill_detail[0]->am_id == $jobber->am_id){?> selected <?php } ?>><?=$jobber->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                	<label for="jobber_bill_number" class="control-label text-danger">Jobber Bill Number *</label>
                                	<input id="jobber_bill_number" name="jobber_bill_number" value="<?= $jobber_bill_detail[0]->jobber_bill_number ?>" type="text" placeholder="Jobber Bill Number" class="form-control round-input" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="jobber_bill_date" class="control-label text-danger">Jobber Bill Date *</label>
                                    <input id="jobber_bill_date" name="jobber_bill_date" value="<?= date('Y-m-d', strtotime($jobber_bill_detail[0]->jobber_bill_date)) ?>" type="date" placeholder="Jobber Bill Date" class="form-control round-input" />
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Jobber Bill</i></button>
                                    </div>
                                    
                                </div> 
                                <input type="hidden" id="jobber_bill_id" name="jobber_bill_id" class="hidden" value="<?= $jobber_bill_detail[0]->jobber_bill_id ?>" />
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
                        <form id="form_jobber_bill_net_amount" method="post" action="<?=base_url('admin/form-jobber-bill-net_amount')?>" class="cmxform form-horizontal tasi-form">
                            <div class="col-lg-6">
                                <label for="total_quantity" class="control-label">Article Quantity *</label>
                                <input id="article_quantity" name="article_quantity" type="text" placeholder="Article Quantity" class="form-control" value="<?= $jobber_bill_detail[0]->article_quantity ?>" readonly />
                            </div>
                            <div class="col-lg-6">
                                <label for="article_total" class="control-label">Article Total *</label>
                                <input id="article_total" name="article_total" type="text" placeholder="Value" class="form-control" value="<?= $jobber_bill_detail[0]->article_total ?>" readonly/>
                            </div>
                            
                            <div class="col-lg-6">
                                <label for="bill_amount" class="control-label">Bill Amount*</label>
                                <input id="bill_amount" name="bill_amount" type="text" placeholder="Bill Amount" class="form-control" value="<?= $jobber_bill_detail[0]->article_total ?>" readonly/>
                            </div>
                            <div class="col-lg-6">
                                <label for="deduction" class="control-label">Deduction*</label>
                                <input id="deduction" name="deduction" type="text" placeholder="Deduction" class="form-control" value="<?= $jobber_bill_detail[0]->deduction ?>"/>
                            </div>
                            
                            <div class="col-lg-6">
                                <label for="addition" class="control-label">Addition*</label>
                                <input id="addition" name="addition" type="text" placeholder="Addition" class="form-control" value="<?= $jobber_bill_detail[0]->addition ?>" />
                            </div>
                            <div class="col-lg-6">
                                <label for="net_bill" class="control-label">Net Bill Amount*</label>
                                <input id="net_bill" name="net_bill" type="text" placeholder="Net Bill Amount" class="form-control" value="<?= $jobber_bill_detail[0]->net_bill ?>" readonly/>
                            </div>                            
                            <div class="col-lg-6">
                                <div class="col-sm-offset-3 col-sm-3">
                                	<button class="btn btn-success" type="submit"><i class="fa fa-refresh">Update</i></button>
                                </div>
                            </div> 
                            <input type="hidden" id="hidden_jobber_bill_id" name="hidden_jobber_bill_id" class="hidden" value="<?= $jobber_bill_detail[0]->jobber_bill_id ?>" />
                                
                                </form>
                        </div>
                    </section>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Jobber Bill details for: <?= $jobber_bill_detail[0]->jobber_bill_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_issue_challan_add" data-toggle="tab">Add</a></li>
                                <li id="cut_issue_challan_edit" class="disabled"><a href="#po_details_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="office_proforma_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Jobber Receipt Number</th>
                                                <th>Order Number</th>
                                                <th>Jobber Issue Challan Number</th>
                                                <th>Article Id</th>
                                                <th>Leather Color</th>
                                                <th>Fitting Color</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Total</th>
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
                                        <form id="form_add_jobber_bill_details" method="post" action="<?=base_url('admin/form-add-jobber-bill-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                            	<div class="col-lg-4">
                                                    <label for="jobber_challan_receipt_id" class="control-label text-danger">Select Jobber Rcpt.*</label>
                                                    <select id="jobber_challan_receipt_id" name="jobber_challan_receipt_id" class="form-control select2">
                                                        <option value="">Select Jobber Rcpt.</option>
														<?php
                                                        foreach($jobber_challan_receipt as $jcr){
                                                        ?> 
                                                        <option value="<?= $jcr->jobber_challan_receipt_id ?>"><?=$jcr->jobber_receipt_challan_number?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                     </select>
                                                </div>
                                                
                                                <!--<div class="col-lg-4">
                                                    <label for="jobber_bill_remarks" class="control-label">Remarks</label>
                                                    <input id="jobber_bill_remarks" name="jobber_bill_remarks" type="text" placeholder="Remarks" class="form-control" value=""/>
                                                </div>-->
                                            </div>
                                            
                                            <div class="form-group " id="co_dtl_tbl">
                                            
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="add_details_jobber_bill"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="jobber_bill_id" id="jobber_bill_id" class="hidden" value="<?= $jobber_bill_detail[0]->jobber_bill_id ?>" />
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
                                            <input type="hidden" id="jobber_bill_id" name="jobber_bill_id" class="hidden" value="<?= $jobber_bill_detail[0]->jobber_bill_id ?>" />
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
        $('#office_proforma_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-jobber-bill-detail-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    jobber_bill_id: function () {
                        return $("#jobber_bill_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "jobber_receipt_number" },
                { "data": "order_number" },
                { "data": "jobber_issue_challan_number" },
				{ "data": "article_id" },
                { "data": "leather_color" },
				{ "data": "fitting_color" },
                { "data": "quantity" },
				{ "data": "rate" },
				{ "data": "total" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [4,5,9],
                "orderable": false,
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
	$ordersArray = [];
	$prev_co_ids = [];
	 
	$("#jobber_challan_receipt_id").change(function(){
		$jobber_challan_receipt_id = $('#jobber_challan_receipt_id').val();
		$("#add_details_jobber_bill").attr("disabled", false);
		var table = '';
			table += '<table id="co_dtl_tbl_view" class="table">';
				table += '<tr>';
					table += '<th>Jobber Receipt Number</th>';
					table += '<th>Order Number</th>';
					table += '<th>Jobber Issue Challan Number</th>';
					table += '<th>Article Id</th>';
					table += '<th>Leather Color</th>';
					table += '<th>Fitting Color</th>';
					table += '<th>Quantity</th>';
					table += '<th>Extra Quantity</th>';
					table += '<th>Rate</th>';
					table += '<th>Total</th>';
				table += '</tr>';
			table += '</table>';
			
			$.ajax({
				url: "<?= base_url('admin/jobber-bill-get-customer-order-dtl') ?>",
				method: "post",
				dataType: 'json',
				data: {'jobber_challan_receipt_id': $jobber_challan_receipt_id},
				success: function(all_orders){
					if(all_orders.length == 0){
						alert('Order Details not available');	
					}else{
						setTimeout(function(){
							$ordersArray = all_orders;
							$tot_amn = 0;
						console.log('append new row form here'+$ordersArray.length);
						var new_rows = '';
						
						for(var i = 0; i < $ordersArray.length; i++){
							//console.log(' co_no:'+$ordersArray[i].co_no);
							
							$tot_amn = ($tot_amn + $ordersArray[i].total);
							
							new_rows += '<tr>';
								new_rows += '<td>'+$ordersArray[i].jobber_receipt_challan_number+'<input type="hidden" name="jobber_challan_receipt_id[]" id="jobber_challan_receipt_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].jobber_challan_receipt_id+'"></td>';					
								
								new_rows += '<td>'+$ordersArray[i].co_no+'<input type="hidden" name="co_id[]" id="co_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].co_id+'"></td>';
								
								new_rows += '<td>'+$ordersArray[i].jobber_challan_number+'<input type="hidden" name="jobber_issue_id[]" id="jobber_issue_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].jobber_issue_id+'"></td>';
								
								new_rows += '<td>'+$ordersArray[i].art_no+'<input type="hidden" name="am_id[]" id="am_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].am_id+'"></td>';
								
								
								new_rows += '<td>'+$ordersArray[i].leather_color+'<input type="hidden" name="lc_id[]" id="lc_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].lc_id+'"></td></td>';
								
								new_rows += '<td>'+$ordersArray[i].fitting_color+'<input type="hidden" name="fc_id[]" id="fc_id_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].fc_id+'"></td></td>';
								
								new_rows += '<td><input type="text" class="form-control" name="quantity[]" id="quantity_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].jobber_receive_quantity+'" onblur="updateTotalRate('+$ordersArray[i].jobber_challan_receipt_details_id+')" readonly></td>';
								
								new_rows += '<td><input type="text" class="form-control" name="extra_quantity[]" id="extra_quantity_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="" onblur="updateTotalRate('+$ordersArray[i].jobber_challan_receipt_details_id+')"></td>';
								
								new_rows += '<td><input type="text" class="form-control" name="rate[]" id="rate_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].rate+'" onblur="updateTotalRate('+$ordersArray[i].jobber_challan_receipt_details_id+')"></td>';
													
								new_rows += '<td class="totals_amount"><input type="text" class="form-control" name="total[]" id="total_'+$ordersArray[i].jobber_challan_receipt_details_id+'" value="'+$ordersArray[i].total+'" readonly></td>';
							  new_rows += '</tr>';
							  
						}//end for
						
						new_rows += '<tr><td colspan="9">Total</td><td> <span id="cutter_bill_amount_number"></span></td></tr>';
						
						$('#co_dtl_tbl').html(table);
						$('#co_dtl_tbl_view').append(new_rows);
						
						$('#cutter_bill_amount_number').html($tot_amn.toFixed(2));

						//console.log(new_rows);
						}, 2000);
					
					
					}},
					error: function(e){console.log(e);}
				});
    });
	
	function updateTotalRate(id){
		$extra_quantity = 0;
		$rate = $('#rate_'+id).val();
		$quantity = $('#quantity_'+id).val();
		$extra_quantity = $('#extra_quantity_'+id).val();
		if($extra_quantity == ''){
			$extra_quantity = 0;
		}
		if(parseFloat($rate) > 0 && parseFloat($quantity) > 0){
			$('#total_'+id).val(parseFloat($rate) * (parseFloat($quantity) + parseFloat($extra_quantity)));
		}
		
		var sum = 0;
        $(".totals_amount input").each(function(){
            // alert($(this).val());
        sum += parseFloat($(this).val());
    });
    
    $('#cutter_bill_amount_number').html(sum.toFixed(2));

		console.log('id: '+id+' quantity: '+$quantity+' extra_quantity: '+$extra_quantity+' rate: '+$rate);
	}//end function updateTotalRate

    

    
    $("#form_edit_jobber_bill").validate({
        rules: {
            am_id: {
                required: true
            },
            jobber_bill_number: {
                required: true
            },
            jobber_bill_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_jobber_bill').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_jobber_bill").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
			
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_jobber_bill_details").validate({
        rules: {
            jobber_challan_receipt_id: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_jobber_bill_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_jobber_bill_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			
			$("#add_details_jobber_bill").attr("disabled", true);
			$('#article_quantity').val(obj.article_quantity);
			$('#article_total').val(obj.article_total);
			$('#bill_amount').val(obj.article_total);
					
			$bill_amount = $("#bill_amount").val();
			$deduction = $("#deduction").val();
			$addition = $("#addition").val();		
			$total_bill_amount = parseFloat($bill_amount) + parseFloat($addition) - parseFloat($deduction);
			$("#net_bill").val($total_bill_amount.toFixed(2));
			
			$ordersArray = [];
			$prev_co_ids = [];	
			var table = '';
			$('#co_dtl_tbl').html(table);
            $("#form_add_jobber_bill_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            
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

            $('#form_add_jobber_bill_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_jobber_bill_details").validate().resetForm(); //reset validation
            notification(obj);
            $po_total = parseFloat(obj.pod_total).toFixed(2);
            $("#challan_total_amount").text($po_total);
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#office_proforma_details_table").on('click', '.purchase_details_edit_btn', function() {
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
			$tab_val = $(this).attr('tab-val');
			
			$data_tab = $(this).attr('data-tab');
			$data_pk = $(this).attr('data-pk');
			$data_tab_val = $(this).attr('data-tab-val');
			
			$quantity = $(this).attr('quantity');
			$rate = $(this).attr('rate');
			$total = $(this).attr('total');

            $.ajax({
                url: "<?= base_url('admin/del-jobber-bill-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, tab_val: $tab_val, data_tab: $data_tab, data_pk : $data_pk, data_tab_val: $data_tab_val, quantity: $quantity, rate: $rate, total: $total},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    //obj = JSON.parse(returnData);
					
					$('#article_quantity').val(returnData.article_quantity);
					$('#article_total').val(returnData.article_total);
					$('#bill_amount').val(returnData.article_total);
					
					$bill_amount = $("#bill_amount").val();
					$deduction = $("#deduction").val();
					$addition = $("#addition").val();		
					$total_bill_amount = parseFloat($bill_amount) + parseFloat($addition) - parseFloat($deduction);
					$("#net_bill").val($total_bill_amount.toFixed(2));
					
                    notification(returnData);
                    
                    //refresh table
                    $("#office_proforma_details_table").DataTable().ajax.reload();

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
	
	$("#deduction, #addition").on('change', function () {
		$bill_amount = $("#bill_amount").val();
		$deduction = $("#deduction").val();
		$addition = $("#addition").val();		
		$total_bill_amount = parseFloat($bill_amount) + parseFloat($addition) - parseFloat($deduction);
		$("#net_bill").val($total_bill_amount.toFixed(2));
	});
	
	$("#form_jobber_bill_net_amount").validate({
        rules: {
            net_bill: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_jobber_bill_net_amount').ajaxForm({
        beforeSubmit: function () {
            return $("#form_jobber_bill_net_amount").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
			
            //console.log(returnData);
        }
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
