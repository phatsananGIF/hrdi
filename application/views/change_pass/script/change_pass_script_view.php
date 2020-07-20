<script>

    function space_bar(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode == 32){
            alert("ไม่สามารถใส่ช่องว่างได้");
            return false;
        }
        return true;
    }

</script>