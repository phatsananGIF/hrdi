<script>

    var class_sensor = <?php echo json_encode($class_sensor); ?>;
    var color_sensor = <?php echo json_encode($color_sensor); ?>;

    function set_sw(type_sensor){
        console.log(type_sensor);

        var checkBox = document.getElementById(type_sensor+"_switch");
        var element_icon = document.getElementById(type_sensor+"_icon");
        var sw_actions = "";
        if (checkBox.checked == true){
            console.log("ON");
            sw_actions = "ON";
            element_icon.style.color = "#"+color_sensor["ON"];
            element_icon.classList.add(class_sensor[type_sensor]);
        } else {
            console.log("OFF");
            sw_actions = "OFF";
            var element = document.getElementById("myDIV");
            element_icon.style.color = "#"+color_sensor["OFF"];
            element_icon.classList.remove(class_sensor[type_sensor]);
        }
        update_sw(type_sensor,sw_actions);


    }//f.set_sw



    function update_sw(type_sensor,sw_actions){
        console.log(type_sensor+":"+sw_actions);

        var dataform = {'_token': '{{ csrf_token() }}', 'type_sensor': type_sensor, 'sw_actions': sw_actions};

        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>controlsensor/update_sw",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            success:function(resultData){

            }//end success
        });//end $.ajax 

    }//f.update_sw

</script>