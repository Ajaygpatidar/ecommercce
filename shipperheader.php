<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shipper Header</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <!-- Favicon -->
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

</head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url('css1/style1.css')?>">

<link href="<?php echo base_url('js1/js1.js')?>"  rel="stylesheet">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="<?php echo base_url('css/datatable.css')?>">



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
            <a class="navbar-brand" href="https://bryanrojasq.wordpress.com">
                <img src="http://placehold.it/200x50&text=E-commerce" alt="E-commerce">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right  top-nav">
            <li><a href="config.php?index"><i class="fa fa-home " aria-hidden="true"> Home  </i> 
            <li><a href="config.php?notification" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bell"><span class="badge btn-danger "></span></i></a>
            </li>            
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">Shipper User <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('welcome/logout')?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse navbar-left">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="config.php?dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                </li>
                <li>
                    <a href="config.php?index"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li>
                    <a href="<?php echo site_url('welcome/profile')?>"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                </li>
                <li>
                    <a href="<?php echo site_url('')?>"><i class="fa fa-user" aria-hidden="true"></i> My Wish list</a>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#vender"><i class="fa fa-cc" aria-hidden="true"></i> My order <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="vender" class="collapse">
                        <li><a href="<?php echo site_url('')?>"><i class="fa fa-angle-double-right"></i>Order information</a></li>
                        
                    </ul>
                </li>
              
                <li>
                    <a href="<?php echo site_url('welcome/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
