<?php 

$res=mysql_query("SELECT cmp_name,cmp_desc,cmp_addr,cmp_city,cmp_province,cmp_postal_code,cmp_phone_code1,cmp_phone_code2,cmp_phone_code3,cmp_website,cmp_email FROM saloon_data WHERE saloon_id='".$_GET['saloon_id']."'");

$row=mysql_fetch_array($res);

?>

<script type="text/javascript">

function check_in(str_id){

	return $(str_id).val().replace(/(^[\s\xA0]+|[\s\xA0]+$)/g,'');

}

function validZip(zip){

	if(zip.match(/^[0-9]{5}$/)) {

		return true;

	}

	zip=zip.toUpperCase();

	if (zip.match(/^[A-Z][0-9][A-Z][0-9][A-Z][0-9]$/)) {

		return true;

	}

	if (zip.match(/^[A-Z][0-9][A-Z].[0-9][A-Z][0-9]$/)) {

		return true;

	}

	return false;

}

function check_step1(){

	var nameTemplate = /^[ '\.]+$/;

	var nameTemplate_bad = /^[\W]+$/;

	var emailTemplate = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z])+$/;

	var postalcodeTemplate = /^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ][ |-]?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i;

	var phoneTemplate = /^(?:1[-\s]?)?\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}$/;

	var urlTemplate = /^(((http|https):\/\/)|(www.))(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/;	

	if(check_in('#saloon_text')==''){

		alert('Make sure that you have entered a valid Saloon Name');

		return false;

	}else if(check_in('#saloon_desc')==''){

		alert('Make sure that you have entered valid Saloon Description');

		return false;

	}else if(check_in('#saloon_address')==''){

		alert('Make sure that you have entered a valid Saloon Address');

		return false;

	}else if(check_in('#city_code')==''){

		alert('Make sure that you have entered a valid City');

		return false;

	}else if(check_in('#prov_name')==''){

		alert('Make sure that you have entered a valid Province');

		return false;

	}else if(check_in('#postal_code')=='' || !validZip(check_in('#postal_code'))){

		alert('Make sure that you have entered a valid Postal Code');

		return false;

	}else if(check_in('#search_phone_area_code')=='' || check_in('#search_phone_1')=='' || check_in('#search_phone_2')=='' || !phoneTemplate.test(check_in('#search_phone_area_code')+' '+check_in('#search_phone_1')+' '+check_in('#search_phone_2'))){

		alert('Make sure that you have entered a valid Phone Number');

		return false;

	}else if(check_in('#website')!='' && !urlTemplate.test(check_in('#website'))){

		alert('Make sure that you have entered a valid Company Website');

		return false;

	}else if(check_in('#email')!='' && !emailTemplate.test(check_in('#email'))){

		alert('Make sure that you have entered a valid Company Email Address');

		return false;

	}

}



function onKeyUpValidateField(fieldName, pattern ){

	var strFieldValue=$('#'+fieldName).val();

	if(strFieldValue.length >0){

		if(!strFieldValue.match(pattern)){

			var strFieldValueLength=strFieldValue.length;

			$('#'+fieldName).val(strFieldValue.substring(0,strFieldValueLength-1));

		}

	}

	return false;

}

function move_focus(chk_var,current_id,next_id,after_num){

	if ( ( chk_var == 9 ) || ( chk_var == 16 ) ) {

			return false;

	}else{

		var current_str=document.getElementById(current_id).value;

		if(current_str.length==after_num){

		document.getElementById(next_id).focus();	

		}

   }

}

</script>



<div class="mainbox-body">

  <div class="cm-tabs-content">

    <form id="listing_form1" name="listing_form1" action="" method="post" class="cm-form-highlight" onSubmit="return check_step1();">

      <div id="content_general">

        <fieldset>

        <h2 class="subheader">Salon Information</h2>

        <div class="form-field">

          <label for="saloon_text" class="cm-required">Salon Name:</label>

          <input id="saloon_text" type="text" name="saloon_text" class="input-text<?php if($saloon_text_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo $row['cmp_name']; ?>" />

          <?php echo $saloon_text_error; ?> </div>

        <div class="form-field">

          <label for="saloon_desc" class="cm-required">Salon Description:</label>

          <textarea id="saloon_desc" name="saloon_desc" cols="29" rows="4" class="input-textarea-long<?php if($saloon_desc_error!=NULL){ ?> cm-failed-field<?php } ?>"><?php echo $row['cmp_desc']; ?></textarea>

          <?php echo $saloon_desc_error; ?> </div>

        <div class="form-field">

          <label for="saloon_address" class="cm-required">Salon Address:</label>

          <input type="text" id="saloon_address" name="saloon_address" class="input-text<?php if($saloon_address_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo $row['cmp_addr']; ?>" />

          <?php echo $saloon_address_error; ?> </div>

        <div class="form-field">

          <label for="city_code" class="cm-required">City:</label>

          <input type="text" id="city_code" name="city_code" class="input-text<?php if($city_code_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo $row['cmp_city']; ?>" />

          <?php echo $city_code_error; ?> </div>

        <div class="form-field">

          <label for="prov_name" class="cm-required">State/Province:</label>

          <input type="text" id="prov_name" name="prov_name" class="input-text<?php if($prov_name_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo $row['cmp_province']; ?>" />

          <?php echo $prov_name_error; ?> </div>

        <div class="form-field">

          <label for="postal_code" class="cm-required">Zip Code/Postal Code:</label>

          <input type="text" id="postal_code" name="postal_code" class="input-text<?php if($postal_code_error!=NULL){ ?> cm-failed-field<?php } ?>" size="32" value="<?php echo $row['cmp_postal_code']; ?>" />

          <?php echo $postal_code_error; ?> </div>

        </fieldset>

        <fieldset>

        <h2 class="subheader">Salon Contact information</h2>

        <div class="form-field">

          <label for="search_phone_area_code" class="cm-required">Salon Phone Number:</label>

          <input id="search_phone_area_code" type="text" name="phone_code1" class="input-text<?php if($phone_code1!=NULL){ ?> cm-failed-field<?php } ?>" size="3" maxlength="3" onKeyUp="javascript:onKeyUpValidateField('search_phone_area_code','^\\d{1,3}$');move_focus(event.keyCode,'search_phone_area_code','search_phone_1','3');" value="<?php echo $row['cmp_phone_code1']; ?>" />

          <input id="search_phone_1" type="text" name="phone_code2" class="input-text<?php if($phone_code2!=NULL){ ?> cm-failed-field<?php } ?>" size="3" maxlength="3" onKeyUp="javascript:onKeyUpValidateField('search_phone_1', '^\\d{1,3}$');move_focus( event.keyCode,'search_phone_1','search_phone_2','3');" value="<?php echo $row['cmp_phone_code2']; ?>" />

          <input id="search_phone_2" type="text" name="phone_code3" class="input-text<?php if($phone_code3!=NULL){ ?> cm-failed-field<?php } ?>" size="4" maxlength="4" onKeyUp="javascript:onKeyUpValidateField('search_phone_2','^\\d{1,4}$');" value="<?php echo $row['cmp_phone_code3']; ?>" />

          <?php echo $saloon_phone_error; ?>

        </div>

        <div class="form-field">

          <label for="website">Website:</label>

          <input type="text" id="website" name="website" size="32" value="<?php echo $row['cmp_website']; ?>" class="input-text" />

        </div>

        <div class="form-field">

          <label for="email">E-mail:</label>

          <input type="text" id="email" name="email" size="32" value="<?php echo $row['cmp_email']; ?>" class="input-text" />

        </div>

        </fieldset>

      </div>

      <span  class="submit-button cm-button-main">

      <input name="step_check" type="hidden" value="yes" />

      <input type="submit" name="dispatch1" value="Update" />

      </span>

    </form>

  </div>

</div>

