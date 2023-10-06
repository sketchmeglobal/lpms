<?php

class Report_order_status_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->query("SET sql_mode = ''");
    }

    public function fetch_payroll_reports() {
        
        $user_id = $this->session->userdata['accnt']['user_id'];
        
        $data = [];
        
        if($this->input->post("adl")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
                        foreach($it_arr as $i_a) {
            $data['result'][] = $this->_fetch_advance_ledger($mon,$i_a);
                        }
            $data['segment'] = 'payroll_reports_advance_ledger';
            // echo '<pre>', print_r($data['result']), '</pre>';die();
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("lv")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            
            $new_iter = implode(",", $it_arr);
          
            $sql="SELECT employees.e_id
            FROM employees
            WHERE employees.e_id IN ($new_iter)
            ORDER BY employees.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_leave($mon,$r->e_id);
                }
            }
                
            $data['segment'] = 'payroll_reports_leave';
            return array('page'=>'reports/common_print_v','data'=>$data);
        
        }
        if($this->input->post("esi")){
            $it_arr = $this->input->post('leather[]');
            $new_iter = implode(",", $it_arr);
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $contractor = $this->input->post('contractor[]');
            $name = '';
            foreach($contractor as $con){
                $name .= $this->db->get_where('contractor_master', array('am_id' => $con))->row()->name . ', ';
            }
            $data['contractor_names'] = rtrim($name, ", ");            
                
            $sql="SELECT employees_salary_department.e_id,salary_for_salary_department.T1,salary_for_salary_department.T2,salary_for_salary_department.T3,(salary_for_salary_department.T4+salary_for_salary_department.T5+salary_for_salary_department.T6) AS T,salary_for_salary_department.T7,employees_salary_department.basic_pay AS BASIC1,
            CAST((employees_salary_department.basic_pay) AS DECIMAL(11,2)) AS TOTAL1,salary_for_salary_department.BASIC AS BASIC2,CAST((salary_for_salary_department.BASIC) AS DECIMAL(11,2)) AS TOTAL2,
            salary_for_salary_department.HRAAMT,salary_for_salary_department.GROSS,salary_for_salary_department.PFAMT,salary_for_salary_department.ESIAMT,salary_for_salary_department.TAX,salary_for_salary_department.INS,salary_for_salary_department.LOAN,salary_for_salary_department.DEDUC,salary_for_salary_department.NET
            FROM salary_for_salary_department
            INNER JOIN(employees_salary_department)
            ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
            WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id IN ($new_iter)
            ORDER BY employees_salary_department.name";
        
            $res = $this->db->query($sql)->result();
            
        if(count($res) > 0) {
            foreach($res as $r) {
                $data['result'][] = $this->_fetch_esi_pf1($mon,$r->e_id);
            }
        }
            
            $data['segment'] = 'payroll_esi_pf';
            return array('page'=>'reports/common_print_v','data'=>$data);
            
        }
        if($this->input->post("reg")){
            $it_arr = $this->input->post('leather[]');
            $new_iter = implode(",", $it_arr);
            $mon = $this->input->post('month');
            $data['mont'] = $mon;

            $contractor = $this->input->post('contractor[]');
            $name = '';
            foreach($contractor as $con){
                $name .= $this->db->get_where('contractor_master', array('am_id' => $con))->row()->name . ', ';
            }
            $data['contractor_names'] = rtrim($name, ", ");
            
            $sql="SELECT employees_salary_department.e_id,salary_for_salary_department.T1,salary_for_salary_department.T2,salary_for_salary_department.T3,(salary_for_salary_department.T4+salary_for_salary_department.T5+salary_for_salary_department.T6) AS T,salary_for_salary_department.T7,employees_salary_department.basic_pay AS BASIC1,
            CAST((employees_salary_department.basic_pay) AS DECIMAL(11,2)) AS TOTAL1,salary_for_salary_department.BASIC AS BASIC2,CAST((salary_for_salary_department.BASIC) AS DECIMAL(11,2)) AS TOTAL2,
            salary_for_salary_department.HRAAMT,salary_for_salary_department.GROSS,salary_for_salary_department.PFAMT,salary_for_salary_department.ESIAMT,salary_for_salary_department.TAX,salary_for_salary_department.INS,salary_for_salary_department.LOAN,salary_for_salary_department.DEDUC,salary_for_salary_department.NET,
            contractor_master.name as contractor_name
            FROM salary_for_salary_department
            INNER JOIN(employees_salary_department)
            ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
            INNER JOIN(contractor_master) ON(contractor_master.am_id=employees_salary_department.c_id)
            WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id IN ($new_iter)
            ORDER BY contractor_name,employees_salary_department.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_register($mon,$r->e_id);
                }
            }
            
            $data['segment'] = 'payroll_register';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("pf")){
            $it_arr = $this->input->post('leather[]');
            $new_iter = implode(",", $it_arr);
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $contractor = $this->input->post('contractor[]');
            $name = '';
            foreach($contractor as $con){
                $name .= $this->db->get_where('contractor_master', array('am_id' => $con))->row()->name . ', ';
            }
            $data['contractor_names'] = rtrim($name, ", ");
            
            $sql="SELECT employees_salary_department.e_id,salary_for_salary_department.T1,salary_for_salary_department.T2,salary_for_salary_department.T3,
                T4, T5, T6, (salary_for_salary_department.T4+salary_for_salary_department.T5+salary_for_salary_department.T6) AS T,salary_for_salary_department.T7,
                employees_salary_department.basic_pay AS BASIC1,
                CAST((employees_salary_department.basic_pay) AS DECIMAL(11,2)) AS TOTAL1,salary_for_salary_department.BASIC AS BASIC2,CAST((salary_for_salary_department.BASIC) AS DECIMAL(11,2)) AS TOTAL2,
                salary_for_salary_department.HRAAMT,salary_for_salary_department.GROSS,salary_for_salary_department.PFAMT,salary_for_salary_department.ESIAMT,salary_for_salary_department.TAX,
                salary_for_salary_department.INS,salary_for_salary_department.LOAN,salary_for_salary_department.DEDUC,salary_for_salary_department.NET, no_of_part, rate_per_part
                FROM salary_for_salary_department
                INNER JOIN(employees_salary_department)
                ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
                WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id IN ($new_iter)
                ORDER BY employees_salary_department.name";
        
            $res = $this->db->query($sql)->result();
            if(count($res) > 0) {
                foreach($res as $r) {
                    $data['result'][] = $this->_fetch_esi_pf($mon,$r->e_id);
                }
            }
            
            $data['segment'] = 'payroll_pf';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
        if($this->input->post("ot")){
            $it_arr = $this->input->post('leather[]');
            $mon = $this->input->post('month');
            $data['mont'] = $mon;
            
            $new_iter = implode(",", $it_arr);
            
            
                
                $sql="SELECT employees.e_id
        FROM employees
        WHERE employees.e_id IN ($new_iter)
        ORDER BY employees.name";
        
        $res = $this->db->query($sql)->result();
        if(count($res) > 0) {
            foreach($res as $r) {
        $data['result'][] = $this->_fetch_ot_details_all($mon,$r->e_id);
        }
            }
            
            $data['segment'] = 'ot_details';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }
            
        $data['fetch_all_employee'] = $this->db->get_where('employees', array('user_id' => 17))->result();    
        $data['fetch_all_contractors'] = $this->db->get_where('contractor_master', array('status' => 1))->result();                
        $data['departments'] = $this->db->get_where('departments', array('user_id' => 17))->result();
        
        return array('page'=>'reports/payroll_reports_v', 'data'=>$data);
    }

    public function _fetch_advance_ledger($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        $user_id = $this->session->userdata['accnt']['user_id'];
        
            $sql="SELECT advance.emp_id,advance.amount AS ADV, MONTHNAME(advance.date) AS MONNAME, advance.date, employees.name, employees.e_code, 1 AS TAG
        FROM advance
        INNER JOIN(employees)
        ON(advance.emp_id=employees.e_id)
        WHERE advance.emp_id = '".$i_a."'
        ORDER BY employees.name, advance.date";

        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;

    }

    public function _fetch_leave($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->userdata['accnt']['user_id'];
            
        $sql="SELECT employees.* 
            FROM employees
            WHERE employees.e_id='".$i_a."'
            ORDER BY employees.name";    
            
        $res = $this->db->query($sql)->result();
        return $res;
      
    }

    public function _fetch_esi_pf($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->userdata['accnt']['user_id'];
            
        $sql="SELECT employees_salary_department.name,e_code,employees_salary_department.pf_acc_no,
            employees_salary_department.esi_acc_no,salary_for_salary_department.T1, salary_for_salary_department.T7,
            salary_for_salary_department.T2,salary_for_salary_department.BASIC AS TOTAL2,salary_for_salary_department.BASIC AS TOTAL3,
            salary_for_salary_department.GROSS,employees_salary_department.pf_percentage_calculation, salary_for_salary_department.PFAMT, 
            no_of_part, rate_per_part, pay_for_holiday, pay_for_leave
            FROM salary_for_salary_department
            INNER JOIN(employees_salary_department)
            ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
            WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id='".$i_a."' AND employees_salary_department.pf = '1'
            ORDER BY employees_salary_department.e_code";   
            
        $res = $this->db->query($sql)->result();
        return $res;
        

    }
    
    public function _fetch_esi_pf1($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        
        $user_id = $this->session->userdata['accnt']['user_id'];
            
        $sql="SELECT employees_salary_department.name,e_code,employees_salary_department.pf_acc_no,employees_salary_department.esi_acc_no,salary_for_salary_department.T1, salary_for_salary_department.T7 ,salary_for_salary_department.T2,CAST((salary_for_salary_department.BASIC) AS DECIMAL(11,2)) AS TOTAL2,salary_for_salary_department.BASIC AS TOTAL3,salary_for_salary_department.GROSS,employees_salary_department.pf_percentage_calculation
            FROM salary_for_salary_department
            INNER JOIN(employees_salary_department)
            ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
            WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id='".$i_a."' AND employees_salary_department.esi = '1'
            ORDER BY employees_salary_department.e_code";   
            
              
        $res = $this->db->query($sql)->result();
        return $res;
        

    }

    public function _fetch_register($mon,$i_a) {
        
        if(empty($i_a)) {
            die('No Details To Show');
        }
        $user_id = $this->session->userdata['accnt']['user_id'];
        $sql="SELECT employees_salary_department.name,employees_salary_department.e_code,salary_for_salary_department.T1,salary_for_salary_department.T2,
        salary_for_salary_department.T3,T4, T5, T6, (salary_for_salary_department.T4+salary_for_salary_department.T5+salary_for_salary_department.T6) AS T,
        salary_for_salary_department.T7,employees_salary_department.basic_pay AS BASIC1,
        contractor_master.name as contractor_name,
        CAST((employees_salary_department.basic_pay) AS DECIMAL(11,2)) AS TOTAL1,salary_for_salary_department.BASIC AS BASIC2,
        CAST((salary_for_salary_department.BASIC) AS DECIMAL(11,2)) AS TOTAL2, salary_for_salary_department.HRAAMT,salary_for_salary_department.GROSS,
        salary_for_salary_department.PFAMT,salary_for_salary_department.ESIAMT,salary_for_salary_department.TAX,salary_for_salary_department.INS,
        salary_for_salary_department.LOAN,salary_for_salary_department.DEDUC,salary_for_salary_department.NET, employees_salary_department.cutting_rate,
        no_of_part,rate_per_part,pay_for_holiday,pay_for_leave
        
        FROM salary_for_salary_department
        INNER JOIN(employees_salary_department) ON(salary_for_salary_department.EMPCODE=employees_salary_department.e_id)
        INNER JOIN(contractor_master) ON(contractor_master.am_id=employees_salary_department.c_id)
        WHERE salary_for_salary_department.MON LIKE '".$mon."%' AND employees_salary_department.e_id IN('".$i_a."')
        ORDER BY contractor_name, employees_salary_department.name";    
            
        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;
    }
    
    public function _fetch_ot_details_all($mon,$i_a) {
        if(empty($i_a)) {
            die('No Details To Show');
        }
        $user_id = $this->session->userdata['accnt']['user_id'];
            
        $sql="SELECT employees.name,overtime.*
        FROM overtime
        INNER JOIN(employees)
        ON(overtime.e_id=employees.e_id)
        WHERE overtime.month LIKE '".$mon."%' AND employees.e_id IN('".$i_a."')
        ORDER BY employees.name";    
            
        $res = $this->db->query($sql)->result();
        // echo $this->db->last_query();die;
        return $res;
        
    }
    
    public function overtime_reports_details_m() {
        $data = [];
        if($this->input->post()){
            $la = implode (",", $this->input->post('leather'));
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $data['result'] = $this->_fetch_overtime_checking_entry_details($la, $from, $to);
            $data['segment'] = 'overtime_checking_entry_details';
            return array('page'=>'reports/common_print_v','data'=>$data);
        }

        $data['departments'] = $this->db->get_where('departments', array('user_id' => 17))->result();

        return array('page'=>'reports/overtime_report_v', 'data'=>$data);
    }

    public function _fetch_overtime_checking_entry_details($la, $from, $to) {

        $query = "SELECT
                employees.name as emp_name,
                employees.e_id
                FROM
                `checking`
                LEFT JOIN employees ON employees.e_id = checking.e_id
            WHERE 
            checking.e_id IN ($la) AND
            STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(checking.checking_entry_date, '%Y-%m-%d') >= '$from'
            AND
                checking.status = 1
            GROUP BY
                checking.e_id";
        $res = $this->db->query($query)->result();

    return $res;

    }

    // public function article_master_report($mon,$pos) {

    //     $sql="SELECT employees.name,salary.T1,salary.T2,salary.T3,(salary.T4+salary.T5+salary.T6) AS T,salary.T7,employees.basic_pay AS BASIC1,employees.da_amout AS DA1,
    // CAST((employees.basic_pay+employees.da_amout) AS DECIMAL(11,2)) AS TOTAL1,salary.BASIC AS BASIC2,salary.DA AS DA2,CAST((salary.BASIC+salary.DA) AS DECIMAL(11,2)) AS TOTAL2,
    // salary.HRA,salary.CONV,salary.MED,salary.OA,salary.GROSS,salary.PFAMT,salary.ESIAMT,salary.TAX,salary.INS,salary.LOAN,salary.DEDUC,salary.NET
    //     FROM salary
    //     INNER JOIN(employees)
    //     ON(salary.EMPCODE=employees.e_id)
    //     WHERE salary.MON LIKE '".$mon."%' AND employees.working_place='".$pos."'
    //     ORDER BY employees.e_code";

    //     $res = $this->db->query($sql)->result();
    //     // echo $this->db->last_query();die;
    //     return $res;

    // }
    
}//end ctrl
?>