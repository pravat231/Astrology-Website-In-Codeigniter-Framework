<div id="footercontent">
<?php if(count($footer_link)>0){
$footer1='';
$footer2='';
$footer3='';
$footer4='';
foreach($footer_link as $footer_url){
	switch($footer_url['footer_menu_id']){
		case 1:
			if($footer_url['pro_ser_type']=='product'){
				$footer1.='<li><a href="'.base_url().'products/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}else{
				$footer1.='<li><a href="'.base_url().'services/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}		
		break;
		case 2:
			if($footer_url['pro_ser_type']=='product'){
				$footer2.='<li><a href="'.base_url().'products/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}else{
				$footer2.='<li><a href="'.base_url().'services/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}
		break;
		case 3:
			if($footer_url['pro_ser_type']=='product'){
				$footer3.='<li><a href="'.base_url().'products/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}else{
				$footer3.='<li><a href="'.base_url().'services/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}
		break;
		case 4:
			if($footer_url['pro_ser_type']=='product'){
				$footer4.='<li><a href="'.base_url().'products/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}else{
				$footer4.='<li><a href="'.base_url().'services/'.$footer_url['pro_ser_slug'].'">'.$footer_url['pro_ser_name'].'</a></li>';
			}
		break;		
	}
}
?>
<div>
<ul>
<h1>Astrology</h1>
<?php echo $footer1; ?>
</ul>
<ul>
<h1>Astrologers</h1>
<?php echo $footer2; ?>
</ul>
<ul>
<h1>Reports</h1>
<?php echo $footer3; ?>
</ul>
<ul>
<h1>More on Astrology</h1>
<?php echo $footer4; ?>
</ul>
</div>
<?php } ?>
</div>
<!--footer-->
<div id="footercontainer"><span>Copyright &copy; 2001-2011, your company</span><br />
All transactions on our web site conducted on Secure SSL Site<br />
Our vedic astrology experts follow the principles of Vedic System which is the most unique, accurate and detailed of all predictive/divination systems prevalent in the world and originated out of India around
7000 years ago. We require your DATE, TIME & PLACE OF BIRTH to send you a horoscope reading.</div>
<!--footer end-->
</div>
</body>
</html>