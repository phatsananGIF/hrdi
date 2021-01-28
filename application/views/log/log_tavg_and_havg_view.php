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


        <div class="row clearfix" style="margin-bottom:10px;" align="center">
            <input type="text" class="form-control" style="font-size:17px;" name="daterange" value="" />
        </div>
   
    </div>    

    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table id="tb_log_tavg_and_havg" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>โรงเรือน</th>
                                <th>อุณหภูมิเฉลี่ย</th>
                                <th>ความชื้นเฉลี่ย</th>
                                <th>ช่วงเวลา</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>