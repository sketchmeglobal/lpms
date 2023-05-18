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
    <title>Packing/Shipment List | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
    <div class="body-content" style="min-height: 1500px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Packing/Shipment</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Packing/Shipment List </li>
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
                            <a href="<?= base_url('admin/add-packing-shipment') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Package Shipment List</a>
                                <?php
                            } 
                            ?>

                            <table id="cutting_issue_challan_table" class="table data-table dataTable">
                                <thead>
                                    <tr>
                                        <th>Pack Number</th>
                                        <th>Pack Date</th>
                                        <th>Cust. Name</th>
                                        <th>Tot. Qty.</th>
                                        <th>Grs. Wt.</th>
                                        <th>Pack AWB</th>
                                        <th>Actions</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cutting_issue_challan_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-packing-shipment-lis-table-data')?>",
                "type": "POST",
                "dataType": "json",
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "pack_name" },
                { "data": "pack_date" },
                { "data": "acc_name" },
                { "data": "total_quantity" },
                { "data": "gross_weight" },
                { "data": "pack_awb" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6], //disable 'Image','Actions' column sorting
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

                print: {

                    text: 'Print',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-packing-shipment/"+ $poi, "_blank");

                    }

                },

                shipmentPrint: {

                    text: 'Shipment Print',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-shipment-details/"+ $poi, "_blank");

                    }

                },
                
                printCrtn: {

                    text: 'Print(CRTN)',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-shipment-details-with-crtn/"+ $poi, "_blank");

                    }

                },
                
                printwoseal: {

                    text: 'Print w/o Seal',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-shipment-details-wo-seal/"+ $poi, "_blank");

                    }

                },
                
                prinths: {

                    text: 'Print(HS)',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-shipment-details-hs/"+ $poi, "_blank");

                    }

                },
                
                articleWeightPrint: {

                    text: 'Article Weight Print',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/print-shipment-details-article-weight/"+ $poi, "_blank");

                    }

                },
                
                packingShipmentConsumption: {

                    text: 'Packing Shipment Consumption',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/packing-shipment-consumption/"+ $poi, "_blank");

                    }

                },
                
                
                packingShipmentConsumptionPurchaseReceipt: {

                    text: 'Packing Ship. Cnsp. Purch. Recp.',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                        window.open("<?= base_url() ?>admin/packing-shipment-consumption-purchase-receipt/"+ $poi, "_blank");

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
                url: "<?= base_url('admin/delete-packing-shipment-header-list') ?>",
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