<script>
    var startDate = moment();
    var endDate = moment();

    $("[name=select_site]").change(function() {
        get_data();
    });


    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }
    },function (start, end) {
        startDate = start;
        endDate = end;
        get_data();
    });

    

    function get_data(){

        var select_site = $("[name=select_site]").val();

        var select_startDate = startDate.format('YYYY-MM-DD');
        var select_endDate = endDate.format('YYYY-MM-DD');

        $('#tb_log_tavg_and_havg').DataTable().clear().destroy();


        dataI = {"select_site":select_site, "select_startDate":select_startDate, "select_endDate":select_endDate };
        $.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>log/getData_tavg_and_havg",
			cache:false,
			dataType:"JSON",
			data:dataI,
			async:true,
            beforeSend: function() {
                showPleaseWait();
            },
			success:function(result){

                var daw_value = '';
                
                    
                $.each( result, function( key, value ){
                    daw_value += '<tr>';
                    daw_value +='<td>'+value['no']+'</td>';
                    daw_value +='<td>'+value['fid']+'</td>';
                    daw_value +='<td>'+value['my_tavg']+'</td>';
                    daw_value +='<td>'+value['my_havg']+'</td>';
                    daw_value +='<td>'+value['dt_utime']+'</td>';
                    daw_value +='</tr>';
                });
                    

                $("#tb_log_tavg_and_havg tbody").html(daw_value);

                var t = $('#tb_log_tavg_and_havg').DataTable({
                    "lengthChange": false,
                    dom: 'Bfrtip',
                    "buttons": ['excel'],
                    "columnDefs": [ {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    } ]
                });
            
                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    });
                }).draw();



                hidePleaseWait();
			}//end success
		});//end $.ajax 
        

    }//f.get_data


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


    get_data();

</script>