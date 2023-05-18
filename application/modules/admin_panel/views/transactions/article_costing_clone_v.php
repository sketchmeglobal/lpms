<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 17-03-2020
 * Time: 12:17
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clone Article Costing | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="clone article costing">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

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

        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}
        
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
            <h3 class="m-b-less">Clone Article Costing</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Clone Article Costing </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--clone button-->
            <section class="panel text-center">
                <button type="submit" form="form_edit_article_costing_clone" class="btn btn-warning"><i class="fa fa-clone"> Clone Article Costing</i></button>
            </section>

            <!--Edit Article Costing-->
            <div class="row">
                <div class="col-md-10">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?=$article_costing->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <form id="form_edit_article_costing_clone" method="post" action="<?=base_url('admin/form_edit_article_costing_clone')?>" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <label for="am_id" class="control-label col-lg-2 text-danger">Article *</label>
                                    <div class="col-lg-4">
                                        <select id="am_id" name="am_id" required class="select2 form-control round-input">
                                            <option value="">Select Article</option>
                                            <?php
                                            foreach($article_masters as $val) {
                                                $selected = '';
                                                if($val['am_id'] == $article_costing->am_id){$selected='selected';}
                                                ?>
                                                <option <?=$selected?> value="<?=$val['am_id']?>"><?=$val['art_no']?> [<?=$val['group_name']?>]</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="remark" class="control-label col-lg-2">Remark</label>
                                    <div class="col-lg-4">
                                        <input id="remark" name="remark" value="<?=$article_costing->remark?>" type="text" placeholder="Remark" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="exworks_amt" class="control-label col-lg-2">Ex-Works</label>
                                    <div class="col-lg-4">
                                        <input id="exworks_amt" name="exworks_amt" type="number" placeholder="Ex-Works amount" readonly class="form-control round-input" value="<?= $article_cost[0]->exworks_amt ?>"/>
                                    </div>

                                    <label for="cf_amt" class="control-label col-lg-2">C & F</label>
                                    <div class="col-lg-4">
                                        <input id="cf_amt" name="cf_amt" type="number" placeholder="C & F amount" readonly class="form-control round-input" value="<?= $article_cost[0]->cf_amt ?>" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="fob_amt" class="control-label col-lg-2">F.O.B</label>
                                    <div class="col-lg-4">
                                        <input id="fob_amt" name="fob_amt" type="number" placeholder="F.O.B amount" readonly class="form-control round-input" value="<?= $article_cost[0]->fob_amt ?>" />
                                    </div>

                                    <label class="control-label col-lg-2 text-danger">Status *</label>
                                    <div class="col-lg-4">
                                        <input <?php if($article_costing->status == '1'){echo 'checked';} ?> type="radio" name="status" id="enable" value="1" required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input <?php if($article_costing->status == '0'){echo 'checked';} ?> type="radio" name="status" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Image</label>
                                    <div class="col-lg-4 text-center">
                                        <img id="article_img" src="<?=base_url()?>assets/admin_panel/img/article_img/<?=$img?>" height="75">
                                    </div>
                                </div>

                                <input type="hidden" id="article_costing_id" name="article_costing_id" class="article_costing_id" value="<?=$article_costing->ac_id?>">
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-md-2 hidden-xs">
                    <section class="panel">
                        <header class="panel-heading">
                            Articles:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <!-- < ?= print_r($article_costing); ?> -->
                        <div class="panel-body">
                            <p class='text-center'> <a target="_blank" class="badge bg-primary" href="<?= base_url('admin/edit_article') ?>/<?=$article_costing->am_id?>"><?=$article_costing->art_no?></a></p>
                            <hr />
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Exchange Items and Colours from Measurement / Costing before Cloning:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class= "row form-group">
                                <label for="existing_item_dtl" class="control-label col-lg-2 text-danger"> Existing Item & Colour*</label>
                                <div class="col-lg-3">
                                    <select id="existing_item_dtl" name="existing_item_dtl" required class="select2 form-control round-input">
                                        <option value="" item_group_val="" unit="">Select From The List</option>
                                        <?php
                                        foreach($measurement_items as $mi) {
                                            ?>
                                            <option item_group_val="<?= $mi['ig_id'] ?>" value="<?=$mi['id_id']?>"><?= $mi['item_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <label for="proposed_item" class="control-label col-lg-2 text-danger text-right"> Proposed Item</label>
                                <div class="col-lg-3">
                                    <select id="proposed_item" name="proposed_item" required class="select2 form-control round-input">
                                        <option value="" item_group_val="" unit="">Select Item From The List</option>
                                        
                                    </select>
                                </div>
                                <div class="col-lg-2 text-right">
                                    <button class="btn btn-success" type="button" id="swap_item_dtl"><i class="fa fa-exchange"></i> Swap</button>
                                </div>
                                <!-- <div class="col-sm-12"> -->
                                    <!-- <label for="proposed_item_colour" class="control-label col-lg-2 text-danger"> Proposed Colour</label>
                                    <div class="col-lg-3">
                                        <select id="proposed_item_colour" name="proposed_item_colour" required class="select2 form-control round-input">
                                            <option value="" item_group_val="" unit="">Select Item Colour</option>
                                            
                                        </select>
                                    </div>  -->                                   
                                <!-- </div> -->

                                  

                            </div>
                            <hr>
                            <div class= "form-group">    
                                
                            </div> 
                        </div>
                    </section>
                </div>
            </div>
            <!--Article Costing Measurement-->
            <div class="row">
                <div class="col-md-10">
                    <section class="panel">
                        <header class="panel-heading">
                            Measurement of <?=$article_costing->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="article_measurement_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#measurement_list" data-toggle="tab">List</a></li>
                                <li><a href="#measurement_add" data-toggle="tab">Add</a></li>
                                <li id="measurement_edit_tab" class="disabled"><a href="#measurement_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="measurement_list" class="tab-pane fade in active">
                                    <table id="article_measurement_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Color</th>
                                            <th>Length</th>
                                            <th>Width</th>
                                            <th>Pieces</th>
                                            <th>Wastage (%)</th>
                                            <th>Unit</th>
                                            <th>Area 1</th>
                                            <th>Area 2</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="measurement_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_article_measurement_clone" method="post" action="<?=base_url('admin/form_add_article_measurement_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class= "form-group">
                                                <label for="ig_id" class="control-label col-lg-2 text-danger"> Group*</label>
                                                <div class="col-lg-4">
                                                    <select id="ig_id" name="ig_id" required class="select2 form-control round-input">
                                                        <option value="" item_group_val="" unit="">Select Item Group</option>
                                                        <?php
                                                        foreach($item_group_details as $igd) {
                                                            ?>
                                                            <option value="<?=$igd->ig_id?>"><?= $igd->group_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group ">
                                                <label for="id_id" class="control-label col-lg-2 text-danger">Item *</label>
                                                <div class="col-lg-4">
                                                    <select id="id_id" name="id_id" required class="select2 form-control round-input">
                                                        <option value="" item_group_val="" unit="">Select Item</option>
                                                        <?php
                                                        // foreach($item_dtls as $val) {
                                                            ?>
                                                            <!-- <option value="< ?=$val['id_id']?>" item_group_val="< ?=$val['value']?>" unit="< ?=$val['unit']?>" >< ?=$val['item']?> [< ?=$val['group_name']?>] - < ?=$val['color']?></option> -->
                                                        <?php #} ?>
                                                    </select>
                                                    <span class="bg-success text-uppercase" id="buyer_map"></span>
                                                </div>

                                                <label for="unit" class="control-label col-lg-2">Unit</label>
                                                <div class="col-lg-4">
                                                    <input id="unit" name="unit" type="text" readonly placeholder="Unit" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="length" class="control-label col-lg-2 text-danger">Length *</label>
                                                <div class="col-lg-4">
                                                    <input id="length" name="length" type="number" min="0" required placeholder="Length" class="form-control round-input">
                                                </div>

                                                <label for="width" class="control-label col-lg-2 text-danger">Width *</label>
                                                <div class="col-lg-4">
                                                    <input id="width" name="width" type="number" min="0" required placeholder="Width" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="pieces" class="control-label col-lg-2 text-danger">Pieces *</label>
                                                <div class="col-lg-4">
                                                    <input id="pieces" name="pieces" type="number" min="0" required placeholder="Pieces" class="form-control round-input">
                                                </div>

                                                <label for="wastage_percentage" class="control-label col-lg-2 text-danger">Wastage (%) *</label>
                                                <div class="col-lg-4">
                                                    <input id="wastage_percentage" name="wastage_percentage" type="number" min="0" required placeholder="Wastage percentage" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="area1" class="control-label col-lg-2">Area I</label>
                                                <div class="col-lg-4">
                                                    <input id="area1" name="area1" type="number" readonly placeholder="Area I" class="form-control round-input">
                                                </div>

                                                <label for="area2" class="control-label col-lg-2">Area II</label>
                                                <div class="col-lg-4">
                                                    <input id="area2" name="area2" type="number" readonly placeholder="Area II" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable2" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable2" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable2" value="0" required class="iCheck-square-red">
                                                    <label for="disable2" class="control-label">Disable</label>
                                                </div>

                                                <div class="col-lg-6 text-right">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Costing Measurement</button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="article_costing_id" class="article_costing_id" value="<?=$article_costing->ac_id?>">

                                            <!-- <div class="form-group">
                                                <div class="col-lg-6 text-right">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Costing Measurement</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>

                                <div id="measurement_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_article_measurement_clone" method="post" action="<?=base_url('admin/form_edit_article_measurement_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="id_id2" class="control-label col-lg-2 text-danger">Item *</label>
                                                <div class="col-lg-4">
                                                    <select id="id_id2" name="id_id" required class="select2 form-control round-input">
                                                        <option value="" item_group_val="" unit="">Select Item</option>
                                                        <?php
                                                        foreach($item_dtls as $val) {
                                                            ?>
                                                            <option value="<?=$val['id_id']?>" item_group_val="<?=$val['value']?>" unit="<?=$val['unit']?>" ><?=$val['item']?> [<?=$val['group_name']?>] - <?=$val['color']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="unit2" class="control-label col-lg-2">Unit</label>
                                                <div class="col-lg-4">
                                                    <input id="unit2" name="unit" type="text" readonly placeholder="Unit" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="length2" class="control-label col-lg-2 text-danger">Length *</label>
                                                <div class="col-lg-4">
                                                    <input id="length2" name="length" type="number" min="0" required placeholder="Length" class="form-control round-input">
                                                </div>

                                                <label for="width2" class="control-label col-lg-2 text-danger">Width *</label>
                                                <div class="col-lg-4">
                                                    <input id="width2" name="width" type="number" min="0" required placeholder="Width" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="pieces2" class="control-label col-lg-2 text-danger">Pieces *</label>
                                                <div class="col-lg-4">
                                                    <input id="pieces2" name="pieces" type="number" min="0" required placeholder="Pieces" class="form-control round-input">
                                                </div>

                                                <label for="wastage_percentage2" class="control-label col-lg-2 text-danger">Wastage (%) *</label>
                                                <div class="col-lg-4">
                                                    <input id="wastage_percentage2" name="wastage_percentage" type="number" min="0" required placeholder="Wastage percentage" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="area12" class="control-label col-lg-2">Area I</label>
                                                <div class="col-lg-4">
                                                    <input id="area12" name="area1" type="number" readonly placeholder="Area I" class="form-control round-input">
                                                </div>

                                                <label for="area22" class="control-label col-lg-2">Area II</label>
                                                <div class="col-lg-4">
                                                    <input id="area22" name="area2" type="number" readonly placeholder="Area II" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable3" value="1" required class="iCheck-square-green">
                                                    <label for="enable3" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable3" value="0" required class="iCheck-square-red">
                                                    <label for="disable3" class="control-label">Disable</label>
                                                </div>

                                                <div class="col-lg-offset-2 co6 text-right">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Costing Measurement</button>
                                                </div>
                                            </div>

                                            <input type="hidden" id="costing_measurement_id" name="costing_measurement_id" value="">

                                            <input type="hidden" name="article_costing_id_measurement_edit" class="article_costing_id" value="<?=$article_costing->ac_id?>">
                                            <input type="hidden" id="article_master_id" name="article_master_id" value="<?=$article_costing->am_id?>">

                                            <!-- <div class="form-group">
                                                <div class="col-lg-offset-2 co6 text-right">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Costing Measurement</button>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Total:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <label><b>Pieces: </b> <?= (isset($total_measurement_pieces[0]) ? $total_measurement_pieces[0]->pcs : 0) ?> </label>
                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            Items:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <?php #echo '<pre>', print_r($item_dtls), '</pre>'; ?>
                            <?php
                            foreach($measurement_items as $mi){
                            ?>
                                <p data-wrap="<?= $mi['id_id'] ?>" data-toggle="tooltip" class="right-items text-center" title="<?= $mi['item_name'] ?>"> <a style="width: 120px;font-size: 11px" target="_blank" class="badge bg-primary" href="<?= base_url('admin/edit_item') ?>/<?= $mi['id_id'] ?>"><?= substr($mi['item_name'], 0, 10) . '..'; ?> [<?= $mi['color'] ?>]</a></p>
                                <hr />
                            <?php
                            }    
                            ?>                                                        
                        </div>
                    </section>
                </div>
            </div>

            <!--Article Costing Details-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Costing Details of <?=$article_costing->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="costing_details_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#details_list" data-toggle="tab">List</a></li>
                                <li><a href="#details_add" data-toggle="tab">Add</a></li>
                                <li id="details_edit_tab" class="disabled"><a href="#details_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="details_list" class="tab-pane fade in active">
                                    <table id="costing_details_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Item Group</th>
                                            <th>Item Name</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="details_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_costing_details_clone" method="post" action="<?=base_url('admin/form_add_costing_details_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group">
                                                <label for="ig_id_alies" class="control-label col-lg-2 text-danger"> Group*</label>
                                                <div class="col-lg-4">
                                                    <select id="ig_id_alies" name="ig_id_alies" required class="select2 form-control round-input">
                                                        <option value="" item_group_val="" unit="">Select Item Group</option>
                                                        <?php
                                                        foreach($item_group_details as $igd) {
                                                            ?>
                                                            <option value="<?=$igd->ig_id?>"><?= $igd->group_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>               
                                            <div class="form-group ">
                                                <label for="id_id3" class="control-label col-lg-2 text-danger">Item *</label>
                                                <div class="col-lg-4">
                                                    <select id="id_id3" name="id_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>

                                                <label for="rate" class="control-label col-lg-2 text-danger">Rate *</label>
                                                <div class="col-lg-4">
                                                    <input id="rate" name="rate" type="number" min="0" required placeholder="Rate" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="quantity" class="control-label col-lg-2 text-danger">Quantity *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity" name="quantity" type="number" min="0" required placeholder="Quantity" class="form-control round-input">
                                                </div>

                                                <label for="amount" class="control-label col-lg-2">Amount</label>
                                                <div class="col-lg-4">
                                                    <input id="amount" name="amount" type="number" min="0" readonly placeholder="Amount" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable4" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable4" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable4" value="0" required class="iCheck-square-red">
                                                    <label for="disable4" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="article_costing_id" class="article_costing_id" value="<?=$article_costing->ac_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Costing Details</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="details_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_costing_details_clone" method="post" action="<?=base_url('admin/form_edit_costing_details_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="id_id4" class="control-label col-lg-2 text-danger">Item *</label>
                                                <div class="col-lg-4">
                                                    <select id="id_id4" name="id_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item</option>
                                                        <?php
                                                        foreach($item_dtls as $val) {
                                                            ?>
                                                            <option value="<?=$val['id_id']?>"><?=$val['item']?> [<?=$val['group_name']?>] - <?=$val['color']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="rate2" class="control-label col-lg-2 text-danger">Rate *</label>
                                                <div class="col-lg-4">
                                                    <input id="rate2" name="rate" type="number" min="0" required placeholder="Rate" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="quantity2" class="control-label col-lg-2 text-danger">Quantity *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity2" name="quantity" type="number" min="0" required placeholder="Quantity" class="form-control round-input">
                                                </div>

                                                <label for="amount2" class="control-label col-lg-2">Amount</label>
                                                <div class="col-lg-4">
                                                    <input id="amount2" name="amount" type="number" min="0" readonly placeholder="Amount" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable5" value="1" required class="iCheck-square-green">
                                                    <label for="enable5" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable5" value="0" required class="iCheck-square-red">
                                                    <label for="disable5" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="costing_details_id" name="costing_details_id" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Costing Details</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!--Article Costing Charges-->
            <div class="row">
                <div class="col-md-10">
                    <section class="panel">
                        <header class="panel-heading">
                            Costing Charges of <?=$article_costing->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="costing_charges_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#charges_list" data-toggle="tab">List</a></li>
                                <li><a href="#charges_add" data-toggle="tab">Add</a></li>
                                <li id="charges_edit_tab" class="disabled"><a href="#charges_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="charges_list" class="tab-pane fade in active">
                                    <table id="costing_charges_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Charge Name</th>
                                            <th>Percentage</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="charges_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_costing_charges_clone" method="post" action="<?=base_url('admin/form_add_costing_charges_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="c_id" class="control-label col-lg-2 text-danger">Charge Name *</label>
                                                <div class="col-lg-4">
                                                    <select id="c_id" name="c_id" required class="select2 form-control round-input">
                                                        <option value="" rate="" percentage="">Select Charge</option>
                                                        <?php
                                                        foreach($charges as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>" rate="<?=$val['amount']?>" percentage="<?=$val['percentage']?>"><?=$val['charge']?> [<?=$val['charge_group']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <input type="hidden" id="percentage" name="percentage">

                                                <label for="quantity3" class="control-label col-lg-2 text-danger">Quantity *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity3" name="quantity" type="number" min="0" required placeholder="Quantity" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="rate3" class="control-label col-lg-2 text-danger">Rate *</label>
                                                <div class="col-lg-4">
                                                    <input id="rate3" name="rate" type="number" min="0" required placeholder="Rate" class="form-control round-input">
                                                </div>
                                                

                                                <label for="amount3" class="control-label col-lg-2">Amount</label>
                                                <div class="col-lg-4">
                                                    <input id="amount3" name="amount" type="number" min="0" readonly placeholder="Amount" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable6" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable6" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable6" value="0" required class="iCheck-square-red">
                                                    <label for="disable6" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="article_costing_id" class="article_costing_id" value="<?=$article_costing->ac_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Costing Charge</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="charges_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_costing_charges_clone" method="post" action="<?=base_url('admin/form_edit_costing_charges_clone')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="c_id2" class="control-label col-lg-2 text-danger">Charge Name *</label>
                                                <div class="col-lg-4">
                                                    <select id="c_id2" name="c_id" required class="select2 form-control round-input">
                                                        <option value="" rate="" percentage="">Select Charge</option>
                                                        <?php
                                                        foreach($charges as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>" rate="<?=$val['amount']?>" percentage="<?=$val['percentage']?>"><?=$val['charge']?> [<?=$val['charge_group']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <input type="hidden" id="percentage2" name="percentage">

                                                <label for="rate4" class="control-label col-lg-2 text-danger">Rate *</label>
                                                <div class="col-lg-4">
                                                    <input id="rate4" name="rate" type="number" min="0" required placeholder="Rate" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="quantity4" class="control-label col-lg-2 text-danger">Quantity *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity4" name="quantity" type="number" min="0" required placeholder="Quantity" class="form-control round-input">
                                                </div>

                                                <label for="amount4" class="control-label col-lg-2">Amount</label>
                                                <div class="col-lg-4">
                                                    <input id="amount4" name="amount" type="number" min="0" readonly placeholder="Amount" class="form-control round-input">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable7" value="1" required class="iCheck-square-green">
                                                    <label for="enable7" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable7" value="0" required class="iCheck-square-red">
                                                    <label for="disable7" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="costing_charges_id" name="costing_charges_id" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Update Article Costing Charge</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Other Charges:
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body other-charges">
                            <?php #echo '<pre>', print_r($charges_with_percentage), '</pre>' ?>
                            <?php
                                if(count($charges_with_percentage) == 0){
                                    echo '<p class="text-center">All items with percentage are used in the costing.</p>';
                                }else{
                                    foreach($charges_with_percentage as $cwp){
                                        ?>
                                        <div> 
                                            <p class='text-center text-capitalize'> <?= strtolower($cwp['charge']) ?></p>
                                            <input data-charges-id="<?= $cwp['c_id'] ?>" type="number" step="0.01" min="0" placeholder="Percentage" value="<?= $cwp['percentage'] ?>" class="form-control round-input">
                                            <button type="button" class="percentage_add_button btn btn-primary active center-block">Add</button>
                                            <hr />
                                        </div>
                                        <?php
                                    }
                                }
                                
                            ?>
                        </div>
                    </section>
                </div>
            </div>

            <!--clone button-->
            <section class="panel text-center">
                <button type="submit" form="form_edit_article_costing_clone" class="btn btn-warning"><i class="fa fa-clone"> Clone Article Costing</i></button>
            </section>

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
<!--Select2-->
<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>
<script>
    $('.select2').select2();
</script>
<!--Icheck-->
<script src="<?=base_url();?>assets/admin_panel/js/icheck/skins/icheck.min.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/icheck-init.js"></script>
<!--form validation-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js"></script>
<!--ajax form submit-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>

<script>
    $(document).ready(function() {
        $('#article_measurement_table').DataTable( {
            "lengthMenu": [
                [ 10, 25, 50, 1000 ],
                [ '10', '25', '50', 'All' ]
            ],
            "dom": 'Blfrtip',
            "buttons": [
               {
                    extend: 'pdf',
                    footer: true,
                    title: 'Measurement PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }
               },
               {
                    extend: 'excel',
                    footer: true,
                    title: 'Measurement Excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }    
               }
           ],
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_costing_measurement_table_data_clone')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_costing_id: function () {
                        return $("#article_costing_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "item" },
                { "data": "color" },
                { "data": "length" },
                { "data": "width" },
                { "data": "pieces" },
                { "data": "wastage_percentage" },
                { "data": "unit" },
                { "data": "area1" },
                { "data": "area2" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [10], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );

        $('#costing_details_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_costing_details_table_data_clone')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_costing_id: function () {
                        return $("#article_costing_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "group_name" },
                { "data": "item" },
                { "data": "color" },
                { "data": "quantity" },
                { "data": "rate" },
                { "data": "amount" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [4,6], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );

        $('#costing_charges_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_costing_charges_table_data_clone')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_costing_id: function () {
                        return $("#article_costing_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "charge" },
                { "data": "percentage" },
                { "data": "quantity" },
                { "data": "rate" },
                { "data": "amount" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3,5], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );
    } );

    //edit-article-costing-form validation and submit
    $("#form_edit_article_costing_clone").validate({
        rules: {
            am_id: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_costing_amId')?>",
                    type: "post",
                    data: {
                        article_costing_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_costing_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_costing_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            window.location.href = obj.url;
        }
    });

    //add-article-costing-measurement-form validation and submit
    $("#form_add_article_measurement_clone").validate({
        rules: {
            id_id: {
                required: true,
                // remote: {
                //     url: "< ?=base_url('ajax_unique_article_costing_item_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_measurement_id: '',
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_add_article_measurement_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article_measurement_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            // $('#form_add_article_measurement_clone')[0].reset(); //reset form
            // $("#form_add_article_measurement_clone select").select2("val", ""); //reset all select2 fields
            // $('#form_add_article_measurement_clone :radio').iCheck('update'); //reset all iCheck fields
            // $("#form_add_article_measurement_clone").validate().resetForm(); //reset validation
            $("#length").val("");
            $("#width").val("");
            $("#pieces").val("");
            // $("#wastage_percentage").val("");
            
            $("#length").focus();
            notification(obj);
            
            //refresh table
            $('#article_measurement_table').DataTable().ajax.reload();
            $('#costing_details_table').DataTable().ajax.reload();

            $('#ig_id').select2('open');
            
            // calculate costing values through ajax
            // console.log(obj.costing_id); 
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //edit-article-costing-measurement-form validation and submit
    $("#form_edit_article_measurement_clone").validate({
        rules: {
            id_id: {
                required: true,
                // remote: {
                //     url: "< ?=base_url('ajax_unique_article_costing_item_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_measurement_id: function () {
                //             return $("#costing_measurement_id").val();
                //         },
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_measurement_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_measurement_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#article_measurement_table').DataTable().ajax.reload();
            $('#costing_details_table').DataTable().ajax.reload();

            // calculate costing values through ajax
            // console.log(obj.costing_id);
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //article-costing-measurement edit button
    $("#article_measurement_table").on('click', '.costing_measurement_edit_btn', function() {
        acm_id = $(this).attr('acm_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_costing_measurement_clone') ?>",
            method: "post",
            dataType: 'json',
            data: {'acm_id':acm_id,},
            success: function(data){
                $("#costing_measurement_id").val(data.acm_id);
                $("#id_id2").select2("val", data.id_id).change();
                $("#length2").val(data.length);
                $("#width2").val(data.width);
                $("#pieces2").val(data.pieces);
                $("#wastage_percentage2").val(data.wastage_percentage).change();
                if(data.status == '1'){$("#enable3").iCheck('check');} else if(data.status == '0'){$("#disable3").iCheck('check');}

                $('#measurement_edit_tab').removeClass('disabled');
                $('#measurement_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#article_measurement_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //add-costing_details-form validation and submit
    $("#form_add_costing_details_clone").validate({
        rules: {
            id_id: {
                required: true,
                // remote: {
                //     url: "<?=base_url('ajax_unique_article_costing_details_item_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_details_id: '',
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_add_costing_details_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_costing_details_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_costing_details_clone')[0].reset(); //reset form
            $("#form_add_costing_details_clone select").select2("val", ""); //reset all select2 fields
            $('#form_add_costing_details_clone :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_costing_details_clone").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#costing_details_table').DataTable().ajax.reload();

            // calculate costing values through ajax
            // console.log(obj.costing_id); 
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //edit-costing_details-form validation and submit
    $("#form_edit_costing_details_clone").validate({
        rules: {
            id_id: {
                required: true,
                // remote: {
                //     url: "< ?=base_url('ajax_unique_article_costing_details_item_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_details_id: function () {
                //             return $("#costing_details_id").val();
                //         },
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_edit_costing_details_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_costing_details_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#costing_details_table').DataTable().ajax.reload();
            // calculate costing values through ajax
            console.log(obj.costing_id); 
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //costing_details_table edit button
    $("#costing_details_table").on('click', '.costing_details_edit_btn', function() {
        acd_id = $(this).attr('acd_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_costing_details_clone') ?>",
            method: "post",
            dataType: 'json',
            data: {'acd_id':acd_id,},
            success: function(data){
                $("#costing_details_id").val(data.acd_id);
                $("#id_id4").select2("val", data.id_id);
                $("#rate2").val(data.rate);
                $("#quantity2").val(data.quantity).change();
                if(data.status == '1'){$("#enable5").iCheck('check');} else if(data.status == '0'){$("#disable5").iCheck('check');}

                $('#details_edit_tab').removeClass('disabled');
                $('#details_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#costing_details_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //add-costing_charges-form validation and submit
    $("#form_add_costing_charges_clone").validate({
        rules: {
            c_id: {
                required: true,
                // remote: {
                //     url: "< ?=base_url('ajax_unique_article_costing_charge_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_charges_id: '',
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_add_costing_charges_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_costing_charges_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_costing_charges_clone')[0].reset(); //reset form
            $("#form_add_costing_charges_clone select").select2("val", ""); //reset all select2 fields
            $('#form_add_costing_charges_clone :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_costing_charges_clone").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#costing_charges_table').DataTable().ajax.reload();

            // calculate costing values through ajax
            // console.log(obj.costing_id); 
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //edit-costing_charges-form validation and submit
    $("#form_edit_costing_charges_clone").validate({
        rules: {
            c_id: {
                required: true,
                // remote: {
                //     url: "<?=base_url('ajax_unique_article_costing_charge_clone')?>",
                //     type: "post",
                //     data: {
                //         article_costing_id: function () {
                //             return $("#article_costing_id").val();
                //         },
                //         costing_charges_id: function () {
                //             return $("#costing_charges_id").val();
                //         },
                //     },
                // },
            },
        },
        messages: {

        }
    });
    $('#form_edit_costing_charges_clone').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_costing_charges_clone").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#costing_charges_table').DataTable().ajax.reload();

            // calculate costing values through ajax
            // console.log(obj.costing_id); 
            $costing_id = obj.costing_id;
            costing_calc($costing_id);
        }
    });

    //costing_charges_table edit button
    $("#costing_charges_table").on('click', '.costing_charges_edit_btn', function() {
        acc_id = $(this).attr('acc_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_costing_charges_clone') ?>",
            method: "post",
            dataType: 'json',
            data: {'acc_id':acc_id,},
            success: function(data){
                $("#costing_charges_id").val(data.acc_id);
                $("#c_id2").select2("val", data.c_id);
                $("#percentage2").val(data.percentage);
                $("#rate4").val(data.rate);
                $("#quantity4").val(data.quantity).change();
                if(data.status == '1'){$("#enable7").iCheck('check');} else if(data.status == '0'){$("#disable7").iCheck('check');}

                $('#charges_edit_tab').removeClass('disabled');
                $('#charges_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#costing_charges_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //fetch article image
    $("#am_id").on('change', function () {
        am_id = $("#am_id").val();

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_master_image') ?>",
            method: "post",
            dataType: 'json',
            data: {'am_id':am_id,},
            success: function(data){
                $('#article_img').attr('src', '<?=base_url()?>assets/admin_panel/img/article_img/'+data.img);
            },
        });
    });
    //on item change
    //swap
    $("#existing_item_dtl").on('change', function(){
        $ig_id = $('#existing_item_dtl option:selected').attr('item_group_val');
        $str = '';
        $.ajax({
            url: "<?= base_url('admin/all-items-on-item-group-id') ?>",
            dataType: 'json',
            method: 'POST',
            data: {'item_group' : $ig_id},
            success: function(all_items){
                // console.log(all_items);
                $("#id_id").html("");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' item_group_val=' + item.value + ' unit=' + item.unit + '> '+ item.item_name + '-' + item.color + '</option>';
                    $("#proposed_item").append($str);
                });
                // open the item tray 
                $('#proposed_item').select2('open');
            },
            error: function(e){
                console.log(e);
            }
        });
    });
    // - measurement
    $("#ig_id").on('change', function(){
        $ig_id = $('#ig_id option:selected').val();
        $str = '';
        $.ajax({
            url: "<?= base_url('admin/all-items-on-item-group-id') ?>",
            dataType: 'json',
            method: 'POST',
            data: {'item_group' : $ig_id},
            success: function(all_items){
                // console.log(all_items);
                $("#id_id").html("");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + ' item_group_val=' + item.value + ' unit=' + item.unit + '> '+ item.item_name + '-' + item.color + '</option>';
                    $("#id_id").append($str);
                });
                // open the item tray 
                $('#id_id').select2('open');
            },
            error: function(e){
                console.log(e);
            }
        });
    });

    // costing sheet 
    $("#ig_id_alies").on('change', function(){
        $ig_id = $('#ig_id_alies option:selected').val();
        $str ='';
        $.ajax({
            url: "<?= base_url('admin/all-items-on-item-group-id') ?>",
            dataType: 'json',
            method: 'POST',
            data: {'item_group' : $ig_id},
            success: function(all_items){
                // console.log(all_items);
                $("#id_id3").html("");
                $.each(all_items, function(index, item) {
                    $str = '<option value=' + item.id_id + '> '+ item.item_name + '-' + item.color + '</option>';
                    $("#id_id3").append($str);
                });
                // open the item tray 
                $('#id_id3').select2('open');
            },
            error: function(e){
                console.log(e);
            }
        });
    });

    $("#id_id").on('change', function () {
        unit = $('#id_id option:selected').attr('unit');
        $('#unit').val(unit);

        area1 = $('#area1').val();
        grp_value = $('#id_id option:selected').attr('item_group_val');
        if(area1 && grp_value > 0) {
            area2 = (area1 / grp_value).toFixed(3);
            $('#area2').val(area2);
        }

        // fetch buyer item names
        $.ajax({
            url: "<?= base_url('ajax-fetch-mapped-item') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id':id_id},
            success: function(buyerData){
                console.log(buyerData);
                if(buyerData != false){
                    $("#buyer_map").text(buyerData.msg);   
                }
                // obj = JSON.parse(buyerData);
                // notification(buyerData);
            },
            error: function(e){
                console.log('error: ' + e);
            }
        });
    });
    $("#id_id2").on('change', function () {
        unit = $('#id_id2 option:selected').attr('unit');
        $('#unit2').val(unit);

        area1 = $('#area12').val();
        grp_value = $('#id_id2 option:selected').attr('item_group_val');
        if(area1 && grp_value > 0) {
            area2 = (area1 / grp_value).toFixed(3);
            $('#area22').val(area2);
        }
    });
    //area1 calculation
    $("#length, #width, #pieces, #wastage_percentage").on('change', function () {
        var length = $('#length').val();
        var width = $('#width').val();
        var pieces = $('#pieces').val();
        var wastage_percentage = $('#wastage_percentage').val();

        area1 = (parseFloat(length * width * pieces) + (parseFloat(length * width * pieces * wastage_percentage) / 100)).toFixed(3);
        $('#area1').val(area1);

        grp_value = $('#id_id option:selected').attr('item_group_val');
        if(grp_value > 0) {
            area2 = (area1 / grp_value).toFixed(3);
            $('#area2').val(area2);
        }
    });
    $("#length2, #width2, #pieces2, #wastage_percentage2").on('change', function () {
        var length = $('#length2').val();
        var width = $('#width2').val();
        var pieces = $('#pieces2').val();
        var wastage_percentage = $('#wastage_percentage2').val();

        area1 = (parseFloat(length * width * pieces) + (parseFloat(length * width * pieces * wastage_percentage) / 100)).toFixed(3);
        $('#area12').val(area1);

        grp_value = $('#id_id2 option:selected').attr('item_group_val');
        if(grp_value > 0) {
            area2 = (area1 / grp_value).toFixed(3);
            $('#area22').val(area2);
        }
    });
    //fetch costing details rate
    $("#id_id3").on('change', function () {
        id_id = $('#id_id3').val();

        $.ajax({
            url: "<?= base_url('ajax_fetch_rate_by_item_detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id':id_id,},
            success: function(data){
                $('#rate').val(data.rate).change();
            },
        });
    });
    $("#id_id4").on('change', function () {
        id_id = $('#id_id4').val();

        $.ajax({
            url: "<?= base_url('ajax_fetch_rate_by_item_detail') ?>",
            method: "post",
            dataType: 'json',
            data: {'id_id':id_id,},
            success: function(data){
                $('#rate2').val(data.rate).change();
            },
        });
    });
    //calculate costing details amount
    $("#rate, #quantity").on('change', function () {
        var rate = $('#rate').val();
        var quantity = $('#quantity').val();

        amount = parseFloat(rate * quantity).toFixed(2);
        $('#amount').val(amount);
    });
    $("#rate2, #quantity2").on('change', function () {
        var rate = $('#rate2').val();
        var quantity = $('#quantity2').val();

        amount = parseFloat(rate * quantity).toFixed(2);
        $('#amount2').val(amount);
    });
    //fetch costing charge rate
    $("#c_id").on('change', function () {
        rate = $('#c_id option:selected').attr('rate');
        percentage = $('#c_id option:selected').attr('percentage');

        $('#rate3').val(rate).change();
        $('#percentage').val(percentage);
    });
    $("#c_id2").on('change', function () {
        rate = $('#c_id2 option:selected').attr('rate');
        percentage = $('#c_id2 option:selected').attr('percentage');

        $('#rate4').val(rate).change();
        $('#percentage2').val(percentage);
    });
    //calculate costing charge amount
    $("#rate3, #quantity3").on('change', function () {
        var rate = $('#rate3').val();
        var quantity = $('#quantity3').val();

        amount = parseFloat(rate * quantity).toFixed(2);
        $('#amount3').val(amount);
    });
    $("#rate4, #quantity4").on('change', function () {
        var rate = $('#rate4').val();
        var quantity = $('#quantity4').val();

        amount = parseFloat(rate * quantity).toFixed(2);
        $('#amount4').val(amount);
    });

    //toastr notification
    function notification(obj) {
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "7000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    };

    $(document).on('click','.percentage_add_button',function(){
        $this = $(this);
        $per = $(this).prevAll('input').val();
        $c_id = $(this).prevAll('input').attr('data-charges-id');
        $ac_id = <?= $this->uri->segment(3) ?>;

        $.ajax({
            url: "<?= base_url('admin/form_add_costing_charges_percentage/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {percentage: $per, charge_id : $c_id, cost_id: $ac_id },
            success: function (returnData) {
                // remove currently added data 
                $this.closest('div').remove();
                notification(returnData);
                //refresh table
                $('#costing_charges_table').DataTable().ajax.reload();

                // calculate costing values through ajax
                $costing_id = returnData.costing_id;
                costing_calc($costing_id);
            },
            error: function (returnData) {
                obj = JSON.parse(returnData);
                notification(obj);
            }
        });

    });
    

// delete area 
    // $(document).ready(function(){
        $(document).on('click', '.delete', function(){
            $this = $(this);
            if(confirm("Are You Sure? This Process Can\'t be Undone.")){
                $pk = $(this).attr('data-pk');
                $tab = $(this).attr('data-tab');
                $id_id = $(this).attr('data-id_id');
                $ac_id = <?= $this->uri->segment(3) ?>;
                $area2 = $(this).attr('data-area2');

                $.ajax({
                    url: "<?= base_url('admin/del-row-on-table-pk-clone/') ?>",
                    dataType: 'json',
                    type: 'POST',
                    data: {pk: $pk, tab : $tab, cost_id: $ac_id, id_id: $id_id, area2: $area2},
                    success: function (returnData) {
                        // console.log(returnData);
                        // remove the tr instantly
                        $this.closest('tr').remove();
                        // remove the item from from right panel for data-tab = article measurement table
                        if($tab == 'article_measurement_table_clone'){
                            $('.right-items[data-wrap="'+$id_id+'"]').next('hr').remove();
                            $('.right-items[data-wrap="'+$id_id+'"]').remove();
                        }

                        if($tab == 'article_charge_table_clone'){
                            // console.log(returnData.res[0]);
                            $str1 = "<div><p class='text-center text-capitalize'>"+ returnData.res[0].charge_name.toLowerCase() +"</p>";
                            $str2 = "<input data-charges-id='"+returnData.res[0].charge_id+"' type='number' step='0.01' min='0' placeholder='Percentage' value="+returnData.res[0].percentage+" class='form-control round-input'>";
                            $str3 = "<button type='button' class='percentage_add_button btn btn-primary active center-block'>Add</button></div>";
                            $str = $str1 + $str2 + $str3;
                            // alert($str);

                            $('.other-charges').append($str);
                        }
                        
                        notification(returnData);
                        //refresh table
                        $('#article_measurement_table').DataTable().ajax.reload();
                        $('#costing_details_table').DataTable().ajax.reload();

                        // calculate costing values through ajax
                        $costing_id = returnData.costing_id;
                        costing_calc($costing_id);


                    },
                    error: function (returnData) {
                        console.log(returnData)
                        obj = JSON.parse(returnData);
                        notification(obj);
                    }
                });
            }
            
        });
    // });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });    

// final costing calculations
function costing_calc($costing_id){
        $.ajax({
            url: "<?= base_url('admin/calculate_article_costing_clone/') ?>",
            dataType: 'json',
            type: 'POST',
            data: {ci : $costing_id},
            success: function(cost_calc_values){
                console.log(cost_calc_values);
                // variable declarations
                $item_cost = 0;
                $total_prime = 0;
                $total = 0;
                $total_inc_fr = 0;
                $other_commission = 0;
                $fob_charge=0;
                $fr = 0;
                $ex = 0;
                $com_per = 0;
                // only costings
                $.each(cost_calc_values.costing, function(index, item) {
                    // console.log(item);
                    $item_cost += parseFloat(item.cost_qnty) * parseFloat(item.cost_rate); 
                });
                // alert($item_cost.toFixed(2));
                // only charges
                $.each(cost_calc_values.charges, function(index, itemCharge) {
                    // console.log(itemCharge);
                    
                    if(itemCharge.charge_group.toLowerCase() == 'charge'){
                        $total_prime += parseFloat(itemCharge.charge_qnty) * parseFloat(itemCharge.charge_rate);
                    }
                });
                $full_prime = ($item_cost+$total_prime);
                // alert($full_prime.toFixed(2));
                // overhead area but 'FREIGHT' is ignored
                $.each(cost_calc_values.charges, function(index, itemChargecond) {
                    if(itemChargecond.charge_name.toLowerCase() == 'freight'){
                        return;
                    }
                    if(itemChargecond.charge_group.toLowerCase() == 'overhead and others'){
                        if(itemChargecond.charge_name.toLowerCase() == 'overhead'){
                            if(itemChargecond.charge_percentage == ''){
                                $over_per = 0;
                            }else{
                                $over_per = itemChargecond.charge_percentage;
                            }
                            $per_val = parseFloat($full_prime) * parseFloat($over_per/100);
                            $total += $per_val ;
                        }else{
                            $total += ParseFloat(itemChargecond.charge_qnty) * parseFloat(itemChargecond.charge_rate);
                        }
                    }
                });
                 // overhead area but only 'FREIGHT' is taken
                $.each(cost_calc_values.charges, function(index, itemChargecond2) {
                    if(itemChargecond2.charge_name.toLowerCase() == 'freight'){
                        $fr = (parseFloat(itemChargecond2.charge_qnty) * parseFloat(itemChargecond2.charge_rate));
                    }
                });

                $l_total = ($item_cost+$total_prime+$total+$fr).toFixed(2);

                $.each(cost_calc_values.charges, function(index, itemChargecond3) {
                    if(itemChargecond3.charge_group.toLowerCase() == 'commission and others'){                        

                        if(itemChargecond3.charge_name.toLowerCase() == 'commission'){
                            $com_per = parseFloat(itemChargecond3.charge_percentage);
                        }else if(itemChargecond3.charge_name.toLowerCase() == 'fob charge'){
                            $fob_charge = parseFloat(itemChargecond3.charge_qnty) * parseFloat(itemChargecond3.charge_rate);
                        }else{
                            $other_commission += parseFloat(itemChargecond3.charge_qnty) * parseFloat(itemChargecond3.charge_rate);
                        }

                    }
                });


                $ex = parseFloat($l_total) +  parseFloat($other_commission) - parseFloat($fr);
                $total_com = parseFloat($ex) * (parseFloat($com_per)/100);
                $cnf = $total_com + $ex + ($fr);
                $fob = $total_com + $ex + ($fob_charge);


                $("#exworks_amt").val($ex.toFixed(2));
                $("#cf_amt").val($cnf.toFixed(2));
                $("#fob_amt").val($fob.toFixed(2));

                $("form#form_edit_article_costing_clone").submit();
                // return true;

            },
            error: function(){
                console.log('error');
            }
        });
}


    $(document).on('click','#swap_item_dtl',function(){
        $exis_id = $('#existing_item_dtl option:selected').val();    
        $prop_id = $('#proposed_item option:selected').val();
        $ac_id = <?= $this->uri->segment(3) ?>;

        $.ajax({
            url: "<?= base_url('admin/costing-clone-swap-item') ?>",
            dataType: 'json',
            type: 'POST',
            data: {exis_id: $exis_id, prop_id : $prop_id, cost_id: $ac_id },
            success: function (returnData) {
                //refresh table
                $('#article_measurement_table').DataTable().ajax.reload();
                $('#costing_details_table').DataTable().ajax.reload();
                notification(returnData);
            },
            error: function (returnData) {
                obj = JSON.parse(returnData);
                notification(obj);
            }
        });

    });

</script>

</body>
</html>
