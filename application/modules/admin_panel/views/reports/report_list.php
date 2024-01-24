
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report List || <?=WEBSITE_NAME;?></title>
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
    .link { border: 1px solid #cac8c8; padding: 1rem; background: #5ebacf;margin-right: 10px;}
    .link a{color: #000;font-size: 16px;} 
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
            <h3 class="m-b-less">Report List for - <?= strtoupper($segment) ?></h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> All reports </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="panel">
                    <?php if($segment == 'master'){ ?>
                    <div class="panel-heading">
                        Master Related Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-item"><i class="fa fa-caret-right"></i> Item Information                             </a>
                        </div>

                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-article-costing-details"><i class="fa fa-caret-right"></i>  Article Costing  </a>
                        </div>

                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/article-master-report"><i class="fa fa-caret-right"></i> Article Rate Report</a>
                        </div>
                    </div>
                    <?php } else if($segment == 'order'){ ?>
                    <div class="panel-heading">
                        Customer Order Related Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-order-status"><i class="fa fa-caret-right"></i> Order Status </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/purchase-order-audit-report"><i class="fa fa-caret-right"></i> Item Purchase Details </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/monthly-production-status"><i class="fa fa-caret-right"></i>Buyer Wise Shipment Report </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-buyer-wise-article"><i class="fa fa-caret-right"></i> Buyer Wise Article </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/outstanding-report"><i class="fa fa-caret-right"></i>Outstanding Report </a>
                        </div>
                    </div>
                    <?php } else if($segment == 'production'){ ?>
                    <div class="panel-heading">
                        Production Related Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-shipment-buyerwise-status"><i class="fa fa-caret-right"></i>  Shipment Report  </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-shipment-status"><i class="fa fa-caret-right"></i> Shipment Status Details </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/jobber-ledger"><i class="fa fa-caret-right"></i> Jobber Ledger </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/checking-summary-status"><i class="fa fa-caret-right"></i> Checking Summary </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/jobber-bill-summary"><i class="fa fa-caret-right"></i>Jobber Bill Summary </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/cutter-bill-summary"><i class="fa fa-caret-right"></i>Cutter Bill Summary </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/production-register"><i class="fa fa-caret-right"></i>Production Register </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/checking-overtime-reports"><i class="fa fa-caret-right"></i>Checking Details Reports </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/checking-entry-sheet"><i class="fa fa-caret-right"></i> Checking Entry Sheet </a>
                        </div>
                    </div>
                    <?php } else if($segment == 'stock'){ ?>
                    <div class="panel-heading">
                        Stock/Inventory Related Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/purchase-order-audit-report"><i class="fa fa-caret-right"></i> Item Purchase Details </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-material-status-details"><i class="fa fa-caret-right"></i> Material Issue Status </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-leather-status"><i class="fa fa-caret-right"></i> Leather Status </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/report-item-status"><i class="fa fa-caret-right"></i> Item Status </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/stock-summary-details"><i class="fa fa-caret-right"></i> Stock Summary </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/stock-detail-ledger"><i class="fa fa-caret-right"></i> Stock Detail Ledger </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/supplier-wise-item-position"><i class="fa fa-caret-right"></i> Supplier Wise Item Position </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/supplier-purchase-ledger"><i class="fa fa-caret-right"></i> Supplier Purchase Ledger </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/supplier-wise-purchase-position"><i class="fa fa-caret-right"></i>Supplier Wise Purchase Position </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/group-stock-summary"><i class="fa fa-caret-right"></i>Group Stock Summary </a>
                        </div>
                    </div>
                    <?php } else if($segment == 'payroll'){ ?>
                    <div class="panel-heading">
                        Accounts / Payroll Related Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/payroll-reports"><i class="fa fa-caret-right"></i>Payroll Reports </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/invoice-hsn-summary"><i class="fa fa-caret-right"></i>HSN Summary (Invoice) </a>
                        </div>
                        <div class="col-sm-3 col-xs-6 link">
                            <a target="_new" href="<?=base_url();?>admin/invoice-sales-reconcilation"><i class="fa fa-caret-right"></i>Sales Reconcilation</a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="panel-heading">
                        Reports
                        <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <p class="text-danger">Something went wrong</p> 
                    </div>
                    <?php } ?>
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

</body>
</html>