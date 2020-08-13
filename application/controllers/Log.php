<?php
class Log extends CI_Controller {

    function __construct() {      
        parent::__construct();
    }

    public function index(){

        redirect("log/log_control","refresh");

    }// fn.index
    
    public function log_control(){

        $query = (" SELECT control_log.*, sites.site_name, users.username
                    FROM `control_log`
                    LEFT JOIN sites ON control_log.site_code = sites.site_code
                    LEFT JOIN users ON control_log.user_id = users.id ");
        $Result = $this->db->query($query);
        $control_log = $Result->result_array();

        $data['control_log'] = $control_log;

        
        $menu['active'] = 'log_control';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('log/log_control_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('log/script/log_control_script_view');
        $this->load->view('layout/footer_view');
        

    }//end f.log_control



    public function log_program(){

        $query = (" SELECT program_log.*, sites.site_name, users.username
                    FROM `program_log`
                    LEFT JOIN sites ON program_log.site_code = sites.site_code
                    LEFT JOIN users ON program_log.user_id = users.id ");
        $Result = $this->db->query($query);
        $program_log = $Result->result_array();

        $data['program_log'] = $program_log;


        $menu['active'] = 'log_program';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('log/log_program_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('log/script/log_program_script_view');
        $this->load->view('layout/footer_view');
        

    }//end f.log_program

    


}//class

