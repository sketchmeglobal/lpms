<?php

$route['salary_portal/dashboard'] = 'jobber_portal/Dashboard/dashboard';
$route['404'] = 'jobber_portal/Dashboard/error_404';
$route['js_disabled'] = 'jobber_portal/Dashboard/js_disabled';

$route['salary_portal/profile'] = 'jobber_portal/Profile/profile';
$route['salary_portal/form_basic_info'] = 'jobber_portal/Profile/form_basic_info';
$route['salary_portal/form_change_pass'] = 'jobber_portal/Profile/form_change_pass';
$route['salary_portal/form_change_email'] = 'jobber_portal/Profile/form_change_email';
$route['salary_portal/change_email/(:any)'] = 'jobber_portal/Profile/change_email/$1';
$route['salary_portal/ajax_username_check'] = 'jobber_portal/Profile/ajax_username_check';
$route['salary_portal/form_change_username'] = 'jobber_portal/Profile/form_change_username';

$route['salary_portal/employees'] = 'jobber_portal/Master/employees';
$route['salary_portal/holiday-list'] = 'jobber_portal/Master/holiday_list_m';
$route['salary_portal/overtime'] = 'jobber_portal/Master/overtime_m';
$route['salary_portal/overtime-add'] = 'jobber_portal/Master/overtime_add_m';
$route['salary_portal/get-all-emp-id-for-overtime'] = 'jobber_portal/Master/get_all_emp_id_for_overtime_m';
$route['salary_portal/form-add-overtime'] = 'jobber_portal/Master/form_add_overtime';
$route['salary_portal/ajax-overtime-table-data'] = 'jobber_portal/Master/ajax_overtime_table_data_m';
$route['salary_portal/del-overtime-list'] = 'jobber_portal/Master/del_overtime_list_m';
$route['salary_portal/account_groups'] = 'jobber_portal/Master/account_groups';
$route['salary_portal/contractor_master'] = 'jobber_portal/Master/contractor_master';
$route['salary_portal/departments'] = 'jobber_portal/Master/departments';
$route['salary_portal/departments/(:any)'] = 'jobber_portal/Master/departments';
$route['salary_portal/departments/(:any)/(:any)'] = 'jobber_portal/Master/departments';

//PAYROLL REPORTS
$route['salary_portal/payroll-reports'] = 'jobber_portal/Report/payroll_reports';

//OVERTIME REPORTS
$route['salary_portal/checking-overtime-reports'] = 'jobber_portal/Report/overtime_reports_m';

//********************
// Payroll starts
//********************

$route['salary_portal/payroll-advance-list'] = 'jobber_portal/Payroll/advance_list';
$route['salary_portal/payroll-advance-list/(:any)'] = 'jobber_portal/Payroll/advance_list';
$route['salary_portal/payroll-advance-list/(:any)/(:any)'] = 'jobber_portal/Payroll/advance_list';

$route['salary_portal/payroll-emp-salary-list'] = 'jobber_portal/Payroll/emp_salary_list';
$route['salary_portal/payroll-emp-salary-list/delete/(:num)'] = 'jobber_portal/Payroll/emp_salary_list';

$route['salary_portal/payroll-emp-salary-add'] = 'jobber_portal/Payroll/emp_salary_add';
$route['salary_portal/payroll-emp-salary-edit/(:num)'] = 'jobber_portal/Payroll/emp_salary_edit';
$route['salary_portal/payroll-emp-salary-print/(:num)'] = 'jobber_portal/Payroll/emp_salary_print';

$route['salary_portal/payroll-emp-search-on-id'] = 'jobber_portal/Payroll/emp_search_on_id'; #ajax
$route['salary_portal/payroll-emp-leave-on-id'] = 'jobber_portal/Payroll/emp_leave_on_id'; #ajax
$route['salary_portal/payroll-emp-advance-on-id'] = 'jobber_portal/Payroll/emp_advance_on_id'; #ajax
$route['salary_portal/payroll-emp-advance-paid-on-id'] = 'jobber_portal/Payroll/emp_advance_paid_on_id'; #ajax
$route['salary_portal/payroll-emp-leave-from-holiday-list'] = 'jobber_portal/Payroll/payroll_emp_leave_from_holiday_list'; #ajax
$route['salary_portal/payroll-emp-pay-slip'] = 'jobber_portal/Payroll/multiple_emp_pay_slip';
$route['salary_portal/emp-on-dept-id'] = 'jobber_portal/Payroll/emp_on_dept_id'; #ajax
$route['salary_portal/emp-on-dept-id-new-multiple'] = 'jobber_portal/Payroll/emp_on_dept_id_new_multiple'; #ajax
$route['salary_portal/emp-on-contractor-id-new-multiple'] = 'jobber_portal/Payroll/emp_on_contractor_id_new_multiple'; #ajax
$route['salary_portal/if-salary-slip-made-or-not'] = 'jobber_portal/Payroll/if_salary_slip_made_or_not'; #ajax
