<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('PW_AUTH', '');
define('PW_APPLICATION', '');
define('PW_DEBUG', false);

class Send extends CI_Controller {
	
	public function alert()
	{
		$userID		= $this->input->post('userID');
		$alertType	= $this->input->post('type');
		$lat		= $this->input->post('lat');
		$long		= $this->input->post('lng');
		
		
		if($userID && $alertType && $lat && $long)
		{
			$this->load->model('family_data');
			
			$familyTokens = $this->family_data->get_family_push_tokens($userID);
			
			if($familyTokens)
			{
				$count = count($familyTokens);
				
				for($i=0; $i<$count; $i++)
				{
					$pushTokensArr[] = $familyTokens[$i]->pushToken;
				}
				
				$this->load->model('user_data');
				
				$userName = $this->user_data->get_user_name($userID);
				
				switch($alertType)
				{
					case '2':
						$message = "$userName: Estoy bien!";
					break;
					
					case '1':
						$message = "$userName: Ayuda! Estoy atrapado!";
					break;
					
					case '3':
						$message = "$userName: Ayuda! Estoy lastimado!";
					break;
				}
				
				$this->send_push($message, $pushTokensArr);
				
			}
			else
			{
				//Do nothing, user has not added family members.
			}
			
			$date = new DateTime();
			$timestamp = $date->format('Y-m-d H:i:s'); 
				
			if(2 == $alertType)
			{
				$this->load->model('user_data');
				$this->user_data->set_user_ok_status($userID,$timestamp);
			}
			else
			{
				$this->load->model('map');
				
				
				$newAlert['userID']		= $userID;
				$newAlert['type']		= $alertType;
				$newAlert['lat']		= $lat;
				$newAlert['lng']		= $long;
				$newAlert['timestamp']	= $timestamp;
				
				$this->map->add_alert_and_update_user_data($userID,$newAlert);
			}
			
			echo "OK";
			
		}
		else
		{
			echo "NOK1";
		}
		
		
	}
	
	private function send_push($message, $tokens)
	{	
		$this->pwCall('createMessage',[
					    'application' => PW_APPLICATION,
					    'auth' => PW_AUTH,
					    'notifications' => [
					            [
					                'send_date' => 'now',
					                'content' => $message,
					                'devices' => $tokens,
					                'data' => ['custom' => 'json data']
					            ]
					        ]
					    ]
					);


	}


	private function pwCall($method , $data) 
	{
	    $url = 'https://cp.pushwoosh.com/json/1.3/' . $method;
	    $request = json_encode(['request' => $data]);
	 
	    $ch = curl_init();

	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	    curl_setopt($ch, CURLOPT_HEADER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	 
	    $response = curl_exec($ch);
	    $info = curl_getinfo($ch);
	    curl_close($ch);
	 
	    if (defined('PW_DEBUG') && PW_DEBUG) 
	    {
	        print "[PW] request: $request\n";
	        print "[PW] response: $response\n";
	        //print "[PW] info: " . print_r($info, true);
	    }
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */