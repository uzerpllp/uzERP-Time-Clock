<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Application {
	
	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}
	
	public function index()
	{
	
		$this->db
			->select('*')
			->from('clock')
			->where('error', db_boolean(TRUE));
		
		$data['query'] = $this->db->get();
		
		$this->load->view('dashboard/index', $data);
	}
		
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */