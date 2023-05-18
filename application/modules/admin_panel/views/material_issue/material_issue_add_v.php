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
    <title>Add Material Issue | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Add Material Issue</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Material Issue</li>
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
                            <form id="form_add_receive_purchase_order" method="post" action="<?=base_url('admin/form-add-material-issue')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="material_issue_slip_number" class="control-label text-danger">Issue Slip Number*</label>
                                    <input id="material_issue_slip_number" name="material_issue_slip_number" type="text" placeholder="Issue Slip Number" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-3">
                                    <label for="material_issue_date" class="control-label text-danger">Issue Date*</label>
                                    <input id="material_issue_date" name="material_issue_date" type="date" placeholder="Issue Date" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="material_issue_to_form" class="control-label text-danger">Issue To / From*</label>
                                        <select id="material_issue_to_form" name="material_issue_to_form" class="form-control select2">
                                        <option value="">Issue To / From</option>
                                        <option value="1">Godown</option>
                                        <option value="2">Fabricator</option>
                                        <option value="3">Stock Out</option>
                                        <option value="4">Stock Return</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3" style="display:none" id="challan_div">
                                        <label for="jobber_challan_receipt_id" class="control-label text-danger">Challan No*</label>
                                        <select id="jobber_challan_receipt_id" name="jobber_challan_receipt_id" class="form-control select2">
                                        <option value="">Challan No</option>
                                        <?php
											foreach($jobber_challan_details as $jcd){
											    foreach($jobber_challan_details1 as $jcd1) {
											        if($jcd->jobber_issue_id == $jcd1->jobber_challan_receipt_id) {
											            continue 2;
											        }
											    }
											?> 
												<option value="<?= $jcd->jobber_issue_id ?>"><?= $jcd->jobber_challan_number ?></option>
										<?php
											}
										?>
                                        </select>
                                    </div>   
                                                                    
                                    <div class="col-lg-3" style="display:none" id="supplier_div">
                                        <label for="am_id" class="control-label text-danger">Supplier*</label>
                                        <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Supplier</option>
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
                                    
                                    <div class="col-lg-3">
                                        <label for="terms_condition" class="control-label">Terms and Conditions</label>

                                        <textarea id="terms_condition" name="terms_condition" placeholder="Terms and Conditions" class="form-control round-input"></textarea>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="remarks" class="control-label">Remarks</label>

                                        <textarea id="remarks" name="remarks" placeholder="Remarks" class="form-control round-input"></textarea>
                                    </div>
                                    
                                </div>                               

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Material Issue</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Material Issue</i></a>
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
	//Get ajax Purchase order
	/*$("#pur_order_date").change(function(){
        $pur_order_date = $(this).val();
        $.ajax({
            url: "<?= base_url('admin/ajax-all-purchase-order') ?>",
            method: "post",
            dataType: 'json',
            data: {'pur_order_date': $pur_order_date,},
            success: function(all_items){
                console.log(all_items);
                $("#po_id").html("");
				if(all_items.status == true){
					$.each(all_items.all_po, function(index, item) {
						$str = '<option value=' + item.po_id + ' item_group_val=' + item.po_id + '> '+ item.po_number + '</option>';
						$("#po_id").append($str);
					});
				}else{
					alert(all_items.message);
				}
                // open the item tray 
                //$('#id_id').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });*/
	
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
    $("#form_add_receive_purchase_order").validate({
        
        rules: {
            material_issue_slip_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-material-issue-number')?>",
                    type: "post",
                    data: {
                        material_issue_slip_number: function() {
                          return $("#material_issue_slip_number").val();
                        }
                    },
                },
            },
            material_issue_date: {
                required: true
            },
            material_issue_to_form: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_receive_purchase_order').ajaxForm({
        beforeSubmit: function () {
             //alert('HI');
            return $("#form_add_receive_purchase_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_add_receive_purchase_order')[0].reset(); //reset form
				$("#form_add_receive_purchase_order select").select2("val", ""); //reset all select2 fields
				$('#form_add_receive_purchase_order :radio').iCheck('update'); //reset all iCheck fields
				$("#form_add_receive_purchase_order").validate().resetForm(); //reset validation
	
				window.location.href = '<?=base_url()?>admin/material-issue-edit/'+obj.insert_id;
				$('#edit_btn').removeClass('hidden');
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