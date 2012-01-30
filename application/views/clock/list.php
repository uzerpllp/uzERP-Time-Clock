<table>
	
	<tr>
		<th>Employee Number</th>
		<th>Employee Name</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	
	<?php foreach ($query->result() as $row) : ?>
	
		<tr <?php if ( $row->error == TRUE ) echo 'class="error"' ; ?> >
			<td><?php echo $row->employee; ?></td>
			<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
			<td><?php echo $row->status; ?></td>
			<td><?php echo $row->date; ?></td>
		</tr>
	
	<?php endforeach; ?>
	
</table>