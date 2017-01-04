<?php
header("Content-Type: text/html; charset=utf-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "config.php";
?><!DOCTYPE html>
<html>
  <head>
    <title><?php echo getConfig('config.webapp.title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	
	<link rel="apple-touch-icon" href="/icon.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="icon" type="image/png" href="/icon.png" sizes=18x18>
	<link rel="shortcut icon" href="/icon.ico">
	<link rel="icon" type="image/png" href="/icon.png" sizes="32x32">
	
	
	<link href="css/style.css" rel="stylesheet">
	
	<!-- Das neueste kompilierte und minimierte CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optionales Theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!-- Das neueste kompilierte und minimierte JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
  </head>
  <body>
  

        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="index.php"><?php echo getConfig('config.webapp.title'); ?></a>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
					<?php
						include "navigation.php";
					?>
				</ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    
	<div class="container">