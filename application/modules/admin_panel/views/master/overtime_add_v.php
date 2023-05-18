<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 */
?>
<?php
// print_r($buyer_details);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Overtime | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add Purchase order">

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <style>
        table {
            overflow: scroll;
        }
        .panel1_scroll {
            height: 500px;
            overflow-y: scroll;
        }
        input[type="text"] {
            width: 100%;
            text-align: right;
        }
    </style>
</head>

<body class="sticky-header">

<section>
    <!-- sidebar left start (Menu)-->
    <?php $this->load->view('components/left_sidebar'); //left side menu ?>
    <!-- sidebar left end (Menu)-->

    <!-- body content start-->
    <div class="body-content" style="min-height: 600px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Add Overtime Details</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Overtime Details</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel panel1_scroll">
                        <div class="panel-body">
                            <form id="form_add_overtime" method="post" action="<?=base_url('admin/form-add-overtime')?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
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
                                </div>

<table id="cutting_bill_details_table_insert" class="table data-table dataTable table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Ot. Rate.</th>
                                                            <th>Ot. Hours.</th>
                                                            <th>ot. Total</th>
                                                            <th>Fact. <br/> Act <br/> Ot <br/> Hrs <br/> Max</th>
                                                            <th>Balance</th>
                                                            <th>Factory Ot.</th>
                                                            <th>P. Bonus</th>
                                                            <th>Total</th>
                                                            <th>ESI Deduct.</th>
                                                            <th>Othrs/<br/>Advnc</th>
                                                            <th>Total Deduct.</th>
                                                            <th nowrap>Net Pay</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
            
                                                    </tbody>
                                                </table>

                                   <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Overtime</i></button>
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

    $("#group").change(function(){
        $dept_id = $(this).val();
        $month = $("#month").val();
        $("#add_details").attr("disabled", false);
        $.ajax({
            url: "<?= base_url('admin/get-all-emp-id-for-overtime') ?>",
            method: "post",
            dataType: 'json',
            data: {'dept_id': $dept_id, 'month': $month},
            success: function(result){
                console.log('length:'+result.length);           
                console.log(JSON.stringify(result));
                $("#cutting_bill_details_table_insert tbody").html("");

                if(result.length > 0) {

                $.each(result, function(index, item) { 

                    $str = '<tr><td>'+item.name +'</td><td><input class="class_rate" type="text" name="add_ot_rate[]" required value="'+item.ot_rate+
                    '" /></td><td><input class="class_hour" required type="text" name="add_ot_hour[]" value="" /></td><td><input required class="class_total" type="text" name="add_ot_total[]" value="" readonly /><input type="hidden" name="add_id[]" value="'+item.e_id+'" /><input type="hidden" name="employee_type[]" class="employee_type" value="'+item.pf_percentage_calculation+'" /></td><td><input class="fact_act_ot_hrs_max" type="text" name="fact_act_ot_hrs_max[]" value="'+Math.round(item.ot_rate_factory)+'"/></td><td><input class="balance_hrs_max" type="text" name="balance_hrs_max[]" value="0" readonly/></td><td><input class="factory_ot" type="text" name="factory_ot[]" value="0" readonly/></td><td><input class="bonus_total" type="text" name="add_ot_bonus[]" value="0" readonly/></td><td><input class="main_total" type="text" name="add_ot_main_total[]" value="0" readonly/></td><td><input class="esi_percentage" type="hidden" name="esi_percentage[]" value="'+item.esi_percentage+'"/><input class="deduct_esi" type="text" name="add_ot_deduct_esi[]" value="0" readonly/></td><td><input class="advnc_oths" type="text" name="add_ot_advnc_oths[]" value="0"/></td><td><input class="deduct_total" type="text" name="add_ot_deduct_total[]" value="0" readonly/></td><td><input class="net_pay" type="text" name="add_ot_net_pay[]" value="0" readonly/></td></tr>';

                    $("#cutting_bill_details_table_insert tbody").append($str);
                });

            } else {

               $("#cutting_bill_details_table_insert tbody").append('already_added');

            }

                // alert($tot_amn);
            },
            error: function(e){console.log(e);}
        });
        
    });

    $(document).on('blur', '.class_rate, .class_hour, .main_total, .advnc_oths, .net_pay, .fact_act_ot_hrs_max', function () {
        
        $class_rate = parseFloat($(this).closest('tr').find(".class_rate:eq(0)").val());
        $class_hour = parseFloat($(this).closest('tr').find(".class_hour:eq(0)").val());
        $main_total = parseFloat($(this).closest('tr').find(".main_total:eq(0)").val());
        $advnc_oths = parseFloat($(this).closest('tr').find(".advnc_oths:eq(0)").val());
        $deduct_total = parseFloat($(this).closest('tr').find(".deduct_total:eq(0)").val());
        $esi_percentage = parseFloat($(this).closest('tr').find(".esi_percentage:eq(0)").val());
        $net_pay = parseFloat($(this).closest('tr').find(".net_pay:eq(0)").val());
        $fact_act_ot_hrs_max = parseFloat($(this).closest('tr').find(".fact_act_ot_hrs_max:eq(0)").val());
        $employee_type = $(this).closest('tr').find(".employee_type:eq(0)").val();
        
        if($fact_act_ot_hrs_max > 64) {
            alert('Factory Act Ot Hrs Can Not Be Greater Than 64');
            $(this).closest('tr').find(".fact_act_ot_hrs_max:eq(0)").val(64);
        }
        
    $(this).closest('tr').find(".class_total:eq(0)").val(($class_rate * $class_hour).toFixed(2));
    $class_total = parseFloat(($class_rate * $class_hour).toFixed(2));
    
    // alert($employee_type);
    
    if($employee_type == 'contractual') {
        
    $balance_hrss = parseFloat($class_hour - $fact_act_ot_hrs_max);
    $(this).closest('tr').find(".balance_hrs_max:eq(0)").val($balance_hrss);
    
    if($class_hour > $fact_act_ot_hrs_max) {
    
    $p_bonus = parseFloat(($class_rate * $balance_hrss).toFixed(2));

    } else {
        
      $p_bonus = 0;

    }
    
    $(this).closest('tr').find(".bonus_total:eq(0)").val($p_bonus);
    
    $factory_ot = parseFloat(($class_total - $p_bonus).toFixed(2));
    $(this).closest('tr').find(".factory_ot:eq(0)").val($factory_ot);
    
    } else {
        
       $(this).closest('tr').find(".fact_act_ot_hrs_max:eq(0)").val(0);
       $(this).closest('tr').find(".balance_hrs_max:eq(0)").val(0);
        
       $(this).closest('tr').find(".fact_act_ot_hrs_max:eq(0)").prop('readonly', true);
       $(this).closest('tr').find(".balance_hrs_max:eq(0)").prop('readonly', true);
       
       $p_bonus = parseFloat(($class_total * (55/100)).toFixed(2));
    $(this).closest('tr').find(".bonus_total:eq(0)").val($p_bonus);
    
    $factory_ot = parseFloat(($class_total * (45/100)).toFixed(2));
    $(this).closest('tr').find(".factory_ot:eq(0)").val($factory_ot);

    }
    
    $bonus_ot_total = parseFloat(($factory_ot + $p_bonus).toFixed(2));
    $(this).closest('tr').find(".main_total:eq(0)").val($bonus_ot_total);
    
    $deduct_esi_val = parseFloat(($bonus_ot_total * ($esi_percentage/100)).toFixed(2));
    $(this).closest('tr').find(".deduct_esi:eq(0)").val(Math.round($deduct_esi_val));
    
    $deduct_total_val = parseFloat(($deduct_esi_val + $advnc_oths).toFixed(2));
    $(this).closest('tr').find(".deduct_total:eq(0)").val(Math.round($deduct_total_val));
    
    $net_pay_val = parseFloat(($bonus_ot_total - $deduct_total_val).toFixed(2));
    $(this).closest('tr').find(".net_pay:eq(0)").val(Math.round($net_pay_val));
    
    });
    
    //add-item-form validation and submit
    $("#form_add_overtime").validate({

        rules: {

            month: {
                required: true
            },
            group: {
                required: true
            },
            
        },
        messages: {

        }

    });
    
    $('#form_add_overtime').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_overtime").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            //console.log(obj);
            notification(obj);
            
            if(obj.insert_id > 0){
                $('#form_add_overtime')[0].reset(); //reset form
                $("#form_add_overtime").validate().resetForm(); //reset validation
                
                window.location.href='<?=base_url()?>admin/overtime';
                
                // $('#edit_btn').attr('href', '<?=base_url()?>admin/edit-cutting-issue-challan/'+obj.insert_id);
                // $('#edit_btn').removeClass('hidden');
            }
        }
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
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }

</script>

</body>
</html>



