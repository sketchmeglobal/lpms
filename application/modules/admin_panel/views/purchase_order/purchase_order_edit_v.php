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

    <title>Edit Purchase Order | <?=WEBSITE_NAME;?></title>

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

        .add_bgclr {
            background-color: #b5e3b5;
        }

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff}

        .hide {
            display: none;
        }

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

            <h3 class="m-b-less">Edit Purchase Order</h3>

            <div class="state-information">

                <ol class="breadcrumb m-b-less bg-less">

                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>

                    <li class="active"> Edit Purchase Order </li>

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

                            Edit <?= $purchase_order_details[0]->po_number ?>

                            <span class="tools pull-right">

                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>

                            </span>

                        </header>

                        <div class="panel-body">

                        <?php #print_r($purchase_order_details); die;?>

                            <form id="form_edit_purchase_order" method="post" action="<?=base_url('admin/form_edit_purchase_order')?>" class="cmxform form-horizontal tasi-form">

                                <div class="form-group ">

                                    <div class="col-lg-6">

                                        <label for="po_number" class="control-label text-danger">Purchase Order Number *</label><br />

                                        <!-- <input id="po_number" name="po_number" type="text" placeholder="Purchase Order Number" class="form-control round-input" /> -->

                                        <label><b><?= $purchase_order_details[0]->po_number ?></b></label>

                                    </div>



                                    <div class="col-lg-6">

                                        <label for="acc_master_id" class="control-label text-danger">Supplier</label><br />

                                        <label><b><?= $purchase_order_details[0]->name . '['. $purchase_order_details[0]->short_name .']' ?></b></label>
                                        <input type="hidden" name="supplier_id" id="supplier_id" value="<?= $purchase_order_details[0]->am_id ?>">

                                    </div>

                                </div>



                                <div class="form-group ">

                                    <div class="col-lg-4">

                                        <label for="po_date" class="control-label text-danger">Purchase Order Date *</label>

                                        <input value="<?= date('Y-m-d', strtotime($purchase_order_details[0]->po_date)) ?>" id="po_date" name="po_date" type="date" placeholder="Purchase Order Date" class="form-control round-input" />

                                    </div>



                                    <div class="col-lg-4">

                                        <label for="delivery_date" class="control-label text-danger">Delivery Date *</label>

                                        <input value="<?= date('Y-m-d', strtotime($purchase_order_details[0]->po_delivery_date)) ?>" id="delivery_date" name="delivery_date" type="date" placeholder="Delivery Date" class="form-control round-input" />

                                    </div>

                                    <div class="col-lg-4">

                                        <label for="shipment_date" class="control-label">Shipment Date </label>

                                        <input value="<?= date('Y-m-d', strtotime($purchase_order_details[0]->shipment_date)) ?>" id="shipment_date" name="shipment_date" type="date" placeholder="Shipment Date" class="form-control round-input" />

                                    </div>

                                </div>



                                <div class="form-group ">

                                    <div class="col-lg-4">

                                        <label for="remarks" class="control-label">Remarks</label>

                                        <textarea id="remarks" name="remarks" placeholder="Remarks" class="form-control round-input"><?= $purchase_order_details[0]->remarks ?></textarea>

                                    </div>

                                    

                                    <div class="col-lg-4">

                                        <label for="terms" class="control-label">Terms & Conditions</label>

                                        <textarea id="terms" name="terms" placeholder="Terms & Conditions" class="form-control round-input"><?= $purchase_order_details[0]->remarks ?></textarea>

                                    </div>



                                    <div class="col-lg-4">

                                        <label class="control-label text-danger">Status *</label><br />

                                        <input type="radio" name="status" id="enable" value="1" <?= ($purchase_order_details[0]->status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">

                                        <label for="enable" class="control-label">Enable</label>



                                        <input type="radio" name="status" id="disable" value="0" <?= ($purchase_order_details[0]->status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">

                                        <label for="disable" class="control-label">Disable</label>

                                    </div>

                                </div>



                                <div class="form-group">

                                    <div class="col-sm-offset-3 col-sm-3">

                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Purchase Order</i></button>

                                    </div>

                                    <div class="col-sm-3">

                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>

                                    </div>

                                </div>

                                <input type="hidden" id="purchase_order_id" name="purchase_order_id" class="hidden" value="<?= $purchase_order_details[0]->po_id ?>" />

                            </form>

                        </div>

                    </section>

                </div>

                <div class="col-md-2 hidden-xs">

                    <section class="panel">

                        <header class="panel-heading">

                            Buyer:

                            <span class="tools pull-right">

                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>

                            </span>

                        </header>

                        <!-- < ?= print_r($purchase_order); ?> -->

                        <div class="panel-body">

                            <p class='text-center'> <a target="_blank" class="badge bg-primary" href="<?= base_url('admin_panel/Master/account_master/edit') ?>/<?= $purchase_order_details[0]->am_id ?>"><?= $purchase_order_details[0]->name . '['. $purchase_order_details[0]->short_name .']' ?></a></p>

                            <hr />

                        </div>

                    </section>

                </div>

            </div>







           

            <div class="row">

                <div class="col-md-10">

                    <section class="panel">

                        <header class="panel-heading">

                            Add purchase order details for <?= $purchase_order_details[0]->po_number ?>

                            <span class="tools pull-right">

                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>

                            </span>

                        </header>

                        <div class="panel-body">

                            <!--Tabs-->

                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">

                                <li class="active"><a href="#po_list" data-toggle="tab">List</a></li>

                                <li><a href="#po_add" data-toggle="tab">Add</a></li>

                                <li id="po_details_edit_tab" class="disabled"><a href="#po_details_edit" data-toggle="">Edit</a></li>

                            </ul>

                            <!--Tab Content-->

                            <div class="tab-content">

                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />

                                <div id="po_list" class="tab-pane fade in active">

                                    <table id="po_details_table" class="table data-table dataTable">

                                        <thead>

                                            <tr>

                                                <th>Item Name</th>

                                                <th>Item Color</th>

                                                <th>Qnty</th>

                                                <th>Rate</th>

                                                <th>Total</th>

                                                <th>Remarks</th>

                                                <th>Actions</th>

                                            </tr>

                                        </thead>

                                        <tbody style="white-space: nowrap;">



                                        </tbody>

                                    </table>

                                </div>



                                <div id="po_add" class="tab-pane fade">

                                    <br/>

                                    <div class="form">

                                        <form id="form_add_purchase_order_details" method="post" action="<?=base_url('admin/form_add_purchase_order_details')?>" class="cmxform form-horizontal tasi-form">

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

                                                        <option value="">Select Item</option>

                                                    </select>

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

                                                    <label id="pod_total"></label>

                                                </div>



                                                <div class="col-lg-5">

                                                    <label for="pod_remarks" class="control-label">Remarks</label>

                                                    <input type="text" id="pod_remarks" name="pod_remarks" class="form-control" />

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <div class="col-lg-4 col-lg-offset-4">

                                                    <label for="" class="control-label">&nbsp;</label><br>

                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>

                                                </div>

                                            </div>

                                            <input type="hidden" name="purchase_order_id" class="hidden" value="<?= $purchase_order_details[0]->po_id ?>" />

                                        </form>

                                    </div>

                                </div>



                                <div id="po_details_edit" class="tab-pane">

                                    <br/>

                                    <div class="form">

                                        <form id="form_edit_purchase_order_details" method="post" action="<?=base_url('admin/form_edit_purchase_order_details')?>" class="cmxform form-horizontal tasi-form">

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

                                            <input type="hidden" name="purchase_order_id" class="hidden" value="<?= $purchase_order_details[0]->po_id ?>" />

                                            <input type="hidden" name="pod_id" id="pod_id" class="hidden" value="" />

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                    <section class="panel panel_last hide">
                        <header class="panel-heading">
                            Add purchase order details for <?= $purchase_order_details[0]->po_number ?> - <span class="add_artdtl"></span>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>

                        <div class="panel-body1">
                            <!--Tabs-->
                            <ul id="customer_order_tabs1" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#co_brk_up" data-toggle="tab">List</a></li>
                                <li><a href="#co_brk_up_add" data-toggle="tab">Add</a></li>
                                <li id="co_details_brk_up_edit_tab" class="disabled"><a href="#co_details_brk_up_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                            <div style="display:none" id="loading_div">
                            <img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>
                            </div>
                                <div id="co_brk_up" class="tab-pane fade in active">
                                    <table id="co_brk_up_list_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th> Item Name # </th>
                                            <th>Lth Color</th>
                                            <th>Qnty</th>
                                            <th>Date</th>
                                            <th>Customer Order</th>
                                            <th>Remarks</th>
<!--                                             <th>Remarks</th>
 -->                                            <!-- <th>Status</th> -->
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="co_brk_up_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_purchase_order_brkup_details" method="post" action="<?=base_url('admin/form_add_purchase_order_brkup_details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="article_brk_up_date" class="control-label text-danger"> Date * </label>
                                                    <input type="date" id="article_brk_up_date" name="article_brk_up_date" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="article_brk_up_quantity" class="control-label text-danger"> Article Quantity* </label>
                                                    <input type="number" id="article_brk_up_quantity" name="article_brk_up_quantity" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-3">
                                                <label for="cust_brkup_order" class="control-label">Customer Order No.</label>
                                                <select id="cust_brkup_order" name="cust_brkup_order[]" class="form-control select2" multiple>
                                                <option value="">Select Customer Order</option>
                                                <?php
                                                foreach($co_ids as $c_i){
                                                ?> 
                                                <option value="<?=$c_i->co_id?>"><?=$c_i->co_no?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="article_brk_up_remarks" class="control-label"> Remarks </label>
                                                    <input type="text" id="article_brk_up_remarks" name="article_brk_up_remarks" class="form-control" />
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit" id="cod_brk_up_detail_add"><i class="fa fa-plus"></i> Add details</button>
                                            <input type="text" name="cod_brk_up_id" class="cod_brk_up_id hidden" value="">
                                        </form>
                                    </div>
                                </div>

                                <div id="co_details_brk_up_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_purchase_order_details_brkup" method="post" action="<?=base_url('admin/form_edit_purchase_order_details_brkup')?>" class="cmxform form-horizontal tasi-form">
                                                <div class="form-group ">
                                                    <div class="col-lg-3">
                                                    <label for="article_brk_up_date_edit" class="control-label text-danger"> Date * </label>
                                                    <input type="date" id="article_brk_up_date_edit" name="article_brk_up_date_edit" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="article_brk_up_quantity_edit" class="control-label text-danger"> Article Quantity* </label>
                                                    <input type="number" id="article_brk_up_quantity_edit" name="article_brk_up_quantity_edit" class="form-control"  required/>
                                                </div>

                                                <div class="col-lg-3">
                                                <label for="cust_edit_brkup_order" class="control-label">Customer Order No.</label>
                                                <select id="cust_edit_brkup_order" name="cust_edit_brkup_order[]" class="form-control select2" multiple>
                                                <option value="">Select Customer Order</option>
                                                <?php
                                                foreach($co_ids as $c_i){
                                                ?> 
                                                <option value="<?=$c_i->co_id?>"><?=$c_i->co_no?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="article_brk_up_remarks_edit" class="control-label"> Remarks </label>
                                                    <input type="text" id="article_brk_up_remarks_edit" name="article_brk_up_remarks_edit" class="form-control" />
                                                </div>
                                            </div>

                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                            <input type="text" name="cod_brk_up_id" class="cod_brk_up_id hidden" value="">
                                            <input type="hidden" name="order_id_brkup" class="order_id_brkup hidden" value="" />
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </section>

                </div>

                <div class="col-md-2">

                    <section class="panel">

                        <header class="panel-heading">

                            Total:

                            <span class="tools pull-right">

                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>

                            </span>

                        </header>

                        <div class="panel-body other-charges">                        

                            <label><strong>Total Amount</strong></label><br />

                            <div id="purchase_order_total_amount" class="bg-dark text-center" style="padding: 2%"><?= $purchase_order_details[0]->po_total ?></div>

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

        $('#po_details_table').DataTable( {

            "processing": true,

            "language": {

                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',

            },

            "serverSide": true,

            "ajax": {

                "url": "<?=base_url('admin/ajax_purchase_order_details_table_data')?>",

                "type": "POST",

                "dataType": "json",

                data: {

                    purchase_order_id: function () {

                        return $("#purchase_order_id").val();

                    },

                },

            },

            //will get these values from JSON 'data' variable

            "columns": [

                { "data": "item" },

                { "data": "color" },

                { "data": "pod_quantity" },

                { "data": "pod_rate" },

                { "data": "pod_total" },

                { "data": "pod_remarks" },

                { "data": "action" },

            ],

            //column initialisation properties

            "columnDefs": [{

                "targets": [2,3,4,5,6],

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

                console.log(all_items);

                $("#id_id").html("");
                
                var str = '';
                str += '<option value="">--Select Colour--</option>';
                
                $.each(all_items, function(index, item) {

                    str += '<option data-im-id = '+ item.im_id +' value=' + item.id_id + ' item_group_val=' + item.value + ' unit=' + item.unit + '> '+ item.item_name + '</option>';

                });
                
                $("#id_id").append(str);
                
                // open the item tray 

                $('#id_id').select2('open');

            },

            error: function(e){console.log(e);}

        });

    });



    $(document).on('change', '#id_id', function(){

        $im_id = $(this).find(':selected').data('im-id');
        $("#color").html("");
        // alert($im_id);

        $.ajax({

            url: "<?= base_url('admin/all-colors-on-item-master') ?>",

            method: "post",
            dataType: 'json',
            data: {'item_id': $im_id,},
            success: function(all_colors){
                // console.log(all_items);
                
                $("#pod_unit").html("<b>" +all_colors[0].unit+ '</b>');
                
                  var str = '';
                str += '<option value="">--Select Colour--</option>';
                $.each(all_colors, function(index, item) {
                    
                    str += '<option value=' + item.item_dtl_id + '> '+ item.color + '</option>';
                    
                });
                $("#color").append(str);

                // open the item tray 

                $('#color').select2('open');

            },

            error: function(e){console.log(e);}

        });

    });


    $(document).on('change', '#color', function(){
        $im_id = $(this).val();
        $supp_id = $("#supplier_id").val();
        $purchase_date = $("#po_date").val();
        $.ajax({

            url: "<?= base_url('admin/fetch-cost-rate-wrt-item') ?>",

            method: "post",
            dataType: 'json',
            data: {'item_id': $im_id, 'supplier_id': $supp_id, 'purchase_date': $purchase_date}, 
            success: function(cost_rate){
                // console.log(cost_rate);

                    $("#pod_rate").val(cost_rate);

            },
            error: function(e){console.log(e);}

        });

    });

    $('#form_add_purchase_order_brkup_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_purchase_order_brkup_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);

            // $('#form_add_purchase_order_brkup_details')[0].reset(); //reset form
            $("#article_brk_up_date").val("");
            $("#article_brk_up_remarks").val("");
            $("#article_brk_up_quantity").val("");
            $("#cust_brkup_order").select2("val", "");
            // $("#form_add_purchase_order_brkup_details").validate().resetForm(); //reset validation

            notification(obj);
            
            //refresh table
            $('#co_brk_up_list_table').DataTable().ajax.reload();
            
        }
    });

    $('#form_edit_purchase_order_details_brkup').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_purchase_order_details_brkup").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);
             $('#form_edit_purchase_order_details_brkup')[0].reset(); //reset form
            $("#form_edit_purchase_order_details_brkup").validate().resetForm(); //reset validation

            notification(obj);
            
            //refresh table
            $('#co_brk_up_list_table').DataTable().ajax.reload();
            
        }
    });


    // ADD - multiply for item_amount

    $("#pod_quantity, #pod_rate").on('change', function () {

        $pod_quantity = $("#pod_quantity").val();

        $pod_rate = $("#pod_rate").val();

        $("#pod_total").html("<b>" +($pod_quantity * $pod_rate).toFixed(2) + "</b>");

    });

// EDIT - multiply for item_amount

    $("#pod_quantity_edit, #pod_rate_edit").on('change', function () {

        $pod_quantity_edit = $("#pod_quantity_edit").val();

        $pod_rate_edit = $("#pod_rate_edit").val();

        $("#pod_total_edit").html("<b>" +($pod_quantity_edit * $pod_rate_edit).toFixed(2)+ "</b>");

    });



    

    $("#form_edit_purchase_order").validate({

        rules: {

            po_date: {

                required: true

            },

            delivery_date: {

                required: true

            },

        },

        messages: {



        }

    });

    $('#form_edit_purchase_order').ajaxForm({

        beforeSubmit: function () {

            return $("#form_edit_purchase_order").valid(); // TRUE when form is valid, FALSE will cancel submit

        },

        success: function (returnData) {

            obj = JSON.parse(returnData);

            notification(obj);

        }

    });



    //add-purchase order details-form validation and submit

    $("#form_add_purchase_order_details").validate({

        rules: {

            ig_id: {

                required: true,

            },

            id_id: {

                required: true,

            },

            color: {    
                required: true,
                 remote: {
                     url: "<?=base_url('admin/ajax_unique_po_number_and_art_no_and_lth_color')?>",
                     type: "post",
                     data: {
                         purchase_order_id: function () {
                             return $("#purchase_order_id").val();
                         },
                         id_id: function () {
                             return $("#id_id").val();
                         },
                         color: function () {
                             return $("#color").val();
                         },
                     },
                 },
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

    $('#form_add_purchase_order_details').ajaxForm({

        beforeSubmit: function () {

            return $("#form_add_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit

        },

        success: function (returnData) {

            console.log('RD => ' + returnData);

            obj = JSON.parse(returnData);



            $purchase_order_total_amount = parseFloat(obj.pod_total).toFixed(2);

            $("#purchase_order_total_amount").text($purchase_order_total_amount);

            $("#pod_total").html("");
            // $('#color').html("");
            $('#pod_quantity').val("");
            $('#pod_rate').val("");
            $('#color').select2('open');
            // $('#form_add_purchase_order_details')[0].reset(); //reset form
            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields
            // $("#form_add_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            //refresh table

            $('#po_details_table').DataTable().ajax.reload();

            

        }

    });



    //edit-purchase order details-form validation and submit

    $("#form_edit_purchase_order_details").validate({

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



    $('#form_edit_purchase_order_details').ajaxForm({

        beforeSubmit: function () {

            return $("#form_edit_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit

        },

        success: function (returnData) {

            console.log('RD => ' + returnData);

            obj = JSON.parse(returnData);



            $purchase_order_total_amount = parseFloat(obj.total_amount).toFixed(2);

            $purchase_order_total_quantity = parseFloat(obj.total_qnty).toFixed(2);

            $("#purchase_order_total_amount").text($purchase_order_total_amount);

            $("#purchase_order_total_quantity").text($purchase_order_total_quantity);



            $('#form_add_purchase_order_details')[0].reset(); //reset form

            // $("#form_add_purchase_order_details select").select2("val", ""); //reset all select2 fields

            // $('#form_add_purchase_order_details :radio').iCheck('update'); //reset all iCheck fields

            $("#form_add_purchase_order_details").validate().resetForm(); //reset validation

            notification(obj);

            $po_total = parseFloat(obj.pod_total).toFixed(2);

            $("#purchase_order_total_amount").text($po_total);

            //refresh table

            $('#po_details_table').DataTable().ajax.reload();

            

        }

    });



    //article-costing-measurement edit button

    $("#po_details_table").on('click', '.purchase_details_edit_btn', function() {

        $("#pod_edit_loader").removeClass('hidden');



        $pod_id = $(this).attr('pod_id');



        $.ajax({

            url: "<?= base_url('admin/ajax_fetch_purchase_order_details_on_pk') ?>",

            method: "post",

            dataType: 'json',

            data: {'pod_id': $pod_id,},

            success: function(pod_data){

                console.log(pod_data);

                data = pod_data[0];

                

                $("#ig_id_edit").html("<option>"+data.group_name+"</option>").trigger('change');

                $("#id_id_edit").html("<option>"+data.item+"</option>").trigger('change');

                $("#color_edit").html("<option>"+data.color+"</option>").trigger('change');

                $("#pod_unit_edit").html('<b>'+data.unit+'</b>');

                $("#pod_quantity_edit").val(data.pod_quantity);

                $("#pod_rate_edit").val(data.pod_rate);

                $("#pod_total_edit").html('<b>'+(Number(data.pod_total)).toFixed(2)+'</b>');

                $("#pod_remarks_edit").val(data.pod_remarks);

                $("#pod_id").val(data.pod_id);



                $('#po_details_edit_tab').removeClass('disabled');

                $('#po_details_edit_tab').children("a").attr("data-toggle", 'tab');

                // $('#po_details_edit_tab li:eq(2) a').tab('show');

                $('a[href="#po_details_edit"]').tab('show');

                $("#pod_edit_loader").addClass('hidden');

                

            }

        });

    });

    $("#co_brk_up_list_table").on('click', '.customer_details_brkup_edit_btn', function() {
        $id = $(this).attr('id');

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_purchase_order_details_brkup_edit') ?>",
            method: "post",
            dataType: 'json',
            data: {'id': $id,},
            success: function(data){
                console.log(data);
                data = data[0];

                $("#article_brk_up_quantity_edit").val(data.co_quantity);
                $("#article_brk_up_date_edit").val(data.ord_date);
                $("#article_brk_up_date").val(data.remarks);

                $(".cod_brk_up_id").val(data.pod_id);
                $(".order_id_brkup").val(data.id);
                var custArr = data.cod_id.split(',');
                $("#cust_edit_brkup_order").val(custArr).change();
                $('#co_details_brk_up_edit_tab').removeClass('disabled');
                $('#co_details_brk_up_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#co_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#co_details_brk_up_edit"]').tab('show');
            },
        });
    });


//Break up history add button
    $("#po_details_table").on('click', '.brk_up_history', function() {
        $('.cod_brk_up_id').val($(this).attr('cod_id'));
        $('#co_brk_up_list_table').DataTable().destroy();
        $cod_id = $(this).attr('cod_id');
        $('#form_add_purchase_order_brkup_details')[0].reset(); //reset form
        $("#form_add_purchase_order_brkup_details").validate().resetForm(); //reset validation
         $('#form_edit_purchase_order_details_brkup')[0].reset(); //reset form
        $("#form_edit_purchase_order_details_brkup").validate().resetForm(); //reset validation
        $('#co_brk_up_list_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Purchase Order PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Purchase Order Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }    
               }
           ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax_fetch_purchase_order_breakup_details_on_pk')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    cod_id: function () {
                        return $cod_id;
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "art_no" },
                { "data": "lc_id" },
                { "data": "co_quantity" },
                { "data": "ord_date" },
                { "data": "cust_ord_no" },
                { "data": "remarks" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [0,1,2,3,4,5,6],
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
                "targets": 5, 
                "className": 'dtl_amount',  
            }],
    });
        $(".panel_last").removeClass("hide");
        // $('.panel-body2').addClass("hide");
        // alert($cod_id);
        $('.cod_brk_up_id').val($cod_id);
        $(".add_artdtl").html($(this).parent("td").prev().prev().prev().prev().prev().prev().text()+" - "+$(this).parent("td").prev().prev().prev().prev().prev().text());
        $(this).parent("td").parent("tr").addClass("add_bgclr");
        $("#po_details_table tbody tr").not($(this).parent("td").parent("tr")).removeClass("add_bgclr");
        $('html, body').animate({
        scrollTop: $(".panel_last").offset().top
    }, 1000);
    });

    $("#article_brk_up_quantity").on('change', function () {
        var val = $(this).val();
        $cod_id = $(".cod_brk_up_id").val();
        $this = $(this);

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_purchase_order_details_brkup_qnty') ?>",
            method: "post",
            dataType: 'json',
            data: {'val': val, 'cod_id': $cod_id},
            success: function(data){
                console.log(data);

                $this.attr({
                "max" : data.left_qantity,        // substitute your own
                });
            },
        });
        
    });
    
    $("#article_brk_up_quantity_edit").on('change', function () {
        var val = $(this).val();
        $break_up_order_id = $(".order_id_brkup").val();
        $cod_id = $(".cod_brk_up_id").val();
        $this = $(this);

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_purchase_order_details_brkup_qnty_edit') ?>",
            method: "post",
            dataType: 'json',
            data: {'val': val, 'cod_id': $cod_id, 'break_up_order_id': $break_up_order_id},
            success: function(data){
                console.log(data);
                if(val > data.left_qantity) {
                    alert('enter a value less than'+ data.left_qantity);
                    $("#article_brk_up_quantity_edit").val(0);
                }
            },
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

    $(document).on('click', '.delete_last', function(){
        $this = $(this);
        if(confirm("Are You Sure? This Process Can\'t be Undone.")){
            $pk = $(this).attr('data-pk');
            $tab = $(this).attr('data-tab');
            $proforma_status = $(this).attr('proforma_status');

            $.ajax({
                url: "<?= base_url('admin/del-row-on-table-pk-purch-order/') ?>",
                dataType: 'json',
                type: 'POST',
                data: {pk: $pk, tab : $tab, proforma_status: $proforma_status},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);

                    // $customer_order_total_amount = parseFloat(returnData.total_amount).toFixed(2);
                    $("#co_brk_up_list_table").DataTable().ajax.reload();
                },
                error: function (returnData) {
                    obj = JSON.parse(returnData);
                    notification(obj);
                }
            });
        }
        
    });

    $(document).on('click', '.delete', function(){

        $this = $(this);

        if(confirm("Are You Sure? This Process Can\'t be Undone.")){

            $pk = $(this).attr('data-pk');

            $tab = $(this).attr('data-tab');
			
			$id_id = $(this).attr('id-id');
			
            $header_id = $("#purchase_order_id").val();



            $.ajax({

                url: "<?= base_url('admin/del-row-on-table-pk-purchase-order-details') ?>",

                dataType: 'json',

                type: 'POST',

                data: {pk: $pk, tab : $tab, po_id: $header_id, id_id: $id_id},

                success: function (returnData) {

                    console.log(returnData);

                    $this.closest('tr').remove();

                    

                    // obj = JSON.parse(returnData);

                    notification(returnData);



                    $pod_total = parseFloat(returnData.pod_total).toFixed(2);

                    //$purchase_order_total_quantity = parseFloat(returnData.total_qnty).toFixed(2);

                    $("#purchase_order_total_amount").text($pod_total);

                    //$("#purchase_order_total_quantity").text($purchase_order_total_quantity);

                    

                    //refresh table

                    $("#po_details_table").DataTable().ajax.reload();



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

        $poi = $("#purchase_order_id").val();

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

