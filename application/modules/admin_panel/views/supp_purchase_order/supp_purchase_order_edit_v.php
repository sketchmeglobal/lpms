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
    <title>Edit Supp. Purchase Order | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Edit Supp. Purchase Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Supp. Purchase Order </li>
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
                            Edit <?= $supp_purchase_order_details[0]->supp_po_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_supp_purchase_order" method="post" action="<?=base_url('admin/form-edit-supp-purchase-order')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="supp_po_number_add" class="control-label text-danger">Supp. Purchase Order Number *</label>
                                    <!--<input id="supp_po_number" name="supp_po_number" value="<?= $supp_purchase_order_details[0]->supp_po_number ?>" type="text" placeholder="Supp. Purchase Order Number" class="form-control round-input" />-->
                                    <label><?= $supp_purchase_order_details[0]->supp_po_number ?></label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="pur_order_date_add" class="control-label text-danger">Purchase Order Date *</label>
                                        <input id="pur_order_date" name="pur_order_date" value="<?= $supp_purchase_order_details[0]->pur_order_date ?>" type="date" placeholder="Purchase Order Date" class="form-control round-input" />
                                    </div>                                    
                                    <div class="col-lg-3">
                                        <label for="am_id_add" class="control-label text-danger">Select Supplier *</label><br />
                                        <label><b><?= $supp_purchase_order_details[0]->name . '['. $supp_purchase_order_details[0]->short_name .']' ?></b></label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="buyer_details_add" class="control-label">Buyer Detail</label>
                                        <textarea id="buyer_details" name="buyer_details" placeholder="Buyer Detail" class="form-control round-input" readonly><?= $supp_purchase_order_details[0]->buyer_details ?></textarea>
                                    </div>
                                </div>                               
                            <div class="form-group ">
                                	<div class="col-lg-3">
                                        <label for="po_id_add" class="control-label text-danger">Select Purchase Order *</label><br />
                                        <label><b><?= $supp_purchase_order_details[0]->po_number ?></b></label>
                                    </div>
                                	<div class="col-lg-3">
                                        <label for="terms_condi_add" class="control-label">Terms & Conditions</label>
                                        <textarea id="terms_condi" name="terms_condi" placeholder="Terms & Conditions" class="form-control round-input"><?= $supp_purchase_order_details[0]->terms_condi ?></textarea>
                                    </div>                                      
                                    <div class="col-lg-3">
                                        <label for="supp_remarks_add" class="control-label">Remarks</label>
                                        <textarea id="supp_remarks" name="supp_remarks" placeholder="Remarks" class="form-control round-input"><?= $supp_purchase_order_details[0]->supp_remarks ?></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="supp_status" id="enable" value="1" <?= ($supp_purchase_order_details[0]->supp_status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="supp_status" id="disable" value="0" <?= ($supp_purchase_order_details[0]->supp_status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Supp.Purchase Order</i></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div> 
                                <input type="hidden" id="sup_id" name="sup_id" class="hidden" value="<?= $supp_purchase_order_details[0]->sup_id ?>" />
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
                            <p class='text-center' id="purchase_order_total_amount"><?= $supp_purchase_order_details[0]->supp_po_total ?></p>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Supp.purchase order details for <?= $supp_purchase_order_details[0]->supp_po_number ?>
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
                                        <form id="form_add_supp_purchase_order_details" method="post" action="<?=base_url('admin/form-add-supp-purchase-order-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="ig_id" class="control-label text-danger">Item Group*</label>
                                                    <select id="ig_id" name="ig_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item Group</option>
                                                        <?php foreach($item_groups as $val) { ?>
                                                            <option value="<?=$val['ig_id']?>"><?=$val['group_name'] . ' [' . $val['ig_code'] . ']'?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="id_id" class="control-label text-danger">Item *</label>
                                                    <select id="id_id" name="id_id" required class="select2 form-control round-input">
                                                    </select>
                                                    <input type="hidden" class="show_purc_id" id="show_purc_id" value="<?= $supp_purchase_order_details[0]->po_id ?>">
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="color" class="control-label text-danger">Colour *</label>
                                                    <select id="color" name="color" required class="select2 form-control round-input">
                                                        <option value="">Select Colour</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit"></label>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="pod_quantity" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity" name="pod_quantity" required class="form-control" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_rate" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate" name="pod_rate" required class="form-control" />
                                                </div>

                                                <div class="col-lg-1 border-black-bottom">
                                                    <label for="pod_total" class="control-label">Total</label><br />
                                                    <!--<label id="pod_total"></label>-->
                                                    <input type="number" step="0.01" id="pod_total" name="pod_total" required class="form-control" readonly />
                                                </div>

                                                <div class="col-lg-5">
                                                    <label for="pod_remarks" class="control-label">Remarks</label>
                                                    <input type="text" id="sup_pod_remarks" name="sup_pod_remarks" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="supp_purchase_order_id" id="supp_purchase_order_id" class="hidden" value="<?= $supp_purchase_order_details[0]->sup_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="po_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_supp_purchase_order_details" method="post" action="<?=base_url('admin/form-edit-supp-purchase-order-details')?>" class="cmxform form-horizontal tasi-form">
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
                                            <input type="hidden" id="sup_id" name="sup_id" class="hidden" value="<?= $supp_purchase_order_details[0]->sup_id ?>" />
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
                "url": "<?=base_url('admin/ajax-supp-purchase-order-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    supp_purchase_order_id: function () {
                        return $("#supp_purchase_order_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "item" },
                { "data": "color" },
                { "data": "item_qty" },
                { "data": "item_rate" },
                { "data": "total_amount" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,2,3,4,5],
                "orderable": false,
            }]
        } );  
    });

// all items-on-item-group -> from Transaction controller 

      $(document).on('change', '#ig_id', function(){
        $ig_id = $(this).val();
        $purc_id = $('#show_purc_id').val();
        $.ajax({
            url: "<?= base_url('admin/ajax-all-purchase-order-for_supl') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_group': $ig_id, 'po_id': $purc_id},
            success: function(all_items){
                // console.log(all_items);
                $("#id_id").html("");
                $("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                var str = '';
                str += '<option value="">--Select Item</option>';
                $.each(all_items, function(index, item) {
                    str += '<option value=' + item.id_id + ' item_group_val=' + item.value + ' unit=' + item.unit + ' im_id=' + item.im_id + '> '+ item.item_name + '</option>';
                    
                });
                $("#id_id").append(str);
                // open the item tray 
                $('#id_id').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });

    $(document).on('change', '#id_id', function(){
        $im_id = $("option:selected", this).attr('im_id');
        $purc_id = $('#show_purc_id').val();
        $.ajax({
            url: "<?= base_url('admin/all-colors-on-item-master-wrt-purc-ord') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_id': $im_id, 'po_id': $purc_id},
            success: function(all_colors){
                console.log(all_colors);
                $("#color").html("");
                $.each(all_colors, function(index, item) {
                    $str = '<option value=' + item.item_dtl_id + '> '+ item.color + '[Qnty ~ ' + item.pod_quantity + ']</option>';
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

    
    $("#form_edit_supp_purchase_order").validate({
        rules: {
            po_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_supp_purchase_order').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_supp_purchase_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_supp_purchase_order_details").validate({
        rules: {
            ig_id: {
                required: true,
            },
            id_id: {
                required: true,
            },
            color: {    
                required: true,
            },
            pod_quantity: {
                required: true,
            },
            pod_rate: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_supp_purchase_order_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_supp_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            $purchase_order_total_amount = parseFloat(obj.pod_total).toFixed(2);
            $("#purchase_order_total_amount").text($purchase_order_total_amount);
            $("#pod_total").html("");
            // $('#form_add_purchase_order_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_supp_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });

    //edit-purchase order details-form validation and submit
    $("#form_edit_supp_purchase_order_details").validate({
        rules: {
            pod_quantity: {
                required: true,
            },
            pod_rate: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_supp_purchase_order_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_supp_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            $purchase_order_total_amount = parseFloat(obj.total_amount).toFixed(2);
            $purchase_order_total_quantity = parseFloat(obj.total_qnty).toFixed(2);
            $("#purchase_order_total_amount").text($purchase_order_total_amount);
            $("#purchase_order_total_quantity").text($purchase_order_total_quantity);

            $('#form_add_supp_purchase_order_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_supp_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            $po_total = parseFloat(obj.pod_total).toFixed(2);
            $("#purchase_order_total_amount").text($po_total);
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#supp_po_details_table").on('click', '.purchase_details_edit_btn', function() {
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
            
            $data_tab = $(this).attr('data-tab');
			$data_pk = $(this).attr('data-pk');
			$id_id = $(this).attr('id-id');

            $.ajax({
                url: "<?= base_url('admin/del-supp-purchase-order-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_tab: $data_tab, data_pk: $data_pk, id_id: $id_id},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);

                    $purchase_order_total_amount = parseFloat(returnData.total_amount).toFixed(2);
                    //$purchase_order_total_quantity = parseFloat(returnData.total_qnty).toFixed(2);
                    $("#purchase_order_total_amount").text($purchase_order_total_amount);
                    //$("#purchase_order_total_quantity").text($purchase_order_total_quantity);
                    
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
