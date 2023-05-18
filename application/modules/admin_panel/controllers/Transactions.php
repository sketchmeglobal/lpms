<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 * Last updated: 30-dec-2020 at 12:45 pm
 */

class Transactions extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/article_costing'));
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

    public function article_costing() {
       
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->article_costing();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function delete_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->delete_costing();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_article_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->add_article_costing();
            // echo '<pre>', print_r($data), '</pre>';die;
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_add_article_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_article_costing();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function print_multiple_article_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->print_multiple_article_costing();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function edit_article_costing($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->edit_article_costing($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    public function clone_article_costing($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->clone_article_costing($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function costing_clone_swap_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->costing_clone_swap_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function pending_clone_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->pending_clone_costing();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function del_costing_pending_clone_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->del_costing_pending_clone_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_item_colour_wrt_im_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_item_colour_wrt_im_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function costing_swap_item_clr() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->costing_swap_item_clr_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function costing_swap_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->costing_swap_item_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_costing_clone_table_data() {
        if($this->check_permission() == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_clone_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function print_article_costing($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->print_article_costing($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function print_article_costing_ms($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->print_article_costing_ms($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function print_article_costing_wo_rate($ac_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->print_article_costing_wo_rate($ac_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function calculate_article_costing(){
        if($this->check_permission(array(1,2)) == true) {
            $ac_id = $this->input->post('ci');
            $this->load->model('Transactions_m');
            $datam = $this->Transactions_m->calculate_article_costing($ac_id);
            echo json_encode($datam);
        }
    }

    public function calculate_article_costing_clone(){
        if($this->check_permission(array(1,2)) == true) {
            $ac_id = $this->input->post('ci');
            $this->load->model('Transactions_m');
            $datam = $this->Transactions_m->calculate_article_costing_clone($ac_id);
            echo json_encode($datam);
        }
    }

    public function form_edit_article_costing() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_article_costing();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_edit_article_costing_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_article_costing_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_measurement() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_article_measurement();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_add_article_measurement_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_article_measurement_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article_measurement() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_article_measurement();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_edit_article_measurement_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_article_measurement_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_costing_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_costing_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_add_costing_details_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_costing_details_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_costing_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_costing_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_edit_costing_details_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_costing_details_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_costing_charges() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_costing_charges();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_costing_charges_percentage() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_costing_charges_percentage();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_costing_charges_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_add_costing_charges_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_costing_charges() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_costing_charges();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function form_edit_costing_charges_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->form_edit_costing_charges_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }


    public function ajax_fetch_article_master_image() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_master_image();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_costing_amId() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_amId();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_costing_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_unique_article_costing_item_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_item_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_costing_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_costing_measurement_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_measurement_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_article_costing_measurement_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_measurement_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_costing_measurement() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_measurement();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_fetch_article_costing_measurement_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_measurement_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_rate_by_item_detail() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_rate_by_item_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_costing_details_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_details_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_unique_article_costing_details_item_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_details_item_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_costing_charge() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_charge();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_unique_article_costing_charge_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_unique_article_costing_charge_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_costing_details_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_article_costing_details_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_details_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_costing_charges_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_charges_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_article_costing_charges_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_article_costing_charges_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_costing_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_fetch_article_costing_details_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_details_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_costing_charges() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_charges();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    public function ajax_fetch_article_costing_charges_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_article_costing_charges_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    // common area 
    public function ajax_all_items_on_item_group_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_all_items_on_item_group_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_buyer_items_on_item_group_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_buyer_items_on_item_group_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_fetch_mapped_item(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_fetch_mapped_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_del_row_on_table_and_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_del_row_on_table_and_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_del_row_on_table_and_pk_clone(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Transactions_m');
            $data = $this->Transactions_m->ajax_del_row_on_table_and_pk_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }


}