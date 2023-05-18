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
 
 <?php 
 if(count($page_setup) > 0) {
$front_page = $page_setup[0]->front_page;
$other_page = $page_setup[0]->other_page;
$blank_row = $page_setup[0]->blank_row;
} else {
$front_page = 8;
$other_page = 12;
$blank_row = 6;    
}
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checking Entry Sheet | <?=WEBSITE_NAME;?></title>
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
<style>
    .jobber_type {
    border: 1px solid #cac8c8;
    padding: 6px;
    }
    input[type="submit"] {
        margin-top: 26px;
    }
    .hidden {
        display: none;
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
            <h3 class="m-b-less">Report - Checking Entry Sheet</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Checking Entry Sheet Report </li>
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
                            <div class="row">
                <form method="post" class="col-sm-12" id="all_submit" target="_blank">
        <div style="width: 200px;background:#f5f5f5;padding:10px;right:0;position: absolute;
    top: 100px;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <h6><b><u>Print Page Setup</u></b></h6>
            <label>First page rows: <input required type="number" min="5" max="25" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" max="25" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <input type="hidden" name="module_id" value="19"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
        </div>

                    <input type="hidden" name="form" value="by_all" />
                    <div class="col-sm-4">
                        <label>Select Order Number</label><br />
                        <select id="cut_rcpt_challan" class="form-control select2 order_class" name="co[]" multiple="multiple" required>
                            <?php
                            foreach ($order_details as $co_id) {
                                ?>
                                <option value="<?= $co_id->co_id ?>"><?= $co_id->co_no ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Date - From</label><br />
                        <?php 
$month = date('m');
$day = '01';
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

    $newdate = date("Y-m-d", strtotime ( '-1 month' , strtotime ( $today ) )) ;
    ?>
                        <input name="from" type="date" value="<?php echo $newdate; ?>" class="form-control" id="myDate1" required>
                    </div>
                    <div class="col-sm-3">
                        <label>Date - To</label><br />
                        <input name="to" type="date" value="<?php echo $today; ?>" class="form-control" id="myDate2" required>
                    </div>
                    
                    <div class="col-sm-2">                    
                        <input type="submit" name="check_entry_sheet" value="Print" id="check_entry_sheet" class="btn btn-sm btn-success" style="" />
                    </div>
                    
                </form>    
            </div>
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
    $("#check_entry_sheet").click(function(e){
        var start = $('#myDate1').val();
var end = $('#myDate2').val();

 var date1 = new Date(start);
var date2 = new Date(end);
  
// To calculate the time difference of two dates
var Difference_In_Time = date2.getTime() - date1.getTime();
  
// To calculate the no. of days between two dates
var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
   if(Difference_In_Days > 31) {
    alert('Date duration should be between 31 days');
        e.preventDefault();
    }
    });
</script>

<script>
    $('#cut_rcpt_challan').select2();   
</script>

</body>
</html>