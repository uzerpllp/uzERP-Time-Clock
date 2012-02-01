<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock</h1>
	</div>
	
	<div class="row">
		<div class="span10">
			
			<table class="table table-bordered table-striped">
				
				<tr>
					<th>Date</th>
					<th>Employee Number</th>
					<th>Employee Name</th>
					<th>Status</th>
				</tr>
				
				<?php foreach ($query->result() as $row) : ?>
				
					<tr <?php if ( $row->error == TRUE ) echo 'class="error"' ; ?> >
						<td><a href="/dashboard/timeclock/edit/<?php echo $row->id; ?>"><?php echo $row->date; ?></a></td>
						<td><?php echo $row->employee; ?></td>
						<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
						<td><?php echo $row->status; ?></td>
					</tr>
				
				<?php endforeach; ?>
				
			</table>
			
		</div>
	</div>
</div>
	
<?php $this->load->view('common/footer'); ?>