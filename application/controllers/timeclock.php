<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeclock extends Application {
	
	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}
	
	public function index()
	{

		// load helpers and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		// build + set form validation rules
		// fields must be set here even if they have no validation, this is to allow
		// he value to be set back to the form after failed validation
		
		$rules = array(
			array(
				'field'	=> 'week', 
				'label'	=> 'Week Number', 
				'rules'	=> 'trim|numeric'
			),
			array(
				'field'	=> 'year', 
				'label'	=> 'Year', 
				'rules'	=> 'trim|numeric'
			)
		);
		
		$this->form_validation->set_error_delimiters('<p>', '</p>');
		$this->form_validation->set_rules($rules);

		// output
		$form_valid = NULL;

		if (isset($_POST['submit']))
		{
			$form_valid = $this->form_validation->run();
		}

		$data['form_valid'] = $form_valid;
		
		if ($form_valid === TRUE)
		{
			
			$year = $this->input->post('year');
			$week = $this->input->post('week');

			$start	= get_week_number_date($week, $year);
			$end	= strtotime('+1 week', $start);

			$this->db->where('("in" BETWEEN \'' . date('o-m-d', $start) . '\' AND \'' . date('o-m-d', $end) . '\')', NULL, FALSE);

		}

		if (isset($_GET['show_errors']))
		{
			$this->db->where('error', db_boolean(TRUE));
		}
		
		$this->db
			->select('clock.id, clock.employee_id, clock.in, clock.out, clock.error, employees.number as employee_number, employees.first_name, employees.last_name')
			->from('clock')
			->join('employees', 'clock.employee_id = employees.id')
			->order_by('clock.id', 'desc');
		
		$data['query'] = $this->db->get();
		
		$this->load->view('timeclock/index', $data);
		
	}
	
	public function edit($id)
	{
	
		
		if (isset($_POST['submit']))
		{
		
			$in_time = mktime(
				$_POST['clock']['in']['hour'],
				$_POST['clock']['in']['minute'],
				$_POST['clock']['in']['second'],
				$_POST['clock']['in']['month'],
				$_POST['clock']['in']['day'],
				$_POST['clock']['in']['year']
			);
			
			$out_time = mktime(
				$_POST['clock']['out']['hour'],
				$_POST['clock']['out']['minute'],
				$_POST['clock']['out']['second'],
				$_POST['clock']['out']['month'],
				$_POST['clock']['out']['day'],
				$_POST['clock']['out']['year']
			);
			
			if (isset($_POST['clock']['error']))
			{
				$error = db_boolean(TRUE);
			}
			else
			{
				$error = NULL;
			}
			
			$update_data = array(
				'in'	=> date('Y-m-d H:i:s', $in_time),
				'out'	=> date('Y-m-d H:i:s', $out_time),
				'error'	=> $error
			);
				
			$success = $this->db->update(
				'clock',
				$update_data,
				array('id' => $id)
			);
			
			$data['update_success'] = $success;
			
		}
		
		// get the latest data
		$this->db
			->select('clock.id, clock.employee_id, clock.in, clock.out, clock.error, employees.number as employee_number, employees.first_name, employees.last_name')
			->from('clock')
			->join('employees', 'clock.employee_id = employees.id')
			->where('clock.id', $id)
			->order_by('clock.id', 'desc');
		
		$data['query'] = $this->db->get()->row();
		
		$this->load->view('timeclock/edit', $data);
			
	}
	
}

/* End of file timeclock.php */
/* Location: ./application/controllers/timeclock.php */