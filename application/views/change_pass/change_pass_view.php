<section class="content">
    <div class="container-fluid">
        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>เปลี่ยนรหัสผ่าน</h2>
                    </div>
                    <div class="body">
                    
                        <form id="form_change_pass" method="POST" action="<?=base_url()?>change_pass" >

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="change_pass[old_pass]" value="<?php echo set_value('change_pass[old_pass]'); ?>" onkeypress="return space_bar(event)" >
                                    <label class="form-label">รหัสผ่านเดิม</label>
                                </div>
                                <?php echo form_error('change_pass[old_pass]'); ?>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="change_pass[new_pass]" value="<?php echo set_value('change_pass[new_pass]'); ?>" onkeypress="return space_bar(event)" >
                                    <label class="form-label">รหัสผ่านใหม่</label>
                                </div>
                                <?php echo form_error('change_pass[new_pass]'); ?>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="change_pass[connew]" value="<?php echo set_value('change_pass[connew]'); ?>" onkeypress="return space_bar(event)" >
                                    <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                                </div>
                                <?php echo form_error('change_pass[connew]'); ?>
                            </div>
                            
                            <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">บันทึก</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
