<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Platting_issue_m extends CI_Model {

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
            'comment' => 'Platting Issue'
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
                'comment' => 'Platting Issue'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function platting_issue_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(22, $this->session->user_id);
        return array('page'=>'platting_issue/platting_issue_list_v', 'data'=>$data);
    }

    public function ajax_platting_issue_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'platting_issue_number',
            1 => 'platting_issue_date'
        );
        // Set searchable column fields
        $column_search = array('platting_issue_number','platting_issue_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('platting_issue.platting_issue_id, platting_issue.platting_issue_number, platting_issue.platting_issue_date');
		$rs = $this->db->get_where('platting_issue', array('platting_issue.status => 1'))->result();
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('platting_issue.platting_issue_id, platting_issue.platting_issue_number, platting_issue.platting_issue_date');
			$rs = $this->db->get_where('platting_issue', array('platting_issue.status => 1'))->result();
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
			$this->db->select('platting_issue.platting_issue_id, platting_issue.platting_issue_number, platting_issue.platting_issue_date');
			$rs = $this->db->get_where('platting_issue', array('platting_issue.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('platting_issue.platting_issue_id, platting_issue.platting_issue_number, platting_issue.platting_issue_date');
			$rs = $this->db->get_where('platting_issue', array('platting_issue.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;

        foreach ($rs as $val) {
			
            $nestedData['platting_issue_number'] = $val->platting_issue_number;
            $nestedData['platting_issue_date'] = $val->platting_issue_date;
            $uvp = $this->_user_wise_view_permission(22, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '<a href="'. base_url('admin/platting-issue-edit/'.$val->platting_issue_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a href="javascript:void(0)" pk-name="platting_issue_id" pk-value="'.$val->platting_issue_id.'" tab="platting_issue" ref-tab="platting_issue_detail" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
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

    public function platting_issue_add() {
        $data['buyer_details'] = $this->db->select('am_id, name, short_name')->get_where('acc_master', array('ag_id' => 1, 'acc_master.status' => 1))->result();
		
		$data['packing_shipment_list'] = $this->db->select('packing_shipment_id, package_name')->get_where('packing_shipment', array('packing_shipment.status' => 1))->result();
		
		$data['office_proforma_list'] = $this->db->select('office_proforma_id, proforma_number')->get_where('office_proforma', array('office_proforma.status' => 1))->result();
		
        return array('page'=>'platting_issue/platting_issue_add_v', 'data'=>$data);
    }

    public function ajax_unique_platting_issue_number(){
        $platting_issue_number = $this->input->post('platting_issue_number');

        $rs = $this->db->get_where('platting_issue', array('platting_issue_number' => $platting_issue_number))->num_rows();
        if($rs != '0') {
            $data = 'Platting issue number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }
	
	public function ajax_all_account_declaration(){
		$am_id = $this->input->post('am_id');
		return $data['acc_master_declaration'] = $this->db->select('acc_master_declar_id, declaration_subject')->get_where('acc_master_declaration', array('acc_master_declaration.am_id' => $am_id))->result();	
	}	
	
	public function ajax_all_packing_details(){
		$packing_shipment_id = $this->input->post('packing_shipment_id');
		$rate_type = $this->input->post('rate_type');
		
		$rs = $this->db->select('packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.article_quantity, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight, customer_order.co_no, article_master.art_no, colors.color')
		->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
		->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
		->join('colors', 'colors.c_id = packing_shipment_detail.fc_id', 'left')
		->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id))->result();
		
		for($i = 0; $i < sizeof($rs); $i++){
				$cod_id = 0;
				$am_id = 0;
				
				$rate_inr = 0;
				$rate_foreign = 0;
				$additional_charges = 0;
				$net_rate = 0;
				$amount = 0;
				$rs[$i]->additional_charges = $additional_charges;
				$rs[$i]->net_rate = $net_rate;
				
				
				$rs[$i]->rate_inr = $rate_inr;
				
				$cod_id = $rs[$i]->cod_id;
				$am_id = $rs[$i]->am_id;
				$article_quantity = $rs[$i]->article_quantity;
				
				/*$co_quantity = $rs[$i]->co_quantity;				
				$co_quantity_temp = $this->db->select_sum('co_quantity')->get_where('office_proforma_detail', array('cod_id' => $cod_id, 'am_id' => $am_id))->result()[0]->co_quantity;				
				$remaining_co_quantity = ($co_quantity - $co_quantity_temp);				
				$rs[$i]->remaining_co_quantity = $remaining_co_quantity;*/
				
				
				$query = "SELECT * FROM article_rates WHERE `date`=(SELECT MAX(`date`) FROM article_rates WHERE `am_id`= '14')";
				$query1 = $this->db->query($query)->result()[0];
				
				$exworks_office = $query1->exworks_office;
				$cf_office = $query1->cf_office;
				$fob_office = $query1->fob_office;
				
				if($rate_type == 1){
					$rs[$i]->rate_foreign = $exworks_office;
					$amount = ($article_quantity * $exworks_office) + $additional_charges;
				}
				if($rate_type == 2){
					$rs[$i]->rate_foreign = $cf_office;
					$amount = ($article_quantity * $cf_office) + $additional_charges;
				}
				if($rate_type == 3){
					$rs[$i]->rate_foreign = $fob_office;
					$amount = ($article_quantity * $fob_office) + $additional_charges;
				}
				
				$rs[$i]->amount = $amount;
				 
				 
			}//end for
		
		return $data['packing_shipment_detail'] =	$rs;
	}
	

    public function platting_issue_edit($platting_issue_id) {
        $data['item_group_details'] = $this->db->select('ig_id, ig_code, group_name')->get_where('item_groups', array('item_groups.status' => 1))->result();
		
		
		$data['platting_issue_data'] = $this->db->select('platting_issue.platting_issue_id, platting_issue.platting_issue_number, platting_issue.platting_issue_date')
		->get_where('platting_issue', array('platting_issue.platting_issue_id' => $platting_issue_id))->result();
			
					
        return array('page'=>'platting_issue/platting_issue_edit_v', 'data'=>$data);
    }

    public function form_edit_platting_issue() {

        $old_array = $this->db->get_where('platting_issue', array('platting_issue_id' => $platting_issue_id))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('platting_issue_id'), 'platting_issue');

        $updateArray = array(
            'platting_issue_number' => $this->input->post('platting_issue_number'),
            'platting_issue_date' => $this->input->post('platting_issue_date'),
            'user_id' => $this->session->user_id
        );
        $platting_issue_id = $this->input->post('platting_issue_id');
		
        $this->db->update('platting_issue', $updateArray, array('platting_issue_id' => $platting_issue_id));
				
        $data['type'] = 'success';
        $data['msg'] = 'Platting Issue updated successfully.';
        return $data;

    }

    public function ajax_platting_issue_details_table_data() {
        $platting_issue_id = $this->input->post('platting_issue_id');

		//actual db table column names
        $column_orderable = array(
			0 => 'item_groups.group_name',
            1 => 'item_master.item',
            2 => 'colors.color',
			3 => 'colors.color',
			4 => 'platting_issue_detail.issue_quantity'
        );
        // Set searchable column fields
        $column_search = array('item_groups.group_name', 'item_master.item', 'colors.color', 'platting_issue_detail.issue_quantity');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

		$this->db->select('platting_issue_detail.platting_issue_detail_id, platting_issue_detail.platting_issue_id, platting_issue_detail.ig_id, platting_issue_detail.im_id, platting_issue_detail.id_id, platting_issue_detail.item_colour, platting_issue_detail.new_item_colour, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate, item_groups.group_name, item_master.item, c1.color as item_old_colour, c2.color as item_new_colour');
		$this->db->join('item_groups', 'item_groups.ig_id = platting_issue_detail.ig_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = platting_issue_detail.item_colour', 'left');
       	$this->db->join('colors c2', 'c2.c_id = platting_issue_detail.new_item_colour', 'left');
		$rs = $this->db->get_where('platting_issue_detail', array('platting_issue_detail.platting_issue_id' => $platting_issue_id))->result();
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('platting_issue_detail.platting_issue_detail_id, platting_issue_detail.platting_issue_id, platting_issue_detail.ig_id, platting_issue_detail.im_id, platting_issue_detail.id_id, platting_issue_detail.item_colour, platting_issue_detail.new_item_colour, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate, item_groups.group_name, item_master.item, c1.color as item_old_colour, c2.color as item_new_colour');
		$this->db->join('item_groups', 'item_groups.ig_id = platting_issue_detail.ig_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = platting_issue_detail.item_colour', 'left');
       	$this->db->join('colors c2', 'c2.c_id = platting_issue_detail.new_item_colour', 'left');
		$rs = $this->db->get_where('platting_issue_detail', array('platting_issue_detail.platting_issue_id' => $platting_issue_id))->result();
		
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

            $this->db->select('platting_issue_detail.platting_issue_detail_id, platting_issue_detail.platting_issue_id, platting_issue_detail.ig_id, platting_issue_detail.im_id, platting_issue_detail.id_id, platting_issue_detail.item_colour, platting_issue_detail.new_item_colour, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate, item_groups.group_name, item_master.item, c1.color as item_old_colour, c2.color as item_new_colour');
		$this->db->join('item_groups', 'item_groups.ig_id = platting_issue_detail.ig_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = platting_issue_detail.item_colour', 'left');
       	$this->db->join('colors c2', 'c2.c_id = platting_issue_detail.new_item_colour', 'left');
		$rs = $this->db->get_where('platting_issue_detail', array('platting_issue_detail.platting_issue_id' => $platting_issue_id))->result();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('platting_issue_detail.platting_issue_detail_id, platting_issue_detail.platting_issue_id, platting_issue_detail.ig_id, platting_issue_detail.im_id, platting_issue_detail.id_id, platting_issue_detail.item_colour, platting_issue_detail.new_item_colour, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate, item_groups.group_name, item_master.item, c1.color as item_old_colour, c2.color as item_new_colour');
		$this->db->join('item_groups', 'item_groups.ig_id = platting_issue_detail.ig_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = platting_issue_detail.item_colour', 'left');
       	$this->db->join('colors c2', 'c2.c_id = platting_issue_detail.new_item_colour', 'left');
		$rs = $this->db->get_where('platting_issue_detail', array('platting_issue_detail.platting_issue_id' => $platting_issue_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        

        foreach ($rs as $val) {
            
            $nestedData['item_group'] = $val->group_name;
            $nestedData['item_name'] = $val->item;
            $nestedData['item_colour'] = $val->item_old_colour;// . ' ['. $val->c_code .']';
            $nestedData['new_item_colour'] = $val->item_new_colour;
            $nestedData['plating_rate'] = $val->plating_rate;
            $nestedData['quantity'] = $val->issue_quantity;
			
            $nestedData['action'] = '<a href="javascript:void(0)" platting_issue_detail_id="'.$val->platting_issue_detail_id.'" class="platting_issue_detail_id btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            <a tab="platting_issue_detail" tab-pk="platting_issue_detail_id" 
			data-pk="'.$val->platting_issue_detail_id.'" reference-tab="platting_issue" reference-pk="platting_issue_id" reference-data-pk="'.$val->platting_issue_id.'" href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
            
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
	
	public function all_items_on_item_master_platting_issue(){
        $ig_id = $this->input->post('ig_id');
		$data = array();
		
		$data['item_details'] = $this->db->select('item_master.im_id, item_master.im_code, item_master.item')
		->get_where('item_master', array('item_master.status' => 1, 'item_master.ig_id' => $ig_id))->result();
		
		return $data;
    }

    public function all_item_colour_platting_issue(){
        $im_id = $this->input->post('im_id');
		$data = array();
		
		$data['item_colours'] = $this->db->select('item_dtl.id_id, item_dtl.c_id, colors.color, colors.c_code')
		->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
		->group_by('item_dtl.c_id')
		->get_where('item_dtl', array('item_dtl.status' => 1, 'item_dtl.im_id' => $im_id))->result();
		
		return $data;
    
		}
	
	public function all_items_on_supp_purchase_order(){
        $sup_id = $this->input->post('sup_id');
		
		$this->db->select('supp_purchase_order_detail.id_id, supp_purchase_order_detail.item_qty as pod_quantity, supp_purchase_order_detail.item_rate as pod_rate, supp_purchase_order_detail.total_amount as pod_total, item_master.item as item_name, item_master.im_code, units.unit, colors.color');
		$this->db->join('item_dtl', 'item_dtl.id_id = supp_purchase_order_detail.id_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
		$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
		$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
		return $this->db->get_where('supp_purchase_order_detail', array('supp_purchase_order_detail.status'=>'1', 'supp_purchase_order_detail.sup_id' => $sup_id))->result_array();
		
    }
    
    public function ajax_all_colors_on_item_master(){
        $item_id = $this->input->post('item_id');
        $this->db->select('item_dtl.id_id as item_dtl_id, colors.*');
        $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
        $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
        return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_dtl.im_id' => $item_id, 'color <>' => null))->result_array();
    }
	
    public function ajax_get_remaining_item_quantity(){
        $id_id_add = $this->input->post('id_id_add');
		$po_id = $this->input->post('po_id');
		
		$item_quantity = 0;
		
        $item_quantity1 = $this->db->select_sum('item_quantity')->get_where('stock_in_detail', array('id_id' => $id_id_add, 'po_id' => $po_id))->result()[0]->item_quantity;
		if($item_quantity1 > 0){
			$item_quantity = $item_quantity1;	
		}
		
		return $item_quantity;
		
    }
    
    public function platting_issue_rate_on_new_item(){
        $item_dtl_id = $this->input->post('itm_id');
        $new_item_colour = $this->input->post('new_item_colour');
        $issue_date_add = $this->input->post('platting_issue_date');
        $platting_id = $this->input->post('platting_id');

		$item_quantity = 0;
		
		$show_array = array();
		
		$new_purchase_rate = 0;
		
		$item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;
        
        // $platting_row_num_val = $this->db->get_where('platting_issue_detail', array('platting_issue_id' => $platting_id,  'im_id' => $im_id, 'item_colour' => $c_id, 'new_item_colour' => $new_item_colour))->num_rows();
        
		$result1 = $this->db->select('purchase_order_receive_detail.*, item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                        ->where('purchase_order_receive.purchase_order_receive_date <=', $issue_date_add)
                        ->order_by('purchase_order_receive_detail.purchase_order_receive_detail_id')
                        ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id))->result();
                        
        $result_opening_stock_row1 = $this->db->select('item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock, item_dtl.opening_rate, item_dtl.id_id')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                            ->where('item_dtl.opening_stock >', 0)
                            ->get_where('item_dtl', array('item_dtl.id_id' => $item_dtl_id))->result();
            if(count($result_opening_stock_row1) > 0) {
               $opening_stock_quantity1 = $result_opening_stock_row1[0]->opening_stock; 
            } else {
               $opening_stock_quantity1 = 0; 
            }
                        
        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

            $platting_issue_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as issue_quantity')
                            ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                            ->where('platting_issue.platting_issue_date <=', $issue_date_add)
                            ->get_where('platting_issue_detail', array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id, 'platting_issue_detail.status' => 1))->row();

            if (count($platting_issue_row) > 0) {
                $platting_issue = $platting_issue_row->issue_quantity;
            } else {
                $platting_issue = 0;
            }

            $sum_purchase_order_row = $this->db->select('SUM(purchase_order_receive_detail.item_quantity) as item_quantity')
                            ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                            ->where('purchase_order_receive.purchase_order_receive_date <=', $issue_date_add)
                            ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id, 'purchase_order_receive_detail.status' => 1))->row();

            if (count($sum_purchase_order_row) > 0) {
                $sum_purchase_order = $sum_purchase_order_row->item_quantity;
            } else {
                $sum_purchase_order = 0;
            }
            
             $sum_material_issue_row = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_quantity')
                            ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                            ->where('material_issue.material_issue_date <=', $issue_date_add)
                            ->get_where('material_issue_detail', array('material_issue_detail.id_id' => $item_dtl_id))->row();

            if (count($sum_material_issue_row) > 0) {
                $sum_material_issue = $sum_material_issue_row->issue_quantity;
            } else {
                $sum_material_issue = 0;
            }
            
            $sum_stock_in_row = $this->db->select('SUM(stock_in_detail.item_quantity) as item_quantity')
                            ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                            ->where('stock_in.purchase_order_receive_date <=', $issue_date_add)
                            ->get_where('stock_in_detail', array('stock_in_detail.id_id' => $item_dtl_id, 'stock_in_detail.status' => 1))->row();

            if (count($sum_stock_in_row) > 0) {
                $sum_stock_in = $sum_stock_in_row->item_quantity;
            } else {
                $sum_stock_in = 0;
            }
            
            $item_quantity = $opening_stock_quantity1 + $sum_purchase_order - ($sum_material_issue + $platting_issue) + $sum_stock_in;
    
    $purchase_rate_row = $this->db->select('purchase_order_receive_detail.*, item_master.im_id, item_master.item, colors.c_id, colors.color, item_dtl.opening_stock')
                        ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                        ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                        ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                        ->order_by('purchase_order_receive_detail.purchase_order_receive_detail_id', 'desc')
                        ->limit(1)
                        ->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail.id_id' => $item_dtl_id))->result();
                        
                        if(count($purchase_rate_row) > 0) {
                            $new_purchase_rate = $purchase_rate_row[0]->item_rate;
                        } else {
                            $new_purchase_rate = 0;
                        }
		
		
		
		$arr = array(
                            'item_quantity' => $item_quantity,
                            'new_purchase_rate' => $new_purchase_rate,
                            );
                            
                            array_push($show_array, $arr);
    
        return $show_array;
    }
    
    public function platting_issue_rate_on_new_item_another(){
        $item_dtl_id = $this->input->post('itm_id');
        $new_item_colour = $this->input->post('new_item_colour_add');
        $platting_id = $this->input->post('platting_id');

		$item_quantity = 0;
		
		$show_array = array();
		
		$new_purchase_rate = 0;
		
		$item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $item_dtl_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;
        
        $platting_row_num_val = $this->db->get_where('platting_issue_detail', array('platting_issue_id' => $platting_id,  'im_id' => $im_id, 'item_colour' => $c_id, 'new_item_colour' => $new_item_colour))->num_rows();
        
        if($platting_row_num_val > 0) {
		
		            $arr = array(
                            'item_quantity' => 'NA',
                            'new_purchase_rate' => 'NA',
                            );
                            
                            array_push($show_array, $arr);
        }
        return $show_array;
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
	
    public function form_add_platting_issue(){
        $insertArray = array(
			'platting_issue_number' => $this->input->post('platting_issue_number'),
			'platting_issue_date' => $this->input->post('platting_issue_date'),
            'user_id' => $this->session->user_id
		);	
		
		$this->db->insert('platting_issue', $insertArray);
		//echo $this->db->last_query();
		$insert_id = $this->db->insert_id();
		
        
		if($insert_id > 0){
			$data['insert_id'] = $insert_id;
			$data['type'] = 'success';
			$data['msg'] = 'Platting issueed successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }
	
	public function form_add_platting_issue_details(){
        $insertArray = array(
			'platting_issue_id' => $this->input->post('platting_issue_id'),
			'ig_id' => $this->input->post('ig_id_add'),
			'im_id' => $this->input->post('im_id_add'),
			'item_colour' => $this->input->post('item_colour_add'),
			'new_item_colour' => $this->input->post('new_item_colour_add'),
			'plating_rate' => $this->input->post('rate_add'),
			'issue_quantity' => $this->input->post('issue_quantity_add'),
            'user_id' => $this->session->user_id
		);	
		
		$this->db->insert('platting_issue_detail', $insertArray);
		//echo $this->db->last_query();
		$insert_id = $this->db->insert_id();
		
        
		if($insert_id > 0){
			$data['insert_id'] = $insert_id;
			$data['type'] = 'success';
			$data['msg'] = 'Platting issue detail added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }
	

    public function ajax_fetch_platting_issue_details_on_pk(){
        $platting_issue_detail_id = $this->input->post('platting_issue_detail_id');
		
		return $this->db->select('platting_issue_detail.platting_issue_detail_id, platting_issue_detail.platting_issue_id, platting_issue_detail.ig_id, platting_issue_detail.im_id, platting_issue_detail.id_id, platting_issue_detail.item_colour, platting_issue_detail.new_item_colour, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate, item_groups.group_name, item_master.item, c1.color as item_old_colour, c2.color as item_new_colour')
		->join('item_groups', 'item_groups.ig_id = platting_issue_detail.ig_id', 'left')
		->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left')
		->join('colors c1', 'c1.c_id = platting_issue_detail.item_colour', 'left')
		->join('colors c2', 'c2.c_id = platting_issue_detail.new_item_colour', 'left')
		->get_where('platting_issue_detail', array('platting_issue_detail.platting_issue_detail_id' => $platting_issue_detail_id))->result();
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


    public function form_edit_platting_issue_details(){
        $platting_issue_detail_id = $this->input->post('platting_issue_detail_id');
		$issue_quantity = $this->input->post('issue_quantity_edit');
	    $platting_rate = $this->input->post('rate_add_edit');

        $old_array = $this->db->get_where('platting_issue_detail', array('platting_issue_detail_id' => $this->input->post('platting_issue_detail_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('platting_issue_detail_id'), 'platting_issue_detail');
		
        $updateArray = array(
            'issue_quantity' => $issue_quantity,
            'plating_rate' => $platting_rate,
            'user_id' => $this->session->user_id
        );
		
		$this->db->update('platting_issue_detail', $updateArray, array('platting_issue_detail_id' => $platting_issue_detail_id));		
		
        $data['type'] = 'success';
        $data['msg'] = 'Platting Issue updated successfully.';
        return $data;
    }
	
	public function form_edit_delivery_sgst_cgst_value(){
        
		$purchase_order_receive_id = $this->input->post('purchase_order_receive_id');
		
        $updateArray = array(
            'total_amount' => $this->input->post('total_amount'),
            'delivery_charge' => $this->input->post('delivery_charge'),
			'sgst_percent' => $this->input->post('sgst_percent'),
            'cgst_percent' => $this->input->post('cgst_percent'),
			'delivery_sgst_cgst_amount' => $this->input->post('delivery_sgst_cgst_amount'),
			'net_amount' => $this->input->post('net_amount'),
            'user_id' => $this->session->user_id
        );
		
		$this->db->update('stock_in', $updateArray, array('purchase_order_receive_id' => $purchase_order_receive_id));

        $data['type'] = 'success';
        $data['msg'] = 'Net Amount updated successfully.';
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

    public function delete_office_invoice_header(){
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_tab');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		
        $this->db->where($pk_name, $pk_value)->delete($tab);
		$this->db->where($pk_name, $pk_value)->delete($ref_table);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Platting Issue Successfully Deleted';
        return $data;
    }
	
	public function delete_material_issue_details_list(){

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
		
		$reference_tab = $this->input->post('reference_tab');
		$reference_pk = $this->input->post('reference_pk');
		$reference_data_pk = $this->input->post('reference_data_pk');
		
		$purchase_order_receive_id = $reference_data_pk;
				
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Platting issue list Successfully Deleted';
        return $data;
    }
    // purchase ORDER ENDS 

}