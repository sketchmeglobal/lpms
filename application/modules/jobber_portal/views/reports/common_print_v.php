<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<?php if($segment == 'leather_status' || $segment == 'leather_status_pending_orders') { ?>
		<?php if($segment == 'leather_status' || $segment == 'leather_status_pending_orders') { ?>
	<title>LEATHER STATUS</title>
	<?php } else { ?>
	<title>ITEM STATUS</title> 
	<?php } ?>
	<?php } else if($segment == 'leather_status_po') { ?>
		<?php if($segment == 'leather_status') { ?>
	<title>LEATHER STATUS</title>
	<?php } else { ?>
	<title>ITEM STATUS</title> 
	<?php } ?>
    <?php } else if($segment == 'checking_stock_summary_status') { ?>
    <title>STOCK SUMMARY STATUS</title>
    <?php } else if($segment == 'checking_stock_detail_ledger') { ?>
    <title>STOCK DETAIL LEDGER</title>
    <?php } else if($segment == 'outstanding_report') { ?>
    <title>OUTSTANDING REPORT</title>
    <?php } else if($segment == 'outstanding_report_groupwise') { ?>
    <title>OUTSTANDING REPORT</title>
    <?php } else if($segment == 'jobber_ledger_status_report') { ?>
    <title>JOBBER LEDGER</title>
    <?php } else if($segment == 'jobber_ledger_status_report_non_zero') { ?>
    <title>JOBBER LEDGER</title>
    <?php } else if($segment == 'checking_summary_status') { ?>
    <title>CHECKING SUMMARY STATUS</title>
    <?php } else if($segment == 'checking_entry_sheet_status') { ?>
    <title>CHECKING ENTRY SHEET</title>
    <?php } else if($segment == 'checking_stock_summary_status') { ?>
    <title>CHECKING STOCK SUMMARY</title>
    <?php } else if($segment == 'checking_stock_detail_ledger') { ?>
    <title>CHECKING STOCK DETAIL LEDGER</title>
    <?php } else if($segment == 'supplier_wise_item_position') { ?>
    <title>SUPPLIER WISE ITEM POSITION</title>
    <?php } else if($segment == 'supplier_purchase_ledger') { ?>
    <title>SUPPLIER PURCHASE LEDGER</title>
    <?php } else if($segment == 'supplier_wise_purchase_position') { ?>
    <title>SUPPLIER WISE PURCHASE POSITION</title>
    <?php } else if($segment == 'supplier_purchase_ledger_wo_zero') { ?>
    <title>SUPPLIER WISE PURCHASE POSITION</title>
    <?php } else if($segment == 'group_stock_summary') { ?>
    <title>GROUP STOCK SUMMARY</title>
    <?php } else if($segment == 'jobber_bill_summary') { ?>
    <title>JOBBER BILL SUMMARY</title>
    <?php } else if($segment == 'cutter_bill_summary') { ?>
    <title>CUTTER BILL SUMMARY</title>
    <?php } else if($segment == 'monthly_production_status') { ?>
    <title>MONTHLY PROCUCTION STATUS</title>
    <?php } else if($segment == 'fetch_production_register') { ?>
    <title>PRODUCTION REGISTER</title>
    <?php } else if($segment == 'outstanding_report') { ?>
    <title>OUTSTANDING REPORT</title>
    <?php } else if($segment == 'outstanding_report_groupwise') { ?>
    <title>OUTSTANDING REPORT</title>
    <?php } else if($segment == 'payroll_reports_advance_ledger') { ?>
    <title>PAYROLL ADVANCE LEDGER</title>
    <?php } else if($segment == 'payroll_reports_leave') { ?>
    <title>LEAVE REPORT</title>
    <?php } else if($segment == 'payroll_esi_pf') { ?>
    <title>ESI REPORT</title>
    <?php } else if($segment == 'payroll_register') { ?>
    <title>PAYROLL REGISTER</title>
    <?php } else if($segment == 'payroll_pf') { ?>
    <title>PF REPORT</title>
    <?php } else if($segment == 'ot_details') { ?>
    <title>OVERTIME REPORT</title>
    <?php } else if($segment == 'article_master_report_section') { ?>
    <title>ARTICLE MASTER REPORT</title>
    <?php } else if($segment == 'overtime_checking_entry_details') { ?>
    <title>OVERTIME CHECKING REPORT</title>
    <?php } else if($segment == 'purchase_order_rate_setup_details') { ?>
    <title>PURCHASE RATE DETAILS</title>
	<?php } else { ?>
    <title>ORDER STATUS</title>
	<?php } ?>
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
		        
		            @page { size: A4 }
		
		            @media print{
		                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid black!important;}
		                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
		                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
		                .text-center{text-align: center!important;}.text-right{text-align: right!important;}
		            }
		table.order-summary td {position: relative;}		            
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
	
	<?php if($segment == 'overtime_checking_entry_details'){
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
                                        <th style="text-align: right;">ARTICLE<br/>CHECKED</th>
                                        <th style="text-align: right;">PROD.<br/>RATE</th>
										</tr>
									</thead>
									<tbody>
										<?php 
                                         $total_normal_duty_hours = 0;
                                         $total_overtime_hours = 0;
                                         $total_duty_hours = 0;
                                         $total_article_checked = 0;
                                         $total_prod_rate = 0;
										foreach ($result as $res) {
										 $total_normal_duty_hours = 0;
                                         $total_overtime_hours = 0;
                                         $total_duty_hours = 0;
                                         $total_article_checked = 0;
                                         $total_prod_rate = 0;
                                         $iter = 0;
											?>
											<tr>
												<th colspan="7" style="text-align: center;"><?= $res->emp_name ?></th>
											</tr>
											<?php 
            $this->db->select('checking.*,checking_details.*, employees.name as emp_name')
                ->join('checking_details', 'checking_details.checking_id=checking.checking_id', 'left')
                    ->join('employees', 'checking.e_id=employees.e_id', 'left')
                    ->where('checking.e_id', $res->e_id);
                    if($from != '' or $to != '') {
                        $this->db->where('checking.checking_entry_date >=', $from)
                                ->where('checking.checking_entry_date <=', $to);
                    }
                    $result_details = $this->db->group_by('checking.checking_id')->get('checking')->result();                                
											 ?>

                    <?php foreach ($result_details as $r_d) { 
                        $timestamp = strtotime($r_d->checking_entry_date);
                        $show_num_row_value = $this->db
                    ->where('checking_details.checking_id', $r_d->checking_id)
                   ->get('checking_details')->num_rows();
                   if($show_num_row_value > 0) {
                   	$iter++;
                    	?>
                    	<tr>
                         <td style="text-align: center;"><?php echo date('d-m-Y', strtotime($r_d->checking_entry_date)); ?></td>
                         <td style="text-align: center;"><?php echo date("D", $timestamp); ?></td>
                         <td style="text-align: right; width: 12%;"> 8.5 <?php $total_normal_duty_hours += 8.5; ?></td>
                         <?php 
$extra_total_time = $this->db->select('SUM(checking_details.extra_time) as extra_time')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->group_by('checking_details.checking_id')
                    ->get('checking_details')->row();
                    if(count($extra_total_time) > 0) {
                          ?>
                           <td style="text-align: right; width: 12%;"><?php $extra_ime = $extra_total_time->extra_time; echo $extra_ime; $total_overtime_hours += $extra_ime; ?></td>
                      <?php } else { ?>
                           <td style="text-align: right; width: 12%;"><?php $extra_ime = 0; $total_overtime_hours += $extra_ime; ?></td>
                      <?php } ?>
                      <td style="text-align: right;"><?php $total_time =(8.5 + $extra_ime); echo $total_time; $total_duty_hours += $total_time; ?></td>
                      <?php 
$extra_total_qntty = $this->db->select('SUM(checking_details.checked_quantity) as checked_quantity')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->group_by('checking_details.checking_id')
                    ->get('checking_details')->row();
                    if(count($extra_total_time) > 0) {
                          ?>
                           <td style="text-align: right;"><?php $checked_qntty = $extra_total_qntty->checked_quantity; echo $checked_qntty; $total_article_checked += $checked_qntty; ?></td>
                      <?php } else { ?>
                           <td style="text-align: right;"><?php $checked_qntty = 0; $total_article_checked += 0; ?></td>
                      <?php } ?>
                      <td style="text-align: right;"><?php $total_rate = ($checked_qntty / $total_time); echo number_format($total_rate, 2); $total_prod_rate += $total_rate; ?></td>
                     </tr>
                    <?php } ?>
                    <?php } ?>

<tr style="background: #d4ecea;">
	<th colspan="2" style="text-align: center;">TOTAL</th>
	<td style="text-align: right;"><?= $total_normal_duty_hours ?></td>
	<td style="text-align: right;"><?= $total_overtime_hours ?></td>
	<td style="text-align: right;"><?= $total_duty_hours ?></td>
	<td style="text-align: right;"><?= $total_article_checked ?></td>
	<td style="text-align: right;"><?= number_format($total_prod_rate, 2) ?></td>
</tr>
<tr style="background: #445767; color: white;">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>AVG</td>
	<td style="text-align: right;"><?= number_format(($total_prod_rate/$iter), 2) ?></td>
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
                                        <th style="text-align: right;">PROD.<br/>RATE</th>
										</tr>
									</thead>
									<tbody>
										<?php 
                                         $total_normal_duty_hours = 0;
                                         $total_overtime_hours = 0;
                                         $total_duty_hours = 0;
                                         $total_article_checked = 0;
                                         $total_prod_rate = 0;
										foreach ($result as $res) {
										 $total_normal_duty_hours = 0;
                                         $total_overtime_hours = 0;
                                         $total_duty_hours = 0;
                                         $total_article_checked = 0;
                                         $total_prod_rate = 0;
                                         $iter = 0;
											?>
											<?php 
            $this->db->select('checking.*,checking_details.*, employees.name as emp_name')
                ->join('checking_details', 'checking_details.checking_id=checking.checking_id', 'left')
                    ->join('employees', 'checking.e_id=employees.e_id', 'left')
                    ->where('checking.e_id', $res->e_id);
                    if($from != '' or $to != '') {
                        $this->db->where('checking.checking_entry_date >=', $from)
                                ->where('checking.checking_entry_date <=', $to);
                    }
                    $result_details = $this->db->group_by('checking.checking_id')->get('checking')->result();                                
											 ?>

                    <?php foreach ($result_details as $r_d) { 
                        $timestamp = strtotime($r_d->checking_entry_date);
                        $show_num_row_value = $this->db
                    ->where('checking_details.checking_id', $r_d->checking_id)
                   ->get('checking_details')->num_rows();
                   if($show_num_row_value > 0) {
                   	$iter++;
                   	$total_normal_duty_hours += 8.5;
                    	?>
                    	<tr>
                         <?php 
$extra_total_time = $this->db->select('SUM(checking_details.extra_time) as extra_time')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->group_by('checking_details.checking_id')
                    ->get('checking_details')->row();
                    if(count($extra_total_time) > 0) {
                    	$extra_ime = $extra_total_time->extra_time;
                    	$total_overtime_hours += $extra_ime;
                          ?>
                      <?php } else { $extra_ime = 0; $total_overtime_hours += $extra_ime;?>
                      <?php } ?>
                      <?php $total_time =(8.5 + $extra_ime); $total_duty_hours += $total_time; ?>
                      <?php 
$extra_total_qntty = $this->db->select('SUM(checking_details.checked_quantity) as checked_quantity')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->group_by('checking_details.checking_id')
                    ->get('checking_details')->row();
                    if(count($extra_total_time) > 0) {
                    	$checked_qntty = $extra_total_qntty->checked_quantity; $total_article_checked += $checked_qntty;
                          ?>
                      <?php } else { $checked_qntty = 0; $total_article_checked += 0; ?>
                      <?php } ?>
                      <?php $total_rate = ($checked_qntty / $total_time); $total_prod_rate += $total_rate; ?>
                     </tr>
                    <?php } ?>
                    <?php } ?>

<tr>
	<th style="text-align: center;"><?= $res->emp_name ?></th>
	<td style="text-align: right;"><?= $total_normal_duty_hours ?></td>
	<td style="text-align: right;"><?= $total_overtime_hours ?></td>
	<td style="text-align: right;"><?= $total_duty_hours ?></td>
	<td style="text-align: right;"><?= $total_article_checked ?></td>
	<td style="text-align: right;"><?= number_format($total_prod_rate, 2) ?></td>
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
	
	<?php if($segment == 'leather_status_pending_orders'){
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
		<?php if($segment1 == 'leather_status' || $segment1 == 'leather_status_pending_orders') { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php } else { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php } ?>
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
										foreach ($result1 as $r) {
											?>
											<tr>
												<th><?= $r->item_name .' [' . $r->color .']' ?>
												
												<?php $another_item_row = $this->db->join('item_master', 'item_master.im_id = item_mapping.buyer_item_code', 'left')
                            ->join('colors', 'colors.c_id = item_mapping.buyer_item_color', 'left')
                            ->get_where('item_mapping', array('company_item_code' => $r->im_id, 'company_item_color' => $r->c_id))->row();
                            if(count($another_item_row) > 0) {
                                                        ?>
                            <p style="color: red; text-align: center; font-size: 14px;">**This item exist in item mapper as - 
                            <br/> <b><?= $another_item_row->item .' [' . $another_item_row->color .']' ?></b>**</p>
                                                    <?php } ?>
												
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
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this->db->query($order_query)->result();
        
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


        foreach($order_colour_res as $o_c_r) {
        	if($o_c_r->co_id == '') {
        		continue;
        	}
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                      total_table.*,
                      IFNULL(SUM(total_table.final_qnty),0) AS final_qnty_new,
                      IFNULL(SUM(total_table.final_cut_qnty),0) AS final_cut_qnty_new,
                      IFNULL(SUM(total_table.final_rcv_qnty),0) AS final_rcv_qnty_new,
                      (SUM(total_table.final_cut_qnty) - SUM(total_table.final_rcv_qnty)) AS final_quantity_details
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
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            )AS ord_table
    LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = ord_table.cod_id
    GROUP BY
   ord_table.cod_id) AS cut_is_table
   LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cut_is_table.cod_id
   GROUP BY
   cut_is_table.cod_id) AS total_table
   GROUP BY
    total_table.im_id,
    total_table.lc_id  
    ";
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
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty_new,
                    'final_cut_qnty'=>$res->final_cut_qnty_new,
                    'final_rcv_qnty'=>$res->final_rcv_qnty_new,
                    'combination_or_not'=>$res->combination_or_not
                );
                
                // echo $this->db->last_query()."<br/>";
        // $this->db->insert('temp_consumption', $arr);
        array_push($data_array, $arr);
                // echo '<pre>', print_r($data_array1), '</pre>'; die();

            } else {
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
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty,
                IFNULL(SUM(article_costing_details.quantity * cutting_issue_challan_details.cut_co_quantity ),0) AS final_cut_qnty,
                IFNULL(SUM(article_costing_details.quantity * cutting_received_challan_detail.receive_cut_quantity ),0) AS final_rcv_qnty
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
            LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = customer_order_dtl.cod_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

// echo $this->db->last_query()."<br/>";

foreach($result1 as $res) {
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
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty,
                    'final_cut_qnty'=>$res->final_cut_qnty,
                    'final_rcv_qnty'=>$res->final_rcv_qnty,
                    'combination_or_not'=>$res->combination_or_not
                );
        array_push($data_array1, $arr);
	}

            }
            }

    if(!empty($data_array1)) {
    	$this->db->empty_table('temp_leather_consumption');
    	// echo '<pre>', print_r($data_array1), '</pre>'; die();
    	foreach($data_array as $da) {
    	$this->db->insert('temp_leather_consumption', $da);
    }
    	$consumption_list = $this->db->get('temp_leather_consumption')->result();
        foreach($consumption_list as $d_a) {
        	foreach($data_array1 as $d_a1) {
        	    if($d_a->co_id == $d_a1['co_id'] && $d_a->lc_id == $d_a1['item_color_id']) {
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
        	    }
        	    
    $check_value = $this->db->get_where('temp_leather_consumption', array('co_id' => $d_a1['co_id'], 'lc_id' => $d_a1['item_color_id']))->num_rows();
        		if($check_value == 0) {
        			$consumption_list_check = $this->db->where(array('co_id'=> $d_a1['co_id'], 'item_color_id'=> $d_a1['item_color_id']))->get('temp_leather_consumption')->num_rows();
    if($consumption_list_check == 0) {
                		  //  array_push($new_data_array, $d_a1);
                     $this->db->insert('temp_leather_consumption', $d_a1);
                 } 
//                  else {
// $consumption_list_check1 = $this->db->where('item_color_id', $d_a1['item_color_id'])->get('temp_leather_consumption')->num_rows();
//                   if($consumption_list_check1 == 0) {
//                      $this->db->insert('temp_leather_consumption', $d_a1);
//                  }
//                  }
        		}
        	}
        }
     
    $get_consumption_list = $this->db->get('temp_leather_consumption')->result();
    foreach($get_consumption_list as $res) {
    	if($res->combination_or_not == 0) {
    		if($res->lc_id == $r->c_id) {
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
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty,
                    'final_cut_qnty'=>$res->final_cut_qnty,
                    'final_rcv_qnty'=>$res->final_rcv_qnty,
                    'combination_or_not'=>$res->combination_or_not
                );
        array_push($customer_order, $arr);
    } 
    	} else {
    	if($res->item_color_id == $r->c_id) {
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
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty,
                    'final_cut_qnty'=>$res->final_cut_qnty,
                    'final_rcv_qnty'=>$res->final_rcv_qnty,
                    'combination_or_not'=>$res->combination_or_not
                );
        array_push($customer_order, $arr);
    }	
    	}
    }
        
        } else {
        	foreach($data_array as $d_a) {
        		if($d_a['lc_id'] == $r->c_id) {
                     array_push($customer_order, $d_a);
        	}
        }
        }

           // echo '<pre>', print_r($data_array), '</pre>'; die();
      ?>
												
	 <?php
      if(count($customer_order) > 0) {
	  ?>										
      <td>
      	<?php 
        foreach($customer_order as $c_o) {
            if(($c_o['final_cut_qnty'] - $c_o['final_rcv_qnty']) > 0 or ($c_o['final_qnty'] - $c_o['final_cut_qnty']) > 0) {
        	echo $c_o['co_no']."<br/>";
      	 ?>
              <?php }} ?>
      </td>
  <?php } else { ?>
  	  <td></td>
  <?php } ?>
  <td style="text-align: right;">
      	<?= number_format($r->final_opn_qnty_for_leather_status, 2) ?>
      	<?php 
          $open_lth = $r->final_opn_qnty_for_leather_status."<br/>";
          $tot_open_lth += $open_lth;
      		  ?>
      </td>
      <?php
      if(count($customer_order) > 0) {
	  ?>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
        if(($c_o['final_cut_qnty'] - $c_o['final_rcv_qnty']) > 0 or ($c_o['final_qnty'] - $c_o['final_cut_qnty']) > 0) {		
                $order_quantity = $c_o['final_qnty'];
                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                 $cut_issue_quantity = $c_o['final_cut_qnty'];
            $order_peng = ($order_quantity - $cut_issue_quantity);
        	echo abs(round($order_peng, 2))."<br/>";
        	$order_pending += $order_peng;
        	$tot_order_pending += $order_peng;
        }
        }
      	 ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
         if(($c_o['final_cut_qnty'] - $c_o['final_rcv_qnty']) > 0 or ($c_o['final_qnty'] - $c_o['final_cut_qnty']) > 0) {
                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                 $cut_is_quantity = $c_o['final_cut_qnty'];
        	echo abs(round($cut_is_quantity, 2))."<br/>";
        	$issue_quantity += $cut_is_quantity;
        	$tot_issue_quantity += $cut_is_quantity;
         }
        }
      	 ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
        if(($c_o['final_cut_qnty'] - $c_o['final_rcv_qnty']) > 0 or ($c_o['final_qnty'] - $c_o['final_cut_qnty']) > 0) {
                $co_id = $c_o['co_id'];
                $im_id = $c_o['im_id'];
                $lc_id = $c_o['lc_id'];
                 $cut_rv_quantity = $c_o['final_rcv_qnty'];
        	echo abs(round($cut_rv_quantity, 2))."<br/>";
        	$receive_quantity += $cut_rv_quantity;
        	$tot_receive_quantity += $cut_rv_quantity;
        }
        }
      	 ?>
      </td>
  <?php } else { ?>
  	   <td></td>
  	   <td></td>
  	   <td></td>
  <?php } ?>
      <td style="text-align: right;">
      	<?php 
      	$opening_stock = $r->final_opening_stock;
        $sum_purchase_order = $r->final_pur_rcv_qnty;
        $sum_material_issue = $r->final_mat_issue_qnty;
        $sum_stock_in = $r->final_stock_in_qnty;

    $current_stock = ($opening_stock + $sum_purchase_order - $sum_material_issue + $sum_stock_in);
    
         echo number_format($current_stock, 2)."<br/>";
         $tot_current_stock += $current_stock;
      		  ?>
      </td>
      <td style="text-align: right;">
      	<?php
        $sum_purchase_order_issue = $r->final_pur_issue_qnty;
        $sum_supp_purchase_order_issue = $r->final_sup_pur_order_qnty;
        $po_pending = ($sum_purchase_order_issue + $sum_supp_purchase_order_issue - $sum_purchase_order);
        
        echo number_format($po_pending, 2)."<br/>";
        $tot_po_pending += $po_pending;    
      		  ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        $balance = $open_lth + $order_pending + $issue_quantity - $receive_quantity - $current_stock - $po_pending;

        echo number_format($balance, 2)."<br/>";
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
   <?php }
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

	<?php if($segment == 'item_status'){
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
		<?php if($segment1 == 'leather_status') { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php } else { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php } ?>
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
										foreach ($result1 as $r) {
											?>
											<tr>
												<th><?= $r->item_name .' [' . $r->color .']' ?></th>
	 <?php
      if(count($customer_order) > 0) {
	  ?>										
      <td>
      	<?php 
        foreach($customer_order as $c_o) {
        	if($c_o->im_id == $r->im_id && $c_o->color_id == $r->c_id) {
        	echo $c_o->co_no."<br/>";
        	}
      	 ?>
              <?php } ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
        	if($c_o->im_id == $r->im_id && $c_o->color_id == $r->c_id) {
        	   // echo '<pre>', print_r($c_o), '</pre>'; die();
        		$query = "SELECT
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
            LEFT JOIN colors ON item_dtl.c_id = colors.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $c_o->co_id AND item_master.`im_id` = $c_o->im_id
                AND item_dtl.`c_id` = $c_o->color_id AND customer_order.status = 1
            GROUP BY
               item_dtl.im_id, customer_order_dtl.lc_id";
                $order_quantity = $this->db->query($query)->row()->final_qnty;

            $query1 = "SELECT
    CUS_ORD.*,
    IFNULL(
        SUM(
           CUS_ORD.item_dtl_quantity * cutting_issue_challan_details.cut_co_quantity
        ),
        0
    ) AS final_cut_qnty
FROM
    (
    SELECT
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        article_master.am_id,
        colors.c_id,
        customer_order_dtl.lc_id,
        article_costing_details.quantity AS item_dtl_quantity
    FROM
        `customer_order`
    LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
    LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
    LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
    LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
    LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
    LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
    LEFT JOIN colors ON item_dtl.c_id = colors.c_id
    LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
    LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
    LEFT JOIN units ON item_groups.u_id = units.u_id
        WHERE
        item_dtl.`id_id` = $c_o->id_id
            GROUP BY
               item_dtl.id_id
) AS CUS_ORD
LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = CUS_ORD.cod_id AND cutting_issue_challan_details.am_id = CUS_ORD.am_id AND cutting_issue_challan_details.lc_id = CUS_ORD.lc_id
WHERE
        cutting_issue_challan_details.`co_id` = $c_o->co_id AND cutting_issue_challan_details.`am_id` = $c_o->am_id AND cutting_issue_challan_details.`lc_id` = $c_o->lc_id
        GROUP BY
        cutting_issue_challan_details.co_id, cutting_issue_challan_details.am_id, cutting_issue_challan_details.lc_id";
                 $cut_issue_quantity_row = $this->db->query($query1)->row();
                 if(count($cut_issue_quantity_row) > 0) {
                    $cut_issue_quantity = $cut_issue_quantity_row->final_cut_qnty;  
                 } else {
                   $cut_issue_quantity = 0;  
                 }
            $order_peng = ($order_quantity - $cut_issue_quantity);
        	echo round($order_peng, 2)."<br/>";
        	$order_pending += $order_peng;
        	$tot_order_pending += $order_peng;
        	}
        }
      	 ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
        	if($c_o->im_id == $r->im_id && $c_o->color_id == $r->c_id) {
            $query1 = "SELECT
    CUS_ORD.*,
    IFNULL(
        SUM(
           CUS_ORD.item_dtl_quantity * cutting_issue_challan_details.cut_co_quantity
        ),
        0
    ) AS final_cut_qnty
FROM
    (
    SELECT
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        article_master.am_id,
        colors.c_id,
        customer_order_dtl.lc_id,
        article_costing_details.quantity AS item_dtl_quantity
    FROM
        `customer_order`
    LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
    LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
    LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
    LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
    LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
    LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
    LEFT JOIN colors ON item_dtl.c_id = colors.c_id
    LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
    LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
    LEFT JOIN units ON item_groups.u_id = units.u_id
        WHERE
        item_dtl.`id_id` = $c_o->id_id
            GROUP BY
               item_dtl.id_id
) AS CUS_ORD
LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = CUS_ORD.cod_id AND cutting_issue_challan_details.am_id = CUS_ORD.am_id AND cutting_issue_challan_details.lc_id = CUS_ORD.lc_id
WHERE
        cutting_issue_challan_details.`co_id` = $c_o->co_id AND cutting_issue_challan_details.`am_id` = $c_o->am_id AND cutting_issue_challan_details.`lc_id` = $c_o->lc_id
        GROUP BY
        cutting_issue_challan_details.co_id, cutting_issue_challan_details.am_id, cutting_issue_challan_details.lc_id";
                 $cut_is_quantity_row = $this->db->query($query1)->row();
                 if(count($cut_is_quantity_row) > 0) {
                    $cut_is_quantity = $cut_is_quantity_row->final_cut_qnty;  
                 } else {
                   $cut_is_quantity = 0;  
                 }
        	echo round($cut_is_quantity, 2)."<br/>";
        	$issue_quantity += $cut_is_quantity;
        	$tot_issue_quantity += $cut_is_quantity; 
        	}
        }
      	 ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        foreach($customer_order as $c_o) {
        	if($c_o->im_id == $r->im_id && $c_o->color_id == $r->c_id) {
            $query1 = "
            SELECT
   CUS_ORD.*,
  IFNULL(SUM(CUS_ORD.item_dtl_quantity * cutting_received_challan_detail.receive_cut_quantity ),0) AS final_rcv_qnty
FROM
    (
    SELECT
        customer_order_dtl.cod_id,
        customer_order_dtl.co_id,
        article_master.am_id,
        colors.c_id,
        customer_order_dtl.lc_id,
        article_costing_details.quantity AS item_dtl_quantity
    FROM
        `customer_order`
    LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
    LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
    LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
    LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
    LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
    LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
    LEFT JOIN colors ON item_dtl.c_id = colors.c_id
    LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
    LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
    LEFT JOIN units ON item_groups.u_id = units.u_id
        WHERE
        item_dtl.`id_id` = $c_o->id_id
            GROUP BY
               item_dtl.id_id
) AS CUS_ORD
LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = CUS_ORD.cod_id AND cutting_received_challan_detail.am_id = CUS_ORD.am_id AND cutting_received_challan_detail.lc_id = CUS_ORD.lc_id
WHERE
        cutting_received_challan_detail.`co_id` = $c_o->co_id AND cutting_received_challan_detail.`am_id` = $c_o->am_id AND cutting_received_challan_detail.`lc_id` = $c_o->lc_id
        GROUP BY
        cutting_received_challan_detail.co_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.lc_id
        ";
                 $cut_rv_quantity_row = $this->db->query($query1)->row();
                 if(count($cut_rv_quantity_row) > 0) {
                    $cut_rv_quantity = $cut_rv_quantity_row->final_rcv_qnty;  
                 } else {
                   $cut_rv_quantity = 0;  
                 }
        	echo round($cut_rv_quantity, 2)."<br/>";
        	$receive_quantity += $cut_rv_quantity;
        	$tot_receive_quantity += $cut_rv_quantity;
        	}
        }
      	 ?>
      </td>
  <?php } else { ?>
  	   <td></td>
  	   <td></td>
  	   <td></td>
  	   <td></td>
  <?php } ?>
  <td style="text-align: center;"><?= $r->name ?></td>
      <td style="text-align: right;">
      	<?php 
      	$opening_stock = $r->final_opening_stock;
        $sum_purchase_order = $r->final_pur_rcv_qnty;
        $sum_material_issue = $r->final_mat_issue_qnty;
        $sum_stock_in = $r->final_stock_in_qnty;

    $current_stock = ($opening_stock + $sum_purchase_order - $sum_material_issue + $sum_stock_in);
    
         echo number_format($current_stock, 2)."<br/>";
         $tot_current_stock += $current_stock;
      		  ?>
      </td>
      <td style="text-align: right;">
      	<?php
        $sum_purchase_order_issue = $r->final_pur_issue_qnty;
        $sum_supp_purchase_order_issue = $r->final_sup_pur_order_qnty;
        $po_pending = ($sum_purchase_order_issue + $sum_supp_purchase_order_issue - $sum_purchase_order);
        
        echo number_format($po_pending, 2)."<br/>";
        $tot_po_pending += $po_pending;    
      		  ?>
      </td>
      <td style="text-align: right;">
      	<?php 
        $balance = $order_pending - $issue_quantity + $receive_quantity - $current_stock - $po_pending;

        echo number_format($balance, 2)."<br/>";
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
   <?php }
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
	
	<?php if($segment == 'leather_status_po'){
		?>
		<section class="sheet padding-5mm" style="height: auto">
		<div>
			<div class="clearfix"></div>
			<div class="container">
				<div class="row border_all text-center text-uppercase mar_bot_3">
		<?php if($segment1 == 'leather_status_po') { ?>
	    <h3 class="mar_0 head_font">Leather Status Details</h3>
	    <?php } else { ?>
	    <h3 class="mar_0 head_font">Item Status Details</h3> 
	    <?php } ?>
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
                                        if(count($result) > 0) {
										foreach ($result as $r) {
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
											<tr><th colspan="10" style="text-align: center;"><?= $r->item ?> (<?= $r->color ?>)</th>
											</tr>

   <?php 
   

   $result_purc = $this->db->select('purchase_order.*, item_master.item, colors.color, item_dtl.id_id, acc_master.name')
            ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left')
             ->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left')
             ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
             ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
             ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
             ->where('purchase_order_details.id_id', $r->id_id)
             ->where('purchase_order.status', '1')
             ->get_where('purchase_order')->result(); ?>
             <?php 
             if(count($result_purc) > 0) { 
             foreach($result_purc as $rc) { ?>
                <tr>                                                                        
             	<td>
             <?php  
                  echo $rc->po_number."<br />";
              ?>
             </td>
             <td>
             <?php  
                  echo $rc->name."<br />";
              ?>
             </td>
             <td>
             <?php  
                  echo date("d-m-Y", strtotime($rc->po_date))."<br />";
              ?>
             </td>
             <td style="text-align: right;">
             <?php
              $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity += $result_pu->pod_quantity;
            $tot_pod_quantity += $result_pu->pod_quantity;
            echo $result_pu->pod_quantity."<br />";
             } else {
            echo "<br />";  	
             }
          ?>
             </td>
             <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo $r_s->supp_po_number."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo date("d-m-Y", strtotime($r_s->pur_order_date))."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             <?php
             	$result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             // ->group_by('supp_purchase_order_detail.sup_id')
             ->get_where('supp_purchase_order_detail')->result();
             if(count($result_su) > 0) {
             	foreach($result_su as $r_s) {
              ?>
            <?php
            $sup_quantity += $r_s->item_qty;
            $tot_sup_quantity += $r_s->item_qty; 
            echo $r_s->item_qty."<br />";
             }}
         } else {
             	echo "<br />";
             } ?>
             </td>



             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo $r_r->purchase_order_receive_bill_no."<br />";
                }
             } else {
             	echo "<br />"; 
             }
         
              ?>
             </td>
             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date))."<br />";
            }} else {
            echo "<br />"; 	
             }
              ?>
             </td>
             <td style="text-align: right;">
             <?php
            $result_rc = $this->db->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get('purchase_order_receive_detail')->result();
             	?>
            <?php
            if(count($result_rc)>0) {
                foreach($result_rc as $r_r) {
            $rcv_quantity += $r_r->item_quantity;
            $tot_rcv_quantity += $r_r->item_quantity;
             echo $r_r->item_quantity."<br />";
                }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             	<?php
                
                 $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity = $result_pu->pod_quantity;
             } else {
            $pod_quantity = 0;  	
             }
             
             $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select_sum('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             ->group_by('supp_purchase_order.po_id')
             ->get_where('supp_purchase_order_detail')->row();
             if(count($result_su) > 0) {
              ?>
            <?php
            $sup_quantity = $result_su->item_qty;
             }
         } else {
             	$sup_quantity = 0;
             }
             
             $result_rc = $this->db->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             ->group_by('purchase_order_receive_detail.po_id')
             ->get('purchase_order_receive_detail')->row();
             	?>
            <?php
            if(count($result_rc)>0) {
            $rcv_quantity = $result_rc->item_quantity;
             } else {
             	$rcv_quantity = 0;
             }
             	?>
            <?php
            $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
            $tot_bal_quantity += $bal_quantity;
             echo $bal_quantity."<br />";
              ?>
             </td>
             </tr>
             <?php }} ?>
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
										}} ?>
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

	<?php if($segment == 'checking_summary_status'){
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
								<table id="all_det" class="table table-bordered">
									<thead>
										<tr>
									    <th >Order No.</th>
                                        <th >Article</th>
                                        <th >Order Qnty</th>
                                        <th >Checking Qnty</th>
                                        <th class="text-center">Employee</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($result as $res) {
											?>
											<tr>
												<td><?= $res->co_no ?></td>
                                                <td><?= $res->art_no . '(' . $res->lc . ')' ?></td>
                                                <td><?= $res->co_total_quantity ?></td>
                                                <td><?= $res->checked_quantity ?></td>
                                                <td><?= $res->emp_name ?></td>
                                                <td><?= date ("d-m-Y", strtotime($res->checking_start_date_time)) ?></td>
                                                <td><?= date ("d-m-Y", strtotime($res->checking_end_date_time)) ?></td>
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

	<?php if($segment == 'checking_stock_detail_ledger') {
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
                        foreach ($result as $f) {
                            
                            $crnt_item = $f['item'].' ('.$f['color'].')';
                    if ($crnt_item != $prev_item) {
                        $bal_qnty = 0; $bal_val = 0;
                        $prev_item = $crnt_item;
                    }

                    if($f['remark'] == 'Opening') {
                        $bal_qnty += $f['qnty'];
                        $bal_val += $f['val'];
                    }
                    elseif($f['remark'] == 'Purchase') {
                        $bal_qnty += $f['qnty'];
                        $bal_val += $f['val'];
                    }
                    elseif($f['remark'] == 'Stock In') {
                        $bal_qnty += $f['qnty'];
                        $bal_val += $f['val'];
                    }
                    elseif($f['remark'] == 'Issue') {
                        $bal_qnty -= $f['qnty'];
                        $bal_val -= $f['val'];
                    }
                    elseif($f['remark'] == 'Plating') {
                        $bal_qnty -= $f['qnty'];
                        $bal_val -= $f['val'];
                    }
                            ?>
                            <tr>
                        <td><?= $f['item'] . ' ('. $f['color'] .')' ?></td>
                        <td><?=$f['remark']?></td>
                        <td><?=$f['sl_no']?></td>
                        <td style="text-align:center"><?=date('d-m-Y', strtotime($f['date']))?></td>
                        <td style="text-align:right"><?=number_format($f['qnty'],2)?></td>
                        <td style="text-align:right"><?=number_format($f['rate'],2)?></td>
                        <td style="text-align:right"><?=number_format($f['val'],2)?></td>
                        <td style="text-align:right"><?=number_format($bal_qnty,2)?></td>
                        <td style="text-align:right"><?=number_format($bal_val,2)?></td>
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

	<?php if($segment == 'supplier_purchase_ledger') {
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
foreach ($result as $r) { ?>
	<tr>
    <td colspan="11" style="text-align:center"><strong><?= $r->acc_name ?></strong></td>
				<?php 
		$from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
$opening_row = $this->db->select('purchase_order_receive.*, SUM(purchase_order_receive_detail.item_quantity) AS item_quantity')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('purchase_order_receive.am_id', $r->am_id)
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
                ->order_by('purchase_order_receive.purchase_order_receive_bill_no')
                ->get('purchase_order_receive_detail')->result();

				foreach ($opening_row as $p_d) { ?>	
 <tr>	
     <td><?= $p_d->purchase_order_receive_bill_no ?></td>
     <td><?= date ("d-m-Y", strtotime($p_d->purchase_order_receive_date)) ?></td>
     <td style="text-align:right"><?= $p_d->item_quantity ?></td>
     <td style="text-align:right"><?= $p_d->total_amount ?></td>
     <td style="text-align:right"><?= $p_d->delivery_charge ?></td>
     <td style="text-align:right"><?= $p_d->cgst_percent ?></td>
     <td style="text-align:right"><?= $p_d->cgst_percentage_amount ?></td>
     <td style="text-align:right"><?= $p_d->sgst_percent ?></td>
     <td style="text-align:right"><?= $p_d->sgst_percentage_amount ?></td>
     <td style="text-align:right"><?= $p_d->delivery_sgst_cgst_amount ?></td>
     <td style="text-align:right"><?= $p_d->net_amount ?></td>
 </tr>
           <?php } ?>
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
	
	<?php if($segment == 'group_stock_summary') {
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
								<?php 
                            if(isset($result)) {
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
                <?=$result['html']?>
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
                <?=$result['html2']?>
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
                <?=$result['html3']?>
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
	
	<?php if($segment == 'jobber_bill_summary') {
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
                	if(isset($result)) { 
                          foreach($result as $rs) {
                          	foreach($rs as $r) {
                		?>
                    <tr>
                    	<td><?= $r->name ?></td>
                    	<td><?= $r->jobber_bill_number ?></td>
                    	<td><?= date("d-m-Y", strtotime($r->jobber_bill_date)) ?></td>
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
                	<?php }} ?>
                	<tr>
                		<th colspan="3">All Total</th>
                		<th style="text-align: right;"><?= $total_bill_amount ?></th>
                		<th style="text-align: right;"><?= $total_quantity ?></th>
                		<th style="text-align: right;"><?= $total_net_bill ?></th>
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

	<?php if($segment == 'cutter_bill_summary') {
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
                	if(isset($result)) { 
                          foreach($result as $rs) {
                          	foreach($rs as $r) {
                		?>
                    <tr>
                    	<td><?= $r->name ?></td>
                    	<td><?= $r->cutter_bill_name ?></td>
                    	<td><?= date("d-m-Y", strtotime($r->cutter_bill_date)) ?></td>
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
                	<?php }} ?>
                	<tr>
                		<th colspan="3">All Total</th>
                		<th style="text-align: right;"><?= number_format($total_bill_amount, 2) ?></th>
                		<th style="text-align: right;"><?= number_format($total_quantity, 2) ?></th>
                		<th style="text-align: right;"><?= number_format($total_net_bill, 2) ?></th>
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
	
	<?php if($segment == 'monthly_production_status') {
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
                            foreach ($fetch_all_monthly_buyer_report as $fasd) {
                                foreach ($fasd as $f) {
                                    $key = $f->mname;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'mname' => $f->mname,
                                            'total_quantity' => $f->total_quantity,
                                        );
                                    } else {
                                        $groups[$key]['mname'] = $f->mname;
                                        $groups[$key]['total_quantity'] += $f->total_quantity;
                                    }
                                }
                            }
//                            echo '<pre>', print_r($groups), '</pre>';die();

                            $total = 0;
                            foreach ($fetch_all_monthly_buyer_report as $fasd) {
                                foreach ($fasd as $curr_key=>$f) {

                                    $keys = array();
                                    foreach($fasd as $key=>$val) {
                                        if ($val->mname == $f->mname) {
                                            array_push($keys, $key);
                                        }
                                    }
//                                    echo '<pre>', print_r($keys), '</pre>';die();

                                    ?>
                                    <tr>
                                        <td><?= $f->mname ?></td>
                                        <td><?= date("d-m-Y", strtotime($f->package_date)) ?></td>
                                        <td><?= $f->name ?></td>
                                        <td style="text-align: right;"><?php $total += $f->total_quantity; echo $f->total_quantity; ?></td>
                                    </tr>

                                    <?php
                                    if(end($keys) == $curr_key) {
                                        ?>
                                        <tr>
                                            <th><?= $f->mname ?></th>
                                            <th colspan="2">Total for <?=$groups[$f->mname]['mname']?></th>
                                            <th style="text-align: right;"><?= number_format( $groups[$f->mname]['total_quantity'], 2)?></th>
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
                                <th style="text-align: right;"><?= number_format($total, 2) ?></th>
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
	
	<?php if($segment == 'fetch_production_register' ) {
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
                                    <strong>Date: <?= $result[0]->challan_date ?></strong>
                                </td>
                                <td colspan="2">
                                    <strong>Opening Balance for:  <?= $closing_balance ?></strong>
                                </td>    
                            </tr>
                            <?php
                            $total = 0;
                            $total1 = 0;
                            $inc_total = 0;
                            $exp_total = 0;
                            $iter = 1;
                            foreach ($result as $curr_key=>$f) {
                            
                                    $total_row = count($result);

                                    $date_array = array();
                                    $month_array = array();
                                    foreach($result as $key=>$val) {
                                        if ($val->challan_date == $f->challan_date) {
                                            array_push($date_array, $key);
                                        }
                                        if ($val->mon == $f->mon) {
                                            array_push($month_array, $key);
                                        }
                                    }
if($f->challan_status == 0) {

                                    ?>
                                    <tr>
                                        <td><?= $f->challan_date ?></td>
                                        <td><?= $f->article_name ?></td>
                                        <td><?= $f->article_color ?></td>
                                        <td><?= $f->challan_number ?></td>
                                        <td style="text-align: right;"><?php $total += $f->challan_quantity; $closing_balance += $f->challan_quantity; echo round($f->challan_quantity); ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

    <?php } else { ?>
              <tr>
                                        <td><?= $f->challan_date ?></td>
                                        <td><?= $f->article_name ?></td>
                                        <td><?= $f->article_color ?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?= $f->challan_number ?></td>
                                        <td style="text-align: right;"><?php $total1 += $f->challan_quantity; $closing_balance -= $f->challan_quantity; echo round($f->challan_quantity); ?></td>
                                    </tr>
    <?php } ?>                                

                                    <?php
                                    if(end($date_array) == $curr_key) {
                                        ?>
                                        <tr class="bg-primary">
                                            <th colspan="2"> Closing balance on <?= $f->challan_date ?><span class="pull-right"><?= $closing_balance ?></span></th>
                                            <th colspan="3"> Total finished goods on <?=$f->challan_date?><span class="pull-right"><?php $inc_total += $total; echo $total; ?></span></th>
                                            <th colspan="2"> Total sales on <?=$f->challan_date?><span class="pull-right"><?php $exp_total += $total1; echo $total1; ?></span></th>
                                        </tr>
                                        <?php
                                        $total = 0;
                                        $total1 = 0;
                                    }
                                    if(end($month_array) == $curr_key) {
                                        ?>
                                        <tr class="bg-warning">
                                            <th colspan="2">For <?= $f->mon ?></th>
                                            <th colspan="3">Month-wise Income: <?= $inc_total ?></th>
                                            <th colspan="2">Month-wise Expences: <?= $exp_total ?></th>
                                        </tr>
                                        <?php
                                    $inc_total = 0;
                                    $exp_total = 0;
                                    }
                            if($iter != 1 and end($date_array) == $curr_key and $iter != $total_row) {
                                            ?>
                                            <tr class="bg-info">
                                                <td colspan="5"></td>
                                                <td colspan="2"><strong> <span class="pull-right">Opening Balance: <?= $closing_balance ?></strong></span></td>
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
	
	<?php if($segment == 'payroll_reports_advance_ledger' ) {
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
                            if(isset($result)) {
                                foreach($result as $res){
                                    foreach($res as $a){
                                    ?>
                                    <tr>
                                        <?php
                                     $a->date;
                                       $month_new = strtotime($a->date);
                                       $new_date = date("Y-m-d", strtotime($a->date));
                                        $show_array = array();
                                        $dates = array();
                                        $balance = ($a->ADV + $balance); 
                                        
                                        $new_sql="SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') > '".$new_date."'
        ORDER BY advance.date";
        
        $new_res = $this->db->query($new_sql)->result();
        
        // echo $this->db->last_query();
        
        if(count($new_res) > 0) {
            
            $month_new_next = strtotime($new_res[0]->date);
            $stepVal = '+1 month';
      while($month_new <= $month_new_next ) {
         $dates[] = date('M', $month_new);
         $month_new = strtotime($stepVal, $month_new);
      }
      
      foreach($dates as $d) { 
      $sql="SELECT employees.name,e_code,employees.pf_acc_no, salary.LOAN, salary.MON, employees.esi_acc_no,salary.T4,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '".$d."%' AND employees.e_id='".$a->emp_id."'
            ORDER BY employees.e_code";
            $salary_details = $this->db->query($sql)->row();                              	
            if(count($salary_details) > 0 && $salary_details->LOAN != 0) {
                $balance = $balance - $salary_details->LOAN;
                $total_balance += $salary_details->LOAN;
        $arr = array(
            'loan' => $salary_details->LOAN,
            'mon' => $salary_details->MON,
            'balance' => $balance 
             );
            array_push($show_array, $arr);
            
        }
        
    
 }
 
        } else {
            $month_new_next = strtotime(date("Y-m-d"));
            $stepVal = '+1 month';
      while($month_new <= $month_new_next ) {
         $dates[] = date('M', $month_new);
         $month_new = strtotime($stepVal, $month_new);
      }
      
     foreach($dates as $d) {       
     $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC, salary.MON,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$d."%' AND employees.e_id = $a->emp_id
        GROUP BY salary.CODE
        ";
        $salary_details = $this->db->query($sql)->row();
        
        if(count($salary_details) > 0 && $salary_details->LOAN != 0) {
         $balance = $balance - $salary_details->LOAN;
         
        $arr = array(
            'loan' => $salary_details->LOAN,
            'mon' => $salary_details->MON,
            'balance' => $balance
            );
            array_push($show_array, $arr);
        }
        }
        
 }
        
                                        $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC, salary.MON,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE employees.e_id = $a->emp_id
        GROUP BY salary.CODE
        ";
        $res = $this->db->query($sql)->result();
        $count = count($show_array);
                                        ?>
                                        <?php if($i == 1) { ?>
                                        <td rowspan="<?= $count + 1 ?>"><?= $a->name . '['.$a->e_code.']' ?></td>
                                        <td rowspan="<?= $count + 1 ?>"><?= 'Advance Taken on: ' . $a->MONNAME ?></td>
                                        <td rowspan="<?= $count + 1 ?>" style="text-align: right;">
                                            <?= $a->ADV ?>
                                            <?php 
              $new_sqll="SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date
        FROM advance
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') < '".$new_date."'";
        $new_ress = $this->db->query($new_sqll)->num_rows();  
        if($new_ress > 0) {
            
               $new_sql="SELECT advance.emp_id, SUM(advance.amount) AS new_adv, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = $a->emp_id AND STR_TO_DATE(advance.date, '%Y-%m-%d') < '".$new_date."'
        ORDER BY advance.date";
        $new_res = $this->db->query($new_sql)->row();
        
        echo ' <br/> + <br/> '.number_format(abs($new_res->new_adv - $total_balance), 2).'(Prev)';
        
        } ?>
                                            </td>
                                        <?php } ?>
                                        <?php foreach($show_array as $r) {
                                            $show_month_new_array = explode("~",$r['mon'])
                                        ?>
                                        <tr>
                                        <td><?= $show_month_new_array[0] ?></td>
                                        <td style="text-align: right;"><?= $r['loan'] ?></td>
                                        <td style="text-align: right;"><?= $r['balance'] ?></td>
                                        </tr>
                                        <?php
                                        $arr = array(
            'loan' => $r['mon'],
            'mon' => $r['loan']
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
                                } $iter ++;
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

	<?php if($segment == 'payroll_reports_leave' ) {
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
      $current = strtotime('2022-04-1');
      $date2 = strtotime('2023-03-1');
      $stepVal = '+1 month';
      while( $current <= $date2 ) {
         $dates[] = date('M', $current);
         $dates1[] = date('m', $current);
         $dates_val = (int)date('m', $current);
         $new_dates1[] = date('F', mktime(0, 0, 0, date('m', $current), 1)) .'~'. cal_days_in_month(CAL_GREGORIAN,date('m', $current),date('Y'))  .'~'. $dates_val;
         $current = strtotime($stepVal, $current);
      }
   foreach($dates as $d) {
                            			 ?>
<th style="text-align: right;"><?= $d ?></th>
                            			 <?php 
}
                            			  ?>
                            			  <th style="text-align: right;">Total</th>
                            			  <th style="text-align: right;">Leave <br/> Blnc.</th>
                            			  <tr/>
                </thead>
                <tbody> 
                	<?php
                	if(isset($result)) {
                                foreach($result as $res){
                                    foreach($res as $a){
                                    ?>
                                    <tr>
                                        <td rowspan="3"><?= $a->name . '['.$a->e_code.']' ?></td>
                                    <td>Casual Leave</td>
                                    <td style="text-align: right;"><?= $a->cl_granted ?></td>
                                    <?php foreach($new_dates1 as $d) {
      $sql="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T4,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON = '".$d."' AND employees.e_id='".$a->e_id."'
            ORDER BY employees.e_code";
            $salary_details = $this->db->query($sql)->row();
                                         if(count($salary_details) > 0) {
                            			 ?>
<td style="text-align: right;"><b><?= $salary_details->T4 ?><?php $total_cl += $salary_details->T4 ?><b/></td>
<?php } else { ?>
<td style="text-align: right;"></td>                   			 
                            			 <?php 
}}
                            			  ?>
                            			  <td style="text-align: right;"><b><?= $total_cl ?></b>
                            			  <td style="text-align: right;"><b><?php echo ($a->cl_granted - $total_cl); $total_cl = 0; ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>Earn Leave</td>
                                    <td style="text-align: right;"><?= $a->el_granted ?></td>
                                    <?php foreach($new_dates1 as $d) {
            $sql1="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T5,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON = '".$d."' AND employees.e_id='".$a->e_id."'
            ORDER BY employees.e_code";
            $salary_details1 = $this->db->query($sql1)->row();
                                         if(count($salary_details1) > 0) {
                            			 ?>
<td style="text-align: right;"><b><?= $salary_details1->T5 ?></b><?php $total_el += $salary_details1->T5 ?></td>
<?php } else { ?>
<td style="text-align: right;"></td>                   			 
                            			 <?php 
}}
                            			  ?>
                            			  <td style="text-align: right;"><b><?= $total_el ?></b></td>
                            			  <td style="text-align: right;"><b><?php echo ($a->el_granted - $total_el); $total_el = 0;  ?></b></td>
                                    </tr>
                                    <tr>
                                    <td>E.S.I. Leave</td>
                                    <td></td>
                                    <?php foreach($new_dates1 as $d) {
            $sql2="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T6,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,salary.GROSS
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON = '".$d."' AND employees.e_id='".$a->e_id."'
            ORDER BY employees.e_code";
            $salary_details2 = $this->db->query($sql2)->row();                        	
                                         if(count($salary_details2) > 0) {
                            			 ?>
<td style="text-align: right;"><b><?= $salary_details2->T6 ?><b/><?php $total_esil += $salary_details2->T6; ?></td>
<?php } else { ?>
<td style="text-align: right;"></td>                   			 
                            			 <?php 
}}
                            			  ?>
                            			  <td style="text-align: right;"><b><?= $total_esil ?></b><?php $total_esil = 0; ?></td>
                            			  <td></td>
                                    </tr>
                                    <?php
                                }}
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
	
	<?php if($segment == 'payroll_esi_pf' ) {
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
					<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
					<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
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
                                    <th colspan="4"><p class="text-right"><strong>Contractor: <?=$contractor_names?></strong></p></th>
                                    <th colspan="3">
                                        Month: <?= $mont ?><br />
                                        Date: <?= date('d-m-Y') ?><br />
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
                                    <th style="text-align: right;">Total Contribution</th>
                                </tr>
                </thead>
                <tbody>
                            <?php
                            $iter = 1;
                            $total_gross = 0;
                            $total_esi1  = 0;
                            $total_esi2 = 0;
                            $total_esi3 = 0;
                            if(isset($result)) {
                                foreach($result as $res){
                                    foreach($res as $a){
                                    ?>
                                    <tr>
                                        <td><?= $iter++ ?></td>
                                        <td><?= $a->name . '['.$a->e_code.']' ?></td>
                                        <td><?= $a->esi_acc_no ?></td>
                                        <td><?= $a->T2 ?></td>
                                        <td style="text-align: right;"><?php echo $a->GROSS; $total_gross += $a->GROSS; ?></td>
                                        <td style="text-align: right;"><?php echo $round_esi1 = ceil($a->GROSS * (3.25/100)); $total_esi1 += ceil($a->GROSS * (3.25/100));  ?></td>
                                        <td style="text-align: right;"><?php echo $round_esi2 = ceil($a->GROSS * (0.75/100)); $total_esi2 += ceil($a->GROSS * (0.75/100));  ?></td>
                                        <td style="text-align: right;">
											<?php 
												echo $round_esi1 + $round_esi2; 
												$total_esi3 += ceil(($a->GROSS * (0.75/100) + $a->GROSS * (3.25/100)));  
											?>
										</td>
                                    </tr>
                                    <?php
                                }}
                                ?>
                                <tr>
                                    <th colspan="4">Grand Total</th>
                                    <th style="text-align: right;"><?= $total_gross ?></th>
                                    <th style="text-align: right;"><?= $total_esi1 ?></th>
                                    <th style="text-align: right;"><?= $total_esi2 ?></th>
                                    <th style="text-align: right;"><?= $total_esi1+$total_esi2 ?></th>
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
	
	<?php if($segment == 'purchase_order_rate_setup_details' ) {
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
                                    foreach($purchase_array as $a){
                                    	$count_rows = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_id' => $a['purchase_order_receive_id'], 'id_id' => $a['id_id']))->num_rows(); 
            $today = date("Y-m-d");
            $rate_rows = $this->db->select('*')->where("effective_date <=", $today)->order_by('effective_date', 'desc')->get_where('item_rates', array('item_rates.id_id' => $a['id_id'], 'item_rates.am_id' => $a['am_id']))->row();
                                    ?>
                                    <tr>
                                    	<?php if($item_name != $a['item_name']) { ?>
                                    	<td style="width: 6%;"><?= $iter++; ?></td>
                                        <td><?= $a['item_name'] . '['.$a['color'].']' ?></td>
                                        <?php if(count($rate_rows) > 0) { ?>
                                        <td style="text-align: right;"><?= $rate_rows->purchase_rate ?> (purchase rate) <br/> <?= $rate_rows->cost_rate ?> (cost rate) </td>
                                        <?php } else { ?>
                                        <td>-</td>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <td style="width: 6%;"></td>
                                        <td></td>
                                        <td></td>
                                    <?php } $item_name = $a['item_name']; ?>
                                        <td><?= $a['purchase_bill_no'] ?></td>
                                        <td><?= date ("d-m-Y", strtotime($a['created_date'])) ?></td>
                                        <td style="text-align: right;"><?= $a['purchase_rate'] ?></td>
                                    </tr>
                                    <?php
                                $count_rows = 0;}
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

	<?php if($segment == 'payroll_pf' ) {
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
					<h4 class=""><strong>SHILPA OVERSEAS PVT. LTD. </strong></h4>
					<p class="mar_0">KAIKHALI, CHIRIAMORE,P.O. : R.GOPALPUR, KOLKATA - 700 136</p>
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
											<th colspan="5"><p class="text-right"><strong>Contractor: <?=$contractor_names?></strong></p></th>
											<th colspan="3">
												Month: <?= $mont ?><br />
												Date: <?= date('d-m-Y') ?><br />
											</th>
										</tr>
										<tr>
											<th rowspan="2">Sr. #</th>
											<th rowspan="2">Emp. Name</th>
											<th rowspan="2">P.F. A/C No.</th>
											<th rowspan="2">Actual Days Worked</th>
											<th rowspan="2" style="text-align: right;">Total Wages Earned</th>
											<th class="text-center" rowspan="1">Employee</th>
											<th class="text-center" colspan="2" rowspan="1">Employer</th>
										</tr>
										<tr>
											<th rowspan="1" style="text-align: right;">P.F. </th>
											<th rowspan="1" style="text-align: right;">P.F. @ 8.33%</th>
											<th rowspan="1" style="text-align: right;">P.F. @ 2.67%</th>
										</tr>
									</thead>
										<tbody>
											<?php
											$iter = 1;
											$total11 = 0;
											$total12 = 0;
											$total13 = 0;
											$total14 = 0;
											if(isset($result)) {
												foreach($result as $res){
													foreach($res as $a) {
														//echo '<pre>', print_r($a), '</pre>';
													?>
													<tr>
														<td><?= $iter++ ?></td>
														<td><?= $a->name . '['.$a->e_code.']' ?></td>
														<td><?= $a->pf_acc_no ?></td>
														<td><?= $a->T2 ?></td>
														<td style="text-align: right;">
															<?php 
																echo $twearned = (($a->no_of_part * $a->rate_per_part) + $a->pay_for_holiday); 
																$total11 += $twearned; 
															?>
														</td>
														<td style="text-align: right;"><?php echo $val= $a->PFAMT; $total12 += $val; ?></td>
														<td style="text-align: right;">
															<?php 
																echo $pf833 = round($twearned * (8.33/100)); 
																$total13 += $pf833;  
															?>
														</td>
														<td style="text-align: right;">
															<?php 
																echo round($val - $pf833); 
																$total14 += round($val - $pf833); ?>
															</td>
													</tr>
													<?php
													}
												}
											}
												?>
												
												<tr>
													<th colspan = "4"> Grand Total </th>
													<th style="text-align: right;"><?= $total11 ?></th>
													<th style="text-align: right;"><?= $total12 ?></th>
													<th style="text-align: right;"><?= $total13 ?></th>
													<th style="text-align: right;"><?= $total14 ?></th>
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

	<?php if($segment == 'article_master_report_section' ) {
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
					<h3 class="mar_0 head_font">ARTICLE MASTER REPORT</h3>
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
                                foreach($result as $a){
                                    ?>
                                    <tr>
                                        <td><?= $iter++ ?></td>
                                        <td><?= $a->art_no ?></td>
                                        <td><?= $a->info ?></td>
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
                                	<th style="text-align: right;"><?= $exworks_factory1 ?></th>
                                	<th style="text-align: right;"><?= $cf_factory1 ?></th>
                                	<th style="text-align: right;"><?= $fob_factory1 ?></th>
                                	<th style="text-align: right;"><?= $exworks_factory2 ?></th>
                                	<th style="text-align: right;"><?= $cf_factory2 ?></th>
                                	<th style="text-align: right;"><?= $fob_factory2 ?></th>
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

<?php if($segment == 'supplier_wise_item_position') {
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
    $tot_pod_quantity1 = 0;
    $tot_sup_quantity1 = 0;
    $tot_rcv_quantity1 = 0;
    $tot_bal_quantity1 = 0;
				 foreach ($result as $r) { 

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

            $purchase_order_details = $this->db->query($query)->result();

				 	?>

				 	<?php 
if(count($purchase_order_details) > 0) {
				 	 ?>						
									<tr>
    <td colspan="10" style="text-align:center"><strong>{<?= $r->item ?>} ({<?= $r->color ?>})</strong></td>
</tr>
            <?php foreach($purchase_order_details as $rc) {
             ?>
<tr>
    <td><?= $rc->po_number ?></td>
     <td><?= date ("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
       $tot_pod_quantity += $rc->pod_quantity;
       $tot_pod_quantity1 += $rc->pod_quantity;
      ?></td>
     <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo $r_s->supp_po_number."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo date("d-m-Y", strtotime($r_s->pur_order_date))."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             <?php
             	$result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             // ->group_by('supp_purchase_order_detail.sup_id')
             ->get_where('supp_purchase_order_detail')->result();
             if(count($result_su) > 0) {
             	foreach($result_su as $r_s) {
              ?>
            <?php
            $tot_sup_quantity += $r_s->item_qty;
            $tot_sup_quantity1 += $r_s->item_qty; 
            echo $r_s->item_qty."<br />";
             }}
         } else {
             	echo "<br />";
             } ?>
             </td>



             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo $r_r->purchase_order_receive_bill_no."<br />";
                }
             } else {
             	echo "<br />"; 
             }
         
              ?>
             </td>
             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date))."<br />";
            }} else {
            echo "<br />"; 	
             }
              ?>
             </td>
             <td style="text-align: right;">
             <?php
            $result_rc = $this->db->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get('purchase_order_receive_detail')->result();
             	?>
            <?php
            if(count($result_rc)>0) {
                foreach($result_rc as $r_r) {
            $tot_rcv_quantity += $r_r->item_quantity;
            $tot_rcv_quantity1 += $r_r->item_quantity;
             echo $r_r->item_quantity."<br />";
                }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             	<?php
                
                 $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity = $result_pu->pod_quantity;
             } else {
            $pod_quantity = 0;  	
             }
             
             $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select_sum('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
             ->get_where('supp_purchase_order_detail')->row();
             if(count($result_su) > 0) {
              ?>
            <?php
            $sup_quantity = $result_su->item_qty;
             }
         } else {
             	$sup_quantity = 0;
             }
             
             $result_rc = $this->db->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
             ->get('purchase_order_receive_detail')->row();
             	?>
            <?php
            if(count($result_rc) > 0) {
            $rcv_quantity = $result_rc->item_quantity;
             } else {
             	$rcv_quantity = 0;
             }
             	?>
            <?php
            $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
            $tot_bal_quantity += $bal_quantity;
            $tot_bal_quantity1 += $bal_quantity;
             echo $bal_quantity."<br />";
              ?>
             </td>
         </tr>
     <?php } ?>
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
 	<td style="text-align: right;"><?php echo $tot_bal_quantity;
     $tot_bal_quantity = 0;
 	 ?></td>
 </tr>
                <?php }} ?>
                <tr style="background: #445767; color: white;">
 	<th colspan="2">Grand Total</th>
 	<td style="text-align: right;"><?php echo $tot_pod_quantity1;
 	 ?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_sup_quantity1; 
 	?></td>
 	<td colspan="3" style="text-align: right;"><?php echo $tot_rcv_quantity1;
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

	<?php if($segment == 'order_summary'){
		// echo '<pre>',print_r($result),'</pre>';
		$temp_co_name_array = array();
		foreach($result as $co_name) {
			if(!in_array($co_name->co_no, $temp_co_name_array)){
				array_push($temp_co_name_array, $co_name->co_no);
			}
		}
		?>
		<style>
		    style>
			@media print{@page {size: A3 landscape;}}
			body.A3.landscape .sheet {
                width: 500mm;
                }
            			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 5px;
                text-align: left;
                font-size: 12px;
            }
		</style>
		<div class="A3 landscape" id="page-content">
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
						<?= implode(', ', $temp_co_name_array) ?>
					</div>
				</div>
				<!--table data-->
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="table-responsive">
								<!--<h5>Retrieve Table</h5>-->
								<table id="all_det" class="table table-bordered order-summary">
									<thead>
										<tr>
											<th rowspan="2">Order No.</th>
											<th rowspan="2">Article</th>
											<th rowspan="2">Ord Qnty</th>
											<th colspan="3" class="text-center">Cutting Information</th>
											<th colspan="2" class="text-center">Skiving Information</th>
											<th colspan="3" class="text-center">Fabricator Information</th>
											<th rowspan="2" class="text-center">Shipping Information</th>
										</tr>
										<tr>
											<th>Cut Issue</th>
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
										$summary_co_iter=1;

										// $last_co_qnty[] = '';
										foreach ($result as $res) {

											if(!in_array($res->co_no, $summary_co_names)){
												array_push($summary_co_names, $res->co_no);
												if($summary_co_iter++ == 1){
														// continue;
													}else{
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
														
														<th></th>
														
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
												<th height="60" nowrap style="font-size: 12px"><?= $res->co_no . '<br>(' . date('d-m-Y', strtotime($res->co_date)) . ')' ?></th>
												<td height="60" nowrap style="font-size: 12px"><?= $res->art_no .' ['.$res->color.']' ?></td>
												<td height="60" nowrap class="text-right">
													<?php 
														echo $res->co_quantity; 
														$grand_co += $res->co_quantity;
													?>
												</td>
												<td height="60" nowrap class="">
													<?php 
													echo $res->ci .'<span>'.$res->cut_co_quantity.'</span>';
													$grand_ci += $res->cut_co_quantity;
													?>	 	
												</td>
												<td height="60" nowrap class="">
													<?php 
													echo $res->cr .'<span>'.$res->receive_cut_quantity.'</span>'; 
													$grand_cr += $res->receive_cut_quantity;
													?>
													<br><br>
												</td>
													<?php 
			$get_cutter_bill_det = $this->db
		->get_where('cutter_bill_dtl', array('cut_id' => $res->cutting_issue_id, 
						'cut_rcv_id' => $res->cutting_receive_id, 'co_id' => $res->co_id, 'am_id' => $res->am_id, 'leather_color' => $res->c_id))->row();

													?>
													
													<td height="60" nowrap class="">
													<?php 
												 if(count($get_cutter_bill_det) > 0) {
												 	$get_cutter_bill_detail_id = $get_cutter_bill_det->cb_id;
			$get_cutter_bill_details = $this->db->get_where('cutter_bill', array('cb_id' => $get_cutter_bill_detail_id))->row();
			if(count($get_cutter_bill_details) > 0) {
					echo $get_cutter_bill_details->cutter_bill_name."<br/>".date("d-m-Y", strtotime($get_cutter_bill_details->cutter_bill_date));
			}
												 } else {
												     echo '';
												 }
													?>
													</td>
												<td height="60" nowrap class="">
													<?php 
													echo $res->cr .'<span>'.$res->receive_cut_quantity.'</span>'; 
													?>
													<br><br>
												</td>
												
												<td height="60" nowrap class="">
													<?php
													echo $res->sr .'<span>'.$res->receive_quantity.'</span>';
													$grand_sr += $res->receive_quantity;
													?>
													<br><br>
												</td>

												<td height="60" nowrap class="">
													<?php 
													echo $res->jobi .'<span>'.$res->jobber_issue_quantity.'</span>';
													$grand_ji += $res->jobber_issue_quantity;
													 ?>
													 <br><br>
													</td>
												<td height="60" nowrap class="">
													<?php echo $res->jobr .'<span>'.$res->jobber_receive_quantity.'</span>'; 
													$grand_jr += $res->jobber_receive_quantity;
													?>
													<br><br>
												</td>
												
												<?php 
						$get_jobber_bill_det = $this->db
						->get_where('jobber_bill_detail', array('jobber_issue_id' => $res->jobber_issue_id, 'jobber_challan_receipt_id' => $res->jobber_challan_receipt_id, 
						'co_id' => $res->co_id, 'am_id' => $res->am_id, 'lc_id' => $res->c_id))->row();

						
													?>
													
													<td height="60" nowrap class="">
													<?php 
												 if(count($get_jobber_bill_det) > 0) {
												 	$get_jobber_bill_details_id = $get_jobber_bill_det->jobber_bill_id;
	$get_jobber_bill_details = $this->db->get_where('jobber_bill', array('jobber_bill_id' => $get_jobber_bill_details_id))->row();
						if(count($get_jobber_bill_details) > 0) {
												     echo $get_jobber_bill_details->jobber_bill_number."<br/>".date("d-m-Y", strtotime($get_jobber_bill_details->jobber_bill_date));
												 }
												 } else {
												     echo '';
												 }
													?>
													</td>
												
												<?php $pack_shipment_num = $this->db
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
			->get_where('packing_shipment_detail', array('packing_shipment_detail.cod_id'=> $res->cod_id, 'packing_shipment_detail.am_id'=> $res->am_id, 'packing_shipment_detail.lc_id'=> $res->lc_id ))->num_rows(); ?>

              <?php if($pack_shipment_num > 0) { ?>
												<?php $pack_shipment = $this->db->select('packing_shipment.package_name')
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
			->get_where('packing_shipment_detail', array('packing_shipment_detail.cod_id'=> $res->cod_id, 'packing_shipment_detail.am_id'=> $res->am_id, 'packing_shipment_detail.lc_id'=> $res->lc_id ))->row()->package_name; ?>
			
			<?php $pack_ship_quantity = $this->db->select('packing_shipment_detail.article_quantity')
            ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
			->get_where('packing_shipment_detail', array('packing_shipment_detail.cod_id'=> $res->cod_id, 'packing_shipment_detail.am_id'=> $res->am_id, 'packing_shipment_detail.lc_id'=> $res->lc_id ))->row()->article_quantity; ?>
			
			
												<td height="60" nowrap class="">
													<?php echo $pack_shipment .'<span>'.$pack_ship_quantity.'</span>'; 
													$grand_shp += $pack_ship_quantity;
													?>
												</td>
												
												<?php } else { ?>
												
												<td height="60" nowrap class="">
												</td>
												
												<?php } ?>
												
											</tr>
											<?php
										} 
										if(end($result)){
											?>
											<tr style="background-color: #d9e2ea;">
												<th colspan="2">Total</th>
												<th class="text-right"><?= $grand_co - $sub_co ?></th>
												<th class="text-right"><?= $grand_ci - $sub_ci ?></th>
												<th class="text-right"><?= $grand_cr - $sub_cr ?></th>
												<th></th>										
												<th class="text-right"><?= $grand_cr - $sub_cr ?></th>
												<th class="text-right"><?= $grand_sr - $sub_sr ?></th>
												<th class="text-right"><?= $grand_ji - $sub_ji ?></th>
												<th class="text-right"><?= $grand_jr - $sub_jr ?></th>
												<th></th>
												<th class="text-right"><?= $grand_shp ?></th>
											</tr>
											<?php
										}
										?>
										<tr style="background-color: #445767;color: white;">
											<th colspan="2">Grand Total</th>
											<th class="text-right"><?= $grand_co ?></th>
											<th class="text-right"><?=$grand_ci?></th>
											<th class="text-right"><?=$grand_cr?></th>
											<th></th>
											<th class="text-right"><?= $grand_cr ?></th>
											<th class="text-right"><?=$grand_sr?></th>
											<th class="text-right"><?=$grand_ji?></th>
											<th class="text-right"><?=$grand_jr?></th>
											<th></th>
											<th class="text-right"><?=$grand_shp?></th>
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
	<div class="A4" id="page-content">

	<?php if($segment == 'jobber_ledger_status_report'){
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
					    <h4 class="mar_0"><?= $result[0]->name ?></h4>
						<p class="mar_0"><?= $result[0]->address ?></p>
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
										foreach ($result as $res) {
											if($res->jobber_issue_quantity == 0) {
												continue;
											}
								// 			if(($res->jobber_issue_quantity - $res->jobber_receive_quantity) != 0) {
								// 				continue;
								// 			}
											?>
											<tr>
											    <td style="font-size: 12px"><?= $res->art_no .' ['.$res->color.']' ?></td>
												<td style="font-size: 12px"><?= $res->co_no ?></td>
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
													if($res->jobr_challan_date != '') {
													echo $res->jobr_challan_date;
												} else {
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
										    <th style="text-align: right;"><?= $total_jobber_issue ?></th>
										    <th></th>
										    <th></th>
										    <th style="text-align: right;"><?= $total_jobber_receive ?></th>
										    <th style="text-align: right;"><?= $total_balance ?></th>
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
	<?php if($segment == 'jobber_ledger_status_report_non_zero'){
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
					    <h4 class="mar_0"><?= $result[0]->name ?></h4>
						<p class="mar_0"><?= $result[0]->address ?></p>
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
										foreach ($result as $res) {
											if($res->jobber_issue_quantity == 0) {
												continue;
											}
											if(($res->jobber_issue_quantity - $res->jobber_receive_quantity) == 0) {
												continue;
											}
											?>
											<tr>
											    <td style="font-size: 12px"><?= $res->art_no .' ['.$res->color.']' ?></td>
												<td style="font-size: 12px"><?= $res->co_no ?></td>
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
													if($res->jobr_challan_date != '') {
													echo $res->jobr_challan_date;
												} else {
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
										    <th style="text-align: right;"><?= $total_jobber_issue ?></th>
										    <th></th>
										    <th></th>
										    <th style="text-align: right;"><?= $total_jobber_receive ?></th>
										    <th style="text-align: right;"><?= $total_balance ?></th>
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
</body>

<?php if($segment == 'supplier_wise_purchase_position') {
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
				foreach ($result as $rc) { ?>						
									<tr>
    <td style="text-align:center"><?= $rc->name ?></td>
     <td><?= $rc->po_number ?></td>
     <td><?= date ("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td><?= $rc->item ?> [<?= $rc->color ?>] </td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
     $tot_pod_quantity += $rc->pod_quantity;  ?></td>
     <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo $r_s->supp_po_number."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo date("d-m-Y", strtotime($r_s->pur_order_date))."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             <?php
             	$result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             // ->group_by('supp_purchase_order_detail.sup_id')
             ->get_where('supp_purchase_order_detail')->result();
             if(count($result_su) > 0) {
             	foreach($result_su as $r_s) {
              ?>
            <?php
            $tot_sup_quantity += $r_s->item_qty; 
            echo $r_s->item_qty."<br />";
             }}
         } else {
             	echo "<br />";
             } ?>
             </td>



             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo $r_r->purchase_order_receive_bill_no."<br />";
                }
             } else {
             	echo "<br />"; 
             }
         
              ?>
             </td>
             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date))."<br />";
            }} else {
            echo "<br />"; 	
             }
              ?>
             </td>
             <td style="text-align: right;">
             <?php
            $result_rc = $this->db->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get('purchase_order_receive_detail')->result();
             	?>
            <?php
            if(count($result_rc)>0) {
                foreach($result_rc as $r_r) {
            $tot_rcv_quantity += $r_r->item_quantity;
             echo $r_r->item_quantity."<br />";
                }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             	<?php
                
                 $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity = $result_pu->pod_quantity;
             } else {
            $pod_quantity = 0;  	
             }
             
             $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select_sum('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
             ->get_where('supp_purchase_order_detail')->row();
             if(count($result_su) > 0) {
              ?>
            <?php
            $sup_quantity = $result_su->item_qty;
             }
         } else {
             	$sup_quantity = 0;
             }
             
             $result_rc = $this->db->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
             ->get('purchase_order_receive_detail')->row();
             	?>
            <?php
            if(count($result_rc) > 0) {
            $rcv_quantity = $result_rc->item_quantity;
             } else {
             	$rcv_quantity = 0;
             }
             	?>
            <?php
            $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
            $tot_bal_quantity += $bal_quantity;
             echo $bal_quantity."<br />";
              ?>
             </td>
</tr>
           <?php } ?>
           <tr>
               <th colspan="4">Total</th>
               <th style="text-align: right;"><?= $tot_pod_quantity ?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?= $tot_sup_quantity ?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?= $tot_rcv_quantity ?></th>
               <th style="text-align: right;"><?= $tot_bal_quantity ?></th>
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
	
	<?php if($segment == 'supplier_purchase_ledger_wo_zero') {
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
				foreach ($result as $rc) { ?>	
				<?php
                
                 $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity = $result_pu->pod_quantity;
             } else {
            $pod_quantity = 0;  	
             }
             
             $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select_sum('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
             ->get_where('supp_purchase_order_detail')->row();
             if(count($result_su) > 0) {
              ?>
            <?php
            $sup_quantity = $result_su->item_qty;
             }
         } else {
             	$sup_quantity = 0;
             }
             
             $result_rc = $this->db->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
             ->get('purchase_order_receive_detail')->row();
             	?>
            <?php
            if(count($result_rc) > 0) {
            $rcv_quantity = $result_rc->item_quantity;
             } else {
             	$rcv_quantity = 0;
             }
             $balc = (($pod_quantity + $sup_quantity) - $rcv_quantity);
             	?>
            <?php
             if($balc < 50)
{
 continue;   
}
?>
									<tr>
    <td style="text-align:center"><?= $rc->name ?></td>
     <td><?= $rc->po_number ?></td>
     <td><?= date ("d-m-Y", strtotime($rc->po_date)) ?></td>
     <td><?= $rc->item ?> [<?= $rc->color ?>] </td>
     <td style="text-align: right;"><?php echo $rc->pod_quantity;
     $tot_pod_quantity += $rc->pod_quantity;  ?></td>
     <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo $r_s->supp_po_number."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td>
             <?php
              $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order_detail')->result(); ?>
            <?php 
             if(count($result_sup) > 0) {
             	foreach($result_sup as $r_s) {
            echo date("d-m-Y", strtotime($r_s->pur_order_date))."<br />";
             }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             <?php
             	$result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             // ->group_by('supp_purchase_order_detail.sup_id')
             ->get_where('supp_purchase_order_detail')->result();
             if(count($result_su) > 0) {
             	foreach($result_su as $r_s) {
              ?>
            <?php
            $tot_sup_quantity += $r_s->item_qty; 
            echo $r_s->item_qty."<br />";
             }}
         } else {
             	echo "<br />";
             } ?>
             </td>



             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo $r_r->purchase_order_receive_bill_no."<br />";
                }
             } else {
             	echo "<br />"; 
             }
         
              ?>
             </td>
             <td>
             <?php
              $result_rcv = $this->db->select('purchase_order_receive.*, purchase_order_receive_detail.id_id')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get_where('purchase_order_receive_detail')->result(); ?>
            <?php if(count($result_rcv) > 0) {
                foreach($result_rcv as $r_r) {
            echo date("d-m-Y", strtotime($r_r->purchase_order_receive_date))."<br />";
            }} else {
            echo "<br />"; 	
             }
              ?>
             </td>
             <td style="text-align: right;">
             <?php
            $result_rc = $this->db->select('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             // ->group_by('purchase_order_receive_detail.purchase_order_receive_id')
             ->get('purchase_order_receive_detail')->result();
             	?>
            <?php
            if(count($result_rc)>0) {
                foreach($result_rc as $r_r) {
            $tot_rcv_quantity += $r_r->item_quantity;
             echo $r_r->item_quantity."<br />";
                }} else {
             	echo "<br />";
             }
          ?>
             </td>
             <td style="text-align: right;">
             	<?php
                
                 $result_pu = $this->db->select_sum('purchase_order_details.pod_quantity')
            ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
             ->where('purchase_order_details.id_id', $rc->id_id)
             ->where('purchase_order_details.po_id', $rc->po_id)
             ->where('purchase_order.status', '1')
             ->group_by('purchase_order_details.po_id, purchase_order_details.id_id')
             ->get_where('purchase_order_details')->row(); ?>
            <?php
            if(count($result_pu) > 0) {
            $pod_quantity = $result_pu->pod_quantity;
             } else {
            $pod_quantity = 0;  	
             }
             
             $result_sup = $this->db->select('supp_purchase_order.*, supp_purchase_order_detail.id_id')
            ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.po_id', $rc->po_id)
             ->where('supp_purchase_order.supp_status', '1')
             ->get_where('supp_purchase_order')->row();
             if(count($result_sup) > 0) {
            $result_su = $this->db->select_sum('supp_purchase_order_detail.item_qty')
            ->join('supp_purchase_order', 'supp_purchase_order.sup_id = supp_purchase_order_detail.sup_id', 'left')
             ->where('supp_purchase_order_detail.id_id', $rc->id_id)
             ->where('supp_purchase_order.sup_id', $result_sup->sup_id)
             ->where('supp_purchase_order_detail.status', '1')
             ->group_by('supp_purchase_order.po_id, supp_purchase_order_detail.id_id')
             ->get_where('supp_purchase_order_detail')->row();
             if(count($result_su) > 0) {
              ?>
            <?php
            $sup_quantity = $result_su->item_qty;
             }
         } else {
             	$sup_quantity = 0;
             }
             
             $result_rc = $this->db->select_sum('purchase_order_receive_detail.item_quantity')
            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
             ->where('purchase_order_receive_detail.id_id', $rc->id_id)
             ->where('purchase_order_receive_detail.po_id', $rc->po_id)
             ->where('purchase_order_receive_detail.status', '1')
             ->group_by('purchase_order_receive_detail.po_id, purchase_order_receive_detail.id_id')
             ->get('purchase_order_receive_detail')->row();
             	?>
            <?php
            if(count($result_rc) > 0) {
            $rcv_quantity = $result_rc->item_quantity;
             } else {
             	$rcv_quantity = 0;
             }
             	?>
            <?php
            $bal_quantity = (($pod_quantity + $sup_quantity) - $rcv_quantity);
            $tot_bal_quantity += $bal_quantity;
             echo $bal_quantity."<br />";
              ?>
             </td>
</tr>
           <?php } ?>
           <tr>
               <th colspan="4">Total</th>
               <th style="text-align: right;"><?= $tot_pod_quantity ?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?= $tot_sup_quantity ?></th>
               <th></th>
               <th></th>
               <th style="text-align: right;"><?= $tot_rcv_quantity ?></th>
               <th style="text-align: right;"><?= $tot_bal_quantity ?></th>
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

<?php if($segment == 'checking_entry_sheet_status'){
		// echo '<pre>',print_r($result),'</pre>';
		
		$temp_co_name_array = array();
		foreach($result as $co_name) {
			if(!in_array($co_name->co_no, $temp_co_name_array)){
				array_push($temp_co_name_array, $co_name->co_no);
			}
		}

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
						<b><?= implode(', ', $temp_co_name_array) ?></b>
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
      while( $current <= $date2 ) {
         $dates[] = date('d-m', $current);
         $current = strtotime($stepVal, $current);
      }
   foreach($dates as $d) {
                            			 ?>
<th style="width: 2%;"><?= $d ?></th>
                            			 <?php 
}
                            			  ?>
										<tr>
                            			<th style="width: 2%;">Emp. Name</th>
                            			<?php
                            			foreach($dates as $d) {
                            			 ?>
<th>Qty</th>
                            			 <?php 
}
                            			  ?>
										</tr>
										<tr>
                            			<th style="width: 2%;">Extra. Time</th>
                            			<?php
                            			foreach($dates as $d) {
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
                                        $new_employee_detail_iter = 0;
                                                // echo '<pre>',print_r($data['result']),'</pre>';

										foreach ($result as $res) {
											if($iter == 4 or $iter == $i1) {
												$i1 = $iter + 4;
											?>
									
									    <?php }
                            $iter++;
									     ?>
                                        <?php
        $result_emp = $this->db->select('departments.department, employees.name')
                         ->join('departments', 'departments.d_id=employees.d_id', 'left')
                         ->join('article_groups', 'article_groups.d_id=departments.d_id', 'left')
                         ->group_by('employees.e_id')
                         ->order_by('employees.name')
                         ->get_where('employees', array('employees.Packing_and_checking' => 1))->result();
        $count_emp = count($result_emp);
        $i = 0;
        $new_employee_detail_iter1 = 0;
                                         ?>
                                         <?php
                    foreach($result_emp as $r_e) {
                        $new_employee_detail_iter++;
                        $new_employee_detail_iter1++;
                    	$i++;
                    	if($new_employee_detail_iter == 30 or $new_employee_detail_iter == 60 or $new_employee_detail_iter == 90 or $new_employee_detail_iter == 120 or $new_employee_detail_iter == 150 or $new_employee_detail_iter == 180 or $new_employee_detail_iter == 210 or $new_employee_detail_iter == 240 or $new_employee_detail_iter == 270 or $new_employee_detail_iter == 300 or $new_employee_detail_iter == 330 or $new_employee_detail_iter == 360 or $new_employee_detail_iter == 390 or $new_employee_detail_iter == 420 or $new_employee_detail_iter == 450 or $new_employee_detail_iter == 480 or $new_employee_detail_iter == 510) { ?>
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
						<b><?= implode(', ', $temp_co_name_array) ?></b>
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
   foreach($dates as $d) {
                            			 ?>
<th style="width: 2%;"><?= $d ?></th>
                            			 <?php 
}
                            			  ?>
										<tr>
                            			<th style="width: 2%;">Emp. Name</th>
                            			<?php
                            			foreach($dates as $d) {
                            			 ?>
<th>Qty</th>
                            			 <?php 
}
                            			  ?>
										</tr>
										<tr>
                            			<th style="width: 2%;">Extra. Time</th>
                            			<?php
                            			foreach($dates as $d) {
                            			 ?>
<th></th>
                            			 <?php 
}
                            			  ?>
										</tr>
									</thead>
									<tbody>
                    	    
                    	<?php }
                                          ?>
											<tr>
												<?php 
                                if($i == 1) {
												 ?>
                                          <td rowspan="<?= $count_emp ?>" style="width: 2%;"><?= $res->co_no ?></td>
                                                <td rowspan="<?= $count_emp ?>" style="width: 3%;"><?= $res->art_no . '<br/>(' . $res->info . ')' ?></td>
                                                <td rowspan="<?= $count_emp ?>" style="width: 2%;"><?= $res->leather_color ?></td>
                                                <td rowspan="<?= $count_emp ?>" style="width: 2%;"><?= $res->co_quantity ?></td>
                                                 <?php 
                                                }
                                                  ?>
                                                  <?php
                                                  
                                if($new_employee_detail_iter == 30 or $new_employee_detail_iter == 60 or $new_employee_detail_iter == 90 or $new_employee_detail_iter == 120 or $new_employee_detail_iter == 150 or $new_employee_detail_iter == 180 or $new_employee_detail_iter == 210 or $new_employee_detail_iter == 240 or $new_employee_detail_iter == 270 or $new_employee_detail_iter == 300 or $new_employee_detail_iter == 330 or $new_employee_detail_iter == 360 or $new_employee_detail_iter == 390 or $new_employee_detail_iter == 420 or $new_employee_detail_iter == 450 or $new_employee_detail_iter == 480 or $new_employee_detail_iter == 510) {
												 ?>
                                          <td rowspan="<?= ($count_emp - ($i-1)) ?>" style="width: 2%;"><?= $res->co_no ?></td>
                                                <td rowspan="<?= ($count_emp - ($i-1)) ?>" style="width: 3%;"><?= $res->art_no . '<br/>(' . $res->info . ')' ?></td>
                                                <td rowspan="<?= ($count_emp - ($i-1)) ?>" style="width: 2%;"><?= $res->leather_color ?></td>
                                                <td rowspan="<?= ($count_emp - ($i-1)) ?>" style="width: 2%;"><?= $res->co_quantity ?></td>
                                                 <?php 
                                                }
                                                  ?>
                            <td style="width: 2%;">
                            	<?= $r_e->name ?>
                            </td>
                            <?php
                            			foreach($dates as $d) {
                            			 ?>
                            			 <td style="width: 2%;"></td>
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


	
	<?php if($segment == 'order_details'){
		// echo '<pre>',print_r($result),'</pre>';
		$temp_co_name_array = array();
		foreach($result as $co_name) {
			if(!in_array($co_name->co_no, $temp_co_name_array)){
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
							<?= implode(', ', $temp_co_name_array) ?>
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
												<th>Qnt. Stock-in-hand</th>
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
										    $qnty_remn= 0;
											$grand_total_qnty_remn = array();
											$grand_total1_qnty_remn = array();
											$qnty_stck= 0;
											$grand_total_qnty_stck = array();
											$grand_total1_qnty_stck = array();
											$grand_total_cut_bill = array();
											$grand_total1_cut_bill = array();
											$grand_total_job_bill = array();
											$grand_total1_job_bill = array();
											 foreach ($result as $res) {
												if(!in_array($res->co_no,$co_array)){
													array_push($co_array, $res->co_no);
													if($order_iter++ == 1){
														// continue;
													}else{
														
														?>
														<tr style="background-color: #d9e2ea;">
															<th colspan="2">Total</th>
															<th class="text-right"><?=array_sum($grand_total1_co_qnty)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_issue)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_bill)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_isu)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_isu)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_job_bill)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_shpd)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_remn)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_stck)?></th>
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
                                         if($show_iter == 26 or $show_iter == $new_show_iter) {
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
							<?= implode(', ', $temp_co_name_array) ?>
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
												<th>Qnt. Stock-in-hand</th>
											</tr>
										</thead>
										<tbody>									
												<?php } ?>
												<tr>
													<th><?= $res->co_no ?></th>
													<td><?= $res->art_no .' ['.$res->color.']' ?></td>
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
						$get_cutter_bill_details = $this->db->get_where('cutter_bill_dtl', array('cut_id' => $res->cut_id, 'cut_rcv_id' => $res->cut_rcv_id, 
						'co_id' => $res->co_id, 'am_id' => $res->am_id, 'leather_color' => $res->c_id))->row();
													?>
													
													<td class="text-right">
													<?php 
												 if(count($get_cutter_bill_details) > 0) {
												     echo number_format($get_cutter_bill_details->original_quantity, 2);
												    array_push($grand_total_cut_bill, $get_cutter_bill_details->original_quantity);
													array_push($grand_total1_cut_bill, $get_cutter_bill_details->original_quantity);
												 } else {
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
						$get_jobber_bill_details = $this->db->get_where('jobber_bill_detail', array('jobber_issue_id' => $res->jobber_issue_id, 'jobber_challan_receipt_id' => $res->jobber_challan_receipt_id, 
						'co_id' => $res->co_id, 'am_id' => $res->am_id, 'lc_id' => $res->c_id))->row();
													?>
													
													<td class="text-right">
													<?php 
												 if(count($get_jobber_bill_details) > 0) {
												     echo number_format($get_jobber_bill_details->quantity, 2);
												    array_push($grand_total_job_bill, $get_jobber_bill_details->quantity);
													array_push($grand_total1_job_bill, $get_jobber_bill_details->quantity);
												 } else {
												     echo '0';
												     array_push($grand_total_job_bill, 0);
													array_push($grand_total1_job_bill, 0);
												 }
													?>
													</td>

													<td class="text-right">
														<?php 
														echo $res->packing_shipment_quantity; 
														array_push($grand_total_qnty_shpd, $res->packing_shipment_quantity);
														array_push($grand_total1_qnty_shpd, $res->packing_shipment_quantity);
														?>
													</td>
													<td class="text-right">
														<?php 
												        $qnty_remn= $res->co_quantity - $res->packing_shipment_quantity;
														echo $qnty_remn; 
														array_push($grand_total_qnty_remn, $qnty_remn);
														array_push($grand_total1_qnty_remn, $qnty_remn);
														?>
													</td>
													<td class="text-right">
														<?php 
												        $qnty_stck= $res->jobber_receive_qnty - $res->packing_shipment_quantity;
														echo $qnty_stck; 
														array_push($grand_total_qnty_stck, $qnty_stck);
														array_push($grand_total1_qnty_stck, $qnty_stck);
														?>
													</td>
												</tr>
												<?php
												$show_iter++;
											} 
											if(end($result)){
													?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="2">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_bill)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_job_bill)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck)?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_bill)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_job_bill)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck)?></th>
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
							<?= implode(', ', $temp_co_name_array) ?>
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
												<th>Qnt. Stock-in-hand</th>
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
										    $qnty_remn= 0;
											$grand_total_qnty_remn = array();
											$grand_total1_qnty_remn = array();
											$qnty_stck= 0;
											$grand_total_qnty_stck = array();
											$grand_total1_qnty_stck = array();
											 foreach ($result as $res) {
											     if(($res->jobber_receive_qnty - $res->packing_shipment_quantity) <= 0) {
											         continue;
											     }
												if(!in_array($res->co_no,$co_array)){
													array_push($co_array, $res->co_no);
													if($order_iter++ == 1){
														// continue;
													}
												}
                                         if($show_iter == 26 or $show_iter == $new_show_iter) {
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
							<?= implode(', ', $temp_co_name_array) ?>
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
												<th>Qnt. Stock-in-hand</th>
											</tr>
										</thead>
										<tbody>									
												<?php } ?>
												<tr>
													<th><?= $res->co_no ?></th>
													<td><?= $res->art_no .' ['.$res->color.']' ?></td>
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
														echo $res->packing_shipment_quantity; 
														array_push($grand_total_qnty_shpd, $res->packing_shipment_quantity);
														array_push($grand_total1_qnty_shpd, $res->packing_shipment_quantity);
														?>
													</td>
													<td class="text-right">
														<?php 
												        $qnty_remn= $res->co_quantity - $res->packing_shipment_quantity;
														echo $qnty_remn; 
														array_push($grand_total_qnty_remn, $qnty_remn);
														array_push($grand_total1_qnty_remn, $qnty_remn);
														?>
													</td>
													<td class="text-right">
														<?php 
												        $qnty_stck= $res->jobber_receive_qnty - $res->packing_shipment_quantity;
														echo $qnty_stck; 
														array_push($grand_total_qnty_stck, $qnty_stck);
														array_push($grand_total1_qnty_stck, $qnty_stck);
														?>
													</td>
												</tr>
												<?php
												$show_iter++;
											} 
											if(end($result)){
													?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="2">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck)?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck)?></th>
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
	
	<?php if($segment == 'outstanding_report') {
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
                            $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;
                            $gtt1=0;$gtt2=0;$gtt3=0;$gtt4=0;$gtt5=0;
                            
                            $groups = array();
                            foreach ($result as $fasd) {
                                foreach ($fasd as $f) {
                                    $key = $f->proforma_number;
                                    if (!isset($groups[$key])) {
                                        $groups[$key] = array(
                                            'proforma_number' => $f->proforma_number,
                                            'total_co_quantity' => $f->co_quantity,
                                            'total_quantity' => $f->quantity,
                                            'minus_quantity' => ($f->co_quantity - $f->quantity),
                                            'rate_foreign' => $f->rate_foreign,
                                            'minus_foreign' => (($f->co_quantity - $f->quantity) * $f->rate_foreign),
                                            'count' => 1,
                                        );
                                    } else {
                                        $groups[$key]['proforma_number'] = $f->proforma_number;
                                        $groups[$key]['total_co_quantity'] += $f->co_quantity;
                                        $groups[$key]['total_quantity'] += $f->quantity;
                                        $groups[$key]['minus_quantity'] += ($f->co_quantity - $f->quantity);
                                        $groups[$key]['rate_foreign'] += $f->rate_foreign;
                                        $groups[$key]['minus_foreign'] += (($f->co_quantity - $f->quantity) * $f->rate_foreign);
                                        $groups[$key]['count'] += 1;
                                    }
                                }
                            }
                            
                            // echo '<pre>', print_r($groups), '</pre>';die();
                            $new_array = array();
                            $count = 0;
                            $new_iterr = 0;
                            foreach ($result as $res) {
                              $count_iter = 0;
                            //   $count_iter = 0;
                            	foreach($res as $curr_key=>$f) {
                            	    
                            	    $keys = array();
                                    foreach($res as $key=>$val) {
                                        if ($val->proforma_number == $f->proforma_number) {
                                            array_push($keys, $key);
                                        }
                                    }
                                    
                                    if(end($keys) == $curr_key) {
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
                            
                            foreach ($result as $res) {
                            	$new_iter = 0;
                            	$count_iter = 0;
                                $count = count($res);
                                
                                // echo '<pre>', print_r($res), '</pre>';die();

                                if($count > 0) {
                            	foreach($res as $curr_key=>$f) {
                            	    
                            	    $keys = array();
                                    foreach($res as $key=>$val) {
                                        if ($val->proforma_number == $f->proforma_number) {
                                            array_push($keys, $key);
                                        }
                                    }
                                    
                                    if(end($keys) == $curr_key) {
                                    $count = ($count + 1);
                                    $new_iter = ($new_iter + 1);
                                    }
                                    
                                // echo '<pre>', print_r($keys), '</pre>';
                            	    
                                    $gt1 += $f->co_quantity;
                                    $gt2 += $f->quantity;
                                    $gt3 += $f->co_quantity - $f->quantity;
                                    $gt4 += ($f->co_quantity - $f->quantity) * $f->rate_foreign;
                                    $gt5 += 0.00;
                                    $gtt1 += $f->co_quantity;
                                    $gtt2 += $f->quantity;
                                    $gtt3 += $f->co_quantity - $f->quantity;
                                    $gtt4 += ($f->co_quantity - $f->quantity) * $f->rate_foreign;
                                    $gtt5 += 0.00;
                                    ?>
                                    <tr>
                                    	<?php
                                    	if($new_iter == 0 or $new_iter == $count) { 
                                    	foreach($new_array as $n_a) {
                                        if($n_a['name'] == $f->name) {
                                          $countt = $n_a['count'];
                                        }
                                    	}
                                    	?>
                                        <td rowspan="<?= $countt ?>"><?= $f->name ?></td>
                                    <?php } ?>
                                        <td><?= $f->proforma_number ?></td>
                                        <td><?= $f->co_no ?></td>
                                        <td><?= $f->department ?></td>
                                        <td><?= $f->co_date ?></td>
                                        <td><?= $f->co_delivery_date ?></td>
                                        <td><?= $f->art_no ?></td>
                                        <td><?= $f->alt_art_no ?></td>
                                        <td><?= $f->color ?></td>
                                        <td style="text-align: right;"><?= $f->co_quantity ?></td>
                                        <?php if($f->quantity != '') { ?>
                                        <td style="text-align: right;"><?= $f->quantity ?></td>
                                        <?php } else { ?>
                                        <td style="text-align: right;">0</td>
                                        <?php } ?>
                                        <td style="text-align: right;"><?= ($f->co_quantity - $f->quantity) ?></td>
                                        <td style="text-align: right;"><?= $f->rate_foreign ?></td>
                                        <td style="text-align: right;"><?= (($f->co_quantity - $f->quantity) * $f->rate_foreign) ?></td>
                                        <td style="text-align: right;">0.00</td>
                                        <td style="text-align: right;">0.00</td>
                                    </tr>   
                                    
                                    <?php
                                    if(end($keys) == $curr_key) {
                                        ?>
                                        <tr>
                                            <th colspan="8">Total for <?= $groups[$f->proforma_number]['proforma_number'] ?></th>
                                            <th style="text-align: right;"><?= number_format($groups[$f->proforma_number]['total_co_quantity'], 2)?></th>
                                            <th style="text-align: right;"><?= number_format($groups[$f->proforma_number]['total_quantity'], 2)?></th>
                                            <th style="text-align: right;"><?= number_format($groups[$f->proforma_number]['minus_quantity'], 2)?></th>
                                            <th style="text-align: right;"><?= number_format($groups[$f->proforma_number]['rate_foreign'], 2)?></th>
                                            <th style="text-align: right;"><?= number_format($groups[$f->proforma_number]['minus_foreign'], 2)?></th>
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
                            <th style="text-align: right;"><?=$gtt1?></th>
                            <th style="text-align: right;"><?=$gtt2?></th>
                            <th style="text-align: right;"><?=$gtt3?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gtt4?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gtt5?></th>
                            </tr>
                            <?php 
                            $gtt1=0;$gtt2=0;$gtt3=0;$gtt4=0;$gtt5=0;
                             ?>
                            <?php 
                            $count = 0;
                            $new_iter = 1;
                            }
                            }
                            ?>
                            <tr class="bg-primary">
                            <th colspan="9">Grand Total</th>
                            <th style="text-align: right;"><?=$gt1?></th>
                            <th style="text-align: right;"><?=$gt2?></th>
                            <th style="text-align: right;"><?=$gt3?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gt4?></th>
                            <th></th>
                            <th style="text-align: right;"><?=$gt5?></th>
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
	
	<?php if($segment == 'buyer_wise_order_details_pending'){
		// echo '<pre>',print_r($result),'</pre>';
		$temp_co_name_array = array();
		foreach($result as $co_name) {
			if(!in_array($co_name->co_no, $temp_co_name_array)){
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
											<th>Qnt. Stock-in-hand</th>
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
										    $qnty_remn= 0;
											$grand_total_qnty_remn = array();
											$grand_total1_qnty_remn = array();
											$qnty_stck= 0;
											$grand_total_qnty_stck = array();
											$grand_total1_qnty_stck = array();
										foreach ($result as $res) {
										    if(($res->co_quantity - $res->packing_shipment_quantity) <= 0) {
										        continue;
										    }
										  //  if($res->user_id != $this->session->user_id) {
										  //      continue;
										  //  }
                                         if($show_iter == 26 or $show_iter == $new_show_iter) {
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
											<th>Qnt. Stock-in-hand</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php } ?>

											<tr>
												<th style="font-size: 16px"><?= $res->name ?></th>
												<th style="font-size: 16px"><?= $res->co_no ?></th>
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
														echo $res->packing_shipment_quantity; 
														array_push($grand_total_qnty_shpd, $res->packing_shipment_quantity);
														array_push($grand_total1_qnty_shpd, $res->packing_shipment_quantity);
														?>
												</td>
												<td class="text-right">
												    <?php 
												        $qnty_remn= $res->co_quantity - $res->packing_shipment_quantity;
														echo $qnty_remn; 
														array_push($grand_total_qnty_remn, $qnty_remn);
														array_push($grand_total1_qnty_remn, $qnty_remn);
														?>
												</td>
												<td class="text-right">
												    <?php 
												        $qnty_stck= $res->jobber_receive_qnty - $res->packing_shipment_quantity;
														echo $qnty_stck; 
														array_push($grand_total_qnty_stck, $qnty_stck);
														array_push($grand_total1_qnty_stck, $qnty_stck);
														?>
												</td>
											</tr>
											<?php
											$show_iter++;
										} 
										if(end($result)){
													?>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="2">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck)?></th>
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
	
	<?php if($segment == 'buyer_wise_order_and_article_details_pending'){
		// echo '<pre>',print_r($result),'</pre>';
		$temp_co_name_array = array();
		foreach($result as $co_name) {
			if(!in_array($co_name->co_no, $temp_co_name_array)){
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
											<th>Qnt. Stock-in-hand</th>
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
										    $qnty_remn= 0;
											$grand_total_qnty_remn = array();
											$grand_total1_qnty_remn = array();
											$qnty_stck= 0;
											$grand_total_qnty_stck = array();
											$grand_total1_qnty_stck = array();
										foreach ($result as $res) {
										    if(($res->co_quantity - $res->packing_shipment_quantity) <= 0) {
										        continue;
										    }
										    if(!in_array($res->co_no,$co_array)){
													array_push($co_array, $res->co_no);
													if($order_iter++ == 1){
														// continue;
													}else{
											?>
											
											<tr style="background-color: #d9e2ea;">
															<th colspan="3">Total</th>
															<th class="text-right"><?=array_sum($grand_total1_co_qnty)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_issue)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_cut_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_isu)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_skv_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_isu)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_rcv)?></th>
															<th class="text-right"><?=array_sum($grand_total1_fab_balc)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_shpd)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_remn)?></th>
															<th class="text-right"><?=array_sum($grand_total1_qnty_stck)?></th>
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
                                         if($show_iter == 26 or $show_iter == $new_show_iter) {
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
											<th>Qnt. Stock-in-hand</th>
										</tr>
									</thead>
									<tbody>
									    
									    <?php } ?>

											<tr>
												<th nowrap style="font-size: 12px"><?= $res->name ?></th>
												<th nowrap style="font-size: 12px"><?= $res->co_no ?></th>
												<td nowrap style="font-size: 12px"><?= $res->art_no .' ['.$res->color.']' ?></td>
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
														echo $res->packing_shipment_quantity; 
														array_push($grand_total_qnty_shpd, $res->packing_shipment_quantity);
														array_push($grand_total1_qnty_shpd, $res->packing_shipment_quantity);
														?>
												</td>
												<td class="text-right">
												    <?php 
												        $qnty_remn= $res->co_quantity - $res->packing_shipment_quantity;
														echo $qnty_remn; 
														array_push($grand_total_qnty_remn, $qnty_remn);
														array_push($grand_total1_qnty_remn, $qnty_remn);
														?>
												</td>
												<td class="text-right">
												    <?php 
												        $qnty_stck= $res->jobber_receive_qnty - $res->packing_shipment_quantity;
														echo $qnty_stck; 
														array_push($grand_total_qnty_stck, $qnty_stck);
														array_push($grand_total1_qnty_stck, $qnty_stck);
														?>
												</td>
											</tr>
											<?php
											$show_iter++;
										} 
										if(end($result)){
													?>
													<tr style="background-color: #d9e2ea;">
														<th colspan="3">Total</th>
														<th class="text-right"><?=array_sum($grand_total1_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total1_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total1_qnty_stck)?></th>
													</tr>
													<tr style="background-color: #445767;
													color: white;">
														<th colspan="3">Grand Total</th>
														<th class="text-right"><?=array_sum($grand_total_co_qnty)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_issue)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_cut_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_skv_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_isu)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_rcv)?></th>
														<th class="text-right"><?=array_sum($grand_total_fab_balc)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_shpd)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_remn)?></th>
														<th class="text-right"><?=array_sum($grand_total_qnty_stck)?></th>
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
	
	<?php if($segment == 'outstanding_report_groupwise') {
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
                                <th style="text-align: right;">Qnty. Ordered</th>
                                <th style="text-align: right;">Qnty. Sold</th>
                                <th style="text-align: right;">Qnty. Balance</th>
                                <th style="text-align: right;">Balance Amount</th>
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
                            $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$new_amnt_blnc_dtls = 0;
                            $gtt1=0;$gtt2=0;$gtt3=0;$gtt4=0;$gtt5=0;
                            
                            $groups = array();
                            foreach ($result as $fasd) {
                                foreach ($fasd as $f) {
                                    $key = $f->proforma_number;
                                    if (!isset($groups[$key])) {
                                        if(($f->co_quantity - $f->quantity) != 0) {
                                            $minus_foreign = (($f->co_quantity - $f->quantity) * $f->rate_foreign);
                                            } else {
                                            $minus_foreign = 0;
                                            }
                                        $groups[$key] = array(
                                            'proforma_number' => $f->proforma_number,
                                            'total_co_quantity' => $f->co_quantity,
                                            'total_quantity' => $f->quantity,
                                            'minus_quantity' => ($f->co_quantity - $f->quantity),
                                            'rate_foreign' => $f->rate_foreign,
                                            'minus_foreign' => $minus_foreign,
                                            'count' => 1,
                                        );
                                    } else {
                                        $groups[$key]['proforma_number'] = $f->proforma_number;
                                        $groups[$key]['total_co_quantity'] += $f->co_quantity;
                                        $groups[$key]['total_quantity'] += $f->quantity;
                                        $groups[$key]['minus_quantity'] += ($f->co_quantity - $f->quantity);
                                        $groups[$key]['rate_foreign'] += $f->rate_foreign;
                                        if(($f->co_quantity - $f->quantity) != 0) {
                                        $groups[$key]['minus_foreign'] += (($f->co_quantity - $f->quantity) * $f->rate_foreign);
                                        } else {
                                        $groups[$key]['minus_foreign'] += 0;    
                                        }
                                        $groups[$key]['count'] += 1;
                                    }
                                }
                            }
                            
                            foreach ($result as $res) {
                            	$new_iter = 0;
                            	$count_iter = 0;
                                $count = count($res);
                                
                                // echo '<pre>', print_r($res), '</pre>';die();

                                if($count > 0) {
                            	foreach($res as $curr_key=>$f) {
                                    
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
                office_invoice_detail.quantity,
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
                LEFT JOIN office_invoice_detail ON office_invoice_detail.co_id = office_proforma_detail.co_id AND office_invoice_detail.am_id = office_proforma_detail.am_id AND office_invoice_detail.lc_id = office_proforma_detail.lc_id 
            WHERE 
            office_proforma.office_proforma_id = $f->office_proforma_id
            AND
                office_proforma.status = 1
            ORDER BY
                office_proforma.proforma_number, customer_order.co_no, article_master.art_no, colors.color";
        $res_result = $this->db->query($query)->result();
        
        foreach($res_result as $r_r) {
            $co_qnty = $r_r->co_quantity;
            $qnty = $r_r->quantity;
            $minus_qnty = ($co_qnty - $qnty);
            if($minus_qnty != 0) {
            $gt4 += ($minus_qnty) * $r_r->rate_foreign;
            $gtt4 += ($minus_qnty) * $r_r->rate_foreign;
            $new_amnt_blnc_dtls += ($minus_qnty) * $r_r->rate_foreign;
            } else {
            $gt4 +=  0;
            $gtt4 +=  0;
            $new_amnt_blnc_dtls += 0;
            }
            
        }
                                

                                    $gt1 += $f->co_quantity;
                                    $gt2 += $f->quantity;
                                    $gt3 += $f->co_quantity - $f->quantity;
                                    $gt5 += 0.00;
                                    $gtt1 += $f->co_quantity;
                                    $gtt2 += $f->quantity;
                                    $gtt3 += $f->co_quantity - $f->quantity;
                                    $gtt5 += 0.00;
                                    ?>
                                    
                                    <tr>
                                    	<?php if($new_iter == 0) { ?>
                                        <td rowspan="<?= $count ?>"><?= $f->name ?></td>
                                    <?php } ?>
                                        <td><?= $f->proforma_number ?></td>
                                        <?php 
                                        $proforma_cus_ord_no = $this->db->select('customer_order.co_no')
                                        ->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left')
                                        ->group_by('office_proforma_detail.co_id')
                                        ->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $f->office_proforma_id))->result();
                                        ?>
                                        <td><?php 
                                        foreach($proforma_cus_ord_no as $f_c_o_n) {
                                        echo $f_c_o_n->co_no."<br/>" ?>
                                        <?php } ?>
                                        </td>
                                        <td style="text-align: right;"><?= $f->co_quantity ?></td>
                                        <?php if($f->quantity != '') { ?>
                                        <td style="text-align: right;"><?= $f->quantity ?></td>
                                        <?php } else { ?>
                                        <td style="text-align: right;">0</td>
                                        <?php } ?>
                                        <td style="text-align: right;"><?= ($f->co_quantity - $f->quantity) ?></td>
                                        <td style="text-align: right;"><?= $new_amnt_blnc_dtls ?></td>
                                        <td style="text-align: right;">0.00</td>
                                        <?php $new_amnt_blnc_dtls = 0; ?>
                                    </tr>   

                                <?php
                                $new_iter++;
                            } ?>
                            <tr class="bg-info">
                            <th colspan="3">Total</th>
                            <th style="text-align: right;"><?=$gtt1?></th>
                            <th style="text-align: right;"><?=$gtt2?></th>
                            <th style="text-align: right;"><?=$gtt3?></th>
                            <th style="text-align: right;"><?=$gtt4?></th>
                            <th style="text-align: right;"><?=$gtt5?></th>
                            </tr>
                            <?php 
                            $gtt1=0;$gtt2=0;$gtt3=0;$gtt4=0;$gtt5=0;
                             ?>
                            <?php 
                            $count = 0;
                            $new_iter = 1;
                            }
                            }
                            ?>
                            <tr class="bg-primary">
                            <th colspan="3">Grand Total</th>
                            <th style="text-align: right;"><?=$gt1?></th>
                            <th style="text-align: right;"><?=$gt2?></th>
                            <th style="text-align: right;"><?=$gt3?></th>
                            <th style="text-align: right;"><?=$gt4?></th>
                            <th style="text-align: right;"><?=$gt5?></th>
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
	
	<?php if($segment == 'checking_stock_summary_status') {
		// echo '<pre>',print_r($result),'</pre>';
		$temp_co_name_array1 = array();
		foreach($result as $co_name) {
			if(!in_array($co_name['group_name'], $temp_co_name_array1)){
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
		</style>
		
		<body class="A3 landscape" style="overflow-x: auto; padding-top: 2px;">
        <div id="page-content">
		<section class="sheet padding-5mm" style="height: auto">
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
					  <b><?= implode(', ', $temp_co_name_array1) ?></b>
					  <br/>
					  From <b><?= date("d-m-Y", strtotime($from)) ?></b> To <b><?= date("d-m-Y", strtotime($to)) ?></b>
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
                            <th rowspan="2" style="text-align:center">Item</th>
                            <th colspan="2" style="text-align:center">Opening Information</th>
                            <th colspan="2" style="text-align:center">Purchase Information</th>
                            <th colspan="2" style="text-align:center">Issue Information</th>
                            <th colspan ="2" style="text-align:center">Stock In Information</th>
                            <th colspan ="2" style="text-align:center">Balance Information</th>
                            <th rowspan="2">Closing Rate</th>
                        </tr>
                        <tr>
                            <th style="text-align:center">Opn Qnty</th>
                            <th style="text-align:center">Opn Val</th>
                            <th style="text-align:center">Pur Qnty</th>
                            <th style="text-align:center">Pur Val</th>
                            <th style="text-align:center">Issue Qnty</th>
                            <th style="text-align:center">Issue Val</th>
                            <th style="text-align:center">Stock In Qnty</th>
                            <th style="text-align:center">Stock In Val</th>
                            <th style="text-align:center">Bal Qnty</th>
                            <th style="text-align:center">Bal Val</th>
                        </tr>
                        </thead>
									<tbody>
										<?php
                        $all_bal_qty = 0; $all_opn_qty =0; $all_pur_qty = 0; $all_issue_qty =0; $all_stockin_qty =0;
                        $all_bal_rate = 0; $all_opn_rate =0; $all_pur_rate = 0; $all_issue_rate =0; $all_stockin_rate =0; $closing_rate = 0;
                        foreach ($result as $f) {
                            
                            if($f['opening_qnty'] == 0 && $f['purchase_qnty'] == 0 && $f['issue_qnty'] == 0) {
                                continue;
                            }
                            
                            $bal_qty = $f['opening_qnty'] + $f['purchase_qnty'] - $f['issue_qnty'] + $f['stock_in_qnty'];
                            $bal_rate = $f['opening_val'] + $f['purchase_val'] - $f['issue_val'] + $f['stock_in_val'];

                            $all_opn_qty += $f['opening_qnty'];
                            $all_opn_rate += $f['opening_val'];
                            $all_pur_qty += $f['purchase_qnty'];
                            $all_pur_rate += $f['purchase_val'];
                            $all_issue_qty += $f['issue_qnty'];
                            $all_issue_rate += $f['issue_val'];
                            $all_stockin_qty += $f['stock_in_qnty'];
                            $all_stockin_rate += $f['stock_in_val'];
                            $all_bal_qty += $bal_qty;
                            $all_bal_rate += $bal_rate;
                            ?>
                            <tr>
                                <th><?= $f['item'] . '('. $f['color'] .')' ?></th>
                                <td style="text-align:right"><?= number_format($f['opening_qnty'],2) ?></td>
                                <td style="text-align:right"><?= number_format($f['opening_val'],2) ?></td>
                                <td style="text-align:right"><?=  number_format($f['purchase_qnty'],2) ?></td>
                                <td style="text-align:right"><?= number_format($f['purchase_val'],2) ?></td>
                                <td style="text-align:right"><?=  number_format($f['issue_qnty'],2) ?></td>
                                <td style="text-align:right"><?= number_format($f['issue_val'],2) ?></td>
                                <td style="text-align:right"><?=  number_format($f['stock_in_qnty'],2) ?></td>
                                <td style="text-align:right"><?= number_format($f['stock_in_val'],2) ?></td>
                                <td style="text-align:right"><?= number_format($bal_qty,2)?></td>
                                <td style="text-align:right"><?= number_format($bal_rate,2) ?></td>
                                <?php if($bal_qty != 0) { 
                                	$closing_rate += ($bal_rate/$bal_qty); 
                                ?>
                                <td style="text-align:right"><?= number_format(($bal_rate/$bal_qty),2) ?></td>
                            <?php } else {
                                    $closing_rate += 0;
                             ?>
                                <td style="text-align:right">0</td>
                            <?php } ?>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                        	<th>Total</th>
                        	<td style="text-align:right"><?= number_format($all_opn_qty, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_opn_rate, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_pur_qty, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_pur_rate, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_issue_qty, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_issue_rate, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_stockin_qty, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_stockin_rate, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_bal_qty, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($all_bal_rate, 2) ?></td>
                        	<td style="text-align:right"><?= number_format($closing_rate, 2) ?></td>
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
	
	<?php if($segment == 'ot_details' ) {
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
                                        Month: <?= $mont ?><br />
                                        Date: <?= date('d-m-Y') ?><br />
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
                            $ot_hours  = 0;
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
                            if(count($result) > 0) {
                                foreach($result as $res){
                                    foreach($res as $a){
                                    ?>
                                    <tr>
                                        <td style="width: 20px;"><?= $iter++ ?></td>
                                        <td style="width: 140px;"><?= $a->name ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_rate; $ot_rate += $a->ot_rate; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->ot_hours; $ot_hours += $a->ot_hours; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->ot_total), 2); $ot_total += $a->ot_total;  ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo $a->factory_act_ot_hrs_max; $factory_act_ot_hrs_max += $a->factory_act_ot_hrs_max; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php if($a->balance_ot_hrs > 0) { echo $a->balance_ot_hrs; $balance_ot_hrs += $a->balance_ot_hrs; } else { echo 0; $balance_ot_hrs += 0; } ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->factory_ot), 2); $factory_ot += $a->factory_ot; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php $p_bonus = (round($a->ot_total) - round($a->factory_ot)); echo number_format(round($p_bonus), 2); $bonus += $p_bonus; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->with_bonus_amnt), 2); $with_bonus_amnt += $a->with_bonus_amnt ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->esi), 2); $esi += $a->esi ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->advance), 2); $advance += $a->advance ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->deduction_total), 2); $deduction_total += $a->deduction_total; ?></td>
                                        <td style="text-align: right; width: 20px;"><?php echo number_format(round($a->net_pay), 2); $net_pay += $a->net_pay; ?></td>
                                        <td style="height: 50px;"></td>
                                    </tr>
                                    <?php
                                }
                                }
                                }
                                ?>
                                <tr>
                                        <th colspan="2">Grand Total</th>
                                        <td style="text-align: right;"><?= $ot_rate ?></td>
                                        <td style="text-align: right;"><?= $ot_hours ?></td>
                                        <td style="text-align: right;"><?= number_format(round($ot_total), 2) ?></td>
                                        <td style="text-align: right;"><?= $factory_act_ot_hrs_max ?></td>
                                        <td style="text-align: right;"><?= $balance_ot_hrs ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($factory_ot), 2);  ?></td>
                                        <td style="text-align: right;"><?php echo number_format(round($bonus), 2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($with_bonus_amnt, 2);  ?></td>
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
	
	<?php if ($segment == 'emp_pay_slip_section')
{
    // echo '<pre>',print_r($result),'</pre>';
    
?>
		<style>
			@media print{@page {size: landscape}}
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 0px;
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
					<div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
						<h4 class="mar_0">Wages Pat Sheet Under The Payment of Wages Rule</h4>
					</div>
					<div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
						<h4 class="mar_0" style="font-weight: bold;">Salary Pay Slip for the Month of
						<?php $Array_sal = explode('~', $month); ?>
						    <?=$Array_sal[0] ?> - 
			    <?php 
				$month_new = $month;
                $wordArray = explode('~', $month);
                if($wordArray[2] < 4) {
                ?>
                <?=date('Y') ?>
                <?php } else { ?>
                <?php echo '2022'; ?>
                <?php } ?>
						</h4>
					</div>
					<div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					 <div class="row">
					     <div class="col-sm-2">
					         <h5 style="font-weight: bold;">Contractor Name</h5>
					     </div>
					     <div class="col-sm-10">
					         <h5><?= $result->contractor_name ?></h5>
					     </div>
					 </div>
					 <div class="row">
					     <div class="col-sm-2">
					         <h5 style="font-weight: bold;">Address</h5>
					     </div>
					     <div class="col-sm-10">
					         <h5><?= $result->contractor_address ?></h5>
					     </div>
					 </div>
					</div>
					<div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					 <div class="row">
					     <div class="col-sm-4">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">Employee Code no.</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->e_code ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-4">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">Employee Name</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->employee_name ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-4">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">Department</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->department ?></h5> 
					             </div>
					         </div>
					         </div>
					     </div>
					 </div>
					 <div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					 <div class="row">
					     <div class="col-sm-2">
					         <h5 style="font-weight: bold;">Father's / Husband's Name</h5>
					     </div>
					     <div class="col-sm-10">
					         <h5><?= $result->father_name ?></h5>
					     </div>
					 </div>
					 <div class="row">
					     <div class="col-sm-2">
					         <h5 style="font-weight: bold;">Employee Address</h5>
					     </div>
					     <div class="col-sm-10">
					         <h5><?= $result->employee_adress ?></h5>
					     </div>
					 </div>
					</div>
					<div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					 <div class="row">
					     <div class="col-sm-3">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">No. of Working Days</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->T1 ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-3">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">No of Days Worked</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->T2 ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-3">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">No of Holidays</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->T3 ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-3">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">No of Leave</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->T4 + $result->T5 + $result->T6 ?></h5> 
					             </div>
					         </div>
					         </div>
					     </div>
					 </div>
					 <div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					  <div class="row">
					      <div class="col-sm-5">
					          <h5><u>EARNINGS</u></h5>
					          <div class="row">
					              <div class="col-sm-7">
					                  <h5 style="font-weight: bold;">Daily Rate</h5>
					                  <h5 style="font-weight: bold;">Wages Earned</h5>
					                  <h5 style="font-weight: bold;">H.R.Allowance</h5>
					              </div>
					              <div class="col-sm-5">
					                  <h5><?= $result->cutting_rate ?></h5>
					                  <h5><?= $result->BASIC ?></h5>
					                  <h5><?= $result->HRAAMT ?></h5>
					              </div>
					          </div>
					      </div>
					      <div class="col-sm-5">
					          <h5><u>DEDUCTION</u></h5>
					          <div class="row">
					              <div class="col-sm-7">
					                  <h5 style="font-weight: bold;">Provident Fund</h5>
					                  <h5 style="font-weight: bold;">E.S.I</h5>
					                  <h5 style="font-weight: bold;">Professional Tax</h5>
					                  <h5 style="font-weight: bold;">Loans & Advance</h5>
					              </div>
					              <div class="col-sm-5">
					                  <h5><?= $result->PFAMT ?></h5>
					                  <h5><?= $result->ESIAMT ?></h5>
					                  <h5><?= $result->TAX ?></h5>
					                  <h5><?= $result->LOAN ?></h5>
					              </div>
					          </div>
					      </div>
					  </div>
					 </div>
					 <div class="col-sm-12 border_all text-center" style="border-bottom: 1px solid black;">
					 <div class="row">
					     <div class="col-sm-6">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">Gross Salary</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->GROSS ?></h5> 
					             </div>
					         </div>
					         </div>
					         <div class="col-sm-6">
					         <div class="row">
					             <div class="col-sm-7">
					                <h5 style="font-weight: bold;">Gross Deduction</h5> 
					             </div>
					             <div class="col-sm-5">
					                <h5><?= $result->DEDUC ?></h5> 
					             </div>
					         </div>
					         </div>
					     </div>
					 </div>
					 <div class="row">
					     <div class="col-sm-6">
					         <div class="row">
					             <div class="col-sm-5" style="text-align: right;">
					                 <h5 style="font-weight: bold;">Net Salary Payable</h5>
					             </div>
					             <div class="col-sm-7" style="text-align: left;">
					                 <h5><?= $result->NET ?></h5>
					             </div>
					         </div>
					     </div>
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

</html>