<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Family extends CI_Controller {

	public function member()
	{
		$mobile = $this->input->post('mobile');
		$userID = $this->input->post('userID');
		
		if($mobile && $userID)
		{
			$this->load->model('user_data');
			
			$familyMembers = $this->user_data->find_and_add_by_mobile($mobile,$userID);
			
			if($familyMembers)
			{
				$response['familyMembers'] = $familyMembers;
				echo json_encode($response);
			}
			else
			{
				echo "NOK2";
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