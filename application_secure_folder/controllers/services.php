<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller {
	
	function Services()
	{
		parent::__construct();
		$this->load->model('home_model');
		//$this->output->cache(180);
	}
	
	public function index()
	{
		$watch_url=$this->uri->segment(2);
		if(!preg_match('/[0-9a-zA-Z]/',$watch_url)){
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
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("title,slug from website_pages");
		$this->home_model->Set_where("page_status='publish' AND parent_id!='-1' AND top_links='yes'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('page_id ASC');
		$this->home_model->Set_limit();
		$data['top_link']=$this->home_model->latest_post();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_id,pro_ser_name,pro_ser_desc,pro_ser_usd,pro_ser_inr,pro_ser_img,meta_title,meta_desc,meta_keyword,img_alt,design_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_slug='".$watch_url."' AND pro_ser_type='service' AND pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['post_pages']=$this->home_model->latest_post();
		$data['site_title']=$data['post_pages'][0]['pro_ser_name'];
		$data['meta_title']=$data['post_pages'][0]['meta_title'];
		$data['meta_desc']=$data['post_pages'][0]['meta_desc'];
		$data['meta_keyword']=$data['post_pages'][0]['meta_keyword'];	
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("page_id from website_pro_ser_pages");
		$this->home_model->Set_where("pro_ser_id='".$data['post_pages'][0]['pro_ser_id']."'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['single_fetch_data']=$this->home_model->latest_post();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("website_pro_ser.pro_ser_id,pro_ser_name,pro_ser_usd,pro_ser_inr,pro_ser_slug FROM website_pro_ser LEFT JOIN website_pro_ser_pages ON website_pro_ser_pages.pro_ser_id=website_pro_ser.pro_ser_id");
		$this->home_model->Set_where("website_pro_ser_pages.page_id='".$data['single_fetch_data'][0]['page_id']."' AND pro_ser_status='active' AND pro_ser_type='service' AND website_pro_ser_pages.pro_ser_id!='".$data['post_pages'][0]['pro_ser_id']."'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['service_data']=$this->home_model->latest_post();
		$this->load->view('public/content_header',$data);
		$this->load->view("service/content_index_".$data['post_pages'][0]['design_type'],$data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
	
	function list_pages($parent_id=-1,&$data=NULL,$level=0){
		global $pre_parent;
		if(!$data) $data='';
		$parent_id = (int)$parent_id;
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("page_id,title,slug FROM website_pages");
		$this->home_model->Set_where("parent_id='".$parent_id."' AND page_status='publish'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$post_pages=$this->home_model->latest_post();
		if(count($post_pages)==0) return;
		if($level==0){
			$data.='<ul class="menu">';
		}else{
			$data.='<ul class="acitem">';
		}
		foreach($post_pages as $val){
			if($level==0){
				if($pre_parent==$val['page_id']){
					$data.='<li class="expand"><a href="'.base_url().'content/'.$val['slug'].'">'.$val['title'].'</a>';
				}else{
					$data.='<li><a href="'.base_url().'content/'.$val['slug'].'">'.$val['title'].'</a>';
				}
			}else{
			   $data.='<li><a href="'.base_url().'content/'.$val['slug'].'">'.$val['title'].'</a>';
			}
			$this->list_pages($val['page_id'],$data,$level+1);
			$data.='</li>';
		}
		$data.='</ul>';
		return $data;
	}
}