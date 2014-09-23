<?php

class user_auth extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	function register($mobile,$name,$pushToken,$type)
	{
		$this->db->where('mobile',$mobile);
		
		if ($this->db->count_all_results('user_data') > 0)
		{
			return FALSE;
		}
		else
		{
			$newUser['name']		= $name;
			$newUser['mobile']		= $mobile;
			$newUser['type']		= $type;
			$newUser['pushToken']	= $pushToken;
			$this->db->insert('user_data', $newUser);
			
			return $this->db->insert_id();
		}
		
	}
	
	function login($mobile)
	{
		$this->db->where('mobile',$mobile);
		
		if ($this->db->count_all_results('user_data') > 0)
		{
			$this->db->where('mobile',$mobile);
			$this->db->select('id');
			$this->db->select('name');
			
			return $this->db->get('user_data')->row();
		}
		else
		{
			return FALSE;
		}
	}

	
}