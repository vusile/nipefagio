<script src="js/jquery.validate.min.js" type = "text/javascript"></script>
<script type = "text/javascript">
$(document).ready(function(){
 
 $('#contact-form').validate(
 {
  rules: {
    name: {
      minlength: 2,
      required: true
    },    
	
	captcha: {
      
      required: true
	  
    },
    email: {
      required: true,
      email: true
    },
    subject: {
      minlength: 2,
      required: true
    },
    message: {
      minlength: 2,
      required: true
    }
  },
  highlight: function(label) {
    $(label).closest('.control-group').addClass('error');
  },
  success: function(label) {
    label
      .text('OK!').addClass('valid')
      .closest('.control-group').addClass('success');
  }
 });
}); // end document.ready
</script>

<div class="container transparent" style = 'width: 900px;margin: 10px auto; background: #FFF; padding: 10px; ' >
<h1><?php echo $details->title; ?></h1>
<p><?php if (isset($contact_intro)) echo $contact_intro; else echo $details->text; ?></p>
<span style = 'color: red; font-weight: bold;'><?php if(strlen(validation_errors()!='')) echo 'Could not send message because:' .  validation_errors(); ?></span>
</header>
<form class="form-horizontal" action="send_message" method = "post" id = "contact-form">
  <div class="control-group">
    <label class="control-label" for="name">Name:</label>
    <div class="controls">
      <input type="text" id="name" name = "name" placeholder="Your Name">
    </div>
  </div>
 <div class="control-group">
    <label class="control-label" for="email">Email:</label>
    <div class="controls">
      <input type="text" id="email" name = "email" placeholder="Your Email Address">
    </div>
  </div>
 <div class="control-group">
    <label class="control-label" for="phone">Phone:</label>
    <div class="controls">
      <input type="text" id="phone" name = "phone" placeholder="Your Phone Number">
    </div>
  </div>
 <div class="control-group">
    <label class="control-label" for="subject">Subject:</label>
    <div class="controls">
      <input type="text" class="input-xlarge" id="subject" name = "subject" placeholder="Subject of your message" value="<?php if(isset($subject)) echo $subject; ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="message">Message:</label>
    <div class="controls">
      <textarea class="input-xxlarge" name = "message" id = "message" rows = "10"></textarea>
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="subject">Captcha:</label>
	<small style = "font-weight: bold">Enter the text in the box below, only CAPITAL letters and numbers</small>
	<p><?php echo $cap['image']; ?></p>
    <div class="controls">
      <input type="text" class="input" id="captcha" name = "captcha" >
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Send my Message</button>
    </div>
  </div>
</form>
</div>