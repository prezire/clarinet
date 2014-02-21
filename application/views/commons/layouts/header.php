<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:title" content="Clarinet"/>
    <meta property="og:image" content="<?php echo base_url('public/images/logo.png'); ?>"/>
    <meta property="og:url" content="http://www.clarinet.comuv.com"/>
    <meta property="og:site_name" content="Clarinet"/>
    <meta property="og:type" content="website"/>
    <title>Clarinet</title>
    <?php $pubUrl = base_url('public') . '/'; ?>
    <link rel="stylesheet" href="<?php echo $pubUrl . 'libs/foundation-icons/foundation-icons.css'; ?>" />
		<link rel="stylesheet" href="<?php echo $pubUrl . 'libs/foundation-5.0.2/css/normalize.css'; ?>" />
		<link rel="stylesheet" href="<?php echo $pubUrl . 'libs/foundation-5.0.2/css/foundation.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pubUrl . 'libs/datetimepicker-master/jquery.datetimepicker.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pubUrl . 'libs/select2-3.4.5/select2.css'; ?>" />
		<link rel="stylesheet" href="<?php echo $pubUrl . 'css/base.css'; ?>" />
    
    <script src="<?php echo $pubUrl . 'libs/backbonejs/underscore-min.js'; ?>"></script>
    <script src="<?php echo $pubUrl . 'libs/backbonejs/backbone-min.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'libs/foundation-5.0.2/js/vendor/jquery.js'; ?>"></script>
    <script src="<?php echo $pubUrl . 'libs/canvasjs-1.3.0/canvasjs.min.js'; ?>"></script>
    <script src="<?php echo $pubUrl . 'libs/datetimepicker-master/jquery.datetimepicker.js'; ?>"></script>
    <script src="<?php echo $pubUrl . 'libs/select2-3.4.5/select2.js'; ?>"></script>
    <script src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="<?php echo $pubUrl . 'js/map_marker_widget.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'js/distance_widget.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'js/radius_widget.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'js/distance_widget.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'js/custom_gmap.js'; ?>"></script>
		<script src="<?php echo $pubUrl . 'js/clarinet.js'; ?>"></script>
	</head>
	<body>
    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <li class="name">
          
        </li>
        <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
      </ul>
      <section class="top-bar-section">
        <ul>
          <li>
            <a href="<?php echo site_url('home'); ?>" 
                title="Home">
              Home
            </a>
          </li>
          <?php
            $u = $this->session->userdata('user');
            if($u)
            {
          ?>
          <li>
            <a href="<?php echo site_url('moment'); ?>" 
               title="Moments">
              Moments
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('moments/report'); ?>" 
               title="Reports">
              Reports
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('home/settings'); ?>" 
               title="Settings">
              Settings
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('user/logout'); ?>" 
               title="Logout <?php echo $u->complete_name;?>">
              Sign Out
            </a>
          </li>
          <?php
            }
            else
            {
          ?>
          <li>
            <a href="<?php echo site_url('user/login'); ?>" title="Sign In">
              Sign In
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </section>
    </nav>
    <!-- Main content row. -->
    <div id="main">