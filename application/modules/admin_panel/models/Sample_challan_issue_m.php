<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last modified: 19-Mar-2021 at 11:30am
 */

class Sample_challan_issue_m extends CI_Model {

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

    public function sample_challan_issue_list() {
        $data = '';
        $data["view_permission"] = $this->_user_wise_view_permission(39, $this->session->user_id);
        return array('page'=>'sample_issue/sample_challan_issue_list_v', 'data'=>$data);
    }

    public function ajax_sample_challan_issue_table_data() {
        
        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(17, $session_user_id); #17 = Sample module_id

        //actual db table column names
        $column_orderable = array(
            0 => 'sample_challan_number',
            1 => 'sample_issue_date',
            2 => 'acc_master.name',
        );
        // Set searchable column fields
        $column_search = array('acc_master.name', 'sample_challan_number', 'sample_issue_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];
        
        if($module_permission == 'show'){
                $rs = $this->db->get('sample_issue')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = sample_issue.user_id','left')
                    ->get_where('sample_issue', array('user_details.user_dept' => $module_permission))->result();
            }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('sample_issue.sample_issue_id, sample_issue.am_id, sample_issue.sample_challan_number, DATE_FORMAT(sample_issue.sample_issue_date, "%d-%m-%Y") as sample_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_issue.am_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_issue', array('sample_issue.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = sample_issue.user_id','left')
                    ->get_where('sample_issue', array('user_details.user_dept' => $module_permission, 'sample_issue.status' => '1'))->result();
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

            $this->db->select('sample_issue.sample_issue_id, sample_issue.am_id, sample_issue.sample_challan_number, DATE_FORMAT(sample_issue.sample_issue_date, "%d-%m-%Y") as sample_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_issue.am_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_issue', array('sample_issue.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = sample_issue.user_id','left')
                    ->get_where('sample_issue', array('user_details.user_dept' => $module_permission, 'sample_issue.status' => '1'))->result();
            }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
            $this->db->select('sample_issue.sample_issue_id, sample_issue.am_id, sample_issue.sample_challan_number, DATE_FORMAT(sample_issue.sample_issue_date, "%d-%m-%Y") as sample_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
            $this->db->join('acc_master', 'acc_master.am_id = sample_issue.am_id', 'left');
            
            if($module_permission == 'show'){
                $rs = $this->db->get_where('sample_issue', array('sample_issue.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = sample_issue.user_id','left')
                    ->get_where('sample_issue', array('user_details.user_dept' => $module_permission, 'sample_issue.status' => '1'))->result();
            }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}

            $nestedData['sample_name'] = $val->acc_master_name;
            $nestedData['challan_number'] = $val->sample_challan_number;
            $nestedData['issue_date'] = $val->sample_issue_date;
            $uvp = $this->_user_wise_view_permission(39, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/sample-challan-issue-edit/'.$val->sample_issue_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                <a target="_blank" href="'. base_url('admin/sample-challan-issue-print/'.$val->sample_issue_id) .'" class="btn btn-primary"><i class="fa fa-pencil"></i> Print</a>
            <a href="javascript:void(0)" pk-name="sample_issue_id" pk-value="'.$val->sample_issue_id.'" tab="sample_issue" child="1" ref-tab="sample_issue_details" ref-pk-name="sample_issue_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    
    public function sample_challan_issue_print_m($sample_issue_id) {
            // echo $ac_id; 
        $data = array();
        
        $this->db->select('sample_issue.sample_issue_id, sample_issue.am_id, sample_issue.sample_challan_number, DATE_FORMAT(sample_issue.sample_issue_date, "%d-%m-%Y") as sample_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name, acc_master.address');
            $this->db->join('acc_master', 'acc_master.am_id = sample_issue.am_id', 'left');

                $rs = $this->db->get_where('sample_issue', array('sample_issue.sample_issue_id' => $sample_issue_id, 'sample_issue.status => 1'))->result();
                
                $data['sample_issue_details'] = $rs;
                
                $this->db->select('sample_issue_details.sample_issue_detail_id,  sample_issue_details.am_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color');
            $this->db->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left');
            
            $data['sample_issue_details_list'] = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
            
            $data['sample_issue_details1'] = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
            
            $vals = '';
        foreach ($data["sample_issue_details1"] as $cd) {
            $vals .= $cd->am_id . ',';
        }
        $vals = rtrim($vals, ',');

                  $data['result'] = 
                  $this->print_customer_order_consumption_for_sample_issue_details($vals, $sample_issue_id);
            
            return array('page'=>'sample_issue/sample_issue_challan_print_v', 'data'=>$data);
        }
        
        public function print_customer_order_consumption_for_sample_issue_details($vals, $sample_issue_id){
            if($vals == '') {
                echo 'No Details To Show'; die();
            } 
            $query = "SELECT
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
                article_master.am_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                challan_quantity,
                (
                    article_costing_details.quantity * challan_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * challan_quantity
                ) AS final_qnty
            FROM
                `article_master`
            LEFT JOIN article_dtl ON article_dtl.am_id = article_master.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON article_dtl.lth_color_id = c1.c_id
            LEFT JOIN colors c2 ON article_dtl.fit_color_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            LEFT JOIN sample_issue_details ON article_master.am_id = sample_issue_details.am_id AND article_dtl.lth_color_id = sample_issue_details.lc_id
            WHERE
                article_master.`am_id` IN(".$vals.") AND item_groups.`ig_id` != 1 AND item_master.`enlist_jobber` = 1 AND sample_issue_details.`sample_issue_id` = $sample_issue_id AND article_master.status = 1
            GROUP BY
                item_dtl.id_id, article_dtl.lth_color_id
                ORDER BY
                item_groups.group_name, item_master.item";

        $returnResult = $this->db->query($query)->result();
        // echo $this->db->last_query();die;
        return $returnResult;
    }
    
    //Open Add Form
    public function sample_challan_issue_add() {
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1, 'acc_type' => 'Fabricator'))->result();
        
        return array('page'=>'sample_issue/sample_issue_add_v', 'data'=>$data);
    }

    //Add main header info
    public function form_sample_challan_issue_add(){

        $insertArray = array(
            'sample_type' => $this->input->post('sample_type_add'),
            'am_id' => $this->input->post('am_id'),
            'sample_challan_number' => $this->input->post('sample_challan_number'),
            'sample_issue_date' => $this->input->post('sample_issue_date'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('sample_issue', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
        if($this->db->insert_id() > 0){
            $data['type'] = 'success';
            $data['msg'] = 'Sample Issue added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Inserted successfully.';
        }
        return $data;
    }

    public function sample_challan_issue_edit($sample_issue_id) {
        
        $data['account_master_details'] = $this->db->select('am_id, name, short_name, am_code')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
                
        $data['sample_issue_details'] = $this->db->select('sample_issue.sample_issue_id, sample_issue.am_id, sample_issue.sample_challan_number, DATE_FORMAT(sample_issue.sample_issue_date, "%d-%m-%Y") as sample_issue_date, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name')
        ->join('acc_master', 'acc_master.am_id = sample_issue.am_id', 'left')
        ->get_where('sample_issue', array('sample_issue.sample_issue_id' => $sample_issue_id, 'sample_issue.status => 1'))->result();

        $data['article_details'] = $this->db->select('article_master.art_no, article_master.alt_art_no, article_master.am_id, article_master.info, article_dtl.lth_color_id, article_dtl.fit_color_id, article_dtl.ad_id, c1.color as leather_color, c2.color as fitting_color')
        ->join('article_dtl', 'article_dtl.am_id = article_master.am_id', 'left')
        ->join('colors c1', 'c1.c_id = article_dtl.lth_color_id', 'left')
        ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
        ->order_by('article_master.art_no, c1.color')
        ->get_where('article_master', array('article_master.status => 1'))->result();

        $data['color_details'] = $this->db->select('colors.c_id, colors.color')
        ->order_by('colors.color')
        ->get_where('colors', array('colors.status => 1'))->result();
            
        return array('page'=>'sample_issue/sample_issue_edit_v', 'data'=>$data);
    }

    public function form_add_sample_issue_challan_details(){
        $am_id_add = $this->db->get_where('article_dtl', array('ad_id' => $this->input->post('am_id_add')))->row()->am_id;
         $insertArray = array(
            'sample_issue_id' => $this->input->post('sample_challan_id_add'),
            'am_id' => $am_id_add,
            'lc_id' => $this->input->post('lc_id_add'),
            'fc_id' => $this->input->post('fc_id_add'),
            'challan_quantity' => $this->input->post('challan_quantity_add'),
            'sample_emboss' => $this->input->post('sample_emboss_add'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->insert('sample_issue_details', $insertArray);
        $data['insert_id'] = $this->db->insert_id();

        $data['type'] = 'success';
        $data['msg'] = 'Sample challan details added successfully.';
        return $data;
    }

    public function form_edit_sample_issue_challan_details(){
        $insertArray = array(
            'am_id' => $this->input->post('am_id_edit'),
            'lc_id' => $this->input->post('lc_id_edit'),
            'fc_id' => $this->input->post('fc_id_edit'),
            'challan_quantity' => $this->input->post('challan_quantity_edit'),
            'sample_emboss' => $this->input->post('sample_emboss_edit'),
            'user_id' => $this->session->user_id
        );
        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->update('sample_issue_details', $insertArray, array('sample_issue_detail_id' => $this->input->post('sample_challan_id_edit')));

        $data['type'] = 'success';
        $data['msg'] = 'Sample challan details updated successfully.';
        return $data;
    }

    public function del_sample_challan_details_list(){
        
        $tab = $this->input->post('tab');
        $tab_pk = $this->input->post('tab_pk');
        $data_pk = $this->input->post('data_pk');
        $am_id = $this->input->post('am_id');

        // echo '<pre>', print_r($insertArray), '</pre>';die;
        $this->db->where($tab_pk, $data_pk)->delete($tab);

        $data['type'] = 'success';
        $data['msg'] = 'Sample challan details deleted successfully.';
        return $data;
    }

    public function ajax_sample_challan_issue_number(){
        
        $user_id = $this->session->user_id;
        
        $user_dept = $this->db->get_where('user_details', array('user_id' => $user_id))->row()->user_dept;
        
        $am_id = $this->input->post('am_id');
        $sample_type_add = $this->input->post('sample_type_add');
        $data = array();
        
        $rs = $this->db->join( 'user_details', 'user_details.user_id = sample_issue.user_id', 'left' )
                       ->get_where('sample_issue', array('sample_type' => $sample_type_add, 'user_details.user_dept' => $user_dept))->num_rows();
                       
        if($rs == 0) {
        $chalan_number = $rs + 1;
        // echo $this->db->last_query();
        $base_limit = '000';
        $size_chalan = strlen($rs);
        $sob_size_chalan = substr($base_limit, $size_chalan);
        } else {
        $rs_rows_value = $this->db->join( 'user_details', 'user_details.user_id = sample_issue.user_id', 'left' )
                       ->order_by('sample_issue.sample_issue_id', 'desc')
                       ->get_where('sample_issue', array('sample_type' => $sample_type_add, 'user_details.user_dept' => $user_dept))->row()->sample_challan_number;
                       
        $rows_array = explode('/', $rs_rows_value);
        
        $chalan_number = (int)$rows_array[1] + 1;
        // echo $this->db->last_query();
        $base_limit = '000';
        $size_chalan = strlen($rs);
        $sob_size_chalan = substr($base_limit, $size_chalan);
                       
        }
        
        $data['sample_challan_id'] = str_pad($chalan_number, 3, '0', STR_PAD_LEFT);;
        return $data;
    }

    public function ajax_get_article_color_wrt_am_id(){
        $am_id = $this->input->post('am_id');
        $data = $this->db->select('article_dtl.lth_color_id, article_dtl.fit_color_id, c1.color as leather_color, c2.color as fitting_color')
        ->join('colors c1', 'c1.c_id = article_dtl.lth_color_id', 'left')
        ->join('colors c2', 'c2.c_id = article_dtl.fit_color_id', 'left')
        ->get_where('article_dtl', array('article_dtl.ad_id' => $am_id, 'article_dtl.status => 1'))->row();
        return $data;
    }

    public function ajax_fetch_sample_challan_details_on_pk(){
        $sample_issue_detail_id = $this->input->post('sample_issue_detail_id');
        $data = $this->db->select('sample_issue_details.am_id, sample_issue_details.sample_issue_detail_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, c1.color as leather_color, c2.color as fitting_color')
        ->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left')
        ->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left')
        ->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left')
        ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_detail_id' => $sample_issue_detail_id, 'sample_issue_details.status => 1'))->result();
        return $data;
    }

    public function ajax_sample_issue_details_table_data() {
       
       $sample_issue_id = $this->input->post('sample_issue_id');

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
     
        $this->db->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left');     
        $this->db->join('colors c1', 'c1.c_id = sample_issue_details.fc_id', 'left');       
        $this->db->join('colors c2', 'c2.c_id = sample_issue_details.lc_id', 'left');       

        if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_issue_details.user_id','left')
          ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_issue_details.sample_issue_detail_id,  sample_issue_details.am_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color');
            $this->db->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_issue_details.user_id','left')
          ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
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
            $this->db->select('sample_issue_details.sample_issue_detail_id,  sample_issue_details.am_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color');
            $this->db->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_issue_details.user_id','left')
          ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }
            
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('sample_issue_details.sample_issue_detail_id,  sample_issue_details.am_id, sample_issue_details.lc_id, sample_issue_details.fc_id, sample_issue_details.challan_quantity, sample_issue_details.sample_emboss, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c1.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, c2.color as fitting_color');
            $this->db->join('article_master', 'article_master.am_id = sample_issue_details.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = sample_issue_details.lc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = sample_issue_details.fc_id', 'left');
           if($module_permission == 'show'){
            $rs = $this->db->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id))->result();
        } else {
                #module_permission contains the dept id now
          $rs = $this->db->join('user_details','user_details.user_id = sample_issue_details.user_id','left')
          ->get_where('sample_issue_details', array('sample_issue_details.sample_issue_id' => $sample_issue_id, 'user_details.user_dept' => $module_permission))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

       //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['article_number'] = $val->art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['fitting_color'] = $val->fitting_color;
            $nestedData['issue_quantity'] = $val->challan_quantity;
            $nestedData['action'] = '<a href="javascript:void(0)" sample_issue_detail_id="'.$val->sample_issue_detail_id.'" class="sample_issue_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="sample_issue_details" tab-pk="sample_issue_detail_id" am_id="'.$val->am_id.'" data-pk="'.$val->sample_issue_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

}