<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:15
 * Last updated on 21-01-2021 at 10:00 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Order List | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    
    
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">
    

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    
    <style>
        
        tr td:last-child {
    
            white-space: nowrap;
    
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
            <h3 class="m-b-less">Customer Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Customer Order </li>
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
                            <?php 
                                if($view_permission != 'block'){
                                    ?>
                            <a href="<?= base_url('admin/add-customer-order') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Customer Order</a>
                                <?php
                            } 
                            ?>

                            <table id="customer_order_table" class="table data-table dataTable">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th> Buyer Reference</th>
                                        <th>Customer Name</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th> Shipment Date </th>
                                        <th> Total Quantity </th>
                                        <th> Total Amount </th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="col-lg-12">
                    <p><b><u>Print Group Wise Consumption</u></b></p>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                    <form id="form_customer_order" method="post" action="<?= base_url('admin/order-consumption-group-by') ?>" class="cmxform form-horizontal tasi-form" novalidate="novalidate" target="_blank">
                                <div class="col-lg-1"></div>
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <label class="text-danger">Select Customer Order*</label><br />
                                        <select id="customer_order" name="customer_order[]" class="select2 form-control" required multiple>
                                            <option value="">Select Customer Order</option>
                                            <?php foreach ($co_ids as $co_id) {
                                                ?>
                                                <option value="<?= $co_id->co_id ?>"><?= $co_id->co_no ?></option>
                                                <?php
                                            } ?>
                                         </select>
                                    </div>
                                    <div class="col-sm-3">
                    <label class="text-danger">Select Group </label><br />
                    <select id="group" name="group" class="form-control" required >
                        <option value="">Select From The List</option>
                        <?php
                        foreach ($fetch_all_group as $fcbl) {
                            ?>
                            <option value="<?= $fcbl->ig_id ?>"><?= $fcbl->group_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <br/>
                    <button name="submit" value="consumption_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Consumption Details</i></button>
                </div>
                                </div>
                            </form>
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


<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>
<script>
    $('.select2').select2();
</script>


<script>
    $(document).ready(function() {
        $('#customer_order_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_customer_order_table_data')?>",
                "type": "POST",
                "dataType": "json",
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "co_no" },
                { "data": "buyer_reference_no" },
                { "data": "customer_name" },
                { "data": "co_date" },
                { "data": "co_delivery_date" },
                { "data": "shipment_date" },
                { "data": "co_total_quantity" },
                { "data": "co_total_amount" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3,4,5,6,8], //disable 'Image','Actions' column sorting
                "orderable": false,
            }]
        } );
    } );

     // delete area 
    
    $(document).on('click', '.delete', function(){
        $this = $(this);
        $did = $(this).attr('del-id');

        if(confirm("Are You Sure?")){
            $.ajax({
                url: "<?= base_url('admin/ajax-del-customer-order-list') ?>",
                dataType: 'json',
                type: 'POST',
                data: {id: $did},
                success: function (returnData) {
                    console.log(returnData);
                    $this.closest('tr').remove();
                    // obj = JSON.parse(returnData);
                    notification(returnData);
                    //refresh table
                    $("#customer_order_table").DataTable().ajax.reload();
                },
                error: function (returnData) {
                    obj = JSON.parse(returnData);
                    notification(obj);
                }
            });
        }
        
    });    


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