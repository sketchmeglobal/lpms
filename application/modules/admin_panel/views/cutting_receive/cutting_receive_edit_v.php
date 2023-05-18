<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last updated on 08-01-2021 at 10:15am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Cutting Receive | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Edit Cutting Receive">

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
            <h3 class="m-b-less">Edit Cutting Receive</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Cutting Receive </li>
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
                            Edit <?= $cutting_receive_details[0]->cut_rcv_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_cutting_receive" method="post" action="<?=base_url('admin/form-edit-cutting-receive')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="am_id_add" class="control-label text-danger">Select Cutter *</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Cutter</option>
										<?php
                                        foreach($buyer_details as $bd){
                                            $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                        ?> 
                                            <option value="<?= $bd->am_id ?>" <?php if($cutting_receive_details[0]->am_id == $bd->am_id){?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                    
                                	<div class="col-lg-3">
                                    <label for="cut_rcv_number" class="control-label text-danger">Cutting Receive Number *</label>
                                    <input id="cut_rcv_number" name="cut_rcv_number" type="text" placeholder="Cutting Number" class="form-control round-input" value="<?=$cutting_receive_details[0]->cut_rcv_number?>" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="cut_rcv_date" class="control-label text-danger">Cutting Receive Date *</label>
                                        <input id="cut_rcv_date" name="cut_rcv_date" type="date" placeholder="Cutting Date" class="form-control round-input" value="<?=$cutting_receive_details[0]->cut_rcv_date?>" />
                                    </div>
                                    
                                    
                                </div>
                                                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Receive Challan</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="cut_rcv_id" name="cut_rcv_id" class="hidden" value="<?= $cutting_receive_details[0]->cut_rcv_id ?>" />
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
                            <p class='text-center' id="challan_total_amount"><?= $receive_cut_quantity ?></p>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Cutting Receive Challan details for: <?= $cutting_receive_details[0]->cut_rcv_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_issue_challan_add" data-toggle="tab">Add</a></li>
                                <li id="cut_issue_receive_edit_tab" class="disabled"><a href="#cut_issue_receive_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="cutting_receive_challan_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Customer Order Number</th>
                                                <th>Buyer Reference Number</th>
                                                <th>Cutting Challan Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Fitting Color</th>
                                                <th>Cut.Is Quantity</th>
                                                <th>Cut.Rcpt Quantity</th>
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
                                        <form id="form_add_cutting_receive_challan_details" method="post" action="<?=base_url('admin/form-add-cutting-receive-challan-details')?>" class="cmxform form-horizontal tasi-form">
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
                                                <div class="col-lg-3">
                                                    <label for="buyer_reference_no" class="control-label">Buyer reference number</label>
                                                    <input type="text" id="buyer_reference_no" name="buyer_reference_no" class="form-control" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="cut_id" class="control-label text-danger">Cutting Challan Number*</label>
                                                    <select id="cut_id" name="cut_id" class="form-control select2">
                                                        <option value="">Select Cutting Challan Number</option>
														
                                                     </select>
                                                </div>
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="cod_id" class="control-label text-danger">Article Number*</label>
                                                    <select id="cod_id" name="cod_id" class="form-control select2">
                                                        <option value="">Select Article Number</option>
														
                                                     </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="lc_id_text" class="control-label text-danger">Leather Colour</label>
                                                    <input type="text" id="lc_id_text" name="lc_id_text" required class="form-control" readonly />
                                                    <input type="hidden" id="lc_id" name="lc_id" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="fc_id_text" class="control-label text-danger">Fitting Colour</label>
                                                    <input type="text" id="fc_id_text" name="fc_id_text" required class="form-control" readonly />
                                                    <input type="hidden" id="fc_id" name="fc_id" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="cut_co_quantity" class="control-label text-danger">Issue Quantity</label>
                                                    <input type="text" id="cut_co_quantity" name="cut_co_quantity" required class="form-control" readonly />
                                                    <input type="hidden" id="article_master_id" name="article_master_id" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="receive_cut_quantity" class="control-label text-danger">Receive Quantity</label>
                                                    <input type="text" id="receive_cut_quantity" name="receive_cut_quantity" required class="form-control" />
                                                    <input type="hidden" id="receive_cut_quantity_hidden" name="receive_cut_quantity_hidden" required class="form-control" />
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="add_cutting"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="cut_rcv_id" id="cut_rcv_id" class="hidden" value="<?= $cutting_receive_details[0]->cut_rcv_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_receive_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_issue_receive_details" method="post" action="<?=base_url('admin/form-edit-issue-receive-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="co_no_edit" class="control-label text-danger">Customer Order No*</label>
                                                    <input type="text" id="co_no_edit" name="co_no_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="buyer_reference_no_edit" class="control-label">Buyer reference number</label>
                                                    <input type="text" id="buyer_reference_no_edit" name="buyer_reference_no_edit" class="form-control" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="cut_number_edit" class="control-label text-danger">Cutting Challan Number*</label>
                                                    <input type="text" id="cut_number_edit" name="cut_number_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="article_name_edit" class="control-label text-danger">Article Number*</label>
                                                    <input type="text" id="article_name_edit" name="article_name_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="leather_color_edit" class="control-label text-danger">Leather Colour</label>
                                                    <input type="text" id="leather_color_edit" name="leather_color_edit" required class="form-control" readonly />
                                                    
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="fitting_color_edit" class="control-label text-danger">Fitting Colour</label>
                                                    <input type="text" id="fitting_color_edit" name="fitting_color_edit" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="co_quantity_edit" class="control-label text-danger">Issue Quantity</label>
                                                    <input type="text" id="co_quantity_edit" name="co_quantity_edit" required class="form-control" readonly />
                                                    
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="receive_cut_quantity_edit" class="control-label text-danger">Receive Quantity</label>
                                                    <input type="text" id="receive_cut_quantity_edit" name="receive_cut_quantity_edit" required class="form-control" />
                                                    <input type="hidden" id="receive_cut_quantity_edit_hidden" name="receive_cut_quantity_edit_hidden" required class="form-control" />
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="cut_rcv_detail_id" name="cut_rcv_detail_id" class="hidden" value="" />
                                            
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
        $('#cutting_receive_challan_details_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Cutting Received PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Cutting Received Excel',
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
                "url": "<?=base_url('admin/ajax-cutting-receive-challan-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    cut_rcv_id: function () {
                        return $("#cut_rcv_id").val();
                    },
                },
            },
            // "order":[], //in the datatable initialization code. 
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "customer_order_no" },
                { "data": "buyer_reference_number" },
                { "data": "cutting_challan_number" },
				{ "data": "article_number" },
                { "data": "leather_color" },
                { "data": "fitting_color" },
				{ "data": "issue_quantity" },
				{ "data": "receive_quantity" },				
                { "data": "action" },

            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,2,3,4,5,6,7,8],
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
            }],

        } );  
    });
	
	$("#co_id").change(function(){
        $co_id = $(this).val();
		
		$.ajax({
			url: "<?= base_url('admin/get-customer-order-dtl-cutting-receive') ?>",
			method: "post",
			dataType: 'json',
			data: {'co_id': $co_id},
			success: function(result){
				console.log('ength:'+result.length);			
				console.log(JSON.stringify(result));
				$('#buyer_reference_no').val(result.buyer_reference_no);
				
				$cut_ids = result.challans;
				$("#cut_id").html("");
				$("#cut_id").append('<option value="">Select Cutting Challan Number</option>');
                $.each($cut_ids, function(index, item) {
					console.log('cut_id:'+item.cut_id);
                    $str = '<option value=' + item.cut_id + '> '+ item.cut_number + '</option>';
                    $("#cut_id").append($str);
                });
                // open the challan list 
                $('#cut_id').select2('open');
				
			},
			error: function(e){console.log(e);}
		});
		
    });//end function

    $("#cut_id").change(function(){
        $cut_id = $(this).val();
		$co_id = $('#co_id').val();
		
        $.ajax({
            url: "<?= base_url('admin/ajax-get-article-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'cut_id': $cut_id, co_id: $co_id},
            success: function(result){
                //console.log(JSON.stringify(result));
                $("#cod_id").html("");
				$("#cod_id").append('<option value="">Select Article Number</option>');
                $.each(result, function(index, item) {
                    $str = '<option value=' + item.cod_id + '> '+ item.art_no +'['+ item.leather_color +']</option>';
                    $("#cod_id").append($str);
                });
                // open the item tray 
                $('#cod_id').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });
	
	$("#cod_id").change(function(){
        $cod_id = $(this).val();
		$cut_id = $('#cut_id').val();
        $('#add_cutting').prop('disabled', false);
		
        $.ajax({
            url: "<?= base_url('admin/ajax-get-issue-quantity-and-article-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'cod_id': $cod_id, cut_id: $cut_id},
            success: function(result){
                console.log(JSON.stringify(result));
				
				$('#lc_id_text').val(result.article.leather_color);
				$('#fc_id_text').val(result.article.fitting_color);
				$('#lc_id').val(result.article.lc_id);
				$('#fc_id').val(result.article.fc_id);
				$('#article_master_id').val(result.article.article_master_id);
				$('#cut_co_quantity').val(result.article.cut_co_quantity);
				
				$('#receive_cut_quantity').val(result.receive_quantity);
				$('#receive_cut_quantity_hidden').val(result.receive_quantity);
            },
            error: function(e){console.log(e);}
        });
    });
	
	$("#receive_cut_quantity").blur(function(){
        $receive_cut_quantity = $('#receive_cut_quantity').val();
		$receive_cut_quantity_hidden = $('#receive_cut_quantity_hidden').val();
		if(parseInt($receive_cut_quantity) > parseInt($receive_cut_quantity_hidden)){
			alert('Can not greater than recomended value');
			$('#receive_cut_quantity').val($receive_cut_quantity_hidden);
		}
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

    
    $("#form_edit_cutting_receive").validate({
        rules: {
            am_id: {
                required: true
            },
            cut_rcv_number: {
                required: true
            },
            cut_rcv_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_cutting_receive').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_cutting_receive").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_cutting_receive_challan_details").validate({
        rules: {
            co_id: {
                required: true,
            },
			cut_id: {
                required: true,
            },
			cod_id: {
                required: true,
            },
			receive_cut_quantity: {
                required: true,
            }			
        },
        messages: {

        }
    });
    $('#form_add_cutting_receive_challan_details').ajaxForm({
        beforeSubmit: function () {
            $('#add_cutting').prop('disabled', true);
            return $("#form_add_cutting_receive_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
// 			$('#form_add_cutting_receive_challan_details')[0].reset(); 
            // $("#form_add_cutting_receive_challan_details").validate().resetForm(); //reset validation
            $("#lc_id").val('');
            $("#fc_id").val('');
            $("#cut_co_quantity").val('');
            $("#receive_cut_quantity").val('');
            notification(obj);
            $("#cod_id").select2('open');
            //refresh table
            $('#cutting_receive_challan_details_table').DataTable().ajax.reload();
            
        }
    });

	$("#cutting_receive_challan_details_table").on('click', '.cutting_received_challan_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $cut_rcv_detail_id = $(this).attr('cut_rcv_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-cutting-receive-challan-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'cut_rcv_detail_id': $cut_rcv_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
                //data = pod_data[0];
                
                $("#co_no_edit").val(result.co_no);
                $("#buyer_reference_no_edit").val(result.buyer_reference_no);
				$("#cut_number_edit").val(result.cut_number);
				$articaleName = result.art_no +'['+ result.leather_color +']';
				$("#article_name_edit").val($articaleName);
				$("#leather_color_edit").val(result.leather_color);
				$("#fitting_color_edit").val(result.fitting_color);
				$("#co_quantity_edit").val(result.co_quantity);
				$("#receive_cut_quantity_edit").val(result.receive_cut_quantity);
				$("#receive_cut_quantity_edit_hidden").val(result.receive_cut_quantity);
				$("#cut_rcv_detail_id").val(result.cut_rcv_detail_id);

                $('#cut_issue_receive_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#cut_issue_receive_edit"]').tab('show');
                $("#pod_edit_loader").addClass('hidden');
                
            }
        });
    });
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_issue_receive_details").validate({
        rules: {
            pod_quantity: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_issue_receive_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_issue_receive_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);			
            notification(obj);
            //refresh table
            $('#cutting_receive_challan_details_table').DataTable().ajax.reload();
        }
    });

    //article-costing-measurement edit button
    $("#cutting_receive_challan_details_table").on('click', '.purchase_details_edit_btn', function() {
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

            $.ajax({
                url: "<?= base_url('admin/del-cutting-receive-challan-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    
                    //refresh table
                    $("#cutting_receive_challan_details_table").DataTable().ajax.reload();

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
