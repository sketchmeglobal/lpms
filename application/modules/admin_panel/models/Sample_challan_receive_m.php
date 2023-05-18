<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last modified: 19-Mar-2021 at 11:30am
 */

class Sample_challan_receive_m extends CI_Model {

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

    public function sample_challan_receive_list() {
        $data = '';
        $data["view_permission"] = $this->_user_wise_view_permission(40, $this->session->user_id);
        return array('page'=>'sample_receive/sample_challan_receive_list_v', 'data'=>$data);
    }

    public function ajax_sample_challan_receive_table_data() {

        //actual db table column names
        $column_orderable = array(
            0 => 'acc_master.name',
            1 => 'sample_receipt_challan_number',
            2 => 'sample_receipt_challan_date',
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'sample_receipt_challan_number', 'sample_receipt_challan_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

                $rs = $this->db->get('sample_receive')->result();

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('sample_receive.sample_challan_receipt_id, sample_receive.am_id, sample_receive.sample_receipt_challan_number, DATE_FORMAT(sample_receive.sample_receipt_challan_date, "%d-%m-%Y") as sample_receipt_challan_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_receive.am_id', 'left');

                $rs = $this->db->get_where('sample_receive', array('sample_receive.status => 1'))->result();
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

            $this->db->select('sample_receive.sample_challan_receipt_id, sample_receive.am_id, sample_receive.sample_receipt_challan_number, DATE_FORMAT(sample_receive.sample_receipt_challan_date, "%d-%m-%Y") as sample_receipt_challan_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_receive.am_id', 'left');

                $rs = $this->db->get_where('sample_receive', array('sample_receive.status => 1'))->result();
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('sample_receive.sample_challan_receipt_id, sample_receive.am_id, sample_receive.sample_receipt_challan_number, DATE_FORMAT(sample_receive.sample_receipt_challan_date, "%d-%m-%Y") as sample_receipt_challan_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_receive.am_id', 'left');

                $rs = $this->db->get_where('sample_receive', array('sample_receive.status => 1'))->result();
            
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['sample_name'] = $val->acc_master_name;
            $nestedData['challan_number'] = $val->sample_receipt_challan_number;
            $nestedData['issue_date'] = $val->sample_receipt_challan_date;
            $uvp = $this->_user_wise_view_permission(40, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/sample-challan-receive-edit/'.$val->sample_challan_receipt_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="sample_challan_receipt_id" pk-value="'.$val->sample_challan_receipt_id.'" tab="sample_receive" child="1" ref-tab="sample_receive_details" ref-pk-name="sample_challan_receipt_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function sample_challan_receive_add() {
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
        
        return array('page'=>'sample_receive/sample_receive_add_v', 'data'=>$data);
    }

    public function ajax_sample_challan_receive_number(){
        $am_id = $this->input->post('am_id');
        $data = array();
        
        $rs = $this->db->get_where('sample_receive', array('am_id' => $am_id))->num_rows();
        $chalan_number = $rs + 1;
        // echo $this->db->last_query();
        $base_limit = '000';
        $size_chalan = strlen($rs);
        $sob_size_chalan = substr($base_limit, $size_chalan);
        
        $data['sample_challan_id'] = $sob_size_chalan.$chalan_number;
        return $data;
    }

    public function form_sample_challan_receive_add(){

        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'sample_receipt_challan_number' => $this->input->post('sample_challan_number'),
            'sample_receipt_challan_date' => $this->input->post('sample_issue_date'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('sample_receive', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        if($data['insert_id'] > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Sample Receipt added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted successfully.';
        }
        return $data;
    }

    public function sample_challan_receive_edit($sample_receive_id) {
        
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
                
        $data['sample_receipt_details'] = $this->db->select('sample_receive.sample_challan_receipt_id, sample_receive.am_id, sample_receive.sample_receipt_challan_number, DATE_FORMAT(sample_receive.sample_receipt_challan_date, "%d-%m-%Y") as sample_receipt_challan_date, sample_receive.total_sample_quantity_receipt, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
        ->join('acc_master', 'acc_master.am_id = sample_receive.am_id', 'left')
        ->get_where('sample_receive', array('sample_receive.sample_challan_receipt_id' => $sample_receive_id, 'sample_receive.status => 1'))->result();

        $data['article_details'] = $this->db->select('article_master.art_no, article_master.alt_art_no, article_master.am_id, article_master.info, article_dtl.lth_color_id, article_dtl.fit_color_id, c1.color as leather_color, c2.color as fitting_color')
        ->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left')
        ->join('colors c1', 'c1.c_id = article_dtl.lth_color_id', 'left')
        ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
        ->order_by('article_master.art_no, c1.color')
        ->get_where('article_master', array('article_master.status => 1'))->result();

        $data['color_details'] = $this->db->select('colors.c_id, colors.color')
        ->order_by('colors.color')
        ->get_where('colors', array('colors.status => 1'))->result();
            
        return array('page'=>'sample_receive/sample_receive_edit_v', 'data'=>$data);
    }

    public function form_sample_receive_edit(){
        $insertArray = array(
            'am_id' => $this->input->post('am_id'),
            'sample_receipt_challan_number' => $this->input->post('sample_challan_number_hidden'),
            'sample_receipt_challan_date' => $this->input->post('sample_receipt_challan_date'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->update('sample_receive', $insertArray, array('sample_challan_receipt_id' => $this->input->post('sample_receipt_id')));

        $data['type'] = 'success';
        $data['msg'] = 'Sample challan details updated successfully.';
        return $data;
    }

    public function form_add_sample_receive_challan_details(){
        $challan_quantity = $this->input->post('challan_quantity_receipt_add');
        $sample_receipt_id = $this->input->post('sample_receipt_id');
        $insertArray = array(
            'sample_challan_receipt_id' => $this->input->post('sample_receipt_id'),
            'sample_challan_number' => $this->input->post('challan_no_add'),
            'am_id' => $this->input->post('am_id_hidden_for_add'),
            'lc_id' => $this->input->post('lc_id_add_hidden'),
            'fc_id' => $this->input->post('fc_id_add_hidden'),
            'sample_receive_quantity' => $this->input->post('challan_quantity_receipt_add'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('sample_receive_details', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        $prev_quantity = $this->db->get_where('sample_receive', array('sample_challan_receipt_id' => $sample_receipt_id))->row()->total_sample_quantity_receipt;
        $new_quantity = $prev_quantity + $challan_quantity;
        $update_array = array(
            'total_sample_quantity_receipt' => $new_quantity
        );
        $this->db->update('sample_receive', $update_array, array('sample_challan_receipt_id' => $sample_receipt_id));
        

        $data['new_quantity'] = $new_quantity;
        $data['type'] = 'success';
        $data['msg'] = 'Sample challan Receipt details added successfully.';
        return $data;
    }

    public function ajax_sample_receipt_details_table_data() {
       
       $sample_issue_id = $this->input->post('sample_receipt_id');

       // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(17, $session_user_id); #17 = sample module_id

        //actual db table column names table th order
        $column_orderable = array(
            0 => 'article_master.art_no',
        );
        // Set searchable column fields
        $column_search = array('article_master.art_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];
     
        $this->db->join('article_master', 'article_master.am_id = sample_receive_details.am_id', 'left');     
        $this->db->join('colors c1', 'c1.c_id = sample_receive_details.fc_id', 'left');       
        $this->db->join('colors c2', 'c2.c_id = sample_receive_details.lc_id', 'left');       

        if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_receive_details.user_id','left')
          ->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_receive_details.sample_challan_receipt_details_id,  sample_receive_details.sample_challan_receipt_id, sample_receive_details.sample_challan_number, sample_receive_details.am_id, sample_receive_details.lc_id, sample_receive_details.fc_id, sample_receive_details.sample_receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color, sample_issue.sample_challan_number');
            $this->db->join('article_master', 'article_master.am_id = sample_receive_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_receive_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_receive_details.fc_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_receive_details.sample_challan_number', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_receive_details.user_id','left')
          ->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
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
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_receive_details.sample_challan_receipt_details_id,  sample_receive_details.sample_challan_receipt_id, sample_receive_details.sample_challan_number, sample_receive_details.am_id, sample_receive_details.lc_id, sample_receive_details.fc_id, sample_receive_details.sample_receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color, sample_issue.sample_challan_number');
            $this->db->join('article_master', 'article_master.am_id = sample_receive_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_receive_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_receive_details.fc_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_receive_details.sample_challan_number', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_receive_details.user_id','left')
          ->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_receive_details.sample_challan_receipt_details_id,  sample_receive_details.sample_challan_receipt_id, sample_receive_details.sample_challan_number, sample_receive_details.am_id, sample_receive_details.lc_id, sample_receive_details.fc_id, sample_receive_details.sample_receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color, sample_issue.sample_challan_number');
            $this->db->join('article_master', 'article_master.am_id = sample_receive_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_receive_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_receive_details.fc_id', 'left');
            $this->db->join('sample_issue', 'sample_issue.sample_issue_id = sample_receive_details.sample_challan_number', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_receive_details.user_id','left')
          ->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

       //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {

            $nestedData['issue_number'] = $val->sample_challan_number;
            $nestedData['article_number'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['fitting_color'] = $val->fitting_color;
            $nestedData['issue_quantity'] = $val->sample_receive_quantity;
            $nestedData['action'] = '<a tab="sample_receive_details" tab-pk="sample_challan_receipt_details_id" quantity="'.$val->sample_receive_quantity.'" data-pk="'.$val->sample_challan_receipt_details_id.'" ref-pk="'.$val->sample_challan_receipt_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

    public function sample_issue_by_acc_master(){
        
        $am_id = $this->input->post('am_id');

        $data = $this->db->select('sample_challan_number, sample_issue_id')->get_where('sample_issue', array('sample_issue.am_id' => $am_id))->result();

        return $data;
    }

    public function article_master_by_sample_challan_no(){
        
        $challan_no = $this->input->post('challan_no');

        $data = $this->db->select('sample_issue_details.sample_issue_detail_id,  sample_issue_details.sample_issue_id, sample_issue_details.am_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color')
        ->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left')
        ->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left')
        ->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left') 
        ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $challan_no))->result();

        return $data;
    }

    public function article_quantity_by_sample_challan_no(){
        
        $sample_issue_detail_id = $this->input->post('sample_issue_details_id');
        
        $data_rowvalue = $this->db->select('sample_issue_details.*')
        ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_detail_id' => $sample_issue_detail_id))->row();
        
        $challan_no = $data_rowvalue->sample_issue_id;
        $am_id = $data_rowvalue->am_id;
        $lc_id = $data_rowvalue->lc_id;
        $fc_id = $data_rowvalue->fc_id;
        $receipt_no = $this->input->post('receipt_no');

        $num = $this->db->select('*')
->get_where('sample_receive_details', array('sample_receive_details.sample_challan_receipt_id' => $receipt_no, 'sample_receive_details.sample_challan_number' => $challan_no, 'sample_receive_details.am_id' => $am_id, 'sample_receive_details.lc_id' => $lc_id, 'sample_receive_details.fc_id' => $fc_id)) 
->num_rows();

// echo $num; die();

if($num == 0) {
        $query = "
    SELECT
        `sample_issue_details`.`sample_issue_detail_id`,
        `sample_issue_details`.`sample_issue_id`,
        `sample_issue_details`.`am_id`,
        `sample_issue_details`.`fc_id`,
        `sample_issue_details`.`lc_id`,
        `article_master`.`art_no`,
        `c1`.`color` AS `fitting_color`,
        `c1`.`c_code` AS `fitting_code`,
        `c1`.`c_id` AS `fitting_id`,
        `c2`.`color` AS `leather_color`,
        `c2`.`c_code` AS `leather_code`,
        `c2`.`c_id` AS `leather_id`,
        IFNULL(SUM(`sample_issue_details`.`challan_quantity`), 0) AS challan_quantity,
        0 AS `receive_quantity`
    FROM
        `sample_issue_details`
    LEFT JOIN `article_master` ON `article_master`.`am_id` = `sample_issue_details`.`am_id`
    LEFT JOIN `colors` `c1` ON
        `c1`.`c_id` = `sample_issue_details`.`fc_id`
    LEFT JOIN `colors` `c2` ON
        `c2`.`c_id` = `sample_issue_details`.`lc_id`
    WHERE
        `sample_issue_details`.`sample_issue_id` = $challan_no AND `sample_issue_details`.`am_id` = $am_id AND `sample_issue_details`.`lc_id` = $lc_id AND `sample_issue_details`.`fc_id` = $fc_id
        GROUP BY
       `sample_issue_details`.`sample_issue_id`,`sample_issue_details`.`am_id`,`sample_issue_details`.`lc_id`,`sample_issue_details`.`fc_id` 
    ";

       return $sample_issue_details = $this->db->query($query)->result();
   } else {
     $query = "
        SELECT
    temp_sample_issue.*, `sample_receive_details`.`sample_challan_receipt_id`,
    IFNULL(SUM(`sample_receive_details`.`sample_receive_quantity`), 0) AS receive_quantity
FROM
    (
    SELECT
       `sample_issue_details`.`sample_issue_detail_id`,
        `sample_issue_details`.`sample_issue_id`,
        `sample_issue_details`.`am_id`,
        `sample_issue_details`.`fc_id`,
        `sample_issue_details`.`lc_id`,
        `article_master`.`art_no`,
        `c1`.`color` AS `fitting_color`,
        `c1`.`c_code` AS `fitting_code`,
        `c1`.`c_id` AS `fitting_id`,
        `c2`.`color` AS `leather_color`,
        `c2`.`c_code` AS `leather_code`,
        `c2`.`c_id` AS `leather_id`,
        IFNULL(SUM(`sample_issue_details`.`challan_quantity`), 0) AS challan_quantity
    FROM
        `sample_issue_details`
    LEFT JOIN `article_master` ON `article_master`.`am_id` = `sample_issue_details`.`am_id`
    LEFT JOIN `colors` `c1` ON
        `c1`.`c_id` = `sample_issue_details`.`fc_id`
    LEFT JOIN `colors` `c2` ON
        `c2`.`c_id` = `sample_issue_details`.`lc_id`
    WHERE
        `sample_issue_details`.`sample_issue_id` = $challan_no AND `sample_issue_details`.`am_id` = $am_id AND `sample_issue_details`.`lc_id` = $lc_id AND `sample_issue_details`.`fc_id` = $fc_id
    ) AS temp_sample_issue
    LEFT JOIN `sample_receive_details` ON `sample_receive_details`.`sample_challan_number` = `temp_sample_issue`.`sample_issue_id`
    WHERE
        `sample_receive_details`.`sample_challan_receipt_id` = $receipt_no AND `sample_receive_details`.`sample_challan_number` = $challan_no AND `sample_receive_details`.`am_id` = $am_id AND `sample_receive_details`.`lc_id` = $lc_id AND `sample_receive_details`.`fc_id` = $fc_id
    GROUP BY
        `temp_sample_issue`.`sample_issue_id`, `sample_receive_details`.`sample_challan_receipt_id`,`sample_receive_details`.`sample_challan_number`,`sample_receive_details`.`am_id`,`sample_receive_details`.`lc_id`,`sample_receive_details`.`fc_id`
        ";

     return $sample_issue_details = $this->db->query($query)->result();
   }
}

public function del_sample_challan_receipt_details_list(){
        
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $data_pk = $this->input->post('data_pk');
        $quantity = $this->input->post('quantity');
        $ref_pk = $this->input->post('ref_pk');

        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->where($tab_pk, $data_pk)->delete($tab);

        $prev_quantity = $this->db->get_where('sample_receive', array('sample_challan_receipt_id' => $ref_pk))->row()->total_sample_quantity_receipt;
        $new_quantity = ($prev_quantity - $quantity);
        $update_array = array(
            'total_sample_quantity_receipt' => $new_quantity
        );
        $this->db->update('sample_receive', $update_array, array('sample_challan_receipt_id' => $ref_pk));


        $data['new_quantity'] = $new_quantity;
        $data['type'] = 'success';
        $data['msg'] = 'Sample challan receipt details deleted successfully.';
        return $data;
    }



}