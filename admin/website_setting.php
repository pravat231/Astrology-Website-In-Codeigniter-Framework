<?php
include_once('config/connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}
if(isset($_POST['dispatch'])){
	if(trim($_POST['website_title'])==''){
		$website_title_error='<div class="error-message"><div class="arrow"></div><div class="message">The Website title field is mandatory.</div></div>';
	}
	if($website_title_error==NULL){
		mysql_query("UPDATE website_info SET website_title='".$_POST['website_title']."',meta_title='".$_POST['meta_title']."',meta_description='".$_POST['meta_description']."',meta_keyword='".$_POST['meta_keyword']."',top_left_content='".$_POST['top_left_content']."',top_right_content='".$_POST['top_right_content']."',bottom_left_content='".$_POST['bottom_left_content']."',bottom_right_content='".$_POST['bottom_right_content']."',google_analytic_id='".$_POST['google_analytic_id']."',google_webmaster_tool_verify_code='".$_POST['google_v_id']."' LIMIT 1");
	}
}
$query=mysql_query("SELECT * FROM website_info");
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
      <li id="tabs_catalog" class="cm-active"><a href="website_setting.php">Website Setting</a></li>
      <li id="tabs_catalog"><a href="setting.php">Account Setting</a></li>
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
              <h1 class="mainbox-title">Website Setting:</h1>
            </div>
            <div class="mainbox-body">
              <div class="cm-tabs-content">
                <form name="profile_form" action="" method="post" class="cm-form-highlight">
                  <div id="content_general">
                    <fieldset>
                    <h2 class="subheader">Website Information</h2>
                    <div class="form-field">
                      <label for="website_title" class="cm-required">Website Title:</label>
                      <input id="website_title" type="text" name="website_title" class="input-text<?php if($website_title_error!=null){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo @$row['website_title']; ?>" />
                      <?php echo $website_title_error; ?> </div>
                    <div class="form-field">
                      <label for="meta_title">Meta Title:</label>
                      <input type="text" id="meta_title" name="meta_title" class="input-text" size="32" value="<?php echo @$row['meta_title']; ?>" />
                    </div>
                    <div class="form-field">
                      <label for="meta_description">Meta Description:</label>
                      <textarea id="meta_description" name="meta_description" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['meta_description']; ?></textarea>
                    </div>
                    <div class="form-field">
                      <label for="meta_keyword">Meta Keyword:</label>
                      <textarea id="meta_keyword" name="meta_keyword" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['meta_keyword']; ?></textarea>
                    </div>
                    </fieldset>
                    <fieldset>
                    <h2 class="subheader">Website Content</h2>
                    <div class="form-field">
                      <label for="top_left_content">Top Left Content:</label>
                      <textarea id="top_left_content" name="top_left_content" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['top_left_content']; ?></textarea>
                    </div>
                    <div class="form-field">
                      <label for="top_right_content">Top Right Content:</label>
                      <textarea id="top_right_content" name="top_right_content" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['top_right_content']; ?></textarea>
                    </div>
                    <div class="form-field">
                      <label for="bottom_left_content">Bottom Left Content:</label>
                      <textarea id="bottom_left_content" name="bottom_left_content" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['bottom_left_content']; ?></textarea>
                    </div>
                    <div class="form-field">
                      <label for="meta_keyword">Bottom Right Content:</label>
                      <textarea id="bottom_right_content" name="bottom_right_content" cols="5" rows="5" class="input-textarea-long"><?php echo @$row['bottom_right_content']; ?></textarea>
                    </div>
                    </fieldset>                    
                    <fieldset>
                    <h2 class="subheader">Google Stuff</h2>
                    <div class="form-field">
                      <label for="google_v_id">Google webmaster tool verification code id:</label>
                      <input type="text" id="google_v_id" name="google_v_id" size="32" value="<?php echo @$row['google_webmaster_tool_verify_code']; ?>" class="input-text" />
                    </div>
                    <div class="form-field">
                      <label for="google_analytic_id">Google analytics code id:</label>
                      <input type="text" id="google_analytic_id" name="google_analytic_id" size="32" value="<?php echo @$row['google_analytic_id']; ?>" class="input-text" />
                    </div>
                    </fieldset>
                  </div>
                  <div class="buttons-container buttons-bg cm-toggle-button"><span  class="submit-button cm-button-main"><input type="submit" name="dispatch" value="Save" /></span></div>
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