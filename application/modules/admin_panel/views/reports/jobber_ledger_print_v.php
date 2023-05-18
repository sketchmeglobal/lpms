<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ORDER STATUS</title>
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
                        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                        .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                        .border-bottom{border-bottom:  1px solid #000}.text-center{text-align: center!important;}.text-right{text-align: right!important;}
                    }
    </style>
</head>
<body>
                            <div class="A4 landscape" id="page-content">

    <?php if(isset($fetch_all_jobber_report)) {
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
                    <h3 class="mar_0 head_font">Jobber Ledger Details</h3>
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
                                <table class="table" border="1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Article Name</th>
                                            <th>Ord. Number</th>
                                            <th>Issue Challan</th>
                                            <th>Issue Date</th>
                                            <th>Issue Qnty.</th>
                                            <th>Rcpt. Name</th>
                                            <th>Rcpt. Date</th>
                                            <th>Rcpt. Qnty</th>
                                            <th>Bal Qnty</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    if($job_type == 'n_zero') { ?>
                                    <tbody>
                                       <?php foreach ($fetch_all_jobber_report as $fajr) {
                                        $sum = ($fajr->jobber_issue_qnty  -  $fajr->jobber_rcv_qnty);
                                        if($fajr->jobber_difference != 0) {
                              ?>
<tr>
   <td><?= $fajr->jobber_art_no ?>[<?= $fajr->jobber_info ?>]</td> 
   <td><?= $fajr->jobber_cust_order_no ?></td>
   <td><?= $fajr->job_challan_no ?></td>
   <td><?= date('d-m-Y', strtotime($fajr->job_issue_date)) ?></td>
   <td><?= $fajr->jobber_issue_qnty ?></td>
   <?php $recp_row = $this->db->join('jobber_challan_receipt', 'jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id', 'left')
   ->get_where('jobber_challan_receipt_details', array('jobber_challan_number' => $fajr->jobber_issue_id))->result();
    ?>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receipt_challan_number ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receipt_challan_date ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receive_quantity ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <?php $sum = ($fajr->jobber_issue_qnty  -  $fajr->jobber_rcv_qnty) ?>
   <td><?=  $sum?></td>
</tr>
                             <?php }} ?> 
                                    </tbody>
                                <?php } else { ?>
        <tbody>
                                       <?php foreach ($fetch_all_jobber_report as $fajr) {
                                        if($fajr->jobber_difference == 0) {
                              ?>
<tr>
   <td><?= $fajr->jobber_art_no ?>[<?= $fajr->jobber_info ?>]</td> 
   <td><?= $fajr->jobber_cust_order_no ?></td>
   <td><?= $fajr->job_challan_no ?></td>
   <td><?= date('d-m-Y', strtotime($fajr->job_issue_date))  ?></td>
   <td><?= $fajr->jobber_issue_qnty ?></td>
   <?php $recp_row = $this->db->join('jobber_challan_receipt', 'jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id', 'left')
   ->get_where('jobber_challan_receipt_details', array('jobber_challan_number' => $fajr->jobber_issue_id))->result();
    ?>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receipt_challan_number ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receipt_challan_date ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <td>
     <?php if(isset($recp_row)) {
        if(count($recp_row) > 0) {
       foreach($recp_row as $rr) {
      ?>
      <p><?= $rr->jobber_receive_quantity ?></p>
     <?php }} else {?>
<p>-</p>
 <?php }} ?>
   </td>
   <?php $sum = ($fajr->jobber_issue_qnty  -  $fajr->jobber_rcv_qnty) ?>
   <td><?=  $sum?></td>
</tr>
                             <?php }} ?> 
                                    </tbody>
                                <?php } ?>
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
</html>