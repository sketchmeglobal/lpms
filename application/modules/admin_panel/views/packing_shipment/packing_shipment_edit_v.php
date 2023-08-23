
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Packing/Shipment | <?=WEBSITE_NAME;?></title>
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

        .check_container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.check_container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.check_container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.check_container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.check_container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.check_container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

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
            <h3 class="m-b-less">Edit Packing/Shipment</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Packing/Shipment </li>
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
                            Edit: <?= $packing_shipment_detail[0]->package_name ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_packing_shipment" method="post" action="<?=base_url('admin/form-edit-packing-shipment')?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="package_name" class="control-label text-danger">Package Name *</label>
                                    <input id="package_name" name="package_name" type="text" placeholder="Package Name" class="form-control round-input" value="<?= $packing_shipment_detail[0]->package_name ?>" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="package_date" class="control-label text-danger">Package Date *</label>
                                    <input id="package_date" name="package_date" type="date" class="form-control round-input" value="<?= date('Y-m-d', strtotime($packing_shipment_detail[0]->package_date)) ?>" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="package_note" class="control-label">Package Note</label>
                                    <input id="package_note" name="package_note" type="text" placeholder="Package Note" class="form-control round-input" value="<?= $packing_shipment_detail[0]->package_note ?>" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <textarea id="remarks" name="remarks" placeholder="Remarks" class="form-control round-input"><?= $packing_shipment_detail[0]->remarks ?></textarea>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="terms_of_delivery" class="control-label">Terms of Delivery</label>
                                    <textarea id="terms_of_delivery" name="terms_of_delivery" placeholder="Terms of Delivery" class="form-control round-input"><?= $packing_shipment_detail[0]->terms_of_delivery ?></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="mark_container" class="control-label">Mark & Container</label>
                                    <textarea id="mark_container" name="mark_container" placeholder="Mark & Container" class="form-control round-input"><?= $packing_shipment_detail[0]->mark_container ?></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="pre_carriage_by" class="control-label">Pre-Carriage:</label>
                                    <select id="pre_carriage_by" name="pre_carriage_by" class="form-control select2">
                                        <option value="">Pre-Carriage</option>
                                        <option value="1" <?php if($packing_shipment_detail[0]->pre_carriage_by == 1){?> selected <?php } ?>>By Air</option>
                                        <option value="2" <?php if($packing_shipment_detail[0]->pre_carriage_by == 2){?> selected <?php } ?>>By Ship </option>
                                        <option value="3" <?php if($packing_shipment_detail[0]->pre_carriage_by == 3){?> selected <?php } ?>>By Road</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="port_of_discharge" class="control-label">Port of Discharge</label>
                                    <textarea id="port_of_discharge" name="port_of_discharge" placeholder="Port of Discharge" class="form-control round-input"><?= $packing_shipment_detail[0]->port_of_discharge ?></textarea>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="no_of_kind_of_package" class="control-label">No. & Kind of Package</label>
                                    <textarea rows="8" id="no_of_kind_of_package" name="no_of_kind_of_package" placeholder="No. & Kind of Package" class="form-control"><?= $packing_shipment_detail[0]->no_of_kind_of_package ?></textarea>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="description_of_goods" class="control-label">Desc. of Goods</label>
                                    <textarea rows="8" id="description_of_goods" name="description_of_goods" placeholder="Desc. of Goods" class="form-control"><?= $packing_shipment_detail[0]->description_of_goods ?></textarea>
                                </div>

                                <div class="col-lg-3">
                                    <label for="header_box_size" class="control-label">Dimension.</label>
                                    <textarea rows="8" id="header_box_size" name="header_box_size" placeholder="Box Size" class="form-control"><?= $packing_shipment_detail[0]->header_box_size ?></textarea>
                                </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="net_qnty" class="control-label">Buyer (if other than consignee)</label>
                                        <select id="am_id_other" name="am_id_other" class="form-control select2">
                                            <option value="">Select Buyer</option>
                                            <?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>" <?php if($packing_shipment_detail[0]->am_id_other == $bd->am_id){ ?> selected <?php } ?>><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="notify" class="control-label">Notify</label>
                                        <textarea rows="5" id="notify" name="notify" placeholder="Notify" class="form-control"><?= $packing_shipment_detail[0]->notify ?></textarea>
                                    </div>
                                
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Packing/Shipment</i></button>
                                    </div>
                                </div>
                                <input type="hidden" id="packing_shipment_id" name="packing_shipment_id" class="hidden" value="<?= $packing_shipment_detail[0]->packing_shipment_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-2 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Total
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($purchase_order); ?> -->
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <label for="total_quantity" class="control-label">Total quantity</label>
                                <input id="total_quantity" name="total_quantity" type="text" placeholder="Total quantity" class="form-control" value="<?= $packing_shipment_detail[0]->total_quantity ?>" readonly/>
                            </div>
                            <div class="col-lg-12">
                                <label for="gross_weight" class="control-label">Gross Wt.</label>
                                <input id="gross_weight" name="gross_weight" type="text" placeholder="Gross Wt." class="form-control" value="<?= $packing_shipment_detail[0]->gross_weight ?>" readonly />
                            </div>
                            <div class="col-lg-12">
                                <label for="net_weight" class="control-label">Net Wt.</label>
                                <input id="net_weight" name="net_weight" type="text" placeholder="Net Wt." class="form-control" value="<?= $packing_shipment_detail[0]->net_weight ?>" readonly/>
                            </div>
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Packing/Shipment details for: <?= $packing_shipment_detail[0]->package_name ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_issue_challan_add" data-toggle="tab">Add</a></li>
                                <li><a href="#cut_issue_challan_edit" data-toggle="tab">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="office_proforma_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>CN#</th>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Item</th>
                                                <th>Reference</th>
                                                <th>Box Size</th>
                                                <th>Quantity</th>
                                                <th>Gross Weight</th>
                                                <th>Net Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="cut_issue_challan_add" class="tab-pane fade">
                                    <br/>
 <hr/>
                                    <div class="form" style="background: #d0e4f5;padding: 1%;">
                                        <form id="form_add_for_same_cartoon" method="post" action="<?=base_url('admin/form-add-details-for-same-cartoon')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="form-group ">
                                                    <div class="col-lg-4">
                                                        <label for="repeative_cartoon_no" style="display: block" class="control-label text-danger text-right"><b>Select Cartoon Number For repetative order* </b></label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select id="repeative_cartoon_no" name="repeative_cartoon_no" class="form-control select2">
                                                            <option value="">Select Cartoon No</option>
                                                            <?php
                                                            foreach($for_carton_number as $f_c_n){
                                                            ?> 
                                                            <option value="<?= $f_c_n->carton_number ?>"><?=$f_c_n->carton_number?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                         </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label for="old_carton_number_repeatitive" style="display: block" class="control-label text-danger text-right"><b>Carton Number*</b> </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input id="old_carton_number_repeatitive" name="old_carton_number_repeatitive" type="text" placeholder="New Carton Number" class="form-control round-input" value="" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="hidden" id="packing_shipment_id_add_for_caroon" name="packing_shipment_id_add_for_caroon" class="hidden" value="<?= $packing_shipment_detail[0]->packing_shipment_id ?>" />
                                                        <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="copy_packing_details"><i class="fa fa-plus"></i> Copy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
<hr>


                                    <div class="form">
                                        <form id="form_add_packing_shipment_details" method="post" action="<?=base_url('admin/form-add-packing-shipment-details')?>" class="cmxform form-horizontal tasi-form">

                                            <div class="form-group ">
                                            <div class="col-lg-2 carton_number_select_tag">
                                                    <label for="old_carton_number" class="control-label">Carton Number</label>
                                                    <input id="old_carton_number" name="old_carton_number" type="text" placeholder="Carton Number" class="form-control round-input" value="" />
                                                </div>
                                            <div class="col-lg-3 order_no_select_tag">
                                                <label for="co_id" class="control-label text-danger">Order No*</label>
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
                                            
                                            <div class="col-lg-3 article_no_select_tag">
                                                <label for="cod_id" class="control-label text-danger">Article Number & Colour*</label>
                                                <select id="cod_id" name="cod_id" class="form-control select2">
                                                    <option value="">Select Article Number</option>
                                                 </select>
                                            </div>

                                            <input id="am_id" name="am_id" type="hidden" class="form-control round-input" value="" />
                                                 <input id="lc_id" name="lc_id" type="hidden" class="form-control round-input" value="" />
                                                 <input id="fc_id" name="fc_id" type="hidden" class="form-control round-input" value="" />
                                            
                                                <div class="col-lg-2">
                                                    <label for="gross_weight_per_carton" class="control-label">Gross weight/Carton</label>
                                                    <input id="gross_weight_per_carton" name="gross_weight_per_carton" type="text" placeholder="Gross weight/Carton" class="form-control round-input" value="0.0" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="number_of_article_per_carton" class="control-label">Number of Article/Carton</label>
                                                    <input id="number_of_article_per_carton" name="number_of_article_per_carton" type="text" placeholder="Number of Article/Carton" class="form-control round-input" value="" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="item" class="control-label">Item</label>
                                                    <input id="item" name="item" type="text" placeholder="Item" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="reference" class="control-label">Reference</label>
                                                    <input id="reference" name="reference" type="text" placeholder="Reference" class="form-control round-input" value="" />
                                                </div>
                                            
                                                <div class="col-lg-3">
                                                    <label for="box_size" class="control-label">Box size</label>
                                                    <input id="carton_item" name="carton_item" type="text" placeholder="Box size" class="form-control round-input" value="" />
                                                    <input id="box_size" name="box_size" type="hidden" placeholder="Box size" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="leather" class="control-label">Leather</label>
                                                    <input id="leather" name="leather" type="text" placeholder="Leather" class="form-control round-input" value="" />
                                                </div>
                                               </div>
                                            
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="fitting" class="control-label">Fitting</label>
                                                    <input id="fitting" name="fitting" type="text" placeholder="Fitting" class="form-control round-input" value="" />
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <label for="article_quantity" class="control-label">Order Quantity</label>
                                                    <input id="article_quantity" name="article_quantity" type="text" placeholder="Quantity" class="form-control round-input" value="" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="remain_article_to_pack" class="control-label text-danger">Remain Article to Pack*</label>
                                                    <input id="remain_article_to_pack" name="remain_article_to_pack" type="text" required placeholder="Remain Article to Pack" class="form-control round-input" value="" />
                                                    <input id="remain_article_to_pack_hidden" name="remain_article_to_pack_hidden" type="hidden" placeholder="Remain Article to Pack" class="form-control round-input" value="" />
                                                </div>
                                                
                                                
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <input type="hidden" id="packing_shipment_id_add" name="packing_shipment_id_add" class="hidden" value="<?= $packing_shipment_detail[0]->packing_shipment_id ?>" />
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="add_packing_details"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            
                                            
                                        </form>
                                        <table id="office_proforma_details_table1" class="table data-table dataTable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>CN#</th>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Item</th>
                                                <th>Reference</th>
                                                <th>Box Size</th>
                                                <th>Quantity</th>
                                                <th>Gross Weight</th>
                                                <th>Net Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                                <div id="cut_issue_challan_edit" class="tab-pane fade">
                                    <br/>
                                    <table id="detail_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>CN#</th>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Item</th>
                                                <th>Reference</th>
                                                <th>Box Size</th>
                                                <th>Quantity</th>
                                                <th>Gross Weight</th>
                                                <th>Net Weight</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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

        $(document).on('change', '#repeative_cartoon_no', function(){
 
            $val = $(this).val();

            if($val != '') {

$('#copy_packing_details').prop('disabled', false);

        }

        });

    });

</script>

<script>
    $(document).ready(function() {
        $packing_shipment_id = $('#packing_shipment_id').val();      
        $table_str = '';
        $.ajax({
            url: "<?= base_url('admin/ajax-all-packing-shipment-details') ?>",
            method: "post",
            dataType: 'json',
            data: {'packing_shipment_id': $packing_shipment_id},  
            success: function(result){
                console.log(JSON.stringify(result));
                $("#detail_table").html("");
                $table_str += '<table class="table">';
                  $table_str += '<thead>';
                    $table_str += '<tr>';
                      $table_str += '<th scope="col">CN#</th>';
                      $table_str += '<th scope="col">Order Number</th>';
                      $table_str += '<th scope="col">Article Number</th>';
                      $table_str += '<th scope="col">Leather Color</th>';
                      $table_str += '<th scope="col">Item</th>';
                      $table_str += '<th scope="col">Reference</th>';
                      $table_str += '<th scope="col">Box Size</th>';
                      $table_str += '<th scope="col">Quantity</th>';
                      $table_str += '<th scope="col">Gross Weight</th>';
                      $table_str += '<th scope="col">Net Weight</th> ';                                         
                    $table_str += '</tr>';
                  $table_str += '</thead>';
                  $table_str += '<tbody>';
                  
                $.each(result, function(index, item) {
                    //console.log('item: '+item);

                    $table_str += '<tr>';
                      $table_str += '<th scope="row"><input id="pack_detail_'+item.packing_shipment_detail_id+'" name="carton_number" class="carton_number" type="number" value="'+item.carton_number+'" style="width: 60%;"/><input id="pack_detail_'+item.packing_shipment_detail_id+'" name="pack_detail" class="pack_detail" type="hidden" value="'+item.packing_shipment_detail_id+'"/><input id="pack_id_'+item.packing_shipment_id+'" name="pack_id" class="pack_id" type="hidden" value="'+item.packing_shipment_id+'"/></th>';
                      $table_str += '<td>'+item.co_no+'<input id="pack_'+item.packing_shipment_detail_id+'" name="pack" type="hidden" value="'+item.packing_shipment_id+'"/><input id="co_'+item.packing_shipment_detail_id+'" name="co" class="co" type="hidden" value="'+item.co_id+'"/></td>';
                      $table_str += '<td>'+item.art_no+'<input id="cod_'+item.packing_shipment_detail_id+'" name="cod" type="hidden" value="'+item.cod_id+'"/><input id="am_'+item.packing_shipment_detail_id+'" name="am" class="am" type="hidden" value="'+item.am_id+'"/></td>';
                      $table_str += '<td>'+item.leather_color+'<input id="lc_id_'+item.packing_shipment_detail_id+'" name="lc_id" class="lc_id" type="hidden" value="'+item.lc_id+'"/></td>';
                      $table_str += '<td><input id="item_no_'+item.packing_shipment_detail_id+'" name="item_no" class="item_no" type="text" value="'+item.item+'" style="width: 100%;"/></td>';
                      $table_str += '<td><input id="refn_'+item.packing_shipment_detail_id+'" name="refn" class="refn" type="text" value="'+item.reference+'" style="width: 100%;"/></td>';
                      $table_str += '<td>'+item.box_size+'</td>';
                      $table_str += '<td><input id="quantity_'+item.packing_shipment_detail_id+'" name="quantity" class="quantity" type="number" value="'+Math.round(item.article_quantity)+'" style="width: 60%;"/></td>';
                      $table_str += '<td><input id="gross_'+item.packing_shipment_detail_id+'" name="gross" class="gross" type="number" value="'+item.gross_weight+'" style="width: 60%;"/></td>';
                      $table_str += '<td><input id="net_'+item.packing_shipment_detail_id+'" name="net" class="net" type="number" value="'+item.net_weight+'" style="width: 60%;" readonly/></td>';
                      $table_str += '<td><input id="update_'+item.packing_shipment_detail_id+'" name="update_btn" class="update_btn btn-success" type="submit" value="update"/></td>';
                      $table_str += '<td><input id="delete_'+item.packing_shipment_detail_id+'" name="delete_pack_list_btn" class="delete_pack_list_btn btn-danger" type="submit" value="delete"/></td>';
                    $table_str += '</tr>'; 
                    });
                    $table_str += '</tbody>';
                $table_str += '</table>';
                
                $("#detail_table").html($table_str);
                
            },
            error: function(e){console.log(e);}
        });
    });
</script>

<script>
    
    $(document).ready(function() {

        $(document).on('click', '.update_btn', function(){
            $pack_detail_id = $(this).closest('#detail_table tbody tr').find('.pack_detail').val();
            $pack_id = $(this).closest('#detail_table tbody tr').find('.pack_id').val();
            $quantity = $(this).closest('#detail_table tbody tr').find('.quantity').val();
            $gross_weight = $(this).closest('#detail_table tbody tr').find('.gross').val();
            $net_weight = $(this).closest('#detail_table tbody tr').find('.net').val();
            $co_id = $(this).closest('#detail_table tbody tr').find('.co').val();
            $am_id = $(this).closest('#detail_table tbody tr').find('.am').val();
            $lc_id = $(this).closest('#detail_table tbody tr').find('.lc_id').val();
            $carton_number = $(this).closest('#detail_table tbody tr').find('.carton_number').val();
            $refn = $(this).closest('#detail_table tbody tr').find('.refn').val();
            $item_no = $(this).closest('#detail_table tbody tr').find('.item_no').val();

            $.ajax({
                url: "<?= base_url('admin/update-packing-shipment-detail-wrt-shipment-id') ?>",
                method: "post",
                dataType: 'json',
                data: {'pack_detail_id': $pack_detail_id, 'pack_id': $pack_id, 'quantity': $quantity, 'gross_weight': $gross_weight, 'net_weight': $net_weight, 'co_id': $co_id, 'am_id': $am_id, 'lc_id': $lc_id, 'carton_number': $carton_number, 'refn': $refn, 'item_no': $item_no},
                success: function(returnData){
                    // console.log('RD => ' + returnData);
                    var string1 = JSON.stringify(returnData);

                    obj = JSON.parse(string1);
                                // console.log('RD => ' + obj);
                                // console.log(JSON.stringify(returnData));

                                // obj = JSON.stringify(returnData);

            $('#total_quantity').val(obj.total_quantity_new);
            $('#gross_weight').val(obj.gross_weight_new);
            $('#net_weight').val(obj.net_weight_new);
            $(this).closest('#detail_table tbody tr').find('.quantity').val(obj.total_quantity_new1);
            $(this).closest('#detail_table tbody tr').find('.gross').val(obj.gross_weight_new1);
            $(this).closest('#detail_table tbody tr').find('.net').val(obj.net_weight_new1)
            
            notification(obj);
            
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            $('#office_proforma_details_table1').DataTable().ajax.reload();
                },
                error: function(e){console.log(e);}
            });

        });

        });

</script>

<script>
    
    $(document).ready(function() {

        $(document).on('click', '.delete_pack_list_btn', function(){
            $pack_detail_id = $(this).closest('#detail_table tbody tr').find('.pack_detail').val();
            $pack_id = $(this).closest('#detail_table tbody tr').find('.pack_id').val();
            $quantity = $(this).closest('#detail_table tbody tr').find('.quantity').val();
            $gross_weight = $(this).closest('#detail_table tbody tr').find('.gross').val();
            $net_weight = $(this).closest('#detail_table tbody tr').find('.net').val();
            $co_id = $(this).closest('#detail_table tbody tr').find('.co').val();
            $am_id = $(this).closest('#detail_table tbody tr').find('.am').val();
            $lc_id = $(this).closest('#detail_table tbody tr').find('.lc_id').val();
            $delete_id = $(this).closest('#detail_table tbody tr').attr('id');
            $this = $(this);

            $.ajax({
                url: "<?= base_url('admin/delete-packing-shipment-detail-wrt-shipment-id') ?>",
                method: "post",
                dataType: 'json',
                data: {'pack_detail_id': $pack_detail_id, 'pack_id': $pack_id, 'quantity': $quantity, 'gross_weight': $gross_weight, 'net_weight': $net_weight, 'co_id': $co_id, 'am_id': $am_id, 'lc_id': $lc_id},
                success: function(returnData){
                    // console.log('RD => ' + returnData);
                    var string1 = JSON.stringify(returnData);

                    obj = JSON.parse(string1);
                                // console.log('RD => ' + obj);
                                // console.log(JSON.stringify(returnData));

                                // obj = JSON.stringify(returnData);
            $this.closest('tr').remove();
            $('#total_quantity').val(obj.total_quantity_new);
            $('#gross_weight').val(obj.gross_weight_new);
            $('#net_weight').val(obj.net_weight_new);

            notification(obj);
            
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            $('#office_proforma_details_table1').DataTable().ajax.reload();
                },
                error: function(e){console.log(e);}
            });

        });

        });

</script>

<script>
    
    $(document).ready(function() {
        $('#office_proforma_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-packing-shipment-detail-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    packing_shipment_id: function () {
                        return $("#packing_shipment_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "carton_number" },
                { "data": "order_number" },
                { "data": "article_number" },
                { "data": "leather_color" },
                { "data": "item" },
                { "data": "reference" },
                { "data": "box_size" },
                { "data": "quantity" },
                { "data": "gross_weight" },
                { "data": "net_weight" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3, 4, 5, 6, 9],
                "orderable": false,
            }]
        } );  
    });

    $(document).ready(function() {
        $('#office_proforma_details_table1').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-packing-shipment-detail-table-data-second')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    packing_shipment_id: function () {
                        return $("#packing_shipment_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "carton_number" },
                { "data": "order_number" },
                { "data": "article_number" },
                { "data": "leather_color" },
                { "data": "item" },
                { "data": "reference" },
                { "data": "box_size" },
                { "data": "quantity" },
                { "data": "gross_weight" },
                { "data": "net_weight" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3, 4, 5, 6, 9],
                "orderable": false,
            }]
        } );  
    });

// all items-on-item-group -> from Transaction controller 

    $("#cod_id").change(function(){
        $cod_id = $(this).val();
        
        $('#add_packing_details').prop('disabled', false);

        $.ajax({
                url: "<?= base_url('admin/packing-shipment-get-customer-order-dtl-wrt-cod') ?>",
                method: "post",
                dataType: 'json',
                data: {'cod_id': $cod_id},
                success: function(all_orders){

        $('#number_of_article_per_carton').val(all_orders.number_of_article_per_carton);
        $('#article_quantity').val(all_orders.co_quantity);
        $('#box_size').val(all_orders.carton_id);
        $('#carton_item').val(all_orders.carton_item);
        $('#am_id').val(all_orders.am_id);
        $('#lc_id').val(all_orders.lc_id);
        $('#fc_id').val(all_orders.fc_id);
        $('#remain_article_to_pack').val(all_orders.remain_article_to_pack);
        $('#remain_article_to_pack_hidden').val(all_orders.remain_article_to_pack);

                },
                error: function(e){console.log(e);}
            });
        
    });
    
    //get customer order details
    $ordersArray = [];
    $prev_co_ids = [];
     
    $("#co_id").change(function(){
        $co_id = $('#co_id').val();
        
        $.ajax({
                url: "<?= base_url('admin/packing-shipment-get-customer-order-dtl') ?>",
                method: "post",
                dataType: 'json',
                data: {'co_id': $co_id},
                success: function(all_orders){
                    
                    if(all_orders.length == 0){
                        alert('Order Details not available');   
                    }else{
                        $("#cod_id").html("");
                        $str = '<option value="">Select Customer Order</option>';
                        $("#cod_id").append($str);
                        $.each(all_orders, function(index, item) {
                            
                            $str = '<option value=' + item.cod_id + ' gross_weight_per_carton='+item.gross_weight_per_carton+' number_of_article_per_carton='+item.number_of_article_per_carton+' carton_id='+item.carton_id+' co_quantity='+item.co_quantity+' am_id='+item.am_id+' lc_id='+item.lc_id+' fc_id='+item.fc_id+' remain_article_to_pack='+item.remain_article_to_pack+' carton_item='+item.carton_item+'> '+ item.art_no + '['+item.leather_color+' - '+item.leather_code+']</option>';
                            $("#cod_id").append($str);
                        });
                        $('#cod_id').select2('open');

                    }//end if
                },
                error: function(e){console.log(e);}
            });
                    
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
    $("#remain_article_to_pack").on('change', function () {
        $remain_article_to_pack = $("#remain_article_to_pack").val();
        $remain_article_to_pack_hidden = $("#remain_article_to_pack_hidden").val();
       
       if(parseFloat($remain_article_to_pack) > parseFloat($remain_article_to_pack_hidden)){
           alert('Remain article quantity maximum: '+$remain_article_to_pack_hidden);
           $("#remain_article_to_pack").val($remain_article_to_pack_hidden);
          }
    });
// EDIT - multiply for item_amount
    $("#remain_article_to_pack_edit").on('change', function () {
        $remain_article_to_pack_edit = $("#remain_article_to_pack_edit").val();
        $remain_article_to_pack_hidden_edit = $("#remain_article_to_pack_hidden_edit").val();
        $remain_article_to_pack_hidden_edit_old = $("#remain_article_to_pack_hidden_edit_old").val();
        
        $max_allow_qty = parseFloat($remain_article_to_pack_hidden_edit) + parseFloat($remain_article_to_pack_hidden_edit_old);
        
        if(parseFloat($remain_article_to_pack_edit) > parseFloat($max_allow_qty)){
            alert('Remain article quantity maximum: '+$max_allow_qty);
            $("#remain_article_to_pack_edit").val($remain_article_to_pack_hidden_edit_old);
        }
    });

    
    $("#form_edit_packing_shipment").validate({
        rules: {
            package_name: {
                required: true
            },
            package_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_packing_shipment').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_packing_shipment").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            
            //console.log(returnData);
        }
    });

$("#form_add_for_same_cartoon").validate({
        rules: {
            repeative_cartoon_no: {
                required: true
            },
            old_carton_number_repeatitive: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_for_same_cartoon').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_for_same_cartoon").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);

            $('#copy_packing_details').prop('disabled', true);

            $('#total_quantity').val(obj.total_quantity_new);
            $('#gross_weight').val(obj.gross_weight_new);
            $('#net_weight').val(obj.net_weight_new);

            $('#office_proforma_details_table').DataTable().ajax.reload();
            $('#office_proforma_details_table1').DataTable().ajax.reload();
            
            //console.log(returnData);
        }
    });
    //add-purchase order details-form validation and submit
    $("#form_add_packing_shipment_details").validate({
        rules: {
            co_id: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_packing_shipment_details').ajaxForm({
        beforeSubmit: function () {
            $('#add_packing_details').prop('disabled', true);
            return $("#form_add_packing_shipment_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            
            $('#total_quantity').val(obj.total_quantity_new);
            $('#gross_weight').val(obj.gross_weight_new);
            $('#net_weight').val(obj.net_weight_new);
            
            $ordersArray = [];
            $prev_co_ids = [];  
            var table = '';
            $('#co_dtl_tbl').html(table);
            // $("#form_add_packing_shipment_details").validate().resetForm(); //reset validation
            $('#gross_weight_per_carton').val('0.0');
            $('#old_carton_number').val('');
            $('#number_of_article_per_carton').val('');
            $('#item').val('');
            $('#reference').val('');
            $('#carton_item').val('');
            $('#leather').val('');
            $('#fitting').val('');
            $('#article_quantity').val('');
            $('#remain_article_to_pack').val('');
            $("#old_carton_number").focus();
            $('#cod_id').val(null).trigger('change');
            
            // $('#cod_id').select2('open');
            $("#old_carton_number").focus();
            
            notification(obj);
            
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            $('#office_proforma_details_table1').DataTable().ajax.reload();
            
        }
    });

    //saveData
    
    //edit-purchase order details-form validation and submit
    $("#form_edit_packing_shipment_details").validate({
        rules: {
            pod_quantity: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_packing_shipment_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_packing_shipment_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            $('#total_quantity').val(obj.total_quantity_new);
            $('#gross_weight').val(obj.gross_weight_new);
            $('#net_weight').val(obj.net_weight_new);

            $('#form_add_packing_shipment_details')[0].reset(); //reset form
            $("#form_add_packing_shipment_details").validate().resetForm(); //reset validation
            notification(obj);
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#office_proforma_details_table").on('click', '.packing_shipment_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $packing_shipment_detail_id = $(this).attr('packing_shipment_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-packing-shipment-edit-data') ?>",
            method: "post",
            dataType: 'json',
            data: {'packing_shipment_detail_id': $packing_shipment_detail_id,},
            success: function(shipment_detail){
                console.log(JSON.stringify(shipment_detail));
                data = shipment_detail[0];
                
                $("#co_id_edit").html("<option>"+data.co_no+"</option>").trigger('change');
                $("#cod_id_edit").html("<option>"+data.art_no+"</option>").trigger('change');
                
                $("#gross_weight_per_carton_edit").val(data.gross_weight);
                $("#gross_weight_hidden").val(data.gross_weight);
                $("#net_weight_per_carton_edit").val(data.net_weight);
                $("#net_weight_hidden").val(data.net_weight);
                
                $("#number_of_article_per_carton_edit").val(data.article_quantity);
                $("#item_edit").val(data.item);
                $("#reference_edit").val(data.reference);
                $("#box_size_edit").val(data.box_size);
                $("#carton_item_edit").val(data.carton_item);
                $("#leather_edit").val(data.leather);
                $("#fitting_edit").val(data.fitting);
                $("#article_quantity_edit").val(data.co_quantity);
                $("#remain_article_to_pack_edit").val(data.article_quantity);
                $("#remain_article_to_pack_hidden_edit_old").val(data.article_quantity);
                $("#remain_article_to_pack_hidden_edit").val(data.remain_article_to_pack);
                
                $("#packing_shipment_detail_id").val(data.packing_shipment_detail_id);
                $("#packing_shipment_id_edit_hidden").val(data.packing_shipment_id);
                

                $('#supp_po_details_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                // $('a[href="#cut_issue_challan_edit"]').tab('show');
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
            "showDuration": "100",
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
            $gross_weight = $(this).attr('gross_weight');
            $net_weight = $(this).attr('net_weight');
            
            $.ajax({
                url: "<?= base_url('admin/del-packing-shipment-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, tab_val: $tab_val, data_tab: $data_tab, data_pk : $data_pk, data_tab_val: $data_tab_val, quantity: $quantity, gross_weight: $gross_weight, net_weight: $net_weight},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    //obj = JSON.parse(returnData);
                    $('#total_quantity').val(returnData.total_quantity_new);
                    $('#gross_weight').val(returnData.gross_weight_new);
                    $('#net_weight').val(returnData.net_weight_new);
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
