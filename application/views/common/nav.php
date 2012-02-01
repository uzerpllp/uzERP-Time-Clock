<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/dashboard">uzERP Time Clock</a>
		
			<?php if (logged_in()) : ?>
				
				<ul class="nav">
					<li><a href="/employees">Employees</a></li>
					<li><a href="/timeclock">Time Clock</a></li>
					<li><a href="/settings">Settings</a></li>
				</ul>
			
				<ul class="nav" style="float: right">
					<li><a href="#">Hello <?php echo username(); ?>!</a></li>
					<li><?php echo anchor('logout', 'Logout'); ?></li>
				</ul>
			
			<?php else: ?>
			
				<form method="POST" class="pull-right">
					<input class="input-small" name="username" type="text" value="<?php echo set_value('username'); ?>" placeholder="Username">
					<input class="input-small" name="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
					<button class="btn" name="login" type="submit">Sign in</button>
				</form>
							
			<?php endif; ?>
			
		</div>
	</div>
</div>