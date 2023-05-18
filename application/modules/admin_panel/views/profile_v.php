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
    <title>Profile | <?=WEBSITE_NAME;?></title>
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

        <!-- profile head start-->
        <div class="profile-hero">
            <div class="profile-intro">
                <?php
                $profile_img = isset($user_details[0]['img']) ? $user_details[0]['img'] : 'default.png';
                ?>
                <img class="profile_img" src="<?=base_url();?>assets/admin_panel/img/profile_img/<?=$profile_img;?>" />
                <div class="clearfix"></div>
                <h1>
                    <strong class="fullname"><?=$user_details[0]['firstname'].' '.$user_details[0]['lastname'];?></strong>
                </h1>
            </div>

            <div class="profile-value-info">
                <div class="info">
                    <span><?=date("d M'y", strtotime($user[0]['registration_date']));?></span>
                    Registered Since
                </div>
            </div>
        </div>
        <!-- profile head end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">
                Profile
            </h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Profile </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Basic Profile Information section-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Basic Profile Information
                            <span class="tools pull-right">
                            <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal tasi-form" id="basic_info_form" method="post"
                                      action="<?= base_url(); ?>admin/form_basic_info">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">Firstname *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-user-o"></i>
                                            <input value="<?= $user_details[0]['firstname']; ?>"
                                                   class="form-control round-input" id="firstname" name="firstname"
                                                   type="text" placeholder="Type your firstname"/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-2">Lastname *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-user-o"></i>
                                            <input value="<?= $user_details[0]['lastname']; ?>"
                                                   class="form-control round-input" id="lastname" name="lastname"
                                                   type="text" placeholder="Type your lastname"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label col-lg-2">Contact No.</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-phone"></i>
                                            <input value="<?= $user_details[0]['contact']; ?>"
                                                   class="form-control round-input" id="phone" name="phone"
                                                   type="tel" minlength="10" maxlength="20"
                                                   placeholder="Type your contact number"/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="file" class="control-label col-lg-2">Profile Image</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-file-image-o"></i>
                                            <input class="form-control round-input" id="file" name="file"
                                                   type="file" accept="image/jpeg,image/png,image/gif,image/bmp"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit" name="submit"
                                                    value="submit_basic_info">Update <i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!--Change Password section-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Change Password
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <form id="change_pass_form" method="post" action="<?=base_url();?>admin/form_change_pass">
                                <div>
                                    <h3>Step 1</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <label for="current_pass" class="col-lg-2 control-label">Current Password *</label>
                                            <div class="col-lg-10 iconic-input">
                                                <i class="fa fa-unlock-alt"></i>
                                                <input id="current_pass" name="current_pass" type="password" placeholder="Enter your current password" class="form-control round-input">
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Step 2</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <label for="new_pass" class="col-lg-2 control-label">New Password *</label>
                                            <div class="col-lg-10 iconic-input">
                                                <i class="fa fa-key"></i>
                                                <input id="new_pass" name="new_pass" type="password" placeholder="Enter new password" class="form-control round-input">
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label for="confirm_pass" class="col-lg-2 control-label">Confirm Password *</label>
                                            <div class="col-lg-10 iconic-input">
                                                <i class="fa fa-key"></i>
                                                <input id="confirm_pass" name="confirm_pass" type="password" placeholder="Enter new password again" class="form-control round-input">
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <input type="hidden" name="submit" value="submit_change_pass">
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <!--Change Email Address section-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Change Email Address
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal tasi-form" id="change_email_form" method="post" action="<?=base_url();?>admin/form_change_email">
                                    <div class="form-group ">
                                        <label for="new_email" class="control-label col-lg-2">Email *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-envelope-o"></i>
                                            <input class="form-control round-input" id="new_email" name="new_email" type="email" placeholder="Type new email address" />
                                            <p class="help-block">e.g. : pro@me.in</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit" name="submit" value="submit_change_email">Update <i class="fa fa-refresh"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!--Change Username section-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Change Username
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal tasi-form" id="change_username_form" method="post" action="<?=base_url();?>admin/form_change_username">
                                    <div class="form-group ">
                                        <label for="new_username" class="control-label col-lg-2">Username *</label>
                                        <div class="col-lg-10 iconic-input">
                                            <i class="fa fa-user-circle"></i>
                                            <input value="<?=$user[0]['username'];?>" class="form-control round-input" id="new_username" name="new_username" type="text" placeholder="Type new username" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit" name="submit" value="submit_change_username">Update <i class="fa fa-refresh"></i></button>
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