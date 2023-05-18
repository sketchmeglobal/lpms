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

        if($this->session->has_userdata('user_id')) { //if logged-in
            $this->user_type = $this->session->usertype;
        }
    }

    public function index() {
        redirect(base_url('admin/payroll-advance-list'));
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

    public function advance_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->advance_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_salary_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_list_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function emp_salary_add() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_add_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_search_on_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_search_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function emp_leave_on_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_leave_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function emp_advance_on_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_advance_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function emp_advance_paid_on_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_advance_paid_on_id_m();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function payroll_emp_leave_from_holiday_list() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->payroll_emp_leave_from_holiday_list();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

    public function emp_salary_edit() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_edit_m();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function emp_salary_print() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_salary_print_m();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function multiple_emp_pay_slip() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->multiple_emp_pay_slip();
            $this->load->view($data['page'], $data['data']);
        }
    }
    
    public function emp_on_dept_id() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_on_dept_id();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function emp_on_dept_id_new_multiple() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_on_dept_id_new_multiple();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function emp_on_dept_id_new_multiples() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->emp_on_dept_id_new_multiples();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }
    
    public function if_salary_slip_made_or_not() {
        if($this->check_permission(array(1,2)) == true) {
            $this->load->model('Payroll_m');
            $data = $this->Payroll_m->if_salary_slip_made_or_not();
            echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
            exit();
        }
    }

}