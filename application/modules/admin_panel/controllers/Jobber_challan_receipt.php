<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 * Last modified: 20-Feb-2021 at 11:30am
 */

class Jobber_challan_receipt extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/jobber-challan-receipt'));
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

    public function jobber_challan_receipt_list() {
		
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->jobber_challan_receipt_list();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------
	//Main header table list view
    public function ajax_jobber_challan_receipt_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_jobber_challan_receipt_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Open Add Form
    public function jobber_challan_receipt_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->jobber_challan_receipt_add();
            $this->load->view($data['page'], $data['data']);
        }
    }
	
	public function ajax_jobber_challan_issue_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_jobber_challan_issue_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_jobber_receipt_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_unique_jobber_receipt_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Add main header info
    public function form_jobber_challan_receipt_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_jobber_challan_receipt_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_cutting_issue_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_add_cutting_issue_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function jobber_challan_receipt_edit($jobber_challan_receipt_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->jobber_challan_receipt_edit($jobber_challan_receipt_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_jobber_receipt_edit(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_jobber_receipt_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_jobber_challan_receipt_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_jobber_challan_receipt_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_fetch_jobber_challan_details_for_edit(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_fetch_jobber_challan_details_for_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_jobber_issue_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_edit_jobber_issue_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function get_customer_order_dtl_cutting_receive_jobber(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->get_customer_order_dtl_cutting_receive_jobber();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_get_article_info_by_jobber_issue_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_get_article_info_by_jobber_issue_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_get_article_info_details_wrt_jobber_issue_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_get_article_info_details_wrt_jobber_issue_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function jobber_issue_by_customer_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->jobber_issue_by_customer_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

	public function ajax_get_received_quantity_in_cutting(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_get_received_quantity_in_cutting();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_jobber_receipt_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_add_jobber_receipt_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_jobber_receipt_challan_header(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->delete_jobber_receipt_challan_header();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function delete_jobber_receipt_challan_detail_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->delete_jobber_receipt_challan_detail_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Jobber_challan_receipt_m');
            $data = $this->Jobber_challan_receipt_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// -----------------------------PRINT STARTS-------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Jobber_challan_receipt_m');
        $data = $this->Jobber_challan_receipt_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Jobber_challan_receipt_m');
        $data = $this->Jobber_challan_receipt_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// -------------------------------PRINT ENDS----------------------------------
    
}