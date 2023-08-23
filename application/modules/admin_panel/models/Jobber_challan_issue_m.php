<?php

class Jobber_challan_issue_m extends CI_Model {

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
            'comment' => 'jobber challan issue'
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
                'comment' => 'jobber challan issue'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function jobber_challan_issue() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(9, $this->session->user_id);
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_list_v', 'data'=>$data);
    }

    public function ajax_jobber_challan_issue_table_data() {
    // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'jobber_challan_number',
            1 => 'jobber_issue_date',
            2 => 'jobber_expected_delivery_date'
        );
        // Set searchable column fields
        $column_search = array('jobber_challan_number', 'jobber_issue_date', 'jobber_expected_delivery_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        if($module_permission == 'show'){
                $rs = $this->db->get('jobber_issue')->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_issue.user_id','left')
          ->get_where('jobber_issue', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            
            
            $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $this->db->order_by('jobber_issue.jobber_challan_number');

        if($module_permission == 'show'){
                $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_issue.user_id','left')
          ->get_where('jobber_issue', array('user_details.user_dept' => $module_permission, 'jobber_issue.status => 1'))->result();
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

            $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $this->db->order_by('jobber_issue.jobber_challan_number');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_issue.user_id','left')
          ->get_where('jobber_issue', array('user_details.user_dept' => $module_permission, 'jobber_issue.status => 1'))->result();
        }
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            
            $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
            $this->db->order_by('jobber_issue.jobber_challan_number');
            if($module_permission == 'show'){
                $rs = $this->db->get_where('jobber_issue', array('jobber_issue.status => 1'))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db
          ->join('user_details','user_details.user_id = jobber_issue.user_id','left')
          ->get_where('jobber_issue', array('user_details.user_dept' => $module_permission, 'jobber_issue.status => 1'))->result();
        }
            
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}
            $temp_co_no = '';
            $jobber_issue_id = $val->jobber_issue_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left')
            ->group_by('jobber_issue_details.co_id')
            ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'jobber_issue_details.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $total_jobb = $this->db->select_sum('jobber_issue_quantity')
            ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result()[0]->jobber_issue_quantity;


            $nestedData['customer_order'] = $temp_co_no;
            $nestedData['jobber_name'] = $val->acc_master_name;
            $nestedData['challan_number'] = $val->jobber_challan_number;
            $nestedData['jobber_date'] = $val->jobber_issue_date;
            $nestedData['total_jobb'] = $total_jobb;
            $nestedData['expected_delivery_date'] = $val->jobber_expected_delivery_date;
            $uvp = $this->_user_wise_view_permission(9, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/jobber-challan-issue-edit/'.$val->jobber_issue_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a target="_blank" href="'. base_url('admin/print-jobber-issue-challan/'.$val->jobber_issue_id) .'" class="btn btn-primary" style="padding: 6px;"><i class="fa fa-print"></i> Print </a>
            <a href="javascript:void(0)" pk-name="jobber_issue_id" pk-value="'.$val->jobber_issue_id.'" tab="jobber_issue" child="1" ref-tab="jobber_issue_details" ref-pk-name="jobber_issue_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function jobber_challan_issue_add() {
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
        
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_add_v', 'data'=>$data);
    }
    
    public function ajax_jobber_challan_issue_number(){
        $am_id = $this->input->post('am_id');
        $data = array();
        
        $jobber_challan_row_val = $this->db->select('jobber_challan_number')->order_by('jobber_issue_id','desc')->limit(1)->get_where('jobber_issue', array('am_id' => $am_id))->result();
        
        if(count($jobber_challan_row_val) > 0) {
        
        $jobber_challan_number = $jobber_challan_row_val[0]->jobber_challan_number;
        $rs = substr($jobber_challan_number, -3);
        
        } else {
        $rs = 0; 
        }
        
        $chalan_number = $rs + 1;
        // echo $this->db->last_query();
        $base_limit = '000';
        $size_chalan = strlen($rs);
        $sob_size_chalan = substr($base_limit, $size_chalan);
        
        $data['jobber_challan_id'] = str_pad($chalan_number, 3, "0", STR_PAD_LEFT);;
        return $data;
    }


    public function print_jobber_issue_challan_m($job_id) {
            // echo $ac_id; 
        $data = array();
        
        $this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, article_master.info, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") AS jobber_issue_date, acc_master.name as acc_name, acc_master.address as acc_address, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") AS jobber_expected_delivery_date');
        $this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id', 'left');
        $this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
        $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
        $this->db->order_by('customer_order.co_no, article_master.art_no, c2.color');
        $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $job_id))->result();
        $data['jobber_issue_details'] = $rs;


        $vals = '';
        foreach ($data["jobber_issue_details"] as $cd) {
            $vals .= $cd->am_id . ',';
        }
        $vals = rtrim($vals, ',');

        $this->db->select('customer_order.co_id');
        $this->db->join('jobber_issue', 'jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id', 'left');
        $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = jobber_issue_details.cod_id', 'left');  
        $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
        $this->db->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left');
        $this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
        $data['count_customer_order_number'] = $this->db->group_by('customer_order.co_id')
        ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $job_id))->result();
            $items = array();
        foreach($data['count_customer_order_number'] as $c) {
         $items[] = $c->co_id;
        }
        $items1 = implode (",", $items);
            if(count($data['count_customer_order_number']) == 1) {
                  $data['result'] = 
                  $this->print_customer_order_consumption_for_jobber_issue_challan_details($data['count_customer_order_number'][0]->co_id, $vals, $job_id);
            } else {
                $data['result'] =
                  $this->print_customer_order_consumption_for_jobber_issue_challan_details_second($items1, $vals, $job_id);
              
            }
            // echo '<pre>', print_r($data['result']), '</pre>'; die();
            return array('page'=>'jobber_challan_issue/jobber_issue_challan_print_v', 'data'=>$data);
        }

        public function print_customer_order_consumption_for_jobber_issue_challan_details($co_id, $vals, $job_id){
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
                item_groups.show_total_in_consumption,
                units.unit,
                c1.color AS lth_color,
                c2.color AS fit_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                jobber_issue_quantity,
                (
                    article_costing_details.quantity * jobber_issue_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * jobber_issue_quantity
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
            LEFT JOIN jobber_issue_details ON customer_order_dtl.cod_id = jobber_issue_details.cod_id
            WHERE
                customer_order.`co_id` = $co_id AND article_master.`am_id` IN(".$vals.") AND item_groups.`ig_id` != 1 AND item_master.`enlist_jobber` = 1 AND jobber_issue_details.`jobber_issue_id` = $job_id AND customer_order.status = 1
            GROUP BY
                item_dtl.id_id, customer_order_dtl.lc_id
                ORDER BY
                item_groups.group_name, item_master.item";

        $returnResult = $this->db->query($query)->result();
        // echo $this->db->last_query();die;
        return $returnResult;
    }

    public function print_customer_order_consumption_for_jobber_issue_challan_details_second($items1, $vals, $job_id){
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
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                jobber_issue_quantity,
                (
                    article_costing_details.quantity * jobber_issue_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * jobber_issue_quantity
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
            LEFT JOIN jobber_issue_details ON customer_order_dtl.cod_id = jobber_issue_details.cod_id 
            WHERE
                customer_order.`co_id` IN (".$items1.") AND article_master.`am_id` IN (".$vals.") AND item_groups.`ig_id` != 1 AND item_master.`enlist_jobber` = 1 AND jobber_issue_details.`jobber_issue_id` = $job_id AND customer_order.status = 1
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

        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id
        
        if($module_permission == 'show'){
          $data['customer_order'] = $this->db->select('customer_order.co_id, customer_order.co_no')
        ->join('customer_order', 'customer_order.co_id = skiving_receive_challan_details.co_id', 'left')
        ->group_by('skiving_receive_challan_details.co_id')
        ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.status' => 1))->result();
        } else {
                #module_permission contains the dept id now
            $data['customer_order'] = $this->db->select('customer_order.co_id, customer_order.co_no')
        ->join('customer_order', 'customer_order.co_id = skiving_receive_challan_details.co_id', 'left')
        ->join('user_details','user_details.user_id = skiving_receive_challan_details.user_id','left')
        ->group_by('skiving_receive_challan_details.co_id')
        ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
                
        $data['jobber_issue_details'] = $this->db->select('jobber_issue.jobber_issue_id, jobber_issue.am_id, jobber_issue.jobber_challan_number, DATE_FORMAT(jobber_issue.jobber_issue_date, "%d-%m-%Y") as jobber_issue_date, DATE_FORMAT(jobber_issue.jobber_expected_delivery_date, "%d-%m-%Y") as jobber_expected_delivery_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
        ->join('acc_master', 'acc_master.am_id = jobber_issue.am_id', 'left')
        ->get_where('jobber_issue', array('jobber_issue.jobber_issue_id' => $jobber_issue_id, 'jobber_issue.status => 1'))->result();
            
        return array('page'=>'jobber_challan_issue/jobber_challan_issue_edit_v', 'data'=>$data);
    }

    public function form_jobber_issue_edit(){

        $old_array = $this->db->get_where('jobber_issue', array('jobber_issue_id' => $this->input->post('jobber_issue_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('jobber_issue_id'), 'jobber_issue');

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

       // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id

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

        $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');     
        $this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');     
        $this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');       
        $this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');       

        if($module_permission == 'show'){
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_issue_details.user_id','left')
          ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

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
           if($module_permission == 'show'){
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_issue_details.user_id','left')
          ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'user_details.user_dept' => $module_permission))->result();
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
            $this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
            if($module_permission == 'show'){
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_issue_details.user_id','left')
          ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('jobber_issue_details.jobber_issue_detail_id,  jobber_issue_details.jobber_issue_id, jobber_issue_details.co_id, jobber_issue_details.customer_order_reference_number, jobber_issue_details.am_id, jobber_issue_details.fc_id, jobber_issue_details.lc_id, jobber_issue_details.jobber_issue_quantity, jobber_issue_details.jobber_emboss, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
            $this->db->join('customer_order', 'customer_order.co_id = jobber_issue_details.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = jobber_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = jobber_issue_details.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = jobber_issue_details.lc_id', 'left');
            if($module_permission == 'show'){
            $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = jobber_issue_details.user_id','left')
          ->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

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

        $old_array = $this->db->get_where('jobber_issue_details', array('jobber_issue_detail_id' => $this->input->post('jobber_issue_detail_id_hidden')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('jobber_issue_detail_id_hidden'), 'jobber_issue_details');

        $jobber_issue_detail_id = $this->input->post('jobber_issue_detail_id_hidden');
        $jobber_issue_quantity = $this->input->post('jobber_issue_quantity_edit');
        
        $updateArray = array(
            'jobber_issue_quantity' => $jobber_issue_quantity,
            'jobber_emboss' => $this->input->post('jobber_emboss_edit'),
            'user_id' => $this->session->user_id
        );
        
        
        $this->db->update('jobber_issue_details', $updateArray, array('jobber_issue_detail_id' => $jobber_issue_detail_id));
        $data['type'] = 'success';
        $data['msg'] = 'Jobber Issue details updated successfully.';
        return $data;
    }
    
    
    
    public function get_customer_order_dtl_cutting_receive_jobber(){
        $co_id = $this->input->post('co_id');
        $data['cut_rcv_details'] = $this->db->select('*')
               ->join('cutting_received_challan_detail', 'cutting_received_challan_detail.cut_rcv_id = cutting_received_challan.cut_rcv_id', 'left')
               ->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left')
               ->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left')
               // ->join('cutting_received_challan_detail', 'cutting_issue_challan.cut_id = cutting_received_challan_detail.cut_id', 'left')
               ->group_by('cutting_received_challan.cut_rcv_id')
               ->get_where('cutting_received_challan', array('cutting_received_challan_detail.co_id' => $co_id))
               ->result();

               // echo '<pre>', print_r($data['cut_rcv_details']), '</pre>'; die();

        
        // $query = "SELECT
        //     skiving_rcv.*,
        //     `jobber_issue_details`.`jobber_issue_quantity`
        //     FROM
        //         (
        //         SELECT
        //             `customer_order`.`co_id`,
        //             `article_master`.`am_id`,
        //             `article_master`.`art_no`,
        //             `article_master`.`alt_art_no`,
        //             `c2`.`color` AS `leather_color`,
        //             `c2`.`c_code` AS `leather_code`,
        //             `c2`.`c_id` AS `leather_id`,
        //             `skiving_receive_challan_details`.`cod_id`,
        //             `skiving_receive_challan_details`.`receive_quantity`
        //         FROM
        //             `skiving_receive_challan_details`
        //         LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `skiving_receive_challan_details`.`co_id`
        //         LEFT JOIN `article_master` ON `article_master`.`am_id` = `skiving_receive_challan_details`.`am_id`
        //         LEFT JOIN `colors` `c2` ON
        //             `c2`.`c_id` = `skiving_receive_challan_details`.`lc_id`
        //         WHERE
        //             `skiving_receive_challan_details`.`co_id` = '1'
        //         ORDER BY
        //             `customer_order`.`co_id`,
        //             `article_master`.`am_id`,
        //             `c2`.`color`
        //         ) AS skiving_rcv
        //     LEFT JOIN `jobber_issue_details` ON `jobber_issue_details`.`co_id` = `skiving_rcv`.co_id AND `jobber_issue_details`.am_id = `skiving_rcv`.am_id AND `jobber_issue_details`.`lc_id` = `skiving_rcv`.leather_id";

            // echo $query; die;
            
        // $data['article_details'] = $this->db->query($query)->result();

        $num_rows = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->num_rows();
        
        if($num_rows > 0){
            $buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
            $data['buyer_reference_no'] = $buyer_reference_no;
        }else{
            $data['buyer_reference_no'] = '-';
        }

        // echo '<pre>', print_r($data), '</pre>'; die();
        
       return $data;
    
    }

    public function get_skiving_receipt_dtl_wrt_cutting_receive_dtl_m(){
        $cut_rcv_id = $this->input->post('cut_id');

        $result = $this->db->select('*')
               ->join('skiving_receive_challan', 'skiving_receive_challan.skiving_receive_id = skiving_receive_challan_details.skiving_receive_id', 'left')
               ->group_by('skiving_receive_challan_details.skiving_receive_id')
               ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.cut_rcv_id' => $cut_rcv_id))
               ->result();

       return $result;
    
    }

    public function get_article_dtl_wrt_skiving_receive_dtl_m(){
        $skv_rcv_id = $this->input->post('skv_id');
        $cut_rcv_id = $this->input->post('cut_rcv_id');
        $co_id = $this->input->post('co_id');


        $result = $this->db->select('*')
               ->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left')
               ->join('colors', 'colors.c_id = skiving_receive_challan_details.lc_id', 'left')
                ->group_by('skiving_receive_challan_details.cod_id')
               ->order_by('article_master.art_no, colors.color')
               ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skv_rcv_id, 'skiving_receive_challan_details.cut_rcv_id' => $cut_rcv_id, 'skiving_receive_challan_details.co_id' => $co_id))
               ->result();
       return $result;
                  
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
        $lc_id = $this->input->post('lc_id');
                
        $data = array();
        
        $skiving_receive_data = $this->db->select('skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan.skiving_receive_challan_number')
        ->join('skiving_receive_challan', 'skiving_receive_challan.skiving_receive_id = skiving_receive_challan_details.skiving_receive_id', 'left')
        ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.co_id' => $co_id, 'skiving_receive_challan_details.am_id' => $am_id, 'skiving_receive_challan_details.lc_id' => $lc_id))->result();
            
        // for($i = 0; $i < sizeof($skiving_receive_data); $i++){
        //  $skiving_receive_id = $skiving_receive_data[$i]->skiving_receive_id;
        //  $receive_cut_quantity = 0;
        //  $jobber_issue_quantity = 0;
        
        //  $receive_cut_quantity = $this->db->select_sum('receive_quantity')->get_where('skiving_receive_challan_details', array('am_id' => $am_id, 'cod_id' => $cod_id, 'skiving_receive_id' => $skiving_receive_id))->result()[0]->receive_quantity;
        
        //  $jobber_issue_quantity = $this->db->select_sum('jobber_issue_quantity')->get_where('jobber_issue_details', array('am_id' => $am_id, 'co_id' => $co_id, 'skiving_receive_id' => $skiving_receive_id))->result()[0]->jobber_issue_quantity;
            
        //  $skiving_receive_data[$i]->receive_cut_quantity = $receive_cut_quantity;
        //  $skiving_receive_data[$i]->jobber_issue_quantity = $jobber_issue_quantity;
        //  $skiving_receive_data[$i]->remain_quantity_to_receive = ($receive_cut_quantity - $jobber_issue_quantity);
        // }//end for   
        
        $data['skiving_receive_data'] = $skiving_receive_data;
        
        return $data;
    }

    public function ajax_get_skiving_quantity_in_jobber(){
        $co_id = $this->input->post('co_id');
        $am_id = $this->input->post('am_id');
        $lc_id = $this->input->post('lc_id');
        $skiving_rcv_id = $this->input->post('skiving_rcv_id');
        $job_is_id = $this->input->post('job_is_id');
                
        $data = array();

        $num = $this->db->select('*')
               ->get_where('jobber_issue_details', array('skiving_receive_id' => $skiving_rcv_id, 'co_id' => $co_id, 'lc_id' => $lc_id, 'am_id' => $am_id))->num_rows();
if($num == 0) {

        $query = "SELECT
    `cutting_received_challan_detail`.`receive_cut_quantity`,
    skiving.*
    FROM
        (
        SELECT
            `skiving_receive_challan_details`.`skiving_receive_id`,
            `skiving_receive_challan_details`.`co_id`,
            `skiving_receive_challan_details`.`am_id`,
            `skiving_receive_challan_details`.`lc_id`,
            `skiving_receive_challan_details`.`fc_id`,
            `skiving_receive_challan_details`.`receive_quantity` as receive_skiving_quantity,
            `jobber_issue_details`.`jobber_issue_id`,
            `jobber_issue_details`.`jobber_issue_quantity`,
            `c1`.`color` AS `fitting_color`,
            `c2`.`color` AS `leather_color`
        FROM
            `skiving_receive_challan_details`
        LEFT JOIN `colors` `c1` ON
            `c1`.`c_id` = `skiving_receive_challan_details`.`fc_id`
        LEFT JOIN `colors` `c2` ON
            `c2`.`c_id` = `skiving_receive_challan_details`.`lc_id`
        LEFT JOIN `jobber_issue_details` ON `jobber_issue_details`.`co_id` = `skiving_receive_challan_details`.`co_id` AND `jobber_issue_details`.`am_id` = `skiving_receive_challan_details`.`am_id` AND `jobber_issue_details`.`lc_id` = `skiving_receive_challan_details`.`lc_id` AND `jobber_issue_details`.`skiving_receive_id` = `skiving_receive_challan_details`.`skiving_receive_id`   
        WHERE
            `skiving_receive_challan_details`.`skiving_receive_id` = $skiving_rcv_id AND `skiving_receive_challan_details`.`co_id` = $co_id AND `skiving_receive_challan_details`.`am_id` = $am_id AND `skiving_receive_challan_details`.`lc_id` = $lc_id
        ) AS skiving
    LEFT JOIN `cutting_received_challan_detail` ON `cutting_received_challan_detail`.`co_id` = skiving.co_id AND `cutting_received_challan_detail`.`am_id` = skiving.am_id AND `cutting_received_challan_detail`.`lc_id` = skiving.lc_id";

        // echo $query;

       return $res = $this->db->query($query)->result();

    } else {
            
            $query = "SELECT
            IFNULL(
                SUM(
                    `jobber_issue_details`.`jobber_issue_quantity`
                ),
                0
            ) AS jobber_issue_quantity,
            `jobber_issue_details`.`jobber_issue_id`,
    skiving.*
    FROM
        (
        SELECT
            `skiving_receive_challan_details`.`skiving_receive_id`,
            `skiving_receive_challan_details`.`co_id`,
            `skiving_receive_challan_details`.`am_id`,
            `skiving_receive_challan_details`.`lc_id`,
            `skiving_receive_challan_details`.`fc_id`,
            IFNULL(
                SUM(
                    `skiving_receive_challan_details`.`receive_quantity`
                ),
                0
            ) AS receive_skiving_quantity,
            `c1`.`color` AS `fitting_color`,
            `c2`.`color` AS `leather_color`
        FROM
            `skiving_receive_challan_details`
        LEFT JOIN `colors` `c1` ON
            `c1`.`c_id` = `skiving_receive_challan_details`.`fc_id`
        LEFT JOIN `colors` `c2` ON
            `c2`.`c_id` = `skiving_receive_challan_details`.`lc_id`
        WHERE
            `skiving_receive_challan_details`.`skiving_receive_id` = $skiving_rcv_id AND `skiving_receive_challan_details`.`co_id` = $co_id AND `skiving_receive_challan_details`.`am_id` = $am_id AND `skiving_receive_challan_details`.`lc_id` = $lc_id
        ) AS skiving
        LEFT JOIN `jobber_issue_details` ON `jobber_issue_details`.`co_id` = `skiving`.`co_id` AND `jobber_issue_details`.`am_id` = `skiving`.`am_id` AND `jobber_issue_details`.`lc_id` = `skiving`.`lc_id` AND `jobber_issue_details`.`skiving_receive_id` = `skiving`.`skiving_receive_id`";   

        // echo $query; die();
            // echo '<pre>', print_r($res), '</pre>'; die();


       return $res = $this->db->query($query)->result();
      
    }



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
        $skiving_receive_id = $this->input->post('skv_rcv_id_add');
        $co_id = $this->input->post('co_id');
        $cod_id = $this->input->post('cod_id_add');
        $customer_order_reference_number = $this->input->post('customer_order_reference_number');
        $am_id = $this->input->post('am_id_add_hidden');
        $lc_id = $this->input->post('lc_id');
        $fc_id = $this->input->post('fc_id');
        $jobber_issue_quantity = $this->input->post('jobber_issue_quantity_add');
        $jobber_emboss = $this->input->post('jobber_emboss_add');
        $receive_cut_quantity_add = $this->input->post('receive_cut_quantity_add');
        
        // $rs = $this->db->get_where('jobber_issue_details', array('jobber_issue_details.jobber_issue_id' => $jobber_issue_id, 'jobber_issue_details.skiving_receive_id' => $skiving_receive_id, 'jobber_issue_details.cod_id' => $cod_id, 'jobber_issue_details.am_id' => $am_id, 'jobber_issue_details.lc_id' => $lc_id, 'jobber_issue_details.jobber_issue_quantity' => $jobber_issue_quantity))->num_rows();
        
        // if($rs == 0) {
        $insertArray = array(
            'jobber_issue_id' => $jobber_issue_id,
            'skiving_receive_id' => $skiving_receive_id,
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

        // echo '<pre>',print_r($insertArray), '</pre>';die;

        $this->db->insert('jobber_issue_details', $insertArray);
        
        // echo $this->db->last_query();

        $insert_id = $this->db->insert_id();
        $data['insert_id'] = $insert_id;
        
        $updateArray = array(
            'jobber_issue_status' => 1,
            'user_id' => $this->session->user_id
        );      
        $this->db->update('customer_order', $updateArray, array('co_id' => $co_id));
        // }
        
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