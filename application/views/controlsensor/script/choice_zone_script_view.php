<script>

    function select_zone(fid){
        console.log(fid);

        var dataform = {'_token': '{{ csrf_token() }}', 'zone': fid};
        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>controlsensor/set_choice_zone",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            success:function(resultData){
                window.location.href = '<?php echo base_url(); ?>controlsensor/control';
            }//end success
        });//end $.ajax

    }//end f.select_site


</script>