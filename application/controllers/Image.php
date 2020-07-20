<?php
class Image extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->sitecode='';
        $this->dirs=[];

        $this->start='';
        $this->end='';
        $this->min='';
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
        $menu['active'] = 'image';
        $this->load->view('layout/header_view',$menu);
        $this->load->view('image/image_view',$data);
        $this->load->view('layout/script_view');
        $this->load->view('image/script/image_script_view');
        $this->load->view('layout/footer_view');

    }// fn.index


    
    function scanDirectories($rootDir, $allData=array()) {
        // set filenames invisible if you want
        $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
        // run through content of root directory
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            // filter all files not accessible
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                // if content is file & readable, add to array
                if(is_file($path) && is_readable($path)) {
                    // save file name with path
                    if ( strstr( $path, '.jpg' ) ) {
                        //get dir min
                        $_file = explode("/",$path);
                        if($_file[1] == $this->sitecode ){
                            $this->dirs[ $_file[5] ]=$_file[5];
                        $allData[] = $path;
                        }
                    }
                // if content is a directory and readable, add path and name
                }elseif(is_dir($path) && is_readable($path)) {
                    // recursive callback to open new directory
                    $allData = $this->scanDirectories($path, $allData);
                }
            }
        }
        return $allData;
    }// fn.scanDirectories


    


    public function submit_search_image(){


        if($this->input->post()){

            $search_image = $this->input->post("search_image");

            $this->sitecode = $search_image['site_select'];
            $allfiles = $this->scanDirectories("snapshot");
            $f_d = $this->dirs;
            sort($f_d);
            

            $this->start = strtotime($search_image['from_date']);
            $this->end = strtotime($search_image['to_date']);
            
            if(count($f_d)==0){
                $this->min = 0;
            }else{
                $this->min = $f_d[0];
            }
            

            $image_get = array_filter($allfiles, function ($var){

                $_file = explode("/",$var);
            
                $dt=strtotime($_file[2]);
            
                if( ( $dt >= $this->start ) && ( $dt <= $this->end ) && ($_file[5] == $this->min )) {
                    return true;
                }
            });


            //-query site
            $query = ("SELECT * FROM sites WHERE site_code = '".$search_image['site_select']."' AND delete_date ='0000-00-00 00:00:00' ");
            $Result = $this->db->query($query);
            $get_site = $Result->row_array();


            $from_Date = date("Y/m/d", strtotime($search_image['from_date']));
            $to_Date = date("Y/m/d", strtotime($search_image['to_date']));

            
            $data['date_select'] = $from_Date.' - '.$to_Date;
            $data['search_image'] = $search_image;
            $data['site_list'] = $get_site;
            $data['select_time'] = $f_d;
            $data['image_get'] = $image_get;
            
            $menu['active'] = 'image';
            $this->load->view('layout/header_view',$menu);
            $this->load->view('image/show_image_view',$data);
            $this->load->view('layout/script_view');
            $this->load->view('image/script/show_image_script_view');
            $this->load->view('layout/footer_view');
            
        }else{
            redirect("image","refresh");
            exit();
        }//if-post


        
    }// fn.submit_search_image




    public function get_image(){

        if($this->input->post()){
            $this->sitecode = $this->input->post("sitecode");
            $allfiles = $this->scanDirectories("snapshot");
            $f_d = $this->dirs;
            sort($f_d);

            $this->start = strtotime($this->input->post("from_date"));
            $this->end = strtotime($this->input->post("to_date"));
            
            $this->min = $this->input->post("select_time");

            $image_get = array_filter($allfiles, function ($var){

                $_file = explode("/",$var);
            
                $dt=strtotime($_file[2]);
            
                if( ( $dt >= $this->start ) && ( $dt <= $this->end ) && ($_file[5] == $this->min )) {
                    return true;
                }
            });


            $resultData['image_get'] = $image_get;

            echo json_encode($resultData);
            return;

        }else{
            redirect("image","refresh");
            exit();
        }//if-post
    
    
    }// fn.get_image



    public function get_ima_gif(){
        if($this->input->post()){
            $sitecode = $this->input->post("sitecode");
            $start = $this->input->post("from_date");
            $end = $this->input->post("to_date");
            $min = $this->input->post("select_time");

            $command = 'sh /home/smartfarmesrs/public_html/snapshot/timelapse.sh '.$sitecode.' '.$start.' '.$end.' '.$min.' 10';
            exec($command , $output);

            $resultData['image_gif'] = base_url().'snapshot/timelapse/'.$output[0];
            //$resultData['image_gif'] = base_url()."snapshot/SF001/timelapse/SF000_2019-07-19_2019-07-21.gif";
            echo json_encode($resultData);
            return;

        }else{
            redirect("image","refresh");
            exit();
        }//if-post


    }// fn.get_ima_gif

    

}//class