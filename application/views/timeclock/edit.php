<?php $this->load->view('common/header'); ?>

<div class="content">

	<div class="page-header">
		<h1>Time Clock / Edit</h1>
	</div>
	
	<div class="row">
		<div class="span10">
			
			<h2>Ben Everard, 5th January 2012</h2>
			<br />
			
			<form class="form-horizontal">

				<fieldset>
					<legend>Clock In</legend>
					
					<div class="control-group">
						<label class="control-label" for="input01">In / Out Time</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="optionsCheckbox">Error</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="optionsCheckbox" value="option1">
								Untick this box to reset the error status
							</label>
						</div>
					</div>
					
					<legend>Clock Out</legend>
					
					<div class="control-group">
						<label class="control-label" for="input01">In / Out Time</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="optionsCheckbox">Error</label>
						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" id="optionsCheckbox" value="option1">
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