<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 14:00
 */

class Settings_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
        $this->db->query('SET SQL_BIG_SELECTS=1');
    }

    public function departments_permission(){
        $user_id = $this->session->user_id;
        try{

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('Modulewise Departmental Permission');
            $crud->set_table('module_permission');
            $crud->order_by('module_permission_id');

            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_clone();
            $crud->unset_delete();

            $crud->columns('module_name','dept_id');
            $crud->fields('module_name','dept_id');
            
            $results = $this->db->select('d_id, department')->get_where('departments',array('status' => 1))->result();

            foreach ($results as $result) {
                $module_array[$result->d_id] = $result->department;
            }


            $crud->field_type('dept_id', 'multiselect',$module_array);
            $crud->callback_field('module_name',array($this,'custom_readonly_dept'));

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Modulewise Departmental Permission';
            $output->section_heading = 'If selected then corresponding module will be filtered according to the department';
            $output->menu_name = 'Department Permission';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page

        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    function custom_readonly_dept($value = '', $primary_key = null){
        return $value . '<input type="hidden" value="'.$value.'" name="module_name">';
    }

    public function menu_permission(){
        $user_id = $this->session->user_id;
        try{

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('Menu Permission');
            $crud->set_table('menu');

            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_export();
            $crud->unset_print();

            $crud->columns('module_id','menu_name');
            $crud->columns('module_id','menu_name');

            $crud->set_relation('module_id', 'module_permission', 'module_name');
            
            // $crud->add_action('Permission', '', 'admin/user-permission','fa fa-add');

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Menu Permission';
            $output->section_heading = 'Menu Wise User Permission';
            $output->menu_name = 'Menu Permission';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page

        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }
    
    public function user_management(){
        $user_id = $this->session->user_id;
        try{

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('User Management');
            $crud->where('usertype', 2);
            $crud->set_table('users');

            $crud->unset_read();
            // $crud->unset_add();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_export();
            $crud->unset_print();

            $crud->columns('registration_date','username', 'email', 'verified', 'blocked');
            $crud->unset_fields('registration_date');
            $crud->add_fields('usertype','username','pass', 'email', 'verified', 'blocked');
            $crud->required_fields('username', 'pass');
            $crud->unique_fields('username');

            $crud->display_as('pass', 'Password');
            $crud->display_as('registration_date', 'Department');
            
            // # forcing registration_date to behave as user department
            $crud->field_type('pass', 'password');
            // $results = $this->db->select('d_id, department')->get_where('departments',array('status' => 1))->result();
            // // echo '<pre>', print_r($results), '</pre>';
            
            // foreach ($results as $row) {
            //     # code...
            //     $ra[$row->d_id] = $row->department;
            // }
            // $crud->field_type('department','dropdown', $ra);

            $crud->callback_field('usertype',array($this,'custom_readonly_usertype'));
            $crud->callback_column('registration_date',array($this,'_callback_user_dept'));

            $crud->callback_before_insert(array($this,'encrypt_password_callback'));
            $crud->callback_before_update(array($this,'encrypt_password_callback'));

            $crud->callback_edit_field('pass',array($this,'decrypt_password_callback'));

            $crud->add_action('Add department', '', 'admin/user-add-department','ui-icon-plus');

            $output = $crud->render();    
            
            //rending extra value to $output
            $output->tab_title = 'User Management';
            $output->section_heading = 'Edit User';
            $output->menu_name = 'User Management';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page

        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function user_add_department(){
        $user_id = $this->uri->segment(3);

        $data['user_department_details'] = $this->db->select('users.username, user_details.user_dept')
        ->join('user_details', 'user_details.user_id = users.user_id', 'left')
        ->join('departments', 'departments.d_id = user_details.user_dept', 'left')
        ->get_where('users', array('users.user_id' => $user_id))->row();

        $data['department_details'] = $this->db->get_where('departments', array('status => 1'))->result();

        if($this->input->post()) {
            $insert_array = array(
                'user_id' => $user_id,
                'user_dept' => $this->input->post('department_add')
            );

        $num_rows = $this->db->get_where('user_details', array('user_id' => $user_id))->num_rows();
        
        if($num_rows == 0) {
            $this->db->insert('user_details', $insert_array);
            if($this->db->insert_id() != '') {
                $this->session->set_flashdata('msg', 'Department has been added successfully.');
                redirect(base_url('admin/user-management'));
            }
        } else {
           $this->db->update('user_details', $insert_array, array('user_id' => $user_id));
           $this->session->set_flashdata('msg', 'Department has been updated successfully.');
           redirect(base_url('admin/user-management')); 
        }
        }

        return array('page'=>'department_v', 'data'=>$data);

    }
    
    public function excel_import_leather_quantity_m(){
        
        
        $data = [];
        
        
        if ($this->input->post('submit')) {
               
                $path = 'assets/uploads/';
                require_once APPPATH ."/third_party/PHPExcel-1.8/Classes/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray();
                    $flag = true;
                    $i=0;
                    $id_iterr = 001;
                    $un_iter = 1;
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                      if($value['0'] == ''){
                        continue;
                      }
$id_id_leathers= $value['0'];
$stock_in_quantitys= $value['12'];
$closing_rates= $value['14'];

$user_get_num_row = $this->db->get_where('item_dtl', array('id_id' => $value['0']))->num_rows();

if($user_get_num_row > 0) {


                    $update_data = array(
                      'opening_stock' => $stock_in_quantitys,
                      'opening_rate'  => $closing_rates,
                      'user_id' => $this->session->user_id
                    );


                $this->db->update('item_dtl', $update_data, array('id_id' => $id_id_leathers));
                
                
            } 
                $un_iter++;
                    }
                   $i++; 
               $this->session->set_flashdata('success_message','*Data Have Been Imported Successfully'); 
                          redirect('admin/excel_import_leather_quantity','refresh');                 
              }
               catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }else{
                  echo $error['error']; 
                  
                  
            
                  
                  
                }
        }
        return array('page'=>'student_bulk_upload_v', 'data'=>$data);
        
        
    }

    function custom_readonly_usertype($value = '', $primary_key = null){
       return '<b><em>Normal User</em></b>' . '<input type="hidden" value="2" name="usertype">'; 
        }

    function encrypt_password_callback($post_array, $primary_key = null){
        // unset($post_array['department']);
        $post_array['pass'] = hash('sha256', $post_array['pass']);
        return $post_array;
    }

    function decrypt_password_callback($value){
        return "<input type='password' name='pass' value='' placeholder='Enter new password' />";
    }

    public function _callback_user_dept($value, $row){
        $uid = $row->user_id;
        $num_rows = $this->db->get_where('user_details', array('user_id' => $uid))->num_rows();
        if($num_rows > 0) {
        $dept = $this->db->select('department')
            ->join('departments', 'user_details.user_dept = departments.d_id', 'left')
            ->get_where('user_details', array('user_details.user_id' => $uid))->result()[0]->department;
        } else {
          $dept = '';  
        }
        
        return $dept;
    }

    public function user_permission(){
        $user_id = $this->session->user_id;
        try{

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('User Permission');
            // $crud->where('user_permission.user_id !=', 1);
            $crud->set_table('user_permission');

            // $crud->unset_add();
            // $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_clone();
            // $crud->unset_delete();
            $crud->unset_export();
            $crud->unset_print();

            $results = $this->db->select('user_id, username')->get_where('users',array('verified' => 1, 'blocked' => 0, 'usertype' => 2))->result();

            $crud->columns('user_id', 'm_id', 'block_permission','view_permission');
            $crud->fields('user_id', 'm_id', 'block_permission','view_permission');
            $crud->required_fields('m_id', 'user_id');

            $crud->set_relation('m_id', 'menu', 'menu_name');
            $crud->set_relation('user_id', 'users', 'username');
            
            $crud->display_as('m_id', 'menu');
            $crud->display_as('user_id', 'username');
            $crud->display_as('view_permission', 'Add/View detailed list');

            if($this->input->post('user_permission')){
                $uid = $this->input->post('username');
                $output = $this->db->get_where('user_permission',array('status' => 1))->result();
            }else{
                $output = $crud->render();    
            }

            
            //rending extra value to $output
            $output->tab_title = 'User Permission';
            $output->section_heading = 'Menu Wise User Permission';
            $output->menu_name = 'User Permission';
            $output->add_button = '';
            $output->active_users = $results;

            return array('page'=>'common_v', 'data'=>$output); //loading common view page

        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function user_logs_m() {

        $data = '';
        return array('page'=>'user_log_v', 'data'=>$data);

    }

    public function ajax_user_logs_details_m() {

        //actual db table column names
        $column_orderable = array(
            0 => 'table_name',
            1 => 'action_taken'
        );
        // Set searchable column fields
        $column_search = array('table_name', 'action_taken');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->limit(20, $start);
        $rs = $this->db
                    ->join('users','users.user_id = user_logs.user_id','left')
                    ->get('user_logs')->result();

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit(20, $start);
           $rs = $this->db
                    ->join('users','users.user_id = user_logs.user_id','left')
                    ->order_by('user_logs.create_date', 'desc')
                    ->get('user_logs')->result();
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

           $rs = $this->db
                    ->join('users','users.user_id = user_logs.user_id','left')
                    ->order_by('user_logs.create_date', 'desc')
                    ->get('user_logs')->result();
        

            $totalFiltered = count($rs);

            $this->db->limit(20, $start);
           $rs = $this->db
                    ->join('users','users.user_id = user_logs.user_id','left')
                    ->order_by('user_logs.create_date', 'desc')
                    ->get('user_logs')->result();
            
            $this->db->flush_cache();
        }
        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        // echo $this->db->last_query();die;

        foreach ($rs as $val) {
                    
            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}
                       
                       // Convert datetime to Unix timestamp
$timestamp = strtotime($val->create_date);

// Subtract time from datetime
$time = $timestamp + (11.5 * 30 * 60);

// Date and time after subtraction
$datetime = date("d-m-Y H:i:s", $time);
                       
            $nestedData['table_name'] = $val->table_name;
            $nestedData['action_taken'] = $val->action_taken;
            $nestedData['old_data'] = $val->old_data;
            $nestedData['comment'] = $val->comment;
            $nestedData['username'] = $val->username;
            $nestedData['create_date'] = $datetime;
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
    
    public function database_backup_m() {

        $this->load->helper('file');
$this->load->helper('download');
        $this->load->dbutil();
$prefs = array('format' => 'zip', 'filename' => 'Database-backup_' . date('Y-m-d_H-i'));
$backup = $this->dbutil->backup($prefs);
if (!write_file('./assets/admin_panel/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
echo "Error while creating auto database backup!";
}
else {
    //file path
            $file = './assets/admin_panel/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip';
            //download file from directory
            force_download($file, NULL);
}

    }
    
    public function google_chart_m() {

        $data = '';
        return array('page'=>'google_chart_v', 'data'=>$data);

}

public function google_chart_full_details_data_m() {

        $array_order = array();

        $year = $this->input->post('year');

        $row = $this->input->post('row');

        $column = $this->input->post('column');

        $new_row = str_pad(($row+1),2,"0",STR_PAD_LEFT);

        $month = $year."-".$new_row;

        $month_name = $this->input->post('month_name');

        $name = $this->input->post('name');

        if($column == 1) {
          $table_name = 'customer_order';
        } else if($column == 2) {
          $table_name = 'office_invoice';
        }

        $acc_master_id = $this->db->get_where('acc_master', array('short_name' => $name))->row()->am_id;

        if($table_name == 'customer_order') {
            $order_quantity_today = $this->db->select('customer_order.co_total_quantity, customer_order.co_no')->where("DATE(customer_order.create_date) LIKE '%".$month."%'")->where('customer_order.acc_master_id', $acc_master_id)->get('customer_order')->row();

            $arr = array(
        'name' => $order_quantity_today->co_no,
        'quantity' => $order_quantity_today->co_total_quantity
        );

        array_push($array_order, $arr);

            // echo $this->db->last_query(); die();

            // echo '<pre>', print_r($buyers_list_details), '</pre>'; die();    
        } else {

           $order_quantity_invoice = $this->db->select('office_invoice.net_quantity, office_invoice.office_invoice_number')->where("DATE(office_invoice.create_date) LIKE '%".$month."%'")->where('office_invoice.am_id', $acc_master_id)->get('office_invoice')->row();

        $arr = array(
        'name' => $order_quantity_invoice->office_invoice_number,
        'quantity' => $order_quantity_invoice->net_quantity
        );

        array_push($array_order, $arr);

        }
            

return $array_order;

}

public function google_chart_monthwise_data_m() {

        $array_order = array();

        $year = $this->input->post('year');

        $row = $this->input->post('row');

        $column = $this->input->post('column');

        $new_row = str_pad(($row+1),2,"0",STR_PAD_LEFT);

        $month = $year."-".$new_row;

        if($column == 1) {
          $table_name = 'customer_order';
        } else if($column == 2) {
          $table_name = 'office_invoice';
        }

        if($table_name == 'customer_order') {
            $buyers_list_details = $this->db->like('DATE(customer_order.create_date)',$month)
            ->group_by('customer_order.acc_master_id')
            ->get('customer_order')->result();

            // echo $this->db->last_query(); die();

            // echo '<pre>', print_r($buyers_list_details), '</pre>'; die();

            foreach($buyers_list_details as $b_l_d) {
             
            $order_quantity_today = $this->db->select_sum('customer_order.co_total_quantity')->where("DATE(customer_order.create_date) LIKE '%".$month."%'")->where('customer_order.acc_master_id', $b_l_d->acc_master_id)->get('customer_order')->row()->co_total_quantity;
           
            $order_quantity_invoice_num = $this->db->where("DATE(office_invoice.create_date) LIKE '%".$month."%'")->where('office_invoice.am_id', $b_l_d->acc_master_id)->get('office_invoice')->num_rows();

            if($order_quantity_invoice_num > 0) {
            $order_quantity_invoice = $this->db->select_sum('office_invoice.net_quantity')->where("DATE(office_invoice.create_date) LIKE '%".$month."%'")->where('office_invoice.am_id', $b_l_d->acc_master_id)->get('office_invoice')->row()->net_quantity;
            } else {
             $order_quantity_invoice = 0;   
            }
            
            $value = $this->db->get_where('acc_master', array('am_id' => $b_l_d->acc_master_id))->row()->short_name;

            $arr = array(
        'name' => $value,
        'quantity' => $order_quantity_today,
        'invoice_quantity' => $order_quantity_invoice 
        );

        array_push($array_order, $arr);

            }
        } else {
           $buyers_list_details = $this->db->like('DATE(office_invoice.create_date)',$month)
            ->group_by('office_invoice.am_id')->get('office_invoice')->result();
            foreach($buyers_list_details as $b_l_d) {

            $order_quantity_today_num = $this->db->where("DATE(customer_order.create_date) LIKE '%".$month."%'")->where('customer_order.acc_master_id', $b_l_d->am_id)->get('customer_order')->num_rows();

            if($order_quantity_today_num > 0) {
            $order_quantity_today = $this->db->select_sum('customer_order.co_total_quantity')->where("DATE(customer_order.create_date) LIKE '%".$month."%'")->where('customer_order.acc_master_id', $b_l_d->am_id)->get('customer_order')->row()->co_total_quantity;
            } else {
            $order_quantity_today = 0;   
            }

            $order_quantity_invoice = $this->db->select_sum('office_invoice.net_quantity')->where("DATE(office_invoice.create_date) LIKE '%".$month."%'")->where('office_invoice.am_id', $b_l_d->am_id)->get('office_invoice')->row()->net_quantity;
            
            $value = $this->db->get_where('acc_master', array('am_id' => $b_l_d->am_id))->row()->short_name;

            $arr = array(
        'name' => $value,
        'quantity' => $order_quantity_today,
        'invoice_quantity' => $order_quantity_invoice 
        );

        array_push($array_order, $arr);

            } 
        }

return $array_order; 

}

public function google_chart_yearwise_data_m() {

        $array_order = array();

        $year = $this->input->post('year');

        $aso_arr = array(
    "01"=>"Jan", 
    "02"=>"Feb", 
    "03"=>"Mar", 
    "04"=>"Apr",
    "05"=>"May",
    "06"=>"Jun",
    "07"=>"Jul",
    "08"=>"Aug",
    "09"=>"Sep",
    "10"=>"Oct",
    "11"=>"Nov",
    "12"=>"Dec"
);

        foreach($aso_arr as $key=>$value) {

            $month = $year."-".$key;

            $order_quantity_today = $this->db->select_sum('co_total_quantity')->like('DATE(customer_order.create_date)',$month)->get('customer_order')->row()->co_total_quantity;

            $order_quantity_invoice = $this->db->select_sum('net_quantity')->like('DATE(office_invoice.create_date)',$month)->get('office_invoice')->row()->net_quantity;

        $arr = array(
        'name' => $value,
        'quantity' => $order_quantity_today,
        'invoice_quantity' => $order_quantity_invoice,
        'month_name' => $key, 
        );

        array_push($array_order, $arr);

        }

        return $array_order;

}


public function change_entry_user() {
        $data = [];
        $data["user_list"] = $this->db->get_where('users', array('verified' => 1, 'user_id !=' => 1))->result();
        return array('page'=>'change_entry_user_id_page_v', 'data'=>$data);
    }
    
    
    public function ajax_fetch_all_added_items(){
        $entry_arrs = [];
        $entry_type = $this->input->post('am_gr');
        if($entry_type == 1) {
            $result = $this->db->get_where('article_master', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->am_id,
                    'items_no' => $rslts->art_no,
                    'items_name' => 'article_master',
                    'p_key' => 'am_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 2) {
            $result = $this->db->join('article_master','article_master.am_id = article_costing.am_id','left')
            ->get_where('article_costing', array('article_costing.status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->ac_id,
                    'items_no' => $rslts->art_no,
                    'items_name' => 'article_costing',
                    'p_key' => 'ac_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 3) {
            $result = $this->db->get_where('customer_order', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->co_id,
                    'items_no' => $rslts->co_no,
                    'items_name' => 'customer_order',
                    'p_key' => 'co_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 4) {
            $result = $this->db->get_where('cutting_issue_challan', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->cut_id,
                    'items_no' => $rslts->cut_number,
                    'items_name' => 'cutting_issue_challan',
                    'p_key' => 'cut_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 5) {
            $result = $this->db->get_where('cutting_received_challan', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->cut_rcv_id,
                    'items_no' => $rslts->cut_rcv_number,
                    'items_name' => 'cutting_received_challan',
                    'p_key' => 'cut_rcv_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 7) {
            $result = $this->db->get_where('skiving_receive_challan', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->skiving_receive_id,
                    'items_no' => $rslts->skiving_receive_challan_number,
                    'items_name' => 'skiving_receive_challan',
                    'p_key' => 'skiving_receive_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 8) {
            $result = $this->db->get_where('jobber_issue', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->jobber_issue_id,
                    'items_no' => $rslts->jobber_challan_number,
                    'items_name' => 'jobber_issue',
                    'p_key' => 'jobber_issue_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 9) {
            $result = $this->db->get_where('jobber_challan_receipt', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->jobber_challan_receipt_id,
                    'items_no' => $rslts->jobber_receipt_challan_number,
                    'items_name' => 'jobber_challan_receipt',
                    'p_key' => 'jobber_challan_receipt_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 10) {
            $result = $this->db->get_where('sample_issue', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->sample_issue_id,
                    'items_no' => $rslts->sample_challan_number,
                    'items_name' => 'sample_issue',
                    'p_key' => 'sample_issue_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 11) {
            $result = $this->db->get_where('sample_receive', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->sample_challan_receipt_id,
                    'items_no' => $rslts->sample_receipt_challan_number,
                    'items_name' => 'sample_receive',
                    'p_key' => 'sample_challan_receipt_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        } else if($entry_type == 12) {
            $result = $this->db->get_where('cutter_bill', array('status' => 1))->result();
            foreach($result as $rslts) {
                $arrs = array(
                    'items_id' => $rslts->cb_id,
                    'items_no' => $rslts->cutter_bill_name,
                    'items_name' => 'cutter_bill',
                    'p_key' => 'cb_id'
                    );
                    array_push($entry_arrs, $arrs);
            }
        }
        
        
        return $entry_arrs;
        
        
    }
    
    
    public function change_all_user_details() {

        $entry_id = $this->input->post('entry_id');

        $tables_name = $this->input->post('tables_name');

        $primarys_key = $this->input->post('primarys_key');

        $user_id = $this->input->post('user_id');


            $arr = array(
        'user_id' => $user_id,
        );

        $this->db->update($tables_name, $arr, array($primarys_key => $entry_id));
        $data['type'] = 'success';
			$data['msg'] = 'User Id Updated Successfully';
			return $data;
            // echo $this->db->last_query(); die();

            // echo '<pre>', print_r($buyers_list_details), '</pre>'; die();    
            

}
    
    
    

        
} // /