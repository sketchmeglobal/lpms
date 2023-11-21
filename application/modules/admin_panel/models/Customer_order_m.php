<?php

class Customer_order_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
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

    public function log_before_update($post_array,$primary_key, $table_name){
        $insertArray = array(
            'table_name' => $table_name,
            'pk_id' => $primary_key,
            'action_taken'=>'edit', 
            'old_data' => json_encode($post_array),
            'user_id' => $this->session->user_id,
            'comment' => 'customer order'
        );
        if($this->db->insert('user_logs', $insertArray)){
            return true;
        }else{
            return false;
        }
    }

    public function check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name){
        // echo $table_name . ' || ' . $pk_field_name . ' || ' . $primary_key;die;
        // $item_exists = 0;
        foreach($reference_array as $ra){
            $nr = $this->db->get_where($ra['tbl_name'], array($ra['tbl_pk_fld'] => $primary_key))->num_rows();
            if($nr > 0){
                $item_exists = 1;
            }
        }
        // print_r($this->reference_array);die;        

        if($item_exists == 0){
            return false;
        } else{
            $user_data = $this->db->where($pk_field_name, $primary_key)->get($table_name)->row();
            $insertArray = array(
                'table_name' => $table_name,
                'pk_id' => $primary_key,
                'action_taken'=>'delete', 
                'old_data' => json_encode($user_data),
                'user_id' => $this->session->user_id,
                'comment' => 'customer order'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function customer_order() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(15, $this->session->user_id);
        $module_permission = $this->_dept_wise_module_permission(1, $this->session->user_id); #1 = costing module_id
        if($module_permission == 'show'){

            $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();  
        }else{
            $data['co_ids'] = $this->db->join('user_details','user_details.user_id = customer_order.user_id','left')->order_by('co_no')->get_where('customer_order', array('status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }  
        $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1))->result();
        return array('page'=>'customer_order/customer_order_list_v', 'data'=>$data);
    }

    public function ajax_customer_order_table_data() {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'co_no',
            1 => 'buyer_reference_no',
            2 => 'customer_name',
            7 => 'status',
        );
        // Set searchable column fields
        $column_search = array('co_no','buyer_reference_no','name');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('customer_order')->result();
        if($module_permission == 'show'){
                $rs = $this->db->get('customer_order')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = customer_order.user_id','left')
                    ->get_where('customer_order', array('user_details.user_dept' => $module_permission))->result();
            }
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('co_id, co_no, buyer_reference_no, name as customer_name, DATE_FORMAT(co_delivery_date, "%d-%m-%Y") as co_delivery_date, DATE_FORMAT(co_date, "%d-%m-%Y") as co_date, co_total_amount, co_total_quantity, customer_order.status, DATE_FORMAT(customer_order.shipment_date, "%d-%m-%Y") as shipment_date');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get_where('customer_order', array('customer_order.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = customer_order.user_id','left')
                    ->get_where('customer_order', array('user_details.user_dept' => $module_permission, 'customer_order.status' => '1'))->result();
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

            $this->db->select('co_id, co_no, buyer_reference_no, name as customer_name, DATE_FORMAT(co_delivery_date, "%d-%m-%Y") as co_delivery_date, DATE_FORMAT(co_date, "%d-%m-%Y") as co_date, co_total_amount, co_total_quantity, customer_order.status, DATE_FORMAT(customer_order.shipment_date, "%d-%m-%Y") as shipment_date');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->where('customer_order.status', 1);
            if($module_permission == 'show'){
                $rs = $this->db->get_where('customer_order', array('customer_order.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = customer_order.user_id','left')
                    ->get_where('customer_order', array('user_details.user_dept' => $module_permission, 'customer_order.status' => '1'))->result();
            }
            // echo $this->db->get_compiled_select('customer_order');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('co_id, co_no, buyer_reference_no, name as customer_name, DATE_FORMAT(co_delivery_date, "%d-%m-%Y") as co_delivery_date, DATE_FORMAT(co_date, "%d-%m-%Y") as co_date, co_total_amount, co_total_quantity, customer_order.status, DATE_FORMAT(customer_order.shipment_date, "%d-%m-%Y") as shipment_date');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('customer_order', array('customer_order.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = customer_order.user_id','left')
                    ->get_where('customer_order', array('user_details.user_dept' => $module_permission, 'customer_order.status' => '1'))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        // echo $this->db->last_query();die;

        foreach ($rs as $val) {

            // if($val->img){$img='<img src="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'" width="50">';} else{$img='';}

            // check if order is present in cutting issue / proforma details

            $nrows = $this->db->get_where('cutting_issue_challan_details', array('co_id' => $val->co_id))->num_rows();
            $nrows1 = $this->db->get_where('office_proforma_detail', array('co_id' => $val->co_id))->num_rows();
            
            $nrows_sum = 0;
            
            $nrows_sum_rows = $this->db->select('*')->get_where('customer_order_dtl', array('co_id' => $val->co_id, 'status' => 1))->result();
            foreach($nrows_sum_rows as $n_s) {
            $nrows_sum += ($n_s->co_quantity * $n_s->co_price);
            }

            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['co_no'] = $val->co_no;
            $nestedData['buyer_reference_no'] = $val->buyer_reference_no;
            $nestedData['customer_name'] = $val->customer_name;
            $nestedData['co_date'] = $val->co_date;
            $nestedData['co_delivery_date'] = $val->co_delivery_date;
            $nestedData['shipment_date'] = $val->shipment_date;
            $nestedData['co_total_quantity'] = $val->co_total_quantity;
            $nestedData['co_total_amount'] = $nrows_sum;
            $nestedData['status'] = $status;
            $uvp = $this->_user_wise_view_permission(3, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '
            <a href="'. base_url('admin/edit-customer-order/'.$val->co_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a target="_blank" href="'. base_url('admin/print-customer-order-consumption/'.$val->co_id) .'" class="btn btn-primary"><i class="fa fa-print"></i> Consumption</a>
            ';
            if($nrows == 0 and $nrows1 == 0){
                $nestedData['action'] .= '<a del-id="'.$val->co_id.'" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            }
            }
            
            // <a target="_blank" href="'. base_url('admin/full-order-history/'.$val->co_id) .'" class="btn btn-warning"><i class="fa fa-info-circle"></i> History</a>
            // <a href="'. base_url('admin/delete_article_costing/'.$val->co_id) .'" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
            
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

// ADD CUSTOMER ORDER

public function ajax_fetch_customer_order_details_total_value() {
    $val = $this->input->post('val');
    $result = $this->db->select('SUM(co_quantity * co_price) AS total_values')->get_where('customer_order_dtl', array('co_id' => $val))->row()->total_values;
    return $result;
}


    public function add_customer_order() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result(); // Sundry Debtors

        return array('page'=>'customer_order/customer_order_add_v', 'data'=>$data);
    }

    public function ajax_fetch_article_colours($am_id, $lc_id){
        
        if($lc_id == 'false'){
            return $this->db
                ->select('c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                    c2.color as fitting_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_costing.combination_or_not')
                ->join('colors c1', 'c1.c_id = article_dtl.lth_color_id', 'left')
                ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
                ->join('article_master', 'article_master.am_id = article_dtl.am_id', 'left')
                ->join('article_costing', 'article_costing.am_id = article_master.am_id', 'left')
                ->get_where('article_dtl', array('article_dtl.am_id' => $am_id))
                ->result();
        }else{
            return $this->db
                ->select('c2.color as fitting_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_costing.combination_or_not')
                ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
                ->get_where('article_dtl', array('article_dtl.am_id' => $am_id, 'article_dtl.lth_color_id' => $lc_id))
                ->join('article_master', 'article_master.am_id = article_dtl.am_id', 'left')
                ->join('article_costing', 'article_costing.am_id = article_master.am_id', 'left')
                ->result();
        }
        
    }
    
   public function ajax_fetch_article_colour_new($am_id, $lc_id, $co_id){

        $cust_number = $this->db->get_where('customer_order_dtl', array('co_id' => $co_id, 'am_id' => $am_id, 'lc_id' => $lc_id))->num_rows();
        
        if($cust_number == 0) {
            return $this->db
                ->select('c2.color as fitting_color, c2.c_code as fitting_code, c2.c_id as fitting_id')
                ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
                ->get_where('article_dtl', array('article_dtl.am_id' => $am_id, 'article_dtl.lth_color_id' => $lc_id))
                ->result();
    } else {
        return false;
    }
        
    }
    
    public function ajax_fetch_article_rate_on_type($am, $ptype){
        if($ptype == 'Ex-works Price'){
            $type = 'exworks_amt';
        }else if($ptype == 'C&F Price'){
            $type = 'cf_amt';
        }else if($ptype == 'CIF Price'){
            $type = 'cf_amt';
        }else{
            $type = 'fob_amt';
        } 
        $res = $this->db
            ->get_where('article_master', array('am_id' => $am))
            ->result();
            if(isset($res[0])){
                return $res[0]->$type;
            }else{
                return 0;
            }
    }

    public function ajax_unique_customer_order_number() {
        $order_no = $this->input->post('order_no');
        $rs = $this->db->get_where('customer_order', array('co_no' => $order_no))->num_rows();
        // echo $this->db->last_query();die;
        
        if($rs != '0') {
            $data = 'Order no. already exists.';
        }else{
            $data='true';
        }

        return $data;
    }

    public function form_add_customer_order(){

        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/customer_order/';
            $config['allowed_types'] = 'docx|doc|xlx|pdf|gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 3072;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $insertArray = array(
                    'co_no' => $this->input->post('order_no'),
                    'acc_master_id' => $this->input->post('acc_master_id'),
                    'buyer_reference_no' => $this->input->post('buyref'),
                    'co_date' => $this->input->post('order_date'),
                    'co_reference_date' => $this->input->post('ref_date'),
                    'co_delivery_date' => $this->input->post('delv_date'),
                    'co_price_type' => $this->input->post('rate_type'),
                    'img' => $uploaded_data['file_name'],
                    'co_remarks' => $this->input->post('remarks'),
                    'show_in_outstanding_report_or_not' => $this->input->post('show_in_outstanding_report'),
                    'shipment_date' => $this->input->post('shipment_date'),
                    'shipment_date2' => $this->input->post('shipment_date2'),
                    'user_id' => $this->session->user_id,
                    'create_date' => date('Y-m-d H:i:s', time()),
                    'modify_date' => date('Y-m-d H:i:s', time())
                );
                
            }
        }else{
            $insertArray = array(
                'co_no' => $this->input->post('order_no'),
                'acc_master_id' => $this->input->post('acc_master_id'),
                'buyer_reference_no' => $this->input->post('buyref'),
                'co_date' => $this->input->post('order_date'),
                'co_reference_date' => $this->input->post('ref_date'),
                'co_delivery_date' => $this->input->post('delv_date'),
                'co_price_type' => $this->input->post('rate_type'),
                'co_remarks' => $this->input->post('remarks'),
                'show_in_outstanding_report_or_not' => $this->input->post('show_in_outstanding_report'),
                'shipment_date' => $this->input->post('shipment_date'),
                'shipment_date2' => $this->input->post('shipment_date2'),
                'user_id' => $this->session->user_id,
                'create_date' => date('Y-m-d H:i:s', time()),
                'modify_date' => date('Y-m-d H:i:s', time())
            );
        }

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('customer_order', $insertArray);

        $data['insert_id'] = $this->db->insert_id();
        $data['type'] = 'success';
        $data['msg'] = 'Customer order added successfully.';
        return $data;
    }

    public function edit_customer_order($co_id) {
        $data['article_masters'] = $this->db->select('am_id, art_no')->get_where('article_master', array('article_master.status' => 1))->result_array();
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        $data['colors_details'] = $this->db->select('*')->get_where('colors', array('status' => 1))->result_array();
        $data['customer_order_details'] = $this->db
                ->select('customer_order.*, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left')
                ->get_where('customer_order', array('customer_order.co_id' => $co_id))
                ->result();
        return array('page'=>'customer_order/customer_order_edit_v', 'data'=>$data);
    }

    public function ajax_customer_order_details_table_data() {
        $customer_order_id = $this->input->post('customer_order_id');
        //actual db table column names
        $column_orderable = array(
            0 => 'article_master.art_no',
            1 => 'customer_order_dtl.lc_id'
        );
        // Set searchable column fields
        $column_search = array('article_master.art_no','customer_order_dtl.co_buy_reference');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('customer_order_dtl', array('co_id' => $customer_order_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks,customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, customer_order_dtl.lc_id asc')->get_where('customer_order_dtl', array('co_id' => $customer_order_id))->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
            // exit();
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

            $this->db->select('customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks,customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, customer_order_dtl.lc_id asc')->get_where('customer_order_dtl', array('co_id' => $customer_order_id))->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks,customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, customer_order_dtl.lc_id asc')->get_where('customer_order_dtl', array('co_id' => $customer_order_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {

            // Show delete button Only if COD_ID is not presnet in the cutting_received_challan_detail
            $already_received = $this->db->get_where('cutting_received_challan_detail', array('cod_id' => $val->cod_id))->num_rows();

            $article = $val->art_no; 
            $nestedData['art_no'] = $article;
            $nestedData['lc_id'] = $val->leather_color;
            $nestedData['fc_id'] = $val->fitting_color;
            $nestedData['co_quantity'] = $val->co_quantity;
            $nestedData['co_price'] = $val->co_price;
            $nestedData['amount'] = $val->co_quantity * $val->co_price;
            $nestedData['co_buy_reference'] = ($val->co_buy_reference == '') ? '-' : $val->co_buy_reference;

            if($already_received){

                $nestedData['action'] = '<a href="javascript:void(0)" cod_id="'.$val->cod_id.'" class="customer_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <a href="javascript:void(0)" cod_id="'.$val->cod_id.'" class="brk_up_history btn btn-success">Ord. No./Delv. Dt.</a>
            <a href="javascript:void(0)" class="btn bg-danger-fade" title="Already received in part or full"><i class="fa fa-times"></i> Delete</a>';

            }else{
                $nestedData['action'] = '<a href="javascript:void(0)" cod_id="'.$val->cod_id.'" class="customer_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <a href="javascript:void(0)" cod_id="'.$val->cod_id.'" class="brk_up_history btn btn-success">Ship. Dt. Brkup.</a>
            <a data-tab="customer_order_details" data-pk="'.$val->cod_id.'" proforma_status="'.$val->proforma_status.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function ajax_fetch_customer_order_breakup_details_on_pk() {
        $cod_id = $this->input->post('cod_id');
        //actual db table column names
        $column_orderable = array(
            0 => 'cust_order_brk_up.co_quantity',
            1 => 'cust_order_brk_up.ord_date'
        );
        // Set searchable column fields
        $column_search = array('cust_order_brk_up.co_quantity','cust_order_brk_up.ord_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('cust_order_brk_up', array('cod_id' => $cod_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cust_order_brk_up.cod_id, cust_order_brk_up.co_quantity,cust_order_brk_up.ord_date,cust_order_brk_up.remarks,
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no, cust_order_brk_up.id');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('cust_order_brk_up', array('cust_order_brk_up.cod_id' => $cod_id))->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
            // exit();
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

            $this->db->select('cust_order_brk_up.cod_id, cust_order_brk_up.co_quantity,cust_order_brk_up.ord_date,cust_order_brk_up.remarks,
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no, cust_order_brk_up.id');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('cust_order_brk_up', array('cust_order_brk_up.cod_id' => $cod_id))->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cust_order_brk_up.cod_id, cust_order_brk_up.co_quantity,cust_order_brk_up.ord_date,cust_order_brk_up.remarks,
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no, cust_order_brk_up.id');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('cust_order_brk_up', array('cust_order_brk_up.cod_id' => $cod_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {

            $article = $val->art_no; 
            $nestedData['art_no'] = $article;
            $nestedData['lc_id'] = $val->leather_color;
            $nestedData['fc_id'] = $val->fitting_color;
            $nestedData['co_quantity'] = $val->co_quantity;
            $nestedData['ord_date'] = date("d-m-Y", strtotime($val->ord_date));
            $nestedData['remarks'] = $val->remarks;


                $nestedData['action'] = '<a href="javascript:void(0)" id="'.$val->id.'" class="customer_details_brkup_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a data-tab="cust_order_brk_up" data-pk="'.$val->id.'" proforma_status="0" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function ajax_fetch_customer_order_details_brkup_qnty(){

        $val = $this->input->post("val");
        $cod_id = $this->input->post("cod_id");
        
        $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.cod_id' => $cod_id))->row();

        $actual_quantity = $rs->co_quantity;

        $rs_details = $this->db->get_where('cust_order_brk_up', array('cust_order_brk_up.cod_id' => $cod_id))->num_rows();

        if($rs_details > 0) {
            $added_quantity = $this->db->select("SUM(co_quantity) as co_quantity")->get_where('cust_order_brk_up', array('cust_order_brk_up.cod_id' => $cod_id))->row()->co_quantity;
        } else {
            $added_quantity = 0;
        }

        $data['left_qantity'] = ($actual_quantity - $added_quantity);

        return $data;
    }  

    public function form_add_customer_order_details(){
        
        $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $this->input->post('order_id'), 'customer_order_dtl.am_id' => $this->input->post('am_id'), 'customer_order_dtl.lc_id' => $this->input->post('lc_id'), 'customer_order_dtl.fc_id' => $this->input->post('fc_id'), 'customer_order_dtl.co_quantity' => $this->input->post('article_quantity')))->num_rows();
        
        if($rs == 0) {
            $insertArray = array(
                'co_id' => $this->input->post('order_id'),
                'am_id' => $this->input->post('am_id'),
                'lc_id' => $this->input->post('lc_id'),
                'fc_id' => $this->input->post('fc_id'),
                'co_quantity' => $this->input->post('article_quantity'),
                'co_price' => $this->input->post('article_rate'),
                'co_buy_reference' => $this->input->post('buyer_reference'),
                'co_remarks' => $this->input->post('article_remarks'),
                'user_id' => $this->session->user_id,
                'combination_colors' => implode(',',$this->input->post('cc_id'))
            );
            // echo '<pre>', print_r($insertArray), '</pre>';die;
            $this->db->insert('customer_order_dtl', $insertArray);
            $data['insert_id'] = $this->db->insert_id();

            $data['total_qnty'] = $this->db->select_sum('co_quantity')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result()[0]->co_quantity;
            $data['total_amount'] = $this->db->select_sum('co_price')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result()[0]->co_price;
            
            $co_id = $this->input->post('order_id');
            $office_proforma_status = 0;
            $updateArray = array(
                'office_proforma_status' => $office_proforma_status,
            );
            $this->db->update('customer_order', $updateArray, array('co_id' => $co_id));

            // update customer order table 
            $updateArray= array(
                'co_total_amount' => $data['total_amount'],
                'co_total_quantity' => $data['total_qnty'],
                'cutting_status' => 0
            );
            $this->db->update('customer_order', $updateArray, array('co_id' => $this->input->post('order_id')));
            // echo $this->db->last_query();die;
            
            // Update proforma table if new entry found in existing proforma
            
            $office_proforma_status =  $this->db->get_where('customer_order', array('co_id' => $this->input->post('order_id')))->result()[0]->office_proforma_status;
            $proforma_id_counts =  $this->db->get_where('office_proforma_detail', array('co_id' => $this->input->post('order_id')))->num_rows();
            // echo $this->Db->last_query();die;
            $data['msg'] = '';
            if(count($proforma_id_counts) > 0) {
                $insertArray1 = array(
                'co_id' => $this->input->post('order_id'),
                'comment' => 'Add',
                'am_id' => $this->input->post('am_id'),
                'lc_id' => $this->input->post('lc_id'),
                'fc_id' => $this->input->post('fc_id'),
                'co_quantity' => $this->input->post('article_quantity'),
                'co_price' => $this->input->post('article_rate'),
                'co_buy_reference' => $this->input->post('buyer_reference'),
                'co_remarks' => $this->input->post('article_remarks'),
                'user_id' => $this->session->user_id
            );
            // echo '<pre>', print_r($insertArray), '</pre>';die;
            $this->db->insert('temp_customer_order_dtl', $insertArray1);
        }

        // Insert combination colour table
        if(!empty($this->input->post('cc_id'))){
            // $this->db->where('cod_id',$data['insert_id'])->delete('customer_order_combination_article_colors');
            foreach($this->input->post('cc_id') as $c_id){
                $comb_insert_arr = array(
                    'co_id' => $this->input->post('order_id'),
                    'cod_id' => $data['insert_id'],
                    'c_id' => $c_id
                );
                $this->db->insert('customer_order_combination_article_colors', $comb_insert_arr);   
            }
        }


    //     if($office_proforma_status){

    //         $proforma_id =  $this->db->get_where('office_proforma_detail', array('co_id' => $this->input->post('order_id')))->result()[0]->office_proforma_id;

    //         $proformaInsertArray = array(
    //             'office_proforma_id' => $proforma_id,
    //             'co_id' => $this->input->post('order_id'),
    //             'cod_id' => $data['insert_id'],
    //             'am_id' => $this->input->post('am_id'),
    //             'lc_id' => $this->input->post('lc_id'),
    //             'fc_id' => $this->input->post('fc_id'),
    //             'co_quantity' => $this->input->post('article_quantity'),
    //             'rate_inr' => 0.0,
    //             'rate_foreign' => 0.0,
    //             'total_rate' => 0.0,
    //             'user_id' => $this->session->user_id
    //         );

    //         $this->db->insert('office_proforma_detail', $proformaInsertArray);
    //         $data['msg'] .= 'Proforma details updated successfully';
    //   }
        }
        
        $data['type'] = 'success';
        $data['msg'] .= 'Customer order details added successfully.';
        // echo '<pre>', print_r($data), '</pre>';die;

        // leather consumption area 
        // item details wise costing details 

        // $rs = $this->db->select('*')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result();
        // echo $this->db->last_query();
        // leather consumtion area ends 
        return $data;
    }

    public function form_add_customer_order_brkup_details(){
        
        $insertArray = array(
            'cod_id' => $this->input->post('cod_brk_up_id'),
            'co_quantity' => $this->input->post('article_brk_up_quantity'),
            'ord_date' => $this->input->post('article_brk_up_date'),
            'remarks' => $this->input->post('article_brk_up_remarks'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('cust_order_brk_up', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        
        $data['type'] = 'success';
        $data['msg'] = 'Customer order breakup details added successfully.';
        // echo '<pre>', print_r($data), '</pre>';die;

        // leather consumption area 
        // item details wise costing details 

        // $rs = $this->db->select('*')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result();
        // echo $this->db->last_query();
        // leather consumtion area ends 
        return $data;
    }

    public function ajax_fetch_customer_order_details_on_pk(){
        $cod_id = $this->input->post('cod_id');
        return 
        $this->db
            ->select('article_master.am_id, customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,
            customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, customer_order_dtl.combination_colors,
            c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, 
            c2.color as fitting_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
            article_master.art_no, article_master.alt_art_no, customer_order.cutting_status')
            // ->join('colors c1', 'c1.c_id = article_dtl.fc_id', 'left')
            ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
            ->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left')
            ->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left')
            ->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left')
            ->get_where('customer_order_dtl', array('customer_order_dtl.cod_id' => $cod_id))->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
    }

    public function ajax_fetch_customer_order_details_brkup_edit(){
        $id = $this->input->post('id');
        return $this->db->select('article_master.am_id, customer_order_dtl.cod_id,  cust_order_brk_up.co_quantity,customer_order_dtl.co_price,
        customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, 
        c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, 
        c2.color as fitting_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
        article_master.art_no, article_master.alt_art_no, customer_order.cutting_status, cust_order_brk_up.ord_date, cust_order_brk_up.remarks, cust_order_brk_up.id')
        // ->join('colors c1', 'c1.c_id = article_dtl.fc_id', 'left')
        ->join('customer_order_dtl', 'customer_order_dtl.cod_id = cust_order_brk_up.cod_id', 'left')
        ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
        ->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left')
        ->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left')
        ->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left')
        ->get_where('cust_order_brk_up', array('cust_order_brk_up.id' => $id))->result();
        // echo $this->db->get_compiled_select('customer_order_dtl');
    }

    public function form_edit_customer_order_details(){
        $data['msg'] = '';

        $old_array = $this->db->get_where('customer_order_dtl', array('cod_id' => $this->input->post('order_details_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('order_details_id'), 'customer_order');

        $insertArray = array(
            // 'am_id' => $this->input->post('am_id'),
            // 'lc_id' => $this->input->post('lc_id'),
            // 'fc_id' => $this->input->post('fc_id'),
            'co_quantity' => $this->input->post('article_quantity'),
            'co_price' => $this->input->post('article_rate'),
            'co_buy_reference' => $this->input->post('buyer_reference'),
            'co_remarks' => $this->input->post('article_remarks'),
            'combination_colors' => (!empty($this->input->post('cc_id_edit'))) ? implode(',',$this->input->post('cc_id_edit')) : NULL,
            'user_id' => $this->session->user_id
        );
        $cod_id = $this->input->post('order_details_id');
        
        // Check if the qnty is changed then cutting issue should be opened
        $quantity_same = $this->db->get_where('customer_order_dtl', array('cod_id' => $cod_id, 'co_quantity' => $this->input->post('article_quantity')))->num_rows();

        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->update('customer_order_dtl', $insertArray, array('cod_id' => $cod_id));
        // echo $this->db->last_query();die;

        $data['total_qnty'] = $this->db->select_sum('co_quantity')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result()[0]->co_quantity;
        $data['total_amount'] = $this->db->select_sum('co_price')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result()[0]->co_price;
        
        // update customer order table 
        if($quantity_same){
            $updateArray= array(
                'co_total_amount' => $data['total_amount'],
                'co_total_quantity' => $data['total_qnty']
            );
        }else{
            $updateArray= array(
                'co_total_amount' => $data['total_amount'],
                'co_total_quantity' => $data['total_qnty'],
                'cutting_status' => 0
            );    
        }
        
        $this->db->update('customer_order', $updateArray, array('co_id' => $this->input->post('order_id')));

        $data['type'] = 'success';
        $data['msg'] .= 'Customer order details updated successfully.';

        // check if proforma is already made
        $nr = $this->db->get_where('office_proforma_detail', array('cod_id' => $this->input->post('order_details_id')))->num_rows();
        // echo $this->db->last_query();die;
        if($nr > 0){
            
            $old_array_values = $this->db->get_where('customer_order_dtl', array('cod_id' => $this->input->post('order_details_id')))->row();
            
            $insertArray1 = array(
                'co_id' => $old_array_values->co_id,
                'comment' => 'Edited',
                'am_id' => $old_array_values->am_id,
                'lc_id' => $old_array_values->lc_id,
                'fc_id' => $old_array_values->fc_id,
                'co_quantity' => $old_array_values->co_quantity,
                'co_price' => $old_array_values->co_price,
                'co_buy_reference' => $old_array_values->co_remarks,
                'co_remarks' => $old_array_values->co_remarks,
                'user_id' => $this->session->user_id
            );
            // echo '<pre>', print_r($insertArray), '</pre>';die;
            $this->db->insert('temp_customer_order_dtl', $insertArray1);
        }

        // Update combination colour table - del and insert all
        if(!empty($this->input->post('cc_id_edit'))){
            $this->db->where('cod_id',$cod_id)->delete('customer_order_combination_article_colors');
            foreach($this->input->post('cc_id_edit') as $c_id){
                $comb_insert_arr = array(
                    'co_id' => $this->input->post('order_id'),
                    'cod_id' => $cod_id,
                    'c_id' => $c_id
                );
                $this->db->insert('customer_order_combination_article_colors', $comb_insert_arr);   
            }
        }

        return $data;
    }

    public function form_edit_customer_order_details_brkup(){
        $data['msg'] = '';

        $insertArray = array(
            // 'am_id' => $this->input->post('am_id'),
            // 'lc_id' => $this->input->post('lc_id'),
            // 'fc_id' => $this->input->post('fc_id'),
            'co_quantity' => $this->input->post('article_brk_up_quantity_edit'),
            'ord_date' => $this->input->post('article_brk_up_date_edit'),
            'remarks' => $this->input->post('article_brk_up_remarks_edit'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->update('cust_order_brk_up', $insertArray, array('id' => $this->input->post('order_id_brkup')));

        $data['type'] = 'success';
        $data['msg'] = 'Customer order breakup details updated successfully.';

        return $data;
    }

    public function ajax_unique_customer_order_no(){
        $customer_order_id = $this->input->post('customer_order_id');
        $order_no = $this->input->post('order_no');

        $rs = $this->db->get_where('customer_order', array('co_no' => $order_no, 'co_id <>' => $customer_order_id))->num_rows();
        if($rs != '0') {
            $data = 'Order no. already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_edit_customer_order(){

        $old_array = $this->db->get_where('customer_order', array('co_id' => $this->input->post('order_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('order_id'), 'customer order');
        
        $nr = $this->db->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->num_rows();
        if($nr > 0){
            $total_qnty = $this->db->select_sum('co_quantity')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result()[0]->co_quantity;    
        }else{
            $total_qnty = 0;
        }
        
        if (!empty($_FILES)) {
            $config['upload_path'] = 'assets/admin_panel/img/customer_order/';
            $config['allowed_types'] = 'docx|doc|xlx|pdf|gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 3072;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) { //if file upload unsuccessful
                $data['type'] = 'error';
                $data['title'] = 'Error!';
                $data['msg'] = $this->upload->display_errors();
                return $data;
            } else { //if file upload successful
                $uploaded_data = $this->upload->data();
                $updateArray = array(
                    'co_no' => $this->input->post('order_no'),
                    'acc_master_id' => $this->input->post('acc_master_id'),
                    'buyer_reference_no' => $this->input->post('buyref'),
                    'co_date' => date('Y-m-d', strtotime($this->input->post('order_date'))),
                    'co_reference_date' => date('Y-m-d', strtotime($this->input->post('ref_date'))),
                    'co_delivery_date' => date('Y-m-d', strtotime($this->input->post('delv_date'))),
                    'co_price_type' => $this->input->post('rate_type'),
                    'co_total_quantity' => $total_qnty,
                    'co_remarks' => $this->input->post('remarks'),
                    'show_in_outstanding_report_or_not' => $this->input->post('show_in_outstanding_report'),
                    'shipment_date' => $this->input->post('shipment_date'),
                    'shipment_date2' => $this->input->post('shipment_date2'),
                    'store_for_next_year' => $this->input->post('store_for_next_year'),
                    'office_proforma_status' => $this->input->post('office_proforma_status'),
                    'img' => $uploaded_data['file_name'],
                    'status' => $this->input->post('status'),
                    'user_id' => $this->session->user_id,
                    'modify_date' => date('Y-m-d H:i:s', time())
                );
                
            }
        }else{
            $updateArray = array(
                'co_no' => $this->input->post('order_no'),
                'acc_master_id' => $this->input->post('acc_master_id'),
                'buyer_reference_no' => $this->input->post('buyref'),
                'co_date' => date('Y-m-d', strtotime($this->input->post('order_date'))),
                'co_reference_date' => date('Y-m-d', strtotime($this->input->post('ref_date'))),
                'co_delivery_date' => date('Y-m-d', strtotime($this->input->post('delv_date'))),
                'co_price_type' => $this->input->post('rate_type'),
                'co_total_quantity' => $total_qnty,
                'co_remarks' => $this->input->post('remarks'),
                'show_in_outstanding_report_or_not' => $this->input->post('show_in_outstanding_report'),
                'shipment_date' => $this->input->post('shipment_date'),
                'shipment_date2' => $this->input->post('shipment_date2'),
                'store_for_next_year' => $this->input->post('store_for_next_year'),
                'office_proforma_status' => $this->input->post('office_proforma_status'),
                'status' => $this->input->post('status'),
                'user_id' => $this->session->user_id,
                'modify_date' => date('Y-m-d H:i:s', time())
            );
        }
        
        $this->db->update('customer_order_dtl', array('proforma_status' => $this->input->post('office_proforma_status')), array('co_id' => $this->input->post('order_id')));
        $this->db->update('customer_order', $updateArray, array('co_id' => $this->input->post('order_id')));

        // echo $this->db->last_query(); die;

        $data['type'] = 'success';
        $data['msg'] = 'Customer order updated successfully.';
        $data['msg'] .= '<hr>Customer order details updated successfully.';
        $data['custom_qnty'] = $total_qnty .'.00';
        return $data;

    }

    public function ajax_del_row_on_table_and_pk_customer_order(){
        $pk = $this->input->post('pk');
        $tab = $this->input->post('tab');

        if($tab != 'cust_order_brk_up') {

        $primary_key = $this->input->post('pk');
        $table_name = 'customer_order_dtl';
        $pk_field_name = 'cod_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "customer_order_dtl",
                    "tbl_pk_fld" => "cod_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

        if($tab == 'customer_order_details'){
            
            // check if proforma is already made
        $nr = $this->db->get_where('office_proforma_detail', array('cod_id' => $pk))->num_rows();
        // echo $this->db->last_query();die;
        if($nr > 0){
            
            $old_array_values = $this->db->get_where('customer_order_dtl', array('cod_id' => $pk))->row();
            
            $insertArray1 = array(
            'co_id' => $old_array_values->co_id,
            'comment' => 'Deleted',
            'am_id' => $old_array_values->am_id,
            'lc_id' => $old_array_values->lc_id,
            'fc_id' => $old_array_values->fc_id,
            'co_quantity' => $old_array_values->co_quantity,
            'co_price' => $old_array_values->co_price,
            'co_buy_reference' => $old_array_values->co_remarks,
            'co_remarks' => $old_array_values->article_remarks,
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('temp_customer_order_dtl', $insertArray1);
        }
            
            $table = 'customer_order_dtl';
            $this->db->where('cod_id', $pk)->delete($table);
            $this->db->where('cod_id', $pk)->delete('cust_order_brk_up');
        }
        
        $proforma_status = $this->input->post('proforma_status');
        $cod_id = $pk;
        
        
        $data['total_qnty'] = $this->db->select_sum('co_quantity')->get_where('customer_order_dtl', array('co_id' => $this->input->post('co_id')))->result()[0]->co_quantity;
        $data['total_amount'] = $this->db->select_sum('co_price')->get_where('customer_order_dtl', array('co_id' => $this->input->post('co_id')))->result()[0]->co_price;
        
        // update customer order table 
        $updateArray= array(
            'co_total_amount' => $data['total_amount'],
            'co_total_quantity' => $data['total_qnty']
        );
        $this->db->update('customer_order', $updateArray, array('co_id', $this->input->post('co_id')));

        } else {

        $table = 'cust_order_brk_up';
        $this->db->where('id', $pk)->delete($table);

        }

        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Item Successfully Deleted';
        return $data;
    }

    public function ajax_unique_co_no_and_art_no_and_lth_color(){
        $customer_order_id = $this->input->post('customer_order_id');
        $lc_id = $this->input->post('lc_id');
        $am_id = $this->input->post('am_id');
        $customer_order_detail_id = $this->input->post('customer_order_detail_id');

        $rs = $this->db->get_where('customer_order_dtl', array('lc_id' => $lc_id,'am_id' => $am_id, 'co_id' => $customer_order_id, 'cod_id <>' => $customer_order_detail_id))->num_rows();
        if($rs != '0') {
            $data = 'Leather colour exists for this article.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function print_customer_order_consumption($co_id){
        $this->db->empty_table('temp_consumption');
        
        $this->db->query("SET SQL_BIG_SELECTS=1");

        $data_array = array();
        $order_query = "SELECT
            `customer_order_dtl`.*,
            `article_costing`.`combination_or_not`,
            `item_dtl`.`im_id`
        FROM
            `customer_order_dtl`
        LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
        LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
        LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
        WHERE
            `co_id` = $co_id
        GROUP BY
            `customer_order_dtl`.`co_id`,
            `customer_order_dtl`.`lc_id`,
            `item_dtl`.`im_id`
            ORDER BY
            im_id";
        $order_colour_res = $this->db->query($order_query)->result(); 

        // echo $this->db->last_query(); die();

        // echo $order_colour_res; die();

        // echo '<pre>', print_r($order_colour_res), '</pre>'; die();

        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption')->result();
foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
}
}


        
            }
        
            }
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
      return $this->db->order_by('ig_id, item_name, item_color')->get('temp_consumption')->result();
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();

        
        
    }
    
    public function remove_customer_order_image($co_id){
        
        $data_update['img'] = '';
        return $this->db->update('customer_order', $data_update, array('co_id' => $co_id));
        
    }
    
    public function order_consumption_group_by(){
        $co_id = implode (",", $this->input->post('customer_order'));
        $it_id = $this->input->post('group');
        if($co_id != '' && $it_id != '') {
        $this->db->empty_table('temp_consumption');

        $data_array = array();
        $order_query = "SELECT
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`,
    `item_master`.`ig_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
WHERE
    `co_id` IN ($co_id) AND `ig_id` = $it_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this->db->query($order_query)->result(); 

        // echo $this->db->last_query(); die();

        // echo $order_colour_res; die();

        // echo '<pre>', print_r($order_colour_res), '</pre>'; die();

        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
            $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $o_c_r->co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption')->result();
foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total 
        );

        $this->db->update('temp_consumption', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption', $arr);
}
}


        
            }
        
            }
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
      return $this->db->order_by('ig_id, item_name, lc_id')->get('temp_consumption')->result();
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();

        } else {
            echo 'No details to show'; die();
        }  
        
    }

    public function ajax_customer_order_delete(){
        $id = $this->input->post('id');
        
        $primary_key = $this->input->post('id');
        $table_name = 'customer_order';
        $pk_field_name = 'co_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "customer_order",
                    "tbl_pk_fld" => "co_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
       
       $cust_array = [];
       
       $custs_rows_status = $this->db->get_where('customer_order_dtl', array('co_id' => $id))->result();
       
       foreach($custs_rows_status as $c_r_s) {
           
           array_push($cust_array, $c_r_s->cod_id);
           
       }
        
        $this->db->where_in('cod_id', implode (",", $cust_array))->delete('cust_order_brk_up');
        $this->db->where('co_id', $id)->delete('customer_order_dtl');
        $this->db->where('co_id', $id)->delete('customer_order');
        
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Customer Order Successfully Deleted';
        return $data;
    }

// CUSTOMER ORDER ENDS 

}