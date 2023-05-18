<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 19-03-2020
 * Time: 09:30
 */

class Sample_bill_m extends CI_Model {

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

    public function sample_bill() {
        $data = '';
        $data["view_permission"] = $this->_user_wise_view_permission(41, $this->session->user_id);
        return array('page'=>'sample_bill/sample_bill_list_v', 'data'=>$data);
    }

    public function ajax_sample_bill_table_data() {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(17, $session_user_id); #17 = sample module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'acc_master.name',
            1 => 'sample_bill.sample_bill_number',
            2 => 'sample_bill.sample_bill_date',
            3 => 'sample_bill.deduction',
            4 => 'sample_bill.addition',
            5 => 'sample_bill.net_bill'
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'sample_bill.sample_bill_number', 'sample_bill.jobber_bill_date', 'sample_bill.deduction', 'sample_bill.addition', 'sample_bill.net_bill');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('sample_bill')->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = sample_bill.user_id','left')
          ->get_where('sample_bill', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_bill.sample_bill_id, sample_bill.am_id, sample_bill.sample_bill_number, DATE_FORMAT(sample_bill.sample_bill_date, "%d-%m-%Y") as sample_bill_date, sample_bill.article_quantity, sample_bill.article_total, sample_bill.bill_amount, sample_bill.deduction, sample_bill.addition, sample_bill.net_bill, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_bill.am_id', 'left');

        if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_bill', array('sample_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = sample_bill.user_id','left')
          ->get_where('sample_bill', array('user_details.user_dept' => $module_permission, 'sample_bill.status => 1'))->result();
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

            $this->db->select('sample_bill.sample_bill_id, sample_bill.am_id, sample_bill.sample_bill_number, DATE_FORMAT(sample_bill.sample_bill_date, "%d-%m-%Y") as sample_bill_date, sample_bill.article_quantity, sample_bill.article_total, sample_bill.bill_amount, sample_bill.deduction, sample_bill.addition, sample_bill.net_bill, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_bill.am_id', 'left');

    if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_bill', array('sample_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = sample_bill.user_id','left')
          ->get_where('sample_bill', array('user_details.user_dept' => $module_permission, 'sample_bill.status => 1'))->result();
        }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_bill.sample_bill_id, sample_bill.am_id, sample_bill.sample_bill_number, DATE_FORMAT(sample_bill.sample_bill_date, "%d-%m-%Y") as sample_bill_date, sample_bill.article_quantity, sample_bill.article_total, sample_bill.bill_amount, sample_bill.deduction, sample_bill.addition, sample_bill.net_bill, acc_master.name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_bill.am_id', 'left');

        if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_bill', array('sample_bill.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = sample_bill.user_id','left')
          ->get_where('sample_bill', array('user_details.user_dept' => $module_permission, 'sample_bill.status => 1'))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
            $nestedData['jobber'] = $val->name;
            $nestedData['sample_bill_number'] = $val->sample_bill_number;
            $nestedData['bill_date'] = $val->sample_bill_date;
            $nestedData['deduction'] = $val->deduction;
            $nestedData['addition'] = $val->addition;
            $nestedData['net_bill_amoun'] = $val->net_bill;
            $uvp = $this->_user_wise_view_permission(41, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-sample-bill/'.$val->sample_bill_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            
            <a href="javascript:void(0)" pk-name="sample_bill_id" pk-value="'.$val->sample_bill_id.'" tab="sample_bill" child="1" ref-table="sample_bill_detail" ref-pk-name="sample_bill_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

	// ADD supp.purchase ORDER 

    public function add_sample_bill() {
        $data['jobber_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
		
        return array('page'=>'sample_bill/sample_bill_add_v', 'data'=>$data);
    }

    public function ajax_unique_sample_bill_number(){
        $sample_bill_number = $this->input->post('sample_bill_number');

        $rs = $this->db->get_where('sample_bill', array('sample_bill_number' => $sample_bill_number))->num_rows();
        if($rs != '0') {
            $data = 'Sample Bill Number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_sample_bill_add(){

        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'sample_bill_number' => $this->input->post('sample_bill_number'),
            'sample_bill_date' => $this->input->post('sample_bill_date'),
            'user_id' => $this->session->user_id
        );

        $this->db->insert('sample_bill', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Sample Bill added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_sample_bill($sample_bill_id) {
        $data['sample_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
		
        $sample_bill_detail = $this->db->select('sample_bill.sample_bill_id, sample_bill.am_id, sample_bill.sample_bill_number, DATE_FORMAT(sample_bill.sample_bill_date, "%d-%m-%Y") as sample_bill_date, sample_bill.article_quantity, sample_bill.article_total, sample_bill.bill_amount, sample_bill.deduction, sample_bill.addition, sample_bill.net_bill, acc_master.name')
		->join('acc_master', 'acc_master.am_id = sample_bill.am_id', 'left')
		->get_where('sample_bill', array('sample_bill.sample_bill_id' => $sample_bill_id))->result();

		$data['sample_bill_detail'] = $sample_bill_detail;
		$am_id = $sample_bill_detail[0]->am_id;

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(17, $session_user_id); #17 = sample module_id 

		if($module_permission == 'show'){
            $data['sample_challan_receipt'] = $this->db->select('sample_challan_receipt_id, sample_receipt_challan_number')->get_where('sample_receive', array('sample_receive.am_id' => $am_id, 'sample_receive.status' => 1, 'sample_receive.sample_bill_status' => 0))->result();
        } else {
                #module_permission contains the dept id now
            $data['sample_challan_receipt'] = $this->db->select('sample_challan_receipt_id, sample_receipt_challan_number')
            ->join('user_details','user_details.user_id = sample_receive.user_id','left')
            ->get_where('sample_receive', array('sample_receive.am_id' => $am_id, 'sample_receive.status' => 1, 'sample_receive.sample_bill_status' => 0, 'user_details.user_dept' => $module_permission))->result();
        }
		
		
        return array('page'=>'sample_bill/sample_bill_edit_v', 'data'=>$data);
    }

    public function form_edit_sample_bill(){
        $updateArray = array(
            'am_id' => $this->input->post('am_id'),
            'sample_bill_number' => $this->input->post('sample_bill_number'),
            'sample_bill_date' => $this->input->post('sample_bill_date'),
            'user_id' => $this->session->user_id
        );
        $sample_bill_id = $this->input->post('sample_bill_id');
		
        $this->db->update('sample_bill', $updateArray, array('sample_bill_id' => $sample_bill_id));

        $data['type'] = 'success';
        $data['msg'] = 'Sample Bill updated successfully.';

        return $data;

    }
	
	public function form_sample_bill_net_amount(){
        $updateArray = array(
            'article_quantity' => $this->input->post('article_quantity'),
            'article_total' => $this->input->post('article_total'),
            'bill_amount' => $this->input->post('bill_amount'),
            'deduction' => $this->input->post('deduction'),
            'addition' => $this->input->post('addition'),
            'net_bill' => $this->input->post('net_bill'),
            'user_id' => $this->session->user_id
        );
        $hidden_sample_bill_id = $this->input->post('hidden_sample_bill_id');
		
        $this->db->update('sample_bill', $updateArray, array('sample_bill_id' => $hidden_jobber_bill_id));

        $data['type'] = 'success';
        $data['msg'] = 'Sample Total amount updated successfully.';

        return $data;

    }

    public function sample_bill_details_table() {
        $sample_bill_id = $this->input->post('sample_bill_id');
        //actual db table column names table th order
        $column_orderable = array(
            0 => 'sample_receive.sample_receipt_challan_number',
            1 => 'sample_issue.sample_challan_number',
            2 => 'article_master.art_no',
            5 => 'sample_bill_detail.quantity',
            6 => 'sample_bill_detail.rate',
            7 => 'sample_bill_detail.total'
        );
        // Set searchable column fields
        $column_search = array('sample_receive.sample_receipt_challan_number', 'sample_issue.sample_challan_number', 'article_master.art_no', 'sample_bill_detail.quantity', 'sample_bill_detail.rate', 'sample_bill_detail.total');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('sample_bill_detail.sample_bill_detail_id, sample_bill_detail.sample_bill_id,sample_bill_detail.sample_challan_receipt_id, sample_receive.sample_receipt_challan_number, sample_issue.sample_challan_number, article_master.art_no, sample_bill_detail.quantity, sample_bill_detail.rate, sample_bill_detail.total, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('sample_receive', 'sample_receive.sample_challan_receipt_id = sample_bill_detail.sample_challan_receipt_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_bill_detail.sample_issue_id', 'left');
            
            $this->db->join('article_master', 'article_master.am_id = sample_bill_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_bill_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_bill_detail.lc_id', 'left');
            $rs = $this->db->get_where('sample_bill_detail', array('sample_bill_detail.sample_bill_id' => $sample_bill_id))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_bill_detail.sample_bill_detail_id, 
                sample_bill_detail.sample_bill_id, sample_bill_detail.sample_challan_receipt_id, sample_receive.sample_receipt_challan_number, sample_issue.sample_challan_number, article_master.art_no, sample_bill_detail.quantity, sample_bill_detail.rate, sample_bill_detail.total, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('sample_receive', 'sample_receive.sample_challan_receipt_id = sample_bill_detail.sample_challan_receipt_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_bill_detail.sample_issue_id', 'left');
            
            $this->db->join('article_master', 'article_master.am_id = sample_bill_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_bill_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_bill_detail.lc_id', 'left');
            $rs = $this->db->get_where('sample_bill_detail', array('sample_bill_detail.sample_bill_id' => $sample_bill_id))->result();
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

            $this->db->select('sample_bill_detail.sample_bill_detail_id, sample_bill_detail.sample_bill_id,sample_bill_detail.sample_challan_receipt_id, sample_receive.sample_receipt_challan_number, sample_issue.sample_challan_number, article_master.art_no, sample_bill_detail.quantity, sample_bill_detail.rate, sample_bill_detail.total, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('sample_receive', 'sample_receive.sample_challan_receipt_id = sample_bill_detail.sample_challan_receipt_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_bill_detail.sample_issue_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = sample_bill_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_bill_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_bill_detail.lc_id', 'left');
            $rs = $this->db->get_where('sample_bill_detail', array('sample_bill_detail.sample_bill_id' => $sample_bill_id))->result();       

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_bill_detail.sample_bill_detail_id, sample_bill_detail.sample_bill_id, sample_bill_detail.sample_challan_receipt_id, sample_receive.sample_receipt_challan_number, sample_issue.sample_challan_number, article_master.art_no, sample_bill_detail.quantity, sample_bill_detail.rate, sample_bill_detail.total, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('sample_receive', 'sample_receive.sample_challan_receipt_id = sample_bill_detail.sample_challan_receipt_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_bill_detail.sample_issue_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = sample_bill_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_bill_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_bill_detail.lc_id', 'left');
            $rs = $this->db->get_where('sample_bill_detail', array('sample_bill_detail.sample_bill_id' => $sample_bill_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['sample_receipt_number'] = $val->sample_receipt_challan_number;
            $nestedData['sample_issue_challan_number'] = $val->sample_challan_number;
            $nestedData['article_id'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['fitting_color'] = $val->fitting_color;
            $nestedData['quantity'] = $val->quantity;
            $nestedData['rate'] = $val->rate;
            $nestedData['total'] = $val->total;

            $nestedData['action'] = '<a tab="sample_bill_detail" tab-pk="sample_challan_receipt_id" 
            tab-val="'.$val->sample_challan_receipt_id.'" data-tab="sample_bill" data-pk="sample_bill_id" data-tab-val="'.$val->sample_bill_id.'" quantity="'.$val->quantity.'" rate="'.$val->rate.'" total="'.$val->total.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function ajax_all_items_on_item_group(){
        $item_group = $this->input->post('item_group');
        $this->db->select('item_dtl.*, item_master.item as item_name, item_groups.group_name, item_groups.value, units.unit');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
        $this->db->group_by('item_master.item');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_master.ig_id' => $item_group))->result_array();
    }
    
	public function sample_bill_get_customer_order_dtl(){
        $sample_receive_id = $this->input->post('sample_challan_receipt_id');
        
        $this->db->select('sample_receive_details.sample_challan_receipt_details_id, sample_receive_details.sample_challan_receipt_id, sample_receive_details.am_id, sample_receive_details.lc_id, sample_receive_details.fc_id, sample_receive_details.sample_receive_quantity, sample_receive.sample_challan_receipt_id, sample_receive.sample_receipt_challan_number, sample_issue.sample_issue_id, sample_issue.sample_challan_number, article_master.art_no, article_master.alt_art_no, article_master.fabrication_rate_b, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
        $this->db->join('sample_receive', 'sample_receive.sample_challan_receipt_id = sample_receive_details.sample_challan_receipt_id', 'left');
        $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_receive_details.sample_challan_number', 'left');
        $this->db->join('article_master', 'article_master.am_id = sample_receive_details.am_id', 'left');
            
            //$this->db->join('sample_issue_details', 'sample_issue_details.co_id = customer_order_dtl.co_id', 'left');
            //$this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_issue_details.sample_issue_id', 'left');
            
            $this->db->join('colors c1', 'c1.c_id = sample_receive_details.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_receive_details.lc_id', 'left');
            $rs = $this->db->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_receive_id))->result();

            for($i = 0; $i < sizeof($rs); $i++){
                $fabrication_rate_b = 0;
                $sample_receive_quantity = 0;
                $total = 0;
                
                $fabrication_rate_b = $rs[$i]->fabrication_rate_b;
                $sample_receive_quantity = $rs[$i]->sample_receive_quantity;
                
                $rs[$i]->rate = $fabrication_rate_b;
                
                $total = $sample_receive_quantity * $fabrication_rate_b;                                
                $rs[$i]->total = $total; 
            }
            
            //echo json_encode($rs);
            return $rs;
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
	
    public function add_sample_bill_details(){
        $sample_bill_id = $this->input->post('sample_bill_id');

        $sample_challan_receipt_id = $this->input->post('sample_challan_receipt_id');       
        $sample_issue_id = $this->input->post('sample_issue_id');
        $am_id = $this->input->post('am_id');
        $fc_id = $this->input->post('fc_id');
        $lc_id = $this->input->post('lc_id');       
        $quantity = $this->input->post('quantity');
        $extra_quantity = $this->input->post('extra_quantity');     
        $rate = $this->input->post('rate');
        $total = $this->input->post('total');
        
        $sample_bill_remarks = $this->input->post('sample_bill_remarks');
        
        $article_quantity = 0;
        $article_total = 0;
        $bill_amount = 0;
        $deduction = 0;
        $addition = 0;
        $net_bill = 0;
        
        
        $sample_bill_data_rs = $this->db->select('article_quantity, article_total, bill_amount, deduction, addition, net_bill')->get_where('sample_bill', array('sample_bill_id' => $sample_bill_id))->num_rows();
                
        if($sample_bill_data_rs > 0){
            $sample_bill_data = $this->db->select('article_quantity, article_total, bill_amount, deduction, addition, net_bill')->get_where('sample_bill', array('sample_bill_id' => $sample_bill_id))->result()[0];
            
            $article_quantity = $sample_bill_data->article_quantity;
            $article_total = $sample_bill_data->article_total;
            $bill_amount = $sample_bill_data->bill_amount;
            $deduction = $sample_bill_data->deduction;
            $addition = $sample_bill_data->addition;
            $net_bill = $sample_bill_data->net_bill;
        }
        
        //$total_value = $this->db->select('total_value')->get_where('office_proforma', array('office_proforma_id' => $office_proforma_id))->result()[0]->total_value;
        
        for($i = 0; $i < sizeof($sample_challan_receipt_id); $i++){
            
            $article_quantity = $article_quantity + $quantity[$i];
            $article_total = $article_total + $total[$i];
            $qty = $quantity[$i] + $extra_quantity[$i];
            $net_bill = $net_bill + $total[$i];
            $bill_amount = $bill_amount + $total[$i]; 
            
            $insertArray = array(
                'sample_bill_id' => $sample_bill_id,
                'sample_challan_receipt_id' => $sample_challan_receipt_id[$i],
                'sample_issue_id' => $sample_issue_id[$i],
                'am_id' => $am_id[$i],
                'fc_id' => $fc_id[$i],
                'lc_id' => $lc_id[$i],
                'quantity' => $qty,
                'rate' => $rate[$i],
                'total' => $total[$i],
                'user_id' => $this->session->user_id
            );
            $this->db->insert('sample_bill_detail', $insertArray);
            $insert_id = $this->db->insert_id();
            
        }//end for
        $data['insert_id'] = $insert_id;
        
        $updateArray = array(
            'article_quantity' => $article_quantity,
            'article_total' => $article_total,
            'net_bill' => $net_bill,
            'bill_amount' => $bill_amount,
        );
        $this->db->update('sample_bill', $updateArray, array('sample_bill_id' => $sample_bill_id));
        
        $sample_challan_receipt_id1 = $sample_challan_receipt_id[0];
        $sample_bill_status = 1;
        $updateArray = array(
            'sample_bill_status' => $sample_bill_status
        );
        $this->db->update('sample_receive', $updateArray, array('sample_challan_receipt_id' => $sample_challan_receipt_id1));
                
        if($insert_id > 0){
            $data['type'] = 'success';
            $data['article_quantity'] = $article_quantity;
            $data['article_total'] = $article_total;
            $data['msg'] = 'sample Bill details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function ajax_fetch_supp_purchase_order_details_on_pk(){
        $supp_dtl_id = $this->input->post('supp_dtl_id');
        return $this->db
            ->select('supp_purchase_order.*, supp_purchase_order_detail.*, acc_master.name, acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, item_groups.group_name, thick')
            ->join('supp_purchase_order', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left') // 
            ->join('acc_master', 'acc_master.am_id = supp_purchase_order.am_id', 'left')
            ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
            ->join('item_dtl', 'supp_purchase_order_detail.id_id = item_dtl.id_id', 'left')
            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
            ->join('units', 'units.u_id = item_groups.u_id', 'left')
            ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
            ->get_where('supp_purchase_order_detail', array('supp_purchase_order_detail.supp_dtl_id' => $supp_dtl_id))->result();
        // echo $this->db->get_compiled_select('purchase_order_details');
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

    public function del_jobber_bill_header_list(){
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_table');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		$this->db->where($pk_name, $pk_value)->delete($ref_table);
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Jobber Bill Successfully Deleted';
        return $data;
    }
	
	public function del_sample_bill_details_list(){
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $tab_val = $this->input->post('tab_val');
        
        $data_tab = $this->input->post('data_tab');
        $data_pk = $this->input->post('data_pk');
        $data_tab_val = $this->input->post('data_tab_val');
                
        $sample_bill_detail = $this->db->select('quantity, total')->get_where('sample_bill_detail', array('sample_challan_receipt_id' => $tab_val))->result();
        
        $quantity = 0;
        $total = 0;
        $net_bill = 0;
        $bill_amnt = 0;
        
        for($i = 0; $i < sizeof($sample_bill_detail); $i++){
            $quantity = $quantity + $sample_bill_detail[$i]->quantity;
            $total = $total + $sample_bill_detail[$i]->total;
            $net_bill = $net_bill + $sample_bill_detail[$i]->total;
            $bill_amnt = $bill_amnt + $sample_bill_detail[$i]->total;
            
        }//end for
        
        
        
        $article_quantity = 0;
        $article_total = 0;
        $net_bill_total = 0;
        $bill_amnt_total = 0;
        
        $article_quantity = $this->db->select('article_quantity')->get_where('sample_bill', array('sample_bill_id' => $data_tab_val))->result()[0]->article_quantity;
        
        $article_total = $this->db->select('article_total')->get_where('sample_bill', array('sample_bill_id' => $data_tab_val))->result()[0]->article_total;

        $net_bill_total = $this->db->select('net_bill')->get_where('sample_bill', array('sample_bill_id' => $data_tab_val))->result()[0]->net_bill;

        $bill_amnt_total = $this->db->select('bill_amount')->get_where('sample_bill', array('sample_bill_id' => $data_tab_val))->result()[0]->bill_amount;
        //echo 'article_quantity:'.$article_quantity;
        $article_quantity_new = ($article_quantity - $quantity);
        $article_total_new = ($article_total - $total);
        $net_bill_total_new = ($net_bill_total - $net_bill);
        $bill_amnt_total_new = ($bill_amnt_total - $bill_amnt);     
        //echo 'article_quantity_new:'.$article_quantity_new;
        $updateArray = array(
            'article_quantity' => $article_quantity_new,
            'article_total' => $article_total_new,
            'bill_amount' => $bill_amnt_total_new,
            'net_bill' => $net_bill_total_new
        );
        $this->db->update($data_tab, $updateArray, array($data_pk => $data_tab_val));
        
        $this->db->where($tab_pk, $tab_val)->delete($tab);
        
        
        $sample_challan_receipt_id1 = $tab_val;
        $sample_bill_status = 0;
        $updateArray = array(
            'sample_bill_status' => $sample_bill_status
        );
        $this->db->update('sample_receive', $updateArray, array('sample_challan_receipt_id' => $sample_challan_receipt_id1));
        
        $data['article_quantity'] = $article_quantity_new;
        $data['article_total'] = $article_total_new;
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'sample Bill detail detail successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}