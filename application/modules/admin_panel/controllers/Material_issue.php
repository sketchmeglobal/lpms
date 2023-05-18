<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Material_issue extends My_Controller {

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

    public function material_issue_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->material_issue_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------

    public function ajax_material_issue_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_material_issue_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function material_issue_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->material_issue_add();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_material_issue_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_unique_material_issue_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_material_issue(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->form_add_material_issue();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_material_issue_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->form_add_material_issue_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_material_issue_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->form_edit_material_issue_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_delivery_sgst_cgst_value(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->form_edit_delivery_sgst_cgst_value();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function material_issue_edit($material_issue_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->material_issue_edit($material_issue_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_material_issue(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->form_edit_material_issue();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_material_issue_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_material_issue_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	 public function all_items_on_purchase_order_receive_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->all_items_on_purchase_order_receive_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

 public function fetch_remainng_stock_for_material_issue(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->fetch_remainng_stock_for_material_issue();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }   

    public function ajax_get_consume_list_purchase_order_receive_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_get_consume_list_purchase_order_receive_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function all_items_on_supp_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->all_items_on_supp_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	 public function ajax_get_remaining_item_quantity(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_get_remaining_item_quantity();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_material_issue_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_fetch_material_issue_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_receive_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->delete_receive_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function delete_material_issue_details_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Material_issue_m');
            $data = $this->Material_issue_m->delete_material_issue_details_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	
    
    // ---------------------------------EDIT ENDS------------------------------
    
// --------------------------------------------------------PRINT STARTS--------------------------------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Material_issue_m');
        $data = $this->Material_issue_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Material_issue_m');
        $data = $this->Material_issue_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// --------------------------------------------------------PRINT ENDS--------------------------------------------------------
    
}