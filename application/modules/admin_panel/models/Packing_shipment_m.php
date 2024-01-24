<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020 
 * Time: 09:30
 * Last Updated On: 28 April 02:59 p.m
 */

class Packing_shipment_m extends CI_Model {

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
            'comment' => 'packing shipment'
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
                'comment' => 'packing shipment'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function packing_shipment_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(15, $this->session->user_id);
        return array('page'=>'packing_shipment/packing_shipment_list_v', 'data'=>$data);
    }

    public function ajax_packing_shipment_list_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'package_name',
            1 => 'package_date',
            2 => 'package_note'
        );
        // Set searchable column fields
        $column_search = array('package_name','package_date','package_note');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('packing_shipment.packing_shipment_id, packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.package_note, packing_shipment.remarks, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.no_of_kind_of_package, packing_shipment.description_of_goods, packing_shipment.total_quantity, packing_shipment.gross_weight, packing_shipment.net_weight, packing_shipment.status, packing_shipment.user_id, packing_shipment.create_date, packing_shipment.modify_date');
        //$this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
        $rs = $this->db->get_where('packing_shipment', array('packing_shipment.status => 1'))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('packing_shipment.packing_shipment_id, packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.package_note, packing_shipment.remarks, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.no_of_kind_of_package, packing_shipment.description_of_goods, packing_shipment.total_quantity, packing_shipment.gross_weight, packing_shipment.net_weight, packing_shipment.status, packing_shipment.user_id, packing_shipment.create_date, packing_shipment.modify_date, acc_master.name as acc_name');
            $this->db->join('packing_shipment_detail', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left');
             $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->group_by('packing_shipment.packing_shipment_id');
            $rs = $this->db->get_where('packing_shipment', array('packing_shipment.status => 1'))->result();
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

           $this->db->select('packing_shipment.packing_shipment_id, packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.package_note, packing_shipment.remarks, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.no_of_kind_of_package, packing_shipment.description_of_goods, packing_shipment.total_quantity, packing_shipment.gross_weight, packing_shipment.net_weight, packing_shipment.status, packing_shipment.user_id, packing_shipment.create_date, packing_shipment.modify_date, acc_master.name as acc_name');
            $this->db->join('packing_shipment_detail', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left');
             $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->group_by('packing_shipment.packing_shipment_id');
            $rs = $this->db->get_where('packing_shipment', array('packing_shipment.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
           $this->db->select('packing_shipment.packing_shipment_id, packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.package_note, packing_shipment.remarks, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.no_of_kind_of_package, packing_shipment.description_of_goods, packing_shipment.total_quantity, packing_shipment.gross_weight, packing_shipment.net_weight, packing_shipment.status, packing_shipment.user_id, packing_shipment.create_date, packing_shipment.modify_date, acc_master.name as acc_name');
           $this->db->join('packing_shipment_detail', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left');
           $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
           $this->db->group_by('packing_shipment.packing_shipment_id');
            $rs = $this->db->get_where('packing_shipment', array('packing_shipment.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;
        $nestedData = array();

        foreach ($rs as $val) {
            
            $nestedData['pack_name'] = $val->package_name;
            $nestedData['pack_date'] = $val->package_date;
            $nestedData['acc_name'] = $val->acc_name;
            $nestedData['total_quantity'] = $val->total_quantity;
            $nestedData['gross_weight'] = $val->gross_weight;
            $nestedData['pack_awb'] = $val->package_note;
            
            $uvp = $this->_user_wise_view_permission(15, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                
                $show_delete = $this->db->get_where('office_invoice', array('packing_shipment_id' => $val->packing_shipment_id))->num_rows();

               if($show_delete == 0) {
                
                $nestedData['action'] = '<a href="'. base_url('admin/edit-packing-shipment/'.$val->packing_shipment_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            
            <button po-id="'.$val->packing_shipment_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>

            <a href="javascript:void(0)" pk-name="packing_shipment_id" pk-value="'.$val->packing_shipment_id.'" tab="packing_shipment" child="1" ref-table="packing_shipment_detail" ref-pk-name="" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
               } else {
                   
               $nestedData['action'] = '<a href="'. base_url('admin/edit-packing-shipment/'.$val->packing_shipment_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            
            <button po-id="'.$val->packing_shipment_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>';    
                   
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

    // ADD supp.purchase ORDER 

    public function add_packing_shipment() {
        $data = array();
        $data['buyer_details'] = $this->db
        ->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        return array('page'=>'packing_shipment/packing_shipment_add_v', 'data'=>$data);
    }

    public function ajax_unique_proforma_number(){
        $proforma_number = $this->input->post('proforma_number');

        $rs = $this->db->get_where('office_proforma', array('proforma_number' => $proforma_number))->num_rows();
        if($rs != '0') {
            $data = 'Proforma Number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_packing_shipment_add(){
        $data = array();
        $insertArray = array(
            'package_name' => $this->input->post('package_name'),
            'package_date' => $this->input->post('package_date'),
            'package_note' => $this->input->post('package_note'),
            'remarks' => $this->input->post('remarks'),
            'terms_of_delivery' => $this->input->post('terms_of_delivery'),
            'mark_container' => $this->input->post('mark_container'),
            'notify' => $this->input->post('notify'),
            'pre_carriage_by' => $this->input->post('pre_carriage_by'),
            'port_of_discharge' => $this->input->post('port_of_discharge'),
            'no_of_kind_of_package' => $this->input->post('no_of_kind_of_package'),
            'description_of_goods' => $this->input->post('description_of_goods'),
            'header_box_size' => $this->input->post('header_box_size'),
            'am_id_other' => $this->input->post('am_id_other'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('packing_shipment', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        if($this->db->insert_id() > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Packing Shipment added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted successfully.';
        }
        return $data;
    }

    public function edit_packing_shipment($packing_shipment_id) {
        $data = array();
        
        $data['packing_shipment_detail'] = $this->db->select('notify, packing_shipment.packing_shipment_id, packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.package_note, packing_shipment.remarks, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.no_of_kind_of_package, packing_shipment.description_of_goods, packing_shipment.total_quantity, packing_shipment.gross_weight, packing_shipment.net_weight, packing_shipment.status, packing_shipment.user_id, packing_shipment.create_date, packing_shipment.modify_date, packing_shipment.invoice_status, packing_shipment.am_id_other, packing_shipment.header_box_size')
        ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->result();
        
        $data['customer_order'] = $this->db->select('co_id, co_no')->get_where('customer_order', array( 'customer_order.status' => 1, 'customer_order.office_proforma_status' => 1))->result();

        $data['buyer_details'] = $this->db
        ->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        
        $data['for_carton_number'] = $this->db->select('packing_shipment_detail.*')->group_by('packing_shipment_detail.carton_number')->order_by('packing_shipment_detail.carton_number')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        
        return array('page'=>'packing_shipment/packing_shipment_edit_v', 'data'=>$data);
    }

    public function form_edit_packing_shipment(){
        $data = array();
        $old_array = $this->db->get_where('packing_shipment', array('packing_shipment_id' => $this->input->post('packing_shipment_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('packing_shipment_id'), 'packing_shipment');

        $updateArray = array(
            'package_name' => $this->input->post('package_name'),
            'package_date' => $this->input->post('package_date'),
            'package_note' => $this->input->post('package_note'),
            'remarks' => $this->input->post('remarks'),
            'terms_of_delivery' => $this->input->post('terms_of_delivery'),
            'notify' => $this->input->post('notify'),
            'mark_container' => $this->input->post('mark_container'),
            'pre_carriage_by' => $this->input->post('pre_carriage_by'),
            'port_of_discharge' => $this->input->post('port_of_discharge'),
            'no_of_kind_of_package' => $this->input->post('no_of_kind_of_package'),
            'description_of_goods' => $this->input->post('description_of_goods'),
            'header_box_size' => $this->input->post('header_box_size'),
            'am_id_other' => $this->input->post('am_id_other'),
            'user_id' => $this->session->user_id
        );
        $packing_shipment_id = $this->input->post('packing_shipment_id');
        
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));

        $data['type'] = 'success';
        $data['msg'] = 'Packing/shipment updated successfully.';

        return $data;

    }

    public function ajax_packing_shipment_detail_table_data() {
        $packing_shipment_id = $this->input->post('packing_shipment_id');
        //actual db table column names table th order
        $column_orderable = array(
            0 => 'packing_shipment_detail.carton_number',
            1 => 'customer_order.co_no',
            2 => 'article_master.art_no',
            7 => 'packing_shipment_detail.article_quantity',
            8 => 'packing_shipment_detail.gross_weight',
            9 => 'packing_shipment_detail.net_weight'
        );
        // Set searchable column fields
        $column_search = array('packing_shipment_detail.carton_number','customer_order.co_no','article_master.art_no','packing_shipment_detail.article_quantity','packing_shipment_detail.gross_weight','packing_shipment_detail.net_weight');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
        $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
        $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
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

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        $nestedData = array();

        foreach ($rs as $val) {
            $carton_id = $val->box_size;
            if($carton_id > 0){
                $carton_item = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
            } else {
                $carton_item = 0; 
            }
            
            if($val->net_weight <= 0) {
               $net_weight = 0; 
            } else {
               $net_weight = $val->net_weight; 
            }
            
            $nestedData['carton_number'] = $val->carton_number;
            $nestedData['order_number'] = $val->co_no;
            $nestedData['article_number'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['item'] = $val->item;
            $nestedData['reference'] = $val->reference;
            $nestedData['box_size'] = $carton_item;//$val->box_size;
            $nestedData['quantity'] = $val->article_quantity;
            $nestedData['gross_weight'] = $val->gross_weight;
            $nestedData['net_weight'] = $net_weight;
   //          if($val->invoice_status == 0) {
   //          $nestedData['action'] = '<a href="javascript:void(0)" packing_shipment_detail_id="'.$val->packing_shipment_detail_id.'" class="packing_shipment_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
   //          <a tab="packing_shipment_detail" tab-pk="packing_shipment_detail_id" 
            // tab-val="'.$val->packing_shipment_detail_id.'" data-tab="packing_shipment" data-pk="packing_shipment_id" data-tab-val="'.$val->packing_shipment_id.'" quantity="'.$val->article_quantity.'" gross_weight="'.$val->gross_weight.'" net_weight="'.$val->net_weight.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
   //          } else {
   //          $nestedData['action'] = '<a href="javascript:void(0)" packing_shipment_detail_id="'.$val->packing_shipment_detail_id.'" class="packing_shipment_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
   //          ';   
   //          }
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
    
    public function ajax_packing_shipment_detail_table_data_second() {
        $packing_shipment_id = $this->input->post('packing_shipment_id');
        //actual db table column names table th order
        $column_orderable = array(
            0 => 'packing_shipment_detail.carton_number',
            1 => 'customer_order.co_no',
            2 => 'article_master.art_no',
            7 => 'packing_shipment_detail.article_quantity',
            8 => 'packing_shipment_detail.gross_weight',
            9 => 'packing_shipment_detail.net_weight'
        );
        // Set searchable column fields
        $column_search = array('packing_shipment_detail.carton_number','customer_order.co_no','article_master.art_no','packing_shipment_detail.article_quantity','packing_shipment_detail.gross_weight','packing_shipment_detail.net_weight');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
        $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
        $this->db->order_by('packing_shipment_detail.packing_shipment_detail_id', 'desc');
        $this->db->limit(5);
        $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->order_by('packing_shipment_detail.packing_shipment_detail_id', 'desc');
        $this->db->limit(5);
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
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

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->order_by('packing_shipment_detail.packing_shipment_detail_id', 'desc');
            $this->db->limit(5);
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();        

            $totalFiltered = count($rs);

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->order_by('packing_shipment_detail.packing_shipment_detail_id', 'desc');
        $this->db->limit(5);
            $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        
        $nestedData = array();
        foreach ($rs as $val) {
            $carton_id = $val->box_size;
            if($carton_id > 0){
                $carton_item = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
            } else {
                $carton_item = 0;
            }
            
            if($val->net_weight <= 0) {
               $net_weight = 0; 
            } else {
               $net_weight = $val->net_weight; 
            }
            
            $nestedData['carton_number'] = $val->carton_number;
            $nestedData['order_number'] = $val->co_no;
            $nestedData['article_number'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['item'] = $val->item;
            $nestedData['reference'] = $val->reference;
            $nestedData['box_size'] = $carton_item;//$val->box_size;
            $nestedData['quantity'] = $val->article_quantity;
            $nestedData['gross_weight'] = $val->gross_weight;
            $nestedData['net_weight'] = $net_weight;
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
            
            $article_quantity = $this->db->select_sum('article_quantity')->get_where('packing_shipment_detail', array('co_id' => $co_id, 'cod_id' => $cod_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'fc_id' => $fc_id, 'status' => 1))->result()[0]->article_quantity;             
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
    
    public function packing_shipment_get_customer_order_dtl_wrt_cod(){
        $cod_id = $this->input->post('cod_id');
        
        $this->db->select('customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.alt_art_no, article_master.info, article_master.carton_id, article_master.gross_weight_per_carton, article_master.number_of_article_per_carton');
        $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
        $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.cod_id' => $cod_id))->row();
        
        /* Select cartoon number
        $this->db->select('item_master.im_id, item_master.item');
        $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
        $this->db->where('item_groups.group_name', 'Carton');
        $this->db->where('item_master.status', '1');
        $data['cartons'] = $this->db->get('item_master')->result_array();
        */
        
            
            $remain_article_to_pack = 0;
            $article_quantity = 0;
            
            $co_id = $rs->co_id;
            $cod_id = $rs->cod_id;
            $am_id = $rs->am_id;
            $lc_id = $rs->lc_id;
            $fc_id = $rs->fc_id;
            $co_quantity = $rs->co_quantity;
            
            $article_quantity = $this->db->select_sum('article_quantity')->get_where('packing_shipment_detail', array('co_id' => $co_id, 'cod_id' => $cod_id, 'am_id' => $am_id, 'lc_id' => $lc_id, 'fc_id' => $fc_id, 'status' => 1))->result()[0]->article_quantity;             
            $remain_article_to_pack = ($co_quantity - $article_quantity);               
            $rs->remain_article_to_pack = $remain_article_to_pack;
            
            $carton_id = $rs->carton_id;
            if($carton_id > 0){
                $carton_item1 = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
                $carton_item = str_replace(' X ', 'X', $carton_item1);
                $rs->carton_item = $carton_item;
            }
             
            
            //echo json_encode($rs);
            return $rs;
    }
    
    public function form_edit_packing_shipment_details(){
        $data = [];
        $gross_weight = $this->input->post('gross_weight_per_carton_edit');
        $net_weight = $this->input->post('net_weight_per_carton_edit');
        
        $updateArray = array(
            'gross_weight' => $gross_weight,
            'net_weight' => $net_weight,
            'item' => $this->input->post('item_edit'),
            'reference' => $this->input->post('reference_edit'),
            'box_size' => $this->input->post('box_size_edit'),
            'leather' => $this->input->post('leather_edit'),
            'fitting' => $this->input->post('fitting_edit'),
            'article_quantity' => $this->input->post('remain_article_to_pack_edit'),
            'user_id' => $this->session->user_id
        );

        $packing_shipment_detail_id = $this->input->post('packing_shipment_detail_id');
        
        $this->db->update('packing_shipment_detail', $updateArray, array('packing_shipment_detail_id' => $packing_shipment_detail_id));
        
        //Updarte geader table quantity
        $packing_shipment_id = $this->input->post('packing_shipment_id_edit_hidden');
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
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));
        
        $insert_id = 1;
        if($insert_id > 0){
            $data['type'] = 'success';
            $data['total_quantity_new'] = $total_quantity_new;
            $data['gross_weight_new'] = $gross_weight_new;
            $data['net_weight_new'] = $net_weight_new;
            $data['msg'] = 'Packing Shipment Detail Updated Successfully.';
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
    
    public function form_add_packing_shipment_details(){
        
        $data = [];
        $packing_shipment_id = $this->input->post('packing_shipment_id_add');
        $carton_number = 0;
        $insert_id = 0;
        $co_id = $this->input->post('co_id');
        $cod_id = $this->input->post('cod_id');     
        $am_id = $this->input->post('am_id');
        $lc_id = $this->input->post('lc_id');
        $fc_id = $this->input->post('fc_id');
        $gross_weight_per_carton = $this->input->post('gross_weight_per_carton');
        $number_of_article_per_carton = $this->input->post('number_of_article_per_carton');
        $item = $this->input->post('item');
        $reference = $this->input->post('reference');
        $box_size = $this->input->post('box_size');     
        $leather = $this->input->post('leather');       
        $fitting = $this->input->post('fitting');
        $article_quantity = $this->input->post('remain_article_to_pack');
        $gross_weight = $this->input->post('gross_weight');
        if($gross_weight_per_carton > 0) {
        $net_weight = $gross_weight_per_carton - 2;
        } else {
        $net_weight = 0;   
        }
        $old_carton_number = $this->input->post('old_carton_number');

        $article_quantity_sum = 0;
        $gross_weight_sum = 0;
        $net_weight_sum = 0;

        $if_invoice_made = $this->db->get_where('office_invoice', array('office_invoice.packing_shipment_id' => $packing_shipment_id))->num_rows();

        if($if_invoice_made > 0) {
            $update_after_invoice = 1;
            $update_after_invoice_text = 'added';
        } else {
            $update_after_invoice = 0;
            $update_after_invoice_text = '';
        }
        
        if($old_carton_number > 0){
            $insertArray = array(
                'packing_shipment_id' => $packing_shipment_id,
                'carton_number' => $old_carton_number,
                'co_id' => $co_id,
                'cod_id' => $cod_id,
                'am_id' => $am_id,
                'lc_id' => $lc_id,
                'fc_id' => $fc_id,
                'item' => $item,
                'reference' => $reference,
                'box_size' => $box_size,
                'leather' => $leather,
                'fitting' => $fitting,
                'article_quantity' => $article_quantity,
                'gross_weight' => $gross_weight_per_carton,
                'net_weight' => $net_weight,
                'update_after_invoice_text' => $update_after_invoice_text,
                'update_after_invoice' => $update_after_invoice,
                'user_id' => $this->session->user_id
            );
//          echo '<pre>', print_r($insertArray), '</pre>'; die();
            $this->db->insert('packing_shipment_detail', $insertArray);
            $insert_id = $this->db->insert_id();

            $article_quantity_sum += $article_quantity;
            $gross_weight_sum += $gross_weight_per_carton;
            $net_weight_sum += $net_weight;

        }else{
            $this->db->select_max('carton_number');
            $this->db->where('packing_shipment_id', $packing_shipment_id);
            $this->db->where('packing_shipment_detail.status', 1);
            $res1 = $this->db->get('packing_shipment_detail');
            $res2 = $res1->result_array();
            $max_carton_number = $res2[0]['carton_number'];
//          echo 'max_carton_number:'.$max_carton_number; die;
            
            $loop_of_carton = floor($article_quantity / $number_of_article_per_carton);
//          echo 'loop_of_carton: '.$loop_of_carton; die();
            for($i = 0; $i < $loop_of_carton; $i++){
                $carton_number = $max_carton_number + $i + 1;
                $article_quantity_sum += $number_of_article_per_carton;
                $gross_weight_sum += $gross_weight_per_carton;
                $net_weight_sum += $net_weight;
                $insertArray = array(
                    'packing_shipment_id' => $packing_shipment_id,
                    'carton_number' => $carton_number,
                    'co_id' => $co_id,
                    'cod_id' => $cod_id,
                    'am_id' => $am_id,
                    'lc_id' => $lc_id,
                    'fc_id' => $fc_id,
                    'item' => $item,
                    'reference' => $reference,
                    'box_size' => $box_size,
                    'leather' => $leather,
                    'fitting' => $fitting,
                    'article_quantity' => $number_of_article_per_carton,
                    'gross_weight' => $gross_weight_per_carton,
                    'net_weight' => $net_weight,
                    'update_after_invoice_text' => $update_after_invoice_text,
                    'update_after_invoice' => $update_after_invoice,
                    'user_id' => $this->session->user_id
                );
                $this->db->insert('packing_shipment_detail', $insertArray);
                $insert_id = $this->db->insert_id();
            }//end for
            
            $last_carton_quantity = ($article_quantity % $number_of_article_per_carton);
            if($last_carton_quantity > 0){
                $last_carton_number = $max_carton_number + $loop_of_carton + 1;
                $carton_number = $max_carton_number + $i + 1;
                $article_quantity_sum += $last_carton_quantity;
                $gross_weight_sum += $gross_weight_per_carton;
                $net_weight_sum += $net_weight;
                
                $insertArray = array(
                    'packing_shipment_id' => $packing_shipment_id,
                    'carton_number' => $last_carton_number,
                    'co_id' => $co_id,
                    'cod_id' => $cod_id,
                    'am_id' => $am_id,
                    'lc_id' => $lc_id,
                    'fc_id' => $fc_id,
                    'item' => $item,
                    'reference' => $reference,
                    'box_size' => $box_size,
                    'leather' => $leather,
                    'fitting' => $fitting,
                    'article_quantity' => $last_carton_quantity,
                    'gross_weight' => $gross_weight_per_carton,
                    'net_weight' => $net_weight,
                    'update_after_invoice_text' => $update_after_invoice_text,
                    'update_after_invoice' => $update_after_invoice,
                    'user_id' => $this->session->user_id
                );
                $this->db->insert('packing_shipment_detail', $insertArray);
                $insert_id = $this->db->insert_id();
            };  
        }//end if else
        
        $total_quantity = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
        $gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
        $net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
        
        $total_quantity_new = $total_quantity + $article_quantity_sum;
        $gross_weight_new = $gross_weight_old + $gross_weight_sum;
        $net_weight_new = $net_weight_old + $net_weight_sum;
        
        $updateArray = array(
            'total_quantity' => $total_quantity_new,
            'gross_weight' => $gross_weight_new,
            'net_weight' => $net_weight_new
        );
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));
        
        //office proforma status update
        /*$co_id1 = $co_id[0];
        $office_proforma_status = 1;
        $updateArray = array(
            'office_proforma_status' => $office_proforma_status,
        );
        $this->db->update('customer_order', $updateArray, array('co_id' => $co_id1));*/
                
        if($insert_id > 0){
            $data['type'] = 'success';
            $data['total_quantity_new'] = $total_quantity_new;
            $data['gross_weight_new'] = $gross_weight_new;
            $data['net_weight_new'] = $net_weight_new;
            $data['msg'] = 'Packing shipment details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function form_add_details_for_same_cartoon(){
        
        $data = array();

        $packing_shipment_cartoon_id = $this->input->post('repeative_cartoon_no');
        $new_carton_number_repeatitive = $this->input->post('old_carton_number_repeatitive');
        $packing_shipment_id1 = $this->input->post('packing_shipment_id_add_for_caroon');

        
        $get_all_rows = $this->db->select('packing_shipment_detail.*')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id1, 'packing_shipment_detail.carton_number' => $packing_shipment_cartoon_id, 'packing_shipment_detail.status' => 1))->result();


        $carton_number = 0;
        $insert_id = 0;

        $article_quantity_sum = 0;
        $gross_weight_sum = 0;
        $net_weight_sum = 0;

        foreach($get_all_rows as $g_a_r) { 
        $packing_shipment_id = $g_a_r->packing_shipment_id;      
        $co_id = $g_a_r->co_id;
        $cod_id = $g_a_r->cod_id;     
        $am_id = $g_a_r->am_id;
        $lc_id = $g_a_r->lc_id;
        $fc_id = $g_a_r->fc_id;
        $gross_weight_per_carton = $g_a_r->gross_weight;
        $item = $g_a_r->item;
        $reference = $g_a_r->reference;
        $box_size = $g_a_r->box_size;     
        $leather = $g_a_r->leather;       
        $fitting = $g_a_r->fitting;
        $article_quantity = $g_a_r->article_quantity;
        $gross_weight = $g_a_r->gross_weight;
        $net_weight = $g_a_r->net_weight;
        $old_carton_number = $this->input->post('old_carton_number_repeatitive');;


             $if_invoice_made = $this->db->get_where('office_invoice', array('office_invoice.packing_shipment_id' => $g_a_r->packing_shipment_id))->num_rows();

        if($if_invoice_made > 0) {
            $update_after_invoice = 1;
            $update_after_invoice_text = 'added';
        } else {
            $update_after_invoice = 0;
            $update_after_invoice_text = '';
        }

        
            $insertArray = array(
                'packing_shipment_id' => $g_a_r->packing_shipment_id,
                'carton_number' => $new_carton_number_repeatitive,
                'co_id' => $g_a_r->co_id,
                'cod_id' => $g_a_r->cod_id,
                'am_id' => $g_a_r->am_id,
                'lc_id' => $g_a_r->lc_id,
                'fc_id' => $g_a_r->fc_id,
                'item' => $g_a_r->item,
                'reference' => $g_a_r->reference,
                'box_size' => $g_a_r->box_size,
                'leather' => $g_a_r->leather,
                'fitting' => $g_a_r->fitting,
                'article_quantity' => $g_a_r->article_quantity,
                'gross_weight' => $g_a_r->gross_weight,
                'net_weight' => $g_a_r->net_weight,
                'update_after_invoice' => $update_after_invoice,
                'update_after_invoice_text' => $update_after_invoice_text,
                'user_id' => $this->session->user_id
            );
//          echo '<pre>', print_r($insertArray), '</pre>'; die();
            $this->db->insert('packing_shipment_detail', $insertArray);
            $insert_id = $this->db->insert_id();

            $article_quantity_sum += $article_quantity;
            $gross_weight_sum += $gross_weight_per_carton;
            $net_weight_sum += $net_weight;

        }
         
        $total_quantity = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
        $gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
        $net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
        
        $total_quantity_new = $total_quantity + $article_quantity_sum;
        $gross_weight_new = $gross_weight_old + $gross_weight_sum;
        $net_weight_new = $net_weight_old + $net_weight_sum;
        
        $updateArray = array(
            'total_quantity' => $total_quantity_new,
            'gross_weight' => $gross_weight_new,
            'net_weight' => $net_weight_new
        );
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));


        //office proforma status update
        /*$co_id1 = $co_id[0];
        $office_proforma_status = 1;
        $updateArray = array(
            'office_proforma_status' => $office_proforma_status,
        );
        $this->db->update('customer_order', $updateArray, array('co_id' => $co_id1));*/
                
        if($insert_id > 0){
            $data['type'] = 'success';
            $data['total_quantity_new'] = $total_quantity_new;
            $data['gross_weight_new'] = $gross_weight_new;
            $data['net_weight_new'] = $net_weight_new;
            $data['msg'] = 'Packing shipment details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function ajax_fetch_packing_shipment_edit_data(){
        $packing_shipment_detail_id = $this->input->post('packing_shipment_detail_id');

        $rs = $this->db
        ->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no, article_master.carton_id')
        ->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left')
        ->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->result();
        
        $remain_article_to_pack = 0;
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
        }
        
        return $rs;
    }

    public function purchase_order_print_with_code($po_id){
        $data = array();
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
        $data = array();
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
        $data = [];
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

    public function delete_packing_shipment_header_list(){
        $data = array();
        $tab = $this->input->post('tab');
        $ref_table = $this->input->post('ref_table');
        $pk_name = $this->input->post('pk_name');
        $pk_value = $this->input->post('pk_value');

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

                     // print_r($reference_array);die;        


       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
        
        $this->db->where($pk_name, $pk_value)->delete($ref_table);
        $this->db->where($pk_name, $pk_value)->delete($tab);
        
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Packing Shipment List Successfully Deleted';
        return $data;
    }

    
    public function print_packing_shipment($packing_shipment_id){
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
                $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 7, 'user_id' => $this->session->user_id))->result(); # 7 = packing

        $this->db->select('notify, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, acc_master.am_id as acc_am_id, acc_master.email_id, packing_shipment.header_box_size, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.packing_shipment_detail_id');
            $this->db->order_by('packing_shipment_detail.carton_number, article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

        //   echo '<pre>', print_r($data['print_packing_list']), '</pre>'; die();
           
            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address, email_id')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            return array('page'=>'packing_shipment/packing_shipment_print_v', 'data'=>$data);
    }
    
    public function packing_shipment_consumption_m($packing_shipment_id){
        $data = [];
        $this->db->select('notify,packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.packing_shipment_detail_id');
            $this->db->order_by('packing_shipment_detail.carton_number, article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

         $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        
        $vals = '';
        foreach ($data['print_packing_list1'] as $cd) {
            $vals .= $cd->am_id . ',';
        }
        $vals = rtrim($vals, ',');
        
        $this->db->select('packing_shipment_detail.co_id');
            $this->db->group_by('packing_shipment_detail.co_id');
            $data['count_customer_order_number'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        
                    $items = array();
                    foreach($data['count_customer_order_number'] as $c) {
                    $items[] = $c->co_id;
                    }
                    $items1 = implode (",", $items);
                    
                    if(count($data['count_customer_order_number']) == 1) {
                          $data['result'] = 
                          $this->print_customer_order_consumption_for_packing_shipment_details($data['count_customer_order_number'][0]->co_id, $vals, $packing_shipment_id);
                    } else {
                        $data['result'] =
                          $this->print_customer_order_consumption_for_packing_shipment_details_second($items1, $vals, $packing_shipment_id);
                      
                    }
        
        //   echo '<pre>', print_r($vals), '</pre>'; die();
           
            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            return array('page'=>'packing_shipment/packing_shipment_consumption_print_v', 'data'=>$data);
    }
    
    public function packing_shipment_consumption_purchase_receipt_m($packing_shipment_id){
        $data = [];
        $this->db->select('notify,packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.packing_shipment_detail_id');
            $this->db->order_by('packing_shipment_detail.carton_number, article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

         $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        
        $vals = '';
        foreach ($data['print_packing_list1'] as $cd) {
            $vals .= $cd->am_id . ',';
        }
        $vals = rtrim($vals, ',');
        
        $this->db->select('packing_shipment_detail.co_id');
            $this->db->group_by('packing_shipment_detail.co_id');
            $data['count_customer_order_number'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        
                    $items = array();
                    foreach($data['count_customer_order_number'] as $c) {
                    $items[] = $c->co_id;
                    }
                    $items1 = implode (",", $items);
                    
                    if(count($data['count_customer_order_number']) == 1) {
                          $data['result'] = 
                          $this->print_customer_order_consumption_for_packing_shipment_details($data['count_customer_order_number'][0]->co_id, $vals, $packing_shipment_id);
                    } else {
                        $data['result'] =
                          $this->print_customer_order_consumption_for_packing_shipment_details_second($items1, $vals, $packing_shipment_id);
                      
                    }
        
        //   echo '<pre>', print_r($vals), '</pre>'; die();
           
            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            return array('page'=>'packing_shipment/packing_shipment_consumption_purchase_receipt_print_v', 'data'=>$data);
    }
    
    public function print_customer_order_consumption_for_packing_shipment_details($co_id, $vals, $packing_id){
        $this->db->query("SET SQL_BIG_SELECTS=1");
            $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_id,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color AS lth_color,
                c2.color AS fit_color,
                customer_order_dtl.lc_id,
                customer_order_dtl.fc_id,
                c3.color as item_color,
                c3.c_id as item_color_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                article_quantity,
                (
                    article_costing_details.quantity * article_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * article_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON customer_order_dtl.am_id = article_master.am_id
            LEFT JOIN article_costing ON article_costing.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            LEFT JOIN packing_shipment_detail ON customer_order_dtl.cod_id = packing_shipment_detail.cod_id
            WHERE
                customer_order.`co_id` = $co_id AND article_master.`am_id` IN(".$vals.") AND packing_shipment_detail.`packing_shipment_id` = $packing_id AND customer_order.status = 1 AND packing_shipment_detail.status = 1
            GROUP BY
                item_dtl.id_id, customer_order_dtl.lc_id
                ORDER BY
                item_groups.group_name, item_master.item";

        $returnResult = $this->db->query($query)->result();
        // echo $this->db->last_query();die;
        return $returnResult;
    }
    
    public function print_customer_order_consumption_for_packing_shipment_details_second($items1, $vals, $packing_id) {
            $query = "SELECT der.*, SUM(final_qnty) as super_final_qnty
FROM
(
            SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_id,
                item_groups.ig_code,
                item_groups.group_name,
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color AS lth_color,
                c2.color AS fit_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                customer_order_dtl.fc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                article_quantity,
                (
                    article_costing_details.quantity * article_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * article_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON customer_order_dtl.am_id = article_master.am_id
            LEFT JOIN article_costing ON article_costing.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            LEFT JOIN packing_shipment_detail ON customer_order_dtl.cod_id = packing_shipment_detail.cod_id 
            WHERE
                customer_order.`co_id` IN (".$items1.") AND article_master.`am_id` IN (".$vals.") AND packing_shipment_detail.`packing_shipment_id` = $packing_id AND customer_order.status = 1 AND packing_shipment_detail.status = 1
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id
    ) as der
    GROUP BY der.am_id, der.lth_color, der.item_dtl
    ORDER BY
                der.group_name, der.item_name";

        $returnResult = $this->db->query($query)->result();
        // echo $this->db->last_query();die;
        return $returnResult;
    }

    public function print_shipment_details($packing_shipment_id){
        ini_set('memory_limit', '-1');
        $data = [];
        $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
            $this->db->order_by('customer_order.co_no, article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->order_by('customer_order.co_no, article_master.alt_art_no, c2.color');
            $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
            $data['print_packing_details'] = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color as leather_color, article_master.hand_machine,
                article_master.leather_type, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, article_master.art_no, article_master.info, article_master.alt_art_no')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->order_by('customer_order.co_no, article_master.alt_art_no, colors.color')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            return array('page'=>'packing_shipment/shipment_print_v', 'data'=>$data);
    }
    
    public function print_shipment_details_with_crtn($packing_shipment_id){
        $data = [];
        $this->db->select('notify, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, article_master.size, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight, packing_shipment.header_box_size');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
            $this->db->order_by('article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();
            
            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, packing_shipment.header_box_size');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $data['print_packing_details'] = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color as leather_color, article_master.hand_machine,
                article_master.leather_type, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, article_master.art_no, article_master.info, article_master.alt_art_no')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->order_by('article_master.alt_art_no, colors.color')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            return array('page'=>'packing_shipment/shipment_print_with_crtn_v', 'data'=>$data);
    }
    
    public function print_shipment_details_wo_seal($packing_shipment_id){
        $data = [];
        $this->db->select('notify, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, article_master.size, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
            $this->db->order_by('article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, packing_shipment.header_box_size, acc_master.address as acc_address, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            $data['print_packing_details'] = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color as leather_color, article_master.hand_machine,
                article_master.leather_type, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, article_master.art_no, article_master.info, article_master.alt_art_no')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->order_by('article_master.alt_art_no, colors.color')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            return array('page'=>'packing_shipment/shipment_print_wo_seal_v', 'data'=>$data);
    }
    
    public function print_shipment_details_hs($packing_shipment_id){
        $data = [];
        $this->db->select('notify,packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, article_master.size, article_master.remark, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
            $this->db->order_by('article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, countries.country as acc_country, packing_shipment.header_box_size, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            $data['print_packing_details'] = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color as leather_color, article_master.hand_machine,
                article_master.leather_type, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, article_master.art_no, article_master.info, article_master.alt_art_no')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->order_by('article_master.alt_art_no, colors.color')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            return array('page'=>'packing_shipment/shipment_print_hs_v', 'data'=>$data);
    }
    
    public function print_shipment_details_article_weight($packing_shipment_id){
        $data = [];
        $this->db->select('notify,packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id, article_master.size, packing_shipment.net_weight as main_net_weight, packing_shipment.gross_weight as main_gross_weight');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
            $this->db->order_by('article_master.alt_art_no, c2.color');
            $data['print_packing_list'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

            $data['acc_master_details'] = $this->db->select('acc_master.name as acc_name, acc_master.address as acc_address')
            ->join('acc_master', 'acc_master.am_id = packing_shipment.am_id_other', 'left')
            ->get_where('packing_shipment', array('packing_shipment.packing_shipment_id' => $packing_shipment_id))->row();

            $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no,
            article_master.leather_type, item_master.item as item_name,
            packing_shipment.package_name, DATE_FORMAT(packing_shipment.package_date, "%d-%m-%Y") as package_date, packing_shipment.description_of_goods,
            acc_master.name as acc_name, acc_master.address as acc_address, packing_shipment.header_box_size, countries.country as acc_country, packing_shipment.pre_carriage_by, packing_shipment.port_of_discharge, packing_shipment.terms_of_delivery, packing_shipment.mark_container, packing_shipment.no_of_kind_of_package, acc_master.am_id');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
            $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left');
            $this->db->join('countries', 'countries.c_id = acc_master.c_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
            $this->db->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left');
             $this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
            $data['print_packing_list1'] = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
            
            $data['print_packing_details'] = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color as leather_color, article_master.hand_machine,
                article_master.leather_type, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, article_master.art_no, article_master.info, article_master.alt_art_no')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->order_by('article_master.alt_art_no, colors.color')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
        return array('page'=>'packing_shipment/shipment_print_article_weight_v', 'data'=>$data);
    }
    
    public function del_packing_shipment_details_list(){
        $data = [];
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $tab_val = $this->input->post('tab_val');
        
        $data_tab = $this->input->post('data_tab');
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
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));
        
        $this->db->where($tab_pk, $tab_val)->delete($tab);
                
        $data['total_quantity_new'] = $total_quantity_new;
        $data['gross_weight_new'] = $gross_weight_new;
        $data['net_weight_new'] = $net_weight_new;
        
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Packing Shipment detail deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

    public function ajax_all_packing_shipment_details(){
        $packing_shipment_id = $this->input->post('packing_shipment_id');

        $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
        $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
        $this->db->order_by('packing_shipment_detail.packing_shipment_detail_id');
        $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

        return $rs; 

    }

    public function update_packing_shipment_detail_wrt_shipment_id(){
        $data = [];
        $old_array = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $this->input->post('pack_detail_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('pack_detail_id'), 'packing_shipment_detail');

        $pack_detail_id = $this->input->post('pack_detail_id');
        $pack_id = $this->input->post('pack_id');
        $quantity = $this->input->post('quantity');
        $gross_weight = $this->input->post('gross_weight');
        $refn = $this->input->post('refn');
        $item_no = $this->input->post('item_no');
        if($gross_weight > 0) {
        $net_weight = $gross_weight - 2;
        } else {
        $net_weight = 0;   
        }
        $co_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');
        $lc_id = $this->input->post('lc_id');
        $qty = 0;
        $carton_number = $this->input->post('carton_number');

        $if_invoice_made = $this->db->get_where('office_invoice', array('office_invoice.packing_shipment_id' => $pack_id))->num_rows();

        if($if_invoice_made > 0) {
            $update_after_invoice = 1;
            $update_after_invoice_text = 'updated';
        } else {
            $update_after_invoice = 0;
            $update_after_invoice_text = '';
        }

        $pack_detail_prev_quantity = $this->db->select('article_quantity')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id))->row()->article_quantity;

        $pack_detail_prev_gross_weight = $this->db->select('gross_weight')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id))->row()->gross_weight;

        $pack_detail_prev_net_weight = $this->db->select('net_weight')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id))->row()->net_weight;

        $pack_prev_quantity = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $pack_id))->row()->total_quantity;

        $pack_prev_gross_weight = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $pack_id))->row()->gross_weight;

        $pack_prev_net_weight = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $pack_id))->row()->net_weight;

        $pack_new_quantity = $pack_prev_quantity - $pack_detail_prev_quantity + $quantity;
        $pack_new_gross_weight = $pack_prev_gross_weight - $pack_detail_prev_gross_weight + $gross_weight;
        $pack_new_net_weight = $pack_prev_net_weight - $pack_detail_prev_net_weight + $net_weight;

        $updateArray = array(
            'total_quantity' => $pack_new_quantity,
            'gross_weight' => $pack_new_gross_weight,
            'net_weight' => $pack_new_net_weight
        );
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $pack_id));

        $updateArrayDetail = array(
            'carton_number' => $carton_number,
            'article_quantity' => $quantity,
            'gross_weight' => $gross_weight,
            'net_weight' => $net_weight,
            'reference' => $refn,
            'item' => $item_no,
            'update_after_invoice' => $update_after_invoice,
            'update_after_invoice_text' => $update_after_invoice_text,
        );

        $rs = $this->db->update('packing_shipment_detail', $updateArrayDetail, array('packing_shipment_detail_id' => $pack_detail_id));

        if($rs == 1){
            $data['type'] = 'success';
            $data['total_quantity_new'] = $pack_new_quantity;
            $data['gross_weight_new'] = $pack_new_gross_weight;
            $data['net_weight_new'] = $pack_new_net_weight;
            $data['total_quantity_new1'] = $quantity;
            $data['gross_weight_new1'] = $gross_weight;
            $data['net_weight_new1'] = $net_weight;
            $data['msg'] = 'Packing shipment details updated successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Updated';
        }

        return $data;

    }
    
    public function delete_packing_shipment_detail_wrt_shipment_id(){
        $data = [];
        $primary_key = $this->input->post('pack_detail_id');
        $table_name = 'packing_shipment_detail';
        $pk_field_name = 'packing_shipment_detail_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "packing_shipment_detail",
                    "tbl_pk_fld" => "packing_shipment_detail_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

        $pack_detail_id = $this->input->post('pack_detail_id');
        $packing_shipment_id = $this->input->post('pack_id');
        $quantity = $this->input->post('quantity');
        $gross_weight = $this->input->post('gross_weight');
        if($gross_weight > 0) {
            $net_weight = $gross_weight - 2;
        } else {
            $net_weight = 0;   
        }
        $co_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');
        $lc_id = $this->input->post('lc_id');

        $article_quantity_sum = $this->db->select('article_quantity')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id, 'packing_shipment_detail.status' => 1))->row()->article_quantity;
        $gross_weight_sum = $this->db->select('gross_weight')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id, 'packing_shipment_detail.status' => 1))->row()->gross_weight;
        $net_weight_sum = $this->db->select('net_weight')->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_detail_id, 'packing_shipment_detail.status' => 1))->row()->net_weight;
        
        $total_quantity = $this->db->select('total_quantity')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->total_quantity;
        $gross_weight_old = $this->db->select('gross_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->gross_weight;
        $net_weight_old = $this->db->select('net_weight')->get_where('packing_shipment', array('packing_shipment_id' => $packing_shipment_id))->result()[0]->net_weight;
        
        $total_quantity_new = $total_quantity - $article_quantity_sum;
        $gross_weight_new = $gross_weight_old - $gross_weight_sum;
        $net_weight_new = $net_weight_old - $net_weight_sum;
        
        $updateArray = array(
            'total_quantity' => $total_quantity_new,
            'gross_weight' => $gross_weight_new,
            'net_weight' => $net_weight_new
        );
        $this->db->update('packing_shipment', $updateArray, array('packing_shipment_id' => $packing_shipment_id));

        $if_invoice_made = $this->db->get_where('office_invoice', array('office_invoice.packing_shipment_id' => $packing_shipment_id))->num_rows();

        if($if_invoice_made > 0) {
            $update_after_invoice = 1;
            $update_after_invoice_text = 'deleted';
        } else {
            $update_after_invoice = 0;
            $update_after_invoice_text = '';
        }

        unset($updateArray);
        $updateArray = array(
            'update_after_invoice' => $update_after_invoice,
            'update_after_invoice_text' => $update_after_invoice_text,
            'status' => 0
        );
        $rs = $this->db->update('packing_shipment_detail', $updateArray, array('packing_shipment_detail_id' => $pack_detail_id));
        
        ### INTRODUCED LATER - SAYAK (INSTEAD UPDATING STATUS, DELETE THE ENTIRE ROW ### 
        // $this->db->where('packing_shipment_detail_id', $pack_detail_id)->delete('packing_shipment_detail'); 
         
        //office proforma status update
        /*$co_id1 = $co_id[0];
        $office_proforma_status = 1;
        $updateArray = array(
            'office_proforma_status' => $office_proforma_status,
        );
        $this->db->update('customer_order', $updateArray, array('co_id' => $co_id1));*/
                
        if($rs == 1){
            $data['type'] = 'success';
            $data['total_quantity_new'] = $total_quantity_new;
            $data['gross_weight_new'] = $gross_weight_new;
            $data['net_weight_new'] = $net_weight_new;
            $data['msg'] = 'Packing shipment details deleted successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Deleted.';
        }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function get_all_carton_id_from_packing_list_table_m(){

        $packing_shipment_id = $this->input->post('packing_shipment_id');
        
        $this->db->select('packing_shipment_detail.*');
        $this->db->group_by('packing_shipment_detail.carton_number');
        $this->db->order_by('packing_shipment_detail.carton_number');
        $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();

        return $rs; 

    }

    public function get_all_packing_details_respect_to_carton_id_m(){

        $packing_shipment_detail_id = $this->input->post('packing_shipment_details_id');

        $packing_shipment_id = $this->db->select('packing_shipment_detail.packing_shipment_id')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->row()->packing_shipment_id;

        $co_id = $this->db->select('packing_shipment_detail.co_id')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->row()->co_id;

        $am_id = $this->db->select('packing_shipment_detail.am_id')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1, 'packing_shipment_detail.status' => 1))->row()->am_id;

        $lc_id = $this->db->select('packing_shipment_detail.lc_id')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->row()->lc_id;

        $fc_id = $this->db->select('packing_shipment_detail.fc_id')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->row()->fc_id;

        $carton_id = $this->db->select('packing_shipment_detail.box_size')->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $packing_shipment_detail_id, 'packing_shipment_detail.status' => 1))->row()->box_size;
        
        $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, sum(packing_shipment_detail.article_quantity) as total_article_quantity_value, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
        $this->db->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');    
        $this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
        $this->db->group_by('packing_shipment_detail.packing_shipment_id, packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id');
        $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.co_id' => $co_id, 'packing_shipment_detail.am_id' => $am_id, 'packing_shipment_detail.lc_id' => $lc_id, 'packing_shipment_detail.fc_id' => $fc_id, 'packing_shipment_detail.status' => 1))->result();

        if($carton_id > 0){
            $carton_item1 = $this->db->select('item')->get_where('item_master', array('im_id' => $carton_id))->result()[0]->item;
            $carton_item = str_replace(' X ', 'X', $carton_item1);
            $rs[0]->carton_item = $carton_item;
        } else {
           $rs[0]->carton_item = ''; 
        }

        return $rs; 

    }

}