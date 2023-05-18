<?PHP
// echo '<pre>', print_r($fetch_all_proforma_dtl), '</pre>';

$orda[] = array();
$ord_last = '';
foreach($proforma_details as $fd){
    if(!in_array($fd->buyer_reference_no, $orda)){
        array_push($orda, $fd->buyer_reference_no);
        $ord_last .= $fd->buyer_reference_no . ', ';
    }
}?>
<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 * Last updated on 29-mar-2021 at 05:36 pm
 */
 ?>
<?php
#echo '<pre>',print_r($costing), '</pre>';
#echo '<pre>',print_r($charges), '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Office Proforma Print | <?=WEBSITE_NAME;?></title>

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
            .height_82{ height: 82px }

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
    <body class="A4" id="page-content" >
        <?php
        $page_no = 1;
        ?>
        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <?php $page_no = 1;?>
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    
                    






<div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Proforma Invoice</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Exporter</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">51,MAHANIRBAN ROAD,KOLKATA-700 029,INDIA</p>
                            <p class="mar_0">TEL:+91-33-40031411,40031412</p>
                            <p class="mar_0">FAX:+91-33-40012865</p>
                            <p class="mar_0">Email : anurupa.sengupta@shilpaoverseas.com</p>
                            <p class="mar_0">CIN-U19116WB1992PTC055524</p>
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Proforma No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $proforma->proforma_number ?></strong></h6>
                                        <h6 class="mar_0"><strong><?= date('d-m-Y', strtotime($proforma->proforma_date)) ?></strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Export Ref.</p>
                                        <p class="mar_0">GSTIN: 19AAECS6338L1ZT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <small class="mar_0">Buyer Order No.: </small>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;">
                                            <?= $ord_last ?>
                                            <?php
                                            // foreach ($arr_order_no as $order_no) {
                                            //     echo $order_no;
                                            //     if ($order_no != end($arr_order_no)) {
                                            //         echo ', ';
                                            //     }
                                            // }
                                            ?>
                                        </strong>
                                    </small>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Other Reference(s) : <strong>PAN : AAECS6338L</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row height_90 mar_bot_3">
                        <div class="col-sm-6 border_all height_90">
                            <p class="mar_0"><strong>Consignee</strong></p>
                            <h4 class=""><strong><?= isset($proforma_details[0]->acc_name) ? $proforma_details[0]->acc_name : '' ?></strong></h4>
                            <article style="font-size:12px;line-height:1"><?= $proforma_details[0]->acc_address . ',' . $proforma_details[0]->country_name ?></article>
                            <p class="mar_0" style="font-size:12px"></p>
                        </div>
                        <div class="col-sm-6">

                            <div class="row height_23">
                                <div class="col-sm-6 border_all height_23">
                                    <div class="">
                                        <small><strong>Country of Origin of Goods</strong></small>
                                    </div>
                                </div>
                                <div class="col-sm-6 height_23 border_all">
                                    <div class="">
                                        <p class=""> West Bengal / India </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row height_23 mar_bot_3">
                                <div class="col-sm-6 border_all height_23">
                                    <div class="">
                                        <small><strong>Country of final delivery</strong></small>
                                    </div>
                                </div>
                                <div class="col-sm-6 border_all height_23">
                                    <div class="">
                                        <p class="text-capitalize">
                                            <?= strtolower($proforma_details[0]->country_name) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row height_41 border_all">
                                <div class="col-sm-12">
                                    <p class="mar_0"><strong>Desc. of Goods.: </strong> <?= $proforma_details[0]->desc_of_goods ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mar_bot_3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5 border_all height_41">
                                    <p class="mar_0"><strong>Pre-Carriage By</strong></p>
                                    <h5 class="text-uppercase mar_0"><?= $proforma_details[0]->co_remarks ?></h5>
                                </div>
                                <div class="col-sm-7 height_41 border_all">
                                    <div class="">
                                        <small><strong>Place of Receipt by Pre-Carrier</strong></small>

                                    </div>
                                </div>
                                <div class="col-sm-6 border_all height_41">
                                    <div class="">
                                        <p class="mar_0"><strong>Vessel / Flight No.</strong></p>

                                    </div>
                                </div>
                                <div class="col-sm-6 height_41 border_all">
                                    <div class="">
                                        <p class="mar_0"><strong>Port of Loading</strong></p>
                                        <h5 class="text-uppercase mar_0">Kolkata</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 border_all height_82">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p><strong>Notify</strong></p>
                                    <h5 class="text-uppercase mar_0"><?= $proforma_details[0]->notify ?></h5>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mar_bot_3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5 border_all height_41">
                                    <p class="mar_0"><strong>Port of Discharge</strong></p>
                                    <!-- <h5 class="text-uppercase mar_0"><?= $fetch_all_proforma_dtl[0]->SA_Name ?></h5> -->
                                </div>
                                <div class="col-sm-7 height_41 border_all">
                                    <div class="">
                                        <p class="mar_0"><strong>Final Destination</strong></p>
                                        <h5 class="text-uppercase mar_0"> <?= $proforma_details[0]->country_name ?></h5>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-5 border_all height_100">
                                            <p class="mar_0"><strong>Mark & Container</strong></p>
                                            <!--<h5 class="text-uppercase mar_0">-->
                                            <!--    <?= nl2br($fetch_individual_invoice_details[0]->MARK_CONTAINER) ?>-->
                                            <!--</h5>-->
        
                                        </div>
                                        <div class="col-sm-7 height_100 border_all">
                                            <div class="">
                                                <p class="mar_0"><strong>No. & Kind of Pkgs</strong></p>
                                                <!--<h5 class="text-uppercase mar_0">-->
                                                <!--    <?= nl2br($fetch_individual_invoice_details[0]->NO_KIND_PCKG) ?>-->
                                                <!--</h5>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12 height_100 border_all" style="height: 141px">
                                    <p class="mar_0"><strong>Terms of Delivery & Payment</strong></p>
                                     <h6 class="mar_0"><?= nl2br($proforma_details[0]->terms_condition) ?></h6> 
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                    </div>













                    <!--table data-->
                    <div class="row table-responsive">
                        <h4 class="text-center border-bottom">Proforma Details</h4>
                        <table class="table table-bordered table-hover table2excel">
                            <thead>
                                                <tr>
                                                <th>Article Number</th>
                                                <th>Article Description</th>
                                                <th>Color</th>
                                                <th style='text-align:right'>Quantity</th>
                                                <th style='text-align:right'>Rate in <br /> <?= $proforma_details[0]->currency ?>/<br /> 
                                        <?php
                                          if($proforma_details[0]->rate_type == 1) {
                                            echo 'Ex. Works';
                                          }else if($proforma_details[0]->rate_type == 2) {
                                            echo 'CIF';
                                          }else if($proforma_details[0]->rate_type == 3) {
                                            echo 'FOB';
                                          }else {
                                            echo '';
                                          }
                                     ?>
                                                </th>
                                        <th style='text-align:right'>Amount in  <br /> <?= $proforma_details[0]->currency ?>/<br /> 
                                    <?php
                                          if($proforma_details[0]->rate_type == 1) {
                                            echo 'Ex. Works';
                                          }else if($proforma_details[0]->rate_type == 2) {
                                            echo 'CIF';
                                          }else if($proforma_details[0]->rate_type == 3) {
                                            echo 'FOB';
                                          }else {
                                            echo '';
                                          }
                                     ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="actual_table">
                                <?php 
                                $iter = 1; 
                                // item initialisation
                                $total_value = 0;
                                $total_quantity = 0;

                                $generate_iter = 23;

                                foreach($proforma_details as $cm) { 
                                    // <!-- Item wise total area -->
                                    if ($iter == 9 or $iter == 30 or $iter == 51 or $iter == 72 or $iter == 93 or $iter == 114 or $iter == 135 or $iter == 156  or $iter == 177 or $iter == 198 or $iter == 219 or $iter == 240 or $iter == 261 or $iter == 282 or $iter == 303 or $iter == 324 or $iter == 345 or $iter == 366 or $iter == 387 or $iter == 408 or $iter == 303 or $iter == 317 or $iter == 333 or $iter == 347 or $iter == 361 or $iter == 375 or $iter == 389 or $iter == 403 or $iter == 417 or $iter == 431 or $iter == 445 or $iter == 459 or $iter == 473 or $iter == 487 or $iter == 491 or $iter == 505 or $iter == 519 or $iter == 533 or $iter == 547 or $iter == 561 or $iter == 575 or $iter == 589 or $iter == 603 or $iter == 431 or $iter == 431 or $iter == 431 or $iter == 431 or $iter == 431 or $iter == 431 or $iter == 431 ) {
                            $page_no += 1;
                            ?>
                        </tbody>
                    </table>
                </div>



<div class="row">
                                <footer>
                                    <div class="col-sm-6 border_all height_135">
                                        <h6 class="mar_0 text-justify">
                                            <br /><br /><br /><br /><br /><br /><br /><br />
                                            -------------------------------------------------<br />
                                            (Please Sign & Seal and Return Over Fax)
                                        </h6>
                                    </div>
                                    <div class="col-sm-6 border_all height_135">
                                        <p class="mar_0">Signature & Date</p>
                                        <h6 class="mar_0 text-uppercase"><strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                                        <img src="<?= base_url() ?>assets/img/shilpa1.png" style="height:75px; " />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0">Authorised Signatory</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <p class="mar_0 text-right"><?= date('d-m-Y', strtotime($proforma->proforma_date)) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </div>



            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Office Proforma</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Exporter</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">51,MAHANIRBAN ROAD,KOLKATA-700 029,INDIA</p>
                            <p class="mar_0">TEL:+91-33-40031411,40031412</p>
                            <p class="mar_0">FAX:+91-33-40012865</p>
                            <p class="mar_0">Email : anurupa.sengupta@shilpaoverseas.com</p>
                            <p class="mar_0">CIN-U19116WB1992PTC055524</p>
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Proforma No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $proforma->proforma_number ?></strong></h6>
                                        <h6 class="mar_0"><strong><?= date('d-m-Y', strtotime($proforma->proforma_date)) ?></strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-6 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Export Ref.</p>
                                        <p class="mar_0">GSTIN: 19AAECS6338L1ZT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <small class="mar_0">Buyer Order No.: </small>
                                    <small class="mar_0">
                                        <strong style="font-size: 14px;">
                                            <?= $ord_last ?>
                                            <?php
                                            // foreach ($arr_order_no as $order_no) {
                                            //     echo $order_no;
                                            //     if ($order_no != end($arr_order_no)) {
                                            //         echo ', ';
                                            //     }
                                            // }
                                            ?>
                                        </strong>
                                    </small>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Other Reference(s) : <strong>PAN : AAECS6338L</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row table-responsive">
                        <table class="table table-bordered table-hover table2excel">
                            <thead>
                                <tr>
                                                <th>Article Number</th>
                                                <th>Article Description</th>
                                                <th>Color</th>
                                                <th style='text-align:right'>Quantity</th>
                                                <th style='text-align:right'>Rate in <br /> <?= $proforma_details[0]->currency ?>/<br /> 
                                            <?php
                                          if($proforma_details[0]->rate_type == 1) {
                                            echo 'Ex. Works';
                                          }else if($proforma_details[0]->rate_type == 2) {
                                            echo 'CIF';
                                          }else if($proforma_details[0]->rate_type == 3) {
                                            echo 'FOB';
                                          }else {
                                            echo '';
                                          }
                                     ?>
                                                </th>
                                        <th style='text-align:right'>Amount in  <br /> <?= $proforma_details[0]->currency ?>/<br /> 
                                        <?php
                                          if($proforma_details[0]->rate_type == 1) {
                                            echo 'Ex. Works';
                                          }else if($proforma_details[0]->rate_type == 2) {
                                            echo 'CIF';
                                          }else if($proforma_details[0]->rate_type == 3) {
                                            echo 'FOB';
                                          }else {
                                            echo '';
                                          }
                                     ?>
                                        </th>
                                </tr>
                            </thead>
                            <tbody class="actual_table">
                            <?php }
                            $iter++ ?>
                                    <tr>
                                        <td><?= $cm->art_no ?></td>
                                        <td><?= $cm->info ?></td>
                                        <td><?= $cm->leather_color ?></td>
                                        <td style='text-align:right'>
                                            <?php
                                         $total_quantity+=$cm->co_quantity;
                                         echo $cm->co_quantity; ?>
                                        </td>
                                        <td style='text-align:right'><?= $cm->rate_foreign ?></td>
                                        <td style='text-align:right'><?php
                                         $total_value+=$cm->total_rate;
                                         echo $cm->total_rate; ?></td>    
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" style="font-weight: bold; font-size: 12px;text-align:left; text-transform: uppercase"> <?= $proforma_details[0]->currency ?> <?=convertNumberToWord($total_value) . ' ONLY' ?></td>
                                    <td colspan="1"  style="font-weight: bold; font-size: 14px;text-align:right" class="text-right"><h5 class=""><b><?= $total_quantity ?></b></h5></td>
                                    <td colspan="1" style="font-weight: bold; font-size: 14px;text-align:right"><h5 class=""><b>Total <?= $proforma_details[0]->currency ?></b></h5></td>
                                    <td colspan="1" style="font-weight: bold; font-size: 14px; text-align: right"><h5 class=""><b><?= number_format((float)$total_value, 2, '.', '')  ?></b></h5></td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                    <footer>

                        <div class="col-sm-6 border_all height_135">
                            <div class="">
                                <h6 class="mar_0 text-justify">
                                    <br /><br /><br /><br /><br /><br /><br /><br />
                                    -------------------------------------------------<br />
                                    (Please Sign & Seal and Return Over Fax)
                                </h6>

                            </div>
                        </div>
                        <div class="col-sm-6 border_all height_135">

                            <p class="mar_0">Signature & Date</p>
                            <h6 class="mar_0 text-uppercase"><strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                            <img src="<?= base_url() ?>assets/img/shilpa1.png" style="height:75px; " />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0">Authorised Signatory</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <p class="mar_0 text-right"><?= date('d-m-Y', strtotime($proforma->proforma_date)) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
        </section>
        <?php

        function convertNumberToWord($number) {
            $hyphen = '-';
            $conjunction = ' and ';
            $separator = ', ';
            $negative = 'negative ';
            $decimal = ' point ';
            $dictionary = array(
                0 => 'zero',
                1 => 'one',
                2 => 'two',
                3 => 'three',
                4 => 'four',
                5 => 'five',
                6 => 'six',
                7 => 'seven',
                8 => 'eight',
                9 => 'nine',
                10 => 'ten',
                11 => 'eleven',
                12 => 'twelve',
                13 => 'thirteen',
                14 => 'fourteen',
                15 => 'fifteen',
                16 => 'sixteen',
                17 => 'seventeen',
                18 => 'eighteen',
                19 => 'nineteen',
                20 => 'twenty',
                30 => 'thirty',
                40 => 'fourty',
                50 => 'fifty',
                60 => 'sixty',
                70 => 'seventy',
                80 => 'eighty',
                90 => 'ninety',
                100 => 'hundred',
                1000 => 'thousand',
                100000 => 'lakh',
                10000000 => 'crore'
            );

            if (!is_numeric($number)) {
                return false;
            }

            if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                // overflow
                trigger_error(
                        'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
                );
                return false;
            }

            if ($number < 0) {
                return $negative . convertNumberToWord(abs($number));
            }

            $string = $fraction = null;

            if (strpos($number, '.') !== false) {
                list($number, $fraction) = explode('.', $number);
            }

            switch (true) {
                case $number < 21:
                    $string = $dictionary[$number];
                    break;
                case $number < 100:
                    $tens = ((int) ($number / 10)) * 10;
                    $units = $number % 10;
                    $string = $dictionary[$tens];
                    if ($units) {
                        $string .= $hyphen . $dictionary[$units];
                    }
                    break;
                case $number < 1000:
                    $hundreds = $number / 100;
                    $remainder = $number % 100;
                    $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                    if ($remainder) {
                        $string .= $conjunction . convertNumberToWord($remainder);
                    }
                    break;
                case $number < 100000:
                    $thousands = ((int) ($number / 1000));
                    $remainder = $number % 1000;

                    $thousands = convertNumberToWord($thousands);

                    $string .= $thousands . ' ' . $dictionary[1000];
                    if ($remainder) {
                        $string .= $separator . convertNumberToWord($remainder);
                    }
                    break;
                case $number < 10000000:
                    $lakhs = ((int) ($number / 100000));
                    $remainder = $number % 100000;

                    $lakhs = convertNumberToWord($lakhs);

                    $string = $lakhs . ' ' . $dictionary[100000];
                    if ($remainder) {
                        $string .= $separator . convertNumberToWord($remainder);
                    }
                    break;
                case $number < 1000000000:
                    $crores = ((int) ($number / 10000000));
                    $remainder = $number % 10000000;

                    $crores = convertNumberToWord($crores);

                    $string = $crores . ' ' . $dictionary[10000000];
                    if ($remainder) {
                        $string .= $separator . convertNumberToWord($remainder);
                    }
                    break;
                default:
                    $baseUnit = pow(1000, floor(log($number, 1000)));
                    $numBaseUnits = (int) ($number / $baseUnit);
                    $remainder = $number % $baseUnit;
                    $string = convertNumberToWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                    if ($remainder) {
                        $string .= $remainder < 100 ? $conjunction : $separator;
                        $string .= convertNumberToWord($remainder);
                    }
                    break;
            }

            if (null !== $fraction && is_numeric($fraction)) {
                $string .= $decimal;
                $words = array();
                foreach (str_split((string) $fraction) as $number) {
                    $words[] = $dictionary[$number];
                }
                $string .= implode(' ', $words);
            }

            return ucfirst($string);
        }
        ?>
    </body>
</html>
