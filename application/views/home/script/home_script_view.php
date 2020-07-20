<!-- Gauge Chart Js -->
<script src="<?=base_url()?>asset/plugins/gauge-chart/js/dx.all.js"></script>

<svg version="1.1" class="gradient-mask">
    <defs>
        <linearGradient id="gradientGauge">
            <stop class="gauge-color-green" offset="0%"/>
            <stop class="gauge-color-lightgreen" offset="17%"/>
            <stop class="gauge-color-yellow" offset="40%"/>
            <stop class="gauge-color-orange" offset="87%"/>
            <stop class="gauge-color-red" offset="100%"/>
        </linearGradient>

        <linearGradient id="gradientGauge2">
            <stop class="gauge2-color-red" offset="0%"/>
            <stop class="gauge2-color-orange" offset="17%"/>
            <stop class="gauge2-color-yellow" offset="40%"/>
            <stop class="gauge2-color-lightgreen" offset="87%"/>
            <stop class="gauge2-color-green" offset="100%"/>
        </linearGradient>
    </defs>  
</svg>

<script>

    var arr_farm_site = <?php echo json_encode($farm_site); ?>;
    var farm_site = "<?php echo $this->session->userdata('farm_site');?>";
    if(farm_site =='')farm_site = $("[name=select_site]").val();
    get_data(farm_site);

    $("[name=select_site]").change(function() {
        farm_site = $("[name=select_site]").val();
        get_data(farm_site);
    });

/*
    setInterval(function(){
        if(farm_site =='')farm_site = $("[name=select_site]").val();
        get_data(farm_site);
    }, 10000);
*/

    function get_data(site){
        console.log(site);
        console.log(arr_farm_site);
        
        $("#h_titel").html(arr_farm_site[site]);

        var dataform = {'_token': '{{ csrf_token() }}', 'site': site};

        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>home/getdata",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            success:function(resultData){
                
                var result_db = resultData.result_db;
                var name_house = resultData.name_house;
                var color_sensor = resultData.color_sensor;
                
                var draw_house_box = '';
                $.each( result_db, function( key, val ){
                    var pumpst_on='';
                    var fanst_on='';
                    var fogst_on='';
                    if(val['pumpst'] == 'ON')pumpst_on='heartbeat';
                    if(val['fanst'] == 'ON')fanst_on='rotate-center';
                    if(val['fogst'] == 'ON')fogst_on='flicker-1';
                    

                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >';
                    draw_house_box +='<div class="card">';
                    draw_house_box +='<div class="header">';
                    draw_house_box +='<h2 style="font-weight: 700;">'+name_house[val['fid']]+'</h2>';
                    draw_house_box +='<small>'+val['utime']+'</small>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="body">';
                    draw_house_box +='<div class="row clearfix">';
                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<div id="T-house_'+val['fid']+'" class="gauge"></div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<div id="H-house_'+val['fid']+'" class="gauge2"></div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="row clearfix">';
                    draw_house_box +='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<i class="material-icons '+pumpst_on+'" style="font-size: 60px; color:#'+color_sensor[val['pumpst']]+';">opacity</i>';
                    draw_house_box +='<p style="font-weight: 600;">ปั้มน้ำ</p>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<i class="material-icons '+fanst_on+'" style="font-size: 60px; color:#'+color_sensor[val['fanst']]+';">toys</i>';
                    draw_house_box +='<p style="font-weight: 600;">พัดลม</p>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<i class="material-icons '+fogst_on+'" style="font-size: 60px; color:#'+color_sensor[val['fogst']]+';">wb_iridescent</i>';
                    draw_house_box +='<p style="font-weight: 600;">พ่นหมอก</p>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                });
                $("#house_box").html(draw_house_box);
                

                /**---gauge--- */
                result_db.forEach(function(entry) {
                    var fid = entry.fid;

                    $('#T-house_'+fid).each(function (index, item) {
                        let params = {
                            initialValue: entry.tavgp,
                            lowestValue: 0,
                            higherValue: entry.tmx,
                            title: `อุณหภูมิ`,
                            subtitle: entry.tavgp+' ºC'
                        };

                        let gauge = new GaugeChart(item, params);
                        gauge.init();

                    });

                    $('#H-house_'+fid).each(function (index, item) {
                        let params = {
                            initialValue: entry.havgp,
                            lowestValue: entry.hmn,
                            higherValue: entry.hmx,
                            title: `ความชื้น`,
                            subtitle: entry.havgp
                        };


                        let gauge = new GaugeChart(item, params);
                        gauge.init();

                    });

                });/**---END gauge--- */

            }//end success
        });//end $.ajax 

        
    }//end f.getdata


class GaugeChart {

    constructor(element, params) {
        this._element = element;
        this._initialValue = params.initialValue;
        this._lowestValue = params.lowestValue;
        this._higherValue = params.higherValue;
        this._title = params.title;
        this._subtitle = params.subtitle;
    }

    _buildConfig() {
        let element = this._element;
        
        var lengnum = this._higherValue - this._lowestValue;
        var tick = Math.ceil(lengnum/6);
        var tick1 = Math.ceil(tick*1)+parseInt(this._lowestValue);
        var tick2 = Math.ceil(tick*2)+parseInt(this._lowestValue);
        var tick3 = Math.ceil(tick*3)+parseInt(this._lowestValue);
        var tick4 = Math.ceil(tick*4)+parseInt(this._lowestValue);
        var tick5 = Math.ceil(tick*5)+parseInt(this._lowestValue);

        return {
            value: this._initialValue,
            valueIndicator: {
                color: '#26323a' //color line
            }, 

            geometry: {
                startAngle: 180,
                endAngle: 360 
            },

            scale: {
                startValue: this._lowestValue,
                endValue: this._higherValue,
                customTicks: [this._lowestValue, tick1, tick2, tick3, tick4, tick5, this._higherValue],
                tick: {
                    length: 8 
                },

                label: {
                    font: {
                        color: '#87959f',
                        size: 9,
                        family: '"Open Sans", sans-serif' 
                    } 
                } 
            },
            
            title: {
                verticalAlignment: 'bottom',
                text: this._title,
                font: {
                    family: '"Open Sans", sans-serif',
                    color: '#555',
                    weight: 700,
                    size: 14 
                },

                subtitle: {
                    text: this._subtitle,
                    font: {
                        family: '"Open Sans", sans-serif',
                        color: '#000',
                        weight: 700,
                        size: 25 
                    }
                }
            },

            
            onInitialized: function () {
                let currentGauge = $(element);
                let circle = currentGauge.find('.dxg-spindle-hole').clone();
                let border = currentGauge.find('.dxg-spindle-border').clone();

                currentGauge.find('.dxg-title text').first().attr('y', 48);
                currentGauge.find('.dxg-title text').last().attr('y', 28);
                //currentGauge.find('.dxg-value-indicator').append(border, circle);
            } 

        };


    }

    init() {
        $(this._element).dxCircularGauge(this._buildConfig());
    }   

}//end.class.GaugeChart

</script>