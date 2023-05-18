<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Office Proforma | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Add Office Proforma</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Office Proforma</li>
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
                            <form id="form_office_proforma_add" method="post" action="<?=base_url('admin/form-add-office-proforma')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-3">
                                	<label for="proforma_number" class="control-label text-danger">Proforma Number *</label>
                                	<input id="proforma_number" name="proforma_number" type="text" placeholder="Proforma Number" class="form-control round-input" />
                                </div>
                                <div class="col-lg-2">
                                    <label for="proforma_date" class="control-label text-danger">Date *</label>
                                    <input id="proforma_date" name="proforma_date" type="date" placeholder="Date" class="form-control round-input" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="buyer" class="control-label text-danger">Select Buyer *</label>
                                    <select id="buyer" name="buyer" class="form-control select2">
                                        <?php foreach ($buyer_details as $bd): ?>
                                            <option value="<?= $bd->am_id ?>" data-value="<?= $bd->cur_id ?>"><?= $bd->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                        <label for="currency" class="control-label text-danger">Select Currency</label>
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
                                <div class="col-lg-2">
                                    <label for="rate_type" class="control-label text-danger">Rate Type *</label>
                                    <select id="rate_type" name="rate_type" class="form-control select2">
                                        <option value="">Rate Type</option>
                                        <option value="1">Ex. Works</option>
                                        <option value="2">CIF </option>
                                        <option value="3">FOB</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="terms_condition" class="control-label">Terms & Condition</label>
                                    <input id="terms_condition" name="terms_condition" type="text" placeholder="Terms & Condition" class="form-control round-input" />
                                </div>	
                                <div class="col-lg-4">
                                    <label for="notify" class="control-label">Notify</label>
                                    <input id="notify" name="notify" type="text" placeholder="Notify" class="form-control round-input" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="desc_of_goods" class="control-label">Description of Goods</label>
                                    <input id="desc_of_goods" name="desc_of_goods" type="text" placeholder="Description of Goods" class="form-control round-input" />
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
                                
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Office Proforma</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Office Proforma</i></a>
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
	$("#pur_order_date").change(function(){
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
    });
	
	$("#buyer").change(function(){
        $am_id = $(this).val();
        var am_id_val = $('option:selected',this).data("value");
        $("#currency").val(am_id_val).change();
    });
	
    //add-item-form validation and submit
    $("#form_office_proforma_add").validate({
        
        rules: {
            proforma_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-proforma-number')?>",
                    type: "post",
                    data: {
                        proforma_number: function() {
                          return $("#proforma_number").val();
                        }
                    },
                },
            },
			proforma_date: {
                required: true
            },
            rate_type: {
                required: true
            },
            buyer:{
                required: true
            },
        },
        messages: {

        }
    });
    $('#form_office_proforma_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_office_proforma_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_office_proforma_add')[0].reset(); //reset form
				$("#form_office_proforma_add select").select2("val", ""); //reset all select2 fields
				$('#form_office_proforma_add :radio').iCheck('update'); //reset all iCheck fields
				$("#form_office_proforma_add").validate().resetForm(); //reset validation
	            window.location.href = '<?=base_url()?>admin/edit-office-proforma/'+obj.insert_id;
                
				// $('#edit_btn').attr('href', '<?=base_url()?>admin/edit-office-proforma/'+obj.insert_id);
				// $('#edit_btn').removeClass('hidden');
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