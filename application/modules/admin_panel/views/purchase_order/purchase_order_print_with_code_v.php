<?php
// echo '<pre>', print_r($purchase_order_details), '</pre>';die;


if(count($page_setup) > 0) {
$front_page = $page_setup[0]->front_page;
$other_page = $page_setup[0]->other_page;
$blank_row = $page_setup[0]->blank_row;
} else {
$front_page = 8;
$other_page = 12;
$blank_row = 6;    
}


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Purchase Order</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Normalize or reset CSS with your favorite library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
        <!-- Load paper.css for happy printing -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
        <link href="http://localhost/sopl-new/assets/img/favicon.ico" rel="shortcut icon" type="image/png">
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
                height: 185px
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
            .height_215{ height: 191px }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 14px;}

            .border-bottom{border-bottom:  1px solid #000}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 14px;}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000}
                .no-print{display:none;}
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
        
        
        <form method="post" class="no-print" style="width: 200px;background:#f5f5f5;padding:10px;position:absolute;right:0;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <label>First page rows: <input required type="number" min="5" max="25" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" max="25" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <label>Blank rows: <input required type="number" min="0" max="25" name="blank_row" class="form-control" value="<?=$blank_row?>"/></label>
            <input type="hidden" name="module_id" value="9"/>
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
                        <h3 class="mar_0 head_font">Purchase Order</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Company</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, </p>
                            <p class="mar_0">KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <p class="mar_0">Emails : info@shilpaoverseas.com</p>
                            <p class="mar_0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: bratin.ghosh@shilpaoverseas.com</p>
                            <p class="mar_0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: subir.ghosh@shilpaoverseas.com</p>
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-7 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Order No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $purchase_order_details[0]->po_number ?></strong></h5>
                                        <h6 class="mar_0"><strong><?= date('d-m-Y', strtotime($purchase_order_details[0]->po_date)) ?></strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-5 border_all height_60">
                                    <div class="">
                                        <!--<p class="mar_0">Export Ref.</p>-->
                                        <p class="mar_0">Company GSTIN: 19AAECS6338L1ZT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_21 mar_bot_3">
                                <div class="col-sm-12">
                                    <div class="">
                                        <p class="mar_0"><b>Delivery Date: </b><?= date('d-m-Y', strtotime($purchase_order_details[0]->po_delivery_date)) ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_215 mar_bot_3">
                                <div class="col-sm-12">
                                    <h4 class="mar_0">Terms & Conditions</h4>
                                    <p class="mar_0">
                                        <?= $purchase_order_details[0]->terms ?>
                                    </p>
                                    <p class="mar_0">
                                        <?= $purchase_order_details[0]->remarks ?>
                                    </p>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="row height_90 mar_bot_3">
                        <div class="col-sm-6 border_all height_90">
                            <p class="mar_0"><strong>Supplier</strong></p>
                            <h4 class="mar_0"><strong><?= isset($purchase_order_details[0]->name) ? $purchase_order_details[0]->name : '' ?></strong></h4>
                            <article style="font-size:12px;line-height:1"><?= $purchase_order_details[0]->address . ',' . $purchase_order_details[0]->country ?></article>
                            <p class="mar_0" style="font-size:12px"></p>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>

                    
                    <!--table data-->
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                <thead>
                                    <tr> 
                                        <th>Sr#</th>
                                        <th>Item Name</th>
                                        <th>Colour</th>
                                        <th>Qnty</th>
                                        <th>Rate</th>
                                        <th>Unit</th>                                    
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="actual_table">
                                    <?php
                                    $iter = 1;
                                    $count_iter = $front_page;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    if(count($purchase_order_details) > 0) {
                                        // echo '<pre>', print_r($purchase_order_details), '</pre>'; die();
                                    foreach ($purchase_order_details as $fid) {

                                       if ($iter == $front_page or $iter == $count_iter) {
                                        $count_iter += $other_page;
                            $page_no += 1;
                            ?>
                                </tbody>
                            </table>
                                </div>
                            </div>
                            <div class="row">
                                <footer>
                                    <div class="col-sm-6 border_all height_135">
                                        <p class="mar_0">Prepared By,</p>
                                        <h6 class="mar_0 text-justify"><?= $this->session->name ?> </h6>
                                        <p class="mar_0">Approved By,</p>
                                        <h6 class="mar_0 text-justify">Mr. DEEPABRATA PAUL </h6>
                                        <br />
                                        <br />
                                        <h6 class="mar_0 text-uppercase">For,<strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                                    </div>
                                    <div class="col-sm-6 border_all height_135">
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                        <p class="mar_0 text-right">Receiver's Signature & Date</p>
                                        <h6 class="mar_0 text-right text-uppercase">For, <strong><?= $purchase_order_details[0]->name ?></strong></h6>
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
                                <h3 class="mar_0 head_font">Purchase Order</h3>
                            </div>
                            <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Company</strong></p>
                            <h4  class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, </p>
                            <p class="mar_0">KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <p class="mar_0">Emails : info@shilpaoverseas.com</p>
                            <!--<p class="mar_0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: debapriya.sen@shilpaoverseas.com</p>-->
                            <p class="mar_0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: bratin.ghosh@shilpaoverseas.com</p>
                            <p class="mar_0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: subir.ghosh@shilpaoverseas.com</p>
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-7 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Order No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $purchase_order_details[0]->po_number ?></strong></h5>
                                        <h6 class="mar_0"><strong><?= date('d-m-Y', strtotime($purchase_order_details[0]->po_date)) ?></strong></h6>
                                    </div>
                                </div>
                                <div class="col-sm-5 border_all height_60">
                                    <div class="">
                                        <!--<p class="mar_0">Export Ref.</p>-->
                                        <p class="mar_0">Company GSTIN: 19AAECS6338L1ZT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_21 mar_bot_3">
                                <div class="col-sm-12">
                                    <div class="">
                                        <p class="mar_0"><b>Delivery Date: </b><?= date('d-m-Y', strtotime($purchase_order_details[0]->po_delivery_date)) ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row border_all height_215 mar_bot_3">
                                <div class="col-sm-12">
                                    <h4 class="mar_0">Terms & Conditions</h4>
                                    <p class="mar_0">
                                        <?= $purchase_order_details[0]->terms ?>
                                    </p>
                                    <p class="mar_0">
                                        <?= $purchase_order_details[0]->remarks ?>
                                    </p>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="row height_90 mar_bot_3">
                        <div class="col-sm-6 border_all height_90">
                            <p class="mar_0"><strong>Supplier</strong></p>
                            <h4 class="mar_0"><strong><?= isset($purchase_order_details[0]->name) ? $purchase_order_details[0]->name : '' ?></strong></h4>
                            <article style="font-size:12px;line-height:1"><?= $purchase_order_details[0]->address . ',' . $purchase_order_details[0]->country ?></article>
                            <p class="mar_0" style="font-size:12px"></p>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Item Name</th>
                                        <th>Colour</th>
                                        <th>Qnty</th>
                                        <th>Rate</th>
                                        <th>Unit</th>                                    
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="actual_table">
                                    <?php
                                    }
                                    ?>
                                    
                                        <tr>
                                            <td><?= $iter ?></td>
                                            <td><?= $fid->item ?></td>
                                            <td><?= $fid->color .' ['. $fid->c_code .']'; ?></td>
                                            <td><?= $fid->pod_quantity ?></td>
                                            <td><?= $fid->pod_rate ?></td>
                                            <td><?= $fid->unit ?></td>
                                            
                                            <td>
                                                <?php if($fid->item_group == 1) {?>
                                                Thickness: <?= $fid->thick ?>
                                                <?php if($fid->pod_remarks != '') {?>
                                                Remarks: <?= $fid->pod_remarks ?>
                                                <?php } ?>
                                                <?php } else { ?>
                                                <?php if($fid->pod_remarks != '') {?>
                                                Remarks: <?= $fid->pod_remarks ?>
                                                <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    $last_iter = $iter;
    $last_page_no = $page_no;
    $iter++;
                                }
                            }
                                ?>
                                <?php
                                for ($i = 1; $i < $blank_row; $i++) {
                                    ?>
                                    <tr>
                                        <td colspan="7">&nbsp;</td>
                                    </tr>
                                    <?php
                                 }
                                ?>
                                <!--<tr>-->
                                <!--    <td colspan="3" style="font-weight: bold; font-size: 12px;text-align:left; text-transform: uppercase"><h5 class=""> <?= convertNumberToWord(11) ?></h5></td>-->
                                <!--    <td colspan="1"  style="font-weight: bold; font-size: 14px" class="text-center"><h5 class=""><?= $tot_qnty ?></h5></td>-->
                                <!--    <td colspan="1" style="font-weight: bold; font-size: 14px;"><h5 class=""><b>Total </b></h5></td>-->
                                    
                                <!--</tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <footer>
                            <div class="col-sm-6 border_all height_135">
                                <p class="mar_0">Prepared By,</p>
                                <h6 class="mar_0 text-justify"><?= $this->session->name ?> </h6>
                                <p class="mar_0">Approved By,</p>
                                <h6 class="mar_0 text-justify">Mr. DEEPABRATA PAUL </h6>
                                <br />
                                <br />
                                <h6 class="mar_0 text-uppercase">For,<strong>Shilpa overseas (Pvt.) Ltd</strong></h6>
                            </div>
                            <div class="col-sm-6 border_all height_135">
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <p class="mar_0 text-right">Receiver's Signature & Date</p>
                                <h6 class="mar_0 text-right text-uppercase">For, <strong><?= $purchase_order_details[0]->name ?></strong></h6>
                            </div>
                        </footer>
                    </div>
                </div>
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
