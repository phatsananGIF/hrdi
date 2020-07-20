<?php
class Monitor extends CI_Controller {

    function __construct() {
        parent::__construct();

    }
    
    public function index(){
        if($this->session->group != 'Supper_admin'){
            redirect("","refresh");
            exit();
        }

        
        $menu['active'] = 'monitor';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('monitor/monitor_view');
        $this->load->view('layout/script_view');
        $this->load->view('monitor/script/monitor_script_view');
        $this->load->view('layout/footer_view');
        
        
    }// fn.index


    public function get_site(){
        
        if($this->input->post()){
            /*
            $query = (" SELECT sites.id, sites.site_code, sites.site_name,
                        (SELECT dataloggers.valuedate FROM dataloggers WHERE dataloggers.site_id = sites.site_code 
                            ORDER BY valuedate DESC LIMIT 1) as valuedate,
                        (SELECT if( (unix_timestamp(now()) - unix_timestamp(valuedate)) <= 300, 'green', 'red' ) ) as online_in_5min
                        FROM sites
                        WHERE delete_date ='0000-00-00 00:00:00'
                        GROUP BY sites.site_code
                        ORDER BY id ASC ");
            $query_db = $this->db->query($query);
            $get_site = $query_db->result_array();
            */

            
            $query = (" SELECT sites.id, sites.site_code, sites.site_name
                        FROM sites
                        WHERE delete_date ='0000-00-00 00:00:00'
                        ORDER BY id ASC ");
            $query_db = $this->db->query($query);
            $get_site = $query_db->result_array();

            

            foreach($get_site as $key=>$item){
                $query = (" SELECT valuedate FROM dataloggers WHERE site_id = '".$item['site_code']."' ORDER BY valuedate DESC LIMIT 1");
                $query_db = $this->db->query($query);
                $get_valuedate = $query_db->row_array();

                $get_site[$key]['valuedate'] = $get_valuedate['valuedate'];

                $Min = $get_valuedate['valuedate'];
                $Max = date("Y-m-d H:i:s");
                $date_online = strtotime($Max) - strtotime($Min);

                $onlineStatus = 'red';
                if($date_online <= 300){
                    $onlineStatus = 'green';
                }
                $get_site[$key]['online_in_5min'] = $onlineStatus;
                
            }
            
            
            $Result['get_site'] = $get_site;
            echo json_encode($Result);
            return;
            
        }//if-post
        redirect("monitor","refresh");
        exit();
        
    }// fn.get_site




    public function get_site_test(){
        

        $query = (" SELECT sites.id, sites.site_code, sites.site_name
                    FROM sites
                    WHERE delete_date ='0000-00-00 00:00:00'
                    ORDER BY id ASC ");
        $query_db = $this->db->query($query);
        $get_site = $query_db->result_array();

        

        foreach($get_site as $key=>$item){
            $query = (" SELECT valuedate FROM dataloggers WHERE site_id = '".$item['site_code']."' ORDER BY valuedate DESC LIMIT 1");
            $query_db = $this->db->query($query);
            $get_valuedate = $query_db->row_array();

            $get_site[$key]['valuedate'] = $get_valuedate['valuedate'];

            $Min = $get_valuedate['valuedate'];
            $Max = date("Y-m-d H:i:s");
            $date_online = strtotime($Max) - strtotime($Min);

            $onlineStatus = 'red';
            if($date_online <= 300){
                $onlineStatus = 'green';
            }
            $get_site[$key]['online_in_5min'] = $onlineStatus;
            
        }

        echo '<pre>';
        print_r($get_site);
        echo  '</pre>';

        
    
    }// fn.get_site_test


}//class