<script type="text/javascript">
function div(d){
    return document.getElementById(d);
}
function change(obj) {
	var div=obj.parentNode.parentNode.parentNode; // this may change depending on the html used
	div.style.backgroundColor=(obj.checked)? '#FAC5D6' : 'white';
	if(obj.checked){
		add_recipient(obj.value);
	}else{
		remove_recipient(obj.value);
	}
}
function add_recipient(recipient){
	var recipient_list = new Array();
	if(div('shopping_element').value != '')
	  recipient_list = div('shopping_element').value.split(',');
	else
	  recipient_list = [];
	var recipient_exists = false;
	for(i=0; i<recipient_list.length; i++){
		if(recipient_list[i] == recipient){
			recipient_exists = true;
		}
	}
	if(!recipient_exists) {
	  recipient_list.push(recipient);
	}
	div('shopping_element').value = recipient_list.join();
}
function remove_recipient(recipient){
	var recipient_list = new Array();
	recipient_list = div('shopping_element').value.split(',');
	for(i=0; i<recipient_list.length; i++){
		if (recipient_list[i] == recipient){
			recipient_list.splice(i,1);
			break;
		}
	}
	div('shopping_element').value = recipient_list.join();
}
function check_product(){
	var shop_list=div('shopping_element').value;
	if(shop_list==''){
		alert('Please select atleast one product or service');
		return false;
	}else{
		return true;
	}
}
</script>
<!--content-->
<div id="single_innercontainer">
<div id="righttop"><span></span></div>
<div id="innerrightmid"><span>
<style type="text/css">
#innerrightmid span {
	margin-left: 5px;
	padding-right: 0px;
}
#innerrightmid span div {
	padding: 0px;
}
#innerrightmid span .WebRupee{
	background:none;
    font-family: 'WebRupee';
}
#innerrightmid span .check-pink{
	background:none;
}
</style>
<div style="text-align:justify;padding-left:3px; min-height:200px;">
<?php
$total_data=count($shopping_data);
if($total_data>0){
	$half=ceil($total_data/2);
?>
<div class="tabs-width">
  <!--Lite and dark pink box-->
  <div class="step-box-lite" style="padding-top:10px;">Step 1<br>
    (List of Products)</div>
  <div class="step-box-dark">Step 2<br>
    (Products in Cart)</div>
  <div class="step-box-dark">Step 3<br>
    (Billing Details)</div>
  <div class="step-box-dark">Step 4<br>
    (Shipping Details)</div>
  <div class="step-box-dark">Step 5<br>
    (Payments Details)</div>
  <!--Lite and dark pink box end-->
</div>
<!--tabs width end-->
<!--pink border-->
<div class="steps-back">
  <!--Inside pink border-->
  <div class="inside-product-back" style="padding: 25px 0px 10px 7px;">
  	  <div class="product-left">
      <!--left background-->
      <?php $i=1; foreach($shopping_data as $shopping_data_val){ ?>  
        <div class="product-bg1">
          <p class="product-name"><?php echo $i; ?>. <?php echo $shopping_data_val['title']; ?></p>
        </div>
        <div class="product-bg2">
          <div class="product-area">
          <?php
		  $pro_ser_id=array();
		  $pro_ser_name=array();
		  $pro_ser_usd=array();
		  $pro_ser_inr=array();
		  if(stristr($shopping_data_val['pro_ser_id'],',')){
			  $pro_ser_id=explode(",",$shopping_data_val['pro_ser_id']);
			  $pro_ser_name=explode(",",$shopping_data_val['pro_ser_name']);
			  $pro_ser_usd=explode(",",$shopping_data_val['pro_ser_usd']);
			  $pro_ser_inr=explode(",",$shopping_data_val['pro_ser_inr']);
		  }else{
			  array_push($pro_ser_id,$shopping_data_val['pro_ser_id']);
			  array_push($pro_ser_name,$shopping_data_val['pro_ser_name']);
			  array_push($pro_ser_usd,$shopping_data_val['pro_ser_usd']);
			  array_push($pro_ser_inr,$shopping_data_val['pro_ser_inr']);
		  }
		  $loop=count($pro_ser_id);
		  for($j=0;$j<$loop;$j++){
		  ?>
            <div class="check-area"<?php if($pro_ser_id[$j]==$shopp_data_id){ ?> style="background-color:#FAC5D6"<?php } ?>>
              <div class="check-box">
                <div class="check-box-area">
                  <input type="checkbox" id="ProductCode10" onclick="change(this);" value="<?php echo $pro_ser_id[$j]; ?>" name="shop_product[]" <?php if($pro_ser_id[$j]==$shopp_data_id){ ?>checked="checked"<?php } ?>>
                  <label for="ProductCode10"></label>
                </div>
                <span class="check-pink"><?php echo $pro_ser_name[$j]; ?></span></div>
              <div class="check-price"><strong>USD <?php echo $pro_ser_usd[$j]; ?> / <font class="WebRupee">Rs.</font><?php echo $pro_ser_inr[$j]; ?></strong></div>
              <?php
			  if($j<($loop-1)){
				  echo '<div class="check-hr"></div>';
          	  }
			  ?>
            </div>
          <?php } ?>   
          </div>
        </div>
        <div class="product-bg3"></div>
      <?php
	      if(($half%$i)==0){
			  echo '</div><div class="product-right">';
	  	  }
	  ?>
      <?php $i++;} ?>
      </div>
  </div>
  <!--Inside pink border end-->
  <form name="shop_cart" id="shop_cart" method="post" action="<?php echo base_url(); ?>orders/add_cart" onsubmit="return check_product()">
  <input name="shopping_element" id="shopping_element" value="<?php echo $this->uri->segment(3); ?>" type="hidden" />
  <div align="center" style="margin-top:180px; clear:both"><input type="submit" name="submit" class="button" id="signin_button" value="Add to Cart"></div>
  </form>
</div>
<?php }else{ ?>
<span style="padding-top:80px"><center><strong>No products available</strong></center></span>      
<?php } ?>
<div style="clear:both">&nbsp;</div>
</div>
</span>
</div>
<div id="rightbtm"><span></span></div>
</div>
<!--content end-->