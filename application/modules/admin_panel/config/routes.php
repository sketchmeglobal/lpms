<?php

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

$route['admin/ajax-fetch-customer-details-brkup-report/(:num)'] = 'admin_panel/Dashboard/ajax_fetch_customer_details_brkup_report/$1';


// MASTER AREA STARS 
$route['admin/units'] = 'admin_panel/Master/units';
$route['admin/sizes'] = 'admin_panel/Master/sizes';
$route['admin/shapes'] = 'admin_panel/Master/shapes';
$route['admin/item_groups'] = 'admin_panel/Master/item_groups';
$route['admin/item_master'] = 'admin_panel/Master/item_master';

$route['admin/item_mapper'] = 'admin_panel/Master/item_mapper';
$route['admin/item_mapper/(:any)'] = 'admin_panel/Master/item_mapper';
$route['admin/item_mapper/(:any)/(:any)'] = 'admin_panel/Master/item_mapper';

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
$route['admin/transport_master'] = 'admin_panel/Master/transport_master';
$route['admin/account-declaration/(:num)'] = 'admin_panel/Master/account_declaration/$1';
$route['admin/charges'] = 'admin_panel/Master/charges';
$route['admin/departments'] = 'admin_panel/Master/departments';

$route['admin/department-permission'] = 'admin_panel/Settings/departments_permission';
$route['admin/department-permission/(:any)'] = 'admin_panel/Settings/departments_permission';
$route['admin/department-permission/(:any)/(:any)'] = 'admin_panel/Settings/departments_permission';

$route['admin/database_backup'] = 'admin_panel/Settings/database_backup_m';
$route['admin/google-chart'] = 'admin_panel/Settings/google_chart_m';
$route['admin/google-chart-full-details-data'] = 'admin_panel/Settings/google_chart_daywise_data_m';
$route['admin/google-chart-monthwise-data'] = 'admin_panel/Settings/google_chart_monthwise_data_m';
$route['admin/google-chart-yearwise-data'] = 'admin_panel/Settings/google_chart_yearwise_data_m';

$route['admin/menu-permission'] = 'admin_panel/Settings/menu_permission';
$route['admin/menu-permission/(:any)'] = 'admin_panel/Settings/menu_permission';
$route['admin/menu-permission/(:any)/(:any)'] = 'admin_panel/Settings/menu_permission';

$route['admin/user-management'] = 'admin_panel/Settings/user_management';
$route['admin/user-management/(:any)'] = 'admin_panel/Settings/user_management';
$route['admin/user-management/(:any)/(:any)'] = 'admin_panel/Settings/user_management';

$route['admin/user-add-department'] = 'admin_panel/Settings/user_add_department';
$route['admin/user-add-department/(:any)'] = 'admin_panel/Settings/user_add_department';
$route['admin/user-add-department/(:any)/(:any)'] = 'admin_panel/Settings/user_add_department';

$route['admin/user-permission'] = 'admin_panel/Settings/user_permission';
$route['admin/user-permission/(:any)'] = 'admin_panel/Settings/user_permission';
$route['admin/user-permission/(:any)/(:any)'] = 'admin_panel/Settings/user_permission';

$route['admin/user-logs'] = 'admin_panel/Settings/user_logs_m';
$route['admin/ajax-user-logs-details'] = 'admin_panel/Settings/ajax_user_logs_details_m';

$route['admin/employees'] = 'admin_panel/Master/employees';
$route['admin/holiday-list'] = 'admin_panel/Master/holiday_list_m';
$route['admin/article_groups'] = 'admin_panel/Master/article_groups';
$route['admin/overtime'] = 'admin_panel/Master/overtime_m';
$route['admin/overtime-add'] = 'admin_panel/Master/overtime_add_m';
$route['admin/get-all-emp-id-for-overtime'] = 'admin_panel/Master/get_all_emp_id_for_overtime_m';
$route['admin/form-add-overtime'] = 'admin_panel/Master/form_add_overtime';
$route['admin/ajax-overtime-table-data'] = 'admin_panel/Master/ajax_overtime_table_data_m';
$route['admin/del-overtime-list'] = 'admin_panel/Master/del_overtime_list_m';
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


$route['admin/form_add_article_rate_new'] = 'admin_panel/Master/form_add_article_rate_new';


$route['admin/form_edit_article_rate'] = 'admin_panel/Master/form_edit_article_rate';


$route['admin/form_edit_article_rate_new'] = 'admin_panel/Master/form_edit_article_rate_new';


$route['ajax_fetch_article_rate'] = 'admin_panel/Master/ajax_fetch_article_rate';


$route['ajax_fetch_article_rate_new'] = 'admin_panel/Master/ajax_fetch_article_rate_new';


$route['ajax_unique_article_rate_date'] = 'admin_panel/Master/ajax_unique_article_rate_date';
$route['ajax_unique_article_rate_date_new'] = 'admin_panel/Master/ajax_unique_article_rate_date_new';

$route['admin/courier-master'] = 'admin_panel/Master/courier';
$route['admin/courier-master/(:any)'] = 'admin_panel/Master/courier';
$route['admin/courier-master/(:any)/(:any)'] = 'admin_panel/Master/courier';

$route['admin/clone_article_master/(:any)'] = 'admin_panel/Master/clone_article_master/$1';
$route['admin/form_edit_article_master_clone'] = 'admin_panel/Master/form_edit_article_master_clone';
$route['ajax_fetch_article_color_clone'] = 'admin_panel/Master/ajax_fetch_article_color_clone';
$route['ajax_fetch_article_part_clone'] = 'admin_panel/Master/ajax_fetch_article_part_clone';
$route['ajax_fetch_article_rate_clone'] = 'admin_panel/Master/ajax_fetch_article_rate_clone';
$route['ajax-del-row-on-table-and-pk-clone'] = 'admin_panel/Master/ajax_del_row_on_table_and_pk_clone';
$route['ajax_article_color_table_data_clone'] = 'admin_panel/Master/ajax_article_color_table_data_clone';
$route['ajax_article_part_table_data_clone'] = 'admin_panel/Master/ajax_article_part_table_data_clone';
$route['ajax_article_rate_table_data_clone'] = 'admin_panel/Master/ajax_article_rate_table_data_clone';
$route['admin/form_add_article_color_clone'] = 'admin_panel/Master/form_add_article_color_clone';
$route['admin/form_edit_article_color_clone'] = 'admin_panel/Master/form_edit_article_color_clone';
$route['admin/form_add_article_part_clone'] = 'admin_panel/Master/form_add_article_part_clone';
$route['admin/form_edit_article_part_clone'] = 'admin_panel/Master/form_edit_article_part_clone';
$route['admin/form_add_article_rate_clone'] = 'admin_panel/Master/form_add_article_rate_clone';
$route['admin/form_edit_article_rate_clone'] = 'admin_panel/Master/form_edit_article_rate_clone';
$route['admin/pending_clone_master'] = 'admin_panel/Master/pending_clone_master';
$route['ajax_article_master_table_data_pending_clone'] = 'admin_panel/Master/ajax_article_master_table_data_pending_clone';
$route['admin/article_master_clone_delete/(:any)'] = 'admin_panel/Master/article_master_clone_delete/$1';



// Master delete 

// master delete ends 

// common routes 

$route['admin/all-items-on-item-group-id'] = 'admin_panel/Transactions/ajax_all_items_on_item_group_id';
$route['admin/all-item-colour-wrt-im-id'] = 'admin_panel/Transactions/ajax_item_colour_wrt_im_id';
$route['admin/buyer-items-on-item-group-id'] = 'admin_panel/Transactions/ajax_buyer_items_on_item_group_id';
$route['ajax-del-row-on-table-and-pk'] = 'admin_panel/Master/ajax_del_row_on_table_and_pk';



// COMMON ROUTES ENDS 

$route['ajax_item_master_table_data'] = 'admin_panel/Master/ajax_item_master_table_data';
$route['ajax_item_color_table_data'] = 'admin_panel/Master/ajax_item_color_table_data';
$route['ajax_item_color_rate_table_data'] = 'admin_panel/Master/ajax_item_color_rate_table_data';
$route['ajax_item_color_rate_table_data_new'] = 'admin_panel/Master/ajax_item_color_rate_table_data_new';
$route['ajax_item_buy_code_table_data'] = 'admin_panel/Master/ajax_item_buy_code_table_data';
$route['ajax_article_rate_table_data'] = 'admin_panel/Master/ajax_article_rate_table_data';
$route['ajax_article_rate_table_data_new'] = 'admin_panel/Master/ajax_article_rate_table_data_new';
$route['ajax_article_part_table_data'] = 'admin_panel/Master/ajax_article_part_table_data';
$route['ajax_article_color_table_data'] = 'admin_panel/Master/ajax_article_color_table_data';
$route['ajax_article_master_table_data'] = 'admin_panel/Master/ajax_article_master_table_data';
$route['admin/add-currencies-rate/(:any)'] = 'admin_panel/Master/add_currencies_rate/$1';
$route['admin/add-currencies-rate/(:any)/(:any)'] = 'admin_panel/Master/add_currencies_rate/$1';
$route['admin/add-currencies-rate/(:any)/(:any)/(:any)'] = 'admin_panel/Master/add_currencies_rate/$1';

$route['ajax-fetch-mapped-item'] = 'admin_panel/Transactions/ajax_fetch_mapped_item';

$route['admin/del-row-on-table-pk-clone'] = 'admin_panel/Transactions/ajax_del_row_on_table_and_pk_clone';
$route['admin/del-row-on-table-pk'] = 'admin_panel/Transactions/ajax_del_row_on_table_and_pk';

$route['admin/delete-costing'] = 'admin_panel/Transactions/delete_costing';

$route['admin/article_costing'] = 'admin_panel/Transactions/article_costing';
$route['admin/print_multiple_article_costing'] = 'admin_panel/Transactions/print_multiple_article_costing';
$route['admin/add_article_costing'] = 'admin_panel/Transactions/add_article_costing';
$route['admin/form_add_article_costing'] = 'admin_panel/Transactions/form_add_article_costing';
$route['admin/edit_article_costing/(:any)'] = 'admin_panel/Transactions/edit_article_costing/$1';
$route['admin/clone_article_costing/(:any)'] = 'admin_panel/Transactions/clone_article_costing/$1';
$route['admin/print_article_costing/(:num)'] = 'admin_panel/Transactions/print_article_costing/$1';
$route['admin/print_article_costing_ms/(:num)'] = 'admin_panel/Transactions/print_article_costing_ms/$1';
$route['admin/print_article_costing_wo_rate/(:num)'] = 'admin_panel/Transactions/print_article_costing_wo_rate/$1';
$route['admin/costing-clone-swap-item'] = 'admin_panel/Transactions/costing_clone_swap_item';
$route['admin/pending_clone_costing'] = 'admin_panel/Transactions/pending_clone_costing';
$route['ajax_article_costing_clone_table_data'] = 'admin_panel/Transactions/ajax_article_costing_clone_table_data';
$route['admin/del-costing-pending-clone-list'] = 'admin_panel/Transactions/del_costing_pending_clone_list';
$route['admin/costing-swap-item-clr'] = 'admin_panel/Transactions/costing_swap_item_clr';
$route['admin/costing-swap-item'] = 'admin_panel/Transactions/costing_swap_item';


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
$route['ajax-fetch-article-colour_new'] = 'admin_panel/Customer_order/ajax_fetch_article_colour_new';
$route['ajax_unique_customer_order_number'] = 'admin_panel/Customer_order/ajax_unique_customer_order_number';
$route['admin/form_add_customer_order'] = 'admin_panel/Customer_order/form_add_customer_order';


// edit area 
$route['admin/edit-customer-order/(:num)'] = 'admin_panel/Customer_order/edit_customer_order/$1';
$route['admin/form_edit_customer_order'] = 'admin_panel/Customer_order/form_edit_customer_order';
$route['admin/ajax_unique_customer_order_no'] = 'admin_panel/Customer_order/ajax_unique_customer_order_no';
$route['ajax_customer_order_details_table_data'] = 'admin_panel/Customer_order/ajax_customer_order_details_table_data';
$route['admin/form_add_customer_order_details'] = 'admin_panel/Customer_order/form_add_customer_order_details';
$route['admin/ajax_fetch_customer_order_details_on_pk'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_details_on_pk';
$route['admin/ajax_fetch_customer_order_breakup_details_on_pk'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_breakup_details_on_pk';
$route['admin/ajax_fetch_purchase_order_breakup_details_on_pk'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_breakup_details_on_pk';
$route['admin/ajax_fetch_customer_order_details_brkup_qnty'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_details_brkup_qnty';
$route['admin/ajax_fetch_purchase_order_details_brkup_qnty'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_details_brkup_qnty';
$route['admin/ajax_fetch_purchase_order_details_brkup_qnty_edit'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_details_brkup_qnty_edit';
$route['admin/form_edit_customer_order_details'] = 'admin_panel/Customer_order/form_edit_customer_order_details';
$route['admin/form_add_customer_order_brkup_details'] = 'admin_panel/Customer_order/form_add_customer_order_brkup_details';
$route['admin/form_add_purchase_order_brkup_details'] = 'admin_panel/Purchase_order/form_add_purchase_order_brkup_details';
$route['admin/ajax_fetch_customer_order_details_brkup_edit'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_details_brkup_edit';
$route['admin/ajax_fetch_purchase_order_details_brkup_edit'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_details_brkup_edit';
$route['admin/form_edit_customer_order_details_brkup'] = 'admin_panel/Customer_order/form_edit_customer_order_details_brkup';
$route['admin/form_edit_purchase_order_details_brkup'] = 'admin_panel/Purchase_order/form_edit_purchase_order_details_brkup';
$route['admin/ajax_unique_co_no_and_art_no_and_lth_color'] = 'admin_panel/Customer_order/ajax_unique_co_no_and_art_no_and_lth_color';
$route['admin/report-order-status-details-brkup-dashboard'] = 'admin_panel/Dashboard/report_order_status_details_brkup_dashboard';

$route['admin/del-row-on-table-pk-customer-order'] = 'admin_panel/Customer_order/ajax_del_row_on_table_and_pk_customer_order';
$route['admin/del-row-on-table-pk-purch-order'] = 'admin_panel/Purchase_order/ajax_del_row_on_table_and_pk_purch_order';
$route['admin/ajax-del-customer-order-list'] = 'admin_panel/Customer_order/ajax_customer_order_delete';
// print area
$route['admin/print-customer-order-consumption/(:num)'] = 'admin_panel/Customer_order/print_customer_order_consumption/$1';
$route['admin/remove_customer_order_image/(:num)'] = 'admin_panel/Customer_order/remove_customer_order_image/$1';
$route['admin/order-consumption-group-by'] = 'admin_panel/Customer_order/order_consumption_group_by';
$route['admin/full-order-history/(:num)'] = 'admin_panel/Customer_order/full_order_history/$1';

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
$route['admin/ajax-unique-purchase-order-receive_num'] = 'admin_panel/Purchase_order/ajax_unique_purchase_order_receive_num';
$route['admin/fetch-cost-rate-wrt-item'] = 'admin_panel/Purchase_order/ajax_fetch_cost_rate_wrt_item';
// edit 
$route['admin/edit-purchase-order/(:num)'] = 'admin_panel/Purchase_order/edit_purchase_order/$1';
$route['admin/ajax_fetch_purchase_order_details_on_pk'] = 'admin_panel/Purchase_order/ajax_fetch_purchase_order_details_on_pk';
$route['admin/ajax_unique_po_number_and_art_no_and_lth_color'] = 'admin_panel/Purchase_order/ajax_unique_po_number_and_art_no_and_lth_color';

$route['admin/form_edit_purchase_order'] = 'admin_panel/Purchase_order/form_edit_purchase_order';
$route['admin/ajax_purchase_order_details_table_data'] = 'admin_panel/Purchase_order/ajax_purchase_order_details_table_data';
$route['admin/all-items-on-item-group'] = 'admin_panel/Purchase_order/ajax_all_items_on_item_group';
$route['admin/ajax-all-purchase-order-for_supl'] = 'admin_panel/Supp_purchase_order/ajax_all_purchase_order_for_supl';
$route['admin/ajax-all-purchase-order-wrt-suppliers'] = 'admin_panel/Supp_purchase_order/ajax_all_purchase_order_wrt_suppliers';
$route['admin/all-colors-on-item-master'] = 'admin_panel/Purchase_order/ajax_all_colors_on_item_master';
$route['admin/all-colors-on-item-master-wrt-purc-ord'] = 'admin_panel/Supp_purchase_order/all_colors_on_item_master_wrt_purc_ord';
$route['admin/form_edit_purchase_order_details'] = 'admin_panel/Purchase_order/form_edit_purchase_order_details';

//Delete
$route['admin/ajax_fetch_purchase_order_delete_on_pk'] = 'admin_panel/Purchase_order/ajax_del_row_on_table_and_pk_purchase_order';
$route['admin/del-row-on-table-pk-purchase-order-details'] = 'admin_panel/Purchase_order/del_row_on_table_pk_purchase_order_details';

// print 
$route['admin/purchase-order-print-with-brkup/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_with_brkup/$1';
$route['admin/purchase-order-print-with-brkup-wo-order/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_with_brkup_wo_order/$1';
$route['admin/purchase-order-print-with-code/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_with_code/$1';
$route['admin/purchase-order-print-without-code/(:num)'] = 'admin_panel/Purchase_order/purchase_order_print_without_code/$1';
// PURCHASE ORDER AREA ENDS

// SUPP PURCHASE ORDER AREA STARTS 

// list
$route['admin/supp-purchase-order'] = 'admin_panel/Supp_purchase_order/supp_purchase_order';
$route['admin/ajax-supp-purchase-order-table-data'] = 'admin_panel/Supp_purchase_order/ajax_supp_purchase_order_table_data';

// add 
$route['admin/add-supp-purchase-order'] = 'admin_panel/Supp_purchase_order/add_supp_purchase_order';
$route['admin/ajax-unique-supp-purchase-order-number'] = 'admin_panel/Supp_purchase_order/ajax_unique_supp_purchase_order_no';
$route['admin/form_add_supp_purchase_order'] = 'admin_panel/Supp_purchase_order/form_add_supp_purchase_order';
$route['admin/ajax-all-purchase-order'] = 'admin_panel/Supp_purchase_order/ajax_all_purchase_order';

// edit 
$route['admin/edit-supp-purchase-order/(:num)'] = 'admin_panel/Supp_purchase_order/edit_supp_purchase_order/$1';
$route['admin/form-edit-supp-purchase-order'] = 'admin_panel/Supp_purchase_order/form_edit_supp_purchase_order';
$route['admin/ajax-supp-purchase-order-details-table-data'] = 'admin_panel/Supp_purchase_order/ajax_supp_purchase_order_details_table_data';
$route['admin/form-add-supp-purchase-order-details'] = 'admin_panel/Supp_purchase_order/form_add_supp_purchase_order_details';
$route['admin/ajax-fetch-supp-purchase-order-details-on-pk'] = 'admin_panel/Supp_purchase_order/ajax_fetch_supp_purchase_order_details_on_pk';
$route['admin/form-edit-supp-purchase-order-details'] = 'admin_panel/Supp_purchase_order/form_edit_supp_purchase_order_details';

// delete
$route['admin/delete-supp-purchase-order-details'] = 'admin_panel/Supp_purchase_order/delete_supp_purchase_order_details';
$route['admin/del-supp-purchase-order-details-list'] = 'admin_panel/Supp_purchase_order/delete_supp_purchase_order_details_list';

//CUTTING ISSUE CHALLAN START 

// list
$route['admin/cutting-issue-challan'] = 'admin_panel/Cutting_issue_challan/cutting_issue_challan';
$route['admin/ajax-cutting-issue-challan-table-data'] = 'admin_panel/Cutting_issue_challan/ajax_cutting_issue_challan_table_data';

// add 
$route['admin/add-cutting-issue-challan'] = 'admin_panel/Cutting_issue_challan/add_cutting_issue_challan';
//$route['admin/ajax-unique-supp-purchase-order-number'] = 'admin_panel/Cutting_issue_challan/ajax_unique_supp_purchase_order_no';
$route['admin/form-add-cutting-issue-challan'] = 'admin_panel/Cutting_issue_challan/form_add_cutting_issue_challan';
$route['admin/ajax-all-purchase-order'] = 'admin_panel/Cutting_issue_challan/ajax_all_purchase_order';

// edit 
$route['admin/edit-cutting-issue-challan/(:num)'] = 'admin_panel/Cutting_issue_challan/edit_cutting_issue_challan/$1';
$route['admin/form-edit-cutting-issue-challan'] = 'admin_panel/Cutting_issue_challan/form_edit_cutting_issue_challan';
$route['admin/get-customer-order-dtl'] = 'admin_panel/Cutting_issue_challan/get_customer_order_dtl';

$route['admin/ajax-cutting-issue-challan-details-table-data'] = 'admin_panel/Cutting_issue_challan/ajax_cutting_issue_challan_details_table_data';

$route['admin/form-add-cutting-issue-challan-details'] = 'admin_panel/Cutting_issue_challan/form_add_cutting_issue_challan_details';

$route['admin/ajax-fetch-supp-purchase-order-details-on-pk'] = 'admin_panel/Cutting_issue_challan/ajax_fetch_supp_purchase_order_details_on_pk';
$route['admin/form-edit-supp-purchase-order-details'] = 'admin_panel/Cutting_issue_challan/form_edit_supp_purchase_order_details';

// delete
$route['admin/delete-cutting-issue-challan-details'] = 'admin_panel/Cutting_issue_challan/delete_cutting_issue_challan_details';
$route['admin/del-cutting-issue-challan-details-list'] = 'admin_panel/Cutting_issue_challan/delete_cutting_issue_challan_details_list';

//print
$route['admin/print-cutting-issue-challan/(:num)'] = 'admin_panel/Cutting_issue_challan/print_cutting_issue_challan/$1';

//CUTTING RECEIVED

//List
$route['admin/cutting-receive'] = 'admin_panel/Cutting_receive/cutting_receive';
$route['admin/ajax-cutting-receive-table-data'] = 'admin_panel/Cutting_receive/ajax_cutting_receive_table_data';

//Add 
$route['admin/add-cutting-receive'] = 'admin_panel/Cutting_receive/add_cutting_receive';
$route['admin/form-add-receive-challan'] = 'admin_panel/Cutting_receive/form_add_receive_challan';

// edit 
$route['admin/edit-cutting-receive/(:num)'] = 'admin_panel/Cutting_receive/edit_cutting_receive/$1';
$route['admin/form-edit-cutting-receive'] = 'admin_panel/Cutting_receive/form_edit_cutting_receive';
$route['admin/get-customer-order-dtl-cutting-receive'] = 'admin_panel/Cutting_receive/get_customer_order_dtl_cutting_receive';
$route['admin/ajax-get-article-detail'] = 'admin_panel/Cutting_receive/ajax_get_article_detail';
$route['admin/ajax-get-issue-quantity-and-article-detail'] = 'admin_panel/Cutting_receive/ajax_get_issue_quantity_and_article_detail';

$route['admin/form-add-cutting-receive-challan-details'] = 'admin_panel/Cutting_receive/form_add_cutting_receive_challan_details';
$route['admin/ajax-cutting-receive-challan-details-table-data'] = 'admin_panel/Cutting_receive/ajax_cutting_receive_challan_details_table_data';

$route['admin/ajax-fetch-cutting-receive-challan-details-on-pk'] = 'admin_panel/Cutting_receive/ajax_fetch_cutting_receive_challan_details_on_pk';
$route['admin/form-edit-issue-receive-details'] = 'admin_panel/Cutting_receive/form_edit_issue_receive_details';


// delete
$route['admin/delete-receive-challan-details'] = 'admin_panel/Cutting_receive/delete_cutting_receive_details';
$route['admin/del-cutting-receive-challan-details-list'] = 'admin_panel/Cutting_receive/delete_cutting_receive_challan_details_list';


// Print
$route['admin/cutting-receive-challan-print/(:num)'] = 'admin_panel/Cutting_receive/cutting_receive_challan_print/$1';
$route['admin/cutting-receive-print-multiple'] = 'admin_panel/Cutting_receive/cutting_receive_print_multiple';


// CUTTER BILL

//List
$route['admin/cutter-bill'] = 'admin_panel/Cutting_receive/cutter_bill';
$route['admin/ajax-cutter-bill-table-data'] = 'admin_panel/Cutting_receive/ajax_cutter_bill_table_data';

//Add
$route['admin/add-cutter-bill'] = 'admin_panel/Cutting_receive/add_cutter_bill';
$route['admin/form-add-cutting-bill'] = 'admin_panel/Cutting_receive/form_add_cutting_bill';
$route['admin/form-add-cutting-bill-details'] = 'admin_panel/Cutting_receive/form_add_cutting_bill_details';
$route['admin/cutter-bill-update-article-part'] = 'admin_panel/Cutting_receive/cutter_bill_update_article_part';

// Edit
$route['admin/edit-cutter-bill/(:num)'] = 'admin_panel/Cutting_receive/edit_cutting_bill/$1';
$route['admin/form-edit-cutting-bill'] = 'admin_panel/Cutting_receive/form_edit_cutting_bill';
$route['admin/ajax-cutting-bill-details-table-data'] = 'admin_panel/Cutting_receive/ajax_cutting_bill_details_table_data';
$route['admin/get-cutter-bill-details-on-cutter-receive'] = 'admin_panel/Cutting_receive/ajax_cutting_bill_details_on_cutter_receive';

// Del
$route['admin/del-cutting-bill-details'] = 'admin_panel/Cutting_receive/del_cutting_bill_details';
$route['admin/delete-cutter-list'] = 'admin_panel/Cutting_receive/delete_cutter_list';
//Purchase Order Receive Start

//List
$route['admin/receive-purchase-order'] = 'admin_panel/Receive_purchase_order/receive_purchase_order';
$route['admin/ajax-receive-purchase-order-table-data'] = 'admin_panel/Receive_purchase_order/ajax_receive_purchase_order_table_data';

// add 
$route['admin/add-receive-purchase-order'] = 'admin_panel/Receive_purchase_order/add_receive_purchase_order';
//$route['admin/ajax-unique-supp-purchase-order-number'] = 'admin_panel/Supp_purchase_order/ajax_unique_supp_purchase_order_no';
$route['admin/form_add_receive_purchase_order'] = 'admin_panel/Receive_purchase_order/form_add_receive_purchase_order';

// edit 
$route['admin/edit-receive-purchase-order/(:num)'] = 'admin_panel/Receive_purchase_order/edit_receive_purchase_order/$1';
$route['admin/form-edit-receive-purchase-order'] = 'admin_panel/Receive_purchase_order/form_edit_receive_purchase_order';
$route['admin/ajax-receive-purchase-order-details-table-data'] = 'admin_panel/Receive_purchase_order/ajax_receive_purchase_order_details_table_data';
$route['admin/ajax-fetch-receive-purchase-order-details-on-pk'] = 'admin_panel/Receive_purchase_order/ajax_fetch_receive_purchase_order_details_on_pk';
$route['admin/form-add-receive-purchase-order-details'] = 'admin_panel/Receive_purchase_order/form_add_receive_purchase_order_details';
$route['admin/all-items-on-purchase-order'] = 'admin_panel/Receive_purchase_order/all_items_on_purchase_order';
$route['admin/all-items-on-supp-purchase-order'] = 'admin_panel/Receive_purchase_order/all_items_on_supp_purchase_order';
$route['admin/ajax-get-remaining-item-quantity'] = 'admin_panel/Receive_purchase_order/ajax_get_remaining_item_quantity';

$route['admin/form-edit-receive-purchase-order-details'] = 'admin_panel/Receive_purchase_order/form_edit_receive_purchase_order_details';
$route['admin/form-edit-delivery-sgst-cgst-value'] = 'admin_panel/Receive_purchase_order/form_edit_delivery_sgst_cgst_value';


// delete
$route['admin/delete-receive-purchase-order-details'] = 'admin_panel/Receive_purchase_order/delete_receive_purchase_order_details';
$route['admin/del-receive-purchase-order-details-list'] = 'admin_panel/Receive_purchase_order/delete_receive_purchase_order_details_list';

$route['admin/purchase-bill-rate-setup/(:num)'] = 'admin_panel/Receive_purchase_order/purchase_bill_rate_setup/$1';

//Purchase Order Receive End

//Skiving issue start

//List
$route['admin/skiving-issue'] = 'admin_panel/Skiving_issue/skiving_issue';
$route['admin/ajax-cutting-receive-table-data-skiving'] = 'admin_panel/Skiving_issue/ajax_cutting_receive_table_data_skiving';

//Add 
$route['admin/add-skiving-issue'] = 'admin_panel/Skiving_issue/add_skiving_issue';
$route['admin/ajax-unique-skiving-issue-number'] = 'admin_panel/Skiving_issue/ajax_unique_skiving_issue_no';
$route['admin/form-add-skiving-issue'] = 'admin_panel/Skiving_issue/form_add_skiving_issue';

//Edit
$route['admin/edit-skiving-issue/(:num)'] = 'admin_panel/Skiving_issue/edit_skiving_issue/$1';
$route['admin/form-edit-skiving-issue'] = 'admin_panel/Skiving_issue/form_edit_skiving_issue';
$route['admin/ajax-skiving-issue-table-data/(:num)'] = 'admin_panel/Skiving_issue/ajax_skiving_issue_table_data/$1';

//Delete
$route['admin/del-skiving-issue-list'] = 'admin_panel/Skiving_issue/delete_skiving_issue_list';

// Print
$route['admin/skiving-challan-issue-print/(:num)'] = 'admin_panel/Skiving_issue/skiving_challan_issue_print/$1';

// BILL
$route['admin/skiving-bill'] = 'admin_panel/Skiving_issue/skiving_bill';
$route['admin/ajax-skiving-bill-table-data'] = 'admin_panel/Skiving_issue/ajax_skiving_bill_table_data';
$route['admin/ajax-skiving-bill-details-table-data'] = 'admin_panel/Skiving_issue/ajax_skiving_bill_details_table_data';
	//Bill add
$route['admin/add-skiving-bill'] = 'admin_panel/Skiving_issue/add_skiving_bill';
$route['admin/form-add-skiving-bill'] = 'admin_panel/Skiving_issue/form_add_skiving_bill';
$route['admin/form-add-skiving-bill-details'] = 'admin_panel/Skiving_issue/form_add_skiving_bill_details';

$route['admin/ajax-skiving-issue-on-co_id'] = 'admin_panel/Skiving_issue/ajax_skiving_issue_on_co_id';
$route['admin/ajax-article-dtl-on-cut_rcv_id_and_co_id'] = 'admin_panel/Skiving_issue/ajax_article_dtl_on_cut_rcv_id_and_co_id';
$route['admin/ajax-fetch-skiving-bill-pending-qnty'] = 'admin_panel/Skiving_issue/ajax_fetch_skiving_bill_pending_qnty';

	// Bill edit
$route['admin/edit-skiving-bill/(:num)'] = 'admin_panel/Skiving_issue/edit_skiving_bill/$1';
$route['admin/form-edit-skiving-bill'] = 'admin_panel/Skiving_issue/form_edit_skiving_bill';
	// Bill Print
$route['admin/print-skiving-bill/(:num)'] = 'admin_panel/Skiving_issue/print_skiving_bill/$1';
	// Bill Delete
$route['admin/delete-skiving-list'] = 'admin_panel/Skiving_issue/delete_skiving_bill_list';	
$route['admin/del-skiving-bill-details'] = 'admin_panel/Skiving_issue/delete_skiving_bill_details';	
//Skiving issue end

//Skiving Receive Start
//List
$route['admin/skiving-receive'] = 'admin_panel/Skiving_receive/skiving_receive';
$route['admin/ajax-skiving-receive-table-data'] = 'admin_panel/Skiving_receive/ajax_skiving_receive_table_data';

//Add 
$route['admin/skiving-receive-add'] = 'admin_panel/Skiving_receive/skiving_receive_add';
$route['admin/ajax-unique-skiving-receive-challan-number'] = 'admin_panel/Skiving_receive/ajax_unique_skiving_receive_challan_number';
$route['admin/form-skiving-receive-add'] = 'admin_panel/Skiving_receive/form_skiving_receive_add';

// edit 
$route['admin/skiving-receive-edit/(:num)'] = 'admin_panel/Skiving_receive/skiving_receive_edit/$1';
$route['admin/form-skiving-receive-edit'] = 'admin_panel/Skiving_receive/form_skiving_receive_edit';
$route['admin/fetch-all-skiving-issue-article'] = 'admin_panel/Skiving_receive/fetch_all_skiving_issue_article';
$route['admin/ajax-cutting-receive-quantity-and-article-detail'] = 'admin_panel/Skiving_receive/ajax_cutting_receive_quantity_and_article_detail';
$route['admin/form-add-skiving-receive-challan-details'] = 'admin_panel/Skiving_receive/form_add_skiving_receive_challan_details';
$route['admin/ajax-skiving-receive-challan-details-table-data'] = 'admin_panel/Skiving_receive/ajax_skiving_receive_challan_details_table_data';
$route['admin/ajax-fetch-skiving-receive-challan-details-on-pk'] = 'admin_panel/Skiving_receive/ajax_fetch_skiving_receive_challan_details_on_pk';
$route['admin/form-edit-skiving-receive-details'] = 'admin_panel/Skiving_receive/form_edit_skiving_receive_details';

// delete
$route['admin/skiving-receive-challan-delete'] = 'admin_panel/Skiving_receive/skiving_receive_challan_delete';
$route['admin/del-skiving-receive-challan-details-list'] = 'admin_panel/Skiving_receive/skiving_receive_challan_details_list_delete';

//Skiving Receive End

//Jobber Challan Issue start

	//List
	$route['admin/jobber-challan-issue'] = 'admin_panel/Jobber_challan_issue/jobber_challan_issue';
	$route['admin/ajax-jobber-challan-issue-table-data'] = 'admin_panel/Jobber_challan_issue/ajax_jobber_challan_issue_table_data';
	
	//Add
	$route['admin/jobber-challan-issue-add'] = 'admin_panel/Jobber_challan_issue/jobber_challan_issue_add';
	$route['admin/form-jobber-challan-issue-add'] = 'admin_panel/Jobber_challan_issue/form_jobber_challan_issue_add';
	$route['admin/ajax-jobber-challan-issue-number'] = 'admin_panel/Jobber_challan_issue/ajax_jobber_challan_issue_number';
	
	//Edit
	$route['admin/jobber-challan-issue-edit/(:num)'] = 'admin_panel/Jobber_challan_issue/jobber_challan_issue_edit/$1';
	$route['admin/form-jobber-issue-edit'] = 'admin_panel/Jobber_challan_issue/form_jobber_issue_edit';
	$route['admin/form-add-jobber-issue-challan-details'] = 'admin_panel/Jobber_challan_issue/form_add_jobber_issue_challan_details';
	$route['admin/get-customer-order-dtl-cutting-receive-jobber'] = 'admin_panel/Jobber_challan_issue/get_customer_order_dtl_cutting_receive_jobber';
	$route['admin/get-skiving-receipt-dtl-wrt-cutting-receive-dtl'] = 'admin_panel/Jobber_challan_issue/get_skiving_receipt_dtl_wrt_cutting_receive_dtl';
	$route['admin/get-article-dtl-wrt-skiving-receive-dtl'] = 'admin_panel/Jobber_challan_issue/get_article_dtl_wrt_skiving_receive_dtl';
	$route['admin/ajax-get-received-quantity-in-cutting'] = 'admin_panel/Jobber_challan_issue/ajax_get_received_quantity_in_cutting';
	$route['admin/ajax-get-skiving-quantity-in-jobber'] = 'admin_panel/Jobber_challan_issue/ajax_get_skiving_quantity_in_jobber';
	$route['admin/ajax-skiving-issue-details-table-data'] = 'admin_panel/Jobber_challan_issue/ajax_skiving_issue_details_table_data';
	$route['admin/ajax-fetch-jobber-challan-details-for-edit'] = 'admin_panel/Jobber_challan_issue/ajax_fetch_jobber_challan_details_for_edit';
	$route['admin/form-edit-jobber-issue-challan-details'] = 'admin_panel/Jobber_challan_issue/form_edit_jobber_issue_challan_details';
	
	//Delete
	$route['admin/del-jobber-challan-details-list'] = 'admin_panel/Jobber_challan_issue/del_jobber_challan_details_list';
	$route['admin/delete-jobber-challan-header'] = 'admin_panel/Jobber_challan_issue/delete_jobber_challan_header';

	//Print
	$route['admin/print-jobber-issue-challan/(:num)'] = 'admin_panel/Jobber_challan_issue/print_jobber_issue_challan/$1';
	
//Jobber Challan Issue end

//Jobber Challan Receipt start
	//List
	$route['admin/jobber-challan-receipt'] = 'admin_panel/Jobber_challan_receipt/jobber_challan_receipt_list';
	$route['admin/ajax-jobber-challan-receipt-table-data'] = 'admin_panel/Jobber_challan_receipt/ajax_jobber_challan_receipt_table_data';
	
	//Add
	$route['admin/jobber-challan-receipt-add'] = 'admin_panel/Jobber_challan_receipt/jobber_challan_receipt_add';
	$route['admin/form-jobber-challan-receipt-add'] = 'admin_panel/Jobber_challan_receipt/form_jobber_challan_receipt_add';
	$route['admin/ajax_unique_jobber_receipt_number'] = 'admin_panel/Jobber_challan_receipt/ajax_unique_jobber_receipt_number';
	
	//Edit
	$route['admin/jobber-challan-receipt-edit/(:num)'] = 'admin_panel/Jobber_challan_receipt/jobber_challan_receipt_edit/$1';
	$route['admin/form-jobber-receipt-edit'] = 'admin_panel/Jobber_challan_receipt/form_jobber_receipt_edit';
	$route['admin/ajax-jobber-receipt-details-table-data'] = 'admin_panel/Jobber_challan_receipt/ajax_jobber_challan_receipt_details_table_data';
	$route['admin/form-add-jobber-receipt-challan-details'] = 'admin_panel/Jobber_challan_receipt/form_add_jobber_receipt_challan_details';
	$route['admin/ajax-get-article-info-by-jobber-issue-detail'] = 'admin_panel/Jobber_challan_receipt/ajax_get_article_info_by_jobber_issue_detail';
		$route['admin/ajax-get-article-info-details-wrt-jobber-issue-detail'] = 'admin_panel/Jobber_challan_receipt/ajax_get_article_info_details_wrt_jobber_issue_detail';
	$route['admin/jobber-issue-by-customer-order'] = 'admin_panel/Jobber_challan_receipt/jobber_issue_by_customer_order';
	
	//Delete
	$route['admin/delete-jobber-receipt-challan-header'] = 'admin_panel/Jobber_challan_receipt/delete_jobber_receipt_challan_header';
	$route['admin/del-jobber-receipt-details-list'] = 'admin_panel/Jobber_challan_receipt/delete_jobber_receipt_challan_detail_list';
//Jobber Challan Receipt end


//Sample Issue Area Start
	//List
	$route['admin/sample-challan-issue'] = 'admin_panel/Sample_challan_issue/sample_challan_issue_list';
	$route['admin/ajax-sample-challan-issue-table-data'] = 'admin_panel/Sample_challan_issue/ajax_sample_challan_issue_table_data';

	//Add
	$route['admin/sample-challan-issue-add'] = 'admin_panel/Sample_challan_issue/sample_challan_issue_add';
	$route['admin/form-sample-challan-issue-add'] = 'admin_panel/Sample_challan_issue/form_sample_challan_issue_add';
	$route['admin/ajax-sample-challan-issue-number'] = 'admin_panel/Sample_challan_issue/ajax_sample_challan_issue_number';

	//Edit
	$route['admin/sample-challan-issue-edit/(:num)'] = 'admin_panel/Sample_challan_issue/sample_challan_issue_edit/$1';
	$route['admin/ajax-sample-issue-details-table-data'] = 'admin_panel/Sample_challan_issue/ajax_sample_issue_details_table_data';
	$route['admin/get_article_color_wrt_am_id'] = 'admin_panel/Sample_challan_issue/ajax_get_article_color_wrt_am_id';
	$route['admin/form-add-sample-issue-challan-details'] = 'admin_panel/Sample_challan_issue/form_add_sample_issue_challan_details';
	$route['admin/ajax-fetch-sample-challan-details-on-pk'] = 'admin_panel/Sample_challan_issue/ajax_fetch_sample_challan_details_on_pk';
	$route['admin/form-edit-sample-issue-challan-details'] = 'admin_panel/Sample_challan_issue/form_edit_sample_issue_challan_details';

	//Delete
	$route['admin/del-sample-challan-details-list'] = 'admin_panel/Sample_challan_issue/del_sample_challan_details_list';
	
	//Print
	$route['admin/sample-challan-issue-print/(:num)'] = 'admin_panel/Sample_challan_issue/sample_challan_issue_print/$1';
	
//Sample Issue Area end

//Sample Receive Area Start
	//List
	$route['admin/sample-challan-receive'] = 'admin_panel/Sample_challan_receive/sample_challan_receive_list';
	$route['admin/ajax-sample-challan-receive-table-data'] = 'admin_panel/Sample_challan_receive/ajax_sample_challan_receive_table_data';

	//Add
	$route['admin/sample-challan-receive-add'] = 'admin_panel/Sample_challan_receive/sample_challan_receive_add';
	$route['admin/form-sample-challan-receive-add'] = 'admin_panel/Sample_challan_receive/form_sample_challan_receive_add';
	$route['admin/ajax-sample-challan-receive-number'] = 'admin_panel/Sample_challan_receive/ajax_sample_challan_receive_number';

	//Edit
	$route['admin/sample-challan-receive-edit/(:num)'] = 'admin_panel/Sample_challan_receive/sample_challan_receive_edit/$1';
	$route['admin/form-sample-receive-edit'] = 'admin_panel/Sample_challan_receive/form_sample_receive_edit';
	$route['admin/ajax-sample-receipt-details-table-data'] = 'admin_panel/Sample_challan_receive/ajax_sample_receipt_details_table_data';
	$route['admin/sample-issue-by-acc-master'] = 'admin_panel/Sample_challan_receive/sample_issue_by_acc_master';
	$route['admin/article-master-by-sample-challan-no'] = 'admin_panel/Sample_challan_receive/article_master_by_sample_challan_no';
	$route['admin/article-quantity-by-sample-challan-no'] = 'admin_panel/Sample_challan_receive/article_quantity_by_sample_challan_no';
	$route['admin/form-add-sample-receive-challan-details'] = 'admin_panel/Sample_challan_receive/form_add_sample_receive_challan_details';
    $route['admin/del-sample-challan-receipt-details-list'] = 'admin_panel/Sample_challan_receive/del_sample_challan_receipt_details_list';


//Sample Bill start
	//List
	$route['admin/sample-bill'] = 'admin_panel/Sample_bill/sample_bill';
	$route['admin/ajax-sample-bill-table-data'] = 'admin_panel/Sample_bill/ajax_sample_bill_table_data';
		
	//Add
	$route['admin/add-sample-bill'] = 'admin_panel/Sample_bill/add_sample_bill';
	$route['admin/ajax-sample-bill-number'] = 'admin_panel/Sample_bill/ajax_unique_sample_bill_number';
	$route['admin/form-add-sample-bill'] = 'admin_panel/Sample_bill/form_sample_bill_add';
	
	//Edit
	$route['admin/edit-sample-bill/(:num)'] = 'admin_panel/Sample_bill/edit_sample_bill/$1';
	$route['admin/form-edit-sample-bill'] = 'admin_panel/Sample_bill/form_edit_sample_bill';
	$route['admin/form-add-sample-bill-details'] = 'admin_panel/Sample_bill/add_sample_bill_details';
	$route['admin/ajax-sample-bill-detail-table-data'] = 'admin_panel/Sample_bill/sample_bill_details_table';
	$route['admin/form-sample-bill-net_amount'] = 'admin_panel/Sample_bill/form_sample_bill_net_amount';
	$route['admin/sample-bill-get-customer-order-dtl'] = 'admin_panel/Sample_bill/sample_bill_get_customer_order_dtl';
	
	//delete
	$route['admin/del-sample-bill-details-list'] = 'admin_panel/Sample_bill/del_sample_bill_details_list';
	$route['admin/delete-jobber-bill-header-list'] = 'admin_panel/Sample_bill/del_jobber_bill_header_list';
	
//Sample Bill end

//Checking Start
	//List
	$route['admin/checking'] = 'admin_panel/Checking/checking_list';
	$route['admin/ajax-checking-table-data'] = 'admin_panel/Checking/ajax_checking_table_data';
	
	//Add
	$route['admin/checking-list-add'] = 'admin_panel/Checking/checking_list_add';
	$route['admin/form-checking-list-add'] = 'admin_panel/Checking/form_checking_list_add';
	
	//Edit
	$route['admin/checking-list-edit/(:num)'] = 'admin_panel/Checking/checking_list_edit/$1';
	$route['admin/ajax-checking-list-details-table-data'] = 'admin_panel/Checking/ajax_checking_list_details_table_data';
	$route['admin/form-checking-list-edit'] = 'admin_panel/Checking/form_checking_list_edit';
	$route['admin/get-customer-order-dtl-for-checking'] = 'admin_panel/Checking/get_customer_order_dtl_for_checking';
	$route['admin/get-customer-order-dtl-for-checking-am-id'] = 'admin_panel/Checking/get_customer_order_dtl_for_checking_am_id';
	$route['admin/form-add-checking-listn-details'] = 'admin_panel/Checking/form_add_checking_list_details';
	$route['admin/ajax-fetch-checking-details-for-edit'] = 'admin_panel/Checking/ajax_fetch_checking_details_for_edit';
	$route['admin/form-edit-checking-list-details'] = 'admin_panel/Checking/form_edit_checking_list_details';

	//Delete
	$route['admin/delete-checking-list-header'] = 'admin_panel/Checking/checking_list_delete';
	$route['admin/del-checking-details-list'] = 'admin_panel/Checking/del_checking_details_list';
	
//Checking End

//Office Proforma start
	//List Header
	$route['admin/office-proforma'] = 'admin_panel/Office_proforma/office_proforma';
	$route['admin/ajax-office-proforma-table-data'] = 'admin_panel/Office_proforma/ajax_office_proforma_table_data';
	
	//Add Header
	$route['admin/add-office-proforma'] = 'admin_panel/Office_proforma/office_proforma_add';
	$route['admin/ajax-unique-proforma-number'] = 'admin_panel/Office_proforma/ajax_unique_proforma_number';
	$route['admin/form-add-office-proforma'] = 'admin_panel/Office_proforma/form_office_proforma_add';
	
	//Edit 
	$route['admin/edit-office-proforma/(:num)'] = 'admin_panel/Office_proforma/edit_office_proform/$1';
	$route['admin/form-edit-office-proforma'] = 'admin_panel/Office_proforma/form_edit_office_proform';
	$route['admin/ajax-office-proforma-detail-table-data'] = 'admin_panel/Office_proforma/office_proforma_details_table';
	$route['admin/form-add-office-proforma-details'] = 'admin_panel/Office_proforma/form_add_office_proforma_details';
	$route['admin/office-proforma-get-customer-order-dtl'] = 'admin_panel/Office_proforma/Office_proforma_get_customer_order_dtl';
	$route['admin/ajax-fetch-proforma-details-on-pk'] = 'admin_panel/Office_proforma/ajax_fetch_proforma_details_on_pk';
	$route['admin/form-edit-proforma-details'] = 'admin_panel/Office_proforma/form_edit_proforma_details';
	$route['admin/ajax_customer_order_details_table_data_order_changes'] = 'admin_panel/Office_proforma/ajax_customer_order_details_table_data_order_changes';
	$route['admin/print-office-proforma/(:num)'] = 'admin_panel/Office_proforma/print_office_proforma/$1';
	$route['admin/update-proforma-details-wrt-proforma-id'] = 'admin_panel/Office_proforma/update_proforma_details_wrt_proforma_id';

	//Delete
	$route['admin/delete-office-proforma-header-list'] = 'admin_panel/Office_proforma/delete_office_proforma_header_list';
	$route['admin/del-office-proforma-details-list'] = 'admin_panel/Office_proforma/del_office_proforma_details_list';

//Office Proforma end

//Jobber Bill start
	//List
	$route['admin/jobber-bill'] = 'admin_panel/Jobber_bill/jobber_bill';
	$route['admin/ajax-jobber-bill-table-data'] = 'admin_panel/Jobber_bill/ajax_jobber_bill_table_data';
		
	//Add
	$route['admin/add-jobber-bill'] = 'admin_panel/Jobber_bill/add_jobber_bill';
	$route['admin/ajax-jobber-bill-number'] = 'admin_panel/Jobber_bill/ajax_unique_jobber_bill_number';
	$route['admin/form-add-jobber-bill'] = 'admin_panel/Jobber_bill/form_jobber_bill_add';
	
	//Edit
	$route['admin/edit-jobber-bill/(:num)'] = 'admin_panel/Jobber_bill/edit_jobber_bill/$1';
	$route['admin/form-edit-jobber-bill'] = 'admin_panel/Jobber_bill/form_edit_jobber_bill';
	$route['admin/jobber-bill-update-article-master'] = 'admin_panel/Jobber_bill/jobber_bill_update_article_master';
	$route['admin/jobber-bill-get-customer-order-dtl'] = 'admin_panel/Jobber_bill/jobber_bill_get_customer_order_dtl';
	$route['admin/form-add-jobber-bill-details'] = 'admin_panel/Jobber_bill/add_jobber_bill_details';
	$route['admin/ajax-jobber-bill-detail-table-data'] = 'admin_panel/Jobber_bill/jobber_bill_details_table';
	$route['admin/form-jobber-bill-net_amount'] = 'admin_panel/Jobber_bill/form_jobber_bill_net_amount';
	
	//delete
	$route['admin/del-jobber-bill-details-list'] = 'admin_panel/Jobber_bill/del_jobber_bill_details_list';
	$route['admin/delete-jobber-bill-header-list1'] = 'admin_panel/Jobber_bill/del_jobber_bill_header_list1';
	
//Jobber Bill end
//Packing List/Shipment List
	//List
	$route['admin/packing-shipment-list'] = 'admin_panel/Packing_shipment/packing_shipment_list';
	$route['admin/ajax-packing-shipment-lis-table-data'] = 'admin_panel/Packing_shipment/ajax_packing_shipment_list_table_data';

	//Add
	$route['admin/add-packing-shipment'] = 'admin_panel/Packing_shipment/add_packing_shipment';
	$route['admin/form-add-packing-shipment'] = 'admin_panel/Packing_shipment/form_packing_shipment_add';
	
	//Edit
	$route['admin/edit-packing-shipment/(:num)'] = 'admin_panel/Packing_shipment/edit_packing_shipment/$1';
	$route['admin/ajax-packing-shipment-detail-table-data'] = 'admin_panel/Packing_shipment/ajax_packing_shipment_detail_table_data';
	$route['admin/ajax-packing-shipment-detail-table-data-second'] = 'admin_panel/Packing_shipment/ajax_packing_shipment_detail_table_data_second';
	$route['admin/form-edit-packing-shipment'] = 'admin_panel/Packing_shipment/form_edit_packing_shipment';
	$route['admin/form-add-packing-shipment-details'] = 'admin_panel/Packing_shipment/form_add_packing_shipment_details';
	$route['admin/form-add-details-for-same-cartoon'] = 'admin_panel/Packing_shipment/form_add_details_for_same_cartoon';
	$route['admin/packing-shipment-get-customer-order-dtl'] = 'admin_panel/Packing_shipment/packing_shipment_get_customer_order_dtl';
	$route['admin/packing-shipment-get-customer-order-dtl-wrt-cod'] = 'admin_panel/Packing_shipment/packing_shipment_get_customer_order_dtl_wrt_cod';
	$route['admin/ajax-fetch-packing-shipment-edit-data'] = 'admin_panel/Packing_shipment/ajax_fetch_packing_shipment_edit_data';
	$route['admin/form-edit-packing-shipment-details'] = 'admin_panel/Packing_shipment/form_edit_packing_shipment_details';
	$route['admin/ajax-all-packing-shipment-details'] = 'admin_panel/Packing_shipment/ajax_all_packing_shipment_details';
	$route['admin/update-packing-shipment-detail-wrt-shipment-id'] = 'admin_panel/Packing_shipment/update_packing_shipment_detail_wrt_shipment_id';
	$route['admin/delete-packing-shipment-detail-wrt-shipment-id'] = 'admin_panel/Packing_shipment/delete_packing_shipment_detail_wrt_shipment_id';
	$route['admin/get-all-carton-id-from-packing-list-table'] = 'admin_panel/Packing_shipment/get_all_carton_id_from_packing_list_table';
	$route['admin/get-all-packing-details-respect-to-carton-id'] = 'admin_panel/Packing_shipment/get_all_packing_details_respect_to_carton_id';
	
	//delete
	$route['admin/delete-packing-shipment-header-list'] = 'admin_panel/Packing_shipment/delete_packing_shipment_header_list';
	$route['admin/del-packing-shipment-details-list'] = 'admin_panel/Packing_shipment/del_packing_shipment_details_list';

	//print
	$route['admin/print-packing-shipment/(:num)'] = 'admin_panel/Packing_shipment/print_packing_shipment/$1';
	$route['admin/print-shipment-details/(:num)'] = 'admin_panel/Packing_shipment/print_shipment_details/$1';
	$route['admin/print-shipment-details-with-crtn/(:num)'] = 'admin_panel/Packing_shipment/print_shipment_details_with_crtn/$1';
	$route['admin/print-shipment-details-wo-seal/(:num)'] = 'admin_panel/Packing_shipment/print_shipment_details_wo_seal/$1';
	$route['admin/print-shipment-details-hs/(:num)'] = 'admin_panel/Packing_shipment/print_shipment_details_hs/$1';
	$route['admin/print-shipment-details-article-weight/(:num)'] = 'admin_panel/Packing_shipment/print_shipment_details_article_weight/$1';
	$route['admin/packing-shipment-consumption/(:num)'] = 'admin_panel/Packing_shipment/packing_shipment_consumption_m/$1';
	$route['admin/packing-shipment-consumption-purchase-receipt/(:num)'] = 'admin_panel/Packing_shipment/packing_shipment_consumption_purchase_receipt/$1';

//Packing List/Shipment List

//Courier Shipment
	//List
	$route['admin/courier-shipment'] = 'admin_panel/Courier_shipment/courier_shipment_list';
	$route['admin/ajax-courier-shipment-list-table-data'] = 'admin_panel/Courier_shipment/ajax_courier_shipment_list_table_data';

	//Add
	$route['admin/add-courier-shipment'] = 'admin_panel/Courier_shipment/add_courier_shipment';
	$route['admin/ajax-unique-courier-shipment-number'] = 'admin_panel/Courier_shipment/ajax_unique_courier_shipment_number';
	$route['admin/form-add-courier-shipment'] = 'admin_panel/Courier_shipment/form_courier_shipment_add';

	//Edit
	$route['admin/edit-courier-shipment/(:num)'] = 'admin_panel/Courier_shipment/edit_courier_shipment/$1';
	$route['admin/form-edit-courier-shipment'] = 'admin_panel/Courier_shipment/form_edit_courier_shipment';
	$route['admin/form-add-courier-shipment-details'] = 'admin_panel/Courier_shipment/form_add_courier_shipment_details';
	$route['admin/ajax-courier-shipment-detail-table-data'] = 'admin_panel/Courier_shipment/ajax_courier_shipment_detail_table_data';
	$route['admin/ajax-fetch-courier-shipment-edit-data'] = 'admin_panel/Courier_shipment/ajax_fetch_courier_shipment_edit_data';
	$route['admin/form-edit-courier-shipment-details'] = 'admin_panel/Courier_shipment/form_edit_courier_shipment_details';
	
	//delete
	$route['admin/delete-courier-shipment-header-list'] = 'admin_panel/Courier_shipment/delete_courier_shipment_header_list';
	$route['admin/del-courier-shipment-details-list'] = 'admin_panel/Courier_shipment/del_courier_shipment_details_list';
	
//Courier Shipment end

//Stock In Start

//List
$route['admin/stock-in'] = 'admin_panel/Stock_in/stock_in';
$route['admin/ajax-stock-in-table-data'] = 'admin_panel/Stock_in/ajax_receive_purchase_order_table_data';

// add 
$route['admin/add-stock-in'] = 'admin_panel/Stock_in/add_receive_purchase_order';
//$route['admin/ajax-unique-supp-purchase-order-number'] = 'admin_panel/Supp_purchase_order/ajax_unique_supp_purchase_order_no';
$route['admin/form_add_stock_in'] = 'admin_panel/Stock_in/form_add_receive_purchase_order';

// edit 
$route['admin/edit-stock-in/(:num)'] = 'admin_panel/Stock_in/edit_receive_purchase_order/$1';
$route['admin/form-edit-stock-in'] = 'admin_panel/Stock_in/form_edit_receive_purchase_order';
$route['admin/ajax-stock-in-details-table-data'] = 'admin_panel/Stock_in/ajax_receive_purchase_order_details_table_data';

$route['admin/ajax-fetch-stock-in-details-on-pk'] = 'admin_panel/Stock_in/ajax_fetch_receive_purchase_order_details_on_pk';
$route['admin/form-add-stock-in-details'] = 'admin_panel/Stock_in/form_add_receive_purchase_order_details';
$route['admin/all-items-on-purchase-order-stock'] = 'admin_panel/Stock_in/all_items_on_purchase_order';
$route['admin/all-items-on-supp-purchase-order-stock'] = 'admin_panel/Stock_in/all_items_on_supp_purchase_order';
$route['admin/ajax-get-remaining-item-quantity-stock'] = 'admin_panel/Stock_in/ajax_get_remaining_item_quantity';

$route['admin/form-edit-stock-in-details'] = 'admin_panel/Stock_in/form_edit_receive_purchase_order_details';
$route['admin/form-edit-delivery-sgst-cgst-value-stock'] = 'admin_panel/Stock_in/form_edit_delivery_sgst_cgst_value';

// delete
$route['admin/delete-stock-in-details'] = 'admin_panel/Stock_in/delete_receive_purchase_order_details';
$route['admin/del-stock-in-details-list'] = 'admin_panel/Stock_in/delete_receive_purchase_order_details_list';

//Stock In End

// Material Issue Start
//List
$route['admin/material-issue-list'] = 'admin_panel/Material_issue/material_issue_list';
$route['admin/ajax-material-issue-table-data'] = 'admin_panel/Material_issue/ajax_material_issue_table_data';

//Add
$route['admin/material-issue-add'] = 'admin_panel/Material_issue/material_issue_add';
$route['admin/ajax-unique-material-issue-number'] = 'admin_panel/Material_issue/ajax_unique_material_issue_number';
$route['admin/form-add-material-issue'] = 'admin_panel/Material_issue/form_add_material_issue';

// edit 
$route['admin/material-issue-edit/(:num)'] = 'admin_panel/Material_issue/material_issue_edit/$1';
$route['admin/form-edit-material-issue'] = 'admin_panel/Material_issue/form_edit_material_issue';
$route['admin/all-items-on-purchase-order-receive-detail'] = 'admin_panel/Material_issue/all_items_on_purchase_order_receive_detail';
$route['admin/fetch-remainng-stock-for-material-issue'] = 'admin_panel/Material_issue/fetch_remainng_stock_for_material_issue';
$route['admin/ajax-get-consume-list-purchase-order-receive-detail'] = 'admin_panel/Material_issue/ajax_get_consume_list_purchase_order_receive_detail';
$route['admin/form-add-material-issue-details'] = 'admin_panel/Material_issue/form_add_material_issue_details';
$route['admin/ajax-material-issue-details-table-data'] = 'admin_panel/Material_issue/ajax_material_issue_details_table_data';
$route['admin/ajax-fetch-material-issue-details-on-pk'] = 'admin_panel/Material_issue/ajax_fetch_material_issue_details_on_pk';
$route['admin/form-edit-material-issue-details'] = 'admin_panel/Material_issue/form_edit_material_issue_details';

//Delete
$route['admin/del-material-issue-details-list'] = 'admin_panel/Material_issue/delete_material_issue_details_list';
// Material Issue End

//Office Invoice Start
//List
$route['admin/office-invoice-list'] = 'admin_panel/Office_invoice/office_invoice_list';
$route['admin/ajax-office-invoice-table-data'] = 'admin_panel/Office_invoice/ajax_office_invoice_table_data';

$route['admin/invoice-declaration'] = 'admin_panel/Office_invoice/invoice_declaration';

//Add
$route['admin/office-invoice-add'] = 'admin_panel/Office_invoice/office_invoice_add';
$route['admin/ajax-unique-office-invoice-number'] = 'admin_panel/Office_invoice/ajax_unique_office_invoice_number';
$route['admin/ajax-all-account-declaration'] = 'admin_panel/Office_invoice/ajax_all_account_declaration';
$route['admin/ajax-all-packing-details'] = 'admin_panel/Office_invoice/ajax_all_packing_details';
$route['admin/form-add-office-invoice'] = 'admin_panel/Office_invoice/form_add_office_invoice';

// edit 
$route['admin/office-invoice-edit/(:num)'] = 'admin_panel/Office_invoice/office_invoice_edit/$1';
$route['admin/ajax-office-invoice-details-table-data'] = 'admin_panel/Office_invoice/ajax_office_invoice_details_table_data';
$route['admin/ajax-office-invoice-details-packing-table-data'] = 'admin_panel/Office_invoice/ajax_office_invoice_details_packing_table_data';
$route['admin/ajax-fetch-office-invoice-details-on-pk'] = 'admin_panel/Office_invoice/ajax_fetch_office_invoice_details_on_pk';
$route['admin/form-edit-office-invoice-details'] = 'admin_panel/Office_invoice/form_edit_office_invoice_details';
$route['admin/form-edit-office-invoice'] = 'admin_panel/Office_invoice/form_edit_office_invoice';
$route['admin/ajax-get-shipment-list-details-on-packing-id'] = 'admin_panel/Office_invoice/ajax_get_shipment_list_details_on_packing_id';
$route['admin/update-invoice-details-wrt-invoice-id'] = 'admin_panel/Office_invoice/update_invoice_details_wrt_invoice_id';
$route['admin/get-rows-number-new-added-packing'] = 'admin_panel/Office_invoice/get_rows_number_new_added_packing';

$route['admin/office-invoice-jsonfile/(:num)'] = 'admin_panel/Office_invoice/office_invoice_jsonfile/$1';
$route['admin/form-download-office-jsonfle'] = 'admin_panel/Office_invoice/form_download_office_jsonfle';

//Delete
$route['admin/delete-office-invoice-header'] = 'admin_panel/Office_invoice/delete_office_invoice_header';
$route['admin/del-office-invoice-details-list'] = 'admin_panel/Office_invoice/delete_office_invoice_details_list';
$route['admin/add-invoice-details-wrt-packing-id'] = 'admin_panel/Office_invoice/add_invoice_details_wrt_packing_id';


//Print
$route['admin/office-invoice-print/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print/$1';
$route['admin/office-invoice-print-groupwise/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print_groupwise/$1';
$route['admin/office-invoice-print-wo-info/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print_wo_info/$1';
$route['admin/office-invoice-print-wo-seal/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print_wo_seal/$1';
$route['admin/office-invoice-print-wo-info-seal/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print_wo_info_seal/$1';
$route['admin/office-invoice-print-hsncodewise/(:num)'] = 'admin_panel/Office_invoice/office_invoice_print_hsncodewise/$1';
$route['admin/packing-list-changes-details/(:num)'] = 'admin_panel/Office_invoice/packing_list_changes_details/$1';

$route['admin/ajax-get-latest-currency-values'] = 'admin_panel/Office_invoice/ajax_get_latest_currency_values';

//Office Invoice End

//Platting Issue start
//List
$route['admin/platting-issue-list'] = 'admin_panel/Platting_issue/platting_issue_list';
$route['admin/ajax-platting-issue-table-data'] = 'admin_panel/Platting_issue/ajax_platting_issue_table_data';

//Add
$route['admin/platting-issue-add'] = 'admin_panel/Platting_issue/platting_issue_add';
$route['admin/ajax-unique-platting-issue-number'] = 'admin_panel/Platting_issue/ajax_unique_platting_issue_number';
$route['admin/form-add-platting-issue'] = 'admin_panel/Platting_issue/form_add_platting_issue';

// edit 
$route['admin/platting-issue-edit/(:num)'] = 'admin_panel/Platting_issue/platting_issue_edit/$1';
$route['admin/form-edit-platting-issue'] = 'admin_panel/Platting_issue/form_edit_platting_issue';
$route['admin/form-add-platting-issue-details'] = 'admin_panel/Platting_issue/form_add_platting_issue_details';
$route['admin/all-items-on-item-master-platting-issue'] = 'admin_panel/Platting_issue/all_items_on_item_master_platting_issue';
$route['admin/all-item-colour-platting-issue'] = 'admin_panel/Platting_issue/all_item_colour_platting_issue';
$route['admin/ajax-platting-issue-details-table-data'] = 'admin_panel/Platting_issue/ajax_platting_issue_details_table_data';
$route['admin/ajax-fetch-platting-issue-details-on-pk'] = 'admin_panel/Platting_issue/ajax_fetch_platting_issue_details_on_pk';
$route['admin/form-edit-platting-issue-details'] = 'admin_panel/Platting_issue/form_edit_platting_issue_details';
$route['admin/platting-issue-rate-on-new-item'] = 'admin_panel/Platting_issue/platting_issue_rate_on_new_item';
$route['admin/platting-issue-rate-on-new-item-another'] = 'admin_panel/Platting_issue/platting_issue_rate_on_new_item_another';

//Delete
$route['admin/delete-platting-issue-header'] = 'admin_panel/Platting_issue/delete_office_invoice_header';
$route['admin/del-platting-issue-details-list'] = 'admin_panel/Platting_issue/delete_material_issue_details_list';

//Platting Issue end


//REPORT SECTION

// list
$route['admin/report-item'] = 'admin_panel/Report/report_item';
$route['admin/ajax-item-detail-table-data'] = 'admin_panel/Report/ajax_item_detail_table_data';

// ORDER STATUS STARTS
$route['admin/report-order-status'] = 'admin_panel/Report/report_order_status';
$route['admin/material-issue-status'] = 'admin_panel/Report/material_issue_status';
$route['admin/report-shipment-status'] = 'admin_panel/Report/report_shipment_status';
$route['admin/report-order-status-details'] = 'admin_panel/Report/report_order_status_details';
$route['admin/report-shipment-buyerwise-status'] = 'admin_panel/Report/report_shipment_buyerwise_status';
$route['admin/report-buyerwise-shipment-details'] = 'admin_panel/Report/report_buyerwise_shipment_details';
$route['admin/report-material-status-details'] = 'admin_panel/Report/report_material_status_details';
$route['admin/report-shipment-details'] = 'admin_panel/Report/report_shipment_details';
$route['admin/report-article-costing-details'] = 'admin_panel/Report/report_article_costing_details';
$route['admin/get-fetch-all-item-for-costings-article'] = 'admin_panel/Report/get_fetch_all_item_for_costings_article';
$route['admin/get-fetch-all-item-for-costings-article-all-details'] = 'admin_panel/Report/get_fetch_all_item_for_costings_article_all_details';
$route['admin/report-order-status-details-buyer'] = 'admin_panel/Report/report_order_status_details_buyer';
$route['ajax-fetch-article-on-group'] = 'admin_panel/Report/ajax_fetch_article_on_group';
// ORDER STATUS ENDS

// JOBBER LEDGER STARTS
$route['admin/jobber-ledger'] = 'admin_panel/Report/jobber_ledger';
//LEATHER STATUS STARTS
$route['admin/report-leather-status'] = 'admin_panel/Report/report_leather_status';
//ITEM STATUS STARTS
$route['admin/report-item-status'] = 'admin_panel/Report/report_item_status';
//CHECKING SUMMARY STATUS
$route['admin/checking-summary-status'] = 'admin_panel/Report/checking_summary_status';
//ARTCLE MASTER REPORT
$route['admin/article-master-report'] = 'admin_panel/Report/article_master_report';
//CHECKING ENTRY SHEET
$route['admin/checking-entry-sheet'] = 'admin_panel/Report/checking_entry_sheet';
//STOCK SUMMARY STATUS
$route['admin/stock-summary-details'] = 'admin_panel/Report/stock_summary_status';
$route['items-on-item-group'] = 'admin_panel/Report/fetch_items_on_item_group';
$route['articles-on-article-group'] = 'admin_panel/Report/fetch_articles_on_article_group';

//STOCK DETAIL LEDGER
$route['admin/stock-detail-ledger'] = 'admin_panel/Report/stock_detail_ledger';

//SUPPLIER WISE ITEM POSITION
$route['admin/supplier-wise-item-position'] = 'admin_panel/Report/supplier_wise_item_position';

//SUPPLIER PURCHASE LEDGER
$route['admin/supplier-purchase-ledger'] = 'admin_panel/Report/supplier_purchase_ledger';

//SUPPLIER WISE PURCHASE POSITION
$route['admin/supplier-wise-purchase-position'] = 'admin_panel/Report/supplier_wise_purchase_position';

//GROUP STOCK SUMMARY
$route['admin/group-stock-summary'] = 'admin_panel/Report/group_stock_summary';

//JOBBER BILL SUMMARY
$route['admin/jobber-bill-summary'] = 'admin_panel/Report/jobber_bill_summary';
$route['admin/purchase-order-audit-report'] = 'admin_panel/Report/purchase_order_audit_report';
$route['admin/purchase_order_audit_report_details_values'] = 'admin_panel/Report/purchase_order_audit_report_details_values';

//CUTTER BILL SUMMARY
$route['admin/cutter-bill-summary'] = 'admin_panel/Report/cutter_bill_summary';

//CUTTER BILL SUMMARY
$route['admin/monthly-production-status'] = 'admin_panel/Report/monthly_production_status';

//PRODUCTION REGISTER
$route['admin/production-register'] = 'admin_panel/Report/production_register';

//OUTSTANDING REPORT
$route['admin/outstanding-report'] = 'admin_panel/Report/outstanding_report';
$route['admin/get-fetch-all-item-for-supplier-basis'] = 'admin_panel/Report/get_fetch_all_item_for_supplier_basis';
$route['admin/get-fetch-all-order-for-supplier-basis'] = 'admin_panel/Report/get_fetch_all_order_for_supplier_basis';

//PAYROLL REPORTS
$route['admin/payroll-reports'] = 'admin_panel/Report/payroll_reports';

//OVERTIME REPORTS
$route['admin/checking-overtime-reports'] = 'admin_panel/Report/overtime_reports_m';

//INVOICE
$route['admin/invoice-hsn-summary'] = 'admin_panel/Report/invoice_hsn_summary';

//********************
// Payroll starts
//********************

$route['admin/payroll-advance-list'] = 'admin_panel/Payroll/advance_list';
$route['admin/payroll-advance-list/(:any)'] = 'admin_panel/Payroll/advance_list';
$route['admin/payroll-advance-list/(:any)/(:any)'] = 'admin_panel/Payroll/advance_list';

$route['admin/payroll-emp-salary-list'] = 'admin_panel/Payroll/emp_salary_list';
$route['admin/payroll-emp-salary-list/delete/(:num)'] = 'admin_panel/Payroll/emp_salary_list';

$route['admin/payroll-emp-salary-add'] = 'admin_panel/Payroll/emp_salary_add';
$route['admin/payroll-emp-salary-edit/(:num)'] = 'admin_panel/Payroll/emp_salary_edit';
$route['admin/payroll-emp-salary-print/(:num)'] = 'admin_panel/Payroll/emp_salary_print';

$route['payroll-emp-search-on-id'] = 'admin_panel/Payroll/emp_search_on_id'; #ajax
$route['payroll-emp-leave-on-id'] = 'admin_panel/Payroll/emp_leave_on_id'; #ajax
$route['payroll-emp-advance-on-id'] = 'admin_panel/Payroll/emp_advance_on_id'; #ajax
$route['payroll-emp-advance-paid-on-id'] = 'admin_panel/Payroll/emp_advance_paid_on_id'; #ajax
$route['payroll-emp-leave-from-holiday-list'] = 'admin_panel/Payroll/payroll_emp_leave_from_holiday_list'; #ajax
$route['admin/payroll-emp-pay-slip'] = 'admin_panel/Payroll/multiple_emp_pay_slip';
$route['emp-on-dept-id'] = 'admin_panel/Payroll/emp_on_dept_id'; #ajax


$route['admin/excel_import_leather_quantity'] = 'admin_panel/Settings/excel_import_leather_quantity';
$route['admin/change-entry-user'] = 'admin_panel/Settings/change_entry_user';
$route['ajax-fetch-all-added-items'] = 'admin_panel/Settings/ajax_fetch_all_added_items';
$route['admin/change-all-user-details'] = 'admin_panel/Settings/change_all_user_details';

$route['emp-on-dept-id-new-multiple'] = 'admin_panel/Payroll/emp_on_dept_id_new_multiple'; #ajax
$route['emp-on-dept-id-new-multiples'] = 'admin_panel/Payroll/emp_on_dept_id_new_multiples';
$route['if-salary-slip-made-or-not'] = 'admin_panel/Payroll/if_salary_slip_made_or_not'; #ajax

$route['ajax_fetch_customer_order_details_total_value'] = 'admin_panel/Customer_order/ajax_fetch_customer_order_details_total_value'; #ajax
