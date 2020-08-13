<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HRDI Smart Farmers</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url()?>asset/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="<?=base_url()?>asset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url()?>asset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url()?>asset/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="<?=base_url()?>asset/plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="<?=base_url()?>asset/plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="<?=base_url()?>asset/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="<?=base_url()?>asset/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?=base_url()?>asset/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- WaitMe Css -->
    <link href="<?=base_url()?>asset/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Morris Css -->
    <link href="<?=base_url()?>asset/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="<?=base_url()?>asset/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?=base_url()?>asset/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url()?>asset/css/themes/theme-light-blue.css" rel="stylesheet" />
    
    <!-- icon -->
    <link rel="stylesheet" href="<?=base_url()?>asset/css/font-awesome.css">

    <!-- Gauge Chart -->
    <link rel="stylesheet" title="GaugeChart" href="<?=base_url()?>asset/plugins/gauge-chart/gauge_style.css?version=#">

    <!-- circliful -->
    <link rel="stylesheet" href="<?=base_url()?>asset/plugins/cloudflare/jquery.circliful.css">

    <!-- Date Range Picker -->
    <link rel="stylesheet" href="<?=base_url()?>asset/plugins/daterangepicker/daterangepicker.css" />

    

    
    
</head>


<body class="ls-closed theme-light-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?=base_url()?>">HRDI Smart Farmers</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    
                    <li <?php if($active == 'home'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>">
                            <i class="material-icons">widgets</i>
                            <span>มอนิเตอร์</span>
                        </a>
                    </li>

                <?php if($this->session->group != 'Admin'){ ?>
                    <li <?php if($active == 'controlsensor'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>controlsensor">
                            <i class="material-icons">touch_app</i>
                            <span>ควบคุม</span>
                        </a>
                    </li>

                    <li <?php if($active == 'setprogram'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>setprogram">
                            <i class="material-icons">assignment</i>
                            <span>ตั้งโปรแกรม</span>
                        </a>
                    </li>
                <?php } ?>  
                  
                    <li <?php if($active == 'graph'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>graph">
                            <i class="material-icons">show_chart</i>
                            <span>กราฟข้อมูล</span>
                        </a>
                    </li>

                <?php if($this->session->group == 'Supper_admin'){ ?>
                    <li <?php if($active == 'log_control' || $active == 'log_program'){ echo 'class="active"';} ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">format_list_bulleted</i>
                            <span>Log</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($active == 'log_control'){ echo 'class="active"';} ?> >
                                <a href="<?=base_url()?>log/log_control">
                                    <span>Log ควบคุม</span>
                                </a>
                            </li>
                            <li <?php if($active == 'log_program'){ echo 'class="active"';} ?> >
                                <a href="<?=base_url()?>log/log_program">
                                    <span>Log ตั้งโปรแกรม</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>  
                    
                    <li <?php if($active == 'change_pass'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>change_pass">
                            <i class="material-icons">vpn_key</i>
                            <span>เปลี่ยนรหัสผ่าน</span>
                        </a>
                    </li>
                    <li <?php if($active == 'logout'){ echo 'class="active"';} ?> >
                        <a href="<?=base_url()?>logout">
                            <i class="material-icons">input</i>
                            <span>ออกจากระบบ</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->

            <!-- Footer Menu -->
            <div class="legal">
                <div class="copyright">
                    &copy;2020 <a href="javascript:void(0);">HRDI Smart Farmers</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer Menu -->

        </aside>
        <!-- #END# Left Sidebar -->
    </section>

   

