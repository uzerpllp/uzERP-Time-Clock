<!DOCTYPE html>
<html>
	<head>
		<title>uzERP Time Clock</title>
		<link href="/assets/css/login.css" media="screen" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="login">
				<div id="logo">
					<img src="/assets/images/logo.png" />
				</div>
				<form method="POST">
					<fieldset>
						<ul>
							<li>
								<input type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" />
								<?php echo form_error('username'); ?>	
							</li>
							<li>
								<input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password"/>
								<?php echo form_error('password'); ?>
							</li>
							<li>
								<input type="submit" name="submit" value="Log In" />
							</li>
						</ul>
					</fieldset>
				</form>
			</div>
			<p>&copy; <a href="http://www.uzerp.com">uzERP</a> <?php echo date('Y'); ?></p>
		</div>
	</body>
</html>