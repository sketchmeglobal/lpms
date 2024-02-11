<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
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

    private function _dept_wise_module_permission($module_id,$user){

            $dept_id = $this->db->get_where('user_details', array('user_id' => $user))->result()[0]->user_dept;
            if($dept_id != NULL){
                $nr = $this->db->where('module_permission_id', $module_id)->where('FIND_IN_SET('.$dept_id.', dept_id) !=', 0)->get('module_permission')->num_rows();
                // echo $this->db->last_query(); die;
                if($nr == 0){
                    # show-all
                    return 'show';
                }else{
                    # filter according to dept id
                    return $dept_id;
                }
            }else{
                return 'show';
            }
            
        }
        
        private function _user_wise_view_permission($menu_id,$user){

         $nr = $this->db
                ->where('m_id', $menu_id)
                ->where('user_id', $user)
                ->where('view_permission', 0) #0 -> crud inactive
                ->get('user_permission')->num_rows();
        // echo $this->db->last_query(); die;
        if($nr == 0){
            return 'show';
        }else{
            return 'block';
        }
        
    }
    
    public function fetch_permission_matrix($user_id, $m_id){
        $user_id = $this->session->user_id;

        $is_initialised = $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->num_rows();

        if($is_initialised > 0){
            
            $blocked_by_admin = $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id, 'block_permission' => 1))->num_rows();

            if($blocked_by_admin > 0){
                $this->session->set_flashdata('title', 'Blocked or Not-set!');
                $this->session->set_flashdata('msg', 'Permission not set. Please contact admin for permission.');
                redirect(base_url('admin/dashboard'));
            }else{
                return $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->result();    
            }

        }else{
            
            return $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->result();

        }
    }

    public function advance_list_m() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Payroll/advance_list'));
            $crud->set_theme('datatables');
            $crud->set_subject('Advance');
            $crud->where('advance.user_id !=', 13);    
            $crud->set_table('advance');
            $crud->unset_read();
            $crud->unset_clone();
            
            $this->fetch_permission_matrix($user_id, $m_id = 42);
            $uvp = $this->_user_wise_view_permission(42, $user_id);

            $this->table_name = 'advance';
            $this->pk_field_name = 'advance_id';

            $crud->set_relation('emp_id', 'employees', 'name', array('user_id !=' => 13));

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
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function emp_salary_list_m() {
        $user_id = $this->session->user_id;
        try{
        $crud = new grocery_CRUD();
        // $crud->set_theme('flexigrid');
        $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Payroll/emp_salary_list'));
            $crud->set_theme('datatables');
            $crud->set_subject('Salary');
            if($user_id != 13) {
            $crud->where('salary.USER_ID !=', 13);    
            }
            $crud->set_table('salary');
            $crud->unset_read();
            $crud->unset_clone();
            $crud->unset_edit();
            
            $this->fetch_permission_matrix($user_id, $m_id = 43);
            $uvp = $this->_user_wise_view_permission(43, $user_id);

            $this->table_name = 'salary';
            $this->pk_field_name = 'CODE';
        
        $crud->unset_fields('CREATED_DATE');
        $crud->columns('MON','EMPCODE', 'NET', 'T4', 'T5', 'T6', 'T7', 'LOAN');
        
        // $crud->columns('DATE', 'PARTY_SEQ', 'INVOICE_NO', 'AWB_NO', 'TOTAL_QNTY', 'TOTAL_VALUE', 'TOTAL_FOR_VAL');
        // $crud->display_as('VNAME', 'Voucher No.');
        // $crud->display_as('EMPCODE', 'Employee Name');
        // $crud->display_as('DT', 'Voucher Date');
        // $crud->display_as('AMT', 'Voucher Amount');
        $crud->display_as('T4', 'Casual Leave');
        $crud->display_as('T5', 'Earn Leave');
        $crud->display_as('T6', 'ESI Leave');
        $crud->display_as('T7', 'Absent');
        $crud->display_as('LOAN', 'Advance Deduc');
        
        // $crud->callback_before_delete(array($this,'cascade_delete_courier'));
        
        $crud->set_relation('EMPCODE', 'employees', '{e_code} - {name}');
        $crud->order_by('CODE','desc');

        $crud->add_action('Edit', '', '','ui-icon-pencil',array($this,'set_edit_path'));

        $output = $crud->render();
        //rending extra value to $output
            $output->tab_title = 'Employee Salary';
            $output->section_heading = 'Employee Salary <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Employee Salary';
            $output->add_button = '';

        return array('page'=>'payroll/salary_list', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    function set_edit_path($primary_key , $row)
{
    return base_url('admin/payroll-emp-salary-edit').'/'.$row->CODE;
}

function set_print_path($primary_key , $row)
{
    return base_url('admin/payroll-emp-salary-print').'/'.$row->CODE;
}

    public function emp_salary_add_m() {
        $data[] = '';
        $salary_rowss = $this->db->get_where('salary', array('MON' =>  $this->input->post('month'), 'EMPCODE' => $this->input->post('emp_id')))->num_rows();
        if($this->input->post()){
            if($salary_rowss == 0) {

                $master_salary_data = $this->db->get_where('employees', array('e_id' => $this->input->post('emp_id')))->row();

                $salary_det = array(
                'MON' =>  $this->input->post('month'),
                'EMPCODE' => $this->input->post('emp_id'),

                'MASTER_BASIC' => $master_salary_data->basic_pay,
                'MASTER_DA' => $master_salary_data->da_amout,
                'MASTER_HRA' => $master_salary_data->hra_amount,
                'MASTER_CONV' => $master_salary_data->convenience,
                'MASTER_MED' => $master_salary_data->medical_allowance,
                'MASTER_OA' => $master_salary_data->special_allowance,

                'BASIC' => $this->input->post('abasic'),
                'DA' => $this->input->post('ada'),
                'HRA' => $this->input->post('ahra'),
                'CONV' => $this->input->post('con'),
                'MED' => $this->input->post('ma'),
                'OA' => $this->input->post('oa'),
                'OT' => $this->input->post('oh'),
                'OTAMT' => $this->input->post('oam'),
                
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
                'USER_ID' => $this->session->user_id
            );

            // echo '<pre>', print_r($salary_det), '</pre>'; die;

            $this->db->insert('salary', $salary_det);
            // echo $this->db->last_query(); die();
            $data['error'] = false;
            $data['success'] = true;
            }
        }

        if($this->input->post('savengo')){
            redirect(base_url('admin/payroll-emp-salary-list'));
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $data['fetch_all_employee'] = $this->db->get('employees')->result();
        
        } else {
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id !=' => 13))->result();    
            
        }
        return array('page'=>'payroll/salary_add', 'data'=>$data);
    
    }

    public function emp_search_on_id_m(){
        $id = $this->input->post('id');
        $res = $this->db->select('*, FLOOR(hra_amount) AS hra_amount')
                    ->join('departments', 'departments.d_id = employees.d_id', 'left')
                    ->get_where('employees', array('employees.e_id' => $id))->result();
        return $res;
    }

    public function emp_leave_on_id_m(){
        $id = $this->input->post('id');
        $count_resultvalue = $this->db
                    ->select('*')
                    ->get_where('salary', array('EMPCODE' => $id))->result();
                    if(count($count_resultvalue) > 0) {
        $res = $this->db
                    ->select('SUM(T4) AS all_cl, SUM(T5) AS all_el, cl_granted, el_granted')
                    ->join('employees', 'employees.e_id = salary.EMPCODE', 'left')
                    ->group_by('EMPCODE')
                    ->get_where('salary', array('EMPCODE' => $id))->result();
                    } else {
        $res = $this->db
                    ->select('0 AS all_cl, 0 AS all_el, cl_granted, el_granted')
                    ->group_by('e_id')
                    ->get_where('employees', array('e_id' => $id))->result();                
                    }
        return $res;
    }

    public function emp_advance_on_id_m(){
        $id = $this->input->post('id');
        // $res = $this->db->select('*, SUM(amount) as amount_total')
        //             ->get_where('advance', array('emp_id' => $id))->result();
        $query = "SELECT *, (SELECT SUM(amount) FROM `advance` WHERE `emp_id` = $id ORDER BY `advance_id` DESC) as amount_total 
        FROM `advance` WHERE emp_id = $id
        ORDER BY advance_id DESC";
        $res = $this->db->query($query)->result();
        return $res;
    }

    public function emp_advance_paid_on_id_m(){
        $id = $this->input->post('id');
        $res = $this->db
                    ->select('SUM(LOAN) AS loan_paid')
                    ->group_by('EMPCODE')
                    ->get_where('salary', array('EMPCODE' => $id))->result();
        return $res;
    }

    public function emp_salary_edit_m(){
        
        $user_id = $this->session->user_id;
        
        $data[] = '';
        $sal_id = $this->uri->segment(3);
                
        if($this->input->post()){
            $salary_det = array(
                'MON' =>  $this->input->post('month'),
                'EMPCODE' => $this->input->post('emp_id'),
                'BASIC' => $this->input->post('abasic'),
                'DA' => $this->input->post('ada'),
                'HRA' => $this->input->post('ahra'),
                'CONV' => $this->input->post('con'),
                'MED' => $this->input->post('ma'),
                'OA' => $this->input->post('oa'),
                'OT' => $this->input->post('oh'),
                'OTAMT' => $this->input->post('oam'),
                
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
                'USER_ID' => $this->session->user_id
            );
            $this->db->update('salary', $salary_det, array('CODE' => $sal_id));
            $data['error'] = false;
            $data['success'] = true; 
        }

        if($this->input->post('savengo')){
            redirect(base_url('admin/payroll-emp-salary-list'));
        }
        
        if($user_id == 13) {
        
        $data['fetch_all_employee'] = $this->db->get('employees')->result();
        
        } else {
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id !=' => 13))->result();    
            
        }
        $data['fetch_all_sal_details'] = $this->db
                    ->join('employees', 'employees.e_id = salary.EMPCODE', 'left')
                    ->get_where('salary', array('salary.CODE' => $sal_id))->result();
        $data['sal_id'] = $sal_id;

        return array('page'=>'payroll/salary_edit', 'data'=>$data);            
    }

    public function emp_salary_print_m(){

        $user_id = $this->session->user_id;
        $data[] = '';
        $sal_id = $this->uri->segment(3);
        
        $this->load->model('Payroll_m');
        
        if($user_id == 13) {
        
        $data['fetch_all_employee'] = $this->db->get('employees')->result();
        
        } else {
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id !=' => 13))->result();    
            
        }
        $data['fetch_all_sal_details'] = $this->db
                    ->join('employees', 'employees.e_id = salary.EMPCODE', 'left')
                    ->get_where('salary', array('salary.CODE' => $sal_id))->result();

        return array('page'=>'payroll/salary_print', 'data'=>$data);

    }
    
    public function multiple_emp_pay_slip(){
        
        $user_id = $this->session->user_id;

        $this->load->model('Payroll_m');
        
        $data['departments'] = $this->db->get_where('departments', array('user_id !=' => 13))->result();
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id !=' => 13))->result();    
            
        
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

        $user_id = $this->session->user_id;
        

            $query = "
                    SELECT
                        *
                    FROM
                        `employees`
                    WHERE
                        employees.d_id = $id";

            $res = $this->db->query($query)->result();
        
        return $res;
    }
    
    public function emp_on_dept_id_new_multiple(){
        $id = $this->input->post('gr_id');

        $user_id = $this->session->user_id;

            $query = "
                    SELECT
                        *
                    FROM
                        `employees`
                    WHERE
                        employees.d_id IN ($id)";

            $res = $this->db->query($query)->result();
        
        return $res;
    }
    
    public function emp_on_dept_id_new_multiples(){
        $id = implode(",",$this->input->post('gr_id'));

        $user_id = $this->session->user_id;

            $query = "
                    SELECT
                        *
                    FROM
                        `employees`
                    WHERE
                        employees.d_id IN ($id)";

            $res = $this->db->query($query)->result();
        
        return $res;
    }
    
    public function _fetch_multiple_pay_slip_detail($it_arr, $month) {
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
           $result = $this->db->join('employees', 'employees.e_id = salary.EMPCODE', 'left')
                     ->where_in('EMPCODE', $it_arr)
                     ->get_where('salary', array('MON' => $month))->result();   
            } else {
           $result = $this->db->join('employees', 'employees.e_id = salary.EMPCODE', 'left')
                     ->where_in('EMPCODE', $it_arr)
                     ->where('salary.USER_ID !=', 13)
                     ->get_where('salary', array('MON' => $month))->result();      
            }
   
        return $result;  
            
    }
    
    public function payroll_emp_leave_from_holiday_list() {
        
        $user_id = $this->session->user_id;
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $new_row = str_pad(($month),2,"0",STR_PAD_LEFT);
        
        $new_month = $year."-".$new_row;
        
        $total_day = $this->db->select('*')->like('DATE(holiday_list.date)', $new_month)->get('holiday_list')->num_rows();
        
        return $total_day;  
            
    }
    
    public function if_salary_slip_made_or_not() {
        
        $user_id = $this->session->user_id;
        $id = $this->input->post('id');
        $month = $this->input->post('month');

        $no_row = $this->db->get_where('salary', array('EMPCODE' => $id, 'MON' => $month))->num_rows();
        
        return $no_row;  
            
    }

}