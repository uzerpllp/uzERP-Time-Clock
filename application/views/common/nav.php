<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="/dashboard">uzERP Time Clock</a>
			
				<ul class="nav">
					<li><a href="/dashboard/employees">Employees</a></li>
					<li><a href="#">Time Clock</a></li>
					<li><a href="/dashboard/settings">Settings</a></li>
				</ul>
			
				<ul style="float: right">
					<li><a href="#">Hello <?php echo username(); ?>!</a></li>
					<li><?php echo anchor('logout', 'Logout'); ?></li>
				</ul>
				
		</div>
	</div>
</div>