<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock</h1>
	</div>
	
	<div class="row">
		<div class="span10">
			
			<?php if (isset($_GET['show_errors'])) : ?>
	
				<div class="alert">
					You're currently viewing clock entries with errors - <a href="/timeclock">view all clock entries</a>
				</div>
				
			<?php endif; ?>
			
			<table class="table table-bordered table-striped">
				
				<tr>
					<th>ID</th>
					<th>Employee Number</th>
					<th>Employee Name</th>
					<th>In</th>
					<th>Out</th>
					<th>Error?</th>
				</tr>
				
				<?php foreach ($query->result() as $row) : ?>
				
					<tr <?php if ( $row->error == TRUE ) echo 'class="error"' ; ?> >
						<td><a href="/timeclock/edit/<?php echo $row->id; ?>"><?php echo $row->id; ?></a></td>
						<td><?php echo $row->employee_number; ?></td>
						<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
						<td><?php echo $row->in; ?></td>
						<td><?php echo $row->out; ?></td>
						<td><?php echo ($row->error == 1 ? 'Yes' : '' )	; ?></td>
					</tr>
				
				<?php endforeach; ?>
				
			</table>
			
		</div>
	</div>
</div>
	
<?php $this->load->view('common/footer'); ?>