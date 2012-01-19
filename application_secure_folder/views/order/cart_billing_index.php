<script src="<?php echo base_url(); ?>js/prototype.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/effects.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/validation.js" type="text/javascript"></script>
<!--content-->
<div id="single_innercontainer">
  <div id="righttop"><span></span></div>
  <div id="innerrightmid"><span>
    <style type="text/css">
.validation-advice{
	margin-left:189px;
}
#innerrightmid span {
	margin-left: 5px;
	padding-right: 0px;
}
#innerrightmid span div {
	padding: 0px;
}
#innerrightmid span div.form-field {
	padding:15px;
}
#innerrightmid span .WebRupee{
	background:none;
    font-family: 'WebRupee';
}
#innerrightmid span .check-pink{
	background:none;
}
.form-field label{
	width:160px;
}
#innerrightmid span div.validation-advice {
    padding: 15px;
}
</style>
<script type="text/javascript">
function change_shipping_type(val){
	if(val=='ship_to_diff'){
		document.getElementById('listing_form').action.value='<?php echo base_url(); ?>orders/shipping';
		document.getElementById('listing_form').action='<?php echo base_url(); ?>orders/shipping';
		document.getElementById('billing_button').value='Proceed to Shipping';
	}else{
		document.getElementById('listing_form').action.value='<?php echo base_url(); ?>orders/payment';
		document.getElementById('listing_form').action='<?php echo base_url(); ?>orders/payment';
		document.getElementById('billing_button').value='Proceed to Payment';
	}
}
window.onload = init;
function init() {
	var submitObj = document.getElementById('billing_button');
	submitObj.disabled = false;
}
</script>
    <div style="text-align:justify;padding-left:3px; min-height:200px;">
      <div class="tabs-width">
        <!--Lite and dark pink box-->
        <div class="step-box-dark">Step 1<br>
          (List of Products)</div>
        <div class="step-box-dark2">Step 2<br>
          (Products in Cart)</div>
        <div class="step-box-lite" style="padding-top:10px;">Step 3<br>
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
        <div align="left" style="padding-top:10px; background-color:#f6f9fb">
          <div class="mainbox-body">
            <div style="width:550px; margin:auto" class="cm-tabs-content">
              <form id="listing_form" name="listing_form" action="<?php echo base_url(); ?>orders/payment" method="post" class="cm-form-highlight">
                <div id="content_general">
                  <fieldset>
                    <div class="form-field">
                      <label class="cm-required" for="billing_name">Name:</label>
                      <input type="text" value="<?php echo $billing_data[0]['name']; ?>" size="32" class="input-text required-entry validate-emailSender" name="billing_name" id="billing_name">
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_address">Address:</label>
                      <textarea class="input-textarea-long required-entry validate-emailSender" rows="3" cols="29" name="billing_address" id="billing_address"><?php echo $billing_data[0]['address']; ?></textarea>
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_city">City:</label>
                      <input type="text" value="<?php echo $billing_data[0]['city']; ?>" size="32" class="input-text required-entry validate-emailSender" name="billing_city" id="billing_city">
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_state">State:</label>
                      <input type="text" value="<?php echo $billing_data[0]['state']; ?>" size="32" class="input-text required-entry validate-emailSender" name="billing_state" id="billing_state">
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_country">Country:</label>
                      <input type="text" value="<?php echo $billing_data[0]['country']; ?>" size="32" class="input-text required-entry validate-emailSender" name="billing_country" id="billing_country">
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_postal">Zip Code:</label>
                      <input type="text" value="" size="32" class="input-text required-entry validate-zip-international" name="billing_postal" id="billing_postal">
                    </div>
                    <div class="form-field">
                      <label class="cm-required" for="billing_phone">Phone:</label>
                      <input type="text" value="<?php echo $billing_data[0]['phone']; ?>" size="32" class="input-text required-entry validate-phoneLax" name="billing_phone" id="billing_phone">
                    </div>
                    <div class="form-field">
                      <label for="ship_to_this">Ship to this address:</label>
                      <input type="radio" onclick="change_shipping_type(this.value)" checked="checked" value="ship_to_this" class="input-text" name="ship_to_this" id="ship_to_this">
                    </div>
                    <div class="form-field">
                      <label for="ship_to_diff">Ship to different address:</label>
                      <input type="radio" onclick="change_shipping_type(this.value)" value="ship_to_diff" class="input-text" name="ship_to_this" id="ship_to_diff">
                    </div>
                  </fieldset>
                </div>
                <div align="center" style="margin-left:35px">
                  <input type="hidden" name="bill_form_authen" id="bill_form_authen" value="billing_info" />
                  <input type="submit" name="billing_button" class="button" id="billing_button" value="Proceed to Payment" disabled="disabled">
                </div>
              </form>
              <script type="text/javascript">
			//&lt;![CDATA[
				var dataForm = new VarienForm('listing_form', true);
			//]]&gt;
		  </script>
            </div>
          </div>
        </div>
        <div style="clear:both">&nbsp;</div>
      </div>
      <div style="clear:both">&nbsp;</div>
    </div>
    </span>
    </div>
  <div id="rightbtm"><span></span></div>
</div>
<!--content end-->