<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends Application {
	
	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}
	
	public function index()
	{
	
		$this->db
			->select('*')
			->from('employees')
			->order_by('id', 'desc');
		
		$data['query'] = $this->db->get();

		$this->load->view('employee/index', $data);
	}
	
	public function new_employee()
	{

		// load helpers and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		// build + set form validation rules
		// fields must be set here even if they have no validation, this is to allow
		// he value to be set back to the form after failed validation
		
		$rules = array(
			array(
				'field'	=> 'id', 
				'label'	=> 'Employee Number', 
				'rules'	=> 'trim|required|is_unique[employees.id]'
			),
			array(
				'field'	=> 'first_name', 
				'label'	=> 'First Name', 
				'rules'	=> 'trim|required'
			),
			array(
				'field'	=> 'last_name', 
				'label'	=> 'Last Name', 
				'rules'	=> 'trim|required'
			)
		);
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules($rules);

		// output...
		
		$form_valid = $this->form_validation->run();
		
		if ($form_valid === FALSE)
		{
			
			$data['form_valid'] = $form_valid;
			
			$this->load->view('employee/new', $data);
			
		}
		else
		{
		
			$data = array();
			
			// loop through the rules, build a data array of the stuff we want in the db
			foreach ($rules as $rule)
			{
				$data[$rule['field']] = $this->input->post($rule['field']);
			}
			
			// insert the 
			$success = $this->db->insert('employees', $data); 
			
			// display juicy success page
			redirect('/employee/?new_employee', 'location');
		
		}
	
	}
	
}

/* End of file employees.php */
/* Location: ./application/controllers/employees.php */