<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 14:00
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Department | <?=WEBSITE_NAME;?></title>
    <meta name="keyword" content="profile">
    <meta name="description" content="update profile">

    <!--Form Wizard-->
    <link href="<?=base_url();?>assets/admin_panel/css/jquery.steps.css" rel="stylesheet" type="text/css" />

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!--bootstrap picker-->
    <link href="<?=base_url();?>assets/admin_panel/js/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); //left side menu ?>
    <!-- /common head -->
</head>

<body class="sticky-header">

<noscript>
    <meta http-equiv="refresh" content="0; URL=<?=base_url();?>js_disabled">
</noscript>

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
            <h3 class="m-b-less">
                Add Department
            </h3>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Basic Profile Information section-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Department Information
                            <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal tasi-form" id="" method="post">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">Username *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-user-o"></i>
                                            <input value="<?= $user_department_details->username; ?>"
                                                   class="form-control round-input" id="uname" name="uname"
                                                   type="text" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="department_add" class="control-label col-lg-2">Department *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-user-o"></i>
                                            <select id="department_add" name="department_add" class="form-control select2">
                                                        <option value="">Select Department</option>
                                            <?php foreach($department_details as $c_d) { ?>
                                            <option value="<?= $c_d->d_id ?>" <?php if($user_department_details->user_dept == $c_d->d_id){?> selected <?php } ?>><?= $c_d->department ?></option>
                                            <?php } ?>
                                                     </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <label for="" class="control-label">&nbsp;</label><br>
                                                    <button class="btn btn-success" style="margin: auto; display:block;" type="submit"><i class="fa fa-plus"></i> Add details</button>
                                                </div>
                                            </div>
                                    
                                </form>
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
<script src="<?=base_url();?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/jquery-migrate.js"></script>

<!--form validation-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js" type="text/javascript"></script>
<!--form validation init-->
<script src="<?=base_url();?>assets/admin_panel/js/form-validation-init.js"></script>

<!--Form Wizard-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.steps.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js" type="text/javascript"></script>
<!--wizard initialization-->
<script src="<?=base_url();?>assets/admin_panel/js/wizard-init.js" type="text/javascript"></script>

<!--ajax form submit-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>
<!--ajax form submit init-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form-init.js"></script>

<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>
<!-- /common js -->

</body>
</html>