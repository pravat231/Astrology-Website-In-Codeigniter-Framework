<!--leftcontent-->
<div id="innerleftcontainer">
<div id="lefttop"><span></span></div>
<div id="innerleftmid"><span>
<img src="<?php echo base_url(); ?>images/quick_order.jpg" />
&nbsp;
</span>
</div>
<div id="leftbtm"><span></span></div>
</div>
<!--leftcontent end-->

<!--content-->
<div id="innercontainer_3">
<div id="righttop"><span></span></div>
<div id="innerrightmid"><span>
<div style="text-align:justify">
<h1><?php echo $post_pages[0]['pro_ser_name']; ?></h1>
<?php if(!empty($post_pages[0]['pro_ser_img'])){ ?>
<center><img width="160px" height="160px" border="0" src="<?php echo base_url(); ?>pro_ser_image/<?php echo $post_pages[0]['pro_ser_img']; ?>.jpg" style="padding:0px" /></center><br />
<?php } ?>
<?php echo $post_pages[0]['pro_ser_desc']; ?>
</div>
<div style="width:150px; float:left"><h3 style="color:#000">$<?php print $post_pages[0]['pro_ser_usd']; ?> <font style="color:#F00">/</font> Rs.<?php print $post_pages[0]['pro_ser_inr']; ?></h3></div>
<div style="float:right; width:140px;"><a href="<?php echo base_url(); ?>shopping/product_id/<?php echo $post_pages[0]['pro_ser_id']; ?>" style="background:none"><img height="34px" width="125px" border="0" src="<?php echo base_url(); ?>images/order_now.jpg" style="padding:0px; margin-left:15px; cursor:pointer" /></a></div>
<div class="clear">&nbsp;</div>
<?php if(count($product_data)>0){ ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:30px">
    <tr>
        <td style="font-size:18px; font-weight:bold" align="center">Similar Products</td>
    </tr>
    <tr>
        <td><hr /></td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" align="center">
  	<?php foreach($product_data as $single_product_data){ ?>
	<tr>
	<td><table cellpadding="0" cellspacing="0" border="0">
		<tr>
		  <td id="table_header_left">&nbsp;</td>
		  <td width="319px" height="8" bgcolor="#ece8ed" id="table_header"><?php echo substr($single_product_data['pro_ser_name'],0,40); ?></td>
		  <td id="table_header_right">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="3" id="table_mid" height="100px" valign="top">
		<table cellpadding="0" cellspacing="0"  border="0">
			  <tr>
				<td align="left" width="96" height="84"><img height="84" width="96" title="<?php echo $single_product_data['pro_ser_name']; ?>" alt="<?php echo $single_product_data['img_alt']; ?>" src="<?php echo base_url(); ?>pro_ser_image/<?php echo ($single_product_data['pro_ser_img']!=NULL)?$single_product_data['pro_ser_img']:'default_image'; ?>.jpg" style="padding:2px"></td>
				<td align="justify" width="215px" style="padding:5px"><?php echo substr($single_product_data['pro_ser_intro'],0,130).'..'; ?></td>
			  </tr>
			  <tr>
			  <td colspan="2" align="right"><div id="product_service" style="float:right; margin:-5px -10px -10px 0px;"><a href="<?php echo base_url().'products/'.$single_product_data['pro_ser_slug']; ?>"><span>Know More</span></a></div></td>
			  </tr>
		 </table>
		 </td>
		 </tr>
		<tr>
		  <td colspan="3" id="table_header_bottom">&nbsp;</td>
		</tr>
	  </table></td>
	</tr>
	<?php } ?>        
  </tr>
</table>
<?php } ?>
</span></div>
<div id="rightbtm"><span></span></div>
</div>
<!--content end-->
<!--rightcontent-->
<div id="innerrightcontainer">
<div id="lefttop"><span></span></div>
<div id="innerleftmid"><span>
<img src="<?php echo base_url(); ?>images/ads.jpg" width="210px" height="600px" />
</span>
</div>
<div id="leftbtm"><span></span></div>
</div>
<!--rightcontent end-->