<?php

class Stitching_issue_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        // $this->db->query("SET sql_mode = ''");
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
            'comment' => 'stitching issue'
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
                'comment' => 'stitching issue'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function stitching_bill() {
        $data = '';
        $data["view_permission"] = $this->_user_wise_view_permission(48, $this->session->user_id);
        return array('page'=>'stitching_bill/stitching_bill_list_v', 'data'=>$data);
    }

    public function ajax_stitching_bill_table_data() {

        // fetch department-wisemodule permission
        $session_user_id = $this->session->user_id;
        # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); 
 
        //actual db table column names
        $column_orderable = array(
            0 => 'employees.name',
            1 => 'stitching_bill.bill_number',
            2 => 'stitching_bill.bill_date',
            3 => 'stitching_bill.bill_type',
        );
        // Set searchable column fields
        $column_search = array('employee.name', 'stitching_bill.bill_number', 'stitching_bill.bill_date', 'stitching_bill.bill_type');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('stitching_bill')->result();
                // print_r($rs); die;
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
            ->join('user_details','user_details.user_id = stitching_bill.user_id','left')
            ->get_where('stitching_bill', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stitching_bill.*, DATE_FORMAT(stitching_bill.bill_date, "%d-%m-%Y") as bill_date, employees.name');
            $this->db->join('employees', 'employees.e_id = stitching_bill.bill_employee_id', 'left');

            if($module_permission == 'show'){
                    $rs = $this->db->get_where('stitching_bill', array('stitching_bill.status' => 1))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill.user_id','left')
                    ->get_where('stitching_bill', array('user_details.user_dept' => $module_permission, 'stitching_bill.status' => 1))->result();
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

            $this->db->select('stitching_bill.*, DATE_FORMAT(stitching_bill.bill_date, "%d-%m-%Y") as bill_date, employees.name');
            $this->db->join('employees', 'employees.e_id = stitching_bill.bill_employee_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get_where('stitching_bill', array('stitching_bill.status' => 1))->result();
            } else {
                    #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill.user_id','left')
                    ->get_where('stitching_bill', array('user_details.user_dept' => $module_permission, 'stitching_bill.status' => 1))->result();
            }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stitching_bill.*, DATE_FORMAT(stitching_bill.bill_date, "%d-%m-%Y") as bill_date, employees.name');
            $this->db->join('acc_master', 'acc_master.am_id = stitching_bill.am_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get_where('stitching_bill', array('stitching_bill.status' => 1))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill.user_id','left')
                    ->get_where('stitching_bill', array('user_details.user_dept' => $module_permission, 'stitching_bill.status' => 1))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
            $nestedData['stitching_bill_number'] = $val->bill_number;
            $nestedData['stitching_bill_date'] = date('d-m-Y', strtotime($val->bill_date));
            $nestedData['employee_name'] = $val->name;
            $nestedData['bill_type'] = $val->bill_rate_type;
            $nestedData['total_amount'] = $this->db->select('SUM(stitching_paid_qnty*stitching_rate) as total')->get_where('stitching_bill_detail', array('sb_id' => $val->sb_id))->row()->total;
            $uvp = $this->_user_wise_view_permission(7, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-stitching-bill/'.$val->sb_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                        <a target="_new" href="'. base_url('admin/print-stitching-bill/'.$val->sb_id) .'" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
                        <a href="javascript:void(0)" pk-name="sb_id" pk-value="'.$val->sb_id.'" tab="stitching_bill" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function add_stitching_bill() {
        $data = array();
        $data["view_permission"] = $this->_user_wise_view_permission(7, $this->session->user_id);
        $data['all_employees'] = $this->db->get_where('employees', array('d_id' => 9))->result();
        return array('page'=>'stitching_bill/stitching_bill_add_v', 'data'=>$data);
    }

    public function form_add_stitching_bill(){

        $insertArray = array(
            'bill_number' => $this->input->post('stitching_bill_number'),
            'bill_date' => $this->input->post('stitching_bill_date'),
            'bill_rate_type' => $this->input->post('stitching_bill_type'),
            'bill_employee_id' => $this->input->post('skiver_name'),
            'bill_remarks' => $this->input->post('stitching_bill_remark'),
            'user_id' => $this->session->user_id
        );

        $this->db->insert('stitching_bill', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'stitching Bill added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;

    }

    public function edit_stitching_bill($stitching_bill_id) {
        
        $data['stitching_bill_id'] = $stitching_bill_id;
        $data['all_employees'] = $this->db->get_where('employees', array('d_id' => 8))->result();		
				
        $data['stitching_bill_details'] = $this->db->select('stitching_bill.*, DATE_FORMAT(stitching_bill.bill_date, "%d-%m-%Y") as bill_date, employees.name')
            ->join('employees', 'employees.e_id = stitching_bill.bill_employee_id', 'left')
            ->get_where('stitching_bill', array('stitching_bill.sb_id' => $stitching_bill_id))->result();

        // $data['stitching_issue_list'] = $this->db->get_where('cutting_received_challan',array('skiving_issue_status' => 1 ))->result();
			
        $query = "SELECT * FROM customer_order WHERE customer_order.cutting_status = 1";
        $data['co_ids'] = $this->db->query($query)->result();

        return array('page'=>'stitching_bill/stitching_bill_edit_v', 'data'=>$data);
        
    }

    public function form_edit_stitching_bill(){
        $update_arr = array(
            'bill_number' => $this->input->post('stitching_bill_number'),
            'bill_date' => $this->input->post('stitching_bill_date'),
            'bill_rate_type' => $this->input->post('stitching_bill_type'),
            'bill_employee_id' => $this->input->post('skiver_name'),
            'bill_remarks' => $this->input->post('stitching_bill_remark'),
            'user_id' => $this->session->user_id
        );

        $rval = $this->db->update('stitching_bill', $update_arr, array('sb_id' => $this->input->post('stitching_bill_id')));
        
		if($rval){
			$data['type'] = 'success';
			$data['msg'] = 'stitching bill updated successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not updated successfully.';
		}
        return $data;
    }

    public function delete_stitching_bill_list(){
        $tab = $this->input->post('tab');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');

        $child_table_rows = $this->db->get_where('stitching_bill_detail', array('stitching_bill_detail.sb_id' => $pk_value))->num_rows();
		if($child_table_rows > 0){
            $this->db->where('sb_id', $pk_value)->delete('stitching_bill_detail');    
            $this->db->where('sb_id', $pk_value)->delete($tab);    
        }else{
            $this->db->where($pk_name, $pk_value)->delete($tab);
        }
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'stitching Bill Successfully Deleted';
        return $data;
    }

    public function ajax_stitching_bill_details_table_data() {

        $stitching_bill_id = $this->input->post('stitching_bill_id');
        // fetch department-wisemodule permission
        $session_user_id = $this->session->user_id;
        # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #7 = sample module_id
 
        //actual db table column names
        $column_orderable = array(
            0 => 'customer_order.co_no',
            // 1 => 'cutting_received_challan.stitching_issue_number'
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no', 'art_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
            $rs = $this->db->get_where('stitching_bill_detail', array('stitching_bill_detail.sb_id' => $stitching_bill_id))->result();
            // print_r($rs); die;
        } else {
                #module_permission contains the dept id now
            $rs = $this->db
                ->join('user_details','user_details.user_id = stitching_bill_detail.user_id','left')
                // ->get_where('stitching_bill_detail', array('user_details.user_dept' => $module_permission, 'stitching_bill.sb_id' => $stitching_bill_id))->result();
                ->get_where('stitching_bill_detail', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('bill_number,article_master.art_no,color,customer_order.co_no, stitching_bill_detail.*');
            // $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = stitching_bill_detail.cut_rcv_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = stitching_bill_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = stitching_bill_detail.am_id', 'left');
            $this->db->join('colors', 'colors.c_id = stitching_bill_detail.lc_id', 'left');
            $this->db->join('stitching_bill', 'stitching_bill.sb_id = stitching_bill_detail.sb_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get_where('stitching_bill_detail', array('stitching_bill_detail.status' => 1, 'stitching_bill.sb_id' => $stitching_bill_id))->result();
            } else {
                    #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill_detail.user_id','left')
                    ->get_where('stitching_bill_detail', array('user_details.user_dept' => $module_permission,'stitching_bill.sb_id' => $stitching_bill_id, 'stitching_bill_detail.status' => 1))->result();
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
            $this->db->select('bill_number,article_master.art_no,color,customer_order.co_no, stitching_bill_detail.*');
            // $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = stitching_bill_detail.cut_rcv_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = stitching_bill_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = stitching_bill_detail.am_id', 'left');
            $this->db->join('colors', 'colors.c_id = stitching_bill_detail.lc_id', 'left');
            $this->db->join('stitching_bill', 'stitching_bill.sb_id = stitching_bill_detail.sb_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get_where('stitching_bill_detail', array('stitching_bill_detail.status' => 1, 'stitching_bill.sb_id' => $stitching_bill_id))->result();
            } else {
                    #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill_detail.user_id','left')
                    ->get_where('stitching_bill_detail', array('user_details.user_dept' => $module_permission, 'stitching_bill.sb_id' => $stitching_bill_id, 'stitching_bill_detail.status' => 1))->result();
            }            

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('bill_number,article_master.art_no,color,customer_order.co_no, stitching_bill_detail.*');
            // $this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = stitching_bill_detail.cut_rcv_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = stitching_bill_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = stitching_bill_detail.am_id', 'left');
            $this->db->join('colors', 'colors.c_id = stitching_bill_detail.lc_id', 'left');
            $this->db->join('stitching_bill', 'stitching_bill.sb_id = stitching_bill_detail.sb_id', 'left');

            if($module_permission == 'show'){
                $rs = $this->db->get_where('stitching_bill_detail', array('stitching_bill_detail.status' => 1, 'stitching_bill.sb_id' => $stitching_bill_id))->result();
            } else {
                    #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = stitching_bill_detail.user_id','left')
                    ->get_where('stitching_bill_detail', array('user_details.user_dept' => $module_permission, 'stitching_bill.sb_id' => $stitching_bill_id, 'stitching_bill_detail.status' => 1))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;
        
        foreach ($rs as $val) {

            $nestedData['bill_no'] = $val->bill_number;
            $nestedData['co_no'] = $val->co_no;
            // $nestedData['issue_no'] = $val->stitching_issue_number;
            $nestedData['am_id'] = $val->art_no;
            $nestedData['lc_id'] = $val->color;
            $nestedData['qnty'] = $val->stitching_paid_qnty;
            $nestedData['rate'] = $val->stitching_rate;
            $nestedData['total'] = $val->stitching_amount;

            $uvp = $this->_user_wise_view_permission(7, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="javascript:void(0)" pk-name="sbd_id" pk-value="'.$val->sbd_id.'" tab="stitching_bill_detail" child="0" ref-table="" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function print_stitching_bill($stitching_bill_id) {
        
        $data['stitching_bill_id'] = $stitching_bill_id;
        			
        $data['stitching_bill_details'] = $this->db->select('stitching_bill.*, DATE_FORMAT(stitching_bill.bill_date, "%d-%m-%Y") as bill_date, stitching_paid_qnty, stitching_rate, stitching_amount, employees.name, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, alt_art_no, colors.color')
            ->join('employees', 'employees.e_id = stitching_bill.bill_employee_id', 'left')
            ->join('stitching_bill_detail', 'stitching_bill_detail.sb_id = stitching_bill.sb_id', 'left')
            ->join('customer_order', 'customer_order.co_id = stitching_bill_detail.co_id', 'left')
            ->join('article_master', 'article_master.am_id = stitching_bill_detail.am_id', 'left')
            ->join('colors', 'colors.c_id = stitching_bill_detail.lc_id', 'left')
            ->order_by('customer_order.co_no,article_master.am_id,colors.color')
            ->get_where('stitching_bill', array('stitching_bill.sb_id' => $stitching_bill_id))->result();

        // echo '<pre>';print_r($data);

        return array('page'=>'stitching_bill/stitching_bill_print_v', 'data'=>$data);
        
    }

    public function delete_stitching_bill_details(){
        $tab = $this->input->post('tab');
		$pk_name = $this->input->post('tab_pk');
		$pk_value = $this->input->post('tab_val');

        $this->db->where($pk_name, $pk_value)->delete($tab);
        
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'stitching Bill Successfully Deleted';
        return $data;
    }

    public function ajax_stitching_issue_on_co_id(){

        $co_id = $this->input->post('co_id');
        return $this->db
            ->select('DISTINCT(cutting_received_challan.cut_rcv_id), stitching_issue_number')
            ->join('cutting_received_challan_detail','cutting_received_challan_detail.cut_rcv_id = cutting_received_challan.cut_rcv_id','left')
            ->get_where('cutting_received_challan', array('co_id' => $co_id))->result();

    }

    public function ajax_article_detail_on_co_id(){
        $co_id = $this->input->post('co_id');
        return $this->db
            ->select('customer_order_dtl.am_id,lc_id,co_quantity,art_no,color, sample_rate, production_rate')
            ->join('article_master','article_master.am_id = customer_order_dtl.am_id','left')
            ->join('colors','colors.c_id = lc_id','left')
            ->join('stitching_rate','stitching_rate.article_master_id = customer_order_dtl.am_id','left')
            ->get_where('customer_order_dtl', array('co_id' => $co_id))->result();

    }

    public function ajax_fetch_stitching_bill_pending_qnty(){
        $co_id = $this->input->post('co_id');
        // $cut_rcv_id = $this->input->post('cut_rcv_id');
        $am_id = $this->input->post('am_id');
        $color = $this->input->post('color');

        $nr = $this->db
                ->get_where('stitching_bill_detail', 
                    array(
                        'co_id' => $co_id,
                        'am_id' => $am_id,
                        'lc_id' => $color
                    )
                )->num_rows();

        if($nr > 0){

            $rv =  $this->db
                ->select('SUM(stitching_paid_qnty) AS used_qty')
                ->get_where('stitching_bill_detail', 
                    array(
                        'co_id' => $co_id,
                        'am_id' => $am_id,
                        'lc_id' => $color
                    )
                )
                ->row()->used_qty;
            return $rv;

        }else{
            // echo $this->db->last_query(); die('new');
            return 0;
        }  

    }

    public function form_add_stitching_bill_details(){

        // print_r($_POST); die;

        $insert_array = array(
            'sb_id' => $this->input->post('sb_id_val'),
            'co_id' => $this->input->post('co_id'),
            'am_id' => $this->input->post('article_id'),
            'lc_id' => $this->input->post('color_val'),
            'stitching_paid_qnty' => $this->input->post('pending_qnty'),
            'stitching_rate' => $this->input->post('stitching_rate'),
            'stitching_amount' => $this->input->post('stitching_total'),
            'user_id' => $this->session->user_id
        );


        if($this->db->insert('stitching_bill_detail', $insert_array)){
            $data['title'] = 'Inserted!';
            $data['type'] = 'success';
            $data['msg'] = 'stitching Bill Details Added';
        }else{
            $data['title'] = 'Failed!';
            $data['type'] = 'error';
            $data['msg'] = 'stitching Bill Not Added';
        }
        
        return $data;
    }
}