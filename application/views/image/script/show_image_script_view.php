<script>
    
    $(function () {
        $('#aniimated-thumbnials').lightGallery({
            thumbnail: true,
            selector: 'a'
        });
    });

    
    $("[name=select_time]").change(function() {
        get_image();
    });


    function get_image(){
        
        $("#aniimated-thumbnials").html("");

        var sitecode = "<?php echo $search_image['site_select']; ?>";
        var from_date = "<?php echo $search_image['from_date']; ?>";
        var to_date = "<?php echo $search_image['to_date']; ?>";
        var select_time = $("[name=select_time]").val();

        var dataform = {'_token': '{{ csrf_token() }}',
                        'sitecode': sitecode,
                        'from_date': from_date,
                        'to_date': to_date,
                        'select_time': select_time,
                        };
        console.log(dataform);
        
        
        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>image/get_image",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            success:function(resultData){
                console.log(resultData);
                var image = resultData.image_get;


                var list_image = '';
                $.each( image, function( key, val ){
                    console.log(val);
                    list_image +='<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                    list_image +='<a href="<?=base_url()?>'+val+'">';
                    list_image +='<img class="img-responsive thumbnail" src="<?=base_url()?>'+val+'">';
                    list_image +='</a>';
                    list_image +='</div>';
                });//each
                $("#aniimated-thumbnials").html(list_image);

                $("#aniimated-thumbnials").data('lightGallery').destroy(true);
                $('#aniimated-thumbnials').lightGallery({
                    thumbnail: true,
                    selector: 'a'
                });


            }//end success
        });//end $.ajax

    }//f.get_image
    


    function timelapse(){
        var sitecode = "<?php echo $search_image['site_select']; ?>";
        var from_date = "<?php echo $search_image['from_date']; ?>";
        var to_date = "<?php echo $search_image['to_date']; ?>";
        var select_time = $("[name=select_time]").val();

        var dataform = {'_token': '{{ csrf_token() }}',
                        'sitecode': sitecode,
                        'from_date': from_date,
                        'to_date': to_date,
                        'select_time': select_time,
                        };


        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>image/get_ima_gif",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            beforeSend: function() {
                showPleaseWait();
            },
            success:function(resultData){
                hidePleaseWait();
                console.log(resultData);
                var image = resultData.image_gif;
                document.getElementById("my_image").src = image;

                $("#formModal_timelapse").modal("show");
                
            }//end success
        });//end $.ajax


    }//f.timelapse


    
    function lbs_click(){
        var u = document.getElementById("my_image").src;
        console.log(encodeURIComponent(u));
        window.open('https://lineit.line.me/share/ui?url='+encodeURIComponent(u) );return false;
    }//f.lbs_click




    function fbs_click(){
        var u = document.getElementById("my_image").src;
        console.log(encodeURIComponent(u));
        window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u) );return false;
    }//f.fbs_click






    /**
    * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
    */
    function showPleaseWait() {
        var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">\
            <div class="modal-dialog">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        <h4 class="modal-title">กรุณารอสักครู่...</h4>\
                    </div>\
                    <div class="modal-body">\
                        <div class="progress">\
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                        </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>';
        $(document.body).append(modalLoading);
        $("#pleaseWaitDialog").modal("show");
    }


    /**
    * Hides "Please wait" overlay. See function showPleaseWait().
    */
    function hidePleaseWait() {
        $("#pleaseWaitDialog").modal("hide");
    }


</script>