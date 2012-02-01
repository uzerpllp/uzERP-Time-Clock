var reset_timer = null;

	String.prototype.replaceAt = function(index, char) {
		
		var len = char.length;
		
		// if we're replacing with an empty string, we
		// actually want the length to be 1
		
		if (char == '')
		{
			 len = 1;
		}
		
		return this.substr(0, index) + char + this.substr(index + len);
		
	}
		
	function process_code(input) {
		
		// set various vars
		var number = input; // ATTN: this needs to be variable
		
		
		// reset the screen and disable any previous reset timers
		reset_screen();
		clearTimeout(reset_timer);
		
		if (!$.isNumeric(number)) {
			
			$('.status')
					.addClass('error')
					.html('Employee number must be numeric');
			
			reset_timer = setTimeout('reset_screen()', 5000)
			
			return false;
		}
		
		$.ajax({
			url: '/clock/swipe_card/',
			dataType: 'json',
			data: {
				name	: name,
				number	: number
			},
			type: 'POST',
			success: function (data) {
				
				
					switch (data.status.toUpperCase()) {
					
						case 'IN':
							$('.name').html(data.first_name + ' ' + data.last_name);
							$('.status')
								.addClass('success')
								.html("You have clocked in");
							break;
							
						case 'OUT':
							$('.name').html(data.first_name + ' ' + data.last_name);
							$('.status')
								.addClass('success')
								.html("You have clocked out");
							break;
								
						case 'DELAY':
							$('.name').html(data.first_name + ' ' + data.last_name);
							$('.status')
								.addClass('error')
								.html("You've already clocked " + data.previous_status.toLowerCase());
							break;
								
						case 'NO_USER':
							$('.status')
								.addClass('error')
								.html("No employee exists for that employee code");
							break;
							
					}
					
				
			},
			complete: function () {
				reset_timer = setTimeout('reset_screen()', 5000)
			}
		});
		
	}
	
function reset_screen() {
		
	$('.name').html('Swipe your card');
	$('.status').html('').removeClass('error success');
	
};

function update_clock() {
	console.log('update_clock');
	
	var month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	
	
	var d		= new Date(),
		minutes	= d.getMinutes();

	if (minutes < 10) {
		minutes = "0" + minutes
	}
	
	$('.time').html(d.getDate() + d.getDaySuffix() + ' ' + month[d.getMonth() - 1] + ' ' + d.getFullYear() + ', ' + d.getHours() + ":" + minutes + ':' + d.getSeconds());
  
}

$(document).ready(function() {

	var input = '';
	
	$('body').keyup(function(event) {
		
		// listen for keyup
		if (event.keyCode === 13) {
				
			// if return is hit, start process
			process_code(input.toLowerCase());
			input = '';
			
		} else {
			// anything else, append to input var
			input = input + String.fromCharCode(event.keyCode);
		}
		
	});
	
	update_clock();
	
	setInterval("update_clock()", 1000);
	
	
	
});

Date.prototype.getDaySuffix =
  function(utc) {
    var n = utc ? this.getUTCDate() : this.getDate();
    // If not the 11th and date ends at 1
    if (n != 11 && (n + '').match(/1$/))
      return 'st';
    // If not the 12th and date ends at 2
    else if (n != 12 && (n + '').match(/2$/))
      return 'nd';
    // If not the 13th and date ends at 3
    else if (n != 13 && (n + '').match(/3$/))
      return 'rd';
    else
      return 'th';
  };
