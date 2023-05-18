<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Office_proforma extends My_Controller {

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

    public function office_proforma() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->office_proforma();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_office_proforma_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_office_proforma_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function office_proforma_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->office_proforma_add();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_proforma_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_unique_proforma_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_customer_order_details_table_data_order_changes(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_customer_order_details_table_data_order_changes();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_office_proforma_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->form_office_proforma_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_office_proforma_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->form_add_office_proforma_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function edit_office_proform($office_proforma_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->edit_office_proform($office_proforma_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_office_proform(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->form_edit_office_proform();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function office_proforma_details_table(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->office_proforma_details_table();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_items_on_item_group(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_all_items_on_item_group();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function Office_proforma_get_customer_order_dtl(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->Office_proforma_get_customer_order_dtl();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_proforma_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->form_edit_proforma_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_proforma_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_fetch_proforma_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_supp_purchase_order_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_fetch_supp_purchase_order_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function update_proforma_details_wrt_proforma_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->update_proforma_details_wrt_proforma_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_office_proforma_header_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->delete_office_proforma_header_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function del_office_proforma_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->del_office_proforma_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function print_office_proforma($pro_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->print_office_proforma_m($pro_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
	
	public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_proforma_m');
            $data = $this->Office_proforma_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// ----------------------------------PRINT STARTS------------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_proforma_m');
        $data = $this->Office_proforma_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_proforma_m');
        $data = $this->Office_proforma_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// ----------------------------------PRINT ENDS-------------------------------
    
}