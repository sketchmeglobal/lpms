    <?php
    /**
     * Coded by: Pran Krishna Das
     * Social: www.fb.com/pran93
     * CI: 3.0.6
     * Date: 11-03-2020
     * Time: 09:30
     * Last updated on 25-Mar-2021 at 11:00 am print_multiple_article_costing
     */

    class Transactions_m extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        private function _dept_wise_module_permission($module_id,$user){

            $dept_id = $this->db->get_where('user_details', array('user_id' => $user))->result()[0]->user_dept;
            if($dept_id != NULL){
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
            'comment' => 'Transaction'
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
                'comment' => 'Transaction'
            );
            if($this->db->insert('user_logs', $insertArray)){
                return true;
            }else{
                return false;
            }
        }
    }

        public function article_costing() {
            $data = [];
            $data["view_permission"] = $this->_user_wise_view_permission(2, $this->session->user_id);
            return array('page'=>'transactions/article_costing_list_v', 'data'=>$data);
        }

        public function add_article_costing() {

            // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            if($module_permission == 'show'){
                $this->db->select('article_master.*, article_groups.group_name');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->where('article_master.am_id NOT IN (select article_costing.am_id from article_costing)',NULL,FALSE);
                $data['article_masters'] = $this->db->get_where('article_master', array('article_master.status'=>'1'))->result_array();
            } else {
                $this->db->select('article_master.*, article_groups.group_name');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('user_details','user_details.user_id = article_master.user_id','left');
                $this->db->where('article_master.am_id NOT IN (select article_costing.am_id from article_costing)',NULL,FALSE);
                $data['article_masters'] = $this->db->get_where('article_master', array('article_master.status'=>'1', 'user_details.user_dept' => $module_permission))->result_array();
                #module_permission contains the dept id now
                
            }

            

            return array('page'=>'transactions/article_costing_add_v', 'data'=>$data);
        }

        public function form_add_article_costing() {
            $data_insert['am_id'] = $this->input->post('am_id');
            $data_insert['remark'] = $this->input->post('remark');
            $data_insert['combination_or_not'] = $this->input->post('combination_or_not');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $this->db->insert('article_costing', $data_insert);
            $article_costing_insert_id = $this->db->insert_id();

            //insert fix charges
            $this->db->where('charge_group', 'Charge');
            $this->db->where('fix', 'Yes');
            $this->db->where('status', '1');
            $rs = $this->db->get('charges')->result();
            $data_insert_batch = array();
            foreach ($rs as $val) {
                $nestdata['ac_id'] = $article_costing_insert_id;
                $nestdata['c_id'] = $val->c_id;
                $nestdata['percentage'] = $val->percentage;
                $nestdata['quantity'] = '1';
                $nestdata['rate'] = $val->amount;
                $nestdata['status'] = '1';
                $nestdata['user_id'] = $this->session->user_id;

                $data_insert_batch[] = $nestdata;
            }
            $this->db->insert_batch('article_costing_charges', $data_insert_batch);

            $data['insert_id'] = $article_costing_insert_id;
            $data['type'] = 'success';
            $data['msg'] = 'Article costing added successfully.';
            return $data;
        }

        public function edit_article_costing($ac_id) {

            $data['item_group_details'] = $this->db->select('ig_id,group_name,status')->get_where('item_groups', array('status' => 1))->result();

            $this->db->select('article_costing.*, article_master.art_no');
            $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
            $this->db->where('ac_id', $ac_id);
            $data['article_costing'] = $this->db->get('article_costing')->row();

            $this->db->select('article_master.*, article_groups.group_name');
            $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
            $data['article_masters'] = $this->db->get_where('article_master', array('article_master.status'=>'1'))->result_array();

            $this->db->where('am_id', $data['article_costing']->am_id);
            $row = $this->db->get('article_master')->row();
           
            if(count((array)$row) > 0 && $row->img){$img = $row->img;} else{$img='default.png';}
            $data['img'] = $img;

            $this->db->select('article_dtl.*, colors1.color as lth_color, colors2.color as fit_color');
            $this->db->join('colors colors1', 'colors1.c_id = article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors2', 'colors2.c_id = article_dtl.fit_color_id', 'left');
            $this->db->where('am_id', $data['article_costing']->am_id);
            $this->db->where('article_dtl.status', '1');
            $data['article_details'] = $this->db->get('article_dtl')->result_array();

            $this->db->select('item_dtl.*, colors.color, item_master.item, item_groups.group_name, item_groups.value, units.unit');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
            $data['item_dtls'] = $this->db->get_where('item_dtl', array('item_dtl.status'=>'1'))->result_array();

            $data['charges'] = $this->db->get_where('charges', array('charges.status'=>'1'))->result_array();
            $data['charges_with_percentage'] = $this->db
                    ->select('charges.c_id, charges.charge, charges.percentage, charges.status')
                    ->from('charges')
                    ->where("charges.c_id NOT IN (select article_costing_charges.c_id from article_costing_charges where article_costing_charges.ac_id = $ac_id)",NULL,FALSE)
                    ->where('charges.status', 1)
                    ->where('charges.is_percentage', 1)
                    ->get()->result_array();

            $am_id = $this->db->where('ac_id', $ac_id)->get('article_costing')->result()[0]->am_id;
            
            $data['measurement_items'] = $this->db->select('item_groups.ig_id,item_master.item as item_name, item_dtl.id_id, colors.color')
                    ->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left')
                    ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                    ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                    ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                    ->order_by('item_groups.sort_order')
                    ->group_by('item_dtl.id_id')
                    ->where('ac_id', $ac_id)->where('item_master.status', 1)
                    ->get('article_costing_measurements')->result_array();

            $data['color_for_costing_table'] = $this->db->select('item_master.item as item_name, item_dtl.id_id, colors.color, item_groups.ig_id, item_master.im_id')
                    ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                    ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                    ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                    ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                    ->order_by('item_groups.sort_order')
                    ->group_by('item_dtl.id_id')
                    ->where('ac_id', $ac_id)->where('item_master.status', 1)
                    ->where('item_groups.ig_id', 6)
                    ->get('article_costing_details')->result_array();

            $data['color_for_measurement_table'] = $this->db->select('item_master.item as item_name, item_dtl.id_id, colors.color, item_groups.ig_id, item_master.im_id')
                    ->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left')
                    ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                    ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                    ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                    ->order_by('item_groups.sort_order')
                    ->group_by('item_dtl.id_id')
                    ->where('ac_id', $ac_id)->where('item_master.status', 1)
                    ->where('item_groups.ig_id', 6)
                    ->get('article_costing_measurements')->result_array();

            $data['measurement_colors_old'] = array_merge($data['color_for_costing_table'], $data['color_for_measurement_table']);

            $data['measurement_colors'] = array();
    foreach($data['measurement_colors_old'] as $element) {
        if(!isset($data['measurement_colors'][$element["id_id"]])) {
            $data['measurement_colors'][$element["id_id"]] = $element;
        }
    }            
            // echo '<pre>', print_r($data['measurement_colors']), '</pre>'; die();
            $data['article_cost'] = $this->db->select('exworks_amt, cf_amt, fob_amt')->where('am_id', $am_id)->get('article_master')->result();
            
            $data['total_measurement_pieces'] = $this->db->select('sum(pieces) as pcs')->get_where('article_costing_measurements', array('ac_id' => $ac_id))->result();
            
            $this->db->join('acc_groups', 'acc_groups.ag_id = acc_master.ag_id', 'left');
        $this->db->where('acc_groups.ag_id', 1); // changed for item rate
        $this->db->where('acc_master.status', '1');
        $data['acc_master'] = $this->db->get('acc_master')->result_array();

            return array('page'=>'transactions/article_costing_edit_v', 'data'=>$data);
        }

        public function clone_article_costing($ac_id) {

            // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            $data['item_group_details'] = $this->db->select('ig_id,group_name,status')->get_where('item_groups', array('status' => 1))->result();
            //remove data from temp_article_costing table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing');
            //copy article_costing table
            $rs = $this->db->get_where('article_costing', array('ac_id' => $ac_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['ac_id'] = $val->ac_id;
                    $nestdata['am_id'] = $val->am_id;
                    $nestdata['remark'] = $val->remark;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_costing', $insert_data);
            }

            //remove data from temp_article_costing_measurements table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_measurements');
            //copy article_costing_measurements table
            $rs = $this->db->get_where('article_costing_measurements', array('ac_id' => $ac_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['acm_id'] = $val->acm_id;
                    $nestdata['ac_id'] = $val->ac_id;
                    $nestdata['id_id'] = $val->id_id;
                    $nestdata['length'] = $val->length;
                    $nestdata['width'] = $val->width;
                    $nestdata['pieces'] = $val->pieces;
                    $nestdata['area1'] = $val->area1;
                    $nestdata['area2'] = $val->area2;
                    $nestdata['wastage_percentage'] = $val->wastage_percentage;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_costing_measurements', $insert_data); 

            }

            //remove data from temp_article_costing_details table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_details');
            //copy article_costing_details table
            $rs = $this->db->get_where('article_costing_details', array('ac_id' => $ac_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['acd_id'] = $val->acd_id;
                    $nestdata['ac_id'] = $val->ac_id;
                    $nestdata['id_id'] = $val->id_id;
                    $nestdata['quantity'] = $val->quantity;
                    $nestdata['rate'] = $val->rate;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_costing_details', $insert_data);
            }

            //remove data from temp_article_costing_charges table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_charges');
            //copy article_costing_charges table
            $rs = $this->db->get_where('article_costing_charges', array('ac_id' => $ac_id))->result();
            if(count($rs) > 0) {
                $insert_data = array();
                $nestdata = array();
                foreach ($rs as $val) {
                    $nestdata['acc_id'] = $val->acc_id;
                    
                    $nestdata['ac_id'] = $val->ac_id;
                    $nestdata['c_id'] = $val->c_id;
                    $nestdata['percentage'] = $val->percentage;
                    $nestdata['quantity'] = $val->quantity;
                    $nestdata['rate'] = $val->rate;
                    $nestdata['status'] = $val->status;
                    $nestdata['user_id'] = $this->session->user_id;

                    $insert_data[] = $nestdata;
                }
                $this->db->insert_batch('temp_article_costing_charges', $insert_data);
            }



            $this->db->select('temp_article_costing.*, article_master.art_no');
            $this->db->join('article_master', 'article_master.am_id = temp_article_costing.am_id', 'left');
            $this->db->where('ac_id', $ac_id);
            $data['article_costing'] = $this->db->get('temp_article_costing')->row();

            $this->db->select('article_master.*, article_groups.group_name');
            $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
            $this->db->where('article_master.am_id NOT IN (select article_costing.am_id from article_costing)',NULL,FALSE);

            if($module_permission == 'show'){
                $data['article_masters'] = $this->db->get_where('article_master', array('article_master.status'=>'1'))->result_array();
            } else {
                $this->db->join('user_details','user_details.user_id = article_master.user_id','left');
                $data['article_masters'] = $this->db->get_where('article_master', array('article_master.status'=>'1', 'user_details.user_dept' => $module_permission))->result_array();
                #module_permission contains the dept id now
                
            }

            $this->db->where('am_id', $data['article_costing']->am_id);
            $row = $this->db->get('article_master')->row();
            if(count($row) > 0 && $row->img){$img = $row->img;} else{$img='default.png';}
            $data['img'] = $img;

            $this->db->select('article_dtl.*, colors1.color as lth_color, colors2.color as fit_color');
            $this->db->join('colors colors1', 'colors1.c_id = article_dtl.lth_color_id', 'left');
            $this->db->join('colors colors2', 'colors2.c_id = article_dtl.fit_color_id', 'left');
            $this->db->where('am_id', $data['article_costing']->am_id);
            $this->db->where('article_dtl.status', '1');
            $data['article_details'] = $this->db->get('article_dtl')->result_array();

            $this->db->select('item_dtl.*, colors.color, item_master.item, item_groups.group_name, item_groups.value, units.unit');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
            $data['item_dtls'] = $this->db->get_where('item_dtl', array('item_dtl.status'=>'1'))->result_array();

            $data['charges'] = $this->db->get_where('charges', array('charges.status'=>'1'))->result_array();
            $data['charges_with_percentage'] = $this->db
                    ->select('charges.c_id, charges.charge, charges.percentage, charges.status')
                    ->from('charges')
                    ->where("charges.c_id NOT IN (select article_costing_charges.c_id from article_costing_charges where article_costing_charges.ac_id = $ac_id)",NULL,FALSE)
                    ->where('charges.status', 1)
                    ->where('charges.is_percentage', 1)
                    ->get()->result_array();
            $data['measurement_items'] = $this->db->select('item_groups.ig_id,item_master.item as item_name, item_dtl.id_id, colors.color')
                    ->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left')
                    ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                    ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                    ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                    ->order_by('item_groups.sort_order')
                    ->group_by('item_dtl.id_id')
                    ->where('ac_id', $ac_id)->where('item_master.status', 1)
                    ->get('article_costing_measurements')->result_array();

            $am_id = $this->db->where('ac_id', $ac_id)->get('article_costing')->result()[0]->am_id;
            $data['article_cost'] = $this->db->select('exworks_amt, cf_amt, fob_amt')->where('am_id', $am_id)->get('article_master')->result();
            $data['total_measurement_pieces'] = $this->db->select('sum(pieces) as pcs')->get_where('temp_article_costing_measurements', array('ac_id' => $ac_id))->result();
            return array('page'=>'transactions/article_costing_clone_v', 'data'=>$data);
        }


        public function print_article_costing($ac_id) {
            
            if($this->input->post()){
            
                $setup_array = array(
                    'front_page' => $this->input->post('first_page_row'),
                    'other_page' => $this->input->post('other_page_row'),
                    'module_id' => $this->input->post('module_id'),
                    'user_id' => $this->input->post('user_id')
                );
                
                $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
                
                if($nr == 0){
                    
                    #insert
                    if($this->input->post('module_id') != NULL and $this->input->post('user_id') != NULL){
                        $this->db->insert('page_setup', $setup_array);
                    }
                    
                }else{
                    
                    #update
                    $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                    
                }
                
                
            }
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 1, 'user_id' => $this->session->user_id))->result(); # 1 = Article Costing
         
        // echo '<pre>', print_r($data['page_setup']), '</pre>'; die();
            
            // echo $ac_id; 
            $data['costing'] = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.group_name, colors.color, 
                                item_master.item as item_name, item_master.im_code as item_master_code, im1.item as cartoon_size, acc_master.name as customer_name,
                                article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                            ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
                            ->order_by('item_groups.sort_order')
                            ->get_where('article_costing_details', array('article_costing.ac_id' => $ac_id, 'article_costing.status' => 1, 
                                'article_costing_details.status'=> 1))->result();

            $data['charges'] = $this->db
                            ->select('article_costing_charges.quantity as charge_qnty, article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('article_costing_charges.ac_id', $ac_id)
                            ->where('article_costing_charges.status', 1)
                            ->get('article_costing_charges')->result();
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
            return array('page'=>'transactions/article_costing_print', 'data'=>$data);
        }
        
         public function print_multiple_article_costing() {
        
        
        $data = '';
        
        $group_array = [];

        if($this->input->post('supplier_wise_item_position')){
            $am_id = $this->input->post('supp_second');
            $group = $this->input->post('gropus[]');
            for ($i = 0; $i < count($group); $i++) {
            $data['result'][] = $this->_print_multiple_article_costing_details($am_id, $group[$i]);
            }
            
            return array('page'=>'transactions/article_costing_multiple_prints', 'data'=>$data);
            
            
        }
        
        
                $this->db->select('article_costing.*, article_master.*, article_groups.group_name, acc_master.name'); // article_master.art_no,article_master.info,article_master.img
                $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
        $data['fetch_articles_all_costing'] = $this->db->get('article_costing')->result();        
                
                
        $fetch_all_group = $this->db->get_where('item_groups', array('status' => 1))->result();
        $data['buyers'] = $this->db->get_where('acc_master', array('ag_id' => 2, 'status' => 1))->result();
        $etch_all_charge_arrays = $this->db->get_where('charges', array('status' => 1))->result();
        foreach($fetch_all_group as $f_a_g) {
            
            $group_arrays = array(
            'gr_ids' => 'items-'.$f_a_g->ig_id,
            'gr_names' => $f_a_g->group_name,
            'gr_vals' => 'items',
            );
            array_push($group_array, $group_arrays);
        }
        foreach($etch_all_charge_arrays as $f_a_c_a) {
            
            $group_arrays = array(
            'gr_ids' => 'charges-'.$f_a_c_a->c_id,
            'gr_names' => $f_a_c_a->charge,
            'gr_vals' => 'charges',
            );
            array_push($group_array, $group_arrays);
        }
        $data['group_arrays'] = $group_array;
        return array('page'=>'transactions/article_costing_multiple_prints_v', 'data'=>$data);
    }
    
    public function _print_multiple_article_costing_details($am_id, $ac_id) {
            
            if($this->input->post()){
            
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
                'user_id' => $this->input->post('user_id')
            );
            
            $nr = $this->db->get_where('page_setup', array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')))->num_rows();
            
            if($nr == 0){
                
                #insert
                if($this->input->post('module_id') != NULL and $this->input->post('user_id') != NULL){
                    $this->db->insert('page_setup', $setup_array);
                }
                
            }else{
                
                #update
                $this->db->update('page_setup',$setup_array,array('module_id' => $this->input->post('module_id'), 'user_id' => $this->input->post('user_id')));
                
            }
            
            
        }
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 1, 'user_id' => $this->session->user_id))->result(); # 1 = Article Costing
         
        // echo '<pre>', print_r($data['page_setup']), '</pre>'; die();
            
            // echo $ac_id;
            $data['costing'] = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.group_name, colors.color, 
                                item_master.item as item_name, item_master.im_code as item_master_code, im1.item as cartoon_size, acc_master.name as customer_name,
                                article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                            ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
                            ->order_by('item_groups.sort_order')
                            ->get_where('article_costing_details', array('article_costing.ac_id' => $ac_id, 'article_costing.status' => 1, 
                                'article_costing_details.status'=> 1))->result();

            $data['charges'] = $this->db
                            ->select('article_costing_charges.quantity as charge_qnty, article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('article_costing_charges.ac_id', $ac_id)
                            ->where('article_costing_charges.status', 1)
                            ->get('article_costing_charges')->result();
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
                return $data;
        }

        public function print_article_costing_wo_rate($ac_id) {
            // echo $ac_id; 
            $data['costing'] = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.group_name, colors.color, 
                                item_master.item as item_name, item_master.im_code as item_master_code, im1.item as cartoon_size, acc_master.name as customer_name,
                                article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                            ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
                            ->order_by('item_groups.sort_order')
                            ->get_where('article_costing_details', array('article_costing.ac_id' => $ac_id, 'article_costing.status' => 1, 
                                'article_costing_details.status'=> 1))->result();

            $data['charges'] = $this->db
                            ->select('article_costing_charges.quantity as charge_qnty, article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('article_costing_charges.ac_id', $ac_id)
                            ->where('article_costing_charges.status', 1)
                            ->get('article_costing_charges')->result();
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
            return array('page'=>'transactions/article_costing_print_wo_rate', 'data'=>$data);
        }

        public function print_article_costing_ms($ac_id) {
            
            if($this->input->post()){
            
            $setup_array = array(
                'front_page' => $this->input->post('first_page_row'),
                'other_page' => $this->input->post('other_page_row'),
                'module_id' => $this->input->post('module_id'),
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
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' => 1, 'user_id' => $this->session->user_id))->result(); # 1 = Article Costing
            
            // echo $ac_id; 
                 $this->db->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_costing_measurements.*, item_master.item as item_name, colors.color, units.unit, item_groups.group_name, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $this->db->join('article_costing', 'article_costing.ac_id = article_costing_measurements.ac_id', 'left');
                $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
                $data['costing_measurement'] = $this->db->order_by('group_name, item, article_costing_measurements.acm_id')->get_where('article_costing_measurements', array('article_costing_measurements.ac_id'=>$ac_id, 'article_costing.status' => 1))->result();
                
                // echo '<pre>', print_r($data), '</pre>';
                // echo $this->db->last_query(); die;
            return array('page'=>'transactions/article_costing_print_ms', 'data'=>$data);
        }

        public function calculate_article_costing($ac_id) {
            // echo $ac_id; 
            $data['costing'] = $this->db
                            ->select('article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->get_where('article_costing_details', array('article_costing_details.ac_id' => $ac_id,'article_costing_details.status'=> 1))->result();

            $data['charges'] = $this->db
                            ->select('charges.charge as charge_name, charges.charge_group, article_costing_charges.quantity as charge_qnty, 
                                article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage,
                                charges.amount as charge_amount')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('article_costing_charges.ac_id', $ac_id)
                            ->where('article_costing_charges.status', 1)
                            ->get('article_costing_charges')->result();
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
            return $data;
        }

        
        public function calculate_article_costing_clone($ac_id) {
            // echo $ac_id; 
            $data['costing'] = $this->db
                            ->select('temp_article_costing_details.quantity as cost_qnty, temp_article_costing_details.rate as cost_rate')
                            ->get_where('temp_article_costing_details', array('temp_article_costing_details.ac_id' => $ac_id,'temp_article_costing_details.status'=> 1))->result();

            $data['charges'] = $this->db
                            ->select('charges.charge as charge_name, charges.charge_group, temp_article_costing_charges.quantity as charge_qnty, 
                            temp_article_costing_charges.rate as charge_rate,temp_article_costing_charges.percentage as charge_percentage,
                                charges.amount as charge_amount')
                            ->join('charges', 'charges.c_id = temp_article_costing_charges.c_id', 'left')
                            ->where('temp_article_costing_charges.ac_id', $ac_id)
                            ->where('temp_article_costing_charges.status', 1)
                            ->get('temp_article_costing_charges')->result();
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
            return $data;
        }


        public function form_edit_article_costing() {

            $old_array = $this->db->get_where('article_costing', array('ac_id' => $this->input->post('article_costing_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('article_costing_id'), 'article_costing');

            $article_costing_id = $this->input->post('article_costing_id');
            $data_update['am_id'] = $this->input->post('am_id');
            $data_update['remark'] = $this->input->post('remark');
            $data_update['combination_or_not'] = $this->input->post('combination_or_not');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;
            $this->db->where('ac_id', $article_costing_id);
            $this->db->update('article_costing', $data_update);
            $data['type'] = 'success';
            $data['msg'] = 'Article costing updated successfully.';
            $am_id = $this->db->where('ac_id', $article_costing_id)->get('article_costing')->result()[0]->am_id;        
            // lastest db values
            $pres = $this->db->select('exworks_amt, cf_amt, fob_amt')->where('am_id', $am_id)->get('article_master')->result();
            // echo '<pre>', print_r($pres), '</pre>';
            
            if(($pres[0]->exworks_amt != $this->input->post('exworks_amt')) or ($pres[0]->cf_amt != $this->input->post('cf_amt')) or ($pres[0]->cf_amt != $this->input->post('fob_amt'))){
                        // update article master table 
                $data_update_am['exworks_amt'] = $this->input->post('exworks_amt');
                $data_update_am['cf_amt'] = $this->input->post('cf_amt');
                $data_update_am['fob_amt'] = $this->input->post('fob_amt');

                $res = $this->db->where('am_id', $am_id)->update('article_master', $data_update_am);
                
                if($res){
                    $data['msg'] .= '<hr />Article master also updated';
                }
            }
            
            $article_master_row = $this->db->get_where('article_rates', array('am_id' => $am_id))->num_rows();
                
                if($article_master_row > 0) {
                    
                    $res11 = $this->db->where('am_id', $am_id)->update('article_rates', $data_update_am);
                    
                    if($res11){
                    $data['msg'] .= '<hr />Article rates also updated';
                }
                    
                }

            
            return $data;
        }
        public function form_edit_article_costing_clone() {
            $article_costing_id = $this->input->post('article_costing_id');
            $data_update['am_id'] = $this->input->post('am_id');
            $data_update['remark'] = $this->input->post('remark');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;
            $this->db->where('ac_id', $article_costing_id);
            $this->db->update('temp_article_costing', $data_update);


            //copy temp_article_costing table
            $this->db->select('am_id,remark,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_costing', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_costing', $rs);
            }
            $ac_id = $this->db->insert_id();
            //remove data from temp_article_costing table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing');

            //update ac_id (article-costing ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_costing_measurements', array('ac_id'=>$ac_id));
            //copy temp_article_costing_measurements table
            $this->db->select('ac_id,id_id,length,width,pieces,wastage_percentage,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_costing_measurements', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_costing_measurements', $rs);
            }
            //remove data from temp_article_costing_measurements table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_measurements');

            //update ac_id (article-costing ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_costing_details', array('ac_id'=>$ac_id));
            //copy temp_article_costing_details table
            $this->db->select('ac_id,id_id,quantity,rate,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_costing_details', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_costing_details', $rs);
            }
            //remove data from temp_article_costing_details table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_details');

            //update ac_id (article-costing ID)
            $this->db->where('user_id', $this->session->user_id);
            $this->db->update('temp_article_costing_charges', array('ac_id'=>$ac_id));
            //copy temp_article_costing_charges table
            $this->db->select('ac_id,c_id,percentage,quantity,rate,status,user_id,create_date,modify_date');
            $rs = $this->db->get_where('temp_article_costing_charges', array('user_id' => $this->session->user_id))->result();
            if(count($rs) > 0) {
                $this->db->insert_batch('article_costing_charges', $rs);
            }
            //remove data from temp_article_costing_charges table
            $this->db->where('user_id', $this->session->user_id);
            $this->db->delete('temp_article_costing_charges');


            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('msg', 'Article costing cloned successfully.');
            $data['url'] = base_url('admin/article_costing');

            $am_id = $this->input->post('am_id');
            $data_update_am['exworks_amt'] = $this->input->post('exworks_amt');
            $data_update_am['cf_amt'] = $this->input->post('cf_amt');
            $data_update_am['fob_amt'] = $this->input->post('fob_amt');

            $res = $this->db->where('am_id', $am_id)->update('article_master', $data_update_am);

            // UPDATE PART IN MASTER
            $query_to_update_part = "UPDATE 
            `article_parts` AS `dest`,
                (
                    SELECT `temp_article_costing_measurements`.`ac_id`, `temp_article_costing_measurements`.`id_id`, `item_dtl`.`im_id`, `item_master`.`ig_id`, `temp_article_costing`.`am_id`, sum(pieces) AS pcs FROM `temp_article_costing_measurements`
                    left join `temp_article_costing` on `temp_article_costing_measurements`.`ac_id` = `temp_article_costing`.`ac_id`
                    left join `item_dtl` on `temp_article_costing_measurements`.`id_id` = `item_dtl`.`id_id`
                    left join `item_master` on `item_dtl`.`im_id` = `item_master`.`im_id`
                    where `temp_article_costing`.`ac_id` = ".$article_costing_id." group by ig_id
                ) AS `src`
            SET
                `dest`.`quantity` = `src`.`pcs` + `dest`.`quantity`
            WHERE
                `dest`.`am_id` = `src`.`am_id`
                and `dest`.`ig_id` = `src`.`ig_id`";

            $this->db->query($query_to_update_part);   

            return $data;
        }

        public function form_add_article_measurement() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['id_id'] = $this->input->post('id_id');
            $data_insert['length'] = $this->input->post('length');
            $data_insert['width'] = $this->input->post('width');
            $data_insert['pieces'] = $this->input->post('pieces');
            $data_insert['wastage_percentage'] = $this->input->post('wastage_percentage');
            $data_insert['area1'] = $this->input->post('area1');
            $data_insert['area2'] = $this->input->post('area2');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $this->db->insert('article_costing_measurements', $data_insert);

            
            // Costing club up (update) or insert
            $this->db->where('id_id', $this->input->post('id_id'));
            $this->db->where('effective_date <=', date('Y-m-d'));
            $this->db->order_by('effective_date', 'DESC');
            $rate_row = $this->db->get('item_rates')->row();
            if(count($rate_row) > 0){$rate = $rate_row->cost_rate;} else{$rate = 0;}
            
            //insert article_costing_details only if id_id is different for this costing else update previous
            $rs = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->num_rows();
            if($rs > 0){
                $acd_id = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;
                $area2 = $this->input->post('area2');
                $query = "UPDATE `article_costing_details` SET `quantity` = `quantity` + CAST($area2 as DECIMAL(11,3)) WHERE acd_id = $acd_id";
                $this->db->query($query);
            }else{
                
                // insert the row
                $data_insert2['ac_id'] = $this->input->post('article_costing_id');
                $data_insert2['id_id'] = $this->input->post('id_id');
                $data_insert2['quantity'] = $this->input->post('area2');
                $data_insert2['rate'] = $rate;
                $data_insert2['status'] = $this->input->post('status');
                $data_insert2['user_id'] = $this->session->user_id;
        
                $this->db->insert('article_costing_details', $data_insert2);
            }
            
            // fetch im_id,ig_id from item_dtl and insert/update master part 
            
            // $am_id = $this->input->post('article_master_id'); # not-working
            $am_id = $this->db->get_where('article_costing', array('ac_id' => $this->input->post('article_costing_id')))->result()[0]->am_id;

            $ig_id = $this->input->post('ig_id');
            $nr = $this->db->get_where('article_parts', array('am_id' => $am_id, 'ig_id' => $ig_id))->num_rows();
            
            if($nr > 0){
                $pieces = $this->input->post('pieces');
                $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` + $pieces WHERE am_id = $am_id AND ig_id = $ig_id";
                $this->db->query($part_update);
                // echo $this->db->last_query();
            }else{
                $part_insert['am_id'] = $am_id;
                $part_insert['ig_id'] = $ig_id;
                $part_insert['quantity'] = $this->input->post('pieces');
                $part_insert['user_id'] = $this->session->user_id;
                
                $this->db->insert('article_parts', $part_insert);
                // echo $this->db->last_query(); die;
            }
            
            
            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing measurement added successfully.';
            return $data;
        }
        public function form_add_article_measurement_clone() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['id_id'] = $this->input->post('id_id');
            $data_insert['length'] = $this->input->post('length');
            $data_insert['width'] = $this->input->post('width');
            $data_insert['pieces'] = $this->input->post('pieces');
            $data_insert['wastage_percentage'] = $this->input->post('wastage_percentage');
            $data_insert['area1'] = $this->input->post('area1');    
            $data_insert['area2'] = $this->input->post('area2');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $this->db->insert('temp_article_costing_measurements', $data_insert);

            //insert article_costing_details
            $this->db->where('id_id', $this->input->post('id_id'));
            $this->db->where('effective_date <=', date('Y-m-d'));
            $this->db->order_by('effective_date', 'DESC');
            $rate_row = $this->db->get('item_rates')->row();
            if(count($rate_row) > 0){$rate = $rate_row->cost_rate;} else{$rate = 0;}

             //insert article_costing_details only if id_id is different for this costing else update previous  
            $rs = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->num_rows();  
            if($rs > 0){    
                $acd_id = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id; 
                $area2 = $this->input->post('area2');   
                $query = "UPDATE `temp_article_costing_details` SET `quantity` = `quantity` + CAST($area2 as DECIMAL(11,3)) WHERE acd_id = $acd_id"; 
                $this->db->query($query);   
            }else{  
                    
                // insert the row   
                $data_insert2['ac_id'] = $this->input->post('article_costing_id');  
                $data_insert2['id_id'] = $this->input->post('id_id');   
                $data_insert2['quantity'] = $this->input->post('area2');    
                $data_insert2['rate'] = $rate;  
                $data_insert2['status'] = $this->input->post('status'); 
                $data_insert2['user_id'] = $this->session->user_id; 
            
                $this->db->insert('temp_article_costing_details', $data_insert2);    
            }

            // fetch im_id,ig_id from item_dtl and insert/update master part    

            // $am_id = $this->input->post('article_master_id');   
            // $ig_id = $this->input->post('ig_id');   
            // $nr = $this->db->get_where('article_parts', array('am_id' => $am_id, 'ig_id' => $ig_id))->num_rows();   
                
            // if($nr > 0){    
            //     $pieces = $this->input->post('pieces'); 
            //     $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` + $pieces WHERE am_id = $am_id AND ig_id = $ig_id";  
            //     $this->db->query($part_update); 
            //     // echo $this->db->last_query();    
            // }else{  
            //     $part_insert['am_id'] = $am_id; 
            //     $part_insert['ig_id'] = $ig_id; 
            //     $part_insert['quantity'] = $this->input->post('pieces');    
            //     $part_insert['user_id'] = $this->session->user_id;  
                    
            //     $this->db->insert('article_parts', $part_insert);   
            // }
            
            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing measurement added successfully.';
            return $data;
        }

        public function form_edit_article_measurement() {
            $costing_measurement_id = $this->input->post('costing_measurement_id');

            $old_array = $this->db->get_where('article_costing_measurements', array('acm_id' => $this->input->post('costing_measurement_id')))->row();

            // echo '<pre>', print_r($old_array), '</pre>'; die();
            $component_old_area2 = $old_array->area2;
            $component_new_area2 = $this->input->post('area2');
            $old_costing_dtl_qnty = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id_measurement_edit'), 'id_id' => $this->input->post('id_id')))->row()->quantity;  
            
            if($component_new_area2 > $component_old_area2){
                
                $new_costing_dtl_qnty = ($component_new_area2 - $component_old_area2) + $old_costing_dtl_qnty;
                
            } else if($component_new_area2 < $component_old_area2){
                
                $new_costing_dtl_qnty =  $old_costing_dtl_qnty - ($component_old_area2 - $component_new_area2);
                
            }
            
            $this->log_before_update($old_array, $this->input->post('costing_measurement_id'), 'article_costing_measurements');

            $data_update['id_id'] = $this->input->post('id_id');
            $data_update['length'] = $this->input->post('length');
            $data_update['width'] = $this->input->post('width');
            $data_update['pieces'] = $this->input->post('pieces');
            $data_update['wastage_percentage'] = $this->input->post('wastage_percentage');
            $data_update['area1'] = $this->input->post('area1');
            $data_update['area2'] = $this->input->post('area2');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            // fetch old pieces for part calc
            $old_pieces = $this->db->get_where('article_costing_measurements', array('acm_id' => $costing_measurement_id))->result()[0]->pieces;        

            $this->db->where('acm_id', $costing_measurement_id);
            $this->db->update('article_costing_measurements', $data_update);

            $data['costing_id'] = $this->db->get_where('article_costing_measurements', array('acm_id' => $costing_measurement_id))->result()[0]->ac_id;
            
            // update article costing as well 
            $acd_id = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id_measurement_edit'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id; 
            
            $data_costing_update['quantity'] = $new_costing_dtl_qnty;
            $this->db->where('acd_id', $acd_id);
            $this->db->update('article_costing_details', $data_costing_update);
            
            // fetch part difference and add to the part table on am_id, ig_id 
            
            $am_id = $this->input->post('article_master_id');
            $im_id = $this->db->get_where('item_dtl', array('id_id' => $this->input->post('id_id')))->result()[0]->im_id;
            $ig_id = $this->db->get_where('item_master', array('im_id' => $im_id))->result()[0]->ig_id;
            
            $pieces = $this->input->post('pieces');
            $new_pieces = 0;
            if($pieces > $old_pieces){
                $new_pieces = $pieces - $old_pieces;
                $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` + $new_pieces WHERE am_id = $am_id AND ig_id = $ig_id";
            }else if($pieces < $old_pieces){
                $new_pieces = $old_pieces - $pieces;
                $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` - $new_pieces WHERE am_id = $am_id AND ig_id = $ig_id";
            } else{
                $part_update = "UPDATE `article_parts` SET `quantity` = $pieces WHERE am_id = $am_id AND ig_id = $ig_id";
            }
            
            $this->db->query($part_update);
            
            // update area2 in costing table based on (group-by) id_id on measurement table
            
            
            $data['type'] = 'success';
            $data['msg'] = 'Article costing measurement updated successfully.';
            return $data;
        }
        
        public function form_edit_article_measurement_clone() {
            $costing_measurement_id = $this->input->post('costing_measurement_id');
            $data_update['id_id'] = $this->input->post('id_id');
            $data_update['length'] = $this->input->post('length');
            $data_update['width'] = $this->input->post('width');
            $data_update['pieces'] = $this->input->post('pieces');
            $data_update['wastage_percentage'] = $this->input->post('wastage_percentage');
            $data_update['area1'] = $this->input->post('area1');    
            $data_update['area2'] = $this->input->post('area2');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            // fetch old pieces for part calc   
            $old_pieces = $this->db->get_where('temp_article_costing_measurements', array('acm_id' => $costing_measurement_id))->result()[0]->pieces;   

            $this->db->where('acm_id', $costing_measurement_id);
            $this->db->update('temp_article_costing_measurements', $data_update);

            $data['costing_id'] = $this->input->post('article_costing_id_measurement_edit');

            // update article costing as well
            $new_area2 = $this->db->select_sum('area2')->get_where('temp_article_costing_measurements', array('ac_id' => $this->input->post('article_costing_id_measurement_edit'), 'id_id' => $this->input->post('id_id')))->result()[0]->area2; 
            $acd_id = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('article_costing_id_measurement_edit'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;    
                
            $data_costing_update['quantity'] = $new_area2;  
            $this->db->where('acd_id', $acd_id);    
            $this->db->update('temp_article_costing_details', $data_costing_update); 
            // echo $this->db->last_query();    
            // fetch part difference and add to the part table on am_id, ig_id  
                
            $am_id = $this->input->post('article_master_id');   
            $im_id = $this->db->get_where('item_dtl', array('id_id' => $this->input->post('id_id')))->result()[0]->im_id;   
            $ig_id = $this->db->get_where('item_master', array('im_id' => $im_id))->result()[0]->ig_id; 
                
            // $pieces = $this->input->post('pieces'); 
            // $new_pieces = 0;    
            // if($pieces > $old_pieces){  
            //     $new_pieces = $pieces - $old_pieces;    
            //     $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` + $new_pieces WHERE am_id = $am_id AND ig_id = $ig_id";  
            // }else if($pieces < $old_pieces){    
            //     $new_pieces = $old_pieces - $pieces;    
            //     $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` - $new_pieces WHERE am_id = $am_id AND ig_id = $ig_id";  
            // } else{ 
            //     $part_update = "UPDATE `article_parts` SET `quantity` = $pieces WHERE am_id = $am_id AND ig_id = $ig_id";   
            // }   
                
            // $this->db->query($part_update); 
                
            // update area2 in costing table based on (group-by) id_id on measurement table 
                
            // $id_id = $this->input->post('id_id');   
                
            // $total_area2 = "SELECT SUM(area2) as area2 FROM `temp_article_costing_measurements` WHERE id_id = $id_id";   
            // $new_area2 = $this->db->query($total_area2)->result()[0]->area2;    
                
            // $part_update = "UPDATE `temp_article_costing_details` SET `quantity` = $new_area2 WHERE acd_id = $acd_id";   
            // $this->db->query($part_update); 


            $data['type'] = 'success';
            $data['msg'] = 'Article costing measurement updated successfully.';
            return $data;
        }

        public function form_add_costing_details() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['id_id'] = $this->input->post('id_id');
            $data_insert['rate'] = $this->input->post('rate');
            $data_insert['quantity'] = $this->input->post('quantity');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $rs = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->num_rows();
            if($rs > 0){
                $acd_id = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;
                $quantity = $this->input->post('quantity');
                $query = "UPDATE `article_costing_details` SET `quantity` = `quantity` + CAST($quantity as DECIMAL(11,3)) WHERE acd_id = $acd_id";
                $this->db->query($query);
            }else{
                $this->db->insert('article_costing_details', $data_insert);
            }

            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing details added successfully.';
            return $data;
        }
        public function form_add_costing_details_clone() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['id_id'] = $this->input->post('id_id');
            $data_insert['rate'] = $this->input->post('rate');
            $data_insert['quantity'] = $this->input->post('quantity');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $rs = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->num_rows();
            if($rs > 0){
                $acd_id = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('article_costing_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;
                $quantity = $this->input->post('quantity');
                $query = "UPDATE `temp_article_costing_details` SET `quantity` = `quantity` + CAST($quantity as DECIMAL(11,3)) WHERE acd_id = $acd_id";
                $this->db->query($query);
            }else{
                $this->db->insert('temp_article_costing_details', $data_insert);
            }

            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing details added successfully.';
            return $data;
        }

        public function form_edit_costing_details() {

            $old_array = $this->db->get_where('article_costing_details', array('acd_id' => $this->input->post('costing_details_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('costing_details_id'), 'article_costing_details');

            $costing_details_id = $this->input->post('costing_details_id');
            $data_update['id_id'] = $this->input->post('id_id');
            $data_update['rate'] = $this->input->post('rate');
            $data_update['quantity'] = $this->input->post('quantity');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            $this->db->where('acd_id', $costing_details_id);
            $this->db->update('article_costing_details', $data_update);


            $data['costing_id'] = $this->db->get_where('article_costing_details', array('acd_id' => $costing_details_id))->result()[0]->ac_id;
            $data['type'] = 'success';
            $data['msg'] = 'Article costing details updated successfully.';
            return $data;
        }
        public function form_edit_costing_details_clone() {
            $costing_details_id = $this->input->post('costing_details_id');
            $data_update['id_id'] = $this->input->post('id_id');
            $data_update['rate'] = $this->input->post('rate');
            $data_update['quantity'] = $this->input->post('quantity');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            $this->db->where('acd_id', $costing_details_id);
            $this->db->update('temp_article_costing_details', $data_update);

            $data['costing_id'] = $this->db->get_where('article_costing_details', array('acd_id' => $costing_details_id))->result()[0]->ac_id;
            $data['type'] = 'success';
            $data['msg'] = 'Article costing details updated successfully.';
            return $data;
        }

        public function form_add_costing_charges() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['c_id'] = $this->input->post('c_id');
            $data_insert['percentage'] = $this->input->post('percentage');
            $data_insert['rate'] = $this->input->post('rate');
            $data_insert['quantity'] = $this->input->post('quantity');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $this->db->insert('article_costing_charges', $data_insert);

            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing charges added successfully.';
            return $data;
        }

        
        public function form_add_costing_charges_clone() {
            $data_insert['ac_id'] = $this->input->post('article_costing_id');
            $data_insert['c_id'] = $this->input->post('c_id');
            $data_insert['percentage'] = $this->input->post('percentage');
            $data_insert['rate'] = $this->input->post('rate');
            $data_insert['quantity'] = $this->input->post('quantity');
            $data_insert['status'] = $this->input->post('status');
            $data_insert['user_id'] = $this->session->user_id;

            $this->db->insert('temp_article_costing_charges', $data_insert);

            $data['costing_id'] = $this->input->post('article_costing_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing charges added successfully.';
            return $data;
        }

        public function form_edit_costing_charges() {

            $old_array = $this->db->get_where('article_costing_charges', array('acc_id' => $this->input->post('costing_charges_id')))->row();

        // echo '<pre>', print_r($old_array), '</pre>'; die();

        $this->log_before_update($old_array, $this->input->post('costing_charges_id'), 'article_costing_charges');

            $costing_charges_id = $this->input->post('costing_charges_id');
            $data_update['c_id'] = $this->input->post('c_id');
            $data_update['percentage'] = $this->input->post('percentage');
            $data_update['rate'] = $this->input->post('rate');
            $data_update['quantity'] = $this->input->post('quantity');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            $this->db->where('acc_id', $costing_charges_id);
            $this->db->update('article_costing_charges', $data_update);

            $data['costing_id'] = $this->db->get_where('article_costing_charges', array('acc_id' => $costing_charges_id))->result()[0]->ac_id;    
            $data['type'] = 'success';
            $data['msg'] = 'Article costing charges updated successfully.';
            return $data;
        }
        public function form_edit_costing_charges_clone() {
            $costing_charges_id = $this->input->post('costing_charges_id');
            $data_update['c_id'] = $this->input->post('c_id');
            $data_update['percentage'] = $this->input->post('percentage');
            $data_update['rate'] = $this->input->post('rate');
            $data_update['quantity'] = $this->input->post('quantity');
            $data_update['status'] = $this->input->post('status');
            $data_update['user_id'] = $this->session->user_id;

            $this->db->where('acc_id', $costing_charges_id);
            $this->db->update('temp_article_costing_charges', $data_update);

            $data['costing_id'] = $this->db->get_where('article_costing_charges', array('acc_id' => $costing_charges_id))->result()[0]->ac_id;    
            $data['type'] = 'success';
            $data['msg'] = 'Article costing charges updated successfully.';
            return $data;
        }

        public function form_add_costing_charges_percentage(){
            
            $data_insert['ac_id'] = $this->input->post('cost_id');
            $data_insert['c_id'] = $this->input->post('charge_id');
            $data_insert['percentage'] = $this->input->post('percentage');
            $data_insert['quantity'] = 1.00;
            $data_insert['rate'] = 0.00;

            $this->db->insert('article_costing_charges', $data_insert);

            // echo $this->db->last_query();die;

            $data['costing_id'] = $this->input->post('cost_id');
            $data['type'] = 'success';
            $data['msg'] = 'Article costing charges added successfully.';
            return $data;
        }



        public function ajax_fetch_article_master_image() {
            $am_id = $this->input->post('am_id');

            $this->db->where('am_id', $am_id);
            $row = $this->db->get('article_master')->row();
            if(count($row) > 0 && $row->img){$img = $row->img;} else{$img='default.png';}
            $data['img'] = $img;

            return $data;
        }

        public function ajax_unique_article_costing_amId() {
            $am_id = $this->input->post('am_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $rs = $this->db->get_where('article_costing', array('ac_id !='=>$article_costing_id, 'am_id' => $am_id))->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'Costing for this article already added.';
            }

            return $data;
        }

        public function ajax_unique_article_costing_item() {
            $id_id = $this->input->post('id_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_measurement_id = $this->input->post('costing_measurement_id');

            $this->db->where('id_id', $id_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acm_id !=', $costing_measurement_id);
            $rs = $this->db->get('article_costing_measurements')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'Item already exists.';
            }

            return $data;
        }
        public function ajax_unique_article_costing_item_clone() {
            $id_id = $this->input->post('id_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_measurement_id = $this->input->post('costing_measurement_id');

            $this->db->where('id_id', $id_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acm_id !=', $costing_measurement_id);
            $rs = $this->db->get('temp_article_costing_measurements')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'Item already exists.';
            }

            return $data;
        }

        public function costing_clone_swap_item() {
            $cost_id = $this->input->post('cost_id');
            $prop_id = $this->input->post('prop_id');
            $exis_id = $this->input->post('exis_id');

            $data_clone_update['id_id'] = $prop_id;
            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_id);
            $this->db->update('temp_article_costing_measurements', $data_clone_update);

            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_id);
            $this->db->update('temp_article_costing_details', $data_clone_update);

            $data['type'] = 'success';
            $data['msg'] = 'Items swapped successfully.';

            return $data;
        }

        public function costing_swap_item_clr_m() {
            $cost_id = $this->input->post('cost_id');
            $prop_clr_id = $this->input->post('prop_clr_id');
            $exis_clr_id = $this->input->post('exis_clr_id');

    $check_item_group_id = $this->db->select('item_groups.ig_id')
                         ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                         ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                         ->get_where('item_dtl', array('item_dtl.id_id' => $exis_clr_id))
                         ->row()->ig_id;

    $get_costing_rate = $this->db->select('item_rates.cost_rate')
                         ->get_where('item_rates', array('item_rates.id_id' => $prop_clr_id))
                         ->row()->cost_rate;

if($check_item_group_id == 6) {
            $data_update['id_id'] = $prop_clr_id;
            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_clr_id);
            $this->db->update('article_costing_measurements', $data_update);
            $data_update1['id_id'] = $prop_clr_id;
            $data_update1['rate'] = $get_costing_rate;
            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_clr_id);
            $this->db->update('article_costing_details', $data_update1);

            $data['type'] = 'success';
            $data['msg'] = "Item's colour swapped successfully.";
        } 

            return $data;
        }
        
        public function costing_swap_item_m() {
            $cost_id = $this->input->post('cost_id');
            $prop_id = $this->input->post('prop_id');
            $exis_id = $this->input->post('exis_id');

            $data_clone_update['id_id'] = $prop_id;
            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_id);
            $this->db->update('article_costing_measurements', $data_clone_update);

            $this->db->where('ac_id', $cost_id);
            $this->db->where('id_id', $exis_id);
            $this->db->update('article_costing_details', $data_clone_update);

            $data['type'] = 'success';
            $data['msg'] = 'Items swapped successfully.';

            return $data;
        }
        
        public function ajax_fetch_mapped_item() {
            $id_id = $this->input->post('id_id');
            
            $rset = $this->db->get_where('item_dtl', array('id_id' => $id_id))->result();
            $im_id = $rset[0]->im_id;
            $c_id = $rset[0]->c_id;
            
            $rs = $this->db->get_where('item_mapping', array('company_item_code' => $im_id, 'company_item_color' => $c_id))->result();
            // echo $this->db->last_query(); 
            
            $data = false;
            if(count($rs) > 0) {
                $datam = $this->db
                    ->select('item_master.item,colors.color')
                    ->join('item_master','item_mapping.buyer_item_code = item_master.im_id', 'left')
                    ->join('colors','buyer_item_color = c_id', 'left')
                    ->get_where('item_mapping', array('company_item_code' => $im_id, 'company_item_color' => $c_id))->result();
                
                $data['type'] = 'info';
                $data['msg'] = 'Buyer Item Name: '. $datam[0]->item;
                $data['msg'] .= '& Buyer Item Color: '. $datam[0]->color;
                // print_r($data);
            }

            return $data;
        }

        public function ajax_article_costing_table_data() {

            // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            //actual db table column names
            /*$column_orderable = array(
                0 => 'group_name',
                1 => 'art_no',
                2 => 'info',
                3 => 'name',
                4 => 'exworks_amt',
                5 => 'cf_amt',
                6 => 'fob_amt',
                7 => 'img',
                8 => 'status',
                9 => 'action',
            );*/
            
            $column_orderable = array(
                0 => 'art_no',
                1 => 'group_name',
                2 => 'info',
                3 => 'name',
            );
            // Set searchable column fields
            $column_search = array('art_no','group_name','info','name');

            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            if($module_permission == 'show'){
                $rs = $this->db->get('article_costing')->result();
            } else {
                #module_permission contains the dept id now
                $rs = $this->db
                    ->join('user_details','user_details.user_id = article_costing.user_id','left')
                    ->get_where('article_costing', array('user_details.user_dept' => $module_permission))->result();
            }
            
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('article_costing.*, article_master.*, article_groups.group_name, acc_master.name'); // article_master.art_no,article_master.info,article_master.img
                $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');

                if($module_permission == 'show') {
                    $rs = $this->db->get('article_costing')->result();
                } else {
                    #module_permission contains the dept id now
                    $rs = $this->db
                        ->join('user_details','user_details.user_id = article_costing.user_id','left')
                        ->get_where('article_costing', array('user_details.user_dept' => $module_permission))->result();
                }
                // echo $this->db->last_query(); die;
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

                $this->db->select('article_costing.*, article_master.*, article_groups.group_name, acc_master.name');
                $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');

                if($module_permission == 'show'){
                    $rs = $this->db->get('article_costing')->result();
                } else {
                    #module_permission contains the dept id now
                    $rs = $this->db
                        ->join('user_details','user_details.user_id = article_costing.user_id','left')
                        ->get_where('article_costing', array('user_details.user_dept' => $module_permission))->result();
                }

                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('article_costing.*, article_master.*, article_groups.group_name, acc_master.name');
                $this->db->join('article_master', 'article_master.am_id = article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
                if($module_permission == 'show'){
                    $rs = $this->db->get('article_costing')->result();
                } else {
                    #module_permission contains the dept id now
                    $rs = $this->db
                        ->join('user_details','user_details.user_id = article_costing.user_id','left')
                        ->get_where('article_costing', array('user_details.user_dept' => $module_permission))->result();
                }

                $this->db->flush_cache();

            }
              // echo $this->db->last_query(); die;
            $data = array();
            foreach ($rs as $val) {
                if($val->img){$img='<a target="_blank" href="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'"><img src="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'" width="50"></a>';} else{$img='';}
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                $nestedData['art_no'] = $val->art_no;
                $nestedData['group_name'] = $val->group_name;
                $nestedData['info'] = $val->info;
                $nestedData['name'] = $val->name;
                $nestedData['exworks_amt'] = $val->exworks_amt;
                $nestedData['fob_amt'] = $val->fob_amt;
                $nestedData['cf_amt'] = $val->cf_amt;
                $nestedData['img'] = $img;
                $nestedData['status'] = $status;
                $uvp = $this->_user_wise_view_permission(2, $this->session->user_id);
            if($uvp == 'block'){
                $nestedData['action'] = '-';    
            }else{
                $nestedData['action'] = '
                <a href="'. base_url('admin/edit_article_costing/'.$val->ac_id) .'" class="btn btn-info" style="padding:3px"><i class="fa fa-pencil"></i> Edit</a>
                <a href="'. base_url('admin/clone_article_costing/'.$val->ac_id) .'" class="btn btn-warning" style="padding:3px"><i class="fa fa-clone"></i> Clone</a>
                <button po-id="'.$val->ac_id .'" type="button" class="btn btn-primary print_all_cost_sheet"><i class="fa fa-print"></i> Print</button>
                <a href="javascript:void(0)" ac_id="'. $val->ac_id .'" am_id="'. $val->am_id .'" href="'. base_url('admin/delete_article_costing/'.$val->ac_id) .'" class="btn btn-danger delete" style="padding:3px"><i class="fa fa-times"></i> Delete</a>';
            }
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        public function ajax_article_costing_measurement_table_data() {
            //actual db table column names
            // $column_orderable = array(
            //     0 => 'item',
            //     1 => 'color',
            //     2 => 'length',
            //     3 => 'width',
            //     4 => 'pieces',
            //     5 => 'wastage_percentage',
            //     6 => 'unit',
            //     7 => 'area1',
            //     8 => 'area2',
            //     9 => 'status',
            // );
            // Set searchable column fields
            $column_search = array('item','color','length','width','pieces','wastage_percentage','unit');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            // $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('article_costing_measurements', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                // $this->db->order_by($order, $dir);
                $this->db->select('article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->order_by('sort_order, item_master.item, article_costing_measurements.acm_id')->get_where('article_costing_measurements', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->order_by('sort_order, item_master.item, article_costing_measurements.acm_id')->get_where('article_costing_measurements', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                // $this->db->order_by($order, $dir);
                $this->db->select('article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->order_by('sort_order, item_master.item, article_costing_measurements.acm_id')->get_where('article_costing_measurements', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}
                $area1 = round(($val->length * $val->width * $val->pieces) + (($val->length * $val->width * $val->pieces * $val->wastage_percentage) / 100), 3);
                $nestedData['item'] = $val->item;
                $nestedData['color'] = $val->color;
                $nestedData['length'] = $val->length;
                $nestedData['width'] = $val->width;
                $nestedData['pieces'] = $val->pieces;
                $nestedData['wastage_percentage'] = $val->wastage_percentage;
                $nestedData['unit'] = $val->unit;
                $nestedData['area1'] = $area1;
                $nestedData['area2'] = ($val->grp_value == 0) ? 0 : round($area1 / $val->grp_value , 3);
                $nestedData['status'] = $status;
                $nestedData['action'] = '
    <a href="javascript:void(0)" acm_id="'.$val->acm_id.'" class="costing_measurement_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    <a data-tab="article_measurement_table" data-id_id="'.$val->id_id.'" data-pk="'.$val->acm_id.'" data-area2="'.$nestedData['area2'].'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>';
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }
        public function ajax_article_costing_measurement_table_data_clone() {
            //actual db table column names
            $column_orderable = array(
                0 => 'item',
                1 => 'color',
                2 => 'length',
                3 => 'width',
                4 => 'pieces',
                5 => 'wastage_percentage',
                6 => 'unit',
                7 => 'status',
            );
            // Set searchable column fields
            $column_search = array('item','color','length','width','pieces','wastage_percentage','unit');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('temp_article_costing_measurements', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->get_where('temp_article_costing_measurements', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('temp_article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->get_where('temp_article_costing_measurements', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_measurements.*, item_master.item, colors.color, units.unit, item_groups.value as grp_value');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_measurements.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
                $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
                $rs = $this->db->get_where('temp_article_costing_measurements', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                $area1 = round(($val->length * $val->width * $val->pieces) + (($val->length * $val->width * $val->pieces * $val->wastage_percentage) / 100), 3);
                $nestedData['item'] = $val->item;
                $nestedData['color'] = $val->color;
                $nestedData['length'] = $val->length;
                $nestedData['width'] = $val->width;
                $nestedData['pieces'] = $val->pieces;
                $nestedData['wastage_percentage'] = $val->wastage_percentage;
                $nestedData['unit'] = $val->unit;
                $nestedData['area1'] = $area1;
                $nestedData['area2'] = ($val->grp_value == 0) ? 0 : round($area1 / $val->grp_value , 3);
                $nestedData['status'] = $status;
                $nestedData['action'] = '
    <a href="javascript:void(0)" acm_id="'.$val->acm_id.'" class="costing_measurement_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    <a data-tab="article_measurement_table_clone" data-id_id="'.$val->id_id.'" data-pk="'.$val->acm_id.'" data-area2="'.$nestedData['area2'].'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                ';
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        public function ajax_article_costing_details_table_data() {
            //actual db table column names
            $column_orderable = array(
                0 => 'sort_order',
                1 => 'item',
                2 => 'color',
                3 => 'quantity',
                4 => 'rate',
                5 => 'status',
            );
            // Set searchable column fields
            $column_search = array('item','color','quantity','rate');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('article_costing_details', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('article_costing_details.*, item_master.item, item_master.im_id, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('article_costing_details', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('article_costing_details.*, item_master.item, item_master.im_id, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('article_costing_details', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('article_costing_details.*, item_master.item, item_master.im_id, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('article_costing_details', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                $nestedData['group_name'] = $val->group_name;
                $nestedData['item'] = $val->item;
                $nestedData['color'] = $val->color;
                $nestedData['quantity'] = $val->quantity;
                $nestedData['rate'] = $val->rate;
                $nestedData['amount'] = number_format(($val->rate * $val->quantity), 2, '.', '');
                $nestedData['status'] = $status;
                $nestedData['action'] = '
    <a href="javascript:void(0)" acd_id="'.$val->acd_id.'" class="costing_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    <a data-tab="article_cost_table" data-id_id="'.$val->id_id.'" data-pk="'.$val->acd_id.'"  href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                ';
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }
        public function ajax_article_costing_details_table_data_clone() {
            //actual db table column names
            $column_orderable = array(
                0 => 'sort_order',
                1 => 'item',
                2 => 'color',
                3 => 'quantity',
                4 => 'rate',
                5 => 'status',
            );
            // Set searchable column fields
            $column_search = array('item','color','quantity','rate');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('temp_article_costing_details', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_details.*, item_master.item, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('temp_article_costing_details', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('temp_article_costing_details.*, item_master.item, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('temp_article_costing_details', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_details.*, item_master.item, colors.color, item_groups.group_name');
                $this->db->join('item_dtl', 'item_dtl.id_id = temp_article_costing_details.id_id', 'left');
                $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                $this->db->join('item_groups', 'item_master.ig_id = item_groups.ig_id', 'left');
                $rs = $this->db->order_by('item_master.im_id')->get_where('temp_article_costing_details', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                $nestedData['group_name'] = $val->group_name;
                $nestedData['item'] = $val->item;
                $nestedData['color'] = $val->color;
                $nestedData['quantity'] = $val->quantity;
                $nestedData['rate'] = $val->rate;
                $nestedData['amount'] = number_format(($val->rate * $val->quantity), 2, '.', '');
                $nestedData['status'] = $status;
                $nestedData['action'] = '
    <a href="javascript:void(0)" acd_id="'.$val->acd_id.'" class="costing_details_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    <a data-tab="article_cost_table_clone" data-id_id="'.$val->id_id.'" data-pk="'.$val->acd_id.'"  href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                ';
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        public function ajax_article_costing_charges_table_data() {
            //actual db table column names
            $column_orderable = array(
                0 => 'charge',
                1 => 'percentage',
                2 => 'quantity',
                3 => 'rate',
                5 => 'status',
            );
            // Set searchable column fields
            $column_search = array('charge','percentage','quantity','rate');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('article_costing_charges', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                // $this->db->order_by($order, $dir);
                $this->db->select('article_costing_charges.*, charges.charge, charges.is_percentage');
                $this->db->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('article_costing_charges', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('article_costing_charges.*, charges.charge');
                $this->db->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('article_costing_charges', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('article_costing_charges.*, charges.charge');
                $this->db->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('article_costing_charges', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}
                if($val->is_percentage == '1'){
                    $nestedData['action'] = '
                    <a href="javascript:void(0)" data-toggle="tooltip" title="dd" class="disabled btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                    <a data-tab="article_charge_table" data-id_id="0" data-pk="'.$val->acc_id.'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                                ';
                } else{
                    $nestedData['action'] = '
                    <a href="javascript:void(0)" acc_id="'.$val->acc_id.'" class="costing_charges_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                    <a data-tab="article_charge_table" data-id_id="0" data-pk="'.$val->acc_id.'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                                ';
                }

                $nestedData['charge'] = $val->charge;
                $nestedData['percentage'] = $val->percentage;
                $nestedData['quantity'] = $val->quantity;
                $nestedData['rate'] = $val->rate;
                $nestedData['amount'] = number_format(($val->rate * $val->quantity), 2, '.', '');
                $nestedData['status'] = $status;
                
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }
        public function ajax_article_costing_charges_table_data_clone() {
            //actual db table column names
            $column_orderable = array(
                0 => 'charge',
                1 => 'percentage',
                2 => 'quantity',
                3 => 'rate',
                5 => 'status',
            );
            // Set searchable column fields
            $column_search = array('charge','percentage','quantity','rate');

            $ac_id = $this->input->post('article_costing_id');
            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get_where('temp_article_costing_charges', array('ac_id'=>$ac_id))->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_charges.*, charges.charge, charges.is_percentage');
                $this->db->join('charges', 'charges.c_id = temp_article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('temp_article_costing_charges', array('ac_id'=>$ac_id))->result();
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

                $this->db->select('temp_article_costing_charges.*, charges.charge');
                $this->db->join('charges', 'charges.c_id = temp_article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('temp_article_costing_charges', array('ac_id'=>$ac_id))->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing_charges.*, charges.charge');
                $this->db->join('charges', 'charges.c_id = temp_article_costing_charges.c_id', 'left');
                $rs = $this->db->order_by('sorting_order')->get_where('temp_article_costing_charges', array('ac_id'=>$ac_id))->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                if($val->is_percentage == '1'){
                    $nestedData['action'] = '
                    <a href="javascript:void(0)" data-toggle="tooltip" title="dd" class="disabled btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                    <a data-tab="article_charge_table_clone" data-id_id="0" data-pk="'.$val->acc_id.'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                                ';
                } else{
                    $nestedData['action'] = '
                    <a href="javascript:void(0)" acc_id="'.$val->acc_id.'" class="costing_charges_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                    <a data-tab="article_charge_table_clone" data-id_id="0" data-pk="'.$val->acc_id.'" href="javascript:void(0)" class="btn btn-danger delete1"><i class="fa fa-times"></i> Delete</a>
                                ';
                }

                $nestedData['charge'] = $val->charge;
                $nestedData['percentage'] = $val->percentage;
                $nestedData['quantity'] = $val->quantity;
                $nestedData['rate'] = $val->rate;
                $nestedData['amount'] = number_format(($val->rate * $val->quantity), 2, '.', '');
                $nestedData['status'] = $status;
    //             $nestedData['action'] = '
    // <a href="javascript:void(0)" acc_id="'.$val->acc_id.'" class="costing_charges_edit_btn btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
    // <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
    //             ';
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        public function ajax_fetch_article_costing_measurement() {
            $acm_id = $this->input->post('acm_id');

            $this->db->where('acm_id', $acm_id);
            $rs = $this->db->get('article_costing_measurements')->row();

            return $rs;
        }
        public function ajax_fetch_article_costing_measurement_clone() {
            $acm_id = $this->input->post('acm_id');

            $this->db->where('acm_id', $acm_id);
            $rs = $this->db->get('temp_article_costing_measurements')->row();

            return $rs;
        }

        public function ajax_fetch_rate_by_item_detail() {
            $id_id = $this->input->post('id_id');

            $this->db->where('id_id', $id_id);
            $this->db->where('effective_date <=', date('Y-m-d'));
            $this->db->order_by('effective_date', 'DESC');
            $rate_row = $this->db->get('item_rates')->row();
            if(count($rate_row) > 0){$rate = $rate_row->cost_rate;} else{$rate = 0;}
            $data['rate'] = $rate;

            $this->db->select('item_master.ig_id')
            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')->where('id_id', $id_id);
            $rs = $this->db->get('item_dtl')->row()->ig_id;

            $data['ig_id'] = $rs;

            return $data;
        }

        public function ajax_unique_article_costing_details_item() {
            $id_id = $this->input->post('id_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_details_id = $this->input->post('costing_details_id');

            $this->db->where('id_id', $id_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acd_id !=', $costing_details_id);
            $rs = $this->db->get('article_costing_details')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'Item already exists.';
            }

            return $data;
        }
        public function ajax_unique_article_costing_details_item_clone() {
            $id_id = $this->input->post('id_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_details_id = $this->input->post('costing_details_id');

            $this->db->where('id_id', $id_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acd_id !=', $costing_details_id);
            $rs = $this->db->get('temp_article_costing_details')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'Item already exists.';
            }

            return $data;
        }

        public function ajax_unique_article_costing_charge() {
            $c_id = $this->input->post('c_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_charges_id = $this->input->post('costing_charges_id');

            $this->db->where('c_id', $c_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acc_id !=', $costing_charges_id);
            $rs = $this->db->get('article_costing_charges')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'This charge already added.';
            }

            return $data;
        }
        public function ajax_unique_article_costing_charge_clone() {
            $c_id = $this->input->post('c_id');
            $article_costing_id = $this->input->post('article_costing_id');
            $costing_charges_id = $this->input->post('costing_charges_id');

            $this->db->where('c_id', $c_id);
            $this->db->where('ac_id', $article_costing_id);
            $this->db->where('acc_id !=', $costing_charges_id);
            $rs = $this->db->get('temp_article_costing_charges')->result();

            if(count($rs) == 0) {
                $data = 'true';
            } else {
                $data = 'This charge already added.';
            }

            return $data;
        }

        public function ajax_fetch_article_costing_details() {
            $acd_id = $this->input->post('acd_id');

            $this->db->select('item_master.ig_id, article_costing_details.*')->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')->where('acd_id', $acd_id);
            $rs = $this->db->get('article_costing_details')->row();


            $this->db->where('id_id', $rs->id_id);
            $this->db->where('effective_date <=', date('Y-m-d'));
            $this->db->order_by('effective_date', 'DESC');
            $rate_row = $this->db->get('item_rates')->row();
            if(count($rate_row) > 0){$rate = $rate_row->cost_rate;} else{$rate = 0;}
            $data['rate_neww'] = $rate;


            $data['acd_id'] = $rs->acd_id;
            $data['id_id'] = $rs->id_id;
            $data['ig_id'] = $rs->ig_id;
            $data['rate'] = $rs->rate;
            $data['quantity'] = $rs->quantity;
            $data['status'] = $rs->status;


            return $data;
        }
        public function ajax_fetch_article_costing_details_clone() {
            $acd_id = $this->input->post('acd_id');

            $this->db->where('acd_id', $acd_id);
            $rs = $this->db->get('temp_article_costing_details')->row();

            return $rs;
        }

        public function ajax_fetch_article_costing_charges() {
            $acc_id = $this->input->post('acc_id');

            $this->db->where('acc_id', $acc_id);
            $rs = $this->db->get('article_costing_charges')->row();

            return $rs;
        }
        public function ajax_fetch_article_costing_charges_clone() {
            $acc_id = $this->input->post('acc_id');

            $this->db->where('acc_id', $acc_id);
            $rs = $this->db->get('temp_article_costing_charges')->row();

            return $rs;
        }

    // common area 
        public function ajax_buyer_items_on_item_group_id(){  
            $$return_array = array();
            
            $item_group = $this->input->post('item_group');
            
            $this->db->select('item_dtl.*, colors.color, item_master.item as item_name, item_groups.group_name, item_groups.value, units.unit');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
            $return_array["all_items"] = $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_master.enlist_costing' => 1, 'item_master.ig_id' => $item_group))->result_array();
            
            // print_r($return_array);
            
            //Item detail from item_buying_codes        
            $this->db->select('item_buying_codes.ibc_id, item_buying_codes.im_id as main_item_id, item_buying_codes.main_color_id as main_color_id, item_buying_codes.buyer_im_id as buyer_item_id, item_buying_codes.customer_item_code as buyer_item_code, item_buying_codes.c_id as buyer_colour_id, item_buying_codes.customer_colour_code as buyer_colour_code, item_master.item as item_name');
            $this->db->join('item_master', 'item_master.im_id = item_buying_codes.buyer_im_id', 'left');
            $item_buying_codes = $this->db->get_where('item_buying_codes', array('item_buying_codes.ig_id' => $item_group))->result_array();
            
            for($i = 0; $i < sizeof($item_buying_codes); $i++){
                $im_id = $item_buying_codes[$i]["main_item_id"];
                $main_color_id = $item_buying_codes[$i]["main_color_id"];
                
                $id_id = $this->db->select('id_id')->get_where('item_dtl', array('im_id' => $im_id, 'c_id' => $main_color_id))->result()[0]->id_id;
                
                $item_buying_codes[$i]["id_id"] = $id_id;
            }//end for
            
            $return_array["item_buying_codes"] = $item_buying_codes;
            return $return_array;
            
        }
        
        public function ajax_all_items_on_item_group_id(){
            $item_group = $this->input->post('item_group');
            $this->db->select('item_dtl.*, colors.color, item_master.item as item_name, item_groups.group_name, item_groups.value, units.unit');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
            return $this->db->order_by('item_master.item, colors.color')->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_master.ig_id' => $item_group))->result_array();
        }

        public function ajax_item_colour_wrt_im_id_m(){
            $item_master_id = $this->input->post('item_master_id');
            $this->db->select('item_dtl.*, colors.color, item_master.item as item_name, item_groups.group_name, item_groups.value, units.unit');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
            $this->db->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left');
            $this->db->join('units', 'units.u_id = item_groups.u_id', 'left');
            return $this->db->get_where('item_dtl', array('item_dtl.status'=>'1', 'item_master.im_id' => $item_master_id))->result_array();

            // echo '<pre>', print_r($item_master_id), '</pre>'; die();
        }

        public function ajax_del_row_on_table_and_pk(){

            $pk = $this->input->post('pk');
            $tab = $this->input->post('tab');
            $data = [];
            
            if($tab == 'article_measurement_table'){
                $cost_id = $this->input->post('cost_id');
                $id_id = $this->input->post('id_id');
                $area2 = $this->input->post('area2');
                
                // Update part table - fetch old pieces for part calc
                $pieces = $this->db->get_where('article_costing_measurements', array('acm_id' => $pk))->result()[0]->pieces;
                // echo $this->db->last_query();
                $am_id = $this->db->get_where('article_costing', array('ac_id' => $cost_id))->result()[0]->am_id;
                $im_id = $this->db->get_where('item_dtl', array('id_id' => $this->input->post('id_id')))->result()[0]->im_id;
                $ig_id = $this->db->get_where('item_master', array('im_id' => $im_id))->result()[0]->ig_id;
                
                $part_update = "UPDATE `article_parts` SET `quantity` = `quantity` - $pieces WHERE am_id = $am_id AND ig_id = $ig_id";
                $this->db->query($part_update);
                // echo $this->db->last_query();
                
                $table = 'article_costing_measurements';
                $this->db->where('acm_id', $pk)->delete($table);
                
                // update costing table value
                $new_area2 = $this->db->select_sum('area2')->get_where('article_costing_measurements', array('ac_id' => $this->input->post('cost_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->area2;
                $acd_id = $this->db->get_where('article_costing_details', array('ac_id' => $this->input->post('cost_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;
                
                $data_costing_update['quantity'] = $new_area2;
                $primary_key = $acd_id;
        $table_name = 'article_costing_details';
        $pk_field_name = 'acd_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "article_costing_details",
                    "tbl_pk_fld" => "acd_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
                $this->db->where('acd_id', $acd_id);
                $this->db->update('article_costing_details', $data_costing_update);
                
            }elseif($tab == 'article_cost_table'){
                
                // remove from measurement table as well
                $cost_id = $this->input->post('cost_id');
                $id_id = $this->input->post('id_id');
                
                $table = 'article_costing_measurements';
                $this->db->where('ac_id', $cost_id)->where('id_id', $id_id)->delete($table);
                
                $table = 'article_costing_details';
                $this->db->where('acd_id', $pk)->delete($table);
                
                // part del
                $am_id = $this->db->get_where('article_costing', array('ac_id' => $cost_id))->result()[0]->am_id;
                $im_id = $this->db->get_where('item_dtl', array('id_id' => $this->input->post('id_id')))->result()[0]->im_id;
                $ig_id = $this->db->get_where('item_master', array('im_id' => $im_id))->result()[0]->ig_id;

                $app_idd = $this->db->where('am_id', $am_id)->where('ig_id', $ig_id)->get('article_parts')->row()->ap_id;
                
                $table = 'article_parts';
                $primary_key = $app_idd;
        $table_name = 'article_parts';
        $pk_field_name = 'ap_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => "article_parts",
                    "tbl_pk_fld" => "ap_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
                $this->db->where('am_id', $am_id)->where('ig_id', $ig_id)->delete($table);
            }else{
                $table = 'article_costing_charges';
                $data['res'] = $this->db
                    ->select('charges.charge as charge_name, charges.c_id as charge_id, article_costing_charges.percentage')
                    ->join('charges','charges.c_id = article_costing_charges.c_id','left')
                    // ->where("article_costing_charges.percentage !=", 0)
                    ->get_where($table, array('article_costing_charges.acc_id' => $pk))->result_array();
                    
                if(count($data['res']) == 0){
                    $data['res'][0]["charge_name"] = false;
                }    
                // echo '<pre>', print_r($data), '</pre>';die;
                $primary_key = $pk;
        $table_name = $table;
        $pk_field_name = 'acc_id';
             // reference table values for checking  
             $reference_array = array(
                array(
                    "tbl_name" => $table,
                    "tbl_pk_fld" => "acc_id",
                )
            );

       $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
                $this->db->where('acc_id', $pk)->delete($table);
            }
            $data['costing_id'] = $this->input->post('cost_id');
            $data['title'] = 'Deleted!';
            $data['type'] = 'success';
            $data['msg'] = 'Item Successfully Deleted';
            
            // echo '<pre>', print_r($data), '</pre>';
            
            return $data;
        }

        public function ajax_del_row_on_table_and_pk_clone(){

            $pk = $this->input->post('pk');
            $tab = $this->input->post('tab');
            $data = [];
            
            if($tab == 'article_measurement_table_clone'){
                $cost_id = $this->input->post('cost_id');
                $id_id = $this->input->post('id_id');
                $area2 = $this->input->post('area2');
                $table = 'temp_article_costing_measurements';
                $this->db->where('acm_id', $pk)->delete($table);
                // update costing table value
                $new_area2 = $this->db->select_sum('area2')->get_where('temp_article_costing_measurements', array('ac_id' => $this->input->post('cost_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->area2;
                $acd_id = $this->db->get_where('temp_article_costing_details', array('ac_id' => $this->input->post('cost_id'), 'id_id' => $this->input->post('id_id')))->result()[0]->acd_id;
                
                $data_costing_update['quantity'] = $new_area2;
                $this->db->where('acd_id', $acd_id);
                $this->db->update('temp_article_costing_details', $data_costing_update);
                // echo $this->db->last_query();
            }elseif($tab == 'article_cost_table_clone'){
                $cost_id = $this->input->post('cost_id');
                $id_id = $this->input->post('id_id');
                $table = 'temp_article_costing_measurements';
                $this->db->where('ac_id', $cost_id)->where('id_id', $id_id)->delete($table);
                $table = 'temp_article_costing_details';
                $this->db->where('acd_id', $pk)->delete($table);
            }else{
                $table = 'temp_article_costing_charges';
                $data['res'] = $this->db
                    ->select('charges.charge as charge_name, charges.c_id as charge_id, temp_article_costing_charges.percentage')
                    ->join('charges','charges.c_id = temp_article_costing_charges.c_id','left')
                    ->where("temp_article_costing_charges.percentage !=", 0)
                    ->get_where($table, array('temp_article_costing_charges.acc_id' => $pk))->result_array();
                // echo '<pre>', print_r($data), '</pre>';
                $this->db->where('acc_id', $pk)->delete($table);
            }
            $data['costing_id'] = $this->input->post('cost_id');
            $data['title'] = 'Deleted!';
            $data['type'] = 'success';
            $data['msg'] = 'Item Successfully Deleted';
            return $data;
        }

        public function delete_costing(){

            $ac_id = $this->input->post('ac_id');
            $am_id = $this->input->post('am_id');
            $data = [];
            
            // CHECK IF EXISTS IN CO OR PROFORMA
            $nr1 = $this->db->get_where('customer_order_dtl', array('am_id' => $am_id))->num_rows();
            $nr2 = $this->db->get_where('office_proforma_detail', array('am_id' => $am_id))->num_rows();
            
            if($nr1 > 0 or $nr2 > 0){
                
                $data['title'] = 'NOT DELETED';
                $data['type'] = 'warning';
                $data['msg'] = 'Article Exists in Customer Order';

            }else{

                $primary_key = $this->input->post('ac_id');
                $table_name = 'article_costing';
                $pk_field_name = 'ac_id';
             // reference table values for checking  
                $reference_array = array(
                    array(
                        "tbl_name" => "article_costing",
                        "tbl_pk_fld" => "ac_id",
                    )
                );

                $this->check_and_log_before_delete($reference_array, $primary_key, $pk_field_name, $table_name);
                
                $this->db->where('ac_id', $ac_id)->delete('article_costing_charges');
                $this->db->where('ac_id', $ac_id)->delete('article_costing_details');
                $this->db->where('ac_id', $ac_id)->delete('article_costing_measurements');
                $this->db->where('ac_id', $ac_id)->delete('article_costing');

                $data['title'] = 'Deleted!';
                $data['type'] = 'success';
                $data['msg'] = 'Costing Successfully Deleted';
            }
            
            return $data;
        }

        public function pending_clone_costing() {
            $data = [];
            return array('page'=>'transactions/article_costing_pending_clone_list_v', 'data'=>$data);
        }

        public function ajax_article_costing_clone_table_data() {
            //actual db table column names
            $column_orderable = array(
                0 => 'art_no',
                1 => 'group_name',
                2 => 'info',
                3 => 'name',
            );
            // Set searchable column fields
            $column_search = array('art_no','group_name','info','name');

            $limit = $this->input->post('length');
            $start = $this->input->post('start');
            $order = $column_orderable[$this->input->post('order')[0]['column']];
            $dir = $this->input->post('order')[0]['dir'];
            $search = $this->input->post('search')['value'];

            $rs = $this->db->get('temp_article_costing')->result();
            $totalData = count($rs);
            $totalFiltered = $totalData;

            //if not searching for anything
            if(empty($search)) {
                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing.*, article_master.*, article_groups.group_name, acc_master.name'); // article_master.art_no,article_master.info,article_master.img
                $this->db->join('article_master', 'article_master.am_id = temp_article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
                $rs = $this->db->get('temp_article_costing')->result();
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

                $this->db->select('temp_article_costing.*, article_master.*, article_groups.group_name, acc_master.name');
                $this->db->join('article_master', 'article_master.am_id = temp_article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
                $rs = $this->db->get('temp_article_costing')->result();
                $totalFiltered = count($rs);

                $this->db->limit($limit, $start);
                $this->db->order_by($order, $dir);
                $this->db->select('temp_article_costing.*, article_master.*, article_groups.group_name, acc_master.name');
                $this->db->join('article_master', 'article_master.am_id = temp_article_costing.am_id', 'left');
                $this->db->join('article_groups', 'article_groups.ag_id = article_master.ag_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left');
                $rs = $this->db->get('temp_article_costing')->result();

                $this->db->flush_cache();
            }

            $data = array();
            foreach ($rs as $val) {
                if($val->img){$img='<img src="'.base_url('assets/admin_panel/img/article_img/'.$val->img).'" width="50">';} else{$img='';}
                if($val->status == '1'){$status='Enable';} else{$status='Disable';}

                $nestedData['art_no'] = $val->art_no;
                $nestedData['group_name'] = $val->group_name;
                $nestedData['info'] = $val->info;
                $nestedData['name'] = $val->name;
                $nestedData['exworks_amt'] = $val->exworks_amt;
                $nestedData['fob_amt'] = $val->fob_amt;
                $nestedData['cf_amt'] = $val->cf_amt;
                $nestedData['img'] = $img;
                $nestedData['status'] = $status;
                $nestedData['action'] = '
                <a target="_blank" href="'. base_url('admin/article_costing_clone_delete/'.$val->ac_id) .'" class="btn btn-danger delete1" del-pk= "'.$val->ac_id.'"><i class="fa fa-times"></i> Delete</a>
                ';
                // <a href="'. base_url('admin/delete_article_costing/'.$val->ac_id) .'" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                $data[] = $nestedData;
            }

            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        public function del_costing_pending_clone_list(){
            $data = [];
            $article_costing_id = $this->input->post('ac_id');
            
            // // UPDATE PART IN MASTER
            // $query_to_update_part = "UPDATE 
            // `article_parts` AS `dest`,
            //     (
            //         SELECT `temp_article_costing_measurements`.`ac_id`, `temp_article_costing_measurements`.`id_id`, `item_dtl`.`im_id`, `item_master`.`ig_id`, `temp_article_costing`.`am_id`, sum(pieces) AS pcs FROM `temp_article_costing_measurements`
            //         left join `temp_article_costing` on `temp_article_costing_measurements`.`ac_id` = `temp_article_costing`.`ac_id`
            //         left join `item_dtl` on `temp_article_costing_measurements`.`id_id` = `item_dtl`.`id_id`
            //         left join `item_master` on `item_dtl`.`im_id` = `item_master`.`im_id`
            //         where `temp_article_costing`.`ac_id` = ".$article_costing_id." group by ig_id
            //     ) AS `src`
            // SET
            //     `dest`.`quantity` = `src`.`pcs` - `dest`.`quantity`
            // WHERE
            //     `dest`.`am_id` = `src`.`am_id`
            //     and `dest`.`ig_id` = `src`.`ig_id`";

            // $this->db->query($query_to_update_part);  

            $this->db->where('ac_id', $article_costing_id)->delete('temp_article_costing_charges');
            $this->db->where('ac_id', $article_costing_id)->delete('temp_article_costing_measurements');
            $this->db->where('ac_id', $article_costing_id)->delete('temp_article_costing_details');
            $this->db->where('ac_id', $article_costing_id)->delete('temp_article_costing');

            $data['costing_id'] = $this->input->post('cost_id');
            $data['title'] = 'Deleted!';
            $data['type'] = 'success';
            $data['msg'] = 'Cloned Article Successfully Deleted';
            return $data;
        }

    }