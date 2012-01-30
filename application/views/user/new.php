<?php $this->load->view('common/header'); ?>

<h2>Create User</h2>

<?php if (isset($form_valid ) && $form_valid === FALSE) : ?>
	<ul class="errors">
		<?php echo validation_errors(); ?>
	</ul>
<?php endif; ?>

<form action="" method="post">
	<ul>
		<li>
			<label>Employee Number:</label>
			<input type="text" name="id" value="<?php echo set_value('id'); ?>" />
		</li>
		<li>
			<label>First Name:</label>
			<input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" />
		</li>
		<li>
			<label>Last Name:</label>
			<input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" />
		</li>
		<li>
			<input type="submit" />
		</li>
	</ul>
</form>

<?php $this->load->view('common/footer'); ?>