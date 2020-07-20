<?php
class Logout extends CI_Controller {

    function __construct() {      
        parent::__construct();
    }
    
    public function index(){
        /*
        $arr_session = $this->session->userdata();
        echo '<pre>';
        print_r($arr_session);
        echo  '</pre>';
        */

        $this->session->sess_destroy();

        delete_cookie('sm_cookie');

        redirect("login","refresh");
        exit();

    }//end f.index





}//class

