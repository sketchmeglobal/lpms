<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 20-02-2020
 * Time: 14:45
 * Last updated on 29-mar-2021 at 04:30 pm
 */

class Master extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/item_group'));
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

    public function units() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->units();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function sizes() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->sizes();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function shapes() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->shapes();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function item_groups() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->item_groups();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_unit_on_item_group(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_unit_on_item_group();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function item_master() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->item_master();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function add_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->add_item();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function clone_article_master($am_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->clone_article_master($am_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_add_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function edit_item($im_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->edit_item($im_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_item() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_item();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function item_mapper() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->item_mapper();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_add_item_buy_code() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_item_buy_code();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function form_edit_item_buy_code() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_item_buy_code();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_item_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_item_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_item_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_item_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_item_color_rate() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_item_color_rate();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_item_color_rate() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_item_color_rate();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_buy_code_details() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_buy_code_details();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_item_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_item_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_item_code() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_item_code();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_item_name() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_item_name();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_item_buy_code() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_item_buy_code();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_item_color() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_item_color();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_supp_item_color_rate_eff_date() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_supp_item_color_rate_eff_date();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_fetch_item_rate() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_fetch_item_rate();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function countries() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->countries();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function stations() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->stations();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function currencies() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->currencies();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    
    public function add_currencies_rate($val) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->add_currencies_rate($val);
            $this->load->view($data['page'], $data['data']);
        }
    }
    

    public function colors() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->colors();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function account_groups() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->account_groups();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function account_master() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->account_master();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    
    public function transport_master() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->transport_master();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
	
	public function account_declaration($am_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->account_declaration($am_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function charges() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->charges();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function departments() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->departments();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function article_groups() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->article_groups();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function employees() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->employees();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function holiday_list_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->holiday_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function article_master() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->article_master();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function add_article() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->add_article();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_add_article() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function edit_article($am_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->edit_article($am_id);
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function article_master_clone_delete($am_id) {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->article_master_clone_delete($am_id);
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_del_row_on_table_and_pk_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_del_row_on_table_and_pk_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_color_clone() {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_color_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function form_edit_article_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function pending_clone_master() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->pending_clone_master();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_article_master_table_data_pending_clone() {
        if($this->check_permission() == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_master_table_data_pending_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article_color_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_color_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_no() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_article_no();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_alternate_article_no() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_alternate_article_no();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_unique_article_lth_color() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_article_lth_color();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function ajax_fetch_article_color() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_color();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_part() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_part();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_part() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_part();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_part_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_part_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article_part() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_part();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article_part_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_part_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_part_item_group() {
        $this->load->model('Master_m');
        $data = $this->Master_m->ajax_unique_article_part_item_group();
        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
        exit();
    }

    public function article_rate_stitch() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->article_rate_stitch();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_item_master_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_item_master_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_item_buy_code_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_item_buy_code_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_item_color_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_item_color_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_item_color_rate_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_item_color_rate_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_item_color_rate_table_data_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_item_color_rate_table_data_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_article_rate() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_rate();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function form_add_article_rate_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_rate_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    

    public function form_add_article_rate_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_article_rate_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_edit_article_rate() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_rate();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function form_edit_article_rate_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_rate_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function form_edit_article_rate_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_rate_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_rate() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_rate();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_unique_article_rate_date() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_unique_article_rate_date();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function ajax_unique_article_rate_date_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_unique_article_rate_date_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    

    public function ajax_article_rate_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_rate_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function ajax_article_rate_table_data_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_rate_table_data_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    

    public function ajax_article_rate_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_rate_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_part_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_part_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_part_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_part_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_color_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_color_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_article_master_table_data() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_master_table_data();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function courier() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->courier();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function form_edit_article_master_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_edit_article_master_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_color_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_color_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_part_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_part_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_fetch_article_rate_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_rate_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    
    public function ajax_fetch_article_rate_new() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_fetch_article_rate_new();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    

    public function ajax_article_color_table_data_clone() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_article_color_table_data_clone();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function ajax_overtime_table_data_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_overtime_table_data_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function overtime_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->overtime_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function overtime_add_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->overtime_add_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function get_all_emp_id_for_overtime_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->get_all_emp_id_for_overtime_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function form_add_overtime(){
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_overtime();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function del_overtime_list_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
                $data = $this->Master_m->del_overtime_list_m();            
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function ajax_del_row_on_table_and_pk() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Master_m');
            if($this->input->post('tab') == 'item-dtl'){
                $data = $this->Master_m->ajax_del_item_master_color();
            }else if($this->input->post('tab') == 'item-master'){
                $data = $this->Master_m->ajax_del_item_master();
            }else if($this->input->post('tab') == 'article-master'){
                $data = $this->Master_m->ajax_del_article_master();
            }else{
                $data = $this->Master_m->ajax_del_row_on_table_and_pk();
            }            
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

}