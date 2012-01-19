<?php
include_once('config/connection.php');
include_once("config/CSSPagination.class.php"); 
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
if(@$_GET['act']=='del'){
	if(mysql_query("DELETE FROM astro_user WHERE user_id='".$_GET['user_id']."'")){
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully deleted.</div>
			</div>
			</div>
			</div>';
	}
}
if(@$_GET['act']=='status'){
	if(mysql_query("UPDATE astro_user SET status='inactive' WHERE status='active' AND user_id='".$_GET['user_id']."'")){
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully Accept.</div>
			</div>
			</div>
			</div>';
	}
}
$sql1="SELECT user_id,email,name,gender,phone,address,country,state,city,verified,status,registration_date,lastlogin FROM astro_user WHERE user_authenticate='end_user' ORDER BY user_id DESC";
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
      <li id="tabs_catalog"><a href="all_contents.php">All Contents</a></li>
      <li id="tabs_catalog"><a href="view_order.php">Orders</a></li>
      <li id="tabs_catalog" class="cm-active"><a href="user_list.php">Users</a></li>
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
            <div class="tools-container"><span class="action-add"><a href="download_email_csv.php">Download Email Address In CSV</a></span></div>
            <h1 class="mainbox-title float-left">Listings</h1>
          </div>
          <div class="mainbox-body">
            <form action="admin.php" method="post" name="userlist_form" id="userlist_form" class="">
              <div id="pagination_contents">
                <div class="pagination clear cm-pagination-wraper top-pagination">
                  <div class="float-right"><?php echo $pagination->showPage(); ?></div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
                  <tr>
                    <th width="25%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Name</a></th>
                    <th width="15%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Email Address</a></th>
                    <th width="15%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Phone Number</a></th>
                    <th width="45%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Address</a></th>
                  </tr>
                  <?php  $sql2=$sql1." LIMIT ".$pagination->getLimit().", " . $rowsperpage; 
				  $result=@mysql_query($sql2) or die("failed");
				  if(mysql_num_rows($result)>0){
				  while($row=mysql_fetch_array($result)){ ?>
                  <tr class="table-row">
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address'].'<br>'.$row['city'].', '.$row['state'].', '.$row['country']; ?></td>
                  </tr>
                  <?php }} ?>
                </table>
                <!--pagination_contents-->
              </div>
              <div class="buttons-container buttons-bg">
                <div class="float-right">
                  <div class="tools-container"> <span class="action-add"><a href="download_email_csv.php">Download Email Address In CSV</a></span> </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div></td>
  </tr>
</table>
</body>
</html>