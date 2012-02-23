<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock / Edit</h1>
	</div>
	
	<div class="row">
		<div class="wide">
		
			<?php if (isset($update_success) && $update_success === TRUE) : ?>
			
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

				<legend><?php echo $query->first_name; ?> <?php echo $query->last_name; ?>, <?php echo date('jS F Y', $query->in); ?></legend>

				<fieldset>
					
					<input type="hidden" name="submit" />
					
					<div class="control-group">
						<label class="control-label" for="clock_in">In</label>
						<div class="datetime controls">
							<input type="text" class="input-mini" name="clock[in][day]" value="<?php the_date('d', $query->in); ?>"><span> / </span>
							<input type="text" class="input-mini" name="clock[in][month]" value="<?php the_date('m', $query->in); ?>"><span> / </span>
							<input type="text" class="input-mini" name="clock[in][year]" value="<?php the_date('Y', $query->in); ?>"><span>&nbsp;&nbsp;</span>
						
							<input type="text" class="input-mini" name="clock[in][hour]" value="<?php the_date('H', $query->in); ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[in][minute]" value="<?php the_date('i', $query->in); ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[in][second]" value="<?php the_date('s', $query->in); ?>"><span> </span>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="clock_out">Out</label>
						<div class="datetime controls">
							
							<input type="text" class="input-mini" name="clock[out][day]" value="<?php the_date('d', $query->out); ?>"><span> / </span>
							<input type="text" class="input-mini" name="clock[out][month]" value="<?php the_date('m', $query->out); ?>"><span> / </span>
							<input type="text" class="input-mini" name="clock[out][year]" value="<?php the_date('Y', $query->out); ?>"><span>&nbsp;&nbsp;</span>
						
							<input type="text" class="input-mini" name="clock[out][hour]" value="<?php the_date('H', $query->out); ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[out][minute]" value="<?php the_date('i', $query->out); ?>"><span>:</span>
							<input type="text" class="input-mini" name="clock[out][second]" value="<?php the_date('s', $query->out); ?>"><span> </span>							
							
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