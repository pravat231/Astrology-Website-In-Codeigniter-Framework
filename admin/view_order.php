<?php
include_once('connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
$order_id=@$_GET['order_id'];
if(is_numeric($order_id)){
$query_sql=mysql_query("SELECT order_product,order_total_price,order_shipping_details,order_billing_details,paypal_transact_id,DATE_FORMAT(order_create_date,'%b %d, %Y %h:%i:%s %p') AS create_order_date,order_status,payment_status FROM website_order WHERE order_id='".$order_id."'"); 
$row_sql=mysql_fetch_object($query_sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<title>Administration panel</title>
<link href="images/icons/favicon.ico" rel="shortcut icon">
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
  <div id="logo">&nbsp;</div>
  <div class="nowrap" style="float:right; margin-right:20px"><a href="logout.php" class="text-link">Sign out</a></div>
  <div id="menu_first_level">
    <ul id="menu_first_level_ul" class="clear">
      <li id="tabs_catalog"><a href="content.php">Website Pages</a></li>
      <li id="tabs_catalog"><a href="top_links.php">Top Links</a></li>
      <li id="tabs_catalog"><a href="products.php">Products</a></li>
      <li id="tabs_catalog"><a href="services.php">Services</a></li>
      <li id="tabs_catalog" class="cm-active"><a href="view_order.php">Orders</a></li>
      <li id="tabs_catalog"><a href="user_list.php">Users</a></li>
      <li id="tabs_catalog"><a href="website_setting.php">Website Setting</a></li>
      <li id="tabs_catalog"><a href="setting.php">Account Setting</a></li>
    </ul>
  </div>
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr valign="top">
    <td class="content"><div id="main_column" class="clear">
        <div class="cm-notification-container "> </div>
        <div>
          <div class="clear mainbox-title-container">
            <h1 class="mainbox-title float-left">Orders</h1>
          </div>
          <div class="mainbox-body">
            <table width="98%" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana; color:#333333; font-size:12px">
              <tr>
                <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d6d6d6" bgcolor="#fafafa">
                    <tr bgcolor="#6f8992" height="25px">
                      <td colspan="4"><span style="margin-left:10px; color:#FFFFFF; font-weight:bold">Order # <?php echo $row_sql->paypal_transact_id; ?> (the order confirmation email was sent)</span></td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td width="19%">&nbsp;</td>
                      <td width="4%">&nbsp;</td>
                      <td width="74%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Order Date</td>
                      <td>&nbsp;</td>
                      <td><strong><?php echo $row_sql->create_order_date; ?></strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Order Status</td>
                      <td>&nbsp;</td>
                      <td><strong><?php echo $row_sql->order_status; ?></strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                <td>&nbsp;</td>
                <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d6d6d6" bgcolor="#fafafa">
                    <tr bgcolor="#6f8992" height="25px">
                      <td colspan="4"><span style="margin-left:10px; color:#FFFFFF; font-weight:bold">Order Information</span></td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td width="19%">&nbsp;</td>
                      <td width="4%">&nbsp;</td>
                      <td width="74%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Payment Status</td>
                      <td>&nbsp;</td>
                      <td><strong><?php echo $row_sql->payment_status; ?></strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Grand Total</td>
                      <td>&nbsp;</td>
                      <td><strong>$<?php echo $row_sql->order_total_price; ?></strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d6d6d6" bgcolor="#fafafa">
                    <tr bgcolor="#6f8992" height="25px">
                      <td colspan="4"><span style="margin-left:10px; color:#FFFFFF; font-weight:bold">Billing Information</span></td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td width="19%">&nbsp;</td>
                      <td width="4%">&nbsp;</td>
                      <td width="74%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3" rowspan="3" valign="top"><strong>
                        <?php $billing_info=unserialize($row_sql->order_billing_details); 

		echo $billing_info['BILLER_NAME'].'<br>';

		echo $billing_info['BILLER_STREET'].', '.$billing_info['BILLER_CITY'].'<br>';

		echo $billing_info['BILLER_STATE'].', '.$billing_info['BILLER_ZIP'].'<br>';	

		echo $billing_info['BILLER_PHONE'];

		?>
                        </strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                <td>&nbsp;</td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d6d6d6" bgcolor="#fafafa">
                    <tr bgcolor="#6f8992" height="25px">
                      <td colspan="4"><span style="margin-left:10px; color:#FFFFFF; font-weight:bold">Shipping Information</span></td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td width="19%">&nbsp;</td>
                      <td width="4%">&nbsp;</td>
                      <td width="74%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3" rowspan="3" valign="top"><strong>
                        <?php $shipping_info=unserialize($row_sql->order_shipping_details); 

		echo $shipping_info['SHIPTONAME'].'<br>';

		echo $shipping_info['SHIPTOSTREET'].', '.$shipping_info['SHIPTOCITY'].'<br>';

		echo $shipping_info['SHIPTOSTATE'].', '.$shipping_info['SHIPTOZIP'].'<br>';	

		echo $shipping_info['SHIPTOCOUNTRYCODE'];

		?>
                        </strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d6d6d6" bgcolor="#fafafa">
                    <tr bgcolor="#6f8992" height="25px">
                      <td colspan="5"><span style="margin-left:10px; color:#FFFFFF; font-weight:bold">Items Ordered</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" height="25px">
                      <td width="1%">&nbsp;</td>
                      <td width="73%"><span style="color:#000000; font-weight:bold">Products</span></td>
                      <td width="9%"><span style="color:#000000; font-weight:bold">Price</span></td>
                      <td width="9%"><span style="color:#000000; font-weight:bold">Qty</span></td>
                      <td width="8%"><span style="color:#000000; font-weight:bold">Sub Total</span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php $product_details=unserialize($row_sql->order_product); foreach($product_details as $key=>$value){; ?>
                    <tr height="20px">
                      <td>&nbsp;</td>
                      <td><?php echo $value['product_name']; ?></td>
                      <td><?php echo '$'.$value['product_price']; ?></td>
                      <td><?php echo $value['product_qty']; ?></td>
                      <td>$<?php echo $value['product_price']*$value['product_qty']; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </div>
        </div>
      </div></td>
  </tr>
</table>
</body>
</html>
<?php }else{
header('Location: index.php');
} ?>