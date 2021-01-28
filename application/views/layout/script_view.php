    <!-- Jquery Core Js -->
    <script src="<?=base_url()?>asset/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    
    <!-- Bootstrap Colorpicker Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="<?=base_url()?>asset/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->

    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/jszip.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/pdfmake.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/vfs_fonts.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/jquery-datatable/js- v.1.10.23/buttons.print.min.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/momentjs/moment_lang.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    
    <!-- noUISlider Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/nouislider/nouislider.js"></script>

    <!-- Wait Me Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/waitme/waitMe.js"></script>
    
    <!-- Morris Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/raphael/raphael.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/morrisjs/morris.js"></script>

    <!-- Light Gallery Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/light-gallery/js/lightgallery-all.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url()?>asset/js/admin.js"></script>
    <script src="<?=base_url()?>asset/js/pages/cards/colored.js"></script>
    
    <!-- Demo Js -->
    <script src="<?=base_url()?>asset/js/demo.js"></script>

    <!-- highchartsr -->
    <script src="<?=base_url()?>asset/plugins/Highcharts/code/highcharts.js"></script>
    <script src="<?=base_url()?>asset/plugins/Highcharts/code/modules/exporting.js"></script>

    <!-- cloudflare -->
    <script src="<?=base_url()?>asset/plugins/cloudflare/jquery.circliful.js"></script>

    <!-- Date Range Picker -->
    <script src="<?=base_url()?>asset/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?=base_url()?>asset/plugins/daterangepicker/daterangepicker.min.js"></script>

    


    <?php 
        if(isset($javascript)){
            foreach($javascript as $js)
            {
                echo "<script src=\"$js\"></script>\n";
            }
        }

    ?>