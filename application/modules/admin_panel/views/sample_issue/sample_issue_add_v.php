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
    <title>Sample Challan Issue Add | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Sample Challan Issue Add</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Sample Challan Issue Add</li>
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
                            <form id="form_sample_challan_issue_add" method="post" action="<?=base_url('admin/form-sample-challan-issue-add')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                            	    
                                <div class="col-lg-3">
                                    <label for="sample_type_add" class="control-label text-danger">Select Sample Type *</label>
                                    <select id="sample_type_add" name="sample_type_add" class="form-control select2">
                                    <option value="">Select Sample Type</option>
                                                <option value="1">Sample</option>
                                                <option value="2">Gift</option>
                                    </select>
                                </div>
                            	    
                                <div class="col-lg-3">
                                    <label for="am_id_add" class="control-label text-danger">Select Jobber *</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Jobber</option>
                                            <?php
                                            foreach($account_master_details as $amd){
                                                $sn = ($amd->short_name == '' ? '-' : $amd->short_name);
                                            ?> 
                                                <option value="<?= $amd->am_id ?>" short_name="<?=$amd->short_name?>" am_code="<?=$amd->am_code?>"><?= $amd->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                    
                                	<div class="col-lg-3">
                                    <label for="sample_challan_number" class="control-label text-danger">Sample Challan Number *</label>
                                    <input id="sample_challan_number" name="sample_challan_number" type="text" placeholder="Sample Challan Number" class="form-control round-input" readonly />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="sample_issue_date" class="control-label text-danger">Issue Date *</label>
                                        <input id="sample_issue_date" name="sample_issue_date" type="date" placeholder="Issue Date" class="form-control round-input" />
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Issue Challan</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Issue Challan</i></a>
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

	$("#sample_type_add").change(function(){
        $am_id = $(this).val();
        $sample_type_add = $('#sample_type_add').val();
		
        $.ajax({
            url: "<?= base_url('admin/ajax-sample-challan-issue-number') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id, 'sample_type_add': $sample_type_add},
            success: function(result){
                console.log(JSON.stringify(result));
                if($sample_type_add == 1) {
				$('#sample_challan_number').val('SAM'+'/'+result.sample_challan_id);
                } else {
                $('#sample_challan_number').val('GIF'+'/'+result.sample_challan_id);    
                }
            },
            error: function(e){console.log(e);}
        });
    });		
    //add-item-form validation and submit
    $("#form_sample_challan_issue_add").validate({
        
        rules: {
            sample_type_add: {
                required: true
            },
			am_id: {
                required: true
            },
            sample_challan_number: {
                required: true
            },
            sample_issue_date: {
                required: true
            }
        },
        messages: {

        }
        
    });
    $('#form_sample_challan_issue_add').ajaxForm({
        beforeSubmit: function () {			
            return $("#form_sample_challan_issue_add").valid(); 			
            
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_sample_challan_issue_add')[0].reset(); //reset form
				$("#form_sample_challan_issue_add select").select2("val", ""); //reset all select2 fields
				$('#form_sample_challan_issue_add :radio').iCheck('update'); //reset all iCheck fields
				$("#form_sample_challan_issue_add").validate().resetForm(); //reset validation
				window.location.href = '<?=base_url()?>admin/sample-challan-issue-edit/'+obj.insert_id;
				// $('#edit_btn').attr('href', '<?=base_url()?>admin/jobber-challan-issue-edit/'+obj.insert_id);
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