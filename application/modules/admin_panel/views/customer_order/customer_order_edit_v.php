<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last uploaded on 01-01-2021 at 09:55pm
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Customer Order | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Customer Order">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

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
        .nowrap{white-space: nowrap;}

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .add_bgclr {
            background-color: #b5e3b5;
        }

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
            <h3 class="m-b-less">Edit Customer Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Customer Order </li>
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
                            Edit <?= $customer_order_details[0]->co_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php // print_r($customer_order_details);?>
                            <form id="form_edit_customer_order" method="post" action="<?=base_url('admin/form_edit_customer_order')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="order_no" class="control-label text-danger">Order Number *</label>
                                        <input value="<?= $customer_order_details[0]->co_no ?>" id="order_no" name="order_no" type="text" placeholder="Order Number" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="acc_master_id" class="control-label text-danger">Buyer / Customer *</label>
                                        <select name="acc_master_id" class="form-control select2">
                                                <?php
                                                foreach($buyer_details as $bd){
                                                    $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                                ?> 
                                                    <option <?= ($bd->am_id == $customer_order_details[0]->acc_master_id) ? 'selected' : '' ?> value="<?= $bd->am_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="buyref" class="control-label">Buyer Ref. No.</label>
                                        <input value="<?= $customer_order_details[0]->buyer_reference_no ?>" id="buyref" name="buyref" type="text" placeholder="Buyer Ref. No." class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="ref_date" class="control-label">Ref. Date</label>
                                        <input value="<?= date('Y-m-d', strtotime($customer_order_details[0]->co_reference_date)) ?>" id="ref_date" name="ref_date" type="date" placeholder="Ref. Date" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="order_date" class="control-label text-danger">Order Date *</label>
                                        <input value="<?= date('Y-m-d', strtotime($customer_order_details[0]->co_date)) ?>" id="order_date" name="order_date" type="date" placeholder="Order Date" class="form-control round-input" />
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="delv_date" class="control-label text-danger">Delivery Date *</label>
                                        <input value="<?= date('Y-m-d', strtotime($customer_order_details[0]->co_delivery_date)) ?>" id="delv_date" name="delv_date" type="date" placeholder="Delivery Date" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="rate_type" class="control-label text-danger">Price Type *</label>
                                        <select id="price_type" class="select2 form-control" name="rate_type">
                                            <option <?= ($customer_order_details[0]->co_price_type == 'Ex-works Price') ? 'selected' : '' ?> value="Ex-works Price">Ex-works Price</option>
                                            <option <?= ($customer_order_details[0]->co_price_type == 'C&F Price') ? 'selected' : '' ?> value="C&F Price">C&F Price</option>
                                            <option <?= ($customer_order_details[0]->co_price_type == 'CIF Price') ? 'selected' : '' ?> value="CIF Price">CIF Price</option>
                                            <option <?= ($customer_order_details[0]->co_price_type == 'FOB Price') ? 'selected' : '' ?> value="FOB Price">FOB Price</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="remarks" class="control-label">Remarks</label>
                                        <input value="<?= $customer_order_details[0]->co_remarks ?>" id="remarks" name="remarks" type="text" placeholder="Remarks" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="shipment_date" class="control-label">Shipment Date 1</label>
                                        <input value="<?= date('Y-m-d', strtotime($customer_order_details[0]->shipment_date)) ?>" id="shipment_date" name="shipment_date" type="date" placeholder="Shipment Date 1" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="shipment_date2" class="control-label">Shipment Date 2</label>
                                        <input value="<?= date('Y-m-d', strtotime($customer_order_details[0]->shipment_date2)) ?>" id="shipment_date2" name="shipment_date2" type="date" placeholder="Shipment Date 2" class="form-control round-input" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    
                                    <!--<div class="col-lg-3">-->
                                    <!--    <label for="img" class="control-label">Documents</label>-->
                                    <!--    < ?php if($customer_order_details[0]->img != ''){-->
                                    <!--    ?>-->
                                    <!--    <a href="< ?= base_url('assets/admin_panel/img/customer_order') .'/' . $customer_order_details[0]->img ?>" class="btn btn-primary" download>Download</a>-->
                                        
                                    <!--        < ?php-->
                                    <!--    }else{ ?>-->
                                    <!--    <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png,.doc,.docx,.xls,.pdf" class="file" >-->
                                    <!--    < ?php } ?>-->
                                    <!--</div>-->
                                    <div class="col-lg-4">
                                        <label for="img" class="control-label">Documents</label>
                                        <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png,.doc,.docx,.xls,.pdf" class="file" >
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="office_proforma_status" class="control-label">Show in  Proforma (No) / Packing List (Yes)</label>
                                        <select title="Office Proforma is Completed" name="office_proforma_status" class="form-control">
                                            <option <?=($customer_order_details[0]->office_proforma_status == 1 ? 'Selected' : '')?> value="1">Yes</option>
                                            <option <?=($customer_order_details[0]->office_proforma_status == 0 ? 'Selected' : '')?> value="0">No</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-4" style="background: burlywood;padding-bottom: 10px;">
                                        <label for="store_for_next_year" class="control-label">Transfer order to Next Year</label>
                                        <select title="" name="store_for_next_year" class="form-control">
                                            <option <?=($customer_order_details[0]->store_for_next_year == 'Yes' ? 'Selected' : '')?> value="Yes">Yes</option>
                                            <option <?=($customer_order_details[0]->store_for_next_year == 'No' ? 'Selected' : '')?> value="No">No</option>
                                        </select>
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" <?= ($customer_order_details[0]->status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" <?= ($customer_order_details[0]->status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="control-label text-danger">Show in outstanding report/not *</label><br />
                                        <input type="radio" name="show_in_outstanding_report" id="enable" value="1" <?= ($customer_order_details[0]->show_in_outstanding_report_or_not == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="show_in_outstanding_report" id="disable" value="0" <?= ($customer_order_details[0]->show_in_outstanding_report_or_not == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-label text-danger"></label><br />
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update</i></button>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-label text-danger"></label><br />
                                        <a target="_blank" href="<?= base_url('admin/print-customer-order-consumption') .'/'. $customer_order_details[0]->co_id ?>" class="btn btn-primary"><i class="fa fa-print"></i> Consumption</a>
                                    </div>    
                                </div>
                                <input type="hidden" id="customer_order_id" name="order_id" class="hidden" value="<?= $customer_order_details[0]->co_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Buyer:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($customer_order); ?> -->
                        <div class="panel-body">
                            <p class='text-center'> <a target="_blank" class="badge bg-primary" href="<?= base_url('admin_panel/Master/account_master/edit') ?>/<?= $customer_order_details[0]->acc_master_id ?>"><?= $customer_order_details[0]->name . ' ['. $sn .']' ?></a></p>
                            <hr />
                        </div>
                    </section>
                </div>
                <div class="col-md-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Buyer Documents:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($customer_order); ?> -->
                        <div class="panel-body text-center">
                            <?php if($customer_order_details[0]->img != ''){
                                ?>
                                <a href="<?= base_url('assets/admin_panel/img/customer_order') .'/' . $customer_order_details[0]->img ?>" class="btn btn-primary" download>Download</a>
                                
                                <a target="_blank" href="<?= base_url('assets/admin_panel/img/customer_order') .'/' . $customer_order_details[0]->img ?>" class="btn btn-primary" style="margin-top: 10px;">View</a>
                                
                                <a href="<?= base_url('admin/remove_customer_order_image') .'/' . $customer_order_details[0]->co_id ?>" class="btn btn-danger" style="margin-top: 10px;">Remove</a>
                                <?php
                            }else{
                                echo '<b>Nothing Uploaded</b>';
                            } ?>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>



            <!--Article Costing Charges-->
            <div class="row">
                <div class="col-md-10">
                    <section class="panel">
                        <header class="panel-heading">
                            Add customer order details for <?= $customer_order_details[0]->co_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="customer_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#co_list" data-toggle="tab">List</a></li>
                                <li><a href="#co_add" data-toggle="tab">Add</a></li>
                                <li id="co_details_edit_tab" class="disabled"><a href="#co_details_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                            <div style="display:none" id="loading_div">
                            <img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>
                            </div>
                                <div id="co_list" class="tab-pane fade in active">
                                    <table id="co_details_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Article #</th>
                                            <th>Lth Color</th>
                                            <th>Fit Color</th>
                                            <th>Qnty</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Buy Ref</th>
<!--                                             <th>Remarks</th>
 -->                                            <!-- <th>Status</th> -->
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody style="white-space: nowrap;">

                                        </tbody>
                                    </table>
                                </div>

                                <div id="co_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_customer_order_details" method="post" action="<?=base_url('admin/form_add_customer_order_details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="am_id" class="control-label text-danger">Article *</label>
                                                    <select id="am_id" name="am_id" required class="select2 form-control round-input">
                                                        <option value="">Select Article</option>
                                                        <?php foreach($article_masters as $val) { ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['art_no']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="lc_id" class="control-label text-danger">Leather Colour *</label>
                                                    <select id="lc_id" name="lc_id" required class="select2 form-control round-input">
                                                        <option value="">Select Leather Colour</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="fc_id" class="control-label text-danger">Fittings Colour *</label>
                                                    <select id="fc_id" name="fc_id" required class="select2 form-control round-input">
                                                        <option value="">Select Fittings Colour</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="article_quantity" class="control-label text-danger">Article Quantity*</label>
                                                    <input type="number" id="article_quantity" name="article_quantity" class="form-control" />
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_rate" class="control-label text-danger">Article Rate *</label>
                                                    <input type="number" id="article_rate" name="article_rate" class="form-control" />
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_amount" class="control-label">Amount</label>
                                                    <input type="number" id="article_amount" readonly name="article_amount" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="buyer_reference" class="control-label">Buyer Reference </label>
                                                    <input type="text" id="buyer_reference" name="buyer_reference" class="form-control" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="article_remarks" class="control-label">Article Remarks </label>
                                                    <input type="text" id="article_remarks" name="article_remarks" class="form-control" />
                                                </div>
                                                <div class="col-lg-2">
                                                <label for="article_remarks" class="control-label">&nbsp;</label><br />
                                                <button class="btn btn-success" type="submit" id="detail_add"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="order_id" class="hidden" value="<?= $customer_order_details[0]->co_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="co_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_customer_order_details" method="post" action="<?=base_url('admin/form_edit_customer_order_details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="am_id_edit" class="control-label text-danger">Article *</label>
                                                    <select id="am_id_edit" name="am_id" required class="select2 form-control round-input">
                                                        <option value="">Select Article</option>
                                                        <?php foreach($article_masters as $val) { ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['art_no']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="lc_id_edit" class="control-label text-danger">Leather Colour *</label>
                                                    <select id="lc_id_edit" name="lc_id" required class="select2 form-control round-input">
                                                        <option value="">Select Leather Colour</option>
                                                        <?php foreach($colors_details as $cval) { ?>
                                                            <option value="<?=$cval['c_id']?>"><?=$cval['color']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="fc_id_edit" class="control-label text-danger">Fittings Colour *</label>
                                                    <select id="fc_id_edit" name="fc_id" required class="select2 form-control round-input">
                                                        <?php foreach($colors_details as $cval) { ?>
                                                            <option value="<?=$cval['c_id']?>"><?=$cval['color']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="article_quantity_edit" class="control-label text-danger">Article Quantity*</label>
                                                    <input type="number" id="article_quantity_edit" name="article_quantity" class="form-control" />
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_rate_edit" class="control-label text-danger">Article Rate *</label>
                                                    <input type="number" id="article_rate_edit" name="article_rate" class="form-control" />
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_amount_edit" class="control-label">Amount</label>
                                                    <input type="number" id="article_amount_edit" readonly name="article_amount" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="buyer_reference_edit" class="control-label">Buyer Reference </label>
                                                    <input type="text" id="buyer_reference_edit" name="buyer_reference" class="form-control" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="article_remarks_edit" class="control-label">Article Remarks </label>
                                                    <input type="text" id="article_remarks_edit" name="article_remarks" class="form-control" />
                                                </div>
                                                <div class="col-lg-2">
                                                <label for="article_remarks" class="control-label">&nbsp;</label><br />
                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="cod_id" name="order_details_id" class="hidden" value="" />
                                            <input type="hidden" name="order_id" class="hidden" value="<?= $customer_order_details[0]->co_id ?>" />
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </section>
                    
                    <section class="panel panel_last hide">
                        <header class="panel-heading">
                            Add customer order details for <?= $customer_order_details[0]->co_no ?> - <span class="add_artdtl"></span>
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
                                            <th>Article #</th>
                                            <th>Lth Color</th>
                                            <th>Fit Color</th>
                                            <th>Qnty</th>
                                            <th>Date</th>
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
                                        <form id="form_add_customer_order_brkup_details" method="post" action="<?=base_url('admin/form_add_customer_order_brkup_details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="article_brk_up_date" class="control-label text-danger"> Date * </label>
                                                    <input type="date" id="article_brk_up_date" name="article_brk_up_date" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_brk_up_quantity" class="control-label text-danger"> Article Quantity* </label>
                                                    <input type="number" id="article_brk_up_quantity" name="article_brk_up_quantity" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-4">
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
                                        <form id="form_edit_customer_order_details_brkup" method="post" action="<?=base_url('admin/form_edit_customer_order_details_brkup')?>" class="cmxform form-horizontal tasi-form">
                                                <div class="form-group ">
                                                    <div class="col-lg-4">
                                                    <label for="article_brk_up_date_edit" class="control-label text-danger"> Date * </label>
                                                    <input type="date" id="article_brk_up_date_edit" name="article_brk_up_date_edit" class="form-control" required/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_brk_up_quantity_edit" class="control-label text-danger"> Article Quantity* </label>
                                                    <input type="number" id="article_brk_up_quantity_edit" name="article_brk_up_quantity_edit" class="form-control"  required/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="article_brk_up_remarks_edit" class="control-label"> Remarks </label>
                                                    <input type="text" id="article_brk_up_remarks_edit" name="article_brk_up_remarks_edit" class="form-control" />
                                                </div>
                                            </div>

                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                            <input type="text" name="cod_brk_up_id_edit" class="cod_brk_up_id_edit hidden" value="">
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
                            Total:f
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body other-charges">                        
                            <label><strong>Total Amount</strong></label><br />
                            <div id="customer_order_total_amount" class="bg-dark text-center" style="padding: 2%">calculating...</div>
                            <hr />
                            <label><strong>Total Quantity</strong></label><br /> 
                            <div id="customer_order_total_quantity" class="bg-dark text-center" style="padding: 2%"><?= $customer_order_details[0]->co_total_quantity ?></div>
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

        //fetch article colours
        $("#am_id").on('change', function () {
            $am_id = $("#am_id").val();
            fetch_color($am_id, $lc_id='false');
            $('#article_rate').val('');
        });

        $("#lc_id").on('change', function () {
            $am_id = $("#am_id").val();
            $lc_id = $("#lc_id").val();
            $co_id = $("#customer_order_id").val();
            $ptype = $("#price_type").val();
            $.ajax({
                url: "<?= base_url('ajax-fetch-article-colour_new') ?>",
                method: "post",
                dataType: 'json',
                data: {'am_id': $am_id,'lc_id': $lc_id, 'co_id': $co_id},
                success: function(data){
                        // console.log(data);
                        
                        if(data != false) {
                        $("#fc_id").html("<option value=''>Select Fitting Colour</option>");
                        $.each(data, function (index, itemData) {
                                $str2 = '<option selected value="'+itemData.fitting_id +'">'+ itemData.fitting_color +' ['+ itemData.fitting_code +']' +'</option>';
                                $("#fc_id").append($str2);
                                $('#fc_id').select2().trigger('change');
                                $('#detail_add').prop('disabled', false);
                        });
                        fetch_rate($am_id, $ptype);
                    } else {
                        alert('already added....Select another colour');
                        $('#fc_id').html('');
                        $('#article_rate').val('');
                        $('#article_quantity').val('');
                        $('#detail_add').prop('disabled', true);
                        $("#lc_id").select2('open');
                    }
                },
            });
        });


// ADD - multiply for article_amount
        $("#article_quantity, #article_rate").on('change', function () {
            $article_quantity = $("#article_quantity").val();
            $article_rate = $("#article_rate").val();
            $("#article_amount").val(($article_quantity * $article_rate).toFixed(2));
        });
// EDIT - multiply for article_amount
        $("#article_quantity_edit, #article_rate_edit").on('change', function () {
            $article_quantity = $("#article_quantity_edit").val();
            $article_rate = $("#article_rate_edit").val();
            $("#article_amount_edit").val(($article_quantity * $article_rate).toFixed(2));
        });

        $('#co_details_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Customer Order PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Customer Order Excel',
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
                "url": "<?=base_url('ajax_customer_order_details_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    customer_order_id: function () {
                        return $("#customer_order_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "art_no" },
                { "data": "lc_id" },
                { "data": "fc_id" },
                { "data": "co_quantity" },
                { "data": "co_price" },
                { "data": "amount" },
                { "data": "co_buy_reference" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [0,1,2,3,4,5,6,7,8],
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
                "targets": 5, 
                "className": 'dtl_amount',  
            }],

            "initComplete": function( settings, json ) {
                // iter = 1;
                // var dtl_amount_sum = 0;
                // $('.dtl_amount').each(function(){
                //     if(iter++ == 1){return;}else{
                //         dtl_amount_sum += parseFloat($(this).text());
                //         // console.log(iter + '...' +dtl_amount_sum);
                //     }
                // });
                // // alert(dtl_amount_sum);
                // $('#customer_order_total_amount').text(dtl_amount_sum.toFixed(2));
                
                val = $("#customer_order_id").val();
                $.ajax({
            url: "<?= base_url('ajax_fetch_customer_order_details_total_value') ?>",
            method: "post",
            dataType: 'json',
            data: {'val': val},
            success: function(data){
                console.log(data);

                $('#customer_order_total_amount').text(data);
            },
        });

              }
        } );

       
    } );

    
    $("#form_edit_customer_order").validate({
        rules: {
            order_no: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax_unique_customer_order_no')?>",
                    type: "post",
                    data: {
                        customer_order_id: function () {
                            return $("#customer_order_id").val();
                        },
                        order_no: function () {
                            return $("#order_no").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_customer_order').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_customer_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            $("#customer_order_total_quantity").text(obj.custom_qnty)
        }
    });

    //add-customer order details-form validation and submit
    $("#form_add_customer_order_details").validate({
        rules: {
            article_quantity: {
                required: true,
            },
            article_rate: {
                required: true,
            },
            lc_id: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax_unique_co_no_and_art_no_and_lth_color')?>",
                    type: "post",
                    data: {
                        customer_order_id: function () {
                            return $("#customer_order_id").val();
                        },
                        lc_id: function () {
                            return $("#lc_id").val();
                        },
                        am_id: function () {
                            return $("#am_id").val();
                        },
                    },
                },
            }
        },
        messages: {

        }
    });
    $('#form_add_customer_order_details').ajaxForm({
        beforeSubmit: function () {
            $('#loading_div').show();
            $('#detail_add').prop( "disabled", true );
            return $("#form_add_customer_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            // console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            $('#loading_div').hide();
            $('#detail_add').prop( "disabled", false );

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);
            $customer_order_total_quantity = parseFloat(obj.total_qnty).toFixed(2);
            $("#customer_order_total_amount").html('<i>Please refresh the page</i>');
            $("#customer_order_total_quantity").text($customer_order_total_quantity);

            // $('#form_add_customer_order_details')[0].reset(); //reset form
            // $("#form_add_customer_order_details select").select2("val", ""); //reset all select2 fields
            // $('#form_add_customer_order_details :radio').iCheck('update'); //reset all iCheck fields
            // $("#form_add_customer_order_details").validate().resetForm(); //reset validation
            notification(obj);
            $("#article_quantity").val('');
            $("#article_amount").val('');
            $("#buyer_reference").val('');
            $("#article_remarks").val('');
            $("#lc_id").select2('open');
            //refresh table
            $('#co_details_table').DataTable().ajax.reload();
            
        }
    });

    //edit-customer order details-form validation and submit
    $("#form_edit_customer_order_details").validate({
        rules: {
            article_quantity: {
                required: true,
            },
            article_rate: {
                required: true,
            },
            // lc_id: {
            //     required: true,
            //     remote: {
            //         url: "< ?=base_url('admin/ajax_unique_co_no_and_art_no_and_lth_color')?>",
            //         type: "post",
            //         data: {
            //             customer_order_id: function () {
            //                 return $("#customer_order_id").val();
            //             },
            //             customer_order_detail_id: function () {
            //                 return $("#cod_id").val();
            //             },
            //             lc_id: function () {
            //                 return $("#lc_id_edit").val();
            //             },
            //             am_id: function () {
            //                 return $("#am_id_edit").val();
            //             },

            //         },
            //     },
            // }
        },
        messages: {
            
        }
    });

    $('#form_edit_customer_order_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_customer_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);
            $customer_order_total_quantity = parseFloat(obj.total_qnty).toFixed(2);
            $("#customer_order_total_amount").html('<i>Please refresh the page</i>');
            $("#customer_order_total_quantity").text($customer_order_total_quantity);

            $('#form_add_customer_order_details')[0].reset(); //reset form
            $("#form_add_customer_order_details").validate().resetForm(); //reset validation

            notification(obj);
            
            //refresh table
            $('#co_details_table').DataTable().ajax.reload();
            
        }
    });

    $('#form_add_customer_order_brkup_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_customer_order_brkup_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);

            // $('#form_add_customer_order_brkup_details')[0].reset(); //reset form
            $("#article_brk_up_date").val("");
            $("#article_brk_up_quantity").val("");
            $("#article_brk_up_remarks").val("");
            // $("#form_add_customer_order_brkup_details").validate().resetForm(); //reset validation

            notification(obj);
            
            //refresh table
            $('#co_brk_up_list_table').DataTable().ajax.reload();
            
        }
    });

    $('#form_edit_customer_order_details_brkup').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_customer_order_details_brkup").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            // $customer_order_total_amount = parseFloat(obj.total_amount).toFixed(2);
             $('#form_edit_customer_order_details_brkup')[0].reset(); //reset form
            $("#form_edit_customer_order_details_brkup").validate().resetForm(); //reset validation

            notification(obj);
            
            //refresh table
            $('#co_brk_up_list_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#co_details_table").on('click', '.customer_details_edit_btn', function() {
        $cod_id = $(this).attr('cod_id');

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_customer_order_details_on_pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'cod_id': $cod_id,},
            success: function(data){
                console.log(data);
                data = data[0];
                min_order_qnty = parseFloat(data.co_quantity);
                $("#am_id_edit").select2("val", data.am_id).change();
                $("#am_id_edit").select2("readonly", true);
                $("#lc_id_edit").select2("val", data.leather_id).change();
                $("#lc_id_edit").select2("readonly", true);
                $("#fc_id_edit").select2("val", data.fitting_id).change();
                $("#fc_id_edit").select2("readonly", true);
                
                $("#article_quantity_edit").val(data.co_quantity);
                if(data.cutting_status == 1) {
                $("#article_quantity_edit").attr('min',min_order_qnty); // if cutting issue is done then use should not be able to reduce the value so a minimum value is set
                }
                $("#article_rate_edit").val(data.co_price);
                $("#article_amount_edit").val((data.co_quantity * data.co_price).toFixed(2));
                $("#buyer_reference_edit").val(data.co_buy_reference);
                $("#article_remarks_edit").val(data.co_remarks).change();
                // if(data.status == '1'){$("#enable3").iCheck('check');} else if(data.status == '0'){$("#disable3").iCheck('check');}

                $("#cod_id").val($cod_id);
                $('#co_details_edit_tab').removeClass('disabled');
                $('#co_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#co_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#co_details_edit"]').tab('show');
            },
        });
    });

    $("#co_brk_up_list_table").on('click', '.customer_details_brkup_edit_btn', function() {
        $id = $(this).attr('id');

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_customer_order_details_brkup_edit') ?>",
            method: "post",
            dataType: 'json',
            data: {'id': $id,},
            success: function(data){
                console.log(data);
                data = data[0];

                $("#article_brk_up_quantity_edit").val(data.co_quantity);
                $("#article_brk_up_date_edit").val(data.ord_date);
                $("#article_brk_up_date").val(data.remarks);

                $(".cod_brk_up_id_edit").val(data.cod_id);
                $(".order_id_brkup").val(data.id);
                $('#co_details_brk_up_edit_tab').removeClass('disabled');
                $('#co_details_brk_up_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#co_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#co_details_brk_up_edit"]').tab('show');
            },
        });
    });

    //Break up history add button
    $("#co_details_table").on('click', '.brk_up_history', function() {
        $('.cod_brk_up_id').val($(this).attr('cod_id'));
        $('#co_brk_up_list_table').DataTable().destroy();
        $cod_id = $(this).attr('cod_id');
        $('#form_add_customer_order_brkup_details')[0].reset(); //reset form
        $("#form_add_customer_order_brkup_details").validate().resetForm(); //reset validation
         $('#form_edit_customer_order_details_brkup')[0].reset(); //reset form
        $("#form_edit_customer_order_details_brkup").validate().resetForm(); //reset validation
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
                    title: 'Customer Order PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Customer Order Excel',
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
                "url": "<?=base_url('admin/ajax_fetch_customer_order_breakup_details_on_pk')?>",
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
                { "data": "fc_id" },
                { "data": "co_quantity" },
                { "data": "ord_date" },
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
        $(".add_artdtl").html($(this).parent("td").prev().prev().prev().prev().prev().prev().prev().text()+" - "+$(this).parent("td").prev().prev().prev().prev().prev().prev().text());
        $(this).parent("td").parent("tr").addClass("add_bgclr");
        $("#co_details_table tbody tr").not($(this).parent("td").parent("tr")).removeClass("add_bgclr");
        $('html, body').animate({
        scrollTop: $(".panel_last").offset().top
    }, 1000);
    });

    $("#article_brk_up_quantity, #article_brk_up_quantity_edit").on('change', function () {
        var val = $(this).val();
        $cod_id = $(".cod_brk_up_id").val();
        $this = $(this);

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_customer_order_details_brkup_qnty') ?>",
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
        if(confirm("Are You Sure? This Process Can\'t be Undone.")){
            $pk = $(this).attr('data-pk');
            $tab = $(this).attr('data-tab');
            $header_id = $("#customer_order_id").val();
            $proforma_status = $(this).attr('proforma_status');

            $.ajax({
                url: "<?= base_url('admin/del-row-on-table-pk-customer-order/') ?>",
                dataType: 'json',
                type: 'POST',
                data: {pk: $pk, tab : $tab, co_id: $header_id, proforma_status: $proforma_status},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);

                    // $customer_order_total_amount = parseFloat(returnData.total_amount).toFixed(2);

                    if($tab != 'cust_order_brk_up') {
                    $customer_order_total_quantity = parseFloat(returnData.total_qnty).toFixed(2);
                    $("#customer_order_total_amount").html('<i>Please refresh the page</i>');
                    $("#customer_order_total_quantity").text($customer_order_total_quantity);
                    
                    //refresh table
                    $("#co_details_table").DataTable().ajax.reload();
                } else {
                    $("#co_brk_up_list_table").DataTable().ajax.reload();
                }

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

    function fetch_color($am_id, $lc_id){
        $.ajax({
                url: "<?= base_url('ajax-fetch-article-colours') ?>",
                method: "post",
                dataType: 'json',
                data: {'am_id': $am_id,'lc_id': $lc_id},
                success: function(data){
                        // console.log(data);
                        if($lc_id == 'false'){
                            $("#lc_id").html("<option value=''>Select Leather Colour</option>");
                        }
                        $("#fc_id").html("<option value=''>Select Fitting Colour</option>");
                        $.each(data, function (index, itemData) {
                            if($lc_id == 'false'){
                                $str1 = '<option value="'+itemData.leather_id +'">'+ itemData.leather_color +' ['+ itemData.leather_code +']' +'</option>';
                                $("#lc_id").append($str1);
                                // $str2 = '<option value="'+itemData.fitting_id +'">'+ itemData.fitting_color +' ['+ itemData.fitting_code +']' +'</option>';
                                // $("#fc_id").append($str2);
                            }else{
                                $str2 = '<option selected value="'+itemData.fitting_id +'">'+ itemData.fitting_color +' ['+ itemData.fitting_code +']' +'</option>';
                                $("#fc_id").append($str2);
                                $('#fc_id').select2().trigger('change');
                            }
                        });
                        if($lc_id == 'false'){
                            $("#lc_id").select2('open');
                        }
                },
            });
    }

    function fetch_rate($am_id, $ptype){
        $.ajax({
                url: "<?= base_url('ajax-fetch-article-rate-on-type') ?>",
                method: "post",
                dataType: 'json',
                data: {'am_id': $am_id,'ptype': $ptype},
                success: function(data){
                    // console.log(data);
                    if(data == 0){
                        // alert('No rate found for this article. Using 0.00 as reference.');
                        $("#article_rate").val('0.00');   
                    }else{
                        $("#article_rate").val(data);   
                    }
                },
                error: function(e){
                    console.log(e);
                }
            });
    }

</script>

</body>
</html>
