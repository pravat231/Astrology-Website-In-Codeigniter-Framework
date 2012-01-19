<?php
include_once('config/connection.php');
include_once("config/CSSPagination.class.php"); 
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
if(@$_GET['act']=='del'){
	$query_img=mysql_query("SELECT pro_ser_img FROM website_pro_ser WHERE pro_ser_id='".$_GET['pro_ser_id']."'");
	$title_img=mysql_result($query_img,0,'pro_ser_img');
	if(file_exists($site_path.'pro_ser_image/'.$title_img.'.jpg')){
		unlink($site_path.'pro_ser_image/'.$title_img.'.jpg');
	}
	if(mysql_query("DELETE FROM website_pro_ser WHERE pro_ser_id='".$_GET['pro_ser_id']."'")){
		mysql_query("DELETE FROM website_pro_ser_pages WHERE pro_ser_id='".$_GET['pro_ser_id']."'");
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully deleted.</div>
			</div>
			</div>
			</div>';
	}
}

if(@$_GET['act']=='active'){
	if(mysql_query("UPDATE website_pro_ser SET pro_ser_status='active' WHERE pro_ser_status='inactive' AND pro_ser_id='".$_GET['pro_ser_id']."'")){
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully Accept.</div>
			</div>
			</div>
			</div>';
	}
}
if(@$_GET['act']=='inactive'){
	if(mysql_query("UPDATE website_pro_ser SET pro_ser_status='inactive' WHERE pro_ser_status='active' AND pro_ser_id='".$_GET['pro_ser_id']."'")){
		echo '<div class="cm-notification-container cm-notification-container-top">
			<div class="notification-content">
			<div class="notification-e">
			<div class="notification-body">Successfully Accept.</div>
			</div>
			</div>
			</div>';
	}
}
$sql1="SELECT * FROM website_pro_ser WHERE pro_ser_type='service' ORDER BY pro_ser_id DESC"; 
$rowsperpage = 10; 
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
            <div class="tools-container"><span class="action-add"><a href="add_horoscope.php">Add Horoscope</a></span></div>
            <h1 class="mainbox-title float-left">Listings</h1>
          </div>
          <div class="mainbox-body">
            <form action="admin.php" method="post" name="userlist_form" id="userlist_form" class="">
              <div id="pagination_contents">
                <div class="pagination clear cm-pagination-wraper top-pagination">
                  <div class="float-right"><div class="pagination"><?php echo $pagination->showPage(); ?></div></div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
                  <tr>
                    <th width="2%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">ID</a></th>
                    <th width="25%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Service Name</a></th>
                    <th width="33%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Service Intro</a></th>
                    <th width="15%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Price USD</a></th>
                    <th width="15%"><a class="cm-ajax" href="javascript:void(0)" rev="pagination_contents">Price INR</a></th>
                    <th width="10%">&nbsp;</th>
                  </tr>
                  <?php  $sql2=$sql1." LIMIT ".$pagination->getLimit().", " . $rowsperpage; 
						$result=@mysql_query($sql2) or die("failed");       
						if(mysql_num_rows($result)>0){ 
						while($row=mysql_fetch_array($result)){ ?>
                  <tr class="table-row">
                    <td>&nbsp;<strong><?php echo $row['pro_ser_id']; ?></strong>&nbsp;</td>
                    <td><?php echo $row['pro_ser_name']; ?></td>
                    <td><?php echo substr($row['pro_ser_intro'],0,100).".."; ?></td>
                    <td><?php echo '$'.$row['pro_ser_usd']; ?></td>
                    <td><?php echo 'Rs.'.$row['pro_ser_inr']; ?></td>
                    <td class="nowrap"><a class="tool-link" href="edit_services.php?pro_ser_id=<?php echo $row['pro_ser_id']; ?>">Edit</a> &nbsp;&nbsp;|
                      <ul class="cm-tools-list tools-list">
                        <?php if($row['pro_ser_status']=='inactive'){ ?>
                        <li><a href="services.php?act=active&pro_ser_id=<?php echo $row['pro_ser_id']; ?>" onclick="return confirm('Do you want to activate this.')">active</a> | </li>
                        <?php }else{ ?>
                        <li><a href="services.php?act=inactive&pro_ser_id=<?php echo $row['pro_ser_id']; ?>" onclick="return confirm('Do you want to inactivate this.')">inactive</a> | </li>
                        <?php } ?>
                        <li> <a href="services.php?act=del&pro_ser_id=<?php echo $row['pro_ser_id']; ?>" onclick="return confirm('Do you want to delete this.')">Delete</a></li>
                      </ul></td>
                  </tr>
                  <?php }} ?>
                </table>
                <!--pagination_contents-->
              </div>
              <div class="buttons-container buttons-bg">
                <div class="float-right">
                  <div class="tools-container"> <span class="action-add"><a href="add_horoscope.php">Add Horoscope</a></span> </div>
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