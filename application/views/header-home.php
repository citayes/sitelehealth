<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Informasi Telehealth Orthodontist</title>
    <!-- core CSS -->
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">-->
</head><!--/head-->

<body id="home" class="homepage">

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="homepage"><img src="<?php echo base_url(); ?>asset/images/logo.png" alt="logo" width="104" height="57"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo $home ?>"><a href="<?php echo base_url(); ?>index.php/homepage">Home</a></li>
                        <li class="<?php echo $signin ?>"><a href="<?php echo base_url(); ?>index.php/homepage/signin">Sign In</a></li>
                        <li class="<?php echo $signup ?>"><a href="<?php echo base_url(); ?>index.php/homepage/signup">Sign Up</a></li>                         
                    </ul>
                </div>                  
            </div><!--/.container-->
        </nav><!--/nav-->
        <?php if(isset($status)) echo $status; ?>
    </header><!--/header-->