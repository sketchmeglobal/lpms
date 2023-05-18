<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last updated on 19-03-2021 at 06:00pm
 */

class Skiving_receive_m extends CI_Model {

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
            'comment' => 'skiving receive'
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
                'comment' => 'skiving receive'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function skiving_receive() {
        $data = '';
        $data["view_permission"] = $this->_user_wise_view_permission(8, $this->session->user_id);
        return array('page'=>'skiving_receive/skiving_receive_list_v', 'data'=>$data);
    }
	
	//Main header table list view
    public function ajax_skiving_receive_table_data() {

    // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

        //actual db table column names
        $column_orderable = array(
			0 => 'skiving_receive_challan_number',
            1 => 'skiving_receive_date',
        );
        // Set searchable column fields
        $column_search = array('skiving_receive_challan_number');
		
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];


    if($module_permission == 'show'){
               $rs = $this->db->get('skiving_receive_challan')->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->join('user_details','user_details.user_id = skiving_receive_challan.user_id','left')
        ->get_where('skiving_receive_challan', array('user_details.user_dept' => $module_permission))->result();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        
        

        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
			
            if($module_permission == 'show'){
               $rs = $this->db->get('skiving_receive_challan')->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->join('user_details','user_details.user_id = skiving_receive_challan.user_id','left')
        ->get_where('skiving_receive_challan', array('user_details.user_dept' => $module_permission))->result();
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

            if($module_permission == 'show'){
               $rs = $this->db->get('skiving_receive_challan')->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->join('user_details','user_details.user_id = skiving_receive_challan.user_id','left')
        ->get_where('skiving_receive_challan', array('user_details.user_dept' => $module_permission))->result();
        }

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            if($module_permission == 'show'){
               $rs = $this->db->get('skiving_receive_challan')->result();
        } else {
                #module_permission contains the dept id now
        $rs = $this->db
        ->join('user_details','user_details.user_id = skiving_receive_challan.user_id','left')
        ->get_where('skiving_receive_challan', array('user_details.user_dept' => $module_permission))->result();
        }
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        // echo $this->db->last_query();die;

        foreach ($rs as $val) {
            
            $skv_rcvd_id = $val->skiving_receive_id; 
          $query = "SELECT
    IFNULL(SUM(receive_quantity),
    0) AS cutting_issued_qnty
FROM
    `skiving_receive_challan_details`
WHERE
    skiving_receive_challan_details.skiving_receive_id = $skv_rcvd_id AND skiving_receive_challan_details.status = 1 
    ";
    $skiving_quantity_rcvd_row = $this->db->query($query)->result();


                // echo '<pre>', print_r($skiving_quantity_rcvd_row), '</pre>'; die;
    
             if(count($skiving_quantity_rcvd_row) > 0) {
        $total_skiving_rcvd_quantity = $skiving_quantity_rcvd_row[0]->cutting_issued_qnty;
             } else {
        $skiving_quantity_rcvd_row = '0';
             }

             $temp_co_no = '';
            $skv_received_id = $val->skiving_receive_id;
            $customer_order_row = $this->db->select('customer_order.co_no')
            ->join('customer_order', 'customer_order.co_id = skiving_receive_challan_details.co_id', 'left')
            ->group_by('skiving_receive_challan_details.skiving_receive_id')
            ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skv_received_id, 'skiving_receive_challan_details.status => 1'))->result();
        
        if(count($customer_order_row) > 0) {
        foreach ($customer_order_row as $a) {
            $temp_co_no .= $a->co_no . '</br>';
             }
            }

            $temp_challan_no = '';
            $skv_received_id = $val->skiving_receive_id;
            $challan_order_row = $this->db->select('cutting_received_challan.skiving_issue_number')
            ->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left')
            ->group_by('skiving_receive_challan_details.skiving_receive_id')
            ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skv_received_id, 'skiving_receive_challan_details.status => 1'))->result();
        
        if(count($challan_order_row) > 0) {
        foreach ($challan_order_row as $a) {
            $temp_challan_no .= $a->skiving_issue_number . '</br>';
             }
            }

            $nestedData['co_no'] = $temp_co_no;
            $nestedData['skiving_rceived_quantity'] = $total_skiving_rcvd_quantity;
            $nestedData['skiving_issue_number'] = $temp_challan_no;
			$nestedData['skiving_receive_challan_number'] = $val->skiving_receive_challan_number;
            $nestedData['skiving_receive_date'] = $val->skiving_receive_date;
            $uvp = $this->_user_wise_view_permission(8, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/skiving-receive-edit/'.$val->skiving_receive_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="skiving_receive_id" pk-value="'.$val->skiving_receive_id.'" tab="skiving_receive_challan" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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
    public function skiving_receive_add() {
         // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

        if($module_permission == 'show'){
         $data['skiving_issue_number'] = $this->db->select('cut_rcv_id, skiving_issue_number')->get_where('cutting_received_challan', array('skiving_issue_status' => 1, 'status' => 1))->result();
        } else {
                #module_permission contains the dept id now
            $data['skiving_issue_number'] = $this->db->select('cut_rcv_id, skiving_issue_number')->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
            ->get_where('cutting_received_challan', array('skiving_issue_status' => 1, 'status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
		
        return array('page'=>'skiving_receive/skiving_receive_add_v', 'data'=>$data);
    }
	//Header duplicate checking
    public function ajax_unique_skiving_receive_challan_number(){
        $skiving_receive_challan_number = $this->input->post('skiving_receive_challan_number');

        $rs = $this->db->get_where('skiving_receive_challan', array('skiving_receive_challan_number' => $skiving_receive_challan_number))->num_rows();
        if($rs != '0') {
            $data = 'Skiving Receive challan number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }
	
	//Add main header info
    public function form_skiving_receive_add(){

        $insertArray = array(
            
            'skiving_receive_challan_number' => $this->input->post('skiving_receive_challan_number'),
            'skiving_receive_date' => $this->input->post('skiving_receive_date'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('skiving_receive_challan', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Skiving Receive added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }
	
	//Get data before edit
    public function skiving_receive_edit($skiving_receive_id) {
         // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

        $data['skiving_issue_number'] = array();
        if($module_permission == 'show'){
         $skiving_issue_number_row = $this->db->select('cut_rcv_id, skiving_issue_number')->get_where('cutting_received_challan', array('skiving_issue_status' => 1, 'status' => 1))->result();
        } else {
                #module_permission contains the dept id now
            $skiving_issue_number_row = $this->db->select('cut_rcv_id, skiving_issue_number')->join('user_details','user_details.user_id = cutting_received_challan.user_id','left')
            ->get_where('cutting_received_challan', array('skiving_issue_status' => 1, 'status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        
        if(count($skiving_issue_number_row) > 0) {
        foreach($skiving_issue_number_row as $s_i_n_r) {
            $skiving_issue_sum = $this->db->select_sum('receive_cut_quantity')
              ->group_by('cutting_received_challan_detail.cut_rcv_id')
              ->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.cut_rcv_id' => $s_i_n_r->cut_rcv_id, 'cutting_received_challan_detail.status' => 1))->row();

              $skiving_receive_sum = $this->db->select_sum('receive_quantity')
              ->group_by('skiving_receive_challan_details.skiving_receive_id')
              ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.cut_rcv_id' => $s_i_n_r->cut_rcv_id, 'skiving_receive_challan_details.status' => 1))->row();

          if(count($skiving_receive_sum) > 0) {
              if($skiving_issue_sum->receive_cut_quantity > $skiving_receive_sum->receive_quantity) {
                   
                   $arr = array(
                    'cut_rcv_id'=>$s_i_n_r->cut_rcv_id,
                    'skiving_issue_number' =>$s_i_n_r->skiving_issue_number,
                );
                array_push($data['skiving_issue_number'], $arr);
              }
          } else {
             $arr = array(
                    'cut_rcv_id'=>$s_i_n_r->cut_rcv_id,
                    'skiving_issue_number' =>$s_i_n_r->skiving_issue_number,
                );
                array_push($data['skiving_issue_number'], $arr); 
          }
        }
        }
        
		//$cut_id = $this->input->post('cut_id');
		
		$this->db->select('skiving_receive_challan.cut_rcv_id, cutting_received_challan_detail.cut_rcv_detail_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id');
		$this->db->join('cutting_received_challan_detail', 'cutting_received_challan_detail.cut_rcv_id = skiving_receive_challan.cut_rcv_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
		$this->db->group_by('cutting_received_challan_detail.cod_id');
		$articles = $this->db->get_where('skiving_receive_challan', array('skiving_receive_challan.status' => 1))->result_array();
		//echo $this->db->last_query();die;
		$new_article = array();
		for($i = 0; $i < sizeof($articles); $i++){
			$cut_rcv_id = $articles[$i]['cut_rcv_id'];
			
			$skiving_issue_status = $this->db->select('skiving_issue_status')->get_where('cutting_received_challan', array('cut_rcv_id' => $cut_rcv_id))->result();
			
			// small change - later
			if(isset($skiving_issue_status[0])){
			    $skiving_issue_status = $skiving_issue_status[0]->skiving_issue_status;
			}else{
			    $skiving_issue_status = 0;
			}
			// small change ends- later
			
			if($skiving_issue_status == 1){
				array_push($new_article, $articles[$i]);
			}//end if
			
		}//end for
		$data['articles'] = $new_article;
	//echo json_encode($new_article);die;
		//$data['articles']
			
        $data['skiving_receive_details'] = $this->db
                ->select('skiving_receive_challan.*, DATE_FORMAT(skiving_receive_challan.skiving_receive_date, "%d-%m-%Y") as skiving_receive_date')
                //->join('acc_master', 'acc_master.am_id = cutting_received_challan.am_id', 'left')
                ->get_where('skiving_receive_challan', array('skiving_receive_id' => $skiving_receive_id))
                ->result();
        return array('page'=>'skiving_receive/skiving_receive_edit_v', 'data'=>$data);
    }

	//Header Edit
    public function form_skiving_receive_edit(){

        $old_array = $this->db->get_where('skiving_receive_challan', array('skiving_receive_id' => $this->input->post('skiving_receive_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('skiving_receive_id'), 'skiving_receive_challan');

        $updateArray = array(
            'cut_rcv_id' => $this->input->post('cut_rcv_id'),
            'skiving_receive_challan_number' => $this->input->post('skiving_receive_challan_number'),
            'skiving_receive_date' => $this->input->post('skiving_receive_date'),
            'user_id' => $this->session->user_id
        );
        $skiving_receive_id = $this->input->post('skiving_receive_id');
		
        $this->db->update('skiving_receive_challan', $updateArray, array('skiving_receive_id' => $skiving_receive_id));

        $data['type'] = 'success';
        $data['msg'] = 'Skiving Receive updated successfully.';

        return $data;

    }
	
	public function fetch_all_skiving_issue_article(){
        $cut_rcv_id = $this->input->post('cut_rcv_id');
		
		$this->db->select('cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.cut_rcv_detail_id, cutting_received_challan_detail.am_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.cod_id, customer_order.co_no, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id');
// 		$this->db->join('cutting_received_challan_detail', 'cutting_received_challan_detail.cut_rcv_id = skiving_receive_challan.cut_rcv_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = cutting_received_challan_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = cutting_received_challan_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = cutting_received_challan_detail.fc_id', 'left');
        $this->db->join('colors c2', 'c2.c_id = cutting_received_challan_detail.lc_id', 'left');
// 		$this->db->group_by('cutting_received_challan_detail.cod_id');
		$articles = $this->db->get_where('cutting_received_challan_detail', array('cutting_received_challan_detail.status' => 1, 'cutting_received_challan_detail.cut_rcv_id' => $cut_rcv_id))->result_array();
		//echo $this->db->last_query();die;
		
		$new_article = array();
		for($i = 0; $i < sizeof($articles); $i++){
			$cut_rcv_id = $articles[$i]['cut_rcv_id'];
			
			$skiving_issue_status = $this->db->select('skiving_issue_status')->get_where('cutting_received_challan', array('cut_rcv_id' => $cut_rcv_id))->result();
			
			if(isset($skiving_issue_status[0])){
			    $skiving_issue_status = $skiving_issue_status[0]->skiving_issue_status;
			}else{
			    $skiving_issue_status = 0;
			}
			
			if($skiving_issue_status == 1){
				array_push($new_article, $articles[$i]);
			}//end if
			
		}//end for
		$data['articles'] = $new_article;
		
        return $data;

    }

    public function ajax_skiving_receive_challan_details_table_data() {
       
	   $skiving_receive_id = $this->input->post('skiving_receive_id');

       // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

		//actual db table column names table th order
        $column_orderable = array(
			0 => 'skiving_receive_challan_details.cut_rcv_id',
			1 => 'article_master.art_no'
			// 4 => 'skiving_receive_challan_details.receive_quantity'
        );
        // Set searchable column fields
        $column_search = array('skiving_receive_challan_details.cut_rcv_id', 'article_master.art_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->select('skiving_receive_challan_details.skiving_receive_detail_id,  skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan_details.cut_rcv_id, skiving_receive_challan_details.am_id, skiving_receive_challan_details.fc_id, skiving_receive_challan_details.lc_id, skiving_receive_challan_details.receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, cutting_received_challan.skiving_issue_number');
			$this->db->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = skiving_receive_challan_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = skiving_receive_challan_details.lc_id', 'left');
			$this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left');

        if($module_permission == 'show'){
               $rs = $this->db->order_by('art_no, c2.color')->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id))->result();
        } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = skiving_receive_challan_details.user_id','left')
            ->order_by('art_no, c2.color')
            ->where('skiving_receive_challan_details.skiving_receive_id', $skiving_receive_id)
            ->where('user_details.user_dept', $module_permission)
            ->get('skiving_receive_challan_details')
            ->result();
            // echo $this->db->get_compiled_select();
        }

        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('skiving_receive_challan_details.skiving_receive_detail_id,  skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan_details.cut_rcv_id, skiving_receive_challan_details.am_id, skiving_receive_challan_details.fc_id, skiving_receive_challan_details.lc_id, skiving_receive_challan_details.receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, cutting_received_challan.skiving_issue_number');
			$this->db->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = skiving_receive_challan_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = skiving_receive_challan_details.lc_id', 'left');
			$this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left');
           if($module_permission == 'show'){
               $rs = $this->db->order_by('art_no, c2.color')->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id))->result();
        } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = skiving_receive_challan_details.user_id','left')
            ->order_by('art_no, c2.color')
            ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id, 'user_details.user_dept' => $module_permission))->result();
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

            $this->db->select('skiving_receive_challan_details.skiving_receive_detail_id,  skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan_details.cut_rcv_id, skiving_receive_challan_details.am_id, skiving_receive_challan_details.fc_id, skiving_receive_challan_details.lc_id, skiving_receive_challan_details.receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, cutting_received_challan.skiving_issue_number');
			$this->db->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = skiving_receive_challan_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = skiving_receive_challan_details.lc_id', 'left');
			$this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left');
            if($module_permission == 'show'){
               $rs = $this->db->order_by('art_no, c2.color')->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id))->result();
        } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = skiving_receive_challan_details.user_id','left')
            ->order_by('art_no, c2.color')
            ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id, 'user_details.user_dept' => $module_permission))->result();
        }
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('skiving_receive_challan_details.skiving_receive_detail_id,  skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan_details.cut_rcv_id, skiving_receive_challan_details.am_id, skiving_receive_challan_details.fc_id, skiving_receive_challan_details.lc_id, skiving_receive_challan_details.receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as fitting_code, c1.c_id as fitting_id, c2.color as leather_color, c2.c_code as leather_code, c2.c_id as leather_id, cutting_received_challan.skiving_issue_number');
			$this->db->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left');
			$this->db->join('colors c1', 'c1.c_id = skiving_receive_challan_details.fc_id', 'left');
       		$this->db->join('colors c2', 'c2.c_id = skiving_receive_challan_details.lc_id', 'left');
			$this->db->join('cutting_received_challan', 'cutting_received_challan.cut_rcv_id = skiving_receive_challan_details.cut_rcv_id', 'left');
            if($module_permission == 'show'){
               $rs = $this->db->order_by('art_no, c2.color')->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id))->result();
        } else {
                #module_permission contains the dept id now
            $rs = $this->db
            ->join('user_details','user_details.user_id = skiving_receive_challan_details.user_id','left')
            ->order_by('art_no, c2.color')
            ->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id, 'user_details.user_dept' => $module_permission))->result();
        }

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
			$nestedData['skiving_issue_challan_number'] = $val->skiving_issue_number;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['receive_quantity'] = $val->receive_quantity;
            $nestedData['action'] = '<a href="javascript:void(0)" skiving_receive_detail_id="'.$val->skiving_receive_detail_id.'" class="skiving_receive_challan_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="skiving_receive_challan_details" tab-pk="skiving_receive_detail_id" data-pk="'.$val->skiving_receive_detail_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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

	public function ajax_fetch_skiving_receive_challan_details_on_pk(){
		$skiving_receive_detail_id = $this->input->post('skiving_receive_detail_id');
		$data = array();
		
		$this->db->select('skiving_receive_challan_details.skiving_receive_detail_id,  skiving_receive_challan_details.skiving_receive_id, skiving_receive_challan_details.cut_rcv_id, skiving_receive_challan_details.am_id, skiving_receive_challan_details.fc_id, skiving_receive_challan_details.lc_id, skiving_receive_challan_details.receive_quantity, article_master.art_no, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id');
		$this->db->join('article_master', 'article_master.am_id = skiving_receive_challan_details.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = skiving_receive_challan_details.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = skiving_receive_challan_details.lc_id', 'left');
		$skiving_receive_details = $this->db->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_detail_id' => $skiving_receive_detail_id))->result()[0];
		$data['skiving_receive_details'] = $skiving_receive_details;
		/********************************************************/
		
		$am_id = $skiving_receive_details->am_id;
		$cut_rcv_id = $skiving_receive_details->cut_rcv_id;
		$received_in_cutting = 0;
		$received_in_skiving = 0;
		$remain_receive_quantity_in_skiving = 0;
		$issue_quantity_in_skiving = 0;
				
		$received_in_cutting = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->result()[0]->receive_cut_quantity;
		$issue_quantity_in_skiving = $received_in_cutting;
		
		$num_rows = $this->db->select('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->num_rows();
		if($num_rows > 0){		
			$received_in_skiving = $this->db->select_sum('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->result()[0]->receive_quantity;
		}else{
			$received_in_skiving = 0;
		}
		
		$remain_receive_quantity_in_skiving = ($received_in_cutting - $received_in_skiving);
		
		$data['remain_receive_quantity_in_skiving'] = $remain_receive_quantity_in_skiving;
		$data['issue_quantity_in_skiving'] = $issue_quantity_in_skiving;
		return $data;
	}
	
    public function form_edit_skiving_receive_details(){

        $old_array = $this->db->get_where('skiving_receive_challan_details', array('skiving_receive_detail_id' => $this->input->post('skiving_receive_detail_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('skiving_receive_detail_id'), 'skiving_receive_challan_details');

		$skiving_receive_detail_id = $this->input->post('skiving_receive_detail_id');
		$receive_quantity_edit = $this->input->post('receive_quantity_edit');
		
        $updateArray = array(
            'receive_quantity' => $receive_quantity_edit,
            'user_id' => $this->session->user_id
        );
		
		
        $this->db->update('skiving_receive_challan_details', $updateArray, array('skiving_receive_detail_id' => $skiving_receive_detail_id));
		$data['type'] = 'success';
        $data['msg'] = 'Skiving challan details updated successfully.';
        return $data;
	}
    
	
	
	public function get_customer_order_dtl_cutting_receive(){
        $co_id = $this->input->post('co_id');
		$data = array();
		
		$buyer_reference_no = $this->db->select('buyer_reference_no')->get_where('customer_order', array('co_id' => $co_id))->result()[0]->buyer_reference_no;
		
		$data['buyer_reference_no'] = $buyer_reference_no;
		
		$this->db->select('cutting_issue_challan.cut_id, cutting_issue_challan.cut_number');
		$this->db->join('cutting_issue_challan', 'cutting_issue_challan.cut_id = cutting_issue_challan_details.cut_id', 'left');
		$this->db->group_by('cutting_issue_challan_details.co_id');
		$challans = $this->db->get_where('cutting_issue_challan_details', array('cutting_issue_challan_details.co_id' => $co_id))->result();
		$data['challans'] = $challans;
			
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
	
	public function ajax_cutting_receive_quantity_and_article_detail(){
        $am_id = $this->input->post('am_id');
		$cut_rcv_id = $this->input->post('cut_rcv_id');
		//$cut_recieve_id = $this->input->post('cut_recieve_id');
		$cod_id = $this->input->post('cod_id');
	    $lc_id = $this->input->post('lc_id');
		
		$received_in_cutting = 0;
		$received_in_skiving = 0;
		$remain_receive_quantity_in_skiving = 0;
		$issue_quantity_in_skiving = 0;
		
		$data = array();
		
		$received_in_cutting = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cut_rcv_id' => $cut_rcv_id, 'cod_id' => $cod_id, 'am_id' => $am_id, 'lc_id' => $lc_id))->result()[0]->receive_cut_quantity;
        
	    $issue_quantity_in_skiving = $received_in_cutting;

	    $num_rows = $this->db->select('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id, 'cod_id' => $cod_id, 'lc_id' => $lc_id))->num_rows();
		if($num_rows > 0){		
			$received_in_skiving = $this->db->select_sum('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id, 'cod_id' => $cod_id, 'lc_id' => $lc_id))->result()[0]->receive_quantity;
		}else{
			$received_in_skiving = 0;
		}
		
		$remain_receive_quantity_in_skiving = ($received_in_cutting - $received_in_skiving);
		
		$data['remain_receive_quantity_in_skiving'] = $remain_receive_quantity_in_skiving;
		$data['issue_quantity_in_skiving'] = $issue_quantity_in_skiving;
		
		
		
		return $data;
    }
	
	/*public function ajax_cutting_receive_quantity_and_article_detail_edit(){
        $am_id = $this->input->post('am_id');
		$cut_rcv_id = $this->input->post('cut_rcv_id');
		$received_in_cutting = 0;
		$received_in_skiving = 0;
		$remain_receive_quantity_in_skiving = 0;
		$issue_quantity_in_skiving = 0;
		
		$data = array();
		
		$received_in_cutting = $this->db->select_sum('receive_cut_quantity')->get_where('cutting_received_challan_detail', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->result()[0]->receive_cut_quantity;
		$issue_quantity_in_skiving = $received_in_cutting;
		
		$num_rows = $this->db->select('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->num_rows();
		if($num_rows > 0){		
			$received_in_skiving = $this->db->select_sum('receive_quantity')->get_where('skiving_receive_challan_details', array('cut_rcv_id' => $cut_rcv_id, 'am_id' => $am_id))->result()[0]->receive_quantity;
		}else{
			$received_in_skiving = 0;
		}
		
		$remain_receive_quantity_in_skiving = ($received_in_cutting - $received_in_skiving);
		
		$data['remain_receive_quantity_in_skiving'] = $remain_receive_quantity_in_skiving;
		$data['issue_quantity_in_skiving'] = $issue_quantity_in_skiving;
		
		return $data;
    }*/
	
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
	
    public function form_add_skiving_receive_challan_details(){
        
		$skiving_receive_id = $this->input->post('skiving_receive_id');
        $cut_rcv_id = $this->input->post('cut_rcv_id');
		$am_id = $this->input->post('am_id_add');
		$fc_id = $this->input->post('fc_id');			
		$lc_id = $this->input->post('lc_id');
		$receive_quantity = $this->input->post('receive_quantity_add');
		$co_id = $this->input->post('co_id');
		$cod_id = $this->input->post('cod_id');

        $rs = $this->db->get_where('skiving_receive_challan_details', array('skiving_receive_challan_details.skiving_receive_id' => $skiving_receive_id, 'skiving_receive_challan_details.cut_rcv_id' => $cut_rcv_id, 'skiving_receive_challan_details.cod_id' => $cod_id, 'skiving_receive_challan_details.am_id' => $am_id, 'skiving_receive_challan_details.lc_id' => $lc_id, 'skiving_receive_challan_details.receive_quantity' => $receive_quantity))->num_rows();

if($rs == 0) {		
		$insertArray = array(
			'skiving_receive_id' => $skiving_receive_id,
			'cut_rcv_id' => $cut_rcv_id,
			'co_id' => $co_id,
			'cod_id' => $cod_id,
			'am_id' => $am_id,
			'fc_id' => $fc_id,
			'lc_id' => $lc_id,
			'receive_quantity' => $receive_quantity,
			'user_id' => $this->session->user_id
		);
		$this->db->insert('skiving_receive_challan_details', $insertArray);
		$insert_id = $this->db->insert_id();
		
		$data['insert_id'] = $insert_id;
}
        
		if($insert_id > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Skiving Receive Challan Details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
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
	
	//Delete Header Table data
    public function skiving_receive_challan_delete(){
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
		
		$this->db->where($pk_name, $pk_value)->delete('skiving_receive_challan_details');
		
        $this->db->where($pk_name, $pk_value)->delete($tab);
		
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Skiving Receive Successfully Deleted';
        return $data;
    }
	
	public function skiving_receive_challan_details_list_delete(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');

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
		
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Skiving challan detail list deleted successfully';
        return $data;
    }
    // purchase ORDER ENDS 

}