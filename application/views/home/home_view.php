<section class="content">
    <div class="container-fluid">

        <?php
            $display ='';
            if($this->session->userdata('farm_site')!=''){
                $display = 'display:none';
            }
        ?>

        <div class="row clearfix" style="<?php echo $display;?>" >
            <select class="form-control show-tick" name="select_site" >
                <option value="hrdi001">แม่ระเมิง</option>
                <option value="hrdi002">วะโดรโกร</option>
                <option value="hrdi003">แม่สามแลบ</option>
            </select>
        </div>

        <div class="align-center">
            <h2 id="h_titel"></h2>
        </div>
        
        <div class="row clearfix" id="house_box"></div>

        
    </div>
</section>
