<?PHP
//echo '<pre>', print_r($consumption_val), '</pre>'; nz/054
//echo '<pre>', print_r($fetch_all_cutting_details), '</pre>';
//die;
$tot_qnty_q = 0;
foreach ($cutting_issue_details as $fa) {
    $tot_qnty_q += $fa->co_quantity;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Cutting Issue Challan</title>

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
            .pad_0{
                padding: 0
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
            .height_135{height: 150px}
            .height_90{height: 90px}
            .height_100{height: 100px}
            .height_41{ height: 41px }
            .height_23{ height: 23px }
            .height_63{ height: 63px }
            .height_21{ height: 21px }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

            .border-bottom{border-bottom:  1px solid #000}
            
            .text-right{text-align: right!important;}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000}
                .pad_0{padding: 0}
                .text-right{text-align: right!important;}
                table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
            }
            
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content">
        <?php
        $page_no = 1;
        ?>
        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm" style="height:auto;padding-top:5px">
            <div>
                <header class="pull-right">
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Cutting Issue Challan</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Exporter</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR</p>
                            <p class="mar_0">KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <p class="mar_0">EMAIL : info@shilpaoverseas.com</p>
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Challan No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $cutting_issue_details[0]->cut_number ?></strong></h5>
                                        <h6 class="mar_0"><strong>(<?= $cutting_issue_details[0]->cut_date ?>)</strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Issued To:</p>
                                        <p class="mar_0"><?= $cutting_issue_details[0]->acc_name ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <small class="mar_0">Remarks: </small>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;"><?= $cutting_issue_details[0]->cut_remarks ?></strong>
                                    </small>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Expected Date : <strong><?= $cutting_issue_details[0]->cut_exp_del_dt ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 pad_0">
                            <div class="border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <h5 class="mar_0">Leather: </h5>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;"><?= $cutting_issue_details[0]->cut_leather ?></strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 pad_0">
                            <div class="border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <h5 class="mar_0">Lining: </h5>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;"><?= $cutting_issue_details[0]->cut_lining ?></strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 pad_0">
                            <div class="border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <h5 class="mar_0">Fittings: </h5>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;"><?= $cutting_issue_details[0]->cut_fittings ?></strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 pad_0">
                            <div class="border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <h5 class="mar_0">Emboss: </h5>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;"><?= $cutting_issue_details[0]->cut_emboss ?></strong>
                                    </small>
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
                                        <th>Order No.</th>
                                        <th>Article</th>
                                        <th>Colour</th>
                                        <th class="text-right">Qnty in Pcs.</th>
                                        <th class="text-right">Consump. <br/> in <br/> Article</th>
                                        <th class="text-right">Consump.</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    $tot_consump = 0;
                                    $tot_amount = 0;
                                    $tot_cut_quantity = 0;
                                    foreach ($cutting_issue_details as $ppl) {
                                       
                                    ?>
                                    <tr>
                                        <td><?= $ppl->co_no ?></td>
                                        <td><?= $ppl->art_no . '~' . $ppl->info ?></td>
                                        <td><?= $ppl->leather_color ?></td>
                                        <td class="text-right" style="font-size: 16px;"><?php echo round($ppl->cut_co_quantity,2);
                                        $tot_cut_quantity += $ppl->cut_co_quantity;
                                        ?></td>
                                        <td class="text-right" style="font-size: 14px;"><?php echo $ppl->quantity;
                                        $tot_consump += $ppl->quantity;
                                         ?></td>
                                        <td class="text-right" style="font-size: 14px;"><?php echo round(($ppl->quantity * $ppl->cut_co_quantity),2);
                                        $tot_amount +=($ppl->quantity * $ppl->cut_co_quantity);
                                         ?></td>
                                        <td><?= $ppl->co_remarks ?></td>
                                    </tr>

                                    <?php
                                    $last_iter = $iter;
                                    $last_page_no = $page_no;
                                    $iter++;
                                }
                                ?>
                                <?php
                                if ($last_page_no == 1) {
                                    $add_td = (10 - $last_iter);
                                } else {
                                    $temp_add = ($last_iter - 10) % 10;
                                    if ($temp_add == 0) {
                                        $add_td = 0;
                                    } else {
                                        $add_td = 10 - $temp_add;
                                    }
                                }
//                                echo $last_iter . ' => ' . $last_page_no;
//                                echo 'td to be added. =>' . $add_td;die;
                                for ($i = 1; $i < $add_td; $i++) {
                                    ?>
                                    <!--<tr>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--</tr>-->
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="3"><b>Total</b></td>
                                    <td class="text-right" style="font-size: 16px;"><b><?= $tot_cut_quantity ?></b></td>
                                    <td class="text-right"><b><?= $tot_consump ?></b></td>
                                    <td class="text-right"><b><?= $tot_amount ?></b></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                        
                        <?php
                        if(isset($result)) {
                            ?>
                        
                        <h4>Consumption Table</h4>
                        <table id="consumption_table" class="table table-hover table-striped table-responsive" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Colour</th>
                    </tr>
                </thead>
                <tbody class="cons_body">
                    <?php foreach ($result as $con) {
                                ?>
                                <tr>
                                    <td><?= $con->group_name ?></td>
                                    <td><?= $con->item_code ?></td>
                                    <td><?= $con->item_name ?></td>
                                    <td><?= $con->final_qnty ?></td>
                                    
                                    <td><?= $con->unit ?></td>
                                    <td><?= $con->color ?></td>   
                                </tr>
                                <?php
                    } ?>
                </tbody>
            </table>
            <?php
                        } 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <footer>
                        <div class="col-sm-6 border_all height_135">
                            <p class="mar_0">Signature & Date</p>
                            <h6 class="mar_0 text-uppercase"><strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                            <br />
                            <br />
                            <br />
                            <br />
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
                            <h6 class="mar_0 text-uppercase"><strong>For, <?= $cutting_issue_details[0]->acc_name ?></strong></h6>
                            <br />
                            <br />
                            <br />
                            <br />
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
       
        
    </body>
</html>
