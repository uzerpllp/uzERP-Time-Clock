<?php $this->load->view('common/header'); ?>

	<div class="content">
	
		<div class="page-header">
			<h2>Dashboard</h2>
		</div>
		
		<div class="row">
			<div class="wide">
				
				<?php if ($query->num_rows > 0) : ?>
					
					<div class="alert alert-error">
						<strong>Error:</strong>
						There are <?php echo $query->num_rows; ?> clock errors, be sure to <a href="/timeclock/?show_errors=true">correct them</a> before exporting data
					</div>
				
				<?php else: ?>
					
					<div class="alert alert-success">
						<strong>Success:</strong>
						There are no clock errors, you are ready to export your data
					</div>
				
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	
<?php $this->load->view('common/footer'); ?>