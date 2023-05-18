<?PHP
//echo '<pre>', print_r($fetch_individual_invoice_details), '</pre>';
//die;
//echo '<pre>', print_r($fetch_individual_invoice_details_all), '</pre>';die;
// echo '<pre>', print_r($print_packing_consignee_details), '</pre>';
// echo '<pre>', print_r($fetch_individual_declaration_details), '</pre>';

$count = 0;
$arr_leather_type = array();
$arr_leather_dimention = array();
$arr_order_no = array();
$arr_crtn_count = array();

foreach ($print_packing_list as $pplist) {
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
                        
foreach ($print_packing_list as $ppli) {
    if (!in_array($ppli->buyer_reference_no, $arr_order_no)) {
        array_push($arr_order_no, $ppli->buyer_reference_no);
    }
}



#print_r($arr_order_no );die;

$total_count = count($print_packing_list);
$arr = array_unique(array_column($print_packing_list, 'ORD'));
#$arr_leather_type = array_unique(array_column($print_packing_list, 'ART_LTH_TYPE'));
#$arr_leather_dimention = array_unique(array_column($print_packing_list, 'ITEM_NAME'));
// print_r($arr_leather_dimention);
//$gross_qnty = 0;
//$gross_weight = 0;
//foreach ($print_packing_list as $ppl_temp) {
//    $gross_qnty += $ppl_temp->QNTY;
//    $gross_weight += $ppl_temp->GRWT;
//}
//$net_weight = $gross_weight - ($print_packing_list[$total_count - 1]->CRTN * 2)
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
                        <h3 class="mar_0 head_font"><?= $print_packing_list[0]->cust_header_name ?></h3>
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
                                        <h4 class="mar_0"><strong><?= $print_packing_list[0]->office_invoice_number ?></strong></h4>
                                        <h5 class="mar_0"><strong><?= $print_packing_list[0]->office_invoice_date ?></strong></h5>
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

                    <div class="row mar_bot_3">
                        <div class="col-sm-6 border_all height_119">
                            <p class="mar_0"><strong>Consignee</strong></p>
                            <h4 class="mar_0"><strong><?= isset($print_packing_list[0]->acc_name) ? $print_packing_list[0]->acc_name : '' ?></strong></h4>
                            <article style="font-size:12px;line-height:1"><?= $print_packing_list[0]->acc_address . ',' . $print_packing_list[0]->country ?></article>
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
                                            <?= strtolower($print_packing_list[0]->country) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row height_70 border_all">
                                <div class="col-sm-12">
                                    <p><strong>Buyer (if other than consignee)</strong></p>
                                    <h4 class="mar_0"><strong><?= isset($print_packing_list[0]->acc_name2) ? $print_packing_list[0]->acc_name2 : '' ?></strong></h4>
                            <article style="font-size:12px;line-height:1"><?= $print_packing_list[0]->acc_address2?></article>
                            <p class="mar_0" style="font-size:12px"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mar_bot_3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5 border_all height_41">
                                    <p class="mar_0"><strong>Pre-Carriage By</strong></p>
                                    <h5 class="text-uppercase mar_0">
                                        <?php 
                                        if($print_packing_list[0]->pre_carriage_by == 1) {
                                            echo 'By Air';
} else if ($print_packing_list[0]->pre_carriage_by == 2) {
 echo 'By Ship';
} else if ($print_packing_list[0]->pre_carriage_by == 3) {
 echo 'By Road';
} else {
    echo '';
}
                                         ?>

                                    </h5>
                                </div>
                                <div class="col-sm-7 height_41 border_all">
                                    <div class="">
                                        <small><strong>Place of Receipt by Pre-Carrier</strong></small>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
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

                    </div>

                    <div class="row mar_bot_3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5 border_all height_41">
                                    <p class="mar_0"><strong>Port of Discharge</strong></p>
                                    <h5 class="text-uppercase mar_0"><?= $print_packing_list[0]->port_of_discharge ?></h5>
                                </div>
                                <div class="col-sm-7 height_41 border_all">
                                    <div class="">
                                        <p class="mar_0"><strong>Final Destination</strong></p>
                                        <h5 class="text-uppercase mar_0"> <?= $print_packing_list[0]->country ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12 height_41 border_all">
                                    <p class="mar_0"><strong>Description of Goods</strong></p>
                                    <h6 class="text-uppercase mar_0">
                                        <?= $print_packing_list[0]->description_of_goods ?>
                                    </h6>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mar_bot_3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5 border_all height_100">
                                    <p class="mar_0"><strong>Mark & Container</strong></p>
                                    <h5 class="text-uppercase mar_0">
                                        <?= nl2br($print_packing_list[0]->mark_container) ?>
                                    </h5>

                                </div>
                                <div class="col-sm-7 height_100 border_all">
                                    <div class="">
                                        <p class="mar_0"><strong>No. & Kind of Pkgs</strong></p>
                                        <h5 class="text-uppercase mar_0">
                                            <?= nl2br($print_packing_list[0]->no_of_kind_of_package) ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12 height_100 border_all" style="height: 65px;">
                                    <p class="mar_0"><strong>Terms of Delivery & Payment</strong></p>
                                    <h6 class="mar_0"><?= nl2br($print_packing_list[0]->terms_of_delivery_payment) ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 height_100 border_all" style="height: 65px;">
                                    <p class="mar_0"><strong>Notify</strong></p>
                                    <h6 class="mar_0"><?= nl2br($print_packing_list[0]->notify) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!--table data-->
                    <div class="row table-responsive">
                        <table class="table table-bordered table-hover table2excel">
                            <thead>
                                                <tr>
                                                    <?php 
$rate_type = $print_packing_list[0]->rate_type;
if($rate_type == 1) {
    $rate_type_text = 'Ex. Works';
} else if($rate_type == 2) {
    $rate_type_text = 'C&F';
} else if($rate_type == 3) {
    $rate_type_text = 'CIF';
} else if($rate_type == 4) {
    $rate_type_text = 'FOB';
} else {
   $rate_type_text = ''; 
}
                                                    ?>
                                        <th>Order #</th>
                                        <th>Buyer Style</th>
                                        <th>Description</th>
                                        <th>Colour</th>
                                        <th style="text-align: right;">Qnty in Pcs.</th>
                                        <th>Rate in <?php if(isset($print_packing_list[0]->currency)){ ?><?=  $rate_type_text ?> / <?= $print_packing_list[0]->currency ?> <?php } ?></th>
                                        <th>Amount in <?php if(isset($print_packing_list[0]->currency)){ ?><?=  $rate_type_text ?> / <?= $print_packing_list[0]->currency ?> <?php } ?></th>
                                    </tr>
                            </thead>
                            <tbody class="actual_table">
                                <?php
                                    $iter = 1;
                                    $sr_iter = 1;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    $nr=5;
                                    foreach ($print_packing_list as $ppl) {
                                        if ($iter == 5 or $iter == $nr) {
                                            $page_no += 1;
                                            $nr += 6;
                                            ?>
                        </tbody>
                    </table>
                </div>



<div class="row">
                                <footer>
                            <div class="col-sm-6 border_all height_135">
                                <h6 class="mar_0 text-justify">
                                    <?php
                                    foreach($print_packing_list as $pol){
                                        // echo $pol->DECLARATION_DESCRIPTION;
                                    }
                                    ?>
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
                                            <p class="mar_0 text-right"><?= $print_packing_list[0]->office_invoice_date ?></p>
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
                        <h3 class="mar_0 head_font"><?= $print_packing_list[0]->cust_header_name ?></h3>
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
                                        <h4 class="mar_0"><strong><?= $print_packing_list[0]->office_invoice_number ?></strong></h4>
                                        <h5 class="mar_0"><strong><?= $print_packing_list[0]->office_invoice_date ?></strong></h5>
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
                    
                    <!--table data-->
                    <div class="row table-responsive">
                        <table class="table table-bordered table-hover table2excel">
                            <thead>
                                <tr>
                                    <?php 
$rate_type = $print_packing_list[0]->rate_type;
if($rate_type == 1) {
    $rate_type_text = 'Ex. Works';
} else if($rate_type == 2) {
    $rate_type_text = 'C&F';
} else if($rate_type == 3) {
    $rate_type_text = 'CIF';
} else if($rate_type == 4) {
    $rate_type_text = 'FOB';
} else {
   $rate_type_text = ''; 
}
                                                    ?>
                                        <th>Order #</th>
                                        <th>Buyer Style</th>
                                        <th>Description</th>
                                        <th>Colour</th>
                                        <th style="text-align: right;">Qnty in Pcs.</th>
                                        <th>Rate in <?php if(isset($print_packing_list[0]->currency)){ ?><?=  $rate_type_text ?> / <?= $print_packing_list[0]->currency ?> <?php } ?></th>
                                        <th>Amount in <?php if(isset($print_packing_list[0]->currency)){ ?><?=  $rate_type_text ?> / <?= $print_packing_list[0]->currency ?> <?php } ?></th>
                                    </tr>
                            </thead>
                            <tbody class="actual_table">
                            <?php } ?>
                                    <tr>
                                <td style="width: 25mm"><?= $ppl->buyer_reference_no ?></td>
                                <td class="text-left"><?= $ppl->alt_art_no ?></td>
                                <td class="text-left"><?= $ppl->art_info ?></td>
                                <td class="text-left"><?= $ppl->color ?></td>
                                <td style="text-align: right; width: 20mm;">
                                    <?php
                                    $tot_qnty += $ppl->quantity;
                                    echo $ppl->quantity;
                                    ?>
                                </td>
                                <td style="text-align: right; width: 20mm;"><?= number_format($ppl->rate_foreign + $ppl->additional_charges, 2) ?></td>
                                <td style="text-align: right; width: 30mm;">
                                    <?php
                                    echo $ppl->amount;
                                    $tot_amnt += $ppl->amount;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align:left"><h6 class="mar_0">Hand & Machine Ratio: <?= $ppl->hand_machine . ', ' . $ppl->leather_type_info . ', H.S.Code:' . $ppl->remark . ', ' . $ppl->metal_fitting . ', ' . $ppl->size . ', ' ?><?= ($ppl->brand != '') ? $ppl->brand : 'Unbranded' ?></h6></td>
                            </tr>
                                <?php
                            $last_iter = $iter;
                            $last_page_no = $page_no;
                            $iter++;
                        }
                        ?>
                        <?php
                        if ($last_page_no == 1) {
                            $add_td = (9 - $last_iter);
                        } else {
                            $temp_add = ($last_iter - 12) % 9;  
                            if ($temp_add == 0) {
                                $add_td = 0;
                            } else {
                                $add_td = 12 - $temp_add;
                            }
                        }
//                                echo $last_iter . ' => ' . $last_page_no;
//                                echo 'td to be added. =>' . $add_td;die;

// RoDTEP DECLARATION_DESCRIPTION IS HUGE AND CAN'T FIT HERE SO IT NEEDS SPECIAL ATTENTION

                        if(!in_array('RoDTEP', $all_declarations)){ 
                            for ($i = 1; $i < $add_td; $i++) {
                                ?>
                                <tr>
                                    <!--<td>&nbsp;</td>-->
                                    <!--<td>&nbsp;</td>-->
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                                <tr>
                            <td colspan="4" style="font-weight: bold; font-size: 12px;text-align:left; text-transform: uppercase"><h5 style="font-size: 11px;" class=""><?= $print_packing_list[0]->currency ?> <?= convertNumberToWord(round($tot_amnt - round($tot_amnt * ($print_packing_list[0]->discount / 100), 2), 2)) ?></h5></td>
                            <td colspan="1"  style="font-weight: bold; font-size: 14px" class="text-right"><h5 class="text-right"><?= $tot_qnty ?></h5></td>
                            <td colspan="1" style="font-weight: bold; font-size: 14px;"><h5 class=""><b>Total <?= $print_packing_list[0]->currency ?></b></h5></td>
                            <td colspan="1" style="font-weight: bold; font-size: 14px; text-align: right"><h5 class=""><?= number_format($tot_amnt, 2) ?></h5></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3"><h6 class="" style="text-align:left;">(-)Less: Discount @ <?= $print_packing_list[0]->discount ?>%</h6></td>
                            <td colspan="1"><h5 class="" style="text-align: right"><b><?= round(($tot_amnt * ($print_packing_list[0]->discount / 100)), 2) ?></b></h5></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3"><h6 class="" style="text-align:left;">(+)Handling Charges</h6></td>
                            <td colspan="1"><h5 class="" style="text-align: right"><b><?= round($print_packing_list[0]->hand_charge, 2) ?></b></h5></td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><h6 class="">Gross Weight: <strong> <?= number_format($print_packing_list[0]->gross_weight, 2) ?> Kgs </strong> </h6></td>
                            <td style="text-align:left;"><h6 class="">Net Weight: <strong><?= number_format($print_packing_list[0]->net_weight, 2) ?> Kgs</strong></strong></h6></td>
                            <td style="text-align:left;"><h6 class="">Volume Weight: <strong> <?= number_format($print_packing_list[0]->volume_weight, 2) ?> Kgs</strong></h6></td>
                            <td colspan="3"><h6 style="text-align:left;" class="">Net Total <?= $print_packing_list[0]->currency ?></h6></td>
                            <td colspan="1"><h5 class=""  style="text-align: right"><b> <?= number_format(($tot_amnt - round($tot_amnt * ($print_packing_list[0]->discount / 100), 2) + $print_packing_list[0]->hand_charge), 2) ?></b></h5></td>
                        </tr>   
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                    <footer>
                            <div class="col-sm-12 border_all">
                                <h6 class="mar_0 text-justify">
                                    <?php
                            if(isset($fetch_individual_declaration_details)) {
                            foreach($fetch_individual_declaration_details as $pol){
                                echo $pol->DECLARATION_DESCRIPTION;
                            }
                            }
                            ?>
                                </h6>
                            </div>
                            <div class="col-sm-12 border_all">
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
                                            <p class="mar_0 text-right"><?= $print_packing_list[0]->office_invoice_date ?></p>
                                        </div>
                                    </div>
                                </div>
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
