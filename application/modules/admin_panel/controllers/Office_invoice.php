<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Office_invoice extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/material-issue-list'));
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

    public function office_invoice_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->office_invoice_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_office_invoice_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_office_invoice_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function office_invoice_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->office_invoice_add();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_office_invoice_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_unique_office_invoice_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_account_declaration(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_all_account_declaration();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_packing_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_all_packing_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_office_invoice(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->form_add_office_invoice();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function update_invoice_details_wrt_invoice_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->update_invoice_details_wrt_invoice_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_material_issue_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->form_add_material_issue_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_office_invoice_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->form_edit_office_invoice_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_delivery_sgst_cgst_value(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->form_edit_delivery_sgst_cgst_value();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function office_invoice_edit($office_invoice_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->office_invoice_edit($office_invoice_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    
    public function office_invoice_jsonfile($office_invoice_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->office_invoice_jsonfile($office_invoice_id);
            redirect(base_url('admin/office-invoice-list'));
        }
    }
    

    public function form_edit_office_invoice(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->form_edit_office_invoice();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_office_invoice_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_office_invoice_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function get_rows_number_new_added_packing(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->get_rows_number_new_added_packing();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_office_invoice_details_packing_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_office_invoice_details_packing_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	 public function all_items_on_purchase_order_receive_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->all_items_on_purchase_order_receive_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_get_consume_list_purchase_order_receive_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_get_consume_list_purchase_order_receive_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function all_items_on_supp_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->all_items_on_supp_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	 public function ajax_get_remaining_item_quantity(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_get_remaining_item_quantity();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_office_invoice_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_fetch_office_invoice_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function ajax_get_latest_currency_values(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_get_latest_currency_values();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_office_invoice_header(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->delete_office_invoice_header();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function delete_material_issue_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->delete_material_issue_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_invoice_details_wrt_packing_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->add_invoice_details_wrt_packing_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_get_shipment_list_details_on_packing_id(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->ajax_get_shipment_list_details_on_packing_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_office_invoice_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->delete_office_invoice_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function adjust_invoice_from_shipment_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Office_invoice_m');
            $data = $this->Office_invoice_m->adjust_invoice_from_shipment_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// --------------------------------------------------------PRINT STARTS--------------------------------------------------------

public function office_invoice_print($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function office_invoice_print_groupwise($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_groupwise($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}


public function office_invoice_print_hsncodewise($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_hsncodewise($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function office_invoice_print_hsncheck($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_hsncheck($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}


public function office_invoice_print_wo_info($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_wo_info_m($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function office_invoice_print_wo_seal($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_wo_seal($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function office_invoice_print_wo_info_seal($invoice_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->office_invoice_print_wo_info_seal($invoice_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function packing_list_changes_details($pack_detail_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->packing_list_changes_details($pack_detail_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function invoice_declaration() {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Office_invoice_m');
        $data = $this->Office_invoice_m->invoice_declaration();
        $this->load->view($data['page'], $data['data']);
    }
}
// --------------------------------------------------------PRINT ENDS--------------------------------------------------------
    
}