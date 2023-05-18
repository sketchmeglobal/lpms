<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Last updated: 01-04-2021 at 05:48 pm
 * Time: 12:00
 */
?>

<div class="header-section light-color" style="background-color: #1c352b">

    <!--logo and logo icon start-->
    <div class="logo theme-logo-bg hidden-xs hidden-sm">
        <a href="<?=base_url();?>" target="_blank">
            <img src="<?=base_url();?>assets/img/logo_20px.png" alt="Shilpa Logo">
<!--            <i class="fa fa-home"></i>-->
            <span class="brand-name"><strong><?=WEBSITE_NAME_SHORT;?></strong></span>
        </a>
    </div>

    <div class="icon-logo theme-logo-bg hidden-xs hidden-sm">
        <a href="<?=base_url();?>" target="_blank">
            <img src="<?=base_url();?>assets/img/logo_20px.png" alt="Shilpa Logo">
<!--            <i class="fa fa-home"></i>-->
        </a>
    </div>
    <!--logo and logo icon end-->

    <!--toggle button start-->
    <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
    <!--toggle button end-->

    <div class="notification-wrap">
        <!--right notification start-->
        
        <div class="right-notification">
            <ul class="notification-menu">
                <li class="badge badge-success tobottom" style="top: 30px">Go to bottom</li>
                <li>
                    <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php
                        $user_row = $this->db->get_where('user_details', array('user_id' => $this->session->userdata['accnt']['user_id']))->row();
                        $user_row_detail = $this->db->get_where('users', array('user_id' => $this->session->userdata['accnt']['user_id']))->row();
                        $profile_img = isset($user_row->img) ? $user_row->img : 'default.png';
                        ?>
                        <img class="profile_img" src="<?=base_url();?>assets/admin_panel/img/profile_img/<?=$profile_img;?>" />
                        <span class="username"><?= $user_row_detail->username ?></span>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                            <li><a href="<?= base_url(); ?>salary_portal/profile"><i class="fa fa-vcard-o pull-right"></i>Profile</a></li>
                        <li><a href="<?=base_url();?>salary_portal_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--right notification end-->
    </div>

</div>