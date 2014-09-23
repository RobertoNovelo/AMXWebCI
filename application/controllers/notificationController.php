<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


define('PW_AUTH', '');
define('PW_APPLICATION', '');
define('PW_DEBUG', true);

class NotificationController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function notificaciones()
	{
		$this->load->view('notificaciones');
	}

	public function send_push()
	{
		$message = $this->input->post('pushMessage');

		$this->pwCall('createMessage',[
    'application' => PW_APPLICATION,
    'auth' => PW_AUTH,
    'notifications' => [
       					 	[
   							 'send_date' => 'now',
        					 'content' => $message,
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

	public function get_alerts()
	{
		$this->load->model('map');

		$mapMarkers = $this->map->get_user_alerts();

		echo json_encode($mapMarkers);
	}

	public function save_cap()
	{
		$nombre = $this->input->post('nombre');
		$url = $this->input->post('url');

		$newCAP = array(
			'type' => 0,
			'name' => $nombre,
			'url' => $url
		);

		$this->load->model('map');

		$this->map->save_cap($newCAP);
	}

	public function save_risk_zone()
	{
		$nombre = $this->input->post('nombre');
		$url = $this->input->post('url');

		$newCAP = array(
			'type' => 1,
			'name' => $nombre,
			'url' => $url
		);

		$this->load->model('map');

		$this->map->save_cap($newCAP);
	}

	public function get_caps()
	{
		$this->load->model('map');

		$response['caps'] = $this->map->get_caps();
		$response['atlas'] = $this->map->get_atlas();

		echo json_encode($response);
	}

	public function get_CAP_RZ()
	{
		$type = $this->input->post('type');

		$this->load->model('map');

		if ($type == 0)
		{
			$response = $this->map->get_caps();
		}

		else
		{
			$response = $this->map->get_atlas();
		}

		echo json_encode($response);
	}

	public function remove_all()
	{

		$type = $this->input->post('type');

		$this->load->model('map');

		if ($type == 0)
		{
			$response = $this->map->remove_caps();
		}

		else
		{
			$response = $this->map->remove_atlas();
		}
	}


}