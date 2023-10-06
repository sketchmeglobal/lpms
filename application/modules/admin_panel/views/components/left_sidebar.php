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
$user_type = $this->session->usertype;

//fetch user block permission

$all_block_menu = $this->db->select('m_id')->get_where('user_permission', array('user_id' => $this->session->user_id, 'block_permission' => 1))->result_array();
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
    
    body, .theme-logo-bg {
    background: #4fb5bf!important;
}

.logo.theme-logo-bg a {
    color: black;
    font-weight: bold;
}

.side-navigation .menu-list.active ul {
    background: #4fb5bf!important;
}

.sidebar-widget h4, .sidebar-widget p {
    color: black;
}

.sidebar-left .nav > li > a:hover, .sidebar-left .nav > li > a:focus, .side-navigation > li.active > a, .side-navigation > li.active > a:hover, .side-navigation > li.active > a:focus, .side-navigation > li.menu-list > a:hover, .side-navigation > li.nav-active > a, .side-navigation .child-list, .sidebar-collapsed .side-navigation > li.nav-hover > a, .sidebar-collapsed .side-navigation > li.nav-hover.active > a, .sidebar-collapsed .side-navigation li.nav-hover.active a span, .sidebar-collapsed .side-navigation li a span, .sidebar-collapsed .side-navigation li.nav-hover ul, .nav > li > a:hover, .nav > li > a:focus
{
   background: #4fb5bf!important; 
}

.nav-stacked > li + li {
    background: #4fb5bf!important;
}

.side-navigation .child-list > li.active > a {
    color: white;
    font-weight: bold;
}

.side-navigation > li.active > a, .side-navigation > li.active > a:hover, .side-navigation > li.active > a:focus, .side-navigation .child-list > li > a:hover, .side-navigation .child-list > li > a:active, .side-navigation .child-list > li > a:focus, .weather-widget .weather-info .degree, .weather-widget .weather-info .degree:after, .side-navigation > li.nav-active > a, .side-navigation > li > a:hover, .side-navigation > li > a:active, .side-navigation > li.nav-active > a:after, .sidebar-collapsed .side-navigation > li.nav-hover > a, .sidebar-collapsed .side-navigation > li.nav-hover.active > a, .sidebar-collapsed .side-navigation li.nav-hover.active a span, .sidebar-collapsed .side-navigation li a span, .sidebar-collapsed .side-navigation li.nav-hover a span
{
    color: black;
    font-weight: bold;
}

.side-navigation li a, .side-navigation .child-list > li > a {
    color: black;
    font-weight: bold;
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
        <a href="<?=base_url();?>" target="_blank">
            <img src="<?=base_url();?>assets/img/logo_20px.png" alt="Shilpa Logo">
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
                <a href="<?=base_url();?>admin/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>

            <li class="<?= (($class_name == 'Profile') && ($method_name == 'profile')) ? 'active' : ''; ?>">
                <a href="<?=base_url();?>admin/profile"><i class="fa fa-vcard-o"></i> <span>Profile</span></a>
            </li>

            <li class="menu-list <?=($class_name == 'Master') ? 'active' : ''; ?>"><a href=""><i class="fa fa-wrench"></i> <span>Master Tables</span></a>
                <ul class="child-list">
                    <?php if(!in_array(23, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'item_groups')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/item_groups"><i class="fa fa-caret-right"></i> Item Groups</a>
                        </li>
                    <?php } ?>        
                    <?php if(!in_array(24, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'item_master')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/item_master"><i class="fa fa-caret-right"></i> Item Master</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(25, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'item_mapper')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/item_mapper"><i class="fa fa-caret-right"></i> Item Mapper</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(26, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'article_groups')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/article_groups"><i class="fa fa-caret-right"></i> Article Groups</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(27, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'article_master')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/article_master"><i class="fa fa-caret-right"></i> Article Master</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(28, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'account_groups')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/account_groups"><i class="fa fa-caret-right"></i> Account Groups</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(29, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'account_master')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/account_master"><i class="fa fa-caret-right"></i> Account Master</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(29, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'transport_master')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/transport_master"><i class="fa fa-caret-right"></i>  Transport Master  </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(30, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'units')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/units"><i class="fa fa-caret-right"></i> Units</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(31, $final_array)){ ?>    
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'sizes')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/sizes"><i class="fa fa-caret-right"></i> Sizes</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(32, $final_array)){ ?>    
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'shapes')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/shapes"><i class="fa fa-caret-right"></i> Shapes</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(33, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'colors')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/colors"><i class="fa fa-caret-right"></i> Colors</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(34, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'countries')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/countries"><i class="fa fa-caret-right"></i> Countries</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(35, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'stations')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/stations"><i class="fa fa-caret-right"></i> Stations</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(36, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'currencies')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/currencies"><i class="fa fa-caret-right"></i> Currencies</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(37, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'charges')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/charges"><i class="fa fa-caret-right"></i> Charges</a>
                        </li>  
                    <?php } ?>  
                    <?php if(!in_array(38, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'courier')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/courier-master"><i class="fa fa-caret-right"></i> Courier Master</a>
                        </li>  
                    <?php } ?>    
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'departments')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/departments"><i class="fa fa-caret-right"></i> Departments</a>
                        </li>
                        
                        <li class="<?=(($class_name == 'Master') && ($method_name == 'employees')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/holiday-list"><i class="fa fa-caret-right"></i> Holiday List</a>
                        </li>
                </ul>
            </li>

            <li class="menu-list <?=($class_name == 'Transactions') ? 'active' : ''; ?>"><a href=""><i class="fa fa-dollar"></i> <span>Article Costing</span></a>
                <ul class="child-list">
                    <?php if(!in_array(2, $final_array)){ 
                        ?>
                    <li class="<?=(($class_name == 'Transactions') && ($method_name == 'article_costing')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/article_costing"><i class="fa fa-caret-right"></i> Article Costing</a>
                    </li>
                    <li class="<?=(($class_name == 'Transactions') && ($method_name == 'print_multiple_article_costing')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/print_multiple_article_costing"><i class="fa fa-caret-right"></i> Print Multiple Article Costing</a>
                    </li>
                    <?php 
                    }
                    if(!in_array(1, $final_array)){ 
                        ?>
                    <li class="<?=(($class_name == 'Transactions') && ($method_name == 'pending_clone_costing')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/pending_clone_costing"><i class="fa fa-caret-right"></i> Pending Clones</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="menu-list <?=($class_name == 'Customer_order') ? 'active' : ''; ?>"><a href=""><i class="fa fa-exchange"></i> <span>Production</span></a>
                <ul class="child-list">
                    <?php if(!in_array(3, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Customer_order') && ($method_name == 'customer_order')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/customer-order"><i class="fa fa-caret-right"></i> Customer Order</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(4, $final_array)){ ?>
    					<li class="<?=(($class_name == 'Cutting_issue_challan') && ($method_name == 'cutting_issue_challan')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/cutting-issue-challan"><i class="fa fa-caret-right"></i> Cutting Issue </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(2, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Cutting_receive') && ($method_name == 'receive')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/cutting-receive"><i class="fa fa-caret-right"></i> Cutting Receive</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(2, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Cutting_receive') && ($method_name == 'receive')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/cutting-receive-print-multiple"><i class="fa fa-caret-right"></i> Cutting Rcpt. Print</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(7, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Skiving_issue') && ($method_name == 'skiving_issue')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/skiving-issue"><i class="fa fa-caret-right"></i> Skiving Issue</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(8, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Skiving_receive') && ($method_name == 'skiving_receive')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/skiving-receive"><i class="fa fa-caret-right"></i> Skiving Receive</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(9, $final_array)){ ?>    
                        <li class="<?=(($class_name == 'Jobber_challan_issue') && ($method_name == 'jobber_challan_issue')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/jobber-challan-issue"><i class="fa fa-caret-right"></i> Jobber Issue</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(10, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Jobber_challan_receipt') && ($method_name == 'jobber_challan_receipt')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/jobber-challan-receipt"><i class="fa fa-caret-right"></i> Jobber Receive</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(9, $final_array)){ ?>    
                        <li class="<?=(($class_name == 'sample-challan-issue') && ($method_name == 'sample-challan-issue')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/sample-challan-issue"><i class="fa fa-caret-right"></i>Sample Issue</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(9, $final_array)){ ?>    
                        <li class="<?=(($class_name == 'sample-challan-receive') && ($method_name == 'sample-challan-receive')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/sample-challan-receive"><i class="fa fa-caret-right"></i>Sample Receive</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(13, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Checking') && ($method_name == 'checking')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/checking"><i class="fa fa-caret-right"></i> Checking </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(6, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Cutting_receive') && ($method_name == 'cutter_bill')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/cutter-bill"><i class="fa fa-caret-right"></i> Cutter Bill</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(7, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Skiving_issue') && ($method_name == 'skiving_bill')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/skiving-bill"><i class="fa fa-caret-right"></i> Skiving Bill</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(11, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Jobber_bill') && ($method_name == 'jobber_bill')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/jobber-bill"><i class="fa fa-caret-right"></i> Jobber Bill</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(11, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Sample_bill') && ($method_name == 'Sample_bill')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/sample-bill"><i class="fa fa-caret-right"></i> Sample Bill</a>
                        </li>
                    <?php } ?>    
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Office_proforma') ? 'active' : ''; ?>"><a href=""><i class="fa fa-file"></i> <span>Invoice/Packing List</span></a>
                <ul class="child-list">
                    <?php if(!in_array(14, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Office_proforma') && ($method_name == 'office_proforma')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/office-proforma"><i class="fa fa-caret-right"></i> Office Proforma </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(14, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Office_proforma') && ($method_name == 'office_proforma')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/invoice-declaration"><i class="fa fa-caret-right"></i> Invoice Declaration </a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(15, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Packing_shipment_list') && ($method_name == 'packing_shipment_list')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/packing-shipment-list"><i class="fa fa-caret-right"></i> Packing List/Shipment List </a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(12, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Office_invoice_list') && ($method_name == 'office_invoice_list')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/office-invoice-list"><i class="fa fa-caret-right"></i> Office Invoice </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="menu-list <?=($class_name == 'Purchase_order') ? 'active' : ''; ?>"><a href=""><i class="fa fa-database"></i> <span>Inventory</span></a>
                <ul class="child-list">
                    <?php if(!in_array(16, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Purchase_order') && ($method_name == 'purchase_order')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/purchase-order"><i class="fa fa-caret-right"></i> Purchase Order</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(17, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Supp_purchase_order') && ($method_name == 'supp_purchase_order' || $method_name == 'add_supp_purchase_order')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/supp-purchase-order"><i class="fa fa-caret-right"></i> Supp. Purchase Order</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(18, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Receive_purchase_order') && ($method_name == 'receive_purchase_order')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/receive-purchase-order"><i class="fa fa-caret-right"></i> Purchase Receive</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(19, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Stock_in') && ($method_name == 'stock_in')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/stock-in"><i class="fa fa-caret-right"></i> Stock In</a>
                        </li>
                    <?php } ?>    
                    <?php if(!in_array(20, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Material_issue') && ($method_name == 'material_issue_list')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/material-issue-list"><i class="fa fa-caret-right"></i> Material Issue</a>
                        </li>
                    <?php } ?>    
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Courier_shipment') ? 'active' : ''; ?>"><a href=""><i class="fa fa-ship"></i> <span>Courier</span></a>
                <ul class="child-list">
                    <?php if(!in_array(21, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Courier_shipment') && ($method_name == 'courier_shipment_list')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/courier-shipment"><i class="fa fa-caret-right"></i> Courier Shipment </a>
                        </li>
                    <?php } ?>    
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Platting_issue') ? 'active' : ''; ?>"><a href=""><i class="fa fa-retweet"></i> <span>Plating</span></a>
                <ul class="child-list">
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Platting_issue') && ($method_name == 'platting_issue_list')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/platting-issue-list"><i class="fa fa-caret-right"></i> Plating Issue </a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </li>
            <li class="menu-list <?=($class_name == 'Payroll') ? 'active' : ''; ?>"><a href=""><i class="fa fa-retweet"></i> <span>Payroll</span></a>
                <ul class="child-list">
                    <?php if(!in_array(22, $final_array)){ ?>
                     <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/employees"><i class="fa fa-caret-right"></i> Employees</a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/payroll-advance-list"><i class="fa fa-caret-right"></i> Advance </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/payroll-emp-salary-list"><i class="fa fa-caret-right"></i> Employee Salary </a>
                        </li>
                    <?php } ?>
                    <?php if(!in_array(22, $final_array)){ ?>
                        <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/payroll-emp-pay-slip"><i class="fa fa-caret-right"></i> Multiple Pay Slip Print </a>
                        </li>
                    <?php } ?>
                    <li class="<?=(($class_name == 'Payroll') && ($method_name == 'Payroll')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/overtime"><i class="fa fa-caret-right"></i> Overtime</a>
                        </li>
                </ul>
            </li>
            
            <li class="menu-list <?=($class_name == 'Report_item') ? 'active' : ''; ?>"><a href=""><i class="fa fa-houzz"></i> <span>Report</span></a>
                <ul class="child-list">
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-item"><i class="fa fa-caret-right"></i> Item Information </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-order-status"><i class="fa fa-caret-right"></i> Order Status </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/purchase-order-audit-report"><i class="fa fa-caret-right"></i> Customer Order Wise Item Purchase Details </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-shipment-buyerwise-status"><i class="fa fa-caret-right"></i>  Shipment Report  </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-material-status-details"><i class="fa fa-caret-right"></i> Material Issue Status </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-shipment-status"><i class="fa fa-caret-right"></i> Shipment Status Details </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-article-costing-details"><i class="fa fa-caret-right"></i>  Article Costing  </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-leather-status"><i class="fa fa-caret-right"></i> Leather Status </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/report-item-status"><i class="fa fa-caret-right"></i> Item Status </a>
                    </li> 
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/jobber-ledger"><i class="fa fa-caret-right"></i> Jobber Ledger </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/checking-summary-status"><i class="fa fa-caret-right"></i> Checking Summary </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/article-master-report"><i class="fa fa-caret-right"></i> Article Rate Report</a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/checking-entry-sheet"><i class="fa fa-caret-right"></i> Checking Entry Sheet </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/stock-summary-details"><i class="fa fa-caret-right"></i> Stock Summary </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/stock-detail-ledger"><i class="fa fa-caret-right"></i> Stock Detail Ledger </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/supplier-wise-item-position"><i class="fa fa-caret-right"></i> Supplier Wise Item Position </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/supplier-purchase-ledger"><i class="fa fa-caret-right"></i> Supplier Purchase Ledger </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/supplier-wise-purchase-position"><i class="fa fa-caret-right"></i>Supplier Wise Purchase Position </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/group-stock-summary"><i class="fa fa-caret-right"></i>Group Stock Summary </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/jobber-bill-summary"><i class="fa fa-caret-right"></i>Jobber Bill Summary </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/cutter-bill-summary"><i class="fa fa-caret-right"></i>Cutter Bill Summary </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/monthly-production-status"><i class="fa fa-caret-right"></i>Buyer Wise Shipment Report </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/production-register"><i class="fa fa-caret-right"></i>Production Register </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/outstanding-report"><i class="fa fa-caret-right"></i>Outstanding Report </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/payroll-reports"><i class="fa fa-caret-right"></i>Payroll Reports </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/checking-overtime-reports"><i class="fa fa-caret-right"></i>Checking Details Reports </a>
                    </li>
                    <li class="<?=(($class_name == 'Report_item') && ($method_name == 'report_item')) ? 'active' : ''; ?>">
                        <a href="<?=base_url();?>admin/invoice-hsn-summary"><i class="fa fa-caret-right"></i>HSN Summary (Invoice) </a>
                    </li>
                </ul>
            </li>
            
            <!-- ONLY ADMIN RIGHTS -->
            <?php if($user_type == 1){
                ?>

                <li class="menu-list <?=($class_name == 'Settings') ? 'active' : ''; ?>"><a href=""><i class="fa fa-cog"></i> <span>Settings</span></a>
                    <ul class="child-list">
                        <!--<li class="<=(($class_name == 'Settings') && ($method_name == 'departments_permission')) ? 'active' : ''; ?>">-->
                        <!--    <a href="<=base_url();?>admin/user-logs"><i class="fa fa-caret-right"></i>  User Logs</a>-->
                        <!--</li>-->
                        <!--<li class="<=(($class_name == 'Settings') && ($method_name == 'departments_permission')) ? 'active' : ''; ?>">-->
                        <!--    <a href="<=base_url();?>admin/google-chart"><i class="fa fa-caret-right"></i> Google Chart</a>-->
                        <!--</li>-->
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'menu_permission')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/menu-permission"><i class="fa fa-caret-right"></i> Menu</a>
                        </li>  
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'user_management')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/user-management"><i class="fa fa-caret-right"></i> User Management</a>
                        </li>  
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'user_permission')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/user-permission"><i class="fa fa-caret-right"></i> User Permission</a>
                        </li>  
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'departments_permission')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/department-permission"><i class="fa fa-caret-right"></i> Dept. Wise List Filter</a>
                        </li>
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'departments_permission')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/database_backup"><i class="fa fa-caret-right"></i> Database Backup</a>
                        </li>
                        
                        
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'departments_permission')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/excel_import_leather_quantity"><i class="fa fa-caret-right"></i>Import Excel For Opening Stock</a>
                        </li>
                        
                        
                        
                        <li class="<?=(($class_name == 'Settings') && ($method_name == 'change_entry_user')) ? 'active' : ''; ?>">
                            <a href="<?=base_url();?>admin/change-entry-user"><i class="fa fa-caret-right"></i>Change User</a>
                        </li>
                        
                        
                        
                        
                        
                    </ul>
                </li>


                <?php
            } ?>
        </ul>
        <!--sidebar nav end-->

        <!--sidebar widget start-->
        <div class="sidebar-widget">
            <h4>Account Information</h4>
            <ul class="list-group">
                <li>
                    <p>
                        <strong><i class="fa fa-user-circle-o"></i> <span class="username"><?=$this->session->username;?></span></strong>
                        <br/>
                        <strong><i class="fa fa-envelope"></i> <?=$this->session->email;?></strong>
                    </p>
                </li>
                <li>
                    <a href="<?=base_url();?>admin/profile" class="btn btn-info btn-sm addon-btn">Edit Info. <i class="fa fa-vcard pull-left"></i></a>
                </li>
            </ul>
        </div>
        <!--sidebar widget end-->

    </div>
</div>