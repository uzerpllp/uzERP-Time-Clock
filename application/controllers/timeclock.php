<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeclock extends Application {
	
	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}
	
	public function index()
	{
		
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