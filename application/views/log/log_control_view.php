<section class="content">
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table id="tb_log_control" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Log Date</th>
                                    <th>Site Code</th>
                                    <th>Site Name</th>
                                    <th>FID</th>
                                    <th>Type Sensor</th>
                                    <th>Status</th>
                                    <th>User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($control_log as $key=>$val){?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $val['log_date'];?></td>
                                        <td><?php echo $val['site_code'];?></td>
                                        <td><?php echo $val['site_name'];?></td>
                                        <td><?php echo $val['fid'];?></td>
                                        <td><?php echo $val['type_sensor'];?></td>
                                        <td><?php echo $val['status'];?></td>
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
