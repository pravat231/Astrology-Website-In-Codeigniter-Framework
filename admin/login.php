<?php
include_once('config/connection.php');
if($_SESSION['login']==true){
	header("Location: content.php");
	exit;
}

function login_func($uname,$pass){
	$query=mysql_query("SELECT * FROM user_authen WHERE user_name='".$uname."' AND password='".md5($pass)."' AND user_type='admin'");
	if(mysql_num_rows($query)>0){
		return false;
	}else{
		return true;
	}
}
if(isset($_POST['dispatch'])){
	if((trim($_POST['user_login'])=='') || (trim($_POST['password'])=='')){
		$error=true;
	}else if(login_func($_POST['user_login'],$_POST['password'])){
		$error=true;
	}else{
		$_SESSION['login']=true;
		header("Location: content.php");
		exit;
	}
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
<?php if($error){ ?>
<div class="cm-notification-container cm-notification-container-top">
<div class="notification-content">
<div class="notification-e">
<div class="notification-body">The username or password you have entered is invalid. Please try again.</div>
</div>
</div>
</div>
<?php } ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr valign="top">
      <td class="login-page"><div id="main_column_login" class="clear">
          <form action="" method="post" name="main_login_form" class="cm-form-highlight cm-skip-check-items cm-check-changes">
            <span class="right"><span>&nbsp;</span></span>
            <h1 class="clear"><span>Administration panel</span></h1>
            <div class="login-content">
              <p>
                <label for="username" class="cm-required">Username:</label>
              </p>
              <input id="username" name="user_login" size="20" class="input-text cm-focus" tabindex="1" type="text">
              <p>
                <label for="password">Password:</label>
              </p>
              <input id="password" name="password" size="20" class="input-text" tabindex="2" type="password">
              <div class="buttons-container nowrap">
                <div class="float-left"><span class="submit-button cm-button-main">
                  <input name="dispatch" value="Sign in" tabindex="3" type="submit">
                  </span> </div>
              </div>
            </div>
          </form>
        </div></td>
    </tr>
  </tbody>
</table>
</body>
</html>
