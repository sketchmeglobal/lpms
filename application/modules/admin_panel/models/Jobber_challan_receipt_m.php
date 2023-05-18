<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last modified: 19-Mar-2021 at 11:30am
 */

class Jobber_challan_receipt_m extends CI_Model {

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
            'comment' => 'jobber challan receipt'
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
                'comment' => 'jobber hallan receipt'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function jobber_challan_receipt_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(10, $this->session->user_id);
        return array('page'=>'jobber_receipt/jobber_challan_receipt_list_v', 'data'=>$data);
    }

    public function ajax_jobber_challan_receipt_table_data() {

    // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id

        //actual db table column names
        $column_orderable = array(
			0 => 'jobber_challan_receipt.jobber_receipt_challan_number',
            1 => 'jobber_challan_receipt.jobber_receipt_challan_date',
            2 => 'acc_master.name',
            3 => 'jobber_challan_receipt.total_jobber_quantity_receipt'
        );
        // Set searchable column fields
        $column_search = array('jobber_challan_receipt.jobber_receipt_challan_number', 'jobber_challan_receipt.jobber_receipt_challan_date', 'acc_master.name', 'jobber_challan_receipt.total_jobber_quantity_receipt');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('jobber_challan_receipt')->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_challan_receipt.user_id','left')
          ->get_where('jobber_challan_receipt', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number, DATE_FORMAT(jobber_challan_receipt.jobber_receipt_challan_date, "%d-%m-%Y") as jobber_receipt_challan_date, jobber_challan_receipt.total_jobber_quantity_receipt, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_challan_receipt.am_id', 'left');

    if($module_permission == 'show'){
    $rs = $this->db
                   ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
                   ->get_where('jobber_challan_receipt', array('jobber_challan_receipt.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_challan_receipt.user_id','left')
          ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
          ->get_where('jobber_challan_receipt', array('user_details.user_dept' => $module_permission, 'jobber_challan_receipt.status => 1'))->result();
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
			$this->db->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number, DATE_FORMAT(jobber_challan_receipt.jobber_receipt_challan_date, "%d-%m-%Y") as jobber_receipt_challan_date, jobber_challan_receipt.total_jobber_quantity_receipt, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_challan_receipt.am_id', 'left');
            
    if($module_permission == 'show'){
    $rs = $this->db
                   ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
                   ->get_where('jobber_challan_receipt', array('jobber_challan_receipt.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_challan_receipt.user_id','left')
          ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
          ->get_where('jobber_challan_receipt', array('user_details.user_dept' => $module_permission, 'jobber_challan_receipt.status => 1'))->result();
        }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
			$this->db->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number, DATE_FORMAT(jobber_challan_receipt.jobber_receipt_challan_date, "%d-%m-%Y") as jobber_receipt_challan_date, jobber_challan_receipt.total_jobber_quantity_receipt, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_challan_receipt.am_id', 'left');
            
        if($module_permission == 'show'){
    $rs = $this->db
                   ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
                   ->get_where('jobber_challan_receipt', array('jobber_challan_receipt.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_challan_receipt.user_id','left')
          ->order_by('jobber_challan_receipt.jobber_receipt_challan_number, jobber_challan_receipt.jobber_receipt_challan_date, acc_master.name, jobber_challan_receipt.total_jobber_quantity_receipt')
          ->get_where('jobber_challan_receipt', array('user_details.user_dept' => $module_permission, 'jobber_challan_receipt.status => 1'))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            $temp_co_no = '';
            $temp_challan_no = '';
            $jobber_received_id = $val->jobber_challan_receipt_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = jobber_challan_receipt_details.co_id', 'left')
            ->group_by('jobber_challan_receipt_details.co_id')
            ->order_by('customer_order.co_no')
            ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_received_id, 'jobber_challan_receipt_details.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $jobber_issue_row = $this->db->select('jobber_issue.jobber_challan_number')
            ->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_challan_receipt_details.jobber_challan_number', 'left')
            ->group_by('jobber_challan_receipt_details.jobber_challan_number')
            ->order_by('jobber_issue.jobber_challan_number')
            ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_received_id, 'jobber_challan_receipt_details.status => 1'))->result();
        
        if(count($jobber_issue_row) > 0) {
        foreach ($jobber_issue_row as $j) {
            $temp_challan_no .= $j->jobber_challan_number . '</br>';
             }
            }

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['customer_order'] = $temp_co_no;
            $nestedData['jobber_issue_number'] = $temp_challan_no;
            $nestedData['jobber_name'] = $val->acc_master_name;
			$nestedData['jobber_receipt'] = $val->jobber_receipt_challan_number;
			$nestedData['challan_receipt_date'] = $val->jobber_receipt_challan_date;
			$nestedData['total_quantity'] = $val->total_jobber_quantity_receipt;
			$uvp = $this->_user_wise_view_permission(10, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/jobber-challan-receipt-edit/'.$val->jobber_challan_receipt_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="jobber_challan_receipt_id" pk-value="'.$val->jobber_challan_receipt_id.'" tab="jobber_challan_receipt" child="1" ref-tab="jobber_challan_receipt_details" ref-pk-name="jobber_challan_receipt_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function jobber_challan_receipt_add() {
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_type' => 'Fabricator', 'acc_master.status' => 1))->result();
		
        return array('page'=>'jobber_receipt/jobber_challan_receipt_add_v', 'data'=>$data);
    }
	
	/*public function ajax_jobber_challan_issue_number(){
        $am_id = $this->input->post('am_id');
		$data = array();
		
        $rs = $this->db->get_where('jobber_issue', array('am_id' => $am_id))->num_rows();
		$chalan_number = $rs + 1;
        // echo $this->db->last_query();
		$base_limit = '000';
		$size_chalan = strlen($rs);
		$sob_size_chalan = substr($base_limit, $size_chalan);
		
		$data['jobber_challan_id'] = $sob_size_chalan.$chalan_number;
        return $data;
    }*/

    public function ajax_unique_jobber_receipt_number(){
        $jobber_receipt_challan_number = $this->input->post('jobber_receipt_challan_number');

        $rs = $this->db->get_where('jobber_challan_receipt', array('jobber_receipt_challan_number' => $jobber_receipt_challan_number))->num_rows();
        if($rs != '0') {
            $data = 'Jobber receipt Challan no already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }
	
	//Add main header info
    public function form_jobber_challan_receipt_add(){

        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'jobber_receipt_challan_number' => $this->input->post('jobber_receipt_challan_number'),
            'jobber_receipt_challan_date' => $this->input->post('jobber_receipt_challan_date'),
			'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('jobber_challan_receipt', $insertArray);		
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Jobber Receipt added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }
	
	//Get data before edit
    public function jobber_challan_receipt_edit($jobber_challan_receipt_id) {
		
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id
		
        if($module_permission == 'show'){
          $data['customer_order'] = $this->db->select('co_id, co_no, buyer_reference_no')->get_where('customer_order', array('customer_order.jobber_issue_status' => 1, 'customer_order.status' => 1))->result();
        } else {
                #module_permission contains the dept id now
           $data['customer_order'] = $this->db
           ->join('user_details','user_details.user_id = customer_order.user_id','left')
           ->select('co_id, co_no, buyer_reference_no')
           ->get_where('customer_order', array('customer_order.jobber_issue_status' => 1, 'customer_order.status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
		
		$data['jobber_challan'] = $this->db->select('jobber_issue_id, jobber_challan_number')->get_where('jobber_issue', array( 'jobber_issue.status' => 1))->result();
		
		
		$data['jobber_receipt_details'] = $this->db->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number, DATE_FORMAT(jobber_challan_receipt.jobber_receipt_challan_date, "%d-%m-%Y") as jobber_receipt_challan_date, jobber_challan_receipt.total_jobber_quantity_receipt, jobber_challan_receipt.am_id, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
		->join('acc_master', 'acc_master.am_id = jobber_challan_receipt.am_id', 'left')
		->get_where('jobber_challan_receipt', array('jobber_challan_receipt.status' => 1, 'jobber_challan_receipt.jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result();
		
			
        return array('page'=>'jobber_receipt/jobber_challan_receipt_edit_v', 'data'=>$data);
    }

    public function form_jobber_receipt_edit(){

        $old_array = $this->db->get_where('jobber_challan_receipt', array('jobber_challan_receipt_id' => $this->input->post('jobber_challan_receipt_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('jobber_challan_receipt_id'), 'jobber_challan_receipt');

        $updateArray = array(
            'am_id' => $this->input->post('am_id'),
            'jobber_receipt_challan_number' => $this->input->post('jobber_receipt_challan_number'),
            'jobber_receipt_challan_date' => $this->input->post('jobber_receipt_challan_date'),
            'user_id' => $this->session->user_id
        );
        $jobber_challan_receipt_id = $this->input->post('jobber_challan_receipt_id');
		
        $this->db->update('jobber_challan_receipt', $updateArray, array('jobber_challan_receipt_id' => $jobber_challan_receipt_id));

		//echo $this->db->last_query();die;
		
        $data['type'] = 'success';
        $data['msg'] = 'Jobber Receipt updated successfully.';

        return $data;

    }

    public function ajax_jobber_challan_receipt_details_table_data() {
       
	   $jobber_challan_receipt_id = $this->input->post('jobber_challan_receipt_id');
		//actual db table column names table th order

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id

        $column_orderable = array(
			0 => 'customer_order.co_no',
            1 => 'customer_order.buyer_reference_no',
			2 => 'jobber_issue.jobber_challan_number',
			3 => 'article_master.art_no',
			6 => 'jobber_challan_receipt_details.jobber_receive_quantity'
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no', 'customer_order.buyer_reference_no','jobber_issue.jobber_challan_number','article_master.art_no','jobber_challan_receipt_details.jobber_receive_quantity');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('jobber_challan_receipt_details.jobber_challan_receipt_details_id,  jobber_challan_receipt_details.jobber_challan_receipt_id, jobber_challan_receipt_details.co_id, jobber_challan_receipt_details.buyer_reference_no, jobber_issue.jobber_challan_number, jobber_challan_receipt_details.am_id, jobber_challan_receipt_details.fc_id, jobber_challan_receipt_details.lc_id, jobber_challan_receipt_details.jobber_receive_quantity, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_challan_receipt_details.jobber_challan_number', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = jobber_challan_receipt_details.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = jobber_challan_receipt_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = jobber_challan_receipt_details.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = jobber_challan_receipt_details.lc_id', 'left');
		

        if($module_permission == 'show'){
           $rs = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_challan_receipt_details.user_id','left')
          ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id, 'user_details.user_dept' => $module_permission))->result();
        }
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('jobber_challan_receipt_details.jobber_challan_receipt_details_id,  jobber_challan_receipt_details.jobber_challan_receipt_id, jobber_challan_receipt_details.co_id, jobber_challan_receipt_details.buyer_reference_no, jobber_issue.jobber_challan_number, jobber_challan_receipt_details.am_id, jobber_challan_receipt_details.fc_id, jobber_challan_receipt_details.lc_id, jobber_challan_receipt_details.jobber_receive_quantity, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_challan_receipt_details.jobber_challan_number', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_challan_receipt_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_challan_receipt_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_challan_receipt_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_challan_receipt_details.lc_id', 'left');
            if($module_permission == 'show'){
           $rs = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_challan_receipt_details.user_id','left')
          ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id, 'user_details.user_dept' => $module_permission))->result();
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
			$this->db->select('jobber_challan_receipt_details.jobber_challan_receipt_details_id,  jobber_challan_receipt_details.jobber_challan_receipt_id, jobber_challan_receipt_details.co_id, jobber_challan_receipt_details.buyer_reference_no, jobber_issue.jobber_challan_number, jobber_challan_receipt_details.am_id, jobber_challan_receipt_details.fc_id, jobber_challan_receipt_details.lc_id, jobber_challan_receipt_details.jobber_receive_quantity, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_challan_receipt_details.jobber_challan_number', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_challan_receipt_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_challan_receipt_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_challan_receipt_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_challan_receipt_details.lc_id', 'left');
            if($module_permission == 'show'){
           $rs = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_challan_receipt_details.user_id','left')
          ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id, 'user_details.user_dept' => $module_permission))->result();
        }
			
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			$this->db->select('jobber_challan_receipt_details.jobber_challan_receipt_details_id,  jobber_challan_receipt_details.jobber_challan_receipt_id, jobber_challan_receipt_details.co_id, jobber_challan_receipt_details.buyer_reference_no, jobber_issue.jobber_challan_number, jobber_challan_receipt_details.am_id, jobber_challan_receipt_details.fc_id, jobber_challan_receipt_details.lc_id, jobber_challan_receipt_details.jobber_receive_quantity, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_challan_receipt_details.jobber_challan_number', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_challan_receipt_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_challan_receipt_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_challan_receipt_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_challan_receipt_details.lc_id', 'left');
            if($module_permission == 'show'){
           $rs = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_challan_receipt_details.user_id','left')
          ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id, 'user_details.user_dept' => $module_permission))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

       //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['customer_order_no'] = $val->co_no;
			$nestedData['order_reference_number'] = $val->buyer_reference_no;
			$nestedData['jobber_challan_number'] = $val->jobber_challan_number;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['jobber_receive_quantity'] = $val->jobber_receive_quantity;
            $nestedData['action'] = '<a tab="jobber_challan_receipt_details" tab-pk="jobber_challan_receipt_details_id" data-pk="'.$val->jobber_challan_receipt_details_id.'" ref-tab="jobber_challan_receipt" ref-pk="jobber_challan_receipt_id" ref-val="'.$val->jobber_challan_receipt_id.'" ref-qnty="'.$val->jobber_receive_quantity.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
            $data[] = $nestedData;
			
			/*<a href="javascript:void(0)" jobber_challan_receipt_details_id="'.$val->jobber_challan_receipt_details_id.'" class="jobber_receipt_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>*/
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

	public function ajax_fetch_jobber_challan_details_for_edit(){
		$jobber_issue_detail_id = $this->input->post('jobber_issue_detail_id');
		$data = array();
		
		$this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
		$rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_detail_id' => $jobber_issue_detail_id))->result()[0];
		$data['jobber_issue_details'] = $rs;
		
		$am_id = $rs->am_id;
		$co_id = $rs->co_id;

		$receive_cut_quantity = 0;
		$jobber_issue_quantity = 0;
	
		$receive_cut_quantity = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->receive_cut_quantity;
		
		$jobber_issue_quantity = $this->db->select_sum('jobber_issue_quantity')->get_where('jobber_issue_details', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->jobber_issue_quantity;
		
		$data['receive_cut_quantity'] = $receive_cut_quantity;
		$data['jobber_issue_quantity'] = $jobber_issue_quantity;
		$data['remain_quantity_to_receive'] = ($receive_cut_quantity - $jobber_issue_quantity);
		return $data;
	}
	
    public function form_edit_jobber_issue_challan_details(){
		$jobber_issue_detail_id = $this->input->post('jobber_issue_detail_id_hidden');
		$jobber_issue_quantity = $this->input->post('jobber_issue_quantity_edit');
		
        $updateArray = array(
            'jobber_issue_quantity' => $jobber_issue_quantity,
            'user_id' => $this->session->user_id
        );
		
		
        $this->db->update('jobber_issue_details', $updateArray, array('jobber_issue_detail_id' => $jobber_issue_detail_id));
		$data['type'] = 'success';
        $data['msg'] = 'Jobber Issue details updated successfully.';
        return $data;
	}
    
	
	
	public function get_customer_order_dtl_cutting_receive_jobber(){
        $co_id = $this->input->post('co_id');
		$data = array();
		
		$buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
		
		$data['buyer_reference_no'] = $buyer_reference_no;
		
		$data['article_details'] = $this->db->select('article_master.am_id, article_master.art_no, article_master.alt_art_no, skiving_receive_challan_details.skiving_receive_detail_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id')
		->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left')
		->join('cutting_received_challan_detail', 'cutting_received_challan_detail.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left')
		->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left')
		->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left')
		->group_by('skiving_receive_challan_details.am_id')
		->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.status' => 1, 'cutting_received_challan_detail.co_id' => $co_id))->result();
			
         // echo $this->db->last_query();
	return $data;
	
    }
	//
	public function ajax_get_jobber_issue_challan_number(){
		//jobber_issue_details
		$co_id = $this->input->post('co_id');
		$jobber_challan_receipt_id = $this->input->post('jobber_challan_receipt_id');
		
		$jobber_challan_details = $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.jobber_challan_number')
		->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id', 'left')
		->get_where('jobber_issue_details', array('jobber_issue_details.co_id' => $co_id))->result();
		print_r($jobber_challan_details);
		
		/*$this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id');
		$this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
		return $jobber_issue_details = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();*/
		
    }

    public function jobber_issue_by_customer_order(){
        
        $co_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');

        $buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
        
        $data['buyer_reference_no'] = $buyer_reference_no;

        $query = "
        SELECT jobber_issue_details.`jobber_issue_id`, `cod_id`, 
        `jobber_issue`.`jobber_challan_number` 
        FROM `jobber_issue_details` 
        LEFT JOIN jobber_issue ON `jobber_issue`.`jobber_issue_id` = `jobber_issue_details`.`jobber_issue_id` 
        WHERE co_id = $co_id AND jobber_issue.am_id = $am_id 
        GROUP BY jobber_issue_details.`jobber_issue_id`
        ORDER BY jobber_issue.`jobber_challan_number`
        ";
        // echo $query;
        $data['jobber_issue'] = $this->db->query($query)->result();

        return $data;
        
    }
	
	public function ajax_get_article_info_by_jobber_issue_detail(){
		//jobber_issue_details
		$jobber_issue_id = $this->input->post('jobber_issue_id');
        $jobber_receipt_id = $this->input->post('jobber_challan_receipt_id');
        $order_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');
        $lc_id = $this->input->post('lc_id');

$num = $this->db->select('*')
->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.am_id' => $am_id, 'jobber_challan_receipt_details.co_id' => $order_id,  'lc_id' => $lc_id, 'jobber_challan_receipt_details.jobber_challan_number' => $jobber_issue_id)) 
->num_rows();
// echo $num; die();
if($num == 0) {
        $query = "
    SELECT
        `jobber_issue_details`.`jobber_issue_detail_id`,
        `jobber_issue_details`.`jobber_issue_id`,
        `jobber_issue_details`.`co_id`,
        `jobber_issue_details`.`cod_id`,
        `jobber_issue_details`.`customer_order_reference_number`,
        `jobber_issue_details`.`am_id`,
        `jobber_issue_details`.`fc_id`,
        `jobber_issue_details`.`lc_id`,
        `customer_order`.`co_no`,
        `article_master`.`art_no`,
        `c1`.`color` AS `fitting_color`,
        `c1`.`c_code` AS `fitting_code`,
        `c1`.`c_id` AS `fitting_id`,
        `c2`.`color` AS `leather_color`,
        `c2`.`c_code` AS `leather_code`,
        `c2`.`c_id` AS `leather_id`,
        IFNULL(SUM(`jobber_issue_details`.`jobber_issue_quantity`), 0) AS jobber_issue_quantity,
        0 AS `jobber_receive_quantity`
    FROM
        `jobber_issue_details`
    LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `jobber_issue_details`.`co_id`
    LEFT JOIN `article_master` ON `article_master`.`am_id` = `jobber_issue_details`.`am_id`
    LEFT JOIN `colors` `c1` ON
        `c1`.`c_id` = `jobber_issue_details`.`fc_id`
    LEFT JOIN `colors` `c2` ON
        `c2`.`c_id` = `jobber_issue_details`.`lc_id`
    WHERE
        `jobber_issue_details`.`jobber_issue_id` = $jobber_issue_id  AND `jobber_issue_details`.`co_id` = $order_id AND `jobber_issue_details`.`am_id` = $am_id AND `jobber_issue_details`.`lc_id` = $lc_id
        GROUP BY
       `jobber_issue_details`.`cod_id`,`jobber_issue_details`.`jobber_issue_id`,`jobber_issue_details`.`am_id` 
    ";
    // echo $this->db->last_query(); die();

       return $jobber_issue_details = $this->db->query($query)->result();
   } else {
     $query = "
        SELECT
    temp_jobber_issue.*, `jobber_challan_receipt_details`.`jobber_challan_receipt_id`,
    IFNULL(SUM(`jobber_challan_receipt_details`.`jobber_receive_quantity`), 0) AS jobber_receive_quantity
FROM
    (
    SELECT
        `jobber_issue_details`.`jobber_issue_detail_id`,
        `jobber_issue_details`.`jobber_issue_id`,
        `jobber_issue_details`.`co_id`,
        `jobber_issue_details`.`cod_id`,
        `jobber_issue_details`.`customer_order_reference_number`,
        `jobber_issue_details`.`am_id`,
        `jobber_issue_details`.`fc_id`,
        `jobber_issue_details`.`lc_id`,
        IFNULL(SUM(`jobber_issue_details`.`jobber_issue_quantity`), 0) AS jobber_issue_quantity,
        `customer_order`.`co_no`,
        `article_master`.`art_no`,
        `c1`.`color` AS `fitting_color`,
        `c1`.`c_code` AS `fitting_code`,
        `c1`.`c_id` AS `fitting_id`,
        `c2`.`color` AS `leather_color`,
        `c2`.`c_code` AS `leather_code`,
        `c2`.`c_id` AS `leather_id`
    FROM
        `jobber_issue_details`
    LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `jobber_issue_details`.`co_id`
    LEFT JOIN `article_master` ON `article_master`.`am_id` = `jobber_issue_details`.`am_id`
    LEFT JOIN `colors` `c1` ON
        `c1`.`c_id` = `jobber_issue_details`.`fc_id`
    LEFT JOIN `colors` `c2` ON
        `c2`.`c_id` = `jobber_issue_details`.`lc_id`
    WHERE
        `jobber_issue_details`.`jobber_issue_id` = $jobber_issue_id AND `jobber_issue_details`.`co_id` = $order_id AND `jobber_issue_details`.`am_id` = $am_id AND `jobber_issue_details`.`lc_id` = $lc_id
    GROUP BY
    `jobber_issue_details`.`jobber_issue_id`
    ) AS temp_jobber_issue
    LEFT JOIN `jobber_challan_receipt_details` ON `jobber_challan_receipt_details`.`jobber_challan_number` = `temp_jobber_issue`.`jobber_issue_id` AND `jobber_challan_receipt_details`.`cod_id` = `temp_jobber_issue`.`cod_id` 
    GROUP BY
        `jobber_challan_receipt_details`.`jobber_challan_number`, `jobber_challan_receipt_details`.`cod_id`
        ";

    return $jobber_issue_details = $this->db->query($query)->result();
    
   }
	
// 		$query = "
//         SELECT
//     temp_jobber_issue.*,
//     IFNULL(SUM(`jobber_challan_receipt_details`.`jobber_receive_quantity`), 0) AS jobber_receive_quantity
// FROM
//     (
//     SELECT
//         `jobber_issue_details`.`jobber_issue_detail_id`,
//         `jobber_issue_details`.`jobber_issue_id`,
//         `jobber_issue_details`.`co_id`,
//         `jobber_issue_details`.`cod_id`,
//         `jobber_issue_details`.`customer_order_reference_number`,
//         `jobber_issue_details`.`am_id`,
//         `jobber_issue_details`.`fc_id`,
//         `jobber_issue_details`.`lc_id`,
//         `jobber_issue_details`.`jobber_issue_quantity`,
//         `customer_order`.`co_no`,
//         `article_master`.`art_no`,
//         `c1`.`color` AS `fitting_color`,
//         `c1`.`c_code` AS `fitting_code`,
//         `c1`.`c_id` AS `fitting_id`,
//         `c2`.`color` AS `leather_color`,
//         `c2`.`c_code` AS `leather_code`,
//         `c2`.`c_id` AS `leather_id`
//     FROM
//         `jobber_issue_details`
//     LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `jobber_issue_details`.`co_id`
//     LEFT JOIN `article_master` ON `article_master`.`am_id` = `jobber_issue_details`.`am_id`
//     LEFT JOIN `colors` `c1` ON
//         `c1`.`c_id` = `jobber_issue_details`.`fc_id`
//     LEFT JOIN `colors` `c2` ON
//         `c2`.`c_id` = `jobber_issue_details`.`lc_id`
//     WHERE
//         `jobber_issue_details`.`jobber_issue_id` = $jobber_issue_id
//     ) AS temp_jobber_issue
//     LEFT JOIN `jobber_challan_receipt_details` ON `jobber_challan_receipt_details`.`cod_id` = `temp_jobber_issue`.`cod_id`
//     WHERE
//         `jobber_challan_receipt_details`.`jobber_challan_receipt_id` = $jobber_receipt_id
//     GROUP BY
//         `temp_jobber_issue`.`cod_id`
//         ";

		// $jobber_issue_details = $this->db->query($query)->result();

        // echo $this->db->last_query();
        // return $result;
		
    }
	
    public function ajax_get_article_info_details_wrt_jobber_issue_detail(){
        //jobber_issue_details
        $jobber_issue_id = $this->input->post('jobber_issue_id');
        $jobber_receipt_id = $this->input->post('jobber_challan_receipt_id');
        $order_id = $this->input->post('co_id');
        // $am_id = $this->input->post('am_id');


        $result = $this->db->select('jobber_issue_details.*, article_master.art_no, article_master.alt_art_no, article_master.info, colors.color')
                        ->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id', 'left')
                        ->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left')
                        ->join('colors', 'colors.c_id = jobber_issue_details.lc_id', 'left')
                        ->group_by('jobber_issue_details.jobber_issue_id, jobber_issue_details.cod_id')
                        ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id,
                            'jobber_issue_details.co_id' => $order_id,
                            'jobber_issue.status => 1'))->result();
    
     

        // echo $this->db->last_query();
        return $result;
        
    }
	public function ajax_get_received_quantity_in_cutting(){
        $am_id = $this->input->post('am_id');
		$co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('cod_id');
		$receive_cut_quantity = 0;
		$jobber_issue_quantity = 0;
		
		$data = array();
		
		$receive_cut_quantity = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->receive_cut_quantity;
		
		$jobber_issue_quantity = $this->db->select_sum('jobber_issue_quantity')->get_where('jobber_issue_details', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->jobber_issue_quantity;
		
		$data['receive_cut_quantity'] = $receive_cut_quantity;
		$data['jobber_issue_quantity'] = $jobber_issue_quantity;
		$data['remain_quantity_to_receive'] = ($receive_cut_quantity - $jobber_issue_quantity);
		
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
	
    public function form_add_jobber_receipt_challan_details(){
		
		$jobber_challan_receipt_id = $this->input->post('jobber_challan_receipt_id');
		
        $co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('cod_id_add');
		$buyer_reference_no = $this->input->post('buyer_reference_no_add');
		$jobber_challan_number = $this->input->post('jobber_challan_number_add');
		$am_id = $this->input->post('am_id_add');
		$lc_id = $this->input->post('lc_id');
		$fc_id = $this->input->post('fc_id');
		$jobber_receive_quantity = $this->input->post('jobber_receive_quantity_add');
		
// 		$rs = $this->db->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt_details.jobber_challan_receipt_id' => $jobber_challan_receipt_id, 'jobber_challan_receipt_details.cod_id' => $cod_id, 'jobber_challan_receipt_details.jobber_challan_number' => $jobber_challan_number, 'jobber_challan_receipt_details.am_id' => $am_id, 'jobber_challan_receipt_details.lc_id' => $lc_id, 'jobber_challan_receipt_details.jobber_receive_quantity' => $jobber_receive_quantity))->num_rows();
		
// 		if($rs == 0) {
		
		$insertArray = array(
			'jobber_challan_receipt_id' => $jobber_challan_receipt_id,
			'co_id' => $co_id,
			'cod_id' => $cod_id,
			'buyer_reference_no' => $buyer_reference_no,
			'jobber_challan_number' => $jobber_challan_number,
			'am_id' => $am_id,
			'fc_id' => $fc_id,
			'lc_id' => $lc_id,
			'jobber_receive_quantity' => $jobber_receive_quantity,
			'user_id' => $this->session->user_id
		);
		$this->db->insert('jobber_challan_receipt_details', $insertArray);
		//echo $this->db->last_query(); die;
		
		$insert_id = $this->db->insert_id();		
		$data['insert_id'] = $insert_id;
		
		$total_jobber_quantity_receipt_old = $this->db->select_sum('total_jobber_quantity_receipt')->get_where('jobber_challan_receipt', array('jobber_challan_receipt_id' => $jobber_challan_receipt_id))->result()[0]->total_jobber_quantity_receipt;
		$total_jobber_quantity_receipt_new = $total_jobber_quantity_receipt_old + $jobber_receive_quantity;
		
		$updateArray = array(
            'total_jobber_quantity_receipt' => $total_jobber_quantity_receipt_new
        );	
		
        $this->db->update('jobber_challan_receipt', $updateArray, array('jobber_challan_receipt_id' => $jobber_challan_receipt_id));
        
// 		}
        
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['total_jobber_quantity_receipt_new'] = $total_jobber_quantity_receipt_new;
			$data['msg'] = 'Jobber Receipt Details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Insert function Error';
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

    public function delete_jobber_challan_header(){

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
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		$ref_table = $this->input->post('ref_table');
		$ref_pk_name = $this->input->post('ref_pk_name');
		
		//delete child table
		$this->db->where($ref_pk_name, $pk_value)->delete($ref_table);
		
		//Delete Header/main table
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Jobber Receipt Successfully Deleted';
        return $data;
    }
	
	public function delete_jobber_receipt_challan_detail_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
		
		$ref_tab = $this->input->post('ref_tab');
		$ref_pk = $this->input->post('ref_pk');
		$ref_val = $this->input->post('ref_val');
        $ref_qnty = $this->input->post('ref_qnty');
		
		//$this->db->where($ref_pk, $ref_val)->delete($ref_tab);

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

        $old_qnty = $this->db->get_where($ref_tab, array($ref_pk => $ref_val))->row()->total_jobber_quantity_receipt;

        $new_qnty = ($old_qnty - $ref_qnty);

        $update_array = array(
          'total_jobber_quantity_receipt' => $new_qnty 
        );

        $this->db->update($ref_tab, $update_array,array($ref_pk => $ref_val));

        $this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['new_qty'] = $new_qnty;
        $data['type'] = 'success';
        $data['msg'] = 'Jobber Receipt detail deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}