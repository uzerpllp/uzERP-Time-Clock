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
	
	public function edit($id = NULL)
	{

		$action = (!empty($id) ? 'edit' : 'new');

		// load helpers and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		// build + set form validation rules
		// fields must be set here even if they have no validation, this is to allow
		// he value to be set back to the form after failed validation
		
		$number_rule = '';
		
		if ($action == 'new')
		{
			$number_rule = '|is_unique[employees.number]';
		}
		
		$rules = array(
			array(
				'field'	=> 'number', 
				'label'	=> 'Employee Number' . $number_rule, 
				'rules'	=> 'trim|required'
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
		
		$this->form_validation->set_error_delimiters('<p>', '</p>');
		$this->form_validation->set_rules($rules);

		// output
		
		if (isset($_POST['submit']))
		{
		
			// process a form after submit action
			
			// validate the form
			$form_valid = $this->form_validation->run();
			
			//
			if ($form_valid === FALSE)
			{
			
				$data['form_valid'] = $form_valid;
				
				// if a form validation occurs on an edit page we need to return the id
				if ($action === 'edit')
				{
					$action .= '/' . $_POST['id'];
				}
				
				// reload the new / edit screens
				$this->load->view('employee/' . $action, $data);
				
				// we should exit here
				exit;
				
			}
			
			// if we've come this far we must have a valid form
			
			if ($action === 'new')
			{
				
				// insert the data into the employees table
				$success = $this->db->insert(
					'employees',
					array(
						'number'		=> $this->input->post('number'),
						'first_name'	=> $this->input->post('first_name'),
						'last_name'		=> $this->input->post('last_name'),
					)
				);
								
			}
			else 
			{
				
				// insert the data into the employees table
				$success = $this->db->update(
					'employees',
					array(
						'number'		=> $this->input->post('number'),
						'first_name'	=> $this->input->post('first_name'),
						'last_name'		=> $this->input->post('last_name'),
					),
					"id = " . $this->input->post('id')
				);
			
			}
			
			// by this point we've attempted to insert / update our employee
			// display employ index a success or failure message
			
			redirect('/employees/?' . ($success ? 'success' : 'error'), 'location');
			
		}
		else
		{
		
			$data = NULL;
					
			if ($action === 'edit')
			{
			
				// load the user by id
				
				$this->db
					->select('*')
					->from('employees')
					->where('id', $id);
				
				$data['query'] = $this->db->get();
			
			}
			
			$this->load->view('employee/edit', $data);
		
		}
	
	}
	
}

/* End of file employees.php */
/* Location: ./application/controllers/employees.php */