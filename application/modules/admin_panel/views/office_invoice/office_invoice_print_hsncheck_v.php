<?php
$count = 0;
$arr_leather_type = array();
$arr_leather_dimention = array();
$arr_order_no = array();
$arr_crtn_count = array();

foreach ($print_hsn_check as $pplist) {
    if (!in_array($pplist->leather_type_info, $arr_leather_type)) {
        array_push($arr_leather_type, $pplist->leather_type_info);
    }
    if (!in_array($pplist->item_name, $arr_leather_dimention)) {
        array_push($arr_leather_dimention, $pplist->item_name);
    }
}
                            
$all_declarations[] = '';
if(isset($fetch_individual_declaration_details)) {
foreach($fetch_individual_declaration_details as $pol){
    array_push($all_declarations, $pol->DECLARATION_DESCRIPTION);
}
}
                        
foreach ($print_hsn_check as $ppli) {
    if (!in_array($ppli->buyer_reference_no, $arr_order_no)) {
        array_push($arr_order_no, $ppli->buyer_reference_no);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> OFFICE INVOICE | <?=WEBSITE_NAME;?></title>

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
            .height_100{height: 130px}
            .height_41{ height: 41px }
            .height_23{ height: 23px }
            .height_63{ height: 63px }
            .height_21{ height: 21px }
            .height_82{ height: 82px }
            .height_109{ height: 109px; }
            .height_70{ height: 70px; }
            .height_119{ height: 119px; }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

            .border-bottom{border-bottom:  1px solid #000}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000}
                .no-print {display: none;}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content" >
       
        <section class="sheet padding-10mm" style="height: auto;">
        <!-- <div> -->
            <header class="pull-right">
                <!-- < ?php $page_no = 1;?>
                <small>Page No. < ?= $page_no ?></small> -->
            </header>
            <div class="clearfix"></div>
            <div class="container">
                <div class="row border_all text-center text-uppercase mar_bot_3">
                    <h3 class="mar_0 head_font">HSN CHECK</h3>
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
                                    <p class="mar_0">Invoice No. & Date</p>
                                    <h4 class="mar_0"><strong><?= $print_hsn_check[0]->office_invoice_number ?></strong></h4>
                                    <h5 class="mar_0"><strong><?= $print_hsn_check[0]->office_invoice_date ?></strong></h5>
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
                                <small class="mar_0">Buyer Order No. & Date: </small>
                                <small class="mar_0">
                                    <strong style="font-size: 14px;">
                                        <?php
                                        foreach ($arr_order_no as $order_no) {
                                            echo $order_no;
                                            if ($order_no != end($arr_order_no)) {
                                                echo ', ';
                                            }
                                        }
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

                <div class="row height_109 mar_bot_3">
                    <div class="col-sm-6 border_all height_119">
                        <p class="mar_0"><strong>Consignee</strong></p>
                        <h4 class="mar_0"><strong><?= isset($print_hsn_check[0]->acc_name) ? $print_hsn_check[0]->acc_name : '' ?></strong></h4>
                        <article style="font-size:12px;line-height:1"><?= $print_hsn_check[0]->acc_address . ',' . $print_hsn_check[0]->country ?></article>
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
                                        <?= strtolower($print_hsn_check[0]->country) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row height_70 border_all">
                            <div class="col-sm-12">
                                <p><strong>Buyer (if other than consignee)</strong></p>
                                <h4 class="mar_0"><strong><?= isset($print_hsn_check[0]->acc_name2) ? $print_hsn_check[0]->acc_name2 : '' ?></strong></h4>
                        <article style="font-size:12px;line-height:1"><?= $print_hsn_check[0]->acc_address2?></article>
                        <p class="mar_0" style="font-size:12px"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-responsive ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article No.</th>
                                <th>Article Desc.</th>
                                <th>HSN Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $iter = 1;
                            foreach($print_hsn_check as $phc){
                            ?>
                            <tr>
                                <td><?=$iter++?></td>
                                <td><?=$phc->art_no . ' ['. $phc->alt_art_no .']'?></td>
                                <td><?=$phc->art_info?></td>
                                <td <?=(empty($phc->remark)) ? 'style="border:2px solid red!important"' : ''?>><?=$phc->remark?></td>
                            </tr>
                            <?php
                            } 
                            ?>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
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
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript">

            $(document).ready(function() {
                $("a.word-export").click(function(event) {
                    $("#page-content").wordExport();
                });
            });
            
        </script>

        <script type="text/javascript">
            //table to excel (single table)
            var tableToExcel = (function () {
                var uri = 'data:application/vnd.ms-excel;base64,'
                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                    , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
                    , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
                return function (table, name, filename) {
                    if (!table.nodeType) table = document.getElementById(table)
                    var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

                    document.getElementById("dlink").href = uri + base64(format(template, ctx));
                    document.getElementById("dlink").download = filename;
                    document.getElementById("dlink").click();

                }
            })();


            //table to excel (multiple table)
            var array1 = new Array();
            var n = <?php if(isset($table_no)){echo $table_no;}else{echo 0;} ?>; //Total table
            for ( var x=1; x<=n; x++ ) {
                array1[x-1] = 'export_table_to_excel' + x;
            }
            var tablesToExcel = (function () {
                var uri = 'data:application/vnd.ms-excel;base64,'
                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>'
                    , templateend = '</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>'
                    , body = '<body>'
                    , tablevar = '<table>{table'
                    , tablevarend = '}</table>'
                    , bodyend = '</body></html>'
                    , worksheet = '<x:ExcelWorksheet><x:Name>'
                    , worksheetend = '</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>'
                    , worksheetvar = '{worksheet'
                    , worksheetvarend = '}'
                    , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
                    , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
                    , wstemplate = ''
                    , tabletemplate = '';

                return function (table, name, filename) {
                    var tables = table;
                    var wstemplate = '';
                    var tabletemplate = '';

                    wstemplate = worksheet + worksheetvar + '0' + worksheetvarend + worksheetend;
                    for (var i = 0; i < tables.length; ++i) {
                        tabletemplate += tablevar + i + tablevarend;
                    }

                    var allTemplate = template + wstemplate + templateend;
                    var allWorksheet = body + tabletemplate + bodyend;
                    var allOfIt = allTemplate + allWorksheet;

                    var ctx = {};
                    ctx['worksheet0'] = name;
                    for (var k = 0; k < tables.length; ++k) {
                        var exceltable;
                        if (!tables[k].nodeType) exceltable = document.getElementById(tables[k]);
                        ctx['table' + k] = exceltable.innerHTML;
                    }

                    // window.location.href = uri + base64(format(allOfIt, ctx));

                    document.getElementById("dlink").href = uri + base64(format(allOfIt, ctx));;
                    document.getElementById("dlink").download = filename;
                    document.getElementById("dlink").click();
                }
            })();
        </script>
        
        
    </body>
    
</html>
