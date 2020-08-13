<?php
class Setprogram extends CI_Controller {
    
    function __construct() {      
        parent::__construct();
        $this->hrdi001 = $this->load->database('first', TRUE);
        $this->hrdi002 = $this->load->database('second', TRUE);
        $this->hrdi003 = $this->load->database('third', TRUE);

    }


    public function index(){

        if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
            
            $site = $this->session->userdata('farm_site');
            
            $this->session->set_userdata('setprogram_site', $site);
            redirect("setprogram/program_choice_zone","refresh");
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

            $menu['active'] = 'setprogram';
            $this->load->view('layout/header_view',$menu);
            $this->load->view('setprogram/program_choice_site_view',$data);
            $this->load->view('layout/script_view');
            $this->load->view('setprogram/script/program_choice_site_script_view');
            $this->load->view('layout/footer_view');
         

        }

    }//end f.index

    
    public function program_set_site(){

        if($this->input->post()){

            $site = $this->input->post("site");
            $this->session->set_userdata('setprogram_site', $site);

            echo json_encode('');
            return;
        }else{
            redirect("setprogram","refresh");
            exit();
        }//if-post//if-post

    }// fn.program_set_site


    public function program_choice_zone(){

        $site = $this->session->userdata('setprogram_site');

        $query = $this->$site->query("SELECT * FROM `farm` ORDER BY `fid` ");
        $result_db = $query->result_array();

        $name_house[1] = "โรงเรือน 1";
        $name_house[2] = "โรงเรือน 2";
        $name_house[3] = "โรงเรือน 3";
        $name_house[4] = "โรงเรือน 4";
        
        $data['result_db'] = $result_db;
        $data['name_house'] = $name_house;

        $menu['active'] = 'setprogram';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('setprogram/program_choice_zone_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('setprogram/script/program_choice_zone_script_view');
        $this->load->view('layout/footer_view');

    }//end f.program_choice_zone


    public function set_choice_zone(){
        if($this->input->post()){

            $zone = $this->input->post("zone");
            $this->session->set_userdata('setprogram_zone', $zone);

            echo json_encode('');
            return;
        }else{
            redirect("setprogram","refresh");
            exit();
        }//if-post//if-post

    }//end f.set_choice_zone


    public function setting_program(){
        $site = $this->session->userdata('setprogram_site');
        $zone = $this->session->userdata('setprogram_zone');

        $query = $this->$site->query("SELECT * FROM `farm` WHERE fid = '$zone' ");
        $result_farm = $query->row_array();

        $query = $this->$site->query("SELECT * FROM `pump` WHERE fid = '$zone' ");
        $result_time = $query->result_array();

        $data['result_farm'] = $result_farm;
        $data['result_time'] = $result_time;
    

        $menu['active'] = 'setprogram';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('setprogram/setting_program_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('setprogram/script/setting_program_script_view');
        $this->load->view('layout/footer_view');

    }//end f.setting_program


    public function submit_program(){

        if($this->input->post()){

            $site = $this->session->userdata('setprogram_site');
            $zone = $this->session->userdata('setprogram_zone');

            $save_program = $this->input->post("program");
            $time = $save_program['time'];


            $this->$site->query(" UPDATE farm set 
                                    `utime` = '".date('Y-m-d H:i:s')."',
                                    `ecset` = '".$save_program['ec']."',
                                    `tmx` = '".$save_program['temp_max']."',
                                    `tmn` = '".$save_program['temp_min']."',
                                    `hmx` = '".$save_program['hud_max']."',
                                    `hmn` = '".$save_program['hud_min']."'
                                    WHERE fid ='$zone' ");

            $add_log_program['site_code'] = $site;
            $add_log_program['fid'] = $zone;
            $add_log_program['ec'] = $save_program['ec'];
            $add_log_program['temp_max'] = $save_program['temp_max'];
            $add_log_program['temp_min'] = $save_program['temp_min'];
            $add_log_program['hud_max'] = $save_program['hud_max'];
            $add_log_program['hud_min'] = $save_program['hud_min'];
            $add_log_program['log_date'] = date('Y-m-d H:i:s');
            $add_log_program['user_id'] = $this->session->userdata('user_id');

            $i = 1;
            foreach($time as $key=>$val){
                $add_log_program['time'.$i.'_st'] = $val['st'];
                $add_log_program['time'.$i.'_et'] = $val['et'];
                $i++;

                $this->$site->query(" UPDATE pump set `st` = '".$val['st']."', `et` = '".$val['et']."'
                                    WHERE fid ='$zone' AND vpin ='$key'  ");
            }

            $this->db->insert('program_log',$add_log_program);


            redirect("setprogram/program_choice_zone","refresh");
            exit();


        }else{
            redirect("setprogram","refresh");
            exit();
        }//if-post//if-post

    }//end f.setting_program

    
}
