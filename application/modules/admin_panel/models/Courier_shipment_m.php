<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Courier_shipment_m extends CI_Model {

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

    public function courier_shipment_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(21, $this->session->user_id);
        return array('page'=>'courier_shipment/courier_shipment_list_v', 'data'=>$data);
    }

    public function ajax_courier_shipment_list_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'courier_shipment.invoice_date',
            1 => 'courier_shipment.am_id',
            2 => 'courier_shipment.invoice_no',
            3 => 'courier_shipment.awb_number',
            4 => 'courier_shipment.total_quantity',
            5 => 'courier_shipment.total_amount',
            6 => 'courier_shipment.total_foreign_amount'
        );
        // Set searchable column fields
        $column_search = array('courier_shipment.invoice_date','courier_shipment.am_id','courier_shipment.invoice_no','courier_shipment.awb_number','courier_shipment.total_quantity','courier_shipment.total_amount','courier_shipment.total_foreign_amount');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('courier_shipment.courier_shipment_id, courier_shipment.invoice_no, DATE_FORMAT(courier_shipment.invoice_date, "%d-%m-%Y") as invoice_date, courier_shipment.shipment_through, courier_shipment.am_id, courier_shipment.awb_number, courier_shipment.pickup_time, courier_shipment.weight, courier_shipment.booking_no, courier_shipment.leather_type, courier_shipment.box_dimention, courier_shipment.remarks, courier_shipment.pieces, courier_shipment.total_quantity, courier_shipment.total_amount, courier_shipment.total_foreign_amount, acc_master.name,acc_master.name, acc_master.short_name, acc_master.am_code');
		$this->db->join('acc_master', 'acc_master.am_id = courier_shipment.am_id', 'left');
		$rs = $this->db->get_where('courier_shipment', array('courier_shipment.status => 1'))->result();
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('courier_shipment.courier_shipment_id, courier_shipment.invoice_no, DATE_FORMAT(courier_shipment.invoice_date, "%d-%m-%Y") as invoice_date, courier_shipment.shipment_through, courier_shipment.am_id, courier_shipment.awb_number, courier_shipment.pickup_time, courier_shipment.weight, courier_shipment.booking_no, courier_shipment.leather_type, courier_shipment.box_dimention, courier_shipment.remarks, courier_shipment.pieces, courier_shipment.total_quantity, courier_shipment.total_amount, courier_shipment.total_foreign_amount, acc_master.name,acc_master.name, acc_master.short_name, acc_master.am_code');
			$this->db->join('acc_master', 'acc_master.am_id = courier_shipment.am_id', 'left');
			$rs = $this->db->get_where('courier_shipment', array('courier_shipment.status => 1'))->result();
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

            $this->db->select('courier_shipment.courier_shipment_id, courier_shipment.invoice_no, DATE_FORMAT(courier_shipment.invoice_date, "%d-%m-%Y") as invoice_date, courier_shipment.shipment_through, courier_shipment.am_id, courier_shipment.awb_number, courier_shipment.pickup_time, courier_shipment.weight, courier_shipment.booking_no, courier_shipment.leather_type, courier_shipment.box_dimention, courier_shipment.remarks, courier_shipment.pieces, courier_shipment.total_quantity, courier_shipment.total_amount, courier_shipment.total_foreign_amount, acc_master.name,acc_master.name, acc_master.short_name, acc_master.am_code');
			$this->db->join('acc_master', 'acc_master.am_id = courier_shipment.am_id', 'left');
			$rs = $this->db->get_where('courier_shipment', array('courier_shipment.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
          	$this->db->select('courier_shipment.courier_shipment_id, courier_shipment.invoice_no, DATE_FORMAT(courier_shipment.invoice_date, "%d-%m-%Y") as invoice_date, courier_shipment.shipment_through, courier_shipment.am_id, courier_shipment.awb_number, courier_shipment.pickup_time, courier_shipment.weight, courier_shipment.booking_no, courier_shipment.leather_type, courier_shipment.box_dimention, courier_shipment.remarks, courier_shipment.pieces, courier_shipment.total_quantity, courier_shipment.total_amount, courier_shipment.total_foreign_amount, acc_master.name,acc_master.name, acc_master.short_name, acc_master.am_code');
			$this->db->join('acc_master', 'acc_master.am_id = courier_shipment.am_id', 'left');
			$rs = $this->db->get_where('courier_shipment', array('courier_shipment.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
			
			$nestedData['date'] = $val->invoice_date;
			$nestedData['party'] = $val->name;
			$nestedData['invoice_no'] = $val->invoice_no;
			$nestedData['awb_no'] = $val->awb_number;
			$nestedData['total_quantity'] = $val->total_quantity;
			$nestedData['total_value'] = $val->total_amount;
			$nestedData['total_foreign_value'] = $val->total_foreign_amount;
			$uvp = $this->_user_wise_view_permission(21, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-courier-shipment/'.$val->courier_shipment_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
			
            <a href="javascript:void(0)" pk-name="courier_shipment_id" pk-value="'.$val->courier_shipment_id.'" tab="courier_shipment" ref-table="courier_shipment_detail" ref-pk-name="courier_shipment_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function add_courier_shipment() {
		$data = array();
		
		$data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        $data['courier_master'] = $this->db->select('cm_id, courier_name')->get_where('courier_master', array('status' => 1))->result();
		
        return array('page'=>'courier_shipment/courier_shipment_add_v', 'data'=>$data);
    }

    public function ajax_unique_courier_shipment_number(){
        $invoice_no = $this->input->post('invoice_no');

        $rs = $this->db->get_where('courier_shipment', array('invoice_no' => $invoice_no))->num_rows();
        if($rs != '0') {
            $data = 'Invoice Number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_courier_shipment_add(){

        $insertArray = array(
            'invoice_no' => $this->input->post('invoice_no'),
            'invoice_date' => $this->input->post('invoice_date'),
            'shipment_through' => $this->input->post('shipment_through'),
            'am_id' => $this->input->post('am_id'),
            'awb_number' => $this->input->post('awb_number'),
            'pickup_time' => $this->input->post('pickup_time'),
            'weight' => $this->input->post('weight'),
            'booking_no' => $this->input->post('booking_no'),
            'leather_type' => $this->input->post('leather_type'),
            'box_dimention' => $this->input->post('box_dimention'),
            'remarks' => $this->input->post('remarks'),
            'pieces' => $this->input->post('pieces'),
            'user_id' => $this->session->user_id
        );

        $this->db->insert('courier_shipment', $insertArray);
		
		
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Courier Shipment added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_courier_shipment($courier_shipment_id) {
        
		$data['courier_shipment_detail'] = $this->db->select('courier_shipment.courier_shipment_id, courier_shipment.invoice_no, DATE_FORMAT(courier_shipment.invoice_date, "%d-%m-%Y") as invoice_date, courier_shipment.shipment_through, courier_shipment.am_id, courier_shipment.awb_number, courier_shipment.pickup_time, courier_shipment.weight, courier_shipment.booking_no, courier_shipment.leather_type, courier_shipment.box_dimention, courier_shipment.remarks, courier_shipment.pieces, courier_shipment.total_quantity, courier_shipment.total_amount, courier_shipment.total_foreign_amount, acc_master.name,acc_master.name, acc_master.short_name, acc_master.am_code')
		->join('acc_master', 'acc_master.am_id = courier_shipment.am_id', 'left')
		->get_where('courier_shipment', array('courier_shipment.courier_shipment_id' => $courier_shipment_id))->result();
		
		$data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
		
		$data['customer_order'] = $this->db->select('co_id, co_no')->get_where('customer_order', array( 'customer_order.status' => 1, 'customer_order.office_proforma_status' => 1))->result();
		
        return array('page'=>'courier_shipment/courier_shipment_edit_v', 'data'=>$data);
    }

    public function form_edit_courier_shipment(){
        $updateArray = array(
            'invoice_no' => $this->input->post('invoice_no'),
            'invoice_date' => $this->input->post('invoice_date'),
            'shipment_through' => $this->input->post('shipment_through'),
            'am_id' => $this->input->post('am_id'),
            'awb_number' => $this->input->post('awb_number'),
            'pickup_time' => $this->input->post('pickup_time'),
            'weight' => $this->input->post('weight'),
            'booking_no' => $this->input->post('booking_no'),
            'leather_type' => $this->input->post('leather_type'),
            'box_dimention' => $this->input->post('box_dimention'),
            'remarks' => $this->input->post('remarks'),
            'pieces' => $this->input->post('pieces'),
            'total_foreign_amount' => $this->input->post('total_foreign_amount'),
            'user_id' => $this->session->user_id
        );
        $courier_shipment_id = $this->input->post('courier_shipment_id');
		
        $this->db->update('courier_shipment', $updateArray, array('courier_shipment_id' => $courier_shipment_id));

        $data['type'] = 'success';
        $data['msg'] = 'Courier shipment updated.';

        return $data;

    }

    public function ajax_courier_shipment_detail_table_data() {
        $courier_shipment_id = $this->input->post('courier_shipment_id');
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'article_master.art_no',
            1 => 'article_master.info',
            3 => 'courier_shipment_detail.article_quantity',
            4 => 'courier_shipment_detail.price_inr',
            5 => 'courier_shipment_detail.price_foreign',
			6 => 'courier_shipment_detail.hs_code'
        );
        // Set searchable column fields
        $column_search = array('article_master.art_no','article_master.info','courier_shipment_detail.article_quantity','courier_shipment_detail.price_inr','courier_shipment_detail.price_foreign','courier_shipment_detail.article_quantity','courier_shipment_detail.hs_code');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('courier_shipment_detail.courier_shipment_detail_id, courier_shipment_detail.courier_shipment_id, courier_shipment_detail.info, courier_shipment_detail.article_quantity, courier_shipment_detail.price_inr, courier_shipment_detail.price_foreign, courier_shipment_detail.hs_code, courier_shipment_detail.remarks, customer_order_dtl.co_id, customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = courier_shipment_detail.cod_id', 'left');	
		$this->db->join('article_master', 'article_master.am_id = courier_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = courier_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = courier_shipment_detail.lc_id', 'left');
		$rs = $this->db->get_where('courier_shipment_detail', array('courier_shipment_detail.courier_shipment_id' => $courier_shipment_id))->result();
			
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('courier_shipment_detail.courier_shipment_detail_id, courier_shipment_detail.courier_shipment_id, courier_shipment_detail.info, courier_shipment_detail.article_quantity, courier_shipment_detail.price_inr, courier_shipment_detail.price_foreign, courier_shipment_detail.hs_code, courier_shipment_detail.remarks, customer_order_dtl.co_id, customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = courier_shipment_detail.cod_id', 'left');	
		$this->db->join('article_master', 'article_master.am_id = courier_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = courier_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = courier_shipment_detail.lc_id', 'left');
		$rs = $this->db->get_where('courier_shipment_detail', array('courier_shipment_detail.courier_shipment_id' => $courier_shipment_id))->result();
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

            $this->db->select('courier_shipment_detail.courier_shipment_detail_id, courier_shipment_detail.courier_shipment_id, courier_shipment_detail.info, courier_shipment_detail.article_quantity, courier_shipment_detail.price_inr, courier_shipment_detail.price_foreign, courier_shipment_detail.hs_code, courier_shipment_detail.remarks, customer_order_dtl.co_id, customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = courier_shipment_detail.cod_id', 'left');	
		$this->db->join('article_master', 'article_master.am_id = courier_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = courier_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = courier_shipment_detail.lc_id', 'left');
		$rs = $this->db->get_where('courier_shipment_detail', array('courier_shipment_detail.courier_shipment_id' => $courier_shipment_id))->result();       

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('courier_shipment_detail.courier_shipment_detail_id, courier_shipment_detail.courier_shipment_id, courier_shipment_detail.info, courier_shipment_detail.article_quantity, courier_shipment_detail.price_inr, courier_shipment_detail.price_foreign, courier_shipment_detail.hs_code, courier_shipment_detail.remarks, customer_order_dtl.co_id, customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = courier_shipment_detail.cod_id', 'left');	
		$this->db->join('article_master', 'article_master.am_id = courier_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = courier_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = courier_shipment_detail.lc_id', 'left');
		$rs = $this->db->get_where('courier_shipment_detail', array('courier_shipment_detail.courier_shipment_id' => $courier_shipment_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['article_name'] = $val->art_no;
			$nestedData['article_description'] = $val->info;
			$nestedData['article_color'] = $val->leather_color;
			$nestedData['article_quantity'] = $val->article_quantity;
			$nestedData['price_inr'] = $val->price_inr;
			$nestedData['price_foreign'] = $val->price_foreign;
			$nestedData['hs_code'] = $val->hs_code;
			$nestedData['remarks'] = $val->remarks;
			
            $nestedData['action'] = '<a href="javascript:void(0)" courier_shipment_detail_id="'.$val->courier_shipment_detail_id.'" class="courier_shipment_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="courier_shipment_detail" tab-pk="courier_shipment_detail_id" tab-val="'.$val->courier_shipment_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    
	public function packing_shipment_get_customer_order_dtl(){
        $co_id = $this->input->post('co_id');
		
        $this->db->select('customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no, article_master.info, article_master.carton_id, article_master.gross_weight_per_carton, article_master.number_of_article_per_carton');
		$this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
		$rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $co_id))->result();
		
		/* Select cartoon number
		$this->db->select('item_master.im_id, item_master.item');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->where('item_groups.group_name', 'Carton');
        $this->db->where('item_master.status', '1');
        $data['cartons'] = $this->db->get('item_master')->result_array();
		*/
		
			
		for($i = 0; $i < sizeof($rs); $i++){
			$remain_article_to_pack = 0;
			$article_quantity = 0;
			
			$co_id = $rs[$i]->co_id;
			$cod_id = $rs[$i]->cod_id;
			$am_id = $rs[$i]->am_id;
			$lc_id = $rs[$i]->lc_id;
			$fc_id = $rs[$i]->fc_id;
			$co_quantity = $rs[$i]->co_quantity;
			
			$article_quantity = $this->db->select_sum('article_quantity')->get_where('packing_shipment_detail', array('co_id' => $co_id, 'cod_id' => $cod_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'fc_id' => $fc_id))->result()[0]->article_quantity;				
			$remain_article_to_pack = ($co_quantity - $article_quantity);				
			$rs[$i]->remain_article_to_pack = $remain_article_to_pack;
			
			$carton_id = $rs[$i]->carton_id;
			if($carton_id > 0){
				$carton_item1 = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
				$carton_item = str_replace(' X ', 'X', $carton_item1);
				$rs[$i]->carton_item = $carton_item;
			}
			 
		}//end for
			
			//echo json_encode($rs);
			return $rs;
    }
	
    public function form_edit_courier_shipment_details(){
		$courier_shipment_id = $this->input->post('courier_shipment_id_hidden');
		$courier_shipment_detail_id = $this->input->post('courier_shipment_detail_id_hidden');
		
        $updateArray = array(
            'cod_id' => $this->input->post('cod_id_edit'),
			'am_id' => $this->input->post('am_id_edit'),
            'info' => $this->input->post('info_edit'),
			'lc_id' => $this->input->post('lc_id_edit'),
            'fc_id' => $this->input->post('fc_id_edit'),
			'article_quantity' => $this->input->post('article_quantity_edit'),
			'price_inr' => $this->input->post('price_inr_edit'),
			'price_foreign' => $this->input->post('price_foreign_edit'),
			'hs_code' => $this->input->post('hs_code_edit'),
			'remarks' => $this->input->post('remarks_edit'),
            'user_id' => $this->session->user_id
        );
		
        $this->db->update('courier_shipment_detail', $updateArray, array('courier_shipment_detail_id' => $courier_shipment_detail_id));
		
		//Updarte geader table quantity
		/*$packing_shipment_id = $this->input->post('packing_shipment_id_edit_hidden');
		$remain_article_to_pack_old = $this->input->post('remain_article_to_pack_hidden_edit_old');
		
		$article_quantity = $this->input->post('remain_article_to_pack_edit');
		$gross_weight_hidden = $this->input->post('gross_weight_hidden');
		$net_weight_hidden = $this->input->post('net_weight_hidden');
		
		$total_quantity_old = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
		$gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
		$net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
		
		$total_quantity_new = ($total_quantity_old - $remain_article_to_pack_old) + $article_quantity;
		$gross_weight_new = ($gross_weight_old - $gross_weight_hidden) + $gross_weight;
		$net_weight_new = ($net_weight_old - $net_weight_hidden) + $net_weight;
		
		
		$updateArray = array(
			'total_quantity' => $total_quantity_new,
			'gross_weight' => $gross_weight_new,
			'net_weight' => $net_weight_new
		);
		$this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));*/
		
		$insert_id = 1;
		if($insert_id > 0){
			$data['type'] = 'success';
			/*$data['total_quantity_new'] = $total_quantity_new;
			$data['gross_weight_new'] = $gross_weight_new;
			$data['net_weight_new'] = $net_weight_new;*/
			$data['msg'] = 'Courier Shipment Detail Updated Successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Updated.';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
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
	
    public function form_add_courier_shipment_details(){
		$courier_shipment_id_add = $this->input->post('courier_shipment_id_add');
		$cod_id = $this->input->post('cod_id');		
		$am_id = $this->input->post('am_id');
		$lc_id = $this->input->post('lc_id');
		$fc_id = $this->input->post('fc_id');
		$article_quantity = $this->input->post('article_quantity');
		$price_inr = $this->input->post('price_inr');
		$price_foreign = $this->input->post('price_foreign');
		$hs_code = $this->input->post('hs_code');
		$remarks = $this->input->post('remarks');		
		$user_id = $this->session->user_id;		
		
		
		$insertArray = array(
			'courier_shipment_id' => $courier_shipment_id_add,
			'cod_id' => $cod_id,
			'am_id' => $am_id,
			'lc_id' => $lc_id,
			'fc_id' => $fc_id,
			'article_quantity' => $article_quantity,
			'price_inr' => $price_inr,
			'price_foreign' => $price_foreign,
			'hs_code' => $hs_code,
			'remarks' => $remarks,
			'user_id' => $user_id
		);
		$this->db->insert('courier_shipment_detail', $insertArray);
		$insert_id = $this->db->insert_id();
	
	
		/*$total_quantity = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
		$gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
		$net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
		
		$total_quantity_new = $total_quantity + $article_quantity;
		$gross_weight_new = $gross_weight_old + ($gross_weight_per_carton * $article_quantity);
		$net_weight_new = $net_weight_old + ($net_weight * $article_quantity);
		
		$updateArray = array(
			'total_quantity' => $total_quantity_new,
			'gross_weight' => $gross_weight_new,
			'net_weight' => $net_weight_new
		);
		$this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));*/
		
		
				
		if($insert_id > 0){
			$data['type'] = 'success';
			/*$data['total_quantity_new'] = $total_quantity_new;
			$data['gross_weight_new'] = $gross_weight_new;
			$data['net_weight_new'] = $net_weight_new;*/
			$data['msg'] = 'Courier shipment details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted.';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function ajax_fetch_courier_shipment_edit_data(){
        $courier_shipment_detail_id = $this->input->post('courier_shipment_detail_id');
		
		$this->db->select('courier_shipment_detail.courier_shipment_detail_id, courier_shipment_detail.courier_shipment_id, courier_shipment_detail.info, courier_shipment_detail.article_quantity, courier_shipment_detail.price_inr, courier_shipment_detail.price_foreign, courier_shipment_detail.hs_code, courier_shipment_detail.remarks, customer_order_dtl.co_id, customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = courier_shipment_detail.cod_id', 'left');	
		$this->db->join('article_master', 'article_master.am_id = courier_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = courier_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = courier_shipment_detail.lc_id', 'left');
		$rs = $this->db->get_where('courier_shipment_detail', array('courier_shipment_detail.courier_shipment_detail_id' => $courier_shipment_detail_id))->result();
		
		/*$rs = $this->db
		->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no, article_master.carton_id')
		->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left')
		->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
		->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
		->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left')
		->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left')
		->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id))->result();*/
		
		/*$remain_article_to_pack = 0;
		$article_quantity = 0;
		
		$co_id = $rs[0]->co_id;
		$cod_id = $rs[0]->cod_id;
		$am_id = $rs[0]->am_id;
		$lc_id = $rs[0]->lc_id;
		$fc_id = $rs[0]->fc_id;
		$co_quantity = $rs[0]->co_quantity;
		
		$article_quantity = $this->db->select_sum('article_quantity')->get_where('packing_shipment_detail', array('co_id' => $co_id, 'cod_id' => $cod_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'fc_id' => $fc_id))->result()[0]->article_quantity;				
		$remain_article_to_pack = ($co_quantity - $article_quantity);				
		$rs[0]->remain_article_to_pack = $remain_article_to_pack;
		
		$carton_id = $rs[0]->carton_id;
		if($carton_id > 0){
			$carton_item1 = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
			$carton_item = str_replace(' X ', 'X', $carton_item1);
			$rs[0]->carton_item = $carton_item;
		}*/
		
		return $rs;
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

    public function delete_courier_shipment_header_list(){
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_table');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		//$this->db->where($pk_name, $pk_value)->delete($ref_table);
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Courier Shipment List Deleted';
        return $data;
    }
	
	public function del_courier_shipment_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$tab_val = $this->input->post('tab_val');
		
		/*$data_tab = $this->input->post('data_tab');
		$data_pk = $this->input->post('data_pk');
		$data_tab_val = $this->input->post('data_tab_val');
		
		$quantity = $this->input->post('quantity');
		$gross_weight = $this->input->post('gross_weight');
		$net_weight = $this->input->post('net_weight');
		
		$packing_shipment_id = $data_tab_val;
		$total_quantity_old = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
		$gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
		$net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
		
		$total_quantity_new = $total_quantity_old - $quantity;
		$gross_weight_new = $gross_weight_old - $gross_weight;
		$net_weight_new = $net_weight_old - $net_weight;
		
		$updateArray = array(
			'total_quantity' => $total_quantity_new,
			'gross_weight' => $gross_weight_new,
			'net_weight' => $net_weight_new
		);
		$this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));*/
		
		$this->db->where($tab_pk, $tab_val)->delete($tab);
				
		/*$data['total_quantity_new'] = $total_quantity_new;
		$data['gross_weight_new'] = $gross_weight_new;
		$data['net_weight_new'] = $net_weight_new;*/
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Courier Shipment detail deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}