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
    <title>Jobber Challan Receipt Add| <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Jobber Challan Receipt Add</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Jobber Challan Receipt Add</li>
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
                            <form id="form_jobber_challan_receipt_add" method="post" action="<?=base_url('admin/form-jobber-challan-receipt-add')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-4">
                                    <label for="am_id" class="control-label text-danger">Select Jobber *</label>
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
                                    
                                	<div class="col-lg-4">
                                    <label for="jobber_receipt_challan_number" class="control-label text-danger">Jobber Receipt Number *</label>
                                    <input id="jobber_receipt_challan_number" name="jobber_receipt_challan_number" type="text" placeholder="Jobber Receipt Number" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="jobber_receipt_challan_date" class="control-label text-danger">Receipt Date *</label>
                                        <input id="jobber_receipt_challan_date" name="jobber_receipt_challan_date" type="date" placeholder="Receipt Date" class="form-control round-input" />
                                    </div>
                                    
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Receipt Challan </i></button>
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

	/*$("#am_id").change(function(){
        $am_id = $(this).val();
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
    });*/
	
    //add-item-form validation and submit
    $("#form_jobber_challan_receipt_add").validate({
        
        rules: {
			am_id: {
                required: true
            },
            jobber_receipt_challan_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax_unique_jobber_receipt_number')?>",
                    type: "post",
                    data: {
                        jobber_receipt_challan_number: function() {
                          return $("#jobber_receipt_challan_number").val();
                        }
                    },
                },
            },
            jobber_receipt_challan_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_jobber_challan_receipt_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_jobber_challan_receipt_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_jobber_challan_receipt_add')[0].reset(); //reset form
				$("#form_jobber_challan_receipt_add select").select2("val", ""); //reset all select2 fields
				$('#form_jobber_challan_receipt_add :radio').iCheck('update'); //reset all iCheck fields
				$("#form_jobber_challan_receipt_add").validate().resetForm(); //reset validation
	
				//$('#edit_btn').attr('href', '<?=base_url()?>admin/jobber-challan-receipt-edit/'+obj.insert_id);
				window.location.href = '<?=base_url()?>admin/jobber-challan-receipt-edit/'+obj.insert_id;
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