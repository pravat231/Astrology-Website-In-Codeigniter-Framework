<?php
include_once('config/connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
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
      <li id="tabs_catalog" class="cm-active"><a href="all_contents.php">All Contents</a></li>
      <li id="tabs_catalog"><a href="view_order.php">Orders</a></li>
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
          	
            <h1 class="mainbox-title float-left">All Contents</h1>
          </div>
          <div class="mainbox-body">
            <form action="admin.php" method="post" name="userlist_form" id="userlist_form" class="">
              <div id="pagination_contents">
              	<div class="pagination clear cm-pagination-wraper top-pagination">
                  <div class="float-right"><div class="pagination">&nbsp;</div></div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
                  <tr>
                    <th width="100%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Content Types</a></th>
                  </tr>
                  <tr class="table-row">
                    <td><a href="/admin/products.php">Products</a></td>
                  </tr>
                  <tr class="table-row">
                    <td><a href="/admin/services.php">Services</a></td>
                  </tr>
                  <tr class="table-row">
                    <td><a href="/admin/horoscope.php">Horoscope</a></td>
                  </tr>
                </table>
              </div>
              <div class="buttons-container buttons-bg">
              	<div class="float-right">&nbsp;</div></div>
            </form>
          </div>
        </div>
      </div></td>
  </tr>
</table>
</body>
</html>