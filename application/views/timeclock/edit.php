<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock / Edit</h1>
	</div>
	
	<div class="row">
		<div class="wide">
		
			<?php if (isset($_GET['success'])) $success = TRUE; ?>
			
			<?php if (isset($success) && $success === TRUE) : ?>
			
				<div class="alert alert-success">
					<strong>Success:</strong>
					Clock entry updated successfully
				</div>
			
			<?php endif; ?>
			
			<?php if (isset($update_success) && $update_success === FALSE) : ?>
			
				<div class="alert alert-error">
					<strong>ERROR:</strong>
					Clock entry failed to update
				</div>
			
			<?php endif; ?>
			
			<form class="form-horizontal" method="POST">

				<?php if ($action === 'edit') : ?>
					<legend><?php echo $query->first_name; ?> <?php echo $query->last_name; ?>, <?php echo date('jS F Y', strtotime($query->in)); ?></legend>
				<?php endif; ?>

				<fieldset>
					
					<input type="hidden" name="submit" />

					<?php if ($action === 'new') : ?>

						<div class="control-group">
							<label class="control-label" for="employee">Employee</label>
							<div class="datetime controls">
								<select id="employee" name="clock[employee]">

									<?php foreach ($employees as $id => $name) : ?>
										<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
									<?php endforeach; ?>

								</select>
							</div>
						</div>

					<?php endif; ?>

					<div class="control-group">
						<label class="control-label" for="clock_in">In</label>
						<div class="datetime controls">
							<input type="text" class="datepicker" name="clock[in][date]" value="<?php echo $in['date']; ?>">
							<input type="text" class="input-mini" name="clock[in][hour]" value="<?php echo $in['hour']; ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[in][minute]" value="<?php echo $in['minute']; ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="clock_out">Out</label>
						<div class="datetime controls">
							<input type="text" class="datepicker" name="clock[out][date]" data-date="01/02/2023" value="<?php echo $out['date']; ?>">
							<input type="text" class="input-mini" name="clock[out][hour]" value="<?php echo $out['hour']; ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[out][minute]" value="<?php echo $out['minute']; ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="clock_error">Error</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="clock_error" name="clock[error]" <?php echo (!empty($query->error) ? 'checked="checked"' : ''); ?>>
								Untick this box to reset the error status
							</label>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update clock</button>
					</div>
				
				</fieldset>
				
				
			</form>
			
		</div>
	</div>
</div>
	
<?php $this->load->view('common/footer'); ?>