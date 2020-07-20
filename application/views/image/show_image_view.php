<section class="content">
    <div class="container-fluid">

        <div class="row clearfix" style="margin-bottom:15px;" >
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
                <select class="form-control show-tick" name="select_time" >
                    <?php $select = 'selected';
                    foreach($select_time as $key=>$time){ ?>
                        <option value="<?php echo $time;?>" <?php echo $select;?> >
                            เวลา <?php echo $time;?>:00
                        </option>
                    <?php $select = '';
                        } ?>
                </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
                <button class="btn btn-block btn-lg btn-success waves-effect" onclick="timelapse()" >ภาพเคลื่อนไหว</button>
            </div>
        </div>

        <!-- Image Gallery -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            รูปภาพ : <b><?php echo $site_list['site_name'] ?></b>
                        </h2>
                        <small> <?php echo $date_select ?> </small>
                    </div>
                    <div class="body">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">

                            <?php  foreach($image_get as $image){ ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="<?=base_url().$image?>">
                                        <img class="img-responsive thumbnail" src="<?=base_url().$image?>">
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #End Image Gallery -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="formModal_timelapse" tabindex="-1" role="dialog" aria-labelledby="formModalLabel_timelapse" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body" >
                    <img id='my_image' src='' alt='' width="100%" height="auto" />
                </div>

                <div class="modal-footer" id="modelBt2" >
                    <button type="button" class="btn bg-green" onclick="lbs_click();">
                    <img id='my_image' src='<?=base_url()?>asset/images/round-default.png' alt='' width="auto" height="auto" />
                    แชร์</button>
                    <button type="button" class="btn btn-primary" onclick="fbs_click();"><i class="fa fa-facebook"></i> แชร์</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>

            </div>
        </div>
    </div><!-- Modal -->


</section>
