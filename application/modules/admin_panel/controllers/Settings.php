<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 14:00
 */

class Settings extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();

        $this->load->library('grocery_CRUD');

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/profile'));
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

    public function departments_permission() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->departments_permission();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function menu_permission() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->menu_permission();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function user_permission() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->user_permission();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function user_management() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->user_management();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function user_add_department() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->user_add_department();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function user_logs_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->user_logs_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function excel_import_leather_quantity() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->excel_import_leather_quantity_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function ajax_user_logs_details_m(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->ajax_user_logs_details_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function database_backup_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->database_backup_m();
        }
    }
    
    public function google_chart_m() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->google_chart_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    
    public function change_entry_user() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Settings_m');
            $data = $this->Settings_m->change_entry_user();
            $this->load->view($data['page'], $data['data']);
        }
    }
    

    public function google_chart_daywise_data_m(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->google_chart_full_details_data_m();
            echo json_encode($data);
            exit();
    }
    
    
    public function ajax_fetch_all_added_items(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->ajax_fetch_all_added_items();
            echo json_encode($data);
            exit();
    }
    
    
    public function change_all_user_details(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->change_all_user_details();
            echo json_encode($data);
            exit();
    }
    
    
    

    public function google_chart_monthwise_data_m(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->google_chart_monthwise_data_m();
            echo json_encode($data);
            exit();
    }

    public function google_chart_yearwise_data_m(){
            $this->load->model('Settings_m');
            $data = $this->Settings_m->google_chart_yearwise_data_m();
            echo json_encode($data);
            exit();
    }

} // /.Profile() controller