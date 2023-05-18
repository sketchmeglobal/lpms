                    <?php
                    /**
                    * Coded by: Pran Krishna Das
                    * Social: www.fb.com/pran93
                    * CI: 3.0.6
                    * Date: 11-03-2020
                    * Time: 09:55
                    * Last uploaded on 01-01-2021 at 09:55pm
                    */
                    ?>
                    
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                    <title>Dashboard | <?=WEBSITE_NAME;?></title>
                    <meta name="description" content="edit Customer Order">
                    
                    <!--Data Table-->
                    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
                    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
                    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
                    
                    <!--Select2-->
                    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
                    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">
                    
                    <!--iCheck-->
                    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">
                    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
                    
                    <!-- common head -->
                    <?php $this->load->view('components/_common_head'); ?>
                    <!-- /common head -->
                    <style>
                    .p-1{padding: 1%;}
                    .pt-0{padding-top: 0}
                    .px-1{padding: 1rem 0;}
                    .mb-1{margin-bottom: 0.5rem;}
                    .mt-1{margin-top: 0.5rem;}
                    .mb-2{margin-bottom: 2rem;}
                    /*        .panel{min-height: 400px;}
                    */        .panel-footer {background-color: rgb(0 0 0 / 15%);bottom: 0;width: 100%;}
                    .text-white{color:#fff;}
                    .text-dark{color:#000;}
                    .border-bottom{border-bottom: 1px solid #787878;}
                    ul {
                    padding-right: 0;
                    padding-left: 18px;
                    }
                    /*.panel {
                    min-height: 360px;
                    }*/
                    footer {
                    position: relative;
                    }
                    
                    
                    body{
                    margin-top: 50px !important;
                    font-family: 'PT Sans Narrow', sans-serif;
                    }
                    a:hover, a:focus{
                    text-decoration: none !important;
                    outline: none !important;
                    
                    }
                    .panel-group .panel{
                    background-color: #fff;
                    border:none;
                    box-shadow:none;
                    border-radius: 10px;
                    margin-bottom:11px;
                    }
                    .panel .panel-heading{
                    padding: 0;
                    border-radius:10px;
                    border: none;
                    }
                    .panel-heading a{
                    color: white;
                    display: block;
                    border: none;
                    padding: 15px 34px 15px;
                    font-size: 20px;
                    background-color: #4bc17d;
                    font-weight: bold!important;
                    position: relative;
                    /* color: #fff; */
                    box-shadow: none;
                    transition: all 0.1s ease 0;
                    font-size: 17px!important;
                    }
                    .panel-heading a:after, .panel-heading a.collapsed:after{
                    content: "\f068";
                    font-family: fontawesome;
                    text-align: center;
                    position: absolute;
                    left: -20px;
                    top: 10px;
                    color: #e81313 !important;
                    background-color: #fff;
                    border: 5px solid #fff;
                    font-size: 15px;
                    width: 40px;
                    height: 40px;
                    line-height: 30px;
                    border-radius: 50%;
                    transition: all 0.3s ease 0s;
                    }
                    .panel-heading:hover a:after,
                    .panel-heading:hover a.collapsed:after{
                    transform:rotate(360deg);
                    }
                    .panel-heading a.collapsed:after{
                    content: "\f067";
                    }
                    #accordion .panel-body{
                    background-color:#fbf8f8;
                    line-height: 25px;
                    padding: 10px 25px 20px 35px ;
                    border-top:none;
                    font-size:14px;
                    position: relative;
                    }
                    .text-white{
                    color:white;
                    text-transform: uppercase;
                    }
                    
                    .loader {
                    display: inline-block;
                    width: 30px;
                    height: 30px;
                    position: relative;
                    border: 4px solid #Fff;
                    top: 50%;
                    animation: loader 2s infinite ease;
                    }
                    
                    .loader-inner {
                    vertical-align: top;
                    display: inline-block;
                    width: 100%;
                    background-color: #fff;
                    animation: loader-inner 2s infinite ease-in;
                    }
                    
                    @keyframes loader {
                    0% {
                    transform: rotate(0deg);
                    }
                    
                    25% {
                    transform: rotate(180deg);
                    }
                    
                    50% {
                    transform: rotate(180deg);
                    }
                    
                    75% {
                    transform: rotate(360deg);
                    }
                    
                    100% {
                    transform: rotate(360deg);
                    }
                    }
                    
                    @keyframes loader-inner {
                    0% {
                    height: 0%;
                    }
                    
                    25% {
                    height: 0%;
                    }
                    
                    50% {
                    height: 100%;
                    }
                    
                    75% {
                    height: 100%;
                    }
                    
                    100% {
                    height: 0%;
                    }
                    }
                    
                    .dt-buttons{width: 100%;}
                    .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
                    .buttons-pdf{background: #5cc691; color: #fff}
                    .buttons-excel{background: #9c78cd; color: #fff}
                    .page-head {
                    padding: 20px;
                    background: #e8e8e8;
                    position: relative;
                    top: -50px;
                    }
                    
                    .bg-success, .info-number .bg-success {
                    background-color: #96ceb8;
                    color: black!important;
                    }
                    
                    table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    padding-right: 0;
    0px */: ;
}

table.dataTable thead .sorting_asc:after {
    content: '';
}

#co_brk_up_list_table  td:nth-child(2), #co_brk_up_list_table  td:nth-child(3) {
  white-space: nowrap;
}

                    
                    h4 {
                    font-size: 16px!important;
                    }
                    .page-head {
                    padding: 20px;
                    background: #e8e8e8;
                    position: relative;
                    top: -48px;
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
                    
                    <!--          header section start
                    -->        <?php $this->load->view('components/top_menu'); ?>
                    <!--          header section end
                    -->
                    <!--          page head start
                    -->        <div class="page-head">
                    <h3>Dashboard</h3>
                    <span class="sub-title">Welcome to <?=WEBSITE_NAME;?> dashboard</span>
                    </div>
                    <!--          page head end
                    -->
                    <!--         body wrapper start
                    -->        <div class="wrapper">
                    
                    
                    
                    </div>
                    
                    
                    
                    <div class="container">
                    <div class="row">
                    <div class="col-md-11">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                    
                    <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Google Chart
                    <span> </span>
                    </a>
                    </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                    <div class="row">
                    <div class="col-md-9">
                    <h3 class="panel-title">Month Wise Order And Invoice Details</h3>
                    </div>
                    <div class="col-md-3">
                    <select name="year" id="year" class="form-control">
                    <option value="">Select Year</option>
                    <option value="2020">2020</option>
                    <option value="2021" selected>2021</option>
                    </select>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12" style="overflow-x: scroll;">
                    <table class="columns" style="width: 100%;">
                    <tr>
                    <td style="width: 50%;"><div id="chart_area" style="border: 1px solid #ccc;width: 100%; height: 300px;"></div></td>
                    <td style="width: 50%;"><div id="chart_area2" style="border: 1px solid #ccc;width: 100%; height: 300px;"></div></td>
                    </tr>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Details
                    <span> </span>
                    </a>
                    </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                    <div class="row">
                    <?php if($lastest_costings != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php // print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Costing</h4>
                    </div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_costings as $lc){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($lc->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit_article_costing/<?= $lc->ac_id ?>" class=""><?= $lc->art_no ?></a> (<?= $datetime ?>)
                    <?php if($lc->show_name == 1) { ?>
                    by <?= $lc->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/article_costing') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php 
                    if($lastest_orders != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php // print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Customer Order</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_orders as $lo){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($lo->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    
                    // Sayak here for datetime change
                    
                    
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-customer-order/<?= $lo->co_id ?>" class=""><?= $lo->co_no ?></a> (<?= date("d/m/y, H:i:s", strtotime($lo->modify_date)) ?>)
                    <?php if($lo->show_name == 1) { ?>
                    by <?= $lo->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/customer-order') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($lastest_cutting_issues!= '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Cutting Issue</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_cutting_issues as $lci){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($lci->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-cutting-issue-challan/<?= $lci->cut_id ?>" class=""><?= $lci->co_no ?></a> (<?= $datetime ?>)
                    <?php if($lci->show_name == 1) { ?>
                    by <?= $lci->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/cutting-issue-challan') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($lastest_cutting_receive != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Cutting Receive</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_cutting_receive as $lcr){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($lcr->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-cutting-receive/<?= $lcr->cut_rcv_id ?>" class=""><?= $lcr->co_no ?></a> (<?= $datetime ?>)
                    <?php if($lcr->show_name == 1) { ?>
                    by <?= $lcr->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/cutting-receive') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
                    <div class="row">
                    <?php if($lastest_skiving_receive != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Skiving Receive</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_skiving_receive as $lsr){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($lsr->modified_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/skiving-receive-edit/<?= $lsr->skiving_receive_id ?>" class=""><?= $lsr->skiving_receive_challan_number ?></a> (<?= $datetime ?>)
                    <?php if($lsr->show_name == 1) { ?>
                    by <?= $lsr->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/skiving-receive') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($lastest_jobber_issues != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Jobber Issue</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_jobber_issues as $ljr){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ljr->modified_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/jobber-challan-issue-edit/<?= $ljr->jobber_issue_id ?>" class=""><?= $ljr->jobber_challan_number ?></a> (<?= date('d/m/Y H:i:s', strtotime($datetime)) ?>)
                    <?php if($ljr->show_name == 1) { ?>
                    by <?= $ljr->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/jobber-challan-issue') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($lastest_jobber_issues != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Jobber Receive</h4></div>
                    <div class="panel-body p-0" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_jobber_receive as $ljrc){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ljrc->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/jobber-challan-receipt-edit/<?= $ljrc->jobber_challan_receipt_id ?>" class=""><?= $ljrc->jobber_receipt_challan_number ?></a> (<?= $datetime ?>)
                    <?php if($ljrc->show_name == 1) { ?>
                    by <?= $ljrc->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/jobber-challan-receipt') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($lastest_shipment != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Packing List/Shipment List</h4></div>
                    <div class="panel-body" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($lastest_shipment as $ls){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ls->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-packing-shipment/<?= $ls->packing_shipment_id ?>" class=""><?= $ls->package_name ?></a> (<?= $datetime ?>)
                    <?php if($ls->show_name == 1) { ?>
                    by <?= $ls->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/packing-shipment-list') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
                    
                    <div class="row">
                    <?php if($latest_purchase_order != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Purchase Order List</h4></div>
                    <div class="panel-body" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($latest_purchase_order as $ls){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ls->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-purchase-order/<?= $ls->po_id ?>" class=""><?= $ls->po_number ?></a> (<?= date('d/m/Y H:i:s', strtotime($datetime)) ?>)
                    <?php if($ls->show_name == 1) { ?>
                    by <?= $ls->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/purchase-order') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($latest_purchase_order_receive != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Purchase Receive/Bill</h4></div>
                    <div class="panel-body" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($latest_purchase_order_receive as $ls){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ls->modified_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/edit-receive-purchase-order/<?= $ls->purchase_order_receive_id ?>" class=""><?= $ls->purchase_order_receive_bill_no ?></a> (<?= date('d/m/Y H:i:s', strtotime($datetime)) ?>)
                    <?php if($ls->show_name == 1) { ?>
                    by <?= $ls->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/receive-purchase-order') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($latest_material_issue_list != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Material Issue List</h4></div>
                    <div class="panel-body" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($latest_material_issue_list as $ls){
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ls->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/material-issue-edit/<?= $ls->material_issue_id ?>" class=""><?= $ls->material_issue_slip_number ?></a> (<?= $datetime ?>)
                    <?php if($ls->show_name == 1) { ?>
                    by <?= $ls->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/material-issue-list') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($latest_jobber_bill_list != '') { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="panel">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Jobber Bill List</h4></div>
                    <div class="panel-body" style="padding: 0; font-size: 13px;">
                    <p class="text-muted border-bottom px-1">Last 5 transactions</p>
                    <ul>
                    <?php
                    foreach($latest_jobber_bill_list as $ls){
                    $datetime = date('d/m/Y G:i:s', strtotime($ls->modify_date));
                    
                    // Convert datetime to Unix timestamp
                    $timestamp = strtotime($ls->modify_date);
                    
                    // Subtract time from datetime
                    $time = $timestamp + (11.5 * 30 * 60);
                    
                    // Date and time after subtraction
                    $datetime = date("d-m-Y H:i:s", $time);
                    ?>
                    <li class="mb-1"><a href="<?=base_url();?>admin/jobber-bill/<?= $ls->jobber_bill_id ?>" class=""><?= $ls->jobber_bill_number ?></a> (<?= date('d/m/Y H:i:s', strtotime($datetime)) ?>)
                    <?php if($ls->show_name == 1) { ?>
                    by <?= $ls->username ?>
                    <?php } ?>
                    </li>
                    <?php
                    }
                    ?>
                    
                    </ul>
                    </div>
                    <div class="panel-footer text-center">
                    <a href="<?= base_url('admin/jobber-bill') ?>" class="text-dark">Segment List</a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                    
                    </div>
                    
                    </div>
                    </div>
                    </div>
                    
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                    <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    
                    Report
                    
                    <span> </span>
                    </a>
                    </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body" style="overflow-y: scroll; height: 800px; padding: 10px 0px 0px 0px;">
                    <div class="col-md-12 col-lg-12">
                    <div class="panel" style="min-height: 200px;">
                    <?php //print_r($lastest_costings) ?>
                    <div class="panel-header bg-success text-white text-center p-1"><h4>Order Brkup Details</h4></div>
                    <div class="panel-body" style="padding-left: 0; padding-right: 0;">
                    <br/>
                    <div class="row">
                    <label class="control-label col-lg-4 text-danger" style="text-align: right;">Select Buyer Name*</label>
                    <div class="col-lg-4">
                    <select id="buyer_name" name="buyer_name" class="form-control select2">
                    <option value="">Select Buyer Name</option>
                    <?php foreach ($buyers as $buyer) {
                    ?>
                    <option value="<?= $buyer->am_id ?>"><?= $buyer->name . '['. $buyer->short_name .']' ?></option>
                    <?php
                    } ?>
                    </select>
                    </div>
                    <div class="col-lg-4 mt-1">
                    <button name="submit" value="brkup_details" class="btn btn-success brkup_details" type="submit"><i class="fa fa-search"> Show Details </i></button>
                    </div>
                    
                    <div class="col-sm-12 table-responsive">
                    <table id="co_brk_up_list_table" class="table data-table dataTable" style="font-size: 11px;">
                    <thead>
                    <tr>
                    <th rowspan="2"> Ord. <br/> No. </th>
                    <th colspan="3" class="text-center">Date Details</th>
                    <th class="no-sort" rowspan="2"> Ord <br/> Qnty </th>
                    <th colspan="3" class="text-center">Cutting Information</th>
                    <th colspan="3" class="text-center">Fabricator Information</th>
                    <th colspan="2" class="text-center">Checking Information</th>
                    <th colspan="3" class="text-center">Shipping Information</th>
                    </tr>
                    <tr>
                    <th>Order Date</th>
                    <th style="width: 4%;">Buyer's Delv. <br/> Dt.</th>
                    <th class="no-sort" style="width: 4%;" >  Ship  <br/>  Dt. 2  </th>
                    <th class="no-sort">Cut <br/> Is.</th>
                    <th class="no-sort">Cut <br/> Rcv.</th>
                    <th class="no-sort">Cut <br/> Bal.</th>
                    <th class="no-sort">Fab <br/> Is.</th>
                    <th class="no-sort">Fab <br/> Rcv.</th>
                    <th class="no-sort">Fab <br/> Bal.</th>
                    <th class="no-sort"> Chked </th>
                    <th class="no-sort"> Pndng </th>
                    <th class="no-sort">Qnt. <br/> Shpd</th>
                    <th class="no-sort">Qnt. <br/> Rem</th>
                    <th class="no-sort">Qnt. <br/> Stock <br>(in- <br/> hand)</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                    </div>
                    
                    </div>
                    
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                    <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                    
                    User Log
                    
                    <span> </span>
                    </a>
                    </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class ="panel-body" style="overflow-x: scroll;">
                    <table id="cutting_issue_challan_table" class="table data-table dataTable table-bordered" style="width: 60%;">
                    <thead>
                    <tr>
                    <th>Table Name</th>
                    <th>Action Taken</th>
                    <th>Old Data</th>
                    <th>Comment</th>
                    <th>Usename</th>
                    <th>Create Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    
                    
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
                    
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    
                    <!--<script>-->
                    <!--$('.select2').select2();-->
                    <!--</script>-->
                    <!--Icheck-->
                    <script src="<?=base_url();?>assets/admin_panel/js/icheck/skins/icheck.min.js"></script>
                    <script src="<?=base_url();?>assets/admin_panel/js/icheck-init.js"></script>
                    <!--form validation-->
                    <script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js"></script>
                    <!--ajax form submit-->
                    <script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    
                    <script>
                    
                    $(document).on('click', '.brkup_details', function() {
                    $('#co_brk_up_list_table').DataTable().destroy();
                    $buyer_id = $('#buyer_name').val();
                    $('#co_brk_up_list_table').DataTable( {
                    "lengthMenu": [
                    [ 10, 25, 50, 1000 ],
                    [ '10', '25', '50', 'All' ]
                    ],
                    "dom": 'Blfrtip',
                    "buttons": [],
                    "processing": true,
                    "language": {
                    processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
                    },
                    "serverSide": true,
                    "searching": false, 
                    "paging": false, 
                    "info": false,
                    "ajax": {
                    "url": "<?=base_url('admin/report-order-status-details-brkup-dashboard')?>",
                    "type": "POST",
                    "dataType": "json",
                    data: {
                    buyer_id: function () {
                    return $buyer_id;
                    },
                    },
                    },
                    //will get these values from JSON 'data' variable
                    "columns": [
                    { "data": "buyer_reference_no" },
                    { "data": "co_date" },
                    { "data": "co_delivery_date" },
                    { "data": "shipment_date2" },
                    { "data": "co_quantity" },
                    { "data": "cutting_issued_qnty" },
                    { "data": "cutting_received_qnty" },
                    { "data": "blnc_qntyy" },
                    { "data": "jobber_issue_qnty" },
                    { "data": "jobber_receive_qnty" },
                    { "data": "fab_qntyy" },
                    { "data": "checked_quantity" },
                    { "data": "chek_blnc" },
                    { "data": "qtty" },
                    { "data": "qnty_remn" },
                    { "data": "qnty_stck" },
                    ],
                    //column initialisation properties
                    "ordering": true,
                    columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                    }]
                    });
                    });
                    
                    </script>
                    
                    <script type="text/javascript">
                    
                    google.charts.load('current', {packages:['corechart', 'bar']});
                    google.charts.setOnLoadCallback((year, 'Month Wise Order And Invoice Details' ));
                    
                    function load_monthwise_data(year, title)
                    {
                    var temp_title = title + ' ' + year;
                    $.ajax({
                    url:"<?php echo base_url(); ?>admin/google-chart-yearwise-data",
                    method:"POST",
                    data:{year:year},
                    dataType:"JSON",
                    success:function(data)
                    {
                    drawMonthwiseChart(data, temp_title);
                    }
                    })
                    }
                    
                    function load_monthwise_data1(year, title, row, column)
                    {
                    var temp_title = title + ' ' + year;
                    $.ajax({
                    url:"<?php echo base_url(); ?>admin/google-chart-monthwise-data",
                    method:"POST",
                    data:{year:year, row:row, column:column},
                    dataType:"JSON",
                    success:function(data)
                    {
                    drawMonthwiseChart1(data, temp_title);
                    }
                    })
                    }
                    
                    function drawMonthwiseChart(chart_data, chart_main_title)
                    {
                    var jsonData = chart_data;
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Month');
                    data.addColumn('number', 'Order');
                    data.addColumn('number', 'Invoice');
                    
                    $.each(jsonData, function(i, jsonData){
                    var month = jsonData.name;
                    var quantity = parseFloat($.trim(jsonData.quantity));
                    var invoice_quantity = parseFloat($.trim(jsonData.invoice_quantity));
                    data.addRows([[month, quantity, invoice_quantity]]);
                    });
                    
                    var options = {
                    title:chart_main_title,
                    hAxis: {
                    title: "Months",
                    textStyle : {
                    fontSize: 10,// or the number you want
                    fontName: 'Times-Roman',
                    italic: true,
                    slantedText: true,
                    }
                    },
                    vAxis: {
                    title: 'Quantity',
                    textStyle : {
                    fontSize: 10, // or the number you want
                    fontName: 'Times-Roman',
                    italic: true,
                    }
                    },
                    bar: {groupWidth: "40%"},
                    chartArea:{width:'80%',height:'60%'},
                    legend: {
                    position: 'top'
                    },
                    width: '100%'
                    }
                    
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
                    
                    chart.draw(data, options);
                    
                    google.visualization.events.addListener(chart, 'select', selectHandler);
                    
                    function selectHandler() {
                    var selection = chart.getSelection();
                    var message = '';
                    for (var i = 0; i < selection.length; i++) {
                    var item = selection[i];
                    if (item.row != null && item.column != null) {
                    var str = data.getFormattedValue(item.row, item.column);
                    
                    var year = $('#year').val();
                    if(year != '')
                    {
                    load_monthwise_data1(year, 'Month wise order and invoice quantity', item.row, item.column);
                    }
                    } 
                    }
                    }
                    
                    }
                    
                    function drawMonthwiseChart1(chart_data, chart_main_title)
                    {
                    var jsonData = chart_data;
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Month');
                    data.addColumn('number', 'Order');
                    data.addColumn('number', 'Invoice');
                    
                    $.each(jsonData, function(i, jsonData){
                    var name = jsonData.name;
                    var quantity = parseFloat($.trim(jsonData.quantity));
                    var invoice_quantity = parseFloat($.trim(jsonData.invoice_quantity));
                    var month_name = jsonData.month_name;
                    data.addRows([[name, quantity, invoice_quantity]]);
                    });
                    
                    var options = {
                    title:chart_main_title,
                    hAxis: {
                    title: "Buyer Name",
                    textStyle : {
                    fontSize: 10,// or the number you want
                    fontName: 'Times-Roman',
                    italic: true,
                    slantedText: true,
                    }
                    },
                    vAxis: {
                    title: 'Quantity',
                    textStyle : {
                    fontSize: 10, // or the number you want
                    fontName: 'Times-Roman',
                    italic: true,
                    }
                    },
                    
                    bar: {groupWidth: "20%"},
                    
                    chartArea:{width:'80%',height:'60%'},
                    legend: {
                    position: 'top'
                    },
                    width: '100%'
                    }
                    
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area2'));
                    
                    chart.draw(data, options);
                    
                    }
                    
                    </script>
                    
                    <script>
                    
                    $(document).ready(function(){
                    $('#year').change(function(){
                    var year = $(this).val();
                    if(year != '')
                    {
                    load_monthwise_data(year, 'Month Wise Order And Invoice Details' );
                    }
                    });
                    });
                    
                    $(document).ready(function(){
                    var year = $('#year').val();
                    load_monthwise_data(year, 'Month Wise Order And Invoice Details' );
                    });
                    
                    // window.addEventListener('click', function(e){   
                    //   if (document.getElementById('chart_area2').contains(e.target)){
                    //     // Clicked in box
                    //   } else{
                    //     $("#chart_area2").html('');
                    //   }
                    // });
                    
                    // $('.graph_view').click(function(e){
                    //   $('#chart_area2').fadeOut(300);
                    // })
                    
                    </script>
                    
                    <!--<script>-->
                    <!--$('.select2').select2();-->
                    <!--</script>-->
                    
                    
                    <script>
                    $(document).ready(function(){
                    $(function () {
                    $(".date").datepicker({dateFormat: 'dd-mm-yy'});
                    });
                    $('#leather_status').multiSelect({
                    selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search item'>",
                    selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search item'>",
                    afterInit: function(ms){
                    var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                    
                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                    if (e.which === 40){
                    that.$selectableUl.focus();
                    return false;
                    }
                    });
                    
                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                    if (e.which == 40){
                    that.$selectionUl.focus();
                    return false;
                    }
                    });
                    },
                    afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                    },
                    afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                    }
                    });  
                    });
                    $('#select-all').click(function(){
                    $('#leather_status').multiSelect('select_all');
                    return false;
                    });
                    $('#deselect-all').click(function(){
                    $('#leather_status').multiSelect('deselect_all');
                    return false;
                    });
                    </script>
                    
                    <script>
                    $(document).ready(function() {
                    $('#cutting_issue_challan_table').DataTable({
                    "lengthMenu": [
                    [ 10, 25, 50, 1000 ],
                    [ '10', '25', '50', 'All' ]
                    ],
                    "dom": 'Blfrtip',
                    "buttons": [
                    {
                    extend: 'pdf',
                    footer: true,
                    title: 'User Log PDF',
                    exportOptions: {
                    columns: [0,1,2,3,4,5]
                    }
                    },
                    {
                    extend: 'excel',
                    footer: true,
                    title: 'User Log PDF',
                    exportOptions: {
                    columns: [0,1,2,3,4,5]
                    }    
                    }
                    ],
                    "processing": true,
                    "language": {
                    processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
                    },
                    "serverSide": true,
                    "ajax": {
                    "url": "<?=base_url('admin/ajax-user-logs-details')?>",
                    "type": "POST",
                    "dataType": "json",
                    },
                    //will get these values from JSON 'data' variable
                    "columns": [
                    { "data": "table_name" },
                    { "data": "action_taken" },
                    { "data": "old_data" },
                    { "data": "comment" },
                    { "data": "username" },
                    { "data": "create_date" },
                    ],
                    //column initialisation properties
                    "columnDefs": [{
                    "targets": [2,3,5], //disable 'Image','Actions' column sorting
                    "orderable": false,
                    }]
                    } );
                    } );
                    
                    $(document).on('click', '.print_all',function(){
                    $poi = $(this).attr('po-id');
                    $.confirm({
                    title: 'Choose!',
                    content: 'Choose printing methods from the below options',
                    buttons: {
                    printwithcode: {
                    text: 'With code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                    window.open("<?= base_url() ?>admin/purchase-order-print-with-code/"+ $poi, "_blank");
                    }
                    },
                    printwithoutcode: {
                    text: 'Without code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                    window.open("<?= base_url() ?>admin/purchase-order-print-without-code/"+ $poi, "_blank");
                    }
                    },
                    cancel: function () {}
                    }
                    });
                    });
                    
                    // delete area 
                    $(document).on('click', '.delete', function(){
                    if(confirm('Are you sure?')){
                    $tab = $(this).attr('tab');         
                    $pk_name = $(this).attr('pk-name');
                    $pk_value = $(this).attr('pk-value');
                    
                    $ref_table = $(this).attr('ref-table');
                    $ref_pk_name = $(this).attr('ref-pk-name');
                    
                    $.ajax({
                    url: "<?= base_url('admin/delete-office-proforma-header-list') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data:{tab: $tab, pk_name: $pk_name, pk_value: $pk_value, ref_table: $ref_table, ref_pk_name: $ref_pk_name},
                    success: function(returnData){
                    console.log(JSON.stringify(returnData));
                    notification(returnData);
                    $('#cutting_issue_challan_table').DataTable().ajax.reload();
                    },
                    error: function(e,v){
                    console.log(e + v);
                    }
                    });
                    }
                    })
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