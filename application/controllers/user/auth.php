<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function register()
	{		
		$mobile		= $this->input->post('mobile');
		$name		= $this->input->post('name');
		$type		= $this->input->post('type');
		$pushToken	= $this->input->post('pushToken');
		
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		
		if($mobile && $name && $type && $pushToken )
		{
			if(preg_match($regex,$mobile))
			{
				$this->load->model("user_auth");
				
				$userID = $this->user_auth->register($mobile,$name,$pushToken,$type);
				
				if($userID)
				{
					$response["userID"] = $userID;
					echo json_encode($response);
				}
				else
				{
					echo "NOK3";
				}
			}
			else
			{
				echo "NOK2";
			}
		}
		else
		{
			echo $mobile;
		}
		
	}
	
	public function login()
	{
		$mobile = $this->input->post('mobile');
		
		if($mobile)
		{
			$this->load->model("user_auth");
			
			$userID = $this->user_auth->login($mobile);
			
			if($userID)
			{
				$response['userID'] = $userID->id;
				$response['name'] = $userID->name;
				
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