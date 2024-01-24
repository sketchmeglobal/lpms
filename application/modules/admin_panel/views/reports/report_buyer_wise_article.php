    
<?php 
    #echo '<pre>',print_r($article_lists),'</pre>'; 
    function fetch_buyer_ref($am_id){

        $sql = "SELECT GROUP_CONCAT(DISTINCT customer_order.buyer_reference_no) as buyer_reference_no FROM customer_order 
        LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
        WHERE customer_order_dtl.am_id = ". $am_id;
        $CI=&get_instance();
        $res = $CI->db->query($sql)->row();
        if(!empty($res)){
            return $res->buyer_reference_no;
        }else{
            return '-';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Buyer wise article status | Shilpa Overseas</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Normalize or reset CSS with your favorite library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
        <!-- Load paper.css for happy printing -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
        <link href="https://fonts.googleapis.com/css?family=Chivo|Signika" rel="stylesheet">
        
        <link href="<?= base_url() ?>/assets/admin_panel/css/select2.css" rel="stylesheet">
        <link href="<?= base_url() ?>/assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">
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
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 14px}

            .border-bottom{border-bottom:  1px solid #000}
            
            .text-right{text-align: right!important;}
            @page { size: A4 }

            @media print{
                .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th { border: 1px solid #000;  text-align: center;}
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 5px; text-align: left; font-size: 14px}
                .col-sm-6{ width: 50%!important;float:left; }.col-sm-5 { width: 41.66666667%;float:left; }.col-sm-7 { width: 58.33333333%;float:left; }
                .border-bottom{border-bottom:  1px solid #000} .text-right{text-align: right!important;}
                .no-print{display: none}
            }
        </style>
    </head>

    <body class="A4" id="page-content" >
        <prebody>
            <div class="container">
                <br><br>
                <form method="post" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-4">
                        <label for="buyers">Select Buyer</label>
                        <select name="buyers" id="buyers" class="select2 form-control">
                            <option disabled selected value=""></option>
                            <!-- <option value="all">All</option> -->
                            <?php foreach($buyers as $buyer){ ?>
                                <option value="<?=$buyer->am_id?>"><?=$buyer->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="" for="search">Action</label><br>
                        <input type="submit" name="submit" class="btn btn-success" value="Search">
                    </div>
                </form>
            </div>
        </prebody> 

        <?php if(isset($article_lists[0])){ ?>
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
                                    <p><strong>Search:</strong> <?= (count($article_lists) > 0) ? $article_lists[0]->name : '' ?></p>
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
                                    <th class="text-right">Rank</th>
                                    <!-- <th>Buyer</th> -->
                                    <th>Buyer Reference</th>
                                    <!-- <th>Customer Order</th> -->
                                    <th>Article No.</th>
                                    <th class="text-right">Article Qnty.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $iter = 1; 
                                    foreach($article_lists as $al){ 
                                        if($al->article_qnty < 10){
                                            continue;
                                        }
                                ?>
                                <tr>
                                    <td class="text-right"><?=$iter++?>.</td>
                                    <!-- <td class="">< ?=$al->name?></td> -->
                                    <td><?= fetch_buyer_ref($al->am_id) ?></td>
                                    <!-- <td>< ?=$al->co_no?></td> -->
                                    <td class=""><?=$al->art_no?></td>
                                    <td class="text-right"><?=$al->article_qnty?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section> 
        <?php }else{
            ?>
            <div style="min-height:99vh"></div>
            <?php
        } ?>
        
        <script src="<?= base_url() ?>/assets/admin_panel/js/jquery-1.10.2.min.js"></script>
        <script src="<?= base_url() ?>/assets/admin_panel/js/select2.js" type="text/javascript"></script>
        <script>
            $('.select2').select2();
        </script>
    </body>
</html>
