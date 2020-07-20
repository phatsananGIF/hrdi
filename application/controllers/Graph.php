<?php
class Graph extends CI_Controller {

    function __construct() {
        parent::__construct();

    }
    
    
    public function index(){
        
        $user_id = $this->session->userdata('user_id');
        if($this->session->userdata('group') == 'Admin' || $this->session->userdata('group') == 'Supper_admin')$user_id='%';

        $query = ("SELECT * FROM sites WHERE users_id like '$user_id' AND delete_date ='0000-00-00 00:00:00' ");
        $Result = $this->db->query($query);
        $get_site = $Result->result_array();


        if($this->session->site_code == ''){
            $site_session['site_id'] = $get_site[0]['id'];
            $site_session['site_code'] = $get_site[0]['site_code'];
            $this->session->set_userdata($site_session);
        }


        $data['site_list'] = $get_site;
        $menu['active'] = 'graph';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('graph/graph_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('graph/script/graph_script_view');
        $this->load->view('layout/footer_view');

    }// fn.index



    public function submit_search_graph(){

        if($this->input->post()){
            
            $search_graph = $this->input->post("search_graph");

            //--get site data
            $query = ("SELECT * FROM sites WHERE site_code = '".$search_graph['site_select']."' AND delete_date = '0000-00-00 00:00:00' ");
            $Result = $this->db->query($query);
            $get_site = $Result->row_array();
            
            
            $query = (" SELECT * FROM `sensors` WHERE site_id='".$get_site['id']."' ORDER BY `sensor_input` ASC ");
            $Result = $this->db->query($query);
            $h_sensors = $Result->result_array();



            $from_date = $search_graph['from_date'].' 00:00:00';
            $to_date = $search_graph['to_date'].' 23:59:59';
            
            /*
            $from_date ='2019-07-08 00:00:00';
            $to_date ='2019-07-08 23:59:59';
            */

            $Min = $search_graph['from_date'] . " 00:00:00";
            $Max = $search_graph['to_date'] ." 23:59:59";
            $date_select = strtotime($Max) - strtotime($Min);
            $count_date = $this->time2String($date_select);
            $mini = 300;

            if( $count_date['day'] >= 1 )
            {
                $mini=1800;
            }
            if( $count_date['day'] >= 3 )
            {
                $mini=2700;
            }
            if ( $count_date['day'] >= 7)
            {
                $mini=3600;
            }
            if ($count_date['day'] >= 14)
            {
                $mini=7200;
            }
            if ( $count_date['day'] >= 30 ) {
                $mini=86400;
            }
            if( $count_date['day'] >= 60 )
            {
                $mini=172800;
            }

            if($count_date['day'] ==0 )
            {
                if($count_date['hour'] >= 6 )
                {
                    $mini=1500;
                }
            }

           // echo $mini;
           //die();
          //  print_r($count_date);

           //die();
            /*
            if ($count_date['day'] >= 0 && $count_date['day'] <= 1){
                $mini = 3600;

            }else if ($count_date['day'] > 1 && $count_date['day'] <= 7){
                $mini = 21600;
                
            }else if ($count_date['day'] > 7 && $count_date['day'] <= 30){
                $mini = 86400;
                
            }else if ($count_date['day'] > 30 && $count_date['day'] <= 60){
                $mini = 172800;
                
            }*/

            $query = (" SELECT d1.id, d1.site_id, data_header, AVG(data_values) as dAVG, 
                        UNIX_TIMESTAMP(valuedate) DIV ($mini) as timeGroup,
                        FROM_UNIXTIME(UNIX_TIMESTAMP(valuedate)- UNIX_TIMESTAMP(valuedate) % ($mini)) as tagDateTime 
                        FROM dataloggers d1 join dataloggers_values d2 on  d1.id = d2.dataloggers_id
                        WHERE site_id = '".$get_site['site_code']."' and data_values != 'N/A' and valuedate between '$Min' and '$Max'
                        group by timeGroup, data_header ");

            $Result = $this->db->query($query);
            $dataloggers = $Result->result_array();

           //echo $this->db->last_query();
            //die();
            $graph_data = array();
            $lineColors = array();


            foreach($dataloggers as $item){
                $graph_data[$item['data_header']][] = ['period' => $item['tagDateTime'],
                                                            $item['data_header'] => (float)$item['dAVG']
                                                        ];
                            
                $lineColors[$item['data_header']] = '#'.$this->random_color();

            }
            

            $data['h_sensors'] = $h_sensors;
            $data['graph_data'] = $graph_data;
            $data['lineColors'] = $lineColors;


            
            $menu['active'] = 'graph';
            $this->load->view('layout/header_view',$menu);
            $this->load->view('graph/show_graph_view',$data);
            $this->load->view('layout/script_view');
            $this->load->view('graph/script/show_graph_script_view');
            $this->load->view('layout/footer_view');
            
        }else{
            redirect("graph","refresh");
            exit();
        }//if-post
        

        
    }// fn.submit_search_graph


    public function random_color_part(){
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }// fn.random_color_part
    
    public function random_color(){
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }// fn.random_color

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