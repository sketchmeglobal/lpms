<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>PAYROLL REGISTER</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
        <style>
            body{
                font-family: 'Signika', sans-serif;
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
            @media print{@page {size: A3 landscape;}}
			body.A3.landscape .sheet {
				width: 500mm;
			}
			
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
				padding: 5px; text-align: left; font-size: 12px; vertical-align: middle; }
        </style>
    </head>
    <body class="A4 landscape">
    <?php 
    $contractor_arr = array();
    if($segment == 'payroll_register' ) {
    // echo '<pre>',print_r($result),'</pre>';
    ?>
    <?php include('header_component.php') ?>
    <?php
		$new_iter = 10;
		$total_count = 0;
		$new_iter1 = 9;
		$iter = 1;
		$total_pcs_wages_earnd = $sa_total_pcs_wages_earnd = 0;
		$total_BASIC1 = 0;
		$total_DA1 = 0;
		$total_HRA11 = 0;
		$total_CONV11 = 0;
		$total_OA11 = 0;
		$total_HRA12 = 0;
		$total_CONV12 = 0;
		$total_OA12 = 0;
		$total_TOTAL1 = $sa_total_TOTAL1 = 0;
		$total_BASIC2 = $sa_total_BASIC2 = 0;
		$total_TOTAL2 = 0;
		$total_DA2 = 0;
		$total_TOTAL22 = 0;
		$total_HRA = 0;
		$total_CONV = 0;
		$total_MED = 0;
		$total_OA = 0;
		$total_GROSS = 0;
		$total_PFAMT = $sa_total_PFAMT = 0;
		$total_ESIAMT = $sa_total_ESIAMT = 0;
		$total_TAX = $sa_total_TAX = 0;
		$total_INS = 0;
		$total_LOAN = $sa_total_LOAN = 0;
		$total_DEDUC = $sa_total_DEDUC = 0;
		$total_NET = $sa_total_NET = 0;
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

		$total_days_worked = 0;
		$total_holiday_and_leave = 0;
		$total_absent = 0;
		$total_of_total= 0 ;
		$total_parts_of_cut = $sa_total_parts_of_cut = 0;
		$total_rate_of_cut = $sa_total_rate_of_cut = 0;
		$total_pay_for_holiday = $sa_total_pay_for_holiday = 0;
		$total_pay_for_leave = $sa_total_pay_for_leave = 0;
        $sa_total_of_pay_total = 0;

		if(isset($result)) {
			foreach($result as $res){
				foreach($res as $r){
					//echo '<pre>', print_r($r), '</pre>';
					if($res != '') {
						$total_count = count($result); 
					}
					if($iter == 10 or $iter == $new_iter) {
						$new_iter += 9;
					}
					if(!in_array($r->contractor_name, $contractor_arr)){ 
						array_push($contractor_arr, $r->contractor_name);
						if(count($contractor_arr) > 1){
							?>
							<tr style="background:#d5e6ee">
								<th style="text-align:center" colspan="6">Contractor Total For <?= ($contractor_arr[count($contractor_arr) - 2]) ?></th>
								<th style="text-align:right">
									<?php 
										echo $sub_total_cut = $total_parts_of_cut - $sa_total_parts_of_cut;
										$sa_total_parts_of_cut = $total_parts_of_cut;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_rate = $total_rate_of_cut - $sa_total_rate_of_cut;
										echo number_format((float)$sub_tot_rate, 2, '.', '');
										$sa_total_rate_of_cut = $total_rate_of_cut;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_pcs_wages_earnd = $total_pcs_wages_earnd - $sa_total_pcs_wages_earnd;
										echo number_format((float)$sub_tot_pcs_wages_earnd, 2, '.', ''); 
										$sa_total_pcs_wages_earnd = $total_pcs_wages_earnd;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_total_hol_pay = $total_pay_for_holiday - $sa_total_pay_for_holiday;
										echo number_format((float)$sub_total_hol_pay, 2, '.', '');
										$sa_total_pay_for_holiday = $total_pay_for_holiday;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_total_leave_pay = $total_pay_for_leave - $sa_total_pay_for_leave;
										echo number_format((float)$sub_total_leave_pay, 2, '.', '');
										$sa_total_pay_for_leave = $total_pay_for_leave;
									?>
								</th>
								<th style="text-align:right">
									<?= number_format((float)($sub_tot_pcs_wages_earnd + $sub_total_hol_pay + $sub_total_leave_pay), 2, '.', '')?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_TOTAL1 = $total_TOTAL1 - $sa_total_TOTAL1;
										echo number_format((float)$sub_tot_TOTAL1, 2, '.', '');
										$sa_total_TOTAL1 = $total_TOTAL1;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_BASIC2 =  $total_BASIC2 - $sa_total_BASIC2;
										echo number_format((float)$sub_tot_BASIC2, 2, '.', '');
										$sa_total_BASIC2 = $total_BASIC2;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_PFAMT = $total_PFAMT - $sa_total_PFAMT;
										echo number_format((float)$sub_tot_PFAMT, 2, '.', '');
										$sa_total_PFAMT = $total_PFAMT;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_ESIAMT = $total_ESIAMT - $sa_total_ESIAMT;
										echo number_format((float)$sub_tot_ESIAMT, 2, '.', '');
										$sa_total_ESIAMT = $total_ESIAMT;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_TAX =  $total_TAX - $sa_total_TAX;
										echo number_format((float)$sub_tot_TAX, 2, '.', '');
										$sa_total_TAX = $total_TAX;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_LOAN = $total_LOAN - $sa_total_LOAN;
										echo number_format((float)$sub_tot_LOAN, 2, '.', '');
										$sa_total_LOAN = $total_LOAN;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_DEDUC = $total_DEDUC - $sa_total_DEDUC;
										echo number_format((float)$sub_tot_DEDUC, 2, '.', '');
										$sa_total_DEDUC = $total_DEDUC;
									?>
								</th>
								<th style="text-align:right">
									<?php 
										$sub_tot_NET = $total_NET - $sa_total_NET;
										echo number_format((float)$sub_tot_NET, 2, '.', '');
										$sa_total_NET = $total_NET;
									?>
								</th>

							</tr>
							<?php
							include('footer_component.php');
							include('header_component.php');
						}
                        ?>
                        <tr>
                            <th colspan="6" style="text-align:center; background: #b7f4dd;">Contractor: <?=$r->contractor_name?></th>
                        </tr>
                        <?php
					} 
					?>
                                
					<tr>
						<td style="text-align: center;"><?= $iter ?></td>
						<!-- <td class="text-left">< ?= $r->contractor_name ?></td>  -->
						<td style="text-align: center;"><?= $r->e_code ?></td>
						<td class="text-left"><?= $r->name ?></td>
						<td style="text-align: center;"><?php $total_days_worked += $r->T2; echo $r->T2; ?></td>
						<td style="text-align: center;"><?php $total_holiday_and_leave += ($r->T3 + $r->T); echo $r->T3 + $r->T ?></td>
						<!-- <td style="text-align: center;">< ?php $total_absent += $r->T7; echo $r->T7; ?></td> -->
						<td style="text-align: center;"><?php $total_of_total += ($r->T2 + $r->T3 + $r->T); echo ($r->T2 + $r->T3 + $r->T); ?></td>
						
						<td style="text-align: center;"><?php $tpcc = $r->no_of_part; $total_parts_of_cut += $tpcc; echo $tpcc; ?></td>
						<td style="text-align: center;">
							<?php 
							echo (float)$r->rate_per_part; $total_rate_of_cut += $r->rate_per_part; 
							?>
						</td>
						<td style="text-align: right;">
							<?php 
								$all_pcs_wages_earnd = $tpcc * (float)$r->rate_per_part; 
								$total_pcs_wages_earnd += $all_pcs_wages_earnd;
								echo number_format($all_pcs_wages_earnd, 2);
							?>
						</td>
						
						
						<td style="text-align: right;">
							<?php 
								echo $pfh = $r->pay_for_holiday;
								$total_HRA11 += $r->TOTAL2; $total_HRA111 += $r->TOTAL2;
								$total_pay_for_holiday += $pfh;
							?>
						</td>
						<td style="text-align: right;">
						<?php 
							echo $pfl = $r->pay_for_leave;
							$total_HRA11 += $r->TOTAL2; $total_HRA111 += $r->TOTAL2;
							$total_pay_for_leave += $pfl;
						?>
						</td>
						<td style="text-align: right;"><?php echo $all_pcs_wages_earnd + $pfh + $pfl?></td>
						
						<td style="text-align: right;"><?php echo number_format((float)$r->HRAAMT, 2);
						$total_TOTAL1 += $r->HRAAMT; $total_TOTAL11 += $r->HRAAMT;
						?></td>
						<td style="text-align: right;"><?php echo number_format((float)$r->GROSS, 2);
						$total_BASIC2 += $r->GROSS; $total_BASIC21 += $r->GROSS;
						?></td>
						<td style="text-align: right;"><?php echo number_format((float)$r->PFAMT, 2);
						$total_PFAMT += $r->PFAMT; $total_PFAMT1 += $r->PFAMT;
						?></td>
						<td style="text-align: right;"><?php echo number_format((float)$r->ESIAMT, 2);
						$total_ESIAMT += $r->ESIAMT; $total_ESIAMT1 += $r->ESIAMT;
						?></td>
						<td style="text-align: right;"><?php echo number_format((float)$r->TAX, 2);
						$total_TAX += $r->TAX; $total_TAX1 += $r->TAX;
						?></td>
						<td style="text-align: right;"><?php echo number_format((float)$r->LOAN, 2);
						$total_LOAN += $r->LOAN; $total_LOAN1 += $r->LOAN;
						?></td>
						<td style="text-align: right;">
						<?php 
							echo number_format((float)($r->DEDUC - $r->INS), 2);
							$total_DEDUC += ($r->DEDUC - $r->INS); 
							$total_DEDUC1 += ($r->DEDUC - $r->INS);
						?>
						</td>
						<td style="text-align: right;">
						<?php 
							echo number_format((float)($r->NET - $r->INS), 2);
							$total_NET += ($r->NET - $r->INS); $total_NET1 += ($r->NET - $r->INS);
						?>
						</td>
						<td style="text-align: right; height: 100px; width: 100px;"></td>
					</tr>
					
					<?php if($iter == $total_count) { ?>
					
						<tr style="background:#d5e6ee">
							<th style="text-align:center" colspan="6">Contractor Total For <?= ($contractor_arr[count($contractor_arr) - 1]) ?></th>
							<th style="text-align:right">
								<?php 
									echo $sub_total_cut = $total_parts_of_cut - $sa_total_parts_of_cut;
									$sa_total_parts_of_cut = $total_parts_of_cut;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_rate = $total_rate_of_cut - $sa_total_rate_of_cut;
									echo number_format((float)$sub_tot_rate, 2, '.', '');
									$sa_total_rate_of_cut = $total_rate_of_cut;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_pcs_wages_earnd = $total_pcs_wages_earnd - $sa_total_pcs_wages_earnd;
									echo number_format((float)$sub_tot_pcs_wages_earnd, 2, '.', ''); 
									$sa_total_pcs_wages_earnd = $total_pcs_wages_earnd;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_total_hol_pay = $total_pay_for_holiday - $sa_total_pay_for_holiday;
									echo number_format((float)$sub_total_hol_pay, 2, '.', '');
									$sa_total_pay_for_holiday = $total_pay_for_holiday;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_total_leave_pay = $total_pay_for_leave - $sa_total_pay_for_leave;
									echo number_format((float)$sub_total_leave_pay, 2, '.', '');
									$sa_total_pay_for_leave = $total_pay_for_leave;
								?>
							</th>
							<th style="text-align:right">
                                <?= ($sub_tot_pcs_wages_earnd+$sub_total_hol_pay+$sub_total_leave_pay) ?>
							</th>
							<th style="text-align:right"> <!-- HRA -->
								<?php 
									$sub_tot_TOTAL1 = $total_TOTAL1 - $sa_total_TOTAL1;
									echo number_format((float)$sub_tot_TOTAL1, 2, '.', '');
									$sa_total_TOTAL1 = $total_TOTAL1;
								?>
							</th>
							<th style="text-align:right"> <!-- GROSS -->
								<?php 
									$sub_tot_BASIC2 =  $total_BASIC2 - $sa_total_BASIC2;
									echo number_format((float)$sub_tot_BASIC2, 2, '.', '');
									$sa_total_BASIC2 = $total_BASIC2;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_PFAMT = $total_PFAMT - $sa_total_PFAMT;
									echo number_format((float)$sub_tot_PFAMT, 2, '.', '');
									$sa_total_PFAMT = $total_PFAMT;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_ESIAMT = $total_ESIAMT - $sa_total_ESIAMT;
									echo number_format((float)$sub_tot_ESIAMT, 2, '.', '');
									$sa_total_ESIAMT = $total_ESIAMT;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_TAX =  $total_TAX - $sa_total_TAX;
									echo number_format((float)$sub_tot_TAX, 2, '.', '');
									$sa_total_TAX = $total_TAX;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_LOAN = $total_LOAN - $sa_total_LOAN;
									echo number_format((float)$sub_tot_LOAN, 2, '.', '');
									$sa_total_LOAN = $total_LOAN;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_DEDUC = $total_DEDUC - $sa_total_DEDUC;
									echo number_format((float)$sub_tot_DEDUC, 2, '.', '');
									$sa_total_DEDUC = $total_DEDUC;
								?>
							</th>
							<th style="text-align:right">
								<?php 
									$sub_tot_NET = $total_NET - $sa_total_NET;
									echo number_format((float)$sub_tot_NET, 2, '.', '');
									$sa_total_NET = $total_NET;
								?>
							</th>

						</tr>

						<tr>
							<th colspan="6">Grand Total</th>
							<!-- <th style="text-align: right;"><?=$total_days_worked?></th> -->
							<!-- <th style="text-align: right;"><?=$total_holiday_and_leave?></th> -->
							<!-- <th style="text-align: right;">< ?=$total_absent?></th> -->
							<!-- <th style="text-align: right;"><?=$total_of_total?></th> -->
							<th style="text-align: right;"><?=$total_parts_of_cut?></th>
							<th style="text-align: right;"><?=$total_rate_of_cut?></th>
							<th style="text-align: right;"><?= $total_pcs_wages_earnd ?></th>
							<th style="text-align: right;"><?=$total_pay_for_holiday?></th>
							<th style="text-align: right;"><?=$total_pay_for_leave?></th>
							<th style="text-align: right;"><?=$total_pcs_wages_earnd + $total_pay_for_holiday + $total_pay_for_leave?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_TOTAL11, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_BASIC21, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_PFAMT1, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_ESIAMT1, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_TAX1, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_LOAN1, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_DEDUC1, 2)
							; 
							?></th>
							<th style="text-align: right;"><?php echo number_format((float)$total_NET1, 2)
							; 
							?></th>
							<th style="text-align: right;"></th>
						</tr>
					
					<?php 
                    // include_once('footer_component.php');
					} 
					$iter++;
				}
			}
		}
	}
    include('footer_component.php'); 
    ?>
    </body>
</html>