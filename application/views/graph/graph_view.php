<section class="content">
    <div class="container-fluid">

    
        <?php
            $site_code = $this->session->userdata('farm_site');
            $display ='';
            if($this->session->userdata('group')!='Admin' && $this->session->userdata('group')!='Supper_admin'){
                $display = 'display:none';
            }
        ?>

        <div class="row clearfix" style="margin-bottom:10px; <?php echo $display;?>" >
            <select class="form-control show-tick" name="select_site" >
                <?php foreach($farm_site as $key=>$name_site){ 
                    $selected ='';
                    if($site_code == $key)$selected='selected';
                ?>
                    <option value="<?php echo $key;?>" <?php echo $selected;?> >
                        <?php echo $name_site;?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="row clearfix" style="margin-bottom:10px;" >
            <select class="form-control show-tick" name="select_zone" >
                <option value="1" >โรงเรือน 1</option>
                <option value="2">โรงเรือน 2</option>
                <option value="3">โรงเรือน 3</option>
                <option value="4">โรงเรือน 4</option>
            </select>
        </div>

        <div class="row clearfix" style="margin-bottom:10px;" align="center">
            <input type="text" class="form-control" style="font-size:17px;" name="daterange" value="" />
        </div>

        <div class="row clearfix" style="margin-bottom:10px; background-color:#fff;" >
            <div id="body_diagram" class="body bg-black-grey" style="min-height:400px;">
                <div id="not_data_chart" style="margin-top:5px;" align="center"></div>
                <div id="area_chart" class="graph"></div>
                <div id="legend" class="donut-legend" align="center"></div>

                <table id="data_max_min" style="margin-top:5px;" class="table table-hover dashboard-task-infos">
                </table>
            </div>        
        </div>


    </div>
</section>