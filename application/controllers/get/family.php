<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Family extends CI_Controller {

	public function members()
	{
		$userID = $this->input->post('userID');
		
		if($userID)
		{
			$this->load->model('family_data');
			
			$familyMembers = $this->family_data->find_by_user_id($userID);
			
			if($familyMembers)
			{
				$response['familyMembers'] = $familyMembers;
				echo json_encode($response);
			}
			else
			{
				$response['familyMembers'] = array();
				echo json_encode($response);
			}
			
		}
		else
		{
			echo "NOK1";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */