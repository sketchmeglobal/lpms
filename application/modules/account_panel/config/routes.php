<?php

$route['accounts/dashboard'] = 'account_panel/Dashboard/dashboard';
$route['404'] = 'account_panel/Dashboard/error_404';
$route['js_disabled'] = 'account_panel/Dashboard/js_disabled';

$route['accounts/profile'] = 'account_panel/Profile/profile';
$route['accounts/form_basic_info'] = 'account_panel/Profile/form_basic_info';
$route['accounts/form_change_pass'] = 'account_panel/Profile/form_change_pass';
$route['accounts/form_change_email'] = 'account_panel/Profile/form_change_email';
$route['accounts/change_email/(:any)'] = 'account_panel/Profile/change_email/$1';
$route['accounts/ajax_username_check'] = 'account_panel/Profile/ajax_username_check';
$route['accounts/form_change_username'] = 'account_panel/Profile/form_change_username';

$route['accounts/employees'] = 'account_panel/Master/employees';
$route['accounts/holiday-list'] = 'account_panel/Master/holiday_list_m';
$route['accounts/overtime'] = 'account_panel/Master/overtime_m';
$route['accounts/overtime-add'] = 'account_panel/Master/overtime_add_m';
$route['accounts/get-all-emp-id-for-overtime'] = 'account_panel/Master/get_all_emp_id_for_overtime_m';
$route['accounts/form-add-overtime'] = 'account_panel/Master/form_add_overtime';
$route['accounts/ajax-overtime-table-data'] = 'account_panel/Master/ajax_overtime_table_data_m';
$route['accounts/del-overtime-list'] = 'account_panel/Master/del_overtime_list_m';
$route['accounts/departments'] = 'account_panel/Master/departments';
$route['accounts/departments/(:any)'] = 'account_panel/Master/departments';
$route['accounts/departments/(:any)/(:any)'] = 'account_panel/Master/departments';

//PAYROLL REPORTS
$route['accounts/payroll-reports'] = 'account_panel/Report/payroll_reports';

//OVERTIME REPORTS
$route['accounts/checking-overtime-reports'] = 'account_panel/Report/overtime_reports_m';

//********************
// Payroll starts
//********************

$route['accounts/payroll-advance-list'] = 'account_panel/Payroll/advance_list';
$route['accounts/payroll-advance-list/(:any)'] = 'account_panel/Payroll/advance_list';
$route['accounts/payroll-advance-list/(:any)/(:any)'] = 'account_panel/Payroll/advance_list';

$route['accounts/payroll-emp-salary-list'] = 'account_panel/Payroll/emp_salary_list';
$route['accounts/payroll-emp-salary-list/delete/(:num)'] = 'account_panel/Payroll/emp_salary_list';

$route['accounts/payroll-emp-salary-add'] = 'account_panel/Payroll/emp_salary_add';
$route['accounts/payroll-emp-salary-edit/(:num)'] = 'account_panel/Payroll/emp_salary_edit';
$route['accounts/payroll-emp-salary-print/(:num)'] = 'account_panel/Payroll/emp_salary_print';

$route['accounts/payroll-emp-search-on-id'] = 'account_panel/Payroll/emp_search_on_id'; #ajax
$route['accounts/payroll-emp-leave-on-id'] = 'account_panel/Payroll/emp_leave_on_id'; #ajax
$route['accounts/payroll-emp-advance-on-id'] = 'account_panel/Payroll/emp_advance_on_id'; #ajax
$route['accounts/payroll-emp-advance-paid-on-id'] = 'account_panel/Payroll/emp_advance_paid_on_id'; #ajax
$route['accounts/payroll-emp-leave-from-holiday-list'] = 'account_panel/Payroll/payroll_emp_leave_from_holiday_list'; #ajax
$route['accounts/payroll-emp-pay-slip'] = 'account_panel/Payroll/multiple_emp_pay_slip';
$route['accounts/emp-on-dept-id'] = 'account_panel/Payroll/emp_on_dept_id'; #ajax
$route['accounts/emp-on-dept-id-new-multiple'] = 'account_panel/Payroll/emp_on_dept_id_new_multiple'; #ajax
$route['accounts/if-salary-slip-made-or-not'] = 'account_panel/Payroll/if_salary_slip_made_or_not'; #ajax
