<?php


class Office_proforma_m extends CI_Model {

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
            'comment' => 'office proforma'
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
                'comment' => 'office proforma'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function office_proforma() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(14, $this->session->user_id);
        return array('page'=>'office_proforma/office_proforma_list_v', 'data'=>$data);
    }

    public function ajax_office_proforma_table_data() {
        //actual db table column names
        $column_orderable = array(
            0 => 'office_proforma.proforma_number',
            1 => 'office_proforma.proforma_date',
            2 => 'customer_order.co_no',
            4 => 'office_proforma.total_quantity',
            5 => 'office_proforma.total_value',
        );
        // Set searchable column fields
        $column_search = array('office_proforma.proforma_number','office_proforma.proforma_date', 'customer_order.co_no', 'office_proforma.total_quantity','office_proforma.total_value');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('office_proforma')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
           $this->db->select('office_proforma.office_proforma_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.total_value,acc_master.name, GROUP_CONCAT(
        DISTINCT customer_order.co_no
    ) AS show_main_co_no');
            $this->db->join('acc_master', 'acc_master.am_id = office_proforma.buyer_id', 'left');
            $this->db->join('office_proforma_detail', 'office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
            $rs = $this->db->group_by('office_proforma.office_proforma_id')->get_where('office_proforma', array('office_proforma.status => 1'))->result();
    
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

            $this->db->select('office_proforma.office_proforma_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.total_value,acc_master.name, GROUP_CONCAT(
        DISTINCT customer_order.co_no
    ) AS show_main_co_no');
            $this->db->join('acc_master', 'acc_master.am_id = office_proforma.buyer_id', 'left');
            $this->db->join('office_proforma_detail', 'office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
            $rs = $this->db->group_by('office_proforma.office_proforma_id')->get_where('office_proforma', array('office_proforma.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
           $this->db->select('office_proforma.office_proforma_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.total_value,acc_master.name, GROUP_CONCAT(
        DISTINCT customer_order.co_no
    ) AS show_main_co_no');
            $this->db->join('acc_master', 'acc_master.am_id = office_proforma.buyer_id', 'left');
            $this->db->join('office_proforma_detail', 'office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id', 'left');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
            $rs = $this->db->group_by('office_proforma.office_proforma_id')->get_where('office_proforma', array('office_proforma.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
            $office_proforma_id = $val->office_proforma_id;
            $order_number_list = '';
            
            $this->db->select('office_proforma_detail.co_id, customer_order.co_no');
            $this->db->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left');
            $this->db->group_by('office_proforma_detail.co_id');
            $all_order_numbers = $this->db->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->result_array();
            
            foreach($all_order_numbers as $all_order_number){
                $order_number_list .= $all_order_number['co_no']."<br />";
            }//end for each
            //print_r($all_order_number);die;
            
            if($val->rate_type == 1){
                $rtype = 'Ex-works';
            }elseif($val->rate_type == 2){
                $rtype = 'CNF/CIF';
            }else{
                $rtype = 'FOB';    
            }
            
            $this->db->select('*');
            $proforma_numrows = $this->db->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->num_rows();
            
            if($proforma_numrows > 0) {
            $this->db->select('SUM(co_quantity)as co_quantity');
            $proforma_values = $this->db->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->row();
            $totals_co_quantity = $proforma_values->co_quantity;
            
            $this->db->select('SUM(total_rate)as total_rate');
            $proforma_values = $this->db->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->row();
            $totals_rate = $proforma_values->total_rate;
            } else {
            $totals_rate = 0;
            $totals_co_quantity = 0;
            }

            $nestedData['proforma_number'] = $val->proforma_number;
            $nestedData['date'] = $val->proforma_date;
            $nestedData['order_number'] = $val->show_main_co_no;
            $nestedData['buyer_name'] = $val->name;
            $nestedData['rate_type'] =  $rtype;
            $nestedData['quantity'] = $totals_co_quantity;
            $nestedData['total'] = $totals_rate;
            
            $uvp = $this->_user_wise_view_permission(14, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/edit-office-proforma/'.$val->office_proforma_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>

            <a target="_blank" href="'. base_url('admin/print-office-proforma/'.$val->office_proforma_id) .'" class="btn btn-primary" style="padding:6px"><i class="fa fa-print"></i> Print </a>
            
            <a href="javascript:void(0)" pk-name="office_proforma_id" pk-value="'.$val->office_proforma_id.'" tab="office_proforma" child="1" ref-table="office_proforma_detail" ref-pk-name="office_proforma_id" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function print_office_proforma_m($pro_id) {
        
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 6, 'user_id' => $this->session->user_id))->result(); # 6 = Office Proforma
        
           // echo $ac_id; 
            $data['proforma'] = $this->db->select('office_proforma.office_proforma_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.total_value,ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2')
            ->join('acc_master ac1', 'ac1.am_id = office_proforma.buyer_id', 'left')
            ->join('acc_master ac2', 'ac2.am_id = office_proforma.am_id_other', 'left')
            ->get_where('office_proforma', array('office_proforma.office_proforma_id' => $pro_id))->row();

            $data['proforma_details'] = $this->db->select('office_proforma.office_proforma_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.total_value,acc_master.name as acc_name, acc_master.address as acc_address, office_proforma.desc_of_goods, countries.country as country_name, office_proforma_detail.office_proforma_detail_id, office_proforma_detail.office_proforma_id, office_proforma_detail.co_id, office_proforma_detail.cod_id, office_proforma_detail.am_id, office_proforma_detail.fc_id, office_proforma_detail.lc_id, office_proforma_detail.co_quantity as op_co_quantity, office_proforma_detail.rate_inr, office_proforma_detail.rate_foreign, office_proforma_detail.total_rate, customer_order.co_no,customer_order.co_date, customer_order.co_remarks,customer_order.buyer_reference_no, customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no, currencies.currency, currencies.info as curr_info')
            ->join('office_proforma', 'office_proforma.office_proforma_id = office_proforma_detail.office_proforma_id', 'left')
            ->join('acc_master', 'acc_master.am_id = office_proforma.buyer_id', 'left')
            ->join('countries', 'countries.c_id = acc_master.c_id', 'left')
            // ->join('currencies', 'currencies.c_id = countries.c_id', 'left') #sayak changed here
            ->join('currencies', 'currencies.cur_id = office_proforma.cur_id', 'left')
            ->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left')
            ->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left')
            ->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left')
            ->join('colors c1', 'c1.c_id = office_proforma_detail.fc_id', 'left')
            ->join('colors c2', 'c2.c_id = office_proforma_detail.lc_id', 'left')
            ->order_by('print_order, art_no, leather_color')->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $pro_id))->result();

                            // echo '<pre>', print_r($data), '</pre>'; 
                            // echo $this->db->last_query(); die;
            return array('page'=>'office_proforma/office_proforma_print_v', 'data'=>$data);
        } 

	// ADD supp.purchase ORDER 

    public function office_proforma_add() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name, cur_id')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        $data['currency_list'] = $this->db->select('cur_id, currency')->get_where('currencies', array('currencies.status' => 1))->result();
        return array('page'=>'office_proforma/office_proforma_add_v', 'data'=>$data);
    }

    public function ajax_unique_proforma_number(){
        $proforma_number = $this->input->post('proforma_number');
        $proforma_id = $this->input->post('proforma_id');

        $rs = $this->db
            ->where_not_in('office_proforma_id', $proforma_id)
            ->get_where('office_proforma', array('proforma_number' => $proforma_number))->num_rows();
        if($rs != '0') {
            $data = 'Proforma Number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function form_office_proforma_add(){

        $insertArray = array(
            'proforma_number' => $this->input->post('proforma_number'),
            'proforma_date' => $this->input->post('proforma_date'),
            'buyer_id' => $this->input->post('buyer'),
            'cur_id' => $this->input->post('currency'),
            'rate_type' => $this->input->post('rate_type'),
            'notify' => $this->input->post('notify'),
            'terms_condition' => $this->input->post('terms_condition'),
            'am_id_other' => $this->input->post('am_id_other'),
            'desc_of_goods' => $this->input->post('desc_of_goods'),
            'user_id' => $this->session->user_id
        );

        // echo '<pre>', print_r($insertArray), '</pre>';die;

        $this->db->insert('office_proforma', $insertArray);
        $data['insert_id'] = $this->db->insert_id();
		if($this->db->insert_id() > 0){
			$data['type'] = 'success';
			$data['msg'] = 'Office Proforma added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted successfully.';
		}
        return $data;
    }

    public function edit_office_proform($office_proforma_id) {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name, cur_id')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
		
        $data['office_proforma_detail'] = $this->db->select('office_proforma.office_proforma_id, office_proforma.buyer_id, office_proforma.proforma_number, DATE_FORMAT(office_proforma.proforma_date, "%d-%m-%Y") as proforma_date, office_proforma.rate_type, office_proforma.exworks_office, office_proforma.cf_office, office_proforma.fob_office, office_proforma.notify, office_proforma.terms_condition, office_proforma.desc_of_goods, office_proforma.total_quantity, office_proforma.am_id_other, office_proforma.total_value, office_proforma.cur_id')
        ->get_where('office_proforma', array('office_proforma.status => 1', 'office_proforma_id' => $office_proforma_id))->result();

		$data['customer_order'] = $this->db->select('co_id, co_no')->get_where('customer_order', array( 'customer_order.status' => 1, 'customer_order.office_proforma_status' => 0, 'acc_master_id' => $data['office_proforma_detail'][0]->buyer_id))->result();

        $data['co_quantity'] = $this->db->select_sum('co_quantity')->get_where('office_proforma_detail',array('office_proforma.status => 1', 'office_proforma_id' => $office_proforma_id))->result()[0]->co_quantity;

        $data['total_rate'] = $this->db->select_sum('total_rate')->get_where('office_proforma_detail',array('office_proforma.status => 1', 'office_proforma_id' => $office_proforma_id))->result()[0]->total_rate;               

        $data['currency_list'] = $this->db->select('cur_id, currency')->get_where('currencies', array('currencies.status' => 1))->result();
        
        $this->db->select('print_order, office_proforma_detail.office_proforma_detail_id, office_proforma_detail.office_proforma_id, office_proforma_detail.co_id, office_proforma_detail.cod_id, office_proforma_detail.am_id, office_proforma_detail.fc_id, office_proforma_detail.lc_id, office_proforma_detail.co_quantity as op_co_quantity, office_proforma_detail.rate_inr, office_proforma_detail.rate_foreign, office_proforma_detail.total_rate, customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
            $this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left'); 
            $this->db->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left');
            $this->db->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = office_proforma_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = office_proforma_detail.lc_id', 'left');
            $data['office_invoice_edit_details'] = $this->db->order_by('print_order, art_no, leather_color')->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->result();
        
        return array('page'=>'office_proforma/office_proforma_edit_v', 'data'=>$data);
    }

    public function form_edit_office_proform(){

        $old_array = $this->db->get_where('office_proforma', array('office_proforma_id' => $this->input->post('office_proforma_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('office_proforma_id'), 'office_proforma');

        $updateArray = array(
            'proforma_number' => $this->input->post('proforma_number'),
            'proforma_date' => $this->input->post('proforma_date'),
            'buyer_id' => $this->input->post('buyer'),
            'cur_id' => $this->input->post('currency'),
            'rate_type' => $this->input->post('rate_type'),
			'terms_condition' => $this->input->post('terms_condition'),
			'notify' => $this->input->post('notify'),
			'desc_of_goods' => $this->input->post('desc_of_goods'),
			'total_quantity' => $this->input->post('total_quantity'),
			'am_id_other' => $this->input->post('am_id_other'),
            'total_value' => $this->input->post('total_value'),
            'user_id' => $this->session->user_id
        );
        $office_proforma_id = $this->input->post('office_proforma_id');
		
        $this->db->update('office_proforma', $updateArray, array('office_proforma_id' => $office_proforma_id));

        $data['type'] = 'success';
        $data['msg'] = 'Office Proforma updated successfully.';

        return $data;

    }

    public function form_edit_proforma_details(){
        $updateArray = array(
            'rate_foreign' => $this->input->post('rate_foreign_edit'),
            'total_rate' => $this->input->post('quantity_edit') * $this->input->post('rate_foreign_edit'),
            'user_id' => $this->session->user_id
        );
        $office_proforma_detail_id = $this->input->post('office_proforma_detail_id');
        
        $this->db->update('office_proforma_detail', $updateArray, array('office_proforma_detail_id' => $office_proforma_detail_id));
        // echo $this->db->last_query();

        $data['type'] = 'success';
        $data['msg'] = 'Office proforma updated successfully.';

        return $data;

    }

    public function office_proforma_details_table() {
        $office_proforma_id = $this->input->post('office_proforma_id');
		//actual db table column names table th order
        $column_orderable = array(
			0 => 'customer_order.co_no',
            1 => 'article_master.art_no',
            2 => 'article_master.info',
            5 => 'office_proforma_detail.co_quantity',
            6 => 'office_proforma_detail.rate_inr',
            7 => 'office_proforma_detail.rate_foreign',
            8 => 'office_proforma_detail.total_rate'
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no','article_master.art_no','article_master.info','office_proforma_detail.co_quantity','office_proforma_detail.rate_inr','office_proforma_detail.rate_foreign','office_proforma_detail.total_rate');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('office_proforma_detail', array('office_proforma_id' => $office_proforma_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_proforma_detail.office_proforma_detail_id, office_proforma_detail.office_proforma_id, office_proforma_detail.co_id, office_proforma_detail.cod_id, office_proforma_detail.am_id, office_proforma_detail.fc_id, office_proforma_detail.lc_id, office_proforma_detail.co_quantity as op_co_quantity, office_proforma_detail.rate_inr, office_proforma_detail.rate_foreign, office_proforma_detail.total_rate, customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = office_proforma_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = office_proforma_detail.lc_id', 'left');
            $rs = $this->db->order_by('art_no, leather_color')->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->result();
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

            $this->db->select('office_proforma_detail.office_proforma_detail_id, office_proforma_detail.office_proforma_id, office_proforma_detail.co_id, office_proforma_detail.cod_id, office_proforma_detail.am_id, office_proforma_detail.fc_id, office_proforma_detail.lc_id, office_proforma_detail.co_quantity as op_co_quantity, office_proforma_detail.rate_inr, office_proforma_detail.rate_foreign, office_proforma_detail.total_rate, customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = office_proforma_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = office_proforma_detail.lc_id', 'left');
            $rs = $this->db->order_by('art_no, leather_color')->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->result();        

            // echo $this->db->last_query();
            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_proforma_detail.office_proforma_detail_id, office_proforma_detail.office_proforma_id, office_proforma_detail.co_id, office_proforma_detail.cod_id, office_proforma_detail.am_id, office_proforma_detail.fc_id, office_proforma_detail.lc_id, office_proforma_detail.co_quantity as op_co_quantity, office_proforma_detail.rate_inr, office_proforma_detail.rate_foreign, office_proforma_detail.total_rate, customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
			$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = office_proforma_detail.cod_id', 'left');	
            $this->db->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = office_proforma_detail.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = office_proforma_detail.lc_id', 'left');
            $rs = $this->db->order_by('art_no, leather_color')->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo $this->db->last_query();
        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['customer_order'] = $val->co_no;
			$nestedData['article_number'] = $val->art_no;
			$nestedData['article_description'] = $val->info;
			$nestedData['leather_color'] = $val->leather_color;
			$nestedData['fitting_color'] = $val->fitting_color;
			$nestedData['co_quantity'] = $val->op_co_quantity;
			$nestedData['rate_inr'] = $val->rate_inr;
			$nestedData['rate_foreign'] = $val->rate_foreign;
            $nestedData['total_rate'] = $val->total_rate;
//             $nestedData['action'] = '<a href="javascript:void(0)" office_proforma_detail_id="'.$val->office_proforma_detail_id.'" class="office_proforma_detail_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
//             <!--<a disabled tab="office_proforma_detail" tab-pk="office_proforma_detail_id" 
// 			tab-val="'.$val->office_proforma_detail_id.'" data-tab="office_proforma" data-pk="office_proforma_id" data-tab-val="'.$val->office_proforma_id.'" co_id="'.$val->co_id.'" co_quantity="'.$val->op_co_quantity.'" total_rate="'.$val->total_rate.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a> -->';
            
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
    
	public function Office_proforma_get_customer_order_dtl(){
        $co_id = $this->input->post('co_id');
		$rate_type = $this->input->post('rate_type');
		
        $this->db->select('customer_order.co_no,customer_order.co_date,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.alt_art_no, article_master.info');
            $this->db->join('customer_order', 'customer_order.co_id = customer_order_dtl.co_id', 'left');
			$this->db->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = customer_order_dtl.lc_id', 'left');
            $rs = $this->db->get_where('customer_order_dtl', array('customer_order_dtl.co_id' => $co_id, 'customer_order_dtl.proforma_status' => 0))->result();
			
            // echo $this->db->last_query();

			for($i = 0; $i < sizeof($rs); $i++){
				$cod_id = 0;
				$am_id = 0;
				$co_quantity = 0;
				$co_quantity_temp = 0;
				$remaining_co_quantity = 0;
				$rate_inr = 0;
				$rate_foreign = 0;
				$total_rate = 0;
				
				$rs[$i]->rate_inr = $rate_inr;
				
				$cod_id = $rs[$i]->cod_id;
				$am_id = $rs[$i]->am_id;
				$co_quantity = $rs[$i]->co_quantity;
				
				$co_quantity_temp = $this->db->select_sum('co_quantity')->get_where('office_proforma_detail', array('cod_id' => $cod_id, 'am_id' => $am_id))->result()[0]->co_quantity;				
				$remaining_co_quantity = ($co_quantity - $co_quantity_temp);				
				$rs[$i]->remaining_co_quantity = $remaining_co_quantity;
				
				
				$query = "SELECT * FROM article_rates_office_use WHERE `date`=(SELECT MAX(`date`) FROM article_rates_office_use WHERE `am_id`= $am_id) AND `am_id`= $am_id";
				$query1 = $this->db->query($query)->result();
				
                // echo $this->db->last_query();
                // echo '<pre>', print_r($query1), '</pre>';

                if(isset($query1[0])){
                    $exworks_final = $query1[0]->exworks_final;
                    $cf_final = $query1[0]->cf_final;
                    $fob_final = $query1[0]->fob_final;
                }else{
                    $exworks_final = 0;
                    $cf_final = 0;
                    $fob_final = 0;
                }
				
				
				if($rate_type == 1){
					$rs[$i]->rate_foreign = $exworks_final;
					$total_rate = $remaining_co_quantity * $exworks_final;
				}
				if($rate_type == 2){
					$rs[$i]->rate_foreign = $cf_final;
					$total_rate = $remaining_co_quantity * $cf_final;
				}
				if($rate_type == 3){
					$rs[$i]->rate_foreign = $fob_final;
					$total_rate = $remaining_co_quantity * $fob_final;
				}
				$rs[$i]->total_rate = $total_rate;				
				 
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
	
    public function form_add_office_proforma_details(){
		$office_proforma_id = $this->input->post('office_proforma_id');
		$co_id = $this->input->post('co_id');		
		$cod_id = $this->input->post('cod_id');
		$am_id = $this->input->post('am_id');
		$fc_id = $this->input->post('fc_id');
		$lc_id = $this->input->post('lc_id');		
		$co_quantity = $this->input->post('co_quantity');		
		$rate_inr = $this->input->post('rate_inr');
		$rate_foreign = $this->input->post('rate_foreign');
		$total_rate = $this->input->post('total_rate');
		$print_order = $this->input->post('print_order');
		
		$total_quantity = 0;
		$total_value = 0;
		
		$total_quantity = $this->db->select('total_quantity')->get_where('office_proforma', array('office_proforma_id' => $office_proforma_id))->result();
        if(isset($total_quantity[0])){
            $total_quantity = $total_quantity[0]->total_quantity;
        }else{
            $total_quantity = 0;
        }

		$total_value = $this->db->select('total_value')->get_where('office_proforma', array('office_proforma_id' => $office_proforma_id))->result();
		if(isset($total_value[0])){
            $total_value = $total_value[0]->total_value;
        }else{
            $total_value = 0;
        }

		for($i = 0; $i < sizeof($cod_id); $i++){
			$total_quantity = $total_quantity + $co_quantity[$i];
			$total_value = $total_value + $total_rate[$i];
			
			$rs = $this->db->get_where('office_proforma_detail', array('office_proforma_detail.office_proforma_id' => $office_proforma_id, 'office_proforma_detail.co_id' => $co_id[$i],
			'office_proforma_detail.cod_id' => $cod_id[$i], 'office_proforma_detail.am_id' => $am_id[$i], 'office_proforma_detail.fc_id' => $fc_id[$i], 'office_proforma_detail.lc_id' => $lc_id[$i],
			'office_proforma_detail.co_quantity' => $co_quantity[$i], 'office_proforma_detail.rate_inr' => $rate_inr[$i], 'office_proforma_detail.rate_foreign' => $rate_foreign[$i],
			'office_proforma_detail.total_rate' => $total_rate[$i]))->num_rows();
			
			if($rs == 0) {
			
			$insertArray = array(
				'office_proforma_id' => $office_proforma_id,
				'co_id' => $co_id[$i],
				'cod_id' => $cod_id[$i],
				'am_id' => $am_id[$i],
				'fc_id' => $fc_id[$i],
				'lc_id' => $lc_id[$i],
				'co_quantity' => $co_quantity[$i],
				'rate_inr' => $rate_inr[$i],
				'rate_foreign' => $rate_foreign[$i],
				'total_rate' => $total_rate[$i],
				'print_order' => $print_order[$i],
				'user_id' => $this->session->user_id
			);
			$this->db->insert('office_proforma_detail', $insertArray);
			$insert_id = $this->db->insert_id();
			}
			
		}//end for
		$data['insert_id'] = $insert_id;
		
		if($insert_id > 0){
		
		$updateArray = array(
			'total_quantity' => $total_quantity,
			'total_value' => $total_value
		);
		$this->db->update('office_proforma', $updateArray, array('office_proforma_id' => $office_proforma_id));
		
		//office proforma status update
		$co_id1 = $co_id[0];
		$office_proforma_status = 1;
		$updateArray = array(
			'office_proforma_status' => $office_proforma_status,
		);
		$this->db->update('customer_order', $updateArray, array('co_id' => $co_id1));
		
		$proforma_status = 1;
		$updateArray = array(
			'proforma_status' => $proforma_status,
		);
		$this->db->update('customer_order_dtl', $updateArray, array('co_id' => $co_id1));
				
			$data['type'] = 'success';
			$data['total_quantity'] = $total_quantity;
			$data['total_value'] = $total_value;
			$data['msg'] = 'Office proforma details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Not Inserted.';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }
    
    public function ajax_customer_order_details_table_data_order_changes() {
        $office_proforma_id = $this->input->post('office_proforma_id');
        $rs = $this->db->group_by('co_id')->get_where('office_proforma_detail', array('office_proforma_id' => $office_proforma_id))->result();
        $co_id_array = [];
        if(count($rs) > 0) {
        foreach($rs as $r) {
        array_push($co_id_array, $r->co_id);
        }
        }else {
        $co_id_array = array(0);    
        }
        //actual db table column names
        $column_orderable = array(
            0 => 'temp_customer_order_dtl.lc_id'
        );
        // Set searchable column fields
        $column_search = array('temp_customer_order_dtl.co_buy_reference');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->where_in('co_id', $co_id_array)->get('temp_customer_order_dtl')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_customer_order_dtl.cod_id, temp_customer_order_dtl.co_quantity,temp_customer_order_dtl.comment,temp_customer_order_dtl.co_price,temp_customer_order_dtl.co_buy_reference,temp_customer_order_dtl.co_remarks,temp_customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = temp_customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = temp_customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = temp_customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, temp_customer_order_dtl.lc_id asc')->where_in('co_id', $co_id_array)->get('temp_customer_order_dtl')->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
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

            $this->db->select('temp_customer_order_dtl.cod_id, temp_customer_order_dtl.co_quantity,temp_customer_order_dtl.comment,temp_customer_order_dtl.co_price,temp_customer_order_dtl.co_buy_reference,temp_customer_order_dtl.co_remarks,temp_customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = temp_customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = temp_customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = temp_customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, temp_customer_order_dtl.lc_id asc')->where_in('co_id', $co_id_array)->get('temp_customer_order_dtl')->result();
            // echo $this->db->get_compiled_select('customer_order_dtl');
            // exit();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('temp_customer_order_dtl.cod_id, temp_customer_order_dtl.co_quantity,temp_customer_order_dtl.comment,temp_customer_order_dtl.co_price,temp_customer_order_dtl.co_buy_reference,temp_customer_order_dtl.co_remarks,temp_customer_order_dtl.proforma_status, 
                c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, 
                c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id,
                article_master.art_no, article_master.alt_art_no');
            $this->db->join('article_master', 'article_master.am_id = temp_customer_order_dtl.am_id', 'left');
            $this->db->join('colors c1', 'c1.c_id = temp_customer_order_dtl.fc_id', 'left');
            $this->db->join('colors c2', 'c2.c_id = temp_customer_order_dtl.lc_id', 'left');
            $rs = $this->db->order_by('article_master.art_no asc, temp_customer_order_dtl.lc_id asc')->where_in('co_id', $co_id_array)->get('temp_customer_order_dtl')->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {

            $article = $val->art_no;
            $nestedData['co_no'] = ' ';
            $nestedData['art_no'] = $article;
            $nestedData['comment'] = $val->comment;
            $nestedData['lc_id'] = $val->leather_color;
            $nestedData['fc_id'] = $val->fitting_color;
            $nestedData['co_quantity'] = $val->co_quantity;
            $nestedData['co_price'] = $val->co_price;
            $nestedData['amount'] = $val->co_quantity * $val->co_price;
            $nestedData['co_buy_reference'] = ($val->co_buy_reference == '') ? '-' : $val->co_buy_reference;

            
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
    
    public function ajax_fetch_proforma_details_on_pk(){
        return $this->db
            ->select('office_proforma_detail.*, customer_order.co_no, article_master.art_no')
            ->join('customer_order', 'customer_order.co_id = office_proforma_detail.co_id', 'left')
            ->join('article_master', 'article_master.am_id = office_proforma_detail.am_id', 'left')
            ->get_where('office_proforma_detail', array('office_proforma_detail_id' => $this->input->post('office_proforma_detail_id')))->result();
    }

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

    public function delete_office_proforma_header_list(){
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

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

        // update customer order table
        $co = $this->db
            ->query("SELECT group_concat(DISTINCT co_id) as co_id FROM `office_proforma_detail` where office_proforma_id = $pk_value group by office_proforma_id")->result();

        if(isset($co[0])){
            $co = $co[0]->co_id;
            $updateArray = array(
                'office_proforma_status' => 0  
            );
             $updateArray_co_dtl = array(
                'proforma_status' => 0  
            );

            $this->db
                ->where_in('co_id', $co)
                ->update('customer_order', $updateArray);
            $this->db
                ->where_in('co_id', $co)
                ->update('customer_order_dtl', $updateArray_co_dtl);    
        }    
        
        // echo $this->db->last_query();die;    

		$this->db->where('office_proforma_id', $pk_value)->delete('office_proforma_detail');
        $this->db->where('office_proforma_id', $pk_value)->delete('office_proforma');

        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Office proforma Successfully Deleted';
        $data['msg'] .= '<hr />Customer order updated';
        return $data;
    }
	
	public function del_office_proforma_details_list(){
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$tab_val = $this->input->post('tab_val');
		
		$data_tab = $this->input->post('data_tab');
		$data_pk = $this->input->post('data_pk');
		$data_tab_val = $this->input->post('data_tab_val');
		
		$total_quantity = 0;
		$total_value = 0;
		
		$co_quantity_temp = $this->input->post('co_quantity');
		$total_rate_temp = $this->input->post('total_rate');
		
		$co_id = $this->input->post('co_id');
		$co_quantity = 0;
		$total_rate = 0;
		
		
		$office_proforma_detail = $this->db->get_where('office_proforma_detail', array('office_proforma_detail_id'=> $tab_val))->row();
		
		
		$total_quantity = $this->db->select('total_quantity')->get_where('office_proforma', array('office_proforma_id' => $data_tab_val))->result()[0]->total_quantity;
		$total_value = $this->db->select('total_value')->get_where('office_proforma', array('office_proforma_id' => $data_tab_val))->result()[0]->total_value;
		
		$total_quantity_new = ($total_quantity - $office_proforma_detail->co_quantity);
		$total_value_new = ($total_value - $office_proforma_detail->total_rate);		
		
		$updateArray = array(
			'total_quantity' => $total_quantity_new,
			'total_value' => $total_value_new
		);
		$this->db->update('office_proforma', $updateArray, array('office_proforma_id' => $data_tab_val));
		
		
// 		$cod_id = $this->db->get_where('customer_order', array('co_id' => $co_id))->row()->cod_id;
		
		$this->db->where('office_proforma_detail_id', $tab_val)->delete($tab);
		
		$data['total_quantity_new'] = $total_quantity_new;
		$data['total_value_new'] = $total_value_new;
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Office Proforma detail deleted successfully';
        return $data;
    }
    
    public function update_proforma_details_wrt_proforma_id(){

        $old_array = $this->db->get_where('office_proforma_detail', array('office_proforma_detail_id' => $this->input->post('proforma_detail_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('proforma_detail_id'), 'office_proforma_detail');

        $proforma_detail_id = $this->input->post('proforma_detail_id');
        $proforma_id = $this->input->post('proforma_id');
        $rate = $this->input->post('rate');
        $quantity = $this->input->post('quantity');
        $total = $this->input->post('total');
        $print_order = $this->input->post('print_order');
        
        $total_amount_invoice_details = $this->db->select('total_value')->get_where('office_proforma', array('office_proforma_id' => $proforma_id))->row()->total_value;

        $total_amount_invoice = $this->db->select('total_rate')->get_where('office_proforma_detail', array('office_proforma_detail_id' => $proforma_detail_id))->row()->total_rate;


        $new_amount_invoice = ($total_amount_invoice_details - $total_amount_invoice + $total);

        $updateArray = array(
            'total_value' => $new_amount_invoice,
            'user_id' => $this->session->user_id
        );

        $this->db->update('office_proforma', $updateArray, array('office_proforma_id' => $proforma_id)); 

        $updateArray1 = array(
                'rate_foreign' => $rate,
                'total_rate' => $total,
                'print_order' => $print_order,
                'user_id' => $this->session->user_id
            );

        $rs = $this->db->update('office_proforma_detail', $updateArray1, array('office_proforma_detail_id' => $proforma_detail_id));

        if($rs == 1){
            $data['type'] = 'success';
            $data['total_net_amount_new'] = $new_amount_invoice;
            $data['msg'] = 'Proforma details updated successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Updated';
        }

        return $data;

    }
    

}