<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Stock_in_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
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

    public function stock_in() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(19, $this->session->user_id);
        return array('page'=>'stock_in/stock_in_list_v', 'data'=>$data);
    }

    public function ajax_receive_purchase_order_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'purchase_order_receive_bill_no',
            1 => 'purchase_order_receive_date',
            3 => 'total_amount',
			4 => 'delivery_charge',
			5 => 'sgst_percentage_amount',
			6 => 'cgst_percentage_amount',
			7 => 'delivery_sgst_cgst_amount',
			8 => 'net_amount'
        );
        // Set searchable column fields
        $column_search = array('purchase_order_receive_bill_no', 'purchase_order_receive_date', 'total_amount', 'delivery_charge','sgst_percentage_amount','cgst_percentage_amount', 'delivery_sgst_cgst_amount', 'net_amount');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('stock_in')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stock_in.purchase_order_receive_id, stock_in.purchase_order_receive_bill_no, DATE_FORMAT(stock_in.purchase_order_receive_date, "%d-%m-%Y") as purchase_order_receive_date, stock_in.am_id, stock_in.total_amount, stock_in.delivery_charge, stock_in.sgst_percent, stock_in.sgst_percentage_amount, stock_in.cgst_percent, stock_in.cgst_percentage_amount, stock_in.delivery_sgst_cgst_amount, stock_in.net_amount, stock_in.status, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = stock_in.am_id', 'left');
            $rs = $this->db->get_where('stock_in', array('stock_in.status => 1'))->result();
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

            $this->db->select('stock_in.purchase_order_receive_id, stock_in.purchase_order_receive_bill_no, DATE_FORMAT(stock_in.purchase_order_receive_date, "%d-%m-%Y") as purchase_order_receive_date, stock_in.am_id, stock_in.total_amount, stock_in.delivery_charge, stock_in.sgst_percent, stock_in.sgst_percentage_amount, stock_in.cgst_percent, stock_in.cgst_percentage_amount, stock_in.delivery_sgst_cgst_amount, stock_in.net_amount,  stock_in.status, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = stock_in.am_id', 'left');
            $rs = $this->db->get_where('stock_in', array('stock_in.status => 1'))->result();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stock_in.purchase_order_receive_id, stock_in.purchase_order_receive_bill_no, DATE_FORMAT(stock_in.purchase_order_receive_date, "%d-%m-%Y") as purchase_order_receive_date, stock_in.am_id, stock_in.total_amount, stock_in.delivery_charge, stock_in.sgst_percent, stock_in.sgst_percentage_amount, stock_in.cgst_percent, stock_in.cgst_percentage_amount, stock_in.delivery_sgst_cgst_amount, stock_in.net_amount,  stock_in.status, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = stock_in.am_id', 'left');
            $rs = $this->db->get_where('stock_in', array('stock_in.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['purchase_order_receive_bill_no'] = $val->purchase_order_receive_bill_no;
			$nestedData['purchase_order_receive_date'] = $val->purchase_order_receive_date;
            $nestedData['pur_order_supplier'] = $val->acc_master_name.'['.$val->acc_master_short_name.']';
			$nestedData['total_amount'] = $val->total_amount;
			$nestedData['delivery_charge'] = $val->delivery_charge;
			$nestedData['sgst_percentage_amount'] = $val->sgst_percentage_amount;
			$nestedData['cgst_percentage_amount'] = $val->cgst_percentage_amount;
			$nestedData['delivery_sgst_cgst_amount'] = $val->delivery_sgst_cgst_amount;
			$nestedData['net_amount'] = $val->net_amount;			
            $nestedData['status'] = $status;
            
            $uvp = $this->_user_wise_view_permission(19, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-stock-in/'.$val->purchase_order_receive_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="purchase_order_receive_id" pk-value="'.$val->purchase_order_receive_id.'" tab="stock_in" ref-tab="stock_in_detail" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function add_receive_purchase_order() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();

        $data['plating_details'] = $this->db->select('*')->get_where('platting_issue', array('platting_issue.status' => 1))->result();

        return array('page'=>'stock_in/stock_in_add_v', 'data'=>$data);
    }

    public function ajax_unique_supp_purchase_order_no(){
        $supp_po_number = $this->input->post('supp_po_number');

        $rs = $this->db->get_where('supp_purchase_order', array('supp_po_number' => $supp_po_number))->num_rows();
        if($rs != '0') {
            $data = 'Supp.Purchase order no already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_add_receive_purchase_order(){

        $insertArray = array(
            'purchase_order_receive_bill_no' => $this->input->post('purchase_order_receive_bill_no'),
            'purchase_order_receive_date' => $this->input->post('purchase_order_receive_date'),
            'am_id' => $this->input->post('am_id'),
            'plating_id' => $this->input->post('plating_id_add'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('stock_in', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Stock added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_receive_purchase_order($purchase_order_receive_id) {
        $data['item_groups'] = $this->db->select('ig_id, ig_code, group_name')->get_where('item_groups', array('item_groups.status' => 1))->result_array();

		$data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
            
		$data['plating_details'] = $this->db->select('*')->get_where('platting_issue', array('platting_issue.status' => 1))->result();
		
        $data['receive_purchase_order_details'] = $this->db->select('stock_in.purchase_order_receive_id, stock_in.purchase_order_receive_bill_no, DATE_FORMAT(stock_in.purchase_order_receive_date, "%d-%m-%Y") as purchase_order_receive_date, stock_in.am_id, stock_in.total_amount, stock_in.delivery_charge, stock_in.sgst_percent, stock_in.sgst_percentage_amount, stock_in.cgst_percent, stock_in.cgst_percentage_amount, stock_in.delivery_sgst_cgst_amount, stock_in.net_amount,  stock_in.status, stock_in.plating_id, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
		->join('acc_master', 'acc_master.am_id = stock_in.am_id', 'left')
		->get_where('stock_in', array('stock_in.purchase_order_receive_id' => $purchase_order_receive_id))->result();
			//echo $this->db->last_query();		
		$am_id = $data['receive_purchase_order_details'][0]->am_id;
		
		$pur_num_rows = $this->db->get_where('purchase_order', array('am_id' => $am_id, 'status' => 1))->num_rows();
		if($pur_num_rows > 0){
			$data['purchase_order'] = $this->db->select('po_id, po_number')->get_where('purchase_order', array('am_id' => $am_id, 'status' => 1))->result_array();
		}else{
			$data['purchase_order'] = array();
		}
		
		$sup_num_rows = $this->db->get_where('supp_purchase_order', array('am_id' => $am_id, 'supp_status' => 1))->num_rows();
		if($sup_num_rows > 0){
			$data['supp_purchase_order'] = $this->db->select('sup_id, supp_po_number')->get_where('supp_purchase_order', array('am_id' => $am_id, 'supp_status' => 1))->result_array();
		}else{
			$data['supp_purchase_order'] = array();
		}
					
        return array('page'=>'stock_in/stock_in_edit_v', 'data'=>$data);
    }

    public function form_edit_receive_purchase_order(){
        $updateArray = array(
            'purchase_order_receive_bill_no' => $this->input->post('purchase_order_receive_bill_no'),
            'purchase_order_receive_date' => $this->input->post('purchase_order_receive_date'),
            'plating_id' => $this->input->post('plating_id_edit'),
			'status' => $this->input->post('status'),
            'user_id' => $this->session->user_id
        );
        $purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		
        $this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));

        $data['type'] = 'success';
        $data['msg'] = 'Stock In updated successfully.';
        return $data;

    }

    public function ajax_receive_purchase_order_details_table_data() {
        $purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		//actual db table column names
        $column_orderable = array(
			0 => 'id_id',
            2 => 'item_quantity',
            3 => 'item_rate',
			4 => 'pod_total'
        );
        // Set searchable column fields
        $column_search = array('item_quantity', 'item_rate', 'pod_total');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('stock_in_detail.*, colors.color, colors.c_code, item_master.item');
		$this->db->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left');
		$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
		$rs = $this->db->get_where('stock_in_detail', array('purchase_order_receive_id' => $purchase_order_receive_id))->result();
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stock_in_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('stock_in_detail', array('purchase_order_receive_id' => $purchase_order_receive_id))->result();
            // echo $this->db->get_compiled_select('purchase_order_details');
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

            $this->db->select('stock_in_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('stock_in_detail', array('purchase_order_receive_id' => $purchase_order_receive_id))->result();
            // echo $this->db->get_compiled_select('purchase_order_details');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('stock_in_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('stock_in_detail', array('purchase_order_receive_id' => $purchase_order_receive_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['item_name'] = $val->item;
            $nestedData['item_color'] = $val->color . ' ['. $val->c_code .']';
            $nestedData['item_qty'] = $val->item_quantity;
            $nestedData['item_rate'] = $val->item_rate;
            $nestedData['total_amount'] = $val->pod_total;
            $pod_total_add = $val->pod_total;
			
            $nestedData['action'] = '<a href="javascript:void(0)" purchase_order_receive_detail_id="'.$val->purchase_order_receive_detail_id.'" class="purchase_order_receive_detail_id btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="stock_in_detail" tab-pk="purchase_order_receive_detail_id" data-pk="'.$val->purchase_order_receive_detail_id.'" reference-tab="purchase_order_receive" reference-pk="purchase_order_receive_id" reference-data-pk="'.$purchase_order_receive_id.'" pod-total-add="'.$pod_total_add.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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
	
	public function ajax_fetch_receive_purchase_order_details_on_pk(){
        $purchase_order_receive_detail_id = $this->input->post('purchase_order_receive_detail_id');
		$data = array();
		
		$this->db->select('stock_in_detail.*, purchase_order.po_number, supp_purchase_order.supp_po_number, colors.color, colors.c_code, item_master.item, units.unit');
		$this->db->join('purchase_order', 'purchase_order.po_id = stock_in_detail.po_id', 'left');
		$this->db->join('supp_purchase_order', 'supp_purchase_order.sup_id = stock_in_detail.sup_id', 'left');
		$this->db->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left');
		$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
		$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
		$oreder_receive_details = $this->db->get_where('stock_in_detail', array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id))->result_array()[0];
		
		$id_id_add = $oreder_receive_details['id_id'];
		$item_quantity = $this->db->select_sum('item_quantity')->get_where('stock_in_detail', array('id_id' => $id_id_add))->result()[0]->item_quantity;
		
		$data['oreder_receive_details'] = $oreder_receive_details;
		$data['remain_item_quantity'] = $item_quantity;
		
		return $data;
    }

    public function all_items_on_purchase_order(){
		$data = array();
		
        // $po_id = $this->input->post('po_id');
		
		$this->db->select('item_dtl.id_id, item_master.item as item_name, item_master.im_code, units.unit, colors.color');
		$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
		$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
		$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
		$data['all_items'] = $this->db->get_where('item_dtl', array('item_dtl.status'=>'1'))->result_array();
		
// 		$am_id = $this->input->post('am_id_hidden');
		
// 		$sup_num_rows = $this->db->get_where('supp_purchase_order', array('am_id' => $am_id, 'po_id' => $po_id, 'supp_status' => 1))->num_rows();
// 		if($sup_num_rows > 0){
// 			$data['sup_po_orders'] = $this->db->select('sup_id, supp_po_number')->get_where('supp_purchase_order', array('am_id' => $am_id, 'po_id' => $po_id, 'supp_status' => 1))->result_array();
// 		}else{
// 			$data['sup_po_orders'] = array();
// 		}
		
		return $data;
    }
	
	public function all_items_on_supp_purchase_order(){
        // $sup_id = $this->input->post('sup_id');

        $plating_id = $this->input->post('platting_id');
        
        $stockin_id = $this->input->post('stockin_id');
        
        $new_array = array();

        if($plating_id == '') {
		$this->db->select('item_dtl.id_id, item_master.item as item_name, item_master.im_code, units.unit, colors.color');
		$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
		$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
		$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
		return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1'))->result_array();
    } else {

      $all_platting_item_details = $this->db->select('*')->get_where('platting_issue_detail', array('platting_issue_id' => $plating_id))->result();

    if(count($all_platting_item_details) > 0) {
        foreach($all_platting_item_details as $a_p_i_d) {
        $this->db->select('item_dtl.id_id, item_master.item, item_master.im_code, units.unit, colors.color');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('units', 'units.u_id = item_master.u_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        $res = $this->db->get_where('item_dtl', array('item_dtl.im_id'=>$a_p_i_d->im_id,'item_dtl.c_id'=>$a_p_i_d->new_item_colour,'item_dtl.status'=>'1'))->row();
        

       if(count($res) > 0) {
           $stockin_row = $this->db
        ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
        ->get_where('stock_in_detail', array('stock_in.plating_id' => $plating_id, 'stock_in_detail.id_id' => $res->id_id))->num_rows();
        
        if($stockin_row == 0) {
        $arr = array(
        'id_id' => $res->id_id,
        'item_name' => $res->item,
        'im_code' => $res->im_code,
        'unit' => $res->unit,
        'color' => $res->color
        );
        array_push($new_array, $arr);
        } 
        
    }
    }
    }
      return $new_array;
    }
		
    }
    
    public function ajax_all_colors_on_item_master(){
        $item_id = $this->input->post('item_id');
        $this->db->select('item_dtl.id_id as item_dtl_id, colors.*');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_dtl.im_id' => $item_id, 'color <>' => null))->result_array();
    }
	
    public function ajax_get_remaining_item_quantity(){
        
        $issue_date_add = $this->input->post('issue_date_add');
        
        $item_dtl_id = $this->input->post('id_id_add');
        
        $am_id_value = $this->input->post('am_id_value');
        
        $plating_id_edit = $this->input->post('plating_id_edit');

		$item_quantity = 0;
		
		$show_array = array();
		
		$new_purchase_rate = 0;
		
		$item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;
        
        $colour = $this->db->get_where('colors', array('colors.c_id' => $c_id))->row()->color;
		
		if($plating_id_edit == '') {
		
		$result1 = $this->db->select('purchase_order_receive_detail.*, item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                        ->where('purchase_order_receive.purchase_order_receive_date <=', $issue_date_add)
                        ->order_by('purchase_order_receive_detail.purchase_order_receive_detail_id')
                        ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id))->result();
                        
        $result_opening_stock_row1 = $this->db->select('item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock, item_dtl.opening_rate, item_dtl.id_id')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                            ->where('item_dtl.opening_stock >', 0)
                            ->get_where('item_dtl', array('item_dtl.id_id' => $item_dtl_id))->result();
            if(count($result_opening_stock_row1) > 0) {
               $opening_stock_quantity1 = $result_opening_stock_row1[0]->opening_stock; 
            } else {
               $opening_stock_quantity1 = 0; 
            }
                        
        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

            $platting_issue_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as issue_quantity')
                            ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                            ->where('platting_issue.platting_issue_date <=', $issue_date_add)
                            ->get_where('platting_issue_detail', array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id, 'platting_issue_detail.status' => 1))->row();

            if (count($platting_issue_row) > 0) {
                $platting_issue = $platting_issue_row->issue_quantity;
            } else {
                $platting_issue = 0;
            }

            $sum_purchase_order_row = $this->db->select('SUM(purchase_order_receive_detail.item_quantity) as item_quantity')
                            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                            ->where('purchase_order_receive.purchase_order_receive_date <=', $issue_date_add)
                            ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id, 'purchase_order_receive_detail.status' => 1))->row();

            if (count($sum_purchase_order_row) > 0) {
                $sum_purchase_order = $sum_purchase_order_row->item_quantity;
            } else {
                $sum_purchase_order = 0;
            }
            
             $sum_material_issue_row = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_quantity')
                            ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                            ->where('material_issue.material_issue_date <=', $issue_date_add)
                            ->get_where('material_issue_detail', array('material_issue_detail.id_id' => $item_dtl_id))->row();

            if (count($sum_material_issue_row) > 0) {
                $sum_material_issue = $sum_material_issue_row->issue_quantity;
            } else {
                $sum_material_issue = 0;
            }
            
            $sum_stock_in_row = $this->db->select('SUM(stock_in_detail.item_quantity) as item_quantity')
                            ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                            ->where('stock_in.purchase_order_receive_date <=', $issue_date_add)
                            ->get_where('stock_in_detail', array('stock_in_detail.id_id' => $item_dtl_id, 'stock_in_detail.status' => 1))->row();

            if (count($sum_stock_in_row) > 0) {
                $sum_stock_in = $sum_stock_in_row->item_quantity;
            } else {
                $sum_stock_in = 0;
            }
            
            $item_quantity = $opening_stock_quantity1 + $sum_purchase_order - ($sum_material_issue + $platting_issue) + $sum_stock_in;
    
    $purchase_rate_row = $this->db->select('purchase_order_receive_detail.*, item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                        ->order_by('purchase_order_receive_detail.purchase_order_receive_detail_id', 'desc')
                        ->limit(1)
                        ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id))->result();
                        
                        if(count($purchase_rate_row) > 0) {
                            $new_purchase_rate = $purchase_rate_row[0]->item_rate;
                        } else {
                            $new_purchase_rate = 0;
                        }
            } else {
                
    $purchase_rate_row1 = $this->db->select('*')
                        ->order_by('item_rates.effective_date', 'desc')
                        ->where('item_rates.effective_date <=', $issue_date_add)
                        ->limit(1)
                        ->get_where('item_rates', array('item_rates.id_id' => $item_dtl_id, 'item_rates.am_id' => $am_id_value))->result();
                        
                        if(count($purchase_rate_row1) > 0) {
                            $new_purchase_rate = $purchase_rate_row1[0]->plating_rate;
                        } else {
                            $new_purchase_rate = 0;
                        }
                        
            $rs_plating = $this->db->select('platting_issue_detail.issue_quantity')
                    ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                    ->where('platting_issue_detail.platting_issue_id', $plating_id_edit)
                      ->where('platting_issue.platting_issue_date <=', $issue_date_add)
                       ->where(array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.new_item_colour' => $c_id))
                        ->get('platting_issue_detail')->row();
                        
                        if(count($rs_plating) > 0) {
                             $item_quantity = $rs_plating->issue_quantity;
                        } else {
                             $item_quantity = 0;
                        }
                
            }
                        
                        $arr = array(
                            'item_quantity' => $item_quantity,
                            'new_purchase_rate' => $new_purchase_rate,
                            'colour' => $colour
                            );
                            
                            array_push($show_array, $arr);
    
		return $show_array;
		
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
	
    public function form_add_receive_purchase_order_details(){
        
        $insertArray = array(
            'purchase_order_receive_id' => $this->input->post('purchase_order_receive_id'),
            // 'po_id' => $this->input->post('po_id'), // item_dtl_id as color
            // 'sup_id' => $this->input->post('sup_id'),
            'remarks' => $this->input->post('sup_pod_remarks'),
            'id_id' => $this->input->post('id_id_add'),
			'item_quantity' => $this->input->post('pod_quantity_add'),
			'item_rate' => $this->input->post('pod_rate_add'),
			'pod_total' => $this->input->post('pod_total_add'),
            'user_id' => $this->session->user_id
        );
        //echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('stock_in_detail', $insertArray);
		$insert_id = $this->db->insert_id();
        $data['insert_id'] = $this->db->insert_id();
		
		//CGST SGST Update
		$purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		$pod_total_add = $this->input->post('pod_total_add');
		
		$result = $this->db->select('total_amount, delivery_charge, sgst_percent, sgst_percentage_amount, cgst_percent, cgst_percentage_amount, delivery_sgst_cgst_amount, net_amount')->get_where('stock_in', array('purchase_order_receive_id' => $purchase_order_receive_id))->result()[0];
		
		$total_amount = $result->total_amount;
		$delivery_charge = $result->delivery_charge;
		$sgst_percent = $result->sgst_percent;
		//$sgst_percentage_amount = $result->sgst_percentage_amount;
		$cgst_percent = $result->cgst_percent;
		//$cgst_percentage_amount = $result->cgst_percentage_amount;
		//$delivery_sgst_cgst_amount = $result->delivery_sgst_cgst_amount;
		//$net_amount = $result->net_amount;
		
		$total_amount1 = ($total_amount + $pod_total_add);
		$sgst_percentage_amount = (($total_amount1 * $sgst_percent) / 100);
		$cgst_percentage_amount = (($total_amount1 * $cgst_percent) / 100);
		
		$delivery_sgst_cgst_amount = ($delivery_charge + $sgst_percentage_amount + $cgst_percentage_amount);
		$net_amount = ($total_amount1 + $delivery_sgst_cgst_amount);
		
		$line_items = new stdClass();
		$line_items->total_amount = $total_amount1;
		$line_items->delivery_sgst_cgst_amount = $delivery_sgst_cgst_amount;
		$line_items->net_amount = $net_amount;
		
        //purchase_order_receive table 
        $updateArray= array(
            'total_amount' => $total_amount1,
			'sgst_percentage_amount' => $sgst_percentage_amount,
			'cgst_percentage_amount' => $cgst_percentage_amount,
			'delivery_sgst_cgst_amount' => $delivery_sgst_cgst_amount,
			'net_amount' => $net_amount
        );
        $this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));
        // echo $this->db->last_query();die;
        
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Stock In details added successfully.';
			$data['line_items'] = $line_items;
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
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


    public function form_edit_receive_purchase_order_details(){
        
		$purchase_order_receive_detail_id = $this->input->post('purchase_order_receive_detail_id');
		
        $updateArray = array(
            'item_quantity' => $this->input->post('pod_quantity_edit'),
            'item_rate' => $this->input->post('pod_rate_edit'),
			'pod_total' => $this->input->post('pod_total_edit'),
            'remarks' => $this->input->post('sup_pod_remarks_edit'),
            'user_id' => $this->session->user_id
        );
		
		$this->db->update('stock_in_detail', $updateArray, array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id));
		
		//CGST SGST Update
		$purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		$pod_total_old = $this->input->post('pod_total_old');
		$pod_total_edit = $this->input->post('pod_total_edit');
		
		$result = $this->db->select('total_amount, delivery_charge, sgst_percent, sgst_percentage_amount, cgst_percent, cgst_percentage_amount, delivery_sgst_cgst_amount, net_amount')->get_where('stock_in', array('purchase_order_receive_id' => $purchase_order_receive_id))->result()[0];
		
		$total_amount = $result->total_amount;
		$delivery_charge = $result->delivery_charge;
		$sgst_percent = $result->sgst_percent;
		$cgst_percent = $result->cgst_percent;
		
		$total_amount11 = ($total_amount - $pod_total_old);
		$total_amount1 = ($total_amount11 + $pod_total_edit);
		$sgst_percentage_amount = (($total_amount1 * $sgst_percent) / 100);
		$cgst_percentage_amount = (($total_amount1 * $cgst_percent) / 100);
		
		$delivery_sgst_cgst_amount = ($delivery_charge + $sgst_percentage_amount + $cgst_percentage_amount);
		$net_amount = ($total_amount1 + $delivery_sgst_cgst_amount);
		
		$line_items = new stdClass();
		$line_items->total_amount = $total_amount1;
		$line_items->delivery_sgst_cgst_amount = $delivery_sgst_cgst_amount;
		$line_items->net_amount = $net_amount;
		
        //purchase_order_receive table 
        $updateArray= array(
            'total_amount' => $total_amount1,
			'sgst_percentage_amount' => $sgst_percentage_amount,
			'cgst_percentage_amount' => $cgst_percentage_amount,
			'delivery_sgst_cgst_amount' => $delivery_sgst_cgst_amount,
			'net_amount' => $net_amount
        );
        $this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));
		//CGST SGST Update
		
        $data['type'] = 'success';
		$data['line_items'] = $line_items;
        $data['msg'] = 'Stock In details updated successfully.';
        return $data;
    }
	
	public function form_edit_delivery_sgst_cgst_value(){
        
		$purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		
        $updateArray = array(
            'total_amount' => $this->input->post('total_amount'),
            'delivery_charge' => $this->input->post('delivery_charge'),
			'sgst_percent' => $this->input->post('sgst_percent'),
            'cgst_percent' => $this->input->post('cgst_percent'),
			'delivery_sgst_cgst_amount' => $this->input->post('delivery_sgst_cgst_amount'),
			'net_amount' => $this->input->post('net_amount'),
            'user_id' => $this->session->user_id
        );
		
		$this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));

        $data['type'] = 'success';
        $data['msg'] = 'Net Amount updated successfully.';
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

    public function delete_receive_purchase_order_details(){
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_tab');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
        $this->db->where($pk_name, $pk_value)->delete($tab);
		$this->db->where($pk_name, $pk_value)->delete($ref_table);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Stock In Successfully Deleted';
        return $data;
    }
	
	public function delete_receive_purchase_order_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
		
		$reference_tab = $this->input->post('reference_tab');
		$reference_pk = $this->input->post('reference_pk');
		$reference_data_pk = $this->input->post('reference_data_pk');
		$pod_total_add = $this->input->post('pod_total_add');
		
		//CGST SGST Update
		$purchase_order_receive_id = $reference_data_pk;
		
		$result = $this->db->select('total_amount, delivery_charge, sgst_percent, sgst_percentage_amount, cgst_percent, cgst_percentage_amount, delivery_sgst_cgst_amount, net_amount')->get_where('stock_in', array('purchase_order_receive_id' => $purchase_order_receive_id))->result()[0];
		
		$total_amount = $result->total_amount;
		$delivery_charge = $result->delivery_charge;
		$sgst_percent = $result->sgst_percent;
		$cgst_percent = $result->cgst_percent;
		
		$total_amount1 = ($total_amount - $pod_total_add);
		$sgst_percentage_amount = (($total_amount1 * $sgst_percent) / 100);
		$cgst_percentage_amount = (($total_amount1 * $cgst_percent) / 100);
		
		$delivery_sgst_cgst_amount = ($delivery_charge + $sgst_percentage_amount + $cgst_percentage_amount);
		$net_amount = ($total_amount1 + $delivery_sgst_cgst_amount);
		
		$line_items = new stdClass();
		$line_items->total_amount = $total_amount1;
		$line_items->delivery_sgst_cgst_amount = $delivery_sgst_cgst_amount;
		$line_items->net_amount = $net_amount;
		
        //purchase_order_receive table 
        $updateArray= array(
            'total_amount' => $total_amount1,
			'sgst_percentage_amount' => $sgst_percentage_amount,
			'cgst_percentage_amount' => $cgst_percentage_amount,
			'delivery_sgst_cgst_amount' => $delivery_sgst_cgst_amount,
			'net_amount' => $net_amount
        );
        $this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));
		//CGST SGST Update
				
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
		$data['line_items'] = $line_items;
        $data['msg'] = 'Stock In Detail Successfully Deleted';
        return $data;
    }
    // purchase ORDER ENDS 

}