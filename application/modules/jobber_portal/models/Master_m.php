<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 20-02-2020
 * Time: 14:45
 * Last updated on 29-mar-2021 at 04:30 pm 
 */

class Master_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
    }

   private function _dept_wise_module_permission($module_id,$user){

        $dept_id = $this->db->get_where('user_details', array('user_id' => $user))->result()[0]->user_dept;
        if($dept_id != 0){
            $nr = $this->db->where('module_permission_id', $module_id)->where('FIND_IN_SET('.$dept_id.', dept_id) !=', 0)->get('module_permission')->num_rows();
            // echo $this->db->last_query(); die;
            if($nr == 0){
                # show-all
                return 'show';
            }else{
                # filter according to dept idart
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

    public function log_before_update($post_array,$primary_key){
        $insertArray = array(
            'table_name' => $this->table_name,
            'pk_id' => $primary_key,
            'action_taken'=>'edit', 
            'old_data' => json_encode($post_array),
            'user_id' => $this->session->user_id,
            'comment' => 'master'
        );
        if($this->db->insert('user_logs', $insertArray)){
            return true;
        }else{
            return false;
        }
    }

    public function check_and_log_before_delete($primary_key){
        // echo $this->reference_table_name . ' || ' . $this->reference_pk_field_name . ' || ' . $primary_key;die;
        $item_exists = 0;
        foreach($this->reference_array as $ra){
            $nr = $this->db->get_where($ra['tbl_name'], array($ra['tbl_pk_fld'] => $primary_key))->num_rows();
            if($nr > 0){
                $item_exists = 1;
            }
        }
        // print_r($this->reference_array);die;        

        if($item_exists > 0){
            return false;
        } else{
            $user_data = $this->db->where($this->pk_field_name, $primary_key)->get($this->table_name)->row();
            $insertArray = array(
                'table_name' => $this->table_name,
                'pk_id' => $primary_key,
                'action_taken'=>'delete', 
                'old_data' => json_encode($user_data),
                'user_id' => $this->session->user_id,
                'comment' => 'master'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function overtime_m() {
        // permission setter 
        $data = [];

        $data[] = '';

        $user_id = $this->session->userdata['accnt']['user_id'];

        return array('page'=>'master/overtime_v', 'data'=>$data);
    }

    public function ajax_overtime_table_data_m() {
        
        $user_id = $this->session->userdata['accnt']['user_id'];
        
        //actual db table column names
        $column_orderable = array(
            0 => 'employees_salary_department.name',
            1 => 'overtime.month'
        ); 
        // Set searchable column fields
        $column_search = array('employees_salary_department.name', 'overtime.month');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees_salary_department.name, departments.department');
        $this->db->join('employees_salary_department', 'employees_salary_department.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('departments.d_id =', 6);    
        $rs = $this->db->get_where('overtime', array('overtime.status' => 1))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees_salary_department.name, departments.department');
        $this->db->join('employees_salary_department', 'employees_salary_department.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('departments.d_id =', 6);    
        $rs = $this->db->get_where('overtime', array('overtime.status' => 1))->result();
        }
        //if searching for something
        else {
            $this->db->start_cache();
            // loop searchable columns
            $i = 0;
            foreach($column_search as $item){
                // first loop
                if($i===0){
                    $this->db->group_start(); //open bracket
                    $this->db->like($item, $search);
                }else{
                    $this->db->or_like($item, $search);
                }
                // last loop
                if(count($column_search) - 1 == $i){
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
            $this->db->stop_cache();
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees_salary_department.name, departments.department');
        $this->db->join('employees_salary_department', 'employees_salary_department.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('departments.d_id =', 6);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees_salary_department.name, departments.department');
        $this->db->join('employees_salary_department', 'employees_salary_department.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('departments.d_id =', 6);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();
        
        $nestedData = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
            
            $nestedData['name'] = $val->name;
            $nestedData['departments'] = $val->department;
            $nestedData['month'] = $val->month;
            $nestedData['ot_rate'] = $val->ot_rate;
            $nestedData['ot_hours'] = $val->ot_hours;
            $nestedData['ot_total'] = $val->ot_total;
                $nestedData['action'] = '
            <a href="javascript:void(0)" pk-name="ot_id" pk-value="'.$val->ot_id.'" tab="overtime" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            $data[] = $nestedData;

            // echo '<pre>', print_r($rs), '</pre>'; 
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function overtime_add_m() {
        $data = array();

        $data['departments'] = $this->db->get_where('departments', array('d_id' => 6))->result();
        
        return array('page'=>'master/overtime_add_v', 'data'=>$data);
    }

    public function get_all_emp_id_for_overtime_m() {

      $month = $this->input->post('month');

      $dept_id = $this->input->post('dept_id');

      $get_new_array = array();

      $result = $this->db->order_by('employees_salary_department.name')->get_where('employees_salary_department', array('d_id' => $dept_id, 'status'=>'1', 'user_id' => 17))->result();

      foreach($result as $res) {
        $get_num_rows = $this->db->get_where('overtime', array('overtime.e_id' => $res->e_id, 'overtime.dept_id' => $dept_id, 'overtime.month' => $month))->num_rows();

        if($get_num_rows == 0) {
           $res = $this->db->get_where('employees_salary_department', array('d_id' => $dept_id, 'status'=>'1', 'e_id' => $res->e_id))->row();
           $arr = array(
            'name' => $res->name,
            'ot_rate' => $res->ot_rate,
            'e_id' => $res->e_id,
            'esi_percentage' => $res->esi_percentage,
            'esi' => $res->esi,
            'pf_percentage_calculation' => $res->pf_percentage_calculation,
            'ot_rate_factory' => $res->ot_rate_factory
           ); 

           array_push($get_new_array, $arr);
        }

      }

      return $get_new_array;  

    }

    public function form_add_overtime(){
        $data = array();
        $month = $this->input->post('month');

        $group = $this->input->post('group');
        $add_ot_rate = $this->input->post('add_ot_rate');       
        $add_ot_hour = $this->input->post('add_ot_hour');
        $add_ot_total = $this->input->post('add_ot_total');
        $fact_act_ot_hrs_max = $this->input->post('fact_act_ot_hrs_max');
        $balance_hrs_max = $this->input->post('balance_hrs_max');
        $factory_ot = $this->input->post('factory_ot');
        $add_id = $this->input->post('add_id');
        $add_bonus = $this->input->post('add_ot_bonus');
        $add_main_total = $this->input->post('add_ot_main_total');
        $deduct_esi = $this->input->post('add_ot_deduct_esi');
        $advnc_oths = $this->input->post('add_ot_advnc_oths');
        $deduct_total = $this->input->post('add_ot_deduct_total');
        $net_pay = $this->input->post('add_ot_net_pay');
        $employee_type = $this->input->post('employee_type');
        $user_id = $this->session->userdata['accnt']['user_id'];
        
        // echo sizeof($cut_rcv_id); die();
        
        for($i = 0; $i < sizeof($add_id); $i++){

            $get_num_rows1 = $this->db->get_where('overtime', array('overtime.e_id' => $add_id[$i], 'overtime.dept_id' => $group, 'overtime.month' => $month))->num_rows();

            if($get_num_rows1 == 0 && $net_pay[$i] > 0) {
                
            $insertArray = array(
                'e_id' => $add_id[$i],
                'dept_id' => $group,
                'month' => $month,
                'ot_rate' => $add_ot_rate[$i],
                'ot_hours' => $add_ot_hour[$i],
                'ot_total' => $add_ot_total[$i],
                'factory_act_ot_hrs_max' => $fact_act_ot_hrs_max[$i],
                'balance_ot_hrs' => $balance_hrs_max[$i],
                'factory_ot' => $factory_ot[$i],
                'bonus' => $add_bonus[$i],
                'with_bonus_amnt' => $add_main_total[$i],
                'esi' => $deduct_esi[$i],
                'advance' => $advnc_oths[$i],
                'deduction_total' => $deduct_total[$i],
                'net_pay' => $net_pay[$i],
                'user_id' => $user_id
            );

            $this->db->insert('overtime', $insertArray);
            $insert_id = $this->db->insert_id();
        }

        }//end for
        $data['insert_id'] = $insert_id;
        
        if($insert_id > 0){
                        
            $data['type'] = 'success';
            $data['msg'] = 'Overtime details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function del_overtime_list_m(){
        $data = [];
        $id = $this->input->post('id');
        
        // echo sizeof($cut_rcv_id); die();
        
        $res = $this->db->delete('overtime', array('overtime.ot_id' => $id));
        
        if($res == 1){
                        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Overtime Successfully Deleted';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Deleted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function departments() {
        $user_id = $this->session->userdata['accnt']['user_id'];
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('jobber_portal/Master/departments'));
            $crud->set_theme('datatables');
            $crud->set_subject('Department');
            $crud->set_table('departments');
            $crud->where('user_id', 17);
            $crud->unset_read();
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_clone();

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'departments';
            $this->pk_field_name = 'd_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "employees_salary_department",
                    "tbl_pk_fld" => "d_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            // $crud->add_action('Permission', '', 'department-permission', 'fa-user');

            $crud->columns('department','status');
            $crud->fields('department','status','user_id');
            $crud->required_fields('department','status');
            $crud->unique_fields(array('department'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Departments';
            $output->section_heading = 'Departments <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Departments';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    
    public function contractor_master() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/contractor_master'));
            $crud->set_theme('datatables');
            $crud->set_subject('Contractor Master');
            $crud->set_table('contractor_master');
            $crud->unset_read();
            $crud->unset_clone();

             // permission setter 
             $this->fetch_permission_matrix($user_id, $m_id = 29);
             $uvp = $this->_user_wise_view_permission(29, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
             // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            // reference table values for checking  
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('name','am_code','phone','status');
            $crud->unset_fields('create_date','modify_date');
            $crud->required_fields('name','am_code','status','c_id','s_id','cur_id');
            $crud->unique_fields(array('name','short_name','am_code'));

            $crud->set_relation('c_id', 'countries', 'country');
            $crud->set_relation('s_id', 'stations', 'station');
            $crud->set_relation('cur_id', 'currencies', 'currency');
            $crud->set_relation('buyer', 'contractor_master', 'name');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('short_name', 'Short Name');
            $crud->display_as('am_code', 'Code');
            $crud->display_as('email_id', 'Email ID');
            $crud->display_as('vat_no', 'VAT No');
            $crud->display_as('c_id', 'Country');
            $crud->display_as('s_id', 'Station');
            $crud->display_as('cur_id', 'Currency');
            $crud->display_as('courier_address', 'Courier Address');
        
            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Account Master';
            $output->section_heading = 'Account Master <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Account Master';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    

    public function employees() {
        $user_id = $this->session->userdata['accnt']['user_id'];
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('jobber_portal/Master/employees'));
            $crud->set_theme('datatables');
            $crud->set_subject('Employee');
            $crud->set_table('employees_salary_department');
            $crud->unset_read();
            $crud->unset_clone();


            $crud->columns('c_id','e_code','emp_type','name','working_place','d_id','picture','status');
            $crud->unset_fields('create_date','modify_date');
            $crud->required_fields('c_id','e_code','emp_type','name','working_place','d_id','gender','esi','pf','pf_percentage_calculation','','','','','','','','','','cutting_rate','status');
            $crud->unique_fields(array('e_code'));

            $crud->set_relation('c_id', 'contractor_master', 'name');
            $crud->set_relation('d_id', 'departments', 'department', array('user_id' => 17));
            $crud->field_type('working_place', 'dropdown', array('Office'=>'Office','Factory'=>'Factory'));
            $crud->field_type('gender', 'dropdown', array('Male'=>'Male','Female'=>'Female','Other'=>'Other'));
            $crud->field_type('esi', 'true_false', array('0'=>'No','1'=>'Yes'));
            $crud->field_type('pf', 'true_false', array('0'=>'No','1'=>'Yes'));
            $crud->field_type('emp_type', 'dropdown', array('Jobber'=>'Jobber','Cutter'=>'Cutter'));
            $crud->field_type('pf_percentage_calculation', 'dropdown', array('permanent'=>'permanent(basic + da)','contractual'=>'contractual(basic + conv + edu allow)','casual'=>'casual'));
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);
            $crud->set_field_upload('picture', 'assets/admin_panel/img/employee_img', 'jpg|jpeg|png|bpm');

            $crud->display_as('c_id', 'Contractor Name');
            $crud->display_as('cutting_rate', 'Cutting Rate');
            $crud->display_as('emp_type', 'Employee Type');
            $crud->display_as('e_code', 'Employee Code');
            $crud->display_as('working_place', 'Working Place');
            $crud->display_as('father_name', 'Father Name');
            $crud->display_as('dob', 'Date of Birth');
            $crud->display_as('doj', 'Date of Joining');
            $crud->display_as('d_id', 'Department');
            $crud->display_as('esi', 'ESI Applicable');
            $crud->display_as('esi_acc_no', 'ESI Account No');
            $crud->display_as('esi_percentage', 'ESI Percentage');
            $crud->display_as('pf', 'PF Applicable');
            $crud->display_as('pf_acc_no', 'PF Account No');
            $crud->display_as('pf_percentage', 'PF Percentage');
            $crud->display_as('pf_percentage_calculation', 'PF Percentage Calculation');
            $crud->display_as('ot_rate_factory', 'Max OT Hours');
            $crud->display_as('ot_rate', 'OT. Rate');
            $crud->display_as('basic_pay', 'Basic Pay');
            $crud->display_as('da_amout', 'DA Amount');
            $crud->display_as('hra_percentage', 'HRA Percentage');
            $crud->display_as('hra_amount', 'HRA Amount');
            $crud->display_as('medical_allowance', 'Medical Allowance');
            $crud->display_as('special_allowance', 'Edu Allowance');
            $crud->display_as('cl_granted', 'CL Granted');
            $crud->display_as('cl_adjusted', 'CL Adjusted');
            $crud->display_as('cl_balance', 'CL Balance');
            $crud->display_as('el_granted', 'EL Granted');
            $crud->display_as('el_adjusted', 'EL Adjusted');
            $crud->display_as('el_balance', 'EL Balance');
            $crud->display_as('ol_granted', 'OL Granted');
            $crud->display_as('ol_adjusted', 'OL Adjusted');
            $crud->display_as('ol_balance', 'OL Balance');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Employees';
            $output->section_heading = 'Employees <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Employees';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    
    public function holiday_list_m() {
        $user_id = $this->session->userdata['accnt']['user_id'];
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('jobber_portal/Master/holiday_list_m'));
            $crud->set_theme('datatables');
            $crud->set_subject('Holiday List');
            $crud->set_table('holiday_list');
            $crud->unset_read();
            $crud->unset_clone();
            $crud->unset_delete();

            // permission setter 
            // echo '<pre>', print_r($result_set), '</pre>';die;
            // if($result_set[0]->block_permission){
            //     $this->session->set_flashdata('title', 'No-Permission!');
            //     $this->session->set_flashdata('msg', 'Sorry! You do not have permission to view this page.');
            //     redirect(base_url('admin/dashboard'));
            // }else{
            //     if($result_set[0]->add_permission == 0){
            //         $crud->unset_add();
            //     }
            //     if($result_set[0]->edit_permission == 0){
            //         $crud->unset_edit();
            //     }
            //     // if($result_set[0]->delete_permission == 0){
            //     //     $crud->unset_delete();
            //     // }
            //     if($result_set[0]->print_permission == 0){
            //         $crud->unset_print();
            //     }
            //     if($result_set[0]->download_permission == 0){
            //         $crud->unset_export();
            //     }
            // }
            
            // permission setter

            $crud->columns('title','date','status');
            $crud->unset_fields('created_date','modified_date');
            $crud->required_fields('title','date','status');

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('title', 'Leave Title');
            $crud->display_as('date', 'Leave Date');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Holiday List';
            $output->section_heading = 'Holiday List <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Holiday List';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function ajax_del_row_on_table_and_pk(){
        $data = [];
        $warning = 0;
        $pk_name = str_replace('-','_',$this->input->post('pk_name'));
        $pk_value = $this->input->post('pk_value');
        $table = str_replace('-','_',$this->input->post('tab'));
        $child = $this->input->post('child');
        $ref_table = str_replace('-','_',$this->input->post('ref_table'));
        $ref_pk_name = str_replace('-','_',$this->input->post('ref_pk_name')); 

        // checking article details table with customer order 
        if($this->input->post('ref_pk_name') == "art-master#multiple-check"){
            
            $details = $this->db->get_where($table, array($pk_name => $pk_value))->result();
            $nr = $this->db->get_where($ref_table, array('am_id' => $details[0]->am_id, 'fc_id' => $details[0]->fit_color_id, 'lc_id' => $details[0]->lth_color_id))->num_rows();
            if($nr > 0){
                $warning = 1;
            }else{
                $warning = 0;
            }
            // echo '<pre>',print_r($details), '</pre>';die;
        }else { # all other master delete 
            if($child == 0){
                $warning = 0;
            }else{
                $nr = $this->db->get_where($ref_table, array($ref_pk_name => $pk_value))->num_rows();
                
                if($nr > 0){
                    $warning = 1;
                }else{
                    $warning = 0;   
                }
            }
        }

        if($warning == 1){
            $data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item already exists in another table'; 
        }else{
            $data = $this->log_and_direct_delete($pk_name, $pk_value, $table);
        }
        
        return $data;
    }

    public function ajax_del_row_on_table_and_pk_clone(){
        $data = [];
        $warning = 0;
        $pk_name = str_replace('-','_',$this->input->post('pk_name'));
        $pk_value = $this->input->post('pk_value');
        $table = str_replace('-','_',$this->input->post('tab'));
        $child = $this->input->post('child');
        $ref_table = str_replace('-','_',$this->input->post('ref_table'));
        $ref_pk_name = str_replace('-','_',$this->input->post('ref_pk_name')); 

        // checking article details table with customer order 
        if($this->input->post('ref_pk_name') == "art-master#multiple-check"){
            
            $details = $this->db->get_where($table, array($pk_name => $pk_value))->result();
            $nr = $this->db->get_where($ref_table, array('am_id' => $details[0]->am_id, 'fc_id' => $details[0]->fit_color_id, 'lc_id' => $details[0]->lth_color_id))->num_rows();
            if($nr > 0){
                $warning = 1;
            }else{
                $warning = 0;
            }
            // echo '<pre>',print_r($details), '</pre>';die;
        }else { # all other master delete 
            if($child == 0){
                $warning = 0;
            }else{
                $nr = $this->db->get_where($ref_table, array($ref_pk_name => $pk_value))->num_rows();
                
                if($nr > 0){
                    $warning = 1;
                }else{
                    $warning = 0;   
                }
            }
        }

        if($warning == 1){
            $data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item already exists in another table'; 
        }else{
            $data = $this->log_and_direct_delete($pk_name, $pk_value, $table);
        }
        
        return $data;
    }

    private function log_and_direct_delete($pk_name, $pk_value, $table){
        // log data first 
        $data = [];
        $user_data = $this->db->where($pk_name, $pk_value)->get($table)->row();
        $insertArray = array(
            'table_name' => $table,
            'pk_id' => $pk_value,
            'action_taken'=>'delete', 
            'old_data' => json_encode($user_data),
            'user_id' => $this->session->userdata['accnt']['user_id'],
            'comment' => 'master'
        );
        if($this->db->insert('user_logs', $insertArray)){

            $this->db->where($pk_name, $pk_value)->delete($table);
            $data['title'] = 'Deleted!';
            $data['type'] = 'success';
            $data['msg'] = 'Item Successfully Deleted';
            
        }else{
            return false;
        }

        return $data;
    }

}