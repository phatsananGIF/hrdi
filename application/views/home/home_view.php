<section class="content">
    <div class="container-fluid">

        <?php
            $display ='';
            if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
                $display = 'display:none';
            }
        ?>

        <div class="row clearfix" style="<?php echo $display;?>" >
            <select class="form-control show-tick" name="select_site" >
                <?php foreach($farm_site as $key=>$name_site){ ?>
                    <option value="<?php echo $key;?>" >
                        <?php echo $name_site;?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="align-center">
            <h2 id="h_titel" style="margin-top:10px;" ></h2>
        </div>

        <div class="row clearfix" id="house_box"></div>

    </div>
</section>
