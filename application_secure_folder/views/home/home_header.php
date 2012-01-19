<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="<?php echo $web_set[0]['google_webmaster_tool_verify_code']; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $web_set[0]['meta_title']; ?></title>
<meta name="title" content="<?php echo $web_set[0]['meta_title']; ?>">
<meta name="description" content="<?php echo $web_set[0]['meta_description']; ?>" />
<meta name="keywords" content="<?php echo $web_set[0]['meta_keyword']; ?>" />
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $web_set[0]['google_analytic_id']; ?>']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>
<div id="maincontainer">
<noscript> 
<div class="noscript">
<div class="noscript-inner">
<p><strong>JavaScript seem to be disabled in your browser.</strong></p>
<p>You must have JavaScript enabled in your browser to utilize the functionality of this website.</p>
</div>
</div>
</noscript>
  <!--header-->
  <div id="headingtop"><span>
    <a href="<?php echo base_url(); ?>"><div id="logo"></div></a>
    <div id="toplink">
      <ul>
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>|</li>
        <?php if(count($top_link)>0){ 
		foreach($top_link as $top_link_sin){
		?>
        <li><a href="<?php echo base_url().'content/'.$top_link_sin['slug']; ?>"><?php echo $top_link_sin['title']; ?></a></li>
        <li>|</li>
        <?php }} ?>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div id="livesupport">
    <ul>
      <?php if($this->session->userdata('logged_in')==TRUE){ ?>
      <li><a href="#"><?php echo $this->session->userdata('user_name') ?></a></li>
      <li>|</li>
      <li><a href="<?php echo base_url().'logout'; ?>">Logout</a></li>
      <?php }else{ ?>
      <li><a href="<?php echo base_url().'login'; ?>">Sign In</a></li>
      <li>|</li>
      <li><a href="<?php echo base_url().'register'; ?>">Register</a></li>
      <?php } ?>
    </ul>
  </div>
    </span></div>
  <div id="headingmid"><span>
    <div id="horoscope">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6"><img src="images/orange-left.jpg" width="6" height="30" /></td>
          <td bgcolor="#d89325"><a href="#">HOROSCOPE</a></td>
          <td width="15"><img src="images/yellow-red.jpg" width="15" height="30" /></td>
          <td bgcolor="#be0c36"><a href="#">Live Reading</a></td>
          <td width="15"><img src="images/red-pink.jpg" width="15" height="30" /></td>
          <td bgcolor="#c4216a"><a href="#">Love / Match horoscope</a></td>
          <td width="15"><img src="images/pink-blue.jpg" width="15" height="30" /></td>
          <td bgcolor="#146b93"><a href="#">work And Money</a></td>
          <td width="15"><img src="images/blue-green.jpg" width="15" height="30" /></td>
          <td bgcolor="#628131"><a href="#">Astrology report</a></td>
          <td width="6"><img src="images/green-right.jpg" width="6" height="30" /></td>
        </tr>
      </table>
    </div>
    <div id="zodiac">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6"><img src="images/zodiac-left.jpg" width="6" height="70" /></td>
          <td bgcolor="#E68616"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><a href="#">Aries</a></td>
                <td align="center"><a href="#">Taurus</a></td>
                <td align="center"><a href="#">Gemini</a></td>
                <td align="center"><a href="#">Cancer</a></td>
                <td align="center"><a href="#">Leo</a></td>
                <td align="center"><a href="#">Virgo</a></td>
                <td align="center"><a href="#">Libra</a></td>
                <td align="center"><a href="#">Scorpio</a></td>
                <td align="center"><a href="#">Sagittarius</a></td>
                <td align="center"><a href="#">Capricorn</a></td>
                <td align="center"><a href="#">Aquarius</a></td>
                <td align="center"><a href="#">Pisces</a></td>
              </tr>
              <tr>
                <td align="center"><a href="#"><img src="images/zodiac-sign1.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign2.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign3.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign4.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign5.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign6.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign7.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign8.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign9.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign10.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign11.png" width="36" height="35" /></a></td>
                <td align="center"><a href="#"><img src="images/zodiac-sign12.png" width="36" height="35" /></a></td>
              </tr>
            </table></td>
          <td width="6"><img src="images/zodiac-right.jpg" width="6" height="70" /></td>
        </tr>
      </table>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="justify"><?php echo $web_set[0]['top_left_content']; ?></td>
        <td width="50px">&nbsp;</td>
        <td align="justify"><?php echo $web_set[0]['top_right_content']; ?></td>
      </tr>
    </table>
    </span></div>
  <div id="headingbtm" style="clear:both"><span></span></div>
	<!--header end-->