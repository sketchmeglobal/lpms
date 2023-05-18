<?PHP
//echo '<pre>', print_r($consumption_val), '</pre>'; nz/054
//echo '<pre>', print_r($fetch_all_jobber_details), '</pre>';
//die;
$tot_qnty_q = 0;
foreach ($sample_issue_details_list as $fa) {
    $tot_qnty_q += $fa->challan_quantity;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> Sample Issue Challan Print | <?=WEBSITE_NAME;?></title>

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
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <?php if(count($sample_issue_details_list) > 0) { ?>
    <body class="A4" id="page-content">
        <?php
        $page_no = 1;
        ?>
        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you  can set 10, 15, 20 or 25 style="height: 10000px" -->
        <section class="sheet padding-10mm" style="height: auto">
            <div>
                <header class="pull-right">
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Sample Issue Challan</h3>
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
                                <div class="col-sm-5 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Challan No. & Date</p>
                                        <h4 class="mar_0"><strong><?= $sample_issue_details[0]->sample_challan_number ?></strong></h4>
                                        <h6 class="mar_0"><strong>(<?= $sample_issue_details[0]->sample_issue_date ?>)</strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-7 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Issued To: <b><?= $sample_issue_details[0]->acc_master_name . ' ' ?></b></p>
                                        <p class="mar_0">
                                             (<?= $sample_issue_details[0]->address ?>)
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
                                        <th>Article</th>
                                        <th>Leather Colr.</th>
                                        <th>Fitting Colr.</th>
                                        <th style="text-align: right;">Challan Qnty.</th>
                                        <th>Sample Emboss</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    foreach ($sample_issue_details_list as $ppl) {
                                        if ($iter == 18 or $iter == 36 or $iter == 54 or $iter == 72 or $iter == 90 or $iter == 108 or $iter == 49 or $iter == 56 or $iter == 63 or $iter == 70 or $iter == 77 or $iter == 84 or $iter == 91 or $iter == 98 or $iter == 105 or $iter == 112 or $iter == 119 or $iter == 126 or $iter == 133 or $iter == 140 or $iter == 147 or $iter == 154 or $iter == 161 or $iter == 168 or $iter == 175 or $iter == 182 or $iter == 189 or $iter == 196 or $iter == 203 or $iter == 210 or $iter == 217 or $iter == 224 or $iter == 231 or $iter == 238 or $iter == 245 or $iter == 252 or $iter == 259 or $iter == 266 or $iter == 273 or $iter == 280 or $iter == 287 or $iter == 294 or $iter == 301 or $iter == 308 or $iter == 315 or $iter == 322 or $iter == 329 or $iter == 336 or $iter == 343 or $iter == 350 or $iter == 357 or $iter == 364 or $iter == 371 or $iter == 378 or $iter == 385 or $iter == 392 or $iter == 399) {
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
                                        <h6 class="mar_0 text-uppercase"><strong>For, <?= $sample_issue_details[0]->acc_master_name ?></strong></h6>
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
                        <h3 class="mar_0 head_font">Sample Issue Challan</h3>
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
                                <div class="col-sm-5 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Challan No. & Date</p>
                                        <h4 class="mar_0"><strong><?= $sample_issue_details[0]->sample_challan_number ?></strong></h4>
                                        <h6 class="mar_0"><strong>(<?= $sample_issue_details[0]->sample_issue_date ?>)</strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-7 border_all height_80">
                                    <div class="">
                                        <p class="mar_0">Issued To: <b><?= $sample_issue_details[0]->acc_master_name . ' ' ?></b></p>
                                        <p class="mar_0">
                                             (<?= $sample_issue_details[0]->address ?>)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                           
                            <div class="row table-responsive">
                                <table class="table table-bordered table-hover table2excel">
                                    <thead>
                                        <tr>
                                        <th>Article</th>
                                        <th>Leather Colr.</th>
                                        <th>Fitting Colr.</th>
                                        <th style="text-align: right;">Challan Qnty.</th>
                                        <th>Sample Emboss</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td nowrap><?= $ppl->art_no ?></td>
                                        <td><?= $ppl->leather_color ?></td>
                                        <td><?= $ppl->fitting_color ?></td>
                                        <td style="text-align: right;"><?= $ppl->challan_quantity ?></td>
                                        <td><?= $ppl->sample_emboss ?></td>
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
                                // for ($i = 1; $i < $add_td; $i++) {
                                    ?>
                                    <!--<tr>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->
                                    <!--    <td>&nbsp;</td>-->

                                    <!--</tr>-->
                                    <?php
                                // }
                                ?>
                                <tr>
                                    <td colspan="3"><b>Total</b></td>
                                    <!--<td class="text-right"><?= number_format((float) $tot_qnty_q, 2, '.', '') ?></td>-->
                                    <td style="text-align: right;"><?= $tot_qnty_q ?></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                        
                        <table id="consumption_table" class="table table-hover table-striped table-responsive" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Group</th>
                                    <th style="display: none">Item Code</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>lth colour</th>
                                    <th>fit colour</th>
                                </tr>
                            </thead>
                            <tbody class="cons_body">
                                <?php
                                $groups = array();
                                foreach ($result as $f) {
                                    $key = $f->item_name;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'item_name' => $f->item_name,
                                            'item_color' => $f->item_color,
                                            'final_qnty' => $f->final_qnty,
                                        );
                                    } else {
                                        $groups[$key]['item_name'] = $f->item_name;
                                        $groups[$key]['item_color'] = $f->item_color;
                                        $groups[$key]['final_qnty'] += $f->final_qnty;
                                    }
                                }
                                foreach ($result as $curr_key=>$con) {
                                    $keys = array();
                                    foreach($result as $key=>$val) {
                                        if ($val->item_name == $con->item_name) {
                                            array_push($keys, $key);
                                        }
                                    }
                                            ?>
                                            <tr>
                                                <td><?= $con->group_name ?></td>
                                                <td style="display: none"><?= $con->item_code ?></td>
                                                <td><?= $con->item_name ?>[<?= $con->item_code ?>]</td>
                                                <td><?= $con->final_qnty ?></td>
                                                <td><?= $con->unit ?></td>
                                                <td><?= $con->lth_color ?></td>
                                                <td><?= $con->fit_color ?></td>   
                                            </tr>
                                            <?php
                                    if($con->show_total_in_consumption == 1) {
                                    if(end($keys) == $curr_key) {
                                        ?>
                                        <tr>
                                            <th colspan="2">Total for <?=$groups[$con->item_name]['item_name']?>[<?= $con->item_color ?>][<?= $con->item_code ?>]</th>
                                            <th><?= number_format( $groups[$con->item_name]['final_qnty'], 2)?></th>
                                        </tr>
                                        <?php
                                    }
                                    }
                                ?>
                                            <?php
                                 }
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
                            <h6 class="mar_0 text-uppercase"><strong>For, <?= $sample_issue_details[0]->acc_master_name ?></strong></h6>
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
