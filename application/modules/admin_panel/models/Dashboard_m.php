<?php

class Dashboard_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET sql_mode = ''");
        $this->db->query('SET SQL_BIG_SELECTS=1');
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
    
    public function report_order_status_details_brkup_dashboard() {
        $buyer_id  = $this->input->post('buyer_id');
        
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
                        customer_order.acc_master_id IN($buyer_id)
                    GROUP BY
                        co_id
                ) AS co_details
            ";

            $cos = $this->db->query($query)->result()[0]->cos;
        
        //actual db table column names
        $column_orderable = array(
            0 => 'buyer_reference_no',
            1 => 'co_date',
            2 => 'co_delivery_date'
        );
        // Set searchable column fields
        $column_search = array('buyer_reference_no', 'co_date', 'co_delivery_date');
        // $column_search = array('co_no');

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $column_orderable[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = $this->input->post('search')['value'];

        $rs = $this->db->get_where('customer_order', array('acc_master_id' => $buyer_id))->result();
        $totalData = count($rs);
        $totalFiltered = $totalData;

        //if not searching for anything
        if(empty($search)) {
            
            $queryy1111 = "
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
                                    `customer_order`.`shipment_date2`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    IFNULL(
                                SUM(
                                    `customer_order_dtl`.`co_quantity`
                                ),
                                0
                            ) AS co_quantity,
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
                                    `customer_order`.co_id IN ($cos)
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
                $order $dir
            ";

            $rs = $this->db->query($queryy1111)->result();
            
            
            
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

            $queryy1111 = "
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
                                    `customer_order`.`shipment_date2`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    IFNULL(
                                SUM(
                                    `customer_order_dtl`.`co_quantity`
                                ),
                                0
                            ) AS co_quantity,
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
                                    `customer_order`.co_id IN ($cos)
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
                $order $dir
            ";

            $rs = $this->db->query($queryy1111)->result();


            $totalFiltered = count($rs);

            $queryy1111 = "
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
                                    `customer_order`.`shipment_date2`,
                                    `article_master`.`art_no`,
                                    `colors`.`color`,
                                    IFNULL(
                                SUM(
                                    `customer_order_dtl`.`co_quantity`
                                ),
                                0
                            ) AS co_quantity,
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
                                    `customer_order`.co_id IN ($cos)
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
                $order $dir
            ";

            $rs = $this->db->query($queryy1111)->result();

            $this->db->flush_cache();
        }

        $data = array();

        // echo '<pre>', print_r($rs), '</pre>'; die;
        
        foreach ($rs as $val) {
            
            $query = "
                    SELECT
                        co_id
                    FROM
                        `packing_shipment_detail`
                    WHERE
                        packing_shipment_detail.co_id = $val->co_id AND packing_shipment_detail.status = 1
            ";

            $pack_shipment_num = $this->db->query($query)->num_rows();
            
            if($pack_shipment_num > 0) {
                
                $query = "
                    SELECT
                        SUM(packing_shipment_detail.article_quantity) as article_quantity
                    FROM
                        `packing_shipment_detail`
                    LEFT JOIN packing_shipment ON packing_shipment.packing_shipment_id = packing_shipment_detail.packing_shipment_id
                    WHERE
                        packing_shipment_detail.co_id = $val->co_id AND packing_shipment_detail.status = 1
            ";

            $qtty = $this->db->query($query)->row()->article_quantity;
                
            } else {
                
            $qtty = 0;
                
            }
        if (($val->co_quantity - $qtty) <= 0)
        {
            continue;
        }
        
        $query1 = "
                    SELECT
                        SUM(checked_quantity) as checked_quantity
                    FROM
                        `checking_details`
                    WHERE
                        checking_details.co_id = $val->co_id AND checking_details.status = 1
            ";

            $checking_shipment_row_details = $this->db->query($query1)->row();
        
            if(count($checking_shipment_row_details) > 0) {
                
                $checked_quantity = $checking_shipment_row_details->checked_quantity;
                $chek_blnc = $val->co_quantity - $checking_shipment_row_details->checked_quantity;
                
            } else {
                
               $checked_quantity = 0;
               $chek_blnc = $val->co_quantity;
                
            }
            
            $cust_details = $this->db
                        ->select('buyer_reference_no, department')
                        ->join('user_details', 'user_details.user_id = customer_order.user_id', 'left')
                        ->join('departments', 'departments.d_id = user_details.user_dept', 'left')
                        ->from('customer_order')
                        ->where('co_id', $val->co_id)
                        ->get()
                        ->row();
                        
                        
                        if($val->shipment_date2 == '0000-00-00') {  $shipment_date22 = '';  } else {  $shipment_date22 = date("d-m-Y", strtotime($val->shipment_date2));  }
                        

            $nestedData['name'] = $val->name .'<br/>[' .substr($cust_details->department, -3). ']' ;
            $nestedData['buyer_reference_no'] = $val->buyer_reference_no .' <br/> [' .substr($cust_details->department, -3). ']';
            $nestedData['co_date'] = date("d-m-Y", strtotime($val->co_date));
            $nestedData['co_delivery_date'] = date("d-m-Y", strtotime($val->co_delivery_date));
            $nestedData['shipment_date'] = date("d-m-Y", strtotime($val->shipment_date));
            $nestedData['shipment_date2'] = $shipment_date22;
            $nestedData['co_quantity'] = round($val->co_quantity);
            $nestedData['cutting_issued_qnty'] = round($val->cutting_issued_qnty);
            $nestedData['cutting_received_qnty'] = round($val->cutting_received_qnty);
            
            if(($val->cutting_issued_qnty - $val->cutting_received_qnty) <= 0) {
            $nestedData['blnc_qntyy'] = round($val->cutting_issued_qnty - $val->cutting_received_qnty);    
            } else {
            $nestedData['blnc_qntyy'] = '<a href="'. base_url('admin/ajax-fetch-customer-details-brkup-report/'.$val->co_id) .'" style="color: blue; text-decoration: underline;" target="_blank"><b>' . round($val->cutting_issued_qnty - $val->cutting_received_qnty) . '</b></a>';    
            }
            
            $nestedData['jobber_issue_qnty'] = round($val->jobber_issue_qnty);
            $nestedData['jobber_receive_qnty'] = round($val->jobber_receive_qnty);
            $nestedData['fab_qntyy'] = round($val->jobber_issue_qnty - $val->jobber_receive_qnty);
            $nestedData['checked_quantity'] = round($checked_quantity);
            $nestedData['chek_blnc'] = round($chek_blnc);
            $nestedData['qtty'] = round($qtty);
            $nestedData['qnty_remn'] = round($val->co_quantity - $qtty);
            $nestedData['qnty_stck'] = round($val->jobber_receive_qnty - $qtty);
            
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

    public function dashboard() {

        $data = [];    
        // fetch department-wisemodule permission
            $session_user_id = $this->session->user_id;
            # if id is returned then filter else show all
            $module_permission_costing = $this->_dept_wise_module_permission(1, $session_user_id); #1 = costing module_id

            $uvp = $this->_user_wise_view_permission(2, $session_user_id); #2 = costing menu_id
            
            $data['buyers'] = $this->db->get_where('acc_master', array('status' => 1))->result();

            if($uvp == 'show'){

            if($module_permission_costing == 'show'){

              $sql="SELECT
    f.*
        FROM
            (
                (
                    (
                    SELECT
                        article_master.am_id AS art_id,
                        article_master.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 1 as show_name, 'costings' as show_table
                    FROM
                        article_costing
                    INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing.status = 1 AND article_master.status = 1
                    ORDER BY article_costing.modify_date desc

                )
            UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_master.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 1 as show_name, 'costing charges' as show_table
                FROM
                    article_costing_charges
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_charges.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing_charges.status = 1 AND article_master.status = 1
                    GROUP BY article_costing_charges.ac_id
                    ORDER BY article_costing_charges.modify_date desc
            )UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_master.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 1 as show_name, 'costing details' as show_table
                FROM
                    article_costing_details
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_details.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing_details.status = 1 AND article_master.status = 1
                    GROUP BY article_costing_details.ac_id
                    ORDER BY article_costing_details.modify_date desc
            )UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_master.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 1 as show_name, 'costing measurements' as show_table
                FROM
                    article_costing_measurements
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_measurements.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing_measurements.user_id)
                    WHERE
                    article_costing_measurements.status = 1 AND article_master.status = 1
                    GROUP BY article_costing_measurements.ac_id
                    ORDER BY article_costing_measurements.modify_date desc
            )
                ) AS f
            )
            GROUP BY ac_id
        ORDER BY
            modify_date desc
            LIMIT 5";

        $data['lastest_costings'] = $this->db->query($sql)->result();
        // // echo $this->db->last_query();die;

        //         $data['lastest_costings'] = $this->db
        //         ->select('article_master.am_id, article_master.modify_date, article_master.art_no, article_master.status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 1 as show_name')
        //         ->join('article_master', 'article_master.am_id = article_costing.am_id', 'left')
        //         ->join('users', 'article_costing.user_id = users.user_id', 'left')
        //         ->order_by('article_master.modify_date', 'desc')
        //         ->limit(5)
        //         ->get_where('article_costing', array('article_costing.status' => 1, 'article_master.status' => 1))
        //         ->result();
            } else {
                #module_permission contains the dept id now

                $sql="SELECT
    f.*
        FROM
            (
                (
                    (
                    SELECT
                        article_master.am_id AS art_id,
                        article_master.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 0 as show_name, 'costings' as show_table
                    FROM
                        article_costing
                    INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing.status = 1 AND article_master.status = 1 AND article_costing.user_id = '".$session_user_id."'
                    ORDER BY article_costing.modify_date desc

                )
            UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_costing_charges.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 0 as show_name, 'costing charges' as show_table
                FROM
                    article_costing_charges
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_charges.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing.status = 1 AND article_master.status = 1 AND article_costing_charges.user_id = '".$session_user_id."'
                    GROUP BY article_costing_charges.ac_id
                    ORDER BY article_costing_charges.modify_date desc
            )UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_costing_details.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 0 as show_name, 'costing details' as show_table
                FROM
                    article_costing_details
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_details.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing.user_id)
                    WHERE
                    article_costing.status = 1 AND article_master.status = 1 AND article_costing_details.user_id = '".$session_user_id."'
                    GROUP BY article_costing_details.ac_id
                    ORDER BY article_costing_details.modify_date desc
            )UNION ALL
                (
                SELECT
                        article_master.am_id AS art_id,
                        article_costing_measurements.modify_date,
                        article_master.art_no,
                        article_master.status AS art_status,article_costing.am_id, article_costing.ac_id, article_costing.user_id, article_costing.status, users.username, 0 as show_name, 'costing measurements' as show_table
                FROM
                    article_costing_measurements
                    INNER JOIN(article_costing)
                    ON(article_costing.ac_id = article_costing_measurements.ac_id)
                INNER JOIN(article_master)
                    ON(article_master.am_id = article_costing.am_id)
                    INNER JOIN(users)
                    ON(users.user_id = article_costing_measurements.user_id)
                    WHERE
                    article_costing.status = 1 AND article_master.status = 1 AND article_costing_measurements.user_id = '".$session_user_id."'
                    GROUP BY article_costing_measurements.ac_id
                    ORDER BY article_costing_measurements.modify_date desc
            )
                ) AS f
            )
            GROUP BY ac_id
        ORDER BY
            modify_date desc
            LIMIT 5";

        $data['lastest_costings'] = $this->db->query($sql)->result();

            }

            } else {

              $data['lastest_costings'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_order = $this->_dept_wise_module_permission(15, $session_user_id); #15 = customer order module_id

            $show_order = $this->_user_wise_view_permission(3, $session_user_id); #3 = customer order menu_id

            if($show_order == 'show'){

                if($module_permission_order == 'show'){
    
                  $data['lastest_orders'] = $this->db
                    ->select('customer_order.co_id, customer_order.modify_date, customer_order.co_no, customer_order.status, customer_order_dtl.user_id, customer_order_dtl.status, users.username, 1 as show_name')
                    ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                    ->join('users', 'customer_order_dtl.user_id = users.user_id', 'left')
                    ->group_by('co_no')
                    ->order_by('customer_order_dtl.modify_date', 'desc')
                    ->limit(5)
                    ->get_where('customer_order', array('customer_order.status' => 1, 'customer_order_dtl.status' => 1))
                    ->result();
                } else {
                    
                    #module_permission contains the dept id now
    
                    $data['lastest_orders'] = $this->db
                        ->select('customer_order.co_id, customer_order.modify_date, customer_order.co_no, customer_order.status, customer_order_dtl.user_id, customer_order_dtl.status, users.username, 0 as show_name')
                        ->join('customer_order_dtl', 'customer_order_dtl.co_id = customer_order.co_id', 'left')
                        ->join('users', 'customer_order_dtl.user_id = users.user_id', 'left')
                        ->group_by('co_no')
                        ->order_by('customer_order_dtl.modify_date', 'desc')
                        ->limit(5)
                        ->get_where('customer_order', array('customer_order.status' => 1, 'customer_order_dtl.status' => 1, 'customer_order.user_id' => $session_user_id))
                        ->result();
                        
                    // echo $this->db->last_query(); die;    
    
                }

            } else {

              $data['lastest_orders'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_cutting = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

            $show_cutting = $this->_user_wise_view_permission(4, $session_user_id); #4 cutting menu_id

            if($show_cutting == 'show'){

            if($module_permission_order == 'show'){

             $data['lastest_cutting_issues'] = $this->db
                ->select('customer_order.co_id, customer_order.co_no, customer_order.status,cutting_issue_challan_details.cut_id, cutting_issue_challan_details.co_id, cutting_issue_challan_details.user_id, cutting_issue_challan_details.status, cutting_issue_challan_details.modify_date, users.username, 1 as show_name')
                ->join('customer_order', 'cutting_issue_challan_details.co_id = customer_order.co_id', 'left')
                ->join('users', 'cutting_issue_challan_details.user_id = users.user_id', 'left')
                ->group_by('cutting_issue_challan_details.co_id')
                ->order_by('cutting_issue_challan_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('cutting_issue_challan_details', array('customer_order.status' => 1, 'cutting_issue_challan_details.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_cutting_issues'] = $this->db
                ->select('customer_order.co_id, customer_order.co_no, customer_order.status,cutting_issue_challan_details.cut_id, cutting_issue_challan_details.co_id, cutting_issue_challan_details.user_id, cutting_issue_challan_details.status, cutting_issue_challan_details.modify_date, users.username, 0 as show_name')
                ->join('customer_order', 'cutting_issue_challan_details.co_id = customer_order.co_id', 'left')
                ->join('users', 'cutting_issue_challan_details.user_id = users.user_id', 'left')
                ->group_by('cutting_issue_challan_details.co_id')
                ->order_by('cutting_issue_challan_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('cutting_issue_challan_details', array('customer_order.status' => 1, 'cutting_issue_challan_details.status' => 1, 'cutting_issue_challan_details.user_id' => $session_user_id))
                ->result();

            }

            } else {

              $data['lastest_cutting_issues'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_cutting_receive = $this->_dept_wise_module_permission(2, $session_user_id); #2 = cutting module_id

            $show_cutting_receive = $this->_user_wise_view_permission(5, $session_user_id); #4 cutting receive menu_id 

            if($show_cutting_receive == 'show'){

            if($module_permission_cutting_receive == 'show'){

              $data['lastest_cutting_receive'] = $this->db
                ->select('customer_order.co_id, customer_order.co_no, customer_order.status,cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.user_id, cutting_received_challan_detail.status, cutting_received_challan_detail.modify_date, users.username, 1 as show_name')
                ->join('customer_order', 'cutting_received_challan_detail.co_id = customer_order.co_id', 'left')
                ->join('users', 'cutting_received_challan_detail.user_id = users.user_id', 'left')
                ->group_by('cutting_received_challan_detail.co_id')
                ->order_by('cutting_received_challan_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('cutting_received_challan_detail', array('customer_order.status' => 1, 'cutting_received_challan_detail.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_cutting_receive'] = $this->db
                ->select('customer_order.co_id, customer_order.co_no, customer_order.status,cutting_received_challan_detail.cut_rcv_id, cutting_received_challan_detail.co_id, cutting_received_challan_detail.user_id, cutting_received_challan_detail.status, cutting_received_challan_detail.modify_date, users.username, 0 as show_name')
                ->join('customer_order', 'cutting_received_challan_detail.co_id = customer_order.co_id', 'left')
                ->join('users', 'cutting_received_challan_detail.user_id = users.user_id', 'left')
                ->group_by('cutting_received_challan_detail.co_id')
                ->order_by('cutting_received_challan_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('cutting_received_challan_detail', array('customer_order.status' => 1, 'cutting_received_challan_detail.status' => 1, 'cutting_received_challan_detail.user_id' => $session_user_id))
                ->result();

            }

            } else {

              $data['lastest_cutting_receive'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_skiving_receive = $this->_dept_wise_module_permission(3, $session_user_id); #3 = skiving module_id

            $show_skiving_receive = $this->_user_wise_view_permission(8, $session_user_id); #8 skiving receive menu_id 

            if( $show_skiving_receive == 'show'){

            if($module_permission_skiving_receive == 'show'){

              $data['lastest_skiving_receive'] = $this->db
                ->select('skiving_receive_challan.skiving_receive_id, skiving_receive_challan.skiving_receive_challan_number, skiving_receive_challan_details.co_id, skiving_receive_challan_details.user_id, skiving_receive_challan_details.status, skiving_receive_challan_details.modified_date, users.username, 1 as show_name')
                ->join('skiving_receive_challan', 'skiving_receive_challan_details.skiving_receive_id = skiving_receive_challan.skiving_receive_id', 'left')
                ->join('users', 'skiving_receive_challan_details.user_id = users.user_id', 'left')
                ->group_by('skiving_receive_challan_details.skiving_receive_id')
                ->order_by('skiving_receive_challan_details.modified_date', 'desc')
                ->limit(5)
                ->get_where('skiving_receive_challan_details', array('skiving_receive_challan.status' => 1, 'skiving_receive_challan_details.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_skiving_receive'] = $this->db
                ->select('skiving_receive_challan.skiving_receive_id, skiving_receive_challan.skiving_receive_challan_number, skiving_receive_challan_details.co_id, skiving_receive_challan_details.user_id, skiving_receive_challan_details.status, skiving_receive_challan_details.modified_date, users.username, 0 as show_name')
                ->join('skiving_receive_challan', 'skiving_receive_challan_details.skiving_receive_id = skiving_receive_challan.skiving_receive_id', 'left')
                ->join('users', 'skiving_receive_challan_details.user_id = users.user_id', 'left')
                ->group_by('skiving_receive_challan_details.skiving_receive_id')
                ->order_by('skiving_receive_challan_details.modified_date', 'desc')
                ->limit(5)
                ->get_where('skiving_receive_challan_details', array('skiving_receive_challan.status' => 1, 'skiving_receive_challan_details.status' => 1, 'skiving_receive_challan_details.user_id' => $session_user_id))
                ->result();

            }

            } else {

              $data['lastest_skiving_receive'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_jobber = $this->_dept_wise_module_permission(4, $session_user_id); #3 = jobber module_id

            $show_jobber = $this->_user_wise_view_permission(9, $session_user_id); #8 jobber issue menu_id 

            if($show_jobber == 'show'){

            if($module_permission_jobber == 'show'){

              $data['lastest_jobber_issues'] = $this->db
                ->select('jobber_issue.jobber_issue_id, jobber_issue.jobber_challan_number,                                jobber_issue_details.modified_date, jobber_issue_details.user_id, jobber_issue_details.status, users.username, 1 as show_name')
                ->join('jobber_issue', 'jobber_issue_details.jobber_issue_id = jobber_issue.jobber_issue_id', 'left')
                ->join('users', 'jobber_issue_details.user_id = users.user_id', 'left')
                ->group_by('jobber_issue_details.jobber_issue_id')
                ->order_by('jobber_issue_details.modified_date', 'desc')
                ->limit(5)
                ->get_where('jobber_issue_details', array('jobber_issue.status' => 1, 'jobber_issue_details.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_jobber_issues'] = $this->db
                ->select('jobber_issue.jobber_issue_id, jobber_issue.jobber_challan_number,                                jobber_issue_details.modified_date, jobber_issue_details.user_id, jobber_issue_details.status, users.username, 0 as show_name')
                ->join('jobber_issue', 'jobber_issue_details.jobber_issue_id = jobber_issue.jobber_issue_id', 'left')
                ->join('users', 'jobber_issue_details.user_id = users.user_id', 'left')
                ->group_by('jobber_issue_details.jobber_issue_id')
                ->order_by('jobber_issue_details.modified_date', 'desc')
                ->limit(5)
                ->get_where('jobber_issue_details', array('jobber_issue.status' => 1, 'jobber_issue_details.status' => 1, 'jobber_issue_details.user_id' => $session_user_id))
                ->result();

            }

            } else {

              $data['lastest_jobber_issues'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_jobber_receive = $this->_dept_wise_module_permission(4, $session_user_id); #4 = jobber module_id

            $show_jobber_receive = $this->_user_wise_view_permission(10, $session_user_id); #10 jobber issue menu_id 

            if($show_jobber_receive == 'show'){
 
            if($module_permission_jobber_receive == 'show'){

              $data['lastest_jobber_receive'] = $this->db
                ->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number,                                jobber_challan_receipt_details.modify_date, jobber_challan_receipt_details.user_id, jobber_challan_receipt_details.status, users.username, 1 as show_name')
                ->join('jobber_challan_receipt', 'jobber_challan_receipt_details.jobber_challan_receipt_id = jobber_challan_receipt.jobber_challan_receipt_id', 'left')
                ->join('users', 'jobber_challan_receipt_details.user_id = users.user_id', 'left')
                ->group_by('jobber_challan_receipt_details.jobber_challan_receipt_id')
                ->order_by('jobber_challan_receipt_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt.status' => 1, 'jobber_challan_receipt_details.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_jobber_receive'] = $this->db
                ->select('jobber_challan_receipt.jobber_challan_receipt_id, jobber_challan_receipt.jobber_receipt_challan_number,                                jobber_challan_receipt_details.modify_date, jobber_challan_receipt_details.user_id, jobber_challan_receipt_details.status, users.username, 0 as show_name')
                ->join('jobber_challan_receipt', 'jobber_challan_receipt_details.jobber_challan_receipt_id = jobber_challan_receipt.jobber_challan_receipt_id', 'left')
                ->join('users', 'jobber_challan_receipt_details.user_id = users.user_id', 'left')
                ->group_by('jobber_challan_receipt_details.jobber_challan_receipt_id')
                ->order_by('jobber_challan_receipt_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('jobber_challan_receipt_details', array('jobber_challan_receipt.status' => 1, 'jobber_challan_receipt_details.status' => 1, 'jobber_challan_receipt_details.user_id' => $session_user_id))
                ->result();
            }

            } else {

              $data['lastest_jobber_receive'] = '';

            }

            # if id is returned then filter else show all
            $module_permission_shipment = $this->_dept_wise_module_permission(7, $session_user_id); #7 = packing-shipment module_id


            $show_shipment = $this->_user_wise_view_permission(15, $session_user_id); #15 = Packing/Shipment menu_id 

            if($show_shipment == 'show'){

            if($session_user_id == 1){

              $data['lastest_shipment'] = $this->db
                ->select('packing_shipment.packing_shipment_id, packing_shipment.package_name,                                packing_shipment_detail.modify_date, packing_shipment_detail.user_id, packing_shipment_detail.status, users.username, 1 as show_name')
                ->join('packing_shipment', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left')
                ->join('users', 'packing_shipment.user_id = users.user_id', 'left')
                ->group_by('packing_shipment.packing_shipment_id')
                ->order_by('packing_shipment_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('packing_shipment_detail', array('packing_shipment.status' => 1, 'packing_shipment_detail.status' => 1))
                ->result();
            } else {
                #module_permission contains the dept id now
                $data['lastest_shipment'] = $this->db
                ->select('packing_shipment.packing_shipment_id, packing_shipment.package_name,                                packing_shipment_detail.modify_date, packing_shipment_detail.user_id, packing_shipment_detail.status, users.username, 0 as show_name')
                ->join('packing_shipment', 'packing_shipment_detail.packing_shipment_id = packing_shipment.packing_shipment_id', 'left')
                ->join('users', 'packing_shipment.user_id = users.user_id', 'left')
                ->group_by('packing_shipment_detail.packing_shipment_id')
                ->order_by('packing_shipment_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('packing_shipment_detail', array('packing_shipment.status' => 1, 'packing_shipment_detail.status' => 1, 'packing_shipment.user_id' => $session_user_id))
                ->result();  
            }

            } else {

              $data['lastest_shipment'] = '';

            }

            $show_purchase_order = $this->_user_wise_view_permission(16, $session_user_id); #16 = Purchase Order menu_id 

            if($show_purchase_order == 'show'){

            if($session_user_id == 1){

                $data['latest_purchase_order'] = $this->db
                ->select('purchase_order.po_id, purchase_order.po_number,                                purchase_order_details.modify_date, purchase_order_details.user_id, purchase_order_details.status, users.username, 1 as show_name')
                ->join('purchase_order', 'purchase_order_details.po_id = purchase_order.po_id', 'left')
                ->join('users', 'purchase_order.user_id = users.user_id', 'left')
                ->group_by('purchase_order.po_id')
                ->order_by('purchase_order_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('purchase_order_details', array('purchase_order.status' => 1, 'purchase_order_details.status' => 1))
                ->result();

            } else {
                #module_permission contains the dept id now

                $data['latest_purchase_order'] = $this->db
                ->select('purchase_order.po_id, purchase_order.po_number,                                purchase_order_details.modify_date, purchase_order_details.user_id, purchase_order_details.status, users.username, 1 as show_name')
                ->join('purchase_order', 'purchase_order_details.po_id = purchase_order.po_id', 'left')
                ->join('users', 'purchase_order.user_id = users.user_id', 'left')
                ->group_by('purchase_order.po_id')
                ->order_by('purchase_order_details.modify_date', 'desc')
                ->limit(5)
                ->get_where('purchase_order_details', array('purchase_order.status' => 1, 'purchase_order_details.status' => 1, 'purchase_order.user_id' => $session_user_id))
                ->result();
  
            }

            } else {

              $data['latest_purchase_order'] = '';

            }

            $show_purchase_order_receive = $this->_user_wise_view_permission(18, $session_user_id); #16 = Purchase Order Receive menu_id 

            if($show_purchase_order_receive == 'show'){

            if($session_user_id == 1){

                $data['latest_purchase_order_receive'] = $this->db
                ->select('purchase_order_receive.purchase_order_receive_id, purchase_order_receive.purchase_order_receive_bill_no,                                purchase_order_receive_detail.modified_date, purchase_order_receive_detail.user_id, purchase_order_receive_detail.status, users.username, 1 as show_name')
                ->join('purchase_order_receive', 'purchase_order_receive_detail.purchase_order_receive_id = purchase_order_receive.purchase_order_receive_id', 'left')
                ->join('users', 'purchase_order_receive.user_id = users.user_id', 'left')
                ->group_by('purchase_order_receive.purchase_order_receive_id')
                ->order_by('purchase_order_receive_detail.modified_date', 'desc')
                ->limit(5)
                ->get_where('purchase_order_receive_detail', array('purchase_order_receive.status' => 1, 'purchase_order_receive_detail.status' => 1))
                ->result();

            } else {
                #module_permission contains the dept id now

                $data['latest_purchase_order_receive'] = $this->db
                ->select('purchase_order_receive.purchase_order_receive_id, purchase_order_receive.purchase_order_receive_bill_no,                                purchase_order_receive_detail.modified_date, purchase_order_receive_detail.user_id, purchase_order_receive_detail.status, users.username, 1 as show_name')
                ->join('purchase_order_receive', 'purchase_order_receive_detail.purchase_order_receive_id = purchase_order_receive.purchase_order_receive_id', 'left')
                ->join('users', 'purchase_order_receive.user_id = users.user_id', 'left')
                ->group_by('purchase_order_receive.purchase_order_receive_id')
                ->order_by('purchase_order_receive_detail.modified_date', 'desc')
                ->limit(5)
                ->get_where('purchase_order_receive_detail', array('purchase_order_receive.status' => 1, 'purchase_order_receive_detail.status' => 1, 'purchase_order_receive.user_id' => $session_user_id))
                ->result();
  
            }

            } else {

              $data['latest_purchase_order_receive'] = '';

            }

            $show_material_issue_list = $this->_user_wise_view_permission(20, $session_user_id); #20 = Material Issue List menu_id 

            if($show_material_issue_list == 'show'){

            if($session_user_id == 1){

                $data['latest_material_issue_list'] = $this->db
                ->select('material_issue.material_issue_id, material_issue.material_issue_slip_number, material_issue_detail.modify_date, material_issue_detail.user_id, material_issue_detail.status, users.username, 1 as show_name')
                ->join('material_issue', 'material_issue_detail.material_issue_id = material_issue.material_issue_id', 'left')
                ->join('users', 'material_issue.user_id = users.user_id', 'left')
                ->group_by('material_issue.material_issue_id')
                ->order_by('material_issue_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('material_issue_detail', array('material_issue.status' => 1))
                ->result();

            } else {
                #module_permission contains the dept id now

                $data['latest_material_issue_list'] = $this->db
                ->select('material_issue.material_issue_id, material_issue.material_issue_slip_number, material_issue_detail.modify_date, material_issue_detail.user_id, material_issue_detail.status, users.username, 1 as show_name')
                ->join('material_issue', 'material_issue_detail.material_issue_id = material_issue.material_issue_id', 'left')
                ->join('users', 'material_issue.user_id = users.user_id', 'left')
                ->group_by('material_issue.material_issue_id')
                ->order_by('material_issue_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('material_issue_detail', array('material_issue.status' => 1, 'material_issue.user_id' => $session_user_id))
                ->result();

            }

            } else {

              $data['latest_material_issue_list'] = '';

            }

            $show_jobber_bill_list = $this->_user_wise_view_permission(11, $session_user_id); #20 = Material Issue List menu_id 

            if($show_jobber_bill_list == 'show'){

            if($session_user_id == 1){

                $data['latest_jobber_bill_list'] = $this->db
                ->select('jobber_bill.jobber_bill_id, jobber_bill.jobber_bill_number, jobber_bill_detail.modify_date, jobber_bill_detail.user_id, jobber_bill_detail.status, users.username, 1 as show_name')
                ->join('jobber_bill', 'jobber_bill_detail.jobber_bill_id = jobber_bill.jobber_bill_id', 'left')
                ->join('users', 'jobber_bill.user_id = users.user_id', 'left')
                ->group_by('jobber_bill.jobber_bill_id')
                ->order_by('jobber_bill_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('jobber_bill_detail', array('jobber_bill.status' => 1, 'jobber_bill_detail.status' => 1))
                ->result();

            } else {
                #module_permission contains the dept id now

                $data['latest_jobber_bill_list'] = $this->db
                ->select('jobber_bill.jobber_bill_id, jobber_bill.jobber_bill_number,                                jobber_bill_detail.modify_date, jobber_bill_detail.user_id, jobber_bill_detail.status, users.username, 1 as show_name')
                ->join('jobber_bill', 'jobber_bill_detail.jobber_bill_id = jobber_bill.jobber_bill_id', 'left')
                ->join('users', 'jobber_bill.user_id = users.user_id', 'left')
                ->group_by('jobber_bill.jobber_bill_id')
                ->order_by('jobber_bill_detail.modify_date', 'desc')
                ->limit(5)
                ->get_where('jobber_bill_detail', array('jobber_bill.status' => 1, 'jobber_bill_detail.status' => 1, 'jobber_bill.user_id' => $session_user_id))
                ->result();
                
            }

            } else {

              $data['latest_jobber_bill_list'] = '';

            } 

            if($module_permission_order == 'show'){

            $data['co_ids'] = $this->db->order_by('co_no')->get_where('customer_order', array('status' => 1))->result();  
        }else{
            $data['co_ids'] = $this->db->join('user_details','user_details.user_id = customer_order.user_id','left')->order_by('co_no')->get_where('customer_order', array('status' => 1, 'user_details.user_dept' => $module_permission_order))->result();
        }             
                        
        return array('page' => 'dashboard_v', 'data' => $data);
    }
    
     public function ajax_fetch_customer_details_brkup_report($co_id) {
         
                $id_array = [];
         
                $am_id = $this->db->get_where('customer_order', array('co_id' => $co_id))->row()->acc_master_id;
         
                $data_array = array();
                $order_query = "SELECT
                `customer_order_dtl`.*,
                `article_costing`.`combination_or_not`,
                `item_dtl`.`im_id`,
                `item_dtl`.`id_id`,
                `item_master`.`ig_id`,
                `colors`.`c_id`,
                `item_master`.`item`,
                `colors`.`color`
                FROM
                `customer_order_dtl`
                LEFT JOIN `article_costing` ON `article_costing`.`am_id` = `customer_order_dtl`.`am_id`
                LEFT JOIN `article_costing_details` ON `article_costing_details`.`ac_id` = `article_costing`.`ac_id`
                LEFT JOIN `item_dtl` ON `item_dtl`.`id_id` = `article_costing_details`.`id_id`
                LEFT JOIN `item_master` ON `item_master`.`im_id` = `item_dtl`.`im_id`
                LEFT JOIN `colors` ON `colors`.`c_id` = `customer_order_dtl`.`lc_id`
                WHERE
                `co_id` = $co_id AND `item_master`.`ig_id` = 1
                GROUP BY
                `item_dtl`.`id_id`
                ORDER BY
                `item_master`.`item`";
                $data['result'] = $this->db->query($order_query)->result(); 
                
                // foreach($order_colour_res as $a_c_r) {
                //   array_push($id_array, $a_c_r->id_id); 
                // }
                
                // $id_arrat_text_details = implode(",", array_unique($id_array));
            
            $data['co_id_order'] = $co_id;
            
            $data['segment'] = 'supplier_wise_item_position_brkup_details_second';
            
             return array('page' =>'reports/common_print_v', 'data' => $data);
         
     }


} // /.Dashboard_m model