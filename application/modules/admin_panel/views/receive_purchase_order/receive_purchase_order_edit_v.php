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
    <title>Edit Receive Purchase Order | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Purchase Order">

     <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

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

        .hide {
            display: none;
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
            <h3 class="m-b-less">Edit Receive Purchase Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Receive Purchase Order </li>
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
                            Edit <?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-edit-receive-purchase-order')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                	<div class="col-lg-6">
                                    <label for="purchase_order_receive_bill_no" class="control-label text-danger">Purchase Bill Number *</label>
                                    <input id="purchase_order_receive_bill_no" name="purchase_order_receive_bill_no" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>" type="text" placeholder="Purchase Receive Number" class="form-control round-input" />
                                    
                                    </div>
                                    <?php 
									//echo $receive_purchase_order_details[0]->purchase_order_receive_date;
									?>
                                    <div class="col-lg-6">
                                        <label for="purchase_order_receive_date" class="control-label text-danger">Purchase Bill Date *</label>
                                        <input id="purchase_order_receive_date" name="purchase_order_receive_date" value="<?php echo date('Y-m-d', strtotime($receive_purchase_order_details[0]->purchase_order_receive_date)); ?>" type="date" placeholder="Purchase Receive Date" class="form-control round-input" />
                                    </div>                                    
                                    <div class="col-lg-6">
                                        <label for="am_id_add" class="control-label text-danger">Select Supplier *</label>
                                        <input type="hidden" id="am_id_hidden" name="am_id_hidden" value="<?=$receive_purchase_order_details[0]->am_id?>"><br>

<label value="<?=$receive_purchase_order_details[0]->am_id?>"><strong><?=$receive_purchase_order_details[0]->acc_master_name?></strong></label>
                                        <!--<select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Supplier</option>
                                                <?php
                                                /*foreach($buyer_details as $bd){
                                                    $sn = ($bd->short_name == '' ? '-' : $bd->short_name);*/
                                                ?> 
                                                    <option value="<?php//echo $bd->am_id; ?>" <?php //if($receive_purchase_order_details[0]->am_id == $bd->am_id){ ?> selected <?php //} ?>><?php //echo $bd->name . ' ['. $sn .']' ?></option>
                                                    <?php
                                                //}
                                                ?>
                                        </select>-->
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" <?= ($receive_purchase_order_details[0]->status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" <?= ($receive_purchase_order_details[0]->status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Receive Purchase Order</i></button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div> 
                                <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                
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
                        <form id="form_edit_delivery_sgst_cgst_value" method="post" action="<?=base_url('admin/form-edit-delivery-sgst-cgst-value')?>" class="cmxform form-horizontal tasi-form">
                        
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="total_amount" class="control-label">Total Value</label>
                                <input id="total_amount" name="total_amount" value="<?= $receive_purchase_order_details[0]->total_amount ?>" type="text" placeholder="Total Value" class="form-control" readonly />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="delivery_charge" class="control-label">Delivery Charge</label>
                                <input id="delivery_charge" name="delivery_charge" value="<?= $receive_purchase_order_details[0]->delivery_charge ?>" type="text" placeholder="Delivery Charge" class="form-control" />
                                </div>
                        	</div>
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="sgst_percent" class="control-label">SGST(in %)</label>
                                <input id="sgst_percent" name="sgst_percent" value="<?= $receive_purchase_order_details[0]->sgst_percent ?>" type="text" placeholder="SGST" class="form-control" />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="cgst_percent" class="control-label">CGST(in %)</label>
                                <input id="cgst_percent" name="cgst_percent" value="<?= $receive_purchase_order_details[0]->cgst_percent ?>" type="text" placeholder="CGST" class="form-control" />
                                </div>
                        	</div>
                            <div class="form-group ">
                                <div class="col-lg-6">
                                <label for="delivery_sgst_cgst_amount" class="control-label">Amount</label>
                                <input id="delivery_sgst_cgst_amount" name="delivery_sgst_cgst_amount" value="<?= $receive_purchase_order_details[0]->delivery_sgst_cgst_amount ?>" type="text" placeholder="Amount" class="form-control" readonly />
                                </div>
                                
                                <div class="col-lg-6">
                                <label for="net_amount" class="control-label">Net Amount</label>
                                <input id="net_amount" name="net_amount" value="<?= round($receive_purchase_order_details[0]->net_amount) ?>" type="text" placeholder="Net Amount" class="form-control" readonly />
                                </div>
                        	</div>
                            
                            <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-2">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update</i></button>
                                    </div>
                                    <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                </div> 
                            
                        </form>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Receive purchase order details for <?= $receive_purchase_order_details[0]->purchase_order_receive_bill_no ?>
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
                                                <th>Po. Num.</th>
                                                <th>Supp. Po. Num.</th>
                                                <th>Item Name</th>
                                                <th>Color</th>
                                                <th>Qnty</th>
                                                <th>Rate</th>
                                                <th>Total</th>
                                                <th>Rcv. Dt.</th>
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
                                        <form id="form_add_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-add-receive-purchase-order-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="po_id" class="control-label text-danger">Purchase Order </label>
                                                    <select id="po_id" name="po_id" class="select2 form-control round-input">
                                                        <option value="">Select Purchase Order</option>
                                                        <?php foreach($purchase_order as $val) { ?>
                                                            <option value="<?=$val['po_id']?>"> <?=$val['po_number'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="rcv_date_detail" class="control-label text-danger">Receive Date*</label>
                                                    <input type="date" id="rcv_date_detail" name="rcv_date_detail" value="<?php echo date('Y-m-d', strtotime($receive_purchase_order_details[0]->purchase_order_receive_date)); ?>" class="form-control" />
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <label for="sup_id" class="control-label text-danger">Supp.Purchase Order</label>
                                                    <select id="sup_id" name="sup_id" class="select2 form-control round-input">
                                                        <option value="">Select Supp.Purchase Order</option>
                                                        <?php foreach($supp_purchase_order as $val) { ?>
                                                            <option value="<?=$val['sup_id']?>"><?=$val['supp_po_number']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                
                                            </div>
                                            <div class="form-group">
                                             <div class="col-lg-4">
                                                    <label for="id_id" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_add" name="id_id_add" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="color" class="control-label text-danger">Colour *</label>
                                                    <input type="text" id="color_add" name="color_add" required class="form-control" readonly />
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_add"></label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="pod_quantity" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity_add" name="pod_quantity_add" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="pod_quantity_add_hidden" name="pod_quantity_add_hidden" required class="form-control" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="pod_rate" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate_add" name="pod_rate_add" required class="form-control" />
                                                    <input type="hidden" id="pod_rate_add_hide" name="pod_rate_add_hide" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label for="pod_total" class="control-label">Total</label>
                                                    <input type="number" step="0.01" id="pod_total_add" name="pod_total_add" required class="form-control" readonly />
                                                </div>
                                            <div class="col-lg-5">
                                                    <label for="pod_remarks" class="control-label">Remarks</label>
                                                    <input type="text" id="sup_pod_remarks" name="sup_pod_remarks" class="form-control" />
                                                </div>
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button type="submit" id="btn-show-content" class="btn btn-info addon-btn m-b-10"> Add Details </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="purchase_order_receive_id" id="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="po_details_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_receive_purchase_order_details" method="post" action="<?=base_url('admin/form-edit-receive-purchase-order-details')?>" class="cmxform form-horizontal tasi-form">
                                           <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="po_id_edit" class="control-label text-danger">Purchase Order </label>
                                                    <select id="po_id_edit" name="po_id_edit" class="select2 form-control round-input">
                                                        <option value="">Select Purchase Order</option>
                                                        
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <label for="sup_id_edit" class="control-label text-danger">Supp.Purchase Order</label>
                                                    <select id="sup_id_edit" name="sup_id_edit" class="select2 form-control round-input">
                                                        <option value="">Select Supp.Purchase Order</option>
                                                        
                                                    </select>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="id_id_edit" class="control-label text-danger">Item *</label>
                                                    <select id="id_id_edit" name="id_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>
                                            </div>
                                           <div class="form-group">

                                                <div class="col-lg-3">
                                                    <label for="color_edit" class="control-label text-danger">Colour *</label>
                                                    <input type="text" id="color_edit" name="color_edit" required class="form-control" readonly />
                                                </div>

                                                <div class="col-lg-1  border-black-bottom">
                                                    <label for="pod_unit_edit" class="control-label">Unit</label><br />
                                                    <label id="pod_unit_edit"></label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_quantity_edit" class="control-label text-danger">Quantity *</label>
                                                    <input type="number" step="0.01" id="pod_quantity_edit" name="pod_quantity_edit" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="pod_quantity_edit_hidden" name="pod_quantity_edit_hidden" required class="form-control" />
                                                    <input type="hidden" step="0.01" id="remain_item_quantity" name="remain_item_quantity" required class="form-control" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pod_rate_edit" class="control-label text-danger">Rate *</label>
                                                    <input type="number" step="0.01" id="pod_rate_edit" name="pod_rate_edit" required class="form-control" />
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="pod_total_edit" class="control-label">Total</label>
                                                    <input type="number" step="0.01" id="pod_total_edit" name="pod_total_edit" required class="form-control" readonly />
                                                    <input type="hidden" step="0.01" id="pod_total_old" name="pod_total_old" required class="form-control" readonly />
                                                </div>
                                            </div>
                                           <div class="form-group">
                                            <div class="col-lg-4">
                                                    <label for="rcv_date_detail_edit" class="control-label">Receive Date</label>
                                                    <input type="date" id="rcv_date_detail_edit" name="rcv_date_detail_edit" class="form-control" />
                                                </div>
                                            <div class="col-lg-5">
                                                    <label for="sup_pod_remarks_edit" class="control-label">Remarks</label>
                                                    <input type="text" id="sup_pod_remarks_edit" name="sup_pod_remarks_edit" class="form-control" />
                                                </div>
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                    
                                                    <input type="hidden" id="purchase_order_receive_id" name="purchase_order_receive_id" class="hidden" value="<?= $receive_purchase_order_details[0]->purchase_order_receive_id ?>" />
                                            		<input type="hidden" name="purchase_order_receive_detail_id" id="purchase_order_receive_detail_id" class="hidden" value="" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

                    </section>

                    <section class="panel panel_last hide">
                        <header class="panel-heading">
                            Item Rate of (<span style="font-size: 18px;font-weight: bold;color: #ffffff;text-shadow: 2px 2px 3px #000000" class="item_color_rate_header"></span>)
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>

                        <div class="panel-body1">
                            <!--Tabs-->
                            <ul id="item_rate_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#rate_list" data-toggle="tab">List</a></li>
                                <li id="rate_add_tab"><a href="#rate_add" data-toggle="tab">Add</a></li>
                                <li id="rate_edit_tab" class="disabled"><a href="#rate_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="rate_list" class="tab-pane fade in active">
                                    <table id="item_color_rate_table" class="table data-table dataTable" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Purchase Rate</th>
                                            <th>Cost Rate</th>
                                            <th>Plating Rate</th>
                                            <th>GST (%)</th>
                                            <th>Effective Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="rate_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_item_color_rate" method="post" action="<?=base_url('admin/form_add_item_color_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">

                                                <label for="eff_date" class="control-label col-lg-2 text-danger">Effective Date *</label>
                                                <div class="col-lg-2">
                                                    <input id="eff_date" name="eff_date" type="date" value="<?= date('Y-m') ?>-01" max="<?= date('Y-m-d') ?>" required class="form-control round-input" />
                                                </div>

                                                <label for="pur_rate" class="control-label col-lg-2 text-danger">Purchase Rate *</label>
                                                <div class="col-lg-2">
                                                    <input id="pur_rate" name="pur_rate" type="number" min="0" placeholder="Purchase rate" required class="form-control round-input" />
                                                </div>

                                                <label for="cost_rate" class="control-label col-lg-2 text-danger">Cost Rate *</label>
                                                <div class="col-lg-2">
                                                    <input id="cost_rate" name="cost_rate" type="number" min="0" placeholder="Cost rate" required class="form-control round-input" />
                                                </div>
                                                
                                            </div>

                                            <div class="form-group ">
                                                <label for="plating_rate_add1" class="control-label col-lg-2">Plating Rate</label>
                                                <div class="col-lg-3">
                                                    <input id="plating_rate_add1" name="plating_rate_add1" type="number" min="0" placeholder="Plating rate" required class="form-control round-input" />
                                                </div>
                                            <label for="gst" class="control-label col-lg-1 text-danger">GST (%) *</label>
                                                <div class="col-lg-3">
                                                    <input id="gst" name="gst" type="number" min="0" placeholder="GST percentage" required class="form-control round-input" />
                                                </div>

                                            </div>

                                            <div class="form-group ">

                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable4" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable4" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable4" value="0" required class="iCheck-square-red">
                                                    <label for="disable4" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="item_dtl_id" id="item_dtl_id" class="item_dtl_id" value="">
                                            <input type="hidden" name="supplier" id="supplier" class="supplier" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Item Color Rate</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="rate_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_item_color_rate" method="post" action="<?=base_url('admin/form_edit_item_color_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">

                                                <label for="eff_date2" class="control-label col-lg-2 text-danger">Effective Date *</label>
                                                <div class="col-lg-2">
                                                    <input id="eff_date2" name="eff_date" type="date" max="<?= date('Y-m-d') ?>" required class="form-control round-input" />
                                                </div>

                                                <label for="pur_rate2" class="control-label col-lg-2 text-danger">Purchase Rate *</label>
                                                <div class="col-lg-2">
                                                    <input id="pur_rate2" name="pur_rate" type="number" min="0" placeholder="Purchase rate" required class="form-control round-input" />
                                                </div>

                                                <label for="cost_rate2" class="control-label col-lg-2 text-danger">Cost Rate *</label>
                                                <div class="col-lg-2">
                                                    <input id="cost_rate2" name="cost_rate" type="number" min="0" placeholder="Cost rate" required class="form-control round-input" />
                                                </div>
                                                
                                            </div>

                                            <div class="form-group ">
                                                <label for="plating_rate_edit1" class="control-label col-lg-2">Plating Rate</label>
                                                <div class="col-lg-3">
                                                    <input id="plating_rate_edit1" name="plating_rate_edit1" type="number" min="0" placeholder="Plating rate" class="form-control round-input" />
                                                </div>

                                                <label for="gst2" class="control-label col-lg-2 text-danger">GST (%) *</label>
                                                <div class="col-lg-3">
                                                    <input id="gst2" name="gst" type="number" min="0" placeholder="GST percentage" required class="form-control round-input" />
                                                </div>

                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable5" value="1" required class="iCheck-square-green">
                                                    <label for="enable5" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable5" value="0" required class="iCheck-square-red">
                                                    <label for="disable5" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="item_rate_id" name="item_rate_id" value="">
                                            <input type="hidden" name="supplier2" id="supplier2" class="supplier2" value="">
                                            <input type="hidden" name="supplier" id="supplier" class="supplier" value="">
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Item Color Rate</button>
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

<!--confirmation-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
    
    $(document).ready(function() {
        $('#supp_po_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-receive-purchase-order-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    purchase_order_receive_id: function () {
                        return $("#purchase_order_receive_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "po_number" },
                { "data": "sup_po_number" },
                { "data": "item_name" },
                { "data": "item_color" },
                { "data": "item_qty" },
                { "data": "item_rate" },
                { "data": "total_amount" },
                { "data": "receive_date" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,8],
                "orderable": false,
            }]
        } );  
    });

    //allot reg_no confirmation

    $("#po_id").change(function(){
        $po_id = $(this).val();
		$am_id_hidden = $('#am_id_hidden').val();
		
		console.log('po_id: '+$po_id);
		if($po_id != '' || $po_id > 0){
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-purchase-order') ?>",
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
                // $('#sup_id').select2('open');
				
				var all_items = result.all_items;				
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' pod_quantity=' + item.pod_quantity + ' pod_rate=' + item.pod_rate + ' pod_total='+ item.pod_total + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
               $('#id_id_add').select2('open');
				
				
				
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
            $('#pod_rate_add_hide').val('');
			$('#pod_total_add').val('');
		}
    });
	
	$("#sup_id").change(function(){
        $sup_id = $(this).val();
		console.log('sup_id: '+$sup_id);
		
		if($sup_id != '' || $sup_id > 0){
        	$.ajax({
            url: "<?= base_url('admin/all-items-on-supp-purchase-order') ?>",
            method: "post",
            dataType: 'json',
            data: {'sup_id': $sup_id,},
            success: function(all_items){
                console.log(JSON.stringify(all_items));
				
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' pod_quantity=' + item.pod_quantity + ' pod_rate=' + item.pod_rate + ' pod_total='+ item.pod_total + ' unit=' + item.unit + ' color=' + item.color + '>  '+ item.item_name + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
                $('#id_id_add').select2('open');
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
            $('#pod_rate_add_hide').val('');
			$('#pod_total_add').val('');
		}
    });
	
	$(document).on('change', '#id_id_add', function(){
		$id_id_add = $(this).val();
        $am_id = $("#am_id_hidden").val();
        $(".panel_last").addClass("hide");
		$po_id = $('#po_id').val();
        $sup_id = $("#sup_id").val();
		
		$pod_quantity = $('option:selected', this).attr('pod_quantity');
		$pod_rate = $('option:selected', this).attr('pod_rate');
		$pod_total = $('option:selected', this).attr('pod_total');
		$unit = $('option:selected', this).attr('unit');
		$color = $('option:selected', this).attr('color');
		$purchase_date = $("#purchase_order_receive_date").val();
        // alert($pod_quantity);
		
		$.ajax({
            url: "<?= base_url('admin/ajax-get-remaining-item-quantity') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id_add': $id_id_add, 'po_id': $po_id, 'sup_id': $sup_id},
            success: function(response){
                console.log(JSON.stringify(response));
                $received_quantity = parseFloat(response);
				$remain_qty = parseFloat($pod_quantity) - parseFloat($received_quantity);
				if(parseFloat($remain_qty) > 0){
					$('#color_add').val($color);
					$("#pod_unit_add").html("<b>" +$unit+ '</b>');
					$('#pod_quantity_add').val($remain_qty);
					$('#pod_quantity_add_hidden').val($remain_qty);
					 


            $.ajax({
            url: "<?= base_url('admin/fetch-cost-rate-wrt-item') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_id': $id_id_add, 'supplier_id': $am_id, 'purchase_date': $purchase_date},
            success: function(cost_rate){
                $('#pod_rate_add').val(cost_rate);
                $('#pod_rate_add_hide').val(cost_rate);
                $pod_rate_new = cost_rate;
                    $pod_total_n = ($remain_qty * $pod_rate_new).toFixed(2);
                    $('#pod_total_add').val($pod_total_n);
            },
            error: function(e){console.log(e);}
        });



				}else{
					alert('All Items received');
					$('#color_add').val('');
					$("#pod_unit_add").html('');
					$('#pod_quantity_add').val('');
					$('#pod_quantity_add_hidden').val('');
					$('#pod_rate_add').val('');
                    $('#pod_rate_add_hide').val('');
					$('#pod_total_add').val('');
				}
            },
            error: function(e){console.log(e);}
        });

		console.log('pod_rate:'+$pod_rate);
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
            id_id_add: {
                required: true,
            },
            pod_quantity_add: {
                required: true,
            },
            pod_rate_add: {    
                required: true,
            },
            pod_total_add: {
                required: true,
            },
            rcv_date_detail: {
                required: true,
            }
        },
        messages: {

        }
    });

    $('#form_add_receive_purchase_order_details').ajaxForm({

        beforeSubmit: function () {

if($("#pod_rate_add").val() == $("#pod_rate_add_hide").val()) {

return $("#form_add_receive_purchase_order_details").valid(); // TRUE when form is valid, FALSE will cancel submit

} else {

// e.preventDefault();

$.confirm({
    title: 'Rates Mismatch!',
    content: 'Item rate are not matching with master rates !!!!',
    buttons: {
        confirm: function () {
            
           $('#form_add_receive_purchase_order_details').ajaxForm({

        beforeSubmit: function () {
        return $("#form_add_receive_purchase_order_details").valid(); 
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            
            $line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
            
            $delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
            
            $net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);
            // alert(obj.po_id);
            // $("#po_id").select2("val", "");
            // $("#sup_id").select2("val", "");
            $("#id_id_add").select2("val", "");
            $("#color_add").val('');
            $("#pod_quantity_add").val('');
            $("#pod_rate_add").val('');
            $("#pod_rate_add_hide").val('');
            $("#pod_total_add").val('');
            $("#sup_pod_remarks").val('');
            
            // $("#form_add_receive_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });

           $('#btn-show-content').trigger('click');

        },
        cancel: function () {
            $.alert('Canceled!');
        },
        somethingElse: {
            text: 'Update Master',
            btnClass: 'btn-blue',
            keys: ['enter', 'shift'],
            action: function(){
                $("#item_dtl_id").val($("#id_id_add").val());
                $("#supplier").val($("#am_id_hidden").val());
                $('#item_color_rate_table').DataTable().destroy();
                $("#item_id").val($("#id_id_add").val());
                $(".item_color_rate_header").html($("#id_id_add").text());
                $('#item_color_rate_table').DataTable({
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_item_color_rate_table_data_new')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    item_dtl_id: function () {
                        return $id_id_add;
                    },
                    am_id_hidden: function () {
                        return $("#am_id_hidden").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "name" },
                { "data": "purchase_rate" },
                { "data": "cost_rate" },
                { "data": "plating_rate" },
                { "data": "gst_percentage" },
                { "data": "effective_date" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6], //disable 'Actions' column sorting
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
            }]
        });
                $(".panel_last").removeClass("hide");
                $('html, body').animate({
        scrollTop: $(".panel_last").offset().top
    }, 1000);
            }
        }
    }
});

return false;

}
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			
			$line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);
            // alert(obj.po_id);
            // $("#po_id").select2("val", "");
            // $("#sup_id").select2("val", "");
            $("#id_id_add").select2("val", "");
            $("#color_add").val('');
            $("#pod_quantity_add").val('');
            $("#pod_rate_add").val('');
            $("#pod_rate_add_hide").val('');
            $("#pod_total_add").val('');
            $("#sup_pod_remarks").val('');
			
            // $("#form_add_receive_purchase_order_details").validate().resetForm(); //reset validation
            notification(obj);
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });




    //item-rate edit button
    $("#item_color_rate_table").on('click', '.item_rate_edit_btn', function() {
        item_rate_id = $(this).attr('item_rate_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_item_rate') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_rate_id':item_rate_id,},
            success: function(data){
                $("#item_rate_id").val(data.ir_id);
                $(".supplier2").val(data.am_id);
                $(".supplier").val(data.am_id);
                $("#gst2").val(data.gst_percentage);
                $("#pur_rate2").val(data.purchase_rate);
                $("#cost_rate2").val(data.cost_rate);
                $("#plating_rate_edit1").val(data.plating_rate);
                $("#eff_date2").val(data.effective_date);
                if(data.status == '1'){$("#enable5").iCheck('check');} else if(data.status == '0'){$("#disable5").iCheck('check');}

                $('#rate_edit_tab').removeClass('disabled');
                $('#rate_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#item_rate_tabs li:eq(2) a').tab('show');
            },
        });
    });

    $("#form_add_item_color_rate").validate({
        rules: {
            eff_date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_supp_item_color_rate_eff_date')?>",
                    type: "post",
                    data: {
                        item_dtl_id: function () {
                            return $("#item_dtl_id").val();
                        },
                        supplier: function () {
                            return $("#supplier").val();
                        },
                        item_rate_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_item_color_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_item_color_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_item_color_rate')[0].reset(); //reset form
            $("#form_add_item_color_rate select").select2("val", ""); //reset all select2 fields
            $('#form_add_item_color_rate :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item_color_rate").validate().resetForm(); //reset validation
            $("#id_id_add").select2("val", "");
            $("#id_id_add").select2("open");
            $("#color_add").val('');
            $("#pod_quantity_add").val('');
            $("#pod_rate_add").val('');
            $("#pod_total_add").val('');
            $("#sup_pod_remarks").val('');
            notification(obj);

            //refresh table
            $('#item_color_rate_table').DataTable().ajax.reload();
        }
    });

    $("#form_edit_item_color_rate").validate({
        rules: {
            eff_date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_supp_item_color_rate_eff_date')?>",
                    type: "post",
                    data: {
                        item_dtl_id: function () {
                            return $("#item_dtl_id").val();
                        },
                        supplier: function () {
                            return $("#supplier2").val();
                        },
                        item_rate_id: function () {
                            return $("#item_rate_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_item_color_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item_color_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#item_color_rate_table').DataTable().ajax.reload();
            $("#id_id_add").select2("val", "");
            $("#id_id_add").select2("open");
            $("#color_add").val('');
            $("#pod_quantity_add").val('');
            $("#pod_rate_add").val('');
            $("#pod_total_add").val('');
            $("#sup_pod_remarks").val('');
        }
    });
	
	//Receive purchase order detail edit button
    $("#supp_po_details_table").on('click', '.purchase_order_receive_detail_id', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $purchase_order_receive_detail_id = $(this).attr('purchase_order_receive_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-receive-purchase-order-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'purchase_order_receive_detail_id': $purchase_order_receive_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
				
				$oreder_receive_details = result.oreder_receive_details;
				$remain_item_quantity = result.remain_item_quantity;
				
                /*data = pod_data[0];*/
                
                $("#po_id_edit").html("<option>"+$oreder_receive_details.po_number+"</option>").trigger('change');
                $("#sup_id_edit").html("<option>"+$oreder_receive_details.supp_po_number+"</option>").trigger('change');
                $("#id_id_edit").html("<option>"+$oreder_receive_details.item+"</option>").trigger('change');
                $("#pod_unit_edit").html('<b>'+$oreder_receive_details.unit+'</b>');
                $("#color_edit").val($oreder_receive_details.color);
                $("#pod_quantity_edit").val($oreder_receive_details.item_quantity);
				$("#pod_quantity_edit_hidden").val($oreder_receive_details.item_quantity);
				$("#remain_item_quantity").val($remain_item_quantity);
				$("#pod_rate_edit").val($oreder_receive_details.item_rate);
                $("#pod_total_edit").val(Number($oreder_receive_details.pod_total).toFixed(2));
				$("#pod_total_old").val(Number($oreder_receive_details.pod_total).toFixed(2));
                $("#sup_pod_remarks_edit").val($oreder_receive_details.remarks);
                $("#purchase_order_receive_detail_id").val($oreder_receive_details.purchase_order_receive_detail_id);
                $("#rcv_date_detail_edit").val($oreder_receive_details.receive_date);

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
            pod_quantity_edit: {
                required: true,
            },
            pod_rate_edit: {
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
			
			$line_items = obj.line_items;
            $total_amount = parseFloat($line_items.total_amount).toFixed(2);
            $("#total_amount").val($total_amount);
			
			$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
            $("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
			
			$net_amount = parseFloat($line_items.net_amount).toFixed(2);
            $("#net_amount").val($net_amount);
			
            //refresh table
            $('#supp_po_details_table').DataTable().ajax.reload();
            
        }
    });
	
	//form_edit_delivery_sgst_cgst_value
	$("#form_edit_delivery_sgst_cgst_value").validate({
        rules: {
            total_amount: {
                required: true,
            },
            delivery_charge: {
                required: true,
            },
            sgst_percent: {    
                required: true,
            },
            cgst_percent: {
                required: true,
            },
            delivery_sgst_cgst_amount: {
                required: true,
            },
            net_amount: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_edit_delivery_sgst_cgst_value').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_delivery_sgst_cgst_value").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            notification(obj);            
        }
    });
	
	//Calculation for CGST SGST
    $("#total_amount, #delivery_charge, #sgst_percent, #cgst_percent, #delivery_sgst_cgst_amount, #net_amount").on('blur', function () {
        $total_amount = $("#total_amount").val();
        $delivery_charge = $("#delivery_charge").val();
		$sgst_percent = $("#sgst_percent").val();
		$cgst_percent = $("#cgst_percent").val();

        $total_amount_new = parseFloat($total_amount) + parseFloat($delivery_charge);
		$sgst_percent_amount = (($total_amount_new * $sgst_percent)/100);
		$cgst_percent_amount = (($total_amount_new * $cgst_percent)/100);
		$delivery_sgst_cgst_amount = parseFloat($sgst_percent_amount) + parseFloat($cgst_percent_amount);
		$net_amount = Math.round(parseFloat($delivery_sgst_cgst_amount) + parseFloat($total_amount_new));
		
		$("#delivery_sgst_cgst_amount").val(($delivery_sgst_cgst_amount).toFixed(2));
        $("#net_amount").val($net_amount);
		
		console.log('total_amount: '+$total_amount+' delivery_charge: '+$delivery_charge+' sgst_percent: '+$sgst_percent+' cgst_percent: '+$cgst_percent+' sgst_percent_amount: '+$sgst_percent_amount+' cgst_percent_amount: '+$cgst_percent_amount+' delivery_sgst_cgst_amount: '+$delivery_sgst_cgst_amount+' net_amount: '+$net_amount);
    });
	
	// delete area 
	$(document).on('click', '.delete1', function(){
        $this = $(this);
        if(confirm("Are You Sure?")){
			$tab = $(this).attr('tab');
			$tab_pk = $(this).attr('tab-pk');
			$data_pk = $(this).attr('data-pk');
			
			$reference_tab = $(this).attr('reference-tab');
			$reference_pk = $(this).attr('reference-pk');
			$reference_data_pk = $(this).attr('reference-data-pk');
			$pod_total_add = $(this).attr('pod-total-add');

            $.ajax({
                url: "<?= base_url('admin/del-receive-purchase-order-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, reference_tab: $reference_tab, reference_pk: $reference_pk, reference_data_pk: $reference_data_pk, pod_total_add: $pod_total_add},
                success: function (returnData) {
                    console.log(JSON.stringify(returnData));
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
					
					$line_items = returnData.line_items;
					$total_amount = parseFloat($line_items.total_amount).toFixed(2);
					$("#total_amount").val($total_amount);
					
					$delivery_sgst_cgst_amount = parseFloat($line_items.delivery_sgst_cgst_amount).toFixed(2);
					$("#delivery_sgst_cgst_amount").val($delivery_sgst_cgst_amount);
					
					$net_amount = parseFloat($line_items.net_amount).toFixed(2);
					$("#net_amount").val($net_amount);
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

    // delete area 
    $(document).on('click', '.delete', function(){
        if(confirm('Are you sure?')){
            $tab = $(this).attr('tab');
            $pk_name = $(this).attr('pk-name');
            $pk_value = $(this).attr('pk-value');
            $child = $(this).attr('child');
            $ref_table = $(this).attr('ref-table');
            $ref_pk_name = $(this).attr('ref-pk-name');
            
            $.ajax({
                url: "<?= base_url('ajax-del-row-on-table-and-pk') ?>",
                type: 'POST',
                dataType: 'json',
                data:{tab: $tab, pk_name: $pk_name, pk_value: $pk_value, child: $child, ref_table: $ref_table, ref_pk_name: $ref_pk_name},
                success: function(returnData){
                    // console.log(returnData);
                    notification(returnData);
                    // redraw all tables 
                    $('#item_color_rate_table').DataTable().ajax.reload();
                    $('#item_color_table').DataTable().ajax.reload();
                    $('#item_buy_code_table').DataTable().ajax.reload();
                },
                error: function(e,v){
                    console.log(e + v);
                }
            });
        }
    })

    // buy code validation and submit 
    $("#form_add_item_buy_code").validate({
        rules: {
            /*account_master_code: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_buy_code')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                    },
                },
            },*/
            account_master_code: {
                required: true,
            },
            buying_code: {
                required: true,
            },
        },
        messages: {

        }
    });
    $('#form_add_item_buy_code').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            
            $('#form_add_item_buy_code')[0].reset(); //reset form
            $("#form_add_item_buy_code select").select2("val", ""); //reset all select2 fields
            $('#form_add_item_buy_code :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item_buy_code").validate().resetForm(); //reset validation

            notification(obj);
            //refresh table
            $('#item_buy_code_table').DataTable().ajax.reload();
        }
    });

     // buy code validation and submit 
     $("#form_edit_item_buy_code").validate({
        rules: {
            buying_code_edit: {
                required: true,
            },
        },
        messages: {

        }
    });
    $('#form_edit_item_buy_code').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item_buy_code").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            //refresh table
            $('#item_buy_code_table').DataTable().ajax.reload();
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
