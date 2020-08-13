<section class="content">
    <div class="container-fluid">
        
        <div class="align-center">
            <?php foreach($farm_site as $key=>$name_site){ ?>
                <button type="button" class="m-b-20 btn btn-block bg-black-blue waves-effect" onclick="select_site('<?php echo $key;?>')">
                    <h2 style="margin-top:10px;" ><?php echo $name_site;?></h2>
                </button>
            <?php } ?>
        </div>
        
    </div>
</section>
