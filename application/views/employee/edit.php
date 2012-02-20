<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>New Employee</h1>
	</div>
	
	<?php if (isset($form_valid) && $form_valid === FALSE) : ?>
		
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
		
	<?php endif; ?>
	
	<div class="row">
		<div class="span10">
			
			<form class="form-horizontal" method="POST">

				<fieldset>
					
					<?php 
					
						$id = $number = $first_name = $last_name = '';
						
						if (isset($query))
						{
							$employee = $query->row();
							
							$id			= $employee->id;
							$number		= $employee->number; 
							$first_name	= $employee->first_name;
							$last_name	= $employee->last_name;
						}
						
							
					?>
					
					<input type="hidden" name="submit" value="submit" />
					
					<?php if (!empty($id)) : ?>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<?php endif; ?>
					
					<div class="control-group">
						<label class="control-label" for="input01">Employee Number:</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01" name="number" value="<?php echo set_value('number', $number); ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input01">First Name:</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01" name="first_name" value="<?php echo set_value('first_name', $first_name); ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input01">Last Name:</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01" name="last_name" value="<?php echo set_value('last_name', $last_name); ?>">
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save Employee</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				
				</fieldset>
				
				
			</form>
			
		</div>
	</div>
</div>

<?php $this->load->view('common/footer'); ?>