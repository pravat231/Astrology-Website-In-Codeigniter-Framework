<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
	
	function Login()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			redirect(base_url());
			exit(0);
		}
		$this->home_model->Set_sql("* from website_info");
		$this->home_model->Set_where();
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['web_set']=$this->home_model->latest_post();
		$data['google_meta_verify']=$data['web_set'][0]['google_webmaster_tool_verify_code'];
		$data['site_title']='Member Login - '.$data['web_set'][0]['website_title'];
		$data['meta_title']=$data['web_set'][0]['meta_title'];
		$data['meta_desc']=$data['web_set'][0]['meta_description'];
		$data['meta_keyword']=$data['web_set'][0]['meta_keyword'];
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("title,slug from website_pages");
		$this->home_model->Set_where("page_status='publish' AND parent_id!='-1' AND top_links='yes'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('page_id ASC');
		$this->home_model->Set_limit();
		$data['top_link']=$this->home_model->latest_post();
		$this->load->view('public/content_header',$data);
		$submitted=$this->input->post('submit');
		$error_msg['error']='';
		if(trim($submitted)!='')
		{
			$post_username=$this->input->post('email');
			$post_password=$this->input->post('password');
			$post_password=sha1($post_password);
			$this->home_model->Set_free_where();	
			$this->home_model->Set_sql("user_id,email,name,password,status from astro_user");
			$this->home_model->Set_orderby();
			$this->home_model->Set_where("email='".$post_username."' and password='".$post_password."'");
			$this->home_model->Set_limit('0,1');
			$result_login=$this->home_model->latest_post();
			if(count($result_login)>0){ 
				$data = array(
							'logged_in'=>TRUE,
							'user_name'=>$result_login[0]['name'],
							'user_email'=>$result_login[0]['email'],
							'user_id'=>$result_login[0]['user_id']
						);
				$this->session->set_userdata($data);
				$sql_instant="update astro_user set status='ACTIVE' where user_id='".$result_login[0]['user_id']."'";
				$this->home_model->sql_query($sql_instant);
				$shopp_session_data=$this->session->userdata('shopp_session_data');
				if($shopp_session_data!=''){
					redirect('orders/billing');
					exit(0);
				}
				redirect(base_url());
				exit(0);
			}else{
				$error_msg['error']='<div id="notification_error">The login info is not correct.</div>';
			}		
		}		
		$this->load->view("login/content_index",$error_msg);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
}