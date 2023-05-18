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
    <title>Edit Courier Shipment | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Edit Courier Shipment</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Courier Shipment </li>
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
                            Edit: <?= $courier_shipment_detail[0]->invoice_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">

                            <form id="form_edit_courier_shipment" method="post" action="<?=base_url('admin/form-edit-courier-shipment')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-3">
                                	<label for="invoice_no" class="control-label text-danger">Invoice No *</label>
                                	<input id="invoice_no" name="invoice_no" value="<?= $courier_shipment_detail[0]->invoice_no ?>" type="text" placeholder="Invoice No" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="invoice_date" class="control-label text-danger">Invoice Date *</label>
                                    <input id="invoice_date" name="invoice_date" value="<?= date('Y-m-d', strtotime($courier_shipment_detail[0]->invoice_date)) ?>" type="date" class="form-control round-input" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="shipment_through" class="control-label">Through:</label>
                                    <select id="shipment_through" name="shipment_through" class="form-control select2">
                                        <option value="">Select Curier</option>
                                        <option value="1" <?php if($courier_shipment_detail[0]->shipment_through == 1){ ?> selected <?php } ?>>DTDC</option>
                                        <option value="2" <?php if($courier_shipment_detail[0]->shipment_through == 2){ ?> selected <?php } ?>>DHL</option>
                                        <option value="3" <?php if($courier_shipment_detail[0]->shipment_through == 3){ ?> selected <?php } ?>>TNT</option>
                                        <option value="4" <?php if($courier_shipment_detail[0]->shipment_through == 4){ ?> selected <?php } ?>>UPS</option>
                                        <option value="5" <?php if($courier_shipment_detail[0]->shipment_through == 5){ ?> selected <?php } ?>>Blue dart</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="am_id" class="control-label">Select Party:</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Party</option>
                                        <?php
											foreach($account_master_details as $amd){
												$sn = ($amd->short_name == '' ? '-' : $amd->short_name);
											?> 
												<option value="<?= $amd->am_id ?>" short_name="<?=$amd->short_name?>" am_code="<?=$amd->am_code?>" <?php if($courier_shipment_detail[0]->am_id == $amd->am_id){ ?> selected <?php } ?>><?= $amd->name . ' ['. $sn .']' ?></option>
												<?php
											}
										?>
                                    </select>
                                </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="awb_number" class="control-label">AWB No.</label>
                                        <input id="awb_number" name="awb_number" value="<?=$courier_shipment_detail[0]->awb_number ?>" type="text" placeholder="AWB No." class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="pickup_time" class="control-label">Pick up time</label>
                                        <input id="pickup_time" name="pickup_time" value="<?=$courier_shipment_detail[0]->pickup_time ?>" type="text" placeholder="Pick up time" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="weight" class="control-label">Weight</label>
                                        <input id="weight" name="weight" value="<?=$courier_shipment_detail[0]->weight ?>" type="text" placeholder="Weight" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="booking_no" class="control-label">Booking No.</label>
                                        <input id="booking_no" name="booking_no" value="<?=$courier_shipment_detail[0]->booking_no ?>" type="text" placeholder="Booking No." class="form-control round-input" />
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label for="leather_type" class="control-label">Leather Type</label>
                                        <input id="leather_type" name="leather_type" value="<?=$courier_shipment_detail[0]->leather_type ?>" type="text" placeholder="Leather Type" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="box_dimention" class="control-label">Dimension</label>
                                        <input id="box_dimention" name="box_dimention" value="<?=$courier_shipment_detail[0]->box_dimention ?>" type="text" placeholder="Dimension" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="remarks" class="control-label">Remark</label>
                                        <textarea id="remarks" name="remarks" placeholder="Remark" class="form-control round-input"><?=$courier_shipment_detail[0]->remarks ?></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="pieces" class="control-label">Pieces</label>
                                        <input id="pieces" name="pieces" value="<?=$courier_shipment_detail[0]->pieces ?>" type="text" placeholder="Pieces" class="form-control round-input" />
                                    </div>                                
                                </div>
                                
                                <div class="form-group ">
                                	<div class="col-lg-3">
                                        <label for="total_foreign_amount" class="control-label">Total Foregin Amount</label>
                                        <input id="total_foreign_amount" name="total_foreign_amount" value="<?=$courier_shipment_detail[0]->total_foreign_amount ?>" type="text" placeholder="Total Foregin Amount" class="form-control round-input" />
                                    </div>
                                </div>                            
                            
                            <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Courier Shipment</i></button>
                                    </div>
                                </div> 
                                <input type="hidden" id="courier_shipment_id" name="courier_shipment_id" class="hidden" value="<?= $courier_shipment_detail[0]->courier_shipment_id ?>" />
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
                                <input id="total_quantity" name="total_quantity" type="text" placeholder="Total quantity" class="form-control" value="<?= $courier_shipment_detail[0]->total_quantity ?>" readonly/>
                            </div>
                            <div class="col-lg-12">
                                <label for="total_amount" class="control-label">Total Amount</label>
                                <input id="total_amount" name="total_amount" type="text" placeholder="Total Amount" class="form-control" value="<?= $courier_shipment_detail[0]->total_amount ?>" readonly />
                            </div>
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Courier Shipment details for: <?= $courier_shipment_detail[0]->invoice_no ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_issue_challan_add" data-toggle="tab">Add</a></li>
                                <li id="supp_po_details_edit_tab" class="disabled"><a href="#cut_issue_challan_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="office_proforma_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Article</th>
                                                <th>Article Description</th>
                                                <th>Article Color</th>
                                                <th>Article Quantity</th>
                                                <th>Price (INR)</th>
                                                <th>Price (FOR.)</th>
                                                <th>HS Code</th>
                                                <th>Remarks</th>
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
                                        <form id="form_add_courier_shipment_details" method="post" action="<?=base_url('admin/form-add-courier-shipment-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                            
                                            
                                            <div class="col-lg-3">
                                                <label for="cod_id" class="control-label text-danger">Article Number & Colour*</label>
                                                <select id="cod_id" name="cod_id" class="form-control select2">
                                                    <option value="">Select Article Number</option>
                                                    <option value="64">demo 001</option>
                                                 </select>
                                                 <input id="am_id" name="am_id" type="hidden" class="form-control round-input" value="10" />
                                                 
                                            </div> 
                                             <div class="col-lg-3">
                                                <label for="info" class="control-label">Article description</label>
                                                <input id="info" name="info" type="text" placeholder="Article description" class="form-control round-input" value="" />
                                              </div>
                                            
                                                <div class="col-lg-3">
                                                <label for="leather_colour" class="control-label">Article colour</label>
                                                <input id="leather_colour" name="leather_colour" type="text" placeholder="Article colour" class="form-control round-input" value="RED" />
                                                <input id="lc_id" name="lc_id" type="hidden" class="form-control round-input" value="1" />
                                                 <input id="fc_id" name="fc_id" type="hidden" class="form-control round-input" value="46" />
                                              </div>
                                              
                                                <div class="col-lg-3">
                                                    <label for="article_quantity" class="control-label">Article Quantity</label>
                                                    <input id="article_quantity" name="article_quantity" type="text" placeholder="Article Quantity" class="form-control round-input" value="" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="price_inr" class="control-label">Price (INR)</label>
                                                    <input id="price_inr" name="price_inr" type="text" placeholder="Price (INR)" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="price_foreign" class="control-label">Price (FOR.)</label>
                                                    <input id="price_foreign" name="price_foreign" type="text" placeholder="Price (FOR.)" class="form-control round-input" value="" />
                                                </div>
                                            
                                                <div class="col-lg-3">
                                                    <label for="hs_code" class="control-label">HS Code</label>
                                                    <input id="hs_code" name="hs_code" type="text" placeholder="HS Code" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="remarks" class="control-label">Remarks</label>
                                                    <input id="remarks" name="remarks" type="text" placeholder="Remarks" class="form-control round-input" value="" />
                                                </div>
                                               </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <input type="hidden" id="courier_shipment_id_add" name="courier_shipment_id_add" class="hidden" value="<?= $courier_shipment_detail[0]->courier_shipment_id ?>" />
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_challan_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_courier_shipment_details" method="post" action="<?=base_url('admin/form-edit-courier-shipment-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                            <div class="col-lg-3">
                                                <label for="cod_id_edit" class="control-label text-danger">Article Number & Colour*</label>
                                                <select id="cod_id_edit" name="cod_id_edit" class="form-control select2">
                                                    <option value="">Select Article Number</option>
                                                    <option value="64">demo 001</option>
                                                 </select>
                                                 <input id="am_id_edit" name="am_id_edit" type="hidden" class="form-control round-input" value="" />
                                                 
                                            </div> 
                                             <div class="col-lg-3">
                                                <label for="info_edit" class="control-label">Article description</label>
                                                <input id="info_edit" name="info_edit" type="text" placeholder="Article description" class="form-control round-input" value="" />
                                              </div>
                                            
                                                <div class="col-lg-3">
                                                <label for="leather_colour_edit" class="control-label">Article colour</label>
                                                <input id="leather_colour_edit" name="leather_colour_edit" type="text" placeholder="Article colour" class="form-control round-input" value="RED" />
                                                <input id="lc_id_edit" name="lc_id_edit" type="hidden" class="form-control round-input" value="1" />
                                                 <input id="fc_id_edit" name="fc_id_edit" type="hidden" class="form-control round-input" value="46" />
                                              </div>
                                              
                                                <div class="col-lg-3">
                                                    <label for="article_quantity_edit" class="control-label">Article Quantity</label>
                                                    <input id="article_quantity_edit" name="article_quantity_edit" type="text" placeholder="Article Quantity" class="form-control round-input" value="" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="price_inr_edit" class="control-label">Price (INR)</label>
                                                    <input id="price_inr_edit" name="price_inr_edit" type="text" placeholder="Price (INR)" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="price_foreign_edit" class="control-label">Price (FOR.)</label>
                                                    <input id="price_foreign_edit" name="price_foreign_edit" type="text" placeholder="Price (FOR.)" class="form-control round-input" value="" />
                                                </div>
                                            
                                                <div class="col-lg-3">
                                                    <label for="hs_code_edit" class="control-label">HS Code</label>
                                                    <input id="hs_code_edit" name="hs_code_edit" type="text" placeholder="HS Code" class="form-control round-input" value="" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="remarks_edit" class="control-label">Remarks</label>
                                                    <input id="remarks_edit" name="remarks_edit" type="text" placeholder="Remarks" class="form-control round-input" value="" />
                                                </div>
                                               </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="courier_shipment_detail_id_hidden" id="courier_shipment_detail_id_hidden" class="hidden" value="" />
                                            <input type="hidden" name="courier_shipment_id_hidden" id="courier_shipment_id_hidden" class="hidden" value="" />
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
                "url": "<?=base_url('admin/ajax-courier-shipment-detail-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    courier_shipment_id: function () {
                        return $("#courier_shipment_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "article_name" },
                { "data": "article_description" },
                { "data": "article_color" },
                { "data": "article_quantity" },
				{ "data": "price_inr" },
                { "data": "price_foreign" },
				{ "data": "hs_code" },
				{ "data": "remarks" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [2,7,8],
                "orderable": false,
            }]
        } );  
    });

// all items-on-item-group -> from Transaction controller 

    /*$("#cod_id").change(function(){
        $cod_id = $(this).val();
		
		$gross_weight_per_carton = $('option:selected', this).attr('gross_weight_per_carton');
		$number_of_article_per_carton = $('option:selected', this).attr('number_of_article_per_carton');
		$co_quantity = $('option:selected', this).attr('co_quantity');
		$carton_item = $('option:selected', this).attr('carton_item');
		$carton_id = $('option:selected', this).attr('carton_id');
		$am_id = $('option:selected', this).attr('am_id');
		$lc_id = $('option:selected', this).attr('lc_id');
		$fc_id = $('option:selected', this).attr('fc_id');
		$remain_article_to_pack = $('option:selected', this).attr('remain_article_to_pack');
		
		$('#gross_weight_per_carton').val($gross_weight_per_carton);
		$('#number_of_article_per_carton').val($number_of_article_per_carton);
		$('#article_quantity').val($co_quantity);
		$('#box_size').val($carton_id);
		$('#carton_item').val($carton_item);
		$('#am_id').val($am_id);
		$('#lc_id').val($lc_id);
		$('#fc_id').val($fc_id);
		$('#remain_article_to_pack').val($remain_article_to_pack);
		$('#remain_article_to_pack_hidden').val($remain_article_to_pack);
    });*/
	
	 
	/*$("#co_id").change(function(){
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
					
    });*/
	
	/*function updateTotalRate(cod_id){
		$rate_foreign = $('#rate_foreign_'+cod_id).val();
		$co_quantity = $('#co_quantity_'+cod_id).val();
		
		if(parseFloat($rate_foreign) > 0 && parseFloat($co_quantity) > 0){
			$('#total_rate_'+cod_id).val(parseFloat($rate_foreign) * parseFloat($co_quantity));
		}
		console.log('cod_id: '+cod_id+' co_quantity: '+$co_quantity+' rate_foreign: '+$rate_foreign);
	}*///end function updateTotalRate

    /*$(document).on('change', '#id_id', function(){
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
    });*/


    // ADD - multiply for item_amount
    /*$("#remain_article_to_pack").on('change', function () {
        $remain_article_to_pack = $("#remain_article_to_pack").val();
        $remain_article_to_pack_hidden = $("#remain_article_to_pack_hidden").val();
       
	   if(parseFloat($remain_article_to_pack) > parseFloat($remain_article_to_pack_hidden)){
		   alert('Remain article quantity maximum: '+$remain_article_to_pack_hidden);
		   $("#remain_article_to_pack").val($remain_article_to_pack_hidden);
		  }
    });*/
	
	// EDIT - multiply for item_amount
    /*$("#remain_article_to_pack_edit").on('change', function () {
		$remain_article_to_pack_edit = $("#remain_article_to_pack_edit").val();
		$remain_article_to_pack_hidden_edit = $("#remain_article_to_pack_hidden_edit").val();
		$remain_article_to_pack_hidden_edit_old = $("#remain_article_to_pack_hidden_edit_old").val();
		
		$max_allow_qty = parseFloat($remain_article_to_pack_hidden_edit) + parseFloat($remain_article_to_pack_hidden_edit_old);
		
		if(parseFloat($remain_article_to_pack_edit) > parseFloat($max_allow_qty)){
			alert('Remain article quantity maximum: '+$max_allow_qty);
			$("#remain_article_to_pack_edit").val($remain_article_to_pack_hidden_edit_old);
		}
    });*/

    
    $("#form_edit_courier_shipment").validate({
        rules: {
            invoice_no: {
                required: true
            },
            invoice_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_courier_shipment').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_courier_shipment").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
			
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_courier_shipment_details").validate({
        rules: {
            cod_id: {
                required: true,
            }
        },
        messages: {

        }
    });
    $('#form_add_courier_shipment_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_courier_shipment_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			
			/*$('#total_quantity').val(obj.total_quantity_new);
			$('#gross_weight').val(obj.gross_weight_new);
			$('#net_weight').val(obj.net_weight_new);			
			$ordersArray = [];
			$prev_co_ids = [];	*/
			
			var table = '';
			$('#co_dtl_tbl').html(table);
            $("#form_add_courier_shipment_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            
        }
    });

	//saveData
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_courier_shipment_details").validate({
        rules: {
            cod_id_edit: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_courier_shipment_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_courier_shipment_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);

            /*$('#total_quantity').val(obj.total_quantity_new);
			$('#gross_weight').val(obj.gross_weight_new);
			$('#net_weight').val(obj.net_weight_new);*/

            $('#form_add_courier_shipment_details')[0].reset(); //reset form
            $("#form_add_courier_shipment_details").validate().resetForm(); //reset validation
            notification(obj);
            //refresh table
            $('#office_proforma_details_table').DataTable().ajax.reload();
            
        }
    });

    //article-costing-measurement edit button
    $("#office_proforma_details_table").on('click', '.courier_shipment_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $courier_shipment_detail_id = $(this).attr('courier_shipment_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-courier-shipment-edit-data') ?>",
            method: "post",
            dataType: 'json',
            data: {'courier_shipment_detail_id': $courier_shipment_detail_id,},
            success: function(shipment_detail){
                console.log(JSON.stringify(shipment_detail));
                data = shipment_detail[0];
                
                $("#cod_id_edit").html("<option>"+data.art_no+"</option>").trigger('change');
                $("#info_edit").val(data.info);
				$("#lc_id_edit").val(data.lc_id);
				$("#fc_id_edit").val(data.fc_id);
				$("#article_quantity_edit").val(data.article_quantity);
                $("#price_inr_edit").val(data.price_inr);
                $("#price_foreign_edit").val(data.price_foreign);
                $("#hs_code_edit").val(data.hs_code);
                $("#remarks_edit").val(data.remarks);
				
                $("#courier_shipment_detail_id_hidden").val(data.courier_shipment_detail_id);
				$("#courier_shipment_id_hidden").val(data.courier_shipment_id);
				

                $('#supp_po_details_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#cut_issue_challan_edit"]').tab('show');
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
			
			/*$data_tab = $(this).attr('data-tab');
			$data_pk = $(this).attr('data-pk');
			$data_tab_val = $(this).attr('data-tab-val');
			
			$quantity = $(this).attr('quantity');
			$gross_weight = $(this).attr('gross_weight');
			$net_weight = $(this).attr('net_weight');*/
			
            $.ajax({
                url: "<?= base_url('admin/del-courier-shipment-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, tab_val: $tab_val},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    //obj = JSON.parse(returnData);
					/*$('#total_quantity').val(returnData.total_quantity_new);
					$('#gross_weight').val(returnData.gross_weight_new);
					$('#net_weight').val(returnData.net_weight_new);*/
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
