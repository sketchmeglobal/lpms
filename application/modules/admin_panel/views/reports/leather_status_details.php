    
<?php 
// echo '<pre>'; print_r($status_details);
// echo '<pre>', print_r($status_row), '</pre>';

// update total row for po pending
if(isset($status_details)){
    foreach($status_details as $key=>$inner_leather){
        foreach($inner_leather as $sd){ 

            // pending P.O. area
            if($search_type == 'print_po' and (round($sd->cut_rcvd_qnty, 2) == round($sd->cut_issue_qnty, 2))){
                if(!empty($sd->cut_issue_qnty) or !empty($sd->cut_rcvd_qnty)){
                    $status_row[$key] = $status_row[$key]-1;
                }
            }
        }
    }
}
if(isset($status_details_comb)){
    foreach($status_details_comb as $key=>$inner_leather){
        foreach($inner_leather as $sd){ 
            // pending P.O. area
            if($search_type == 'print_po' and (round($sd->cut_rcvd_qnty, 2) == round($sd->cut_issue_qnty, 2))){
                if(!empty($sd->cut_issue_qnty) or !empty($sd->cut_rcvd_qnty)){
                    $status_row_comb[$key] = $status_row[$key]-1;
                }
            }
        }
    }
}
// update total row for po pending ends

function fetch_item_details($id_id){
    $CI =& get_instance();
    return $CI->db
        ->select("CONCAT(item_master.item, ' (' ,colors.color, ')') AS item_dtls")
        ->join('item_master','item_master.im_id = item_dtl.im_id','left')
        ->join('colors','colors.c_id = item_dtl.c_id','left')
        ->get_where('item_dtl', array('item_dtl.id_id' => $id_id))->row()->item_dtls;
}

function fetch_current_stock($id_id){
    $CI =& get_instance();

    $opening_stock = $CI->db->select('opening_stock')
        ->get_where('item_dtl', array('id_id' => $id_id))
        ->row()->opening_stock;

    $pur_rcv_row = $CI->db->select('SUM(item_quantity) AS item_quantity')
        ->group_by('id_id')
        ->get_where('purchase_order_receive_detail', array('id_id' => $id_id))
        ->row();

    if(count($pur_rcv_row) > 0){
        $pur_rcv = $pur_rcv_row->item_quantity;
    } else{
        $pur_rcv = 0;
    }

    $stock_in_row = $CI->db->select('SUM(item_quantity) AS item_quantity')
        ->group_by('id_id')
        ->get_where('stock_in_detail', array('id_id' => $id_id))
        ->row();
    if(count($stock_in_row) > 0){
        $stock_in = $stock_in_row->item_quantity;
    } else{
        $stock_in = 0;
    }

    $material_issue_row = $CI->db->select('SUM(issue_quantity) AS issue_quantity')
        ->group_by('id_id')
        ->get_where('material_issue_detail', array('id_id' => $id_id))
        ->row();
    if(count($material_issue_row) > 0){
        $material_issue = $material_issue_row->issue_quantity;
    } else{
        $material_issue = 0;
    }

    return round(($opening_stock + $pur_rcv + $stock_in) - $material_issue, 2);

}

function fetch_po_pending($id_id){
    $CI =& get_instance();

    $pur_order_row = $CI->db->select('SUM(pod_quantity) AS pod_quantity')
        ->group_by('id_id')
        ->get_where('purchase_order_details', array('id_id' => $id_id))
        ->row();

    if(count($pur_order_row) > 0){
        $pur_order = $pur_order_row->pod_quantity;
    } else{
        $pur_order = 0;
    }

    $supp_pur_order_row = $CI->db->select('SUM(item_qty) AS item_qty')
        ->group_by('id_id')
        ->get_where('supp_purchase_order_detail', array('id_id' => $id_id))
        ->row();

    if(count($supp_pur_order_row) > 0){
        $supp_pur_order = $supp_pur_order_row->item_qty;
    } else{
        $supp_pur_order = 0;
    }

    $pur_rcv_row = $CI->db->select('SUM(item_quantity) AS item_quantity')
        ->group_by('id_id')
        ->get_where('purchase_order_receive_detail', array('id_id' => $id_id))
        ->row();

    if(count($pur_rcv_row) > 0){
        $pur_rcv = $pur_rcv_row->item_quantity;
    } else{
        $pur_rcv = 0;
    }

    return round(($supp_pur_order + $pur_order) - $pur_rcv, 2);

}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Leather Status | Shilpa Overseas</title>

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
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 16px}

            .border-bottom{border-bottom:  1px solid #000}
            
            .text-right{text-align: right!important;}
            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 16px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000} .text-right{text-align: right!important;}
                .no-print{display: none}
            }
        </style>
    </head>

    <body class="A4" id="page-content" >
        <section class="sheet padding-10mm" style="height: auto;">
            <header class="pull-right"></header>
            <div class="clearfix"></div>
            <div class="container">
                <div class="row border_all text-center text-uppercase mar_bot_3">
                    <h3 class="mar_0 head_font">Leather Status</h3>
                </div>
                <div class="row mar_bot_3">
                    <div class="col-sm-6 border_all header_left">
                        <!-- <p class="mar_0"><strong>Sender</strong></p> -->
                        <h4  class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
                        <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
                        <p class="mar_0">PHONE: +91 2573-3470/71/72/2405</p>
                    </div>
                    <div class="col-sm-6 header_right">
                        <div class="row mar_bot_3">
                            <div class="col-sm-12 border_all height_60">
                                <p><strong>Date:</strong> <?=date('d-m-Y')?></p>
                                <p><strong>Search Type:</strong> <?=($search_type == 'print_po') ? 'Print Pending Orders' : 'Print All' ?></p>
                            </div>
                        </div>
                        <div class="row border_all height_63 mar_bot_3">
                            <div class="col-sm-12"></div>
                        </div>
                        <div class="row border_all height_21">
                            <div class="col-sm-12"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="">Order No.</th>
                                <th class="text-right">Order Pending</th>
                                <th class="text-right">Cutting Issue</th>
                                <th class="">Cutting Rcvd.</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $co_array = array();
                                $inner_iter = 1;
                                $iter = 1; 
                                $fin_cur_stock = $fin_po_pend = $row_cur_stock = $row_po_pend = 0;
                                $fin_ord_pend = $fin_cut_iss = $fin_cut_rcv = $sub_ord_pend = $sub_cut_iss = $sub_cut_rcv = 0;
                                if(isset($status_details)){
                                    foreach($status_details as $key=>$inner_leather){
                                        foreach($inner_leather as $sd){ 

                                            // pending P.O. area
                                            if($search_type == 'print_po' and (round($sd->cut_rcvd_qnty, 2) == round($sd->cut_issue_qnty, 2))){
                                                if(!empty($sd->cut_issue_qnty) or !empty($sd->cut_rcvd_qnty)){
                                                    continue;   
                                                }
                                            }
                                            // pending P.O. area

                                            if(!in_array($sd->org_id_id, $co_array)){
                                                array_push($co_array, $sd->org_id_id);
                                                $inner_iter = 1;
                                                ?>
                                                <tr style="background-color: #b6d4ed">
                                                    <th colspan="5">
                                                        <?=fetch_item_details($sd->org_id_id)?>
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-right"><?=$iter++?>.</td>
                                                <!-- <td>< ?=fetch_item_details($sd->id_id)?></td> -->
                                                <td><?=$sd->co_no?></td>
                                                <!-- <td class="text-right"></td> -->
                                                <td class="text-right">
                                                    <?php 
                                                        echo $row_ord_pend = round($sd->co_qnty, 2) - round($sd->cut_issue_qnty, 2);
                                                        $sub_ord_pend += $row_ord_pend;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php
                                                        echo $row_cut_iss = $sd->cut_issue_qnty;
                                                        $sub_cut_iss += $row_cut_iss;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        echo $row_cut_rcv = $sd->cut_rcvd_qnty;
                                                        $sub_cut_rcv += $row_cut_rcv;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php 
                                            $inner_iter++;
                                            if($status_row[$key] == ($inner_iter - 1)){
                                                ?>
                                                <tr style="background: beige;">
                                                    <td colspan="2">
                                                        <!-- <b>Total For</b> < ?=fetch_item_details($sd->org_id_id)?>:<br> -->
                                                        <b>Current Stock:</b> <?php echo $row_cur_stock = fetch_current_stock($sd->org_id_id); $fin_cur_stock += $row_cur_stock?> || 
                                                        <b>P.O. Pending:</b> <?php echo $row_po_pend = fetch_po_pending($sd->org_id_id); $fin_po_pend += $row_po_pend?> || 
                                                        <b>Balance:</b> 
                                                        <?php 
                                                            $rv = ($row_ord_pend + $row_cut_iss) - ($row_cut_rcv + $row_cur_stock + $row_po_pend); 
                                                            if($rv > 0){
                                                                echo '<label style="color: red">'.$rv.'</label>';
                                                            }else{
                                                                echo '<label style="color: blue">'.$rv.'</label>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <th class="text-right"><?php echo $sub_ord_pend;$fin_ord_pend += $sub_ord_pend?></th>
                                                    <th class="text-right"><?php echo $sub_cut_iss; $fin_cut_iss += $sub_cut_iss; ?></th>
                                                    <th class="text-right"><?php echo $sub_cut_rcv; $fin_cut_rcv += $sub_cut_rcv;?></th>
                                                </tr>
                                                <?php
                                            }
                                            // GRAND TOTAL
                                            if($iter == (array_sum($status_row) + 1)){
                                                ?>
                                                <tr style="background: #bfffc9;">
                                                    <td colspan="2">
                                                        <!-- <b>Grand Total :<br> -->
                                                        <b>Grand Current Stock:</b> <?=$fin_cur_stock?> || 
                                                        <b>Grand P.O. Pending:</b> <?= $fin_po_pend ?>
                                                    </td>
                                                    <th class="text-right"><?=$fin_ord_pend?></th>
                                                    <th class="text-right"><?=$fin_cut_iss?></th>
                                                    <th class="text-right"><?=$fin_cut_rcv?></th>
                                                </tr>
                                                <?php
                                            }    
                                        }
                                    }
                                }
                            ?>

                        </tbody>        
                    </table>
                </div>

                <!-- COMBINATION AREA -->
                <div class="row" style="margin-top:20px">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-right">#</th>
                                <th class="">Order No.</th>
                                <th class="text-right">Order Pending</th>
                                <th class="text-right">Cutting Issue</th>
                                <th class="">Cutting Rcvd.</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $co_array = array();
                                $inner_iter = 1;
                                $iter = 1; 
                                $fin_cur_stock = $fin_po_pend = $row_cur_stock = $row_po_pend = 0;
                                $fin_ord_pend = $fin_cut_iss = $fin_cut_rcv = $sub_ord_pend = $sub_cut_iss = $sub_cut_rcv = 0;
                                if(isset($status_details_comb)){
                                    foreach($status_details_comb as $key=>$inner_leather){
                                        foreach($inner_leather as $sd){ 

                                            // pending P.O. area
                                            if($search_type == 'print_po' and (round($sd->cut_rcvd_qnty, 2) == round($sd->cut_issue_qnty, 2))){
                                                if(!empty($sd->cut_issue_qnty) or !empty($sd->cut_rcvd_qnty)){
                                                    continue;   
                                                }
                                            }

                                            if(!in_array($sd->org_id_id, $co_array)){
                                                array_push($co_array, $sd->org_id_id);
                                                $inner_iter = 1;
                                                ?>
                                                <tr style="background-color: #b6d4ed">
                                                    <th colspan="5">
                                                        <?=fetch_item_details($sd->org_id_id)?>
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-right"><?=$iter++?>.</td>
                                                <!-- <td>< ?=fetch_item_details($sd->org_id_id)?></td> -->
                                                <td><?=$sd->co_no?></td>
                                                <!-- <td class="text-right"></td> -->
                                                <td class="text-right">
                                                    <?php 
                                                        echo $row_ord_pend = round($sd->co_qnty, 2) - round($sd->cut_issue_qnty, 2);
                                                        $sub_ord_pend += $row_ord_pend;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php
                                                        echo $row_cut_iss = $sd->cut_issue_qnty;
                                                        $sub_cut_iss += $row_cut_iss;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        echo $row_cut_rcv = $sd->cut_rcvd_qnty;
                                                        $sub_cut_rcv += $row_cut_rcv;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php 
                                            $inner_iter++;
                                            if($status_row_comb[$key] == ($inner_iter - 1)){
                                                ?>
                                                <tr style="background: beige;">
                                                    <td colspan="2">
                                                        <!-- <b>Total For</b> < ?=fetch_item_details($sd->org_id_id)?>:<br> -->
                                                        <b>Current Stock:</b> <?php echo $row_cur_stock = fetch_current_stock($sd->org_id_id); $fin_cur_stock += $row_cur_stock?> || 
                                                        <b>P.O. Pending:</b> <?php echo $row_po_pend = fetch_po_pending($sd->org_id_id); $fin_po_pend += $row_po_pend?> || 
                                                        <b>Balance:</b> 
                                                        <?php 
                                                            $rv = ($row_ord_pend + $row_cut_iss) - ($row_cut_rcv + $row_cur_stock + $row_po_pend); 
                                                            if($rv > 0){
                                                                echo '<label style="color: red">'.$rv.'</label>';
                                                            }else{
                                                                echo '<label style="color: blue">'.$rv.'</label>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <th class="text-right"><?php echo $sub_ord_pend;$fin_ord_pend += $sub_ord_pend?></th>
                                                    <th class="text-right"><?php echo $sub_cut_iss; $fin_cut_iss += $sub_cut_iss; ?></th>
                                                    <th class="text-right"><?php echo $sub_cut_rcv; $fin_cut_rcv += $sub_cut_rcv;?></th>
                                                </tr>
                                                <?php
                                            }
                                            // GRAND TOTAL
                                            if($iter == (array_sum($status_row_comb) + 1)){
                                                ?>
                                                <tr style="background: #bfffc9;">
                                                    <td colspan="2">
                                                        <!-- <b>Grand Total :<br> -->
                                                        <b>Grand Current Stock:</b> <?=$fin_cur_stock?> || 
                                                        <b>Grand P.O. Pending:</b> <?= $fin_po_pend ?>
                                                    </td>
                                                    <th class="text-right"><?=$fin_ord_pend?></th>
                                                    <th class="text-right"><?=$fin_cut_iss?></th>
                                                    <th class="text-right"><?=$fin_cut_rcv?></th>
                                                </tr>
                                                <?php
                                            }    
                                        }
                                    }
                                }
                            ?>

                        </tbody>        
                    </table>
                </div>
            </div>
        </section> 
             
    </body>
</html>
