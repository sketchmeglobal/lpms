<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<?php if ($segment == 'leather_status' || $segment == 'leather_status_pending_orders')
{ ?>
		<?php if ($segment == 'leather_status' || $segment == 'leather_status_pending_orders')
    { ?>
	<title>LEATHER STATUS</title>
	<?php
    }
    else
    { ?>
	<title>ITEM STATUS</title> 
	<?php
    } ?>
	<?php
}
else if ($segment == 'leather_status_po')
{ ?>
		<?php if ($segment == 'leather_status')
    { ?>
	<title>LEATHER STATUS</title>
	<?php
    }
    else
    { ?>
	<title>ITEM STATUS</title> 
	<?php
    } ?>
    <?php
}
else if ($segment == 'checking_stock_summary_status')
{ ?>
    <title>STOCK SUMMARY STATUS</title>
    <?php
}
else if ($segment == 'checking_stock_detail_ledger')
{ ?>
    <title>STOCK DETAIL LEDGER</title>
    <?php
}
else if ($segment == 'outstanding_report')
{ ?>
    <title>OUTSTANDING REPORT</title>
    <?php
}
else if ($segment == 'outstanding_report_groupwise')
{ ?>
    <title>OUTSTANDING REPORT</title>
    <?php
}
else if ($segment == 'jobber_ledger_status_report')
{ ?>
    <title>JOBBER LEDGER</title>
    <?php
}
else if ($segment == 'jobber_ledger_status_report_non_zero')
{ ?>
    <title>JOBBER LEDGER</title>
    <?php
}
else if ($segment == 'checking_summary_status')
{ ?>
    <title>CHECKING SUMMARY STATUS</title>
    <?php
}
else if ($segment == 'checking_entry_sheet_status')
{ ?>
    <title>CHECKING ENTRY SHEET</title>
    <?php
}
else if ($segment == 'checking_stock_summary_status')
{ ?>
    <title>CHECKING STOCK SUMMARY</title>
    <?php
}
else if ($segment == 'checking_stock_detail_ledger')
{ ?>
    <title>CHECKING STOCK DETAIL LEDGER</title>
    <?php
}
else if ($segment == 'supplier_wise_item_position')
{ ?>
    <title>SUPPLIER WISE ITEM POSITION</title>
    <?php
}
else if ($segment == 'supplier_purchase_ledger')
{ ?>
    <title>SUPPLIER PURCHASE LEDGER</title>
    <?php
}
else if ($segment == 'supplier_wise_purchase_position')
{ ?>
    <title>SUPPLIER WISE PURCHASE POSITION</title>
    <?php
}
else if ($segment == 'supplier_purchase_ledger_wo_zero')
{ ?>
    <title>SUPPLIER WISE PURCHASE POSITION</title>
    <?php
}
else if ($segment == 'supplier_wise_item_position_brkup_details')
{ ?>
    <title>SUPPLIER WISE PURCHASE POSITION</title>
    <?php
}
else if ($segment == 'group_stock_summary')
{ ?>
    <title>GROUP STOCK SUMMARY</title>
    <?php
}
else if ($segment == 'jobber_bill_summary')
{ ?>
    <title>JOBBER BILL SUMMARY</title>
    <?php
}
else if ($segment == 'cutter_bill_summary')
{ ?>
    <title>CUTTER BILL SUMMARY</title>
    <?php
}
else if ($segment == 'monthly_production_status')
{ ?>
    <title>MONTHLY PROCUCTION STATUS</title>
    <?php
}
else if ($segment == 'fetch_production_register')
{ ?>
    <title>PRODUCTION REGISTER</title>
    <?php
}
else if ($segment == 'outstanding_report')
{ ?>
    <title>OUTSTANDING REPORT</title>
    <?php
}
else if ($segment == 'outstanding_report_groupwise')
{ ?>
    <title>OUTSTANDING REPORT</title>
    <?php
}
else if ($segment == 'payroll_reports_advance_ledger')
{ ?>
    <title>PAYROLL ADVANCE LEDGER</title>
    <?php
}
else if ($segment == 'payroll_reports_leave')
{ ?>
    <title>LEAVE REPORT</title>
    <?php
}
else if ($segment == 'payroll_esi_pf')
{ ?>
    <title>ESI REPORT</title>
    <?php
}
else if ($segment == 'payroll_register')
{ ?>
    <title>PAYROLL REGISTER</title>
    <?php
}
else if ($segment == 'payroll_pf')
{ ?>
    <title>PF REPORT</title>
    <?php
}
else if ($segment == 'ot_details')
{ ?>
    <title>OVERTIME REPORT</title>
    <?php
}
else if ($segment == 'article_master_report_section')
{ ?>
    <title>ARTICLE RATE REPORT</title>
    <?php
}
else if ($segment == 'overtime_checking_entry_details')
{ ?>
    <title>OVERTIME CHECKING REPORT</title>
    <?php
}
else if ($segment == 'purchase_order_rate_setup_details')
{ ?>
    <title>PURCHASE RATE DETAILS</title>
    <?php
}
else if ($segment == 'item_status')
{ ?>
    <title>ITEM STATUS DETAILS</title>
	<?php
}
else if($segment == 'payroll_reports_advance_ledger')
{ ?>
    <title>EMPLOYEE ADVANCE LEDGER</title>
	<?php
}
else if($segment == 'payroll_reports_leave')
{ ?>
    <title>EMPLOYEE LEAVE</title>
	<?php
}
else if($segment == 'payroll_attendance')
{ ?>
    <title>EMPLOYEE ATTENDANCE</title>
	<?php
}
else if($segment == 'payroll_esi_pf')
{ ?>
    <title>ESI DETAILS</title>
	<?php
}
else if($segment == 'payroll_register')
{ ?>
    <title>PAYROLL REGISTER</title>
	<?php
}
else if($segment == 'payroll_pf')
{ ?>
    <title>PF DETAILS</title>
	<?php
}
else if($segment == 'ot_details')
{ ?>
    <title>OT DETAILS</title>
	<?php
}
else if($segment == 'salary_overtime_details')
{ ?>
    <title>SALARY OVERTIME DETAILS</title>
	<?php
}


else if($segment == 'material_issue_status_report')
{ ?>
    <title>MATERIAL ISSUE REPORT</title>
	<?php
}


else if($segment == 'buyerwise_shipment_details')
{ ?>
    <title>SHIPMENT REPORT</title>
	<?php
}


else
{ ?>
    <title>ORDER STATUS</title>
	<?php
} ?>
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
		            .padding-5mm{padding: 5mm;}
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
		                height: 75px
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
		
		            .border-bottom{border-bottom:  1px solid #000}.text-center{text-align: center!important;}.text-right{text-align: right!important;}
		        
		            /*@page { size: A4 }*/
		
		            @media print{
		                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid black!important;}
		                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
		                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
		                .text-center{text-align: center!important;}.text-right{text-align: right!important;}
		                .print-text-center{text-align:center!important}
		            }
		table.order-summary th {position: relative;}		            
		table.order-summary span{left: 0;background: #d4ecea;position: absolute;bottom: 0;width: 100%;text-align: right;border-top: 1px solid;color: #000;font-size: 10px;}
	</style>
</head>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body>
	<div class="A4" id="page-content">
	<?php

// print_r($temp_co_name_array);die;

?>

	<?php if ($segment == 'article_wise_order_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Article</th>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Skiv Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
										<?php
    $qtty1 = 0;
    $qtty2 = 0;
    $qtty3 = 0;
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    $groups = array();
    foreach ($result as $fasss)
    {
        foreach ($fasss as $fass) {
            $key = $fass->am_id.'-'.$fass->c_id;
            if (!isset($groups[$key]))
            {
                $groups[$key] = array(
                    'co_quantity' => $fass->co_quantity,
                    'cutting_issued_qnty' => $fass->cutting_issued_qnty,
                    'cutting_received_qnty' => $fass->cutting_received_qnty,
                    'cutting_balanced_qnty' => ($fass->cutting_issued_qnty - $fass->cutting_received_qnty),
                    'skiving_issued' => $fass->skiving_issued,
                    'skiving_receive_qnty' => $fass->skiving_receive_qnty,
                    'skiving_balance_qnty' => ($fass->cutting_received_qnty - $fass->skiving_receive_qnty),
                    'jobber_issue_qnty' => $fass->jobber_issue_qnty,
                    'jobber_receive_qnty' => $fass->jobber_receive_qnty,
                    'jobber_balance_qnty' => ($fass->jobber_issue_qnty - $fass->jobber_receive_qnty),
                    'packing_shipment_quantity' => $fass->packing_shipment_quantity
                );
            }
            else
            {
                $groups[$key]['co_quantity'] += $fass->co_quantity;
                $groups[$key]['cutting_issued_qnty'] += $fass->cutting_issued_qnty;
                $groups[$key]['cutting_received_qnty'] += $fass->cutting_received_qnty;
                $groups[$key]['cutting_balanced_qnty'] += ($fass->cutting_issued_qnty - $fass->cutting_received_qnty);
                $groups[$key]['skiving_issued'] += $fass->cutting_received_qnty;
                $groups[$key]['skiving_receive_qnty'] += $fass->skiving_receive_qnty;
                $groups[$key]['skiving_balance_qnty'] += ($fass->cutting_received_qnty - $fass->skiving_receive_qnty);
                $groups[$key]['jobber_issue_qnty'] += $fass->jobber_issue_qnty;
                $groups[$key]['jobber_receive_qnty'] += $fass->jobber_receive_qnty;
                $groups[$key]['jobber_balance_qnty'] += ($fass->jobber_issue_qnty - $fass->jobber_receive_qnty);
                $groups[$key]['packing_shipment_quantity'] += $fass->packing_shipment_quantity;
            }
        }
    }
    foreach ($result as $resl)
    {
        foreach($resl as $curr_key => $res) {
            $keys = array();
            foreach ($resl as $key => $val)
            {
                if ($val->am_id.'-'.$val->c_id == $res->am_id.'-'.$res->c_id)
                {
                    array_push($keys, $key);
                }
            }
         ?>

											<tr>
												<th nowrap style="font-size: 12px"><?=$res->art_no
?> [ <?= $res->color ?> ]</th>
												<th nowrap style="font-size: 12px"><?=$res->co_no
?></th>
												<td class="text-right">
												<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
														</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_skv_isu, $res->cutting_received_qnty);
        array_push($grand_total1_skv_isu, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->skiving_receive_qnty;
        array_push($grand_total_skv_rcv, $res->skiving_receive_qnty);
        array_push($grand_total1_skv_rcv, $res->skiving_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $skv_balc = $res->cutting_received_qnty - $res->skiving_receive_qnty;
        echo $skv_balc;
        array_push($grand_total_skv_balc, $skv_balc);
        array_push($grand_total1_skv_balc, $skv_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
												</td>
												
												<?php if($res->pack_status == 1) { 
                                                    $qtty = $res->packing_shipment_quantity;
												 } else {
												    $qtty = 0;
												 }?>

												<td class="text-right">
												    <?php
        echo $qtty;
        $qtty1 += $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_remn = $res->co_quantity - $qtty;
        $qtty2 += ($res->co_quantity - $qtty);
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        $qtty3 += ($res->jobber_receive_qnty - $qtty);
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
												</td>
											</tr>
											<?php
            if (end($keys) == $curr_key)
            {
?>
                                        <tr style="background-color: #d4ecea;">
                                            <th colspan="2">Total</th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['co_quantity'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['cutting_issued_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['cutting_received_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['cutting_balanced_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['skiving_issued'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['skiving_receive_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['skiving_balance_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['jobber_issue_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['jobber_receive_qnty'] ?></th>
                                            <th class="text-right"><?=$groups[$res->am_id.'-'.$res->c_id]['jobber_balance_qnty'] ?></th>
                                            <th class="text-right"><?=  $qtty1  ?></th>
                                            <th class="text-right"><?=  $qtty2  ?></th>
                                            <th class="text-right"><?=  $qtty3   ?></th>
                                        </tr>
                                        <?php
                                        $qtty1 = 0;
                                        $qtty2 = 0;
                                        $qtty3 = 0;
            }
?>
											<?php
        $show_iter++;
    }
    if (end($resl))
    {
?>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
    }
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'buyer_wise_order_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Skiv Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
										<?php
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    foreach ($result as $res)
    {
        if (!in_array($res->co_no, $co_array))
        {
            array_push($co_array, $res->co_no);
            if ($order_iter++ == 1)
            {
                // continue;
                
            }
        }
        if ($show_iter == 26 or $show_iter == $new_show_iter)
        {
            $new_show_iter += 25;
?>
												
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
        <section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Skiv Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php
        } ?>

											<tr>
												<th nowrap style="font-size: 12px"><?=$res->name
?></th>
												<th nowrap style="font-size: 12px"><?=$res->co_no
?></th>
												<td class="text-right">
												<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
														</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_skv_isu, $res->cutting_received_qnty);
        array_push($grand_total1_skv_isu, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->skiving_receive_qnty;
        array_push($grand_total_skv_rcv, $res->skiving_receive_qnty);
        array_push($grand_total1_skv_rcv, $res->skiving_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $skv_balc = $res->cutting_received_qnty - $res->skiving_receive_qnty;
        echo $skv_balc;
        array_push($grand_total_skv_balc, $skv_balc);
        array_push($grand_total1_skv_balc, $skv_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
												</td>
												
												<?php if($res->pack_status == 1) { 
                                                    $qtty = $res->packing_shipment_quantity;
												 } else {
												    $qtty = 0;
												 }?>

												<td class="text-right">
												    <?php
        echo $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
												</td>
											</tr>
											<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

<?php if ($segment == 'buyerwise_shipment_details')
{
    // echo '<pre>',print_r($result),'</pre>';
?>
		<section class="A4 sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Shipment Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th class="text-center">SHIPMENT <br/> DATE</th>
											<th class="text-center">INVOICE <br/> NUMBER</th>
											<th class="text-center">BUYER'S <br/> NAME</th>
											<th class="text-center">MODE <br/> OF <br/> SHIPMENT</th>
											<th class="text-right">QNTY <br/> (BAG)</th>
											<th class="text-right">QNTY <br/> (SLG)</th>
											<th class="text-right">QNTY <br/> (BELT)</th>
											<th class="text-right">QNTY <br/> TOTAL</th>
										</tr>
									</thead>
									<tbody>
										<?php
    $groups = array();
    foreach ($result as $fass)
    {
            $key = date("F", strtotime($fass->office_invoice_date));
            if (!isset($groups[$key]))
            {
                $groups[$key] = array(
                    'total_quantity' => $fass->total_quantity,
                );
            }
            else
            {
                $groups[$key]['total_quantity'] += $fass->total_quantity;
            }
    }
    
    
    $total_qntys = 0;
    $total_qntys1 = 0;
    $total_qntys2 = 0;
    $total_qntys3 = 0;
    $total_qntys11 = 0;
    $total_qntys22 = 0;
    $total_qntys33 = 0;
    
    
    $this->db->select('SUM(office_invoice_detail.quantity) AS total_quantity_deptwise, departments.department');
                $this->db->join('office_invoice_detail', 'office_invoice_detail.office_invoice_id = office_invoice.office_invoice_id', 'left');
                $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
                $this->db->join('user_details', 'user_details.user_id = customer_order.user_id', 'left');
                $this->db->join('departments', 'departments.d_id = user_details.user_dept', 'left');
                if($from != '' or $to != '') {
                        $this->db->where('office_invoice.office_invoice_date >=', $from);
                        $this->db->where('office_invoice.office_invoice_date <=', $to);
                    }
                $this->db->where_in('office_invoice.am_id', $buyers_id);
                $this->db->group_by('departments.d_id');
                $deptwise_total_for_all_invoice= $this->db->get_where('office_invoice', array('office_invoice.status' => 1))->result();
    
    
    foreach ($result as $curr_key => $res)
    {
        
        $keys = array();
            foreach ($result as $key => $val)
            {
                if (date("F", strtotime($val->office_invoice_date)) == date("F", strtotime($res->office_invoice_date)))
                {
                    array_push($keys, $key);
                }
            }
            
            
            $this->db->select('SUM(office_invoice_detail.quantity) AS total_quantity_deptwise, departments.department');
                $this->db->join('office_invoice_detail', 'office_invoice_detail.office_invoice_id = office_invoice.office_invoice_id', 'left');
                $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
                $this->db->join('user_details', 'user_details.user_id = customer_order.user_id', 'left');
                $this->db->join('departments', 'departments.d_id = user_details.user_dept', 'left');
                $this->db->where_in('office_invoice.office_invoice_id', $res->office_invoice_id);
                $this->db->where('departments.d_id', 1);
                $deptwise_total_bag= $this->db->get_where('office_invoice', array('office_invoice.status' => 1))->row();
                
                $this->db->select('SUM(office_invoice_detail.quantity) AS total_quantity_deptwise, departments.department');
                $this->db->join('office_invoice_detail', 'office_invoice_detail.office_invoice_id = office_invoice.office_invoice_id', 'left');
                $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
                $this->db->join('user_details', 'user_details.user_id = customer_order.user_id', 'left');
                $this->db->join('departments', 'departments.d_id = user_details.user_dept', 'left');
                $this->db->where_in('office_invoice.office_invoice_id', $res->office_invoice_id);
                $this->db->where('departments.d_id', 2);
                $deptwise_total_slg= $this->db->get_where('office_invoice', array('office_invoice.status' => 1))->row();
                
                $this->db->select('SUM(office_invoice_detail.quantity) AS total_quantity_deptwise, departments.department');
                $this->db->join('office_invoice_detail', 'office_invoice_detail.office_invoice_id = office_invoice.office_invoice_id', 'left');
                $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
                $this->db->join('user_details', 'user_details.user_id = customer_order.user_id', 'left');
                $this->db->join('departments', 'departments.d_id = user_details.user_dept', 'left');
                $this->db->where_in('office_invoice.office_invoice_id', $res->office_invoice_id);
                $this->db->where('departments.d_id', 4);
                $deptwise_total_belt= $this->db->get_where('office_invoice', array('office_invoice.status' => 1))->row();
            
            
?>


											<tr>
												<td nowrap class="text-center"><?=date("d-m-Y", strtotime($res->office_invoice_date))
?></td>
												<td nowrap class="text-center"><?=$res->office_invoice_number
?></td>

<td class="text-center"><?=$res->name
?></td>

<td class="text-center">
    <?php


                                        if($res->pre_carriage_by == 1) {
                                                echo 'By Air';
                                                } else if ($res->pre_carriage_by == 2) {
                                                echo 'By Ship';
                                                } else if ($res->pre_carriage_by == 3) {
                                                echo 'By Road';
                                                } else {
                                                echo '';
                                                }


?>
</td>

<td class="text-right">
    
    
<?php


if(count($deptwise_total_bag) > 0) {
    echo round($deptwise_total_bag->total_quantity_deptwise);
    $total_qntys1 += $deptwise_total_bag->total_quantity_deptwise;
    $total_qntys11 += $deptwise_total_bag->total_quantity_deptwise;
}


?>


</td>



<td class="text-right">
    
    
<?php


if(count($deptwise_total_slg) > 0) {
    echo round($deptwise_total_slg->total_quantity_deptwise);
    $total_qntys2 += $deptwise_total_slg->total_quantity_deptwise;
    $total_qntys22 += $deptwise_total_slg->total_quantity_deptwise;
}


?>


</td>


<td class="text-right">
    
    
<?php


if(count($deptwise_total_belt) > 0) {
    echo round($deptwise_total_belt->total_quantity_deptwise);
    $total_qntys3 += $deptwise_total_belt->total_quantity_deptwise;
    $total_qntys33 += $deptwise_total_belt->total_quantity_deptwise;
}


?>


</td>


<td class="text-right">
    
    
<?php


echo   round($res->total_quantity); $total_qntys += $res->total_quantity;


?>


</td>


											</tr>
											<?php
            if (end($keys) == $curr_key)
            {
?>
                                        <tr>
                                            <th colspan="4">Total for <?=date("F", strtotime($res->office_invoice_date))?></th>
                                            
                                            
                                            <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys1) ?>
                                                
                                                
                                                </th>
                                                
                                                
                                                <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys2) ?>
                                                
                                                
                                                </th>
                                                
                                                
                                                <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys3) ?>
                                                
                                                
                                                </th>
                                            
                                            
                                            <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($groups[date("F", strtotime($res->office_invoice_date))]['total_quantity']) ?>
                                                
                                                
                                                </th>
                                        </tr>
                                        <?php
                                        
                                        
                                        $total_qntys1 = 0;
    $total_qntys2 = 0;
    $total_qntys3 = 0;
                                        
                                        
            }
    }

?>
<tr>
                                            <th colspan="4">Grand Total</th>
                                            
                                            
                                            <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys11) ?>
                                                
                                                
                                                </th>
                                                
                                                
                                                <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys22) ?>
                                                
                                                
                                                </th>
                                                
                                                
                                                <th style="text-align: right;">
                                                
                                                
                                                
                                                <?=round($total_qntys33) ?>
                                                
                                                
                                                </th>
                                            
                                            
                                            <th style="text-align: right;">
                                                
                                                
                                                <?php echo $total_qntys  ?>
                                                
                                                
                                                </th>
                                        </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

        <?php if ($segment == 'leather_status')
        {
        // echo '<pre>',print_r($result),'</pre>';
        
        ?>
        <section class="sheet padding-5mm" style="height: auto">
        <div>
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
        <div class="row border_all text-center text-uppercase mar_bot_3">
        <?php if ($segment1 == 'leather_status')
        { ?>
        <h3 class="mar_0 head_font">Leather Status Details</h3>
        <?php
        }
        else
        { ?>
        <h3 class="mar_0 head_font">Item Status Details</h3> 
        <?php
        } ?>
        </div>
        <div class="row mar_bot_3">
        <div class="col-sm-6 border_all header_left">
        <h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
        <p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
        </div>
        <div class="col-sm-6 border_all header_right">
        <br />
        </div>
        </div>
        <!--table data-->
        <div class="row">
        <div class="container">
        <div class="row">
        	<div class="table-responsive">
        		<!--<h5>Retrieve Table</h5>-->
        		<table id="all_det" class="table table-bordered">
        			<thead>
        				<tr>
        					<th>Item Name</th>
        					<th>Order No.</th>
        					<th class="text-center">Opn. Qty.</th>
        					<th class="text-center">Ord Pending</th>
        					<th class="text-center">Cut Issue</th>
        					<th class="text-center">Cut Rcvd.</th>
        					<th class="text-center">Current Stck.</th>
        					<th class="text-center">P.O. Pending</th>
        					<th class="text-center">Balance</th>
        				</tr>
        			</thead>
        			<tbody>
        <?php
        $order_quantity = 0;
        $issue_quantity = 0;
        $order_pending = 0;
        $receive_quantity = 0;
        $open_lth = 0;
        $current_stock = 0;
        $po_pending = 0;
        $balance = 0;
        $tot_order_quantity = 0;
        $tot_issue_quantity = 0;
        $tot_order_pending = 0;
        $tot_receive_quantity = 0;
        $tot_open_lth = 0;
        $tot_current_stock = 0;
        $tot_po_pending = 0;
        $tot_balance = 0;
        ?>
        				<?php
        // echo '<pre>',print_r($result1),'</pre>';
        foreach ($result1 as $r)
        {
        $this->db->empty_table('temp_leather_consumption');
        ?>
        					<tr>
        						<th><?=$r->item_name . ' [' . $r->color . ']' ?>
        						
        						<?php $another_item_row = $this
        ->db
        ->join('item_master', 'item_master.im_id = item_mapping.buyer_item_code', 'left')
        ->join('colors', 'colors.c_id = item_mapping.buyer_item_color', 'left')
        ->get_where('item_mapping', array(
        'company_item_code' => $r->im_id,
        'company_item_color' => $r->c_id
        ))
        ->row();
        if (count($another_item_row) > 0)
        {
        ?>
            <p style="color: red; text-align: center; font-size: 14px;">**This item exist in item mapper as - 
            <br/> <b><?=$another_item_row->item . ' [' . $another_item_row->color . ']' ?></b>**</p>
                                    <?php
        } ?>
        						
        						</th>
        <?php
        // $this->db->empty_table('leather_consumption');
        $data_array = array();
        $data_array1 = array();
        $data_array2 = array();
        $new_data_array = array();
        $customer_order = array();
        
        $order_query = "SELECT 
        `customer_order_dtl`.*,
        `article_costing`.`combination_or_not`,
        `item_dtl`.`im_id`
        FROM
        `customer_order_dtl`
        LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
        LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
        LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
        WHERE
        `item_dtl`.`im_id` = $r->im_id
        GROUP BY
        `customer_order_dtl`.`co_id`,
        `item_dtl`.`im_id`,
        `customer_order_dtl`.`lc_id`
        ORDER BY
        im_id";
        $order_colour_res = $this
        ->db
        ->query($order_query)->result();
        
        //         $order_query = "SELECT
        //     `customer_order_dtl`.*,
        //     `article_costing`.`combination_or_not`,
        //     `item_dtl`.`im_id`
        // FROM
        //     `item_dtl`
        //     LEFT JOIN `article_costing_details` ON `article_costing_details`.`id_id` = `item_dtl`.`id_id`
        // LEFT JOIN `article_costing` ON `article_costing`.`ac_id` = `article_costing_details`.`ac_id`
        // LEFT JOIN `article_master` ON `article_master`.`am_id` = `article_costing`.`am_id`
        // LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
        // LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `customer_order_dtl`.`co_id`
        // WHERE
        //     `item_dtl`.`im_id` = $r->im_id
        //     GROUP BY
        //     `customer_order_dtl`.`co_id`,
        //     `customer_order_dtl`.`lc_id`,
        //     `item_dtl`.`im_id`
        //     ";
        //         $order_colour_res = $this->db->query($order_query)->result();
        $article_costing_array = array();
        foreach ($order_colour_res as $o_c_r)
        {
        if ($o_c_r->co_id == '')
        {
        continue;
        }
        if ($o_c_r->combination_or_not == 0)
        {
        $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
        $res = $this
        ->db
        ->query($query)->row();
        
        
        $query_not_comb_cutt_chln = "SELECT
        SUM(article_costing_details.quantity * cutting_issue_challan_details.cut_co_quantity) AS final_cut_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
            item_dtl.im_id, customer_order_dtl.lc_id";
        
        $result_not_comb_cutt_chln = $this
        ->db
        ->query($query_not_comb_cutt_chln)->row();
        
        
        if(count($result_not_comb_cutt_chln) > 0) {
            $cutting_issue_details_quantity = $result_not_comb_cutt_chln->final_cut_qnty;
        } else {
            $cutting_issue_details_quantity = 0;
        }
        
        
        $query_not_comb_cutt_issu = "SELECT
        SUM(article_costing_details.quantity * cutting_received_challan_detail.receive_cut_quantity) AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
            item_dtl.im_id, customer_order_dtl.lc_id";
        
        $result_not_comb_cutt_issu = $this
        ->db
        ->query($query_not_comb_cutt_issu)->row();
        
        
        if(count($result_not_comb_cutt_issu) > 0) {
            $cutting_receive_details_quantity = $result_not_comb_cutt_issu->final_rcv_qnty;
        } else {
            $cutting_receive_details_quantity = 0;
        }
        
        
        $arr = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => $res->co_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => $res->final_qnty,
        'final_cut_qnty' => $cutting_issue_details_quantity,
        'final_rcv_qnty' => $cutting_receive_details_quantity,
        'combination_or_not' => 0
        );
        
        // echo $this->db->last_query()."<br/>";
        // $this->db->insert('temp_consumption', $arr);
        array_push($data_array, $arr);
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        
        }
        else
        {
        $query1 = "SELECT
        customer_order.co_no,
        customer_order.co_date,
        customer_order.buyer_reference_no,
        customer_order.co_reference_date,
        acc_master.name,
        acc_master.short_name,
        item_master.item AS item_name,
        item_master.im_code AS item_code,
        item_groups.ig_code,
        item_groups.group_name,
        units.unit,
        c1.color as leather_color,
        c2.color as fitting_color,
        c3.color as item_color,
        c3.c_id as item_color_id,
        item_dtl.id_id,
        item_dtl.im_id,
        item_groups.ig_id,
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        customer_order_dtl.am_id,
        customer_order_dtl.lc_id,
        article_costing.ac_id AS costing_id,
        article_costing.combination_or_not,
        article_costing_details.id_id AS item_dtl,
        article_costing_details.quantity AS item_dtl_quantity,
        SUM(co_quantity) AS co_quantity,
        0 AS temp_qnty,
        SUM(article_costing_details.quantity * co_quantity)
        AS final_qnty,
        SUM(article_costing_details.quantity * cutting_issue_challan_details.cut_co_quantity) AS final_cut_qnty,
        0 AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
        item_dtl.id_id";
        
        $result1 = $this
        ->db
        ->query($query1)->result();
        // echo $this->db->last_query(); die();
        
        foreach($result1 as $res) {
        
        $arr = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => $res->co_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => $res->final_qnty,
        'final_cut_qnty' => ($res->final_cut_qnty == NULL) ? 0 : $res->final_cut_qnty,
        'final_rcv_qnty' => 0,
        'combination_or_not' => $res->combination_or_not
        );
        
        $this
        ->db
        ->insert('temp_leather_consumption', $arr);
        array_push($article_costing_array, $res->costing_id);
        }
        
        
        
        
        //cutting receive details fetch
        
        
        
        
        $article_costings_ids = implode(",", $article_costing_array);
        $query_comb = "SELECT
        customer_order.co_no,
        customer_order.co_date,
        customer_order.buyer_reference_no,
        customer_order.co_reference_date,
        acc_master.name,
        acc_master.short_name,
        item_master.item AS item_name,
        item_master.im_code AS item_code,
        item_groups.ig_code,
        item_groups.group_name,
        units.unit,
        c1.color as leather_color,
        c2.color as fitting_color,
        c3.color as item_color,
        c3.c_id as item_color_id,
        item_dtl.id_id,
        item_dtl.im_id,
        item_groups.ig_id,
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        customer_order_dtl.am_id,
        customer_order_dtl.lc_id,
        article_costing.ac_id AS costing_id,
        article_costing.combination_or_not,
        article_costing_details.id_id AS item_dtl,
        article_costing_details.quantity AS item_dtl_quantity,
        receive_cut_quantity,
        0 AS temp_qnty,
        0
        AS final_qnty,
        0 AS final_cut_qnty,
        SUM(article_costing_details.quantity * cutting_received_challan_detail.receive_cut_quantity) AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
        item_dtl.id_id";
        
        $result_comb = $this
        ->db
        ->query($query_comb)->result();
        
        foreach($result_comb as $res) {
        $arr1 = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => ($res->receive_cut_quantity == NULL) ? 0 : $res->receive_cut_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => 0,
        'final_cut_qnty' => 0,
        'final_rcv_qnty' => ($res->final_rcv_qnty == NULL) ? 0 : $res->final_rcv_qnty,
        'combination_or_not' => $res->combination_or_not
        );
        
        $this
        ->db
        ->insert('temp_leather_consumption', $arr1);
        }
        
        
        // echo $this->db->last_query()."<br/>";
        
        }
        }
        
        
        $data_array1 = $this
        ->db
        ->select('*, sum(final_qnty) as final_qnty, sum(final_cut_qnty) as final_cut_qnty, sum(final_rcv_qnty) as final_rcv_qnty')
        ->group_by('temp_leather_consumption.co_id, temp_leather_consumption.id_id')
        ->get('temp_leather_consumption')->result_array();
        
        
        // echo '<pre>', print_r($data_array1), '</pre>'; die();
        
        
        if (!empty($data_array1))
        {
        $this->db->empty_table('temp_leather_consumption');
        //inserting non combination article
        $this->db->insert_batch('temp_leather_consumption', $data_array);
        
        //get all non combination article in $consumption_list
        $consumption_list = $this->db->get('temp_leather_consumption')->result();
        
        if(count($consumption_list) > 0) {
        foreach ($data_array1 as $d_a1)
        {
         $consumption_list_check_to_add = $this->db->where(array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->get('temp_leather_consumption')->num_rows();
         //if item exist in combination and non combination both the quantity will be added together
                if($consumption_list_check_to_add > 0) {
                $prev_final_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_qnty;
                $prev_cut_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_cut_qnty;
                $prev_rcv_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_rcv_qnty;
                $new_final_qnty = $d_a1['final_qnty'];
                $new_final_cut_qnty = $d_a1['final_cut_qnty'];
                $new_final_rcv_qnty = $d_a1['final_rcv_qnty'];
                $total_qnty = ($prev_final_qnty + $new_final_qnty);
                $total_cut_qnty = ($prev_cut_qnty + $new_final_cut_qnty);
                $total_rcv_qnty = ($prev_rcv_qnty + $new_final_rcv_qnty);
                $update_array = array(
                'final_qnty' => $total_qnty,
                'final_cut_qnty' => $total_cut_qnty,
                'final_rcv_qnty' => $total_rcv_qnty
                );
                $this->db->update('temp_leather_consumption', $update_array, array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']));
                }else {
                //if same item colour not exist then insert in table
                $consumption_list_check = $this->db->where(array('co_id' => $d_a1['co_id'], 'item_color_id' => $d_a1['item_color_id']))->get('temp_leather_consumption')->num_rows();
                if ($consumption_list_check == 0)
                {
                // echo '<pre>', print_r($d_a1), '</pre>';
                //  array_push($new_data_array, $d_a1);
                $this->db->insert('temp_leather_consumption', $d_a1);
                }
                }
        }
        } else {
          foreach ($data_array1 as $d_a1) {
            //  array_push($new_data_array, $d_a1);
            $this->db->insert('temp_leather_consumption', $d_a1);
        }  
        }
        $get_consumption_list = $this
        ->db
        ->select('*')
        // ->group_by('temp_leather_consumption.cod_id')
        ->order_by('temp_leather_consumption.co_no')
        ->where('lc_id', $r->c_id)
        ->or_where('item_color_id', $r->c_id)
        ->group_by('co_id, id_id')
        ->get('temp_leather_consumption')
        ->result();
        foreach ($get_consumption_list as $res)
        {
        $arr = array(
            'co_no' => $res->co_no,
            'co_date' => $res->co_date,
            'buyer_reference_no' => $res->buyer_reference_no,
            'co_reference_date' => $res->co_reference_date,
            'name' => $res->name,
            'short_name' => $res->short_name,
            'item_name' => $res->item_name,
            'item_code' => $res->item_code,
            'ig_code' => $res->ig_code,
            'group_name' => $res->group_name,
            'unit' => $res->unit,
            'leather_color' => $res->leather_color,
            'fitting_color' => $res->fitting_color,
            'item_color' => $res->item_color,
            'item_color_id' => $res->item_color_id,
            'lc_id' => $res->lc_id,
            'id_id' => $res->id_id,
            'im_id' => $res->im_id,
            'ig_id' => $res->ig_id,
            'cod_id' => $res->cod_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'costing_id' => $res->costing_id,
            'item_dtl' => $res->item_dtl,
            'item_dtl_quantity' => $res->item_dtl_quantity,
            'co_quantity' => $res->co_quantity,
            'temp_qnty' => $res->temp_qnty,
            'final_qnty' => $res->final_qnty,
            'final_cut_qnty' => $res->final_cut_qnty,
            'final_rcv_qnty' => $res->final_rcv_qnty,
            'combination_or_not' => $res->combination_or_not
        );
        array_push($customer_order, $arr);
        }
        
        }
        else
        {
        foreach ($data_array as $d_a)
        {
        if ($d_a['lc_id'] == $r->c_id)
        {
        array_push($customer_order, $d_a);
        }
        }
        }
        
        $keys = array_column($customer_order, 'co_no');
        
        array_multisort($keys, SORT_ASC, $customer_order);
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // echo '<pre>', print_r($customer_order), '</pre>'; die();
        
        ?>
        						
        <?php
        if (count($customer_order) > 0)
        {
        ?>										
        <td>
        <?php
        foreach ($customer_order as $c_o)
        {
        if ($c_o['lc_id'] == $r->c_id) {
        echo $c_o['co_no'] . "<br/>";
        }
        ?>
        <?php
        } ?>
        </td>
        <?php
        }
        else
        { ?>
        <td></td>
        <?php
        } ?>
        <td style="text-align: right;">
        <?=number_format($r->final_opn_qnty_for_leather_status, 2) ?>
        <?php
        $open_lth = $r->final_opn_qnty_for_leather_status . "<br/>";
        $tot_open_lth += $open_lth;
        ?>
        </td>
        <?php
        if (count($customer_order) > 0)
        {
        ?>
        <td style="text-align: right;">
        <?php
        foreach ($customer_order as $c_o)
        {
        if ($c_o['lc_id'] == $r->c_id) {
        $order_quantity = $c_o['final_qnty'];
        $co_id = $c_o['co_id'];
        $im_id = $c_o['im_id'];
        $lc_id = $c_o['lc_id'];
        $cut_issue_quantity = $c_o['final_cut_qnty'];
        $order_peng = ($order_quantity - $cut_issue_quantity);
        echo abs(round($order_peng, 2)) . "<br/>";
        $order_pending += $order_peng;
        $tot_order_pending += $order_peng;
        }
        }
        ?>
        </td>
        <td style="text-align: right;">
        <?php
        foreach ($customer_order as $c_o)
        {
        if ($c_o['lc_id'] == $r->c_id) {
        $co_id = $c_o['co_id'];
        $im_id = $c_o['im_id'];
        $lc_id = $c_o['lc_id'];
        $cut_is_quantity = $c_o['final_cut_qnty'];
        echo abs(round($cut_is_quantity, 2)) . "<br/>";
        $issue_quantity += $cut_is_quantity;
        $tot_issue_quantity += $cut_is_quantity;
        }
        }
        ?>
        </td>
        <td style="text-align: right;">
        <?php
        foreach ($customer_order as $c_o)
        {
        if ($c_o['lc_id'] == $r->c_id) {
        $co_id = $c_o['co_id'];
        $im_id = $c_o['im_id'];
        $lc_id = $c_o['lc_id'];
        $cut_rv_quantity = $c_o['final_rcv_qnty'];
        echo abs(round($cut_rv_quantity, 2)) . "<br/>";
        $receive_quantity += $cut_rv_quantity;
        $tot_receive_quantity += $cut_rv_quantity;
        }
        }
        ?>
        </td>
        <?php
        }
        else
        { ?>
        <td></td>
        <td></td>
        <td></td>
        <?php
        } ?>
        <td style="text-align: right;">
        <?php
        $opening_stock = $r->final_opening_stock;
        $sum_purchase_order = $r->final_pur_rcv_qnty;
        $sum_material_issue = $r->final_mat_issue_qnty;
        $sum_stock_in = $r->final_stock_in_qnty;
        
        $current_stock = ($opening_stock + $sum_purchase_order - $sum_material_issue + $sum_stock_in);
        
        echo number_format($current_stock, 2) . "<br/>";
        $tot_current_stock += $current_stock;
        ?>
        </td>
        <td style="text-align: right;">
        <?php
        $sum_purchase_order_issue = $r->final_pur_issue_qnty;
        $sum_supp_purchase_order_issue = $r->final_sup_pur_order_qnty;
        $po_pending = ($sum_purchase_order_issue + $sum_supp_purchase_order_issue - $sum_purchase_order);
        
        echo number_format($po_pending, 2) . "<br/>";
        $tot_po_pending += $po_pending;
        ?>
        </td>
        <td style="text-align: right;">
        <?php
        $balance = $open_lth + $order_pending + $issue_quantity - $receive_quantity - $current_stock - $po_pending;
        
        echo number_format($balance, 2) . "<br/>";
        $tot_balance += $balance;
        ?>
        </td>
        </tr>
        <tr style="background: #d4ecea;">
        <th colspan="2">Total</th>
        <td style="text-align: right;"><?php echo $open_lth;
        ?></td>
        <td style="text-align: right;"><?php echo number_format($order_pending, 2);
        $order_pending = 0;
        ?></td>
        <td style="text-align: right;"><?php echo number_format($issue_quantity, 2);
        $issue_quantity = 0;
        ?></td>
        <td style="text-align: right;"><?php echo number_format($receive_quantity, 2);
        $receive_quantity = 0;
        ?></td>
        <td style="text-align: right;"><?php echo number_format($current_stock, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($po_pending, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($balance, 2);
        ?></td>
        </tr>
        <?php
        }
        ?>
        </tr>
        <tr style="background: #445767; color: white;">
        <th colspan="2">Grand Total</th>
        <td style="text-align: right;"><?php echo number_format($tot_open_lth, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_order_pending, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_issue_quantity, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_receive_quantity, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_current_stock, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_po_pending, 2);
        ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_balance, 2);
        ?></td>
        </tr> 
        		
        			</tbody>
        		</table>
        	</div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </section>
        <?php
        } ?>
	
	<?php if ($segment == 'overtime_checking_entry_details')
{
    // 		echo '<pre>',print_r($result),'</pre>';
    
?>
	<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    <p>Date: <?=   date('d-m-Y', strtotime($from))  ?> to <?=  date('d-m-Y', strtotime($to))  ?></p>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
									    <th style="text-align: center;" >DATE</th>
                                        <th style="text-align: center;" >DAY</th>
                                        <th style="text-align: right;" >NORMAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: right;" >OVER-TIME <br/>HOURS</th>
                                        <th style="text-align: right;">TOTAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: center;" >ORD. NO.</th>
                                        <th style="text-align: center;" >ARTICLE NAME</th>
                                        <th style="text-align: center;" >ARTICLE COLOUR</th>
                                        <th style="text-align: right;">ARTICLE<br/>CHECKED</th>
                                        <th style="text-align: right;">ARTICLE<br/>ALTERED/<br/>REJECTED</th>
                                        <th style="text-align: center;">REMARKS</th>
                                        <th style="text-align: right;">TOTAL<br/>QUANTITY</th>
                                        <th style="text-align: right;">  AVG.<br/>PROD.<br/>RATE/HRS  </th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php 
									    foreach($result as $key=>$res) { 
									    ?>
										<tr>
											<th colspan="9" style="text-align: center;"><?= $key ?></th>
										</tr>
										<?php 
										$iter = 1;
										$total_normal_duty_hours = 0;
                                        $total_overtime_hours = 0;
                                        $total_duty_hours = 0;
                                        $total_article_checked = 0;
                                        $total_rejection_qnty = 0;
                                        $total_prod_rate = 0;
                                        $avrage_total_prod_rate = 0;
										foreach($res as $r) {
                                        if($r['checking_entry_day'] == 'Sat') {
                                            $normal_duty_hours = 5.5;
                                        } else if($r['checking_entry_day'] != 'Sun') {
                                            $normal_duty_hours = $r['normal_duty_hours'];
                                        } else {
                                            $normal_duty_hours = 0;
                                        }
										?>
                    	<tr>
                    	 <?php   if($r['checking_entry_day'] == 'Sun') {   ?>
                         <td style="text-align: center; color: red;">
                         <?php   } else {   ?>
                         <td style="text-align: center;">
                         <?php  }  ?>
                         <?= $r['checking_entry_date'] ?></td>
                         <?php  if($r['checking_entry_day'] == 'Sun') {   ?>
                         <td style="text-align: center; color: red;">
                         <?php   } else {   ?>
                         <td style="text-align: center;">
                         <?php   }   ?>
                         <?= $r['checking_entry_day'] ?></td>
                         <td style="text-align: right; width: 12%;"><?=   $normal_duty_hours   ?></td>
                    <td style="text-align: right; width: 12%;">
                        <?= $r['extra_time'] ?>
                    </td>
                      <td style="text-align: right;"><?php
                      $total_duty_hour = ($normal_duty_hours + $r['extra_time']);
                      echo ($normal_duty_hours + $r['extra_time']);
                      ?></td>
                      <td nowrap><?= $r['co_no'] ?></td>
                      <td nowrap><?= $r['art_no'] ?></td>
                      <td><?= $r['color'] ?></td>
                           <td style="text-align: right;"><?= $r['checked_qntty'] ?></td>
                      <td style="text-align: right;"><?= $r['rejection_quantity'] ?></td>
                      <td style="text-align: center;"><?=  $r['remarks']  ?></td>
                      <td style="text-align: right;"><?=  $r['left_quantity']  ?><hr style="margin: 0; border-top: 1px solid #3b3030;"><?=  $r['total_prod_rate']  ?></td>
                      <td style="text-align: right;"><?php if($total_duty_hour > 0) { echo number_format(($r['total_prod_rate']/$total_duty_hour),2); } ?></td>
                    </tr>
                    
                    <?php
                    $total_normal_duty_hours += $normal_duty_hours;
                    $total_overtime_hours += $r['total_overtime_hours'];
                    $total_duty_hours += ($normal_duty_hours + $r['total_overtime_hours']);   
                    $total_article_checked += $r['total_article_checked'];
                    $total_rejection_qnty += $r['total_rejection_qnty'];
                    $total_prod_rate += $r['total_prod_rate'];
                    $avrage_total_prod_rate += number_format(($r['total_prod_rate'] / $iter) , 2);
                    ?>

											<?php
    $iter++; } ?> 
    
    <tr style="background: #d4ecea;">
                        	<th colspan="2" style="text-align: center;">TOTAL</th>
                        	<td style="text-align: right;"><?=$total_normal_duty_hours
?></td>
                        	<td style="text-align: right;"><?=$total_overtime_hours
?></td>
                        	<td style="text-align: right;"><?=$total_duty_hours
?></td>
                        	<td colspan="3"></td>
                        	<td style="text-align: right;"><?=$total_article_checked
?></td>
                        	<td style="text-align: right;"><?=$total_rejection_qnty ?></td>
                        	<td></td>
                        	<td style="text-align: right;"><?=  $total_prod_rate  ?></td>
                        	<td></td>
                        </tr>
                        <tr style="background: #445767; color: white;">
                        	<td colspan="9">AVG</td>
                        	<td colspan="4" style="text-align: right;"><?= $avrage_total_prod_rate ?></td>
                        </tr>
    
    <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="ot_summary" class="table table-bordered">
									<thead>
										<tr>
    										<th style="text-align: center;" >EMP NAME</th>
                                            <th style="text-align: right;" >NORMAL<br/>DUTY<br/>HRS</th>
                                            <th style="text-align: right;" >OVER-TIME <br/>HOURS</th>
                                            <th style="text-align: right;">TOTAL<br/>DUTY<br/>HRS</th>
                                            <th style="text-align: right;">ARTICLE<br/>CHECKED</th>
                                            <th style="text-align: right;">ARTICLE<br/>(ALTERED/OTHERS)</th>
                                            <th style="text-align: right;">ALL ARTICLE QNTY.</th>
                                            <th style="text-align: right;">AVG.<br/>PROD.<br/>RATE/HRS</th>
										</tr>
									</thead>
									<tbody>
									    <?php 
									    foreach($result as $key=>$res) { 
									    ?>
										<?php 
										$iter = 1;
										$total_normal_duty_hours = 0;
                                        $total_overtime_hours = 0;
                                        $total_duty_hours = 0;
                                        $total_article_checked = 0;
                                        $total_rejection_qnty = 0;
                                        $total_prod_rate = 0;
                                        $avrage_total_prod_rate = 0;
										foreach($res as $r) {
                                        if($r['checking_entry_day'] == 'Sat') {
                                            $normal_duty_hours_individual = 5.5;
                                        } else if($r['checking_entry_day'] == 'Sun') {
                                            $normal_duty_hours_individual = 0;    
                                        } else {
                                            $normal_duty_hours_individual = $r['normal_duty_hours'];
                                        }
										?>
                    	
                                        <?php
                                        $total_normal_duty_hours += $normal_duty_hours_individual;
                                        $total_overtime_hours += $r['total_overtime_hours'];
                                        $total_duty_hours += ($normal_duty_hours_individual + $r['total_overtime_hours']);
                                        $total_article_checked += $r['total_article_checked'];
                                        $total_rejection_qnty += $r['total_rejection_qnty'];
                                        $total_prod_rate += $r['total_prod_rate'];
                                        if($total_duty_hours > 0) {
                                        $avrage_total_prod_rate += $total_prod_rate / $total_duty_hours;
                                        } else {
                                        $avrage_total_prod_rate += 0;
                                        }
                                        ?>

											<?php
                                    $iter++; } ?>
                        
                                        <tr>
                                            <td style="text-align: center;"><?= $key ?></td>
                                        	<td style="text-align: right;"><?=$total_normal_duty_hours?></td>
                                        	<td style="text-align: right;"><?=$total_overtime_hours?></td>
                                        	<td style="text-align: right;"><?=($total_normal_duty_hours + $total_overtime_hours)?></td>
                                        	<td style="text-align: right;"><?=$total_article_checked?></td>
                                        	<td style="text-align: right;"><?=$total_rejection_qnty ?></td>
                                        	<td style="text-align: right;"><?=$total_article_checked + $total_rejection_qnty ?></td>
                                        	<td style="text-align: right;"><?=  (($total_normal_duty_hours + $total_overtime_hours) != 0) ? number_format((($total_article_checked + $total_rejection_qnty) / ($total_normal_duty_hours + $total_overtime_hours)), 2) : '0'  ?></td>
                                        </tr>
    
                                        <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

<?php if ($segment == 'overtime_checking_entry_details_with_picture')
{
    // 		echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
									    <th style="text-align: center;" >DATE</th>
                                        <th style="text-align: center;" >DAY</th>
                                        <th style="text-align: right;" >NORMAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: right;" >OVER-TIME <br/>HOURS</th>
                                        <th style="text-align: right;">TOTAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: center;" >ORD. NO.</th>
                                        <th style="text-align: center;" >ARTICLE NAME</th>
                                        <th style="text-align: center;" >ARTICLE IMAGE</th>
                                        <th style="text-align: center;" >ARTICLE COLOUR</th>
                                        <th style="text-align: right;">ARTICLE<br/>CHECKED</th>
                                        <th style="text-align: right;">ARTICLE<br/>ALTERED/<br/>REJECTED</th>
                                        <th style="text-align: right;">PROD.<br/>RATE</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php 
									    foreach($result as $key=>$res) { 
									    ?>
										<tr>
											<th colspan="9" style="text-align: center;"><?= $key ?></th>
										</tr>
										<?php 
										$iter = 1;
										$total_normal_duty_hours = 0;
                    $total_overtime_hours = 0;
                    $total_duty_hours = 0;
                    $total_article_checked = 0;
                    $total_rejection_qnty = 0;
                    $total_prod_rate = 0;
                    $avrage_total_prod_rate = 0;
										foreach($res as $r) { 
										?>
                    	<tr>
                         <td style="text-align: center;"><?= $r['checking_entry_date'] ?></td>
                         <td style="text-align: center;"><?= $r['checking_entry_day'] ?></td>
                         <td style="text-align: right; width: 12%;"><?php
                         if($r['checking_entry_day'] != 'Sun') {
                         echo $r['normal_duty_hours'];
                         } else {
                         echo '0';    
                         }
                         ?></td>
                    <td style="text-align: right; width: 12%;">
                        <?= $r['extra_time'] ?>
                    </td>
                      <td style="text-align: right;"><?php 
                      if($r['checking_entry_day'] != 'Sun') {
                         echo ($r['normal_duty_hours'] + $r['extra_time']);
                         } else {
                         echo $r['extra_time'];    
                         }
                      ?></td>
                      <td><?= $r['co_no'] ?></td>
                      <td><?= $r['art_no'] ?></td>
                      <td style="text-align: center;"><?= $r['images'] ?></td>
                      <td><?= $r['color'] ?></td>
                           <td style="text-align: right;"><?= $r['checked_qntty'] ?></td>
                      <td style="text-align: right;"><?= $r['rejection_quantity'] ?></td>
                      <td style="text-align: right;"><?= $r['total_rate'] ?></td>
                    </tr>
                    
                    <?php
                    if($r['checking_entry_day'] != 'Sun') {
                         $total_normal_duty_hours += $r['normal_duty_hours'];
                         } else {
                         $total_normal_duty_hours += 0;    
                         }
                    $total_overtime_hours += $r['total_overtime_hours'];
                    if($r['checking_entry_day'] != 'Sun') {
                    $total_duty_hours += ($r['normal_duty_hours'] + $r['total_overtime_hours']);
                    } else {
                    $total_duty_hours += $r['total_overtime_hours'];    
                    }
                    $total_article_checked += $r['total_article_checked'];
                    $total_rejection_qnty += $r['total_rejection_qnty'];
                    $total_prod_rate += $r['total_prod_rate'];
                    $avrage_total_prod_rate += number_format(($r['total_prod_rate'] / $iter) , 2);
                    ?>

											<?php
    $iter++; } ?> 
    
    <tr style="background: #d4ecea;">
                        	<th colspan="2" style="text-align: center;">TOTAL</th>
                        	<td style="text-align: right;"><?=$total_normal_duty_hours
?></td>
                        	<td style="text-align: right;"><?=$total_overtime_hours
?></td>
                        	<td style="text-align: right;"><?=$total_duty_hours
?></td>
                        	<td colspan="4"></td>
                        	<td style="text-align: right;"><?=$total_article_checked
?></td>
                        	<td style="text-align: right;"><?=$total_rejection_qnty ?></td>
                        	<td style="text-align: right;"><?= $total_prod_rate ?></td>
                        </tr>
                        <tr style="background: #445767; color: white;">
                        	<td colspan="8">AVG</td>
                        	<td colspan="4" style="text-align: right;"><?= $avrage_total_prod_rate ?></td>
                        </tr>
    
    <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
										<th style="text-align: center;" >EMP NAME</th>
                                        <th style="text-align: right;" >NORMAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: right;" >OVER-TIME <br/>HOURS</th>
                                        <th style="text-align: right;">TOTAL<br/>DUTY<br/>HRS</th>
                                        <th style="text-align: right;">ARTICLE<br/>CHECKED</th>
                                        <th style="text-align: right;">ARTICLE<br/>
ALTERED/REJECTED</th>
                                        <th style="text-align: right;">PROD.<br/>RATE</th>
										</tr>
									</thead>
									<tbody>
									    <?php 
									    foreach($result as $key=>$res) { 
									    ?>
										<?php 
										$iter = 1;
										$total_normal_duty_hours = 0;
                    $total_overtime_hours = 0;
                    $total_duty_hours = 0;
                    $total_article_checked = 0;
                    $total_rejection_qnty = 0;
                    $total_prod_rate = 0;
                    $avrage_total_prod_rate = 0;
										foreach($res as $r) { 
										?>
                    	
                    <?php
                    if($r['checking_entry_day'] != 'Sun') {
                    $total_normal_duty_hours += $r['normal_duty_hours'];    
                    } else {
                    $total_normal_duty_hours += 0;    
                    }
                    $total_overtime_hours += $r['total_overtime_hours'];
                    if($r['checking_entry_day'] != 'Sun') {
                    $total_duty_hours += ($r['normal_duty_hours'] + $r['total_overtime_hours']);
                    } else {
                    $total_duty_hours += $r['total_overtime_hours'];
                    }
                    $total_article_checked += $r['total_article_checked'];
                    $total_rejection_qnty += $r['total_rejection_qnty'];
                    $total_prod_rate += $r['total_prod_rate'];
                    $avrage_total_prod_rate += number_format(($r['total_prod_rate'] / $iter) , 2);
                    ?>

											<?php
    $iter++; } ?>
    
    <tr>
                            <td style="text-align: center;"><?= $key ?></td>
                        	<td style="text-align: right;"><?=$total_normal_duty_hours
?></td>
                        	<td style="text-align: right;"><?=$total_overtime_hours
?></td>
                        	<td style="text-align: right;"><?=$total_duty_hours
?></td>
                        	<td style="text-align: right;"><?=$total_article_checked
?></td>
                        	<td style="text-align: right;"><?=$total_rejection_qnty ?></td>
                        	<td style="text-align: right;"><?=$total_prod_rate ?></td>
                        </tr>
    
    <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'leather_status_pending_orders')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
		<?php if ($segment1 == 'leather_status' || $segment1 == 'leather_status_pending_orders')
    { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php
    }
    else
    { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php
    } ?>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Order No.</th>
											<th class="text-center">Opn. Qty.</th>
											<th class="text-center">Ord Pending</th>
											<th class="text-center">Cut Issue</th>
											<th class="text-center">Cut Rcvd.</th>
											<th class="text-center">Current Stck.</th>
											<th class="text-center">P.O. Pending</th>
											<th class="text-center">Balance</th>
										</tr>
									</thead>
									<tbody>
	<?php
    $order_quantity = 0;
    $issue_quantity = 0;
    $order_pending = 0;
    $receive_quantity = 0;
    $open_lth = 0;
    $current_stock = 0;
    $po_pending = 0;
    $balance = 0;
    $tot_order_quantity = 0;
    $tot_issue_quantity = 0;
    $tot_order_pending = 0;
    $tot_receive_quantity = 0;
    $tot_open_lth = 0;
    $tot_current_stock = 0;
    $tot_po_pending = 0;
    $tot_balance = 0;
?>
										<?php
        // echo '<pre>',print_r($result1),'</pre>';
        foreach ($result1 as $r)
        {
        $this->db->empty_table('temp_leather_consumption');
        ?>
        					<tr>
        						<th><?=$r->item_name . ' [' . $r->color . ']' ?>
        						
        						<?php $another_item_row = $this
        ->db
        ->join('item_master', 'item_master.im_id = item_mapping.buyer_item_code', 'left')
        ->join('colors', 'colors.c_id = item_mapping.buyer_item_color', 'left')
        ->get_where('item_mapping', array(
        'company_item_code' => $r->im_id,
        'company_item_color' => $r->c_id
        ))
        ->row();
        if (count($another_item_row) > 0)
        {
        ?>
            <p style="color: red; text-align: center; font-size: 14px;">**This item exist in item mapper as - 
            <br/> <b><?=$another_item_row->item . ' [' . $another_item_row->color . ']' ?></b>**</p>
                                    <?php
        } ?>
        						
        						</th>
        <?php
        // $this->db->empty_table('leather_consumption');
        $data_array = array();
        $data_array1 = array();
        $data_array2 = array();
        $new_data_array = array();
        $customer_order = array();
        
        $order_query = "SELECT 
        `customer_order_dtl`.*,
        `article_costing`.`combination_or_not`,
        `item_dtl`.`im_id`
        FROM
        `customer_order_dtl`
        LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
        LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
        LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
        WHERE
        `item_dtl`.`im_id` = $r->im_id
        GROUP BY
        `customer_order_dtl`.`co_id`,
        `item_dtl`.`im_id`,
        `customer_order_dtl`.`lc_id`
        ORDER BY
        im_id";
        $order_colour_res = $this
        ->db
        ->query($order_query)->result();
        
        //         $order_query = "SELECT
        //     `customer_order_dtl`.*,
        //     `article_costing`.`combination_or_not`,
        //     `item_dtl`.`im_id`
        // FROM
        //     `item_dtl`
        //     LEFT JOIN `article_costing_details` ON `article_costing_details`.`id_id` = `item_dtl`.`id_id`
        // LEFT JOIN `article_costing` ON `article_costing`.`ac_id` = `article_costing_details`.`ac_id`
        // LEFT JOIN `article_master` ON `article_master`.`am_id` = `article_costing`.`am_id`
        // LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
        // LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `customer_order_dtl`.`co_id`
        // WHERE
        //     `item_dtl`.`im_id` = $r->im_id
        //     GROUP BY
        //     `customer_order_dtl`.`co_id`,
        //     `customer_order_dtl`.`lc_id`,
        //     `item_dtl`.`im_id`
        //     ";
        //         $order_colour_res = $this->db->query($order_query)->result();
        $article_costing_array = array();
        foreach ($order_colour_res as $o_c_r)
        {
        if ($o_c_r->co_id == '')
        {
        continue;
        }
        if ($o_c_r->combination_or_not == 0)
        {
        $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
        $res = $this
        ->db
        ->query($query)->row();
        
        
        $query_not_comb_cutt_chln = "SELECT
        SUM(article_costing_details.quantity * cutting_issue_challan_details.cut_co_quantity) AS final_cut_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
            item_dtl.im_id, customer_order_dtl.lc_id";
        
        $result_not_comb_cutt_chln = $this
        ->db
        ->query($query_not_comb_cutt_chln)->row();
        
        
        if(count($result_not_comb_cutt_chln) > 0) {
            $cutting_issue_details_quantity = $result_not_comb_cutt_chln->final_cut_qnty;
        } else {
            $cutting_issue_details_quantity = 0;
        }
        
        
        $query_not_comb_cutt_issu = "SELECT
        SUM(article_costing_details.quantity * cutting_received_challan_detail.receive_cut_quantity) AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
            item_dtl.im_id, customer_order_dtl.lc_id";
        
        $result_not_comb_cutt_issu = $this
        ->db
        ->query($query_not_comb_cutt_issu)->row();
        
        
        if(count($result_not_comb_cutt_issu) > 0) {
            $cutting_receive_details_quantity = $result_not_comb_cutt_issu->final_rcv_qnty;
        } else {
            $cutting_receive_details_quantity = 0;
        }
        
        
        $arr = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => $res->co_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => $res->final_qnty,
        'final_cut_qnty' => $cutting_issue_details_quantity,
        'final_rcv_qnty' => $cutting_receive_details_quantity,
        'combination_or_not' => 0
        );
        
        // echo $this->db->last_query()."<br/>";
        // $this->db->insert('temp_consumption', $arr);
        array_push($data_array, $arr);
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        
        }
        else
        {
        $query1 = "SELECT
        customer_order.co_no,
        customer_order.co_date,
        customer_order.buyer_reference_no,
        customer_order.co_reference_date,
        acc_master.name,
        acc_master.short_name,
        item_master.item AS item_name,
        item_master.im_code AS item_code,
        item_groups.ig_code,
        item_groups.group_name,
        units.unit,
        c1.color as leather_color,
        c2.color as fitting_color,
        c3.color as item_color,
        c3.c_id as item_color_id,
        item_dtl.id_id,
        item_dtl.im_id,
        item_groups.ig_id,
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        customer_order_dtl.am_id,
        customer_order_dtl.lc_id,
        article_costing.ac_id AS costing_id,
        article_costing.combination_or_not,
        article_costing_details.id_id AS item_dtl,
        article_costing_details.quantity AS item_dtl_quantity,
        SUM(co_quantity) AS co_quantity,
        0 AS temp_qnty,
        SUM(article_costing_details.quantity * co_quantity)
        AS final_qnty,
        SUM(article_costing_details.quantity * cutting_issue_challan_details.cut_co_quantity) AS final_cut_qnty,
        0 AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
        item_dtl.id_id";
        
        $result1 = $this
        ->db
        ->query($query1)->result();
        // echo $this->db->last_query(); die();
        
        foreach($result1 as $res) {
        
        $arr = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => $res->co_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => $res->final_qnty,
        'final_cut_qnty' => ($res->final_cut_qnty == '') ? '0' : $res->final_cut_qnty,
        'final_rcv_qnty' => 0,
        'combination_or_not' => $res->combination_or_not
        );
        
        $this
        ->db
        ->insert('temp_leather_consumption', $arr);
        array_push($article_costing_array, $res->costing_id);
        }
        
        
        
        
        //cutting receive details fetch
        
        
        
        
        $article_costings_ids = implode(",", $article_costing_array);
        $query_comb = "SELECT
        customer_order.co_no,
        customer_order.co_date,
        customer_order.buyer_reference_no,
        customer_order.co_reference_date,
        acc_master.name,
        acc_master.short_name,
        item_master.item AS item_name,
        item_master.im_code AS item_code,
        item_groups.ig_code,
        item_groups.group_name,
        units.unit,
        c1.color as leather_color,
        c2.color as fitting_color,
        c3.color as item_color,
        c3.c_id as item_color_id,
        item_dtl.id_id,
        item_dtl.im_id,
        item_groups.ig_id,
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        customer_order_dtl.am_id,
        customer_order_dtl.lc_id,
        article_costing.ac_id AS costing_id,
        article_costing.combination_or_not,
        article_costing_details.id_id AS item_dtl,
        article_costing_details.quantity AS item_dtl_quantity,
        receive_cut_quantity,
        0 AS temp_qnty,
        0
        AS final_qnty,
        0 AS final_cut_qnty,
        SUM(article_costing_details.quantity * cutting_received_challan_detail.receive_cut_quantity) AS final_rcv_qnty
        FROM
        `customer_order`
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
        LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
        LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
        LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
        LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
        LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
        LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
        LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
        LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
        LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
        LEFT JOIN units ON item_groups.u_id = units.u_id
        LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = customer_order_dtl.cod_id
        WHERE
        customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
        GROUP BY
        item_dtl.id_id";
        
        $result_comb = $this
        ->db
        ->query($query_comb)->result();
        
        foreach($result_comb as $res) {
        $arr1 = array(
        'co_no' => $res->co_no,
        'co_date' => $res->co_date,
        'buyer_reference_no' => $res->buyer_reference_no,
        'co_reference_date' => $res->co_reference_date,
        'name' => $res->name,
        'short_name' => $res->short_name,
        'item_name' => $res->item_name,
        'item_code' => $res->item_code,
        'ig_code' => $res->ig_code,
        'group_name' => $res->group_name,
        'unit' => $res->unit,
        'leather_color' => $res->leather_color,
        'fitting_color' => $res->fitting_color,
        'item_color' => $res->item_color,
        'item_color_id' => $res->item_color_id,
        'lc_id' => $res->lc_id,
        'id_id' => $res->id_id,
        'im_id' => $res->im_id,
        'ig_id' => $res->ig_id,
        'cod_id' => $res->cod_id,
        'co_id' => $res->co_id,
        'am_id' => $res->am_id,
        'costing_id' => $res->costing_id,
        'item_dtl' => $res->item_dtl,
        'item_dtl_quantity' => $res->item_dtl_quantity,
        'co_quantity' => ($res->receive_cut_quantity == '') ? '0' : $res->receive_cut_quantity,
        'temp_qnty' => $res->temp_qnty,
        'final_qnty' => 0,
        'final_cut_qnty' => 0,
        'final_rcv_qnty' => ($res->final_rcv_qnty == '') ? '0' : $res->final_rcv_qnty,
        'combination_or_not' => $res->combination_or_not
        );
        
        $this
        ->db
        ->insert('temp_leather_consumption', $arr1);
        }
        
        
        // echo $this->db->last_query()."<br/>";
        
        }
        }
        
        
        $data_array1 = $this
        ->db
        ->select('*, sum(final_qnty) as final_qnty, sum(final_cut_qnty) as final_cut_qnty, sum(final_rcv_qnty) as final_rcv_qnty')
        ->group_by('temp_leather_consumption.co_id, temp_leather_consumption.id_id')
        ->get('temp_leather_consumption')->result_array();
        
        
        // echo '<pre>', print_r($data_array1), '</pre>'; die();
        
        
        if (!empty($data_array1))
        {
        $this->db->empty_table('temp_leather_consumption');
        //inserting non combination article
        $this->db->insert_batch('temp_leather_consumption', $data_array);
        
        //get all non combination article in $consumption_list
        $consumption_list = $this->db->get('temp_leather_consumption')->result();
        
        if(count($consumption_list) > 0) {
        foreach ($data_array1 as $d_a1)
        {
         $consumption_list_check_to_add = $this->db->where(array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->get('temp_leather_consumption')->num_rows();
         //if item exist in combination and non combination both the quantity will be added together
                if($consumption_list_check_to_add > 0) {
                $prev_final_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_qnty;
                $prev_cut_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_cut_qnty;
                $prev_rcv_qnty = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->row()->final_rcv_qnty;
                $new_final_qnty = $d_a1['final_qnty'];
                $new_final_cut_qnty = $d_a1['final_cut_qnty'];
                $new_final_rcv_qnty = $d_a1['final_rcv_qnty'];
                $total_qnty = ($prev_final_qnty + $new_final_qnty);
                $total_cut_qnty = ((float)$prev_cut_qnty + (float)$new_final_cut_qnty);
                $total_rcv_qnty = ((float)$prev_rcv_qnty + (float)$new_final_rcv_qnty);
                $update_array = array(
                'final_qnty' => $total_qnty,
                'final_cut_qnty' => $total_cut_qnty,
                'final_rcv_qnty' => $total_rcv_qnty
                );
                $this->db->update('temp_leather_consumption', $update_array, array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']));
                }else {
                //if same item colour not exist then insert in table
                $consumption_list_check = $this->db->where(array('co_id' => $d_a1['co_id'], 'item_color_id' => $d_a1['item_color_id']))->get('temp_leather_consumption')->num_rows();
                if ($consumption_list_check == 0)
                {
                // echo '<pre>', print_r($d_a1), '</pre>';
                //  array_push($new_data_array, $d_a1);
                $this->db->insert('temp_leather_consumption', $d_a1);
                }
                }
        }
        } else {
          foreach ($data_array1 as $d_a1) {
            //  array_push($new_data_array, $d_a1);
            $this->db->insert('temp_leather_consumption', $d_a1);
        }  
        }
        $get_consumption_list = $this
        ->db
        ->select('*')
        // ->group_by('temp_leather_consumption.cod_id')
        ->order_by('temp_leather_consumption.co_no')
        ->where('lc_id', $r->c_id)
        ->or_where('item_color_id', $r->c_id)
        ->group_by('co_id, id_id')
        ->get('temp_leather_consumption')
        ->result();
        foreach ($get_consumption_list as $res)
        {
        $arr = array(
            'co_no' => $res->co_no,
            'co_date' => $res->co_date,
            'buyer_reference_no' => $res->buyer_reference_no,
            'co_reference_date' => $res->co_reference_date,
            'name' => $res->name,
            'short_name' => $res->short_name,
            'item_name' => $res->item_name,
            'item_code' => $res->item_code,
            'ig_code' => $res->ig_code,
            'group_name' => $res->group_name,
            'unit' => $res->unit,
            'leather_color' => $res->leather_color,
            'fitting_color' => $res->fitting_color,
            'item_color' => $res->item_color,
            'item_color_id' => $res->item_color_id,
            'lc_id' => $res->lc_id,
            'id_id' => $res->id_id,
            'im_id' => $res->im_id,
            'ig_id' => $res->ig_id,
            'cod_id' => $res->cod_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'costing_id' => $res->costing_id,
            'item_dtl' => $res->item_dtl,
            'item_dtl_quantity' => $res->item_dtl_quantity,
            'co_quantity' => $res->co_quantity,
            'temp_qnty' => $res->temp_qnty,
            'final_qnty' => $res->final_qnty,
            'final_cut_qnty' => $res->final_cut_qnty,
            'final_rcv_qnty' => $res->final_rcv_qnty,
            'combination_or_not' => $res->combination_or_not
        );
        array_push($customer_order, $arr);
        }
        
        }
        else
        {
        foreach ($data_array as $d_a)
        {
        if ($d_a['lc_id'] == $r->c_id)
        {
        array_push($customer_order, $d_a);
        }
        }
        }
        
        $keys = array_column($customer_order, 'co_no');
        
        array_multisort($keys, SORT_ASC, $customer_order);
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        
        ?>
												
	 <?php
        if (count($customer_order) > 0)
        {
?>										
      <td>
      	<?php
            foreach ($customer_order as $c_o)
            {
                if ((round($c_o['final_cut_qnty'], 2) - round($c_o['final_rcv_qnty'], 2)) > 0 or (round($c_o['final_qnty'], 2) - round($c_o['final_cut_qnty'], 2)) > 0)
                {
                    echo $c_o['co_no'] . "<br/>";
?>
              <?php
                }
            } ?>
      </td>
  <?php
        }
        else
        { ?>
  	  <td></td>
  <?php
        } ?>
  <td style="text-align: right;">
      	<?=number_format($r->final_opn_qnty_for_leather_status, 2) ?>
      	<?php
        $open_lth = $r->final_opn_qnty_for_leather_status . "<br/>";
        $tot_open_lth += $r->final_opn_qnty_for_leather_status;
?>
      </td>
      <?php
        if (count($customer_order) > 0)
        {
?>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {
                if ((round($c_o['final_cut_qnty'], 2) - round($c_o['final_rcv_qnty'], 2)) > 0 or (round($c_o['final_qnty'], 2) - round($c_o['final_cut_qnty'], 2)) > 0)
                {
                    $order_quantity = $c_o['final_qnty'];
                    $co_id = $c_o['co_id'];
                    $im_id = $c_o['im_id'];
                    $lc_id = $c_o['lc_id'];
                    $cut_issue_quantity = $c_o['final_cut_qnty'];
                    $order_peng = ((double)$order_quantity - (double)$cut_issue_quantity);
                    // echo $order_quantity . ' ... ' . $cut_issue_quantity;
                    echo abs(round($order_peng, 2)) . "<br/>";
                    $order_pending += $order_peng;
                    $tot_order_pending += $order_peng;
                }
            }
?>
      </td>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {
                if ((round($c_o['final_cut_qnty'], 2) - round($c_o['final_rcv_qnty'], 2)) > 0 or (round($c_o['final_qnty'], 2) - round($c_o['final_cut_qnty'], 2)) > 0)
                {
                    $co_id = $c_o['co_id'];
                    $im_id = $c_o['im_id'];
                    $lc_id = $c_o['lc_id'];
                    $cut_is_quantity = $c_o['final_cut_qnty'];
                    echo abs(round($cut_is_quantity, 2)) . "<br/>";
                    $issue_quantity += (float)$cut_is_quantity;
                    $tot_issue_quantity += (float)$cut_is_quantity;
                }
            }
?>
      </td>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {
                if ((round($c_o['final_cut_qnty'], 2) - round($c_o['final_rcv_qnty'], 2)) > 0 or (round($c_o['final_qnty'], 2) - round($c_o['final_cut_qnty'], 2)) > 0)
                {
                    $co_id = $c_o['co_id'];
                    $im_id = $c_o['im_id'];
                    $lc_id = $c_o['lc_id'];
                    
                    if($c_o['final_rcv_qnty'] == ''){
                        $cut_rv_quantity = 0;    
                    }else{
                        $cut_rv_quantity = $c_o['final_rcv_qnty'];
                    }
                    
                    echo abs(round($cut_rv_quantity, 2)) . "<br/>";
                    $receive_quantity += $cut_rv_quantity;
                    $tot_receive_quantity += $cut_rv_quantity;
                }
            }
?>
      </td>
  <?php
        }
        else
        { ?>
  	   <td></td>
  	   <td></td>
  	   <td></td>
  <?php
        } ?>
      <td style="text-align: right;">
      	<?php
        $opening_stock = $r->final_opening_stock;
        $sum_purchase_order = $r->final_pur_rcv_qnty;
        $sum_material_issue = $r->final_mat_issue_qnty;
        $sum_stock_in = $r->final_stock_in_qnty;

        $current_stock = ($opening_stock + $sum_purchase_order - $sum_material_issue + $sum_stock_in);

        echo number_format($current_stock, 2) . "<br/>";
        $tot_current_stock += $current_stock;
?>
      </td>
      <td style="text-align: right;">
      	<?php
        $sum_purchase_order_issue = $r->final_pur_issue_qnty;
        $sum_supp_purchase_order_issue = $r->final_sup_pur_order_qnty;
        $po_pending = ($sum_purchase_order_issue + $sum_supp_purchase_order_issue - $sum_purchase_order);

        echo number_format($po_pending, 2) . "<br/>";
        $tot_po_pending += $po_pending;
?>
      </td>
      <td style="text-align: right;">
      	<?php
        $balance = $r->final_opn_qnty_for_leather_status + $order_pending + $issue_quantity - $receive_quantity - $current_stock - $po_pending;

        echo number_format($balance, 2) . "<br/>";
        $tot_balance += $balance;
?>
      </td>
      </tr>
      <tr style="background: #d4ecea;">
	    <th colspan="2">Total</th>
	    <td style="text-align: right;"><?php echo $open_lth;
?></td>
	    	 	 <td style="text-align: right;"><?php echo number_format($order_pending, 2);
        $order_pending = 0;
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($issue_quantity, 2);
        $issue_quantity = 0;
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($receive_quantity, 2);
        $receive_quantity = 0;
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($current_stock, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($po_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($balance, 2);
?></td>
	 </tr>
   <?php
    }
?>
	 </tr>
      <tr style="background: #445767; color: white;">
	    <th colspan="2">Grand Total</th>
	 	 <td style="text-align: right;"><?php echo number_format($tot_open_lth, 2);
?></td>
	    <td style="text-align: right;"><?php echo number_format($tot_order_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_issue_quantity, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_receive_quantity, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_current_stock, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_po_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_balance, 2);
?></td>
	 </tr> 
								
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'item_status')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
		<?php if ($segment1 == 'leather_status')
    { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php
    }
    else
    { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php
    } ?>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Order No.</th>
											<th class="text-center">Ord Pending</th>
											<th class="text-center">Cut Issue</th>
											<th class="text-center">Cut Rcvd.</th>
											<th class="text-center">Supplier Name</th>
											<th class="text-center">Current Stck.</th>
											<th class="text-center">P.O. Pending</th>
											<th class="text-center">Balance</th>
										</tr>
									</thead>
									<tbody>
	<?php
    $order_quantity = 0;
    $issue_quantity = 0;
    $order_pending = 0;
    $receive_quantity = 0;
    $open_lth = 0;
    $current_stock = 0;
    $po_pending = 0;
    $balance = 0;
    $tot_order_quantity = 0;
    $tot_issue_quantity = 0;
    $tot_order_pending = 0;
    $tot_receive_quantity = 0;
    $tot_open_lth = 0;
    $tot_current_stock = 0;
    $tot_po_pending = 0;
    $tot_balance = 0;
?>
										<?php
    // echo '<pre>',print_r($result1),'</pre>';
    foreach ($result1 as $r)
    {
?>
											<tr>
												<th><?=$r->item_name . ' [' . $r->color . ']' ?>
												
												<?php $another_item_row = $this
            ->db
            ->join('item_master', 'item_master.im_id = item_mapping.buyer_item_code', 'left')
            ->join('colors', 'colors.c_id = item_mapping.buyer_item_color', 'left')
            ->get_where('item_mapping', array(
            'company_item_code' => $r->im_id,
            'company_item_color' => $r->c_id
        ))
            ->row();
        if (count($another_item_row) > 0)
        {
?>
                            <p style="color: red; text-align: center; font-size: 14px;">**This item exist in item mapper as - 
                            <br/> <b><?=$another_item_row->item . ' [' . $another_item_row->color . ']' ?></b>**</p>
                                                    <?php
        } ?>
												
												</th>
     <?php
        // $this->db->empty_table('leather_consumption');
        $data_array = array();
        $data_array1 = array();
        $data_array2 = array();
        $new_data_array = array();
        $customer_order = array();

        $order_query = "SELECT 
    `customer_order_dtl`.*,
    `item_dtl`.`id_id`,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
WHERE
    `item_dtl`.`id_id` = $r->id_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `item_dtl`.`id_id`";
        $order_colour_res = $this
            ->db
            ->query($order_query)->result();

        //         $order_query = "SELECT
        //     `customer_order_dtl`.*,
        //     `article_costing`.`combination_or_not`,
        //     `item_dtl`.`im_id`
        // FROM
        //     `item_dtl`
        //     LEFT JOIN `article_costing_details` ON `article_costing_details`.`id_id` = `item_dtl`.`id_id`
        // LEFT JOIN `article_costing` ON `article_costing`.`ac_id` = `article_costing_details`.`ac_id`
        // LEFT JOIN `article_master` ON `article_master`.`am_id` = `article_costing`.`am_id`
        // LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
        // LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `customer_order_dtl`.`co_id`
        // WHERE
        //     `item_dtl`.`im_id` = $r->im_id
        //     GROUP BY
        //     `customer_order_dtl`.`co_id`,
        //     `customer_order_dtl`.`lc_id`,
        //     `item_dtl`.`im_id`
        //     ";
        //         $order_colour_res = $this->db->query($order_query)->result();
        // echo $this->db->last_query(); die();
        // echo '<pre>', print_r($order_colour_res), '</pre>'; die();
        foreach ($order_colour_res as $o_c_r)
        {
            if ($o_c_r->co_id == '')
            {
                continue;
            }
            $query = "SELECT
                      total_table.*,
                      IFNULL(SUM(total_table.final_qnty),0) AS final_qnty_new,
                      IFNULL(SUM(total_table.final_cut_qnty),0) AS final_cut_qnty_new,
                      IFNULL(SUM(total_table.final_rcv_qnty),0) AS final_rcv_qnty_new
                      FROM
                      (SELECT
                      cut_is_table.*,
                      IFNULL(SUM(cut_is_table.item_dtl_quantity * cutting_received_challan_detail.receive_cut_quantity),0) AS final_rcv_qnty
                      FROM
                      (SELECT
                      ord_table.*,
                      IFNULL(SUM(ord_table.item_dtl_quantity * cutting_issue_challan_details.cut_co_quantity),0) AS final_cut_qnty
                      FROM
                      (SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing.combination_or_not,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                    (article_costing_details.quantity * co_quantity) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`id_id` = $o_c_r->id_id
            )AS ord_table
    LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = ord_table.cod_id
    GROUP BY
   ord_table.cod_id) AS cut_is_table
   LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cut_is_table.cod_id
   GROUP BY
   cut_is_table.cod_id) AS total_table
   GROUP BY
    total_table.id_id
    ORDER BY
    total_table.co_no";
            $res = $this
                ->db
                ->query($query)->row();

            $arr = array(
                'co_no' => $res->co_no,
                'co_date' => $res->co_date,
                'buyer_reference_no' => $res->buyer_reference_no,
                'co_reference_date' => $res->co_reference_date,
                'name' => $res->name,
                'short_name' => $res->short_name,
                'item_name' => $res->item_name,
                'item_code' => $res->item_code,
                'ig_code' => $res->ig_code,
                'group_name' => $res->group_name,
                'unit' => $res->unit,
                'leather_color' => $res->leather_color,
                'fitting_color' => $res->fitting_color,
                'item_color' => $res->item_color,
                'item_color_id' => $res->item_color_id,
                'lc_id' => $res->lc_id,
                'id_id' => $res->id_id,
                'im_id' => $res->im_id,
                'ig_id' => $res->ig_id,
                'cod_id' => $res->cod_id,
                'co_id' => $res->co_id,
                'am_id' => $res->am_id,
                'costing_id' => $res->costing_id,
                'item_dtl' => $res->item_dtl,
                'item_dtl_quantity' => $res->item_dtl_quantity,
                'co_quantity' => $res->co_quantity,
                'temp_qnty' => $res->temp_qnty,
                'final_qnty' => $res->final_qnty_new,
                'final_cut_qnty' => $res->final_cut_qnty_new,
                'final_rcv_qnty' => $res->final_rcv_qnty_new,
                'combination_or_not' => $res->combination_or_not
            );

            // echo $this->db->last_query()."<br/>";
            // $this->db->insert('temp_consumption', $arr);
            array_push($data_array, $arr);
            // echo '<pre>', print_r($data_array), '</pre>';
            
        }

        foreach ($data_array as $d_a)
        {
            if ($d_a['item_color_id'] == $r->c_id)
            {
                array_push($customer_order, $d_a);
            }
        }

        $keys = array_column($customer_order, 'co_no');

        array_multisort($keys, SORT_ASC, $customer_order);

        // echo '<pre>', print_r($data_array), '</pre>'; die();
        
?>
												
	 <?php
        if (count($customer_order) > 0)
        {
?>										
      <td nowrap>
      	<?php
            foreach ($customer_order as $c_o)
            {
                echo $c_o['co_no'] . "<br/>";
?>
              <?php
            } ?>
      </td>
  <?php
        }
        else
        { ?>
  	  <td></td>
  <?php
        } ?>
      <?php
        if (count($customer_order) > 0)
        {
?>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {

                $order_quantity = $c_o['final_qnty'];
                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                $cut_issue_quantity = $c_o['final_cut_qnty'];
                $order_peng = ($order_quantity - $cut_issue_quantity);
                echo abs(round($order_peng, 2)) . "<br/>";
                $order_pending += $order_peng;
                $tot_order_pending += $order_peng;
            }
?>
      </td>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {

                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                $cut_is_quantity = $c_o['final_cut_qnty'];
                echo abs(round($cut_is_quantity, 2)) . "<br/>";
                $issue_quantity += $cut_is_quantity;
                $tot_issue_quantity += $cut_is_quantity;
            }
?>
      </td>
      <td style="text-align: right;">
      	<?php
            foreach ($customer_order as $c_o)
            {

                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                $cut_rv_quantity = $c_o['final_rcv_qnty'];
                echo abs(round($cut_rv_quantity, 2)) . "<br/>";
                $receive_quantity += $cut_rv_quantity;
                $tot_receive_quantity += $cut_rv_quantity;
            }
?>
      </td>
  <?php
        }
        else
        { ?>
  	   <td></td>
  	   <td></td>
  	   <td></td>
  <?php
        } ?>
  <td style="text-align: center;"><?=$r->name
?></td>
      <td style="text-align: right;">
      	<?php
        $opening_stock = $r->final_opening_stock;
        $sum_purchase_order = $r->final_pur_rcv_qnty;
        $sum_material_issue = $r->final_mat_issue_qnty;
        $sum_stock_in = $r->final_stock_in_qnty;

        $current_stock = ($opening_stock + $sum_purchase_order - $sum_material_issue + $sum_stock_in);

        echo number_format($current_stock, 2) . "<br/>";
        $tot_current_stock += $current_stock;
?>
      </td>
      <td style="text-align: right;">
      	<?php
        $sum_purchase_order_issue = $r->final_pur_issue_qnty;
        $sum_supp_purchase_order_issue = $r->final_sup_pur_order_qnty;
        $po_pending = ($sum_purchase_order_issue + $sum_supp_purchase_order_issue - $sum_purchase_order);

        echo number_format($po_pending, 2) . "<br/>";
        $tot_po_pending += $po_pending;
?>
      </td>
      <td style="text-align: right;">
      	<?php
        $balance = $open_lth + $order_pending + $issue_quantity - $receive_quantity - $current_stock - $po_pending;

        echo number_format($balance, 2) . "<br/>";
        $tot_balance += $balance;
?>
      </td>
      </tr>
      <tr style="background: #d4ecea;">
	    <th colspan="2">Total</th>
	    	 	 <td style="text-align: right;"><?php echo number_format($order_pending, 2);
        $order_pending = 0;
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($issue_quantity, 2);
        $issue_quantity = 0;
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($receive_quantity, 2);
        $receive_quantity = 0;
?></td>
	 	 <td></td>
	 	 <td style="text-align: right;"><?php echo number_format($current_stock, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($po_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($balance, 2);
?></td>
	 </tr>
   <?php
    }
?>
	 </tr>
      <tr style="background: #445767; color: white;">
	    <th colspan="2">Grand Total</th>
	    <td style="text-align: right;"><?php echo number_format($tot_order_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_issue_quantity, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_receive_quantity, 2);
?></td>
	 	 <td></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_current_stock, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_po_pending, 2);
?></td>
	 	 <td style="text-align: right;"><?php echo number_format($tot_balance, 2);
?></td>
	 </tr> 
								
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'leather_status_po')
{
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
		<?php if ($segment1 == 'leather_status_po')
    { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php
    }
    else
    { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php
    } ?>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th>PUR. #</th>
											<th>Supplier Name</th>
											<th>PUR. DT.</th>
											<th class="text-center">PUR. QNTY.</th>
											<th class="text-center">SUPP. #</th>
											<th class="text-center">SUPP. DT.</th>
											<th class="text-center">SUPP. QNTY.</th>
											<th class="text-center">RCPT. #</th>
											<th class="text-center">RCPT. DT.</th>
											<th class="text-center">RCPT. QNTY.</th>
											<th class="text-center">BAL. QNTY.</th>
										</tr>
									</thead>
									<tbody>
										<?php
    if (count($result) > 0)
    {
        foreach ($result as $r)
        {
            // foreach($item_id as $l) {
            // 	if($l == $r->item_dtl) {
            // 		continue 2;
            // 	}
            // }
            $pod_quantity = 0;
            $sup_quantity = 0;
            $rcv_quantity = 0;
            $bal_quantity = 0;
            $tot_pod_quantity = 0;
            $tot_sup_quantity = 0;
            $tot_rcv_quantity = 0;
            $tot_bal_quantity = 0;
?>
											<tr><th colspan="10" style="text-align: center;"><?=$r->item
?> (<?=$r->color
?>)</th>
											</tr>

   <?php

            $result_purc = $this
                ->db
                ->select('purchase_order.*, item_master.item, colors.color, item_dtl.id_id, acc_master.name')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->where('purchase_order_details.id_id', $r->id_id)
                ->where('purchase_order.status', '1')
                ->order_by('purchase_order.po_number')
                ->get_where('purchase_order')
                ->result(); ?>
             <?php
            if (count($result_purc) > 0)
            {
                foreach ($result_purc as $rc)
                { ?>
                <tr>                                                                        
             	<td>
             <?php
                    echo $rc->po_number . "<br />";
?>
             </td>
             <td>
             <?php
                    echo $rc->name . "<br />";
?>
             </td>
             <td>
             <?php
                    echo date("d-m-Y", strtotime($rc->po_date)) . "<br />";
?>
             </td>
             <td style="text-align: right;">
             <?php
                    $result_pu = $this
                        ->db
                        ->select_sum('purchase_order_details.pod_quantity')
                        ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
                        ->where('purchase_order_details.id_id', $rc->id_id)
                        ->where('purchase_order_details.po_id', $rc->po_id)
                        ->where('purchase_order.status', '1')
                        ->group_by('purchase_order_details.po_id')
                        ->get_where('purchase_order_details')
                        ->row(); ?>
            <?php
                    if (count($result_pu) > 0)
                    {
                        $pod_quantity += $result_pu->pod_quantity;
                        $tot_pod_quantity += $result_pu->pod_quantity;
                        echo $result_pu->pod_quantity . "<br />";
                    }
                    else
                    {
                        echo "<br />";
                    }
?>
             </td>
             <td>
             <?php
                    $result_sup = $this
                        ->db
                        ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                        ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.po_id', $rc->po_id)
                        ->where('supp_purchase_order.supp_status', '1')
                        ->get_where('supp_purchase_order_detail')
                        ->result(); ?>
            <?php
                    if (count($result_sup) > 0)
                    {
                        foreach ($result_sup as $r_s)
                        {
                            echo $r_s->supp_po_number . "<br />";
                        }
                    }
                    else
                    {
                        echo "<br />";
                    }
?>
             </td>
             <td>
             <?php
                    $result_sup = $this
                        ->db
                        ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                        ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.po_id', $rc->po_id)
                        ->where('supp_purchase_order.supp_status', '1')
                        ->get_where('supp_purchase_order_detail')
                        ->result(); ?>
            <?php
                    if (count($result_sup) > 0)
                    {
                        foreach ($result_sup as $r_s)
                        {
                            echo date("d-m-Y", strtotime($r_s->pur_order_date)) . "<br />";
                        }
                    }
                    else
                    {
                        echo "<br />";
                    }
?>
             </td>
             <td style="text-align: right;">
             <?php
                    $result_sup = $this
                        ->db
                        ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                        ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.po_id', $rc->po_id)
                        ->where('supp_purchase_order.supp_status', '1')
                        ->get_where('supp_purchase_order')
                        ->row();
                    if (count($result_sup) > 0)
                    {
                        $result_su = $this
                            ->db
                            ->select('supp_purchase_order_detail.item_qty')
                            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                            ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                            ->where('supp_purchase_order_detail.status', '1')
                        // ->group_by('supp_purchase_order_detail.sup_id')
                        
                            ->get_where('supp_purchase_order_detail')
                            ->result();
                        if (count($result_su) > 0)
                        {
                            foreach ($result_su as $r_s)
                            {
?>
            <?php
                                $sup_quantity += $r_s->item_qty;
                                $tot_sup_quantity += $r_s->item_qty;
                                echo $r_s->item_qty . "<br />";
                            }
                        }
                    }
                    else
                    {
                        echo "<br />";
                    } ?>
             </td>



             <td>
             <?php
                    $result_rcv = $this
                        ->db
                        ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                        ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                        ->where('purchase_order_receive.status', '1')
                    // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                    
                        ->get_where('purchase_order_receive_detail')
                        ->result(); ?>
            <?php if (count($result_rcv) > 0)
                    {
                        foreach ($result_rcv as $r_r)
                        {
                            echo $r_r->purchase_order_receive_bill_no . "<br />";
                        }
                    }
                    else
                    {
                        echo "<br />";
                    }

?>
             </td>
             <td>
             <?php
                    $result_rcv = $this
                        ->db
                        ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                        ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                        ->where('purchase_order_receive.status', '1')
                    // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                    
                        ->get_where('purchase_order_receive_detail')
                        ->result(); ?>
            <?php if (count($result_rcv) > 0)
                    {
                        foreach ($result_rcv as $r_r)
                        {
                            echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
                        }
                    }
                    else
                    {
                        echo "<br />";
                    }
?>
             </td>
             <td style="text-align: right;">
             <?php
                    $result_rc = $this
                        ->db
                        ->select('purchase_order_receive_detail.item_quantity')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                        ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                        ->where('purchase_order_receive_detail.status', '1')
                    // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                    
                        ->get('purchase_order_receive_detail')
                        ->result();
?>
            <?php
                    if (count($result_rc) > 0)
                    {
                        foreach ($result_rc as $r_r)
                        {
                            $rcv_quantity += $r_r->item_quantity;
                            $tot_rcv_quantity += $r_r->item_quantity;
                            echo $r_r->item_quantity . "<br />";
                        }
                    }
                    else
                    {
                        echo "<br />";
                    }
?>
             </td>
             <td style="text-align: right;">
             	<?php
                    $result_pu = $this
                        ->db
                        ->select_sum('purchase_order_details.pod_quantity')
                        ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
                        ->where('purchase_order_details.id_id', $rc->id_id)
                        ->where('purchase_order_details.po_id', $rc->po_id)
                        ->where('purchase_order.status', '1')
                        ->group_by('purchase_order_details.po_id')
                        ->get_where('purchase_order_details')
                        ->row(); ?>
            <?php
                    if (count($result_pu) > 0)
                    {
                        $pod_quantity = $result_pu->pod_quantity;
                    }
                    else
                    {
                        $pod_quantity = 0;
                    }

                    $result_sup = $this
                        ->db
                        ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                        ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.po_id', $rc->po_id)
                        ->where('supp_purchase_order.supp_status', '1')
                        ->get_where('supp_purchase_order')
                        ->row();
                    if (count($result_sup) > 0)
                    {
                        $result_su = $this
                            ->db
                            ->select_sum('supp_purchase_order_detail.item_qty')
                            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                            ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                            ->where('supp_purchase_order_detail.status', '1')
                            ->group_by('supp_purchase_order.po_id')
                            ->get_where('supp_purchase_order_detail')
                            ->row();
                        if (count($result_su) > 0)
                        {
?>
            <?php
                            $sup_quantity = $result_su->item_qty;
                        }
                    }
                    else
                    {
                        $sup_quantity = 0;
                    }

                    $result_rc = $this
                        ->db
                        ->select_sum('purchase_order_receive_detail.item_quantity')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                        ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                        ->where('purchase_order_receive_detail.status', '1')
                        ->group_by('purchase_order_receive_detail.po_id')
                        ->get('purchase_order_receive_detail')
                        ->row();
?>
            <?php
                    if (count($result_rc) > 0)
                    {
                        $rcv_quantity = $result_rc->item_quantity;
                    }
                    else
                    {
                        $rcv_quantity = 0;
                    }
?>
            <?php
                    $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
                    $tot_bal_quantity += $bal_quantity;
                    echo $bal_quantity . "<br />";
?>
             </td>
             </tr>
             <?php
                }
            } ?>
             <tr>
             <tr>
             	<th colspan="3">
                 Total             	
             </th>
             <td style="text-align: right;">
             	<?php echo $tot_pod_quantity;
            $tot_pod_quantity = 0;
?>
             </td>
             <td colspan="3" style="text-align: right;">
             	<?php echo $tot_sup_quantity;
            $tot_sup_quantity = 0;
?>
             </td>
             <td colspan="3" style="text-align: right;">
             	<?php echo $tot_rcv_quantity;
            $tot_rcv_quantity = 0;
?>
             </td>
             <td colspan="3" style="text-align: right;">
             	<?php echo $tot_bal_quantity;
            $tot_bal_quantity = 0;
?>
             </td>
             </tr>											

											<?php
        }
    } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'checking_summary_status')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Summary Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								
								
								<?php if($category == 'emp') { ?>
								
								
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
										<th class="text-center">Employee</th>
										<th class="text-center">Entry Date</th>
										<th style="text-align: right;">Extra Time</th>
									    <th >Order No.</th>
                                        <th >Article</th>
                                        <th style="text-align: right;">Order Qnty</th>
                                        <th style="text-align: right;">   Ckng Qnty   </th>
                                        <th style="text-align: right;">   Oth Qnty   </th>
                                        <th>Remarks</th>
										</tr>
									</thead>
									<tbody>
									    
										<?php 
										
										
										$ii = 0;
										$checking_ii = 0;
										$order_checked_qnty = 0;
										$total_quantitys = 0;
										$total_checked_quantitys = 0;
										$total_rejected_quantitys = 0;
										$total_extra_time = 0;
										
										foreach ($result as $resls)
    {
        $ii = 0;
        $iter = 0;
        $total_quantitys = 0;
	    $total_checked_quantitys = 0;
	    $total_rejected_quantitys = 0;
	    $total_extra_time = 0;
        foreach($resls as $res1) {
        
        $checking_ii = 0;
        
        foreach($res1 as $res) {
            // echo '<pre>', print_r($res1), '</pre>'; die();
        
                          $ii++;
                          $checking_ii++;
        
?>

											<tr>
											    
											    
											    <?php 
											    if($ii == 1) {
											          $this->db->select('checking.*,checking_details.*, checking_details.checked_quantity AS mains_checked_qnty_val, checking_details.rejection_quantity, checking_details.remarks, checking.extra_time')
            ->join('checking', 'checking_details.checking_id=checking.checking_id', 'left')
                    ->join('colors', 'colors.c_id = checking_details.lc_id', 'left');
                    $this->db->where('checking.e_id', $res['e_id']);
                    $this->db->where_in('checking_details.co_id', $order);
                    // $this->db->where('checking_details.co_id', $res['co_id']);
                        $this->db->where('checking.checking_entry_date >=', $from)
                                ->where('checking.checking_entry_date <=', $to);
                    // $this->db->group_by('checking_details.cod_id');
                    $this->db->order_by('checking.checking_entry_date', 'asc');
                
                    
                    $num_rowsvals = $this->db->get('checking_details')->num_rows();
											        ?>
											        <td rowspan="<?= $num_rowsvals ?>"><?=   $res['emp_name']   ?></td>
											        <?php
											    }
											    ?>
											    
											    <?php 
											    if($checking_ii == 1) {
											        ?>
											    <td rowspan="<?= count($res1) ?>" style="white-space: nowrap;"><?=date("d-m-Y", strtotime($res['checking_entry_date'])) ?> (<?=date("D", strtotime($res['checking_entry_date'])) ?>)</td>
											    <?php
											    }
											    ?>
											    
											    <td style="text-align: right;"><?=  $res['extra_time']  ?>
											    <?php 
											    $total_extra_time += $res['extra_time'];
											    ?>
											    </td>
											    
												<td style="white-space: nowrap;"><?=$res['co_no']
?></td>
                                                <td><?=$res['art_no'] . '(' . $res['lc'] . ')' ?></td>
                                                <td style="text-align: right;"><?=$res['co_quantity'] ?>
                                                
                                                
                                                <?php 
                                                $total_quantitys += $res['co_quantity'];
                                                ?>
                                                
                                                
                                                </td>
                                                <td style="text-align: right;"><?=$res['checked_quantity'] ?>
                                                
                                                
                                                <?php 
                                                
                                                
                                                $order_checked_qnty += $res['checked_quantity'];
                                                
                                                
                                                ?>
                                                
                                                
                                                <?php 
                if (count($res1) == $checking_ii)
                {
                                                    echo '<br/><b>Total '.$order_checked_qnty.'</b>';
                                                    $order_checked_qnty = 0;
                                                ?>
                                                
                                                <?php 
                                                }
                                                ?>
                                                
                                                
                                                <?php 
                                                $total_checked_quantitys += $res['checked_quantity'];
                                                ?>
                                                
                                                
                                                </td>
                                                <td style="text-align: right;"><?=$res['rejection_quantity'] ?>
                                                
                                                
                                                <?php 
                                                $total_rejected_quantitys += $res['rejection_quantity'];
                                                ?>
                                                
                                                
                                                </td>
                                                <td><?=$res['remarks'] ?>
                                                </td>
											</tr>
											<?php
    
    
        }
        }
        
        
        
        ?>
        
        
        <tr style="background-color: #3a8c95; color: white;">
            <td colspan="2"><b>Total</b></td>
            <td style="text-align: right;"><?=   $total_extra_time   ?></td>
            <td colspan="3"></td>
            <td style="text-align: right;"><b><?= $total_checked_quantitys ?></b></td>
            <td style="text-align: right;"><b><?= $total_rejected_quantitys ?></b></td>
            <td></td>
        </tr>
        
    
    <?php
    
    
    
    
    
    } ?>
									</tbody>
								</table>
								
								
								<?php }
								
								
								else {
								
								
								?>
								
								
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
    										<th >Article</th>
    										<th >Colour</th>
    										<th class="text-center">Employee</th>
                                            <th style="text-align: right;">Order Qnty</th>
                                            <th style="text-align: right;">Checking Qnty</th>
                                            <th style="text-align: right;">Other Qnty</th>
                                            <th>Remarks</th>
                                            <th class="text-center">Entry Date</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										
										$ii = 0;
										$total_quantitys = 0;
										$ii_co = 0;
										$total_checked_quantitys = 0;
										$total_rejected_quantitys = 0;
										
										
										foreach($result as $key=>$ress) {
										    
										    
										    ?>
										    
										    
										    <h4><b><?=   $key   ?></b></h4>
										    
										    
										    <?php
										    
										    
										 $ii_co = 0;   
										    
										    
										foreach ($ress as $resls)
    {
        
        
        

    
        $ii = 0;
        $total_quantitys = 0;
	    $total_checked_quantitys = 0;
	    $total_rejected_quantitys = 0;
        $colour_array = array();
        $checking_qnty_no = 0;
        
        // count sub total number
        $subtotal_num = 0;
        foreach($resls as $res) {
            if(!in_array($res['lc'], $colour_array)){
                if(!empty($colour_array)){
                    $subtotal_num++;
                }
                array_push($colour_array, $res['lc']);
            }
        }
        
        $colour_array = array();
        // echo $subtotal_num . ' .. ' . count($resls);
        $rowsspan = $subtotal_num + count($resls);
        
        foreach($resls as $res) {
            $ii++;
            $ii_co++;
            if(!in_array($res['lc'], $colour_array)){
                if(!empty($colour_array)){
            ?>
                    <tr style="background: #c3c4ea">
                        <td><strong>SUB TOTAL</strong></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right;font-weight:bold"><?php echo $checking_qnty_no; $checking_qnty_no=0;?></td>
                        <td colspan="4"></td>
                    </tr>
            <?php                          
                }
                array_push($colour_array, $res['lc']);
            }
                          
            ?>
											<tr>
											    
											    
											    
											    
											    
											    <?php 
											    if($ii == 1) {
											        ?>
											        <td rowspan="<?= $rowsspan + 1 ?>"><?=$res['art_no'] ?></td> <!-- +1 for last added sub total tr before main total  -->
											        <?php
											    }
											    ?>
											    
											    
												
												
												
												<td><?=$res['lc'] ?></td>
                                                <td><?=$res['emp_name'] ?></td>
                                                <td style="text-align: right;">
                                                    <?= $res['co_quantity'] ?>
                                                    <?php 
                                                    $total_quantitys += $res['co_quantity'];
                                                    ?>
                                                </td>
                                                <td style="text-align: right;">
                                                    <?php
                                                    $checking_qnty_no += $res['checked_quantity'];
                                                    echo $res['checked_quantity']; 
                                                    ?>
                                                
                                                
                                                <?php 
                                                $total_checked_quantitys += $res['checked_quantity'];
                                                ?>
                                                
                                                
                                                </td>
                                                <td style="text-align: right;"><?=$res['rejection_quantity'] ?>
                                                
                                                
                                                <?php 
                                                $total_rejected_quantitys += $res['rejection_quantity'];
                                                ?>
                                                
                                                
                                                </td>
                                                <td>
                                                <?php
                                                    if($res['remarks_for_other_quantity'] == 'OTHERS'){
                                                        echo $res['remarks'];
                                                    }else{
                                                        echo $res['remarks_for_other_quantity'];
                                                    }
                                                ?>
                                                </td>
                                                <td><?=date("d-m-Y", strtotime($res['checking_entry_date'])) ?></td>
											</tr>
											<?php
    
    
        }
        
        
        
        ?>
        
        <tr style="background: #c3c4ea">
            <!--<td></td>-->
            <td><strong>SUB TOTAL</strong></td>
            <td></td>
            <td></td>
            <td style="text-align:right;font-weight:bold"><?php echo $checking_qnty_no; $checking_qnty_no=0;?></td>
            <td colspan="4"></td>
        </tr>
        <tr style="background-color: #3a8c95; color: white;">
            <td colspan="3"><b>Total</b></td>
            <td style="text-align: right;"></td>
            <td style="text-align: right;"><b><?= $total_checked_quantitys ?></b></td>
            <td style="text-align: right;"><b><?= $total_rejected_quantitys ?></b></td>
            <td></td>
            <td></td>
        </tr>
        
    
    <?php
    
    
    
    
    
    }
    
    
										}
    
    
    ?>
									</tbody>
								</table>
								
								
								<?php 


								}
								
								
								?>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'checking_stock_detail_ledger')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Stock Summary Ledger</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                        <tr>
                            <th style="text-align:center">Item Name</th>
                            <th style="text-align:center">Remark</th>
                            <th style="text-align:center">Ref. No.</th>
                            <th style="text-align:center">Date</th>
                            <th style="text-align:center">Quantity</th>
                            <th style="text-align:center">Rate</th>
                            <th style="text-align:center">Value</th>
                            <th style="text-align:center">Bal. Qnty.</th>
                            <th style="text-align:center">Bal. Val.</th>
                        </tr>
                        </thead>
									<tbody>
										<?php
    $prev_item = '';
    foreach ($result as $f)
    {

        $crnt_item = $f['item'] . ' (' . $f['color'] . ')';
        if ($crnt_item != $prev_item)
        {
            $bal_qnty = 0;
            $bal_val = 0;
            $prev_item = $crnt_item;
        }

        if ($f['remark'] == 'Opening')
        {
            $bal_qnty += $f['qnty'];
            $bal_val += $f['val'];
        }
        elseif ($f['remark'] == 'Purchase')
        {
            $bal_qnty += $f['qnty'];
            $bal_val += $f['val'];
        }
        elseif ($f['remark'] == 'Stock In')
        {
            $bal_qnty += $f['qnty'];
            $bal_val += $f['val'];
        }
        elseif ($f['remark'] == 'Issue')
        {
            $bal_qnty -= $f['qnty'];
            $bal_val -= $f['val'];
        }
        elseif ($f['remark'] == 'Plating')
        {
            $bal_qnty -= $f['qnty'];
            $bal_val -= $f['val'];
        }
?>
                            <tr>
                        <td><?=$f['item'] . ' (' . $f['color'] . ')' ?></td>
                        <td><?=$f['remark'] ?></td>
                        <td><?=$f['sl_no'] ?></td>
                        <td style="text-align:center"><?=date('d-m-Y', strtotime($f['date'])) ?></td>
                        <td style="text-align:right"><?=number_format($f['qnty'], 2) ?></td>
                        <td style="text-align:right"><?=number_format($f['rate'], 2) ?></td>
                        <td style="text-align:right"><?=number_format($f['val'], 2) ?></td>
                        <td style="text-align:right"><?=number_format($bal_qnty, 2) ?></td>
                        <td style="text-align:right"><?=number_format($bal_val, 2) ?></td>
                    </tr>
                            <?php
    }
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'supplier_purchase_ledger')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align:center">RECEIPT #</th>
                    <th style="text-align:center">DATE</th>
                    <th style="text-align:right">QUANTITY</th>
                    <th style="text-align:right">AMOUNT</th>
                    <th style="text-align:right">DELV.</th>
                    <th style="text-align:right">TAX(CGST %)</th>
                    <th style="text-align:right">TAX(CGST Rs.)</th>
                    <th style="text-align:right">(SGST %)</th>
                    <th style="text-align:right">(SGST Rs.)</th>
                    <th style="text-align:right">TAX AMOUNT</th>
                    <th style="text-align:right">TOT. AMOUNT</th>
                </tr>
                                    </thead>
									<tbody>
<?php
$total_quantity = 0;
$total_amount = 0;
$total_delivery = 0;
$total_cgst = 0;
$total_sgst = 0;
$total_tax = 0;
$total_tot = 0;
    foreach ($result as $r)
    { 
    $total_quantity = 0;
$total_amount = 0;
$total_delivery = 0;
$total_cgst = 0;
$total_sgst = 0;
$total_tax = 0;
$total_tot = 0;?>
	<tr>
    <td colspan="11" style="text-align:center"><strong><?=$r->acc_name
?></strong></td>
				<?php
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        $opening_row = $this
            ->db
            ->select('purchase_order_receive.*, SUM(purchase_order_receive_detail.item_quantity) AS item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive.am_id', $r->am_id)
            ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')->group_by('purchase_order_receive_detail.purchase_order_receive_id')
            ->order_by('purchase_order_receive.purchase_order_receive_bill_no')
            ->get('purchase_order_receive_detail')
            ->result();

        foreach ($opening_row as $p_d)
        { ?>	
 <tr>	
     <td><?=$p_d->purchase_order_receive_bill_no ?></td>
     <td><?=date("d-m-Y", strtotime($p_d->purchase_order_receive_date)) ?></td>
     <td style="text-align:right"><?=$p_d->item_quantity ?><?php $total_quantity += $p_d->item_quantity; ?></td>
     <td style="text-align:right"><?=$p_d->total_amount ?><?php $total_amount += $p_d->total_amount; ?></td>
     <td style="text-align:right"><?=$p_d->delivery_charge ?><?php $total_delivery += $p_d->delivery_charge; ?></td>
     <td style="text-align:right"><?=$p_d->cgst_percent ?></td>
     <td style="text-align:right"><?=number_format(($p_d->total_amount + $p_d->delivery_charge) * $p_d->cgst_percent/100, 2) ?><?php $total_cgst += (($p_d->total_amount + $p_d->delivery_charge) * $p_d->cgst_percent/100); ?></td>
     <td style="text-align:right"><?=$p_d->sgst_percent ?></td>
     <td style="text-align:right"><?=number_format(($p_d->total_amount + $p_d->delivery_charge)* $p_d->sgst_percent/100, 2) ?><?php $total_sgst += (($p_d->total_amount + $p_d->delivery_charge)* $p_d->sgst_percent/100); ?></td>
     <td style="text-align:right"><?=$p_d->delivery_sgst_cgst_amount ?><?php $total_tax += $p_d->delivery_sgst_cgst_amount; ?></td>
     <td style="text-align:right"><?=$p_d->net_amount ?><?php $total_tot += $p_d->net_amount; ?></td>
 </tr>
           <?php
        } ?>
           </tr>
           <tr style="background-color: #6c6c7a; color: white;">
               <td colspan="2"><b>Total</b></td>
               <td style="text-align:right"><b><?= $total_quantity ?></b></td>
               <td style="text-align:right"><b><?= $total_amount ?></b></td>
               <td style="text-align:right"><b><?= $total_delivery ?></b></td>
               <td></td>
               <td style="text-align:right"><b><?= number_format($total_cgst, 2) ?></b></td>
               <td></td>
               <td style="text-align:right"><b><?= number_format($total_sgst, 2) ?></b></td>
               <td style="text-align:right"><b><?= $total_tax ?></b></td>
               <td style="text-align:right"><b><?= $total_tot ?></b></td>
           </tr>
           <?php
    } ?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'group_stock_summary')
{
    
    
    // echo '<pre>',print_r($result),'</pre>';
    
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    </br><br/>
					  From <b><?=date("d-m-Y", strtotime($from)) ?></b> To <b><?=date("d-m-Y", strtotime($to)) ?></b>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<?php
    if (isset($result))
    {
?>
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th colspan="11" style="text-align:center">LOCAL</th>
                </tr>
                <tr>
                    <th style="text-align:center">Group</th>
                    <th style="text-align:center">Open Qnty.</th>
                    <th style="text-align:center">Open Val.</th>
                    <th style="text-align:center">Pur. Qnty.</th>
                    <th style="text-align:center">Pur. Val.</th>
                    <th style="text-align:center">Issue Qnty.</th>
                    <th style="text-align:center">Issue Val.</th>
                    <th style="text-align:center">Stock In Qnty.</th>
                    <th style="text-align:center">Stock In Val.</th>
                    <th style="text-align:center">Bal. Qnty.</th>
                    <th style="text-align:center">Bal. Val.</th>
                </tr>
                </thead>
                <tbody>
                <?=$result['html'] ?>
                </tbody>
								</table>
								<br><br><br>

								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th colspan="11" style="text-align:center">IMPORT</th>
                </tr>
                <tr>
                    <th style="text-align:center">Group</th>
                    <th style="text-align:center">Open Qnty.</th>
                    <th style="text-align:center">Open Val.</th>
                    <th style="text-align:center">Pur. Qnty.</th>
                    <th style="text-align:center">Pur. Val.</th>
                    <th style="text-align:center">Issue Qnty.</th>
                    <th style="text-align:center">Issue Val.</th>
                    <th style="text-align:center">Stock In Qnty.</th>
                    <th style="text-align:center">Stock In Val.</th>
                    <th style="text-align:center">Bal. Qnty.</th>
                    <th style="text-align:center">Bal. Val.</th>
                </tr>
                </thead>
                <tbody>
                <?=$result['html2'] ?>
                </tbody>
								</table>
								<br><br><br>

								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th colspan="11" style="text-align:center">NONE</th>
                </tr>
                <tr>
                    <th style="text-align:center">Group</th>
                    <th style="text-align:center">Open Qnty.</th>
                    <th style="text-align:center">Open Val.</th>
                    <th style="text-align:center">Pur. Qnty.</th>
                    <th style="text-align:center">Pur. Val.</th>
                    <th style="text-align:center">Issue Qnty.</th>
                    <th style="text-align:center">Issue Val.</th>
                    <th style="text-align:center">Stock In Qnty.</th>
                    <th style="text-align:center">Stock In Val.</th>
                    <th style="text-align:center">Bal. Qnty.</th>
                    <th style="text-align:center">Bal. Val.</th>
                </tr>
                </thead>
                <tbody>
                <?=$result['html3'] ?>
                <?=$result['html4'] ?>
                </tbody>
								</table>
								<?php
    }
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'jobber_bill_summary')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align: center;">Jobber Name</th>
                    <th style="text-align: center;">Bill Number</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: right;">Total Pcs.</th>
                    <th style="text-align: right;">Issue Qnty.</th>
                    <th style="text-align: right;">Net Amount</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    $total_bill_amount = 0;
    $total_quantity = 0;
    $total_net_bill = 0;
    if (isset($result))
    {
        foreach ($result as $rs)
        {
            foreach ($rs as $r)
            {
?>
                    <tr>
                    	<td><?=$r->name
?></td>
                    	<td><?=$r->jobber_bill_number
?></td>
                    	<td><?=date("d-m-Y", strtotime($r->jobber_bill_date)) ?></td>
                    	<td style="text-align: right;"><?php echo $r->bill_amount;
                $total_bill_amount += $r->bill_amount;
?></td>
                    	<td style="text-align: right;"><?php echo $r->quantity;
                $total_quantity += $r->quantity;
?></td>
                    	<td style="text-align: right;"><?php echo $r->net_bill;
                $total_net_bill += $r->net_bill;
?></td>
                    </tr>
                	<?php
            }
        } ?>
                	<tr>
                		<th colspan="3">All Total</th>
                		<th style="text-align: right;"><?=$total_bill_amount
?></th>
                		<th style="text-align: right;"><?=$total_quantity
?></th>
                		<th style="text-align: right;"><?=$total_net_bill
?></th>
                	</tr>
                <?php
    } ?>
                </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'cutter_bill_summary')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align: center;">Acc Holder</th>
                    <th style="text-align: center;">Bill#</th>
                    <th style="text-align: center;">Bill Date</th>
                    <th style="text-align: right;">Total Qnty.</th>
                    <th style="text-align: right;">Total Parts.</th>
                    <th style="text-align: right;">Total Amnt.</th>
                </tr>
                </thead>
                <tbody>
                	<?php
    $total_bill_amount = 0;
    $total_quantity = 0;
    $total_net_bill = 0;
    if (isset($result))
    {
        foreach ($result as $rs)
        {
            foreach ($rs as $r)
            {
?>
                    <tr>
                    	<td><?=$r->name
?></td>
                    	<td><?=$r->cutter_bill_name
?></td>
                    	<td><?=date("d-m-Y", strtotime($r->cutter_bill_date)) ?></td>
                    	<td style="text-align: right;"><?php echo number_format($r->total_quantity, 2);
                $total_quantity += $r->total_quantity;
?></td>
                    	<td style="text-align: right;"><?php echo number_format($r->total_parts, 2);
                $total_net_bill += $r->total_parts;
?></td>
                    	 <td style="text-align: right;"><?php echo number_format($r->cutter_bill_total, 2);
                $total_bill_amount += $r->cutter_bill_total;
?></td>
                    </tr>
                	<?php
            }
        } ?>
                	<tr>
                		<th colspan="3">All Total</th>
                		<th style="text-align: right;"><?=number_format($total_bill_amount, 2) ?></th>
                		<th style="text-align: right;"><?=number_format($total_quantity, 2) ?></th>
                		<th style="text-align: right;"><?=number_format($total_net_bill, 2) ?></th>
                	</tr>
                <?php
    } ?>
                </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

<?php if ($segment == 'material_issue_status_report')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>


<style>


    .sheet {
        
        
    width: 200mm;
    
    
}


hr {
     margin-top: 0; 
     margin-bottom: 0; 
    border: 0;
    border-top: 1px solid #3e2d2d;
}


</style>


		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
						    <h4><b>Customer Order No :<?= $result[0]->co_no ?></b></h4>
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align: center;">Item</th>
                    <th style="text-align: center;">  Actual Order  <br/>  Consumption  </th>
                    <th style="text-align: center;">  Quantity Consumed  </th>
                </tr>
                </thead>
                <tbody>
                	<?php
    $total_bill_amount = 0;
    $total_quantity = 0;
    $issued_quantity = '';
    $total_net_bill = 0;
    $total_values1 = 0;
    $total_values2 = 0;
    if (isset($result))
    {
        foreach ($result as $r)
        {
?>
                    <tr>
                    	<td><?=$r->item_name ?>
                    	- <?= $r->leather_color ?></td>
                    	<td style="text-align: right;"><?=round($r->final_qnty)
?><?php  $total_values1 += $r->final_qnty;  ?></td>
                    	<td style="text-align: right;">
                    	    
                    	    
                    	    <?php 
                    	    
                    	    $item_id_details_values = $this->db->select('id_id')->get_where('item_dtl', array('im_id' => $r->im_id, 'c_id' => $r->item_color_id))->row()->id_id;
                    	    $material_issue_quantity = $this->db->select('SUM(issue_quantity) AS issue_quantity, material_issue_slip_number, material_issue_date')->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')->group_by('material_issue_detail.material_issue_id')->get_where('material_issue_detail', array('co_id' => $r->co_id, 'id_id' => $item_id_details_values))->result();
                    	    
                    	    
                    	    ?>
                    	    
                    	    
                    	    
                    	    <?php 
                    	    
                    	    
                    	    if(count($material_issue_quantity) > 0) {
                    	        foreach($material_issue_quantity as $m_i_q) {
                    	        $issued_quantity .= $m_i_q->material_issue_slip_number.'['.date("d-m-Y", strtotime($m_i_q->material_issue_date)).'] - '. number_format($m_i_q->issue_quantity, 2)."<br/>";
                    	        $total_net_bill += ($m_i_q->issue_quantity);
                    	        }
                    	    } else {
                    	        $issued_quantity = '';
                    	        $total_net_bill += 0;
                    	    }
                    	    
                    	    
                    	    ?>
                    	    
                    	    
                    	    <?= $issued_quantity ?>
                    	    
                    	    
                    	    <?php if(count($material_issue_quantity) > 0)  {  ?>
                    	    
                    	    
                    	    <hr/>
                    	    <b><?= number_format($total_net_bill, 2) ?><?php  $total_values2 += $total_net_bill;   ?></b>
                    	    
                    	    
                    	    <?php  }  ?>
                    	    
                    	    
                    	    
                    	    
                    	    
                    	    <?php 
                    	    
                    	    
                    	    $total_net_bill = 0;
                    	    $issued_quantity = '';
                    	    
                    	    
                    	    ?>
                    	    
                    	    
                    	    
                    	    
                    	    
                    	    
                    	    </td>
                    <?php 
                $total_quantity += $r->final_qnty;
?>


                    </tr>
                	<?php
        } ?>
        <tr>
            <td><b>Grand Total</b></td>
            <td style="text-align: right;"><b><?=  $total_values1  ?></b></td>
            <td style="text-align: right;"><b><?=  $total_values2  ?></b></td>
        </tr>
                <?php
    } ?>
                </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'monthly_production_status')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                <th>Month</th>
                                <th>Date</th>
                                <th>Buyer Name</th>
                                <th style="text-align: right;">Shipment Qnty</th>
                </tr>
                </thead>
                <tbody>
                            <?php
    //                             echo '<pre>', print_r($fetch_all_monthly_buyer_report), '</pre>';die();
    $groups = array();
    foreach ($fetch_all_monthly_buyer_report as $fasd)
    {
        foreach ($fasd as $f)
        {
            $key = $f->mname;
            if (!isset($groups[$key]))
            {
                $groups[$key] = array(
                    'mname' => $f->mname,
                    'total_quantity' => $f->total_quantity,
                );
            }
            else
            {
                $groups[$key]['mname'] = $f->mname;
                $groups[$key]['total_quantity'] += $f->total_quantity;
            }
        }
    }
    //                            echo '<pre>', print_r($groups), '</pre>';die();
    $total = 0;
    foreach ($fetch_all_monthly_buyer_report as $fasd)
    {
        foreach ($fasd as $curr_key => $f)
        {

            $keys = array();
            foreach ($fasd as $key => $val)
            {
                if ($val->mname == $f->mname)
                {
                    array_push($keys, $key);
                }
            }
            //                                    echo '<pre>', print_r($keys), '</pre>';die();
            
?>
                                    <tr>
                                        <td><?=$f->mname
?></td>
                                        <td><?=date("d-m-Y", strtotime($f->package_date)) ?></td>
                                        <td><?=$f->name ?></td>
                                        <td style="text-align: right;"><?php $total += $f->total_quantity;
            echo $f->total_quantity; ?></td>
                                    </tr>

                                    <?php
            if (end($keys) == $curr_key)
            {
?>
                                        <tr>
                                            <th><?=$f->mname
?></th>
                                            <th colspan="2">Total for <?=$groups[$f->mname]['mname'] ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->mname]['total_quantity'], 2) ?></th>
                                        </tr>
                                        <?php
            }

        }
?>
                                <?php
    }
?>
                            <tr>
                                <th colspan="3">Grand Total</th>
                                <th style="text-align: right;"><?=number_format($total, 2) ?></th>
                            </tr>
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'fetch_production_register')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
			    <div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">PRODUCTION REGISTER</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    <?=   date('d-m-Y', strtotime($from))   ?> to <?=   date('d-m-Y', strtotime($to))   ?>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                <th>Date</th>
                                <th>Article Name</th>
                                <th>Colour</th>
                                <th>Challan</th>
                                <th style="text-align: right;">Challan Qnty.</th>
                                <th>Invoice Name</th>
                                <th style="text-align: right;">Invoice Qnty</th>
                </tr>
                </thead>
                <tbody>
                	<tr class="bg-primary">
                                <td colspan="5">
                                    <strong>Date: <?=$result[0]->challan_date ?></strong>
                                </td>
                                <td colspan="2">
                                    <strong>Opening Balance for:  <?=$closing_balance ?></strong>
                                </td>    
                            </tr>
                            <?php
    $total = 0;
    $total1 = 0;
    $total2 = 0;
    $inc_total = 0;
    $exp_total = 0;
    $iter = 1;
    foreach ($result as $curr_key => $f)
    {

        $total_row = count($result);

        $date_array = array();
        $month_array = array();
        $challan_array = array();
        foreach ($result as $key => $val)
        {
            if ($val->challan_date == $f->challan_date)
            {
                array_push($date_array, $key);
            }
            if ($val->mon == $f->mon)
            {
                array_push($month_array, $key);
            }
            if ($val->invoice_number_sort == $f->invoice_number_sort)
            {
                array_push($challan_array, $key);
            }
        }
        if ($f->challan_status == 0)
        {

?>
                                    <tr>
                                        <td><?=$f->challan_date?></td>
                                        <td><?=$f->article_name?></td>
                                        <td><?=$f->article_color?></td>
                                        <td><?=$f->challan_number?></td>
                                        <td style="text-align: right;"><?php $total += $f->challan_quantity;
                                            $closing_balance += $f->challan_quantity;
                                             echo round($f->challan_quantity); ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                          <?php
                       }
                       else
                    { ?>
              <tr>
                                        <td><?=$f->challan_date?></td>
                                        <td><?=$f->article_name?></td>
                                        <td><?=$f->article_color?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?=$f->challan_number?></td>
                                        <td style="text-align: right;"><?php $total1 += $f->challan_quantity;
                                            $total2 += $f->invoice_quantity;
                                            $closing_balance -= $f->challan_quantity;
                                            echo round($f->challan_quantity); ?>
                                        </td>
                                    </tr>
    <?php
        } ?>                                

                                    <?php
        if (end($challan_array) == $curr_key)
        {
?>
                                        <tr class="bg-primary">
                                            <th colspan="5"></th>
                                            <th colspan="2"> Total of <?=  $f->challan_number   ?> <span class="pull-right"><?php echo $total2; ?></span></th>
                                        </tr>
                                        <?php
            $total2 = 0;
        }
        if (end($date_array) == $curr_key)
        {
?>
                                        <tr class="bg-primary">
                                            <th colspan="2"> Closing balance on <?=$f->challan_date ?><span class="pull-right"><?=$closing_balance ?></span></th>
                                            <th colspan="3"> Total finished goods on <?=$f->challan_date ?><span class="pull-right"><?php $inc_total += $total; echo $total; ?></span></th>
                                            <th colspan="2"> Total sales on <?=$f->challan_date ?><span class="pull-right"><?php $exp_total += $total1; echo $total1; ?></span></th>
                                        </tr>
                                        <?php
            $total = 0;
            $total1 = 0;
        }
        if (end($month_array) == $curr_key)
        {
?>
                                        <tr class="bg-warning">
                                            <th colspan="2">For <?=$f->mon ?></th>
                                            <th colspan="3">Month-wise Income: <?=$inc_total ?></th>
                                            <th colspan="2">Month-wise Expences: <?=$exp_total ?></th>
                                        </tr>
                                        <?php
            $inc_total = 0;
            $exp_total = 0;
        }
        if ($iter != 1 and end($date_array) == $curr_key and $iter != $total_row)
        {
?>
                                            <tr class="bg-info">
                                                <td colspan="5"></td>
                                                <td colspan="2"><strong> <span class="pull-right">Opening Balance: <?=$closing_balance ?></strong></span></td>
                                            </tr>
                                            <?php
        }
        $iter++;

?>
                                <?php
    }
?>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'payroll_reports_advance_ledger')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">ADVANCE LEDGER</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                    <th>Emp. Name</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Advance Amount</th>
                                    <th>Advance Adjusted on</th>
                                    <th style="text-align: right;">Advance Adjusted Amount</th>
                                    <th style="text-align: right;">Balance</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $count = 0;
    $i = 1;
    $iter = 1;
    $balance = 0;
    $total_balance = 0;
    $show_array_new1 = array();
    foreach ($result as $res)
    {
        $count = 0;
        $i = 1;
        $iter = 1;
        $balance = 0;
        $total_balance = 0;
        $new_iter11 = 0;
        $show_array_new1 = array();
        foreach ($res as $a)
        {
?>
                                    <tr>
                                        <?php
            $a->date;
            $month_new = strtotime($a->date);
            $new_date = date("Y-m-d", strtotime($a->date));
            $show_array = array();
            $dates = array();
            $balance = ($a->ADV + $balance);
            $new_iter11 = 0;

            $new_sql = "SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') > '" . $new_date . "'
        ORDER BY advance.date asc";

            $new_res = $this
                ->db
                ->query($new_sql)->result();

            $extra_sql = "SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') > '" . $new_date . "'
        ORDER BY advance.date asc
        ";
            $salary_details_extra = $this
                ->db
                ->query($extra_sql)->num_rows();

            // echo $this->db->last_query();
            if (count($new_res) > 0)
            {
                //  echo $new_res[0]->date;
                if ($salary_details_extra == 1)
                {
                    $month_new_next_extra = date("d-m-Y", strtotime("-1 months", strtotime($new_res[0]->date)));
                    $month_new_next = strtotime($month_new_next_extra);
                }
                else
                {
                    $month_new_next = strtotime($new_res[0]->date);
                }
                $stepVal = '+1 month';
                while ($month_new < $month_new_next)
                {
                    $dates[] = date('M', $month_new);
                    $month_new = strtotime($stepVal, $month_new);
                }

                //   echo '<pre>', print_r($dates), '</pre>';
                

                foreach ($dates as $d)
                {
                    $sql = "SELECT employees.name,e_code,employees.pf_acc_no, salary.LOAN, salary.MON, employees.esi_acc_no,salary.T4,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $a->emp_id . "'
            ORDER BY employees.e_code";
                    $salary_details = $this
                        ->db
                        ->query($sql)->row();
                    if (count($salary_details) > 0 && $salary_details->LOAN != 0)
                    {
                        $balance = $balance - $salary_details->LOAN;
                        $last_balance = $balance;
                        $total_balance += $salary_details->LOAN;
                        $arr = array(
                            'loan' => $salary_details->LOAN,
                            'mon' => $salary_details->MON,
                            'balance' => $balance
                        );
                        array_push($show_array, $arr);

                    }

                }

            }
            else
            {
                $month_new_next = strtotime(date("Y-m-d"));
                $stepVal = '+1 month';
                while ($month_new <= $month_new_next)
                {
                    $dates[] = date('M', $month_new);
                    $month_new = strtotime($stepVal, $month_new);
                }

                foreach ($dates as $d)
                {
                    $sql = "SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC, salary.MON,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id = $a->emp_id
        GROUP BY salary.CODE
        ";
                    $salary_details = $this
                        ->db
                        ->query($sql)->row();

                    if (count($salary_details) > 0 && $salary_details->LOAN != 0)
                    {
                        $balance = $balance - $salary_details->LOAN;
                        $last_balance = $balance;

                        $arr = array(
                            'loan' => $salary_details->LOAN,
                            'mon' => $salary_details->MON,
                            'balance' => $balance
                        );
                        array_push($show_array, $arr);
                    }
                }

            }

            $sql = "SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC, salary.MON,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE employees.e_id = $a->emp_id
        GROUP BY salary.CODE
        ";
            $res = $this
                ->db
                ->query($sql)->result();
            $count = count($show_array);
?>
                                        <?php if ($i == 1)
            { ?>
                                        <td rowspan="<?=$count + 1 ?>"><?=$a->name . '[' . $a->e_code . ']' ?></td>
                                        <td rowspan="<?=$count + 1 ?>"><?='Advance Taken on: ' . $a->MONNAME ?></td>
                                        <td rowspan="<?=$count + 1 ?>" style="text-align: right;">
                                            <?=$a->ADV
?>
                                            <?php
                $new_sqll = "SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date
        FROM advance
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') < '" . $new_date . "'";
                $new_ress = $this
                    ->db
                    ->query($new_sqll)->num_rows();
                if ($new_ress > 0)
                {

                    $new_sql = "SELECT advance.emp_id, SUM(advance.amount) AS new_adv, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') < '" . $new_date . "'
        ORDER BY advance.date";
                    $new_res = $this
                        ->db
                        ->query($new_sql)->row();
                        
                    echo ' <br/> + <br/> ' . number_format(abs($new_res->new_adv - $total_balance), 2) . '(Prev)';
                    $last_balance = 0;

                } ?>
                                            </td>
                                        <?php
            } ?>
            

                                        <?php 
                                        
                                        // echo '<pre>', print_r($show_array), '</pre>';
                                        
                                        foreach ($show_array as $r)
            {
                $show_month_new_array = explode("~", $r['mon'])
?>
                                        <tr>
                                        <td><?=$show_month_new_array[0] ?></td>
                                        <td style="text-align: right;"><?=$r['loan'] ?></td>
                                        <td style="text-align: right;"><?=$r['balance'] ?></td>
                                        </tr>
                                        <?php
                $arr = array(
                    'loan' => $r['loan'],
                    'mon' => $r['mon']
                );
                array_push($show_array_new1, $arr);
                $i++;
            }
            //   echo '<pre>', print_r($show_array_new1), '</pre>';
            $count = 0;
            $i = 1;
?>
                                    </tr>
                                    <?php
        }
        $iter++;
    }
?>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'payroll_reports_leave')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">LEAVE DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <!-- <tr>
                                    <th>Emp. Name</th>
                                    <th>Month</th>
                                    <th>Casual Leave</th>
                                    <th>Earn Leave</th>
                                    <th>ESI Leave</th>
                                </tr> -->
                                <tr>
                		<th>Emp. Name</th>
                		<th>Leave</th>
                		<th style="text-align: right;">Total <br/> Granted</th>
                	<?php $dates = array();
    $total_cl = 0;
    $total_el = 0;
    $total_esil = 0;
    $current = strtotime('2022-04-01');
    $total_salarys = 0;
    $total_leave = 0;
    $total_leaves_days = 0;
    $rate_total = 0;
    $total_amounts = 0;
    $date2 = strtotime('2023-03-01');
    $stepVal = '+1 month';
    $total_absent = 0;
    while ($current <= $date2)
    {
        $dates[] = date('M', $current);
        $dates1[] = date('m', $current);
        $current = strtotime($stepVal, $current);
    }
    foreach ($dates as $d)
    {
?>
<th style="text-align: right;"><?=$d
?></th>
                            			 <?php
    }
?>
                            			  <th style="text-align: right;">Total</th>
                            			  <th style="text-align: right;">Leave <br/> Blnc.</th>
                            			  <th style="text-align: right;">Wages <br/> Rate</th>
                            			  <th style="text-align: right;">Amount</th>
                            			  <th>Signature/Thumb</th>
                            			  <tr/>
                </thead>
                <tbody> 
                	<?php
    foreach ($result as $res)
    {
        foreach ($res as $a)
        {
?>
                                    <tr>
                                        <td rowspan="4"><?=$a->name . '[' . $a->e_code . ']' ?></td>
                                    <td>Casual Leave</td>
                                    <td style="text-align: right;"><?=$a->cl_granted ?></td>
                                    <?php foreach ($dates as $d)
            {
                $sql = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T4,salary.T5,salary.T6,CAST((salary.BASIC+salary.DA+salary.HRA) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $a->e_id . "' AND employees.user_id  != '13'
            ORDER BY employees.e_code";
                $salary_details = $this
                    ->db
                    ->query($sql)->row();
                if (count($salary_details) > 0)
                {
?>
<td style="text-align: right;"><b><?=$salary_details->T4
?><?php $total_cl += $salary_details->T4; $total_salarys += $salary_details->TOTAL2; $total_leave += ($salary_details->T5); ?><b/></td>
<?php
                }
                else
                { ?>
<td style="text-align: right;">0</td>                   			 
                            			 <?php
                }
            }
?>
                            			  <td style="text-align: right;"><b><?=$total_cl
?></b>
                            			  <td style="text-align: right;"><b><?php echo ($a->cl_granted - $total_cl);$total_cl = 0; ?></b></td>
                                         
                                         <td rowspan="4" style="text-align: right;"><br/><br/>
                                         <?= round(($a->basic_pay + $a->da_amout + $a->hra_amount)/26); ?>
                                         <?php
                                         $rate_total += round(($a->basic_pay + $a->da_amout + $a->hra_amount)/26);
                                         ?>
                                         </td>
                                         
                                         <?php 
                                         if(($a->el_granted - $total_leave) > 0) {
                                         $total_leaves_days = ($a->el_granted - $total_leave);
                                         } else {
                                         $total_leaves_days = 0;   
                                         }
                                         ?>
                            			  <td rowspan="4" style="text-align: right;"><br/><br/>
                            			  <?= number_format((round(($a->basic_pay + $a->da_amout + $a->hra_amount)/26) * $total_leaves_days), 2); ?>
                            			  <?php 
                            			  $total_amounts += (round(($a->basic_pay + $a->da_amout + $a->hra_amount)/26) * $total_leaves_days);
                            			  $total_leaves_days = 0;
                            			  $total_leave = 0;
                            			  ?>
                            		     </td>	  
                                    </tr>
                                    <tr>
                                    <td>Earn Leave</td>
                                    <td style="text-align: right;"><?=$a->el_granted ?></td>
                                    <?php foreach ($dates as $d)
            {
                $sql1 = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T5,CAST((salary.BASIC+salary.DA+salary.HRA) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $a->e_id . "' AND employees.user_id  != '13'
            ORDER BY employees.e_code";
                $salary_details1 = $this
                    ->db
                    ->query($sql1)->row();
                if (count($salary_details1) > 0)
                {
?>
<td style="text-align: right;"><b><?=$salary_details1->T5
?></b><?php $total_el += $salary_details1->T5; $total_salarys += $salary_details1->TOTAL2; ?></td>
<?php
                }
                else
                { ?>
<td style="text-align: right;">0</td>                   			 
                            			 <?php
                }
            }
?>
                            			  <td style="text-align: right;"><b><?=$total_el
?></b></td>
                            			  <td style="text-align: right;"><b><?php echo ($a->el_granted - $total_el);
            $total_el = 0; ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>E.S.I. Leave</td>
                                    <td></td>
                                    <?php foreach ($dates1 as $d)
            {
                $sql2 = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T6,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '%" . $d . "' AND employees.e_id='" . $a->e_id . "' AND employees.user_id  != '13'
            ORDER BY employees.e_code";
                $salary_details2 = $this
                    ->db
                    ->query($sql2)->row();
                if (count($salary_details2) > 0)
                {
?>
<td style="text-align: right;"><b><?=$salary_details2->T6
?><b/><?php $total_esil += $salary_details2->T6; ?></td>
<?php
                }
                else
                { ?>
<td style="text-align: right;">0</td>                   			 
                            			 <?php
                }
            }
?>
                            			  <td style="text-align: right;"><b><?=$total_esil
?></b><?php $total_esil = 0; ?></td>
                            			  <td></td>
                                    </tr>
                                    <tr>
                                    <td>Absent </td>
                                    <td></td>
                                    <?php foreach ($dates1 as $d)
            {
                $sql3 = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T7,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '%".$d."' AND employees.e_id='" . $a->e_id . "' AND employees.user_id  != '13'
            ORDER BY employees.e_code";
                $salary_details3 = $this
                    ->db
                    ->query($sql3)->row();
                if (count($salary_details3) > 0)
                {
?>
<td style="text-align: right;"><b><?=$salary_details3->T7
?><b/><?php $total_absent += $salary_details3->T7; ?></td>
<?php
                }
                else
                { ?>
<td style="text-align: right;">0</td>                   			 
                            			 <?php
                }
            }
?>
                            			  <td style="text-align: right;"><b><?=$total_absent
?></b><?php $total_absent = 0; ?></td>
                            			  <td></td>
                            			  <td class="text-center" align="center"><small><?='('.$a->name .')'?></small></td>
                                    </tr>
                                    <?php
        }
    }
?>



<tr>
    <td colspan="18"><b>Total</b></td>
    <td style="text-align: right;"><b><?= number_format($total_amounts, 2) ?></b></td>
</tr>


                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

<?php if ($segment == 'payroll_attendance')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">PAYROLL ATTENDANCE DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                                        <tr>
                                    		<th>Emp. Name</th>
                                    		<th>Particulars</th>
                                    		<!--<th style="text-align: right;">Total <br/> Granted</th>-->
                                        	<?php $dates = array();
                                            $total_cl = 0;
                                            $total_el = 0;
                                            $total_esil = 0;
                                            $current = strtotime('2022-04-01');
                                            $total_salarys = 0;
                                            $total_leave = 0;
                                            $total_leaves_days = 0;
                                            $rate_total = 0;
                                            $total_amounts = 0;
                                            $date2 = strtotime('2023-03-01');
                                            $stepVal = '+1 month';
                                            $total_absent = 0;
                                            while ($current <= $date2) {
                                                $dates[] = date('M', $current);
                                                $dates1[] = date('m', $current);
                                                $current = strtotime($stepVal, $current);
                                            }
                                            foreach ($dates as $d) {
                                            ?>
                                                <th style="text-align: right;"><?=$d?></th>
                                            <?php
                                            }
                                            ?>
                            			   <th style="text-align: right;">Total</th>
                            			   <!--<th style="text-align: right;">Leave <br/> Blnc.</th>-->
                            			</tr>
                                    </thead>
                                    <tbody> 
                                	<?php
                                    foreach ($result as $res)
                                    {
                                        // foreach ($res as $a)
                                        // {
                                    ?>
                                    <tr>
                                        <td rowspan="5"><?=$res[0]->name . '[' . $res[0]->e_code . ']' ?></td>
                                        <td>Working days</td>
                                        
                                        <?php 
                                        
                                        $wd = array();
                                        $dw = array();
                                        $hol = array();
                                        $lv = array();
                                        $abs = array();
                                        
                                        for($month_iter = 0; $month_iter < 12; $month_iter++){
                                            if(isset($res[$month_iter])){
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php 
                                                        array_push($wd, $res[$month_iter]->T1);
                                                        echo $res[$month_iter]->T1;
                                                    ?>
                                                </td>    
                                                <?php    
                                            }else{
                                                echo '<td>0</td>';
                                            }
                                        }
                                        ?>
                                        
                                        <td style="text-align: right;"><?=array_sum($wd)?></td>
                                    </tr>
                                    <tr>
                                        <td>Days worked</td>
                                        
                                        <?php 
                                        for($month_iter = 0; $month_iter < 12; $month_iter++){
                                            if(isset($res[$month_iter])){
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php 
                                                        array_push($dw, $res[$month_iter]->T2);
                                                        echo $res[$month_iter]->T2;
                                                    ?>
                                                </td>    
                                                <?php    
                                            }else{
                                                echo '<td>0</td>';
                                            }
                                        }
                                        ?>
                                        
                                        <td style="text-align: right;"><?=array_sum($dw)?></td>
                                    </tr>
                                    <tr>
                                        <td>Holidays</td>
                                        
                                        <?php 
                                        for($month_iter = 0; $month_iter < 12; $month_iter++){
                                            if(isset($res[$month_iter])){
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php 
                                                        array_push($hol, $res[$month_iter]->T3);
                                                        echo $res[$month_iter]->T3;
                                                    ?>
                                                </td>
                                                <?php    
                                            }else{
                                                echo '<td>0</td>';
                                            }
                                        }
                                        ?>
                                        
                                        <td style="text-align: right;"><?=array_sum($hol)?></td>
                                    </tr>
                                    <tr>
                                        <td>Leave</td>
                                        
                                        <?php 
                                        for($month_iter = 0; $month_iter < 12; $month_iter++){
                                            if(isset($res[$month_iter])){
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php 
                                                        $lvs = $res[$month_iter]->T4 + $res[$month_iter]->T5 + $res[$month_iter]->T6;
                                                        array_push($lv, $lvs);
                                                        echo $lvs;
                                                    ?>
                                                </td>
                                                <?php    
                                            }else{
                                                echo '<td>0</td>';
                                            }
                                        }
                                        ?>
                                        
                                        <td style="text-align: right;"><?=array_sum($lv)?></td>
                                    </tr>
                                    <tr>
                                        <td>Absent </td>
                                        
                                        <?php 
                                        for($month_iter = 0; $month_iter < 12; $month_iter++){
                                            if(isset($res[$month_iter])){
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php 
                                                        array_push($abs, $res[$month_iter]->T7);
                                                        echo $res[$month_iter]->T7;
                                                    ?>
                                                </td>  
                                                <?php    
                                            }else{
                                                echo '<td>0</td>';
                                            }
                                        }
                                        ?>
                                        
                                        <td style="text-align: right;"><?=array_sum($abs)?></td>
                                    </tr>
                                    <?php
                                    // }
                                }
                                ?>
                                
                                <!--<tr>-->
                                <!--    <td colspan="14"><b>Total</b></td>-->
                                <!--    <td style="text-align: right;"><b><?= number_format($total_amounts, 2) ?></b></td>-->
                                <!--</tr>-->

                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
<?php if ($segment == 'payroll_esi_pf')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">E.S.I. DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                    <th colspan="4">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="3">
                                        Month: <?=$mont ?><br />
                                        Date: <?=date('d-m-Y') ?><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th>Sr. #</th>
                                    <th>Emp. Name</th>
                                    <th>E.S.I. No.</th>
                                    <th>Actual Days Worked</th>
                                    <th style="text-align: right;">Gross Salary (Rs.)</th>
                                    <th style="text-align: right;">ESI @ 3.25%</th>
                                    <th style="text-align: right;">ESI @ 0.75%</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $total_gross = 0;
    $total_esi1 = 0;
    $total_esi2 = 0;
    if (isset($result))
    {
        foreach ($result as $res)
        {
            foreach ($res as $a)
            {
?>
                                    <tr>
                                        <td><?=$iter++
?></td>
                                        <td><?=$a->name . '[' . $a->e_code . ']' ?></td>
                                        <td><?=$a->esi_acc_no ?></td>
                                        <td><?=($a->T1 - $a->T7) ?></td>
                                        <td style="text-align: right;"><?php echo $a->GROSS;
                $total_gross += $a->GROSS; ?></td>
                                        <td style="text-align: right;"><?php echo floor($a->GROSS * (3.25 / 100));
                $total_esi1 += floor($a->GROSS * (3.25 / 100)); ?></td>
                                        <td style="text-align: right;"><?php echo floor($a->GROSS * (0.75 / 100));
                $total_esi2 += floor($a->GROSS * (0.75 / 100)); ?></td>
                                    </tr>
                                    <?php
            }
        }
?>
                                <tr>
                                    <th colspan="4">Grand Total</th>
                                    <th style="text-align: right;"><?=$total_gross
?></th>
                                    <th style="text-align: right;"><?=$total_esi1
?></th>
                                    <th style="text-align: right;"><?=$total_esi2
?></th>
                                </tr>
                                
                            <?php
    } ?>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

<?php if ($segment == 'purchase_order_audit_report')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">CUSTOMER ORDER WISE PURCHASE BRKUP</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Colour</th>
                                    <th>PURCH ORD NO</th>
                                    <th>PO DATE</th>
                                    <th>PO QNTY</th>
                                    <th>SUPP PURCH ORD NO</th>
                                    <th>SUPP DATE</th>
                                    <th>SUPP QNTY</th>
                                    <th>PURCH RCPT. NO</th>
                                    <th>RCPT. DT</th>
                                    <th>RCPT.QNTY</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $total_recv_qnty = 0;
    $total_gross = 0;
    $total_esi1 = 0;
    $total_esi2 = 0;
    if (isset($result))
    {
        foreach ($result as $res)
        {
            $this->db->select('purchase_ord_brk_up.*, item_master.item, colors.color, purchase_order_details.po_id, item_dtl.id_id');
                $this->db->join('purchase_order_details', 'purchase_order_details.pod_id = purchase_ord_brk_up.pod_id', 'left');
                $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->where("FIND_IN_SET(".$res->co_id.", purchase_ord_brk_up.cod_id)");
                $this->db->where_in('item_master.ig_id', $item_name);
                $this->db->order_by('item_master.item, colors.color', 'asc');
                $get_po_brks_id = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.status' => 1))->result();
?>
<tr><th colspan="11" class="text-center"><?=$res->co_no
?></th></tr>
                                    <tr>
                                            <?php 
                                            
                                            
                  foreach($get_po_brks_id as $g_p_b_i) {                          
                                            
                                            ?>
                                            <tr>
                                                <td>
                                            <?=   $g_p_b_i->item   ?>
                                            </td>
                                            <td>
                                            <?=   $g_p_b_i->color   ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('purchase_order.*');
                $this->db->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left');
                $this->db->where("purchase_order_details.pod_id", $g_p_b_i->pod_id);
                $get_po_ords_id = $this->db->get_where('purchase_order_details', array('purchase_order_details.status' => 1))->result();
                            
                                                
                           foreach($get_po_ords_id as $g_p_o_i) { 
                               echo $g_p_o_i->po_number."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('purchase_order.*');
                $this->db->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left');
                $this->db->where("purchase_order_details.pod_id", $g_p_b_i->pod_id);
                $get_po_ords_id = $this->db->get_where('purchase_order_details', array('purchase_order_details.status' => 1))->result();
                            
                                                
                           foreach($get_po_ords_id as $g_p_o_i) { 
                               echo date("d-m-Y", strtotime($g_p_o_i->po_date))."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                
                                                
                                                $this->db->select('SUM(purchase_ord_brk_up.co_quantity) AS co_quantity');
                $this->db->where("purchase_ord_brk_up.pod_id", $g_p_b_i->pod_id);
                $this->db->where("FIND_IN_SET(".$res->co_id.", cod_id)");
                $get_po_ords_idss = $this->db->get('purchase_ord_brk_up')->result();

                                                
                           foreach($get_po_ords_idss as $g_p_o_i) { 
                               echo $g_p_o_i->co_quantity."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('supp_purchase_order.*');
                $this->db->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left');
                $this->db->where("supp_purchase_order.po_id", $g_p_b_i->po_id);
                $this->db->where("supp_purchase_order_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('supp_purchase_order.sup_id');
                $get_supo_ords_id = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status' => 1))->result();
                            
                                                
                           foreach($get_supo_ords_id as $g_s_o_i) { 
                               echo $g_s_o_i->supp_po_number."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('supp_purchase_order.*');
                $this->db->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left');
                $this->db->where("supp_purchase_order.po_id", $g_p_b_i->po_id);
                $this->db->where("supp_purchase_order_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('supp_purchase_order.sup_id');
                $get_supo_ords_idss = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status' => 1))->result();
                            
                                                
                           foreach($get_supo_ords_idss as $gs) { 
                               echo date("d-m-Y", strtotime($gs->pur_order_date))."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.*');
                $this->db->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left');
                $this->db->where("supp_purchase_order.po_id", $g_p_b_i->po_id);
                $this->db->where("supp_purchase_order_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('supp_purchase_order.sup_id');
                $get_supo_ords_idssss = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status' => 1))->result();
                            
                                                
                           foreach($get_supo_ords_idssss as $gs) {
                               $this->db->select('SUM(item_qty) AS item_qty');
                $this->db->where("supp_purchase_order_detail.sup_id", $gs->sup_id);
                $this->db->where("supp_purchase_order_detail.id_id", $gs->id_id);
                $get_supo_value_idssss = $this->db->get_where('supp_purchase_order_detail', array('supp_purchase_order_detail.status' => 1))->row();
                echo $get_supo_value_idssss->item_qty;
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('purchase_order_receive_bill_no');
                                                $this->db->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left');
                $this->db->where("purchase_order_receive_detail.po_id", $g_p_b_i->po_id);
                $this->db->where("purchase_order_receive_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('purchase_order_receive.purchase_order_receive_id');
                $get_po_rcvs_id = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.status' => 1))->result();
                            
                                                
                           foreach($get_po_rcvs_id as $g_p_o_i) { 
                               echo $g_p_o_i->purchase_order_receive_bill_no."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                
                                                
                                                $this->db->select('purchase_order_receive_date');
                                                $this->db->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left');
                $this->db->where("purchase_order_receive_detail.po_id", $g_p_b_i->po_id);
                $this->db->where("purchase_order_receive_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('purchase_order_receive.purchase_order_receive_id');
                $get_po_rcvs_ids = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.status' => 1))->result();
                            
                                                
                           foreach($get_po_rcvs_ids as $g_p_o_i) { 
                               echo date("d-m-Y", strtotime($g_p_o_i->purchase_order_receive_date))."<br/>";
                                                ?>
                                            <?php } ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                
                                                
                                                $this->db->select('purchase_order_receive_detail.purchase_order_receive_id');
                                                $this->db->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left');
                $this->db->where("purchase_order_receive_detail.po_id", $g_p_b_i->po_id);
                $this->db->where("purchase_order_receive_detail.id_id", $g_p_b_i->id_id);
                $this->db->group_by('purchase_order_receive.purchase_order_receive_id');
                $get_po_rcvs_idss = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.status' => 1))->result();
                            
                            
                            
                            $total_recv_qnty = 0;
                            
                                                
                           foreach($get_po_rcvs_idss as $g_p) { 
                               $this->db->select('SUM(item_quantity) AS item_quantity');
                $this->db->where("purchase_order_receive_detail.purchase_order_receive_id", $g_p->purchase_order_receive_id);
                $this->db->where("purchase_order_receive_detail.id_id", $g_p_b_i->id_id);
                $get_po_rcvs_id_val = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.status' => 1))->row();
                $total_recv_qnty += $get_po_rcvs_id_val->item_quantity;
                               echo $get_po_rcvs_id_val->item_quantity."<br/>";
                                                ?>
                                            <?php } ?>
                                            <?php echo '<b>Total '.$total_recv_qnty.'</b>' ?>
                                            </td>
                                            </tr>
                                            <?php } ?>
                                    <?php
            }
?>

                            <?php
    } ?>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	
	<?php if ($segment == 'purchase_order_rate_setup_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">RATE DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->

								<table id="all_det" class="table table-bordered" style="width: 60%; margin: auto;">
									<thead>
                                <tr>
                                    <th style="width: 6%;">SL #</th>
                                    <th>Item</th>
                                    <th style="text-align: right;">Item Rate</th>
                                    <th>Purchase Bill No.</th>
                                    <th>Date</th>
                                    <th style="text-align: right;">Bill Rate</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $count_rows = 0;
    $item_name = '';
    foreach ($purchase_array as $a)
    {
        $count_rows = $this
            ->db
            ->get_where('purchase_order_receive_detail', array(
            'purchase_order_receive_id' => $a['purchase_order_receive_id'],
            'id_id' => $a['id_id']
        ))->num_rows();
        $today = date("Y-m-d");
        $rate_rows = $this
            ->db
            ->select('*')
            ->where("effective_date <=", $today)->order_by('effective_date', 'desc')
            ->get_where('item_rates', array(
            'item_rates.id_id' => $a['id_id'],
            'item_rates.am_id' => $a['am_id']
        ))->row();
?>
                                    <tr>
                                    	<?php if ($item_name != $a['item_name'])
        { ?>
                                    	<td style="width: 6%;"><?=$iter++; ?></td>
                                        <td><?=$a['item_name'] . '[' . $a['color'] . ']' ?></td>
                                        <?php if (count($rate_rows) > 0)
            { ?>
                                        <td style="text-align: right;"><?=$rate_rows->purchase_rate
?> (purchase rate) <br/> <?=$rate_rows->cost_rate ?> (cost rate) </td>
                                        <?php
            }
            else
            { ?>
                                        <td>-</td>
                                        <?php
            } ?>
                                    <?php
        }
        else
        { ?>
                                        <td style="width: 6%;"></td>
                                        <td></td>
                                        <td></td>
                                    <?php
        }
        $item_name = $a['item_name']; ?>
                                        <td><?=$a['purchase_bill_no'] ?></td>
                                        <td><?=date("d-m-Y", strtotime($a['created_date'])) ?></td>
                                        <td style="text-align: right;"><?=$a['purchase_rate'] ?></td>
                                    </tr>
                                    <?php
        $count_rows = 0;
    }
?>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'payroll_pf')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">P.F. DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                    <th colspan="5">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="3">
                                        Month: <?=$mont ?><br />
                                        Date: <?=date('d-m-Y') ?><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Sr. #</th>
                                    <th rowspan="2">Emp. Name</th>
                                    <th rowspan="2">P.F. A/C No.</th>
                                    <th rowspan="2">Actual Days Worked</th>
                                    <th rowspan="2" style="text-align: right;">Wages Eor EPF</th>
                                    <th class="text-center" rowspan="1">Employee</th>
                                    <th class="text-center" colspan="2" rowspan="1">Employer</th>
                                </tr>
                                <tr>
                                    <th rowspan="1" style="text-align: right;">P.F. @ 12%</th>
                                    <th rowspan="1" style="text-align: right;">P.F. @ 8.33%</th>
                                    <th rowspan="1" style="text-align: right;">P.F. @ 3.67%</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $total11 = 0;
    $total12 = 0;
    $total13 = 0;
    $total14 = 0;
    foreach ($result as $res)
    {
        foreach ($res as $a)
        {
?>
                                    <tr>
                                        <td><?=$iter++
?></td>
                                        <td><?=$a->name . '[' . $a->e_code . ']' ?></td>
                                        <td><?=$a->pf_acc_no ?></td>
                                        <td><?=($a->T1 - $a->T7) ?></td>
                                        <?php if ($a->pf_percentage_calculation != 'contractual')
            { ?>
                                        <td style="text-align: right;">
                                        <?php 
                                            echo $a->TOTAL2;
                                            $total11 += $a->TOTAL2; 
                                        ?>
                                        </td>
                                        <td style="text-align: right;">
                                        <?php 
                                            echo $val = floor(($a->TOTAL2 * (12 / 100)) > 1800) ? 1800 : floor($a->TOTAL2 * (12 / 100));
                                            $total12 += $val; 
                                        ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php 
                                                echo $pf2 = floor(($a->TOTAL2 * (8.33 / 100)) > 1250) ? 1250 : floor($a->TOTAL2 * (8.33 / 100));
                                                $total13 += $pf2; 
                                            ?>
                                        </td>
                                        <td style="text-align: right;">
                                        <?php 
                                            echo $pf3 = floor(($a->TOTAL2 * (3.67 / 100)) > 550) ? 550 : floor($a->TOTAL2 * (3.67 / 100));
                                            $total14 += $pf3; 
                                        ?>
                                        </td>
                                    <?php
            }
            else
            { ?>
                                        <td style="text-align: right;"><?php echo $a->TOTAL3;
                $total11 += $a->TOTAL3; ?></td>
                                        <td style="text-align: right;">
                                        <?php 
                                            echo $val = floor(($a->TOTAL3 * (12 / 100)) > 1800) ? 1800 : floor($a->TOTAL3 * (12 / 100));
                                            $total12 += $val; 
                                        ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php 
                                                echo $pf2 = floor(($a->TOTAL3 * (8.33 / 100)) > 1250) ? 1250 : floor($a->TOTAL3 * (8.33 / 100));
                                                $total13 += $pf2; 
                                            ?>
                                        </td>
                                        <td style="text-align: right;">
                                        <?php 
                                            echo $pf3 = floor(($a->TOTAL3 * (3.67 / 100)) > 550) ? 550 : floor($a->TOTAL3 * (3.67 / 100));
                                            $total14 += $pf3; 
                                        ?>
                                        </td>
                                    <?php
            } ?>
                                        
                                    </tr>
                                    <?php
        }
    }
?>
                                
                                <tr>
                                    <th colspan = "4"> Grand Total </th>
                                    <th style="text-align: right;"><?=$total11
?></th>
                                    <th style="text-align: right;"><?=$total12
?></th>
                                    <th style="text-align: right;"><?=$total13
?></th>
                                    <th style="text-align: right;"><?=$total14
?></th>
                                </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>

	<?php if ($segment == 'article_master_report_section')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">ARTICLE RATE REPORT</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="3" style="text-align: center;">INDIAN VALUE</th>
                                    <th colspan="3" style="text-align: center;">FOREIGN CURRENCY</th>
                                </tr>
                                <tr>
                                    <th>SN #</th>
                                    <th>ARTICLE NUMBER</th>
                                    <th>DESC</th>
                                    <th style="text-align: right;">EX-WORKS</th>
                                    <th style="text-align: right;">CIF</th>
                                    <th style="text-align: right;">FOB</th>
                                    <th style="text-align: right;">EX-WORKS</th>
                                    <th style="text-align: right;">CIF</th>
                                    <th style="text-align: right;">FOB</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $exworks_factory1 = 0;
    $cf_factory1 = 0;
    $fob_factory1 = 0;
    $exworks_factory2 = 0;
    $cf_factory2 = 0;
    $fob_factory2 = 0;
    foreach ($result as $a)
    {
?>
                                    <tr>
                                        <td><?=$iter++
?></td>
                                        <td><?=$a->art_no
?></td>
                                        <td><?=$a->info
?></td>
                                        <td style="text-align: right;"><?php
        $exworks_factory1 += $a->exworks_factory;
        echo $a->exworks_factory; ?></td>
                                        <td style="text-align: right;"><?php
        $cf_factory1 += $a->cf_factory;
        echo $a->cf_factory; ?></td>
                                        <td style="text-align: right;"><?php
        $fob_factory1 += $a->fob_factory;
        echo $a->fob_factory; ?></td>
                                        <td style="text-align: right;"><?php
        $exworks_factory2 += $a->exworks_office;
        echo $a->exworks_office; ?></td>
                                        <td style="text-align: right;"><?php
        $cf_factory2 += $a->cf_office;
        echo $a->cf_office; ?></td>
                                        <td style="text-align: right;"><?php
        $fob_factory2 += $a->fob_office;
        echo $a->fob_office; ?></td>
                                    </tr>
                                    <?php
    }
?>
                                <tr>
                                	<th colspan="3">Total</th>
                                	<th style="text-align: right;"><?=$exworks_factory1
?></th>
                                	<th style="text-align: right;"><?=$cf_factory1
?></th>
                                	<th style="text-align: right;"><?=$fob_factory1
?></th>
                                	<th style="text-align: right;"><?=$exworks_factory2
?></th>
                                	<th style="text-align: right;"><?=$cf_factory2
?></th>
                                	<th style="text-align: right;"><?=$fob_factory2
?></th>
                                </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>	

<?php if ($segment == 'supplier_wise_item_position')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th>PUR. #</th>
                    <th style="text-align:center">PUR. DT.</th>
                    <th style="text-align:center">PUR. QNTY.</th>
                    <th style="text-align:center">SUPP. #</th>
                    <th style="text-align:center">SUPP. DT.</th>
                    <th style="text-align:center">SUPP. QNTY.</th>
                    <th style="text-align:center">RCPT. #</th>
                    <th style="text-align:center">RCPT. DT.</th>
                    <th style="text-align:center">RCPT. QNTY.</th>
                    <th style="text-align:center">ITEM RATE</th>
                    <th style="text-align:center">BAL. QNTY.</th>
                </tr>
                                    </thead>
									<tbody>
				<?php
    $pod_quantity = 0;
    $sup_quantity = 0;
    $rcv_quantity = 0;
    $bal_quantity = 0;
    $tot_pod_quantity = 0;
    $tot_sup_quantity = 0;
    $tot_rcv_quantity = 0;
    $tot_rcv_rate = 0;
    $tot_bal_quantity = 0;
    $tot_pod_quantity1 = 0;
    $tot_sup_quantity1 = 0;
    $tot_rcv_quantity1 = 0;
    $tot_rcv_rate1 = 0;
    $tot_bal_quantity1 = 0;
    foreach ($result as $r)
    {

        $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`item`,
                                    `colors`.`color`,
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                    `purchase_order_details`.id_id = $r->id_id AND `purchase_order`.status = 1
                                GROUP BY
                                purchase_order.po_id
                                ORDER BY
                                purchase_order.po_number";

        $purchase_order_details = $this
            ->db
            ->query($query)->result();

?>

				 	<?php
        if (count($purchase_order_details) > 0)
        {
?>						
									<tr>
    <td colspan="10" style="text-align:center"><strong>{<?=$r->item
?>} ({<?=$r->color
?>})</strong></td>
</tr>
            <?php foreach ($purchase_order_details as $rc)
            {
?>
<tr>
    <td><?=$rc->po_number
?></td>
     <td><?=date("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
                $tot_pod_quantity += $rc->pod_quantity;
                $tot_pod_quantity1 += $rc->pod_quantity;
?></td>
     <td>
             <?php
                $result_sup = $this
                    ->db
                    ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                    ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                    ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                    ->where('supp_purchase_order.po_id', $rc->po_id)
                    ->where('supp_purchase_order.supp_status', '1')
                    ->get_where('supp_purchase_order_detail')
                    ->result(); ?>
            <?php
                if (count($result_sup) > 0)
                {
                    foreach ($result_sup as $r_s)
                    {
                        echo $r_s->supp_po_number . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }
?>
             </td>
             <td>
             <?php
                $result_sup = $this
                    ->db
                    ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                    ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                    ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                    ->where('supp_purchase_order.po_id', $rc->po_id)
                    ->where('supp_purchase_order.supp_status', '1')
                    ->get_where('supp_purchase_order_detail')
                    ->result(); ?>
            <?php
                if (count($result_sup) > 0)
                {
                    foreach ($result_sup as $r_s)
                    {
                        echo date("d-m-Y", strtotime($r_s->pur_order_date)) . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }
?>
             </td>
             <td style="text-align: right;">
             <?php
                $result_sup = $this
                    ->db
                    ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                    ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
                    ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                    ->where('supp_purchase_order.po_id', $rc->po_id)
                    ->where('supp_purchase_order.supp_status', '1')
                    ->get_where('supp_purchase_order')
                    ->row();
                if (count($result_sup) > 0)
                {
                    $result_su = $this
                        ->db
                        ->select('supp_purchase_order_detail.item_qty')
                        ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                        ->where('supp_purchase_order_detail.status', '1')
                    // ->group_by('supp_purchase_order_detail.sup_id')
                    
                        ->get_where('supp_purchase_order_detail')
                        ->result();
                    if (count($result_su) > 0)
                    {
                        foreach ($result_su as $r_s)
                        {
?>
            <?php
                            $tot_sup_quantity += $r_s->item_qty;
                            $tot_sup_quantity1 += $r_s->item_qty;
                            echo $r_s->item_qty . "<br />";
                        }
                    }
                }
                else
                {
                    echo "<br />";
                } ?>
             </td>



             <td>
             <?php
                $result_rcv = $this
                    ->db
                    ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
                    ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                    ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                    ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                    ->where('purchase_order_receive.status', '1')
                // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                
                    ->get_where('purchase_order_receive_detail')
                    ->result(); ?>
            <?php if (count($result_rcv) > 0)
                {
                    foreach ($result_rcv as $r_r)
                    {
                        echo $r_r->purchase_order_receive_bill_no . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }

?>
             </td>
             <td>
             <?php
                $result_rcv = $this
                    ->db
                    ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
                    ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                    ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                    ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                    ->where('purchase_order_receive.status', '1')
                // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                
                    ->get_where('purchase_order_receive_detail')
                    ->result(); ?>
            <?php if (count($result_rcv) > 0)
                {
                    foreach ($result_rcv as $r_r)
                    {
                        echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }
?>
             </td>
             <td style="text-align: right;">
             <?php
                $result_rc = $this
                    ->db
                    ->select('purchase_order_receive_detail.item_quantity')
                    ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                    ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                    ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                    ->where('purchase_order_receive_detail.status', '1')
                // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                
                    ->get('purchase_order_receive_detail')
                    ->result();
?>
            <?php
                if (count($result_rc) > 0)
                {
                    foreach ($result_rc as $r_r)
                    {
                        $tot_rcv_quantity += $r_r->item_quantity;
                        $tot_rcv_quantity1 += $r_r->item_quantity;
                        echo $r_r->item_quantity . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }
?>
             </td>
             
             <td style="text-align: right;">
             <?php
                $result_rc = $this
                    ->db
                    ->select('purchase_order_receive_detail.item_quantity, purchase_order_receive_detail.item_rate')
                    ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                    ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                    ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                    ->where('purchase_order_receive_detail.status', '1')
                // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                
                    ->get('purchase_order_receive_detail')
                    ->result();
?>
            <?php
                if (count($result_rc) > 0)
                {
                    foreach ($result_rc as $r_r)
                    {
                        $tot_rcv_rate += $r_r->item_rate;
                        $tot_rcv_rate1 += $r_r->item_rate;
                        echo $r_r->item_rate . "<br />";
                    }
                }
                else
                {
                    echo "<br />";
                }
?>
             </td>
             
             <td style="text-align: right;">
             	<?php
                $result_pu = $this
                    ->db
                    ->select_sum('purchase_order_details.pod_quantity')
                    ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
                    ->where('purchase_order_details.id_id', $rc->id_id)
                    ->where('purchase_order_details.po_id', $rc->po_id)
                    ->where('purchase_order.status', '1')
                    ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
                    ->get_where('purchase_order_details')
                    ->row(); ?>
            <?php
                if (count($result_pu) > 0)
                {
                    $pod_quantity = $result_pu->pod_quantity;
                }
                else
                {
                    $pod_quantity = 0;
                }

                $result_sup = $this
                    ->db
                    ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
                    ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
                    ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                    ->where('supp_purchase_order.po_id', $rc->po_id)
                    ->where('supp_purchase_order.supp_status', '1')
                    ->get_where('supp_purchase_order')
                    ->row();
                if (count($result_sup) > 0)
                {
                    $result_su = $this
                        ->db
                        ->select_sum('supp_purchase_order_detail.item_qty')
                        ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                        ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                        ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                        ->where('supp_purchase_order_detail.status', '1')
                        ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                        ->get_where('supp_purchase_order_detail')
                        ->row();
                    if (count($result_su) > 0)
                    {
?>
            <?php
                        $sup_quantity = $result_su->item_qty;
                    }
                }
                else
                {
                    $sup_quantity = 0;
                }

                $result_rc = $this
                    ->db
                    ->select_sum('purchase_order_receive_detail.item_quantity')
                    ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                    ->where('purchase_order_receive_detail.id_id', $rc->id_id)
                    ->where('purchase_order_receive_detail.po_id', $rc->po_id)
                    ->where('purchase_order_receive_detail.status', '1')
                    ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
                    ->get('purchase_order_receive_detail')
                    ->row();
?>
            <?php
                if (count($result_rc) > 0)
                {
                    $rcv_quantity = $result_rc->item_quantity;
                }
                else
                {
                    $rcv_quantity = 0;
                }
?>
            <?php
                $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
                $tot_bal_quantity += $bal_quantity;
                $tot_bal_quantity1 += $bal_quantity;
                echo $bal_quantity . "<br />";
?>
             </td>
         </tr>
     <?php
            } ?>
 </tr>
 <tr style="background: #d4ecea;">
 	<th colspan="2">Total</th>
 	<td style="text-align: right;"><?php echo $tot_pod_quantity;
            $tot_pod_quantity = 0;
?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_sup_quantity;
            $tot_sup_quantity = 0;
?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_rcv_quantity;
            $tot_rcv_quantity = 0;
?></td>
</td>
 	<td style="text-align: right;"><?php echo $tot_rcv_rate;
            $tot_rcv_rate = 0;
?></td>
 	<td style="text-align: right;"><?php echo $tot_bal_quantity;
            $tot_bal_quantity = 0;
?></td>
 </tr>
                <?php
        }
    } ?>
                <tr style="background: #445767; color: white;">
 	<th colspan="2">Grand Total</th>
 	<td style="text-align: right;"><?php echo $tot_pod_quantity1;
?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_sup_quantity1;
?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_rcv_quantity1;
?></td>
<td style="text-align: right;"><?php echo $tot_rcv_rate1;
?></td>
 	<td style="text-align: right;"><?php echo $tot_bal_quantity1;
?></td>
 </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	</div>

	<div class="A4" id="page-content">

	<?php if ($segment == 'jobber_ledger_status_report')
{
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">JOBBER LEDGER (ZERO)</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    <h4 class="mar_0"><?=$result[0]->name ?></h4>
						<p class="mar_0"><?=$result[0]->address ?></p>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
										    <th rowspan="2">Article</th>
											<th rowspan="2">Order No.</th>
											<th>Issue Challan</th>
											<th>Issue Date</th>
											<th style="text-align: right;">Issue Qnty.</th>
											<th>Rcpt. Name</th>
											<th>Rcpt. Date</th>
											<th style="text-align: right;">Rcpt. Qnty</th>
											<th style="text-align: right;">Bal Qnty</th>
										</tr>
									</thead>
									<tbody>
										<?php
    // $last_co_qnty[] = '';
    $total_jobber_issue = 0;
    $total_jobber_receive = 0;
    $total_balance = 0;
    foreach ($result as $res)
    {
        // if ($res->jobber_issue_quantity == 0)
        // {
        //     continue;
        // }
        			if(($res->jobber_issue_quantity - $res->jobber_receive_quantity) != 0) {
        				continue;
        			}
        
?>
											<tr>
											    <td style="font-size: 12px"><?=$res->art_no . ' [' . $res->color . ']' ?></td>
												<td style="font-size: 12px"><?=$res->co_no ?></td>
												<td class="">
													<?php
        echo $res->jobber_challan_number;
?>
													</td>
													<td nowrap class="">
													<?php
        echo $res->jobber_issue_date;
?>
													</td>
													<td class="" style="text-align: right;">
													<?php
        echo $res->jobber_issue_quantity;
        $total_jobber_issue += $res->jobber_issue_quantity;
?>
													</td>
												<td class="">
													<?php echo $res->jobr_challan;
?>
												</td>
												<td nowrap class="">
													<?php
        if ($res->jobr_challan_date != '')
        {
            echo $res->jobr_challan_date;
        }
        else
        {
            echo '';
        }
?>
												</td>
												<td class="" style="text-align: right;">
													<?php
        echo $res->jobr_challan_receive_quantity;
        $total_jobber_receive += $res->jobber_receive_quantity;
?>
												</td>

												<td class="" style="text-align: right;">
													<?php
        $balance_quantity = ($res->jobber_issue_quantity - $res->jobber_receive_quantity);
        echo $balance_quantity;
        $total_balance += $balance_quantity;
?>
												</td>
												
											</tr>
											<?php
    }
?>
										<tr>
										    <th colspan="4">Total</th>
										    <th style="text-align: right;"><?=$total_jobber_issue
?></th>
										    <th></th>
										    <th></th>
										    <th style="text-align: right;"><?=$total_jobber_receive
?></th>
										    <th style="text-align: right;"><?=$total_balance
?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	<?php if ($segment == 'jobber_ledger_status_report_non_zero')
{
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">JOBBER LEDGER (NON-ZERO)</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    <h4 class="mar_0"><?=$result[0]->name ?></h4>
						<p class="mar_0"><?=$result[0]->address ?></p>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
										    <th rowspan="2">Article</th>
											<th rowspan="2">Order No.</th>
											<th>Issue Challan</th>
											<th>Issue Date</th>
											<th style="text-align: right;">Issue Qnty.</th>
											<th>Rcpt. Name</th>
											<th>Rcpt. Date</th>
											<th style="text-align: right;">Rcpt. Qnty</th>
											<th style="text-align: right;">Bal Qnty</th>
										</tr>
									</thead>
									<tbody>
										<?php
    // $last_co_qnty[] = '';
    $total_jobber_issue = 0;
    $total_jobber_receive = 0;
    $total_balance = 0;
    foreach ($result as $res)
    {
        // if ($res->jobber_issue_quantity == 0)
        // {
        //     continue;
        // }
        if (($res->jobber_issue_quantity - $res->jobber_receive_quantity) == 0)
        {
            continue;
        }
?>
											<tr>
											    <td style="font-size: 12px"><?=$res->art_no . ' [' . $res->color . ']' ?></td>
												<td style="font-size: 12px"><?=$res->co_no ?></td>
												<td class="">
													<?php
        echo $res->jobber_challan_number;
?>
													</td>
													<td nowrap class="">
													<?php
        echo $res->jobber_issue_date;
?>
													</td>
													<td class="" style="text-align: right;">
													<?php
        echo $res->jobber_issue_quantity;
        $total_jobber_issue += $res->jobber_issue_quantity;
?>
													</td>
												<td class="">
													<?php echo $res->jobr_challan;
?>
												</td>
												<td nowrap class="">
													<?php
        if ($res->jobr_challan_date != '')
        {
            echo $res->jobr_challan_date;
        }
        else
        {
            echo '';
        }
?>
												</td>
												<td class="" style="text-align: right;">
													<?php
        echo $res->jobr_challan_receive_quantity;
        $total_jobber_receive += $res->jobber_receive_quantity;
?>
												</td>

												<td class="" style="text-align: right;">
													<?php
        $balance_quantity = ($res->jobber_issue_quantity - $res->jobber_receive_quantity);
        echo $balance_quantity;
        $total_balance += $balance_quantity;
?>
												</td>
												
											</tr>
											<?php
    }
?>
										<tr>
										    <th colspan="4">Total</th>
										    <th style="text-align: right;"><?=$total_jobber_issue
?></th>
										    <th></th>
										    <th></th>
										    <th style="text-align: right;"><?=$total_jobber_receive
?></th>
										    <th style="text-align: right;"><?=$total_balance
?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
<?php if ($segment == 'jobber_ledger_status_report_not_received')
{
?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">JOBBER LEDGER (NOT-RECEIVED)</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class="mar_0"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					    <h4 class="mar_0"><?=$result[0]->name ?></h4>
						<p class="mar_0"><?=$result[0]->address ?></p>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
										    <th rowspan="2">Article</th>
											<th rowspan="2">Order No.</th>
											<th>Issue Challan</th>
											<th>Issue Date</th>
											<th style="text-align: right;">Issue Qnty.</th>
											<th>Rcpt. Name</th>
											<th>Rcpt. Date</th>
											<th style="text-align: right;">Rcpt. Qnty</th>
											<th style="text-align: right;">Bal Qnty</th>
										</tr>
									</thead>
									<tbody>
										<?php
    // $last_co_qnty[] = '';
    $total_jobber_issue = 0;
    $total_jobber_receive = 0;
    $total_balance = 0;
    foreach ($result as $res)
    {
        // if ($res->jobber_issue_quantity == 0)
        // {
        //     continue;
        // }
        $get_no = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_number' => $res->jobber_issue_id, 'cod_id' => $res->cod_id))->num_rows();
        if ($get_no > 0)
        {
            continue;
        }
?>
											<tr>
											    <td style="font-size: 12px"><?=$res->art_no . ' [' . $res->color . ']' ?></td>
												<td style="font-size: 12px"><?=$res->co_no ?></td>
												<td class="">
													<?php
        echo $res->jobber_challan_number;
?>
													</td>
													<td nowrap class="">
													<?php
        echo $res->jobber_issue_date;
?>
													</td>
													<td class="" style="text-align: right;">
													<?php
        echo $res->jobber_issue_quantity;
        $total_jobber_issue += $res->jobber_issue_quantity;
?>
													</td>
												<td class="">
													
												</td>
												<td nowrap class="">
													
												</td>
												<td class="" style="text-align: right;">
													
												</td>

												<td class="" style="text-align: right;">
												<?php
												
												
												echo $res->jobber_issue_quantity;
												
												
												?>
												</td>
												
											</tr>
											<?php
    }
?>
										<tr>
										    <th colspan="4">Total</th>
										    <th style="text-align: right;"><?=$total_jobber_issue
?></th>
										    <th></th>
										    <th></th>
										    <th style="text-align: right;"></th>
										    <th style="text-align: right;"><?=$total_jobber_issue
?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<?php
} ?>
	</div>
	
	
	<?php if ($segment == 'order_summary')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<style>
			@media print{
			    thead{margin-top: 15px;}
			    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {font-size: 14px!important;padding:0!important;}
			    .mycell {
			        width: 20px!important;
			    }
			    .mycell1 {
			        width: 24px!important;
			    }
			    .mycell2 {
			        width: 20px!important;
			    }
			    table.order-summary th {position: unset;}		            
		        table.order-summary span{display:none;}
			}
			
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;text-align: left;font-size: 14px;
            }
		</style>
		<div class="legal landscape" id="page-content">
		<section class="sheet padding-5mm" style="height: auto; width: 460mm;">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">Customer Order Number :
						<br />
						<h5><?=implode(', ', $temp_co_name_array) ?></h5>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered order-summary" style="width: 100%;">
									<thead>
										<tr>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Article</th>
											<th rowspan="2">Ord <br/> Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="2" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th rowspan="2" class="text-center">Shipping<br>Information</th>
										</tr>
										<tr>
											<th height="30">Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bill</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Job Bill</th>
										</tr>
									</thead>
									<tbody>
										<?php
    $sub_co = 0;
    $sub_ci = 0;
    $sub_cr = 0;
    $sub_sr = 0;
    $sub_ji = 0;
    $sub_jr = 0;
    $sub_shp = 0;

    $grand_co = 0;
    $grand_ci = 0;
    $grand_cr = 0;
    $grand_sr = 0;
    $grand_ji = 0;
    $grand_jr = 0;
    $grand_shp = 0;

    $summary_co_names[] = '';
    $summary_co_iter = 1;

    // $last_co_qnty[] = '';
    foreach ($result as $res)
    {

        if (!in_array($res->co_no, $summary_co_names))
        {
            array_push($summary_co_names, $res->co_no);
            if ($summary_co_iter++ == 1)
            {
                // continue;
                
            }
            else
            {
?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="2">Total</th>
														<th class="text-right">
															<?php
                echo abs($sub_co - $grand_co);
                $sub_co = $grand_co;
                // array_push($last_co_qnty, var)
                
?>
														</th>
														<th class="text-right">
															<?php
                echo abs($sub_ci - $grand_ci);
                $sub_ci = $grand_ci;
?>
														</th>
														<th class="text-right">
															<?php
                echo abs($sub_cr - $grand_cr);
                // $sub_cr = $grand_cr;
                
?>
														</th>
														<th></th>
														<th class="text-right">
															<?php
                echo abs($sub_cr - $grand_cr);
                $sub_cr = $grand_cr;
?>
														</th>
														<th class="text-right">
															<?php
                echo abs($sub_sr - $grand_sr);
                $sub_sr = $grand_sr;
?>
														</th>
														<th class="text-right">
															<?php
                echo abs($sub_ji - $grand_ji);
                $sub_ji = $grand_ji;
?>
														</th>
														<th class="text-right">
															<?php
                echo abs($sub_jr - $grand_jr);
                $sub_jr = $grand_jr;
?>
														</th>
														
														<th class="text-right">
														    <?php 
		$get_jobber_bill_det_total_togethers = $this
            ->db->select('*, SUM(quantity) as total_quantity')
            ->get_where('jobber_bill_detail', array(
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row();
            echo $get_jobber_bill_det_total_togethers->total_quantity;
														    ?>
														</th>
														
														<th class="text-right">
															<?php
                echo abs($sub_shp - $grand_shp);
                $sub_shp = $grand_shp;
?>
														</th>
													</tr>
														<?php
            }
        }
?>
											<tr>
												<th class="mycell1" style="width: 10%;" height="60"><?=$res->co_no . '<br>(' . date('d-m-Y', strtotime($res->co_date)) . ')' ?></th>
												<th class="mycell" style="width: 20%;" height="60"><?=$res->art_no . ' [' . $res->color . ']' ?></th>
												<th class="mycell2" height="60" nowrap class="text-right print-text-center">
													<?php
        echo $res->co_quantity;
        $grand_co += $res->co_quantity;
?>
												</th>
												<th class="mycell2" height="60" nowrap class="">
													<?php if ($res->ci != '')
        {
            echo $res->ci . '<span>' . $res->cut_co_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->cut_date)) . ')';
            $grand_ci += $res->cut_co_quantity;
        } ?>	 	
												</th>
												<th class="mycell2" height="60" nowrap class="">
													<?php if ($res->cr != '')
        {
            echo $res->cr . '<span>' . $res->receive_cut_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->cut_rcv_date)) . ')';
            $grand_cr += $res->receive_cut_quantity;
        } ?>
													<br><br>
												</th>
													<?php
        $get_cutter_bill_det = $this
            ->db
            ->get_where('cutter_bill_dtl', array(
            'cut_id' => $res->cutting_issue_id,
            'cut_rcv_id' => $res->cutting_receive_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'leather_color' => $res->c_id
        ))
            ->row();

?>
													
													<th class="mycell2" height="60" nowrap class="">
													<?php
        if (count($get_cutter_bill_det) > 0)
        {
            $get_cutter_bill_detail_id = $get_cutter_bill_det->cb_id;
            $get_cutter_bill_details = $this
                ->db
                ->get_where('cutter_bill', array(
                'cb_id' => $get_cutter_bill_detail_id
            ))->row();
            if (count($get_cutter_bill_details) > 0)
            {
                echo $get_cutter_bill_details->cutter_bill_name . "<br/>" . date("d-m-Y", strtotime($get_cutter_bill_details->cutter_bill_date));
            }
        }
        else
        {
            echo '';
        }
?>
													</th>
												<th class="mycell2" height="60" nowrap class="">
													<?php if ($res->cr != '')
        {
            echo $res->cr . '<span>' . $res->receive_cut_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->cut_date)) . ')';
        } ?>
													<br><br>
												</th>
												
												<th class="mycell2" height="60" nowrap class="">
													<?php if ($res->sr != '')
        {
            echo $res->sr . '<span>' . $res->receive_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->skiving_receive_date)) . ')';
            $grand_sr += $res->receive_quantity;
        } ?>
													<br><br>
												</th>

												<th class="mycell2" height="60" nowrap class="">
													<?php if ($res->jobi != '')
        {
            echo $res->jobi . '<span>' . $res->jobber_issue_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->jobber_issue_date)) . ')';
            $grand_ji += $res->jobber_issue_quantity;
        }
?>
													 <br><br>
													</th>
												<th class="mycell2" height="60" nowrap class="">
												    <?php if ($res->jobr != '')
        {
            echo $res->jobr . '<span>' . $res->jobber_receive_quantity . '</span>' . '<br>(' . date('d-m-Y', strtotime($res->jobber_receipt_challan_date)) . ')';
            $grand_jr += $res->jobber_receive_quantity;
        }
?>
													<br><br>
												</th>
												
												<?php
        $get_jobber_bill_det = $this
            ->db->select('*, SUM(quantity) as total_quantity')
            ->group_by('jobber_challan_receipt_id')->get_where('jobber_bill_detail', array(
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->result();

?>
													
							<th class="mycell2" height="60" nowrap class="">
													<?php
        if (count($get_jobber_bill_det) > 0)
        {
            $get_jobber_bill_det_total_togethers = $this
            ->db->select('*, SUM(quantity) as total_quantity')
            ->get_where('jobber_bill_detail', array(
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row()->total_quantity;
            foreach($get_jobber_bill_det as $g_j_b_d) {
            $get_jobber_bill_details_id = $g_j_b_d->jobber_bill_id;
            $get_jobber_bill_details = $this
                ->db
                ->get_where('jobber_bill', array(
                'jobber_bill_id' => $get_jobber_bill_details_id
            ))->row();
            if (count($get_jobber_bill_details) > 0)
            {
                echo $get_jobber_bill_details->jobber_bill_number . "-(" . date("d-m-Y", strtotime($get_jobber_bill_details->jobber_bill_date)) . ")-".$g_j_b_d->total_quantity."<br/><span>" . $get_jobber_bill_det_total_togethers . "</span>";
            }
            }
        }
        else
        {
            echo '';
        }
?>
													</th>
												
												<?php $pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->group_by('packing_shipment_detail.packing_shipment_id')->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.cod_id' => $res->cod_id,
            'packing_shipment_detail.am_id' => $res->am_id,
            'packing_shipment_detail.lc_id' => $res->lc_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows(); ?>

              <?php if ($pack_shipment_num > 0)
        { ?>
												<?php $pack_shipment = $this
                ->db
                ->select('packing_shipment.package_name, SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->group_by('packing_shipment_detail.packing_shipment_id')->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->result(); ?>
			
			<?php $pack_ship_quantity = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->group_by('packing_shipment_detail.packing_shipment_id')->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->result();
                $pack_ship_quantity_total_togethers = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row();?>
                  
			
			
												<th class="mycell2" height="60" class="">
													<?php foreach($pack_shipment as $p_s) {
													echo $p_s->package_name . '-' . $p_s->article_quantity . '<br/><span>' . $pack_ship_quantity_total_togethers->article_quantity . '</span>';
            $grand_shp += $p_s->article_quantity;
													}
?>
												</th>
												
												<?php
        }
        else
        { ?>
												
												<th class="mycell2" height="60" class="">
												</th>
												
												<?php
        } ?>
												
											</tr>
											<?php
    }
    if (end($result))
    {
?>
											<tr style="background-color: #d9e2ea;">
												<th colspan="2">Total</th>
												<th class="text-right"><?=$grand_co - $sub_co ?></th>
												<th class="text-right"><?=$grand_ci - $sub_ci ?></th>
												<th class="text-right"><?=$grand_cr - $sub_cr ?></th>
												<th></th>										
												<th class="text-right"><?=$grand_cr - $sub_cr ?></th>
												<th class="text-right"><?=$grand_sr - $sub_sr ?></th>
												<th class="text-right"><?=$grand_ji - $sub_ji ?></th>
												<th class="text-right"><?=$grand_jr - $sub_jr ?></th>
												<th class="text-right">
												    <?php 
		$get_jobber_bill_det_total_togethers = $this
            ->db->select('*, SUM(quantity) as total_quantity')
            ->get_where('jobber_bill_detail', array(
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row();
            echo $get_jobber_bill_det_total_togethers->total_quantity;
														    ?>
												</th>
												<th class="text-right"><?=$grand_shp ?></th>
											</tr>
											<?php
    }
?>
										<tr style="background-color: #445767;color: white;">
											<th colspan="2">Grand Total</th>
											<th class="text-right"><?=$grand_co
?></th>
											<th class="text-right"><?=$grand_ci
?></th>
											<th class="text-right"><?=$grand_cr
?></th>
											<th></th>
											<th class="text-right"><?=$grand_cr
?></th>
											<th class="text-right"><?=$grand_sr
?></th>
											<th class="text-right"><?=$grand_ji
?></th>
											<th class="text-right"><?=$grand_jr
?></th>
											<th class="text-right">
											    <?php 
		$get_jobber_bill_det_total_togethers = $this
            ->db->select('*, SUM(quantity) as total_quantity')
            ->get_where('jobber_bill_detail', array(
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row();
            echo $get_jobber_bill_det_total_togethers->total_quantity;
														    ?>
											</th>
											<th class="text-right"><?=$grand_shp
?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
		<?php
} ?>
	
	
</body>

<?php if ($segment == 'supplier_wise_purchase_position')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			/*@media print{@page {size: landscape}}*/
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 12px;
}
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align:center">SUPPLIER NAME</th>
                    <th style="text-align:center">P.O. #</th>
                    <th style="text-align:center">PUR. DT.</th>
                    <th style="text-align:center">ITEM NAME</th>
                    <th style="text-align:center">PUR. QNTY.</th>
                    <th style="text-align:center">SUPP. #</th>
                    <th style="text-align:center">SUPP. DT.</th>
                    <th style="text-align:center">SUPP. QNTY.</th>
                    <th style="text-align:center">RCPT. #</th>
                    <th style="text-align:center">RCPT. DT.</th>
                    <th style="text-align:center">RCPT. QNTY.</th>
                    <th style="text-align:center">BAL. QNTY.</th>
                </tr>
                                    </thead>
									<tbody>
				<?php
    $pod_quantity = 0;
    $sup_quantity = 0;
    $rcv_quantity = 0;
    $bal_quantity = 0;
    $tot_pod_quantity = 0;
    $tot_sup_quantity = 0;
    $tot_rcv_quantity = 0;
    $tot_bal_quantity = 0;
    foreach ($result as $rc)
    { ?>						
									<tr>
    <td style="text-align:center"><?=$rc->name ?></td>
     <td><?=$rc->po_number ?></td>
     <td><?=date("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td><?=$rc->item ?> [<?=$rc->color ?>] </td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
        $tot_pod_quantity += $rc->pod_quantity; ?></td>
     <td>
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order_detail')
            ->result(); ?>
            <?php
        if (count($result_sup) > 0)
        {
            foreach ($result_sup as $r_s)
            {
                echo $r_s->supp_po_number . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td>
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order_detail')
            ->result(); ?>
            <?php
        if (count($result_sup) > 0)
        {
            foreach ($result_sup as $r_s)
            {
                echo date("d-m-Y", strtotime($r_s->pur_order_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
            // ->group_by('supp_purchase_order_detail.sup_id')
            
                ->get_where('supp_purchase_order_detail')
                ->result();
            if (count($result_su) > 0)
            {
                foreach ($result_su as $r_s)
                {
?>
            <?php
                    $tot_sup_quantity += $r_s->item_qty;
                    echo $r_s->item_qty . "<br />";
                }
            }
        }
        else
        {
            echo "<br />";
        } ?>
             </td>



             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo $r_r->purchase_order_receive_bill_no . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }

?>
             </td>
             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_rc = $this
            ->db
            ->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get('purchase_order_receive_detail')
            ->result();
?>
            <?php
        if (count($result_rc) > 0)
        {
            foreach ($result_rc as $r_r)
            {
                $tot_rcv_quantity += $r_r->item_quantity;
                echo $r_r->item_quantity . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             	<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc->id_id)
            ->where('purchase_order_details.po_id', $rc->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
?>
            <?php
        $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
        $tot_bal_quantity += $bal_quantity;
        echo $bal_quantity . "<br />";
?>
             </td>
</tr>
           <?php
    } ?>
           <tr>
               <th colspan="4">Total</th>
               <th style="text-align: right;"><?=$tot_pod_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_sup_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity
?></th>
               <th style="text-align: right;"><?=$tot_bal_quantity
?></th>
           </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
		<?php
} ?>
	
	<?php if ($segment == 'supplier_purchase_ledger_wo_zero')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;
                text-align: left;
                font-size: 12px;
            }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align:center">SUPPLIER NAME</th>
                    <th style="text-align:center">P.O. #</th>
                    <th style="text-align:center">PUR. DT.</th>
                    <th style="text-align:center">ITEM NAME</th>
                    <th style="text-align:center">PUR. QNTY.</th>
                    <th style="text-align:center">SUPP. #</th>
                    <th style="text-align:center">SUPP. DT.</th>
                    <th style="text-align:center">SUPP. QNTY.</th>
                    <th style="text-align:center">RCPT. #</th>
                    <th style="text-align:center">RCPT. DT.</th>
                    <th style="text-align:center">RCPT. QNTY.</th>
                    <th style="text-align:center">BAL. QNTY.</th>
                </tr>
                                    </thead>
									<tbody>
				<?php
    $pod_quantity = 0;
    $sup_quantity = 0;
    $rcv_quantity = 0;
    $bal_quantity = 0;
    $tot_pod_quantity = 0;
    $tot_sup_quantity = 0;
    $tot_rcv_quantity = 0;
    $tot_bal_quantity = 0;
    foreach ($result as $rc)
    { ?>	
				<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc->id_id)
            ->where('purchase_order_details.po_id', $rc->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
        $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
?>
            <?php
        if ($balc < 50)
        {
            continue;
        }
?>
									<tr>
    <td style="text-align:center"><?=$rc->name
?></td>
     <td><?=$rc->po_number
?></td>
     <td><?=date("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td><?=$rc->item ?> [<?=$rc->color ?>] </td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
        $tot_pod_quantity += $rc->pod_quantity; ?></td>
     <td>
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order_detail')
            ->result(); ?>
            <?php
        if (count($result_sup) > 0)
        {
            foreach ($result_sup as $r_s)
            {
                echo $r_s->supp_po_number . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td>
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order_detail')
            ->result(); ?>
            <?php
        if (count($result_sup) > 0)
        {
            foreach ($result_sup as $r_s)
            {
                echo date("d-m-Y", strtotime($r_s->pur_order_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
            // ->group_by('supp_purchase_order_detail.sup_id')
            
                ->get_where('supp_purchase_order_detail')
                ->result();
            if (count($result_su) > 0)
            {
                foreach ($result_su as $r_s)
                {
?>
            <?php
                    $tot_sup_quantity += $r_s->item_qty;
                    echo $r_s->item_qty . "<br />";
                }
            }
        }
        else
        {
            echo "<br />";
        } ?>
             </td>



             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo $r_r->purchase_order_receive_bill_no . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }

?>
             </td>
             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_rc = $this
            ->db
            ->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get('purchase_order_receive_detail')
            ->result();
?>
            <?php
        if (count($result_rc) > 0)
        {
            foreach ($result_rc as $r_r)
            {
                $tot_rcv_quantity += $r_r->item_quantity;
                echo $r_r->item_quantity . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             	<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc->id_id)
            ->where('purchase_order_details.po_id', $rc->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
?>
            <?php
        $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
        $tot_bal_quantity += $bal_quantity;
        echo $bal_quantity . "<br />";
?>
             </td>
</tr>
           <?php
    } ?>
           <tr>
               <th colspan="4">Total</th>
               <th style="text-align: right;"><?=$tot_pod_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_sup_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity
?></th>
               <th style="text-align: right;"><?=$tot_bal_quantity
?></th>
           </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
		<?php
} ?>

<?php if ($segment == 'supplier_wise_item_position_brkup_details') {
    // echo '<pre>',print_r($result),'</pre>';
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;
                text-align: left;
                font-size: 12px;
            }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				
				<?php if(count($result) > 0) { ?>
				
				<div class="row">
					<div class="container">
					    
					    <?php
					    
					    $supplier_name = [];
					    
					    foreach($result as $ressss) {
					        array_push($supplier_name, $ressss->name);
					    }
					    
					    $supplier_name_value = implode(",", array_unique($supplier_name));
					    
					    ?>
					    
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<h4><u>SUPPLIER NAME: <b><?= $supplier_name_value ?></b></u></h4>
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align:center">P.O. #</th>
                    <th style="text-align:center">PUR. DT.</th>
                    <th style="text-align:center">ITEM NAME</th>
                    <th style="text-align:center">BUYER'S REF. NO.</th>
                    <th style="text-align:center">SHP. DT - QNTY</th>
                    <th style="text-align:center">PO. QNTY.</th>
                    <th style="text-align:center">BAL. QNTY.</th>
                    <th style="text-align:center">EXPT. DT. <br/> FROM TANNERY</th>
                    <th style="text-align:center">RCPT. #</th>
                    <th style="text-align:center">RCPT. DT.</th>
                    <th style="text-align:center">RCPT. QNTY.</th>
                </tr>
                                    </thead>
                                    
                                    <?php 
                                    
                                    $groups[] = '';
											$new_it = 0;
                                foreach ($result as $rs) {
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rs->id_id)
            ->where('purchase_order_details.po_id', $rs->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rs->id_id)
            ->where('supp_purchase_order.po_id', $rs->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rs->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rs->id_id)
            ->where('purchase_order_receive_detail.po_id', $rs->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
        $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
?>
            <?php
        if ($balc < 100)
        {
            continue;
        }
                                    $key = $rs->id_id;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'id_id' => $rs->id_id,
                                            'item' => $rs->item,
                                            'color' => $rs->color,
                                        );
                                    } else {
                                        $groups[$key]['id_id'] = $rs->id_id;
                                        $groups[$key]['item'] = $rs->item;
                                        $groups[$key]['color'] = $rs->color;
                                    }
                                }
                                    
                                    ?>
                                    
									<tbody>
				<?php
    $pod_quantity = 0;
    $sup_quantity = 0;
    $rcv_quantity = 0;
    $bal_quantity = 0;
    $tot_pod_quantity = 0;
    $tot_sup_quantity = 0;
    $tot_pod_quantity_new_sub = 0;
    $tot_sup_quantity_new_sub = 0;
    $cod_id_array = array();
    $lc_ids_array[] = '';
    $tot_rcv_quantity = 0;
    $tot_bal_quantity = 0;
    $tot_bekup_consumption_quantity_new_sub = 0;
    $tot_bekup_consumption_quantity = 0;
    $tot_bekup_quantity_new_sub = 0;
    $tot_bekup_quantity = 0;
    $tot_rcv_quantity_new_sub = 0;
    $tot_bal_quantity_new_sub = 0;
    foreach ($result as $curr_key=>$rc)
    { ?>	
				<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc->id_id)
            ->where('purchase_order_details.po_id', $rc->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
        $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
?>
            <?php
        if ($balc < 100)
        {
            continue;
        }
        
        $keys[] = '';
                                    foreach($result as $key=>$rest) {
                                        if ($rest->id_id == $rc->id_id) {
                                            array_push($keys, $key);
                                        }
                                    }
        
?>
									<tr>
     <td><?=$rc->po_number?></td>
     <td><?=date("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td><?=$rc->item ?> [<?=$rc->color ?>] </td>
     
     <td>
         <?php
         $cod_id_string = '';
        $result_cod_idss = $this
            ->db
            ->select('cod_id')
            ->where('purchase_ord_brk_up.pod_id', $rc->pod_id)
            ->order_by('ord_date', 'asc')
            ->get('purchase_ord_brk_up')
            ->result(); 
            if(count($result_cod_idss) > 0) {
            foreach($result_cod_idss as $r_c_i) {
              $cod_id_string .=  $r_c_i->cod_id.',';  
            }
            } else {
              $cod_id_string .= '';
            }
            ?>
         <?php
         unset($cod_id_array);
         if($cod_id_string != '') {
        $cod_id_array = explode(",", $cod_id_string);
             array_unique($cod_id_array);
            //  echo '<pre>', print_r($cod_id_array), '</pre>'; die();
             foreach($cod_id_array as $co_id) {
                 if($co_id == '') {
                     continue;
                 }
         $cust_details = $this->db
                        ->select('buyer_reference_no, department')
                        ->join('user_details', 'user_details.user_id = customer_order.user_id', 'left')
                        ->join('departments', 'departments.d_id = user_details.user_dept', 'left')
                        ->from('customer_order')
                        ->where('co_id', $co_id)
                        ->get()
                        ->result();
                        foreach($cust_details as $c_d) {
                            echo $c_d->buyer_reference_no. "[" . $c_d->department . "]<br/>";
                        }
             }
         } else {
             echo ' - ';
         }
         ?>
     </td>
     <td>
         <?php
         
         $lc_ids_array[] = '';
         $order_query = "SELECT 
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
WHERE
    `item_dtl`.`im_id` = $rc->im_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this
            ->db
            ->query($order_query)->result();
            
            foreach($order_colour_res as $o_q) {
                array_push($lc_ids_array, $o_q->lc_id);
            }
         
         unset($cod_id_array);
         if($cod_id_string != '') {
             
             $cod_id_array = explode(",", $cod_id_string);
             
             array_unique($cod_id_array);
             
            //  echo '<pre>', print_r($cod_id_array), '</pre>'; die();
             
             foreach($cod_id_array as $co_id) {
                 
                 if($co_id == '') {
                     continue;
                 }
                 
                 $this->db->empty_table('temp_consumption_new');

        $data_array = array();
        $order_query = "SELECT
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`,
    `item_master`.`ig_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
WHERE
    `customer_order_dtl`.`co_id` = $co_id AND `ig_id` = $rc->ig_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    `item_dtl`.`im_id`";
        $order_colour_res = $this->db->query($order_query)->result();
        
        $cust_details_for_date_row = $this->db->select('customer_order.shipment_date, cust_order_brk_up.ord_date, SUM(cust_order_brk_up.co_quantity) as co_quantity')
                        ->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left')
                        ->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left')
                        ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
                        ->join('article_costing', 'article_costing.am_id = article_master.am_id', 'left')
                        ->join('article_costing_details', 'article_costing_details.ac_id = article_costing.ac_id', 'left')
                        ->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                        ->join('colors c1', 'customer_order_dtl.lc_id = c1.c_id', 'left')
                        ->join('colors c2', 'customer_order_dtl.fc_id = c2.c_id', 'left')
                        ->join('colors c3', 'item_dtl.c_id = c3.c_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                        ->where("customer_order.co_id", $co_id)
                        ->where_in("customer_order_dtl.lc_id", array_unique($lc_ids_array))
                        ->group_by('cust_order_brk_up.ord_date, item_master.im_id, customer_order_dtl.lc_id')
                        ->order_by('cust_order_brk_up.ord_date')
                        ->get_where('cust_order_brk_up', array("item_dtl.im_id" => $rc->im_id))
                        ->result();
                        
        if(count($cust_details_for_date_row) > 0) {
  
        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                cust_order_brk_up.ord_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                cust_order_brk_up.co_quantity,
                (
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN cust_order_brk_up ON cust_order_brk_up.cod_id = customer_order_dtl.cod_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                cust_order_brk_up.ord_date, item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                cust_order_brk_up.ord_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                cust_order_brk_up.co_quantity,
                (
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN cust_order_brk_up ON cust_order_brk_up.cod_id = customer_order_dtl.cod_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                cust_order_brk_up.ord_date, item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption_new')->result();
foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption_new', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption_new', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
}
}


        
            }
        
            }
            
        } else {
            
           foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                customer_order.shipment_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
        
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                customer_order.shipment_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption_new')->result();

foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption_new', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption_new', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
}
}


        
            }
        
            } 
            
        }

        $get_all_consumption_values = $this->db->get_where('temp_consumption_new', array('co_id' => $co_id, 'im_id' => $rc->im_id, 'lc_id' => $rc->c_id))->result();
        
            if(count($get_all_consumption_values) > 0) {
            
            foreach($get_all_consumption_values as $g_a_c_v) {
            if($g_a_c_v->co_date != '0000-00-00' || $g_a_c_v->co_date != '') {
                
                $tot_bekup_consumption_quantity_new_sub += $g_a_c_v->final_qnty;
                $tot_bekup_consumption_quantity += $g_a_c_v->final_qnty;
                
                            echo "<span>".date("d/m/Y", strtotime($g_a_c_v->co_date)). " - " . number_format($g_a_c_v->final_qnty, 2, '.', ',') ."</span><br/>";
                                } else {
                                    echo '-<br/>';
                                }
            }
            
            } else {
                
                echo '-<br/>';
                
            }

        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();
                 
             }
        
         } else {
             echo ' - ';
         }
         ?>
     </td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
        $tot_pod_quantity_new_sub += $rc->pod_quantity;
        $tot_pod_quantity += $rc->pod_quantity; ?>
     </td>
     <td style="text-align: right;">
             	<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc->id_id)
            ->where('purchase_order_details.po_id', $rc->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc->id_id)
            ->where('supp_purchase_order.po_id', $rc->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
?>
            <?php
        $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
        $tot_bal_quantity_new_sub += $bal_quantity;
        $tot_bal_quantity += $bal_quantity;
        echo $bal_quantity . "<br />";
?>
             </td>
     <td>
         
         <?php
        $result_date = $this
            ->db
            ->select('ord_date, co_quantity')
            ->where('purchase_ord_brk_up.pod_id', $rc->pod_id)
            ->order_by('ord_date', 'asc')
            ->get('purchase_ord_brk_up')
            ->result(); ?>
         
         <?php 
         if(count($result_date) > 0) {
             foreach($result_date as $r_d) {
                 $result_rc_for_calculate = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.purchase_order_receive_date <=', date("Y-m-d"))
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
        if (count($result_rc_for_calculate) > 0)
        {
            $rcv_quantity_for_calculate = $result_rc_for_calculate->item_quantity;
        }
        else
        {
            $rcv_quantity_for_calculate = 0;
        }
        $result_date_for_calculate = $this
            ->db
            ->select_sum('co_quantity')
            ->where('purchase_ord_brk_up.pod_id', $rc->pod_id)
            ->where('purchase_ord_brk_up.ord_date <=', date("Y-m-d"))
            ->get('purchase_ord_brk_up')
            ->row();
            $coss_quantity_for_calculate = $result_date_for_calculate->co_quantity;
            
            $tot_bekup_quantity_new_sub += $r_d->co_quantity;
            $tot_bekup_quantity += $r_d->co_quantity;
            
         if(strtotime(date("d-m-Y")) > strtotime($r_d->ord_date)) {
             if($coss_quantity_for_calculate < $rcv_quantity_for_calculate) {
         echo '<span style="color: red;"><b>'.date("d-m-Y", strtotime($r_d->ord_date)) .' - '.$r_d->co_quantity.'</b></span><br/>';
             } else {
         echo '<span>'.date("d-m-Y", strtotime($r_d->ord_date)).' - '.$r_d->co_quantity.'</span><br/>';        
             }
          } else { 
         echo '<span>'.date("d-m-Y", strtotime($r_d->ord_date)).' - '.$r_d->co_quantity.'</span><br/>';
         }
         }
         }
         ?>
     </td>
             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo $r_r->purchase_order_receive_bill_no . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }

?>
             </td>
             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_rc = $this
            ->db
            ->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc->po_id)
            ->where('purchase_order_receive_detail.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get('purchase_order_receive_detail')
            ->result();
?>
            <?php
        if (count($result_rc) > 0)
        {
            foreach ($result_rc as $r_r)
            {
                $tot_rcv_quantity_new_sub += $r_r->item_quantity;
                $tot_rcv_quantity += $r_r->item_quantity;
                echo $r_r->item_quantity . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
</tr>

      <?php
                if (end($keys) == $curr_key)
                {
?>
                                        <tr style="background-color: #d9e2ea;">
               <th colspan="4"> Total for <?= $rc->item ?> [ <?= $rc->color ?> ] </th>
               <th style="text-align: right;"><?=$tot_bekup_consumption_quantity_new_sub
?></th>
               <th style="text-align: right;"><?=$tot_pod_quantity_new_sub
?></th>
<th style="text-align: right;"><?=$tot_bal_quantity_new_sub
?></th>
               <th style="text-align: right;"><?=$tot_bekup_quantity_new_sub
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity_new_sub
?></th>
           </tr>
                                        <?php
                                        
                                        $tot_bekup_consumption_quantity_new_sub = 0;
                                        $tot_bekup_quantity_new_sub = 0;
                                        $tot_pod_quantity_new_sub = 0;
                                        $tot_bal_quantity_new_sub = 0;
                                        $tot_rcv_quantity_new_sub = 0;
                                        
                }
?>

           <?php
    } ?>
           <tr style="background-color: #445767; color: white;">
               <th colspan="4">Total</th>
               <th style="text-align: right;"><?=$tot_bekup_consumption_quantity
?></th>
               <th style="text-align: right;"><?=$tot_pod_quantity
?></th>
<th style="text-align: right;"><?=$tot_bal_quantity
?></th>
<th style="text-align: right;"><?=$tot_bekup_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity
?></th>
           </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<?php } ?>
				
			</div>
		</div>
	</section>
</div>
</body>
		<?php
} ?>

<?php if ($segment == 'supplier_wise_item_position_brkup_details_second') {
    // echo '<pre>',print_r($result),'</pre>';
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;
                text-align: left;
                font-size: 12px;
            }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				
				<?php if(count($result) > 0) { ?>
				
				<div class="row">
					<div class="container">
					    
					    <?php
					    
					   // $supplier_name = [];
					    
					   // foreach($result as $ressss) {
					   //     array_push($supplier_name, $ressss->name);
					   // }
					    
					    $supplier_name_value = '';
					    
					    ?>
					    
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								
								
								
								
								
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                    <th style="text-align:center">ITEM NAME</th>
                    <th style="text-align:center">BUYER'S REF. NO.</th>
                    <th style="text-align:center">SHP. DT - QNTY</th>
                    <th style="text-align:center"> PO. # </th>
                    <th style="text-align:center">PO. QNTY.</th>
                    <th style="text-align:center">BAL. QNTY.</th>
                    <th style="text-align:center">EXPT. DT. <br/> FROM TANNERY</th>
                    <th style="text-align:center">RCPT. #</th>
                    <th style="text-align:center">RCPT. DT.</th>
                    <th style="text-align:center">RCPT. QNTY.</th>
                </tr>
                                    </thead>
                                    
                                    <?php 
                                    
                                    
                                    $groups[] = '';
											$new_it = 0;
                                foreach ($result as $rs) {
        
                                    $key = $rs->id_id;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'id_id' => $rs->id_id,
                                            'item' => $rs->item,
                                            'color' => $rs->color,
                                        );
                                    } else {
                                        $groups[$key]['id_id'] = $rs->id_id;
                                        $groups[$key]['item'] = $rs->item;
                                        $groups[$key]['color'] = $rs->color;
                                    }
                                }
                                    
                                    ?>
                                    
									<tbody>
				<?php
    $pod_quantity = 0;
    $sup_quantity = 0;
    $rcv_quantity = 0;
    $bal_quantity = 0;
    $tot_pod_quantity = 0;
    $tot_sup_quantity = 0;
    $tot_pod_quantity_new_sub = 0;
    $tot_sup_quantity_new_sub = 0;
    $cod_id_array = array();
    $lc_ids_array[] = '';
    $tot_rcv_quantity = 0;
    $tot_bal_quantity = 0;
    $tot_bekup_consumption_quantity_new_sub = 0;
    $tot_bekup_consumption_quantity = 0;
    $tot_bekup_quantity_new_sub = 0;
    $tot_bekup_quantity = 0;
    $tot_rcv_quantity_new_sub = 0;
    $tot_bal_quantity_new_sub = 0;
    foreach ($result as $curr_key=>$rc)
    
    { 
    
    $i = 0;
    
    ?>	

            <?php
        
        $keys[] = '';
                                    foreach($result as $key=>$rest) {
                                        if ($rest->id_id == $rc->id_id) {
                                            array_push($keys, $key);
                                        }
                                    }
        
?>

<?php
     
     $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`im_id`,
                                    `purchase_order_details`.`pod_id`,
                                    `colors`.`c_id`,
                                    `item_master`.`ig_id`,
                                    `item_master`.`item`,
                                    `colors`.`color`,
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                     `purchase_order`.status = 1 AND `purchase_order_details`.`id_id` = $rc->id_id
                                GROUP BY
                                purchase_order.po_id, purchase_order_details.id_id
                                ORDER BY
                                item_master.item, colors.color, purchase_order.po_number";

            $po_result = $this->db->query($query)->result();
      
      foreach($po_result as $rc1) {
          
          $i++;
      
     ?>
									<tr>
									    
									    <?php
									    
									    if($i == 1) {
									    
									    ?>
									    
     <td rowspan="<?= count($po_result) ?>" ><?=$rc->item ?> [<?=$rc->color ?>] </td>
     
     <td rowspan="<?= count($po_result) ?>" >
         <?php
         if($co_id_order != '') {
            //  echo '<pre>', print_r($cod_id_array), '</pre>'; die();
         $cust_details = $this->db
                        ->select('buyer_reference_no, department')
                        ->join('user_details', 'user_details.user_id = customer_order.user_id', 'left')
                        ->join('departments', 'departments.d_id = user_details.user_dept', 'left')
                        ->from('customer_order')
                        ->where('co_id', $co_id_order)
                        ->get()
                        ->result();
                        foreach($cust_details as $c_d) {
                            echo $c_d->buyer_reference_no. "[" . $c_d->department . "]<br/>";
                        }
         } else {
             echo ' - ';
         }
         ?>
     </td>
     <td rowspan="<?= count($po_result) ?>" >
         <?php
         
         $lc_ids_array[] = '';
         $order_query = "SELECT 
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
WHERE
    `item_dtl`.`im_id` = $rc->im_id AND `customer_order_dtl`.`co_id` = $co_id_order
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this
            ->db
            ->query($order_query)->result();
            
            foreach($order_colour_res as $o_q) {
                array_push($lc_ids_array, $o_q->lc_id);
            }
         
         if($co_id_order != '') {
             
            //  echo '<pre>', print_r($cod_id_array), '</pre>'; die();
             
                 $this->db->empty_table('temp_consumption_new');

        $data_array = array();
        $order_query = "SELECT
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`,
    `item_master`.`ig_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
WHERE
    `customer_order_dtl`.`co_id` = $co_id_order AND `ig_id` = $rc->ig_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    `item_dtl`.`im_id`";
        $order_colour_res = $this->db->query($order_query)->result();
        
        $cust_details_for_date_row = $this->db->select('customer_order.shipment_date, cust_order_brk_up.ord_date, SUM(cust_order_brk_up.co_quantity) as co_quantity')
                        ->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left')
                        ->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left')
                        ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
                        ->join('article_costing', 'article_costing.am_id = article_master.am_id', 'left')
                        ->join('article_costing_details', 'article_costing_details.ac_id = article_costing.ac_id', 'left')
                        ->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                        ->join('colors c1', 'customer_order_dtl.lc_id = c1.c_id', 'left')
                        ->join('colors c2', 'customer_order_dtl.fc_id = c2.c_id', 'left')
                        ->join('colors c3', 'item_dtl.c_id = c3.c_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                        ->where("customer_order.co_id", $co_id_order)
                        ->where_in("customer_order_dtl.lc_id", array_unique($lc_ids_array))
                        ->group_by('cust_order_brk_up.ord_date, item_master.im_id, customer_order_dtl.lc_id')
                        ->order_by('cust_order_brk_up.ord_date')
                        ->get_where('cust_order_brk_up', array("item_dtl.im_id" => $rc->im_id))
                        ->result();
                        
        if(count($cust_details_for_date_row) > 0) {
  
        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                cust_order_brk_up.ord_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                cust_order_brk_up.co_quantity,
                (
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN cust_order_brk_up ON cust_order_brk_up.cod_id = customer_order_dtl.cod_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id_order AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                cust_order_brk_up.ord_date, item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                cust_order_brk_up.ord_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                cust_order_brk_up.co_quantity,
                (
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * cust_order_brk_up.co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN cust_order_brk_up ON cust_order_brk_up.cod_id = customer_order_dtl.cod_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id_order AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                cust_order_brk_up.ord_date, item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption_new')->result();
foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption_new', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption_new', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
}
}


        
            }
        
            }
            
        } else {
            
           foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                customer_order.shipment_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id_order AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
        
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                customer_order.shipment_date as co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id_order AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption_new')->result();

foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption_new', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption_new', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_new', $arr);
}
}


        
            }
        
            } 
            
        }

        $get_all_consumption_values = $this->db->get_where('temp_consumption_new', array('co_id' => $co_id_order, 'im_id' => $rc->im_id, 'lc_id' => $rc->c_id))->result();
        
            if(count($get_all_consumption_values) > 0) {
            
            foreach($get_all_consumption_values as $g_a_c_v) {
            if($g_a_c_v->co_date != '0000-00-00' || $g_a_c_v->co_date != '') {
                
                $tot_bekup_consumption_quantity_new_sub += $g_a_c_v->final_qnty;
                $tot_bekup_consumption_quantity += $g_a_c_v->final_qnty;
                
                            echo "<span>".date("d/m/Y", strtotime($g_a_c_v->co_date)). " - " . number_format($g_a_c_v->final_qnty, 2, '.', ',') ."</span><br/>";
                                } else {
                                    echo '-<br/>';
                                }
            }
            
            } else {
                
                echo '-<br/>';
                
            }

        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();
                 
        
         } else {
             echo ' - ';
         }
         ?>
     </td>
     
     <?php 
     
									    }
     
									    ?>
									    
									    <?php 
									    
									    $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc1->id_id)
            ->where('purchase_order_details.po_id', $rc1->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc1->id_id)
            ->where('supp_purchase_order.po_id', $rc1->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc1->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
        $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
?>
            <?php
        if ($balc < 100)
        {
            continue;
        }
									    
									    ?>
     
     
     
     
     <td>
     <?php 
        echo $rc1->po_number."<br/>";
        ?>
     </td>
     
     <td style="text-align: right;">
     <?php 
        echo $rc1->pod_quantity."<br/>";
        $tot_pod_quantity_new_sub += $rc1->pod_quantity;
        $tot_pod_quantity += $rc1->pod_quantity; 
        ?>
     </td>
     <td style="text-align: right;">
             	<?php
        $result_pu = $this
            ->db
            ->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $rc1->id_id)
            ->where('purchase_order_details.po_id', $rc1->po_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->row(); ?>
            <?php
        if (count($result_pu) > 0)
        {
            $pod_quantity = $result_pu->pod_quantity;
        }
        else
        {
            $pod_quantity = 0;
        }

        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $rc1->id_id)
            ->where('supp_purchase_order.po_id', $rc1->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select_sum('supp_purchase_order_detail.item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $rc1->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
?>
            <?php
        $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
        $tot_bal_quantity_new_sub += $bal_quantity;
        $tot_bal_quantity += $bal_quantity;
        echo $bal_quantity . "<br />";
?>
             </td>
     <td>
         
         <?php
        $result_date = $this
            ->db
            ->select('ord_date, co_quantity')
            ->where('purchase_ord_brk_up.pod_id', $rc1->pod_id)
            ->order_by('ord_date', 'asc')
            ->get('purchase_ord_brk_up')
            ->result(); ?>
         
         <?php 
         if(count($result_date) > 0) {
             foreach($result_date as $r_d) {
                 $result_rc_for_calculate = $this
            ->db
            ->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive.purchase_order_receive_date <=', date("Y-m-d"))
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
        if (count($result_rc_for_calculate) > 0)
        {
            $rcv_quantity_for_calculate = $result_rc_for_calculate->item_quantity;
        }
        else
        {
            $rcv_quantity_for_calculate = 0;
        }
        $result_date_for_calculate = $this
            ->db
            ->select_sum('co_quantity')
            ->where('purchase_ord_brk_up.pod_id', $rc1->pod_id)
            ->where('purchase_ord_brk_up.ord_date <=', date("Y-m-d"))
            ->get('purchase_ord_brk_up')
            ->row();
            $coss_quantity_for_calculate = $result_date_for_calculate->co_quantity;
            
            $tot_bekup_quantity_new_sub += $r_d->co_quantity;
            $tot_bekup_quantity += $r_d->co_quantity;
            
         if(strtotime(date("d-m-Y")) > strtotime($r_d->ord_date)) {
             if($coss_quantity_for_calculate < $rcv_quantity_for_calculate) {
         echo '<span style="color: red;"><b>'.date("d-m-Y", strtotime($r_d->ord_date)) .' - '.$r_d->co_quantity.'</b></span><br/>';
             } else {
         echo '<span>'.date("d-m-Y", strtotime($r_d->ord_date)).' - '.$r_d->co_quantity.'</span><br/>';        
             }
          } else { 
         echo '<span>'.date("d-m-Y", strtotime($r_d->ord_date)).' - '.$r_d->co_quantity.'</span><br/>';
         }
         }
         }
         ?>
     </td>
             <td>
             <?php
             
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo $r_r->purchase_order_receive_bill_no . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }

?>
             </td>
             <td>
             <?php
        $result_rcv = $this
            ->db
            ->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get_where('purchase_order_receive_detail')
            ->result(); ?>
            <?php if (count($result_rcv) > 0)
        {
            foreach ($result_rcv as $r_r)
            {
                echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date)) . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
             <td style="text-align: right;">
             <?php
        $result_rc = $this
            ->db
            ->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $rc1->id_id)
            ->where('purchase_order_receive_detail.po_id', $rc1->po_id)
            ->where('purchase_order_receive_detail.status', '1')
        // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
        
            ->get('purchase_order_receive_detail')
            ->result();
?>
            <?php
        if (count($result_rc) > 0)
        {
            foreach ($result_rc as $r_r)
            {
                $tot_rcv_quantity_new_sub += $r_r->item_quantity;
                $tot_rcv_quantity += $r_r->item_quantity;
                echo $r_r->item_quantity . "<br />";
            }
        }
        else
        {
            echo "<br />";
        }
?>
             </td>
</tr>

<?php } ?>

      <?php
                if (end($keys) == $curr_key)
                {
?>
                                        <tr style="background-color: #d9e2ea;">
               <th colspan="2"> Total for <?= $rc->item ?> [ <?= $rc->color ?> ] </th>
               <th style="text-align: right;"><?=$tot_bekup_consumption_quantity_new_sub
?></th>
<th>
</th>
               <th style="text-align: right;"><?=$tot_pod_quantity_new_sub
?></th>
<th style="text-align: right;"><?=$tot_bal_quantity_new_sub
?></th>
               <th style="text-align: right;"><?=$tot_bekup_quantity_new_sub
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity_new_sub
?></th>
           </tr>
                                        <?php
                                        
                                        $tot_bekup_consumption_quantity_new_sub = 0;
                                        $tot_bekup_quantity_new_sub = 0;
                                        $tot_pod_quantity_new_sub = 0;
                                        $tot_bal_quantity_new_sub = 0;
                                        $tot_rcv_quantity_new_sub = 0;
                                        
                }
?>

           <?php
    } ?>
           <tr style="background-color: #445767; color: white;">
               <th colspan="2"> Total </th>
               <th style="text-align: right;"><?=$tot_bekup_consumption_quantity
?></th>
<th>
</th>
               <th style="text-align: right;"><?=$tot_pod_quantity
?></th>
<th style="text-align: right;"><?=$tot_bal_quantity
?></th>
<th style="text-align: right;"><?=$tot_bekup_quantity
?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?=$tot_rcv_quantity
?></th>
           </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<?php } ?>
				
			</div>
		</div>
	</section>
</div>
</body>
		<?php
} ?>

<?php if ($segment == 'checking_entry_sheet_status')
{
    // echo '<pre>',print_r($result),'</pre>';
    $front_page = $fr_page;
    $other_page = $oe_page;

    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }

?>
		<style>
			@media print{
			    @page {size: landscape}
			    .no-print{display:none;}
			}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 12px;
}
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="overflow-x: auto; padding-top: 20px" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Entry Sheet Status </h3>
				</div>
				<div class="row mar_bot_3 text-center">
					<div class="col-sm-6 border_all header_left" style="height: 44px;">
						<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_left" style="height: 44px; text-align: left;">
					    Customer Order Number :
						<br />
						<b><?=implode(', ', $temp_co_name_array) ?></b>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
									    <th rowspan="3" style="width: 2%;">Order No.</th>
                                        <th rowspan="3" style="width: 3%;">Article</th>
                                        <th rowspan="3" style="width: 2%;">Colour</th>
                                        <th rowspan="3" style="width: 2%;">Ord. Qnty.</th>
                            			<th>Date</th>
                            			<?php
    $dates = array();
    $current = strtotime($from);
    $date2 = strtotime($to);
    $stepVal = '+1 day';
    while ($current <= $date2)
    {
        $dates[] = date('d-m', $current);
        $current = strtotime($stepVal, $current);
    }
    foreach ($dates as $d)
    {
?>
<th style="width: 2%;"><?=$d
?></th>
                            			 <?php
    }
?>
										<tr>
                            			<th style="width: 2%;">Emp. Name</th>
                            			<?php
    foreach ($dates as $d)
    {
?>
<th>Qty</th>
                            			 <?php
    }
?>
										</tr>
										<tr>
                            			<th style="width: 2%;">Extra. Time</th>
                            			<?php
    foreach ($dates as $d)
    {
?>
<th></th>
                            			 <?php
    }
?>
										</tr>
									</thead>
									<tbody>
										<?php
    $iter = 0;
    $i1 = 4;
    $count_iter11 = $front_page;
    $count_iter = $front_page;
    $new_employee_detail_iter = 0;
    // echo '<pre>',print_r($data['result']),'</pre>';
    foreach ($result as $res)
    {
        if ($iter == 4 or $iter == $i1)
        {
            $i1 = $iter + 4;
?>
									
									    <?php
        }
        $iter++;
?>
                                        <?php
        $result_emp = $this
            ->db
            ->select('departments.department, employees.name, employees.e_id')
            ->join('departments', 'departments.d_id=employees.d_id', 'left')
            ->join('article_groups', 'article_groups.d_id=departments.d_id', 'left')
            ->group_by('employees.e_id')
            ->order_by('employees.name')
            ->get_where('employees', array(
            'employees.Packing_and_checking' => 1
        ))
            ->result();
        $count_emp = count($result_emp);
        $i = 0;
        $new_employee_detail_iter1 = 0;
?>
                                         <?php
        foreach ($result_emp as $r_e)
        {
            $new_employee_detail_iter++;
            $new_employee_detail_iter1++;
            $i++;
            if ($new_employee_detail_iter == $front_page or $new_employee_detail_iter == $count_iter)
            {
                $count_iter += $other_page;
?>
                        	    </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="overflow-x: auto; padding-top: 20px" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Checking Entry Sheet Status </h3>
				</div>
				<div class="row mar_bot_3 text-center">
					<div class="col-sm-6 border_all header_left" style="height: 44px;">
						<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_left" style="height: 44px;text-align: left;">
					    Customer Order Number :
						<br />
						<b><?=implode(', ', $temp_co_name_array) ?></b>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
									    <th rowspan="3" style="width: 2%;">Order No.</th>
                                        <th rowspan="3" style="width: 3%;">Article</th>
                                        <th rowspan="3" style="width: 2%;">Colour</th>
                                        <th rowspan="3" style="width: 2%;">Ord. Qnty.</th>
                            			<th>Date</th>
                            			<?php
                foreach ($dates as $d)
                {
?>
<th style="width: 2%;"><?=$d
?></th>
                            			 <?php
                }
?>
										<tr>
                            			<th style="width: 2%;">Emp. Name</th>
                            			<?php
                foreach ($dates as $d)
                {
?>
<th>Qty</th>
                            			 <?php
                }
?>
										</tr>
										<tr>
                            			<th style="width: 2%;">Extra. Time</th>
                            			<?php
                foreach ($dates as $d)
                {
?>
<th></th>
                            			 <?php
                }
?>
										</tr>
									</thead>
									<tbody>
                    	    
                    	<?php
            }
?>
											<tr>
												<?php
            if ($i == 1)
            {
?>
                                          <td rowspan="<?=$count_emp
?>" style="width: 2%;"><?=$res->co_no
?></td>
                                                <td rowspan="<?=$count_emp
?>" style="width: 3%;"><?=$res->art_no . '<br/>(' . $res->info . ')' ?></td>
                                                <td rowspan="<?=$count_emp ?>" style="width: 2%;"><?=$res->leather_color ?></td>
                                                <td rowspan="<?=$count_emp ?>" style="width: 2%;"><?=$res->checked_quantity ?></td>
                                                 <?php
            }
?>
                                                  <?php
            if ($new_employee_detail_iter == $front_page or $new_employee_detail_iter == $count_iter11)
            {
                $count_iter11 += $other_page;
?>
                                          <td rowspan="<?=($count_emp - ($i - 1)) ?>" style="width: 2%;"><?=$res->co_no ?></td>
                                                <td rowspan="<?=($count_emp - ($i - 1)) ?>" style="width: 3%;"><?=$res->art_no . '<br/>(' . $res->info . ')' ?></td>
                                                <td rowspan="<?=($count_emp - ($i - 1)) ?>" style="width: 2%;"><?=$res->leather_color ?></td>
                                                <td rowspan="<?=($count_emp - ($i - 1)) ?>" style="width: 2%;"><?=$res->co_quantity ?></td>
                                                 <?php
            }
?>
                            <td style="width: 2%;">
                            	<?=$r_e->name
?>
                            </td>
                            <?php
            foreach ($dates as $d)
            {
?>
                            			 <?php
                $date_new = $d . '-'.date("Y");
                $date_new1 = date('Y-m-d', strtotime($date_new));
                $qnty_row = $this
                    ->db
                    ->join('checking', 'checking.checking_id = checking_details.checking_id', 'left')
                    ->where("checking.checking_entry_date", $date_new1)->get_where('checking_details', array(
                    'checking.e_id' => $r_e->e_id,
                    'checking_details.cod_id' => $res->cod_id
                ))
                    ->row();
                if (count($qnty_row) > 0)
                {
                    $qnty = $qnty_row->checked_quantity;
                }
                else
                {
                    $qnty = '';
                }
?>
                            			 <td style="width: 2%;"><?=$qnty
?></td>
                            			 <?php
            }
?>
											</tr>
                                          <?php
        }
        $count_emp = 0;
        $i = 0;
?>
											<?php
    } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
		<?php
} ?>

        <?php if ($segment == 'payroll_register')
        {
        // echo '<pre>',print_r($result),'</pre>';
        
        ?>
        
        
        
        
        
        
        <?php if(isset($result)) {
        if(count($result) > 0) {
        $depts_id = $result[0][0]->d_id;
        if($depts_id == 4) {
        ?>
        
        <style>
        @media print{@page {size: A4;}}
        body.A4.portrait .sheet {
        width: 500mm;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px;
        text-align: left;
        font-size: 16px;
        }
        </style>
        
        <body class="legal" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
        <section class="sheet padding-5mm" style="height: auto">
        <div>
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
        <div class="row border_all text-center text-uppercase mar_bot_3">
        <h3 class="mar_0 head_font">PAYROLL REGISTER</h3>
        </div>
        <div class="row mar_bot_3 text-center">
        <div class="col-sm-6 border_all header_left" style="height: 68px;">
        	<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
        	<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
        </div>
        <div class="col-sm-6 border_all header_left" style="height: 68px; text-align: left;">
        	<b>Month: <?=$mont ?><br />
                            Date: <?=date('d-m-Y') ?><br /></b>
        </div>
        </div>
        <!--table data-->
        <div class="row">
        <div class="container">
        	<div class="row">
        		<div class="table-responsive">
        			<!--<h5>Retrieve Table</h5>-->
        			<table id="all_det" class="table table-bordered">
        				<thead>
        <tr>
                        <th class="text-center" align="center" colspan="26">PAYMENT FOR THE MONTH OF <?= $mont . ' ' . date('Y')  ?> </th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">SN</th>
                        <th style="text-align: center; width: 300px;">EMPLOYEE <br/> NAME</th>
                        <th style="text-align: center;">LEAVE <br/> TAKEN <br/> IN <br/> <?= $mont ?>-22</th>
                        <th style="text-align: center;">ABSENT <br/> IN <br/> <?= $mont ?>-22</th>
                        <th style="text-align: center;">TOTAL <br/> ABSENT <br/> SO FAR</th>
                        <th style="text-align: center;">GROSS <br/> AMOUNT</th>
                        <th style="text-align: center;">LOAN <br/> AMOUNT</th>
                        <th style="text-align: center;">PTAX</th>
                        <th style="text-align: center;">NET AMOUNT <br/> PAYABLE</th>
                        <th style="text-align: center; width: 180px;">SIGNATURE</th>
                    </tr>
        </thead>
        <tbody>
                <?php
        $new_iter = 10;
        $total_count = 0;
        $total_BASIC_neww = 0;
        $new_iter1 = 9;
        $iter = 1;
        $total_BASIC1 = 0;
        $total_DA1 = 0;
        $total_HRA11 = 0;
        $total_CONV11 = 0;
        $total_OA11 = 0;
        $total_HRA12 = 0;
        $total_CONV12 = 0;
        $total_OA12 = 0;
        $total_TOTAL1 = 0;
        $total_BASIC2 = 0;
        $total_TOTAL2 = 0;
        $total_DA2 = 0;
        $total_TOTAL22 = 0;
        $total_HRA = 0;
        $total_CONV = 0;
        $total_MED = 0;
        $total_OA = 0;
        $total_GROSS = 0;
        $total_PFAMT = 0;
        $total_ESIAMT = 0;
        $total_TAX = 0;
        $total_INS = 0;
        $total_LOAN = 0;
        $total_DEDUC = 0;
        $total_NET = 0;
        $total_BASIC11 = 0;
        $total_DA11 = 0;
        $total_HRA111 = 0;
        $total_CONV111 = 0;
        $total_OA111 = 0;
        $total_HRA121 = 0;
        $total_CONV121 = 0;
        $total_OA121 = 0;
        $total_TOTAL11 = 0;
        $total_BASIC21 = 0;
        $total_TOTAL21 = 0;
        $total_DA21 = 0;
        $total_TOTAL221 = 0;
        $total_HRA1 = 0;
        $total_CONV1 = 0;
        $total_MED1 = 0;
        $total_OA1 = 0;
        $total_GROSS1 = 0;
        $total_PFAMT1 = 0;
        $total_ESIAMT1 = 0;
        $total_TAX1 = 0;
        $total_INS1 = 0;
        $total_LOAN1 = 0;
        $total_cl = 0;
        $total_DEDUC1 = 0;
        $total_NET1 = 0;
        
        foreach ($result as $res)
        {
        foreach ($res as $r)
        {
        if ($res != '')
        {
        $total_count = count($result);
        }
        if ($iter == 10 or $iter == $new_iter)
        {
        $new_iter += 9;
        ?>
        
                        </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                        </div>
                        </div>
                        </div>
                        </section>
                        </div>
                        </body>
                        
                        <body class="legal" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
        <section class="sheet padding-5mm" style="height: auto">
        <div>
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
        <div class="row border_all text-center text-uppercase mar_bot_3">
        <h3 class="mar_0 head_font">PAYROLL REGISTER</h3>
        </div>
        <div class="row mar_bot_3 text-center">
        <div class="col-sm-6 border_all header_left" style="height: 68px;">
        	<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
        	<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
        </div>
        <div class="col-sm-6 border_all header_left" style="height: 68px; text-align: left;">
        	<b>Month: <?=$mont ?><br />
                            Date: <?=date('d-m-Y') ?><br /></b>
        </div>
        </div>
        <div class="row">
        <div class="container">
        	<div class="row">
        		<div class="table-responsive">
        			<!--<h5>Retrieve Table</h5>-->
        			<table id="all_det" class="table table-bordered">
        				<thead>
        <tr>
                        <!--<th class="text-center" align="center" colspan="26">REGISTER OF WAGES <br /> [Prescribed under Rule 23(1) of the West Bengal Minimum Wages Rules 1951] <br /> [Prescribed under Rule 26(1) of the Central Minimum Wages Rules 1951]</th>-->
                    </tr>
                    <tr>
                        <th style="text-align: center;">SN</th>
                        <th style="text-align: center; width: 300px;">EMPLOYEE <br/> NAME</th>
                        <th style="text-align: center;">LEAVE <br/> TAKEN <br/> IN <br/> <?= $mont ?>-22</th>
                        <th style="text-align: center;">ABSENT <br/> IN <br/> <?= $mont ?>-22</th>
                        <th style="text-align: center;">TOTAL <br/> ABSENT <br/> SO FAR</th>
                        <th style="text-align: center;">GROSS <br/> AMOUNT</th>
                        <th style="text-align: center;">LOAN <br/> AMOUNT</th>
                        <th style="text-align: center;">PTAX</th>
                        <th style="text-align: center;">NET AMOUNT <br/> PAYABLE</th>
                        <th style="text-align: center; width: 180px;">SIGNATURE</th>
                    </tr>
        </thead>
        <tbody>
                        
                        <?php
        } ?>
                        
                        <tr>
                            <td><?=$iter
        ?></td>
                            <td class="text-left"><?=$r->name
        ?></td>
        
                            <td style="text-align: center;"><?=$r->T
        ?></td>
        
        <td style="text-align: center;"><?=$r->T7
        ?></td>
        
        <?php 
        $sql1="SELECT SUM(salary.T4+salary.T5+salary.T6) AS T_val
        FROM salary
        WHERE salary.EMPCODE = '".$r->e_id."'";
        $rest_valus = $this->db->query($sql1)->row();
        ?>
        
        
        <?php 
        $month_new = $month;
        $wordArray = explode('~', $month);
        ?>
        
        
        <?php $dates = array();
        $total_cl = 0;
        $total_el = 0;
        $total_esil = 0;
        $month_new = $month;
        $wordArray = explode('~', $month);
        if($wordArray[2] == 12) {
        $wordArray1 = 1;    
        } else {
        $wordArray1 = (1 + $wordArray[2]);
        }
        $mn = str_pad($wordArray1, 2, '0', STR_PAD_LEFT);
        if($wordArray[2] == 1) {
        $wordArray_prev = 12;
        } else {
        $wordArray_prev = ($wordArray[2] - 1);   
        }
        $mn_prev = str_pad($wordArray_prev, 2, '0', STR_PAD_LEFT);
        $current = strtotime('2022-04-01');
        //   $date2 = strtotime('2023-03-01');
        if($wordArray[2] < 4 || $wordArray[2] == 12) {
        $date2 = strtotime('2023-' . '01' . '-01'); 
        } else {
        $date2 = strtotime('2022-' . $mn . '-01');  
        }
        $stepVal = '+1 month';
        while ($current < $date2)
        {
        $dates[] = date('M', $current);
        $dates1[] = date('m', $current);
        $current = strtotime($stepVal, $current);
        }
        ?>
                        <?php foreach ($dates as $d)
        {
        $sql = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T4,salary.T5,salary.T6,salary.T7,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $r->e_id . "'
        ORDER BY employees.e_code";
        $salary_details = $this
            ->db
            ->query($sql)->row();
        if (count($salary_details) > 0)
        {
            $total_cl += $salary_details->T4 + $salary_details->T5+$salary_details->T6+$salary_details->T7;
        }
        else
        {
            $total_cl += 0;
        }
        }
        ?>
        
        
        
        
        <td style="text-align: center;"><?=$total_cl
        ?></td>
        
        
        <td style="text-align: center;"><?php echo number_format((float)($r->BASIC1 + $r->DA1), 2);
        ?></td>
        
        <td style="text-align: center;"><?php echo number_format((float)$r->LOAN, 2);
        ?></td>
        
        <td style="text-align: center;"><?php echo number_format((float)$r->TAX, 2);
        ?></td>
        
                            <td style="text-align: right;"><?php echo number_format((float)$r->NET, 2);
        $total_BASIC_neww += $r->NET;
        ?></td>
                            <td style="text-align: right; height: 80px; width: 100px;"></td>
                        </tr>
                        
                        <?php if ($iter == $total_count)
        { ?>
                        
                        <tr>
                        <th colspan="8">Total</th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC_neww, 2);
        ?></th>
                            <th style="text-align: right;"></th>
                        </tr>
                        
                        <?php
        }
        $iter++; ?>
                        
                        <?php
        }
        }
        ?>
            </tbody>
        </table>
        		</div>
        	</div>
        </div>
        </div>
        </div>
        </div>
        </section>
        </div>
        </body>
        
        <?php 
        } else {
        ?>
        
        
        
        <style>
        @media print{@page {size: A3 landscape;}}
        body.A3.landscape .sheet {
        width: 500mm;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px;
        text-align: left;
        font-size: 16px;
        }
        </style>
        
        
        
        <body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
        <section class="sheet padding-5mm" style="height: auto">
        <div>
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
        <div class="row border_all text-center text-uppercase mar_bot_3">
        <h3 class="mar_0 head_font">PAYROLL REGISTER</h3>
        </div>
        <div class="row mar_bot_3 text-center">
        <div class="col-sm-6 border_all header_left" style="height: 44px;">
        	<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
        	<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
        </div>
        <div class="col-sm-6 border_all header_left" style="height: 44px; text-align: left;">
        	<b>Month: <?=$mont ?><br />
                            Date: <?=date('d-m-Y') ?><br /></b>
        </div>
        </div>
        <!--table data-->
        <div class="row">
        <div class="container">
        	<div class="row">
        		<div class="table-responsive">
        			<!--<h5>Retrieve Table</h5>-->
        			<table id="all_det" class="table table-bordered">
        				<thead>
        <tr>
                        <th class="text-center" align="center" colspan="26">REGISTER OF WAGES <br /> [Prescribed under Rule 23(1) of the West Bengal Minimum Wages Rules 1951] <br /> [Prescribed under Rule 26(1) of the Central Minimum Wages Rules 1951]</th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="text-align: center;">Sr. #</th>
                        <th rowspan="2" style="text-align: center; width: 120px;">Name</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Wrkg. Days</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Days Wrkd</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Hldays</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Lv.</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Ab.</th>
                        <th class="text-center" rowspan="1" colspan="6">Salary / Wages Scale</th>
                        <th class="text-center" rowspan="1" colspan="6">Salary / Wages Paid</th>
                        <th class="text-center" rowspan="1" colspan="6" style="text-align: right;">Deductions</th>
                        <th rowspan="2" style="text-align: right;">Salary <br/> / Wages Paid</th>
                        <th rowspan="2" style="text-align: right;">Sign. / Thumb Impression</th>
                    </tr>
                    <tr>
                        <th rowspan="1" style="text-align: right;">Basic</th>
                        <th rowspan="1" style="text-align: right;">D.A.</th>
                        <th rowspan="1" style="text-align: right;">HRA</th>
                        <th rowspan="1" style="text-align: right;">Conv. <br/> Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Edu. <br/> Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                        <th rowspan="1" style="text-align: right;">Basic</th>
                        <th rowspan="1" style="text-align: right;">D.A.</th>
                        <th rowspan="1" style="text-align: right;">HRA</th>
                        <th rowspan="1" style="text-align: right;">Conv.<br/> Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Edu.<br/> Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                        <th rowspan="1" style="text-align: right;">P.F.</th>
                        <th rowspan="1" style="text-align: right;">E.S.I.</th>
                        <th rowspan="1" style="text-align: right;">WB. <br/> PR TAX</th>
                        <th rowspan="1" style="text-align: right;">L.I.C. <br/> /T.D.S.</th>
                        <th rowspan="1" style="text-align: right;">Loan <br/> /Advance</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                    </tr>
        </thead>
        <tbody>
                <?php
        $new_iter = 10;
        $total_count = 0;
        $new_iter1 = 9;
        $iter = 1;
        $total_BASIC1 = 0;
        $total_DA1 = 0;
        $total_HRA11 = 0;
        $total_CONV11 = 0;
        $total_OA11 = 0;
        $total_HRA12 = 0;
        $total_CONV12 = 0;
        $total_OA12 = 0;
        $total_TOTAL1 = 0;
        $total_BASIC2 = 0;
        $total_TOTAL2 = 0;
        $total_DA2 = 0;
        $total_TOTAL22 = 0;
        $total_HRA = 0;
        $total_CONV = 0;
        $total_MED = 0;
        $total_OA = 0;
        $total_GROSS = 0;
        $total_PFAMT = 0;
        $total_ESIAMT = 0;
        $total_TAX = 0;
        $total_INS = 0;
        $total_LOAN = 0;
        $total_DEDUC = 0;
        $total_NET = 0;
        $total_BASIC11 = 0;
        $total_DA11 = 0;
        $total_HRA111 = 0;
        $total_CONV111 = 0;
        $total_OA111 = 0;
        $total_HRA121 = 0;
        $total_CONV121 = 0;
        $total_OA121 = 0;
        $total_TOTAL11 = 0;
        $total_BASIC21 = 0;
        $total_TOTAL21 = 0;
        $total_DA21 = 0;
        $total_TOTAL221 = 0;
        $total_HRA1 = 0;
        $total_CONV1 = 0;
        $total_MED1 = 0;
        $total_OA1 = 0;
        $total_GROSS1 = 0;
        $total_PFAMT1 = 0;
        $total_ESIAMT1 = 0;
        $total_TAX1 = 0;
        $total_INS1 = 0;
        $total_LOAN1 = 0;
        $total_DEDUC1 = 0;
        $total_NET1 = 0;
        
        foreach ($result as $res)
        {
        foreach ($res as $r)
        {
        if ($res != '')
        {
        $total_count = count($result);
        }
        if ($iter == 10 or $iter == $new_iter)
        {
        $new_iter += 9;
        ?>
                        
                        <tr>
                        <th colspan="7">Total</th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL221, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_PFAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_ESIAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TAX1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_INS1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_LOAN1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DEDUC1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_NET1, 2);
        ?></th>
                            <th style="text-align: right;"></th>
                        </tr>
                        
                        </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                        </div>
                        </div>
                        </div>
                        </section>
                        </div>
                        </body>
                        
                        <body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
        <section class="sheet padding-5mm" style="height: auto">
        <div>
        <!--<header class="pull-right">-->
        <!--    <small>Page No. </small>-->
        <!--</header>-->
        <div class="clearfix"></div>
        <div class="container">
        <div class="row border_all text-center text-uppercase mar_bot_3">
        <h3 class="mar_0 head_font">PAYROLL REGISTER</h3>
        </div>
        <div class="row mar_bot_3 text-center">
        <div class="col-sm-6 border_all header_left" style="height: 44px;">
        	<h4 class="" style="margin-top: 2px; margin-bottom: 0px;"><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
        	<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
        </div>
        <div class="col-sm-6 border_all header_left" style="height: 44px; text-align: left;">
        	<b>Month: <?=$mont ?><br />
                            Date: <?=date('d-m-Y') ?><br /></b>
        </div>
        </div>
        <div class="row">
        <div class="container">
        	<div class="row">
        		<div class="table-responsive">
        			<!--<h5>Retrieve Table</h5>-->
        			<table id="all_det" class="table table-bordered">
        				<thead>
        <tr>
                        <th class="text-center" align="center" colspan="26">REGISTER OF WAGES <br /> [Prescribed under Rule 23(1) of the West Bengal Minimum Wages Rules 1951] <br /> [Prescribed under Rule 26(1) of the Central Minimum Wages Rules 1951]</th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="text-align: center;">Sr. #</th>
                        <th rowspan="2" style="text-align: center;">Name</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Wrkg. Days</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Days Wrkd</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Hldays</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Lv.</th>
                        <th rowspan="2" style="text-align: center; font-size: 10px;">Ab.</th>
                        <th class="text-center" rowspan="1" colspan="6">Salary / Wages Scale</th>
                        <th class="text-center" rowspan="1" colspan="6">Salary / Wages Paid</th>
                        <th class="text-center" rowspan="1" colspan="6" style="text-align: right;">Deductions</th>
                        <th rowspan="2" style="text-align: right;">Salary <br/> / Wages Paid</th>
                        <th rowspan="2" style="text-align: right;">Sign. / Thumb Impression</th>
                    </tr>
                    <tr>
                        <th rowspan="1" style="text-align: right;">Basic</th>
                        <th rowspan="1" style="text-align: right;">D.A.</th>
                        <th rowspan="1" style="text-align: right;">HRA</th>
                        <th rowspan="1" style="text-align: right;">Conv. Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Edu. Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                        <th rowspan="1" style="text-align: right;">Basic</th>
                        <th rowspan="1" style="text-align: right;">D.A.</th>
                        <th rowspan="1" style="text-align: right;">HRA</th>
                        <th rowspan="1" style="text-align: right;">Conv. Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Edu. Alwnc</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                        <th rowspan="1" style="text-align: right;">P.F.</th>
                        <th rowspan="1" style="text-align: right;">E.S.I.</th>
                        <th rowspan="1" style="text-align: right;">WB. PR TAX</th>
                        <th rowspan="1" style="text-align: right;">L.I.C. <br/> /T.D.S.</th>
                        <th rowspan="1" style="text-align: right;">Loan <br/> /Advance</th>
                        <th rowspan="1" style="text-align: right;">Total</th>
                    </tr>
        </thead>
        <tbody>
        
        <tr>
                        <th colspan="7">Total B/F</th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL221, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_PFAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_ESIAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TAX1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_INS1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_LOAN1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DEDUC1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_NET1, 2);
        ?></th>
                            <th style="text-align: right;"></th>
                        </tr>
                        
                        <?php
        } ?>
                        
                        <tr>
                            <td><?=$iter
        ?></td>
                            <td class="text-left"><?=$r->name
        ?></td>
                            <td style="text-align: center;"><?=$r->T1
        ?></td>
                            <td style="text-align: center;"><?=$r->T2
        ?></td>
                            <td style="text-align: center;"><?=$r->T3
        ?></td>
                            <td style="text-align: center;"><?=$r->T
        ?></td>
                            <td style="text-align: center;"><?=$r->T7
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->BASIC1, 2);
        $total_BASIC1 += $r->BASIC1;
        $total_BASIC11 += $r->BASIC1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->DA1, 2);
        $total_DA1 += $r->DA1;
        $total_DA11 += $r->DA1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->HRA1, 2);
        $total_HRA11 += $r->HRA1;
        $total_HRA111 += $r->HRA1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->CONV1, 2);
        $total_CONV11 += $r->CONV1;
        $total_CONV111 += $r->CONV1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->OA1, 2);
        $total_OA11 += $r->OA1;
        $total_OA111 += $r->OA1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->TOTAL1, 2);
        $total_TOTAL1 += $r->TOTAL1;
        $total_TOTAL11 += $r->TOTAL1;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->BASIC2, 2);
        $total_BASIC2 += $r->BASIC2;
        $total_BASIC21 += $r->BASIC2;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->DA2, 2);
        $total_DA2 += $r->DA2;
        $total_DA21 += $r->DA2;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->HRA, 2);
        $total_HRA12 += $r->HRA;
        $total_HRA121 += $r->HRA;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->CONV, 2);
        $total_CONV12 += $r->CONV;
        $total_CONV121 += $r->CONV;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->OA, 2);
        $total_OA12 += $r->OA;
        $total_OA121 += $r->OA;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->GROSS, 2);
        $total_TOTAL22 += $r->GROSS;
        $total_TOTAL221 += $r->GROSS;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->PFAMT, 2);
        $total_PFAMT += $r->PFAMT;
        $total_PFAMT1 += $r->PFAMT;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->ESIAMT, 2);
        $total_ESIAMT += $r->ESIAMT;
        $total_ESIAMT1 += $r->ESIAMT;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->TAX, 2);
        $total_TAX += $r->TAX;
        $total_TAX1 += $r->TAX;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->INS, 2);
        $total_INS += $r->INS;
        $total_INS1 += $r->INS;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->LOAN, 2);
        $total_LOAN += $r->LOAN;
        $total_LOAN1 += $r->LOAN;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->DEDUC, 2);
        $total_DEDUC += $r->DEDUC;
        $total_DEDUC1 += $r->DEDUC;
        ?></td>
                            <td style="text-align: right;"><?php echo number_format((float)$r->NET, 2);
        $total_NET += $r->NET;
        $total_NET1 += $r->NET;
        ?></td>
                            <td style="text-align: right; height: 100px; width: 100px;"></td>
                        </tr>
                        
                        <?php if ($iter == $total_count)
        { ?>
                        
                        <tr>
                        <th colspan="7">Total</th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA111, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL11, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_BASIC21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DA21, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_HRA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_CONV121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_OA121, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TOTAL221, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_PFAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_ESIAMT1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_TAX1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_INS1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_LOAN1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_DEDUC1, 2);
        ?></th>
                            <th style="text-align: right;"><?php echo number_format((float)$total_NET1, 2);
        ?></th>
                            <th style="text-align: right;"></th>
                        </tr>
                        
                        <?php
        }
        $iter++; ?>
                        
                        <?php
        }
        }
        ?>
            </tbody>
        </table>
        		</div>
        	</div>
        </div>
        </div>
        </div>
        </div>
        </section>
        </div>
        </body>
        <?php
        }
        }
        } 
        ?>
        <?php
        } ?>
	
	<?php if ($segment == 'order_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 16px;
         }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Order Status Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="4" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Skiving Information</th>
												<th colspan="4" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Cut Bill</th>
												<th>Skiv Issue</th>
												<th>Skiv Rcv.</th>
												<th>Skiv Bal.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Jobb. Bill</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>
											<?php
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    $grand_total_cut_bill = array();
    $grand_total1_cut_bill = array();
    $grand_total_job_bill = array();
    $grand_total1_job_bill = array();
    foreach ($result as $res)
    {
        if (!in_array($res->co_no, $co_array))
        {
            array_push($co_array, $res->co_no);
            if ($order_iter++ == 1)
            {
                // continue;
                
            }
            else
            {

?>
														<tr style="background-color: #d9e2ea;">
															<th colspan="2">Total</th>
															<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_bill) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_job_bill) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
														</tr>
														<?php
                $grand_total1_co_qnty = array();
                $grand_total1_cut_issue = array();
                $grand_total1_cut_rcv = array();
                $grand_total1_cut_balc = array();
                $grand_total1_skv_isu = array();
                $grand_total1_skv_rcv = array();
                $grand_total1_skv_balc = array();
                $grand_total1_fab_isu = array();
                $grand_total1_fab_rcv = array();
                $grand_total1_fab_balc = array();
                $grand_total1_qnty_shpd = array();
                $grand_total1_qnty_remn = array();
                $grand_total1_qnty_stck = array();
                $grand_total1_cut_bill = array();
                $grand_total1_job_bill = array();
            }
        }
        if ($show_iter == 23 or $show_iter == $new_show_iter)   // prev -> 24
        {
            $new_show_iter += 18;  //  // prev -> 23
?>
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
												</div>
												</body>
			<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Order Status Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="4" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Skiving Information</th>
												<th colspan="4" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Cut Bill</th>
												<th>Skiv Issue</th>
												<th>Skiv Rcv.</th>
												<th>Skiv Bal.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Jobb. Bill</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>									
												<?php
        } ?>
												<tr>
													<td style="white-space: nowrap;"><?=$res->co_no
?></td>
													<td><?=$res->art_no . ' [' . $res->color . ']' ?></td>
													<td class="text-right">
														<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
													</td>
													<td class="text-right">
													<?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
													</td>
													
													<?php
        $get_cutter_bill_details = $this
            ->db
            ->get_where('cutter_bill_dtl', array(
            'cut_id' => $res->cut_id,
            'cut_rcv_id' => $res->cut_rcv_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'leather_color' => $res->c_id
        ))
            ->row();
?>
													
													<td class="text-right">
													<?php
        if (count($get_cutter_bill_details) > 0)
        {
            echo number_format($get_cutter_bill_details->original_quantity, 2);
            array_push($grand_total_cut_bill, $get_cutter_bill_details->original_quantity);
            array_push($grand_total1_cut_bill, $get_cutter_bill_details->original_quantity);
        }
        else
        {
            echo '0';
            array_push($grand_total_cut_bill, 0);
            array_push($grand_total1_cut_bill, 0);
        }
?>
													</td>

													<td class="text-right">
														<?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_skv_isu, $res->cutting_received_qnty);
        array_push($grand_total1_skv_isu, $res->cutting_received_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->skiving_receive_qnty;
        array_push($grand_total_skv_rcv, $res->skiving_receive_qnty);
        array_push($grand_total1_skv_rcv, $res->skiving_receive_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $skv_balc = $res->cutting_received_qnty - $res->skiving_receive_qnty;
        echo $skv_balc;
        array_push($grand_total_skv_balc, $skv_balc);
        array_push($grand_total1_skv_balc, $skv_balc);
?>
													</td>

													<td class="text-right">
														<?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
													</td>
													
													<?php
        $get_jobber_bill_details = $this
            ->db
            ->get_where('jobber_bill_detail', array(
            'jobber_issue_id' => $res->jobber_issue_id,
            'jobber_challan_receipt_id' => $res->jobber_challan_receipt_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row();
?>
													
													<td class="text-right">
													<?php
        if (count($get_jobber_bill_details) > 0)
        {
            echo number_format($get_jobber_bill_details->quantity, 2);
            array_push($grand_total_job_bill, $get_jobber_bill_details->quantity);
            array_push($grand_total1_job_bill, $get_jobber_bill_details->quantity);
        }
        else
        {
            echo '0';
            array_push($grand_total_job_bill, 0);
            array_push($grand_total1_job_bill, 0);
        }
?>
													</td>
													
													<?php 
													$pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.cod_id' => $res->cod_id,
            'packing_shipment_detail.am_id' => $res->am_id,
            'packing_shipment_detail.lc_id' => $res->lc_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            
            if(count($pack_shipment_num) > 0) {
            
            $qtty = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
                
            } else {
                
            $qtty = 0;
                
            }
													?>

													<td class="text-right">
														<?php
        echo $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
													</td>
												</tr>
												<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="2">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_job_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_job_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>
		</body>
		
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Stock In Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="3" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Skiving Information</th>
												<th colspan="3" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Skiv Issue</th>
												<th>Skiv Rcv.</th>
												<th>Skiv Bal.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>
											<?php
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    foreach ($result as $res)
    {
													$pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.cod_id' => $res->cod_id,
            'packing_shipment_detail.am_id' => $res->am_id,
            'packing_shipment_detail.lc_id' => $res->lc_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            
            if(count($pack_shipment_num) > 0) {
            
            $qtty = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
                
            } else {
                
            $qtty = 0;
                
            }
        if (($res->jobber_receive_qnty - $qtty) <= 0)
        {
            continue;
        }
        if (!in_array($res->co_no, $co_array))
        {
            array_push($co_array, $res->co_no);
            if ($order_iter++ == 1)
            {
                // continue;
                
            }
        }
        if ($show_iter == 26 or $show_iter == $new_show_iter)
        {
            $new_show_iter += 25;
?>
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
												</div>
												</body>
			<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Stock In Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="3" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Skiving Information</th>
												<th colspan="3" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Skiv Issue</th>
												<th>Skiv Rcv.</th>
												<th>Skiv Bal.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>									
												<?php
        } ?>
												<tr>
													<th><?=$res->co_no
?></th>
													<td><?=$res->art_no . ' [' . $res->color . ']' ?></td>
													<td class="text-right">
														<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
													</td>
													<td class="text-right">
													<?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
													</td>

													<td class="text-right">
														<?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_skv_isu, $res->cutting_received_qnty);
        array_push($grand_total1_skv_isu, $res->cutting_received_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->skiving_receive_qnty;
        array_push($grand_total_skv_rcv, $res->skiving_receive_qnty);
        array_push($grand_total1_skv_rcv, $res->skiving_receive_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $skv_balc = $res->cutting_received_qnty - $res->skiving_receive_qnty;
        echo $skv_balc;
        array_push($grand_total_skv_balc, $skv_balc);
        array_push($grand_total1_skv_balc, $skv_balc);
?>
													</td>

													<td class="text-right">
														<?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
													</td>
													

													<td class="text-right">
														<?php
        echo $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
													</td>
												</tr>
												<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="2">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>
		</body>
		
		<?php
} ?>

<?php if ($segment == 'order_details_with_brkup_quantity_details')
{
    ?>
    
    <style>
        
        .sheet {
            width: 540mm;
        }
        
    </style>
    
    <?php
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 14px;         }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Order Status Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th colspan="3" class="text-center">Date Details</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="4" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Purchse Information</th>
												<th colspan="4" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
											    <th>Order Date</th>
											    <th>Buyer's Ord. Dt.</th>
											    <th>Ord. Ship. Date</th>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Cut Bill</th>
												<th class="text-center">Lthr. Invd.</th>
												<th class="text-center">Supp. Nm.</th>
												<th class="text-center">Pend. Dtls.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Jobb. Bill</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$groups[] = '';
											$new_it = 0;
                                foreach ($result as $rs) {
                                    $key = $rs->co_id;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'co_id' => $rs->co_id,
                                            'co_no' => $rs->co_no,
                                            'co_iters' => $new_it++,
                                        );
                                    } else {
                                        $groups[$key]['co_id'] = $rs->co_id;
                                        $groups[$key]['co_no'] = $rs->co_no;
                                        $groups[$key]['co_iters'] = $new_it++;
                                    }
                                }
											
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $co_array_new1[] = '';
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    $grand_total_cut_bill = array();
    $grand_total1_cut_bill = array();
    $grand_total_job_bill = array();
    $grand_total1_job_bill = array();
    $loop_iter = 0;
    foreach ($result as $curr_key=>$res)
    {
        $loop_iter++;
        $keys[] = '';
                                    foreach($result as $key=>$rest) {
                                        if ($rest->co_id == $res->co_id) {
                                            array_push($keys, $key);
                                        }
                                    }
        if (!in_array($res->co_no, $co_array))
        {
            array_push($co_array, $res->co_no);
            if ($order_iter++ == 1)
            {
                // continue;
                
            }
            else
            {

?>
														<tr style="background-color: #d9e2ea;">
															<th colspan="5">Total</th>
															<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_bill) ?></th>
															<th class="text-right"></th>
															<th class="text-right"></th>
															<th class="text-right"></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_job_bill) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
															<th colspan="3" class="text-right"></th>
														</tr>
														<?php
                $grand_total1_co_qnty = array();
                $grand_total1_cut_issue = array();
                $grand_total1_cut_rcv = array();
                $grand_total1_cut_balc = array();
                $grand_total1_skv_isu = array();
                $grand_total1_skv_rcv = array();
                $grand_total1_skv_balc = array();
                $grand_total1_fab_isu = array();
                $grand_total1_fab_rcv = array();
                $grand_total1_fab_balc = array();
                $grand_total1_qnty_shpd = array();
                $grand_total1_qnty_remn = array();
                $grand_total1_qnty_stck = array();
                $grand_total1_cut_bill = array();
                $grand_total1_job_bill = array();
            }
        }
        if ($show_iter == 26 or $show_iter == $new_show_iter)
        {
            $new_show_iter += 25;
?>
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
												</div>
												</body>
			<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
			<div>
				<!--<header class="pull-right">-->
				<!--    <small>Page No. </small>-->
				<!--</header>-->
				<div class="clearfix"></div>
				<div class="container">
					<div class="row border_all text-center text-uppercase mar_bot_3">
						<h3 class="mar_0 head_font">Order Status Details</h3>
					</div>
					<div class="row mar_bot_3">
						<div class="col-sm-6 border_all header_left">
							<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
							<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
						</div>
						<div class="col-sm-6 border_all header_right">Customer Order Number :
							<br />
							<?=implode(', ', $temp_co_name_array) ?>
						</div>
					</div>
					<!--table data-->
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="table-responsive">
									<!--<h5>Retrieve Table</h5>-->
									<table id="all_det" class="table table-bordered">
										<thead>
											<tr>
												<th rowspan="2">Order No.</th>
												<th rowspan="2">Article</th>
												<th colspan="3" class="text-center">Date Details</th>
												<th rowspan="2">Ord Qnty</th>
												<th colspan="4" class="text-center">Cutting Information</th>
												<th colspan="3" class="text-center">Purchse Information</th>
												<th colspan="4" class="text-center">Fabricator Information</th>
												<th colspan="3" class="text-center">Shipping Information</th>
											</tr>
											<tr>
											    <th>Order Date</th>
											    <th>Buyer's Ord. Dt.</th>
											    <th>Ou Ship. Date</th>
												<th>Cut Issue</th>
												<th>Cut Rcv.</th>
												<th>Cut Bal.</th>
												<th>Cut Bill</th>
												<th class="text-center">Lthr. Invd.</th>
												<th class="text-center">Supp. Nm.</th>
												<th class="text-center">Pend. Dtls.</th>
												<th>Fab Issue</th>
												<th>Fab Rcv.</th>
												<th>Fab Bal.</th>
												<th>Jobb. Bill</th>
												<th>Qnt. Shpd</th>
												<th>Qnt. Rem</th>
												<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
											</tr>
										</thead>
										<tbody>									
												<?php
        } ?>
												<tr>
													<th><?=$res->co_no
?></th>
													<td><?=$res->art_no . ' [' . $res->color . ']' ?></td>
													<td style="white-space: nowrap;"><?= date("d-m-Y", strtotime($res->co_date)) ?></td>
													<td style="white-space: nowrap;">
													  <?php 
			$breakup_ordate = $this->db->get_where('cust_order_brk_up', array('cod_id' => $res->cod_id,))->result();
			if(count($breakup_ordate > 0)) {
			    foreach($breakup_ordate as $b_o) {
			        echo date("d-m-Y", strtotime($b_o->ord_date))." - ".$b_o->co_quantity."<br/>";
			    }
			} else {
			        echo '';
			}
													  ?>
													</td>
													<td style="white-space: nowrap;"><?php
													$breakup_ordate = $this->db->get_where('cust_order_brk_up', array('cod_id' => $res->cod_id,))->result();
			if(count($breakup_ordate > 0)) {
			    foreach($breakup_ordate as $b_o) {
			        echo date("d-m-Y", strtotime($b_o->ord_date))."<br/>";
			    }
			} else {
			        echo '';
			}
													?></td>
													<td class="text-right">
														<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
													</td>
													<td class="text-right">
														<?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
													</td>
													<td class="text-right">
													<?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
													</td>
													
													<?php
        $get_cutter_bill_details = $this
            ->db
            ->get_where('cutter_bill_dtl', array(
            'cut_id' => $res->cut_id,
            'cut_rcv_id' => $res->cut_rcv_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'leather_color' => $res->c_id
        ))
            ->row();
?>
													
													<td class="text-right">
													<?php
        if (count($get_cutter_bill_details) > 0)
        {
            echo number_format($get_cutter_bill_details->original_quantity, 2);
            array_push($grand_total_cut_bill, $get_cutter_bill_details->original_quantity);
            array_push($grand_total1_cut_bill, $get_cutter_bill_details->original_quantity);
        }
        else
        {
            echo '0';
            array_push($grand_total_cut_bill, 0);
            array_push($grand_total1_cut_bill, 0);
        }
?>
													</td>
                 <?php if($cut_balc != 0) { ?>
                                                <?php
                                                $this->db->empty_table('temp_consumption');

        $data_array = array();
        $order_query = "SELECT
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
WHERE
    `co_id` = $res->co_id AND `customer_order_dtl`.`am_id` = $res->am_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this->db->query($order_query)->result(); 

        // echo $this->db->last_query(); die();

        // echo $order_colour_res; die();

        // echo '<pre>', print_r($order_colour_res), '</pre>'; die();

        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $res->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $ress = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$ress->co_no,
                    'co_date' =>$ress->co_date,
                    'buyer_reference_no'=>$ress->buyer_reference_no,
                    'co_reference_date'=>$ress->co_reference_date,
                    'name' =>$ress->name,
                    'short_name'=>$ress->short_name,
                    'item_name'=>$ress->item_name,
                    'item_code' =>$ress->item_code,
                    'ig_code'=>$ress->ig_code,
                    'group_name'=>$ress->group_name,
                    'unit' =>$ress->unit,
                    'leather_color'=>$ress->leather_color,
                    'fitting_color'=>$ress->fitting_color,
                    'item_color' =>$ress->item_color,
                    'item_color_id' =>$ress->item_color_id,
                    'lc_id' =>$ress->lc_id,
                    'id_id'=>$ress->id_id,
                    'im_id'=>$ress->im_id,
                    'ig_id'=>$ress->ig_id,
                    'cod_id' =>$ress->cod_id,
                    'co_id'=>$ress->co_id,
                    'am_id'=>$ress->am_id,
                    'costing_id' =>$ress->costing_id,
                    'show_total_in_consumption' =>$ress->show_total_in_consumption,
                    'item_dtl'=>$ress->item_dtl,
                    'item_dtl_quantity'=>$ress->item_dtl_quantity,
                    'co_quantity' =>$ress->co_quantity,
                    'temp_qnty'=>$ress->temp_qnty,
                    'final_qnty'=>$ress->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $res->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption')->result();
foreach($result1 as $res11) {
foreach($consumption_list as $cl) {
    if($res11->im_id == $cl->im_id && $res11->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res11->co_no,
                    'co_date' =>$res11->co_date,
                    'buyer_reference_no'=>$res11->buyer_reference_no,
                    'co_reference_date'=>$res11->co_reference_date,
                    'name' =>$res11->name,
                    'short_name'=>$res11->short_name,
                    'item_name'=>$res11->item_name,
                    'item_code' =>$res11->item_code,
                    'ig_code'=>$res11->ig_code,
                    'group_name'=>$res11->group_name,
                    'unit' =>$res11->unit,
                    'leather_color'=>$res11->leather_color,
                    'fitting_color'=>$res11->fitting_color,
                    'item_color' =>$res11->item_color,
                    'item_color_id' =>$res11->item_color_id,
                    'lc_id' =>$res11->lc_id,
                    'id_id'=>$res11->id_id,
                    'im_id'=>$res11->im_id,
                    'ig_id'=>$res11->ig_id,
                    'cod_id' =>$res11->cod_id,
                    'co_id'=>$res11->co_id,
                    'am_id'=>$res11->am_id,
                    'costing_id' =>$res11->costing_id,
                    'show_total_in_consumption' =>$res11->show_total_in_consumption,
                    'item_dtl'=>$res11->item_dtl,
                    'item_dtl_quantity'=>$res11->item_dtl_quantity,
                    'co_quantity' =>$res11->co_quantity,
                    'temp_qnty'=>$res11->temp_qnty,
                    'final_qnty'=>$res11->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
}
}


        
            }
        
            }
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
        $store_all_item_values = $this->db->where('ig_id', 1)->order_by('ig_id, item_name, item_color')->get('temp_consumption')->result();
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();
                                                          ?>

													<td class="text-left" style="white-space: nowrap; font-size: 12px;">
														<?php
                                                     if(count($store_all_item_values) > 0) {
													 foreach($store_all_item_values as $s_a_i_v) {
													     echo $s_a_i_v->item_name . "[" . $s_a_i_v->item_color . "]" . " - <b>" . $s_a_i_v->co_quantity . "</b><br/>";
													 }
                                                     }
?>
													</td>
													<td class="text-left" style="white-space: nowrap; font-size: 12px;">
														<?php
                                                    if(count($store_all_item_values) > 0) {
													 foreach($store_all_item_values as $s_a_i_v) {
													     echo $s_a_i_v->name."<br/>";
													 }
                                                    }
?>
													</td>
													<td class="text-left" style="white-space: nowrap; font-size: 12px;">
														<?php
                                                    if(count($store_all_item_values) > 0) {
													 foreach($store_all_item_values as $s_a_i_v) {
													     
        $result_pu = $this
            ->db
            ->select('SUM(purchase_order_details.pod_quantity) as pod_quantity, purchase_order.po_id, purchase_order.po_number')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
            ->where('purchase_order_details.id_id', $s_a_i_v->id_id)
            ->where('purchase_order.status', '1')
            ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
            ->get_where('purchase_order_details')
            ->result(); ?>
            <?php
        if (count($result_pu) > 0) {
            foreach($result_pu as $r_p) {
            $pod_quantity = $r_p->pod_quantity;
        $result_sup = $this
            ->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
            ->where('supp_purchase_order_detail.id_id', $s_a_i_v->id_id)
            ->where('supp_purchase_order.po_id', $r_p->po_id)
            ->where('supp_purchase_order.supp_status', '1')
            ->get_where('supp_purchase_order')
            ->row();
        if (count($result_sup) > 0)
        {
            $result_su = $this
                ->db
                ->select('SUM(supp_purchase_order_detail.item_qty) as item_qty')
                ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
                ->where('supp_purchase_order_detail.id_id', $s_a_i_v->id_id)
                ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
                ->where('supp_purchase_order_detail.status', '1')
                ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
                ->get_where('supp_purchase_order_detail')
                ->row();
            if (count($result_su) > 0)
            {
?>
            <?php
                $sup_quantity = $result_su->item_qty;
            }
        }
        else
        {
            $sup_quantity = 0;
        }

        $result_rc = $this
            ->db
            ->select('SUM(purchase_order_receive_detail.item_quantity) as item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
            ->where('purchase_order_receive_detail.id_id', $s_a_i_v->id_id)
            ->where('purchase_order_receive_detail.po_id', $r_p->po_id)
            ->where('purchase_order_receive_detail.status', '1')
            ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
            ->get('purchase_order_receive_detail')
            ->row();
?>
            <?php
        if (count($result_rc) > 0)
        {
            $rcv_quantity = $result_rc->item_quantity;
        }
        else
        {
            $rcv_quantity = 0;
        }
        $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
        
        if($balc < 100) {
            continue;
        }
													     echo $r_p->po_number. ' - <b>'. $balc."</b><br/>";
            }
        }
													 }
                                                    }
?>
													</td>
											 <?php } else { ?>
											   <td> - </td>
											   <td> - </td>
											   <td> - </td>
											 <?php } ?>
													<td class="text-right" style="white-space: nowrap;">
														<?php
														
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
													</td>
													<td class="text-right" style="white-space: nowrap;">
														<?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
													</td>
													<td class="text-right">
														<?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
													</td>
													
													<?php
        $get_jobber_bill_details = $this
            ->db
            ->get_where('jobber_bill_detail', array(
            'jobber_issue_id' => $res->jobber_issue_id,
            'jobber_challan_receipt_id' => $res->jobber_challan_receipt_id,
            'co_id' => $res->co_id,
            'am_id' => $res->am_id,
            'lc_id' => $res->c_id
        ))
            ->row();
?>
													
													<td class="text-right">
													<?php
        if (count($get_jobber_bill_details) > 0)
        {
            echo number_format($get_jobber_bill_details->quantity, 2);
            array_push($grand_total_job_bill, $get_jobber_bill_details->quantity);
            array_push($grand_total1_job_bill, $get_jobber_bill_details->quantity);
        }
        else
        {
            echo '0';
            array_push($grand_total_job_bill, 0);
            array_push($grand_total1_job_bill, 0);
        }
?>
													</td>
													
													<?php 
													$pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.cod_id' => $res->cod_id,
            'packing_shipment_detail.am_id' => $res->am_id,
            'packing_shipment_detail.lc_id' => $res->lc_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            
            if(count($pack_shipment_num) > 0) {
            
            $qtty = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.cod_id' => $res->cod_id,
                'packing_shipment_detail.am_id' => $res->am_id,
                'packing_shipment_detail.lc_id' => $res->lc_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
                
            } else {
                
            $qtty = 0;
                
            }
													?>

													<td class="text-right">
														<?php
        echo $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
													</td>
													<td class="text-right">
														<?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
													</td>
												</tr>
												<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="5">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_bill) ?></th>
														<th class="text-right"></th>
														<th class="text-right"></th>
														<th class="text-right"></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_job_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
														<th colspan="3" class="text-right"></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="5">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_bill) ?></th>
														<th class="text-right"></th>
														<th class="text-right"></th>
														<th class="text-right"></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_job_bill) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
														<th colspan="3" class="text-right"></th>
													</tr>
													<?php
    }
?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		</div>
		</body>
		<?php
} ?>
	
	<?php if ($segment == 'outstanding_report')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 13px;
         }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">OUTSTANDING REPORT</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                <th>Buyer Name</th>
                                <th>Proforma No</th>
                                <th>Ord. Number</th>
                                <th>Dept.</th>
                                <th>Order Date</th>
                                <th>Order Delivery Date</th>
                                <th>Our Style</th>
                                <th>Buyer Style</th>
                                <th>Colour</th>
                                <th style="text-align: right;">Qnty. Ordered</th>
                                <th style="text-align: right;">Qnty. Sold</th>
                                <th style="text-align: right;">Qnty. Balance</th>
                                <th style="text-align: right;">Rate</th>
                                <th style="text-align: right;">Balance Amount</th>
                                <th style="text-align: right;">Conv. Rate</th>
                                <th style="text-align: right;">INR. Balance Amount</th>
                </tr>
                </thead>
                <tbody>
                            <?php
    $total = 0;
    $total1 = 0;
    $inc_total = 0;
    $exp_total = 0;
    $iter = 1;
    $colspan_val = 0;

    // $groups = array();
    // foreach($result as $key=>$res) {
    //         foreach($res as $key=>$val) {
    //         	$key = $iter;
    //             if ($val->am_id == $iter) {
    //                 $groups[$key]['am_id'] = $val->am_id;
    //                 $groups[$key]['colspan_val'] = $colspan_val ++;
    //             } else {
    //             	$colspan_val = 0;
    //             	$iter++;
    //             }
    //         }
    //     }
    $count = 0;
    $gt1 = 0;
    $gt2 = 0;
    $gt3 = 0;
    $gt4 = 0;
    $gt5 = 0;
    $gtt1 = 0;
    $gtt2 = 0;
    $gtt3 = 0;
    $gtt4 = 0;
    $gtt5 = 0;

    $groups = array();
    foreach ($result as $fasd)
    {
        foreach ($fasd as $f)
        {
            
            
            $get_quantity_actl_valus = $this->db->select('SUM(office_invoice_detail.quantity) AS invoice_quantity')->get_where('office_invoice_detail', array('office_invoice_detail.cod_id' => $f->cod_id))->row();
            
            
            $key = $f->proforma_number;
            if (!isset($groups[$key]))
            {
                $groups[$key] = array(
                    'proforma_number' => $f->proforma_number,
                    'total_co_quantity' => $f->co_quantity,
                    'total_quantity' => $get_quantity_actl_valus->invoice_quantity,
                    'minus_quantity' => ($f->co_quantity - $get_quantity_actl_valus->invoice_quantity) ,
                    'rate_foreign' => $f->rate_foreign,
                    'minus_foreign' => (($f->co_quantity - $get_quantity_actl_valus->invoice_quantity) * $f->rate_foreign) ,
                    'count' => 1,
                );
            }
            else
            {
                $groups[$key]['proforma_number'] = $f->proforma_number;
                $groups[$key]['total_co_quantity'] += $f->co_quantity;
                $groups[$key]['total_quantity'] += $get_quantity_actl_valus->invoice_quantity;
                $groups[$key]['minus_quantity'] += ($f->co_quantity - $get_quantity_actl_valus->invoice_quantity);
                $groups[$key]['rate_foreign'] += $f->rate_foreign;
                $groups[$key]['minus_foreign'] += (($f->co_quantity - $get_quantity_actl_valus->invoice_quantity) * $f->rate_foreign);
                $groups[$key]['count'] += 1;
            }
        }
    }

    // echo '<pre>', print_r($groups), '</pre>';die();
    $new_array = array();
    $count = 0;
    $new_iterr = 0;
    foreach ($result as $res)
    {
        $count_iter = 0;
        //   $count_iter = 0;
        foreach ($res as $curr_key => $f)
        {

            $keys = array();
            foreach ($res as $key => $val)
            {
                if ($val->proforma_number == $f->proforma_number)
                {
                    array_push($keys, $key);
                }
            }

            if (end($keys) == $curr_key)
            {
                $new_iterr = ($new_iterr + 1);
            }
            $new_iterr++;

            $arr = array(
                'name' => $f->name,
                'count' => $new_iterr
            );
            array_push($new_array, $arr);

        }
        $new_iterr = 0;
    }

    // echo '<pre>', print_r($new_array), '</pre>';die();
    foreach ($result as $res)
    {
        $new_iter = 0;
        $count_iter = 0;
        $count = count($res);

        // echo '<pre>', print_r($res), '</pre>';die();
        if ($count > 0)
        {
            foreach ($res as $curr_key => $f)
            {

                $keys = array();
                foreach ($res as $key => $val)
                {
                    if ($val->proforma_number == $f->proforma_number)
                    {
                        array_push($keys, $key);
                    }
                }

                if (end($keys) == $curr_key)
                {
                    $count = ($count + 1);
                    $new_iter = ($new_iter + 1);
                }

                // echo '<pre>', print_r($keys), '</pre>';
                
                
                $get_quantity_vales = $this->db->select('SUM(office_invoice_detail.quantity) AS invoice_quantity')->get_where('office_invoice_detail', array('office_invoice_detail.cod_id' => $f->cod_id))->row();
                
                
                $gt1 += $f->co_quantity;
                $gt2 += $get_quantity_vales->invoice_quantity;
                $gt3 += $f->co_quantity - $get_quantity_vales->invoice_quantity;
                $gt4 += ($f->co_quantity - $get_quantity_vales->invoice_quantity) * $f->rate_foreign;
                $gt5 += 0.00;
                $gtt1 += $f->co_quantity;
                $gtt2 += $get_quantity_vales->invoice_quantity;
                $gtt3 += $f->co_quantity - $get_quantity_vales->invoice_quantity;
                $gtt4 += ($f->co_quantity - $get_quantity_vales->invoice_quantity) * $f->rate_foreign;
                $gtt5 += 0.00;
?>
                                    <tr>
                                    	<?php
                if ($new_iter == 0 or $new_iter == $count)
                {
                    foreach ($new_array as $n_a)
                    {
                        if ($n_a['name'] == $f->name)
                        {
                            $countt = $n_a['count'];
                        }
                    }
?>
                                        <td rowspan="<?=$countt
?>"><?=$f->name
?></td>
                                    <?php
                } ?>
                                        <td><?=$f->proforma_number
?></td>
                                        <td><?=$f->co_no
?></td>
                                        <td><?=$f->department
?></td>
                                        <td><?=$f->co_date
?></td>
                                        <td><?=$f->co_delivery_date
?></td>
                                        <td><?=$f->art_no
?></td>
                                        <td><?=$f->alt_art_no
?></td>
                                        <td><?=$f->color
?></td>
                                        <td style="text-align: right;"><?=$f->co_quantity
?></td>
                                        <?php if ($f->quantity != '')
                { 
                
                
                
        $get_quantity = $this->db->select('SUM(office_invoice_detail.quantity) AS invoice_quantity')->get_where('office_invoice_detail', array('office_invoice_detail.cod_id' => $f->cod_id))->row();

                
                ?>
                                        <td style="text-align: right;"><?=$get_quantity->invoice_quantity
?></td>
                                        <?php
                }
                else
                { ?>
                                        <td style="text-align: right;">0</td>
                                        <?php
                } ?>
                                        <td style="text-align: right;"><?=($f->co_quantity - $f->quantity) ?></td>
                                        <td style="text-align: right;"><?=$f->rate_foreign ?></td>
                                        <td style="text-align: right;"><?=(($f->co_quantity - $f->quantity) * $f->rate_foreign) ?></td>
                                        <td style="text-align: right;">0.00</td>
                                        <td style="text-align: right;">0.00</td>
                                    </tr>   
                                    
                                    <?php
                if (end($keys) == $curr_key)
                {
?>
                                        <tr>
                                            <th colspan="8">Total for <?=$groups[$f->proforma_number]['proforma_number'] ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->proforma_number]['total_co_quantity'], 2) ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->proforma_number]['total_quantity'], 2) ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->proforma_number]['minus_quantity'], 2) ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->proforma_number]['rate_foreign'], 2) ?></th>
                                            <th style="text-align: right;"><?=number_format($groups[$f->proforma_number]['minus_foreign'], 2) ?></th>
                                            <th style="text-align: right;">0.00</th>
                                            <th style="text-align: right;">0.00</th>
                                        </tr>
                                        <?php
                }
?>

                                <?php
                $new_iter++;
            } ?>
                            <tr class="bg-info">
                            <th colspan="9">Total</th>
                            <th style="text-align: right;"><?=$gtt1
?></th>
                            <th style="text-align: right;"><?=$gtt2
?></th>
                            <th style="text-align: right;"><?=$gtt3
?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gtt4
?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gtt5
?></th>
                            </tr>
                            <?php
            $gtt1 = 0;
            $gtt2 = 0;
            $gtt3 = 0;
            $gtt4 = 0;
            $gtt5 = 0;
?>
                            <?php
            $count = 0;
            $new_iter = 1;
        }
    }
?>
                            <tr class="bg-primary">
                            <th colspan="9">Grand Total</th>
                            <th style="text-align: right;"><?=$gt1
?></th>
                            <th style="text-align: right;"><?=$gt2
?></th>
                            <th style="text-align: right;"><?=$gt3
?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gt4
?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gt5
?></th>
                            </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php if ($segment == 'buyer_wise_order_details_pending')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 14px;
         }
		</style>
		<body class="A4 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Pending Order Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th colspan="3" class="text-center">Date Details</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="2" class="text-center">Checking Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
										    <th>Order <br/> Date</th>
											<th>Buyer's <br/> Delv. Dt.</th>
											<th>Ship. <br/> Date</th>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Checked</th>
											<th>Pending</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$groups = array();
                                foreach ($result as $res) {
                                    
                                    $pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.co_id' => $res->co_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            if(count($pack_shipment_num) > 0) {
            $qtty = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.co_id' => $res->co_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
            } else {
                
            $qtty = 0;
                
            }
        if (($res->co_quantity - $qtty) <= 0)
        {
            continue;
        }
                                    
                                    $key = $res->buyer_reference_no;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'buyer_reference_no' => $res->buyer_reference_no,
                                            'co_no' => $res->co_no,
                                        );
                                    } else {
                                        $groups[$key]['buyer_reference_no'] = $res->buyer_reference_no;
                                        $groups[$key]['co_no'] = $res->co_no;
                                    }
                                }
										
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $chek_qntty = 0;
    $chek_blnc = 0;
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    
    foreach ($result as $curr_key=>$res)
    {
        
	    											$pack_shipment_num = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.co_id' => $res->co_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            if(count($pack_shipment_num) > 0) {
            $qtty = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.co_id' => $res->co_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
            } else {
                
            $qtty = 0;
                
            }
        if (($res->co_quantity - $qtty) <= 0)
        {
            continue;
        }
        
        $keys = array();
        
        if(trim($res->buyer_reference_no) == '') {
          continue;  
        }
        
                                    foreach($result as $key=>$val) {
                                        if ($val->buyer_reference_no == $res->buyer_reference_no) {
                                            $pack_shipment_num1 = $this
            ->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
            ->get_where('packing_shipment_detail', array(
            'packing_shipment_detail.co_id' => $val->co_id,
            'packing_shipment_detail.status' => 1
        ))
            ->num_rows();
            if(count($pack_shipment_num1) > 0) {
            $qtty1 = $this
                ->db
                ->select('SUM(packing_shipment_detail.article_quantity) as article_quantity')
                ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
                ->get_where('packing_shipment_detail', array(
                'packing_shipment_detail.co_id' => $val->co_id,
                'packing_shipment_detail.status' => 1
            ))
                ->row()->article_quantity;
            } else {
                
            $qtty1 = 0;
                
            }
        if (($val->co_quantity - $qtty1) <= 0)
        {
            continue;
        }
        if(trim($val->buyer_reference_no) == '') {
          continue;  
        }
                                            array_push($keys, $key);
                                        }
                                    }
                                    
        
        
        //  if($res->user_id != $this->session->user_id) {
        //      continue;
        //  }
        if ($show_iter == 26 or $show_iter == $new_show_iter)
        {
            $new_show_iter += 25;
?>
												
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
												</div>
												</body>
												<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Pending Order Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th colspan="3" class="text-center">Date Details</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="2" class="text-center">Checking Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
										    <th>Order <br/> Date</th>
											<th>Buyer's <br/> Delv. Dt.</th>
											<th>Ship. <br/> Date</th>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Checked</th>
											<th>Pending</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php
        } ?>

											<tr>
												<th style="font-size: 14px">
												
												<?=$res->name?>
												
												</th>
												<th style="font-size: 14px">
												    
												<?=$res->buyer_reference_no?>
												
												<?php
												
												echo '['.$department_sh = $this->db
												->join('departments', 'departments.d_id = user_details.user_dept', 'left')
												->get_where('user_details', array('user_details.user_id' => $res->user_id))->row()->department.']';
												
												?>
												
												</th>
<td style="white-space: nowrap;"><?= date("d-m-Y", strtotime($res->co_date)) ?></td>
													<td style="white-space: nowrap;"><?= date("d-m-Y", strtotime($res->co_delivery_date)) ?></td>
													<?php if($res->shipment_date != '0000-00-00') { ?>
													<td style="white-space: nowrap;"><?= date("d-m-Y", strtotime($res->shipment_date)) ?></td>
													<?php } else { ?>
													<td></td>
													<?php } ?>
												<td class="text-right">
												<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
														</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo round($cut_balc);
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo round($res->jobber_receive_qnty);
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo round($fab_balc);
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
												</td>
												
												<?php 
													$checking_shipment_row_details = $this
            ->db->select_sum('checked_quantity')
            ->get_where('checking_details', array(
            'checking_details.co_id' => $res->co_id,
            'checking_details.status' => 1
        ))
            ->row();
            if(count($checking_shipment_row_details) > 0) {
            ?>
												
												<td class="text-right">
												    <?php
        echo $checking_shipment_row_details->checked_quantity;
        array_push($grand_total_skv_isu, $checking_shipment_row_details->checked_quantity);
        array_push($grand_total1_skv_isu, $checking_shipment_row_details->checked_quantity);
?>
												</td>
												<td class="text-right">
												    <?php
        $chek_blnc = $res->co_quantity - $checking_shipment_row_details->checked_quantity;
        echo round($chek_blnc);
        array_push($grand_total_skv_rcv, $chek_blnc);
        array_push($grand_total1_skv_rcv, $chek_blnc);
?>
												</td>
												<?php } else { ?>
												<td class="text-right"> 0 </td>
												    <td class="text-right">
												    <?php
        $chek_blnc = $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_skv_rcv, $chek_blnc);
        array_push($grand_total1_skv_rcv, $chek_blnc);
?>
												</td>
												<?php } ?>
												<td class="text-right">
												    <?php
        echo round($qtty);
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
												</td>
											</tr>
											
										<?php
											if(end($keys) == $curr_key) {
                                        ?>
                                        
                                        <tr>
                                        <th colspan="5"> Total </th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>    
                                        </tr>
                                        
                                        <?php
                                        
    $grand_total1_co_qnty = array();
    $grand_total1_cut_issue = array();
    $grand_total1_cut_rcv = array();
    $grand_total1_cut_balc = array();
    $grand_total1_skv_isu = array();
    $grand_total1_skv_rcv = array();
    $grand_total1_skv_balc = array();
    $grand_total1_fab_isu = array();
    $grand_total1_fab_rcv = array();
    $grand_total1_fab_balc = array();
    $grand_total1_qnty_shpd = array();
    $grand_total1_qnty_remn = array();
    $grand_total1_qnty_stck = array();
                                        
                                    }
                                    ?>
											
											<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="5">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php if ($segment == 'buyer_wise_order_and_article_details_pending')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name->co_no, $temp_co_name_array))
        {
            array_push($temp_co_name_array, $co_name->co_no);
        }
    }
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 18px;
         }
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Article</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Skiv Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
										<?php
    $show_iter = 1;
    $co_array[] = '';
    $new_show_iter = 26;
    // echo $array_size = count($result);
    $order_sum = 0;
    $order_iter = 1;
    $ord_qnty_sum = 0;
    $grand_total_co_qnty = array();
    $grand_total1_co_qnty = array();
    $grand_total_cut_issue = array();
    $grand_total1_cut_issue = array();
    $grand_total_cut_rcv = array();
    $grand_total1_cut_rcv = array();
    $grand_total_cut_balc = array();
    $grand_total1_cut_balc = array();
    $cut_balc = 0;
    $grand_total_skv_isu = array();
    $grand_total1_skv_isu = array();
    $grand_total_skv_rcv = array();
    $grand_total1_skv_rcv = array();
    $skv_balc = 0;
    $grand_total_skv_balc = array();
    $grand_total1_skv_balc = array();
    $grand_total_fab_isu = array();
    $grand_total1_fab_isu = array();
    $grand_total_fab_rcv = array();
    $grand_total1_fab_rcv = array();
    $fab_balc = 0;
    $grand_total_fab_balc = array();
    $grand_total1_fab_balc = array();
    $grand_total_qnty_shpd = array();
    $grand_total1_qnty_shpd = array();
    $qnty_remn = 0;
    $grand_total_qnty_remn = array();
    $grand_total1_qnty_remn = array();
    $qnty_stck = 0;
    $grand_total_qnty_stck = array();
    $grand_total1_qnty_stck = array();
    foreach ($result as $res)
    {
        
												if($res->pack_status == 1) { 
                                                    $qtty = $res->packing_shipment_quantity;
												 } else {
												    $qtty = 0;
												 }
        if (($res->co_quantity - $qtty) <= 0)
        {
            continue;
        }
        if (!in_array($res->co_no, $co_array))
        {
            array_push($co_array, $res->co_no);
            if ($order_iter++ == 1)
            {
                // continue;
                
            }
            else
            {
?>
											
											<tr style="background-color: #d9e2ea;">
															<th colspan="3">Total</th>
															<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
														</tr>
														
														<?php
                $grand_total1_co_qnty = array();
                $grand_total1_cut_issue = array();
                $grand_total1_cut_rcv = array();
                $grand_total1_cut_balc = array();
                $grand_total1_skv_isu = array();
                $grand_total1_skv_rcv = array();
                $grand_total1_skv_balc = array();
                $grand_total1_fab_isu = array();
                $grand_total1_fab_rcv = array();
                $grand_total1_fab_balc = array();
                $grand_total1_qnty_shpd = array();
                $grand_total1_qnty_remn = array();
                $grand_total1_qnty_stck = array();
            }
        }
        if ($show_iter == 26 or $show_iter == $new_show_iter)
        {
            $new_show_iter += 25;
?>
												
												</tbody>
												</table>
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												</section>
												</div>
												</body>
												<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Order Status Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right"></div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Buyer Name</th>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Article</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="3" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th colspan="3" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
											<th>Cut Rcv.</th>
											<th>Cut Bal.</th>
											<th>Skiv Issue</th>
											<th>Skiv Rcv.</th>
											<th>Skiv Bal.</th>
											<th>Fab Issue</th>
											<th>Fab Rcv.</th>
											<th>Fab Bal.</th>
											<th>Qnt. Shpd</th>
											<th>Qnt. Rem</th>
											<th style="text-align:right">Qnt. Stock <br>(in-hand)</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php
        } ?>

											<tr>
												<th nowrap style="font-size: 12px"><?=$res->name
?></th>
												<th nowrap style="font-size: 12px"><?=$res->co_no
?></th>
												<td nowrap style="font-size: 12px"><?=$res->art_no . ' [' . $res->color . ']' ?></td>
												<td class="text-right">
												<?php
        $ord_qnty_sum += $res->co_quantity;
        echo $res->co_quantity;
        array_push($grand_total_co_qnty, $res->co_quantity);
        array_push($grand_total1_co_qnty, $res->co_quantity);
?>
														</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_issued_qnty;
        array_push($grand_total_cut_issue, $res->cutting_issued_qnty);
        array_push($grand_total1_cut_issue, $res->cutting_issued_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_cut_rcv, $res->cutting_received_qnty);
        array_push($grand_total1_cut_rcv, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $cut_balc = $res->cutting_issued_qnty - $res->cutting_received_qnty;
        echo $cut_balc;
        array_push($grand_total_cut_balc, $cut_balc);
        array_push($grand_total1_cut_balc, $cut_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->cutting_received_qnty;
        array_push($grand_total_skv_isu, $res->cutting_received_qnty);
        array_push($grand_total1_skv_isu, $res->cutting_received_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->skiving_receive_qnty;
        array_push($grand_total_skv_rcv, $res->skiving_receive_qnty);
        array_push($grand_total1_skv_rcv, $res->skiving_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $skv_balc = $res->cutting_received_qnty - $res->skiving_receive_qnty;
        echo $skv_balc;
        array_push($grand_total_skv_balc, $skv_balc);
        array_push($grand_total1_skv_balc, $skv_balc);
?>
												</td>

												<td class="text-right">
												    <?php
        echo $res->jobber_issue_qnty;
        array_push($grand_total_fab_isu, $res->jobber_issue_qnty);
        array_push($grand_total1_fab_isu, $res->jobber_issue_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        echo $res->jobber_receive_qnty;
        array_push($grand_total_fab_rcv, $res->jobber_receive_qnty);
        array_push($grand_total1_fab_rcv, $res->jobber_receive_qnty);
?>
												</td>
												<td class="text-right">
												    <?php
        $fab_balc = $res->jobber_issue_qnty - $res->jobber_receive_qnty;
        echo $fab_balc;
        array_push($grand_total_fab_balc, $fab_balc);
        array_push($grand_total1_fab_balc, $fab_balc);
?>
												</td>
												
												<?php 
												if($res->pack_status == 1) { 
                                                    $qtty = $res->packing_shipment_quantity;
												 } else {
												    $qtty = 0;
												 } 
												 ?>

												<td class="text-right">
												    <?php
        echo $qtty;
        array_push($grand_total_qnty_shpd, $qtty);
        array_push($grand_total1_qnty_shpd, $qtty);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_remn = $res->co_quantity - $qtty;
        echo $qnty_remn;
        array_push($grand_total_qnty_remn, $qnty_remn);
        array_push($grand_total1_qnty_remn, $qnty_remn);
?>
												</td>
												<td class="text-right">
												    <?php
        $qnty_stck = $res->jobber_receive_qnty - $qtty;
        echo $qnty_stck;
        array_push($grand_total_qnty_stck, $qnty_stck);
        array_push($grand_total1_qnty_stck, $qnty_stck);
?>
												</td>
											</tr>
											<?php
        $show_iter++;
    }
    if (end($result))
    {
?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="3">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck) ?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="3">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv) ?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn) ?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck) ?></th>
													</tr>
													<?php
    }
?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php /* if ($segment == 'outstanding_report_groupwise')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 13px;
         }
		</style>
		<body class="A4" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">OUTSTANDING REPORT</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                <th>Buyer Name</th>
                                <th>Proforma No</th>
                                <th>Ord. Number</th>
                                <th style="text-align: right;">Qnty. Ordered</th>
                                <th style="text-align: right;">Qnty. Sold</th>
                                <th style="text-align: right;">Qnty. Balance</th>
                                <th style="text-align: right;">Balance Amount</th>
                                <th style="text-align: right;"> INR Order Amount </th>
                </tr>
                </thead>
                <tbody>
                            <?php
    $total = 0;
    $total1 = 0;
    $inc_total = 0;
    $exp_total = 0;
    $iter = 1;
    $colspan_val = 0;

    // $groups = array();
    // foreach($result as $key=>$res) {
    //         foreach($res as $key=>$val) {
    //         	$key = $iter;
    //             if ($val->am_id == $iter) {
    //                 $groups[$key]['am_id'] = $val->am_id;
    //                 $groups[$key]['colspan_val'] = $colspan_val ++;
    //             } else {
    //             	$colspan_val = 0;
    //             	$iter++;
    //             }
    //         }
    //     }
    $count = 0;
    $gt1 = 0;
    $gt2 = 0;
    $gt3 = 0;
    $gt4 = 0;
    $gt5 = 0;
    $gt6 = 0;
    $new_amnt_blnc_dtls = 0;
    $gtt1 = 0;
    $gtt2 = 0;
    $gtt3 = 0;
    $gtt4 = 0;
    $gtt5 = 0;
    $gtt6 = 0;
    $minus_qnty_neww1 = 0;
    $co_qnty_neww1 = 0;
    $qnty_neww1 = 0;

    $groups = array();
    foreach ($result as $fasd)
    {
        foreach ($fasd as $f)
        {
            $key = $f->proforma_number;
            if (!isset($groups[$key]))
            {
                if (($f->co_quantity - $f->quantity) > 0)
                {
                    $minus_foreign = (($f->co_quantity - $f->quantity) * $f->rate_foreign);
                }
                else
                {
                    $minus_foreign = 0;
                }
                
                if (($f->co_quantity - $f->quantity) <= 0) {
                    continue;
                }
                
                $groups[$key] = array(
                    'proforma_number' => $f->proforma_number,
                    'total_co_quantity' => $f->co_quantity,
                    'total_quantity' => $f->quantity,
                    'minus_quantity' => ($f->co_quantity - $f->quantity) ,
                    'rate_foreign' => $f->rate_foreign,
                    'minus_foreign' => $minus_foreign,
                    'count' => 1,
                );
            }
            else
            {
                $groups[$key]['proforma_number'] = $f->proforma_number;
                $groups[$key]['total_co_quantity'] += $f->co_quantity;
                $groups[$key]['total_quantity'] += $f->quantity;
                $groups[$key]['minus_quantity'] += ($f->co_quantity - $f->quantity);
                $groups[$key]['rate_foreign'] += $f->rate_foreign;
                if (($f->co_quantity - $f->quantity) > 0)
                {
                    $groups[$key]['minus_foreign'] += (($f->co_quantity - $f->quantity) * $f->rate_foreign);
                }
                else
                {
                    $groups[$key]['minus_foreign'] += 0;
                }
                $groups[$key]['count'] += 1;
            }
        }
    }

    foreach ($result as $res)
    {
        $new_iter = 0;
        $count_iter = 0;
        $new_amnt_blnc_dtls = 0;
        $count = count($res);

        // echo '<pre>', print_r($res), '</pre>';die();
        if ($count > 0)
        {
            foreach ($res as $curr_key => $f)
            {

                // echo '<pre>', print_r($keys), '</pre>';
                $query = "SELECT
                office_proforma.proforma_number,
                office_proforma.proforma_date,
                acc_master.am_id,
                acc_master.name,
                DATE_FORMAT(customer_order.co_date, '%d-%m-%Y') as co_date,
                customer_order.co_no,
                DATE_FORMAT(customer_order.co_delivery_date, '%d-%m-%Y') as co_delivery_date,
                customer_order.co_delivery_date,
                article_master.art_no,
                article_master.alt_art_no,
                colors.color,
                office_proforma_detail.co_quantity,
                SUM(office_invoice_detail.quantity) AS quantity,
                office_proforma_detail.rate_foreign,
                departments.department
                FROM
                `office_proforma`
                LEFT JOIN office_proforma_detail ON office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id
                LEFT JOIN acc_master ON acc_master.am_id = office_proforma.buyer_id
                LEFT JOIN customer_order ON customer_order.co_id = office_proforma_detail.co_id
                LEFT JOIN user_details ON user_details.user_id = customer_order.user_id
                LEFT JOIN departments ON departments.d_id = user_details.user_dept
                LEFT JOIN article_master ON article_master.am_id = office_proforma_detail.am_id
                LEFT JOIN colors ON colors.c_id = office_proforma_detail.lc_id
                LEFT JOIN office_invoice_detail ON office_invoice_detail.cod_id = office_proforma_detail.cod_id 
            WHERE 
            office_proforma.office_proforma_id = $f->office_proforma_id
            AND
                office_proforma.status = 1
            GROUP BY
                office_proforma_detail.office_proforma_detail_id
            ORDER BY
                office_proforma.proforma_number, customer_order.co_no, article_master.art_no, colors.color";
                $res_result = $this
                    ->db
                    ->query($query)->result();
                    
        $minus_qnty_neww1 = 0;
        $co_qnty_neww1 = 0;
        $qnty_neww1 = 0;

                foreach ($res_result as $r_r)
                {
                    $co_qnty = $r_r->co_quantity;
                    $qnty = $r_r->quantity;
                    $co_qnty_neww1 += $r_r->co_quantity;
                    $qnty_neww1 += $r_r->quantity;
                    $minus_qnty = ($co_qnty - $qnty);
                    $minus_qnty_neww1 += $minus_qnty;
                    if ($minus_qnty > 0)
                    {
                        $gt4 += ($minus_qnty) * $r_r->rate_foreign;
                        $gtt4 += ($minus_qnty) * $r_r->rate_foreign;
                        $new_amnt_blnc_dtls += ($minus_qnty_neww1) * $r_r->rate_foreign;
                        $gt1 += $r_r->co_quantity;
                $gt2 += $r_r->quantity;
                $gt3 += $r_r->co_quantity - $r_r->quantity;
                $gt5 += 0.00;
                $gtt1 += $r_r->co_quantity;
                $gtt2 += $r_r->quantity;
                $gtt3 += $r_r->co_quantity - $r_r->quantity;
                $gtt5 += 0.00;
                    }
                    else
                    {
                        $gt4 += 0;
                        $gtt4 += 0;
                        $new_amnt_blnc_dtls += 0;
                        $gt1 += 0;
                $gt2 += 0;
                $gt3 += 0;
                $gt5 += 0.00;
                $gtt1 += 0;
                $gtt2 += 0;
                $gtt3 += 0;
                $gtt5 += 0.00;
                    }

                }
                
                if ($minus_qnty_neww1 <= 0) {
                    continue;
                }
                
?>
                                    
                                    <tr>
                                    	<?php if ($new_iter == 0)
                { ?>
                                        <td rowspan="<?=$count
?>"><?=$f->name
?></td>
                                    <?php
                } ?>
                                        <td><?=$f->proforma_number
?></td>
                                        <?php
                $proforma_cus_ord_no = $this
                    ->db
                    ->select('customer_order.co_no, customer_order.co_id')
                    ->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left')
                    ->group_by('office_proforma_detail.co_id')
                    ->get_where('office_proforma_detail', array(
                    'office_proforma_detail.office_proforma_id' => $f->office_proforma_id
                ))
                    ->result();
?>
                                        <td><?php
                foreach ($proforma_cus_ord_no as $f_c_o_n)
                {
                    echo $f_c_o_n->co_no . "<br/>" ?>
                                        <?php
                } ?>
                                        </td>
                                        <td style="text-align: right;"><?= round($co_qnty_neww1)
?></td>
                                        <?php if ($qnty_neww1 != 0)
                { ?>
                                        <td style="text-align: right;"><?= round($qnty_neww1)
?></td>
                                        <?php
                }
                else
                { ?>
                                        <td style="text-align: right;">0</td>
                                        <?php
                } ?>
                                        <td style="text-align: right;"><?=$minus_qnty_neww1 ?></td>
                                        <td style="text-align: right;"><?=$new_amnt_blnc_dtls .'['. $f->currency .']' ?></td>
                                        
                                        <td style="text-align: right;">
                                        
                                        <?php 
                                        
                                        $nrows_sum = 0;
                                        
                                        foreach ($proforma_cus_ord_no as $f_c_o_n)
                {
                    
                    $nrows_sum = 0;
                    
                    
                    $query = "SELECT
                customer_order_dtl.co_quantity,
                customer_order_dtl.co_price,
                office_invoice_detail.quantity
                FROM
                `customer_order_dtl`
                LEFT JOIN office_invoice_detail ON office_invoice_detail.cod_id = customer_order_dtl.cod_id 
            WHERE 
            customer_order_dtl.co_id = $f_c_o_n->co_id
            AND
                customer_order_dtl.status = 1
                AND
                office_invoice_detail.status = 1
            ORDER BY
                customer_order_dtl.co_id";
                $res_result_news = $this
                    ->db
                    ->query($query)->result();
                    
            foreach($res_result_news as $r_n) {
            $nrows_sum += (($r_n->co_quantity - $r_n->quantity) * $r_n->co_price);
            }
            
            echo $nrows_sum."<br/>";
            $gt6 +=$nrows_sum;
            $gtt6 += $nrows_sum;
            
                }
                                        
                                        ?>
                                        
                                        </td>
                                        
                                        <?php $new_amnt_blnc_dtls = 0; ?>
                                    </tr>   

                                <?php
                $new_iter++;
            } ?>
                            <tr class="bg-info">
                            <th colspan="2">Total</th>
                            <th style="text-align: right;"><?=$gtt1
?></th>
                            <th style="text-align: right;"><?=$gtt2
?></th>
                            <th style="text-align: right;"><?=$gtt3
?></th>
                            <th style="text-align: right;"><?=$gtt4
?></th>

<th style="text-align: right;"><?=$gtt6
?></th>

                            </tr>
                            <?php
            $gtt1 = 0;
            $gtt2 = 0;
            $gtt3 = 0;
            $gtt4 = 0;
            $gtt5 = 0;
            $gtt6 = 0;
?>
                            <?php
            $count = 0;
            $new_iter = 1;
        }
    }
?>
                            <tr class="bg-primary">
                            <th colspan="2">Grand Total</th>
                            <th style="text-align: right;"><?=$gt1
?></th>
                            <th style="text-align: right;"><?=$gt2
?></th>
                            <th style="text-align: right;"><?=$gt3
?></th>
                            <th style="text-align: right;"><?=$gt4
?></th>

<th style="text-align: right;"><?=$gt6
?></th>

                            </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} */ ?>

<?php if ($segment == 'outstanding_report_groupwise')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 13px;
         }
		</style>
		<body class="A4 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">OUTSTANDING REPORT</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                <th>Buyer Name</th>
                                <th>Ord. Number</th>
                                <th>Proforma No</th>
                                <th style="text-align: right;">Qnty. Ordered</th>
                                <th style="text-align: right;">Proforma <br/> / <br/> Order Value</th>
                                <th style="text-align: right;">Qnty. Sold</th>
                                <th style="text-align: right;">Invoice <br/> / <br/> Sold Value</th>
                                <th style="text-align: right;">Qnty. Balance</th>
                                <th style="text-align: right;">Outstanding <br/> Amount</th>
                </tr>
                </thead>
                <tbody>
                    
                    
                    <?php 
                    
                    $quantity_total = 0;
                    $invoice_amount_total = 0;
                    $groups = array();
                    $qnty_balance_total = 0;
                    $outstanding_total = 0;
                    $co_quantity_total = 0;
                    $proforma_total_rate_amount_total = 0;
                    foreach($result as $resl) {
                    $key = $resl->user_dept;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'user_dept' => $resl->user_dept,
                                            'department' => $resl->department,
                                        );
                                    } else {
                                        $groups[$key]['user_dept'] = $resl->user_dept;
                                        $groups[$key]['department'] = $resl->department;
                                    }
                    }
                    if(count($result) > 0) {
                        foreach($result as $curr_key=>$resl){
                            $keys = array();
                            foreach($result as $key=>$res) {
                            if ($res->user_dept == $resl->user_dept) {
                                array_push($keys, $key);
                            }
                            }
                            $invoice_details = $this->db
            ->select('SUM(office_invoice_detail.quantity) AS quantity, SUM(office_invoice_detail.amount) AS invoice_amount')
            ->where('office_invoice_detail.co_id', $resl->co_id)
            ->where('office_invoice_detail.status', 1)
            ->get('office_invoice_detail')
            ->row();
            if(count($invoice_details) > 0) {
                $quantity = $invoice_details->quantity;
                $invoice_amount = $invoice_details->invoice_amount;
            } else {
                $quantity = 0;
                $invoice_amount = 0;
            }
            $proforma_details = $this->db
            ->select('proforma_number')
            ->join('office_proforma_detail', 'office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id', 'left')
            ->group_by('office_proforma_detail.office_proforma_id')
            ->where('office_proforma_detail.co_id', $resl->co_id)
            ->where('office_proforma.status', 1)
            ->get('office_proforma')
            ->result();
                            ?>
                            
                            
                            <tr>
                                <td><?=$resl->name?></td>
                                <td nowrap><?=$resl->co_no?></td>
                                <td nowrap>
                                    <?php
                                    foreach($proforma_details as $p_d) {
                                        echo $p_d->proforma_number."<br/>";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: right;"><?php echo (int)$resl->co_quantity; $co_quantity_total += $resl->co_quantity; ?></td>
                                <td style="text-align: right;"><?php echo $resl->proforma_total_rate_amount; $proforma_total_rate_amount_total += $resl->proforma_total_rate_amount; ?></td>
                                <td style="text-align: right;"><?php echo $quantity; $quantity_total += $quantity; ?></td>
                                <td style="text-align: right;"><?php echo $invoice_amount; $invoice_amount_total += $invoice_amount ?></td>
                                <td style="text-align: right;"><?php echo ($resl->co_quantity - $quantity); $qnty_balance_total += ($resl->co_quantity - $quantity); ?></td>
                                <td style="text-align: right;">
                                    <?php 
                                        if(($resl->co_quantity == $quantity) and ($resl->proforma_total_rate_amount != $invoice_amount)){
                                            echo '<label style="background-color: green;padding: 1px 8px;font-weight:bold;color:#fff">0</label>';
                                            $outstanding_total += 0;     
                                        }else{
                                            echo ($resl->proforma_total_rate_amount - $invoice_amount); 
                                            $outstanding_total += ($resl->proforma_total_rate_amount - $invoice_amount);     
                                        }
                                        
                                    ?>
                                </td>
                            </tr>
                            
                            
                            
                            <?php  if (end($keys) == $curr_key)
    {  ?>
                    <tr>
                        <th colspan="3">Total For <?= $groups[$resl->user_dept]['department'] ?> </th>
                        <th style="text-align: right;"><?= $co_quantity_total ?></th>
                        <th style="text-align: right;"><?= $proforma_total_rate_amount_total ?></th>
                        <th style="text-align: right;"><?= $quantity_total ?></th>
                        <th style="text-align: right;"><?= $invoice_amount_total ?></th>
                        <th style="text-align: right;"><?= $qnty_balance_total ?></th>
                        <th style="text-align: right;"><?= $outstanding_total ?></th>
                    </tr>
                    <?php
                    $quantity_total = 0;
                    $invoice_amount_total = 0;
                    $qnty_balance_total = 0;
                    $outstanding_total = 0;
                    $co_quantity_total = 0;
                    $proforma_total_rate_amount_total = 0;
    } ?>
                            
                            
                            
                            
                            
                        <?php }
                    }
                    
                    
                    ?>
                    
                    
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>

<?php if ($segment == 'bonus_sheet_report_register')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
	    <style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;
                text-align: left;
                font-size: 14px;
            }
            
            tr {
                height: 60px;
            }

		</style>
		<body class="A4 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto; padding-top: 2mm; padding-bottom: 2mm; padding-left: 1mm; padding-right: 1mm;">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font"> BONUS SHEET </h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
									    <?php if($d_id == 5) { ?>
                <tr>
                                    <th colspan="4">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="13">
                                        Year: <?= date('Y') . ' - ' . (date('Y') + 1) ?> <br />
                                        Department: <?= $departments_lists ?> <br />
                                        Bonus: 20%<br />
                                    </th>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <th colspan="4">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="13">
                                        Year:  <?= date('Y') . ' - ' . (date('Y') + 1) ?> <br />
                                        Department: <?= $departments_lists ?> <br />
                                        Bonus: 20%<br />
                                    </th>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>Sl <br/> No</th>
                                    <th>Name</th>
                                    <?php if($d_id == 5) { ?>
                                    <th style="text-align: right;">April</th>
                                    <th style="text-align: right;">May</th>
                                    <th style="text-align: right;">June</th>
                                    <th style="text-align: right;">July</th>
                                    <th style="text-align: right;">August</th>
                                    <th style="text-align: right;">September</th>
                                    <th style="text-align: right;">October</th>
                                    <th style="text-align: right;">November</th>
                                    <th style="text-align: right;">December</th>
                                    <th style="text-align: right;">January</th>
                                    <th style="text-align: right;">February</th>
                                    <th style="text-align: right;">March</th>
                                    <th style="text-align: right;">Total</th>
                                    <th style="text-align: right;">Bonus</th>
                                    <?php } else { ?>
                                    <th style="text-align: right;">Ex gratia</th>
                                    <?php } ?>
                                    <th>Signature</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
                            
                            $total_salary = 0;
                            $iter = 1;
                            $grand_total=0;
                            $grand_bonus = 0;
                            
    if (count($result) > 0)
    {
        foreach ($result as $res)
        {
            
            $total_april = 0;
            $total_may = 0;
            $total_june = 0; 
            $total_july = 0;
            $total_august = 0;
            $total_september = 0;
            $total_october = 0; 
            $total_november = 0;
            $total_december = 0;
            $total_january = 0;
            $total_february = 0;
            $total_march = 0;
            foreach ($res as $key=>$a)
            {
                
?>
                                    <tr>
                                        <td style=""><?=$iter++?></td>
                                        <td style=><?=$a['name']?></td>
                                        <?php if($d_id == 5) { ?>
                                        <td><?php if(isset($a['April~30~4'])) {echo $a['April~30~4']; $total_april = $a['April~30~4'];  } ?></td>
                                        <td><?php if(isset($a['May~31~5'])) {echo $a['May~31~5']; $total_may = $a['May~31~5']; } ?></td>
                                        <td><?php if(isset($a['June~30~6'])) {echo $a['June~30~6']; $total_june = $a['June~30~6']; } ?></td>
                                        <td><?php if(isset($a['July~31~7'])) {echo $a['July~31~7']; $total_july = $a['July~31~7']; } ?></td>
                                        <td><?php if(isset($a['August~31~8'])) {echo $a['August~31~8']; $total_august = $a['August~31~8']; } ?></td>
                                        <td><?php if(isset($a['September~30~9'])) {echo $a['September~30~9']; $total_september = $a['September~30~9']; } ?></td>
                                        <td><?php if(isset($a['October~31~10'])) {echo $a['October~31~10']; $total_october = $a['October~31~10']; } ?></td>
                                        <td><?php if(isset($a['November~30~11'])) {echo $a['November~30~11']; $total_november = $a['November~30~11']; } ?></td>
                                        <td><?php if(isset($a['December~31~12'])) {echo $a['December~31~12']; $total_december = $a['December~31~12']; } ?></td>
                                        <td><?php if(isset($a['January~31~1'])) {echo $a['January~31~1']; $total_january = $a['January~31~1']; } ?></td>
                                        <td><?php if(isset($a['February~28~2'])) {echo $a['February~28~2']; $total_february = $a['February~28~2']; } ?></td>
                                        <td><?php if(isset($a['March~31~3'])) {echo $a['March~31~3']; $total_march = $a['March~31~3']; } ?></td>
                                        <td>
                                            <?php 
                                                echo $all_total = $total_april + $total_may + $total_june + $total_july + $total_august + $total_september + $total_october + $total_november + $total_december + $total_january + $total_february + $total_march;
                                                $grand_total += $all_total;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $all_bonus = round(($total_april + $total_may + $total_june + $total_july + $total_august + $total_september + $total_october + $total_november + $total_december + $total_january + $total_february + $total_march) * 20/100);
                                                $grand_bonus += $all_bonus;
                                            ?></td>
                                        <?php } else { ?>
                                        <td><?php echo $a['TOTAL1'] ?></td>
                                        <?php } ?>
                                        <td></td>
                                    </tr>
                                    
                                    <?php

             }
             
             $total_salary = 0;
             
        }
    }
    
?>
                            <tr>
                                <th colspan="14">Total</th>
                                <th><?=$grand_total?></th>
                                <th><?=$grand_bonus?></th>
                            </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php if ($segment == 'checking_stock_summary_status')
{
    // echo '<pre>',print_r($result),'</pre>';
    $temp_co_name_array1 = array();
    foreach ($result as $co_name)
    {
        if (!in_array($co_name['group_name'], $temp_co_name_array1))
        {
            array_push($temp_co_name_array1, $co_name['group_name']);
        }
    }
?>
		
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 13px;
         }
         
         
         @media print {
         .print-me {
             display: none;
         }
         }
         
         
		</style>
		
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 2px;">
		    
		    
		    <div class="text-center">
        <a id="dlink" style="display:none;"></a>
        <input type="button" onclick="tablesToExcel(array1, 'Sheet1', 'SOPL-<?=mt_rand()?>.xls')" value="Export to Excel" class="btn btn-success print-me" >
    </div>
		    
		    
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
		    
		    
		    <?php 
		    
		    
		    $table_no=1;
		    
		    
		    ?>
		    
		    
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">Stock Summary Details</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
					  <b><?=implode(', ', $temp_co_name_array1) ?></b>
					  <br/>
					  From <b><?=date("d-m-Y", strtotime($from)) ?></b> To <b><?=date("d-m-Y", strtotime($to)) ?></b>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="export_table_to_excel<?=$table_no?>" class="table table-bordered">
									<thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th rowspan="2" style="text-align:center">Item</th>
                            <th colspan="2" style="text-align:center">Opening Information</th>
                            <th colspan="2" style="text-align:center">Purchase Information</th>
                            <th colspan="2" style="text-align:center">Issue Information</th>
                            <th colspan="2" style="text-align:center">Plating Information</th>
                            <th colspan ="2" style="text-align:center">Stock In Information</th>
                            <th colspan ="2" style="text-align:center">Balance Information</th>
                            <th rowspan="2">Closing Rate</th>
                        </tr>
                        <tr>
                            <th style="display: none;"></th>
                            <th style="text-align:center">Opn Qnty</th>
                            <th style="text-align:center">Opn Val</th>
                            <th style="text-align:center">Pur Qnty</th>
                            <th style="text-align:center">Pur Val</th>
                            <th style="text-align:center">Issue Qnty</th>
                            <th style="text-align:center">Issue Val</th>
                            <th style="text-align:center">Plating Qnty</th>
                            <th style="text-align:center">Plating Val</th>
                            <th style="text-align:center">Stock In Qnty</th>
                            <th style="text-align:center">Stock In Val</th>
                            <th style="text-align:center">Bal Qnty</th>
                            <th style="text-align:center">Bal Val</th>
                        </tr>
                        </thead>
									<tbody>
										<?php
    $all_bal_qty = 0;
    $all_opn_qty = 0;
    $all_pur_qty = 0;
    $all_issue_qty = 0;
    $all_plating_qty = 0;
    $all_stockin_qty = 0;
    $all_bal_rate = 0;
    $all_opn_rate = 0;
    $all_pur_rate = 0;
    $all_issue_rate = 0;
    $all_plating_rate = 0;
    $all_stockin_rate = 0;
    $closing_rate = 0;
    foreach ($result as $f)
    {

        if ($f['opening_qnty'] == 0 && $f['purchase_qnty'] == 0 && $f['issue_qnty'] == 0)
        {
            continue;
        }

        $bal_qty = $f['opening_qnty'] + $f['purchase_qnty'] - ($f['issue_qnty'] + $f['plating_qnty']) + $f['stock_in_qnty'];
        $bal_rate = $f['opening_val'] + $f['purchase_val'] - ($f['issue_val'] + $f['plating_val']) + $f['stock_in_val'];

        $all_opn_qty += $f['opening_qnty'];
        $all_opn_rate += $f['opening_val'];
        $all_pur_qty += $f['purchase_qnty'];
        $all_pur_rate += $f['purchase_val'];
        $all_issue_qty += $f['issue_qnty'];
        $all_issue_rate += $f['issue_val'];
        $all_plating_qty += $f['plating_qnty'];
        $all_plating_rate += $f['plating_val'];
        $all_stockin_qty += $f['stock_in_qnty'];
        $all_stockin_rate += $f['stock_in_val'];
        $all_bal_qty += $bal_qty;
        $all_bal_rate += $bal_rate;
?>
                            <tr>
                                <th style="display: none;"><?= $f['id_id'] ?></th>
                                <th><?=$f['item'] . '(' . $f['color'] . ')' ?></th>
                                <td style="text-align:right"><?=number_format($f['opening_qnty'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['opening_val'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['purchase_qnty'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['purchase_val'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['issue_qnty'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['issue_val'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['plating_qnty'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['plating_val'], 2) ?></td>
                                <td style="text-align:right"><?= number_format($f['stock_in_qnty'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($f['stock_in_val'], 2) ?></td>
                                <td style="text-align:right"><?=number_format($bal_qty, 2, '.', '')?></td>
                                <td style="text-align:right"><?=number_format($bal_rate, 2) ?></td>
                                <?php if ($bal_qty != 0)
        {
            $closing_rate += ($bal_rate / $bal_qty);
?>
                                <td style="text-align:right"><?=number_format(($bal_rate / $bal_qty), 2, '.', '')?></td>
                            <?php
        }
        else
        {
            $closing_rate += 0;
?>
                                <td style="text-align:right">0</td>
                            <?php
        } ?>
                            </tr>
                            <?php
    }
?>
                        <tr>
                            
                            
                            <th style="display: none;"></th>
                            
                            
                        	<th>Total</th>
                        	<td style="text-align:right"><?=number_format($all_opn_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_opn_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_pur_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_pur_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_issue_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_issue_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_plating_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_plating_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_stockin_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_stockin_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_bal_qty, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($all_bal_rate, 2) ?></td>
                        	<td style="text-align:right"><?=number_format($closing_rate, 2) ?></td>
                        </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php if ($segment == 'ot_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
	<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 14px;
}
		</style>
		<body class="A4 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto; padding-top: 2mm; padding-bottom: 2mm; padding-left: 1mm; padding-right: 1mm;">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">OVERTIME DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                    <th colspan="4">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="3">
                                        Month: <?=$mont ?><br />
                                        Date: <?=date('d-m-Y') ?><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th>SL <br/> NO</th>
                                    <th>NAME</th>
                                    <th style="text-align: right;">OT. <br/> RATE</th>
                                    <th style="text-align: right;">OT. <br/> HOURS</th>
                                    <th style="text-align: right;">OT. <br/> Total</th>
                                    <th style="text-align: right;">FACT <br/> ACT <br/> OT <br/> Hrs. <br/> MAX</th>
                                    <th style="text-align: right;">BALANCE</th>
                                    <th style="text-align: right;">FACTORY OT.</th>
                                    <th style="text-align: right;">PROD. <br/> BONUS</th>
                                    <th style="text-align: right;">TOTAL</th>
                                    <th style="text-align: right;">ESI <br/> DEDUCT</th>
                                    <th style="text-align: right;">OTHRS/ <br/> ADVNC</th>
                                    <th style="text-align: right;">TOTAL <br/> DEDUCT.</th>
                                    <th style="text-align: right;">NET PAY</th>
                                    <th>SIGNATURE</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $ot_rate = 0;
    $ot_hours = 0;
    $ot_total = 0;
    $factory_act_ot_hrs_max = 0;
    $balance_ot_hrs = 0;
    $factory_ot = 0;
    $p_bonus = 0;
    $bonus = 0;
    $with_bonus_amnt = 0;
    $esi = 0;
    $advance = 0;
    $deduction_total = 0;
    $net_pay = 0;
    if (count($result) > 0)
    {
        foreach ($result as $res)
        {
            foreach ($res as $a)
            {
?>
                                    <tr>
                                        <td style="width: 20px;"><?=$iter++
?></td>
                                        <td style="width: 140px;"><?=$a->name
?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_rate;
                $ot_rate += $a->ot_rate; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_hours;
                $ot_hours += $a->ot_hours; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->ot_total) , 2);
                $ot_total += round($a->ot_total); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->factory_act_ot_hrs_max;
                $factory_act_ot_hrs_max += $a->factory_act_ot_hrs_max; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php if ($a->balance_ot_hrs > 0)
                {
                    echo $a->balance_ot_hrs;
                    $balance_ot_hrs += $a->balance_ot_hrs;
                }
                else
                {
                    echo 0;
                    $balance_ot_hrs += 0;
                } ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->factory_ot) , 2);
                $factory_ot += round($a->factory_ot); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php $p_bonus = (round($a->ot_total) - round($a->factory_ot));
                echo number_format(round($p_bonus) , 2);
                $bonus += round($p_bonus); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->with_bonus_amnt) , 2);
                $with_bonus_amnt += round($a->with_bonus_amnt) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->esi) , 2);
                $esi += round($a->esi) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->advance) , 2);
                $advance += round($a->advance) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->deduction_total) , 2);
                $deduction_total += round($a->deduction_total); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php $new_payable = (round($a->with_bonus_amnt) - round($a->deduction_total)); echo number_format(round($new_payable) , 2);
                $net_pay += round($new_payable); ?></td>
                                        <td style="height: 50px;"></td>
                                    </tr>
                                    <?php
            }
        }
    }
?>
                                <tr>
                                        <th colspan="2">Grand Total</th>
                                        <td style="text-align: right;"><?=$ot_rate
?></td>
                                        <td style="text-align: right;"><?=$ot_hours
?></td>
                                        <td style="text-align: right;"><?=number_format(round($ot_total) , 2) ?></td>
                                        <td style="text-align: right;"><?=$factory_act_ot_hrs_max ?></td>
                                        <td style="text-align: right;"><?=$balance_ot_hrs ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($factory_ot) , 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($bonus) , 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($with_bonus_amnt), 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($esi, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($advance, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($deduction_total, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($net_pay, 2); ?></td>
                                        <td></td>
                                    </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>

<?php if ($segment == 'salary_overtime_details')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
	<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    text-align: left;
    font-size: 14px;
}
		</style>
		<body class="A4 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto; padding-top: 2mm; padding-bottom: 2mm; padding-left: 1mm; padding-right: 1mm;">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
					<h3 class="mar_0 head_font">SALARY - OVERTIME DETAILS</h3>
				</div>
				<div class="row mar_bot_3">
					<div class="col-sm-6 border_all header_left">
						<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
						<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
					</div>
					<div class="col-sm-6 border_all header_right">
						<br />
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered">
									<thead>
                <tr>
                                    <th colspan="4">SHILPA OVERSEAS PVT. LTD. <br /> 51, Mahanirban Road, Kolkata-700029</th>
                                    <th colspan="3">
                                        Month: <?=$mont ?><br />
                                        Date: <?=date('d-m-Y') ?><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th>SL <br/> NO</th>
                                    <th>NAME</th>
                                    <th style="text-align: right;">OT. <br/> RATE</th>
                                    <th style="text-align: right;">OT. <br/> HOURS</th>
                                    <th style="text-align: right;">OT. <br/> Total</th>
                                    <th style="text-align: right;">FACT <br/> ACT <br/> OT <br/> Hrs. <br/> MAX</th>
                                    <th style="text-align: right;">BALANCE</th>
                                    <th style="text-align: right;">FACTORY OT.</th>
                                    <th style="text-align: right;">PROD. <br/> BONUS</th>
                                    <th style="text-align: right;">TOTAL</th>
                                    <th style="text-align: right;">ESI <br/> DEDUCT</th>
                                    <th style="text-align: right;">OTHRS/ <br/> ADVNC</th>
                                    <th style="text-align: right;">TOTAL <br/> DEDUCT.</th>
                                    <th style="text-align: right;">NET PAY</th>
                                    <th style="text-align: right;">SALARY</th>
                                    <th style="text-align: right;">GRAND TOTAL</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
    $iter = 1;
    $ot_rate = 0;
    $ot_hours = 0;
    $ot_total = 0;
    $factory_act_ot_hrs_max = 0;
    $balance_ot_hrs = 0;
    $factory_ot = 0;
    $p_bonus = 0;
    $bonus = 0;
    $with_bonus_amnt = 0;
    $esi = 0;
    $advance = 0;
    $grand_total = 0;
    $net_salary_pay = 0;
    $deduction_total = 0;
    $net_pay = 0;
    if (count($result) > 0)
    {
        foreach ($result as $res)
        {
            foreach ($res as $a)
            {
?>
                                    <tr>
                                        <td style="width: 20px;"><?=$iter++
?></td>
                                        <td style="width: 140px;"><?=$a->name
?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_rate;
                $ot_rate += $a->ot_rate; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_hours;
                $ot_hours += $a->ot_hours; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->ot_total) , 2);
                $ot_total += round($a->ot_total); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->factory_act_ot_hrs_max;
                $factory_act_ot_hrs_max += $a->factory_act_ot_hrs_max; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php if ($a->balance_ot_hrs > 0)
                {
                    echo $a->balance_ot_hrs;
                    $balance_ot_hrs += $a->balance_ot_hrs;
                }
                else
                {
                    echo 0;
                    $balance_ot_hrs += 0;
                } ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->factory_ot) , 2);
                $factory_ot += round($a->factory_ot); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php $p_bonus = (round($a->ot_total) - round($a->factory_ot));
                echo number_format(round($p_bonus) , 2);
                $bonus += round($p_bonus); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->with_bonus_amnt) , 2);
                $with_bonus_amnt += round($a->with_bonus_amnt) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->esi) , 2);
                $esi += round($a->esi) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->advance) , 2);
                $advance += round($a->advance) ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->deduction_total) , 2);
                $deduction_total += round($a->deduction_total); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php $new_payable = (round($a->with_bonus_amnt) - round($a->deduction_total)); echo number_format(round($new_payable) , 2);
                $net_pay += round($new_payable); ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format($a->NET, 2); $net_salary_pay += $a->NET;  ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(($a->NET + $new_payable), 2); $grand_total += ($a->NET + $new_payable) ?></td>
                                    </tr>
                                    <?php
            }
        }
    }
?>
                                <tr>
                                        <th colspan="2">Grand Total</th>
                                        <td style="text-align: right;"><?=$ot_rate
?></td>
                                        <td style="text-align: right;"><?=$ot_hours
?></td>
                                        <td style="text-align: right;"><?=number_format(round($ot_total) , 2) ?></td>
                                        <td style="text-align: right;"><?=$factory_act_ot_hrs_max ?></td>
                                        <td style="text-align: right;"><?=$balance_ot_hrs ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($factory_ot) , 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($bonus) , 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($with_bonus_amnt), 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($esi, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($advance, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($deduction_total, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($net_pay, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($net_salary_pay, 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($grand_total, 2); ?></td>
                                    </tr>
                            
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
	</body>
		<?php
} ?>
	
	<?php if ($segment == 'emp_pay_slip_section')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    text-align: left;
    font-size: 12px;
}
body.A3.landscape .sheet {
    width: 430mm;
}
		</style>
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 20px">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto; padding-top: 2mm; padding-bottom: 2mm; padding-left: 1mm; padding-right: 1mm;">
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<?php if (isset($resultss))
    {
        $it = 1;
        $new_i = 3;
        $total_loan = 0;
        $total_advance = 0;
        foreach ($resultss as $results)
        {
            foreach ($results as $result)
            {
                if ($it == 3 or $new_i == $it)
                {
                    $new_i = $it + 2;
?>
			</div>
	</section>
</div>
</body>
<body class="A3 landscape" style="overflow-x: auto; padding-top: 2px;">
        <div id="page-content">
		<section class="sheet" style="height: auto; padding-top: 1mm; padding-bottom: 2mm; padding-left: 1mm; padding-right: 1mm;"/>
		<div>
			<!--<header class="pull-right">-->
			<!--    <small>Page No. </small>-->
			<!--</header>-->
			<div class="clearfix"></div>
			<?php
                } ?>
			<div class="container" style="margin-top: 8px;"/>
				<div class="row mar_bot_3" style="width: 400mm; margin-left: 23px;">
					<div class="col-sm-12 border_all text-center">
						<h4 class="mar_0">SHILPA OVERSEAS PVT. LTD.</h4>
						<h4 class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</h4>
						<h4 class="mar_0">
						    PAY SLIP FOR THE MONTH OF 
						    <?php $Array_sal = explode('~', $month); ?>
						    <?=$Array_sal[0] ?> - 
			    <?php 
				$month_new = $month;
                $wordArray = explode('~', $month);
                // print_r($wordArray);
                if($wordArray[2] < 4) {
                ?>
                <?=YEAR_END?>
                <?php } else { ?>
                <?=YEAR_START?>
                <?php } ?>

						    </h4>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered" style="width: 400mm; margin-left: 40px;">
							    <tbody>
                                <tr>
                                    <th style="text-align: center;"><b>NAME OF EMPLOYEE- এমপলয়ী নাম</b></th>
                                    <th colspan="2" style="text-align: center;">RATE OF SALARY <br/> স্যালারি রেট </th>
                                    <th colspan="7" style="text-align: center;">SALARY EARNED - স্যালারি </th>
                                    <th rowspan="2" style="text-align: center;">NET PAY <br/> নেট পে </th>
                                    <th rowspan="3" style="text-align: center;">
                                        SIGNATURE OF THE <br/> সাক্ষর  <br/> EMPLOYERS <br/> 
                                        (WITH OFFICE SEAL)
                                    </th>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 16px;"><b><?=$result->name
?></b></td>
                                    <td style="text-align: center;"><b>BASIC - বেসিক </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->BASIC, 2) ?></b></td>
                                    <td style="text-align: center;">BASIC  বেসিক </td>
                                    <td style="text-align: center;">CONV  <br/> কনভেয়ানস </td>
                                    <td style="text-align: center;">EDU ALLOW  <br/> শিক্ষা ভাতা </td>
                                    <td style="text-align: center;">EPF SALARY <br/> পি এফ বেতন </td>
                                    <td style="text-align: center;">HRA <br/> এইচ আর এ </td>
                                    <td style="text-align: center;">OTHERS/ARREAR <br/> সেপশাল আলে্যনস </td>
                                    <td style="text-align: center;">GROSS TOTAL <br/> গ্রস পে </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">FPF UAN - ইউ এ এন </td>
                                    <td style="text-align: center;"><b>DA <br/> ডি এ </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->DA, 2) ?></b></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->BASIC, 2) ?></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->CONV, 2) ?></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->OA, 2) ?></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->PFAMT, 2) ?></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->HRA, 2) ?></td>
                                    <td></td>
                                    <td style="text-align: center; font-size: 15px;"><b<?=number_format($result->GROSS, 2) ?></td>
                                    <td rowspan="3" style="text-align: center; font-size: 15px;"><b><?=number_format($result->NET, 2) ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align: center;"><b> CONVENCE <br/> কনভেয়ানস </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->CONV, 2) ?></b></td>
                                    <td rowspan="2" style="text-align: center;"><b>DEDUCTION - <br/> ডিডাকশন </b></td>
                                    <td style="text-align: center;">EPF - পি এফ </td>
                                    <td style="text-align: center;">ESI - ই এস আই </td>
                                    <td style="text-align: center;">P.TAX <br/> পি ট্যাকস </td>
                                    <td style="text-align: center;">ADVANCE <br/> অ্যাডভানস </td>
                                    <td style="text-align: center;">OTHERS <br/> অন্যান্য </td>
                                    <td style="text-align: center;">TOTAL <br/> মোট </td>
                                    <td rowspan="6"><img src="<?=base_url('assets/admin_panel/img/profile_img/shilpa_stamp1.png') ?>" style="height: 290px; width: 98px;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">ESI INSURANCE NO ই এস আই স৴খ্যা </td>
                                    <td style="text-align: center;"><b>EPF <br/> SALARY - পি <br/>  এফ বেতন </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->PFAMT, 2) ?></b></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->PFAMT, 2) ?> </td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->ESIAMT, 2) ?> </td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->TAX, 2) ?> </td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->LOAN, 2) ?> </td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->INS, 2) ?> </td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->DEDUC, 2) ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><?=$result->esi_acc_no ?></td>
                                    <td style="text-align: center;"><b>HRA <br/> এইচআরএ </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->HRA, 2) ?></b></td>
                                    <td rowspan="4"></td>
                                    <td colspan="6" style="text-align: center;"><b>EMPLOYER CONTRIBUTION</b></td>
                                    <td rowspan="4"></td>
                                </tr>
                                <tr>
                                    <td rowspan="3"></td>
                                    <td style="text-align: center;"><b>GROSS <br/> SALARY <br/> মোট বেতন </b></td>
                                    <td style="text-align: center; font-size: 15px;"><b><?=number_format($result->GROSS, 2) ?></b></td>
                                    <td style="text-align: center;">EPF</td>
                                    <td style="text-align: center;">PENSION</td>
                                    <td style="text-align: center;">ESI</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center;"><b>TOTAL <br/> মোট </b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><b>MONTH <br/> DAYS <br/> দিন </b></td>
                                    <td style="text-align: center;"><b>SALARY <br/> PAID <br/> এফেকটিফ <br/> ডেস ফর <br/> স্যালারি </b></td>
                                    <td style="text-align: center; font-size: 15px;"><?=number_format($result->PFAMT, 2) ?></td>
                                    <td rowspan="2"></td>
                                    <td rowspan="2"></td>
                                    <td rowspan="2"></td>
                                    <td rowspan="2"></td>
                                    <td rowspan="2"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 15px;"><?=$result->T8 ?></td>
                                    <td style="text-align: center; font-size: 15px;"><?=$result->T2 ?></td>
                                </tr>
                                <tr>
                                    
                                    <?php $dates = array();
                $total_cl = 0;
                $total_el = 0;
                $total_esil = 0;
                $month_new = $month;
                $wordArray = explode('~', $month);
                
                if($wordArray[2] == 12) {
                $wordArray1 = 1;    
                } else {
                $wordArray1 = (1 + $wordArray[2]);
                }
                $mn = str_pad($wordArray1, 2, '0', STR_PAD_LEFT);
                
                if($wordArray[2] == 1) {
                    $wordArray_prev = 12;
                } else {
                 $wordArray_prev = ($wordArray[2] - 1);   
                }
                $mn_prev = str_pad($wordArray_prev, 2, '0', STR_PAD_LEFT);
                
                $current = strtotime(YEAR_START_DATE);
                
                if($wordArray[2] < 4 || $wordArray[2] == 12) {
                   $date2 = strtotime(YEAR_END . '-' . $mn . '-01'); 
                } else {
                  $date2 = strtotime(YEAR_START . '-' . $mn . '-01');  
                }
                
                if($wordArray[2] == 1) {
                    $date_prev = strtotime(YEAR_START . '-' . $mn_prev . '-01');
                }else if($wordArray[2] < 4) {
                    $date_prev = strtotime(YEAR_END . '-' . $mn_prev . '-01');     
                } else {
                    $date_prev = strtotime(YEAR_START . '-' . $mn_prev . '-01');    
                }
                
                $stepVal = '+1 month';
                
                while ($current < $date2)
                {
                    $dates[] = date('M', $current);
                    $dates1[] = date('m', $current);
                    $current = strtotime($stepVal, $current);
                }
                
                while ($current <= $date_prev)
                {
                    $dates_prev[] = date('M', $current);
                    $current = strtotime($stepVal, $current);
                }
?>
                                    <?php foreach ($dates as $d)
                {
                    $sql = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T4,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $result->e_id . "'
            ORDER BY employees.e_code";
                    $salary_details = $this
                        ->db
                        ->query($sql)->row();
                    if (count($salary_details) > 0)
                    {
                        $total_cl += $salary_details->T4;
                        $total_el += $salary_details->T5;
                    }
                    else
                    {
                        $total_cl += 0;
                        $total_el += 0;
                    }
                }
                $sqll = "SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T4,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $month_new . "%' AND employees.e_id='" . $result->e_id . "'
            ORDER BY employees.e_code";
                $this_month_value = $this
                    ->db
                    ->query($sqll)->row();
?>
                                    
                                    <td colspan="2" style="text-align: center;"><b>LEAVE TOTAL DUE লিভ ডিউ </b></td>
                                    <?php if ($result->el_granted == 0)
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b><?=($this_month_value->T4 + ($result->cl_granted - $total_cl)) ?></b></td>
                                    <?php
                }
                else
                {
?>
                                    <td style="text-align: center; font-size: 16px;"><b><?php echo ($this_month_value->T4 + ($result->cl_granted - $total_cl)) . ' + ' . ($this_month_value->T5 + ($result->el_granted - $total_el)); ?></b></td>
                                    <?php
                } ?>
                                    <td style="text-align: center;"><b>LEAVE ALLOW <br/>  লিভ অলোয়াড </b></td>
                                    <?php if ($result->el_granted == 0)
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b><?=$this_month_value->T4
?></b></td>
                                    <?php
                }
                else
                {
?>
                                    <td style="text-align: center; font-size: 16px;"><b><?php echo $this_month_value->T4 . ' + ' . $this_month_value->T5; ?></b></td>
                                    <?php
                } ?>
                                    
                            		
                            		<?php if ($result->el_granted == 0)
                { ?>	
                                    <td style="text-align: center;"><b>LEAVE BALANCE(cl) <br/> লিভ ব্যালানস</td>
                                    <td style="text-align: center; font-size: 16px;"><b><?=($result->cl_granted - $total_cl) ?></b></td>
                                    <?php
                }
                else
                {
?>
                                    <td style="text-align: center;"><b>LEAVE BALANCE(cl+el) <br/> লিভ ব্যালানস</td>
                                    <td style="text-align: center; font-size: 16px;"><b><?php echo ($result->cl_granted - $total_cl) . ' + ' . ($result->el_granted - $total_el); ?></b></td>
                                    <?php
                } ?>
                                    <?php
                $month_new_sal = $month;
                //month from user input
                $array_sal = explode('~', $month);
                $array1_sal = (1 + $array_sal[2]);
                $mn_sal = str_pad($array1_sal, 2, '0', STR_PAD_LEFT);
                
                
                $current_sal = strtotime(YEAR_START_DATE);
                $dates_sal = array();
                $dates1_sal = array();
                //$date2 = strtotime('2023-03-01');
                
                //if jan-apr then current year else previous year
                if($array_sal[2] < 4 || $array_sal[2] == 12) {
                   $date2_sal = strtotime(YEAR_END . '-' . $mn . '-01'); 
                } else {
                  $date2_sal = strtotime(YEAR_START . '-' . $mn . '-01');  
                }
                

                $stepVal_sal = '+1 month';
                while ($current_sal < $date2_sal)
                {
                    //only month
                    $dates_sal[] = date('M', $current_sal);
                    //year-month
                    $dates1_sal[] = date('Y-m', $current_sal);
                    $current_sal = strtotime($stepVal_sal, $current_sal);
                }
                
                foreach ($dates_sal as $d)
                {
                    $sql = "SELECT employees.name,e_code,employees.pf_acc_no, salary.LOAN, employees.esi_acc_no,salary.T4,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '" . $d . "%' AND employees.e_id='" . $result->EMPCODE . "'
            ORDER BY employees.e_code";
                    $salary_details = $this
                        ->db
                        ->query($sql)->row();
                    if (count($salary_details) > 0)
                    {
                        $total_loan += $salary_details->LOAN;
                    }
                    else
                    {
                        $total_loan += 0;
                    }
                }

                foreach ($dates1_sal as $d)
                {
                    $new_sql = "SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
                    FROM advance
                    INNER JOIN(employees)
                    ON(advance.emp_id=employees.e_id)
                    WHERE advance.emp_id ='" . $result->EMPCODE . "' AND advance.date LIKE '" . $d . "%'
                    ORDER BY advance.date";
                    $salary_details_advn = $this
                        ->db
                        ->query($new_sql)->row();
                    
                    if (count($salary_details_advn) > 0)
                    {
                        $total_advance += $salary_details_advn->ADV;
                    }
                    else
                    {
                        $total_advance += 0;
                    }
                }

                $new_sql_advc = "SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id ='" . $result->EMPCODE . "'
        ORDER BY advance.date desc";
                $salary_details_advn_advc = $this
                    ->db
                    ->query($new_sql_advc)->row();

                if (count($salary_details_advn_advc) > 0)
                {
                    $salary_details_advn_advc_value = $salary_details_advn_advc->ADV;
                }
                else
                {
                    $salary_details_advn_advc_value = 0;
                }

                $total_loan_taken = $this
                    ->db
                    ->select_sum('LOAN')
                    ->get_where('salary', array(
                    'EMPCODE' => $result->EMPCODE
                ))
                    ->row()->LOAN;
                $total_advance_taken = $this
                    ->db
                    ->select_sum('amount')
                    ->get_where('advance', array(
                    'emp_id' => $result->EMPCODE
                ))
                    ->row()->amount;
?>
                                    <td colspan="2" style="text-align: center;"><b>TOTAL ADVANCE TAKEN <br/> মোট অ্যাডভানস </b></td>
                                    <?php if ($result->LOAN > 0)
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b><?=$salary_details_advn_advc_value
?></b></td>
                                    <?php
                }
                else
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b>0</b></td>
                                    <?php
                } ?>
                                    <td style="text-align: center;"><b>ADVANCE BALANCE <br/> অগ্রিম ব্যালানস </b></td>
                                    <?php if ($result->LOAN > 0)
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b><?= number_format(($total_advance - $total_loan) , 2) ?></b></td>
                                    <?php
                }
                else
                { ?>
                                    <td style="text-align: center; font-size: 16px;"><b>0</b></td>
                                    <?php
                } ?>
                                </tr>
                        </tbody>
            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php $it++;
                $total_loan = 0;
                $total_advance = 0;
            }
        }
    }
?>
		</div>
	</section>
</div>
</body>
		<?php
} ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
<script src="https://www.jqueryscript.net/demo/Export-Html-To-Word-Document-With-Images-Using-jQuery-Word-Export-Plugin/FileSaver.js" type="text/javascript"></script>
<script src="https://www.jqueryscript.net/demo/Export-Html-To-Word-Document-With-Images-Using-jQuery-Word-Export-Plugin/jquery.wordexport.js" type="text/javascript"></script>


<script type="text/javascript">
    
    function sortTable(table_id, sortColumn){
        var tableData = document.getElementById(table_id).getElementsByTagName('tbody').item(0);
        var rowData = tableData.getElementsByTagName('tr');            
        for(var i = 0; i < rowData.length - 1; i++){
            for(var j = 0; j < rowData.length - (i + 1); j++){
                if(Number(rowData.item(j).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, "")) < Number(rowData.item(j+1).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, ""))){
                    tableData.insertBefore(rowData.item(j+1),rowData.item(j));
                }
            }
        }
    }
    
    sortTable('ot_summary', 7);


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


</html>
