<script>
    var startDate = moment();
    var endDate = moment();

    $("[name=select_site]").change(function() {
        get_data();
    });

    $("[name=select_zone]").change(function() {
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


    var options = {
                    element: area_chart,
                    data: [],
                    xkey: 'numdate',
                    ykeys: [],
                    labels: [],
                    pointSize: 0,
                    lineWidth: 3, //Line
                    hideHover: 'auto',
                    lineColors: []
                    
                };
    var Line = new Morris.Line(options);
    


    function get_data(){

        var select_site = $("[name=select_site]").val();
        var select_zone = $("[name=select_zone]").val();

        var select_startDate = startDate.format('YYYY-MM-DD');
        var select_endDate = endDate.format('YYYY-MM-DD');
        
        dataI = {"select_site":select_site, "select_zone":select_zone, "select_startDate":select_startDate, "select_endDate":select_endDate };
        $.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>graph/get_data_chart",
			cache:false,
			dataType:"JSON",
			data:dataI,
			async:true,
            beforeSend: function() {
                showPleaseWait();
                $("#not_data_chart").empty();
                $("#area_chart").empty();
                $("#legend").empty();
                $("#data_max_min").empty();
            },
			success:function(result){
                
                var result_data = result.get_data;
                if(result_data.length != 0){

                    var lab = result.data_chart.labels;

                    options.element = 'area_chart';
                    options.data = result.data_chart.data_arr;
                    options.ykeys = [ result.data_chart.ykeys[0], result.data_chart.ykeys[1] ];
                    options.labels = [ result.data_chart.labels[0], result.data_chart.labels[1] ];
                    options.lineColors = [ result.data_chart.lineColors[0], result.data_chart.lineColors[1] ];

                    var Line = new Morris.Line(options);

                    //show labels in grap.
                    for (var i = 0; i < Line.options.labels.length; i++) {
                         var legendItem = $('<span style="padding:2px;">></span>').text(Line.options.labels[i]).prepend('<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>');
                             legendItem.find('i').css('backgroundColor', Line.options.lineColors[i] ,'margin-right', '2px');
                             legendItem.find('i').css('margin-right', '2px');
                        $('#legend').append(legendItem);
                    }

                    //show max-min in grap.
                    var data_max_min = '';
                    data_max_min +='<tr>';
                    data_max_min +='<td>อุณหภูมิ สูงสุด</td>';
                    data_max_min +='<td>'+result.max_min_tavg.max.tavgValue+' ºC</td>';
                    data_max_min +='<td>'+result.max_min_tavg.max.numdate+'</td>';
                    data_max_min +='</tr>';

                    data_max_min +='<tr>';
                    data_max_min +='<td>อุณหภูมิ ต่ำสุด</td>';
                    data_max_min +='<td>'+result.max_min_tavg.min.tavgValue+' ºC</td>';
                    data_max_min +='<td>'+result.max_min_tavg.min.numdate+'</td>';
                    data_max_min +='</tr>';

                    data_max_min +='<tr>';
                    data_max_min +='<td>ความชื้น สูงสุด</td>';
                    data_max_min +='<td>'+result.max_min_havg.max.havgValue+' %</td>';
                    data_max_min +='<td>'+result.max_min_havg.max.numdate+'</td>';
                    data_max_min +='</tr>';

                    data_max_min +='<tr>';
                    data_max_min +='<td>ความชื้น ต่ำสุด</td>';
                    data_max_min +='<td>'+result.max_min_havg.min.havgValue+' %</td>';
                    data_max_min +='<td>'+result.max_min_havg.min.numdate+'</td>';
                    data_max_min +='</tr>';

                    $("#data_max_min").html(data_max_min);


                }else{
                    $("#not_data_chart").html("Not Data");
                }

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