<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
  * Last updated on 30-mar-2021 at 01:51 pm
 */

class Purchase_order_m extends CI_Model {

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
            'comment' => 'purchase order'
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
                'comment' => 'purchase order'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function purchase_order() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(16, $this->session->user_id);
        return array('page'=>'purchase_order/purchase_order_list_v', 'data'=>$data);
    }

    public function ajax_purchase_order_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'po_number',
            1 => 'po_date',
            2 => 'name',
            4 => 'status',
        );
        // Set searchable column fields
        $column_search = array('po_number','name');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('purchase_order')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            // $this->db->order_by($order, $dir);
            $this->db->select('po_id, po_number, DATE_FORMAT(po_date, "%d-%m-%Y") as po_date, DATE_FORMAT(po_delivery_date, "%d-%m-%Y") as po_delivery_date, remarks, terms, po_total, purchase_order.status, name, CAST(sorting_number AS UNSIGNED) AS signed_values, TRIM(po_number) AS po_number_sorting_values');
            $this->db->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left');
            $this->db->order_by('BIT_LENGTH(TRIM(po_number)), CAST(sorting_number AS UNSIGNED)');
            $rs = $this->db->get_where('purchase_order', array('purchase_order.status => 1'))->result();
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

            $this->db->select('po_id, po_number, DATE_FORMAT(po_date, "%d-%m-%Y") as po_date, DATE_FORMAT(po_delivery_date, "%d-%m-%Y") as po_delivery_date, remarks, terms, po_total, purchase_order.status, name');
            $this->db->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left');
            $this->db->order_by('BIT_LENGTH(TRIM(po_number)), CAST(sorting_number AS UNSIGNED)');
            $rs = $this->db->get_where('purchase_order', array('purchase_order.status' => 1))->result();
            // echo $this->db->get_compiled_select('purchase_order');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            // $this->db->order_by($order, $dir);
            $this->db->select('po_id, po_number, DATE_FORMAT(po_date, "%d-%m-%Y") as po_date, DATE_FORMAT(po_delivery_date, "%d-%m-%Y") as po_delivery_date, remarks, terms, po_total, purchase_order.status, name');
            $this->db->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left');
            $this->db->order_by('BIT_LENGTH(TRIM(po_number)), CAST(sorting_number AS UNSIGNED)');
            $rs = $this->db->get_where('purchase_order', array('purchase_order.status' => 1))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        // echo $this->db->last_query();die;

        foreach ($rs as $val) {
            
            $num_purchase_row_rows = $this->db->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.po_id' => $val->po_id))->num_rows();

            if($val->status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['po_number'] = $val->po_number;
            $nestedData['po_date'] = $val->po_date;
            $nestedData['name'] = $val->name;
            $nestedData['po_total'] = $val->po_total;
            $nestedData['status'] = $status;
            $uvp = $this->_user_wise_view_permission(16, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                if($num_purchase_row_rows == 0) {
                $nestedData['action'] = '<a href="'. base_url('admin/edit-purchase-order/'.$val->po_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <button po-id="'.$val->po_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>
            <a href="javascript:void(0)" pk-name="po_id" pk-value="'.$val->po_id.'" tab="purchase_order" child="1" ref-table="purchase_order" ref-pk-name="item-master#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
                } else {
                $nestedData['action'] = '<a href="'. base_url('admin/edit-purchase-order/'.$val->po_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <button po-id="'.$val->po_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>';      
                }
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

// ADD purchase ORDER 

    public function ajax_fetch_purchase_order_breakup_details_on_pk() {
        $pod_id = $this->input->post('cod_id');
        //actual db table column names
        $column_orderable = array(
            0 => 'purchase_ord_brk_up.co_quantity',
            1 => 'purchase_ord_brk_up.ord_date'
        );
        // Set searchable column fields
        $column_search = array('purchase_ord_brk_up.co_quantity','purchase_ord_brk_up.ord_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('purchase_ord_brk_up', array('pod_id' => $pod_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('purchase_ord_brk_up.pod_id, purchase_ord_brk_up.co_quantity,purchase_ord_brk_up.ord_date,purchase_ord_brk_up.remarks,
                c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, purchase_ord_brk_up.cod_id, 
                item_master.item, purchase_ord_brk_up.id');
            $this->db->join('purchase_order_details', 'purchase_order_details.pod_id = purchase_ord_brk_up.pod_id', 'left');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = item_dtl.c_id', 'left');
            $rs = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $pod_id))->result();
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

            $this->db->select('purchase_ord_brk_up.pod_id, purchase_ord_brk_up.co_quantity,purchase_ord_brk_up.ord_date,purchase_ord_brk_up.remarks,
                c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, purchase_ord_brk_up.cod_id, 
                item_master.item, purchase_ord_brk_up.id');
            $this->db->join('purchase_order_details', 'purchase_order_details.pod_id = purchase_ord_brk_up.pod_id', 'left');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = item_dtl.c_id', 'left');
            $rs = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $pod_id))->result();
            // echo $this->db->get_compiled_select('purchase_order_details');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('purchase_ord_brk_up.pod_id, purchase_ord_brk_up.co_quantity,purchase_ord_brk_up.ord_date,purchase_ord_brk_up.remarks,
                c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, purchase_ord_brk_up.cod_id, 
                item_master.item, purchase_ord_brk_up.id');
            $this->db->join('purchase_order_details', 'purchase_order_details.pod_id = purchase_ord_brk_up.pod_id', 'left');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = item_dtl.c_id', 'left');
            $rs = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $pod_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {

            $customer_order_no = '';
            $array_val = array();

            if($val->cod_id != '') {
                $array_val = explode(",", $val->cod_id);
                foreach($array_val as $a_v) {
                    $customer_order_no_rows =$this->db->get_where('customer_order', array('co_id' => $a_v))->row();
                    if(count($customer_order_no_rows) > 0) {
                    $customer_order_no .= $customer_order_no_rows->co_no."<br/>";
                }
                }
            }

            $article = $val->item; 
            $nestedData['art_no'] = $article;
            $nestedData['lc_id'] = $val->leather_color;
            $nestedData['co_quantity'] = $val->co_quantity;
            $nestedData['cust_ord_no'] = $customer_order_no;
            $nestedData['ord_date'] = date("d-m-Y", strtotime($val->ord_date));
            $nestedData['remarks'] = $val->remarks;


                $nestedData['action'] = '<a href="javascript:void(0)" id="'.$val->id.'" class="customer_details_brkup_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a data-tab="purchase_ord_brk_up" data-pk="'.$val->id.'" proforma_status="0" href="javascript:void(0)" class="btn btn-danger delete_last"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function form_add_purchase_order_brkup_details(){

        $all_values_arrays =  [];
        $cod_id_val_details = '';

        if($this->input->post('cust_brkup_order[]') != ''){
                foreach ($this->input->post('cust_brkup_order[]') as $dvalue) {
                    array_push($all_values_arrays, $dvalue);
                }
                $cod_id_val_details = implode(',', $all_values_arrays);
            } else {
              $cod_id_val_details = '';  
            }
        
        $insertArray = array(
            'pod_id' => $this->input->post('cod_brk_up_id'),
            'co_quantity' => $this->input->post('article_brk_up_quantity'),
            'ord_date' => $this->input->post('article_brk_up_date'),
            'cod_id' => $cod_id_val_details,
            'remarks' => $this->input->post('article_brk_up_remarks'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('purchase_ord_brk_up', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        
        $data['type'] = 'success';
        $data['msg'] = 'Purchase order breakup details added successfully.';
        // echo '<pre>', print_r($data), '</pre>';die;

        // leather consumption area 
        // item details wise costing details 

        // $rs = $this->db->select('*')->get_where('customer_order_dtl', array('co_id' => $this->input->post('order_id')))->result();
        // echo $this->db->last_query();
        // leather consumtion area ends 
        return $data;
    }

    public function form_edit_purchase_order_details_brkup(){
        
        $data['msg'] = '';

        $all_values_arrays =  [];
        $cod_id_val_details = '';

        if($this->input->post('cust_edit_brkup_order[]') != ''){
                foreach ($this->input->post('cust_edit_brkup_order[]') as $dvalue) {
                    array_push($all_values_arrays, $dvalue);
                }
                $cod_id_val_details = implode(',', $all_values_arrays);
            } else {
              $cod_id_val_details = '';  
            }

        $insertArray = array(
            // 'am_id' => $this->input->post('am_id'),
            // 'lc_id' => $this->input->post('lc_id'),
            // 'fc_id' => $this->input->post('fc_id'),
            'co_quantity' => $this->input->post('article_brk_up_quantity_edit'),
            'ord_date' => $this->input->post('article_brk_up_date_edit'),
            'remarks' => $this->input->post('article_brk_up_remarks_edit'),
            'cod_id' => $cod_id_val_details,
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->update('purchase_ord_brk_up', $insertArray, array('id' => $this->input->post('order_id_brkup')));

        $data['type'] = 'success';
        $data['msg'] = 'Purchase order breakup details updated successfully.';

        return $data;
    }

    public function ajax_del_row_on_table_and_pk_purch_order(){
        $pk = $this->input->post('pk');
        $tab = $this->input->post('tab');

        $table = 'purchase_ord_brk_up';
        $this->db->where('id', $pk)->delete($table);

        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Item Successfully Deleted';
        return $data;
    }

    public function ajax_fetch_purchase_order_details_brkup_edit(){

        $id = $this->input->post('id');

             $this->db->select('purchase_ord_brk_up.pod_id, purchase_ord_brk_up.co_quantity,purchase_ord_brk_up.ord_date,purchase_ord_brk_up.remarks,
                c1.color as leather_color, c1.c_code as leather_code, c1.c_id as leather_id, purchase_ord_brk_up.cod_id, 
                item_master.item, purchase_ord_brk_up.cod_id, purchase_ord_brk_up.id, customer_order.co_no');
            $this->db->join('purchase_order_details', 'purchase_order_details.pod_id = purchase_ord_brk_up.pod_id', 'left');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = item_dtl.c_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = purchase_ord_brk_up.cod_id', 'left');
             return $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.id' => $id))->result();

        // echo $this->db->get_compiled_select('customer_order_dtl');

    }


    public function add_purchase_order() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
        return array('page'=>'purchase_order/purchase_order_add_v', 'data'=>$data);
    }

    public function ajax_unique_purchase_order_no(){
        $po_number = trim($this->input->post('po_number'));

        $this->db->like('purchase_order.po_number', $po_number);
        $rs = $this->db->get_where('purchase_order')->num_rows();
        
        if($rs != 0) {
            $data = 'Purchase order no. already exists.';
        }else{
            $data='true';
        }
        return $data;
    }

    public function form_add_purchase_order(){

        $data = [];
        $insertArray = array(
            'po_number' => $this->input->post('po_number'),
            'am_id' => $this->input->post('acc_master_id'),
            'po_date' => $this->input->post('po_date'),
            'po_delivery_date' => $this->input->post('delivery_date'),
            'shipment_date' => $this->input->post('shipment_date'),
            'remarks' => $this->input->post('remarks'),
            'sorting_number' => $this->input->post('sorting_numner'),
            'terms' => $this->input->post('terms'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('purchase_order', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        $data['type'] = 'success';
        $data['msg'] = 'Purchase order added successfully.';
        return $data;
    }

    public function edit_purchase_order($po_id) {
        $data['item_groups'] = $this->db->select('ig_id, ig_code, group_name')->get_where('item_groups', array('item_groups.status' => 1))->result_array();
        // $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        // $data['colors_details'] = $this->db->select('*')->get_where('colors', array('status' => 1))->result_array();

        $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();

        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
        return array('page'=>'purchase_order/purchase_order_edit_v', 'data'=>$data);
    }

    public function form_edit_purchase_order(){

        $old_array = $this->db->get_where('purchase_order', array('po_id' => $this->input->post('purchase_order_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('purchase_order_id'), 'purchase_order');

        $updateArray = array(
            'po_date' => $this->input->post('po_date'),
            'po_delivery_date' => $this->input->post('delivery_date'),
            'shipment_date' => $this->input->post('shipment_date'),
            'remarks' => $this->input->post('remarks'),
            'terms' => $this->input->post('terms'),
            'user_id' => $this->session->user_id
        );
        $this->db->update('purchase_order', $updateArray, array('po_id' => $this->input->post('purchase_order_id')));

        $data['type'] = 'success';
        $data['msg'] = 'Purchase order updated successfully.';
        return $data;

    }

    public function ajax_purchase_order_details_table_data() {
        $purchase_order_id = $this->input->post('purchase_order_id');
        //actual db table column names
        $column_orderable = array(
            0 => 'purchase_order_details.id_id',
			1 => 'colors.color',
            // 8 => 'status',
        );
        // Set searchable column fields
        $column_search = array('item_master.item');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.po_id' => $purchase_order_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            // $this->db->order_by($order, $dir);
            
			$this->db->select('purchase_order_details.pod_id, purchase_order_details.po_id, purchase_order_details.id_id, purchase_order_details.pod_quantity, FORMAT(purchase_order_details.pod_rate, 2) as pod_rate, purchase_order_details.pod_total, purchase_order_details.pod_remarks, item_master.item, colors.color, colors.c_code');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->order_by('item_master.item', 'asc');
			$rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.po_id' => $purchase_order_id))->result();
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

            $this->db->select('purchase_order_details.pod_id, purchase_order_details.po_id, purchase_order_details.id_id, purchase_order_details.pod_quantity, FORMAT(purchase_order_details.pod_rate, 2) as pod_rate, purchase_order_details.pod_total, purchase_order_details.pod_remarks, item_master.item, colors.color, colors.c_code');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
			$this->db->order_by('item_master.item', 'asc');
            $rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.po_id' => $purchase_order_id))->result();
            // echo $this->db->get_compiled_select('purchase_order_details');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
			$this->db->select('purchase_order_details.pod_id, purchase_order_details.po_id, purchase_order_details.id_id, purchase_order_details.pod_quantity, FORMAT(purchase_order_details.pod_rate, 2) as pod_rate, purchase_order_details.pod_total, purchase_order_details.pod_remarks, item_master.item, colors.color, colors.c_code');
            $this->db->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->order_by('item_master.item', 'asc');
			$rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.po_id' => $purchase_order_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
			/*$pod_quantity = $val->pod_quantity;
			$pod_rate = $val->pod_rate;
			
            $pod_total = ($pod_quantity * $pod_rate);*/
			
            $nestedData['item'] = $val->item;
            $nestedData['color'] = $val->color . ' ['. $val->c_code .']';
            $nestedData['pod_quantity'] = $val->pod_quantity;
            $nestedData['pod_rate'] = $val->pod_rate;
            $nestedData['pod_total'] = $val->pod_total;
            $nestedData['pod_remarks'] = $val->pod_remarks;
            
            $nestedData['action'] = '<a href="javascript:void(0)" pod_id="'.$val->pod_id.'" class="purchase_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" cod_id="'.$val->pod_id.'" class="brk_up_history btn btn-success">Ord. No./Delv. Dt.</a>
            <a data-tab="purchase_order_details" data-pk="'.$val->pod_id.'" id-id="'.$val->id_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
            $data[] = $nestedData;

            //echo '<pre>', print_r($rs), '</pre>'; 
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
        $this->db->select('item_dtl.id_id as item_dtl_id, colors.*, units.unit');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('units', 'units.u_id = item_master.u_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_dtl.im_id' => $item_id, 'color <>' => null))->result_array();
    }

    public function ajax_fetch_purchase_order_details_brkup_qnty(){

        $val = $this->input->post("val");
        $cod_id = $this->input->post("cod_id");
        
        $rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.pod_id' => $cod_id))->row();

        $actual_quantity = $rs->pod_quantity;

        $rs_details = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $cod_id))->num_rows();

        if($rs_details > 0) {
            $added_quantity = $this->db->select("SUM(co_quantity) as co_quantity")->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $cod_id))->row()->co_quantity;
        } else {
            $added_quantity = 0;
        }

        $data['left_qantity'] = ($actual_quantity - $added_quantity);

        return $data;
    }
    
    public function ajax_fetch_purchase_order_details_brkup_qnty_edit(){

        $val = $this->input->post("val");
        $break_up_order_id = $this->input->post("break_up_order_id");
        $cod_id = $this->input->post("cod_id");
        
        $rs = $this->db->get_where('purchase_order_details', array('purchase_order_details.pod_id' => $cod_id))->row();

        $actual_quantity = $rs->pod_quantity;

        $rs_details = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $cod_id))->num_rows();

        if($rs_details > 0) {
            $added_quantity_row = $this->db->select("SUM(co_quantity) as co_quantity")->where('id !=', $break_up_order_id)->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.pod_id' => $cod_id))->row();
        
            if(count($added_quantity_row) > 0) {
              $added_quantity = $added_quantity_row->co_quantity;  
            } else {
              $added_quantity = 0;  
            }
            
        } else {
            $added_quantity = 0;
        }

        $data['left_qantity'] = ($actual_quantity - $added_quantity);

        return $data;
    }

    public function form_add_purchase_order_details(){
        $pod_total = ($this->input->post('pod_quantity') * $this->input->post('pod_rate'));
        
        //insert purchase_order_details only if po_id + id_id is new else update previous
        $rs = $this->db->get_where('purchase_order_details', array('po_id' => $this->input->post('purchase_order_id'), 'id_id' => $this->input->post('color')))->num_rows();
        if($rs > 0){
            $pod_id = $this->db->get_where('purchase_order_details', array('po_id' => $this->input->post('purchase_order_id'), 'id_id' => $this->input->post('color')))->result()[0]->pod_id;
            $pod_quantity = $this->input->post('pod_quantity');
            $query = "UPDATE `article_costing_details` SET `quantity` = `quantity` + CAST($pod_quantity as DECIMAL) WHERE pod_id = $pod_id";
            // echo $this->db->last_query(); die;
            $this->db->query($query);
        }else{
            $insertArray = array(
                'po_id' => $this->input->post('purchase_order_id'),
                'id_id' => $this->input->post('color'), // color as id_id
                'pod_quantity' => $this->input->post('pod_quantity'),
                'pod_rate' => $this->input->post('pod_rate'),
    			'pod_total' => $pod_total,
                'pod_remarks' => $this->input->post('pod_remarks'),
                'user_id' => $this->session->user_id
            );
            // echo '<pre>', print_r($insertArray), '</pre>';die;
            $this->db->insert('purchase_order_details', $insertArray);
        }
        
        $data['pod_total'] = $this->db->select_sum('pod_total')->get_where('purchase_order_details', array('po_id' => $this->input->post('purchase_order_id')))->result()[0]->pod_total;

        // update purchase order table 
        $updateArray= array(
            'po_total' => $data['pod_total']
        );
        $this->db->update('purchase_order', $updateArray, array('po_id' => $this->input->post('purchase_order_id')));
        // echo $this->db->last_query();die;
        $data['insert_id'] = $this->db->insert_id();
        $data['type'] = 'success';
        $data['msg'] = 'purchase order details added successfully.';
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function ajax_fetch_purchase_order_details_on_pk(){
        $pod_id = $this->input->post('pod_id');
        return $this->db
            ->select('purchase_order.*, purchase_order_details.*, acc_master.name, acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, item_groups.group_name, thick')
            ->join('purchase_order', 'purchase_order_details.po_id = purchase_order.po_id', 'left') // 
            ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
            ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
            ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
            ->join('units', 'units.u_id = item_master.u_id', 'left')
            ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
            ->get_where('purchase_order_details', array('purchase_order_details.pod_id' => $pod_id))->result();
        // echo $this->db->get_compiled_select('purchase_order_details');
    }
	
	public function ajax_unique_po_number_and_art_no_and_lth_color(){
        $purchase_order_id = $this->input->post('purchase_order_id');
		$id_id = $this->input->post('id_id');
		$color = $this->input->post('color');

        $rs = $this->db->get_where('purchase_order_details', array('id_id' => $color, 'po_id' => $purchase_order_id))->num_rows();
        if($rs != '0') {
            $data = 'Same Item and Colour is already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }
    
    public function purchase_order_print_with_brkup($po_id){
        
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
                $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 7, 'user_id' => $this->session->user_id))->result(); #purchase order = 9
        
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, FORMAT(pod_quantity, 2) as pod_quantity, FORMAT(pod_rate, 2) as pod_rate,  acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_master.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->order_by('item_master.item, colors.color')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
                // echo '<pre>', print_r($data['purchase_order_details']), '</pre>'; die();
                
        return array('page'=>'purchase_order/purchase_order_print_with_brkup_v', 'data'=>$data);
    }
    
    public function purchase_order_print_with_brkup_wo_order($po_id){
        
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
                $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 7, 'user_id' => $this->session->user_id))->result(); #purchase order = 9
        
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, FORMAT(pod_quantity, 2) as pod_quantity, FORMAT(pod_rate, 2) as pod_rate,  acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_master.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->order_by('item_master.item, colors.color')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
                // echo '<pre>', print_r($data['purchase_order_details']), '</pre>'; die();
                
        return array('page'=>'purchase_order/purchase_order_print_with_brkup_wo_order_v', 'data'=>$data);
    }
	
    public function purchase_order_print_with_code($po_id){
        
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
                $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 9, 'user_id' => $this->session->user_id))->result(); #purchase order = 9
        
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, FORMAT(pod_quantity, 2) as pod_quantity, FORMAT(pod_rate, 2) as pod_rate,  acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_master.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->order_by('item_master.item, colors.color')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
                // echo '<pre>', print_r($data['purchase_order_details']), '</pre>'; die();
                
        return array('page'=>'purchase_order/purchase_order_print_with_code_v', 'data'=>$data);
    }

    public function purchase_order_print_without_code($po_id){
        
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
                $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 9, 'user_id' => $this->session->user_id))->result(); #purchase order = 9
        
        $data['purchase_order_details'] = $this->db
                ->select('purchase_order.*, purchase_order_details.*, acc_master.name, FORMAT(pod_quantity, 2) as pod_quantity, FORMAT(pod_rate, 2) as pod_rate, acc_master.address,countries.country,item_master.item,colors.color, colors.c_code, units.unit,item_groups.ig_id as item_group, thick')
                ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left') // 
                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
                ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
                ->join('item_dtl', 'purchase_order_details.id_id = item_dtl.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('units', 'units.u_id = item_master.u_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->order_by('item_master.item, colors.color')
                ->get_where('purchase_order', array('purchase_order.po_id' => $po_id))
                ->result();
            // echo '<pre>', print_r($data['purchase_order_details']), '</pre>'; die();
        return array('page'=>'purchase_order/purchase_order_print_without_code_v', 'data'=>$data);
    }


    public function form_edit_purchase_order_details(){

        $old_array = $this->db->get_where('purchase_order_details', array('pod_id' => $this->input->post('pod_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('pod_id'), 'purchase_order_details');

        $pod_total = ($this->input->post('pod_quantity_edit') * $this->input->post('pod_rate_edit'));
		
        $updateArray = array(
            'pod_quantity' => $this->input->post('pod_quantity_edit'),
            'pod_rate' => $this->input->post('pod_rate_edit'),
			'pod_total' => $pod_total,
            'pod_remarks' => $this->input->post('pod_remarks_edit'),
            'user_id' => $this->session->user_id
        );
        $pod_id = $this->input->post('pod_id');
        $this->db->update('purchase_order_details', $updateArray, array('pod_id' => $pod_id));

        $data['pod_total'] = $this->db->select_sum('pod_total')->get_where('purchase_order_details', array('po_id' => $this->input->post('purchase_order_id')))->result()[0]->pod_total;
        // update purchase order table 
        $updateArray1= array(
            'po_total' => $data['pod_total']
        );
        $this->db->update('purchase_order', $updateArray1, array('po_id' => $this->input->post('purchase_order_id')));

        $data['type'] = 'success';
        $data['msg'] = 'purchase order details updated successfully.';
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

    public function ajax_del_row_on_table_and_pk_purchase_order(){

		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		$rs = $this->db->get_where('purchase_order_receive_detail', array('po_id' => $pk_value))->num_rows();

        $rs_details = $this->db->get_where('purchase_order_details', array('po_id' => $pk_value))->num_rows();
		
		if($rs > 0){
			$data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Purchase Order already received'; 
		}else{
			$tab = $this->input->post('tab');
			if($tab == 'purchase_order'){
				//$table = 'purchase_order';
                $primary_key = $this->input->post('pk_value');
        $table_name = 'purchase_order_details';
        $pk_field_name = $this->input->post('pk_name');
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "purchase_order_details",
                    "tbl_pk_fld" => $this->input->post('pk_name'),
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
			if($this->db->where($pk_name, $pk_value)->delete($tab)) {
            if($rs_details > 0) {
                $this->db->where($pk_name, $pk_value)->delete('purchase_order_details');
            }
            }
			}
			
			$data['title'] = 'Deleted!';
			$data['type'] = 'success';
			$data['msg'] = 'Purchase Order Successfully Deleted';
		}
        return $data;
    }
	
	public function del_row_on_table_pk_purchase_order_details(){
		$pk = $this->input->post('pk');
		$tab = $this->input->post('tab');
		$id_id = $this->input->post('id_id');
		$po_id = $this->input->post('po_id');
		
		$rs = $this->db->get_where('purchase_order_receive_detail', array('po_id' => $po_id, 'id_id' => $id_id))->num_rows();
		
		if($rs > 0){
			$data['type'] = 'warning';
            $data['msg'] = 'Unsuccessful! Item of Purchase Order, already received'; 
		}else{
			$this->db->where('pod_id', $pk)->delete($tab);
			
			$pod_total1 = 0;
			
			$pod_total = $this->db->select_sum('pod_total')->get_where('purchase_order_details', array('po_id' => $po_id))->result()[0]->pod_total;

            $updateArray = array(
                'po_total' => $pod_total
            );

            $this->db->update('purchase_order', $updateArray, array('po_id' => $po_id));
			if($pod_total > 0){
				$pod_total1 = $pod_total;
			}
			$data['pod_total'] = $pod_total1;
			$data['title'] = 'Deleted!';
			$data['type'] = 'success';
			$data['msg'] = 'Item of Purchase Order Successfully Deleted';
		}
        return $data;
    }

    public function ajax_unique_purchase_order_receive_num_m() {
        $no = $this->input->post('purchase_order_receive_bill_no');
        $rs = $this->db->get_where('purchase_order_receive', array('purchase_order_receive_bill_no' => $no))->num_rows();
        // echo $this->db->last_query();die;
        
        if($rs != '0') {
            $data = 'Purchase Receive Number already exists.';
        }else{
            $data='true';
        }

        return $data;
    }
    
    public function ajax_fetch_cost_rate_wrt_item_m() {
        $id_id = $this->input->post('item_id');
        $supp_id = $this->input->post('supplier_id');
        $purchase_date = $this->input->post('purchase_date');
        $rs = $this->db->where('item_rates.effective_date <=', $purchase_date)->get_where('item_rates', array('id_id' => $id_id, 'am_id' => $supp_id))->num_rows();
        if($rs != 0) {
            $data = $this->db->where('item_rates.effective_date <=', $purchase_date)->order_by('item_rates.effective_date', 'desc')->get_where('item_rates', array('id_id' => $id_id, 'am_id' => $supp_id))->row()->purchase_rate;
        }else{
            $data='0.00';
        }
// echo $data; die();
        return $data;
    }

    // purchase ORDER ENDS 

}