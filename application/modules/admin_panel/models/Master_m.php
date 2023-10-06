<?php

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

    public function units() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/units'));
            $crud->set_theme('datatables');
            $crud->set_subject('Unit');
            $crud->set_table('units');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 30);  
            $uvp = $this->_user_wise_view_permission(30, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }          
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'units';
            $this->pk_field_name = 'u_id';
            // reference table values for checking
            $this->reference_array = array(
                array(
                    "tbl_name" => "item_groups",
                    "tbl_pk_fld" => "u_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 

            $crud->columns('unit','info','status');
            $crud->fields('unit','info','status','user_id');
            $crud->required_fields('unit','status');
            $crud->unique_fields(array('unit'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Units';
            $output->section_heading = 'Units <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Units';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function sizes() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/sizes'));
            $crud->set_theme('datatables');
            $crud->set_subject('Size');
            $crud->set_table('sizes');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 31);
            $uvp = $this->_user_wise_view_permission(31, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'sizes';
            $this->pk_field_name = 'sz_id';
            // reference table values for checking 
            $this->reference_array = array(
                array(
                    "tbl_name" => "item_master",
                    "tbl_pk_fld" => "sz_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 

            $crud->columns('size','info','status');
            $crud->fields('size','info','status','user_id');
            $crud->required_fields('size','status');
            $crud->unique_fields(array('size'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Sizes';
            $output->section_heading = 'Sizes <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Sizes';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function shapes() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/shapes'));
            $crud->set_theme('datatables');
            $crud->set_subject('Shape');
            $crud->set_table('shapes');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 32);
            $uvp = $this->_user_wise_view_permission(32, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

             // callback conditions
             $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
             // current table values 
             $this->table_name = 'shapes';
             $this->pk_field_name = 'sh_id';
             // reference table values for checking  
             $this->reference_array = array(
                array(
                    "tbl_name" => "item_master",
                    "tbl_pk_fld" => "sh_id",
                )
            );
             // $crud->callback_after_insert(array($this,'log_user_after_insert'));
             // $crud->callback_after_update(array($this, 'log_user_after_update'));
             $crud->callback_before_update(array($this,'log_before_update'));
             $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
             // callback conditions 

            $crud->columns('shape','info','status');
            $crud->fields('shape','info','status','user_id');
            $crud->required_fields('shape','status');
            $crud->unique_fields(array('shape'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Shapes';
            $output->section_heading = 'Shapes <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Shapes';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function ajax_unit_on_item_group(){
        $item_group_id = $this->input->post('group_code');
        return $this->db->get_where('item_groups', array('ig_id' => $item_group_id))->result()[0]->u_id;
    }

    public function item_groups() {
        $user_id = $this->session->user_id;
        
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/item_groups'));
            $crud->set_theme('datatables');
            $crud->set_subject('Item Group');
            $crud->set_table('item_groups');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 23);
            $user_permission = $this->_user_wise_view_permission(23, $user_id); 

            if($user_permission == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'item_groups';
            $this->pk_field_name = 'ig_id';
            
            $this->reference_array = array(
                array(
                    "tbl_name" => "item_master",
                    "tbl_pk_fld" => "ig_id",
                )
            );

            
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 

            $crud->columns('ig_code','sort_order','group_name','u_id','show_total_in_consumption','status');
            $crud->fields('ig_code','group_name','u_id','value','sort_order','show_total_in_consumption','status','user_id');
            $crud->required_fields('ig_code','group_name','u_id','status');
            $crud->unique_fields(array('ig_code'));

            $crud->display_as('ig_code', 'Item Group Code');
            $crud->display_as('group_name', 'Group Name');
            $crud->display_as('u_id', 'Unit');

            $crud->set_relation('u_id', 'units', 'unit');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Item Groups';
            $output->section_heading = 'Item Groups <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Item Groups';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function item_master() {
        $data = [];
        // permission setter 
        $user_id = $this->session->user_id;
        $this->fetch_permission_matrix($user_id, $m_id = 24);    
        $data["view_permission"] = $this->_user_wise_view_permission(24, $user_id);

        return array('page'=>'master/item_master_list_v', 'data'=>$data);
    }
    
    public function overtime_m() {
        // permission setter 

        $data[] = '';

        $user_id = $this->session->user_id;

        return array('page'=>'master/overtime_v', 'data'=>$data);
    }

    public function ajax_overtime_table_data_m() {
        
        $user_id = $this->session->user_id;
        
        //actual db table column names
        $column_orderable = array(
            0 => 'employees.name',
            1 => 'overtime.month'
        ); 
        // Set searchable column fields
        $column_search = array('employees.name', 'overtime.month');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->
        select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees.name, departments.department');
        $this->db->join('employees', 'employees.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('overtime.user_id !=', 13);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees.name, departments.department');
        $this->db->join('employees', 'employees.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('overtime.user_id !=', 13);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();
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
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees.name, departments.department');
        $this->db->join('employees', 'employees.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('overtime.user_id !=', 13);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('overtime.ot_id, overtime.e_id, overtime.dept_id, overtime.month, overtime.ot_rate, overtime.ot_hours, overtime.ot_total, overtime.user_id, overtime.status, employees.name, departments.department');
        $this->db->join('employees', 'employees.e_id = overtime.e_id', 'left');
        $this->db->join('departments', 'departments.d_id = overtime.dept_id', 'left');
            $this->db->where('overtime.user_id !=', 13);    
        $rs = $this->db->get_where('overtime', array('overtime.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
            
            $nestedData['name'] = $val->name;
            $nestedData['departments'] = $val->department;
            $nestedData['month'] = $val->month;
            $nestedData['ot_rate'] = $val->ot_rate;
            $nestedData['ot_hours'] = $val->ot_hours;
            $nestedData['ot_total'] = $val->ot_total;
            
            $uvp = $this->_user_wise_view_permission(12, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '
            <a href="javascript:void(0)" pk-name="ot_id" pk-value="'.$val->ot_id.'" tab="overtime" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            }
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

        $data['departments'] = $this->db->get_where('departments', array('user_id !=' => 13))->result();
        
        return array('page'=>'master/overtime_add_v', 'data'=>$data);
    }

    public function get_all_emp_id_for_overtime_m() {

      $month = $this->input->post('month');

      $dept_id = $this->input->post('dept_id');

      $get_new_array = array();

      $result = $this->db->order_by('employees.name')->get_where('employees', array('d_id' => $dept_id, 'status'=>'1'))->result();

      foreach($result as $res) {
        $get_num_rows = $this->db->get_where('overtime', array('overtime.e_id' => $res->e_id, 'overtime.dept_id' => $dept_id, 'overtime.month' => $month))->num_rows();

        if($get_num_rows == 0) {
           $res = $this->db->get_where('employees', array('d_id' => $dept_id, 'status'=>'1', 'e_id' => $res->e_id))->row();
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
        $user_id = $this->session->user_id;
        
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

    public function add_item() {
        $data['item_groups'] = $this->db->get_where('item_groups', array('status'=>'1'))->result_array();
        $data['sizes'] = $this->db->get_where('sizes', array('status'=>'1'))->result_array();
        $data['shapes'] = $this->db->get_where('shapes', array('status'=>'1'))->result_array();
        $data['units'] = $this->db->get_where('units', array('status'=>'1'))->result_array();

        return array('page'=>'master/item_master_add_v', 'data'=>$data);
    }

    public function form_add_item() {
        $data_insert['ig_id'] = $this->input->post('item_group');
        $data_insert['im_code'] = $this->input->post('item_code');
        $data_insert['sz_id'] = $this->input->post('size');
        $data_insert['sh_id'] = $this->input->post('shape');
        $data_insert['u_id'] = $this->input->post('unit');
        $data_insert['info_1'] = $this->input->post('desc1');
        $data_insert['info_2'] = $this->input->post('desc2');
        $data_insert['item'] = $this->input->post('item_name');
        $data_insert['type'] = $this->input->post('item_type');
        $data_insert['enlist_jobber'] = $this->input->post('jobber');
        $data_insert['enlist_costing'] = $this->input->post('show_in_costing');
        $data_insert['thick'] = $this->input->post('thick');
        $data_insert['buy_code'] = $this->input->post('buy_code');
        $data_insert['hsn_code'] = $this->input->post('hsn_code');
        // $data_insert['sell_code'] = $this->input->post('sell_code');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('item_master', $data_insert);
        $data['insert_id'] = $this->db->insert_id();
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/item_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_insert['img'] = $uploaded_data['file_name'];
            }
        }

        $data['type'] = 'success';
        $data['msg'] = 'Item added successfully.';
        return $data;
    }

    public function edit_item($im_id) {
        $data['item_groups'] = $this->db->get_where('item_groups', array('status'=>'1'))->result_array();
        $data['sizes'] = $this->db->get_where('sizes', array('status'=>'1'))->result_array();
        $data['shapes'] = $this->db->get_where('shapes', array('status'=>'1'))->result_array();
        $data['units'] = $this->db->get_where('units', array('status'=>'1'))->result_array();
        $data['item'] = $this->db->get_where('item_master', array('im_id'=>$im_id))->row();
        
        $data['items'] = $this->db->get_where('item_master', array('status' => 1))->result_array();
        $data['all_colors'] = $this->db->get_where('colors', array('status' => 1))->result_array();
        
        $data['colors'] = $this->db->where('colors.c_id NOT IN (select c_id from item_dtl WHERE `item_dtl`.`im_id` = '.$im_id .')',NULL,FALSE)->get_where('colors', array('colors.status' => 1))->result_array();
        $data['edit_colors'] = $this->db->get_where('colors', array('colors.status' => 1))->result_array();
        // echo $this->db->get_compiled_select('colors');
        // exit();

        $this->db->join('acc_groups', 'acc_groups.ag_id = acc_master.ag_id', 'left');
        $this->db->where('acc_groups.ag_id', 1); // changed for item rate
        $this->db->where('acc_master.status', '1');
        $data['acc_master'] = $this->db->get('acc_master')->result_array(); 

        return array('page'=>'master/item_master_edit_v', 'data'=>$data);
    }

    public function form_edit_item() {
        $item_id = $this->input->post('item_id');
        $data_update['ig_id'] = $this->input->post('item_group');
        $data_update['im_code'] = $this->input->post('item_code');
        $data_update['sz_id'] = $this->input->post('size');
        $data_update['sh_id'] = $this->input->post('shape');
        $data_update['u_id'] = $this->input->post('unit');
        $data_update['info_1'] = $this->input->post('desc1');
        $data_update['info_2'] = $this->input->post('desc2');
        $data_update['item'] = $this->input->post('item_name');
        $data_update['type'] = $this->input->post('item_type');
        $data_update['enlist_jobber'] = $this->input->post('jobber');
        $data_update['enlist_costing'] = $this->input->post('show_in_costing');
        $data_update['thick'] = $this->input->post('thick');
        $data_update['buy_code'] = $this->input->post('buy_code');
        $data_update['hsn_code'] = $this->input->post('hsn_code');
        // $data_update['sell_code'] = $this->input->post('sell_code');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/item_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];

                //deleting old file from server
                $old_img_name = $this->db->get_where('item_master', array('im_id' => $item_id))->row()->img;
                if ($old_img_name) {
                    $this->load->helper("file");
                    $path = 'assets/admin_panel/img/item_img/' . $old_img_name;
                    unlink($path);
                }
            }
        }
        

        $this->db->where('im_id', $item_id);
        $this->db->update('item_master', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Item updated successfully.';
        return $data;
    }

    public function form_add_item_buy_code() {
        $data_insert['ig_id'] = $this->input->post('ig_id');
        $data_insert['im_id'] = $this->input->post('item_id');
        $data_insert['am_id'] = $this->input->post('account_master_code');
        $data_insert['main_color_id'] = $this->input->post('main_color_id');        
       // $data_insert['buying_code'] = $this->input->post('buying_code');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;
        
        $data_insert['buyer_im_id'] = $this->input->post('im_id');
        $data_insert['customer_item_code'] = $this->input->post('customer_item_code');
        $data_insert['c_id'] = $this->input->post('c_id');
        $data_insert['customer_colour_code'] = $this->input->post('customer_colour_code');
        
        
        $this->db->insert('item_buying_codes', $data_insert);
        
        //echo $this->db->last_query();die;
        $data['type'] = 'success';
        $data['msg'] = 'Item buying codes added successfully.';
        return $data;
    }

    public function form_edit_item_buy_code() {
        $ibc_id = $this->input->post('ibc_id');
        $data_update['ibc_id'] = $ibc_id;
        $data_update['buying_code'] = $this->input->post('buying_code_edit');
        $data_update['status'] = $this->input->post('status');
        
        $data_update['buyer_im_id'] = $this->input->post('im_id_edit');
        $data_update['customer_item_code'] = $this->input->post('customer_item_code_edit');
        $data_update['c_id'] = $this->input->post('c_id_edit');
        $data_update['customer_colour_code'] = $this->input->post('customer_colour_code_edit');
        
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ibc_id', $ibc_id)->update('item_buying_codes', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Item buying codes updated successfully.';
        return $data;
    }

    public function form_add_item_color() {
        $data_insert['im_id'] = $this->input->post('item_id');
        $data_insert['c_id'] = $this->input->post('color');
        $data_insert['opening_stock'] = $this->input->post('opening_stock');
        $data_insert['opening_rate'] = $this->input->post('opening_rate');
        $data_insert['opn_qnty_for_leather_status'] = $this->input->post('opn_qnty_for_leather_status');
        $data_insert['plating_rate'] = $this->input->post('plating_rate_add');
        $data_insert['reorder_qnty'] = $this->input->post('reorder');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;
        //if image uploaded
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/item_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_insert['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->insert('item_dtl', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Item color added successfully.';
        return $data;
    }

    public function form_edit_item_color() {
        $item_dtl_id = $this->input->post('item_dtl_id');
        // $data_update['c_id'] = $this->input->post('color');
        $data_update['opening_stock'] = $this->input->post('opening_stock_edit');
        $data_update['opn_qnty_for_leather_status'] = $this->input->post('opn_qnty_for_leather_status_edit');
        $data_update['opening_rate'] = $this->input->post('opening_rate_edit');
        $data_update['reorder_qnty'] = $this->input->post('reorder');
        $data_update['plating_rate'] = $this->input->post('plating_rate_edit');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;
        //if image uploaded
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/item_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];

                //deleting old file from server
                $old_img_name = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row()->img;
                if ($old_img_name) {
                    $this->load->helper("file");
                    $path = 'assets/admin_panel/img/item_img/' . $old_img_name;
                    unlink($path);
                }
            }
        }

        $this->db->where('id_id', $item_dtl_id);
        $this->db->update('item_dtl', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Item color updated successfully.';
        return $data;
    }

    public function form_add_item_color_rate() {
        $data_insert['id_id'] = $this->input->post('item_dtl_id');
        $data_insert['am_id'] = $this->input->post('supplier');
        $data_insert['gst_percentage'] = $this->input->post('gst');
        $data_insert['purchase_rate'] = $this->input->post('pur_rate');
        $data_insert['cost_rate'] = $this->input->post('cost_rate');
        $data_insert['plating_rate'] = $this->input->post('plating_rate_add1');
        $data_insert['effective_date'] = $this->input->post('eff_date');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('item_rates', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Item color rate added successfully.';
        return $data;
    }

    public function form_edit_item_color_rate() {
        $item_rate_id = $this->input->post('item_rate_id');
        $data_update['am_id'] = $this->input->post('supplier');
        $data_update['gst_percentage'] = $this->input->post('gst');
        $data_update['purchase_rate'] = $this->input->post('pur_rate');
        $data_update['cost_rate'] = $this->input->post('cost_rate');
        $data_update['plating_rate'] = $this->input->post('plating_rate_edit1');
        $data_update['effective_date'] = $this->input->post('eff_date');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ir_id', $item_rate_id);
        $this->db->update('item_rates', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Item color rate updated successfully.';
        return $data;
    }

    public function ajax_unique_item_code() {
        $item_id = $this->input->post('item_id');
        $item_code = $this->input->post('item_code');
        $item_rs = $this->db->get_where('item_master', array('im_id !='=>$item_id, 'im_code'=>$item_code))->result();

        if(count($item_rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Item code already used.';
        }

        return $data;
    }

    public function ajax_unique_item_name() {
        $item_id = $this->input->post('item_id');
        $item_name = $this->input->post('item_name');
        $item_rs = $this->db->get_where('item_master', array('im_id !='=>$item_id, 'item' => $item_name))->result();

        if(count($item_rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Item name already used.';
        }

        return $data;
    }

    public function ajax_unique_item_buy_code() {
        $item_id = $this->input->post('item_id');
        $am_id = $this->input->post('account_master_code');
        
        $item_rs = $this->db->get_where('item_buying_codes', array('im_id'=>$item_id, 'am_id' => $am_id))->num_rows();

        if($item_rs == 0) {
            $data = 'true';
        } else {
            $data = 'Code already added for this Buyer.';
        }

        return $data;
    }

    public function ajax_unique_item_color() {
        $item_id = $this->input->post('item_id');
        $item_dtl_id = $this->input->post('item_dtl_id');
        $color_id = $this->input->post('color');
        $item_rs = $this->db->get_where('item_dtl', array('im_id'=>$item_id, 'id_id !='=>$item_dtl_id, 'c_id' => $color_id))->result();

        if(count($item_rs) == 0) {
            $data = 'true';
        } else {
            $data = 'This color already added.';
        }

        return $data;
    }

    public function ajax_fetch_buy_code_details() {
        $item_buying_code_id = $this->input->post('item_buying_code_id');
        // $im_id = $this->input->post('item_id');
        
        $this->db->select('acc_master.name, item_buying_codes.*');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');
            $rs = $this->db->get_where('item_buying_codes', array('item_buying_codes.ibc_id'=>$item_buying_code_id))->result();
            return $rs;
    }

    public function ajax_fetch_item_color() {
        $item_dtl_id = $this->input->post('item_dtl_id');

        $this->db->select('id_id,item_dtl.c_id,opening_stock,opn_qnty_for_leather_status,reorder_qnty,item_dtl.status,colors.color, item_dtl.opening_rate, item_dtl.plating_rate');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        $item_dtl_row = $this->db->get_where('item_dtl', array('id_id'=>$item_dtl_id))->row();

        return $item_dtl_row;
    }

    public function ajax_unique_supp_item_color_rate_eff_date() {
        $item_dtl_id = $this->input->post('item_dtl_id');
        $supplier = $this->input->post('supplier');
        $eff_date = $this->input->post('eff_date');
        $item_rate_id = $this->input->post('item_rate_id');

        $this->db->where('id_id', $item_dtl_id);
        $this->db->where('am_id', $supplier);
        $this->db->where('effective_date', $eff_date);
        $this->db->where('ir_id !=', $item_rate_id);
        $item_rate_rs = $this->db->get('item_rates')->result();

        if(count($item_rate_rs) == 0) {
            $data = 'true';
        } else {
            $data = 'This effective date already added, for that item color, with selected supplier.';
        }

        return $data;
    }

    public function ajax_fetch_item_rate() {
        $item_rate_id = $this->input->post('item_rate_id');

        $this->db->select('ir_id,am_id,purchase_rate,cost_rate,gst_percentage,effective_date,status, plating_rate');
        $item_rate_row = $this->db->get_where('item_rates', array('ir_id'=>$item_rate_id))->row();

        return $item_rate_row;
    }

    public function item_mapper() {
        $user_id = $this->session->user_id;
        
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/item_mapper'));
            $crud->set_theme('datatables');
            $crud->set_subject('Item Mapping');
            $crud->set_table('item_mapping');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 25);

            $uvp = $this->_user_wise_view_permission(25, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter 

            
            $crud->unset_columns('user_id','create_date','modify_date','status');
            $crud->unset_fields('user_id','create_date','modify_date');
            // $crud->required_fields('ig_code','group_name','u_id','status');
            // $crud->unique_fields(array('ig_code'));

            $crud->set_relation('company_item_code', 'item_master', '{item} - ({im_code})');
            $crud->set_relation('company_item_color', 'colors', '{color} - ({c_code})');
            $crud->set_relation('buyer_item_code', 'item_master', '{item} - {im_code}');
            $crud->set_relation('buyer_item_color', 'colors', '{color} - {c_code}');
            
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Item Mapping';
            $output->section_heading = 'Item Mapper Matrix <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Item Mapper';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function countries() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/countries'));
            $crud->set_theme('datatables');
            $crud->set_subject('Country');
            $crud->set_table('countries');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 34);
            $uvp = $this->_user_wise_view_permission(34, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'countries';
            $this->pk_field_name = 'c_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "acc_master",
                    "tbl_pk_fld" => "c_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 

            $crud->columns('country','c_code','status');
            $crud->fields('country','c_code','status','user_id');
            $crud->required_fields('country','c_code','status');
            $crud->unique_fields(array('country','c_code'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('c_code', 'Country Code');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Countries';
            $output->section_heading = 'Countries <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Countries';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function stations() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/stations'));
            $crud->set_theme('datatables');
            $crud->set_subject('Station');
            $crud->set_table('stations');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 35);
            $uvp = $this->_user_wise_view_permission(35, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'stations';
            $this->pk_field_name = 's_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "acc_master",
                    "tbl_pk_fld" => "s_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('c_id','station','status');
            $crud->fields('c_id','station','status','user_id');
            $crud->required_fields('c_id','station','status');
            $crud->unique_fields(array('station'));

            $crud->set_relation('c_id', 'countries', 'country');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('c_id', 'Country');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Stations';
            $output->section_heading = 'Stations <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Stations';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function currencies() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/currencies'));
            $crud->set_theme('datatables');
            $crud->set_subject('Currency');
            $crud->set_table('currencies');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 36);
            $uvp = $this->_user_wise_view_permission(36, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'currencies';
            $this->pk_field_name = 'cur_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "acc_master",
                    "tbl_pk_fld" => "cur_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('c_id','currency','gst_currency','currency_sign','info','status');
            $crud->fields('c_id','currency','gst_currency','currency_sign','info','status','user_id','CURR_SRATE','CURR_BRATE');
            $crud->required_fields('c_id','currency','gst_currency','currency_sign','status');
            $crud->unique_fields(array('c_id'));

            $crud->set_relation('c_id', 'countries', 'country');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);
            $crud->add_action('Add Exchange Rate', '', '','ui-icon-plus',array($this,'set_path_for_currencies_rate'));

            $crud->display_as('c_id', 'Country');
            $crud->display_as('currency_sign', 'Currency Sign');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Currencies';
            $output->section_heading = 'Currencies <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Currencies';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    
    
    function set_path_for_currencies_rate($primary_key , $row)
{
    return base_url('admin/add-currencies-rate/'.$primary_key);
}
    
    
    
    
    public function add_currencies_rate($val) {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            // $crud->set_crud_url_path(base_url('admin_panel/Master/add_currencies_rate/$1'));
            $crud->set_theme('datatables');
            $crud->set_subject('Currency Rate');
            $crud->set_table('currencies_rate');
            $crud->where('currencies_rate.cur_id', $val);
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 36);
            $uvp = $this->_user_wise_view_permission(36, $user_id);

            // permission setter

            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            // callback conditions

            $crud->columns('cur_id','rate','effective_date','status');
            $crud->fields('cur_id','rate','effective_date','status');
            $crud->required_fields('cur_id','rate','effective_date','status');

            $crud->set_relation('cur_id', 'currencies', 'currency');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Currency Rate';
            $output->section_heading = 'Currency Rate <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Currency Rate';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    

    public function colors() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/colors'));
            $crud->set_theme('datatables');
            $crud->set_subject('Color');
            $crud->set_table('colors');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 33);
            $uvp = $this->_user_wise_view_permission(33, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

             // callback conditions
             $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
             // current table values 
             $this->table_name = 'colors';
             $this->pk_field_name = 'c_id';
             // reference table values for checking  
             $this->reference_array = array(
                array(
                    "tbl_name" => "item_dtl",
                    "tbl_pk_fld" => "c_id",
                ),
                array(
                    "tbl_name" => "article_dtl",
                    "tbl_pk_fld" => "lth_color_id",
                ),
                array(
                    "tbl_name" => "article_dtl",
                    "tbl_pk_fld" => "fit_color_id",
                )
            );
             // $crud->callback_after_insert(array($this,'log_user_after_insert'));
             // $crud->callback_after_update(array($this, 'log_user_after_update'));
             $crud->callback_before_update(array($this,'log_before_update'));
             $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
             // callback conditions 

            $crud->columns('color','c_code','status');
            $crud->fields('color','c_code','status','user_id');
            $crud->required_fields('color','status');
            $crud->unique_fields(array('color','c_code'));

            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('c_code', 'Color Code');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Colors';
            $output->section_heading = 'Colors <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Colors';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function account_groups() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/account_groups'));
            $crud->set_theme('datatables');
            $crud->set_subject('Account Group');
            $crud->set_table('acc_groups');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $result_set = $this->fetch_permission_matrix($user_id, $m_id = 28);
            $uvp = $this->_user_wise_view_permission(28, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter 

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'acc_groups';
            $this->pk_field_name = 'ag_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "acc_master",
                    "tbl_pk_fld" => "ag_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 


            $crud->columns('group_name','type','type_side','status');
            $crud->fields('group_name','type','type_side','status','user_id');
            $crud->required_fields('group_name','type','type_side','status');
            $crud->unique_fields(array('group_name'));

            $crud->field_type('type', 'dropdown', array('Profit & Loss'=>'Profit & Loss','Balance Sheet'=>'Balance Sheet'));
            $crud->field_type('type_side', 'dropdown', array('Income'=>'Income','Expenditure'=>'Expenditure','Assets'=>'Assets','Liabilities'=>'Liabilities'));
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('group_name', 'Group Name');
            $crud->display_as('type_side', 'Type Side');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Account Groups';
            $output->section_heading = 'Account Groups <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Account Groups';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function account_master() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/account_master'));
            $crud->set_theme('datatables');
            $crud->set_subject('Account Master');
            $crud->set_table('acc_master');
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
            $this->table_name = 'acc_master';
            $this->pk_field_name = 'ag_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "customer_order",
                    "tbl_pk_fld" => "acc_master_id",
                ),
                // array(
                //     "tbl_name" => "purchase_order",
                //     "tbl_pk_fld" => "po_id",
                // ),
                // array(
                //     "tbl_name" => "courier",
                //     "tbl_pk_fld" => "courier_id",
                // ),
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('ag_id','name','am_code','phone','status');
            $crud->unset_fields('create_date','modify_date');
            $crud->required_fields('ag_id','name','am_code','status','c_id','s_id','cur_id','acc_type');
            $crud->unique_fields(array('name','short_name','am_code'));

            $crud->set_relation('ag_id', 'acc_groups', 'group_name');
            $crud->set_relation('c_id', 'countries', 'country');
            $crud->set_relation('s_id', 'stations', 'station');
            $crud->set_relation('cur_id', 'currencies', 'currency');
            $crud->set_relation('buyer', 'acc_master', 'name');
            $crud->field_type('acc_type', 'dropdown', array('None'=>'None','Cutter'=>'Cutter','Fabricator'=>'Fabricator','Skiver'=>'Skiver'));
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('ag_id', 'Account Group');
            $crud->display_as('short_name', 'Short Name');
            $crud->display_as('am_code', 'Code');
            $crud->display_as('email_id', 'Email ID');
            $crud->display_as('vat_no', 'VAT No');
            $crud->display_as('c_id', 'Country');
            $crud->display_as('s_id', 'Station');
            $crud->display_as('cur_id', 'Currency');
            $crud->display_as('acc_type', 'Type');
            $crud->display_as('courier_address', 'Courier Address');
            
            $crud->add_action('Declaration', '', 'admin/account-declaration','ui-icon-plus');

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
    
    
    public function transport_master() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/transport_master'));
            $crud->set_theme('datatables');
            $crud->set_subject('Transport Master');
            $crud->set_table('transport_master');
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
            // $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'transport_master';
            $this->pk_field_name = 'tr_id';
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('name','am_code','phone','vat_no','status');
            $crud->unset_fields('create_date','modify_date');
            $crud->required_fields('name','am_code','status','c_id','s_id');
            $crud->unique_fields(array('name','short_name','am_code'));

            $crud->set_relation('c_id', 'countries', 'country');
            $crud->set_relation('s_id', 'stations', 'station');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('short_name', 'Short Name');
            $crud->display_as('am_code', 'Code');
            $crud->display_as('email_id', 'Email ID');
            $crud->display_as('vat_no', 'VAT/GST No');
            $crud->display_as('c_id', 'Country');
            $crud->display_as('s_id', 'Station');


            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Transport Master';
            $output->section_heading = 'Transport Master <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Transport Master';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    
    
    public function account_declaration($am_id) {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/account_declaration/'.$am_id));
            $crud->set_theme('datatables');
            $crud->set_subject('Account Declaration');
            $crud->where('acc_master_declaration.am_id', $am_id);
            $crud->set_table('acc_master_declaration');
            
            $crud->unset_read();
            $crud->unset_clone();

             // permission setter 
             $result_set = $this->fetch_permission_matrix($user_id, $m_id = 8);
             // echo '<pre>', print_r($result_set), '</pre>';die;
             if($result_set[0]->block_permission){
                 $this->session->set_flashdata('title', 'No-Permission!');
                 $this->session->set_flashdata('msg', 'Sorry! You do not have permission to view this page.');
                 redirect(base_url('admin/dashboard'));
             }else{
                 if($result_set[0]->add_permission == 0){
                     $crud->unset_add();
                 }
                 if($result_set[0]->edit_permission == 0){
                     $crud->unset_edit();
                 }
                 if($result_set[0]->delete_permission == 0){
                     $crud->unset_delete();
                 }
                 if($result_set[0]->print_permission == 0){
                     $crud->unset_print();
                 }
                 if($result_set[0]->download_permission == 0){
                     $crud->unset_export();
                 }
             }
             // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // callback conditions

            $crud->columns('master_account','declaration_subject','declaration_description','status');
            $crud->callback_column('master_account',array($this,'master_account_name'));
            
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);
            $crud->field_type('am_id', 'hidden', $am_id);
            
            $crud->display_as('declaration_subject', 'Declaration Subject');
            $crud->display_as('declaration_description', 'Declaration Description');            
            
            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Account Declaration';
            $output->section_heading = 'Account Declaration <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Account Declaration';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function master_account_name($value, $row){
        $am_id = $row->am_id;
        return $this->db->select('name')->get_where('acc_master', array('am_id' => $am_id))->result()[0]->name;
    }

    public function charges() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/charges'));
            $crud->set_theme('datatables');
            $crud->set_subject('Charge');
            $crud->set_table('charges');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 37);
            $uvp = $this->_user_wise_view_permission(37, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'charges';
            $this->pk_field_name = 'c_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "article_costing_charges",
                    "tbl_pk_fld" => "c_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->columns('charge_group','charge','amount','percentage','fix','sorting_order','status');
            $crud->fields('charge_group','charge','amount','percentage','fix','sorting_order','status','user_id');
            $crud->required_fields('charge_group','charge','fix','status');
            $crud->unique_fields(array('charge'));

            $crud->field_type('charge_group', 'dropdown', array('Charge'=>'Charge','Overhead and Others' => 'Overhead and Others','Commission'=>'Commission','Commission and Others' => 'Commission and Others'));
            $crud->field_type('fix', 'dropdown', array('No'=>'No','Yes'=>'Yes'));
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('charge_group', 'Charge Group');
            $crud->display_as('charge', 'Charge Name');
            $crud->display_as('fix', 'Fix Charge');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Charges';
            $output->section_heading = 'Charges <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Charges';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function departments() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/departments'));
            $crud->set_theme('datatables');
            $crud->set_subject('Department');
            $crud->where('user_id !=', 13);
            $crud->set_table('departments');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $result_set = $this->fetch_permission_matrix($user_id, $m_id = 45);
            // echo '<pre>', print_r($result_set), '</pre>';die;
            $uvp = $this->_user_wise_view_permission(45, $user_id);
            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'departments';
            $this->pk_field_name = 'd_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "employees",
                    "tbl_pk_fld" => "d_id",
                )
            );
            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions

            $crud->add_action('Permission', '', 'department-permission', 'fa-user');

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
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function article_groups() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/article_groups'));
            $crud->set_theme('datatables');
            $crud->set_subject('Article Group');
            $crud->set_table('article_groups');
            // $crud->unset_export();
            // $crud->unset_print();
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 26);

            $uvp = $this->_user_wise_view_permission(26, $user_id);
            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }
            // permission setter 

            // callback conditions
            $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            // current table values 
            $this->table_name = 'article_groups';
            $this->pk_field_name = 'ag_id';
            // reference table values for checking  
            $this->reference_array = array(
                array(
                    "tbl_name" => "article_master",
                    "tbl_pk_fld" => "ag_id",
                )
            );

            // $crud->callback_after_insert(array($this,'log_user_after_insert'));
            // $crud->callback_after_update(array($this, 'log_user_after_update'));
            $crud->callback_before_update(array($this,'log_before_update'));
            $crud->callback_before_delete(array($this,'check_and_log_before_delete'));
            // callback conditions 

            $crud->columns('d_id','group_name','status');
            $crud->fields('d_id','group_name','status','user_id');
            $crud->required_fields('d_id','group_name','status');
            $crud->unique_fields(array('group_name'));

            $crud->set_relation('d_id', 'departments', 'department');
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $crud->display_as('d_id', 'Department');
            $crud->display_as('group_name', 'Group Name');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Article Groups';
            $output->section_heading = 'Article Groups <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Article Groups';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function employees() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/employees'));
            $crud->set_theme('datatables');
            $crud->set_subject('Employee');
            $crud->where('employees.user_id !=', 13);    
            $crud->set_table('employees');
            $crud->unset_read();
            $crud->unset_clone();
            // $crud->unset_delete();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 45);
            $uvp = $this->_user_wise_view_permission(45, $user_id);
            // echo '<pre>', print_r($result_set), '</pre>';die;
            
            
            // permission setter

            $crud->columns('e_code','name','working_place','d_id','picture','status');
            $crud->unset_fields('create_date','modify_date');
            $crud->required_fields('e_code','name','working_place','d_id','gender','esi','pf','pf_percentage_calculation','','','','','','','','','','Packing_and_checking','status');
            $crud->unique_fields(array('e_code'));

            $crud->set_relation('d_id', 'departments', 'department', array('user_id !=' => 13));
            $crud->field_type('working_place', 'dropdown', array('Office'=>'Office','Factory'=>'Factory'));
            $crud->field_type('gender', 'dropdown', array('Male'=>'Male','Female'=>'Female','Other'=>'Other'));
            $crud->field_type('esi', 'true_false', array('0'=>'No','1'=>'Yes'));
            $crud->field_type('pf', 'true_false', array('0'=>'No','1'=>'Yes'));
            $crud->field_type('pf_percentage_calculation', 'dropdown', array('permanent'=>'permanent(basic + da + conv)','contractual'=>'contractual(basic + conv + edu allow)','casual'=>'casual'));
            $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);
            $crud->set_field_upload('picture', 'assets/admin_panel/img/employee_img', 'jpg|jpeg|png|bpm');

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

            $crud->callback_before_delete(array($this,'check_before_del'));

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
    
    public function check_before_del($primary_key){
        
        $sn = $this->db->get_where('salary', array('EMPCODE' => $primary_key))->num_rows();
        $cn = $this->db->get_where('checking', array('e_id' => $primary_key))->num_rows();
        
        // echo $sn . ' ... ' . $cn; die;
        
        if($sn > 0 or $cn > 0){
            return false;    
        }else{
            return true;
        }
        
    }
    
    public function holiday_list_m() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/holiday_list_m'));
            $crud->set_theme('datatables');
            $crud->set_subject('Holiday List');
            if($user_id != 13) {
            $crud->where('holiday_list.user_id !=', 13);    
            }
            $crud->set_table('holiday_list');
            $crud->unset_read();
            $crud->unset_clone();
            $crud->unset_delete();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 45);
            $uvp = $this->_user_wise_view_permission(45, $user_id);
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
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function article_master() {
        $data = [];
        // permission setter
        $user_id = $this->session->user_id;
        $this->fetch_permission_matrix($user_id, $m_id = 27);
        $data['view_permission'] = $this->_user_wise_view_permission(27, $user_id);
        // permission setter
        return array('page'=>'master/article_master_list_v', 'data'=>$data);
    }

    public function add_article() {
        $this->db->select('ag_id, group_name');
        $data['article_groups'] = $this->db->get_where('article_groups', array('status'=>'1'))->result_array();

        $this->db->select('acc_master.am_id, acc_master.name');
        $this->db->join('acc_groups', 'acc_groups.ag_id = acc_master.ag_id', 'left');
        $this->db->where('acc_groups.group_name', 'Sundry Debtors');
        $this->db->where('acc_master.status', '1');
        $data['customers'] = $this->db->get('acc_master')->result_array(); //Sundry Debtors

        $this->db->select('item_master.im_id, item_master.item');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->where('item_groups.group_name', 'CARTON');
        $this->db->where('item_master.status', '1');
        $data['cartons'] = $this->db->get('item_master')->result_array();

        $data['leather_types'] = array('None','Cow','Buff','Goat','Hair-On','Print');

        return array('page'=>'master/article_master_add_v', 'data'=>$data);
    }

    public function form_add_article() {
        $data_insert['ag_id'] = $this->input->post('ag_id');
        $data_insert['art_no'] = $this->input->post('art_no');
        $data_insert['alt_art_no'] = $this->input->post('alt_art_no');
        $data_insert['info'] = $this->input->post('info');
        $data_insert['design'] = $this->input->post('design');
        $data_insert['pack_dtl'] = $this->input->post('pack_dtl');
        $data_insert['carton_id'] = $this->input->post('carton_id');
        $data_insert['gross_weight_per_carton'] = $this->input->post('gross_weight_per_carton');
        $data_insert['number_of_article_per_carton'] = $this->input->post('number_of_article_per_carton');
        $data_insert['customer_id'] = $this->input->post('customer_id');
        $data_insert['leather_type'] = $this->input->post('leather_type');
        $data_insert['emboss'] = $this->input->post('emboss');
        $data_insert['date'] = $this->input->post('date');
        $data_insert['exworks_amt'] = $this->input->post('exworks_amt');
        $data_insert['cf_amt'] = $this->input->post('cf_amt');
        $data_insert['fob_amt'] = $this->input->post('fob_amt');
        $data_insert['cutting_rate_a'] = $this->input->post('cutting_rate_a');
        $data_insert['cutting_rate_b'] = $this->input->post('cutting_rate_b');
        $data_insert['fabrication_rate_a'] = $this->input->post('fabrication_rate_a');
        $data_insert['fabrication_rate_b'] = $this->input->post('fabrication_rate_b');
        $data_insert['skiving_rate_a'] = $this->input->post('skiving_rate_a');
        $data_insert['skiving_rate_b'] = $this->input->post('skiving_rate_b');
        $data_insert['wl_rate_a'] = $this->input->post('wl_rate_a');
        $data_insert['wl_rate_b'] = $this->input->post('wl_rate_b');
        $data_insert['leather_type_info'] = $this->input->post('leather_type_info');
        $data_insert['metal_fitting'] = $this->input->post('metal_fitting');
        $data_insert['brand'] = $this->input->post('brand');
        $data_insert['hand_machine'] = $this->input->post('hand_machine');
        $data_insert['size'] = $this->input->post('size');
        $data_insert['remark'] = $this->input->post('remark');
        $data_insert['credit_score'] = $this->input->post('credit_score');
        $data_insert['alter_score'] = $this->input->post('alter_score');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;
        //if image uploaded
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_insert['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->insert('article_master', $data_insert);
        $data['insert_id'] = $this->db->insert_id();

        $data['type'] = 'success';
        $data['msg'] = 'Article added successfully.';
        return $data;
    }

    public function edit_article($am_id) {
        $this->db->select('ag_id, group_name');
        $data['article_groups'] = $this->db->get_where('article_groups', array('status'=>'1'))->result_array();

        $this->db->select('cur_id, currency');
        $data['currencies'] = $this->db->get_where('currencies', array('status'=>'1'))->result_array();

        $data['currency'] = $this->db
            ->select('acc_master.cur_id,currencies.currency as buyer_currency')
            ->join('acc_master', 'acc_master.am_id = article_master.customer_id','inner')
            ->join('currencies', 'acc_master.cur_id = currencies.cur_id','inner')
            ->get_where('article_master', array('article_master.am_id'=>$am_id))->row();        

        $this->db->select('acc_master.am_id, acc_master.name');
        $this->db->join('acc_groups', 'acc_groups.ag_id = acc_master.ag_id', 'left');
        $this->db->where('acc_groups.group_name', 'Sundry Debtors');
        $this->db->where('acc_master.status', '1');
        $data['customers'] = $this->db->get('acc_master')->result_array(); //Sundry Debtors

        $this->db->select('item_master.im_id, item_master.item');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->where('item_groups.group_name', 'Carton');
        $this->db->where('item_master.status', '1');
        $data['cartons'] = $this->db->get('item_master')->result_array();

        $data['leather_types'] = array('None','Cow','Buff','Goat','Hair-On','Print');
        $data['colors'] = $this->db->get_where('colors', array('status'=>'1'))->result_array();
        $data['item_groups'] = $this->db->get_where('item_groups', array('status'=>'1'))->result_array();

        $data['article'] = $this->db->get_where('article_master', array('am_id'=>$am_id))->row();

        return array('page'=>'master/article_master_edit_v', 'data'=>$data);
    }

    public function form_edit_article() {
        $article_id = $this->input->post('article_id');
        $data_update['ag_id'] = $this->input->post('ag_id');
        $data_update['art_no'] = $this->input->post('art_no');
        $data_update['alt_art_no'] = $this->input->post('alt_art_no');
        $data_update['info'] = $this->input->post('info');
        $data_update['design'] = $this->input->post('design');
        $data_update['pack_dtl'] = $this->input->post('pack_dtl');
        $data_update['carton_id'] = $this->input->post('carton_id');
        $data_update['gross_weight_per_carton'] = $this->input->post('gross_weight_per_carton');
        $data_update['number_of_article_per_carton'] = $this->input->post('number_of_article_per_carton');      
        $data_update['customer_id'] = $this->input->post('customer_id');
        $data_update['leather_type'] = $this->input->post('leather_type');
        $data_update['emboss'] = $this->input->post('emboss');
        $data_update['date'] = $this->input->post('date');
        $data_update['exworks_amt'] = $this->input->post('exworks_amt');
        $data_update['cf_amt'] = $this->input->post('cf_amt');
        $data_update['fob_amt'] = $this->input->post('fob_amt');
        $data_update['cutting_rate_a'] = $this->input->post('cutting_rate_a');
        $data_update['cutting_rate_b'] = $this->input->post('cutting_rate_b');
        $data_update['fabrication_rate_a'] = $this->input->post('fabrication_rate_a');
        $data_update['fabrication_rate_b'] = $this->input->post('fabrication_rate_b');
        $data_update['skiving_rate_a'] = $this->input->post('skiving_rate_a');
        $data_update['skiving_rate_b'] = $this->input->post('skiving_rate_b');
        $data_update['wl_rate_a'] = $this->input->post('wl_rate_a');
        $data_update['wl_rate_b'] = $this->input->post('wl_rate_b');
        $data_update['leather_type_info'] = $this->input->post('leather_type_info');
        $data_update['metal_fitting'] = $this->input->post('metal_fitting');
        $data_update['brand'] = $this->input->post('brand');
        $data_update['hand_machine'] = $this->input->post('hand_machine');
        $data_update['size'] = $this->input->post('size');
        $data_update['credit_score'] = $this->input->post('credit_score');
        $data_update['alter_score'] = $this->input->post('alter_score');
        $data_update['remark'] = $this->input->post('remark');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;
        //if image uploaded
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];

                //deleting old file from server
                $old_img_name = $this->db->get_where('article_master', array('am_id' => $article_id))->row()->img;
                if ($old_img_name) {
                    $this->load->helper("file");
                    $path = 'assets/admin_panel/img/article_img/' . $old_img_name;
                    unlink($path);
                }
            }
        }

        $this->db->where('am_id', $article_id);
        $this->db->update('article_master', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article updated successfully.';
        return $data;
    }

    public function form_add_article_color() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['lth_color_id'] = $this->input->post('lth_color_id');
        $data_insert['fit_color_id'] = $this->input->post('fit_color_id');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img_color')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_insert['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->insert('article_dtl', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article color added successfully.';
        return $data;
    }

    public function form_add_article_color_clone() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['lth_color_id'] = $this->input->post('lth_color_id');
        $data_insert['fit_color_id'] = $this->input->post('fit_color_id');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img_color')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_insert['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->insert('temp_article_dtl', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article color added successfully.';
        return $data;
    }

    public function form_edit_article_color() {
        $article_dtl_id = $this->input->post('article_dtl_id');
        $data_update['lth_color_id'] = $this->input->post('lth_color_id');
        $data_update['fit_color_id'] = $this->input->post('fit_color_id');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img_color')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->where('ad_id', $article_dtl_id);
        $this->db->update('article_dtl', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article color updated successfully.';
        return $data;
    }

    public function form_edit_article_color_clone() {
        $article_dtl_id = $this->input->post('article_dtl_id');
        $data_update['lth_color_id'] = $this->input->post('lth_color_id');
        $data_update['fit_color_id'] = $this->input->post('fit_color_id');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img_color')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];
            }
        }

        $this->db->where('ad_id', $article_dtl_id);
        $this->db->update('temp_article_dtl', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article color updated successfully.';
        return $data;
    }

    public function ajax_unique_article_no() {
        $article_id = $this->input->post('article_id');
        $art_no = $this->input->post('art_no');
        $rs = $this->db->get_where('article_master', array('am_id !='=>$article_id, 'art_no'=>$art_no))->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Article number already used.';
        }

        return $data;
    }

    public function ajax_unique_alternate_article_no() {
        $article_id = $this->input->post('article_id');
        $alt_art_no = $this->input->post('alt_art_no');
        $rs = $this->db->get_where('article_master', array('am_id !='=>$article_id, 'alt_art_no'=>$alt_art_no))->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Alternate article number already used.';
        }

        return $data;
    }

    public function ajax_unique_article_lth_color() {
        $lth_color_id = $this->input->post('lth_color_id');
        $fit_color_id = $this->input->post('fit_color_id');
        $article_id = $this->input->post('article_id');
        $article_dtl_id = $this->input->post('article_dtl_id');

        $this->db->where('am_id', $article_id);
        $this->db->where('lth_color_id', $lth_color_id);
        $this->db->where('fit_color_id', $fit_color_id);
        $this->db->where('ad_id !=', $article_dtl_id);
        $rs = $this->db->get('article_dtl')->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'This article color combination already exists.';
        }

        return $data;
    }

    public function ajax_fetch_article_color() {
        $article_dtl_id = $this->input->post('article_dtl_id');
        $article_dtl_row = $this->db->get_where('article_dtl', array('ad_id'=>$article_dtl_id))->row();

        return $article_dtl_row;
    }

    public function ajax_fetch_article_part() {
        $article_part_id = $this->input->post('article_part_id');
        $article_part_row = $this->db->get_where('article_parts', array('ap_id'=>$article_part_id))->row();

        return $article_part_row;
    }

    public function form_add_article_part() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['ig_id'] = $this->input->post('ig_id');
        $data_insert['quantity'] = $this->input->post('quantity');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('article_parts', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article part added successfully.';
        return $data;
    }

    public function form_add_article_part_clone() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['ig_id'] = $this->input->post('ig_id');
        $data_insert['quantity'] = $this->input->post('quantity');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('temp_article_parts', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article part added successfully.';
        return $data;
    }

    public function form_edit_article_part() {
        $article_part_id = $this->input->post('article_part_id');
        $data_update['ig_id'] = $this->input->post('ig_id');
        $data_update['quantity'] = $this->input->post('quantity');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ap_id', $article_part_id);
        $this->db->update('article_parts', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article part updated successfully.';
        return $data;
    }

    public function form_edit_article_part_clone() {
        $article_part_id = $this->input->post('article_part_id');
        $data_update['ig_id'] = $this->input->post('ig_id');
        $data_update['quantity'] = $this->input->post('quantity');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ap_id', $article_part_id);
        $this->db->update('temp_article_parts', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article part updated successfully.';
        return $data;
    }

    public function ajax_unique_article_part_item_group() {
        $article_part_id = $this->input->post('article_part_id');
        $article_id = $this->input->post('article_id');
        $ig_id = $this->input->post('ig_id');

        $this->db->where('am_id', $article_id);
        $this->db->where('ig_id', $ig_id);
        $this->db->where('ap_id !=', $article_part_id);
        $rs = $this->db->get('article_parts')->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'This item group already exists.';
        }

        return $data;
    }

    public function ajax_item_master_table_data() {


        //actual db table column names
        $column_orderable = array(
            0 => 'group_name',
            1 => 'im_code',
            2 => 'item',
            3 => 'hsn_code',
            4 => 'unit',
            5 => 'type',
            6 => 'enlist_costing',
            7 => 'status',
        );
        // Set searchable column fields
        $column_search = array('group_name','im_code','item','hsn_code','type','type');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('item_master')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->select('item_master.*, item_groups.group_name, units.unit');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_master.u_id', 'left');
            $this->db->limit($limit, $start);
            $this->db->group_by('item_groups.group_name, item_master.im_code');
            $this->db->order_by($order, $dir);
            $rs = $this->db->get('item_master')->result();
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

            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $rs = $this->db->get('item_master')->result();
            $totalFiltered = count($rs);

            $this->db->select('item_master.*, item_groups.group_name, units.unit');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_master.u_id', 'left');
            $this->db->limit($limit, $start);
            $this->db->group_by('item_groups.group_name, item_master.im_code');
            $this->db->order_by($order, $dir);
            $rs = $this->db->get('item_master')->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->img){$img='<img src="'.base_url('assets/admin_panel/img/item_img/'.$val->img).'" width="50">';} else{$img='';}
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}
            if($val->enlist_costing == '1'){$exist_in_costing='Yes';} else{$exist_in_costing='No';}
            
            $nestedData['group_name'] = $val->group_name;
            $nestedData['im_code'] = $val->im_code;
            $nestedData['item'] = $val->item;
            $nestedData['hsn_code'] = $val->hsn_code;
            $nestedData['item_unit'] = $val->unit;
            $nestedData['item_type'] = $val->type;
            $nestedData['exist_in_costing'] = $exist_in_costing;
            $nestedData['img'] = $img;
            $nestedData['status'] = $status;
            $uvp = $this->_user_wise_view_permission(24, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '
                <a href="'. base_url('admin/edit_item/'.$val->im_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <a href="javascript:void(0)" pk-name="im_id" pk-value="'.$val->im_id.'" tab="item-master" child="1" ref-table="" ref-pk-name="item-master#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            }
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_item_buy_code_table_data(){
        //actual db table column names
        $column_orderable = array(
            0 => 'item_buying_codes.am_id',
            1 => 'item_buying_codes.buyer_im_id',
            2 => 'item_buying_codes.customer_item_code',
            3 => 'item_buying_codes.c_id',
            4 => 'item_buying_codes.customer_colour_code'
        );
        // Set searchable column fields
        $column_search = array('item_buying_codes.am_id', 'item_buying_codes.buyer_im_id','item_buying_codes.customer_item_code','item_buying_codes.c_id','item_buying_codes.customer_colour_code');

        $im_id = $this->input->post('item_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        //$rs = $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left')->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
        
        $this->db->select('item_buying_codes.ibc_id, item_buying_codes.im_id, item_buying_codes.am_id, acc_master.name, item_buying_codes.buying_code,item_buying_codes.buyer_im_id, item_buying_codes.customer_item_code, item_buying_codes.c_id, item_buying_codes.customer_colour_code, im1.item as company_item, im1.im_code as company_im_code, im2.item as buyer_item, im2.im_code as buyer_im_code, colors.color, colors.c_code');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');
            $this->db->join('item_master im1', 'im1.im_id = item_buying_codes.im_id', 'left');
            $this->db->join('item_master im2', 'im2.im_id = item_buying_codes.buyer_im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_buying_codes.c_id', 'left');
            $rs = $this->db->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
        
        //echo $this->db->last_query();die;
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            //$this->db->select('acc_master.name, item_buying_codes.ibc_id, item_buying_codes.buying_code,item_buying_codes.status');
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            //$rs = $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left')->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
            $this->db->select('item_buying_codes.ibc_id, item_buying_codes.im_id, item_buying_codes.am_id, acc_master.name, item_buying_codes.buying_code,item_buying_codes.buyer_im_id, item_buying_codes.customer_item_code, item_buying_codes.c_id, item_buying_codes.customer_colour_code, im1.item as company_item, im1.im_code as company_im_code, im2.item as buyer_item, im2.im_code as buyer_im_code, colors.color, colors.c_code');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');
            $this->db->join('item_master im1', 'im1.im_id = item_buying_codes.im_id', 'left');
            $this->db->join('item_master im2', 'im2.im_id = item_buying_codes.buyer_im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_buying_codes.c_id', 'left');
            $rs = $this->db->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
            //echo $this->db->last_query();die;
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

            $this->db->select('item_buying_codes.ibc_id, item_buying_codes.im_id, item_buying_codes.am_id, acc_master.name, item_buying_codes.buying_code,item_buying_codes.buyer_im_id, item_buying_codes.customer_item_code, item_buying_codes.c_id, item_buying_codes.customer_colour_code, im1.item as company_item, im1.im_code as company_im_code, im2.item as buyer_item, im2.im_code as buyer_im_code, colors.color, colors.c_code');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');
            $this->db->join('item_master im1', 'im1.im_id = item_buying_codes.im_id', 'left');
            $this->db->join('item_master im2', 'im2.im_id = item_buying_codes.buyer_im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_buying_codes.c_id', 'left');
            $rs = $this->db->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
            
            
            $totalFiltered = count($rs);
            

            /*$this->db->select('acc_master.name, item_buying_codes.buying_code');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');*/
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            //$totalFiltered = $this->db->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();
            $this->db->select('item_buying_codes.ibc_id, item_buying_codes.im_id, item_buying_codes.am_id, acc_master.name, item_buying_codes.buying_code,item_buying_codes.buyer_im_id, item_buying_codes.customer_item_code, item_buying_codes.c_id, item_buying_codes.customer_colour_code, im1.item as company_item, im1.im_code as company_im_code, im2.item as buyer_item, im2.im_code as buyer_im_code, colors.color, colors.c_code');
            $this->db->join('acc_master', 'acc_master.am_id = item_buying_codes.am_id', 'left');
            $this->db->join('item_master im1', 'im1.im_id = item_buying_codes.im_id', 'left');
            $this->db->join('item_master im2', 'im2.im_id = item_buying_codes.buyer_im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_buying_codes.c_id', 'left');
            $rs = $this->db->get_where('item_buying_codes', array('item_buying_codes.im_id'=>$im_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            
            //if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['name'] = $val->name;
            $nestedData['buying_code'] = $val->buying_code;
            
            $nestedData['buyer_item_name'] = $val->buyer_item;
            $nestedData['buyer_item_code'] = $val->customer_item_code;
            $nestedData['buyer_item_color'] = $val->color.'['.$val->c_code.']';
            $nestedData['buyer_item_color_code'] = $val->customer_colour_code;
            
            $nestedData['status'] = '';//$status;
            $nestedData['action'] = '
<a href="javascript:void(0)" item_buying_code_id="'.$val->ibc_id.'" class="item_buying_code_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" pk-name="ibc_id" pk-value="'.$val->ibc_id.'" tab="item_buying_codes" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }
        // print_r($data);die;

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_item_color_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'color',
            2 => 'reorder_qnty',
            4 => 'status',
        );
        // Set searchable column fields
        $column_search = array('color','reorder_qnty');

        $im_id = $this->input->post('item_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('item_dtl', array('im_id'=>$im_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->select('item_dtl.*, colors.color');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->get_where('item_dtl', array('im_id'=>$im_id))->result();
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

            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $rs = $this->db->get_where('item_dtl', array('im_id'=>$im_id))->result();
            $totalFiltered = count($rs);

            $this->db->select('item_dtl.*, colors.color');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->get_where('item_dtl', array('im_id'=>$im_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->img){$img = '<img src="'.base_url('assets/admin_panel/img/item_img/'.$val->img).'" width="50">';}else{$img='';}
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['color'] = $val->color;
            $nestedData['opening_stock'] = $val->opening_stock;
            $nestedData['opn_qnty_for_leather_status'] = $val->opn_qnty_for_leather_status;
            $nestedData['opening_rate'] = $val->opening_rate;
            $nestedData['plating_rate'] = $val->plating_rate;
            $nestedData['reorder_qnty'] = $val->reorder_qnty;
            $nestedData['img'] = $img;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" item_dtl_id="'.$val->id_id.'" main_color_id="'.$val->c_id.'" class="item_dtl_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" pk-name="id_id" pk-value="'.$val->id_id.'" tab="item-dtl" child="1" ref-table="item-rates" ref-pk-name="id-id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_item_color_rate_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'name',
            1 => 'purchase_rate',
            2 => 'cost_rate',
            3 => 'gst_percentage',
            4 => 'effective_date',
            5 => 'status',
        );
        // Set searchable column fields
        $column_search = array('name','purchase_rate','cost_rate','gst_percentage','effective_date');

        $item_dtl_id = $this->input->post('item_dtl_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('item_rates', array('id_id'=>$item_dtl_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id))->result();
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

            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['name'] = $val->name;
            $nestedData['purchase_rate'] = $val->purchase_rate;
            $nestedData['cost_rate'] = $val->cost_rate;
            $nestedData['plating_rate'] = $val->plating_rate;
            $nestedData['gst_percentage'] = $val->gst_percentage;
            $nestedData['effective_date'] = $val->eff_date;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" item_rate_id="'.$val->ir_id.'" class="item_rate_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" child="0" tab="item-rates" pk-value="'.$val->ir_id.'" pk-name="ir-id" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_item_color_rate_table_data_new() {
        //actual db table column names
        $column_orderable = array(
            0 => 'name',
            1 => 'purchase_rate',
            2 => 'cost_rate',
            3 => 'gst_percentage',
            4 => 'effective_date',
            5 => 'status',
        );
        // Set searchable column fields
        $column_search = array('name','purchase_rate','cost_rate','gst_percentage','effective_date');

        $item_dtl_id = $this->input->post('item_dtl_id');
        $am_id_hidden = $this->input->post('am_id_hidden');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('item_rates', array('id_id'=>$item_dtl_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id, 'item_rates.am_id' => $am_id_hidden))->result();
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

            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id, 'item_rates.am_id' => $am_id_hidden))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->select('item_rates.*, DATE_FORMAT(item_rates.effective_date, "%d-%m-%Y") as eff_date, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = item_rates.am_id', 'left');
            $rs = $this->db->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id'=>$item_dtl_id, 'item_rates.am_id' => $am_id_hidden))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['name'] = $val->name;
            $nestedData['purchase_rate'] = $val->purchase_rate;
            $nestedData['cost_rate'] = $val->cost_rate;
            $nestedData['plating_rate'] = $val->plating_rate;
            $nestedData['gst_percentage'] = $val->gst_percentage;
            $nestedData['effective_date'] = $val->eff_date;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" item_rate_id="'.$val->ir_id.'" class="item_rate_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" child="0" tab="item-rates" pk-value="'.$val->ir_id.'" pk-name="ir-id" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_fetch_article_rate() {
        $article_rate_id = $this->input->post('article_rate_id');
        $article_rate_row = $this->db->get_where('article_rates', array('ar_id'=>$article_rate_id))->row();

        return $article_rate_row;
    }
    
    
    public function ajax_fetch_article_rate_new() {
        $article_rate_id = $this->input->post('article_rate_id');
        $article_rate_row = $this->db->get_where('article_rates_office_use', array('ar_id'=>$article_rate_id))->row();

        return $article_rate_row;
    }
    

    public function form_add_article_rate() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['date'] = $this->input->post('date');
        $data_insert['remarks_main'] = $this->input->post('remarks_main');
        $data_insert['cur_id'] = $this->input->post('cur_id');
        $data_insert['currency_rate'] = $this->input->post('currency_rate');
        $data_insert['conversion_rate'] = $this->input->post('conversion_rate');
        $data_insert['exworks_factory'] = $this->input->post('exworks_factory');
        $data_insert['cf_factory'] = $this->input->post('cf_factory');
        $data_insert['fob_factory'] = $this->input->post('fob_factory');
        $data_insert['exworks_office'] = $this->input->post('exworks_office');
        $data_insert['cf_office'] = $this->input->post('cf_office');
        $data_insert['fob_office'] = $this->input->post('fob_office');
        $data_insert['conversion_rate_final'] = $this->input->post('conversion_rate_final');
        $data_insert['exworks_final'] = $this->input->post('exworks_final');
        $data_insert['cf_final'] = $this->input->post('cf_final');
        $data_insert['fob_final'] = $this->input->post('fob_final');
        $data_insert['remarks_final'] = $this->input->post('remarks_final');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('article_rates', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate added successfully.';
        return $data;
    }
    
    
    public function form_add_article_rate_new() {
        $data_insert['am_id'] = $this->input->post('article_id_new');
        $data_insert['date'] = $this->input->post('date_new');
        $data_insert['currency_rate'] = $this->input->post('currency_rate_new');
        $data_insert['conversion_rate'] = $this->input->post('conversion_rate_new');
        $data_insert['exworks_factory'] = $this->input->post('exworks_factory_new');
        $data_insert['cf_factory'] = $this->input->post('cf_factory_new');
        $data_insert['fob_factory'] = $this->input->post('fob_factory_new');
        $data_insert['exworks_office'] = $this->input->post('exworks_office_new');
        $data_insert['cf_office'] = $this->input->post('cf_office_new');
        $data_insert['fob_office'] = $this->input->post('fob_office_new');
        $data_insert['conversion_rate_final'] = $this->input->post('conversion_rate_final_new');
        $data_insert['exworks_final'] = $this->input->post('exworks_final_new');
        $data_insert['cf_final'] = $this->input->post('cf_final_new');
        $data_insert['fob_final'] = $this->input->post('fob_final_new');
        $data_insert['remarks_final'] = $this->input->post('remarks_final_new');
        $data_insert['status'] = $this->input->post('status_new');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('article_rates_office_use', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate added successfully.';
        return $data;
    }
    

    public function form_add_article_rate_clone() {
        $data_insert['am_id'] = $this->input->post('article_id');
        $data_insert['date'] = $this->input->post('date');
        $data_insert['remarks_main'] = $this->input->post('remarks_main');
        $data_insert['cur_id'] = $this->input->post('cur_id');
        $data_insert['currency_rate'] = $this->input->post('currency_rate');
        $data_insert['conversion_rate'] = $this->input->post('conversion_rate');
        $data_insert['exworks_factory'] = $this->input->post('exworks_factory');
        $data_insert['cf_factory'] = $this->input->post('cf_factory');
        $data_insert['fob_factory'] = $this->input->post('fob_factory');
        $data_insert['exworks_office'] = $this->input->post('exworks_office');
        $data_insert['cf_office'] = $this->input->post('cf_office');
        $data_insert['fob_office'] = $this->input->post('fob_office');
        $data_insert['conversion_rate_final'] = $this->input->post('conversion_rate_final');
        $data_insert['exworks_final'] = $this->input->post('exworks_final');
        $data_insert['cf_final'] = $this->input->post('cf_final');
        $data_insert['fob_final'] = $this->input->post('fob_final');
        $data_insert['remarks_final'] = $this->input->post('remarks_final');
        $data_insert['status'] = $this->input->post('status');
        $data_insert['user_id'] = $this->session->user_id;

        $this->db->insert('temp_article_rates', $data_insert);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate added successfully.';
        return $data;
    }

    public function form_edit_article_rate() {
        $article_rate_id = $this->input->post('article_rate_id');
        $data_update['date'] = $this->input->post('date');
        $data_update['remarks_main'] = $this->input->post('remarks_main');
        $data_update['cur_id'] = $this->input->post('cur_id');
        $data_update['currency_rate'] = $this->input->post('currency_rate');
        $data_update['conversion_rate'] = $this->input->post('conversion_rate');
        $data_update['exworks_factory'] = $this->input->post('exworks_factory');
        $data_update['cf_factory'] = $this->input->post('cf_factory');
        $data_update['fob_factory'] = $this->input->post('fob_factory');
        $data_update['exworks_office'] = $this->input->post('exworks_office');
        $data_update['cf_office'] = $this->input->post('cf_office');
        $data_update['fob_office'] = $this->input->post('fob_office');
        $data_update['conversion_rate_final'] = $this->input->post('conversion_rate_final');
        $data_update['exworks_final'] = $this->input->post('exworks_final');
        $data_update['cf_final'] = $this->input->post('cf_final');
        $data_update['fob_final'] = $this->input->post('fob_final');
        $data_update['remarks_final'] = $this->input->post('remarks_final');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ar_id', $article_rate_id);
        $this->db->update('article_rates', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate updated successfully.';
        return $data;
    }
    
    
    public function form_edit_article_rate_new() {
        $article_rate_id = $this->input->post('article_rate_id_new');
        $data_update['date'] = $this->input->post('date_new');
        $data_update['currency_rate'] = $this->input->post('currency_rate_new');
        $data_update['conversion_rate'] = $this->input->post('conversion_rate_new');
        $data_update['exworks_factory'] = $this->input->post('exworks_factory_new');
        $data_update['cf_factory'] = $this->input->post('cf_factory_new');
        $data_update['fob_factory'] = $this->input->post('fob_factory_new');
        $data_update['exworks_office'] = $this->input->post('exworks_office_new');
        $data_update['cf_office'] = $this->input->post('cf_office_new');
        $data_update['fob_office'] = $this->input->post('fob_office_new');
        $data_update['conversion_rate_final'] = $this->input->post('conversion_rate_final_new');
        $data_update['exworks_final'] = $this->input->post('exworks_final_new');
        $data_update['cf_final'] = $this->input->post('cf_final_new');
        $data_update['fob_final'] = $this->input->post('fob_final_new');
        $data_update['remarks_final'] = $this->input->post('remarks_final_new');
        $data_update['status'] = $this->input->post('status_new');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ar_id', $article_rate_id);
        $this->db->update('article_rates_office_use', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate updated successfully.';
        return $data;
    }
    

    public function form_edit_article_rate_clone() {
        $article_rate_id = $this->input->post('article_rate_id');
        $data_update['date'] = $this->input->post('date');
        $data_update['remarks_main'] = $this->input->post('remarks_main');
        $data_update['cur_id'] = $this->input->post('cur_id');
        $data_update['currency_rate'] = $this->input->post('currency_rate');
        $data_update['conversion_rate'] = $this->input->post('conversion_rate');
        $data_update['exworks_factory'] = $this->input->post('exworks_factory');
        $data_update['cf_factory'] = $this->input->post('cf_factory');
        $data_update['fob_factory'] = $this->input->post('fob_factory');
        $data_update['exworks_office'] = $this->input->post('exworks_office');
        $data_update['cf_office'] = $this->input->post('cf_office');
        $data_update['fob_office'] = $this->input->post('fob_office');
        $data_update['conversion_rate_final'] = $this->input->post('conversion_rate_final');
        $data_update['exworks_final'] = $this->input->post('exworks_final');
        $data_update['cf_final'] = $this->input->post('cf_final');
        $data_update['fob_final'] = $this->input->post('fob_final');
        $data_update['remarks_final'] = $this->input->post('remarks_final');
        $data_update['status'] = $this->input->post('status');
        $data_update['user_id'] = $this->session->user_id;

        $this->db->where('ar_id', $article_rate_id);
        $this->db->update('temp_article_rates', $data_update);

        $data['type'] = 'success';
        $data['msg'] = 'Article rate updated successfully.';
        return $data;
    }

    public function ajax_unique_article_rate_date() {
        $date = $this->input->post('date');
        $article_id = $this->input->post('article_id');
        $article_rate_id = $this->input->post('article_rate_id');

        $this->db->where('am_id', $article_id);
        $this->db->where('date', $date);
        $this->db->where('ar_id !=', $article_rate_id);
        $rs = $this->db->get('article_rates')->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Rate for this date already exists.';
        }

        return $data;
    }
    
    
    public function ajax_unique_article_rate_date_new() {
        $date = $this->input->post('date');
        $article_id = $this->input->post('article_id');
        $article_rate_id = $this->input->post('article_rate_id');

        $this->db->where('am_id', $article_id);
        $this->db->where('date', $date);
        $this->db->where('ar_id !=', $article_rate_id);
        $rs = $this->db->get('article_rates_office_use')->result();

        if(count($rs) == 0) {
            $data = 'true';
        } else {
            $data = 'Rate for this date already exists.';
        }

        return $data;
    }


    public function ajax_article_rate_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'date',
        );
        // Set searchable column fields
        $column_search = array('date');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates', array('am_id'=>$article_id))->result();
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

            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}
            
            $currency_row = $this->db->get_where('currencies', array('cur_id' => $val->cur_id))->row()->currency;

            $nestedData['date'] = $val->date;
            $nestedData['cur_id'] = $currency_row;
            $nestedData['conversion_rate'] = $val->conversion_rate;
            $nestedData['exworks_factory'] = $val->exworks_factory;
            $nestedData['cf_factory'] = $val->cf_factory;
            $nestedData['fob_factory'] = $val->fob_factory;
            $nestedData['exworks_final'] = $val->exworks_final;
            $nestedData['cf_final'] = $val->cf_final;
            $nestedData['fob_final'] = $val->fob_final;
            $nestedData['remarks_final'] = $val->remarks_final;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_rate_id="'.$val->ar_id.'" class="article_rate_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" tab="article-rates" pk-name="ar-id" pk-value="'.$val->ar_id.'" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }
    
    
    public function ajax_article_rate_table_data_new() {
        //actual db table column names
        $column_orderable = array(
            0 => 'date',
        );
        // Set searchable column fields
        $column_search = array('date');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates_office_use', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates_office_use', array('am_id'=>$article_id))->result();
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

            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates_office_use', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('article_rates_office_use', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
            
            
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}
            
            
            $nestedData['date'] = $val->date;
            $nestedData['conversion_rate'] = $val->conversion_rate;
            $nestedData['exworks_factory'] = $val->exworks_factory;
            $nestedData['cf_factory'] = $val->cf_factory;
            $nestedData['fob_factory'] = $val->fob_factory;
            $nestedData['exworks_final'] = $val->exworks_final;
            $nestedData['cf_final'] = $val->cf_final;
            $nestedData['fob_final'] = $val->fob_final;
            $nestedData['remarks_final'] = $val->remarks_final;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_rate_id_new="'.$val->ar_id.'" class="article_rate_edit_btn_new btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" tab="article_rates_office_use" pk-name="ar-id" pk-value="'.$val->ar_id.'" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }
    

    public function ajax_article_rate_table_data_clone() {
        //actual db table column names
        $column_orderable = array(
            0 => 'date',
            2 => 'status',
        );
        // Set searchable column fields
        $column_search = array('date','remarks_main');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('temp_article_rates', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('temp_article_rates', array('am_id'=>$article_id))->result();
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

            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('temp_article_rates', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select("*, DATE_FORMAT(date, '%d-%m-%Y') as date")->get_where('temp_article_rates', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['date'] = $val->date;
            $nestedData['remarks_main'] = $val->remarks_main;
            $nestedData['exworks_final'] = $val->exworks_final;
            $nestedData['cf_final'] = $val->cf_final;
            $nestedData['fob_final'] = $val->fob_final;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_rate_id="'.$val->ar_id.'" class="article_rate_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" tab="temp-article-rates" pk-name="ar-id" pk-value="'.$val->ar_id.'" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_article_part_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'group_name',
            1 => 'quantity',
            2 => 'status',
        );
        // Set searchable column fields
        $column_search = array('group_name','quantity');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('article_parts', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_parts.*, item_groups.group_name');
            $this->db->join('item_groups', 'item_groups.ig_id = article_parts.ig_id', 'left');
            $rs = $this->db->get_where('article_parts', array('am_id'=>$article_id))->result();
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

            $rs = $this->db->get_where('article_parts', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_parts.*, item_groups.group_name');
            $this->db->join('item_groups', 'item_groups.ig_id = article_parts.ig_id', 'left');
            $rs = $this->db->get_where('article_parts', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['group_name'] = $val->group_name;
            $nestedData['quantity'] = $val->quantity;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_part_id="'.$val->ap_id.'" class="article_part_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            ';
            // <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_article_part_table_data_clone() {
        //actual db table column names
        $column_orderable = array(
            0 => 'group_name',
            1 => 'quantity',
            2 => 'status',
        );
        // Set searchable column fields
        $column_search = array('group_name','quantity');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('temp_article_parts', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_parts.*, item_groups.group_name');
            $this->db->join('item_groups', 'item_groups.ig_id = temp_article_parts.ig_id', 'left');
            $rs = $this->db->get_where('temp_article_parts', array('am_id'=>$article_id))->result();
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

            $rs = $this->db->get_where('temp_article_parts', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_parts.*, item_groups.group_name');
            $this->db->join('item_groups', 'item_groups.ig_id = temp_article_parts.ig_id', 'left');
            $rs = $this->db->get_where('temp_article_parts', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['group_name'] = $val->group_name;
            $nestedData['quantity'] = $val->quantity;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_part_id="'.$val->ap_id.'" class="article_part_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            ';
            // <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_article_color_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'lth_color',
            1 => 'fit_color',
            2 => 'img',
            3 => 'status',
        );
        // Set searchable column fields
        $column_search = array('lth_color','fit_color');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('article_dtl', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('article_dtl', array('am_id'=>$article_id))->result();
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

            $this->db->select('article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('article_dtl', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('article_dtl', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['lth_color'] = $val->lth_color;
            $nestedData['fit_color'] = $val->fit_color;
            $nestedData['img'] = ($val->img != null) ? '<img src="' . base_url() . 'assets/admin_panel/img/article_img/' . $val->img . '" />' : 'No image provided';
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_dtl_id="'.$val->ad_id.'" class="article_dtl_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" pk-name="ad-id" pk-value="'.$val->ad_id.'" tab="article-dtl" child="1" ref-table="customer-order-dtl" ref-pk-name="art-master#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_article_color_table_data_clone() {
        //actual db table column names
        $column_orderable = array(
            0 => 'lth_color',
            1 => 'fit_color',
            2 => 'img',
            3 => 'status',
        );
        // Set searchable column fields
        $column_search = array('lth_color','fit_color');

        $article_id = $this->input->post('article_id');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('temp_article_dtl', array('am_id'=>$article_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = temp_article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = temp_article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('temp_article_dtl', array('am_id'=>$article_id))->result();
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

            $this->db->select('temp_article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = temp_article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = temp_article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('temp_article_dtl', array('am_id'=>$article_id))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_dtl.*, colors_1.color as lth_color, colors_2.color as fit_color');
            $this->db->join('colors colors_1', 'colors_1.c_id = temp_article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors_2', 'colors_2.c_id = temp_article_dtl.fit_color_id', 'left');
            $rs = $this->db->get_where('temp_article_dtl', array('am_id'=>$article_id))->result();

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['lth_color'] = $val->lth_color;
            $nestedData['fit_color'] = $val->fit_color;
            $nestedData['img'] = ($val->img != null) ? '<img src="' . base_url() . 'assets/admin_panel/img/article_img/' . $val->img . '" />' : 'No image provided';
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a href="javascript:void(0)" article_dtl_id="'.$val->ad_id.'" class="article_dtl_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="javascript:void(0)" pk-name="ad-id" pk-value="'.$val->ad_id.'" tab="temp-article-dtl" child="1" ref-table="customer-order-dtl" ref-pk-name="art-master#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function ajax_article_master_table_data() {

        // fetch department-wisemodule permission
        $session_user_id = $this->session->user_id;
        # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(16, $session_user_id); #1 = article master module_id
        $view_permission = $this->_user_wise_view_permission(27, $session_user_id); #menu_id = 27

        //actual db table column names
        $column_orderable = array(
            0 => 'group_name',
            1 => 'art_no',
            2 => 'info',
            3 => 'name',
            5 => 'item',
            6 => 'exworks_amt',
            7 => 'cf_amt',
            8 => 'fob_amt',
            9 => 'status'
        );
        // Set searchable column fields
        $column_search = array('group_name','art_no','info','name','item');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
            $rs = $this->db->get('article_master')->result();
        } else {
            #module_permission contains the dept id now
            $rs = $this->db
                ->join('user_details','user_details.user_id = article_master.user_id','left')
                ->get_where('article_master', array('user_details.user_dept' => $module_permission))->result();
        }
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get('article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = article_master.user_id','left')
                    ->get_where('article_master', array('user_details.user_dept' => $module_permission))->result();
            }
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

            $this->db->select('article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get('article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = article_master.user_id','left')
                    ->get_where('article_master', array('user_details.user_dept' => $module_permission))->result();
            }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get('article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = article_master.user_id','left')
                    ->get_where('article_master', array('user_details.user_dept' => $module_permission))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->img){$img='<img src="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'" width="50">';} else{$img='';}
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['group_name'] = $val->group_name;
            $nestedData['art_no'] = $val->art_no;
            $nestedData['info'] = $val->info;
            $nestedData['name'] = $val->name;
            $nestedData['date'] = $val->date;
            $nestedData['item'] = $val->item;
            $nestedData['img'] = $img;
            $nestedData['fabrication_rate_b'] = $val->fabrication_rate_b;
            $nestedData['exworks_amt'] = $val->exworks_amt;
            $nestedData['size'] = $val->size;
            $nestedData['fob_amt'] = $val->fob_amt;
            $nestedData['cf_amt'] = $val->cf_amt;
            $nestedData['status'] = $status;
            if($view_permission == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '
<a href="'. base_url('admin/edit_article/'.$val->am_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
<a href="'. base_url('admin/clone_article_master/'.$val->am_id) .'" class="btn btn-warning" style="padding:5px"><i class="fa fa-clone"></i> Clone</a>
<a href="javascript:void(0)" child="1" tab="article-master" pk-value="'.$val->am_id.'" pk-name="am-id" ref-table="article-costing" ref-pk-name="am-id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            ';
            }
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
    }

    public function pending_clone_master() {
            $data = [];
            return array('page'=>'master/article_master_pending_clone_list_v', 'data'=>$data);
        }

    public function ajax_article_master_table_data_pending_clone() {
            // fetch department-wisemodule permission
        $session_user_id = $this->session->user_id;
        # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(16, $session_user_id); #1 = article master module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'group_name',
            1 => 'art_no',
            2 => 'info',
            3 => 'name',
            5 => 'item',
            6 => 'exworks_amt',
            7 => 'cf_amt',
            8 => 'fob_amt',
            9 => 'status'
        );
        // Set searchable column fields
        $column_search = array('group_name','art_no','info','name','item');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
            $rs = $this->db->get('temp_article_master')->result();
        } else {
            #module_permission contains the dept id now
            $rs = $this->db
                ->join('user_details','user_details.user_id = temp_article_master.user_id','left')
                ->get_where('temp_article_master', array('user_details.user_dept' => $module_permission))->result();
        }
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = temp_article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = temp_article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = temp_article_master.carton_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get('temp_article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = temp_article_master.user_id','left')
                    ->get_where('temp_article_master', array('user_details.user_dept' => $module_permission))->result();
            }
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

            $this->db->select('temp_article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = temp_article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = temp_article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = temp_article_master.carton_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get('temp_article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = temp_article_master.user_id','left')
                    ->get_where('temp_article_master', array('user_details.user_dept' => $module_permission))->result();
            }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_article_master.*, article_groups.group_name, acc_master.name, item_master.item');
            $this->db->join('article_groups', 'article_groups.ag_id = temp_article_master.ag_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = temp_article_master.customer_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = temp_article_master.carton_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get('temp_article_master')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = temp_article_master.user_id','left')
                    ->get_where('temp_article_master', array('user_details.user_dept' => $module_permission))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();
        foreach ($rs as $val) {
            if($val->img){$img='<img src="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'" width="50">';} else{$img='';}
            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['group_name'] = $val->group_name;
            $nestedData['art_no'] = $val->art_no;
            $nestedData['info'] = $val->info;
            $nestedData['name'] = $val->name;
            $nestedData['date'] = $val->date;
            $nestedData['item'] = $val->item;
            $nestedData['img'] = $img;
            $nestedData['fabrication_rate_b'] = $val->fabrication_rate_b;
            $nestedData['exworks_amt'] = $val->exworks_amt;
            $nestedData['fob_amt'] = $val->fob_amt;
            $nestedData['cf_amt'] = $val->cf_amt;
            $nestedData['status'] = $status;
            $nestedData['action'] = '
<a target="_blank" href="'. base_url('admin/article_master_clone_delete/'.$val->am_id) .'" class="btn btn-danger delete" del-pk= "'.$val->ac_id.'"><i class="fa fa-times"></i> Delete</a>
            ';
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return $json_data;
        }

    public function clone_article_master($am_id) {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            $data['item_group_details'] = $this->db->select('ig_id,group_name,status')->get_where('item_groups', array('status' => 1))->result();
            //remove data from temp_article_costing table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_master');
            //copy article_costing table
            $rs = $this->db->get_where('article_master', array('am_id' => $am_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['tam_id'] = $val->am_id;
                    $nestdata['ag_id'] = $val->ag_id;
                    $nestdata['art_no'] = $val->art_no;
                    $nestdata['alt_art_no'] = $val->alt_art_no;
                    $nestdata['info'] = $val->info;
                    $nestdata['design'] = $val->design;
                    $nestdata['pack_dtl'] = $val->pack_dtl;
                    $nestdata['carton_id'] = $val->carton_id;
                    $nestdata['gross_weight_per_carton'] = $val->gross_weight_per_carton;
                    $nestdata['number_of_article_per_carton'] = $val->number_of_article_per_carton;
                    $nestdata['customer_id'] = $val->customer_id;
                    $nestdata['leather_type'] = $val->leather_type;
                    $nestdata['emboss'] = $val->emboss;
                    $nestdata['date'] = $val->date;
                    $nestdata['exworks_amt'] = $val->exworks_amt;
                    $nestdata['cf_amt'] = $val->cf_amt;
                    $nestdata['fob_amt'] = $val->fob_amt;
                    $nestdata['cutting_rate_a'] = $val->cutting_rate_a;
                    $nestdata['cutting_rate_b'] = $val->cutting_rate_b;
                    $nestdata['fabrication_rate_a'] = $val->fabrication_rate_a;
                    $nestdata['fabrication_rate_b'] = $val->fabrication_rate_b;
                    $nestdata['skiving_rate_a'] = $val->skiving_rate_a;
                    $nestdata['skiving_rate_b'] = $val->skiving_rate_b;
                    $nestdata['wl_rate_a'] = $val->wl_rate_a;
                    $nestdata['wl_rate_b'] = $val->wl_rate_b;
                    $nestdata['leather_type_info'] = $val->leather_type_info;
                    $nestdata['metal_fitting'] = $val->metal_fitting;
                    $nestdata['brand'] = $val->brand;
                    $nestdata['hand_machine'] = $val->hand_machine;
                    $nestdata['size'] = $val->size;
                    $nestdata['img'] = $val->img;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_master', $insert_data);
            }

            //remove data from temp_article_dtl table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_dtl');
            //copy article_dtl table
            $rs = $this->db->get_where('article_dtl', array('am_id' => $am_id))->result();

            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['ad_id'] = $val->ad_id;
                    $nestdata['am_id'] = $val->am_id;
                    $nestdata['lth_color_id'] = $val->lth_color_id;
                    $nestdata['fit_color_id'] = $val->fit_color_id;
                    $nestdata['img'] = $val->img;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_dtl', $insert_data); 

            }

            //remove data from temp_article_costing_details table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_parts');
            //copy article_costing_details table
            $rs = $this->db->get_where('article_parts', array('am_id' => $am_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['ap_id'] = $val->ap_id;
                    $nestdata['am_id'] = $val->am_id;
                    $nestdata['ig_id'] = $val->ig_id;
                    $nestdata['quantity'] = $val->quantity;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_parts', $insert_data);
            }

            //remove data from temp_article_rates table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_rates');
            //copy article_costing_charges table
            $rs = $this->db->get_where('article_rates', array('am_id' => $am_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['ar_id'] = $val->ar_id;
                    $nestdata['am_id'] = $val->am_id;
                    $nestdata['date'] = $val->date;
                    $nestdata['remarks_main'] = $val->remarks_main;
                    $nestdata['cur_id'] = $val->cur_id;
                    $nestdata['currency_rate'] = $val->currency_rate;
                    $nestdata['conversion_rate'] = $val->conversion_rate;
                    $nestdata['exworks_factory'] = $val->exworks_factory;
                    $nestdata['cf_factory'] = $val->cf_factory;
                    $nestdata['fob_factory'] = $val->fob_factory;
                    $nestdata['exworks_office'] = $val->exworks_office;
                    $nestdata['cf_office'] = $val->cf_office;
                    $nestdata['fob_office'] = $val->fob_office;
                    $nestdata['conversion_rate_final'] = $val->conversion_rate_final;
                    $nestdata['exworks_final'] = $val->exworks_final;
                    $nestdata['cf_final'] = $val->cf_final;
                    $nestdata['fob_final'] = $val->fob_final;
                    $nestdata['remarks_final'] = $val->remarks_final;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_rates', $insert_data);
            }

        $this->db->select('ag_id, group_name');
        $data['article_groups'] = $this->db->get_where('article_groups', array('status'=>'1'))->result_array();

        $this->db->select('cur_id, currency');
        $data['currencies'] = $this->db->get_where('currencies', array('status'=>'1'))->result_array();

        $data['currency'] = $this->db
            ->select('acc_master.cur_id,currencies.currency as buyer_currency')
            ->join('acc_master', 'acc_master.am_id = article_master.customer_id','inner')
            ->join('currencies', 'acc_master.cur_id = currencies.cur_id','inner')
            ->get_where('article_master', array('article_master.am_id'=>$am_id))->row();        

        $this->db->select('acc_master.am_id, acc_master.name');
        $this->db->join('acc_groups', 'acc_groups.ag_id = acc_master.ag_id', 'left');
        $this->db->where('acc_groups.group_name', 'Sundry Debtors');
        $this->db->where('acc_master.status', '1');
        $data['customers'] = $this->db->get('acc_master')->result_array(); //Sundry Debtors

        $this->db->select('item_master.im_id, item_master.item');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->where('item_groups.group_name', 'Carton');
        $this->db->where('item_master.status', '1');
        $data['cartons'] = $this->db->get('item_master')->result_array();

        $data['leather_types'] = array('None','Cow','Buff','Goat','Hair-On','Print');
        $data['colors'] = $this->db->get_where('colors', array('status'=>'1'))->result_array();
        $data['item_groups'] = $this->db->get_where('item_groups', array('status'=>'1'))->result_array();

        $data['article'] = $this->db->get_where('article_master', array('am_id'=>$am_id))->row();
      return array('page'=>'master/article_master_clone_v', 'data'=>$data);  
    }

    public function form_edit_article_master_clone() {
      $am_id = $this->input->post('article_id');
            $data_update['ag_id'] = $this->input->post('ag_id');
            $data_update['art_no'] = $this->input->post('art_no');
            $data_update['alt_art_no'] = $this->input->post('alt_art_no');
            $data_update['info'] = $this->input->post('info');
            $data_update['design'] = $this->input->post('design');
            $data_update['pack_dtl'] = $this->input->post('pack_dtl');
            $data_update['carton_id'] = $this->input->post('carton_id');
            $data_update['gross_weight_per_carton'] = $this->input->post('gross_weight_per_carton');
            $data_update['number_of_article_per_carton'] = $this->input->post('number_of_article_per_carton');
            $data_update['customer_id'] = $this->input->post('customer_id');
            $data_update['leather_type'] = $this->input->post('leather_type');
            $data_update['emboss'] = $this->input->post('emboss');
            $data_update['date'] = $this->input->post('date');
            $data_update['exworks_amt'] = $this->input->post('exworks_amt');
            $data_update['cf_amt'] = $this->input->post('cf_amt');
            $data_update['fob_amt'] = $this->input->post('fob_amt');
            $data_update['cutting_rate_a'] = $this->input->post('cutting_rate_a');
            $data_update['cutting_rate_b'] = $this->input->post('cutting_rate_b');
            $data_update['fabrication_rate_a'] = $this->input->post('fabrication_rate_a');
            $data_update['fabrication_rate_b'] = $this->input->post('fabrication_rate_b');
            $data_update['skiving_rate_a'] = $this->input->post('skiving_rate_a');
            $data_update['skiving_rate_b'] = $this->input->post('skiving_rate_b');
            $data_update['wl_rate_a'] = $this->input->post('wl_rate_a');
            $data_update['wl_rate_b'] = $this->input->post('wl_rate_b');
            $data_update['leather_type_info'] = $this->input->post('leather_type_info');
            $data_update['metal_fitting'] = $this->input->post('metal_fitting');
            $data_update['brand'] = $this->input->post('brand');
            $data_update['hand_machine'] = $this->input->post('hand_machine');
            $data_update['size'] = $this->input->post('size');
            $data_update['credit_score'] = $this->input->post('credit_score');
            $data_update['alter_score'] = $this->input->post('alter_score');
            $data_update['remark'] = $this->input->post('remark');
            $data_update['img'] = $this->input->post('img');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;
            if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/article_img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 1024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $data_update['img'] = $uploaded_data['file_name'];

                //deleting old file from server
                $old_img_name = $this->db->get_where('temp_article_master', array('tam_id' => $article_id))->row()->img;
                if ($old_img_name) {
                    $this->load->helper("file");
                    $path = 'assets/admin_panel/img/article_img/' . $old_img_name;
                    unlink($path);
                }
            }
        }
            $this->db->where('tam_id', $am_id);
            $this->db->update('temp_article_master', $data_update);
            
            // echo $this->db->last_query();
            
            // echo '<pre>', print_r($data_update), '</pre>'; die();

            //copy temp_article_master table
            $this->db->select('ag_id,art_no,alt_art_no,info,design,pack_dtl,carton_id, gross_weight_per_carton,number_of_article_per_carton,customer_id, leather_type,emboss,date,exworks_amt,cf_amt,fob_amt,cutting_rate_a,
                cutting_rate_b,fabrication_rate_a,fabrication_rate_b,skiving_rate_a, skiving_rate_b,wl_rate_a,wl_rate_b,leather_type_info,metal_fitting, brand,hand_machine,size,remark,img,status,user_id,create_date, modify_date');
            $rs = $this->db->get_where('temp_article_master', array('tam_id' => $am_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_master', $rs);
            }
            $am_id = $this->db->insert_id();
            
            $this->db->where('am_id', $am_id);
            $this->db->update('article_master', $data_update);
            
            //remove data from temp_article_costing table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_master');

            //update am_id (article-master ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_dtl', array('am_id'=>$am_id));
            //copy temp_article_dtl table
            $this->db->select('am_id,lth_color_id,fit_color_id,img,status,user_id,create_id,modify_id');
            $rs = $this->db->get_where('temp_article_dtl', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_dtl', $rs);
            }
            //remove data from temp_article_costing_measurements table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_dtl');
            //update am_id (article-master ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_parts', array('am_id'=>$am_id));
            //copy temp_article_parts table
            $this->db->select('am_id,ig_id,quantity,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_parts', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_parts', $rs);
            }
            //remove data from temp_article_parts table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_parts');

            //update am_id (article-master ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_rates', array('am_id'=>$am_id));
            //copy temp_article_rates table
            $this->db->select('am_id,date,remarks_main,cur_id,currency_rate,conversion_rate,exworks_factory,cf_factory,fob_factory,exworks_office,cf_office,fob_office,conversion_rate_final,exworks_final,cf_final,fob_final,remarks_final,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_rates', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_rates', $rs);
            }
            //remove data from temp_article_rates table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_rates');

            $data['type'] = 'success';
            $data['msg'] = 'Article master cloned successfully.';
            $data['url'] = base_url('admin/article_master');

            // $am_id = $this->input->post('am_id');
            // $data_update_am['exworks_amt'] = $this->input->post('exworks_amt');
            // $data_update_am['cf_amt'] = $this->input->post('cf_amt');
            // $data_update_am['fob_amt'] = $this->input->post('fob_amt');

            // $res = $this->db->where('am_id', $am_id)->update('article_master', $data_update_am);

            return $data;

    }

    
    public function article_master_clone_delete($am_id) {
       $this->db->where('tam_id', $am_id)->delete('temp_article_master');
            $data['type'] = 'success';
            $data['msg'] = 'Article master cloned deleted successfully.';
            $data['url'] = base_url('admin/pending_clone_master');
    }

    public function ajax_fetch_article_color_clone() {
            $ar_id = $this->input->post('article_dtl_id');

            $this->db->where('ad_id', $ar_id);
            $rs = $this->db->get('temp_article_dtl')->row();

            return $rs;
        }

    public function ajax_fetch_article_part_clone() {
            $article_part_id = $this->input->post('article_part_id');
        $article_part_row = $this->db->get_where('temp_article_parts', array('ap_id'=>$article_part_id))->row();

        return $article_part_row;
        }

        public function ajax_fetch_article_rate_clone() {
        $article_rate_id = $this->input->post('article_rate_id');
        $article_rate_row = $this->db->get_where('temp_article_rates', array('ar_id'=>$article_rate_id))->row();

        return $article_rate_row;
    }

    public function ajax_del_item_master_color(){
        $color_id = $this->input->post('pk_value');
        $nr1 = $this->db->get_where('item_rates', array('id_id' => $color_id))->num_rows();
        
        // *********************** - MORE CHECKING NEEDED - ***********************

        if($nr1 > 0){
            $warning = 1;
        }else{
            $warning = 0;
        }

        if($warning == 1){
            $data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item already exists in another table'; 
        }else{
            $data = $this->log_and_direct_delete('id_id', $color_id, 'item_dtl');
        }
        return $data;        
    }

    public function ajax_del_item_master(){

        $item_id = $this->input->post('pk_value');
        $nr1 = $this->db->get_where('item_dtl', array('im_id' => $item_id))->result();
        $nr2 = $this->db->get_where('item_rates', array('id_id' => $nr1[0]->id_id))->num_rows();
        if(count($nr1) > 0 or $nr2 > 0){
            $warning = 1;
        }else{
            $warning = 0;
        }

        if($warning == 1){
            $data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item already exists in another table'; 
        }else{
            $data = $this->log_and_direct_delete('im_id', $item_id, 'item_master');
        }
        return $data;    
    }

    public function ajax_del_article_master(){

        $article_id = $this->input->post('pk_value');
        $nr1 = $this->db->get_where('article_dtl', array('am_id' => $article_id))->num_rows();
        $nr2 = $this->db->get_where('article_costing', array('am_id' => $article_id))->num_rows();
        $nr3 = $this->db->get_where('customer_order_dtl', array('am_id' => $article_id))->num_rows();
        
        // *********************** - MORE CHECKING NEEDED - ***********************
        
        if($nr1 > 0 or $nr2 > 0 or $nr3 > 0){
            $warning = 1;
        }else{
            $warning = 0;
        }

        if($warning == 1){
            $data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item already exists in another table'; 
        }else{
            $data = $this->log_and_direct_delete('am_id', $article_id, 'article_master');
        }
        return $data;    
    }

    public function ajax_del_row_on_table_and_pk(){
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

    public function courier() {
        $user_id = $this->session->user_id;

        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Master/courier'));
            $crud->set_theme('datatables');
            $crud->set_subject('Courier Master');
            $crud->set_table('courier_master');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            $this->fetch_permission_matrix($user_id, $m_id = 38);
            $uvp = $this->_user_wise_view_permission(38, $user_id);

            if($uvp == 'block'){
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
            }            
            // permission setter

            // callback conditions
            // $crud->set_lang_string('delete_error_message', 'Unsuccessful! Data exsits in another table.');
            
            // callback conditions 

            $crud->columns('courier_name','remarks','status');
            $crud->fields('courier_name','remarks','status','user_id');
            $crud->required_fields('courier_name','status');
            $crud->unique_fields(array('courier_name'));

            $crud->unset_texteditor('remarks');

            // $crud->field_type('status', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('user_id', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Courier';
            $output->section_heading = 'Courier <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Courier';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    private function log_and_direct_delete($pk_name, $pk_value, $table){
        // log data first 
        
        $user_data = $this->db->where($pk_name, $pk_value)->get($table)->row();
        $insertArray = array(
            'table_name' => $table,
            'pk_id' => $pk_value,
            'action_taken'=>'delete', 
            'old_data' => json_encode($user_data),
            'user_id' => $this->session->user_id,
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