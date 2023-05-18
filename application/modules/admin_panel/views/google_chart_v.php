<!DOCTYPE html>
<html lang="en">
<head>
    <title>Google Chart | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        text-align: right;
        }

        /* Firefox */
        input[type=number] {
            text-align: right;
            -moz-appearance: textfield;
        }

        .border-black-bottom{border-bottom: 1px dotted #000}
        .nowrap{white-space: nowrap;}

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff} 
    </style>

</head>

<body class="sticky-header">

<section>
    <!-- sidebar left start (Menu)-->
    <?php $this->load->view('components/left_sidebar'); //left side menu ?>
    <!-- sidebar left end (Menu)-->

    <!-- body content start-->
    <div class="body-content" style="min-height: 1500px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">Google Charts</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Google Chart </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">
        	<div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">Month Wise Order And Invoice Details</h3>
                    </div>
                    <div class="col-md-3">
                        <select name="year" id="year" class="form-control">
                            <option value="">Select Year</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12" style="overflow-x: scroll;">
                    <section class="panel">
                        <div class="panel-body">
    <br />
  <div class="panel panel-default">
            <div class="panel-body">
                <div id="chart_area" style="width: 100%; height: 600px;"></div>
                <div id="chart_area2" style="width: 100%; height: 600px;"></div>
                <div id="chart_area3" style="width: 100%; height: 600px;"></div>
            </div>
        </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <?php $this->load->view('components/footer'); ?>
        <!--footer section end-->

    </div>
    <!-- body content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?=base_url()?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>

<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>

<!--Data Table-->
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script>
<!--data table init-->
<script src="<?=base_url()?>assets/admin_panel/js/data-table-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages:['corechart', 'bar']});
google.charts.setOnLoadCallback();

function load_monthwise_data(year, title)
{
    var temp_title = title + ' ' + year;
    $.ajax({
        url:"<?php echo base_url(); ?>admin/google-chart-yearwise-data",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    })
}

function load_monthwise_data1(year, title, row, column)
{
    var temp_title = title + ' ' + year;
    $.ajax({
        url:"<?php echo base_url(); ?>admin/google-chart-monthwise-data",
        method:"POST",
        data:{year:year, row:row, column:column},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart1(data, temp_title);
        }
    })
}

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Order');
    data.addColumn('number', 'Invoice');

    $.each(jsonData, function(i, jsonData){
        var month = jsonData.name;
        var quantity = parseFloat($.trim(jsonData.quantity));
        var invoice_quantity = parseFloat($.trim(jsonData.invoice_quantity));
        data.addRows([[month, quantity, invoice_quantity]]);
    });

    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Months"
        },
        vAxis: {
            title: 'Quantity'
        },
        chartArea:{width:'80%',height:'85%'}
    }

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));

    chart.draw(data, options);

    google.visualization.events.addListener(chart, 'select', selectHandler);

  function selectHandler() {
  var selection = chart.getSelection();
  var message = '';
  for (var i = 0; i < selection.length; i++) {
    var item = selection[i];
    if (item.row != null && item.column != null) {
      var str = data.getFormattedValue(item.row, item.column);

      var year = $('#year').val();
        if(year != '')
        {
            load_monthwise_data1(year, 'Month wise order and invoice quantity', item.row, item.column);
        }
    } 
  }
}

}

function drawMonthwiseChart1(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Order');
    data.addColumn('number', 'Invoice');

    $.each(jsonData, function(i, jsonData){
        var name = jsonData.name;
        var quantity = parseFloat($.trim(jsonData.quantity));
        var invoice_quantity = parseFloat($.trim(jsonData.invoice_quantity));
        var month_name = jsonData.month_name;
        data.addRows([[name, quantity, invoice_quantity]]);
    });

    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Buyer Name"
        },
        vAxis: {
            title: 'Quantity'
        },
        chartArea:{width:'80%',height:'85%'}
    }

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area2'));

    chart.draw(data, options);

}

</script>

<script>
    
$(document).ready(function(){
    $('#year').change(function(){
        var year = $(this).val();
        if(year != '')
        {
            load_monthwise_data(year, 'Month Wise Order And Invoice Details' );
        }
    });
});

// window.addEventListener('click', function(e){   
//   if (document.getElementById('chart_area2').contains(e.target)){
//     // Clicked in box
//   } else{
//     $("#chart_area2").html('');
//   }
// });

// $('.graph_view').click(function(e){
//   $('#chart_area2').fadeOut(300);
// })

</script>