<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function all_by_mobile()
	{
		$mobile = $this->input->post('mobile');
		
		if($mobile)
		{
			$this->load->model('user_data');
			$usersFound = $this->user_data->find_all_by_mobile($mobile);
			
			if($usersFound)
			{
				$response['users'] = $usersFound;
			}
			else
			{
				$response['users'] = array();
			}
			
			echo json_encode($response);
		}
		else
		{
			echo "NOK1";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */