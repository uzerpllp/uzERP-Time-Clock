<?php $this->load->view('common/header'); ?>

	<script>
		
		function get_all() {
		
			$.ajax({
				url: '/clock/get_all',
				dataType: 'html',
				success: function(data) {
					$('.list').html(data);
				}
			});
		
		}
		
		$(document).ready(function() {
		
			setInterval("get_all()", 1000);
					    
		});
		
	</script>
	
	<div class="list"></div>
	
<?php $this->load->view('common/footer'); ?>