<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 12:00
 */

$route['admin/dashboard'] = 'admin_panel/Dashboard/dashboard';
$route['404'] = 'admin_panel/Dashboard/error_404';
$route['js_disabled'] = 'admin_panel/Dashboard/js_disabled';



$route['admin/profile'] = 'admin_panel/Profile/profile';
$route['admin/form_basic_info'] = 'admin_panel/Profile/form_basic_info';
$route['admin/form_change_pass'] = 'admin_panel/Profile/form_change_pass';
$route['admin/form_change_email'] = 'admin_panel/Profile/form_change_email';
$route['admin/change_email/(:any)'] = 'admin_panel/Profile/change_email/$1';
$route['admin/ajax_username_check'] = 'admin_panel/Profile/ajax_username_check';
$route['admin/form_change_username'] = 'admin_panel/Profile/form_change_username';


// MASTER AREA STARS 
$route['admin/units'] = 'admin_panel/Master/units';
$route['admin/sizes'] = 'admin_panel/Master/sizes';
$route['admin/shapes'] = 'admin_panel/Master/shapes';
$route['admin/item_groups'] = 'admin_panel/Master/item_groups';
$route['admin/item_master'] = 'admin_panel/Master/item_master';
$route['admin/add_item'] = 'admin_panel/Master/add_item';
$route['admin/form_add_item'] = 'admin_panel/Master/form_add_item';
$route['admin/edit_item/(:any)'] = 'admin_panel/Master/edit_item/$1';
$route['admin/form_edit_item'] = 'admin_panel/Master/form_edit_item';

$route['admin/form_add_item_buy_code'] = 'admin_panel/Master/form_add_item_buy_code';
$route['admin/form_edit_item_buy_code'] = 'admin_panel/Master/form_edit_item_buy_code';
$route['admin/ajax-unit-on-item-group'] = 'admin_panel/Master/ajax_unit_on_item_group';
$route['ajax_unique_item_buy_code'] = 'admin_panel/Master/ajax_unique_item_buy_code';
$route['admin/ajax_fetch_buy_code_details'] = 'admin_panel/Master/ajax_fetch_buy_code_details';

$route['admin/form_add_item_color'] = 'admin_panel/Master/form_add_item_color';
$route['admin/form_edit_item_color'] = 'admin_panel/Master/form_edit_item_color';
$route['admin/form_add_item_color_rate'] = 'admin_panel/Master/form_add_item_color_rate';
$route['admin/form_edit_item_color_rate'] = 'admin_panel/Master/form_edit_item_color_rate';
$route['ajax_unique_item_code'] = 'admin_panel/Master/ajax_unique_item_code';
$route['ajax_unique_item_name'] = 'admin_panel/Master/ajax_unique_item_name';
$route['ajax_unique_item_color'] = 'admin_panel/Master/ajax_unique_item_color';
$route['ajax_fetch_item_color'] = 'admin_panel/Master/ajax_fetch_item_color';
$route['ajax_unique_supp_item_color_rate_eff_date'] = 'admin_panel/Master/ajax_unique_supp_item_color_rate_eff_date';

$route['ajax_fetch_item_rate'] = 'admin_panel/Master/ajax_fetch_item_rate';
$route['admin/countries'] = 'admin_panel/Master/countries';
$route['admin/stations'] = 'admin_panel/Master/stations';
$route['admin/currencies'] = 'admin_panel/Master/currencies';
$route['admin/colors'] = 'admin_panel/Master/colors';
$route['admin/account_groups'] = 'admin_panel/Master/account_groups';
$route['admin/account_master'] = 'admin_panel/Master/account_master';
$route['admin/charges'] = 'admin_panel/Master/charges';
$route['admin/departments'] = 'admin_panel/Master/departments';
$route['admin/employees'] = 'admin_panel/Master/employees';
$route['admin/article_groups'] = 'admin_panel/Master/article_groups';
$route['admin/article_master'] = 'admin_panel/Master/article_master';
$route['admin/add_article'] = 'admin_panel/Master/add_article';
$route['admin/form_add_article'] = 'admin_panel/Master/form_add_article';
$route['admin/edit_article/(:any)'] = 'admin_panel/Master/edit_article/$1';
$route['admin/form_edit_article'] = 'admin_panel/Master/form_edit_article';
$route['admin/form_add_article_color'] = 'admin_panel/Master/form_add_article_color';
$route['admin/form_edit_article_color'] = 'admin_panel/Master/form_edit_article_color';
$route['admin/form_add_article_part'] = 'admin_panel/Master/form_add_article_part';
$route['admin/form_edit_article_part'] = 'admin_panel/Master/form_edit_article_part';
$route['ajax_unique_article_no'] = 'admin_panel/Master/ajax_unique_article_no';
$route['ajax_unique_alternate_article_no'] = 'admin_panel/Master/ajax_unique_alternate_article_no';
$route['ajax_unique_article_lth_color'] = 'admin_panel/Master/ajax_unique_article_lth_color';
$route['ajax_fetch_article_color'] = 'admin_panel/Master/ajax_fetch_article_color';
$route['ajax_fetch_article_part'] = 'admin_panel/Master/ajax_fetch_article_part';
$route['ajax_unique_article_part_item_group'] = 'admin_panel/Master/ajax_unique_article_part_item_group';
$route['admin/form_add_article_rate'] = 'admin_panel/Master/form_add_article_rate';
$route['admin/form_edit_article_rate'] = 'admin_panel/Master/form_edit_article_rate';
$route['ajax_fetch_article_rate'] = 'admin_panel/Master/ajax_fetch_article_rate';
$route['ajax_unique_article_rate_date'] = 'admin_panel/Master/ajax_unique_article_rate_date';

// Master delete 

// master delete ends 

// common routes 

$route['admin/all-items-on-item-group-id'] = 'admin_panel/Transactions/ajax_all_items_on_item_group_id';
$route['ajax-del-row-on-table-and-pk'] = 'admin_panel/Master/ajax_del_row_on_table_and_pk';

// COMMON ROUTES ENDS 

$route['ajax_item_master_table_data'] = 'admin_panel/Master/ajax_item_master_table_data';
$route['ajax_item_color_table_data'] = 'admin_panel/Master/ajax_item_color_table_data';
$route['ajax_item_color_rate_table_data'] = 'admin_panel/Master/ajax_item_color_rate_table_data';
$route['ajax_item_buy_code_table_data'] = 'admin_panel/Master/ajax_item_buy_code_table_data';
$route['ajax_article_rate_table_data'] = 'admin_panel/Master/ajax_article_rate_table_data';
$route['ajax_article_part_table_data'] = 'admin_panel/Master/ajax_article_part_table_data';
$route['ajax_article_color_table_data'] = 'admin_panel/Master/ajax_article_color_table_data';
$route['ajax_article_master_table_data'] = 'admin_panel/Master/ajax_article_master_table_data';

$route['admin/del-row-on-table-pk-clone'] = 'admin_panel/Transactions/ajax_del_row_on_table_and_pk_clone';
$route['admin/del-row-on-table-pk'] = 'admin_panel/Transactions/ajax_del_row_on_table_and_pk';

$route['admin/article_costing'] = 'admin_panel/Transactions/article_costing';
$route['admin/add_article_costing'] = 'admin_panel/Transactions/add_article_costing';
$route['admin/form_add_article_costing'] = 'admin_panel/Transactions/form_add_article_costing';
$route['admin/edit_article_costing/(:any)'] = 'admin_panel/Transactions/edit_article_costing/$1';
$route['admin/clone_article_costing/(:any)'] = 'admin_panel/Transactions/clone_article_costing/$1';
$route['admin/print_article_costing/(:num)'] = 'admin_panel/Transactions/print_article_costing/$1';

$route['admin/calculate_article_costing'] = 'admin_panel/Transactions/calculate_article_costing';
$route['admin/calculate_article_costing_clone'] = 'admin_panel/Transactions/calculate_article_costing_clone';

$route['admin/form_edit_article_costing'] = 'admin_panel/Transactions/form_edit_article_costing';
$route['admin/form_edit_article_costing_clone'] = 'admin_panel/Transactions/form_edit_article_costing_clone';
$route['admin/form_add_article_measurement'] = 'admin_panel/Transactions/form_add_article_measurement';
$route['admin/form_add_article_measurement_clone'] = 'admin_panel/Transactions/form_add_article_measurement_clone';
$route['admin/form_edit_article_measurement'] = 'admin_panel/Transactions/form_edit_article_measurement';
$route['admin/form_edit_article_measurement_clone'] = 'admin_panel/Transactions/form_edit_article_measurement_clone';
$route['admin/form_add_costing_details'] = 'admin_panel/Transactions/form_add_costing_details';
$route['admin/form_add_costing_details_clone'] = 'admin_panel/Transactions/form_add_costing_details_clone';
$route['admin/form_edit_costing_details'] = 'admin_panel/Transactions/form_edit_costing_details';
$route['admin/form_edit_costing_details_clone'] = 'admin_panel/Transactions/form_edit_costing_details_clone';
$route['admin/form_add_costing_charges'] = 'admin_panel/Transactions/form_add_costing_charges';
$route['admin/form_add_costing_charges_percentage'] = 'admin_panel/Transactions/form_add_costing_charges_percentage';
$route['admin/form_add_costing_charges_clone'] = 'admin_panel/Transactions/form_add_costing_charges_clone';
$route['admin/form_edit_costing_charges'] = 'admin_panel/Transactions/form_edit_costing_charges';
$route['admin/form_edit_costing_charges_clone'] = 'admin_panel/Transactions/form_edit_costing_charges_clone';

$route['ajax_fetch_article_master_image'] = 'admin_panel/Transactions/ajax_fetch_article_master_image';
$route['ajax_unique_article_costing_amId'] = 'admin_panel/Transactions/ajax_unique_article_costing_amId';
$route['ajax_unique_article_costing_item'] = 'admin_panel/Transactions/ajax_unique_article_costing_item';
$route['ajax_unique_article_costing_item_clone'] = 'admin_panel/Transactions/ajax_unique_article_costing_item_clone';
$route['ajax_fetch_article_costing_measurement'] = 'admin_panel/Transactions/ajax_fetch_article_costing_measurement';
$route['ajax_fetch_article_costing_measurement_clone'] = 'admin_panel/Transactions/ajax_fetch_article_costing_measurement_clone';
$route['ajax_fetch_rate_by_item_detail'] = 'admin_panel/Transactions/ajax_fetch_rate_by_item_detail';
$route['ajax_unique_article_costing_details_item'] = 'admin_panel/Transactions/ajax_unique_article_costing_details_item';
$route['ajax_unique_article_costing_details_item_clone'] = 'admin_panel/Transactions/ajax_unique_article_costing_details_item_clone';
$route['ajax_fetch_article_costing_details'] = 'admin_panel/Transactions/ajax_fetch_article_costing_details';
$route['ajax_fetch_article_costing_details_clone'] = 'admin_panel/Transactions/ajax_fetch_article_costing_details_clone';
$route['ajax_unique_article_costing_charge'] = 'admin_panel/Transactions/ajax_unique_article_costing_charge';
$route['ajax_unique_article_costing_charge_clone'] = 'admin_panel/Transactions/ajax_unique_article_costing_charge_clone';
$route['ajax_fetch_article_costing_charges'] = 'admin_panel/Transactions/ajax_fetch_article_costing_charges';
$route['ajax_fetch_article_costing_charges_clone'] = 'admin_panel/Transactions/ajax_fetch_article_costing_charges_clone';

$route['ajax_article_costing_table_data'] = 'admin_panel/Transactions/ajax_article_costing_table_data';
$route['ajax_article_costing_measurement_table_data'] = 'admin_panel/Transactions/ajax_article_costing_measurement_table_data';
$route['ajax_article_costing_measurement_table_data_clone'] = 'admin_panel/Transactions/ajax_article_costing_measurement_table_data_clone';
$route['ajax_article_costing_details_table_data'] = 'admin_panel/Transactions/ajax_article_costing_details_table_data';
$route['ajax_article_costing_details_table_data_clone'] = 'admin_panel/Transactions/ajax_article_costing_details_table_data_clone';
$route['ajax_article_costing_charges_table_data'] = 'admin_panel/Transactions/ajax_article_costing_charges_table_data';
$route['ajax_article_costing_charges_table_data_clone'] = 'admin_panel/Transactions/ajax_article_costing_charges_table_data_clone';

// CUSTOMER ORDER AREA STARTS

$route['admin/customer-order'] = 'admin_panel/Customer_order/customer_order';
$route['admin/add-customer-order'] = 'admin_panel/Customer_order/add_customer_order';
$route['ajax_customer_order_table_data'] = 'admin_panel/Customer_order/ajax_customer_order_table_data';
$route['ajax-fetch-article-colours'] = 'admin_panel/Customer_order/ajax_fetch_article_colours';
$route['ajax_unique_customer_order_number'] = 'admin_panel/Customer_order/ajax_unique_customer_order_number';
$route['admin/form_add_customer_order'] = 'admin_panel/Customer_order/form_add_customer_order';

// edit area 
$route['admin/edit-customer-order/(:num)'] = 'admin_panel/Customer_order/edit_customer_order/$1';
$route['admin/form_edit_customer_order'] = 'admin_panel/Customer_order/form_edit_customer_order';
$route['admin/ajax_unique_customer_order_no'] = 'admin_panel/Customer_order/ajax_unique_customer_order_no';
$route['ajax_customer_order_details_table_data'] = 'admin_panel/Customer_order/ajax_customer_order_details_table_data';
$route['admin/form_add_customer_order_details'] = 'admin_panel/Customer_order/form_add_customer_order_details';
$route['admin/ajax_fetch_customer_order_details_on_pk'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_details_on_pk';
$route['admin/form_edit_customer_order_details'] = 'admin_panel/Customer_order/form_edit_customer_order_details';
$route['admin/ajax_unique_co_no_and_art_no_and_lth_color'] = 'admin_panel/Customer_order/ajax_unique_co_no_and_art_no_and_lth_color';

$route['admin/del-row-on-table-pk-customer-order'] = 'admin_panel/Customer_order/ajax_del_row_on_table_and_pk_customer_order';
$route['admin/print-customer-order-consumption/(:num)'] = 'admin_panel/Customer_order/print_customer_order_consumption/$1';

$route['ajax-fetch-article-rate-on-type'] = 'admin_panel/Customer_order/ajax_fetch_article_rate_on_type';
// CUSTOMER ORDER AREA ENDS 

// PURCHASE ORDER AREA STARTS 

// list
$route['admin/purchase-order'] = 'admin_panel/Purchase_order/purchase_order';
$route['admin/ajax_purchase_order_table_data'] = 'admin_panel/Purchase_order/ajax_purchase_order_table_data';
// add 
$route['admin/add-purchase-order'] = 'admin_panel/Purchase_order/add_purchase_order';
$route['admin/ajax_unique_purchase_order_number'] = 'admin_panel/Purchase_order/ajax_unique_purchase_order_no';
$route['admin/form_add_purchase_order'] = 'admin_panel/Purchase_order/form_add_purchase_order';
$route['admin/form_add_purchase_order_details'] = 'admin_panel/Purchase_order/form_add_purchase_order_details';
// edit 
$route['admin/edit-purchase-order/(:num)'] = 'admin_panel/Purchase_order/edit_purchase_order/$1';
$route['admin/form_edit_purchase_order'] = 'admin_panel/Purchase_order/form_edit_purchase_order';
$route['admin/ajax_purchase_order_details_table_data'] = 'admin_panel/Purchase_order/ajax_purchase_order_details_table_data';
$route['admin/all-items-on-item-group'] = 'admin_panel/Purchase_order/ajax_all_items_on_item_group';
$route['admin/all-colors-on-item-master'] = 'admin_panel/Purchase_order/ajax_all_colors_on_item_master';
$route['admin/form_edit_purchase_order_details'] = 'admin_panel/Purchase_order/form_edit_purchase_order_details';
$route['admin/ajax_fetch_purchase_order_details_on_pk'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_details_on_pk';

// print 
$route['admin/purchase-order-print-with-code/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_with_code/$1';
$route['admin/purchase-order-print-without-code/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_without_code/$1';
// PURCHASE ORDER AREA ENDS