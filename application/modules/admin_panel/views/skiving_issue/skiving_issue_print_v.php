<!--<h1>DEVELOPMENT GOING ON</h1>-->
<?PHP

// print_r($page_setup);
if(count($page_setup) > 0) {
$front_page = $page_setup[0]->front_page;
$other_page = $page_setup[0]->other_page;
$blank_row = $page_setup[0]->blank_row;
} else {
$front_page = 8;
$other_page = 12;
$blank_row = 6;    
}

//echo '<pre>', print_r($consumption_val), '</pre>'; nz/054
//echo '<pre>', print_r($fetch_all_jobber_details), '</pre>';
//die;
$tot_qnty_q = 0;
foreach ($skiving_issue_details_list as $fa) {
    $tot_qnty_q += $fa->receive_cut_quantity;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> Skiving Issue Challan Print | <?=WEBSITE_NAME;?></title>

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
            .mar_0{
                margin: 0
            }
            .mar_bot_3{
                margin-bottom: 3px
            }

            .header_left, .header_right{
                height: 170px;
            }

            .width-100{width: 100%}

            .height_60{ height: 60px }
            .height_42{ height: 42px }
            .height_135{height: 150px}
            .height_90{height: 90px}
            .height_100{height: 100px}
            .height_41{ height: 41px }
            .height_23{ height: 23px }
            .height_63{ height: 63px }
            .height_21{ height: 21px }
            .height_82{ height: 82px }
            .height_80{ height: 80px }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

            .border-bottom{border-bottom:  1px solid #000}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000}
                .no-print{display:none;}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <?php if(count($skiving_issue_details_list) > 0) { ?>
    <body class="A4" id="page-content">
        <?php
        $page_no = 1;
        ?>
        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you  can set 10, 15, 20 or 25 style="height: 10000px" -->
        
        <form method="post" class="no-print" style="width: 200px;background:#f5f5f5;padding:10px;position:absolute;right:0;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <label>First page rows: <input required type="number" min="5" max="25" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" max="25" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <label>Blank rows: <input required type="number" min="0" max="25" name="blank_row" class="form-control" value="<?=$blank_row?>"/></label>
            <input type="hidden" name="module_id" value="3"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
            <input type="submit" name="page_setup_submit" class="btn btn-warning btn-sm"/>
        </form>            
        
        <section class="sheet padding-10mm">
            <div>
                <header class="pull-right">
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Skiving Issue Challan</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Exporter</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR,KOLKATA - 700 136</p>
                            <p class="mar_0">TEL:+91-33-25733470/71/72</p>
                            <p class="mar_0">EMAIL:info@shilpaoverseas.com</p>
                            <!--<p class="mar_0">Email : anurupa.sengupta@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Challan No. & Date</p>
                                        <h4 class="mar_0"><strong><?= $skiving_issue_header[0]->skiving_issue_number ?></strong></h4>
                                        <h6 class="mar_0"><strong>(<?= $skiving_issue_header[0]->skiving_issue_date ?>)</strong></h6>
                                    </div>
                                </div>
                                </div>
                                <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Issued To: <b>Self</b></p> 
                                        <!--< ?= $skiving_issue_header[0]->acc_master_name . ' ' ?>-->
                                        <p class="mar_0">
                                             <b>(SKIVING DEPARTMENT)</b>
                                             <!--< ?= $skiving_issue_header[0]->address ?>-->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--table data-->
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover width-100 table2excel" >
                                <thead>
                                    <tr>
                                        <th nowrap>Customer Order</th>
                                        <th nowrap>Buyer Ref. No.</th>
                                        <th nowrap>Cutting Challan No.</th>
                                        <th nowrap>Art. No.</th>
                                        <th nowrap>Leather Clr.</th>
                                        <th nowrap>Fitting Clr.</th>
                                        <th nowrap style="text-align: right;">Skv. Isu. Qnty.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    $count_iter = $front_page;
                                    foreach ($skiving_issue_details_list as $ppl) {
                                        if ($iter == $front_page or $iter == $count_iter) {
                                            $count_iter += $other_page;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <footer>
                                    <div class="col-sm-6 border_all height_135">
                                        <p class="mar_0">Signature & Date</p>
                                        <h6 class="mar_0 text-uppercase"><strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                                        <br />
                                        <br/>
                                        <br/>
                                        <br/>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0">Authorised Signatory</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0 text-right"><?= date('d-m-Y') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border_all height_135">
                                        <p class="mar_0">Signature & Date</p>
                                        <h6 class="mar_0 text-uppercase"><strong>FOR, SKIVING DEPARTMENT</strong></h6>
                                        <!--< ?= $skiving_issue_header[0]->acc_master_name ?>-->
                                        <br />
                                        <br/>
                                        <br/>
                                        <br/>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0">Receiver's Signature</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0 text-right"><?= date('d-m-Y') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sheet padding-10mm">
                    <header class="pull-right">
                        <small>Page No. <?= ++$page_no ?></small>
                    </header>
                    <div class="clearfix"></div>
                    <div class="container">
                        <div class="">
                            <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Skiving Issue Challan</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Exporter</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR,KOLKATA - 700 136</p>
                            <p class="mar_0">TEL:+91-33-25733470/71/72</p>
                            <p class="mar_0">EMAIL:info@shilpaoverseas.com</p>
                            <!--<p class="mar_0">Email : anurupa.sengupta@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Challan No. & Date</p>
                                        <h4 class="mar_0"><strong><?= $skiving_issue_header[0]->skiving_issue_number ?></strong></h4>
                                        <h6 class="mar_0"><strong>(<?= $skiving_issue_header[0]->skiving_issue_date ?>)</strong></h6>
                                    </div>
                                </div>
                                </div>
                                <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Issued To: <b>SELF</b></p>
                                        <p class="mar_0">
                                             <b>(SKIVING DEPARTMENT)</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                           
                            <div class="row table-responsive">
                                <table class="table table-bordered table-hover width-100 table2excel" >
                                <thead>
                                    <tr>
                                        <th nowrap>Customer Order</th>
                                        <th nowrap>Buyer Ref. No.</th>
                                        <th nowrap>Cutting Challan No.</th>
                                        <th nowrap>Art. No.</th>
                                        <th nowrap>Leather Clr.</th>
                                        <th nowrap>Fitting Clr.</th>
                                        <th nowrap style="text-align: right;">Skv. Isu. Qnty.</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td nowrap><?= $ppl->co_no ?></td>
                                        <td><?= $ppl->buyer_reference_no ?></td>
                                        <td ><?= $ppl->cut_number ?></td>
                                        <td><?= $ppl->art_no ?></td>
                                        <td><?= $ppl->leather_color ?></td>
                                        <td><?= $ppl->fitting_color ?></td>
                                        <td style="text-align: right;"><?= $ppl->receive_cut_quantity ?></td>
                                    </tr>

                                    <?php
                                    $last_iter = $iter;
                                    $last_page_no = $page_no;
                                    $iter++;
                                }
                                ?>
                                <?php
                                // if ($last_page_no == 1) {
                                //     $add_td = ($front_page - $last_iter);
                                // } else {
                                    // $temp_add = ($last_iter - $other_page) % $other_page;
                                    // if ($temp_add == 0) {
                                    //     $add_td = 0;
                                    // } else {
                                    //     $add_td = $other_page - $temp_add;
                                    // }
                                    
                                //     echo $last_iter; die;
                                    
                                // }
//                                echo $last_iter . ' => ' . $last_page_no;
//                                echo 'td to be added. =>' . $add_td;die;
                                 for ($i = 1; $i < $blank_row; $i++) {
                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
                                 }
                                ?>
                                <tr>
                                    <td colspan="6"><b>Total</b></td>
                                    <!--<td class="text-right"><?= number_format((float) $tot_qnty_q, 2, '.', '') ?></td>-->
                                    <td style="text-align: right;"><?= $tot_qnty_q ?></td>
                                </tr>

                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="row">
                    <footer>
                        <div class="col-sm-6 border_all height_135">
                            <p class="mar_0">Signature & Date</p>
                            <h6 class="mar_0 text-uppercase"><strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                            <br />
                            <br/>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0">Authorised Signatory</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0 text-right"><?= date('d-m-Y') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 border_all height_135">
                            <p class="mar_0">Signature & Date</p>
                            <h6 class="mar_0 text-uppercase"><strong>FOR, SKIVING DEPARTMENT</strong></h6>
                            <!--< ?= $skiving_issue_header[0]->acc_master_name ?>-->
                            <br />
                            <br/>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0">Receiver's Signature</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0 text-right"><?= date('d-m-Y') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </section>
        <!--<section class="sheet padding-10mm">-->
            
        <!--</section>-->
    </body>
<?php } ?>
</html>
