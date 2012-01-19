<?php
class Reset_password extends CI_Controller {

	function Reset_password()
	{
		parent::__construct();
		$this->load->model('setting_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			redirect(base_url());
			exit(0);
		}
		if($this->uri->segment(3)=='')
		{
			redirect(base_url());
			exit(0);
		}
		$data['site_title']='Watch Movies Online - Full Movies Online -Go4film.com - Free Movies Online Reset Password';
		$this->load->view('header',$data);
		$this->setting_model->Set_free_where();	
		$this->setting_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->setting_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->setting_model->latest_post();
		$this->load->view('sidebar',$sidebar);
		$this->load->view('home_before_login/search_box');
		$this->db->cache_off();
		$this->load->model('user_model');
		$check=$this->user_model->check_reset_password_code($this->uri->segment(3));
		if($check===TRUE)
		{
			$data['error']='';
			$this->form_validation->set_rules('password','New password','trim|required|min_length[5]|matches[password_conf]');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('user/reset_password',$data);
			}
			else
			{
				if($this->user_model->change_password(sha1($this->input->post('password')),$this->uri->segment(3)))
				{
					$data['error']='<div class="ok_message">Your password has been reset.</div>';
					$this->load->view('user/reset_password',$data);
				}
				else
				{
					$data['error']='Error occured during reset try again later';				
					$this->load->view('user/reset_password',$data);			
				}
			}
		}
		else if($check=='Expired')
		{
			$data['error']='<div class="error_message">Reset link already expired, Try again.</div>';
			$this->load->view('user/reset_password',$data);
		}
		else
		{
			$data['error']='<div class="error_message">You have followed an invalid link. Please try again.</div>';
			$this->load->view('user/reset_password',$data);
		}
		$this->load->view('footer');
	}
}
		