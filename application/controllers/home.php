<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['body_class'] = 'home';
		$this->load->view('home/index', $data);
	}
	
	public function swipe_card()
	{
		
		// set the default next status
		$next_status = 'IN';
		
		// convert the employee number to employee id
		$employee = get_employee($_POST['number']); // ATTN: object
		
		// check if the employee exists
		if ($employee === FALSE)
		{
			echo json_encode(array('status' => 'NO_USER'));
			exit;	
		}
		
		// get the last clock status
		$last_status = get_last_clock($employee->id);
		
		// do a few checks if the last clock status is IN
		if ($last_status !== FALSE)
		{
			
			// get the difference between now and last clock in / out
			$diff = abs(time() - $last_status->in);
			
			
			 //*****************************************
			// CHECK FOR CLOSE SUCCESIVE CLOCK ATTMEPTS
			
			// calculate difference in minutes
			$minutes = $diff / 60;
			
			// check if the last clock in / out was less then the thresehold ago
			if ($minutes < get_setting('minutes_between_swipe', 1))
			{
			
				// if it was, don't let the employee clock in / out
				
				echo json_encode(
					array(
						'status'			=> 'DELAY',
						'previous_status'	=> (is_null($last_status->out) ? 'in' : 'out'),
						'first_name'		=> $employee->first_name,
						'last_name'			=> $employee->last_name
					)
				);
				
				exit;
				
			}
			
			
			 //****************
			// SET NEXT STATUS
			
			$next_status = (is_null($last_status->out) ? 'OUT' : 'IN');
			
			
			 //****************************
			// CHECK FOR MISSING CLOCK OUT 
			
			// calculate diffence in hours
			$hours = $diff / 60 / 60;
			
			// if the last status is IN and the hours exceeds the parameter...
			if (($hours >= get_setting('maximum_shift_length', '15')) && is_null($last_status->out))
			{
				
				// close off the current swipe, mark as an error
				$data = array(
					'in'	=> $last_status->in,
					'out'	=> $last_status->in,
					'error'	=> db_boolean(TRUE)
				);
				
				$this->db->where('id', $last_status->id);
				$this->db->update('clock', $data); 
				
				// set the next status
				$next_status = 'IN';
				
			}
			
		}
		
		
		 //************************
		// STORE SWIPE IN DATABASE
		
		if ($next_status == 'IN')
		{
			$success = $this->db->insert(
				'clock',
				array(
					'employee_id'	=> $employee->id,
					'in'			=> time()
				)
			);
		}
		else
		{
		
			$success = $this->db->update(
				'clock',
				array('out' => time()),
				array('id' => $last_status->id)
			);
				
		}
		
		
		 //***************
		// RETURN SUCCESS
		
		echo json_encode(
			array(
				'success'		=> $success,
				'status'		=> $next_status,
				'first_name'	=> $employee->first_name,
				'last_name'		=> $employee->last_name
			)
		);
		
		exit;
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */