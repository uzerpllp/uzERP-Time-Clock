<?php $this->load->view('common/header'); ?>

	<div class="content">
	
		<div class="page-header">
			<h1>Dashboard</h1>
		</div>
		
		<div class="row">
			<div class="span14">
				
				<?php if ($query->num_rows > 0) : ?>
					
					<div class="alert-message danger">
						<p>There are <?php echo $query->num_rows; ?>, be sure to <a href="">correct them</a> before exporting data</p>
					</div>
					
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	
<?php $this->load->view('common/footer'); ?>