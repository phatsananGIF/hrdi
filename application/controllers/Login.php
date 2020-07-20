<?php
class Login extends CI_Controller {

    function __construct() {      
        parent::__construct();
    }
    
    public function index(){
        
        if($this->input->post('submit') != null){
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules(
                'userlogin', 'ชื่อผู้ใช้',
                'required|trim|callback_userlogin_check',
                array('required' => 'กรุณาใส่ %s')

            );

            $this->form_validation->set_rules(
                'passlogin', 'รหัสผ่าน',
                'required|trim|callback_passlogin_check',
                array(  'required'  => 'กรุณาใส่ %s')
            );
     

            if ($this->form_validation->run() == FALSE){
                   

            }else{
                
                $query = $this->db->query("SELECT * FROM users WHERE username = '".$this->input->post('userlogin')."' AND passwd IN ( PASSWORD('".$this->input->post('passlogin')."'), PASSWORD(LOWER('".$this->input->post('passlogin')."')), PASSWORD(UPPER('".$this->input->post('passlogin')."')) ) AND enable = 'YES' ");
                $rslogin = $query->row_array();
                
                $login_session = array(
                    'user_id'   => $rslogin['id'],
                    'username'  => $rslogin['username'],
                    'group'  => $rslogin['group'],
                    'farm_site'   => $rslogin['farm_site'],
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($login_session);

                set_cookie('sm_cookie',json_encode($login_session),time() + (86400 * 36500)); //set session 365 day

                $lastlogin['lastlogin']=date('Y-m-d H:i:s');
                
                $this->db->set($lastlogin);
                $this->db->where('id', $rslogin['id']);
                $this->db->update('users');


                redirect("","refresh");
                exit();
                
            }

            
        }

        $this->load->view('login/login_view');

    }//end f.index


    public function userlogin_check($str){
        
        $rsuserlogin = $this->db->get_where('users', array('username' => $str,'enable' => 'YES'));
    
        if ( ($str != "") && ($rsuserlogin->num_rows() == 0) ){
            $this->form_validation->set_message('userlogin_check', '%s ไม่ถูกต้อง');
            return FALSE;
        }else{
            return TRUE;
        }
    
    }//end f.userlogin_check


    public function passlogin_check($str){
        
        $rspasslogin = $this->db->query("SELECT * FROM users WHERE username = '".$this->input->post('userlogin')."' AND passwd IN ( PASSWORD('".$str."'), PASSWORD(LOWER('".$str."')), PASSWORD(UPPER('".$str."')) ) AND enable = 'YES' ");
        //print_r($this->db->last_query());

        if (  ($str != "") && ($rspasslogin->num_rows() == 0) ){
            $this->form_validation->set_message('passlogin_check', '%s ไม่ถูกต้อง');
            return FALSE;
        }else{
            return TRUE;
        }
    
    }//end f.passlogin_check





}