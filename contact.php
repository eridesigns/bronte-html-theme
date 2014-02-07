<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the phone field is not empty
	if(trim($_POST['phone']) == '') {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}

	//Check to make sure that the name field is not empty
	if(trim($_POST['weburl']) == '') {
		$hasError = true;
	} else {
		$weburl = trim($_POST['weburl']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!filter_var( trim($_POST['email'], FILTER_VALIDATE_EMAIL ))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'info@somethingweb.com'; // Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nPhone Number: $phone \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  
  <title>WordPress Theme for writers</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
 
  <!-- style -->
  <link type="text/css" rel="stylesheet" href="style.css">

  <!-- loading less -->
  <link type="text/css" rel="stylesheet/less" href="style.less">
  <script src="js/less-1.6.1.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
    
</head>
<body>

<div class="top-nav">
<div class="container">

	<div class="logo col-sm-3">
		<h3><a href="index.html">Bronte</a></h3>
	</div><!-- logo -->
	
	<div class="nav col-sm-9">
		<ul class="navbar pull-right">
			<li>
			<a href="#">About</a>
			<ul>
				<li><a href="index-2.html">Home Two</a></li>
				<li><a href="index-3.html">Home Three</a></li>
			</ul>
			</li>
			<li><a href="blog.html">Blog</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</div><!-- nav -->
	
</div><!-- container -->
</div><!-- top nav -->

<div class="header">
<div class="container">

	<div class="content">
		<h1>
			Changing the world, one theme at a time !
		</h1>
		
		<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
		
		
        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
          <fieldset>
          
            <hr>

            <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Message Successfully Sent!</strong></p>
                <p>Thank you for using our contact form, <strong><?php echo $name;?></strong>! Your email was successfully sent and we&rsquo;ll be in touch with you soon.</p>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="name">Your Name<span class="help-required">*</span></label>
              <input type="text" name="contactname" id="contactname" value="" class="form-control required" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="phone">Your Phone Number<span class="help-required">*</span></label>
              <input type="text" name="phone" id="phone" value="" class="form-control required" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="email">Your Email<span class="help-required">*</span></label>
              <input type="text" name="email" id="email" value="" class="form-control required email" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="weburl">Your Website<span class="help-required">*</span></label>
              <input type="text" name="weburl" id="weburl" value="" class="form-control required url" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="subject">Subject<span class="help-required">*</span></label>
              <select name="subject" id="subject" class="form-control required" role="select" aria-required="true">
                <option></option>
                <option>One</option>
                <option>Two</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Message<span class="help-required">*</span></label>
              <textarea rows="8" name="message" id="message" class="form-control required" role="textbox" aria-required="true"></textarea>
            </div>

            <div class="actions">
              <input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-primary" title="Click here to submit your message!" />
              <input type="reset" value="Clear Form" class="btn btn-danger" title="Remove all the data from the form." />
            </div>
          </fieldset>
        </form>
        
        </div><!-- content -->

  
	
</div><!-- container -->
</div><!-- header -->



<div class="footer">
<div class="container">

	<div class="col-md-4 product">
		
		<div class="details">
			<h5><i>Follow us</i></h5>
			<ul class="social">
				<li><a target="_blank" href="#"><i class="icon-facebook"></i></a></li>
				<li><a target="_blank" href="#"><i class="icon-twitter"></i></a></li>
				<li><a target="_blank" href="#"><i class="icon-linkedin"></i></a></li>
				<li><a target="_blank" href="#"><i class="icon-instagram"></i></a></li>
			</ul>
		</div>
		
	</div><!-- product -->
	
	<div class="col-md-4 product">
		
		<div class="details">
			<h5><i>Get in touch</i></h5>
			<h5>info@somethingweb.com</h5>
		</div>
		
	</div><!-- product -->
	
	<div class="col-md-4 product">
		
		<div class="details">
			<h5><i>Subscribe</i></h5>
			<input type="text" placeholder="your email + enter" class="subscribe-form"/>
		</div>
		
	</div><!-- product -->
	
	
	
	<div class="col-md-12">
		<hr>
		<div class="copyright">
			&copy; 2014. All Rights
			<a href="http://eridesigns.com.au" target="_blank">Eri Designs</a>
		</div>
	</div>

</div><!-- container -->
</div><!-- footer -->


<!-- loading js -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/plugins/superfish.min.js"></script>
<script type="text/javascript" src="js/plugins/hoverIntent.js"></script>
<script type="text/javascript" src="js/plugins/backstretch.js"></script>
<script type="text/javascript" src="js/plugins/validate.js"></script>
<script type="text/javascript" src="js/plugins/contact.js"></script>
<script type="text/javascript" src="fontello/config.json"></script>

<script type="text/javascript">
//$(".header").backstretch("http://dl.dropbox.com/u/515046/www/garfield-interior.jpg");
</script>

<!-- loading fonts -->
<link type="text/css" rel="stylesheet" href="fontello/css/fontello-codes.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello-embedded.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello-ie7-codes.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello-ie7.css">
<link type="text/css" rel="stylesheet" href="fontello/css/fontello.css">
</body>
</html>