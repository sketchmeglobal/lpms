<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Jobber_challan_issue_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
    }

    public function jobber_challan_issue() {
        $data = [];
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_list_v', 'data'=>$data);
    }

    public function ajax_jobber_challan_issue_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'acc_master.name',
            1 => 'jobber_challan_number',
            2 => 'jobber_issue_date',
            3 => 'jobber_expected_delivery_date'
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'jobber_challan_number', 'jobber_issue_date', 'jobber_expected_delivery_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('jobber_issue')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
            $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
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

            $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
			
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
			$this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
			
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['jobber_name'] = $val->acc_master_name;
			$nestedData['challan_number'] = $val->jobber_challan_number;
			$nestedData['jobber_date'] = $val->jobber_issue_date;
			$nestedData['expected_delivery_date'] = $val->jobber_expected_delivery_date;
            $nestedData['action'] = '<a href="'. base_url('admin/jobber-challan-issue-edit/'.$val->jobber_issue_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="jobber_issue_id" pk-value="'.$val->jobber_issue_id.'" tab="jobber_issue" child="1" ref-tab="jobber_issue_details" ref-pk-name="jobber_issue_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function jobber_challan_issue_add() {
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
		
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_add_v', 'data'=>$data);
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
    public function form_jobber_challan_issue_add(){

        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'jobber_challan_number' => $this->input->post('jobber_challan_number'),
            'jobber_issue_date' => $this->input->post('jobber_issue_date'),
            'jobber_expected_delivery_date' => $this->input->post('jobber_expected_delivery_date'),
			'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('jobber_issue', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Jobber Issue added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }
	
	//Get data before edit
    public function jobber_challan_issue_edit($jobber_issue_id) {
		
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
		
		$data['customer_order'] = $this->db->select('customer_order.co_id, customer_order.co_no')
		->join('customer_order', 'customer_order.co_id = skiving_receive_challan_details.co_id', 'left')
		->group_by('skiving_receive_challan_details.co_id')
		->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.status' => 1))->result();
				
		$data['jobber_issue_details'] = $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
		->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left')
		->get_where('jobber_issue', array('jobber_issue.jobber_issue_id' => $jobber_issue_id, 'jobber_issue.status => 1'))->result();
			
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_edit_v', 'data'=>$data);
    }

    public function form_jobber_issue_edit(){
        $updateArray = array(
            'am_id' => $this->input->post('am_id'),
            'jobber_challan_number' => $this->input->post('jobber_challan_number'),
            'jobber_issue_date' => $this->input->post('jobber_issue_date'),
            'jobber_expected_delivery_date' => $this->input->post('jobber_expected_delivery_date'),
            'user_id' => $this->session->user_id
        );
        $jobber_issue_id = $this->input->post('jobber_issue_id');
		
        $this->db->update('jobber_issue', $updateArray, array('jobber_issue_id' => $jobber_issue_id));

		//echo $this->db->last_query();die;
		
        $data['type'] = 'success';
        $data['msg'] = 'Jobber issue updated successfully.';

        return $data;

    }

    public function ajax_skiving_issue_details_table_data() {
       
	   $jobber_issue_id = $this->input->post('jobber_issue_id');
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'customer_order.co_no',
            1 => 'customer_order.buyer_reference_no'
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no', 'customer_order.buyer_reference_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');		$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');		$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');		$rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
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
			$this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
			
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			$this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
			$this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

       //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['customer_order_no'] = $val->co_no;
			$nestedData['order_reference_number'] = $val->customer_order_reference_number;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['jobber_issue_quantity'] = $val->jobber_issue_quantity;
            $nestedData['action'] = '<a href="javascript:void(0)" jobber_issue_detail_id="'.$val->jobber_issue_detail_id.'" class="jobber_issue_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="jobber_issue_details" tab-pk="jobber_issue_detail_id" co_id="'.$val->co_id.'" data-pk="'.$val->jobber_issue_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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
		
		$num_rows = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->num_rows();
		
		if($num_rows > 0){
			$buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
			$data['buyer_reference_no'] = $buyer_reference_no;
		}else{
			$data['buyer_reference_no'] = '-';
		}
		
		$data['article_details'] = $this->db->select('article_master.am_id, article_master.art_no, article_master.alt_art_no, skiving_receive_challan_details.skiving_receive_detail_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id')
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
		
		//$receive_cut_quantity = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('am_id' => $am_id, 'co_id' => $co_id))->result()[0]->receive_cut_quantity;
		$receive_cut_quantity = $this->db->select_sum('receive_quantity')->get_where('skiving_receive_challan_details', array('am_id' => $am_id, 'cod_id' => $cod_id))->result()[0]->receive_quantity;
		
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
	
    public function form_add_jobber_issue_challan_details(){
		
		$jobber_issue_id = $this->input->post('jobber_issue_id');
        $co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('cod_id_add');
		$customer_order_reference_number = $this->input->post('customer_order_reference_number');
		$am_id = $this->input->post('am_id_add');
		$lc_id = $this->input->post('lc_id');
		$fc_id = $this->input->post('fc_id');
		$jobber_issue_quantity = $this->input->post('jobber_issue_quantity_add');
		$jobber_emboss = $this->input->post('jobber_emboss_add');
		$receive_cut_quantity_add = $this->input->post('receive_cut_quantity_add');
		
		$insertArray = array(
			'jobber_issue_id' => $jobber_issue_id,
			'co_id' => $co_id,
			'cod_id' => $cod_id,
			'customer_order_reference_number' => $customer_order_reference_number,
			'am_id' => $am_id,
			'fc_id' => $fc_id,
			'lc_id' => $lc_id,
			'jobber_issue_quantity' => $jobber_issue_quantity,
			'jobber_emboss' => $jobber_emboss,
			'user_id' => $this->session->user_id
		);
		$this->db->insert('jobber_issue_details', $insertArray);
		$insert_id = $this->db->insert_id();		
		$data['insert_id'] = $insert_id;
		
		$updateArray = array(
			'jobber_issue_status' => 1,
			'user_id' => $this->session->user_id
		);		
		$this->db->update('customer_order', $updateArray, array('co_id' => $co_id));
		
		
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Jobber Details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Inser function Error';
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
        $data['msg'] = 'Jobber Challan Successfully Deleted';
        return $data;
    }
	
	public function del_jobber_challan_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
		$co_id = $this->input->post('co_id');
		
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
		$rs = $this->db->get_where($tab, array('co_id' => $co_id))->num_rows();
		
		if($rs == 0){
			$updateArray = array(
				'jobber_issue_status' => 0,
				'user_id' => $this->session->user_id
			);
			
			$this->db->update('customer_order', $updateArray, array('co_id' => $co_id));
		}
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Jobber challan detail list deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}