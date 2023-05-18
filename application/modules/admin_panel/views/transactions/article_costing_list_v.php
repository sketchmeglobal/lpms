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
    <title>Article Costing | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <style type="text/css">
        .nowrap{white-space: nowrap;}
        .btn {
    padding: 4px 12px;
}

.dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .add_bgclr {
            background-color: #b5e3b5;
        }

        .bg-danger-fade{background: #ef8987;color: #fff}

        .hide {
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
            <h3 class="m-b-less">Article Costing</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Article Costing </li>
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
                            <a href="<?= base_url('admin/add_article_costing') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Article Costing</a>
                                <?php
                            } 
                            ?>

                            <table id="article_costing_table" class="table data-table dataTable">
                                <thead>
                                <tr>
                                    <th>Article Group</th>
                                    <th>Article No</th>
                                    <th>Description</th>
                                    <th>Customer</th>
                                    <th>Ex Works</th>
                                    <th>C&F</th>
                                    <th>FOB</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th nowrap="">Actions</th>
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
        $('#article_costing_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Article Costing PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,8]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Article Costing Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,8]
                    }    
               }
           ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_costing_table_data')?>",
                "type": "POST",
                "dataType": "json",
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "group_name" },
                { "data": "art_no" },
                { "data": "info" },
                { "data": "name" },
                { "data": "exworks_amt" },
                { "data": "cf_amt" },
                { "data": "fob_amt" },
                { "data": "img" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [4,5,6,7,8,9], //disable 'Image','Actions' column sorting
                "orderable": false,
                //"targets": -1, // targets last column, use 0 for first column
                "className": 'nowrap'
            }]
        } );
    } );


    // delete area 
    
        $(document).on('click', '.delete', function(){
            $this = $(this);
            if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                $ac_id = $(this).attr('ac_id');
                $am_id = $(this).attr('am_id');
                

                $.ajax({
                    url: "<?= base_url('admin/delete-costing') ?>",
                    dataType: 'json',
                    type: 'POST',
                    data: {ac_id: $ac_id, am_id : $am_id},
                    success: function (returnData) {
                        console.log(returnData);

                        notification(returnData);
                        //refresh table
                        $("#article_costing_table").DataTable().ajax.reload();
                        
                    },
                    error: function (returnData) {
                        alert('error');
                        // obj = JSON.parse(returnData);
                        notification(returnData);
                    }
                });
            }
            
        });

        $(document).on('click', '.print_all_cost_sheet',function(){
        $poi = $(this).attr('po-id');

     $.confirm({

            title: 'Choose!',

            content: 'Choose printing methods from the below options',

            buttons: {

                print_cs: {

                    text: 'Print (CS)',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                     window.open("<?= base_url() ?>admin/print_article_costing/"+ $poi, "_blank");

                    }

                },

                print_cs_wo_cost: {

                    text: 'Print (CS W/O Cost)',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                     window.open("<?= base_url() ?>admin/print_article_costing_wo_rate/"+ $poi, "_blank");

                    }

                },

                print_ms: {

                    text: 'Print (MS)',

                    btnClass: 'btn-blue',

                    keys: ['enter', 'shift'],

                    action: function(){

                     window.open("<?= base_url() ?>admin/print_article_costing_ms/"+ $poi, "_blank");

                    }

                },

                cancel: function () {}

            }

        });   

    });

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
</script>

</body>
</html>