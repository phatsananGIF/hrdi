
<script>

    var options = {
                    element: area_chart_soil1_water,
                    data: [],
                    xkey: 'period',
                    ykeys: [],
                    labels: [],
                    pointSize: 0,
                    lineWidth: 3, //Line
                    hideHover: 'auto',
                    lineColors: []
                    
                };

    var h_sensors = <?php echo json_encode($h_sensors); ?>;
    var graph_data = <?php echo json_encode($graph_data); ?>;
    var lineColors = <?php echo json_encode($lineColors); ?>;



    h_sensors.forEach(function(item){
       
        if( typeof graph_data[item.sensor_code] !== "undefined")
        {
            console.log(graph_data[item.sensor_code]);
            options.element = 'area_chart_'+item.sensor_code;
            options.data = graph_data[item.sensor_code];
            options.ykeys = [item.sensor_code];
            options.labels = [item.sensor_name];
            options.lineColors = [lineColors[item.sensor_code]];
            
            //var Area = new Morris.Area(options);
            var Line = new Morris.Line(options);
        }
    });


</script>