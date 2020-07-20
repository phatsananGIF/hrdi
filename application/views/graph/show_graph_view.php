<section class="content">
    <div class="container-fluid">
        
        <?php foreach($h_sensors as $item){ ?>
        <div class="row clearfix">
            <!-- Area Chart -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> <?php echo  $item['sensor_name'].' (หน่วย '.$item['snesor_unit'].')'; ?> </h2>
                    </div>
                    <div class="body">
                        <div id="area_chart_<?php echo  $item['sensor_code']?>" class="graph"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Area Chart -->
        </div>
        <?php } ?>

    </div>
</section>