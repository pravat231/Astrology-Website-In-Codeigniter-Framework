<?php
include_once('config/connection.php');
include_once("config/CSSPagination.class.php"); 

if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}

if(@$_GET['act']=='del'){
	if(mysql_query("DELETE FROM website_order WHERE order_id='".$_GET['order_id']."'")){
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully deleted.</div>
			</div>
			</div>
			</div>';
	}
}
$sql1="SELECT * FROM website_order ORDER BY order_id DESC"; 
$rowsperpage = 20; 
$website = $_SERVER['PHP_SELF'].'?';
$pagination = new CSSPagination($sql1, $rowsperpage, $website);
$pagination->setPage($_GET[page]);
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
            <form action="admin.php" method="post" name="userlist_form" id="userlist_form" class="">
              <div id="pagination_contents">
              	<div class="pagination clear cm-pagination-wraper top-pagination">
                <div class="float-right"><?php echo $pagination->showPage(); ?></div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
                  <tr>
                    <th width="12%"><a class="cm-ajax" href="javascript:void(0)">Transaction ID</a></th>
                    <th width="14%"><a class="cm-ajax" href="javascript:void(0)">Purchased On</a></th>
                    <th width="17%"><a class="cm-ajax" href="javascript:void(0)">Bill to Name</a></th>
                    <th width="17%"><a class="cm-ajax" href="javascript:void(0)">Ship to Name</a></th>
                    <th width="10%"><a class="cm-ajax" href="javascript:void(0)">G.T. Purchased</a></th>
                    <th width="10%"><a class="cm-ajax" href="javascript:void(0)">Payment Status</a></th>
                    <th width="10%"><a class="cm-ajax" href="javascript:void(0)">Order Status</a></th>
                    <th width="8%">&nbsp;</th>
                  </tr>
                  <?php  $sql2="SELECT *,DATE_FORMAT(order_create_date,'%b %d, %Y %h:%i:%s %p') AS order_date FROM website_order ORDER BY order_id DESC LIMIT ".$pagination->getLimit().", " . $rowsperpage; 
						$result=@mysql_query($sql2) or die("failed");       
						if(mysql_num_rows($result)>0){ 
						while($row=mysql_fetch_array($result)){ 
						$order_billing_details=unserialize($row['order_billing_details']);
						$order_shipping_details=unserialize($row['order_shipping_details']);
						?>
                  <tr class="table-row">
                    <td>&nbsp;<strong><?php echo $row['paypal_transact_id']; ?></strong>&nbsp;</td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $order_billing_details['BILLER_NAME']; ?></td>
                    <td><?php echo $order_shipping_details['SHIPTONAME']; ?></td>
                    <td><?php echo '$'.$row['order_total_price']; ?></td>
                    <td><?php echo $row['payment_status']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td class="nowrap"><a class="tool-link" href="view_order.php?order_id=<?php echo $row['order_id']; ?>">view</a> &nbsp;&nbsp;|
                      <ul class="cm-tools-list tools-list">
                        <li><a href="edit_orders.php?order_id=<?php echo $row['order_id']; ?>">edit</a> | </li>
                        <li><a href="orders.php?act=del&order_id=<?php echo $row['order_id']; ?>" onclick="return confirm('Do you want to delete this.')">delete</a></li>
                      </ul></td>
                  </tr>
                  <?php }} ?>
                </table>
                <!--pagination_contents-->
              </div>
              <div class="buttons-container buttons-bg">
                
              </div>
            </form>
          </div>
        </div>
      </div></td>
  </tr>
</table>
</body>
</html>