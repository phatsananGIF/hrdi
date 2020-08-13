<section class="content">
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table id="tb_log_program" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Log Date</th>
                                    <th>Site Code</th>
                                    <th>Site Name</th>
                                    <th>FID</th>
                                    <th>EC</th>
                                    <th>Temp Max</th>
                                    <th>Temp Min</th>
                                    <th>Hud Max</th>
                                    <th>Hud Min</th>
                                    <th>Start Time1</th>
                                    <th>End Time1</th>
                                    <th>Start Time2</th>
                                    <th>End Time2</th>
                                    <th>Start Time3</th>
                                    <th>End Time3</th>
                                    <th>User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($program_log as $key=>$val){?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $val['log_date'];?></td>
                                        <td><?php echo $val['site_code'];?></td>
                                        <td><?php echo $val['site_name'];?></td>
                                        <td><?php echo $val['fid'];?></td>
                                        <td><?php echo $val['ec'];?></td>
                                        <td><?php echo $val['temp_max'];?></td>
                                        <td><?php echo $val['temp_min'];?></td>
                                        <td><?php echo $val['hud_max'];?></td>
                                        <td><?php echo $val['hud_min'];?></td>
                                        <td><?php echo $val['time1_st'];?></td>
                                        <td><?php echo $val['time1_et'];?></td>
                                        <td><?php echo $val['time2_st'];?></td>
                                        <td><?php echo $val['time2_et'];?></td>
                                        <td><?php echo $val['time3_st'];?></td>
                                        <td><?php echo $val['time3_et'];?></td>
                                        <td><?php echo $val['username'];?></td>
                                    </tr>
                                <?php }?>
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
