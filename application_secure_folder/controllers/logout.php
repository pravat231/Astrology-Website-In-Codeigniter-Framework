<?php
class Logout extends CI_Controller {

	function Logout()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if(($this->session->userdata('logged_in')==TRUE) || ($this->session->userdata('user_id')!=''))
		{
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_name');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('shopp_session_data');
			redirect(base_url());
			exit(0);
		}
		else
		{
			redirect(base_url());
			exit(0);
		}
	}
}