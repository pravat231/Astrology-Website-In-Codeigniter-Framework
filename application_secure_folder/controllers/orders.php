<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends CI_Controller {
	
	function Orders()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	public function Index()
	{
		redirect(base_url());
		exit(0);
	}
	
	public function Add_cart()
	{
		$shop_element=$this->input->post('shopping_element');
		if(!preg_match('/[1-9]/',$shop_element)){
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
		$this->home_model->Set_sql("pro_ser_id,pro_ser_name,pro_ser_usd,pro_ser_inr,pro_ser_slug,pro_ser_img,pro_ser_status FROM website_pro_ser");
		$this->home_model->Set_where("pro_ser_id IN(".$shop_element.") AND pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['shopping_data']=$this->home_model->latest_post();
		$data['shop_ele_id']=$shop_element;
		$this->session->set_userdata('shopp_session_data',$shop_element);
		$this->load->view('public/content_header',$data);
		$this->load->view("order/product_cart_index",$data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
	
	public function Billing()
	{
		$shop_element=$this->session->userdata('shopp_session_data');
		if(!preg_match('/[1-9]/',$shop_element)){
			redirect(base_url());
			exit(0);
		}
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login');
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
		$this->home_model->Set_sql("user_id,email,name,phone,address,country,state,city from astro_user");
		$user_id=$this->session->userdata('user_id');
		$this->home_model->Set_where("user_id='".$user_id."'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['billing_data']=$this->home_model->latest_post();
		$this->load->view('public/content_header',$data);
		$this->load->view("order/cart_billing_index",$data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
	
	public function Shipping()
	{
		$shop_element=$this->session->userdata('shopp_session_data');
		if(!preg_match('/[1-9]/',$shop_element)){
			redirect(base_url());
			exit(0);
		}
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login');
			exit(0);
		}
		$bill_authen=$this->input->post('bill_form_authen');
		if($bill_authen=='billing_info'){
			$this->session->set_userdata('shop_billing_info',$_POST);
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
		$this->home_model->Set_sql("user_id,email,name,phone,address,country,state,city from astro_user");
		$user_id=$this->session->userdata('user_id');
		$this->home_model->Set_where("user_id='".$user_id."'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['billing_data']=$this->home_model->latest_post();
		$data['shop_ele_id']=$shop_element;
		$this->load->view('public/content_header',$data);
		$this->load->view("order/cart_shipping_index",$data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
	
	public function Payment()
	{
		$shop_element=$this->session->userdata('shopp_session_data');
		if(!preg_match('/[1-9]/',$shop_element)){
			redirect(base_url());
			exit(0);
		}
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login');
			exit(0);
		}
		$shipp_authen=$this->input->post('shipp_form_authen');
		if($shipp_authen=='shipping_info'){
			$this->session->set_userdata('shop_shipping_info',$_POST);
		}
		$bill_authen=$this->input->post('bill_form_authen');
		if($bill_authen=='billing_info'){
			$this->session->set_userdata('shop_billing_info',$_POST);
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
		$this->home_model->Set_sql("pro_ser_id,pro_ser_name,pro_ser_usd,pro_ser_inr,pro_ser_slug,pro_ser_img,pro_ser_status FROM website_pro_ser");
		$this->home_model->Set_where("pro_ser_id IN(".$shop_element.") AND pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit();
		$data['shopping_data']=$this->home_model->latest_post();
		$this->load->view('public/content_header',$data);
		$this->load->view("order/cart_payment_index",$data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("pro_ser_name,pro_ser_slug,footer_menu_id,pro_ser_type from website_pro_ser");
		$this->home_model->Set_where("pro_ser_status='active'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('pro_ser_id ASC');
		$this->home_model->Set_limit();
		$footer_data['footer_link']=$this->home_model->latest_post();
		$this->load->view('public/content_footer',$footer_data);
	}
	
	public function Expresscheckout()
	{
		$shop_element=$this->session->userdata('shopp_session_data');
		if(!preg_match('/[1-9]/',$shop_element)){
			redirect(base_url());
			exit(0);
		}
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login');
			exit(0);
		}
		$this->load->library('paypal');
		$shipping_data=$this->session->userdata('shop_shipping_info');
		if($shipping_data=='')
		{
			$billing_data=$this->session->userdata('shop_billing_info');
			$shipToName=$billing_data['billing_name'];
			$shipToStreet=$billing_data['billing_address'];
			$shipToCity=$billing_data['billing_city'];
			$shipToState=$billing_data['billing_state'];
			$shipToZip=$billing_data['billing_postal'];
			$phoneNum=$billing_data['billing_phone'];
		}
		else
		{
			$shipToName=$shipping_data['shipping_name'];
			$shipToStreet=$shipping_data['shipping_address'];
			$shipToCity=$shipping_data['shipping_city'];
			$shipToState=$shipping_data['shipping_state'];
			$shipToZip=$shipping_data['shipping_postal'];
			$phoneNum=$shipping_data['shipping_phone'];
		}
		$currencyCodeType = "USD";
		$paymentType = "Sale";
		$returnURL = "http://www.astro.go4film.com/confirm.php";
		$cancelURL = "http://www.astro.go4film.com/cart.php";
		$shipToCountryCode='IN';
		$shipToStreet2='';
		$paymentAmount = $this->session->userdata('shopp_total_usd');
		$shipToEmail=$this->session->userdata('user_email');
		$resArray = $this->paypal->CallMarkExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $shipToName, $shipToStreet, $shipToCity,$shipToState,$shipToCountryCode, $shipToZip, $shipToStreet2, $phoneNum, $shipToEmail);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING"){
			$this->paypal->RedirectToPayPal( $resArray["TOKEN"] );
			exit(0);
		}else{
			$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		}
	}
	
	function ccavenue()
	{
		$shop_element=$this->session->userdata('shopp_session_data');
		if(!preg_match('/[1-9]/',$shop_element)){
			redirect(base_url());
			exit(0);
		}
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('login');
			exit(0);
		}
		$this->load->library('ccavenue');
		$shipping_data=$this->session->userdata('shop_shipping_info');
		if($shipping_data=='')
		{
			$billing_data=$this->session->userdata('shop_billing_info');
			
			$data['billing_cust_name']=$billing_data['billing_name'];
			$data['billing_cust_address']=$billing_data['billing_address'];
			$data['billing_cust_country']=$billing_data['billing_country'];
			$data['billing_cust_state']=$billing_data['billing_state'];
			$data['billing_zip']=$billing_data['billing_postal'];
			$data['billing_cust_tel']=$billing_data['billing_phone'];
			$data['billing_cust_email']=$this->session->userdata('user_email');
			$data['billing_cust_city']=$billing_data['billing_city'];
			$data['billing_zip_code']=$billing_data['billing_postal'];
			$data['delivery_cust_name']=$billing_data['billing_name'];
			$data['delivery_cust_address']=$billing_data['billing_address'];
			$data['delivery_cust_country']=$billing_data['billing_country'];
			$data['delivery_cust_state']=$billing_data['billing_state'];
			$data['delivery_cust_tel']=$billing_data['billing_phone'];
			$data['delivery_cust_notes']='';
			$data['delivery_cust_city']=$billing_data['billing_city'];
			$data['delivery_zip_code']=$billing_data['billing_postal'];
		}
		else
		{
			$billing_data=$this->session->userdata('shop_billing_info');
			
			$data['billing_cust_name']=$billing_data['billing_name'];
			$data['billing_cust_address']=$billing_data['billing_address'];
			$data['billing_cust_country']=$billing_data['billing_country'];
			$data['billing_cust_state']=$billing_data['billing_state'];
			$data['billing_zip']=$billing_data['billing_postal'];
			$data['billing_cust_tel']=$billing_data['billing_phone'];
			$data['billing_cust_email']=$this->session->userdata('user_email');
			$data['billing_cust_city']=$billing_data['billing_city'];
			$data['billing_zip_code']=$billing_data['billing_postal'];
			$data['delivery_cust_name']=$shipping_data['shipping_name'];
			$data['delivery_cust_address']=$shipping_data['shipping_address'];
			$data['delivery_cust_country']=$shipping_data['shipping_country'];
			$data['delivery_cust_state']=$shipping_data['shipping_state'];
			$data['delivery_cust_tel']=$shipping_data['shipping_phone'];
			$data['delivery_cust_notes']='';
			$data['delivery_cust_city']=$shipping_data['shipping_city'];
			$data['delivery_zip_code']=$shipping_data['shipping_postal'];
		}
		$data['Merchant_Id']='M_mprusty_11000';
		$data['WorkingKey']='nljjre6fcsomr7485j';
		$stamp = strtotime("now").$this->input->ip_address();
		$data['Order_Id'] = str_replace(".", "", $stamp);
		$data['Amount']=$this->session->userdata('shopp_total_inr');
		$data['Redirect_Url']='http://www.astro.go4film.com/confirm.php';
		$data['Checksum']=$this->ccavenue->getCheckSum($data['Merchant_Id'],$data['Amount'],$data['Order_Id'] ,$data['Redirect_Url'],$data['WorkingKey']);
		$this->load->view("order/ccavenue_order_page",$data);
	}
}