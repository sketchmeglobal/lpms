<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 26-02-2020
 * Time: 14:40
 * Last updated on 29-mar-2021 at 04:30 pm
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Item | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit item">

    <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!--fileinput-->
    <link href="<?=base_url();?>assets/admin_panel/js/bootstrap-fileinput-master/css/fileinput.css" rel="stylesheet" />

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
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
            <h3 class="m-b-less">Edit Item</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> <a href="<?=base_url('admin/item_master');?>">GO BACK TO BROWSER </a></li>
                    <li class="active"> Edit Item </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Item-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?=$item->item?> [<?=$item->im_code?>]
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form id="form_edit_item" method="post" action="<?=base_url('admin/form_edit_item')?>" class="cmxform form-horizontal tasi-form">
                                    <div class="form-group ">
                                        <div class="col-lg-3">
                                            <label for="item_group" class="control-label text-danger">Item Group *</label>
                                            <select id="item_group" name="item_group" required class="select2 form-control round-input">
                                                <option value="" group_code="">Select Item Group</option>
                                                <?php
                                                foreach($item_groups as $val) {
                                                    $selected = '';
                                                    if($val['ig_id'] == $item->ig_id){$selected='selected';}
                                                    ?>
                                                    <option <?=$selected?> value="<?=$val['ig_id']?>" group_code="<?=$val['ig_code']?>"><?=$val['group_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="item_code" class="control-label text-danger">Item Code *</label>
                                            <input value="<?=$item->im_code?>" id="item_code" name="item_code" type="text" placeholder="Item code" required class="form-control round-input" />
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="size" class="control-label text-danger">Size *</label>
                                            <select id="size" name="size" required class="select2 form-control round-input">
                                                <option value="" size="">Select size</option>
                                                <?php
                                                foreach($sizes as $val) {
                                                    $selected = '';
                                                    if($val['sz_id'] == $item->sz_id){$selected='selected';}
                                                    ?>
                                                    <option <?=$selected?> value="<?=$val['sz_id']?>" size="<?=$val['size']?>"><?=$val['size']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="size" class="control-label text-danger">Shape *</label>
                                            <select id="shape" name="shape" required class="select2 form-control round-input">
                                                <option value="" shape="">Select shape</option>
                                                <?php
                                                foreach($shapes as $val) {
                                                    $selected = '';
                                                    if($val['sh_id'] == $item->sh_id){$selected='selected';}
                                                    ?>
                                                    <option <?=$selected?> value="<?=$val['sh_id']?>" shape="<?=$val['shape']?>"><?=$val['shape']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-lg-3">
                                            <label for="size" class="control-label text-danger">Unit *</label>
                                            <select id="unit" name="unit" required class="select2 form-control round-input">
                                                <option value="" unit="">Select unit</option>
                                                <?php
                                                foreach($units as $val) {
                                                    $selected = '';
                                                    if($val['u_id'] == $item->u_id){$selected='selected';}
                                                    ?>
                                                    <option <?=$selected?> value="<?=$val['u_id']?>" shape="<?=$val['unit']?>"><?=$val['unit']. ' - ' . $val['info']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="desc1" class="control-label">Description I</label>
                                            <input value="<?=$item->info_1?>" id="desc1" name="desc1" type="text" placeholder="First description" class="form-control round-input" />
                                        </div>            
                                        <div class="col-lg-3">
                                            <label for="desc2" class="control-label">Description II</label>
                                            <input value="<?=$item->info_2?>" id="desc2" name="desc2" type="text" placeholder="Second description" class="form-control round-input" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="item_name" class="control-label text-danger">Item Name *</label>
                                            <input value="<?=$item->item?>" id="item_name" name="item_name" type="text" placeholder="Name of the item" required class="form-control round-input" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-lg-3">
                                            <label for="item_type" class="control-label text-danger">Item Type *</label>
                                            <select id="item_type" name="item_type" required class="select2 form-control round-input">
                                                <option value="" <?php if($item->type == ''){echo 'selected';} ?>>Select type</option>
                                                <option value="None" <?php if($item->type == 'None'){echo 'selected';} ?>>None</option>
                                                <option value="Local" <?php if($item->type == 'Local'){echo 'selected';} ?>>Local</option>
                                                <option value="Import" <?php if($item->type == 'Import'){echo 'selected';} ?>>Import</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="thick" class="control-label">Thickness</label>
                                            <input value="<?=$item->thick?>" id="thick" name="thick" type="text" placeholder="Thickness" class="form-control round-input" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="buy_code" class="control-label">Buy Code</label>
                                            <input value="<?=$item->buy_code?>" id="buy_code" name="buy_code" type="text" placeholder="Buy code" class="form-control round-input" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="hsn_code" class="control-label">HSN Code</label>
                                            <input value="<?=$item->hsn_code?>" id="hsn_code" name="hsn_code" type="text" placeholder="HSN Code" class="form-control round-input" />
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-lg-3">
                                            <label class="control-label text-danger">Enlist in Jobber? *</label><br>
                                            <input <?php if($item->enlist_jobber == '1'){echo 'checked';} ?> type="radio" name="jobber" id="yes" value="1" required class="iCheck-square-green">
                                            <label for="yes" class="control-label">Yes</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input <?php if($item->enlist_jobber == '0'){echo 'checked';} ?> type="radio" name="jobber" id="no" value="0" required class="iCheck-square-red">
                                            <label for="no" class="control-label">No</label>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <label class="control-label text-danger">Enlist in Costing? *</label><br>
                                            <input <?php if($item->enlist_costing == '1'){echo 'checked';} ?> type="radio" name="show_in_costing" id="yes1" value="1" required class="iCheck-square-green">
                                            <label for="yes1" class="control-label">Yes</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input <?php if($item->enlist_costing == '0'){echo 'checked';} ?> type="radio" name="show_in_costing" id="no1" value="0" required class="iCheck-square-red">
                                            <label for="no1" class="control-label">No</label>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="control-label text-danger">Status *</label> <br>
                                            <input <?php if($item->status == '1'){echo 'checked';} ?> type="radio" name="status" id="enable1" value="1" required class="iCheck-square-green">
                                            <label for="enable1" class="control-label">Enable</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input <?php if($item->status == '0'){echo 'checked';} ?> type="radio" name="status" id="disable1" value="0" required class="iCheck-square-red">
                                            <label for="disable1" class="control-label">Disable</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="img" class="control-label">Image</label>
                                            <input type="file" id="imgg" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="text-center" style="display:block;margin:auto;">
                                            <input type="hidden" id="item_id" name="item_id" class="item_id" value="<?=$item->im_id?>">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Item</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            
            <!--Item Colors-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Color Details of <?=$item->item?> [<?=$item->im_code?>]
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="item_color_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#color_list" data-toggle="tab">List</a></li>
                                <li><a href="#color_add" data-toggle="tab">Add</a></li>
                                <li id="color_edit_tab" class="disabled"><a href="#color_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="color_list" class="tab-pane fade in active">
                                    <table id="item_color_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Clr.</th>
                                            <th>Opn. St.</th>
                                            <th>Opn. Qty. For Lth. St.</th>
                                            <th>Opn. Rt.</th>
                                            <th>Plating Rt.</th>
                                            <th>Reorder</th>
                                            <th>Img.</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="color_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_item_color" method="post" action="<?=base_url('admin/form_add_item_color')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="color" class="control-label text-danger">Color *</label>
                                                    <select id="color" name="color" required class="select2 form-control round-input">
                                                        <option value="">Select Color</option>
                                                        <?php
                                                        foreach($colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="opening_stock" class="control-label">Opening Stock</label>
                                                    <input id="opening_stock" name="opening_stock" type="number" min="0" placeholder="Opening Stock" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="opn_qnty_for_leather_status" class="control-label">Opening Rate</label>
                                                    <input id="opening_rate" name="opening_rate" type="number" placeholder="Opening Rate" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="plating_rate_add" class="control-label">Plating Rate</label><br>
                                                    <input id="plating_rate_add" name="plating_rate_add" type="number" placeholder="Plating Rate" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="opn_qnty_for_leather_status" class="control-label">Opening Quantity For Leather Status</label>
                                                    <input id="opn_qnty_for_leather_status" name="opn_qnty_for_leather_status" type="number" placeholder="Opening Quantity For Leather Status" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="virtual_opng_stock_add" class="control-label">Virtual Opening Stock</label><br>
                                                    <input id="virtual_opng_stock_add" name="virtual_opng_stock_add" type="number" placeholder="Virtual Opening Stock" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="virtual_opng_rate_add" class="control-label">Virtual Opening Rate</label><br>
                                                    <input id="virtual_opng_rate_add" name="virtual_opng_rate_add" type="number" min="0" placeholder="Virtual Opening Rate" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="reorder" class="control-label">Reorder if Below</label><br>
                                                    <input id="reorder" name="reorder" type="number" min="0" placeholder="Reorder when stock quantity is less than" class="form-control round-input" />
                                                </div>           
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-3">
                                                    <label for="img" class="control-label">Image</label><br>
                                                    <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                                </div> 
                                                <div class="col-lg-3">
                                                    <label class="control-label text-danger">Status *</label><br>
                                                    <input type="radio" name="status" id="enable2" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable2" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable2" value="0" required class="iCheck-square-red">
                                                    <label for="disable2" class="control-label">Disable</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-center" style="display:block;margin:auto;">
                                                    <input type="hidden" name="item_id" class="item_id" value="<?=$item->im_id?>">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Item Color</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="color_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_item_color" method="post" action="<?=base_url('admin/form_edit_item_color')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="color2" class="control-label text-danger">Color *</label>
                                                    <select disabled id="color2" name="color" required class="select2 form-control round-input">
                                                        <option value="">Select Color</option>
                                                        <?php
                                                        foreach($edit_colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="opening_stock_edit" class="control-label">Opening Stock</label>
                                                    <input id="opening_stock_edit" name="opening_stock_edit" type="number" min="0" placeholder="Opening Stock" class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="opening_stock_edit" class="control-label">Opening Rate</label>
                                                    <input id="opening_rate_edit" name="opening_rate_edit" type="number" placeholder="Opening Rate" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="plating_rate_edit" class="control-label">Plating Rate</label>
                                                    <input id="plating_rate_edit" name="plating_rate_edit" type="number" placeholder="Plating Rate" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="opn_qnty_for_leather_status_edit" class="control-label">Opening Quantity For Leather Status</label>
                                                    <input id="opn_qnty_for_leather_status_edit" name="opn_qnty_for_leather_status_edit" type="number" placeholder=" Enter Opening Quantity For Leather Status" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="virtual_opng_stock_edit" class="control-label">Virtual Opening Stock</label><br>
                                                    <input id="virtual_opng_stock_edit" name="virtual_opng_stock_edit" type="number" placeholder="Virtual Opening Stock" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="virtual_opng_rate_edit" class="control-label">Virtual Opening Rate</label><br>
                                                    <input id="virtual_opng_rate_edit" name="virtual_opng_rate_edit" type="number" min="0" placeholder="Virtual Opening Rate" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="reorder2" class="control-label">Reorder if Below</label>
                                                    <input id="reorder2" name="reorder" type="number" min="0" placeholder="Reorder when stock quantity is less than" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-3">
                                                    <label for="img2" class="control-label">Image</label>
                                                    <input type="file" id="img2" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <label class="control-label text-danger">Status *</label><br>
                                                    <input type="radio" name="status" id="enable3" value="1" required class="iCheck-square-green">
                                                    <label for="enable3" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable3" value="0" required class="iCheck-square-red">
                                                    <label for="disable3" class="control-label">Disable</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="text-center" style="display:block;margin:auto;">
                                                    <input type="hidden" id="item_dtl_id" name="item_dtl_id" value="">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Item Color</button>
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

            <!--Item Rates-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Item Rate of <?=$item->item?> [<?=$item->im_code?>] - <span style="font-size: 18px;font-weight: bold;color: #ffffff;text-shadow: 2px 2px 3px #000000" class="item_color_rate_header"></span>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="item_rate_tabs" class="nav nav-tabs nav-justified">
                                <li id="rate_list_tab" class="disabled"><a href="#rate_list" data-toggle="">List</a></li>
                                <li id="rate_add_tab" class="disabled"><a href="#rate_add" data-toggle="">Add</a></li>
                                <li id="rate_edit_tab" class="disabled"><a href="#rate_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="rate_list" class="tab-pane fade">
                                    <table id="item_color_rate_table" class="table data-table dataTable" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Purchase Rate</th>
                                            <th>Cost Rate</th>
                                            <th>Plating Rate</th>
                                            <th>GST (%)</th>
                                            <th>Effective Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="rate_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_item_color_rate" method="post" action="<?=base_url('admin/form_add_item_color_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="supplier" class="control-label text-danger">Supplier Name *</label>
                                                    <select id="supplier" name="supplier" required class="select2 form-control round-input">
                                                        <option value="">Select Supplier</option>
                                                        <?php
                                                        foreach($acc_master as $val) {
                                                            ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['name']?> - [<?=$val['am_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="eff_date" class="control-label text-danger">Effective Date *</label>
                                                    <input id="eff_date" name="eff_date" type="date" value="<?= date('Y-m') ?>-01" max="<?= date('Y-m-d') ?>" required class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="pur_rate" class="control-label text-danger">Purchase Rate *</label>
                                                    <input id="pur_rate" name="pur_rate" type="number" min="0" placeholder="Purchase rate" required class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="cost_rate" class="control-label text-danger">Cost Rate *</label>
                                                    <input id="cost_rate" name="cost_rate" type="number" min="0" placeholder="Cost rate" required class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                
                                                <div class="col-lg-3">
                                                    <label for="plating_rate_add1" class="control-label">Plating Rate</label>
                                                    <input id="plating_rate_add1" name="plating_rate_add1" type="number" min="0" placeholder="Plating rate" required class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="gst" class="control-label text-danger">GST (%) *</label>
                                                    <input id="gst" name="gst" type="number" min="0" placeholder="GST percentage" required class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label class="control-label text-danger">Status *</label> <br>
                                                    <input type="radio" name="status" id="enable4" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable4" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable4" value="0" required class="iCheck-square-red">
                                                    <label for="disable4" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="text-center" style="margin:auto;display:block">
                                                    <input type="hidden" name="item_dtl_id" class="item_dtl_id" value="">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Item Color Rate</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="rate_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_item_color_rate" method="post" action="<?=base_url('admin/form_edit_item_color_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="supplier2" class="control-label text-danger">Supplier Name *</label>
                                                    <select id="supplier2" name="supplier" required class="select2 form-control round-input">
                                                        <option value="">Select Supplier</option>
                                                        <?php
                                                        foreach($acc_master as $val) {
                                                            ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['name']?> - [<?=$val['am_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="eff_date2" class="control-label text-danger">Effective Date *</label>
                                                    <input id="eff_date2" name="eff_date" type="date" max="<?= date('Y-m-d') ?>" required class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="pur_rate2" class="control-label text-danger">Purchase Rate *</label>
                                                    <input id="pur_rate2" name="pur_rate" type="number" min="0" placeholder="Purchase rate" required class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="cost_rate2" class="control-label text-danger">Cost Rate *</label>
                                                    <input id="cost_rate2" name="cost_rate" type="number" min="0" placeholder="Cost rate" required class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <div class="col-lg-3">
                                                    <label for="plating_rate_edit1" class="control-label">Plating Rate</label>
                                                    <input id="plating_rate_edit1" name="plating_rate_edit1" type="number" min="0" placeholder="Plating rate" class="form-control round-input" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="gst2" class="control-label text-danger">GST (%) *</label>
                                                    <input id="gst2" name="gst" type="number" min="0" placeholder="GST percentage" required class="form-control round-input" />
                                                </div>

                                                <div class="col-lg-3">
                                                    <label class="control-label text-danger">Status *</label> <br>
                                                    <input type="radio" name="status" id="enable5" value="1" required class="iCheck-square-green">
                                                    <label for="enable5" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable5" value="0" required class="iCheck-square-red">
                                                    <label for="disable5" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="text-center" style="margin:auto;display:block">
                                                    <input type="hidden" id="item_rate_id" name="item_rate_id" value="">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Item Color Rate</button>
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

            <!-- Buyer repository --- HIDDEN / NOT IN USE -->

            <div class="row hidden">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Buyer Codes for <?=$item->item?> [<?=$item->im_code?>] (<span style="font-size: 18px;font-weight: bold;color: #ffffff;text-shadow: 2px 2px 3px #000000" class="item_color_rate_header"></span>)
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="item_buy_codes_tabs" class="nav nav-tabs nav-justified">
                                <li id="buy_code_list_tab" class="disabled"><a href="#buy_code_list" data-toggle="tab">List</a></li>
                                <li id="buy_code_add_tab" class="disabled"><a href="#buy_code_add" data-toggle="tab">Add</a></li>
                                <li id="buy_code_edit_tab" class="disabled"><a href="#buy_code_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="buy_code_list" class="tab-pane fade in active">
                                    <table id="item_buy_code_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Account Master Name</th>
                                            <th>Buyer Item name</th>
                                            <th>Buyer Item Code</th>
                                            <th>Buyer Item Colour</th>
                                            <th>Buyer Item Colour code</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="buy_code_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                    <input type="hidden" class="form-control" id="main_color_id1" name="main_color_id1">
                                    <input type="hidden" class="form-control" id="ig_id1" name="ig_id1" value="<?=$item->ig_id?>">
                                    
                                        <form id="form_add_item_buy_code" method="post" action="<?=base_url('admin/form_add_item_buy_code')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                              <input type="hidden" class="form-control" id="main_color_id" name="main_color_id"> 
                                              <input type="hidden" class="form-control" id="ig_id" name="ig_id">
                                               
                                                <div class="col-lg-4">
                                                <label for="account_master_code" class="control-label text-danger">Account Master(Buyer) *</label>
                                                    <select id="account_master_code" name="account_master_code" required class="select2 form-control round-input">
                                                        <option value="">Select Account Master(Buyer)</option>
                                                        <?php
                                                        foreach($acc_master as $val) {
                                                            ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['name']?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                
                                                <div class="col-lg-4">
                                                <label for="im_id" class="control-label text-danger">Item name(known by other Buyer) *</label>
                                                    <select id="im_id" name="im_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item name</option>
                                                        <?php
                                                        foreach($items as $val) {
                                                            ?>
                                                            <option value="<?=$val['im_id']?>"><?=$val['item']?> [<?=$val['im_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="customer_item_code" class="control-label text-danger">Item Code(known by other Buyer) * </label>
                                                    <input id="customer_item_code" name="customer_item_code" type="text"  placeholder="Item Code" class="form-control round-input" />
                                                </div>
                                                
                                             </div>
                                             
                                             <div class="form-group ">   
                                                <div class="col-lg-4">
                                                <label for="c_id" class="control-label text-danger">Colour Id(known by other Buyer)*</label>
                                                    <select id="c_id" name="c_id" required class="select2 form-control round-input">
                                                        <option value="">Select Colour Id</option>
                                                        <?php
                                                        foreach($all_colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="customer_colour_code" class="control-label text-danger">Colour Code(known by other Buyer) * </label>
                                                    <input id="customer_colour_code" name="customer_colour_code" type="text"  placeholder="Colour Code" class="form-control round-input" />
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                <label class="control-label text-danger">Status *</label></br>
                                                
                                                    <input type="radio" name="status" id="enable0" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable0" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable0" value="0" required class="iCheck-square-red">
                                                    <label for="disable0" class="control-label">Disable</label>
                                                </div>
                                                

                                                
                                                <!--<div class="col-lg-3">
                                                <label for="buying_code" class="control-label text-danger">Selling Code * </label>
                                                    <input id="buying_code" name="buying_code" type="text"  placeholder="Selling Code" class="form-control round-input" />
                                                </div>-->
                                            </div>

                                            <div class="form-group ">
                                                <div class="col-lg-offset-3 col-lg-2">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Selling Code</button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="item_id" class="item_id" value="<?=$item->im_id?>">
                                        </form>
                                    </div>
                                </div>

                                <div id="buy_code_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_item_buy_code" method="post" action="<?=base_url('admin/form_edit_item_buy_code')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                        <div class="form-group ">
                                                
                                                <div class="col-lg-4">
                                                <label for="account_master_code_edit" class="control-label  text-danger">Account Master *</label>
                                                
                                                
                                                    <select disabled id="account_master_code_edit" name="account_master_code_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Account Master</option>
                                                        <?php
                                                        foreach($acc_master as $val) {
                                                            ?>
                                                            <option value="<?=$val['am_id']?>"><?=$val['name']?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                <label for="im_id_edit" class="control-label text-danger">Item name(known by other Buyer) *</label>
                                                    <select id="im_id_edit" name="im_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Item name</option>
                                                        <?php
                                                        foreach($items as $val) {
                                                            ?>
                                                            <option value="<?=$val['im_id']?>"><?=$val['item']?> [<?=$val['im_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="customer_item_code_edit" class="control-label text-danger">Item Code(known by other Buyer) * </label>
                                                    <input id="customer_item_code_edit" name="customer_item_code_edit" type="text"  placeholder="Item Code" class="form-control round-input" />
                                                </div>
                                                

                                                
                                                <!--<div class="col-lg-4">
                                                <label for="buying_code_edit" class="control-label text-danger">Selling Code * </label>
                                                    <input id="buying_code_edit" name="buying_code_edit" type="text"  placeholder="Selling Code" class="form-control round-input" />
                                                </div>-->
                                            </div>

                                            <div class="form-group ">
                                            
                                            <div class="col-lg-4">
                                                <label for="c_id_edit" class="control-label text-danger">Colour Id(known by other Buyer)*</label>
                                                    <select id="c_id_edit" name="c_id_edit" required class="select2 form-control round-input">
                                                        <option value="">Select Colour Id</option>
                                                        <?php
                                                        foreach($all_colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                <label for="customer_colour_code_edit" class="control-label text-danger">Colour Code(known by other Buyer) * </label>
                                                    <input id="customer_colour_code_edit" name="customer_colour_code_edit" type="text"  placeholder="Colour Code" class="form-control round-input" />
                                                </div>
                                                
                                                
                                                <div class="col-lg-4">
                                                <label class="control-label text-danger">Status *</label></br>
                                                    <input type="radio" name="status" id="enable6" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable6" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable6" value="0" required class="iCheck-square-red">
                                                    <label for="disable6" class="control-label">Disable</label>
                                                </div>
                                               </div>
                                               <div class="form-group "> 
                                                
                                                <div class="col-lg-offset-2">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Update Buying Code</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="ibc_id" class="ibc_id" value="">                                            
                                        </form>
                                    </div>
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
<!--fileinput-->
<script src="<?=base_url();?>assets/admin_panel/js/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script>
    $("#img, #img2, #imgg").fileinput({
        // browseClass : "btn btn-danger",
        maxFileSize : 1000, //1 Mb
        allowedFileExtensions : ['jpg','jpeg','png'],
        showUpload: false,
    });
</script>

<script>
    $(document).ready(function() {

        // Item Buying codes table

        $('#item_buy_code_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_item_buy_code_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    item_id: function () {
                        return $("#item_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "name" },
                { "data": "buyer_item_name" },
				{ "data": "buyer_item_code" },
				{ "data": "buyer_item_color" },
                { "data": "buyer_item_color_code" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [5], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );
    

        $('#item_color_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_item_color_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    item_id: function () {
                        return $("#item_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "color" },
                { "data": "opening_stock" },
                { "data": "opn_qnty_for_leather_status" },
                { "data": "opening_rate" },
                { "data": "plating_rate" },
                { "data": "reorder_qnty" },
                { "data": "img" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6,8], //disable 'Image' & 'Actions' column sorting
                "orderable": false,
            }]
        } );

        $('#item_color_rate_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_item_color_rate_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    item_dtl_id: function () {
                        return $("#item_dtl_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "name" },
                { "data": "purchase_rate" },
                { "data": "cost_rate" },
                { "data": "plating_rate" },
                { "data": "gst_percentage" },
                { "data": "effective_date" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [6], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );
    } );

    //edit-item-form validation and submit
    $("#form_edit_item").validate({
        rules: {
            item_code: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_code')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                    },
                },
            },
            item_name: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_name')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_item').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);
        }
    });

    // buy code validation and submit 
    $("#form_add_item_buy_code").validate({
        rules: {
            /*account_master_code: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_buy_code')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                    },
                },
            },*/
			account_master_code: {
                required: true,
            },
            buying_code: {
                required: true,
            },
        },
        messages: {

        }
    });
    $('#form_add_item_buy_code').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            
            $('#form_add_item_buy_code')[0].reset(); //reset form
            $("#form_add_item_buy_code select").select2("val", ""); //reset all select2 fields
            $('#form_add_item_buy_code :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item_buy_code").validate().resetForm(); //reset validation

            notification(obj);
            //refresh table
            $('#item_buy_code_table').DataTable().ajax.reload();
        }
    });

     // buy code validation and submit 
     $("#form_edit_item_buy_code").validate({
        rules: {
            buying_code_edit: {
                required: true,
            },
        },
        messages: {

        }
    });
    $('#form_edit_item_buy_code').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item_buy_code").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
            notification(obj);
            //refresh table
            $('#item_buy_code_table').DataTable().ajax.reload();
        }
    });

    //buy-code edit button
    $("#item_buy_code_table").on('click', '.item_buying_code_edit_btn', function() {
        item_buying_code_id = $(this).attr('item_buying_code_id');
        item_id = $("#item_id").val();

        $.ajax({
            url: "<?= base_url('admin/ajax_fetch_buy_code_details') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_buying_code_id':item_buying_code_id},
            success: function(data){
                // console.log(data);
                data = data[0];
                $(".ibc_id").val(data.ibc_id);
                $("#account_master_code_edit").select2("val", data.am_id);
				$("#im_id_edit").select2("val", data.buyer_im_id);
				$("#customer_item_code_edit").val(data.customer_item_code);
				$("#c_id_edit").select2("val", data.c_id);				
                $("#customer_colour_code_edit").val(data.customer_colour_code);
                if(data.status == '1'){$("#enable6").iCheck('check');} else if(data.status == '0'){$("#disable6").iCheck('check');}

                $('#buy_code_edit_tab').removeClass('disabled');
                $('#buy_code_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#item_buy_codes_tabs li:eq(2) a').tab('show');
            },
        });
    });
    

    //add-item-color-form validation and submit
    $("#form_add_item_color").validate({
        rules: {
            color: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_color')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                        item_dtl_id: '',
                    },
                },
            },
            
        },
        messages: {

        }
    });
    $('#form_add_item_color').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_item_color").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_item_color')[0].reset(); //reset form
            $("#form_add_item_color select").select2("val", ""); //reset all select2 fields
            $('#form_add_item_color :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item_color").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#item_color_table').DataTable().ajax.reload();
        }
    });

    //edit-item-color-form validation and submit
    $("#form_edit_item_color").validate({
        rules: {
            color: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_item_color')?>",
                    type: "post",
                    data: {
                        item_id: function () {
                            return $("#item_id").val();
                        },
                        item_dtl_id: function () {
                            return $("#item_dtl_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_item_color').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item_color").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#item_color_table').DataTable().ajax.reload();
        }
    });

    //item-dtl edit button
    $("#item_color_table").on('click', '.item_dtl_edit_btn', function() {
        item_dtl_id = $(this).attr('item_dtl_id');
		$main_color_id1 = $(this).attr('main_color_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_item_color') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_dtl_id':item_dtl_id,},
            success: function(data){
                // console.log(data);
                // return false;
                $("#item_dtl_id, .item_dtl_id").val(data.id_id);
                $(".item_color_rate_header").html(data.color);
                $("#color2").select2("val", data.c_id);
                $("#opening_stock_edit").val(data.opening_stock);
                $("#opening_rate_edit").val(data.opening_rate);
                $("#plating_rate_edit").val(data.plating_rate);
                $("#opn_qnty_for_leather_status_edit").val(data.opn_qnty_for_leather_status);
                $("#reorder2").val(data.reorder_qnty);
                $("#virtual_opng_stock_edit").val(data.virtual_opng_stock);
                $("#virtual_opng_rate_edit").val(data.virtual_opng_rate);
                $('#img2').fileinput('reset');
                if(data.status == '1'){$("#enable3").iCheck('check');} else if(data.status == '0'){$("#disable3").iCheck('check');}

                $('#color_edit_tab').removeClass('disabled');
                $('#color_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#item_color_tabs li:eq(2) a').tab('show');

                $('#rate_list_tab, #rate_add_tab').removeClass('disabled');
                $('#rate_edit_tab').addClass('disabled');
                $('#rate_list_tab, #rate_add_tab').children("a").attr("data-toggle", 'tab');
                $('#rate_edit_tab').children("a").attr("data-toggle", '');
				
				//
				$('#main_color_id1').val($main_color_id1);
				$('#buy_code_list_tab, #buy_code_add_tab').removeClass('disabled');
                $('#buy_code_edit_tab').addClass('disabled');
                $('#buy_code_list_tab, #buy_code_add_tab').children("a").attr("data-toggle", 'tab');
                $('#buy_code_edit_tab').children("a").attr("data-toggle", '');
				$('#item_buy_codes_tabs li:eq(0) a').tab('show');
				//
                
				$("#supplier2").select2("val", "");
                $('#form_edit_item_color_rate')[0].reset();
                $('#item_rate_tabs li:eq(0) a').tab('show');

                //refresh item-color-rate table
                $('#item_color_rate_table').DataTable().ajax.reload();
            },
        });
    });
	
	$("#account_master_code").on("change", function() {
		$main_color_id = $('#main_color_id1').val();
		$('#main_color_id').val($main_color_id);
		
		$ig_id = $('#ig_id1').val();
		$('#ig_id').val($ig_id);
	});
	
	
    //add-item-color-rate-form validation and submit
    $("#form_add_item_color_rate").validate({
        rules: {
            eff_date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_supp_item_color_rate_eff_date')?>",
                    type: "post",
                    data: {
                        item_dtl_id: function () {
                            return $("#item_dtl_id").val();
                        },
                        supplier: function () {
                            return $("#supplier").val();
                        },
                        item_rate_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_item_color_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_item_color_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_item_color_rate')[0].reset(); //reset form
            $("#form_add_item_color_rate select").select2("val", ""); //reset all select2 fields
            $('#form_add_item_color_rate :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_item_color_rate").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#item_color_rate_table').DataTable().ajax.reload();
        }
    });

    //edit-item-color-rate-form validation and submit
    $("#form_edit_item_color_rate").validate({
        rules: {
            eff_date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_supp_item_color_rate_eff_date')?>",
                    type: "post",
                    data: {
                        item_dtl_id: function () {
                            return $("#item_dtl_id").val();
                        },
                        supplier: function () {
                            return $("#supplier2").val();
                        },
                        item_rate_id: function () {
                            return $("#item_rate_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_item_color_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_item_color_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#item_color_rate_table').DataTable().ajax.reload();
        }
    });

    //item-rate edit button
    $("#item_color_rate_table").on('click', '.item_rate_edit_btn', function() {
        item_rate_id = $(this).attr('item_rate_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_item_rate') ?>",
            method: "post",
            dataType: 'json',
            data: {'item_rate_id':item_rate_id,},
            success: function(data){
                $("#item_rate_id").val(data.ir_id);
                $("#supplier2").select2("val", data.am_id);
                $("#gst2").val(data.gst_percentage);
                $("#pur_rate2").val(data.purchase_rate);
                $("#cost_rate2").val(data.cost_rate);
                $("#plating_rate_edit1").val(data.plating_rate);
                $("#eff_date2").val(data.effective_date);
                if(data.status == '1'){$("#enable5").iCheck('check');} else if(data.status == '0'){$("#disable5").iCheck('check');}

                $('#rate_edit_tab').removeClass('disabled');
                $('#rate_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#item_rate_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //when item group changed
    $("#item_group").on("change", function() {
        item_code = '';
        group_code = $('option:selected', this).attr('group_code');

        if(group_code != '') {item_code = group_code+'-'};

        $("#item_code").val(item_code);
		
		$ig_id = $('#item_group').val();
		$('#ig_id').val($ig_id);
		$('#ig_id1').val($ig_id);
    });

    //generating item name
    $("#size, #shape, #desc1, #desc2").on("change", function() {
        item_name = '';
        size = $('option:selected', $("#size")).attr('size');
        shape = $('option:selected', $("#shape")).attr('shape');
        desc1 = $("#desc1").val();
        desc2 = $("#desc2").val();

        if(size != '' && size != 'None') {item_name = size+'-'};
        if(shape != '' && shape != 'None') {item_name = item_name+shape+'-'};
        if(desc1 != '') {item_name = item_name+desc1+'-'};
        if(desc2 != '') {item_name = item_name+desc2};

        $("#item_name").val(item_name);
    });

    // delete area 
    $(document).on('click', '.delete', function(){
        if(confirm('Are you sure?')){
            $tab = $(this).attr('tab');
            $pk_name = $(this).attr('pk-name');
            $pk_value = $(this).attr('pk-value');
            $child = $(this).attr('child');
            $ref_table = $(this).attr('ref-table');
            $ref_pk_name = $(this).attr('ref-pk-name');
            
            $.ajax({
                url: "<?= base_url('ajax-del-row-on-table-and-pk') ?>",
                type: 'POST',
                dataType: 'json',
                data:{tab: $tab, pk_name: $pk_name, pk_value: $pk_value, child: $child, ref_table: $ref_table, ref_pk_name: $ref_pk_name},
                success: function(returnData){
                    // console.log(returnData);
                    notification(returnData);
                    // redraw all tables 
                    $('#item_color_rate_table').DataTable().ajax.reload();
                    $('#item_color_table').DataTable().ajax.reload();
                    $('#item_buy_code_table').DataTable().ajax.reload();
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