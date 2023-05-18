<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Status | <?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Report - Customer Order Status</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Order Status </li>
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
                            <form id="form_customer_order" method="post" action="<?= base_url('admin/report-shipment-details') ?>" class="cmxform form-horizontal tasi-form" novalidate="novalidate" target="_blank">
                                <div class="form-group ">
                                    <div class="col-lg-3">
                                        <select id="shipment_date" name="shipment_date" required class="form-control select2">
                                                <option value=""> Select Shipment Date* </option>
                                                        <?php
                                                        foreach ($all_shipment_dates as $a_s_d) {
                                                        ?>
                                                        <option value="<?= $a_s_d ?>"><?= $a_s_d ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                    </div>
                                    <div class="col-sm-5">
                                       <label> Select OrderNO. </label><br />
                    <a id="select-all-second" href="#">Select All</a>
                 /
                <a id="deselect-all-second" href="#">Deselect All</a>
                    <select id="customer_order" class="form-control" name="customer_order[]" multiple="multiple">
                        
                    </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <br/><br/>
                                        <button name="submit" value="order_details_with_brkup_anty_details" class="btn btn-success" type="submit"><i class="fa fa-search"> Order Summary (With Brkup Details) </i></button>
                                    </div>
                                </div>
                            </form>
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
<script src="<?=base_url()?>assets/admin_panel/js/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/jquery.quicksearch.js"></script>

<script>
    $('.select2').select2();

    $("#article_group").change(function(){

        $am_gr = $(this).val(); 
        $.ajax({
            url: "<?= base_url('ajax-fetch-article-on-group') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_gr': $am_gr},
            success: function(returnData){
                console.log(returnData);
                
                // $("#article_number").html("<option value=''>Select Article</option>");
                $.each(returnData, function (index, itemData) {
                    $str2 = '<option value="'+itemData.ad_id +'">'+ itemData.art_no +' ['+ itemData.color +']' +'</option>';
                    $("#article_number").append($str2);
                });
                
                $('#article_number').select2('open');

            },
        });
    });

    $("#consumption_btn").click(function(e){
        e.preventDefault();
        var cos = $("#customer_order").val();
        console.log(cos);
        // var array = cos.split(',');
        $.each(cos , function(index, val) { 
            $url = "<?=base_url('admin/print-customer-order-consumption')?>/"+val;
            console.log($url);
            var win = window.open($url, '_blank');
        });
    });
    
</script>

<script>
           $(document).ready(function(){
              $(function () {
            $(".date").datepicker({dateFormat: 'dd-mm-yy'});
        });
        $('#customer_order').multiSelect({
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
           $('#select-all-second').click(function(){
               $('#customer_order').multiSelect('select_all');
               return false;
           });
           $('#deselect-all-second').click(function(){
               $('#customer_order').multiSelect('deselect_all');
               return false;
           });
       </script>

<script>
           
          $(document).on('change', '#shipment_date', function(){
              
              $("#customer_order").html('');

        $im_id = $(this).val();
        // alert($im_id);

        $.ajax({

            url: "<?= base_url('admin/get-fetch-all-order-for-supplier-basis') ?>",

            method: "post",
            dataType: 'json',
            data: {'supp_date': $im_id,},
            success: function(all_colors){
                // console.log(all_items);
                
                $.each(all_colors, function(index, item) {
                    
                    str = ' <option value= ' + item.co_id + ' > ' + item.co_no + ' </option> ';
                    $("#customer_order").append(str);
                });
                $('#customer_order').multiSelect('refresh');
            },

            error: function(e){console.log(e);}

        });

    }); 
           
       </script>

</body>
</html>