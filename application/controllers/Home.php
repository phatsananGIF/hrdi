<?php
class Home extends CI_Controller {

    function __construct() {      
        parent::__construct();
        $this->hrdi001 = $this->load->database('first', TRUE);
        $this->hrdi002 = $this->load->database('second', TRUE);
        $this->hrdi003 = $this->load->database('third', TRUE);
    }
    
    public function index(){

        $data['farm_site']['hrdi001'] = "แม่ระเมิง";
        $data['farm_site']['hrdi002'] = "วะโดรโกร";
        $data['farm_site']['hrdi003'] = "แม่สามแลบ";

        $menu['active'] = 'home';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('home/home_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('home/script/home_script_view');
        $this->load->view('layout/footer_view');

    }// fn.index


    public function getdata(){

        if($this->input->post()){

            $site = $this->input->post("site");

            $query = $this->$site->query("SELECT * FROM `farm` ORDER BY `fid` ");
            $result_db = $query->result_array();
            
            $name_house[1] = "โรงเรือน 1";
            $name_house[2] = "โรงเรือน 2";
            $name_house[3] = "โรงเรือน 3";
            $name_house[4] = "โรงเรือน 4";

            $color_sensor['OFF'] = "DE3C30";
            $color_sensor['ON'] = "76ab39";
            $color_sensor[''] = "555555";

            $data_result['result_db'] = $result_db;
            $data_result['name_house'] = $name_house;
            $data_result['color_sensor'] = $color_sensor;

            echo json_encode($data_result);
            return;

        }else{
            redirect("home","refresh");
            exit();
        }//if-post//if-post


    }// fn.getdata_sensor




}//class