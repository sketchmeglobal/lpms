<?php

class Report_order_status_m extends CI_Model {

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

    public function fetch_permission_matrix($user_id, $m_id){
        $user_id = $this->session->user_id;

        $is_initialised = $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->num_rows();

        if($is_initialised > 0){
            
            $blocked_by_admin = $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id, 'block_permission' => 1))->num_rows();

            if($blocked_by_admin > 0){
                $this->session->set_flashdata('title', 'Blocked or Not-set!');
                $this->session->set_flashdata('msg', 'Permission not set. Please contact admin for permission.');
                redirect(base_url('admin/dashboard'));
            }else{
                return $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->result();    
            }

        }else{
            
            return $this->db->get_where('user_permission', array('user_id' => $user_id, 'm_id' => $m_id))->result();

        }
    }

    public function report_order_status() {
        $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(15, $session_user_id); #15 = customer order 
        
        if($module_permission == 'show'){

            $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();  
        }else{
            $data['co_ids'] = $this->db->join('user_details','user_details.user_id = customer_order.user_id','left')->order_by('co_no')->get_where('customer_order', array('status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        $data['am_id_grs'] = $this->db->get_where('article_groups', array('status' => 1))->result();
        $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1))->result(); 
        return array('page'=>'reports/report_order_status_v', 'data'=>$data);
    }
    
    
    public function report_shipment_buyerwise_status() {
        $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(15, $session_user_id); #15 = customer order 
        
        if($module_permission == 'show'){

            $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();  
        }else{
            $data['co_ids'] = $this->db->join('user_details','user_details.user_id = customer_order.user_id','left')->order_by('co_no')->get_where('customer_order', array('status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        $data['am_id_grs'] = $this->db->get_where('article_groups', array('status' => 1))->result();
        $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1))->result(); 
        return array('page'=>'reports/report_shipment_buyerwise_status_v', 'data'=>$data);
    }
    
    public function report_buyerwise_shipment_details() {
        $data = array();

        if($this->input->post('submit') == 'buyer_wise_order_details'){
            
            $cos = implode (",", $this->input->post('buyer_wise_order_details'));
            
            
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            
            
                $this->db->select('office_invoice.*, acc_master.name, SUM(office_invoice_detail.quantity) AS total_quantity');
                $this->db->join('office_invoice_detail', 'office_invoice_detail.office_invoice_id = office_invoice.office_invoice_id', 'left');
                $this->db->join('acc_master', 'acc_master.am_id = office_invoice.am_id', 'left');
                $this->db->group_by('office_invoice.office_invoice_id');
                $this->db->order_by('office_invoice.office_invoice_date');
                $this->db->where_in('office_invoice.am_id', $cos);
                if($from != '' or $to != '') {
                        $this->db->where('office_invoice.office_invoice_date >=', $from);
                        $this->db->where('office_invoice.office_invoice_date <=', $to);
                    }
                $this->db->order_by('office_invoice.office_invoice_number');
                $data['result'] = $this->db->get_where('office_invoice', array('office_invoice.status' => 1))->result();
                // echo $c;

            // echo '<pre>',print_r($data['count_article']),'</pre>';
            $data['segment'] = 'buyerwise_shipment_details';
            $data['from'] = $from;
            $data['to'] = $to;
            $data['buyers_id'] = $cos;

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

    }
    
    public function report_shipment_status() {
        $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(15, $session_user_id); #15 = customer order 
        if($module_permission == 'show'){
            $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();  
        }else{
            $data['co_ids'] = $this->db->join('user_details','user_details.user_id = customer_order.user_id','left')->order_by('co_no')->get_where('customer_order', array('status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        $data['am_id_grs'] = $this->db->get_where('article_groups', array('status' => 1))->result();
        $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1))->result();
        $new_array_to_sort[] = '';
        $data['all_shipment_dates'][] = '';
        $get_all_dates = $this->db
                    ->group_by('cust_order_brk_up.ord_date')
                    ->get('cust_order_brk_up')
                    ->result();
                    if(count($get_all_dates) > 0) {
                        foreach($get_all_dates as $g_a_d) {
                            array_push($data['all_shipment_dates'], date("d-m-Y", strtotime($g_a_d->ord_date)));
                        }
                    }
        $get_all_dates1 = $this->db
                    ->where('customer_order.shipment_date !=', '0000-00-00')
                    ->group_by('customer_order.shipment_date')
                    ->get('customer_order')
                    ->result();
                    
                    if(count($get_all_dates1) > 0) {
                        foreach($get_all_dates1 as $g_a_ds) {
                            array_push($data['all_shipment_dates'], date("d-m-Y", strtotime($g_a_ds->shipment_date)));
                        }
                    }
                    $new_array_to_sort = array_unique($data['all_shipment_dates']);
                    sort($new_array_to_sort);
                    // echo '<pre>', print_r($data['all_shipment_dates']), '</pre>'; die();
        return array('page'=>'reports/report_shipment_status_v', 'data'=>$data);
    }
    public function ajax_fetch_article_on_group() {
        $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
        $module_permission = $this->_dept_wise_module_permission(15, $session_user_id); #15 = customer order 
        
        if($module_permission == 'show'){

            $am_gr = $this->input->post('am_gr'); 
            $res = $this->db
                ->select('article_master.am_id, article_master.art_no')
                // ->join('article_dtl', 'article_master.am_id = article_dtl.am_id', 'left')
                // ->join('colors', 'colors.c_id = article_dtl.lth_color_id', 'left')
                ->order_by('article_master.art_no')
                ->get_where('article_master', array('article_master.ag_id' => $am_gr, 'article_master.status' => 1))->result();
        }else{
            $am_gr = $this->input->post('am_gr'); 
            $res = $this->db
                ->select('article_master.am_id, article_master.art_no')
                // ->join('article_dtl', 'article_master.am_id = article_dtl.am_id', 'left')
                // ->join('colors', 'colors.c_id = article_dtl.lth_color_id', 'left')
                ->join('user_details','user_details.user_id = article_master.user_id','left')
                ->order_by('article_master.art_no')
                ->get_where('article_master', array('article_master.ag_id' => $am_gr, 'article_master.status' => 1, 'user_details.user_dept' => $module_permission))->result();
        }
        
        // echo $this->db->last_query();    
        // echo '<pre>',print_r($res),'</pre>'; die;
        return $res;    
    }
    
    public function report_order_status_details() {
        $data = array();

        if($this->input->post('submit') == 'order_details'){
            
            $cos = implode (",", $this->input->post('customer_order'));
            
            $data['result'] = $this->_custom_order_status_on_co_id($cos);
            
            foreach($this->input->post('customer_order') as $c) {
                $data['count_article'] = $this->db->select('count(article_master.am_id) as count_am')
                ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
                ->where('customer_order.co_id', $c)
                ->get_where('customer_order')->result();
                // echo $c;
            }

            // echo '<pre>',print_r($data['count_article']),'</pre>';
            $data['segment'] = 'order_details';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

        if($this->input->post('submit') == 'article_wise_order_details'){
            $ar_dtls = $this->input->post('article_number');
            
            // $query = "
            // SELECT
            //     GROUP_CONCAT(co_details.co_id) AS cos
            //     FROM
            //         (
            //         SELECT
            //             co_id
            //         FROM
            //             `article_dtl`
            //         LEFT JOIN customer_order_dtl ON customer_order_dtl.am_id = article_dtl.am_id AND customer_order_dtl.lc_id = article_dtl.lth_color_id
            //         WHERE
            //             article_dtl.ad_id IN($ar_dtls)
            //         GROUP BY
            //             co_id
            //     ) AS co_details
            // ";

            // $cos = $this->db->query($query)->result()[0]->cos;
            
            foreach($ar_dtls as $a_d) {

            $data['result'][] = $this->_custom_order_status_on_co_id_article($a_d);
            
            }
            
            // echo '<pre>', print_r($data['result']), '</pre>'; die();
            $data['segment'] = 'article_wise_order_details';

            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        if($this->input->post('submit') == 'buyer_wise_order_details'){
            
            // DEPARTMENT WISE FILTER

            $buyers = implode (",", $this->input->post('buyer_wise_order_details'));
            $current_user = $this->session->user_id;
            $current_dep = $this->db->get_where('user_details', array('user_id' => $current_user))->row()->user_dept;
            
            $query1 = "
            SELECT
                GROUP_CONCAT(user_id) AS user_ids
                FROM user_details
                WHERE user_dept = $current_dep;
            "; 
            $uids = $this->db->query($query1)->result()[0]->user_ids;
            
            $query = "
            SELECT
                GROUP_CONCAT(co_details.co_id) AS cos
                FROM
                    (
                    SELECT
                        co_id
                    FROM
                        `customer_order`
                    WHERE
                        customer_order.acc_master_id IN($buyers)
                        AND customer_order.user_id IN($uids)
                    GROUP BY
                        co_id
                ) AS co_details
            ";

            $cos = $this->db->query($query)->result()[0]->cos;
            
            // ECHO $this->db->last_query(); die;

            $data['result'] = $this->_custom_order_status_on_co_id_buyer($cos);
            $data['segment'] = 'buyer_wise_order_details';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        if($this->input->post('submit') == 'buyer_wise_order_details_pending'){

            $buyers = implode (",", $this->input->post('buyer_wise_order_details'));
            $current_user = $this->session->user_id;
            $current_dep = $this->db->get_where('user_details', array('user_id' => $current_user))->row()->user_dept;
            
            $query1 = "
            SELECT
                GROUP_CONCAT(user_id) AS user_ids
                FROM user_details
                WHERE user_dept = $current_dep;
            "; 
            $uids = $this->db->query($query1)->result()[0]->user_ids;
            
            $query = "
            SELECT
                GROUP_CONCAT(co_details.co_id) AS cos
                FROM
                    (
                    SELECT
                        co_id
                    FROM
                        `customer_order`
                    WHERE
                        customer_order.acc_master_id IN($buyers)
                    GROUP BY
                        co_id
                ) AS co_details
            ";

            $cos = $this->db->query($query)->result()[0]->cos;
            
            $data['result'] = $this->_custom_order_status_on_co_id_buyer_pending($cos);
            $data['segment'] = 'buyer_wise_order_details_pending';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        if($this->input->post('submit') == 'order_details_with_brkup_anty_details'){
            
            $cos = implode (",", $this->input->post('customer_order'));
            
            $data['result'] = $this->_custom_order_status_on_co_id($cos);
            
            foreach($this->input->post('customer_order') as $c) {
                $data['count_article'] = $this->db->select('count(article_master.am_id) as count_am')
                ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
                ->where('customer_order.co_id', $c)
                ->get_where('customer_order')->result();
                // echo $c;
            }

            // echo '<pre>',print_r($data['count_article']),'</pre>';
            $data['segment'] = 'order_details_with_brkup_quantity_details';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        if($this->input->post('submit') == 'buyer_and_article_wise_order_details_pending'){

            $buyers = implode (",", $this->input->post('buyer_wise_order_details'));
            $current_user = $this->session->user_id;
            $current_dep = $this->db->get_where('user_details', array('user_id' => $current_user))->row()->user_dept;
            
            $query1 = "
            SELECT
                GROUP_CONCAT(user_id) AS user_ids
                FROM user_details
                WHERE user_dept = $current_dep;
            "; 
            $uids = $this->db->query($query1)->result()[0]->user_ids;
            
            $query = "
            SELECT
                GROUP_CONCAT(co_details.co_id) AS cos
                FROM
                    (
                    SELECT
                        co_id
                    FROM
                        `customer_order`
                    WHERE
                        customer_order.acc_master_id IN($buyers)
                        AND customer_order.user_id IN($uids)
                    GROUP BY
                        co_id
                ) AS co_details
            ";

            $cos = $this->db->query($query)->result()[0]->cos;
            
            $data['result'] = $this->_custom_order_status_buyer_and_article_wise_order_details_pending($cos);
            $data['segment'] = 'buyer_wise_order_and_article_details_pending';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

        if($this->input->post('submit') == 'order_summary'){
            // echo '<h1>DEVELOPMENT GOING ON</h1>';
            $cos = implode (",", $this->input->post('customer_order'));

            $data['result'] = $this->_custom_order_summary_on_co_id($cos);
            $data['segment'] = 'order_summary';

            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        return array('page'=>'reports/report_order_status_v', 'data'=>$data);
    }
    
    public function report_shipment_details() {
        $data = array();

        if($this->input->post('submit') == 'order_details_with_brkup_anty_details'){
            
            $cos = implode (",", $this->input->post('customer_order'));
            
            $data['result'] = $this->_custom_order_status_on_co_id($cos);
            
            foreach($this->input->post('customer_order') as $c) {
                $data['count_article'] = $this->db->select('count(article_master.am_id) as count_am')
                ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                ->join('article_master', 'article_master.am_id = customer_order_dtl.am_id', 'left')
                ->where('customer_order.co_id', $c)
                ->get_where('customer_order')->result();
                // echo $c;
            }

            // echo '<pre>',print_r($data['count_article']),'</pre>';
            $data['segment'] = 'order_details_with_brkup_quantity_details';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        return array('page'=>'reports/report_shipment_status_v', 'data'=>$data);
    }
    
    private function _custom_order_status_on_co_id_article($ar_dtls){
        if(empty($ar_dtls)){
            die('No details found');
        }
        
        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty
            FROM
                (
                SELECT
                    job_issue.*,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order_dtl`.`cod_id`,
                                    `article_master`.`am_id`,
                                    `colors`.`c_id`,
                                    `customer_order`.`co_no`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    `customer_order_dtl`.`co_quantity`,
                                    `article_dtl`.`ad_id`
                                FROM
                                    `customer_order_dtl`
                                LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `customer_order_dtl`.`co_id`
                                LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
                                LEFT JOIN `article_dtl` ON `article_master`.`am_id` = `article_dtl`.`am_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                                WHERE
                                    `article_dtl`.am_id = $ar_dtls
                                    GROUP BY
                                    `customer_order_dtl`.`cod_id`
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = order_table.cod_id
                        GROUP BY
                            order_table.cod_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cutting_issue.cod_id
                    GROUP BY
                        cutting_issue.cod_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.cod_id = cutting_receive.cod_id
                GROUP BY
                    cutting_receive.cod_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.cod_id = job_issue.cod_id
            GROUP BY
                job_issue.cod_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.cod_id = job_receive.cod_id
            GROUP BY
                job_receive.cod_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.cod_id = ship.cod_id
            GROUP BY
                ship.cod_id
                ORDER BY
                                    ship.am_id,
                                    ship.c_id,
                                    ship.co_no
            ";
                                    
        return $res = $this->db->query($query)->result();

    }
    
    private function _custom_order_status_on_co_id($cos){
        
        if(empty($cos)){
            die('No details found');
        }
        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                jobber_challan_receipt_details.jobber_challan_receipt_id,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty,
                jobber_challan_receipt.jobber_receipt_challan_date,
                  GROUP_CONCAT(
                    CONCAT_WS(
                      ' : ', jobber_challan_receipt.jobber_receipt_challan_number, 
                      jobber_challan_receipt_details.jobber_receive_quantity
                    ) SEPARATOR '<br>'
                  ) AS jobr
            FROM
                (
                SELECT
                    job_issue.*,
                    jobber_issue_details.jobber_issue_id,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty,
                    jobber_issue.jobber_issue_date,
                      GROUP_CONCAT(
                        CONCAT_WS(
                          ' : ', jobber_issue.jobber_challan_number, 
                          jobber_issue_details.jobber_issue_quantity
                        ) SEPARATOR '<br>'
                      ) AS jobi
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            cutting_received_challan_detail.cut_rcv_id,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                cutting_issue_challan_details.cut_id,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order_dtl`.`cod_id`,
                                    `article_master`.`am_id`,
                                    `colors`.`c_id`,
                                    `customer_order`.`co_no`,
                                    `article_master`.`art_no`,
                                    `customer_order_dtl`.`lc_id`,
                                    `customer_order`.`co_date`,
                                    `customer_order`.`shipment_date`,
                                    `colors`.`color`,
                                    `customer_order_dtl`.`co_quantity`
                                FROM
                                    `customer_order`
                                LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id`
                                LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                                WHERE
                                    `customer_order`.co_id IN($cos)
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = order_table.cod_id
                        GROUP BY
                            order_table.cod_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cutting_issue.cod_id
                    GROUP BY
                        cutting_issue.cod_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.cod_id = cutting_receive.cod_id
                GROUP BY
                    cutting_receive.cod_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.cod_id = job_issue.cod_id
            LEFT JOIN jobber_issue ON jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id
            GROUP BY
                job_issue.cod_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.cod_id = job_receive.cod_id
            LEFT JOIN jobber_challan_receipt ON jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id
            GROUP BY
                job_receive.cod_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.cod_id = ship.cod_id
            GROUP BY
                ship.cod_id
                ORDER BY
                                    `ship`.`co_id`,
                                    ship.art_no,
                                    ship.color
            ";

            $rdata = $this->db->query($query)->result();
            // echo $this->db->last_query();die;
            return $rdata;
    }

    private function _custom_order_status_on_co_id_sum($cos){
        if(empty($cos)){
            die('No details found');
        }
        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty
            FROM
                (
                SELECT
                    job_issue.*,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order_dtl`.`cod_id`,
                                    `customer_order`.`co_no`,
                                    SUM(
                                     co_quantity
                                         ) AS co_quantity
                                FROM
                                    `customer_order`
                                LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id`
                                WHERE
                                    `customer_order`.co_id IN($cos)
                                    GROUP BY
                            customer_order.co_id
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.co_id = order_table.co_id
                        GROUP BY
                            order_table.co_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cutting_issue.cod_id
                    GROUP BY
                        cutting_issue.cod_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.cod_id = cutting_receive.cod_id
                GROUP BY
                    cutting_receive.cod_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.cod_id = job_issue.cod_id
            GROUP BY
                job_issue.cod_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.cod_id = job_receive.cod_id
            GROUP BY
                job_receive.cod_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.cod_id = ship.cod_id
            GROUP BY
                ship.cod_id    
            ";

            return $this->db->query($query)->result();
    }

    private function _custom_order_summary_on_co_id($cos){
        if(empty($cos)){
            die('No details found');
        }
        $query = "
            SELECT 
              ship_table.*, 
              SUM(packing_shipment.total_quantity) AS total_quantity,
              CONCAT_WS(
                ' : ', packing_shipment.package_name, 
                packing_shipment.total_quantity
              ) AS ship 
            FROM 
              (
                SELECT 
                  ji_table.*, 
                  jobber_challan_receipt_details.jobber_challan_receipt_id, 
                  SUM(jobber_challan_receipt_details.jobber_receive_quantity) AS jobber_receive_quantity,
                  jobber_challan_receipt.jobber_receipt_challan_date,
                  GROUP_CONCAT(
                    CONCAT_WS(
                      ' : ', jobber_challan_receipt.jobber_receipt_challan_number, 
                      jobber_challan_receipt_details.jobber_receive_quantity
                    ) SEPARATOR '<br>'
                  ) AS jobr 
                FROM 
                  (
                    SELECT 
                      sr_table.*, 
                      jobber_issue_details.jobber_issue_id, 
                      SUM(jobber_issue_details.jobber_issue_quantity) AS jobber_issue_quantity,
                      jobber_issue.jobber_issue_date,
                      GROUP_CONCAT(
                        CONCAT_WS(
                          ' : ', jobber_issue.jobber_challan_number, 
                          jobber_issue_details.jobber_issue_quantity
                        ) SEPARATOR '<br>'
                      ) AS jobi 
                    FROM 
                      (
                        SELECT 
                          cr_table.*, 
                          SUM(skiving_receive_challan_details.receive_quantity) AS receive_quantity,
                          skiving_receive_challan.skiving_receive_date,
                          GROUP_CONCAT(
                            CONCAT_WS(
                              ' : ', skiving_receive_challan.skiving_receive_challan_number, 
                              skiving_receive_challan_details.receive_quantity
                            ) SEPARATOR '<br>'
                          ) AS sr 
                        FROM 
                          (
                            SELECT 
                              ci_table.*, 
                              cutting_received_challan.cut_rcv_id AS cutting_receive_id, 
                              SUM(cutting_received_challan_detail.receive_cut_quantity) AS receive_cut_quantity,
                              cutting_received_challan.cut_rcv_date,
                              GROUP_CONCAT(
                                CONCAT_WS(
                                  ' : ', cutting_received_challan.cut_rcv_number, 
                                  cutting_received_challan_detail.receive_cut_quantity
                                ) SEPARATOR '<br>'
                              ) AS cr 
                            FROM 
                              (
                                SELECT 
                                  order_table.*, 
                                  cutting_issue_challan.cut_id AS cutting_issue_id, 
                                  cutting_issue_challan.cut_date,
                                  SUM(cutting_issue_challan_details.cut_co_quantity) AS cut_co_quantity,
                                  GROUP_CONCAT(
                                    CONCAT_WS(
                                      ' : ', cutting_issue_challan.cut_number, 
                                      cutting_issue_challan_details.cut_co_quantity
                                    ) SEPARATOR '<br>'
                                  ) AS ci 
                                FROM 
                                  (
                                    SELECT 
                                      `customer_order`.`co_id`, 
                                      `customer_order_dtl`.`cod_id`, 
                                      `article_master`.`am_id`, 
                                      `colors`.`c_id`, 
                                      `customer_order`.`co_no`, 
                                      `customer_order`.`co_date`,
                                      `article_master`.`art_no`, 
                                      `colors`.`color`, 
                                      `customer_order_dtl`.`co_quantity`,
                                      `customer_order_dtl`.`lc_id`
                                    FROM 
                                      `customer_order` 
                                      LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id` 
                                      LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id` 
                                      LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id` 
                                    WHERE 
                                      `customer_order`.co_id IN($cos) 
                                    ORDER BY 
                                      article_master.am_id, 
                                      colors.c_id
                                  ) AS order_table 
                                  LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = order_table.cod_id 
                                  LEFT JOIN cutting_issue_challan ON cutting_issue_challan_details.cut_id = cutting_issue_challan.cut_id 
                                GROUP BY 
                                  order_table.cod_id
                              ) AS ci_table 
                              LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = ci_table.cod_id 
                              LEFT JOIN cutting_received_challan ON cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id 
                            GROUP BY 
                              cod_id
                          ) AS cr_table 
                          LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.cod_id = cr_table.cod_id 
                          LEFT JOIN skiving_receive_challan ON skiving_receive_challan.skiving_receive_id = skiving_receive_challan_details.skiving_receive_id 
                        GROUP BY 
                          cod_id
                      ) AS sr_table 
                      LEFT JOIN jobber_issue_details ON jobber_issue_details.cod_id = sr_table.cod_id 
                      LEFT JOIN jobber_issue ON jobber_issue.jobber_issue_id = jobber_issue_details.jobber_issue_id 
                    GROUP BY 
                      cod_id
                  ) AS ji_table 
                  LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.cod_id = ji_table.cod_id 
                  LEFT JOIN jobber_challan_receipt ON jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id 
                GROUP BY 
                  cod_id
              ) AS ship_table 
              LEFT JOIN packing_shipment_detail ON packing_shipment_detail.cod_id = ship_table.cod_id 
              LEFT JOIN packing_shipment ON packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id
            GROUP BY 
              cod_id";

            $res = $this->db->query($query)->result();
            // echo '<pre>', print_r($res), '</pre>'; die();
            return $res;
    }

    private function _custom_order_status_on_co_id_buyer_pending($cos){
        
        $user_id = $this->session->user_id;
        
        $dept_id = $this->db->get_where('user_details', array('user_id'=> $user_id))->row()->user_dept;
        
        if(empty($cos)){
            die('No details found');
        }

        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty
            FROM
                (
                SELECT
                    job_issue.*,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order`.`buyer_reference_no`,
                                    `customer_order_dtl`.`cod_id`,
                                    `article_master`.`am_id`,
                                    `colors`.`c_id`,
                                    `customer_order`.`co_no`,
                                    `customer_order_dtl`.`lc_id`,
                                    `customer_order`.`co_date`,
                                    `customer_order`.`co_delivery_date`,
                                    `customer_order`.`shipment_date`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    IFNULL(
                                SUM(
                                    `customer_order_dtl`.`co_quantity`
                                ),
                                0
                            ) AS co_quantity,
                                    `acc_master`.`name`,
                                    `customer_order`.`acc_master_id`,
                                    `customer_order`.`user_id`
                                FROM
                                    `customer_order`
                                LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id`
                                LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
                                LEFT JOIN `acc_master` ON `acc_master`.`am_id` = `customer_order`.`acc_master_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                                LEFT JOIN `user_details` ON `user_details`.`user_id` = `customer_order`.`user_id`
                                WHERE
                                    `customer_order`.co_id IN($cos)
                                    GROUP BY
                                      customer_order.co_id
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.co_id = order_table.co_id
                        GROUP BY
                            order_table.co_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.co_id = cutting_issue.co_id
                    GROUP BY
                        cutting_issue.co_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.co_id = cutting_receive.co_id
                GROUP BY
                    cutting_receive.co_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.co_id = job_issue.co_id
            GROUP BY
                job_issue.co_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.co_id = job_receive.co_id
            GROUP BY
                job_receive.co_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.co_id = ship.co_id
            GROUP BY
                ship.co_id
                ORDER BY
                ship.acc_master_id, ship.buyer_reference_no
            ";

            return $this->db->query($query)->result();
    }
    
    private function _custom_order_status_buyer_and_article_wise_order_details_pending($cos){
        
        $user_id = $this->session->user_id;
        
        $dept_id = $this->db->get_where('user_details', array('user_id'=> $user_id))->row()->user_dept;
        
        if(empty($cos)){
            die('No details found');
        }
        
        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty
            FROM
                (
                SELECT
                    job_issue.*,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order_dtl`.`cod_id`,
                                    `article_master`.`am_id`,
                                    `colors`.`c_id`,
                                    `customer_order`.`co_no`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    `customer_order_dtl`.`co_quantity`,
                                    `acc_master`.`name`,
                                    `customer_order`.`user_id`
                                FROM
                                    `customer_order`
                                LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id`
                                LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
                                LEFT JOIN `acc_master` ON `acc_master`.`am_id` = `customer_order`.`acc_master_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                                LEFT JOIN `user_details` ON `user_details`.`user_id` = `customer_order`.`user_id`
                                WHERE
                                    `customer_order`.co_id IN($cos) AND `user_details`.user_dept = $dept_id
                                ORDER BY
                                    article_master.am_id,
                                    colors.c_id
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.cod_id = order_table.cod_id
                        GROUP BY
                            order_table.cod_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.cod_id = cutting_issue.cod_id
                    GROUP BY
                        cutting_issue.cod_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.cod_id = cutting_receive.cod_id
                GROUP BY
                    cutting_receive.cod_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.cod_id = job_issue.cod_id
            GROUP BY
                job_issue.cod_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.cod_id = job_receive.cod_id
            GROUP BY
                job_receive.cod_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.cod_id = ship.cod_id
            GROUP BY
                ship.cod_id
            ORDER BY
                        ship.co_no
            ";

            return $this->db->query($query)->result();
    }
    
    private function _custom_order_status_on_co_id_buyer($cos){
        if(empty($cos)){
            die('No details found');
        }

        $query = "
            SELECT
                ship.*,
                SUM(
                    IFNULL(
                        packing_shipment_detail.article_quantity,
                        0
                    )
                ) AS packing_shipment_quantity,
                packing_shipment_detail.status AS pack_status
            FROM
                (
            SELECT
                job_receive.*,
                SUM(
                    IFNULL(
                        jobber_challan_receipt_details.jobber_receive_quantity,
                        0
                    )
                ) AS jobber_receive_qnty
            FROM
                (
                SELECT
                    job_issue.*,
                    SUM(
                        IFNULL(
                            jobber_issue_details.jobber_issue_quantity,
                            0
                        )
                    ) AS jobber_issue_qnty
                FROM
                    (
                    SELECT
                        cutting_receive.*,
                        SUM(
                            IFNULL(
                                skiving_receive_challan_details.receive_quantity,
                                0
                            )
                        ) AS skiving_receive_qnty
                    FROM
                        (
                        SELECT
                            cutting_issue.*,
                            IFNULL(
                                SUM(
                                    cutting_received_challan_detail.receive_cut_quantity
                                ),
                                0
                            ) AS cutting_received_qnty,
                            IF(
                                (
                                SELECT
                                    skiving_issue_status
                                FROM
                                    cutting_received_challan
                                WHERE
                                    cutting_received_challan.cut_rcv_id = cutting_received_challan_detail.cut_rcv_id
                            ) = 0 OR cutting_issued_qnty = 0,
                            NULL,
                            'ok'
                            ) AS skiving_issued
                        FROM
                            (
                            SELECT
                                order_table.*,
                                IFNULL(SUM(cut_co_quantity),
                                0) AS cutting_issued_qnty
                            FROM
                                (
                                SELECT
                                    `customer_order`.`co_id`,
                                    `customer_order_dtl`.`cod_id`,
                                    `article_master`.`am_id`,
                                    `colors`.`c_id`,
                                    `customer_order`.`co_no`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    `acc_master`.`name`,
                                    SUM(
                                     co_quantity
                                         ) AS co_quantity
                                FROM
                                    `customer_order`
                                LEFT JOIN `customer_order_dtl` ON `customer_order_dtl`.`co_id` = `customer_order`.`co_id`
                                LEFT JOIN `article_master` ON `customer_order_dtl`.`am_id` = `article_master`.`am_id`
                                LEFT JOIN `acc_master` ON `acc_master`.`am_id` = `customer_order`.`acc_master_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                                WHERE
                                    `customer_order`.co_id IN($cos)
                                    GROUP BY
                                      customer_order.co_id
                                    ORDER BY  
                                        customer_order.co_no
                            ) AS order_table
                        LEFT JOIN cutting_issue_challan_details ON cutting_issue_challan_details.co_id = order_table.co_id
                        GROUP BY
                            order_table.co_id
                        ) AS cutting_issue
                    LEFT JOIN cutting_received_challan_detail ON cutting_received_challan_detail.co_id = cutting_issue.co_id
                    GROUP BY
                        cutting_issue.co_id
                    ) AS cutting_receive
                LEFT JOIN skiving_receive_challan_details ON skiving_receive_challan_details.co_id = cutting_receive.co_id
                GROUP BY
                    cutting_receive.co_id
                ) AS job_issue
            LEFT JOIN jobber_issue_details ON jobber_issue_details.co_id = job_issue.co_id
            GROUP BY
                job_issue.co_id
            ) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.co_id = job_receive.co_id
            GROUP BY
                job_receive.co_id
            ) AS ship
            LEFT JOIN packing_shipment_detail ON packing_shipment_detail.co_id = ship.co_id
            GROUP BY
                ship.co_id
            ORDER BY  
                ship.co_no, ship.name
            ";

            return $this->db->query($query)->result();
    }
    
public function jobber_ledger_status($job , $from, $to, $job_type) {

if($this->input->post()) {
 $buyers = implode (",", $job);
            
            $query = "
            SELECT
                GROUP_CONCAT(co_details.co_id) AS cos
                FROM
                    (
                    SELECT
                        jobber_issue_details.co_id
                    FROM
                        `jobber_issue`
                        LEFT JOIN `jobber_issue_details` ON `jobber_issue_details`.`jobber_issue_id` = `jobber_issue`.`jobber_issue_id`
                    WHERE
                        jobber_issue.am_id IN($buyers)
                    GROUP BY
                        jobber_issue_details.jobber_issue_id
                ) AS co_details
            ";

            $cos = $this->db->query($query)->result()[0]->cos;
            
            if($job_type == 'n_recv') {

            $data['result'] = $this->_fetch_all_jobber_report_n_recv_m($job, $from, $to);
            
            } else {
                $data['result'] = $this->_fetch_all_jobber_report_m($job, $from, $to);
            }
        
        if($job_type == 'zero') {
            $data['segment'] = 'jobber_ledger_status_report';
        } else if($job_type == 'n_zero') {
          $data['segment'] = 'jobber_ledger_status_report_non_zero';  
        } else {
          $data['segment'] = 'jobber_ledger_status_report_not_received';  
        }

            return array('page'=>'reports/common_print_v', 'data'=>$data);
        }

$data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('acc_type' => 'Fabricator', 'status' => 1))->result();

        return array('page'=>'reports/jobber_ledger_v', 'data'=>$data);
    }
    
    public function _fetch_all_jobber_report_m($cos, $from, $to) {
        if(empty($cos)){
            die('No details found');
        }
        
        foreach($cos as $c) {

        $query = "SELECT
                job_receive.*,
                  jobber_challan_receipt_details.jobber_challan_receipt_id, 
                  SUM(jobber_challan_receipt_details.jobber_receive_quantity) AS jobber_receive_quantity,
                  GROUP_CONCAT(
                  (jobber_challan_receipt.jobber_receipt_challan_number
                    ) SEPARATOR '<br>'
                  ) AS jobr_challan,
                  GROUP_CONCAT( DATE_FORMAT( jobber_challan_receipt.jobber_receipt_challan_date, '%d-%m-%Y' ) SEPARATOR '<br>') as jobr_challan_date,
                  GROUP_CONCAT(
                    CONCAT_WS(
                      ' : ', jobber_challan_receipt_details.jobber_receive_quantity
                    ) SEPARATOR '<br>'
                  ) AS jobr_challan_receive_quantity
            FROM
                (SELECT
                    jobber_issue.jobber_challan_number,
                    DATE_FORMAT(jobber_issue.jobber_issue_date, '%d-%m-%Y') as jobber_issue_date,
                        jobber_issue.jobber_issue_id,
                       SUM(jobber_issue_details.jobber_issue_quantity
                ) AS jobber_issue_quantity,
                `jobber_issue_details`.`am_id`,
                `colors`.`c_id`,
                `jobber_issue_details`.`co_id`,
                `customer_order`.`co_no`,
                `article_master`.`art_no`,
                `colors`.`color`,
                `acc_master`.`name`,
                `acc_master`.`address`
                FROM `jobber_issue_details`
            LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `jobber_issue_details`.`co_id`
            LEFT JOIN `article_master` ON `jobber_issue_details`.`am_id` = `article_master`.`am_id`
            LEFT JOIN `jobber_issue` ON `jobber_issue`.`jobber_issue_id` = `jobber_issue_details`.`jobber_issue_id`
            LEFT JOIN `acc_master` ON `acc_master`.`am_id` = `jobber_issue`.`am_id`
            LEFT JOIN `colors` ON `colors`.`c_id` = `jobber_issue_details`.`lc_id`
            where STR_TO_DATE(jobber_issue.jobber_issue_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(jobber_issue.jobber_issue_date, '%Y-%m-%d') >= '$from'
            AND
                                    `jobber_issue`.am_id = $c
            GROUP BY
            jobber_issue_details.jobber_issue_id, jobber_issue_details.cod_id) AS job_receive
            LEFT JOIN jobber_challan_receipt_details ON jobber_challan_receipt_details.jobber_challan_number = job_receive.jobber_issue_id AND jobber_challan_receipt_details.co_id = job_receive.co_id AND jobber_challan_receipt_details.am_id = job_receive.am_id AND jobber_challan_receipt_details.lc_id = job_receive.c_id 
            LEFT JOIN jobber_challan_receipt ON jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id
            GROUP BY
                 jobber_challan_receipt_details.jobber_challan_number, jobber_challan_receipt_details.cod_id
                ORDER BY
                job_receive.jobber_challan_number,
                                    job_receive.am_id,
                                    job_receive.c_id,
                                    jobber_challan_receipt.jobber_receipt_challan_date
            ";

            $res = $this->db->query($query)->result();
            
        }
            // echo '<pre>', print_r($res), '</pre>'; die();
            // echo $this->db->last_query(); die();
            return $res;
    }
    
    public function purchase_order_audit_report() {
        $data = array();
        
        $data['fetch_all_leather'] = $this->db
            ->get_where('item_groups', array('item_groups.status' => 1))->result();
            
            $data['co_ids'] = $this->db->get_where('customer_order', array('status' => 1))->result();

        return array('page'=>'reports/report_purchase_order_audit_report','data'=>$data);
    }
    
     public function purchase_order_audit_report_details_values() {

            $order_no = $this->input->post('order_no');
            $item_name = $this->input->post('item_name');

            
                $this->db->select('customer_order.*');
                $this->db->where_in("customer_order.co_id", $order_no);
                $data['result'] = $this->db->get_where('customer_order', array('customer_order.status' => 1))->result();
                // foreach ($order_no as $orde_n) {
                // $this->db->select('purchase_ord_brk_up.*');
                // $this->db->where("FIND_IN_SET(".$orde_n.", purchase_ord_brk_up.cod_id)");
                // $data['result'][] = $this->db->get_where('purchase_ord_brk_up', array('purchase_ord_brk_up.status' => 1))->result();
                // }

            // echo '<pre>',print_r($data['count_article']),'</pre>';
            $data['segment'] = 'purchase_order_audit_report';
            $data['order_no'] = $order_no;
            $data['item_name'] = $item_name;

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
    
    public function _fetch_all_jobber_report_n_recv_m($cos, $from, $to) {
        if(empty($cos)){
            die('No details found');
        }
        
        foreach($cos as $c) {

        $query = "SELECT
                    jobber_issue.jobber_challan_number,
                    DATE_FORMAT(jobber_issue.jobber_issue_date, '%d-%m-%Y') as jobber_issue_date,
                        jobber_issue.jobber_issue_id,
                       SUM(jobber_issue_details.jobber_issue_quantity
                ) AS jobber_issue_quantity,
                `jobber_issue_details`.`am_id`,
                `colors`.`c_id`,
                `jobber_issue_details`.`co_id`,
                `customer_order`.`co_no`,
                `article_master`.`art_no`,
                `colors`.`color`,
                `jobber_issue_details`.`cod_id`,
                `acc_master`.`name`,
                `acc_master`.`address`
                FROM `jobber_issue_details`
            LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `jobber_issue_details`.`co_id`
            LEFT JOIN `article_master` ON `jobber_issue_details`.`am_id` = `article_master`.`am_id`
            LEFT JOIN `jobber_issue` ON `jobber_issue`.`jobber_issue_id` = `jobber_issue_details`.`jobber_issue_id`
            LEFT JOIN `acc_master` ON `acc_master`.`am_id` = `jobber_issue`.`am_id`
            LEFT JOIN `colors` ON `colors`.`c_id` = `jobber_issue_details`.`lc_id`
            where STR_TO_DATE(jobber_issue.jobber_issue_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(jobber_issue.jobber_issue_date, '%Y-%m-%d') >= '$from'
            AND
                                    `jobber_issue`.am_id = $c
            GROUP BY
            jobber_issue_details.jobber_issue_id, jobber_issue_details.cod_id
            ORDER BY article_master.art_no, colors.color
            ";

            $res = $this->db->query($query)->result();
            
        }
            // echo '<pre>', print_r($res), '</pre>'; die();
            // echo $this->db->last_query(); die();
            return $res;
    }
    
    public function fetch_report_leather_status() {
        $data = [];

        if($this->input->post('print') == 'Print(P.O. wise)'){
           $la =$this->input->post('leather');
           // echo $la = implode (",", $this->input->post('leather'));
           // echo $la; die;
            $data['result'] = $this->_custom_leather_status_po_summary_on_co_id($la);
            $data['item_id'] = $la;
            $data['segment'] = 'leather_status_po';
            $data['segment1'] = 'leather_status_po';

            // echo '<pre>',print_r($data['result']),'</pre>'; die(); 

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

        if($this->input->post('print') == 'Print'){
           // $la =$this->input->post('leather');
           $la = implode (",", $this->input->post('leather'));
           // echo $la; die;
           // foreach($la as $l) {
            // $data['customer_order'] = $this->_custom_leather_status_summary_on_co_id();
            $data['result1'] = $this->_custom_leather_status_summary_on_co_id_for_pur_order($la);
            
            // }
            $data['item_id'] = $la;
            $data['segment'] = 'leather_status';
            $data['segment1'] = 'leather_status';

            // echo '<pre>',print_r($data['result1']),'</pre>'; die(); 

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        if($this->input->post('print') == 'Print(Pending Orders)'){
           // $la =$this->input->post('leather');
           $la = implode (",", $this->input->post('leather'));
           // echo $la; die;
           // foreach($la as $l) {
            // $data['customer_order'] = $this->_custom_leather_status_summary_on_co_id();
            $data['result1'] = $this->_custom_leather_status_summary_on_co_id_for_pur_order($la);
            
            // }
            $data['item_id'] = $la;
            $data['segment'] = 'leather_status_pending_orders';
            $data['segment1'] = 'leather_status_pending_orders';

            // echo '<pre>',print_r($data['result1']),'</pre>'; die(); 

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

        if($this->input->post('print') == 'Print (New)'){
            // $la =$this->input->post('leather');
            $item_dtl_ids = implode (",", $this->input->post('leather'));
            // $data['result1'] = $this->_custom_leather_status_summary_on_co_id_for_pur_order($la);
             
            $costing_details = $this->db
                ->select('article_costing.ac_id,article_costing_details.id_id,article_costing_details.quantity as costin_qnty, article_costing.am_id, combination_or_not')
                ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                ->where_in(array('id_id' => $item_dtl_ids))
                ->get('article_costing_details')->result();

            echo '<pre>';print_r($costing_details); die;

            $data['item_id'] = $item_dtl_ids;
            $data['segment'] = 'leather_status';
            $data['segment1'] = 'leather_status';
 
            // echo '<pre>',print_r($data['result1']),'</pre>'; die(); 

            
 
             return array('page'=>'reports/common_print_v','data'=>$data);
 
        }
        
        $data['fetch_all_leather'] = $this->db
        ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
        ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
        ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
        ->order_by('item_master.item, colors.color')
        ->get_where('item_dtl', array('item_dtl.status' => 1, 'item_groups.ig_id' => 1))->result();

        return array('page'=>'reports/leather_status_v', 'data'=>$data);
    }

    public function fetch_report_item_status() {
        $data = array();

        if($this->input->post('print') == 'Print(P.O. wise)'){
           $la =$this->input->post('leather');
           // echo $la = implode (",", $this->input->post('leather'));
           // echo $la; die;
            $data['result'] = $this->_custom_leather_status_po_summary_on_co_id($la);
            $data['item_id'] = $la;
            $data['segment'] = 'leather_status_po';
            $data['segment1'] = 'item_status_po';

            // echo '<pre>',print_r($data['result']),'</pre>'; die(); 

            return array('page'=>'reports/common_print_v','data'=>$data);

        }

        if($this->input->post('print') == 'Print'){
           // $la =$this->input->post('leather');
           $la = implode (",", $this->input->post('leather'));
           // echo $la; die;
           // foreach($la as $l) {
            $data['customer_order'] = $this->_custom_leather_status_summary_on_co_id_item_status($la);
            $data['result1'] = $this->_custom_leather_status_summary_on_co_id_for_pur_order($la);
            
            // }
            $data['item_id'] = $la;
            $data['segment'] = 'item_status';
            $data['segment1'] = 'item_status';

            // echo '<pre>',print_r($data['result1']),'</pre>'; die(); 

            return array('page'=>'reports/common_print_v','data'=>$data);
        }
            $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1, 'ig_id !=' => 1))->result();
        return array('page'=>'reports/item_status_v', 'data'=>$data);
    }
    private function  _custom_leather_status_po_summary_on_co_id($la){
        if(empty($la)){
            die('No details found');
        }
        $result = $this->db->select('item_dtl.*, item_master.item, colors.color, purchase_order.po_id, acc_master.name')
            ->join('purchase_order_details', 'purchase_order_details.po_id = purchase_order.po_id', 'left')
             ->join('item_dtl', 'item_dtl.id_id = purchase_order_details.id_id', 'left')
             ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
             ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
             ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
             ->where_in('purchase_order_details.id_id', $la)
             ->where('purchase_order.status', '1')
             ->group_by('item_dtl.id_id')
             ->order_by('item_master.item, colors.color')
            //  ->order_by('purchase_order.po_number')
             ->get_where('purchase_order')->result();

             return $result;
    }

    public function  _custom_leather_status_summary_on_co_id(){

$query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                item_master.item AS item_name,
                colors.color,
                colors.c_id as color_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                item_dtl.id_id,
                item_master.im_id,
                article_master.am_id,
                article_master.art_no,
                article_dtl.lth_color_id,
                item_dtl.opening_stock AS final_opening_stock,
                item_dtl.opn_qnty_for_leather_status AS final_opn_qnty_for_leather_status,
                co_quantity,
                (
                   article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                   article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_dtl ON article_dtl.am_id = article_master.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON article_costing_details.id_id = item_dtl.id_id
            LEFT JOIN colors ON customer_order_dtl.lc_id = colors.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.status = 1
            GROUP BY
                customer_order_dtl.co_id, customer_order_dtl.lc_id, item_dtl.im_id
                ";
    $res = $this->db->query($query)->result();
    
    echo '<pre>', print_r($res), '</pre>'; die();

       // return  $customer_order_id; 
            
    }
    
    public function  _custom_leather_status_summary_on_co_id_item_status($la){

$query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                item_master.item AS item_name,
                colors.color,
                colors.c_id as color_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                item_dtl.id_id,
                item_master.im_id,
                article_master.am_id,
                article_master.art_no,
                article_dtl.lth_color_id,
                item_dtl.opening_stock AS final_opening_stock,
                item_dtl.opn_qnty_for_leather_status AS final_opn_qnty_for_leather_status,
                co_quantity
                FROM
                `item_dtl`
                LEFT JOIN article_costing_details ON article_costing_details.id_id = item_dtl.id_id
                LEFT JOIN article_costing ON article_costing.ac_id = article_costing_details.ac_id
                LEFT JOIN article_master ON article_master.am_id = article_costing.am_id
                LEFT JOIN article_dtl ON article_dtl.am_id = article_master.am_id
                LEFT JOIN customer_order_dtl ON customer_order_dtl.am_id = article_master.am_id
                LEFT JOIN customer_order ON customer_order.co_id = customer_order_dtl.co_id
                LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
                LEFT JOIN colors ON colors.c_id = item_dtl.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.status = 1 AND item_dtl.id_id IN ($la)
            GROUP BY
                customer_order_dtl.co_id, item_dtl.im_id, item_dtl.c_id 
                ";
        return $this->db->query($query)->result();

       // return  $customer_order_id; 
            
    }

    private function  _custom_leather_status_summary_on_co_id_for_pur_order($la){
        if(empty($la)){
            die('No details found');
        }

$query = "SELECT
    pur_order_details.*,
    IFNULL(
        SUM(
            supp_purchase_order_detail.item_qty
        ),
        0
    ) AS final_sup_pur_order_qnty
FROM
    (
    SELECT
        stock_in_details.*,
        IFNULL(
            SUM(
                purchase_order_details.pod_quantity
            ),
            0
        ) AS final_pur_issue_qnty,
        acc_master.name
    FROM
        (
        SELECT
            mat_issue_details.*,
            IFNULL(
                SUM(
                    stock_in_detail.item_quantity
                ),
                0
            ) AS final_stock_in_qnty
        FROM
            (
            SELECT
                pur_rcv_details.*,
                IFNULL(
                    SUM(
                        material_issue_detail.issue_quantity
                    ),
                    0
                ) AS final_mat_issue_qnty
            FROM
                (
                SELECT
                    item_details.*,
                    IFNULL(
                        SUM(
                            purchase_order_receive_detail.item_quantity
                        ),
                        0
                    ) AS final_pur_rcv_qnty
                FROM
                    (
                    SELECT
                        item_master.item AS item_name,
                        colors.color,
                        article_costing.ac_id AS costing_id,
                        article_costing_details.id_id AS item_dtl,
                        article_costing_details.quantity AS item_dtl_quantity,
                        item_dtl.id_id,
                        item_master.im_id,
                        item_dtl.c_id,
                        article_costing.am_id,
                        customer_order_dtl.lc_id,
                        customer_order_dtl.co_id,
                        article_dtl.lth_color_id,
                        item_dtl.opening_stock AS final_opening_stock,
                        item_dtl.opn_qnty_for_leather_status AS final_opn_qnty_for_leather_status
                    FROM
                        `item_dtl`
                    LEFT JOIN article_costing_details ON item_dtl.id_id = article_costing_details.id_id
                    LEFT JOIN article_costing ON article_costing_details.id_id = article_costing.ac_id
                    LEFT JOIN article_master ON article_costing.am_id = article_master.am_id
                    LEFT JOIN customer_order_dtl ON customer_order_dtl.am_id = article_master.am_id
                    LEFT JOIN article_dtl ON article_master.am_id = article_dtl.am_id
                    LEFT JOIN colors ON item_dtl.c_id = colors.c_id
                    LEFT JOIN item_master ON item_dtl.im_id = item_master.im_id
                    WHERE
                        item_dtl.`id_id` IN($la)
                    GROUP BY
                        item_dtl.id_id
                ) AS item_details
            LEFT JOIN purchase_order_receive_detail ON item_details.id_id = purchase_order_receive_detail.id_id
            GROUP BY
                item_details.id_id
            ) AS pur_rcv_details
        LEFT JOIN material_issue_detail ON pur_rcv_details.id_id = material_issue_detail.id_id
        GROUP BY
            pur_rcv_details.id_id
        ) AS mat_issue_details
    LEFT JOIN stock_in_detail ON mat_issue_details.id_id = stock_in_detail.id_id
    GROUP BY
        mat_issue_details.id_id
    ) AS stock_in_details
LEFT JOIN purchase_order_details ON stock_in_details.id_id = purchase_order_details.id_id
LEFT JOIN purchase_order ON purchase_order_details.po_id = purchase_order.po_id
LEFT JOIN acc_master ON purchase_order.am_id = acc_master.am_id
GROUP BY
    stock_in_details.id_id
) AS pur_order_details
LEFT JOIN supp_purchase_order_detail ON pur_order_details.id_id = supp_purchase_order_detail.id_id
GROUP BY
    pur_order_details.id_id
ORDER BY
    pur_order_details.item_name, pur_order_details.color
                ";
        return $this->db->query($query)->result();

       // return  $customer_order_id; 
            
    }

    

    public function fetch_checking_summary_status_v() {
        $data = array();

        if($this->input->post('check_summary')){
            $order = $this->input->post('co[]');
                $emp = $this->input->post('emp[]');
                $from = $this->input->post('from');
                $to = $this->input->post('to');
                $category = $this->input->post('group');
                $data['from'] = $this->input->post('from');
                $data['to'] = $this->input->post('to');
                $data['order'] = $this->input->post('co[]');
                
                $data['category'] = $this->input->post('group');
          

            $data['result'] = $this->_fetch_all_checking_summary($order, $emp, $from, $to, $category);
            $data['segment'] = 'checking_summary_status';

    //   echo '<pre>',print_r($data['result']),'</pre>';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        $data['co_ids'] = $this->db->get_where('customer_order', array('status' => 1))->result();
        $data['all_emp'] = $this->db->get_where('employees', array('status' => 1))->result();
        return array('page'=>'reports/checking_summary_v', 'data'=>$data);
    }

    private function _fetch_all_checking_summary($order, $emp, $from, $to, $category) {
        
        
        $result_array = [];
        
        if($category == 'emp') {
            $this->db->select('checking.*, employees.name as emp_name, employees.e_id')
            ->join('checking', 'employees.e_id=checking.e_id', 'left');
                    $this->db->where_in('checking.e_id', $emp);
                    $this->db->group_by('employees.e_id');
                    $results = $this->db->get('employees')->result();
                    
                    


                    
                    foreach($results as $em_ress) {
                    
                    
                    $this->db->select('checking.*,checking_details.*, checking_details.checked_quantity AS mains_checked_qnty_val, checking_details.rejection_quantity, checking_details.remarks, checking.extra_time')
            ->join('checking', 'checking_details.checking_id=checking.checking_id', 'left')
                    ->join('colors', 'colors.c_id = checking_details.lc_id', 'left');
                    $this->db->where('checking.e_id', $em_ress->e_id);
                    if($order != '') {
                    $this->db->where_in('checking_details.co_id', $order);
                    }
                    if($from != '' or $to != '') {
                        $this->db->where('checking.checking_entry_date >=', $from)
                                ->where('checking.checking_entry_date <=', $to);
                    }
                    
                
                    // $this->db->group_by('checking_details.cod_id');
                    $this->db->order_by('checking.checking_entry_date', 'asc');
                
                    
                    $res = $this->db->get('checking_details')->result();
                    
                    
                    foreach($res as $r) {
                        
                        
                        $this->db->select('article_master.art_no, colors.color as lc, article_master.am_id, colors.c_id, colors.c_code, customer_order.co_no, customer_order.co_id, customer_order_dtl.co_quantity AS co_quantity, customer_order.buyer_reference_no, customer_order.co_total_quantity')
                    ->join('customer_order', 'customer_order_dtl.co_id=customer_order.co_id', 'left')
                    ->join('article_master', 'customer_order_dtl.am_id=article_master.am_id', 'left')
                    ->join('colors', 'colors.c_id = customer_order_dtl.lc_id', 'left');
                    $this->db->where('customer_order_dtl.cod_id', $r->cod_id);
                
                
                
                
                
                
                
                    
                    $ress = $this->db->get('customer_order_dtl')->row();
                        
                        
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['co_no'] = $ress->co_no;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['art_no'] = $ress->art_no;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['co_quantity'] = $ress->co_quantity;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['checked_quantity'] = $r->mains_checked_qnty_val;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['rejection_quantity'] = $r->rejection_quantity;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['lc'] = $ress->lc;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['emp_name'] = $em_ress->emp_name;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['checking_entry_date'] = $r->checking_entry_date;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['checking_id'] = $r->checking_id;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['co_id'] = $ress->co_id;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['am_id'] = $ress->am_id;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['lc_id'] = $ress->c_id;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['e_id'] = $em_ress->e_id;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['remarks'] = $r->remarks;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['remarks_for_other_quantity'] = $r->remarks_for_other_quantity;
                        $result_array[$em_ress->e_id][$r->checking_id][$r->checking_detail_id]['extra_time'] = $r->extra_time;
                        
                        


                        
                    }
                    
                    
                    
                    
                    
        }
        
        
        }
        else {
            
            
            $this->db->select('*');
                    if($order != '') {
                    $this->db->where_in('customer_order.co_id', $order);
                    }
                
                
                
                
                
                
                
                    
                    $ress_orders = $this->db->get('customer_order')->result();
                    
                    
                    foreach($ress_orders as $rs_od) {
                    
                    $this->db->select('article_master.art_no, article_master.am_id, colors.c_id, colors.color as lc, colors.c_code, customer_order.co_no, customer_order.co_id, customer_order_dtl.co_quantity AS co_quantity, customer_order.buyer_reference_no, customer_order.co_total_quantity')
                    ->join('customer_order', 'customer_order_dtl.co_id=customer_order.co_id', 'left')
                    ->join('article_master', 'customer_order_dtl.am_id=article_master.am_id', 'left')
                    ->join('colors', 'colors.c_id = customer_order_dtl.lc_id', 'left');
                    $this->db->where_in('customer_order_dtl.co_id', $order);
                    
                    $results = $this->db->get('customer_order_dtl')->result();
                    
                    


                    
                    foreach($results as $em_ress) {
                    
                    
                    $this->db->select('checking.*,checking_details.*, colors.color, checking_details.checked_quantity AS mains_checked_qnty_val, employees.name, checking_details.rejection_quantity')
                    ->join('checking', 'checking_details.checking_id=checking.checking_id', 'left')
                    ->join('colors', 'colors.c_id = checking_details.lc_id', 'left')
                    ->join('article_master', 'article_master.am_id = checking_details.am_id', 'left')
                    ->join('employees', 'employees.e_id = checking.e_id', 'left');
                    $this->db->where('article_master.am_id', $em_ress->am_id);
                    $this->db->where('checking_details.co_id', $rs_od->co_id);
                    $this->db->where('checking_details.lc_id', $em_ress->c_id);
                    if($emp != '') {
                    $this->db->where_in('checking.e_id', $emp);
                    }
                    if($from != '' or $to != '') {
                        $this->db->where('checking.checking_entry_date >=', $from)
                                ->where('checking.checking_entry_date <=', $to);
                    }
                    
                
                    $this->db->group_by('checking_details.checking_detail_id');
                    $this->db->order_by('employees.name, checking_details.lc_id, checking.checking_entry_date', 'asc');
                
                    
                    $res = $this->db->get('checking_details')->result();
                    
                    
                    foreach($res as $r) {
                        
                        
                        $this->db->select('article_master.art_no, colors.color as lc, colors.c_code, customer_order.co_no, customer_order.co_id, customer_order_dtl.co_quantity AS co_quantity, customer_order.buyer_reference_no, customer_order.co_total_quantity')
                    ->join('customer_order', 'customer_order_dtl.co_id=customer_order.co_id', 'left')
                    ->join('article_master', 'customer_order_dtl.am_id=article_master.am_id', 'left')
                    ->join('colors', 'colors.c_id = customer_order_dtl.lc_id', 'left');
                    $this->db->where('customer_order_dtl.cod_id', $r->cod_id);
                
                
                
                
                
                
                
                    
                    $ress = $this->db->get('customer_order_dtl')->row();
                        
                        // echo '<pre>', print_r($r), '</pre>'; die;
                        
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['co_no'] = $ress->co_no;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['art_no'] = $ress->art_no;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['co_quantity'] = $ress->co_quantity;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['checked_quantity'] = $r->mains_checked_qnty_val;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['rejection_quantity'] = $r->rejection_quantity;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['lc'] = $r->color;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['emp_name'] = $r->name;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['checking_entry_date'] = $r->checking_entry_date;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['remarks'] = $r->remarks;
                        $result_array[$rs_od->co_no][$em_ress->am_id][$r->checking_detail_id]['remarks_for_other_quantity'] = $r->remarks_for_other_quantity;    

                        
                    }
                    
                    
                    
                    
                    
        }
        
        
        }
        
        
        }
        
        
        return $result_array;
        
        
    }

    public function fetch_checking_entry_sheet() {
        $data = array();
        
        $data['page_setup'] = $this->db->select('front_page,other_page,blank_row')->get_where('page_setup', array('module_id' =>19, 'user_id' => $this->session->user_id))->result(); # 19 = Report
                    
        if($this->input->post('check_entry_sheet')){
            

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
            
                $order = implode (",", $this->input->post('co[]'));
             // $order = $this->input->post($cos);
                $from = $this->input->post('from');
                $to = $this->input->post('to');
                
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['fr_page'] = $this->input->post('first_page_row');
            $data['oe_page'] = $this->input->post('other_page_row');
            $data['result'] = $this->_fetch_checking_entry_sheet_details($order, $from, $to);
            $data['segment'] = 'checking_entry_sheet_status';
            
            // echo '<pre>',print_r($data['result']),'</pre>';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
// fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            if($module_permission == 'show'){
    $data['order_details'] = $this->db->select('co_id, co_no')->order_by('co_no')->get_where('customer_order', array('customer_order.status => 1'))->result();
            } else {
                #module_permission contains the dept id now
    $data['order_details'] = $this->db->select('co_id, co_no')
                    ->join('user_details','user_details.user_id = customer_order.user_id','left')
                    ->order_by('co_no')
                    ->get_where('customer_order', array('user_details.user_dept' => $module_permission, 'customer_order.status' => '1'))->result();
            }        
            return array('page'=>'reports/check_entry_sheet_v', 'data'=>$data);
    }
    
    public function get_fetch_all_item_for_supplier_basis(){
        
        $supplier_id = $this->input->post('supp_id');
                    
                    $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`item`,
                                    `colors`.`color`,
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                    `purchase_order`.am_id = $supplier_id AND `purchase_order`.status = 1
                                GROUP BY
                                purchase_order.po_id, purchase_order_details.id_id
                                ORDER BY
                                purchase_order.po_number, item_master.item, colors.color";

            return $this->db->query($query)->result();
            
    }
    public function get_fetch_all_order_for_supplier_basis(){
        $supplier_date = date("Y-m-d", strtotime($this->input->post('supp_date')));
        return $this->db
                    ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                    ->join('cust_order_brk_up', 'cust_order_brk_up.cod_id = customer_order_dtl.cod_id', 'left')
                    ->where('customer_order.shipment_date', $supplier_date)
                    ->or_where('cust_order_brk_up.ord_date', $supplier_date)
                    ->group_by('customer_order.co_id')
                    ->get('customer_order')
                    ->result();
    }
    public function _fetch_checking_entry_sheet_details($order, $from, $to){
        
     if(empty($order)){
            die('No details found');
        }


        $query = "SELECT
                customer_order.co_no,
                customer_order.co_date,
                customer_order.buyer_reference_no,
                customer_order.co_reference_date,
                acc_master.name,
                article_master.art_no,
                article_master.info,
                article_master.am_id,
                article_master.alt_art_no,
                acc_master.short_name,
                article_master.ag_id,
                c1.color as leather_color,
                c2.color as fitting_color,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.co_quantity,
                user_details.user_dept,
                checking_details.checked_quantity
            FROM
                `customer_order_dtl`
            LEFT JOIN checking_details ON customer_order_dtl.cod_id = checking_details.cod_id
            LEFT JOIN customer_order ON customer_order_dtl.co_id = customer_order.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_dtl ON article_dtl.am_id = article_master.am_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN article_groups ON article_groups.ag_id = article_master.ag_id
            LEFT JOIN user_details ON user_details.user_id = customer_order.user_id
            WHERE
                customer_order.`co_id` IN ($order) AND customer_order.status = 1
                GROUP BY
            customer_order_dtl.cod_id
            ORDER BY
            customer_order.co_no";
        return $this->db->query($query)->result();

    }

    public function fetch_stock_summary_status() {
        $data = array();

        if($this->input->post('check_stock_summary')){
            $gr = $this->input->post('group');
            $it_arr = $this->input->post('items[]');
            $from = $this->input->post('fromdate');
            $to = $this->input->post('todate');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            $data['result'] = $this->_fetch_all_checking_stock_summary_details($it_arr, $from, $to);
            $data['segment'] = 'checking_stock_summary_status';

            // echo '<pre>',print_r($data['result']),'</pre>';

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1))->result();
        return array('page'=>'reports/stock_summary_v', 'data'=>$data);
    }
    
    
    public function report_article_costing_details() {
        
        
        $data = array();
        
        $group_array = [];

        if($this->input->post('supplier_wise_item_position')){
            $am_id = $this->input->post('supp_second');
            $group = $this->input->post('gropus[]');
            $data['result'] = $this->_fetch_report_article_costing_details($am_id, $group);
            // echo '<pre>',print_r($data['result']),'</pre>';
            
            
            return array('page'=>'transactions/article_costing_print_groups', 'data'=>$data['result']);
            
            
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
        return array('page'=>'reports/article_report_costing_v', 'data'=>$data);
    }
    
    
    public function _fetch_report_article_costing_details($am_id, $group){
        
        
        if($this->input->post('page_setup_submit')){
            
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
         
        // echo '<pre>', print_r($data['page_setup']), '</pre>'; die();
            
            // echo $ac_id;
            $charges_groups = explode('-', $am_id);
            if($charges_groups[0] == 'items') {
                $this->db
                    ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.group_name, colors.color, 
                        item_master.item as item_name, item_master.im_code as item_master_code, im1.item as cartoon_size, acc_master.name as customer_name,
                        SUM(article_costing_details.quantity) as cost_qnty, SUM(article_costing_details.rate) as cost_rate')
                    ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                    ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                    ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                    ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                    ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                    ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                    ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                    ->join('colors', 'item_dtl.c_id = colors.c_id', 'left');
                    
                    $this->db->where_in('article_costing.ac_id', $group); 
                    $this->db->where('item_groups.ig_id', $charges_groups[1]);
                    $this->db->group_by('article_costing.ac_id');
                    
                    $this->db->order_by('item_groups.sort_order, article_master.art_no');
                    $data['costing'] = $this->db->get_where('article_costing_details', array('article_costing.status' => 1, 
                        'article_costing_details.status'=> 1))->result();
            } else {
                                
            if($charges_groups[1] != 2) {                   
                                

                $data['charges'] = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, acc_master.name as customer_name, article_master.fabrication_rate_b, article_costing_charges.quantity as charge_qnty, article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage, charges.c_id,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_charges.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('charges.c_id', $charges_groups[1])
                            ->where_in('article_costing_charges.ac_id', $group)
                            ->where('article_costing_charges.status', 1)
                            ->order_by('article_master.art_no')
                            ->get('article_costing_charges')->result();
             } else {
                $data['charges_another'] = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, acc_master.name as customer_name, article_master.fabrication_rate_b, article_costing_charges.quantity as charge_qnty, article_costing_charges.rate as charge_rate,article_costing_charges.percentage as charge_percentage, charges.c_id,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_charges.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->where('charges.c_id', $charges_groups[1])
                            ->where_in('article_costing_charges.ac_id', $group)
                            ->where('article_costing_charges.status', 1)
                            ->order_by('article_master.art_no')
                            ->get('article_costing_charges')->result();    
             }
                            // echo '<pre>', print_r($data), '</pre>';
                            // echo $this->db->last_query(); die;
                            
            }
                            
                            
            return $data;
        
        
    }
    

    public function items_on_item_group_m($par){
        $result = $this->db
            ->join('item_dtl', 'item_dtl.im_id = item_master.im_id', 'left')
            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
            ->order_by('item_master.item, colors.color')
            ->get_where('item_master', array('ig_id' => $par))->result();
       // echo '<pre>',print_r($result),'</pre>'; die();
       return $result;   
    }

    public function fetch_articles_on_article_group($par){
        $result = $this->db
            ->order_by('article_master.art_no')
            ->get_where('article_master', array('customer_id' => $par))->result();
       // echo '<pre>',print_r($result),'</pre>'; die();
       return $result;   
    }
    
    
    public function get_fetch_all_item_for_costings_article(){
        
        
        $session_user_id = $this->session->user_id;
        
        $am_id = $this->input->post('am_id');
        $am_id1 = $this->input->post('am_id1');
        $sp_array = explode("-",$am_id);
        
        
        $module_permission = $this->_dept_wise_module_permission(1, $session_user_id); #15 = customer order
        
        
        
        if($sp_array[0] == 'items') {
        $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.ig_id, item_groups.group_name, colors.color, 
                                item_master.item as item_name, item_master.im_code as item_master_code, im1.item as cartoon_size, acc_master.name as customer_name, article_costing.ac_id,
                                article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                            ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
                            ->join('user_details','user_details.user_id = article_costing.user_id','left');
        if($module_permission != 'show'){
            $this->db->where('user_details.user_dept', $module_permission);  
        }
                            $result = $this->db
                            ->group_by('article_costing.ac_id')
                            ->order_by('article_master.art_no')
                            ->get_where('article_costing_details', array('item_groups.ig_id' => $sp_array[1], 'article_master.customer_id' => $am_id1, 'article_costing.status' => 1, 
                                'article_costing_details.status'=> 1))->result();
        } else {
           $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, article_costing.ac_id,SUM(article_costing_charges.quantity) as charge_qnty, SUM(article_costing_charges.rate) as charge_rate,article_costing_charges.percentage as charge_percentage,
                                charges.charge_group, charges.charge as charge_name, charges.amount as charge_amount')
                            ->join('article_costing_charges', 'article_costing_charges.ac_id = article_costing.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('charges', 'charges.c_id = article_costing_charges.c_id', 'left')
                            ->join('user_details','user_details.user_id = article_costing.user_id','left')
                            ->where('charges.c_id', $sp_array[1])
                            ->where('article_master.customer_id', $am_id1)
                            ->where('article_costing.status', 1);
                            if($module_permission != 'show'){
                            $this->db->where('user_details.user_dept', $module_permission);  
                            }
                            $result = $this->db->group_by('article_costing.ac_id')->order_by('article_master.art_no')
                            ->get('article_costing')->result();
        }
                                
              
                return $result;
                
                
    }
    
    
    
    public function get_fetch_all_item_for_costings_article_all_details(){
        
        
        $am_id = $this->input->post('am_id');
        
        
        
        $ig_id = $this->input->post('ig_id');
        
        
        
        
        
        
        
        
        
        $result = $this->db
                            ->select('article_master.art_no, article_master.alt_art_no, article_master.info,article_master.pack_dtl, item_groups.ig_id, item_groups.group_name, colors.color, 
                                item_master.item as item_name, item_master.im_code as item_master_code, item_dtl.id_id, im1.item as cartoon_size, acc_master.name as customer_name,
                                article_costing_details.quantity as cost_qnty, article_costing_details.rate as cost_rate')
                            ->join('article_costing', 'article_costing.ac_id = article_costing_details.ac_id', 'left')
                            ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
                            ->join('acc_master', 'acc_master.am_id = article_master.customer_id', 'left')
                            ->join('item_master im1', 'im1.im_id = article_master.carton_id', 'left')
                            ->join('item_dtl', 'item_dtl.id_id = article_costing_details.id_id', 'left')
                            ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                            ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                            ->join('colors', 'item_dtl.c_id = colors.c_id', 'left')
                            ->where_in('item_groups.ig_id', $ig_id)
                            ->group_by('item_dtl.id_id')
                            ->order_by('item_dtl.id_id')
                            ->get_where('article_costing_details', array('article_costing.am_id' => $am_id, 'article_costing.status' => 1, 
                                'article_costing_details.status'=> 1))->result();
                                
                
                return $result;
                
                
    }
    

    public function _fetch_all_checking_stock_summary_details($it_arr, $from, $to){
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        $data_array = array();
        // echo $from; die();
        // echo '<pre>',print_r($it_arr),'</pre>'; die();
      foreach($it_arr as $id_id) { 
    
    if($from == '2023-04-01') {
    
        $this->db->where('item_dtl.id_id', $id_id);
                $row_opn = $this->db->get('item_dtl')->row();
                if(count($row_opn) == 0) continue;
    
       $opening_row = $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opening_qty, item_master.item, colors.color, item_dtl.opening_rate, item_groups.group_name')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('item_dtl.id_id', $id_id)
                ->get('item_dtl')->row();

                // echo '<pre>',print_r($opening_row),'</pre>';
         
        $purchase_row = $this->db->select('SUM(purchase_order_receive_detail.item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($purchase_row) != 0) {
                    $purchase_qnty = $purchase_row->purch_qty;
                    $purchase_val = $purchase_row->purch_rate;
                } else {
                    $purchase_qnty = 0;
                    $purchase_val = 0;
                }

        $issue_row = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($issue_row) != 0) {
                    $issue_qnty = $issue_row->issue_qnty;
                    $issue_val = $issue_row->issue_rate;
                } else {
                    $issue_qnty = 0;
                    $issue_val = 0;
                }


        $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('stock_in_detail.id_id', $id_id)
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                
        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $id_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

        $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where(array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id))
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }


                $arr = array(
                    'id_id'=>$opening_row->id_id,
                    'item' =>$opening_row->item,
                    'color'=>$opening_row->color,
                    'opening_qnty'=>$opening_row->opening_qty,
                    'opening_val'=>$opening_row->opening_qty * $opening_row->opening_rate,
                    'purchase_qnty'=> $purchase_qnty,
                    'purchase_val'=>$purchase_val,
                    'issue_qnty'=>$issue_qnty,
                    'issue_val'=>$issue_val,
                    'plating_qnty'=>$plating_qnty,
                    'plating_val'=>$plating_val,
                    'stock_in_qnty'=>$stock_in_qnty,
                    'stock_in_val'=>$stock_in_val,
                    'group_name'=>$opening_row->group_name,
                );
                array_push($data_array, $arr);
                
            } else {
                
                $this->db->where('item_dtl.id_id', $id_id);
                $row_opn = $this->db->get('item_dtl')->row();
                if(count($row_opn) == 0) continue;
                
        $df_new_fr = date('Y-m-d', strtotime('2022/04/01'));
        $df_new_t = date('Y-m-d', strtotime('2022/04/30'));
        
        
        $df_open_prev_date = date('Y-m-d', strtotime('-1 day', strtotime($from)));
        
        
       $opening_row = $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opening_qty, item_master.item, colors.color, item_dtl.opening_rate, item_groups.group_name')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('item_groups', 'item_groups.ig_id = item_master.ig_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('item_dtl.id_id', $id_id)
                ->get('item_dtl')->row();

                // echo '<pre>',print_r($opening_row),'</pre>';
         
        $purchase_row = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_total')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_new_fr)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($purchase_row) != 0) {
                    $purchase_qnty = $purchase_row->purch_qty;
                    $purchase_val = $purchase_row->purch_total;
                } else {
                    $purchase_qnty = 0;
                    $purchase_val = 0;
                }

        $issue_row = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_new_fr)) . '" and "' . date('Y-m-d', strtotime($from)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($issue_row) != 0) {
                    $issue_qnty = $issue_row->issue_qnty;
                    $issue_val = $issue_row->issue_rate;
                } else {
                    $issue_qnty = 0;
                    $issue_val = 0;
                }

        $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_new_fr)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('stock_in_detail.id_id', $id_id)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $id_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

        $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_new_fr)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where(array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                $opng_qnty = $opening_row->opening_qty + $purchase_qnty - ($issue_qnty + $plating_qnty) + $stock_in_qnty;
                $opng_val = ($opening_row->opening_qty * $opening_row->opening_rate) + $purchase_val - ($issue_val + $plating_val) + $stock_in_val;

        $purchase_row = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_total')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($purchase_row) != 0) {
                    $purchase_qnty = $purchase_row->purch_qty;
                    $purchase_val = $purchase_row->purch_total;
                } else {
                    $purchase_qnty = 0;
                    $purchase_val = 0;
                }

        $issue_row = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.total_amount) as issue_total')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($issue_row) != 0) {
                    $issue_qnty = $issue_row->issue_qnty;
                    $issue_val = $issue_row->issue_total;
                } else {
                    $issue_qnty = 0;
                    $issue_val = 0;
                }
                
        $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('stock_in_detail.id_id', $id_id)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $id_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

        $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where(array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                $arr = array(
                    'id_id'=>$opening_row->id_id,
                    'item' =>$opening_row->item,
                    'color'=>$opening_row->color,
                    'opening_qnty'=>$opng_qnty,
                    'opening_val'=>$opng_val,
                    'purchase_qnty'=> $purchase_qnty,
                    'purchase_val'=>$purchase_val,
                    'issue_qnty'=>$issue_qnty,
                    'issue_val'=>$issue_val,
                    'plating_qnty'=>$plating_qnty,
                    'plating_val'=>$plating_val,
                    'stock_in_qnty'=>$stock_in_qnty,
                    'stock_in_val'=>$stock_in_val,
                    'group_name'=>$opening_row->group_name,
                );
                array_push($data_array, $arr);
                
            }
          }
          return $data_array;
    }
    
    public function report_material_status_details() {
        $data = array();
        if($this->input->post('order_details')){
                $co_id = $this->input->post('customer_order');
            $data['result'] = $this->_fetch_material_issue_status($co_id);
            $data['segment'] = 'material_issue_status_report';
            // echo '<pre>',print_r($result),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['co_ids'] = $this->db->get_where('customer_order', array('status' => 1))->result();
        return array('page'=>'reports/report_material_status_v', 'data'=>$data);
    }
    
    public function _fetch_material_issue_status($co_id) {
        
        
        $this->db->empty_table('temp_consumption_material_issue');

        $data_array = array();
        $order_query = "SELECT
    `customer_order_dtl`.*,
    `article_costing`.`combination_or_not`,
    `item_dtl`.`im_id`
FROM
    `customer_order_dtl`
LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
WHERE
    `co_id` = $co_id
GROUP BY
    `customer_order_dtl`.`co_id`,
    `customer_order_dtl`.`lc_id`,
    `item_dtl`.`im_id`
    ORDER BY
    im_id";
        $order_colour_res = $this->db->query($order_query)->result(); 

        // echo $this->db->last_query(); die();

        // echo $order_colour_res; die();

        // echo '<pre>', print_r($order_colour_res), '</pre>'; die();

        foreach($order_colour_res as $o_c_r) {
            if($o_c_r->im_id == '') {
                continue;
            }
            if($o_c_r->combination_or_not == 0) {
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
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM( 
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.im_id, customer_order_dtl.lc_id";
                $res = $this->db->query($query)->row();

        $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_material_issue', $arr);
            }
            }
            foreach($order_colour_res as $o_c_r) {
                if($o_c_r->im_id == '') {
                continue;
            }
                if($o_c_r->combination_or_not == 1) {
                $query1 = "SELECT
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
                c1.color as leather_color,
                c2.color as fitting_color,
                c3.color as item_color,
                c3.c_id as item_color_id,
                item_dtl.id_id,
                item_dtl.im_id,
                item_groups.ig_id,
                item_groups.show_total_in_consumption,
                customer_order_dtl.cod_id,
                customer_order_dtl.co_id,
                customer_order_dtl.am_id,
                customer_order_dtl.lc_id,
                article_costing.ac_id AS costing_id,
                article_costing_details.id_id AS item_dtl,
                article_costing_details.quantity AS item_dtl_quantity,
                co_quantity,
                (
                    article_costing_details.quantity * co_quantity
                ) AS temp_qnty,
                SUM(
                    article_costing_details.quantity * co_quantity
                ) AS final_qnty
            FROM
                `customer_order`
            LEFT JOIN customer_order_dtl ON customer_order.co_id = customer_order_dtl.co_id
            LEFT JOIN article_master ON article_master.am_id = customer_order_dtl.am_id
            LEFT JOIN article_costing ON article_costing.am_id = article_master.am_id
            LEFT JOIN article_costing_details ON article_costing.ac_id = article_costing_details.ac_id
            LEFT JOIN acc_master ON acc_master.am_id = customer_order.acc_master_id
            LEFT JOIN item_dtl ON item_dtl.id_id = article_costing_details.id_id
            LEFT JOIN colors c1 ON customer_order_dtl.lc_id = c1.c_id
            LEFT JOIN colors c2 ON customer_order_dtl.fc_id = c2.c_id
            LEFT JOIN colors c3 ON item_dtl.c_id = c3.c_id
            LEFT JOIN item_master ON item_master.im_id = item_dtl.im_id
            LEFT JOIN item_groups ON item_master.ig_id = item_groups.ig_id
            LEFT JOIN units ON item_groups.u_id = units.u_id
            WHERE
                customer_order.`co_id` = $co_id AND customer_order.status = 1 AND item_dtl.`im_id` = $o_c_r->im_id AND customer_order_dtl.`lc_id` = $o_c_r->lc_id
            GROUP BY
                item_dtl.id_id";

$result1 = $this->db->query($query1)->result();

$consumption_list = $this->db->get('temp_consumption_material_issue')->result();
foreach($result1 as $res) {
foreach($consumption_list as $cl) {
    if($res->im_id == $cl->im_id && $res->item_color_id == $cl->lc_id) {
        $prev_total = $cl->final_qnty;
        $new_total = $res->final_qnty + $cl->final_qnty;

        $update_array = array(
          'final_qnty' => $new_total,
        );

        $this->db->update('temp_consumption_material_issue', $update_array, array('im_id' => $cl->im_id, 'lc_id' => $cl->lc_id));
    }
    
}
$check_consumption_list = $this->db->get_where('temp_consumption_material_issue', array('im_id' => $res->im_id, 'lc_id' => $res->item_color_id))->num_rows();
if($check_consumption_list == 0) {
    $arr = array(
                    'co_no'=>$res->co_no,
                    'co_date' =>$res->co_date,
                    'buyer_reference_no'=>$res->buyer_reference_no,
                    'co_reference_date'=>$res->co_reference_date,
                    'name' =>$res->name,
                    'short_name'=>$res->short_name,
                    'item_name'=>$res->item_name,
                    'item_code' =>$res->item_code,
                    'ig_code'=>$res->ig_code,
                    'group_name'=>$res->group_name,
                    'unit' =>$res->unit,
                    'leather_color'=>$res->leather_color,
                    'fitting_color'=>$res->fitting_color,
                    'item_color' =>$res->item_color,
                    'item_color_id' =>$res->item_color_id,
                    'lc_id' =>$res->lc_id,
                    'id_id'=>$res->id_id,
                    'im_id'=>$res->im_id,
                    'ig_id'=>$res->ig_id,
                    'cod_id' =>$res->cod_id,
                    'co_id'=>$res->co_id,
                    'am_id'=>$res->am_id,
                    'costing_id' =>$res->costing_id,
                    'show_total_in_consumption' =>$res->show_total_in_consumption,
                    'item_dtl'=>$res->item_dtl,
                    'item_dtl_quantity'=>$res->item_dtl_quantity,
                    'co_quantity' =>$res->co_quantity,
                    'temp_qnty'=>$res->temp_qnty,
                    'final_qnty'=>$res->final_qnty
                );
        $this->db->insert('temp_consumption_material_issue', $arr);
}
}


        
            }
        
            }
        
        // echo '<pre>', print_r($data_array), '</pre>'; die();
        // $this->db->insert('temp_consumption', $data_array);
    return $this->db->order_by('ig_id, item_name, item_color')->get_where('temp_consumption_material_issue', array('ig_id' => 1))->result();
        // echo '<pre>', print_r($consumption_list), '</pre>'; die();
        
        
        // echo '<pre>', print_r($ress), '</pre>'; die();
        
        
    }
    
    public function fetch_stock_summary_ledger() {
        $data = array();
        if($this->input->post('check_stock_detail_ledger')){
            $gr = $this->input->post('group');
                $it_arr = $this->input->post('items[]');
                $from = $this->input->post('fromdate');
                $to = $this->input->post('todate');
            $data['result'] = $this->_fetch_stock_summary_ledger_details($it_arr, $from, $to);
            $data['segment'] = 'checking_stock_detail_ledger';
            // echo '<pre>',print_r($result),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1))->result();
        return array('page'=>'reports/stock_detail_ledger_v', 'data'=>$data);
    }

    public function _fetch_stock_summary_ledger_details($it_arr, $from, $to) {
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        $df_new = date('Y-m-d', strtotime('01-04-2020'));
        $this->db->empty_table('temp_table'); 
        // echo $this->db->last_query(); die();
      foreach($it_arr as $id_id) {
         $bal_qnty = 0; $bal_val = 0;
         
         if($from == '2022-04-01') {


    $this->db->where('item_dtl.id_id', $id_id);
                $row_opn = $this->db->get('item_dtl')->row();
                if(count($row_opn) == 0) continue;

       $rs_opn = $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opening_qty, item_master.item, colors.color, item_dtl.opening_rate')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('item_dtl.id_id', $id_id)
                ->get('item_dtl')->result_array();

                // echo '<pre>',print_r($opening_row),'</pre>';
         
        $rs_pur = $this->db->select('item_master.item, colors.color, purchase_order_receive.purchase_order_receive_bill_no, purchase_order_receive.purchase_order_receive_date, purchase_order_receive_detail.item_quantity, purchase_order_receive_detail.item_rate, purchase_order_receive_detail.pod_total')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->order_by("str_to_date(purchase_order_receive.purchase_order_receive_date, '%d-%m-%Y') ASC")
                ->get('purchase_order_receive_detail')->result_array();

        $rs_issue = $this->db->select('item_master.item, colors.color, material_issue.material_issue_slip_number, material_issue.material_issue_date, material_issue_detail.issue_quantity, material_issue_detail.issue_rate,
            material_issue_detail.total_amount')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = material_issue_detail.id_id', 'left')
                 ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->order_by("str_to_date(material_issue.material_issue_date, '%d-%m-%Y') ASC")
                ->get('material_issue_detail')->result_array();

        $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $id_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

        $rs_plating = $this->db->select('item_master.item, colors.color, platting_issue.platting_issue_number, platting_issue.platting_issue_date, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left')
                ->join('colors', 'colors.c_id = platting_issue_detail.item_colour', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where(array('platting_issue_detail.im_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id))
                ->order_by("str_to_date(platting_issue.platting_issue_date, '%d-%m-%Y') ASC")
                ->get('platting_issue_detail')->result_array();
                
        $rs_stock = $this->db->select('item_master.item, colors.color, stock_in.purchase_order_receive_bill_no, stock_in.purchase_order_receive_date, stock_in_detail.item_quantity, stock_in_detail.item_rate,
            stock_in_detail.pod_total')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left')
                 ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('stock_in_detail.id_id', $id_id)
                ->order_by("str_to_date(stock_in.purchase_order_receive_date, '%d-%m-%Y') ASC")
                ->get('stock_in_detail')->result_array();

        foreach ($rs_opn as $val) {
                    $this->db->where('id_id', $val['id_id']);
                    $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $df_new);
                    $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    $row_opn_rate = $this->db->get('item_rates')->row();
                    
                    // var_dump($row_opn_rate);
                    
                    if(count($row_opn_rate) > 0) {
                        $opn_rate = $row_opn_rate->purchase_rate;
                    } else {
                        $opn_rate = 0;
                    }

                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Opening';
                    $data_insert['seq'] = '1';
                    $data_insert['sl_no'] = '';
                    $data_insert['date'] = '2022-04-01';
                    $data_insert['qnty'] = $val['opening_qty'];
                    $data_insert['rate'] = $val['opening_rate'];
                    $data_insert['val'] = $val['opening_qty'] * $val['opening_rate'];
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_pur as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Purchase';
                    $data_insert['seq'] = '2';
                    $data_insert['sl_no'] = $val['purchase_order_receive_bill_no'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['purchase_order_receive_date']));
                    $data_insert['qnty'] = $val['item_quantity'];
                    $data_insert['rate'] = $val['item_rate'];
                    $data_insert['val'] = $val['pod_total'];
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_issue as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Issue';
                    $data_insert['seq'] = '3';
                    $data_insert['sl_no'] = $val['material_issue_slip_number'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['material_issue_date']));
                    $data_insert['qnty'] = $val['issue_quantity'];
                    $data_insert['rate'] = $val['issue_rate'];
                    $data_insert['val'] = $val['total_amount'];
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_plating as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Plating';
                    $data_insert['seq'] = '4';
                    $data_insert['sl_no'] = $val['platting_issue_number'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['platting_issue_date']));
                    $data_insert['qnty'] = $val['issue_quantity'];
                    $data_insert['rate'] = $val['plating_rate'];
                    $data_insert['val'] = ($val['issue_quantity'] * $val['plating_rate']);
                    $this->db->insert('temp_table', $data_insert);
                }
                
                foreach ($rs_stock as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Stock In';
                    $data_insert['seq'] = '5';
                    $data_insert['sl_no'] = $val['purchase_order_receive_bill_no'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['purchase_order_receive_date']));
                    $data_insert['qnty'] = $val['item_quantity'];
                    $data_insert['rate'] = $val['item_rate'];
                    $data_insert['val'] = $val['pod_total'];
                    $this->db->insert('temp_table', $data_insert);
                }


                
                
            } else {
        $df_open = date('Y-m-d', strtotime('2020/04/01'));
        
        
        $df_open_prev_date = date('Y-m-d', strtotime('-1 day', strtotime($from)));
        

        $this->db->where('item_dtl.id_id', $id_id);
                $row_opn = $this->db->get('item_dtl')->row();
                if(count($row_opn) == 0) continue;

       $rs_opn = $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opening_qty, item_master.item, colors.color, item_dtl.opening_rate')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('item_dtl.id_id', $id_id)
                ->get('item_dtl')->result_array();

                    // $this->db->where('id_id', $id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $df_new);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if(count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }
                // echo '<pre>',print_r($opening_row),'</pre>';
         
        $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_total')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_val = $row_pur->purch_total;
                } else {
                    $pur_qty = 0;
                    $pur_val = 0;
                }

        $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_val = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_val = 0;
                }

                $item_detail_row = $this->db->get_where('item_dtl', array('id_id' => $id_id))->row();
        $im_id = $item_detail_row->im_id;
        $c_id = $item_detail_row->c_id;

        $rs_plating = $this->db->select('item_master.item, colors.color, platting_issue.platting_issue_number, platting_issue.platting_issue_date, platting_issue_detail.issue_quantity, platting_issue_detail.plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->join('item_master', 'item_master.im_id = platting_issue_detail.im_id', 'left')
                ->join('colors', 'colors.c_id = platting_issue_detail.item_colour', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where(array('platting_issue_detail.id_id' => $im_id, 'platting_issue_detail.item_colour' => $c_id))
                ->order_by("str_to_date(platting_issue.platting_issue_date, '%d-%m-%Y') ASC")
                ->get('platting_issue_detail')->result_array();

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('stock_in_detail.id_id', $id_id)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }

                $opn_qnty = $rs_opn[0]['opening_qty'] + $pur_qty - $issue_qty + $stock_in_qnty;
                $opn_val = ($rs_opn[0]['opening_qty'] * $rs_opn[0]['opening_rate']) + $pur_val - $issue_val + $stock_in_val;

            $rs_pur = $this->db->select('item_master.item, colors.color, purchase_order_receive.purchase_order_receive_bill_no, purchase_order_receive.purchase_order_receive_date, purchase_order_receive_detail.item_quantity, purchase_order_receive_detail.item_rate, purchase_order_receive_detail.pod_total')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = purchase_order_receive_detail.id_id', 'left')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('purchase_order_receive_detail.id_id', $id_id)
                ->order_by("str_to_date(purchase_order_receive.purchase_order_receive_date, '%d-%m-%Y') ASC")
                ->get('purchase_order_receive_detail')->result_array();

        $rs_issue = $this->db->select('item_master.item, colors.color, material_issue.material_issue_slip_number, material_issue.material_issue_date, material_issue_detail.issue_quantity, material_issue_detail.issue_rate,
            material_issue_detail.total_amount')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = material_issue_detail.id_id', 'left')
                 ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('material_issue_detail.id_id', $id_id)
                ->order_by("str_to_date(material_issue.material_issue_date, '%d-%m-%Y') ASC")
                ->get('material_issue_detail')->result_array();
                
                $rs_stock = $this->db->select('item_master.item, colors.color, stock_in.purchase_order_receive_bill_no, stock_in.purchase_order_receive_date, stock_in_detail.item_quantity, stock_in_detail.item_rate,
            stock_in_detail.pod_total')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->join('item_dtl', 'item_dtl.id_id = stock_in_detail.id_id', 'left')
                 ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"')
                ->where('stock_in_detail.id_id', $id_id)
                ->order_by("str_to_date(stock_in.purchase_order_receive_date, '%d-%m-%Y') ASC")
                ->get('stock_in_detail')->result_array();

                foreach ($rs_opn as $val) {
                    if($opn_qnty == 0) $avg_rate = 0; else $avg_rate = $opn_val / $opn_qnty;

                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Opening';
                    $data_insert['seq'] = '1';
                    $data_insert['sl_no'] = '';
                    $data_insert['date'] = '2022-04-01';
                    $data_insert['qnty'] = $opn_qnty;
                    $data_insert['rate'] = $avg_rate;
                    $data_insert['val'] = $opn_val;
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_pur as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Purchase';
                    $data_insert['seq'] = '2';
                    $data_insert['sl_no'] = $val['purchase_order_receive_bill_no'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['purchase_order_receive_date']));
                    $data_insert['qnty'] = $val['item_quantity'];
                    $data_insert['rate'] = $val['item_rate'];
                    $data_insert['val'] = $val['pod_total'];
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_issue as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Issue';
                    $data_insert['seq'] = '3';
                    $data_insert['sl_no'] = $val['material_issue_slip_number'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['material_issue_date']));
                    $data_insert['qnty'] = $val['issue_quantity'];
                    $data_insert['rate'] = $val['issue_rate'];
                    $data_insert['val'] = $val['total_amount'];
                    $this->db->insert('temp_table', $data_insert);
                }

                foreach ($rs_plating as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Plating';
                    $data_insert['seq'] = '4';
                    $data_insert['sl_no'] = $val['platting_issue_number'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['platting_issue_date']));
                    $data_insert['qnty'] = $val['issue_quantity'];
                    $data_insert['rate'] = $val['plating_rate'];
                    $data_insert['val'] = ($val['issue_quantity'] * $val['plating_rate']);
                    $this->db->insert('temp_table', $data_insert);
                }
                
                foreach ($rs_stock as $val) {
                    $data_insert['item'] = $val['item'];
                    $data_insert['color'] = $val['color'];
                    $data_insert['remark'] = 'Stock In';
                    $data_insert['seq'] = '5';
                    $data_insert['sl_no'] = $val['purchase_order_receive_bill_no'];
                    $data_insert['date'] = date('Y-m-d', strtotime($val['purchase_order_receive_date']));
                    $data_insert['qnty'] = $val['item_quantity'];
                    $data_insert['rate'] = $val['item_rate'];
                    $data_insert['val'] = $val['pod_total'];
                    $this->db->insert('temp_table', $data_insert);
                }
            }
          }
         $this->db->order_by("item,color,date,seq");
        $temp_table = $this->db->get('temp_table')->result_array();

        return $temp_table;
    }

    
    public function fetch_supplier_wise_item_position() {
        $data = array();
        if($this->input->post('supplier_wise_item_position')) {
            $gr = $this->input->post('group');
            $it_arr = $this->input->post('items[]');
            $data['result'] = $this->_fetch_supplier_wise_item_position_details($it_arr);
            $data['segment'] = 'supplier_wise_item_position';
            // echo '<pre>',print_r($result),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1))->result();
        return array('page'=>'reports/supplier_wise_item_position_v', 'data'=>$data);
    }

    
public function _fetch_supplier_wise_item_position_details($it_arr) {
    
  $opening_row = $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opening_qty, item_master.item, colors.color')
                ->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left')
                ->join('colors', 'colors.c_id = item_dtl.c_id', 'left')
                ->where_in('item_dtl.id_id', $it_arr)
                ->get('item_dtl')->result();

  return $opening_row; 

 // $purchase_row = $this->db->select('purchase_order.po_id, purchase_order.po_number, acc_master.name, po_date, pod_quantity')
 //                ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
 //                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
 //                ->where('purchase_order_details.id_id', $id_id)
 //                ->group_by('purchase_order_details.id_id')
 //                ->get('purchase_order_details')->row();

 // $supplier_row = $this->db->select('supp_po_number, pur_order_date, supp_po_total');
 //                ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
 //                ->where('supp_purchase_order_detail.id_id', $id_id)
 //                ->get('supp_purchase_order')->row();               

    }
    public function fetch_supplier_purchase_ledger() {
        $data = array();
        if($this->input->post('supplier_wise_item_position')) {
            $it_arr = $this->input->post('items[]');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            $data['result'] = $this->_fetch_supplier_purchase_ledger_details($it_arr);
            $data['segment'] = 'supplier_purchase_ledger';
            // echo '<pre>',print_r($result),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1))->result();
        return array('page'=>'reports/supplier_purchase_ledger_v', 'data'=>$data);
    }

    
public function _fetch_supplier_purchase_ledger_details($it_arr) {
    
  $opening_row = $this->db->select('purchase_order_receive.*, SUM(purchase_order_receive_detail.item_quantity) AS item_quantity, acc_master.name AS acc_name')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->join('acc_master', 'acc_master.am_id = purchase_order_receive.am_id', 'left')
                ->where_in('purchase_order_receive.am_id', $it_arr)
                ->group_by('purchase_order_receive.am_id')
                ->order_by('acc_master.name')
                ->get('purchase_order_receive_detail')->result();
                

  return $opening_row; 

 // $purchase_row = $this->db->select('purchase_order.po_id, purchase_order.po_number, acc_master.name, po_date, pod_quantity')
 //                ->join('purchase_order', 'purchase_order.po_id = purchase_order_details.po_id', 'left')
 //                ->join('acc_master', 'acc_master.am_id = purchase_order.am_id', 'left')
 //                ->where('purchase_order_details.id_id', $id_id)
 //                ->group_by('purchase_order_details.id_id')
 //                ->get('purchase_order_details')->row();

 // $supplier_row = $this->db->select('supp_po_number, pur_order_date, supp_po_total');
 //                ->join('supp_purchase_order_detail', 'supp_purchase_order_detail.sup_id = supp_purchase_order.sup_id', 'left')
 //                ->where('supp_purchase_order_detail.id_id', $id_id)
 //                ->get('supp_purchase_order')->row();               

    }
    
    public function fetch_supplier_wise_purchase_position() {
        $data = array();
        if($this->input->post('supplier_wise_item_position')) {
            $it_arr = $this->input->post('items[]');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            $from = $this->input->post('fromdate');
            $to = $this->input->post('todate'); 
            $data['result'] = $this->_fetch_supplier_wise_purchase_position($it_arr, $from, $to);
            // echo '<pre>', print_r($data['result']), '</pre>'; die();
            $data['segment'] = 'supplier_wise_purchase_position';
            // echo '<pre>',print_r($result),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post('supplier_wise_item_position_wo_zero')) {
            $it_arr = $this->input->post('items[]');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            $from = $this->input->post('fromdate');
            $to = $this->input->post('todate'); 
            $data['result'] = $this->_fetch_supplier_wise_purchase_position($it_arr, $from, $to);
            $data['segment'] = 'supplier_purchase_ledger_wo_zero';
            // echo '<pre>',print_r($data['result']),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post('supplier_wise_item_position_brkup_details')) {
            $supp_arr = $this->input->post('supp_second[]');
            $it_arr = $this->input->post('item_second[]');
            $data['from'] = $this->input->post('fromdate1');
            $data['to'] = $this->input->post('todate1');
            $from = $this->input->post('fromdate1');
            $to = $this->input->post('todate1'); 
            $data['result'] = $this->_fetch_supplier_wise_item_position_brkup_details($supp_arr, $it_arr, $from, $to);
            $data['segment'] = 'supplier_wise_item_position_brkup_details';
            // echo '<pre>',print_r($data['result']),'</pre>';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1, 'ag_id' => 1))->result();
        return array('page'=>'reports/supplier_wise_purchase_position_v', 'data'=>$data);
    }

    public function _fetch_supplier_wise_purchase_position($it_arr, $from, $to) {
   
  foreach($it_arr as $am) { 
  $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`item`,
                                    `colors`.`color`,
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                    `purchase_order`.am_id = $am AND `purchase_order`.status = 1
                                AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') >= '$from'
                                GROUP BY
                                purchase_order.po_id, purchase_order_details.id_id
                                ORDER BY
                                purchase_order.po_number, item_master.item, colors.color";

            return $this->db->query($query)->result();  
            }              
    }
    
    public function _fetch_supplier_wise_item_position_brkup_details($supp_arr, $it_arr, $from, $to) {
   
  foreach($supp_arr as $am) {
      if($it_arr == '') {
  $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`im_id`,
                                    `purchase_order_details`.`pod_id`,
                                    `colors`.`c_id`,
                                    `item_master`.`ig_id`,
                                    `item_master`.`item`,
                                    `colors`.`color`
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                    `purchase_order`.am_id = $am AND `purchase_order`.status = 1
                                AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') >= '$from'
                                GROUP BY
                                purchase_order.po_id, purchase_order_details.id_id
                                ORDER BY
                                item_master.item, colors.color, purchase_order.po_number";

            $results = $this->db->query($query)->result();  
      } else {
         $query = "SELECT
                                    `purchase_order`.`po_id`,
                                    `purchase_order`.`po_number`,
                                    `purchase_order`.`am_id`,
                                    `purchase_order`.`po_date`,
                                    `acc_master`.`name`,
                                    `purchase_order_details`.`id_id`,
                                    `item_master`.`item`,
                                    `purchase_order_details`.`pod_id`,
                                    `colors`.`c_id`,
                                    `item_master`.`ig_id`,
                                    `item_master`.`im_id`,
                                    `colors`.`color`,
                                    SUM(
                        IFNULL(
                            purchase_order_details.pod_quantity,
                            0
                        )
                    ) AS pod_quantity
                                FROM
                                    `purchase_order_details`
                                LEFT JOIN `purchase_order` ON `purchase_order`.`po_id` = `purchase_order_details`.`po_id`
                                LEFT JOIN `acc_master` ON `purchase_order`.`am_id` = `acc_master`.`am_id`
                                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `purchase_order_details`.`id_id`
                                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                                LEFT JOIN `colors` ON `colors`.`c_id` = `item_dtl`.`c_id`
                                WHERE
                                    `purchase_order_details`.`id_id` IN ('" . implode("','", $it_arr) . "') AND `purchase_order`.am_id = $am AND `purchase_order`.status = 1
                                AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(purchase_order.po_date, '%Y-%m-%d') >= '$from'
                                GROUP BY
                                purchase_order.po_id, purchase_order_details.id_id
                                ORDER BY
                                item_master.item, colors.color, purchase_order.po_number";

            $results = $this->db->query($query)->result();
      }
            } 
            return $results;
    }
    
    public function fetch_group_stock_summary() {
        $data = array();
        if($this->input->post('supplier_wise_item_position')) {
            $it_arr = $this->input->post('items[]');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            $df = $this->input->post('fromdate');
            $dt = $this->input->post('todate');
            $data['result'] = $this->_fetch_group_stock_summary_details($it_arr, $df, $dt);
            $data['segment'] = 'group_stock_summary';
            // echo '<pre>',print_r($data['result']),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_group'] = $this->db->get_where('item_groups', array('status' => 1))->result();
        return array('page'=>'reports/group_stock_summary_v', 'data'=>$data);
    } 

    public function _fetch_group_stock_summary_details($it_arr, $df, $dt) {
   
        $df = date('Y-m-d', strtotime($df));
        $dt = date('Y-m-d', strtotime($dt));
        $dt_1419 = date('Y-m-d', strtotime('2022-04-01'));

        $this->db->where_in('ig_id', $it_arr);
        // $this->db->order_by('GROUP_DESC');
        $rs_group = $this->db->get('item_groups')->result_array();
        
        $html4 = '';


        //-------------------------------LOCAL REPORT START--------------------------
        $html = '';
        $grand_tot1 = 0;$grand_tot2 = 0;$grand_tot3 = 0;$grand_tot4 = 0;
        $grand_tot5 = 0;$grand_tot6 = 0;$grand_tot7 = 0;$grand_tot8 = 0; $grand_tot9 = 0; $grand_tot10 = 0;
        
        $grand_tott1 = 0;$grand_tott2 = 0;$grand_tott3 = 0;$grand_tott4 = 0;
        $grand_tott5 = 0;$grand_tott6 = 0;$grand_tott7 = 0;$grand_tott8 = 0; $grand_tott9 = 0; $grand_tott10 = 0;

        //item group loop
        foreach ($rs_group as $group) {
            $grp_tot1 = 0;$grp_tot2 = 0;$grp_tot3 = 0;$grp_tot4 = 0;
            $grp_tot5 = 0;$grp_tot6 = 0;$grp_tot7 = 0;$grp_tot8 = 0; $grp_tot9 = 0; 
            $grp_tot10 = 0;

            //individual item+color
            $this->db->join('item_dtl', 'item_dtl.im_id = item_master.im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->where('ig_id', $group['ig_id']);
            $this->db->where('type', 'Local'); //local
            $rs_item = $this->db->get('item_master')->result_array();

            if(count($rs_item) == 0) continue;

            foreach ($rs_item as $item) {
                $item_dtl_seq = $item['id_id'];

                //if opening date is 01/04/2022
                if ($df == '2022-04-01') {
                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

            $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }
                // echo $this->db->last_query(); die();

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += round($row_opn->opn_qty, 2);
                    $grp_tot2 += round(($row_opn->opn_qty * $row_opn->opening_rate), 2);
                    $grp_tot3 += round($pur_qty, 2);
                    $grp_tot4 += round($pur_rate, 2);
                    $grp_tot5 += round($issue_qty, 2);
                    $grp_tot6 += round($issue_rate, 2);
                    $grp_tot7 += round($stock_in_qnty, 2);
                    $grp_tot8 += round($stock_in_val, 2);
                    $grp_tot9 += round(($row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty)  + $stock_in_qnty), 2);
                    $grp_tot10 += round((($row_opn->opn_qty * $row_opn->opening_rate) + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val), 2);
                }
                //if opening date is not 01/04/2022
                else {
                    $df_open = date('Y-m-d', strtotime('2022-04-01'));
                    $df_close = date('Y-m-d', strtotime('2022-04-30'));
                    
                    
                    $df_open_prev_date = date('Y-m-d', strtotime('-1 day', strtotime($df)));


                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

                $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();


                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df_open_prev_date)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $opn_qty = $row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty;
                    $opn_val = $row_opn->opn_qty * $row_opn->opening_rate + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val;



                $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += round($opn_qty, 2);
                    $grp_tot2 += round($opn_val, 2);
                    $grp_tot3 += round($pur_qty, 2);
                    $grp_tot4 += round($pur_rate, 2);
                    $grp_tot5 += round($issue_qty, 2);
                    $grp_tot6 += round($issue_rate, 2);
                    $grp_tot7 += round($stock_in_qnty, 2);
                    $grp_tot8 += round($stock_in_val, 2);
                    $grp_tot9 += round(($opn_qty + $pur_qty - ($issue_qty + $plating_qnty ) + $stock_in_qnty), 2);
                    $grp_tot10 += round(($opn_val + $pur_rate - ($issue_rate + $plating_val ) + $stock_in_val), 2);
                }
            }

            $grand_tot1 += round($grp_tot1, 2);
            $grand_tot2 += round($grp_tot2, 2);
            $grand_tot3 += round($grp_tot3, 2);
            $grand_tot4 += round($grp_tot4, 2);
            $grand_tot5 += round($grp_tot5, 2);
            $grand_tot6 += round($grp_tot6, 2);
            $grand_tot7 += round($grp_tot7, 2);
            $grand_tot8 += round($grp_tot8, 2);
            $grand_tot9 += round($grp_tot9, 2);
            $grand_tot10 += round($grp_tot10, 2);
            
            $grp_tot9 = round($grp_tot9, 2);
            $grand_tot10 = round($grand_tot10, 2);
            
            
            
            
            
            $html .= <<<EOD
<tr>
    <td>{$group['group_name']}</td>
    <td style="text-align:right">$grp_tot1</td>
    <td style="text-align:right">$grp_tot2</td>
    <td style="text-align:right">$grp_tot3</td>
    <td style="text-align:right">$grp_tot4</td>
    <td style="text-align:right">$grp_tot5</td>
    <td style="text-align:right">$grp_tot6</td>
    <td style="text-align:right">$grp_tot7</td>
    <td style="text-align:right">$grp_tot8</td>
    <td style="text-align:right">$grp_tot9</td>
    <td style="text-align:right">$grp_tot10</td>
</tr>
EOD;
        }

        $html .= <<<EOD
<tr style="background: #d4ecea;">
    <th> Sub Total </th>
    <th style="text-align:right">$grand_tot1</th>
    <th style="text-align:right">$grand_tot2</th>
    <th style="text-align:right">$grand_tot3</th>
    <th style="text-align:right">$grand_tot4</th>
    <th style="text-align:right">$grand_tot5</th>
    <th style="text-align:right">$grand_tot6</th>
    <th style="text-align:right">$grand_tot7</th>
    <th style="text-align:right">$grand_tot8</th>
    <th style="text-align:right">$grand_tot9</th>
    <th style="text-align:right">$grand_tot10</th>
</tr>
EOD;

            $grand_tott1 += round($grand_tot1, 2);
            $grand_tott2 += round($grand_tot2, 2);
            $grand_tott3 += round($grand_tot3, 2);
            $grand_tott4 += round($grand_tot4, 2);
            $grand_tott5 += round($grand_tot5, 2);
            $grand_tott6 += round($grand_tot6, 2);
            $grand_tott7 += round($grand_tot7, 2);
            $grand_tott8 += round($grand_tot8, 2);
            $grand_tott9 += round($grand_tot9, 2);
            $grand_tott10 += round($grand_tot10, 2);

        //-------------------------------LOCAL REPORT END-----------------------------

        //-------------------------------IMPORT REPORT START--------------------------
        $html2 = '';
        $grand_tot1 = 0;$grand_tot2 = 0;$grand_tot3 = 0;$grand_tot4 = 0;
        $grand_tot5 = 0;$grand_tot6 = 0;$grand_tot7 = 0;$grand_tot8 = 0; $grand_tot9 = 0; $grand_tot10 = 0;

        //item group loop
        foreach ($rs_group as $group) {
            $grp_tot1 = 0;$grp_tot2 = 0;$grp_tot3 = 0;$grp_tot4 = 0;
            $grp_tot5 = 0;$grp_tot6 = 0;$grp_tot7 = 0;$grp_tot8 = 0; $grp_tot9 = 0; 
            $grp_tot10 = 0;

            //individual item+color
            $this->db->join('item_dtl', 'item_dtl.im_id = item_master.im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->where('ig_id', $group['ig_id']);
            $this->db->where('type', 'Import'); //local
            $rs_item = $this->db->get('item_master')->result_array();
            if(count($rs_item) == 0) continue;

            foreach ($rs_item as $item) {
                $item_dtl_seq = $item['id_id'];

                //if opening date is 01/04/2020
                if ($df == '2022-04-01') {
                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

            $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += round($row_opn->opn_qty, 2);
                    $grp_tot2 += round(($row_opn->opn_qty * $row_opn->opening_rate), 2);
                    $grp_tot3 += round($pur_qty, 2);
                    $grp_tot4 += round($pur_rate, 2);
                    $grp_tot5 += round($issue_qty, 2);
                    $grp_tot6 += round($issue_rate, 2);
                    $grp_tot7 += round($stock_in_qnty, 2);
                    $grp_tot8 += round($stock_in_val, 2);
                    $grp_tot9 += round(($row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty), 2);
                    $grp_tot10 += round(($row_opn->opn_qty * $row_opn->opening_rate + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val), 2);
                }
                //if opening date is not 01/04/2020
                else {
                    $df_open = date('Y-m-d', strtotime('2022-04-01'));
                    $df_close = date('Y-m-d', strtotime('2022-04-30'));

                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

                $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $opn_qty = $row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty;
                    $opn_val = $row_opn->opn_qty * $row_opn->opening_rate + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val;



                    $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                    $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += $opn_qty;
                    $grp_tot2 += $opn_val;
                    $grp_tot3 += $pur_qty;
                    $grp_tot4 += $pur_rate;
                    $grp_tot5 += $issue_qty;
                    $grp_tot6 += $issue_rate;
                    $grp_tot7 += $stock_in_qnty;
                    $grp_tot8 += $stock_in_val;
                    $grp_tot9 += $opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty;
                    $grp_tot10 += $opn_val + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val;
                }
            }

            $grand_tot1 += round($grp_tot1, 2);
            $grand_tot2 += round($grp_tot2, 2);
            $grand_tot3 += round($grp_tot3, 2);
            $grand_tot4 += round($grp_tot4, 2);
            $grand_tot5 += round($grp_tot5, 2);
            $grand_tot6 += round($grp_tot6, 2);
            $grand_tot7 += round($grp_tot7, 2);
            $grand_tot8 += round($grp_tot8, 2);
            $grand_tot9 += round($grp_tot9, 2);
            $grand_tot10 += round($grp_tot10, 2);
            
            $grp_tot9 = round($grp_tot9, 2);
            $grand_tot10 = round($grand_tot10, 2);
            $html2 .= <<<EOD
<tr>
    <td>{$group['group_name']}</td>
    <td style="text-align:right">$grp_tot1</td>
    <td style="text-align:right">$grp_tot2</td>
    <td style="text-align:right">$grp_tot3</td>
    <td style="text-align:right">$grp_tot4</td>
    <td style="text-align:right">$grp_tot5</td>
    <td style="text-align:right">$grp_tot6</td>
    <td style="text-align:right">$grp_tot7</td>
    <td style="text-align:right">$grp_tot8</td>
    <td style="text-align:right">$grp_tot9</td>
    <td style="text-align:right">$grp_tot10</td>
</tr>
EOD;
        }

        $html2 .= <<<EOD
<tr style="background: #d4ecea;">
    <th> Sub Total </th>
    <th style="text-align:right">$grand_tot1</th>
    <th style="text-align:right">$grand_tot2</th>
    <th style="text-align:right">$grand_tot3</th>
    <th style="text-align:right">$grand_tot4</th>
    <th style="text-align:right">$grand_tot5</th>
    <th style="text-align:right">$grand_tot6</th>
    <th style="text-align:right">$grand_tot7</th>
    <th style="text-align:right">$grand_tot8</th>
    <th style="text-align:right">$grand_tot9</th>
    <th style="text-align:right">$grand_tot10</th>
</tr>
EOD;

            $grand_tott1 += round($grand_tot1, 2);
            $grand_tott2 += round($grand_tot2, 2);
            $grand_tott3 += round($grand_tot3, 2);
            $grand_tott4 += round($grand_tot4, 2);
            $grand_tott5 += round($grand_tot5, 2);
            $grand_tott6 += round($grand_tot6, 2);
            $grand_tott7 += round($grand_tot7, 2);
            $grand_tott8 += round($grand_tot8, 2);
            $grand_tott9 += round($grand_tot9, 2);
            $grand_tott10 += round($grand_tot10, 2);

        //-------------------------------IMPORT REPORT END-----------------------------

        //-------------------------------NONE REPORT START--------------------------
        $html3 = '';
        $grand_tot1 = 0;$grand_tot2 = 0;$grand_tot3 = 0;$grand_tot4 = 0;
        $grand_tot5 = 0;$grand_tot6 = 0;$grand_tot7 = 0;$grand_tot8 = 0; $grand_tot9 = 0; $grand_tot10 = 0;

        //item group loop
        foreach ($rs_group as $group) {
            $grp_tot1 = 0;$grp_tot2 = 0;$grp_tot3 = 0;$grp_tot4 = 0;
            $grp_tot5 = 0;$grp_tot6 = 0;$grp_tot7 = 0;$grp_tot8 = 0; $grp_tot9 = 0; 
            $grp_tot10 = 0;

            //individual item+color
            $this->db->join('item_dtl', 'item_dtl.im_id = item_master.im_id', 'left');
            $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
            $this->db->where('ig_id', $group['ig_id']);
            $this->db->where('type', 'None'); //local
            $rs_item = $this->db->get('item_master')->result_array();
            if(count($rs_item) == 0) continue;

            foreach ($rs_item as $item) {
                $item_dtl_seq = $item['id_id'];

                //if opening date is 01/04/2020
                if ($df == '2022-04-01') {
                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

            $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += round($row_opn->opn_qty, 2);
                    $grp_tot2 += round(($row_opn->opn_qty * $row_opn->opening_rate), 2);
                    $grp_tot3 += round($pur_qty, 2);
                    $grp_tot4 += round($pur_rate, 2);
                    $grp_tot5 += round($issue_qty, 2);
                    $grp_tot6 += round($issue_rate, 2);
                    $grp_tot7 += round($stock_in_qnty, 2);
                    $grp_tot8 += round($stock_in_val, 2);
                    $grp_tot9 += round(($row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty), 2);
                    $grp_tot10 += round(($row_opn->opn_qty * $row_opn->opening_rate + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val), 2);
                }
                //if opening date is not 01/04/2020
                else {
                    $df_open = date('Y-m-d', strtotime('2022-04-01'));
                    $df_close = date('Y-m-d', strtotime('2022-04-30'));
                    
                    $this->db->select('item_dtl.id_id, item_dtl.opening_stock as opn_qty, item_master.item, colors.color, item_dtl.opening_rate');
                    $this->db->join('item_master', 'item_master.im_id = item_dtl.im_id', 'left');
                    $this->db->join('colors', 'colors.c_id = item_dtl.c_id', 'left');
                    $this->db->where('item_dtl.id_id', $item_dtl_seq);
                    $row_opn = $this->db->get('item_dtl')->row();
                    
                    if (count($row_opn) == 0) continue;

                    // $this->db->where('id_id', $row_opn->id_id);
                    // $this->db->where("str_to_date(`effective_date`, '%d-%m-%Y') <=", $dt_1419);
                    // $this->db->order_by("str_to_date(`effective_date`, '%d-%m-%Y') DESC");
                    // $row_opn_rate = $this->db->get('item_rates')->row();
                    // if (count($row_opn_rate) != 0) {
                    //     $opn_rate = $row_opn_rate->purchase_rate;
                    // } else {
                    //     $opn_rate = 0;
                    // }

                $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df_open)) . '" and "' . date('Y-m-d', strtotime($df)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $opn_qty = $row_opn->opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty;
                    $opn_val = $row_opn->opn_qty * $row_opn->opening_rate + $pur_rate - ($issue_rate + $plating_val) + $stock_in_val;



                $row_pur = $this->db->select('SUM(item_quantity) as purch_qty, SUM(item_quantity * item_rate) as purch_rate')
                ->join('purchase_order_receive', 'purchase_order_receive.purchase_order_receive_id = purchase_order_receive_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(purchase_order_receive.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('purchase_order_receive_detail.id_id', $item_dtl_seq)
                ->group_by('purchase_order_receive_detail.id_id')
                ->get('purchase_order_receive_detail')->row();

                if(count($row_pur) != 0) {
                    $pur_qty = $row_pur->purch_qty;
                    $pur_rate = $row_pur->purch_rate;
                } else {
                    $pur_qty = 0;
                    $pur_rate = 0;
                }

                $row_issue = $this->db->select('SUM(material_issue_detail.issue_quantity) as issue_qnty, SUM(material_issue_detail.issue_quantity * material_issue_detail.issue_rate) as issue_rate')
                ->join('material_issue', 'material_issue.material_issue_id = material_issue_detail.material_issue_id', 'left')
                ->where('STR_TO_DATE(material_issue.material_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('material_issue_detail.id_id', $item_dtl_seq)
                ->group_by('material_issue_detail.id_id')
                ->get('material_issue_detail')->row();

                if(count($row_issue) != 0) {
                    $issue_qty = $row_issue->issue_qnty;
                    $issue_rate = $row_issue->issue_rate;
                } else {
                    $issue_qty = 0;
                    $issue_rate = 0;
                }

                $stockin_row = $this->db->select('SUM(stock_in_detail.item_quantity) as stock_qnty, SUM(stock_in_detail.item_quantity * stock_in_detail.item_rate) as stock_rate')
                ->join('stock_in', 'stock_in.purchase_order_receive_id = stock_in_detail.purchase_order_receive_id', 'left')
                ->where('STR_TO_DATE(stock_in.purchase_order_receive_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where('stock_in_detail.id_id', $item_dtl_seq)
                ->group_by('stock_in_detail.id_id')
                ->get('stock_in_detail')->row();

                if(count($stockin_row) != 0) {
                    $stock_in_qnty = $stockin_row->stock_qnty;
                    $stock_in_val = $stockin_row->stock_rate;
                } else {
                    $stock_in_qnty = 0;
                    $stock_in_val = 0;
                }
                
                $plating_row = $this->db->select('SUM(platting_issue_detail.issue_quantity) as plating_quantity, SUM(platting_issue_detail.issue_quantity * platting_issue_detail.plating_rate) as plating_rate')
                ->join('platting_issue', 'platting_issue.platting_issue_id = platting_issue_detail.platting_issue_id', 'left')
                ->where('STR_TO_DATE(platting_issue.platting_issue_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                ->where(array('platting_issue_detail.im_id' => $item['im_id'], 'platting_issue_detail.item_colour' => $item['c_id']))
                ->get('platting_issue_detail')->row();
                
                if(count($plating_row) != 0) {
                    $plating_qnty = $plating_row->plating_quantity;
                    $plating_val = $plating_row->plating_rate;
                } else {
                    $plating_qnty = 0;
                    $plating_val = 0;
                }

                    $grp_tot1 += round($opn_qty, 2);
                    $grp_tot2 += round($opn_val, 2);
                    $grp_tot3 += round($pur_qty, 2);
                    $grp_tot4 += round($pur_rate, 2);
                    $grp_tot5 += round($issue_qty, 2);
                    $grp_tot6 += round($issue_rate, 2);
                    $grp_tot7 += round($stock_in_qnty, 2);
                    $grp_tot8 += round($stock_in_val, 2);
                    $grp_tot9 += round(($opn_qty + $pur_qty - ($issue_qty + $plating_qnty) + $stock_in_qnty), 2);
                    $grp_tot10 += round(($opn_val + $pur_rate - ($issue_rate + $plating_val)  + $stock_in_val), 2);
                }
            }

            $grand_tot1 += round($grp_tot1, 2);
            $grand_tot2 += round($grp_tot2, 2);
            $grand_tot3 += round($grp_tot3, 2);
            $grand_tot4 += round($grp_tot4, 2);
            $grand_tot5 += round($grp_tot5, 2);
            $grand_tot6 += round($grp_tot6, 2);
            $grand_tot7 += round($grp_tot7, 2);
            $grand_tot8 += round($grp_tot8, 2);
            $grand_tot9 += round($grp_tot9, 2);
            $grand_tot10 += round($grp_tot10, 2);
            
            $grp_tot9 = round($grp_tot9, 2);
            $grand_tot10 = round($grand_tot10, 2);
            $html3 .= <<<EOD
<tr>
    <td>{$group['group_name']}</td>
    <td style="text-align:right">$grp_tot1</td>
    <td style="text-align:right">$grp_tot2</td>
    <td style="text-align:right">$grp_tot3</td>
    <td style="text-align:right">$grp_tot4</td>
    <td style="text-align:right">$grp_tot5</td>
    <td style="text-align:right">$grp_tot6</td>
    <td style="text-align:right">$grp_tot7</td>
    <td style="text-align:right">$grp_tot8</td>
    <td style="text-align:right">$grp_tot9</td>
    <td style="text-align:right">$grp_tot10</td>
</tr>
EOD;
        }

        $html3 .= <<<EOD
<tr style="background: #d4ecea;">
    <th>  Sub Total</th>
    <th style="text-align:right">$grand_tot1</th>
    <th style="text-align:right">$grand_tot2</th>
    <th style="text-align:right">$grand_tot3</th>
    <th style="text-align:right">$grand_tot4</th>
    <th style="text-align:right">$grand_tot5</th>
    <th style="text-align:right">$grand_tot6</th>
    <th style="text-align:right">$grand_tot7</th>
    <th style="text-align:right">$grand_tot8</th>
    <th style="text-align:right">$grand_tot9</th>
    <th style="text-align:right">$grand_tot10</th>
</tr>
EOD;

            $grand_tott1 += round($grand_tot1, 2);
            $grand_tott2 += round($grand_tot2, 2);
            $grand_tott3 += round($grand_tot3, 2);
            $grand_tott4 += round($grand_tot4, 2);
            $grand_tott5 += round($grand_tot5, 2);
            $grand_tott6 += round($grand_tot6, 2);
            $grand_tott7 += round($grand_tot7, 2);
            $grand_tott8 += round($grand_tot8, 2);
            $grand_tott9 += round($grand_tot9, 2);
            $grand_tott10 += round($grand_tot10, 2);
            
 $html4 .= <<<EOD
  <tr style="background: #36548b; color: white;">
    <th> Grand Total </th>
    <th style="text-align:right">$grand_tott1</th>
    <th style="text-align:right">$grand_tott2</th>
    <th style="text-align:right">$grand_tott3</th>
    <th style="text-align:right">$grand_tott4</th>
    <th style="text-align:right">$grand_tott5</th>
    <th style="text-align:right">$grand_tott6</th>
    <th style="text-align:right">$grand_tott7</th>
    <th style="text-align:right">$grand_tott8</th>
    <th style="text-align:right">$grand_tott9</th>
    <th style="text-align:right">$grand_tott10</th>
  </tr>
EOD;
            
        //-------------------------------NONE REPORT END-----------------------------


        $array['html'] = $html;
        $array['html2'] = $html2;
        $array['html3'] = $html3;
        $array['html4'] = $html4;
        return $array;
    }
    
    public function fetch_jobber_bill_summary() {
        $data = array();
        if($this->input->post()) {
            $it_arr = $this->input->post('fab1[]');
            $df = $this->input->post('from');
            $dt = $this->input->post('to');
            // for ($i = 0; $i < count($it_arr); $i++) {
            $data['result'][] = $this->_fetch_jobber_bill_summary_details($it_arr, $df, $dt);
        // }
            $data['segment'] = 'jobber_bill_summary';
            // echo '<pre>',print_r($data['result']),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('acc_type' => 'Fabricator', 'status' => 1))->result();
        return array('page'=>'reports/jobber_bill_summary_v', 'data'=>$data);
    }

    public function _fetch_jobber_bill_summary_details($code, $df, $dt) {
   
        $res = $this->db->select('jobber_bill.*, sum(jobber_bill_detail.quantity) as quantity, acc_master.name')
                 ->join('jobber_bill', 'jobber_bill.jobber_bill_id = jobber_bill_detail.jobber_bill_id', 'left')
                 ->join('acc_master', 'acc_master.am_id = jobber_bill.am_id', 'left')
                 ->where('STR_TO_DATE(jobber_bill.jobber_bill_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                 ->where_in('jobber_bill.am_id', $code)
                 ->group_by('jobber_bill_detail.jobber_bill_id')
                 ->order_by('acc_master.name, jobber_bill.jobber_bill_date')
                 ->get_where('jobber_bill_detail', array('jobber_bill.status' => 1))
                 ->result();

        return $res;

    }
    
    public function fetch_cutter_bill_summary() {
        $data = array();
        if($this->input->post()) {
            $it_arr = $this->input->post('fab1[]');
            $df = $this->input->post('from');
            $dt = $this->input->post('to');
            // for ($i = 0; $i < count($it_arr); $i++) {
            $data['result'][] = $this->_fetch_cutter_bill_summary_details($it_arr, $df, $dt);
        // }
            $data['segment'] = 'cutter_bill_summary';
            // echo '<pre>',print_r($data['result']),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('acc_type' => 'Cutter', 'status' => 1))->result();
        return array('page'=>'reports/cutter_bill_summary_v', 'data'=>$data);
    }

    public function _fetch_cutter_bill_summary_details($code, $df, $dt) {
   
        $res = $this->db->select('cutter_bill.*, sum(cutter_bill_dtl.original_quantity) as total_quantity, sum(cutter_bill_dtl.original_quantity * cutter_bill_dtl.parts) as total_parts, acc_master.name')
                 ->join('cutter_bill', 'cutter_bill.cb_id = cutter_bill_dtl.cb_id', 'left')
                 ->join('acc_master', 'acc_master.am_id = cutter_bill.am_id', 'left')
                 ->where('STR_TO_DATE(cutter_bill.cutter_bill_date, "%Y-%m-%d") BETWEEN "' . date('Y-m-d', strtotime($df)) . '" and "' . date('Y-m-d', strtotime($dt)) . '"')
                 ->where_in('cutter_bill.am_id', $code)
                 ->group_by('cutter_bill_dtl.cb_id')
                 ->order_by('acc_master.name, cutter_bill.cutter_bill_date')
                 ->get_where('cutter_bill_dtl', array('cutter_bill.status' => 1))
                 ->result();

        return $res;

    }
    
    public function fetch_monthly_production_status() {
        $data = array();
        if($this->input->post()) {
            $it_arr = implode(",", $this->input->post('fab1[]'));
            $df = $this->input->post('from');
            $dt = $this->input->post('to');
            // for ($i = 0; $i < count($it_arr); $i++) {
            $data['fetch_all_monthly_buyer_report'][] = $this->_fetch_monthly_production_status_details($it_arr, $df, $dt);
        // }
            $data['segment'] = 'monthly_production_status';
            // echo '<pre>',print_r($data['fetch_all_monthly_buyer_report']),'</pre>'; die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('status' => 1))->result();
        return array('page'=>'reports/monthly_production_status_v', 'data'=>$data);
    }

    public function _fetch_monthly_production_status_details($code, $df, $dt) {

        $user = $this->session->user_id;

        $dept_id = $this->db->get_where('user_details', array('user_id' => $user))->result()[0]->user_dept;
   
        $res = $this->db
            ->select('acc_master.name, package_date, package_name, SUM(packing_shipment_detail.article_quantity) AS total_quantity, MONTHNAME(package_date) AS mname')
            ->join('packing_shipment_detail', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left')
            ->join('customer_order', 'packing_shipment_detail.co_id = customer_order.co_id', 'left')
            ->join('acc_master', 'acc_master.am_id = customer_order.acc_master_id', 'left')
            ->join('user_details', 'user_details.user_id = customer_order.user_id', 'left')
            // ->where_in('acc1.ACC_MASTER_CODE', $ord, false)
            ->where("acc_master.am_id IN (".$code.")",NULL, false)
            // ->where('user_details.user_dept', $dept_id)
            ->where('packing_shipment_detail.status', 1)
            ->order_by("str_to_date(mname,'%M')")
            // ->order_by('MNAME, ACC_MASTER_NAME, PACK_NAME')
            ->group_by('acc_master.name, package_name, mname')
            ->get('packing_shipment')
            ->result();
        //   echo $this->db->last_query();  die;
        // return array_reverse($res);
        return $res;

    }
    
    public function fetch_production_register() {
        $data = array();
        if($this->input->post()) {
            $opening_quantity = $this->input->post('opening_quantity');
            $df = $this->input->post('fromdate');
            $dt = $this->input->post('todate');
            $data['from'] = $this->input->post('fromdate');
            $data['to'] = $this->input->post('todate');
            // for ($i = 0; $i < count($it_arr); $i++) {
            $data['result'] = $this->_fetch_fetch_production_register($df, $dt);
        // }
            $data['segment'] = 'fetch_production_register';
            // echo '<pre>',print_r($data['fetch_all_monthly_buyer_report']),'</pre>'; die();
            $data['closing_balance'] = $opening_quantity; 
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('status' => 1))->result();
        return array('page'=>'reports/fetch_production_register_v', 'data'=>$data);
    }

    public function _fetch_fetch_production_register($df, $dt) {

        $query = "
        (SELECT
                article_master.art_no AS article_name,
                jobber_challan_receipt.jobber_receipt_challan_number AS challan_number,
                DATE_FORMAT(jobber_challan_receipt.jobber_receipt_challan_date, '%d-%m-%Y') as challan_date,
                colors.color AS article_color,
                jobber_challan_receipt_details.jobber_receive_quantity AS challan_quantity,
                0 AS invoice_quantity,
                MONTHNAME(jobber_challan_receipt.jobber_receipt_challan_date) AS mon,
                0 AS challan_status,
                jobber_challan_receipt.jobber_receipt_challan_number AS jobber_receipt_sort,
                '' AS invoice_number_sort
                FROM
                `jobber_challan_receipt_details`
                LEFT JOIN article_master ON article_master.am_id = jobber_challan_receipt_details.am_id
                LEFT JOIN colors ON colors.c_id = jobber_challan_receipt_details.lc_id
                LEFT JOIN jobber_challan_receipt ON jobber_challan_receipt.jobber_challan_receipt_id = jobber_challan_receipt_details.jobber_challan_receipt_id
                LEFT JOIN customer_order_dtl ON customer_order_dtl.cod_id = jobber_challan_receipt_details.cod_id
                LEFT JOIN customer_order ON customer_order.co_id = customer_order_dtl.co_id
            WHERE STR_TO_DATE(jobber_challan_receipt.jobber_receipt_challan_date, '%Y-%m-%d') <= '$dt' AND STR_TO_DATE(jobber_challan_receipt.jobber_receipt_challan_date, '%Y-%m-%d') >= '$df'
            AND
                jobber_challan_receipt_details.status = 1
            ORDER BY
                jobber_challan_receipt.jobber_receipt_challan_date, jobber_challan_receipt.jobber_receipt_challan_number)
                UNION ALL(SELECT
                article_master.art_no AS article_name,
                office_invoice.office_invoice_number AS challan_number,
                DATE_FORMAT(office_invoice.office_invoice_date, '%d-%m-%Y') as challan_date,
                colors.color AS article_color,
                office_invoice_detail.quantity AS challan_quantity,
                office_invoice_detail.quantity AS invoice_quantity,
                MONTHNAME(office_invoice.office_invoice_date) AS mon,
                1 AS challan_status,
                '' As jobber_receipt_sort,
                office_invoice.office_invoice_number AS invoice_number_sort
                FROM
                `office_invoice_detail`
                LEFT JOIN article_master ON article_master.am_id = office_invoice_detail.am_id
                LEFT JOIN colors ON colors.c_id = office_invoice_detail.lc_id
                LEFT JOIN office_invoice ON office_invoice.office_invoice_id = office_invoice_detail.office_invoice_id
                LEFT JOIN customer_order_dtl ON customer_order_dtl.cod_id = office_invoice_detail.cod_id
                LEFT JOIN customer_order ON customer_order.co_id = customer_order_dtl.co_id
                WHERE STR_TO_DATE(office_invoice.office_invoice_date, '%Y-%m-%d') <= '$dt' AND STR_TO_DATE(office_invoice.office_invoice_date, '%Y-%m-%d') >= '$df'
                ORDER BY
                office_invoice.office_invoice_date, office_invoice.office_invoice_number)
                ORDER BY STR_TO_DATE(challan_date,'%d-%m-%Y'),jobber_receipt_sort,invoice_number_sort
                ";
        $res = $this->db->query($query)->result();

            // echo '<pre>', print_r($res), '</pre>'; die();

            return $res;

    }
    
    public function fetch_outstanding_report() {
        $data = array();

        if($this->input->post('print')) {

            $it_arr = $this->input->post('fab1[]');
            $df = $this->input->post('from');
            $dt = $this->input->post('to');
            for ($i = 0; $i < count($it_arr); $i++) {
            $data['result'][] = $this->_fetch_outstanding_report($it_arr[$i], $df, $dt);
            }
            $data['segment'] = 'outstanding_report';
            
            // echo '<pre>', print_r($data['result']), '</pre>';die();

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        if($this->input->post('print_groupwise')) {

            $it_arr = $this->input->post('fab1');
            $dept_arr = implode(',',$this->input->post('department_values[]'));
            $df = $this->input->post('from');
            $dt = $this->input->post('to');
            $data['result'] = $this->_fetch_outstanding_report_group_wise($it_arr, $dept_arr, $df, $dt);
            $data['segment'] = 'outstanding_report_groupwise';
            
            // echo '<pre>', print_r($data['result']), '</pre>';die();

            return array('page'=>'reports/common_print_v','data'=>$data);

        }
        
        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('status' => 1))->result();
        $data['fetch_department'] = $this->db->get_where('departments', array('status' => 1))->result();
        return array('page'=>'reports/outstanding_report_v', 'data'=>$data);
    }

    public function _fetch_outstanding_report($code, $df, $dt) {

        $query = "SELECT
                office_proforma.proforma_number,
                office_proforma.proforma_date,
                acc_master.am_id,
                acc_master.name,
                DATE_FORMAT(customer_order.co_date, '%d-%m-%Y') as co_date,
                customer_order.co_no,
                DATE_FORMAT(customer_order.co_delivery_date, '%d-%m-%Y') as co_delivery_date,
                customer_order.co_delivery_date,
                article_master.art_no,
                article_master.alt_art_no,
                colors.color,
                office_proforma_detail.co_quantity,
                office_invoice_detail.quantity,
                office_proforma_detail.cod_id,
                office_proforma_detail.rate_foreign,
                departments.department
                FROM
                `office_proforma`
                LEFT JOIN office_proforma_detail ON office_proforma_detail.office_proforma_id = office_proforma.office_proforma_id
                LEFT JOIN acc_master ON acc_master.am_id = office_proforma.buyer_id
                LEFT JOIN customer_order ON customer_order.co_id = office_proforma_detail.co_id
                LEFT JOIN user_details ON user_details.user_id = customer_order.user_id
                LEFT JOIN departments ON departments.d_id = user_details.user_dept
                LEFT JOIN article_master ON article_master.am_id = office_proforma_detail.am_id
                LEFT JOIN colors ON colors.c_id = office_proforma_detail.lc_id
                LEFT JOIN office_invoice_detail ON office_invoice_detail.cod_id = office_proforma_detail.cod_id
            WHERE 
            office_proforma.buyer_id = $code AND
            STR_TO_DATE(office_proforma.proforma_date, '%Y-%m-%d') <= '$dt' AND STR_TO_DATE(office_proforma.proforma_date, '%Y-%m-%d') >= '$df'
            AND
                office_proforma.status = 1
                GROUP BY
                    office_proforma_detail.cod_id
            ORDER BY
                office_proforma.proforma_number, customer_order.co_no, article_master.art_no, colors.color";
        $res = $this->db->query($query)->result();

        return $res;

    }
    
    public function _fetch_outstanding_report_group_wise($code, $dept_arr, $df, $dt) {

        $query = "SELECT
                GROUP_CONCAT(
                    CONCAT(
                      office_proforma.proforma_number
                    ) SEPARATOR '<br>'
                  ) AS proforma_number,
                office_proforma.office_proforma_id,
                office_proforma.proforma_date,
                acc_master.am_id,
                acc_master.name,
                DATE_FORMAT(customer_order.co_date, '%d-%m-%Y') as co_date,
                customer_order.co_no,
                DATE_FORMAT(customer_order.co_delivery_date, '%d-%m-%Y') as co_delivery_date,
                article_master.art_no,
                article_master.alt_art_no,
                colors.color,
                0 AS quantity,
                0 AS invoice_amount,
                office_proforma.buyer_id,
                user_details.user_dept,
                user_details.user_id,
                departments.department,
                office_proforma_detail.co_id,
                office_proforma.total_value,
                office_proforma_detail.rate_foreign AS rate_foreign, 
                                  SUM(office_proforma_detail.co_quantity) AS co_quantity,
                SUM(office_proforma_detail.total_rate) AS proforma_total_rate_amount
                FROM
                `customer_order`
                LEFT JOIN office_proforma_detail ON office_proforma_detail.co_id = customer_order.co_id
                LEFT JOIN office_proforma ON office_proforma.office_proforma_id = office_proforma_detail.office_proforma_id
                LEFT JOIN acc_master ON acc_master.am_id = office_proforma.buyer_id
                LEFT JOIN user_details ON customer_order.user_id = user_details.user_id
                LEFT JOIN departments ON user_details.user_dept = departments.d_id
                LEFT JOIN article_master ON article_master.am_id = office_proforma_detail.am_id
                LEFT JOIN colors ON colors.c_id = office_proforma_detail.lc_id
            WHERE 
            office_proforma.buyer_id = $code AND
            customer_order.show_in_outstanding_report_or_not = '1'
            AND
            STR_TO_DATE(office_proforma.proforma_date, '%Y-%m-%d') <= '$dt' AND STR_TO_DATE(office_proforma.proforma_date, '%Y-%m-%d') >= '$df'
            AND
            user_details.user_dept IN ($dept_arr)
            AND
                office_proforma.status = 1
            GROUP BY
            office_proforma_detail.co_id
            ORDER BY
                user_details.user_dept, customer_order.co_no";
        $res = $this->db->query($query)->result();
        

        return $res;

    }
    
    public function fetch_payroll_reports() {
        
        $user_id = $this->session->user_id;
        
        $data = array();
        
        $this->fetch_permission_matrix($user_id, $m_id = 46);
        $uvp = $this->_user_wise_view_permission(46, $user_id);
        
        if($this->input->post("adl")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
                        foreach($it_arr as $i_a) {
            $data['result'][] = $this->_fetch_advance_ledger($mon,$i_a);
                        }
            $data['segment'] = 'payroll_reports_advance_ledger';
            // echo '<pre>', print_r($data['result']), '</pre>';die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("lv")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            
            $new_iter = implode(",", $it_arr);
            
            $sql="SELECT employees.e_id
                    FROM employees
                    WHERE employees.e_id IN ($new_iter)
                    ORDER BY employees.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_leave($mon,$r->e_id);
                }
            }
            
            $data['segment'] = 'payroll_reports_leave';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("esi")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $new_iter = implode(",", $it_arr);
            
            
                
                $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_esi_pf1($mon,$r->e_id);
        }
            }
            
            $data['segment'] = 'payroll_esi_pf';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("reg")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            $new_arr = array();
            
            $new_iter = implode(",", $it_arr);
            
            $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                            employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
                    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
                    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
                    FROM salary
                    INNER JOIN(employees)
                    ON(salary.EMPCODE=employees.e_id)
                    WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN ($new_iter)
                    ORDER BY employees.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_register($mon,$r->e_id);
                }
            }
            
            if($this->input->post('month') == 'January') {
                $data['month'] = 'Januray~31~1';
            } else if($this->input->post('month') == 'February') {
                $data['month'] = 'February~28~2';
            } else if($this->input->post('month') == 'March') {
                $data['month'] = 'March~31~3';
            } else if($this->input->post('month') == 'April') {
                $data['month'] = 'April~30~4';
            } else if($this->input->post('month') == 'May') {
                $data['month'] = 'May~31~5';
            } else if($this->input->post('month') == 'June') {
                $data['month'] = 'June~30~6';
            } else if($this->input->post('month') == 'July') {
                $data['month'] = 'July~31~7';
            } else if($this->input->post('month') == 'August') {
                $data['month'] = 'August~31~8';
            } else if($this->input->post('month') == 'September') {
                $data['month'] = 'September~30~9';
            } else if($this->input->post('month') == 'October') {
                $data['month'] = 'October~31~10';
            } else if($this->input->post('month') == 'November') {
                $data['month'] = 'November~30~11';
            } else if($this->input->post('month') == 'December') {
                $data['month'] = 'December~31~12';
            }
            $data['segment'] = 'payroll_register';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post("attendance")){
            $it_arr = $this->input->post('leather[]');
            $new_iter = implode(",", $it_arr);
            
            $sql="SELECT employees.e_id
                    FROM employees
                    WHERE employees.e_id IN ($new_iter)
                    ORDER BY employees.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_attendance($r->e_id);
                }
            }
            
            $data['segment'] = 'payroll_attendance';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post("pf")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $new_iter = implode(",", $it_arr);
            
            
                
                $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
        CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
        salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_esi_pf($mon,$r->e_id);
        }
            }
            
            $data['segment'] = 'payroll_pf';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post("ot")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $new_iter = implode(",", $it_arr);
            
            
                
                $sql="SELECT employees.e_id
        FROM employees
        WHERE employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_ot_details_all($mon,$r->e_id);
        }
            }
            
            $data['segment'] = 'ot_details';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post("sa_otim")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $new_iter = implode(",", $it_arr);
            
            
                
                $sql="SELECT employees.e_id
        FROM employees
        WHERE employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_salary_overtime_details_all($mon,$r->e_id);
        }
            }
            
            $data['segment'] = 'salary_overtime_details';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post("bonus_report")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            
            $departments_lists = '';
            
            $it_groups = $this->input->post('group');
            $data['mont'] = $mon;
            $new_arr = array();
            
            $gets_departments = $this->db->where_in('d_id', $it_groups)->get('departments')->result();
            
            foreach($gets_departments as $g_d) {
                $departments_lists .= $g_d->department.' ,';
            }
            
            $new_iter = implode(",", $it_arr);
            
            
            
            
            $data['d_id'] = $it_groups;
            
            
            
            
                
                $sql="SELECT employees.e_id,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_bonus_report($mon,$r->e_id);
        }
            } else {
                echo 'No Results'; die();
            }
            
            
            
            
            $data['departments_lists'] = $departments_lists;
            
            $data['segment'] = 'bonus_sheet_report_register';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id !=' => 13))->result();    
        
        $data['departments'] = $this->db->get_where('departments', array('user_id !=' => 13))->result();
        
        return array('page'=>'reports/payroll_reports_v', 'data'=>$data);
    }

    public function _fetch_advance_ledger($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = '".$i_a."'
        ORDER BY employees.name, advance.date";
            
        } else {
            $sql="SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = '".$i_a."' AND advance.user_id  != '13'
        ORDER BY employees.name, advance.date";
        }

        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;

    }

    public function _fetch_leave($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) { // account dept restrictions
        
        $sql="SELECT employees.*
            FROM employees
            WHERE employees.e_id='".$i_a."'
            ORDER BY employees.name";
            
        } else {
            
        $sql="SELECT employees.* 
            FROM employees
            WHERE employees.e_id='".$i_a."' AND employees.user_id  != '13'
            ORDER BY employees.name";    
            
        }

        $res = $this->db->query($sql)->result();
        return $res;
        

    }

    public function _fetch_attendance($i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        $sql="SELECT employees.e_id, employees.e_code, employees.name, salary.MON, T1, T2, T3, T4, T5, T6, T7
            FROM employees
            LEFT JOIN salary ON salary.EMPCODE = employees.e_id
            WHERE employees.e_id='".$i_a."' AND employees.user_id  != '13'
            ORDER BY employees.name";
            
        $res = $this->db->query($sql)->result();
        
        return $res;

    }    
    public function _fetch_esi_pf($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no, salary.T1, salary.T7 ,salary.T2,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,CAST((salary.BASIC+salary.OA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL3,salary.GROSS,employees.pf_percentage_calculation
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '".$mon."%' AND employees.e_id='".$i_a."' AND employees.pf = '1'
            ORDER BY employees.e_code";
            
        } else {
            
        $sql="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T1, salary.T7 ,salary.T2,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,CAST((salary.BASIC+salary.OA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL3,salary.GROSS,employees.pf_percentage_calculation
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '".$mon."%' AND employees.e_id='".$i_a."' AND employees.pf = '1' AND employees.user_id  != '13'
            ORDER BY employees.e_code";   
            
        }

        $res = $this->db->query($sql)->result();
        return $res;
        

    }
    
    public function _fetch_esi_pf1($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no, salary.T1, salary.T7 ,salary.T2,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,CAST((salary.BASIC+salary.OA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL3,salary.GROSS,employees.pf_percentage_calculation
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '".$mon."%' AND employees.e_id='".$i_a."' AND employees.esi = '1'
            ORDER BY employees.e_code";
            
        } else {
            
        $sql="SELECT employees.name,e_code,employees.pf_acc_no,employees.esi_acc_no,salary.T1, salary.T7 ,salary.T2,CAST((salary.BASIC+salary.DA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL2,CAST((salary.BASIC+salary.OA+salary.CONV) AS DECIMAL(11,2)) AS TOTAL3,salary.GROSS,employees.pf_percentage_calculation
            FROM salary
            INNER JOIN(employees)
            ON(salary.EMPCODE=employees.e_id)
            WHERE salary.MON LIKE '".$mon."%' AND employees.e_id='".$i_a."' AND employees.esi = '1' AND employees.user_id  != '13'
            ORDER BY employees.e_code";   
            
        }

        $res = $this->db->query($sql)->result();
        return $res;
        

    }

    public function _fetch_register($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT employees.name,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET,salary.MON,employees.e_id,employees.d_id, employees.basic_pay
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN('".$i_a."')
        ORDER BY employees.name";
        
        } else {
            
        $sql="SELECT employees.name,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET,salary.MON,employees.e_id,employees.d_id, employees.basic_pay
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".$mon."%' AND employees.e_id IN('".$i_a."') AND employees.user_id  != '13'
        ORDER BY employees.name";    
            
        }

        $res = $this->db->query($sql)->result();
        // echo '<pre>', print_r($res), '</pre>'; die();
        // echo $this->db->last_query();die;
        return $res;
        

    }
    
    public function _fetch_bonus_report($mon,$i_a) {
        
        $array_bonus_sheet_report = [];
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        for ($mon = 1; $mon <= 12; $mon++) {
            
        $sql="SELECT employees.name,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS, employees.e_id, salary.MON, employees.d_id, salary.LOAN,salary.DEDUC,salary.NET, CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS actual_basic_in_bonus
        FROM salary
        INNER JOIN(employees)
        ON(salary.EMPCODE=employees.e_id)
        WHERE salary.MON LIKE '".date('F', mktime(0, 0, 0, $mon, 1))."%' AND employees.e_id IN('".$i_a."')
        ORDER BY employees.name";    

        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        
        foreach($res as $r) {
            $array_bonus_sheet_report[$r->e_id]['name'] = $r->name;
            $array_bonus_sheet_report[$r->e_id][$r->MON] = $r->actual_basic_in_bonus;
            $array_bonus_sheet_report[$r->e_id]['TOTAL1'] = $r->TOTAL1;
            $array_bonus_sheet_report[$r->e_id]['d_id'] = $r->d_id;
        }
        }
        
        return $array_bonus_sheet_report;
        

    }

    public function article_master_report() {
        $data = array();
        if($this->input->post()){
            $la = implode (",", $this->input->post('leather'));
            $data['result'] = $this->_fetch_article_master_report($la);
            $data['segment'] = 'article_master_report_section';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        $data['fetch_all_buyer'] = $this->db->get_where('acc_master', array('ag_id' => 2, 'status' => 1))->result();

        return array('page'=>'reports/article_master_report_v', 'data'=>$data);
    }

    public function _fetch_article_master_report($la) {

        $query = "SELECT
                                    `article_master`.`art_no`,
                                    `article_master`.`info`,
                                    `article_rates_office_use`.`exworks_factory`,
                                    `article_rates_office_use`.`cf_factory`,
                                    `article_rates_office_use`.`fob_factory`,
                                    `article_rates_office_use`.`exworks_office`,
                                    `article_rates_office_use`.`cf_office`,
                                    `article_rates_office_use`.`fob_office`
                                FROM
                                    `article_rates_office_use`
                                LEFT JOIN `article_master` ON `article_rates_office_use`.`am_id` = `article_master`.`am_id`
                                WHERE
                                    `article_rates_office_use`.am_id IN($la) AND `article_rates_office_use`.status = 1
                                ORDER BY
                                article_master.art_no";

        $res = $this->db->query($query)->result();
        // echo $this->db->last_query();die;

        // echo '<pre>', print_r($res), '</pre>'; die();

        return $res;

    }
    
    public function _fetch_ot_details_all($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT employees.name,overtime.*
        FROM overtime
        INNER JOIN(employees)
        ON(overtime.e_id=employees.e_id)
        WHERE overtime.month LIKE '".$mon."%' AND employees.e_id IN('".$i_a."')
        ORDER BY employees.name";
        
        } else {
            
        $sql="SELECT employees.name,overtime.*
        FROM overtime
        INNER JOIN(employees)
        ON(overtime.e_id=employees.e_id)
        WHERE overtime.month LIKE '".$mon."%' AND employees.e_id IN('".$i_a."') AND employees.user_id  != '13'
        ORDER BY employees.name";    
            
        }

        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;
        
    }
    
    public function _fetch_salary_overtime_details_all($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->user_id;
        
        if($user_id == 13) {
        
        $sql="SELECT employees.name,overtime.*,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
        FROM overtime
        INNER JOIN(employees)
        ON(overtime.e_id=employees.e_id)
        INNER JOIN(salary)
        ON(employees.e_id=salary.EMPCODE)
        WHERE overtime.month LIKE '".$mon."%' AND employees.e_id IN('".$i_a."') AND salary.MON LIKE '".$mon."%'
        ORDER BY employees.name";
        
        } else {
            
        $sql="SELECT employees.name,overtime.*,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
                employees.hra_amount AS HRA1,employees.convenience AS CONV1,employees.medical_allowance AS MA1,employees.special_allowance AS OA1,
    CAST((employees.basic_pay+employees.da_amout+employees.hra_amount+employees.convenience+employees.medical_allowance+employees.special_allowance) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
        FROM overtime
        INNER JOIN(employees)
        ON(overtime.e_id=employees.e_id)
        INNER JOIN(salary)
        ON(employees.e_id=salary.EMPCODE)
        WHERE overtime.month LIKE '".$mon."%' AND employees.e_id IN('".$i_a."') AND salary.MON LIKE '".$mon."%' AND employees.user_id  != '13'
        ORDER BY employees.name";    
            
        }

        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;
        
    }
    
    public function overtime_reports_details_m() {
        $data = array();
        if($this->input->post('overtime_checking')){
            $la = implode (",", $this->input->post('leather'));
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['result'] = $this->_fetch_overtime_checking_entry_details($la, $from, $to);
            $data['segment'] = 'overtime_checking_entry_details';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        
        if($this->input->post('overtime_checking_with_picture')){
            $la = implode (",", $this->input->post('leather'));
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['result'] = $this->_fetch_overtime_checking_entry_details_with_picture($la, $from, $to);
            $data['segment'] = 'overtime_checking_entry_details_with_picture';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        $data['departments'] = $this->db->get('departments')->result();

        return array('page'=>'reports/overtime_report_v', 'data'=>$data);
    }

    public function _fetch_overtime_checking_entry_details($la, $from, $to) {

        $query = "SELECT
                employees.name as emp_name,
                employees.e_id
                FROM
                `checking`
                LEFT JOIN employees ON employees.e_id = checking.e_id
            WHERE 
            checking.e_id IN ($la) AND
            STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') >= '$from'
            AND
                checking.status = 1
            GROUP BY
                checking.e_id";
        $result = $this->db->query($query)->result();
        
        $result_array_list = array();
        
        $extra_time = '';
                        $total_overtime_hours = 0;
                        $total_time = '';
                        $total_normal_duty_hours = 0;
                        $total_duty_hours = 0;
                        $art_no = '';
                        $color = '';
                        $checked_qntty = '';
                        $total_article_checked = 0;
                        $left_quantity = '';
                        $rejection_quantity = '';
                        $total_rate = '';
                        $total_prod_rate = 0;
                        $remarks = '';
                        $total_rejection_quantity = 0;
                        $normal_duty_hours = 0;
        
        foreach($result as $res) {
            $this->db->select('checking.*,checking_details.*, employees.name as emp_name, employees.e_id, article_master.art_no,article_master.credit_score, colors.color')
                     ->join('checking_details', 'checking_details.checking_id=checking.checking_id', 'left')
                     ->join('employees', 'checking.e_id=employees.e_id', 'left')
                     ->join('article_master', 'article_master.am_id=checking_details.am_id', 'left')
                     ->join('colors', 'colors.c_id=checking_details.lc_id', 'left')
                     ->where('checking.e_id', $res->e_id);
                                            
                if ($from != '' or $to != ''){
                        $this->db->where('checking.checking_entry_date >=', $from)->where('checking.checking_entry_date <=', $to);
                }
                                        
                        $result_details = $this->db->group_by('checking.checking_id')->get('checking')->result();
                                            
                                    foreach ($result_details as $r_d) {
                                        $extra_time = '';
                        $total_overtime_hours = 0;
                        $total_time = '';
                        $total_normal_duty_hours = 0;
                        $total_duty_hours = 0;
                        $art_no = '';
                        $color = '';
                        $checked_qntty = '';
                        $total_article_checked = 0;
                        $left_quantity = '';
                        $rejection_quantity = '';
                        $total_rate = '';
                        $total_prod_rate = 0;
                        $total_rejection_quantity = 0;
                        $remarks = '';
                        $normal_duty_hours = 0;
                        $co_no = '';
                    $extra_total_qnty_details = $this->db
                    ->select('checking_details.checked_quantity, checking.extra_time, article_master.art_no, article_master.am_id, colors.color, article_master.credit_score, article_master.img, checking_details.rejection_quantity, checking_details.remarks_for_other_quantity, checking_details.remarks, article_master.credit_score, customer_order.co_no, customer_order.co_id')
                    ->join('checking', 'checking.checking_id=checking_details.checking_id', 'left')
                    ->join('customer_order', 'customer_order.co_id=checking_details.co_id', 'left')
                    ->join('article_master', 'article_master.am_id=checking_details.am_id', 'left')
                     ->join('colors', 'colors.c_id=checking_details.lc_id', 'left')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->where('checking.e_id', $res->e_id)
                    ->get('checking_details')
                    ->result();
                    
                                            $new_checked_qnty = 0;
                    
                                            foreach($extra_total_qnty_details as $e_t_q_d) {
                                                $total_order_quantity = $this->db->select('SUM(co_quantity) AS co_quantity')->get_where('customer_order_dtl', array('co_id' => $e_t_q_d->co_id, 'am_id' => $e_t_q_d->am_id))->row()->co_quantity;
                                                if($e_t_q_d->remarks_for_other_quantity == 'CHECKING') {
                                                $checked_quantity = $this->db->select_sum('checked_quantity')->get_where('checking_details', array('cod_id' => $e_t_q_d->co_id, 'am_id' => $e_t_q_d->am_id, 'remarks_for_other_quantity' => $e_t_q_d->remarks_for_other_quantity))->result()[0]->checked_quantity;
                                                } else {
                                                $checked_quantity = $this->db->select_sum('rejection_quantity')->get_where('checking_details', array('cod_id' => $e_t_q_d->co_id, 'am_id' => $e_t_q_d->am_id, 'remarks_for_other_quantity' => $e_t_q_d->remarks_for_other_quantity))->result()[0]->rejection_quantity;    
                                                }
                                                if($e_t_q_d->remarks_for_other_quantity == 'OTHERS') {
                                                $remarks_valss = $e_t_q_d->remarks;
                                                } else {
                                                $remarks_valss = $e_t_q_d->remarks_for_other_quantity;  
                                                }
                                                $extra_time = $e_t_q_d->extra_time;
                                                $total_overtime_hours = $e_t_q_d->extra_time;
                                                $normal_duty_hours = 8.5;
                                                $total_time = (8.5 + $e_t_q_d->extra_time);
                                                $total_normal_duty_hours += 8.5;
                                                $total_duty_hours = (8.5 + $e_t_q_d->extra_time);
                                                $art_no .= $e_t_q_d->art_no."<br/>";
                                                $color .= $e_t_q_d->color."<br/>";
                                                $checked_qntty .= $e_t_q_d->checked_quantity."<br/>";
                                                $total_article_checked += $e_t_q_d->checked_quantity;
                                                $rejection_quantity .= $e_t_q_d->rejection_quantity."<br/>";
                                                $total_rejection_quantity += $e_t_q_d->rejection_quantity;
                                                $new_checked_qnty = number_format((($e_t_q_d->checked_quantity / 8.5 + $e_t_q_d->extra_time) * $e_t_q_d->credit_score), 2);
                                                $total_rate .= $new_checked_qnty."<br/>";
                                                $remarks .= $remarks_valss."<br/>";
                                                $left_quantity .= ($e_t_q_d->checked_quantity + $e_t_q_d->rejection_quantity)."<br/>";
                                                $total_prod_rate += ($e_t_q_d->checked_quantity + $e_t_q_d->rejection_quantity);
                                                $co_no .= $e_t_q_d->co_no."<br/>";
                                                
                                            }
                                            
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['emp_name'] = $res->emp_name;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checking_entry_date'] = date('d-m-Y', strtotime($r_d->checking_entry_date));
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checking_entry_day'] = date("D", strtotime($r_d->checking_entry_date));
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['normal_duty_hours'] = $normal_duty_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_normal_duty_hours'] = $total_normal_duty_hours; 
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['extra_time'] = $extra_time;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_overtime_hours'] = $total_overtime_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_time'] = $total_time;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_duty_hours'] = $total_duty_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['art_no'] = $art_no;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['color'] = $color;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checked_qntty'] = $checked_qntty;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_article_checked'] = $total_article_checked;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['rejection_quantity'] = $rejection_quantity;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_rejection_qnty'] = $total_rejection_quantity;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_rate'] = $total_rate;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['remarks'] = $remarks;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['left_quantity'] = $left_quantity;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_prod_rate'] = $total_prod_rate;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['co_no'] = $co_no;
                                        
                                    }
                                            
        }
        
        // echo '<pre>', print_r($result_array_list), '</pre>'; die();
        
        return $result_array_list;
        
        //  $result_array_list; 

    }
    
    public function _fetch_overtime_checking_entry_details_with_picture($la, $from, $to) {

        $query = "SELECT
                employees.name as emp_name,
                employees.e_id
                FROM
                `checking`
                LEFT JOIN employees ON employees.e_id = checking.e_id
            WHERE 
            checking.e_id IN ($la) AND
            STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') >= '$from'
            AND
                checking.status = 1
            GROUP BY
                checking.e_id";
        $result = $this->db->query($query)->result();
        
        $result_array_list = array();
        
        $extra_time = '';
                        $total_overtime_hours = 0;
                        $total_time = '';
                        $total_normal_duty_hours = 0;
                        $total_duty_hours = 0;
                        $art_no = '';
                        $arts_imgs = '';
                        $color = '';
                        $checked_qntty = '';
                        $total_article_checked = 0;
                        $rejection_quantity = '';
                        $total_rate = '';
                        $total_prod_rate = 0;
                        $total_rejection_quantity = 0;
                        $normal_duty_hours = 0;
        
        foreach($result as $res) {
            $this->db->select('checking.*,checking_details.*, employees.name as emp_name, employees.e_id, article_master.art_no,article_master.credit_score, colors.color')
                     ->join('checking_details', 'checking_details.checking_id=checking.checking_id', 'left')
                     ->join('employees', 'checking.e_id=employees.e_id', 'left')
                     ->join('article_master', 'article_master.am_id=checking_details.am_id', 'left')
                     ->join('colors', 'colors.c_id=checking_details.lc_id', 'left')
                     ->where('checking.e_id', $res->e_id);
                                            
                if ($from != '' or $to != ''){
                        $this->db->where('checking.checking_entry_date >=', $from)->where('checking.checking_entry_date <=', $to);
                }
                                        
                        $result_details = $this->db->group_by('checking.checking_id')->get('checking')->result();
                                            
                                    foreach ($result_details as $r_d) {
                                        $extra_time = '';
                        $total_overtime_hours = 0;
                        $total_time = '';
                        $total_normal_duty_hours = 0;
                        $total_duty_hours = 0;
                        $art_no = '';
                        $arts_imgs = '';
                        $color = '';
                        $checked_qntty = '';
                        $total_article_checked = 0;
                        $rejection_quantity = '';
                        $total_rate = '';
                        $total_prod_rate = 0;
                        $total_rejection_quantity = 0;
                        $normal_duty_hours = 0;
                        $co_no = '';
                    $extra_total_qnty_details = $this->db
                    ->select('checking_details.checked_quantity, checking.extra_time, article_master.art_no, colors.color, article_master.credit_score, article_master.img, checking_details.rejection_quantity, article_master.credit_score, customer_order.co_no')
                    ->join('checking', 'checking.checking_id=checking_details.checking_id', 'left')
                    ->join('customer_order', 'customer_order.co_id=checking_details.co_id', 'left')
                    ->join('article_master', 'article_master.am_id=checking_details.am_id', 'left')
                     ->join('colors', 'colors.c_id=checking_details.lc_id', 'left')
                    ->where('checking_details.checking_id', $r_d->checking_id)
                    ->where('checking.e_id', $res->e_id)
                    ->get('checking_details')
                    ->result();
                    
                                            $new_checked_qnty = 0;
                    
                                            foreach($extra_total_qnty_details as $e_t_q_d) {
                                                if($e_t_q_d->img != '') {
                                                $images = '<div style="height: 50px;"><img src="'.base_url('assets/admin_panel/img/article_img/'.$e_t_q_d->img).'" width="60"></div><br/>';
                                                } else {
                                                $images = '';   
                                                }
                                                $extra_time = $e_t_q_d->extra_time;
                                                $total_overtime_hours = $e_t_q_d->extra_time;
                                                $normal_duty_hours = 8.5;
                                                $total_time = (8.5 + $e_t_q_d->extra_time);
                                                $total_normal_duty_hours += 8.5;
                                                $total_duty_hours = (8.5 + $e_t_q_d->extra_time);
                                                $art_no .= "<div style='height: 50px;'>".$e_t_q_d->art_no."</div><br/>";
                                                $arts_imgs .= $images;
                                                $color .= "<div style='height: 50px;'>".$e_t_q_d->color."</div><br/>";
                                                $checked_qntty .= "<div style='height: 50px;'>".$e_t_q_d->checked_quantity."</div><br/>";
                                                $total_article_checked += $e_t_q_d->checked_quantity;
                                                $rejection_quantity .= "<div style='height: 50px;'>".$e_t_q_d->rejection_quantity."</div><br/>";
                                                $total_rejection_quantity += $e_t_q_d->rejection_quantity;
                                                $new_checked_qnty = number_format((($e_t_q_d->checked_quantity / 8.5 + $e_t_q_d->extra_time) * $e_t_q_d->credit_score), 2);
                                                $total_rate .= "<div style='height: 50px;'>".$new_checked_qnty."</div><br/>";
                                                $total_prod_rate += $total_rate;
                                                $co_no .= "<div style='height: 50px;'>".$e_t_q_d->co_no."</div><br/>";
                                                
                                            }
                                            
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['emp_name'] = $res->emp_name;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checking_entry_date'] = date('d-m-Y', strtotime($r_d->checking_entry_date));
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checking_entry_day'] = date("D", strtotime($r_d->checking_entry_date));
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['normal_duty_hours'] = $normal_duty_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_normal_duty_hours'] = $total_normal_duty_hours; 
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['extra_time'] = $extra_time;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_overtime_hours'] = $total_overtime_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_time'] = $total_time;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_duty_hours'] = $total_duty_hours;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['art_no'] = $art_no;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['images'] = $arts_imgs;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['color'] = $color;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['checked_qntty'] = $checked_qntty;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_article_checked'] = $total_article_checked;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['rejection_quantity'] = $rejection_quantity;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_rejection_qnty'] = $total_rejection_quantity;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_rate'] = $total_rate;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['total_prod_rate'] = $total_prod_rate;
                                            $result_array_list[$res->emp_name][$r_d->checking_id]['co_no'] = $co_no;
                                        
                                    }
                                            
        }
        
        // echo '<pre>', print_r($result_array_list), '</pre>'; die();
        
        return $result_array_list;
        
        //  $result_array_list; 

    }

    public function invoice_hsn_summary() {
        
        if($this->input->post()){
            $fromdate = $this->input->post('fromdate');
            $todate = $this->input->post('todate');
        }else{
            $fromdate = '2023-04-01';
            $todate = '2024-03-31';                
        }
        
        $sql = "
                SELECT
                    `article_master`.info,    
                    `article_master`.`remark` AS hsn_code,    
                    `office_invoice`.`office_invoice_number`,
                    `office_invoice`.`ex_rate`,
                    DATE_FORMAT(
                        office_invoice.office_invoice_date,
                        '%d-%m-%Y'
                    ) AS office_invoice_date,
                    SUM(`office_invoice_detail`.`quantity`) as sum_quantity,
                    `office_invoice_detail`.`rate_inr`,
                    `office_invoice_detail`.`rate_foreign`,
                    `office_invoice_detail`.`quantity`,
                    SUM(`office_invoice_detail`.`amount_inr`) as sum_amount_inr
                FROM
                    `office_invoice_detail`
                LEFT JOIN `office_invoice` ON `office_invoice`.`office_invoice_id` = `office_invoice_detail`.`office_invoice_id`
                LEFT JOIN `customer_order` ON `customer_order`.`co_id` = `office_invoice_detail`.`co_id`
                LEFT JOIN `article_master` ON `article_master`.`am_id` = `office_invoice_detail`.`am_id`
                LEFT JOIN `item_master` ON `item_master`.`im_id` = `article_master`.`carton_id`
                LEFT JOIN `item_groups` ON `item_groups`.`ig_id` = `item_master`.`ig_id`
                LEFT JOIN `colors` ON `colors`.`c_id` = `office_invoice_detail`.`lc_id`
                LEFT JOIN `acc_master` `ac1` ON
                    `ac1`.`am_id` = `office_invoice`.`am_id`
                LEFT JOIN `acc_master_declaration` ON `acc_master_declaration`.`am_id` = `office_invoice`.`am_id`
                LEFT JOIN `acc_master` `ac2` ON
                    `ac2`.`am_id` = `office_invoice`.`am_id_other`
                LEFT JOIN `countries` ON `countries`.`c_id` = `ac1`.`c_id`
                LEFT JOIN `currencies` ON `currencies`.`cur_id` = `office_invoice`.`cur_id`
                WHERE office_invoice.office_invoice_date BETWEEN '".$fromdate."' AND '".$todate."'
                GROUP BY remark, `office_invoice`.`office_invoice_number`
                ORDER BY
                    remark,
                    `office_invoice`.`office_invoice_number` 
                    ";
        $data['invoice_hsn_detailed'] = $this->db->query($sql)->result(); 
        
        
        return array('page'=>'reports/hsn_summary_invoice', 'data'=>$data);
        
    }

    // public function article_master_report($mon,$pos) {

    //     $sql="SELECT employees.name,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    // CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    // salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
    //     FROM salary
    //     INNER JOIN(employees)
    //     ON(salary.EMPCODE=employees.e_id)
    //     WHERE salary.MON LIKE '".$mon."%' AND employees.working_place='".$pos."'
    //     ORDER BY employees.e_code";

    //     $res = $this->db->query($sql)->result();
    //     // echo $this->db->last_query();die;
    //     return $res;

    // }
    
}//end ctrl
?>