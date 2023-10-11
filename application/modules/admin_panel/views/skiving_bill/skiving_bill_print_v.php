
<?php #echo '<pre>', print_r($consumption),'</pre>' ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Skiving Bill</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
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
            .border_bottom{
                border-bottom: 1px solid #000;
            }
            .mar_0{
                margin: 0
            }
            .mar_bot_3{
                margin-bottom: 3px
            }

            .header_left, .header_right{
                height: 126px
            }

            .width-100{width: 100%}

            .height_60{ height: 60px }
            .height_42{ height: 42px }
            .height_135{height: 150px}
            .height_90{height: 90px}
            .height_100{height: 100px}
            .height_110{height: 110px}
            .height_41{ height: 41px }
            .height_23{ height: 23px }
            .height_63{ height: 63px }
            .height_21{ height: 21px }

            .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000!important;  text-align: center;}
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

            .border-bottom{border-bottom:  1px solid #000}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000}
                /*body.A4 .sheet{*/
                /*    height: 500px;*/
                /*}*/
                thead{
                    margin-top: 15px;
                }
            }
            thead{
                margin-top: 15px;
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content">
                <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm" style="height:auto">
            <div>
                <!-- <header class="pull-right">
                    <small>Page No. 1</small>
                </header> -->
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Skiving Bill</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">51,MAHANIRBAN ROAD,KOLKATA-700 029,INDIA</p>
                            <p class="mar_0">TEL:+91-33-40031411,40031412</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <p class="mar_0">Email : info@shilpaoverseas.com</p>
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Bill No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $skiving_bill_details[0]->bill_number ?><br /> dated, <?= $skiving_bill_details[0]->bill_date ?></strong></h5>
                                    </div>
                                </div>
                                <!--<div class="col-sm-6 border_all height_60">-->
                                <!--    <div class="">-->
                                        <!--<p class="mar_0"></p>-->
                                        <!--<p class="mar_0">Export GSTIN: 19AAECS6338L1ZT</p>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            <div class="row border_all height_63 mar_bot_3">
                                <div class="col-sm-12">
                                    <h4 class="mar_0">Employee Name: </h4>
                                    <h4><b><?= $skiving_bill_details[0]->name ?></b></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--table data-->
                    <div class="row">
                        <!--<h4 class="text-center border-bottom">Consumption Details</h4>-->
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-hover width-100 table2excel consumption_table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bill No.</th>
                                        <th>Order No.</th>
                                        <th>Skiving Iss. No.</th>
                                        <th>Article No.</th>
                                        <th>Color</th>
                                        <th>Paid Qnty</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $iter=1;
                                $skv_total = 0;
                                foreach($skiving_bill_details as $sbd){
                                ?>
                                    <tr>
                                        <td><?=$iter++?></td>
                                        <td><?=$sbd->bill_number . ' ('.$sbd->bill_date.')'?></td>
                                        <td nowrap><?=$sbd->co_no?></td>
                                        <td nowrap><?=$sbd->skiving_issue_number?></td>
                                        <td><?=$sbd->art_no?></td>
                                        <td><?=$sbd->color?></td>
                                        <td style="text-align: right"><?=$sbd->skiving_paid_qnty?></td>
                                        <td style="text-align: right"><?=number_format($sbd->skiving_rate, 2)?></td>
                                        <td style="text-align: right"><?php echo number_format($sbd->skiving_amount, 2) ; $skv_total+=$sbd->skiving_amount?></td>
                                    </tr>
                                <?php    
                                } 
                                ?>
                                </tbody>    
                                <tfoot>
                                    <tr>
                                        <th colspan="8">Total: </th>
                                        <th><?=number_format($skv_total, 2)?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
