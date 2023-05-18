<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last modified: 20-Feb-2021 at 11:30am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobber Challan Receipt Edit | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Jobber Challan Receipt Edit">

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
            <h3 class="m-b-less">Jobber Challan Receipt Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Jobber Challan Receipt Edit</li>
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
                            Edit: <?= $jobber_receipt_details[0]->jobber_receipt_challan_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_jobber_receipt_edit" method="post" action="<?=base_url('admin/form-jobber-receipt-edit')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                <div class="col-lg-4">
                                    <label for="am_id_add" class="control-label text-danger">Select Jobber *</label>
                                   <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Jobber</option>
                                            <?php
                                            foreach($account_master_details as $amd){
                                                $sn = ($amd->short_name == '' ? '-' : $amd->short_name);
                                            ?> 
                                                <option value="<?= $amd->am_id ?>" short_name="<?=$amd->short_name?>" am_code="<?=$amd->am_code?>" <?php if($jobber_receipt_details[0]->am_id == $amd->am_id){?> selected <?php } ?>><?= $amd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                    
                                	<div class="col-lg-4">
                                    <label for="jobber_receipt_challan_number" class="control-label text-danger">Jobber Receipt Number *</label>
                                    <input id="jobber_receipt_challan_number" name="jobber_receipt_challan_number" type="text" placeholder="Jobber Receipt Number" class="form-control round-input" value="<?= $jobber_receipt_details[0]->jobber_receipt_challan_number ?>" />
                                    
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="jobber_receipt_challan_date" class="control-label text-danger">Receipt Date *</label>
                                        <input id="jobber_receipt_challan_date" name="jobber_receipt_challan_date" type="date" placeholder="Receipt Date" class="form-control round-input" value="<?= date('Y-m-d', strtotime($jobber_receipt_details[0]->jobber_receipt_challan_date)) ?>" />
                                    </div>
                                </div>
                                                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Jobber Receipt</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="jobber_challan_receipt_id" name="jobber_challan_receipt_id" class="hidden" value="<?= $jobber_receipt_details[0]->jobber_challan_receipt_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                
                <div class="col-md-2 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Total Quantity:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        
                        <div class="panel-body">
                            <p class='text-center'>
							<input id="total_jobber_quantity_receipt" name="total_jobber_quantity_receipt" type="text" placeholder="Total Qty. Received" class="form-control round-input" value="<?= $jobber_receipt_details[0]->total_jobber_quantity_receipt ?>" readonly />
							</p>
                            <hr />
                        </div>
                    </section>
                </div>
                
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Jobber Receipt Challan details for: <?= $jobber_receipt_details[0]->jobber_receipt_challan_number ?>
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
                                    <table id="skiving_issue_challan_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Customer Order Number</th>
                                                <th>Order Reference Number</th>
                                                <th>Jobber Challan Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Fitting Color</th>
                                                <th>Jobber Receive Quantity</th>
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
                                        <form id="form_add_jobber_receipt_challan_details" method="post" action="<?=base_url('admin/form-add-jobber-receipt-challan-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="co_id" class="control-label text-danger">Customer Order No*</label>
                                                    <select id="co_id" name="co_id" class="form-control select2">
                                                        <option value="">Select Customer Order</option>
														<?php
                                                        foreach($customer_order as $co){
                                                        ?> 
                                                        <option value="<?= $co->co_id ?>" buyer_reference_no="<?= $co->buyer_reference_no ?>"><?=$co->co_no?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                     </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="buyer_reference_no_add" class="control-label">Order reference number</label>
                                                    <input type="text" readonly="" id="buyer_reference_no_add" name="buyer_reference_no_add" class="form-control" />
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <label for="jobber_challan_number_add" class="control-label text-danger">Jobber Challan Number*</label>
                                                    <select id="jobber_challan_number_add" name="jobber_challan_number_add" class="form-control select2">
                                                        <!-- <option value="">Jobber Challan Number</option>
														
                                                        <?php
                                                        foreach($jobber_challan as $jc){
                                                        ?> 
                                                        <option value="<?= $jc->jobber_issue_id ?>" jobber_challan_number="<?= $jc->jobber_challan_number ?>"><?=$jc->jobber_challan_number?></option>
                                                        <?php
                                                        }
                                                        ?> -->
                                                     </select>
                                                </div>
                                                
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="jobber_issue_detail_id" class="control-label text-danger">Article Number*</label>
                                                    <select id="jobber_issue_detail_id" name="jobber_issue_detail_id" class="form-control select2">
                                                        <option value="">Select Article Number</option>
														
                                                     </select>
                                                     <input type="hidden" id="am_id_add" name="am_id_add" required class="form-control" readonly />
                                                     <input type="hidden" id="cod_id_add" name="cod_id_add" required class="form-control" readonly />
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
                                                    <label for="jobber_issue_quantity_add" class="control-label text-danger">Jobber Issue Quantity</label>
                                                    <input type="text" id="jobber_issue_quantity_add" name="jobber_issue_quantity_add" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="jobber_receive_quantity_add" class="control-label text-danger">Jobber Receipt Quantity</label>
                                                    <input type="text" id="jobber_receive_quantity_add" name="jobber_receive_quantity_add" required class="form-control" />
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="job_rcp_btn"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="jobber_challan_receipt_id" id="jobber_challan_receipt_id" class="hidden" value="<?= $jobber_receipt_details[0]->jobber_challan_receipt_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_receive_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                    <form id="form_edit_jobber_issue_challan_details" method="post" action="<?=base_url('admin/form-edit-jobber-issue-challan-details')?>" class="cmxform form-horizontal tasi-form">
                                        <div class="form-group ">
                                            <div class="col-lg-4">
                                                <label for="co_id_edit" class="control-label text-danger">Customer Order No*</label>
                                                <select id="co_id_edit" name="co_id_edit" class="form-control select2">
                                                    <option value="">Select Customer Order</option>
                                                 </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="customer_order_reference_number_edit" class="control-label text-danger">Order reference number</label>
                                                <input type="text" id="customer_order_reference_number_edit" name="customer_order_reference_number_edit" class="form-control" readonly />
                                            </div>
                                            
                                            <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                <label for="am_id_edit" class="control-label text-danger">Article Number*</label>
                                                <select id="am_id_edit" name="am_id_edit" class="form-control select2">
                                                    <option value="">Select Article Number</option>
                                                    
                                                 </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="lc_id_text_edit" class="control-label text-danger">Leather Colour</label>
                                                <input type="text" id="lc_id_text_edit" name="lc_id_text_edit" required class="form-control" readonly />
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="fc_id_text_edit" class="control-label text-danger">Fitting Colour</label>
                                                <input type="text" id="fc_id_text_edit" name="fc_id_text_edit" required class="form-control" readonly />
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="receive_cut_quantity_edit" class="control-label text-danger">Total Quantity</label>
                                                <input type="text" id="receive_cut_quantity_edit" name="receive_cut_quantity_edit" required class="form-control" readonly />
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="jobber_issue_quantity_edit" class="control-label text-danger">Jobber Issue Quantity</label>
                                                <input type="text" id="jobber_issue_quantity_edit" name="jobber_issue_quantity_edit" required class="form-control" />
                                                <input type="hidden" id="jobber_issue_quantity_edit_hidden" name="jobber_issue_quantity_edit_hidden" required class="form-control" />
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="jobber_emboss_edit" class="control-label text-danger">Jobber Emboss</label>
                                                <input type="text" id="jobber_emboss_edit" name="jobber_emboss_edit" required class="form-control" />
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-4 col-lg-offset-4">
                                                <label for="" class="control-label">&nbsp;</label><br>
                                                <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Edit details</button>
                                            </div>
                                        </div>
                                        <input type="text" name="jobber_challan_receipt_id" id="jobber_challan_receipt_id" class="hidden" value="<?= $jobber_receipt_details[0]->jobber_challan_receipt_id ?>" />
                                        <input type="text" name="jobber_challan_receipt_details_id" id="jobber_challan_receipt_details_id" class="hidden" value="" />
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
//Jobber 2
$("#am_id").change(function(){
        $am_id = $(this).val();
		$am_id_hidden = $('#am_id_hidden').val();
		$jobber_challan_number_hidden = $('#jobber_challan_number_hidden').val();
		
		console.log('am_id:'+$am_id+' am_id_hidden: '+$am_id_hidden);
		if(parseInt($am_id) > 0){
			if(parseInt($am_id) == parseInt($am_id_hidden)){
				$('#jobber_challan_number').val($jobber_challan_number_hidden);
			}else{
				$short_name = $('option:selected', this).attr('short_name');
				
				$.ajax({
					url: "<?= base_url('admin/ajax-jobber-challan-issue-number') ?>",
					method: "post",
					dataType: 'json',
					data: {'am_id': $am_id},
					success: function(result){
						console.log(JSON.stringify(result));
						$('#jobber_challan_number').val($short_name+'/'+result.jobber_challan_id);
					},
					error: function(e){console.log(e);}
				});
			}//end if else
		}
    });

    $(document).ready(function() {
        $('#skiving_issue_challan_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-jobber-receipt-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    jobber_challan_receipt_id: function () {
                        return $("#jobber_challan_receipt_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "customer_order_no" },
                { "data": "order_reference_number" },
				{ "data": "jobber_challan_number" },
				{ "data": "article_number" },
                { "data": "leather_color" },
                { "data": "fitting_color" },
				{ "data": "jobber_receive_quantity" },				
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [4,5,7],
                "orderable": false,
            }]
        } );  
    });
	
	//Jobber 1
	$("#co_id").change(function(){

        $co_id = $(this).val();
		$buyer_reference_no = $('option:selected', this).attr('buyer_reference_no');
		$('#buyer_reference_no_add').val($buyer_reference_no);
        $am_id = $('option:selected', "#am_id").val();
		
		$.ajax({
			url: "<?= base_url('admin/jobber-issue-by-customer-order') ?>",
			method: "post",
			dataType: 'json',
			data: {'co_id': $co_id, 'am_id': $am_id},
			success: function(result){
				// console.log('length:'+result.length);			
				console.log(JSON.stringify(result));
				$('#customer_order_reference_number').val(result.buyer_reference_no);
				
				$jobber_issue = result.jobber_issue;
				
				$("#jobber_challan_number_add").html("");
				$("#jobber_challan_number_add").append('<option value="">Select Jobber Challan Number</option>');

                $.each($jobber_issue, function(index, item) {
                    $str = '<option value=' + item.jobber_issue_id + ' cod_id=' + item.cod_id +'> '+ item.jobber_challan_number + '</option>';
                    $("#jobber_challan_number_add").append($str);
                });

                // open the challan list 
                $('#jobber_challan_number_add').select2('open');
				
			},
			error: function(e){console.log(e);}
		});
		
    });//end function

    // Jobber 2	
	$("#jobber_challan_number_add").change(function(){
        $jobber_challan_number_add = $(this).val();
        $jobber_challan_receipt_id = <?= $this->uri->segment(3) ?>;
        $co_id = $('option:selected', "#co_id").val();

		
		$.ajax({
			url: "<?= base_url('admin/ajax-get-article-info-details-wrt-jobber-issue-detail') ?>",
			method: "post",
			dataType: 'json',
			data: {'jobber_issue_id': $jobber_challan_number_add, 'jobber_challan_receipt_id': $jobber_challan_receipt_id, co_id: $co_id},
			success: function(result){
				console.log('ength:'+result.length);			
				console.log(JSON.stringify(result));
				$article_details = result;				
				$("#jobber_issue_detail_id").html("");
				$("#jobber_issue_detail_id").append('<option value="">Select Article Number</option>');
                $.each($article_details, function(index, item) {
                
                $str = '<option value=' + item.jobber_issue_detail_id + ' am_id=' + item.am_id + ' co_id=' + item.co_id + ' cod_id=' + item.cod_id +' fc_id='+item.fitting_id+' lc_id='+item.lc_id+' fitting_color='+item.fc_id+' leather_color='+item.color+' jobber_challan_number='+item.jobber_issue_id+'> '+ item.art_no + '['+item.color+']</option>';
                        $("#jobber_issue_detail_id").append($str); 
                    
                });
                // open the challan list 
                $('#jobber_issue_detail_id').select2('open');
				
			},
			error: function(e){console.log(e);}
		});
		
    });//end function
	
	//Jobber 3
    $("#jobber_issue_detail_id").change(function(){
        //$am_id_add = $(this).val();
		$jobber_challan_number_add = $('option:selected', this).attr('jobber_challan_number');
		$('#job_rcp_btn').prop('disabled', false);
		$am_id = $('option:selected', this).attr('am_id');
		$co_id = $('option:selected', this).attr('co_id');
        $jobber_challan_receipt_id_header = <?= $this->uri->segment(3) ?>;
		$cod_id = $('option:selected', this).attr('cod_id');
        $lc_id = $('option:selected', this).attr('lc_id');
		
		
       $.ajax({
            url: "<?= base_url('admin/ajax-get-article-info-by-jobber-issue-detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'jobber_issue_id': $jobber_challan_number_add, 'jobber_challan_receipt_id':  $jobber_challan_receipt_id_header, 'co_id': $co_id, 'am_id': $am_id, 'lc_id' : $lc_id},
            success: function(result){
                console.log('ength:'+result.length);            
                console.log(JSON.stringify(result));
                $article_details = result;              
                $.each($article_details, function(index, item) {
                

if(parseFloat(item.jobber_issue_quantity) == parseFloat(item.jobber_receive_quantity)){
                        alert('received');
                        $('#lc_id_text').val('');
        $('#lc_id').val('');
        $('#fc_id_text').val('');
        $('#fc_id').val('');
        $('#jobber_issue_quantity_add').val('');
        $('#jobber_receive_quantity_add').val('');
        $('#jobber_receive_quantity_add').attr('max',0);
        $('#am_id_add').val(''); 
        $('#cod_id_add').val('');
                    }else{
                        $jobber_receive_remaining = parseFloat(item.jobber_issue_quantity) - parseFloat(item.jobber_receive_quantity);
    
        
        $('#lc_id_text').val(item.leather_color);
        $('#lc_id').val(item.lc_id);
        $('#fc_id_text').val(item.fitting_color);
        $('#fc_id').val(item.fc_id);
        $('#jobber_issue_quantity_add').val(item.jobber_issue_quantity);
        $('#jobber_receive_quantity_add').val($jobber_receive_remaining);
        $('#jobber_receive_quantity_add').attr('max',$jobber_receive_remaining);
        $('#am_id_add').val($am_id); 
        $('#cod_id_add').val($cod_id);    
                    }


        
                    
                });
                // open the challan list 
                // $('#jobber_issue_detail_id').select2('open');
            },
            error: function(e){console.log(e);}
        });








        
         

		
    });
	
	
	$("#jobber_issue_quantity_add").blur(function(){
        $jobber_issue_quantity_add = $('#jobber_issue_quantity_add').val();
		$receive_cut_quantity_add = $('#receive_cut_quantity_add').val();
		if(parseInt($jobber_issue_quantity_add) > parseInt($receive_cut_quantity_add)){
			alert('Can not greater than Issue quantity');
			$('#jobber_issue_quantity_add').val($receive_cut_quantity_add);
		}
	});
    
    $("#form_jobber_receipt_edit").validate({
        rules: {
            am_id: {
                required: true
            },
            jobber_receipt_challan_number: {
                required: true
            },
            jobber_receipt_challan_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_jobber_receipt_edit').ajaxForm({
        beforeSubmit: function () {
            return $("#form_jobber_receipt_edit").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_jobber_receipt_challan_details").validate({
        rules: {
			co_id: {
                required: true,
            },
			jobber_challan_number_add: {
                required: true,
            },
			am_id_add: {
                required: true,
            },
			jobber_receive_quantity_add: {
                required: true,
            }			
        },
        messages: {

        }
    });
    $('#form_add_jobber_receipt_challan_details').ajaxForm({
        beforeSubmit: function () {
            $('#job_rcp_btn').prop('disabled', true);
            return $("#form_add_jobber_receipt_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			// $('#form_add_jobber_receipt_challan_details')[0].reset(); 
            // $("#form_add_jobber_receipt_challan_details").validate().resetForm(); //reset validation
            notification(obj);
			console.log('total_jobber_quantity_receipt_new: '+obj.total_jobber_quantity_receipt_new);
			$("#total_jobber_quantity_receipt").val(obj.total_jobber_quantity_receipt_new);
            $('#lc_id').val('');
        $('#fc_id_text').val('');
        $('#fc_id').val('');
        $('#jobber_issue_quantity_add').val('');
        $('#jobber_receive_quantity_add').val('');
        $('#jobber_receive_quantity_add').attr('max',0);
        $('#am_id_add').val(''); 
        $('#cod_id_add').val('');

            //refresh table
            $('#skiving_issue_challan_details_table').DataTable().ajax.reload();
            
        }
    });
	
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_jobber_issue_challan_details").validate({
        rules: {
            jobber_issue_quantity_edit: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_jobber_issue_challan_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_jobber_issue_challan_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);			
            notification(obj);
            //refresh table
            $('#skiving_issue_challan_details_table').DataTable().ajax.reload();
        }
    });

    //jobber4
    $("#skiving_issue_challan_details_table").on('click', '.jobber_issue_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $jobber_issue_detail_id = $(this).attr('jobber_issue_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-jobber-challan-details-for-edit') ?>",
            method: "post",
            dataType: 'json',
            data: {'jobber_issue_detail_id': $jobber_issue_detail_id,},
            success: function(data){
                console.log(data);
                $jobber_issue_details = data.jobber_issue_details;
				$jobber_issue_quantity = data.jobber_issue_quantity;
				$receive_cut_quantity = data.receive_cut_quantity;
				$remain_quantity_to_receive = data.remain_quantity_to_receive;
				
				
                $("#co_id_edit").html("<option>"+$jobber_issue_details.co_no+"</option>").trigger('change');
				$("#customer_order_reference_number_edit").val($jobber_issue_details.customer_order_reference_number);
				$("#am_id_edit").html("<option>"+$jobber_issue_details.art_no+"</option>").trigger('change');
				$("#lc_id_text_edit").val($jobber_issue_details.leather_color);
				$("#fc_id_text_edit").val($jobber_issue_details.fitting_color);
				$("#receive_cut_quantity_edit").val($remain_quantity_to_receive);
				$("#jobber_issue_quantity_edit").val($jobber_issue_details.jobber_issue_quantity);
				$("#jobber_issue_quantity_edit_hidden").val($jobber_issue_details.jobber_issue_quantity);
				$("#jobber_emboss_edit").val($jobber_issue_details.jobber_emboss);
				console.log('jobber_issue_detail_id:'+$jobber_issue_details.jobber_issue_detail_id);
				$("#jobber_issue_detail_id_hidden").val($jobber_issue_details.jobber_issue_detail_id);
				
                $('#cut_issue_receive_edit_tab').removeClass('disabled');
                $('#cut_issue_receive_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#cut_issue_receive_edit"]').tab('show');
                $("#pod_edit_loader").addClass('hidden');
                
            }
        });
    });

	//
	$("#jobber_issue_quantity_edit").blur(function(){
        $jobber_issue_quantity_edit = $('#jobber_issue_quantity_edit').val();
		$jobber_issue_quantity_edit_hidden = $('#jobber_issue_quantity_edit_hidden').val();
		$receive_cut_quantity_edit = $('#receive_cut_quantity_edit').val();
		$max_limit_edit = parseInt($receive_cut_quantity_edit) + parseInt($jobber_issue_quantity_edit_hidden);
		
		if(parseInt($jobber_issue_quantity_edit) > parseInt($max_limit_edit)){
			alert('Maximum Issue quantity: ( '+$max_limit_edit+' )');
			$('#jobber_issue_quantity_edit').val($max_limit_edit);
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
			
			$ref_tab = $(this).attr('ref-tab');
			$ref_pk = $(this).attr('ref-pk');
			$ref_val = $(this).attr('ref-val');
            $ref_qnty = $(this).attr('ref-qnty');

            $.ajax({
                url: "<?= base_url('admin/del-jobber-receipt-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk, ref_tab: $ref_tab, ref_pk: $ref_pk, ref_val: $ref_val, ref_qnty: $ref_qnty},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    $new_quqntity = parseFloat(returnData.new_qty).toFixed(2);
                    $('#total_jobber_quantity_receipt').val($new_quqntity);
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
