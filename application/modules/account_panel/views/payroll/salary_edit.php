<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 21-02-2020
 * Time: 11:30 am
 * Last updated on 25-Feb-2021 at 11:30 am
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Salary Edit | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="Order Status">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
    .hidden {
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
            <h3 class="m-b-less">Salary Edit</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('accounts/dashboard');?>">Transaction</a></li>
                    <li class="active">Salary Edit</li>
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
                            <div class="row">
                <form method="post" class="container" id="insert_form">
               <div class="col-sm-11">
                   <div class="col-sm-8" style="border: 1px solid #000; border-radius: 2%;height:275px">
                       <div class="row">
                           <div class="col-sm-4">
                               <label>Month/Year</label>
                               <?php
                               echo $fetch_all_sal_details[0]->MON;
                               ?>
                               <select name="month" class="form-control">
                                   <?php
                                   for ($mon = 1; $mon <= 12; $mon++) {
                                   ?>
                                    <option <?= ($fetch_all_sal_details[0]->MON == date('F', mktime(0, 0, 0, $mon, 1)) .'~'. cal_days_in_month(CAL_GREGORIAN,$mon,date('Y'))  .'~'. $mon) ? 'selected' : 'disabled' ?>><?= date('F', mktime(0, 0, 0, $mon, 1)) .'~'. cal_days_in_month(CAL_GREGORIAN,$mon,date('Y'))  .'~'. $mon ?></option>
                                   <?php
                                   }
                                   ?>
                               </select>
                           </div>
                           <div class="col-sm-8">
                               <label>Select Employee</label>
                               <select class="form-control" name="emp_id" id="emp_select"  style="width: 100%">
                                   <option>Select from the list</option>
                                   <?php
                                   foreach($fetch_all_employee as $emps){
                                       ?>
                                       <option <?= ($fetch_all_sal_details[0]->EMPCODE == $emps->e_id) ? 'selected' : 'disabled' ?> value="<?= $emps->e_id ?>"><?= $emps->name . ' ['. $emps->e_code .']' ?></option>
                                       <?php
                                   }
                                   ?>
                               </select>
                           </div>
                           </div>
                           <div class="row">
                               <div class="col-sm-8">
                                   <div class="row">
                                        <div class="col-sm-6">
                                           <label>Department:</label>
                                           <span class="dept"><?= $fetch_all_sal_details[0]->working_place ?></span>
                                       </div>
                                       <div class="col-sm-6">
                                           <label>Date of Birth:</label>
                                           <span class="dob"><?= $fetch_all_sal_details[0]->dob ?></span>
                                       </div>
                                       
                                       <div class="col-sm-6">
                                           <label>Date of Joining:</label>
                                           <span class="doj"><?= $fetch_all_sal_details[0]->doj ?></span>
                                       </div>
                                       <div class="col-sm-6">
                                            <label>ESI Applicable?:</label>
                                           <span class="esiapp">
                                           <?php 
                                  if($fetch_all_sal_details[0]->esi = 1) {
                                    echo 'Yes';
                                  } else {
                                    echo 'No';
                                  }
                                            ?>
                                           </span>
                                       </div>
                                       <div class="col-sm-6">
                                            <label>PF Applicable?:</label>
                                           <span class="pfapp">
                                             <?php 
                                  if($fetch_all_sal_details[0]->PF_APPLICABLE = 1) {
                                    echo 'Yes';
                                  } else {
                                    echo 'No';
                                  }
                                            ?>
                                           </span>
                                       </div>
                                       
                                       <div class="col-sm-6">
                                            <label>Actual Basic:</label>
                                           <span class="acbsc"><?= $fetch_all_sal_details[0]->basic_pay ?></span>
                                       </div>
                                       <div class="col-sm-6">
                                            <label>Actual D.A.:</label>
                                           <span class="acda"><?= $fetch_all_sal_details[0]->da_amout ?></span>
                                       </div>
                                       <div class="col-sm-6">
                                            <label>Actual HRA:</label>
                                           <span class="achra"><?= $fetch_all_sal_details[0]->hra_amount ?></span>
                                       </div>
                                       <div class="col-sm-6">
                                            <label>Conveyance:</label>
                                           <span class="convey"><?= $fetch_all_sal_details[0]->convenience ?></span>
                                       </div>
                                       <!--<div class="col-sm-6">-->
                                       <!--     <label>CL Taken (so far):</label>-->
                                       <!--    <span class="cl_taken"></span>-->
                                       <!--</div>-->
                                       <!--<div class="col-sm-6">-->
                                       <!--     <label>EL Taken (so far):</label>-->
                                       <!--    <span class="el_taken"></span>-->
                                       <!--</div>-->
                                       
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <?php
                                        $gender = $fetch_all_sal_details[0]->gender;
                                        if($gender == "Male" && $fetch_all_sal_details[0]->picture == ''){
                                            $emp_img = "assets/admin_panel/img/employee_img/nopic.png";    
                                        }else if($gender == "Female" && $fetch_all_sal_details[0]->picture == ''){
                                            $emp_img = "assets/admin_panel/img/employee_img/nopicf.png";    
                                        }else{
                                            $emp_img = "assets/admin_panel/img/employee_img/" . $fetch_all_sal_details[0]->picture;
                                        }
                                   ?>
                                   <img style="height:100px;border:1px solid tomato" src="<?= base_url() . $emp_img ?>" class="img-responsive emp_img" src="" alt="" />
                               </div>
                          
                       </div>
                   </div>
                   <div class="col-sm-4" style="border: 1px solid #000; border-radius: 2%;">
                       <div class="col-sm-8"><label>Working Days</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T1 ?>" type="text" id="wd" name="wd" class="form-control" /></div>
                       
                        <div class="col-sm-8"><label>Holidays</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T3 ?>" type="text" id="hol"  readonly  name="hol" class="form-control" /></div>
                       
                        <div class="col-sm-8"><label>Casual Leave</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T4 ?>" type="text" id="cl"  readonly   name="cl" class="form-control" /></div>
                       
                        <div class="col-sm-8"><label>Earn Leave</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T5 ?>" type="text" id="el"  readonly   name="el" class="form-control" /></div>
                       
                        <div class="col-sm-8"><label>E.S.I Leave</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T6 ?>" type="text" id="esil"  readonly  name="esil" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Absent</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T7 ?>" type="text" id="abs"  readonly   name="abs" class="form-control" /></div>
                       
                        <div class="col-sm-8"><label>Total Days</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T8 ?>" type="text" id="td"  readonly   name="td" class="form-control" /></div>
                   
                       <div class="col-sm-8"><label>Actual Days Worked</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->T2 ?>" type="text" id="adw"  readonly   name="adw" class="form-control" /></div>
                   
                   </div>
               </div>
               
               <div class="row"><div class="clearfix"></div></div>
               
               <div class="col-sm-11">
                   <div class="col-sm-6" style="border: 1px solid #000; border-radius: 2%;">
                       <h5>Income</h5>
                       
                       <div class="col-sm-8"><label>Actual Basic</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->BASIC ?>" step="0.01" min="0" type="number" id="abasic" name="abasic" class="form-control" />
                       <input value="<?= $fetch_all_sal_details[0]->pf_percentage_calculation ?>" type="hidden" id="pf_percentage_calculation" name="pf_percentage_calculation" class="form-control" />
                       </div>
                       
                       <div class="col-sm-8"><label>Actual D.A.</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->DA ?>" step="0.01" min="0" type="number" id="ada" name="ada" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Actual HRA</label></div>
                       <div class="col-sm-4">
                           <input type="number" value="<?= $fetch_all_sal_details[0]->hra_percentage ?>" id="ahra_perctg" name="ahra_perctg" class="form-control" /></div>
                           <div class="col-sm-8"></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->HRA ?>" step="0.01" min="0" type="number" id="ahra" name="ahra" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Conveyance</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->CONV ?>" step="0.01" min="0" type="number" id="con" name="con" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Medical Allowance</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->MED ?>" step="0.01" min="0" type="number" id="ma" name="ma" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Edu Allowance</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->OA ?>" step="0.01" min="0" type="number" id="oa" name="oa" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Other Hour</label></div>
                       <div class="col-sm-4"><input value="<?= $fetch_all_sal_details[0]->OT ?>" step="0.01" min="0" type="number" id="oh" name="oh" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Other Amount</label></div>
                       <div class="col-sm-4"><input  value="<?= $fetch_all_sal_details[0]->OTAMT ?>" step="0.01" min="0" type="number" id="oam" name="oam" class="form-control" /></div>
                       
                       
                   </div>
                   <div class="col-sm-6" style="border: 1px solid #000; border-radius: 2%;">
                        <h5>Deductions and Final</h5>
                        
                       
                        <div class="col-sm-6"><label>P.F. % & Amount</label></div>
                        <div class="col-sm-6">
                            <input type="number" name="pfper" value="<?= $fetch_all_sal_details[0]->PFPER ?>" step="0.01" min="0" id="pfper" style="width:35%;float:left" class="form-controls"/>
                            <input type="number" name="pfamnt" value="<?= $fetch_all_sal_details[0]->PFAMT ?>" step="0.01" min="0" id="pfamnt" style="width:65%;float:right" class="form-controls"/>
                        </div>
                        <div class="row"></div>
                        <div class="col-sm-6"><label>E.S.I. % & Amount</label></div>
                        <div class="col-sm-6">
                            <input type="number" name="esiper"  value="<?= $fetch_all_sal_details[0]->ESIPER ?>" step="0.01" min="0" id="esiper" style="width:35%;float:left" class="form-controls"/>
                            <input type="number" name="esiamnt"  value="<?= $fetch_all_sal_details[0]->ESIAMT ?>" step="0.01" min="0" id="esiamnt" style="width:65%;float:right" class="form-controls"/>
                        </div>
                        <div class="row"></div>
                        
                       <div class="col-sm-8"><label>Professional Tax</label></div>
                       <div class="col-sm-4"><input type="number"  value="<?= $fetch_all_sal_details[0]->TAX ?>" step="0.01" min="0" id="ptax" name="ptax" class="form-control" /></div>
                       
                       <div class="col-sm-8"><label>Insurance</label></div>
                       <div class="col-sm-4"><input type="number"  value="<?= $fetch_all_sal_details[0]->INS ?>" step="0.01" min="0" id="insur" name="insur" class="form-control" /></div>
                       
                       <div class="col-sm-8 hiddenX"><label>Loan/Advance Taken.</label></div>
                       <div class="col-sm-4 hiddenX">
                           <input type="number" readonly="" name="loan_taken" value="0" step="0.01" min="0" id="loan_taken" class="form-control" />
                        </div>
                       
                       <div class="col-sm-8"><label>Loan/Advance Adjusted So Far</label></div>
                       <div class="col-sm-4">
                           <input type="number" readonly="" name="loan_adj_till" value="0" step="0.01" min="0" id="loan_adj_till" class="form-control" />
                        </div>
                        
                       <div class="col-sm-8 hiddenX"><label>Loan/Advance Monthly Installment</label></div>
                       <div class="col-sm-4 hiddenX">
                           <input type="number" readonly="" value="0" step="0.01" min="0" id="loan_mon_adj" name="loan_mon_adj" class="form-control" />
                        </div>
                        
                        <div class="col-sm-8"><label>Loan/Advance Adjusted (This month)</label></div>
                        <div class="col-sm-4">
                           <input type="number" readonly="" name="loan_adj" value="<?= $fetch_all_sal_details[0]->LOAN ?>" step="0.01" min="0" id="loan_adj" class="form-control" />
                        </div>
                        
                       <hr />
                       
                   </div>
               </div>
               
               
               <div class="row"><div class="clearfix"><br /></div></div>
               <div class="row"><div class="clearfix"><br /></div></div>
               
               <div class="">
                    <div class="col-sm-11" style="border: 1px solid #000; border-radius: 2%;">
                       <div class="col-sm-2"><label>Gross Salary</label></div>
                       <div class="col-sm-2"><input type="number"value="<?= $fetch_all_sal_details[0]->GROSS ?>" step="0.01" min="0" id="gross" name="gross" class="form-control" /></div>
                       
                       <div class="col-sm-2"><label>Total Deductions</label></div>
                       <div class="col-sm-2"><input type="number" value="<?= $fetch_all_sal_details[0]->DEDUC ?>" step="0.01" min="0" id="ded" name="ded" class="form-control" /></div>
                       
                       <div class="col-sm-2"><label>Net Salary</label></div>
                       <div class="col-sm-2"><input type="number" value="<?= $fetch_all_sal_details[0]->NET ?>" step="0.01" min="0" name="net" id="net" class="form-control" /></div>
                    </div>
               </div>
                
               
               <div class="row"><br /></div><div class="row"><br /></div>
               <input type="submit"  class="final_sub btn btn-sm btn-success" value="Update" name="save" />
               <input type="submit"  class="final_sub btn btn-sm btn-success" value="Update & Go Back To List" name="savengo" />
               
               
           </form>    
            </div>
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
    $('#cut_rcpt_challan').select2();   
</script>

<script>
    document.getElementById("myDate1").defaultValue = "2020-04-01"; 
    // document.getElementById("myDate2").defaultValue = date('y-m-d');  
</script>

            <script>
                $(document).ready(function(){

$("#cl, #el, #esil, #abs").blur(function(){
                    // $val = parseInt($("#hol").val()) + parseInt($("#cl").val()) + parseInt($("#el").val()) + parseInt($("#esil").val()) + parseInt($("#abs").val());
                    // $actual_d_w = parseInt($("#wd").val()) - parseInt($("#hol").val()) - parseInt($("#cl").val()) - parseInt($("#el").val()) - parseInt($("#esil").val()) - parseInt($("#abs").val());
                    // $("#td").val($val);
                    // $("#adw").val($actual_d_w);
                    
                    // CL area -- fetch already taken cl for the current session
                    
                    var month1 = parseInt($("#month").find(":selected").text().split('~')[1]);
                    
                    var total_cl_taken_no = parseInt($("#cl_geanted_value").val());
                    var total_el_taken_no = parseInt($("#el_geanted_value").val());
                    var cl_leave_day = 0;
                    var cl = parseInt($("#cl").val());
                    var el = parseInt($("#el").val());
                    var cl_taken = parseInt($(".cl_taken").text());
                    var el_taken = parseInt($(".el_taken").text());
                    var tot_cl = (cl + cl_taken);
                    var tot_el = (el + el_taken);
                    var tot_cl_el = (cl + el);
                    var tot_cl_el_granted = (parseInt(tot_cl) + parseInt(tot_el));
                    
                    if(tot_cl > total_cl_taken_no) {
                        alert("Casual Leave exceeds Maximum Alloted");
                        var cl_leave_day = (total_cl_taken_no - tot_cl);
                        if(cl_leave_day > 0) {
                            $("#cl").val(cl_leave_day);
                        } else {
                        $("#cl").val(0);
                        }
                    }
                    
                    if(tot_el > total_el_taken_no) {
                        alert("Earn Leave exceeds Maximum Alloted");
                        var el_leave_day = (total_el_taken_no - tot_el);
                        if(el_leave_day > 0) {
                            $("#el").val(el_leave_day);
                        } else {
                        $("#el").val(0);
                        }
                    }
                    
                    // ESI CALCULATION and D.A. Calculation
                    if($("#esil").val() > 0){
                        var esi_leave_day = parseInt($('#esil').val());
                        var abasic = parseFloat($("#abasic").val()) - ((parseFloat($("#abasic").val()) / month1) * esi_leave_day);
                        var ada = parseFloat($("#ada").val()) - ((parseFloat($("#ada").val()) / month1) * esi_leave_day);
                        var con = parseFloat($("#con").val()) - ((parseFloat($("#con").val()) / month1) * esi_leave_day);
                        var ma = parseFloat($("#ma").val()) - ((parseFloat($("#ma").val()) / month1) * esi_leave_day);
                        var oa = parseFloat($("#oa").val()) - ((parseFloat($("#oa").val()) / month1) * esi_leave_day);
                        var oh = parseFloat($("#oh").val()) - ((parseFloat($("#oh").val()) / month1) * esi_leave_day);
                        var oam = parseFloat($("#oam").val()) - ((parseFloat($("#oam").val()) / month1) * esi_leave_day);
                        
                        $("#abasic").val(Math.round(abasic));
                        $("#ada").val(Math.round(ada));
                        $("#con").val(Math.round(con));
                        $("#ma").val(Math.round(ma));
                        $("#oa").val(Math.round(oa));
                        $("#oh").val(Math.round(oh));
                        $("#oam").val(Math.round(oam));
                    }
                    
                    // ABSENT CALCULATION and D.A. Calculation
                    if($("#abs").val() > 0){
                        var absent_leave_day = parseInt($('#abs').val());
                        var abasic1 = parseFloat($("#abasic").val()) - ((parseFloat($("#abasic").val()) / month1) * absent_leave_day);
                        var ada1 = parseFloat($("#ada").val()) - ((parseFloat($("#ada").val()) / month1) * absent_leave_day);
                        var con1 = parseFloat($("#con").val()) - ((parseFloat($("#con").val()) / month1) * absent_leave_day);
                        var ma1 = parseFloat($("#ma").val()) - ((parseFloat($("#ma").val()) / month1) * absent_leave_day);
                        var oa1 = parseFloat($("#oa").val()) - ((parseFloat($("#oa").val()) / month1) * absent_leave_day);
                        var oh1 = parseFloat($("#oh").val()) - ((parseFloat($("#oh").val()) / month1) * absent_leave_day);
                        var oam1 = parseFloat($("#oam").val()) - ((parseFloat($("#oam").val()) / month1) * absent_leave_day);
                        
                        $("#abasic").val(Math.round(abasic1));
                        $("#ada").val(Math.round(ada1));
                        $("#con").val(Math.round(con1));
                        $("#ma").val(Math.round(ma1));
                        $("#oa").val(Math.round(oa1));
                        $("#oh").val(Math.round(oh1));
                        $("#oam").val(Math.round(oam1));
                    }
                    
                    $val = parseInt($("#hol").val()) + parseInt($("#cl").val()) + parseInt($("#el").val()) + parseInt($("#esil").val()) + parseInt($("#abs").val());
                    $actual_d_w = parseInt($("#wd").val()) - parseInt($("#hol").val()) - parseInt($("#cl").val()) - parseInt($("#el").val()) - parseInt($("#esil").val()) - parseInt($("#abs").val());
                    $("#td").val($val);
                    $("#adw").val($actual_d_w);
                    
                    // HRA calc
                    
                    var ahra = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val())) * (parseFloat($("#ahra_perctg").val())/100); // 15% is static here should come from db
                    $("#ahra").val(Math.round(ahra));
                    
                    // PF ded. calc
                    if(($("#pfamnt").val() == 0) || ($("#pfamnt").val() == '')) {
                    if(($("#pfper").val()) > 0) {
                        var actual_pf_amnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + parseFloat($("#oa").val()) + parseFloat($("#con").val()) + parseFloat($("#oh").val()) + parseFloat($("#ma").val()) + parseFloat($("#oam").val()) );
                        if(actual_pf_amnt <= 15000) {
                        var pfamnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + parseFloat($("#oa").val()) + parseFloat($("#con").val()) + parseFloat($("#oh").val()) + parseFloat($("#ma").val()) + parseFloat($("#oam").val()) ) * (parseFloat($("#pfper").val())/100);
                        } else {
                        var pfamnt = (15000 * (parseFloat($("#pfper").val())/100));    
                        }
                            } else {
                               var pfamnt = 0;  
                            }
                    } else {
                       var pfamnt = $("#pfamnt").val();  
                    }
                    $("#pfamnt").val(Math.round(pfamnt));
                    
                    // ESI ded calc
                    
                    var esiamnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + + parseFloat($("#con").val()) + + parseFloat($("#ahra").val()) + + parseFloat($("#ma").val()) + + parseFloat($("#oa").val()) + + parseFloat($("#oh").val()) + + parseFloat($("#oam").val()) ) * (parseFloat($("#esiper").val())/100); 
                    $("#esiamnt").val(Math.round(esiamnt));
                    
                    // gross salary and ded and net
                    var gross = +$("#abasic").val() + +$("#ada").val() + +$("#ahra").val() + +$("#con").val() + +$("#ma").val() + +$("#oa").val() + +$("#oh").val() + +$("#oam").val();
                    $("#gross").val(Math.round(gross));  
                    // alert(gross);
                    
                    $tax_amount = 0;
                    if(gross <= 10000) {
    $tax_amount = 0;
} else if(gross > 10000 && gross <= 15000) {
    $tax_amount = 110;
} else if(gross > 15000 && gross <= 25000) {
    $tax_amount = 130;
} else if(gross > 25000 && gross <= 40000) {
    $tax_amount = 150;
} else {
    $tax_amount = 200;
}
$('#ptax').val(Math.round($tax_amount));

var ded = +$("#pfamnt").val() + +$("#esiamnt").val() + +$("#ptax").val() + +$("#insur").val() + +$("#loan_adj").val();
                    var net = gross - ded;
                    
                    $("#ded").val(Math.round(ded));
                    $("#net").val(Math.round(net));
                    
                    
                });
               
                $("#adw, #hol, #esiper, #pfper, #esiper, #abasic, #ada, #ahra, #con, #ma, #oa, #oh, #oam, #ptax, #insur, #adad, #loan_adj, #ahra_perctg").blur(function(){
                    
                    $val = parseInt($("#hol").val()) + parseInt($("#cl").val()) + parseInt($("#el").val()) + parseInt($("#esil").val()) + parseInt($("#abs").val());
                    $actual_d_w = parseInt($("#wd").val()) - parseInt($("#hol").val()) - parseInt($("#cl").val()) - parseInt($("#el").val()) - parseInt($("#esil").val()) - parseInt($("#abs").val());
                    $("#td").val($val);
                    $("#adw").val($actual_d_w);
                    
                    // HRA calc
                    var ahra = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val())) * (parseFloat($("#ahra_perctg").val())/100); // 15% is static here should come from db
                    $("#ahra").val(Math.round(ahra));
                    
                    // PF ded. calc
                    if(($("#pfamnt").val() == 0) || ($("#pfamnt").val() == '')) {
                    if(($("#pfper").val()) > 0) {
                        var actual_pf_amnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + parseFloat($("#oa").val()) + parseFloat($("#con").val()) + parseFloat($("#oh").val()) + parseFloat($("#ma").val()) + parseFloat($("#oam").val()) );
                        if(actual_pf_amnt <= 15000) {
                        var pfamnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + parseFloat($("#oa").val()) + parseFloat($("#con").val()) + parseFloat($("#oh").val()) + parseFloat($("#ma").val()) + parseFloat($("#oam").val()) ) * (parseFloat($("#pfper").val())/100);
                        } else {
                        var pfamnt = (15000 * (parseFloat($("#pfper").val())/100));    
                        }
                            } else {
                               var pfamnt = 0;  
                            }
                    } else {
                      var pfamnt = $("#pfamnt").val();   
                    }
                    $("#pfamnt").val(Math.round(pfamnt));
                    
                    // ESI ded calc
                    
                    var esiamnt = (parseFloat($("#abasic").val()) + parseFloat($("#ada").val()) + + parseFloat($("#con").val()) + + parseFloat($("#ahra").val()) + + parseFloat($("#ma").val()) + + parseFloat($("#oa").val()) + + parseFloat($("#oh").val()) + + parseFloat($("#oam").val()) ) * (parseFloat($("#esiper").val())/100); 
                    $("#esiamnt").val(Math.round(esiamnt));
                    
                    // gross salary and ded and net
                    var gross = +$("#abasic").val() + +$("#ada").val() + +$("#ahra").val() + +$("#con").val() + +$("#ma").val() + +$("#oa").val() + +$("#oh").val() + +$("#oam").val();
                    $("#gross").val(Math.round(gross));  
                    // alert(gross);
                    
                    $tax_amount = 0;
                    if(gross <= 10000) {
    $tax_amount = 0;
} else if(gross > 10000 && gross <= 15000) {
    $tax_amount = 110;
} else if(gross > 15000 && gross <= 25000) {
    $tax_amount = 130;
} else if(gross > 25000 && gross <= 40000) {
    $tax_amount = 150;
} else {
    $tax_amount = 200;
}
$('#ptax').val(Math.round($tax_amount));

var ded = +$("#pfamnt").val() + +$("#esiamnt").val() + +$("#ptax").val() + +$("#insur").val() + +$("#loan_adj").val();
                    var net = gross - ded;
                    
                    $("#ded").val(Math.round(ded));
                    $("#net").val(Math.round(net));
                    
                    
                });
                
                $("#pfamnt, #esiamnt").blur(function(){

var gross = $("#gross").val();                    
var ded = +$("#pfamnt").val() + +$("#esiamnt").val() + +$("#ptax").val() + +$("#insur").val() + +$("#loan_adj").val();
                    var net = gross - ded;
                    
                    $("#ded").val(Math.round(ded));
                    $("#net").val(Math.round(net));
                    
                    
                });

               $("#ded").on('blur', function(){
                //   alert();
                    $g = $("#gross").val();
                    $d = $("#ded").val();
                    $res = +$g - +$d;
                    $("#net").val(Math.round($res));
               });
                    
                });
            </script>
            <script>
        $(document).on('keyup keypress', 'input[type="text"]', function(e) {
          if(e.which == 13) {
          e.preventDefault();
          return false;
          }
        });
        $(document).on('keyup keypress', 'input[type="number"]', function(e) {
          if(e.which == 13) {
          e.preventDefault();
          return false;
          }
        });
      </script>

</body>
</html>