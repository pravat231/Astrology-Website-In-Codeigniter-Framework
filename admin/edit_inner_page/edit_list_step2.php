<script type="text/javascript">
function check_logo(){
	var typo=$("#saloon_logo").val().replace(/(^[\s\xA0]+|[\s\xA0]+$)/g,'');
	if(typo==''){
		alert('Make sure that you select a valid file for upload');
		return false;
	}else if(check_ext(typo)){
		alert('You can only upload gif ,jpeg and png files');
		return false;
	}else{
		return true;
	}	
}
function check_ext(fileName){
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG"){
		return false;
	}else{
		return true;
	}
}
</script>
<div class="mainbox-body">
  <div class="cm-tabs-content">
    <form id="listing_form5" name="listing_form5" action="" method="post" class="cm-form-highlight" onsubmit="return check_logo();" enctype="multipart/form-data">
      <div id="content_general">
        <fieldset>
        <h2 class="subheader">Logo Integration</h2>
        <div class="form-field">
          <label for="saloon_logo" class="cm-required">Company Logo:</label>
          <input type="file" id="saloon_logo" name="saloon_logo" class="input-text<?php if($saloon_logo_error!=NULL){ ?> cm-failed-field<?php } ?>" />
          <?php echo $saloon_logo_error; ?> </div>
        </fieldset>
      </div>
      <div class="buttons-container buttons-bg cm-toggle-button"> <span  class="submit-button cm-button-main">
        <input name="step_check" type="hidden" value="yes" />
        <input type="submit" name="dispatch2" value="Update" />
        </span><span  class="submit-button cm-button-main">&nbsp;
        <input type="button" name="skip" value="Skip" onclick="javascript:location.href='listings.php'" />
        </span> </div>
    </form>
  </div>
</div>
