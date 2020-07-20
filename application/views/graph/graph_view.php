<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>กราฟ</h2>
                    </div>
                    <div class="body">

                        <form id="form_search" method="POST" action="<?=base_url()?>graph/submit_search_graph" >

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <p><b>ไซต์งาน</b></p>
                                    <select class="form-control show-tick" name="search_graph[site_select]" >
                                        <?php
                                        foreach($site_list as $key=>$name_type){
                                            $select = '';
                                            if( $name_type['site_code'] == $this->session->site_code )$select = 'selected';
                                        ?>
                                            <option value="<?php echo $name_type['site_code'];?>" <?php echo $select; ?> >
                                                <?php echo $name_type['site_name'];?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-float demo-masked-input">
                                <b>จากวันที่</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control datepicker" name="search_graph[from_date]" placeholder="เลือกวันที่..." required>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group form-float demo-masked-input">
                                <b>ถึงวันที่</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control datepicker" name="search_graph[to_date]" placeholder="เลือกวันที่..." required>
                                    </div>
                                </div>
                            </div>
                            
                            <button style="width:100%;" class="btn btn-primary waves-effect" type="submit">ค้นหา</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
