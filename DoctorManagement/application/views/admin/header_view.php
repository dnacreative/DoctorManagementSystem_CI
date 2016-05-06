<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Voyagermed admin panel</title>
    <link href="<?php echo base_url('public/css/admin/main.css')?>" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('public/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('public/css/admin/sb-admin.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('public/css/font-awesome.min.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('public/css/admin/summernote.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/autocomplete.css')?>" rel="stylesheet">
    
    <!-- Searchable list -->
    <link rel="stylesheet" href="<?php echo base_url('public/css/docsupport/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/docsupport/prism.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/chosen.css')?>">
    <style type="text/css" media="all">
        /* fix rtl for demo */
        .chosen-rtl .chosen-drop { left: -9000px; }
    </style>
    
    <!--Datatable -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/jquery.dataTables.css')?>">
    
    <!-- image crop -->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/tooltip.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/dist/cropper.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/crop.css')?>">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('admin_dev/home')?>">Voyagermed Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li>
                <a href="<?=base_url('admin_dev/logout')?>"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="sidebar-search" style="padding:15px">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li <?=($this->uri->segment(2) == "home" ? "class='active'" : "")?>>
                    <a href="<?php echo base_url('admin_dev/home')?>"><i class="fa fa-ambulance"></i> Home</a>
                </li>
                <li <?=($this->uri->segment(2) == "about" ? "class='active'" : "")?>>
                    <a href="<?php echo base_url('admin_dev/about')?>"><i class="fa fa-hospital-o"></i> About</a>
                </li>
                <li <?=($this->uri->segment(2) == "ipblock" ? "class='active'" : "")?>>
                    <a href="<?php echo base_url('admin_dev/ipblock')?>"><i class="fa fa-hospital-o"></i> IP BlockList</a>
                </li>
                
                <li <?=($this->uri->segment(2) == "procedures" ? "class='active'" : "")?>>
                    <a href="<?php echo base_url('admin_dev/procedures')?>"><i class="fa fa-medkit"></i> Procedure </a>
                </li>
                <li <?=($this->uri->segment(2) == "Doctors" ? "class='active'" : "")?>>
                    <a  href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-user-md"></i> Doctors<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="<?php echo base_url('admin_dev/doctors/plastic-surgery')?>">Plastic Surgery</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin_dev/doctors/orthopedic')?>">Orthopedic</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin_dev/doctors/spine')?>">Spine</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin_dev/doctors/dental')?>">Dental</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url('admin_dev/doctors/fertility')?>">Fertility</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper" class="pull-right">

        <div class="container-fluid">
