<?php


class Checking_m extends CI_Model {

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

    public function checking_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(13, $this->session->user_id);
        return array('page'=>'checking/checking_list_v', 'data'=>$data);
    }

    public function ajax_checking_table_data() {

                   // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(5, $session_user_id); #1 = costing module_id

        //actual db table column names
        $column_orderable = array(
			0 => 'employees.name',
            1 => 'checking.checking_entry_date'
        );
        // Set searchable column fields
        $column_search = array('employees.name','checking.checking_entry_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];
                $rs = $this->db->get('checking')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
            $this->db->select('checking.checking_id, checking.e_id, DATE_FORMAT(checking.checking_entry_date, "%d-%m-%Y") as checking_entry_date, employees.name as employees_name, checking.extra_time');
			$this->db->join('employees', 'employees.e_id = checking.e_id', 'left');
                $rs = $this->db->order_by('employees.name, checking.checking_entry_date', 'asc')->get_where('checking', array('checking.status => 1'))->result();
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

            $this->db->select('checking.checking_id, checking.extra_time, checking.e_id, DATE_FORMAT(checking.checking_entry_date, "%d-%m-%Y") as checking_entry_date, employees.name as employees_name');
			$this->db->join('employees', 'employees.e_id = checking.e_id', 'left');
                $rs = $this->db->order_by('employees.name, checking.checking_entry_date', 'asc')->get_where('checking', array('checking.status => 1'))->result();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
			$this->db->select('checking.checking_id, checking.e_id, checking.extra_time, DATE_FORMAT(checking.checking_entry_date, "%d-%m-%Y") as checking_entry_date, employees.name as employees_name');
			$this->db->join('employees', 'employees.e_id = checking.e_id', 'left');

                $rs = $this->db->order_by('employees.name, checking.checking_entry_date', 'asc')->get_where('checking', array('checking.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            $temp_co_no = '';
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = checking_details.co_id', 'left')
            ->group_by('checking_details.checking_id, checking_details.co_id')
            ->get_where('checking_details', array('checking_details.checking_id' => $val->checking_id, 'checking_details.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }
            
            $total_checking_qnty_vals = 0;
            $checking_row = $this->db->select('sum(checked_quantity) as checked_quantity')
            ->group_by('checking_details.checking_id')
            ->get_where('checking_details', array('checking_details.checking_id' => $val->checking_id, 'checking_details.status => 1'))->row();
            
            if(count($checking_row) > 0) {
               $total_checking_qnty_vals = $checking_row->checked_quantity;  
            }

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}
			$nestedData['checking_id'] = $val->checking_id;
			$nestedData['e_id'] = $val->e_id;
            $nestedData['employee_name'] = $val->employees_name;
            $nestedData['extra_time'] = $val->extra_time;
			$nestedData['checking_start_date'] = $val->checking_entry_date;
            $nestedData['order_no'] = $temp_co_no;
            $nestedData["tots_vals"] = $total_checking_qnty_vals;
            $uvp = $this->_user_wise_view_permission(13, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/checking-list-edit/'.$val->checking_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="checking_id" pk-value="'.$val->checking_id.'" tab="checking" child="1" ref-tab="checking_details" ref-pk-name="checking_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function checking_list_add() {
        $data['employee_details'] = $this->db->select('e_id, name, e_code')->get_where('employees', array('employees.status' => 1, 'user_id !=' => 13))->result();
		
        return array('page'=>'checking/checking_add_v', 'data'=>$data);
    }
	
	public function ajax_jobber_challan_issue_number(){
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
    public function form_checking_list_add(){

        $insertArray = array(
            'extra_time' => $this->input->post('extra_time'),
            'e_id' => $this->input->post('e_id'),
            'checking_entry_date' => $this->input->post('checking_start_date_time'),
			'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('checking', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Checking List added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }
	
	//Get data before edit
    public function checking_list_edit($checking_id) {
		
       $data['employee_details'] = $this->db->select('e_id, name, e_code')->get_where('employees', array('employees.status' => 1, 'user_id !=' => 13))->result();
		
		$data['customer_order'] = $this->db->select('co_id, co_no')->get_where('customer_order', array( 'customer_order.status' => 1))->result();
		
		$data['checking_details'] = $this->db->select('checking.checking_id, checking.e_id, DATE_FORMAT(checking.checking_entry_date, "%d-%m-%Y") as checking_entry_date, employees.name as employees_name, checking.extra_time')
		->join('employees', 'employees.e_id = checking.e_id', 'left')
		->get_where('checking', array('checking.checking_id' => $checking_id))->result();
			
        return array('page'=>'checking/checking_list_edit_v', 'data'=>$data);
    }

    public function form_checking_list_edit(){
        $updateArray = array(
            'extra_time' => $this->input->post('extra_time'),
            'e_id' => $this->input->post('e_id'),
            'checking_entry_date' => $this->input->post('checking_start_date_time'),
            'user_id' => $this->session->user_id
        );
        $checking_id = $this->input->post('checking_id');
		
        $this->db->update('checking', $updateArray, array('checking_id' => $checking_id));

		//echo $this->db->last_query();die;
		
        $data['type'] = 'success';
        $data['msg'] = 'Checking updated successfully.';

        return $data;

    }
	
	public function get_customer_order_dtl_for_checking(){
        $co_id = $this->input->post('co_id');
        $this->db->select('customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.alt_art_no');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $co_id))->result();
// 			print_r($rs); die();
			
			for($i = 0; $i < sizeof($rs); $i++){
				$cod_id = 0;
				$am_id = 0;
				$co_quantity = 0;
				$checked_quantity = 0;
				$remaining_checking_quantity = 0;
				
				$cod_id = $rs[$i]->cod_id;
				$am_id = $rs[$i]->am_id;
				$co_quantity = $rs[$i]->co_quantity;
				
				$checked_quantity = $this->db->select_sum('checked_quantity')->get_where('checking_details', array('cod_id' => $cod_id, 'am_id' => $am_id))->result()[0]->checked_quantity;
				
				$remaining_checking_quantity = ($co_quantity - $checked_quantity);


				$rs[$i]->checked_quantity = $checked_quantity;
				$rs[$i]->remaining_checking_quantity = $remaining_checking_quantity;
			}//end for
			
			//echo json_encode($rs);
			return $rs;
    }
    
    public function get_customer_order_dtl_for_checking_am_id(){
        $cod_id = $this->input->post('cod_id');
        $remarks_for_other_quantity = $this->input->post('remarks_for_other_quantity');
        $this->db->select('customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.alt_art_no');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.cod_id' => $cod_id))->row();
			//print_r($rs); die();
			
				$cod_id = 0;
				$am_id = 0;
				$co_quantity = 0;
				$checked_quantity = 0;
				$remaining_checking_quantity = 0;
				
				$cod_id = $rs->cod_id;
				$am_id = $rs->am_id;
				$co_quantity = $rs->co_quantity;
				
				
				if($remarks_for_other_quantity == 'CHECKING') {
				    $checked_quantity = $this->db->select_sum('checked_quantity')->get_where('checking_details', array('cod_id' => $cod_id, 'am_id' => $am_id, 'remarks_for_other_quantity' => $remarks_for_other_quantity))->result()[0]->checked_quantity;
				} else {
				    $checked_quantity = $this->db->select_sum('rejection_quantity')->get_where('checking_details', array('cod_id' => $cod_id, 'am_id' => $am_id, 'remarks_for_other_quantity' => $remarks_for_other_quantity))->result()[0]->rejection_quantity;    
				}
				 
				 
				$remaining_checking_quantity = ($co_quantity - $checked_quantity);
				
				
				
				$rs->checked_quantity = $checked_quantity;
				$rs->remaining_checking_quantity = $remaining_checking_quantity;
			
			//echo json_encode($rs);
			return $rs;
    }

    public function ajax_checking_list_details_table_data() {
       
	   $checking_id = $this->input->post('checking_id');
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'customer_order.co_no',
            1 => 'article_master.art_no',
			4 => 'checking_details.checked_quantity',
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no', 'article_master.art_no', 'checking_details.checked_quantity','checking_details.remarks');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('checking_details')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('checking_details.checking_detail_id, checking_details.checking_id, checking_details.remarks_for_other_quantity, checking_details.co_id, checking_details.cod_id, checking_details.am_id, checking_details.checked_quantity, checking_details.remarks, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, checking_details.rejection_quantity');
			$this->db->join('customer_order', 'customer_order.co_id = checking_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = checking_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = checking_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = checking_details.lc_id', 'left');
            $rs = $this->db->get_where('checking_details', array('checking_details.checking_id' => $checking_id))->result();
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
			$this->db->select('checking_details.checking_detail_id,  checking_details.checking_id, checking_details.remarks_for_other_quantity, checking_details.co_id, checking_details.cod_id, checking_details.am_id, checking_details.checked_quantity, checking_details.remarks, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, checking_details.rejection_quantity');
			$this->db->join('customer_order', 'customer_order.co_id = checking_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = checking_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = checking_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = checking_details.lc_id', 'left');
            $rs = $this->db->get_where('checking_details', array('checking_details.checking_id' => $checking_id))->result();
			
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			$this->db->select('checking_details.checking_detail_id,  checking_details.checking_id, checking_details.remarks_for_other_quantity, checking_details.co_id, checking_details.cod_id, checking_details.am_id, checking_details.checked_quantity, checking_details.remarks, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, checking_details.rejection_quantity');
			$this->db->join('customer_order', 'customer_order.co_id = checking_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = checking_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = checking_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = checking_details.lc_id', 'left');
            $rs = $this->db->get_where('checking_details', array('checking_details.checking_id' => $checking_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

       //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['checking_type'] = $val->remarks_for_other_quantity;
            $nestedData['order_number'] = $val->co_no;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['leather_colour'] = $val->leather_color;
			$nestedData['fitting_colour'] = $val->fitting_color;
			$nestedData['quantity'] = $val->checked_quantity;
			$nestedData['rejection_quantity'] = $val->rejection_quantity;
			$nestedData['remarks'] = $val->remarks;
            $nestedData['action'] = '<a href="javascript:void(0)" checking_detail_id="'.$val->checking_detail_id.'" class="checking_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="checking_details" tab-pk="checking_detail_id" data-pk="'.$val->checking_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

	public function ajax_fetch_checking_details_for_edit(){
		$checking_detail_id = $this->input->post('checking_detail_id');
		$data = array();
		
		$this->db->select('checking_details.checking_detail_id,  checking_details.checking_id, checking_details.co_id, checking_details.cod_id, checking_details.am_id, checking_details.checked_quantity, checking_details.rejection_quantity, checking_details.remarks_for_other_quantity, checking_details.remarks, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('customer_order', 'customer_order.co_id = checking_details.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = checking_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = checking_details.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = checking_details.lc_id', 'left');
		$rs = $this->db->get_where('checking_details', array('checking_details.checking_detail_id' => $checking_detail_id))->result()[0];
		$data['checking_detail'] = $rs;
		
		
		/*$am_id = $rs->am_id;
		$co_id = $rs->co_id;

		$receive_cut_quantity = 0;
		$jobber_issue_quantity = 0;
	
		$receive_cut_quantity = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->receive_cut_quantity;
		
		$jobber_issue_quantity = $this->db->select_sum('jobber_issue_quantity')->get_where('jobber_issue_details', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->jobber_issue_quantity;
		
		$data['receive_cut_quantity'] = $receive_cut_quantity;
		$data['jobber_issue_quantity'] = $jobber_issue_quantity;
		$data['remain_quantity_to_receive'] = ($receive_cut_quantity - $jobber_issue_quantity);*/
		return $data;
	}
	
    public function form_edit_checking_list_details(){
		$checked_quantity_edit = $this->input->post('checked_quantity_edit');
		$checking_detail_id = $this->input->post('checking_detail_id_edit');
        $rejection_quantity = $this->input->post('checked_alter_edit');
        $remarks_edit = $this->input->post('remarks_edit');
        
        $updateArray = array(
            'checked_quantity' => $checked_quantity_edit,
            'rejection_quantity' => $rejection_quantity,
            'remarks' => $remarks_edit,
            'user_id' => $this->session->user_id
        );
		
		
        $this->db->update('checking_details', $updateArray, array('checking_detail_id' => $checking_detail_id));
		$data['type'] = 'success';
        $data['msg'] = 'Checking details updated successfully.';
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
	
    public function form_add_checking_list_details(){
		
		$checking_id = $this->input->post('checking_id');
        $co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('am_id_add');
		$am_id = $this->input->post('new_am_id_add_hidden');
		$fc_id = $this->input->post('fc_id');
		$lc_id = $this->input->post('lc_id');
		$checked_quantity = $this->input->post('checked_quantity_add');
		$rejection_quantity = $this->input->post('checked_alter_add');
		$remarks_for_other_quantity = $this->input->post('remarks_for_other_quantity');
		$remarks = $this->input->post('remarks_add');
		
		$insertArray = array(
			'checking_id' => $checking_id,
			'co_id' => $co_id,
			'cod_id' => $cod_id,
			'am_id' => $am_id,
			'fc_id' => $fc_id,
			'lc_id' => $lc_id,
			'checked_quantity' => $checked_quantity,
			'rejection_quantity' => $rejection_quantity,
			'remarks_for_other_quantity' => $remarks_for_other_quantity,
			'remarks' => $remarks,
			'user_id' => $this->session->user_id
		);
		$this->db->insert('checking_details', $insertArray);
		$insert_id = $this->db->insert_id();
		
		$data['insert_id'] = $insert_id;
        
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Checking List added successfully.';
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

    public function checking_list_delete(){
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
        $data['msg'] = 'Checking Detail Successfully Deleted';
        return $data;
    }
	
	public function del_checking_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
		
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Checking detail list deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}