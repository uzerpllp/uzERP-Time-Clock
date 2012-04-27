<!doctype HTML>
<html>
	<head>
	
		<title>uzERP Time Clock</title>
		
		<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/css/dashboard.css" />
		<link rel="stylesheet" href="/assets/js/datepicker/css/datepicker.css" />


		<script src="/assets/js/jquery-1.7.1.min.js"></script>
		<script src="/assets/js/datepicker/js/bootstrap-datepicker.js"></script>

		<script>
			$(document).ready(function() {

				$('.datepicker').datepicker({
					format: 'dd/mm/yyyy'
				});

			});
		</script>
	</head>
	<body class="<?php if (isset($body_class)) echo $body_class; ?>">
	
		<?php $this->load->view('common/nav'); ?>
	
		<div class="container">