
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>SALARY PRINT</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Normalize or reset CSS with your favorite library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

        <!-- Load paper.css for happy printing -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
        <!-- Set page size here: A5, A4 or A3 -->
        <!-- Set also "landscape" if you need -->
        <style>
            body{
                /*font-family: 'Chivo', sans-serif;*/
                font-family: Calibri;
            }
            p {
                margin: 0 0 5px;
            }
            table{ border: 1px solid #777; }
            .table{
                margin-bottom: 3px;
            }
            .head_font{
                /*font-family: 'Signika', sans-serif;*/
                font-family: Calibri;
            }
            .container{width: 100%}
            .border_all{
                border: 1px solid #000;
            }
            .text-left{
                text-align: left!important;
            }
            .text-right{
                text-align: right!important;
            }
            .pad_0{padding: 0;}
            .display_inline{ display: inline}
            .mar_0{
                margin: 0
            }
            .mar_bot_3{
                margin-bottom: 3px
            }

            .header_left, .header_right{
                height: 150px
            }

            .width-100{width: 100%}

            .height_60{ height: 60px }
            .height_42{ height: 42px }
            .height_135{height: 135px}
            .height_90{height: 90px}
            .height_41{ height: 41px }
            .height_23{ height: 23px }
            .height_63{ height: 63px }
            .height_21{ height: 21px }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: center; font-size: 13px}


            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: center; font-size: 13px}
                .col-sm-3 {width: 25%!important;}.col-sm-4 {width: 33.33333333%!important;}.col-sm-5 { width: 41.66666667%!important;float:left; }.col-sm-6{ width: 50%!important;float:left; }.col-sm-7 { width: 58.33333333%!important;float:left; }.col-sm-8 {width: 66.66666667%!important;float:left;}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content">
        <section class="sheet padding-10mm">
            <div class="container" style="width:100%!important">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">SHILPA OVERSEAS PVT. LTD.</h3>
                    </div>
                    <div class="row border_all text-center">
                        <h4 class="mar_0">Salary Pay Slip for the Month of <?= $fetch_all_sal_details[0]->MON ?> of 2019-2020</h3>
                    </div>
                    <div class="row border_all">
                        <div class="col-sm-3"><b>Employee Code: </b> <?= $fetch_all_sal_details[0]->e_code ?></div>
                        <div class="col-sm-6"><b>Employee Name:</b> <i> <h4 class="mar_0 display_inline pad_0"><strong><?= $fetch_all_sal_details[0]->name ?></strong></h4></i> </div>
                        <div class="col-sm-3"><b>Department:</b> <?= $fetch_all_sal_details[0]->working_place ?> </div>
                    </div>
                    <div class="row border_all">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-5">
                                    <strong>Father's/Husband's Name: </strong>
                                </div>
                                <div class="col-sm-7"><?= $fetch_all_sal_details[0]->name ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <strong>Employee Address: </strong>
                                </div>
                                <div class="col-sm-7"><?= $fetch_all_sal_details[0]->address ?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
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
                                <img style="height:100px;border:1px solid #999; float: right;margin-right:10px" src="<?= base_url() . $emp_img ?>" class="img-responsive emp_img" src="" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="row border_all">
                        <div class="col-sm-3"><b>No. of Working Days: </b> <?= $fetch_all_sal_details[0]->T1 ?></div>
                        <div class="col-sm-3"><b>No. of Days Worked: </b> <?= $fetch_all_sal_details[0]->T2 ?> </div>
                        <div class="col-sm-3"><b>No. of Holidays: </b> <?= $fetch_all_sal_details[0]->T3 ?> </div>
                        <div class="col-sm-3"><b>No. of Leave Days: </b> <?= ($fetch_all_sal_details[0]->T4 + $fetch_all_sal_details[0]->T5 + $fetch_all_sal_details[0]->T6) ?> </div>
                    </div>
                    <div class="row border_all">
                        <div class="col-sm-4"><b>No. of E.S.I. Leave: </b> <?= $fetch_all_sal_details[0]->T6 ?></div>
                        <div class="col-sm-4"><b>No. of Days Absent: </b> <?= $fetch_all_sal_details[0]->T7 ?> </div>
                        <div class="col-sm-4"><b>Total Ab4 </div>
                    </div>
                    <div class="row border_all mar_bot_3">
                        <div class="col-sm-4">
                            <h4><u>Earnings</u></h4>
                            <div class="row">
                                <div class="col-sm-6"><b>Basic Pay: </b></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->basic_pay), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><b>D.A.: </b></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->da_amout), 2) ?></div>
                            </div>    
                            <div class="row">
                                <div class="col-sm-6"><b>Houe Rent: </b></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->hra_amount), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><b>Conveyance: </b></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->convenience), 2) ?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h4><u>Actual Earnings</u></h4>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->BASIC), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->DA), 2) ?></div>
                            </div>    
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->HRA), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6"><?= number_format(round($fetch_all_sal_details[0]->CONV), 2) ?></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h4><u>Deductions</u></h4>
                            <div class="row">
                                <div class="col-sm-8"><b>Providend Fund: </b></div>
                                <div class="col-sm-4"><?= number_format(round($fetch_all_sal_details[0]->PFAMT), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8"><b>Professional Tax: </b></div>
                                <div class="col-sm-4"><?= number_format(round($fetch_all_sal_details[0]->TAX), 2) ?></div>
                            </div>    
                            <div class="row">
                                <div class="col-sm-8"><b>E.S.I.: </b></div>
                                <div class="col-sm-4"><?= number_format(round($fetch_all_sal_details[0]->ESIAMT), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8"><b>L.I.C.: </b></div>
                                <div class="col-sm-4"><?= number_format(round($fetch_all_sal_details[0]->INS), 2) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8"><b>Loans & Advance: </b></div>
                                <div class="col-sm-4"><?= number_format(round($fetch_all_sal_details[0]->LOAN), 2) ?></div>
                            </div>
                        </div>                       
                    </div>
                    <div class="row border_all mar_bot_3">
                        <div class="col-sm-4"><b>Gross Salary: </b> <?= number_format(round($fetch_all_sal_details[0]->GROSS), 2) ?></div>
                        <div class="col-sm-4"><b>Net Salary Payable: </b> <?= number_format(round($fetch_all_sal_details[0]->DEDUC), 2) ?> </div>
                        <div class="col-sm-4"><b>Gross Deduction: </b> <?= number_format(round($fetch_all_sal_details[0]->NET), 2)  ?> </div>
                    </div>
            </div>        
        </section>
    </body>
</html>
