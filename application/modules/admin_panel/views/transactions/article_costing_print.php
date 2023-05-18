<?php
#echo '<pre>',print_r($costing), '</pre>';
#echo '<pre>',print_r($charges), '</pre>';
?>

<?PHP

// echo '<pre>', print_r($fetch_all_proforma_dtl), '</pre>';
// echo '<pre>', print_r($proforma_details), '</pre>';

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
        <title>Costing Print | <?=WEBSITE_NAME;?></title>

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
                font-family: 'Signika', sans-serif;
                /*font-size: 12.5px;*/
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
                font-family: 'Signika', sans-serif;
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
            
            .text-right{text-align: right!important;}
            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000} .text-right{text-align: right!important;}
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
        
        <form method="post" class="no-print" style="width: 200px;background:#f5f5f5;padding:10px;position:absolute;right:0;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <label>First page rows: <input required type="number" min="5" max="25" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" max="25" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <input type="hidden" name="module_id" value="1"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
            <input type="submit" name="page_setup_submit" class="btn btn-warning btn-sm"/>
        </form>
        
        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                        <?php
                                        $item_cost = 0;
                                        $total_prime = 0;
                                        $total = 0;
                                        $total_inc_fr = 0;
                                        $commission = 0;
                                        $fob=0;
                                        $fr = 0;
                                        $ex = 0;
                                        $com_per = 0;
                                        $count_iter = $front_page;
                                        $iter = 1;
                                        // item details
                                        foreach ($costing as $cost_details) {
                                            // echo '<pre>', print_r($cost_details), '</pre>';
                            
                            if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                            
                                            <tr>
                                                <td><?= $cost_details->group_name ?></td>
                                                <td nowrap><?= $cost_details->item_master_code ?></td>
                                                <td><?= $cost_details->item_name . ' [' . $cost_details->color .']' ?></td>
                                                <td class="cs_quatn text-right"><?= $cost_details->cost_qnty ?></td>
                                                <td class="cs_ratec text-right"><?= number_format($cost_details->cost_rate, 2) ?></td>
                                                <td class="text-right">
                                                    <?php 
                                                        $item_cost += round($cost_details->cost_qnty * $cost_details->cost_rate, 2); 
                                                        echo number_format(round($cost_details->cost_qnty * $cost_details->cost_rate, 2), 2) 
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5"><b>Item Cost</b></td>
                                            <td class="text-right"><?= $item_cost ?></td>
                                        </tr>
                                        <?php
                                            
                                        // charges area
                                        foreach ($charges as $ffch) {
                                            if($ffch->charge_group == 'Charge'){
                                                if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                                <tr>
                                                    <td colspan="2"><?= $ffch->charge_name ?></td>
                                                    <td class="text-right"><?= ($ffch->charge_percentage == '') ? '0' : $ffch->charge_percentage ?></td>
                                                    <td class="qq text-right"><?= number_format($ffch->charge_qnty, 2) ?></td>
                                                    <td  class="text-right"><?= ($ffch->charge_rate == '') ? '0' : number_format($ffch->charge_rate, 2) ?></td>
                                                    <td class="text-right">
                                                        <?php
                                                            $total_prime += ($ffch->charge_qnty * $ffch->charge_rate);
                                                            echo number_format(($ffch->charge_qnty * $ffch->charge_rate), 2); 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5"><b>Total Prime Cost</b></td>
                                            <td class="text-right"><?= $full_prime = ($item_cost+$total_prime) ?></td>
                                        </tr>
                                        
                                        <?php
                                        // overhead area but 'FREIGHT' is ignored
                                        foreach ($charges as $ffch) {
                                            if(strcasecmp($ffch->charge_name, "Freight") == 0){
                                                continue;
                                            }
                                            if($ffch->charge_group == 'Overhead and Others'){
                                                if(strcasecmp($ffch->charge_name, "Overhead") == 0){
                                                if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                                <tr>
                                                    <td colspan="2"><?= $ffch->charge_name ?></td>
                                                    <td class="text-right"><?= $over_per =  ($ffch->charge_percentage == '') ? '0' : $ffch->charge_percentage ?></td>
                                                    <td class="qq text-right"><?= $ffch->charge_qnty ?></td>
                                                    <td  class="text-right"><?= ($ffch->charge_rate == '') ? '0' : number_format($ffch->charge_rate, 2) ?></td>
                                                    <td class="text-right">
                                                        <?php
                                                            $per_val = round($full_prime * ($over_per/100), 2);
                                                            $total += $per_val ;
                                                            echo number_format($per_val, 2); 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                } else{
                                                if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                                
                                                <tr>
                                                    <td colspan="2"><?= $ffch->charge_name ?></td>
                                                    <td class="text-right"><?= ($ffch->charge_percentage == '') ? '0' : $ffch->charge_percentage ?></td>
                                                    <td class="qq text-right"><?= $ffch->charge_qnty ?></td>
                                                    <td  class="text-right"><?= ($ffch->charge_rate == '') ? '0' : number_format($ffch->charge_rate, 2) ?></td>
                                                    <td class="text-right">
                                                        <?php
                                                            $total += ($ffch->charge_qnty * $ffch->charge_rate) ;
                                                            echo number_format(($ffch->charge_qnty * $ffch->charge_rate), 2); 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                        }
                                        // overhead area but only & 'FREIGHT' is taken
                                        foreach ($charges as $ffch) {
                                            if(strcasecmp($ffch->charge_name, "Freight") == 0){
                                                if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                                <tr>
                                                    <td colspan="2"><?= $ffch->charge_name ?></td>
                                                    <td class="text-right"><?= ($ffch->charge_percentage == '') ? '0' : $ffch->charge_percentage ?></td>
                                                    <td class="qq text-right"><?= $ffch->charge_qnty ?></td>
                                                    <td  class="text-right"><?= ($ffch->charge_rate == '') ? '0' : number_format($ffch->charge_rate, 2) ?></td>
                                                    <td class="text-right">
                                                    <?= $fr = number_format(($ffch->charge_qnty * $ffch->charge_rate), 2); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5"><b>Total</b></td>
                                            <td class="text-right"><?= $l_total = ($item_cost+$total_prime+$total+$fr) ?></td>
                                        </tr>
                                        <?php
                                        
                                        foreach ($charges as $ffch) {
                                            if($ffch->charge_group == 'Commission and Others'){
                                                if(strcasecmp($ffch->charge_name, "FOB CHARGE") == 0){
                                                    $fob = ($ffch->charge_qnty * $ffch->charge_rate);
                                                }
                                                
                                                if(strcasecmp($ffch->charge_name, "Commission") == 0){
                                                   $com_per = $ffch->charge_percentage;
                                                   continue;
                                                }
                                                
                                                if ($iter == $front_page or $iter == $count_iter) {
                            $count_iter += $other_page;
                            $page_no += 1;
                                            ?>
                                            
                                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
                        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. <?= $page_no ?></small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Costing Sheet</h3>
                    </div>
                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all header_left">
                            <p class="mar_0"><strong>Sender</strong></p>
                            <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                            <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                            <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                            <!--<p class="mar_0">FAX:+91-33-40012865</p>-->
                            <!--<p class="mar_0">Email : debapriya.sen@shilpaoverseas.com</p>-->
                            <!--<p class="mar_0">CIN-U19116WB1992PTC055524</p>-->
                        </div>
                        <div class="col-sm-6 header_right">
                            <div class="row mar_bot_3">
                                <div class="col-sm-12 border_all height_60">
                                    <div class="">
                                        <p class="mar_0">Article No.: <?= $costing[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing[0]->info ?></p>
                                        
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
                                    <p class="mar_0">Packing Details: <?= $costing[0]->pack_dtl ?></p>
                                    <p class="mar_0">Cartoon Size: <?= $costing[0]->cartoon_size ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Customer : <?= $costing[0]->customer_name ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Item Code</th>
                                            <th>Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                            <th class="hidden">Cost primary</th>
                                            <th class="hidden">Item Sequence</th>
                                            <th class="hidden">COST MS Sequence</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="actual_table">
                                            
                                            <?php } $iter++; ?>
                                                <tr>
                                                    <td colspan="2"><?= $ffch->charge_name ?></td>
                                                    <td class="text-right"><?= ($ffch->charge_percentage == '') ? '0' : $ffch->charge_percentage ?></td>
                                                    <td class="qq text-right"><?= $ffch->charge_qnty ?></td>
                                                    <td  class="text-right"><?= ($ffch->charge_rate == '') ? '0' : number_format($ffch->charge_rate, 2) ?></td>
                                                    <td class="text-right">
                                                        <?php
                                                            $commission += ($ffch->charge_qnty * $ffch->charge_rate) ;
                                                            echo number_format(($ffch->charge_qnty * $ffch->charge_rate), 2); 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        
                                        <tr>
                                            <td colspan="5"><b>Total Cost Per Piece Ex-Works</b></td>
                                            <td class="text-right final_ex"><?= $ex = ($l_total+$commission) - ($fr + $fob) ?></td>
                                        </tr> 
                                        <tr>
                                            <td colspan="5"><b>Commission @ <?= $com_per ?>%</b></td>
                                            <td class="text-right final_com"><?= $total_com = number_format($ex * ($com_per/100), 2) ?></td>
                                        </tr> 
                                        <tr>
                                            <td colspan="5"><b>Total Cost Per Piece C&F</b></td>
                                            <td class="text-right final_cnf"><?= $total_com + $ex + ($fr) ?></td>
                                        </tr>   
                                        <tr>
                                            <td colspan="5"><b>Total Cost Per Piece FOB</b></td>
                                            <td class="text-right final_fob"><?= $total_com + $ex + ($fob) ?></td>
                                        </tr>   
                                        
                                        
                                    </tbody>
                                </table>
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
