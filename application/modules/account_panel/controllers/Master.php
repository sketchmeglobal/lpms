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

        if(isset($this->session->userdata['accounts']['user_id'])) { //if logged-in
            $this->user_type = $this->session->userdata['accounts']['usertype'];
        }
        
    }

    public function index() {
        redirect(base_url('accounts/dashboard'));
    }

    public function departments() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Master_m');
            $data = $this->Master_m->departments();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function employees() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Master_m');
            $data = $this->Master_m->employees();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function holiday_list_m() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Master_m');
            $data = $this->Master_m->holiday_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function ajax_overtime_table_data_m() {
            $this->load->model('Master_m');
            $data = $this->Master_m->ajax_overtime_table_data_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function overtime_m() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Master_m');
            $data = $this->Master_m->overtime_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function overtime_add_m() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Master_m');
            $data = $this->Master_m->overtime_add_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function get_all_emp_id_for_overtime_m() {
            $this->load->model('Master_m');
            $data = $this->Master_m->get_all_emp_id_for_overtime_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function form_add_overtime(){
            $this->load->model('Master_m');
            $data = $this->Master_m->form_add_overtime();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
            }
    
    public function del_overtime_list_m() {
            $this->load->model('Master_m');
                $data = $this->Master_m->del_overtime_list_m();            
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function ajax_del_row_on_table_and_pk() {
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