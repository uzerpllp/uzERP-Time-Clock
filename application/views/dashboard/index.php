<?php $this->load->view('common/header'); ?>

	<div class="content">
	
		<div class="page-header">
			<h1>Dashboard</h1>
		</div>
		
		<div class="row">
			<div class="span14">
				
				<?php if ($query->num_rows > 0) : ?>
					
					<div class="alert alert-error">
						<strong>Error:</strong>
						There are <?php echo $query->num_rows; ?> clock errors, be sure to <a href="/timeclock/?show_errors=true">correct them</a> before exporting data
					</div>
					
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	
<?php $this->load->view('common/footer'); ?>