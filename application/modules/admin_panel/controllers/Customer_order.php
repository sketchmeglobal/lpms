<?php

class Customer_order extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        date_default_timezone_set("Asia/Kolkata"); //default timezone
        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/customer-order'));
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

    public function customer_order() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->customer_order();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_customer_order_number(){
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_unique_customer_order_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function ajax_customer_order_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_customer_order_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    // ADD CUSTOMER ORDER 

    public function add_customer_order() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->add_customer_order();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_fetch_article_colours(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $datam = $this->Customer_order_m->ajax_fetch_article_colours($this->input->post('am_id'), $this->input->post('lc_id'));
            echo json_encode($datam);
        }
    }
    
    public function ajax_fetch_article_colour_new(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $datam = $this->Customer_order_m->ajax_fetch_article_colour_new($this->input->post('am_id'), $this->input->post('lc_id'), $this->input->post('co_id'));
            echo json_encode($datam);
        }
    }
    
    public function ajax_fetch_article_rate_on_type(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $datam = $this->Customer_order_m->ajax_fetch_article_rate_on_type($this->input->post('am_id'), $this->input->post('ptype'));
            echo json_encode($datam);
        }
    }


    public function ajax_unique_customer_order_no() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_unique_customer_order_no();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function form_add_customer_order() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_add_customer_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    // ADD CUSTOMER ORDER ENDS 

    // EDIT CUSTOMER ORDER 

    public function edit_customer_order($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->edit_customer_order($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_customer_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_edit_customer_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_customer_order_details_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_customer_order_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_customer_order_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_add_customer_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_customer_order_details_brkup_edit() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_fetch_customer_order_details_brkup_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_customer_order_details_brkup() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_edit_customer_order_details_brkup();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_customer_order_brkup_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_add_customer_order_brkup_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_customer_order_details_on_pk() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_fetch_customer_order_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_customer_order_breakup_details_on_pk() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_fetch_customer_order_breakup_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_customer_order_details_brkup_qnty() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_fetch_customer_order_details_brkup_qnty();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_customer_order_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->form_edit_customer_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_del_row_on_table_and_pk_customer_order() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_del_row_on_table_and_pk_customer_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_co_no_and_art_no_and_lth_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_unique_co_no_and_art_no_and_lth_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function print_customer_order_consumption($co_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data['consumption'] = $this->Customer_order_m->print_customer_order_consumption($co_id);
            // print_r($data);
            $this->load->view('customer_order/consumption_print_v', $data);

        }
    }
    
    public function remove_customer_order_image($co_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data['consumption'] = $this->Customer_order_m->remove_customer_order_image($co_id);
            // print_r($data);
            redirect(base_url('admin/edit-customer-order/'.$co_id));

        }
    }
    
    public function order_consumption_group_by() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data['consumption'] = $this->Customer_order_m->order_consumption_group_by();
            // print_r($data);
            $this->load->view('customer_order/consumption_multiple_print_v', $data);

        }
    }
    
    
    public function full_order_history($co_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data['consumption'] = $this->Customer_order_m->full_order_history($co_id);
            // print_r($data);
            $this->load->view('customer_order/full_order_history', $data);

        }
    }

    public function ajax_customer_order_delete() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_customer_order_delete();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_fetch_customer_order_details_total_value() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Customer_order_m');
            $data = $this->Customer_order_m->ajax_fetch_customer_order_details_total_value();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

}