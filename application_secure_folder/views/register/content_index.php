<script src="<?php echo base_url(); ?>js/prototype.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/effects.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/validation.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
var RecaptchaOptions = {
	theme : 'red'
};
window.onload = init;
function init() {
	var submitObj = document.getElementById('register_button');
	submitObj.disabled = false;
}
</script>
<style type="text/css">
.validation-advice{
	margin-left:215px;
}
#innerrightmid span .form-field div{
	padding-bottom:0px;
}
</style>
<!--rightcontent-->
<div id="innercontainer">
  <div id="righttop"><span></span></div>
  <div id="innerrightmid"><span>
    <div style="text-align:justify">
      <h1>Create Account</h1>
      <hr />
      <center><?php echo @$error; ?></center>
      <div class="mainbox-body">
        <div class="cm-tabs-content" style="width:550px">
          <form class="cm-form-highlight" method="post" action="" name="listing_form" id="listing_form">
            <div id="content_general">
              <fieldset>
              	<div class="form-field">
                  <label class="cm-required" for="name">Name:</label>
                  <input type="text" value="<?php echo $this->input->post('name'); ?>" size="32" class="input-text required-entry validate-emailSender" name="name" id="name">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="email">Email Address:</label>
                  <input type="text" value="<?php echo $this->input->post('email'); ?>" size="32" class="input-text required-entry validate-email" name="email" id="email">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="password">Password:</label>
                  <input type="password" value="" size="32" class="input-text required-entry validate-password" name="password" id="password">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="cpassword">Password Again:</label>
                  <input type="password" value="" size="32" class="input-text required-entry validate-cpassword" name="cpassword" id="cpassword">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="star_sign">Star Sign:</label>
                  <input type="text" value="<?php echo $this->input->post('star_sign'); ?>" size="32" class="input-text required-entry validate-emailSender" name="star_sign" id="star_sign">
                </div>
                <div class="form-field">
                  <label for="phone_no">Phone No:</label>
                  <input type="text" value="<?php echo $this->input->post('phone_no'); ?>" size="32" class="input-text validate-phoneLax" name="phone_no" id="phone_no">
                </div>
                <div class="form-field">
                  <label for="gender">Gender:</label>
                  <input name="gender" type="radio" class="radio" value="Male" <?php if(($this->input->post('gender')=='Male') || ($this->input->post('gender')=='')){ ?>checked="checked"<?php } ?> />Male&nbsp;&nbsp;
                  <input name="gender" type="radio" class="radio" value="Female" <?php if($this->input->post('gender')=='Female'){ ?>checked="checked"<?php } ?> />Female
                </div>
                <div class="form-field">
                	<label for="birth_day_sel">Birthday:</label>
                    <select name="birth_day_sel" id="birth_day_sel">
                    <option value="">Day</option>
					<?php for($i=1; $i<=31; $i++){ $k=(strlen($i)>1)?"":"0"; ?>
                    <option value="<?php echo $k.$i; ?>" <?php if($i==$this->input->post('birth_day_sel')){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option><?php } ?>
                    </select>&nbsp;
                    <select name="birth_month_sel">
                    <option value="">Month</option>
                    <option value="01" <?php if($this->input->post('birth_month_sel')=="01"){ ?>selected="selected"<?php } ?>>January</option>
                    <option value="02" <?php if($this->input->post('birth_month_sel')=="02"){ ?>selected="selected"<?php } ?>>February</option>
                    <option value="03" <?php if($this->input->post('birth_month_sel')=="03"){ ?>selected="selected"<?php } ?>>March</option>
                    <option value="04" <?php if($this->input->post('birth_month_sel')=="04"){ ?>selected="selected"<?php } ?>>April</option>
                    <option value="05" <?php if($this->input->post('birth_month_sel')=="05"){ ?>selected="selected"<?php } ?>>May</option>
                    <option value="06" <?php if($this->input->post('birth_month_sel')=="06"){ ?>selected="selected"<?php } ?>>June</option>
                    <option value="07" <?php if($this->input->post('birth_month_sel')=="07"){ ?>selected="selected"<?php } ?>>July</option>
                    <option value="08" <?php if($this->input->post('birth_month_sel')=="08"){ ?>selected="selected"<?php } ?>>August</option>
                    <option value="09" <?php if($this->input->post('birth_month_sel')=="09"){ ?>selected="selected"<?php } ?>>September</option>
                    <option value="10" <?php if($this->input->post('birth_month_sel')==10){ ?>selected="selected"<?php } ?>>October</option>
                    <option value="11" <?php if($this->input->post('birth_month_sel')==11){ ?>selected="selected"<?php } ?>>November</option>
                    <option value="12" <?php if($this->input->post('birth_month_sel')==12){ ?>selected="selected"<?php } ?>>December</option>
                    </select>&nbsp;
                    <select name="birth_year_sel">
                    <option value="">Year</option>
					<?php for($j=1900; $j<=2012; $j++){ ?><option value="<?php echo $j; ?>" <?php if($j==$this->input->post('birth_year_sel')){ ?>selected="selected"<?php } ?>><?php echo $j; ?></option><?php } ?>
                    </select>
                  </div>
                  <div class="form-field">
                	<label for="birth_hour_time">Birth Time:</label>
                    <select name="birth_hour_time" id="birth_hour_time">
                    <option value="">hh</option>
					<?php for($i=0; $i<=23; $i++){ $k=(strlen($i)>1)?"":"0"; ?>
                    <option value="<?php echo $k.$i; ?>" <?php if($k.$i==$this->input->post('birth_hour_time')){ ?>selected="selected"<?php } ?>><?php echo $k.$i; ?></option><?php } ?>
                    </select>&nbsp;
                    <select name="birth_min_time" id="birth_min_time">
                    <option value="">mm</option>
					<?php for($i=0; $i<=59; $i++){ $k=(strlen($i)>1)?"":"0"; ?>
                    <option value="<?php echo $k.$i; ?>" <?php if($k.$i==$this->input->post('birth_min_time')){ ?>selected="selected"<?php } ?>><?php echo $k.$i; ?></option><?php } ?>
                    </select>&nbsp;
                    <select name="birth_sec_time" id="birth_sec_time">
                    <option value="">ss</option>
					<?php for($i=0; $i<=59; $i++){ $k=(strlen($i)>1)?"":"0"; ?>
                    <option value="<?php echo $k.$i; ?>" <?php if($k.$i==$this->input->post('birth_sec_time')){ ?>selected="selected"<?php } ?>><?php echo $k.$i; ?></option><?php } ?>
                    </select>
                  </div>
                <div class="form-field">
                  <label class="cm-required" for="address">Address:</label>
                  <input type="text" value="<?php echo $this->input->post('address'); ?>" size="32" class="input-text required-entry validate-emailSender" name="address" id="address">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="state">State:</label>
                  <input type="text" value="<?php echo $this->input->post('state'); ?>" size="32" class="input-text required-entry validate-emailSender" name="state" id="state">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="city">City:</label>
                  <input type="text" value="<?php echo $this->input->post('city'); ?>" size="32" class="input-text required-entry validate-emailSender" name="city" id="city">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="country">Country:</label>
                  <input type="text" value="<?php echo $this->input->post('country'); ?>" size="32" class="input-text required-entry validate-emailSender" name="country" id="country">
                </div>
              </fieldset>
            </div>
            <div align="center" style="margin:-20px 0 0 24px">
              <input type="submit" value="Register" id="register_button" class="button" name="submit" disabled="disabled">
            </div>
          </form>
          <script type="text/javascript">
			//<![CDATA[
				var dataForm = new VarienForm('listing_form', true);
			//]]>
		  </script>
        </div>
      </div>
    </div>
    </span> </div>
  <div id="rightbtm"><span></span></div>
</div>
<!--rightcontent end-->
<!--rightcontent-->
<div id="innerrightcontainer">
  <div id="lefttop"><span></span></div>
  <div id="innerleftmid"><span> <img src="<?php echo base_url(); ?>images/ads.jpg" width="210px" height="600px" /> </span> </div>
  <div id="leftbtm"><span></span></div>
</div>
<!--rightcontent end-->