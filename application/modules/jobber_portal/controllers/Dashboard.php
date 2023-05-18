<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 12:00
 */

class Dashboard extends My_Controller {

    private $user_type = null;

    public function __construct() {
        parent::__construct();
        
        if(isset($this->session->userdata['accnt']['user_id'])) { //if logged-in
            $this->user_type = $this->session->userdata['accnt']['usertype'];
        }
        
    }

    public function index() {
        redirect(base_url('accounts/dashboard'));
    }

    public function dashboard() {
        if($this->user_type == null) { //if not logged-in
            $this->session->set_flashdata('title', 'Log-in!');
            $this->session->set_flashdata('msg', 'Kindly log-in to access that page.');
            redirect(base_url('accounts'));
        } else { //if admin already logged-in
            $this->load->model('Dashboard_m');
            $data = $this->Dashboard_m->dashboard();
            $this->load->view($data['page'], $data['data']);
        }
    }

    public function error_404() {
        $this->load->library('user_agent');
        $data['referrer_url'] = $this->agent->referrer();
        $this->load->view('error_404_v', $data);
    }

    public function js_disabled() {
        $this->load->library('user_agent');
        $data['referrer_url'] = $this->agent->referrer();
        $this->load->view('js_disabled_v', $data);
    }


}
