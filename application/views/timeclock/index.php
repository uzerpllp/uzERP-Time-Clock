<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock</h1>
		<a class="btn large primary" href="/timeclock/new/">New Clock Entry</a>
	</div>
	
	<div class="row">
		<div class="wide">

			<?php if (isset($form_valid) && $form_valid === FALSE) : ?>

				<div class="alert alert-error">
					<?php echo validation_errors(); ?>
				</div>

			<?php endif; ?>
			
			<?php if (isset($_GET['show_errors'])) : ?>
	
				<div class="alert">
					You're currently viewing clock entries with errors - <a href="/timeclock">view all clock entries</a>
				</div>
				
			<?php endif; ?>

			<form method="post">

				<input type="text" name="week" class="input-medium" placeholder="Week Number" value="<?php echo set_value('week', date('W')); ?>" />
				<input type="text" name="year" class="input-medium" placeholder="Year" value="<?php echo set_value('year', date('o')); ?>"/>

				<input class="btn btn-primary" type="submit" name="submit" value="Search" />
				<input class="btn" type="submit" name="clear" value="Clear" />

			</form>
			
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
						<td><?php the_date('d/m/Y H:i:s', strtotime($row->in)); ?></td>
						<td><?php the_date('d/m/Y H:i:s', strtotime($row->out)); ?></td>
						<td><?php echo (!empty($row->error) ? 'Yes' : '' )	; ?></td>
					</tr>
				
				<?php endforeach; ?>
				
			</table>
			
		</div>
	</div>
</div>
	
<?php $this->load->view('common/footer'); ?>