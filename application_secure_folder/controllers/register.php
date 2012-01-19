<?php
class Register extends CI_Controller {

	function Register()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
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
		$data['site_title']='Member Registration - '.$data['web_set'][0]['website_title'];
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
		if(trim($submitted)!=''){
			$name=$this->input->post('name');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$password2=$this->input->post('password2');
			$star_sign=$this->input->post('star_sign');
			$phone_no=$this->input->post('phone_no');
			$gender=$this->input->post('gender');
			$birth_day_sel=$this->input->post('birth_day_sel');
			$birth_month_sel=$this->input->post('birth_month_sel');
			$birth_year_sel=$this->input->post('birth_year_sel');
			$birth_hour_time=$this->input->post('birth_hour_time');
			$birth_min_time=$this->input->post('birth_min_time');
			$birth_sec_time=$this->input->post('birth_sec_time');
			$country=$this->input->post('country');
			$state=$this->input->post('state');
			$city=$this->input->post('city');
			$address=$this->input->post('address');
			
			$password=sha1($password);
			$birthday=$birth_year_sel.'-'.$birth_month_sel.'-'.$birth_day_sel;
			$birthtime=$birth_hour_time.':'.$birth_min_time.':'.$birth_sec_time;
			$time=time();
			$sql_register="insert into astro_user set email='$email',name='$name',password='$password',birth_day='$birthday',birth_time='$birthtime',star_sign='$star_sign',gender='$gender',phone='$phone_no',address='$address',country='$country',state='$state',city='$city',registration_date=".$time;
			if($this->home_model->sql_query($sql_register)){
				$this->home_model->Set_free_where();
				$this->home_model->Set_sql("user_id,email,name,password,status from astro_user");
				$this->home_model->Set_orderby();
				$this->home_model->Set_where("email='".$email."' and password='".$password."'");
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
					$this->session->set_flashdata("msg_set","<div class='ok_message'>You have registered successfully, and you may begin using the site!</div>");
					$shopp_session_data=$this->session->userdata('shopp_session_data');
					if($shopp_session_data!=''){
						redirect('orders/billing');
						exit(0);
					}
					redirect(base_url());
					exit(0);
				}
			}else{
				$error_msg['error']="<div class='error_message'>There is something database error occured.Try to submit again.</div>";				
			}
		}
		$this->load->view("register/content_index",$error_msg);
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