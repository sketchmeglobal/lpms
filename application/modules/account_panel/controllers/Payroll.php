<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 10:56
 * Last uploaded on 21-03-2021 at 09:55am
 */

class Payroll extends My_Controller {

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

    public function advance_list() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->advance_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_salary_list() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function emp_salary_add() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_add_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_search_on_id() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_search_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function emp_leave_on_id() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_leave_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function emp_advance_on_id() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_advance_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function emp_advance_paid_on_id() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_advance_paid_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function payroll_emp_leave_from_holiday_list() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->payroll_emp_leave_from_holiday_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

    public function emp_salary_edit() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_edit_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_salary_print() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_print_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function multiple_emp_pay_slip() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->multiple_emp_pay_slip();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function emp_on_dept_id() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_on_dept_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function emp_on_dept_id_new_multiple() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_on_dept_id_new_multiple();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }
    
    public function if_salary_slip_made_or_not() {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->if_salary_slip_made_or_not();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
    }

}