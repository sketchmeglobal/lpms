<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:15
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Entry User | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        text-align: right;
        }

        /* Firefox */
        input[type=number] {
            text-align: right;
            -moz-appearance: textfield;
        }

        .border-black-bottom{border-bottom: 1px dotted #000}
        .nowrap{white-space: nowrap;}

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff} 
    </style>

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
            <h3 class="m-b-less">Change Entry User</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Change Entry User </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12" style="overflow-x: scroll;">
                    <section class="panel">
                        <div class="panel-body">
                            
                            
                                                        <form id="form_change_user_id" method="post" action="<?= base_url('admin/change-all-user-details') ?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <select id="entry_type" name="entry_type" required class="form-control select2">
                                                <option value=""> Select Category </option>
                                                <option value="1"> Article Master </option>
                                                <option value="2"> Article Costing </option>
                                                <option value="3"> Customer Order </option>
                                                <option value="4"> Cutting Issue </option>
                                                <option value="5"> Cutting Receive </option>
                                                <option value="7"> Skiving Receive </option>
                                                <option value="8"> Jobber Issue </option>
                                                <option value="9"> Jobber Receive </option>
                                                <option value="10"> Sample Issue </option>
                                                <option value="11"> Sample Receive </option>
                                                <option value="12">  Cutter Bill  </option>
                                                </select>
                                    </div>
                                    <div class="col-sm-3">
                                       <select id="entry_id" name="entry_id" required class="form-control select2">
                                           <option value="">   Select Item No.  </option>
                                                </select>
                                                <input type="hidden" name="tables_name" id="tables_name" value=""/>
                                                <input type="hidden" name="primarys_key" id="primarys_key" value=""/>
                                    </div>
                                    <div class="col-lg-3">
                                        <select id="user_id" name="user_id" required class="form-control select2">
                                                <option value=""> Select User Name </option>
                                                <?php
                                                        foreach ($user_list as $u_l) {
                                                        ?>
                                                        <option value="<?= $u_l->user_id ?>"><?= $u_l->username ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <button name="submit" value="update" class="btn btn-success" type="submit"><i class="fa fa-search"> Update </i></button>
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
<!--Data Table-->
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script>
<!--data table init-->
<script src="<?=base_url()?>assets/admin_panel/js/data-table-init.js"></script>
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
    $(document).ready(function() {

    $("#entry_type").change(function(){

        $am_gr = $(this).val(); 
        $.ajax({
            url: "<?= base_url('ajax-fetch-all-added-items') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_gr': $am_gr},
            success: function(returnData){
                console.log(returnData);
                
                
                $('#entry_id').select2("val", "");
                
                
                // $("#article_number").html("<option value=''>Select Article</option>");
                $.each(returnData, function (index, itemData) {
                    $str2 = '<option value="'+itemData.items_id +'" value2="'+itemData.items_name+'" value3="'+itemData.p_key+'">'+ itemData.items_no +'</option>';
                    $("#entry_id").append($str2);
                });
                
                $('#entry_id').select2('open');

            },
        });
    });
    
    
    $("#entry_id").change(function(){

        var option2 = $('option:selected', this).attr('value2');
        var option3 = $('option:selected', this).attr('value3');
        $('#tables_name').val(option2);
        $('#primarys_key').val(option3);
    });
    
    
    
    
    $("#form_change_user_id").validate({
        rules: {
            entry_type: {
                required: true
            },
            entry_id: {
                required: true
            },
            user_id: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_change_user_id').ajaxForm({
        beforeSubmit: function () {
            return $("#form_change_user_id").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });
    
    
    } );


	
	
	// delete area 
    // delete area ends 
    //toastr notification
    function notification(obj) {
        // console.log(obj);
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "500",
            "timeOut": "10000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }

</script>

</body>
</html>