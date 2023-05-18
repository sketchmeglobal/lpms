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
    <title>Add Jobber Bill | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Add Jobber Bill</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Jobber Bill</li>
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
                            <form id="form_jobber_bill_add" method="post" action="<?=base_url('admin/form-add-jobber-bill')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                
                                <div class="col-lg-3">
                                    <label for="am_id" class="control-label text-danger">Select Jobber*</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Jobber</option>
                                        <?php foreach($jobber_details as $jobber){?>
                                        <option value="<?=$jobber->am_id?>"><?=$jobber->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                	<label for="jobber_bill_number" class="control-label text-danger">Jobber Bill Number *</label>
                                	<input id="jobber_bill_number" name="jobber_bill_number" type="text" placeholder="Jobber Bill Number" class="form-control round-input" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="jobber_bill_date" class="control-label text-danger">Jobber Bill Date *</label>
                                    <input id="jobber_bill_date" name="jobber_bill_date" type="date" placeholder="Jobber Bill Date" class="form-control round-input" />
                                </div>
                                
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Jobber Bill</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Jobber Bill</i></a>
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
	
    //add-item-form validation and submit
    $("#form_jobber_bill_add").validate({
        
        rules: {
            am_id: {
                required: true
            },
			jobber_bill_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-jobber-bill-number')?>",
                    type: "post",
                    data: {
                        jobber_bill_number: function() {
                          return $("#jobber_bill_number").val();
                        }
                    },
                },
            },
			jobber_bill_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_jobber_bill_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_jobber_bill_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_jobber_bill_add')[0].reset(); //reset form
				$("#form_jobber_bill_add select").select2("val", ""); //reset all select2 fields
				$('#form_jobber_bill_add :radio').iCheck('update'); //reset all iCheck fields
				$("#form_jobber_bill_add").validate().resetForm(); //reset validation
	
				$('#edit_btn').attr('href', '<?=base_url()?>admin/edit-jobber-bill/'+obj.insert_id);
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