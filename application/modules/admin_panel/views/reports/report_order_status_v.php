<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Status | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Order Status">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

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
            <h3 class="m-b-less">Report - Customer Order Status</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Order Status </li>
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
                            <form id="form_customer_order" method="post" action="<?= base_url('admin/report-order-status-details') ?>" class="cmxform form-horizontal tasi-form" novalidate="novalidate" target="_blank">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 text-danger">Select Customer Order*</label>
                                    <div class="col-lg-3">
                                        <select id="customer_order" multiple="" name="customer_order[]" class="form-control select2">
                                            <option value="">Select Customer Order</option>
                                            <?php foreach ($co_ids as $co_id) {
                                                ?>
                                                <option value="<?= $co_id->co_id ?>"><?= $co_id->co_no ?></option>
                                                <?php
                                            } ?>
                                         </select>
                                    </div>

                                    <div class="col-lg-7">
                                        <button name="submit" value="order_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Order Summary</i></button>
                                        <button name="submit" id="consumption_btn" value="consumption_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Consumption Details</i></button>
                                        <button name="submit" value="order_summary" class="btn btn-success" type="submit"><i class="fa fa-search"> Order Details</i></button>
                                        <!--<button name="submit" value="order_details_with_brkup_anty_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Order Summary (With Brkup Details) </i></button>-->
                                    </div>
                                </div>
                            </form>
                            
                            <br><br>
                            <div style="text-align: center; border-top: 1px solid black">
                                <div style="display: inline-block; position: relative; top: -10px; background-color: white; padding: 0px 10px">OR</div>
                            </div>
                            <br>

                            <form id="form_article_number" method="post" action="<?= base_url('admin/report-order-status-details') ?>" class="cmxform form-horizontal tasi-form" novalidate="novalidate" target="_blank">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 text-danger">Select Article Group*</label>
                                    <div class="col-lg-3">
                                        <select id="article_group" name="article_group" class="form-control select2">
                                            <option value="">Select Article Group</option>
                                            <?php foreach ($am_id_grs as $am_grs) {
                                                ?>
                                                <option value="<?= $am_grs->ag_id ?>"><?= $am_grs->group_name ?></option>
                                                <?php
                                            } ?>
                                         </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select id="article_number" multiple="" name="article_number[]" class="form-control select2">
                                            <option value="">Select Article Group First</option>
                                         </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <button name="submit" value="article_wise_order_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Artice Wise Order Details</i></button>
                                    </div>
                                </div>
                            </form>

                            <br><br>
                            <div style="text-align: center; border-top: 1px solid black">
                                <div style="display: inline-block; position: relative; top: -10px; background-color: white; padding: 0px 10px">OR</div>
                            </div>
                            <br>

                            <form id="buyer_wise_order_details" method="post" action="<?= base_url('admin/report-order-status-details') ?>" class="cmxform form-horizontal tasi-form" novalidate="novalidate" target="_blank">
                                <div class="form-group ">
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="control-label text-danger">Select Buyer*</label>
                                                <select id="buyer_wise_order_details" name="buyer_wise_order_details[]" multiple="" class="form-control select2">
                                                    <option value="">Select Buyer</option>
                                                    <?php foreach ($buyers as $buyer) {
                                                        ?>
                                                        <option value="<?= $buyer->am_id ?>"><?= $buyer->name . ' ['. $buyer->short_name .']' ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-sm-6">
                                                <label class="control-label">Select From Date</label>
                                                <input type="date" name="buyer_wise_from_date" id="buyer_wise_from_date" class="form-control" value="<?=YEAR_START_DATE?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label">Select To Date</label>
                                                <input type="date" name="buyer_wise_to_date" id="buyer_wise_to_date" class="form-control" value="<?=YEAR_END_DATE?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-offset-1">
                                        <div class="row">
                                            <label class="control-label">Action</label><br> 
                                            <button name="submit" value="buyer_wise_order_details_pending" class="btn btn-success" type="submit"><i class="fa fa-search"> Buyer Wise (Pending)</i></button>
                                            <button name="submit" value="buyer_and_article_wise_order_details_pending" class="btn btn-success" type="submit"><i class="fa fa-search"> Buyer & Article Wise (Pending)</i></button>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <br>
                                            <button name="submit" id="buyer_wise_cust_ord_status" value="buyer_wise_order_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Buyer Wise (Date)</i></button>
                                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!--Select2-->
<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>

<script>
    $('.select2').select2();

    $("#article_group").change(function(){

        $am_gr = $(this).val(); 
        $.ajax({
            url: "<?= base_url('ajax-fetch-article-on-group') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_gr': $am_gr},
            success: function(returnData){
                console.log(returnData);
                
                // $("#article_number").html("<option value=''>Select Article</option>");
                $.each(returnData, function (index, itemData) {
                    $str2 = '<option value="'+itemData.am_id +'">'+ itemData.art_no +'</option>';
                    $("#article_number").append($str2);
                });
                
                $('#article_number').select2('open');

            },
        });
    });

    $("#consumption_btn").click(function(e){
        e.preventDefault();
        var cos = $("#customer_order").val();
        console.log(cos);
        // var array = cos.split(',');
        $.each(cos , function(index, val) { 
            $url = "<?=base_url('admin/print-customer-order-consumption')?>/"+val;
            console.log($url);
            var win = window.open($url, '_blank');
        });
    });

    $("#buyer_wise_cust_ord_status").click(function(){
        if($("#buyer_wise_from_date").val() === '' || $("#buyer_wise_to_date").val() === ''){
            return false;
        }
    })
    
</script>

</body>
</html>