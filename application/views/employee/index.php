<?php $this->load->view('common/header'); ?>

	<p><a href="/user/new/">Create new user</a></p>

	<?php if (isset($_GET['new_user'])) : ?>
		<p class="success">User created</p>
	<?php endif; ?>
	
	<table>
		
		<tr>
			<th>Employee Name</th>
			<th>Employee Number</th>
		</tr>
		
		<?php foreach ($query->result() as $row) : ?>
		
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
			</tr>
		
		<?php endforeach; ?>
		
	</table>
	
<?php $this->load->view('common/footer'); ?>