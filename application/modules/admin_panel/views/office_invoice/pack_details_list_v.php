<?PHP
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> PACKING LIST UPDATE DETAILS | <?=WEBSITE_NAME;?></title>

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
                .no-print {display: none;}
            }
            body.A4 .sheet {
    width: 210mm;
    height: 100%;
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
        <section class="sheet padding-10mm">
            <div>
                <header class="pull-right">
                    <?php $page_no = 1;?>
                    <small>Page No. <?= $page_no ?></small>
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">PACKING LIST UPDATE DETAILS</h3>
                    </div>




                    <!--table data-->
                    <div class="row table-responsive">
                        <table class="table table-bordered table-hover table2excel">
                            <thead>
                                    <th>CN#</th>
                                                <th>Order Number</th>
                                                <th>Article Number</th>
                                                <th>Alt Art. Number</th>
                                                <th>Leather Color</th>
                                                <th>Item</th>
                                                <th>Reference</th>
                                                <th>Box Size</th>
                                                <th>Total Quantity of Art. in Pack. List</th>
                                                <th>Gross Weight</th>
                                                <th>Net Weight</th>
                                                <th>Status</th>
                            </thead>
                            <tbody class="actual_table">
                                <?php
                                    foreach ($details as $ppl) {
                                         ?>
                                    <tr>
                                <td style="width: 182px;"><?= $ppl->carton_number ?></td>
                                <td><?= $ppl->co_no ?></td>
                                <td><?= $ppl->art_no ?></td>
                                <td><?= $ppl->alt_art_no ?></td>
                                <td><?= $ppl->leather_color ?></td>
                                <td><?= $ppl->item ?></td>
                                <td><?= $ppl->reference ?></td>
                                <td><?= $ppl->box_size ?></td>
                                <td><?= $ppl->article_quantity ?></td>
                                <td><?= $ppl->gross_weight ?></td>
                                <td><?= $ppl->net_weight ?></td>
                                <td><?= $ppl->update_after_invoice_text ?></td>
                            </tr>
                            <?php
                        } ?>
                           
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
        </section>
    </body>
</html>
