<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 * Last updated on 25-Feb-2021 at 11:30 am
 */

class Report extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if(isset($this->session->userdata['accounts']['user_id'])) { //if logged-in
            $this->user_type = $this->session->userdata['accounts']['usertype'];
        }
        
    }

    public function index() {
        redirect(base_url('accounts/dashboard'));
    }

    public function check_permission($auth_usertype = array()) {
        //if not logged-in
        if($this->user_type == null) {
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
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
            redirect(base_url('accounts/dashboard'));
        }
    }
    
    public function payroll_reports() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->fetch_payroll_reports();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
        }
    }

    public function overtime_reports_m() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
        $this->load->model('Report_order_status_m');
        $data = $this->Report_order_status_m->overtime_reports_details_m();
            $this->load->view($data['page'], $data['data']);
            // $this->load->view('report/stock_detail_ledger', $data)
        }
    }
    
}//end ctrl

?>