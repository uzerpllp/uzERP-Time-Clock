<!doctype HTML>
<html>
	<head>
	
		<title>uzERP Time Clock</title>
		
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
		
		<style>
		   /* Override some defaults */
		      html, body {
		        background-color: #eee;
		      }
		      body {
		        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
		      }
		      .container > footer p {
		        text-align: center; /* center align it with the container */
		      }
		      .container {
		        width: 820px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
		      }
		
		      /* The white background content wrapper */
		      .content {
		        background-color: #fff;
		        padding: 20px;
		        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
		        -webkit-border-radius: 0 0 6px 6px;
		           -moz-border-radius: 0 0 6px 6px;
		                border-radius: 0 0 6px 6px;
		        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
		           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
		                box-shadow: 0 1px 2px rgba(0,0,0,.15);
		      }
		
		      /* Page header tweaks */
		      .page-header {
		        background-color: #f5f5f5;
		        padding: 20px 20px 10px;
		        margin: -20px -20px 20px;
		        overflow: hidden;
		      }
		      
		      .page-header h1 {
		      		float:  left;
		      }
		      
		      .page-header .btn {
		      	
		      	float:  right;
		      }
		
		      /* Styles you shouldn't keep as they are for displaying this base example only */
		      .content .span10,
		      .content .span4 {
		        min-height: 500px;
		      }
		      /* Give a quick and non-cross-browser friendly divider */
		      .content .span4 {
		        margin-left: 0;
		        padding-left: 19px;
		        border-left: 1px solid #eee;
		      }
		
		      .topbar .btn {
		        border: 0;
		      }
		      
		      .logo-container {
		      	height: 400px;
		      	width: 100%;
		      	
		      	position: relative;
		      }
		      
		      .logo-container img {
		      	position: absolute;
		      	top: 0;
		      	right: 0;
		      	bottom: 0;
		      	left: 0;
		      	margin: auto;
		      	
		      	
		      }
		      
		      .controls.datetime input, span {
		      	float: left !important;
		      	
		      	
		      	
		      }
		      .controls.datetime span {
		      	padding: 5px 3px;
		      	
		      	
		      }
		      .controls.datetime input {
		      	width: 30px !important;
		      }
		      .alert p:last-child {
					margin-bottom: 0;
				}
		      </style>
		<script src="/assets/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		
	</head>
	<body class="<?php if (isset($body_class)) echo $body_class; ?>">
	
		<?php $this->load->view('common/nav'); ?>
	
		<div class="container">