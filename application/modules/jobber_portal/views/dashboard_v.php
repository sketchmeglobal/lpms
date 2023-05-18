<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 12:00
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard | <?=WEBSITE_NAME;?></title>
    <meta name="keyword" content="user dashboard">
    <meta name="description" content="account statistic">

<!--      common head 
 -->    <?php $this->load->view('components/_common_head'); ?>
 <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin_panel/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.4/css/rowGroup.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--      /common head 
 -->
 </head>

<body class="sticky-header">

<section>
<!--      sidebar left start (Menu)
 -->    <?php $this->load->view('components/left_sidebar'); //left side menu ?>
<!--      sidebar left end (Menu)
 -->    <style>
        .p-1{padding: 1%;}
        .pt-0{padding-top: 0}
        .px-1{padding: 1rem 0;}
        .mb-1{margin-bottom: 0.5rem;}
        .mt-1{margin-top: 0.5rem;}
        .mb-2{margin-bottom: 2rem;}
/*        .panel{min-height: 400px;}
*/        .panel-footer {background-color: rgb(0 0 0 / 15%);bottom: 0;width: 100%;}
        .text-white{color:#fff;}
        .text-dark{color:#000;}
        .border-bottom{border-bottom: 1px solid #787878;}
        ul {
         padding-right: 0;
         padding-left: 18px;
        }
        /*.panel {
        min-height: 360px;
        }*/
        footer {
            position: relative;
        }


        body{
    margin-top: 50px !important;
    font-family: 'PT Sans Narrow', sans-serif;
}
a:hover, a:focus{
    text-decoration: none !important;
    outline: none !important;
    
}
.panel-group .panel{
    background-color: #fff;
    border:none;
    box-shadow:none;
    border-radius: 10px;
    margin-bottom:11px;
}
.panel .panel-heading{
    padding: 0;
    border-radius:10px;
    border: none;
}
.panel-heading a{
    color: white;
    display: block;
    border: none;
    padding: 15px 34px 15px;
    font-size: 20px;
    background-color: #4bc17d;
    font-weight: bold!important;
    position: relative;
    /* color: #fff; */
    box-shadow: none;
    transition: all 0.1s ease 0;
    font-size: 17px!important;
}
.panel-heading a:after, .panel-heading a.collapsed:after{
    content: "\f068";
    font-family: fontawesome;
    text-align: center;
    position: absolute;
    left: -20px;
    top: 10px;
    color: #e81313 !important;
    background-color: #fff;
    border: 5px solid #fff;
    font-size: 15px;
    width: 40px;
    height: 40px;
    line-height: 30px;
    border-radius: 50%;
    transition: all 0.3s ease 0s;
}
.panel-heading:hover a:after,
.panel-heading:hover a.collapsed:after{
    transform:rotate(360deg);
}
.panel-heading a.collapsed:after{
    content: "\f067";
}
#accordion .panel-body{
    background-color:#fbf8f8;
    line-height: 25px;
    padding: 10px 25px 20px 35px ;
    border-top:none;
    font-size:14px;
    position: relative;
}
.text-white{
    color:white;
    text-transform: uppercase;
}

.loader {
    display: inline-block;
    width: 30px;
    height: 30px;
    position: relative;
    border: 4px solid #Fff;
    top: 50%;
    animation: loader 2s infinite ease;
  }
  
  .loader-inner {
    vertical-align: top;
    display: inline-block;
    width: 100%;
    background-color: #fff;
    animation: loader-inner 2s infinite ease-in;
  }
  
  @keyframes loader {
    0% {
      transform: rotate(0deg);
    }
    
    25% {
      transform: rotate(180deg);
    }
    
    50% {
      transform: rotate(180deg);
    }
    
    75% {
      transform: rotate(360deg);
    }
    
    100% {
      transform: rotate(360deg);
    }
  }
  
  @keyframes loader-inner {
    0% {
      height: 0%;
    }
    
    25% {
      height: 0%;
    }
    
    50% {
      height: 100%;
    }
    
    75% {
      height: 100%;
    }
    
    100% {
      height: 0%;
    }
  }

  .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}
        .page-head {
    padding: 20px;
    background: #e8e8e8;
    position: relative;
    top: -50px;
}

.bg-success, .info-number .bg-success {
    background-color: #96ceb8;
    color: black!important;
}
 h4 {
    font-size: 16px!important;
 }
 .page-head {
    padding: 20px;
    background: #e8e8e8;
    position: relative;
    top: -48px;
}
    </style>
<!--      body content start
 -->    <div class="body-content" style="min-height: 1500px;">

<!--          header section start
 -->        <?php $this->load->view('components/top_menu'); ?>
<!--          header section end
 -->
<!--          page head start
 -->        <div class="page-head">
            <h3>Dashboard</h3>
            <span class="sub-title">Welcome to <?=WEBSITE_NAME;?> dashboard</span>
        </div>
<!--          page head end
 -->
<!--         body wrapper start
 -->        <div class="wrapper">

            

            </div>


            
            <div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                   
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Google Chart
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">Month Wise Order And Invoice Details</h3>
                    </div>
                    <div class="col-md-3">
                        <select name="year" id="year" class="form-control">
                            <option value="">Select Year</option>
                            <option value="2020">2020</option>
                            <option value="2021" selected>2021</option>
                        </select>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12" style="overflow-x: scroll;">
                    <table class="columns" style="width: 100%;">
      <tr>
        <td style="width: 50%;"><div id="chart_area" style="border: 1px solid #ccc;width: 100%; height: 300px;"></div></td>
        <td style="width: 50%;"><div id="chart_area2" style="border: 1px solid #ccc;width: 100%; height: 300px;"></div></td>
      </tr>
    </table>
                </div>
            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



        </div>

<!--         body wrapper end
 -->
<!--         footer section start
 -->        <?php $this->load->view('components/footer'); ?>
<!--         footer section end
 -->
    </div>
<!--      body content end
 --></section>

<!--  Placed js at the end of the document so the pages load faster 
 --><script src="<?=base_url()?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>
<script src="<?//=base_url();?>assets/admin_panel/js/jquery-migrate.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script><script src="<?=base_url()?>assets/admin_panel/js/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/jquery.quicksearch.js"></script>

<!--  common js 
 --><?php $this->load->view('components/_common_js'); //left side menu ?>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages:['corechart', 'bar']});
google.charts.setOnLoadCallback((year, 'Month Wise Order And Invoice Details' ));

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
            title: "Months",
            textStyle : {
            fontSize: 10,// or the number you want
            fontName: 'Times-Roman',
            italic: true,
            slantedText: true,
        }
        },
        vAxis: {
            title: 'Quantity',
            textStyle : {
            fontSize: 10, // or the number you want
            fontName: 'Times-Roman',
            italic: true,
        }
        },
        bar: {groupWidth: "40%"},
        chartArea:{width:'80%',height:'60%'},
        legend: {
      position: 'top'
    },
    width: '100%'
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
            title: "Buyer Name",
            textStyle : {
            fontSize: 10,// or the number you want
            fontName: 'Times-Roman',
            italic: true,
            slantedText: true,
        }
        },
        vAxis: {
            title: 'Quantity',
            textStyle : {
            fontSize: 10, // or the number you want
            fontName: 'Times-Roman',
            italic: true,
        }
        },

        bar: {groupWidth: "20%"},

        chartArea:{width:'80%',height:'60%'},
        legend: {
      position: 'top'
    },
    width: '100%'
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

$(document).ready(function(){
        var year = $('#year').val();
            load_monthwise_data(year, 'Month Wise Order And Invoice Details' );
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

 <script>
    $('.select2').select2();
</script>

<script>
  $(document).ready(function(){
                   $gr_id = ($(this).find(':selected').val());
                   
                   $.ajax({
                       method: 'post',
                       dataType: 'json',
                       url: "<?= base_url('items-on-item-group') ?>",
                       data: {gr_id:$gr_id},
                       success: function(items){
                           // console.log(items);
                           $.each(items, function(index, itemData){
                               $apnd_val = '<option value="'+ itemData.id_id +'">'+ itemData.item + ' [' + itemData.color + ']' +'</option>';
                               $("#leather_status").append($apnd_val);
                           });
                           $('#leather_status').multiSelect('refresh');
                       },
                       error: function(e){
                           console.log(e);
                       }
                   });
                   });
</script>

<script>
           $(document).ready(function(){
              $(function () {
            $(".date").datepicker({dateFormat: 'dd-mm-yy'});
        });
        $('#leather_status').multiSelect({
            selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search item'>",
            selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search item'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });  
           });
           $('#select-all').click(function(){
               $('#leather_status').multiSelect('select_all');
               return false;
           });
           $('#deselect-all').click(function(){
               $('#leather_status').multiSelect('deselect_all');
               return false;
           });
       </script>

       <script>
    $(document).ready(function() {
        $('#cutting_issue_challan_table').DataTable({
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'User Log PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'User Log PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }    
               }
            ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('admin/ajax-user-logs-details')?>",
                "type": "POST",
                "dataType": "json",
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "table_name" },
                { "data": "action_taken" },
                { "data": "old_data" },
                { "data": "comment" },
                { "data": "username" },
                { "data": "create_date" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [2,3,5], //disable 'Image','Actions' column sorting
                "orderable": false,
            }]
        } );
    } );

    $(document).on('click', '.print_all',function(){
        $poi = $(this).attr('po-id');
        $.confirm({
            title: 'Choose!',
            content: 'Choose printing methods from the below options',
            buttons: {
                printwithcode: {
                    text: 'With code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        window.open("<?= base_url() ?>admin/purchase-order-print-with-code/"+ $poi, "_blank");
                    }
                },
                printwithoutcode: {
                    text: 'Without code',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        window.open("<?= base_url() ?>admin/purchase-order-print-without-code/"+ $poi, "_blank");
                    }
                },
                cancel: function () {}
            }
        });
    });
    
    // delete area 
    $(document).on('click', '.delete', function(){
        if(confirm('Are you sure?')){
            $tab = $(this).attr('tab');         
            $pk_name = $(this).attr('pk-name');
            $pk_value = $(this).attr('pk-value');
            
            $ref_table = $(this).attr('ref-table');
            $ref_pk_name = $(this).attr('ref-pk-name');
            
            $.ajax({
                url: "<?= base_url('admin/delete-office-proforma-header-list') ?>",
                type: 'POST',
                dataType: 'json',
                data:{tab: $tab, pk_name: $pk_name, pk_value: $pk_value, ref_table: $ref_table, ref_pk_name: $ref_pk_name},
                success: function(returnData){
                    console.log(JSON.stringify(returnData));
                    notification(returnData);
                    $('#cutting_issue_challan_table').DataTable().ajax.reload();
                },
                error: function(e,v){
                    console.log(e + v);
                }
            });
        }
    })
    // delete area ends 
    //toastr notification
    function notification(obj) {
        // console.log(obj);
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "500",
            "timeOut": "10000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }

</script>

</body>
</html>