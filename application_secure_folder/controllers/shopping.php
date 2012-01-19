<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shopping extends CI_Controller {
	
	function Shopping()
	{
		parent::__construct();
		$this->load->model('home_model');
		//$this->output->cache(180);
	}
	
	public function index()
	{
		$post_id=$this->uri->segment(3);
		if(!preg_match('/[1-9]/',$post_id)){
			redirect(base_url());
			exit(0);
		}
		$this->home_model->Set_sql("google_analytic_id,google_webmaster_tool_verify_code from website_info");
		$this->home_model->Set_where();
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['web_set']=$this->home_model->latest_post();
		$data['google_meta_verify']=$data['web_set'][0]['google_webmaster_tool_verify_code'];
		$data['site_title']='Shopping Cart';
		$data['meta_title']='';
		$data['meta_desc']='';
		$data['meta_keyword']='';	
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("title,slug from website_pages");
		$this->home_model->Set_where("page_status='publish' AND parent_id!='-1' AND top_links='yes'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('page_id ASC');
		$this->home_model->Set_limit();
		$data['top_link']=$this->home_model->latest_post();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("title,GROUP_CONCAT(website_pro_ser.pro_ser_id) AS pro_ser_id,GROUP_CONCAT(pro_ser_name) AS pro_ser_name,GROUP_CONCAT(pro_ser_usd) AS pro_ser_usd,GROUP_CONCAT(pro_ser_inr) AS pro_ser_inr,GROUP_CONCAT(pro_ser_slug) AS pro_ser_slug,GROUP_CONCAT(pro_ser_status) AS pro_ser_status,GROUP_CONCAT(pro_ser_type) AS pro_ser_type FROM website_pro_ser_pages LEFT JOIN website_pro_ser ON website_pro_ser_pages.pro_ser_id=website_pro_ser.pro_ser_id LEFT JOIN website_pages ON website_pro_ser_pages.page_id=website_pages.page_id");
		$this->home_model->Set_where("website_pages.page_status='publish' AND pro_ser_status='active'");
		$this->home_model->Set_groupby("website_pro_ser_pages.page_id");
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['shopping_data']=$this->home_model->latest_post();
		$data['shopp_data_id']=$post_id;
		$this->load->view('public/content_header',$data);
		$this->load->view("shopping/content_index",$data);
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