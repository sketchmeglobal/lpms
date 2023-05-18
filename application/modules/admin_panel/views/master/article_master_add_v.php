
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Article | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add article">

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
            <h3 class="m-b-less">Add Article</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Article </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form id="form_add_article" method="post" action="<?=base_url('admin/form_add_article')?>" enctype="multipart/form-data" class="cmxform form-horizontal tasi-form">
                                <div class="form-group ">
                                    <label for="ag_id" class="control-label col-lg-2 text-danger">Article Group *</label>
                                    <div class="col-lg-4">
                                        <select id="ag_id" name="ag_id" required class="select2 form-control round-input">
                                            <option value="">Select group</option>
                                            <?php foreach($article_groups as $val) { ?>
                                                <option value="<?=$val['ag_id']?>"><?=$val['group_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="customer_id" class="control-label col-lg-2">Customer</label>
                                    <div class="col-lg-4">
                                        <select id="customer_id" name="customer_id" class="select2 form-control round-input">
                                            <option value="">Select customer</option>
                                            <?php foreach($customers as $val) { ?>
                                                <option value="<?=$val['am_id']?>"><?=$val['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="art_no" class="control-label col-lg-2 text-danger">Article No *</label>
                                    <div class="col-lg-4">
                                        <input id="art_no" name="art_no" type="text" placeholder="Article Number" required class="form-control round-input" />
                                    </div>

                                    <label for="alt_art_no" class="control-label col-lg-2">Alternate Article No</label>
                                    <div class="col-lg-4">
                                        <input id="alt_art_no" name="alt_art_no" type="text" placeholder="Alternate Article Number" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="info" class="control-label col-lg-2">Description</label>
                                    <div class="col-lg-4">
                                        <input id="info" name="info" type="text" placeholder="Article description" class="form-control round-input" />
                                    </div>

                                    <label for="design" class="control-label col-lg-2">Design</label>
                                    <div class="col-lg-4">
                                        <input id="design" name="design" type="text" placeholder="Design details" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="pack_dtl" class="control-label col-lg-2">Packing Details</label>
                                    <div class="col-lg-4">
                                        <input id="pack_dtl" name="pack_dtl" type="text" placeholder="Packing details" class="form-control round-input" />
                                    </div>

                                    <label for="carton_id" class="control-label col-lg-2">Carton</label>
                                    <div class="col-lg-4">
                                        <select id="carton_id" name="carton_id" class="select2 form-control round-input">
                                            <option value="">Select carton</option>
                                            <?php foreach($cartons as $val) { ?>
                                                <option value="<?=$val['im_id']?>"><?=$val['item']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="info" class="control-label col-lg-2">Gross weight/Carton</label>
                                    <div class="col-lg-4">
                                        <input id="gross_weight_per_carton" name="gross_weight_per_carton" type="text" placeholder="Gross weight/Carton" class="form-control round-input" />
                                    </div>

                                    <label for="design" class="control-label col-lg-2">Number of Article/Carton</label>
                                    <div class="col-lg-4">
                                        <input id="number_of_article_per_carton" name="number_of_article_per_carton" type="text" placeholder="Number of Article/Carton" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="leather_type" class="control-label col-lg-2">Leather Type</label>
                                    <div class="col-lg-4">
                                        <select id="leather_type" name="leather_type" class="select2 form-control round-input">
                                            <option value="">Select leather type</option>
                                            <?php foreach($leather_types as $val) { ?>
                                                <option value="<?=$val?>"><?=$val?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label for="emboss" class="control-label col-lg-2">Emboss</label>
                                    <div class="col-lg-4">
                                        <input id="emboss" name="emboss" type="text" placeholder="Emboss" class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="date" class="control-label col-lg-2">Date</label>
                                    <div class="col-lg-4">
                                        <input id="date" name="date" type="date" value="<?= date('Y-m-d') ?>" class="form-control round-input" />
                                    </div>

                                    <label for="exworks_amt" class="control-label col-lg-2">Ex-Works</label>
                                    <div class="col-lg-4">
                                        <input id="exworks_amt" name="exworks_amt" type="number" placeholder="Ex-Works amount" readonly class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="cf_amt" class="control-label col-lg-2">C & F</label>
                                    <div class="col-lg-4">
                                        <input id="cf_amt" name="cf_amt" type="number" placeholder="C & F amount" readonly class="form-control round-input" />
                                    </div>

                                    <label for="fob_amt" class="control-label col-lg-2">F.O.B</label>
                                    <div class="col-lg-4">
                                        <input id="fob_amt" name="fob_amt" type="number" placeholder="F.O.B amount" readonly class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="leather_type_info" class="control-label col-lg-2">Type of Leather</label>
                                    <div class="col-lg-4">
                                        <input id="leather_type_info" name="leather_type_info" type="text" placeholder="Type of leather" class="form-control round-input" />
                                    </div>

                                    <label for="metal_fitting" class="control-label col-lg-2">Metal Fittings</label>
                                    <div class="col-lg-4">
                                        <input id="metal_fitting" name="metal_fitting" type="text" placeholder="Metal fittings" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="brand" class="control-label col-lg-2">Brand Name</label>
                                    <div class="col-lg-4">
                                        <input id="brand" name="brand" type="text" placeholder="Brand name" class="form-control round-input" />
                                    </div>

                                    <label for="hand_machine" class="control-label col-lg-2">Hand / Machine (%)</label>
                                    <div class="col-lg-4">
                                        <input id="hand_machine" name="hand_machine" type="text" placeholder="Hand / Machine %" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="size" class="control-label col-lg-2">Size (Cms)</label>
                                    <div class="col-lg-4">
                                        <input id="size" name="size" type="text" placeholder="Size in centimeters" class="form-control round-input" />
                                    </div>

                                    <label for="remark" class="control-label col-lg-2">Remark / HSCode</label>
                                    <div class="col-lg-4">
                                        <input id="remark" name="remark" type="text" placeholder="Remark/HSCode" class="form-control round-input" />
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group ">
                                    <label for="cutting_rate_a" class="control-label col-lg-2">Cutting Rate - A</label>
                                    <div class="col-lg-4">
                                        <input id="cutting_rate_a" name="cutting_rate_a" type="number" min="0" placeholder="Cutting rate - A" class="form-control round-input" />
                                    </div>

                                    <label for="cutting_rate_b" class="control-label col-lg-2">Cutting Rate - B</label>
                                    <div class="col-lg-4">
                                        <input id="cutting_rate_b" name="cutting_rate_b" type="number" min="0" placeholder="Cutting rate - B" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="skiving_rate_a" class="control-label col-lg-2">Sample Rate</label>
                                    <div class="col-lg-4">
                                        <input id="skiving_rate_a" name="skiving_rate_a" type="number" min="0" placeholder="Sample Rate" class="form-control round-input" />
                                    </div>

                                    <label for="skiving_rate_b" class="control-label col-lg-2">Skiving Rate</label>
                                    <div class="col-lg-4">
                                        <input id="skiving_rate_b" name="skiving_rate_b" type="number" min="0" placeholder="Skiving rate" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="fabrication_rate_a" class="control-label col-lg-2">Fabrication Rate - A</label>
                                    <div class="col-lg-4">
                                        <input id="fabrication_rate_a" name="fabrication_rate_a" type="number" min="0" placeholder="Fabrication rate - A" class="form-control round-input" />
                                    </div>

                                    <label for="fabrication_rate_b" class="control-label col-lg-2">Fabrication Rate - B</label>
                                    <div class="col-lg-4">
                                        <input id="fabrication_rate_b" name="fabrication_rate_b" type="number" min="0" placeholder="Fabrication rate - B" class="form-control round-input" />
                                    </div>
                                </div>

                                

                                <div class="form-group ">
                                    <label for="wl_rate_a" class="control-label col-lg-2">Weight</label>
                                    <div class="col-lg-4">
                                        <input id="wl_rate_a" name="wl_rate_a" type="number" min="0" placeholder="Weight" class="form-control round-input" />
                                    </div>

                                    <label for="wl_rate_b" class="control-label col-lg-2">Leather Code</label>
                                    <div class="col-lg-4">
                                        <input id="wl_rate_b" name="wl_rate_b" type="number" min="0" placeholder="Leather code" class="form-control round-input" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="credit_score" class="control-label col-lg-2">Credit Score</label>
                                    <div class="col-lg-2">
                                        <input id="credit_score" name="credit_score" type="number" min="0" step="0.01" placeholder="Credit Score" class="form-control round-input" />
                                    </div>
                                    <label for="alter_score" class="control-label col-lg-2">Alter/Rejection Score</label>
                                    <div class="col-lg-2">
                                        <input id="alter_score" name="alter_score" type="number" min="0" step="0.01" placeholder="Alter/Rejection Score" class="form-control round-input" />
                                    </div>
                                    <label for="img" class="control-label col-lg-1">Image</label>
                                    <div class="col-lg-3">
                                        <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png" class="file" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2 text-danger">Status *</label>
                                    <div class="col-lg-4">
                                        <input type="radio" name="status" id="enable" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                    
                                    <div class="col-lg-6 text-center">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"> Add Article</i></button>
                                        <a id="edit_article_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Article</i></a>
                                    </div>
                                </div>
                            </form>
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
    //add-item-form validation and submit
    $("#form_add_article").validate({
        rules: {
            art_no: {
                required: true,
                remote: {
                    url: "<?=base_url('ajax_unique_article_no')?>",
                    type: "post",
                    data: {
                        article_id: '',
                    },
                },
            },
            alt_art_no: {
                remote: {
                    url: "<?=base_url('ajax_unique_alternate_article_no')?>",
                    type: "post",
                    data: {
                        article_id: '',
                    },
                },
            },
        },
        messages: {

        }
    });
    $('#form_add_article').ajaxForm({
        beforeSubmit: function () {
            return $("#form_add_article").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);

            $('#form_add_article')[0].reset(); //reset form
            $("#form_add_article select").select2("val", ""); //reset all select2 fields
            $('#form_add_article :radio').iCheck('update'); //reset all iCheck fields
            $("#form_add_article").validate().resetForm(); //reset validation
            notification(obj);

            $('#edit_article_btn').attr('href', '<?=base_url()?>admin/edit_article/'+obj.insert_id);
            $('#edit_article_btn').removeClass('hidden');
        }
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