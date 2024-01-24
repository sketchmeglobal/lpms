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
    <title>Lining List Add| <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Lining List Add</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Lining List Add</li>
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
                            <form id="form_lining_list_add" method="post" action="<?=base_url('admin/form-lining-list-add')?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                <div class="col-lg-3">
                                    <label for="e_id" class="control-label text-danger">Select Employee *</label>
                                    <select id="e_id" name="e_id" class="form-control select2">
                                    <option value="">Select Employee</option>
                                            <?php
                                            foreach($employee_details as $emp_detail){
                                                $sn = ($emp_detail->e_code == '' ? '-' : $emp_detail->e_code);
                                            ?> 
                                                <option value="<?= $emp_detail->e_id ?>" short_name="<?=$emp_detail->name?>" e_code="<?=$emp_detail->e_code?>"><?= $emp_detail->name . ' ['. $sn .']' ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                        <label for="lining_start_date_time" class="control-label text-danger">Entry Date *</label>
                                        <input id="lining_start_date_time" name="lining_start_date_time" type="date" placeholder="Entry Date" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-2">
                                                    <label for="extra_time" class="control-label text-danger">Extra Time</label>
                                                    <input type="number" id="extra_time" name="extra_time" class="form-control" />
                                                </div>
                                
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Lining List</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Lining List</i></a>
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

    $("#am_id").change(function(){
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
    });
    
    //add-item-form validation and submit
    $("#form_lining_list_add").validate({
        
        rules: {
            e_id: {
                required: true
            },
            lining_start_date_time: {
                required: true
            },
            lining_end_date_time: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_lining_list_add').ajaxForm({
        beforeSubmit: function () {
            return $("#form_lining_list_add").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            //console.log(obj);
            notification(obj);
            
            if(obj.insert_id > 0){
                $('#form_lining_list_add')[0].reset(); //reset form
                $("#form_lining_list_add select").select2("val", ""); //reset all select2 fields
                $('#form_lining_list_add :radio').iCheck('update'); //reset all iCheck fields
                $("#form_lining_list_add").validate().resetForm(); //reset validation
    
                $('#edit_btn').attr('href', '<?=base_url()?>admin/lining-list-edit/'+obj.insert_id);
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