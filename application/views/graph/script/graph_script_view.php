<script>
    $(function () {
        $('.datepicker').bootstrapMaterialDatePicker({
            lang: 'th',
            cancelText: 'ยกเลิก',
            clearText: 'เคลียร์',
            okText: 'ตกลง',
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });

    });
    
    $('#form_search').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }

    });

</script>