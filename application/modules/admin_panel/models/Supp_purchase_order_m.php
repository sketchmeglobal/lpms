<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Supp_purchase_order_m extends CI_Model {

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

    public function log_before_update($post_array,$primary_key, $table_name){
        $insertArray = array(
            'table_name' => $table_name,
            'pk_id' => $primary_key,
            'action_taken'=>'edit', 
            'old_data' => json_encode($post_array),
            'user_id' => $this->session->user_id,
            'comment' => 'supp purchase order'
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
                'comment' => 'supp purchase order'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function supp_purchase_order() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(17, $this->session->user_id);
        return array('page'=>'supp_purchase_order/supp_purchase_order_list_v', 'data'=>$data);
    }

    public function ajax_supp_purchase_order_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'supp_po_number',
            2 => 'pur_order_date',
            4 => 'supp_po_total'
        );
        // Set searchable column fields
        $column_search = array('supp_po_number');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('supp_purchase_order')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('supp_purchase_order.sup_id, supp_purchase_order.supp_po_number, DATE_FORMAT(supp_purchase_order.pur_order_date, "%d-%m-%Y") as pur_order_date, supp_purchase_order.buyer_details, supp_purchase_order.terms_condi, supp_purchase_order.supp_remarks, supp_purchase_order.supp_po_total, supp_purchase_order.supp_status, purchase_order.po_number as po_number, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('purchase_order', 'purchase_order.po_id = supp_purchase_order.po_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = supp_purchase_order.am_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status => 1'))->result();
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

            $this->db->select('supp_purchase_order.sup_id, supp_purchase_order.supp_po_number, DATE_FORMAT(supp_purchase_order.pur_order_date, "%d-%m-%Y") as pur_order_date, supp_purchase_order.buyer_details, supp_purchase_order.terms_condi, supp_purchase_order.supp_remarks, supp_purchase_order.supp_po_total, supp_purchase_order.supp_status, purchase_order.po_number as po_number, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('purchase_order', 'purchase_order.po_id = supp_purchase_order.po_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = supp_purchase_order.am_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status => 1'))->result();
			// echo $this->db->get_compiled_select('purchase_order');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('supp_purchase_order.sup_id, supp_purchase_order.supp_po_number, DATE_FORMAT(supp_purchase_order.pur_order_date, "%d-%m-%Y") as pur_order_date, supp_purchase_order.buyer_details, supp_purchase_order.terms_condi, supp_purchase_order.supp_remarks, supp_purchase_order.supp_po_total, supp_purchase_order.supp_status, purchase_order.po_number as po_number, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('purchase_order', 'purchase_order.po_id = supp_purchase_order.po_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = supp_purchase_order.am_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order', array('supp_purchase_order.supp_status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['supp_po_number'] = $val->supp_po_number;
			$nestedData['po_number'] = $val->po_number;
            $nestedData['pur_order_date'] = $val->pur_order_date;
            $nestedData['am_id'] = $val->acc_master_name.'['.$val->acc_master_short_name.']';
			$nestedData['supp_po_total'] = $val->supp_po_total;
			
            $nestedData['status'] = $status;
            $uvp = $this->_user_wise_view_permission(17, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-supp-purchase-order/'.$val->sup_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <!--<button po-id="'.$val->sup_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>-->
            <a href="javascript:void(0)" pk-name="sup_id" pk-value="'.$val->sup_id.'" tab="supp_purchase_order" child="1" ref-table="supp_purchase_order_detail" ref-pk-name="sup_id#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function add_supp_purchase_order() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
        return array('page'=>'supp_purchase_order/supp_purchase_order_add_v', 'data'=>$data);
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

    public function form_add_supp_purchase_order(){

        $insertArray = array(
            'po_id' => $this->input->post('po_id'),
            'supp_po_number' => $this->input->post('supp_po_number'),
            'pur_order_date' => $this->input->post('pur_order_date'),
            'am_id' => $this->input->post('am_id'),
            'buyer_details' => $this->input->post('buyer_details'),
            'terms_condi' => $this->input->post('terms_condi'),
			'supp_remarks' => $this->input->post('supp_remarks'),
			'supp_status' => $this->input->post('supp_status'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('supp_purchase_order', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Supp Purchase order added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_supp_purchase_order($sup_id) {
        $data['item_groups'] = $this->db->select('ig_id, ig_code, group_name')->get_where('item_groups', array('item_groups.status' => 1))->result_array();

		
        $data['supp_purchase_order_details'] = $this->db
                ->select('supp_purchase_order.*, acc_master.am_id, acc_master.name, acc_master.short_name, purchase_order.po_number')
                ->join('acc_master', 'acc_master.am_id = supp_purchase_order.am_id', 'left')
				->join('purchase_order', 'purchase_order.po_id = supp_purchase_order.po_id', 'left')
                ->get_where('supp_purchase_order', array('supp_purchase_order.sup_id' => $sup_id))
                ->result();
        return array('page'=>'supp_purchase_order/supp_purchase_order_edit_v', 'data'=>$data);
    }

    public function ajax_all_purchase_order_for_supl(){
        $item_group = $this->input->post('item_group');
        $po_id = $this->input->post('po_id');
        $this->db->select('item_dtl.*, item_master.item as item_name, item_groups.group_name, item_groups.value, units.unit');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
        $this->db->join('purchase_order_details', 'purchase_order_details.id_id = item_dtl.id_id', 'left');
        $this->db->group_by('item_master.item');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_master.ig_id' => $item_group, 'purchase_order_details.po_id' => $po_id))->result_array();
    }

    public function all_colors_on_item_master_wrt_purc_ord(){
        $item_id = $this->input->post('item_id');
        $po_id = $this->input->post('po_id');
        $this->db->select('item_dtl.id_id as item_dtl_id, colors.*, purchase_order_details.pod_quantity');
        $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        return $this->db->get_where('purchase_order_details', array('item_dtl.status'=>'1', 'item_dtl.im_id' => $item_id, 'purchase_order_details.po_id' => $po_id, 'color <>' => null))->result_array();
    }

    public function form_edit_supp_purchase_order(){

        $old_array = $this->db->get_where('supp_purchase_order', array('sup_id' => $this->input->post('sup_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('sup_id'), 'supp_purchase_order');

        $updateArray = array(
            'pur_order_date' => $this->input->post('pur_order_date'),
            'terms_condi' => $this->input->post('terms_condi'),
            'supp_remarks' => $this->input->post('supp_remarks'),
			'supp_status' => $this->input->post('supp_status'),
            'user_id' => $this->session->user_id
        );
        $sup_id = $this->input->post('sup_id');
		
        $this->db->update('supp_purchase_order', $updateArray, array('sup_id' => $sup_id));

        $data['type'] = 'success';
        $data['msg'] = 'Supp.Purchase order updated successfully.';
        return $data;

    }

    public function ajax_supp_purchase_order_details_table_data() {
        $sup_id = $this->input->post('supp_purchase_order_id');
		//actual db table column names
        $column_orderable = array(
            0 => 'item_qty',
            // 8 => 'status',
        );
        // Set searchable column fields
        $column_search = array('item_qty');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('purchase_order_details')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('supp_purchase_order_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = supp_purchase_order_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order_detail', array('sup_id' => $sup_id))->result();
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

            $this->db->select('supp_purchase_order_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = supp_purchase_order_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order_detail', array('sup_id' => $sup_id))->result();
            // echo $this->db->get_compiled_select('purchase_order_details');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('supp_purchase_order_detail.*, colors.color, colors.c_code, item_master.item');
            $this->db->join('item_dtl', 'item_dtl.id_id = supp_purchase_order_detail.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $rs = $this->db->get_where('supp_purchase_order_detail', array('sup_id' => $sup_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['item'] = $val->item;
            $nestedData['color'] = $val->color . ' ['. $val->c_code .']';
            $nestedData['item_qty'] = $val->item_qty;
            $nestedData['item_rate'] = $val->item_rate;
            $nestedData['total_amount'] = $val->total_amount;
            //$nestedData['sup_pod_remarks'] = $val->sup_pod_remarks;
            
            $nestedData['action'] = '<a href="javascript:void(0)" supp_dtl_id="'.$val->supp_dtl_id.'" class="purchase_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="supp_purchase_order" tab-pk="'.$sup_id.'" id-id="'.$val->id_id.'" data-tab="supp_purchase_order_detail" data-pk="'.$val->supp_dtl_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function ajax_all_purchase_order_wrt_suppliers(){

        $data = array();
        $supplier_id = $this->input->post('supplier_id');
        $rs = $this->db->get_where('purchase_order', array('purchase_order.am_id' => $supplier_id, 'purchase_order.status' => '1'))->num_rows();
        $all_po = $this->db->get_where('purchase_order', array('purchase_order.am_id' => $supplier_id, 'purchase_order.status' => '1'))->result_array();
        
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
	
    public function form_add_supp_purchase_order_details(){
        
        $insertArray = array(
            'sup_id' => $this->input->post('supp_purchase_order_id'),
            'id_id' => $this->input->post('color'), // item_dtl_id as color
            'item_qty' => $this->input->post('pod_quantity'),
            'item_rate' => $this->input->post('pod_rate'),
            'total_amount' => $this->input->post('pod_total'),
			'sup_pod_remarks' => $this->input->post('sup_pod_remarks'),
            'user_id' => $this->session->user_id
        );
        //echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('supp_purchase_order_detail', $insertArray);
		$insert_id = $this->db->insert_id();
        $data['insert_id'] = $this->db->insert_id();
		
        $data['pod_total'] = $this->db->select_sum('total_amount')->get_where('supp_purchase_order_detail', array('sup_id' => $this->input->post('supp_purchase_order_id')))->result()[0]->total_amount;

        // update purchase order table 
        $updateArray= array(
            'supp_po_total' => $data['pod_total']
        );
        $this->db->update('supp_purchase_order', $updateArray, array('sup_id' => $this->input->post('supp_purchase_order_id')));
        // echo $this->db->last_query();die;
        
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Supp.purchase order details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Supp.purchase order details not added successfully.';
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

        $old_array = $this->db->get_where('supp_purchase_order_detail', array('supp_dtl_id' => $this->input->post('supp_dtl_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('supp_dtl_id'), 'supp_purchase_order_detail');
        
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

    public function delete_supp_purchase_order_details(){

        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_table');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		$rs = $this->db->get_where('purchase_order_receive_detail', array('sup_id' => $pk_value))->num_rows();
		
		if($rs > 0){
			$data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Sup.Purchase Order, already received'; 
		}else{

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

			$this->db->where($pk_name, $pk_value)->delete($tab);
			$this->db->where($pk_name, $pk_value)->delete($ref_table);
			
			$data['title'] = 'Deleted!';
			$data['type'] = 'success';
			$data['msg'] = 'Successfully Deleted';
		}//end if
        return $data;
    }
	
	public function delete_supp_purchase_order_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		
		$data_tab = $this->input->post('data_tab');
		$data_pk = $this->input->post('data_pk');
		$id_id = $this->input->post('id_id');
		
		$rs = $this->db->get_where('purchase_order_receive_detail', array('id_id' => $id_id))->num_rows();
		
		if($rs > 0){
			$data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item of Sup.Purchase Order, already received'; 
		}else{

            $primary_key = $data_pk;
        $table_name = $data_tab;
        $pk_field_name = 'supp_dtl_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $data_tab,
                    "tbl_pk_fld" => "supp_dtl_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

			$total_amount = $this->db->select('total_amount')->get_where('supp_purchase_order_detail', array('supp_dtl_id' => $data_pk))->result()[0]->total_amount;
					
			$supp_po_total = $this->db->select('supp_po_total')->get_where('supp_purchase_order', array('sup_id' => $tab_pk))->result()[0]->supp_po_total;
			
			$after_delete = ($supp_po_total - $total_amount);
			$updateArray = array(
				'supp_po_total' => $after_delete
			);
			
			$this->db->update('supp_purchase_order', $updateArray, array('sup_id' => $tab_pk));
			
			$data['total_amount'] = $after_delete;
			
			$this->db->where('supp_dtl_id', $data_pk)->delete($data_tab);
			
			$data['title'] = 'Deleted!';
			$data['type'] = 'success';
			$data['msg'] = 'Supp. Purchase Order Detail Successfully Deleted';
		}//end if else
		
        return $data;
    }
    // purchase ORDER ENDS 

}