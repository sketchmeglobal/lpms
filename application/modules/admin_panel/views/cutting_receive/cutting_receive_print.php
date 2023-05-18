

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Cutter Receipt</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Normalize or reset CSS with your favorite library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

        <!-- Load paper.css for happy printing -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
        
        <link href="http://shilpaoverseas.com/new/assets/img/favicon.ico" rel="shortcut icon" type="image/png">
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
            .text-right{
                text-align: right!important;
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
                height: 60px
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
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 12px}

            .border-bottom{border-bottom:  1px solid #000}

            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 11px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .col-sm-8 { width: 66.66666667%;float:left;} 
                .col-sm-4 { width: 33.33333333%; float:left;}
                .border-bottom{border-bottom:  1px solid #000}
                .pad_0{padding: 0}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content">
                <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm">
            <div>
                <header class="pull-right">
                    <!--<small>Page No. 1</small>-->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h4 class="mar_0 head_font">Cutter Receipt</h4>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-8 border_all header_left">
                            <h5 class="mar_0 text-uppercase"><strong><?= $datam[0]->name ?></strong></h5>
                            <h6><?= $datam[0]->address ?></h6>
                        </div>
                        <div class="col-sm-4 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0"><b>Date:</b> <?= $datam[0]->cut_rcv_date ?></p>
                                        <h5 class="mar_0"><b>Rcpt. No.</b>: <?= $datam[0]->cut_rcv_number ?></h5>
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
                                        
                                        <th>Order No.</th>
                                        <th>Challan</th>
                                        <th>Article</th>
                                        <th>Colour</th>
                                        <th class="text-right">Qnty</th>
                                        <th>Part</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //print_r($data);
                                    foreach($datam as $d){
                                    ?>
                                    <tr>
                                        <td nowrap><?= $d->co_no ?></td>
                                        <td><?= $d->cut_number ?></td>
                                        <td><?= $d->art_no ?></td>
                                        <td><?= $d->leather_color ?>/<?= $d->fitting_color ?></td>
                                        <td class="text-right"><?= $d->receive_cut_quantity ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                        </table>                        
                    </div>
                </div>

            </div>
        </section>


    </body>
</html>
