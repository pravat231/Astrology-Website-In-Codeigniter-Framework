<HTML>
<HEAD>
<TITLE>Sub-merchant checkout page</TITLE>
</HEAD>
<BODY>
	<form name="frmRecharge" id="frmRecharge" method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp">
	<input type="hidden" name="Merchant_Id" value="<?php echo $Merchant_Id; ?>">
	<input type="hidden" name="Amount" value="<?php echo $Amount; ?>">
	<input type="hidden" name="Order_Id" value="<?php echo $Order_Id; ?>">
	<input type="hidden" name="Redirect_Url" value="<?php echo $Redirect_Url; ?>">
	<input type="hidden" name="Checksum" value="<?php echo $Checksum; ?>">
	<input type="hidden" name="billing_cust_name" value="<?php echo $billing_cust_name; ?>"> 
	<input type="hidden" name="billing_cust_address" value="<?php echo $billing_cust_address; ?>"> 
	<input type="hidden" name="billing_cust_country" value="<?php echo $billing_cust_country; ?>"> 
	<input type="hidden" name="billing_cust_state" value="<?php echo $billing_cust_state; ?>"> 
	<input type="hidden" name="billing_zip" value="<?php echo $billing_zip; ?>"> 
	<input type="hidden" name="billing_cust_tel" value="<?php echo $billing_cust_tel; ?>"> 
	<input type="hidden" name="billing_cust_email" value="<?php echo $billing_cust_email; ?>"> 
	<input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_cust_name; ?>"> 
	<input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_cust_address; ?>"> 
	<input type="hidden" name="delivery_cust_country" value="<?php echo $delivery_cust_country; ?>"> 
	<input type="hidden" name="delivery_cust_state" value="<?php echo $delivery_cust_state; ?>"> 
	<input type="hidden" name="delivery_cust_tel" value="<?php echo $delivery_cust_tel; ?>"> 
	<input type="hidden" name="delivery_cust_notes" value=""> 
	<input type="hidden" name="Merchant_Param" value=""> 
	<input type="hidden" name="billing_cust_city" value="<?php echo $billing_cust_city; ?>"> 
	<input type="hidden" name="billing_zip_code" value="<?php echo $billing_zip_code; ?>"> 
	<input type="hidden" name="delivery_cust_city" value="<?php echo $delivery_cust_city; ?>"> 
	<input type="hidden" name="delivery_zip_code" value="<?php echo $delivery_zip_code; ?>">
	</form>
	<script language="javascript">
	 document.frmRecharge.submit();
	</script>
</BODY>
</HTML>