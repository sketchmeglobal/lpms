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
    <title>Office Invoice Edit | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Purchase Order">

     <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
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
        
        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff}

        #change_packing_details_edit_span {
  animation: blinker 1s linear infinite;
  background-color: #419341;
    padding: 1%;
    border-radius: 6px;
    color: white;
}

@-webkit-keyframes blinker {
      0% { opacity: 1; }
     49% { opacity: 1; }
     50% { opacity: 0; }
    100% { opacity: 0; }
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
            <h3 class="m-b-less">Office Invoice Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Office Invoice Edit </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-edit-office-invoice')?>" class="cmxform form-horizontal tasi-form">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $office_invoice_data[0]->office_invoice_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            	<div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="office_invoice_number" class="control-label text-danger">Invoice Number*</label>
                                    <input id="office_invoice_number" name="office_invoice_number" type="text" placeholder="Invoice Number" class="form-control round-input" value="<?= $office_invoice_data[0]->office_invoice_number ?>" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="office_invoice_date" class="control-label text-danger">Date *</label>
                                        <input id="office_invoice_date" name="office_invoice_date" type="date" placeholder="Date" class="form-control round-input" value="<?= date('Y-m-d', strtotime($office_invoice_data[0]->office_invoice_date)) ?>" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="rate_type" class="control-label text-danger">Rate Type *</label>
                                        <select id="rate_type" name="rate_type" class="form-control select2">
                                            <option value="">Rate Type</option>
                                            <option value="1" <?php if($office_invoice_data[0]->rate_type == '1'){ ?> selected <?php } ?>> Ex. Works</option>
                                            <option value="2" <?php if($office_invoice_data[0]->rate_type == '2'){ ?> selected <?php } ?>> C&F </option>
                                            <option value="3" <?php if($office_invoice_data[0]->rate_type == '3'){ ?> selected <?php } ?>> CIF </option>
                                            <option value="4" <?php if($office_invoice_data[0]->rate_type == '4'){ ?> selected <?php } ?>> FOB</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="am_id" class="control-label text-danger">Select Buyer*</label>
                                        <span class="select_buyer_val hidden"><?= $office_invoice_data[0]->am_id ?></span>
                                        <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Buyer</option>
											<?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>" data-value="<?= $bd->cur_id ?>" <?php if($office_invoice_data[0]->am_id == $bd->am_id){ ?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="currency" class="control-label text-danger">Select Currency</label>
                                        <select id="currency" name="currency" class="form-control select2">
                                        <option value="">Select Currency</option>
											<?php
                                            foreach($currency_list as $cl){
                                            ?> 
                                                <option value="<?= $cl->cur_id ?>" <?php if($office_invoice_data[0]->cur_id == $cl->cur_id){ ?> selected <?php } ?> ><?= $cl->currency ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                 </div>
                                 
                                <div class="form-group ">    
                                    
                                    <div class="col-lg-3">
                                        <label for="office_proforma_id" class="control-label">Select Proforma</label>
                                        <span class="hidden select_pro_val"><?= $office_invoice_data[0]->office_proforma_id ?></span>
                                        <?php 
            $office_proforma = $office_invoice_data[0]->office_proforma_id;
            $office_proforma_ar = explode(",", $office_proforma);
                                         ?>
                                        <select id="office_proforma_id" name="office_proforma_id[]" class="form-control select2" multiple>
                                        <option value="">Select Proforma</option>
                                        <?php
                                            foreach($office_proforma_list as $opl){
                                            ?> 
                                                <option value="<?=$opl->office_proforma_id?>" <?php 
                                            foreach($office_proforma_ar as $o_p_a) {
                                            if($o_p_a == $opl->office_proforma_id){ ?> selected <?php }} ?>><?=$opl->proforma_number?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                
                                	<div class="col-lg-3">
                                    <label for="pre_carriage_by" class="control-label">Pre-Carriage by:</label>
                                    <select id="pre_carriage_by" name="pre_carriage_by" class="form-control select2" required>
                                        <option value="">Pre-Carriage</option>
                                        <option value="1" <?php if($office_invoice_data[0]->pre_carriage_by == '1'){ ?> selected <?php } ?>>By Air</option>
                                        <option value="2" <?php if($office_invoice_data[0]->pre_carriage_by == '2'){ ?> selected <?php } ?>>By Ship </option>
                                        <option value="3" <?php if($office_invoice_data[0]->pre_carriage_by == '3'){ ?> selected <?php } ?>>By Road</option>
                                    </select>
                                </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="port_of_discharge" class="control-label">Port of Discharge</label>
                                        <textarea id="port_of_discharge" name="port_of_discharge" placeholder="Port of Discharge" class="form-control round-input"><?=$office_invoice_data[0]->port_of_discharge?></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="port_of_loading" class="control-label">Port of Loading</label>

                                        <textarea id="port_of_loading" name="port_of_loading" placeholder="Port of Loading" class="form-control round-input"><?= trim($office_invoice_data[0]->port_of_loading) == '' ? 'Kolkata': $office_invoice_data[0]->port_of_loading ?></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="terms_conditions" class="control-label">Terms and Conditions</label>

                                        <textarea id="terms_conditions" name="terms_conditions" placeholder="Terms and Conditions" class="form-control round-input"><?=$office_invoice_data[0]->terms_conditions?></textarea>
                                    </div>
                                    
                                    
                                    <div class="col-lg-3">
                                        <label for="tr_id" class="control-label text-danger">Select transporter*</label>
                                        <span class="select_tranporter_val hidden"><?= $office_invoice_data[0]->tr_id ?></span>
                                        <select id="tr_id" name="tr_id" class="form-control select2" required>
                                        <option value="">Select Transporter</option>
											<?php
                                            foreach($transport_details as $tr_de){
                                            ?> 
                                                <option value="<?= $tr_de->tr_id ?>" <?php if($office_invoice_data[0]->tr_id == $tr_de->tr_id){ ?> selected <?php } ?>><?= $tr_de->name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-lg-3">
                                        <label for="distance" class="control-label text-danger">Distance*</label>

                                        <input type="number" id="distance" name="distance" placeholder="Distance" class="form-control round-input" value="<?=$office_invoice_data[0]->distance?>" required>
                                    </div>
                                    
                                    
                                 </div>
                                 
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="packing_shipment_id" class="control-label text-danger">Select Packing List*</label>
                                        <select id="packing_shipment_id" name="packing_shipment_id" class="form-control select2" disabled>
                                        <option value="">Select Packing List</option>
                                        <?php
                                            foreach($packing_shipment_list as $psl){
                                            ?> 
                                                <option value="<?=$psl->packing_shipment_id?>" <?php if($psl->packing_shipment_id == $office_invoice_data[0]->packing_shipment_id){ ?> selected <?php } ?>><?=$psl->package_name?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>   
                                                                    
                                    <div class="col-lg-3">
                                        <label for="terms_of_delivery_payment" class="control-label">Terms of Delivery & Payment</label>
                                        <textarea rows="6" id="terms_of_delivery_payment" name="terms_of_delivery_payment" placeholder="Terms of Delivery & Payment" class="form-control"><?=$office_invoice_data[0]->terms_of_delivery_payment?></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="mark_container" class="control-label">Mark & Container</label>
                                        <textarea rows="6" id="mark_container" name="mark_container" placeholder="Mark & Container" class="form-control"><?=$office_invoice_data[0]->mark_container?></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="notify" class="control-label">Notify</label>
                                        <textarea rows="6" id="notify" name="notify" placeholder="Notify" class="form-control"><?=$office_invoice_data[0]->notify?></textarea>
                                    </div>
                                 </div>
                                 
                                <div class="form-group ">
                                    <div class="col-lg-6">
                                        <label for="no_of_kind_of_package" class="control-label">No. & Kind of Pkgs</label>

                                        <textarea id="no_of_kind_of_package" name="no_of_kind_of_package" placeholder="No. & Kind of Pkgs" class="form-control round-input"><?=$office_invoice_data[0]->no_of_kind_of_package?></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="description_of_goods" class="control-label">Description of Goods</label>

                                        <textarea id="description_of_goods" name="description_of_goods" placeholder="Description of Goods" class="form-control round-input"><?=$office_invoice_data[0]->description_of_goods?></textarea>
                                    </div>                                    
                                </div>
                                
                                <div class="form-group ">
                                	<div class="col-lg-2">
                                    <label for="gross_weight" class="control-label">Gross Weight</label>
                                    <input id="gross_weight" name="gross_weight" type="number" placeholder="Gross Weight" class="form-control round-input" value="<?=$office_invoice_data[0]->gross_weight?>"/>
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_weight" class="control-label">Net Weight</label>
                                    <input id="net_weight" name="net_weight" type="number" placeholder="Net Weight" class="form-control round-input" value="<?=$office_invoice_data[0]->net_weight?>"/>
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="volume_weight" class="control-label">Volume Weight</label>
                                    <input id="volume_weight" name="volume_weight" type="number" placeholder="Volume Weight" class="form-control round-input" value="<?=$office_invoice_data[0]->volume_weight?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="ex_rate" class="control-label text-danger">EX Rate*</label>
                                    <input id="ex_rate" name="ex_rate" type="number" placeholder="EX Rate" required class="form-control round-input" value="<?=$office_invoice_data[0]->ex_rate?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="conversion_rate" class="control-label">Conversion Rate</label>
                                    <input id="conversion_rate" name="conversion_rate" type="number" placeholder="Conversion Rate" class="form-control round-input" value="<?=$office_invoice_data[0]->conversion_rate?>" />
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="acc_master_declar_id" class="control-label">Select Declaration</label>
                                        <span class="hidden select_dec_val"><?= $office_invoice_data[0]->acc_master_declar_id ?></span>
                <?php 
            $declaration = $office_invoice_data[0]->acc_master_declar_id;
            $declaration_ar = explode(",", $declaration);
                                         ?>                        
                                        <select id="acc_master_declar_id" name="acc_master_declar_id[]" class="form-control select2" multiple>
                                        <?php
                                            foreach($acc_master_declaration as $bd){
                                            ?> 
                                                <option value="<?=$bd->INVOICE_DECLARATION_SEQ?>" <?php 
                                            foreach($declaration_ar as $o_p_a) {
                                            if($o_p_a == $bd->INVOICE_DECLARATION_SEQ){ ?> selected <?php }} ?>><?=$bd->DECLARATION_SUBJECT?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-2">
                                    <label for="net_qnty" class="control-label">Net Quantity</label>
                                    <input id="net_qnty" name="net_qnty" type="number" placeholder="Net Quantity" class="form-control round-input" value="<?=$office_invoice_data[0]->net_quantity?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_amnt" class="control-label">Net Amount</label>
                                    <input id="net_amnt" name="net_amnt" type="number" placeholder="Net Amount" class="form-control round-input" value="<?=$office_invoice_data[0]->net_amount?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_amnt" class="control-label">Net Amount(INR)</label>
                                    <input id="net_amnt_inr" name="net_amnt_inr" type="number" placeholder="Net Amount" class="form-control round-input" value="<?=$office_invoice_data[0]->net_amount_inr?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="volume_weight" class="control-label">Discount %</label>
                                    <input id="disc" name="disc" type="number" placeholder="discount" class="form-control round-input" value="<?=$office_invoice_data[0]->discount?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="hand_charge" class="control-label">Handling Charges</label>
                                    <input id="hand_charge" name="hand_charge" type="number" placeholder="Handling Charges" class="form-control round-input" value="<?=$office_invoice_data[0]->hand_charge?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="grand_total" class="control-label">Grand Total</label>
                                    <input id="grand_total" name="grand_total" type="number" placeholder="Grand Total" class="form-control round-input" value="<?=$office_invoice_data[0]->grand_total?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="grand_total" class="control-label">Grand Total (INR)</label>
                                    <input id="grand_total_inr" name="grand_total_inr" type="number" placeholder="Grand Total" class="form-control round-input" value="<?=$office_invoice_data[0]->grand_total_inr?>" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="cust_header_name" class="control-label">Custom Header Name</label>
                                    <input id="cust_header_name" name="cust_header_name" type="text" placeholder="Custom Header Name" class="form-control round-input" value="<?=$office_invoice_data[0]->cust_header_name?>" />
                                    </div> 
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                    <label for="net_qnty" class="control-label">Buyer (if other than consignee)</label>
                                    <select id="am_id_other" name="am_id_other" class="form-control select2">
                                        <option value="">Select Buyer</option>
                                            <?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>" <?php if($office_invoice_data[0]->am_id_other == $bd->am_id){ ?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                    <input type="checkbox" id="print_hand_ratio" name="print_hand_ratio" value="<?= $office_invoice_data[0]->print_hand_ratio ?>" <?php echo ($office_invoice_data[0]->print_hand_ratio==1 ? 'checked' : '');?>> &nbsp;&nbsp;
                                    <label for="print_hand_ratio"> Show hand-machine ratio(Uncheck to hide from print) </label><br>
                                    </div>
                                     
                                </div>
                                
                                
                        </div>
                    <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-refresh"> Update Office Invoice </i>
                                    </a>
                                            <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                            <p class="text-center"><b>All detail level item's exchange rate will be updated.<br/>
                                            Are you sure to proceed?</b></p>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update </i></button>
                                            <a class="btn btn-danger" data-dismiss="modal">Close</a>
                                            </div>
                                            
                                            </div>
                                            </div>
                                            </div>
                                        <!--<button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Office Invoice </i></button>-->
                                        <!--<button id="allot_roll_no_btn" class="btn btn-info addon-btn m-b-10"><i class="fa fa-magic"></i> Test</button>-->
                                    </div>
                                    
                                </div> 
                                <input type="hidden" id="office_invoice_id_edit" name="office_invoice_id_edit" class="hidden" value="<?= $office_invoice_data[0]->office_invoice_id ?>" />
                    </section>
                </div>
               </form> 
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Material details for <?= $office_invoice_data[0]->office_invoice_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                             <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#supp_po_list" data-toggle="tab">List</a></li>
                                <li><a href="#po_details_edit" data-toggle="tab">Edit</a></li>
                                <li><a href="#change_packing_details_edit" data-toggle="tab">Changes In Packing List <span id="change_packing_details_edit_span"></span> </a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                
                                <div id="supp_po_list" class="tab-pane fade in active">
                                    <table id="add_office_invoice_details_list_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Article#</th>
                                                <th>Colour</th>
                                                <th>Item No.</th>
                                                <th>Ref No.</th>
                                                <th>Qnty</th>
                                                <th>Exchange Rate</th>
                                                <th>Rate(FOR)</th>
                                                <th>Net Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="change_packing_details_edit" class="tab-pane fade">
                                  <table id="add_office_invoice_packing_table" class="table data-table dataTable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>CN#</th>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Alt Art. Number</th>
                                                <th>Leather Color</th>
                                                <th>Item</th>
                                                <th>Reference</th>
                                                <th>Box Size</th>
                                                <th>Total Quantity of Art. in Pack. List</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                
                                <div id="po_details_edit" class="tab-pane fade">
                                    <table id="add_office_invoice_details" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Article#</th>
                                                <th>Colour</th>
                                                <th>Item No.</th>
                                                <th>Ref No.</th>
                                                <th>Qnty</th>
                                                <th>Exchange Rate</th>
                                                <th>Rate(FOR)</th>
                                                <th>Net Rate</th>
                                                <th>Amount</th>
                                                <th>Amount (INR)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php
                        if(count($invoice_details) > 0) { 
                        foreach($invoice_details as $i_d) { 
                            ?>
                            <tr>
                            <td><?= $i_d->co_no ?>
                                <input id="co_id_<?= $i_d->office_invoice_detail_id ?>" name="co_id_add" type="hidden" value="<?= $i_d->co_id ?>" />
                            </td>
                            <td><?= $i_d->art_no ?>
                        <input id="cod_id_<?= $i_d->office_invoice_detail_id ?>" name="cod_id_add" type="hidden" value="<?= $i_d->cod_id ?>" />
                        <input id="am_id_detail_<?= $i_d->office_invoice_detail_id ?>" name="am_id_detail_add" type="hidden" value="<?= $i_d->am_id ?>" />
                            </td>
                            <td><?= $i_d->color ?>
                                <input id="fc_id_<?= $i_d->office_invoice_detail_id ?>" name="fc_id_add" type="hidden" value="<?= $i_d->fc_id ?>" />
                                <input id="lc_id_<?= $i_d->office_invoice_detail_id ?>" name="lc_id_add" type="hidden" value="<?= $i_d->lc_id ?>" />
                            </td>
                            <td>
                        <input id="item_no_<?= $i_d->office_invoice_detail_id ?>" name="item_no_add" class="form-control item_no_add" type="text" value="<?= $i_d->item_no ?>" />
                            </td>
                            <td>
                        <input id="reference_no_<?= $i_d->office_invoice_detail_id ?>" name="reference_no_add" class="form-control reference_no_add" type="text" value="<?= $i_d->reference_no ?>" />
                            </td>
                            <td>
                        <input id="quantity_<?= $i_d->office_invoice_detail_id ?>" name="quantity_add" class="form-control class_q" type="number" value="<?= $i_d->quantity ?>"/>
                            </td>
                            <td>
                        <input id="rate_inr_<?= $i_d->office_invoice_detail_id ?>" name="rate_inr_add" class="form-control rate_inr_add" type="number" value="<?= $i_d->rate_inr ?>"/>
                            </td>
                            <td>
                        <input id="rate_foreign_<?= $i_d->office_invoice_detail_id ?>" name="rate_foreign_add" class="form-control class_r_fo" type="number" value="<?= $i_d->rate_foreign ?>"/>
                            </td>
                        <!--    <td>-->
                        <!--<input id="additional_charges_< $i_d->office_invoice_detail_id ?>" name="additional_charges_add" class="form-control class_add_ch" type="number" value="< $i_d->additional_charges ?>"/>-->
                        <!--    </td>-->
                            <td>
                        <input id="net_rate_<?= $i_d->office_invoice_detail_id ?>" name="net_rate_add" class="form-control net_rate" type="number" value="<?= $i_d->net_rate ?>" value="<?= $i_d->net_rate ?>" readonly/>
                            </td>
                            <td>
                        <input id="amount_<?= $i_d->office_invoice_detail_id ?>" name="amount_add" class="form-control amnt" type="number" value="<?= $i_d->amount ?>" readonly/>
                            </td>
                            <td>
                        <input id="amount_inr_<?= $i_d->office_invoice_detail_id ?>" name="amount_add_inr" class="form-control amnt_inr" type="number" value="<?= $i_d->amount_inr ?>" readonly/>
                            </td>
                            <!-- <td><a href="javascript:void(0)" data-pk="<?= $i_d->office_invoice_detail_id ?>" tab-pk="<?= $i_d->office_invoice_id ?>" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a></td> -->
                            <td style="white-space: nowrap;">
                                <a href="javascript:void(0)" data-pk="<?= $i_d->office_invoice_detail_id ?>" tab-pk="<?= $i_d->office_invoice_id ?>" class="btn btn-success edit_btn"> Update</a>
                                <a href="javascript:void(0)" data-pk="<?= $i_d->office_invoice_detail_id ?>" tab-pk="<?= $i_d->office_invoice_id ?>" class="btn btn-danger delete"> Delete </a>
                            </td>
                        </tr>
                        <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>

                                

                                
                            </div>
                            <br/>
                            <br/>
                        </div>
                    </section>
                </div>
                </div>
            </div>
        
            </div>

        </div>
        <!--body wrapper end-->

        <!--footer section start-->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" integrity="sha256-D84eXFg8c1WCaWR3vsFNQgUeYMdGgOXUs7dXyMbx70A=" crossorigin="anonymous"></script>
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
<script src="<?=base_url();?>assets/admin_panel/js/bootstrap-confirmation.min.js"></script>

<script>
    
$('#add_office_invoice_details_list_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: ' Invoice PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: ' Invoice Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }    
               }
           ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-office-invoice-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    office_invoice_id_edit: function () {
                        return $("#office_invoice_id_edit").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "order_number" },
                { "data": "article_name" },
                { "data": "colour" },
                { "data": "item_no" },
                { "data": "reference_no" },
                { "data": "quantity" },
                { "data": "rate_inr" },
                { "data": "rate_foreign" },
                { "data": "net_rate" },
                { "data": "amount" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [0,1,2,3,4,5,6,7,8.9],
                "orderable": false,
                "targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap',
                "targets": 5,
            }],

        } );

$('#add_office_invoice_packing_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: ' Invoice PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: ' Invoice Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }    
               }
           ],
            "processing": true,
            "language": {
                processing: '',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-office-invoice-details-packing-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    office_invoice_id_edit: function () {
                        return $("#office_invoice_id_edit").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "carton_number" },
                { "data": "order_number" },
                { "data": "article_number" },
                { "data": "alt_article_number" },
                { "data": "leather_color" },
                { "data": "item" },
                { "data": "reference" },
                { "data": "box_size" },
                { "data": "quantity" },
                { "data": "status" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3, 4, 5, 6, 9],
                "orderable": false,
            }]

        } );

$(document).ready(function() {
     $("#currency").change(function(){
         $get_val = $('#packing_shipment_id').val();
         if($get_val != '' ) {
        $effective_date = $('#office_invoice_date').val();
        var cur_id_val = $('option:selected',this).val();
        $.ajax({
            url: "<?= base_url('admin/ajax-get-latest-currency-values') ?>",
            method: "post",
            dataType: 'json',
            data: {'cur_id_val': cur_id_val, 'effective_date': $effective_date},
            success: function(result){
                // console.log(JSON.stringify(result));
                    $(".rate_inr_add").val(result);
                    $new_res11 = 0;
        $('.rate_inr_add').each(function () {
                    $amnt1 = parseFloat($(this).closest('table tbody tr').find('.amnt').val());
                    $irate1 = parseFloat($(this).val());
                    var valluess = ($irate1 * $amnt1);
                    $(this).closest('table tbody tr').find('.amnt_inr').val(valluess.toFixed(2));
                    $new_res11 += valluess;
                                });
                                $("#net_amnt_inr").val($new_res11.toFixed(2));
                                $("#grand_total_inr").val($new_res11.toFixed(2));
            },
            error: function(e){console.log(e);}
        });
         } else {
             $("#currency").select2("val", "")
             alert('Select Packing List First');
         }
         
    });
});

$('#add_office_invoice_packing_table').on('click', '.add_btn', function() { 
  var val = $(this).attr("po-id"); // amend the index as needed
  $.ajax({
                url: "<?= base_url('admin/add-invoice-details-wrt-packing-id') ?>",
                method: "post",
                dataType: 'json',
                data: {'pack_detail_id': val},
                success: function(returnData){
                    var string1 = JSON.stringify(returnData);
                    obj = JSON.parse(string1);

                    $('#net_qnty').val(obj.qnty);
                    $('#add_office_invoice_details_list_table').DataTable().ajax.reload();
                        
            notification(obj);
            
            //refresh table
                },
                error: function(e){console.log(e);}
            });
});

</script>

<script>
    
    $(document).ready(function() {

        $(document).on('click', '.edit_btn', function(){

            $inv_detail_id = $(this).attr('data-pk');
            $inv_id = $(this).attr('tab-pk');
            $item = $(this).closest('#add_office_invoice_details tbody tr').find('.item_no_add').val();
            $quantity = $(this).closest('#add_office_invoice_details tbody tr').find('.class_q').val();
            $reference = $(this).closest('#add_office_invoice_details tbody tr').find('.reference_no_add').val();
            $rate = $(this).closest('#add_office_invoice_details tbody tr').find('.rate_inr_add').val();
            $rate_fr = $(this).closest('#add_office_invoice_details tbody tr').find('.class_r_fo').val();
            $net_ra = $(this).closest('#add_office_invoice_details tbody tr').find('.rate_inr_add').val();
            $amnt = $(this).closest('#add_office_invoice_details tbody tr').find('.amnt').val();
            $amnt_inr = $(this).closest('#add_office_invoice_details tbody tr').find('.amnt_inr').val();

            $.ajax({
                url: "<?= base_url('admin/update-invoice-details-wrt-invoice-id') ?>",
                method: "post",
                dataType: 'json',
                data: {'inv_detail_id': $inv_detail_id, 'quantity': $quantity, 'reference': $reference, 'rate': $rate, 'rate_fr': $rate_fr, 'net_ra': $net_ra, 'item': $item, 'inv_id': $inv_id, 'amnt': $amnt, 'amnt_inr': $amnt_inr},
                success: function(returnData){
                    // console.log('RD => ' + returnData);
                    var string1 = JSON.stringify(returnData);

                    obj = JSON.parse(string1);
                                // console.log('RD => ' + obj);
                                // console.log(JSON.stringify(returnData));

                                // obj = JSON.stringify(returnData);

            $('#net_amnt').val(obj.total_net_amount_new);
            $('#grand_total').val(obj.total_grand_amount_new);
            $('#net_amnt_inr').val(obj.total_net_amount_new_inr);
            $('#grand_total_inr').val(obj.total_grand_amount_new_inr);
            $('#net_qnty').val(obj.total_quantity);
            $(this).closest('table tbody tr').find('.amnt').val(obj.individual_amount);
            $irate2 = $(this).closest('table tbody tr').find('.rate_inr_add').val();
            $(this).closest('table tbody tr').find('.amnt_inr').val(obj.individual_amount * $irate2);
            
            notification(obj);
            
            //refresh table
                },
                error: function(e){console.log(e);}
            });

        });

        });

</script>

<script>
    $(document).ready(function(){
        $office_invoice_id_edit = $('#office_invoice_id_edit').val();
            $.ajax({
                url: "<?= base_url('admin/get-rows-number-new-added-packing') ?>",
                method: "post",
                dataType: 'json',
                data: {'office_invoice_id_edit': $office_invoice_id_edit},
                success: function(returnData){
                    // console.log('RD => ' + returnData);
                    var string1 = JSON.stringify(returnData);
                    obj = JSON.parse(string1);
            $('#change_packing_details_edit_span').html(obj+' changes');
            $('#add_office_invoice_packing_table').DataTable().ajax.reload();
                        
            //refresh table
                },
                error: function(e){console.log(e);}
            });

    });

</script>

<script>
    $("#am_id").change(function(){
        $am_id = $(this).val();
        var am_id_val = $('option:selected',this).data("value");
        $("#currency").val(am_id_val).change();
        $.ajax({
            url: "<?= base_url('admin/ajax-all-account-declaration') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id,},
            success: function(result){
                console.log(JSON.stringify(result));
                $("#acc_master_declar_id").html("");
                $.each(result, function(index, item) {
                    $str = '<option value=' + item.INVOICE_DECLARATION_SEQ + '> '+ item.DECLARATION_DESCRIPTION + '</option>';
                    $("#acc_master_declar_id").append($str);
                });
            },
            error: function(e){console.log(e);}
        });
    });
	
	$("#material_issue_to_form").change(function(){
        $material_issue_to_form = $(this).val();
		$('#challan_div').hide();
		$('#supplier_div').hide();
			
		console.log('material_issue_to_form: '+$material_issue_to_form);
		if(parseInt($material_issue_to_form) == 2){
			$('#challan_div').show();
		}else if(parseInt($material_issue_to_form) == 3 || parseInt($material_issue_to_form) == 4){
			$('#supplier_div').show();
		}
	});
	
	
	$("#issue_date_add").change(function(){
        $issue_date_add = $(this).val();
		console.log('issue_date_add: '+$issue_date_add);
		
		$.ajax({
            url: "<?= base_url('admin/all-items-on-purchase-order-receive-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'issue_date_add': $issue_date_add,},
            success: function(result){
                //console.log(JSON.stringify(result));
				var all_items = result.item_details;
                //$("#pod_unit").html("<b>" +all_items[0].unit+ '</b>');
                $("#id_id_add").html("<option value=''>Select Item</option>");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.purchase_order_receive_detail_id + ' c_id=' + item.c_id + ' remain_quantity_for_material_issue=' + item.remain_quantity_for_material_issue + ' id_id='+ item.id_id + ' im_code=' + item.im_code + ' im_id=' + item.im_id + ' unit=' + item.unit + ' color=' + item.color + ' >  '+ item.item + ' [' + item.color + ']</option>';
                    $("#id_id_add").append($str);
                });
                // open the item tray 
                $('#id_id_add').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });
	
	
	//pod_rate_add
	$("#pod_rate_add").blur(function(){
        $pod_quantity_add = $('#pod_quantity_add').val();
		$pod_rate_add = $('#pod_rate_add').val();
		$rate_new = parseFloat($pod_quantity_add * $pod_rate_add).toFixed(2);
		$('#pod_total_add').val($rate_new);
	});
	
	// EDIT - multiply for item_amount
    $("#pod_quantity_edit, #pod_rate_edit").on('change', function () {
        $pod_quantity_edit = $("#pod_quantity_edit").val();
        $pod_rate_edit = $("#pod_rate_edit").val();
        $("#pod_total_edit").html("<b>" +parseFloat($pod_quantity_edit * $pod_rate_edit).toFixed(2)+ "</b>");
    });
	
	  
    $("#form_edit_receive_purchase_order").validate({
        rules: {
            office_invoice_number: {
                required: true
            },
            office_invoice_date: {
                required: true
            },
            rate_type: {
                required: true
            },
            am_id: {
                required: true
            },
            currency: {
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
            $office_inv = obj.invoice_id;
            window.location.href = '<?=base_url()?>admin/office-invoice-edit/'+$office_inv;
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_receive_purchase_order_details").validate({
        rules: {
            issue_date_add: {
                required: true,
            },
			issue_quantity_preview: {
                required: true,
            }
        },
        messages: {

        }
    });
    
    $(document).ready(function () {
        $('#office_proforma_id, #acc_master_declar_id').select2({
                        multiple: true
                    });

                    $dec_val = $(".select_dec_val").text();
                    var selectedValues = $dec_val.split(',');
                    $("#acc_master_declar_id").val(selectedValues).trigger("change");
    });


                $(document).on('blur', '.class_r_fo', function () {
                    $qunty = ($(this).closest('table tbody tr').find('.class_q').val());
                    $frate = ($(this).val());
                    $irate = $(this).closest('table tbody tr').find('.rate_inr_add').val();
                    var res = calc_total($frate, $qunty);
//                            alert(res);
                    $(this).parent().next('td').next('td').find('input').val(res);
                    $(this).parent().next('td').next('td').next('td').find('input').val(res * $irate);
                    $new_res = 0;
                });
                
                $(document).on('blur', '.rate_inr_add', function () {
                    $amnt = $(this).closest('table tbody tr').find('.amnt').val();
                    $irate = ($(this).val());
//                            alert(res);
                    $(this).closest('table tbody tr').find('.amnt_inr').val($amnt * $irate);
                    $new_res = 0;
                });

                $(document).on('blur', '.class_q', function () {
                    $qunty = ($(this).val());
                    $irate = $(this).closest('table tbody tr').find('.rate_inr_add').val();
                    $frate = ($(this).parents().next('td').next('td').find('input').val());
                    var res = calc_total($frate, $qunty);
                           // alert(res);
                    $(this).parent().next('td').next('td').next('td').next('td').find('input').val(res);
                    $(this).parent().next('td').next('td').next('td').next('td').next('td').find('input').val(res * $irate);
                    $new_res = 0;
                });

                function  calc_total($frate, $qunty) {
//                            alert($addt_cahrge + ' ' + $frate + ' ' + $qunty);
                    $res = (parseFloat($frate) * parseFloat($qunty));
                    return $res.toFixed(2);
                }

                //  discount change
                $("#disc").blur(function () {
                    var disc = parseFloat($(this).val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var amntt = parseFloat($("#net_amnt").val());
                    var amntt_inr = parseFloat($("#net_amnt_inr").val());
                    var res = (amntt - (amntt * (disc / 100)) + han_char);
                    $("#grand_total").val(res.toFixed(2));
                    var res_inr = (amntt_inr - (amntt_inr * (disc / 100)) + han_char);
                    $("#grand_total_inr").val(res_inr.toFixed(2));
                });

                // handling charge areaw
                $("#hand_charge").blur(function () {
                    var disc = parseFloat($("#disc").val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var amntt = parseFloat($("#net_amnt").val());
                     var amntt_inr = parseFloat($("#net_amnt_inr").val());
                    var res = (amntt - (amntt * (disc / 100)) + han_char);
                    $("#grand_total").val(res.toFixed(2));
                    var res_inr = (amntt_inr - (amntt_inr * (disc / 100)) + han_char);
                    $("#grand_total_inr").val(res_inr.toFixed(2));
                });

	// delete area 
	$(document).on('click', '.delete', function(){
        $this = $(this);
        if(confirm("Are You Sure?")){
			$data_pk = $(this).attr('data-pk');
            $tab_pk = $(this).attr('tab-pk');
			
            $.ajax({
                url: "<?= base_url('admin/del-office-invoice-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {data_pk: $data_pk, tab_pk: $tab_pk},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    $("#net_qnty").val(returnData.quantity_new);
                    $("#net_amnt").val(returnData.net_amount_new);
                    $("#grand_total").val(returnData.total_amount_new);
                    $("#net_amnt_inr").val(returnData.net_amount_new_inr);
                    $("#grand_total_inr").val(returnData.total_amount_new_inr);
                    //refresh table

                },
                error: function (returnData) {
                    obj = JSON.parse(returnData);
                    notification(obj);
                }
            });
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
            "showDuration": "100",
            "hideDuration": "2000",
            "timeOut": "2000",
            "extendedTimeOut": "5000",
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
