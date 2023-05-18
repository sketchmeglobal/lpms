<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:30
 * Last updated on 04-Jan-2021 at 7:45 pm
 */

class Report_item_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
    }

    public function report_item() {
        $data = '';
        return array('page'=>'reports/report_item_v', 'data'=>$data);
    }
	
	
	public function ajax_item_detail_table_data() {
        //actual db table column names
        $column_orderable = array(
			0 => 'im_id'
        );
        // Set searchable column fields
        $column_search = array('group_name', 'item_master.item', 'sizes.size', 'shapes.shape');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get('item_dtl')->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
			$this->db->select('item_dtl.*, FORMAT(item_dtl.opn_qnty_for_leather_status, 2) as opn_qnty_for_leather_status,
                acc_master.name as supplier, item_rates.purchase_rate, item_rates.cost_rate, item_master.item, item_master.im_code, item_master.thick, sizes.size, shapes.shape, item_groups.ig_code, item_groups.group_name, units.unit, units.info, colors.color, colors.c_code');
			$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
			$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
			$this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
			$this->db->join('sizes', 'sizes.sz_id = item_master.sz_id', 'left');
			$this->db->join('shapes', 'shapes.sh_id = item_master.sh_id', 'left');
			$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
			$this->db->join('item_rates', 'item_rates.id_id = item_dtl.id_id', 'left');
			$this->db->join('acc_master', 'item_rates.am_id = acc_master.am_id', 'left');

            $rs = $this->db->get_where('item_dtl', array('item_dtl.status => 1'))->result();
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

            $this->db->select('item_dtl.*, FORMAT(item_dtl.opn_qnty_for_leather_status, 2)  as opn_qnty_for_leather_status, acc_master.name as supplier, item_rates.purchase_rate, item_rates.cost_rate, item_master.item, item_master.im_code, item_master.thick, sizes.size, shapes.shape, item_groups.ig_code, item_groups.group_name, units.unit, units.info, colors.color, colors.c_code');
            // $this->db->from('item_dtl');
			$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
			$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
			$this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
			$this->db->join('sizes', 'sizes.sz_id = item_master.sz_id', 'left');
			$this->db->join('shapes', 'shapes.sh_id = item_master.sh_id', 'left');
			$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
			$this->db->join('item_rates', 'item_rates.id_id = item_dtl.id_id', 'left');
            $this->db->join('acc_master', 'item_rates.am_id = acc_master.am_id', 'left');
// 			echo $this->db->get_compiled_select(); die;
            $rs = $this->db->get_where('item_dtl', array('item_dtl.status' => 1))->result();

            $totalFiltered = count($rs);

            $this->db->limit($limit, $start);
            $this->db->order_by($order, $dir);
            
			$this->db->select('item_dtl.*, FORMAT(item_dtl.opn_qnty_for_leather_status, 2) as opn_qnty_for_leather_status, acc_master.name as supplier, item_rates.purchase_rate, item_rates.cost_rate, item_master.item, item_master.im_code, item_master.thick, sizes.size, shapes.shape, item_groups.ig_code, item_groups.group_name, units.unit, units.info, colors.color, colors.c_code');
			$this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
			$this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
			$this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
			$this->db->join('sizes', 'sizes.sz_id = item_master.sz_id', 'left');
			$this->db->join('shapes', 'shapes.sh_id = item_master.sh_id', 'left');
			$this->db->join('units', 'units.u_id = item_master.u_id', 'left');
			$this->db->join('item_rates', 'item_rates.id_id = item_dtl.id_id', 'left');
			$this->db->join('acc_master', 'item_rates.am_id = acc_master.am_id', 'left');

            $rs = $this->db->get_where('item_dtl', array('item_dtl.status' => 1))->result();
			
            $this->db->flush_cache();
        }

        $data = array();

        //echo '<pre>', print_r($rs), '</pre>'; die;
        //echo $this->db->last_query();die;
        $nestedData = [];
        foreach ($rs as $val) {

            //if($val->supp_status == '1'){$status='Enable';} else{$status='Disable';}
            $img_url = base_url('assets/admin_panel/img/item_img/'. $val->img);
            $nestedData['img'] = '<img width="50px" src="'.$img_url.'" alt="" />';
            
            $nestedData['item_detail_id'] = $val->id_id;
            $nestedData['item_group_name'] = $val->group_name.' ['.$val->ig_code.']';
			$nestedData['item_code'] = $val->im_code;			
            $nestedData['item_name'] = $val->item;
            $nestedData['color'] = $val->color;
			$nestedData['supplier'] = $val->supplier;
            $nestedData['opening_stock_for_leather_status'] = $val->opn_qnty_for_leather_status;
			$nestedData['purchase_rate'] = $val->purchase_rate;
			$nestedData['cost_rate'] = $val->cost_rate;
						
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

}//end ctrl