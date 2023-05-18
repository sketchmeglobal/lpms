<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 * Last modified: 20-Feb-2021 at 11:30am
 */

class Sample_challan_receive extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/sample-challan-receive'));
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

    // --------------------------------------------------------LIST--------------------------------------------------------
    public function sample_challan_receive_list() {
        
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->sample_challan_receive_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

     // ----------------------ADD STARTS ------------------------------
    //Main header table list view
    public function ajax_sample_challan_receive_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->ajax_sample_challan_receive_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    //Open Add Form
    
    public function sample_challan_receive_add() {
        
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->sample_challan_receive_add();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_sample_challan_receive_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->ajax_sample_challan_receive_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_sample_challan_receive_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->form_sample_challan_receive_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function sample_challan_receive_edit($sample_receive_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->sample_challan_receive_edit($sample_receive_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_sample_receive_edit(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->form_sample_receive_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_sample_receipt_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->ajax_sample_receipt_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function sample_issue_by_acc_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->sample_issue_by_acc_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function article_master_by_sample_challan_no(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->article_master_by_sample_challan_no();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function article_quantity_by_sample_challan_no(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->article_quantity_by_sample_challan_no();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_sample_receive_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->form_add_sample_receive_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function del_sample_challan_receipt_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_challan_receive_m');
            $data = $this->Sample_challan_receive_m->del_sample_challan_receipt_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    

}