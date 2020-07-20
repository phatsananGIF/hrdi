<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HRDI Smart Farmers</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url()?>asset/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url()?>asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url()?>asset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url()?>asset/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url()?>asset/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box ">
        <div class="logo">
            <div class="image align-center" >
                <img src="<?=base_url()?>asset/images/leaf2.png" width="50%">
            </div>
            <a href="javascript:void(0);"><b>HRDI</b> Smart <b>Farmers</b></a>
            
        </div>
        <div class="card">
            <div class="body">

                <form id="sign_in" method="POST" action="<?=base_url()?>login">
                    <div class="msg">ลงชื่อเข้าใช้งานระบบ</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="userlogin" value="<?php echo set_value('userlogin'); ?>" placeholder="ชื่อผู้ใช้" autofocus>
                        </div>
                        <?php echo form_error('userlogin'); ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="passlogin" value="<?php echo set_value('passlogin'); ?>" placeholder="รหัสผ่าน" >
                        </div>
                        <?php echo form_error('passlogin'); ?> 
                    </div>
                    <div class="row">
                        <div class="col-xs-12 align-center">
                            <button style="width:100%;" class="btn bg-black waves-effect" type="submit" name="submit" value="เข้าสู่ระบบ">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?=base_url()?>asset/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url()?>asset/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=base_url()?>asset/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url()?>asset/js/admin.js"></script>
    <script src="<?=base_url()?>asset/js/pages/examples/sign-in.js"></script>
</body>

</html>
