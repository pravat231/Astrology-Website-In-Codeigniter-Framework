<?php
include_once('config/connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}

if(isset($_POST['dispatch2'])){
	if(trim($_POST['page_title'])==''){
		$page_title_error='<div class="error-message"><div class="arrow"></div><div class="message">The Page Title field is mandatory.</div></div>';
	}
	if($page_title_error==NULL){
		if($_FILES["page_logo"]['name']!=""){
			if(($_FILES["page_logo"]["type"] == "image/gif")||($_FILES["page_logo"]["type"] == "image/jpeg")||($_FILES["page_logo"]["type"] == "image/pjpeg")||($_FILES["page_logo"]["type"] == "image/png")){
				if ($_FILES["page_logo"]["error"] > 0){
					$page_logo_error='<div class="error-message" style="width:200px"><div class="arrow"></div><div class="message">The logo field has some error.</div></div>';
				}else{
					mysql_query("INSERT INTO website_pages(parent_id,title,intro,content,created,updated,page_status,show_in_home,meta_title,meta_desc,meta_keyword,img_alt,design_type) VALUES ('".$_POST['page_parent']."', '".$_POST['page_title']."', '".$_POST['page_summary']."', '".$_POST['page_content']."',now(),now(),'".$_POST['page_status']."','".$_POST['show_in_home']."','".$_POST['meta_title']."','".$_POST['meta_description']."','".$_POST['meta_keyword']."','".$_POST['img_alt']."','".$_POST['design_type']."')");
					$last_id=mysql_insert_id();
					$title=clean_url($_POST['page_title'],$last_id);
					include('config/resize.php');
					$image = new SimpleImage();
					if(file_exists($site_path.'page_image/'.$title.'.jpg')){
						unlink($site_path.'page_image/'.$title.'.jpg');
						$image->load($_FILES["page_logo"]["tmp_name"]);
						$image->resize(90,80);
						$image->save($site_path.'page_image/'.$title.'.jpg');
					}else{
						$image->load($_FILES["page_logo"]["tmp_name"]);
						$image->resize(90,80);
						$image->save($site_path.'page_image/'.$title.'.jpg');
					}
					mysql_query("UPDATE website_pages SET slug='".$title."',img_link='".$title."' WHERE page_id='".$last_id."'");
				}
			}else{
				$page_logo_error='<div class="error-message" style="width:290px"><div class="arrow"></div><div class="message">The logo file must be jpeg,jpg,gif or png type.</div></div>';
			}
		}else{
			mysql_query("INSERT INTO website_pages(parent_id,title,intro,content,created,updated,page_status,show_in_home,meta_title,meta_desc,meta_keyword,img_alt,design_type) VALUES ('".$_POST['page_parent']."', '".$_POST['page_title']."', '".$_POST['page_summary']."', '".$_POST['page_content']."',now(),now(),'".$_POST['page_status']."','".$_POST['show_in_home']."','".$_POST['meta_title']."','".$_POST['meta_description']."','".$_POST['meta_keyword']."','".$_POST['img_alt']."','".$_POST['design_type']."')");
			$last_id=mysql_insert_id();
			$title=clean_url($_POST['page_title'],$last_id);
			mysql_query("UPDATE website_pages SET slug='".$title."' WHERE page_id='".$last_id."'");
		}
		header('Location: content.php');		
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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<div id="header">
  <div id="logo">&nbsp;</div>
  <div class="nowrap" style="float:right; margin-right:20px"><a href="logout.php" class="text-link">Sign out</a></div>
  <div id="menu_first_level">
    <ul id="menu_first_level_ul" class="clear">
      <li id="tabs_catalog" class="cm-active"><a href="content.php">Website Pages</a></li>
      <li id="tabs_catalog"><a href="top_links.php">Top Links</a></li>
      <li id="tabs_catalog"><a href="products.php">Products</a></li>
      <li id="tabs_catalog"><a href="services.php">Services</a></li>
      <li id="tabs_catalog"><a href="view_order.php">Orders</a></li>
      <li id="tabs_catalog"><a href="user_list.php">Users</a></li>
      <li id="tabs_catalog"><a href="website_setting.php">Website Setting</a></li>
      <li id="tabs_catalog"><a href="setting.php">Account Setting</a></li>
    </ul>
  </div>
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr valign="top">
      <td class="content"><div id="main_column" class="clear">
          <div class="cm-notification-container"></div>
          <script type="text/javascript">
		  	function check_ext(fileName){
				var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
				if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG"){
					return false;
				}else{
					return true;
				}
			}
			function check_logo(){
				var typo=$("#page_logo").val().replace(/(^[\s\xA0]+|[\s\xA0]+$)/g,'');
				if(check_ext(typo)){
					return true;
				}else{
					return false;
				}
			}
			function check_step1(){
				if($('#page_title').val().trim()==''){
					alert('Make sure that you have entered a valid Page Title');
					return false;
				}else if($('#page_logo').val().trim()!=''){
					var ret_val=check_logo();
					if(check_logo()){
						alert('You can only upload gif ,jpeg and png files');
						return false;
					}
				}
			}
		</script>
          <div>
            <div class="clear mainbox-title-container">
              <h1 class="mainbox-title">Add Page:</h1>
            </div>
            <div class="mainbox-body">
              <div class="cm-tabs-content">
                <form id="listing_form2" name="listing_form2" action="" method="post" class="cm-form-highlight" onsubmit="return check_step1();" enctype="multipart/form-data">
                  <div id="content_general">
                    <fieldset>
                    <h2 class="subheader">Page Information</h2>
                    <div class="form-field">
                      <label for="page_title" class="cm-required">Title:</label>
                      <input id="page_title" type="text" name="page_title" class="input-text<?php if($page_title_error!=NULL){ ?> cm-failed-field<?php } ?>" size="50" value="" />
                      <?php echo $page_title_error; ?> </div>
                    <div class="form-field">
                      <label for="page_summary">Summary:</label>
                      <textarea id="page_summary" name="page_summary" cols="5" rows="5" class="input-textarea-long"></textarea>
                      <script type="text/javascript">
					  CKEDITOR.replace('page_summary' );
					  CKEDITOR.config.height = 100;
					  CKEDITOR.config.width = '75%';
					  </script>
                    </div>
                    <div class="form-field">
                      <label for="page_content">Content:</label>
                      <textarea id="page_content" name="page_content" cols="10" rows="20" class="input-textarea-long"></textarea>
                      <script type="text/javascript">
					  CKEDITOR.replace('page_content' );
					  CKEDITOR.config.height = 200;
					  CKEDITOR.config.width = '75%';
					  </script>
                    </div>
                    <div class="form-field">
                      <label for="img_alt">Image Alt Text:</label>
                      <input id="img_alt" type="text" name="img_alt" class="input-text" size="50" value="" />
                    </div>
                    <div class="form-field">
                      <label for="meta_title">Meta Title:</label>
                      <input id="meta_title" type="text" name="meta_title" class="input-text" size="50" value="" />
                    </div>
                    <div class="form-field">
                      <label for="meta_description">Meta Description:</label>
                      <textarea id="meta_description" name="meta_description" cols="5" rows="20" class="input-textarea-long" style="height:100px"></textarea>
                    </div>
                    <div class="form-field">
                      <label for="meta_keyword">Meta Keyword:</label>
                      <textarea id="meta_keyword" name="meta_keyword" cols="5" rows="20" class="input-textarea-long" style="height:100px"></textarea>
                    </div>
                    <div class="form-field">
                    <label for="page_logo">Page Logo:</label>
                    <input type="file" id="page_logo" name="page_logo" class="input-text<?php if($page_logo_error!=NULL){ ?> cm-failed-field<?php } ?>" />
                    <?php echo $page_logo_error; ?> </div>
                    <div class="form-field">
                      <label for="page_status">Status:</label>
                      <select name="page_status" id="page_status" style="width:257px">
                      <option value="publish">Published</option>
                      <option value="unpublish">Disabled</option>
                      </select>
                      </div>
                    <div class="form-field">
                      <label for="page_parent">Parent:</label>
                      <select name="page_parent" id="page_parent" style="min-width:257px">
                      <option value="-1">(no parent)</option>
                      <?php $data=list_pages_in_admin_edit(); 
					  if(count($data)>0){
					  foreach($data as $val){
					  ?>
                      <option value="<?php echo $val['page_id']; ?>"><?php echo $val['indent'].$val['title']; ?></option>
                      <?php }} ?>
                      </select>
                      </div>
                    <div class="form-field">
                      <label for="show_in_home">Show in home page:</label>
                      <select name="show_in_home" id="show_in_home" style="min-width:257px">
                      <option value="no">No</option>
                      <option value="yes">Yes</option>
                      </select>
                    </div>
                    <div class="form-field">
                      <label for="design_type">Design Type:</label>
                      <select name="design_type" id="design_type" style="min-width:257px">
                      <option value="1">1 Column</option>
                      <option value="2">2 Column</option>
                      <option value="3">3 Column</option>
                      </select>
                    </div>
                    </fieldset>
                   </div>
                  <div class="buttons-container buttons-bg cm-toggle-button"> <span  class="submit-button cm-button-main">
                    <input type="submit" name="dispatch2" value="Add" />
                    </span> </div>
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