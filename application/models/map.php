<?php

class Map extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}

	// function set_user_alert($lat,$lon)
	// {
	// 	$newAlert['latitude']		= $lat;
	// 	$newAlert['longitude']		= $long;

	// 	$this->db->insert('user_alert', $newAlert);
	// }
	
	function get_user_alerts()
	{
		$this->db->select('lat');
		$this->db->select('lng');

		return $this->db->get('user_alert')->result();
	}
	
	function add_alert_and_update_user_data($userID,$newAlert)
	{
		$this->db->where('userID', $userID);
		$this->db->set('active', 0);
		$this->db->update('user_alert');
		
		
		$this->db->insert('user_alert', $newAlert);
		
		
		$this->db->where('id', $userID);
		$this->db->set('status', $newAlert['type']);
		$this->db->set('lat', $newAlert['lat']);
		$this->db->set('lng', $newAlert['lng']);
		$this->db->set('timestamp', $newAlert['timestamp']);
		$this->db->update('user_data');
	}

	function save_cap($newCAP)
	{
		$this->db->insert('caps',$newCAP);
	}

	function get_caps()
	{
		$this->db->select('name');
		$this->db->select('url');
		$this->db->where('type',0);

		return $this->db->get('caps')->result();

	}

	function get_atlas()
	{
		$this->db->select('name');
		$this->db->select('url');
		$this->db->where('type',1);

		return $this->db->get('caps')->result();

	}

	function remove_caps()
	{
		$this->db->where('type', 0);
		$this->db->delete('caps');
	}

	function remove_atlas()
	{
		$this->db->where('type', 1);
		$this->db->delete('caps');
	}

	
}