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

function the_date($format, $date = NULL)
{

	if (!empty($date))
	{
		echo date($format, $date);
	}

}

// end of time_clock_helper.php