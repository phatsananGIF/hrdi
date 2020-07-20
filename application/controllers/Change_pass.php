<?php
class Change_pass extends CI_Controller {

    function __construct() {      
        parent::__construct();
    }
    
    public function index(){

        if($this->input->post('submit') != null){
            
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules(
                'change_pass[old_pass]', 'รหัสผ่านเดิม',
                'required|trim|callback_Opass_check',
                array(  'required'  => 'กรุณาใส่ %s')

            );

            $this->form_validation->set_rules(
                'change_pass[new_pass]', 'รหัสผ่านใหม่',
                'required|trim|min_length[6]',
                array('required' => 'กรุณาใส่ %s',
                        'min_length'=> '%s ต้องมีอย่างน้อย 6 ตัว')
            );

            $this->form_validation->set_rules(
                'change_pass[connew]', 'ยืนยันรหัสผ่าน',
                'required|trim|matches[change_pass[new_pass]]',
                array(  'required' => 'กรุณาใส่ %s',
                        'matches' => '%s ไม่ตรง'
                )
            );


            if($this->form_validation->run() == FALSE){

            }else{
                $update = date('Y-m-d H:i:s');
                $this->db->query(" UPDATE users set passwd=PASSWORD(LOWER('".$this->input->post('change_pass[new_pass]]')."')),`update`='$update'  WHERE id ='".$this->session->userdata('user_id')."' and `deldate`='0000-00-00 00:00:00' ");
                
                $this->session->sess_destroy();

                redirect("login","refresh");
                exit();
                        
                
                
            }
        }


        $menu['active'] = 'change_pass';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('change_pass/change_pass_view');
        $this->load->view('layout/script_view');
        $this->load->view('change_pass/script/change_pass_script_view');
        $this->load->view('layout/footer_view');

    }//end f.index


    public function Opass_check($str){
        
        $rspass = $this->db->query("SELECT * FROM users WHERE id = '".$this->session->userdata('user_id')."' AND passwd IN ( PASSWORD('".$str."'), PASSWORD(LOWER('".$str."')), PASSWORD(UPPER('".$str."')) ) AND deldate = '0000-00-00 00:00:00' ");
        

        if (($str != "") && ($rspass->num_rows() == 0)){
            $this->form_validation->set_message('Opass_check', '%s ไม่ถูกต้อง');
            return FALSE;
        }else{
            return TRUE;
        }
    
    }//end f.Opass_check

}//class