<?php
include_once('config/connection.php');
if($_SESSION['login']!=true){
	header("Location: login.php");
	exit;
}

if(isset($_POST['service_title'])){
	if($_FILES["service_image"]['name']!=""){
		if(($_FILES["service_image"]["type"] == "image/gif")||($_FILES["service_image"]["type"] == "image/jpeg")||($_FILES["service_image"]["type"] == "image/pjpeg")||($_FILES["service_image"]["type"] == "image/png")){
			if ($_FILES["service_image"]["error"] > 0){
				$service_image_error='<div class="error-message" style="width:200px"><div class="arrow"></div><div class="message">The image field has some error.</div></div>';
			}else{
				if($_POST['show_footer']==''){
					$_POST['show_footer']=NULL;
				}
				mysql_query("INSERT INTO website_pro_ser(pro_ser_name,pro_ser_desc,pro_ser_intro,pro_ser_usd,pro_ser_inr,created,updated,meta_title,meta_desc,meta_keyword,img_alt,pro_ser_status,design_type,footer_menu_id,pro_ser_type) VALUES ('".$_POST['service_title']."','".$_POST['service_desc']."','".$_POST['service_intro']."','".$_POST['service_usd']."','".$_POST['service_inr']."',now(),now(),'".$_POST['meta_title']."','".$_POST['meta_description']."','".$_POST['meta_keyword']."','".$_POST['img_alt']."','".$_POST['service_status']."','".$_POST['design_type']."','".$_POST['show_footer']."','service')");
				$last_id=mysql_insert_id();
				$title=clean_url($_POST['service_title'],$last_id,'service');
				include('config/resize.php');
				$image = new SimpleImage();
				if(file_exists($site_path.'pro_ser_image/'.$title.'.jpg')){
					unlink($site_path.'pro_ser_image/'.$title.'.jpg');
					$image->load($_FILES["service_image"]["tmp_name"]);
					$image->resize(695,200);
					$image->save($site_path.'pro_ser_image/'.$title.'.jpg');
				}else{
					$image->load($_FILES["service_image"]["tmp_name"]);
					$image->resize(695,200);
					$image->save($site_path.'pro_ser_image/'.$title.'.jpg');
				}
				mysql_query("UPDATE website_pro_ser SET pro_ser_slug='".$title."',pro_ser_img='".$title."' WHERE pro_ser_id='".$last_id."'");
				if(count(@$_POST['manage_page'])>0){
					foreach($_POST['manage_page'] as $val){
						mysql_query("INSERT INTO website_pro_ser_pages(pro_ser_id,page_id) VALUES ('".$last_id."','".$val."')");
					}
				}
			}
		}else{
			$service_image_error='<div class="error-message" style="width:290px"><div class="arrow"></div><div class="message">The image file must be jpeg,jpg,gif or png type.</div></div>';
		}
	}else{
		if($_POST['show_footer']==''){
			$_POST['show_footer']=NULL;
		}
		mysql_query("INSERT INTO website_pro_ser(pro_ser_name,pro_ser_desc,pro_ser_intro,pro_ser_usd,pro_ser_inr,created,updated,meta_title,meta_desc,meta_keyword,img_alt,pro_ser_status,design_type,footer_menu_id,pro_ser_type) VALUES ('".$_POST['service_title']."','".$_POST['service_desc']."','".$_POST['service_intro']."','".$_POST['service_usd']."','".$_POST['service_inr']."',now(),now(),'".$_POST['meta_title']."','".$_POST['meta_description']."','".$_POST['meta_keyword']."','".$_POST['img_alt']."','".$_POST['service_status']."','".$_POST['design_type']."','".$_POST['show_footer']."','service')");
		$last_id=mysql_insert_id();
		$title=clean_url($_POST['service_title'],$last_id,'service');
		mysql_query("UPDATE website_pro_ser SET pro_ser_slug='".$title."' WHERE pro_ser_id='".$last_id."'");
		if(count(@$_POST['manage_page'])>0){
			foreach($_POST['manage_page'] as $val){
				mysql_query("INSERT INTO website_pro_ser_pages(pro_ser_id,page_id) VALUES ('".$last_id."','".$val."')");
			}
		}
	}
	header('Location: services.php');
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
<script type="text/javascript">
function Checkfiles(fileName){
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png"){
		return true;
	}else{
		return false;
	}
}

function submitform(){
	var service_title=document.getElementById("service_title").value;
	var service_usd=document.getElementById("service_usd").value;
	var service_inr=document.getElementById("service_inr").value;
	var service_image=document.getElementById("service_image").value;
	var nameTemplate = /^\s+$/;
	var numericTemplate = /^[0-9\.]+$/;
	if(service_title=='' || nameTemplate.test(service_title)){
		alert("Service title field is required.");
		return false;	
	}else if(service_usd==''){
		alert("Service price in USD field is required.");
		return false;
	}else if(!numericTemplate.test(service_usd)){
		alert("Service price in USD field is invalid.");
		return false;
	}else if(service_inr==''){
		alert("Service price in INR field is required.");
		return false;
	}else if(!numericTemplate.test(service_inr)){
		alert("Service price in INR field is invalid.");
		return false;
	}else if(service_image!='' && !Checkfiles(service_image)){
		alert("Invalid image file format.Upload only .jpg,.gif or .png format");
		return false;
	}
	document.forms["service_form"].submit();
}
</script>
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
  <tbody>
    <tr valign="top">
      <td class="content"><div id="main_column" class="clear">
          <div class="cm-notification-container"></div>
          <div class="mainbox-body">
              <div class="cm-tabs-content">
                <form id="service_form" name="service_form" action="" method="post" enctype="multipart/form-data" class="cm-form-highlight">
                  <div id="content_general">
                    <fieldset>
                    <h2 class="subheader">Service Information</h2>
                    <div class="form-field">
                      <label for="service_title" class="cm-required">Service Title:</label>
                      <input id="service_title" type="text" name="service_title" class="input-text<?php if($service_title_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="" />
                     </div>
                    <div class="form-field">
                      <label for="service_intro">Service Intro:</label>
                      <textarea id="service_intro" name="service_intro" cols="29" rows="4" class="input-textarea-long"></textarea>
                    </div>
                    <div class="form-field">
                      <label for="service_desc">Service Description:</label>
                      <textarea id="service_desc" name="service_desc" cols="29" rows="4" class="input-textarea-long<?php if($service_desc_error!=NULL){ ?> cm-failed-field<?php } ?>"></textarea>
                      <script type="text/javascript">
					  CKEDITOR.replace('service_desc' );
					  CKEDITOR.config.height = 200;
					  CKEDITOR.config.width = '75%';
					  </script>
                    </div>
                    <div class="form-field">
                      <label for="service_usd" class="cm-required">Price USD:</label>
                      <input type="text" id="service_usd" name="service_usd" class="input-text<?php if($service_usd_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="" />
                    </div>
                    <div class="form-field">
                      <label for="service_inr" class="cm-required">Price INR:</label>
                      <input type="text" id="service_inr" name="service_inr" class="input-text<?php if($service_inr_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="" />
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
                      <label for="service_image">Image:</label>
                      <input type="file" id="service_image" name="service_image" class="input-text<?php if($service_image_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="" />
                     <?php echo $service_image_error; ?></div>
                    <div class="form-field">
                      <label for="service_status">Status:</label>
                      <select name="service_status" id="service_status" style="width:257px">
                      <option value="active">Enabled</option>
                      <option value="inactive">Disabled</option>
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
                    <div class="form-field">
                      <label for="show_footer">Show In Footer:</label>
                      <select name="show_footer" id="show_footer" style="min-width:257px">
                      <option value="">No</option>
                      <option value="1">1 Column</option>
                      <option value="2">2 Column</option>
                      <option value="3">3 Column</option>
                      <option value="4">4 Column</option>
                      </select>
                    </div>
                    </fieldset>
                    <fieldset>
                    <h2 class="subheader">Manage Pages</h2>
                    <div class="form-field">
                    <label for="manage_page">Select Pages:</label>
                    <?php $data=list_pages_in_edit(); 
					  if(count($data)>0){
					  foreach($data as $val){
					  ?>
                      <input type="checkbox" name="manage_page[]" value="<?php echo $val['page_id']; ?>" /><?php echo $val['indent'].$val['title']; ?><br />
                      <?php }} ?>
                      </div>
                    </fieldset>
                  </div>
                  <span  class="submit-button cm-button-main">
                  <input name="step_check" type="hidden" value="yes" />
                  <input type="button" name="submit_form" value="Submit" onclick="return submitform()" />
                  </span>
                </form>
              </div>
            </div>
        </div></td>
    </tr>
  </tbody>
</table>
</body>
</html>