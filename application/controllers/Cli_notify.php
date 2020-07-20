<?php 
//version 1.0.0

class Cli_notify extends CI_Controller {

    function __construct() {  
        parent::__construct();

    }

    public function index()
    {
        echo "notify test";
    }

    public function save_notify($sitecode,$msg)
    {
        //get notify id 
        $sql="SELECT notify.id as notifyId 
        FROM notify join sites on notify.site_id = sites.id  where site_code = '$sitecode' ";
        $result=$this->db->query($sql);

        //echo $this->db->last_query();

        foreach($result->result() as $rows )
        {
            $id=$rows->notifyId;

            $insert=array(
                'notify_id'=>$id,
                'message'=>$msg,
                'adddate'=>date('Y-m-d H:i:s')
            );
    
            $this->db->insert('notify_log',$insert);
        }

    }

    function get_zones($id)
    {
        //ดึงข้อมูล zones ตาม site_id 
         //zones
         $zones = array();
         $Result = $this->db->get_where("zones",
             array(
                 'id' => $id,
                 'datedelete'=> '0000-00-00 00:00:00' 
             )
         );
 
         foreach($Result->result() as $rows)
         {
             $zones[$rows->id]=$rows->zone_name;
         }
         return $zones;
    }

    public function sync_porgram($sitecode,$prgid,$status)
    {

    }

    public function update_program($sitecode,$id,$code,$ssid=0,$yy="0000",$mm="00",$dd="00",$hh="00",$nn="00")
    {
        /*
            $ssid=
            $sitecode = site code
            $id = program id
            $code = 1=queue , 2 = action , 3 = com , 4=overtime
            $yy = year
            $mm = month
            $dd = day 
            $hh = hour 
            $nn = minute

            เพิ่มเติม ส่งค่า confirm กลับมาที่ server
            ผ่านตัวแปร ssid โดยใส่  ssid-1 

        */

        $dayofweeks[1]="จันทร์";
        $dayofweeks[2]="อังคาร";
        $dayofweeks[3]="พุธ";
        $dayofweeks[4]="พฤหัสบดี";
        $dayofweeks[5]="ศุกร์";
        $dayofweeks[6]="เสาร์";
        $dayofweeks[7]="อาทิตย์";
        
        $status[1]="queue";
        $status[2]="active";
        $status[3]="completed";
        $status[4]="overtime";
        $status[5]="cancel";

        $status_thai[1]="รอคิว";
        $status_thai[2]="กำลังทำงาน";
        $status_thai[3]="ดำเนินการเสร็จสิ้น";
        $status_thai[4]="เลยเวลา";
        $status_thai[5]="ยกเลิก";

        $msgStatus="";
       
    
        $result=$this->db->get_where("programs", array("id"=>$id) );
        $row=$result->row();
        if(!isset($row))
        {
            echo "ผิดพลาด!! มีการส่งข้อมูลโปรแกรม $id ที่ไม่มีอยู่ในฐานข้อมูล จากอุปกรณ์ $sitecode ";
            exit ;
        }

        //ปรับปรุ่งให้ ทำงานต่อ
        if( ($row->program_loop=="Y") && ( $code == 1 ) )
        {
            if($row->start_date == "0000-00-00")
            {
                $row->start_date = date('Y-m-d');
            }
            

            $dStart = new DateTime($row->start_date);
            $dEnd  = new DateTime(date('Y-m-d'));
            $dDiff = $dStart->diff($dEnd);
            $d=$dDiff->format('%r%a')+1; // u

            if($d >=1 ) $row->start_date = date('Y-m-d',strtotime($row->start_date . "+$d day" ));

            if ( $row->days == "")
            {
                //ระบบเก่า
                $msgStatus="ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;
            }else{

                $dayofweek = date('N');
                $dayofweek_msg=$dayofweeks[$dayofweek];
                //$msgStatus="ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่มวัน " .$dayofweek_msg . " เวลา " .$row->start_time;
                $msgStatus="ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name ;
            }
            
            //date('Y',strtotime($row->start_date));
            $msgStatus="ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่มวัน " .$dayofweek_msg . " เวลา " .$row->start_time;
        }


        if( ($row->program_loop=="Y") && ( $code == 4 ) )
        {
            /*if($row->start_date == "0000-00-00")
            {
                $row->start_date = date('Y-m-d');
            }*/

            $dStart = new DateTime($row->start_date);
            $dEnd  = new DateTime(date('Y-m-d'));
            $dDiff = $dStart->diff($dEnd);
            $d=$dDiff->format('%r%a')+1; // u
            if($d >=1 ) $row->start_date = date('Y-m-d',strtotime($row->start_date . "+$d day" ));
            
            if ( $row->days == "")
            {

                $msgStatus="โปรแกรมเลยเวลา !! ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;

            }else{
                 $msgStatus="โปรแกรมเลยเวลา !! ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name ;
            }
            //date('Y',strtotime($row->start_date));
            //$msgStatus="โปรแกรมเลยเวลา !! ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;
           // $msgStatus="โปรแกรมเลยเวลา !! ดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;

            $code=1;
        }

        if( ($row->program_loop=="N") && ( $code == 4 ) )
        {
            $msgStatus= $row->program_name . " โปรแกรมเลยเวลา !! ";
            $code=4;
        }

        if( (int)$code == 5 )
        {
            $msgStatus="โปรแกรมยกเลิก !! ";
            $code=5;
        }

        //insert programs_log 
        if ( $row->days == "")
        {
            $date_old="$yy-$mm-$dd";
            $time_old="$hh:$nn";
        }else{
            $date_old=date('Y-m-d');
            $time_old=date('H:i');
        }
        $insert = array(
            "ssid"=>$ssid,
            "programs_id"=>$id,
            "start_date"=>"$date_old",
            "start_time"=>"$time_old",
            "status"=>$status[$code],
            "dateadd"=>date('Y-m-d H:i:s')
        );
        $this->db->insert("programs_logs",$insert);

        //get_zone 
        $zones = $this->get_zones($row->zones_id);
        $zone_name= $zones[$row->zones_id];

        if($code == 2) $msgStatus="โปรแกรม ".$row->program_name . " โซน " .$zone_name . " เปิดใช้งานอยู่ จะปิดในอีก " . $row->duration ." วินาที ";
        if($code == 3) $msgStatus="โปรแกรม ".$row->program_name . " โซน " .$zone_name . " ปิดใช้งานแล้ว ";
        if( ($row->program_loop=="Y") && ( $code == 3 ) )
        {
            if($row->start_date == "0000-00-00")
            {
                $row->start_date = date('Y-m-d');
            }
           

            $dStart = new DateTime($row->start_date);
            $dEnd  = new DateTime(date('Y-m-d'));
            $dDiff = $dStart->diff($dEnd);
            $d=$dDiff->format('%r%a')+1; // u
            if($d >=1 ) $row->start_date = date('Y-m-d',strtotime($row->start_date . "+$d day" ));
            
            //date('Y',strtotime($row->start_date));
            $msgStatus="โปรแกรม ".$row->program_name . " โซน " .$zone_name . " ปิดใช้งานแล้ว ";

            if ( $row->days == "")
            {   
                $msgStatus.="และดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;
            }else{
                $msgStatus.="และดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name ;
            }

            //$msgStatus.="และดำเนินการปรับปรุ่งโปรแกรม " . $row->program_name . " เริ่ม " .$row->start_date . " เวลา " .$row->start_time;
            $code=1;
        }

         //update status program 
         if ( $row->days == "")
         {   
            $update=array(
                "status"=>$status[$code],
                "start_date"=>$row->start_date,
                "start_time"=>$row->start_time,
                "update"=>date('Y-m-d H:i:s')
            );
         }else{
            $update=array(
                "status"=>$status[$code],
                "days"=>$row->days,
                "start_time"=>$row->start_time,
                "update"=>date('Y-m-d H:i:s')
            );
         }

        $this->db->where('id', $id);
        $this->db->update("programs", $update);


        echo "$sitecode $msgStatus";
        //update programs to mqtt 
        $this->save_notify($sitecode,$msgStatus);

        if((int)$code == 1){
            //get sitecode
            $pro_name=$row->program_name;
            $zone_relay=$this->get_zone_relay($row->zones_id);
            $start_date=$row->start_date;
            $start_time=$row->start_time;
            $duration=$row->duration;
            $trigger_name=$row->trigger_name;
            $sensor_cond=$row->sensor_cond;
            $sensor_value=$row->sensor_value;
            $program_loop=$row->program_loop;
            $active=$row->active;
            $status="queue";
            $dayofweek=str_replace(",","-",$row->days);

            $topic="smartfarm/programs/manage/$sitecode";
            $payload="add,$id,$pro_name,$zone_relay,$start_date,$start_time,$duration,";
            $payload.="$trigger_name,$sensor_cond,$sensor_value,$program_loop,$active,$status,$dayofweek";

            $this->publish($topic, $payload);
        }
    }




    public function relay_notify($sitecode,$relay,$status,$proId=0)
    {
        /*
            $sitecode = site code
            $relay = 1-8
            $status = 0 = off , 1 = on  
        */
        //$id = program_id 
        //code 1=queue , 2=action , 3=com 
        $code[0]="ปิด";
        $code[1]="เปิด";
        $notify="$sitecode";
        if(isset($code[$status]))
        {
            $notify.=" ทำการ".$code[$status]." รีเลย์ $relay " ;
        }else{
            $notify.=" มีการส่งค่ารีเลย์ผิดพลาด ";
        }

        //หาค่า relay id 
        $sql="SELECT r.id 
        FROM programs p join zones z on p.zones_id = z.id join relay r on z.id = r.zone_id  
        WHERE p.id = '$proId' and r.relay = $relay and sitecode = '$sitecode' ";

        //$notify = "$sitecode , $id , $code , $yy-$mm-$dd $hh:$nn" . PHP_EOL;
        //get relay id 
       // $sql="SELECT id FROM relay WHERE sitecode = '$sitecode' and relay = $relay";
        $result=$this->db->query($sql);
        $row=$result->row();

        if( isset($row) )
        {
            $insert=array(
                'relay_id'=>$row->id ,
                'status'=>$status,
                'adddate'=>date('Y-m-d H:i:s')
            );
            $this->db->insert('relay_log',$insert);


        }
        
        $this->save_notify($sitecode,$notify);
        echo $notify ;
    }


    
    function get_zone_relay($zone_id=0)
    {
        $sql="SELECT group_concat(relay SEPARATOR '-') as relays
        FROM relay where zone_id = $zone_id and zone_select = '1' group by zone_id ";

        $query=$this->db->query($sql);
        $row = $query->row();
        $relays="";
        if(isset($row))
        {
            $relays=$row->relays;
        }
        return $relays ;

    }


     /*  function by sittichai  */
     function publish($topic,$payload="")
     {
         include APPPATH . 'third_party/phpMQTT.php';
         
         //smartfarm/programs/manage/SF001
         //add,12,ทดสอบทดสอบ 1,water,,15:30,300,/tmp/soil1_water,==,10,Y
 
 
         $server="128.199.216.127";
         $port=1883;
         
         $mqtt = new phpMQTT($server, $port, "smartfarm"); 
     
         if ( $mqtt->connect(true,NULL,"","") ) { 
             $mqtt->publish("$topic",$payload,0); 
             $mqtt->close(); 
             return true ;
         }else{ 
            return false ;
         }
 
     }


     public function program_reload($sitecode,$timestamp)
     {
         $sql="SELECT programs.* FROM sites join programs on sites.id = programs.site_id  
            WHERE site_code = '$sitecode' and active = 'Y' and status = 'queue' and programs.delete_date = '0000-00-00 00:00:00' ";
         
         $result=$this->db->query($sql);

        // echo $this->db->last_query();


         foreach($result->result() as $rows)
         {
             //print_r($rows);

            $adddate=strtotime($rows->dateadd);
            $update=strtotime($rows->update);
            $checkdate=$adddate;
            
            if($update >= $adddate) {
                $checkdate = $update;
            }

            if((int)$timestamp < $checkdate )
            {
                //ส่งข้อมูลโปรแกรม
                $id=$rows->id;
                $pro_name=$rows->program_name;
                $zone_relay=$this->get_zone_relay($rows->zones_id);
                $start_date=$rows->start_date;
                $start_time=$rows->start_time;
                $duration=$rows->duration;
                $trigger_name=$rows->trigger_name;
                $sensor_cond=$rows->sensor_cond;
                $sensor_value=$rows->sensor_value;
                $program_loop=$rows->program_loop;
                $active=$rows->active;
                $status="queue";

                $topic="smartfarm/programs/manage/$sitecode";
                $payload="add,$id,$pro_name,$zone_relay,$start_date,$start_time,$duration,";
                $payload.="$trigger_name,$sensor_cond,$sensor_value,$program_loop,$active,$status";

               // echo $payload;
                $this->publish($topic, $payload);                

            }

         }
        
     }

    
}


