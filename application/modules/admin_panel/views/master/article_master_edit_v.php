
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Article | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit article">

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
    <style>
        input[type=number] {
            text-align:right;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0; 
        }
        
        .table>tbody>tr:last-child>td, .table>tbody>tr:last-child>th, .table>tbody>tr:last-child>td, .table>tbody>tr:last-child>td, .table>tbody:last-child>tr:last-child>td, .table>tbody:last-child>tr:last-child>td 
        {
            white-space: nowrap;
        }
        
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
            <h3 class="m-b-less">Edit Article</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Edit Article </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit <?=$article->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <form id="form_edit_article" method="post" action="<?=base_url('admin/form_edit_article')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <label for="ag_id" class="control-label col-lg-2 text-danger">Article Group *</label>
                                    <div class="col-lg-4">
                                        <select id="ag_id" name="ag_id" required class="select2 form-control round-input">
                                            <option value="">Select group</option>
                                            <?php
                                            foreach($article_groups as $val) {
                                                $selected = '';
                                                if($val['ag_id'] == $article->ag_id){$selected='selected';}
                                                ?>
                                                <option <?=$selected?> value="<?=$val['ag_id']?>"><?=$val['group_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="customer_id" class="control-label col-lg-2">Customer</label>
                                    <div class="col-lg-4">
                                        <select id="customer_id" name="customer_id" class="select2 form-control round-input">
                                            <option value="">Select customer</option>
                                            <?php
                                            foreach($customers as $val) {
                                                $selected = '';
                                                if($val['am_id'] == $article->customer_id){$selected='selected';}
                                                ?>
                                                <option <?=$selected?> value="<?=$val['am_id']?>"><?=$val['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="art_no" class="control-label col-lg-2 text-danger">Article No *</label>
                                    <div class="col-lg-4">
                                        <input id="art_no" name="art_no" value="<?=$article->art_no?>" type="text" placeholder="Article Number" required class="form-control round-input" />
                                    </div>

                                    <label for="alt_art_no" class="control-label col-lg-2">Alternate Article No</label>
                                    <div class="col-lg-4">
                                        <input id="alt_art_no" name="alt_art_no" value="<?=$article->alt_art_no?>" type="text" placeholder="Alternate Article Number" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="info" class="control-label col-lg-2">Description</label>
                                    <div class="col-lg-4">
                                        <input id="info" name="info" type="text" value="<?=$article->info?>" placeholder="Article description" class="form-control round-input" />
                                    </div>

                                    <label for="design" class="control-label col-lg-2">Design</label>
                                    <div class="col-lg-4">
                                        <input id="design" name="design" type="text" value="<?=$article->design?>" placeholder="Design details" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="pack_dtl" class="control-label col-lg-2">Packing Details</label>
                                    <div class="col-lg-4">
                                        <input id="pack_dtl" name="pack_dtl" type="text" value="<?=$article->pack_dtl?>" placeholder="Packing details" class="form-control round-input" />
                                    </div>

                                    <label for="carton_id" class="control-label col-lg-2">Carton</label>
                                    <div class="col-lg-4">
                                        <select id="carton_id" name="carton_id" class="select2 form-control round-input">
                                            <option value="">Select carton</option>
                                            <?php
                                            foreach($cartons as $val) {
                                                $selected = '';
                                                if($val['im_id'] == $article->carton_id){$selected='selected';}
                                                ?>
                                                <option <?=$selected?> value="<?=$val['im_id']?>"><?=$val['item']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="info" class="control-label col-lg-2">Gross weight/Carton</label>
                                    <div class="col-lg-4">
                                        <input id="gross_weight_per_carton" name="gross_weight_per_carton" type="text" placeholder="Gross weight/Carton" class="form-control round-input" value="<?=$article->gross_weight_per_carton?>" />
                                    </div>

                                    <label for="design" class="control-label col-lg-2">Number of Article/Carton</label>
                                    <div class="col-lg-4">
                                        <input id="number_of_article_per_carton" name="number_of_article_per_carton" type="text" placeholder="Number of Article/Carton" class="form-control round-input"  value="<?=$article->number_of_article_per_carton?>"/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="leather_type" class="control-label col-lg-2">Leather Type</label>
                                    <div class="col-lg-4">
                                        <select id="leather_type" name="leather_type" class="select2 form-control round-input">
                                            <option value="">Select leather type</option>
                                            <?php
                                            foreach($leather_types as $val) {
                                                $selected = '';
                                                if($val == $article->leather_type){$selected='selected';}
                                                ?>
                                                <option <?=$selected?> value="<?=$val?>"><?=$val?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="emboss" class="control-label col-lg-2">Emboss</label>
                                    <div class="col-lg-4">
                                        <input id="emboss" name="emboss" type="text" value="<?=$article->emboss?>" placeholder="Emboss" class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="date" class="control-label col-lg-2">Date</label>
                                    <div class="col-lg-4">
                                        <input id="date" name="date" type="date" value="<?=$article->date?>" class="form-control round-input" />
                                    </div>

                                    <label for="exworks_amt" class="control-label col-lg-2">Ex-Works</label>
                                    <div class="col-lg-4">
                                        <input id="exworks_amt" name="exworks_amt" type="number" value="<?=$article->exworks_amt?>" placeholder="Ex-Works amount" readonly class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="cf_amt" class="control-label col-lg-2">C & F</label>
                                    <div class="col-lg-4">
                                        <input id="cf_amt" name="cf_amt" type="number" value="<?=$article->cf_amt?>" placeholder="C & F amount" readonly class="form-control round-input" />
                                    </div>

                                    <label for="fob_amt" class="control-label col-lg-2">F.O.B</label>
                                    <div class="col-lg-4">
                                        <input id="fob_amt" name="fob_amt" type="number" value="<?=$article->fob_amt?>" placeholder="F.O.B amount" readonly class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="leather_type_info" class="control-label col-lg-2">Type of Leather</label>
                                    <div class="col-lg-4">
                                        <input id="leather_type_info" name="leather_type_info" type="text" value="<?=$article->leather_type_info?>" placeholder="Type of leather" class="form-control round-input" />
                                    </div>

                                    <label for="metal_fitting" class="control-label col-lg-2">Metal Fittings</label>
                                    <div class="col-lg-4">
                                        <input id="metal_fitting" name="metal_fitting" type="text" value="<?=$article->metal_fitting?>" placeholder="Metal fittings" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="brand" class="control-label col-lg-2">Brand Name</label>
                                    <div class="col-lg-4">
                                        <input id="brand" name="brand" type="text" value="<?=$article->brand?>" placeholder="Brand name" class="form-control round-input" />
                                    </div>

                                    <label for="hand_machine" class="control-label col-lg-2">Hand / Machine (%)</label>
                                    <div class="col-lg-4">
                                        <input id="hand_machine" name="hand_machine" type="text" value="<?=$article->hand_machine?>" placeholder="Hand / Machine %" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="size" class="control-label col-lg-2">Size (Cms)</label>
                                    <div class="col-lg-4">
                                        <input id="size" name="size" type="text" value="<?=$article->size?>" placeholder="Size in centimeters" class="form-control round-input" />
                                    </div>

                                    <label for="remark" class="control-label col-lg-2">Remark/HSCode</label>
                                    <div class="col-lg-4">
                                        <input id="remark" name="remark" type="text" value="<?=$article->remark?>" placeholder="Remark/HSCode" class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="cutting_rate_a" class="control-label col-lg-2">Cutting Rate - A</label>
                                    <div class="col-lg-4">
                                        <input id="cutting_rate_a" name="cutting_rate_a" type="number" min="0" value="<?=$article->cutting_rate_a?>" placeholder="Cutting rate - A" class="form-control round-input" />
                                    </div>

                                    <label for="cutting_rate_b" class="control-label col-lg-2">Cutting Rate - B</label>
                                    <div class="col-lg-4">
                                        <input id="cutting_rate_b" name="cutting_rate_b" type="number" min="0" value="<?=$article->cutting_rate_b?>" placeholder="Cutting rate - B" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="skiving_rate_a" class="control-label col-lg-2">Sample Rate</label>
                                    <div class="col-lg-4">
                                        <input id="skiving_rate_a" name="skiving_rate_a" type="number" min="0" value="<?=$article->skiving_rate_a?>" placeholder="Sample Rate" class="form-control round-input" />
                                    </div>

                                    <label for="skiving_rate_b" class="control-label col-lg-2">Skiving Rate</label>
                                    <div class="col-lg-4">
                                        <input id="skiving_rate_b" name="skiving_rate_b" type="number" min="0" value="<?=$article->skiving_rate_b?>" placeholder="Skiving Rate" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="fabrication_rate_a" class="control-label col-lg-2">Fabrication Rate - A</label>
                                    <div class="col-lg-4">
                                        <input id="fabrication_rate_a" name="fabrication_rate_a" type="number" min="0" value="<?=$article->fabrication_rate_a?>" placeholder="Fabrication rate - A" class="form-control round-input" />
                                    </div>

                                    <label for="fabrication_rate_b" class="control-label col-lg-2">Fabrication Rate - B</label>
                                    <div class="col-lg-4">
                                        <input id="fabrication_rate_b" name="fabrication_rate_b" type="number" min="0" value="<?=$article->fabrication_rate_b?>" placeholder="Fabrication rate - B" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="wl_rate_a" class="control-label col-lg-2">Weight</label>
                                    <div class="col-lg-4">
                                        <input id="wl_rate_a" name="wl_rate_a" type="number" min="0" value="<?=$article->wl_rate_a?>" placeholder="Weight - Leather code - A" class="form-control round-input" />
                                    </div>

                                    <label for="wl_rate_b" class="control-label col-lg-2">Leather Code</label>
                                    <div class="col-lg-4">
                                        <input id="wl_rate_b" name="wl_rate_b" type="number" min="0" value="<?=$article->wl_rate_b?>" placeholder="Weight - Leather code - B" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="credit_score" class="control-label col-lg-2">Credit Score</label>
                                    <div class="col-lg-2">
                                        <input id="credit_score" name="credit_score" type="number" min="0" step="0.01" value="<?=$article->credit_score?>" placeholder="Credit Score" class="form-control round-input" />
                                    </div>
                                    <label for="credit_score" class="control-label col-lg-2">Alter/Rejection Score</label>
                                    <div class="col-lg-2">
                                        <input id="alter_score" name="alter_score" type="number" min="0" step="0.01" value="<?=$article->alter_score?>" placeholder="Alter/Rejection Score" class="form-control round-input" />
                                    </div>
                                    
                                    <label for="img" class="control-label col-lg-1">Image</label>
                                    <div class="col-lg-3">
                                        <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                    </div>
                                </div>

                                <input type="hidden" id="article_id" name="article_id" class="article_id" value="<?=$article->am_id?>">

                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-danger">Status *</label>
                                    <div class="col-lg-4">
                                        <input <?php if($article->status == '1'){echo 'checked';} ?> type="radio" name="status" id="enable1" value="1" required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input <?php if($article->status == '0'){echo 'checked';} ?> type="radio" name="status" id="disable1" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Update Article</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <!--Article Colors-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Color Details of <?=$article->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="article_color_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#color_list" data-toggle="tab">List</a></li>
                                <li><a href="#color_add" data-toggle="tab">Add</a></li>
                                <li id="color_edit_tab" class="disabled"><a href="#color_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="color_list" class="tab-pane fade in active">
                                    <table id="article_color_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Leather Color</th>
                                            <th>Fittings Color</th>
                                            <th>Image</th>
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
                                        <form id="form_add_article_color" method="post" action="<?=base_url('admin/form_add_article_color')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="lth_color_id" class="control-label col-lg-2 text-danger">Leather Color *</label>
                                                <div class="col-lg-4">
                                                    <select id="lth_color_id" name="lth_color_id" required class="select2 form-control round-input">
                                                        <option value="">Select Leather Color</option>
                                                        <?php
                                                        foreach($colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="fit_color_id" class="control-label col-lg-2 text-danger">Fittings Color *</label>
                                                <div class="col-lg-4">
                                                    <select id="fit_color_id" name="fit_color_id" required class="select2 form-control round-input">
                                                        <option value="">Select Fittings Color</option>
                                                        <?php
                                                        foreach($colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="img_color" class="control-label col-lg-2">Image</label>
                                                <div class="col-lg-4">
                                                    <input type="file" id="img_color" name="img_color" accept=".jpg,.jpeg,.png" class="file" >
                                                </div>
                                                
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable2" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable2" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable2" value="0" required class="iCheck-square-red">
                                                    <label for="disable2" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="article_id" class="article_id" value="<?=$article->am_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Color</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="color_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_article_color" method="post" action="<?=base_url('admin/form_edit_article_color')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="lth_color_id2" class="control-label col-lg-2 text-danger">Leather Color *</label>
                                                <div class="col-lg-4">
                                                    <select id="lth_color_id2" name="lth_color_id" required class="select2 form-control round-input">
                                                        <option value="">Select Leather Color</option>
                                                        <?php
                                                        foreach($colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="fit_color_id2" class="control-label col-lg-2 text-danger">Fittings Color *</label>
                                                <div class="col-lg-4">
                                                    <select id="fit_color_id2" name="fit_color_id" required class="select2 form-control round-input">
                                                        <option value="">Select Fittings Color</option>
                                                        <?php
                                                        foreach($colors as $val) {
                                                            ?>
                                                            <option value="<?=$val['c_id']?>"><?=$val['color']?> - [<?=$val['c_code']?>]</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="img_color" class="control-label col-lg-2">Image</label>
                                                <div class="col-lg-4">
                                                    <input type="file" id="img_color" name="img_color" accept=".jpg,.jpeg,.png" class="file" >
                                                </div>
                                                
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable3" value="1" required class="iCheck-square-green">
                                                    <label for="enable3" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable3" value="0" required class="iCheck-square-red">
                                                    <label for="disable3" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="article_dtl_id" name="article_dtl_id" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Color</button>
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

            <!--Article Parts-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Parts of <?=$article->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="article_part_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#part_list" data-toggle="tab">List</a></li>
                                <li><a href="#part_add" data-toggle="tab">Add</a></li>
                                <li id="part_edit_tab" class="disabled"><a href="#part_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="part_list" class="tab-pane fade in active">
                                    <table id="article_part_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Item Group</th>
                                            <th>Pieces</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    </table>
                                </div>

                                <div id="part_add" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_article_part" method="post" action="<?=base_url('admin/form_add_article_part')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="ig_id" class="control-label col-lg-2 text-danger">Item Group *</label>
                                                <div class="col-lg-4">
                                                    <select id="ig_id" name="ig_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item Group</option>
                                                        <?php
                                                        foreach($item_groups as $val) {
                                                            ?>
                                                            <option value="<?=$val['ig_id']?>"><?=$val['group_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="quantity" class="control-label col-lg-2 text-danger">Pieces *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity" name="quantity" type="text" placeholder="Quantity" required class="form-control round-input" />
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

                                            <input type="hidden" name="article_id" class="article_id" value="<?=$article->am_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Part</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="part_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_article_part" method="post" action="<?=base_url('admin/form_edit_article_part')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="ig_id2" class="control-label col-lg-2 text-danger">Item Group *</label>
                                                <div class="col-lg-4">
                                                    <select id="ig_id2" name="ig_id" required class="select2 form-control round-input">
                                                        <option value="">Select Item Group</option>
                                                        <?php
                                                        foreach($item_groups as $val) {
                                                            ?>
                                                            <option value="<?=$val['ig_id']?>"><?=$val['group_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="quantity2" class="control-label col-lg-2 text-danger">Pieces *</label>
                                                <div class="col-lg-4">
                                                    <input id="quantity2" name="quantity" type="text" placeholder="Quantity" required class="form-control round-input" />
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

                                            <input type="hidden" id="article_part_id" name="article_part_id" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Part</button>
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

            <!--Article Rates-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Rates of <?=$article->art_no?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="article_rate_tabs" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#rate_list" data-toggle="tab">List</a></li>
                                <li><a href="#rate_add" data-toggle="tab">Add</a></li>
                                <li id="rate_edit_tab" class="disabled"><a href="#rate_edit" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="rate_list" class="tab-pane fade in active">
                                    
                                    <?php 
                                    
                                    $currency_rows_vals = $this->db->get_where('article_rates', array('am_id' => $article->am_id))->result();
                                    
                                    if(count($currency_rows_vals) > 0) {
                                        $currency_row_val = $this->db->get_where('currencies', array('cur_id' => $currency_rows_vals[0]->cur_id))->row()->currency;
                                    } else {
                                        $currency_row_val = '';
                                    }
                                    
                                    ?>
                                    
                                    <table id="article_rate_table" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th> Curr. </th>
                                            <th> Conv. Rt. </th>
                                            <th> Final Ex-Works <br/> ( INR ) </th>
                                            <th> Final CIF <br/> ( INR ) </th>
                                            <th> Final F.O.B <br/> ( INR ) </th>
                                            <th>Final Ex-Works <br/> ( <?= $currency_row_val ?> )</th>
                                            <th>Final CIF <br/> ( <?= $currency_row_val ?> )</th>
                                            <th>Final F.O.B <br/> ( <?= $currency_row_val ?> )</th>
                                            <th> Remarks </th>
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
                                        <form id="form_add_article_rate" method="post" action="<?=base_url('admin/form_add_article_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="date2" class="control-label col-lg-2 text-danger">Date *</label>
                                                <div class="col-lg-4">
                                                    <input id="date2" name="date" type="date" required class="form-control round-input" />
                                                </div>

                                                <label for="remarks_main" class="control-label col-lg-2">Main Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_main" name="remarks_main" type="text" placeholder="Main remarks" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="cur_id" class="control-label col-lg-2 text-danger">Currency * </label>
                                                <div class="col-lg-2">
                                                    <select id="cur_id" name="cur_id" required class="select2 form-control round-input">
                                                        <option value="">Select Currency</option>
                                                        <?php
                                                        foreach($currencies as $val) {
                                                            ?>
                                                            <option <?= ($val['cur_id'] == $currency->cur_id) ? 'selected' : '' ?> value="<?=$val['cur_id']?>"><?=$val['currency']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="currency_rate" class="control-label col-lg-2">Currency Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="currency_rate" name="currency_rate" type="number" min="0" placeholder="Currency rate" class="form-control round-input" />
                                                </div>
                                                 <label for="conversion_rate" class="control-label col-lg-2">Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate" name="conversion_rate" type="number" min="0" placeholder="Conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            

                                            <div class="form-group ">
                                                <label for="exworks_factory" class="control-label col-lg-2">Factory Ex-Works (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_factory" name="exworks_factory" type="number" min="0" readonly placeholder="Factory ex-works" class="form-control round-input" value="<?=$article->exworks_amt?>" />
                                                </div>

                                                <label for="cf_factory" class="control-label col-lg-2">Factory C & F (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_factory" name="cf_factory" type="number" min="0" readonly placeholder="Factory C & F" class="form-control round-input" value="<?=$article->cf_amt?>" />
                                                </div>
                                                <label for="fob_factory" class="control-label col-lg-2">Factory F.O.B (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_factory" name="fob_factory" type="number" min="0" readonly placeholder="Factory F.O.B" class="form-control round-input" value="<?=$article->fob_amt?>" />
                                                </div>
                                            </div>
                                           
                                            <div class="form-group ">
                                                <label for="exworks_office" class="control-label col-lg-2">Office Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_office" name="exworks_office" readonly type="number" min="0" placeholder="Office ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_office" class="control-label col-lg-2">Office C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_office" name="cf_office" readonly type="number" min="0" placeholder="Office C & F" class="form-control round-input" />
                                                </div>
                                                <label for="fob_office" class="control-label col-lg-2">Office F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_office" name="fob_office" readonly type="number" min="0" placeholder="Office F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="conversion_rate_final" class="control-label col-lg-2">Final Conversion Rate</label>
                                                <div class="col-lg-4">
                                                    <input id="conversion_rate_final" name="conversion_rate_final" type="number" min="1" placeholder="Final conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="exworks_final" class="control-label col-lg-2">Final Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_final" name="exworks_final" readonly type="number" min="0" placeholder="Final ex-works" class="form-control round-input" />
                                                </div>
                                                <label for="cf_final" class="control-label col-lg-2">Final C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_final" name="cf_final" readonly type="number" min="0" placeholder="Final C & F" class="form-control round-input" />
                                                </div>

                                                <label for="fob_final" class="control-label col-lg-2">Final F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_final" name="fob_final" readonly type="number" min="0" placeholder="Final F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="remarks_final" class="control-label col-lg-2">Final Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_final" name="remarks_final" type="text" placeholder="Final remarks" class="form-control round-input" />
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

                                            <input type="hidden" name="article_id" class="article_id" value="<?=$article->am_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Rate</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="rate_edit" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_article_rate" method="post" action="<?=base_url('admin/form_edit_article_rate')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                <label for="date3" class="control-label col-lg-2 text-danger">Date *</label>
                                                <div class="col-lg-4">
                                                    <input id="date3" name="date" type="date" required class="form-control round-input" />
                                                </div>

                                                <label for="remarks_main2" class="control-label col-lg-2">Main Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_main2" name="remarks_main" type="text" placeholder="Main remarks" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="cur_id2" class="control-label col-lg-2 text-danger">Currency *</label>
                                                <div class="col-lg-2">
                                                    <select id="cur_id2" name="cur_id" required class="select2 form-control round-input">
                                                        <option value="">Select Currency</option>
                                                        <?php
                                                        foreach($currencies as $val) {
                                                            ?>
                                                            <option value="<?=$val['cur_id']?>"><?=$val['currency']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <label for="currency_rate2" class="control-label col-lg-2">Currency Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="currency_rate2" name="currency_rate" type="number" min="0" placeholder="Currency rate" class="form-control round-input" />
                                                </div>
                                                <label for="conversion_rate2" class="control-label col-lg-2">Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate2" name="conversion_rate" type="number" min="0" placeholder="Conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="exworks_factory2" class="control-label col-lg-2">Factory Ex-Works (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_factory2" name="exworks_factory" type="number" min="0" readonly placeholder="Factory ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_factory2" class="control-label col-lg-2">Factory C & F (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_factory2" name="cf_factory" type="number" min="0" readonly placeholder="Factory C & F" class="form-control round-input" />
                                                </div>
                                                 <label for="fob_factory2" class="control-label col-lg-2">Factory F.O.B (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_factory2" name="fob_factory" type="number" min="0" readonly placeholder="Factory F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="exworks_office2" class="control-label col-lg-2">Office Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_office2" name="exworks_office" readonly type="number" min="0" placeholder="Office ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_office2" class="control-label col-lg-2">Office C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_office2" name="cf_office" readonly type="number" min="0" placeholder="Office C & F" class="form-control round-input" />
                                                </div>
                                                <label for="fob_office2" class="control-label col-lg-2">Office F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_office2" name="fob_office" readonly type="number" min="0" placeholder="Office F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group ">
                                                <label for="conversion_rate_final2" class="control-label col-lg-2">Final Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate_final2" name="conversion_rate_final" type="number" min="1" placeholder="Final conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="exworks_final2" class="control-label col-lg-2">Final Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_final2" name="exworks_final" readonly type="number" min="0" placeholder="Final ex-works" class="form-control round-input" />
                                                </div>
                                                <label for="cf_final2" class="control-label col-lg-2">Final C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_final2" name="cf_final" readonly type="number" min="0" placeholder="Final C & F" class="form-control round-input" />
                                                </div>

                                                <label for="fob_final2" class="control-label col-lg-2">Final F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_final2" name="fob_final" readonly type="number" min="0" placeholder="Final F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="remarks_final2" class="control-label col-lg-2">Final Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_final2" name="remarks_final" type="text" placeholder="Final remarks" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status" id="enable7" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable7" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status" id="disable7" value="0" required class="iCheck-square-red">
                                                    <label for="disable7" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="article_rate_id" name="article_rate_id" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Rate</button>
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
            
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="background-color: #489750!important;">
                            Rates of <?=$article->art_no?> (For Office Purpose)
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <!--Tabs-->
                            <ul id="article_rate_tabs_new" class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#rate_list_new" data-toggle="tab">List</a></li>
                                <li><a href="#rate_add_new" data-toggle="tab">Add</a></li>
                                <li id="rate_edit_tab_new" class="disabled"><a href="#rate_edit_new" data-toggle="">Edit</a></li>
                            </ul>
                            <!--Tab Content-->
                            <div class="tab-content">
                                <div id="rate_list_new" class="tab-pane fade in active">
                                    
                                    
                                    <table id="article_rate_table_new" class="table data-table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th> Conv. Rt. </th>
                                            <th> Final Ex-Works <br/> ( INR ) </th>
                                            <th> Final CIF <br/> ( INR ) </th>
                                            <th> Final F.O.B <br/> ( INR ) </th>
                                            <th>Final Ex-Works <br/> </th>
                                            <th>Final CIF <br/> </th>
                                            <th>Final F.O.B <br/> </th>
                                            <th> Remarks </th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    
                                    
                                </div>

                                <div id="rate_add_new" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_add_article_rate_new" method="post" action="<?=base_url('admin/form_add_article_rate_new')?>" class="cmxform form-horizontal tasi-form">
                                            <div class="form-group ">
                                                
                                                
                                                <label for="date2_new" class="control-label col-lg-1 text-danger">Date *</label>
                                                <div class="col-lg-3">
                                                    <input id="date2_new" name="date_new" type="date" required class="form-control round-input" />
                                                </div>
                                                <label for="currency_rate_new" class="control-label col-lg-2">Currency Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="currency_rate_new" name="currency_rate_new" type="number" min="0" placeholder="Currency rate" class="form-control round-input" />
                                                </div>
                                                 <label for="conversion_rate_new" class="control-label col-lg-2">Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate_new" name="conversion_rate_new" type="number" min="0" placeholder="Conversion rate" class="form-control round-input" />
                                                </div>
                                                
                                                
                                            </div>
                                            

                                            <div class="form-group ">
                                                <label for="exworks_factory_new" class="control-label col-lg-2">Factory Ex-Works (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_factory_new" name="exworks_factory_new" type="number" min="0" placeholder="Factory ex-works" class="form-control round-input" value="<?=$article->exworks_amt?>" />
                                                </div>

                                                <label for="cf_factory_new" class="control-label col-lg-2">Factory C & F (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_factory_new" name="cf_factory_new" type="number" min="0" placeholder="Factory C & F" class="form-control round-input" value="<?=$article->cf_amt?>" />
                                                </div>
                                                <label for="fob_factory_new" class="control-label col-lg-2">Factory F.O.B (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_factory_new" name="fob_factory_new" type="number" min="0" placeholder="Factory F.O.B" class="form-control round-input" value="<?=$article->fob_amt?>" />
                                                </div>
                                            </div>
                                           
                                            <div class="form-group ">
                                                <label for="exworks_office_new" class="control-label col-lg-2">Office Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_office_new" name="exworks_office_new" type="number" min="0" placeholder="Office ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_office_new" class="control-label col-lg-2">Office C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_office_new" name="cf_office_new" type="number" min="0" placeholder="Office C & F" class="form-control round-input" />
                                                </div>
                                                <label for="fob_office_new" class="control-label col-lg-2">Office F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_office_new" name="fob_office_new" type="number" min="0" placeholder="Office F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="conversion_rate_final_new" class="control-label col-lg-2">Final Conversion Rate</label>
                                                <div class="col-lg-4">
                                                    <input id="conversion_rate_final_new" name="conversion_rate_final_new" type="number" min="1" placeholder="Final conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="exworks_final_new" class="control-label col-lg-2">Final Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_final_new" name="exworks_final_new" type="number" min="0" placeholder="Final ex-works" class="form-control round-input" />
                                                </div>
                                                <label for="cf_final_new" class="control-label col-lg-2">Final C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_final_new" name="cf_final_new" type="number" min="0" placeholder="Final C & F" class="form-control round-input" />
                                                </div>

                                                <label for="fob_final_new" class="control-label col-lg-2">Final F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_final_new" name="fob_final_new" type="number" min="0" placeholder="Final F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="remarks_final_new" class="control-label col-lg-2">Final Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_final_new" name="remarks_final_new" type="text" placeholder="Final remarks" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status_new" id="enable6" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable6" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status_new" id="disable6" value="0" required class="iCheck-square-red">
                                                    <label for="disable6" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" name="article_id_new" class="article_id_new" value="<?=$article->am_id?>">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Article Rate</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="rate_edit_new" class="tab-pane fade">
                                    <br/>
                                    <div class="form">
                                        <form id="form_edit_article_rate_new" method="post" action="<?=base_url('admin/form_edit_article_rate_new')?>" class="cmxform form-horizontal tasi-form">
                                            
                                            
                                            <div class="form-group ">
                                                
                                                
                                                <label for="date3_new" class="control-label col-lg-1 text-danger">Date *</label>
                                                <div class="col-lg-3">
                                                    <input id="date3_new" name="date_new" type="date" required class="form-control round-input" />
                                                </div>


                                                <label for="currency_rate2_new" class="control-label col-lg-2">Currency Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="currency_rate2_new" name="currency_rate_new" type="number" min="0" placeholder="Currency rate" class="form-control round-input" />
                                                </div>
                                                <label for="conversion_rate2_new" class="control-label col-lg-2">Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate2_new" name="conversion_rate_new" type="number" min="0" placeholder="Conversion rate" class="form-control round-input" />
                                                </div>


                                            </div>


                                            <div class="form-group ">
                                                <label for="exworks_factory2_new" class="control-label col-lg-2">Factory Ex-Works (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_factory2_new" name="exworks_factory_new" type="number" min="0" placeholder="Factory ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_factory2_new" class="control-label col-lg-2">Factory C & F (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_factory2_new" name="cf_factory_new" type="number" min="0" placeholder="Factory C & F" class="form-control round-input" />
                                                </div>
                                                 <label for="fob_factory2_new" class="control-label col-lg-2">Factory F.O.B (INR)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_factory2_new" name="fob_factory_new" type="number" min="0" placeholder="Factory F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="exworks_office2_new" class="control-label col-lg-2">Office Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_office2_new" name="exworks_office_new" type="number" min="0" placeholder="Office ex-works" class="form-control round-input" />
                                                </div>

                                                <label for="cf_office2_new" class="control-label col-lg-2">Office C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_office2_new" name="cf_office_new" type="number" min="0" placeholder="Office C & F" class="form-control round-input" />
                                                </div>
                                                <label for="fob_office2_new" class="control-label col-lg-2">Office F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_office2_new" name="fob_office_new" type="number" min="0" placeholder="Office F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group ">
                                                <label for="conversion_rate_final2_new" class="control-label col-lg-2">Final Conversion Rate</label>
                                                <div class="col-lg-2">
                                                    <input id="conversion_rate_final2_new" name="conversion_rate_final_new" type="number" min="1" placeholder="Final conversion rate" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="exworks_final2_new" class="control-label col-lg-2">Final Ex-Works (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="exworks_final2_new" name="exworks_final_new" type="number" min="0" placeholder="Final ex-works" class="form-control round-input" />
                                                </div>
                                                <label for="cf_final2_new" class="control-label col-lg-2">Final C & F (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="cf_final2_new" name="cf_final_new" type="number" min="0" placeholder="Final C & F" class="form-control round-input" />
                                                </div>

                                                <label for="fob_final2_new" class="control-label col-lg-2">Final F.O.B (<?= $currency->buyer_currency ?>)</label>
                                                <div class="col-lg-2">
                                                    <input id="fob_final2_new" name="fob_final_new" type="number" min="0" placeholder="Final F.O.B" class="form-control round-input" />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="remarks_final2_new" class="control-label col-lg-2">Final Remarks</label>
                                                <div class="col-lg-4">
                                                    <input id="remarks_final2_new" name="remarks_final_new" type="text" placeholder="Final remarks" class="form-control round-input" />
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="control-label col-lg-2 text-danger">Status *</label>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="status_new" id="enable7_new" value="1" checked required class="iCheck-square-green">
                                                    <label for="enable7" class="control-label">Enable</label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="status_new" id="disable7_new" value="0" required class="iCheck-square-red">
                                                    <label for="disable7_new" class="control-label">Disable</label>
                                                </div>
                                            </div>

                                            <input type="hidden" id="article_rate_id_new" name="article_rate_id_new" value="">

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-success" type="submit"><i class="fa fa-refresh"></i> Update Article Rate</button>
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
<!--fileinput-->
<script src="<?=base_url();?>assets/admin_panel/js/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script>
    $("#img").fileinput({
        // browseClass : "btn btn-danger",
        maxFileSize : 1000, //1 Mb
        allowedFileExtensions : ['jpg','jpeg','png'],
        showUpload: false,
    });
</script>
<!--form validation-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js"></script>
<!--ajax form submit-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>

<script>
    $(document).ready(function() {
        $('#article_color_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_color_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_id: function () {
                        return $("#article_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "lth_color" },
                { "data": "fit_color" },
                { "data": "img" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );

        $('#article_part_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_part_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_id: function () {
                        return $("#article_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "group_name" },
                { "data": "quantity" },
                { "data": "status" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [3], //disable 'Actions' column sorting
                "orderable": false,
            }]
        } );

        $('#article_rate_table').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_rate_table_data')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_id: function () {
                        return $("#article_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "date" },
                { "data": "cur_id" },
                { "data": "conversion_rate" },
                { "data": "exworks_factory" },
                { "data": "cf_factory" },
                { "data": "fob_factory" },
                { "data": "exworks_final" },
                { "data": "cf_final" },
                { "data": "fob_final" },
                { "data": "remarks_final" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,2,3,4,5,6,7,8,9,10], //disable 'Main Remark','Actions' column sorting
                "orderable": false,
            }]
        } );
        
        
        $('#article_rate_table_new').DataTable( {
            "processing": true,
            "language": {
                processing: '<img src="<?=base_url('assets/img/ellipsis.gif')?>"><span class="sr-only">Processing...</span>',
            },
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url('ajax_article_rate_table_data_new')?>",
                "type": "POST",
                "dataType": "json",
                data: {
                    article_id: function () {
                        return $("#article_id").val();
                    },
                },
            },
            //will get these values from JSON 'data' variable
            "columns": [
                { "data": "date" },
                { "data": "conversion_rate" },
                { "data": "exworks_factory" },
                { "data": "cf_factory" },
                { "data": "fob_factory" },
                { "data": "exworks_final" },
                { "data": "cf_final" },
                { "data": "fob_final" },
                { "data": "remarks_final" },
                { "data": "action" },
            ],
            //column initialisation properties
            "columnDefs": [{
                "targets": [1,2,3,4,5,6,7,8,9], //disable 'Main Remark','Actions' column sorting
                "orderable": false,
            }]
        } );
        
        
    } );

    //edit-article-form validation and submit
    $("#form_edit_article").validate({
        rules: {
            art_no: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_no')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                    },
                },
            },
            alt_art_no: {
                remote: {
                    url: "<?=base_url('ajax_unique_alternate_article_no')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);
        }
    });

    //add-article-color-form validation and submit
    $("#form_add_article_color").validate({
        rules: {
            lth_color_id: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_lth_color')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        fit_color_id: function () {
                            return $("#fit_color_id").val();
                        },
                        article_dtl_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_article_color').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article_color").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            // $('#form_add_article_color')[0].reset(); //reset form
            // $("#form_add_article_color select").select2("val", ""); //reset all select2 fields
            $('#lth_color_id').select2('open');
            $('#form_add_article_color :radio').iCheck('update'); //reset all iCheck fields
            // $("#form_add_article_color").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#article_color_table').DataTable().ajax.reload();
        }
    });

    //edit-article-color-form validation and submit
    $("#form_edit_article_color").validate({
        rules: {
            lth_color_id: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_lth_color')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        fit_color_id: function () {
                            return $("#fit_color_id2").val();
                        },
                        article_dtl_id: function () {
                            return $("#article_dtl_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_color').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_color").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#article_color_table').DataTable().ajax.reload();
        }
    });

    //article-dtl edit button
    $("#article_color_table").on('click', '.article_dtl_edit_btn', function() {
        article_dtl_id = $(this).attr('article_dtl_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_color') ?>",
            method: "post",
            dataType: 'json',
            data: {'article_dtl_id':article_dtl_id,},
            success: function(data){
                $("#article_dtl_id").val(data.ad_id);
                $("#lth_color_id2").select2("val", data.lth_color_id);
                $("#fit_color_id2").select2("val", data.fit_color_id);
                if(data.status == '1'){$("#enable3").iCheck('check');} else if(data.status == '0'){$("#disable3").iCheck('check');}

                $('#color_edit_tab').removeClass('disabled');
                $('#color_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#article_color_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //add-article-part-form validation and submit
    $("#form_add_article_part").validate({
        rules: {
            ig_id: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_part_item_group')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        article_part_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_article_part').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article_part").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_article_part')[0].reset(); //reset form
            $("#form_add_article_part select").select2("val", ""); //reset all select2 fields
            $('#form_add_article_part :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_article_part").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#article_part_table').DataTable().ajax.reload();
        }
    });

    //edit-article-part-form validation and submit
    $("#form_edit_article_part").validate({
        rules: {
            ig_id: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_part_item_group')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        article_part_id: function () {
                            return $("#article_part_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_part').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_part").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#article_part_table').DataTable().ajax.reload();
        }
    });

    //article-part edit button
    $("#article_part_table").on('click', '.article_part_edit_btn', function() {
        article_part_id = $(this).attr('article_part_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_part') ?>",
            method: "post",
            dataType: 'json',
            data: {'article_part_id':article_part_id,},
            success: function(data){
                $("#article_part_id").val(data.ap_id);
                $("#ig_id2").select2("val", data.ig_id);
                $("#quantity2").val(data.quantity);
                if(data.status == '1'){$("#enable5").iCheck('check');} else if(data.status == '0'){$("#disable5").iCheck('check');}

                $('#part_edit_tab').removeClass('disabled');
                $('#part_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#article_part_tabs li:eq(2) a').tab('show');
            },
        });
    });

    //add-article-rate-form validation and submit
    $("#form_add_article_rate").validate({
        rules: {
            date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_rate_date')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        article_rate_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_article_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_article_rate')[0].reset(); //reset form
            $("#form_add_article_rate select").select2("val", ""); //reset all select2 fields
            $('#form_add_article_rate :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_article_rate").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#article_rate_table').DataTable().ajax.reload();
        }
    });
    
    $("#form_add_article_rate_new").validate({
        rules: {
            date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_rate_date_new')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id_new").val();
                        },
                        article_rate_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_article_rate_new').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article_rate_new").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_article_rate_new')[0].reset(); //reset form
            $("#form_add_article_rate_new select").select2("val", ""); //reset all select2 fields
            $('#form_add_article_rate_new :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_article_rate_new").validate().resetForm(); //reset validation
            notification(obj);

            //refresh table
            $('#article_rate_table_new').DataTable().ajax.reload();
        }
    });

    //edit-article-rate-form validation and submit
    $("#form_edit_article_rate").validate({
        rules: {
            date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_rate_date')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id").val();
                        },
                        article_rate_id: function () {
                            return $("#article_rate_id").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_rate').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_rate").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#article_rate_table').DataTable().ajax.reload();
        }
    });
    
    
    $("#form_edit_article_rate_new").validate({
        rules: {
            date: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_rate_date_new')?>",
                    type: "post",
                    data: {
                        article_id: function () {
                            return $("#article_id_new").val();
                        },
                        article_rate_id: function () {
                            return $("#article_rate_id_new").val();
                        },
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_edit_article_rate_new').ajaxForm({
        beforeSubmit: function () {
            return $("#form_edit_article_rate_new").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            notification(obj);

            //refresh table
            $('#article_rate_table_new').DataTable().ajax.reload();
        }
    });
    

    //article-rate edit button
    $("#article_rate_table").on('click', '.article_rate_edit_btn', function() {
        article_rate_id = $(this).attr('article_rate_id');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_rate') ?>",
            method: "post",
            dataType: 'json',
            data: {'article_rate_id':article_rate_id,},
            success: function(data){
                $("#article_rate_id").val(data.ar_id);
                $("#date3").val(data.date);
                $("#remarks_main2").val(data.remarks_main);
                $("#cur_id2").select2("val", data.cur_id);
                $("#currency_rate2").val(data.currency_rate);
                $("#conversion_rate2").val(data.conversion_rate);
                $("#exworks_factory2").val(data.exworks_factory);
                $("#cf_factory2").val(data.cf_factory);
                $("#fob_factory2").val(data.fob_factory);
                $("#exworks_office2").val(data.exworks_office);
                $("#cf_office2").val(data.cf_office);
                $("#fob_office2").val(data.fob_office);
                $("#conversion_rate_final2").val(data.conversion_rate_final);
                $("#exworks_final2").val(data.exworks_final);
                $("#cf_final2").val(data.cf_final);
                $("#fob_final2").val(data.fob_final);
                $("#remarks_final2").val(data.remarks_final);
                if(data.status == '1'){$("#enable7").iCheck('check');} else if(data.status == '0'){$("#disable7").iCheck('check');}

                $('#rate_edit_tab').removeClass('disabled');
                $('#rate_edit_tab').children("a").attr("data-toggle", 'tab');
                $('#article_rate_tabs li:eq(2) a').tab('show');
            },
        });
    });
    
     $("#article_rate_table_new").on('click', '.article_rate_edit_btn_new', function() {
        article_rate_id = $(this).attr('article_rate_id_new');

        $.ajax({
            url: "<?= base_url('ajax_fetch_article_rate_new') ?>",
            method: "post",
            dataType: 'json',
            data: {'article_rate_id':article_rate_id,},
            success: function(data){
                $("#article_rate_id_new").val(data.ar_id);
                $("#date3_new").val(data.date);
                $("#currency_rate2_new").val(data.currency_rate);
                $("#conversion_rate2_new").val(data.conversion_rate);
                $("#exworks_factory2_new").val(data.exworks_factory);
                $("#cf_factory2_new").val(data.cf_factory);
                $("#fob_factory2_new").val(data.fob_factory);
                $("#exworks_office2_new").val(data.exworks_office);
                $("#cf_office2_new").val(data.cf_office);
                $("#fob_office2_new").val(data.fob_office);
                $("#conversion_rate_final2_new").val(data.conversion_rate_final);
                $("#exworks_final2_new").val(data.exworks_final);
                $("#cf_final2_new").val(data.cf_final);
                $("#fob_final2_new").val(data.fob_final);
                $("#remarks_final2_new").val(data.remarks_final);
                if(data.status == '1'){$("#enable7_new").iCheck('check');} else if(data.status == '0'){$("#disable7_new").iCheck('check');}

                $('#rate_edit_tab_new').removeClass('disabled');
                $('#rate_edit_tab_new').children("a").attr("data-toggle", 'tab');
                $('#article_rate_tabs_new li:eq(2) a').tab('show');
            },
        });
    });

    //calculating conversion rate
    $("#conversion_rate").on('change', function() {
        conv_rate = $(this).val();
        exwork = $("#exworks_factory").val();
        cf = $("#cf_factory").val();
        fob = $("#fob_factory").val();

        $("#exworks_office").val( final_rate_number_format(exwork, conv_rate) );
        $("#cf_office").val( final_rate_number_format(cf, conv_rate) );
        $("#fob_office").val( final_rate_number_format(fob, conv_rate) );
    });
    $("#conversion_rate_final").on('change', function() {
        conv_rate = $("#conversion_rate_final").val();
        exwork = $("#exworks_factory").val();
        cf = $("#cf_factory").val();
        fob = $("#fob_factory").val();

        $("#exworks_final").val( final_rate_number_format(exwork, conv_rate) );
        $("#cf_final").val( final_rate_number_format(cf, conv_rate) );
        $("#fob_final").val( final_rate_number_format(fob, conv_rate) );
    });
    $("#conversion_rate_final2").on('change', function() {
        conv_rate = $("#conversion_rate_final2").val();
        exwork = $("#exworks_factory2").val();
        cf = $("#cf_factory2").val();
        fob = $("#fob_factory2").val();

        $("#exworks_final2").val( final_rate_number_format(exwork, conv_rate) );
        $("#cf_final2").val( final_rate_number_format(cf, conv_rate) );
        $("#fob_final2").val( final_rate_number_format(fob, conv_rate) );
    });
    function final_rate_number_format(num, divider) {
        num = num / divider;
        num = parseFloat(num).toFixed(2);
        last_digit = num.toString().slice(-1);

        if(last_digit == 1) { num = parseFloat(num) - 0.01; }
        else if(last_digit == 2) { num = parseFloat(num) - 0.02; }
        else if(last_digit == 3) { num = parseFloat(num) + 0.02; }
        else if(last_digit == 4) { num = parseFloat(num) + 0.01; }
        else if(last_digit == 6) { num = parseFloat(num) - 0.01; }
        else if(last_digit == 7) { num = parseFloat(num) - 0.02; }
        else if(last_digit == 8) { num = parseFloat(num) + 0.02; }
        else if(last_digit == 9) { num = parseFloat(num) + 0.01; }

        num = parseFloat(num).toFixed(2);
        return num;
    }

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
                    $('#article_rate_table_new').DataTable().ajax.reload();
                    $('#article_rate_table').DataTable().ajax.reload();
                    $('#article_color_table').DataTable().ajax.reload();
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
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
</script>

</body>
</html>