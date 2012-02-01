<!doctype HTML>
<html>
	<head>
	
		<title>uzERP Time Clock</title>
		
		<script src="/assets/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script src="/assets/js/timeclock.js"></script>
		
		<link href="/assets/css/screen.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/swipe-card.css" rel="stylesheet" type="text/css" />
		
	</head>
	<body class="<?php if (isset($body_class)) echo $body_class; ?>">
	
		
		<div class="container">

			<div class="left-container">
				<p class="title">uzERP Time Clock</p>
				<p class="time"></p>
				<p class="name">Swipe your card</p>
				<p class="status"></p>
			</div>
			
			<div class="swipe-card">
				<img class="swipe-left" src="/assets/images/swipe-left.png" />
				<img class="card" src="/assets/images/card.png" />
				<img class="swipe-right" src="/assets/images/swipe-right.png" />
			</div>
			
		</div>
		
	</body>
</html>