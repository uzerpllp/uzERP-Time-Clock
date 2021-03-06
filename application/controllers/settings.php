<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Application {
	
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
				'field'	=> 'minutes_between_swipe', 
				'label'	=> 'Minutes between swipe', 
				'rules'	=> 'trim|required|numeric'
			),
			array(
				'field'	=> 'maximum_shift_length', 
				'label'	=> 'Maximum shift length', 
				'rules'	=> 'trim|required|numeric'
			),
			array(
				'field'	=> 'swipe_addresses', 
				'label'	=> 'Swipe addresses (comma delimited)', 
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
			
			$data['minutes_between_swipe'] = get_setting('minutes_between_swipe', '');
			$data['maximum_shift_length'] = get_setting('maximum_shift_length', '');
			$data['swipe_addresses'] = get_setting('swipe_addresses', '');
			
			$this->load->view('settings/index', $data);
			
		}
		else
		{
		
			$data = array();
			
			// loop through the rules, build a data array of the stuff we want in the db
			foreach ($rules as $rule)
			{
			
				$data = array(
				     'value' => $this->input->post($rule['field']),
				);
				
				if (get_setting($rule['field']) === FALSE)
				{
					$data['key'] = $rule['field'];
					$this->db->insert('settings', $data);
				}
				else
				{
					$this->db->where('key', $rule['field']);
					$this->db->update('settings', $data); 
				}
				
			}
			
			// display juicy success page
			redirect('/settings', 'location');
		
		}
	
	}
	
}

/* End of file clock.php */
/* Location: ./application/controllers/welcome.php */