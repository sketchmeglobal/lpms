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
    <title>Edit Office Proforma | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Edit Office Proforma</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Office Proforma </li>
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
                            Edit: <?= $office_proforma_detail[0]->proforma_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_office_proform" method="post" action="<?=base_url('admin/form-edit-office-proforma')?>" class="cmxform form-horizontal tasi-form">
                            <div class="form-group ">
                                <div class="col-lg-3">
                                	<label for="proforma_number" class="control-label text-danger">Proforma Number *</label>
                                	<input id="proforma_number" name="proforma_number" type="text" placeholder="Proforma Number" class="form-control round-input" value="<?= $office_proforma_detail[0]->proforma_number ?>" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="proforma_date" class="control-label text-danger">Date *</label>
                                    <input id="proforma_date" name="proforma_date" type="date" placeholder="Date" class="form-control round-input" value="<?php echo date('Y-m-d', strtotime($office_proforma_detail[0]->proforma_date)); ?>" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="rate_type" class="control-label text-danger">Rate Type *</label>
                                    <select id="rate_type" name="rate_type" class="form-control select2">
                                        <option value="">Rate Type</option>
                                        <option value="1" <?php if($office_proforma_detail[0]->rate_type == 1){?> selected <?php } ?>>Office Ex. Works</option>
                                        <option value="2" <?php if($office_proforma_detail[0]->rate_type == 2){?> selected <?php } ?>>Office C&F </option>
                                        <option value="3" <?php if($office_proforma_detail[0]->rate_type == 3){?> selected <?php } ?>>Office FOB</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="terms_condition" class="control-label">Terms & Condition</label>
                                    <input id="terms_condition" name="terms_condition" type="text" placeholder="Terms & Condition" class="form-control round-input" value="<?= $office_proforma_detail[0]->terms_condition ?>" />
                                </div>	
                                <div class="col-lg-3">
                                    <label for="notify" class="control-label">Notify</label>
                                    <input id="notify" name="notify" type="text" placeholder="Notify" class="form-control round-input" value="<?= $office_proforma_detail[0]->notify ?>" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="desc_of_goods" class="control-label">Description of Goods</label>
                                    <input id="desc_of_goods" name="desc_of_goods" type="text" placeholder="Description of Goods" class="form-control round-input" value="<?= $office_proforma_detail[0]->desc_of_goods ?>" />
                                </div>
                                </div>
                            <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Office Proforma</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="office_proforma_id" name="office_proforma_id" class="hidden" value="<?= $office_proforma_detail[0]->office_proforma_id ?>" />
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
                            <div class="col-lg-12">
                                <label for="total_quantity" class="control-label">Quantity *</label>
                                <input id="total_quantity" name="total_quantity" type="text" placeholder="Quantity" class="form-control" value="<?= $office_proforma_detail[0]->total_quantity ?>" readonly />
                            </div>
                            <div class="col-lg-12">
                                <label for="total_value" class="control-label">Value *</label>
                                <input id="total_value" name="total_value" type="text" placeholder="Value" class="form-control" value="<?= $office_proforma_detail[0]->total_value ?>" readonly/>
                            </div>
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Cutting Issue Challan details for: <?= $office_proforma_detail[0]->proforma_number ?>
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
                                                <th>Customer Order</th>
                                                <th>Article Number</th>
                                                <th>Article Description</th>
                                                <th>Leather Color</th>
                                                <th>Fitting Color</th>
                                                <th>Quantity</th>
                                                <th>Rate (INR)</th>
                                                <th>Rate (FOR)</th>
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
                                        <form id="form_add_office_proforma_details" method="post" action="<?=base_url('admin/form-add-office-proforma-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="co_id" class="control-label text-danger">Customer Order No*</label>
                                                    <select id="co_id" name="co_id" class="form-control select2">
                                                        <option value="">Select Customer Order</option>
														<?php
                                                        foreach($customer_order as $co){
                                                        ?> 
                                                        <option value="<?= $co->co_id ?>"><?=$co->co_no?></option>
                                                        <?php
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
                                            <input type="text" name="office_proforma_id" id="office_proforma_id" class="hidden" value="<?= $office_proforma_detail[0]->office_proforma_id ?>" />
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
        $('#office_proforma_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-office-proforma-detail-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    office_proforma_id: function () {
                        return $("#office_proforma_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "customer_order" },
                { "data": "article_number" },
                { "data": "article_description" },
                { "data": "leather_color" },
				{ "data": "fitting_color" },
                { "data": "co_quantity" },
				{ "data": "rate_inr" },
				{ "data": "rate_foreign" },
				{ "data": "total_rate" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3,4,9],
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
	 
	$("#co_id").change(function(){
		$co_id = $('#co_id').val();
		
		if(!$co_id){
			console.log('Not available');			
			var table = '';
			$('#co_dtl_tbl').html(table);
		}else{
			
				$rate_type = $('#rate_type').val();
				
				$.ajax({
					url: "<?= base_url('admin/office-proforma-get-customer-order-dtl') ?>",
					method: "post",
					dataType: 'json',
					data: {'co_id': $co_id, 'rate_type': $rate_type},
					success: function(all_orders){
						$ordersArray = all_orders;
						console.log('ength:'+all_orders.length);
						
						if(all_orders.length == 0){
							alert('Order Details not available');	
						}else{
							var table = '';
							table += '<table id="co_dtl_tbl_view" class="table">';
								table += '<tr>';
									table += '<th>Order Number</th>';
									table += '<th>Article Number</th>';
									table += '<th>Article Description</th>';
									table += '<th>Leather Color</th>';
									table += '<th>Fitting Color</th>';
									table += '<th>Quantity</th>';
									table += '<th>Rate(INR)</th>';
									table += '<th>Rate(FOR)</th>';
									table += '<th>Total</th>';
								table += '</tr>';
							table += '</table>';
							setTimeout(function(){
							console.log('append new row form here'+$ordersArray.length);
							var new_rows = '';			
							$office_proforma_id = $('#office_proforma_id').val();
							
							for(var i = 0; i < $ordersArray.length; i++){
								//console.log(' co_no:'+$ordersArray[i].co_no);
								new_rows += '<tr>';
									new_rows += '<td>'+$ordersArray[i].co_no+'<input type="hidden" name="office_proforma_id[]" id="office_proforma_id_'+$ordersArray[i].cod_id+'" value="'+$office_proforma_id+'"><input type="hidden" name="co_id[]" id="co_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].co_id+'"><input type="hidden" name="cod_id[]" id="cod_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].cod_id+'"></td>';					
									new_rows += '<td>'+$ordersArray[i].art_no+'<input type="hidden" name="am_id[]" id="am_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].am_id+'"></td>';
									new_rows += '<td>'+$ordersArray[i].info+'</td>';
									new_rows += '<td>'+$ordersArray[i].leather_color+'<input type="hidden" name="lc_id[]" id="lc_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].lc_id+'"></td></td>';
									new_rows += '<td>'+$ordersArray[i].fitting_color+'<input type="hidden" name="fc_id[]" id="fc_id_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].fc_id+'"></td></td>';
									new_rows += '<td><input type="text" class="form-control" name="co_quantity[]" id="co_quantity_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].remaining_co_quantity+'" onblur="updateTotalRate('+$ordersArray[i].cod_id+')"></td>';
									new_rows += '<td><input type="text" class="form-control" name="rate_inr[]" id="rate_inr_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].rate_inr+'" readonly></td>';
									new_rows += '<td><input type="text" class="form-control" name="rate_foreign[]" id="rate_foreign_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].rate_foreign+'" onblur="updateTotalRate('+$ordersArray[i].cod_id+')"></td>';					
									new_rows += '<td><input type="text" class="form-control" name="total_rate[]" id="total_rate_'+$ordersArray[i].cod_id+'" value="'+$ordersArray[i].total_rate+'"></td>';
								  new_rows += '</tr>';
							}//end for
							$('#co_dtl_tbl').html(table);
							$('#co_dtl_tbl_view').append(new_rows);
							//console.log(new_rows);
							}, 2000);
						}//end if
						console.log($ordersArray);
					},
					error: function(e){console.log(e);}
				});
			
		}//end if
    });
	
	function updateTotalRate(cod_id){
		$rate_foreign = $('#rate_foreign_'+cod_id).val();
		$co_quantity = $('#co_quantity_'+cod_id).val();
		
		if(parseFloat($rate_foreign) > 0 && parseFloat($co_quantity) > 0){
			$('#total_rate_'+cod_id).val(parseFloat($rate_foreign) * parseFloat($co_quantity));
		}
		console.log('cod_id: '+cod_id+' co_quantity: '+$co_quantity+' rate_foreign: '+$rate_foreign);
	}//end function updateTotalRate

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

    
    $("#form_edit_office_proform").validate({
        rules: {
            proforma_number: {
                required: true
            },
            proforma_date: {
                required: true
            },
            rate_type: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_office_proform').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_office_proform").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
			
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_office_proforma_details").validate({
        rules: {
            co_id: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_office_proforma_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_office_proforma_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			
			$('#total_quantity').val(obj.total_quantity);
			$('#total_value').val(obj.total_value);
			
			$ordersArray = [];
			$prev_co_ids = [];	
			var table = '';
			$('#co_dtl_tbl').html(table);
            $("#form_add_office_proforma_details").validate().resetForm(); //reset validation
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

            $('#form_add_office_proforma_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_office_proforma_details").validate().resetForm(); //reset validation
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
			
			$co_quantity = $(this).attr('co_quantity');
			$total_rate = $(this).attr('total_rate');
			$co_id = $(this).attr('co_id');
			
            $.ajax({
                url: "<?= base_url('admin/del-office-proforma-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, tab_val: $tab_val, data_tab: $data_tab, data_pk : $data_pk, data_tab_val: $data_tab_val, co_quantity: $co_quantity, total_rate: $total_rate, co_id: $co_id},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    //obj = JSON.parse(returnData);
					
					$('#total_quantity').val(returnData.total_quantity_new);
					$('#total_value').val(returnData.total_value_new);
					
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
