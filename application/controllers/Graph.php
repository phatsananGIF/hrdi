<?php
class Graph extends CI_Controller {

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
        
        $menu['active'] = 'graph';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('graph/graph_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('graph/script/graph_script_view');
        $this->load->view('layout/footer_view');

    }// fn.index


    public function get_data_chart(){

        if($this->input->post()){
            
            $site = $this->input->post("select_site");
            $zone = $this->input->post("select_zone");
            $startDate = $this->input->post("select_startDate");
            $endDate = $this->input->post("select_endDate");
            
            /*
            $site = 'hrdi001';
            $zone = '1';
            $startDate = '2020-08-07';
            $endDate = '2020-08-07';
            */

            //num day
            $Min = $startDate . " 00:00:00";
            $Max = $endDate ." 23:59:59";
            $date_select = strtotime($Max) - strtotime($Min);
            $count_date = $this->time2String($date_select);
            $step = 300;

            if( $count_date['day'] >= 1 )
            {
                $step=1800;
            }
            if( $count_date['day'] >= 3 )
            {
                $step=2700;
            }
            if ( $count_date['day'] >= 7)
            {
                $step=3600;
            }
            if ($count_date['day'] >= 14)
            {
                $step=7200;
            }
            if ( $count_date['day'] >= 30 ) {
                $step=86400;
            }
            if( $count_date['day'] >= 60 )
            {
                $step=172800;
            }

            if($count_date['day'] ==0 )
            {
                if($count_date['hour'] >= 6 )
                {
                    $step=1500;
                }
            }

            $query = (" SELECT fid, REPLACE(FORMAT(avg(tavg),1),',','') as tavgValue ,
                        REPLACE(FORMAT(avg(havg),1),',','') as  havgValue ,
                        (unix_timestamp(utime) DIV $step) as timeTag , 
                        (unix_timestamp(utime) - (unix_timestamp(utime) % $step)) as unixtime ,
                        from_unixtime((unix_timestamp(utime) - (unix_timestamp(utime) % $step))) AS dt 
                        FROM  farmavg  WHERE fid= '$zone' 
                        AND utime  Between '".$startDate." 00:00:00' AND '".$endDate." 23:59:59'
                        GROUP BY timeTag ORDER BY utime ASC ");
            $Result = $this->$site->query($query);
            $get_data = $Result->result_array();

            foreach($get_data as $item){
                $data_chart['data_arr'][] = ['numdate' => $item['dt'], 'tavgValue' => $item['tavgValue'], 'havgValue' => $item['havgValue'] ];
            }

            $H_title = array('อุณหภูมิ', 'ความชื้น');
            $y_title = array('tavgValue', 'havgValue');
            $data_chart['ykeys'] = $y_title;
            $data_chart['labels'] = $H_title;
            $data_chart['lineColors'] = array('#fc5603', '#0e9dc4');

            /*
            echo '<pre>';
            print_r($data_chart);
            echo  '</pre>';
            */

            $data_result['get_data'] = $get_data;
            $data_result['data_chart'] = $data_chart;
            echo json_encode($data_result);
            return;

        }//if-post
        redirect("home","refresh");
        exit();

    }// fn.get_data_chart


    public function time2String($time = ""){
        $minute = 60;
        $hour = 3600;
        $day = 86400;
        $string['day'] = (int)($time / $day);
        $time = $time % $day ;
        $string['hour'] = (int)($time / $hour);
        $time = $time % $hour ;
        $string['minute'] = (int)($time / $minute);
        $string['second'] = $time % $minute;
        return $string;
    }// fn.time2String



}//class