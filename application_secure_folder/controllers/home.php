<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	function Home()
	{
		parent::__construct();
		$this->load->model('home_model');
		//$this->output->cache(180);
	}
	
	public function index()
	{
		$this->home_model->Set_sql("* from website_info");
		$this->home_model->Set_where();
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$header_data['web_set']=$this->home_model->latest_post();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("title,slug from website_pages");
		$this->home_model->Set_where("page_status='publish' AND parent_id!='-1' AND top_links='yes'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('page_id ASC');
		$this->home_model->Set_limit();
		$header_data['top_link']=$this->home_model->latest_post();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("page_id,title,intro,slug,img_link,img_alt from website_pages");
		$this->home_model->Set_where("page_status='publish' AND show_in_home='yes'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('page_id DESC');
		$this->home_model->Set_limit();
		$header_data['post_pages']=$this->home_model->latest_post();
		$count=count($header_data['post_pages']);
		$count=ceil($count/2);
		$header_data['post_pages']=array_chunk($header_data['post_pages'],$count,true);
		$this->load->view('home/home_header',$header_data);
		$this->load->view('home/home_index',$header_data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$header_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$header_data);		
	}
}