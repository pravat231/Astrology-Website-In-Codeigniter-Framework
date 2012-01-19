<!--leftcontent-->
<div id="innerleftcontainer">
  <div id="lefttop"><span></span></div>
  <div id="innerleftmid"><span> <img src="<?php echo base_url(); ?>images/quick_order.jpg" /> <?php echo $list_pages; ?> </span> </div>
  <div id="leftbtm"><span></span></div>
</div>
<!--leftcontent end-->
<!--rightcontent-->
<div id="innercontainer">
  <div id="righttop"><span></span></div>
  <div id="innerrightmid"><span>
    <div style="text-align:justify">
      <h1><?php echo $post_pages[0]['title']; ?></h1>
      <?php echo $post_pages[0]['content']; ?> </div>
    <?php if(count($service_data)>0){ ?>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
      <tbody>
        <tr>
          <td width="6" height="8"><img height="8px" width="6px" src="<?php echo base_url(); ?>images/left_top_corner.jpg" style="padding:0px"></td>
          <td width="683" height="8" bgcolor="#E68616" style="line-height:0px">&nbsp;</td>
          <td width="6" height="8"><img height="8px" width="6px" src="<?php echo base_url(); ?>images/right_top_corner.jpg" style="padding:0px"></td>
        </tr>
        <tr>
          <td bgcolor="#E68616" colspan="3"><table cellpadding="0" cellspacing="0" border="0" width="95%" align="center">
              <?php $i=1; foreach($service_data as $single_service_data){ ?>
              <?php if(($i%2)==0){ ?>
              <tr>
                <td colspan="4"><hr /></td>
              </tr>
              <?php } ?>
              <tr>
                <td align="left"><h3 style="color:#FFF"><?php echo $single_service_data['pro_ser_name']; ?></h3></td>
                <td align="right"><h3 style="color:#000">$<?php echo $single_service_data['pro_ser_usd']; ?> <font style="color:#F00">/</font> Rs.<?php echo $single_service_data['pro_ser_inr']; ?></h3></td>
                <td width="130px" align="right"><span id="product_service"><a href="<?php echo base_url().'services/'.$single_service_data['pro_ser_slug']; ?>"><span>View Sample</span></a></span></td>
                <td width="100px" align="right"><span id="product_service"><a href="<?php echo base_url(); ?>shopping/service_id/<?php echo $single_service_data['pro_ser_id']; ?>"><span>Buy Now</span></a></span></td>
              </tr>
              <?php $i++;} ?>
            </table></td>
        </tr>
        <tr>
          <td><img height="8px" width="6px" border="0" src="<?php echo base_url(); ?>images/left_bottom_corner.jpg" style="padding:0px"></td>
          <td width="683" height="8" bgcolor="#E68616" style="line-height:0px">&nbsp;</td>
          <td><img height="8px" width="6px" border="0" src="<?php echo base_url(); ?>images/right_bottom_corner.jpg" style="padding:0px"></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
    <?php if(count($product_data)>0){ ?>
    <table cellpadding="0" cellspacing="0" border="0"  style="margin-top:20px">
      <tr>
      	<?php $i=1; foreach($product_data as $single_product_data){ ?>
		<?php if(($i%2)==0){ ?>
        <td width="33px">&nbsp;</td>
        <?php } ?>
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
		<?php if(($i%2)==0){ ?>
        </tr><tr>
        <?php } ?>
        <?php $i++;} ?>        
      </tr>
    </table>
    <?php } ?>
    </span>
  </div>
  <div id="rightbtm"><span></span></div>
</div>
<!--rightcontent end-->
