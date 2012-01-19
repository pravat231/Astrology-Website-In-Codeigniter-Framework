<script type="text/javascript">
function change_shipping_type(val){
	if(val=='ccavenue'){
		document.getElementById('shopping_form').action.value='<?php echo base_url(); ?>orders/ccavenue';
		document.getElementById('shopping_form').action='<?php echo base_url(); ?>orders/ccavenue';
	}else{
		document.getElementById('shopping_form').action.value='<?php echo base_url(); ?>orders/expresscheckout';
		document.getElementById('shopping_form').action='<?php echo base_url(); ?>orders/expresscheckout';
	}
}
window.onload = init;
function init() {
	var submitObj = document.getElementById('payment_button');
	submitObj.disabled = false;
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
#innerrightmid span button span{
	color:#FFFFFF;
	background:none;
}
#innerrightmid th span {
	margin-left: 5px;
	padding-right: 0px;
	background:none;
	color:#0A263C;
}
#innerrightmid span .cart-price {
	margin-left: 5px;
	padding-right: 0px;
	background:none;
	color:#0A263C;
	display:inherit;
}
#innerrightmid span .price {
	background:inherit;
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
#innerrightmid a{
	background:inherit;
	float:none;
}
#innerrightmid a:hover{
	background:inherit;
	float:none;
}
#innerrightmid span td a.btn-remove{
	background:url("../images/delete_icon.jpg") no-repeat scroll 0 0 transparent;
}
#innerrightmid ul.checkout-types{
    margin: 0;
    padding: 15px 12px;
}
.formlabel7_a {
    color: #57585A;
    float: left;
    font-size: 15px;
    font-weight: bold;
    padding-bottom: 10px;
    width: 132px;
}
.formlabel7_b {
    color: #57585A;
    float: left;
    font-size: 15px;
    font-weight: bold;
    padding-bottom: 10px;
    width: 210px;
}
</style>
    <div style="text-align:justify;padding-left:3px; min-height:200px;">
<?php
$total_data=count($shopping_data);
if($total_data>0){
?>
      <div class="tabs-width">
        <!--Lite and dark pink box-->
        <div class="step-box-dark">Step 1<br>
          (List of Products)</div>
        <div class="step-box-dark">Step 2<br>
          (Products in Cart)</div>
        <div class="step-box-dark">Step 3<br>
          (Billing Details)</div>
        <div class="step-box-dark2">Step 4<br>
          (Shipping Details)</div>
        <div class="step-box-lite" style="padding-top:10px;">Step 5<br>
          (Payments Details)</div>
        <!--Lite and dark pink box end-->
      </div>
      <!--tabs width end-->
      <!--pink border-->
      <div class="steps-back">
        <div align="left" style="padding-top:10px; background-color:#f6f9fb">
          <div class="col-main">
            <div class="cart">
                <fieldset>
                <table class="data-table cart-table" id="shopping-cart-table" width="100%">
                  <thead>
                    <tr>
                      <th align="left">Product/Service Name</th>
                      <th align="center"><span class="nobr">Unit Price(USD)</span></th>
                      <th align="center"><span class="nobr">Unit Price(INR)</span></th>
                      <th align="center">Subtotal</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <td align="left" colspan="5" style="color: #0A263C;font-weight: bold;white-space: nowrap;">Select Payment Method</td>
                    </tr>
                    <tr style="background-color:#f5f9fa" height="100px">
                    	<td align="left" colspan="5">
                        <div class="formlabel7_a"><input type="radio" value="paypal" name="pay_type" checked="checked" onclick="change_shipping_type(this.value)"> Paypal</div>
                        <div class="formlabel7_b"><input type="radio" value="ccavenue" name="pay_type" onclick="change_shipping_type(this.value)"> Debit Card / Netbanking</div>
                        <div class="formlabel7_b"><input type="radio" value="ccavenue" name="pay_type" onclick="change_shipping_type(this.value)">Credit Card</div>                         
                        </td>
                    </tr>
                  </tfoot>
                  <tbody>
                  	<?php $sub_total_usd='';$sub_total_inr='';foreach($shopping_data as $shopping_data_val){ ?>
                    <tr id="tr_id_<?php echo $shopping_data_val['pro_ser_id']; ?>">
                      <td><h4 class="product-name"><?php echo $shopping_data_val['pro_ser_name']; ?></h4></td>
                      <td align="center"><span class="cart-price"> <span class="price">$<?php echo $shopping_data_val['pro_ser_usd']; ?></span> </span></td>
                      <td align="center"><span class="cart-price"> <span class="price">Rs.<?php echo $shopping_data_val['pro_ser_inr']; ?></span> </span></td>
                      <td align="center"><span class="cart-price"> <span class="price">$<?php echo $shopping_data_val['pro_ser_usd']; ?>&nbsp;/&nbsp;Rs.<?php echo $shopping_data_val['pro_ser_inr']; ?></span> </span></td>
                    </tr>
                    <?php 
						$sub_total_usd+=$shopping_data_val['pro_ser_usd'];
						$sub_total_inr+=$shopping_data_val['pro_ser_inr'];						
					} 
					$this->session->set_userdata('shopp_total_usd',$sub_total_usd);
					$this->session->set_userdata('shopp_total_inr',$sub_total_inr);
					?>
                  </tbody>
                </table>
                </fieldset>
              <div class="cart-collaterals">
                <div class="totals">
                  <table id="shopping-cart-totals-table">
                    <tfoot>
                      <tr>
                        <td colspan="1" align="right" style=""><strong>Grand Total</strong></td>
                        <td align="right" style=""><strong><span class="price">$<?php echo $sub_total_usd; ?>&nbsp;/&nbsp;Rs.<?php echo $sub_total_inr; ?></span></strong></td>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td colspan="1" align="right" style=""> Subtotal </td>
                        <td align="right" style=""><span class="price">$<?php echo $sub_total_usd; ?>&nbsp;/&nbsp;Rs.<?php echo $sub_total_inr; ?></span></td>
                      </tr>
                    </tbody>
                  </table>
                  <ul class="checkout-types">
                  <form name="shopping_form" id="shopping_form" method="post" action="<?php echo base_url(); ?>orders/expresscheckout">
                  	<input type="submit" name="payment_button" class="button" id="payment_button" value="Pay Now" disabled="disabled" />
                  </form>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="clear:both">&nbsp;</div>
      </div>
      <?php }else{ ?>
      <span style="padding-top:80px">
      <center>
        <strong>No products available</strong>
      </center>
      </span>
      <?php } ?>
      <div style="clear:both">&nbsp;</div>
    </div>
    </span> </div>
    <div id="rightbtm"><span></span></div>
</div>
<!--content end-->