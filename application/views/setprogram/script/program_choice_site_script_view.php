<script>

    function select_site(site_code){
        console.log(site_code);
        
        var dataform = {'_token': '{{ csrf_token() }}', 'site': site_code};
        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>setprogram/program_set_site",
            cache:false,
            dataType:"JSON",
            data:dataform,
            async:true,
            success:function(resultData){
                window.location.href = '<?php echo base_url(); ?>setprogram/program_choice_zone';
            }//end success
        });//end $.ajax

    }//end f.select_site


</script>