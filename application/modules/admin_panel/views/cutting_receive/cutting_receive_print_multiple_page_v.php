

<?php 


if(count($page_setup) > 0) {
    $front_page = $page_setup[0]->front_page;
    $other_page = $page_setup[0]->other_page;
    $blank_row = $page_setup[0]->blank_row;
} else {
    $front_page = 4;
    $other_page = 6;
    $blank_row = 6;    
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Print | Cutter Receipt</title>

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
            
            body.A4 .sheet {
            width: 210mm;
            height: auto;
            }
            
            .padding-10mm {
            padding: 1mm;
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
            
            
            .no-print {display: none;}
            
            
            .mar_bot_3{
                margin-bottom: 3px
            }

            .header_left, .header_right{
                height: 107px;
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
            .height_100{ height: 120px }

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
                
                
                .no-print {display: none;}
                
                
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content">
        
        
        <form method="post" class="no-print" style="width: 200px;background:#f5f5f5;padding:10px;position:absolute;right:0;box-shadow: 0px 0px 2px 1px #c1c1c1;">
            <label>First page rows: <input required type="number" min="1" name="first_page_row" class="form-control" value="<?=$front_page?>"/></label>
            <label>Other page rows: <input required type="number" min="5" name="other_page_row" class="form-control" value="<?=$other_page?>"/></label>
            <label>Blank rows: <input required type="number" min="0" max="25" name="blank_row" class="form-control" value="<?=$blank_row?>"/></label>
            <input type="hidden" name="module_id" value="8"/>
            <input type="hidden" name="user_id" value="<?=$this->session->user_id?>"/>
            <input type="submit" name="page_setup_submit" class="btn btn-warning btn-sm"/>
        </form>
        
        
                <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm">
            <?php
        $page_no = 1;
        ?>
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
                                <div class="col-sm-12 border_all height_120">
                                    <div class="">
                                        <?php
                $temp_co_name_array = array();                         
                                        foreach($datam as $co_name) {
            if(!in_array($co_name->cut_rcv_number, $temp_co_name_array)){
                array_push($temp_co_name_array, $co_name->cut_rcv_number);
            }
        }
                                         ?>
                                        <h5 class="mar_0"><b>Rcpt. No.</b>: <?= implode(', ', $temp_co_name_array) ?></h5>
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

                                    $groups = array();
                                    foreach ($datam as $item) {
                                        $key = $item->cut_rcv_number;
                                        if (!isset($groups[$key])) {
                                            $groups[$key] = array(
                                                'ord_nu' => $item->cut_rcv_number,
                                                'gr_sum' => $item->receive_cut_quantity
                                            );
                                        } else {
                                            $groups[$key]['ord_nu'] = $item->cut_rcv_number;
                                            $groups[$key]['gr_sum'] += $item->receive_cut_quantity;
                                        }
                                    }


                                    $total_receive_cut_quantity = 0;
                                    $grand_total_receive_cut_quantity = 0;
                                    $new_iter = 27;
                                    $iter = 1;
                                    $sr_iter = 1;
                                    $tot_qnty = 0;
                                    $tot_amnt = 0;
                                    $nr=5;
                                    $count_iter = $front_page;
                                    foreach($datam as $curr_key=>$d) {
                                    $keys = array();
                                    foreach($datam as $key=>$val) {
                                        if ($val->cut_rcv_number == $d->cut_rcv_number) {
                                            array_push($keys, $key);
                                        }
                                    }
                                    if ($iter == $front_page or $iter == $count_iter) {
                                            $page_no += 1;
                                            $count_iter += $other_page;
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
                                <div class="col-sm-12 border_all height_120">
                                    <div class="">
                                        <h5 class="mar_0"><b>Rcpt. No.</b>: <?= implode(', ', $temp_co_name_array) ?></h5>
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
                                        
                                        <th>Challan</th>
                                        <th>Order No.</th>
                                        <th>Article</th>
                                        <th>Colour</th>
                                        <th class="text-right">Qnty</th>
                                        <th>Part</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
</div>
</div>
</section>
</body> 
                                   <?php }
                                    ?>
                                    <tr>
                                        <td nowrap><?= $d->cut_rcv_number ?></td>
                                        <td nowrap><?= $d->co_no ?></td>
                                        <td><?= $d->art_no ?></td>
                                        <td><?= $d->leather_color ?>/<?= $d->fitting_color ?></td>
                                        <td class="text-right">
                                        <?php echo $d->receive_cut_quantity;
                                        $total_receive_cut_quantity += $d->receive_cut_quantity;
                                        $grand_total_receive_cut_quantity += $d->receive_cut_quantity;
                                         ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    if(end($keys) == $curr_key) {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-left"><b>Order Total For <?= $d->cut_rcv_number ?></b></td>
                                            <td  class="text-right" style="font-weight: bold; font-size: 14px" class="text-right"><?= $groups[$d->cut_rcv_number]['gr_sum'] ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    
                                    $last_iter = $iter;
                            $last_page_no = $page_no;
                            $iter++;
                                    
                                    
                                ?>
                                    <?php
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

                            for ($i = 1; $i < $blank_row; $i++) {
                                ?>
                                <tr>
                                    <!--<td>&nbsp;</td>-->
                                    <!--<td>&nbsp;</td>-->
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                        ?>
                        
                        
                        <tr>
                                            <td colspan="4" class="text-left"><b>Grand total</b></td>
                                            <td  class="text-right" style="font-weight: bold; font-size: 14px" class="text-right"><?=  $grand_total_receive_cut_quantity  ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    
                                    
                                </tbody>
                        </table>                        
                    </div>
                </div>

            </div>
        </section>


    </body>
</html>
