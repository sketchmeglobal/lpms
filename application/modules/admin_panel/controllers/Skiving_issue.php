<?php

class Skiving_issue extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/skiving-issue'));
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

    // ------------------------------ LIST ----------------------------------------------

    public function skiving_issue() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->skiving_issue();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------
	//Main header table list view
    public function ajax_cutting_receive_table_data_skiving(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_cutting_receive_table_data_skiving();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Open Add Form
    public function add_skiving_issue() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->add_skiving_issue();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unique_skiving_issue_no(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_unique_skiving_issue_no();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Add main header info
    public function form_add_skiving_issue(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_add_skiving_issue();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_cutting_issue_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_add_cutting_issue_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------

    public function edit_skiving_issue($cut_rcv_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->edit_skiving_issue($cut_rcv_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

   public function skiving_challan_issue_print($skvng_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->skiving_challan_issue_print($skvng_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_skiving_issue(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_edit_skiving_issue();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_cutting_receive_challan_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_cutting_receive_challan_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_skiving_issue_table_data($id){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_skiving_issue_table_data($id);
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_fetch_cutting_receive_challan_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_fetch_cutting_receive_challan_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_issue_receive_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_edit_issue_receive_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function get_customer_order_dtl_cutting_receive(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->get_customer_order_dtl_cutting_receive();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_get_article_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_get_article_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

	public function ajax_get_issue_quantity_and_article_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_get_issue_quantity_and_article_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_cutting_receive_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_add_cutting_receive_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_cutting_receive_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->delete_cutting_receive_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function delete_skiving_issue_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->delete_skiving_issue_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// -----------------------------PRINT STARTS-------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Skiving_issue_m');
        $data = $this->Skiving_issue_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Skiving_issue_m');
        $data = $this->Skiving_issue_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// -------------------------------PRINT ENDS----------------------------------

// -------------------------------BILL STARTS----------------------------------
    
    public function skiving_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->skiving_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_skiving_bill_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_skiving_bill_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function add_skiving_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->add_skiving_bill();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_add_skiving_bill(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_add_skiving_bill();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }


    public function edit_skiving_bill($skiv_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->edit_skiving_bill($skiv_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function print_skiving_bill($skiv_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->print_skiving_bill($skiv_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_skiving_bill() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_edit_skiving_bill();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_skiving_bill_list(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->delete_skiving_bill_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_skiving_bill_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_skiving_bill_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function delete_skiving_bill_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->delete_skiving_bill_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_skiving_issue_on_co_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_skiving_issue_on_co_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_dtl_on_cut_rcv_id_and_co_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_article_dtl_on_cut_rcv_id_and_co_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_skiving_bill_pending_qnty(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->ajax_fetch_skiving_bill_pending_qnty();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }    
    }

    public function form_add_skiving_bill_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_issue_m');
            $data = $this->Skiving_issue_m->form_add_skiving_bill_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }    
    }
// -------------------------------BILL ENDS----------------------------------

}