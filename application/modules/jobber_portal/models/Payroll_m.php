<?php
/**
 * Coded by: Pran Krishna Das
 * Social: https://sketchmeglobal.com
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last uploaded on 01-01-2021 at 09:55pm
 */

class Payroll_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
    }
    public function advance_list_m() {
        $user_id = $this->session->userdata['accnt']['user_id'];
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('jobber_portal/Payroll/advance_list'));
            $crud->set_theme('datatables');
            $crud->set_subject('Advance');
            $crud->set_table('advance_salary_department');
            $crud->unset_read();
            $crud->unset_clone();
            
            $this->table_name = 'advance_salary_department';
            $this->pk_field_name = 'advance_id';

            $crud->set_relation('emp_id', 'employees_salary_department', 'name', array('status' => 1));

            $crud->columns('advance_name','emp_id','date', 'amount', 'monthly_advance_adjustment');
            $crud->fields('advance_name','emp_id','date', 'amount', 'monthly_advance_adjustment', 'user_id');
            $crud->required_fields('advance_name','emp_id','date', 'amount', 'monthly_advance_adjustment');
            $crud->unique_fields(array('advance_name'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('advance_name', 'Advance No.');
            $crud->display_as('emp_id', 'Employee Name');
            $crud->display_as('date', 'Advance Date');
            $crud->display_as('amount', 'Advance Amount');
            $crud->display_as('monthly_advance_adjustment', 'Monthly Advance Adjustment');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Advance';
            $output->section_heading = 'Advance <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Advance';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function emp_salary_list_m() {
        $user_id = $this->session->userdata['accnt']['user_id'];
        try{
        $crud = new grocery_CRUD();
        // $crud->set_theme('flexigrid');
        $crud = new grocery_CRUD();
        $crud->set_crud_url_path(base_url('jobber_portal/Payroll/emp_salary_list'));
        $crud->set_theme('datatables');
        $crud->set_subject('Salary');
        $crud->set_table('salary_for_salary_department');
        $crud->unset_read();
        $crud->unset_add();
        $crud->unset_clone();
        $crud->unset_edit();

        $this->table_name = 'salary_for_salary_department';
        $this->pk_field_name = 'CODE';
        
        $crud->unset_fields('CREATED_DATE');
        $crud->columns('MON','c_id','EMPCODE', 'NET');
        
        // $crud->columns('DATE', 'PARTY_SEQ', 'INVOICE_NO', 'AWB_NO', 'TOTAL_QNTY', 'TOTAL_VALUE', 'TOTAL_FOR_VAL');
        $crud->display_as('c_id', 'CONTRACTOR');
        // $crud->display_as('EMPCODE', 'Employee Name');
        // $crud->display_as('DT', 'Voucher Date');
        // $crud->display_as('AMT', 'Voucher Amount');
        
        // $crud->callback_before_delete(array($this,'cascade_delete_courier'));
        $crud->set_relation('EMPCODE', 'employees_salary_department', '{e_code} - {name}');
        $crud->set_relation('c_id', 'contractor_master', 'name');
        $crud->order_by('CODE','desc');

        $crud->add_action('Edit', '', '','ui-icon-pencil',array($this,'set_edit_path'));

        $output = $crud->render();
        //rending extra value to $output
        $output->tab_title = 'Employee Salary';
        $output->section_heading = 'Employee Salary <small>(Add / Edit / Delete)</small>';
        $output->menu_name = 'Employee Salary';

        return array('page'=>'payroll/salary_list', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    function set_edit_path($primary_key , $row){
        return base_url('salary_portal/payroll-emp-salary-edit').'/'.$row->CODE;
    }

    function set_print_path($primary_key , $row){
        return base_url('salary_portal/payroll-emp-salary-print').'/'.$row->CODE;
    }

    public function emp_salary_add_m() {
        $data = [];
        $data[] = '';
        $data['selected_month'] = date('F', mktime(0, 0, 0, date('m'), 1)) .'~'. cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'))  .'~'. date('n');    
        $data['selected_dept'] = '';
        
        if($this->input->post()){
            $salary_det = array(
                'MON' =>  $this->input->post('month'),
                'EMPCODE' => $this->input->post('emp_id'),
                'BASIC' => NULL,
                
                'no_of_part' => $this->input->post('no_of_part'),
                'rate_per_part' => $this->input->post('rate_per_part'),
                'pay_for_holiday' => $this->input->post('pay_for_holiday'),
                'pay_for_leave' => $this->input->post('pay_for_leave'),
                
                'HRAPER' => $this->input->post('hraper'),
                'HRAAMT' => $this->input->post('hraamnt'),
                'PFPER' => $this->input->post('pfper'),
                'PFAMT' => $this->input->post('pfamnt'),
                'ESIPER' => $this->input->post('esiper'),
                'ESIAMT' => $this->input->post('esiamnt'),
                'TAX' => $this->input->post('ptax'),
                'INS' => $this->input->post('insur'),
                'LOAN' => $this->input->post('loan_adj'),
                
                'T1' => $this->input->post('wd'),
                'T2' => $this->input->post('adw'),
                'T3' => $this->input->post('hol'),
                'T4' => $this->input->post('cl'),
                'T5' => $this->input->post('el'),
                'T6' => $this->input->post('esil'),
                'T7' => $this->input->post('abs'),
                'T8' => $this->input->post('td'),
                
                'GROSS' => $this->input->post('gross'),
                'DEDUC' => $this->input->post('ded'),
                'NET' => $this->input->post('net'),
                'USER_ID' => $this->session->userdata['accnt']['user_id'],
                'entry_year' => YEAR_START
            );
            $this->db->insert('salary_for_salary_department', $salary_det);
            // echo $this->db->last_query(); die();
            
            $data['selected_month'] = $this->input->post('month');
            $data['selected_dept'] = $this->input->post('group');
            $data['seleted_month'] = $this->input->post('month');
            
            $data['error'] = false;
            $data['success'] = true;
        }

        if($this->input->post('savengo')){
            redirect(base_url('salary_portal/payroll-emp-salary-list'));
        }
        
        $user_id = $this->session->userdata['accnt']['user_id'];
        $data['fetch_all_employee'] = $this->db->get_where('employees_salary_department', array('status' => 1))->result();    
            
        return array('page'=>'payroll/salary_add', 'data'=>$data);
    
    }

    public function emp_search_on_id_m(){
        $id = $this->input->post('id');
        $res = $this->db->select('*, FLOOR(hra_amount) AS hra_amount')
                    ->join('departments', 'departments.d_id = employees_salary_department.d_id', 'left')
                    ->get_where('employees_salary_department', array('employees_salary_department.e_id' => $id))->result();
        return $res;
    }

    public function emp_leave_on_id_m(){
        $id = $this->input->post('id');
        $count_resultvalue = $this->db
                    ->select('*')
                    ->get_where('salary_for_salary_department', array('EMPCODE' => $id))->result();
                    if(count($count_resultvalue) > 0) {
        $res = $this->db
                    ->select('SUM(T4) AS all_cl, SUM(T5) AS all_el, cl_granted, el_granted')
                    ->join('employees_salary_department', 'employees_salary_department.e_id = salary_for_salary_department.EMPCODE', 'left')
                    ->group_by('EMPCODE')
                    ->get_where('salary_for_salary_department', array('EMPCODE' => $id))->result();
                    } else {
        $res = $this->db
                    ->select('0 AS all_cl, 0 AS all_el, cl_granted, el_granted')
                    ->group_by('e_id')
                    ->get_where('employees_salary_department', array('e_id' => $id))->result();                
                    }
        return $res;
    }

    public function emp_advance_on_id_m(){
        $id = $this->input->post('id');
        $res = $this->db->select('*, SUM(amount) as amount_total')
                    ->get_where('advance_salary_department', array('emp_id' => $id))->result();
        return $res;
    }

    public function emp_advance_paid_on_id_m(){
        $id = $this->input->post('id');
        $res1 = $this->db->get_where('advance_salary_department', array('emp_id' => $id))->result();
        if(count($res1) > 0) {
            $res = $this->db
                ->select('SUM(LOAN) AS loan_paid')
                ->group_by('EMPCODE')
                ->get_where('salary_for_salary_department', array('EMPCODE' => $id))->result();
        }
        return $res;
    }

    public function emp_salary_edit_m(){
        $data = [];
        $user_id = $this->session->userdata['accnt']['user_id'];
        
        $data[] = '';
        $sal_id = $this->uri->segment(3);
                
        if($this->input->post()){
            $salary_det = array(
                
                'MON' =>  $this->input->post('month'),
                'EMPCODE' => $this->input->post('emp_id'),
                'BASIC' => NULL,
                
                'no_of_part' => $this->input->post('no_of_part'),
                'rate_per_part' => $this->input->post('rate_per_part'),
                'pay_for_holiday' => $this->input->post('pay_for_holiday'),
                'pay_for_leave' => $this->input->post('pay_for_leave'),
                
                'HRAPER' => $this->input->post('hraper'),
                'HRAAMT' => $this->input->post('hraamnt'),
                'PFPER' => $this->input->post('pfper'),
                'PFAMT' => $this->input->post('pfamnt'),
                'ESIPER' => $this->input->post('esiper'),
                'ESIAMT' => $this->input->post('esiamnt'),
                'TAX' => $this->input->post('ptax'),
                'INS' => $this->input->post('insur'),
                'LOAN' => $this->input->post('loan_adj'),
                
                'T1' => $this->input->post('wd'),
                'T2' => $this->input->post('adw'),
                'T3' => $this->input->post('hol'),
                'T4' => $this->input->post('cl'),
                'T5' => $this->input->post('el'),
                'T6' => $this->input->post('esil'),
                'T7' => $this->input->post('abs'),
                'T8' => $this->input->post('td'),
                
                'GROSS' => $this->input->post('gross'),
                'DEDUC' => $this->input->post('ded'),
                'NET' => $this->input->post('net'),
                'USER_ID' => $this->session->userdata['accnt']['user_id']
                
            );
            $this->db->update('salary_for_salary_department', $salary_det, array('CODE' => $sal_id));
            $data['error'] = false;
            $data['success'] = true; 
        }

        if($this->input->post('savengo')){
            redirect(base_url('salary_portal/payroll-emp-salary-list'));
        }
            
        $data['fetch_all_employee'] = $this->db->get_where('employees_salary_department', array('status' => 1))->result();    
            
        $data['fetch_all_sal_details'] = $this->db
                    ->join('employees_salary_department', 'employees_salary_department.e_id = salary_for_salary_department.EMPCODE', 'left')
                    ->get_where('salary_for_salary_department', array('salary_for_salary_department.CODE' => $sal_id))->result();
        $data['sal_id'] = $sal_id;

        return array('page'=>'payroll/salary_edit', 'data'=>$data);            
    }

    public function emp_salary_print_m(){
        $data = [];
       $data[] = '';
        $sal_id = $this->uri->segment(3);
        
        $this->load->model('Payroll_m');
            
        $data['fetch_all_employee'] = $this->db->get_where('employees_salary_department', array('status' => 1))->result();    
            
        $data['fetch_all_sal_details'] = $this->db
                    ->join('employees_salary_department', 'employees_salary_department.e_id = salary_for_salary_department.EMPCODE', 'left')
                    ->get_where('salary_for_salary_department', array('salary_for_salary_department.CODE' => $sal_id))->result();

        return array('page'=>'payroll/salary_print', 'data'=>$data);
    }
    
    public function multiple_emp_pay_slip(){
        $data = [];
        $user_id = $this->session->userdata['accnt']['user_id'];

        $this->load->model('Payroll_m');
        
        $data['departments'] = $this->db->get_where('departments', array('d_id' => 6, 'status' => 1))->result();
        
        $data['fetch_all_employee'] = $this->db->get_where('employees_salary_department', array('status' => 1))->result();    
                    
        if($this->input->post()) {
            $it_arr = $this->input->post('leather[]');
            $data['month'] = $this->input->post('month');
            $data['resultss'][] = $this->_fetch_multiple_pay_slip_detail($it_arr, $this->input->post('month'));
            $data['segment'] = 'emp_pay_slip_section';
            // echo '<pre>',print_r($data['results']),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        return array('page'=>'payroll/multiple_pay_slip', 'data'=>$data);
    }
    
    public function emp_on_dept_id(){
        
        $id = $this->input->post('gr_id');
        $user_id = $this->session->userdata['accnt']['user_id'];
            
            $query = "
                    SELECT
                        *
                    FROM
                        `employees_salary_department`
                    WHERE
                        employees_salary_department.d_id = $id";

            $res = $this->db->query($query)->result();
            
        return $res;
    }
    
    public function emp_on_dept_id_new_multiple(){
        
        if($this->input->post('gr_id') != ''){
            
            if(is_array($this->input->post('gr_id'))){
                $gid = implode(",",$this->input->post('gr_id'));
                if(strpos($gid, ",") != false){
                    $id = implode (",", $this->input->post('gr_id'));        
                    $str = "'". str_replace(",","','",$id) . "'";         
                }else{
                    $id = implode(",",$this->input->post('gr_id'));
                    $str = "'". $id . "'";         
                }    
            }else{
                $str = $this->input->post('gr_id');
                $str = "'". $str . "'"; 
            }
            
        }else{
            $str = '';
        }

        $user_id = $this->session->userdata['accnt']['user_id'];
            
            $query = "
                    SELECT
                        *
                    FROM
                        `employees_salary_department`
                    WHERE
                        employees_salary_department.emp_type IN ($str)";

            $res = $this->db->query($query)->result();
                    
        return $res;
    }
    
    public function emp_on_contractor_id_new_multiple(){
        
        if($this->input->post('gr_id') != ''){
            $gid = implode(",",$this->input->post('gr_id'));
            if(strpos($gid, ",") != false){
                $id = implode (",", $this->input->post('gr_id'));        
                $str = "'". str_replace(",","','",$id) . "'";         
            }else{
                $id = implode(",",$this->input->post('gr_id'));
                $str = "'". $id . "'";         
            }
        }else{
            $str = '';
        }

        $user_id = $this->session->userdata['accnt']['user_id'];
            
        $query = "
                SELECT
                    *
                FROM
                    `employees_salary_department`
                WHERE
                    employees_salary_department.c_id IN ($str)";

        if($str != ''){
            
            if($this->db->query($query)->num_rows() > 0){
                $res = $this->db->query($query)->result();
            }else{
                $res = '';
            }
            
        }else{
            $res = '';
        }
        
        return $res;
    }
    
    public function _fetch_multiple_pay_slip_detail($it_arr, $month) {
        $user_id = $this->session->userdata['accnt']['user_id'];
        
           $result = $this->db->select('*, employees_salary_department.name as employee_name, employees_salary_department.address as employee_adress, contractor_master.name as contractor_name, contractor_master.address as contractor_address')
           ->join('employees_salary_department', 'employees_salary_department.e_id = salary_for_salary_department.EMPCODE', 'left')
           ->join('contractor_master', 'contractor_master.am_id = employees_salary_department.c_id', 'left')
           ->join('departments', 'departments.d_id = employees_salary_department.d_id', 'left')
                     ->where_in('EMPCODE', $it_arr)
                    //  ->where('salary.USER_ID', 13)
                     ->get_where('salary_for_salary_department', array('MON' => $month))->result();

        return $result;  
            
    }
    
    public function payroll_emp_leave_from_holiday_list() {
        
        $user_id = $this->session->userdata['accnt']['user_id'];
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $new_row = str_pad(($month),2,"0",STR_PAD_LEFT);
        
        $new_month = $year."-".$new_row;
        
        $total_day = $this->db->select('*')->like('DATE(holiday_list.date)', $new_month)->get('holiday_list')->num_rows();
        
        return $total_day;  
            
    }
    
    public function if_salary_slip_made_or_not() {
        
        $user_id = $this->session->userdata['accnt']['user_id'];
        $id = $this->input->post('id');
        $month = $this->input->post('month');

        $no_row = $this->db->get_where('salary_for_salary_department', array('EMPCODE' => $id, 'MON' => $month))->num_rows();
        
        return $no_row;  
            
    }

}