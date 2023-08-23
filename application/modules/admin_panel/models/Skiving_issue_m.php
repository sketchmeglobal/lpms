<?php

class Skiving_issue_m extends CI_Model {

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
            'comment' => 'skiving issue'
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
                'comment' => 'skiving issue'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function skiving_issue() {
        $data = array();
        $data["view_permission"] = $this->_user_wise_view_permission(7, $this->session->user_id);
        return array('page'=>'skiving_issue/skiving_issue_list_v', 'data'=>$data);
    }

    public function ajax_skiving_issue_table_data($id){

       // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

        $cut_rcv_id = $id;
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'customer_order.co_no',
            7 => 'receive_cut_quantity'
        );
        // Set searchable column fields
        $column_search = array('cutting_issue_challan.cut_number');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            
			$this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
			$this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');

        if($module_permission == 'show'){
                $rs = $this->db->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')
        ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
        ->get_where('cutting_received_challan_detail', array('user_details.user_dept' => $module_permission, 'cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
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
                $rs = $this->db->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')
        ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
        ->get_where('cutting_received_challan_detail', array('user_details.user_dept' => $module_permission, 'cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
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
                $rs = $this->db->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')
        ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
        ->get_where('cutting_received_challan_detail', array('user_details.user_dept' => $module_permission, 'cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
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
                $rs = $this->db->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')
        ->join('user_details','user_details.user_id = cutting_received_challan_detail.user_id','left')
        ->get_where('cutting_received_challan_detail', array('user_details.user_dept' => $module_permission, 'cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['customer_order_no'] = $val->co_no;
			$nestedData['buyer_reference_number'] = $val->buyer_reference_no;
			$nestedData['cutting_challan_number'] = $val->cut_number;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['receive_quantity'] = $val->receive_cut_quantity;
			$uvp = $this->_user_wise_view_permission(7, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="javascript:void(0)" cut_rcv_detail_id="'.$val->cut_rcv_detail_id.'" class="cutting_received_challan_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="cutting_received_challan_detail" tab-pk="cut_rcv_detail_id" data-pk="'.$val->cut_rcv_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function ajax_cutting_receive_table_data_skiving() {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

        //actual db table column names
        $column_orderable = array(
			0 => 'cut_rcv_number',
            1 => 'skiving_issue_number',
            2 => 'skiving_issue_date'
        );
        // Set searchable column fields
        $column_search = array('cutting_received_challan.cut_rcv_number', 'cutting_received_challan.skiving_issue_number', 'cutting_received_challan.skiving_issue_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, cutting_received_challan.skiving_issue_number, DATE_FORMAT(cutting_received_challan.skiving_issue_date, "%d-%m-%Y") as skiving_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
		$this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
		

        if($module_permission == 'show'){
                $rs = $this->db->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
        ->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }


        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
            $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, cutting_received_challan.skiving_issue_number, DATE_FORMAT(cutting_received_challan.skiving_issue_date, "%d-%m-%Y") as skiving_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        if($module_permission == 'show'){
                $rs = $this->db->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
        ->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1, 'user_details.user_dept' => $module_permission))->result();
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

            $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, cutting_received_challan.skiving_issue_number, DATE_FORMAT(cutting_received_challan.skiving_issue_date, "%d-%m-%Y") as skiving_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
        ->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
			
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
			$this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, cutting_received_challan.skiving_issue_number, DATE_FORMAT(cutting_received_challan.skiving_issue_date, "%d-%m-%Y") as skiving_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
        if($module_permission == 'show'){
                $rs = $this->db->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1))->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
        ->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
			
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $temp_co_no = '';
            $cut_rcv_id = $val->cut_rcv_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left')
            ->group_by('cutting_received_challan_detail.co_id')
            ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'cutting_received_challan_detail.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $total_skiving_quantity_row = $this->db->select_sum('cutting_received_challan_detail.receive_cut_quantity')
            ->group_by('cutting_received_challan_detail.cut_rcv_id')
            ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id, 'cutting_received_challan_detail.status => 1'))->result();
             if(count($total_skiving_quantity_row) > 0) {
               $total_skiving_quantity = $total_skiving_quantity_row[0]->receive_cut_quantity;
             } else {
                $total_skiving_quantity = '0';
             }
            
            $nestedData['customer_order_no'] = $temp_co_no;
            $nestedData['total_skiving_amount'] = $total_skiving_quantity;
            $nestedData['cut_rcv_id'] = $val->cut_rcv_id;
			$nestedData['am_id'] = $val->am_id;
			$nestedData['acc_master_name'] = $val->acc_master_name.'['.$val->acc_master_short_name.']';
			$nestedData['cut_rcv_number'] = $val->cut_rcv_number;
            $nestedData['cut_rcv_date'] = $val->cut_rcv_date;
			
			$nestedData['skiving_issue_number'] = $val->skiving_issue_number;
			$nestedData['skiving_issue_date'] = $val->skiving_issue_date;
			
            $nestedData['action'] = '<a href="'. base_url('admin/edit-skiving-issue/'.$val->cut_rcv_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a target="_blank" href="'. base_url('admin/skiving-challan-issue-print/'.$val->cut_rcv_id) .'" class="btn btn-primary"><i class="fa fa-pencil"></i> Print</a>
            <a href="javascript:void(0)" pk-name="cut_rcv_id" pk-value="'.$val->cut_rcv_id.'" tab="cutting_received_challan" child="1" ref-pk-name="cut_rcv_id#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function add_skiving_issue() {

    // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

    if($module_permission == 'show'){
        $data['cutting_received_challan'] = $this->db->select('cut_rcv_id, cut_rcv_number')->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 0, 'cutting_received_challan.status' => 1))->result();
    } else {
                #module_permission contains the dept id now
        $data['cutting_received_challan'] = $this->db->select('cut_rcv_id, cut_rcv_number')
        ->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
        ->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 0, 'cutting_received_challan.status' => 1, 'user_details.user_dept' => $module_permission))->result();

    }
		
        return array('page'=>'skiving_issue/skiving_issue_add_v', 'data'=>$data);
    }

    public function ajax_unique_skiving_issue_no(){
        $skiving_issue_number = $this->input->post('skiving_issue_number');

        $rs = $this->db->get_where('cutting_received_challan', array('skiving_issue_number' => $skiving_issue_number))->num_rows();
        if($rs != '0') {
            $data = 'Skiving issue no already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }
	
	//Add main header info
    public function form_add_skiving_issue(){
		$data = array();
		
		$skiving_issue_status = 1;
		$cut_rcv_id = $this->input->post('cut_rcv_id');
		
        $updateArray = array(
            'skiving_issue_number' => $this->input->post('skiving_issue_number'),
            'skiving_issue_date' => $this->input->post('skiving_issue_date'),
            'skiving_issue_status' => $skiving_issue_status,
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->update('cutting_received_challan', $updateArray, array('cut_rcv_id' => $cut_rcv_id));
		
		$data['cut_rcv_id'] = $cut_rcv_id;
		$data['type'] = 'success';
		$data['msg'] = 'Skiving Issued successfully.';
			
        return $data;
    }
	
	//Get data before edit
    public function edit_skiving_issue($cut_rcv_id) {
        //$data['cutting_received_challan'] = $this->db->select('cut_rcv_id, cut_rcv_number')->get_where('cutting_received_challan', array('cutting_received_challan.status' => 1))->result();
		
        $data['cutting_receive_details'] = $this->db
                ->select('cutting_received_challan.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left')
                ->get_where('cutting_received_challan', array('cutting_received_challan.cut_rcv_id' => $cut_rcv_id))
                ->result();
        return array('page'=>'skiving_issue/skiving_issue_edit_v', 'data'=>$data);
    }

    public function form_edit_skiving_issue(){

        $old_array = $this->db->get_where('cutting_received_challan', array('cut_rcv_id' => $this->input->post('cut_rcv_id_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('cut_rcv_id_id'), 'cutting_received_challan');

        $updateArray = array(
            'skiving_issue_number' => $this->input->post('skiving_issue_number'),
            'skiving_issue_date' => $this->input->post('skiving_issue_date'),
            'user_id' => $this->session->user_id
        );
        $cut_rcv_id = $this->input->post('cut_rcv_id_id'); 
		
        $this->db->update('cutting_received_challan', $updateArray, array('cut_rcv_id' => $cut_rcv_id));

        $data['type'] = 'success';
        $data['msg'] = 'Skiving Issue updated successfully.';

        return $data;

    }

    public function ajax_cutting_receive_challan_details_table_data() {
       
	   $cut_rcv_id = $this->input->post('cut_rcv_id');
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'customer_order.co_no',
            7 => 'receive_cut_quantity'
        );
        // Set searchable column fields
        $column_search = array('receive_cut_quantity');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('cutting_received_challan_detail')->result();
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
			
            $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
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
			
            $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();
        

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
			
            $rs = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result();

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
            $nestedData['action'] = '<a href="javascript:void(0)" cut_rcv_detail_id="'.$val->cut_rcv_detail_id.'" class="cutting_received_challan_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
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
    
    public function skiving_challan_issue_print($skvng_id) {
            // echo $ac_id; 
        $data = array();
        
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 3, 'user_id' => $this->session->user_id))->result(); # 3 = skiving
        
        $this->db->select('cutting_received_challan.cut_rcv_id, cutting_received_challan.am_id, cutting_received_challan.cut_rcv_number, DATE_FORMAT(cutting_received_challan.cut_rcv_date, "%d-%m-%Y") as cut_rcv_date, cutting_received_challan.skiving_issue_number, DATE_FORMAT(cutting_received_challan.skiving_issue_date, "%d-%m-%Y") as skiving_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name, acc_master.address');
		$this->db->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left');
            $rs = $this->db->get_where('cutting_received_challan', array('cutting_received_challan.skiving_issue_status' => 1, 'cutting_received_challan.cut_rcv_id' => $skvng_id))->result();
            
            $data['skiving_issue_header'] = $rs;
        
            $this->db->select('cutting_received_challan_detail.cut_rcv_detail_id,  cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, cutting_received_challan_detail.buyer_reference_no, cutting_received_challan_detail.cut_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.fc_id, cutting_received_challan_detail.lc_id, cutting_received_challan_detail.receive_cut_quantity, customer_order.co_no, cutting_issue_challan.cut_number, customer_order_dtl.co_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
        
		$this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_received_challan_detail.cod_id', 'left');
		$this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
   		$this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
        $rs1 = $this->db->order_by('customer_order.co_no,cutting_issue_challan.cut_number,article_master.art_no,c2.color')->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $skvng_id))->result();
        
        $data['skiving_issue_details_list'] = $rs1;
        
        return array('page'=>'skiving_issue/skiving_issue_print_v', 'data'=>$data);
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
		$data = array();
		
		$buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
		
		$data['buyer_reference_no'] = $buyer_reference_no;
		
		$this->db->select('cutting_issue_challan.cut_id, cutting_issue_challan.cut_number');
		$this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_issue_challan_details.cut_id', 'left');
		$this->db->group_by('cutting_issue_challan_details.co_id');
		$challans = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id' => $co_id))->result();
		$data['challans'] = $challans;
			
	return $data;
	
    }
	
	public function ajax_get_article_detail(){
        $cut_id = $this->input->post('cut_id');
		
		$this->db->select('cutting_issue_challan_details.cod_id, cutting_issue_challan_details.fc_id, cutting_issue_challan_details.lc_id, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('article_master', 'article_master.am_id = cutting_issue_challan_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = cutting_issue_challan_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_issue_challan_details.lc_id', 'left');
		return $articles = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
		
    }
	
	public function ajax_get_issue_quantity_and_article_detail(){
        $cod_id = $this->input->post('cod_id');
		$data = array();
		
		$this->db->select('cutting_issue_challan_details.cod_id, cutting_issue_challan_details.cut_co_quantity, cutting_issue_challan_details.fc_id, cutting_issue_challan_details.lc_id, article_master.am_id as article_master_id, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('article_master', 'article_master.am_id = cutting_issue_challan_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = cutting_issue_challan_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_issue_challan_details.lc_id', 'left');
		$article = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cod_id' => $cod_id))->result()[0];
		
		$cut_co_quantity = $article->cut_co_quantity;
		$data['article'] = $article;
		
		$num_rows = $this->db->select('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cod_id' => $cod_id))->num_rows();
		if($num_rows > 0){		
			$receive_quantity = $this->db->select('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cod_id' => $cod_id))->result()[0]->receive_cut_quantity;
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
		$data = array();
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
		}
		
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
    // ---------------------------------------working-----------------------------------------

    

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
        $tab = $this->input->post('tab');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting Receive Challan Successfully Deleted';
        return $data;
    }
	
	public function delete_skiving_issue_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('pk_value');

        $primary_key = $this->input->post('pk_value');
        $table_name = $this->input->post('tab');
        $pk_field_name = 'cut_rcv_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $this->input->post('tab'),
                    "tbl_pk_fld" => 'cut_rcv_id',
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
		
		$skiving_issue_number = '';
		$skiving_issue_date = '';
		$skiving_issue_status = 0;
		
		$updateArray = array(
			'skiving_issue_status' => $skiving_issue_status,
            'skiving_issue_number' => $skiving_issue_number,
            'skiving_issue_date' => $skiving_issue_date,
            'user_id' => $this->session->user_id
        );
        $cut_rcv_id = $data_pk;
		
        $this->db->update('cutting_received_challan', $updateArray, array('cut_rcv_id' => $cut_rcv_id));
 		//echo $this->db->last_query();die;
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Skiving Issue list deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}