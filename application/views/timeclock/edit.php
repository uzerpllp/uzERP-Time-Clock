<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock / Edit</h1>
	</div>
	
	<div class="row">
		<div class="span10">
		
			<form class="form-horizontal">

				<fieldset>
					
					<legend><?php echo $query->first_name; ?> <?php echo $query->last_name; ?>, <?php echo date('jS F Y', strtotime($query->in)); ?></legend>
					
					<div class="control-group">
						<label class="control-label" for="clock_in">In</label>
						<div class="controls">
							<input type="text" id="clock_in" name="clock[in]" value="<?php echo $query->in; ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="clock_out">Out</label>
						<div class="controls">
							<input type="text" id="clock_out" name="clock[out]" value="<?php echo $query->in; ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="clock_error">Error</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="clock_error" name="clock[error]" <?php echo ($query->error == 1 ? 'checked="checked"' : ''); ?>>
								Untick this box to reset the error status
							</label>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				
				</fieldset>
				
				
			</form>
			
		</div>
	</div>
</div>
	
<?php $this->load->view('common/footer'); ?>