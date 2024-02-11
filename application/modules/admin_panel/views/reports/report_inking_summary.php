<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 21-02-2020
 * Time: 11:30 am
 * Last updated on 25-Feb-2022 at 11:30 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report - Inking | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Order Status">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="<?=base_url()?>assets/admin_panel/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.4/css/rowGroup.dataTables.min.css" />
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <style>
        label{font-weight: bold}
        input[type="submit"] {
            margin-top: 26px;
        }
        body{ font-family: 'Signika', sans-serif; font-family: Calibri;}
        p { margin: 0 0 5px; }
        .padding-5mm{padding: 5mm;}
        table{ border: 1px solid #777; }
        .table{ margin-bottom: 3px;}
        .head_font{ font-family: 'Signika', sans-serif;font-family: Calibri;}
        .container{width: 100%}
        .border_all{border: 1px solid #000;}
        .border_bottom{border-bottom: 1px solid #000;}
        .mar_0{margin: 0}
        .mar_bot_3{margin-bottom: 3px}

        .header_left, .header_right{height: 75px}

        .width-100{width: 100%}

        .height_60{ height: 60px }
        .height_42{ height: 42px }
        .height_135{height: 150px}
        .height_90{height: 90px}
        .height_100{height: 100px}
        .height_110{height: 110px}
        .height_41{ height: 41px }
        .height_23{ height: 23px }
        .height_63{ height: 63px }
        .height_21{ height: 21px }

        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

        .border-bottom{border-bottom:  1px solid #000}.text-center{text-align: center!important;}.text-right{text-align: right!important;}

        /*@page { size: A4 }*/

        @media print{
            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid black!important;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
            .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
            .text-center{text-align: center!important;}.text-right{text-align: right!important;}
            .print-text-center{text-align:center!important}
        }
        table.order-summary th {position: relative;}                    
        table.order-summary span{left: 0;background: #d4ecea;position: absolute;bottom: 0;width: 100%;text-align: right;border-top: 1px solid;color: #000;font-size: 10px;}

        .extra_td_space:after{content: ''; display:block;margin-bottom:25px}
        @media print{
            thead{margin-top: 15px;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {font-size: 14px!important;padding:0!important;}
            
            table.order-summary th {position: unset;}                   
            table.order-summary span{display:none;}
        }
        
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 5px;text-align: left;font-size: 14px;
        }
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
            <h3 class="m-b-less">Report - Inking</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Inking </li>
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
                            <form class="row" method="post" action="">
                                    <div class="col-lg-3">
                                    <label>  Select Employees  </label><br />
                                    <select multiple id="employees" name="employees" class="form-control select2" required >
                                        <option value="">Select From The List</option>
                                        <?php
                                        foreach ($fetch_all_employee as $fcbl) {
                                            ?>
                                            <option value="<?= $fcbl->e_id ?>"><?= $fcbl->name . ' [' . $fcbl->e_code . ']' ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="from_date">From Date</label>
                                    <input type="date" name="from_date" value="" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                <label for="to_date">To Date</label>
                                    <input type="date" name="to_date" value="" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <input type="submit" name="print" value="Inking Summary" class="btn btn-sm btn-success" />
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="panel">
                    <!-- <div class="panel-head">Filter Reports</div> -->
                    <div class="panel-body">

                        <div class="A4" id="page-content">
                            <section class="sheet padding-10mm" style="height: auto;">
                                <div class="container">
                                    <div class="row border_all text-center text-uppercase mar_bot_3">
                                        <h3 class="mar_0 head_font">Employee Inking Report Summary</h3>
                                    </div>
                                    <div class="row mar_bot_3">
                                        <div class="col-sm-6 border_all header_left">
                                            <h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                                        </div>
                                        <div class="col-sm-6 border_all header_right">Report Date: <?=date('d-m-Y')?></div>
                                    </div>

                                    <div class="table-responsive row">
                                <!--<h5>Retrieve Table</h5>-->
                                        <table id="all_det" class="table table-bordered order-summary" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Emp. Name</th>
                                                    <th>Date</th>
                                                    <th>Order</th>
                                                    <th>Article</th>
                                                    <th>Colour</th>
                                                    <th>Type</th>
                                                    <th>Qnty.</th>
                                                    <th>Category</th>
                                                    <th>Category Qnty.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $iter = 1;
                                                if(isset($inking_report) and count($inking_report) > 0){ 
                                                    foreach($inking_report as $ir){
                                                    ?>

                                                        <tr>
                                                            <td><?=$iter++?></td>
                                                            <td><?=$ir->name?></td>
                                                            <td><?=date('d-m-Y', strtotime($ir->inking_entry_date))?></td>
                                                            <td><?=$ir->co_no?></td>
                                                            <td><?=$ir->art_no?></td>
                                                            <td><?=$ir->color?></td>
                                                            <td><?=$ir->remarks_for_other_quantity?></td>
                                                            <td><?= ($ir->remarks_for_other_quantity == 'OTHERS') ? $ir->rejection_quantity : $ir->checked_quantity ?></td>
                                                            <td><?=$ir->inking_category?></td>
                                                            <td><?=$ir->category_quantity?></td>
                                                        </tr>

                                                    <?php
                                                    }    
                                                }  else{
                                                    echo '<tr><td colspan="10"><p class=text-center>Nothing selected</p></td></tr>';
                                                }
                                                ?>
                                                <?php ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </section>
                        </div>

                    </div>
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
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="<?=base_url()?>assets/admin_panel/js/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/jquery.quicksearch.js"></script>

<script>
    $(document).ready(function(){

        $('.select2').select2()

        $('#group').change(function(){
            $gr_id = ($(this).find(':selected').val());
    
            $.ajax({
                method: 'post',
                dataType: 'json',
                url: "<?= base_url('articles-on-article-group') ?>",
                data: {gr_id:$gr_id},
                success: function(items){
                    // console.log(items);
                    $('#leather_status').html('');
                    $.each(items, function(index, itemData){
                        $apnd_val = '<option value="'+ itemData.am_id +'">'+ itemData.art_no + '</option>';
                        $("#leather_status").append($apnd_val);
                    });
                    $('#leather_status').multiSelect('refresh');
                },
                error: function(e){
                    console.log(e);
                }
            });
        });
    });
</script>


</body>
</html>