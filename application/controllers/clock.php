<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clock extends CI_Controller {
	
	public function index()
	{
		$this->load->view('clock/index');
	}
		
	public function swipe_card()
	{
		
		$next_status = 'IN';
		
		$this->db
			->select('in_out.id, in_out.employee, in_out.date, in_out.status, users.first_name, users.last_name')
			->from('in_out')
			->where('employee', $_POST['number'])
			->join('users', 'in_out.employee = users.id')
			->order_by('in_out.id', 'desc')
			->limit(1);
		
		$query = $this->db->get();
		
		if ($query->num_rows > 0)
		{
		
			// get the data and then get the first element
			$result = $query->result();
			$result = $result[0];
			
			//var_dump($result);
			
			if (strtoupper($result->status) === 'IN')
			{
				$next_status = 'OUT';	
			}
			
			// get settings from db
			$this->db->select('value')->from('settings')->where('key', 'minutes_between_swipe');
			$query = $this->db->get();
			$row = $query->row();
			
			$settings['minutes_between_swipe'] = $row->value;
			
			$this->db->select('value')->from('settings')->where('key', 'maximum_shift_length');
			$query = $this->db->get();
			$row = $query->row();
			
			$settings['maximum_shift_length'] = $row->value;
			
			// get the difference between now and last clock in / out
			$diff = abs(time() - strtotime($result->date));
			
			// calculate difference in minutes
			$minutes = $diff / 60;
			
			// check if the last clock in / out was less then the thresehold ago
			if ($settings['minutes_between_swipe'] != 0 && $minutes < $settings['minutes_between_swipe'])
			{
			
				// if it was, don't let the employee clock in / out
				
				echo json_encode(
					array(
						'status'			=> 'DELAY',
						'previous_status'	=> $result->status,
						'first_name'		=> $result->first_name,
						'last_name'			=> $result->last_name
					)
				);
				
				exit;
				
			}
			
			// calculate diffence in hours
			$hours = $diff / 60 / 60;
			
			// if the last status is IN and the hours exceeds the parameter...
			if (($settings['maximum_shift_length'] != 0 && $hours >= $settings['maximum_shift_length']) && strtoupper($result->status) === 'IN')
			{
				
				// set the error
				
				$data = array(
					'error' => TRUE,
				);
				
				$this->db->where('id', $result->id);
				$this->db->update('in_out', $data); 
				
				// set the next status
				$next_status = 'IN';
				
			}
			
		}
		
		// if result doesn't exist we won't have a employee name, fetch it now
		if (!isset($result))
		{
		
			$this->db
				->select('*')
				->from('users')
				->where('id', $_POST['number'])
				->limit(1);
			
			$query = $this->db->get();
			
			if ($query->num_rows > 0)
			{
			
				// get the data and then get the first element
				$result = $query->result();
				$result = $result[0];
				
			}
			else
			{
				echo json_encode(array('status' => 'NO_USER'));
				exit;
			}
		
		}
		
		$data = array(
			'employee'	=> $_POST['number'],
			'status'	=> $next_status
		);
		
		echo json_encode(
			array(
				'success'		=> $this->db->insert('in_out', $data),
				'status'		=> $next_status,
				'first_name'	=> $result->first_name,
				'last_name'		=> $result->last_name
			)
		);
		
		exit;
		
	}
	
	public function get_all()
	{
	
		$this->db
			->select('in_out.id, in_out.employee, in_out.date, in_out.status, in_out.error, users.first_name, users.last_name')
			->from('in_out')
			->join('users', 'in_out.employee = users.id')
			->order_by('in_out.id', 'desc');
		
		$data['query'] = $this->db->get();
		
		$this->load->view('clock/list', $data);
		
	}
	
}

/* End of file clock.php */
/* Location: ./application/controllers/welcome.php */