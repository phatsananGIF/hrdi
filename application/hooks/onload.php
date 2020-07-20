<?php
class Onload{
    
    private $ci;

    function __construct() {     
        $this->ci =&get_instance();
        
    }
    

    public function check_login(){
        if ( PHP_SAPI != 'cli' ) {
            $controller = $this->ci->router->class;
            $method = $this->ci->router->method;
            $this->ci->load->database();
            $datetoday = date("Y-m-d H:i:s");

            if(isset($_COOKIE['sm_cookie']) && isset($this->session)){
                $data = json_decode($_COOKIE['sm_cookie'], true);
                $this->ci->session->set_userdata($data);

            }

            if($this->ci->session->userdata("user_id")==NULL){

                if($controller != "login"){
                    redirect("login","refresh");
                    exit();
                }
                

            }else{

                $type_user = $this->ci->session->userdata('group');
                if($controller == "login"){
                    redirect("","refresh");
                    exit();
                }
                
                if( $type_user == 'Admin' && ($controller == "relay" || $controller == "zone" || $controller == "sensor" || $controller == "gauge") ){
                    redirect("","refresh");
                    exit();
                }
            }
        }
        
    }

}
?>