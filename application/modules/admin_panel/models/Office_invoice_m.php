<?php
/**
 * Coded by: Pran Krishna Das
 * Social: https://sketchmeglobal.com
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 */

class Office_invoice_m extends CI_Model {

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
            'comment' => 'office invoice'
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
                'comment' => 'office invoice'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function office_invoice_list() {
        $data = [];
        $data["view_permission"] = $this->_user_wise_view_permission(12, $this->session->user_id);
        return array('page'=>'office_invoice/office_invoice_list_v', 'data'=>$data);
    }

    public function ajax_office_invoice_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'office_invoice.office_invoice_number',
            1 => 'office_invoice.office_invoice_date'
        );
        // Set searchable column fields
        $column_search = array('office_invoice.office_invoice_number', 'office_invoice.office_invoice_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('office_invoice.office_invoice_id, office_invoice.office_invoice_number, office_invoice.office_invoice_date, office_invoice.rate_type, office_invoice.am_id, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.net_quantity, office_invoice.grand_total, office_invoice.packing_shipment_id, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
		$this->db->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left');
		$rs = $this->db->get_where('office_invoice', array('office_invoice.status => 1'))->result();
		
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_invoice.office_invoice_id, office_invoice.office_invoice_number, office_invoice.office_invoice_date, office_invoice.rate_type, office_invoice.am_id, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.net_quantity, office_invoice.packing_shipment_id, office_invoice.grand_total, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left');
			$rs = $this->db->get_where('office_invoice', array('office_invoice.status => 1'))->result();
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
			$this->db->select('office_invoice.office_invoice_id, office_invoice.office_invoice_number, office_invoice.office_invoice_date, office_invoice.rate_type, office_invoice.am_id, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight,office_invoice.net_quantity,office_invoice.grand_total, office_invoice.packing_shipment_id, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left');
			$rs = $this->db->get_where('office_invoice', array('office_invoice.status => 1'))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_invoice.office_invoice_id, office_invoice.office_invoice_number, office_invoice.office_invoice_date, office_invoice.rate_type, office_invoice.am_id, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.net_quantity, office_invoice.grand_total, office_invoice.packing_shipment_id, acc_master.name as acc_master_name, acc_master.short_name as acc_master_short_name');
			$this->db->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left');
			$rs = $this->db->get_where('office_invoice', array('office_invoice.status => 1'))->result();
            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;
        $nestedData = [];
        foreach ($rs as $val) {
			$rate_type = $val->rate_type;
			if($rate_type == 1){$rate_type_text = 'Ex. Works';}
			if($rate_type == 2){$rate_type_text = 'C&F';}
            if($rate_type == 3){$rate_type_text = 'CIF';}
			if($rate_type == 4){$rate_type_text = 'FOB';}
			
            $nestedData['office_invoice_name'] = $val->office_invoice_number;
            $nestedData['office_invoice_date'] = $val->office_invoice_date;
			$nestedData['rate_type'] = $rate_type_text;
			$nestedData['buyer_name'] = $val->acc_master_name;
			$nestedData['quantity'] = $val->net_quantity;
			$nestedData['total'] = $val->grand_total;
			$nestedData['gross_weight'] = $val->gross_weight;
			$nestedData['net_weight'] = $val->net_weight;
			
			$uvp = $this->_user_wise_view_permission(12, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                if($val->grand_total > 0) {
                $nestedData['action'] = '<a href="'. base_url('admin/office-invoice-edit/'.$val->office_invoice_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            
            <button po-id="'.$val->office_invoice_id .'" type="button" class="btn btn-primary print_all"><i class="fa fa-print"></i> Print</button>
            
            <a href="'. base_url('admin/office-invoice-jsonfile/'.$val->office_invoice_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Create Json</a>
            
            <a href="javascript:void(0)" pk-name="office_invoice_id" pk-value="'.$val->office_invoice_id.'" tab="office_invoice" ref-tab="office_invoice_detail" ref-value="'.$val->packing_shipment_id.'" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';
                } else {
                $nestedData['action'] = '<a href="'. base_url('admin/office-invoice-edit/'.$val->office_invoice_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
            
            <a href="'. base_url('admin/office-invoice-jsonfile/'.$val->office_invoice_id) .'" class="btn btn-info"><i class="fa fa-pencil"></i> Create Json</a>
            
            <a href="javascript:void(0)" pk-name="office_invoice_id" pk-value="'.$val->office_invoice_id.'" tab="office_invoice" ref-tab="office_invoice_detail" ref-value="'.$val->packing_shipment_id.'" child="1" class="btn btn-danger delete"><i class="fa fa-times"></i> Delete</a>';    
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

    public function office_invoice_add() {
        $data = [];
        $data['buyer_details'] = $this->db
        ->select('am_id, name, short_name, cur_id')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        
        
        $data['transport_details'] = $this->db->select('tr_id, name, short_name')->get_where('transport_master', array('transport_master.status' => 1))->result();
        
		
		$data['packing_shipment_list'] = $this->db->select('packing_shipment_id, package_name')->group_by('packing_shipment.packing_shipment_id')->get_where('packing_shipment', array('packing_shipment.status' => 1, 'packing_shipment.invoice_status' => 0))->result();
		
		$data['office_proforma_list'] = $this->db->select('office_proforma_id, proforma_number')->get_where('office_proforma', array('office_proforma.status' => 1))->result();
		
		$data['currency_list'] = $this->db->select('cur_id, currency')->get_where('currencies', array('currencies.status' => 1))->result();
		
        return array('page'=>'office_invoice/office_invoice_add_v', 'data'=>$data);
    }

    public function ajax_unique_office_invoice_number(){
        $office_invoice_number = $this->input->post('office_invoice_number');

        $rs = $this->db->get_where('office_invoice', array('office_invoice_number' => $office_invoice_number))->num_rows();
        if($rs != '0') {
            $data = 'Invoice number already exists.';
        }else{
            $data='true';
        }
        // echo $this->db->last_query();
        return $data;
    }

    public function delete_office_invoice_details_list(){
        $data = [];
        $primary_key = $this->input->post('data_pk');
        $table_name = 'office_invoice_detail';
        $pk_field_name = 'office_invoice_detail_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "office_invoice_detail",
                    "tbl_pk_fld" => "office_invoice_detail_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);

        $invoice_number = $this->input->post('data_pk');
        $invoice_id = $this->input->post('tab_pk');

        $rs = $this->db->get_where('office_invoice_detail', array('office_invoice_detail_id' => $invoice_number))->row();
        $quantity = $rs->quantity;
        $amount = $rs->amount;
        $rate_inrr = $rs->rate_inr;
        $amount_inr = ($amount * $rate_inrr);

         $rs_old = $this->db->get_where('office_invoice', array('office_invoice_id' => $invoice_id))->row();

         $old_quantity = $rs_old->net_quantity;
         $old_net_amount = $rs_old->net_amount;
         $old_total_amount = $rs_old->grand_total;
         $old_net_amount_inr = ($rs_old->net_amount * $rate_inrr);
         $old_total_amount_inr = ($rs_old->grand_total * $rate_inrr);

         $quantity_new = ($old_quantity - $quantity);
         $net_amount_new = ($old_net_amount - $amount);
         $total_amount_new = ($old_total_amount - $amount);
         $net_amount_new_inr = ($old_net_amount_inr - $amount_inr);
         $total_amount_new_inr = ($old_total_amount - $amount_inr);

         $update_array = array(
         	'net_quantity' => $quantity_new,
         	'net_amount' => $net_amount_new,
         	'grand_total' => $total_amount_new,
         	'net_amount_inr' => $net_amount_new_inr,
         	'grand_total_inr' => $total_amount_new_inr
         );

         $this->db->update('office_invoice', $update_array, array('office_invoice_id' => $invoice_id));

         $this->db->where('office_invoice_detail_id', $invoice_number)->delete('office_invoice_detail');
        // echo $this->db->last_query();

         $data['quantity_new'] = $quantity_new;
         $data['net_amount_new'] = $net_amount_new;
         $data['total_amount_new'] = $total_amount_new;
         $data['net_amount_new_inr'] = $net_amount_new_inr;
         $data['total_amount_new_inr'] = $total_amount_new_inr;
         $data['title'] = 'Deleted!';
         $data['type'] = 'success';
         $data['msg'] = 'Item Successfully Deleted';

        return $data;
    }
	
	public function ajax_all_account_declaration(){
	    $data = [];
		$am_id = $this->input->post('am_id');
		return $data['acc_master_declaration'] = $this->db->select('INVOICE_DECLARATION_SEQ, DECLARATION_DESCRIPTION, DECLARATION_SUBJECT')->get_where('invoice_declaration', array('invoice_declaration.BUYER' => $am_id))->result();	
	}	
	
	public function ajax_all_packing_details(){
	    $data = [];
		$packing_shipment_id = $this->input->post('packing_shipment_id');
		$rate_type = $this->input->post('rate_type');
		
		$rs = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment.gross_weight, packing_shipment.net_weight, customer_order.co_no, article_master.art_no, colors.color')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
		->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
		->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
		->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
		->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
		->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.status' => 1))->result();
		
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
				
				$query = "SELECT * FROM article_rates_office_use WHERE `date`=(SELECT MAX(`date`) FROM article_rates_office_use WHERE `am_id` = $am_id) AND `am_id` = $am_id";
				$query1 = $this->db->query($query)->result();

				if(count($query1) > 0) {
					
				$exworks_office = $query1[0]->exworks_final;
				$cf_office = $query1[0]->cf_final;
				$fob_office = $query1[0]->fob_final;
				
				} else {
				 
				 $exworks_office = 0;
				$cf_office = 0;
				$fob_office = 0;
				    
				}
				
				if($rate_type == 1){
					$rs[$i]->rate_foreign = $exworks_office;
					$amount = ($article_quantity * $exworks_office) + $additional_charges;
				}
				if($rate_type == 2){
					$rs[$i]->rate_foreign = $cf_office;
					$amount = ($article_quantity * $cf_office) + $additional_charges;
				}
				if($rate_type == 3){
					$rs[$i]->rate_foreign = $cf_office;
					$amount = ($article_quantity * $cf_office) + $additional_charges;
				}
				if($rate_type == 4){
					$rs[$i]->rate_foreign = $fob_office;
					$amount = ($article_quantity * $fob_office) + $additional_charges;
				}
				
			 $rs[$i]->amount = $amount;
				 	 
			}//end for
		
		return $data['packing_shipment_detail'] =	$rs;
	}
	
    public function office_invoice_edit($office_invoice_id) {
        $data = [];
    	$invoice_id = $this->uri->segment(3);
        
        $data['invoice_details'] = $this->db->select('office_invoice_detail.*, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color')
		->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left')
		->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left')
		->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left')
		->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();

        $data['buyer_details'] = $this->db->select('am_id, name, short_name, cur_id')->get_where('acc_master', array('ag_id' => 2, 'acc_master.status' => 1))->result();
        
        $data['transport_details'] = $this->db->select('tr_id, name, short_name')->get_where('transport_master', array('transport_master.status' => 1))->result();
		
		$data['packing_shipment_list'] = $this->db->select('packing_shipment_id, package_name')->get_where('packing_shipment', array('packing_shipment.status' => 1))->result();
		
		$data['office_proforma_list'] = $this->db->select('office_proforma_id, proforma_number')->get_where('office_proforma', array('office_proforma.status' => 1))->result();
				
		$data['office_invoice_data'] = $this->db->select('office_invoice.*')
		->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left')
		->join('transport_master', 'transport_master.tr_id = office_invoice.tr_id', 'left')
		->get_where('office_invoice', array('office_invoice.office_invoice_id' => $office_invoice_id))->result();
   
        // echo '<pre>', print_r($data['office_invoice_data']), '</pre>'; die();
   
        $data['acc_master_declaration'] = $this->db->select('INVOICE_DECLARATION_SEQ, DECLARATION_DESCRIPTION, DECLARATION_SUBJECT')->get_where('invoice_declaration')->result();
								
        $data['currency_list'] = $this->db->select('cur_id, currency')->get_where('currencies', array('currencies.status' => 1))->result();
        
        return array('page'=>'office_invoice/office_invoice_edit_v', 'data'=>$data);
    }
    
    
    public function office_invoice_jsonfile($office_invoice_id) {

        $data = [];
    	$invoice_id = $office_invoice_id;
		
		
		 $this->db->select('notify,office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, ac1.email_id, ac1.phone, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, office_invoice.distance, transport_master.name as transporter_name, currencies.gst_currency, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, office_invoice_detail.amount_inr, office_invoice.net_amount_inr, office_invoice.grand_total_inr, article_master.leather_type_info, currencies.cur_id, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.port_of_loading, office_invoice.print_hand_ratio, office_invoice.discount, office_invoice.hand_charge');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('transport_master', 'transport_master.tr_id = office_invoice.tr_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
		$invc_details = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();

		
		if($invc_details[0]->pre_carriage_by == 1) {
                                                $transport_mode = 3;
                                                } else if ($invc_details[0]->pre_carriage_by == 2) {
                                                $transport_mode = 4;
                                                } else {
                                                $transport_mode = 1;
                                                }
		
		
		$tot_amnt_inr = 0;
		$tot_amnt = 0;
		$iters = 0;
		$itemLists = [];
		foreach($invc_details as $i_d) {
		    $iters++;
		    
		    $u_price = (($i_d->rate_foreign + $i_d->additional_charges) * $i_d->rate_inr);
            
            
            $itemLists[] = array(
			"SlNo"=> (string)$iters,
			"PrdDesc"=> $i_d->art_info,
			"IsServc"=> "N",
			"HsnCd"=> $i_d->remark,
			"Barcde"=> null,
			"Qty"=> (float)$i_d->quantity,
			"FreeQty"=> 0,
			"Unit"=> "PCS",
			"UnitPrice"=> (float)number_format($u_price, 2, '.', ''),
			"TotAmt"=> (float)number_format(($i_d->amount * $i_d->rate_inr), 2, '.', ''),
			"Discount"=> 0,
			"PreTaxVal"=> 0,
			"AssAmt"=> (float)number_format(($i_d->amount * $i_d->rate_inr), 2, '.', ''),
			"GstRt"=> 0,
			"IgstAmt"=> 0,
			"CgstAmt"=> 0,
			"SgstAmt"=> 0,
			"CesRt"=> 0,
			"CesAmt"=> 0,
			"CesNonAdvlAmt"=> 0,
			"StateCesRt"=> 0,
			"StateCesAmt"=> 0,
			"StateCesNonAdvlAmt"=> 0,
			"OthChrg"=> 0,
			"TotItemVal"=> (float)number_format(($i_d->amount * $i_d->rate_inr), 2, '.', ''),
			"OrdLineRef"=> null,
			"OrgCntry"=> null,
			"PrdSlNo"=> null,
			"BchDtls"=> null,
			"AttribDtls"=> null
			);
            
            
          $tot_amnt += $i_d->amount;
          $tot_amnt_inr += ((float)$i_d->amount * $i_d->rate_inr);
		}
		

		$additional_charges = $invc_details[0]->additional_charges * $invc_details[0]->rate_inr;
		$hand_charge = $invc_details[0]->hand_charge * $invc_details[0]->rate_inr;
		$discount_amount = (round($tot_amnt * ($invc_details[0]->discount / 100), 2) * $invc_details[0]->rate_inr);
		
		
$response = array([
    "Version"=> "1.1",
	"TranDtls"=>
		[
			"TaxSch"=> "GST",
            "SupTyp"=> "EXPWOP",
            "IgstOnIntra"=>"N",
            "RegRev"=>"N",
            "EcmGstin"=> null,
		],
	"DocDtls"=>
    	[
			"Typ"=> "INV",
            "No"=> $invc_details[0]->office_invoice_number,
            "Dt"=>date('d/m/Y', strtotime($invc_details[0]->office_invoice_date)),
		],
    "SellerDtls"=>
    	[
			"Gstin"=> "19AAECS6338L1ZT",
            "LglNm"=> "SHILPA OVERSEAS PVT. LTD.",
            "TrdNm"=>"SHILPA OVERSEAS PVT. LTD.",
            "Addr1"=> "51, MAHANIRBAN ROAD",
            "Addr2"=>"KOLKATA",
            "Loc"=> "WEST BENGAL",
            "Pin"=> 700029,
            "Stcd"=>	"19",
            "Ph"=> "03340031411",
            "Em"=>"deep.paul@shilpaoverseas.com"
		],
    "BuyerDtls"=>
    	[
			"Gstin"=> "URP",
            "LglNm"=> $invc_details[0]->acc_name,
            "TrdNm"=> $invc_details[0]->acc_name,
            "Pos"=> "96",
            "Addr1"=> $invc_details[0]->acc_address,
            "Addr2"=>null,
            "Loc"=> $invc_details[0]->country,
            "Pin"=> 999999,
            "Stcd"=>	"96",
            "Ph"=> null,
            "Em"=> null
		],
    "DispDtls"=>
    	[ 
			"Nm"=> "SHILPA OVERSEAS PVT. LTD.",
            "Addr1"=> "KAIKHALI, CHIRIAMORE, 24 PRGS(N)",
            "Loc"=> "COMPANY GALI, KOLKATA",
            "Pin"=> "700136",
            "Stcd"=>	"96"
		],
    "DispDtls"=> null,
	"ShipDtls"=> null,
	"ValDtls"=> [
		"AssVal"=> (float)number_format($tot_amnt_inr, 2, '.', ''),
		"IgstVal"=> 0,
		"CgstVal"=> 0,
		"SgstVal"=> 0,
		"CesVal"=> 0,
		"StCesVal"=> 0,
		"Discount"=> (float)number_format(($discount_amount), 2, '.', ''),
		"OthChrg"=> (float)number_format(($additional_charges + $hand_charge), 2, '.', ''),		
		"RndOffAmt"=> 0,
		"TotInvVal"=> (float)number_format(($tot_amnt_inr - $discount_amount + $hand_charge), 2, '.', ''),
		"TotInvValFc"=> (float)number_format(($tot_amnt - round($tot_amnt * ($invc_details[0]->discount / 100), 2) + $invc_details[0]->hand_charge), 2, '.', '')
	],
	"ExpDtls"=> [
		"ShipBNo"=> null,
		"ShipBdt"=> null,
		"Port"=> null,
		"RefClm"=> null,
		"ForCur"=> $invc_details[0]->gst_currency,
		"CntCode"=> null,
		"ExpDuty"=> null
	],
	"EwbDtls"=> [
		"TransId"=> null,
		"TransName"=> $invc_details[0]->transporter_name,
		"TransMode"=> (string)$transport_mode,
		"Distance"=> (int)$invc_details[0]->distance,
		"TransDocNo"=> null,
		"TransDocDt"=> null,
		"VehNo"=> null,
		"VehType"=> null
	],
	"PayDtls"=> null,
	"RefDtls"=> null,
	"AddlDocDtls"=> null,
	"ItemList"=> $itemLists
]);


$response1 = json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);


$data_inserts = array (
    "invoice_id" => $invoice_id,
    "json_data" => $response1
    );


$this->db->insert('gst_data_upload', $data_inserts);


$dir_to_save = "assets/invoice_json/INV-".rand().'.json';


file_put_contents($dir_to_save, $response1);
$name = "INV-".rand().".json"; // new name for your file
$this->load->helper('download');
// $data1 = file_get_contents($dir_to_save); // Read the file's contents
$path    =   file_get_contents(base_url().$dir_to_save);
force_download($name, $path);

    }
    

    public function invoice_declaration() {
        $user_id = $this->session->user_id;
        try{
            $crud = new grocery_CRUD();
            $crud->set_crud_url_path(base_url('admin_panel/Office_invoice/invoice_declaration'));
            $crud->set_theme('datatables');
            $crud->set_subject('Invoice Declaration');
            $crud->set_table('invoice_declaration');
            $crud->set_relation('BUYER','acc_master','name');
            $crud->unset_read();
            $crud->unset_clone();

            // permission setter 
            // permission setter
            // echo '<pre>', print_r($result_set), '</pre>';die;

            // callback conditions

            $crud->columns('DECLARATION_SUBJECT','BUYER','DECLARATION_DESCRIPTION', 'STATUS');
            $crud->fields('DECLARATION_SUBJECT','BUYER','DECLARATION_DESCRIPTION', 'STATUS');
            $crud->required_fields('BUYER','DECLARATION_SUBJECT');

            $crud->field_type('STATUS', 'true_false', array('0'=>'Disable','1'=>'Enable'));
            $crud->field_type('USER_ID', 'hidden', $user_id);

            $output = $crud->render();
            //rending extra value to $output
            $output->tab_title = 'Invoice Declaration';
            $output->section_heading = 'Invoice Declaration <small>(Add / Edit / Delete)</small>';
            $output->menu_name = 'Invoice Declaration';
            $output->add_button = '';

            return array('page'=>'common_v', 'data'=>$output); //loading common view page
        } catch(Exception $e) {
            show_error($e->getMessage().'<br>'.$e->getTraceAsString());
        }
    }

    public function form_edit_office_invoice(){
        $data = [];
        $old_array = $this->db->get_where('office_invoice', array('office_invoice_id' => $this->input->post('office_invoice_id_edit')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('office_invoice_id_edit'), 'office_invoice');

    	$invoice_id = $this->input->post('office_invoice_id_edit');
        $temp = '';
        $dtemp = '';
        $total_invoice_inr_val = 0;
        $total_invoice_vals = 0;
        $all_quantity_vals = 0;
        
        $get_detail_invoice_ex_rate = $this->db->get_where('office_invoice_detail', array('office_invoice_id' => $invoice_id))->result();
        
        foreach($get_detail_invoice_ex_rate as $g) {
            $total_amount_inr_value = ($g->amount * $this->input->post('ex_rate'));
            $total_invoice_inr_val += ($g->amount * $this->input->post('ex_rate'));
            $total_invoice_vals += $g->amount;
            $all_quantity_vals += $g->quantity;
            $update_arr = array(
                'rate_inr' => $this->input->post('ex_rate'),
                'amount_inr' => $total_amount_inr_value
                );
                // print_r($update_arr); die();
           $this->db->update('office_invoice_detail', $update_arr, array('office_invoice_detail_id' => $g->office_invoice_detail_id)); 
        }

            if(count($this->input->post('office_proforma_id')) > 0){
                foreach ($this->input->post('office_proforma_id') as $value) {
                    $temp .= $value . ',';
                }
            }
            if($this->input->post('acc_master_declar_id[]') != ''){
                foreach ($this->input->post('acc_master_declar_id[]') as $dvalue) {
                    $dtemp .= $dvalue . ',';
                }
            }
            
            if(isset($_POST['print_hand_ratio'])) {
                $print_hand_ratio = 1;
            } else {
                $print_hand_ratio = 0;
            }
            
            $grand_total_inr = ($total_invoice_inr_val - ($total_invoice_inr_val * ($this->input->post('disc') / 100)) + $this->input->post('hand_charge'));
            $grand_total = ($total_invoice_vals - ($total_invoice_vals * ($this->input->post('disc') / 100)) + $this->input->post('hand_charge'));

        $invoice_arr = array(
               'office_invoice_number' => $this->input->post('office_invoice_number'),
                'office_invoice_date' => $this->input->post('office_invoice_date'),
                'rate_type' => $this->input->post('rate_type'),
                'am_id' => $this->input->post('am_id'),
                'tr_id' => $this->input->post('tr_id'),
                'distance' => $this->input->post('distance'),
                'cur_id' => $this->input->post('currency'),
                'pre_carriage_by' => $this->input->post('pre_carriage_by'),
                'port_of_discharge' => $this->input->post('port_of_discharge'),
                'port_of_loading' => $this->input->post('port_of_loading'),
                'terms_conditions' => $this->input->post('terms_conditions'),
                'office_proforma_id' => rtrim($temp, ","),
                'terms_of_delivery_payment' => $this->input->post('terms_of_delivery_payment'),
                'mark_container' => $this->input->post('mark_container'),
                'notify' => $this->input->post('notify'),
                'no_of_kind_of_package' => $this->input->post('no_of_kind_of_package'),
                'description_of_goods' => $this->input->post('description_of_goods'),
                'gross_weight' => $this->input->post('gross_weight'),
                'net_weight' => $this->input->post('net_weight'),
                'volume_weight' => $this->input->post('volume_weight'),
                'ex_rate' => $this->input->post('ex_rate'),
                'conversion_rate' => $this->input->post('conversion_rate'),
                'acc_master_declar_id' => rtrim($dtemp, ","),
                'net_quantity' => $all_quantity_vals,
                'net_amount' => $total_invoice_vals,
                'net_amount_inr' => $total_invoice_inr_val,
                'discount' =>$this->input->post('disc'),
                'hand_charge' =>$this->input->post('hand_charge'),
                'grand_total' =>$grand_total,
                'grand_total_inr' =>$grand_total_inr,
                'cust_header_name' =>$this->input->post('cust_header_name'),
                'am_id_other' => $this->input->post('am_id_other'),
                'print_hand_ratio' => $print_hand_ratio
            );
        $this->db->update('office_invoice', $invoice_arr, array('office_invoice_id' => $invoice_id));
        

	// echo $this->db->last_query(); die();
        if($invoice_id > 0) {
        	$data['invoice_id'] = $invoice_id;
			$data['type'] = 'success';
			$data['msg'] = 'Office Invoice details updated successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
		}
		return $data;
    }

    public function ajax_office_invoice_details_table_data() {
        $office_invoice_id = $this->input->post('office_invoice_id_edit');

        //actual db table column names
        $column_orderable = array(
            0 => 'customer_order.co_no',
            1 => 'article_master.art_no',
            2 => 'colors.color',
            3 => 'office_invoice_detail.item_no',
            4 => 'office_invoice_detail.reference_no',
            5 => 'office_invoice_detail.quantity',
            6 => 'office_invoice_detail.rate_inr',
            7 => 'office_invoice_detail.rate_foreign',
            8 => 'office_invoice_detail.net_rate',
            9 => 'office_invoice_detail.amount'
        );
        // Set searchable column fields
        $column_search = array('customer_order.co_no', 'article_master.art_no', 'article_master.art_no', 'colors.color', 'office_invoice_detail.item_no', 'office_invoice_detail.reference_no');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code');
        $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
        $this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
        $this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
        $rs = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $office_invoice_id))->result();
        
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code');
        $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
        $this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
        $this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
        $rs = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $office_invoice_id))->result();
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

            $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code');
        $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
        $this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
        $this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
        $rs = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $office_invoice_id))->result();
        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code');
        $this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
        $this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
        $this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
        $this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
        $rs = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $office_invoice_id))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        $nestedData = [];

        foreach ($rs as $val) {
            
            $nestedData['order_number'] = $val->co_no;
            $nestedData['article_name'] = $val->art_no;
            $nestedData['colour'] = $val->color . ' ['. $val->c_code .']';
            $nestedData['item_no'] = $val->item_no;
            $nestedData['reference_no'] = $val->reference_no;
            $nestedData['quantity'] = $val->quantity;
            $nestedData['rate_inr'] = $val->rate_inr;
            $nestedData['rate_foreign'] = $val->rate_foreign;
            $nestedData['net_rate'] = $val->net_rate;
            $nestedData['amount'] = $val->amount;
            
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

    public function ajax_office_invoice_details_packing_table_data() {
        $office_invoice_id = $this->input->post('office_invoice_id_edit');

        $packing_shipment_id = $this->db->get_where('office_invoice', array('office_invoice_id' => $office_invoice_id))->row()->packing_shipment_id;
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

        $rs = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, colors.color as leather_color, colors.c_code as leather_code, colors.c_id as leather_id, article_master.art_no, packing_shipment_detail.update_after_invoice_text, customer_order.co_id, article_master.am_id, article_master.info, article_master.alt_art_no')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.update_after_invoice' => 1))->result();
            
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, colors.color as leather_color, colors.c_code as leather_code, colors.c_id as leather_id, article_master.art_no, packing_shipment_detail.update_after_invoice_text, customer_order.co_id, article_master.am_id, article_master.info, article_master.alt_art_no')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.update_after_invoice' => 1))->result();
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

            $rs = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, colors.color as leather_color, colors.c_code as leather_code, colors.c_id as leather_id, article_master.art_no, packing_shipment_detail.update_after_invoice_text, customer_order.co_id, article_master.am_id, article_master.info, article_master.alt_art_no')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.update_after_invoice' => 1))->result();        

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            $rs = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, colors.color as leather_color, colors.c_code as leather_code, colors.c_id as leather_id, article_master.art_no, packing_shipment_detail.update_after_invoice_text, customer_order.co_id, article_master.am_id, article_master.info, article_master.alt_art_no')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_shipment_id, 'packing_shipment_detail.update_after_invoice' => 1))->result();

            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        $nestedData = array();

        foreach ($rs as $val) {

           $inv_rows = $this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left')->get_where('office_invoice_detail', array('office_invoice.packing_shipment_id' => $val->packing_shipment_id, 'office_invoice_detail.office_invoice_id' => $office_invoice_id, 'office_invoice_detail.co_id' => $val->co_id, 'office_invoice_detail.am_id' => $val->am_id, 'office_invoice_detail.lc_id' => $val->leather_id))->num_rows();

           $rs_qnty_total = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, update_after_invoice')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $val->packing_shipment_id, 'packing_shipment_detail.co_id' => $val->co_id, 'packing_shipment_detail.am_id' => $val->am_id, 'packing_shipment_detail.lc_id' => $val->leather_id, 'packing_shipment_detail.status' => 1))->row();

        if(count($rs_qnty_total) > 0) {
            $qnty_total = $rs_qnty_total->article_quantity;
            $status = $rs_qnty_total->update_after_invoice;
        } else {
            $qnty_total = 0;
            $status = 0;
        }

        $rs_qnty_text_show = $this->db->select('update_after_invoice_text')
        ->order_by('packing_shipment_detail.modify_date', 'desc')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $val->packing_shipment_id, 'packing_shipment_detail.co_id' => $val->co_id, 'packing_shipment_detail.am_id' => $val->am_id, 'packing_shipment_detail.lc_id' => $val->leather_id))->result();

        if(count($rs_qnty_text_show) > 0) {
            $update_after_invoice_text = $rs_qnty_text_show[0]->update_after_invoice_text;
        } else {
            $update_after_invoice_text = '';
        }
               
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

            $link_of_detail_page = base_url('admin/packing-list-changes-details/'.$val->packing_shipment_detail_id);
            
            $nestedData['carton_number'] = $val->carton_number;
            $nestedData['order_number'] = $val->co_no;
            $nestedData['article_number'] = $val->art_no;
            $nestedData['alt_article_number'] = $val->alt_art_no;
            $nestedData['leather_color'] = $val->leather_color;
            $nestedData['item'] = $val->item;
            $nestedData['reference'] = $val->reference;
            $nestedData['box_size'] = $carton_item;//$val->box_size;
            $nestedData['quantity'] = $qnty_total;
            $nestedData['gross_weight'] = $val->gross_weight;
            $nestedData['net_weight'] = $net_weight;
            if($inv_rows == 0 && $status == 1) {
            $nestedData['status'] = '<button po-id="'.$val->packing_shipment_detail_id .'" type="button" class="add_btn btn btn-success"> Add </button>';
            } else {
            $nestedData['status'] = $update_after_invoice_text."<br/><a href='". $link_of_detail_page ."' target='_blank'><u>view details</u></a>";
            }
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

    public function packing_list_changes_details($pack_id){

    $data = [];

    $packing_details = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail_id' => $pack_id))->row();

      $data['details'] = $this->db->select('packing_shipment_detail.article_quantity as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment.invoice_status, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, colors.color as leather_color, colors.c_code as leather_code, colors.c_id as leather_id, article_master.art_no, packing_shipment_detail.update_after_invoice_text, customer_order.co_id, article_master.am_id, article_master.info, article_master.alt_art_no')
        ->join('packing_shipment', 'packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id', 'left')
        ->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left')
        ->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left')
        ->join('colors', 'colors.c_id = packing_shipment_detail.lc_id', 'left')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_details->packing_shipment_id, 'packing_shipment_detail.co_id' => $packing_details->co_id, 'packing_shipment_detail.am_id' => $packing_details->am_id, 'packing_shipment_detail.lc_id' => $packing_details->lc_id, 'packing_shipment_detail.update_after_invoice' => 1))->result();

        return array('page'=>'office_invoice/pack_details_list_v.php', 'data'=>$data);

    }

    public function all_items_on_purchase_order_receive_detail($invoice_id){
        $data = [];
    $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.fc_id', 'left');
		$data['office_invoice'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();
	}
	
	
	public function ajax_get_latest_currency_values(){
	    $cur_id_val = $this->input->post('cur_id_val');
	    $effective_date = $this->input->post('effective_date');
		$result = $this->db
		         ->order_by('effective_date', 'desc')
		         ->get_where('currencies_rate', array('currencies_rate.cur_id' => $cur_id_val))->row();
	    if(count($result) > 0) {
	        $rate_inr = $result->rate;
	    } else {
	        $rate_inr = 0.00;
	    }
	    return $rate_inr;
	}
	
	
	public function office_invoice_print($invoice_id){
	    $data = [];
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 8, 'user_id' => $this->session->user_id))->result(); #8 = office invoice
	    
		$this->db->select('notify,office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, ac1.email_id, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.port_of_loading, office_invoice.print_hand_ratio, office_invoice.discount, office_invoice.hand_charge');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
		$data['print_packing_list'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();
        
        $var = $data['print_packing_list'][0]->acc_master_declar_id;
        
        if($var != '') {
        $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
        $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
    }
		
    return array('page'=>'office_invoice/office_invoice_print_v', 'data'=>$data);
    }
    
    public function office_invoice_print_groupwise($invoice_id){
        $data = [];
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 8, 'user_id' => $this->session->user_id))->result(); #8 = office invoice
		$this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.discount, office_invoice.hand_charge, item_groups.group_name');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('article_master.info, customer_order.buyer_reference_no');
		$data['print_packing_list_groupwise'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();
		
// 		echo '<pre>', print_r($data['print_packing_list_groupwise']), '</pre>'; die();

        $var = $data['print_packing_list_groupwise'][0]->acc_master_declar_id;
        
        if($var != '') {
        $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
        $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
    }
		
    return array('page'=>'office_invoice/office_invoice_print_groupwise_v', 'data'=>$data);
    }
    
    
    public function office_invoice_print_hsncodewise($invoice_id){
        $data = [];
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 8, 'user_id' => $this->session->user_id))->result(); #8 = office invoice
		
		$this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.rate_inr, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.discount, office_invoice.hand_charge, item_groups.group_name');
		
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('`article_master`.`remark`', 'article_master.info, customer_order.buyer_reference_no');
		$data['print_packing_list_groupwise'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();
		
// 		echo $this->db->last_query(); die;
// 		echo '<pre>', print_r($data['print_packing_list_groupwise']), '</pre>'; die();

        $var = $data['print_packing_list_groupwise'][0]->acc_master_declar_id;
        
        if($var != '') {
            $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
            $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
        }
		
        return array('page'=>'office_invoice/office_invoice_print_hsncodewise_v', 'data'=>$data);
    }
    
    
    public function office_invoice_print_wo_info_m($invoice_id){
        
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
        
        $data = [];
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 8, 'user_id' => $this->session->user_id))->result(); #8 = office invoice
        
		$this->db->select('notify,office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.port_of_loading, office_invoice.print_hand_ratio, office_invoice.discount, office_invoice.hand_charge');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
		$data['print_packing_list'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();

        $var = $data['print_packing_list'][0]->acc_master_declar_id;
        
        if($var != '') {
        $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
        $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
    }
    return array('page'=>'office_invoice/office_invoice_print_wo_info_v', 'data'=>$data);
    }
    
    public function office_invoice_print_wo_seal($invoice_id){
        $data = [];
		$this->db->select('notify,office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.port_of_loading, office_invoice.print_hand_ratio, office_invoice.discount, office_invoice.hand_charge');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
		$data['print_packing_list'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();

        $var = $data['print_packing_list'][0]->acc_master_declar_id;
        
        if($var != '') {
        $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
        $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
    }
		
    return array('page'=>'office_invoice/office_invoice_print_wo_seal_v', 'data'=>$data);
    }
    
    public function office_invoice_print_wo_info_seal($invoice_id){
        $data = [];
		$this->db->select('notify,office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, customer_order.buyer_reference_no, article_master.art_no, colors.color, colors.c_code, ac1.name as acc_name, ac1.address as acc_address,
		   ac2.name as acc_name2, ac2.address as acc_address2, office_invoice.office_invoice_number, DATE_FORMAT(office_invoice.office_invoice_date, "%d-%m-%Y") as office_invoice_date, office_invoice.terms_of_delivery_payment,
			countries.country, office_invoice.pre_carriage_by, office_invoice.port_of_discharge, office_invoice.description_of_goods, office_invoice.mark_container, office_invoice.no_of_kind_of_package, office_invoice.terms_conditions, office_invoice.ex_rate, office_invoice.gross_weight, office_invoice.net_weight, office_invoice.volume_weight, office_invoice.cust_header_name, office_invoice.acc_master_declar_id, office_invoice.rate_type, currencies.currency, currencies.info,
			article_master.alt_art_no, article_master.info as art_info, article_master.hand_machine, article_master.leather_type_info, article_master.remark, article_master.metal_fitting, article_master.size, article_master.brand, item_master.item as item_name, acc_master_declaration.declaration_subject, office_invoice.port_of_loading, office_invoice.print_hand_ratio, office_invoice.discount, office_invoice.hand_charge');
		$this->db->join('office_invoice', 'office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id', 'left');
		$this->db->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left');
		$this->db->join('item_master', 'item_master.im_id = article_master.carton_id', 'left');
		$this->db->join('colors', 'colors.c_id = office_invoice_detail.lc_id', 'left');
		$this->db->join('acc_master ac1', 'ac1.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master_declaration', 'acc_master_declaration.am_id = office_invoice.am_id', 'left');
		$this->db->join('acc_master ac2', 'ac2.am_id = office_invoice.am_id_other', 'left');
		$this->db->join('countries', 'countries.c_id = ac1.c_id', 'left');
		$this->db->join('currencies', 'currencies.cur_id = office_invoice.cur_id', 'left');
		$this->db->order_by('customer_order.buyer_reference_no, article_master.alt_art_no, colors.color');
		$data['print_packing_list'] = $this->db->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_id' => $invoice_id))->result();

        $var = $data['print_packing_list'][0]->acc_master_declar_id;
        
        if($var != '') {
            $sql = "SELECT DECLARATION_DESCRIPTION, DECLARATION_SUBJECT FROM invoice_declaration WHERE INVOICE_DECLARATION_SEQ IN($var)";
            $data['fetch_individual_declaration_details'] = $this->db->query($sql)->result();
        }
		
        return array('page'=>'office_invoice/office_invoice_print_wo_info_seal_v', 'data'=>$data);
    }

    public function ajax_get_consume_list_purchase_order_receive_detail(){
		$data = array();
		$id_id = $this->input->post('id_id');
		$im_id = $this->input->post('im_id');
        $issue_quantity_preview = $this->input->post('issue_quantity_preview'); //10
		
		$result = $this->db->query('SELECT purchase_order_receive_detail.*, purchase_order_receive.*, item_master.im_id, item_master.item, colors.c_id, colors.color 
FROM purchase_order_receive_detail 
JOIN purchase_order_receive ON purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id 
JOIN item_dtl ON item_dtl.id_id = purchase_order_receive_detail.id_id 
JOIN item_master ON item_master.im_id = item_dtl.im_id
JOIN colors ON colors.c_id = item_dtl.c_id
WHERE purchase_order_receive_detail.material_issue_status = 0 AND  purchase_order_receive_detail.id_id = '.$id_id.'
ORDER BY purchase_order_receive.purchase_order_receive_date')->result();
		
		//echo $this->db->last_query();die;
		//echo json_encode($result);
		
		$preview_data = array();
		
		$a = $issue_quantity_preview;
		for($i = 0; $i < sizeof($result); $i++){
			$preview = new stdClass();
			
			if($a > 0){
				$b = $result[$i]->remain_quantity_for_material_issue; //100
				$item_rate = $result[$i]->item_rate;
				$preview->item_rate = $item_rate;
				$total_rate = 0;
				
				if($b <= $a){
					$r = $a - $b;
					$preview->consumed = $b;
					$total_rate = ($item_rate * $b);
					$preview->total_rate = $total_rate;
				}else{
					if($i == 0){
						$preview->consumed = $a;
						$total_rate = ($item_rate * $a);
						$preview->total_rate = $total_rate;
					}else{
						$preview->consumed = $r;
						$total_rate = ($item_rate * $r);
						$preview->total_rate = $total_rate;
					}
					$r = 0;
				}
			}else{
				break;	
			}
			
			$preview->im_id = $result[$i]->im_id;
			$preview->id_id = $result[$i]->id_id;
			$preview->item_name = $result[$i]->item;
			$preview->c_id = $result[$i]->c_id;
			$preview->color = $result[$i]->color;
			$preview->purchase_order_receive_id = $result[$i]->purchase_order_receive_id;
			$preview->purchase_order_receive_detail_id = $result[$i]->purchase_order_receive_detail_id;
			$preview->purchase_order_receive_detail_id = $result[$i]->purchase_order_receive_detail_id;
			
			array_push($preview_data, $preview);
			
			//echo ' Required = '.$a.' Consumed = '.$b.' Remaining = '.$r;
			//echo "<br/>";
			$a = $r;
		}
		
		$data["preview_data"] = $preview_data;
		
		if(sizeof($preview_data) > 0){
			$data["status"] = true;
		}else{
			$data["status"] = false;
		}
		
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
	
    public function form_add_office_invoice(){
        $data = [];
        $temp = '';
        $dtemp = '';
    	if(count($this->input->post('office_proforma_id')) > 0){
                foreach ($this->input->post('office_proforma_id') as $value) {
                    $temp .= $value . ',';
                }
            }
            if($this->input->post('acc_master_declar_id[]') != ''){
                foreach ($this->input->post('acc_master_declar_id[]') as $dvalue) {
                    $dtemp .= $dvalue . ',';
                }
            }

        $insertArray = array(
			'office_invoice_number' => $this->input->post('office_invoice_number'),
			'office_invoice_date' => $this->input->post('office_invoice_date'),
			'rate_type' => $this->input->post('rate_type'),
			'am_id' => $this->input->post('am_id'),
			'cur_id' => $this->input->post('currency'),
			'packing_shipment_id' => $this->input->post('packing_shipment_id'),
			'pre_carriage_by' => $this->input->post('pre_carriage_by'),
			'port_of_discharge' => $this->input->post('port_of_discharge'),
			'port_of_loading' => $this->input->post('port_of_loading'),
			'terms_conditions' => $this->input->post('terms_conditions'),
			'office_proforma_id' => rtrim($temp, ","),
			'terms_of_delivery_payment' => $this->input->post('terms_of_delivery_payment'),
			'mark_container' => $this->input->post('mark_container'),
			'notify' => $this->input->post('notify'),
			'no_of_kind_of_package' => $this->input->post('no_of_kind_of_package'),
			'description_of_goods' => $this->input->post('description_of_goods'),
			'gross_weight' => $this->input->post('gross_weight'),
			'net_weight' => $this->input->post('net_weight'),
			'volume_weight' => $this->input->post('volume_weight'),
			'ex_rate' => $this->input->post('ex_rate'),
			'conversion_rate' => $this->input->post('conversion_rate'),
			'acc_master_declar_id' => rtrim($dtemp, ","),
			'net_quantity' => $this->input->post('net_qnty'),
			'net_amount' => $this->input->post('net_amnt'),
			'net_amount_inr' => $this->input->post('net_amnt_inr'),
			'discount' => $this->input->post('disc'),
			'hand_charge' => $this->input->post('hand_charge'),
			'grand_total' => $this->input->post('grand_total'),
			'grand_total_inr' => $this->input->post('grand_total_inr'),
			'cust_header_name' => $this->input->post('cust_header_name'),
			'am_id_other' => $this->input->post('am_id_other')
		);	
		
		$this->db->insert('office_invoice', $insertArray);
		//echo $this->db->last_query();
		$office_invoice_id = $this->db->insert_id();
			
		//Array
		$co_id_add = $this->input->post('co_id_add');
		$cod_id_add = $this->input->post('cod_id_add');
		$am_id_detail_add = $this->input->post('am_id_detail_add');
		$fc_id_add = $this->input->post('fc_id_add');
		$lc_id_add = $this->input->post('lc_id_add');
		$item_no_add = $this->input->post('item_no_add');
		$reference_no_add = $this->input->post('reference_no_add');
		$quantity_add = $this->input->post('quantity_add');
		$rate_inr_add = $this->input->post('rate_inr_add');
		$rate_foreign_add = $this->input->post('rate_foreign_add');
		$additional_charges_add = $this->input->post('additional_charges_add');
		$net_rate_add = $this->input->post('net_rate_add');
		$amount_add = $this->input->post('amount_add');
		$amount_inr_add = $this->input->post('amount_add_inr');
		
		for($i = 0; $i < sizeof($co_id_add); $i++){
			$insertArray = array(
				'office_invoice_id' => $office_invoice_id,
				'co_id' => $co_id_add[$i],
				'cod_id' => $cod_id_add[$i],
				'am_id' => $am_id_detail_add[$i],
				'fc_id' => $fc_id_add[$i],
				'lc_id' => $lc_id_add[$i],
				'item_no' => $item_no_add[$i],
				'reference_no' => $reference_no_add[$i],
				'quantity' => $quantity_add[$i],
				'rate_inr' => $rate_inr_add[$i],
				'rate_foreign' => $rate_foreign_add[$i],
				'additional_charges' => $additional_charges_add[$i],
				'net_rate' => $net_rate_add[$i],
				'amount' => $amount_add[$i],
				'amount_inr' => ($amount_add[$i] * $rate_inr_add[$i]),
				'user_id' => $this->session->user_id
			);
			
			$this->db->insert('office_invoice_detail', $insertArray);
		}//end for
       
      $update_array1 = array(
      	'invoice_status' => 1
      );

      $this->db->update('packing_shipment', $update_array1, array('packing_shipment_id' => $this->input->post('packing_shipment_id')));

		if($office_invoice_id > 0){
			$data['office_invoice_id'] = $office_invoice_id;
			$data['type'] = 'success';
			$data['msg'] = 'Office Invoice details added successfully.';
		}else{
			$data['type'] = 'error';
			$data['msg'] = 'Data Insert Error';
		}
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }

    public function add_invoice_details_wrt_packing_id(){
        $data = [];

        $value = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_detail_id' => $this->input->post('pack_detail_id')))->row();
        
        if(count($value) > 0) {
        $rs_qnty_total = $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, update_after_invoice')
        ->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $value->packing_shipment_id, 'packing_shipment_detail.co_id' => $value->co_id, 'packing_shipment_detail.am_id' => $value->am_id, 'packing_shipment_detail.lc_id' => $value->lc_id, 'packing_shipment_detail.status' => 1))->row();

        if(count($rs_qnty_total) > 0) {
            $qnty_total = $rs_qnty_total->article_quantity;
        } else {
            $qnty_total = 0;
        }

        $inv_id = $this->db->get_where('office_invoice', array('office_invoice.packing_shipment_id' => $value->packing_shipment_id))->row()->office_invoice_id;

        $add_inv_num_row = $this->db->get_where('office_invoice_detail', array('office_invoice_id' => $inv_id, 'co_id' => $value->co_id, 'cod_id' => $value->cod_id, 'am_id' => $value->am_id, 'fc_id' => $value->fc_id, 'lc_id' => $value->lc_id))->num_rows();

        if($add_inv_num_row == 0) {
        
                $insertArray = array(
                'office_invoice_id' => $inv_id,
                'co_id' => $value->co_id,
                'cod_id' => $value->cod_id,
                'am_id' => $value->am_id,
                'fc_id' => $value->fc_id,
                'lc_id' => $value->lc_id,
                'item_no' => $value->item,
                'reference_no' => $value->reference ,
                'quantity' => $qnty_total,
                'rate_inr' => 0,
                'rate_foreign' => 0,
                'additional_charges' => 0,
                'net_rate' => 0,
                'amount' => 0,
                'user_id' => $this->session->user_id
            );
            
            $this->db->insert('office_invoice_detail', $insertArray);

            $office_invoice_id = $this->db->insert_id();

            $total_quantity = $this->db->select('net_quantity')->get_where('office_invoice', array('office_invoice_id' => $inv_id))->row()->net_quantity;

            $new_qnty = $total_quantity + $qnty_total; 

            $updateArray = array(
                'net_quantity' => $new_qnty,
                'user_id' => $this->session->user_id
            );

            $this->db->update('office_invoice', $updateArray, array('office_invoice_id' => $inv_id));
       
    }

        if($office_invoice_id > 0){
            $data['office_invoice_id'] = $office_invoice_id;
            $data['qnty'] = $new_qnty;
            $data['type'] = 'success';
            $data['msg'] = 'Office Invoice details added successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Data Not Inserted';
        }
    } else {
        $data['type'] = 'error';
            $data['msg'] = 'Data Not Inserted';
    }
        // echo '<pre>', print_r($data), '</pre>';die;
        return $data;
    }
	

    public function ajax_fetch_office_invoice_details_on_pk(){
        
        $office_invoice_detail_id = $this->input->post('office_invoice_detail_id');
		
		return $this->db->select('office_invoice_detail.office_invoice_detail_id, office_invoice_detail.office_invoice_id, office_invoice_detail.co_id, office_invoice_detail.cod_id, office_invoice_detail.am_id, office_invoice_detail.fc_id, office_invoice_detail.lc_id, office_invoice_detail.item_no, office_invoice_detail.reference_no, office_invoice_detail.quantity, office_invoice_detail.rate_inr, office_invoice_detail.rate_foreign, office_invoice_detail.additional_charges, office_invoice_detail.net_rate, office_invoice_detail.amount, customer_order.co_no, article_master.art_no, colors.color, colors.c_code')
		->join('customer_order', 'customer_order.co_id = office_invoice_detail.co_id', 'left')
		->join('article_master', 'article_master.am_id = office_invoice_detail.am_id', 'left')
		->join('colors', 'colors.c_id = office_invoice_detail.fc_id', 'left')
		->get_where('office_invoice_detail', array('office_invoice_detail.office_invoice_detail_id' => $office_invoice_detail_id))->result();
    }

    public function purchase_order_print_with_code($po_id){
        $data = [];
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
        $data = [];
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


    public function form_edit_office_invoice_details(){
        $data = [];
        $office_invoice_detail_id = $this->input->post('office_invoice_detail_id');
		
		$item_no = $this->input->post('item_edit');
		$reference_no = $this->input->post('reference_edit');
		$quantity = $this->input->post('quantity_edit');
		$rate_inr = $this->input->post('rate_inr_edit');
		$rate_foreign = $this->input->post('rate_foreign_edit');
		$additional_charges = $this->input->post('additional_charges_edit');
		$net_rate = $this->input->post('net_rate_edit');
		$amount = $this->input->post('amount_edit');
		
        $updateArray = array(
            'item_no' => $item_no,
			'reference_no' => $reference_no,
			'quantity' => $quantity,
			'rate_inr' => $rate_inr,
			'rate_foreign' => $rate_foreign,
			'additional_charges' => $additional_charges,
			'net_rate' => $net_rate,
			'amount' => $amount,
            'user_id' => $this->session->user_id
        );
		
		$this->db->update('office_invoice_detail', $updateArray, array('office_invoice_detail_id' => $office_invoice_detail_id));
		
		//Update purchase order receive detail table
        /*$result = $this->db->select('remain_quantity_for_material_issue')->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id))->result()[0];
		
		$remain_quantity_for_material_issue = $result->remain_quantity_for_material_issue;
		
		$remain_quantity_for_material_issue_new = ($remain_quantity_for_material_issue + $issue_quantity_old - $issue_quantity_new);
		
		if($remain_quantity_for_material_issue_new > 0){
			$material_issue_status = 0;
		}else{
			$material_issue_status = 1;
		}
		
        $updateArray= array(
            'remain_quantity_for_material_issue' => $remain_quantity_for_material_issue_new,
			'material_issue_status' => $material_issue_status,
            'user_id' => $this->session->user_id
        );
        $this->db->update('purchase_order_receive_detail', $updateArray, array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id));*/
		
		
        $data['type'] = 'success';
        $data['msg'] = 'Office Invoice details updated successfully.';
        return $data;
    }
	
	public function form_edit_delivery_sgst_cgst_value(){
        $data = [];
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

    public function ajax_get_shipment_list_details_on_packing_id() {
        $data = [];
        $packing_id = $this->input->post('packing_id');

        $this->db->select('sum(packing_shipment_detail.article_quantity) as article_quantity, packing_shipment_detail.packing_shipment_detail_id, packing_shipment_detail.packing_shipment_id, packing_shipment_detail.carton_number, packing_shipment_detail.co_id, packing_shipment_detail.cod_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id, packing_shipment_detail.fc_id, packing_shipment_detail.item, packing_shipment_detail.reference, packing_shipment_detail.box_size, packing_shipment_detail.leather, packing_shipment_detail.fitting, packing_shipment_detail.gross_weight, packing_shipment_detail.net_weight,customer_order.co_no,customer_order.co_date, customer_order.buyer_reference_no,customer_order_dtl.co_id,customer_order_dtl.am_id,customer_order_dtl.fc_id,customer_order_dtl.lc_id,customer_order_dtl.cod_id, customer_order_dtl.co_quantity,customer_order_dtl.co_price,customer_order_dtl.co_buy_reference,customer_order_dtl.co_remarks, c1.color as fitting_color, c1.c_code as leather_code, c1.c_id as leather_id, c2.color as leather_color, c2.c_code as fitting_code, c2.c_id as fitting_id, article_master.art_no, article_master.info, article_master.alt_art_no');
		$this->db->join('customer_order_dtl', 'customer_order_dtl.cod_id = packing_shipment_detail.cod_id', 'left');	
		$this->db->join('customer_order', 'customer_order.co_id = packing_shipment_detail.co_id', 'left');
		$this->db->join('article_master', 'article_master.am_id = packing_shipment_detail.am_id', 'left');
		$this->db->join('colors c1', 'c1.c_id = packing_shipment_detail.fc_id', 'left');
		$this->db->join('colors c2', 'c2.c_id = packing_shipment_detail.lc_id', 'left');
		$this->db->group_by('packing_shipment_detail.co_id, packing_shipment_detail.am_id, packing_shipment_detail.lc_id');
	    $rs = $this->db->get_where('packing_shipment_detail', array('packing_shipment_detail.packing_shipment_id' => $packing_id, 'packing_shipment_detail.status' => 1))->result();

    $data["preview_data"] = $rs;

    if (sizeof($rs) > 0) {
            $data["status"] = true;
        } else {
            $data["status"] = false;
        }

        return $data;
    
    }

    public function delete_office_invoice_header(){
        $data = [];
        $tab = $this->input->post('tab');
		$ref_table = $this->input->post('ref_tab');
		$pk_name = $this->input->post('pk_name');
		$pk_value = $this->input->post('pk_value');
		$ref_value = $this->input->post('ref_value');

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

		$res = $this->db->get_where('office_invoice', array('packing_shipment_id' => $ref_value))->num_rows();

		if($res == 0) {
			$update_array = array(
				'invoice_status' => 0
			);

			$this->db->update('packing_shipment', $update_array, array('packing_shipment_id' => $ref_value));
		}
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Office Invoice Successfully Deleted';
        return $data;
    }
	
	public function delete_material_issue_details_list(){
	    $data = [];
        $tab = $this->input->post('tab');
		$tab_pk = $this->input->post('tab_pk');
		$data_pk = $this->input->post('data_pk');
		
		$reference_tab = $this->input->post('reference_tab');
		$reference_pk = $this->input->post('reference_pk');
		$reference_data_pk = $this->input->post('reference_data_pk');
		
		$issue_quantity = $this->input->post('issue_quantity');
		$purchase_order_receive_detail_id = $this->input->post('purchase_order_receive_detail_id');
		
		$purchase_order_receive_id = $reference_data_pk;
		
		$result = $this->db->select('remain_quantity_for_material_issue')->get_where('purchase_order_receive_detail', array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id))->result()[0];
		
		$remain_quantity_for_material_issue = $result->remain_quantity_for_material_issue;
		
		$remain_quantity_for_material_issue_new = ($remain_quantity_for_material_issue + $issue_quantity);
		
        $updateArray= array(
            'remain_quantity_for_material_issue' => $remain_quantity_for_material_issue_new,
			'material_issue_status' => 0,
            'user_id' => $this->session->user_id
        );
        $this->db->update('purchase_order_receive_detail', $updateArray, array('purchase_order_receive_detail_id' => $purchase_order_receive_detail_id));
				
		$this->db->where($tab_pk, $data_pk)->delete($tab);
		
        $data['title'] = 'Deleted!';
        $data['type'] = 'success';
        $data['msg'] = 'Material issue list Successfully Deleted';
        return $data;
    }

    public function get_rows_number_new_added_packing(){
          $office_invoice_id_edit = $this->input->post('office_invoice_id_edit');
          $packing_id = $this->db->get_where('office_invoice', array('office_invoice_id' => $office_invoice_id_edit))->row()->packing_shipment_id;
         return $rows_num = $this->db->get_where('packing_shipment_detail', array('packing_shipment_id' => $packing_id, 'update_after_invoice' => 1))->num_rows();
    }
    
    public function update_invoice_details_wrt_invoice_id(){
        $data = [];
        $old_array = $this->db->get_where('office_invoice_detail', array('office_invoice_detail_id' => $this->input->post('inv_detail_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('inv_detail_id'), 'office_invoice_detail');

        $inv_detail_id = $this->input->post('inv_detail_id');
        $inv_id = $this->input->post('inv_id');
        $quantity = $this->input->post('quantity');
        $reference = $this->input->post('reference');
        $rate = $this->input->post('rate');
        $rate_fr = $this->input->post('rate_fr');
        $net_ra = $this->input->post('net_ra');
        $item = $this->input->post('item');
        $amnt = $this->input->post('amnt');
        $amnt_inr = $this->input->post('amnt_inr');
        
        $new_amnt = ($quantity * $rate_fr);

        $total_amount_invoice_details = $this->db->select('amount')->get_where('office_invoice_detail', array('office_invoice_detail_id' => $inv_detail_id))->row()->amount;

        $total_quantity_invoice_details = $this->db->select('quantity')->get_where('office_invoice_detail', array('office_invoice_detail_id' => $inv_detail_id))->row()->quantity;

        $total_amount_invoice = $this->db->select('net_amount')->get_where('office_invoice', array('office_invoice_id' => $inv_id))->row()->net_amount;

        $total_hand_charge_invoice = $this->db->select('hand_charge')->get_where('office_invoice', array('office_invoice_id' => $inv_id))->row()->hand_charge;

        $total_discount_invoice = $this->db->select('discount')->get_where('office_invoice', array('office_invoice_id' => $inv_id))->row()->discount;

        $total_quantity = $this->db->select('net_quantity')->get_where('office_invoice', array('office_invoice_id' => $inv_id))->row()->net_quantity;

        $new_amount_invoice = ($total_amount_invoice - $total_amount_invoice_details + $new_amnt);

        $grand_amount_invoice = ($new_amount_invoice - ($new_amount_invoice * ($total_discount_invoice / 100)) + $total_hand_charge_invoice);

        $new_qantity = $total_quantity - $total_quantity_invoice_details + $quantity;

        $updateArray = array(
                'net_amount' => $new_amount_invoice,
                'grand_total' => $grand_amount_invoice,
                'net_amount_inr' => ($new_amount_invoice * $rate),
                'grand_total_inr' => ($grand_amount_invoice * $rate),
                'net_quantity' => $new_qantity,
                'user_id' => $this->session->user_id
            );

            $this->db->update('office_invoice', $updateArray, array('office_invoice_id' => $inv_id)); 

        $insertArray = array(
                'office_invoice_id' => $inv_id,
                'item_no' => $item,
                'reference_no' => $reference,
                'quantity' => $quantity,
                'rate_inr' => $rate,
                'rate_foreign' => $rate_fr,
                'net_rate' => $net_ra,
                'amount' => $new_amnt,
                'amount_inr' => ($new_amnt * $rate),
                'user_id' => $this->session->user_id
            );

        $rs = $this->db->update('office_invoice_detail', $insertArray, array('office_invoice_detail_id' => $inv_detail_id));

        if($rs == 1){
            $data['type'] = 'success';
            $data['total_net_amount_new'] = $new_amount_invoice;
            $data['total_grand_amount_new'] = $grand_amount_invoice;
            $data['total_net_amount_new_inr'] = ($new_amount_invoice * $rate);
            $data['total_grand_amount_new_inr'] = ($grand_amount_invoice * $rate);
            $data['total_quantity'] = $new_qantity;
            $data['individual_amount'] = $new_amnt;
            $data['msg'] = 'Invoice details updated successfully.';
        }else{
            $data['type'] = 'error';
            $data['msg'] = 'Not Updated';
        }

        return $data;

    }
    
    // purchase ORDER ENDS 

}