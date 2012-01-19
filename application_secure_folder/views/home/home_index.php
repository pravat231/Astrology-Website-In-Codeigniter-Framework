<!--leftcontent-->
<div id="leftcontainer">
  <div id="lefttop"><span></span></div>
  <div id="leftmid"><span>
    <h1>Our Premium Services</h1>
    <?php echo $web_set[0]['bottom_left_content']; ?><br />
    <img src="images/left-banner1.png" />
    <?php if(count($post_pages[0])>0){foreach($post_pages[0] as $post_val){ ?>
    <h2><?php echo $post_val['title']; ?></h2>
    <div style="float:right;"><img src="<?php echo base_url(); ?>page_image/<?php echo ($post_val['img_link']!=NULL)?$post_val['img_link']:'default_image'; ?>.jpg" alt="<?php echo $post_val['img_alt']; ?>" /></div>
    <div id="left_mid"><?php echo $post_val['intro']; ?></div>
    <div style="clear:both; height:20px;">&nbsp;</div>
    <a href="<?php echo base_url(); ?>content/<?php echo $post_val['slug']; ?>"><span>more...</span></a> <br />
    <br />
    <?php }} ?>
    </span></div>
  <div id="leftbtm"><span></span></div>
</div>
<!--leftcontent end-->
<!--rightcontent-->
<div id="rightcontainer">
  <div id="righttop"><span></span></div>
  <div id="rightmid"><span>
    <h1>Our Premium Products</h1>
    <?php echo $web_set[0]['bottom_right_content']; ?><br />
    <img src="images/left-banner1.png" />
    <?php if(count($post_pages[1])>0){foreach($post_pages[1] as $post_val){ ?>
    <h2><?php echo $post_val['title']; ?></h2>
    <div style="float:right;"><img src="<?php echo base_url(); ?>page_image/<?php echo ($post_val['img_link']!=NULL)?$post_val['img_link']:'default_image'; ?>.jpg" alt="<?php echo $post_val['img_alt']; ?>" /></div>
    <div id="left_mid"><?php echo $post_val['intro']; ?></div>
    <div style="clear:both; height:20px;">&nbsp;</div>
    <a href="<?php echo base_url(); ?>content/<?php echo $post_val['slug']; ?>"><span>more...</span></a> <br />
    <br />
    <?php }} ?>
    </span></div>
  <div id="rightbtm"><span></span></div>
</div>
<!--rightcontent end-->