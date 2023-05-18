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
    <title>Skiving Receive Add | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Skiving Receive</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Skiving Receive</li>
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
                            <form id="form_skiving_receive_add" method="post" action="<?=base_url('admin/form-skiving-receive-add')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                <!-- <div class="col-lg-4">
                                    <label for="cut_rcv_id" class="control-label text-danger">Skiving Issue Challan Number *</label>
                                    <select id="cut_rcv_id" name="cut_rcv_id" class="form-control select2">
                                    <option value="">Select Skiving Issue Challan Number</option>
                                            <?php
                                            foreach($skiving_issue_number as $sin){
                                            ?> 
                                                <option value="<?=$sin->cut_rcv_id?>"><?=$sin->skiving_issue_number?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>-->
                                <div class="col-lg-4">
                                    <label for="skiving_receive_challan_number" class="control-label text-danger">Skiving Receive Challan Number *</label>
                                    <input id="skiving_receive_challan_number" name="skiving_receive_challan_number" type="text" placeholder="Skiving Receive Challan Number" class="form-control round-input" />
                                    </div>
                                <div class="col-lg-4">
                                        <label for="skiving_receive_date" class="control-label text-danger">Skiving Receive Date *</label>
                                        <input id="skiving_receive_date" name="skiving_receive_date" type="date" placeholder="Skiving Receive Date" class="form-control round-input" />
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
    $("#form_skiving_receive_add").validate({
        
        rules: {
			cut_rcv_id: {
                required: true
            },
			skiving_receive_challan_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-skiving-receive-challan-number')?>",
                    type: "post",
                    data: {
                        skiving_receive_challan_number: function() {
                          return $("#skiving_receive_challan_number").val();
                        }
                    },
                },
            },
            skiving_receive_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_skiving_receive_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_skiving_receive_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				window.location.href = '<?=base_url()?>admin/skiving-receive-edit/'+obj.insert_id;
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