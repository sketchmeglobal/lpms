<?php 


if(count($page_setup) > 0) {
    $front_page = $page_setup[0]->front_page;
    $other_page = $page_setup[0]->other_page;
    $blank_row = $page_setup[0]->blank_row;
} else {
    $front_page = 4;
    $other_page = 6;
    $blank_row = 6;    
}


?>
<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 21-02-2020
 * Time: 11:30 am
 * Last updated on 25-Feb-2021 at 11:30 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cutting Receive Bill Print<?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Cutting Receive Bill Print</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Cutting Receive Bill Print </li>
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
                            <form class="row" method="post" target="_blank">
                <div class="col-sm-6">
                    <label>Select From The List </label><br />
                    <select id="cut_rcpt_challan" name="cut_rcpt_challan[]" class="form-control select2" multiple="multiple" required >
                        <option value="">Select From The List</option>
                        <?php
                        foreach ($fetch_all_challan as $f_a_c) {
                            ?>
                            <option value="<?= $f_a_c->cut_rcv_id ?>"><?= $f_a_c->cut_rcv_number ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6">
            <label>First page rows: <input required type="number" min="1" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label><br/>
            <label>Other page rows: <input required type="number" min="5" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label><br/>
            <label>Blank rows: <input required type="number" min="0" name="blank_row" class="form-control" value="<?=$blank_row?>"/></label>
            <input type="hidden" name="module_id" value="2"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
                </div>
                <div class="col-sm-12">
                <div class="row">
                    <input type="submit" name="cutting_receive_print" value="Print(W/O RATE)" class="btn btn-sm btn-success col-sm-2" />
                    <div class="col-sm-1"></div>
                    <input type="submit" name="cutting_receive_print_with_cost_and_rate" value="Print(W RATE(A))" class="btn btn-sm btn-success col-sm-2" />
                    <div class="col-sm-1"></div>
                    <input type="submit" name="cutting_receive_print_with_cost_and_rate_b" value="Print(W RATE(B))" class="btn btn-sm btn-success col-sm-2" />
                </div>
                </div>
            </form>
                <br>
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
    $('#cut_rcpt_challan').select2();   
</script>

</body>
</html>