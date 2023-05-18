<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 12:00
 * Last modified: 21-Feb-2021 at 11:30 am
 */
?>

<?php
$class_name = $this->router->fetch_class();
$method_name = $this->router->fetch_method();
$user_type = $this->session->userdata['accounts']['usertype'];

//fetch user block permission

$all_block_menu = $this->db->select('m_id')->get_where('user_permission', array('user_id' => $this->session->userdata['accounts']['user_id'], 'block_permission' => 1))->result_array();
$final_array = array();
foreach($all_block_menu as $abm){
    array_push($final_array, $abm['m_id']);
}

// echo '<pre>',print_r($final_array),'</pre>';die;
?>
<style>
    .affix{width:240px;height: 100%;overflow:scroll;}
     .affix::-webkit-scrollbar {
      width: 10px;
    }
    
    /* Track */
     .affix::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
     .affix::-webkit-scrollbar-thumb {
      background: #888; 
    }
    
    /* Handle on hover */
     .affix::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }
</style>
<div class="sidebar-left">
    <!--responsive view logo start-->
    <div class="logo theme-logo-bg visible-xs-* visible-sm-*">
        <a href="<?=base_url('accounts');?>" target="_blank">
            <img src="<?=base_url('accounts');?>assets/img/logo_20px.png" alt="Shilpa Logo">
<!--            <i class="fa fa-home"></i>-->
            <span class="brand-name"><strong><?=WEBSITE_NAME_SHORT;?></strong></span>
        </a>
    </div>
    <!--responsive view logo end-->

    <div class="sidebar-left-info affix">
        <!-- visible small devices start-->
        <div class=" search-field">  </div>
        <!-- visible small devices end-->

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked side-navigation">
            <li><h3 class="navigation-title">Menu</h3></li>
            <li class="<?=(($class_name == 'Dashboard')) ? 'active' : ''; ?>">
                <a href="<?=base_url();?>accounts/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>

            <li class="<?= (($class_name == 'Profile') && ($method_name == 'profile')) ? 'active' : ''; ?>">
                <a href="<?=base_url();?>accounts/profile"><i class="fa fa-vcard-o"></i> <span>Profile</span></a>
            </li>

            <li class="menu-list <?=($class_name == 'Master') ? 'active' : ''; ?>"><a href=""><i class="fa fa-wrench"></i> <span>Master Tables</span></a>
                <ul class="child-list">
                        
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'departments')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/departments"><i class="fa fa-caret-right"></i> Departments</a>
                        </li>

                        <li class="<?=(($class_name == 'Master') && ($method_name == 'employees')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/employees"><i class="fa fa-caret-right"></i> Employees</a>
                        </li>
                        
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'employees')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/holiday-list"><i class="fa fa-caret-right"></i> Holiday List</a>
                        </li>
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Payroll') ? 'active' : ''; ?>"><a href=""><i class="fa fa-retweet"></i> <span>Payroll</span></a>
                <ul class="child-list">
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/payroll-advance-list"><i class="fa fa-caret-right"></i> Advance </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/payroll-emp-salary-list"><i class="fa fa-caret-right"></i> Employee Salary </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/payroll-emp-pay-slip"><i class="fa fa-caret-right"></i> Multiple Pay Slip Print </a>
                        </li>
                    <?php } ?>
                    <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>accounts/overtime"><i class="fa fa-caret-right"></i> Overtime</a>
                        </li>
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Report_item') ? 'active' : ''; ?>"><a href=""><i class="fa fa-houzz"></i> <span>Report</span></a>
                <ul class="child-list">

                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>accounts/payroll-reports"><i class="fa fa-caret-right"></i>Payroll Reports </a>
                    </li>
                    
                </ul>
            </li>
            
        </ul>
        <!--sidebar nav end-->

        <!--sidebar widget start-->
        <div class="sidebar-widget">
            <h4>Account Information</h4>
            <ul class="list-group">
                <li>
                    <p>
                        <strong><i class="fa fa-user-circle-o"></i> <span class="username"><?=$this->session->userdata['accounts']['username'];?></span></strong>
                        <br/>
                        <strong><i class="fa fa-envelope"></i> <?=$this->session->userdata['accounts']['email'];?></strong>
                    </p>
                </li>
                <li>
                    <a href="<?=base_url();?>accounts/profile" class="btn btn-info btn-sm addon-btn">Edit Info. <i class="fa fa-vcard pull-left"></i></a>
                </li>
            </ul>
        </div>
        <!--sidebar widget end-->

    </div>
</div>