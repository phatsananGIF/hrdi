<script>
    
    get_data();
    setInterval(function(){ get_data(); }, 60000);


    function get_data(){
        

        dataI = {"get_data":"get_data"};
        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>monitor/get_site",
            cache:false,
            dataType:"JSON",
            data:dataI,
            async:true,
            beforeSend: function() {
                $("#tbody_list_site").empty();
                showPleaseWait();
            },
            success:function(resultData){
                
                get_site = resultData.get_site;
                var tbody_site = '';
                $.each( get_site, function( key, val ){
                    tbody_site +='<tr>';
                    tbody_site +='<td>'+val.site_code+'</td>';
                    tbody_site +='<td>'+val.site_name+'</td>';
                    tbody_site +='<td><i class="material-icons" style="color:'+val.online_in_5min+';" id="icon_status">radio_button_checked</i></td>';
                    tbody_site +='<td>'+val.valuedate+'</td>';

                });//each

                $("#tbody_list_site").html(tbody_site);

                hidePleaseWait();
                
                
            }//end success
        });//end $.ajax

    }//end f.getdata

    /**
    * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
    */
    function showPleaseWait() {

        var modalLoading = '<div class="me-page-loader-wrapper">\
                                <div class="loader">\
                                    <div class="preloader">\
                                        <div class="spinner-layer pl-grey">\
                                            <div class="circle-clipper left">\
                                                <div class="circle"></div>\
                                            </div>\
                                            <div class="circle-clipper right">\
                                                <div class="circle"></div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <p>Please wait...</p>\
                                </div>\
                            </div>';

        $(document.body).append(modalLoading);
        $('.me-page-loader-wrapper').fadeIn();
    }


    /**
    * Hides "Please wait" overlay. See function showPleaseWait().
    */
    function hidePleaseWait() {
        $('.me-page-loader-wrapper').fadeOut();
    }



</script>