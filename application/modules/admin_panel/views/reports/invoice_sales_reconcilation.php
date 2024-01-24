<?PHP

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title> Sales Reconcilation | <?=WEBSITE_NAME;?></title>
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
            td{text-align: right!important;}
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
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 3px; text-align: left; font-size: 13px}

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

    <body class="A4 landscape" id="page-content" >
        
        <form method="post" style="margin:20px auto;width:210mm">
            <div class="col-sm-4">
                <input type="date" name="fromdate" class="form-control" />
            </div>
            <div class="col-sm-4">
                <input type="date" name="todate" class="form-control col-sm-3" />
            </div>
            <div class="col-sm-4">
                <input type="submit" value="Submit" class="btn btn-success" />
            </div>
        </form>
        
        <section class="sheet" style="height: auto;margin-top:20px;padding:3mm">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="16"><h3 class="text-center" style="margin:0">Sales Reconcilation - <?=YEAR_START?> - <?=YEAR_END?></h3></th>
                    </tr>
                    <tr>
                        <th>Sr #</th>
                        <th>Inv. No.</th>
                        <th>Inv. Date</th>
                        <th>Inv. Qnty.</th>
                        <th>Inv. Amnt. (FC)</th>
                        <th>Currency</th>
                        <th>Ex. Rate (Checlist)</th>
                        <th>Inv. Amnt Inr<br> (E-inv. / Checklist)</th>
                        <th>Discount Amnt. Inr<br> (E-inv. / Checklist)</th>
                        <th>Handling Chargs. INR<br> (E-inv. / Checklist)</th>
                        <th>Ex. Rate (Bank)</th>
                        <th>Inv. Amnt. INR (Bank)</th>
                        <th>Discount Amnt. INR<br> (Bank)</th>
                        <th>Handling Chargs. INR<br> (Bank)</th>
                        <th>Final Inv. Amnt. Inr<br> (E-inv. / Checklist)</th>
                        <th>Final Inv. Amnt. INR<br> (Bank)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $iter = 1; $total_net_qnty = $total_net_amnt = $total_net_amount_inr = $total_discounted = $val10 = $val11 = $val12 = $val13 = $val14 = $val15 = $val16 = 0 ?>
                    <?php foreach($invoice_sales_reconcilation as $isr): ?>
                        <tr>
                            <td><?=$iter++?></td>
                            <td style="text-align: center"><?=$isr->office_invoice_number?></td>
                            <td nowrap><?=date('d-m-Y', strtotime($isr->office_invoice_date))?></td>
                            <td><?php $total_net_qnty+=$isr->net_quantity; echo $isr->net_quantity?></td>
                            <td><?php $total_net_amnt += $isr->net_amount; echo $isr->net_amount?></td>
                            <td style="text-align: center"><?=$isr->currency . ' ('. $isr->currency_sign .')'?></td>
                            <td><?=$isr->ex_rate?></td>
                            <td><?php $total_net_amount_inr+=$isr->net_amount_inr; echo $isr->net_amount_inr?></td>
                            <td style="text-align: center">
                                <?php 
                                    $discounted = ($isr->net_amount_inr * ($isr->discount/100)); 
                                    $total_discounted+=$discounted; 
                                    echo number_format($isr->net_amount_inr * ($isr->discount/100), 2) .'<br> at ('.$isr->discount . '%)';
                                ?>
                            </td>
                            <td><?php $val10 += ($isr->hand_charge * $isr->ex_rate); echo $isr->hand_charge * $isr->ex_rate?></td>
                            <td><?php $val11 += $isr->realisation_ex_rate; echo $isr->realisation_ex_rate?></td>
                            
                            <td><?php $val12 += ($isr->net_amount * $isr->realisation_ex_rate); echo ($isr->net_amount * $isr->realisation_ex_rate)?></td>
                            <td><?php $val13 += ($isr->net_amount * $isr->realisation_ex_rate)*($isr->discount/100); echo ($isr->net_amount * $isr->realisation_ex_rate)*($isr->discount/100)?></td>
                            <td><?php $val14 += ($isr->hand_charge * $isr->realisation_ex_rate); echo ($isr->hand_charge * $isr->realisation_ex_rate)?></td>

                            <td><?php $val15 += ($isr->net_amount_inr  - $discounted) + ($isr->hand_charge * $isr->ex_rate); echo number_format(($isr->net_amount_inr  - $discounted) + ($isr->hand_charge * $isr->ex_rate),2)?></td>
                            <td><?php $val16 += (($isr->net_amount * $isr->realisation_ex_rate) - ($isr->net_amount * $isr->realisation_ex_rate)*($isr->discount/100)) + ($isr->hand_charge * $isr->realisation_ex_rate); echo number_format(($val12 - $val13)+$val14, 2)?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th><?=$total_net_qnty?></th>
                        <th><?=$total_net_amnt?></th>
                        <th></th>
                        <th></th>
                        <th><?=$total_net_amount_inr?></th>
                        <th><?=$total_discounted?></th>
                        <th><?=$val10?></th>
                        <th><?=$val11?></th>
                        <th><?=$val12?></th>
                        <th><?=$val13?></th>
                        <th><?=$val14?></th>
                        <th><?=$val15?></th>
                        <th><?=$val16?></th>
                    </tr>
                </tfoot>
            </table>
           
           
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
