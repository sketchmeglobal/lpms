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
    <title>Receive Challan| <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Receive Challan</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Receive Challan</li>
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
                            <form id="form_add_receive_challan" method="post" action="<?=base_url('admin/form-add-receive-challan')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="am_id_add" class="control-label text-danger">Select Cutter *</label>
                                    <select id="am_id" name="am_id" class="form-control select2">
                                    <option value="">Select Cutter</option>
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
                                    <label for="cut_rcv_number" class="control-label text-danger">Cutting Receive Number *</label>
                                    <input id="cut_rcv_number" name="cut_rcv_number" type="text" placeholder="Cutting Receive Number" class="form-control round-input" />
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="cut_rcv_date" class="control-label text-danger">Cutting Receive Date *</label>
                                        <input id="cut_rcv_date" name="cut_rcv_date" type="date" placeholder="Cutting Receive Date" class="form-control round-input" />
                                    </div>
                                    
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Receive Challan</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Receive Challan</i></a>
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
	
    //add-item-form validation and submit
    $("#form_add_receive_challan").validate({
        
        rules: {
			am_id: {
                required: true
            },
            cut_rcv_number: {
                required: true
            },
            cut_rcv_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_receive_challan').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_receive_challan").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_add_receive_challan')[0].reset(); //reset form
				$("#form_add_receive_challan select").select2("val", ""); //reset all select2 fields
				$('#form_add_receive_challan :radio').iCheck('update'); //reset all iCheck fields
				$("#form_add_receive_challan").validate().resetForm(); //reset validation
	            window.location.href = '<?=base_url()?>admin/edit-cutting-receive/'+obj.insert_id;
				// $('#edit_btn').attr('href', '<?=base_url()?>admin/edit-cutting-receive/'+obj.insert_id);
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