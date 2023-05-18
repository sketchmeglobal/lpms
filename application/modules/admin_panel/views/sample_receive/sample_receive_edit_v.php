<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last updated on 08-Feb-2021 at 11:30 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sample Challan Receipt Edit | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Sample Challan Receipt Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Sample Challan Receipt Edit</li>
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
                            Edit <?= $sample_receipt_details[0]->sample_receipt_challan_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_sample_receive_edit" method="post" action="<?=base_url('admin/form-sample-receive-edit')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="am_id_add" class="control-label text-danger">Select Jobber *</label>
                                    <input id="am_id_hidden" name="am_id_hidden" type="hidden" value="<?= $sample_receipt_details[0]->am_id ?>" />
                                   <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Jobber</option>
                                            <?php
                                            foreach($account_master_details as $amd){
                                                $sn = ($amd->short_name == '' ? '-' : $amd->short_name);
                                            ?> 
                                                <option value="<?= $amd->am_id ?>" short_name="<?=$amd->short_name?>" am_code="<?=$amd->am_code?>" <?php if($sample_receipt_details[0]->am_id == $amd->am_id){?> selected <?php } ?>><?= $amd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                    
                                	<div class="col-lg-3">
                                    <label for="sample_receipt_challan_number" class="control-label text-danger">Sample Challan Number *</label>
                                    <input id="sample_receipt_challan_number" name="sample_receipt_challan_number" type="text" placeholder="Sample Receipt Challan Number" class="form-control round-input" value="<?= $sample_receipt_details[0]->sample_receipt_challan_number ?>" readonly />
                                    <input id="sample_challan_number_hidden" name="sample_challan_number_hidden" type="hidden" value="<?= $sample_receipt_details[0]->sample_receipt_challan_number ?>" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="sample_receipt_challan_date" class="control-label text-danger">Issue Date *</label>
                                        <input id="sample_receipt_challan_date" name="sample_receipt_challan_date" type="date" placeholder="Receipt Date" class="form-control round-input" value="<?= date('Y-m-d', strtotime($sample_receipt_details[0]->sample_receipt_challan_date)) ?>" />
                                    </div>
                                </div>
                                                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Receipt Challan </i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="sample_receipt_id" name="sample_receipt_id" class="hidden" value="<?= $sample_receipt_details[0]->sample_challan_receipt_id ?>" />
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
                        
                        <div class="panel-body">
                            <p class='text-center' id="challan_total_amount"><?= $sample_receipt_details[0]->total_sample_quantity_receipt ?></p>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Sample Receive Challan details for: <?= $sample_receipt_details[0]->sample_receipt_challan_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="jobber_issue_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li id="jobber_issue_add"><a href="#jobber_issue_challan_add" data-toggle="tab">Add</a></li>
                                <li id="cut_issue_receive_edit_tab" class="disabled"><a href="#cut_issue_receive_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="sample_receipt_challan_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Sample Is. Chl. No.</th>
                                                <th>Art No</th>
                                                <th>Lth Clr</th>
                                                <th>Fit Clr</th>
                                                <th>Isu Qnty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="jobber_issue_challan_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_sample_receive_challan_details" method="post" action="<?=base_url('admin/form-add-sample-receive-challan-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">

                                                <div class="col-lg-4">
                                                    <label for="challan_no_add" class="control-label text-danger">Sample Challan Number*</label>
                                                    <select id="challan_no_add" name="challan_no_add" class="form-control select2">
                                                        
                                                     </select>
                                                     <input type="hidden" id="sample_receipt_id" name="sample_receipt_id" class="hidden" value="<?= $sample_receipt_details[0]->sample_challan_receipt_id ?>" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="am_id_add" class="control-label text-danger">Article Number*</label>
                                                    <select id="am_id_add" name="am_id_add" class="form-control select2">
                                                        
                                                     </select>
                                                     <input type="hidden" id="am_id_hidden_for_add" name="am_id_hidden_for_add" class="form-control"/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="lc_id_add" class="control-label">Leather Colour</label>
                                                     <input type="text" id="lc_id_add" name="lc_id_add" class="form-control" readonly/>
                                                     <input type="hidden" id="lc_id_add_hidden" name="lc_id_add_hidden" class="form-control"/>
                                                </div>
                                              </div>
                                              <div class="form-group ">
                                              <div class="col-lg-4">
                                                    <label for="fc_id_add" class="control-label">Fitting Colour</label>
                                                    <input type="text" id="fc_id_add" name="fc_id_add" class="form-control" readonly/>
                                                     <input type="hidden" id="fc_id_add_hidden" name="fc_id_add_hidden" class="form-control"/>
                                                </div>  
                                                <div class="col-lg-4">
                                                    <label for="challan_quantity_add" class="control-label">Challan Issue Quantity</label>
                                                    <input type="text" id="challan_quantity_issue_add" name="challan_quantity_issue_add" class="form-control" />
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="challan_quantity_add" class="control-label">Receipt Quantity</label>
                                                    <input type="text" id="challan_quantity_receipt_add" name="challan_quantity_receipt_add" class="form-control" />
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_receive_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                    <form id="form_edit_sample_receipt_challan_details" method="post" action="<?=base_url('admin/form-edit-sample-receipt-challan-details')?>" class="cmxform form-horizontal tasi-form">
                                        <div class="form-group ">
                                              
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="challan_no_edit" class="control-label text-danger">Sample Challan Number*</label>
                                                    <select id="challan_no_edit" name="challan_no_edit" class="form-control select2">
                                                        
                                                     </select>
                                                </div>
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="am_id_edit" class="control-label text-danger">Article Number*</label>
                                                    <select id="am_id_edit" name="am_id_edit" class="form-control select2">
                                                        
                                                     </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="lc_id_edit" class="control-label">Leather Colour</label>
                                                    <input type="text" id="lc_id_edit" name="lc_id_edit" class="form-control" readonly/>
                                                     <input type="hidden" id="lc_id_edit_hidden" name="lc_id_edit_hidden" class="form-control"/>
                                                </div>
                                              <div class="form-group ">
                                              <div class="col-lg-4">
                                                    <label for="fc_id_edit" class="control-label">Fitting Colour</label>
                                                    <input type="text" id="fc_id_edit" name="fc_id_edit" class="form-control" readonly/>
                                                     <input type="hidden" id="fc_id_edit_hidden" name="fc_id_edit_hidden" class="form-control"/>
                                                </div>
                                              </div>  
                                                <div class="col-lg-4">
                                                    <label for="challan_quantity_add" class="control-label">Challan Issue Quantity</label>
                                                    <input type="text" id="challan_quantity_issue_edit" name="challan_quantity_issue_edit" class="form-control" />
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="challan_quantity_add" class="control-label">Receipt Quantity</label>
                                                    <input type="text" id="challan_quantity_receipt_edit" name="challan_quantity_receipt_edit" class="form-control" />
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
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
    $("#form_sample_receive_edit").validate({
        rules: {
            am_id: {
                required: true
            },
            sample_receipt_challan_number: {
                required: true
            },
            sample_receipt_challan_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_sample_receive_edit').ajaxForm({
        beforeSubmit: function () {
            return $("#form_sample_receive_edit").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            //console.log(returnData);
        }
    });
$(document).ready(function() {
$("#am_id_add").change(function(){
        $am_id = $(this).val();
        $('#lc_id_text').val('');
        $('#fc_id_text').val('');
        $('#lc_id').val('');
        $('#fc_id').val('');
	   $.ajax({
            url: "<?= base_url('admin/get_article_color_wrt_am_id') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id},
            success: function(result){                
                $.each(result, function(index, item) {
        $('#lc_id_text').val(item.leather_color);
        $('#fc_id_text').val(item.fitting_color);
        $('#lc_id').val(item.lth_color_id);
        $('#fc_id').val(item.fit_color_id);
                });
                // open the challan list 
            },
            error: function(e){console.log(e);}
        }); 
    });
});

    $(document).ready(function() {
        $('#sample_receipt_challan_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-sample-receipt-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    sample_receipt_id: function () {
                        return $("#sample_receipt_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "issue_number" },
                { "data": "article_number" },
                { "data": "leather_color" },
				{ "data": "fitting_color" },
                { "data": "issue_quantity" },				
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [5],
                "orderable": false,
            }]
        } );  
    });

    

	
    
    $("#form_add_sample_issue_challan_details").validate({
        rules: {
            am_id_add: {
                required: true
            },
            lc_id_add: {
                required: true
            },
            fc_id_add: {
                required: true
            },
            challan_quantity_receipt_add: {
                required: true
            },
        },
        messages: {

        }
    });
    $('#form_add_sample_issue_challan_details').ajaxForm({

        beforeSubmit: function () {
            return $("#form_add_sample_issue_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
            //refresh table
            $('#form_add_sample_issue_challan_details')[0].reset(); //reset form
            $("#form_add_sample_issue_challan_details").validate().resetForm(); //reset validation
            $('#sample_issue_challan_details_table').DataTable().ajax.reload();
            $('#challan_quantity_receipt_add').val('');
        }
    });

    $(document).ready(function() {

        $am_id = $('option:selected', "#am_id").val();
        
        $.ajax({
            url: "<?= base_url('admin/sample-issue-by-acc-master') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id},
            success: function(result){
                // console.log('length:'+result.length);            
                console.log(JSON.stringify(result));
                
                $("#challan_no_add").html("");
                $("#challan_no_add").append('<option value="">Select Sample Challan Number</option>');

                $.each(result, function(index, item) {
                    $str = '<option value=' + item.sample_issue_id + '> '+ item.sample_challan_number + '</option>';
                    $("#challan_no_add").append($str);
                });

                // open the challan list 
                
            },
            error: function(e){console.log(e);}
        });
        
    });

    $("#challan_no_add").change(function(){

        $challan_no = $('option:selected', this).val();
        
        $.ajax({
            url: "<?= base_url('admin/article-master-by-sample-challan-no') ?>",
            method: "post",
            dataType: 'json',
            data: {'challan_no': $challan_no},
            success: function(result){
                // console.log('length:'+result.length);            
                console.log(JSON.stringify(result));
                
                $("#am_id_add").html("");
                $("#am_id_add").append('<option value="">Select Article Number</option>');

                $.each(result, function(index, item) {
                    $str = '<option value=' + item.sample_issue_detail_id + ' lc_id=' + item.lc_id + ' fc_id=' + item.fc_id + ' quantity=' + item.challan_quantity + ' challan_no=' + item.sample_issue_id + ' leather=' + item.leather_color + ' fitting=' + item.fitting_color + ' > '+ item.art_no + '['+
                   item.leather_color + ']</option>';
                    $("#am_id_add").append($str);
                });

                // open the challan list 
                $('#am_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
        
    });

     $("#am_id_add").change(function(){
        //$am_id_add = $(this).val();
        $sample_issue_details_id = $(this).find(":selected").val();
        $leather_colour = $(this).find(":selected").attr('leather');
        $fitting_colour = $(this).find(":selected").attr('fitting');
        $fc_id = $(this).find(":selected").attr('fc_id');
        $quantity = $(this).find(":selected").attr('quantity');
        $challan_no = $(this).find(":selected").attr('challan_no');
        $receipt_no = <?= $this->uri->segment(3) ?>;


        $.ajax({
            url: "<?= base_url('admin/article-quantity-by-sample-challan-no') ?>",
            method: "post",
            dataType: 'json',
            data: {'sample_issue_details_id': $sample_issue_details_id, 'receipt_no': $receipt_no},
            success: function(result){
                // console.log('length:'+result.length);            
                console.log(JSON.stringify(result));
                $.each(result, function(index, item) {
        if(parseFloat(item.challan_quantity) == parseFloat(item.receive_quantity)){
            alert('received');
                $("#lc_id_add").val('');
                $("#fc_id_add").val('');
                $("#lc_id_add_hidden").val('');
                $("#fc_id_add_hidden").val('');
                $("#am_id_hidden_for_add").val('');
                $("#challan_quantity_issue_add").val('');
                $('#challan_quantity_receipt_add').attr('max',0);
                $('#challan_quantity_receipt_add').val('');
                
        } else {
           $receive_remaining = parseFloat(item.challan_quantity) - parseFloat(item.receive_quantity);
           $("#lc_id_add").val(item.leather_color);
                $("#fc_id_add").val(item.fitting_color);
                $("#lc_id_add_hidden").val(item.lc_id);
                $("#fc_id_add_hidden").val(item.fc_id);
                $("#am_id_hidden_for_add").val(item.am_id);
                $("#challan_quantity_issue_add").val($receive_remaining);
                $('#challan_quantity_receipt_add').attr('max',$receive_remaining);
                $('#challan_quantity_receipt_add').val($receive_remaining); 
        }
        });
            },
            error: function(e){console.log(e);}
        });

    });

    $("#form_add_sample_receive_challan_details").validate({
        rules: {
            sample_challan_number: {
                required: true
            },
            am_id: {
                required: true
            },
            lc_id: {
                required: true
            },
            fc_id: {
                required: true
            },
            sample_receive_quantity: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_sample_receive_challan_details').ajaxForm({

        beforeSubmit: function () {
            return $("#form_add_sample_receive_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            //console.log(returnData);
            //refresh table
            $("#lc_id_add").val('');
            $("#fc_id_add").val('');
            $("#lc_id_add_hidden").val('');
            $("#fc_id_add_hidden").val('');
            $("#challan_quantity_issue_add").val('');
            $('#challan_quantity_receipt_add').attr('max',0);
            $('#challan_quantity_receipt_add').val('');
            $("#challan_total_amount").val(obj.new_quantity);
            $('#sample_receipt_challan_details_table').DataTable().ajax.reload();
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
                url: "<?= base_url('admin/del-sample-challan-receipt-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, quantity: $quantity, ref_pk: $ref_pk},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    obj = JSON.parse(returnData);
                    // notification(returnData);
                    $("#challan_total_amount").val(obj.new_quantity);
                    //refresh table
                    $("#skiving_issue_challan_details_table").DataTable().ajax.reload();

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
