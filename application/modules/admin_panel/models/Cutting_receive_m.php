<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last updated on 19-03-2021 at 10:15am
 */

class Cutting_receive_m extends CI_Model {

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
            'comment' => 'cutting receive'
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
                'comment' => 'cutting receive'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function cutting_receive() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(5, $this->session->user_id);
        return array('page'=>'cutting_receive/cutting_receive_list_v', 'data'=>$data);
    }

    public function ajax_cutting_receive_table_data() {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #1 = cutting module_id

            // echo '<pre>', print_r($module_permission), '</pre>'; die();

        //actual db table column names
        $column_orderable = array(
            0 => 'am_id',
            1 => 'cut_rcv_number',
            2 => 'cut_rcv_date'
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'cutting_received_challan.cut_rcv_number', 'cutting_received_challan.cut_rcv_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('cutting_received_challan')->result();
            } else {
                #module_permission contains the dept id now
    $rs = $this->db
          ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
          ->where_in('user_details.user_dept', $module_permission)
          ->get('cutting_received_challan')->result();
            }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');

        if($module_permission == 'show'){
    $rs = $this->db->order_by('cut_rcv_number')->get_where('cutting_received_challan', array('acc_master.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
    $rs = $this->db
          ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
          ->where_in('user_details.user_dept', $module_permission)
          ->order_by('cut_rcv_number')
          ->get_where('cutting_received_challan', array('acc_master.status' => '1'))->result();
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

            $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');

    if($module_permission == 'show'){
    $rs = $this->db->order_by('cut_rcv_number')->get_where('cutting_received_challan', array('acc_master.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
    $rs = $this->db
          ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
          ->where_in('user_details.user_dept', $module_permission)
          ->order_by('cut_rcv_number')
          ->get_where('cutting_received_challan', array('acc_master.status' => '1'))->result();
      }

            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');

    if($module_permission == 'show'){
    $rs = $this->db->order_by('cut_rcv_number')->get_where('cutting_received_challan', array('acc_master.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
    $rs = $this->db
          ->order_by('cut_rcv_number')
          ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
          ->where_in('user_details.user_dept', $module_permission)
          ->get_where('cutting_received_challan', array('acc_master.status' => '1'))->result();
        }
            
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        // echo $this->db->last_query();die;

        foreach ($rs as $val) {


            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $temp_co_no = '';
            $cutting_received_id = $val->cut_rcv_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left')
            ->group_by('cutting_received_challan_detail.cut_rcv_id')
            ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cutting_received_id, 'cutting_received_challan_detail.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $nestedData['cut_rcv_id'] = $val->cut_rcv_id;
            $nestedData['am_id'] = $val->am_id;
            $nestedData['acc_master_name'] = $val->acc_master_name.'['.$val->acc_master_short_name.']';
            $nestedData['cut_rcv_number'] = $val->cut_rcv_number;
            $nestedData['cut_rcv_date'] = $val->cut_rcv_date;
            $nestedData['order_no'] = $temp_co_no;

            $nestedData['receive_cut_quantity'] = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail',array('cut_rcv_id' => $val->cut_rcv_id))->result()[0]->receive_cut_quantity;

            $uvp = $this->_user_wise_view_permission(5, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                 $nestedData['action'] = '<a href="'. base_url('admin/edit-cutting-receive/'.$val->cut_rcv_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="'. base_url('admin/cutting-receive-challan-print') .'/'.$val->cut_rcv_id .'" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</a>
            <a href="javascript:void(0)" pk-name="cut_rcv_id" pk-value="'.$val->cut_rcv_id.'" tab="cutting_received_challan" child="1" ref-pk-name="cut_rcv_id#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    //Open Add Form
    public function add_cutting_receive() {
        $data = [];
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();
        
        return array('page'=>'cutting_receive/cutting_receive_add_v', 'data'=>$data);
    }

    /*public function ajax_unique_supp_purchase_order_no(){
        $supp_po_number = $this->input->post('supp_po_number');

        $rs = $this->db->get_where('supp_purchase_order', array('supp_po_number' => $supp_po_number))->num_rows();
        if($rs != '0') {
            $data = 'Supp.Purchase order no already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }*/
    
    //Add main header info
    public function form_add_receive_challan(){
        $data = [];
        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'cut_rcv_number' => $this->input->post('cut_rcv_number'),
            'cut_rcv_date' => $this->input->post('cut_rcv_date'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('cutting_received_challan', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        if($this->db->insert_id() > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Cutting Receive added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted successfully.';
        }
        return $data;
    }
    
    //Get data before edit
    public function edit_cutting_receive($cut_rcv_id) {
        $data = [];
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();
        
        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

        

        if($module_permission == 'show'){
         $data['customer_order'] = $this->db->select('co_id, co_no')
         ->get_where('customer_order', array( 'customer_order.status' => 1))->result();
         } else {
                #module_permission contains the dept id now
          $data['customer_order'] = $this->db->select('co_id, co_no')
          ->join('user_details','user_details.user_id = customer_order.user_id','left')
          ->get_where('customer_order', array( 'customer_order.status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        
        $data['cutting_receive_details'] = $this->db
                ->select('cutting_received_challan.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left')
                ->get_where('cutting_received_challan', array('cutting_received_challan.cut_rcv_id' => $cut_rcv_id))
                ->result();
        $data['receive_cut_quantity'] = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail',array('cut_rcv_id' => $cut_rcv_id))->result()[0]->receive_cut_quantity;                
        return array('page'=>'cutting_receive/cutting_receive_edit_v', 'data'=>$data);
    }

    public function form_edit_cutting_receive(){
        $data = [];
        $old_array = $this->db->get_where('cutting_received_challan', array('cut_rcv_id' => $this->input->post('cut_rcv_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('cut_rcv_id'), 'cutting_received_challan');

        $updateArray = array(
            'am_id' => $this->input->post('am_id'),
            'cut_rcv_number' => $this->input->post('cut_rcv_number'),
            'cut_rcv_date' => $this->input->post('cut_rcv_date'),
            'user_id' => $this->session->user_id
        );
        $cut_rcv_id = $this->input->post('cut_rcv_id');
        
        $this->db->update('cutting_received_challan', $updateArray, array('cut_rcv_id' => $cut_rcv_id));

        $data['type'] = 'success';
        $data['msg'] = 'Cutting Receive updated successfully.';

        return $data;

    }

    public function ajax_cutting_receive_challan_details_table_data() {
       
       $cut_rcv_id = $this->input->post('cut_rcv_id');
        //actual db table column names table th order

       // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

        $column_orderable = array(
            0 => 'customer_order.co_no',
            // 2 => 'cutting_issue_challan.cut_number'
        );
        // Set searchable column fields
        $column_search = array('receive_cut_quantity');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        
        if($module_permission == 'show'){
         $rs = $this->db->order_by('art_no, c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
         } else {
                #module_permission contains the dept id now
          $rs = $this->db->order_by('art_no, c2.color')
          ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
          ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'user_details.user_dept' => $module_permission))->result();
        }

        // $rs = $this->db->get('cutting_received_challan_detail')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
            $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
            
         if($module_permission == 'show'){
         $rs = $this->db->order_by('art_no, c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
         } else {
                #module_permission contains the dept id now
          $rs = $this->db->order_by('art_no, c2.color')
          ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
          ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'user_details.user_dept' => $module_permission))->result();
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

             $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
            $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
            
        if($module_permission == 'show'){
         $rs = $this->db->order_by('art_no, c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
         } else {
                #module_permission contains the dept id now
          $rs = $this->db->order_by('art_no, c2.color')
          ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
          ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'user_details.user_dept' => $module_permission))->result();
        }
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
            $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
            
        if($module_permission == 'show'){
         $rs = $this->db->order_by('art_no, c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
         } else {
                #module_permission contains the dept id now
          $rs = $this->db->order_by('art_no, c2.color')
          ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
          ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'user_details.user_dept' => $module_permission))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['customer_order_no'] = $val->co_no;
            $nestedData['buyer_reference_number'] = $val->buyer_reference_no;
            $nestedData['cutting_challan_number'] = $val->cut_number;
            $nestedData['article_number'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['fitting_color'] = $val->fitting_color;
            $nestedData['issue_quantity'] = $val->co_quantity;
            $nestedData['receive_quantity'] = $val->receive_cut_quantity;
            $nestedData['action'] = '
             <!--<a href="javascript:void(0)" cut_rcv_detail_id="'.$val->cut_rcv_detail_id.'" class="cutting_received_challan_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>-->
            <a tab="cutting_received_challan_detail" tab-pk="cut_rcv_detail_id" data-pk="'.$val->cut_rcv_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function ajax_fetch_cutting_receive_challan_details_on_pk(){
        $cut_rcv_detail_id = $this->input->post('cut_rcv_detail_id');
        $data = array();
        
        $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        
        return $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_detail_id' => $cut_rcv_detail_id))->result()[0];
        
        //return $data;
    }
    
    public function form_edit_issue_receive_details(){
        $data = [];
        $cut_rcv_detail_id = $this->input->post('cut_rcv_detail_id');
        $receive_cut_quantity_edit = $this->input->post('receive_cut_quantity_edit');
        
        $updateArray = array(
            'receive_cut_quantity' => $this->input->post('receive_cut_quantity_edit'),
            'user_id' => $this->session->user_id
        );
        
        
        $this->db->update('cutting_received_challan_detail', $updateArray, array('cut_rcv_detail_id' => $cut_rcv_detail_id));
        $data['type'] = 'success';
        $data['msg'] = 'Receive challan details updated successfully.';
        return $data;
    }
    
    
    
    public function get_customer_order_dtl_cutting_receive(){
        $co_id = $this->input->post('co_id');
        $data = [];
        
        $buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
        
        $data['buyer_reference_no'] = $buyer_reference_no;
        
        $this->db->select('cutting_issue_challan.cut_id, cutting_issue_challan.cut_number');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_issue_challan_details.cut_id', 'left');
        $this->db->group_by('cutting_issue_challan_details.cut_id');
        $challans = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id' => $co_id))->result();
        //echo $this->db->last_query(); die;
        $data['challans'] = $challans;
            
    return $data;
    
    }
    
    public function ajax_get_article_detail(){
        $cut_id = $this->input->post('cut_id');
        $co_id = $this->input->post('co_id');
        
        $this->db->select('cutting_issue_challan_details.cod_id, cutting_issue_challan_details.fc_id, cutting_issue_challan_details.lc_id, article_master.am_id, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id');
        $this->db->join('article_master', 'article_master.am_id = cutting_issue_challan_details.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_issue_challan_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_issue_challan_details.lc_id', 'left');
        $articles = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id, 'cutting_issue_challan_details.co_id' => $co_id))->result();
        
        $new_articles = array();
        for($i = 0; $i < sizeof($articles); $i++){
            $am_id = $articles[$i]->am_id;
            $lc_id = $articles[$i]->lc_id;
            
            $cut_co_quantity = $this->db->select_sum('cut_co_quantity')->get_where('cutting_issue_challan_details', array('co_id' => $co_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'cut_id' => $cut_id))->result()[0]->cut_co_quantity;
            
            //echo 'Article: '.$articles[$i]->art_no.' cut quantity: '.$cut_co_quantity."<br/>";
            
            if($cut_co_quantity > 0){
                array_push($new_articles, $articles[$i]);
            }
        }//end for
        
        return $new_articles;
    }//end function
    
    public function ajax_get_issue_quantity_and_article_detail(){
        $cod_id = $this->input->post('cod_id');
        $cut_id = $this->input->post('cut_id');
        //$cod_id = $this->input->post('cod_id');
        
        $data = [];
        $data['entry_status']  = 1;

        $this->db->select('cutting_issue_challan_details.co_id, cutting_issue_challan_details.cod_id, cutting_issue_challan_details.cut_co_quantity, cutting_issue_challan_details.fc_id, cutting_issue_challan_details.lc_id, article_master.am_id as article_master_id, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id');
        $this->db->join('article_master', 'article_master.am_id = cutting_issue_challan_details.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_issue_challan_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_issue_challan_details.lc_id', 'left');
        $article = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cod_id' => $cod_id, 'cutting_issue_challan_details.cut_id' => $cut_id))->result();
        
        if(empty($article)){
            $data['entry_status']  = 0;
            $co_id = null;
            $am_id = null;
            $lc_id = null;
            $cut_co_quantity = null;
        } else{
            //cut_co_quantity
            $article = $article[0];
            $co_id = $article->co_id;
            $am_id = $article->article_master_id;
            $lc_id = $article->leather_id;
            
            $cut_co_quantity = $this->db->select_sum('cut_co_quantity')->get_where('cutting_issue_challan_details', array('co_id' => $co_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'cut_id' => $cut_id))->result()[0]->cut_co_quantity;
            $article->cut_co_quantity = $cut_co_quantity;
        }
                
        $data['article'] = $article;
        
        $num_rows = $this->db->select('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('co_id' => $co_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'cut_id' => $cut_id))->num_rows();
        
        if($num_rows > 0){      // duplicate entry
            $receive_quantity = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('co_id' => $co_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'cut_id' => $cut_id))->result()[0]->receive_cut_quantity;
            $data['entry_status']  = 0;
        }else{
            $receive_quantity = 0;
        }
        
        $remain_receive_quantity = ($cut_co_quantity - $receive_quantity);
        $data['receive_quantity'] = $remain_receive_quantity;
        
        return $data;
    }
    
    
    public function ajax_all_colors_on_item_master(){
        $item_id = $this->input->post('item_id');
        $this->db->select('item_dtl.id_id as item_dtl_id, colors.*');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_dtl.im_id' => $item_id, 'color <>' => null))->result_array();
    }
    
    public function ajax_all_purchase_order(){
        $data = [];
        $pur_order_date = $this->input->post('pur_order_date');
        $rs = $this->db->get_where('purchase_order', array('purchase_order.po_date >= ' => $pur_order_date, 'purchase_order.status' => '1'))->num_rows();
        $all_po = $this->db->get_where('purchase_order', array('purchase_order.po_date >= ' => $pur_order_date, 'purchase_order.status' => '1'))->result_array();
        
        if($rs > 0){
            $data['status'] = true;
            $data['all_po'] = $all_po;
        }else{
            $data['status'] = false;
            $data['message'] = 'No Purchase order available';
            $data['all_po'] = array();
        }
        return $data;
    }
    
    public function form_add_cutting_receive_challan_details(){
        
        $data = [];
        
        $cut_rcv_id = $this->input->post('cut_rcv_id');
        $co_id = $this->input->post('co_id');
        $buyer_reference_no = $this->input->post('buyer_reference_no');
        $cut_id = $this->input->post('cut_id');         
        $cod_id = $this->input->post('cod_id');
        $lc_id = $this->input->post('lc_id');
        $fc_id = $this->input->post('fc_id');
        $cut_co_quantity = $this->input->post('cut_co_quantity');
        $receive_cut_quantity = $this->input->post('receive_cut_quantity');
        $article_master_id = $this->input->post('article_master_id');
        
//  $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cod_id' => $cod_id, 'cutting_received_challan_detail.cut_id' => $cut_id, 'cutting_received_challan_detail.am_id' => $article_master_id, 'cutting_received_challan_detail.lc_id' => $lc_id, 'cutting_received_challan_detail.status' => '1'))->num_rows();

        
        /*** New code ****/
//      if($rs == 0) {
        $insertArray = array(
            'cut_rcv_id' => $cut_rcv_id,
            'co_id' => $co_id,
            'cod_id' => $cod_id,
            'buyer_reference_no' => $buyer_reference_no,
            'cut_id' => $cut_id,
            'am_id' => $article_master_id,
            'fc_id' => $fc_id,
            'lc_id' => $lc_id,
            'receive_cut_quantity' => $receive_cut_quantity,
            'user_id' => $this->session->user_id
        );
        $this->db->insert('cutting_received_challan_detail', $insertArray);
        $insert_id = $this->db->insert_id();
//      }
        
        /* Old Code
        $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cod_id' => $cod_id, 'cutting_received_challan_detail.status' => '1'))->num_rows();
        
        if($rs > 0){
            $receive_cut_quantity_old = $this->db->select('cutting_received_challan_detail.receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cod_id' => $cod_id, 'cutting_received_challan_detail.status' => '1'))->result()[0]->receive_cut_quantity;
            
            $receive_cut_quantity_new = ($receive_cut_quantity + $receive_cut_quantity_old);
            $updateArray = array(
                'receive_cut_quantity' => $receive_cut_quantity_new
            );
            
            $this->db->update('cutting_received_challan_detail', $updateArray, array('cod_id' => $cod_id));
            $insert_id = $cod_id;
        }else{
            $insertArray = array(
                'cut_rcv_id' => $cut_rcv_id,
                'co_id' => $co_id,
                'cod_id' => $cod_id,
                'buyer_reference_no' => $buyer_reference_no,
                'cut_id' => $cut_id,
                'am_id' => $article_master_id,
                'fc_id' => $fc_id,
                'lc_id' => $lc_id,
                'receive_cut_quantity' => $receive_cut_quantity,
                'user_id' => $this->session->user_id
            );
            $this->db->insert('cutting_received_challan_detail', $insertArray);
            $insert_id = $this->db->insert_id();
        }*/
        
        $data['insert_id'] = $insert_id;
        
        if($insert_id > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Cutting Receive Challan Details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Cutting Receive Challan  Details not added successfully.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    

    public function purchase_order_print_with_code($po_id){
        
        $data = [];
        
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') // 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_groups.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
        return array('page'=>'purchase_order/purchase_order_print_with_code_v', 'data'=>$data);
    }

    public function purchase_order_print_without_code($po_id){
        $data = [];
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') // 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_groups.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
        return array('page'=>'purchase_order/purchase_order_print_without_code_v', 'data'=>$data);
    }


    public function form_edit_supp_purchase_order_details(){
        $data = [];
        $total_amount = 0;
        $pod_quantity_edit = $this->input->post('pod_quantity_edit');
        $pod_rate_edit = $this->input->post('pod_rate_edit');
        $total_amount = ($pod_quantity_edit * $pod_rate_edit);
        
        $updateArray = array(
            'item_qty' => $this->input->post('pod_quantity_edit'),
            'item_rate' => $this->input->post('pod_rate_edit'),
            'total_amount' => $total_amount,
            'sup_pod_remarks' => $this->input->post('pod_remarks_edit'),
            'user_id' => $this->session->user_id
        );
        $sup_id = $this->input->post('sup_id');
        $supp_dtl_id = $this->input->post('supp_dtl_id');
        
        $this->db->update('supp_purchase_order_detail', $updateArray, array('supp_dtl_id' => $supp_dtl_id));

        $data['pod_total'] = $this->db->select_sum('total_amount')->get_where('supp_purchase_order_detail', array('sup_id' => $sup_id))->result()[0]->total_amount;
        // update purchase order table 
        $updateArray1= array(
            'supp_po_total' => $data['pod_total']
        );
        $this->db->update('supp_purchase_order', $updateArray1, array('sup_id' => $sup_id));

        $data['type'] = 'success';
        $data['msg'] = 'Supp.purchase order details updated successfully.';
        return $data;
    }
    
    

    public function ajax_unique_purchase_order_number() {
        $order_no = $this->input->post('order_no');
        $rs = $this->db->get_where('purchase_order', array('co_no' => $order_no))->num_rows();
        // echo $this->db->last_query();die;
        
        if($rs != '0') {
            $data = 'Order no. already exists.';
        }else{
            $data='true';
        }

        return $data;
    }
    /**
    <a href="javascript:void(0)" pk-name="cut_id" pk-value="'.$val->cut_id.'" tab="cutting_issue_challan" child="1" ref-table="cutting_issue_challan_detail" ref-pk-name="cut_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
    **/

    public function delete_cutting_receive_details(){
        $data = [];
        $tab = $this->input->post('tab');
        $pk_name = $this->input->post('pk_name');
        $pk_value = $this->input->post('pk_value');

        $primary_key = $this->input->post('pk_value');
        $table_name = $this->input->post('tab');
        $pk_field_name = $this->input->post('pk_name');
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $this->input->post('tab'),
                    "tbl_pk_fld" => $this->input->post('pk_name'),
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
        
        $this->db->where($pk_name, $pk_value)->delete('cutting_received_challan_detail');
        $this->db->where($pk_name, $pk_value)->delete($tab);
        
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting Receive Challan Successfully Deleted';
        return $data;
    }
    
    public function delete_cutting_receive_challan_details_list(){
        $data = [];
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $data_pk = $this->input->post('data_pk');

        $primary_key = $this->input->post('data_pk');
        $table_name = $this->input->post('tab');
        $pk_field_name = $this->input->post('tab_pk');
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $this->input->post('tab'),
                    "tbl_pk_fld" => $this->input->post('tab_pk'),
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
        
        $this->db->where($tab_pk, $data_pk)->delete($tab);
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting receive challan detail list deleted successfully';
        return $data;
    }
    
    public function cutting_receive_challan_print($cut_rcv_id){
        $this->db->select('acc_master.name, acc_master.address,DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") AS cut_rcv_date,cutting_received_challan.cut_rcv_number, cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
        $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id', 'left');
        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        
        $res = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        // echo $this->db->last_query();
        return $res;
    }
    
    public function cutting_receive_print_multiple(){
     $data = [];
     
     
     $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 2, 'user_id' => $this->session->user_id))->result(); #2 = cutting receive
     
     
        if($this->input->post('cutting_receive_print')) {
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'blank_row' => $this->input->post('blank_row'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                $this->db->insert('page_setup', $setup_array);
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            $cut_rcpt_challan = $this->input->post('cut_rcpt_challan[]');
            // echo '<pre>', print_r($cut_rcpt_challan), '</pre>'; die();
            $data['datam'] = $this->_fetch_cutting_receive_print_multiple($cut_rcpt_challan);
            return array('page'=>'cutting_receive/cutting_receive_print_multiple_page_v','data'=>$data);
        }
        
        if($this->input->post('cutting_receive_print_with_cost_and_rate')) {
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'blank_row' => $this->input->post('blank_row'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                $this->db->insert('page_setup', $setup_array);
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            $cut_rcpt_challan = $this->input->post('cut_rcpt_challan[]');
            // echo '<pre>', print_r($cut_rcpt_challan), '</pre>'; die();
            $data['datam'] = $this->_fetch_cutting_receive_print_multiple_with_cost($cut_rcpt_challan);
            return array('page'=>'cutting_receive/cutting_receive_print_multiple_page_with_cost_v','data'=>$data);
        }
        
        if($this->input->post('cutting_receive_print_with_cost_and_rate_b')) {
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'blank_row' => $this->input->post('blank_row'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                $this->db->insert('page_setup', $setup_array);
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            $cut_rcpt_challan = $this->input->post('cut_rcpt_challan[]');
            // echo '<pre>', print_r($cut_rcpt_challan), '</pre>'; die();
            $data['datam'] = $this->_fetch_cutting_receive_print_multiple_with_cost_b($cut_rcpt_challan);
            return array('page'=>'cutting_receive/cutting_receive_print_multiple_page_with_cost_b_v','data'=>$data);
        }
        

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

            if($module_permission == 'show'){
                
         $data['fetch_all_challan'] = $this->db->order_by('cut_rcv_number')->get_where('cutting_received_challan', array('status' => 1))->result();
         } else {
                #module_permission contains the dept id now
          $data['fetch_all_challan'] = $this->db->order_by('cut_rcv_number')
          ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
          ->get_where('cutting_received_challan', array('cutting_received_challan.status' => 1,'user_details.user_dept' => $module_permission))->result();
        }

        return array('page'=>'cutting_receive/cutting_receive_print_multiple', 'data'=>$data);   
    }

    public function _fetch_cutting_receive_print_multiple($cut_rcpt_challan){
        
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 2, 'user_id' => $this->session->user_id))->result(); #2 = cutting receive
        

        $this->db->select('acc_master.name, acc_master.address,DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") AS cut_rcv_date,cutting_received_challan.cut_rcv_number, cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
        $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id', 'left');
        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        $this->db->order_by('cutting_received_challan.cut_rcv_id, article_master.art_no, c2.color, c1.color');
        
        $res = $this->db->where_in('cutting_received_challan_detail.cut_rcv_id', $cut_rcpt_challan)->order_by('customer_order.co_id')->get_where('cutting_received_challan_detail')->result();
        // echo $this->db->last_query();
        return $res;

    }
    
    public function _fetch_cutting_receive_print_multiple_with_cost($cut_rcpt_challan){
        
        
        $data = [];
	    if($this->input->post()){
            
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'blank_row' => $this->input->post('blank_row'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                $this->db->insert('page_setup', $setup_array);
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            
            
        }
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 2, 'user_id' => $this->session->user_id))->result(); #2 = cutting receive
        

        $this->db->select('acc_master.name, acc_master.address,DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") AS cut_rcv_date,cutting_received_challan.cut_rcv_number,article_master.am_id, cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_rates.currency_rate, article_parts.quantity, article_master.cutting_rate_a');
            
        $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id', 'left');
        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('article_rates', 'article_rates.am_id = article_master.am_id', 'left');
        $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left'); 
        $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        $this->db->where('article_parts.ig_id !=', 1);
        $this->db->order_by('cutting_received_challan.cut_rcv_id, article_master.art_no, c2.color, c1.color');
        $this->db->group_by('cutting_received_challan_detail.cut_rcv_detail_id');
        
        $res = $this->db->where_in('cutting_received_challan_detail.cut_rcv_id', $cut_rcpt_challan)->order_by('customer_order.co_id')->get_where('cutting_received_challan_detail')->result();
        // echo $this->db->last_query();
        return $res;

    }
    
    public function _fetch_cutting_receive_print_multiple_with_cost_b($cut_rcpt_challan){
        
        
        $data = [];
	    if($this->input->post()){
            
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'blank_row' => $this->input->post('blank_row'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                $this->db->insert('page_setup', $setup_array);
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            
            
        }
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 2, 'user_id' => $this->session->user_id))->result(); #2 = cutting receive
        

        $this->db->select('acc_master.name, acc_master.address,DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") AS cut_rcv_date,cutting_received_challan.cut_rcv_number, cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_rates.currency_rate, article_parts.quantity, article_master.cutting_rate_b');
            
        $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id', 'left');
        $this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
        $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
        $this->db->join('article_rates', 'article_rates.am_id = article_master.am_id', 'left');
        $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        $this->db->where('article_parts.ig_id', 1);
        $this->db->order_by('cutting_received_challan.cut_rcv_id, article_master.art_no, c2.color, c1.color');
        $this->db->group_by('cutting_received_challan_detail.cut_rcv_detail_id');
        
        $res = $this->db->where_in('cutting_received_challan_detail.cut_rcv_id', $cut_rcpt_challan)->order_by('customer_order.co_id')->get_where('cutting_received_challan_detail')->result();
        // echo $this->db->last_query();
        return $res;

    }
    
    
    public function cutter_bill() {
        $data = '';
        return array('page'=>'cutter_bill/cutter_bill_list_v', 'data'=>$data);
    }
    
    public function ajax_cutter_bill_table_data(){

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'cutter_bill_name',
            2 => 'cutter_bill_date'
        );
        // Set searchable column fields
        $column_search = array('cutter_bill_name');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('cutter_bill')->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = cutter_bill.user_id','left')
          ->get_where('cutter_bill', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('cutter_bill.*, DATE_FORMAT(cutter_bill.cutter_bill_date, "%d-%m-%Y") as cutter_bill_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left');
            
        if($module_permission == 'show'){
                $rs = $this->db->get_where('cutter_bill', array('cutter_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = cutter_bill.user_id','left')
          ->get_where('cutter_bill', array('user_details.user_dept' => $module_permission, 'cutter_bill.status => 1'))->result();
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

            $this->db->select('cutter_bill.*, DATE_FORMAT(cutter_bill.cutter_bill_date, "%d-%m-%Y") as cutter_bill_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('cutter_bill', array('cutter_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = cutter_bill.user_id','left')
          ->get_where('cutter_bill', array('user_details.user_dept' => $module_permission, 'cutter_bill.status => 1'))->result();
        }
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('cutter_bill.*, DATE_FORMAT(cutter_bill.cutter_bill_date, "%d-%m-%Y") as cutter_bill_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('cutter_bill', array('cutter_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = cutter_bill.user_id','left')
          ->get_where('cutter_bill', array('user_details.user_dept' => $module_permission, 'cutter_bill.status => 1'))->result();
        }
            
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}
            
            $temp_co_no = '';
            $jobber_issue_id = $val->cb_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = cutter_bill_dtl.co_id', 'left')
            ->group_by('cutter_bill_dtl.co_id')
            ->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $jobber_issue_id, 'cutter_bill_dtl.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $nestedData['cutter_bill_name'] = $val->cutter_bill_name;
            $nestedData['cutter_issue'] = '-';
            $nestedData['cutter_rcv'] = '-';
            $nestedData['cutter_bill_date'] = $val->cutter_bill_date;
            $nestedData['cutter_bill_supplier'] = $val->acc_master_name;
            $nestedData['cutter_bill_total'] = $val->cutter_bill_total;
            $nestedData['cutter_bill_type'] = $val->cutter_bill_type;
            $nestedData['customer_order'] = $temp_co_no;
            $nestedData['action'] = '<a href="'. base_url('admin/edit-cutter-bill/'.$val->cb_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" tab="cutter_bill" ref-table="cutter_bill_dtl" pk-name="cb_id" pk-value="'.$val->cb_id.'" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>
            <a href="javascript:void(0)" pk-value="'.$val->cb_id.'" class="btn btn-primary update_art_part"><i class="fa fa-times"></i> Update Art. Part.</a>';
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
    
    public function add_cutter_bill() {
        $data = [];
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();
        
        return array('page'=>'cutter_bill/cutter_bill_add_v', 'data'=>$data);
    }
    
  //   public function form_add_cutting_bill() {
  //       $insertArray = array(
  //           'cutter_bill_name' => $this->input->post('cut_bill_number'),
  //           'cutter_bill_date' => $this->input->post('cut_bill_date'),
  //           'cutter_bill_remark' => $this->input->post('cut_bill_reamark'),
  //           'user_id' => $this->session->user_id
  //       );

  //       // echo '<pre>', print_r($insertArray), '</pre>';die;

  //       $this->db->insert('cutter_bill', $insertArray);
  //       $data['insert_id'] = $this->db->insert_id();
        // if($this->db->insert_id() > 0){
        //  $data['type'] = 'success';
        //  $data['msg'] = 'Cutting Bill added successfully.';
        // }else{
        //  $data['type'] = 'error';
        //  $data['msg'] = 'Not Inserted successfully.';
        // }
  //       return $data;
  //   }
    
    public function form_add_cutting_bill(){
        
        $insertArray = array(
            'cutter_bill_name' => $this->input->post('cut_bill_number'),
            'cutter_bill_date' => $this->input->post('cut_bill_date'),
            'cutter_bill_type' => $this->input->post('cut_bill_type'),
            'am_id' => $this->input->post('cutter_name'),
            'cutter_bill_remark' => $this->input->post('cut_bill_reamark'),
            'status' => $this->input->post('status'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('cutter_bill', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        if($this->db->insert_id() > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Cutting Issue Challan added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted successfully.';
        }
        return $data;
    }
    
    public function cutter_bill_update_article_part(){

        $id = $this->input->post('pk_value');

        $get_am_id = $this->db->get_where('cutter_bill_dtl', array('cb_id' => $id))->result();

        foreach($get_am_id as $g_m_i) {
            $get_row = $this->db->get_where('article_parts', array('am_id' => $g_m_i->am_id, 'update_from_article_part' => 0))->num_rows();
            if($get_row > 0) {
                $this->db->where('am_id', $g_m_i->am_id)->where('update_from_article_part', 0)->delete('article_parts');
            }
        }

        $get_leather_type = $this->db->get_where('cutter_bill', array('cb_id' => $id))->row()->cutter_bill_type;

        if($get_leather_type == 'Type A') {
            $leather_type = 2;
        } else {
            $leather_type = 1;
        }

        foreach($get_am_id as $g_m_i) {
            $get_rows = $this->db->get_where('article_parts', array('am_id' => $g_m_i->am_id, 'ig_id' => $leather_type, 'update_from_article_part' => 1))->num_rows();
            if($get_rows == 0) {
                $insert_array = array(
                'am_id' => $g_m_i->am_id,
                'ig_id' => $leather_type,
                'quantity' => $g_m_i->parts,
                'update_from_article_part' => 1
                );
                $rs = $this->db->insert('article_parts', $insert_array);
            } else {
                $update_array = array(
                'quantity' => $g_m_i->parts
                );
                $rs = $this->db->update('article_parts', $update_array, array('am_id' => $g_m_i->am_id, 'ig_id' => $leather_type, 'update_from_article_part' => 1));  
            }
        } 

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        if($rs > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Article parts updated successfully';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not updated successfully';
        }
        return $data;
    }

    public function edit_cutting_bill($cut_id) {
        $data['cutting_bill_details'] = $this->db
                ->select('cutter_bill.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left')
                ->get_where('cutter_bill', array('cutter_bill.cb_id' => $cut_id))
                ->result();
        $cut_bill_type = $data['cutting_bill_details'][0]->cutter_bill_type;
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

            // echo '<pre>', print_r($module_permission), '</pre>'; die();

        if($module_permission == 'show'){
            $data['customer_order'] = $this->db->select('co_id, co_no')
            ->get_where('customer_order', array( 'customer_order.status' => 1, 'cutting_status' => 0))->result();
        } else {
                #module_permission contains the dept id now
            $data['customer_order'] = $this->db->select('co_id, co_no')
            ->join('user_details','user_details.user_id = customer_order.user_id','left')
            ->get_where('customer_order', array( 'customer_order.status' => 1, 'cutting_status' => 0, 'user_details.user_dept' => $module_permission))->result();
        }


        if($module_permission == 'show'){
                $data['cutting_receive1'] = $this->db
                ->select('*')
                ->get_where('cutting_received_challan', array('cutting_received_challan.status' => '1'))
                ->result();
        } else {
                #module_permission contains the dept id now
                $data['cutting_receive1'] = $this->db
                ->select('*')
                ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
                ->get_where('cutting_received_challan', array('cutting_received_challan.status' => '1', 'user_details.user_dept' => $module_permission))
                ->result();
        }

                if($cut_bill_type == 'Type A') {
        $data['cutting_receive2'] = $this->db
                ->select('cutter_bill_dtl.cut_rcv_id')
                ->join('cutter_bill', 'cutter_bill.cb_id = cutter_bill_dtl.cb_id', 'left')
                ->where('cutter_bill.cutter_bill_type', 'Type A')
                ->get_where('cutter_bill_dtl', array('cutter_bill.status' => '1'))
                ->result();
               } else {
        $data['cutting_receive2'] = $this->db
                ->select('cutter_bill_dtl.cut_rcv_id')
                ->join('cutter_bill', 'cutter_bill.cb_id = cutter_bill_dtl.cb_id', 'left')
                ->where('cutter_bill.cutter_bill_type', 'Type B')
                ->get_where('cutter_bill_dtl', array('cutter_bill.status' => '1'))
                ->result();        
               }
               // echo $this->db->last_query(); die();
               // echo '<pre>', print_r($data['cutting_receive2']), '</pre>'; die();

        $data['cutting_bill_details'] = $this->db
                ->select('cutter_bill.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left')
                ->get_where('cutter_bill', array('cutter_bill.cb_id' => $cut_id))
                ->result();
         $data['cutter_total'] = $data['cutting_bill_details'][0]->cutter_bill_total;
        return array('page'=>'cutter_bill/cutter_bill_edit_v', 'data'=>$data);
    }

    public function ajax_cutting_bill_details_on_cutter_receive() {
    $cut_rcv_id = $this->input->post('cut_rcv_id');
    $cut_bill_type = $this->input->post('cut_bill_type');
    $result = $this->db
                ->select('acc_master.name, acc_master.short_name, article_master.cutting_rate_a, article_master.cutting_rate_b, article_parts.quantity as part_quantity, cutting_received_challan_detail.lc_id as leather_id, cutting_received_challan_detail.fc_id as fitting_id, cutting_received_challan_detail.am_id, article_master.am_id as art_mst_id, cutting_received_challan_detail.receive_cut_quantity, cutting_received_challan.cut_rcv_number, customer_order.co_no, cutting_issue_challan.cut_number, article_master.art_no, c2.color as leather_color, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id')
                ->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id', 'left')
                ->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left')
                ->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left')
                ->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left')
                ->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left')
                ->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left')
                ->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left')
                ->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left')
                ->group_by('cutting_received_challan_detail.cut_rcv_detail_id')
                ->order_by('cutting_received_challan.cut_rcv_number, article_master.art_no, c2.color')
                ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))
                ->result();
                
                // echo '<pre>', print_r($result), '</pre>'; die();

            $preview_data = array();
        
        for($i = 0; $i < sizeof($result); $i++){
            $preview = new stdClass();
        
        if($cut_bill_type == 'Type B') {
        $result1 = $this->db
                ->select('article_parts.quantity')
                ->where('ig_id', 1)
                ->get_where('article_parts', array('article_parts.am_id' => $result[$i]->art_mst_id))->result();
            if(count($result1) > 0) {
                $preview->part_quantity = $result1[0]->quantity;
            } else {
                $preview->part_quantity = 0;
            }
        } else if(($cut_bill_type == 'Type A')){
           $result1 = $this->db
                ->select('SUM(quantity) as sum_quantity')
                ->where('ig_id !=', 1)
                ->get_where('article_parts', array('am_id' => $result[$i]->art_mst_id))->result();
            // echo $this->db->last_query();
            if(count($result1) > 0) {
          $preview->part_quantity = $result1[0]->sum_quantity;
            } else {
                $preview->part_quantity = 0;
            }
        } else {
            $preview->part_quantity = 0;
        }

            
            
            
            $preview->cut_rcv_number = $result[$i]->cut_rcv_number;
            $preview->co_no = $result[$i]->co_no;
            $preview->art_no = $result[$i]->art_no;
            $preview->cut_number = $result[$i]->cut_number;
            $preview->leather_color = $result[$i]->leather_color;
            $preview->receive_cut_quantity = $result[$i]->receive_cut_quantity;
            $preview->cutting_rate_a = $result[$i]->cutting_rate_a;
            $preview->cutting_rate_b = $result[$i]->cutting_rate_b;
            $preview->cut_id = $result[$i]->cut_id;
            $preview->cut_rcv_id = $result[$i]->cut_rcv_id;
            $preview->co_id = $result[$i]->co_id;
            $preview->am_id = $result[$i]->am_id;
            $preview->fitting_id = $result[$i]->fitting_id;
            $preview->leather_id = $result[$i]->leather_id;
            
            array_push($preview_data,  $preview);
            
            //echo ' Required = '.$a.' Consumed = '.$b.' Remaining = '.$r;
            //echo "<br/>";
        }
                    // echo '<pre>', print_r($preview_data), '</pre>'; die();

        return $preview_data;
    }

    public function form_add_cutting_bill_details(){
        $cutter_bill_id = $this->input->post('cb_id_edit');

        $cut_id = $this->input->post('cut_id');
        $cut_rcv_id = $this->input->post('cut_rcv_id');       
        $co_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');
        $lth_color = $this->input->post('leather_id');
        $fit_color = $this->input->post('fitting_id');
        $original_quantity = $this->input->post('receive_cut_quantity');       
        $extra_quantity = $this->input->post('add_extra_quantity');
        $parts = $this->input->post('add_part');     
        $rate = $this->input->post('add_rate');
        $total_amount = $this->input->post('total_amount');
        $user_id = $this->session->user_id;
        
        
        $cutter_total = 0;
        $cutter_total_new = 0;

        // echo sizeof($cut_rcv_id); die();
        
        for($i = 0; $i < sizeof($cut_rcv_id); $i++){
            
            // $rs = $this->db->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $cutter_bill_id, 'cutter_bill_dtl.cut_id' => $cut_id[$i], 'cutter_bill_dtl.cut_rcv_id' => $cut_rcv_id[$i],
            // 'cutter_bill_dtl.co_id' => $co_id[$i], 'cutter_bill_dtl.am_id' => $am_id[$i], 'cutter_bill_dtl.leather_color' => $lth_color[$i], 'cutter_bill_dtl.fitting_colour' => $fit_color[$i],
            // 'cutter_bill_dtl.original_quantity' => $original_quantity[$i], 'cutter_bill_dtl.extra_quantity' => $extra_quantity[$i], 'cutter_bill_dtl.parts' => $parts[$i],
            // 'cutter_bill_dtl.rate' => $rate[$i], 'cutter_bill_dtl.total_amount' => $total_amount[$i]))->num_rows();
            
            // if($rs == 0) {
            //     // noc condition
            // }

            $cutter_total = $cutter_total + $total_amount[$i];
                
                $insertArray = array(
                    'cb_id' => $cutter_bill_id,
                    'cut_id' => $cut_id[$i],
                    'cut_rcv_id' => $cut_rcv_id[$i],
                    'co_id' => $co_id[$i],
                    'am_id' => $am_id[$i],
                    'leather_color' => $lth_color[$i],
                    'fitting_colour' => $fit_color[$i],
                    'original_quantity' => $original_quantity[$i],
                    'extra_quantity' => $extra_quantity[$i],
                    'parts' => $parts[$i],
                    'rate' => $rate[$i],
                    'total_amount' => $total_amount[$i],
                    'user_id' => $user_id
                );

                $this->db->insert('cutter_bill_dtl', $insertArray);
                $insert_id = $this->db->insert_id();
            
        }//end for
        $data['insert_id'] = $insert_id;
        
        if($insert_id > 0){
            $cutter_row = $this->db->get_where('cutter_bill', array('cb_id' => $cutter_bill_id))->row();
            $prev_cutter_val = $cutter_row->cutter_bill_total;
            $cutter_total_new = $prev_cutter_val+$cutter_total;

            $updateArray = array(
                'cutter_bill_total' => $cutter_total_new,
            );
            $this->db->update('cutter_bill', $updateArray, array('cb_id' => $cutter_bill_id));
                    
            $data['type'] = 'success';
            $data['cutter_total'] = $cutter_total_new;
            $data['msg'] = 'Cutter Bill details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }
    public function ajax_cutting_bill_details_table_data() {
       $cutter_bill_id = $this->input->post('cb_id');
        //actual db table column names table th order
        $column_orderable = array(
            0 => 'cutting_received_challan.cut_rcv_number',
            1 => 'customer_order.co_no',
            2 => 'cutting_issue_challan.cut_number',
            3 => 'article_master.art_no',
        );

        // Set searchable column fields
        $column_search = array('cutting_received_challan.cut_rcv_number', 'customer_order.co_no', 'cutting_issue_challan.cut_number', 'article_master.art_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('acc_master.name, acc_master.short_name, article_master.cutting_rate_a as cut_rate, article_master.cutting_rate_b, article_parts.quantity as part_quantity, cutter_bill_dtl.leather_color as leather_id, cutter_bill_dtl.fitting_colour as fitting_id, cutter_bill_dtl.am_id, cutter_bill_dtl.original_quantity,
                cutter_bill_dtl.extra_quantity, cutter_bill_dtl.parts, cutter_bill_dtl.rate, cutter_bill_dtl.total_amount, cutting_received_challan.cut_rcv_number, customer_order.co_no, cutting_issue_challan.cut_number, article_master.art_no, c2.color as leather_color, cutter_bill_dtl.cut_id, cutter_bill_dtl.cut_rcv_id, cutter_bill_dtl.co_id, cutter_bill_dtl.cbd_id, cutter_bill_dtl.cb_id');
            $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutter_bill_dtl.cut_rcv_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = cutter_bill_dtl.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutter_bill_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutter_bill_dtl.fitting_colour', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutter_bill_dtl.leather_color', 'left');
            $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutter_bill_dtl.cut_id', 'left');
            $this->db->group_by('cutter_bill_dtl.cbd_id');
            $rs = $this->db->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $cutter_bill_id))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('acc_master.name, acc_master.short_name, article_master.cutting_rate_a as cut_rate, article_master.cutting_rate_b, article_parts.quantity as part_quantity, cutter_bill_dtl.leather_color as leather_id, cutter_bill_dtl.fitting_colour as fitting_id, cutter_bill_dtl.am_id, cutter_bill_dtl.original_quantity,
                cutter_bill_dtl.extra_quantity, cutter_bill_dtl.parts, cutter_bill_dtl.rate, cutter_bill_dtl.total_amount, cutting_received_challan.cut_rcv_number, customer_order.co_no, cutting_issue_challan.cut_number, article_master.art_no, c2.color as leather_color, cutter_bill_dtl.cut_id, cutter_bill_dtl.cut_rcv_id, cutter_bill_dtl.co_id, cutter_bill_dtl.cbd_id, cutter_bill_dtl.cb_id');
            $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutter_bill_dtl.cut_rcv_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = cutter_bill_dtl.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutter_bill_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutter_bill_dtl.fitting_colour', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutter_bill_dtl.leather_color', 'left');
            $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutter_bill_dtl.cut_id', 'left');
             $this->db->group_by('cutter_bill_dtl.cbd_id');
            $rs = $this->db->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $cutter_bill_id))->result();
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

            $this->db->select('acc_master.name, acc_master.short_name, article_master.cutting_rate_a as cut_rate, article_master.cutting_rate_b, article_parts.quantity as part_quantity, cutter_bill_dtl.leather_color as leather_id, cutter_bill_dtl.fitting_colour as fitting_id, cutter_bill_dtl.am_id, cutter_bill_dtl.original_quantity,
                cutter_bill_dtl.extra_quantity, cutter_bill_dtl.parts, cutter_bill_dtl.rate, cutter_bill_dtl.total_amount, cutting_received_challan.cut_rcv_number, customer_order.co_no, cutting_issue_challan.cut_number, article_master.art_no, c2.color as leather_color, cutter_bill_dtl.cut_id, cutter_bill_dtl.cut_rcv_id, cutter_bill_dtl.co_id, cutter_bill_dtl.cbd_id, cutter_bill_dtl.cb_id');
            $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutter_bill_dtl.cut_rcv_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = cutter_bill_dtl.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutter_bill_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutter_bill_dtl.fitting_colour', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutter_bill_dtl.leather_color', 'left');
            $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutter_bill_dtl.cut_id', 'left');
             $this->db->group_by('cutter_bill_dtl.cbd_id');
            $rs = $this->db->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $cutter_bill_id))->result();       

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('acc_master.name, acc_master.short_name, article_master.cutting_rate_a as cut_rate, article_master.cutting_rate_b, article_parts.quantity as part_quantity, cutter_bill_dtl.leather_color as leather_id, cutter_bill_dtl.fitting_colour as fitting_id, cutter_bill_dtl.am_id, cutter_bill_dtl.original_quantity,
                cutter_bill_dtl.extra_quantity, cutter_bill_dtl.parts, cutter_bill_dtl.rate, cutter_bill_dtl.total_amount, cutting_received_challan.cut_rcv_number, customer_order.co_no, cutting_issue_challan.cut_number, article_master.art_no, c2.color as leather_color, cutter_bill_dtl.cut_id, cutter_bill_dtl.cut_rcv_id, cutter_bill_dtl.co_id, cutter_bill_dtl.cbd_id, cutter_bill_dtl.cb_id');
            $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = cutter_bill_dtl.cut_rcv_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = cutter_bill_dtl.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutter_bill_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutter_bill_dtl.fitting_colour', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutter_bill_dtl.leather_color', 'left');
            $this->db->join('article_parts', 'article_parts.am_id = article_master.am_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutter_bill_dtl.cut_id', 'left');
             $this->db->group_by('cutter_bill_dtl.cbd_id');
            $rs = $this->db->get_where('cutter_bill_dtl', array('cutter_bill_dtl.cb_id' => $cutter_bill_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {
            
            $nestedData['cutting_receipt_number'] = $val->cut_rcv_number;
            $nestedData['co_no'] = $val->co_no;
            $nestedData['cut_number'] = $val->cut_number;
            $nestedData['art_no'] = $val->art_no;
            $nestedData['color'] = $val->leather_color;
            $nestedData['original_quantity'] = $val->original_quantity;
            $nestedData['extra_quantity'] = $val->extra_quantity;
            $nestedData['parts'] = $val->parts;
            $nestedData['rate'] = $val->rate;
            $nestedData['total_amount'] = $val->total_amount;

            $nestedData['action'] = '<a tab="cutter_bill_dtl" tab-pk="cbd_id" 
            tab-val="'.$val->cbd_id.'" data-tab="cutter_bill" data-pk="cb_id" data-tab-val="'.$val->cb_id.'" quantity="'.$val->original_quantity.'" rate="'.$val->rate.'" total="'.$val->total_amount.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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
    public function del_cutting_bill_details(){
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $tab_val = $this->input->post('tab_val');
        
        $data_tab = $this->input->post('data_tab');
        $data_pk = $this->input->post('data_pk');
        $data_tab_val = $this->input->post('data_tab_val');

        $primary_key = $this->input->post('tab_val');
        $table_name = $this->input->post('tab');
        $pk_field_name = $this->input->post('tab_pk');
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $this->input->post('tab'),
                    "tbl_pk_fld" => $this->input->post('tab_pk'),
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
                
        $cutter_bill_detail = $this->db->select('total_amount')->get_where('cutter_bill_dtl', array('cbd_id' => $tab_val))->row()->total_amount;
        
        
            $total = $cutter_bill_detail;
            
        $article_total = $this->db->select('cutter_bill_total')->get_where('cutter_bill', array('cb_id' => $data_tab_val))->result()[0]->cutter_bill_total;
        //echo 'article_quantity:'.$article_quantity;
        $article_total_new = ($article_total - $total);     
        //echo 'article_quantity_new:'.$article_quantity_new;
        $updateArray = array(
            'cutter_bill_total' => $article_total_new
        );
        $this->db->update($data_tab, $updateArray, array($data_pk => $data_tab_val));
        
        $this->db->where($tab_pk, $tab_val)->delete($tab);
        
        $data['article_total'] = $article_total_new;
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = ' Cutter Bill detail detail successfully';
        return $data;
    }
    
    public function form_edit_cutting_bill() {

        $old_array = $this->db->get_where('cutter_bill', array('cb_id' => $this->input->post('cb_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('cb_id'), 'cutter_bill');

        $updateArray = array(
            'cutter_bill_date' => $this->input->post('cut_bill_date'),
            'cutter_bill_remark' => $this->input->post('cut_bill_remark'),
            'status' => $this->input->post('status'),
            'user_id' => $this->session->user_id
        );
        $cutter_bill_id = $this->input->post('cb_id');
        
        $this->db->update('cutter_bill', $updateArray, array('cb_id' => $cutter_bill_id));

        $data['type'] = 'success';
        $data['msg'] = 'Jobber Bill updated successfully.';

        return $data;

    }

    public function delete_cutter_list() {

        $primary_key = $this->input->post('pk_value');
        $table_name = $this->input->post('tab');
        $pk_field_name = $this->input->post('pk_name');
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $this->input->post('tab'),
                    "tbl_pk_fld" => $this->input->post('pk_name'),
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

        $tab = $this->input->post('tab');
        $ref_tab = $this->input->post('ref_table');
        $pk_name = $this->input->post('pk_name');
        
        $pk_value = $this->input->post('pk_value');
        
        $this->db->where($pk_name, $pk_value)->delete($ref_tab);
        $this->db->where($pk_name, $pk_value)->delete($tab);
        
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting issue challan Successfully Deleted';
        return $data;
    }
}