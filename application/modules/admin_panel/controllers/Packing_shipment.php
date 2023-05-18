<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Packing_shipment extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/packing-shipment-list'));
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

    public function packing_shipment_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->packing_shipment_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_packing_shipment_list_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_packing_shipment_list_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_packing_shipment() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->add_packing_shipment();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_proforma_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_unique_proforma_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_packing_shipment_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_packing_shipment_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_packing_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_add_packing_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_details_for_same_cartoon(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_add_details_for_same_cartoon();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    // ------------------------ADD ENDS-------------------------
    
    // ----------------EDIT STARTS-------------------

    public function edit_packing_shipment($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->edit_packing_shipment($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_packing_shipment(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_edit_packing_shipment();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function delete_packing_shipment_detail_wrt_shipment_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->delete_packing_shipment_detail_wrt_shipment_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_packing_shipment_detail_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_packing_shipment_detail_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_packing_shipment_detail_table_data_second(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_packing_shipment_detail_table_data_second();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function packing_shipment_get_customer_order_dtl(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->packing_shipment_get_customer_order_dtl();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function packing_shipment_get_customer_order_dtl_wrt_cod(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->packing_shipment_get_customer_order_dtl_wrt_cod();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_packing_shipment_edit_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_fetch_packing_shipment_edit_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_packing_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_edit_packing_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_packing_shipment_header_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->delete_packing_shipment_header_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function del_packing_shipment_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->del_packing_shipment_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_packing_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->ajax_all_packing_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function update_packing_shipment_detail_wrt_shipment_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->update_packing_shipment_detail_wrt_shipment_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function get_all_carton_id_from_packing_list_table(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->get_all_carton_id_from_packing_list_table_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function get_all_packing_details_respect_to_carton_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->get_all_packing_details_respect_to_carton_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// ----------------------------------PRINT STARTS------------------------------------

    public function print_packing_shipment($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_packing_shipment($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function print_shipment_details($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_shipment_details($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function print_shipment_details_with_crtn($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_shipment_details_with_crtn($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function print_shipment_details_wo_seal($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_shipment_details_wo_seal($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function print_shipment_details_hs($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_shipment_details_hs($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function packing_shipment_consumption_m($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->packing_shipment_consumption_m($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function packing_shipment_consumption_purchase_receipt($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->packing_shipment_consumption_purchase_receipt_m($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function print_shipment_details_article_weight($packing_shipment_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Packing_shipment_m');
            $data = $this->Packing_shipment_m->print_shipment_details_article_weight($packing_shipment_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Packing_shipment_m');
        $data = $this->Packing_shipment_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Packing_shipment_m');
        $data = $this->Packing_shipment_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// ----------------------------------PRINT ENDS-------------------------------
    
}