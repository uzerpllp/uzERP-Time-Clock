<div class="content">

	<div class="page-header">
		<h2>Dashboard</h2>
	</div>
	
	<div class="row">
		<div class="span14">
			
			<p>Please login to access the uzERP Time Clock admin interface</p>
			
			<form method="POST" class="well">
			
				<label for="login_username">Username</label>
				<input name="username" type="text" value="<?php echo set_value('username'); ?>" placeholder="Username">
				
				<label for="login_password">Password</label>
				<input name="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
				
				<br />
				
				<button class="btn" name="login" type="submit">Sign in</button>
				
			</form>
			
		</div>
	</div>
</div>