<!--content-->
<div id="single_innercontainer">
<div id="righttop"><span></span></div>
<div id="innerrightmid"><span>
<?php if(!empty($post_pages[0]['pro_ser_img'])){ ?>
<img height="300px" width="930px" border="0" src="<?php echo base_url(); ?>pro_ser_image/<?php echo $post_pages[0]['pro_ser_img']; ?>.jpg" style="padding:0px" />
<?php } ?>
<div style="text-align:justify">
<h1><?php echo $post_pages[0]['pro_ser_name']; ?></h1>
<?php echo $post_pages[0]['pro_ser_desc']; ?>
</div>
<div style="width:150px; float:left"><h3 style="color:#000">$<?php print $post_pages[0]['pro_ser_usd']; ?> <font style="color:#F00">/</font> Rs.<?php print $post_pages[0]['pro_ser_inr']; ?></h3></div>
<div style="float:right; width:140px;"><a href="<?php echo base_url(); ?>shopping/service_id/<?php echo $post_pages[0]['pro_ser_id']; ?>" style="background:none"><img height="34px" width="125px" border="0" src="<?php echo base_url(); ?>images/order_now.jpg" style="padding:0px; margin-left:15px; cursor:pointer" /></a></div>
<div class="clear">&nbsp;</div>
<?php if(count($service_data)>0){ ?>
<table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:30px">
<tbody>
	<tr>
    <td colspan="3" style="font-size:18px; font-weight:bold" align="center">Similar Services</td>
    </tr>
    <tr>
    <td colspan="3"><hr /></td>
    </tr>
	<tr>
    <td width="6" height="8"><img height="8px" width="6px" src="<?php echo base_url(); ?>images/left_top_corner.jpg" style="padding:0px"></td>
    <td width="917" height="8" bgcolor="#E68616" style="line-height:0px">&nbsp;</td>
    <td width="6" height="8"><img height="8px" width="6px" src="<?php echo base_url(); ?>images/right_top_corner.jpg" style="padding:0px"></td>
    </tr>
	<tr>
    <td bgcolor="#E68616" colspan="3">
        <table cellpadding="0" cellspacing="0" border="0" width="95%" align="center">
        	<?php $i=1; foreach($service_data as $single_service_data){ ?>
            <?php if(($i%2)==0){ ?>
            <tr><td colspan="4"><hr /></td></tr>
            <?php } ?>
        	<tr>
            <td align="left"><h3 style="color:#FFF"><?php echo $single_service_data['pro_ser_name']; ?></h3></td>
            <td align="right"><h3 style="color:#000">$<?php echo $single_service_data['pro_ser_usd']; ?> <font style="color:#F00">/</font> Rs.<?php echo $single_service_data['pro_ser_inr']; ?></h3></td>
            <td width="130px" align="right"><span id="product_service"><a href="<?php echo base_url().'services/'.$single_service_data['pro_ser_slug']; ?>"><span>View Sample</span></a></span></td>
            <td width="100px" align="right"><span id="product_service"><a href="<?php echo base_url(); ?>shopping/service_id/<?php echo $single_service_data['pro_ser_id']; ?>"><span>Buy Now</span></a></span></td>
            </tr>
            <?php $i++;} ?>
        </table>
    </td>
    </tr>
    <tr>
    <td><img height="8px" width="6px" src="<?php echo base_url(); ?>images/left_bottom_corner.jpg" style="padding:0px"></td>
    <td width="917" height="8" bgcolor="#E68616" style="line-height:0px">&nbsp;</td>
    <td><img height="8px" width="6px" src="<?php echo base_url(); ?>images/right_bottom_corner.jpg" style="padding:0px"></td>
    </tr>
</tbody>
</table>
<?php } ?>
</span></div>
<div id="rightbtm"><span></span></div>
</div>
<!--content end-->