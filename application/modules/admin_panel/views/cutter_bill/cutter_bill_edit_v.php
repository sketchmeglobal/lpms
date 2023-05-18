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
    <title>Edit Cutting Bill | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Edit Cutting Bill">

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
            width: 100px;
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
            <h3 class="m-b-less">Edit Cutting Bill</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Cutting Bill </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-9">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $cutting_bill_details[0]->cutter_bill_name ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_cutting_bill" method="post" action="<?=base_url('admin/form-edit-cutting-bill')?>" class="cmxform form-horizontal tasi-form">
                            
                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="cut_bill_number" class="control-label text-danger">Cutting Bill Number *</label>
                                        <!--<input id="cut_bill_number"  value="" name="cut_bill_number" type="text" placeholder="Cutting Bill Number" class="form-control round-input" />-->
                                        <br /><label><b><?= $cutting_bill_details[0]->cutter_bill_name ?></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="cut_bill_date" class="control-label text-danger">Cutting Bill Date *</label>
                                        <input id="cut_bill_date" value="<?= $cutting_bill_details[0]->cutter_bill_date ?>" required name="cut_bill_date" type="date" placeholder="Cutting Bill Date" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label for="cut_bill_type" class="control-label text-danger">Select Type *</label>
                                        <select disabled name="cut_bill_type" id="cut_bill_type" class="form-control">
                                            <option <?= ($cutting_bill_details[0]->cutter_bill_type == 'Type A') ? 'selected' : '' ?> value="Type A">Type A (Non-leather)</option>
                                            <option <?= ($cutting_bill_details[0]->cutter_bill_type == 'Type B') ? 'selected' : '' ?> value="Type B">Type B (Leather)</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                                               
                                <div class="form-group ">
                                    <div class="col-lg-4">
                                        <label for="cutter_name" class="control-label text-danger">Cutter Name *</label><br />
                                        <b><label><?= $cutting_bill_details[0]->name ?></label></b>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="cut_bill_remark" class="control-label">Remarks</label>
                                        <textarea id="cut_bill_remark" name="cut_bill_remark" placeholder="Remark, if any" class="form-control round-input"><?= $cutting_bill_details[0]->cutter_bill_remark ?></textarea>
                                    </div>
                                   <div class="col-lg-4">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="status" id="enable" value="1" <?= ($cutting_bill_details[0]->status == 1) ? 'checked' : '' ?> required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="status" id="disable" value="0" <?= ($cutting_bill_details[0]->status == 0) ? 'checked' : '' ?> required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>
                                                               
                            

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Cutter Bill</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="cb_id" name="cb_id" class="hidden" value="<?= $cutting_bill_details[0]->cb_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-3">
                    <section class="panel">
                        <header class="panel-heading">
                            Total:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        
                        <div class="panel-body">
                            <!-- <p class='text-center' id="">Total Quantity: <?= $total_quantity ?></p> -->
                            <hr />
                            <p class='text-center' id="">Total Bill Value: <span id="cutter_bill_amount_number_prev"><?= $cutter_total ?></span>
                                <input type="text" id="cutter_bill_amount_number_new" class="hidden" name="cutter_bill_amount_number_new" value="<?= $cutter_total ?>"></p>
                        </div>
                    </section>
                </div>
            </div>



           
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Cutting Bill details for: <?= $cutting_bill_details[0]->cutter_bill_name ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="purchase_order_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#cut_issue_challan_list" data-toggle="tab">List</a></li>
                                <li><a href="#cut_bill_add" data-toggle="tab">Add</a></li>
                                <!--<li id="cut_bill_edit_tab" class="disabled"><a href="#cut_bill_edit" data-toggle="">Edit</a></li>-->
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <img id="pod_edit_loader" class="hidden" style="display:block; margin: auto" src="<?= base_url('assets/img/ellipsis.gif') ?>" alt="" />
                                <div id="cut_issue_challan_list" class="tab-pane fade in active">
                                    <table id="cutting_bill_details_table" class="table data-table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Cutting Rcpt. Number</th>
                                                <th>Order Number</th>
                                                <th>Cutting Challan Number</th>
                                                <th>Article Number</th>
                                                <th>Leather Color</th>
                                                <th>Quantity</th>
                                                <th>Extra Quantity</th>
                                                <th>Part</th>
                                                <th>Rate</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="cut_bill_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_cutting_bill_details" method="post" action="<?=base_url('admin/form-add-cutting-bill-details')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-4">
                                                    <label for="cut_rcv_id" class="control-label text-danger">Cutting Receive No*</label>
                                                    <select id="cut_rcv_id" name="cut_rcv_id" class="form-control select2">
                                                        <option value="">Select Cutting Receive Challan</option>
														<?php
                                                        foreach($cutting_receive1 as $cr){
                                                            foreach($cutting_receive2 as $cr2) {
                                                                if($cr->cut_rcv_id == $cr2->cut_rcv_id) {
                                                                continue 2;
                                                                }
                                                            }
                                                        ?> 
                                                        <option value="<?= $cr->cut_rcv_id ?>"><?=$cr->cut_rcv_number ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                     </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <table id="cutting_bill_details_table_insert" class="table data-table dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Cutting Rcpt. Number</th>
                                                            <th>Order Number</th>
                                                            <th>Cutting Challan Number</th>
                                                            <th>Article Number</th>
                                                            <th>Leather Color</th>
                                                            <th>Quantity</th>
                                                            <th>Extra Quantity</th>
                                                            <th>Part</th>
                                                            <th>Rate</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
            
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="9">Total</td>
                                                            <td> <span id="cutter_bill_amount_number"></span>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit" id="add_details"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                            <input type="text" name="cb_id_edit" id="cb_id_edit" class="hidden" value="<?= $cutting_bill_details[0]->cb_id ?>" />
                                        </form>
                                    </div>
                                </div>

                                <div id="cut_bill_edit" class="tab-pane">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_issue_receive_details" method="post" action="<?=base_url('admin/form-edit-issue-receive-details')?>" class="cmxform form-horizontal tasi-form">
                                           
                                           <!--edit area-->
                                           
                                            <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Update details</button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="cut_rcv_detail_id" name="cut_rcv_detail_id" class="hidden" value="" />
                                            
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
        $('#cutting_bill_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-cutting-bill-details-table-data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    cb_id: function () {
                        return $("#cb_id_edit").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "cutting_receipt_number" },
                { "data": "co_no" },
                { "data": "cut_number" },
				{ "data": "art_no" },
                { "data": "color" },
                { "data": "original_quantity" },
				{ "data": "extra_quantity" },
				{ "data": "parts" },				
				{ "data": "rate" },
				{ "data": "total_amount" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [8],
                "orderable": false,
            }]
        } );  
    });
	
	$("#cut_rcv_id").change(function(){
        $cut_rcv_id = $(this).val();
        $("#add_details").attr("disabled", false);
		$.ajax({
			url: "<?= base_url('admin/get-cutter-bill-details-on-cutter-receive') ?>",
			method: "post",
			dataType: 'json',
			data: {'cut_rcv_id': $cut_rcv_id, 'cut_bill_type': $("#cut_bill_type").val()},
			success: function(result){
                $tot_amn = 0;
				console.log('length:'+result.length);			
				console.log(JSON.stringify(result));
				$("#cutting_bill_details_table_insert tbody").html("");
				$.each(result, function(index, item) {

                    $cut_bill_type = $("#cut_bill_type").val();
                    if($cut_bill_type == 'Type A') {
                        $cut_rate = item.cutting_rate_a;
                    } else if('Type B') {
                        $cut_rate = item.cutting_rate_b;
                    } else {
                        $cut_rate = '0.00';
                    }
                    $tot_amn = $tot_amn + (item.receive_cut_quantity*$cut_rate*item.part_quantity); 

                    $str = '<tr><td>'+item.cut_rcv_number+'</td><td>'+item.co_no+'</td><td>'+item.cut_number+'</td><td>'+item.art_no+'</td><td>'+item.leather_color+
                    '</td><td class="class_q">'+item.receive_cut_quantity+'</td><td><input class="class_eq" type="number" name="add_extra_quantity[]" required value="0" /></td><td><input class="class_part" required type="number" name="add_part[]" value="'+item.part_quantity+
                    '" /></td><td><input required class="class_rate" type="number" name="add_rate[]" value="'+$cut_rate+'" /></td><td class="class_total">'+(item.receive_cut_quantity*$cut_rate*item.part_quantity).toFixed(2)+
                    '</td><td class="class_total_amount"><input type="hidden" name="total_amount[]" value="'+(item.receive_cut_quantity*$cut_rate*item.part_quantity).toFixed(2)+'" /></td><td class="hidden"><input type="hidden" name="cut_id[]" value="'+item.cut_id+
                    '" /></td><td class="hidden"><input type="hidden" name="cut_rcv_id[]" value="'+item.cut_rcv_id+'" /></td><td class="hidden"><input type="hidden" name="co_id[]" value="'+item.co_id+
                    '" /></td><td class="hidden"><input type="hidden" name="am_id[]" value="'+item.am_id+'" /></td><td class="hidden"><input type="hidden" name="fitting_id[]" value="'+item.fitting_id+'" /></td><td class="hidden"><input type="hidden" name="leather_id[]" value="'+item.leather_id+
                    '" /></td><td class="hidden"><input type="hidden" name="receive_cut_quantity[]" value="'+item.receive_cut_quantity+'" /></td></tr>';

                    $("#cutting_bill_details_table_insert tbody").append($str);
                });
                // alert($tot_amn);
				$('#cutter_bill_amount_number').html($tot_amn.toFixed(2));
                $('#cutter_bill_amount_number_new').val($tot_amn);
			},
			error: function(e){console.log(e);}
		});
		
    });//end function
    
    $("#form_edit_cutting_bill").validate({
        rules: {
            cut_bill_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_cutting_bill').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_cutting_bill").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });

    // table calc - form add cutter bill details
    $(document).on('blur', '.class_eq, .class_part, .class_rate', function () {
        
        $class_q = parseFloat($(this).closest('tr').find(".class_q:eq(0)").text());
        $class_eq = parseFloat($(this).closest('tr').find(".class_eq:eq(0)").val());
        $class_part = parseFloat($(this).closest('tr').find(".class_part:eq(0)").val());
        $class_rate = parseFloat($(this).closest('tr').find(".class_rate:eq(0)").val());
        
        $(this).closest('tr').find(".class_total:eq(0)").text((($class_q + $class_eq) * $class_part * $class_rate).toFixed(2));
        $(this).closest('tr').find(".class_total_amount input:eq(0)").val((($class_q + $class_eq) * $class_part * $class_rate).toFixed(2));
        var sum = 0
        $(".class_total_amount input").each(function(){
            // alert($(this).val());
        sum += parseFloat($(this).val());
    });
        $('#cutter_bill_amount_number').html(sum.toFixed(2));
        $('#cutter_bill_amount_number_new').val(sum);
    });
    
    
    $("#form_add_cutting_bill_details").validate({
        rules: {
            add_extra_quantity: {
                required: true,
            },
			add_part: {
                required: true,
            },
			add_rate: {
                required: true,
            }			
        },
        messages: {

        }
    });
    $('#form_add_cutting_bill_details').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_cutting_bill_details").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            console.log('RD => ' + returnData);
            obj = JSON.parse(returnData);
            notification(obj);

            $("#cutting_bill_details_table_insert tbody").html("");
            
            var val = $('#cut_rcv_id option:selected').val();
            $("#cut_rcv_id option[value="+val+"]").remove();
            $("#cut_rcv_id").select2('open');
            $('#cutter_bill_amount_number_prev').text(obj.cutter_total);
            //refresh table
            $('#cutting_bill_details_table').DataTable().ajax.reload();
            $("#add_details").attr("disabled", true);
            
        }
    });

	$("#cutting_bill_details_table").on('click', '.cutting_received_challan_detail_edit_btn', function() {
        $("#pod_edit_loader").removeClass('hidden');

        $cut_rcv_detail_id = $(this).attr('cut_rcv_detail_id');

        $.ajax({
            url: "<?= base_url('admin/ajax-fetch-cutting-receive-challan-details-on-pk') ?>",
            method: "post",
            dataType: 'json',
            data: {'cut_rcv_detail_id': $cut_rcv_detail_id,},
            success: function(result){
                console.log(JSON.stringify(result));
                //data = pod_data[0];
                
                $("#co_no_edit").val(result.co_no);
                $("#buyer_reference_no_edit").val(result.buyer_reference_no);
				$("#cut_number_edit").val(result.cut_number);
				$articaleName = result.art_no +'['+ result.leather_color +']';
				$("#article_name_edit").val($articaleName);
				$("#leather_color_edit").val(result.leather_color);
				$("#fitting_color_edit").val(result.fitting_color);
				$("#co_quantity_edit").val(result.co_quantity);
				$("#receive_cut_quantity_edit").val(result.receive_cut_quantity);
				$("#receive_cut_quantity_edit_hidden").val(result.receive_cut_quantity);
				$("#cut_rcv_detail_id").val(result.cut_rcv_detail_id);

                $('#cut_issue_receive_edit_tab').removeClass('disabled');
                $('#supp_po_details_edit_tab').children("a").attr("data-toggle", 'tab');
                // $('#supp_po_details_edit_tab li:eq(2) a').tab('show');
                $('a[href="#cut_issue_receive_edit"]').tab('show');
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
            
            $data_tab = $(this).attr('data-tab');
            $data_pk = $(this).attr('data-pk');
            $data_tab_val = $(this).attr('data-tab-val');
            
            $quantity = $(this).attr('quantity');
            $rate = $(this).attr('rate');
            $total = $(this).attr('total');

            $.ajax({
                url: "<?= base_url('admin/del-cutting-bill-details') ?>",
                dataType: 'json',
                type: 'POST',
                data: {tab: $tab, tab_pk : $tab_pk, tab_val: $tab_val, data_tab: $data_tab, data_pk : $data_pk, data_tab_val: $data_tab_val, quantity: $quantity, rate: $rate, total: $total},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    
                    //obj = JSON.parse(returnData);
                    
                    $('#cutter_bill_amount_number').val(returnData.article_total);
                    $('#cutter_bill_amount_number_prev').text(returnData.article_total);
                    
                    notification(returnData);
                    
                    //refresh table
                    $("#cutting_bill_details_table").DataTable().ajax.reload();

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
