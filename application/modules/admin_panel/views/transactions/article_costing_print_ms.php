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
                /*font-family: Calibri;*/
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
                .no-print{display:none;}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content" >
        <?php
        $page_no = 1;
        ?>
        
        <form method="post" class="no-print" style="width: 200px;background:#f5f5f5;padding:10px;position:absolute;right:0;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <label>First page rows: <input required type="number" min="5" max="25" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" max="25" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <label>Blank rows: <input required type="number" min="0" max="25" name="blank_row" class="form-control" value="<?=$blank_row?>"/></label>
            <input type="hidden" name="module_id" value="1"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
            <input type="submit" name="page_setup_submit" class="btn btn-warning btn-sm"/>
        </form>
        
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
                        <h3 class="mar_0 head_font">Measurement Sheet</h3>
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
                                        <p class="mar_0">Article No.: <?= $costing_measurement[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing_measurement[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing_measurement[0]->info ?></p>
                                        
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
                                
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Date Printed: <?= date('d-m-Y') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr #</th>    
                                    <th>Group</th>
                                    <th>Item</th>
                                    <th class="text-right">Length</th>
                                    <th class="text-right">Width</th>
                                    <th class="text-right">Pieces</th>
                                    <th class="">Wastage</th>
                                    <th class="">Area 1</th>
                                    <th class="">Area 2</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                            <tbody class="actual_table">
                                <?php 
                                $iter = 1; 
                                // item initialisation
                                $total_length = 0;
                                $total_width = 0;
                                $total_pieces = 0;
                                $total_wastage = 0;
                                $total_area1 = 0;
                                $total_area2 = 0;
                                $last_item = '';

                                // group initialisation
                                $last_group = '';
                                $total_group_length = 0;
                                $total_group_width = 0;
                                $total_group_pieces = 0;
                                $total_group_wastage = 0;
                                $total_group_area1 = 0;
                                $total_group_area2 = 0;

                                // grand initialisation

                                $grand_length = 0;
                                $grand_width = 0;
                                $grand_pieces = 0;
                                $grand_wastage = 0;
                                $grand_area1 = 0;
                                $grand_area2 = 0;

                                $generate_iter = 23;
                                $area1 = 0;
                                $area2 = 0;

                                foreach($costing_measurement as $cm) { 
                                    // <!-- Item wise total area -->
                            $area1 = round(($cm->length * $cm->width * $cm->pieces) + (($cm->length * $cm->width * $cm->pieces * $cm->wastage_percentage) / 100), 3);
                            $area2 = ($cm->grp_value == 0) ? 0 : round($area1 / $cm->grp_value , 3);
                            
                            $count_iter = $front_page;
                            
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
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Measurement Sheet</h3>
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
                                        <p class="mar_0">Article No.: <?= $costing_measurement[0]->art_no ?></p>
                                        <p class="mar_0">Alternate Article No.: <?= $costing_measurement[0]->alt_art_no ?></p>
                                        <p class="mar_0">Article  Description: <?= $costing_measurement[0]->info ?></p>
                                        
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
                                
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p class="mar_0">Date Printed: <?= date('d-m-Y') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr #</th>    
                                    <th>Group</th>
                                    <th>Item</th>
                                    <th class="text-right">Length</th>
                                    <th class="text-right">Width</th>
                                    <th class="text-right">Pieces</th>
                                    <th class="">Wastage</th>
                                    <th class="">Area 1</th>
                                    <th class="">Area 2</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                            <tbody class="actual_table">
                            <?php }
                                    if($last_item != $cm->item_name and $iter != 1){
                                        ?>
                                        <tr style="background: #dedede">
                                            <td colspan="3">Item Sub Total for <?= $last_item ?></td>
                                            <td><?= $total_length ?></td>
                                            <td><?= $total_width ?></td>
                                            <td><?= $total_pieces ?></td>
                                            <td><?= $total_wastage ?></td>
                                            <td><?= $total_area1 ?></td>
                                            <td><?= $total_area2 ?></td>
                                            <td></td>  
                                        </tr>    
                                    <?php
                                    // Reinitiate all the values for item wise total area
                                    $total_length = 0;
                                    $total_width = 0;
                                    $total_pieces = 0;
                                    $total_wastage = 0;
                                    $total_area1 = 0;
                                    $total_area2 = 0;
                                    }
                                    ?>
                                <!-- Group wise total area -->
                                    <?php
                                    if($last_group != $cm->group_name and $iter != 1){
                                        ?>
                                    <tr style="background: #fff0de">
                                        <td colspan="3">Group Sub Total for <?= $last_group ?></td>
                                        <td><?= $total_group_length ?></td>
                                        <td><?= $total_group_width ?></td>
                                        <td><?= $total_group_pieces ?></td>
                                        <td><?= $total_group_wastage ?></td>
                                        <td><?= $total_group_area1 ?></td>
                                        <td><?= $total_group_area2 ?></td>
                                        <td></td>  
                                    </tr>    
                                    <?php
                                    // Reinitiate all the values for group wise total area
                                    $total_group_length = 0;
                                    $total_group_width = 0;
                                    $total_group_pieces = 0;
                                    $total_group_wastage = 0;
                                    $total_group_area1 = 0;
                                    $total_group_area2 = 0;
                                    }
                                    ?>


                                    <tr>
                                        <td><?= $iter++ ?></td>
                                        <td><?php $last_group = $cm->group_name;echo $cm->group_name ?></td>
                                        <td><?php $last_item = $cm->item_name; echo $cm->item_name ?></td>
                                        <td><?php 
                                            $total_length+=$cm->length;
                                            $total_group_length+=$cm->length;
                                            $grand_length+=$cm->length;
                                            echo $cm->length; 
                                        ?></td>
                                        <td><?php 
                                            $total_width+=$cm->width;
                                            $total_group_width+=$cm->width;
                                            $grand_width+=$cm->width;
                                            echo $cm->width ?>
                                            </td>
                                        <td><?php 
                                            $total_pieces+=$cm->pieces ;
                                            $total_group_pieces+=$cm->pieces;
                                            $grand_pieces+=$cm->pieces;
                                            echo $cm->pieces ?></td>
                                        <td><?php 
                                            $total_wastage+=$cm->wastage_percentage ;
                                            $total_group_wastage+=$cm->wastage_percentage ;
                                            $grand_wastage+=$cm->wastage_percentage ;
                                            echo $cm->wastage_percentage ?></td>
                                        <td><?php 
                                            $total_area1+=$area1;
                                            $total_group_area1+=$area1;
                                            $grand_area1+=$area1;
                                            echo $area1 ?></td>
                                        <td><?php 
                                            $total_area2+=$area2;
                                            $total_group_area2+=$area2;
                                            $grand_area2+=$area2;
                                            echo $area2 ?></td>
                                        <td><?= $cm->unit ?></td>    
                                    </tr>

                                <?php } ?>
                                <tr style="background: #c8dff7">
                                    <th colspan="3">Grand Total</th>
                                    <tH><?= $grand_length ?></th>
                                    <th><?= $grand_width ?></th>
                                    <th><?= $grand_pieces ?></th>
                                    <th><?= $grand_wastage ?></th>
                                    <th><?= $grand_area1 ?></th>
                                    <th><?= $grand_area2 ?></th>
                                    <td></td>  
                                </tr>    
                            </tbody>
                        </table>
                    </div>
        </section>
    </body>
</html>
