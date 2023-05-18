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
    <title>Customer Order Wise Item Purchase Details<?=WEBSITE_NAME;?></title>
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
    .jobber_type {
    border: 1px solid #cac8c8;
    padding: 6px;
    }
    input[type="submit"] {
        margin-top: 26px;
    }
    hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #998989;
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
            <h3 class="m-b-less">Report - Customer Order Wise Item Purchase Details</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active">Customer Order Wise Item Purchase Details</li>
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
                            <form class="row" method="post" action="<?= base_url('admin/purchase_order_audit_report_details_values') ?>" target="_blank">
                <div class="row">
                <div class="col-sm-4">
                    <label>Select Order No </label><br />
                    <select id="order_no" class="form-control select2" name="order_no[]" required multiple="multiple">
                      <?php
                    foreach ($co_ids as $val) {
                        ?>
                        <option value="<?= $val->co_id ?>"><?= $val->co_no ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Select Item Group </label><br />
                    <select id="item_name" class="form-control select2" name="item_name[]" required>
                      <?php
                    foreach ($fetch_all_leather as $val) {
                        ?>
                        <option value="<?= $val->ig_id ?>"><?= $val->group_name ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="col-sm-12">
                <input type="submit" name="supplier_wise_item_position" value="Print" class="btn btn-sm btn-success" />
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
           $(document).ready(function(){
               $(function () {
                $(".select2").select2();
            });
               $(function () {
                    $(".date").datepicker({dateFormat: 'dd-mm-yy'});
                });
           });
       </script>
<script>
           $(document).ready(function(){
              $(function () {
            $(".date").datepicker({dateFormat: 'dd-mm-yy'});
        });
       </script>
       
       <script>
           
          $(document).on('change', '#supp_second', function(){
              
              $("#item_second").html('');

        $im_id = $(this).val();
        // alert($im_id);

        $.ajax({

            url: "<?= base_url('admin/get-fetch-all-item-for-supplier-basis') ?>",

            method: "post",
            dataType: 'json',
            data: {'supp_id': $im_id,},
            success: function(all_colors){
                // console.log(all_items);
                
                $.each(all_colors, function(index, item) {
                    
                    str = '<option value=' + item.id_id + '> '+ item.item + ' - ' + item.color + '</option>';
                    $("#item_second").append(str);
                });
                $('#item_second').multiSelect('refresh');
            },

            error: function(e){console.log(e);}

        });

    }); 
           
       </script>
       
       <script>
    document.getElementById("myDate1").defaultValue = "2022-04-01";
    document.getElementById("myDate2").defaultValue = "2022-04-01";
    // document.getElementById("myDate2").defaultValue = date('y-m-d');  
</script>

<script>

    $('.select2').select2();

</script>

</body>
</html>















