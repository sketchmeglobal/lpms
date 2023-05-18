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
    <title>Platting Issue Edit | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Platting Issue Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Platting Issue Edit </li>
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
                            Edit <?= $platting_issue_data[0]->platting_issue_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-edit-platting-issue')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="col-lg-3">
                                    <label for="platting_issue_number" class="control-label text-danger">Platting Issue Number*</label>
                                    <input id="platting_issue_number" name="platting_issue_number" type="text" placeholder="Platting Issue Number" class="form-control round-input" value="<?= $platting_issue_data[0]->platting_issue_number ?>" />
                                    </div>
                                    
                                <div class="col-lg-3">
                                        <label for="platting_issue_date" class="control-label text-danger">Date *</label>
                                        <input id="platting_issue_date" name="platting_issue_date" type="date" placeholder="Date" class="form-control round-input" value="<?= date('Y-m-d', strtotime($platting_issue_data[0]->platting_issue_date)) ?>" />
                                    </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Platting Issue</i></button>
                                    </div>
                                    
                                </div> 
                                <input type="hidden" id="platting_issue_id" name="platting_issue_id" class="hidden" value="<?= $platting_issue_data[0]->platting_issue_id ?>" />
                                
                            </form>
                        </div>
                    </section>
                </div>
                
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Platting Issue Details for <?= $platting_issue_data[0]->platting_issue_number ?>
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
                                                <th>Item Group</th>
                                                <th>Item Name</th>
                                                <th>Item Colour</th>
                                                <th>New Item Colour</th>
                                                <th>Quantity</th>
                                                <th>Plating Rate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="supp_po_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_platting_issue_details" method="post" action="<?=base_url('admin/form-add-platting-issue-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                            <div class="col-lg-3">
                                                <label for="ig_id_add" class="control-label text-danger">Item Group *</label>
                                                <select id="ig_id_add" name="ig_id_add" class="form-control select2">
                                                <option value="">Item Group</option>
                                                <?php
                                                    foreach($item_group_details as $igd){
												?>
												<option value="<?=$igd->ig_id?>"><?=$igd->group_name?>[<?=$igd->ig_code?>]</option>
												<?php		
												}
                                                 ?>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="im_id_add" class="control-label text-danger">Item Name *</label>
                                                <select id="im_id_add" name="im_id_add" class="form-control select2">
                                                    <option value="">Item Name</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="item_colour_add" class="control-label text-danger">Item Colour *</label>
                                                <select id="item_colour_add" name="item_colour_add" class="form-control select2">
                                                    <option value="">Item Colour</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="new_item_colour_add" class="control-label text-danger">New Item Colour *</label>
                                                <select id="new_item_colour_add" name="new_item_colour_add" class="form-control select2">
                                                    <option value="">New Item Colour</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="issue_quantity_add" class="control-label text-danger">Issue Quantity *</label>
                                                <input type="text" id="issue_quantity_add" name="issue_quantity_add" class="form-control" />
                                            </div>
                                            
                                             <div class="col-lg-3">

                                                    <label for="rate_add" class="control-label text-danger">Rate *</label>

                                                    <input type="number" step="0.01" id="rate_add" name="rate_add" class="form-control" />

                                                </div>



                                                <div class="col-lg-1 border-black-bottom">

                                                    <label for="total_add" class="control-label">Total</label><br />

                                                    <label id="total_add"></label>

                                                </div>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <input type="hidden" id="platting_issue_id_add" name="platting_issue_id" class="hidden" value="<?= $platting_issue_data[0]->platting_issue_id ?>" />
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="po_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-edit-platting-issue-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                            <div class="col-lg-3">
                                                <label for="ig_id_edit" class="control-label text-danger">Item Group *</label>
                                                <select id="ig_id_edit" name="ig_id_edit" class="form-control select2">
                                                <option value="">Select Item Group</option>                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="im_id_edit" class="control-label text-danger">Item Name *</label>
                                                <select id="im_id_edit" name="im_id_edit" class="form-control select2">
                                                    <option value="">Select Item Name</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="item_colour_edit" class="control-label text-danger">Item Colour *</label>
                                                <select id="item_colour_edit" name="item_colour_edit" class="form-control select2">
                                                    <option value="">Select Item Colour</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="new_item_colour_edit" class="control-label text-danger">New Item Colour *</label>
                                                <select id="new_item_colour_edit" name="new_item_colour_edit" class="form-control select2">
                                                    <option value="">New Item Colour</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <label for="issue_quantity_edit" class="control-label text-danger">Issue Quantity *</label>
                                                <input type="text" id="issue_quantity_edit" name="issue_quantity_edit" class="form-control" />
                                            </div>
                                            
                                            <div class="col-lg-3">

                                                    <label for="rate_add_edit" class="control-label text-danger">Rate *</label>

                                                    <input type="number" step="0.01" id="rate_add_edit" name="rate_add_edit" class="form-control" />

                                                </div>
                                                
                                                <div class="col-lg-1 border-black-bottom">

                                                    <label for="total_add_edit" class="control-label">Total</label><br />

                                                    <label id="total_add_edit"></label>

                                                </div>
                                            
                                            </div>
                                            
                                            
                                           <div class="form-group">
                                            
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                    
                                                    <input type="hidden" id="platting_issue_id_edit" name="platting_issue_id" class="hidden" value="<?= $platting_issue_data[0]->platting_issue_id ?>" />
                                            		<input type="hidden" name="platting_issue_detail_id" id="platting_issue_detail_id" class="hidden" value="" />
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
        $('#supp_po_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-platting-issue-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    platting_issue_id: function () {
                        return $("#platting_issue_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "item_group" },
                { "data": "item_name" },
                { "data": "item_colour" },
                { "data": "new_item_colour" },
                { "data": "quantity" },
                { "data": "plating_rate" },
                { "data": "action" }
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6],
                "orderable": false,
            }]
        } );  
    });
	
	//Fetch Item Name
	$("#ig_id_add").change(function(){
        $ig_id_add = $(this).val();

		$.ajax({
            url: "<?= base_url('admin/all-items-on-item-master-platting-issue') ?>",
            method: "post",
            dataType: 'json',
            data: {'ig_id': $ig_id_add,},
            success: function(result){
                //console.log(JSON.stringify(result));
				var all_items = result.item_details;
                $("#im_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.im_id + ' >  '+ item.item + ' [' + item.im_code + ']</option>';
                    $("#im_id_add").append($str);
                });
                // open the item tray 
                $('#im_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });
	
	//Fetch Item Colour combination
	$("#im_id_add").change(function(){
        $im_id_add = $(this).val();
         $("#item_colour_add").html('');
		$("#new_item_colour_add").html('');
		$.ajax({
            url: "<?= base_url('admin/all-item-colour-platting-issue') ?>",
            method: "post",
            dataType: 'json',
            data: {'im_id': $im_id_add,},
            success: function(result){
                //console.log(JSON.stringify(result));
				var all_items = result.item_colours;
                $("#item_colour_add").html("<option value=''>Select Colour</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.c_id + ' id_id='+item.id_id+'>  '+ item.color + ' [' + item.c_code + ']</option>';
                    $("#item_colour_add").append($str);
					$("#new_item_colour_add").append($str);
                });
                // open the item tray 
                $('#item_colour_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });
	
	$("#item_colour_add").change(function(){
		$('#new_item_colour_add').select2('open');
	});
	
	$("#item_colour_add").change(function(){
        $new_item_colour_add = $(this).attr('id_id');
        $platting_id  = <?= $this->uri->segment(3) ?>;
		$item_colour_add = $('#new_item_colour_add').attr('id_id');
		$itm_id = $('option:selected', this).attr('id_id');
		$platting_issue_date =$('#platting_issue_date').val();
		$.ajax({
            url: "<?= base_url('admin/platting-issue-rate-on-new-item') ?>",
            method: "post",
            dataType: 'json',
            data: {'new_item_colour_add': $new_item_colour_add, 'itm_id': $itm_id, 'platting_issue_date': $platting_issue_date, 'platting_id': $platting_id},
            success: function(result){
                //console.log(JSON.stringify(result));
                $.each(result, function(index, item) {
                    
                    
                    $received_quantity = parseFloat(item.item_quantity);
                    $received_rate = parseFloat(item.new_purchase_rate);
					$("#rate_add").val($received_rate);
					$("#issue_quantity_add").val($received_quantity);
				    $received_rate_new = parseFloat($received_quantity * $received_rate).toFixed(2);
		            $('#total_add').html($received_rate_new);
                    
		            
					
                });
            },
            error: function(e){console.log(e);}
        });
	});
	
	$("#new_item_colour_add").change(function(){
        $new_item_colour_add = $(this).val();
        $platting_id  = <?= $this->uri->segment(3) ?>;
		$item_colour_add = $('#item_colour_add').val();
		$itm_id = $('option:selected', "#item_colour_add").attr('id_id');
		if(parseInt($new_item_colour_add) == parseInt($item_colour_add)){
			alert('Old color & New color must be different');
		} else {
		    $.ajax({
            url: "<?= base_url('admin/platting-issue-rate-on-new-item-another') ?>",
            method: "post",
            dataType: 'json',
            data: {'new_item_colour_add': $new_item_colour_add, 'itm_id': $itm_id, 'platting_id': $platting_id},
            success: function(result){
                //console.log(JSON.stringify(result));
                $.each(result, function(index, item) {
                    
                    if(item.item_quantity == 'NA') {
                    alert('Item Already Existed');
                    $("#rate_add").val('');
					$("#issue_quantity_add").val('');
		            $('#total_add').html('');  
                    } 
		            
					
                });
            },
            error: function(e){console.log(e);}
        });
		}
	});
	
	  
    $("#form_edit_receive_purchase_order").validate({
        rules: {
            platting_issue_number: {
                required: true
            },
			platting_issue_date: {
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
    $("#form_add_platting_issue_details").validate({
        rules: {
            ig_id_add: {
                required: true,
            },
			im_id_add: {
                required: true,
            },
			item_colour_add: {
                required: true,
            },
			new_item_colour_add: {
                required: true,
            },
			issue_quantity_add: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_platting_issue_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_platting_issue_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			$('#preview_table').html('');
			$line_items = obj.line_items;
			
			$('#form_add_platting_issue_details')[0].reset(); //reset form
            $("#form_add_platting_issue_details").validate().resetForm(); //reset validation
			$("#form_add_platting_issue_details select").select2("val", ""); //reset all select2 fields
			
            notification(obj);
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	//Stock In detail edit button
    $("#supp_po_details_table").on('click', '.platting_issue_detail_id', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $platting_issue_detail_id = $(this).attr('platting_issue_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-platting-issue-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'platting_issue_detail_id': $platting_issue_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
				$edit_data = result[0];
				
				$("#ig_id_edit").html("<option>"+$edit_data.group_name+"</option>").trigger('change');
				$("#im_id_edit").html("<option>"+$edit_data.item+"</option>").trigger('change');
				$("#item_colour_edit").html("<option>"+$edit_data.item_old_colour+"</option>").trigger('change');
				$("#new_item_colour_edit").html("<option>"+$edit_data.item_new_colour+"</option>").trigger('change');
				
				$("#issue_quantity_edit").val($edit_data.issue_quantity);
				$("#rate_add_edit").val($edit_data.plating_rate);
				$("#platting_issue_detail_id").val($edit_data.platting_issue_detail_id);

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
			//$("#form_edit_receive_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
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
			//$issue_quantity = $(this).attr('issue_quantity');
			//$purchase_order_receive_detail_id = $(this).attr('purchase_order_receive_detail_id');

            $.ajax({
                url: "<?= base_url('admin/del-platting-issue-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, reference_tab: $reference_tab, reference_pk: $reference_pk, reference_data_pk: $reference_data_pk},
                success: function (returnData) {
                    console.log(JSON.stringify(returnData));
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
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
    
    $("#issue_quantity_add, #rate_add").on('blur', function(){

        $pod_quantity = $("#issue_quantity_add").val();

        $pod_rate = $("#rate_add").val();

        $("#total_add").html("<b>" +($pod_quantity * $pod_rate).toFixed(2) + "</b>");

    });
    
    $("#issue_quantity_edit, #rate_add_edit").on('blur', function () {

        $pod_quantity_edit = $("#issue_quantity_edit").val();

        $pod_rate_edit = $("#rate_add_edit").val();

        $("#total_add_edit").html("<b>" +($pod_quantity_edit * $pod_rate_edit).toFixed(2)+ "</b>");

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
