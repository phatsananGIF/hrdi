<?php
class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->hrdi001 = $this->load->database('first', TRUE);
        $this->hrdi002 = $this->load->database('second', TRUE);
        $this->hrdi003 = $this->load->database('third', TRUE);
    }
    
    public function index(){

        $query = ("SELECT * FROM sites WHERE delete_date ='0000-00-00 00:00:00' ");
        $Result = $this->db->query($query);
        $get_site = $Result->result_array();

        $farm_site=[];
        foreach($get_site as $key=>$site){
            $farm_site[$site['site_code']]=$site['site_name'];

        }

        $data['farm_site'] = $farm_site;

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

            $query = $this->$site->query(" SELECT tt.* FROM farmavg tt
                                    INNER JOIN
                                        (SELECT fid, MAX(utime) AS MaxDateTime
                                        FROM farmavg 
                                        GROUP BY fid) groupedtt 
                                    ON tt.fid = groupedtt.fid
                                    AND tt.utime = groupedtt.MaxDateTime ");
            $result_farmavg_db = $query->result_array();

            $farmavg = [];
            foreach($result_farmavg_db as $val){
                $farmavg[$val['fid']] = $val;
            }

            $name_house[1] = "โรงเรือน 1";
            $name_house[2] = "โรงเรือน 2";
            $name_house[3] = "โรงเรือน 3";
            $name_house[4] = "โรงเรือน 4";

            $color_sensor['OFF'] = "DE3C30";
            $color_sensor['ON'] = "76ab39";
            $color_sensor[''] = "555555";

            $data_result['result_db'] = $result_db;
            $data_result['farmavg'] = $farmavg;
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