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
    <title>Checking List Edit | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Checking List Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Checking List Edit</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit: <?= $checking_details[0]->employees_name ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_checking_list_edit" method="post" action="<?=base_url('admin/form-checking-list-edit')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                            <div class="col-lg-3">
                                    <label for="e_id" class="control-label text-danger">Select Employee *</label>
                                    <select id="e_id" name="e_id" class="form-control select2">
                                    <option value="">Select Employee</option>
                                            <?php
                                            foreach($employee_details as $emp_detail){
                                                $sn = ($emp_detail->e_code == '' ? '-' : $emp_detail->e_code);
                                            ?> 
                                                <option value="<?= $emp_detail->e_id ?>" short_name="<?=$emp_detail->name?>" e_code="<?=$emp_detail->e_code?>" <?php if($emp_detail->e_id == $checking_details[0]->e_id){?> selected <?php } ?> ><?= $emp_detail->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            <div class="col-lg-3">
                                        <label for="checking_start_date_time" class="control-label text-danger">Entry Date *</label>
                                        <input id="checking_start_date_time" name="checking_start_date_time" type="date" placeholder="Start Date Time" class="form-control round-input" value="<?= date('Y-m-d', strtotime($checking_details[0]->checking_entry_date)) ?>" />
                                    </div>
                            </div>
                                                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Checking</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="checking_id" name="checking_id" class="hidden" value="<?= $checking_details[0]->checking_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                <!--<div class="col-md-2 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Total:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        
                        <div class="panel-body">
                            <p class='text-center' id="challan_total_amount">00.00</p>
                            <hr />
                        </div>
                    </section>
                </div>-->
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Checking details for: <?= $checking_details[0]->employees_name ?>
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
                                    <table id="checking_list_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Extra Time</th>
                                                <th>Leather Colour</th>
                                                <th>Fitting Colour</th>
                                                <th>Quantity</th>
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
                                        <form id="form_add_checking_list_details" method="post" action="<?=base_url('admin/form-add-checking-listn-details')?>" class="cmxform form-horizontal tasi-form">
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
                                                <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                    <label for="am_id_add" class="control-label text-danger">Article Number*</label>
                                                    <select id="am_id_add" name="am_id_add" class="form-control select2">
                                                        <option value="">Select Article Number</option>
														
                                                     </select>
                                                </div>
                                                <input type="hidden" id="new_am_id_add_hidden" name="new_am_id_add_hidden" class="form-control" value="" />
                                                <div class="col-lg-2">
                                                    <label for="extra_time" class="control-label text-danger">Extra Time</label>
                                                    <input type="number" id="extra_time" name="extra_time" class="form-control" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="lc_id_text" class="control-label text-danger">Leather Colour</label>
                                                    <input type="text" id="lc_id_text" name="lc_id_text" required class="form-control" readonly />
                                                    <input type="hidden" id="lc_id" name="lc_id" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="fc_id_text" class="control-label text-danger">Fitting Colour</label>
                                                    <input type="text" id="fc_id_text" name="fc_id_text" required class="form-control" readonly />
                                                    <input type="hidden" id="fc_id" name="fc_id" required class="form-control" readonly />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="checked_quantity_add" class="control-label text-danger">Quantity</label>
                                                    <input type="text" id="checked_quantity_add" name="checked_quantity_add" required class="form-control" />
                                                    <input type="hidden" id="remaining_checking_quantity_hidden" name="remaining_checking_quantity_hidden" required class="form-control" />
                                                    
                                                    <input type="hidden" id="cod_id_add_hidden" name="cod_id_add_hidden" required class="form-control" />
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="remarks_add" class="control-label text-danger">Remarks</label>
                                                    <input type="text" id="remarks_add" name="remarks_add" class="form-control" />
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="checking_id" id="checking_id" class="hidden" value="<?= $checking_details[0]->checking_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_issue_receive_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                    <form id="form_edit_checking_list_details" method="post" action="<?=base_url('admin/form-edit-checking-list-details')?>" class="cmxform form-horizontal tasi-form">
                                        <div class="form-group ">
                                          <div class="col-lg-4">
                                                <label for="co_id_edit" class="control-label text-danger">Customer Order No*</label>
                                                <select id="co_id_edit" name="co_id_edit" class="form-control select2">
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
                                          <div class="col-lg-4"><!-- It is showing Article Number[Atricle Details] but calculating with the customer order detail PK -->
                                                <label for="am_id_edit" class="control-label text-danger">Article Number*</label>
                                                <select id="am_id_edit" name="am_id_edit" class="form-control select2">
                                                    <option value="">Select Article Number</option>
                                                    
                                                 </select>
                                            </div>
                                        <div class="col-lg-2">
                                                    <label for="extra_time_edit" class="control-label text-danger">Extra Time</label>
                                                    <input type="number" id="extra_time_edit" name="extra_time_edit" class="form-control" />
                                                </div>
                                          <div class="col-lg-2">
                                                <label for="lc_id_text_edit" class="control-label text-danger">Leather Colour</label>
                                                <input type="text" id="lc_id_text_edit" name="lc_id_text_edit" required class="form-control" readonly />
                                                <input type="hidden" id="lc_id_edit" name="lc_id_edit" required class="form-control" readonly />
                                            </div>
                                          <div class="col-lg-2">
                                                <label for="fc_id_text_edit" class="control-label text-danger">Fitting Colour</label>
                                                <input type="text" id="fc_id_text_edit" name="fc_id_text_edit" required class="form-control" readonly />
                                                <input type="hidden" id="fc_id_edit" name="fc_id_edit" required class="form-control" readonly />
                                            </div>
                                          <div class="col-lg-4">
                                                <label for="checked_quantity_edit" class="control-label text-danger">Quantity</label>
                                                <input type="text" id="checked_quantity_edit" name="checked_quantity_edit" required class="form-control" />
                                                <input type="hidden" id="remaining_checking_quantity_hidden_edit" name="remaining_checking_quantity_hidden_edit" required class="form-control" />
                                                
                                                <input type="hidden" id="cod_id_edit_hidden" name="cod_id_edit_hidden" required class="form-control" />
                                                
                                            </div>
                                          <div class="col-lg-4">
                                                <label for="remarks_edit" class="control-label text-danger">Remarks</label>
                                                <input type="text" id="remarks_edit" name="remarks_edit" class="form-control" />
                                                
                                            </div>   
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-4 col-lg-offset-4">
                                                <label for="" class="control-label">&nbsp;</label><br>
                                                <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Edit details</button>
                                            </div>
                                        </div>
                                        <input type="text" name="checking_id" id="checking_id" class="hidden" value="<?= $checking_details[0]->checking_id ?>" />
                                        <input type="text" name="checking_detail_id_edit" id="checking_detail_id_edit" class="hidden" value="" />
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
        $('#checking_list_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-checking-list-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    checking_id: function () {
                        return $("#checking_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "order_number" },
                { "data": "article_number" },
                { "data": "extra_time" },
				{ "data": "leather_colour" },
				{ "data": "fitting_colour" },
				{ "data": "quantity" },
                { "data": "remarks" },				
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [2, 3, 5, 6],
                "orderable": false,
            }]
        } );  
    });
	
	//Jobber 1
	$("#co_id").change(function(){
        $co_id = $(this).val();
		
		$.ajax({
			url: "<?= base_url('admin/get-customer-order-dtl-for-checking') ?>",
			method: "post",
			dataType: 'json',
			data: {'co_id': $co_id},
			success: function(result){
				// console.log('Length:'+result.length);			
				// console.log(JSON.stringify(result));
				$article_details = result;
				
				$("#am_id_add").html("");
				$("#am_id_add").append('<option value="">Select Article Number</option>');
                $.each($article_details, function(index, item) {
                    $str = '<option value=' + item.cod_id + ' co_id=' + item.co_id + ' cod_id=' + item.cod_id +' fc_id='+item.fitting_id+' lc_id='+item.leather_id+' fitting_color='+item.fitting_color+' leather_color='+item.leather_color+' checked_quantity='+item.checked_quantity+' remaining_checking_quantity='+item.remaining_checking_quantity+'> '+ item.art_no + '['+ item.leather_color + ']</option>';
                    $("#am_id_add").append($str);
                });
                // open the challan list 
                $('#am_id_add').select2('open');
				
			},
			error: function(e){console.log(e);}
		});
		
    });//end function
	
// 	$("#co_id_edit").change(function(){
//         $co_id_edit = $(this).val();
		
// 		$.ajax({
// 			url: "<?= base_url('admin/get-customer-order-dtl-for-checking') ?>",
// 			method: "post",
// 			dataType: 'json',
// 			data: {'co_id': $co_id_edit},
// 			success: function(result){
// 				console.log('Length:'+result.length);			
// 				console.log(JSON.stringify(result));
// 				$article_details = result;
				
// 				$("#am_id_edit").html("");
// 				$("#am_id_edit").append('<option value="">Select Article Number</option>');
//                 $.each($article_details, function(index, item) {
//                     $str = '<option value=' + item.am_id + ' co_id=' + item.co_id + ' cod_id=' + item.cod_id +' fc_id='+item.fitting_id+' lc_id='+item.leather_id+' fitting_color='+item.fitting_color+' leather_color='+item.leather_color+' checked_quantity='+item.checked_quantity+' remaining_checking_quantity='+item.remaining_checking_quantity+'> '+ item.art_no + '['+ item.leather_color + ']</option>';
//                     $("#am_id_edit").append($str);
//                 });
//                 // open the challan list 
//                 // $('#am_id_edit').select2('open');
				
// 			},
// 			error: function(e){console.log(e);}
// 		});
		
//     });//end function
	
	//Jobber 3
	
	$("#am_id_add").change(function(){
        $cod_id = $(this).val();
        // alert();
		
		$.ajax({
			url: "<?= base_url('admin/get-customer-order-dtl-for-checking-am-id') ?>",
			method: "post",
			dataType: 'json',
			data: {'cod_id': $cod_id},
			success: function(result){
				// console.log('Length:'+result.length);			
				// console.log(JSON.stringify(result));
				$article_details = result;
				
                   $co_id = $article_details.co_id;
		$cod_id = $article_details.cod_id;
		//$skiving_receive_detail_id = $('option:selected', this).attr('skiving_receive_detail_id');
		$fc_id = $article_details.fc_id;
		$lc_id = $article_details.lc_id;
		$fitting_color = $article_details.fitting_color;
		$leather_color = $article_details.leather_color;
		$checked_quantity = $article_details.checked_quantity;
		$remaining_checking_quantity = $article_details.remaining_checking_quantity;
		$cod_id_add_hidden = $article_details.cod_id;
		
		$('#lc_id_text').val($leather_color);
		$('#lc_id').val($lc_id);
		$('#fc_id_text').val($fitting_color);
		$('#fc_id').val($fc_id);
		$('#checked_quantity_add').val($remaining_checking_quantity);
		$('#remaining_checking_quantity_hidden').val($remaining_checking_quantity);
		$('#cod_id_add_hidden').val($cod_id_add_hidden);
		$('#new_am_id_add_hidden').val($article_details.am_id);
                // open the challan list 

			},
			error: function(e){console.log(e);}
		});
		
    });
//     $("#am_id_add").change(function(){
//         $am_id_add = $(this).val();
// 		$co_id = $('option:selected', this).attr('co_id');
// 		$cod_id = $('option:selected', this).attr('cod_id');
// 		//$skiving_receive_detail_id = $('option:selected', this).attr('skiving_receive_detail_id');
// 		$fc_id = $('option:selected', this).attr('fc_id');
// 		$lc_id = $('option:selected', this).attr('lc_id');
// 		$fitting_color = $('option:selected', this).attr('fitting_color');
// 		$leather_color = $('option:selected', this).attr('leather_color');
// 		$checked_quantity = $('option:selected', this).attr('checked_quantity');
// 		$remaining_checking_quantity = $('option:selected', this).attr('remaining_checking_quantity');
// 		$cod_id_add_hidden = $('option:selected', this).attr('cod_id');
		
// 		$('#lc_id_text').val($leather_color);
// 		$('#lc_id').val($lc_id);
// 		$('#fc_id_text').val($fitting_color);
// 		$('#fc_id').val($fc_id);
// 		$('#checked_quantity_add').val($remaining_checking_quantity);
// 		$('#remaining_checking_quantity_hidden').val($remaining_checking_quantity);
// 		$('#cod_id_add_hidden').val($cod_id_add_hidden);
		
//     });
	
	$("#am_id_edit").change(function(){
        $am_id_edit = $(this).val();
		
		$co_id = $('option:selected', this).attr('co_id');
		$cod_id = $('option:selected', this).attr('cod_id');
		//$skiving_receive_detail_id = $('option:selected', this).attr('skiving_receive_detail_id');
		$fc_id = $('option:selected', this).attr('fc_id');
		$lc_id = $('option:selected', this).attr('lc_id');
		$fitting_color = $('option:selected', this).attr('fitting_color');
		$leather_color = $('option:selected', this).attr('leather_color');
		$checked_quantity = $('option:selected', this).attr('checked_quantity');
		$remaining_checking_quantity = $('option:selected', this).attr('remaining_checking_quantity');
		$cod_id_edit_hidden = $('option:selected', this).attr('cod_id');
		
		$('#lc_id_text_edit').val($leather_color);
		$('#lc_id_edit').val($lc_id);
		$('#fc_id_text_edit').val($fitting_color);
		$('#fc_id_edit').val($fc_id);
		$('#checked_quantity_edit').val($remaining_checking_quantity);
		$('#remaining_checking_quantity_hidden_edit').val($remaining_checking_quantity);
		$('#cod_id_edit_hidden').val($cod_id_edit_hidden);
		
    });
	
	
	$("#checked_quantity_add").blur(function(){
        $remaining_checking_quantity_hidden = $('#remaining_checking_quantity_hidden').val();
		$checked_quantity_add = $('#checked_quantity_add').val();
		if($checked_quantity_add == 0){
			alert('Quantity can not be zero');
		}else if(parseInt($checked_quantity_add) > parseInt($remaining_checking_quantity_hidden)){
			alert('Can not greater than Issue quantity');
			$('#checked_quantity_add').val($remaining_checking_quantity_hidden);
		}
	});
    
    $("#form_checking_list_edit").validate({
        rules: {
            e_id: {
                required: true
            },
            checking_start_date_time: {
                required: true
            },
            checking_end_date_time: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_checking_list_edit').ajaxForm({
        beforeSubmit: function () {
            return $("#form_checking_list_edit").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });

    //add-purchase order details-form validation and submit
    $("#form_add_checking_list_details").validate({
        rules: {
			co_id: {
                required: true,
            },
			am_id_add: {
                required: true,
            },
			checked_quantity_add: {
                required: true,
            }			
        },
        messages: {

        }
    });
    $('#form_add_checking_list_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_checking_list_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
			$('#form_add_checking_list_details')[0].reset(); 
            $("#form_add_checking_list_details").validate().resetForm(); //reset validation
            notification(obj);
            
            //refresh table
            $('#checking_list_details_table').DataTable().ajax.reload();
            
        }
    });
	
	
    //edit-purchase order details-form validation and submit
    $("#form_edit_checking_list_details").validate({
        rules: {
            checked_quantity_edit: {
                required: true,
            }
        },
        messages: {
            
        }
    });

    $('#form_edit_checking_list_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_checking_list_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);			
            notification(obj);
            //refresh table
            $('#checking_list_details_table').DataTable().ajax.reload();
        }
    });

    //jobber4
    $("#checking_list_details_table").on('click', '.checking_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $checking_detail_id = $(this).attr('checking_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-checking-details-for-edit') ?>",
            method: "post",
            dataType: 'json',
            data: {'checking_detail_id': $checking_detail_id,},
            success: function(data){
                console.log(data);
                $checking_detail = data.checking_detail;
				//alert($checking_detail.checking_detail_id)
				/*$jobber_issue_quantity = data.jobber_issue_quantity;
				$receive_cut_quantity = data.receive_cut_quantity;
				$remain_quantity_to_receive = data.remain_quantity_to_receive;*/
				
                $("#co_id_edit").html("<option>"+$checking_detail.co_no+"</option>").trigger('change');
				$("#am_id_edit").html("<option>"+$checking_detail.art_no+"</option>").trigger('change');
                $("#extra_time_edit").val($checking_detail.extra_time);
				$("#lc_id_text_edit").val($checking_detail.leather_color);
				$("#fc_id_text_edit").val($checking_detail.fitting_color);
				$("#checked_quantity_edit").val($checking_detail.checked_quantity);
				$("#remarks_edit").val($checking_detail.remarks);
				/*$("#jobber_issue_quantity_edit_hidden").val($jobber_issue_details.jobber_issue_quantity);
				$("#jobber_emboss_edit").val($jobber_issue_details.jobber_emboss);
				console.log('jobber_issue_detail_id:'+$jobber_issue_details.jobber_issue_detail_id);*/
				$("#checking_detail_id_edit").val($checking_detail.checking_detail_id);
				
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

            $.ajax({
                url: "<?= base_url('admin/del-checking-details-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, data_pk: $data_pk},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    
                    //refresh table
                    $("#checking_list_details_table").DataTable().ajax.reload();

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
