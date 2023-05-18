
<?php #echo '<pre>', print_r($consumption),'</pre>' ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Customer Order Consumption</title>

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
                height: 150px
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
        <section class="sheet padding-10mm">
            <div>
                <header class="pull-right">
                    <small>Page No. 1</small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Customer Order Consumption</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
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
                                        <p class="mar_0">Order No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $consumption[0]->co_no ?><br /> dated, <?= date('d-m-Y', strtotime($consumption[0]->co_date)) ?></strong></h5>

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
                                    <h4 class="mar_0">Buyer Ref. No. & Date: </h4>
                                    <p><?= $consumption[0]->buyer_reference_no . ' ('. date('d-m-Y', strtotime($consumption[0]->co_reference_date)) .')' ?></p>
                                    
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0"><?= $consumption[0]->name . ' ['. $consumption[0]->short_name .']' ?></p>
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
                                        <th>Group</th>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Lth. Clr.</th>
                                        <th>Fit. Clr.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $iter = 1;
                                    $new_iter = 16;
                                    $groups = array();
                                foreach ($consumption as $f) {
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
                                
                                // echo '<pre>', print_r($groups), '</pre>';die();
                                    
                                    foreach($consumption  as $curr_key=>$con){
                                        $keys = array();
                                    foreach($consumption as $key=>$val) {
                                        if ($val->item_name == $con->item_name) {
                                            array_push($keys, $key);
                                        }
                                    }
        if ($iter == 16 or $iter == $new_iter) {
            
            $new_iter += 15;
            
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </section>
                                        </body>
                                        <body class="A4" id="page-content">
                <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm">
            <div>
                <header class="pull-right">
                    <small>Page No. 1</small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Customer Order Consumption</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
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
                                        <p class="mar_0">Order No. & Date</p>
                                        <h5 class="mar_0"><strong><?= $consumption[0]->co_no ?><br /> dated, <?= date('d-m-Y', strtotime($consumption[0]->co_date)) ?></strong></h5>

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
                                    <h4 class="mar_0">Buyer Ref. No. & Date: </h4>
                                    <p><?= $consumption[0]->buyer_reference_no . ' ('. date('d-m-Y', strtotime($consumption[0]->co_reference_date)) .')' ?></p>
                                    
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0"><?= $consumption[0]->name . ' ['. $consumption[0]->short_name .']' ?></p>
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
                                        <th>Group</th>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Lth. Clr.</th>
                                        <th>Fit. Clr.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php } $iter++; ?>
                                        <tr>
                                            <td nowrap><?= $con->group_name ?></td>
                                            <td nowrap><?= $con->item_code ?></td>
                                            <td><?= $con->item_name ?>
                                            [<?= $con->item_color ?>]
                                            </td>
                                            <!--########### SUPER_FINAL_QNTY changed to FINAL_QNTY ########### ON 070821 BY SAYAK - VERIFICATION AWAITING...-->
                                            <td style="text-align: right;"><?= round($con->final_qnty, 2) ?></td>
                                            <td><?= $con->unit ?></td>
                                            <td><?= $con->leather_color ?></td>
                                            <td><?= $con->fitting_color ?></td>
                                        </tr>
                                        <?php
                                    if($con->show_total_in_consumption == 1) {
                                    if(end($keys) == $curr_key) {
                                        ?>
                                        <tr>
                                            <th colspan="3">Total for <?=$groups[$con->item_name]['item_name']?>[<?= $con->item_color ?>]</th>
                                            <th style="text-align: right;"><?= number_format( $groups[$con->item_name]['final_qnty'], 2)?></th>
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
                                <div class="">
                                    <!--<h6 class="border-bottom text-justify">-->
                                    <!--   I declare that the above information is true and correct to the best of my knowledge and that the goods are of Indian origin.-->
                                    <!--   <br />-->
                                    <!--   &nbsp;-->
                                    <!--</h6>-->
                                    <!--<h6 class="border-bottom text-justify">-->
                                    <!--    For and on behalf of the above named company<br />-->
                                    <!--    Name: <b>Shipa Overseas Pvt. Ltd.</b><br />-->
                                    <!--    Position: <b>Manager</b>-->
                                    <!--    <br />-->
                                    <!--   &nbsp;-->
                                    <!--</h6>-->
                                </div>
                            </div>
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
                        </footer>
                    </div>
                </div>
        </section>


    </body>
</html>
