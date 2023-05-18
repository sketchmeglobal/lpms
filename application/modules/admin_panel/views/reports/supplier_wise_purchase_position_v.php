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
    <title>Supplier Wise Purchase Position<?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Report - Supplier Wise Purchase Position</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active">Supplier Wise Purchase Position</li>
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
                <div class="row">
                <div class="col-sm-6">
                    <label>Select Supplier </label><br />
                    <a id="select-all" href="#">Select All</a>
                 /
                <a id="deselect-all" href="#">Deselect All</a>
                    <select id="items" class="form-control" name="items[]" required multiple="multiple">
                      <?php
                    foreach ($buyers as $val) {
                        ?>
                        <option value="<?= $val->am_id ?>"><?= $val->name ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>From date</label>
                    <input autocomplete="off" type="date" id="myDate1" name="fromdate" class="form-control date" required value="" />
                </div>
                <div class="col-sm-2">
                    <label>To date</label>
                    <?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
                    <input autocomplete="off" type="date" id="myDate" name="todate" class="form-control date" required value="<?php echo $today; ?>" />
                </div>
                <div class="col-sm-12">
                <input type="submit" name="supplier_wise_item_position" value="Print" class="btn btn-sm btn-success" />
                <input type="submit" name="supplier_wise_item_position_wo_zero" value="Print(w/o zero)" class="btn btn-sm btn-success" />
                </div>
                </div>
            </form>
            <br/>
            <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
  <span style="font-size: 18px; background-color: #F3F5F6; padding: 0 10px;">
    Purchase Order Details With Customer Order History
  </span>
</div>
            <br/>
            <form class="row" method="post" target="_blank">
                <div class="row">
                    <div class="col-sm-3">
                                                <label for="cust_brkup_order" class="control-label">Select Supplier</label>
                                                <select id="supp_second" name="supp_second[]" required class="form-control select2">
                                                <option value="">Select Supplier</option>
                                                        <?php
                                                        foreach ($buyers as $bs) {
                                                        ?>
                                                        <option value="<?= $bs->am_id ?>"><?= $bs->name ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                </div>

                <div class="col-sm-5">
                    <label>Select Item </label><br />
                    <a id="select-all-second" href="#">Select All</a>
                 /
                <a id="deselect-all-second" href="#">Deselect All</a>
                    <select id="item_second" class="form-control" name="item_second[]" multiple="multiple">
                        
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>From date</label>
                    <input autocomplete="off" type="date" id="myDate2" name="fromdate1" class="form-control date" required value="2022-04-01" />
                </div>
                <div class="col-sm-2">
                    <label>To date</label>
                            <?php 
                            
                            $month = date('m');
                            $day = date('d');
                            $year = date('Y');
                            
                            $today = $year . '-' . $month . '-' . $day;
                            ?>
                <input autocomplete="off" type="date" id="myDate2" name="todate1" class="form-control date" required value="<?php echo $today; ?>" />
                </div>
                <br />
                <br>
                <div class="col-sm-12">
                <input type="submit" name="supplier_wise_item_position_brkup_details" value="Print(with brkup details)" class="btn btn-sm btn-success" />
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
<script src="<?=base_url()?>assets/admin_panel/js/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/jquery.quicksearch.js"></script>

<script>
           $(document).ready(function(){
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
        $('#items').multiSelect({
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
        $('#item_second').multiSelect({
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
               $('#items').multiSelect('select_all');
               return false;
           });
           $('#deselect-all').click(function(){
               $('#items').multiSelect('deselect_all');
               return false;
           });
           $('#select-all-second').click(function(){
               $('#item_second').multiSelect('select_all');
               return false;
           });
           $('#deselect-all-second').click(function(){
               $('#item-second').multiSelect('deselect_all');
               return false;
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
    const d = new Date();
    let year = d.getFullYear();
    document.getElementById("myDate1").defaultValue = year+"-04-01"; 
    document.getElementById("myDate2").defaultValue = year+"-04-01"; 
</script>

<script>

    $('.select2').select2();

</script>

</body>
</html>















