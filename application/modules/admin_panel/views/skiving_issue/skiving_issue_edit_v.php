<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last updated on 08-01-2021 at 12:15pm
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Skiving Issue | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Purchase Order">

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
            <h3 class="m-b-less">Edit Skiving Issue</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Skiving Issue </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?= $cutting_receive_details[0]->cut_rcv_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            <form id="form_edit_skiving_issue" method="post" action="<?=base_url('admin/form-edit-skiving-issue')?>" class="cmxform form-horizontal tasi-form">
                            
                            <div class="form-group ">
                                <div class="col-lg-3">
                                <label for="cut_rcv_id" class="control-label text-danger">Cutting Received Challan Number *</label>
                                <input id="cut_rcv_id" name="cut_rcv_id" type="text" placeholder="Cutting Number" class="form-control round-input" value="<?=$cutting_receive_details[0]->cut_rcv_number?>" readonly />
                                </div>
                                <div class="col-lg-3">
                                <label for="skiving_issue_number" class="control-label text-danger">Skiving Issue Number *</label>
                                <input id="skiving_issue_number" name="skiving_issue_number" type="text" placeholder="Skiving Issue Number" class="form-control round-input" value="<?=$cutting_receive_details[0]->skiving_issue_number?>" />
                                </div>
                                
                                <div class="col-lg-3">
                                    <label for="skiving_issue_date" class="control-label text-danger">Skiving Issue Date *</label>
                                    <input id="skiving_issue_date" name="skiving_issue_date" type="date" placeholder="Cutting Date" class="form-control round-input" value="<?=$cutting_receive_details[0]->skiving_issue_date?>" />
                                </div>
                             </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Skiving Issue</i></button>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <button id="print_all" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                    </div>-->
                                </div> 
                                <input type="hidden" id="cut_rcv_id_id" name="cut_rcv_id_id" class="hidden" value="<?= $cutting_receive_details[0]->cut_rcv_id ?>" />
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            
                            <table id="skiving_issue_table" class="table data-table dataTable">
                                <thead>
                                    <tr>
                                        <th>Customer Order Number</th>
                                        <th>Buyer Reference Number</th>
                                        <th>Cutting Challan Number</th>
                                        <th>Article Number</th>
                                        <th>Leather Color</th>
                                        <th>Fitting Color</th>
                                        <th>Skv.Isu Quantity</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
    
    $("#form_edit_skiving_issue").validate({
        rules: {
            skiving_issue_number: {
                required: true,
            },
            skiving_issue_date: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_edit_skiving_issue').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_skiving_issue").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			notification(obj);
            //console.log(returnData);
        }
    });
    $si = $("#cut_rcv_id_id").val();
    $('#skiving_issue_table').DataTable( {
        "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Skiving Issued PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Skiving Issued Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }    
               }
            ],
        "processing": true,
        "language": {
            processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
        },
        "serverSide": true,
        "ajax": {
            "url": "<?=base_url('admin/ajax-skiving-issue-table-data')?>/"+$si,
            "type": "POST",
            "dataType": "json",
        },
        //will get these values from JSON 'data' variable
        "columns": [
                { "data": "customer_order_no" },
                { "data": "buyer_reference_number" },
                { "data": "cutting_challan_number" },
				{ "data": "article_number" },
                { "data": "leather_color" },
                { "data": "fitting_color" },
				{ "data": "receive_quantity" },				
                // { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6],
                "orderable": false,
            }]
    } );


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
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "7000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }

// delete area 
  

</script>

</body>
</html>
