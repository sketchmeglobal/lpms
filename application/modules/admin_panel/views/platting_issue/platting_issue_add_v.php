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
    <title>Add Platting Issue | <?=WEBSITE_NAME;?></title>
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
    <div class="body-content" style="min-height: 600px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Add Platting Issue</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Platting Issue</li>
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
                            <form id="form_add_office_invoice" method="post" action="<?=base_url('admin/form-add-platting-issue')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="platting_issue_number" class="control-label text-danger">Platting Issue Number*</label>
                                    <input id="platting_issue_number" name="platting_issue_number" type="text" placeholder="Platting Issue Number" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="platting_issue_date" class="control-label text-danger">Date *</label>
                                        <input id="platting_issue_date" name="platting_issue_date" type="date" placeholder="Date" class="form-control round-input" />
                                    </div>
                                    
                                    <!--  -->
                                 	</div>
                                                                   

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Platting Issue</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Platting Issue</i></a>
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
					  $table_str += '<th scope="col">Order #</th>';
					  $table_str += '<th scope="col">Article#</th>';
					  $table_str += '<th scope="col">Colour</th>';
					  $table_str += '<th scope="col">Item No.</th>';
					  $table_str += '<th scope="col">Ref No.</th>';
					  $table_str += '<th scope="col">Qnty</th>';
					  $table_str += '<th scope="col">Rate(INR)</th>';
					  $table_str += '<th scope="col">Rate (FOR)</th>';
					  $table_str += '<th scope="col">Addl. Charges</th>';
					  $table_str += '<th scope="col">Net Rate</th> ';                                         
					  $table_str += '<th scope="col">Amount</th>';
					$table_str += '</tr>';
				  $table_str += '</thead>';
				  $table_str += '<tbody>';
				  
				$.each(result, function(index, item) {
					//console.log('item: '+item);
					$table_str += '<tr>';
					  $table_str += '<th scope="row">'+item.co_no+'<input id="co_id_'+item.packing_shipment_detail_id+'" name="co_id_add[]" type="hidden" value="'+item.co_id+'" /></th>';
					  $table_str += '<td>'+item.art_no+'<input id="cod_id_'+item.packing_shipment_detail_id+'" name="cod_id_add[]" type="hidden" value="'+item.cod_id+'"/>';
					  $table_str += '<input id="am_id_detail_'+item.packing_shipment_detail_id+'" name="am_id_detail_add[]" type="hidden" value="'+item.am_id+'"/></td>';
					  $table_str += '<td>'+item.color+'<input id="fc_id_'+item.packing_shipment_detail_id+'" name="fc_id_add[]" type="hidden" value="'+item.fc_id+'"/><input id="lc_id_'+item.packing_shipment_detail_id+'" name="lc_id_add[]" type="hidden" value="'+item.lc_id+'"/></td>';
					  $table_str += '<td><input id="item_no_'+item.packing_shipment_detail_id+'" name="item_no_add[]" type="text" class="form-control" value="'+item.item+'"/></td>';
					  $table_str += '<td><input id="reference_no_'+item.packing_shipment_detail_id+'" name="reference_no_add[]" type="text" class="form-control" value="'+item.reference+'"/></td>';
					  $table_str += '<th><input id="quantity_'+item.packing_shipment_detail_id+'" name="quantity_add[]" type="number" class="form-control" value="'+item.article_quantity+'" onblur="updateTotalRate('+item.packing_shipment_detail_id+')"/></th>';
					  $table_str += '<td><input id="rate_inr_'+item.packing_shipment_detail_id+'" name="rate_inr_add[]" type="number" class="form-control" value="'+item.rate_inr+'"/></td>';
					  $table_str += '<td><input id="rate_foreign_'+item.packing_shipment_detail_id+'" name="rate_foreign_add[]" type="number" class="form-control" value="'+item.rate_foreign+'" onblur="updateTotalRate('+item.packing_shipment_detail_id+')"/></td>';
					  $table_str += '<td><input id="additional_charges_'+item.packing_shipment_detail_id+'" name="additional_charges_add[]" type="number" class="form-control" value="'+item.additional_charges+'"   onblur="updateTotalRate('+item.packing_shipment_detail_id+')"/></td>';
					  $table_str += '<th><input id="net_rate_'+item.packing_shipment_detail_id+'" name="net_rate_add[]" type="number" class="form-control" value="'+item.net_rate+'"/></th>';
					  $table_str += '<td><input id="amount_'+item.packing_shipment_detail_id+'" name="amount_add[]" type="number" class="form-control" value="'+item.amount+'"/></td>';
					$table_str += '</tr>'; 
					});
					$table_str += '</tbody>';
				$table_str += '</table>';
				
                $("#detail_table").html($table_str);
				
            },
            error: function(e){console.log(e);}
        });
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
        $.ajax({
            url: "<?= base_url('admin/ajax-all-account-declaration') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id,},
            success: function(result){
                console.log(JSON.stringify(result));
                $("#acc_master_declar_id").html("");
				$.each(result, function(index, item) {
					$str = '<option value=' + item.acc_master_declar_id + '> '+ item.declaration_subject + '</option>';
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
            platting_issue_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-platting-issue-number')?>",
                    type: "post",
                    data: {
                        platting_issue_number: function() {
                          return $("#platting_issue_number").val();
                        }
                    },
                },
            },
            platting_issue_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_office_invoice').ajaxForm({
        beforeSubmit: function () {
             //alert('HI');
            return $("#form_add_office_invoice").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_add_office_invoice')[0].reset(); //reset form
				$("#form_add_office_invoice select").select2("val", ""); //reset all select2 fields
				$('#form_add_office_invoice :radio').iCheck('update'); //reset all iCheck fields
				$("#form_add_office_invoice").validate().resetForm(); //reset validation
				window.location.href = '<?=base_url()?>admin/platting-issue-edit/'+obj.insert_id;
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