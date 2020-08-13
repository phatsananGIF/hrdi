<!-- Gauge Chart Js -->
<script src="<?=base_url()?>asset/plugins/gauge-chart/js/dx.all.js"></script>


<script>
    

    var arr_farm_site = <?php echo json_encode($farm_site); ?>;
    var farm_site = "<?php echo $this->session->userdata('farm_site');?>";
    if(farm_site == '')farm_site = $("[name=select_site]").val();
    get_data(farm_site);

    $("[name=select_site]").change(function() {
        farm_site = $("[name=select_site]").val();
        
        get_data(farm_site);
        
        
    });

/*
    setInterval(function(){
        if(farm_site =='')farm_site = $("[name=select_site]").val();
        get_data(farm_site);
    }, 10000);//10s.
*/

    function get_data(site){

        /** create SVG  */
        deleteChild();

        var svg = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
        svg.setAttribute("class","gradient-mask");
        svg.setAttribute("id","svg");
        var defs = document.createElementNS("http://www.w3.org/2000/svg", 'defs');
        defs.setAttribute("id","defs");
        svg.appendChild(defs);
        document.body.appendChild(svg);
        /**END create SVG  */


        
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
                var farmavg = resultData.farmavg;
                var name_house = resultData.name_house;
                var color_sensor = resultData.color_sensor;

                
                var draw_house_box = '';
                var draw_gauge_defs = '';
                $.each( result_db, function( key, val ){

                    create_color_gauge(val['fid'],val);
                    
                    var pumpst_on='';
                    var fanst_on='';
                    var fogst_on='';
                    if(val['pumpst'] == 'ON')pumpst_on='heartbeat';
                    if(val['fanst'] == 'ON')fanst_on='rotate-center';
                    if(val['fogst'] == 'ON')fogst_on='flicker-1';

                    var start = Date.now();
                    var valuedate = moment(farmavg[val['fid']]['utime']).toDate().getTime();
                    var millis = Math.floor(start - valuedate)/1000;
                    var color_time = '';
                    
                    if(millis<=900){
                        color_time = "label-success";
                    }else if(millis>=900){
                        color_time = "label-danger";
                    }         

                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >';
                    draw_house_box +='<div class="card">';
                    draw_house_box +='<div class="header" style="padding: 7px 10px 5px;">';
                    draw_house_box +='<h2 style="font-weight:700; padding-left:5px;">'+name_house[val['fid']]+'</h2>';
                    draw_house_box +='<span class="label '+color_time+'" style="border-radius:10px;">'+farmavg[val['fid']]['utime']+' </span>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="body">';
                    draw_house_box +='<div class="row clearfix">';
                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<div id="T-house_'+val['fid']+'" class="gaugeT'+val['fid']+'"></div>';
                    draw_house_box +='</div>';
                    draw_house_box +='</div>';
                    draw_house_box +='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >';
                    draw_house_box +='<div class="align-center" >';
                    draw_house_box +='<div id="H-house_'+val['fid']+'" class="gaugeH'+val['fid']+'"></div>';
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

                    var tavg = parseFloat( farmavg[fid]['tavg'] );
                    var tavg_num = tavg.toFixed(1);

                    var havg = parseFloat( farmavg[fid]['havg'] );
                    var havg_num = havg.toFixed(1);

                    $('#T-house_'+fid).each(function (index, item) {
                        let params = {
                            initialValue: tavg_num,
                            lowestValue: 0,
                            higherValue: 100,
                            title: `อุณหภูมิ`,
                            subtitle: tavg_num+' ºC'
                        };

                        let gauge = new GaugeChart(item, params);
                        gauge.init();

                    });

                    $('#H-house_'+fid).each(function (index, item) {
                        let params = {
                            initialValue: havg_num,
                            lowestValue: 0,
                            higherValue: 100,
                            title: `ความชื้น`,
                            subtitle: havg_num+' %'
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
                /*
                startValue: this._lowestValue,
                endValue: this._higherValue,
                customTicks: [this._lowestValue, tick1, tick2, tick3, tick4, tick5, this._higherValue],
                */
                startValue: 0,
                endValue: 100,
                customTicks: [0, 15, 30, 50, 70, 85, 100],
                tick: {
                    length: 5 
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



function create_color_gauge(fid,val){

    var th = ['T','H'];
    for(i = 0; i < 2; i++){

        var max = 100;
        var min = 0;
        if(th[i]=='T'){
            max = val['tmx'];
            min = val['tmn'];
        }else{
            max = val['hmx'];
            min = val['hmn'];
        }
        
        var yel_min = (min-10);
        var red_min = 0;
        var yel_max = +max+5;
        var rad_max = 100;
        
        var defs = document.getElementById('defs');
                
        var linearGradient = document.createElementNS("http://www.w3.org/2000/svg", 'linearGradient');
            linearGradient.setAttribute("id","gradientGauge"+th[i]+fid);

        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-red");
            stop.setAttribute("offset",red_min+"%");
            linearGradient.appendChild(stop);

        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-yellow");
            stop.setAttribute("offset",yel_min+"%");
            linearGradient.appendChild(stop);
        
        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-green");
            stop.setAttribute("offset",min+"%");
            linearGradient.appendChild(stop);

        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-green");
            stop.setAttribute("offset",max+"%");
            linearGradient.appendChild(stop);

        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-yellow");
            stop.setAttribute("offset",yel_max+"%");
            linearGradient.appendChild(stop);

        var stop = document.createElementNS("http://www.w3.org/2000/svg", 'stop');
            stop.setAttribute("class","gauge"+th[i]+fid+"-color-red");
            stop.setAttribute("offset",rad_max+"%");
            linearGradient.appendChild(stop);
            
            defs.appendChild(linearGradient);
    }


}//end f.getdata







function deleteChild() { 
    console.log('delete');
    
    if( document.getElementById('svg') ){
        var sVg = document.getElementById('svg');
            document.body.removeChild(sVg);
    }
    
    re_css_gauge();
} //end f.deleteChild


function re_css_gauge() {
    console.log('refresh');
    
    let links = document.getElementsByTagName('link');
    
    for (let i = 0; i < links.length; i++) {
        
        if (links[i].getAttribute('title') == 'GaugeChart'){
            let href = links[i].getAttribute('href').split('?')[0];
            let newHref = href + '?version=' + new Date().getMilliseconds();
                links[i].setAttribute('href', newHref);
                //console.log(links[i]);
        }
    }
    
}//end f.re_css_gauge


</script>