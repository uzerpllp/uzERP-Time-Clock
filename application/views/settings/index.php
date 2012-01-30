<?php $this->load->view('common/header'); ?>

	<h2>Settings</h2>
	
	<?php if (isset($form_valid) && $form_valid === FALSE) : ?>
		<ul class="errors">
			<?php echo validation_errors(); ?>
		</ul>
	<?php endif; ?>

	<form action="" method="post">
		<ul>
			<li>
				<label>Minutes between swipe:</label>
				<input type="text" name="minutes_between_swipe" value="<?php echo set_value('minutes_between_swipe', $minutes_between_swipe); ?>" />
			</li>
			<li>
				<label>Maximum shift length (hours):</label>
				<input type="text" name="maximum_shift_length" value="<?php echo set_value('maximum_shift_length', $maximum_shift_length); ?>" />
			</li>
			<li>
				<input type="submit" />
			</li>
		</ul>
	</form>

<?php $this->load->view('common/footer'); ?>