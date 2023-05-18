<?php

/**

 * Coded by: Pran Krishna Das

 * Social: www.fb.com/pran93

 * CI: 3.0.6

 * Date: 11-03-2020

 * Time: 10:56
  Last updated on 29-mar-2021 at 04:04 pm

 */



class Purchase_order extends My_Controller {



    private $user_type = null;



    public function __construct() {

        parent::__construct();



        $this->load->library('grocery_CRUD');



        if($this->session->has_userdata('user_id')) { //if logged-in

            $this->user_type = $this->session->usertype;

        }

    }



    public function index() {

        redirect(base_url('admin/purchase-order'));

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



    public function purchase_order() {

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->purchase_order();

            $this->load->view($data['page'], $data['data']);

        }

    }



    // --------------------------------------------------------ADD STARTS--------------------------------------------------------



    public function ajax_purchase_order_table_data(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_purchase_order_table_data();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function add_purchase_order() {

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->add_purchase_order();

            $this->load->view($data['page'], $data['data']);

        }

    }



    public function ajax_unique_purchase_order_no(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_unique_purchase_order_no();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function form_add_purchase_order(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_add_purchase_order();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function ajax_fetch_purchase_order_breakup_details_on_pk(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_fetch_purchase_order_breakup_details_on_pk();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function form_add_purchase_order_brkup_details(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_add_purchase_order_brkup_details();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function form_edit_purchase_order_details_brkup(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_edit_purchase_order_details_brkup();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function ajax_fetch_purchase_order_details_brkup_edit(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_fetch_purchase_order_details_brkup_edit();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function ajax_del_row_on_table_and_pk_purch_order(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_del_row_on_table_and_pk_purch_order();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function ajax_fetch_purchase_order_details_brkup_qnty(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_fetch_purchase_order_details_brkup_qnty();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
    
    public function ajax_fetch_purchase_order_details_brkup_qnty_edit(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_fetch_purchase_order_details_brkup_qnty_edit();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function form_add_purchase_order_details(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_add_purchase_order_details();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    public function ajax_unique_purchase_order_receive_num(){
            $this->load->model('Purchase_order_m');
            $data = $this->Purchase_order_m->ajax_unique_purchase_order_receive_num_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function ajax_fetch_cost_rate_wrt_item(){
            $this->load->model('Purchase_order_m');
            $data = $this->Purchase_order_m->ajax_fetch_cost_rate_wrt_item_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    // --------------------------------------------------------ADD ENDS--------------------------------------------------------

    // --------------------------------------------------------EDIT STARTS--------------------------------------------------------



    public function edit_purchase_order($po_id) {

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->edit_purchase_order($po_id);

            $this->load->view($data['page'], $data['data']);

        }

    }



    public function form_edit_purchase_order(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_edit_purchase_order();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function ajax_purchase_order_details_table_data(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_purchase_order_details_table_data();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function ajax_all_items_on_item_group(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_all_items_on_item_group();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function ajax_all_colors_on_item_master(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_all_colors_on_item_master();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function ajax_fetch_purchase_order_details_on_pk(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_fetch_purchase_order_details_on_pk();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
	
	public function ajax_unique_po_number_and_art_no_and_lth_color(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Purchase_order_m');
            $data = $this->Purchase_order_m->ajax_unique_po_number_and_art_no_and_lth_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

	

	public function ajax_del_row_on_table_and_pk_purchase_order(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->ajax_del_row_on_table_and_pk_purchase_order();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }
	
	public function del_row_on_table_pk_purchase_order_details(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->del_row_on_table_pk_purchase_order_details();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }



    public function form_edit_purchase_order_details(){

        if($this->check_permission(array(1,2)) == true) {

            $this->load->model('Purchase_order_m');

            $data = $this->Purchase_order_m->form_edit_purchase_order_details();

            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);

            exit();

        }

    }

    

    // --------------------------------------------------------EDIT ENDS--------------------------------------------------------

    

// --------------------------------------------------------PRINT STARTS--------------------------------------------------------

public function purchase_order_print_with_code($po_id) {

    if($this->check_permission(array(1,2)) == true) {

        $this->load->model('Purchase_order_m');

        $data = $this->Purchase_order_m->purchase_order_print_with_code($po_id);

        $this->load->view($data['page'], $data['data']);

    }

}

public function purchase_order_print_with_brkup($po_id) {

    if($this->check_permission(array(1,2)) == true) {

        $this->load->model('Purchase_order_m');

        $data = $this->Purchase_order_m->purchase_order_print_with_brkup($po_id);

        $this->load->view($data['page'], $data['data']);

    }

}
public function purchase_order_print_with_brkup_wo_order($po_id) {

    if($this->check_permission(array(1,2)) == true) {

        $this->load->model('Purchase_order_m');

        $data = $this->Purchase_order_m->purchase_order_print_with_brkup_wo_order($po_id);

        $this->load->view($data['page'], $data['data']);

    }

}



public function purchase_order_print_without_code($po_id) {

    if($this->check_permission(array(1,2)) == true) {

        $this->load->model('Purchase_order_m');

        $data = $this->Purchase_order_m->purchase_order_print_without_code($po_id);

        $this->load->view($data['page'], $data['data']);

    }

}

// --------------------------------------------------------PRINT ENDS--------------------------------------------------------

    

}