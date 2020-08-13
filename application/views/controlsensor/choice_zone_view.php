<section class="content">
    <div class="container-fluid">
        <?php
            $display ='';
            if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
                $display = 'display:none';
            }
        ?>
    
        <ol class="breadcrumb breadcrumb-bg-white-grey" style="margin-bottom: 20px; <?php echo $display;?>" >
            <li><a href="<?php echo base_url(); ?>controlsensor">ไซต์</a></li>
            <li class="active">โซน</li>
        </ol>

        <div class="align-center">
            <?php foreach($result_db as $key=>$val){ ?>
                <button type="button" class="m-b-20 btn btn-block bg-black-blue waves-effect" onclick="select_zone('<?php echo $val['fid'];?>')">
                    <h2 style="margin-top:10px;" ><?php echo $name_house[$val['fid']];?></h2>
                </button>
            <?php } ?>
        </div>
        
    </div>
</section>
