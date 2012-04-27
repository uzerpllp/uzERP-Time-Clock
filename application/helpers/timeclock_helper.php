<?php

function get_employee($number)
{

	$CI =& get_instance();
	
	$query		= $CI->db->get_where('employees', array('number' => $number));
	$employee	= $query->row();
	
	// check if the employee exists
	if (!empty($employee))
	{
		return $employee;
	}
	
	return FALSE;

}

// ATTN - clock model?
function get_last_clock($employee_id)
{

	$CI =& get_instance();

	// fetch the last clock entry pair for the desired user
	$CI->db
		->from('clock')
		->where('employee_id', $employee_id)
		->order_by('id', 'desc')
		->limit(1);
	
	$query = $CI->db->get();
	
	if ($query->num_rows > 0)
	{
		return $query->row();
	}
	
	// no previous clock record or last is closed
	return FALSE;
	
	// ATTN: NO! return the id if still open (out == null)
	//           return false if the last clock is closed
	

}

function get_setting($key, $default = FALSE)
{
	$CI =& get_instance();
	
	$CI->db
		->select('value')
		->from('settings')
		->where('key', $key);
		
	$query = $CI->db->get();
	
	if ($query->num_rows > 0)
	{
		$row = $query->row();
		return $row->value;
	}
	
	return $default;
	
}

function db_boolean($value)
{
	$CI =& get_instance();
	
	$vars = array(
		'mysql_true' 	=> 1,
		'mysql_false'	=> 0,
		'postgre_true'	=> 't',
		'postgre_false'	=> 'f'
	);
	
	if ($value === TRUE)
	{
		return $vars[$CI->db->dbdriver . '_true'];
	}
	else
	{
		return $vars[$CI->db->dbdriver . '_false'];
	}
	
}

function force_dashboard()
{

	// we only want to show the home screen (the swipe screen) if the request
	// is coming from a known machine, as in one that we have set the IP address of
	
	// get the ip address for the machine
	$swipe_addresses = get_setting('swipe_addresses');

	// if the value doesn't exist...
	if ($swipe_addresses === FALSE || $swipe_addresses === 'ignore')
	{
	
		// we'll have no choice but to allow the home swipe to all
		// returning false doesn't force the dashboard	
		return FALSE;
		
	}
	
	$swipe_addresses = explode(',', $swipe_addresses);
	
	// return the final decision, should this address be forced to dashboard?
	return (!in_array($_SERVER['REMOTE_ADDR'], $swipe_addresses));

}

function the_date($format, $date = NULL)
{

	if (!empty($date))
	{
		echo date($format, $date);
	}

}

function get_week_number_date($week, $year)
{

	// Count from '0104' because January 4th is always in week 1
	// (according to ISO 8601).
	$time = strtotime($year . '0104 +' . ($week - 1) . ' weeks');
	
	// Get the time of the first day of the week
	return strtotime('-' . (date('w', $time) - 1) . ' days', $time);

}

// yes I know... should be in the employee model
function get_employees()
{

	$employees = array();

	$CI =& get_instance();
	
	$CI->db
		->from('employees')
		->order_by("last_name", "asc"); 
	
	$query = $CI->db->get();

	foreach ($query->result() as $row)
	{
		$employees[$row->id] = $row->last_name . ', ' . $row->first_name;
	}
	
	return $employees;
	
}

// end of time_clock_helper.php