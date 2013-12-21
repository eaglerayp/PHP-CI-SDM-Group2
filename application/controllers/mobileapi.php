<?php

class MobileAPI extends CI_Controller {

	public function index()
	{
		redirect('/welcome/', 'location');
		redirect(site_url("/"));
	}

	public function getUserData()
	{

		$username = trim($this->input->post("name"));
		$this->load->model("mobilemodel");
		$userProfile = $this->mobilemodel->getPhoneNum($username);

		$formatProfile = array('name' => $userProfile->username, 'id' => $userProfile->userid, 'phone' => $userProfile->phone);

		echo json_encode($formatProfile);

		/* for testing: "curl -d "name=b" http://localhost:8888/Group2/index.php/mobileapi/getUserData" */
	}
}
?>