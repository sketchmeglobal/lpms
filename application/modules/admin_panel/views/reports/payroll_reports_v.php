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
    <title>Payroll Reports<?=WEBSITE_NAME;?></title>
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
    
    .btn {
        width: 60%;
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
            <h3 class="m-b-less">Report - Payroll Reports</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Payroll Reports </li>
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
                <div class = "row">
                <div class="col-sm-2">
                    <label>Month/Year</label>
                       <select name="month" id="month" class="form-control">
                           <?php
                           for ($mon = 1; $mon <= 12; $mon++) {
                           ?>
                            <option <?= (date('F') == date('F', mktime(0, 0, 0, $mon, 1))) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $mon, 1)) ?></option>
                           <?php
                           }
                           ?>
                       </select>
                </div>
                    <div class="col-sm-2">
                    <label>Select Department </label><br />
                    <select id="group" name="group" class="form-control select2" required>
                        <option value="">Select From The List</option>
                        <?php
                        foreach ($departments as $fcbl) {
                            ?>
                            <option value="<?= $fcbl->d_id ?>"><?= $fcbl->department ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-5">
                  <label>Select Item From The List</label><br />
                    <a id="select-all" href="#">Select All</a>
                 /
                <a id="deselect-all" href="#">Deselect All</a>
                <select id="leather_status" name="leather[]" multiple="multiple" style="width: 100%">
                    </select>
                </div>
                
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12">
                        <input type="submit" name="adl" class="btn btn-success btn-sm" value="Adv. Ledger" target="_blank" />
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="lv" class="btn btn-success btn-sm" value="Leave" target="_blank" />
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="esi" class="btn btn-success btn-sm" value="E.S.I. Summary" target="_blank" />
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="pf" class="btn btn-success btn-sm" value="P.F. Summary" target="_blank" />
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="reg" class="btn btn-success btn-sm" value="Register" target="_blank" />
                        <!--<input type="submit" name="reg" class="btn btn-success btn-sm preg" value="Print Register" />-->
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="ot" class="btn btn-success btn-sm" value="Overtime" target="_blank" />
                        <!--<input type="submit" name="reg" class="btn btn-success btn-sm preg" value="Print Register" />-->
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="sa_otim" class="btn btn-success btn-sm" value="Salary Overtime" target="_blank" />
                        <!--<input type="submit" name="reg" class="btn btn-success btn-sm preg" value="Print Register" />-->
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="bonus_report" class="btn btn-success btn-sm" value="Bonus Sheet" target="_blank" />
                        <!--<input type="submit" name="reg" class="btn btn-success btn-sm preg" value="Print Register" />-->
                    </div>
                    </div>
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
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="<?=base_url()?>assets/admin_panel/js/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/jquery.quicksearch.js"></script>

<script>
    $('.select2').select2();
</script>

<script>
           $(document).ready(function(){
               
               var new_array = [];
               
               $(function () {
                    $(".date").datepicker({dateFormat: 'dd-mm-yy'});
                });
               $('#group').change(function(){
                   $gr_id = ($(this).val());
                    //   alert(new_array);
                    
                   $.ajax({
                       method: 'post',
                       dataType: 'json',
                       url: "<?= base_url('emp-on-dept-id-new-multiple') ?>",
                       data: {gr_id:$gr_id},
                       success: function(items){
                           // console.log(items);
                           $('#leather_status').html('');
                           $.each(items, function(index, itemData){
                               $apnd_val = '<option value="'+ itemData.e_id +'">'+ itemData.name +'</option>';
                               $("#leather_status").append($apnd_val);
                           });
                          $('#leather_status').multiSelect('refresh');
                       },
                       error: function(e){
                           console.log(e);
                       }
                   });
                   
               });
           });
       </script>
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
    document.getElementById("myDate1").defaultValue = "2022-04-01"; 
    // document.getElementById("myDate2").defaultValue = date('y-m-d');  
</script>
</body>
</html>















