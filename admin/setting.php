<?php
include_once('config/connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
if(isset($_POST['dispatch'])){
	if(trim($_POST['user_login'])==''){
		$admin_error='<div class="error-message"><div class="arrow"></div><div class="message">The Username field is mandatory.</div></div>';
	}elseif(strlen(trim($_POST['user_login']))<4){
		$admin_error='<div class="error-message"><div class="arrow"></div><div class="message">The Username field must contain 4 character.</div></div>';
	}
	if(trim($_POST['password1'])!=''){
		if(strlen(trim($_POST['password1']))<5){
			$pass1_error='<div class="error-message"><div class="arrow"></div><div class="message">The Password field must contain 5 character.</div></div>';
		}
		if(trim($_POST['password2'])==''){
			$pass2_error='<div class="error-message"><div class="arrow"></div><div class="message">The Confirm password field is mandatory.</div></div>';
		}elseif(trim($_POST['password1'])!=trim($_POST['password2'])){
			$pass2_error='<div class="error-message"><div class="arrow"></div><div class="message">The Password and Confirm password field miss match.</div></div>';
		}
	}
	if(trim($_POST['email'])==''){
		$email_error='<div class="error-message"><div class="arrow"></div><div class="message">The E-mail field is mandatory.</div></div>';
	}elseif(!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i",$_POST['email'])){
		$email_error='<div class="error-message"><div class="arrow"></div><div class="message">The email address in the E-mail field is invalid.</div></div>';
	}
	$sql_up='';
	if(($pass2_error==null) && (trim($_POST['password1'])!='')){
		$sql_up.="password='".md5($_POST['password1'])."',";
	}
	if(($admin_error==null) && ($email_error==null)){
		$sql_up.="user_name='".$_POST['user_login']."',email='".$_POST['email']."'";
		mysql_query("UPDATE user_authen SET ".$sql_up." WHERE user_id='1'");
	}
}
$query=mysql_query("SELECT user_name,email FROM user_authen WHERE user_id=1");
$row=mysql_fetch_array($query);
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
      <li id="tabs_catalog"><a href="user_list.php">Users</a></li>
      <li id="tabs_catalog"><a href="website_setting.php">Website Setting</a></li>
      <li id="tabs_catalog" class="cm-active"><a href="setting.php">Account Setting</a></li>
    </ul>
  </div>
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr valign="top">
      <td class="content"><div id="main_column" class="clear">
          <div class="cm-notification-container"></div>
          <div>
            <div class="clear mainbox-title-container">
              <h1 class="mainbox-title"> Editing profile:</h1>
            </div>
            <div class="mainbox-body">
              <div class="cm-tabs-content">
                <form name="profile_form" action="" method="post" class="cm-form-highlight">
                  <div id="content_general">
                    <fieldset>
                    <h2 class="subheader"> User account information </h2>
                    <div class="form-field">
                      <label for="user_login_profile" class="cm-required">Username:</label>
                      <input id="user_login_profile" type="text" name="user_login" class="input-text<?php if($admin_error!=null){ ?> cm-failed-field<?php } ?>" size="32" maxlength="32" value="<?php echo $row['user_name']; ?>" />
                      <?php echo $admin_error; ?> </div>
                    <div class="form-field">
                      <label for="password1">Password:</label>
                      <input type="password" id="password1" name="password1" class="input-text<?php if($pass1_error!=null){ ?> cm-failed-field<?php } ?>" size="32" maxlength="32" autocomplete="off" value="<?php echo @$_POST['password1']; ?>" />
                      <span style="font:Verdana; color:#333; margin-left:5px">If you would like to change the password type a new one. Otherwise leave this blank.</span> <?php echo $pass1_error; ?> </div>
                    <div class="form-field">
                      <label for="password2">Confirm password:</label>
                      <input type="password" id="password2" name="password2" class="input-text<?php if($pass2_error!=null){ ?> cm-failed-field<?php } ?>" size="32" maxlength="32" autocomplete="off" value="<?php echo @$_POST['password2']; ?>" />
                      <?php echo $pass2_error; ?> </div>
                    </fieldset>
                    <fieldset>
                    <h2 class="subheader"> Contact information </h2>
                    <div class="form-field">
                      <label for="elm_33" class="cm-required cm-email ">E-mail:</label>
                      <input type="text" id="elm_33" name="email" size="32" value="<?php echo $row['email']; ?>" class="input-text<?php if($email_error!=null){ ?> cm-failed-field<?php } ?>" />
                      <?php echo $email_error; ?> </div>
                    </fieldset>
                  </div>
                  <div class="buttons-container buttons-bg cm-toggle-button"> <span  class="submit-button cm-button-main ">
                    <input type="submit" name="dispatch" value="Save" />
                    </span></div>
                </form>
              </div>
            </div>
          </div>
        </div></td>
    </tr>
  </tbody>
</table>
</body>
</html>