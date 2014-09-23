<?php

class family_data extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	function get_family_push_tokens($userID)
	{
		$this->db->where('userID',$userID);
		
		$response = FALSE;
		
		if ($this->db->count_all_results('user_family') > 0)
		{
			$this->db->select('user_data.pushToken');
			$this->db->where('user_family.userID', $userID);
			$this->db->join('user_family', 'user_family.familyMemberID = user_data.id');
			$response = $this->db->get('user_data')->result();
		}
		else
		{
			//User has added no family
		}
		
		return $response;
	}
	
	function find_by_user_id($userID)
	{
		$this->db->where('userID',$userID);
		
		$response = FALSE;
		
		if ($this->db->count_all_results('user_family') > 0)
		{			
			$this->db->select('user_data.name');
			$this->db->select('user_data.type');
			$this->db->select('user_data.status');
			$this->db->select('user_data.mobile');
			$this->db->select('user_data.timestamp');
			$this->db->select('user_data.lat');
			$this->db->select('user_data.lng');
			$this->db->where('user_family.userID', $userID);
			$this->db->order_by('user_data.name','asc');
			$this->db->join('user_family', 'user_family.familyMemberID = user_data.id');
			$response = $this->db->get('user_data')->result();
		}
		else
		{
			//User not found
		}
		
		return	$response;
		
	}
	
	function find_all_by_mobile($mobile)
	{
		$this->db->where('mobile',$mobile);
		
		if ($this->db->count_all_results('user_data') > 0)
		{
			$this->db->where('mobile',$mobile);
			return $this->db->get('user_data')->result();
		}
		else
		{
			return FALSE;
		}
		
	}
	
}