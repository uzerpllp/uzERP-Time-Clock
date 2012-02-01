<?php $this->load->view('common/header'); ?>

	<div class="content">
	
		<div class="page-header">
			<h1>Employees</h1>
			<a class="btn large primary" href="/user/new/">Add User</a>
		</div>
		
		<div class="row">
			<div class="span14">
				
				<?php if (isset($_GET['new_user'])) : ?>
					<p class="success">User created</p>
				<?php endif; ?>
				
				<table class="bordered-table zebra-striped">
					
					<tr>
						<th>Employee Number</th>
						<th>Employee Name</th>
					</tr>
					
					<?php foreach ($query->result() as $row) : ?>
					
						<tr>
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
						</tr>
					
					<?php endforeach; ?>
					
				</table>
					
			</div>
		</div>
	</div>
	
<?php $this->load->view('common/footer'); ?>