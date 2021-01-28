<?php
class Log extends CI_Controller {

    function __construct() {      
        parent::__construct();
        $this->hrdi001 = $this->load->database('first', TRUE);
        $this->hrdi002 = $this->load->database('second', TRUE);
        $this->hrdi003 = $this->load->database('third', TRUE);
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


    public function log_tavg_and_havg(){

        $query = ("SELECT * FROM sites WHERE delete_date ='0000-00-00 00:00:00' ");
        $Result = $this->db->query($query);
        $get_site = $Result->result_array();

        $farm_site=[];
        foreach($get_site as $key=>$site){
            $farm_site[$site['site_code']]=$site['site_name'];
        }

        $data['farm_site'] = $farm_site;

        $menu['active'] = 'log_tavg_and_havg';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('log/log_tavg_and_havg_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('log/script/log_tavg_and_havg_script_view');
        $this->load->view('layout/footer_view');


    }//end f.log_tavg_and_havg


    public function getData_tavg_and_havg(){

        if($this->input->post()){

            $site = $this->input->post("select_site");
            $startDate = $this->input->post("select_startDate");
            $endDate = $this->input->post("select_endDate");

            /*
            $site = 'hrdi001';
            $startDate = '2021-01-13';
            $endDate = '2021-01-13';
            */
            $step = 900;

            $query = (" SELECT * from 
                        ( SELECT *, ROUND(avg(tavg), 2) as my_tavg, ROUND(avg(havg), 2) as my_havg,
                            from_unixtime((unix_timestamp(utime) - (unix_timestamp(utime) % $step))) AS dt_utime
                            from farmavg
                            where utime >= '".$startDate." 00:00:00' and utime <= '".$endDate." 23:59:59'
                            group by (unix_timestamp(utime) DIV $step), fid ORDER BY dt_utime, fid asc
                        ) vv 
                        where  vv.dt_utime >= '".$startDate." 00:00:00' and vv.dt_utime <= '".$endDate." 23:59:59'
                    ");

            $Result = $this->$site->query($query);
            $get_data = $Result->result_array();

            $no = 0;
            foreach ($get_data as $key => $item) {
                $get_data[$key]['no'] = ++$no;
            }



/*
            echo '<pre>';
            print_r($get_data);
            echo  '</pre>';
*/

            echo json_encode($get_data);
            return;


        }
    }//end f.getData_tavg_and_havg



}//class

