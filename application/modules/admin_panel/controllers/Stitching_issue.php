<?php

class Stitching_issue extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        // $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/stitching-bill'));
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

    public function stitching_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->stitching_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_stitching_bill_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->ajax_stitching_bill_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_stitching_bill(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->form_add_stitching_bill();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_stitching_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->add_stitching_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function edit_stitching_bill($skiv_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->edit_stitching_bill($skiv_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_stitching_bill_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->ajax_stitching_bill_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_detail_on_co_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->ajax_article_detail_on_co_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_stitching_bill_pending_qnty(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->ajax_fetch_stitching_bill_pending_qnty();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_stitching_bill_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->form_add_stitching_bill_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function print_stitching_bill($stitch_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->print_stitching_bill($stitch_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function delete_stitching_bill_details(){
        if($this->check_permission(array(1,2)) == true) {   
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->delete_stitching_bill_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_stitching_bill_list(){
        if($this->check_permission(array(1,2)) == true) {   
            $this->load->model('Stitching_issue_m');
            $data = $this->Stitching_issue_m->delete_stitching_bill_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
// -------------------------------BILL ENDS----------------------------------

}