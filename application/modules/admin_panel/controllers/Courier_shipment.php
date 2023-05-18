<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Courier_shipment extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/courier-shipment-list'));
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

    public function courier_shipment_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->courier_shipment_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_courier_shipment_list_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->ajax_courier_shipment_list_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_courier_shipment() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->add_courier_shipment();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_courier_shipment_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->ajax_unique_courier_shipment_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_courier_shipment_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->form_courier_shipment_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_courier_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->form_add_courier_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function edit_courier_shipment($courier_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->edit_courier_shipment($courier_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_courier_shipment(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->form_edit_courier_shipment();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_courier_shipment_detail_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->ajax_courier_shipment_detail_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function packing_shipment_get_customer_order_dtl(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->packing_shipment_get_customer_order_dtl();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_courier_shipment_edit_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->ajax_fetch_courier_shipment_edit_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_courier_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->form_edit_courier_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_courier_shipment_header_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->delete_courier_shipment_header_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function del_courier_shipment_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->del_courier_shipment_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Courier_shipment_m');
            $data = $this->Courier_shipment_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// ----------------------------------PRINT STARTS------------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Courier_shipment_m');
        $data = $this->Courier_shipment_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Courier_shipment_m');
        $data = $this->Courier_shipment_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// ----------------------------------PRINT ENDS-------------------------------
    
}