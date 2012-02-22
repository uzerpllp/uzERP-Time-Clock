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
				
			<?php endif; ?>
			
		</div>
	</div>
</div>