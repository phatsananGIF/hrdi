<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manage extends CI_Controller {
    
    function __construct() {      
        parent::__construct();

    }


    public function index(){
        
        $this->load->helper('form');

        $data['command'] = array(
            'backup'=>'สำรอง config',
            'patch' => 'Patch'
        );

        $SQL="SELECT * FROM `sites` ORDER BY `site_code` ";
        $result=$this->db->query($SQL);
        $data['sites']=$result;
        
        $this->load->view('manage/manage_index',$data);
    }

    public function run()
    {
        print_r($this->input->post());
        
    }
}
