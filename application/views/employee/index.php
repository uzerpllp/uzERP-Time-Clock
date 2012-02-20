<?php $this->load->view('common/header'); ?>

	<div class="content">
	
		<div class="page-header">
			<h1>Employees</h1>
			<a class="btn large primary" href="/employees/new/">Add User</a>
		</div>
		
		<div class="row">
			<div class="span14">
				
				<?php if (isset($_GET['success'])) : ?>
					
					<div class="alert alert-success">
						User created successfully
					</div>
					
				<?php endif; ?>
				
				<?php if (isset($_GET['error'])) : ?>
					
					<div class="alert alert-error">
						Failed to create user
					</div>
					
				<?php endif; ?>
				
				<table class="table table-bordered table-striped">
					
					<tr>
						<th>Employee Number</th>
						<th>Employee Name</th>
					</tr>
					
					<?php foreach ($query->result() as $row) : ?>
					
						<tr>
							<td><a href="/employees/edit/<?php echo $row->id; ?>"><?php echo $row->number; ?></a></td>
							<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
						</tr>
					
					<?php endforeach; ?>
					
				</table>
					
			</div>
		</div>
	</div>
	
<?php $this->load->view('common/footer'); ?>