<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 */
?>
<?php
// print_r($buyer_details);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Office Invoice | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add Purchase order">

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
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
            <h3 class="m-b-less">Add Office Invoice</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Office Invoice</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form id="form_add_office_invoice" method="post" action="<?=base_url('admin/form-add-office-invoice')?>" class="cmxform form-horizontal tasi-form" enctype="multipart/form-data">
                            	<div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="office_invoice_number" class="control-label text-danger">Invoice Number*</label>
                                    <input id="office_invoice_number" name="office_invoice_number" type="text" placeholder="Invoice Number" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="office_invoice_date" class="control-label text-danger">Date *</label>
                                        <input id="office_invoice_date" name="office_invoice_date" type="date" placeholder="Date" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="rate_type" class="control-label text-danger">Rate Type *</label>
                                        <select id="rate_type" name="rate_type" class="form-control select2">
                                            <option value="">Rate Type</option>
                                            <option value="1">Ex. Works</option>
                                            <option value="2">C&F </option>
                                            <option value="3">CIF </option>
                                            <option value="4">FOB</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="am_id" class="control-label text-danger">Select Buyer*</label>
                                        <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Buyer</option>
											<?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>" data-value="<?= $bd->cur_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <label for="currency" class="control-label text-danger">Select Currency*</label>
                                        <select id="currency" name="currency" class="form-control select2">
                                        <option value="">Select Currency</option>
											<?php
                                            foreach($currency_list as $cl){
                                            ?> 
                                                <option value="<?= $cl->cur_id ?>"><?= $cl->currency ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group ">    
                                    
                                 <div class="col-lg-3">
                                        <label for="office_proforma_id" class="control-label">Select Proforma</label>
                                        <select id="office_proforma_id" name="office_proforma_id[]" class="form-control select2" multiple>
                                        <option value="">Select Proforma</option>
                                        <?php
                                            foreach($office_proforma_list as $opl){
                                            ?> 
                                                <option value="<?=$opl->office_proforma_id?>"><?=$opl->proforma_number?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>

                                	<div class="col-lg-3">
                                    <label for="pre_carriage_by" class="control-label">Pre-Carriage by:</label>
                                    <select id="pre_carriage_by" name="pre_carriage_by" class="form-control select2" required>
                                        <option value="">Pre-Carriage</option>
                                        <option value="1">By Air</option>
                                        <option value="2">By Ship </option>
                                        <option value="3">By Road</option>
                                    </select>
                                </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="port_of_discharge" class="control-label">Port of Discharge</label>

                                        <textarea id="port_of_discharge" name="port_of_discharge" placeholder="Port of Discharge" class="form-control round-input"></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="port_of_loading" class="control-label">Port of Loading</label>

                                        <textarea id="port_of_loading" name="port_of_loading" placeholder="Port of Loading" class="form-control round-input">Kolkata</textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="terms_conditions" class="control-label">Terms and Conditions</label>

                                        <textarea id="terms_conditions" name="terms_conditions" placeholder="Terms and Conditions" class="form-control round-input"></textarea>
                                    </div>
                                    
                                    
                                    <div class="col-lg-3">
                                        <label for="tr_id" class="control-label text-danger">Select transporter*</label>
                                        <select id="tr_id" name="tr_id" class="form-control select2" required>
                                        <option value="">Select Transporter</option>
											<?php
                                            foreach($transport_details as $tr_de){
                                            ?> 
                                                <option value="<?= $tr_de->tr_id ?>"><?= $tr_de->name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-lg-3">
                                        <label for="distance" class="control-label text-danger">Distance*</label>

                                        <input type="number" id="distance" name="distance" placeholder="Distance" class="form-control round-input" value="" required>
                                    </div>
                                    
                                    
                                 </div>
                                 
                                 <div class="form-group ">      
                                       
                                    <div class="col-lg-3">
                                        <label for="packing_shipment_id" class="control-label text-danger">Select Packing List*</label>
                                        <select id="packing_shipment_id" name="packing_shipment_id" class="form-control select2">
                                        <option value="">Select Packing List</option>
                                        <?php
                                            foreach($packing_shipment_list as $psl){
                                            ?> 
                                                <option value="<?=$psl->packing_shipment_id?>"><?=$psl->package_name?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="terms_of_delivery_payment" class="control-label">Terms of Delivery & Payment</label>
                                        <textarea rows="6" id="terms_of_delivery_payment" name="terms_of_delivery_payment" placeholder="Terms of Delivery & Payment" class="form-control"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="mark_container" class="control-label">Mark & Container</label>
                                        <textarea rows="6" id="mark_container" name="mark_container" placeholder="Mark & Container" class="form-control"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="notify" class="control-label">Notify</label>
                                        <textarea rows="6" id="notify" name="notify" placeholder="Notify" class="form-control"></textarea>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group ">
                                    <div class="col-lg-6">
                                        <label for="no_of_kind_of_package" class="control-label">No. & Kind of Pkgs</label>

                                        <textarea id="no_of_kind_of_package" name="no_of_kind_of_package" placeholder="No. & Kind of Pkgs" class="form-control round-input"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="description_of_goods" class="control-label">Description of Goods</label>

                                        <textarea id="description_of_goods" name="description_of_goods" placeholder="Description of Goods" class="form-control round-input"></textarea>
                                    </div>                                    
                                </div>
                                
                                <div class="form-group ">
                                	<div class="col-lg-2">
                                    <label for="gross_weight" class="control-label">Gross Weight</label>
                                    <input id="gross_weight" name="gross_weight" type="number" placeholder="Gross Weight" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_weight" class="control-label">Net Weight</label>
                                    <input id="net_weight" name="net_weight" type="number" placeholder="Net Weight" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="volume_weight" class="control-label">Volume Weight</label>
                                    <input id="volume_weight" name="volume_weight" type="number" placeholder="Volume Weight" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="ex_rate" class="control-label">EX Rate</label>
                                    <input id="ex_rate" name="ex_rate" type="number" placeholder="EX Rate" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="conversion_rate" class="control-label">Conversion Rate</label>
                                    <input id="conversion_rate" name="conversion_rate" type="number" placeholder="Conversion Rate" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="acc_master_declar_id" class="control-label">Select Declaration</label>
                                        <select id="acc_master_declar_id" name="acc_master_declar_id[]" class="form-control select2" multiple>
                                        <!--<option value="">Select Declaration</option>-->
                                        </select>
                                    </div> 
                                </div> 
                                <div class="form-group ">
                                    <div class="col-lg-2">
                                    <label for="net_qnty" class="control-label">Net Quantity</label>
                                    <input id="net_qnty" name="net_qnty" type="number" placeholder="Net Quantity" class="form-control round-input" value="0.0" readonly="" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_amnt" class="control-label">Net Amount</label>
                                    <input id="net_amnt" name="net_amnt" type="number" placeholder="Net Amount" class="form-control round-input" value="0.0" readonly="" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="net_amnt" class="control-label">Net Amount (INR)</label>
                                    <input id="net_amnt_inr" name="net_amnt_inr" type="number" placeholder="Net Amount" class="form-control round-input" value="0.0" readonly="" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="volume_weight" class="control-label">Discount %</label>
                                    <input id="disc" name="disc" type="number" placeholder="discount" class="form-control round-input" value="0.0" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="hand_charge" class="control-label">Handling Charges</label>
                                    <input id="hand_charge" name="hand_charge" type="number" placeholder="Handling Charges" class="form-control round-input" value="0.0" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="grand_total" class="control-label">Grand Total</label>
                                    <input id="grand_total" name="grand_total" type="number" placeholder="Grand Total" class="form-control round-input" value="0.0" readonly="" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="grand_total" class="control-label">Grand Total (INR)</label>
                                    <input id="grand_total_inr" name="grand_total_inr" type="number" placeholder="Grand Total" class="form-control round-input" value="0.0" readonly="" />
                                    </div>
                                    <div class="col-lg-2">
                                    <label for="cust_header_name" class="control-label">Custom Header Name</label>
                                    <input id="cust_header_name" name="cust_header_name" type="text" placeholder="Custom Header Name" class="form-control round-input" value="INVOICE" />
                                    </div> 
                                </div>

                                <div class="form-group ">
                                    <div class="col-lg-4">
                                    <label for="net_qnty" class="control-label">Buyer (if other than consignee)</label>
                                    <select id="am_id_other" name="am_id_other" class="form-control select2">
                                        <option value="">Select Buyer</option>
                                            <?php
                                            foreach($buyer_details as $bd){
                                                $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                            ?> 
                                                <option value="<?= $bd->am_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                     
                                </div>   
                                 
                                <div class="form-group" id="detail_table">
                                    <!--<table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Order #</th>
                                          <th scope="col">Article#</th>
                                          <th scope="col">Colour</th>
                                          <th scope="col">Item No.</th>
                                          <th scope="col">Ref No.</th>
                                          <th scope="col">Qnty</th>
                                          <th scope="col">Rate(INR)</th>
                                          <th scope="col">Rate (FOR)</th>
                                          <th scope="col">Addl. Charges</th>
                                          <th scope="col">Net Rate</th>                                          
                                          <th scope="col">Amount</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row">IO19-0014
                                          <input id="co_id" name="co_id_add[]" type="hidden" />
                                          </th>
                                          <td>1103298 - PURSE
                                          <input id="cod_id" name="cod_id_add[]" type="hidden" />
                                          <input id="am_id_detail" name="am_id_detail_add[]" type="hidden" />
                                          </td>
                                          <td>BLACK
                                          <input id="fc_id" name="fc_id_add[]" type="hidden" />
                                          <input id="lc_id" name="lc_id_add[]" type="hidden" />
                                          </td>
                                          <td><input id="item_no" name="item_no_add[]" type="text" class="form-control" /></td>
                                          <td><input id="reference_no" name="reference_no_add[]" type="text" class="form-control" /></td>
                                          <th><input id="quantity" name="quantity_add[]" type="text" class="form-control" /></th>
                                          <td><input id="rate_inr" name="rate_inr_add[]" type="text" class="form-control" /></td>
                                          <td><input id="rate_foreign" name="rate_foreign_add[]" type="text" class="form-control" /></td>
                                          <td><input id="additional_charges" name="additional_charges_add[]" type="text" class="form-control" /></td>
                                          <th><input id="net_rate" name="net_rate_add[]" type="text" class="form-control" /></th>
                                          <td><input id="amount" name="amount_add[]" type="text" class="form-control" /></td>
                                        </tr> 
                                        </tbody>
                                    </table>-->
                                </div>                                   

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" id="add_office_invoice_button" type="submit"><i class="fa fa-plus"> Add Office Invoice</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Office Invoice</i></a>
                                    </div>
                                </div>
                            </form>
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
	//Fetch all packing details
	$("#packing_shipment_id").change(function(){
        $packing_shipment_id = $(this).val();
		$rate_type = $('#rate_type').val();
		
		$table_str = '';
        $("#gross_weight").val('');
        $("#net_weight").val('');
        $.ajax({
            url: "<?= base_url('admin/ajax-all-packing-details') ?>",
            method: "post",
            dataType: 'json',
            data: {'packing_shipment_id': $packing_shipment_id, 'rate_type': $rate_type},
            success: function(result){
                console.log(JSON.stringify(result));
				$("#detail_table").html("");
				$table_str += '<table class="table">';
				  $table_str += '<thead>';
					$table_str += '<tr>';
					  $table_str += '<th scope="col">Sr #</th>';  
					  $table_str += '<th scope="col">Order #</th>';
					  $table_str += '<th scope="col">Article#</th>';
					  $table_str += '<th scope="col">Colour</th>';
					  $table_str += '<th scope="col">Item No.</th>';
					  $table_str += '<th scope="col">Ref No.</th>';
					  $table_str += '<th scope="col">Qnty</th>';
					  $table_str += '<th scope="col">Exchange Rate</th>';
					  $table_str += '<th scope="col">Rate (FOR)</th>';
					  $table_str += '<th scope="col">Addl. Charges</th>';
					  $table_str += '<th scope="col">Net Rate</th> ';                                         
					  $table_str += '<th scope="col">Amount</th>';
					  $table_str += '<th scope="col">Amount (INR)</th>';
					$table_str += '</tr>';
				  $table_str += '</thead>';
				  $table_str += '<tbody>';
				  
				  $table_iter = 1;
				$.each(result, function(index, item) {
					// console.log('item: '+item);
                
                    $("#gross_weight").val(item.gross_weight);
                    $("#net_weight").val(item.net_weight);

					$table_str += '<tr>';
					  $table_str += '<th scope="row">' + $table_iter++ + '</th>';
					  $table_str += '<th scope="row">'+item.co_no+'<input id="co_id_'+item.packing_shipment_detail_id+'" name="co_id_add[]" type="hidden" value="'+item.co_id+'" /></th>';
					  $table_str += '<td>'+item.art_no+'<input id="cod_id_'+item.packing_shipment_detail_id+'" name="cod_id_add[]" type="hidden" value="'+item.cod_id+'"/>';
					  $table_str += '<input id="am_id_detail_'+item.packing_shipment_detail_id+'" name="am_id_detail_add[]" type="hidden" value="'+item.am_id+'"/></td>';
					  $table_str += '<td>'+item.color+'<input id="fc_id_'+item.packing_shipment_detail_id+'" name="fc_id_add[]" type="hidden" value="'+item.fc_id+'"/><input id="lc_id_'+item.packing_shipment_detail_id+'" name="lc_id_add[]" type="hidden" value="'+item.lc_id+'"/></td>';
					  $table_str += '<td><input id="item_no_'+item.packing_shipment_detail_id+'" name="item_no_add[]" type="text" class="form-control" value="'+item.item+'"/></td>';
					  $table_str += '<td><input id="reference_no_'+item.packing_shipment_detail_id+'" name="reference_no_add[]" type="text" class="form-control" value="'+item.reference+'"/></td>';
					  $table_str += '<th><input id="quantity_'+item.packing_shipment_detail_id+'" name="quantity_add[]" type="text" class="form-control class_q" value="'+item.article_quantity+'" readonly/></th>';
					  $table_str += '<td><input id="rate_inr_'+item.packing_shipment_detail_id+'" name="rate_inr_add[]" type="number" class="form-control rate_inr" value="'+item.rate_inr+'"/></td>';
					  $table_str += '<td><input id="rate_foreign_'+item.packing_shipment_detail_id+'" name="rate_foreign_add[]" type="number" class="form-control class_r_fo" value="'+item.rate_foreign+'"/></td>';
					  $table_str += '<td><input id="additional_charges_'+item.packing_shipment_detail_id+'" name="additional_charges_add[]" type="number" class="form-control class_add_ch" value="'+item.additional_charges+'"/></td>';
					  $table_str += '<th><input id="net_rate_'+item.packing_shipment_detail_id+'" name="net_rate_add[]" type="number" class="form-control" value="'+item.net_rate+'"/ readonly></th>';
					  $table_str += '<td><input id="amount_'+item.packing_shipment_detail_id+'" name="amount_add[]" type="number" class="form-control amnt" value="'+item.amount+'" readonly/></td>';
					  $table_str += '<td><input id="amount_inr_'+item.packing_shipment_detail_id+'" name="amount_inr_add[]" type="number" class="form-control amnt_inr" value="'+item.amount_inr+'" readonly/></td>';
					$table_str += '</tr>'; 
					});
					$table_str += '</tbody>';
				$table_str += '</table>';
				
                $("#detail_table").html($table_str);
				
            },
            complete: function(){
                                    var qntty = 0;
                 $('.class_q').each(function () {
                                    qntty += parseFloat($(this).val());
                                });
                                var vallue = 0;
                                $('.amnt').each(function () {
                                    vallue += parseFloat($(this).val());
                                });
                                $("#net_qnty").val(qntty.toFixed(2));
                                $("#net_amnt").val(vallue.toFixed(2));
                                $("#grand_total").val(vallue.toFixed(2));
            },
            error: function(e){console.log(e);}
        });
    });
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
                    $(".rate_inr").val(result);
                    $new_res11 = 0;
        $('.rate_inr').each(function () {
                    $amnt1 = parseFloat($(this).closest('#detail_table tbody tr').find('.amnt').val());
                    $irate1 = parseFloat($(this).val());
                    var valluess = ($amnt1 * $irate1);
                    $(this).closest('#detail_table tbody tr').find('.amnt_inr').val(valluess.toFixed(2));
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

$(document).on('blur', '.class_add_ch', function () {
//                    alert(1);
                    $addt_cahrge = ($(this).val());
                    $frate = ($(this).parents().prev('td').find('input').val());
                    $irate = ($(this).parents().prev('td').prev('td').find('input').val());
                    $qunty = ($(this).closest('table tr').find('.class_q').val());
                    var res = (($addt_cahrge + $frate) * $qunty);
                    var res_inr = (res * $irate);
                    $(this).parent().next('td').closest('table tr').find('.amnt').val(res);
                     $(this).parent().next('td').next('td').closest('table tr').find('.amnt_inr').val(res_inr);

//                            net wt change
                    var net = parseFloat($addt_cahrge) + parseFloat($frate);
                    $(this).parent().next('td').find('input').val(net.toFixed(2));
                    $new_res = 0;
                    $new_res_inr = 0;
                 $('.class_add_ch').each(function () {
                     $frate1 = parseFloat($(this).closest('#detail_table tbody tr').find('.class_r_fo').val());
                     $irate1 = parseFloat($(this).closest('#detail_table tbody tr').find('.rate_inr').val());
                    $qunty1 = parseFloat($(this).closest('#detail_table tbody tr').find('.class_q').val());
                    $addt_cahrge1 = parseFloat($(this).val());
                    var vallue = (($frate1 + $addt_cahrge1) * $qunty1);
                    var vallue_inr = (vallue * $irate1);
                    $new_res += vallue;
                    $new_res_inr += vallue_inr;
                                });
                    var disc = parseFloat($("#disc").val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var res = ($new_res - ($new_res * (disc / 100)) + han_char);
                                $("#net_amnt").val(res.toFixed(2));
                                $("#grand_total").val(res.toFixed(2));
                                var res_inr = ($new_res_inr - ($new_res_inr * (disc / 100)) + han_char);
                                $("#net_amnt").val(res_inr.toFixed(2));
                                $("#grand_total").val(res_inr.toFixed(2));

                });

                $(document).on('blur', '.class_r_fo', function () {
                    $addt_cahrge = ($(this).parents().next('td').find('input').val());
                    $irate1 = parseFloat($(this).closest('#detail_table tbody tr').find('.rate_inr').val());
                    $qunty = ($(this).closest('table tr').find('.class_q').val());
                    $frate = ($(this).val());
                    var res = (($addt_cahrge + $frate) * $qunty);
                    var res_inr = res * $irate1;
                    $(this).parent().next('td').closest('table tr').find('.amnt').val(res);
                    $(this).parent().next('td').next('td').closest('table tr').find('.amnt_inr').val(res_inr);
                    $new_res = 0;
                 $('.class_r_fo').each(function () {
                     $addt_cahrge1 = parseFloat($(this).closest('#detail_table tbody tr').find('.class_add_ch').val());
                     $irate1 = parseFloat($(this).closest('#detail_table tbody tr').find('.rate_inr').val());
                    $qunty1 = parseFloat($(this).closest('#detail_table tbody tr').find('.class_q').val());
                    $frate1 = parseFloat($(this).val());
                    var vallue = (($frate1 + $addt_cahrge1) * $qunty1);
                    var vallue_inr = (vallue * $irate1);
                    $new_res += vallue;
                    $new_res_inr += vallue_inr;
                                });
                    var disc = parseFloat($("#disc").val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var res = ($new_res - ($new_res * (disc / 100)) + han_char);
                                $("#net_amnt").val(res.toFixed(2));
                                $("#grand_total").val(res.toFixed(2));
                    var res_inr = ($new_res_inr - ($new_res_inr * (disc / 100)) + han_char);
                    $("#net_amnt").val(res_inr.toFixed(2));
                    $("#grand_total").val(res_inr.toFixed(2));
                });
                
                
                $(document).on('blur', '.rate_inr', function () {
                    $amnt = ($(this).closest('table tr').find('.amnt').val());
                    $irate = ($(this).val());
                    var res = ($amnt * $irate);
                    $(this).closest('table tr').find('.amnt_inr').val(res);
                    $new_res = 0;
                 $('.rate_inr').each(function () {
                    $amnt1 = parseFloat($(this).closest('#detail_table tbody tr').find('.amnt').val());
                    $irate1 = parseFloat($(this).val());
                    var vallue = ($amnt1 * $irate1);
                    $new_res += vallue;
                                });
                    var disc = parseFloat($("#disc").val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var res = ($new_res - ($new_res * (disc / 100)) + han_char);
                                $("#net_amnt_inr").val(res.toFixed(2));
                                $("#grand_total_inr").val(res.toFixed(2));
                });
                

                function  calc_total($addt_cahrge, $frate, $qunty) {
//                            alert($addt_cahrge + ' ' + $frate + ' ' + $qunty);
                    $res = (parseFloat($frate) + parseFloat($addt_cahrge)) * parseFloat($qunty);
                    return $res.toFixed(2);
                }

                //  discount change
                $("#disc").blur(function () {
                    var disc = parseFloat($(this).val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var amntt = parseFloat($("#net_amnt").val());
                    var amntt_inr = parseFloat($("#net_amnt_inr").val());
                    var res = (amntt - (amntt * (disc / 100)) + han_char);
                    var res_inr = (amntt_inr - (amntt_inr * (disc / 100)) + han_char);
                    $("#grand_total").val(res.toFixed(2));
                    $("#grand_total_inr").val(res_inr.toFixed(2));
                });

                // handling charge areaw
                $("#hand_charge").blur(function () {
                    var disc = parseFloat($("#disc").val());
                    var han_char = parseFloat($("#hand_charge").val());
                    var amntt = parseFloat($("#net_amnt").val());
                    var amntt_inr = parseFloat($("#net_amnt_inr").val());
                    var res = (amntt - (amntt * (disc / 100)) + han_char);
                    var res_inr = (amntt_inr - (amntt_inr * (disc / 100)) + han_char);
                    $("#grand_total").val(res.toFixed(2));
                    $("#grand_total_inr").val(res_inr.toFixed(2));
                });
	
	function updateTotalRate(packing_shipment_detail_id){
		$rate_foreign = $('#rate_foreign_'+packing_shipment_detail_id).val();
		$quantity = $('#quantity_'+packing_shipment_detail_id).val();
		$additional_charges = $('#additional_charges_'+packing_shipment_detail_id).val();
		$amount = 0;
		
		if(parseFloat($rate_foreign) > 0 || parseFloat($quantity) > 0 || parseFloat($additional_charges) > 0){
			$amount = (parseFloat($rate_foreign) * parseFloat($quantity)) + parseFloat($additional_charges);
			$('#amount_'+packing_shipment_detail_id).val($amount);
		}
		console.log('packing_shipment_detail_id: '+packing_shipment_detail_id+' quantity: '+$quantity+' amount: '+$amount+' additional_charges: '+$additional_charges);
	}//end function updateTotalRate
	
	$("#am_id").change(function(){
        $am_id = $(this).val();
        var am_id_val = $('option:selected',this).data("value");
        // $("#currency").val(am_id_val).change();
        $.ajax({
            url: "<?= base_url('admin/ajax-all-account-declaration') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id,},
            success: function(result){
                // console.log(JSON.stringify(result));
                $("#acc_master_declar_id").html("");
				$.each(result, function(index, item) {
					$str = '<option value=' + item.INVOICE_DECLARATION_SEQ + '> '+ item.DECLARATION_SUBJECT + '</option>';
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
		
    //add-item-form validation and submit
    $("#form_add_office_invoice").validate({
        
        rules: {
            office_invoice_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-office-invoice-number')?>",
                    type: "post",
                    data: {
                        office_invoice_number: function() {
                          return $("#office_invoice_number").val();
                        }
                    },
                },
            },
            office_invoice_date: {
                required: true
            },
            packing_shipment_id: {
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
            },
            office_proforma_id: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_office_invoice').ajaxForm({
        beforeSubmit: function () {
             //alert('HI');
            $('#add_office_invoice_button').prop('disabled', true);
            return $("#form_add_office_invoice").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.office_invoice_id > 0){
				$('#form_add_office_invoice')[0].reset(); //reset form
				$("#form_add_office_invoice select").select2("val", ""); //reset all select2 fields
				$('#form_add_office_invoice :radio').iCheck('update'); //reset all iCheck fields
				$("#form_add_office_invoice").validate().resetForm(); //reset validation
				$("#detail_table").html("");
				window.location.href = '<?=base_url()?>admin/office-invoice-edit/'+obj.office_invoice_id;
				//$('#edit_btn').removeClass('hidden');
			}
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
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
</script>

</body>
</html>