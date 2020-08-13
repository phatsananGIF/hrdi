<?php
class Controlsensor extends CI_Controller {

    function __construct() {      
        parent::__construct();
        $this->hrdi001 = $this->load->database('first', TRUE);
        $this->hrdi002 = $this->load->database('second', TRUE);
        $this->hrdi003 = $this->load->database('third', TRUE);
    }
    
    public function index(){

        if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
            
            $site = $this->session->userdata('farm_site');
            
            $this->session->set_userdata('controlsensor_site', $site);
            redirect("controlsensor/choice_zone","refresh");
            exit();
            
        }else{
            
            $query = ("SELECT * FROM sites WHERE delete_date ='0000-00-00 00:00:00' ");
            $Result = $this->db->query($query);
            $get_site = $Result->result_array();

            $farm_site=[];
            foreach($get_site as $key=>$site){
                $farm_site[$site['site_code']]=$site['site_name'];
            }

            $data['farm_site'] = $farm_site;

            $menu['active'] = 'controlsensor';
            $this->load->view('layout/header_view',$menu);
            $this->load->view('controlsensor/controlsensor_view',$data);
            $this->load->view('layout/script_view');
            $this->load->view('controlsensor/script/controlsensor_script_view');
            $this->load->view('layout/footer_view');

        }

    }//end f.index


    public function set_select_site(){

        if($this->input->post()){

            $site = $this->input->post("site");
            $this->session->set_userdata('controlsensor_site', $site);

            echo json_encode('');
            return;
        }else{
            redirect("controlsensor","refresh");
            exit();
        }//if-post//if-post

    }// fn.set_select_site


    public function choice_zone(){

        $site = $this->session->userdata('controlsensor_site');

        $query = $this->$site->query("SELECT * FROM `farm` ORDER BY `fid` ");
        $result_db = $query->result_array();

        $name_house[1] = "โรงเรือน 1";
        $name_house[2] = "โรงเรือน 2";
        $name_house[3] = "โรงเรือน 3";
        $name_house[4] = "โรงเรือน 4";
        
        $data['result_db'] = $result_db;
        $data['name_house'] = $name_house;

        $menu['active'] = 'controlsensor';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('controlsensor/choice_zone_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('controlsensor/script/choice_zone_script_view');
        $this->load->view('layout/footer_view');

    }// fn.choice_zone


    public function set_choice_zone(){

        if($this->input->post()){

            $zone = $this->input->post("zone");
            $this->session->set_userdata('controlsensor_zone', $zone);

            echo json_encode('');
            return;
        }else{
            redirect("controlsensor","refresh");
            exit();
        }//if-post//if-post

    }// fn.set_choice_zone


    public function control(){

        $site = $this->session->userdata('controlsensor_site');
        $zone = $this->session->userdata('controlsensor_zone');

        $query = $this->$site->query("SELECT * FROM `farm` WHERE fid = '$zone' ");
        $result_db = $query->row_array();
        
        $class_sensor['pumpst'] = "heartbeat";
        $class_sensor['fanst'] = "rotate-center";
        $class_sensor['fogst'] = "flicker-1";

        $color_sensor[''] = "555555";
        $color_sensor['OFF'] = "DE3C30";
        $color_sensor['ON'] = "76ab39";

        $data['data_zone'] = $result_db;
        $data['class_sensor'] = $class_sensor;
        $data['color_sensor'] = $color_sensor;

        $menu['active'] = 'controlsensor';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('controlsensor/control_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('controlsensor/script/control_script_view');
        $this->load->view('layout/footer_view');

    }// fn.control


    public function update_sw(){

        if($this->input->post()){

            $site = $this->session->userdata('controlsensor_site');
            $zone = $this->session->userdata('controlsensor_zone');
            $type_sensor = $this->input->post("type_sensor");
            $sw_actions = $this->input->post("sw_actions");

            $query = $this->$site->query("SELECT * FROM `farm` WHERE fid = '$zone' ");
            
            $this->$site->query(" UPDATE farm set $type_sensor='$sw_actions'  WHERE fid ='$zone' ");

            
            $add_log_control['site_code'] = $site;
            $add_log_control['fid'] = $zone;
            $add_log_control['type_sensor'] = $type_sensor;
            $add_log_control['status'] = $sw_actions;
            $add_log_control['log_date'] = date('Y-m-d H:i:s');
            $add_log_control['user_id'] = $this->session->userdata('user_id');
            
            $this->db->insert('control_log',$add_log_control);


            echo json_encode('');
            return;

        }else{
            redirect("controlsensor","refresh");
            exit();
        }//if-post//if-post

    }// fn.update_sw


    public function test_log(){

        $add_log_control['site_code'] = '0000';
        $add_log_control['fid'] = '000';
        $add_log_control['type_sensor'] = '000';
        $add_log_control['status'] = '000';
        $add_log_control['log_date'] = date('Y-m-d H:i:s');
        $add_log_control['user_id'] = $this->session->userdata('user_id');
        
        $this->db->insert('control_log',$add_log_control);

    }




}//class

