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
	
	public function edit($id = NULL)
	{


		$data['action'] = $action = (!empty($id) ? 'edit' : 'new');
		
		$data['in'] = array(
			'date'		=> date('d/m/Y'),
			'hour'		=> '00',
			'minute'	=> '00'
		);
		
		$data['out'] = array(
			'date'		=> '',
			'hour'		=> '',
			'minute'	=> ''
		);

		if ($action === 'new')
		{

			// generate the employee list
			$data['employees'] = get_employees();

		}

		if (isset($_POST['submit']))
		{

			$in_time_date	= date_parse_from_format('d/m/Y', $_POST['clock']['in']['date']);
			$out_time_date	= date_parse_from_format('d/m/Y', $_POST['clock']['out']['date']);

			$in_time = mktime(
				$_POST['clock']['in']['hour'],
				$_POST['clock']['in']['minute'],
				0,
				$in_time_date['month'],
				$in_time_date['day'],
				$in_time_date['year']
			);

			if (!empty($_POST['clock']['out']['date']))
			{

				$out_time = mktime(
					$_POST['clock']['out']['hour'],
					$_POST['clock']['out']['minute'],
					0,
					$out_time_date['month'],
					$out_time_date['day'],
					$out_time_date['year']
				);

			}
			
			if (isset($_POST['clock']['error']))
			{
				$error = db_boolean(TRUE);
			}
			else
			{
				$error = NULL;
			}
			
			$clock_data				= array();
			$clock_data['in']		= date('Y-m-d H:i:s', $in_time);
			$clock_data['error']	= $error;

			if (!empty($_POST['clock']['out']['date']))
			{
				$clock_data['out'] = date('Y-m-d H:i:s', $out_time);
			};

			if ($action === 'new')
			{

				$clock_data['employee_id'] = $_POST['clock']['employee'];

				$success = $this->db->insert(
					'clock',
					$clock_data
				);

				// by this point we've attempted to insert / update our employee
				// display employ index a success or failure message
			
				redirect('/timeclock/edit/' . $this->db->insert_id() . '?' . ($success ? 'success' : 'error'), 'location');

			}
			else
			{
			
				$success = $this->db->update(
					'clock',
					$clock_data,
					array('id' => $id)
				);

			}
			
			$data['success'] = $success;
			
		}
		
		// get the latest data
		$this->db
			->select('clock.id, clock.employee_id, clock.in, clock.out, clock.error, employees.number as employee_number, employees.first_name, employees.last_name')
			->from('clock')
			->join('employees', 'clock.employee_id = employees.id')
			->where('clock.id', $id)
			->order_by('clock.id', 'desc');
		
		$data['query'] = $this->db->get()->row();
		
		if (!empty($data['query']))
		{

			$data['in'] = array(
				'date'		=> date('d/m/Y', strtotime($data['query']->in)),
				'hour'		=> date('H', strtotime($data['query']->in)),
				'minute'	=> date('i', strtotime($data['query']->in))
			);
			
			if (!empty($data['query']->out))
			{

				$data['out'] = array(
					'date'		=> date('d/m/Y', strtotime($data['query']->out)),
					'hour'		=> date('H', strtotime($data['query']->out)),
					'minute'	=> date('i', strtotime($data['query']->out))
				);

			}

		}

		$this->load->view('timeclock/edit', $data);
			
	}
	
}

/* End of file timeclock.php */
/* Location: ./application/controllers/timeclock.php */