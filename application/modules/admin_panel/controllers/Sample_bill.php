<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Sample_bill extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/office-proforma'));
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

    public function sample_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->sample_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_sample_bill_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->ajax_sample_bill_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_sample_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->add_sample_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_sample_bill_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->ajax_unique_sample_bill_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_sample_bill_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->form_sample_bill_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_sample_bill_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->add_sample_bill_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function edit_sample_bill($sample_bill_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->edit_sample_bill($sample_bill_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_sample_bill(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Sample_bill_m');
            $data = $this->Sample_bill_m->form_edit_sample_bill();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_sample_bill_net_amount(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->form_sample_bill_net_amount();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function sample_bill_details_table(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->sample_bill_details_table();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_items_on_item_group(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->ajax_all_items_on_item_group();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function sample_bill_get_customer_order_dtl(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->sample_bill_get_customer_order_dtl();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_supp_purchase_order_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->ajax_fetch_supp_purchase_order_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	

    public function del_sample_bill_header_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->del_sample_bill_header_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function del_sample_bill_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('sample_bill_m');
            $data = $this->sample_bill_m->del_sample_bill_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// ----------------------------------PRINT STARTS------------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('sample_bill_m');
        $data = $this->sample_bill_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('sample_bill_m');
        $data = $this->sample_bill_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// ----------------------------------PRINT ENDS-------------------------------
    
}