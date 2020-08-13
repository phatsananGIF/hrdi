
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
            <li><a href="<?php echo base_url(); ?>controlsensor">ไซต์</a></li>
            <li><a href="<?php echo base_url(); ?>controlsensor/choice_zone">โซน</a></li>
            <li class="active">ควบคุม</li>
        </ol>

        <ol class="breadcrumb breadcrumb-bg-white-grey" style="margin-bottom: 20px; <?php echo $display;?>" >
            <li><a href="<?php echo base_url(); ?>controlsensor/choice_zone">โซน</a></li>
            <li class="active">ควบคุม</li>
        </ol>

        <!-- #switch-button -->
        <div class="row clearfix" >
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-center" >
                <div class="card">
                    <div class="body">
                        <div class="demo-switch-title">
                            <i id="pumpst_icon" class="material-icons <?php if($data_zone['pumpst'] == 'ON') echo 'heartbeat'; ?>" 
                            style="font-size: 70px; color:#<?php echo $color_sensor[$data_zone['pumpst']]; ?>;">opacity</i>
                            <p style="font-weight:600; font-size:24px;">ปั้มน้ำ</p>
                        </div>
                        <div class="switch">
                            <label>OFF<input type="checkbox" id="pumpst_switch" onclick="set_sw('pumpst')" 
                            <?php if($data_zone['pumpst'] == 'ON') echo 'checked'; ?>>
                            <span class="lever switch-col-light-green"></span>ON</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-center" >
                <div class="card">
                    <div class="body">
                        <div class="demo-switch-title">
                            <i id="fanst_icon" class="material-icons <?php if($data_zone['fanst'] == 'ON') echo 'rotate-center'; ?>" 
                            style="font-size: 70px; color:#<?php echo $color_sensor[$data_zone['fanst']]; ?>;">toys</i>
                            <p style="font-weight:600; font-size:24px;">พัดลม</p>
                        </div>
                        <div class="switch">
                            <label>OFF<input type="checkbox" id="fanst_switch" onclick="set_sw('fanst')" 
                            <?php if($data_zone['fanst'] == 'ON') echo 'checked'; ?>>
                            <span class="lever switch-col-light-green"></span>ON</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-center" >
                <div class="card">
                    <div class="body">
                        <div class="demo-switch-title">
                            <i id="fogst_icon" class="material-icons <?php if($data_zone['fogst'] == 'ON') echo 'flicker-1'; ?>" 
                            style="font-size: 70px; color:#<?php echo $color_sensor[$data_zone['fogst']]; ?>;">wb_iridescent</i>
                            <p style="font-weight:600; font-size:24px;">พ่นหมอก</p>
                        </div>
                        <div class="switch">
                            <label>OFF<input type="checkbox" id="fogst_switch" onclick="set_sw('fogst')" 
                            <?php if($data_zone['fogst'] == 'ON') echo 'checked'; ?>>
                            <span class="lever switch-col-light-green"></span>ON</label>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- #END switch-button -->

        
    </div>
</section>
