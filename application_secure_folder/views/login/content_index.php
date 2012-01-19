<script src="<?php echo base_url(); ?>js/prototype.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/effects.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/validation.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
window.onload = init;
function init() {
	var submitObj = document.getElementById('signin_button');
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
      <h1>Sign In</h1>
      <hr />
      <div class="mainbox-body">
        <div class="cm-tabs-content" style="width:550px">
          <form class="cm-form-highlight" method="post" action="" name="listing_form" id="listing_form">
            <div id="content_general">
              <fieldset>
                <div class="form-field">
                  <label class="cm-required" for="email">Email Address:</label>
                  <input type="text" value="" size="32" class="input-text required-entry validate-email" name="email" id="email">
                </div>
                <div class="form-field">
                  <label class="cm-required" for="password">Password:</label>
                  <input type="password" value="" size="32" class="input-text required-entry validate-password" name="password" id="password">
                </div>
              </fieldset>
            </div>
            <div align="center" style="margin:-20px 0 0 5px">
              <input type="submit" value="Login" id="signin_button" class="button" name="submit" disabled="disabled">
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