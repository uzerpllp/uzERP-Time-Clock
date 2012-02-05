<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeclock extends Application {
	
	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}
	
	public function index()
	{
	
		$this->db
			->select('in_out.id, in_out.employee, in_out.date, in_out.status, in_out.error, employees.first_name, employees.last_name')
			->from('in_out')
			->join('employees', 'in_out.employee = employees.id')
			->order_by('in_out.id', 'desc');
		
		$data['query'] = $this->db->get();
		
		$this->load->view('timeclock/index', $data);
		
	}
	
	public function edit($id)
	{
	
//		echo $id;
		
		
		$this->load->view('timeclock/edit');
			
	}
	
}

/* End of file timeclock.php */
/* Location: ./application/controllers/timeclock.php */