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
    <title>Article Costing Report<?=WEBSITE_NAME;?></title>
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
            <h3 class="m-b-less">Report - Article Costing Report</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active">Article Costing Report</li>
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
                    <div class="col-sm-3">
                                                <label for="cust_brkup_order" class="control-label text-danger">Select Group*</label>
                                                <select id="supp_second" name="supp_second" required class="form-control select2">
                                                <option value="">Select Group</option>
                                                        <?php
                                                        foreach ($group_arrays as $g_a) {
                                                        ?>
                                                        <option value="<?= $g_a['gr_ids'] ?>"><?= $g_a['gr_names'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                </select>
                                </div>
                <div class="col-sm-3">
                        <label class="control-label text-danger">Select Buyer*</label>
                        <select id="buyer_wise_order_details" name="buyer_wise_order_details" class="form-control select2">
                                            <option value="">Select Buyer</option>
                                            <?php foreach ($buyers as $buyer) {
                                                ?>
                                                <option value="<?= $buyer->am_id ?>"><?= $buyer->name . '['. $buyer->short_name .']' ?></option>
                                                <?php
                                            } ?>
                                         </select>
                    </div>
                <div class="col-sm-5">
                    <label>   Select Article  </label><br />
                    <a id="select-all" href="#">Select All</a>
                 /
                <a id="deselect-all" href="#">Deselect All</a>
                    <select id="costing_gropus" class="form-control" name="gropus[]" multiple="multiple">
                        
                        
                        
                        
                        
                    </select>
                </div>
                <div class="col-sm-1">
                    <br/><br/><br/><br/>
                <input type="submit" name="supplier_wise_item_position" value="Print" class="btn btn-sm btn-success btn-lg" />
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
        $('#costing_gropus').multiSelect({
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
               $('#costing_gropus').multiSelect('select_all');
               return false;
           });
           $('#deselect-all').click(function(){
               $('#costing_gropus').multiSelect('deselect_all');
               return false;
           });
       </script>
       
       <script>
           
          $(document).on('change', '#buyer_wise_order_details', function(){
              
              $("#costing_gropus").html('');

        $am_id1 = $(this).val();
        $am_id = $("#supp_second").val();
        // alert($im_id);

        $.ajax({

            url: "<?= base_url('admin/get-fetch-all-item-for-costings-article') ?>",

            method: "post",
            dataType: 'json',
            data: {'am_id': $am_id, 'am_id1': $am_id1},
            success: function(all_colors){
                // console.log(all_items);
                
                $.each(all_colors, function(index, item) {
                    
                    str = '<option value=' + item.ac_id + '> '+ item.art_no + '</option>';
                    $("#costing_gropus").append(str);
                });
                $('#costing_gropus').multiSelect('refresh');
            },

            error: function(e){console.log(e);}

        });

    }); 
           
       </script>
       
       
       
       
       

<script>

    $('.select2').select2();

</script>

</body>
</html>















