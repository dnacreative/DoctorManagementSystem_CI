<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <link href="<?php echo base_url('public/css/admin/login_page.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/font-awesome.min.css')?>" rel="stylesheet">
</head>
<body>
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form action="<?= base_url('admin_dev/login/')?>" role="form"  method="post">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="User Name" autofocus="">
                        </div>
                        <div class="form-group">
                            <input type="password"class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <button class="btn btn-primary">Login</button>
                        <span class="error ">  <?=$this->session->flashdata('error')?></span>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('public/js/jquery/jquery.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('public/js/bootstrap/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('public/js/jquery/validation_1.14.0.js')?>"></script>
    <script src="<?php echo base_url('public/js/admin/main.js')?>"></script>
</body>
</html>


