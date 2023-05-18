<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 */

class Skiving_receive extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/skiving-receive'));
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

    public function skiving_receive() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->skiving_receive();
            $this->load->view($data['page'], $data['data']);
        }
    }

    // ----------------------ADD STARTS ------------------------------
	//Main header table list view
    public function ajax_skiving_receive_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_skiving_receive_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Open Add Form
    public function skiving_receive_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->skiving_receive_add();
            $this->load->view($data['page'], $data['data']);
        }
    }
	
	//Header duplicate checking
    public function ajax_unique_skiving_receive_challan_number(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_unique_skiving_receive_challan_number();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Add main header info
    public function form_skiving_receive_add(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_skiving_receive_add();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_all_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_all_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_cutting_issue_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_add_cutting_issue_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    // ------------------------ADD ENDS-------------------------
	
    // ----------------EDIT STARTS-------------------
	//Get data before edit
    public function skiving_receive_edit($skiving_receive_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->skiving_receive_edit($skiving_receive_id);
            $this->load->view($data['page'], $data['data']);
        }
    }
	
	//Header Edit
    public function form_skiving_receive_edit(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_skiving_receive_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function fetch_all_skiving_issue_article(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->fetch_all_skiving_issue_article();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_skiving_receive_challan_details_table_data(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_skiving_receive_challan_details_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_fetch_skiving_receive_challan_details_on_pk(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_fetch_skiving_receive_challan_details_on_pk();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_skiving_receive_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_edit_skiving_receive_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function get_customer_order_dtl_cutting_receive(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->get_customer_order_dtl_cutting_receive();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_get_article_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_get_article_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

	public function ajax_cutting_receive_quantity_and_article_detail(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_cutting_receive_quantity_and_article_detail();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	/*public function ajax_cutting_receive_quantity_and_article_detail_edit(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_cutting_receive_quantity_and_article_detail_edit();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }*/
	
    public function ajax_all_colors_on_item_master(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_all_colors_on_item_master();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_skiving_receive_challan_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_add_skiving_receive_challan_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function ajax_del_row_on_table_and_pk_purchase_order(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->ajax_del_row_on_table_and_pk_purchase_order();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Delete Header Table data
    public function skiving_receive_challan_delete(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->skiving_receive_challan_delete();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	//Delete Detail table data
	public function skiving_receive_challan_details_list_delete(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->skiving_receive_challan_details_list_delete();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
	
	public function form_edit_supp_purchase_order_details(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Skiving_receive_m');
            $data = $this->Skiving_receive_m->form_edit_supp_purchase_order_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    // ---------------------------------EDIT ENDS------------------------------
    
// -----------------------------PRINT STARTS-------------------------------
public function purchase_order_print_with_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Skiving_receive_m');
        $data = $this->Skiving_receive_m->purchase_order_print_with_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}

public function purchase_order_print_without_code($po_id) {
    if($this->check_permission(array(1,2)) == true) {
        $this->load->model('Skiving_receive_m');
        $data = $this->Skiving_receive_m->purchase_order_print_without_code($po_id);
        $this->load->view($data['page'], $data['data']);
    }
}
// -------------------------------PRINT ENDS----------------------------------
    
}