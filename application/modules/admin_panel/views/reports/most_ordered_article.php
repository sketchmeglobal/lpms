    

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Most Ordered Article | Shilpa Overseas</title>

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
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}

            .border-bottom{border-bottom:  1px solid #000}
            
            .text-right{text-align: right!important;}
            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 13px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000} .text-right{text-align: right!important;}
                .no-print{display: none}
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4" id="page-content" >
                <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
       
        
        <section class="sheet padding-10mm" style="height: auto;">
            <div>
                <header class="pull-right">
                    <!-- <small>Page No. 1</small> -->
                </header>
                <div class="clearfix"></div>
                <div class="container">
                    <div class="row border_all text-center text-uppercase mar_bot_3">
                        <h3 class="mar_0 head_font">Most Ordered Article</h3>
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
                                        <p class="mar_0"><b>Most Ordered Article</b> </p>
                                        <p class="mar_0"> Article Group: <?= $article_ids[0]->group_name ?> </p>
                                        <p class="mar_0"> Article Name: <?= $article_ids[0]->art_no ?> </p>
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
                                <div class="" style="padding-left: 15px">
                                    <p class="mar_0"><b>Less Ordered Article</b> </p>
                                    <p class="mar_0"> Article Group: <?= $article_ids[(count($article_ids)-1)]->group_name ?> </p>
                                    <p class="mar_0"> Article Name: <?= $article_ids[(count($article_ids)-1)]->art_no ?> </p>
                                </div>
                            </div>
                            <div class="row border_all height_21">
                                <div class="col-sm-12">
                                    <p><b>Date:</b> <?=date('d-m-Y')?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--table data-->
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Article Group</th>
                                    <th>Article Name</th>
                                    <th>Alt. Article Name </th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $iter = 1; foreach($article_ids as $ai){ ?>
                                    <tr>
                                        <td style="text-align:right"><?=$iter++?></td>
                                        <td><?=$ai->group_name?></td>
                                        <td><?=$ai->art_no?></td>
                                        <td><?=$ai->alt_art_no?></td>
                                        <td style="text-align:right"><?=$ai->co_quantity?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                
            </body>
</html>
