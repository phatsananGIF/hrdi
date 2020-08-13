

<section class="content">
    <div class="container-fluid">
        <?php
            $display ='';
            $display_Site ='';
            if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
                $display_Site = 'display:none';
            }else{
                $display = 'display:none';
            }
        ?>
    
        <ol class="breadcrumb breadcrumb-bg-white-grey" style="margin-bottom: 20px; <?php echo $display_Site;?>" >
            <li><a href="<?php echo base_url(); ?>setprogram">ไซต์</a></li>
            <li><a href="<?php echo base_url(); ?>setprogram/program_choice_zone">โซน</a></li>
            <li class="active">โปรแกรม</li>
        </ol>

        <ol class="breadcrumb breadcrumb-bg-white-grey" style="margin-bottom: 20px; <?php echo $display;?>" >
            <li><a href="<?php echo base_url(); ?>setprogram/program_choice_zone">โซน</a></li>
            <li class="active">โปรแกรม</li>
        </ol>

        <!-- form input -->
        <form id="form_add_program" method="POST" action="<?=base_url()?>setprogram/submit_program" >

        <!-- EC -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="margin-bottom:5px;">
                    <div class="body" style="padding:10px;">
                        <p style="margin:0;font-size:20px;">ค่าปุ๋ย (EC)
                            <span class="tooltip2">
                                <i class="material-icons" style="font-size:15px;" >help</i>
                                <span class="tooltiptext">ค่าปุ๋ย</span>
                            </span>
                        </p>
                        <div class="row clearfix">
                            <div class="col-sm-12" style="margin:0;">
                                <div class="form-group form-group-lg" style="margin:0;">
                                    <div class="form-line">
                                        <input type="number" name="program[ec]" class="form-control text-center" placeholder="0" value="<?php echo $result_farm['ecset'];?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# EC -->


        <!-- TEMP -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="margin-bottom:5px;">
                    <div class="body" style="padding:10px;">
                        <div class="demo-masked-input">

                            <p style="margin:0;font-size:20px;">อุณหภูมิ
                                <span class="tooltip2">
                                    <i class="material-icons" style="font-size:15px;" >help</i>
                                    <span class="tooltiptext">อุณหภูมิ หน่วยเป็น องศาเซลเซียส</span>
                                </span>
                            </p>
                            <div class="row clearfix" style="margin-bottom:7px;">
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>สูงสุด</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="number" name="program[temp_max]" class="form-control text-center" placeholder="0" value="<?php echo $result_farm['tmx'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>ต่ำสุด</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="number" name="program[temp_min]" class="form-control text-center" placeholder="0" value="<?php echo $result_farm['tmn'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# TEMP -->


        <!-- HUD -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="margin-bottom:5px;">
                    <div class="body" style="padding:10px;">
                        <div class="demo-masked-input">

                            <p style="margin:0;font-size:20px;">ความชื้น
                                <span class="tooltip2">
                                    <i class="material-icons" style="font-size:15px;" >help</i>
                                    <span class="tooltiptext">ความชื้น หน่วยเป็น เปอร์เซ็น</span>
                                </span>
                            </p>
                            <div class="row clearfix" style="margin-bottom:7px;">
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>สูงสุด</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="number" name="program[hud_max]" class="form-control text-center" placeholder="0" value="<?php echo $result_farm['hmx'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>ต่ำสุด</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="number" name="program[hud_min]" class="form-control text-center" placeholder="0" value="<?php echo $result_farm['hmn'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# HUD -->
        

        <!-- TIME 1 -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="margin-bottom:5px;">
                    <div class="body" style="padding:10px;">
                        <div class="demo-masked-input">

                        <?php 
                        $i = 1;
                        foreach($result_time as $key=>$val){
                        ?>

                            <p style="margin:0;font-size:20px;">ตั้งเวลา <?php echo $i;?>
                                <span class="tooltip2">
                                    <i class="material-icons" style="font-size:15px;" >help</i>
                                    <span class="tooltiptext">ระบุช่วงเวลาการทำงาน ของปั้มน้ำครั้งที่ <?php echo $i;?></span>
                                </span>
                            </p>
                            <div class="row clearfix" style="margin-bottom:7px;">
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>start</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="text" name="program[time][<?php echo $val['vpin'];?>][st]" class="form-control text-center time24" placeholder="00:00" value="<?php echo $val['st'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6" style="margin:0;">
                                    <span>stop</span>
                                    <div class="form-group form-group-lg" style="margin:0;">
                                        <div class="form-line">
                                            <input type="text" name="program[time][<?php echo $val['vpin'];?>][et]" class="form-control text-center time24" placeholder="00:00" value="<?php echo $val['et'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        <?php 
                            $i++;
                        } 
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# TIME 1 -->


        <button type="submit" class="btn btn-block bg-black-blue waves-effect" style="margin:10px 0;" >
            <h4>บันทึก</h4>
        </button>

        </form>
        <!-- #END# form input -->

        

        
    </div>
</section>
