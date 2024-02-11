<?php

class Report extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/report_item'));
    }

    public function check_permission($auth_usertype = array()) {
        //if not logged-in
        if($this->user_type == null) {
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('admin'));
        }

        //if no special permission required (should be logged-in only)
        if(count($auth_usertype) == 0) {
            return true;
        }

        if(in_array($this->user_type, $auth_usertype)) {
            return true;
        } else {
            $this->session->set_flashdata('title', 'Prohibited!');
            $this->session->set_flashdata('msg', 'You do not have permission to access that page, kindly contact Administrator.');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function report_list($uri) {
      if($this->check_permission(array(1,2)) == true) {
          $this->load->model('Report_order_status_m');
          $data = $this->Report_order_status_m->report_list($uri);
          $this->load->view($data['page'], $data['data']);
      }
    }

    public function report_inking_summary() {
      if($this->check_permission(array(1,2)) == true) {
          $this->load->model('Report_order_status_m');
          $data = $this->Report_order_status_m->report_inking_summary();
          $this->load->view($data['page'], $data['data']);
      }
    }

    public function most_ordered_article() {
      if($this->check_permission(array(1,2)) == true) {
          $this->load->model('Report_order_status_m');
          $data = $this->Report_order_status_m->most_ordered_article();
          $this->load->view($data['page'], $data['data']);
      }
    }
	
	public function report_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_item_m');
            $data = $this->Report_item_m->report_item();
            $this->load->view($data['page'], $data['data']);
        }
    }
	
	public function ajax_item_detail_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_item_m');
            $data = $this->Report_item_m->ajax_item_detail_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
    public function report_order_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_order_status();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function report_shipment_buyerwise_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_shipment_buyerwise_status();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function report_buyerwise_shipment_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_buyerwise_shipment_details();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function report_shipment_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_shipment_status();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function report_order_status_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_order_status_details();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function report_buyer_wise_article(){
      if($this->check_permission(array(1,2)) == true) {
          $this->load->model('Report_order_status_m');
          $data = $this->Report_order_status_m->report_buyer_wise_article();
          $this->load->view($data['page'], $data['data']);
      }
    }
    
    public function report_material_status_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_material_status_details();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function material_issue_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->material_issue_status();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function report_shipment_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_shipment_details();
            $this->load->view($data['page'], $data['data']);
        }
    }
	
    public function ajax_fetch_article_on_group(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->ajax_fetch_article_on_group();
            // echo '<pre>',print_r($res),'</pre>'; die;
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function jobber_ledger() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $job = $this->input->post('fab[]');
            $from = $this->input->post('from');
                $to = $this->input->post('to');
                $job_type = $this->input->post('jobber_type');
            $data = $this->Report_order_status_m->jobber_ledger_status($job , $from, $to, $job_type);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function report_leather_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->fetch_report_leather_status();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function report_article_costing_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->report_article_costing_details();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function report_item_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->fetch_report_item_status();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function checking_summary_status() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Report_order_status_m');
            $data = $this->Report_order_status_m->fetch_checking_summary_status_v();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function stock_summary_status(){
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_stock_summary_status();
        $this->load->view($data['page'], $data['data']);
        // $this->load->view('report/stock_detail_ledger', $data)
    }

public function fetch_items_on_item_group(){
        $this->load->model('Report_order_status_m');
        $datam =$this->Report_order_status_m->items_on_item_group_m($this->input->post('gr_id'));
        echo json_encode($datam);
    }

    public function fetch_articles_on_article_group(){
        $this->load->model('Report_order_status_m');
        $datam =$this->Report_order_status_m->fetch_articles_on_article_group($this->input->post('gr_id'));
        echo json_encode($datam);
    }

    public function stock_detail_ledger() {
        $this->load->model('Report_order_status_m');
    $data = $this->Report_order_status_m->fetch_stock_summary_ledger();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }

    public function supplier_wise_item_position() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_supplier_wise_item_position();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    } 

    public function checking_entry_sheet() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_checking_entry_sheet();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function supplier_purchase_ledger() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_supplier_purchase_ledger();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function supplier_wise_purchase_position() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_supplier_wise_purchase_position();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function group_stock_summary() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_group_stock_summary();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function jobber_bill_summary() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_jobber_bill_summary();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function cutter_bill_summary() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_cutter_bill_summary();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function monthly_production_status() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_monthly_production_status();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function production_register() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_production_register();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function outstanding_report() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_outstanding_report();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function payroll_reports() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_payroll_reports();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function get_fetch_all_item_for_supplier_basis(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Report_order_status_m');

            $data = $this->Report_order_status_m->get_fetch_all_item_for_supplier_basis();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
    
     public function get_fetch_all_order_for_supplier_basis(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Report_order_status_m');

            $data = $this->Report_order_status_m->get_fetch_all_order_for_supplier_basis();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
    
    
     public function get_fetch_all_item_for_costings_article(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Report_order_status_m');

            $data = $this->Report_order_status_m->get_fetch_all_item_for_costings_article();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
    
    
    public function get_fetch_all_item_for_costings_article_all_details(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Report_order_status_m');

            $data = $this->Report_order_status_m->get_fetch_all_item_for_costings_article_all_details();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }


    public function article_master_report() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->article_master_report();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function overtime_reports_m() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->overtime_reports_details_m();
        $this->load->view($data['page'], $data['data']);
        // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function purchase_order_audit_report() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->purchase_order_audit_report();
        $this->load->view($data['page'], $data['data']);
        // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function purchase_order_audit_report_details_values() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->purchase_order_audit_report_details_values();
        $this->load->view($data['page'], $data['data']);
        // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function invoice_hsn_summary() {
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->invoice_hsn_summary();
        $this->load->view($data['page'], $data['data']);
        // $this->load->view('report/stock_detail_ledger', $data)
    }

    public function invoice_sales_reconcilation() {
      $this->load->model('Report_order_status_m');
      $data = $this->Report_order_status_m->invoice_sales_reconcilation();
      $this->load->view($data['page'], $data['data']);
      // $this->load->view('report/stock_detail_ledger', $data)
    }
    
    public function yearly_stock_update(){
        
        // LINING
        $update_lining = array(
            array("val0"=>"150","val1"=>"568.95","val2"=>"38"),
            array("val0"=>"151","val1"=>"1709.75","val2"=>"38"),
            array("val0"=>"154","val1"=>"38.7","val2"=>"36"),
            array("val0"=>"152","val1"=>"114.6","val2"=>"36.11"),
            array("val0"=>"1772","val1"=>"829.5","val2"=>"36"),
            array("val0"=>"156","val1"=>"866.5","val2"=>"42.28"),
            array("val0"=>"157","val1"=>"819.25","val2"=>"42"),
            array("val0"=>"158","val1"=>"0","val2"=>"0"),
            array("val0"=>"160","val1"=>"0","val2"=>"0"),
            array("val0"=>"161","val1"=>"0","val2"=>"0"),
            array("val0"=>"2116","val1"=>"22.68","val2"=>"1016"),
            array("val0"=>"2118","val1"=>"23.27","val2"=>"1016"),
            array("val0"=>"2119","val1"=>"19.62","val2"=>"1016"),
            array("val0"=>"2117","val1"=>"17.87","val2"=>"1016"),
            array("val0"=>"1418","val1"=>"0","val2"=>"0"),
            array("val0"=>"1349","val1"=>"0","val2"=>"0"),
            array("val0"=>"1478","val1"=>"1867.25","val2"=>"89.44"),
            array("val0"=>"165","val1"=>"468.3","val2"=>"53.4"),
            array("val0"=>"162","val1"=>"1773.4","val2"=>"56"),
            array("val0"=>"163","val1"=>"784.35","val2"=>"51.91"),
            array("val0"=>"164","val1"=>"391.35","val2"=>"56"),
            array("val0"=>"1857","val1"=>"140","val2"=>"34.29"),
            array("val0"=>"1848","val1"=>"0","val2"=>"0"),
            array("val0"=>"1946","val1"=>"0","val2"=>"0"),
            array("val0"=>"166","val1"=>"2850","val2"=>"67.21"),
            array("val0"=>"1810","val1"=>"8","val2"=>"404"),
            array("val0"=>"167","val1"=>"3.75","val2"=>"50.37"),
            array("val0"=>"1102","val1"=>"0","val2"=>"0"),
            array("val0"=>"1371","val1"=>"0","val2"=>"0"),
            array("val0"=>"2161","val1"=>"0","val2"=>"0"),
            array("val0"=>"2162","val1"=>"0","val2"=>"0"),
            array("val0"=>"2163","val1"=>"0","val2"=>"0"),
            array("val0"=>"1525","val1"=>"235","val2"=>"65"),
            array("val0"=>"169","val1"=>"4069","val2"=>"67.36"),
            array("val0"=>"1041","val1"=>"359.25","val2"=>"53.62"),
            array("val0"=>"170","val1"=>"2060.75","val2"=>"38"),
            array("val0"=>"2201","val1"=>"110","val2"=>"38"),
            array("val0"=>"1128","val1"=>"0","val2"=>"0"),
            array("val0"=>"173","val1"=>"317","val2"=>"36"),
            array("val0"=>"172","val1"=>"402.1","val2"=>"37.6"),
            array("val0"=>"174","val1"=>"338.9","val2"=>"37"),
            array("val0"=>"1388","val1"=>"0","val2"=>"0"),
            array("val0"=>"1612","val1"=>"869.5","val2"=>"36.32"),
            array("val0"=>"1387","val1"=>"1199.8","val2"=>"38.02"),
            array("val0"=>"1465","val1"=>"111.1","val2"=>"39"),
            array("val0"=>"2209","val1"=>"957.75","val2"=>"38"),
            array("val0"=>"1138","val1"=>"2067.95","val2"=>"39"),
            array("val0"=>"1479","val1"=>"474.25","val2"=>"35.92"),
            array("val0"=>"1139","val1"=>"0","val2"=>"0"),
            array("val0"=>"182","val1"=>"532","val2"=>"20.5"),
            array("val0"=>"179","val1"=>"1437","val2"=>"23.04"),
            array("val0"=>"180","val1"=>"3061","val2"=>"23"),
            array("val0"=>"181","val1"=>"337","val2"=>"23")
        );
        
        // foreach($update_lining as $ul){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ul['val1']."', opening_rate = '". $ul['val2'] . "' WHERE id_id =" . $ul['val0'];
        //     $this->db->query($query);
        // }
        
        $update_pvc = array (
          0 => 
          array (
            'val0' => '186',
            'val1' => '288',
            'val2' => '42.6',
          ),
          1 => 
          array (
            'val0' => '1419',
            'val1' => '1472.72',
            'val2' => '13.16',
          ),
          2 => 
          array (
            'val0' => '1263',
            'val1' => '0',
            'val2' => '0',
          ),
          3 => 
          array (
            'val0' => '1420',
            'val1' => '1756.75',
            'val2' => '21.23',
          ),
          4 => 
          array (
            'val0' => '1660',
            'val1' => '136',
            'val2' => '34.28',
          ),
          5 => 
          array (
            'val0' => '2037',
            'val1' => '532',
            'val2' => '57.65',
          ),
          6 => 
          array (
            'val0' => '187',
            'val1' => '360',
            'val2' => '181.21',
          ),
          7 => 
          array (
            'val0' => '2150',
            'val1' => '400',
            'val2' => '31',
          ),
          8 => 
          array (
            'val0' => '1942',
            'val1' => '1740',
            'val2' => '42.23',
          ),
          9 => 
          array (
            'val0' => '1327',
            'val1' => '5350',
            'val2' => '26.9',
          ),
          10 => 
          array (
            'val0' => '2249',
            'val1' => '88',
            'val2' => '72.54',
          ),
          11 => 
          array (
            'val0' => '2255',
            'val1' => '25',
            'val2' => '145.08',
          ),
          12 => 
          array (
            'val0' => '1471',
            'val1' => '2850',
            'val2' => '41.67',
          ),
          13 => 
          array (
            'val0' => '2234',
            'val1' => '192',
            'val2' => '96.72',
          ),
          14 => 
          array (
            'val0' => '2265',
            'val1' => '56',
            'val2' => '120.9',
          ),
          15 => 
          array (
            'val0' => '1397',
            'val1' => '250',
            'val2' => '21.1',
          ),
          16 => 
          array (
            'val0' => '1372',
            'val1' => '200',
            'val2' => '195',
          ),
          17 => 
          array (
            'val0' => '1889',
            'val1' => '50',
            'val2' => '210',
          ),
          18 => 
          array (
            'val0' => '2000',
            'val1' => '5',
            'val2' => '160',
          ),
          19 => 
          array (
            'val0' => '2001',
            'val1' => '204',
            'val2' => '195',
          ),
          20 => 
          array (
            'val0' => '2002',
            'val1' => '100',
            'val2' => '180',
          ),
          21 => 
          array (
            'val0' => '581',
            'val1' => '334.4',
            'val2' => '216.12',
          ),
          22 => 
          array (
            'val0' => '352',
            'val1' => '0',
            'val2' => '0',
          ),
          23 => 
          array (
            'val0' => '582',
            'val1' => '611',
            'val2' => '347.02',
          ),
          24 => 
          array (
            'val0' => '189',
            'val1' => '483',
            'val2' => '166.01',
          )
        );
        
        // foreach($update_pvc as $up){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$up['val1']."', opening_rate = '". $up['val2'] . "' WHERE id_id =" . $up['val0'];
        //     $this->db->query($query);
        // }
        
        $update_chain_zipper = array(
            array("val0"=>"1413","val1"=>"0","val2"=>"0"),
            array("val0"=>"1955","val1"=>"0","val2"=>"0"),
            array("val0"=>"1954","val1"=>"0","val2"=>"0"),
            array("val0"=>"2220","val1"=>"24","val2"=>"10"),
            array("val0"=>"233","val1"=>"26400","val2"=>"6.3"),
            array("val0"=>"2253","val1"=>"6080","val2"=>"0"),
            array("val0"=>"234","val1"=>"16600","val2"=>"5.98"),
            array("val0"=>"2254","val1"=>"8290","val2"=>"0"),
            array("val0"=>"235","val1"=>"23030","val2"=>"5.94"),
            array("val0"=>"193","val1"=>"1200","val2"=>"10.98"),
            array("val0"=>"194","val1"=>"0","val2"=>"0"),
            array("val0"=>"196","val1"=>"2050","val2"=>"10.99"),
            array("val0"=>"228","val1"=>"100","val2"=>"45"),
            array("val0"=>"229","val1"=>"100","val2"=>"45"),
            array("val0"=>"2032","val1"=>"100","val2"=>"45"),
            array("val0"=>"232","val1"=>"1400","val2"=>"5.5"),
            array("val0"=>"212","val1"=>"4900","val2"=>"25.58"),
            array("val0"=>"236","val1"=>"3600","val2"=>"7.5"),
            array("val0"=>"1697","val1"=>"3705","val2"=>"7.5"),
            array("val0"=>"237","val1"=>"115","val2"=>"7.15"),
            array("val0"=>"238","val1"=>"17200","val2"=>"7.5"),
            array("val0"=>"205","val1"=>"400","val2"=>"54.29"),
            array("val0"=>"2011","val1"=>"1500","val2"=>"87.02"),
            array("val0"=>"206","val1"=>"1500","val2"=>"54.29"),
            array("val0"=>"198","val1"=>"5400","val2"=>"21.76"),
            array("val0"=>"199","val1"=>"100","val2"=>"21.17"),
            array("val0"=>"1956","val1"=>"200","val2"=>"21.17"),
            array("val0"=>"201","val1"=>"6400","val2"=>"21.64"),
            array("val0"=>"2204","val1"=>"500","val2"=>"65"),
            array("val0"=>"239","val1"=>"110","val2"=>"75"),
            array("val0"=>"1816","val1"=>"440","val2"=>"75"),
            array("val0"=>"2007","val1"=>"32","val2"=>"85"),
            array("val0"=>"2008","val1"=>"255","val2"=>"65"),
            array("val0"=>"2057","val1"=>"200","val2"=>"65"),
            array("val0"=>"1957","val1"=>"500","val2"=>"65"),
            array("val0"=>"1958","val1"=>"1750","val2"=>"65"),
            array("val0"=>"1452","val1"=>"0","val2"=>"0"),
            array("val0"=>"1453","val1"=>"375","val2"=>"65"),
            array("val0"=>"1393","val1"=>"4400","val2"=>"7"),
            array("val0"=>"211","val1"=>"0","val2"=>"0"),
            array("val0"=>"216","val1"=>"200","val2"=>"49.39"),
            array("val0"=>"217","val1"=>"300","val2"=>"48.9"),
            array("val0"=>"1075","val1"=>"300","val2"=>"76.83"),
            array("val0"=>"1076","val1"=>"300","val2"=>"76.83"),
            array("val0"=>"1763","val1"=>"200","val2"=>"87.02"),
            array("val0"=>"2020","val1"=>"700","val2"=>"54.29"),
            array("val0"=>"2010","val1"=>"1200","val2"=>"87.02"),
            array("val0"=>"1764","val1"=>"1300","val2"=>"87.02"),
            array("val0"=>"2013","val1"=>"0","val2"=>"0"),
            array("val0"=>"222","val1"=>"350","val2"=>"58.51"),
            array("val0"=>"223","val1"=>"5","val2"=>"70.36"),
            array("val0"=>"224","val1"=>"10","val2"=>"70.36"),
            array("val0"=>"2219","val1"=>"24","val2"=>"3.75"),
            array("val0"=>"1990","val1"=>"0","val2"=>"0"),
            array("val0"=>"1989","val1"=>"3295","val2"=>"6.78"),
            array("val0"=>"1333","val1"=>"0","val2"=>"0"),
            array("val0"=>"1006","val1"=>"300","val2"=>"135.63"),
            array("val0"=>"1339","val1"=>"100","val2"=>"131.71"),
            array("val0"=>"1337","val1"=>"0","val2"=>"0"),
            array("val0"=>"2031","val1"=>"100","val2"=>"135.63"),
            array("val0"=>"1338","val1"=>"0","val2"=>"0"),
            array("val0"=>"1666","val1"=>"100","val2"=>"135.63"),
            array("val0"=>"1007","val1"=>"500","val2"=>"135.63"),
            array("val0"=>"1667","val1"=>"105","val2"=>"131.72"),
            array("val0"=>"1334","val1"=>"0","val2"=>"0"),
            array("val0"=>"1340","val1"=>"100","val2"=>"135.63"),
            array("val0"=>"1336","val1"=>"0","val2"=>"0"),
            array("val0"=>"1231","val1"=>"250","val2"=>"135.63"),
            array("val0"=>"1335","val1"=>"0","val2"=>"0")
        );
        
        // foreach($update_chain_zipper as $ucz){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ucz['val1']."', opening_rate = '". $ucz['val2'] . "' WHERE id_id =" . $ucz['val0'];
        //     $this->db->query($query);
        // }
        
        $update_puller = array (
          0 => 
          array (
            'val0' => '1887',
            'val1' => '400',
            'val2' => '4.55',
          ),
          1 => 
          array (
            'val0' => '1426',
            'val1' => '500',
            'val2' => '2.94',
          ),
          2 => 
          array (
            'val0' => '2218',
            'val1' => '5',
            'val2' => '9',
          ),
          3 => 
          array (
            'val0' => '1355',
            'val1' => '1960',
            'val2' => '0',
          ),
          4 => 
          array (
            'val0' => '1354',
            'val1' => '100',
            'val2' => '-0.11',
          ),
          5 => 
          array (
            'val0' => '243',
            'val1' => '2412',
            'val2' => '27.88',
          ),
          6 => 
          array (
            'val0' => '245',
            'val1' => '1000',
            'val2' => '2.11',
          ),
          7 => 
          array (
            'val0' => '1322',
            'val1' => '4000',
            'val2' => '2',
          ),
          8 => 
          array (
            'val0' => '315',
            'val1' => '1472',
            'val2' => '0.75',
          ),
          9 => 
          array (
            'val0' => '1305',
            'val1' => '11000',
            'val2' => '0.07',
          ),
          10 => 
          array (
            'val0' => '1988',
            'val1' => '13500',
            'val2' => '1.08',
          ),
          11 => 
          array (
            'val0' => '1246',
            'val1' => '20000',
            'val2' => '5.28',
          ),
          12 => 
          array (
            'val0' => '314',
            'val1' => '2000',
            'val2' => '1.5',
          ),
          13 => 
          array (
            'val0' => '313',
            'val1' => '70000',
            'val2' => '1.65',
          ),
          14 => 
          array (
            'val0' => '316',
            'val1' => '2660',
            'val2' => '1.02',
          ),
          15 => 
          array (
            'val0' => '1767',
            'val1' => '193',
            'val2' => '2.5',
          ),
          16 => 
          array (
            'val0' => '312',
            'val1' => '1',
            'val2' => '1850',
          ),
          17 => 
          array (
            'val0' => '249',
            'val1' => '700',
            'val2' => '4',
          ),
          18 => 
          array (
            'val0' => '1306',
            'val1' => '1800',
            'val2' => '8.11',
          ),
          19 => 
          array (
            'val0' => '1809',
            'val1' => '100',
            'val2' => '5.5',
          ),
          20 => 
          array (
            'val0' => '250',
            'val1' => '603',
            'val2' => '3.5',
          ),
          21 => 
          array (
            'val0' => '248',
            'val1' => '2016',
            'val2' => '9.46',
          ),
          22 => 
          array (
            'val0' => '1051',
            'val1' => '3500',
            'val2' => '1.39',
          ),
          23 => 
          array (
            'val0' => '257',
            'val1' => '10',
            'val2' => '1.5',
          ),
          24 => 
          array (
            'val0' => '254',
            'val1' => '3484',
            'val2' => '4.53',
          ),
          25 => 
          array (
            'val0' => '260',
            'val1' => '2550',
            'val2' => '1.95',
          ),
          26 => 
          array (
            'val0' => '2089',
            'val1' => '26250',
            'val2' => '1.25',
          ),
          27 => 
          array (
            'val0' => '281',
            'val1' => '170',
            'val2' => '4.35',
          ),
          28 => 
          array (
            'val0' => '1208',
            'val1' => '230',
            'val2' => '8.56',
          ),
          29 => 
          array (
            'val0' => '283',
            'val1' => '100',
            'val2' => '4.35',
          ),
          30 => 
          array (
            'val0' => '282',
            'val1' => '500',
            'val2' => '2.3',
          ),
          31 => 
          array (
            'val0' => '287',
            'val1' => '2300',
            'val2' => '5.5',
          ),
          32 => 
          array (
            'val0' => '292',
            'val1' => '260',
            'val2' => '9.75',
          ),
          33 => 
          array (
            'val0' => '286',
            'val1' => '2700',
            'val2' => '3.63',
          ),
          34 => 
          array (
            'val0' => '290',
            'val1' => '270',
            'val2' => '5',
          ),
          35 => 
          array (
            'val0' => '2080',
            'val1' => '520',
            'val2' => '5.5',
          ),
          36 => 
          array (
            'val0' => '1753',
            'val1' => '100',
            'val2' => '6.5',
          ),
          37 => 
          array (
            'val0' => '2054',
            'val1' => '1000',
            'val2' => '13',
          ),
          38 => 
          array (
            'val0' => '317',
            'val1' => '71000',
            'val2' => '3.5',
          ),
          39 => 
          array (
            'val0' => '322',
            'val1' => '35000',
            'val2' => '4.19',
          ),
          40 => 
          array (
            'val0' => '324',
            'val1' => '32000',
            'val2' => '4.17',
          ),
          41 => 
          array (
            'val0' => '1179',
            'val1' => '29000',
            'val2' => '6.72',
          ),
          42 => 
          array (
            'val0' => '319',
            'val1' => '67000',
            'val2' => '4',
          ),
          43 => 
          array (
            'val0' => '320',
            'val1' => '27641',
            'val2' => '0.51',
          ),
          44 => 
          array (
            'val0' => '321',
            'val1' => '13700',
            'val2' => '2.28',
          ),
          45 => 
          array (
            'val0' => '265',
            'val1' => '50',
            'val2' => '4.5',
          ),
          46 => 
          array (
            'val0' => '268',
            'val1' => '620',
            'val2' => '6.79',
          ),
          47 => 
          array (
            'val0' => '1022',
            'val1' => '640',
            'val2' => '9.13',
          ),
          48 => 
          array (
            'val0' => '1477',
            'val1' => '1350',
            'val2' => '6.08',
          ),
          49 => 
          array (
            'val0' => '269',
            'val1' => '450',
            'val2' => '7.5',
          ),
          50 => 
          array (
            'val0' => '1993',
            'val1' => '10040',
            'val2' => '2.75',
          ),
          51 => 
          array (
            'val0' => '275',
            'val1' => '207',
            'val2' => '7.5',
          ),
          52 => 
          array (
            'val0' => '277',
            'val1' => '15',
            'val2' => '1.26',
          ),
          53 => 
          array (
            'val0' => '1927',
            'val1' => '520',
            'val2' => '4',
          ),
          54 => 
          array (
            'val0' => '264',
            'val1' => '550',
            'val2' => '14',
          ),
          55 => 
          array (
            'val0' => '295',
            'val1' => '1500',
            'val2' => '7.25',
          ),
          56 => 
          array (
            'val0' => '298',
            'val1' => '4900',
            'val2' => '8.51',
          ),
          57 => 
          array (
            'val0' => '301',
            'val1' => '500',
            'val2' => '8.5',
          ),
          58 => 
          array (
            'val0' => '299',
            'val1' => '6800',
            'val2' => '14.5',
          ),
          59 => 
          array (
            'val0' => '1200',
            'val1' => '8350',
            'val2' => '6.95',
          ),
          60 => 
          array (
            'val0' => '294',
            'val1' => '5700',
            'val2' => '5.44',
          ),
          61 => 
          array (
            'val0' => '1323',
            'val1' => '1000',
            'val2' => '3.1',
          ),
          62 => 
          array (
            'val0' => '307',
            'val1' => '1720',
            'val2' => '2.55',
          ),
          63 => 
          array (
            'val0' => '2043',
            'val1' => '103',
            'val2' => '12',
          ),
          64 => 
          array (
            'val0' => '2047',
            'val1' => '181',
            'val2' => '12.38',
          ),
          65 => 
          array (
            'val0' => '2044',
            'val1' => '206',
            'val2' => '12.5',
          ),
          66 => 
          array (
            'val0' => '2019',
            'val1' => '10000',
            'val2' => '7.6',
          ),
          67 => 
          array (
            'val0' => '2217',
            'val1' => '5',
            'val2' => '8',
          ),
          68 => 
          array (
            'val0' => '2153',
            'val1' => '100',
            'val2' => '20',
          ),
          69 => 
          array (
            'val0' => '2152',
            'val1' => '100',
            'val2' => '10.5',
          ),
          70 => 
          array (
            'val0' => '2067',
            'val1' => '10000',
            'val2' => '3.18',
          ),
          71 => 
          array (
            'val0' => '2068',
            'val1' => '15000',
            'val2' => '3.18',
          ),
          72 => 
          array (
            'val0' => '330',
            'val1' => '12590',
            'val2' => '3.85',
          ),
          73 => 
          array (
            'val0' => '328',
            'val1' => '27500',
            'val2' => '6.16',
          ),
          74 => 
          array (
            'val0' => '1008',
            'val1' => '15000',
            'val2' => '8.19',
          ),
          75 => 
          array (
            'val0' => '1201',
            'val1' => '34000',
            'val2' => '5.16',
          ),
          76 => 
          array (
            'val0' => '329',
            'val1' => '2000',
            'val2' => '3',
          ),
          77 => 
          array (
            'val0' => '1042',
            'val1' => '26000',
            'val2' => '1.19',
          ),
          78 => 
          array (
            'val0' => '326',
            'val1' => '19326',
            'val2' => '1.36',
          )
        );
        // foreach($update_puller as $upul){
            
        //     $query = "UPDATE item_dtl SET opening_stock = '".$upul['val1']."', opening_rate = '". $upul['val2'] . "' WHERE id_id =" . $upul['val0'];
        //     $val = 1;
        //     if(!$this->db->query($query)){
        //         $val = 2;
        //     }
        // }
        // if($val == 2){
        //     echo 'OMG';
        // }else{
        //     echo 'DONE';
        // }
        
        
        $update_fittings = array(
            array("val0"=>"1757","val1"=>"21","val2"=>"1,323.00","val3"=>"63"),
            array("val0"=>"379","val1"=>"1763","val2"=>"11,097.56","val3"=>"6.29"),
            array("val0"=>"380","val1"=>"2000","val2"=>"12,866.44","val3"=>"6.43"),
            array("val0"=>"382","val1"=>"112","val2"=>"3.36","val3"=>"0.03"),
            array("val0"=>"383","val1"=>"5737","val2"=>"37,290.50","val3"=>"6.5"),
            array("val0"=>"390","val1"=>"147","val2"=>"2,119.50","val3"=>"14.42"),
            array("val0"=>"1151","val1"=>"1520","val2"=>"7,600.00","val3"=>"5"),
            array("val0"=>"381","val1"=>"2341","val2"=>"20,673.90","val3"=>"8.83"),
            array("val0"=>"1117","val1"=>"545","val2"=>"2,098.25","val3"=>"3.85"),
            array("val0"=>"384","val1"=>"1445","val2"=>"11,567.85","val3"=>"8.01"),
            array("val0"=>"386","val1"=>"318","val2"=>"2,092.44","val3"=>"6.58"),
            array("val0"=>"385","val1"=>"459","val2"=>"2,788.30","val3"=>"6.07"),
            array("val0"=>"391","val1"=>"69","val2"=>"586.5","val3"=>"8.5"),
            array("val0"=>"387","val1"=>"1917","val2"=>"16,592.09","val3"=>"8.66"),
            array("val0"=>"1152","val1"=>"1835","val2"=>"11,010.00","val3"=>"6"),
            array("val0"=>"388","val1"=>"927","val2"=>"7,416.00","val3"=>"8"),
            array("val0"=>"389","val1"=>"435","val2"=>"1,918.35","val3"=>"4.41"),
            array("val0"=>"1038","val1"=>"126","val2"=>"1,826.40","val3"=>"14.5"),
            array("val0"=>"1039","val1"=>"35","val2"=>"367.5","val3"=>"10.5"),
            array("val0"=>"405","val1"=>"580","val2"=>"4,640.00","val3"=>"8"),
            array("val0"=>"407","val1"=>"1035","val2"=>"7,347.80","val3"=>"7.1"),
            array("val0"=>"2182","val1"=>"546","val2"=>"4,641.00","val3"=>"8.5"),
            array("val0"=>"406","val1"=>"940","val2"=>"7,990.00","val3"=>"8.5"),
            array("val0"=>"507","val1"=>"473","val2"=>"-1,345.37","val3"=>"-2.84"),
            array("val0"=>"509","val1"=>"545","val2"=>"3,253.65","val3"=>"5.97"),
            array("val0"=>"506","val1"=>"1653","val2"=>"9,918.00","val3"=>"6"),
            array("val0"=>"510","val1"=>"320","val2"=>"1,353.60","val3"=>"4.23"),
            array("val0"=>"1654","val1"=>"1107","val2"=>"4,028.04","val3"=>"3.64"),
            array("val0"=>"508","val1"=>"5004","val2"=>"31,983.12","val3"=>"6.39"),
            array("val0"=>"2136","val1"=>"2","val2"=>"406.78","val3"=>"203.39"),
            array("val0"=>"1853","val1"=>"70","val2"=>"3,220.00","val3"=>"46"),
            array("val0"=>"1858","val1"=>"10","val2"=>"400","val3"=>"40"),
            array("val0"=>"392","val1"=>"205","val2"=>"1,435.00","val3"=>"7"),
            array("val0"=>"1473","val1"=>"600","val2"=>"1,950.00","val3"=>"3.25"),
            array("val0"=>"1034","val1"=>"1544","val2"=>"8,858.20","val3"=>"5.74"),
            array("val0"=>"1035","val1"=>"50","val2"=>"0","val3"=>"0"),
            array("val0"=>"885","val1"=>"10","val2"=>"2,212.00","val3"=>"221.2"),
            array("val0"=>"1243","val1"=>"548","val2"=>"26,304.00","val3"=>"48"),
            array("val0"=>"1492","val1"=>"5","val2"=>"270","val3"=>"54"),
            array("val0"=>"1451","val1"=>"308","val2"=>"616","val3"=>"2"),
            array("val0"=>"1722","val1"=>"340","val2"=>"2,720.00","val3"=>"8"),
            array("val0"=>"378","val1"=>"-315","val2"=>"-1,174.95","val3"=>"3.73"),
            array("val0"=>"2121","val1"=>"2","val2"=>"567.8","val3"=>"283.9"),
            array("val0"=>"1036","val1"=>"433","val2"=>"4,130.82","val3"=>"9.54"),
            array("val0"=>"1025","val1"=>"180","val2"=>"2,350.80","val3"=>"13.06"),
            array("val0"=>"1172","val1"=>"197","val2"=>"935.75","val3"=>"4.75"),
            array("val0"=>"1561","val1"=>"0","val2"=>"0","val3"=>"0"),
            array("val0"=>"1788","val1"=>"2015","val2"=>"5,541.25","val3"=>"2.75"),
            array("val0"=>"395","val1"=>"70","val2"=>"490","val3"=>"7"),
            array("val0"=>"394","val1"=>"122","val2"=>"1,525.00","val3"=>"12.5"),
            array("val0"=>"2165","val1"=>"100000","val2"=>"25,000.00","val3"=>"0.25"),
            array("val0"=>"397","val1"=>"589","val2"=>"653.79","val3"=>"1.11"),
            array("val0"=>"1752","val1"=>"100","val2"=>"100","val3"=>"1"),
            array("val0"=>"1890","val1"=>"1000","val2"=>"2,250.00","val3"=>"2.25"),
            array("val0"=>"396","val1"=>"1880","val2"=>"1,880.00","val3"=>"1"),
            array("val0"=>"400","val1"=>"959","val2"=>"5,717.00","val3"=>"5.96"),
            array("val0"=>"398","val1"=>"697","val2"=>"3,958.25","val3"=>"5.68"),
            array("val0"=>"401","val1"=>"904","val2"=>"4,972.00","val3"=>"5.5"),
            array("val0"=>"403","val1"=>"300","val2"=>"3,900.00","val3"=>"13"),
            array("val0"=>"1150","val1"=>"40","val2"=>"360","val3"=>"9"),
            array("val0"=>"402","val1"=>"460","val2"=>"4,374.60","val3"=>"9.51"),
            array("val0"=>"399","val1"=>"580","val2"=>"1,867.60","val3"=>"3.22"),
            array("val0"=>"404","val1"=>"398","val2"=>"5,970.00","val3"=>"15"),
            array("val0"=>"1047","val1"=>"100","val2"=>"4,000.00","val3"=>"40"),
            array("val0"=>"1830","val1"=>"170","val2"=>"2,550.00","val3"=>"15"),
            array("val0"=>"1978","val1"=>"70","val2"=>"1,330.00","val3"=>"19"),
            array("val0"=>"1597","val1"=>"170","val2"=>"166.6","val3"=>"0.98"),
            array("val0"=>"408","val1"=>"2350","val2"=>"2,702.50","val3"=>"1.15"),
            array("val0"=>"1983","val1"=>"358","val2"=>"10,740.00","val3"=>"30"),
            array("val0"=>"409","val1"=>"1209","val2"=>"5,392.14","val3"=>"4.46"),
            array("val0"=>"1227","val1"=>"7224","val2"=>"82,450.20","val3"=>"11.41"),
            array("val0"=>"1197","val1"=>"6736","val2"=>"67,265.60","val3"=>"9.99"),
            array("val0"=>"1594","val1"=>"49","val2"=>"183.75","val3"=>"3.75"),
            array("val0"=>"2028","val1"=>"67","val2"=>"3,015.00","val3"=>"45"),
            array("val0"=>"1696","val1"=>"450","val2"=>"1,237.50","val3"=>"2.75"),
            array("val0"=>"413","val1"=>"815","val2"=>"10,595.00","val3"=>"13"),
            array("val0"=>"414","val1"=>"350","val2"=>"4,900.00","val3"=>"14"),
            array("val0"=>"412","val1"=>"1083","val2"=>"16,245.00","val3"=>"15"),
            array("val0"=>"1595","val1"=>"198","val2"=>"3,564.00","val3"=>"18"),
            array("val0"=>"1596","val1"=>"123","val2"=>"1,722.00","val3"=>"14"),
            array("val0"=>"415","val1"=>"1440","val2"=>"22,723.20","val3"=>"15.78"),
            array("val0"=>"1131","val1"=>"100","val2"=>"0","val3"=>"0"),
            array("val0"=>"1598","val1"=>"3866","val2"=>"43,072.00","val3"=>"11.14"),
            array("val0"=>"417","val1"=>"633","val2"=>"4,431.00","val3"=>"7"),
            array("val0"=>"420","val1"=>"721","val2"=>"4,777.00","val3"=>"6.63"),
            array("val0"=>"419","val1"=>"1776","val2"=>"13,320.00","val3"=>"7.5"),
            array("val0"=>"418","val1"=>"10","val2"=>"45","val3"=>"4.5"),
            array("val0"=>"421","val1"=>"45","val2"=>"301.05","val3"=>"6.69"),
            array("val0"=>"422","val1"=>"1068","val2"=>"12,068.40","val3"=>"11.3"),
            array("val0"=>"1058","val1"=>"790","val2"=>"8,905.79","val3"=>"11.27"),
            array("val0"=>"425","val1"=>"5","val2"=>"24.6","val3"=>"4.92"),
            array("val0"=>"1678","val1"=>"2019","val2"=>"22,209.00","val3"=>"11"),
            array("val0"=>"423","val1"=>"22","val2"=>"198","val3"=>"9"),
            array("val0"=>"424","val1"=>"289","val2"=>"1,826.10","val3"=>"6.32"),
            array("val0"=>"1874","val1"=>"210","val2"=>"1,680.00","val3"=>"8"),
            array("val0"=>"2124","val1"=>"4","val2"=>"186.12","val3"=>"46.53"),
            array("val0"=>"2123","val1"=>"4","val2"=>"165.12","val3"=>"41.28"),
            array("val0"=>"1929","val1"=>"101","val2"=>"1,919.00","val3"=>"19"),
            array("val0"=>"426","val1"=>"52","val2"=>"608","val3"=>"11.69"),
            array("val0"=>"1854","val1"=>"4","val2"=>"72","val3"=>"18"),
            array("val0"=>"2126","val1"=>"2","val2"=>"12.2","val3"=>"6.1"),
            array("val0"=>"1742","val1"=>"6336","val2"=>"47,520.00","val3"=>"7.5"),
            array("val0"=>"1850","val1"=>"845","val2"=>"4,225.00","val3"=>"5"),
            array("val0"=>"2064","val1"=>"5","val2"=>"485","val3"=>"97"),
            array("val0"=>"427","val1"=>"0","val2"=>"156.15","val3"=>"0"),
            array("val0"=>"428","val1"=>"3","val2"=>"4,098.00","val3"=>"1366"),
            array("val0"=>"1801","val1"=>"0","val2"=>"0","val3"=>"0"),
            array("val0"=>"1840","val1"=>"19325","val2"=>"328,953.32","val3"=>"17.02"),
            array("val0"=>"2125","val1"=>"2","val2"=>"46.52","val3"=>"23.26"),
            array("val0"=>"429","val1"=>"20","val2"=>"40.2","val3"=>"2.01"),
            array("val0"=>"1119","val1"=>"662","val2"=>"787.78","val3"=>"1.19"),
            array("val0"=>"430","val1"=>"2000","val2"=>"5,260.00","val3"=>"2.63"),
            array("val0"=>"438","val1"=>"453","val2"=>"3,964.00","val3"=>"8.75"),
            array("val0"=>"437","val1"=>"9","val2"=>"13.5","val3"=>"1.5"),
            array("val0"=>"1023","val1"=>"36","val2"=>"50.2","val3"=>"1.39"),
            array("val0"=>"1048","val1"=>"17","val2"=>"289","val3"=>"17"),
            array("val0"=>"2046","val1"=>"50","val2"=>"425","val3"=>"8.5"),
            array("val0"=>"522","val1"=>"345","val2"=>"1,035.00","val3"=>"3"),
            array("val0"=>"521","val1"=>"608","val2"=>"1,692.96","val3"=>"2.78"),
            array("val0"=>"2122","val1"=>"1","val2"=>"233.06","val3"=>"233.06"),
            array("val0"=>"1973","val1"=>"284","val2"=>"6,816.00","val3"=>"24"),
            array("val0"=>"1578","val1"=>"101","val2"=>"959.5","val3"=>"9.5"),
            array("val0"=>"523","val1"=>"1015","val2"=>"8,374.00","val3"=>"8.25")
        );
        // foreach($update_fittings as $uft){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$uft['val1']."', opening_rate = '". $uft['val2'] . "' WHERE id_id =" . $uft['val0'];
        //     $this->db->query($query);
        // }
        
        $update_buckle = array(
            array("val0"=>"841","val1"=>"15","val2"=>"19.99"),
            array("val0"=>"843","val1"=>"30","val2"=>"0"),
            array("val0"=>"842","val1"=>"65","val2"=>"20"),
            array("val0"=>"883","val1"=>"38","val2"=>"29.33"),
            array("val0"=>"656","val1"=>"40","val2"=>"9.5"),
            array("val0"=>"1410","val1"=>"138","val2"=>"16"),
            array("val0"=>"2208","val1"=>"400","val2"=>"16"),
            array("val0"=>"1581","val1"=>"244","val2"=>"24"),
            array("val0"=>"1068","val1"=>"15","val2"=>"37.15"),
            array("val0"=>"1924","val1"=>"1192","val2"=>"22.05"),
            array("val0"=>"1681","val1"=>"764.01","val2"=>"27.09"),
            array("val0"=>"1177","val1"=>"355","val2"=>"16.89"),
            array("val0"=>"1067","val1"=>"423","val2"=>"21.69"),
            array("val0"=>"654","val1"=>"805.04","val2"=>"8.88"),
            array("val0"=>"655","val1"=>"78","val2"=>"0"),
            array("val0"=>"651","val1"=>"861","val2"=>"8.5"),
            array("val0"=>"1967","val1"=>"109","val2"=>"14.5"),
            array("val0"=>"1176","val1"=>"926","val2"=>"7.5"),
            array("val0"=>"652","val1"=>"463","val2"=>"15.4"),
            array("val0"=>"653","val1"=>"90","val2"=>"5.43"),
            array("val0"=>"1508","val1"=>"645","val2"=>"12.44"),
            array("val0"=>"602","val1"=>"286","val2"=>"14.51"),
            array("val0"=>"1024","val1"=>"546","val2"=>"24"),
            array("val0"=>"1055","val1"=>"200","val2"=>"13.95"),
            array("val0"=>"629","val1"=>"1059","val2"=>"9.24"),
            array("val0"=>"634","val1"=>"123","val2"=>"12"),
            array("val0"=>"630","val1"=>"1371","val2"=>"10.19"),
            array("val0"=>"1589","val1"=>"200","val2"=>"6.86"),
            array("val0"=>"632","val1"=>"3110","val2"=>"8.13"),
            array("val0"=>"1676","val1"=>"121","val2"=>"14"),
            array("val0"=>"1156","val1"=>"3249","val2"=>"7.5"),
            array("val0"=>"631","val1"=>"857","val2"=>"8.75"),
            array("val0"=>"1436","val1"=>"78","val2"=>"8.97"),
            array("val0"=>"635","val1"=>"0","val2"=>"0"),
            array("val0"=>"1412","val1"=>"361","val2"=>"13.91"),
            array("val0"=>"1926","val1"=>"401","val2"=>"26"),
            array("val0"=>"1712","val1"=>"20","val2"=>"0"),
            array("val0"=>"1133","val1"=>"468.03","val2"=>"34.75"),
            array("val0"=>"579","val1"=>"681","val2"=>"7.98"),
            array("val0"=>"1238","val1"=>"140","val2"=>"9.5"),
            array("val0"=>"586","val1"=>"56","val2"=>"8.29"),
            array("val0"=>"1684","val1"=>"174","val2"=>"18"),
            array("val0"=>"2188","val1"=>"289","val2"=>"4.02"),
            array("val0"=>"584","val1"=>"480","val2"=>"13.81"),
            array("val0"=>"585","val1"=>"90","val2"=>"31.11"),
            array("val0"=>"636","val1"=>"900","val2"=>"11.12"),
            array("val0"=>"853","val1"=>"189","val2"=>"8.13"),
            array("val0"=>"637","val1"=>"1450.01","val2"=>"11.54"),
            array("val0"=>"856","val1"=>"92","val2"=>"7.91"),
            array("val0"=>"852","val1"=>"1567","val2"=>"12.2"),
            array("val0"=>"1158","val1"=>"869","val2"=>"8.51"),
            array("val0"=>"851","val1"=>"939","val2"=>"8.61"),
            array("val0"=>"1590","val1"=>"35","val2"=>"3.93"),
            array("val0"=>"854","val1"=>"9","val2"=>"0"),
            array("val0"=>"589","val1"=>"674","val2"=>"12"),
            array("val0"=>"587","val1"=>"473","val2"=>"13.01"),
            array("val0"=>"590","val1"=>"1099","val2"=>"11.94"),
            array("val0"=>"1061","val1"=>"42","val2"=>"11"),
            array("val0"=>"2185","val1"=>"223","val2"=>"9.4"),
            array("val0"=>"588","val1"=>"803","val2"=>"9.5"),
            array("val0"=>"1421","val1"=>"70","val2"=>"10"),
            array("val0"=>"591","val1"=>"79","val2"=>"8.25"),
            array("val0"=>"1713","val1"=>"83","val2"=>"0"),
            array("val0"=>"593","val1"=>"911","val2"=>"4.04"),
            array("val0"=>"595","val1"=>"288","val2"=>"9"),
            array("val0"=>"1579","val1"=>"33","val2"=>"1.29"),
            array("val0"=>"1154","val1"=>"1040","val2"=>"6"),
            array("val0"=>"592","val1"=>"146","val2"=>"5.47"),
            array("val0"=>"594","val1"=>"160","val2"=>"3.01"),
            array("val0"=>"1580","val1"=>"140","val2"=>"3.36"),
            array("val0"=>"1084","val1"=>"200","val2"=>"5.5"),
            array("val0"=>"2095","val1"=>"4560","val2"=>"3.25"),
            array("val0"=>"1132","val1"=>"206","val2"=>"15.46"),
            array("val0"=>"1962","val1"=>"107","val2"=>"6"),
            array("val0"=>"638","val1"=>"215","val2"=>"20.11"),
            array("val0"=>"642","val1"=>"275","val2"=>"13"),
            array("val0"=>"640","val1"=>"90","val2"=>"16"),
            array("val0"=>"1714","val1"=>"5","val2"=>"5.45"),
            array("val0"=>"639","val1"=>"452","val2"=>"14.5"),
            array("val0"=>"610","val1"=>"362","val2"=>"9.78"),
            array("val0"=>"1585","val1"=>"30","val2"=>"5"),
            array("val0"=>"611","val1"=>"523","val2"=>"6.35"),
            array("val0"=>"614","val1"=>"21","val2"=>"11.57"),
            array("val0"=>"613","val1"=>"1265.01","val2"=>"8.97"),
            array("val0"=>"849","val1"=>"225","val2"=>"12"),
            array("val0"=>"1586","val1"=>"90","val2"=>"6"),
            array("val0"=>"1155","val1"=>"2846","val2"=>"6.41"),
            array("val0"=>"612","val1"=>"663","val2"=>"9.48"),
            array("val0"=>"1064","val1"=>"849","val2"=>"5.55"),
            array("val0"=>"1587","val1"=>"2","val2"=>"6"),
            array("val0"=>"1588","val1"=>"152","val2"=>"14.83"),
            array("val0"=>"1922","val1"=>"400","val2"=>"8"),
            array("val0"=>"850","val1"=>"127","val2"=>"10.05"),
            array("val0"=>"597","val1"=>"67","val2"=>"5.24"),
            array("val0"=>"578","val1"=>"100","val2"=>"18"),
            array("val0"=>"846","val1"=>"120","val2"=>"12.54"),
            array("val0"=>"1593","val1"=>"4","val2"=>"19"),
            array("val0"=>"847","val1"=>"70","val2"=>"17.83"),
            array("val0"=>"844","val1"=>"5","val2"=>"175.5"),
            array("val0"=>"845","val1"=>"151","val2"=>"28.97"),
            array("val0"=>"648","val1"=>"530","val2"=>"17.38"),
            array("val0"=>"650","val1"=>"84","val2"=>"20.31"),
            array("val0"=>"649","val1"=>"9","val2"=>"8.88"),
            array("val0"=>"657","val1"=>"617","val2"=>"9.32"),
            array("val0"=>"661","val1"=>"167","val2"=>"11"),
            array("val0"=>"658","val1"=>"572","val2"=>"9.6"),
            array("val0"=>"662","val1"=>"45","val2"=>"4.4"),
            array("val0"=>"660","val1"=>"1404.01","val2"=>"7.49"),
            array("val0"=>"1408","val1"=>"784","val2"=>"7.58"),
            array("val0"=>"1591","val1"=>"11","val2"=>"6.61"),
            array("val0"=>"1161","val1"=>"929","val2"=>"6.28"),
            array("val0"=>"659","val1"=>"1097","val2"=>"11.08"),
            array("val0"=>"1043","val1"=>"314","val2"=>"7.22"),
            array("val0"=>"605","val1"=>"150","val2"=>"3.89"),
            array("val0"=>"1583","val1"=>"212","val2"=>"9.68"),
            array("val0"=>"1582","val1"=>"24","val2"=>"22.5"),
            array("val0"=>"645","val1"=>"208","val2"=>"21"),
            array("val0"=>"643","val1"=>"264","val2"=>"8.11"),
            array("val0"=>"647","val1"=>"231","val2"=>"13"),
            array("val0"=>"1680","val1"=>"133","val2"=>"23.53"),
            array("val0"=>"1175","val1"=>"149","val2"=>"12.3"),
            array("val0"=>"644","val1"=>"106","val2"=>"18.53"),
            array("val0"=>"646","val1"=>"200","val2"=>"20"),
            array("val0"=>"1592","val1"=>"41","val2"=>"24"),
            array("val0"=>"1080","val1"=>"50","val2"=>"0"),
            array("val0"=>"840","val1"=>"239","val2"=>"9.5"),
            array("val0"=>"1113","val1"=>"263","val2"=>"20.28"),
            array("val0"=>"598","val1"=>"19","val2"=>"8.4"),
            array("val0"=>"606","val1"=>"160","val2"=>"11.09"),
            array("val0"=>"607","val1"=>"45","val2"=>"16"),
            array("val0"=>"1748","val1"=>"558","val2"=>"10"),
            array("val0"=>"857","val1"=>"588","val2"=>"10.93"),
            array("val0"=>"1033","val1"=>"377","val2"=>"14.88"),
            array("val0"=>"1669","val1"=>"20","val2"=>"7.07"),
            array("val0"=>"608","val1"=>"55","val2"=>"12.88"),
            array("val0"=>"1963","val1"=>"100","val2"=>"18"),
            array("val0"=>"609","val1"=>"118","val2"=>"9.22"),
            array("val0"=>"1679","val1"=>"484","val2"=>"22"),
            array("val0"=>"1584","val1"=>"24","val2"=>"46.75"),
            array("val0"=>"848","val1"=>"50","val2"=>"7"),
            array("val0"=>"1183","val1"=>"1761","val2"=>"79.42")
        );
        // foreach($update_buckle as $ubkl){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ubkl['val1']."', opening_rate = '". $ubkl['val2'] . "' WHERE id_id =" . $ubkl['val0'];
        //     $this->db->query($query);
        // }
        
        $update_ring = array(
            array("val0"=>"762","val1"=>"75","val2"=>"2.95"),
            array("val0"=>"764","val1"=>"1093","val2"=>"23.63"),
            array("val0"=>"448","val1"=>"734","val2"=>"15.02"),
            array("val0"=>"447","val1"=>"120","val2"=>"35.58"),
            array("val0"=>"859","val1"=>"232","val2"=>"26.49"),
            array("val0"=>"1627","val1"=>"1076","val2"=>"18.25"),
            array("val0"=>"449","val1"=>"245","val2"=>"26.95"),
            array("val0"=>"858","val1"=>"271","val2"=>"14.54"),
            array("val0"=>"873","val1"=>"46","val2"=>"30.52"),
            array("val0"=>"872","val1"=>"853","val2"=>"26.01"),
            array("val0"=>"804","val1"=>"50","val2"=>"8"),
            array("val0"=>"1232","val1"=>"29","val2"=>"0"),
            array("val0"=>"440","val1"=>"0","val2"=>"0"),
            array("val0"=>"454","val1"=>"170","val2"=>"7.89"),
            array("val0"=>"443","val1"=>"1477","val2"=>"6.63"),
            array("val0"=>"445","val1"=>"2306","val2"=>"6.66"),
            array("val0"=>"444","val1"=>"274","val2"=>"16"),
            array("val0"=>"1546","val1"=>"80","val2"=>"9"),
            array("val0"=>"1170","val1"=>"1461","val2"=>"5"),
            array("val0"=>"442","val1"=>"887","val2"=>"6.19"),
            array("val0"=>"1625","val1"=>"260","val2"=>"6"),
            array("val0"=>"862","val1"=>"29","val2"=>"0"),
            array("val0"=>"863","val1"=>"279","val2"=>"9.21"),
            array("val0"=>"866","val1"=>"171","val2"=>"6.63"),
            array("val0"=>"864","val1"=>"900","val2"=>"6.81"),
            array("val0"=>"870","val1"=>"133","val2"=>"13.5"),
            array("val0"=>"1164","val1"=>"1803","val2"=>"4.98"),
            array("val0"=>"865","val1"=>"483","val2"=>"7"),
            array("val0"=>"868","val1"=>"492","val2"=>"6"),
            array("val0"=>"533","val1"=>"280","val2"=>"9.18"),
            array("val0"=>"537","val1"=>"100","val2"=>"9.65"),
            array("val0"=>"535","val1"=>"155","val2"=>"9.57"),
            array("val0"=>"543","val1"=>"194","val2"=>"6.42"),
            array("val0"=>"536","val1"=>"400","val2"=>"6.52"),
            array("val0"=>"1559","val1"=>"100","val2"=>"4.25"),
            array("val0"=>"544","val1"=>"175","val2"=>"13.5"),
            array("val0"=>"805","val1"=>"38","val2"=>"1"),
            array("val0"=>"455","val1"=>"18","val2"=>"5.79"),
            array("val0"=>"1173","val1"=>"50","val2"=>"0"),
            array("val0"=>"765","val1"=>"49","val2"=>"23.17"),
            array("val0"=>"756","val1"=>"50","val2"=>"0"),
            array("val0"=>"464","val1"=>"223","val2"=>"21.21"),
            array("val0"=>"469","val1"=>"414","val2"=>"23"),
            array("val0"=>"465","val1"=>"1253","val2"=>"19.77"),
            array("val0"=>"468","val1"=>"145","val2"=>"21"),
            array("val0"=>"467","val1"=>"460","val2"=>"20.17"),
            array("val0"=>"1695","val1"=>"892","val2"=>"30.3"),
            array("val0"=>"470","val1"=>"88","val2"=>"30.92"),
            array("val0"=>"1153","val1"=>"220","val2"=>"24.24"),
            array("val0"=>"466","val1"=>"1540","val2"=>"20.67"),
            array("val0"=>"1417","val1"=>"120","val2"=>"3.5"),
            array("val0"=>"459","val1"=>"135","val2"=>"4.5"),
            array("val0"=>"460","val1"=>"75","val2"=>"4.81"),
            array("val0"=>"461","val1"=>"32","val2"=>"2.25"),
            array("val0"=>"458","val1"=>"5","val2"=>"2.38"),
            array("val0"=>"471","val1"=>"217","val2"=>"14.9"),
            array("val0"=>"456","val1"=>"190","val2"=>"12.18"),
            array("val0"=>"457","val1"=>"346","val2"=>"22.5"),
            array("val0"=>"1687","val1"=>"175","val2"=>"32.71"),
            array("val0"=>"1808","val1"=>"283","val2"=>"19.5"),
            array("val0"=>"472","val1"=>"120","val2"=>"23.99"),
            array("val0"=>"473","val1"=>"265","val2"=>"20.38"),
            array("val0"=>"476","val1"=>"191","val2"=>"13.52"),
            array("val0"=>"1686","val1"=>"155","val2"=>"31"),
            array("val0"=>"1621","val1"=>"342","val2"=>"21.65"),
            array("val0"=>"474","val1"=>"61","val2"=>"0"),
            array("val0"=>"1438","val1"=>"71","val2"=>"16"),
            array("val0"=>"480","val1"=>"319","val2"=>"3.81"),
            array("val0"=>"485","val1"=>"20","val2"=>"2"),
            array("val0"=>"479","val1"=>"11290","val2"=>"4.29"),
            array("val0"=>"1631","val1"=>"900","val2"=>"3.5"),
            array("val0"=>"477","val1"=>"0","val2"=>"0"),
            array("val0"=>"478","val1"=>"340","val2"=>"0.88"),
            array("val0"=>"482","val1"=>"1075","val2"=>"2.29"),
            array("val0"=>"481","val1"=>"370","val2"=>"4.98"),
            array("val0"=>"1228","val1"=>"2797","val2"=>"5.6"),
            array("val0"=>"484","val1"=>"517","val2"=>"2.75"),
            array("val0"=>"2045","val1"=>"171","val2"=>"8.82"),
            array("val0"=>"2083","val1"=>"180","val2"=>"14"),
            array("val0"=>"1148","val1"=>"450","val2"=>"11.87"),
            array("val0"=>"786","val1"=>"0","val2"=>"0"),
            array("val0"=>"487","val1"=>"907","val2"=>"3.35"),
            array("val0"=>"490","val1"=>"0","val2"=>"0"),
            array("val0"=>"488","val1"=>"840","val2"=>"2.67"),
            array("val0"=>"492","val1"=>"4","val2"=>"9.5"),
            array("val0"=>"1162","val1"=>"2660","val2"=>"0.04"),
            array("val0"=>"489","val1"=>"300","val2"=>"5.86"),
            array("val0"=>"491","val1"=>"302","val2"=>"2.59"),
            array("val0"=>"1640","val1"=>"0","val2"=>"0"),
            array("val0"=>"1639","val1"=>"2538","val2"=>"3.03"),
            array("val0"=>"1551","val1"=>"863","val2"=>"5.97"),
            array("val0"=>"1554","val1"=>"32","val2"=>"9"),
            array("val0"=>"1186","val1"=>"741","val2"=>"4.49"),
            array("val0"=>"1555","val1"=>"62","val2"=>"7.3"),
            array("val0"=>"1553","val1"=>"229","val2"=>"5.5"),
            array("val0"=>"1557","val1"=>"755","val2"=>"12.49"),
            array("val0"=>"1556","val1"=>"50","val2"=>"2"),
            array("val0"=>"1166","val1"=>"4592","val2"=>"3.97"),
            array("val0"=>"1552","val1"=>"45","val2"=>"9"),
            array("val0"=>"1044","val1"=>"805","val2"=>"4.4"),
            array("val0"=>"1558","val1"=>"1174","val2"=>"5.51"),
            array("val0"=>"1345","val1"=>"500","val2"=>"15.2"),
            array("val0"=>"793","val1"=>"8","val2"=>"21.75"),
            array("val0"=>"792","val1"=>"181","val2"=>"9.68"),
            array("val0"=>"789","val1"=>"1085","val2"=>"12.53"),
            array("val0"=>"1171","val1"=>"577","val2"=>"4.5"),
            array("val0"=>"790","val1"=>"49","val2"=>"9"),
            array("val0"=>"1550","val1"=>"656","val2"=>"5.85"),
            array("val0"=>"531","val1"=>"134","val2"=>"25.46"),
            array("val0"=>"530","val1"=>"127","val2"=>"3.26"),
            array("val0"=>"1694","val1"=>"185","val2"=>"20"),
            array("val0"=>"527","val1"=>"30","val2"=>"0"),
            array("val0"=>"1560","val1"=>"228","val2"=>"2"),
            array("val0"=>"1661","val1"=>"800","val2"=>"11"),
            array("val0"=>"512","val1"=>"47","val2"=>"4.43"),
            array("val0"=>"516","val1"=>"57","val2"=>"8.94"),
            array("val0"=>"511","val1"=>"1500","val2"=>"5.97"),
            array("val0"=>"514","val1"=>"220","val2"=>"3.64"),
            array("val0"=>"518","val1"=>"3","val2"=>"11"),
            array("val0"=>"513","val1"=>"218","val2"=>"8.92"),
            array("val0"=>"500","val1"=>"886","val2"=>"9.03"),
            array("val0"=>"501","val1"=>"16","val2"=>"17.99"),
            array("val0"=>"795","val1"=>"840","val2"=>"20.42"),
            array("val0"=>"796","val1"=>"0","val2"=>"0"),
            array("val0"=>"505","val1"=>"300","val2"=>"13.38"),
            array("val0"=>"504","val1"=>"1490","val2"=>"5.63"),
            array("val0"=>"502","val1"=>"46","val2"=>"13.5"),
            array("val0"=>"1644","val1"=>"1488","val2"=>"7.85"),
            array("val0"=>"797","val1"=>"38","val2"=>"0"),
            array("val0"=>"874","val1"=>"771","val2"=>"7.54"),
            array("val0"=>"1118","val1"=>"2916","val2"=>"7.35"),
            array("val0"=>"1765","val1"=>"180","val2"=>"9"),
            array("val0"=>"1750","val1"=>"411","val2"=>"6.5"),
            array("val0"=>"553","val1"=>"30","val2"=>"20"),
            array("val0"=>"803","val1"=>"10","val2"=>"0"),
            array("val0"=>"761","val1"=>"3117","val2"=>"15"),
            array("val0"=>"759","val1"=>"6","val2"=>"-29.5"),
            array("val0"=>"2085","val1"=>"90","val2"=>"15"),
            array("val0"=>"493","val1"=>"582","val2"=>"4.08"),
            array("val0"=>"494","val1"=>"1585","val2"=>"3.22"),
            array("val0"=>"496","val1"=>"486","val2"=>"7"),
            array("val0"=>"497","val1"=>"0","val2"=>"0"),
            array("val0"=>"499","val1"=>"250","val2"=>"9"),
            array("val0"=>"1163","val1"=>"384","val2"=>"4"),
            array("val0"=>"495","val1"=>"240","val2"=>"6.82"),
            array("val0"=>"1065","val1"=>"1277","val2"=>"3.28"),
            array("val0"=>"787","val1"=>"240","val2"=>"0"),
            array("val0"=>"788","val1"=>"299","val2"=>"0"),
            array("val0"=>"1321","val1"=>"-44","val2"=>"2"),
            array("val0"=>"557","val1"=>"21476","val2"=>"1.1"),
            array("val0"=>"561","val1"=>"2865","val2"=>"3.75"),
            array("val0"=>"771","val1"=>"274","val2"=>"5"),
            array("val0"=>"768","val1"=>"400","val2"=>"3.25"),
            array("val0"=>"563","val1"=>"3956","val2"=>"2.76"),
            array("val0"=>"1320","val1"=>"2979","val2"=>"2.25"),
            array("val0"=>"562","val1"=>"7000","val2"=>"0.64"),
            array("val0"=>"566","val1"=>"9690","val2"=>"2"),
            array("val0"=>"567","val1"=>"7140","val2"=>"2.87"),
            array("val0"=>"565","val1"=>"9000","val2"=>"2.01"),
            array("val0"=>"571","val1"=>"9400","val2"=>"3.62"),
            array("val0"=>"1181","val1"=>"10408","val2"=>"1.77"),
            array("val0"=>"568","val1"=>"18418","val2"=>"2.5"),
            array("val0"=>"569","val1"=>"1818","val2"=>"1.36"),
            array("val0"=>"575","val1"=>"329","val2"=>"1.03"),
            array("val0"=>"1865","val1"=>"416","val2"=>"5")
        );
        // foreach($update_ring as $urng){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$urng['val1']."', opening_rate = '". $urng['val2'] . "' WHERE id_id =" . $urng['val0'];
        //     $this->db->query($query);
        // }
        
        $update_doghook = array(
            array("val0"=>"935","val1"=>"150","val2"=>"28.21"),
            array("val0"=>"937","val1"=>"200","val2"=>"32"),
            array("val0"=>"1531","val1"=>"20","val2"=>"28"),
            array("val0"=>"934","val1"=>"537","val2"=>"0"),
            array("val0"=>"1060","val1"=>"300","val2"=>"34.37"),
            array("val0"=>"936","val1"=>"50","val2"=>"0"),
            array("val0"=>"938","val1"=>"80","val2"=>"34"),
            array("val0"=>"933","val1"=>"220","val2"=>"29.45"),
            array("val0"=>"1532","val1"=>"0","val2"=>"0"),
            array("val0"=>"1424","val1"=>"270","val2"=>"24.5"),
            array("val0"=>"952","val1"=>"0","val2"=>"0"),
            array("val0"=>"1184","val1"=>"1175","val2"=>"21.67"),
            array("val0"=>"956","val1"=>"172","val2"=>"35.41"),
            array("val0"=>"1168","val1"=>"6057","val2"=>"29.15"),
            array("val0"=>"1705","val1"=>"590","val2"=>"20"),
            array("val0"=>"955","val1"=>"0","val2"=>"0"),
            array("val0"=>"1805","val1"=>"240","val2"=>"26"),
            array("val0"=>"939","val1"=>"358","val2"=>"31.35"),
            array("val0"=>"940","val1"=>"360","val2"=>"27.5"),
            array("val0"=>"1702","val1"=>"136","val2"=>"28"),
            array("val0"=>"941","val1"=>"438","val2"=>"29.84"),
            array("val0"=>"946","val1"=>"140","val2"=>"31.4"),
            array("val0"=>"945","val1"=>"220","val2"=>"32.89"),
            array("val0"=>"949","val1"=>"551","val2"=>"30.88"),
            array("val0"=>"950","val1"=>"0","val2"=>"0"),
            array("val0"=>"2183","val1"=>"303","val2"=>"30"),
            array("val0"=>"947","val1"=>"418","val2"=>"27"),
            array("val0"=>"948","val1"=>"64","val2"=>"28.34"),
            array("val0"=>"915","val1"=>"317","val2"=>"6.05"),
            array("val0"=>"913","val1"=>"1240","val2"=>"12.07"),
            array("val0"=>"1545","val1"=>"90","val2"=>"13"),
            array("val0"=>"917","val1"=>"513","val2"=>"20"),
            array("val0"=>"1178","val1"=>"0","val2"=>"0"),
            array("val0"=>"914","val1"=>"190","val2"=>"12.93"),
            array("val0"=>"916","val1"=>"130","val2"=>"37.45"),
            array("val0"=>"1838","val1"=>"12","val2"=>"78"),
            array("val0"=>"1690","val1"=>"300","val2"=>"28.5"),
            array("val0"=>"1849","val1"=>"40","val2"=>"30"),
            array("val0"=>"1880","val1"=>"484","val2"=>"11.29"),
            array("val0"=>"1662","val1"=>"4813","val2"=>"13.74"),
            array("val0"=>"1932","val1"=>"141","val2"=>"58"),
            array("val0"=>"1835","val1"=>"-1","val2"=>"35"),
            array("val0"=>"920","val1"=>"399","val2"=>"18.87"),
            array("val0"=>"919","val1"=>"383","val2"=>"20.48"),
            array("val0"=>"923","val1"=>"80","val2"=>"20"),
            array("val0"=>"922","val1"=>"470","val2"=>"18.67"),
            array("val0"=>"924","val1"=>"5104","val2"=>"31"),
            array("val0"=>"1167","val1"=>"4054","val2"=>"28.25"),
            array("val0"=>"1539","val1"=>"64","val2"=>"22"),
            array("val0"=>"921","val1"=>"76","val2"=>"7.3"),
            array("val0"=>"1540","val1"=>"6","val2"=>"117.18"),
            array("val0"=>"2110","val1"=>"20","val2"=>"20"),
            array("val0"=>"927","val1"=>"105","val2"=>"24.54"),
            array("val0"=>"1534","val1"=>"64","val2"=>"22.88"),
            array("val0"=>"926","val1"=>"202","val2"=>"25.27"),
            array("val0"=>"931","val1"=>"89","val2"=>"26"),
            array("val0"=>"932","val1"=>"200","val2"=>"32"),
            array("val0"=>"1620","val1"=>"220","val2"=>"12.98"),
            array("val0"=>"928","val1"=>"452","val2"=>"25.44"),
            array("val0"=>"929","val1"=>"17","val2"=>"24"),
            array("val0"=>"907","val1"=>"619","val2"=>"15.99"),
            array("val0"=>"1535","val1"=>"0","val2"=>"0"),
            array("val0"=>"906","val1"=>"247","val2"=>"23.65"),
            array("val0"=>"910","val1"=>"136","val2"=>"23.03"),
            array("val0"=>"909","val1"=>"1919","val2"=>"28.01"),
            array("val0"=>"911","val1"=>"0","val2"=>"0"),
            array("val0"=>"1536","val1"=>"0","val2"=>"0"),
            array("val0"=>"1193","val1"=>"559","val2"=>"15.53"),
            array("val0"=>"1066","val1"=>"17","val2"=>"13.61"),
            array("val0"=>"959","val1"=>"214","val2"=>"20"),
            array("val0"=>"957","val1"=>"1224","val2"=>"28"),
            array("val0"=>"958","val1"=>"68","val2"=>"13"),
            array("val0"=>"890","val1"=>"353","val2"=>"8.41"),
            array("val0"=>"1541","val1"=>"262","val2"=>"12.47"),
            array("val0"=>"888","val1"=>"1352","val2"=>"13.96"),
            array("val0"=>"1542","val1"=>"267","val2"=>"13.71"),
            array("val0"=>"892","val1"=>"-910","val2"=>"22.86"),
            array("val0"=>"1192","val1"=>"5463.06","val2"=>"15.04"),
            array("val0"=>"889","val1"=>"334","val2"=>"33.92"),
            array("val0"=>"891","val1"=>"260","val2"=>"10.63"),
            array("val0"=>"894","val1"=>"0","val2"=>"0"),
            array("val0"=>"887","val1"=>"210","val2"=>"5.6"),
            array("val0"=>"1720","val1"=>"9","val2"=>"0"),
            array("val0"=>"886","val1"=>"0","val2"=>"0")
        );
        
        // foreach($update_doghook as $udh){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$udh['val1']."', opening_rate = '". $udh['val2'] . "' WHERE id_id =" . $udh['val0'];
        //     $this->db->query($query);
        // }
        
        $update_rivet = array(
            array("val0"=>"1738","val1"=>"1910","val2"=>"1.5"),
            array("val0"=>"1758","val1"=>"2000","val2"=>"1.25"),
            array("val0"=>"1105","val1"=>"122","val2"=>"2.03"),
            array("val0"=>"1103","val1"=>"270","val2"=>"0"),
            array("val0"=>"1104","val1"=>"566","val2"=>"3.45"),
            array("val0"=>"1018","val1"=>"8000","val2"=>"5.5"),
            array("val0"=>"1786","val1"=>"378","val2"=>"5.59"),
            array("val0"=>"1106","val1"=>"1400","val2"=>"2.96"),
            array("val0"=>"2129","val1"=>"24","val2"=>"0.85"),
            array("val0"=>"837","val1"=>"165","val2"=>"2.4"),
            array("val0"=>"1733","val1"=>"1000","val2"=>"2"),
            array("val0"=>"1783","val1"=>"4261","val2"=>"2.73"),
            array("val0"=>"838","val1"=>"0","val2"=>"0"),
            array("val0"=>"1563","val1"=>"2000","val2"=>"2.91"),
            array("val0"=>"1056","val1"=>"3100","val2"=>"4"),
            array("val0"=>"1562","val1"=>"0","val2"=>"0"),
            array("val0"=>"2130","val1"=>"50","val2"=>"0.95"),
            array("val0"=>"2131","val1"=>"50","val2"=>"1"),
            array("val0"=>"2132","val1"=>"50","val2"=>"1.05"),
            array("val0"=>"2133","val1"=>"50","val2"=>"1.1"),
            array("val0"=>"2051","val1"=>"0","val2"=>"0"),
            array("val0"=>"2050","val1"=>"0","val2"=>"0"),
            array("val0"=>"2038","val1"=>"530","val2"=>"1.3"),
            array("val0"=>"807","val1"=>"270","val2"=>"0.6"),
            array("val0"=>"2049","val1"=>"400","val2"=>"1.5"),
            array("val0"=>"1114","val1"=>"5895","val2"=>"1.1"),
            array("val0"=>"1565","val1"=>"0","val2"=>"0"),
            array("val0"=>"1567","val1"=>"908","val2"=>"0.75"),
            array("val0"=>"1210","val1"=>"3000","val2"=>"3.5"),
            array("val0"=>"1822","val1"=>"7372","val2"=>"1.78"),
            array("val0"=>"1190","val1"=>"0","val2"=>"0"),
            array("val0"=>"1566","val1"=>"0","val2"=>"0"),
            array("val0"=>"1115","val1"=>"6900","val2"=>"1.2"),
            array("val0"=>"814","val1"=>"0","val2"=>"0"),
            array("val0"=>"1211","val1"=>"2000","val2"=>"1.8"),
            array("val0"=>"810","val1"=>"1450","val2"=>"0.35"),
            array("val0"=>"812","val1"=>"100","val2"=>"0.87"),
            array("val0"=>"813","val1"=>"0","val2"=>"0"),
            array("val0"=>"1737","val1"=>"4600","val2"=>"1.75"),
            array("val0"=>"2127","val1"=>"24","val2"=>"0.75"),
            array("val0"=>"1329","val1"=>"15000","val2"=>"1.7"),
            array("val0"=>"816","val1"=>"5446","val2"=>"0.73"),
            array("val0"=>"818","val1"=>"727","val2"=>"1"),
            array("val0"=>"817","val1"=>"0","val2"=>"0"),
            array("val0"=>"821","val1"=>"15","val2"=>"-9.68"),
            array("val0"=>"820","val1"=>"6124","val2"=>"2.58"),
            array("val0"=>"1189","val1"=>"10788","val2"=>"2.07"),
            array("val0"=>"815","val1"=>"783","val2"=>"2.57"),
            array("val0"=>"819","val1"=>"3397","val2"=>"0.75"),
            array("val0"=>"1293","val1"=>"10000","val2"=>"2.23"),
            array("val0"=>"1292","val1"=>"11900","val2"=>"1.75"),
            array("val0"=>"1070","val1"=>"1005","val2"=>"1.57"),
            array("val0"=>"1107","val1"=>"1711","val2"=>"1.71"),
            array("val0"=>"1108","val1"=>"6000","val2"=>"0.74"),
            array("val0"=>"1109","val1"=>"25","val2"=>"2.75"),
            array("val0"=>"1622","val1"=>"2214","val2"=>"2.25"),
            array("val0"=>"1434","val1"=>"2231","val2"=>"2.27"),
            array("val0"=>"1045","val1"=>"8344","val2"=>"1.1"),
            array("val0"=>"1749","val1"=>"990","val2"=>"1.5"),
            array("val0"=>"1670","val1"=>"0","val2"=>"0"),
            array("val0"=>"1142","val1"=>"2059","val2"=>"4.28"),
            array("val0"=>"1143","val1"=>"910","val2"=>"6.85"),
            array("val0"=>"1656","val1"=>"585","val2"=>"6"),
            array("val0"=>"2128","val1"=>"24","val2"=>"0.8"),
            array("val0"=>"1729","val1"=>"5343","val2"=>"2.75"),
            array("val0"=>"1979","val1"=>"5789","val2"=>"2.2"),
            array("val0"=>"1330","val1"=>"12783","val2"=>"2"),
            array("val0"=>"1789","val1"=>"6245","val2"=>"4.25"),
            array("val0"=>"826","val1"=>"3241","val2"=>"2.15"),
            array("val0"=>"830","val1"=>"775","val2"=>"1.82"),
            array("val0"=>"828","val1"=>"-152","val2"=>"3.59"),
            array("val0"=>"832","val1"=>"812","val2"=>"0.64"),
            array("val0"=>"833","val1"=>"20","val2"=>"0.44"),
            array("val0"=>"1570","val1"=>"2650","val2"=>"2.98"),
            array("val0"=>"1187","val1"=>"4032","val2"=>"2.2"),
            array("val0"=>"825","val1"=>"2667","val2"=>"2.75"),
            array("val0"=>"829","val1"=>"3739","val2"=>"0.44"),
            array("val0"=>"1071","val1"=>"6800","val2"=>"1.78"),
            array("val0"=>"1571","val1"=>"40","val2"=>"1"),
            array("val0"=>"1111","val1"=>"8000","val2"=>"2.38"),
            array("val0"=>"1572","val1"=>"1000","val2"=>"2.5"),
            array("val0"=>"1112","val1"=>"2339","val2"=>"2.5"),
            array("val0"=>"1573","val1"=>"2","val2"=>"3.75"),
            array("val0"=>"1188","val1"=>"550","val2"=>"1.92"),
            array("val0"=>"1046","val1"=>"4043","val2"=>"1.39"),
            array("val0"=>"1135","val1"=>"460","val2"=>"7"),
            array("val0"=>"1082","val1"=>"0","val2"=>"0"),
            array("val0"=>"1813","val1"=>"3256","val2"=>"1.72"),
            array("val0"=>"1411","val1"=>"1694","val2"=>"3"),
            array("val0"=>"1575","val1"=>"1260","val2"=>"4"),
            array("val0"=>"1576","val1"=>"425","val2"=>"6"),
            array("val0"=>"1623","val1"=>"16","val2"=>"6"),
            array("val0"=>"1574","val1"=>"5","val2"=>"6"),
        );
        
        // foreach($update_rivet as $urvt){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$urvt['val1']."', opening_rate = '". $urvt['val2'] . "' WHERE id_id =" . $urvt['val0'];
        //     $this->db->query($query);
        // }
        
        $update_btn = array(
            array("val0"=>"1288","val1"=>"7065","val2"=>"2.19"),
            array("val0"=>"1290","val1"=>"2020","val2"=>"4.06"),
            array("val0"=>"1291","val1"=>"1020","val2"=>"10.21"),
            array("val0"=>"1289","val1"=>"8060","val2"=>"0.96"),
            array("val0"=>"1195","val1"=>"0","val2"=>"0"),
            array("val0"=>"806","val1"=>"1000","val2"=>"16"),
            array("val0"=>"332","val1"=>"3992","val2"=>"8.5"),
            array("val0"=>"334","val1"=>"2099","val2"=>"8.5"),
            array("val0"=>"335","val1"=>"3250","val2"=>"4.14"),
            array("val0"=>"877","val1"=>"113","val2"=>"9.5"),
            array("val0"=>"337","val1"=>"5","val2"=>"13.04"),
            array("val0"=>"336","val1"=>"1454","val2"=>"11.7"),
            array("val0"=>"1608","val1"=>"88","val2"=>"10.5"),
            array("val0"=>"1997","val1"=>"708","val2"=>"16"),
            array("val0"=>"339","val1"=>"759","val2"=>"17"),
            array("val0"=>"338","val1"=>"200","val2"=>"10.93"),
            array("val0"=>"878","val1"=>"469","val2"=>"13"),
            array("val0"=>"1836","val1"=>"100","val2"=>"14"),
            array("val0"=>"966","val1"=>"435","val2"=>"15.06"),
            array("val0"=>"1248","val1"=>"13","val2"=>"11.5"),
            array("val0"=>"1717","val1"=>"788","val2"=>"17.6"),
            array("val0"=>"341","val1"=>"100","val2"=>"8.82"),
            array("val0"=>"342","val1"=>"10","val2"=>"13"),
            array("val0"=>"343","val1"=>"500","val2"=>"12"),
            array("val0"=>"344","val1"=>"469","val2"=>"6.88"),
            array("val0"=>"345","val1"=>"745","val2"=>"14.7"),
            array("val0"=>"347","val1"=>"67","val2"=>"14.84"),
            array("val0"=>"346","val1"=>"1084","val2"=>"14.36"),
            array("val0"=>"1017","val1"=>"2136","val2"=>"16.53"),
            array("val0"=>"880","val1"=>"280","val2"=>"20"),
            array("val0"=>"879","val1"=>"370","val2"=>"11.42"),
            array("val0"=>"1611","val1"=>"0","val2"=>"0"),
            array("val0"=>"881","val1"=>"1574","val2"=>"16.06"),
            array("val0"=>"363","val1"=>"16000","val2"=>"0.37"),
            array("val0"=>"1762","val1"=>"31300","val2"=>"1.49"),
            array("val0"=>"371","val1"=>"0","val2"=>"0"),
            array("val0"=>"372","val1"=>"29","val2"=>"2456.46"),
            array("val0"=>"1600","val1"=>"0","val2"=>"0"),
            array("val0"=>"1601","val1"=>"0","val2"=>"0"),
            array("val0"=>"373","val1"=>"0","val2"=>"0"),
            array("val0"=>"374","val1"=>"0","val2"=>"0"),
            array("val0"=>"1256","val1"=>"0","val2"=>"0"),
            array("val0"=>"1202","val1"=>"0","val2"=>"0"),
            array("val0"=>"1450","val1"=>"0","val2"=>"0"),
            array("val0"=>"2041","val1"=>"0","val2"=>"0"),
            array("val0"=>"2079","val1"=>"0","val2"=>"0"),
            array("val0"=>"2040","val1"=>"25","val2"=>"3.5"),
            array("val0"=>"364","val1"=>"509","val2"=>"2.5"),
            array("val0"=>"2048","val1"=>"200","val2"=>"26"),
            array("val0"=>"1609","val1"=>"161","val2"=>"3.17"),
            array("val0"=>"1961","val1"=>"300","val2"=>"0"),
            array("val0"=>"1675","val1"=>"570","val2"=>"12.93"),
            array("val0"=>"2039","val1"=>"25","val2"=>"4"),
            array("val0"=>"1204","val1"=>"541","val2"=>"5"),
            array("val0"=>"361","val1"=>"944","val2"=>"6.43"),
            array("val0"=>"2082","val1"=>"100","val2"=>"3.5"),
            array("val0"=>"2042","val1"=>"140","val2"=>"3.5"),
            array("val0"=>"1998","val1"=>"348","val2"=>"3.5"),
            array("val0"=>"1050","val1"=>"1035","val2"=>"4.14"),
            array("val0"=>"1610","val1"=>"400","val2"=>"1.59"),
            array("val0"=>"1072","val1"=>"901","val2"=>"8.42"),
            array("val0"=>"1095","val1"=>"870","val2"=>"8.77"),
            array("val0"=>"368","val1"=>"947","val2"=>"8.52"),
            array("val0"=>"369","val1"=>"200","val2"=>"8.5"),
            array("val0"=>"1020","val1"=>"130","val2"=>"13.37"),
            array("val0"=>"1169","val1"=>"277","val2"=>"7.92"),
            array("val0"=>"367","val1"=>"1734","val2"=>"11.19"),
            array("val0"=>"366","val1"=>"675","val2"=>"6.89"),
            array("val0"=>"1083","val1"=>"707","val2"=>"6.5"),
            array("val0"=>"1847","val1"=>"7500","val2"=>"9.87"),
            array("val0"=>"1994","val1"=>"65500","val2"=>"5.47"),
            array("val0"=>"1846","val1"=>"3420","val2"=>"14.34"),
            array("val0"=>"2194","val1"=>"8470","val2"=>"7"),
            array("val0"=>"1665","val1"=>"-140","val2"=>"-0.66"),
            array("val0"=>"356","val1"=>"5580","val2"=>"2.01"),
            array("val0"=>"358","val1"=>"6564","val2"=>"1.91"),
            array("val0"=>"357","val1"=>"5080","val2"=>"1.63"),
            array("val0"=>"355","val1"=>"5080","val2"=>"1.64"),
            array("val0"=>"359","val1"=>"605","val2"=>"1.99"),
            array("val0"=>"360","val1"=>"2700","val2"=>"2.89"),
            array("val0"=>"2078","val1"=>"0","val2"=>"0")
        );
        // foreach($update_btn as $ubtn){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ubtn['val1']."', opening_rate = '". $ubtn['val2'] . "' WHERE id_id =" . $ubtn['val0'];
        //     $this->db->query($query);
        // }
        
        $update_logo = array(
            array("val0"=>"1331","val1"=>"2000","val2"=>"0"),
            array("val0"=>"1360","val1"=>"610","val2"=>"0"),
            array("val0"=>"993","val1"=>"60","val2"=>"0"),
            array("val0"=>"986","val1"=>"2354","val2"=>"18"),
            array("val0"=>"1353","val1"=>"370","val2"=>"0"),
            array("val0"=>"1352","val1"=>"2260","val2"=>"0"),
        );
        // foreach($update_logo as $ulogo){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ulogo['val1']."', opening_rate = '". $ulogo['val2'] . "' WHERE id_id =" . $ulogo['val0'];
        //     $this->db->query($query);
        // }
        
        $update_nylon = array(
            array("val0"=>"1295","val1"=>"0","val2"=>"0"),
            array("val0"=>"2014","val1"=>"260","val2"=>"20"),
            array("val0"=>"1365","val1"=>"0","val2"=>"0"),
            array("val0"=>"2016","val1"=>"0","val2"=>"0"),
            array("val0"=>"2015","val1"=>"0","val2"=>"0"),
            array("val0"=>"2017","val1"=>"0","val2"=>"0"),
            array("val0"=>"2018","val1"=>"0","val2"=>"0"),
            array("val0"=>"2189","val1"=>"200","val2"=>"18"),
            array("val0"=>"1212","val1"=>"1124","val2"=>"24.25"),
            array("val0"=>"1234","val1"=>"0","val2"=>"0"),
            array("val0"=>"1213","val1"=>"1601","val2"=>"26.4"),
            array("val0"=>"1366","val1"=>"0","val2"=>"0"),
            array("val0"=>"1237","val1"=>"0","val2"=>"0"),
            array("val0"=>"1304","val1"=>"0","val2"=>"0"),
            array("val0"=>"1370","val1"=>"0","val2"=>"0"),
            array("val0"=>"2190","val1"=>"500","val2"=>"20"),
            array("val0"=>"1341","val1"=>"12100","val2"=>"3"),
            array("val0"=>"1945","val1"=>"0","val2"=>"0"),
            array("val0"=>"1214","val1"=>"1000","val2"=>"24"),
            array("val0"=>"1215","val1"=>"1234","val2"=>"29.75"),
            array("val0"=>"1367","val1"=>"0","val2"=>"0"),
            array("val0"=>"1943","val1"=>"0","val2"=>"0"),
            array("val0"=>"1856","val1"=>"0","val2"=>"0"),
            array("val0"=>"2191","val1"=>"300","val2"=>"23"),
            array("val0"=>"2171","val1"=>"420","val2"=>"25"),
            array("val0"=>"1896","val1"=>"0","val2"=>"0"),
            array("val0"=>"1216","val1"=>"594","val2"=>"40.95"),
            array("val0"=>"1217","val1"=>"1569","val2"=>"63.22"),
            array("val0"=>"1754","val1"=>"1090","val2"=>"44.5"),
            array("val0"=>"1883","val1"=>"0","val2"=>"0"),
            array("val0"=>"1884","val1"=>"0","val2"=>"0"),
            array("val0"=>"2195","val1"=>"462","val2"=>"40.91")
        );
        
        // foreach($update_nylon as $unylon){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$unylon['val1']."', opening_rate = '". $unylon['val2'] . "' WHERE id_id =" . $unylon['val0'];
        //     $this->db->query($query);
        // }
        
        $update_pm = array(
            array("val0"=>"1984","val1"=>"0","val2"=>"0"),
            array("val0"=>"1391","val1"=>"0","val2"=>"0"),
            array("val0"=>"525","val1"=>"0","val2"=>"0"),
            array("val0"=>"550","val1"=>"0","val2"=>"0"),
            array("val0"=>"1285","val1"=>"0","val2"=>"0"),
            array("val0"=>"1936","val1"=>"0","val2"=>"0"),
            array("val0"=>"2026","val1"=>"0","val2"=>"0"),
            array("val0"=>"1286","val1"=>"0","val2"=>"0"),
            array("val0"=>"2149","val1"=>"0","val2"=>"0"),
            array("val0"=>"1941","val1"=>"0","val2"=>"0"),
            array("val0"=>"677","val1"=>"224","val2"=>"17"),
            array("val0"=>"678","val1"=>"76","val2"=>"21"),
            array("val0"=>"1925","val1"=>"0","val2"=>"0"),
            array("val0"=>"1787","val1"=>"0","val2"=>"0"),
            array("val0"=>"1982","val1"=>"104","val2"=>"15"),
            array("val0"=>"2027","val1"=>"2","val2"=>"650"),
            array("val0"=>"529","val1"=>"0","val2"=>"0"),
            array("val0"=>"551","val1"=>"427","val2"=>"18.4"),
            array("val0"=>"679","val1"=>"940","val2"=>"49.88"),
            array("val0"=>"680","val1"=>"1036","val2"=>"44.69"),
            array("val0"=>"552","val1"=>"3096","val2"=>"27.2"),
            array("val0"=>"532","val1"=>"0","val2"=>"0"),
            array("val0"=>"1933","val1"=>"140","val2"=>"18"),
            array("val0"=>"682","val1"=>"120","val2"=>"79.92"),
            array("val0"=>"683","val1"=>"145","val2"=>"80.28"),
            array("val0"=>"1205","val1"=>"0","val2"=>"0"),
            array("val0"=>"684","val1"=>"0","val2"=>"0"),
            array("val0"=>"1981","val1"=>"60","val2"=>"115"),
            array("val0"=>"1944","val1"=>"0","val2"=>"0"),
            array("val0"=>"685","val1"=>"322","val2"=>"109"),
            array("val0"=>"686","val1"=>"62","val2"=>"113"),
            array("val0"=>"1869","val1"=>"5","val2"=>"126"),
            array("val0"=>"534","val1"=>"60","val2"=>"74"),
            array("val0"=>"542","val1"=>"0","val2"=>"0"),
            array("val0"=>"1812","val1"=>"550","val2"=>"12.67"),
            array("val0"=>"689","val1"=>"2750","val2"=>"0.84"),
            array("val0"=>"690","val1"=>"7200","val2"=>"0.51"),
            array("val0"=>"688","val1"=>"16300","val2"=>"0.03"),
            array("val0"=>"687","val1"=>"95500","val2"=>"0.05"),
            array("val0"=>"576","val1"=>"3.5","val2"=>"157"),
            array("val0"=>"1364","val1"=>"16000","val2"=>"0.25"),
            array("val0"=>"1804","val1"=>"19150","val2"=>"0.39"),
            array("val0"=>"549","val1"=>"0","val2"=>"0"),
            array("val0"=>"667","val1"=>"1900","val2"=>"2.15"),
            array("val0"=>"1363","val1"=>"0","val2"=>"0"),
            array("val0"=>"670","val1"=>"210.86","val2"=>"160"),
            array("val0"=>"1362","val1"=>"34900","val2"=>"0.3"),
            array("val0"=>"1400","val1"=>"11325","val2"=>"0.29"),
            array("val0"=>"1472","val1"=>"80","val2"=>"163"),
            array("val0"=>"671","val1"=>"17","val2"=>"97.3"),
            array("val0"=>"672","val1"=>"353","val2"=>"25.68"),
            array("val0"=>"1361","val1"=>"38000","val2"=>"0.38"),
            array("val0"=>"673","val1"=>"4","val2"=>"1276.79"),
            array("val0"=>"674","val1"=>"36","val2"=>"285"),
            array("val0"=>"1882","val1"=>"23850","val2"=>"0.85"),
            array("val0"=>"668","val1"=>"416","val2"=>"120"),
            array("val0"=>"554","val1"=>"0","val2"=>"0"),
            array("val0"=>"555","val1"=>"40","val2"=>"65"),
            array("val0"=>"2212","val1"=>"720","val2"=>"5"),
            array("val0"=>"675","val1"=>"3","val2"=>"127")
        );
        // foreach($update_pm as $upm){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$upm['val1']."', opening_rate = '". $upm['val2'] . "' WHERE id_id =" . $upm['val0'];
        //     $this->db->query($query);
        // }
        
        $update_cards = array(
            array("val0"=>"1657","val1"=>"35900","val2"=>"0.43"),
            array("val0"=>"1811","val1"=>"2500","val2"=>"0.5"),
            array("val0"=>"1096","val1"=>"2650","val2"=>"10.5"),
            array("val0"=>"1097","val1"=>"3310","val2"=>"13.44"),
            array("val0"=>"1392","val1"=>"23200","val2"=>"1.1"),
            array("val0"=>"1718","val1"=>"4100","val2"=>"11.28"),
            array("val0"=>"1885","val1"=>"37600","val2"=>"0.4"),
            array("val0"=>"1658","val1"=>"14350","val2"=>"2.9"),
            array("val0"=>"1342","val1"=>"3000","val2"=>"2.9"),
            array("val0"=>"1099","val1"=>"2200","val2"=>"1.25"),
            array("val0"=>"1344","val1"=>"32000","val2"=>"0.32"),
            array("val0"=>"2120","val1"=>"250","val2"=>"0.7"),
            array("val0"=>"1326","val1"=>"80600","val2"=>"0.15"),
            array("val0"=>"1101","val1"=>"4100","val2"=>"0.8"),
            array("val0"=>"1368","val1"=>"54820","val2"=>"3.85"),
            array("val0"=>"1325","val1"=>"246900","val2"=>"0.2"),
            array("val0"=>"1324","val1"=>"5400","val2"=>"0.25")
        );
        // foreach($update_cards as $ucrd){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ucrd['val1']."', opening_rate = '". $ucrd['val2'] . "' WHERE id_id =" . $ucrd['val0'];
        //     $this->db->query($query);
        // }
        
        $update_gift = array(
            array("val0"=>"2022","val1"=>"0","val2"=>"0"),
            array("val0"=>"2023","val1"=>"0","val2"=>"0"),
            array("val0"=>"1659","val1"=>"0","val2"=>"0"),
            array("val0"=>"720","val1"=>"0","val2"=>"0"),
            array("val0"=>"725","val1"=>"2447","val2"=>"20"),
            array("val0"=>"726","val1"=>"737","val2"=>"20"),
            array("val0"=>"1518","val1"=>"0","val2"=>"0"),
            array("val0"=>"728","val1"=>"650","val2"=>"35"),
            array("val0"=>"729","val1"=>"650","val2"=>"30"),
            array("val0"=>"730","val1"=>"2783","val2"=>"27"),
            array("val0"=>"2148","val1"=>"0","val2"=>"0"),
            array("val0"=>"2003","val1"=>"350","val2"=>"37"),
            array("val0"=>"1803","val1"=>"150","val2"=>"38"),
            array("val0"=>"1862","val1"=>"0","val2"=>"0"),
            array("val0"=>"1863","val1"=>"430","val2"=>"35"),
            array("val0"=>"733","val1"=>"0","val2"=>"0"),
            array("val0"=>"732","val1"=>"0","val2"=>"0"),
            array("val0"=>"1966","val1"=>"1600","val2"=>"50"),
            array("val0"=>"1359","val1"=>"300","val2"=>"50"),
            array("val0"=>"736","val1"=>"5100","val2"=>"20"),
            array("val0"=>"735","val1"=>"174","val2"=>"25"),
            array("val0"=>"737","val1"=>"0","val2"=>"0"),
            array("val0"=>"738","val1"=>"1010","val2"=>"33.49"),
            array("val0"=>"734","val1"=>"1750","val2"=>"40"),
            array("val0"=>"1931","val1"=>"1000","val2"=>"42"),
            array("val0"=>"740","val1"=>"0","val2"=>"0"),
            array("val0"=>"741","val1"=>"100","val2"=>"40")
        );
        // foreach($update_gift as $ugift){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ugift['val1']."', opening_rate = '". $ugift['val2'] . "' WHERE id_id =" . $ugift['val0'];
        //     $this->db->query($query);
        // }
        
        $update_br = array(
            array("val0"=>"2247","val1"=>"0","val2"=>"0"),
            array("val0"=>"2236","val1"=>"0","val2"=>"0"),
            array("val0"=>"1855","val1"=>"5","val2"=>"210"),
            array("val0"=>"2135","val1"=>"1","val2"=>"550"),
            array("val0"=>"2233","val1"=>"4.42","val2"=>"7030"),
            array("val0"=>"2230","val1"=>"0","val2"=>"0"),
            array("val0"=>"2134","val1"=>"1","val2"=>"640"),
            array("val0"=>"2232","val1"=>"2","val2"=>"7705"),
            array("val0"=>"1747","val1"=>"4","val2"=>"226.25"),
            array("val0"=>"1032","val1"=>"115","val2"=>"143.91"),
            array("val0"=>"2206","val1"=>"0","val2"=>"0"),
            array("val0"=>"1031","val1"=>"57","val2"=>"297.81"),
            array("val0"=>"1030","val1"=>"25","val2"=>"260"),
            array("val0"=>"2240","val1"=>"0","val2"=>"0"),
            array("val0"=>"1303","val1"=>"115","val2"=>"44.58"),
            array("val0"=>"824","val1"=>"4","val2"=>"90"),
            array("val0"=>"1092","val1"=>"108","val2"=>"62"),
            array("val0"=>"2248","val1"=>"47.48","val2"=>"229.96"),
            array("val0"=>"1386","val1"=>"50","val2"=>"124.7"),
            array("val0"=>"1947","val1"=>"10","val2"=>"135"),
            array("val0"=>"1394","val1"=>"20","val2"=>"80"),
            array("val0"=>"1395","val1"=>"19","val2"=>"80"),
            array("val0"=>"1396","val1"=>"190","val2"=>"115"),
            array("val0"=>"1028","val1"=>"3","val2"=>"105")
        );
        
        // foreach($update_br as $ubr){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ubr['val1']."', opening_rate = '". $ubr['val2'] . "' WHERE id_id =" . $ubr['val0'];
        //     $this->db->query($query);
        // }
        
        $update_chem = array(
            array("val0"=>"2021","val1"=>"0","val2"=>"0"),
            array("val0"=>"695","val1"=>"0","val2"=>"0"),
            array("val0"=>"1939","val1"=>"0","val2"=>"0"),
            array("val0"=>"1985","val1"=>"0","val2"=>"0"),
            array("val0"=>"1864","val1"=>"0","val2"=>"0"),
            array("val0"=>"696","val1"=>"0","val2"=>"0"),
            array("val0"=>"697","val1"=>"5","val2"=>"5274"),
            array("val0"=>"699","val1"=>"0","val2"=>"0"),
            array("val0"=>"1577","val1"=>"0","val2"=>"0"),
            array("val0"=>"2084","val1"=>"5","val2"=>"981"),
            array("val0"=>"1457","val1"=>"0","val2"=>"0"),
            array("val0"=>"1376","val1"=>"0","val2"=>"0"),
            array("val0"=>"1377","val1"=>"0","val2"=>"0"),
            array("val0"=>"1134","val1"=>"0","val2"=>"0"),
            array("val0"=>"705","val1"=>"7","val2"=>"854"),
            array("val0"=>"709","val1"=>"7","val2"=>"650"),
            array("val0"=>"706","val1"=>"1","val2"=>"565"),
            array("val0"=>"707","val1"=>"0","val2"=>"0"),
            array("val0"=>"1935","val1"=>"2","val2"=>"565"),
            array("val0"=>"708","val1"=>"0","val2"=>"0"),
            array("val0"=>"1934","val1"=>"0","val2"=>"0"),
            array("val0"=>"1467","val1"=>"2","val2"=>"662.5"),
            array("val0"=>"710","val1"=>"111","val2"=>"252.85"),
            array("val0"=>"1977","val1"=>"0","val2"=>"0"),
            array("val0"=>"1379","val1"=>"0","val2"=>"0"),
            array("val0"=>"1751","val1"=>"0","val2"=>"0"),
            array("val0"=>"1380","val1"=>"2","val2"=>"877"),
            array("val0"=>"711","val1"=>"27","val2"=>"3124.56"),
            array("val0"=>"712","val1"=>"25","val2"=>"1647.2"),
            array("val0"=>"713","val1"=>"34","val2"=>"1443.82"),
            array("val0"=>"714","val1"=>"50","val2"=>"730.8"),
            array("val0"=>"2088","val1"=>"20","val2"=>"95"),
            array("val0"=>"1940","val1"=>"0","val2"=>"0"),
            array("val0"=>"715","val1"=>"0","val2"=>"0")
        );
        
        // foreach($update_chem as $uch){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$uch['val1']."', opening_rate = '". $uch['val2'] . "' WHERE id_id =" . $uch['val0'];
        //     $this->db->query($query);
        // }
        
        $update_thread = array (
          0 => 
          array (
            'val0' => '1606',
            'val1' => '10',
            'val2' => '507.78',
          ),
          1 => 
          array (
            'val0' => '1314',
            'val1' => '4',
            'val2' => '202.46',
          ),
          2 => 
          array (
            'val0' => '1315',
            'val1' => '25',
            'val2' => '196.68',
          ),
          3 => 
          array (
            'val0' => '1302',
            'val1' => '34',
            'val2' => '202.46',
          ),
          4 => 
          array (
            'val0' => '2216',
            'val1' => '17',
            'val2' => '202.46',
          ),
          5 => 
          array (
            'val0' => '1310',
            'val1' => '2',
            'val2' => '192.82',
          ),
          6 => 
          array (
            'val0' => '1300',
            'val1' => '4',
            'val2' => '189.04',
          ),
          7 => 
          array (
            'val0' => '1311',
            'val1' => '3',
            'val2' => '189.04',
          ),
          8 => 
          array (
            'val0' => '1308',
            'val1' => '20',
            'val2' => '202.48',
          ),
          9 => 
          array (
            'val0' => '1309',
            'val1' => '34',
            'val2' => '202.46',
          ),
          10 => 
          array (
            'val0' => '2059',
            'val1' => '17',
            'val2' => '202.46',
          ),
          11 => 
          array (
            'val0' => '1316',
            'val1' => '28',
            'val2' => '202.46',
          ),
          12 => 
          array (
            'val0' => '1313',
            'val1' => '16',
            'val2' => '284.23',
          ),
          13 => 
          array (
            'val0' => '1299',
            'val1' => '44',
            'val2' => '202.46',
          ),
          14 => 
          array (
            'val0' => '1800',
            'val1' => '2',
            'val2' => '169.88',
          ),
          15 => 
          array (
            'val0' => '1266',
            'val1' => '1',
            'val2' => '84.89',
          ),
          16 => 
          array (
            'val0' => '2029',
            'val1' => '117',
            'val2' => '125',
          ),
          17 => 
          array (
            'val0' => '1272',
            'val1' => '4',
            'val2' => '112.35',
          ),
          18 => 
          array (
            'val0' => '1275',
            'val1' => '17',
            'val2' => '112.35',
          ),
          19 => 
          array (
            'val0' => '1270',
            'val1' => '59',
            'val2' => '112.35',
          ),
          20 => 
          array (
            'val0' => '1284',
            'val1' => '57',
            'val2' => '112.35',
          ),
          21 => 
          array (
            'val0' => '1775',
            'val1' => '1',
            'val2' => '112.35',
          ),
          22 => 
          array (
            'val0' => '1252',
            'val1' => '58',
            'val2' => '112.35',
          ),
          23 => 
          array (
            'val0' => '1776',
            'val1' => '49',
            'val2' => '112.35',
          ),
          24 => 
          array (
            'val0' => '1278',
            'val1' => '52',
            'val2' => '112.35',
          ),
          25 => 
          array (
            'val0' => '2012',
            'val1' => '30',
            'val2' => '89.54',
          ),
          26 => 
          array (
            'val0' => '1280',
            'val1' => '29',
            'val2' => '112.35',
          ),
          27 => 
          array (
            'val0' => '1782',
            'val1' => '20',
            'val2' => '497.84',
          ),
          28 => 
          array (
            'val0' => '1460',
            'val1' => '10',
            'val2' => '533.17',
          ),
          29 => 
          array (
            'val0' => '1799',
            'val1' => '8',
            'val2' => '507.78',
          ),
          30 => 
          array (
            'val0' => '1781',
            'val1' => '20',
            'val2' => '497.84',
          ),
          31 => 
          array (
            'val0' => '1798',
            'val1' => '27',
            'val2' => '526.59',
          ),
          32 => 
          array (
            'val0' => '1778',
            'val1' => '7',
            'val2' => '497.83',
          ),
          33 => 
          array (
            'val0' => '1986',
            'val1' => '20',
            'val2' => '533.17',
          ),
          34 => 
          array (
            'val0' => '1262',
            'val1' => '20',
            'val2' => '84.89',
          ),
          35 => 
          array (
            'val0' => '1260',
            'val1' => '56',
            'val2' => '85',
          ),
          36 => 
          array (
            'val0' => '1259',
            'val1' => '12',
            'val2' => '84.89',
          ),
          37 => 
          array (
            'val0' => '963',
            'val1' => '236',
            'val2' => '226.13',
          ),
          38 => 
          array (
            'val0' => '965',
            'val1' => '57',
            'val2' => '159.48',
          ),
          39 => 
          array (
            'val0' => '2244',
            'val1' => '1',
            'val2' => '99.5',
          ),
          40 => 
          array (
            'val0' => '1407',
            'val1' => '14',
            'val2' => '146.02',
          ),
          41 => 
          array (
            'val0' => '2211',
            'val1' => '18',
            'val2' => '202.46',
          ),
          42 => 
          array (
            'val0' => '1902',
            'val1' => '2',
            'val2' => '103.24',
          ),
          43 => 
          array (
            'val0' => '1893',
            'val1' => '8',
            'val2' => '103.24',
          ),
          44 => 
          array (
            'val0' => '1901',
            'val1' => '6',
            'val2' => '103.24',
          ),
          45 => 
          array (
            'val0' => '1911',
            'val1' => '15',
            'val2' => '103.24',
          ),
          46 => 
          array (
            'val0' => '1910',
            'val1' => '9',
            'val2' => '103.24',
          ),
          47 => 
          array (
            'val0' => '1908',
            'val1' => '15',
            'val2' => '103.24',
          ),
          48 => 
          array (
            'val0' => '1894',
            'val1' => '2',
            'val2' => '103.24',
          ),
          49 => 
          array (
            'val0' => '1895',
            'val1' => '2',
            'val2' => '103.24',
          ),
          50 => 
          array (
            'val0' => '1904',
            'val1' => '12',
            'val2' => '103.24',
          ),
          51 => 
          array (
            'val0' => '1907',
            'val1' => '6',
            'val2' => '103.24',
          ),
          52 => 
          array (
            'val0' => '1892',
            'val1' => '170',
            'val2' => '122.44',
          ),
          53 => 
          array (
            'val0' => '2222',
            'val1' => '7',
            'val2' => '108.4',
          ),
          54 => 
          array (
            'val0' => '2221',
            'val1' => '2',
            'val2' => '108.4',
          ),
          55 => 
          array (
            'val0' => '2207',
            'val1' => '15',
            'val2' => '108.4',
          ),
          56 => 
          array (
            'val0' => '1815',
            'val1' => '26',
            'val2' => '130.62',
          ),
          57 => 
          array (
            'val0' => '1825',
            'val1' => '71',
            'val2' => '137.15',
          ),
          58 => 
          array (
            'val0' => '1402',
            'val1' => '41',
            'val2' => '137.15',
          ),
          59 => 
          array (
            'val0' => '1356',
            'val1' => '63',
            'val2' => '137.15',
          ),
          60 => 
          array (
            'val0' => '1269',
            'val1' => '24',
            'val2' => '137.15',
          ),
          61 => 
          array (
            'val0' => '1358',
            'val1' => '24',
            'val2' => '131.85',
          ),
          62 => 
          array (
            'val0' => '1403',
            'val1' => '18',
            'val2' => '130.88',
          ),
          63 => 
          array (
            'val0' => '1406',
            'val1' => '10',
            'val2' => '137.15',
          ),
          64 => 
          array (
            'val0' => '1463',
            'val1' => '22',
            'val2' => '137.15',
          ),
          65 => 
          array (
            'val0' => '1401',
            'val1' => '37',
            'val2' => '137.15',
          ),
          66 => 
          array (
            'val0' => '1404',
            'val1' => '27',
            'val2' => '137.15',
          ),
          67 => 
          array (
            'val0' => '1464',
            'val1' => '16',
            'val2' => '137.15',
          ),
          68 => 
          array (
            'val0' => '2075',
            'val1' => '20',
            'val2' => '137.15',
          ),
          69 => 
          array (
            'val0' => '2061',
            'val1' => '6',
            'val2' => '99.5',
          ),
          70 => 
          array (
            'val0' => '2062',
            'val1' => '10',
            'val2' => '99.5',
          ),
          71 => 
          array (
            'val0' => '1287',
            'val1' => '62',
            'val2' => '99.5',
          ),
          72 => 
          array (
            'val0' => '1928',
            'val1' => '58',
            'val2' => '98.85',
          ),
          73 => 
          array (
            'val0' => '1912',
            'val1' => '42',
            'val2' => '99.5',
          ),
          74 => 
          array (
            'val0' => '1839',
            'val1' => '61',
            'val2' => '99.42',
          ),
          75 => 
          array (
            'val0' => '2108',
            'val1' => '21',
            'val2' => '99.5',
          ),
          76 => 
          array (
            'val0' => '2107',
            'val1' => '50',
            'val2' => '99.5',
          ),
          77 => 
          array (
            'val0' => '1837',
            'val1' => '1',
            'val2' => '94.76',
          ),
          78 => 
          array (
            'val0' => '2060',
            'val1' => '2',
            'val2' => '99.5',
          ),
          79 => 
          array (
            'val0' => '1276',
            'val1' => '39',
            'val2' => '98.41',
          ),
          80 => 
          array (
            'val0' => '2106',
            'val1' => '19',
            'val2' => '99.5',
          ),
          81 => 
          array (
            'val0' => '1279',
            'val1' => '10',
            'val2' => '82',
          ),
          82 => 
          array (
            'val0' => '1273',
            'val1' => '1',
            'val2' => '82',
          ),
          83 => 
          array (
            'val0' => '2226',
            'val1' => '10',
            'val2' => '99.5',
          )
        );
        // foreach($update_thread as $uth){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$uth['val1']."', opening_rate = '". $uth['val2'] . "' WHERE id_id =" . $uth['val0'];
        //     $this->db->query($query);
        // }
        
        
        $update_trans = array(
            array("val0"=>"2112","val1"=>"200","val2"=>"130"),
            array("val0"=>"1267","val1"=>"1319.46","val2"=>"130.48"),
            array("val0"=>"1241","val1"=>"1514","val2"=>"128.8"),
            array("val0"=>"1298","val1"=>"642.07","val2"=>"85.74"),
            array("val0"=>"191","val1"=>"250","val2"=>"127.2"),
        );
        // foreach($update_trans as $utrns){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$utrns['val1']."', opening_rate = '". $utrns['val2'] . "' WHERE id_id =" . $utrns['val0'];
        //     $this->db->query($query);
        // }
        
        $update_lock =  array(
            array("val0"=>"971","val1"=>"164","val2"=>"31.56"),
            array("val0"=>"1724","val1"=>"5","val2"=>"1909.2"),
            array("val0"=>"974","val1"=>"1310","val2"=>"0.96"),
            array("val0"=>"1509","val1"=>"914","val2"=>"11.07"),
            array("val0"=>"2187","val1"=>"408","val2"=>"7.65"),
            array("val0"=>"1415","val1"=>"64","val2"=>"62.53"),
            array("val0"=>"1507","val1"=>"20","val2"=>"30"),
            array("val0"=>"968","val1"=>"15","val2"=>"59"),
            array("val0"=>"973","val1"=>"72","val2"=>"171.25"),
            array("val0"=>"1682","val1"=>"100","val2"=>"160"),
            array("val0"=>"2024","val1"=>"10","val2"=>"46"),
            array("val0"=>"2063","val1"=>"16","val2"=>"64.75"),
            array("val0"=>"1996","val1"=>"10","val2"=>"45"),
            array("val0"=>"2154","val1"=>"5","val2"=>"52"),
            array("val0"=>"976","val1"=>"25","val2"=>"0.01"),
        );
        // foreach($update_lock as $ulck){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ulck['val1']."', opening_rate = '". $ulck['val2'] . "' WHERE id_id =" . $ulck['val0'];
        //     $this->db->query($query);
        // }
        
        
        $update_eye = array(
            array("val0"=>"1519","val1"=>"720","val2"=>"0.5"),
            array("val0"=>"1242","val1"=>"682","val2"=>"2.25"),
            array("val0"=>"1206","val1"=>"2271","val2"=>"3.64"),
            array("val0"=>"1027","val1"=>"12090","val2"=>"0.32"),
            array("val0"=>"1522","val1"=>"325","val2"=>"4.5"),
            array("val0"=>"1692","val1"=>"5000","val2"=>"5"),
            array("val0"=>"1416","val1"=>"1000","val2"=>"2.35")
        );
        // foreach($update_eye as $ueye){
        //     $query = "UPDATE item_dtl SET opening_stock = '".$ueye['val1']."', opening_rate = '". $ueye['val2'] . "' WHERE id_id =" . $ueye['val0'];
        //     $this->db->query($query);
        // }
        
        $update_jobber_employee = array(
        	0 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. SIRAJ UDDIN',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE GULZAR ALI',
        		'address' => 'VILL:- NARAYAN PUR METO PARA, WEST BERA,BERI, P.O.:- R. GOPAL PUR,DIST.:- 24, PGS (N)',
        		'dob' => '1962-01-01',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5149789',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/207',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	1 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. KHURSHID ALAM',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE MD. SULTAN ALAM',
        		'address' => 'NARAYAN PUR, WEST BERA BERI,P.O.:- R. GOPAL PUR, P.S.:-AIR PORT,DIST.:- 24 PGS(N).PIN:- 700 136',
        		'dob' => '1969-10-14',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4005149787',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/81',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	2 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. KALIMUDDIN',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'MD. HANIF ANSARI',
        		'address' => 'NARAYAN PUR METO PARA, WEST BERA BERI,P.O.:- R. GOPAL PUR,P.S. :- AIR PORT,DIST:- 24PGS[N], PIN:- 700 136',
        		'dob' => '1972-01-01',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5523827',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/82',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	3 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. ZULFEKAR ALAM',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE MD. ABUL HASSAN',
        		'address' => 'NARAYAN PUR WEST BERA BERI,P.O.:- R. GOPAL PUR,P.S.:- AIR PORT,DIST.:- 24 PGS(N), PIN:- 700136',
        		'dob' => '1974-03-30',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5149788',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/205',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	4 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. RIZWAN ANSARI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE MD. ASGAR ANSARI',
        		'address' => 'NARAYAN PUR METO PARA, WEST BERA BERI,P.O.:- R. GOPAL PUR, P.S.:- AIR PORT.,IDST:- 24 PGS[N].PIN:- 700 136',
        		'dob' => '1979-02-21',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5600888',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/193',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	5 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. RIZWAN',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'MD. KAYUM',
        		'address' => 'NARAYAN PUR WEST BERA BERI,P.O.:- R. GOPAL PUR, P.S.:- AIRPORT,DIST.:- 24 PGS[N], PIN:- 700 136',
        		'dob' => '1982-01-20',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/239',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	6 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. ANWAR ANSARI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'MD. HANIF ANSARI',
        		'address' => 'NARAYAN PUR WEST BERA BERI,P.O.:- R. GOPAL PUR, P.S.:- AIR PORT,DIST.:- 24 PGS[N]. PIN:- 700 136',
        		'dob' => '1976-01-01',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5149790',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/192',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	7 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'SHAID AKHTAR',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/301',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	8 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'SK. MOINUDDIN',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	9 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. ASRAF ALI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE MD. RAJJAK ALI',
        		'address' => 'NARAYAN PUR WEST BERA BERI,P.O.:- R. GOPAL PUR, P.S. :- AIR PORT,DIST.:- 24 PGS[N] PIN:- 700 136',
        		'dob' => '1971-08-16',
        		'doj' => '1970-01-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5523832',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => 'WB/CA/28730/284',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	10 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. NASIM ANSARI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2005-09-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	11 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'SK. ARSAD',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2006-09-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	12 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. JALALUDDIN ANSARI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2007-02-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5536841',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	13 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'SK. HAIDER ALI',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2007-03-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '5536842',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	14 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. RIAZ',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => '',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2007-03-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	15 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD. SAHID ALAM',
        		'working_place' => '',
        		'gender' => '',
        		'father_name' => 'LATE MD. SULTAN',
        		'address' => ',,',
        		'dob' => '',
        		'doj' => '2007-11-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4005617634',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	16 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MOHAMMED AFTAF',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD IFTIKHER',
        		'address' => 'WEST BERA BERI, R GOPAL PUR,KOLKATA-700136,',
        		'dob' => '1977-11-18',
        		'doj' => '2014-06-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4020116443',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	17 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD BABAR ANSARI',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD KALIM ANSARI',
        		'address' => 'NARAYAN PUR, WEST BERABERI, R GOPAL PUR,NORTH 24 PGS,700136',
        		'dob' => '1990-08-28',
        		'doj' => '2013-11-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	18 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'HASAN IMAM',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD SIRAJUDDIN',
        		'address' => ',,',
        		'dob' => '1990-02-10',
        		'doj' => '2019-09-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	19 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD AZHAR UDDIN',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD SERAZUDDIN',
        		'address' => ',,',
        		'dob' => '1993-06-26',
        		'doj' => '2019-09-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	20 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD MAKSUD ANSARI',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD SAKUR MISTRY',
        		'address' => ',,',
        		'dob' => '1978-03-16',
        		'doj' => '2019-09-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	21 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'SEKH ARSAD',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'SEKH DILSAD',
        		'address' => ',NARAYAN PUR, WEST BERABERI, RAJARHAT GOP,',
        		'dob' => '1987-06-10',
        		'doj' => '2021-05-03',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4020885356',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '101683260736',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	22 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD AFSAR',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD IFTEKHAR',
        		'address' => 'PASCHIM BERABERI, NARAYAN PUR, R GOPAL P,,',
        		'dob' => '1991-01-02',
        		'doj' => '2021-07-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4020899354',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '101701864975',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        	23 => array(
        		'c_id' => '2',
        		'emp_type' => 'Jobber',
        		'e_code' => '',
        		'name' => 'MD SAIMUDDIN',
        		'working_place' => 'Factory',
        		'gender' => '',
        		'father_name' => 'MD FAKRUDDIN',
        		'address' => 'NARAYAN PUR, WEST BERABERI, R. GOPAL PUR,KOLKATA 700136,',
        		'dob' => '1992-11-28',
        		'doj' => '2021-07-01',
        		'd_id' => '7',
        		'esi' => '1',
        		'esi_acc_no' => '4020899386',
        		'esi_percentage' => '',
        		'pf' => '1',
        		'pf_acc_no' => '101701942681',
        		'pf_percentage' => '5.00',
        		'pf_percentage_calculation' => '',
        		'basic_pay' => '',
        		'hra_percentage' => '',
        		'hra_amount' => '',
        		'cl_granted' => '',
        		'cl_adjusted' => '',
        		'cl_balance' => '',
        		'el_granted' => '',
        		'el_adjusted' => '',
        		'el_balance' => '',
        		'ol_granted' => '',
        		'ol_adjusted' => '',
        		'ol_balance' => '',
        		'insurance' => '',
        		'cutting_rate' => '',
        		'picture' => ''
        	),
        );
        
        foreach($update_jobber_employee as $uje){
            $this->db->insert('employees_salary_department',$uje);    
        }
        

        
    }
    
}//end ctrl

