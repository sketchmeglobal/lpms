<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last updated on 19-03-2021 at 10:00 am
 */

class Cutting_issue_challan_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query('SET SQL_BIG_SELECTS=1');
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
            'comment' => 'cutting issue'
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
                'comment' => 'cutting issue'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function cutting_issue_challan() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(4, $this->session->user_id);
        return array('page'=>'cutting_issue_challan/cutting_issue_challan_list_v', 'data'=>$data);
    }

    public function ajax_cutting_issue_challan_table_data() {

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

        //actual db table column names
        $column_orderable = array(
			0 => 'acc_master.name',
            1 => 'cut_number',
            2 => 'cut_date',
            3 => 'cut_total_amount',
            4 => 'cut_leather',
            5 => 'cut_lining',
            6 => 'cut_fittings'
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'cutting_issue_challan.cut_number', 'cutting_issue_challan.cut_date', 'cutting_issue_challan.cut_total_amount', 'cutting_issue_challan.cut_leather', 'cutting_issue_challan.cut_lining', 'cutting_issue_challan.cut_fittings', 'customer_order.co_no');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];
        
        if($module_permission == 'show'){
                $rs = $this->db->get('cutting_issue_challan')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = cutting_issue_challan.user_id','left')
                    ->get_where('cutting_issue_challan', array('user_details.user_dept' => $module_permission))->result();
            }

        $totalData = count($rs);
        $totalFiltered = $totalData;
        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('GROUP_CONCAT(DISTINCT customer_order.co_no SEPARATOR ",") as co_no1, cutting_issue_challan.cut_id, cutting_issue_challan.am_id, cutting_issue_challan.cut_number, DATE_FORMAT(cutting_issue_challan.cut_date, "%d-%m-%Y") as cut_date, cutting_issue_challan.cut_exp_del_dt, cutting_issue_challan.cut_leather, cutting_issue_challan.cut_lining, cutting_issue_challan.cut_fittings, cutting_issue_challan.cut_emboss, cutting_issue_challan.cut_remarks, cutting_issue_challan.cut_total_amount, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('cutting_issue_challan_details', 'cutting_issue_challan_details.cut_id = cutting_issue_challan.cut_id', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = cutting_issue_challan_details.co_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
            if($module_permission == 'show'){
                $this->db->group_by('cutting_issue_challan.cut_id');
                $rs = $this->db->get_where('cutting_issue_challan', array('acc_master.status' => 1))->result();
                // echo $totalData = count($rs);
                // echo $this->db->last_query();die;
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = cutting_issue_challan.user_id','left')
                    ->group_by('cutting_issue_challan.cut_id')
                    ->get_where('cutting_issue_challan', array('user_details.user_dept' => $module_permission, 'acc_master.status' => 1))->result();
            }
            
           
        }
        //if searching for something
        else {
            //echo $this->db->last_query();die;
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
            

            $this->db->select('GROUP_CONCAT(DISTINCT customer_order.co_no SEPARATOR ",") as co_no1, cutting_issue_challan.cut_id, cutting_issue_challan.am_id, cutting_issue_challan.cut_number, DATE_FORMAT(cutting_issue_challan.cut_date, "%d-%m-%Y") as cut_date, cutting_issue_challan.cut_exp_del_dt, cutting_issue_challan.cut_leather, cutting_issue_challan.cut_lining, cutting_issue_challan.cut_fittings, cutting_issue_challan.cut_emboss, cutting_issue_challan.cut_remarks, cutting_issue_challan.cut_total_amount, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('cutting_issue_challan_details', 'cutting_issue_challan_details.cut_id = cutting_issue_challan.cut_id', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = cutting_issue_challan_details.co_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
            if($module_permission == 'show'){
                $this->db->group_by('cutting_issue_challan.cut_id');
                $rs = $this->db->get_where('cutting_issue_challan', array('acc_master.status' => 1))->result();
                // echo $totalData = count($rs);
                // echo $this->db->last_query();die;
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = cutting_issue_challan.user_id','left')
                    ->group_by('cutting_issue_challan.cut_id')
                    ->get_where('cutting_issue_challan', array('user_details.user_dept' => $module_permission, 'acc_master.status' => 1))->result();
            }
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            
            $this->db->order_by($order, $dir);
            $this->db->select('GROUP_CONCAT(DISTINCT customer_order.co_no SEPARATOR ",") as co_no1, cutting_issue_challan.cut_id, cutting_issue_challan.am_id, cutting_issue_challan.cut_number, DATE_FORMAT(cutting_issue_challan.cut_date, "%d-%m-%Y") as cut_date, cutting_issue_challan.cut_exp_del_dt, cutting_issue_challan.cut_leather, cutting_issue_challan.cut_lining, cutting_issue_challan.cut_fittings, cutting_issue_challan.cut_emboss, cutting_issue_challan.cut_remarks, cutting_issue_challan.cut_total_amount, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('cutting_issue_challan_details', 'cutting_issue_challan_details.cut_id = cutting_issue_challan.cut_id', 'left');
			$this->db->join('customer_order', 'customer_order.co_id = cutting_issue_challan_details.co_id', 'left');
			$this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
            if($module_permission == 'show'){
                $this->db->group_by('cutting_issue_challan.cut_id');
                $rs = $this->db->get_where('cutting_issue_challan', array('acc_master.status' => 1))->result();
                // echo $totalData = count($rs);
                // echo $this->db->last_query();die;
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = cutting_issue_challan.user_id','left')
                    ->group_by('cutting_issue_challan.cut_id')
                    ->get_where('cutting_issue_challan', array('user_details.user_dept' => $module_permission, 'acc_master.status' => 1))->result();
            }
			
            $this->db->flush_cache();
        }
        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
         //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $temp_co_no = '';
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = cutting_issue_challan_details.co_id', 'left')
            ->group_by('cutting_issue_challan_details.cut_id')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $val->cut_id, 'cutting_issue_challan_details.status' => 1))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $temp_total_qnty = 0;
            $cutting_quantity_row = $this->db->select('sum(cut_co_quantity) as cut_co_quantity')
            ->group_by('cutting_issue_challan_details.cut_id')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $val->cut_id, 'cutting_issue_challan_details.status' => 1))->result();
        
        if(count($cutting_quantity_row) > 0) {
        foreach ($cutting_quantity_row as $c) {
            $temp_total_qnty += $c->cut_co_quantity;
             }
            }

            $nestedData['cut_id'] = $val->cut_id;
			$nestedData['am_id'] = $val->acc_master_name.'['.$val->acc_master_short_name.']';
			$nestedData['cut_number'] = $val->cut_number;
            $nestedData['cut_date'] = $val->cut_date;
            $nestedData['cut_leather'] = $val->cut_leather;
			$nestedData['cut_lining'] = $val->cut_lining;
			$nestedData['cut_fittings'] = $val->cut_fittings;
			$nestedData['cut_total_amount'] = $temp_total_qnty;
            $nestedData['order_no'] = $val->co_no1;
            $uvp = $this->_user_wise_view_permission(4, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-cutting-issue-challan/'.$val->cut_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <!--<button cut-id="'.$val->cut_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>-->
            <a target="_blank" href="'. base_url('admin/print-cutting-issue-challan/'.$val->cut_id) .'" class="btn btn-primary" style="padding: 6px;"><i class="fa fa-print"></i> Print </a>
            <a href="javascript:void(0)" pk-name="cut_id" pk-value="'.$val->cut_id.'" tab="cutting_issue_challan" child="1" ref-table="cutting_issue_challan_details" ref-pk-name="cut_id#multiple-check" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function add_cutting_issue_challan() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();
        return array('page'=>'cutting_issue_challan/cutting_issue_challan_add_v', 'data'=>$data);
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

    public function form_add_cutting_issue_challan(){

        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'cut_number' => $this->input->post('cut_number'),
            'cut_date' => $this->input->post('cut_date'),
            'cut_exp_del_dt' => $this->input->post('cut_exp_del_dt'),
            'cut_leather' => $this->input->post('cut_leather'),
            'cut_lining' => $this->input->post('cut_lining'),
			'cut_fittings' => $this->input->post('cut_fittings'),
			'cut_emboss' => $this->input->post('cut_emboss'),
			'cut_remarks' => $this->input->post('cut_remarks'),
			'status' => $this->input->post('status'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('cutting_issue_challan', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Cutting Issue Challan added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_cutting_issue_challan($cut_id) {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_master.acc_type' => 'Cutter'))->result();
		
		// fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

            // echo '<pre>', print_r($module_permission), '</pre>'; die();

        $data['customer_order'] = array();

        if($module_permission == 'show'){
                 $order_table = $this->db->select('co_id, co_no')
        ->get_where('customer_order', array( 'customer_order.status' => 1))->result();
        foreach($order_table as $o_t) {
            $order_total = $this->db->select_sum('customer_order_dtl.co_quantity')->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $o_t->co_id))->row()->co_quantity;
            $cutting_total_num = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id'))->num_rows();
            if($cutting_total_num > 0) {
            $cutting_total = $this->db->select_sum('cutting_issue_challan_details.cut_co_quantity')->group_by('')->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id' => $o_t->co_id))->row()->cut_co_quantity;
            } else {
            $cutting_total = 0;   
            }         
         if($order_total > $cutting_total) {
             $arr = array(
                 'co_id' => $o_t->co_id,
                 'co_no' => $o_t->co_no
                 );
             array_push($data['customer_order'], $arr);
         }
            
        }
            } else {
                #module_permission contains the dept id now
                $order_table = $this->db->select('co_id, co_no')
        ->join('user_details','user_details.user_id = customer_order.user_id','left')
        ->where('user_details.user_dept', $module_permission)
        ->get_where('customer_order', array( 'customer_order.status' => 1))->result();
        foreach($order_table as $o_t) {
            $order_total = $this->db->select_sum('customer_order_dtl.co_quantity')->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $o_t->co_id))->row()->co_quantity;
            $cutting_total_num = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id'))->num_rows();
            if($cutting_total_num > 0) {
            $cutting_total = $this->db->select_sum('cutting_issue_challan_details.cut_co_quantity')->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id' => $o_t->co_id))->row()->cut_co_quantity;
            } else {
            $cutting_total = 0;   
            }
         if($order_total > $cutting_total) {
             $arr = array(
                 'co_id' => $o_t->co_id,
                 'co_no' => $o_t->co_no
                 );
             array_push($data['customer_order'], $arr);
         }
            
        }
            }
            
        $data['cutting_issue_challan_details'] = $this->db
                ->select('cutting_issue_challan.*, acc_master.am_id, acc_master.name, acc_master.short_name')
                ->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left')
                ->get_where('cutting_issue_challan', array('cutting_issue_challan.cut_id' => $cut_id))
                ->result();
        return array('page'=>'cutting_issue_challan/cutting_issue_challan_edit_v', 'data'=>$data);
    }

    public function form_edit_cutting_issue_challan(){

        $old_array = $this->db->get_where('cutting_issue_challan', array('cut_id' => $this->input->post('cut_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('cut_id'), 'cutting_issue_challan');

        $updateArray = array(
            'am_id' => $this->input->post('am_id'),
            'cut_number' => $this->input->post('cut_number'),
            'cut_date' => $this->input->post('cut_date'),
			'cut_exp_del_dt' => $this->input->post('cut_exp_del_dt'),
			'cut_leather' => $this->input->post('cut_leather'),
			'cut_lining' => $this->input->post('cut_lining'),
			'cut_fittings' => $this->input->post('cut_fittings'),
			'cut_emboss' => $this->input->post('cut_emboss'),
			'cut_remarks' => $this->input->post('cut_remarks'),
			'status' => $this->input->post('status'),
            'user_id' => $this->session->user_id
        );
        $cut_id = $this->input->post('cut_id');
		
        $this->db->update('cutting_issue_challan', $updateArray, array('cut_id' => $cut_id));

        $data['type'] = 'success';
        $data['msg'] = 'Cutting Issue Challan updated successfully.';

        return $data;

    }

    public function ajax_cutting_issue_challan_details_table_data() {
        $cut_id = $this->input->post('cut_id');
		//actual db table column names table th order

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

        $column_orderable = array(
			0 => 'co_no',
            2 => 'art_no'
        );
        // Set searchable column fields
        $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        // $rs = $this->db->get('cutting_issue_challan_details')->result();
        
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');	
        $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
        
            if($module_permission == 'show'){
                $rs = $this->db
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
            } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = cutting_issue_challan_details.user_id','left')
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id, 'user_details.user_dept' => $module_permission))->result();

            }

            
            
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cutting_issue_challan_details.cut_dtl_id,cutting_issue_challan_details.cut_co_quantity,cutting_issue_challan_details.co_part,customer_order.co_no, cutting_issue_challan_details.cut_id,
            DATE_FORMAT(customer_order.co_date, "%d-%m-%Y") AS co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, 
            customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
            } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = cutting_issue_challan_details.user_id','left')
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id, 'user_details.user_dept' => $module_permission))->result();

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

            $this->db->select('cutting_issue_challan_details.cut_dtl_id,cutting_issue_challan_details.cut_co_quantity,cutting_issue_challan_details.co_part,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, cutting_issue_challan_details.cut_id, 
                DATE_FORMAT(customer_order.co_date, "%d-%m-%Y") AS co_date,c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
            } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = cutting_issue_challan_details.user_id','left')
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id, 'user_details.user_dept' => $module_permission))->result();

            }
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('cutting_issue_challan_details.cut_dtl_id,cutting_issue_challan_details.cut_co_quantity,cutting_issue_challan_details.co_part,customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, cutting_issue_challan_details.cut_id, 
                DATE_FORMAT(customer_order.co_date, "%d-%m-%Y") AS co_date,,c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            if($module_permission == 'show'){
                $rs = $this->db
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
            } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = cutting_issue_challan_details.user_id','left')
            ->order_by('art_no,c2.color')
            ->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id, 'user_details.user_dept' => $module_permission))->result();

            }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            if($val->cut_co_quantity == 0){
                continue;
            }
            
            $nestedData['co_no'] = $val->co_no;
			$nestedData['co_date'] = $val->co_date;
			$nestedData['art_no'] = $val->art_no;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['co_quantity'] = $val->co_quantity;
			$nestedData['cut_co_quantity'] = $val->cut_co_quantity;
			$nestedData['co_part'] = $val->co_part;
            
            $nestedData['action'] = '<!--<a href="javascript:void(0)" cut_dtl_id="'.$val->cut_dtl_id.'" class="cut_issue_challan_dtl_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>-->
            <a tab="cutting_issue_challan_details" tab-pk="cut_dtl_id" data-tab="cutting_issue_challan_details" data-pk="'.$val->cut_dtl_id.'" quantity="'.$val->cut_co_quantity.'" ref-pk="'.$val->cut_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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
    
	public function get_customer_order_dtl(){
        $co_id = $this->input->post('co_id');
        $this->db->select('customer_order.co_no,DATE_FORMAT(customer_order.co_date, "%d-%m-%Y") as co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.alt_art_no');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('art_no, leather_color')->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $co_id))->result();
			
			for($i = 0; $i < sizeof($rs); $i++){
				$cod_id = 0;
				$am_id = 0;
				$co_quantity = 0;
				$cut_co_quantity = 0;
				$remaining_cut_co_quantity = 0;
				
				$cod_id = $rs[$i]->cod_id;
				$am_id = $rs[$i]->am_id;
				$co_quantity = $rs[$i]->co_quantity;
				
				$cut_co_quantity = $this->db->select_sum('cut_co_quantity')->get_where('cutting_issue_challan_details', array('cod_id' => $cod_id, 'am_id' => $am_id))->result()[0]->cut_co_quantity;
				
				$remaining_cut_co_quantity = ($co_quantity - $cut_co_quantity);
				
				$rs[$i]->cut_co_quantity = $cut_co_quantity;
				$rs[$i]->remaining_cut_co_quantity = $remaining_cut_co_quantity;
			}//end for
			
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
	
    public function form_add_cutting_issue_challan_details(){
		
        $cut_id = $this->input->post('cut_id');
		$co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('cod_id');
		$cut_co_quantity = $this->input->post('cut_co_quantity');		
		$co_part = $this->input->post('co_part');
		$am_id = $this->input->post('am_id');
		$fc_id = $this->input->post('fc_id');
		$lc_id = $this->input->post('lc_id');
		
		// echo sizeof($cod_id);die;
		$cut_co_quantity_temp = 0;
		for($i = 0; $i < sizeof($cod_id); $i++){
			//echo 'cut_id: '.$cut_id.' cod_id:'.$cod_id[$i].' 	cut_co_quantity: '.$cut_co_quantity[$i].' co_part: '.$co_part[$i];
			$insertArray = array(
				'cut_id' => $cut_id,
				'co_id' => $co_id,
				'cod_id' => $cod_id[$i],
				'am_id' => $am_id[$i],
				'fc_id' => $fc_id[$i],
				'lc_id' => $lc_id[$i],
				'cut_co_quantity' => $cut_co_quantity[$i],
				'co_part' => $co_part[$i],
				'user_id' => $this->session->user_id
			);
			$cutting_issuess = $this->db->get_where('cutting_issue_challan_details', $insertArray)->num_rows();
			if($cutting_issuess == 0) {
			$cut_co_quantity_temp = $cut_co_quantity_temp + $cut_co_quantity[$i];
			
			$this->db->insert('cutting_issue_challan_details', $insertArray);
			$insert_id = $this->db->insert_id();
			}
		}//end for
		$data['insert_id'] = $insert_id;
		
// 		update cutting status in customer order table
        // print_r($co_id);
        if($insert_id > 0){
        // for($i = 0; $i < sizeof($co_id); $i++){
            $total_co_quantity = $this->db->get_where('customer_order', array('co_id' => $co_id))->result()[0]->co_total_quantity;
            // echo $this->db->last_query()."<br/>";
            $total_cut_quantity = $this->db->select('SUM(cut_co_quantity) as cut_co_quantity')->get_where('cutting_issue_challan_details', array('co_id' => $co_id))->result()[0]->cut_co_quantity;
            // echo $this->db->last_query(); 
            if($total_cut_quantity == $total_co_quantity){
                $update_array = array(
                    'cutting_status' => 1
                );
                $this->db->where(array('co_id' => $co_id))->update('customer_order', $update_array);
            }
            
        // }
		
		$cut_id1 = $cut_id[0];
        $cut_total_amount_old = $this->db->select_sum('cut_total_amount')->get_where('cutting_issue_challan', array('cut_id' => $cut_id1))->result()[0]->cut_total_amount;
		$cut_total_amount_new = $cut_total_amount_old + $cut_co_quantity_temp;
		
		$update_array = array(
			'cut_total_amount' => $cut_total_amount_new
		);
		$this->db->where(array('cut_id' => $cut_id1))->update('cutting_issue_challan', $update_array);
		
			$data['cut_total_amount_new'] = $cut_total_amount_new;
			$data['type'] = 'success';
			$data['msg'] = 'Cutting issue challan details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Cutting issue challan  details not added successfully.';
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

    public function print_cutting_issue_challan_m($cut_id) {
        $this->db->query("SET sql_mode = ''");
        $this->db->select('cutting_issue_challan_details.cut_dtl_id,cutting_issue_challan_details.cut_co_quantity,cutting_issue_challan_details.co_part, cutting_issue_challan.cut_number, DATE_FORMAT(cutting_issue_challan.cut_date, "%d-%m-%Y") AS cut_date, DATE_FORMAT(cutting_issue_challan.cut_exp_del_dt, "%d-%m-%Y") AS cut_exp_del_dt, cutting_issue_challan.cut_leather, cutting_issue_challan.cut_lining, cutting_issue_challan.cut_fittings, cutting_issue_challan.cut_emboss, cutting_issue_challan.cut_remarks, customer_order.co_no,
            DATE_FORMAT(customer_order.co_date, "%d-%m-%Y") AS co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, 
            SUM(customer_order_dtl.co_quantity) AS co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no, article_master.info, acc_master.name as acc_name, article_costing_details.quantity');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');  
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('article_costing', 'article_costing.am_id = article_master.am_id', 'left');
            $this->db->join('article_costing_details', 'article_costing_details.ac_id = article_costing.ac_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_issue_challan_details.cut_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
            $this->db->group_by('article_master.am_id, customer_order_dtl.lc_id, customer_order_dtl.co_id');
            $data['cutting_issue_details'] = $this->db->order_by('article_master.art_no,c2.color')->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();

        $vals = '';
        foreach ($data["cutting_issue_details"] as $cd) {
            $vals .= $cd->am_id . ',';
        }
        $vals = rtrim($vals, ',');

            $this->db->select('customer_order.co_id');
            $this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_issue_challan_details.cut_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id', 'left');  
            $this->db->join('customer_order', 'customer_order.co_id = cutting_issue_challan_details.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = cutting_issue_challan_details.am_id', 'left');
            $this->db->join('acc_master', 'acc_master.am_id = cutting_issue_challan.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = cutting_issue_challan_details.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = cutting_issue_challan_details.lc_id', 'left');
            $data['count_customer_order_number'] = $this->db->group_by('customer_order.co_id')->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.cut_id' => $cut_id))->result();
            if(count($data['count_customer_order_number']) == 1) {
                  $data['result'] = $this->print_customer_order_consumption($data['count_customer_order_number'][0]->co_id, $vals, $cut_id);
            }
            // echo $vals;

                            // echo '<pre>', print_r($data), '</pre>'; die();
                            // echo $this->db->last_query(); die;
            return array('page'=>'cutting_issue_challan/cutting_issue_challan_print_v', 'data'=>$data);
        }

        public function print_customer_order_consumption($co_id, $vals, $cut_id){
            $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                acc_master.short_name,
                item_master.item AS item_name,
                item_master.im_code AS item_code,
                item_groups.ig_code,
                item_groups.group_name,
                units.unit,
                colors.color,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                cut_co_quantity,
                (
                    article_costing_details.quantity * cut_co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * cut_co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON customer_order_dtl.am_id = article_master.am_id
            LEFT JOIN article_costing ON article_costing.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors ON customer_order_dtl.lc_id = colors.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            LEFT JOIN cutting_issue_challan_details ON customer_order_dtl.cod_id = cutting_issue_challan_details.cod_id
            WHERE
                customer_order.`co_id` = $co_id AND article_master.`am_id` IN($vals) AND item_groups.`ig_id` = 1 AND cutting_issue_challan_details.`cut_id` = $cut_id AND customer_order.status = 1
            GROUP BY
                item_dtl.id_id, customer_order_dtl.lc_id";

        return $this->db->query($query)->result();
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
	/**
	<a href="javascript:void(0)" pk-name="cut_id" pk-value="'.$val->cut_id.'" tab="cutting_issue_challan" child="1" ref-table="cutting_issue_challan_detail" ref-pk-name="cut_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
	**/

    public function delete_cutting_issue_challan_details(){
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_table');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
		$this->db->where($pk_name, $pk_value)->delete($ref_table);
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting issue challan Successfully Deleted';
        return $data;
    }
	
	public function delete_cutting_issue_challan_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
        $quantity = $this->input->post('quantity');
        $ref_pk = $this->input->post('ref_pk');

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

        $prev_quantity = $this->db->get_where('cutting_issue_challan', array('cut_id' => $ref_pk))->row()->cut_total_amount;

        $new_quantity = $prev_quantity - $quantity;

        $update_array = array(
           'cut_total_amount' => $new_quantity
        );

        $this->db->update('cutting_issue_challan', $update_array, array('cut_id' => $ref_pk));

        $this->db->where($tab_pk, $data_pk)->delete($tab);

        $data['new_quantity'] = $new_quantity;

        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Cutting issue challan detail detail successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}