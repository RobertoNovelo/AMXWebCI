<?php

class user_data extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	function set_user_ok_status($userID,$timestamp)
	{
		$this->db->where('id', $userID);
		$this->db->set('status', 2);
		$this->db->set('timestamp', $timestamp);
		$this->db->update('user_data');
	}
	
	function find_and_add_by_mobile($mobile,$userID)
	{
		$this->db->where('mobile',$mobile);
		
		$response = FALSE;
		
		if ($this->db->count_all_results('user_data') > 0)
		{
			$this->db->where('mobile',$mobile);
			$fuID = $this->db->get('user_data')->row()->id;
			
			$this->db->where('userID',$userID);
			$this->db->where('familyMemberID',$fuID);
			
			if ($this->db->count_all_results('user_family') > 0)
			{
				//Do nothing, connection exists already
			}
			else
			{
				$newFamilyConnection['userID'] = $userID;
				$newFamilyConnection['familyMemberID'] = $fuID;
				$this->db->insert('user_family', $newFamilyConnection);
				
				$this->db->select('user_data.name');
				$this->db->select('user_data.status');
				$this->db->select('user_data.mobile');
				$this->db->select('user_data.lat');
				$this->db->select('user_data.lng');
				$this->db->select('user_data.type');
				$this->db->select('user_data.timestamp');
				$this->db->where('user_family.userID', $userID);
				$this->db->order_by('user_data.name','asc');
				$this->db->join('user_family', 'user_family.familyMemberID = user_data.id');
				$response = $this->db->get('user_data')->result();
			}
		}
		else
		{
			//User not found
		}
		
		return	$response;
		
	}
	
	function get_user_name($userID)
	{
		$this->db->where('id',$userID);
		return $this->db->get('user_data')->row()->name;
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