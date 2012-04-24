<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock</h1>
	</div>
	
	<div class="row">
		<div class="wide">
			
			<h2>Settings</h2>
			
			<?php if (isset($form_valid) && $form_valid === FALSE) : ?>
				<ul class="errors">
					<?php echo validation_errors(); ?>
				</ul>
			<?php endif; ?>
		
			<form action="" class="form-vertical" method="post">
				
				<label>Minutes between swipe:</label>
				<input type="text" name="minutes_between_swipe" value="<?php echo set_value('minutes_between_swipe', $minutes_between_swipe); ?>" />
				
				<label>Maximum shift length (hours):</label>
				<input type="text" name="maximum_shift_length" value="<?php echo set_value('maximum_shift_length', $maximum_shift_length); ?>" />
				
				<label>Allowed devices (add each IP of a device that is allowed to use the swipe interface, comma delimited). Use 'ignore' to not discriminate.</label>
				<input type="text" name="swipe_addresses" value="<?php echo set_value('swipe_addresses', $swipe_addresses); ?>" />
				
				<br />
				
				<input type="submit" value="Save Settings" class="btn" />
				
			</form>
		
		</div>
	</div>
</div>



<?php $this->load->view('common/footer'); ?>